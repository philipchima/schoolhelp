<?php 

//include_once("schoolhelp.create.table.php");
class insertTable extends Dbh{

//Inserting data to students table
public function insert_students($regno, $sessionid, $studenttype, $surname, $othername, $levelid, $optid, $hdid, $sex, $dateofbirth, $address,  $lgaid, $stateid, $countryid, $guardianid,  $phone, $email, $passportname, $username, $password, $schoolhelp, $udate, $odate){

    $mysqli = $this->connect();

    
     $sql = ('INSERT INTO students SET regno=:regno, sessionid=:sessionid, studenttype=:studenttype, surname=:surname, othername=:othername, levelid=:levelid, optid=:optid, housedivisionid=:hdid, sexid=:sex, dateofbirth=:dateofbirth, address=:address, lgaid=:lgaid, stateid=:stateid, countryid=:countryid, guardianid=:guardianid, phone=:phone, email=:email,  passport=:passportname, username=:username, password=:password,  instructorid=:schoolhelp, udate=:udate, odate=:odate');

    $stmt = $mysqli->prepare($sql);
    $stmt1=$stmt->execute([':regno'=>$regno, ':sessionid'=>$sessionid, ':studenttype'=>$studenttype, ':surname'=>$surname, ':othername'=>$othername, ':levelid'=>$levelid, ':optid'=>$optid, ':hdid'=>$hdid, ':sex'=>$sex, ':dateofbirth'=>$dateofbirth, ':address'=>$address, ':lgaid'=>$lgaid, ':stateid'=>$stateid, ':countryid'=>$countryid, ':guardianid'=>$guardianid, ':phone'=>$phone, ':email'=>$email, ':passportname'=>$passportname, ':username'=>$username, ':password'=>$password,  ':schoolhelp'=>$schoolhelp,  ':udate'=>$udate, ':odate'=>$odate]);
    if($stmt1){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting into Ten different fields
public function insert_10fields($tablename, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5, $fieldname6, $fieldvalue6, $fieldname7, $fieldvalue7, $fieldname8, $fieldvalue8, $fieldname9, $fieldvalue9, $fieldname0, $fieldvalue0){

    $mysqli = $this->connect();

    $sql = "INSERT INTO {$tablename} SET {$fieldname1}=:fieldvalue1, {$fieldname2}=:fieldvalue2, {$fieldname3}=:fieldvalue3, {$fieldname4}=:fieldvalue4, {$fieldname5}=:fieldvalue5, {$fieldname6}=:fieldvalue6, {$fieldname7}=:fieldvalue7, {$fieldname8}=:fieldvalue8, {$fieldname9}=:fieldvalue9, {$fieldname0}=:fieldvalue0";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4, ':fieldvalue5'=>$fieldvalue5, ':fieldvalue6'=>$fieldvalue6, ':fieldvalue7'=>$fieldvalue7, ':fieldvalue8'=>$fieldvalue8, ':fieldvalue9'=>$fieldvalue9, ':fieldvalue0'=>$fieldvalue0])){
        
        return "Insertion Made";
        //array('action'=>'Success', 'counting'=>1);
    } else {
         return $failed="failed: " . $mysqli->error;
          
         //array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting into Eleven different fields
public function insert_11fields($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5, $fieldname6, $fieldvalue6, $fieldname7, $fieldvalue7, $fieldname8, $fieldvalue8, $fieldname9, $fieldvalue9, $fieldname10, $fieldvalue10){

    $mysqli = $this->connect();

    $sql = "INSERT INTO {$tablename} SET {$fieldname}=:fieldvalue, {$fieldname1}=:fieldvalue1, {$fieldname2}=:fieldvalue2, {$fieldname3}=:fieldvalue3, {$fieldname4}=:fieldvalue4, {$fieldname5}=:fieldvalue5, {$fieldname6}=:fieldvalue6, {$fieldname7}=:fieldvalue7, {$fieldname8}=:fieldvalue8, {$fieldname9}=:fieldvalue9, {$fieldname10}=:fieldvalue10";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4, ':fieldvalue5'=>$fieldvalue5, ':fieldvalue6'=>$fieldvalue6, ':fieldvalue7'=>$fieldvalue7, ':fieldvalue8'=>$fieldvalue8, ':fieldvalue9'=>$fieldvalue9, ':fieldvalue10'=>$fieldvalue10])){
        
        return "Insertion Made";
        //array('action'=>'Success', 'counting'=>1);
    } else {
         return $failed="failed: " . $mysqli->error;
          
         //array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting into Eleven different fields
public function insert_12fields($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5, $fieldname6, $fieldvalue6, $fieldname7, $fieldvalue7, $fieldname8, $fieldvalue8, $fieldname9, $fieldvalue9, $fieldname10, $fieldvalue10, $fieldname11, $fieldvalue11){

    $mysqli = $this->connect();

    $sql = "INSERT INTO {$tablename} SET {$fieldname}=:fieldvalue, {$fieldname1}=:fieldvalue1, {$fieldname2}=:fieldvalue2, {$fieldname3}=:fieldvalue3, {$fieldname4}=:fieldvalue4, {$fieldname5}=:fieldvalue5, {$fieldname6}=:fieldvalue6, {$fieldname7}=:fieldvalue7, {$fieldname8}=:fieldvalue8, {$fieldname9}=:fieldvalue9, {$fieldname10}=:fieldvalue10, {$fieldname11}=:fieldvalue11";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4, ':fieldvalue5'=>$fieldvalue5, ':fieldvalue6'=>$fieldvalue6, ':fieldvalue7'=>$fieldvalue7, ':fieldvalue8'=>$fieldvalue8, ':fieldvalue9'=>$fieldvalue9, ':fieldvalue10'=>$fieldvalue10, ':fieldvalue11'=>$fieldvalue11])){
        
        return "Insertion Made";
        //array('action'=>'Success', 'counting'=>1);
    } else {
         return $failed="failed: " . $mysqli->error;
          
         //array('action'=>'Success', 'counting'=>0);
    }

}


