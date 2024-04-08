<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Correlation of stock indices</title>
    <link rel="stylesheet" href="{{ asset('bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <script src="{{ asset('jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('Chart.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    </head>
  <body class='bg-success bg-light'>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="navbar-nav mx-1">
        <a class="nav-link" href="{{ url('/') }}">Financial correlations</a>
      </div>
      <div class="navbar-nav mx-1">
        <a class="nav-link" href="{{ url('hh') }}">Programming data</a>
      </div>
      <div class="navbar-nav mx-1">
        <a class="nav-link" href="{{ url('currencies') }}">Currencies and MOEX stocks</a>
      </div>
      <div class="navbar-nav mx-1">
        <a class="nav-link" href="{{ url('about') }}">About</a>
      </div>
    </nav>
    <div class="container">
      @yield('content')
    </div> 
  </body>
</html>