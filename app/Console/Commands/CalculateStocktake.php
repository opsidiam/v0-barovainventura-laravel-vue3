<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Modules\Cargo\Models\Cargo;
use Modules\Item\Models\Item;
use Modules\Notification\Models\Notification;
use Modules\Stocktake\Models\ArchiveScan;
use Modules\Stocktake\Models\Stocktake;
use Modules\Stocktake\Models\StocktakeUser;

class CalculateStocktake extends Command
{
    protected $signature = 'app:calculate-stocktake';
    protected $description = 'Calculate stocktake data with JavaScript-like logic';

    public function handle()
    {
        $stocktakes = Stocktake::where('ready', 0)
            ->where('open', 3)
            ->get();

        foreach ($stocktakes as $stocktake) {
            $total_profit = (float)($stocktake->total_profit ?? 0);

            // ak už sú všetky ArchiveScan spracované, označ ready a pokračuj
            $archiveScansDone = ArchiveScan::where('stocktake_id', $stocktake->id)
                ->whereNotNull('stocktake_data')->count();
            $archiveScansTotal = ArchiveScan::where('stocktake_id', $stocktake->id)->count();

            if ($archiveScansTotal > 0 && $archiveScansDone === $archiveScansTotal) {
                $stocktake->ready = 1;
                $stocktake->save();
                continue;
            }

            // prechádzaj históriu skenov
            foreach ($stocktake->scan_history as $scan) {
                // bezpečné načítanie scan_data
                $scan_data = $scan->scan_data ?? [];
                if (!is_array($scan_data)) {
                    $scan_data = [];
                }

                // defaulty pre povinné polia zo skenu
                $scan_data['ean'] = $scan_data['ean'] ?? null;
                $scan_data['api'] = $scan_data['api'] ?? null;
                $scan_data['full_pack'] = (int)($scan_data['full_pack'] ?? 0);
                $scan_data['weight'] = (float)($scan_data['weight'] ?? 0.0);
                $scan_data['has_bottle_data'] = false; // nastav až po načítaní

                if (empty($scan_data['ean'])) {
                    // bez EAN nevieme nič vypočítať
                    continue;
                }

                $product = Cargo::where('ean', $scan_data['ean'])->first();
                if (!$product) {
                    continue;
                }

                $item_data = Item::where([
                    ['cargo_id', $product->id],
                    ['bar_id', $stocktake->bar_id],
                ])->first();

                // používateľ, ktorý skenoval
                $user = StocktakeUser::where('bar_id', $stocktake->bar_id)
                    ->where('api', $scan_data['api'])
                    ->first();
                $scanned_by = $user ? trim(($user->name ?? '') . ' ' . ($user->surname ?? '')) : 'Unknown user';

                // init premenné
                $full_packs = (int)$scan_data['full_pack'];
                $weight = (float)$scan_data['weight'];
                $show_in_grams = false;

                // údaje produktu
                $vol = (float)($product->volume ?? 0.0);
                $weight_empty = (float)($product->weight_empty ?? 0.0);
                $weight_full  = (float)($product->weight_full ?? 0.0);
                $content_weight = $weight_full - $weight_empty; // môže byť 0
                $tolerance = (float)($product->weight_tolerance ?? 10.0);
                $has_bottle_data = ($content_weight > 0) && ($vol > 0);

                // spracovanie podľa typu
                if ((int)$product->type === 1) {
                    // typ 1 = váhový (neprepočítavame na objem)
                    $show_in_grams = true;
                } else {
                    // typ 0 = objemový (ak máme dáta fliaš a objem)
                    if ($has_bottle_data) {
                        $scan_data['has_bottle_data'] = true;

                        // ak je váha >= (full - tolerance), odpočítaj celé fľaše
                        if ($weight >= ($weight_full - $tolerance)) {
                            $full_packs += 1;
                            $weight -= ($weight_full - $tolerance);

                            // druhý krát (max ešte jedna fľaša)
                            if ($weight >= ($weight_full - $tolerance)) {
                                $full_packs += 1;
                                $weight -= ($weight_full - $tolerance);
                            }
                        }

                        // prepocet z g na ml: ml/gram = volume/content_weight
                        $mlPerGram = $vol / $content_weight;

                        // čistý obsah (nad prázdnou fľašou)
                        $net = max(0.0, $weight - $weight_empty);
                        $weight = $net * $mlPerGram;    // od teraz v ml
                        $scan_data['weight'] = $weight; // aktualizuj v scane
                    } else {
                        // nemáme validné dáta, zobrazuj v gramoch
                        $show_in_grams = true;

                        // zaloguj, nech viete, pre ktorý to padlo
                        Log::warning("Invalid bottle/volume data for cargo_id={$product->id} (vol={$vol}, content_weight={$content_weight})");
                    }
                }

                // výpočty financií (vracia floaty)
                $financial_data = $this->calculateFinancialData($product, $item_data, $scan_data, $full_packs, $weight);
                $total_profit += (float)($financial_data['total_profit'] ?? 0.0);

                // priprava dát pre uloženie k scanu
                $product_data = [
                    'name'          => $product->name,
                    'type'          => (int)$product->type,
                    'volume'        => abs((float)$product->volume),
                    'alcohol'       => abs((float)$product->alcohol),
                    'weight'        => abs((int)round($weight)), // ml alebo gramy podľa show_in_grams
                    'full_packs'    => abs((int)$full_packs),
                    'scanned_by'    => $scanned_by,
                    'ean'           => $scan_data['ean'],
                    'show_in_grams' => $show_in_grams,
                    'financial_data'=> $financial_data,
                ];

                // update skladovej položky (bezpečné null-ish pristupy)
                Item::updateOrCreate(
                    ['cargo_id' => $product->id, 'bar_id' => $stocktake->bar_id],
                    [
                        'last_stocktake'        => $stocktake->id,
                        'weight_last_stocktake' => $item_data->weight_count ?? null,
                        'full_pack_last_stocktake' => $item_data->full_pack_count ?? null,
                        'user_id'               => $stocktake->user_id,
                        'type'                  => (int)$product->type,
                        'weight_count'          => abs((int)round($weight)),
                        'full_pack_count'       => abs((int)$full_packs),
                    ]
                );

                $scan->stocktake_data = $product_data;
                $scan->save();
            }

            // ak už niet nezpracovaných, označ ready
            $pending = ArchiveScan::where('stocktake_id', $stocktake->id)
                ->whereNull('stocktake_data')
                ->count();
            if ($pending === 0) {
                $stocktake->ready = 1;
            }

            $stocktake->total_profit = $total_profit;

            // notifikácia
            if ($stocktake->user_id) {
                $userData = User::find($stocktake->user_id);
                if ($userData) {
                    $this->createNotification($userData);
                } else {
                    Log::warning("User not found for stocktake ID: {$stocktake->id}, user_id: {$stocktake->user_id}");
                    $stocktake->user_id = null;
                }
            }

            $stocktake->save();
        }
    }

