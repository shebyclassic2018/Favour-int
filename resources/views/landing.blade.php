@extends('layouts.frontend')

@section('title', 'Home')

@push('css_after')
@endpush

@push('css_before')
    <style>
        #slidy-container {
            width: 100%;
            height: 500px;
            margin: 0 auto 15px auto;
            overflow: hidden;
        }

        .slider {
            margin: 0 auto;
            max-width: 940px;
        }

        .slide_viewer {
            height: 440px;
            overflow: hidden;
            position: relative;
        }

        .slide_group {
            height: 100%;
            position: relative;
            width: 100%;
        }

        .slide {
            display: none;
            height: 100%;
            position: absolute;
            width: 100%;
            object-fit: cover
        }

        .slide:first-child {
            display: block;
        }

        .slide:nth-of-type(1) {
            background: #D7A151;
        }

        .slide:nth-of-type(2) {
            background: #F4E4CD;
        }

        .slide:nth-of-type(3) {
            background: #C75534;
        }

        .slide:nth-of-type(4) {
            background: #D1D1D4;
        }

        .slide_buttons {
            left: 0;
            position: absolute;
            right: 0;
            text-align: center;
        }

        a.slide_btn {
            color: #474544;
            font-size: 42px;
            margin: 0 0.175em;
            -webkit-transition: all 0.4s ease-in-out;
            -moz-transition: all 0.4s ease-in-out;
            -ms-transition: all 0.4s ease-in-out;
            -o-transition: all 0.4s ease-in-out;
            transition: all 0.4s ease-in-out;
        }

        .slide_btn.active,
        .slide_btn:hover {
            color: #428CC6;
            cursor: pointer;
        }

        .directional_nav {
            height: 100px;
            margin: 0 auto;
            max-width: 940px;
            position: relative;
            top: -340px;
        }

        .previous_btn {
            bottom: 0;
            left: 100px;
            margin: auto;
            position: absolute;
            top: 0;
        }

        .next_btn {
            bottom: 0;
            margin: auto;
            position: absolute;
            right: 100px;
            top: 0;
        }

        .previous_btn,
        .next_btn {
            cursor: pointer;
            height: 65px;
            opacity: 0.5;
            -webkit-transition: opacity 0.4s ease-in-out;
            -moz-transition: opacity 0.4s ease-in-out;
            -ms-transition: opacity 0.4s ease-in-out;
            -o-transition: opacity 0.4s ease-in-out;
            transition: opacity 0.4s ease-in-out;
            width: 65px;
        }

        .previous_btn:hover,
        .next_btn:hover {
            opacity: 1;
        }

        @media only screen and (max-width: 767px) {
            .previous_btn {
                left: 50px;
            }

            .next_btn {
                right: 50px;
            }
        }

        .tag {
            height: 25px;
            width: 50px;
            border-radius: 50%;
            border: 3px dashed white
        }
        marquee a{
            background: rgb(215, 213, 212);
            color: rgb(108, 108, 108);
            margin-right: 5px;
            padding: 8px;
        }
    </style>
