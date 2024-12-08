<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistoryReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('history_reports')->insert([
            [
                'report_id' => 1,
                'updated_by' => 1,
                'status' => 'Antri',
                'note' => 'Laporan baru ditambahkan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'report_id' => 1,
                'updated_by' => 2,
                'status' => 'Dikerjakan',
                'note' => 'Laporan sedang dalam proses perbaikan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'report_id' => 2,
                'updated_by' => 3,
                'status' => 'Outsource',
                'note' => 'Dikerjakan oleh pihak ketiga',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'report_id' => 3,
                'updated_by' => 4,
                'status' => 'Selesai',
                'note' => 'Laporan selesai dikerjakan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'report_id' => 4,
                'updated_by' => 5,
                'status' => 'Tidak Terselesaikan',
                'note' => 'Tidak dapat diselesaikan karena alasan tertentu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
