<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->insert([
            [
                'name' => 'Jakarta',
                'province' => 'DKI Jakarta',
                'city' => 'Central Jakarta',
            ],
            [
                'name' => 'Bandung',
                'province' => 'West Java',
                'city' => 'Bandung',
            ],
            [
                'name' => 'Surabaya',
                'province' => 'East Java',
                'city' => 'Surabaya',
            ],
            [
                'name' => 'Medan',
                'province' => 'North Sumatra',
                'city' => 'Medan',
            ],
            [
                'name' => 'Makassar',
                'province' => 'South Sulawesi',
                'city' => 'Makassar',
            ],
        ]);
    }
}
