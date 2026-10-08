<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\Section;

class DailyAttendanceSummary extends Model
{
    protected $table = 'daily_attendance_summaries';

    protected $fillable = [
        'external_id',
        'date',
        'class_id',
        'class_name',
        'section_id',
        'section_name',
        'total_students',
        'present_count',
        'absent_count',
        'leave_count',
        'late_count',
        'attendance_rate',
        'remarks',
    ];

    protected $casts = [
        'date' => 'date',
        'total_students' => 'integer',
        'present_count' => 'integer',
        'absent_count' => 'integer',
        'leave_count' => 'integer',
        'late_count' => 'integer',
        'attendance_rate' => 'decimal:2',
    ];

    public function academicClass(): BelongsTo
    {
        return $this->belongsTo(AcademicClass::class, 'class_id');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
