<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Thing;
use App\Models\User;
use Carbon\Carbon;

class GraphController extends Controller
{
    public function index(User $user)
    {
        // // ユーザ情報をもっていかないとログアウト以外のメニューが出ない
        // $user = User::user();
        // return view('graph.index', compact('user'));
        return view('graph.index');
    }

    public function show(Request $request)
    {
        $userId = auth()->id();
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $things = Thing::where('user_id', $userId)
            ->whereBetween('registration_date', [$startDate, $endDate])
            ->get();

        // グラフデータを取得する
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

        return view('graph.show', compact('graphData'));
    }
}
