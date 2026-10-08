<?php

namespace Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Academic\Models\AcademicClass;
use Modules\Academic\Models\Section;

class ExamSeatPlan extends Model
{
    protected $table = 'exam_seat_plans';

    protected $fillable = [
        'external_id',
        'exam_id',
        'exam_name',
        'academic_year',
        'class_id',
        'class_name',
        'section_id',
        'section_name',
        'room_no',
        'building_name',
        'roll_from',
        'roll_to',
        'allocated_rolls',
        'total_seats',
        'exam_date',
        'start_time',
        'end_time',
        'file_path',
        'instructions',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'exam_date' => 'date',
        'total_seats' => 'integer',
    ];

    protected $appends = ['file_url', 'download_url'];

    public function getFileUrlAttribute(): ?string
    {
        return $this->file_path ? asset('storage/' . ltrim($this->file_path, '/')) : null;
    }

    public function getDownloadUrlAttribute(): ?string
    {
        return $this->file_url;
    }

    public function globalExam(): BelongsTo
    {
        return $this->belongsTo(GlobalExam::class, 'exam_id');
    }

    public function academicClass(): BelongsTo
    {
        return $this->belongsTo(AcademicClass::class, 'class_id');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
