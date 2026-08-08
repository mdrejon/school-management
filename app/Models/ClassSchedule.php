<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ClassSchedule extends Model
{
    use HasTranslations;

    public array $translatable = [
        'title',
        'time_info',
    ];

    protected $fillable = [
        'title',
        'time_info',
        'is_bullet',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_bullet' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