    private function createNotification(User $user)
    {
        Notification::create([
            'type'    => 'success',
            'scope'   => 'user',
            'message' => 'Inventúra bola úspešne uzavretá a jej spracovanie dokončené.',
            'user_id' => $user->id,
            'bar_id'  => null,
            'url'     => route('stocktake.index'),
        ]);
    }

    /**
     * Výpočty financií – vracia floaty (nie stringy), s ochranou proti deleniu nulou.
     */
    protected function calculateFinancialData($product, $item_data, $scan_data, $full_packs, $weight)
    {

        $vol             = (float)($product->volume ?? 0.0);
        $buy             = (float)($item_data->price_buy  ?? 0.0);
        $sell            = (float)($item_data->price_sell ?? 0.0);
        if ((int)$product->type === 1) {

            $total_ml = max(0, ($vol * $full_packs) + $weight);

            $price_per_ml = ($vol > 0.0 && $buy > 0.0) ? ($buy / $vol) : 0.0;

            $total_stock_cost = $total_ml * $price_per_ml;
        } else {
            $total_units = $full_packs;
            $price_per_unit = $buy;
            $total_stock_cost = $total_units * $price_per_unit;
        }

        $has_previous    = isset($item_data->full_packs_previous, $item_data->weight_previous);
        $weight_empty    = (float)($product->weight_empty ?? 0.0);
        $weight_full     = (float)($product->weight_full  ?? 0.0);
        $content_weight  = $weight_full - $weight_empty;

        // Bez predchádzajúcej inventúry, bez validných fliaš/objemu alebo bez cien – nepočítame
        if (!$has_previous || $content_weight <= 0 || $vol <= 0 || $buy < 0 || $sell < 0) {
            return [
                'sold_content'           => 0.0,
                'total_cost'             => 0.0,
                'total_revenue'          => 0.0,
                'total_profit'           => 0.0,
                'total_stock_cost'       => round($total_stock_cost, 2),
                'has_previous_stocktake' => !$has_previous,
                'has_bottle_data'        => ($content_weight > 0 && $vol > 0),
            ];
        }

        // Prepočet ml/gram
        $mlPerGram = $vol / $content_weight;

        // minulé a aktuálne netto obsahy
        $prevNet = max(0.0, (float)($item_data->weight_previous ?? 0.0) - $weight_empty);
        $currNet = max(0.0, (float)$weight - $weight_empty);

        $previous_total = ((float)($item_data->full_packs_previous ?? 0) * $vol) + ($prevNet * $mlPerGram);
        $current_total  = ((int)$full_packs * $vol) + ($currNet * $mlPerGram);

        // predané množstvo (v ml)
        $sold_content = max(0.0, $previous_total - $current_total);

        // jednotkové ceny (na ml); ochrana, vol > 0 už kontrolovaná
        $cost_per_ml    = $buy  / $vol;
        $revenue_per_ml = $sell / $vol;

        $total_cost    = $sold_content * $cost_per_ml;
        $total_revenue = $sold_content * $revenue_per_ml;
        $total_profit  = $total_revenue - $total_cost;

        return [
            'sold_content'           => round($sold_content, 2),
            'total_cost'             => round($total_cost, 2),
            'total_revenue'          => round($total_revenue, 2),
            'total_profit'           => round($total_profit, 2),
            'total_stock_cost'       => round($total_stock_cost, 2),
            'has_previous_stocktake' => false,
            'has_bottle_data'        => true,
        ];
    }
}
