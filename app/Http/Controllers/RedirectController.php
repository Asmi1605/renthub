<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RedirectController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        Log::info('User role:', ['role' => $user->role]);

        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->role === 'vendor') {
            return redirect('/vendor/dashboard');
        } elseif ($user->role === 'user') {
            return redirect('/user/dashboard');
        } else {
            Auth::logout();
            return redirect('/login')->withErrors('Access denied.');
        }
    }
}
