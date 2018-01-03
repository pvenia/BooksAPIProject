<?php
require_once 'class.user.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
	$user->redirect('index.php');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
	$id = base64_decode($_GET['id']);
	$code = $_GET['code'];
	
	$statusY = "Y";
	$statusN = "N";
	
	$stmt = $user->runQuery("SELECT userID,userStatus FROM users WHERE userID=:uID AND tokenCode=:code LIMIT 1");
	$stmt->execute(array(":uID"=>$id,":code"=>$code));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	if($stmt->rowCount() > 0)
	{
		if($row['userStatus']==$statusN)
		{
			$stmt = $user->runQuery("UPDATE users SET userStatus=:status WHERE userID=:uID");
			$stmt->bindparam(":status",$statusY);
			$stmt->bindparam(":uID",$id);
			$stmt->execute();	
			
			$msg = "
		           <div>
				   <button class='close' data-dismiss='alert'>&times;</button>
					  <strong>Συγχαρητήρια!</strong>  Ο λογαριασμός σας έχει ενεργοποιηθεί : <a href='login.php'>Συνδεθείτε εδώ</a>
			       </div>
			       ";	
		}
		else
		{
			$msg = "
		           <div>
					  <strong>sorry !</strong>  Ο λογαριασμός σας είναι ήδη ενεργός : <a href='login.php'>Συνδεθείτε εδώ</a>
			       </div>
			       ";
		}
	}
	else
	{
		$msg = "
		       <div>
			   <strong>sorry !</strong>  Δεν βρέθηκε ενεργός λογαριασμός : <a href='signup.php'>Εγγραφείτε εδώ</a>
			   </div>
			   ";
	}	
}

?>
<!DOCTYPE html>
<html>
  <head>
   <meta charset="utf-8">
    <title>Επιβεβαίωση Εγγραφής</title>
   
  </head>
  <body id="login">
    <div class="container">
		<?php if(isset($msg)) { echo $msg; } ?>
    </div> 
   
  </body>
</html>