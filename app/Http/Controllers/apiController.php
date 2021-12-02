<?php

namespace App\Http\Controllers;

use App\Screen;
use App\Instructor;
use Illuminate\Http\Request;
use App\Announcement;
use App\Schedule;
use Illuminate\Support\Str;


class apiController extends Controller
{
    public function getAnnouncements($screen_id){
    {
        $screen = Screen::findOrFail($screen_id);
        $day = today()->dayOfWeek;

             $Announcements = $screen->announcements()->where([
                ['is_active', '=', true],
                ['type', '=', 'multi_type'],
                ['content_start', '<=', now()],
                ['content_end', '>=', now()],
            ])->get();

            if($Announcements->count() > 0) {
               
                return response(json_encode([
                  $Announcements,
                ],JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');
            }

        return response(json_encode([
            'image' => 'logo.jpg',
        ],JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');

    }
 }

    public function getSchedule($screen_id)
    {
        $screen = Screen::findOrFail($screen_id);
        $day = today()->dayOfWeek;

        $Schedules = Schedule::select(
        'id','college',
        'specialty','subject_code',
        'subject_name','classification',
        'instructor_name','start',
        'end','contact_hours',
        'instructor_id')->where([
        'hall' => $screen->hall,
        'day_index' => $day
        ])->get();

        if($Schedules->count() > 0){
            foreach($Schedules as $Schedule){
              $lecturesTable[] =  Instructor::where('computer_id' ,$Schedule->instructor_id)->select(
                  'phone','email','photo')->get();
              
            }
        }
       
        if($Schedules->count() > 0 && count($lecturesTable) > 0){
              return response(json_encode([
                 $Schedules,
                 $lecturesTable,
                
            ],JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');
        }
        
        if ($Schedules->count() > 0) {
            return response(json_encode([
                 $Schedule,
                
            ],JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');
        }

        return response(json_encode([
            'image' => 'logo.jpg',
        ],JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');

    }
  }

