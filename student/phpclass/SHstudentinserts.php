<?php 
class insertTable extends Dbh{

//Inserting into eight different fields
public function insert_4fields($tablename, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4){

    $mysqli = $this->connect();

    $sql = "INSERT INTO {$tablename} SET {$fieldname1}=:fieldvalue1, {$fieldname2}=:fieldvalue2, {$fieldname3}=:fieldvalue3, {$fieldname4}=:fieldvalue4";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4])){
        
        return "Insertion Made";
        //array('action'=>'Success', 'counting'=>1);
    } else {
         return $failed="failed: " . $mysqli->error;
          
         //array('action'=>'Success', 'counting'=>0);
    }

}


} //The end of class
?>