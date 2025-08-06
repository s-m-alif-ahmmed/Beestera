<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'type' => 'Learn',
                'name' => "GENERAL",
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Learn',
                'name' => "MINDSET",
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Train',
                'name' => "EXERCISES",
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Train',
                'name' => "CHALLENGES",
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Train',
                'name' => "TECHNICAL",
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Train',
                'name' => "PHYSICAL",
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Learn',
                'name' => "POSITION SPECIFIC",
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Learn',
                'name' => "GUIDEBOOKS",
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Learn',
                'name' => "SESSIONS",
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Learn',
                'name' => "LESSONS",
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Learn',
                'name' => "TECHNIQUES",
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

}
