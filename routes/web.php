<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/s/{id?}', 'MonitorController@show')->name('monitor');

Route::post('/set', 'MonitorController@show')->name('set-monitor');
Route::get('m/{id}', 'MonitorController@getScreen')->name('api.screen');

Route::middleware(['auth'])->group(function () {
    Route::prefix('screens')->group(function () {
        Route::get('{screen?}', 'ScreenController@index')->name('screens.index');
        Route::get('show/{screen}', 'ScreenController@show')->name('screens.show');
        Route::post('update/{screen}', 'ScreenController@update')->name('screens.update');

        Route::post('add', 'ScreenController@add')->name('screens.add');
        Route::delete('delete/{screen}', 'ScreenController@delete')->name('screens.delete');
    });

    Route::prefix('announcements')->group(function () {
        Route::get('All-Announcement', 'AnnouncementController@getAllannouncement')->name('All.Announcement');
        Route::post('updateAllannouncement', 'AnnouncementController@updateAllannouncement')->name('updateAllannouncement');
        Route::get('All-Announcement-delete/{id}', 'AnnouncementController@deleteAllannouncement')->name('All.Announcement.delete');
        Route::get('edit-All-Announcement/{number}', 'AnnouncementController@editAllAllannouncement')->name('edit.All.Announcement');
        Route::get('edit-one-Announcement/{id}', 'AnnouncementController@editOneannouncement')->name('edit.one.Announcement');

        Route::post('create', 'AnnouncementController@create')->name('announcements.create');
        Route::post('update', 'AnnouncementController@update')->name('announcements.update');
        Route::post('change-active', 'AnnouncementController@changeActive')->name('announcements.change-active');
        Route::post('add-global', 'AnnouncementController@addGlobal')->name('announcements.global');
        Route::delete('delete', 'AnnouncementController@delete')->name('announcements.delete');
        Route::get('dialog', 'AnnouncementController@getDialog')->name('announcements.dialog');
        Route::post('activate-text', 'AnnouncementController@activateText')->name('announcements.activate-text');
        Route::post('mass-cmd', 'AnnouncementController@doMassCommand')->name('announcements.mass-cmd');
    });

    Route::prefix('schedules')->group(function () {
        Route::get('controller-screens','ControllerScreenController@getScreens')->name('controller.screens');
        Route::get('', 'ScheduleController@index')->name('schedules.index');
        Route::get('search', 'ScheduleController@search')->name('schedules.search');
        Route::get('download', 'ScheduleController@download')->name('schedules.download');
        Route::post('upload', 'ScheduleController@upload')->name('schedules.upload');
    });

    Route::prefix('instructors')->group(function () {
        Route::get('', 'InstructorController@index')->name('instructors.index');
        Route::get('show/{computer_id}', 'InstructorController@show')->name('instructors.show');
        Route::get('download', 'InstructorController@download')->name('instructors.download');
        Route::post('upload', 'InstructorController@upload')->name('instructors.upload');
        Route::post('upload-photo', 'InstructorController@uploadPhoto')->name('instructors.upload');
        Route::post('remove-photo', 'InstructorController@removePhoto')->name('instructors.remove');
        Route::get('instructors-delete/{computer_id}', 'InstructorController@delete')->name('instructors.delete');
    });

    // Route::get('timing', 'TimingController@show')->name('timing.get');
    // Route::post('timing', 'TimingController@update')->name('timing.post');

    Route::prefix('users')->group(function () {
        Route::get('', 'UserController@index')->name('users.index');
        Route::get('table', 'UserController@loadUsers')->name('users.table');
        Route::put('{user}', 'UserController@update')->name('users.update');
        Route::post('{user}', 'UserController@update')->name('users.edit');
        Route::post('', 'UserController@store')->name('users.store');
        Route::post('password', 'UserController@changePassword')->name('users.password');
        Route::post('screens/{user}', 'UserController@assignScreen')->name('users.screens');
        Route::get('log/{user}', 'UserController@viewLog')->name('users.log');
        Route::get('user-log-delete/{id}', 'UserController@logDelete')->name('user.log.delete');
    });

    // Route::resource('users', 'UserController')->only(['index', 'update', 'destroy', 'store']);

    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::get('/about', 'HomeController@about')->name('about');
    Route::get('/about-edit', 'HomeController@aboutEdit')->name('about.edit');
    Route::get('/about-update', 'HomeController@aboutUpdate')->name('about.edit.update');


});

