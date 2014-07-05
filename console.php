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

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <link rel="stylesheet" href="static/css/jquery.jsonview.css" />
    <script type="text/javascript" src="static/javascript/jquery.jsonview.js"></script>
  
    <style>
      .text-box{
         padding: 5px;
         border: 1px solid #b8a1a1;
         border-radius: 2px;
      }
      #rest-form th{
        padding-top: 20px !important;
        padding-bottom: 20px !important;
      }
      #rest-form td{
        padding-top: 20px !important;
        padding-bottom: 20px !important;
      }
      .block{
        border-right: 1px solid #ddd;
      }
    </style>
    <script>
      $(document).ready(function(){
        $('#rest-submit').click(function(){
          $.ajax({
            type: "GET",
            url: "index.php",
            data: $('#rest-form').serialize(),
            dataType: "json",
            beforeSend: function() {  },
            success: function(response) {
              $("#request-url").html(window.location.protocol + "//" + window.location.host + "/"+this.url);
              $("#response-block").JSONView(response);
              $(window).scrollTop(0);
            },
            error: function(error){
              $("#response-block").html(JSON.stringify(error.responseText));
              $(window).scrollTop(0);
            }
          });
        });
      });
    </script>
  </head>
  <body>
    <div class="container">
      <h2>TEST Console</h2>
      <hr/>
      <div class="row">
        <div class="col-md-2 block">
          <h4>API List:</h4>
          <table class="table">
          <?php
            $path = dirname(__FILE__).'/methods/';
            $apiList = scandir($path);
            include(dirname(__FILE__).'/base/restBase.class.php');
            include(dirname(__FILE__).'/base/baseInitializer.class.php');
            
            for($i=0; $i<count($apiList); $i++)
            {
              if(substr($apiList[$i], 0, 1) != "."){
                echo "<tr><td><a href='?methodName=".$apiList[$i]."'>".$apiList[$i]."</a></td></tr>";
              }
            }
          ?>
          </table>
        </div>
        <div class="col-md-5 block">
          <h4>Input Parameters:</h4>
          <form id="rest-form">
            <table class="table">
            <?php 
              $apiDirName = $_GET['methodName'];
              $arr = explode('.', $apiDirName);
              $apiName = $arr[0].ucfirst($arr[1]);
              echo "<tr><td>methodName:</td><td>".$apiDirName."</td></tr>";
              $apiInitClassName = $apiName.'Initialize';
              $initFile = $path.$apiDirName.'/'.$apiName.'Initialize.class.php';
              include($initFile);
              $inst = new $apiInitClassName;
              $params = array_merge($inst->getAuthParameter(), $inst->getParameter());
              echo '<tr><td>applicationKey</td><td><input class="text-box" name="applicationKey" type="input" value="12345"/></td></tr>';
              foreach($params as $param) 
              {
                $opt = ($param['required'])?"":"(optional)<br/>";
                echo "<tr><td>".$param['name'].":</td><td><input name='".$param['name']."' class='col-md-12 text-box' /><small>".$opt.$param['description']."</small></td></tr>";
              }
            ?>
            <tr>
              <td></td>
              <td>
                <input type="hidden" name="methodName" value="<?php echo $_GET['methodName'];?>"/>
                <input id="rest-submit" type="button" value="Submit" onclick="return true;"/>
              </td>
            </tr>
            </table>
          </form>
        </div>
        <div class="col-md-5">
          <h4>Requested Url:</h4>
          <hr/>
          <div id="request-url"></div>
          <hr/>
          <h4>Response:</h4>
          <hr/>
          <div id="response-block"></div>
        </div>
      </div>
    </div>
  </body>
</html>
