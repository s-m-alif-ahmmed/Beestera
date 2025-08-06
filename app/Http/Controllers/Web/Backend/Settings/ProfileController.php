<?php

namespace App\Http\Controllers\Web\Backend\Settings;

use App\Traits\ApiResponse;
use Exception;
use App\Models\User;
use App\Helpers\Helper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    use ApiResponse;
    /**
     * Display the user's profile form.
     */
    public function index(Request $request)
    {
        $user = User::find($request->id);
        return view('backend.layouts.settings.profile_settings', compact('user'));
    }


    // Update Admin's  Name and Email
    public function UpdateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|max:100|min:2',
            'email' => 'nullable|email|unique:users,email,' . auth()->user()->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $user = User::find(auth()->user()->id);
            $user->name = $request->name;
            $user->email = $request->email;

            $user->save();
            return redirect()->back()->with('t-success', 'Profile updated successfully');
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Something went wrong');
        }
    }

    // Update Admin's his Password
    public function UpdatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $user = Auth::user();
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->password);
                $user->save();

                return redirect()->back()->with('t-success', 'Password updated successfully');
            } else {
                return redirect()->back()->with('t-error', 'Current password is incorrect');
            }
        } catch (Exception) {
            return redirect()->back()->with('t-error', 'Something went wrong');
        }
    }


    // Update Admin's Profile Picture
    public function updateProfilePicture(Request $request)
    {
        // Validate the image
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpg,png,jpeg,gif|max:20480',
        ]);

        $user = auth()->user();
        if ($request->hasFile('profile_picture')) {
            // Helper::fileDelete($user->profile_picture);
            $image = $request->file('profile_picture');
            $path = $image->store('avatars', 'public');
            $user->update(['avatar' => $path]);

            return response()->json([
                'success' => true,
                'image_url' => asset('storage/' . $path)
            ]);
        }

        return $this->error('No image file found.' , 'not found');
        // return response()->json([
        //     'success' => false,
        //     'message' => 'No image file found.'
        // ]);
    }





    // public function edit(Request $request): View
    // {
    //     return view('profile.edit', [
    //         'user' => $request->user(),
    //     ]);
    // }

    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    /**
     * Delete the user's account.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }
}
