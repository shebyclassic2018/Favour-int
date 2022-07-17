@extends('layouts.frontend')

@section('title', 'About Us')

@push('css_before')
@endpush

@section('content')
    <div class="container flow-y-auto">
        <h4 class="py-3 border-bottom"><span class="fa fa-list"></span> ABOUT US</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="block">
                    <div class="block-header block-header-default">
                        <div class="block-title">MISSION</div>
                    </div>
                    <div class="block-content fs-xs text-justify" style="line-height: 23px">
                        <span class="first-letter">T</span>o serve as an excellent world class Pre&Primary school by
                        making the children enjoy learning from the base with the wider aim of nurturing a positive spirit
                        toward education.
                    </div><br>
                </div>
                <div class="block">
                    <div class="block-header block-header-default">
                        <div class="block-title">VISION</div>
                    </div>
                    <div class="block-content fs-xs text-justify" style="line-height: 23px">
                        <span class="first-letter">T</span>o be the leading Pre&Primary school in provision of high
                        quality pre-primary
                        education which is expected to improve the performance of primary school leavers and national
                        education grades and standard at large.
                    </div><br>
                </div>
                <div class="block">
                    <div class="block-header block-header-default">
                        <div class="block-title">OBJECTIVES</div>
                    </div>
                    <div class="block-content fs-xs text-justify" style="line-height: 23px">
                        <div>- To offer good quality pre – primary education from class I to III; (baby class, middle class
                            and pre unit class,
                            respectively) to children of Msimamo street and other neighboring streets.</div><br>
                        <div>- To provide a motivating curriculum and exciting academic programs that will develop the
                            pupil’s natural curiosity and encourage them to learn and
                            achieve rapid progress in their curriculum activities in align with the Tanzania Education
                            policy.</div><br>
                        <div>- To facilitate learning process by incorporating variety of teaching aids and methods
                            favorable to the children like visual diagrams, charts and images.</div>
                    </div><br>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="block">
                            <div class="block-content">
                                <div>
                                    <img src="{{ asset('image/img1.jpg') }}" class="img-fluid"
                                        style="height:  250px; width: 100%" alt="">
                                </div>
                                <div class="fs-xs">Education for Brighter Future</div>
                            </div><br>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="block">
                            <div class="block-content">
                                <div>
                                    <img src="{{ asset('image/img3.jpeg') }}" class="img-fluid"
                                        style="height:  250px; width: 100%" alt="">
                                </div>
                                <div class="fs-xs">Education for Brighter Future</div>
                            </div><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h4 class="py-3 border-bottom"><span class="fa fa-users"></span> OUR STAFFS</h4>
        <table class="table table-striped shadow">
            <thead>
                <tr class="fs-xs">
                    <th style="width: 15px">S/N</th>
                    <th>Staff name</th>
                    <th>email</th>
                    <th>phone</th>
                    <th>Department</th>
                    <th>designation</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($staffs as $staff)
                <tr class="fs-xs">
                    <td>1</td>
                    <td>{{$staff->name}}</td>
                    <td>{{$staff->email}}</td>
                    <td>{{$staff->phone}}</td>
                    <td>{{$staff->department->name}}</td>
                    <td>{{$staff->designation->name}}</td>
                </tr>
                @endforeach
                <tr class="fs-xs">
                    <td align="right" colspan="5"></td>
                    <td class="text-right" colspan="1">{{$staffs->links()}}</td>
                </tr>
            </tbody>
        </table>
    </div>
@stop
