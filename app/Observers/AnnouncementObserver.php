<?php

namespace App\Observers;

use App\Announcement;
use App\Log;
use Illuminate\Support\Facades\Auth;

class AnnouncementObserver
{
    /**
     * Handle the announcement "created" event.
     *
     * @param  \App\Announcement  $announcement
     * @return void
     */
    public function created(Announcement $announcement)
    {
        $this->addLog($announcement, __FUNCTION__);
    }

    /**
     * Handle the announcement "updated" event.
     *
     * @param  \App\Announcement  $announcement
     * @return void
     */
    public function updated(Announcement $announcement)
    {
        $this->addLog($announcement, __FUNCTION__);
    }

    /**
     * Handle the announcement "deleted" event.
     *
     * @param  \App\Announcement  $announcement
     * @return void
     */
    public function deleted(Announcement $announcement)
    {
        $this->addLog($announcement, __FUNCTION__);
    }

    /**
     * Handle the announcement "restored" event.
     *
     * @param  \App\Announcement  $announcement
     * @return void
     */
    public function restored(Announcement $announcement)
    {
        $this->addLog($announcement, __FUNCTION__);
    }

    /**
     * Handle the announcement "force deleted" event.
     *
     * @param  \App\Announcement  $announcement
     * @return void
     */
    public function forceDeleted(Announcement $announcement)
    {
        $this->addLog($announcement, __FUNCTION__);
    }

    private function addLog(Announcement $announcement, $function)
    {
        if (Auth::check()) {
            $object = __('logs.models.announcement', ['type' => __("announcements.types.$announcement->type")]);

            Log::create([
                'user_id' => Auth::user()->id,
                'screen_id' => $announcement->screen->id,
                'message' => __("logs.$function", ['object' => $object]),
            ]);
        }

    }
}
