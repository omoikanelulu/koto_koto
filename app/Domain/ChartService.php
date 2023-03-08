<?php

namespace App\domain;

use App\Models\User;
use App\Models\Thing;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ChartService
{
    /**
     * @return $good_ratings array 日付ごとに合算したgood_thing_orderの値
     * @return $bad_ratings array 日付ごとに合算したbad_thing_orderの値
     * チャートに必要なデータを取得する
     */
    // public function getRatings()
    // {
    //     // 合算した$good_thing_orderを取得
    //     $sum_good_ratings = DB::table('things')
    //         ->select('registration_date', DB::raw('date, sum(good_thing_order) as total_rating'))
    //         ->groupBy('registration_date')
    //         ->get();
    //     return $sum_good_ratings;
    // }

    // public function getRatings()
    // {
    //     // ユーザIDの取得
    //     $user_id = Auth::id();
    //     // 合算した$good_thing_orderを取得
    //     $sum_good_ratings = DB::table('things')
    //         ->select('registration_date', DB::raw('sum(good_thing_order) as total_good_rating'))
    //         ->where('user_id', $user_id)
    //         ->groupBy('registration_date')
    //         ->get();
    //     return $sum_good_ratings;
    // }

    public function getRatings()
    {
        // ユーザIDの取得
        $user_id = Auth::id();
        // 合算した$good_thing_orderを取得
        $sum_good_ratings = DB::table('things')
            ->select(DB::raw('date(registration_date) as date')
            , DB::raw('sum(good_thing_order) as total_good_rating'))
            ->where('user_id', $user_id)
            ->groupBy(DB::raw('date(registration_date)'))
            ->get();

        return $sum_good_ratings;
    }
}

// データの取得
// $good_ratings = DB::table('things')->where('good_thing_order')->pluck('rating_value', 'registration_date');
// $bad_ratings = DB::table('things')->where('bad_thing_order')->pluck('rating_value', 'registration_date');















// // チャートの設定
// $chart = new LaravelChart('horizontal-bar');
// $chart->labels(array_keys($good_ratings));
// $chart->dataset('Good Ratings', 'horizontalBar', array_values($good_ratings))->color('green');
// $chart->dataset('Bad Ratings', 'horizontalBar', array_values($bad_ratings))->color('red');

// // チャートのカスタマイズ
// $chart->title('Daily Ratings');
// $chart->xAxisTitle('Date');
// $chart->yAxisTitle('Rating');
// $chart->options([
//     'scales' => [
//         'xAxes' => [
//             [
//                 'stacked' => true,
//                 'scaleLabel' => [
//                     'display' => true,
//                     'labelString' => 'Date'
//                 ]
//             ]
//         ],
//         'yAxes' => [
//             [
//                 'stacked' => true,
//                 'scaleLabel' => [
//                     'display' => true,
//                     'labelString' => 'Rating'
//                 ],
//                 'ticks' => [
//                     'beginAtZero' => true
//                 ]
//             ]
//         ]
//     ]
// ]);

// // ビューの表示
// return view('ratings', ['chart' => $chart]);
