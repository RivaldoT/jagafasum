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
                'manager' => 'Dinas Pertamanan',
                'fund_source' => 'APBD',
                'location' => DB::raw("ST_PointFromText('POINT(106.827153 6.175110)')"),
                'image' => 'taman_kota.jpg',
                'status' => 'Baik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gedung Olahraga',
                'dinas_id' => 2,
                'description' => 'Fasilitas olahraga indoor',
                'manager' => 'Dinas Pemuda dan Olahraga',
                'fund_source' => 'APBN',
                'location' => DB::raw("ST_PointFromText('POINT(107.609810 6.914744)')"),
                'image' => 'gedung_olahraga.jpg',
                'status' => 'Baik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Perpustakaan Umum',
                'dinas_id' => 3,
                'description' => 'Perpustakaan dengan koleksi buku lengkap',
                'manager' => 'Dinas Perpustakaan',
                'fund_source' => 'Swasta',
                'location' => DB::raw("ST_PointFromText('POINT(112.739807 -7.249171)')"),
                'image' => 'perpustakaan_umum.jpg',
                'status' => 'Baik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Puskesmas',
                'dinas_id' => 2,
                'description' => 'Pusat layanan kesehatan masyarakat',
                'manager' => 'Dinas Kesehatan',
                'fund_source' => 'APBD',
                'location' => DB::raw("ST_PointFromText('POINT(98.672222 3.589665)')"),
                'image' => 'puskesmas.jpg',
                'status' => 'Rusak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Balai Desa',
                'dinas_id' => 1,
                'description' => 'Gedung pertemuan warga desa',
                'manager' => 'Kepala Desa',
                'fund_source' => 'Swasta',
                'location' => DB::raw("ST_PointFromText('POINT(119.412697 -5.135399)')"),
                'image' => 'balai_desa.jpg',
                'status' => 'Baik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
