<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Screen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Foreach_;
use Redirect;


class AnnouncementController extends Controller
{
    protected $rules = [
        'photo' => 'required|mimes:jpeg,jeg,bmp,png|max:2048',
        'video' => 'required|mimes:vid,mp4,mkv|max:20480',
        'pdf' => 'required|mimes:pdf|max:2048',
    ];

    public function create(Request $request)
    {
        $announcement = null;

          if ($request->type == "multi_type") {
              if ($request->text[0] == null && $request->image == null && $request->vedio == null) {
                return back()->with('error', "تاكد من البيانات الدخلة");

            }
            $request->validate([
                'content_start' => 'required',
                'content_end' => 'required',

            ]);


            if ($request->image == null) {
                $result['images'] =  [];
            }

            if ($request->text[0] == null) {
                $result['text'] = [];
            }

            if ($request->vedio == null) {
                $result['vedio'] =  [];
            }
            if ($request->text[0] != null) {

                $result['text'][] = $request->text;
            }
                if ($request->image != null) {
                    foreach ($request->image as $image) {
                        $extension = $image->extension();
                        $value = Str::random(10) . '.' . $extension;
                        $result['images'][] = $value;
                        $image->storeAs('content', $value);
                    }
                }
                if ($request->vedio != null) {
                    foreach ($request->vedio as $vedio) {

                        $extension = $vedio->extension();
                        $value = Str::random(10) . '.' . $extension;
                        $result['vedio'][] = $value;

                        $vedio->storeAs('content', $value);
                    }
                }

                    $conuter = 0;
                    $announcement = Announcement::create([
                        'screen_id' => $request->screen_id,
                        'type' => $request->type,
                        'value' => json_encode($result),
                        'is_active' => true,
                        'user_id' => auth()->user()->id,
                        'announcements_number' => $conuter,
                        'content_start' => $request->content_start,
                        'content_end' => $request->content_end,
                    ]);
                    $announcement->screen()->update([
                'fingerprint' => Str::random(80),
            ]);
                

        return back()->with('success', __('announcements.create'));
     }
        if ($request->type == 'text') {
            $request->validate([
                'text' => 'required',
            ]);

            $announcement = Announcement::create([
                'screen_id' => $request->screen_id,
                'type' => $request->type,
                'value' => $request->text,
                'is_active' => true,
                'user_id' => $request->user()->id,
                'content_start' => $request->content_start,
                'content_end' => $request->content_end,
            ]);
            $announcement->screen()->update([
                'fingerprint' => Str::random(80),
            ]);
        } else {
            $announcement = $this->addContent($request);
            $announcement->screen()->update([
                'fingerprint' => Str::random(80),
            ]);
        }

        return back()->with('success', __('announcements.create'));
    }

    private function addContent(Request $request, Announcement $announcement = null): Announcement
    {
        $request->validate([
            'content' => $this->rules[$request->type],
        ]);

        DB::beginTransaction();

        $extension = $request->content->extension();
        $file_name = Str::random(10) . '.' . $extension;
        $request->content->storeAs('content', $file_name);

        $request->content->move(public_path('/content/'), $file_name);

        if (isset($announcement)) {
            Storage::disk('content')->delete($announcement->value);
            $announcement->update([
                'type' => $request->type,
                'value' => $file_name,
                'content_start' => $request->content_start,
                'content_end' => $request->content_end,
                'user_id' => $request->user()->id,
            ]);
        } else {
            $announcement = Announcement::create([
                'screen_id' => $request->screen_id,
                'type' => $request->type,
                'value' => $file_name,
                'is_active' => true,
                'content_start' => $request->content_start,
                'content_end' => $request->content_end,
                'user_id' => $request->user()->id,
            ]);
        }

        DB::commit();

        return $announcement;
    }

    public function update(Request $request)
    {
        $announcement = Announcement::find($request->id);
        if ($request->type == "multi_type") {

            $request->validate([
                'content_start' => 'required|date',
                'content_end' => 'required|date',
            ]);

           
            if ($request->image == null) {
                $result['images'] =  [];

            }

            if ($request->text[0] == null) {
                $result['text'] = [];
            }

            if ($request->vedio == null) {
                $result['vedio'] =  [];

            }
            if ($request->text[0] != null) {

                $result['text'][] = $request->text;
            }
            if ($request->image != null) {
                foreach ($request->image as $image) {
                    $extension = $image->extension();
                    $value = Str::random(10) . '.' . $extension;
                    $result['images'][] = $value;
                    $image->storeAs('content', $value);
                }
            }

            if ($request->vedio != null) {
                foreach ($request->vedio as $vedio) {

                    $extension = $vedio->extension();
                    $value = Str::random(10) . '.' . $extension;
                    $result['vedio'][] = $value;

                    $vedio->storeAs('content', $value);
                }
            }

            $announcement->update([
                'type' => $request->type,
                'value' => json_encode($result),
                'is_active' => true,
                'content_start' => $request->content_start,
                'content_end' => $request->content_end,
            ]);
            return redirect()->route('screens.show',$announcement->screen_id)->with('success', __('announcements.update'));
        }
        if ($request->type == 'text') {
            $announcement->update([
                'value' => $request->text,
                'content_start' => $request->content_start,
                'content_end' => $request->content_end,
            ]);
            if ($announcement->is_active) {
                $announcement->screen()->update([
                    'fingerprint' => Str::random(80),
                ]);
            }
        } else {
            $this->addContent($request, $announcement);
            $announcement->screen()->update([
                'fingerprint' => Str::random(80),
            ]);
        }

        return back()->with('success', __('announcements.update'));
    }

