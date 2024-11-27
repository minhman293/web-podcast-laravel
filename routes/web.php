<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Podcast\PodcastController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\PodcasterFollower\PodcasterFollowerController;
use App\Http\Controllers\Podcaster\PodcasterController;

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
    // Route::get('/', function () {
    //     return view('index');
    // })->name('index');
    Route::get('/', [PodcastController::class, 'index']);

    Route::get('/about', function () {
        return view('about');
    })->name('about')->middleware('verified');

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');

    Auth::routes(['verify' => true]);
    
    Route::get('/login', [AuthController::class, 'getLogin'])->name('get_login');
    Route::get('/register', [AuthController::class, 'getRegister'])->name('get_register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify')->middleware(['signed']);
    Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

    // Route::get('/podcast/{id}', function () {
    //     return view('podcast.single-podcast');
    // });
    Route::get('/{category}/podcast/{id}', [PodcastController::class, 'podcast_detail'])->name('podcast.podcast_detail');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
        Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
        Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    });

    Route::post('/follow', [PodcasterFollowerController::class, 'follow'])->name('follow');
    Route::post('/unfollow', [PodcasterFollowerController::class, 'unfollow'])->name('unfollow');

    Route::group(['prefix' => 'podcasters', 'as' => 'podcasters.' ], function() {
        Route::get('/edit/{podcaster}', [PodcasterController::class, 'edit'])->name('edit');
        Route::put('/update/{podcaster}', [PodCasterController::class, 'update'])->name('update');
        Route::get('/{podcaster}', [PodCasterController::class, 'index'])->name('index');
    });

    Route::post('/podcasters/{podcaster}/subscribe', [PodCasterFollowerController::class, 'subscribe'])->name('podcasters.subscribe');
    Route::post('/podcasters/{podcaster}/unsubscribe', [PodCasterFollowerController::class, 'unsubscribe'])->name('podcasters.unsubscribe');
});
