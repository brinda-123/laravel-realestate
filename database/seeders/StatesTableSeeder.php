<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesTableSeeder extends Seeder
{
    public function run()
    {
        $states = [
            ['state_name' => 'Alabama'],
            ['state_name' => 'Alaska'],
            ['state_name' => 'Arizona'],
            ['state_name' => 'Arkansas'],
            ['state_name' => 'California'],
            ['state_name' => 'Colorado'],
            ['state_name' => 'Connecticut'],
            ['state_name' => 'Delaware'],
            ['state_name' => 'Florida'],
            ['state_name' => 'Georgia'],
            ['state_name' => 'Hawaii'],
            ['state_name' => 'Idaho'],
            ['state_name' => 'Illinois'],
            ['state_name' => 'Indiana'],
            ['state_name' => 'Iowa'],
            ['state_name' => 'Kansas'],
            ['state_name' => 'Kentucky'],
            ['state_name' => 'Louisiana'],
            ['state_name' => 'Maine'],
            ['state_name' => 'Maryland'],
            ['state_name' => 'Massachusetts'],
            ['state_name' => 'Michigan'],
            ['state_name' => 'Minnesota'],
            ['state_name' => 'Mississippi'],
            ['state_name' => 'Missouri'],
            ['state_name' => 'Montana'],
            ['state_name' => 'Nebraska'],
            ['state_name' => 'Nevada'],
            ['state_name' => 'New Hampshire'],
            ['state_name' => 'New Jersey'],
            ['state_name' => 'New Mexico'],
            ['state_name' => 'New York'],
            ['state_name' => 'North Carolina'],
            ['state_name' => 'North Dakota'],
            ['state_name' => 'Ohio'],
            ['state_name' => 'Oklahoma'],
            ['state_name' => 'Oregon'],
            ['state_name' => 'Pennsylvania'],
            ['state_name' => 'Rhode Island'],
            ['state_name' => 'South Carolina'],
            ['state_name' => 'South Dakota'],
            ['state_name' => 'Tennessee'],
            ['state_name' => 'Texas'],
            ['state_name' => 'Utah'],
            ['state_name' => 'Vermont'],
            ['state_name' => 'Virginia'],
            ['state_name' => 'Washington'],
            ['state_name' => 'West Virginia'],
            ['state_name' => 'Wisconsin'],
            ['state_name' => 'Wyoming']
        ];

        DB::table('states')->insert($states);
    }
} 