<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resources([
        'calendars' => 'CalendarController'
    ]);
    Route::get('calendar-embed', 'CalendarController@embed')->name('calender-embed');
});

    Route::get('/home', 'HomeController@index')->name('home');
    Route::view('about', 'about')->name('about');

    Route::resources([
        'users' => 'UserController'
    ]);

    Route::get('profile', 'ProfileController@show')->name('profile.show');
    Route::put('profile', 'ProfileController@update')->name('profile.update');
