<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Fetch all users from the database
        $users = User::all();
        
        // Return the view and pass the $users data to it
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
    $vendors = \App\Models\User::where('role', 'vendor')->get();
    return view('admin.manage-vendors', compact('vendors'));
}


public function manageUsers()
{
    $users = \App\Models\User::where('role', 'user')->get();
    return view('admin.manage-users', compact('users'));
}



}
