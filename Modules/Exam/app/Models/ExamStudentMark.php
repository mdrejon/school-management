<?php

namespace Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;

class ExamStudentMark extends Model
{
    protected $fillable = [
        'student_id',
        'class_id',
        'section_id',
        'exam_id',
        'subject_id',
        'exam_mark_id',
        'marks_obtained',
    ];

    public function student()
    {
        return $this->belongsTo(\Modules\Student\Models\Student::class, 'student_id');
    }

    public function exam()
    {
        return $this->belongsTo(GlobalExam::class, 'exam_id');
    }

    public function examMark()
    {
        return $this->belongsTo(ExamMark::class, 'exam_mark_id');
    }
}
