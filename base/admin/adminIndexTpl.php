<div class="container">
  <div class="row content-block login-form">
    <div class="col-lg-12">
      <form class="form-signin" action="<?php echo getComponentUrl('admin', 'index');?>" method="POST">
        <h2 class="form-signin-heading">Administrator Login</h2>
        <?php if($result['error']) { ?>
          <div class="alert alert-danger"><?php echo $result['message'];?></div>
        <?php } ?>
        <label class="sr-only">Username:</label>
        <input name="username" type="text" required="" placeholder="username" class="form-control">
        <label class="sr-only">Password</label>
        <input name="password" type="password" required="" placeholder="Password" class="form-control">
        <!--<div class="checkbox">
          <label><input type="checkbox" name="rememberMe"> Remember me</label>
        </div> -->
        <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
      </form>
    </div>
  </div>
</div>