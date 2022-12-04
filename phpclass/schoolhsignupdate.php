<?php 
include_once("schoolhelp/includes/connection.php");


class updateTable extends Dbh{

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


}// End of class department
?>