<?php 

class classTeacher extends Dbh{

public function allteacher($tablename, $orderfield, $order){
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

public function allteacheredit($tablename, $fieldname, $fieldvalue){
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


public function allteacheredit2($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1){
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

public function allteacheredit3($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2){
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

public function allteacheredit5($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2,  $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue and {$fieldname1}= :fieldvalue1  and {$fieldname2}= :fieldvalue2 and {$fieldname3}= :fieldvalue3 and {$fieldname4}= :fieldvalue4";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

public function allteacheredit6($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2,  $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue and {$fieldname1}= :fieldvalue1  and {$fieldname2}= :fieldvalue2 and {$fieldname3}= :fieldvalue3 and {$fieldname4}= :fieldvalue4  and {$fieldname5}= :fieldvalue5";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4, ':fieldvalue5'=>$fieldvalue5]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

public function allpositionedit5($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2,  $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue and {$fieldname1}= :fieldvalue1  and {$fieldname2}= :fieldvalue2 and {$fieldname3}= :fieldvalue3 and {$fieldname4}= :fieldvalue4";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

public function teacheredit3order($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $orderfield){
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

public function teacheredit4order($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3,  $orderfield, $ordertype){
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

public function teacheredit5order($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $orderfield, $ordertype){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue and {$fieldname1}= :fieldvalue1  and {$fieldname2}= :fieldvalue2  and {$fieldname3}= :fieldvalue3 and {$fieldname4}= :fieldvalue4 ORDER BY {$orderfield} {$ordertype}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1 , ':fieldvalue2'=>$fieldvalue2 , ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){ 
            $data[]=$row;
        }
        return $data;
    }

}


public function allteacheredit4($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3){
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

public function allposi4sort($positiontblname, $levelid, $optionid, $sessionid, $semesterid, $orderfield, $orderstyle){
    $mysqli = $this->connect();
    
     $sql = "SELECT * FROM {$positiontblname} WHERE levelid=:levelid and optionid=:optionid and sessionid=:sessionid and semesterid=:semesterid order by {$orderfield} {$orderstyle}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([':levelid'=>$levelid, ':optionid'=>$optionid, ':sessionid'=>$sessionid, ':semesterid'=>$semesterid]);
    while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;

}

public function allpositionedit4($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2,  $fieldname3, $fieldvalue3){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue and {$fieldname1}= :fieldvalue1  and {$fieldname2}= :fieldvalue2 and {$fieldname3}= :fieldvalue3";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3]);
     if($stmt->rowCount()){
        $numrow=$stmt->rowCount();
        return $numrow;
    }

}

public function allteacheredit7($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2,  $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5, $fieldname6, $fieldvalue6){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue and {$fieldname1}= :fieldvalue1  and {$fieldname2}= :fieldvalue2 and {$fieldname3}= :fieldvalue3 and {$fieldname4}= :fieldvalue4  and {$fieldname5}= :fieldvalue5  and {$fieldname6}= :fieldvalue6";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4, ':fieldvalue5'=>$fieldvalue5, ':fieldvalue6'=>$fieldvalue6]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }

}

public function allteacheredit8not($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2,  $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5, $fieldname6, $fieldvalue6, $fieldname7, $fieldvalue7){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue and {$fieldname1}= :fieldvalue1  and {$fieldname2}= :fieldvalue2 and {$fieldname3}= :fieldvalue3 and {$fieldname4}= :fieldvalue4  and {$fieldname5}= :fieldvalue5  and {$fieldname6}= :fieldvalue6 and {$fieldname7}!= :fieldvalue7";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3, ':fieldvalue4'=>$fieldvalue4, ':fieldvalue5'=>$fieldvalue5, ':fieldvalue6'=>$fieldvalue6, ':fieldvalue7'=>$fieldvalue7]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;
    }


}

//Selection of student Prepared result
public function positionresult_sel($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2,  $fieldname3, $fieldvalue3, $distnct_stid){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT DISTINCT {$distnct_stid} FROM {$tablename} WHERE {$fieldname}= :fieldvalue and {$fieldname1}= :fieldvalue1  and {$fieldname2}= :fieldvalue2 and {$fieldname3}= :fieldvalue3";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3]);
    while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;

}


    //Getting the grade and the remark
    public  function grade($request, $departmentid, $totalscore){

             $mysqli = $this->connect();
            $sql="SELECT * from grade WHERE departmentid=:departmentid";
            $stmt = $mysqli->prepare($sql);
            $stmt->execute([':departmentid'=>$departmentid]);
          
            if($stmt->rowCount()){

                while($row1=$stmt->fetch()){ 
                    
                     if($totalscore >= $row1["low"] and $totalscore <= $row1["high"]){
                      if($request=='grade'){
                      return $row1['gradeletter'];
                    }
                    if($request=='remark'){
                    return $row1['remark'];
                    
                    }
                    break;
                    }
             } 
            
            }
}


function allTables($tablename, $fieldname, $fieldvalue){
    $a=new Dbh;
    $mysqli = $a->connect();
    $sql="SELECT * FROM {$tablename} WHERE {$fieldname}=?";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([$fieldvalue]);

    if($row=$stmt->rowCount()){
        
        return $row;
    }else{
        return 0;
    }
$stmt->close;
}


}
// End of class title


?>

