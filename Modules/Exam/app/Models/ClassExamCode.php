<?php

namespace Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Academic\Models\AcademicClass;

class ClassExamCode extends Model
{
    protected $fillable = ['class_id', 'global_exam_code_id'];

    public function academicClass(): BelongsTo
    {
        return $this->belongsTo(AcademicClass::class, 'class_id');
    }

    public function globalExamCode(): BelongsTo
    {
        return $this->belongsTo(GlobalExamCode::class, 'global_exam_code_id');
    }
}
