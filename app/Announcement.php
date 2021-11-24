<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'screen_id',
        'type',
        'value',
        'content_start',
        'content_end',
        'is_active',
        'user_id',
        'announcements_number'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'content_start',
        'content_end',
    ];

    public function screen()
    {
        return $this->belongsTo(Screen::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
