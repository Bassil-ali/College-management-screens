<?php

namespace App\Providers;

use App\Observers\{
    AnnouncementObserver,
    InstructorObserver,
    ScreenObserver,
    UserObserver
};
use App\{
    Announcement,
    Instructor,
    Screen,
    User
};
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Announcement::observe(AnnouncementObserver::class);
        Instructor::observe(InstructorObserver::class);
        Screen::observe(ScreenObserver::class);
        User::observe(UserObserver::class);
    }
}
