<?php

namespace Modules\Academic\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Academic\Database\Factories\AcademicClassFactory;

class AcademicClass extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    // protected static function newFactory(): AcademicClassFactory
    // {
    //     // return AcademicClassFactory::new();
    // }
}
