<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
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
    return view('welcome');
});

Route::get('/login/google', [AuthController::class, 'redirectToGoogleProvider']);
Route::get('/login/google/callback', [AuthController::class, 'handleProviderGoogleCallback']);
Route::get('/post/blog', [GoogleController::class, 'handlePost']);
Route::get('/home', [AuthController::class, 'index'])->name('home');
