<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
    use HasFactory, HasTranslations;

    public array $translatable = [
        'first_name',
        'last_name',
        'father_name',
        'mother_name',
        'guardian_name',
        'address',
        'guardian_address',
    ];

    protected $casts = [
        'first_name' => 'array',
        'last_name' => 'array',
        'father_name' => 'array',
        'mother_name' => 'array',
        'guardian_name' => 'array',
        'address' => 'array',
        'guardian_address' => 'array',
    ];

    protected $fillable = [
        'external_id',
        'user_id',
        'first_name',
        'last_name',
        'father_name',
        'mother_name',
        'class_id',
        'section_id',
        'group',
        'gender',
        'roll_no',
        'registration_no',
        'blood_group',
        'religion',
        'admission_number',
        'address',
        'guardian_name',
        'guardian_email',
        'guardian_phone',
        'guardian_relationship',
        'guardian_address',
        'picture',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function migrations()
    {
        return $this->hasMany(StudentMigration::class);
    }

    public function academicClass()
    {
        return $this->belongsTo(\Modules\Academic\Models\AcademicClass::class, 'class_id');
    }

    public function section()
    {
        return $this->belongsTo(\Modules\Academic\Models\Section::class, 'section_id');
    }
}
