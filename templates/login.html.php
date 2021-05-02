<?php
if (isset($error)):
    echo '<div class="errors">' . $error . '</div>';
endif;
?>

<div class="form-box contain d-flex justify-content-center mt-5 mb-5">
  <div class="row col-lg-6 rounded border border-2 p-3">
    <form action="" method="post">
      <label for="email" class="form-label">Email: </label>
      <input type="text" name="email" id="email" class="form-control mt-2 mb-2">

      <label for="password" class="form-label">Password: </label>
      <input type="password" name="password" id="password" class="form-control mt-2 mb-2">

      <input type="submit" name="submit" value="Log In" class="btn btn-sm bg-darker  mt-2 mb-2">
    </form>

    <p>No Account? <a href="/user/register">Sing-in</a> now!</p>
  </div>
</div>