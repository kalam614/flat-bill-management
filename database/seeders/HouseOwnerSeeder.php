<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{User, HouseOwner};

class HouseOwnerSeeder extends Seeder
{
    public function run()
    {
        $owner1 = User::where('email', 'owner1@gmail.com')->first();
        HouseOwner::create([
            'user_id' => $owner1->id,
            'phone' => '+8801712345678',
            'address' => 'House #12, Road #5, Dhanmondi, Dhaka',
            'building_name' => 'Shanti Nibas',
            'building_address' => 'Plot #45, Bashundhara R/A, Dhaka 1229',
        ]);

        $owner2 = User::where('email', 'owner2@gmail.com')->first();
        HouseOwner::create([
            'user_id' => $owner2->id,
            'phone' => '+8801812345679',
            'address' => 'Holding #23, Station Road, Chattogram',
            'building_name' => 'Nirala Heights',
            'building_address' => 'Lake View Road, Agrabad, Chattogram 4100',
        ]);
    }
}
