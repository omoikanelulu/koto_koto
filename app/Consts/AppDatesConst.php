<?php

namespace App\Consts;

use Carbon\Carbon;

class AppDatesConst
{
    public static function today()
    {
        return Carbon::today()->format('Y-m-d');
    }
}
