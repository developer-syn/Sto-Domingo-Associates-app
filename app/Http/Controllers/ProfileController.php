<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    // Display the user's profile form.

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }


    // // Update the user's profile information.

    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }
public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();

    // Handle file upload if the user uploads a new photo
    if ($request->hasFile('profile_photo')) {
        $file = $request->file('profile_photo');

        // Create upload directory if it doesn't exist
        $uploadPath = public_path('uploads/profile_photos');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // Generate unique filename
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Move file to public directory
        $file->move($uploadPath, $fileName);

        // Delete old photo if exists
        if ($user->profile_photo) {
            $oldPhotoPath = public_path('uploads/profile_photos/' . basename($user->profile_photo));
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
        }

        // Save the new photo path in the database
        $user->profile_photo = 'uploads/profile_photos/' . $fileName;
    }

    $user->fill($request->validated());

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}


    // Delete the user's account.

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

