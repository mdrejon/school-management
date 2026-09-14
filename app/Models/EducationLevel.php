<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class EducationLevel extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['campus_id', 'name', 'description', 'sort_order', 'is_active'];
    public array $translatable = ['name', 'description'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function classes()
    {
        return $this->hasMany(EducationClass::class)->orderBy('sort_order');
    }
}
