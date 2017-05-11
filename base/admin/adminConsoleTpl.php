<script>
$(document).ready(function(){
  $('#rest-submit').click(function(){
    $.ajax({
      type: $('#requested-type').val(),
      url: "rest.php",
      data: $('#rest-form').serialize(),
      dataType: "json",
      beforeSend: function() {
        $("#response-block").html("<img src='<?php echo getConfig('base_domain_path').getConfig('static_path_image').'/loading_image.gif';?>'>");
       },
      success: function(response) {
        $("#request-url").html(document.getElementById("api-url").href + "?"+$('#rest-form').serialize());
        $("#response-block").JSONView(response);
        $(window).scrollTop(0);
        $('#result-block').show();
      },
      error: function(error){
        $("#request-url").html(document.getElementById("api-url").href + "?"+$('#rest-form').serialize());
        $("#response-block").html('<pre>ERROR: '+error.status+': '+error.statusText+'</pre><br/>'+error.responseText);
        $(window).scrollTop(0);
        $('#result-block').show();
      }
    });
  });

  $('#user_id').focusout(function(){    
    var userId = $("#user_id").val() ;        
    $.ajax({ 
      url :'<?php echo getComponentUrl('admin', 'getAccessToken');?>',            
      data: {userId : userId},
      dataType: "json",
      beforeSend: function() { },
      success: function(response) 
      { 
        $("#access_token").val(response.message);
      }    
    });
  });
  
});
</script>
<div class="container">
  <div class="row content-block">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-md-2 block">
          <h4>API List:</h4>
          <table class="table">
            <?php foreach($apiList as $item) { ?>
              <tr><td><a href="<?php echo getComponentUrl('admin', 'console', array("methodName"=>$item));?>"><?php echo $item;?></a></td></tr>
            <?php } ?>
          </table>
        </div>
        <div class="col-md-5 block">
          <?php if(!empty($_GET['methodName'])) { ?>
            <h4>Input Parameters: <small><a href="<?php echo getComponentUrl('admin', 'manage', array("methodName"=>$item));?>" class="pull-right">Manage this API</a></small></h4>           
            <form id="rest-form" name="restform">
              <table class="table">
                <tr><td>methodName:</td><td><strong><?php echo $_GET['methodName'];?></strong></td></tr>
                <tr><td>requestMethod:</td><td><strong><select id="requested-type"><option value="GET">GET</option><option value="POST">POST</option></select></strong></td></tr>
                <?php foreach($params as $param) { ?>
                  <?php if(isset($param['showInConsole']) && $param['showInConsole']==false){continue;}?>
                  <tr>
                    <?php $opt = ($param['required'])?"":"(optional)<br/>";?>
                    <tr>
                      <td><?php echo $param['name'];?>:</td>
                      <td>
                        <input type="<?php echo $param['type'];?>" name="<?php echo $param['name'];?>"  id="<?php echo $param['name'];?>" value="<?php echo isset($param['default'])?$param['default']:"";?>" class="col-md-12 text-box" />
                        <small><?php echo $opt.$param['description'];?></small>
                      </td>
                    </tr>
                  </tr>
                <?php } ?>
                <tr>
                  <td></td>
                  <td>
                    <a id="api-url" class="hide" href="rest.php"></a>
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
</div>
