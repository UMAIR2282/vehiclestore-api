<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class StrExtended
{
    public static function isEmpty($str)
    {
        return Str::of($str)->trim()->isEmpty();
    }
}