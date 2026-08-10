<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Student\Database\Factories\StudentMigrationFactory;

class StudentMigration extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'from_class_id',
        'from_section_id',
        'to_class_id',
        'to_section_id',
        'academic_year',
        'migration_type',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // protected static function newFactory(): StudentMigrationFactory
    // {
    //     // return StudentMigrationFactory::new();
    // }
}
