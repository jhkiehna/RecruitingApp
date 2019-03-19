<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function edit()
    {
        return view('auth/passwords/editPassword')->with(['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'current_password' => 'required|string',
                'password' => 'required|string|confirmed'
            ],
            [
                'current_password.required' => 'Please supply your current password',
                'current_password.string' => 'Your current password must be a string',
                
                'password.required' => 'New password must be supplied',
                'password.string' => 'New password must be a string',
                'password.confirmed' => 'Check that the new password fields match',
            ]
        );

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withStatus('Your current password was incorrect', 403);
        }

        $user = auth()->user();
        $user->updatePassword($request->password);

        return redirect()->route('dashboard')->withStatus('Password was successfully updated!');
    }
}
