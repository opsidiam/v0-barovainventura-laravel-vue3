<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\Product;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'id' => 1,
                'name' => 'Bezdrôtový skener pbs-wx7 bluetooth',
                'description' => '',
                'short_description' => 'PBS-WX7 Bluetooth skener je bezdrôtový typ skenera. Funguje prostredníctvom technológie Bluetooth, čo umožňuje pohodlné a flexibilné používanie bez obmedzenia káblom. Skener dokáže načítať 1D, 2D a QR čiarové kódy, čím podporuje široké spektrum štandardov, vrátane EAN a Data Matrix. Vyznačuje sa vysokou presnosťou a rýchlosťou skenovania, čo ho robí ideálnym pre rôzne profesionálne aplikácie.',
                'price' => 80,
                'img' => 'https://barovainventura.sk/img/skener1.jpg',
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 2,
                'name' => 'Skener Maxxo SL2DUS laser scanner 2D',
                'description' => '',
                'short_description' => 'Maxxo SL2DUS laser scanner 1D & 2D & QR je Laserové typ skenera. To znamená, že funguje na princípe vysielania a prijímania odrážaného laserového lúča. Kladom tejto metódy je jednoduchá konštrukcia alebo možnosť vizuálneho zamerania lasera. Vie načítať 1D, 2D a QR čiarové kódy, tzn. rôzne štandardy jednorozmerných čiarových kódov Dokáže snímať 1D, 2D a QR kódy, teda nielen klasické čiarové kódy (napr. EAN), ale aj kódy Data Matrix pri rýchlosti 200 skenov/s skenov za sekundu.',
                'price' => 80,
                'img' => 'https://barovainventura.sk/img/skener2.jpg',
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 3,
                'name' => 'Digitálna váha BI V2',
                'description' => '',
                'short_description' => 'Na digitálnych váhach BI V2 môžete vážiť produkty do hmotnosti až 5 kg. Vďaka kompaktným rozmerom sa vojdú na každý stôl a do väčšiny zásuviek. <br><small><b style="color:red">!!Váha nie je úradne overená (ciachovaná)!!</b><br>Zariadenia má výhradne informatívny charakter</small>',
                'price' => 120,
                'img' => 'https://barovainventura.sk/img/vaha2.jpeg',
                'created_at' => null,
                'updated_at' => null
            ],
        ]);
    }
}
