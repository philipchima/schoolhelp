<?php 

class Allsettings extends Dbh{

    public function allsetting($tablename, $orderfield, $order){
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

public function allsettingedit($tablename, $fieldname, $fieldvalue){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}
//appyling greater than sign in one of one the two fields being checked
public function allsettingeditg($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue and {$fieldname1}>:fieldvalue1";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

//appyling lesser than sign in one of one the two fields being checked
public function allsettingeditl($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue OR {$fieldname1}<:fieldvalue1";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }
}

//appyling lesser than sign in one of one the three fields being checked
public function allsettingeditg3($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue AND  {$fieldname1}= :fieldvalue1 AND {$fieldname2}>:fieldvalue2";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1 , ':fieldvalue2'=>$fieldvalue2]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

//appyling lesser than sign in one of one the three fields being checked
public function allsettingeditg3limit($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $limit){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue AND  {$fieldname1}= :fieldvalue1 AND {$fieldname2}>:fieldvalue2 LIMIT $limit";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1 , ':fieldvalue2'=>$fieldvalue2]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}


//appyling lesser than sign in one of one the three fields being checked
public function allsettingeditl3($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue AND  {$fieldname1}= :fieldvalue1 OR {$fieldname2}<:fieldvalue2";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1,  ':fieldvalue2'=>$fieldvalue2]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}


}

class classDepartment extends Dbh{

public function department($order){
	$mysqli = $this->connect();
    $sql="SELECT * FROM department order by did {$order}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()){
     	while($row=$stmt->fetch()){
     		$data[]=$row;
     	}
     	return $data;
    }

}

public function departmentedit($fieldname, $fieldvalue){

	$mysqli = $this->connect();
    $sql="SELECT * FROM department WHERE {$fieldname}=?";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([$fieldvalue]);

  if($stmt->rowCount()){
     	$row=$stmt->fetch();
     	return array('deptname'=>$row['deptname'], 'years'=>$row['years'], 'grades'=>$row['grades'], 'assnum'=>$row['assnum'], 'signnum'=>$row['signnum'], 'subjnum'=>$row['subjnum'], 'optionnum'=>$row['optionnum'], 'description'=>$row['description'],  'adminid'=>$row['adminid'], 'sdate'=>$row['sdate'], 'xdate'=>$row['xdate']);
    }
}

}// End of class department


class classInstitution extends Dbh{


public function institution(){
	$mysqli = $this->connect();
    $sql="SELECT * FROM institution order by i_id desc";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()){
     	while($row=$stmt->fetch()){
     		$data[]=$row;
     	}
     	return $data;
    }

}

public function institutionedit($fieldname, $fieldvalue){

	$mysqli = $this->connect();
    $sql="SELECT * FROM institution WHERE {$fieldname}=?";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([$fieldvalue]);

  if($stmt->rowCount()){
     	$row=$stmt->fetch();
     	return array('departmentid'=>$row['departmentid'], 'instiname'=>$row['instiname'], 'instislogan'=>$row['instislogan'],  'instiphone'=>$row['instiphone'], 'instiaddress'=>$row['instiaddress'], 'instiemail'=>$row['instiemail'], 'instiprefix'=>$row['instiprefix'], 'instilogo'=>$row['instilogo'], 'operatorid'=>$row['operatorid'], 'sdate'=>$row['sdate'], 'xdate'=>$row['xdate']);
    }
}

}// End of class institution


class classSemester extends Dbh{

public function semester($order){
	$mysqli = $this->connect();
    $sql="SELECT * FROM semesters order by semesterid {$order}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()){
     	while($row=$stmt->fetch()){
     		$data[]=$row;
     	}
     	return $data;
    }

}

public function semesteredit($fieldname, $fieldvalue){

	$mysqli = $this->connect();
    $sql="SELECT * FROM semesters WHERE {$fieldname}=?";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([$fieldvalue]);

  if($stmt->rowCount()){
     	$row=$stmt->fetch();
     	return array('semestername'=>$row['semestername'], 'semesterdescription'=>$row['semesterdescription']);
    }
}
}// End of class department


Class Adminperson extends Dbh{
//Selecting from adminperson table

public function adminpersons($fieldname, $fieldvalue){

	$mysqli = $this->connect();
    $sql="SELECT * FROM adminpersons WHERE {$fieldname}=?";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([$fieldvalue]);

  if($stmt->rowCount()){
     	$row=$stmt->fetch();
     	return array('staffid'=>$row['staffid'], 'surname'=>$row['surname'],  'othername'=>$row['othername'], 'username'=>$row['password'], 'email'=>$row['email'], 'operatorid'=>$row['operatorid'], 'sdate'=>$row['sdate'], 'sdate'=>$row['xdate']);
    }
}


}// End of class department


class classTitle extends Dbh{


public function title(){
	$mysqli = $this->connect();
    $sql="SELECT * FROM title order by titleid desc";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()){
     	while($row=$stmt->fetch()){
     		$data[]=$row;
     	}
     	return $data;
    }

}

public function titleedit($fieldname, $fieldvalue){

	$mysqli = $this->connect();
    $sql="SELECT * FROM title WHERE {$fieldname}=?";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([$fieldvalue]);

  if($stmt->rowCount()){
     	$row=$stmt->fetch();
     	return array('titlename'=>$row['titlename'], 'operatorid'=>$row['operatorid'], 'sdate'=>$row['sdate'], 'xdate'=>$row['xdate']);
    }
}


}// End of class title


class classQualification extends Dbh{


public function qualification(){
    $mysqli = $this->connect();
    $sql="SELECT * FROM qualification order by qualificationid desc";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()){
        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

public function qualificationedit($fieldname, $fieldvalue){

    $mysqli = $this->connect();
    $sql="SELECT * FROM qualification WHERE {$fieldname}=?";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([$fieldvalue]);

  if($stmt->rowCount()){
        $row=$stmt->fetch();
        return array('qualificationname'=>$row['qualificationname'], 'operatorid'=>$row['operatorid'], 'udate'=>$row['udate'], 'odate'=>$row['odate']);
    }
}


}// End of class title


class classLevel extends Dbh{

public function level($order){
	$mysqli = $this->connect();
    $sql="SELECT * FROM level order by levelid {$order}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()){
     	while($row=$stmt->fetch()){
     		$data[]=$row;
     	}
     	return $data;
    }

}

public function leveledit($fieldname, $fieldvalue){

	$mysqli = $this->connect();
    $sql="SELECT * FROM level WHERE {$fieldname}=?";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([$fieldvalue]);

  if($stmt->rowCount()){
     	$row=$stmt->fetch();
     	return array('levelname'=>$row['levelname'], 'levelrank'=>$row['levelrank'], 'departmentid'=>$row['departmentid'], 'levelnumoption'=>$row['levelnumoption'], 'operatorid'=>$row['operatorid'], 'sdate'=>$row['sdate'], 'xdate'=>$row['xdate']);
    }
}


}// End of class title

class classOption extends Dbh{

public function option($order){
	$mysqli = $this->connect();
    $sql="SELECT * FROM optiontable order by levelid {$order}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()){
     	while($row=$stmt->fetch()){
     		$data[]=$row;
     	}
     	return $data;
    }

}

public function optionedit($fieldname, $fieldvalue){

	$mysqli = $this->connect();
    $sql="SELECT * FROM optiontable WHERE {$fieldname}=?";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([$fieldvalue]);

  if($stmt->rowCount()){
     	$row=$stmt->fetch();
     	return array('optname'=>$row['optname'], 'optdescription'=>$row['optdescription'], 'optcourses'=>$row['optcourses'], 'departmentid'=>$row['departmentid'], 'levelid'=>$row['levelid'], 'optpriority'=>$row['optpriority'], 'operatorid'=>$row['operatorid'], 'sdate'=>$row['sdate'], 'xdate'=>$row['xdate']);
    }
}


}// End of class title

