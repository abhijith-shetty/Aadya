<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
<style>
.settings label{
  font-weight: normal;
}
</style>

<h4>Manage API: <small><?php echo $_GET['methodName'];?></small></h4>
<hr/>
<?php if($result['error']) { ?>
  <div class="alert alert-danger"><?php echo $result['message'];?></div>
<?php } ?>
<form method="POST" action="">  
  <div class="row settings">
    <br/>
    <div class="col-md-6">
      <table class="table table-bordered">
        <tr>
          <th>Security</th>
          <td><input id="security-public" type="radio" name="security" value="false" <?php echo ($options['security'])?"":'checked="checked"';?>/>&nbsp;<label for="security-public">Public</label></td>
          <td><input id="security-secured" type="radio" name="security" value="true" <?php echo ($options['security'])?'checked="checked"':"";?>/>&nbsp;<label for="security-secured">Secured</label></td>
        </tr>
        <tr>
          <th>HTTP Method</th>
          <td><input id="method-get" type="checkbox" name="http_method[]" <?php echo (in_array("GET", $options['httpMethod']))?'checked="checked"':"";?> value="GET"/>&nbsp;<label for="method-get">GET</label></td>
          <td><input id="method-post" type="checkbox" name="http_method[]" <?php echo (in_array("POST", $options['httpMethod']))?'checked="checked"':"";?> value="POST"/>&nbsp;<label for="method-post">POST</label></td>
        </tr>
      </table>
    </div>
  </div>
  <hr/><br/>
  <p class="text-right">
    <a href="Javascript:" onclick="$('.add-parameter-clone tr').clone().appendTo('.parameter-list');"><span class="glyphicon glyphicon-plus"></span> Add New Parameter</a>
  </p>
  <table class="table table-bordered parameter-list">
    <tr>
      <th>Parameter <span data-toggle="tooltip" data-placement="right" title="Creates a member variable in the action class with this name." class="glyphicon glyphicon-info-sign"></span></th>
      <th>Name <span data-toggle="tooltip" data-placement="right" title="Input parameter name, used as input key to send value." class="glyphicon glyphicon-info-sign"></span></th>
      <th>Presence <span data-toggle="tooltip" data-placement="right" title="If mandatory, validation will be added." class="glyphicon glyphicon-info-sign"></span></th>
      <th>Default <span data-toggle="tooltip" data-placement="right" title="For optional parameters, please provide a default value." class="glyphicon glyphicon-info-sign"></span></th>
      <th>Description <span data-toggle="tooltip" data-placement="right" title="Description about this parameter." class="glyphicon glyphicon-info-sign"></span></th>
      <th></th>
    </tr>
    <?php foreach($params as $key => $param) { ?>
      <tr>
        <td><input name="parameter[]" required="" value="<?php echo $key;?>" class="text-box" /></td>
        <td><input name="name[]" required="" value="<?php echo $param['name'];?>" class="text-box" /></td>
        <td>
          <select name="required[]" class="text-box">
            <option value="false" <?php echo ($param['required']=="false")?"selected":"";?>>Optional</option>
            <option value="true" <?php echo ($param['required']=="true")?"selected":"";?>>Mandatory</option>
          </select>
        </td>
        <td><input name="default[]" value="<?php echo $param['default'];?>" class="text-box" /></td>
        <td><input name="description[]" value="<?php echo $param['description'];?>" class="text-box" /></td>
        <td>
          <a href="Javascript:" onclick="$(this).parent().parent().remove();">Delete</a>
        </td>
      </tr>
    <?php } ?>
  </table>
  <br/>
  <hr/>
  <div class="center-block">
    <a href="<?php echo getComponentUrl('admin', 'manage');?>" class="btn btn-default">Cancel</a>
    <input class="btn btn-primary" type="submit" value="Submit">
  </div>
</form>
<!--   clone for the above add parameter -->
<table class="hidden add-parameter-clone">
<tr>
    <td><input name="parameter[]" required="" value="" class="text-box" /></td>
    <td><input name="name[]" required="" value="" class="text-box" /></td>
    <td>
      <select name="required[]" class="text-box">
        <option value="false">Optional</option>
        <option value="true">Mandatory</option>
      </select>
    </td>
    <td><input name="default[]" value="" class="text-box" /></td>
    <td><input name="description[]" value="" class="text-box" /></td>
    <td>
      <a href="Javascript:" onclick="$(this).parent().parent().remove();">Delete</a>
    </td>
  </tr>
</table>