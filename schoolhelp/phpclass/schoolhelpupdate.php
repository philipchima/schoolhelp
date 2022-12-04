<?php 
include_once("../includes/connection.php");

class updateTBLactivate extends Dbh{

    public function updatingall($tblname, $tblid, $status, $id, $operatorid){
        $mysqli = $this->connect();
        $sql1 = "UPDATE {$tblname} SET {$status}=0 WHERE {$tblid}!='$id'";

    // Prepare statement
     $stmt1 = $mysqli->prepare($sql1);
     $stmt1->execute();

     $sql = "UPDATE {$tblname} SET {$status}=1 WHERE {$tblid}='$id'";
      $stmt = $mysqli->prepare($sql);
    if($stmt->execute()){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

    }


    public function updatingall3($tblname, $tblid, $id, $tblid1, $id1, $operatorid){
        $mysqli = $this->connect();
        $sql1 = "UPDATE {$tblname} SET {$tblid}=$id, operatorid='$operatorid' WHERE {$tblid1}='$id1'";

    // Prepare statement
     $stmt= $mysqli->prepare($sql1);
   

    if($stmt->execute()){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

    }


//Updating Privelleges
    public function updateprevilleges($tablename, $fieldname, $fieldvalue,  $updatefield, $updatevalue,  $updatefield1, $updatevalue1, $updatefield2, $updatevalue2){
    $mysqli = $this->connect();

      $sql = "UPDATE {$tablename} SET {$updatefield}='$updatevalue', {$updatefield1}='$updatevalue1', {$updatefield2}='$updatevalue2' WHERE  {$fieldname}='$fieldvalue'";

    $stmt = $mysqli->prepare($sql);
    
     if($stmt->execute()){
        return "Success";
      } else {
        return "failed: " . $mysqli->error;
    }
        
    }


      public function updatingall2($tblname, $tblid, $status, $id, $tblid1, $id1, $operatorid){
        $mysqli = $this->connect();
        $sql1 = "UPDATE {$tblname} SET {$status}=0 WHERE {$tblid}!='$id' and $tblid1='$id1'";

    // Prepare statement
     $stmt1 = $mysqli->prepare($sql1);
     $stmt1->execute();

     $sql = "UPDATE {$tblname} SET {$status}=1 WHERE {$tblid}='$id' and $tblid1='$id1'";
      $stmt = $mysqli->prepare($sql);
    if($stmt->execute()){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

    }
}


class updateTable extends Dbh{

    //Password Reset for all tables
public function passwordreset($tablename, $fieldname, $fieldid,  $updatevalue, $schoolhelp, $udate){

    $mysqli = $this->connect();
    
    $sql = "UPDATE {$tablename} SET password='$updatevalue', operatorid='$schoolhelp', sdate='$udate' WHERE {$fieldname}=$fieldid";

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

public function update_department($did, $deptname, $years, $grades, $assnum, $signnum, $subjnum, $optionnum, $description, $adminid, $sdate){

    $mysqli = $this->connect();
    $sql = "UPDATE department SET deptname='$deptname', years='$years', grades='$grades', assnum='$assnum', signnum='$signnum', subjnum='$subjnum', optionnum='$optionnum', description='$description', sdate='$sdate', adminid='$adminid' WHERE did='$did'";

    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute()){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

public function update_institution($I_id, $departmentid, $instiname, $instislogan,  $instiphone, $instiaddress, $instiemail, $instiprefix, $instilogo, $adminid){

    $mysqli = $this->connect();
    $sql = "UPDATE institution SET  instiname='$instiname', instislogan='$instislogan', instiphone='$instiphone', instiaddress='$instiaddress', instiemail='$instiemail', instiemail='$instiemail', departmentid='$departmentid', instiprefix='$instiprefix', instilogo='$instilogo', operatorid='$adminid' WHERE I_id='$I_id'";

    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute()){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

public function update_title($titleid, $titlename, $operatorid){

    $mysqli = $this->connect();
    $sql = "UPDATE title SET titlename='$titlename',  operatorid='$operatorid' WHERE titleid='$titleid'";

    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute()){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

public function update_qualification($qualificationid, $qualificationname, $operatorid){

    $mysqli = $this->connect();
    $sql = "UPDATE qualification SET qualificationname='$qualificationname',  operatorid='$operatorid' WHERE qualificationid='$qualificationid'";

    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute()){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

public function update_semester($semesterid, $semestername, $description, $operatorid, $sdate){

    $mysqli = $this->connect();
    $sql = "UPDATE semesters SET semestername='$semestername', semesterdescription='$description', operatorid='$operatorid' WHERE semesterid='$semesterid'";

    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute()){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

public function update_passmark($passmarkid, $levelid, $passmark, $operatorid){

    $mysqli = $this->connect();
    $sql = "UPDATE passmark SET levelid='$levelid', passmark='$passmark',  operatorid='$operatorid' WHERE passmarkid='$passmarkid'";

    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute()){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}


public function update_level($levelid, $levelname, $levelrank,  $departmentid,  $levelnumoption, $operatorid){

    $mysqli = $this->connect();
    $sql = "UPDATE level SET levelname='$levelname', levelrank='$levelrank', departmentid='$departmentid', levelnumoption='$levelnumoption', operatorid='$operatorid' WHERE levelid='$levelid'";

    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute()){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

public function update_option($optid, $departmentid, $levelid, $optname, $optdescription, $optcourses, $optpriority, $operatorid, $xdate){

    $mysqli = $this->connect();
    
    $sql = ('UPDATE optiontable SET departmentid=:departmentid, levelid=:levelid, optname=:optname, optdescription=:optdescription, optcourses=:optcourses, optpriority=:optpriority, operatorid=:operatorid  WHERE optid = :optid');
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':departmentid'=>$departmentid, ':levelid'=>$levelid,':optname'=>$optname, ':optdescription'=>$optdescription, ':optcourses'=>$optcourses, ':optpriority'=>$optpriority, ':operatorid'=>$operatorid, ':optid'=>$optid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}


public function update_course($csid, $departmentid,  $csname, $csdescription, $cscreditunit, $cspassmark, $schoolhelp){

    $mysqli = $this->connect();
    
    $sql =  ('UPDATE course SET departmentid=:departmentid, csname=:csname, csdescription=:csdescription, cscreditunit=:cscreditunit, cspassmark=:cspassmark, operatorid=:operatorid WHERE csid=:csid');
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':csid'=>$csid, ':departmentid'=>$departmentid, ':csname'=>$csname, ':csdescription'=>$csdescription,  ':cscreditunit'=>$cscreditunit, ':cspassmark'=>$cspassmark, ':operatorid'=>$schoolhelp])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

public function update_grade($gradeid, $departmentid, $low, $high, $gradeletter, $gradepoint, $cgpalow, $cgpahigh, $remark, $operatorid){

    $mysqli = $this->connect();
    
    $sql =  ('UPDATE grade SET departmentid=:departmentid, low=:low, high=:high, gradeletter=:gradeletter, gradepoint=:gradepoint, cgpalow=:cgpalow, cgpahigh=:cgpahigh, remark=:remark, operatorid=:operatorid WHERE gradeid=:gradeid');
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':gradeid'=>$gradeid, ':departmentid'=>$departmentid, ':low'=>$low, ':high'=>$high, ':gradeletter'=>$gradeletter, ':gradepoint'=>$gradepoint, ':cgpalow'=>$cgpalow,  ':cgpahigh'=>$cgpahigh, ':remark'=>$remark,  ':operatorid'=>$operatorid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}


public function update_assessment($assid, $departmentid, $assname, $asspercent, $assdescription, $schoolhelp, $odate){

    $mysqli = $this->connect();
    
    $sql =  ('UPDATE assessment SET departmentid=:departmentid, assname=:assname, asspercent=:asspercent, assdescription=:assdescription, operatorid=:operatorid WHERE assid=:assid');
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':assid'=>$assid, ':departmentid'=>$departmentid, ':assname'=>$assname, ':asspercent'=>$asspercent, ':assdescription'=>$assdescription, ':operatorid'=>$schoolhelp])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}


public function update_session($sessionid, $sessionlow, $sessionhigh, $description, $operatorid){

    $mysqli = $this->connect();
    
    $sql =  ('UPDATE session SET sessionlow=:sessionlow, sessionhigh=:sessionhigh, description=:description, operatorid=:operatorid WHERE sessionid=:sessionid');
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':sessionid'=>$sessionid, ':sessionlow'=>$sessionlow, ':sessionhigh'=>$sessionhigh, ':description'=>$description, ':operatorid'=>$operatorid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

//Inserting data to housedivision table
public function update_housedivision($hdname, $hddescription, $studentid, $staffid, $operatorid, $hdid){

    $mysqli = $this->connect();

    $sql = ('UPDATE housedivision SET hdname=:hdname,  hddescription=:hddescription, studentid=:studentid, staffid=:staffid, operatorid=:operatorid WHERE hdid=:hdid');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':hdname'=>$hdname, ':hddescription'=>$hddescription, ':studentid'=>$studentid, ':staffid'=>$staffid, ':operatorid'=>$operatorid, ':hdid'=>$hdid])){
        
          return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }
      

}


//Inserting data to formteacher table
public function update_formteacher($formteacherid, $staffid, $levelid, $optionid, $signaturename, $schoolhelp){

    $mysqli = $this->connect();

    $sql = ('UPDATE formteacher SET  staffid=:staffid, levelid=:levelid, optionid=:optionid, signature=:signature, operatorid=:operatorid WHERE formteacherid=:formteacherid');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':staffid'=>$staffid, ':levelid'=>$levelid, ':optionid'=>$optionid, ':signature'=>$signaturename, ':operatorid'=>$schoolhelp, ':formteacherid'=>$formteacherid])){
        
          return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }
      

}

//Inserting data to signatoryposition table
public function update_signatoryposition($signatorypositionid, $staffid, $departmentid, $positionname, $positiondesc, $signaturename, $schoolhelp){

    $mysqli = $this->connect();

    $sql = ('UPDATE signatoryposition SET  staffid=:staffid, departmentid=:departmentid, positionname=:positionname, positiondesc=:positiondesc, signature=:signature, operatorid=:operatorid WHERE signatorypositionid=:signatorypositionid');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':staffid'=>$staffid, ':departmentid'=>$departmentid, ':positionname'=>$positionname, ':positiondesc'=>$positiondesc, ':signature'=>$signaturename, ':operatorid'=>$schoolhelp, ':signatorypositionid'=>$signatorypositionid])){
        
          return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }
      

}

