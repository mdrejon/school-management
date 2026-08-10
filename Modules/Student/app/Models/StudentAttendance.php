<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentAttendance extends Model
{
    protected $fillable = [
        'student_id',
        'class_id',
        'section_id',
        'period_id',
        'date',
        'status',
        'sms_sent',
    ];

    protected $casts = [
        'date' => 'date',
        'sms_sent' => 'boolean',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
