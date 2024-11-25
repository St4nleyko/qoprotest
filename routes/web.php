<?php

use App\Http\Controllers\WatchdogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/watchdogs', [WatchdogController::class, 'index'])->name('watchdog.index');
    Route::get('/create-watchdog', [WatchdogController::class, 'create'])->name('watchdog.create');

    Route::delete('/delete-watchdog/{watchdog}', [WatchdogController::class, 'destroy'])->name('watchdog.delete');
    Route::post('/store-watchdog', [WatchdogController::class, 'store'])->name('watchdog.store');
});

