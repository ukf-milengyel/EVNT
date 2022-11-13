<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AnnouncementController;
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

// INDEX --------------------------------------------------------------------
Route::get('/', function () {
    return view('welcome');
});

// EVENTS -------------------------------------------------------------------
Route::get('/event/add', function (){
    return view('event.add');
})->name('event.add')->middleware(['auth', 'verified']);

Route::post('/event/attend', [EventController::class, 'attendEvent'])
    ->name('event.attend')->middleware(['auth', 'verified']);

Route::get('/event', [EventController::class, 'index'])
    ->name('event.index')->middleware(['auth', 'verified']);

Route::resource('/event', EventController::class)
    ->only(['show', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

// STATISTICS ---------------------------------------------------------------
Route::get('/statistics', [StatisticsController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('statistics');

// TAGS
Route::get('/tag/add', function (){
    return view('tag.add');
})->name('tag.add')->middleware(['auth', 'verified']);

Route::resource('/tag', TagController::class)
    ->only(['index','show', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

// ANNOUNCEMENTS
// na zobrazovanie všetkých oznámení, pridávanie je možné iba zo stránky podujatia
Route::resource('/announcement', AnnouncementController::class)
    ->only(['index','show', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

// GROUP --------------------------------------------------------------------
Route::get('/group/add', function (){
    return view('group.add');
})->name('group.add')->middleware(['auth', 'verified']);

Route::resource('/group', GroupController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

// USER ---------------------------------------------------------------------
Route::resource('/user', UserController::class)
    ->only(['index', 'edit', 'update'])
    ->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
