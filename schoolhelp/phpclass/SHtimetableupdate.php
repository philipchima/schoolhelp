<?php 
include_once("../includes/connection.php");

class updateTable extends Dbh{

	public function delete_timetable($tablename, $fieldname, $fieldvalue){
    $mysqli = $this->connect();

     $sql = "DELETE FROM {$tablename} WHERE {$fieldname}='$fieldvalue'";

    $stmt = $mysqli->prepare($sql);
    
     if($stmt->execute()){
        return "Success";
      } else {
        return "failed: " . $mysqli->error;
    }
        
    }

    public function deletechecksix($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5){
    $mysqli = $this->connect();

     $sql = "DELETE FROM {$tablename} WHERE {$fieldname}='$fieldvalue' and {$fieldname1}='$fieldvalue1'  and {$fieldname2}='$fieldvalue2'  and {$fieldname3}='$fieldvalue3' and {$fieldname4}='$fieldvalue4' and {$fieldname5}='$fieldvalue5'";

    $stmt = $mysqli->prepare($sql);
    
     if($stmt->execute()){
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

//Update five fields
public function update_fivefields($tablename, $tableidfield, $tableid, $tablefield1,  $tablevalue1, $tablefield2,  $tablevalue2, $tablefield3,  $tablevalue3, $tablefield4,  $tablevalue4, $tablefield5,  $tablevalue5){

    $mysqli = $this->connect();
    
    $sql =  "UPDATE {$tablename} SET  {$tablefield1}=:tablevalue1, {$tablefield2}=:tablevalue2, {$tablefield3}=:tablevalue3, {$tablefield4}=:tablevalue4, {$tablefield5}=:tablevalue5 WHERE {$tableidfield}=:tableid";
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':tablevalue1'=>$tablevalue1, ':tablevalue2'=>$tablevalue2, ':tablevalue3'=>$tablevalue3, ':tablevalue4'=>$tablevalue4, ':tablevalue5'=>$tablevalue5,  ':tableid'=>$tableid])){
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

//Update nine fields
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

//Update ten fields
public function update_tenfields($tablename, $tableidfield, $tableid, $tablefield1,  $tablevalue1, $tablefield2, $tablevalue2, $tablefield3, $tablevalue3, $tablefield4, $tablevalue4, $tablefield5, $tablevalue5, $tablefield6, $tablevalue6, $tablefield7, $tablevalue7, $tablefield8, $tablevalue8, $operatoridfield, $operatorid, $updatefield, $udate){

    $mysqli = $this->connect();
    
    $sql =  "UPDATE {$tablename} SET  {$tablefield1}=:tablevalue1, {$tablefield2}=:tablevalue2, {$tablefield3}=:tablevalue3, {$tablefield4}=:tablevalue4, {$tablefield5}=:tablevalue5, {$tablefield6}=:tablevalue6, {$tablefield7}=:tablevalue7, {$tablefield8}=:tablevalue8, {$operatoridfield}=:operatorid, {$updatefield}=:udate WHERE {$tableidfield}=:tableid";
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':tablevalue1'=>$tablevalue1, ':tablevalue2'=>$tablevalue2, ':tablevalue3'=>$tablevalue3, ':tablevalue4'=>$tablevalue4, ':tablevalue5'=>$tablevalue5, ':tablevalue6'=>$tablevalue6, ':tablevalue7'=>$tablevalue7, ':tablevalue8'=>$tablevalue8, ':operatorid'=>$operatorid, ':udate'=>$udate, ':operatorid'=>$operatorid, ':tableid'=>$tableid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

//Update Eleven fields
public function update_elevenfields($tablename, $tableidfield, $tableid, $tablefield1,  $tablevalue1, $tablefield2, $tablevalue2, $tablefield3, $tablevalue3, $tablefield4, $tablevalue4, $tablefield5, $tablevalue5, $tablefield6, $tablevalue6, $tablefield7, $tablevalue7, $tablefield8, $tablevalue8, $tablefield9, $tablevalue9, $tablefield10, $tablevalue10, $tablefield11, $tablevalue11){

    $mysqli = $this->connect();
    
    $sql =  "UPDATE {$tablename} SET  {$tablefield1}=:tablevalue1, {$tablefield2}=:tablevalue2, {$tablefield3}=:tablevalue3, {$tablefield4}=:tablevalue4, {$tablefield5}=:tablevalue5, {$tablefield6}=:tablevalue6, {$tablefield7}=:tablevalue7, {$tablefield8}=:tablevalue8, {$tablefield9}=:tablevalue9, {$tablefield10}=:tablevalue10, {$tablefield11}=:tablevalue11 WHERE {$tableidfield}=:tableid";
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':tablevalue1'=>$tablevalue1, ':tablevalue2'=>$tablevalue2, ':tablevalue3'=>$tablevalue3, ':tablevalue4'=>$tablevalue4, ':tablevalue5'=>$tablevalue5, ':tablevalue6'=>$tablevalue6, ':tablevalue7'=>$tablevalue7, ':tablevalue8'=>$tablevalue8, ':tablevalue9'=>$tablevalue9, ':tablevalue10'=>$tablevalue10, ':tablevalue11'=>$tablevalue11, ':tableid'=>$tableid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

//Update twelve fields
public function update_twelvefields($tablename, $tableidfield, $tableid, $tablefield1,  $tablevalue1, $tablefield2, $tablevalue2, $tablefield3, $tablevalue3, $tablefield4, $tablevalue4, $tablefield5, $tablevalue5, $tablefield6, $tablevalue6, $tablefield7, $tablevalue7, $tablefield8, $tablevalue8, $tablefield9, $tablevalue9, $tablefield10, $tablevalue10, $tablefield11, $tablevalue11, $tablefield12, $tablevalue12){

    $mysqli = $this->connect();
    
    $sql =  "UPDATE {$tablename} SET  {$tablefield1}=:tablevalue1, {$tablefield2}=:tablevalue2, {$tablefield3}=:tablevalue3, {$tablefield4}=:tablevalue4, {$tablefield5}=:tablevalue5, {$tablefield6}=:tablevalue6, {$tablefield7}=:tablevalue7, {$tablefield8}=:tablevalue8, {$tablefield9}=:tablevalue9, {$tablefield10}=:tablevalue10, {$tablefield11}=:tablevalue11, {$tablefield12}=:tablevalue12 WHERE {$tableidfield}=:tableid";
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':tablevalue1'=>$tablevalue1, ':tablevalue2'=>$tablevalue2, ':tablevalue3'=>$tablevalue3, ':tablevalue4'=>$tablevalue4, ':tablevalue5'=>$tablevalue5, ':tablevalue6'=>$tablevalue6, ':tablevalue7'=>$tablevalue7, ':tablevalue8'=>$tablevalue8, ':tablevalue9'=>$tablevalue9, ':tablevalue10'=>$tablevalue10, ':tablevalue11'=>$tablevalue11, ':tablevalue12'=>$tablevalue12, ':tableid'=>$tableid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

//Update twelve fields
public function update_thirteenfields($tablename, $tableidfield, $tableid, $tablefield1,  $tablevalue1, $tablefield2, $tablevalue2, $tablefield3, $tablevalue3, $tablefield4, $tablevalue4, $tablefield5, $tablevalue5, $tablefield6, $tablevalue6, $tablefield7, $tablevalue7, $tablefield8, $tablevalue8, $tablefield9, $tablevalue9, $tablefield10, $tablevalue10, $tablefield11, $tablevalue11, $tablefield12, $tablevalue12, $tablefield13, $tablevalue13){

    $mysqli = $this->connect();
    
    $sql =  "UPDATE {$tablename} SET  {$tablefield1}=:tablevalue1, {$tablefield2}=:tablevalue2, {$tablefield3}=:tablevalue3, {$tablefield4}=:tablevalue4, {$tablefield5}=:tablevalue5, {$tablefield6}=:tablevalue6, {$tablefield7}=:tablevalue7, {$tablefield8}=:tablevalue8, {$tablefield9}=:tablevalue9, {$tablefield10}=:tablevalue10, {$tablefield11}=:tablevalue11, {$tablefield12}=:tablevalue12 , {$tablefield13}=:tablevalue13 WHERE {$tableidfield}=:tableid";
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':tablevalue1'=>$tablevalue1, ':tablevalue2'=>$tablevalue2, ':tablevalue3'=>$tablevalue3, ':tablevalue4'=>$tablevalue4, ':tablevalue5'=>$tablevalue5, ':tablevalue6'=>$tablevalue6, ':tablevalue7'=>$tablevalue7, ':tablevalue8'=>$tablevalue8, ':tablevalue9'=>$tablevalue9, ':tablevalue10'=>$tablevalue10, ':tablevalue11'=>$tablevalue11, ':tablevalue12'=>$tablevalue12, ':tablevalue13'=>$tablevalue13, ':tableid'=>$tableid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

}//Closing class

?>