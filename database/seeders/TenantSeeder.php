<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{HouseOwner, Tenant};

class TenantSeeder extends Seeder
{
    public function run()
    {
        $houseOwners = HouseOwner::all();

        foreach ($houseOwners as $index => $houseOwner) {
            $occupiedFlats = $houseOwner->flats()->where('is_occupied', true)->get();

            foreach ($occupiedFlats as $flatIndex => $flat) {
                Tenant::withoutGlobalScopes()->create([
                    'name' => 'Tenant ' . ($index + 1) . '-' . ($flatIndex + 1),
                    'email' => 'tenant' . ($index + 1) . ($flatIndex + 1) . '@gmail.com',
                    'phone' => '+987654321' . $index . $flatIndex,
                    'address' => '123 Tenant Street, City, State',
                    'house_owner_id' => $houseOwner->id,
                    'flat_id' => $flat->id,
                    'move_in_date' => now()->subMonths(rand(1, 12)),
                    'is_active' => true,
                ]);
            }
        }
    }
}
