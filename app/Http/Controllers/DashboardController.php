<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Get classes (eager load course info)
        $classes = $user->classes()->with('course')->get();

        if ($user->role === 'dosen') {
            return view('dashboard.dosen', compact('classes'));
        }

        return view('dashboard.mahasiswa', compact('classes'));
    }
}
