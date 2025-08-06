<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'admin',
                'role' => 'admin',
                'email' => 'admin@gmail.com',
                'date_of_birth' => Carbon::now()->subYears(20)->format('d/m/Y'),
                'gender' => null,
                'club' => null,
                'position' => null,
                'preferred_foot' => null,
                'favourite_club' => null,
                'favourite_player' => null,
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'user',
                'role' => 'user',
                'email' => 'user@gmail.com',
                'date_of_birth' => Carbon::now()->subYears(18)->format('d/m/Y'),
                'gender' => 'male',
                'club' => 'Barcelona',
                'position' => 'CF',
                'preferred_foot' => 'left',
                'favourite_club' => 'Barcelona',
                'favourite_player' => 'Messi',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Cristiano Ronaldo',
                'role' => 'user',
                'email' => 'ronaldo@gmail.com',
                'date_of_birth' => Carbon::now()->subYears(16)->format('d/m/Y'),
                'gender' => 'male',
                'club' => 'Al Nassr',
                'position' => 'ST',
                'preferred_foot' => 'right',
                'favourite_club' => 'Real Madrid',
                'favourite_player' => 'Cristiano Ronaldo',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Lionel Messi',
                'role' => 'user',
                'email' => 'messi@gmail.com',
                'date_of_birth' => Carbon::now()->subYears(14)->format('d/m/Y'),
                'gender' => 'male',
                'club' => 'Inter Miami',
                'position' => 'RW',
                'preferred_foot' => 'left',
                'favourite_club' => 'Barcelona',
                'favourite_player' => 'Messi',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Neymar Jr',
                'role' => 'user',
                'email' => 'neymar@gmail.com',
                'date_of_birth' => Carbon::now()->subYears(12)->format('d/m/Y'),
                'gender' => 'male',
                'club' => 'Al Hilal',
                'position' => 'LW',
                'preferred_foot' => 'right',
                'favourite_club' => 'Barcelona',
                'favourite_player' => 'Ronaldinho',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Kevin De Bruyne',
                'role' => 'user',
                'email' => 'debruyne@gmail.com',
                'date_of_birth' => Carbon::now()->subYears(10)->format('d/m/Y'),
                'gender' => 'male',
                'club' => 'Manchester City',
                'position' => 'CM',
                'preferred_foot' => 'right',
                'favourite_club' => 'Manchester City',
                'favourite_player' => 'Zidane',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'Kylian Mbappe',
                'role' => 'user',
                'email' => 'mbappe@gmail.com',
                'date_of_birth' => Carbon::now()->subYears(8)->format('d/m/Y'),
                'gender' => 'male',
                'club' => 'PSG',
                'position' => 'ST',
                'preferred_foot' => 'right',
                'favourite_club' => 'Real Madrid',
                'favourite_player' => 'Cristiano Ronaldo',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'name' => 'Erling Haaland',
                'role' => 'user',
                'email' => 'haaland@gmail.com',
                'date_of_birth' => Carbon::now()->subYears(6)->format('d/m/Y'),
                'gender' => 'male',
                'club' => 'Manchester City',
                'position' => 'ST',
                'preferred_foot' => 'left',
                'favourite_club' => 'Leeds United',
                'favourite_player' => 'Zlatan Ibrahimovic',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
