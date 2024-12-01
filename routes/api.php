<?php

use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\Podcast\PodcastController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Podcaster\PodCasterController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/notifications')->group(function () {
        Route::post('/', [NotificationController::class, 'store']);
        Route::get('/', [NotificationController::class, 'updateStatus']);
    });
    Route::prefix('/podcast')->group(function () {
        Route::get('/{podcasterId}/last', [PodcastController::class, 'getLastPodCastByPodcasterId']);
    });
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/podcasters/{podcaster}/subscribe', [PodCasterController::class, 'subscribe'])->name('api.podcasters.subscribe');

Route::post('/podcasters/{podcaster}/unsubscribe', [PodCasterController::class, 'unsubscribe'])->name('api.podcasters.unsubscribe');

// Notifications


