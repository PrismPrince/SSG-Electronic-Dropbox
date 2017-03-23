<!--
 | ===================================================================================================
 | SSG Electronic Dropbox (https://www.github.com/PrismPrince/SSG-Electronic-Dropbox)
 | Copyright 2017 Dave Dane Pacilan
 | Licensed under MIT (https://github.com/PrismPrince/SSG-Electronic-Dropbox/blob/master/LICENSE)
 | ===================================================================================================
-->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="application-name" content="SSG Electronic Dropbox">
    <meta name="author" content="Dave Dane Pacilan">
    <meta name="description" content="Cebu Technological University - Main Campus: Supreme Student Government Electronic Dropbox">
    <meta name="keywords" content="Cebu Technological University, CTU, Supreme Student Government, SSG, post, poll, suggestion">

    <title>@yield('error-title')</title>

    <style>
      body, html {
        width: 100%;
        height: 100%;
        background-color: #21232a;
      }
      body {
        margin: 0;
        text-align: center;
        text-shadow: 0 2px 4px rgba(0,0,0,.5);
        padding: 0;
        min-height: 100%;
        -webkit-box-shadow: inset 0 0 75pt rgba(0,0,0,.8);
        box-shadow: inset 0 0 75pt rgba(0,0,0,.8);
        display: table;
        font-family: "Open Sans",Arial,sans-serif;
      }
      a {
        color: #fff;
        text-decoration: none;
      }
      a:hover {
        text-decoration: underline;
      }
      .cover {
        display: table-cell;
        vertical-align: middle;
        padding: 0 20px;
        color: silver;
      }
      h1 {
        margin: .67em 0;
        font-family: inherit;
        font-weight: 500;
        line-height: 1.1;
        color: #fff;
        font-size: 36px;
      }
      h1 small {
        font-size: 68%;
        font-weight: 400;
        line-height: 1;
        color: #777;
      }
      .lead {
        font-size: 21px;
        line-height: 1.4;
      }
      .help {
        font-size: 15px;
      }
      footer {
        display: block;
        position: fixed;
        width: 100%;
        height: 40px;
        left: 0;
        bottom: 0;
        color: #a0a0a0;
        font-size: 14px;
      }
    </style>
  </head>
  <body>
    <div class="cover">
      <h1>@yield('error-title') <small>Error @yield('error-code')</small></h1>
      <p class="lead">@yield('error-message')</p>
      <p class="help">
        Caught an error? Fork me on <a href="https://www.github.com/PrismPrince/SSG-Electronic-Dropbox">Github</a>.<br>
        <a href="https://www.github.com/PrismPrince">Dave Dane Pacilan</a>
      </p>

    </div>

    <footer>
      <p>Cebu Technological University - Main campus &copy; 2017</p>
    </footer>

    <script src="{{ asset('/js/onload.js') }}"></script>
  </body>
</html>
