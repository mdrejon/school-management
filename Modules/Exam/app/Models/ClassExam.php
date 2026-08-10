<?php

namespace Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Academic\Models\AcademicClass;

class ClassExam extends Model
{
    protected $fillable = ['class_id', 'global_exam_id', 'merit_type'];

    public function academicClass(): BelongsTo
    {
        return $this->belongsTo(AcademicClass::class, 'class_id');
    }

    public function globalExam(): BelongsTo
    {
        return $this->belongsTo(GlobalExam::class, 'global_exam_id');
    }
}
