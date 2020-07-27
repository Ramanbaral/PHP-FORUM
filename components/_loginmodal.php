<?php

print '
<!-- ##################################### MODAL ###################################################### -->
<div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="loginmodal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">LOGIN </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
<form action="/php_forum/login.php" method="POST">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>

      <button type="submit" class="btn btn-primary">Login</button>
      <span style="display:block;" class="mt-2 ">Don"t Have An Account? <a href="/php_forum/signup.php">Sign Up</a></span>
</form>
      </div>
    </div>
  </div>
</div>
<!-- ##################################### MODAL ###################################################### -->
';

?>