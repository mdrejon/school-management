<?php

namespace Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Academic\Models\AcademicClass;

class ClassExamGrade extends Model
{
    protected $fillable = ['class_id', 'global_exam_grade_id'];

    public function academicClass(): BelongsTo
    {
        return $this->belongsTo(AcademicClass::class, 'class_id');
    }

    public function globalExamGrade(): BelongsTo
    {
        return $this->belongsTo(GlobalExamGrade::class, 'global_exam_grade_id');
    }
}
