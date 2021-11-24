<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'fingerprint',
        'user_name',

        'term',
        'college',
        'certificate',
        'specialty',
        'subject_code',
        'subject_name',
        'reference',
        'contact_hours',
        'classification',
        'days',
        'times',
        'building',
        'hall',
        'capacity',
        'registered',
        'rest',
        'instructor_name',
        'instructor_id',

        'day_index',
        'start',
        'end',
    ];

    protected $dates = [
        'start',
        'end',
    ];
}
