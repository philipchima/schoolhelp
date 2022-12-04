<?php 
include_once("../includes/connection.php");
//include_once("schoolhelp.create.table.php");
class insertTable extends Dbh{


//Inserting data to Guardian table
public function insert_idcard($departmentid, $deptname, $deptaddress,  $labelcolor, $detailcolor, $headbgcolor, $contentbgcolor1, $contentbgcolor2, $backgroundtype, $schoolhelp,  $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO idcardcolor SET departmentid=:departmentid, schname=:deptname, schaddress=:deptaddress, htitlelabel=:labelcolor, htitle=:detailcolor, tableheadbgcolor=:headbgcolor, tablecontentcolor1=:contentbgcolor1, tablecontentcolor2=:contentbgcolor2,  idcardbackground=:backgroundtype, operatorid=:operatorid, odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':departmentid'=>$departmentid, ':deptname'=>$deptname, ':deptaddress'=>$deptaddress, ':labelcolor'=>$labelcolor, ':detailcolor'=>$detailcolor, ':headbgcolor'=>$headbgcolor, ':contentbgcolor1'=>$contentbgcolor1,  ':contentbgcolor2'=>$contentbgcolor2,  ':backgroundtype'=>$backgroundtype, ':operatorid'=>$schoolhelp, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=>'Success', 'counting'=>0);
    }

}

}// End of class insertTable
?>