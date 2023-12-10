<!DOCTYPE html>
<html>

<head>
  <!-- Basic Page Info -->
  <meta charset="utf-8" />
  <title>{{env('APP_NAME')}} | @yield('page-title')</title>

  <!-- Site favicon -->
  <link rel="icon" sizes="180x180" href="{{asset('assets/logo.jpg')}}" />

  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet" />
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="{{asset('layout/vendors/styles/core.css')}}" />
  <link rel="stylesheet" type="text/css" href="{{asset('layout/vendors/styles/icon-font.min.css')}}" />
  @stack('stylesheets')
  <link rel="stylesheet" type="text/css" href="{{asset('layout/vendors/styles/style.css')}}" />
</head>

<body>

  @guest
  @yield('login-content')
  @else
  {{-- include preloader --}}
  {{-- @include('layouts.includes.preloader') --}}

  {{-- header --}}
  <div class="header">
    <div class="header-left">
      <div class="menu-icon bi bi-list"></div>
      <div class="search-toggle-icon bi bi-search" data-toggle="header_search"></div>
      <div class="header-search">
        <form>
          <div class="form-group mb-0">
            <i class="dw dw-search2 search-icon"></i>
            <input type="text" class="form-control search-input" placeholder="Search Here" />
          </div>
        </form>
      </div>
    </div>
    <div class="header-right">
      {{-- <div class="user-notification">
        <div class="dropdown">
          <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
            <i class="icon-copy dw dw-notification"></i>
            <span class="badge notification-active"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="notification-list mx-h-350 customscroll">
              <ul>
                <li>
                  <a href="#">
                    <img src="{{asset('layout/vendors/images/img.jpg')}}" alt="" />
                    <h3>John Doe</h3>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing
                      elit, sed...
                    </p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img src="{{asset('layout/vendors/images/photo1.jpg')}}" alt="" />
                    <h3>Lea R. Frith</h3>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing
                      elit, sed...
                    </p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img src="{{asset('layout/vendors/images/photo2.jpg')}}" alt="" />
                    <h3>Erik L. Richards</h3>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing
                      elit, sed...
                    </p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img src="{{asset('layout/vendors/images/photo3.jpg')}}" alt="" />
                    <h3>John Doe</h3>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing
                      elit, sed...
                    </p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img src="{{asset('layout/vendors/images/photo4.jpg')}}" alt="" />
                    <h3>Renee I. Hansen</h3>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing
                      elit, sed...
                    </p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <img src="{{asset('layout/vendors/images/img.jpg')}}" alt="" />
                    <h3>Vicki M. Coleman</h3>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing
                      elit, sed...
                    </p>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div> --}}
      <div class="user-info-dropdown">
        <div class="dropdown" dir="rtl">
          <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
            <span class="user-icon">
              <img src="{{asset('layout/vendors/images/photo1.jpg')}}" alt="" />
            </span>
            <span class="user-name">{{Auth::User()->name}}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list text-right">
            <a class="dropdown-item dropdown-item-left" href="{{route('user.profile')}}"><i class="dw dw-user1"></i> {{__('user.profile')}}</a>
            {{-- <a class="dropdown-item dropdown-item-left" href=""><i class="dw dw-settings2"></i> {{__('user.setting')}}</a>
            <a class="dropdown-item dropdown-item-left" href=""><i class="dw dw-help"></i> {{__('user.help')}}</a> --}}
            <form action="{{route('logout')}}" method="POST">
              @csrf
              <button class="dropdown-item dropdown-item-left" type="submit"><i class="dw dw-logout"></i> {{__('auth.logout')}}</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- right side bar --}}
  @include('layouts.includes.right-sidebar')
  {{-- left side bar --}}
  @include('layouts.includes.sidebar')

  <div class="main-container">
    <div class="pd-ltr-20">
      <style>
        .flash-alert {
          position: absolute;
          top: 80px;
          right: 20px;
          box-shadow: 0px 2px 5px #333;
        }
      </style>

      @if (session('status'))
      <div class="alert flash-alert alert-success" role="alert">
        <i class="bi bi-check-circle-fill"></i>
        {{session('status')}}
      </div>

      <script>
        let alert = document.querySelector('.flash-alert');
        
        if (alert != null) {
          setTimeout(() => {
            alert.remove();
          }, 6000);
        }
      </script>

      @elseif($errors->any())
      <div class="alert alert-danger flash-alert">
        <ul>
          @foreach ($errors->all() as $error)
          <li>
            <i class="bi bi-exclamation-triangle-fill"></i>
            <span>{{ $error }}</span>
          </li>
          @endforeach
        </ul>
      </div>
      @endif


      {{-- main content --}}
      @yield('content')

      {{-- page footer --}}
      @include('layouts.includes.footer')
    </div>
  </div>
  @endguest
  <!-- js -->
  <script src="{{asset('layout/vendors/scripts/core.js')}}"></script>
  <script src="{{asset('layout/vendors/scripts/script.min.js')}}"></script>
  <script src="{{asset('layout/vendors/scripts/process.js')}}"></script>
  <script src="{{asset('layout/vendors/scripts/layout-settings.js')}}"></script>
  @stack('scripts')

</body>

</html>