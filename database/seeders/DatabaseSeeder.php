<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            \Modules\User\Database\Seeders\UserDatabaseSeeder::class,
            \Modules\Bar\Database\Seeders\BarDatabaseSeeder::class,
            \Modules\License\Database\Seeders\LicenseDatabaseSeeder::class,
            \Modules\Product\Database\Seeders\ProductDatabaseSeeder::class,
            \Modules\Cargo\Database\Seeders\CargoDatabaseSeeder::class,
        ]);
    }
}
