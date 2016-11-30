<!DOCTYPE html>
<html lang="en">
@include('partials._head')
<body>
  <div id="app" v-cloak>
    @include('partials._navbar')
    @yield('content')
  </div>

  <!-- Scripts -->
  @stack('scripts')
  <script src="/js/app.js"></script>
</body>
</html>
