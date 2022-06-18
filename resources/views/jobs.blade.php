@extends('layouts.frontend')

@section('title', 'Jobs')

@push('css_before')
    
@endpush

@section('content')
    <div class="container flow-y-auto">
        <h4 class="py-3 border-bottom"><span class="fa fa-tasks"></span> JOBS</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="block">
                    <div class="block-content fs-xs text-justify" style="line-height: 23px">
                        EMPLOYMENT OPPORTUNITIES <br>
                        FAVOUR INTERNATIONAL PRE&PRIMARY SCHOOL Invites Qualified Tanzanians to apply for Teaching posts.
                    </div><br>
                </div>
            </div>
            <div class="col-md-6">
                <div class="block"><br><div class="col-12 fs-xs">Read the application form</div>
                    <ul>
                        <li class="fs-xs pt-2"><a href="{{asset('pdf/FAVOUR-INTERNATIONAL-ADVERT.pdf')}}" target="appform">FAVOUR-INTERNATIONAL-ADVERT</a><br><a href="#" class="rounded-pill mt-2 bg-warning px-3 py-1 text-white"><span class="fa fa-download"></span> Download</a></li>
                    </ul><br>
                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col-12">
                <iframe src="{{asset('pdf/FAVOUR-INTERNATIONAL-ADVERT.pdf')}}" frameborder="0" class="form-control" name="appform" style="height: 600px"></iframe>
            </div>
        </div>
    </div>
@stop
