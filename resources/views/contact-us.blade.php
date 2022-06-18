@extends('layouts.frontend')

@section('title', 'Contact Us')

@push('css_after')
@endpush

@section('breadcrumbs-h1')
    <h1>Contact Us</h1>
@stop

@section('breadcrumbs-li')
    <li class="active">Contact Us</li>
@stop

@push('css_before')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/oneui.css') }}">
    <style>
        .ccfe00 {
            color: #ccfe00;
        }

    </style>
@endpush

@section('content')

    <!-- Sub-banner -->
    {{-- @include('guests.includes.hero') --}}

    <!-- Contact 1 start -->
    <div class="container my-3" style="background:#fff; width: calc(100% - 15px); margin: auto;">
        <div class="contact-1 content-area-7 ">
            <div class="container">
                <div class="main-title">
                    <h1 class="ccfe00" style="color: #cca415">{{__('contact.header')}}</h1>
                    <p class="text-black">{{__('contact.headersub')}}</p>
                </div>

                @if (Session::get('info') !== null)
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-info">{{ \Session::get('info') }}</div>
                        </div>
                    </div>
                @endif

                <div class="row">

                    <div class="offset-md-0 col-md-12">
                        <div class="row contact-info">
                            <h3 style="color: #cca415"><b>Contact Info</b><hr></h3>
                            <div class="col-12 col-md-4 media">
                                <i class="fa fa-map text-danger" style="border-color: #cca415"></i>
                                <div class="media-body">
                                    <h5 class="mt-0" style="color: #cca415"><b>{{__('contact.ofcaddr')}}</b></h5>
                                    <p style="color: #333">Favour International Pre-Primary School,  <br>
                                        Morogoro - Tanzania. <br class="mr-3">
                                        P.O.Box 989, Morogoro - Tanzania.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 media">
                                <i class="fa fa-phone-alt text-success" style="border-color: #cca415"></i>
                                <div class="media-body">
                                    <h5 class="mt-0" style="color: #cca415"><b>{{__('contact.phone')}}</b></h5>
                                    <p><a href="tel:+255 689 455 740" style="color: #333"> +255 689 455 740</a> </p>

                                    <p><a href="tel:+255 744 637 770" style="color: #333"> +255 744 637 770</a> </p>
                                    <p><a href="tel:+255 715 036 599" style="color: #333"> +255 715 036 599</a> </p>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 media mrg-btn-0">
                                <i class="fa fa-envelope text-info" style="border-color: #cca415"></i>
                                <div class="media-body">
                                    <h5 class="mt-0" style="color: #cca415"><b>{{__('contact.email')}}</b></h5>
                                    <p><a href="mailto: irenekasambala@yahoo.com" style="color: #333"> irenekasambala@yahoo.com</a></p>
                                    <p><a href="mailto: irenekasambala@favour-int.ac.tz" style="color: #333"> irenekasambala@favour-int.ac.tz</a></p>
                                    <p><a href="mailto: info@favour-int.ac.tz" style="color: #333"> info@favour-int.ac.tz</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <!-- Contact 1 end -->
@section('footer')
    {{-- @include('guests.includes.footer') --}}
@stop
@endsection




@push('js_after')
<script>
    jQuery(function() {
        One.helpers(['slick']);
    });
</script>

<script>

</script>
@endpush
