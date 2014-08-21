<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Adya Admin Panel</title>

    <!-- Bootstrap core CSS -->
    <link href="admin/static/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="admin/static/css/style.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="row header-block">
        <div class="col-lg-12">
          <h1>Adya</h1>
          <hr/>
          <div class="nav-block">
            <ul role="tablist" class="nav nav-pills nav-justified">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="admin/documentation.php">API Reference</a></li>
              <li><a href="admin/console.php">Test Console</a></li>
              <li><a href="/">Developer</a></li>
              <li><a href="/">Logout</a></li>
            </ul>
          </div>
        </div>
      </div>
      <hr/>
      <!-- Example row of columns -->
      <div class="row content-block">
        <div class="col-lg-12">
          <?php
            $protocol = explode('/', $_SERVER['SERVER_PROTOCOL']);
            $protocol = strtolower($protocol[0]).'://';
            $url = $protocol.$_SERVER['SERVER_NAME'].str_replace("index.php", "rest.php", $_SERVER['PHP_SELF']);
          ?>
          <p> <strong>REST Endpoint</strong>:  <mark><?php echo $url;?></mark></p>
        </div>
      </div>
      <hr/>
      <!-- Site footer -->
      <div class="footer">
        <p>&copy; adya 2014</p>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
