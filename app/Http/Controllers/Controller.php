<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Models\Roots\City;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Properties\Unit;
use Nexmo\Laravel\Facade\Nexmo;
use App\Models\Peoples\HouseOwnership;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}





// select c.name as cname, d.name as dname, w.name as wname, units.id as unit_id,no_of_rooms as total_rooms, path, descriptions, unit_type, rent_per_month as price from units inner join house_ownerships as o on (o.id = units.house_ownership_id) inner join houses as h on (h.id = o.house_id) inner join unit_images as ui on (units.id = ui.unit_id) inner join wards as w on (w.id = h.ward_id) inner join districts as d on (d.id = w.district_id) inner join cities as c on (c.id = d.city_id) where w.id = 5 group by unit_id;
