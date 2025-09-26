<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            HouseOwnerSeeder::class,
            FlatSeeder::class,
            TenantSeeder::class,
            BillCategorySeeder::class,
            BillSeeder::class,
        ]);
    }
}
