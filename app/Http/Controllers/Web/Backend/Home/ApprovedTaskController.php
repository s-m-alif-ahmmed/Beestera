<?php

namespace App\Http\Controllers\Web\Backend\Home;

use App\Helpers\Helper;
use App\Models\Task;
use App\Traits\ApiResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ChallengePoint;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ApprovedTaskController extends Controller
{
    use ApiResponse;
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            $query = ChallengePoint::with(['user','task'])->where('status', 'approved')->get();

            if ($request->task_id) {
                $query->where('task_id', $request->task_id);
            }



            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('user_name', function ($data) {
                    return $data->user->name ?? 'N/A';
                })
                ->addColumn('title', function ($data) {
                    return $data->task->title ?? 'N/A';
                })
                ->addColumn('base_1', function ($data) {
                    return $data->base_1 ?? 'N/A';
                })
                ->addColumn('base_2', function ($data) {
                    return $data->base_2 ?? 'N/A';
                })
                ->addColumn('base_3', function ($data) {
                    return $data->base_3 ?? 'N/A';
                })
                ->addColumn('build_1', function ($data) {
                    return $data->build_1 ?? 'N/A';
                })
                ->addColumn('build_2', function ($data) {
                    return $data->build_2 ?? 'N/A';
                })
                ->addColumn('build_3', function ($data) {
                    return $data->build_3 ?? 'N/A';
                })
                ->addColumn('user_video', function ($data) {
                    if ($data->user_video) {
                        return '<video width="100" height="70" controls>
                                    <source src="' . asset($data->user_video) . '" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>';
                    }
                    return 'No Video';
                })
                ->addColumn('user_point', function ($data) {
                    return $data->user_point ?? 'N/A';
                })
                ->addColumn('updated_at', function ($data) {
                    return $data->updated_at ? $data->updated_at->diffForHumans() : 'N/A';
                })
                ->addColumn('action', function ($data) {
                    return'<button class="btn btn-danger btn-sm delete-btn" data-id="' . $data->id . '" style="width: 60px; height: 30px; background-color: #dc3545; border-color: #dc3545;">Delete</button>';
                })
                ->rawColumns(['user_video' , 'action'])
                ->make(true);
        }

        $tasks = Task::all(); // Fetch all tasks for the filter dropdown
        return view("backend.layouts.home.task_history.approved", compact('tasks'));
    }

    public function deleteTask(int $id): JsonResponse
    {
        try {

            $data = ChallengePoint::findOrFail($id);
            Helper::fileDelete($data->user_video);
            $data->delete();

            return $this->success('Request Rejected successfully.');
        } catch (\Exception $e) {
            return $this->error('Failed to Request Rejected.', $e->getMessage());
        }
    }

}
