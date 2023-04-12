<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Consts\AppDatesConst;
use App\Consts\AppMessagesConst;
use App\Models\Thing;
use Carbon\Carbon;

class GraphController extends Controller
{
    /**
     * ユーザのグラフを表示する期間を設定する画面を表示する
     */
    public function index()
    {
        // 当日の日付を格納
        $today = AppDatesConst::today();
        // ユーザ情報を渡さないとログアウト以外のメニューが出ない
        $user = Auth::user();
        // 定数を格納
        $const = AppMessagesConst::INDEX_CHART;
        return view('graph.index_chart', compact('today', 'user', 'const'));
    }

    /**
     * ユーザが指定した期間内のグラフを表示する
     */
    public function show(Request $request)
    {
        $const = AppMessagesConst::SHOW_CHART;

        // ユーザ情報をもっていかないとログアウト以外のメニューが出ない
        $user = Auth::user();
        $userId = auth()->id();
        $startDate = Carbon::parse($request->start_date);
        // ->addDay()で1日分増やす事で選択された$endDateまで結果に含まれるようにしている
        $endDate = Carbon::parse($request->end_date)->addDay();
        // ログインユーザのthingを指定された期間分取得する
        $things = Thing::where('user_id', $userId)
            ->whereBetween('registration_date', [$startDate, $endDate])
            ->get();

        // グラフデータを作成する
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

        return view('graph.show_chart', compact('user', 'graphData', 'const'));
    }
}
