<?php 

class updateTable extends Dbh{

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

    //Admin Login Update
public function update_all($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1){

    $mysqli = $this->connect();
    
    $sql =  "UPDATE {$tablename} SET {$fieldname}=:fieldvalue WHERE {$fieldname1}=:fieldvalue1";
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}


   //Admin Login Update
public function update_all2($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2){

    $mysqli = $this->connect();
    
    $sql =  "UPDATE {$tablename} SET {$fieldname1}=:fieldvalue1, {$fieldname2}=:fieldvalue2 WHERE {$fieldname}=:fieldvalue";
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

//Updating Status in a table

  public function update_scorestatus($scoretblname, $statusfield, $status, $operatoridfield, $operatorid, $updatefield, $udate, $sessionid, $semesterid, $levelid, $optionid, $stid){

    $mysqli = $this->connect();
    
    $sql ="UPDATE {$scoretblname} SET  {$statusfield}=:status, {$operatoridfield}=:operatorid, {$updatefield}=:udate WHERE sessionid=:sessionid and semesterid=:semesterid and levelid=:levelid and optionid=:optionid and stid=:stid";
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':status'=>$status, ':operatorid'=>$operatorid, ':udate'=>$udate,  ':sessionid'=>$sessionid, ':semesterid'=>$semesterid, ':levelid'=>$levelid, ':optionid'=>$optionid, ':stid'=>$stid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}
  

public function update_score($scoretblname, $scoreidfield, $scoreid, $scorefield,  $score, $operatoridfield, $operatorid, $updatefield, $udate){

    $mysqli = $this->connect();
    
    $sql =  "UPDATE {$scoretblname} SET  {$scorefield}=:score, {$operatoridfield}=:operatorid, {$updatefield}=:udate WHERE {$scoreidfield}=:scoreid";
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':score'=>$score, ':operatorid'=>$operatorid, ':udate'=>$udate, ':operatorid'=>$operatorid, ':scoreid'=>$scoreid])){
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

public function update_result($resulttblname, $resultidfield, $resultid, $resultscorefield,  $resultscore, $resultcumufield,  $resultcumuscore, $operatoridfield, $operatorid, $updatefield, $udate){

    $mysqli = $this->connect();
    
    $sql =  "UPDATE {$resulttblname} SET  {$resultscorefield}=:resultscore, {$resultcumufield}=:resultcumuscore, {$operatoridfield}=:operatorid, {$updatefield}=:udate WHERE {$resultidfield}=:resultid";
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':resultscore'=>$resultscore, ':resultcumuscore'=>$resultcumuscore, ':operatorid'=>$operatorid, ':udate'=>$udate, ':operatorid'=>$operatorid, ':resultid'=>$resultid])){
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

//Update Seven fields
public function update_sixfields($tablename, $tableidfield, $tableid, $tablefield1,  $tablevalue1, $tablefield2,  $tablevalue2, $tablefield3,  $tablevalue3, $tablefield4,  $tablevalue4, $operatoridfield, $operatorid, $updatefield, $udate){

    $mysqli = $this->connect();
    
    $sql =  "UPDATE {$tablename} SET  {$tablefield1}=:tablevalue1, {$tablefield2}=:tablevalue2, {$tablefield3}=:tablevalue3, {$tablefield4}=:tablevalue4, {$operatoridfield}=:operatorid, {$updatefield}=:udate WHERE {$tableidfield}=:tableid";
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':tablevalue1'=>$tablevalue1, ':tablevalue2'=>$tablevalue2, ':tablevalue3'=>$tablevalue3, ':tablevalue4'=>$tablevalue4, ':operatorid'=>$operatorid, ':udate'=>$udate, ':operatorid'=>$operatorid, ':tableid'=>$tableid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

//Update Seven fields
public function update_sevenfields($tablename, $tableidfield, $tableid, $tablefield1,  $tablevalue1, $tablefield2,  $tablevalue2, $tablefield3,  $tablevalue3, $tablefield4,  $tablevalue4, $tablefield5,  $tablevalue5, $operatoridfield, $operatorid, $updatefield, $udate){

    $mysqli = $this->connect();
    
    $sql =  "UPDATE {$tablename} SET  {$tablefield1}=:tablevalue1, {$tablefield2}=:tablevalue2, {$tablefield3}=:tablevalue3, {$tablefield4}=:tablevalue4, {$tablefield5}=:tablevalue5, {$operatoridfield}=:operatorid, {$updatefield}=:udate WHERE {$tableidfield}=:tableid";
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':tablevalue1'=>$tablevalue1, ':tablevalue2'=>$tablevalue2, ':tablevalue3'=>$tablevalue3, ':tablevalue4'=>$tablevalue4, ':tablevalue5'=>$tablevalue5, ':operatorid'=>$operatorid, ':udate'=>$udate, ':operatorid'=>$operatorid, ':tableid'=>$tableid])){
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

//Update eight fields
public function update_ninefields($tablename, $tableidfield, $tableid, $tablefield1,  $tablevalue1, $tablefield2, $tablevalue2, $tablefield3, $tablevalue3, $tablefield4, $tablevalue4, $tablefield5, $tablevalue5, $tablefield6, $tablevalue6, $tablefield7, $tablevalue7, $operatoridfield, $operatorid, $updatefield, $udate){

    $mysqli = $this->connect();
    
    $sql =  "UPDATE {$tablename} SET  {$tablefield1}=:tablevalue1, {$tablefield2}=:tablevalue2, {$tablefield3}=:tablevalue3, {$tablefield4}=:tablevalue4, {$tablefield5}=:tablevalue5, {$tablefield6}=:tablevalue6, {$tablefield7}=:tablevalue7, {$operatoridfield}=:operatorid, {$updatefield}=:udate WHERE {$tableidfield}=:tableid";
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':tablevalue1'=>$tablevalue1, ':tablevalue2'=>$tablevalue2, ':tablevalue3'=>$tablevalue3, ':tablevalue4'=>$tablevalue4, ':tablevalue5'=>$tablevalue5, ':tablevalue6'=>$tablevalue6, ':tablevalue7'=>$tablevalue7, ':operatorid'=>$operatorid, ':udate'=>$udate, ':operatorid'=>$operatorid, ':tableid'=>$tableid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

//Inserting data to result Sample table
public function update_resultsample($departmentid, $resultsample, $schoolhelp, $resultsampleid){

    $mysqli = $this->connect();

    $sql = ('UPDATE resultsample SET departmentid=:departmentid, resultname=:resultsample,  operatorid=:operatorid WHERE resultsampleid=:resultsampleid');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':departmentid'=>$departmentid, ':resultsample'=>$resultsample, ':operatorid'=>$schoolhelp, ':resultsampleid'=>$resultsampleid])){
        
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

public function update_position($positiontblname, $posi_tbl_id, $studenttotalscore1, $cumupositionscoreplus, $studentave, $cumupositionaveplus, $stucoursecount, $position, $operatoridfield, $schoolhelp, $udatefield, $udate){

    $mysqli = $this->connect();
    
    $sql =  "UPDATE {$positiontblname} SET score=:studenttotalscore1, cumulative=:cumupositionscoreplus, average=:studentave, accaverage=:cumupositionaveplus, numcourses=:stucoursecount, position=:position, {$operatoridfield}=:operatorid, {$udatefield}=:udate WHERE positionid=:positionid";
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':studenttotalscore1'=>$studenttotalscore1, ':cumupositionscoreplus'=>$cumupositionscoreplus, ':studentave'=>$studentave, ':cumupositionaveplus'=>$cumupositionaveplus, ':stucoursecount'=>$stucoursecount, ':position'=>$position, ':operatorid'=>$schoolhelp, ':udate'=>$udate, ':positionid'=>$posi_tbl_id])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

