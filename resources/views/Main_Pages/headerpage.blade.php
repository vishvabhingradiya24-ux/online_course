<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en">
<head>

  <!-- Basic Page Needs
	================================================== -->
  <meta charset="utf-8">
  <title>Educenter - Education HTML Template</title>

  <!-- Mobile Specific Metas
	================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Construction Html5 Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Educenter HTML Template v1.0">

  <!-- theme meta -->
  <meta name="theme-name" content="educenter" />

  {{-- <!-- ** Plugins Needed for the Project ** -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
  <!-- slick slider -->
  <link rel="stylesheet" href="plugins/slick/slick.css">
  <!-- themefy-icon -->
  <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
  <!-- animation css -->
  <link rel="stylesheet" href="plugins/animate/animate.css">
  <!-- aos -->
  <link rel="stylesheet" href="plugins/aos/aos.css">
  <!-- venobox popup -->
  <link rel="stylesheet" href="plugins/venobox/venobox.css">

  <!-- Main Stylesheet -->
  <link href="css/style.css" rel="stylesheet"> --}}



  <link rel="stylesheet" href="{{ asset('plugins/bootstrap/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/themify-icons/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/animate/animate.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/aos/aos.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/venobox/venobox.css') }}">

<link href="{{ asset('css/style.css') }}" rel="stylesheet">

{{-- <img src="{{ asset('images/logo.png') }}" alt="logo"> --}}

{{-- <img class="img-fluid mb-4" src="{{ asset('images/logo.png') }}" alt="logo"> --}}







  {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> --}}
  <!--Favicon-->
  {{-- <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
  <link rel="icon" href="images/favicon.png" type="image/x-icon"> --}}





  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
<link rel="icon" href="{{ asset('images/favicon.png') }}">




</head>

<body>
  <!-- preloader start -->
  <div class="preloader">
    <img src="images/preloader.gif" alt="preloader">
  </div>
  <!-- preloader end -->

<header class="fixed-top header">

  <!-- top header -->
  <div class="top-header py-2 bg-white">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-lg-4 text-center text-lg-left">
          <a class="text-color mr-3" href="tel:+443003030266"><strong>CALL Mulsha</strong> +44 300 303 0266</a>
          <ul class="list-inline d-inline">
            <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="https://facebook.com/themefisher/"><i class="ti-facebook"></i></a></li>
            <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="https://twitter.com/themefisher"><i class="ti-twitter-alt"></i></a></li>
            <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="https://github.com/themefisher"><i class="ti-github"></i></a></li>
            <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="https://instagram.com/themefisher/"><i class="ti-instagram"></i></a></li>
          </ul>
        </div>
        <div class="col-lg-8 text-center text-lg-right">
            <ul class="list-inline">

                @guest
                    <li class="list-inline-item">
                        <a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="{{url('login')}}">Login</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="{{url('register')}}">Register</a>
                    </li>
                @endguest

                @auth
                    @if(auth()->user()->user_type  == 'student')
                        <li class="list-inline-item">
                            <a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="{{url('student/dashboard')}}">My Learning</a>
                        </li>
                    @endif

                    @if(auth()->user()->user_type  == 'teacher')
                        <li class="list-inline-item">
                            <a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="{{url('teacher/dashboard')}}">Teacher Panel</a>
                        </li>
                    @endif

                    @if(auth()->user()->user_type  == 'admin')
                        <li class="list-inline-item">
                            <a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="{{url('admin/dashboard')}}">Admin Panel</a>
                        </li>
                    @endif

                    <li class="list-inline-item">
                        <a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="{{url('logout')}}">Logout</a>
                    </li>
                @endauth

            </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- navbar -->
  <div class="navigation w-100">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-dark p-0">
        <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="logo"></a>
        <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation"
          aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class=" navbar-collapse" id="navigation">
          <ul class="navbar-nav ml-auto text-center">
            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
              <a class="nav-link" href="{{url('/')}}">Home</a>
            </li>
            <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
              <a class="nav-link" href="{{url('about')}}">About</a>
            </li>
            <li class="nav-item {{ Request::is('course') ? 'active' : '' }}">
              <a class="nav-link" href="{{url('course')}}">COURSES</a>
            </li>
            <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
              <a class="nav-link" href="{{url('contact')}}">CONTACT</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>

</header>


    @yield('content')

