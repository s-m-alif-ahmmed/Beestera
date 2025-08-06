<?php

namespace App\Http\Controllers\Api\Profile;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UpdateProfileController extends Controller
{

    public function index(Request $request)
    {
        $user = auth('api')->user();

        // Get latest active subscription
        $subscription = $user->planSubscriptions()
//            ->where(function($query) {
//                $query->whereNull('ends_at')
//                    ->orWhere('ends_at', '>', now());
//            })
            ->latest('created_at')
            ->first();

        // Default subscription data with empty/false values
        $subscriptionData = [
            'status' => 'none',
            'plan_name' => '',
            'product_id' => '',
            'starts_at' => '',
            'ends_at' => '',
            'canceled_at' => '',
            'trial_ends_at' => '',
            'is_active' => false,
            'is_canceled' => false,
            'is_expired' => false
        ];

        if ($subscription) {
            $plan = $subscription->plan;
            $isActive = $subscription->active();
            $isCanceled = $subscription->canceled();
            $isExpired = !$isActive && !$isCanceled;

            $subscriptionData = [
                'status' => $isActive ? 'active' : ($isCanceled ? 'canceled' : 'expired'),
                'plan_name' => $plan->name ?? '',
                'product_id' => $plan->product_id ?? '',
                'starts_at' => $subscription->starts_at?->toIso8601String() ?? '',
                'ends_at' => $subscription->ends_at?->toIso8601String() ?? '',
                'canceled_at' => $subscription->canceled_at?->toIso8601String() ?? '',
                'trial_ends_at' => $subscription->trial_ends_at?->toIso8601String() ?? '',
                'is_active' => $isActive,
                'is_canceled' => $isCanceled,
                'is_expired' => $isExpired
            ];
        }

        // Get user data and replace null values with empty strings
        $userData = array_map(function ($value) {
            return $value === null ? '' : $value;
        }, $user->toArray());

        return response()->json([
            'user' => $userData,
            'subscription' => $subscriptionData
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string',
            'password' => 'nullable|string|confirmed',
            'old_password' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,svg,webp|max:10240',
            'gender' => 'nullable|string',
            'date_of_birth' => 'nullable|string',
            'position' => 'nullable|string',
            'club' => 'nullable|string',
            'preferred_foot' => 'nullable|string',
            'favourite_club' => 'nullable|string',
            'favourite_player' => 'nullable|string',
        ]);

        $user = auth('api')->user();


        if ($request->old_password) {
            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json(['error' => 'Old password is incorrect.'], 400);
            }


            if ($request->password !== $request->password_confirmation) {
                return response()->json(['error' => 'New password and confirmation do not match.'], 400);
            }
        }

        $user->update([
            'name' => $request->name ?? $user->name,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'gender' => $request->gender ?? $user->gender,
            'date_of_birth' => $request->date_of_birth ?? $user->date_of_birth,
            'position' => $request->position ?? $user->position,
            'club' => $request->club ?? $user->club,
            'preferred_foot' => $request->preferred_foot ?? $user->preferred_foot,
            'favourite_club' => $request->favourite_club ?? $user->favourite_club,
            'favourite_player' => $request->favourite_player ?? $user->favourite_player,
        ]);

        // Handle file upload for avatar
        if ($request->hasFile('avatar')) {
            $avatarPath = Helper::fileUpload($request->file('avatar'), 'profile_avatars', time() . '_' . $request->file('avatar')->getClientOriginalName());

            if ($avatarPath) {
                $user->avatar = $avatarPath;
            }
        }

        $user->save();

        return response()->json([
            'name' => $user->name ?? '',
            'avatar' => $user->avatar ?? '',
            'gender' => $user->gender ?? '',
            'date_of_birth' => $user->date_of_birth ?? '',
            'streak' => $user->streak ?? '',
            'position' => $user->position ?? '',
            'club' => $user->club ?? '',
            'preferred_foot' => $user->preferred_foot ?? '',
            'favourite_player' => $user->favourite_player ?? '',
            'favourite_club' => $user->favourite_club ?? '',
        ]);
    }


}