@endpush
@section('content')
    <div class="container flow-y-auto">
        <h4 class="py-3 border-bottom"><span class="fa fa-home"></span> HOME</h4>
        <div class="row mb-3">
            <div class="col-12">
                <marquee behavior="" direction="">
                    @foreach ($events as $row)
                    @if (IsActiveEvent($row->event_date))
                    <a href="#event">{{$row->descriptions}} - {{date('dS M Y', strtotime($row->event_date))}}</a>
                    @endif
                    @endforeach
                </marquee>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{-- <div id="slidy-container" style="height: 500px">
                    <figure id="slidy">
                        @foreach ($images as $row)
                            <img class="img-fluid h-100" src="{{ asset('image/uploads/' . $row->path) }}"
                                alt="{{ $row->caption }}" data-caption="{{ $row->caption }}">
                        @endforeach
                    </figure>
                </div> --}}
                <div class="slider">
                    <div class="slide_viewer">
                        <div class="slide_group">
                            @foreach ($images as $row)
                                <img class="slide img-fluid h-100" src="{{ asset('image/uploads/' . $row->path) }}"
                                    alt="{{ $row->caption }}" data-caption="{{ $row->caption }}">
                            @endforeach
                        </div>
                    </div>
                </div><!-- End // .slider -->

                <div class="slide_buttons">
                </div>

                <div class="directional_nav">
                    <div class="previous_btn" title="Previous">

                    </div>
                    <div class="next_btn" title="Next">

                    </div>
                </div><!-- End // .directional_nav -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            </div>
            <div class="col-md-6">
                <div class="block">
                    <div class="block-header block-header-default">
                        <div class="block-title">INTRODUCTION</div>
                    </div>
                    <div class="block-content fs-xs text-justify" style="line-height: 23px">
                        <span class="first-letter">T</span>he history of Education in Tanzania depicts that the government
                        since independence emphasized
                        on the need of improving education standards and ensure that every Tanzanian has equal opportunity
                        to education.
                        It is an acknowledged fact that education is one of the most important factors in the development of
                        man and it is the pillar for
                        economic growth and development. It has therefore to be well planned and effectively managed and
                        implemented.
                    </div><br>
                </div>
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
                        <div class="block">
                            <div class="block-header block-header-default bg-warning text-white">
                                <div class="block-title">VISITORS</div>
                            </div>
                            <div class="block-content fs-xs text-justify" style="line-height: 23px">
                                <div class="flex">
                                    <div class="flex-1">Today</div>
                                    <div class="">{{ visits($visits)->period('day')->count() }}</div>
                                </div>
                                <div class="flex">
                                    <div class="flex-1">This week</div>
                                    <div class="">{{ visits($visits)->period('week')->count() }}</div>
                                </div>
                                <div class="flex">
                                    <div class="flex-1">This month</div>
                                    <div class="">{{ visits($visits)->period('month')->count() }}</div>
                                </div>
                                <div class="flex">
                                    <div class="flex-1">This year</div>
                                    <div class="">{{ visits($visits)->period('year')->count() }}</div>
                                </div>
                                <div class="flex fw-bold    ">
                                    <div class="flex-1">Total</div>
                                    <div class="">{{ visits($visits)->period('total')->count() }}</div>
                                </div>
                            </div><br>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="block">
                            <div class="block-header block-header-default bg-warning text-white">
                                <div class="block-title">EVENTS</div>
                            </div>
                            <div class="block-content fs-xs text-justify" style="line-height: 23px">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Event</th>
                                            <th colspan="2">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $row)
                                            @if (IsActiveEvent($row->event_date))
                                                <tr>
                                                    <td>{{ $row->descriptions }}</td>
                                                    <td>{{ date('dS M Y', strtotime($row->event_date)) }}</td>
                                                    <td>
                                                        @if (IsNewEvent($row->create_at))
                                                        <div class="fading tag bg-danger flex-center text-white">New </div>  
                                                        @endif
                                                    </td> 
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><br>
                        </div>
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


            </div>
        </div>
    </div>
@stop

@section('js_after')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/slick-carousel/slick.min.js') }}"></script>

    <!-- Page JS Helpers (Slick Slider Plugin) -->
    <script>
        One.helpersOnLoad(['jq-slick']);
    </script>

    <script src="{{ asset('js/lory.min.js') }}"></script>

    <script>
        // Codegrid
        // Responsive Image Slider | LoryJS | HTML, CSS & JavaScript
        // https://www.youtube.com/watch?v=GFcnxlNnC8w


        let slider = document.querySelector('.js-carousel');

        lory(slider, {
            infinite: 1,
            enableMouseEvents: true,
            classNameFrame: 'js-carousel__frame',
            classNameSlideContainer: 'js-carousel__slides',
            classNamePrevCtrl: 'js-carousel__prev',
            classNameNextCtrl: 'js-carousel__next',
        });
    </script>




    <script>
        $('.slider').each(function() {
            var $this = $(this);
            var $group = $this.find('.slide_group');
            var $slides = $this.find('.slide');
            var bulletArray = [];
            var currentIndex = 0;
            var timeout;

            function move(newIndex) {
                var animateLeft, slideLeft;

                advance();

                if ($group.is(':animated') || currentIndex === newIndex) {
                    return;
                }

                bulletArray[currentIndex].removeClass('active');
                bulletArray[newIndex].addClass('active');

                if (newIndex > currentIndex) {
                    slideLeft = '100%';
                    animateLeft = '-100%';
                } else {
                    slideLeft = '-100%';
                    animateLeft = '100%';
                }

                $slides.eq(newIndex).css({
                    display: 'block',
                    left: slideLeft
                });
                $group.animate({
                    left: animateLeft
                }, function() {
                    $slides.eq(currentIndex).css({
                        display: 'none'
                    });
                    $slides.eq(newIndex).css({
                        left: 0
                    });
                    $group.css({
                        left: 0
                    });
                    currentIndex = newIndex;
                });
            }

            function advance() {
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                    if (currentIndex < ($slides.length - 1)) {
                        move(currentIndex + 1);
                    } else {
                        move(0);
                    }
                }, 4000);
            }

            $('.next_btn').on('click', function() {
                if (currentIndex < ($slides.length - 1)) {
                    move(currentIndex + 1);
                } else {
                    move(0);
                }
            });

            $('.previous_btn').on('click', function() {
                if (currentIndex !== 0) {
                    move(currentIndex - 1);
                } else {
                    move(3);
                }
            });

            $.each($slides, function(index) {
                var $button = $('<a class="slide_btn">&bull;</a>');

                if (index === currentIndex) {
                    $button.addClass('active');
                }
                $button.on('click', function() {
                    move(index);
                }).appendTo('.slide_buttons');
                bulletArray.push($button);
            });

            advance();
        });
    </script>
@stop
