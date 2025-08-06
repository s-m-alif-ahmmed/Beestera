<?php

namespace App\Http\Controllers\Api\Home;
use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Leaderboard;
use App\Traits\ApiResponse;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;

class LeaderBoardController extends Controller
{
    use ApiResponse;
    public function index(Request $request): JsonResponse
    {
        $id = $request->query('id'); // Fix: Get `id` from query parameters


        $ageRanges = [
            1 => [6, 8],
            2 => [9, 11],
            3 => [12, 14],
            4 => [15, 60],
        ];

        $today = Carbon::today()->toDateString();
        $current_tasks = Task::where('starting_date', '<=', $today)
            ->where('ending_date', '>=', $today)
            ->pluck('id')
            ->toArray();

        $leaderboard = Leaderboard::whereIn('task_id', $current_tasks)
            ->whereBetween('age', $ageRanges[$id])
            ->orderByDesc('user_point')
            ->get();
        if ($leaderboard->isEmpty()) {
            return response()->json([
                'status' => true,
                'user' => [],
                'code' => 200,
            ], 200);
        }
        return response()->json([
            'status' => true,
            'user' => $leaderboard,
            'code' => 200,
        ], 200);

    }

}
