<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- link rel="icon" href="../../favicon.ico" -->

    <title>Rental Node</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/bootstrap-datepicker3.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/datatables.min.css')); ?>" rel="stylesheet">

    <style>
      body {
        padding-top: 20px;
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

    <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Rental Node - Admin</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Rental Node - Admin</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="<?php echo e(action('CarController@listItem')); ?>">Cars</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <div class="container">
        <?php echo $__env->yieldContent('content'); ?>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo e(asset('js/jquery-1.12.4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/datatables.min.js')); ?>"></script>
    <script>
      $.fn.datepicker.defaults.format = "dd/mm/yyyy";
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      function datatableEdit(url)
      {
        return '<form class="list-action" method="get" action="' + url + '">' +
                '<button type="submit" class="btn btn-default">Edit</button>' +
               '</form>'
      }
      function datatableDelete(url)
      {
        return '<form class="list-action" method="post" action="' + url + '">' +
            '<?php echo e(csrf_field()); ?>' +
            '<button type="submit" class="btn btn-danger">Delete</button>' +
          '</form>'
      }
    </script>
    <?php echo $__env->yieldContent('content.js'); ?>
  </body>
</html>
