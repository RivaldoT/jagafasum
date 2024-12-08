<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Elektronik',
                'description' => 'Produk-produk elektronik seperti TV, AC, dan lainnya.',
            ],
            [
                'name' => 'Pakaian',
                'description' => 'Kategori pakaian seperti baju, celana, dan jaket.',
            ],
            [
                'name' => 'Peralatan Rumah Tangga',
                'description' => 'Alat-alat rumah tangga seperti piring, gelas, dan sapu.',
            ],
            [
                'name' => 'Kesehatan',
                'description' => 'Produk kesehatan seperti masker, obat-obatan, dan alat medis.',
            ],
            [
                'name' => 'Olahraga',
                'description' => 'Peralatan olahraga seperti bola, raket, dan sepatu olahraga.',
            ],
        ]);
    }
}
