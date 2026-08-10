<?php

namespace Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalExamGrade extends Model
{
    protected $fillable = ['grade', 'grade_range'];
}
