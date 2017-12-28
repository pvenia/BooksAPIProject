<?php
require_once 'dbconnect.php';

class Books
{

	private $conn;
  public $registered=false;

	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

		public function search_favorites($book_id, $user_id) {

	    try{

	      $sql = "SELECT * FROM  favorites WHERE user_id=? AND book_id=?";
	      $stmt = $this->conn->prepare($sql);
	      $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
	      $stmt->bindParam(2, $book_id, PDO::PARAM_STR);
	      if($stmt->execute()) {
					  $res = $stmt->fetch(PDO::FETCH_ASSOC);
				    $this->registered = $res==false?false:true;
				}
	    }catch(PDOException $ex){
	      echo $ex->getMessage();
	    }
			return $this->registered;
	  }

		public function search_book($book_id) {

	    try{

	      $sql = "SELECT * FROM  books WHERE  book_id=?";
	      $stmt = $this->conn->prepare($sql);
	      $stmt->bindParam(1, $book_id, PDO::PARAM_STR);
	      if($stmt->execute()) {
					$res = $stmt->fetch(PDO::FETCH_ASSOC);
					return $res==false?false:true;
					}
				}catch(PDOException $ex){
	      echo $ex->getMessage();
	    }
	  }

		public function insert_favorite($book_id, $user_id) {

	    try{

	      $sql = "INSERT INTO favorites(user_id, book_id) VALUES(?,?)";
	      $stmt = $this->conn->prepare($sql);
	      $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
	      $stmt->bindParam(2, $book_id, PDO::PARAM_STR);
	      if($stmt->execute())
	          return TRUE;
	      else
	          return FALSE;
	    }catch(PDOException $ex){
	      echo $ex->getMessage();
	    }
	  }

  public function insert_book($book_data) {

    try{

      $sql = "INSERT INTO books(book_id, title, author, publisher) VALUES(?,?,?,?)";
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(1, $book_data['id'], PDO::PARAM_STR);
      $stmt->bindParam(2, $book_data['title'], PDO::PARAM_STR);
      $stmt->bindParam(3, $book_data['author'], PDO::PARAM_STR);
      $stmt->bindParam(4, $book_data['publisher'], PDO::PARAM_STR);
      //$stmt->bindParam(5, $book_data['year'], PDO::PARAM_STR);
      if($stmt->execute())
          return TRUE;
      else
          return FALSE;
    }catch(PDOException $ex){
      echo $ex->getMessage();
    }
  }
}
