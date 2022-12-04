<?php 

class classResult extends Dbh{

public function allresult($tablename, $orderfield, $order){
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

public function allresultedit($tablename, $fieldname, $fieldvalue){
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


public function allresultedit2($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1){
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

public function allresultedit3($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2){
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

public function allresultedit4($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT * FROM {$tablename} WHERE {$fieldname}= :fieldvalue and {$fieldname1}= :fieldvalue1  and {$fieldname2}= :fieldvalue2 and {$fieldname3}= :fieldvalue3";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3]);
     if($stmt->rowCount()){

        while($row=$stmt->fetch()){ 
            $data[]=$row;
        }
        return $data;
    }

}

public function allresultdistint1where1($tablename, $fieldname, $fieldvalue, $distnct_stid){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT DISTINCT {$distnct_stid} FROM {$tablename} WHERE {$fieldname}= :fieldvalue";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue]);
    while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;

}

public function allresultedit7($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2,  $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5, $fieldname6, $fieldvalue6){
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

public function allresultedit6($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2,  $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5){
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

public function allresultedit5($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2,  $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4){
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


//Selection of student Prepared result
public function positionresult_sel1($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2,  $fieldname3, $fieldvalue3, $distnct_stid, $orderfield, $orderstyle){
    $mysqli = $this->connect();
    $data="";
     $sql = "SELECT DISTINCT {$distnct_stid} FROM {$tablename} WHERE {$fieldname}= :fieldvalue and {$fieldname1}= :fieldvalue1  and {$fieldname2}= :fieldvalue2 and {$fieldname3}= :fieldvalue3 order by {$orderfield} {$orderstyle}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue, ':fieldvalue1'=>$fieldvalue1, ':fieldvalue2'=>$fieldvalue2, ':fieldvalue3'=>$fieldvalue3]);
    while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;

}

public function allposi4sort($positiontblname, $levelid, $optionid, $sessionid, $semesterid, $orderfield, $orderstyle){
    $mysqli = $this->connect();
    $data="";
    
     $sql = "SELECT * FROM {$positiontblname} WHERE levelid=:levelid and optionid=:optionid and sessionid=:sessionid and semesterid=:semesterid order by {$orderfield} {$orderstyle}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([':levelid'=>$levelid, ':optionid'=>$optionid, ':sessionid'=>$sessionid, ':semesterid'=>$semesterid]);
    while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;

}

public function allposi3sort($positiontblname, $levelid, $sessionid, $semesterid, $orderfield, $orderstyle){
    $mysqli = $this->connect();
    $data="";
    
     $sql = "SELECT * FROM {$positiontblname} WHERE levelid=:levelid and sessionid=:sessionid and semesterid=:semesterid order by {$orderfield} {$orderstyle}";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([':levelid'=>$levelid, ':sessionid'=>$sessionid, ':semesterid'=>$semesterid]);
    while($row=$stmt->fetch()){
            $data[]=$row;
        }
        return $data;

}

public function allresultedit8not($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2,  $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5, $fieldname6, $fieldvalue6, $fieldname7, $fieldvalue7){
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


 //Getting the comment
    public  function listselection($tablename, $signatorypositionid, $totalscore){

             $mysqli = $this->connect();
            $sql="SELECT * from {$tablename} WHERE signatorypositionid=:signatorypositionid";
            $stmt = $mysqli->prepare($sql);
            $stmt->execute([':signatorypositionid'=>$signatorypositionid]);
          
            if($stmt->rowCount()){

                while($row1=$stmt->fetch()){ 
                    
                         if($totalscore >= $row1["low"] and $totalscore <= $row1["high"]){
                        
                          return $row1['comment'];
    
                        break;
                        }
                 } 
                
            }
    }


//result Computations for report card checking result score is presence
public  function subtable($sessionid, $semesterid, $stid, $levelid, $subject, $scoretablename, $resultstatus){
        $mysqli = $this->connect();

        if($semesterid==1){
             $sql="SELECT * from {$scoretablename} where stid =:stid and levelid=:levelid and semesterid=:semesterid and sessionid=:sessionid and courseid=:subject and score!='' ";
            $stmt = $mysqli->prepare($sql);

            $stmt->execute([':stid'=>$stid,  ':levelid'=>$levelid, ':semesterid'=>1, ':sessionid'=>$sessionid,  ':subject'=>$subject]);
        
          }  
          if($semesterid==2){
            if ($resultstatus==1) {
               $sql="SELECT * from {$scoretablename} where stid =:stid and levelid=:levelid and semesterid=:semesterid and sessionid=:sessionid and courseid=:subject and score!='' ";
            $stmt = $mysqli->prepare($sql);

            $stmt->execute([':stid'=>$stid, ':levelid'=>$levelid, ':semesterid'=>$semesterid,  ':sessionid'=>$sessionid,  ':subject'=>$subject]);
            }else{
            $sql="SELECT * from {$scoretablename} where stid =:stid and levelid=:levelid and (semesterid=:semesterid or semesterid=:semesterid1) and sessionid=:sessionid and courseid=:subject and score!='' ";
            $stmt = $mysqli->prepare($sql);

            $stmt->execute([':stid'=>$stid, ':levelid'=>$levelid, ':semesterid'=>1, ':semesterid1'=>2, ':sessionid'=>$sessionid,  ':subject'=>$subject]);
            }
        }
          
           if($semesterid==3){
            if ($resultstatus==1) {
            $sql="SELECT * from {$scoretablename} where stid =:stid and levelid=:levelid and semesterid=:semesterid and sessionid=:sessionid and courseid=:subject and score!='' ";
            $stmt = $mysqli->prepare($sql);

            $stmt->execute([':stid'=>$stid, ':levelid'=>$levelid, ':semesterid'=>$semesterid, ':sessionid'=>$sessionid, ':subject'=>$subject]);
             }else{
               $sql="SELECT * from {$scoretablename} where stid =:stid and levelid=:levelid and (semesterid=:semesterid or semesterid=:semesterid1 or  semesterid=:semesterid2) and sessionid=:sessionid and courseid=:subject and score!='' ";
            $stmt = $mysqli->prepare($sql);

            $stmt->execute([':stid'=>$stid, ':levelid'=>$levelid, ':semesterid'=>1, ':semesterid1'=>2, ':semesterid2'=>$semesterid, ':sessionid'=>$sessionid,  ':subject'=>$subject]);
             }

          }  
                           $row=$stmt->rowCount();
                          
                        if($row > 0){
                            
                            return 1;
                        }else{
                             return 0; 
                     }
                        

            }

        public function stusubjecttotalscore($resulttablename, $stid, $subject, $levelid, $optionid, $semesterid, $sessionid){
                $mysqli = $this->connect();
           
             $sql="SELECT * from {$resulttablename} where stid=:stid and levelid=:levelid and optionid=:optionid and semesterid=:semesterid  and sessionid=:sessionid and courseid=:subject";
            $stmt = $mysqli->prepare($sql);

            $stmt->execute([':stid'=>$stid, ':levelid'=>$levelid, ':optionid'=>$optionid, ':semesterid'=>$semesterid, ':sessionid'=>$sessionid, ':subject'=>$subject]);
             if($stmt->rowCount()){

                while($row=$stmt->fetch()){
                    $data[]=$row;
                }
                return $data;
            }

           
        }

        //Getting Assessment Score
          public function assessmentscores($scoretablename, $stid, $subject, $levelid, $optionid, $semesterid, $sessionid, $assessmentid){
                $mysqli = $this->connect();
           
             $sql="SELECT * from {$scoretablename} where stid=:stid and levelid=:levelid and optionid=:optionid and semesterid=:semesterid  and sessionid=:sessionid and courseid=:subject and assessmentid=:assessmentid";
            $stmt = $mysqli->prepare($sql);

            $stmt->execute([':stid'=>$stid, ':levelid'=>$levelid, ':optionid'=>$optionid, ':semesterid'=>$semesterid, ':sessionid'=>$sessionid, ':subject'=>$subject, ':assessmentid'=>$assessmentid]);
             if($stmt->rowCount()){

                while($row=$stmt->fetch()){
                    $data[]=$row;
                }
                return $data;
            }

           
        }

        //Total Subject Score for all student
         public function subjecttotalscore($resulttablename, $subject, $levelid, $optionid, $semesterid, $sessionid){
                $mysqli = $this->connect();
           
             $sql="SELECT * from {$resulttablename} where levelid=:levelid and optionid=:optionid and semesterid=:semesterid and sessionid=:sessionid and courseid=:subject";
            $stmt = $mysqli->prepare($sql);

            $stmt->execute([':levelid'=>$levelid, ':optionid'=>$optionid, ':semesterid'=>$semesterid, ':sessionid'=>$sessionid, ':subject'=>$subject]);
             if($stmt->rowCount()){

                while($row=$stmt->fetch()){
                    $data[]=$row;
                }
                return $data;
            }

           
        }
        
         //Total Subject Score for all student
         public function stusubjecttotalscore1($resulttablename, $stuid, $subject, $levelid, $optionid, $semesterid, $sessionid){
                $mysqli = $this->connect();
           
             $sql="SELECT * from {$resulttablename} where levelid=:levelid and optionid=:optionid and semesterid=:semesterid and sessionid=:sessionid and courseid=:subject and stid=:stid";
            $stmt = $mysqli->prepare($sql);

            $stmt->execute([':levelid'=>$levelid, ':optionid'=>$optionid, ':semesterid'=>$semesterid, ':sessionid'=>$sessionid, ':subject'=>$subject, ':stid'=>$stuid]);
             if($stmt->rowCount()){

                while($row=$stmt->fetch()){
                    $data[]=$row;
                }
                return $data;
            }

           
        }

        //Total Subject Score for all student
         public function manuallyaddfees($semesterid, $sessionid, $levelid, $stid){
                $mysqli = $this->connect();
           
             $sql="SELECT * from manuallyaddfees where levelid=:levelid and stid=:stid and semesterid=:semesterid and sessionid=:sessionid";
            $stmt = $mysqli->prepare($sql);

            $stmt->execute([':levelid'=>$levelid, ':stid'=>$stid, ':semesterid'=>$semesterid, ':sessionid'=>$sessionid]);
             if($stmt->rowCount()){

                while($row=$stmt->fetch()){
                    $data[]=$row;
                }
                return $data;
            }

           
        }

         public function studenttermscore($tablename, $stid, $levelid, $semesterid, $sessionid){
                $mysqli = $this->connect();
          $sql="SELECT * from {$tablename} where stid =:stid and levelid=:levelid and semesterid=:semesterid and sessionid=:sessionid and score!='' ";
           
            $stmt = $mysqli->prepare($sql);

            $stmt->execute([':stid'=>$stid, ':levelid'=>$levelid,  ':semesterid'=>$semesterid, ':sessionid'=>$sessionid]);
             if($stmt->rowCount()){

                while($row=$stmt->fetch()){
                    $data[]=$row;
                }
                return $data;
            }

          }


          // Checking where level is greater than
           public function greaterlevelorder($tablename, $fieldname, $fieldvalue, $orderfield, $order){
            $mysqli = $this->connect();
            $sql="SELECT * from {$tablename} where {$fieldname} >=:fieldvalue order by $orderfield $order";
           
            $stmt = $mysqli->prepare($sql);

            $stmt->execute([':fieldvalue'=>$fieldvalue]);
             if($stmt->rowCount()){

                while($row=$stmt->fetch()){
                    $data[]=$row;
                }
                return $data;
            }

          }

}// End of class


?>
