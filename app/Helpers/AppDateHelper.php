<?php

namespace App\Helpers;

use Carbon\Carbon;

class AppDateHelper
{
    /**
     * 現在の年月日を取得する
     *
     * @return string 現在の年月日（YYYY-MM-DD形式）
     */
    public static function getToday()
    {
        return Carbon::today()->format('Y-m-d');
    }

    /**
     * 現在の年の最初の日（1月1日）を取得する。
     *
     * @return string 現在の年の最初の日（YYYY-MM-DD形式）
     */
    public static function getThisYear()
    {
        // 現在の日時を取り出す（'Y-m-d 00:00:00'）
        $now = Carbon::today();
        // $nowのデータを年の最初の月日にする
        $first_day_of_year = $now->startOfYear();
        // format()で時間部分は除外する
        return $first_day_of_year->format('Y-m-d');
    }
}
