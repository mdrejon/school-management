<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Founder extends Model
{
    use HasTranslations;

    public array $translatable = [
        'name',
        'designation',
    ];

    protected $fillable = [
        'name',
        'designation',
        'year',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
