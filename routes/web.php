<?php

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

Route::get('/', function () {
    return view('user_profile');
});
// Route::get('/', function () {
//     return view('index');
// });

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

Route::get('/podcast/{id}', function () {
    return view('podcast.single-podcast');
});