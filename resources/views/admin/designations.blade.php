@extends('admin.dashboard')
@section('right-content')
    <div class="des-list pt-3">
        <h3>Designations</h3>
        @if (!is_null(\Session::get('alert-success')))
            <div class="alert alert-success">{{ Session::get('alert-success') }}</div>
        @elseif (!is_null(\Session::get('alert-danger')))
            <div class="alert alert-danger">{{ Session::get('alert-success') }}</div>
        @endif
        <form class="row pb-3" method="POST" action="{{ route('admin.adddesignation') }}">
            @csrf
            <div class="col-md-4"><input type="text" name="name" class="form-control fs-xs" placeholder="Designation name"
                    required></div>
            <div class="col-md-3"><input type="text" name="abbr" class="form-control fs-xs"
                    placeholder="Designation abbreviation" required></div>
            <div class="col-md-2"><button class="btn btn-primary fs-xs">Add new designation</button></div>
        </form>
        <table border="1" class="table table-striped">
            <thead class="bg-warning text-white">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">abbreviation</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (designations() as $des)
                    <tr class="fs-xs">
                        <th scope="row">{{ $sn++ }}</th>
                        <td>{{ $des->name }}</td>
                        <td>{{ $des->abbr }}</td>
                        <td align="center"><a href="{{route('admin.deletedesignation', [$des->name, $des->id])}}" class="fs-xs btn btn-danger"><span class="fa fa-trash"></span>
                                Delete</a></td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@stop
