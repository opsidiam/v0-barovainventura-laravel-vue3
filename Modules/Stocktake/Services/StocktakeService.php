<?php

namespace Modules\Stocktake\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\Cargo\Models\Cargo;
use Modules\Item\Models\Item;
use Modules\Stocktake\Models\ArchiveScan;
use Modules\Stocktake\Models\Scan;
use Modules\Stocktake\Models\Stocktake;
use Modules\Stocktake\Models\StocktakeUser;
use function GuzzleHttp\json_encode;

class StocktakeService
{
    public function handle() {}

    public function index()
    {
        $data['stocktakes'] = Stocktake::with(['bar','mine_user'])
            ->withCount('scan_history')
            ->where('bar_id', request()->session()->get('bar'))
            ->where('user_id', auth()->user()->id)
            ->where('open', 3)
            ->get();
        $data['reload'] = $data['stocktakes']->contains(function ($stocktake) {
            return !$stocktake->ready;
        });
        return $data;
    }

    public function getCloseStocktakes()
    {
        $data['stocktakes'] = Stocktake::with(['bar','mine_user'])
            ->withCount('scan_history')
            ->where('bar_id', request()->session()->get('bar'))
            ->where('user_id', auth()->user()->id)
            ->where('open', 3)
            ->get();
        $data['reload'] = $data['stocktakes']->contains(function ($stocktake) {
            return !$stocktake->ready;
        });
        return $data;
    }

    public function getOpenpenStocktake()
    {
        $open_stocktakes = Stocktake::where('user_id',auth()->user()->id)
            ->where('open',1)
            ->where('bar_id',request()->session()->get('bar'))
            ->get();
        $scan[] = null;
        foreach($open_stocktakes as $open_stocktake){
            if(isset($open_stocktake->users)){
                $count = Scan::where('stocktake_id',$open_stocktake->id)->count();
                $scan[$open_stocktake->api] = $count;
            }else{
                $scan[$open_stocktake->api] = 0;
            }

        }
        $total_count = Item::where('bar_id',request()->session()->get('bar'))->count();
        return [
            'open_stocktakes' => $open_stocktakes,
            'total_count' => $total_count,
            'scans' => $scan,
        ];

    }

