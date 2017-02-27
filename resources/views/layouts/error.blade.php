<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('error-title')</title>

    <style>
      body, html {
        width: 100%;
        height: 100%;
        background-color: #21232a;
      }
      body {
        margin: 0;
        color: #fff;
        text-align: center;
        text-shadow: 0 2px 4px rgba(0,0,0,.5);
        padding: 0;
        min-height: 100%;
        -webkit-box-shadow: inset 0 0 75pt rgba(0,0,0,.8);
        box-shadow: inset 0 0 75pt rgba(0,0,0,.8);
        display: table;
        font-family: "Open Sans",Arial,sans-serif;
      }
      .cover {
        display: table-cell;
        vertical-align: middle;
        padding: 0 20px;
      }
      h1 {
        margin: .67em 0;
        font-family: inherit;
        font-weight: 500;
        line-height: 1.1;
        color: inherit;
        font-size: 36px;
      }
      h1 small {
        font-size: 68%;
        font-weight: 400;
        line-height: 1;
        color: #777;
      }
      .lead {
        color: silver;
        font-size: 21px;
        line-height: 1.4;
      }
      .lead a {
        color: #fff;
        text-decoration: none;
      }
      .lead a:hover {
        text-decoration: underline;
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
    </div>

    <footer>
      <p>Cebu Technological University - Main campus &copy; 2017</p>
    </footer>

  </body>
</html>
