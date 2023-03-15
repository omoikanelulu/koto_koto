<?php

namespace App\Http\Controllers;

use App\Models\Thing;
// use App\Models\User; // こうすると他のモデルも参照出来る
use App\Http\Requests\ThingRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ThingController extends Controller
{
    public function __construct()
    {
        // トップページもログインしていないと表示されなくなってしまう…認証の必要が無いところに置かないとダメか？
        // $this->middleware('auth');
    }
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
        return view('thing.create', compact('user'));
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
        $thing->registration_date = date('Y-m-d H:i:s');
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
        $this->checkUserId($thing);
        $user = Auth::user();
        return view('thing.edit', compact('thing', 'user'));
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
        // $thing->delete(); //ソフトデリート
        $thing->forceDelete(); //ハードデリート
        return redirect(route('thing.index'))->with('message', '削除しました');
    }

    /**
     * ログインしているユーザのIDとデキゴトのuser_idを比較する
     * 不一致ならabort
     */
    public function checkUserId(Thing $thing, int $status = 403)
    {
        if (Auth::user()->id != $thing->user_id) {
            abort($status, '別ユーザのデキゴトは閲覧出来ません');
        }
    }

    /**
     * good_thing_orderとbad_thing_orderで評価したかどうか組み合わせによって0から3の値を持つ
     * good_thing_order評価無し、bad_thing_order評価無し、値は0
     * good_thing_order評価あり、bad_thing_order評価無し、値は1
     * good_thing_order評価あり、bad_thing_order評価無し、値は2
     * good_thing_order評価あり、bad_thing_order評価あり、値は3
     */
    public function setThingFlag(ThingRequest $request)
    {
        $thing_flag = '';

        // $good_thing_orderで評価していない場合
        if ($request->good_thing_order == 0) {
            // $bad_thing_orderで評価していない場合
            if ($request->bad_thing_order == 0) {
                $thing_flag = 0;
            } else {
                $thing_flag = 2;
            }
        } else {
            // $bad_thing_orderで評価していない場合
            if ($request->bad_thing_order == 0) {
                $thing_flag = 1;
            } else {
                $thing_flag = 3;
            }
        }

        return $thing_flag;
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
