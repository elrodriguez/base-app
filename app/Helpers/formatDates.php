<?php

use Carbon\Carbon;

if (!function_exists('date_time_format')) {
    function date_time_format($date = null)
    {
        if ($date == null) {
            return Carbon::now()->format('d/m/Y \a \l\a\s H:i \h\o\r\a\s');
        } else {
            return Carbon::parse($date)->format('d/m/Y \a \l\a\s H:i \h\o\r\a\s');
        }
    }
}
