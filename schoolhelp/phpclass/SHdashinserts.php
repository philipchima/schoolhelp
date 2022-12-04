<?php 
include_once("includes/connection.php");
//include_once("schoolhelp.create.table.php");
class insertTable extends Dbh{


    //Inserting into five different fields
public function insert_5fields($tablename, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5){

    $mysqli = $this->connect();

    $sql = "INSERT INTO {$tablename} SET {$fieldname1}=:fieldvalue1, {$fieldname2}=:fieldvalue2, {$fieldname3}=:fieldvalue3, {$fieldname4}=:fieldvalue4, {$fieldname5}=:fieldvalue5";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4, ':fieldvalue5'=>$fieldvalue5])){
        
        return "Insertion Made";
        //array('action'=>'Success', 'counting'=>1);
    } else {
         return $failed="failed: " . $mysqli->error;
          
         //array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting into Seven different fields
public function insert_7fields($tablename, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5, $fieldname6, $fieldvalue6, $fieldname7, $fieldvalue7){

    $mysqli = $this->connect();

    $sql = "INSERT INTO {$tablename} SET {$fieldname1}=:fieldvalue1, {$fieldname2}=:fieldvalue2, {$fieldname3}=:fieldvalue3, {$fieldname4}=:fieldvalue4, {$fieldname5}=:fieldvalue5, {$fieldname6}=:fieldvalue6, {$fieldname7}=:fieldvalue7";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4, ':fieldvalue5'=>$fieldvalue5, ':fieldvalue6'=>$fieldvalue6, ':fieldvalue7'=>$fieldvalue7])){
        
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

//Inserting into Ten different fields
public function insert_10fields($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5, $fieldname6, $fieldvalue6, $fieldname7, $fieldvalue7, $fieldname8, $fieldvalue8, $fieldname9, $fieldvalue9){

    $mysqli = $this->connect();

    $sql = "INSERT INTO {$tablename} SET {$fieldname}=:fieldvalue, {$fieldname1}=:fieldvalue1, {$fieldname2}=:fieldvalue2, {$fieldname3}=:fieldvalue3, {$fieldname4}=:fieldvalue4, {$fieldname5}=:fieldvalue5, {$fieldname6}=:fieldvalue6, {$fieldname7}=:fieldvalue7, {$fieldname8}=:fieldvalue8, {$fieldname9}=:fieldvalue9";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4, ':fieldvalue5'=>$fieldvalue5, ':fieldvalue6'=>$fieldvalue6, ':fieldvalue7'=>$fieldvalue7, ':fieldvalue8'=>$fieldvalue8, ':fieldvalue9'=>$fieldvalue9])){
        
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



//Inserting data to staff table
public function insert_staff($title, $surname, $othername,  $sex, $address, $employdate, $lgaid, $stateid, $countryid,  $phone, $email, $qualification, $passport, $username, $password, $stafftype, $schoolhelp, $udate, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO staff SET titleid=:title, surname=:surname, othername=:othername, sex=:sex, address=:address, employdate=:employdate, lgaid=:lgaid, stateid=:stateid, countryid=:countryid, phone=:phone, email=:email, qualification=:qualification, passport=:passport, username=:username, password=:password, stafftype=:stafftype, operatorid=:operatorid, udate=:udate, odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':title'=>$title, ':surname'=>$surname, ':othername'=>$othername, ':sex'=>$sex,':address'=>$address, ':employdate'=>$employdate, ':lgaid'=>$lgaid,':stateid'=>$stateid,':countryid'=>$countryid, ':phone'=>$phone, ':email'=>$email, ':qualification'=>$qualification, ':passport'=>$passport, ':username'=>$username, ':password'=>$password, ':stafftype'=>$stafftype, ':operatorid'=>$schoolhelp, ':udate'=>$udate, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to Attendance table
public function insert_attendance($tablename, $stid, $status, $levelid, $optionid, $semesterid, $sessionid, $operatorid, $mdate, $udate, $odate){

    $mysqli = $this->connect();

    $sql = "INSERT INTO {$tablename} SET stid=:stid, status=:status, levelid=:levelid, optionid=:optionid, semesterid=:semesterid, sessionid=:sessionid, operatorid=:operatorid, attendancedate=:mdate, udate=:udate,  odate=:odate";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':stid'=>$stid, ':status'=>$status, ':levelid'=>$levelid, ':optionid'=>$optionid, ':semesterid'=>$semesterid, ':sessionid'=>$sessionid, ':operatorid'=>$operatorid, ':mdate'=>$mdate, ':udate'=>$udate, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }
}

//Inserting data to staff table
public function insert_instructorcourses($staffid, $departmentid, $levelid, $optionid, $courseid, $schoolhelp, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO instructorcourses SET staffid=:staffid, departmentid=:departmentid, levelid=:levelid, optionid=:optionid, courseid=:courseid, operatorid=:schoolhelp, odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':staffid'=>$staffid, ':departmentid'=>$departmentid, ':levelid'=>$levelid, ':optionid'=>$optionid, ':courseid'=>$courseid, ':schoolhelp'=>$schoolhelp, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}



//Inserting data to students table
public function insert_students($regno, $sessionid, $studenttype, $surname, $othername, $levelid, $optid, $hdid, $sex, $dateofbirth, $address,  $lgaid, $stateid, $countryid, $guardianid,  $phone, $email, $passportname, $username, $password, $schoolhelp, $udate, $odate){

    $mysqli = $this->connect();

    
     $sql = ('INSERT INTO students SET regno=:regno, sessionid=:sessionid, studenttype=:studenttype, surname=:surname, othername=:othername, levelid=:levelid, optid=:optid, housedivisionid=:hdid, sexid=:sex, dateofbirth=:dateofbirth, address=:address, lgaid=:lgaid, stateid=:stateid, countryid=:countryid, guardianid=:guardianid, phone=:phone, email=:email,  passport=:passportname, username=:username, password=:password,  operatorid=:schoolhelp, udate=:udate, odate=:odate');

    $stmt = $mysqli->prepare($sql);
    $stmt1=$stmt->execute([':regno'=>$regno, ':sessionid'=>$sessionid, ':studenttype'=>$studenttype, ':surname'=>$surname, ':othername'=>$othername, ':levelid'=>$levelid, ':optid'=>$optid, ':hdid'=>$hdid, ':sex'=>$sex, ':dateofbirth'=>$dateofbirth, ':address'=>$address, ':lgaid'=>$lgaid, ':stateid'=>$stateid, ':countryid'=>$countryid, ':guardianid'=>$guardianid, ':phone'=>$phone, ':email'=>$email, ':passportname'=>$passportname, ':username'=>$username, ':password'=>$password,  ':schoolhelp'=>$schoolhelp,  ':udate'=>$udate, ':odate'=>$odate]);
    if($stmt1){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to Guardian table
public function insert_guardian($title, $surname, $othername, $address, $phone, $email, $occupation, $passport, $username, $password, $schoolhelp, $udate, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO guardian SET titleid=:title, surname=:surname, othername=:othername, address=:address, phone=:phone, email=:email, occupation=:occupation, passport=:passport, username=:username, password=:password, operatorid=:operatorid, udate=:udate, odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':title'=>$title, ':surname'=>$surname, ':othername'=>$othername, ':address'=>$address, ':phone'=>$phone, ':email'=>$email, ':occupation'=>$occupation, ':passport'=>$passport, ':username'=>$username, ':password'=>$password, ':operatorid'=>$schoolhelp, ':udate'=>$udate, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

//Inserting data to Guardian table
public function insert_subscription($numofstudent, $amount, $subdate, $expirydate, $description, $operatorid, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO subscription SET numofstudent=:numofstudent, amount=:amount, subdate=:subdate, expirydate=:expirydate, description=:description, operatorid=:operatorid, odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':numofstudent'=>$numofstudent, ':amount'=>$amount, ':subdate'=>$subdate, ':expirydate'=>$expirydate, ':description'=>$description, ':operatorid'=>$operatorid, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

}// End of class insertTable
?>