<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Api\V1\SearchController;

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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/theme/{theme}', [WelcomeController::class, 'show'])->name('theme');
//Route::post('get_theme', [SearchController::class, 'store']);


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
/* Route::get('/theme', function () {
    return redirect()->to(route('home'));
}); */
Route::get('/theme/{theme}', [ThemeController::class, 'show'])->name('theme');
Route::get('/quote/{masseg}', [MessageController::class, 'quote'])->name('quote');

Route::middleware(['auth'])->group(function () {
    Route::post('/set_message', [MessageController::class, 'store']);
    Route::get('/delete_messag/{masseg}', [MessageController::class, 'destroy']);
    Route::get('/delete_theme/{theme}', [ThemeController::class, 'destroy']);
    Route::post('/set_theme', [HomeController::class, 'store']);
});