//Inserting data to signatoryposition table
public function update_adminperson($staffid, $signatorypositionid, $surname, $othername, $username, $password, $schoolhelp, $sdate, $adminid){

    $mysqli = $this->connect();

    $sql = ('UPDATE adminpersons SET  staffid=:staffid,  signatorypositionid=:signatorypositionid, surname=:surname, othername=:othername, username=:username, password=:password, operatorid=:operatorid, sdate=:sdate WHERE adminid=:adminid');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':staffid'=>$staffid, ':signatorypositionid'=>$signatorypositionid, ':surname'=>$surname, ':othername'=>$othername, ':username'=>$username, ':password'=>$password, ':operatorid'=>$schoolhelp, ':sdate'=>$sdate, ':adminid'=>$adminid])){
        
          return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }
      

}

//Inserting data to signatoryposition table
public function update_signatorycomment($commentlistid, $signatorypositionid, $low, $high, $comment, $schoolhelp){

    $mysqli = $this->connect();

    $sql = ('UPDATE commentlist SET signatorypositionid=:signatorypositionid,  low=:low, high=:high, comment=:comment, operatorid=:operatorid WHERE commentlistid=:commentlistid');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':signatorypositionid'=>$signatorypositionid, ':low'=>$low, ':high'=>$high, ':comment'=>$comment,  ':operatorid'=>$schoolhelp, ':commentlistid'=>$commentlistid])){
        
          return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }
      

}

