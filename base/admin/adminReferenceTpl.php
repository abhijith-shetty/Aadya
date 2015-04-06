<div class="container">
<div class="row content-block">
  <div class="col-lg-12">
    <table class="table table-bordered">
      <thead>
        <tr><th>API Name(api_method)</th><th width="25%">Input Parameter</th><th>Description</th></tr>
      </thead>
      <tbody>
        <?php foreach($result as $key => $item) { ?>
          <tr>
            <td><a href="<?php echo getComponentUrl('admin','console', array("methodName"=>$key));?>"><?php echo $key;?></a></td>
            <td><?php echo $item['inputParam'];?></td>
            <td><?php echo $item['desc'];?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
</div>