    public function delete(Request $request)
    {
        $announcement = Announcement::find($request->delete_id);
        $announcement->screen()->update(['fingerprint' => Str::random(80)]);
        $announcement->delete();

        return back()->with('success', __('announcements.delete'));
    }

    public function changeActive(Request $request)
    {
        $announcement = Announcement::find($request->id);
        $announcement->is_active = !$announcement->is_active;
        $announcement->save();

        // Check if all announcement are deactivated
        $announcement->screen()->update(['fingerprint' => Str::random(80)]);

        return back()->with('success', __('announcements.update'));
    }

    public function getDialog(Request $request)
    {
        $announcement = Announcement::find($request->id);
        return view('screens._dialog', ['announcement' => $announcement])->render();
    }

    public function addGlobal(Request $request)
    {

        // dd($request->all());

        $conuter = Announcement::select('announcements_number')->latest()->first();
        if ($conuter == null) {
            $pluse =  $conuter = 1;
        } else {
            $pluse =  $conuter->announcements_number;
            $pluse++;
        }
        $conuter =  $pluse;


        $user = $request->user();

        if ($user->is_admin) {
            $screens = Screen::all();
        } else {
            $screens = Screen::where('user_id', $user->id)->get();
        }

        if ($request->text[0] == null && $request->image == null && $request->vedio == null) {
                return back()->with('error', "تاكد من البيانات الدخلة");

            }
        if ($request->type == "multi_type") {
            $request->validate([
                'content_start' => 'required',
                'content_end' => 'required',

            ]);

            

            if ($request->image == null) {
                $result['images'] =  [];
            }

            if ($request->text[0] == null) {
                $result['text'] = [];
            }

            if ($request->vedio == null) {
                $result['vedio'] =  [];
            }
            if ($request->text[0] != null) {

                $result['text'][] = $request->text;
            }
                if ($request->image != null) {
                    foreach ($request->image as $image) {
                        $extension = $image->extension();
                        $value = Str::random(10) . '.' . $extension;
                        $result['images'][] = $value;
                        $image->storeAs('content', $value);
                    }
                }
                if ($request->vedio != null) {
                    foreach ($request->vedio as $vedio) {

                        $extension = $vedio->extension();
                        $value = Str::random(10) . '.' . $extension;
                        $result['vedio'][] = $value;

                        $vedio->storeAs('content', $value);
                    }
                }
                foreach ($screens as $screen) {


                    $screen->announcements()->create([
                        'type' => $request->type,
                        'value' => json_encode($result),
                        'is_active' => true,
                        'user_id' => $user->id,
                        'announcements_number' => $conuter,
                        'content_start' => $request->content_start,
                        'content_end' => $request->content_end,
                    ]);
                }
            return back()->with('success', __('announcements.create'));

            }
       
        // Validation
        if ($request->type == 'text') {
            $request->validate([
                'content_start' => 'required|date:H:i Y-m-d',
                'content_end' => 'required|date:H:i Y-m-d',
                'text' => 'required',
            ]);
        } else {

            $request->validate([
                'content' => $this->rules[$request->type],
            ]);
        }

        DB::transaction(function () use ($request) {
            $user = $request->user();

            if ($user->is_admin) {
                $screens = Screen::all();
            } else {
                $screens = Screen::where('user_id', $user->id)->get();
            }

            $conuter = Announcement::select('announcements_number')->latest()->first();
            if ($conuter == null) {
                $pluse =  $conuter = 1;
            } else {
                $pluse =  $conuter->announcements_number;
                $pluse++;
            }

            $conuter =  $pluse;

            foreach ($screens as $screen) {
                if ($request->type == 'text') {
                    $value = $request->text;
                } else {
                    $extension = $request->content->extension();
                    $value = Str::random(10) . '.' . $extension;
                    $request->content->storeAs('content', $value);
                }

                $screen->announcements()->create([
                    'type' => $request->type,
                    'value' => $value,
                    'is_active' => true,
                    'user_id' => $user->id,
                    'announcements_number' => $conuter,
                    'content_start' => $request->content_start,
                    'content_end' => $request->content_end,
                ]);
            }
        });

        return back()->with('success', __('announcements.create'));
    }

