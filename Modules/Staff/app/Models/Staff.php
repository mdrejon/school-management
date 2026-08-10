<?php

namespace Modules\Staff\Models;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Staff extends Model
{
    use HasTranslations;

    public array $translatable = [
        'name',
        'designation',
        'address',
    ];

    protected $table = 'staffs';

    protected $fillable = [
        'user_id',
        'department_id',
        'name',
        'designation',
        'email',
        'phone',
        'gender',
        'religion',
        'blood_group',
        'serial_no',
        'joining_date',
        'address',
        'photo',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'joining_date' => 'date',
    ];

    protected $appends = ['photo_url'];

    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? '/storage/'.ltrim($this->photo, '/') : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
