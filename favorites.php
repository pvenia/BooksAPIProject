<?php
include 'header.php';
include 'menu.php';
include 'footer.php';
session_start();
require_once 'class.user.php';
require_once 'booksdb.php';
require_once 'pagination.php';
require_once 'config.php';

$user_home = new USER();
$pagination = '';


if(!$user_home->is_logged_in())
{
	$user_home->redirect('login.php');
}

$stmt = $user_home->runQuery("SELECT * FROM users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$books = new Books();
$favorites = $books->return_favorites($_SESSION['userSession']);
$fav_count = count($favorites);
?>

<!DOCTYPE html>
<html class="no-js">

    <head>
        <title><?php echo $row['userEmail']; ?></title>
  
    </head>

    <body>
                    <a href="#">Member Home</a>
                    <div>
                        <ul>
                            <li>
                                <a>
								<?php echo $row['userEmail']; ?> <br>

								<?php echo "Καλώς ήρθες " .$row['userName']. " " .$row['userSurname'] ?>
								<?php
								if(isset($_GET['page'])&&preg_match("/^([0-9]+)$/",$_GET['page']))
									$page = $_GET['page'];
								else $page = 0;
								$pagination = pagination($fav_count,$page,'favorites.php'); ?>
                                </a>
                                <ul>
                                    <li>
                                        <a tabindex="-1" href="logout.php">Αποσύνδεση</a>
									<!--...    <?php echo $pagination['pagination'] ?> -->
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul >
                            <li>
							
																<table>
																<?php
																$subfavorites = array_slice($favorites, $pagination['start'],(int)_LIMIT_);
																$tr='<tr><th>Title</th><th>Author</th><th>Publisher</th></tr>';
																	foreach($subfavorites as $favorite) {
																		$tr .= "<tr><td>".$favorite['title']."</td><td>"  .$favorite['author'].
																		 "</td><td>".$favorite['publisher']."</td><td><input type='hidden' name='url' value=".$favorite['url']."></td><tr>";
																	}
																	echo $tr;
																	echo $pagination['pagination'];
																?>
																</table>
																
                            </li>
                        </ul>
                    </div>
             
                </div>
            </div>
        </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="favorites.js"></script>


