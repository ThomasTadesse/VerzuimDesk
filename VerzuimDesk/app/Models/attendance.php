<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'teacher_id',
        'subject_id',
        'group_id',
        'date',
        'present_percentage',
        'excused_absence_percentage',
        'unexcused_absence_percentage',
        'unregistered_percentage',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Get the student that owns the attendance record.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the teacher that created the attendance record.
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Get the subject associated with the attendance record.
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Get the group associated with the attendance record.
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}