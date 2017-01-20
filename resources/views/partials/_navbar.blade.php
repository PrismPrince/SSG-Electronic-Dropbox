<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">

      <!-- Collapsed Hamburger -->
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
        <span class="sr-only">Toggle Navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <!-- Branding Image -->
      <a class="navbar-brand" href="{{ url('/') }}">
        {{-- <img src="/images/republic_seal.png" alt="Republic of the Philippines"> --}}
        {{ config('app.name', 'Laravel') }}
      </a>
    </div>

    <div class="collapse navbar-collapse" id="app-navbar-collapse">

      <!-- Search bar -->
      <div class="navbar-form navbar-left" v-if="user" v-cloak>
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
          </span>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </div>
      </div>

      <!-- Left Side Of Navbar -->
      <!-- <ul class="nav navbar-nav navbar-left">
        &nbsp;
      </ul> -->

      <!-- Right Side Of Navbar -->
      <ul class="nav navbar-nav navbar-right" v-cloak>
        <!-- Authentication Links -->
        @if (Auth::guest())
          <li><a href="{{ url('/login') }}">Login</a></li>
          <li><a href="{{ url('/register') }}">Register</a></li>
        @else
          <li><a href="{{ url('/home') }}">Home</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <input type="hidden" id="Authorization" value="{{ Auth::user()->api_token }}">
                {{ Auth::user()->fname }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">

              <li><a href="{{ url('/profile/' . Auth::id()) }}">Profile</a></li>
              <li class="divider"></li>
              <li><a href="/account">Setting</a></li>
              <li>
                <a
                  href="{{ url('/logout') }}"
                  @click.prevent="logout()"
                >Logout</a>

                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
                </form>
              </li>

            </ul> {{-- .dropdown-menu --}}

          </li> {{-- .dropdown --}}
        @endif
      </ul>
    </div>
  </div>
</nav>