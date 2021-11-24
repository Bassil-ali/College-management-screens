<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $fillable = [
        'computer_id',
        'name',
        'photo',
        'email',
        'phone',
        'section'
    ];

    public function lectures()
    {
        return $this->hasMany(Schedule::class, 'instructor_id', 'computer_id','section');
    }

    public function logs()
    {
        return $this->hasMany(Log::class, '');
    }
}
