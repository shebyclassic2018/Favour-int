<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminPage extends Controller
{
    //

    function dashboard()
    {
        return view('admin.dashboard');
    }

    function staffs()
    {
        $data['staffs'] = staffs()->paginate(10);
        $data['sn'] = 1;
        return view('admin.staffs', $data);
    }

    function newstaffs()
    {
        return view('admin.new-staff');
    }
    function addnewstaffs(Request $req)
    {
        
        $create = User::updateOrCreate([
            'email' => $req->email,
            'phone' => $req->phone
        ],[
            'role_id' => $req->role,
            'department_id' => $req->department,
            'designation_id' => $req->designation,
            'name' => $req->fname . " " . $req->lname,
            'email' => $req->email,
            'phone' => $req->phone
        ]);

        if (isset($create->id)) {
            Session::flash('alert-success', 'Staff created successfull');
        } else {
            Session::flash('alert-danger', 'Staff failed to be created');
        }
        return redirect(route('admin.newstaffs'));
    }

    static function  designations()
    {
        $data['sn'] = 1;
        return view('admin.designations', $data);
    }

    static function  departments()
    {
        $data['sn'] = 1;
        return view('admin.departments', $data);
    }

    static function  events()
    {
        $data['sn'] = 1;
        return view('admin.events', $data);
    }

    static function  gallery()
    {
        $data['sn'] = 1;
        return view('admin.gallery', $data);
    }

    function adddesignation(Request $req)
    {
        $create = Designation::updateOrCreate([
            'name' => $req->name
        ],[
            'name' => $req->name,
            'abbr' => $req->abbr
        ]);
        if (isset($create->id)) {
            Session::flash('alert-success', 'Designation created successfull');
        } else {
            Session::flash('alert-danger', 'Designation failed to be created');
        }
        return redirect('admin/designations');
    }

    function adddepartment(Request $req)
    {
        $create = Department::updateOrCreate([
            'name' => $req->name
        ],[
            'name' => $req->name,
            'abbr' => $req->abbr
        ]);
        if (isset($create->id)) {
            Session::flash('alert-success', 'Department created successfull');
        } else {
            Session::flash('alert-danger', 'Department failed to be created');
        }
        return redirect('admin/departments');
    }

    function addevent(Request $req)
    {
        $create = Event::create([
            'descriptions' => $req->event,
            'event_date' => $req->date
        ]);
        if (isset($create->id)) {
            Session::flash('alert-success', 'Event created successfull');
        } else {
            Session::flash('alert-danger', 'Event failed to be created');
        }
        return redirect('admin/events');
    }

    function deletedesignation($name, $id)
    {
        $delete = Designation::where('id', $id)->delete();
        if ($delete) {
            Session::flash('alert-success', 'Designation - ' . $name . ' deleted successfull');
        } else {
            Session::flash('alert-danger', 'Designation - ' . $name . ' failed to be deleted');
        }
        return redirect('admin/designations');
    }

    function deletedepartment($name, $id)
    {
        $delete = Department::where('id', $id)->delete();
        if ($delete) {
            Session::flash('alert-success', 'Department - ' . $name . ' deleted successfull');
        } else {
            Session::flash('alert-danger', 'Department - ' . $name . ' failed to be deleted');
        }
        return redirect('admin/departments');
    }

    function deleteevent($id)
    {
        $delete = Event::where('id', $id)->delete();
        if ($delete) {
            Session::flash('alert-success', 'Event deleted successfull');
        } else {
            Session::flash('alert-danger', 'Event failed to be deleted');
        }
        return redirect('admin/events');
    }

    function imageuploader(Request $request)
    {
        $file = $request->file('image');


        //Display File Extension
        $ext = $file->getClientOriginalExtension();
        $filename = uniqid('IMG_') . "." . $ext;

        $create = Gallery::create([
            'path' => $filename,
            'caption' => $request->caption
        ]);

        if (isset($create->id)) {
            //Move Uploaded File
            $destinationPath = public_path('image/uploads');
            if ($file->move($destinationPath, $filename)) {
                return redirect('admin/gallery')->with('alert', 'Image uploaded successfully');
            } else {
                return redirect('admin/gallery')->with('alert-danger', 'Image failed to upload');
            }
        }
    }
}