    public function activateText(Request $request)
    {
        $announcement = Announcement::find($request->id);
         $request->validate([
                'content_start' => 'required',
                'content_end' => 'required',

            ]);
        $announcement->update([
            'is_active' => true,
            'content_start' => $request->content_start,
            'content_end' => $request->content_end,
        ]);

        $announcement->screen()->update([
            'fingerprint' => Str::random(80),

        ]);

        return back()->with('success', __('announcements.update'));
    }

    public function doMassCommand(Request $request)
    {
        // dd($request->all());

        switch ($request->command) {
            case 'deactivate':
                Announcement::whereIn('id', $request->announcement)->update(['is_active' => false]);
                break;

            case 'activate':
                Announcement::whereIn('id', $request->announcement)->update(['is_active' => true]);
                break;

            case 'delete':
                Announcement::whereIn('id', $request->announcement)->delete();
                break;
        }

        return back()->with('success', __('announcements.mass_cmd_msg'));
    }

    public function getAllannouncement()
    {


        $Announcement = Announcement::where('announcements_number','!=',0)->select('announcements_number')->distinct()->get();

        $announcements = [];
        foreach ($Announcement as $distinct) {
            $announcements[] = Announcement::where('announcements_number', $distinct->announcements_number)->first();
        }


        return view('screens._all_announcements', compact('announcements'));
    }

    public function updateAllannouncement(Request $request)
    {

        $announcement = Announcement::find($request->announcements_number);

       
        if ($request->type == "multi_type") {
            if ($request->text[0] == null && $request->image == null && $request->vedio == null) {
                            return back()->with('error', "تاكد من البيانات الدخلة");

                        }
            $request->validate([
                'content_start' => 'required|date',
                'content_end' => 'required|date',
            ]);


            if ($request->image == null) {
                $result['images'] =  [];
            }

            if ($request->text[0] == null) {
                $result['text'] = [];
            }

            if ($request->vedio == null) {
                $result['vedio'] =  [];
            }
            if ($request->text[0] != null) {

                $result['text'][] = $request->text;
            }
                if ($request->image != null) {
                    foreach ($request->image as $image) {
                        $extension = $image->extension();
                        $value = Str::random(10) . '.' . $extension;
                        $result['images'][] = $value;
                        $image->storeAs('content', $value);
                    }
                }

                if ($request->vedio != null) {
                    foreach ($request->vedio as $vedio) {

                        $extension = $vedio->extension();
                        $value = Str::random(10) . '.' . $extension;
                        $result['vedio'][] = $value;

                        $vedio->storeAs('content', $value);
                    }
                }

                $announcement->where('announcements_number', $request->announcements_number)->update([
                        'type' => $request->type,
                        'value' => json_encode($result),
                        'is_active' => true,
                        'content_start' => $request->content_start,
                        'content_end' => $request->content_end,
                    ]);
            return redirect()->route('All.Announcement')->with('success', __('announcements.update'));

            }
       
        if ($request->type == 'text') {
            $announcement->where('announcements_number', $request->announcements_number)->update([
                'type' => $request->type,
                'value' => $request->text,
                'announcements_number' => $request->announcements_number,
                'content_start' => $request->content_start,
                'content_end' => $request->content_end,
            ]);
        } else {

            $request->validate([
                'content' => $this->rules[$request->type],
            ]);

            DB::beginTransaction();

            $extension = $request->content->extension();
            $file_name = Str::random(10) . '.' . $extension;
            $request->content->storeAs('content', $file_name);

            $request->content->move(public_path('/content/'), $file_name);

            Announcement::where('announcements_number', $request->announcements_number)->update([
                'type' => $request->type,
                'value' => $file_name,
                'announcements_number' => $request->announcements_number,
                'content_start' => $request->content_start,
                'content_end' => $request->content_end,
            ]);


            DB::commit();
        }

        return back()->with('success', __('announcements.update'));
    }

    public function deleteAllannouncement($id)
    {
        $announcement = Announcement::where('announcements_number', $id)->get();
        foreach ($announcement as $ann) {
            $ann->delete();
        }

        return back()->with('success', __('announcements.delete'));
    }

    public function editAllAllannouncement($number)
    {
        $announcement = Announcement::where('announcements_number', $number)->first();

      return view('screens.edit_all_announcements',compact('announcement'));
    }

    public function editOneannouncement($id)
    {
        $announcement = Announcement::where('id', $id)->first();

      return view('screens.edit_one_announcement',compact('announcement'));
    }
}
