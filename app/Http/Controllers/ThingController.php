<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThingRequest;
use App\Models\Thing;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ThingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Thing $thing, Request $request)
    {
        $search_month = empty($request->input('search_month')) ? date('Y-m') : $request->input('search_month');
        $things = $thing->searchThing($search_month);
        $user = Auth::user();

        return view('thing.index', compact('search_month', 'things', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $method = 'create';
        return view('thing.createOrEdit', compact('user', 'method'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ThingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThingRequest $request)
    {
        $thing = new Thing();
        $thing->fill($request->all());
        $thing->user_id = Auth::user()->id;
        $thing->registration_date = date('Y-m-d H:i:s');
        //値がnullの場合、空文字にする
        $thing->bad_thing_workaround = $thing->bad_thing_workaround == null ? '' : $thing->bad_thing_workaround;
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
        // ポリシーでアクセスできるユーザであるかチェックする
        $this->authorize('confirmThingPermission', $thing);

        $user = Auth::user();
        $date = $thing->registration_date->format('Y-m-d');
        $graphData = [
            $date => [
                'good_thing_order' => $thing->good_thing_order,
                'bad_thing_order' => $thing->bad_thing_order
            ]
        ];

        return view('thing.show', compact('thing', 'user', 'graphData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thing  $thing
     * @return \Illuminate\Http\Response
     */
    public function edit(Thing $thing)
    {
        $this->authorize('confirmThingPermission', $thing);
        $user = Auth::user();
        $method = 'edit';
        return view('thing.createOrEdit', compact('thing', 'user', 'method'));
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
        // $this->checkUserId($thing);

        // ポリシーでアクセスできるユーザであるかチェックする
        $this->authorize('confirmThingPermission', $thing);


        $thing->fill($request->all());
        //値がnullの場合、空文字にする
        $thing->bad_thing_workaround = $thing->bad_thing_workaround == null ? '' : $thing->bad_thing_workaround;
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
        // $this->checkUserId($thing);

        // ポリシーでアクセスできるユーザであるかチェックする
        $this->authorize('confirmThingPermission', $thing);

        $thing->delete(); //ソフトデリート
        // $thing->forceDelete(); //ハードデリート

        return redirect(route('thing.index'))->with('message', '削除しました');
    }

    /**
     * 毎日のorderを集計し、月毎に表示する為のデータを作成する
     */
    public function monthlyLogs($userId, $year, $month)
    {
        $startOfMonth = Carbon::create($year, $month, 1);
        $endOfMonth = $startOfMonth->copy()->endOfMonth();

        $things = Thing::where('user_id', $userId)
            ->whereBetween('registration_date', [$startOfMonth, $endOfMonth])
            ->get();

        $graphData = [];

        foreach ($things as $thing) {
            $date = $thing->registration_date->format('Y-m-d');
            if (!isset($graphData[$date])) {
                $graphData[$date] = [
                    'good_thing_order' => 0,
                    'bad_thing_order' => 0
                ];
            }
            $graphData[$date]['good_thing_order'] += $thing->good_thing_order;
            $graphData[$date]['bad_thing_order'] += $thing->bad_thing_order;
        }
        return view('monthlyLogs.monthlyLogs_graph', compact('graphData'));
    }
}
