<?php 
include_once("includes/connection.php");

class updateTable extends Dbh{

//Inserting data to Attendance table
public function update_attendance($tablename, $attendanceid,  $status, $operatorid, $udate){

    $mysqli = $this->connect();

    $sql = "UPDATE {$tablename} SET status=:status, operatorid=:operatorid, udate=:udate WHERE attendanceid=:attendanceid";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':status'=>$status, ':operatorid'=>$operatorid, ':udate'=>$udate, ':attendanceid'=>$attendanceid])){
        
       
       return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }
}

public function update_instructorcourses($icourseid, $staffid, $departmentid, $levelid, $optionid, $courseid, $schoolhelp){

    $mysqli = $this->connect();
    
    $sql =  ('UPDATE instructorcourses SET staffid=:staffid, departmentid=:departmentid, levelid=:levelid, optionid=:optionid, courseid=:courseid, operatorid=:operatorid WHERE icourseid=:icourseid');
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':staffid'=>$staffid, ':departmentid'=>$departmentid, ':levelid'=>$levelid, ':optionid'=>$optionid, ':courseid'=>$courseid, ':operatorid'=>$schoolhelp, ':icourseid'=>$icourseid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

public function update_staff($staffid, $title, $surname, $othername,  $sex, $address, $employdate, $lgaid, $stateid, $countryid, 
$phone, $email, $qualification, $passportname, $username, $stafftype,  $schoolhelp, $udate){

    $mysqli = $this->connect();
    
    $sql =  ('UPDATE staff SET titleid=:title, surname=:surname, othername=:othername, sex=:sex, address=:address, employdate=:employdate, lgaid=:lgaid, stateid=:stateid, countryid=:countryid, phone=:phone, email=:email, qualification=:qualification, passport=:passport, username=:username,  stafftype=:stafftype, operatorid=:operatorid, udate=:udate WHERE staffid=:staffid');
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':title'=>$title, ':surname'=>$surname, ':othername'=>$othername, ':sex'=>$sex, ':address'=>$address, ':employdate'=>$employdate, ':lgaid'=>$lgaid, ':stateid'=>$stateid,':countryid'=>$countryid, ':phone'=>$phone, ':email'=>$email, ':qualification'=>$qualification, ':passport'=>$passportname, ':username'=>$username, ':stafftype'=>$stafftype, ':operatorid'=>$schoolhelp, ':udate'=>$udate, ':staffid'=>$staffid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

public function update_students($regno, $sessionid, $studenttype, $surname, $othername, $levelid, $optid, $hdid, $sex, $dateofbirth, $address, $lgaid, $stateid, $countryid, $guardianid, $phone, $email, $passportname, $username, $schoolhelp, $udate, $stid){

    $mysqli = $this->connect();
    
   $sql=('UPDATE students SET regno=:regno, sessionid=:sessionid, studenttype=:studenttype, surname=:surname, othername=:othername, levelid=:levelid, optid=:optid, housedivisionid=:hdid, sexid=:sex, dateofbirth=:dateofbirth, address=:address, lgaid=:lgaid, stateid=:stateid, countryid=:countryid, guardianid=:guardianid, phone=:phone, email=:email, passport=:passportname, username=:username, operatorid=:schoolhelp, udate=:udate WHERE stid=:stid');
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);
     $stmt1=$stmt->execute([':regno'=>$regno, ':sessionid'=>$sessionid, ':studenttype'=>$studenttype, ':surname'=>$surname, ':othername'=>$othername, ':levelid'=>$levelid, ':optid'=>$optid, ':hdid'=>$hdid, ':sex'=>$sex, ':dateofbirth'=>$dateofbirth, ':address'=>$address, ':lgaid'=>$lgaid, ':stateid'=>$stateid, ':countryid'=>$countryid, ':guardianid'=>$guardianid, ':phone'=>$phone, ':email'=>$email, ':passportname'=>$passportname, ':username'=>$username, ':schoolhelp'=>$schoolhelp, ':udate'=>$udate, ':stid'=>$stid]);

    if($stmt1){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

public function update_guardian($title, $surname, $othername, $address, $phone, $email, $occupation, $passport, $username,  $schoolhelp, $udate, $gid){

    $mysqli = $this->connect();
    
    $sql =  ('UPDATE guardian SET titleid=:title, surname=:surname, othername=:othername, address=:address, phone=:phone, email=:email, occupation=:occupation, passport=:passport, username=:username,  operatorid=:operatorid, udate=:udate WHERE gid=:gid');
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':title'=>$title, ':surname'=>$surname, ':othername'=>$othername, ':address'=>$address, ':phone'=>$phone, ':email'=>$email, ':occupation'=>$occupation, ':passport'=>$passport, ':username'=>$username, ':operatorid'=>$schoolhelp, ':udate'=>$udate, ':gid'=>$gid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

//Password Reset for all tables
public function passwordreset($tablename, $fieldname, $fieldid,  $updatevalue, $schoolhelp, $udate){

    $mysqli = $this->connect();
    
    $sql = "UPDATE {$tablename} SET password='$updatevalue', operatorid='$schoolhelp', udate='$udate' WHERE {$fieldname}=$fieldid";

    $stmt = $mysqli->prepare($sql);
  
     if($stmt->execute()){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

//Assigning Guardian
public function updatesingle($tablename, $fieldname, $fieldid, $updatefield, $updatevalue, $schoolhelp, $udate){

    $mysqli = $this->connect();
    
    $sql = "UPDATE {$tablename} SET {$updatefield}='$updatevalue', operatorid='$schoolhelp', udate='$udate' WHERE {$fieldname}=$fieldid";

    $stmt = $mysqli->prepare($sql);
  
     if($stmt->execute()){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

//Assigning Guardian
public function updatesingle2($tablename, $fieldname, $fieldid, $updatefield, $updatevalue, $schoolhelp, $udate){

    $mysqli = $this->connect();
    
    $sql = "UPDATE {$tablename} SET {$updatefield}='$updatevalue', operatorid='$schoolhelp', sdate='$udate' WHERE {$fieldname}=$fieldid";

    $stmt = $mysqli->prepare($sql);
  
     if($stmt->execute()){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

//Activating or De-activating an Account 
public function accessgiving($tablename, $fieldname, $fieldid,  $updatevalue, $schoolhelp, $udate){

    $mysqli = $this->connect();
    
    $sql = "UPDATE {$tablename} SET access='$updatevalue', operatorid='$schoolhelp', udate='$udate' WHERE {$fieldname}=$fieldid";

    $stmt = $mysqli->prepare($sql);
  
     if($stmt->execute()){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

public function delete_dash($tablename, $fieldname, $fieldvalue){
    $mysqli = $this->connect();

     $sql = "DELETE FROM {$tablename} WHERE {$fieldname}='$fieldvalue'";

    $stmt = $mysqli->prepare($sql);
    
     if($stmt->execute()){
        return "Success";
      } else {
        return "failed: " . $mysqli->error;
    }
        
    }

//Updating Result Tables when group or option is changed 4 a student
    public function result_dash($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $updatefield, $updatevalue){
    $mysqli = $this->connect();

      $sql = "UPDATE {$tablename} SET {$updatefield}='$updatevalue' WHERE {$fieldname}='$fieldvalue' and {$fieldname1}='$fieldvalue1' and {$fieldname2}='$fieldvalue2'";

    $stmt = $mysqli->prepare($sql);
    
     if($stmt->execute()){
        return "Success";
      } else {
        return "failed: " . $mysqli->error;
    }
        
    }

    //Subscription Update
public function update_subscription($numofstudent, $amount, $subdate, $expirydate, $description, $operatorid, $subsid){

    $mysqli = $this->connect();
    
    $sql =  ('UPDATE subscription SET numofstudent=:numofstudent, amount=:amount, subdate=:subdate, expirydate=:expirydate, description=:description, operatorid=:operatorid WHERE subsid=:subsid');
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':numofstudent'=>$numofstudent, ':amount'=>$amount, ':subdate'=>$subdate, ':expirydate'=>$expirydate, ':description'=>$description, ':operatorid'=>$operatorid, ':subsid'=>$subsid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }
}

    //this method is used to update comment
public function update_threefields($tablename, $tableidfield, $tableid, $tablefield1,  $tablevalue1,  $tablefield2,  $tablevalue2,  $updatefield, $udate){

    $mysqli = $this->connect();
    
    $sql =  "UPDATE {$tablename} SET  {$tablefield1}=:tablevalue1, {$tablefield2}=:tablevalue2,  {$updatefield}=:udate WHERE {$tableidfield}=:tableid";
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':tablevalue1'=>$tablevalue1, ':tablevalue2'=>$tablevalue2, ':udate'=>$udate, ':tableid'=>$tableid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }
}

//this class is used to update comment
public function update_fourfields($tablename, $tableidfield, $tableid, $tablefield1,  $tablevalue1, $tablefield2,  $tablevalue2, $operatoridfield, $operatorid, $updatefield, $udate){

    $mysqli = $this->connect();
    
    $sql =  "UPDATE {$tablename} SET  {$tablefield1}=:tablevalue1, {$tablefield2}=:tablevalue2, {$operatoridfield}=:operatorid, {$updatefield}=:udate WHERE {$tableidfield}=:tableid";
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':tablevalue1'=>$tablevalue1, ':tablevalue2'=>$tablevalue2, ':operatorid'=>$operatorid, ':udate'=>$udate, ':operatorid'=>$operatorid, ':tableid'=>$tableid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

//Update Six fields
public function update_sixfields($tablename, $tableidfield, $tableid, $tablefield1,  $tablevalue1, $tablefield2,  $tablevalue2, $tablefield3,  $tablevalue3, $tablefield4,  $tablevalue4, $tablefield5,  $tablevalue5, $operatoridfield, $operatorid){

    $mysqli = $this->connect();
    
    $sql =  "UPDATE {$tablename} SET  {$tablefield1}=:tablevalue1, {$tablefield2}=:tablevalue2, {$tablefield3}=:tablevalue3, {$tablefield4}=:tablevalue4, {$tablefield5}=:tablevalue5, {$operatoridfield}=:operatorid  WHERE {$tableidfield}=:tableid";
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':tablevalue1'=>$tablevalue1, ':tablevalue2'=>$tablevalue2, ':tablevalue3'=>$tablevalue3, ':tablevalue4'=>$tablevalue4, ':tablevalue5'=>$tablevalue5, ':operatorid'=>$operatorid, ':operatorid'=>$operatorid, ':tableid'=>$tableid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

//Update eight fields
public function update_eightfields($tablename, $tableidfield, $tableid, $tablefield1,  $tablevalue1, $tablefield2, $tablevalue2, $tablefield3, $tablevalue3, $tablefield4, $tablevalue4, $tablefield5, $tablevalue5, $tablefield6, $tablevalue6, $operatoridfield, $operatorid, $updatefield, $udate){

    $mysqli = $this->connect();
    
    $sql =  "UPDATE {$tablename} SET  {$tablefield1}=:tablevalue1, {$tablefield2}=:tablevalue2, {$tablefield3}=:tablevalue3, {$tablefield4}=:tablevalue4, {$tablefield5}=:tablevalue5, {$tablefield6}=:tablevalue6, {$operatoridfield}=:operatorid, {$updatefield}=:udate WHERE {$tableidfield}=:tableid";
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':tablevalue1'=>$tablevalue1, ':tablevalue2'=>$tablevalue2, ':tablevalue3'=>$tablevalue3, ':tablevalue4'=>$tablevalue4, ':tablevalue5'=>$tablevalue5, ':tablevalue6'=>$tablevalue6, ':operatorid'=>$operatorid, ':udate'=>$udate, ':operatorid'=>$operatorid, ':tableid'=>$tableid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}



}// End of class department
?>