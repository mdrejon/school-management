<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Campus extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['name', 'sort_order', 'is_active'];
    public array $translatable = ['name'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function levels()
    {
        return $this->hasMany(EducationLevel::class)->orderBy('sort_order');
    }
}
