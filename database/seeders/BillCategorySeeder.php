<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{HouseOwner, BillCategory};

class BillCategorySeeder extends Seeder
{
    public function run()
    {
        $houseOwners = HouseOwner::all();
        $categories = [
            ['name' => 'Electricity', 'description' => 'Monthly electricity bill', 'default_amount' => 150.00],
            ['name' => 'Gas Bill', 'description' => 'Monthly gas consumption', 'default_amount' => 80.00],
            ['name' => 'Water Bill', 'description' => 'Monthly water usage', 'default_amount' => 50.00],
            ['name' => 'Utility Charges', 'description' => 'Maintenance and utility charges', 'default_amount' => 100.00],
            ['name' => 'Internet', 'description' => 'High-speed internet connection', 'default_amount' => 60.00],
        ];

        foreach ($houseOwners as $houseOwner) {
            foreach ($categories as $category) {
                BillCategory::withoutGlobalScopes()->create([
                    'house_owner_id' => $houseOwner->id,
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'default_amount' => $category['default_amount'],
                    'is_active' => true,
                ]);
            }
        }
    }
}
