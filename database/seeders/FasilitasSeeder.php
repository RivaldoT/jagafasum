<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fasilitas')->insert([
            [
                'name' => 'Taman Kota',
                'dinas_id' => 1,
                'description' => 'Area hijau untuk umum',
                'fund_source' => 'APBD',
                'image' => 'taman_kota.jpg',
                'status' => 'Baik',
                'luasan' => '120m2',
                'latitude' => -6.2088,
                'longitude' => 106.8456,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gedung Olahraga',
                'dinas_id' => 2,
                'description' => 'Fasilitas olahraga indoor',
                'fund_source' => 'APBN',
                'image' => 'gedung_olahraga.jpg',
                'status' => 'Baik',
                'luasan' => '120m2',
                'latitude' => -7.2504,
                'longitude' => 112.7688,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Perpustakaan Umum',
                'dinas_id' => 3,
                'description' => 'Perpustakaan dengan koleksi buku lengkap',
                'fund_source' => 'Swasta',
                'image' => 'perpustakaan_umum.jpg',
                'status' => 'Baik',
                'luasan' => '120m2',
                'latitude' => -6.9175,
                'longitude' => 107.6191,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Puskesmas',
                'dinas_id' => 2,
                'description' => 'Pusat layanan kesehatan masyarakat',
                'fund_source' => 'APBD',
                'image' => 'puskesmas.jpg',
                'status' => 'Rusak',
                'luasan' => '120m2',
                'latitude' => -7.7956,
                'longitude' => 110.3695,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Balai Desa',
                'dinas_id' => 1,
                'description' => 'Gedung pertemuan warga desa',
                'fund_source' => 'Swasta',
                'image' => 'balai_desa.jpg',
                'status' => 'Baik',
                'luasan' => '120m2',
                'latitude' => -8.3405,
                'longitude' => 115.0920,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