//Updating data to Early Class table
public function update_earlyclasscat($levelid, $earlycatname, $description, $numofsubcat, $schoolhelp, $earlycatid){

    $mysqli = $this->connect();

    $sql = ('UPDATE earlyclasscategory SET levelid=:levelid, earlycatname=:earlycatname, description=:description, noofsubcat=:numofsubcat, operatorid=:operatorid WHERE earlycatid=:earlycatid');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':levelid'=>$levelid, ':earlycatname'=>$earlycatname, ':description'=>$description, ':numofsubcat'=>$numofsubcat, ':operatorid'=>$schoolhelp, ':earlycatid'=>$earlycatid])){
        
          return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }
      

}

//Updating data to Sub Category table
public function update_earlyclasssub($earlyclasscatid, $subcatname,  $schoolhelp, $earlycatsubid){

    $mysqli = $this->connect();

    $sql = ('UPDATE earlycatsub SET earlyclasscatid=:earlyclasscatid,  subcatname=:subcatname,  operatorid=:operatorid WHERE earlycatsubid=:earlycatsubid');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':earlyclasscatid'=>$earlyclasscatid, ':subcatname'=>$subcatname,  ':operatorid'=>$schoolhelp, ':earlycatsubid'=>$earlycatsubid])){
        
          return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }   
}

