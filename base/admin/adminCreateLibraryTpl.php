<?php if($_GET['action'] == "createLibrary") { ?>
  <h4>Create New Library:</h4><hr/><br/>
  <?php if($result['error']) { ?>
    <div class="alert alert-danger"><?php echo $result['message'];?></div>
  <?php } ?>
  <?php if($result['success']) { ?>
    <div class="alert alert-success"><?php echo $result['message'];?></div>
  <?php } ?>
  <form class="form-horizontal" method="POST" action="">
    <div class="form-group">
      <label class="col-sm-3 control-label">Library Directory:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" placeholder="libraryDirectory" name="libraryDirectory" value="<?php echo isset($_POST['libraryDirectory'])?$_POST['libraryDirectory']:"queryLib";?>" />
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label">Library Name:</label>
      <div class="col-sm-8">
        <input type="text" class="form-control" placeholder="libraryName" name="libraryName" value="<?php echo isset($_POST['libraryName'])?$_POST['libraryName']:"";?>" />
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