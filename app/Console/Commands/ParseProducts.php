<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use File;
use Illuminate\Support\Facades\Log;
use Modules\Cargo\Models\Cargo;
use Orchestra\Parser\Xml\Facade as XMLParser;
use SimpleXMLElement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class ParseProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:parse-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = $this->svetNapojovParser('svetnapojov.xml');
        $this->productsParser($products, 'svetnapojov');
    }

    public function productsParser(array $products, string $source): int
    {
        $prepared = [];
        foreach ($products as $item) {
            $ean = $this->normEan($item['ean'] ?? '');
            if ($ean === '') continue;

            $params = is_array($item['param'] ?? null) ? $item['param'] : [];

            $prepared[$ean] = [
                'name'      => (string)($item['name'] ?? ''),
                'price'     => is_numeric($item['price'] ?? null) ? (float)$item['price'] : null,
                'params'    => $params,
                'source'    => $source,
                'synced_at' => now()->toIso8601String(),
            ];
        }

        if (!$prepared) {
            Log::error('Žiadne validné EANy v dodaných dátach.');
            return 0;
        }

        $eans = array_keys($prepared);

        $existing = Cargo::query()
            ->whereIn('ean', $eans)
            ->get(['id','ean','parsed_data','name','volume','alcohol'])
            ->keyBy(fn($c) => $this->normEan($c->ean));

        $toInsert = [];
        foreach ($eans as $ean) {
            if (!isset($existing[$ean])) {
                $inc = $prepared[$ean];

                $volumeMl  = 0;
                $alcoholPc = 0.0;
                if (!empty($inc['params'])) {
                    if (isset($inc['params']['Objem']) && is_numeric($inc['params']['Objem'])) {
                        $volumeMl = (int) round((float)$inc['params']['Objem'] * 1000);
                    }
                    if (isset($inc['params']['Alk. %']) && is_numeric($inc['params']['Alk. %'])) {
                        $alcoholPc = (float) $inc['params']['Alk. %'];
                    }
                }

                $toInsert[] = [
                    'name'        => $inc['name'] ?: 'Neznámy produkt',
                    'ean'         => $ean,
                    'brand'       => null,
                    'type'        => $volumeMl ? 1 : 0,
                    'volume'      => $volumeMl,
                    'alcohol'     => $alcoholPc,
                    'parsed_data' => json_encode([
                        'external' => [ $source => $inc ],
                        'name'           => $inc['name'],
                        'price'          => $inc['price'],
                        'params'         => $inc['params'],
                        'last_source'    => $source,
                        'last_synced_at' => $inc['synced_at'],
                    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    'created_by_parser' => 1,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];
            }
        }

        DB::transaction(function () use (&$existing, $toInsert) {
            foreach (array_chunk($toInsert, 1000) as $chunk) {
                DB::table('cargos')->insertOrIgnore($chunk);
            }

            if (!empty($toInsert)) {
                $insertedEans = array_column($toInsert, 'ean');
                $fresh = Cargo::query()
                    ->whereIn('ean', $insertedEans)
                    ->get(['id','ean','parsed_data'])
                    ->keyBy(fn($c) => $this->normEan($c->ean));

                foreach ($fresh as $k => $v) {
                    $existing[$k] = $v;
                }
            }
        });

        $updates = [];
        foreach ($existing as $normEan => $cargo) {
            if (!isset($prepared[$normEan])) continue;

            if (!is_null($cargo->parsed_data)) {
                continue;
            }

            $inc = $prepared[$normEan];

            $merged = [
                'external' => [ $source => $inc ],
                'name'           => $inc['name'],
                'price'          => $inc['price'],
                'params'         => $inc['params'],
                'last_source'    => $source,
                'last_synced_at' => $inc['synced_at'],
            ];

            $updates[] = [
                'id'          => $cargo->id,
                'parsed_data' => json_encode($merged, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                'updated_at'  => now(),
            ];
        }

        if ($updates) {
            DB::transaction(function () use ($updates) {
                foreach (array_chunk($updates, 500) as $chunk) {
                    foreach ($chunk as $row) {
                        DB::table('cargos')
                            ->where('id', $row['id'])
                            ->whereNull('parsed_data')
                            ->update([
                                'parsed_data' => $row['parsed_data'],
                                'updated_at'  => $row['updated_at'],
                            ]);
                    }
                }
            });
        }

        Log::info('Vložené nové: ' . count($toInsert) . ', parsed_data doplnené (NULL->set): ' . count($updates));
        return count($toInsert) + count($updates);
    }


    function normEan(?string $x): string {
        return preg_replace('/\D+/', '', (string)$x ?? '');
    }

    public function svetNapojovParser($target)
    {
    $this->download('https://www.svetnapojov.sk/heureka.xml', $target);
        $filePath = public_path('feeds' . DIRECTORY_SEPARATOR . $target);

        if (File::exists($filePath)) {
            $data = [];
            $xmlString = File::get($filePath);
            $xml = new SimpleXMLElement($xmlString);

            foreach ($xml as $product) {
                $params = [];
                foreach ($product->PARAM as $p) {
                    $name = trim((string) $p->PARAM_NAME);
                    $val  = trim((string) $p->VAL);
                    if ($name !== '') {
                        $params[$name] = $val;
                    }
                }
                $data[] = [
                    'name'  => trim((string) $product->PRODUCTNAME),
                    'price' => trim((string) $product->PRICE_VAT),
                    'ean'   => trim((string) $product->EAN),
                    'param' => $params,
                ];
            }

            $pathInfo = pathinfo($filePath);
            $backupName = $pathInfo['filename'] . '_' . now()->format('Y-m-d') . '.' . $pathInfo['extension'];
            $backupPath = $pathInfo['dirname'] . DIRECTORY_SEPARATOR . $backupName;

            File::move($filePath, $backupPath);

            return $data;
        }

        return [];
    }


    public function download($url, $target)
    {
        $timeout = 60;

        Log::info("Sťahujem: {$url}");
        try {
            $resp = Http::timeout($timeout)
                ->retry(2, 500)
                ->withHeaders([
                    'User-Agent' => 'LaravelXMLFetcher/1.0 (+https://your-domain)',
                    'Accept'     => 'application/xml,text/xml;q=0.9,*/*;q=0.8',
                ])->get($url);
        } catch (\Throwable $e) {
            Log::error('Chyba pri sťahovaní: '.$e->getMessage());
            return self::FAILURE;
        }

        if (!$resp->ok()) {
            Log::error('Neúspešné HTTP: '.$resp->status());
            return self::FAILURE;
        }

        $body = (string) $resp->body();

        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($body);
        if ($xml === false) {
            Log::error('Stiahnutý obsah nie je platné XML.');
            foreach (libxml_get_errors() as $err) {
                $this->line(trim($err->message));
            }
            libxml_clear_errors();
            return self::FAILURE;
        }
        libxml_clear_errors();

        $publicDir = public_path();
        $destPath  = $publicDir.DIRECTORY_SEPARATOR.'/feeds/'.$target;
        $dir       = dirname($destPath);

        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $tmpPath = $destPath.'.tmp';
        if (file_put_contents($tmpPath, $body) === false) {
            Log::error('Zápis do dočasného súboru zlyhal.');
            return self::FAILURE;
        }

        if (File::exists($destPath)) {
            File::delete($destPath);
        }
        if (!@rename($tmpPath, $destPath)) {
            Log::error('Premenovanie do cieľového súboru zlyhalo.');
            return self::FAILURE;
        }

        $publicUrl = url('/'.ltrim('feeds/'.$target, '/'));

        Log::info('Hotovo. |Cesta: '.$destPath .' |URL: '.$publicUrl);

        return $destPath;
    }
}
