<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Donor extends Model
{
    use HasTranslations;

    public array $translatable = [
        'name',
        'contribution',
    ];

    protected $fillable = [
        'name',
        'contribution',
        'year',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];
}
