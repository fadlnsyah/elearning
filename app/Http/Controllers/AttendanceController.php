<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseClass;
use App\Models\Attendance;
use App\Models\AttendanceRecord;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index(CourseClass $courseClass)
    {
        if (!$courseClass->users()->where('user_id', Auth::id())->exists()) {
            return redirect()->route('dashboard');
        }

        $attendances = $courseClass->attendances()->orderBy('date', 'desc')->get();
        return view('attendance.index', compact('courseClass', 'attendances'));
    }

    public function store(Request $request, CourseClass $courseClass)
    {
        if (Auth::user()->role !== 'dosen') abort(403);

        $validated = $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'secret_code' => 'nullable|string',
        ]);

        $courseClass->attendances()->create($validated);

        return back()->with('success', 'Attendance session created');
    }

    public function submit(Request $request, CourseClass $courseClass)
    {
        $validated = $request->validate([
            'attendance_id' => 'required|exists:attendances,id',
            'secret_code' => 'nullable|string',
            'status' => 'required|in:present,excused,absent',
            'notes' => 'nullable|string', // Optional notes for excused
        ]);

        $attendance = Attendance::findOrFail($validated['attendance_id']);

        // Check time
        $now = now();
        // Construct full datetime for start/end
        $start = \Carbon\Carbon::parse($attendance->date->format('Y-m-d') . ' ' . $attendance->start_time);
        $end = \Carbon\Carbon::parse($attendance->date->format('Y-m-d') . ' ' . $attendance->end_time);

        if ($now->lessThan($start) || $now->greaterThan($end)) {
            return back()->with('error', 'Attendance is not open at this time.');
        }

        // Check code (only if status is present) - logic choice: excuse might also need code? usually yes to prove they logged in
        if ($attendance->secret_code && $attendance->secret_code !== $request->secret_code) {
            return back()->with('error', 'Invalid secret code');
        }

        // Check if already submitted
        $existingRecord = AttendanceRecord::where('attendance_id', $attendance->id)
            ->where('user_id', Auth::id())
            ->exists();

        if ($existingRecord) {
            return back()->with('error', 'You have already submitted attendance for this session.');
        }

        AttendanceRecord::create([
            'attendance_id' => $attendance->id,
            'user_id' => Auth::id(),
            'status' => $validated['status'],
            'recorded_at' => now()
        ]);

        return back()->with('success', 'Attendance submitted as ' . ucfirst($validated['status']));
    }
}
