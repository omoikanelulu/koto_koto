<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThanksController extends Controller
{
    public function __invoke()
    {
        // セッションにshow_thanksがない場合はトップページへリダイレクト
        if (!session('show_thanks')) {
            return redirect('/');
        }
        // フラグを削除してサンクスページを表示
        session()->forget('show_thanks');
        return view('thanks.thanks');
    }
}
