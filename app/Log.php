<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'user_id',
        'screen_id',
        'instructor_id',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function screen()
    {
        return $this->belongsTo(Screen::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
