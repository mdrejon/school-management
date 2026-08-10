<?php

namespace Modules\Student\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
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
        'picture'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function migrations()
    {
        return $this->hasMany(StudentMigration::class);
    }
}
