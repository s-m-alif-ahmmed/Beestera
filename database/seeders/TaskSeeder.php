<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            [
                'title' => 'Balance',
                'description' => "Balance is the most underrated and undertrained aspect of technical development, yet it forms the foundation of every action on the field—passing, shooting, and dribbling are all performed while standing on one leg. These three challenges focus on developing your ability to control the ball with different surfaces, all while focusing on the position of your plant foot to help change direction. By mastering balance, you'll help your movement efficiency and maintain control even in high-pressure moments.",
                'starting_date' => '2025-01-01',
                'ending_date' => '2025-01-07',
                'achievement' => 'Balance',
                'person_focus' => 'Resilience',
                'person_focus_description' => 'Resilience means getting up every time you fall.',
                'player_focus' => 'Movement',
                'player_focus_description' => 'How to shift the body or parts of it to a new position, both with or without the ball.',
                'phase' => 'Phase 1',
                'thumbnail' => 'task1-thumbnail.jpg',
                'base_video' => 'task1-video.mp4',
                'build_video' => 'task1-video.mp4',
                'boost_video' => 'task1-video.mp4',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Feints',
                'description' => "Deception is a key skill in the game, and feints are one of the most effective ways to throw off your opponent. These challenges focus on your ability to sell the fake convincingly, combining upper-body movement with an exaggerated step that not only deceives the defender, but provides a strong base to push from. The goal is to unbalance your defender by creating space with your body and taking that space once they’re off-balance.",
                'starting_date' => '2025-01-08',
                'ending_date' => '2025-01-14',
                'achievement' => 'Feints',
                'person_focus' => 'Resilience',
                'person_focus_description' => 'Resilience means getting up every time you fall.',
                'player_focus' => 'Movement',
                'player_focus_description' => 'How to shift the body or parts of it to a new position, both with or without the ball.',
                'phase' => 'Phase 1',
                'thumbnail' => 'task2-thumbnail.jpg',
                'base_video' => 'task1-video.mp4',
                'build_video' => 'task1-video.mp4',
                'boost_video' => 'task1-video.mp4',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Scissors',
                'description' => "Being able to use your body to create space when on the ball is extremely important, and the scissor is one of the most common moves that is taught to create that space. These three challenges work on your ability to use all of your body to sell the move, and not just what you do with the ball at your feet. Once the move has been completed, we’re working on an acceleration touch to take that new space.",
                'starting_date' => '2025-01-15',
                'ending_date' => '2025-01-21',
                'achievement' => 'Scissors',
                'person_focus' => 'Accountability',
                'person_focus_description' => 'Be honest with yourself about what you need to work on.',
                'player_focus' => 'Movement',
                'player_focus_description' => 'Fitness',
                'phase' => 'Phase 2',
                'thumbnail' => 'task3-thumbnail.jpg',
                'base_video' => 'task1-video.mp4',
                'build_video' => 'task1-video.mp4',
                'boost_video' => 'task1-video.mp4',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Step Past',
                'description' => "Also known as the ‘Frenkie de Jong’ move, the step past is a really effective way to turn with the ball while protecting it from your opponent. To perform the step past, you’ll need an aggressive step past the safe side of the ball, a low body lean over it, and a quick explosion into new space. These three challenges begin with mastering the move on a static ball and progress to incorporating it into a moving ball with a challenging combination.",
                'starting_date' => '2025-01-22',
                'ending_date' => '2025-01-28',
                'achievement' => 'Step Past',
                'person_focus' => 'Accountability',
                'person_focus_description' => 'Be honest with yourself about what you need to work on.',
                'player_focus' => 'Movement',
                'player_focus_description' => 'Fitness',
                'phase' => 'Phase 2',
                'thumbnail' => 'task4-thumbnail.jpg',
                'base_video' => 'task1-video.mp4',
                'build_video' => 'task1-video.mp4',
                'boost_video' => 'task1-video.mp4',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Stepover',
                'description' => "The stepover is another great way to turn away from a defender while keeping the ball protected. Similar to the step past, the stepover involves stepping over the other side of the ball, and the same principles apply—an exaggerated step, a deliberate body lean, and an explosive push into new space. These three challenges focus on the timing of the step over, and being able to exit the move with different changes of pace.",
                'starting_date' => '2025-01-29',
                'ending_date' => '2025-02-04',
                'achievement' => 'Stepovers',
                'person_focus' => 'Sportsmanship',
                'person_focus_description' => 'Celebrate your skill, but always respect your opponents',
                'player_focus' => 'Movement',
                'player_focus_description' => 'Fitness',
                'phase' => 'Phase 3',
                'thumbnail' => 'task5-thumbnail.jpg',
                'base_video' => 'task1-video.mp4',
                'build_video' => 'task1-video.mp4',
                'boost_video' => 'task1-video.mp4',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Combinations',
                'description' => "Deception is a key skill in the game, and feints are one of the most effective ways to throw off your opponent. These challenges focus on your ability to sell the fake convincingly, combining upper-body movement with an exaggerated step that not only deceives the defender, but provides a strong base to push from. The goal is to unbalance your defender by creating space with your body and taking that space once they’re off-balance.",
                'starting_date' => '2025-02-05',
                'ending_date' => '2025-02-11',
                'achievement' => 'Combinations',
                'person_focus' => 'Sportsmanship',
                'person_focus_description' => 'Celebrate your skill, but always respect your opponents',
                'player_focus' => 'Movement',
                'player_focus_description' => 'Fitness',
                'phase' => 'Phase 4',
                'thumbnail' => 'task6-thumbnail.jpg',
                'base_video' => 'task1-video.mp4',
                'build_video' => 'task1-video.mp4',
                'boost_video' => 'task1-video.mp4',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

}
