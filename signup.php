<?php 
session_start();
include 'header.php';
include 'footer.php';
include 'menu.php';?>


<?php
require_once 'class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()!="")
{
	$reg_user->redirect('favorites.php');
}


if(isset($_POST['btn-signup']))
{
	$uname = trim($_POST['txtuname']);
	$sname = trim($_POST['txtsname']);
	$email = trim($_POST['txtemail']);
	$upass = trim($_POST['txtpass']);
	$code = md5(uniqid(rand()));
	
	$stmt = $reg_user->runQuery("SELECT * FROM users WHERE userEmail=:email_id");
	$stmt->execute(array(":email_id"=>$email));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($stmt->rowCount() > 0)
	{
		$msg = "
		      <div>
					<strong>Συγνώμη</strong>  αυτό το email έχει ήδη χρησιμοποιηθεί για εγγραφή παρακαλώ δοκιμάστε άλλο.
			  </div>
			  ";
	}
	else
	{
		if($reg_user->register($uname,$sname,$email,$upass,$code))
		{			
			$id = $reg_user->lasdID();		
			$key = base64_encode($id);
			$id = $key;
			
			$message = "					
						Γεια σου $uname,
						<br /><br />
						Καλως ήλθατε στην ιστοσελίδα μας<br/>
						Για να ολοκληρώσετε την εγγραφή σας παρακαλώ πιέστε τον παρακάτω σύνδεσμο<br/>
						<br /><br />
						<a href='http://localhost/verify.php?id=$id&code=$code'>Πατήστε εδώ για ενεργοποίηση</a>
						<br /><br />
						Thanks,";
						
			$subject = "Confirm Registration";
						
			$reg_user->send_mail($email,$message,$subject);	
			$msg = "
					<div>
						<strong>Επιτυχής αποστολή email</strong>  στο $email.
                    Παρακαλώ πιέστε τον σύνδεσμο ενεργοποίησης που παραλάβατε στην ηλεκτρονική σας διεύθυνση
			  		</div>
					";
		}
		else
		{
			echo "sorry , Query could no execute...";
		}		
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Εγγραφή Χρήστη</title>
   
  </head>
  <body id="login">
    <div class="container" align="center">
				<?php if(isset($msg)) echo $msg;  ?>
      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Εγγραφή χρήστη</h2><hr />
        <input type="text"  placeholder="Όνομα" name="txtuname" required /><br><br>
		<input type="text"  placeholder="Επώνυμο" name="txtsname" required /><br><br>
        <input type="email"  placeholder="Email" name="txtemail" required /><br><br>
        <input type="password"  minlength="8" maxlength="64" placeholder="κωδικός πρόσβασης" name="txtpass" required />
     	<hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-signup">Εγγραφή</button>
        <a href="login.php" type="submit" class="btn btn-large btn-primary">Σύνδεση</a>
		
		   
	   
      </form>

    </div> 
 
  </body>
</html>