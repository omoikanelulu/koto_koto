<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThingController;

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

Route::get('/', [ThingController::class, 'index'])->name('/');
Route::get('/show', [ThingController::class, 'show'])->name('show');
Route::get('/create', [ThingController::class, 'create'])->name('create');
Route::post('/store', [ThingController::class, 'store'])->name('store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
