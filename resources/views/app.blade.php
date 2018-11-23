<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DMVevents - @yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">


    <!-- Bootstrap styles -->
    <link href="/css/dashboard.css" rel="stylesheet">

  </head>

  <body>

    <!-- NAV BAR -->
    @include('partials.nav')

    @yield('content')




    <!-- Footer -->
    @include('partials.footer')

  </body>

  <script src="/js/all.js"></script>

  #<script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>

</html>
