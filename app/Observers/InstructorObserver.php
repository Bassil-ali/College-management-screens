<?php

namespace App\Observers;

use App\Instructor;
use App\Log;
use Illuminate\Support\Facades\Auth;

class InstructorObserver
{
    /**
     * Handle the instructor "created" event.
     *
     * @param  \App\Instructor  $instructor
     * @return void
     */
    public function created(Instructor $instructor)
    {
        // $this->addLog($instructor, __FUNCTION__);
    }

    /**
     * Handle the instructor "updated" event.
     *
     * @param  \App\Instructor  $instructor
     * @return void
     */
    public function updated(Instructor $instructor)
    {
        $this->addLog($instructor, __FUNCTION__);
    }

    /**
     * Handle the instructor "deleted" event.
     *
     * @param  \App\Instructor  $instructor
     * @return void
     */
    public function deleted(Instructor $instructor)
    {
        // $this->addLog($instructor, __FUNCTION__);
    }

    /**
     * Handle the instructor "restored" event.
     *
     * @param  \App\Instructor  $instructor
     * @return void
     */
    public function restored(Instructor $instructor)
    {
        // $this->addLog($instructor, __FUNCTION__);
    }

    /**
     * Handle the instructor "force deleted" event.
     *
     * @param  \App\Instructor  $instructor
     * @return void
     */
    public function forceDeleted(Instructor $instructor)
    {
        // $this->addLog($instructor, __FUNCTION__);
    }

    private function addLog(Instructor $instructor, $function)
    {
        if (Auth::check()) {
            $object = __('logs.models.instructor', ['name' => $instructor->name]);

            Log::create([
                'user_id' => Auth::user()->id,
                'instructor_id' => $instructor->id,
                'message' => __("logs.$function", ['object' => $object]),
            ]);
        }

    }
}
