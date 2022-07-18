@extends('admin.dashboard')
@section('right-content') 
    <div class="staff-list pt-3">
        <h3><span class="fa fa-users"></span> Staffs</h3>
        <table border="1" class="table table-striped" >
            <thead class="bg-warning text-white">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Department</th>
                <th scope="col">Designation</th>
                <th scope="col">Role</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($staffs as $staff)
              <tr class="fs-xs">
                <th scope="row">{{$sn++}}</th>
                <td>{{$staff->name}}</td>
                    <td>{{$staff->email}}</td>
                    <td>{{$staff->phone}}</td>
                    <td>{{$staff->department->name}}</td>
                    <td>{{$staff->designation->name}}</td>
                    <td>{{$staff->role->name}}</td>
                </tr>
                @endforeach
                <tr class="fs-xs">
                    <td align="right" colspan="6"></td>
                    <td class="text-right" colspan="1">{{$staffs->links()}}</td>
                </tr>
            </tbody>
              
          </table>
    </div>
@stop