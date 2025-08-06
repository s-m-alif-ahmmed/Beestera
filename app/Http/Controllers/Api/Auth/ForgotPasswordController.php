<?php

namespace App\Http\Controllers\Api\Auth;

use Carbon\Carbon;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    use ApiResponse;
    public function sendResetCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return $this->error('Invalid email address', $validator->errors()->first());
            //return response()->json(['message' => 'Invalid email address'], 422);
        }

        $otp = rand(1000, 9999);
        $otpExpiry = Carbon::now()->addMinutes(15);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->error('User not found', 'Not Found');
            //return response()->json(['message' => 'User not found'], 404);
        }

        $user->otp = $otp;
        $user->otp_expiry = $otpExpiry;
        $user->save();

        $emailData = [
            'subject' => 'Password Reset Code',
            'body' => "Hello,\n\nWe have received a request to reset your password.
            \n\nYour One-Time Password (OTP) for password reset is:\n\n**$otp**\n\n
            This OTP is valid for 15 minutes. If you did not make this request, please ignore this email.",
        ];

        try {
            Mail::raw($emailData['body'], function ($message) use ($request, $emailData) {
                $message->to($request->email)
                    ->subject($emailData['subject']);
            });

            return response()->json([
                'status' => true,
                'message' => 'Otp send successfully.',
                'data' => $otp,
                'code' => '200',
            ], 200);

        } catch (\Exception $e) {
            return $this->error('Failed to send email', $e->getMessage());
            //return response()->json(['message' => 'Failed to send email', 'error' => $e->getMessage()], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required|digits:4',
        ]);

        if ($validator->fails()) {
            return $this->error('Invalid input', $validator->errors()->first());
            //return response()->json(['message' => 'Invalid input'], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !$user->otp) {
            return $this->error('No OTP found. Please request a new OTP.', '');
            //return response()->json(['message' => 'No OTP found. Please request a new OTP.'], 404);
        }

        if ($user->otp == $request->otp && Carbon::now()->lessThanOrEqualTo($user->otp_expiry)) {
            // OTP is valid, clear OTP, and store the token
            $token = Str::random(60);

            $user->forceFill([
                'otp' => null,
                'otp_expiry' => null,
                'remember_token' => $token,
            ])->save();
            return $this->success('OTP Verified Successfully');
            //return response()->json(['message' => 'OTP Verified Successfully'], 200);
        }
        return $this->error('Invalid OTP or OTP has expired.', 'Not Found');
        //return response()->json(['message' => 'Invalid OTP or OTP has expired.'], 404);
    }

    public function newpassword(Request $request):JsonResponse
    {
        $request->validate([
            // 'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        // Find the user by email and verify the token
        $user = User::where('email', $request->email)
            // ->where('remember_token', $request->token)
            ->first();

        if (!$user) {
            return $this->error('Invalid token or email.' , 'email');
        }

        // Update the password and clear the token
        $user->forceFill([
            'password' => Hash::make($request->password),
            // 'remember_token' => null,
        ])->save();
        $user = array_map(function ($value) {
            return $value === null ? '' : $value;
        }, $user->toArray());

        return response()->json([
            'status' => true,
            'data' => $user,
            'message' => 'Password Reset Successfully',
            'code' => '200',
        ],200);

    }
}
