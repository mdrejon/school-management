<?php

namespace Modules\Academic\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Academic\Database\Factories\StudentOptionalSubjectFactory;

class StudentOptionalSubject extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(\Modules\Student\Models\Student::class, 'student_id');
    }

    public function optionalSubjectConfig()
    {
        return $this->belongsTo(OptionalSubjectConfig::class, 'optional_subject_config_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