    public function usersSearch()
    {
        $term = trim(request()->q);

        if (empty($term)) {
            return [];
        }

        return StocktakeUser::query()
            ->where(function ($query) use ($term) {
                $query->where('name', 'LIKE', "%{$term}%")
                    ->orWhere('surname', 'LIKE', "%{$term}%");
            })
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'text' => $user->name.' '.$user->surname
                ];
            })
            ->all();
    }

    public function getProcess($id)
    {
        $user = auth()->user();
        $stocktake = Stocktake::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $scans = Scan::with('cargo')
            ->where('stocktake_id', $id)
            ->get();

        $items = [];
        $needsUpdate = 0;

        foreach ($scans as $scan) {
            if (!$scan->cargo) {
                continue;
            }

            $product = $scan->cargo;
            $scanner = StocktakeUser::find($scan->stocktake_user_id);
            $scannerName = $scanner ? $scanner->name.' '.$scanner->surname : 'Neznámy';

            $type = $product->typ ?? 0;
            $fullWeight = (int) $product->weight_full;
            $emptyWeight = (int) $product->weight_empty;
            $volume = (int) $product->volume;
            $tolerance = (int) ($product->weight_tolerance ?? 10);

            $currentFull = $scan->full_pack;
            $currentWeight = $scan->weight;

            if ($fullWeight && $emptyWeight) {
                $weightDifference = abs($fullWeight - $emptyWeight);

                if ($scan->weight >= ($fullWeight - $tolerance)) {
                    $currentFull++;
                    $currentWeight = 0;
                } else {
                    $weightPerVolume = $weightDifference / $volume;
                    $currentWeight = $weightPerVolume * ($scan->weight - $emptyWeight);
                }
            }

            $hasWeightData = false;
            if ($type == 0) {
                $hasWeightData = is_null($fullWeight) || is_null($emptyWeight);
                $needsUpdate += (int) $hasWeightData;
            } else {
                $needsUpdate++;
            }

            $items[] = [
                'id' => $scan->id,
                'name' => $product->name,
                'volume' => abs($volume),
                'alcohol' => abs($product->alcohol),
                'type' => $type,
                'stock' => abs(round($currentWeight)),
                'stock_pack' => abs($currentFull),
                'scanner' => $scannerName,
                'full_pack' => $scan->full_pack,
                'weight_full' => $fullWeight,
                'weight_empty' => $emptyWeight,
                'ean' => $scan->ean,
                'weight_data' => $hasWeightData
            ];
        }

        $users = [];
        if ($stocktake->users && $stocktake->users !== "null") {
            $userIds = json_decode($stocktake->users);
            $users = StocktakeUser::whereIn('id', $userIds)->get()->all();
        }

        return [
            'stocktake' => $stocktake,
            'users' => $users,
            'need_update' => $needsUpdate,
            'mine_user' => StocktakeUser::find($stocktake->mine_user),
            'items' => $items,
        ];
    }

    public function getLiveData()
    {
        $stocktakeId = request()->stocktake_id;
        $barId = request()->session()->get('bar');
        $response = [
            'profit_total' => 0,
            'item' => [],
            'stocktake_user' => [],
            'stocktake_id' => [],
            'item_add_data' => [],
            'data_scan' => [],
        ];

//        if (!request()->q) {
//            return $this->processSingleScan($stocktakeId, $barId, $response);
//        }

        $scans = Scan::where('stocktake_id', $stocktakeId)->get();
        $uniqueEans = $scans->pluck('ean')->unique();

        foreach ($uniqueEans as $ean) {
            $scan = Scan::where('stocktake_id', $stocktakeId)
                ->where('ean', $ean)
                ->first();

            $product = Cargo::where('ean', $ean)->first();
            if (!$product) continue;

            $item = Item::where('cargo_id', $product->id)
                ->where('bar_id', $barId)
                ->first();

            $result = $this->calculateProductData($scan, $product, $item);
            $response['profit_total'] += $result['profit_total'] ?? 0;

            $scanUser = StocktakeUser::find($scan->stocktake_user_id);
            $scanUserName = $scanUser ? $scanUser->name.' '.$scanUser->surname : 'Unknown';

            $response['data_scan']["{$ean}"] = [
                'id' => $scan->id,
                'stocktake_user_id' => $scan->stocktake_user_id,
                'stocktake_id' => $scan->stocktake_id,
                'full_pack' => $scan->full_pack,
                'weight' => $scan->weight,
                'scan_id' => $scan->id,
                'scan_user' => $scanUserName,
                'money_state' => $result['money_state'],
            ];

            $response['item'][] = $product->toArray();
        }


        $response['stocktake_user'] = StocktakeUser::where('stocktake_id', $stocktakeId)->get()->all();

        return $response;
    }

    protected function processSingleScan($stocktakeId, $barId, $response)
    {
        $scan = Scan::where('stocktake_id', $stocktakeId)->first();
        if (!$scan) return $response;

        $product = Cargo::where('ean', $scan->ean)->first();
        if (!$product) return $response;

        $item = Item::where('cargo_id', $product->id)
            ->where('bar_id', $barId)
            ->first();

        $result = $this->calculateProductData($scan, $product, $item);
        $response['profit_total'] = $result['profit_total'] ?? 0;

        $scanUser = StocktakeUser::find($scan->stocktake_user_id);
        $scanUserName = $scanUser ? $scanUser->name.' '.$scanUser->surname : 'Unknown';

        $response['data_scan'][$scan->ean] = [
            'id' => $scan->id,
            'stocktake_user_id' => $scan->stocktake_user_id,
            'full_pack' => $scan->full_pack,
            'weight' => $scan->weight,
            'scan_id' => $scan->id,
            'scan_user' => $scanUserName,
            'money_state' => $result['money_state'],
        ];

        $response['item'][] = array_merge(
            $result['item_add_data'],
            $product->toArray()
        );

        return $response;
    }

    protected function calculateProductData($scan, $product, $item)
    {
        $result = [
            'profit_total' => 0,
            'item_add_data' => null,
            'money_state' => [
                'predany_obsah' => false,
                'naklady_spolu' => false,
                'trzba_spolu' => false,
                'zisk_spolu' => false,
                'last_inv_exist' => true,
                'bottle_data_set' => false,
                'hodnota_ml' => 0,
            ],
        ];

        $weightOnlyProduct = isset($product->weight_full, $product->weight_empty)
            ? $product->weight_full - $product->weight_empty
            : false;

        $result['money_state']['bottle_data_set'] = (bool)$weightOnlyProduct;

        // Last inventory data
        $hodnotaSpolu = false;
        $pricePerMililiter = 0;
        $checkLastInvCount = false;
        $fullPackLastInv = $item->full_pack_last_inv ?? null;
        $weightLastInv = $item->weight_last_inv ?? null;

        if (isset($fullPackLastInv)) {
            $checkLastInvCount = true;
            if (!isset($weightLastInv)) {
                $checkLastInvCount = false;
            }
        }

        $result['money_state']['last_inv_exist'] = !$checkLastInvCount;

        $totalWeightLastInv = ($checkLastInvCount && $weightOnlyProduct)
            ? ($fullPackLastInv * $weightOnlyProduct) + ($weightLastInv - $product->weight_empty)
            : false;

        $totalWeightNowInv = $weightOnlyProduct
            ? ($scan->full_pack * $weightOnlyProduct) +
            (floatval($scan->weight) - floatval($product->weight_empty))
            : false;

        // Price calculations
        $priceSellOne = $item->price_sell ?? null;
        $weightSellOne = $item->weight_sell ?? null;
        $priceBuyPack = $item->price_buy ?? null;

        if($priceBuyPack){

            if($product->volume){
                $result['money_state']['hodnota_ml'] = ($priceBuyPack / $product->volume);
            } else {
                $result['money_state']['hodnota_ml'] = $priceBuyPack;
            }
        }

        $priceBuyOneStuck = ($priceSellOne && $priceBuyPack && $weightSellOne)
            ? $priceBuyPack / ($product->volume / $weightSellOne)
            : false;

        $priceSellOneStuck = $priceSellOne ?? false;

        // Used weight calculations
        $usedWeightProductNow = false;
        if ($priceBuyOneStuck && $totalWeightLastInv && $totalWeightNowInv) {
            $addedProductFullPacksLastInv = ($scan->add_full_pack > 0)
                ? ($weightOnlyProduct * $scan->add_full_pack) + $totalWeightLastInv
                : $totalWeightLastInv;

            $addedProductFullPacksNowInv = ($scan->add_full_pack > 0)
                ? ($weightOnlyProduct * $scan->add_full_pack) + $totalWeightNowInv
                : $totalWeightNowInv;

            $usedWeightProductNow = $addedProductFullPacksLastInv - $addedProductFullPacksNowInv;
        }

        // Glass calculations
        $totalSellGlassess = ($usedWeightProductNow && $priceSellOne)
            ? $usedWeightProductNow / $weightSellOne
            : false;

        if ($totalSellGlassess) {
            $nakladyNaPredanyObsah = $totalSellGlassess * $priceBuyOneStuck;
            $ziskNaPredanyObsah = $totalSellGlassess * $priceSellOneStuck;

            $ziskySpolu = $ziskNaPredanyObsah - $nakladyNaPredanyObsah;
            $result['profit_total'] = $ziskySpolu;

            $result['money_state'] = [
                'predany_obsah' => $usedWeightProductNow,
                'naklady_spolu' => $nakladyNaPredanyObsah,
                'trzba_spolu' => $ziskNaPredanyObsah,
                'zisk_spolu' => $ziskySpolu,
                'last_inv_exist' => !$checkLastInvCount,
                'bottle_data_set' => (bool)$weightOnlyProduct,
            ];
        }

        // Weight data check
        if ($product->typ == 0) {
            $weightData = !isset($product->weight_full) || !isset($product->weight_empty);
            $result['item_add_data'] = $weightData ? [$scan->ean => true] : [null];
        }

        return $result;
    }

    public function getLiveDataCheck()
    {
        $stocktakeId = request()->stocktake_id;
        $response = [
            'request' => null,
            'reload' => false,
            'update' => false,
            'update_data' => null,
        ];

        $scans = Scan::where('update_data', 0)
            ->where('stocktake_id', $stocktakeId)
            ->get();

        if ($scans->isNotEmpty()) {
            Scan::whereIn('id', $scans->pluck('id'))->update(['update_data' => 1]);

            $eanArray = array_fill_keys($scans->pluck('ean')->toArray(), true);

            if (request()->q) {
                foreach (request()->q as $processedEan) {
                    if (array_key_exists($processedEan, $eanArray)) {
                        unset($eanArray[$processedEan]);
                    }
                }
            }

            $response['request'] = $eanArray;
            $response['reload'] = !empty($eanArray);
            $response['update'] = true;
        }

        return $response;
    }

    public function getLiveDataCheckState()
    {
        $data = [
            'ean' => request()->ean,
        ];
        return $data;
    }

    public function updateFullPack()
    {
        $validated = request()->validate([
            'id' => 'required|integer',
            'full_pack' => 'required|integer',
            'stocktake' => 'required|integer',
            '_token' => 'required'
        ]);

        $scan = Scan::findOrFail($validated['id']);

        if ($scan->stocktake_id != $validated['stocktake']) {
            return [
                'success' => false,
                'message' => 'Neplatná inventúra'
            ];
        }

        $scan->full_pack = $validated['full_pack'];
        $updated = $scan->save();

        return [
            'success' => $updated,
            'message' => $updated ? 'Úspešne aktualizované' : 'Chyba pri aktualizácii'
        ];
    }

    public function updateWeight()
    {
        $ean = request()->input('ean');
        $cargo = Cargo::where('ean', $ean)->first();

        if (!$cargo) {
            return [
                'success' => false,
                'message' => 'Neplatný EAN'
            ];
        }

        $updates = [];
        $fields = ['weight_full', 'weight_empty', 'weight_tolerance'];

        foreach ($fields as $field) {
            if (request()->filled($field)) {
                $updates[$field] = request()->input($field);
            }
        }

        if (!empty($updates)) {
            $updated = $cargo->update($updates);
            return [
                'success' => $updated,
                'message' => $updated ? 'Úspešne aktualizované' : 'Chyba pri aktualizácii'
            ];
        }

        return [
            'success' => false,
            'message' => 'Chyba'
        ];
    }

    public function deleteScan()
    {
        return [
            'success' => true,
            'message' => 'Produkt bol úspešne odstránený'
        ];
        $validated = request()->validate([
            'scan_id' => 'required|integer',
            'stocktake_id' => 'required|integer'
        ]);

        $scan = Scan::where('id', $validated['scan_id'])
            ->where('stocktake_id', $validated['stocktake_id'])
            ->firstOrFail();

        if ($scan->delete()) {
            return [
                'success' => true,
                'message' => 'Produkt bol úspešne odstránený'
            ];
        }

        return [
            'success' => false,
            'message' => 'Chyba pri odstraňovaní produktu'
        ];
    }

    public function store()
    {
        $user = auth()->user();
        $barId = request()->session()->get('bar');
        $password = hash('sha256', request()->input('password'));
        $now = now();

        $stocktake = Stocktake::create([
            'user_id' => $user->id,
            'bar_id' => $barId,
            'api' => Str::random(16),
            'password' => $password,
            'api_key' => request()->input('password'),
            'open' => 1,
            'created_at' => $now,
        ]);

        if (!$stocktake->id) {
            return false;
        }

        $fullName = trim(request()->input('leader'));
        $nameParts = explode(' ', $fullName);
        $surname = array_pop($nameParts);
        $name = implode(' ', $nameParts);

        $mineUser = StocktakeUser::create([
            'name' => $name,
            'surname' => $surname,
            'api' => $stocktake->id . random_int(0, 99),
            'bar_id' => $barId,
            'user_id' => $user->id,
            'token' => hash('sha256', microtime() . '_' . $name . $surname . random_int(0, 99)),
            'password' => $password,
            'stocktake_id' => $stocktake->id,
            'mine' => 1,
            'created_at' => $now,
        ]);

        $stocktake->update(['mine_user' => $mineUser->id]);

        $usersList = [];
        $stocktakeUsers = request()->input('stocktake_users', []);

        foreach ($stocktakeUsers as $userInput) {
            if (is_numeric($userInput)) {
                $existingUser = StocktakeUser::find($userInput);

                if ($existingUser) {
                    $existingUser->update([
                        'stocktake_id' => $stocktake->id,
                        'api' => $stocktake->id . random_int(0, 99),
                        'updated_at' => $now,
                    ]);
                    $usersList[] = [$userInput];
                    continue;
                }
            }

            $fullName = trim($userInput);
            $nameParts = explode(' ', $fullName);
            $surname = array_pop($nameParts);
            $name = implode(' ', $nameParts);

            $newUser = StocktakeUser::create([
                'name' => $name,
                'surname' => $surname,
                'api' => $stocktake->id . random_int(0, 99),
                'bar_id' => $barId,
                'user_id' => $user->id,
                'token' => hash('sha256', microtime() . '_' . $name . $surname . random_int(0, 99)),
                'password' => $password,
                'stocktake_id' => $stocktake->id,
                'created_at' => $now,
            ]);

            $usersList[] = [$newUser->id];
        }

        $stocktake->update(['users' => json_encode($usersList)]);

        return $stocktake->id;
    }

    public function destroy($id)
    {
        $stocktake = Stocktake::find($id);
        if($stocktake->user_id != auth()->user()->id || $stocktake->bar_id != request()->session()->get('bar')) return false;
        $stocktake->open = 4;

        return $stocktake->save();
    }

    public function closeStocktake()
    {
        $stocktake = Stocktake::with(['scans' => function($query) {
            $query->select(['api', 'ean', 'type', 'weight', 'full_pack', 'stocktake_id', 'add_full_pack', 'stocktake_user_id']);
        }])->find(request()->id);
        if($stocktake->user_id != auth()->user()->id) return false;

        $archiveData = $stocktake->scans->map(function ($scan) {
            return [
                'stocktake_id' => $scan->stocktake_id,
                'scan_data' => $scan->toJson(),
                'archive_date' => now()->toDateString(),
            ];
        })->toArray();

        $inserted = ArchiveScan::insert($archiveData);
        $deleted = false;
        if ($inserted) {
            $deleted = Scan::where('stocktake_id', $stocktake->id)->delete();
        }

        if($deleted){
            $stocktake->open = 3;
            $stocktake->send_mail = auth()->user()->close_stocktake_notification;
            $stocktake->expire = now()->addYear();
            $stocktake->save();
            return true;
        }

        return false;
    }

    public function deleteUser()
    {
        $inv = request()->integer('inv');
        $id = request()->integer('id');

        $inventura = Stocktake::where('id', $inv)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $users = json_decode($inventura->users, true) ?? [];

        if (count($users) <= 1) {
            return 1;
        }

        $filteredUsers = array_filter($users, function($user) use ($id) {
            $userId = is_numeric($user) ? $user : intval($user[0]);
            return $userId != $id;
        });

        $filteredUsers = array_values($filteredUsers);

        try {
            $inventura->update(['users' => json_encode($filteredUsers)]);
            return 0;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return 2;
        }
    }
}
