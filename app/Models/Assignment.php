<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_class_id',
        'title',
        'description',
        'type',
        'due_date',
        'file_path',
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];

    public function courseClass()
    {
        return $this->belongsTo(CourseClass::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
