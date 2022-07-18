  <!-- Navigation -->
  <div class="flex-center" style="background: #cce08d">
      <img src="{{asset('image/logo/logo.png')}}" class="img-fluid" style="height: 60px;">
      <div>
          <div class="fs-md-3 fw-bold text-center">FAVOUR INTERNATIONAL PRE AND PRIMARY SCHOOL</div>
          <div class="text-center fs-xs fw-bold"><small id="headersubtitle">Good Foundation for Quality Education</small></div>
        </div>
  </div>
  
  <header class="d-none d-md-block" style="background: #333;">
    <nav class="flex-center fs-xs p-1">
        <a href="{{route('welcome')}}" class="p-3 @if (request()->is('/')) active @endif"><span class="fa fa-home"></span> HOME</a>
        <a href="{{route('admission')}}" class="p-3 @if (request()->is('admission')) active @endif"><span class="fa fa-address-book"></span> ADMISSION</a>
        <a href="{{route('admission')}}" class="p-3 @if (request()->is('')) active @endif"><span class="fa fa-office"></span> DEPARTMENT <span class="fa fa-caret-down"></span></a>
        <a href="{{route('gallery')}}" class="p-3 @if (request()->is('gallery')) active @endif"><span class="fa fa-photo"></span> GALLERY</a>
        <a href="{{route('jobs')}}" class="p-3 @if (request()->is('jobs')) active @endif"><span class="fa fa-tasks"></span> JOBS</a>
        <a href="{{route('aboutus')}}" class="p-3 @if (request()->is('about-us')) active @endif"><span class="fa fa-list"></span> ABOUT US</a>
        <a href="{{route('contactus')}}" class="p-3  @if (request()->is('contact-us')) active @endif"><span class="fa fa-phone-alt"></span> CONTACT US</a>
        <a href="{{route('privacypolice')}}" class="p-3  @if (request()->is('privacy-policy')) active @endif"><span class="fa fa-lock"></span> PRIVACY POLICY</a>
        @if (!isset(Auth::user()->id))
          <a href="{{route('login')}}" class="p-3  @if (request()->is('login')) active @endif"><span class="fa fa-sign-in"></span> LOGIN</a>
        @endif
    </nav>
  </header>
  <header class="d-sm-block d-md-none" style="background: #333;">
    <div class="row p-1">
      <div class="col-sm-12 px-3 py-1">
        <span class="text-white pointer open_menu"><span class="fa fa-bars"></span> Menu</span>
      </div>
    </div>
  </header>