class classCourse extends Dbh{

public function course($order){
	$mysqli = $this->connect();
    $sql="SELECT * FROM course order by csid {$order}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()){
     	while($row=$stmt->fetch()){
     		$data[]=$row;
     	}
     	return $data;
    }

}

public function courseedit($fieldname, $fieldvalue){

	$mysqli = $this->connect();
    $sql="SELECT * FROM course WHERE {$fieldname}=?";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([$fieldvalue]);

  if($stmt->rowCount()){
     	$row=$stmt->fetch();
     	return array('csname'=>$row['csname'], 'csdescription'=>$row['csdescription'], 'cscreditunit'=>$row['cscreditunit'], 'cspassmark'=>$row['cspassmark'], 'levelid'=>$row['levelid'], 'departmentid'=>$row['departmentid'], 'optionid'=>$row['optionid'], 'semesterid'=>$row['semesterid'], 'operatorid'=>$row['operatorid'], 'udate'=>$row['udate'], 'odate'=>$row['odate']);
    }
}


}// End of class title

class classGrade extends Dbh{

public function grade($order){
	$mysqli = $this->connect();
    $sql="SELECT * FROM grade order by gradeid {$order}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()){
     	while($row=$stmt->fetch()){
     		$data[]=$row;
     	}
     	return $data;
    }

}

