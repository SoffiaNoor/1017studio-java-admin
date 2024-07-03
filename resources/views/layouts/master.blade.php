<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>
    Java Residence Admin
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
    name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/now-ui-dashboard.css?v=1.5.0')}}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{asset('assets/demo/demo.css')}}" rel="stylesheet" />

  <style>
    textarea.form-control {
      max-width: 100%;
      max-height: none !important;
      padding: 10px 10px 0 0;
      resize: none;
      border: none;
      border-bottom: 1px solid #E3E3E3;
      border-radius: 0;
      line-height: 2;
    }
  </style>
</head>

<body>
  <div class="wrapper ">
    <div class="sidebar" data-color="indigo">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="/" class="simple-text logo-normal ml-3" style="font-weight: 900">
          <img src="{{asset('assets/img/Logo putih.png')}}" style="max-width:150px;width:100px;" />
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li class="{{ Route::current()->uri == 'information' ?  'active' : '' }}">
            <a href="/information">
              <i class="now-ui-icons design_app"></i>
              <p>Information</p>
            </a>
          </li>
          <li class="{{ Route::current()->uri == 'imageInformation' ?  'active' : '' }}">
            <a href="/imageInformation">
              <i class="now-ui-icons location_map-big"></i>
              <p>Image Information</p>
            </a>
          </li>
          <li class="{{ Route::current()->uri == 'facility' ?  'active' : '' }}">
            <a href="/facility">
              <i class="now-ui-icons location_map-big"></i>
              <p>Our FACILITIES</p>
            </a>
          </li>
          <li class="px-4 pt-3" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse">
            <p style="font-weight:bold;color:white">PROJECT</p>
            <hr style="margin-top:0px;border-top: 3px solid #fff;">
          </li>
          <div
            class="collapse {{ preg_match('/project|projectImage|projectType|projectTypeImage/', Route::current()->uri) ? 'show' : '' }}"
            id="dashboard-collapse">
            <li class="{{ Route::current()->uri == 'project' ?  'active' : '' }}">
              <a href="/project">
                <i class="now-ui-icons ui-2_settings-90"></i>
                <p>Project</p>
              </a>
            </li>
            <li class="{{ Route::current()->uri == 'projectImage' ?  'active' : '' }}">
              <a href="/projectImage">
                <i class="now-ui-icons business_money-coins"></i>
                <p>Project Image</p>
              </a>
            </li>
            <li class="{{ Route::current()->uri == 'projectType' ?  'active' : '' }}">
              <a href="/projectType">
                <i class="now-ui-icons business_bank"></i>
                <p>Project Type</p>
              </a>
            </li>
            <li class="{{ Route::current()->uri == 'projectTypeImage' ?  'active' : '' }}">
              <a href="/projectTypeImage">
                <i class="now-ui-icons shopping_box"></i>
                <p>Project Type Image</p>
              </a>
            </li>
            <li class="{{ Route::current()->uri == 'projectTypeImage360' ?  'active' : '' }}">
              <a href="/projectTypeImage360">
                <i class="now-ui-icons shopping_box"></i>
                <p>Project Type Image 360</p>
              </a>
            </li>
          </div>
          <li class="{{ Route::current()->uri == 'news' ?  'active' : '' }}">
            <a href="/news">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>News</p>
            </a>
          </li>
          <li class="{{ Route::current()->uri == 'newsImage' ?  'active' : '' }}">
            <a href="/newsImage">
              <i class="now-ui-icons business_money-coins"></i>
              <p>News Image</p>
            </a>
          </li>
          <li class="{{ Route::current()->uri == 'contact' ?  'active' : '' }}">
            <a href="/contact">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Contact Form</p>
            </a>
          </li>
          <li class="{{ Route::current()->uri == 'contact_information' ?  'active' : '' }}">
            <a href="/contact_information">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Contact Information</p>
            </a>
          </li>
          <li class="{{ preg_match('/user/',Route::current()->uri) == true ? 'active' : '' }}">
            <a href="/user">
              <i class="now-ui-icons users_single-02"></i>
              <p>User List</p>
            </a>
          </li>
          <li class="active-pro">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit"
                style="background: none; border: none; cursor: pointer;margin: 10px 15px 0;color: #FFFFFF;text-transform: uppercase;font-size: 0.7142em;">
                <i class="now-ui-icons media-1_button-power"></i>
                <p>Logout</p>
              </button>
            </form>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">
              @yield('breadcrumb')
            </a>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      @yield('content')
    </div>
  </div>


  @yield('jquery')
  <!--   Core JS Files   -->

  <script src="{{asset('assets/js/core/jquery.min.js')}}"></script>
  <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{asset('assets/js/plugins/bootstrap-notify.js')}}"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('assets/js/now-ui-dashboard.min.js?v=1.5.0')}}" type="text/javascript"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="{{asset('assets/demo/demo.js')}}"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
</body>

</html>