<?php require_once 'dbconnect.php';

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}
	
	public function register($uname,$sname,$email,$upass,$code)
	{
		try
		{							
			$password = md5($upass);
			$stmt = $this->conn->prepare("INSERT INTO users(userName,userSurname,userEmail,userPassword,tokenCode) 
			                                             VALUES(:user_name, :user_surname, :user_mail, :user_pass, :active_code)");
			$stmt->bindparam(":user_name",$uname);
			$stmt->bindparam(":user_surname",$sname);
			$stmt->bindparam(":user_mail",$email);
			$stmt->bindparam(":user_pass",$password);
			$stmt->bindparam(":active_code",$code);
			$stmt->execute();	
			return $stmt;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function login($email,$upass)
	

	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM users WHERE userEmail=:email_id");
			$stmt->execute(array(":email_id"=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{
				if($userRow['userStatus']=="Y")
				{
					if($userRow['userPassword']==md5($upass))
					{
						$_SESSION['userSession'] = $userRow['userID'];
						return true;
					}
					else
					
					{
					
					header("Location: login.php?error");
					
						exit;
					}
				}
				else
				{
					header("Location: login.php?inactive");
					exit;
				}	
			}
			else
			{
				header("Location: login.php?error");	
				exit;
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
		
	
		
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}
	
	function send_mail($email,$message,$subject)
	{						
		require_once('mailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->CharSet = "UTF-8";
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 1;                     
		//$mail->SMTPAutoTLS = false;
		$mail->SMTPAuth   = true;                  
		//$mail->SMTPSecure = "ssl";                 
		$mail->Host       = "smtp.elasticemail.com";      
		$mail->Port       = 2525;             
		$mail->AddAddress($email);
		$mail->Username="teithebookstore@gmail.com";  
		$mail->Password="6d8333d4-288a-4b19-8245-e2ef4a4b14ad";            
		$mail->SetFrom("teithebookstore@gmail.com",'Η βιβλιοθήκη μου');
		$mail->AddReplyTo("teithebookstore@gmail.com","Η βιβλιοθήκη μου");
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
		
		
	}	
}
?>