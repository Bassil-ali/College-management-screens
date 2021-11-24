<?php

namespace App\Http\Controllers;

use App\Screen;
use App\Schedule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ScreenController extends Controller
{
    public function index(Request $request)
    {
        \Artisan::call('storage:link');

        $buttonText = $request->user()->is_admin ? __('screens.add-global') : __('screens.add-mine');
        if($request->user()->is_admin){
            $screens = Screen::all();

        }else{
            $screens = Screen::where('user_id',auth()->user()->id)->get();
        }

        return view('screens.index', [
            'title' => __('screens.title'),
            'button' => $buttonText,
            'screens' => $screens,
        ]);
    }

    public function add(Request $request)
    {
        // dd($request->all());

        Screen::create([
            'id' => $request->id,
            'fingerprint' => Str::random(80),
            'hall' => $request->hall,
        ]);

        return back()->with('success', __('screens.added'));
    }

    public function delete(Request $request, Screen $screen)
    {
        if ($request->isMethod('DELETE')) {
            $screen->delete();
            return redirect()->route('screens.index');
        }

        return back();
    }

    public function show(Request $request, Screen $screen)
    {
        $show = false;
        if($request->user()->is_admin) {
            $show = true;
        } else {
            if (isset($screen->user)) {
                if ($screen->user->id == $request->user()->id) {
                    $show = true;
                }
            }
        }

        abort_if(!$show, 403);

        $lectures = Schedule::where('hall', $screen->hall)
            ->orderBy('day_index', 'asc')
            ->orderBy('start', 'asc')
            ->get();

        return view('screens.show', [
            'title' => __('screens.screen', ['number' => $screen->id]),
            'screen' => $screen,
            'lectures' => $lectures,
        ]);
    }

    public function update(Request $request, Screen $screen)
    {
        $screen->hall = $request->hall;
        $screen->save();

        return back()->with('success', __('screens.updated'));
    }
}
