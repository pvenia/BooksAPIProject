<?php
session_start();
include 'header.php';
include 'footer.php';
include 'menu.php';


require_once 'class.user.php';
$user_login = new USER();


if($user_login->is_logged_in())
{
	$user_login->redirect('favorites.php');
}


if(isset($_POST['btn-login']))
{
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtupass']);


	if($user_login->login($email,$upass))
	{
		$user_login->redirect('favorites.php');
	}


}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Σύνδεση χρήστη</title>

  </head>
  <body id="login">
    <div class="container">

		<?php
		if(isset($_GET['inactive']))
		{
			?>
            <div>
				<strong>Sorry!</strong> Αυτός ο λογαριασμός δεν έχει ενεργοποιηθεί παρακαλώ ελέγξτε την ηλεκτρονική σας διεύθυνση για ενεργοποίηση
			</div>
            <?php
		}
		?>
        <form class="form-signin" align="center" method="post">
        <?php

        if(isset($_GET['error']))
		{
			?>
            <div >
				
				<strong>Λάθος κωδικός πρόσβασης ή όνομα χρήστη!</strong>
			</div>

            <?php
		}
		?>

        <h2 class="form-signin-heading">Σύνδεση χρήστη</h2><hr />
        <input type="email" placeholder="Email address" name="txtemail" required />
        <input type="password" placeholder="Password" name="txtupass" required />
     	<hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-login">Σύνδεση</button>
       <a href="signup.php"  type="submit" class="btn btn-large btn-primary">Εγγραφή</a><hr />

<!--
        <a href="resetpass.php">Ξέχασες τον κωδικό σου; </a>
			--> 
      </form>

    </div>

  </body>
</html>
