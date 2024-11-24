<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PodcastController;
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
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::group(['prefix' => 'auth' ], function() {
    Route::get('/login', function () {
        return view('auth.login-register');
    });
});

Route::get('/crud/add',[PodcastController::class, 'loadAddPage'])->name('podcast.loadAddPage');
Route::post('/crud/add',[PodcastController::class, 'addPodcast'])->name('podcast.addPodcast');

Route::delete('/crud/delete/{id}', [PodcastController::class, 'deletePodcast'])->name('podcast.deletePodcast');

Route::get('/crud/update/{id}', [PodcastController::class, 'loadUpdatePage'])->name('podcast.loadUpdatePage');
Route::put('/crud/update/{id}', [PodcastController::class, 'updatePodcast'])->name('podcast.updatePodcast');

Route::get('/crud', [PodcastController::class, 'index']) -> name('podcast.crud');
Route::get('/podcast/{id}', [PodcastController::class, 'show']);