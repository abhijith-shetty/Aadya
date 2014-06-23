<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>API Reference</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <div class="container">
  <div class="row">
    <h1>API Reference</h1>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>API Name(api_method)</th>
          <th width="25%">Input Parameter</th>
          <th width="30%">Response</th>
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
          <td></td>
        </tr>
        <?php
          $path = dirname(__FILE__).'/methods/';
          $apiList = scandir($path);
          include(dirname(__FILE__).'/base/restBase.class.php');
          include(dirname(__FILE__).'/base/baseInitializer.class.php');
          
          for($i=3; $i<count($apiList); $i++)
          {
            echo "<tr>";
            $apiDirName = $apiList[$i];
            $arr = explode('.', $apiDirName);
            $apiName = $arr[0].ucfirst($arr[1]);
            echo "<td>$apiDirName</td>";
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
            echo "<td></td>";
            echo "<td>".$desc."</td>";
            echo "</tr>";
          }
          ?>
      </tbody>
    </table>
    </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  </body>
</html>
