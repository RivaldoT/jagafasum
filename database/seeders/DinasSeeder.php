<?php

namespace Database\Seeders;

use App\Models\Dinas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DinasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dinas::create([
            'name' => 'Dinas Pekerjaan Umum Kota Jakarta',
            'city_id' => 1,
            'address' => 'Jl. Merdeka No.1, Kota Jakarta'
        ]);

        Dinas::create([
            'name' => 'Dinas Pekerjaan Umum Bandung',
            'city_id' => 2,
            'address' => 'Jl. Pahlawan No.10, Bandung'
        ]);

        Dinas::create([
            'name' => 'Dinas Pekerjaan Umum Surabaya',
            'city_id' => 3,
            'address' => 'Jl. Soekarno-Hatta No.50, Surabaya'
        ]);
    }
}
