<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyTypesTableSeeder extends Seeder
{
    public function run()
    {
        $types = [
            ['type_name' => 'Apartment'],
            ['type_name' => 'House'],
            ['type_name' => 'Villa'],
            ['type_name' => 'Condo'],
            ['type_name' => 'Townhouse'],
            ['type_name' => 'Land'],
            ['type_name' => 'Commercial'],
            ['type_name' => 'Office'],
            ['type_name' => 'Retail'],
            ['type_name' => 'Industrial']
        ];

        DB::table('property_types')->insert($types);
    }
} 