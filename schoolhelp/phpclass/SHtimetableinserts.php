<?php include_once("../includes/connection.php");
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

//Inserting into Six different fields
public function insert_6fields($tablename, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5, $fieldname6, $fieldvalue6){

    $mysqli = $this->connect();

    $sql = "INSERT INTO {$tablename} SET {$fieldname1}=:fieldvalue1, {$fieldname2}=:fieldvalue2, {$fieldname3}=:fieldvalue3, {$fieldname4}=:fieldvalue4, {$fieldname5}=:fieldvalue5, {$fieldname6}=:fieldvalue6";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4, ':fieldvalue5'=>$fieldvalue5, ':fieldvalue6'=>$fieldvalue6])){
        
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

public function insert_13fields($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5, $fieldname6, $fieldvalue6, $fieldname7, $fieldvalue7, $fieldname8, $fieldvalue8, $fieldname9, $fieldvalue9, $fieldname10, $fieldvalue10, $fieldname11, $fieldvalue11, $fieldname12, $fieldvalue12){
    $last_id="";
    $mysqli = $this->connect();

    $sql = "INSERT INTO {$tablename} SET {$fieldname}=:fieldvalue, {$fieldname1}=:fieldvalue1, {$fieldname2}=:fieldvalue2, {$fieldname3}=:fieldvalue3, {$fieldname4}=:fieldvalue4, {$fieldname5}=:fieldvalue5, {$fieldname6}=:fieldvalue6, {$fieldname7}=:fieldvalue7, {$fieldname8}=:fieldvalue8, {$fieldname9}=:fieldvalue9, {$fieldname10}=:fieldvalue10, {$fieldname11}=:fieldvalue11, {$fieldname12}=:fieldvalue12";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4, ':fieldvalue5'=>$fieldvalue5, ':fieldvalue6'=>$fieldvalue6, ':fieldvalue7'=>$fieldvalue7, ':fieldvalue8'=>$fieldvalue8, ':fieldvalue9'=>$fieldvalue9, ':fieldvalue10'=>$fieldvalue10, ':fieldvalue11'=>$fieldvalue11, ':fieldvalue12'=>$fieldvalue12])){
        $last_id=$mysqli->lastInsertId();
        //return "Insertion Made";
        return array('action'=>'Success', 'id'=>$last_id);
    } else {
         //return $failed="failed: " . $mysqli->error;
          
         return array('action'=>'failed', 'id'=>$last_id);
    }

}

public function insert_14fields($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5, $fieldname6, $fieldvalue6, $fieldname7, $fieldvalue7, $fieldname8, $fieldvalue8, $fieldname9, $fieldvalue9, $fieldname10, $fieldvalue10, $fieldname11, $fieldvalue11, $fieldname12, $fieldvalue12, $fieldname13, $fieldvalue13){
    $last_id="";
    $mysqli = $this->connect();

    $sql = "INSERT INTO {$tablename} SET {$fieldname}=:fieldvalue, {$fieldname1}=:fieldvalue1, {$fieldname2}=:fieldvalue2, {$fieldname3}=:fieldvalue3, {$fieldname4}=:fieldvalue4, {$fieldname5}=:fieldvalue5, {$fieldname6}=:fieldvalue6, {$fieldname7}=:fieldvalue7, {$fieldname8}=:fieldvalue8, {$fieldname9}=:fieldvalue9, {$fieldname10}=:fieldvalue10, {$fieldname11}=:fieldvalue11, {$fieldname12}=:fieldvalue12, {$fieldname13}=:fieldvalue13";

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4, ':fieldvalue5'=>$fieldvalue5, ':fieldvalue6'=>$fieldvalue6, ':fieldvalue7'=>$fieldvalue7, ':fieldvalue8'=>$fieldvalue8, ':fieldvalue9'=>$fieldvalue9, ':fieldvalue10'=>$fieldvalue10, ':fieldvalue11'=>$fieldvalue11, ':fieldvalue12'=>$fieldvalue12, ':fieldvalue13'=>$fieldvalue13])){
        $last_id=$mysqli->lastInsertId();
        //return "Insertion Made";
        return array('action'=>'Success', 'id'=>$last_id);
    } else {
         //return $failed="failed: " . $mysqli->error;
          
         return array('action'=>'failed', 'id'=>$last_id);
    }

}

}//the closing of class

?>