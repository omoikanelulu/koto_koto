<?php

namespace App\Http\Controllers;

use App\Models\Thing;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreThingRequest;
use App\Http\Requests\UpdateThingRequest;

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
     * @param  \App\Http\Requests\StoreThingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreThingRequest $request)
    {
        $is_deleted = 0;

        //good_thing_orderとbad_thing_orderの値を比較してthing_flagに値を入れる処理
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

        $thing = new Thing();
        $thing->fill($request->all());
        $thing->user_id = Auth::user()->id;
        $thing->registration_date = date('Y-m-d H:i');
        $thing->thing_flag = $thing_flag;
        $thing->is_deleted = $is_deleted;
        $thing->save();

        return redirect(route('/'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thing  $thing
     * @return \Illuminate\Http\Response
     */
    public function show(Thing $thing)
    {
        return view('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thing  $thing
     * @return \Illuminate\Http\Response
     */
    public function edit(Thing $thing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateThingRequest  $request
     * @param  \App\Models\Thing  $thing
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateThingRequest $request, Thing $thing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thing  $thing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thing $thing)
    {
        //
    }

    /**
     * ログインしているユーザのIDとデキゴトのuser_idを比較する
     * 不一致ならabort
     */
    public function checkUserId(Thing $thing, int $status = 404)
    {
        if (Auth::user()->id != $thing->user_id) {
            abort($status);
        }
    }
}
