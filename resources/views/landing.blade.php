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
    </style>
@endpush

@section('content')
    <div class="container flow-y-auto">
        <h4 class="py-3 border-bottom"><span class="fa fa-home"></span> HOME</h4>
        <div class="row">
            <div class="col-md-12">
                <div id="slidy-container" style="height: 500px">
                    <figure id="slidy" >
                        @foreach ($images as $row)
                        <img class="img-fluid h-100" src="{{asset('image/uploads/' . $row->path)}}"
                        alt="{{$row->caption}}"
                        data-caption="{{$row->caption}}">
                        @endforeach
                    </figure>
                </div>
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
                                    <div class="">{{visits($visits)->period('day')->count()}}</div>
                                </div>
                                <div class="flex">
                                    <div class="flex-1">This week</div>
                                    <div class="">{{visits($visits)->period('week')->count()}}</div>
                                </div>
                                <div class="flex">
                                    <div class="flex-1">This month</div>
                                    <div class="">{{visits($visits)->period('month')->count()}}</div>
                                </div>
                                <div class="flex">
                                    <div class="flex-1">This year</div>
                                    <div class="">{{visits($visits)->period('year')->count()}}</div>
                                </div>
                                <div class="flex fw-bold    ">
                                    <div class="flex-1">Total</div>
                                    <div class="">{{visits($visits)->period('total')->count()}}</div>
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
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $row)
                                          @if (IsActiveEvent($row->event_date))
                                          <tr>
                                              <td>{{$row->descriptions}}</td>
                                              <td>{{date('dS M Y', strtotime($row->event_date))}}</td>
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
        var cssSlidy = function(newOptions) {
            var options = (function() {
                    var mergedOptions = {},
                        defaultOptions = {
                            timeOnSlide: 3,
                            timeBetweenSlides: 1,
                            slidyContainerSelector: '#slidy-container', // name of slider container
                            slidySelector: '#slidy', // name of slider
                            slidyDirection: 'left', // options: left, right
                            fallbackFunction: function() {},
                            cssAnimationName: 'slidy',
                            captionSource: 'data-caption', // options: data-caption, alt, none
                            captionBackground: 'rgba(0,0,0,0.3)',
                            captionColor: '#fff',
                            captionFont: 'Avenir, Avenir Next, Droid Sans, DroidSansRegular, Corbel, Tahoma, Geneva, sans-serif',
                            captionPosition: 'bottom', // options: top, bottom
                            captionAppear: 'slide', //  options: slide, perm, fade
                            captionSize: '1.6rem',
                            captionPadding: '.6rem'
                        };
                    for (var option in defaultOptions) mergedOptions[option] = defaultOptions[option];
                    for (var option in newOptions) mergedOptions[option] = newOptions[option];
                    return mergedOptions;
                })(),
                CS = this;
            CS.animationString = 'animation';
            CS.hasAnimation = false;
            CS.keyframeprefix = '';
            CS.domPrefixes = 'Webkit Moz O Khtml'.split(' ');
            CS.pfx = '';
            CS.element = document.getElementById(options.slidySelector.replace('#', ''));
            CS.init = (function() {
                // browser supports keyframe animation w/o prefixes
                if (CS.element.style.animationName !== undefined) CS.hasAnimation = true;
                // browser supports keyframe animation w/ prefixes
                if (CS.hasAnimation === false) {
                    for (var i = 0; i < CS.domPrefixes.length; i++) {
                        if (CS.element.style[CS.domPrefixes[i] + 'AnimationName'] !== undefined) {
                            CS.pfx = domPrefixes[i];
                            CS.animationString = pfx + 'Animation';
                            CS.keyframeprefix = '-' + pfx.toLowerCase() + '-';
                            CS.hasAnimation = true;
                            // determines CSS prefix required for CSS animations
                            break;
                        }
                    }
                }
                if (CS.hasAnimation === true) {
                    var images = CS.element.getElementsByTagName("img"),
                        L = images.length,
                        fig = document.createElement('figure'),
                        who, temp;
                    while (L) {
                        temp = fig.cloneNode(false);
                        who = images[--L];
                        // wraps all images in the slider with <figure> tags
                        if (options.captionSource !== "none")
                            caption = who.getAttribute(options.captionSource);
                        who.parentNode.insertBefore(temp, who);
                        if (caption !== null) {
                            content = document.createElement('figcaption');
                            content.innerHTML = caption;
                            // places captions in each <figure> element, if required
                        }
                        temp.appendChild(who);
                        if (caption !== null) {
                            temp.appendChild(content);
                        }
                    }
                    var figs = CS.element.getElementsByTagName("figure");
                    var firstFig = figs[0]; // get the first figure inside the "slidy" element.
                    figWrap = firstFig.cloneNode(true); // copy it.
                    CS.element.appendChild(figWrap); // add the clone to the end of the images
                    var imgCount = images
                        .length, // count the number of images in the slide, including the new cloned element
                        totalTime = (options.timeOnSlide + options.timeBetweenSlides) * (imgCount -
                            1
                            ), // calculate the total length of the animation by multiplying the number of _actual_ images by the amount of time for both static display of each image and motion between them
                        slideRatio = (options.timeOnSlide / totalTime) *
                        100, // determine the percentage of time an induvidual image is held static during the animation
                        moveRatio = (options.timeBetweenSlides / totalTime) *
                        100, // determine the percentage of time for an individual movement
                        basePercentage = 100 /
                        imgCount, // work out how wide each image should be in the slidy, as a percentage.
                        position = 0, // set the initial position of the slidy element
                        css = document.createElement("style"); // start marking a new style sheet
                    // creating css style tag
                    css.type = "text/css";
                    css.id = options.slidySelector.replace('#', '') + "-css";
                    css.innerHTML += options.slidyContainerSelector + " { overflow: hidden; }\n";
                    css.innerHTML += options.slidySelector +
                        " { text-align: left; margin: 0; font-size: 0; position: relative; width: " + (
                            imgCount * 100) + "%;  }\n"; // set the width for the inner slider container
                    css.innerHTML += options.slidySelector +
                        " figure { float: left; margin: 0; position: relative; display: inline-block; width: " +
                        basePercentage +
                        "%; height: auto; }\n"; // set the width and size pf the inner <figure> elements
                    css.innerHTML += options.slidySelector + " figure img { width: 100%; }\n";
                    css.innerHTML += options.slidySelector +
                        " figure figcaption { position: absolute; width: 100%; background-color: " + options
                        .captionBackground + "; color: " + options.captionColor + "; font-family: " + options
                        .captionFont + ";";

                    var captions = document.getElementsByTagName("figcaption");
                    var captionHeight = captions[0].offsetHeight * 2 + parseInt(window.getComputedStyle(
                        captions[0]).fontSize, 10);
                    if (options.captionPosition == "top") {
                        switch (options.captions) {
                            case 'fade':
                                css.innerHTML += " top: 0; opacity: 0;";
                                break;
                            case 'slide':
                                css.innerHTML += " top: -" + captionHeight + "px; ";
                                break;
                            default:
                                css.innerHTML += " top: 0;";
                        }
                    } else {
                        switch (options.captionAppear) {
                            case 'fade':
                                css.innerHTML += " bottom: 0; opacity: 0;";
                                break;
                            case 'slide':
                                css.innerHTML += " bottom: -" + captionHeight + "px; ";
                                break;
                            default:
                                css.innerHTML += " bottom: 0;";
                        }
                    }
                    css.innerHTML += " font-size: " + options.captionSize + "; padding: " + options
                        .captionPadding + "; " + keyframeprefix + "transition: .5s; }\n";
                    css.innerHTML += options.slidySelector + ":hover figure figcaption { opacity: 1; ";
                    if (options.captionPosition == "top") {
                        css.innerHTML += " top: 0px;";
                    } else {
                        css.innerHTML += " bottom: 0px;";
                    }
                    css.innerHTML += " }\n";
                    css.innerHTML += "@" + keyframeprefix + "keyframes " + options.cssAnimationName + " {\n";
                    if (options.slidyDirection == "right") {
                        for (i = imgCount - 1; i > 0; i--) { // 
                            position += slideRatio; // make the keyframe the position of the image
                            css.innerHTML += position + "% { left: -" + (i * 100) + "%; }\n";
                            position += moveRatio; // make the postion for the _next_ slide
                            css.innerHTML += position + "% { left: -" + ((i - 1) * 100) + "%; }\n";
                        }
                    } else { // the slider is moving to the left    
                        for (i = 0; i < (imgCount - 1); i++) { // 
                            position += slideRatio; // make the keyframe the position of the image
                            css.innerHTML += position + "% { left: -" + (i * 100) + "%; }\n";
                            position += moveRatio; // make the postion for the _next_ slide
                            css.innerHTML += position + "% { left: -" + ((i + 1) * 100) + "%; }\n";
                        }
                    }
                    css.innerHTML += "}\n";
                    css.innerHTML += options.slidySelector + " { ";
                    if (options.slidyDirection == "right") {
                        css.innerHTML += "left: " + imgCount * 100 + "%"
                    } else {
                        css.innerHTML += "left: 0%; "
                    }

                    css.innerHTML += keyframeprefix + "transform: translate3d(0,0,0); " + keyframeprefix +
                        "animation: " + totalTime + "s " + options.cssAnimationName +
                        " infinite; }\n"; // call on the completed keyframe animation sequence
                    // place css style tag
                    if (options.cssLocation !== undefined) options.cssLocation.appendChild(css);
                    else document.body.appendChild(css);
                } else {
                    // fallback function
                    options.fallbackFunction();
                }
            })();
        }
        cssSlidy();
    </script>
@stop
