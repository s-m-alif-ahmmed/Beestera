<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('train')->insert([
            [
                'title' => 'FULL SESSION: DAY ONE',
                'description' => 'James and Mike try to get match fit in three weeks. Partner exercises that you can try with a friend.',
                'thumbnail' => 'backend\images\dayone.png',
                'category' => 'PARTNER',
                'details' => 'This course covers various tactical formations and strategies.',
                // 'youtube_link' => 'https://www.youtube.com',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'FIRST TO 100',
                'description' => 'A partner challenge that works on concentration when juggling, incorporating a fitness component.',
                'thumbnail' => 'backend\images\firstto100.png',
                'category' => 'CHALLENGE',
                'details' => 'Analyzing game scenarios and executing strategies.',
                // 'youtube_link' => 'https://www.youtube.com',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'RANDALL’S ISLAND WORKOUT',
                'description' => 'A 12 minute technical session with Coach Drew at Randall’s Island, in the heart of Manhattan.',
                'thumbnail' => 'backend\images\workout.png',
                'category' => 'TECHNICAL',
                'details' => 'Techniques to stay focused and handle pressure.',
                // 'youtube_link' => 'https://www.youtube.com',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'TRAINING IN NYC',
                'description' => 'A 16 minute workout with Coach James, overlooking the Manhattan skyline.',
                'thumbnail' => 'backend\images\training.png',
                'category' => 'TECHNICAL',
                'details' => 'Exploring the roots and changes in football over time.',
                // 'youtube_link' => 'https://www.youtube.com',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'DIAMOND FOOTWORK',
                'description' => 'A 16 minute workout with Coach James, overlooking the Manhattan skyline.',
                'thumbnail' => 'backend\images\footwork.png',
                'category' => 'TECHNICAL',
                'details' => 'How to study and counter opponent tactics effectively.',
                // 'youtube_link' => 'https://www.youtube.com',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
