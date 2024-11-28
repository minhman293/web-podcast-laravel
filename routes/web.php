<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Podcast\PodcastController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


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

    Route::get('/crud/add',[PodcastController::class, 'loadAddPage'])->name('podcast.loadAddPage');
    Route::post('/crud/add',[PodcastController::class, 'addPodcast'])->name('podcast.addPodcast');

    Route::delete('/crud/delete/{id}', [PodcastController::class, 'deletePodcast'])->name('podcast.deletePodcast');
    Route::post('/crud/restore/{id}', [PodcastController::class, 'restore'])->name('podcast.restore');
    
    Route::get('/crud/update/{id}', [PodcastController::class, 'loadUpdatePage'])->name('podcast.loadUpdatePage');
    Route::put('/crud/update/{id}', [PodcastController::class, 'updatePodcast'])->name('podcast.updatePodcast');

    Route::get('/crud', [PodcastController::class, 'index']) -> name('podcast.crud');
    Route::get('/podcast/{id}', [PodcastController::class, 'show']);

    Route::get('/podcast/{id}', function () {
        return view('podcast.single-podcast');
    });
});




