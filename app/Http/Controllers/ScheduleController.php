<?php

namespace App\Http\Controllers;

use App\{Instructor, Schedule};
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Imports\ExcelImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        if(auth->user()->is_admin ==1){
        return view('schedules.index', [
            'rows' => Schedule::paginate(500),
            'title' => 'الجداول',
        ]);
    }else{
        return view('schedules.index', [
            'rows' => Schedule::orWhere('specialty', auth()->user()->section)->paginate(500),
            'title' => 'الجداول',
    }
    }

    public function search(Request $request)
    {


        if (auth()->user()->is_admin == 1) {
            return view('schedules.index', [
                'rows' => Schedule::Where('specialty', auth()->user()->section)->orWhere('term',  $request->search)->orWhere('college',  $request->search)->orWhere('certificate',  $request->search)->orWhere('subject_code',  $request->search)->orWhere('subject_name',  $request->search)->orWhere('reference',  $request->search)->orWhere('contact_hours',  $request->search)->orWhere('classification',  $request->search)->orWhere('days',  $request->search)->orWhere('times',  $request->search)->orWhere('capacity',  $request->search)->orWhere('registered',  $request->search)->orWhere('instructor_name',  $request->search)->orWhere('instructor_id',  $request->search)->orWhere('day_index',  $request->search)->orWhere('start',  $request->search)->orWhere('end',  $request->search)->orWhere('hall',  $request->search)->paginate(300),
                'title' => 'الجداول',
                'search' => $request->search,
            ]);
        } else {
            $t = Schedule::Where('specialty', auth()->user()->section)->paginate(300);
            dd($t);
            return view('schedules.index', [
                'rows' => Schedule::Where('specialty', auth()->user()-> section)->paginate(300),
                'title' => 'الجداول',
                'search' => $request->search,
            ]);
        }
    }

    public function download(Request $request)
    {
        abort_if(!$request->user()->is_admin, 403);

        $name = 'الجدول التدريبي الشامل.xlsx';
        $pathToFile = storage_path('files/excel.xlsx');
        return response()->download($pathToFile, $name);
    }

    public function upload(Request $request)
    {
        abort_if(!$request->user()->is_admin, 403);

        $request->validate([
            'excel' => 'required|mimes:xlsx|max:2048',
        ]);

        if ($request->hasFile('excel')) {
            if ($request->file('excel')->isValid()) {

                $extension = $request->excel->extension();
                $file_name = Str::random(10) . '.' . $extension;
                $file_path = $request->excel->storeAs('excel', $file_name);

                Instructor::truncate();
                Schedule::truncate();

                try {
                    Excel::import(new ExcelImport(), $file_path);
                } catch (ValidationException $e) {
                    $failures = $e->failures();
                    foreach ($failures as $failure) {
                        return back()->with('warning',  __('excel.failure', ['row' => $failure->row(), 'attribute' => $failure->attribute()]));
                    }
                }

                $files = Storage::disk('excel')->files();
                foreach ($files as $f) {
                    Storage::disk('excel')->delete($f);
                }

                $request->user()->logs()->create([
                    'screen_id' => 0,
                    'message' => __('logs.schedules'),
                ]);


                return back()->with('success', __('schedules.excel-uploaded'));
            } else {
                return back()->with('error', __('schedules.excel-invalid'));
            }
        }
    }
}
