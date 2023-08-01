<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        return view('inquiry.inquiryForm');
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

        return redirect(route('inquiry'));
    }

    public function destroy($id)
    {
        $inquiry = Inquiry::find($id);
        $inquiry->delete();

        return redirect(route('inquiry'));
    }
}
