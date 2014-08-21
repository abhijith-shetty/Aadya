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
    <link href="static/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="static/css/style.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="row header-block">
        <div class="col-lg-12">
          <h1>Adya</h1>
          <hr/>
          <div class="nav-block">
            <ul role="tablist" class="nav nav-pills nav-justified">
              <li><a href="../">Home</a></li>
              <li class="active"><a href="">API Reference</a></li>
              <li><a href="console.php">Test Console</a></li>
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
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>API Name(api_method)</th>
                <th width="25%">Input Parameter</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Mandatory Fields</td>
                <td>
                  applicationKey<br/>
                  methodName<br/>
                  accessToken<br/>
                  userId<br/>
                </td>
                <td></td>
              </tr>
              <?php
                $path = dirname(dirname(__FILE__)).'/methods/';
                $apiList = scandir($path);
                include(dirname(dirname(__FILE__)).'/base/restBase.class.php');
                include(dirname(dirname(__FILE__)).'/base/baseInitializer.class.php');
                
                for($i=3; $i<count($apiList); $i++)
                {
                  echo "<tr>";
                  $apiDirName = $apiList[$i];
                  $arr = explode('.', $apiDirName);
                  $apiName = $arr[0].ucfirst($arr[1]);
                  echo "<td><a href='console.php?methodName=".$apiDirName."'>".$apiDirName."</a></td>";
                  $apiInitClassName = $apiName.'Initialize';
                  
                  $initFile = $path.$apiDirName.'/'.$apiName.'Initialize.class.php';

                  include($initFile);
                  $inst = new $apiInitClassName;
                  $params = $inst->getParameter();
                  echo "<td>";
                  $desc = "";
                  foreach($params as $param) 
                  {
                      $opt = ($param['required'])?"":" (optional)";
                      echo $param['name'].$opt."<br/>";
                      $desc .= $param['name']."<b>&nbsp;:&nbsp;</b>".$param['description']."<br/>";
                  }
                  echo "</td>";
                  echo "<td>".$desc."</td>";
                  echo "</tr>";
                }
                ?>
            </tbody>
          </table>
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