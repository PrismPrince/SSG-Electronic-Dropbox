<head>
  <noscript>
    <meta http-equiv="refresh" content="0;url={{ url('/') }}">
  </noscript>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="application-name" content="SSG Electronic Dropbox">
  <meta name="author" content="Dave Dane Pacilan">
  <meta name="description" content="Cebu Technological University - Main Campus: Supreme Student Government Electronic Dropbox">
  <meta name="keywords" content="Cebu Technological University, CTU, Supreme Student Government, SSG, post, poll, suggestion">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('/css/app.min.css') }}">
  @stack('styles')

  <!-- Scripts -->
  @if (Auth::guest())
    <script>
      window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
      ]) !!}
    </script>
  @else
    <script>
      window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        'authorization' => 'Bearer ' . Auth::user()->api_token,
      ]) !!}
    </script>
  @endif
</head>