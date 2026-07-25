<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Visitor submissions from the public /contact form — a plain admin inbox,
 * not a translatable admin-authored content type like everything else in
 * this app. No sort_order: chronological like Notice, newest first.
 */
class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function markRead(): void
    {
        if (! $this->read_at) {
            $this->update(['read_at' => now()]);
        }
    }
}
