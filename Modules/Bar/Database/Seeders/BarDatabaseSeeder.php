<?php

namespace Modules\Bar\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Bar\Models\Bar;

class BarDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        Bar::firstOrCreate(
            ['name' => 'Golden Pub'],
            [
                'multiple_products' => 1,
                'user_id' => $user->id,
                'address' => 'Hlavná 1',
                'number' => '42',
                'city' => 'Bratislava',
                'country' => 'Slovensko',
                'psc' => '81101',
                'chef' => 'Janko Hraško',
                'phone' => '+421912345678',
            ]
        );
    }
}