//Updating data to Sub Category table
public function update_6fields($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5){

    $mysqli = $this->connect();

    $sql = "UPDATE {$tablename} SET {$fieldname}=:fieldvalue, {$fieldname1}=:fieldvalue1, {$fieldname2}=:fieldvalue2, {$fieldname3}=:fieldvalue3, {$fieldname4}=:fieldvalue4  WHERE {$fieldname5}=:fieldvalue5";
;

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4, ':fieldvalue5'=>$fieldvalue5])){
        
          return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }   
}

//Updating data to signatoryposition table
public function update_domaintype($departmentid, $domaintypename, $numofdomain, $schoolhelp, $domaintypeid){

    $mysqli = $this->connect();

    $sql = ('UPDATE domaintype SET departmentid=:departmentid,  domaintypename=:domaintypename, numofdomain=:numofdomain, operatorid=:operatorid WHERE domaintypeid=:domaintypeid');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':departmentid'=>$departmentid, ':domaintypename'=>$domaintypename, ':numofdomain'=>$numofdomain,   ':operatorid'=>$schoolhelp, ':domaintypeid'=>$domaintypeid])){
        
          return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }
      

}



//Inserting data to signatoryposition table
public function update_domainname($domaintypeid, $domainname,  $schoolhelp, $domainnameid){

    $mysqli = $this->connect();

    $sql = ('UPDATE domainname SET domaintypeid=:domaintypeid,  domainname=:domainname,  operatorid=:operatorid WHERE domainnameid=:domainnameid');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':domaintypeid'=>$domaintypeid, ':domainname'=>$domainname,  ':operatorid'=>$schoolhelp, ':domainnameid'=>$domainnameid])){
        
          return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }   
}

//Inserting data to signatoryposition table
public function update_pin($departmentid, $pincode, $duration,  $expirydate, $schoolhelp, $pinid){

    $mysqli = $this->connect();

    $sql = ('UPDATE pingenerate SET departmentid=:departmentid, pincode=:pincode,  duration=:duration,   expirydate=:expirydate,   operatorid=:operatorid WHERE pinid=:pinid');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':departmentid'=>$departmentid, ':pincode'=>$pincode,  ':duration'=>$duration,  ':expirydate'=>$expirydate, ':operatorid'=>$schoolhelp, ':pinid'=>$pinid])){
        
          return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }
      

}

//Inserting data to signatoryposition table
public function update_activation($name, $description,  $schoolhelp, $odate, $actid){

    $mysqli = $this->connect();

    $sql = ('UPDATE cpanelactivations SET titlename=:titlename, description=:description,  operatorid=:operatorid WHERE actid=:actid');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':titlename'=>$name, ':description'=>$description, ':operatorid'=>$schoolhelp, ':actid'=>$actid])){
        
          return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }
      

}

}// End of class department
?>