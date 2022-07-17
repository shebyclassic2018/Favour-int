@extends('layouts.frontend')
{{-- 0678 026 018 --}}
{{-- 0714 103 743 --}}
{{-- 0758 681 720 --}}
{{-- 0717 174 045 --}}
{{-- 0692 492 351 --}}
@section('title', 'Administrator')

@push('css_before')

@endpush

@section('content')
    <!-- Section: Design Block -->
<section class="background-radial-gradient overflow-y-auto" style="calc(100% - 50px)">
    <style>
      .background-radial-gradient {
        background-color: rgb(66, 80, 24);
        background-image: radial-gradient(650px circle at 0% 0%,
            rgb(111, 119, 82)15%,
            rgb(96, 109, 52) 35%,
            rgb(81, 102, 12) 75%,
            rgb(66, 80, 24) 80%,
            transparent 100%),
          radial-gradient(1250px circle at 100% 100%,
            rgb(111, 119, 82)15%,
            rgb(96, 109, 52) 35%,
            rgb(81, 102, 12) 75%,
            rgb(66, 80, 24) 80%,
            transparent 100%);
      }
  
      #radius-shape-1 {
        height: 220px;
        width: 220px;
        top: -60px;
        left: -130px;
        background: radial-gradient(rgb(53, 65, 16), rgb(94, 114, 34));
        overflow: hidden;
      }
  
      #radius-shape-2 {
        border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
        bottom: -60px;
        right: -110px;
        width: 300px;
        height: 300px;
        background: radial-gradient(rgb(53, 65, 16), rgb(94, 114, 34));
        overflow: hidden;
      }
  
      .bg-glass {
        background-color: hsla(0, 0%, 100%, 0.9) !important;
        backdrop-filter: saturate(200%) blur(25px);
      }
    </style>
  
    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
      <div class="row gx-lg-5 align-items-center mb-5">
        <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
          <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
            Favour International <br />
            <span style="color: hsl(218, 81%, 75%)">Pre and Primary School</span>
          </h1>
          <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
            ADMINISTRATOR LOGIN PAGE
          </p>
        </div>
  
        <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
          <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
          <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>
  
          <div class="card bg-glass">
            <div class="card-body px-4 py-5 px-md-5">
              <form>
  
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example3">Email address</label>
                  <input type="email" id="form3Example3" class="form-control" />
                </div>
  
                <!-- Password input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example4">Password</label>
                  <input type="password" id="form3Example4" class="form-control" />
                </div>
  
  
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">
                  Login
                </button>
  
                <!-- Register buttons -->
                <div class="text-center">
                  <p>or sign up with:</p>
                  <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-facebook-f"></i>
                  </button>
  
                  <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-google"></i>
                  </button>
  
                  <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-twitter"></i>
                  </button>
  
                  <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-github"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section: Design Block -->
@stop
