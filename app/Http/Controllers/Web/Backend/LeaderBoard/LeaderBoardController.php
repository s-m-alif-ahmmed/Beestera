<?php

namespace App\Http\Controllers\Web\Backend\LeaderBoard;

use App\Models\Task;
use Illuminate\View\View;
use App\Models\Leaderboard;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class LeaderBoardController extends Controller
{
    use ApiResponse;
    public function index(Request $request): View|JsonResponse
    {


        $tasks = Task::get();
        if ($request->ajax()) {
            $query = Leaderboard::with(['user','task'])->orderBy('user_point', 'desc')->get();

            if ($request->has('task_id') && $request->task_id != '') {
                $query->where('task_id', $request->task_id);
            }

            $ageRanges = [
                1 => [6, 8],
                2 => [9, 11],
                3 => [12, 14],
                4 => [15, 20],
            ];

            if ($request->has('age') && $request->age != '') {
                // Ensure the selected age range exists
                if (isset($ageRanges[$request->age])) {
                    $query->whereBetween('age', $ageRanges[$request->age]);
                }
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('title', function ($data) {
                    $title = $data->task->title ?? 'N/A';
                    return $title;
                })
                ->addColumn('user_name', function ($data) {
                    return $data->user_name;
                })
                ->addColumn('email', function ($data) {
                    return $data->user->email;
                })
                ->addColumn('club', function ($data) {
                    return $data->user->club;
                })
                ->addColumn('user_point', function ($data) {
                    return $data->user_point;
                })
                ->addColumn('action', function ($data) {
                    return'<button class="btn btn-danger btn-sm delete-btn" data-id="' . $data->id . '" style="width: 60px; height: 30px; background-color: #dc3545; border-color: #dc3545;">Delete</button>';
                })
                ->rawColumns(['id', 'title','action'])
                ->make(true);
        }

        return view('backend.layouts.leaderboard.index', compact('tasks'));
    }

    public function deleteUser(int $id): JsonResponse
    {
        try {
            $data = Leaderboard::findOrFail($id);
            $data->delete();

            return $this->success('Delete Leaderboard Data successfully.');
        } catch (\Exception $e) {
            return $this->error('Failed to Delete Leaderboard Data.', $e->getMessage());
        }
    }

}
