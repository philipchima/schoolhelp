<?php 
include_once("../includes/connection.php");
include_once("schoolhelp.create.table.php");
class insertTable extends Dbh{

public function insert_department($deptname, $years, $grades, $assnum, $signnum, $subjnum,  $description, $adminid, $sdate){

    $mysqli = $this->connect();

    $sql = "INSERT INTO department"
        . " (deptname, years, grades, assnum, signnum, subjnum, description, adminid, xdate)"
        . " VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([$deptname, $years, $grades, $assnum, $signnum, $subjnum,  $description, $adminid, $sdate])){
         //Getting the last inserted row
         $insertedrow=$mysqli->LastInsertId();
        //Calling class 
         $createtable=new creationTable;
         //creating table for score
         $tablename="score".$insertedrow;
         $createtable->scoreTable($tablename);
         //creating table for result
         $tablename1="result".$insertedrow;
         $createtable->resultTable($tablename1);
         //creating table for positionresult
         $tablename2="positionresult".$insertedrow;
         $createtable->positionTable($tablename2);

         //creating table for positionresult
         $tablename3="attendance".$insertedrow;
         $createtable->attendanceTable($tablename3);
       
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}


public function insert_institution($departmentid, $institutionname, $institutionslogan, $institutionphone, $institutionaddress, $institutionemail, $institutionregpre, $institutionlogo, $schoolhelp, $xdate){

    $mysqli = $this->connect();

    $sql = "INSERT INTO institution SET departmentid=:departmentid, instiname=:instiname, instislogan=:instislogan, instiphone=:instiphone, instiaddress=:instiaddress, instiemail=:instiemail, instiprefix=:instiprefix, instilogo=:instilogo, operatorid=:operatorid, xdate=:xdate";
        

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':departmentid'=>$departmentid, ':instiname'=>$institutionname, ':instislogan'=>$institutionslogan, ':instiphone'=>$institutionphone, ':instiaddress'=>$institutionaddress, ':instiemail'=>$institutionemail, ':instiprefix'=>$institutionregpre, ':instilogo'=>$institutionlogo, ':operatorid'=>$schoolhelp, ':xdate'=>$xdate])){
         //Getting the last inserted row
       $insertedrow=$mysqli->LastInsertId();
        $action= "Success";
    } else {
        $action ="failed: " . $mysqli->error;

    }
        return array('action'=>$action, 'insertedrow'=>$insertedrow);
}


public function insert_title($titlename, $operatorid, $xdate){

    $mysqli = $this->connect();

    $sql = "INSERT INTO title"
        . " (titlename, operatorid, xdate)"
        . " VALUES (?, ?, ?)";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([$titlename, $operatorid, $xdate])){
         //Getting the last inserted row
       $insertedrow=$mysqli->LastInsertId();
        $action= "Success";
    } else {
        $action ="failed: " . $mysqli->error;

    }
        return $action;
}


//Inserting data to semesters
public function insert_semester($semestername, $description, $operatorid, $sdate){

    $mysqli = $this->connect();

    $sql = "INSERT INTO semesters"
        . " (semestername, semesterdescription, operatorid,  xdate)"
        . " VALUES (?, ?, ?, ?)";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([$semestername, $description, $operatorid,  $sdate])){
        
       
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

//Inserting data to semesters
public function insert_passmark($levelid, $passmark, $operatorid, $odate){

    $mysqli = $this->connect();

    $sql = "INSERT INTO passmark"
        . " (levelid, passmark, operatorid, odate)"
        . " VALUES (?, ?, ?, ?)";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([$levelid, $passmark, $operatorid, $odate])){
        
       
         return array('action'=>'Success', 'counting'=>1);
    } else {
         
         return array('action'=>'Error', 'counting'=>0);
    }

}

public function insert_qualification($qualificationname, $operatorid, $odate){

    $mysqli = $this->connect();

    $sql = "INSERT INTO qualification"
        . " (qualificationname, operatorid, odate)"
        . " VALUES (?, ?, ?)";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([$qualificationname, $operatorid, $odate])){
         //Getting the last inserted row
       $insertedrow=$mysqli->LastInsertId();
        $action= "Success";
    } else {
        $action ="failed: " . $mysqli->error;

    }
        return $action;
}


