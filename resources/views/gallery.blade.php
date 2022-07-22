@extends('layouts.frontend')
@section('title', 'Galley')
@push('css_before')
<link rel="stylesheet" href="{{asset('js/plugins/magnific-popup/magnific-popup.css')}}">
@endpush
@section('content')
    <div class="container">
        <h4 class="py-3 border-bottom"><span class="fa fa-photo"></span> GALLERY</h4>
        <div class="content">
            <!-- Simple Gallery -->
            <div class="row items-push js-gallery img-fluid-100">
                @foreach($images as $row)
                <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">
                    <a class="img-link img-link-zoom-in img-thumb img-lightbox w-100" href="{{asset('image/uploads/' . $row->path)}}">
                        <img class="img-fluid" style="height: 100%; width: 100%" src="{{asset('image/uploads/' . $row->path)}}" alt="">
                    </a>
                </div>
                @endforeach
            </div>
            <!-- END Simple Gallery -->
        </div>
    </div>
@stop

@section('js_after')
<script src="{{asset('js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
@stop
