<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseClass;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    // Search/List classes to enroll
    public function index(Request $request)
    {
        $query = CourseClass::with('course');

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('course', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%");
            });
        }

        $classes = $query->get();
        return view('classes.index', compact('classes'));
    }

    public function enroll(Request $request, CourseClass $courseClass)
    {
        $request->validate([
            'enrollment_key' => 'required',
        ]);

        if ($request->enrollment_key !== $courseClass->enrollment_key) {
            return back()->withErrors(['enrollment_key' => 'Invalid enrollment key']);
        }

        // Check if already enrolled
        if ($courseClass->users()->where('user_id', Auth::id())->exists()) {
            return redirect()->route('courses.show', $courseClass)->with('info', 'Already enrolled');
        }

        Enrollment::create([
            'user_id' => Auth::id(),
            'course_class_id' => $courseClass->id,
            'enrolled_at' => now(),
        ]);

        return redirect()->route('courses.show', $courseClass)->with('success', 'Enrolled successfully!');
    }

    public function show(CourseClass $courseClass)
    {
        // Ensure user is enrolled
        if (!$courseClass->users()->where('user_id', Auth::id())->exists()) {
            return redirect()->route('classes.index')->with('error', 'You must enroll first.');
        }

        $courseClass->load(['course', 'assignments', 'attendances']);

        return view('classes.show', compact('courseClass'));
    }
}
