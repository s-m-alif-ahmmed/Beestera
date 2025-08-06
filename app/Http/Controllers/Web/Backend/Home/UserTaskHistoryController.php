<?php

namespace App\Http\Controllers\Web\Backend\Home;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Helpers\Helper;
use Illuminate\View\View;
use App\Models\Leaderboard;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\ChallengePoint;
use App\Models\PlayerAchievement;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use function PHPUnit\Framework\isEmpty;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserTaskHistoryController extends Controller
{
    use ApiResponse;

    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            $query = ChallengePoint::with(['user', 'task'])->where('status', 'pending');

            if ($request->has('task_id') && $request->task_id != '') {
                $query->where('task_id', $request->task_id);
            }

            $data = $query->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user_name', function ($data) {
                    return $data->user->name ?? 'N/A';
                })
                ->addColumn('title', function ($data) {
                    return $data->task->title ?? 'N/A';
                })
                ->addColumn('base_1', fn($data) => $data->base_1 ?? 'N/A')
                ->addColumn('base_2', fn($data) => $data->base_2 ?? 'N/A')
                ->addColumn('base_3', fn($data) => $data->base_3 ?? 'N/A')
                ->addColumn('build_1', fn($data) => $data->build_1 ?? 'N/A')
                ->addColumn('build_2', fn($data) => $data->build_2 ?? 'N/A')
                ->addColumn('build_3', fn($data) => $data->build_3 ?? 'N/A')
                ->addColumn('user_video', function ($data) {
                    if ($data->user_video) {
                        return '<video width="100" height="70" controls>
                                <source src="' . asset($data->user_video) . '" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>';
                    }
                    return 'No Video';
                })
                ->addColumn('user_point', fn($data) => $data->user_point ?? 'N/A')
                ->addColumn('updated_at', fn($data) => $data->updated_at ? $data->updated_at->diffForHumans() : 'N/A')
                ->addColumn('action', function ($data) {
                    return '
                    <div class="d-flex justify-content-start">
                        <button class="btn btn-success btn-sm approve-btn"
                            data-id="' . $data->id . '"
                            style="width: 70px; height: 30px; margin-right: 10px; background-color: #28a745; border-color: #28a745;">
                            Approve
                        </button>
                        <button class="btn btn-danger btn-sm reject-btn"
                            data-id="' . $data->id . '"
                            style="width: 70px; height: 30px; background-color: #dc3545; border-color: #dc3545;">
                            Reject
                        </button>
                    </div>';
                })
                ->rawColumns(['user_name', 'title', 'user_video', 'action'])
                ->make(true);
        }

        $tasks = Task::pluck('title', 'id');
        return view("backend.layouts.home.task_history.index", compact('tasks'));
    }


    public function approveTask(int $id): JsonResponse
    {
        DB::beginTransaction();
        try {

            $data = ChallengePoint::findOrFail($id);

            $existingApprovedTask = ChallengePoint::where('user_id', $data->user_id)
                ->where('task_id', $data->task_id)
                ->where('status', 'approved')
                ->exists();

            // if ($existingApprovedTask) {
            //     return $this->success('User has already passed this task.', 200);
            // }


            $data->status = 'approved';

            $user = User::findOrFail($data->user_id);

            $user_birth_date = Carbon::createFromFormat('d/m/Y', $user->date_of_birth);
            $user_age = $user_birth_date->age;

            $task = Task::findOrFail($data->task_id);

            $previous_task = Task::where('starting_date', '<', $task->starting_date)
                ->orderBy('starting_date', 'desc')
                ->first();

            $previous_attempt = ChallengePoint::where('user_id', $user->id)
                ->where('task_id', optional($previous_task)->id)
                ->exists();

            // for counting streak
            if ($previous_attempt) {
                $user->streak += 1;
            } elseif (!$previous_attempt && $user->streak == 0) {
                $user->streak = 1;
            } else {
                $user->streak = 1;
            }

            $leaderboard = Leaderboard::firstOrNew([
                'user_id' => $data->user_id,
                'task_id' => $data->task_id,
            ]);

            if (!$leaderboard->exists) {
                $leaderboard->age = $user_age;
                $leaderboard->user_name = $user->name;
                $leaderboard->avatar = $user->avatar ?? '';
                $leaderboard->club = $user->club;
                $leaderboard->user_point = 0;
            }


            $leaderboard->user_point = max($leaderboard->user_point, $data->user_point);

            // for tracking their achievements
            $player_achievement = PlayerAchievement::where('user_id', $data->user_id)
                ->where('task_id', $data->task_id)
                ->first();

            if ($player_achievement && $player_achievement->count < 2) {
                $player_achievement->increment('count');
            } else {
                // Create a new record if not exists
                PlayerAchievement::create([
                    'user_id' => $data->user_id,
                    'task_id' => $data->task_id,
                    'count' => 1,
                ]);
            }

            $data->save();
            $user->save();
            $leaderboard->save();

            DB::commit();
            return $this->success('Task approved successfully.', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error approving task: ' . $e->getMessage());
            return $this->error('Failed to approve task.', $e->getMessage(), 500);
        }
    }


    //    public function approveTask(int $id): JsonResponse
    //    {
    //        DB::beginTransaction();
    //        try {
    //            $data = ChallengePoint::findOrFail($id);
    //
    //            $existingApprovedTask = ChallengePoint::where('user_id', $data->user_id)
    //                ->where('task_id', $data->task_id)
    //                ->where('status', 'approved')
    //                ->exists();
    //
    //            if ($existingApprovedTask) {
    //                return $this->success('User has already passed this task.', 200);
    //            }
    //
    //            $data->status = 'approved';
    //
    //            $user = User::findOrFail($data->user_id);
    //            $user_age = Carbon::parse($user->date_of_birth)->age;
    //
    //            $leaderboard = Leaderboard::where('user_id', $data->user_id)
    //                ->where('task_id', $data->task->id)
    //                ->first();
    //
    //            $challenge_task_id = $data->task_id;
    //            $task = Task::findOrFail($challenge_task_id);
    //
    //            $previous_task = Task::where('starting_date', '<=', $task->starting_date)
    //                ->orderBy('starting_date', 'desc')
    //                ->first();
    //
    //            $previous_attempt = $data->where('user_id', $user->id)->where('task_id', $previous_task->id)->get();
    //
    //            if ($previous_attempt->isNotEmpty()) {
    //                $user->streak = $user->streak + 1;
    //            } elseif ($previous_attempt->isEmpty() && $user->streak == 0) {
    //                $user->streak = $user->streak + 1;
    //            } else {
    //                $user->streak = 0;
    //            }
    //
    //            if (!$leaderboard) {
    //                $leaderboard = new Leaderboard();
    //                $leaderboard->user_id = $data->user_id;
    //                $leaderboard->age = $user_age;
    //                $leaderboard->user_name = $data->user->name;
    //                $leaderboard->avatar = $data->user->avatar ?? '';
    //                $leaderboard->club = $data->user->club;
    //                $leaderboard->task_id = $data->task->id;
    //                $leaderboard->user_point = 0;
    //            }
    //
    //            $leaderboard->user_point += $data->user_point;
    //
    //            $data->save();
    //            $user->save();
    //            $leaderboard->save();
    //
    //            DB::commit();
    //            return $this->success('Task approved successfully.', 200);
    //        } catch (\Exception $e) {
    //            DB::rollBack();
    //            Log::error('Error approving task: ' . $e->getMessage());
    //            return $this->error('Failed to approve task.', $e->getMessage(), 500);
    //        }
    //    }

    public function rejectTask(int $id): JsonResponse
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
