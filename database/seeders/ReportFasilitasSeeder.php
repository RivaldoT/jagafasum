<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportFasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('report_fasilitas')->insert([
            [
                'report_id' => 1,
                'fasilitas_id' => 1,
            ],
            [
                'report_id' => 1,
                'fasilitas_id' => 2,
            ],
            [
                'report_id' => 2,
                'fasilitas_id' => 3,
            ],
            [
                'report_id' => 3,
                'fasilitas_id' => 1,
            ],
            [
                'report_id' => 4,
                'fasilitas_id' => 4,
            ],
        ]);
    }
}
