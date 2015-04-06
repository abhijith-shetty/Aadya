<?php if($_GET['action'] == "configEditor") { ?>
  <h4>Manage configuration:</h4><hr/><br/>
  <?php if($result['error']) { ?>
    <div class="alert alert-danger"><?php echo $result['message'];?></div>
  <?php } ?>
  <?php if($result['success']) { ?>
    <div class="alert alert-success"><?php echo $result['message'];?></div>
  <?php } ?>
  <form class="form-horizontal" method="POST" action="">
    <?php foreach($data as $key => $value) { ?>
      <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo $key;?>:</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="<?php echo $key;?>" value="<?php echo $value;?>" />
        </div>
      </div>
    <?php } ?>
    <br/><hr/>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <a class="btn btn-default" href="<?php echo getComponentUrl('admin', 'developer')?>">Cancel</a>
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
    </div>
  </form>
<?php } ?>