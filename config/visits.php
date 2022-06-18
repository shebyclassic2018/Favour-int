<?php

use App\Services\TimeZone;

function VisitorExpireTime() {
    $now = TimeZone::now();
    $future = TimeZone::now('Y-m-d');
    return TimeZone::date_difference($future, $now);
}





return [
    /*
    |--------------------------------------------------------------------------
    | Database Engine & Connection Name
    |--------------------------------------------------------------------------
    |
    | Supported Engines: "redis", "eloquent"
    | Connection Name: see config/database.php 
    |
    */
    'engine' => 'eloquent',
    'connection' => 'laravel-visits',


    /*
    |--------------------------------------------------------------------------
    | Counters periods
    |--------------------------------------------------------------------------
    |
    | Record visits (total) of each one of these periods in this set (can be empty)
    |
    */
    'periods' => [
        'day',
        'week',
        'month',
        'year',
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis prefix
    |--------------------------------------------------------------------------
    */
    'keys_prefix' =>  'visits',

    /*
    |--------------------------------------------------------------------------
    | Remember ip for x seconds of time
    |--------------------------------------------------------------------------
    |
    | Will count only one visit of an IP during this specified time.
    |
    */
    'remember_ip' => VisitorExpireTime(),

    /*
    |--------------------------------------------------------------------------
    | Always return uncached fresh top/low lists
    |--------------------------------------------------------------------------
    */
    'always_fresh' => false,


    /*
    |--------------------------------------------------------------------------
    | Ignore Crawlers
    |--------------------------------------------------------------------------
    |
    | Ignore counting crawlers visits or not
    |
    */
    'ignore_crawlers' => true,

    /*
    |--------------------------------------------------------------------------
    | Global Ignore Recording 
    |--------------------------------------------------------------------------
    |
    | stop recording specific items (can be any of these: 'country', 'refer', 'periods', 'operatingSystem', 'language')
    |
    */
    'global_ignore' => ['refer'],

];
