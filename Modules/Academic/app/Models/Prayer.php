<?php

namespace Modules\Academic\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prayer extends Model
{
    protected $fillable = [
        'teacher_id',
        'subject',
        'note',
        'date',
        'session_id',
        'file_path',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class, 'session_id');
    }
}
