<?php

use Illuminate\Support\Facades\Auth;

return [
    0 => [
        'users',
        'إدارة المستخدمين',
        route('users.index'),
    ],
    1 => [
        'user',
        'المدرسين',
        route('instructors.index'),
    ],
    2 => [
        'calendar',
        'الجداول',
        route('schedules.index'),
    ],
    3 => [
        'thumbnails',
        'الشاشات',
        route('screens.index'),
    ],
    4 => [
        'ignore',
        '',
        '#',
    ],
    5 => [
        'info',
        'حول البرنامج',
        route('about'),
    ],
];
