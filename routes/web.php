<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ThemeController;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/theme', [ThemeController::class, 'index'])->name('theme');
Route::get('/theme/{theme}', [ThemeController::class, 'show'])->name('theme');

Route::middleware(['auth'])->group(function () {
    Route::post('/set_message', [MessageController::class, 'store']);
});
