<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PodcastController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PodCommentsController;

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

Route::get('/', [PodcastController::class, 'index']);

Route::get('/about', [PodcastController::class, 'about']);

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/login-register', function () {
    return view('auth/login-register');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/register', [AuthController::class,'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::group(['prefix' => 'auth' ], function() {
//     Route::get('/login', function () {
//         return view('auth.login-register');
//     });
// });

Route::get('/{category}/podcast/{id}', [PodcastController::class, 'podcast_detail'])->name('podcast.podcast_detail');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/comments', [PodCommentsController::class, 'store'])->name('comments.store');
    Route::put('/comments/{id}', [PodCommentsController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{id}', [PodCommentsController::class, 'destroy'])->name('comments.destroy');
});

// Route::get('/podcast/{id}', function () {
//     return view('podcast.single-podcast');
// });