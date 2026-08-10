<?php

namespace Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalExamCode extends Model
{
    protected $fillable = ['title', 'total_marks', 'pass_marks', 'acceptance'];
}
