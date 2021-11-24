<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Screen;
use App\User;
use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //abort_if(!$request->user()->is_admin, 403);

        return view('users.index', [
            'title' => __('users.title')
        ]);
    }

    public function loadUsers()
    {
        return response()->json([
            'html' => view('users.table')->render(),
        ]);
    }

    public function store(UserRequest $request)
    {
        abort_if(!$request->user()->is_admin, 403);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'is_admin' => $request->has('is_admin'),
            'section' => $request->section,
            'password' => bcrypt('1234'),
        ]);

        return back()->with('success', __('users.add-user-confirmation', ['name' => $user->name]));
    }

    public function logDelete($id){

        Log::where('id',$id)->delete();

        return back()->with('success', __('users.destroy-confirmation', ['name' => 'من السجلات']));
    }

    public function update(Request $request, User $user)
    {
        abort_if(!$request->user()->is_admin, 403);

        if ($request->isMethod('PATCH')) {
            $user->password = bcrypt('1234');
            $user->save();
            return response()->json([
                'message' => __('users.unlock-confirmation', ['name' => $user->name])
            ]);
        }

        if ($request->isMethod('POST')) {
            $user->name = $request->name;
            $user->username = $request->username;
            $user->is_admin = $request->has('is_admin');
            $user->section = $request->section;
            $user->save();

            return back()->with('success', __('users.update-user-confirmation', ['name' => $user->name]));

            return response()->json([
                'message' => __('users.update-user-confirmation', ['name' => $user->name]),
                'name' => $user->name,
                'username' => $user->username,
            ]);
        }
    }

    public function destroy(User $user)
    {
        abort_if(User::count() == 1, 403, __('users.only-one-message'));

        $this->removeScreens($user);
        
        foreach($user->logs as $log) {
            $log->delete();
        }
        
        $user->delete();
        return response()->json([
            'message' => __('users.destroy-confirmation', ['name' => $user->name])
        ]);
    }

    public function changePassword(Request $request)
    {
        $user = $request->user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
            return back()->with('success', __('users.password-confirmation-message'));
        }

        return back()->with('error', __('users.invalid-password-message'));
    }

    public function assignScreen(Request $request, User $user)
    {
        abort_if(!$request->user()->is_admin, 403);

        $this->removeScreens($user);

         if(isset($request->screen))
        {
            foreach ($request->screen as $key => $value) {
            $screen = Screen::find($value);
            $screen->user_id = $user->id;
            $screen->save();
        }
        }

        return back()->with('success', __('users.screens-message'));
    }

    public function removeScreens(User $user)
    {
        foreach ($user->screens as $screen) {
            $screen->user_id = null;
            $screen->save();
        }
    }

    public function viewLog(Request $request, User $user)
    {
       

        return view('users.logs', [
            'logs' => $user->logs,
            'name' => $user->name,
            'section' => $user->section,
            'title' => __('app.log'),
        ]);
    }
}
