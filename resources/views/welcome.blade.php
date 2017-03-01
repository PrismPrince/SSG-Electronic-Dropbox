<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SSG Electronic Dropbox System</title>

    <link href="{{ asset('/css/welcome.css') }}" rel="stylesheet">

  </head>
  <body>
    <nav id="nav" class="navbar navbar-fixed-top affix-top" data-spy="affix" data-offset-top="70">
      <noscript>
        <p class="noscript text-center">Javascript is disabled in your browser</p>
      </noscript>

      <div class="container">
        <div class="navbar-header">

          {{-- Collapsed Hamburger --}}
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          {{-- Branding Image --}}
          <a class="navbar-brand" href=""><img src="{{ asset('/images/tomorrows_council_v1.png') }}"></a>
        </div> {{-- .navbar-header --}}

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
          {{-- Left Side Of Navbar --}}
          <ul class="nav navbar-nav">

            @if (Auth::check())
              <li><a href="{{ url('/home') }}">Home</a></li>
            @endif

            <li><a href="{{ url('#about') }}">About</a></li>
            <li><a href="{{ url('#location') }}">Location</a></li>
            <li><a href="{{ url('#campuses') }}">Campuses</a></li>
            <li><a href="{{ url('#contact') }}">Contact Us</a></li>
          </ul>

          {{-- Right Side Of Navbar --}}
          <ul class="nav navbar-nav navbar-right">
            {{-- Authentication Links --}}
            @if (Auth::guest())
              <li><a href="{{ url('/login') }}">Login</a></li>
              <li><a href="{{ url('/register') }}">Register</a></li>
            @else
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  <input type="hidden" id="Authorization" value="{{ Auth::user()->api_token }}">
                  {{ Auth::user()->fname }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">

                  <li><a href="{{ url('/profile/' . Auth::id()) }}">Profile</a></li>

                  @if (Auth::user()->role == 'administrator')
                    <li class="divider"></li>
                    <li class="dropdown-header">Administrator</li>
                    <li><a href="{{ url('/admin/user/code') }}">Registration Codes</a></li>
                    <li><a href="{{ url('/admin/user') }}">Users</a></li>
                  @endif

                  <li class="divider"></li>
                  <li class="dropdown-header">Settings</li>
                  <li><a href="{{ url('/account') }}">Account</a></li>
                  <li>
                    <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                  </li>

                </ul> {{-- .dropdown-menu --}}
              </li> {{-- .dropdown --}}
            @endif
          </ul> {{-- .navbar-right --}}
        </div> {{-- .navbar-collapse --}}
      </div> {{-- .container --}}
    </nav> {{-- .navbar --}}

    <div id="ssg-carousel" class="carousel slide" data-ride="carousel" data-interval="5000">
      {{-- Indicators --}}
      <ol class="carousel-indicators">
        <li data-target="#ssg-carousel" data-slide-to="0" class="active"></li>
        <li data-target="#ssg-carousel" data-slide-to="1"></li>
        <li data-target="#ssg-carousel" data-slide-to="2"></li>
        <li data-target="#ssg-carousel" data-slide-to="3"></li>
      </ol>

      {{-- Wrapper for slides --}}
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="images/carousel/Picture1.png">
        </div>

        <div class="item">
          <img src="images/carousel/Picture2.png">
          <div class="carousel-caption">
            <h2>Drinking Fountain</h2>
          </div>
        </div>

        <div class="item">
          <img src="images/carousel/Picture3.png">
          <div class="carousel-caption">
            <h2>First CTU Young Leaders Camp</h2>
          </div>
        </div>

        <div class="item">
          <img src="images/carousel/Picture4.png">
          <div class="carousel-caption">
            <h2>Office Ribbon Cutting and TRACC Board Blessing</h2>
          </div>
        </div>
      </div> {{-- .carousel-inner --}}
    </div> {{-- #ssg-carousel --}}

    <div id="about" class="jumbotron">
      <div class="container">
        <div class="row">
          <div class="col-sm-3 hidden-xs">
            <img class="img-responsive" src="{{ asset('/images/ssg_logo.png') }}">
          </div> {{-- .col-sm-3 --}}
          <div class="col-sm-9">
            <h1 class="text-center">About</h1>
            <p><a target="_blank" href="https://www.facebook.com/CTUMCSSG">Tomorrow's Council</a> is the official Facebook page of the Supreme Student Government of Cebu Technological University - Main Campus.</p>
            <p>The highest governing student body in <a target="_blank" href="http://www.ctu.edu.ph">Cebu Technological University - Main Campus</a>.</p>
          </div> {{-- .col-sm-9 --}}
        </div> {{-- .row --}}

        <div class="row">
          <div class="col-sm-3 hidden-xs">
            <a target="_blank" href="http://www.ctu.edu.ph/transparency-seal/" style="display: block;padding: 0 20px;">
              <img class="img-responsive" src="{{ asset('/images/school/pts.png') }}" alt="Philippine Transparency Seal">
            </a>
          </div> {{-- .col-sm-3 --}}

          <div class="col-sm-3">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Employee Portal</h3>
              </div> {{-- .panel-heading --}}
              <div class="panel-body">
                <a target="_blank" href="http://www.ctu.edu.ph/employee-portal/">
                  <img class="img-responsive" src="{{ asset('/images/school/employee-portal.png') }}" alt="Employee Portal">
                </a>
              </div> {{-- .panel-body --}}
            </div> {{-- .panel --}}
          </div> {{-- .col-sm-3 --}}

          <div class="col-sm-3">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Student Portal</h3>
              </div> {{-- .panel-heading --}}
              <div class="panel-body">
                <a target="_blank" href="http://www.ctu.edu.ph/studentwebapp/">
                  <img class="img-responsive" src="{{ asset('/images/school/student-portal.png') }}" alt="Student Portal">
                </a>
              </div> {{-- .panel-body --}}
            </div> {{-- .panel --}}
          </div> {{-- .col-sm-3 --}}
        </div> {{-- .row --}}
      </div> {{-- .container --}}
    </div> {{-- #about --}}

    <div id="location" class="jumbotron">
      <div class="opacity">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <h1 class="text-center">Location</h1>
            </div> {{-- .col-sm-12 --}}
          </div> {{-- .row --}}
          <div class="row">
            <div class="col-sm-3">
              <div class="panel panel-default">
                <div class="panel-body">
                  <address>
                    <strong>Cebu Technological University - Main Campus</strong><br>
                    Corner M.J. Cuenco Ave. &amp; R. Palma St.,<br>
                    Cebu City, Philippines, 6000
                  </address>
                </div> {{-- .panel-body --}}
              </div> {{-- .panel --}}
            </div> {{-- .col-sm-3 --}}

            <div class="col-sm-9">
              <div class="panel panel-default">
                <div id="map">
                </div>
              </div> {{-- .panel --}}
            </div> {{-- .col-sm-9 --}}
          </div> {{-- .row --}}
        </div> {{-- .container --}}
      </div> {{-- .opacity --}}
    </div> {{-- #location --}}

    <div id="campuses" class="jumbotron">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h1 class="text-center">Campuses</h1>
          </div> {{-- .col-sm-12 --}}
        </div> {{-- .row --}}
        <div class="row">
          <div class="col-sm-12">
            <ul class="list-inline">
              <li>
                <a target="_blank" href="http://www.ctu.edu.ph">
                  <img src="{{ asset('/images/campuses/main.jpg') }}" alt="Cebu Technological University - Main Campus">
                </a>
              </li>
              <li>
                <a target="_blank" href="http://www.argao.ctu.edu.ph">
                  <img src="{{ asset('/images/campuses/argao.jpg') }}" alt="Cebu Technological University - Argao Campus">
                </a>
              </li>
              <li>
                <a target="_blank" href="http://www.barili.ctu.edu.ph">
                  <img src="{{ asset('/images/campuses/barili.jpg') }}" alt="Cebu Technological University - Barili Campus">
                </a>
              </li>
              <li>
                <a target="_blank" href="http://www.carmen.ctu.edu.ph">
                  <img src="{{ asset('/images/campuses/carmen.jpg') }}" alt="Cebu Technological University - Carmen Campus">
                </a>
              </li>
              <li>
                <a target="_blank" href="http://www.daanbantayan.ctu.edu.ph">
                  <img src="{{ asset('/images/campuses/daanbantayan.jpg') }}" alt="Cebu Technological University - Daanbantayan Campus">
                </a>
              </li>
              <li>
                <a target="_blank" href="http://www.danao.ctu.edu.ph">
                  <img src="{{ asset('/images/campuses/danao.jpg') }}" alt="Cebu Technological University - Danao Campus">
                </a>
              </li>
              <li>
                <a target="_blank" href="http://www.moalboal.ctu.edu.ph">
                  <img src="{{ asset('/images/campuses/moalboal.jpg') }}" alt="Cebu Technological University - Moalboal Campus">
                </a>
              </li>
              <li>
                <a target="_blank" href="http://www.sanfran.ctu.edu.ph">
                  <img src="{{ asset('/images/campuses/san-francisco.jpg') }}" alt="Cebu Technological University - San Francisco Campus">
                </a>
              </li>
              <li>
                <a target="_blank" href="http://www.tuburan.ctu.edu.ph">
                  <img src="{{ asset('/images/campuses/tuburan.jpg') }}" alt="Cebu Technological University - Tuburan Campus">
                </a>
              </li>
            </ul> {{-- .list-inline --}}
          </div>{{-- .col-sm-12 --}}
        </div> {{-- .row --}}
      </div> {{-- .container --}}
    </div> {{-- #campuses --}}

    <div id="contact" class="jumbotron">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <h3>Contact Us</h3>
            <address>
              <strong>Telephone</strong><br>
              (6332) 412-1399
            </address>
            <address>
              <strong>Fax</strong><br>
              (6332) 256-2657<br>
              (6332) 416-6706
            </address>
            <address>
              <strong>E-mail Address</strong><br>
              <a href="mailto:information@ctu.edu.ph">information@ctu.edu.ph</a>
            </address>
            <address>
              <a target="_blank" href="http://www.ctu.edu.ph/departments/">Campus Directory</a>
            </address>
          </div> {{-- .col-sm-4 --}}

          <div class="col-sm-4">
            <h3>Quick links</h3>
            <ul class="list-unstyled">
              <li><a target="_blank" href="http://www.ctu.edu.ph/list-of-vacant-positions/">List of Vacant Positions</a></li>
              <li><a target="_blank" href="http://www.ctu.edu.ph/#">Online Job Application</a></li>
              <li><a target="_blank" href="http://www.ctu.edu.ph/#">CTU Hymn</a></li>
              <li><a target="_blank" href="http://www.ctu.edu.ph/#">CTU Main Alumni</a></li>
              <li><a target="_blank" href="http://www.ctu.edu.ph/#">Graduate School Online</a></li>
              <li><a target="_blank" href="http://www.ctu.edu.ph/feedback/">Feedback</a></li>
              <li><a target="_blank" href="http://www.ctu.edu.ph/studentwebapp/">CTU WebApp</a></li>
              <li><a target="_blank" href="http://www.ctu.edu.ph/online-public-access-catalog-opac/">Library OPAC</a></li>
              <li><a target="_blank" href="http://www.ctu.edu.ph/library-proquest/">Library ProQuest</a></li>
              <li><hr></li>
              <li><a target="_blank" href="http://www.ctu.edu.ph/#">Students</a></li>
              <li><a target="_blank" href="http://www.ctu.edu.ph/#">Faculty</a></li>
              <li><a target="_blank" href="http://www.ctu.edu.ph/#">Parents</a></li>
              <li><a target="_blank" href="http://www.ctu.edu.ph/#">Visitors</a></li>
              <li><a target="_blank" href="http://www.ctu.edu.ph/#">Staff</a></li>
            </ul> {{-- .list-unstyled --}}
          </div> {{-- .col-sm-4 --}}

          <div class="col-sm-4 government-links">
            <h3>Government links</h3>
            <div class="row">
              <div class="col-xs-12">
                <a target="_blank" href="http://www.gov.ph/" title="OFFICIAL GAZETTE OF THE REPUBLIC OF THE PHILIPPINES">
                  <img src="{{ asset('/images/government/official-gazette.png') }}" alt="OFFICIAL GAZETTE OF THE REPUBLIC OF THE PHILIPPINES">
                </a>
              </div> {{-- .col-xs-12 --}}
            </div> {{-- .row --}}

            <div class="row">
              <div class="col-xs-4">
                <a target="_blank" href="http://www.coa.gov.ph/" title="COMMISSION ON AUDIT(COA)">
                  <img src="{{ asset('/images/government/coa.png') }}" alt="COMMISSION ON AUDIT(COA)">
                </a>
              </div> {{-- .col-xs-4 --}}
              <div class="col-xs-4">
                <a target="_blank" href="http://www.dost.gov.ph/" title="Department of Science and Technology (DOST)">
                  <img src="{{ asset('images/government/dost.png') }}" alt="Department of Science and Technology (DOST)">
                </a>
              </div> {{-- .col-xs-4 --}}
              <div class="col-xs-4">
                <a target="_blank" href="http://www.ched.gov.ph/" title="COMMISSION ON HIGHER EDUCATION (CHED)">
                  <img src="{{ asset('/images/government/ched.png') }}" alt="COMMISSION ON HIGHER EDUCATION (CHED)">
                </a>
              </div> {{-- .col-xs-4 --}}
            </div> {{-- .row --}}

            <div class="row">
              <div class="col-xs-4">
                <a target="_blank" href="http://www.philgeps.gov.ph/" title="PHILIPPINE GOVERNMENT ELECTRONIC PROCUREMENT SYSTEM (PHILGEPS)">
                  <img src="{{ asset('/images/government/philgeps.png') }}" alt="PHILIPPINE GOVERNMENT ELECTRONIC PROCUREMENT SYSTEM (PHILGEPS)">
                </a>
              </div> {{-- .col-xs-4 --}}
              <div class="col-xs-4">
                <a target="_blank" href="http://www.doe.gov.ph/" title="DEPARTMENT OF ENERGY (DOE)">
                  <img src="{{ asset('/images/government/doe.png') }}" alt="DEPARTMENT OF ENERGY (DOE)">
                </a>
              </div> {{-- .col-xs-4 --}}
              <div class="col-xs-4">
                <a target="_blank" href="http://www.doh.gov.ph/" title="DEPARTMENT OF HEALTH (DOH)">
                  <img src="{{ asset('/images/government/doh.png') }}" alt="DEPARTMENT OF HEALTH (DOH)">
                </a>
              </div> {{-- .col-xs-4 --}}
            </div> {{-- .row --}}

            <div class="row">
              <div class="col-xs-4">
                <a target="_blank" href="http://itsmorefuninthephilippines.com/" title="DEPARTMENT OF TOURISM (DOT)">
                  <img src="{{ asset('/images/government/dot.png') }}" alt="DEPARTMENT OF TOURISM (DOT)">
                </a>
              </div> {{-- .col-xs-4 --}}
              <div class="col-xs-4">
                <a target="_blank" href="http://www.dole.gov.ph/" title="DEPARTMENT OF LABOR AND EMPLOYMENT (DOLE)">
                  <img src="{{ asset('/images/government/dole.png') }}" alt="DEPARTMENT OF LABOR AND EMPLOYMENT (DOLE)">
                </a>
              </div> {{-- .col-xs-4 --}}
              <div class="col-xs-4">
                <a target="_blank" href="http://www.dof.gov.ph/" title="DEPARTMENT OF FINANCE (DOF)">
                  <img src="{{ asset('/images/government/dof.png') }}" alt="DEPARTMENT OF FINANCE (DOF)">
                </a>
              </div> {{-- .col-xs-4 --}}
            </div> {{-- .row --}}
          </div> {{-- .government-links --}}
        </div> {{-- .row --}}
      </div> {{-- .container --}}
    </div> {{-- #contact --}}

    <footer class="text-center">
      <div class="container">
        <a target="_blank" href="http://www.ctu.edu.ph/terms-of-use/">Terms of Use</a> | <a target="_blank" href="http://www.ctu.edu.ph/privacy-statement/">Privacy Statement</a>
        <h3>Cebu Technological University - Main campus <span class="glyphicon glyphicon-copyright-mark"></span> 2017</h3>
      </div> {{-- .container --}}
    </footer>

    <script src="{{ asset('/js/welcome.js') }}"></script>
    <script src="{{ asset('/js/init-map.js') }}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap"></script>
  </body>
</html>