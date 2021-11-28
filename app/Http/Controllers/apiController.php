<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Announcement;
use App\Schedule;

class apiController extends Controller
{
    public function getAnnouncements(){
        $announcements = Announcement::get();

        return response()->json($announcements);
    }

    public function getSchedule()
    {
        $schedules = Schedule::get();

        return response()->json($schedules);
    }
}
