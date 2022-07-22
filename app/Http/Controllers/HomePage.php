<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Staff;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Services\VisitService;
use App\Http\Controllers\Controller;
use App\Models\Gallery;

class HomePage extends Controller
{
    //
    function index() {
        $data['events'] = Event::orderBy('event_date', 'DESC')->paginate(5);
        $visits = new VisitService();
        $visits->visitsCounter()->increment();
        $data['visits'] = $visits;
        $data['images'] = Gallery::orderBy('id', 'DESC')->paginate(5);
        return view('landing', $data);
    }

    function aboutus() {
        $data['staffs'] = staffs()->paginate();
        return view('aboutus', $data);
    }

    function admin() {
        return view('admin.index');
    }
}
