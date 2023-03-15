<?php

namespace App\Http\Controllers;

use App\Domain\ChartService;
use App\Models\User;
use App\Models\Thing;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(route('thing.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect(route('thing.index'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        return redirect(route('thing.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->checkId($user);

        // 必要なくなったかもしれない
        $chart_service = new ChartService();
        $sum_good_ratings = $chart_service->getRatings();
        /////
        return view('user.show', compact('user', 'sum_good_ratings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Request $request)
    {
        $this->checkId($user);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $this->checkId($user);

        $user->fill($request->all());
        $user->save();
        return redirect('thing');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->checkId($user);
        // ユーザの削除
        $user->delete();
        // ユーザのthingも合わせて削除、withTrashed()で削除済みのthingも含めている
        $user->things()->withTrashed()->delete();

        // $userが削除され、存在しなければリダイレクトさせる
        if ($user->exists()) {
            return redirect('/thanks');
        } else {
            abort('', '処理に失敗しました');
        }
    }

    public function checkId(User $user, int $status = 403)
    {
        if (Auth::user()->id != $user->id) {
            abort($status, 'IDが一致しません');
        }
    }
}
