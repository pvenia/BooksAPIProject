<?php session_start();
ini_set('session.gc-maxlifetime', 60*5);
include 'header.php';
include 'footer.php';
include 'menu.php';

require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('login.php');
}

$stmt = $user_home->runQuery("SELECT * FROM users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>



<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title><?php echo $row['userEmail']; ?></title>
        
    </head>
    
    <body
                    <a href="#">Member Home</a>
                    <div>
                        <ul>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> 
								<?php echo $row['userEmail']; ?> <i class="caret"></i><br>
								
								<?php echo "Καλώς ήρθες " .$row['userName']. " " .$row['userSurname'] ?> <i class="caret"></i>
								
                                </a>
                                <ul>
                                    <li>
                                        <a tabindex="-1" href="logout.php">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li class="active">
                                <a href="#">page1</a>
								<a href="#">page2</a>
                            </li>
							
                         
                            
                        </ul>
                    </div>
                   
                </div>
            </div>
        </div>
   
        
    </body>

</html>