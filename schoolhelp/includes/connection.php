<?php 

//Data Base Connection Class
Class Dbh{
	private $servername;
	private $username;
	Private $dbname;
	Private $password;
	
	private $charset;

	public function connect(){
	
	$this->servername="localhost";
	$this->username="root";
	$this->password="swiftotech";
	$this->dbname="schoolmain2";
	$this->charset="utf8mb4";

	//$this->servername="localhost";
	//$this->username="elevados_elevado";
	//$this->password="schoolhelp";
	//$this->dbname="elevados_schoolhelpdb";
	//$this->charset="utf8mb4";

	// this block helps us to check for error
	try{

		//data source Name
		$dsn="mysql:host=".$this->servername.";dbname=".$this->dbname.";charset=".$this->charset;
		$pdo=new PDO($dsn,$this->username,$this->password);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $pdo;

	}catch(PDOException $e){
		echo "connection Unsuccessfull:".$e->getMessage();
	}
	}

}
?>