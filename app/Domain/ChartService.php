<?php

namespace App\domain;

use App\Models\User;
use App\Models\Thing;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * 必要なくなってしまったかもしれないService
 */
class ChartService
{
    /**
     * @return $good_ratings array 日付ごとに合算したgood_thing_orderの値
     * @return $bad_ratings array 日付ごとに合算したbad_thing_orderの値
     * チャートに必要なデータを取得する
     */

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