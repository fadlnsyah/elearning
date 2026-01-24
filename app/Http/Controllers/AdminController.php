<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\CourseClass;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $users = User::latest()->limit(10)->get();
        $courses = Course::with('classes')->get();

        return view('dashboard.admin', compact('users', 'courses'));
    }

    public function storeUser(Request $request)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,dosen,mahasiswa',
            'identity_number' => 'nullable|string|unique:users',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return back()->with('success', 'User created successfully');
    }

    public function storeCourse(Request $request)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $validated = $request->validate([
            'code' => 'required|unique:courses',
            'name' => 'required',
            'department' => 'required',
        ]);

        Course::create($validated);
        return back()->with('success', 'Course created successfully');
    }

    public function storeClass(Request $request)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name' => 'required',
            'enrollment_key' => 'required',
            'academic_year' => 'required',
        ]);

        CourseClass::create($validated);
        return back()->with('success', 'Class created successfully');
    }
}
