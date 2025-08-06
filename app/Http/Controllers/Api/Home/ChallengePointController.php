<?php

namespace App\Http\Controllers\Api\Home;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\ChallengePoint;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class ChallengePointController extends Controller
{
    public function create(Request $request)
    {

        $request->validate([
            'base_1' => "required|integer",
            'base_2' => "required|integer",
            'base_3' => "required|integer",
            'build_1' => "required|integer",
            'build_2' => "required|integer",
            'build_3' => "required|integer",
            'video' => 'required|file|mimes:mp4,mov,avi|max:102400',
            'user_point' => 'required|integer',
        ]);

        $user = Auth::user();


        $challenge_point = new ChallengePoint();
        $challenge_point->user_id = $user->id;
        $challenge_point->task_id = $request->task_id;
        $challenge_point->base_1 = $request->base_1;
        $challenge_point->base_2 = $request->base_2;
        $challenge_point->base_3 = $request->base_3;
        $challenge_point->build_1 = $request->build_1;
        $challenge_point->build_2 = $request->build_2;
        $challenge_point->build_3 = $request->build_3;
        if ($request->hasFile('video')) {
            $videoPath = Helper::fileUpload($request->file('video'), 'task', time() . '_' . $request->file('video')->getClientOriginalName());
            $challenge_point->user_video = $videoPath;
        }

        $challenge_point->user_point = $request->user_point;
        // $challenge_point->status = $request->status;
        $challenge_point->save();


        return response()->json([
            'status' => true,
            'Message' => 'Challenge Data Saved Succesfully.',
            'data' => $challenge_point,
            'code' => '200',
        ], 200);
    }
}
