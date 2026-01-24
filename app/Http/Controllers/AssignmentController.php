<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseClass;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function index(CourseClass $courseClass)
    {
        // Ensure enrolled
        if (!$courseClass->users()->where('user_id', Auth::id())->exists()) {
            return redirect()->route('dashboard');
        }

        $assignments = $courseClass->assignments()->orderBy('due_date')->get();
        return view('assignments.index', compact('courseClass', 'assignments'));
    }

    public function store(Request $request, CourseClass $courseClass)
    {
        // Check if teacher (users role must be dosen)
        if (Auth::user()->role !== 'dosen') abort(403);

        $validated = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'type' => 'required|in:file_upload,quiz',
            'due_date' => 'nullable|date',
            'file' => 'nullable|file|max:10240', // 10MB
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('assignments', 'public');
        }

        $courseClass->assignments()->create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'type' => $validated['type'],
            'due_date' => $validated['due_date'],
            'file_path' => $filePath,
        ]);

        return back()->with('success', 'Assignment created');
    }

    public function show(CourseClass $courseClass, Assignment $assignment)
    {
        // Check enrollment
        if (!$courseClass->users()->where('user_id', Auth::id())->exists()) {
            return redirect()->route('dashboard');
        }

        $submission = Submission::where('assignment_id', $assignment->id)
            ->where('user_id', Auth::id())
            ->first();

        // If teacher, show all submissions?
        $allSubmissions = [];
        if (Auth::user()->role === 'dosen') {
            $allSubmissions = $assignment->submissions()->with('user')->get();
        }

        return view('assignments.show', compact('courseClass', 'assignment', 'submission', 'allSubmissions'));
    }

    public function submit(Request $request, CourseClass $courseClass, Assignment $assignment)
    {
        $validated = $request->validate([
            'content' => 'nullable|string',
            'file' => 'nullable|file|max:10240',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('submissions', 'public');
        }

        Submission::updateOrCreate(
            ['assignment_id' => $assignment->id, 'user_id' => Auth::id()],
            [
                'content' => $validated['content'],
                'file_path' => $filePath,
                'submitted_at' => now(),
            ]
        );

        return back()->with('success', 'Submission uploaded');
    }
}