//Inserting data to level table
public function insert_level($levelname, $levelrank, $departmentid, $levelnumoption, $operatorid, $xdate){

    $mysqli = $this->connect();

    $sql = "INSERT INTO level"
        . " (levelname, levelrank, departmentid, levelnumoption, operatorid,  xdate)"
        . " VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([$levelname, $levelrank, $departmentid, $levelnumoption, $operatorid, $xdate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to option table
public function insert_option($departmentid, $levelid, $optname, $optdescription, $optcourses, $optpriority, $operatorid, $xdate){

    $mysqli = $this->connect();

    $sql = "INSERT INTO optiontable"
        . " (departmentid, levelid, optname, optdescription, optcourses, optpriority, operatorid, xdate)"
        . " VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([$departmentid, $levelid, $optname, $optdescription, $optcourses, $optpriority, $operatorid, $xdate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to option table
public function insert_course($departmentid, $levelid, $optionid, $semesterid, $csname, $csdescription, $cscreditunit,  $cspassmark, $schoolhelp, $odate){

    $mysqli = $this->connect();

    $sql =  ('INSERT INTO course SET departmentid=:departmentid, levelid=:levelid, optionid=:optionid, semesterid=:semesterid, csname=:csname, csdescription=:csdescription, cscreditunit=:cscreditunit, cspassmark=:cspassmark, operatorid=:operatorid, odate=:odate');
   /* "INSERT INTO course"
        . " (departmentid, levelid, optionid, semesterid, csname, csdescription, cscreditunit, cspassmark, operatorid, odate)"
        . " VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";*/

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':departmentid'=>$departmentid, ':levelid'=>$levelid, ':optionid'=>$optionid, ':semesterid'=>$semesterid, ':csname'=>$csname, ':csdescription'=>$csdescription,  ':cscreditunit'=>$cscreditunit, ':cspassmark'=>$cspassmark, ':operatorid'=>$schoolhelp, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to grade table
public function insert_grade($departmentid, $low, $high, $gradeletter, $gradepoint, $cgpalow, $cgpahigh, $remark, $operatorid, $odate){

    $mysqli = $this->connect();

    $sql =  ('INSERT INTO grade SET departmentid=:departmentid, low=:low, high=:high, gradeletter=:gradeletter, gradepoint=:gradepoint, cgpalow=:cgpalow, cgpahigh=:cgpahigh, remark=:remark, operatorid=:operatorid, odate=:odate');
   /* "INSERT INTO course"
        . " (departmentid, levelid, optionid, semesterid, csname, csdescription, cscreditunit, cspassmark, operatorid, odate)"
        . " VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";*/

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':departmentid'=>$departmentid, ':low'=>$low, ':high'=>$high, ':gradeletter'=>$gradeletter, ':gradepoint'=>$gradepoint, ':cgpalow'=>$cgpalow,  ':cgpahigh'=>$cgpahigh, ':remark'=>$remark,  ':operatorid'=>$operatorid, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to grade table
public function insert_assessment($departmentid, $assname, $asspercent, $assdescription, $schoolhelp, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO assessment SET departmentid=:departmentid, assname=:assname, asspercent=:asspercent, assdescription=:assdescription, operatorid=:operatorid, odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':departmentid'=>$departmentid, ':assname'=>$assname, ':asspercent'=>$asspercent, ':assdescription'=>$assdescription, ':operatorid'=>$schoolhelp, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to Session table
public function insert_session($sessionlow, $sessionhigh, $description, $operatorid, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO session SET sessionlow=:sessionlow, sessionhigh=:sessionhigh, description=:description, operatorid=:operatorid, odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':sessionlow'=>$sessionlow, ':sessionhigh'=>$sessionhigh, ':description'=>$description, ':operatorid'=>$operatorid, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}



//Inserting data to Session table
public function insert_housedivision($hdname, $hddescription, $studentid, $staffid, $operatorid, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO housedivision SET hdname=:hdname,  hddescription=:hddescription, studentid=:studentid, staffid=:staffid, operatorid=:operatorid, odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':hdname'=>$hdname, ':hddescription'=>$hddescription, ':studentid'=>$studentid, ':staffid'=>$staffid, ':operatorid'=>$operatorid, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to Session table
public function insert_formteacher($staffid, $levelid, $optionid, $signature, $operatorid, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO formteacher SET staffid=:staffid,  levelid=:levelid, optionid=:optionid, signature=:signature, operatorid=:operatorid, odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':staffid'=>$staffid, ':levelid'=>$levelid, ':optionid'=>$optionid, ':signature'=>$signature, ':operatorid'=>$operatorid, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to Session table
public function insert_signatoryposition($staffid, $departmentid, $positionname, $positiondesc, $signature, $operatorid, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO signatoryposition SET staffid=:staffid,  departmentid=:departmentid, positionname=:positionname, positiondesc=:positiondesc, signature=:signature, operatorid=:operatorid, odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':staffid'=>$staffid, ':departmentid'=>$departmentid, ':positionname'=>$positionname, ':positiondesc'=>$positiondesc, ':signature'=>$signature, ':operatorid'=>$operatorid, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}


//Inserting data to Session table
public function insert_adminperson($staffid, $signatorypositionid, $surname, $othername, $username, $password, $schoolhelp, $sdate, $xdate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO adminpersons SET staffid=:staffid,  signatorypositionid=:signatorypositionid, surname=:surname, othername=:othername, username=:username, password=:password, operatorid=:operatorid, sdate=:sdate, xdate=:xdate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':staffid'=>$staffid, ':signatorypositionid'=>$signatorypositionid, ':surname'=>$surname, ':othername'=>$othername, ':username'=>$username, ':password'=>$password, ':operatorid'=>$schoolhelp, ':sdate'=>$sdate, ':xdate'=>$xdate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to Session table
public function insert_signatorycomment($signatorypositionid, $low, $high, $comment, $schoolhelp, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO commentlist SET signatorypositionid=:signatorypositionid,  low=:low, high=:high, comment=:comment, operatorid=:operatorid,  odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':signatorypositionid'=>$signatorypositionid, ':low'=>$low, ':high'=>$high, ':comment'=>$comment,  ':operatorid'=>$schoolhelp, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to Domain type table
public function insert_domaintype($departmentid, $domaintypename, $numofdomain, $schoolhelp, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO domaintype SET departmentid=:departmentid,  domaintypename=:domaintypename, numofdomain=:numofdomain, operatorid=:operatorid,  odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':departmentid'=>$departmentid, ':domaintypename'=>$domaintypename, ':numofdomain'=>$numofdomain,   ':operatorid'=>$schoolhelp, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}


//Inserting data to Domain Name table
public function insert_domainname($domaintypeid, $domainname, $schoolhelp, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO domainname SET domaintypeid=:domaintypeid,  domainname=:domainname,  operatorid=:operatorid,  odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':domaintypeid'=>$domaintypeid, ':domainname'=>$domainname,  ':operatorid'=>$schoolhelp, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to Sub Category table
public function insert_subcatname($earlycatid, $subcatname, $schoolhelp, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO earlycatsub SET earlyclasscatid=:earlycatid,  subcatname=:subcatname, operatorid=:operatorid, odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':earlycatid'=>$earlycatid, ':subcatname'=>$subcatname,  ':operatorid'=>$schoolhelp, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to Early Class Category type table
public function insert_earlyclasscat($levelid, $earlycatname, $description, $noofsubcat, $schoolhelp, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO earlyclasscategory SET levelid=:levelid, earlycatname=:earlycatname, description=:description, noofsubcat=:noofsubcat, operatorid=:operatorid,  odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':levelid'=>$levelid, ':earlycatname'=>$earlycatname, ':description'=>$description, ':noofsubcat'=>$noofsubcat, ':operatorid'=>$schoolhelp, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting into five different fields
public function insert_6fields($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5){

    $mysqli = $this->connect();

    $sql = "INSERT INTO {$tablename} SET {$fieldname}=:fieldvalue, {$fieldname1}=:fieldvalue1, {$fieldname2}=:fieldvalue2, {$fieldname3}=:fieldvalue3, {$fieldname4}=:fieldvalue4, {$fieldname5}=:fieldvalue5";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4, ':fieldvalue5'=>$fieldvalue5])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}


//Inserting data to Pin table
public function insert_pin($departmentid, $pincode, $semesterid, $sessionid, $duration,  $expirydate, $schoolhelp, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO pingenerate SET departmentid=:departmentid, pincode=:pincode,  semesterid=:semesterid, sessionid=:sessionid,  duration=:duration,   expirydate=:expirydate,   operatorid=:operatorid,  odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':departmentid'=>$departmentid, ':pincode'=>$pincode, ':semesterid'=>$semesterid, ':sessionid'=>$sessionid, ':duration'=>$duration,  ':expirydate'=>$expirydate, ':operatorid'=>$schoolhelp, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to Pin table
public function insert_activation($name, $description,  $schoolhelp, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO cpanelactivations SET titlename=:name, description=:description,  operatorid=:operatorid,  odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':name'=>$name, ':description'=>$description, ':operatorid'=>$schoolhelp, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

}// End of class insertTable
?>