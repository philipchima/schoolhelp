<?php 

class classBusary extends Dbh{

public function allbusary($tablename, $orderfield, $order){
    $mysqli = $this->connect();
    $sql="SELECT * FROM {$tablename} order by {$orderfield} {$order}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()){
        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

public function allbusaryorder2($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $orderfield, $order){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue and {$fieldname1}= :fieldvalue1 order by {$orderfield} {$order}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

public function allbusaryorder3($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $orderfield, $order){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue and {$fieldname1}= :fieldvalue1 and {$fieldname2}= :fieldvalue2 order by {$orderfield} {$order}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

public function allbusaryorder($tablename, $fieldname, $fieldvalue, $orderfield, $order){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue order by {$orderfield} {$order}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

public function allbusaryedit($tablename, $fieldname, $fieldvalue){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

public function allbusaryedit4($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue and {$fieldname1}= :fieldvalue1  and {$fieldname2}= :fieldvalue2 and {$fieldname3}= :fieldvalue3";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1 , ':fieldvalue2'=>$fieldvalue2 , ':fieldvalue3'=>$fieldvalue3]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){ 
            $data[]=$row;
        }
        return $data;
    }

}

public function allbusaryedit3($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue and {$fieldname1}= :fieldvalue1  and {$fieldname2}= :fieldvalue2";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1 , ':fieldvalue2'=>$fieldvalue2]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){ 
            $data[]=$row;
        }
        return $data;
    }

}

public function allbusaryedit5($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue and {$fieldname1}= :fieldvalue1  and {$fieldname2}= :fieldvalue2 and {$fieldname3}= :fieldvalue3 and {$fieldname4}= :fieldvalue4";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1 , ':fieldvalue2'=>$fieldvalue2 , ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){ 
            $data[]=$row;
        }
        return $data;
    }

}


public function busaryedit3order($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $orderfield){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue and {$fieldname1}= :fieldvalue1  and {$fieldname2}= :fieldvalue2 ORDER BY {$orderfield}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1 , ':fieldvalue2'=>$fieldvalue2]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){ 
            $data[]=$row;
        }
        return $data;
    }

}


public function allbusaryedit2($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue and {$fieldname1}= :fieldvalue1";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

public function allbusaryedit2or($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue or {$fieldname1}= :fieldvalue1";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

public function allbusaryedit3or1($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue or {$fieldname1}= :fieldvalue1 and {$fieldname2}= :fieldvalue2";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

//Customized Method
public function alltorderdistinct0($tablename, $orderfield, $order, $distinctfield){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT distinct {$distinctfield} FROM {$tablename}  order by {$orderfield} {$order}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

//Customized Method
public function alltorder2distinct($tablename, $orderfield, $order, $distinctfield, $distinctfield1){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT distinct {$distinctfield}, {$distinctfield1} FROM {$tablename}  order by {$orderfield} {$order}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

//Customized Method
public function alltorderdistinct($tablename, $fieldname, $fieldvalue, $orderfield, $order, $distinctfield){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT distinct a{$distinctfield} FROM {$tablename} AS d INNER JOIN {$tablename1} AS tw ON d.timetableweekid=tw.timetableweekid WHERE dailytimetable.{$fieldname}= :fieldvalue order by {$orderfield} {$order}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

//Customized Method
public function alltableorderdistinct($tablename, $fieldname, $fieldvalue,  $orderfield, $order, $distinctfield){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT distinct {$distinctfield} FROM {$tablename}  WHERE {$fieldname}= :fieldvalue order by {$orderfield} {$order}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([':fieldvalue'=>$fieldvalue]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }
}

//Customized Method
public function alltorderdistinct2($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $orderfield, $order, $distinctfield){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT distinct {$distinctfield} FROM {$tablename}  WHERE {$fieldname}= :fieldvalue and {$fieldname1}= :fieldvalue1 order by {$orderfield} {$order}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

}// End of class title


?>