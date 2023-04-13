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

// トップページ
Route::get('/', function () {
    // ログイン状態であるかチェックしtrueかfalseで処理を分岐させる
    return Auth::check() ? redirect('/thing') : view('top.top');
})->name('top');

// ログインしている時だけアクセスできるルートをグループ化
Route::middleware(['auth'])->group(function () {
    // サンクスページを出表示する
    Route::get('/thanks', function () {
        return view('thanks.thanks');
    });

    // グラフ化する期間を送信するindexページと表示するshowページ
    Route::get('/graph', [GraphController::class, 'index'])->name('graph.index_chart');
    Route::post('/graph/show_chart', [GraphController::class, 'show'])->name('graph.show_chart');

    Route::resource('/user', UserController::class);
    Route::resource('/thing', ThingController::class);
});