//Inserting into fifteen different fields
public function insert_15fields($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5, $fieldname6, $fieldvalue6, $fieldname7, $fieldvalue7, $fieldname8, $fieldvalue8, $fieldname9, $fieldvalue9, $fieldname10, $fieldvalue10, $fieldname11, $fieldvalue11, $fieldname12, $fieldvalue12, $fieldname13, $fieldvalue13, $fieldname14, $fieldvalue14){

    $mysqli = $this->connect();

    $sql = "INSERT INTO {$tablename} SET {$fieldname}=:fieldvalue, {$fieldname1}=:fieldvalue1, {$fieldname2}=:fieldvalue2, {$fieldname3}=:fieldvalue3, {$fieldname4}=:fieldvalue4, {$fieldname5}=:fieldvalue5, {$fieldname6}=:fieldvalue6, {$fieldname7}=:fieldvalue7, {$fieldname8}=:fieldvalue8, {$fieldname9}=:fieldvalue9, {$fieldname10}=:fieldvalue10, {$fieldname11}=:fieldvalue11, {$fieldname12}=:fieldvalue12, {$fieldname13}=:fieldvalue13, {$fieldname14}=:fieldvalue14";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4, ':fieldvalue5'=>$fieldvalue5, ':fieldvalue6'=>$fieldvalue6, ':fieldvalue7'=>$fieldvalue7, ':fieldvalue8'=>$fieldvalue8, ':fieldvalue9'=>$fieldvalue9, ':fieldvalue10'=>$fieldvalue10, ':fieldvalue11'=>$fieldvalue11, ':fieldvalue12'=>$fieldvalue12, ':fieldvalue13'=>$fieldvalue13, ':fieldvalue14'=>$fieldvalue14])){
        
        return "Insertion Made";
        //array('action'=>'Success', 'counting'=>1);
    } else {
         return $failed="failed: " . $mysqli->error;
          
         //array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting into fifteen different fields
public function insert_17fields($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5, $fieldname6, $fieldvalue6, $fieldname7, $fieldvalue7, $fieldname8, $fieldvalue8, $fieldname9, $fieldvalue9, $fieldname10, $fieldvalue10, $fieldname11, $fieldvalue11, $fieldname12, $fieldvalue12, $fieldname13, $fieldvalue13, $fieldname14, $fieldvalue14, $fieldname15, $fieldvalue15, $fieldname16, $fieldvalue16){

    $mysqli = $this->connect();

    $sql = "INSERT INTO {$tablename} SET {$fieldname}=:fieldvalue, {$fieldname1}=:fieldvalue1, {$fieldname2}=:fieldvalue2, {$fieldname3}=:fieldvalue3, {$fieldname4}=:fieldvalue4, {$fieldname5}=:fieldvalue5, {$fieldname6}=:fieldvalue6, {$fieldname7}=:fieldvalue7, {$fieldname8}=:fieldvalue8, {$fieldname9}=:fieldvalue9, {$fieldname10}=:fieldvalue10, {$fieldname11}=:fieldvalue11, {$fieldname12}=:fieldvalue12, {$fieldname13}=:fieldvalue13, {$fieldname14}=:fieldvalue14, {$fieldname15}=:fieldvalue15, {$fieldname16}=:fieldvalue16";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4, ':fieldvalue5'=>$fieldvalue5, ':fieldvalue6'=>$fieldvalue6, ':fieldvalue7'=>$fieldvalue7, ':fieldvalue8'=>$fieldvalue8, ':fieldvalue9'=>$fieldvalue9, ':fieldvalue10'=>$fieldvalue10, ':fieldvalue11'=>$fieldvalue11, ':fieldvalue12'=>$fieldvalue12, ':fieldvalue13'=>$fieldvalue13, ':fieldvalue14'=>$fieldvalue14, ':fieldvalue15'=>$fieldvalue15, ':fieldvalue16'=>$fieldvalue16])){
        
        return "Insertion Made";
        //array('action'=>'Success', 'counting'=>1);
    } else {
         return $failed="failed: " . $mysqli->error;
          
         //array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting into eight different fields
public function insert_8fields($tablename, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5, $fieldname6, $fieldvalue6, $fieldname7, $fieldvalue7, $fieldname8, $fieldvalue8){

    $mysqli = $this->connect();

    $sql = "INSERT INTO {$tablename} SET {$fieldname1}=:fieldvalue1, {$fieldname2}=:fieldvalue2, {$fieldname3}=:fieldvalue3, {$fieldname4}=:fieldvalue4, {$fieldname5}=:fieldvalue5, {$fieldname6}=:fieldvalue6, {$fieldname7}=:fieldvalue7, {$fieldname8}=:fieldvalue8";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4, ':fieldvalue5'=>$fieldvalue5, ':fieldvalue6'=>$fieldvalue6, ':fieldvalue7'=>$fieldvalue7, ':fieldvalue8'=>$fieldvalue8])){
        
        return "Insertion Made";
        //array('action'=>'Success', 'counting'=>1);
    } else {
         return $failed="failed: " . $mysqli->error;
          
         //array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting into nine different fields
public function insert_9fields($tablename, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5, $fieldname6, $fieldvalue6, $fieldname7, $fieldvalue7, $fieldname8, $fieldvalue8, $fieldname9, $fieldvalue9){

    $mysqli = $this->connect();

    $sql = "INSERT INTO {$tablename} SET {$fieldname1}=:fieldvalue1, {$fieldname2}=:fieldvalue2, {$fieldname3}=:fieldvalue3, {$fieldname4}=:fieldvalue4, {$fieldname5}=:fieldvalue5, {$fieldname6}=:fieldvalue6, {$fieldname7}=:fieldvalue7, {$fieldname8}=:fieldvalue8, {$fieldname9}=:fieldvalue9";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4, ':fieldvalue5'=>$fieldvalue5, ':fieldvalue6'=>$fieldvalue6, ':fieldvalue7'=>$fieldvalue7, ':fieldvalue8'=>$fieldvalue8, ':fieldvalue9'=>$fieldvalue9])){
        
        return "Insertion Made";
        //array('action'=>'Success', 'counting'=>1);
    } else {
         return $failed="failed: " . $mysqli->error;
          
         //array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to Guardian table
public function insert_score($tablename, $sessionid, $semesterid, $levelid, $optionid, $stid, $courseid, $assessmentid, $score, $operatoridfield, $schoolhelp, $udateidfield, $udate, $odate){
                           
    $mysqli = $this->connect();

    $sql = "INSERT INTO {$tablename} SET sessionid=:sessionid, semesterid=:semesterid, levelid=:levelid, optionid=:optionid, stid=:stid, courseid=:courseid, assessmentid=:assessmentid, score=:score, {$operatoridfield}=:operatorid, {$udateidfield}=:udate, odate=:odate";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':sessionid'=>$sessionid, ':semesterid'=>$semesterid, ':levelid'=>$levelid, ':optionid'=>$optionid, ':stid'=>$stid, ':courseid'=>$courseid, ':assessmentid'=>$assessmentid, ':score'=>$score,  ':operatorid'=>$schoolhelp, ':udate'=>$udate, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to Result table
public function insert_result($tablename, $sessionid, $semesterid, $levelid, $optionid, $stid, $courseid,  $score, $cumuresultscoreplus, $operatoridfield, $schoolhelp, $udateidfield, $udate, $odate){
                           
    $mysqli = $this->connect();

    $sql = "INSERT INTO {$tablename} SET sessionid=:sessionid, semesterid=:semesterid, levelid=:levelid, optionid=:optionid, stid=:stid, courseid=:courseid, score=:score, cumulative=:cumuresultscoreplus, {$operatoridfield}=:operatorid, {$udateidfield}=:udate, odate=:odate";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':sessionid'=>$sessionid, ':semesterid'=>$semesterid, ':levelid'=>$levelid, ':optionid'=>$optionid, ':stid'=>$stid, ':courseid'=>$courseid, ':score'=>$score, ':cumuresultscoreplus'=>$cumuresultscoreplus, ':operatorid'=>$schoolhelp, ':udate'=>$udate, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to Position table
public function insert_position($positiontblname, $sessionid, $semesterid, $levelid, $optionid, $stid, $studenttotalscore1, $cumuresultscoreplus, $average, $cumuresultaveplus,  $stucoursecount, $position, $operatoridfield, $schoolhelp, $udateidfield, $udate, $odate){
                           
    $mysqli = $this->connect();

    $sql = "INSERT INTO {$positiontblname} SET sessionid=:sessionid, semesterid=:semesterid, levelid=:levelid, optionid=:optionid, stid=:stid, score=:studenttotalscore1, cumulative=:cumuresultscoreplus, average=:average, numcourses=:stucoursecount, accaverage=:cumuresultaveplus, position=:position, {$operatoridfield}=:operatorid, {$udateidfield}=:udate, odate=:odate";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':sessionid'=>$sessionid, ':semesterid'=>$semesterid, ':levelid'=>$levelid, ':optionid'=>$optionid, ':stid'=>$stid, ':studenttotalscore1'=>$studenttotalscore1, ':cumuresultscoreplus'=>$cumuresultscoreplus, ':average'=>$average, 'numcourses'=>$stucoursecount,  ':cumuresultaveplus'=>$cumuresultaveplus, ':position'=>$position, ':operatorid'=>$schoolhelp, ':udate'=>$udate, ':odate'=>$odate])){
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}


//Inserting data to resultactivations table
public function insert_activation($name, $description,  $schoolhelp, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO resultactivations SET titlename=:name, description=:description,  operatorid=:operatorid,  odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':name'=>$name, ':description'=>$description, ':operatorid'=>$schoolhelp, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to term details table
public function insert_termdetails($sessionid, $semesterid, $begindate, $enddate, $no_of_days, $schoolhelp, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO term_start_end SET sessionid=:sessionid, semesterid=:semesterid, begins=:begindate, ends=:enddate, no_of_days=:no_of_days, operatorid=:operatorid,  odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':sessionid'=>$sessionid, ':semesterid'=>$semesterid, ':begindate'=>$begindate, ':enddate'=>$enddate, ':no_of_days'=>$no_of_days, ':operatorid'=>$schoolhelp, ':odate'=>$odate])){
        
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to setupcomment table
public function insert_commentsetup($departmentid, $commenttype, $comment, $schoolhelp, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO commentsetup SET departmentid=:departmentid, commenttype=:commenttype, comment=:comment, operatorid=:operatorid, odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':departmentid'=>$departmentid, ':commenttype'=>$commenttype, ':comment'=>$comment, ':operatorid'=>$schoolhelp, ':odate'=>$odate])){
        
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to result Sample table
public function insert_resultsample($departmentid, $resultsample, $schoolhelp, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO resultsample SET departmentid=:departmentid, resultname=:resultsample,  operatorid=:operatorid, odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':departmentid'=>$departmentid, ':resultsample'=>$resultsample, ':operatorid'=>$schoolhelp, ':odate'=>$odate])){
        
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to Attendance table
public function insert_attenadance($tablename, $stid, $status, $levelid, $optionid, $semesterid, $sessionid, $instructorid, $mdate, $instructorudate, $odate){

    $mysqli = $this->connect();

    $sql = "INSERT INTO {$tablename} SET stid=:stid, status=:status, levelid=:levelid, optionid=:optionid, semesterid=:semesterid, sessionid=:sessionid, instructorid=:instructorid, attendancedate=:mdate, instructorudate=:instructorudate,  odate=:odate";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':stid'=>$stid, ':status'=>$status, ':levelid'=>$levelid, ':optionid'=>$optionid, ':semesterid'=>$semesterid, ':sessionid'=>$sessionid, ':instructorid'=>$instructorid, ':mdate'=>$mdate, ':instructorudate'=>$instructorudate, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }
}



//Inserting data to result domain table
public function insert_resultdomain($positionid, $domaintypeid, $domainnameid, $domaingrade, $schoolhelp, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO resultdomain SET positionresultid=:positionid, domaintypeid=:domaintypeid, domainnameid=:domainnameid, domaingrade=:domaingrade, operatorid=:operatorid, odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':positionid'=>$positionid, ':domaintypeid'=>$domaintypeid, ':domainnameid'=>$domainnameid, ':domaingrade'=>$domaingrade, ':operatorid'=>$schoolhelp, ':odate'=>$odate])){
        
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to result domain table
public function insert_attendancemark($noofschooldays, $noofdaysattended, $positionresultid, $schoolhelp, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO attendancemark SET positionresultid=:positionresultid, noofschooldays=:noofschooldays, stuattendance=:noofdaysattended, operatorid=:operatorid, odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':positionresultid'=>$positionresultid, ':noofschooldays'=>$noofschooldays, ':noofdaysattended'=>$noofdaysattended, ':operatorid'=>$schoolhelp, ':odate'=>$odate])){
        
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

}// End of class insertTable
?>