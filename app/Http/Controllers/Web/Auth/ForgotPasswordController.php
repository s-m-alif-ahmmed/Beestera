<?php

namespace App\Http\Controllers\Web\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Mime\Part\TextPart;

class ForgotPasswordController extends Controller
{


    // Show the OTP form
    public function index()
    {
        return view('auth.code-verification'); // Replace with your actual Blade file
    }

    // Send OTP and save email in session
    public function store(Request $request)
    {
        // Validate the email
        $request->validate(['email' => ['required', 'email'],]);
        //dd("Email validated and OTP generated!"); // Add this for debugging
        $user = User::where('email',$request->email)->first();

        if ($user == null) {
            //dd($user);
            return redirect()->back()->with('t-error', 'User not found.');
        }
        // Generate a random OTP token (4 digits)
        $token = rand(1000, 9999);  // Generates a random 4-digit number (OTP)
        // Set OTP and expiry time (5 minutes)
        $user->otp = $token;
        $user->otp_expiry = now()->addMinutes(5); // Add 5 minutes expiry
        $user->save();
        // Send the OTP token to the user's email using the Blade view
        try {
            // Send the OTP email using the Blade view
            Mail::send('auth.otp_email', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email)
                    ->subject('Your OTP Code')
                    ->from('your-email@example.com'); // Optional: Specify a sender
            });
            // Store the email in session to use for OTP verification
            Session::put('otp_email', $request->email);

            // Redirect to the OTP form after sending email
            return redirect()->route('otp.index');
        } catch (\Exception $e) {
            // Handle the error and return a failure message
            return redirect()->back()->with('t-error', 'Failed to send OTP. Please try again. Error: ' . $e->getMessage());
        }

    }

    // Verify the OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'digits:4'],
        ]);

        // Retrieve the email from session
        $email = session('otp_email');
        if (!$email) {
            return redirect()->back()->with('t-error', 'Session expired. Please request OTP again.');
        }

        $user = User::where('email', $email)->first();

        if ($user == null || !$user->otp) {
            return redirect()->back()->with('t-error', 'No OTP found. Please request a new OTP.');
        }

        if ($user->otp == $request->otp && now()->lessThanOrEqualTo($user->otp_expiry)) {
            // OTP is valid, clear OTP, and store the token
            $token = Str::random(60);
            $user->forceFill([
                'otp' => null,
                'otp_expiry' => null,
                'remember_token' => $token,
            ])->save();

            // Redirect to the reset password page with the token
            return redirect()->route('password.reset', ['token' => $token])
                ->with('t-success', 'OTP Verified Successfully!');
        }

        return redirect()->back()->with('t-error', 'Invalid OTP or OTP has expired.');
    }



}
