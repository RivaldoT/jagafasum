<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'Pimpinan',
                'address' => 'Jl. Merdeka No. 1',
                'city_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'Staff',
                'address' => 'Jl. Kartini No. 2',
                'city_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alice Johnson',
                'email' => 'alice.johnson@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'Warga',
                'address' => 'Jl. Diponegoro No. 3',
                'city_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bob Brown',
                'email' => 'bob.brown@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'Staff',
                'address' => 'Jl. Gatot Subroto No. 4',
                'city_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Charlie White',
                'email' => 'charlie.white@example.com',
                'password' => Hash::make('12345678'),
                'role' => 'Warga',
                'address' => 'Jl. Sudirman No. 5',
                'city_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
