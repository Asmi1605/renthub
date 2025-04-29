<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Admin methods
    public function index()
    {
        $users = User::all();
        return view('admin.manage-users', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.edit-user', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.manage-users');
    }

    public function manageVendors()
    {
        $vendors = User::where('role', 'vendor')->get();
        return view('admin.manage-vendors', compact('vendors'));
    }

    public function manageUsers()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.manage-users', compact('users'));
    }

    // User profile methods
    public function profile()
    {
        return view('user.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }
}
