<?php

namespace Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Academic\Models\AcademicClass;
use Modules\Student\Models\Student;

class ExamResult extends Model
{
    protected $table = 'exam_results';

    protected $fillable = [
        'external_id',
        'exam_id',
        'exam_name',
        'student_id',
        'student_external_id',
        'student_name',
        'roll_no',
        'registration_no',
        'class_id',
        'class_name',
        'section_name',
        'group_name',
        'academic_year',
        'total_marks',
        'obtained_marks',
        'gpa',
        'grade',
        'merit_position',
        'status',
        'remarks',
        'subjects_data',
        'pdf_marksheet',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'subjects_data' => 'array',
        'is_published' => 'boolean',
        'published_at' => 'date',
        'total_marks' => 'decimal:2',
        'obtained_marks' => 'decimal:2',
        'gpa' => 'decimal:2',
    ];

    protected $appends = ['marksheet_url', 'download_url'];

    public function getMarksheetUrlAttribute(): ?string
    {
        return $this->pdf_marksheet ? asset('storage/' . ltrim($this->pdf_marksheet, '/')) : null;
    }

    public function getDownloadUrlAttribute(): ?string
    {
        return $this->marksheet_url;
    }

    public function exam(): BelongsTo
    {
        return $this->belongsTo(GlobalExam::class, 'exam_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function academicClass(): BelongsTo
    {
        return $this->belongsTo(AcademicClass::class, 'class_id');
    }
}
