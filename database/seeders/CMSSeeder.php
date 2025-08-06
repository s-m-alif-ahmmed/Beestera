<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CMSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('cms')->insert([
            [
                'title' => 'PLAYER CHALLENGES',
                'description' => "Three progressive challenge levels (Base, Build, Boost) centered on this week's player development focus.",
                'picture' => 'backend\images\challenge.png',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'LEADERBOARD',
                'description' => "Your greatest competition is yourself, but let's see how you stack up against other Beestera members.",
                'picture' => 'backend\images\leaderboard.png',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'ROADMAP',
                'description' => 'Track your progress step-by-step with our roadmap, designed to guide you through the journey to mastering each skill.',
                'picture' => 'backend\images\roadmap.png',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'ACHIEVEMENTS',
                'description' => 'Celebrate your progress each week by collecting achievements in your personal trophy cabinet.',
                'picture' => 'backend\images\achievement.png',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'title' => 'CONTROL',
                'description' => "Build a strong mindset with exercises and insights that strengthen resilience, and confidence, on and off the field.",
                'picture' => 'backend\images\control.png',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'title' => 'SOLO TRAINING',
                'description' => "Just you and the ball — build your skills and develop true mastery with every touch.",
                'picture' => 'backend\images\solo-training.png',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'title' => 'PARTNER TRAINING',
                'description' => "Train with a partner to boost intensity, bring out a competitive edge, and keep each other accountable.",
                'picture' => 'backend\images\partner-training.png',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'title' => 'CHALLENGES',
                'description' => "Master your ability on the ball, with footwork with drills designed to improve your control, and confidence.",
                'picture' => 'backend\images\challenges.png',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'title' => 'MINDSET',
                'description' => "Build a strong mindset with exercises and insights that strengthen resilience, and confidence, on and off the field.",
                'picture' => 'backend\images\mindset.png',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'title' => 'POSITION-SPECIFIC',
                'description' => "Master your role on the field with resources designed to help you understand the skill-sets for that position.",
                'picture' => 'backend\images\position-specific.png',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'title' => 'GUIDEBOOKS',
                'description' => "5-10 minute tutorials that break down concepts to help boost your performance in the weekly challenges.",
                'picture' => 'backend\images\guidebooks.png',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'title' => 'GENERAL',
                'description' => "Access all resources in the Learn Portal, designed for players, parents, and coaches on their unique journey.",
                'picture' => 'backend\images\general.png',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
