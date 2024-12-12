<?php
 include_once 'config.php';
class Database
{
    public $conn;
     
    public function dbConnection()
	{
	    global $servername, $username, $password, $dbname;
	    $this->conn = null;    
        try
		{
            $this->conn = new PDO("mysql:host=" . $servername . ";dbname=" . $dbname, $username, $password);
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
