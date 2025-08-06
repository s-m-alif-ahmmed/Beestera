<?php

namespace App\Http\Controllers\Web\Backend\Home;
use App\Models\Task;
use App\Models\User;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\ChallengePoint;
use App\Models\Leaderboard;

class DashboardController extends Controller
{
    public function index(): View {
        $users = User::where('role','user')->count();
        $task = Task::count();
        $pending = ChallengePoint::where('status' , 'pending')->count();
        $approved = ChallengePoint::where('status', 'approved')->count();
        // $leaderboard = Leaderboard::where() ;
        return view('backend.layouts.index' , compact('users' , 'task' , 'pending' , 'approved'));
    }
}
