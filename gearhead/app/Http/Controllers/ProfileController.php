<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show');
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        $user->update($request->all());

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        // Check if the provided current password matches the user's actual password
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->route('profile.edit')->with('error', 'Current password is incorrect.');
        }

        // Update the user's password
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Password updated successfully!');
    }

    public function orders()
    {
        // Retrieve orders for the authenticated user
        $orders = Order::where('user_id', auth()->id())->get();

        return view('orders');
    }
}
