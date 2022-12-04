<?php 
include_once("../includes/connection.php");

class updateTable extends Dbh{


public function update_idcard($departmentid, $deptname, $deptaddress,  $labelcolor, $detailcolor, $headbgcolor, $contentbgcolor1, $contentbgcolor2, $backgroundtype, $schoolhelp, $colorid){

    $mysqli = $this->connect();
    
    $sql =  ('UPDATE idcardcolor SET departmentid=:departmentid, schname=:deptname, schaddress=:deptaddress, htitlelabel=:labelcolor, htitle=:detailcolor, tableheadbgcolor=:headbgcolor, tablecontentcolor1=:contentbgcolor1, tablecontentcolor2=:contentbgcolor2,  idcardbackground=:backgroundtype, operatorid=:operatorid  WHERE colorid=:colorid');
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':departmentid'=>$departmentid, ':deptname'=>$deptname, ':deptaddress'=>$deptaddress, ':labelcolor'=>$labelcolor, ':detailcolor'=>$detailcolor, ':headbgcolor'=>$headbgcolor, ':contentbgcolor1'=>$contentbgcolor1,  ':contentbgcolor2'=>$contentbgcolor2,  ':backgroundtype'=>$backgroundtype, ':operatorid'=>$schoolhelp, ':colorid'=>$colorid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

public function delete_idcard($tablename, $fieldname, $fieldvalue){
    $mysqli = $this->connect();

     $sql = "DELETE FROM {$tablename} WHERE {$fieldname}='$fieldvalue'";

    $stmt = $mysqli->prepare($sql);
    
     if($stmt->execute()){
        return "Success";
      } else {
        return "failed: " . $mysqli->error;
    }
        
    }


}// End of class department
?>