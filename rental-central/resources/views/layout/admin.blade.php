<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- link rel="icon" href="../../favicon.ico" -->

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Material Design fonts -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
    <!-- link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" -->

    <!-- CUSTOM MAIN STYLE -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom/style.css ') }}">

    <!-- Bootstrap Material Design -->
    <link rel="stylesheet" type="text/css" href="{{ asset('material-design/css/bootstrap-material-design.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('material-design/css/ripples.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('material-design/dropdown/jquery.dropdown.css') }}">

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCzX9p40w9AMetlyG_qUi_9rw0ifj9rhk&libraries=geometry,places"></script>

    <style>
      body {
        padding-bottom: 20px;
        color: #000;
      }

      .navbar {
        margin-bottom: 20px;
      }


      .list-main-btn {
        margin-bottom: 10px;
      }

      form.list-action {
        display: inline-block;
        margin-left: 10px;
      }

      .wrapper {	
        margin-top: 80px;
        margin-bottom: 80px;
      }

      .form-signin {
        max-width: 380px;
        padding: 15px 35px 45px;
        margin: 0 auto;
        background-color: #fff;
        border: 1px solid rgba(0,0,0,0.1);  
      }

      .form-signin input {
        margin-bottom: 8px;
      }

      .modal-dialog {
        width: 100%;
        padding: 0px 0px 0 17px;
        margin: 20px 0px 10px 0px;
      }
      .modal-body{
        height: 460px;
        padding: 0px;
      }

      #map-canvas {
        width:100%;
        height:420px;
      }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Static navbar -->
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">

          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Rental Central - Admin</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <a class="navbar-brand" href="{{ url('/admin') }}">Rental Central - Admin</a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li id="destination"><a href="{{ action('DestinationController@listItem') }}">Destination</a></li>
            <li id="rental"><a href="{{ action('RentalController@listItem') }}">Rental</a></li>
            <li id="booking"><a href="{{ action('BookingController@listItem') }}">Booking</a></li>
          </ul>
          
          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav navbar-right">
              <!-- Authentication Links -->
              @if (Auth::guest())
                  <li><a href="{{ route('login') }}">Login</a></li>
                  <li><a href="{{ route('register') }}">Register</a></li>
              @else
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>

                      <ul class="dropdown-menu" role="menu">
                          <li>
                              <a href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                  Logout
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                              </form>
                          </li>
                      </ul>
                  </li>
              @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div><!--/.container-fluid -->
    </nav>

    <div class="container-fluid">
      @yield('content.fullpage')
    </div>

    <div class="container">

      <div class="container">
        @yield('content')
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('material-design/js/ripples.min.js') }}"></script>
    <script src="{{ asset('material-design/js/material.min.js') }}"></script>
    <script src="{{ asset('material-design/dropdown/jquery.dropdown.js') }}"></script>
    <script>
      $('[data-toggle="tooltip"]').tooltip();
      $.material.init();
      $.fn.datepicker.defaults.format = "dd/mm/yyyy";
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      window.Laravel = {!! json_encode([
          'csrfToken' => csrf_token(),
      ]) !!};

      function datatableDetail(url)
      {
        return '<a href="'+ url +'"><button type="button" class="btn btn-raised btn-default btn-sm">Detail</button></a>'
      }
      function datatableEdit(url)
      {
        return '<form class="list-action" method="get" action="' + url + '">' +
                '<button type="submit" class="btn btn-raised btn-default btn-sm">Edit</button>' +
               '</form>'
      }
      function datatableDelete(url)
      {
        return '<form class="list-action" method="post" action="' + url + '">' +
            '{{ csrf_field() }}' +
            '<button type="submit" class="btn btn-raised btn-danger btn-xs" title="Delete"><i class="material-icons">delete_forever</i></button>' +
          '</form>'
      }

    </script>
    @yield('content.js')
  </body>
</html>
