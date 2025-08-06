<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LearnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('learn')->insert([
            [
                'title' => 'STRIKER: FULL SESSION',
                'description' => 'Striker session with Division I player, Jackson Gould, focusing on a consistent clean contact in front of goal.',
                'thumbnail' => 'backend\images\striker.png',
                'category' => 'POSITION SPECIFIC',
                'details' => 'This course covers various tactical formations and strategies.',
                // 'youtube_link' => 'https://www.youtube.com',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'WHAT TYPE OF CM ARE YOU?',
                'description' => 'James and Mike try to get match fit in three weeks. Partner exercises that you can try with a friend.',
                'thumbnail' => 'backend\images\cm.png',
                'category' => 'POSITION SPECIFIC',
                'details' => 'Analyzing game scenarios and executing strategies.',
                // 'youtube_link' => 'https://www.youtube.com',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'USING DRIVING TO UNDERSTAND SOCCER',
                'description' => 'James and Mike try to get match fit in three weeks. Partner exercises that you can try with a friend.',
                'thumbnail' => 'backend\images\driving.png',
                'category' => 'GENERAL',
                'details' => 'Techniques to stay focused and handle pressure.',
                // 'youtube_link' => 'https://www.youtube.com',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'CENTRAL MIDFIELDER: FULL SESSION',
                'description' => 'Decision making session with Sam Greenburg, focusing on game-like scenarios as a central midfielder.',
                'thumbnail' => 'backend\images\midfielder.png',
                'category' => 'POSITION SPECIFIC',
                'details' => 'Exploring the roots and changes in football over time.',
                // 'youtube_link' => 'https://www.youtube.com',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'THE SUPER MARIO EFFECT',
                'description' => 'Find yourself giving up when failing at the first attempt? The Super Mario Effect may stop it from happening.',
                'thumbnail' => 'backend\images\mario.png',
                'category' => 'MINDSET',
                'details' => 'How to study and counter opponent tactics effectively.',
                // 'youtube_link' => 'https://www.youtube.com/watch?v=example5',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
