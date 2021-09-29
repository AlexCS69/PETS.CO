<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PETS.CO - New Password</title>
</head>

<?php
include "header.php";
require_once "includes/controllerUserData.php";

$email = $_SESSION['email'];

if($email !== false)
{
  ?>
  <div class="container">
    <form class="col s12" action="new_pass.php" method="post">
      <h3 class="grey-text">Create New Password</h3>
      <!-- error message -->
      <?php 
      if(isset($_SESSION["info"]))
      {
        ?>
        <div class="card-panel light-blue lighten-4">
            <?php echo $_SESSION["info"]; ?>
        </div>
        <?php
      }
      ?>
      <?php
      if(count($errors) > 0)
      {
        ?>
        <div class="card-panel red lighten-2">
        <?php
          foreach($errors as $showerror)
          {
            echo $showerror;
          }
        ?>
        </div>
        <?php
      }
      ?>
      <!-- end of error message -->

      <div class="row">
        <div class="input-field col s6">
          <i class="material-icons prefix"> password</i>
          <input name="password" type="password" class="validate" minlength="8" maxlength="20">
          <label for="password">Create new password</label>
          <span class="helper-text" data-error="Min 8, Max 20 characters" data-success="correct">Min 8, Max 20 characters</span>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6">
          <i class="material-icons prefix"> password</i>
          <input name="cpassword" type="password" class="validate" maxlength="20">
          <label for="password">Confirm your password</label>
        </div>
      </div>

      <input class="btn btn-block" type="submit" name="change_pass" value="Change Password">
    </form>

    <div class="errormsg">
      <?php
        if (isset($_GET["error"]))
        {
          if($_GET["error"] == "emptyinput")
            echo "<p>*Fill in all fields!<p>";
        }
      ?>
    </div>
  </div>
</html>

<?php
}else
{
  header("location: login.php");
  exit();
}
?>