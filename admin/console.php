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
    <link rel="stylesheet" href="static/css/jquery.jsonview.css" />
    <link rel="stylesheet" href="static/css/style.css">
    <script src="static/javascript/jquery-1.10.1.min.js"></script>
    <script src="static/javascript/bootstrap.min.js"></script>
    <script type="text/javascript" src="static/javascript/jquery.jsonview.js"></script>
    
    <script>
      $(document).ready(function(){
        $('#rest-submit').click(function(){
          $.ajax({
            type: "GET",
            url: "../rest.php",
            data: $('#rest-form').serialize(),
            dataType: "json",
            beforeSend: function() {  },
            success: function(response) {
              $("#request-url").html(document.getElementById("api-url").href + "?"+$('#rest-form').serialize());
              $("#response-block").JSONView(response);
              $(window).scrollTop(0);
              $('#result-block').show();
            },
            error: function(error){
              $("#request-url").html(document.getElementById("api-url").href + "?"+$('#rest-form').serialize());
              $("#response-block").html(JSON.stringify(error.responseText));
              $(window).scrollTop(0);
              $('#result-block').show();
            }
          });
        });
      
        $('#userId').focusout(function(){    
          var userId = $("#userId").val() ;        
          $.ajax({ 
            url :"getAccessToken.php",            
            data: {userId : userId},
            dataType: "json",
            beforeSend: function() { },
            success: function(response) 
            { 
              $("#accessToken").val(response.accessToken);
            }    
          });
        });
        
      });
    </script>
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
              <li><a href="documentation.php">API Reference</a></li>
              <li class="active"><a href="">Test Console</a></li>
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
          <div class="row">
            <div class="col-md-2 block">
              <h4>API List:</h4>
              <table class="table">
              <?php
                $path = dirname(dirname(__FILE__)).'/methods/';
                $apiList = scandir($path);
                include(dirname(dirname(__FILE__)).'/base/restBase.class.php');
                include(dirname(dirname(__FILE__)).'/base/baseInitializer.class.php');
                
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
              <?php if(!empty($_GET['methodName'])) { ?>
                <h4>Input Parameters:</h4>           
                <form id="rest-form" name="restform">
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
                    $params = $inst->getParameter();              
                    if(!empty($inst->isSecured))
                    {
                       $authParams = $inst->getAuthParameter();
                       foreach($authParams as $authParam) 
                        {
                          $opt = ($authParam['required'])?"":"(optional)<br/>";
                          echo "<tr><td>".$authParam['name'].":</td><td><input name='".$authParam['name']."'  id='".$authParam['name']."' class='col-md-12 text-box' /><small>".$opt.$authParam['description']."</small></td></tr>";
                        }                
                    }       
                   
                    echo '<tr><td>applicationKey</td><td><input class="text-box" name="applicationKey" type="input" value="12345"/></td></tr>';
                    foreach($params as $param) 
                    {
                      $opt = ($param['required'])?"":"(optional)<br/>";
                      echo "<tr><td>".$param['name'].":</td><td><input name='".$param['name']."'  id='".$param['name']."' class='col-md-12 text-box' /><small>".$opt.$param['description']."</small></td></tr>";
                    }
                  ?>
                  <tr>
                    <td></td>
                    <td>
                      <a id="api-url" class="hide" href="../rest.php"></a>
                      <input type="hidden" name="methodName" value="<?php echo $_GET['methodName'];?>"/>
                      <input id="rest-submit" type="button" value="Submit" onclick="return true;"/>
                    </td>
                  </tr>
                  </table>
                </form>
              <?php } ?>
            </div>
            <div id="result-block" class="col-md-5" style="display:none;">
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