<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reports')->insert([
            [
                'user_id' => 1,
                'description' => 'Laporan kerusakan jalan utama.',
                'status' => 'Antri',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'description' => 'Laporan kebocoran pipa air.',
                'status' => 'Dikerjakan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'description' => 'Laporan lampu jalan mati.',
                'status' => 'Outsource',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'description' => 'Laporan perbaikan taman kota.',
                'status' => 'Selesai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'description' => 'Laporan pembersihan got tersumbat.',
                'status' => 'Tidak Terselesaikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
