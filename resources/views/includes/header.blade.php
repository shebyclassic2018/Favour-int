  <!-- Navigation -->
  <div class="flex-center" style="background: #cce08d">
      <img src="{{asset('image/logo/logo.png')}}" class="img-fluid" style="height: 100px;">
      <div>
          <div class="fs-3 fw-bold">FAVOUR INTERNATIONAL PRE AND PRIMARY SCHOOL</div>
          <div class="text-center"><small id="headersubtitle">Good Foundation for Quality Education</small></div>
        </div>
  </div>
  
  <header style="background: #333;">
    <nav class="flex-center fs-xs p-1">
        <a href="{{route('welcome')}}" class="p-3 @if (request()->is('/')) active @endif"><span class="fa fa-home"></span> HOME</a>
        <a href="{{route('admission')}}" class="p-3 @if (request()->is('admission')) active @endif"><span class="fa fa-address-book"></span> ADMISSION</a>
        <a href="{{route('gallery')}}" class="p-3 @if (request()->is('gallery')) active @endif"><span class="fa fa-photo"></span> GALLERY</a>
        <a href="{{route('jobs')}}" class="p-3 @if (request()->is('jobs')) active @endif"><span class="fa fa-tasks"></span> JOBS</a>
        <a href="{{route('aboutus')}}" class="p-3 @if (request()->is('about-us')) active @endif"><span class="fa fa-list"></span> ABOUT US</a>
        <a href="{{route('contactus')}}" class="p-3  @if (request()->is('contact-us')) active @endif"><span class="fa fa-phone-alt"></span> CONTACT US</a>
        <a href="{{route('privacypolice')}}" class="p-3  @if (request()->is('privacy-policy')) active @endif"><span class="fa fa-lock"></span> PRIVACY POLICY</a>
    </nav>
  </header>