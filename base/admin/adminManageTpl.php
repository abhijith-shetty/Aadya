<div class="container">
  <div class="row content-block">
    <div class="col-md-2 block">
      <h4>API List:</h4>
      <table class="table">
        <?php foreach($apiList as $item) { ?>
          <tr><td><a href="<?php echo getComponentUrl('admin', 'manage', array("methodName"=>$item));?>"><?php echo $item;?></a></td></tr>
        <?php } ?>
      </table>
    </div>
    <div class="col-md-10">
      <?php if($_GET['methodName'] != "") { ?>
        <?php echo page::renderComponent('admin', 'adminAddParameter'); ?>
      <?php } else { ?>
        <h4><br/></h4><hr/>
        <p>You can add, delete and modify parameters of a API via this section. Please select any API's from your left sidebar. </p>
      <?php } ?>
    </div>
  </div>
</div>