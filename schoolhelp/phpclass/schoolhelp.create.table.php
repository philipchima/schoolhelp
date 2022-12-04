<?php
// This Class was originally created by schoolhelp, Chima Eberechi Philip
include_once("../includes/connection.php");
class creationTable extends Dbh{

	public function scoreTable($tablename){
		$mysqli = $this->connect();
		$sql = "CREATE TABLE {$tablename} (
		    scoreid INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    stid INT(50) NOT NULL,
		    levelid INT(50) NOT NULL,
		    optionid INT(50) NOT NULL,
		    courseid INT(50) NOT NULL,
		    assessmentid INT(50) NOT NULL,
		    semesterid INT(50) NOT NULL,
		    sessionid INT(50) NOT NULL,
		    score VARCHAR(3),
		    status INT(50) NOT NULL,

		   	instructorid INT(50) NOT NULL,
		   	instructorudate DATETIME,

		    operatorid INT(50) NOT NULL,
		    udate DATETIME,
		    odate DATE
		    )";
		 $stmt = $mysqli->prepare($sql);
    		$stmt->execute();
	}

	public function resultTable($tablename){
		$mysqli = $this->connect();
		$sql = "CREATE TABLE {$tablename} (
		    resultid INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    stid INT(50) NOT NULL,
		    levelid INT(50) NOT NULL,
		    optionid INT(50) NOT NULL,
		    courseid INT(50) NOT NULL,
		    
		    semesterid INT(50) NOT NULL,
		    sessionid INT(50) NOT NULL,
		    score VARCHAR(6) NOT NULL,
		    cumulative VARCHAR(6) NOT NULL,
		    position VARCHAR(11) NOT NULL,
		    status INT(50) NOT NULL,

		   
		   	instructorid INT(50) NOT NULL,
		   	instructorudate DATETIME,

		    operatorid INT(50) NOT NULL,
		    udate DATETIME,
		    odate DATE
		    )";
		 $stmt = $mysqli->prepare($sql);
    		$stmt->execute();
	}

	public function positionTable($tablename){
		$mysqli = $this->connect();
		$sql = "CREATE TABLE {$tablename} (
		    positionid INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    stid INT(50) NOT NULL,
		    levelid INT(50) NOT NULL,
		    optionid INT(50) NOT NULL,
		    
		    semesterid INT(50) NOT NULL,
		    sessionid INT(50) NOT NULL,
		    score VARCHAR(6) NOT NULL,
		    cumulative VARCHAR(50) NOT NULL,
		    overall VARCHAR(50) NOT NULL,
		    average VARCHAR(6) NOT NULL,
		    accaverage VARCHAR(6) NOT NULL,
		    position VARCHAR(11) NOT NULL,
		    numcourses VARCHAR(11) NOT NULL,
		    hodcommentid INT(50) NOT NULL,
		    dircommentid INT(50) NOT NULL,
		    comment VARCHAR(200) NOT NULL,
		    status INT(50) NOT NULL,
		   
		   
		   	instructorid INT(50) NOT NULL,
		   	instructorudate DATETIME,

		    operatorid INT(50) NOT NULL,
		    udate DATETIME,
		    odate DATE
		    )";
		 $stmt = $mysqli->prepare($sql);
    		$stmt->execute();
	}

	public function attendanceTable($tablename){
		$mysqli = $this->connect();
		$sql = "CREATE TABLE {$tablename} (
		    attendanceid INT(50) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    stid INT(50) NOT NULL,
		    levelid INT(50) NOT NULL,
		    optionid INT(50) NOT NULL,
		    
		    semesterid INT(50) NOT NULL,
		    sessionid INT(50) NOT NULL,
		    attendancedate DATE,
		    status INT(50) NOT NULL,
		   
		   	instructorid INT(50) NOT NULL,
		   	instructorudate DATETIME,

		    operatorid INT(50) NOT NULL,
		    udate DATETIME,
		    odate DATE
		    )";
		 $stmt = $mysqli->prepare($sql);
    		$stmt->execute();
	}

}
?>