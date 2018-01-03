<?php
session_start();
include('booksdb.php');

if(isset($_POST['func']) & isset($_SESSION['userSession']) ) {
  $userid = $_SESSION['userSession'];
  if($_POST['func']=="add_favorite") {
    $book_data = $_POST['data'];
    add_favorite($book_data,$userid);
  }elseif ($_POST['func']=="check_favorites") {
    $bookid = $_POST['data'];
    check_favorites($userid, $bookid);
  }
}

function add_favorite($book_data, $user_id) {

  $book_id = $book_data['id'];
  $books = new Books();
  $registered = $books->search_favorites($book_id, $user_id);
  if(!$registered) {
    $book_exists = $books->search_book($book_id);
    if(!$book_exists)
        $books->insert_book($book_data);
		echo "Το βιβλίο προστέθηκε στην βιβλιοθήκη σας!";
    if(!$books->insert_favorite($book_id, $user_id))
      echo "Το βιβλίο δεν μπόρεσε να προστεθεί στην βιβλιοθήκη σας";

  }else {
   echo "Το βιβλίο υπάρχει ήδη στην βιβλιοθήκη σας!";
   
 }
}

 ?>
