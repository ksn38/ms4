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
    <div class="container">
      <!--div>
        {% block header %}{% endblock header %}
      </div-->
      <div>
        @yield('content')
      </div>
    </div> 
  </body>
</html>