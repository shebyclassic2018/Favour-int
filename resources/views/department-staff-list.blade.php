@extends('layouts.frontend')

@section('title', 'Jobs')

@push('css_before')
    
@endpush

@section('content')
    <div class="container flow-y-auto">
        <h4 class="py-3 border-bottom"><span class="fa fa-tasks"></span> DEPARTMENT NAME</h4>
        <table class="table table-striped shadow">
            <thead>
                <tr class="fs-xs">
                    <th style="width: 15px">S/N</th>
                    <th>Staff name</th>
                    <th>email</th>
                    <th>phone</th>
                    <th>designation</th>
                </tr>
            </thead>
            <tbody>
                <tr class="fs-xs">
                    <td>1</td>
                    <td>SHABANI H. RAJABU</td>
                    <td>Sheby@gmail.com</td>
                    <td>0745681617</td>
                    <td>Head of Department</td>
                </tr>
            </tbody>
        </table>
    </div>
@stop
