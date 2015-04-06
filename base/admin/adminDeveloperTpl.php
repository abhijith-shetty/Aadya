<div class="container">
  <div class="row content-block">
    <div class="col-md-2 block">
      <h4>Actions</h4>
      <table class="table">
        <tr><td><a href="<?php echo getComponentUrl('admin', 'developer', array('action'=>'createRESTAPI'))?>">Create REST API</a></td></tr>
        <tr><td><a href="<?php echo getComponentUrl('admin', 'developer', array('action'=>'createModule'))?>">Create UI Module</a></td></tr>
        <tr><td><a href="<?php echo getComponentUrl('admin', 'developer', array('action'=>'createLibrary'))?>">Create Library</a></td></tr>
        <tr><td><a href="<?php echo getComponentUrl('admin', 'developer', array('action'=>'configEditor'))?>">Config Editor</a></td></tr>
      </table>
    </div>
    <div class="col-md-10">
      <div class="row">
        <div class="col-md-8">
          <?php echo page::renderComponent('admin', 'adminCreateComponent'); ?>
          <?php echo page::renderComponent('admin', 'adminCreateLibrary'); ?>
          <?php echo page::renderComponent('admin', 'adminCreateRESTAPI'); ?>
          <?php echo page::renderComponent('admin', 'adminConfigEditor'); ?>
        </div>
      </div>
    </div>
  </div>
</div>