//Deleting a record
public function delete_result($tablename, $fieldname, $fieldvalue){
    $mysqli = $this->connect();

     $sql = "DELETE FROM {$tablename} WHERE {$fieldname}='$fieldvalue'";

    $stmt = $mysqli->prepare($sql);
    
     if($stmt->execute()){
        return "Success";
      } else {
        return "failed: " . $mysqli->error;
    }
        
    }

    //Inserting data to signatoryposition table
public function update_activation($name, $description,  $schoolhelp, $odate, $actid){

    $mysqli = $this->connect();

    $sql = ('UPDATE resultactivations SET titlename=:titlename, description=:description,  operatorid=:operatorid WHERE actid=:actid');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':titlename'=>$name, ':description'=>$description, ':operatorid'=>$schoolhelp, ':actid'=>$actid])){
        
          return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }
      
}

//Inserting data to setupcomment table
public function update_commentsetup($departmentid, $commenttype, $comment, $schoolhelp, $resultcommentid){

    $mysqli = $this->connect();

    $sql = ('UPDATE commentsetup SET departmentid=:departmentid, commenttype=:commenttype, comment=:comment, operatorid=:operatorid WHERE resultcommentid=:resultcommentid');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':departmentid'=>$departmentid, ':commenttype'=>$commenttype, ':comment'=>$comment, ':operatorid'=>$schoolhelp, ':resultcommentid'=>$resultcommentid])){
        
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

//Inserting data to term details table
public function update_termdetails($sessionid, $semesterid, $begindate, $enddate, $no_of_days, $schoolhelp, $tbeid){

    $mysqli = $this->connect();

    $sql = ('UPDATE term_start_end SET sessionid=:sessionid, semesterid=:semesterid, begins=:begindate, ends=:enddate, no_of_days=:no_of_days, operatorid=:operatorid WHERE tbeid=:tbeid');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':sessionid'=>$sessionid, ':semesterid'=>$semesterid, ':begindate'=>$begindate, ':enddate'=>$enddate, ':no_of_days'=>$no_of_days, ':operatorid'=>$schoolhelp, ':tbeid'=>$tbeid])){
       return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

public function update_resultcolor($departmentid, $deptname, $deptaddress,  $labelcolor, $detailcolor, $headbgcolor, $contentbgcolor1, $contentbgcolor2, $backgroundtype, $schoolhelp, $colorid){

    $mysqli = $this->connect();
    
    $sql =  ('UPDATE resultcolor SET departmentid=:departmentid, schname=:deptname, schaddress=:deptaddress, htitlelabel=:labelcolor, htitle=:detailcolor, tableheadbgcolor=:headbgcolor, tablecontentcolor1=:contentbgcolor1, tablecontentcolor2=:contentbgcolor2,  resultbackground=:backgroundtype, operatorid=:operatorid  WHERE colorid=:colorid');
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':departmentid'=>$departmentid, ':deptname'=>$deptname, ':deptaddress'=>$deptaddress, ':labelcolor'=>$labelcolor, ':detailcolor'=>$detailcolor, ':headbgcolor'=>$headbgcolor, ':contentbgcolor1'=>$contentbgcolor1,  ':contentbgcolor2'=>$contentbgcolor2,  ':backgroundtype'=>$backgroundtype, ':operatorid'=>$schoolhelp, ':colorid'=>$colorid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}


             
//Inserting data to result domain table
public function update_resultdomain($domaingrade, $schoolhelp, $udate, $resultdomainid){

    $mysqli = $this->connect();

    $sql = ('UPDATE resultdomain SET domaingrade=:domaingrade, operatorid=:operatorid, udate=:udate WHERE resultdomainid=:resultdomainid');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':domaingrade'=>$domaingrade, ':operatorid'=>$schoolhelp, ':udate'=>$udate, ':resultdomainid'=>$resultdomainid])){
        
         return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

//Inserting data to result domain table
public function update_attendancemark($noofschooldays, $noofdaysattended, $schoolhelp, $udate, $attendancemarkid){

    $mysqli = $this->connect();

    $sql = ('UPDATE attendancemark SET noofschooldays=:noofschooldays, stuattendance=:noofdaysattended, operatorid=:operatorid, udate=:udate WHERE attendancemarkid=:attendancemarkid');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':noofschooldays'=>$noofschooldays, ':noofdaysattended'=>$noofdaysattended, ':operatorid'=>$schoolhelp, ':udate'=>$udate, ':attendancemarkid'=>$attendancemarkid])){
        
         return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

//Inserting data to Attendance table
public function update_attenadance($tablename, $attendanceid,  $status, $instructorid, $instructorudate){

    $mysqli = $this->connect();

    $sql = "UPDATE {$tablename} SET status=:status, instructorid=:instructorid, instructorudate=:instructorudate WHERE attendanceid=:attendanceid";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':status'=>$status, ':instructorid'=>$instructorid,  ':instructorudate'=>$instructorudate, ':attendanceid'=>$attendanceid])){
        
       
       return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }
}

}// End of class department
?>