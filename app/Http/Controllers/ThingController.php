<?php

namespace App\Http\Controllers;

use App\Models\Thing;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ThingRequest;
use GuzzleHttp\Psr7\Request;

class ThingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Thing $thing)
    {
        $things = $thing->indexThing();
        return view('index', compact('things'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ThingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThingRequest $request)
    {
        $is_deleted = 0;

        $thing_flag = $this->setThingFlag($request);

        $thing = new Thing();
        $thing->fill($request->all());
        $thing->user_id = Auth::user()->id;
        $thing->registration_date = date('Y-m-d H:i');
        //値がnullの場合、空文字にする
        $thing->bad_thing_workaround = $thing->bad_thing_workaround == null ? '' : $thing->bad_thing_workaround;
        $thing->thing_flag = $thing_flag;
        $thing->is_deleted = $is_deleted;
        $thing->save();

        return redirect(route('thing.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thing  $thing
     * @return \Illuminate\Http\Response
     */
    public function show(Thing $thing)
    {
        $this->checkUserId($thing);
        return view('show', compact('thing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thing  $thing
     * @return \Illuminate\Http\Response
     */
    public function edit(Thing $thing)
    {
        $this->checkUserId($thing);
        // $this->checkOrdersNum($thing);
        return view('edit', compact('thing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ThingRequest  $request
     * @param  \App\Models\Thing  $thing
     * @return \Illuminate\Http\Response
     */
    public function update(ThingRequest $request, Thing $thing)
    {
        $this->checkUserId($thing);
        $thing_flag = $this->setThingFlag($request);

        $thing->fill($request->all());
        //値がnullの場合、空文字にする
        $thing->bad_thing_workaround = $thing->bad_thing_workaround == null ? '' : $thing->bad_thing_workaround;
        $thing->thing_flag = $thing_flag;
        $thing->save();
        return redirect(route('thing.show', $thing));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thing  $thing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thing $thing)
    {
        $this->checkUserId($thing);
        $thing->delete();
        return redirect(route('thing.index'))->with('message', '削除しました');
    }

    /**
     * ログインしているユーザのIDとデキゴトのuser_idを比較する
     * 不一致ならabort
     */
    public function checkUserId(Thing $thing, int $status = 404)
    {
        if (Auth::user()->id != $thing->user_id) {
            abort($status, '別ユーザのデキゴトは閲覧出来ません');
        }
    }

    //good_thing_orderとbad_thing_orderの値を比較してthing_flagに値を入れる処理
    public function setThingFlag(ThingRequest $request)
    {
        $thing_flag = '';

        if ($request->good_thing_order == 0) {
            if ($request->bad_thing_order == 0) {
                $thing_flag = 0;
            } else {
                $thing_flag = 2;
            }
        } else {
            if ($request->bad_thing_order == 0) {
                $thing_flag = 1;
            } else {
                $thing_flag = 3;
            }
        }

        return $thing_flag;
    }

    // public function checkOrdersNum(Thing $thing)
    // {
    //     $good_order_num = '';

    //     if ($thing->good_thing_order == 1) {
    //         $good_order_num = 'すごくイイ';
    //     } elseif ($thing->good_thing_order == 2) {
    //         $good_order_num = 'イイ';
    //     } elseif ($thing->good_thing_order == 3) {
    //         $good_order_num = 'ちょっとイイ';
    //     } else {
    //         $good_order_num = '';
    //     }

    //     $bad_order_num = '';

    //     if ($thing->bad_thing_order == 1) {
    //         $bad_order_num = 'すごくイヤ';
    //     } elseif ($thing->bad_thing_order == 2) {
    //         $bad_order_num = 'イヤ';
    //     } elseif ($thing->bad_thing_order == 3) {
    //         $bad_order_num = 'ちょっとイヤ';
    //     } else {
    //         $bad_order_num = '';
    //     }

    //     $orders_num = array(
    //         'good_order_num' => $good_order_num,
    //         'bad_order_num' => $bad_order_num,
    //     );

    //     return $orders_num;
    // }
}
