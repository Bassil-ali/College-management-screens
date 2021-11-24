<?php

namespace App\Http\Controllers;

use App\Screen;
use App\Schedule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function getScreen($id)
    {
        $screen = Screen::findOrFail($id);
        $day = today()->dayOfWeek;

        $lectures = Schedule::where([
            'hall' => $screen->hall,
            'day_index' => $day
        ])->get();

        // Text Announcements
        $textAnnouncements = $screen->announcements()->where([
            ['is_active', '=', true],
            ['type', '=', 'text'],
            ['content_start', '<=', now()],
            ['content_end', '>=', now()],
        ])->get();

        if($textAnnouncements->count() > 0) {

                return response(json_encode([
                    'text' => $textAnnouncements->first()->value,
                    'type' => 'text'
                ],JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');
        }

            // Check For image Announcements
            $imageAnnouncements = $screen->announcements()->where([
                ['is_active', '=', true],
                ['type', '=', 'photo'],
                ['content_start', '<=', now()],
                ['content_end', '>=', now()],
            ])->get();

            if($imageAnnouncements->count() > 0) {
              
                return response(json_encode([
                    'image' => $imageAnnouncements->first()->value,
                    'type' => 'image'
                ],JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');
            }

            // Check For video Announcements
            $videoAnnouncements = $screen->announcements()->where([
                ['is_active', '=', true],
                ['type', '=', 'video'],
                ['content_start', '<=', now()],
                ['content_end', '>=', now()],
            ])->get();


            if($videoAnnouncements->count() > 0) {
               
                return response(json_encode([
                    'video' => $videoAnnouncements->first()->value,
                    'type' => 'video'
                ],JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');
            }


        // Lectures
        $current = null;
        $now = now();
        foreach ($lectures as $lecture) {
            if($now >= $lecture->start && $now <= $lecture->end) {
                $current = $lecture;
                break;
            }
        }
        if (isset($current)) {
            // Change the fingerprint if the lecture end greater than or equals the screen's last update
            if ($current->end->greaterThanOrEqualTo($screen->updated_at)) {
                $screen->fingerprint = Str::random(80);
                $screen->save();
            }

            return  response(json_encode([
                'current' => $current,
                'type' => 'current',
            ],JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');

        }

        //for test ==> to delete
       /*return  response(json_encode([
            'current' => $lectures->first(),
            'type' => 'current',
        ],JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');*/


        // Return default
        if ($lectures->count() > 0) {
            return response(json_encode([
                'table' => $lectures,
                'type' => 'table',
            ],JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');
        }

        return response(json_encode([
            'image' => 'logo.jpg',
            'type' => 'image'
        ],JSON_UNESCAPED_UNICODE))->header('Content-Type', 'application/json');

    }


    public function show(Request $request, $id = null)
    {
        if ($request->isMethod('POST')) {
            return redirect()->route('monitor', ['id' => $request->id]);
        }

        if (isset($id)) {
            $screen = Screen::findOrFail($id);

            return view('monitor.show', [
                'screen' => $id,
                'fingerprint' => $screen->fingerprint,
            ]);
        }

        return view('monitor.setup');
    }

    public function getMonitorContnet(Request $request)
    {
        $screen = Screen::findOrFail($request->screen);
        $day = today()->dayOfWeek;

        $lectures = Schedule::where([
            'hall' => $screen->hall,
            'day_index' => 2
        ])->get();

    
    
        // Text Announcements
        $textAnnouncements = $screen->announcements()->where([
            ['is_active', '=', true],
            ['type', '=', 'text'],
            ['content_start', '<=', now()],
            ['content_end', '>=', now()],
        ])->get();

        if($textAnnouncements->count() > 0) {

                $html = view('monitor.announcements', ['announcements' => $textAnnouncements])->render();
                return json_encode([
                    'html' => $html,
                    'fingerprint' => $screen->fingerprint,
                ]);
        }

   // Check For image Announcements
   $imageAnnouncements = $screen->announcements()->where([
    ['is_active', '=', true],
    ['type', '=', 'photo'],
    ['content_start', '<=', now()],
    ['content_end', '>=', now()],
])->get();


if($imageAnnouncements->count() > 0) {
    $html = view('monitor.announcements', ['announcements' => $imageAnnouncements])->render();
    return json_encode([
        'html' => $html,
        'fingerprint' => $screen->fingerprint,
        'announcements' => true,
    ]);
}

        // Check For video Announcements
        $videoAnnouncements = $screen->announcements()->where([
            ['is_active', '=', true],
            ['type', '=', 'video'],
            ['content_start', '<=', now()],
            ['content_end', '>=', now()],
        ])->get();


        if($videoAnnouncements->count() > 0) {
            $html = view('monitor.announcements', ['announcements' => $videoAnnouncements])->render();
            return json_encode([
                'html' => $html,
                'fingerprint' => $screen->fingerprint,
                'announcements' => true,
            ]);
        }


        // Lectures
        $current = null;
        $now = now();
        foreach ($lectures as $lecture) {
            if($now >= $lecture->start && $now <= $lecture->end) {
                $current = $lecture;
                break;
            }
        }
        if (isset($current)) {
            // Change the fingerprint if the lecture end greater than or equals the screen's last update
            if ($current->end->greaterThanOrEqualTo($screen->updated_at)) {
                $screen->fingerprint = Str::random(80);
                $screen->save();
            }

            $html = view('monitor.lecture', ['lecture' => $current])->render();

            return json_encode([
                'html' => $html,
                'fingerprint' => $screen->fingerprint,
            ]);
        }
        // Return default
        if ($lectures->count() > 0) {
            $html = view('monitor.default', ['lectures' => $lectures->sortBy('start')])->render();
            return json_encode([
                'html' => $html,
                'fingerprint' => $screen->fingerprint,
                'lectures' => true,
            ]);
        }

        $html = view('monitor.logo')->render();
            return json_encode([
                'html' => $html,
                'fingerprint' => $screen->fingerprint,
                'logo' => true,
            ]);
    }

  
}
