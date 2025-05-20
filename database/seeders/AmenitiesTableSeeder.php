<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AmenitiesTableSeeder extends Seeder
{
    public function run()
    {
        $amenities = [
            ['amenitis_name' => 'Swimming Pool'],
            ['amenitis_name' => 'Gym'],
            ['amenitis_name' => 'Parking'],
            ['amenitis_name' => 'Garden'],
            ['amenitis_name' => 'Security'],
            ['amenitis_name' => 'Elevator'],
            ['amenitis_name' => 'Air Conditioning'],
            ['amenitis_name' => 'Central Heating'],
            ['amenitis_name' => 'High-Speed Internet'],
            ['amenitis_name' => 'Pet Friendly'],
            ['amenitis_name' => 'Balcony'],
            ['amenitis_name' => 'Fireplace'],
            ['amenitis_name' => 'Storage'],
            ['amenitis_name' => 'Laundry']
        ];

        DB::table('amenities')->insert($amenities);
    }
} 