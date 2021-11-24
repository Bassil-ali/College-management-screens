<?php

namespace App\Observers;

use App\User;
use App\Log;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $this->addLog($user, __FUNCTION__);
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        $this->addLog($user, __FUNCTION__);
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        $this->addLog($user, __FUNCTION__);
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        $this->addLog($user, __FUNCTION__);
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        $this->addLog($user, __FUNCTION__);
    }

    private function addLog(User $user, $function)
    {
        if (Auth::check()) {
            $object = __('logs.models.user', ['name' => $user->name]);

            Log::create([
                'user_id' => Auth::user()->id,
                'message' => __("logs.$function", ['object' => $object]),
            ]);
        }

    }
}
