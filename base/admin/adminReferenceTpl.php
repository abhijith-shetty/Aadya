<div class="container">
<div class="row content-block">
  <div class="col-lg-12">
    <h4> API List: </h4>
    <table class="table table-bordered">
      <thead>
        <tr><th>API Name(api_method)</th><th width="25%">Input Parameter</th><th>Description</th></tr>
      </thead>
      <tbody>
        <?php foreach($apiList as $key => $item) { ?>
          <tr>
            <td><a href="<?php echo getComponentUrl('admin','console', array("methodName"=>$key));?>"><?php echo $key;?></a></td>
            <td><?php echo $item['inputParam'];?></td>
            <td><?php echo $item['desc'];?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <h4> Response Code List: </h4>
    <table class="table table-bordered">
      <thead>
        <tr><th>Response</th><th width="25%">Code</th><th>Description</th></tr>
      </thead>
      <tbody>
        <?php foreach($responseList as $key=>$item) { ?>
          <tr>
            <td><?php echo $key;?></a></td>
            <td><?php echo $item['code'];?></td>
            <td><?php echo $item['message'];?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <h4>Constant List:</h4>
    <table class="table table-bordered">
      <thead>
        <tr><th>Constant</th><th width="25%">Value</th></tr>
      </thead>
      <tbody>
        <?php foreach($constantList as $key=>$value) { ?>
          <tr>
            <td><?php echo $key;?></a></td>
            <td><?php echo $value;?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

  </div>
  </div>
</div>
</div>