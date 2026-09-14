<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class EducationClass extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['education_level_id', 'name', 'sort_order', 'is_active'];
    public array $translatable = ['name'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function level()
    {
        return $this->belongsTo(EducationLevel::class, 'education_level_id');
    }
}
