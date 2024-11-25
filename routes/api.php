<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PodCommentsController;
use App\Http\Controllers\API\PodcastController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post("register", [AuthController::class, "register"]);
Route::post("login", [AuthController::class, "login"]);
Route::get("checkSession", [AuthController::class, "checkSession"]);

Route::get("podcast_list", [PodcastController::class, "podcast_list"]);
Route::get("podcast_detail/{id}", [PodcastController::class, "podcast_detail"]);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource("podcast_comments", PodCommentsController::class);
});