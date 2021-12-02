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
        $screen = Screen::find($screen_id);
        if($screen == NULL){
            return response(json_encode([
            ],JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');
        }
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

    public function Announcements($screen_id){
        {
            $screen = Screen::find($screen_id);
            if($screen == NULL){
                return response(json_encode([
                ],JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');
            }
                $Announcements = $screen->announcements()->where([
                    ['is_active', '=', true],
                    ['type', '=', 'multi_type'],
                    ['content_start', '<=', now()],
                    ['content_end', '>=', now()],
                ])->get();

                if($Announcements->count() > 0) {

                    return response(json_encode(
                    $Announcements
                    ,JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');
                }
                return response(json_encode([
                ],JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');
        }
    }

    public function getSchedule($screen_id)
    {
        $screen = Screen::find($screen_id);
        if($screen == NULL){
            return response(json_encode([
            ],JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');
        }
        $day = today()->dayOfWeek;
        $Schedules = Schedule::select(
            'instructor_name',
            'instructor_id',
            'instructors.email',
            'instructors.photo',
            'schedules.id as subject_id',
            'subject_code',
            'subject_name',
            'college',
            'specialty as subject_specialty',
            'classification as subject_classification',
            'start',
            'end',
        )->leftjoin('instructors','instructors.computer_id','=','instructor_id'
        )->where([
        'hall' => $screen->hall,
        'day_index' => $day
        ])->get();

        foreach($Schedules as $Schedule){
            if($Schedule['email'] == NULL)
                $Schedule['email']="";
            if($Schedule['photo'] == NULL)
                $Schedule['photo']="";
        }

        if($Schedules->count() > 0){

            return response(json_encode(
                $Schedules
           ,JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');
            // foreach($Schedules as $Schedule){
            //   $lecturesTable[] =  Instructor::where('computer_id' ,$Schedule->instructor_id)->select(
            //       'phone','email','photo')->get();

            // }
        }
        return response(json_encode([
        ],JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');
        // if($Schedules->count() > 0 && count($lecturesTable) > 0){
        //       return response(json_encode([
        //          $Schedules,
        //          $lecturesTable,

        //     ],JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');
        // }

        // if ($Schedules->count() > 0) {
        //     return response(json_encode([
        //          $Schedule,

        //     ],JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');
        // }

        // return response(json_encode([
        //     'image' => 'logo.jpg',
        // ],JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');

    }
  }

