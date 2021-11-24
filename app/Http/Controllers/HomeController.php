<?php

namespace App\Http\Controllers;
use App\About;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function about()
    {
        return view('about', [
            'title' => 'حول البرنامج',
        ]);
    }
    public function aboutEdit(){
        return view('about-edit');

    }

    public function aboutUpdate(Request $request){
       $e =  About::where('id', 1)->update(['string' => $request->text]);
        return redirect()->route('about')->with('success', __('تم التعديل بنجاح'));

    }
}
