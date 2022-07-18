<?php

use App\Models\User;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Event;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Support\Carbon as SupportCarbon;

if (!function_exists('staffs')) {
    function staffs() {
        return User::with(['designation', 'role', 'department']);
    }
}

if (!function_exists('departments')) {
    function departments() {
        return Department::orderBy('id', 'DESC')->get();
    }
}

if (!function_exists('designations')) {
    function designations() {
        return Designation::orderBy('id', 'DESC')->get();
    }
}

if (!function_exists('roles')) {
    function roles() {
        return Role::orderBy('id', 'DESC')->get();
    }
}

if (!function_exists('events')) {
    function events() {
        return Event::orderBy('event_date', 'DESC')->get();
    }
}

if (!function_exists('WholeToday')) {
    function WholeToday() {
        return Carbon::today()->addHours(23)->addMinutes(59)->addSeconds(59);
    }
}

if (!function_exists('IsActiveEvent')) {
    function IsActiveEvent($event_date) {
        return (strtotime($event_date) >= strtotime(WholeToday())) ? true : false;
    }
}
