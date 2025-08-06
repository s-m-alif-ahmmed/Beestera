<?php

namespace App\Http\Controllers\Api\Home;

use Carbon\Carbon;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function getTask(): JsonResponse
    {
        $today = Carbon::today()->toDateString();

        $tasks = Task::where('starting_date', '<=', $today)
            ->where('ending_date', '>=', $today)
            ->get();

        $tasks = $tasks->map(function ($task) {
            return collect($task)->map(fn($value) => $value ?? '')->toArray();
        });


        return response()->json([
            'status' => true,
            'message' => 'Task data fetched successfully.',
            'data' => $tasks,
            'code' => 200,
        ], 200);

    }
}



// $today = Carbon::today()->toDateString();

// $tasks = Task::where('starting_date', '<=', $today)
//                 ->where('ending_date', '>=', $today)
//                 ->latest()->get();

// if ($tasks->isNotEmpty()) {
//     return response()->json([
//         'status' => true,
//         'message' => 'Task data fetchedssss successfully.',
//         'data' => $tasks,
//         'date' => $today,
//         'code' => 200,
//     ], 200);
// } else {
//     return response()->json([
//         'status' => false,
//         'message' => 'No tasks found for today.',
//         'data' => [],
//         'date' => $today,
//         'code' => 404,
//     ], 404);
// }