public function gradeedit($fieldname, $fieldvalue){

	$mysqli = $this->connect();
    $sql="SELECT * FROM grade WHERE {$fieldname}=?";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([$fieldvalue]);

  if($stmt->rowCount()){
     	$row=$stmt->fetch();
     	return array('gradeid'=>$row['gradeid'], 'departmentid'=>$row['departmentid'], 'low'=>$row['low'], 'high'=>$row['high'], 'gradeletter'=>$row['gradeletter'], 'gradepoint'=>$row['gradepoint'], 'cgpalow'=>$row['cgpalow'], 'cgpahigh'=>$row['cgpahigh'], 'remark'=>$row['remark'], 'operatorid'=>$row['operatorid'], 'udate'=>$row['udate'], 'odate'=>$row['odate']);
    }
}


}// End of class title

class classAssessment extends Dbh{

public function assessment($order){
	$mysqli = $this->connect();
    $sql="SELECT * FROM assessment order by assid {$order}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()){
     	while($row=$stmt->fetch()){
     		$data[]=$row;
     	}
     	return $data;
    }

}

public function assessmentedit($fieldname, $fieldvalue){

	$mysqli = $this->connect();
    $sql="SELECT * FROM assessment WHERE {$fieldname}=?";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([$fieldvalue]);

  if($stmt->rowCount()){
     	$row=$stmt->fetch();
     	return array('assid'=>$row['assid'], 'departmentid'=>$row['departmentid'], 'assname'=>$row['assname'], 'asspercent'=>$row['asspercent'], 'assdescription'=>$row['assdescription'],  'operatorid'=>$row['operatorid'], 'udate'=>$row['udate'], 'odate'=>$row['odate']);
    }
}


}// End of class title

class classPassmark extends Dbh{

public function passmark($order){
    $mysqli = $this->connect();
    $sql="SELECT * FROM passmark order by passmarkid {$order}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()){
        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

public function passmarkedit($fieldname, $fieldvalue){

    $mysqli = $this->connect();
    $sql="SELECT * FROM passmark WHERE {$fieldname}=?";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([$fieldvalue]);

  if($stmt->rowCount()){
        $row=$stmt->fetch();
        return array('passmarkid'=>$row['passmarkid'], 'passmark'=>$row['passmark'], 'levelid'=>$row['levelid'],  'operatorid'=>$row['operatorid'], 'udate'=>$row['udate'], 'odate'=>$row['odate']);
    }
}


}// End of class title

class classSession extends Dbh{

public function session($order){
	$mysqli = $this->connect();
    $sql="SELECT * FROM session order by sessionid {$order}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()){
     	while($row=$stmt->fetch()){
     		$data[]=$row;
     	}
     	return $data;
    }

}

public function sessionedit($fieldname, $fieldvalue){

	$mysqli = $this->connect();
    $sql="SELECT * FROM session WHERE {$fieldname}=?";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([$fieldvalue]);

  if($stmt->rowCount()){
     	$row=$stmt->fetch();
     	return array('sessionid'=>$row['sessionid'], 'sessionlow'=>$row['sessionlow'], 'sessionhigh'=>$row['sessionhigh'], 'description'=>$row['description'],  'operatorid'=>$row['operatorid'], 'udate'=>$row['udate'], 'odate'=>$row['odate']);
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
    $sql="SELECT * FROM {$tablename} WHERE {$fieldname}=:fieldvalue AND {$fieldname1}=:fieldvalue1";

    $stmt = $mysqli->prepare($sql);
    //$stmt->execute([$fieldvalue, $fieldvalue1]);
     $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1]);
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

