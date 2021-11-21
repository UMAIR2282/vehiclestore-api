<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DateTimeExtended
{
    public static function toString($datetime, $user_timezone = true, $current_timezone = "UTC", $format = "Y-m-d H:i:s")
    {
        $timezone = "UTC";
        if($user_timezone)
        {
            $user = Auth::user();
            $timezone = isset($user->timezone) && !DataHelper::IsNullOrWhitespace($user->timezone) ? $user->timezone : config("app.timezone");
        }
        if($current_timezone != $timezone)
        {
            return Carbon::parse($datetime, $current_timezone)->setTimezone($timezone)->format($format);
        }
        return Carbon::parse($datetime, $current_timezone)->format($format);
    }
}