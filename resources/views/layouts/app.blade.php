<!--
 | ===================================================================================================
 | SSG Electronic Dropbox (https://www.github.com/PrismPrince/SSG-Electronic-Dropbox)
 | Copyright 2017 Dave Dane Pacilan
 | Licensed under MIT (https://github.com/PrismPrince/SSG-Electronic-Dropbox/blob/master/LICENSE)
 | ===================================================================================================
-->
<!DOCTYPE html>
<html lang="en">
@include('partials._head')
<body>
  <div id="app">
    @include('partials._navbar')
    @yield('content')
  </div>

  <!-- Scripts -->
  <script src="{{ asset('/js/onload.js') }}"></script>
  @stack('scripts')

</body>
</html>
