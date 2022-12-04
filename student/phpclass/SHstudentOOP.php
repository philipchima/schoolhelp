<?php 
include "../schoolhelp/includes/connection.php"; 
class classStudent extends Dbh{

    public function alldistinct($tablename, $fieldname, $fieldvalue, $orderfield, $order){
    $mysqli = $this->connect();
    $sql="SELECT DISTINCT $orderfield FROM {$tablename} WHERE order {$fieldname}=$fieldvalue by {$orderfield} {$order}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()){
        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

   

public function allstudent($tablename, $orderfield, $order){
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

public function allstudentedit($tablename, $fieldname, $fieldvalue){
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

public function allstudenteditunion($tablename, $fieldname, $fieldvalue, $distinctrec){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT {$distinctrec} FROM {$tablename} WHERE {$fieldname}= :fieldvalue 
     UNION
     SELECT {$distinctrec} FROM earlycmentattend WHERE {$fieldname}= :fieldvalue";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

// Selection of cbt question
public function allstudenteditrand($tablename, $fieldname, $fieldvalue){
    $mysqli = $this->connect();
    $data="";
     $sql ="SELECT * FROM {$tablename}  WHERE {$fieldname}= :fieldvalue  ORDER BY RAND() LIMIT 0,1";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}


public function allstudentedit2($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1){
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

public function allstudentedit2order($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $orderfield, $order, $questionlimit){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}=:fieldvalue and {$fieldname1}=:fieldvalue1 order by {$orderfield} {$order} LIMIT {$questionlimit}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

public function allstudentedit3($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2){
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


public function allstudentedit4($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3){
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


public function studentedit4order($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3,  $orderfield, $ordertype){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue and {$fieldname1}= :fieldvalue1  and {$fieldname2}= :fieldvalue2  and {$fieldname3}= :fieldvalue3  ORDER BY {$orderfield} {$ordertype}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1 , ':fieldvalue2'=>$fieldvalue2 , ':fieldvalue3'=>$fieldvalue3]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){ 
            $data[]=$row;
        }
        return $data;
    }

}

}
// End of class title


?>

