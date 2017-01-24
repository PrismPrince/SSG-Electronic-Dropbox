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
        <img src="{{ url('/images/tomorrows_council_v1.png') }}" alt="Republic of the Philippines">
        {{-- {{ config('app.name', 'Laravel') }} --}}
      </a>
    </div>

    <div class="collapse navbar-collapse" id="app-navbar-collapse">

      <!-- Search bar -->
      <div class="navbar-form navbar-left dropdown" :class="{open: search.focus}" v-if="user" v-cloak>
        <input type="text" class="form-control" placeholder="Search" v-model.trim="search.key" @keypress.enter="searchKey" @blur="clearSearch()">

        <ul v-if="search.key == ''" class="dropdown-menu">
          <li class="dropdown-header">Search something...</li>
        </ul>

        <ul v-else-if="search.searching" class="dropdown-menu">
          <li><div class="loading-circle"><span class="sr-only">loading</span></div></li>
        </ul>

        <ul v-else class="dropdown-menu">
    
          {{-- Users --}}
          <li v-if="search.results.users.length != 0" class="dropdown-header">Users</li>
          <li v-if="search.results.users.length != 0" v-for="user in search.results.users">
            <a :href="'{{ url('/profile') }}/' + user.id" v-html="highlight(user.fname + ' ' + user.lname)"></a>
          </li>
          <li v-if="search.results.users.length != 0" role="separator" class="divider"></li>
    
          {{-- Posts --}}
          <li v-if="search.results.posts.length != 0" class="dropdown-header">Posts</li>
          <li v-if="search.results.posts.length != 0" v-for="post in search.results.posts">
            <a :href="'{{ url('/post') }}/' + post.id" v-html="highlight(post.title)"></a>
          </li>
          <li v-if="search.results.posts.length != 0" role="separator" class="divider"></li>
    
          {{-- Polls --}}
          <li v-if="search.results.polls.length != 0" class="dropdown-header">Polls</li>
          <li v-if="search.results.polls.length != 0" v-for="poll in search.results.polls">
            <a :href="'{{ url('/poll') }}/' + poll.id" v-html="highlight(poll.title)"></a>
          </li>
          <li v-if="search.results.polls.length != 0" role="separator" class="divider"></li>
    
          {{-- Suggestions --}}
          <li v-if="search.results.suggestions.length != 0" class="dropdown-header">Suggestions</li>
          <li v-if="search.results.suggestions.length != 0" v-for="suggestion in search.results.suggestions">
            <a :href="'{{ url('/suggestion') }}/' + suggestion.id" v-html="highlight(suggestion.title)"></a>
          </li>
          <li v-if="search.results.suggestions.length != 0" role="separator" class="divider"></li>
    
          {{-- No Results --}}
          <li v-if="search.results.users.length == 0 && search.results.posts.length == 0 && search.results.polls.length == 0 && search.results.suggestions.length == 0" class="dropdown-header text-center">
            No results found!
          </li>
        </ul>
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
              {{-- <li><a href="/account">Setting</a></li> --}}
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