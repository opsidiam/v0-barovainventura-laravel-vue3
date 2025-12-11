<?php

namespace Modules\User\Database\Seeders;

use App\Models\TutorialOpen;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id = User::factory()->create([
            'name' => 'Test User',
            'email' => 'info@web-place.sk',
            'password' => bcrypt('123'),
            'permission' => 2,
            'licences_category' => 1,
            'email_info' => 'info@web-place.sk',
            'email_info_verify' => 1,
            'email_info_token' => null,
            'email_invoice' => 'info@web-place.sk',
            'email_invoice_verify' => 1,
            'email_invoice_token' => null,
            'close_stocktake_notification' => 1,
            'invoice_name' => 'Test',
            'invoice_surname' => 'User',
            'invoice_company_name' => 'Web-Place s.r.o.',
            'invoice_address' => 'Testovacia 123',
            'invoice_psc' => '12345',
            'invoice_city' => 'Bratislava',
            'invoice_stat' => 'Slovensko',
            'invoice_ico' => '12345678',
            'invoice_dic' => '1234567890',
            'invoice_icdph' => 'SK1234567890',
            'licence_expire' => now()->addDay()
        ]);
        $positions = ['app/bar', 'app/dashboard', 'app/stocktake/create', 'app/item'];

        $rows = array_map(fn ($pos) => [
            'user_id'    => $id->id,
            'position'   => $pos
        ], $positions);

        TutorialOpen::insertOrIgnore($rows);
    }
}
