<?php 
class classWeb extends Dbh{

public function allweb($tablename, $orderfield, $order){
    $mysqli = $this->connect();
    $sql="SELECT * FROM {$tablename} order by {$orderfield} {$order}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()){
        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

public function allwebedit($tablename, $fieldname, $fieldvalue){
    $mysqli = $this->connect();

     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue";

    $stmt = $mysqli->prepare($sql);
     if($stmt->execute([ ':fieldvalue'=>$fieldvalue])){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}



}// End of class title






class Checkexcessvalue extends Dbh{
//Selecting all table array checking two fields
function alltblselection1($tablename, $fieldname, $fieldname1, $fieldvalue, $fieldvalue1){
	$a=new Dbh;
	$mysqli = $a->connect();
    $sql=("SELECT * FROM {$tablename} WHERE {$fieldname}!=:fieldvalue AND {$fieldname1}=:fieldvalue1");

    $stmt = $mysqli->prepare($sql);

    if( $stmt->execute([':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1])){
     	while($row=$stmt->fetch()){
     		$data[]=$row;
     	}
     	return $data;
    }

}
}

//JQuery functions starts from here
//checking for all the tables
function allTables($tablename, $fieldname, $fieldvalue){
	$a=new Dbh;
	$mysqli = $a->connect();
    $sql="SELECT * FROM {$tablename} WHERE {$fieldname}=?";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([$fieldvalue]);

    if($row=$stmt->rowCount()){
    	
     	return $row;
    }else{
    	return 0;
    }
$stmt->close;
}

//Checking Two different fields
function allTBL2fields($tablename, $fieldname, $fieldname1, $fieldvalue, $fieldvalue1){
	$a=new Dbh;
	$mysqli = $a->connect();
    $sql="SELECT * FROM {$tablename} WHERE {$fieldname}=? AND {$fieldname1}=?";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([$fieldvalue, $fieldvalue1]);

    if($row=$stmt->rowCount()){
     	return $row;
    }else{
    	return 0;
    }
$stmt->close;
}

function allTablesrowcount($tablename){
	$a=new Dbh;
	$mysqli = $a->connect();
    $sql="SELECT * FROM {$tablename}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()){
     	$row=$stmt->rowCount();
     	return $row;
    }else{
    	return 0;
    }

}

//checking for all the tables
function allTables1($tablename, $fieldname, $fieldvalue, $fieldrequested){
	$a=new Dbh;
	$mysqli = $a->connect();
    $sql="SELECT * FROM {$tablename} WHERE {$fieldname}=?";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([$fieldvalue]);

    if($stmt->rowCount()){
     	$rows=$stmt->rowCount();
     	$rowdata=$stmt->fetch();
     	return array('numrow'=>$rows, 'fieldrequested'=>$rowdata[$fieldrequested]);
    }else{
    	return array('numrow'=>0, 'fieldrequested'=>$rowdata[$fieldrequested]);
    }

}

//Selecting all table array
function alltblselection($tablename, $fieldname, $fieldvalue){
	$a=new Dbh;
	$mysqli = $a->connect();
    $sql=("SELECT * FROM {$tablename} WHERE {$fieldname}=:fieldvalue");

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([':fieldvalue'=>$fieldvalue]);

    if($stmt->rowCount()){
     	while($row=$stmt->fetch()){
     		$data[]=$row;
     	}
     	return $data;
    }

}


?>

