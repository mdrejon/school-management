<?php

namespace Modules\Academic\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Behavior extends Model
{
    protected $fillable = [
        'teacher_id',
        'title',
        'date',
        'class_id',
        'section_id',
        'student_id',
        'note',
        'attachment',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function academicClass(): BelongsTo
    {
        return $this->belongsTo(AcademicClass::class, 'class_id');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(\Modules\Student\Models\Student::class);
    }
}
