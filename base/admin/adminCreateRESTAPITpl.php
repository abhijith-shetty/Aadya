<?php if($_GET['action'] == "createRESTAPI") { ?>
  <h4>Create New REST API:</h4><hr/><br/>
  <?php if($result['error']) { ?>
    <div class="alert alert-danger"><?php echo $result['message'];?></div>
  <?php } ?>
  <?php if($result['success']) { ?>
    <div class="alert alert-success"><?php echo $result['message'];?></div>
  <?php } ?>
  <form class="form-horizontal" method="POST" action="">
    <div class="form-group">
      <label class="col-sm-3 control-label">API Name:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" placeholder="api.name" name="apiName" value="<?php echo isset($_POST['apiName'])?$_POST['apiName']:"";?>" />
      </div>
    </div>
    <br/><hr/>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <a class="btn btn-default" href="<?php echo getComponentUrl('admin', 'developer')?>">Cancel</a>
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
    </div>
  </form>
<?php } ?>