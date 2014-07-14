<?php if(isset($msg)) echo $msg; ?>
  <form class="form-signin" role="form" action="<?php echo base_url();?>index.php/login/process" method="post" name="process">
    <h2 class="form-signin-heading" align="center">Please sign in</h2>
    <input type="text" class="form-control" placeholder="UserName" name="username" size="25" required autofocus><br>
    <input type="password" class="form-control" placeholder="Password" name="password" size="25" required><br>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  </form>