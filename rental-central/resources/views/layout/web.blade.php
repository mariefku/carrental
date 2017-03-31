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

    <title>Rental Central</title>

    <!-- Material Design fonts -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Material Design -->
    <link rel="stylesheet" type="text/css" href="{{ asset('material-design/css/bootstrap-material-design.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('material-design/css/ripples.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('material-design/dropdown/jquery.dropdown.css') }}">
    

    <style>
      body {
        padding-bottom: 20px;
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
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Static navbar -->
    <nav class="navbar navbar-primary">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Rental Central - Search</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Rental Central</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
<!--           
            <li><a href="{{ action('DestinationController@listItem') }}">Destination</a></li>
            <li><a href="{{ action('RentalController@listItem') }}">Rental</a></li> -->
          </ul>
        </div><!--/.nav-collapse -->
      </div><!--/.container-fluid -->
    </nav>

    @yield('content.fullpage')

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
      $.material.init();
      $.fn.datepicker.defaults.format = "dd/mm/yyyy";
      $.fn.datepicker.dates['en'] = {
          days: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
          daysShort: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
          daysMin: ["Mi", "Sen", "Sel", "Ra", "Ka", "Ju", "Sa"],
          months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
          monthsShort: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
          today: "Today",
          clear: "Clear",
          format: "mm/dd/yyyy",
          titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
          weekStart: 0
      };
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      function datatableBook(url,
                                id,
                                created_at,
                                updated_at,
                                carmodel_id,
                                plate_number,
                                brand,
                                model,
                                transmission,
                                fuel,
                                car_id,
                                destination,
                                price,
                                year,
                                rental_id,
                                start_date,
                                end_date
                            )
      {
        return '<form class="list-action" method="post" action="../' + url + '">' +
                '{{ csrf_field() }}' +
                  '<input type="hidden" name="id" value="' + id + '">' +
                  '<input type="hidden" name="created_at" value="' + created_at + '">' +
                  '<input type="hidden" name="updated_at" value="' + updated_at + '">' +
                  '<input type="hidden" name="carmodel_id" value="' + carmodel_id + '">' +
                  '<input type="hidden" name="plate_number" value="' + plate_number + '">' +
                  '<input type="hidden" name="brand" value="' + brand + '">' +
                  '<input type="hidden" name="model" value="' + model + '">' +
                  '<input type="hidden" name="transmission" value="' + transmission + '">' +
                  '<input type="hidden" name="fuel" value="' + fuel + '">' +
                  '<input type="hidden" name="car_id" value="' + car_id + '">' +
                  '<input type="hidden" name="destination" value="' + destination + '">' +
                  '<input type="hidden" name="price" value="' + price + '">' +
                  '<input type="hidden" name="year" value="' + year + '">' +
                  '<input type="hidden" name="rental_id" value="' + rental_id + '">' +
                  '<input type="hidden" name="start_date" value="' + start_date + '">' +
                  '<input type="hidden" name="end_date" value="' + end_date + '">' +
                  '<button type="submit" class="btn btn-raised btn-warning">Book</button>' +
               '</form>'
      }
      function datatableDelete(url)
      {
        return '<form class="list-action" method="post" action="' + url + '">' +
            '{{ csrf_field() }}' +
            '<button type="submit" class="btn btn-danger">Delete</button>' +
          '</form>'
      }
    </script>
    @yield('content.js')
  </body>
</html>
