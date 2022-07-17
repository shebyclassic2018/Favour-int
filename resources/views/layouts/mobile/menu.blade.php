<style>
    .mobile_menu_2 .active {
      font-weight: bold;
      text-decoration: underline;
    }
  </style>
  
  <div class="mobile_menwrap d-lg-none" id="mobile_menwrap">
    <div class="mobile_menu_2 ">
      
      <h5 class="">
        <span class="sidebarclose" id="menuclose">
          <span class="text-danger fs-xs"><span class="fa fa-long-arrow-left"></span> Hide</span>
        </span>
      </h5>
      <br>
  
      <div class="pl-3 pr-3">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item{{ request()->is('/') ? ' active' : '' }}">
            <a class="nav-link fs-xs"  href="/"><span class="fa fa-home"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Home</a>
          </li>
  
  
          <li class="nav-item{{ request()->is('admission') ? ' active' : '' }}">
            <a class="nav-link fs-xs" href="{{route('admission')}}"><span class="fa fa-address-book"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Admission</a>
          </li>
  
          <li class="nav-item{{ request()->is('gallery') ? ' active' : '' }}">
            <a class="nav-link fs-xs" href="{{route('gallery')}}"><span class="fa fa-photo"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Gallery</a>
          </li>
  
        
            <li class="nav-item{{ request()->is('jobs') ? ' active' : '' }}">
              <a class="nav-link fs-xs" href="{{route('jobs')}}"><span class="fa fa-tasks"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Jobs</a>
            </li>
         
            <li class="nav-item{{ request()->is('about-us') ? ' active' : '' }}">
              <a class="nav-link fs-xs" href="{{route('aboutus')}}"><span class="fa fa-list"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Abous US</a>
            </li>
          
             
  
            <li class="nav-item{{ request()->is('contact-us') ? ' active' : '' }}">
              <a class="nav-link fs-xs" href="{{route('contactus')}}"><span class="fa fa-phone-alt"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Contact Us  
              </a>
            </li>

            <li class="nav-item{{ request()->is('privacy-policy') ? ' active' : '' }}">
                <a class="nav-link fs-xs" href="{{route('privacypolice')}}"><span class="fa fa-lock"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Privacy Policy  
                </a>
              </li>
        </ul>
        </div>
      </div>
    </div>