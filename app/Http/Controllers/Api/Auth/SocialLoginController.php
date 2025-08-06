<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class SocialLoginController extends Controller
{
    use ApiResponse;

    public function socialLogin(Request $request)
    {
        $request->validate([
            'provider_id' => 'required',
            'token' => 'required',
        ]);

        try {
            if ($request->provider_id === 'google') {
                $socialUser = Socialite::driver('google')->stateless()->userFromToken($request->token);
            } elseif ($request->provider_id === 'apple') {
                $socialUser = Socialite::driver('apple')->stateless()->userFromToken($request->token);
            } else {
                return $this->error('Unsupported provider', 422);
            }

            if ($socialUser) {
                $user = User::where('email', $socialUser->email)->first();
                if (!$user) {
                    $password = Str::random(16);
                    $user = User::create([
                        'provider_id' => $request->provider_id,
                        'name' => $socialUser->getName(),
                        'email' => $socialUser->email,
                        'password' => Hash::make($password),
                        'avatar' => $socialUser->getAvatar(),
                        'email_verified_at' => now(),
                    ]);
                }
                Auth::login($user);
                $token = auth('api')->login($user);
                $info = User::where('email' , $user->email)->get();
                return $this->success('login Successfully.',[
                    'token' => $token,
                    'user' => $info ,
                ]);
            } else {

                return $this->error('Invalid or Expired Token', 401);
            }
        } catch (Exception $e) {
            \Log::error('Social login failed: ' . $e->getMessage());
            return $this->error('Something went wrong', 500);
        }
    }

    public function redirectCallbackApple()
    {
        return $this->ok('You are now logged in');
    }

}
