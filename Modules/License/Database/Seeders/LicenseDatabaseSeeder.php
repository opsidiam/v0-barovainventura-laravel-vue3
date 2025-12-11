<?php

namespace Modules\License\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\License\Models\License;

class LicenseDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        License::insert([
            [
                'id' => 1,
                'name' => 'Plný prístup (30 dní)',
                'price' => '50',
                'category' => 1,
                'time' => 2592000,
                'show' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 2,
                'name' => 'Plný prístup (30 dní)',
                'price' => '30',
                'category' => 2,
                'time' => 2592000,
                'show' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 3,
                'name' => 'Plný prístup (30 dní)',
                'price' => '20',
                'category' => 3,
                'time' => 2592000,
                'show' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 4,
                'name' => 'Plný prístup (30 dní)',
                'price' => '10',
                'category' => 4,
                'time' => 2592000,
                'show' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 5,
                'name' => 'Plný prístup (180 dní)',
                'price' => '300',
                'category' => 1,
                'time' => 15552000,
                'show' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 6,
                'name' => 'Plný prístup (180 dní)',
                'price' => '180',
                'category' => 2,
                'time' => 15552000,
                'show' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 7,
                'name' => 'Plný prístup (180 dní)',
                'price' => '120',
                'category' => 3,
                'time' => 15552000,
                'show' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 8,
                'name' => 'Plný prístup (180 dní)',
                'price' => '60',
                'category' => 4,
                'time' => 15552000,
                'show' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 9,
                'name' => 'Plný prístup (360 dní)',
                'price' => '600',
                'category' => 1,
                'time' => 31104000,
                'show' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 10,
                'name' => 'Plný prístup (360 dní)',
                'price' => '360',
                'category' => 2,
                'time' => 31104000,
                'show' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 11,
                'name' => 'Plný prístup (360 dní)',
                'price' => '240',
                'category' => 3,
                'time' => 31104000,
                'show' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 12,
                'name' => 'Plný prístup (360 dní)',
                'price' => '120',
                'category' => 4,
                'time' => 31104000,
                'show' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id' => 13,
                'name' => 'Plán na mieru',
                'price' => '190',
                'category' => 0,
                'time' => 2592000,
                'show' => 0,
                'created_at' => '2023-02-11 14:57:58',
                'updated_at' => '2023-02-11 14:57:58'
            ],
            [
                'id' => 14,
                'name' => 'Plán na mieru',
                'price' => '190',
                'category' => 0,
                'time' => 2592000,
                'show' => 0,
                'created_at' => '2023-02-11 15:15:13',
                'updated_at' => '2023-02-11 15:15:13'
            ],
            [
                'id' => 15,
                'name' => 'Plán na mieru',
                'price' => '190',
                'category' => 0,
                'time' => 2592000,
                'show' => 0,
                'created_at' => '2023-02-11 15:15:44',
                'updated_at' => '2023-02-11 15:15:44'
            ]
        ]);
    }
}
