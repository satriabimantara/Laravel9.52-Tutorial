<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Satria Bimantara">
    <meta name="generator" content="Hugo 0.84.0">
    <title>@yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('bootstrap-5/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('custom-css')

</head>
<body>
    @include('layouts.components.header')


    <main>
        <div class="container my-5">
            @include('layouts.components.jumbotron')
            @yield('content')
        </div>
    </main>

    @include('layouts.components.footer')

    <script src="{{ asset('bootstrap-5/js/bootstrap.bundle.min.js') }}" ></script>
    </body>
</html>
