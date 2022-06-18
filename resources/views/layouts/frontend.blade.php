<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    @include('layouts.head')

    @stack('css_before')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="{{ asset('guest/css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('guest/css/magnific-popup.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('guest/css/jquery.selectBox.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('guest/css/dropzone.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('guest/css/rangeslider.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('guest/css/animate.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('guest/css/leaflet.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('guest/css/slick.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('guest/css/slick-theme.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('guest/css/map.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('guest/css/rent/jquery.message.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('guest/css/jquery.mCustomScrollbar.css') }}">

    <link type="text/css" rel="stylesheet" href="{{ asset('guest/fonts/fontawesome/font-awesome.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('guest/fonts/iconfontcustom/icon-font-custom.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <link type="text/css" rel="stylesheet" href="{{ asset('guest/deesynertz.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('guest/shebyclassic.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('guest/fav/css/styles.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('guest/toast.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('guest/css/skins/default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/oneui.css') }}">
    
    <style>
        .infoWindow {
            height: 180px;
            width: 150px;
            overflow-x: hidden;
        }

        .img-w {
            height: 70px;
            width: calc(100% - 5px);
            object-fit: cover;
        }

        .infoWindow a {
            color: red;
            text-decoration: underline;
            font-weight: 200;
        }

        * {
            padding: 0;
        }

        body,
        html {
            height: 100%;
            width: 100%;
            overflow: hidden;
            
        }


        .animated-logo {
            animation: ಠ_ಠ 5s infinite alternate ease-in-out -7.5s;
            animation-fill-mode: forwards;
            transform: rotateY(0deg) rotateX(40deg) translateZ(0);
        }

        @keyframes ಠ_ಠ {
            100% {
                transform: rotateY(-0deg) rotateX(-40deg);
            }
        }


        .unitInfo {
            overflow: hidden;
            width: 180px;
        }


        .unitInfo a {
            margin-top: 10px;
            text-decoration: none;
            font-weight: bold;
            padding: 5px;
            color: #00314a
        }




        .loader-body {
            position: absolute;
            top: 0;
            width: 100%;
            height: 100%;
            align-items: center;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: center;
            visibility: visible;
        }

        .loader {
            animation: rotate 1s infinite;
            height: 50px;
            width: 50px;
        }

        .loader:before,
        .loader:after {
            border-radius: 50%;
            content: '';
            display: block;
            height: 20px;
            width: 20px;
        }

        .loader:before {
            animation: ball1 1s infinite;
            background-color: #ffc107;
            box-shadow: 30px 0 0 #ffc107;
            margin-bottom: 10px;
        }

        .loader:after {
            animation: ball2 1s infinite;
            background-color: #00314a;
            box-shadow: 30px 0 0 #00314a;
        }

        @keyframes rotate {
            0% {
                -webkit-transform: rotate(0deg) scale(0.8);
                -moz-transform: rotate(0deg) scale(0.8);
            }

            50% {
                -webkit-transform: rotate(360deg) scale(1.2);
                -moz-transform: rotate(360deg) scale(1.2);
            }

            100% {
                -webkit-transform: rotate(720deg) scale(0.8);
                -moz-transform: rotate(720deg) scale(0.8);
            }
        }

        @keyframes ball1 {
            0% {
                box-shadow: 30px 0 0 #b5121f;
            }

            50% {
                box-shadow: 0 0 0 #b5121f;
                margin-bottom: 0;
                -webkit-transform: translate(15px, 15px);
                -moz-transform: translate(15px, 15px);
            }

            100% {
                box-shadow: 30px 0 0 #b5121f;
                margin-bottom: 10px;
            }
        }

        @keyframes ball2 {
            0% {
                box-shadow: 30px 0 0 #ffc107;
            }

            50% {
                box-shadow: 0 0 0 #ffc107;
                margin-top: -20px;
                -webkit-transform: translate(15px, 15px);
                -moz-transform: translate(15px, 15px);
            }

            100% {
                box-shadow: 30px 0 0 #ffc107;
                margin-top: 0;
            }
        }



        nav a {
            color: #f4f4f4;
        }

        nav a.active {
            border-bottom: 5px solid #fdeca6;
            background: #444;
            color: #fdeca6;
            font-weight: bold;
            border-top-right-radius: 5px;
            border-top-left-radius: 5px;
        }

    </style>

    @stack('css_after')

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <script type="text/javascript">
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
    </script>

    <script rel="stylesheet" href="{{ asset('js/modernizr-custom.js') }}"></script>
</head>

<body id="top" onload="loadWindow();">

    @include('includes.header')
    <div class="overflow-y-auto" style="height: calc(100% - 163px)">
        <div class="h-100 overflow-y-auto">
            @yield('content')
            @include('includes.footer')
        </div>
        
        <div class="loader-body">
            <div class="loader"></div>
        </div>
    </div>
    
    
    @include('layouts.mobile.moble-view')

    <!-- External JS libraries -->


    <script src="{{ asset('js/oneui.app.min.js') }}"></script>

    <script src="{{ asset('guest/js/defaults/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('guest/js/popper.min.js') }}"></script>
    <script src="{{ asset('guest/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('guest/js/jquery.selectBox.js') }}"></script>
    <script src="{{ asset('guest/js/rangeslider.js') }}"></script>
    <script src="{{ asset('guest/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('guest/js/jquery.filterizr.js') }}"></script>
    <script src="{{ asset('guest/js/wow.min.js') }}"></script>
    <script src="{{ asset('guest/js/backstretch.js') }}"></script>
    <script src="{{ asset('guest/js/jquery.countdown.js') }}"></script>
    <script src="{{ asset('guest/js/jquery.scrollUp.js') }}"></script>
    <script src="{{ asset('guest/js/particles.min.js') }}"></script>
    <script src="{{ asset('guest/js/typed.min.js') }}"></script>
    <script src="{{ asset('guest/js/dropzone.js') }}"></script>
    <script src="{{ asset('guest/js/jquery.mb.YTPlayer.js') }}"></script>
    <script src="{{ asset('guest/js/leaflet.js') }}"></script>
    <script src="{{ asset('guest/js/leaflet-providers.js') }}"></script>
    <script src="{{ asset('guest/js/leaflet.markercluster.js') }}"></script>
    <script src="{{ asset('guest/js/slick.min.js') }}"></script>
    <script src="{{ asset('guest/js/sms.js') }}"></script>
    <script src="{{ asset('guest/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('guest/js/ie-emulation-modes-warning.js') }}"></script>
    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {!! Toastr::message() !!}
    {!! Toastr::clear(); !!}
    <script>
        // $('#main-frame').css('visibility', 'hidden').hide();
        $(document).ready(function() {
            $('#main-frame').css('visibility', 'visible').fadeIn();
        })
    </script>

    <!-- Custom JS Script -->

    <script>
        
        var _token = "{{ csrf_token() }}";
       
    </script>
{{-- Localization on js content --}}
    <script src="{{ asset('guest/js/app.js') }}"></script>
    <script src="{{ asset('guest/js/rent/map.js') }}"></script>
    <script src="{{ asset('guest/js/toast.js') }}"></script>
    <script src="{{ asset('guest/js/deesynertz.min.js') }}"></script>
    <script src="{{ asset('guest/js/webhook.js') }}"></script>

    <script src="{{ asset('guest/js/defaults/kwako.app.js') }}"></script>
    <script src="{{ asset('guest/js/rent/jquery.message.js') }}"></script>

    <script src="{{ asset('js/mobile-view.js') }}"></script>
    <script>
        consoleText(['Good Foundation for Quality Education'], 'headersubtitle', ['#333']);
    </script>
  

    @stack('js_after')
   

 

    <script src="{{ asset('guest/js/rent/ngata.rent.js') }}"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(document).ready(function() {
            // hiiden loader after document   
            $('.loader-body').css('visibility', 'hidden')
        })
  </script>

  <script>
      function loaderWindow() {
        $('.loader-body').css('visibility', 'visible')
      }
  </script>
  <script src="{{ asset('js/script.js') }}"></script>
  @yield('js_after')
</body>

</html>
