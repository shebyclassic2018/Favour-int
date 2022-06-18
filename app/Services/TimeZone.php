<?php

namespace App\Services;

use DateTime;
use DateTimeZone;

class TimeZone {
    public static function timezone()
    {
        // $timestamp ='1411205843';  //Timestamp which you need to convert 

        $destinationTimezone = new DateTimeZone('Africa/Nairobi');

        $dt = new DateTime(date('m/d/Y H:i:s'), $destinationTimezone);
        $dt->setTimeZone($destinationTimezone);

        return $dt;
    }

    public static function now($format = 'Y-m-d H:i:s')
    {
        return TimeZone::timezone()->format($format);
    }

    public static function date_difference($futureDate, $lastDate) {
        $future = strtotime($futureDate) + 86399;
        // return date('Y-m-d H:i:s', $future);
        $existed = strtotime($lastDate);
        return ($future - $existed) - 3600 + 86400;
    }
}