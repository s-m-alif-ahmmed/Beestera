<?php

namespace App\Http\Controllers\Api\Auth;

use App\Enums\SubscriptionPlanEnum;
use App\Helpers\Helper;
use App\Traits\ApiResponse;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use ApiResponse;

    public function subscriptionCheck(Request $request, $planId = null)
    {
        $user = auth()->user();

        if (!$planId) {
            return response()->json([
                'message' => 'Plan ID is required.'
            ], 422);
        }

        $validPlans = [
            SubscriptionPlanEnum::basicMonthly,
            SubscriptionPlanEnum::basicYearly,
            SubscriptionPlanEnum::proMonthly,
            SubscriptionPlanEnum::proYearly,
            SubscriptionPlanEnum::trainingYearly,
            SubscriptionPlanEnum::trainingByYearly,
            SubscriptionPlanEnum::basicMonthlyAndroid,
            SubscriptionPlanEnum::basicYearlyAndroid,
            SubscriptionPlanEnum::proMonthlyAndroid,
            SubscriptionPlanEnum::proYearlyAndroid,
            SubscriptionPlanEnum::trainingYearlyAndroid,
            SubscriptionPlanEnum::trainingByYearlyAndroid
        ];

        // Check if the provided plan ID is valid
        $plan = \Laravelcm\Subscriptions\Models\Plan::find($planId);

        if (!$plan || !in_array($plan->product_id, $validPlans)) {
            return $this->error('Invalid subscription plan.', 422);
        }

        // Check if the user is subscribed to the specific plan
        $isSubscribed = $user->subscribedTo($planId);

        if (!$isSubscribed) {
            return $this->error('You need to subscribe to this plan.', 403);
        }

        return $this->success('Subscription is active.', [], 200);

    }

    public function register(Request $request)
    {
        $validdata = $request->validate([
            "name" => "required|string|max:50",
            "email" => "required|string|unique:users",
            "date_of_birth" => "nullable|string",
            "gender" => "nullable|string",
            "club" => "required|string",
            "position" => "required|string",
            "preferred_foot" => "required|string",
            "favourite_club" => "required|string",
            "favourite_player" => "required|string",
            "password" => "required|string|min:6|confirmed",
        ]);
        $user = User::create([
            "name" => $validdata["name"],
            "email" => $validdata["email"],
            "password" => bcrypt($validdata["password"]),
            "date_of_birth" => $validdata["date_of_birth"] ?? null,
            "gender" => $validdata["gender"] ?? null,
            "club" => $validdata["club"],
            "position" => $validdata["position"],
            "preferred_foot" => $validdata["preferred_foot"],
            "favourite_club" => $validdata["favourite_club"],
            "favourite_player" => $validdata["favourite_player"],
        ]);
        $token = auth('api')->login($user);
        return $this->respondWithToken($token);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = auth('api')->attempt($credentials)) {
            $user = auth('api')->user();

            if ($user->role === 'admin') {
                return response()->json(['error' => 'Unauthorized. Only Users can log in here.'], 403);
            }

            // Get latest active subscription
            $subscription = $user->planSubscriptions()
//                ->where(function($query) {
//                    $query->whereNull('ends_at')
//                        ->orWhere('ends_at', '>', now());
//                })
                ->orderByDesc('created_at')
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

            return response()->json([
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => null,
                'user' => $user,
                'subscription' => $subscriptionData
            ]);
        }

        return $this->error('Unauthorized', 403);
    }


    // public function view_profile()
    // {
    //     return response()->json(auth('api')->user());
    // }

    public function logout(Request $request)
    {
        try {

            $token = JWTAuth::getToken();
            JWTAuth::invalidate($token);
            return $this->success('Logout Successfully');

        } catch (Exception $e) {
            return $this->error('Could not log out, please try again.' . $e->getMessage());
        }
    }

    public function deleteUser()
    {
        $user = auth::user();

        if (!$user) {
            return Helper::jsonErrorResponse('Authentication Error', 401);
        }

        $user->delete();

        return Helper::jsonResponse(true, 'Your account delete successfully!', 200);
    }

    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function guard()
    {
        return Auth::guard();
    }
}