<!-- footer -->
<footer>
  <!-- footer content -->
  <div class="footer bg-footer section border-bottom">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-sm-8 mb-5 mb-lg-0">
          <!-- logo -->
          <a class="logo-footer" href="index.html"><img class="img-fluid mb-4" src="images/logo.png" alt="logo"></a>
          <ul class="list-unstyled text-color">
            <li class="mb-2">23621 15 Mile Rd #C104, Clinton MI, 48035, New York, USA</li>
            <li class="mb-2">+1 (2) 345 6789</li>
            <li class="mb-2">+1 (2) 345 6789</li>
            <li class="mb-2">contact@yourdomain.com</li>
          </ul>
        </div>
        <!-- company -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
          <h4 class="text-white mb-5">COMPANY</h4>
          <ul class="list-unstyled">
            <li class="mb-3"><a class="text-color" href="about.html">About Us</a></li>
            <li class="mb-3"><a class="text-color" href="teacher.html">Our Teacher</a></li>
            <li class="mb-3"><a class="text-color" href="contact.html">Contact</a></li>
            <li class="mb-3"><a class="text-color" href="blog.html">Blog</a></li>
          </ul>
        </div>
        <!-- links -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
          <h4 class="text-white mb-5">LINKS</h4>
          <ul class="list-unstyled">
            <li class="mb-3"><a class="text-color" href="courses.html">Courses</a></li>
            <li class="mb-3"><a class="text-color" href="events.html">Events</a></li>
            <li class="mb-3"><a class="text-color" href="notice.html">Notice</a></li>
            <li class="mb-3"><a class="text-color" href="scholarship.html">Scholarship</a></li>
          </ul>
        </div>
        <!-- support -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
          <h4 class="text-white mb-5">SUPPORT</h4>
          <ul class="list-unstyled">
            <li class="mb-3"><a class="text-color" href="https://themefisher.com/blog">Forums</a></li>
            <li class="mb-3"><a class="text-color" href="https://docs.themefisher.com/">Documentation</a></li>
            <li class="mb-3"><a class="text-color" href="#!">Language</a></li>
            <li class="mb-3"><a class="text-color" href="#!">Release Status</a></li>
          </ul>
        </div>
        <!-- support -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
          <h4 class="text-white mb-5">RECOMMEND</h4>
          <ul class="list-unstyled">
            <li class="mb-3"><a class="text-color" href="https://themefisher.com/">WordPress</a></li>
            <li class="mb-3"><a class="text-color" href="https://themefisher.com/">LearnPress</a></li>
            <li class="mb-3"><a class="text-color" href="https://themefisher.com/">WooCommerce</a></li>
            <li class="mb-3"><a class="text-color" href="https://themefisher.com/">bbPress</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- copyright -->
  <div class="copyright py-4 bg-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-7 text-sm-left text-center">
          <p class="mb-0">Copyright &copy;
            <script>
              var CurrentYear = new Date().getFullYear()
              document.write(CurrentYear)
            </script>
            , designed & developed by <a href="https://themefisher.com/" class="text-muted">Themefisher</a>
          </p>
        </div>
        <div class="col-sm-5 text-sm-right text-center">
          <ul class="list-inline">
            <li class="list-inline-item"><a class="d-inline-block p-2" href="https://facebook.com/themefisher/"><i class="ti-facebook text-primary"></i></a></li>
            <li class="list-inline-item"><a class="d-inline-block p-2" href="https://twitter.com/themefisher"><i class="ti-twitter-alt text-primary"></i></a></li>
            <li class="list-inline-item"><a class="d-inline-block p-2" href="https://github.com/themefisher"><i class="ti-github text-primary"></i></a></li>
            <li class="list-inline-item"><a class="d-inline-block p-2" href="https://instagram.com/themefisher/"><i class="ti-instagram text-primary"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- /footer -->
{{--
<!-- jQuery -->
<script src="plugins/jQuery/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<!-- slick slider -->
<script src="plugins/slick/slick.min.js"></script>
<!-- aos -->
<script src="plugins/aos/aos.js"></script>
<!-- venobox popup -->
<script src="plugins/venobox/venobox.min.js"></script>
<!-- filter -->
<script src="plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- google map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU"></script>
<script src="plugins/google-map/gmap.js"></script>

<!-- Main Script -->
<script src="js/script.js"></script> --}}




<script src="{{ asset('plugins/jQuery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/slick/slick.min.js') }}"></script>
<script src="{{ asset('plugins/aos/aos.js') }}"></script>
<script src="{{ asset('plugins/venobox/venobox.min.js') }}"></script>
<script src="{{ asset('plugins/filterizr/jquery.filterizr.min.js') }}"></script>
<script src="{{ asset('plugins/google-map/gmap.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>




</body>
</html>
