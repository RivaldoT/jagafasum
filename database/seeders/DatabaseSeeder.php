<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CitiesSeeder::class,
            DinasSeeder::class,
            CategoriesSeeder::class,
            UsersSeeder::class,
            FasilitasSeeder::class,
            ReportsSeeder::class,
            HistoryReportsSeeder::class,
            ReportFasilitasSeeder::class,
            FasilitasCategorySeeder::class,
        ]);
    }
}
