<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Auth\Middleware\Authorize;
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
    public function index(Inquiry $inquiry)
    {
        // Inquiryモデルに対してviewAnyポリシーを適用、結果がfalseの場合、403 Forbiddenとなる
        $this->authorize('viewAny', Inquiry::class);
        $inquiries = Inquiry::all();

        return view('inquiry.index', compact('inquiries'));
    }

    /**
     * お問い合わせの登録処理
     *
     * @return redirectResponse
     */
    public function store(Request $request)
    {
        $inquiry = new Inquiry();
        $inquiry->fill($request->all());
        $inquiry->save();

        // セッションにフラッシュデータとしてリクエストのデータを保存
        session()->flash('inquiry', $inquiry);

        return redirect(route('inquiry.complete'))->with('message', 'お問い合わせを送信しました');
    }

    /**
     * お問い合わせ完了画面
     *
     * @return view
     */
    public function complete(Request $request)
    {
        $inquiry = session('inquiry');

        return view('inquiry.complete', compact('inquiry'));
    }

    /**
     * 削除処理
     *
     * @return redirectResponse
     */
    public function destroy($id)
    {
        // Inquiryモデルに対してviewAnyポリシーを適用、結果がfalseの場合、403 Forbiddenとなる
        $this->authorize('viewAny', Inquiry::class);

        $inquiry = Inquiry::find($id);
        $inquiry->delete();

        return redirect(route('inquiry.index'));
    }
}
