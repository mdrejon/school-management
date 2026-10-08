<?php

namespace Modules\Exam\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalExam extends Model
{
    protected $fillable = [
        'external_id',
        'name',
        'code',
        'academic_year',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
