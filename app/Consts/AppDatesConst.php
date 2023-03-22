<?php

namespace App\Consts;

use Carbon\Carbon;

class AppDatesConst
{
    // 今の年月日を返すメソッド
    public static function today()
    {
        return Carbon::today()->format('Y-m-d');
    }
}
