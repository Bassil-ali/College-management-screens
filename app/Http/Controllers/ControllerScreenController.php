<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Screen;
use App\Schedule;
use Carbon\Carbon;



class ControllerScreenController extends Controller
{
    public function getScreens(){
        $screens = Screen::get();
        $schedule = Schedule::get();
        // $now = Carbon::now()->format('H:i:s');
        return view('screens.controller_screen',compact('screens','schedule'));
    }
}
