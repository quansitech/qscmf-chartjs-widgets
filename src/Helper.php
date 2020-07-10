<?php
namespace ChartJs;

use Carbon\Carbon;

class Helper{

    public static function genLastDayLabels($day, $format = 'm/d'){
        $carbon = Carbon::now()->addDay(-$day);
        $res = [];
        while($carbon->lessThanOrEqualTo(Carbon::now())){
            $res[] = $carbon->format($format);
            $carbon = $carbon->addDay(1);
        }
        return $res;
    }

    public static function genLastMonthLabelsPerDay($month = 1, $format = 'm/d'){
        $carbon = Carbon::now()->addMonth(-$month);
        $res = [];
        while($carbon->lessThanOrEqualTo(Carbon::now())){
            $res[] = $carbon->format($format);
            $carbon = $carbon->addDay(1);
        }
        return $res;
    }
}