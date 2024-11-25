<?php

use App\Http\Controllers\Auth\AuthController;
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
Route::middleware(['web'])->group(function(){
    Route::get('/', function () {
        return view('index');
    })->name('index');

    Route::get('/about', function () {
        return view('about');
    })->name('about');

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');

    Route::group(['prefix' => 'auth'], function () {
        Route::get('/login', [AuthController::class, 'getLogin'])->name('get_login');
        Route::get('/register', [AuthController::class, 'getRegister'])->name('get_register');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::get('/podcast/{id}', function () {
        return view('podcast.single-podcast');
    });
});
