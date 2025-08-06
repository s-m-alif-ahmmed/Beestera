<?php

namespace App\Http\Controllers\Api\Achievement;

use App\Enums\SubscriptionPlanEnum;
use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\PlayerAchievement;
use App\Models\Task;
use Laravelcm\Subscriptions\Models\Plan;

class AchievementController extends Controller
{
    use ApiResponse;

    public function movement_index()
    {
        $data = PlayerAchievement::where('user_id', auth()->id())->get();

        if ($data->isEmpty()) {
            return $this->ok('No Achievement Found');
        }

        $taskTitles = Task::whereIn('id', $data->pluck('task_id'))->pluck('achievement');
        $movement = Achievement::whereIn('title', $taskTitles)->where('category', 'MOVEMENT')->get();

        return response()->json([
            'message' => 'Player Achievement Fetched Successfully',
            'data' => [
                'player_achievement' => $data,
                'tasks' => $taskTitles,
                'movement' => $movement,
            ],
        ], 200);
    }
    public function manipulation_index()
    {
        $data = PlayerAchievement::where('user_id', auth()->id())->get();

        if ($data->isEmpty()) {
            return $this->ok('No Achievement Found');
        }

        $taskTitles = Task::whereIn('id', $data->pluck('task_id'))->pluck('achievement');
        $manipulation = Achievement::whereIn('title', $taskTitles)->where('category', 'MANIPULATION')->get();

        return response()->json([
            'message' => 'Player Achievement Fetched Successfully',
            'data' => [
                'player_achievement' => $data,
                'tasks' => $taskTitles,
                'achievement' => $manipulation,
            ],
            'status' => 200,
        ]);
    }
    public function control_index()
    {
        $taskTitles = Task::whereIn('id', $data->pluck('task_id'))->pluck('achievement');
        $control = Achievement::whereIn('title', $taskTitles)->where('category', 'CONTROL')->get();

        // return $this->success('Player Achievement Fetched Successfully' , $control);
        return response()->json([
            'message' => 'Player Achievement Fetched Successfully',
            'data' => [
                'player_achievement' => $data,
                'tasks' => $taskTitles,
                'achievement' => $control,
            ],
            'status' => 200,
        ]);
    }
    public function striking_index()
    {
        $data = PlayerAchievement::where('user_id', auth()->id())->get();

        if ($data->isEmpty()) {
            return $this->ok('No Achievement Found');
        }

        $taskTitles = Task::whereIn('id', $data->pluck('task_id'))->pluck('achievement');
        $striking = Achievement::whereIn('title', $taskTitles)->where('category', 'STRIKING')->get();

        return response()->json([
            'message' => 'Player Achievement Fetched Successfully',
            'data' => [
                'player_achievement' => $data,
                'tasks' => $taskTitles,
                'achievement' => $striking,
            ],
            'status' => 200,
        ]);
    }
}
