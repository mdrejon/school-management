<?php

namespace Modules\Academic\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassLesson extends Model
{
    protected $fillable = [
        'teacher_id',
        'title',
        'description',
        'date',
        'class_id',
        'section_id',
        'subject_id',
        'session_id',
        'files',
    ];

    protected $casts = [
        'date' => 'date',
        'files' => 'array',
    ];

    public function academicClass(): BelongsTo
    {
        return $this->belongsTo(AcademicClass::class, 'class_id');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class, 'session_id');
    }
}
