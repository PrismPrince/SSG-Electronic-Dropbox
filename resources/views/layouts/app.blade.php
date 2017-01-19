<!DOCTYPE html>
<html lang="en">
@include('partials._head')
<body>
  <div id="app">
    @include('partials._navbar')
    @yield('content')
  </div>

  <!-- Scripts -->
  <script src="/js/bootstrap.js"></script>
  @stack('scripts')
  <script src="/js/app.js"></script>
</body>
</html>
