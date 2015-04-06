<header>
  <div class="container">
    <div class="row header-block">
      <div class="col-lg-12">
        <h1><a href="/"><?php echo getConfig('project_title');?></a></h1>
        <?php if(isLoggedInUser()) { ?>
        <hr/>
        <div class="nav-block">
          <ul role="tablist" class="nav nav-pills nav-justified">
            <li class="<?php echo ($page=="home")?"active":"";?>"><a href="<?php echo getComponenturl('admin', 'home');?>">Home</a></li>
            <li class="<?php echo ($page=="reference")?"active":"";?>"><a href="<?php echo getComponenturl('admin', 'reference');?>">API Reference</a></li>
            <li class="<?php echo ($page=="console")?"active":"";?>"><a href="<?php echo getComponenturl('admin', 'console');?>">Test Console</a></li>
            <li class="<?php echo ($page=="manage")?"active":"";?>"><a href="<?php echo getComponenturl('admin', 'manage');?>">API Management</a></li>
            <li class="<?php echo ($page=="developer")?"active":"";?>"><a href="<?php echo getComponenturl('admin', 'developer');?>">Developer</a></li>
            <li class="<?php echo ($page=="logout")?"active":"";?>"><a href="<?php echo getComponenturl('admin', 'logout');?>">Logout</a></li>
          </ul>
        </div>
        <?php } ?>
      </div>
    </div>
    <hr/>
  </div>
</header>