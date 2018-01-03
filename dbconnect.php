<?php
require_once 'config.php';
require_once  "$_SERVER[DOCUMENT_ROOT]/myergasia6/log/log.php";

class Database
{

  private static $host = DB_HOST;
  private static $db_name   = DB_NAME;
  private static $username = DB_USER;
  private static $password = DB_PASSWORD;

    public function dbConnection()
	{
	    $this->conn = null;
        try
		{
      $this->conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db_name, self::$username, self::$password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
