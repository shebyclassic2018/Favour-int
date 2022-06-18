@extends('layouts.frontend')
@section('title', 'Galley')
@push('css_before')
<link rel="stylesheet" href="{{asset('js/plugins/magnific-popup/magnific-popup.css')}}">
@endpush
@section('content')
    <div class="container">
        <div class="content">
            <!-- Simple Gallery -->
            <h2 class="content-heading">Simple</h2>
            <div class="row items-push js-gallery img-fluid-100">
                @for($i = 0; $i < 10; $i++)
                <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">
                    <a class="img-link img-link-zoom-in img-thumb img-lightbox w-100" href="assets/media/photos/photo2@2x.jpg">
                        <img class="img-fluid" style="height: 100%; width: 100%" src="{{asset('image/img1.jpg')}}" alt="">
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">
                    <a class="img-link img-link-zoom-in img-thumb img-lightbox w-100" href="assets/media/photos/photo3@2x.jpg">
                        <img class="img-flui" style="height: 100%; width: 100%" src="{{asset('image/img2.jpeg')}}" alt="">
                    </a>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">
                    <a class="img-link img-link-zoom-in img-thumb img-lightbox w-100" href="{{asset('image/img3.jpeg')}}">
                        <img class="img-fluid" style="height: 100%; width: 100%" src="{{asset('image/img3.jpeg')}}" alt="">
                    </a>
                </div>
                @endfor
            </div>
            <!-- END Simple Gallery -->
        </div>
    </div>
@stop

@section('js_after')
<script src="{{asset('js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
@stop
