<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GraphController;
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

Auth::routes();

Route::get('/', function () {
    return Auth::check() ? view('thing.index') : view('layouts.top');
});

// Route::get('/', function () {
//     if (Auth::check()) {
//         return redirect('/thing');
//     } else {
//         return redirect('/top');
//     }
// });

// Route::get('/top', function () {
//     return Auth::check() ? redirect('/thing') : view('auth.login');
// });

// トップページ
// Route::get('/top', function () {
//     if (Auth::check()) {
//         return redirect('/thing');
//     } else {
//         return view('layouts.top');
//     }
// });

// ユーザを削除してサンクスページを出す試み
// アクションを指定する時は[]で囲む必要があるっぽい 【例】[コントローラ名::class, アクション名]
Route::get('/thanks', function () {
    return view('thanks.thanks');
});

// phpinfo()を表示する
Route::get('/info', function () {
    return phpinfo();
});

// グラフ化する期間を送信するindexページと表示するshowページ
Route::get('/graph', [GraphController::class, 'index'])->name('graph.index');
Route::post('/graph/show', [GraphController::class, 'show'])->name('graph.show');

// middleware('auth')をかけるグループ
Route::middleware(['auth'])->group(function () {
    Route::resource('/user', UserController::class);
    Route::resource('/thing', ThingController::class);
});
