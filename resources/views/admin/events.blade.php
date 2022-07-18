@extends('admin.dashboard')
@section('right-content')
    <div class="des-list pt-3">
        <h3>Events</h3>
        @if (!is_null(\Session::get('alert-success')))
            <div class="alert alert-success">{{ Session::get('alert-success') }}</div>
        @elseif (!is_null(\Session::get('alert-danger')))
            <div class="alert alert-danger">{{ Session::get('alert-success') }}</div>
        @endif
        <form class="row pb-3" method="POST" action="{{ route('admin.addevent') }}">
            @csrf
            <div class="col-md-4"><textarea rows="3"  name="event" class="form-control fs-xs" placeholder="Event descriptions"
                    required></textarea></div>
            <div class="col-md-3">
                <label for="" class="fs-xs">Event date</label>
                <input type="date" name="date" class="form-control fs-xs"
                    placeholder="Date" required></div>
            <div class="col-md-2"><label for="">.</label><br><button class="btn btn-primary fs-xs">Add new event</button></div>
        </form>
        <table border="1" class="table table-striped">
            <thead class="bg-warning text-white">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Event Descriptions</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach (events() as $des)
                    <tr class="fs-xs">
                        <th scope="row">{{ $sn++ }}</th>
                        <td>{{ $des->descriptions }}</td>
                        <td>{{ date('dS M Y', strtotime($des->event_date)) }}</td>
                        <td align="center"><a href="{{route('admin.deleteevent', [$des->id])}}" class="fs-xs btn btn-danger"><span class="fa fa-trash"></span>
                                Delete</a></td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@stop
