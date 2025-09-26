<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{HouseOwner, Flat};

class FlatSeeder extends Seeder
{
    public function run()
    {
        $houseOwners = HouseOwner::all();

        foreach ($houseOwners as $index => $houseOwner) {
            // Create 5 flats for each house owner
            for ($i = 1; $i <= 5; $i++) {
                Flat::create([
                    'house_owner_id' => $houseOwner->id,
                    'flat_number' => ($index + 1) . '0' . $i,
                    'flat_owner_name' => 'Owner ' . ($index + 1) . '-' . $i,
                    'flat_owner_phone' => '+123456789' . $index . $i,
                    'flat_owner_email' => 'flatowner' . ($index + 1) . $i . '@example.com',
                    'monthly_rent' => rand(800, 2000),
                    'notes' => 'Sample flat ' . $i . ' for ' . $houseOwner->building_name,
                    'is_occupied' => $i <= 3, // First 3 flats are occupied
                ]);
            }
        }
    }
}
