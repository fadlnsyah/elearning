<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Attendance;
use App\Models\AttendanceRecord;
use Carbon\Carbon;

class MarkAbsentStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:mark-absent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark students as absent if they missed the attendance window';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = now();
        $this->info("Checking for closed attendance sessions at {$now}...");

        // Get all sessions that have ended in the past, but we might want to limit how far back
        // For simplicity, let's get all sessions where end_time < now
        // Note: Logic needs to handle Date + Time combination carefully

        $attendances = Attendance::whereRaw("CONCAT(date, ' ', end_time) < ?", [$now->format('Y-m-d H:i:s')])
            ->get();

        $count = 0;

        foreach ($attendances as $attendance) {
            // Get all students enrolled in this class
            $students = $attendance->courseClass->users()->where('role', 'mahasiswa')->get();

            foreach ($students as $student) {
                // Check if record exists
                $recordExists = AttendanceRecord::where('attendance_id', $attendance->id)
                    ->where('user_id', $student->id)
                    ->exists();

                if (!$recordExists) {
                    AttendanceRecord::create([
                        'attendance_id' => $attendance->id,
                        'user_id' => $student->id,
                        'status' => 'absent',
                        'recorded_at' => $now,
                    ]);
                    $count++;
                }
            }
        }

        $this->info("Marked {$count} students as absent.");
    }
}
