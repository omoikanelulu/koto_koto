<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * お問い合わせフォーム
     *
     * @return view
     */
    public function form()
    {
        return view('inquiry.form');
    }

    /**
     * お問い合わせ一覧画面
     *
     * @return view
     */
    public function index()
    {
        return view('inquiry.index');
    }

    /**
     * お問い合わせの登録処理
     *
     * @return void
     */
    public function store(Request $request)
    {
        $inquiry = new Inquiry();
        $inquiry->fill($request->all());
        $inquiry->save();

        return redirect(route('inquiry.form'));
    }

    public function destroy($id)
    {
        $inquiry = Inquiry::find($id);
        $inquiry->delete();

        return redirect(route('inquiry.index'));
    }
}
