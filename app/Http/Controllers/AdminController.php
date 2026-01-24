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

        // Stats Only
        $totalUsers = User::count();
        $totalCourses = Course::count();
        $totalClasses = CourseClass::count();

        return view('dashboard.admin', compact('totalUsers', 'totalCourses', 'totalClasses'));
    }

    // --- User Management ---
    public function indexUsers()
    {
        if (Auth::user()->role !== 'admin') abort(403);
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        if (Auth::user()->role !== 'admin') abort(403);
        return view('admin.users.create');
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

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }

    // --- Course Management ---
    public function indexCourses()
    {
        if (Auth::user()->role !== 'admin') abort(403);
        $courses = Course::latest()->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function createCourse()
    {
        if (Auth::user()->role !== 'admin') abort(403);
        return view('admin.courses.create');
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
        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully');
    }

    // --- Class Management ---
    public function indexClasses()
    {
        if (Auth::user()->role !== 'admin') abort(403);
        $classes = CourseClass::with('course')->latest()->paginate(10);
        return view('admin.classes.index', compact('classes'));
    }

    public function createClass()
    {
        if (Auth::user()->role !== 'admin') abort(403);
        $courses = Course::all();
        return view('admin.classes.create', compact('courses'));
    }

    public function storeClass(Request $request)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name' => 'required',
            'enrollment_key' => 'required',
            'academic_year' => 'required',
            'day' => 'nullable|string',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
        ]);

        CourseClass::create($validated);
        return redirect()->route('admin.classes.index')->with('success', 'Class created successfully');
    }

    // User CRUD
    public function editUser(User $user)
    {
        if (Auth::user()->role !== 'admin') abort(403);
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,dosen,mahasiswa',
            'identity_number' => 'nullable|string|unique:users,identity_number,' . $user->id,
            'password' => 'nullable|min:6',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully');
    }

    public function destroyUser(User $user)
    {
        if (Auth::user()->role !== 'admin') abort(403);
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }

    // Course CRUD
    public function editCourse(Course $course)
    {
        if (Auth::user()->role !== 'admin') abort(403);
        return view('admin.courses.edit', compact('course'));
    }

    public function updateCourse(Request $request, Course $course)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $validated = $request->validate([
            'code' => 'required|unique:courses,code,' . $course->id,
            'name' => 'required',
            'department' => 'required',
        ]);

        $course->update($validated);
        return redirect()->route('admin.dashboard')->with('success', 'Course updated successfully');
    }

    public function destroyCourse(Course $course)
    {
        if (Auth::user()->role !== 'admin') abort(403);
        $course->delete();
        return back()->with('success', 'Course deleted successfully');
    }

    // Class CRUD
    public function editClass(CourseClass $courseClass)
    {
        if (Auth::user()->role !== 'admin') abort(403);
        $courses = Course::all();
        return view('admin.classes.edit', compact('courseClass', 'courses'));
    }

    public function updateClass(Request $request, CourseClass $courseClass)
    {
        if (Auth::user()->role !== 'admin') abort(403);

        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name' => 'required',
            'enrollment_key' => 'required',
            'academic_year' => 'required',
            'day' => 'nullable|string',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
        ]);

        $courseClass->update($validated);
        return redirect()->route('admin.dashboard')->with('success', 'Class updated successfully');
    }

    public function destroyClass(CourseClass $courseClass)
    {
        if (Auth::user()->role !== 'admin') abort(403);
        $courseClass->delete();
        return back()->with('success', 'Class deleted successfully');
    }
}
