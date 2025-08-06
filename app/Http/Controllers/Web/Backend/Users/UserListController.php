<?php

namespace App\Http\Controllers\Web\Backend\Users;

use App\Models\User;
use Illuminate\View\View;
use App\Models\Leaderboard;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\ChallengePoint;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UserListController extends Controller
{
    use ApiResponse;
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {

            $data = User::where('role', 'user')
                ->select()
                ->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    return $data->name ?? 'N/A';
                })
                ->addColumn('email', function ($data) {
                    return $data->email ?? 'N/A';
                })
                ->addColumn('date_of_birth', function ($data) {
                    return $data->date_of_birth ?? 'N/A';
                })
                ->addColumn('gender', function ($data) {
                    return $data->gender ?? 'N/A';
                })
                ->addColumn('club', function ($data) {
                    return $data->club ?? 'N/A';
                })
                ->addColumn('position', function ($data) {
                    return $data->position ?? 'N/A';
                })
                ->addColumn('preferred_foot', function ($data) {
                    return $data->preferred_foot ?? 'N/A';
                })
                ->addColumn('favourite_club', function ($data) {
                    return $data->favourite_club ?? 'N/A';
                })
                ->addColumn('favourite_player', function ($data) {
                    return $data->favourite_player ?? 'N/A';
                })
                ->addColumn('created_at', function ($data) {
                    return $data->created_at ?? 'N/A';
                })
                ->addColumn('updated_at', function ($data) {
                    return $data->updated_at
                        ? $data->updated_at->diffForHumans()
                        : 'N/A';
                })
                ->addColumn('action', function ($data) {
                    return'<button class="btn btn-danger btn-sm delete-btn" data-id="' . $data->id . '" style="width: 60px; height: 30px; background-color: #dc3545; border-color: #dc3545;">Delete</button>';
                })
                ->rawColumns([])
                ->make(true);
        }

        return view("backend.layouts.users_list.index");
    }
    public function destroy(int $id): JsonResponse
    {
        try {
            $data = User::findOrFail($id);
            ChallengePoint::where('user_id', $data->id)->delete();
            Leaderboard::where('user_id', $data->id)->delete();
            $data->delete();

            return $this->success('User deleted successfully.');
        } catch (\Exception) {

            return $this->error('Failed to delete the User.', 'error');
        }
    }
}
