<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThingController;
use App\Http\Controllers\UserController;

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

// Route::get('/', [ThingController::class, 'index'])->name('/');
Route::get('/', function () {
    return redirect('/thing');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', function () {
    return redirect('/thing');
});

Route::get('/info', function () {
    return phpinfo();
})->middleware('auth');

// Route::resource('thing', App\Http\Controllers\ThingController::class);
Route::resource('/thing', ThingController::class); //この書き方でも行けそう

Route::resource('/user', UserController::class)->middleware('auth');
// Route::resource('/user', UserController::class, ['except' => ['index']])->middleware('auth'); // これで除外できるらしいが、上手くいってる気がしない





Auth::routes();
