<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('screen', 'MonitorController@getMonitorContnet')->name('api.monitor');
Route::get('Announcements', 'apiController@getAnnouncements')->name('api.Announcements');
Route::get('Schedules', 'apiController@getSchedule')->name('api.Schedules');

Route::prefix('users')->group(function () {
    Route::delete('{user}', 'UserController@destroy')->name('users.destroy');
});
