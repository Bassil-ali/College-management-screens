<?php

namespace App\Observers;

use App\Screen;
use App\Log;
use Illuminate\Support\Facades\Auth;

class ScreenObserver
{
    /**
     * Handle the screen "created" event.
     *
     * @param  \App\Screen  $screen
     * @return void
     */
    public function created(Screen $screen)
    {
        $this->addLog($screen, __FUNCTION__);
    }

    /**
     * Handle the screen "updated" event.
     *
     * @param  \App\Screen  $screen
     * @return void
     */
    public function updated(Screen $screen)
    {
        $this->addLog($screen, __FUNCTION__);
    }

    /**
     * Handle the screen "deleted" event.
     *
     * @param  \App\Screen  $screen
     * @return void
     */
    public function deleted(Screen $screen)
    {
        $this->addLog($screen, __FUNCTION__);
    }

    /**
     * Handle the screen "restored" event.
     *
     * @param  \App\Screen  $screen
     * @return void
     */
    public function restored(Screen $screen)
    {
        $this->addLog($screen, __FUNCTION__);
    }

    /**
     * Handle the screen "force deleted" event.
     *
     * @param  \App\Screen  $screen
     * @return void
     */
    public function forceDeleted(Screen $screen)
    {
        $this->addLog($screen, __FUNCTION__);
    }

    private function addLog(Screen $screen, $function)
    {
        if (Auth::check()) {
            $object = __('logs.models.screen', ['id' => $screen->id]);

            Log::create([
                'user_id' => Auth::user()->id,
                'screen_id' => $screen->id,
                'message' => __("logs.$function", ['object' => $object]),
            ]);
        }

    }
}
