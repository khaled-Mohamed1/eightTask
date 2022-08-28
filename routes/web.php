<?php

use App\Http\Controllers\EventController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(EventController::class)->group(function () {
    Route::get('calendars', 'index')->name('calendars');
    Route::post('calendars-create', 'create')->name('calendar.create');
    Route::post('calendars-weeklycreate', 'weeklycreate')->name('calendar.weeklycreate');
    Route::post('calendars-update', 'update')->name('calendar.update');
    Route::post('calendars-delete', 'delete')->name('calendar.delete');
});
