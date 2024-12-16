<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FasilitasCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fasilitas_has_category')->insert([
            [
                'fasilitas_id' => 1,
                'category_id' => 1,
            ],
            [
                'fasilitas_id' => 1,
                'category_id' => 2,
            ],
            [
                'fasilitas_id' => 2,
                'category_id' => 3,
            ],
            [
                'fasilitas_id' => 3,
                'category_id' => 1,
            ],
            [
                'fasilitas_id' => 4,
                'category_id' => 4,
            ],
        ]);
    }
}
