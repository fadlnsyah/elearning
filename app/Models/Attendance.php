<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_class_id',
        'title',
        'date',
        'start_time',
        'end_time',
        'secret_code',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function courseClass()
    {
        return $this->belongsTo(CourseClass::class);
    }

    public function records()
    {
        return $this->hasMany(AttendanceRecord::class);
    }
}
