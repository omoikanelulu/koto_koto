<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GraphController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ThanksController;
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

// サンクスページ
Route::get('/thanks', ThanksController::class)->name('thanks');

Route::group(['prefix' => 'inquiry'], function () {
    // 問い合わせフォーム
    Route::get('/form', [InquiryController::class, 'form'])->name('inquiry.form');
    // お問い合わせ一覧表示
    Route::get('/index', [InquiryController::class, 'index'])->name('inquiry.index');
    // 登録処理
    Route::post('/store', [InquiryController::class, 'store'])->name('inquiry.store');
    // 削除処理
    Route::post('/destroy/{id}', [InquiryController::class, 'destroy'])->name('inquiry.destroy');
});

// ログインしている時だけアクセスできるルートをグループ化
Route::middleware(['auth'])->group(function () {

    // グラフ化する期間を送信するindexページと表示するshowページ
    Route::get('/graph', [GraphController::class, 'index'])->name('graph.index_chart');
    Route::post('/graph/show_chart', [GraphController::class, 'show'])->name('graph.show_chart');

    // exceptで不要なルーティングを除外する
    Route::resource('/user', UserController::class)->except([
        'index', 'store', 'create'
    ]);

    Route::resource('/thing', ThingController::class);
});
