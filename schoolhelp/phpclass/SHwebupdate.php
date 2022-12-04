<?php 
include_once("../includes/connection.php");

class updateWeb extends Dbh{


public function update_news($newsid, $topic, $content,  $photoname, $operatorid){

    $mysqli = $this->connect();
    
    $sql =  ('UPDATE news SET topic=:topic, content=:content, photo=:photoname, operatorid=:operatorid WHERE newsid=:newsid');
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':newsid'=>$newsid, ':topic'=>$topic, ':content'=>$content, ':photoname'=>$photoname,  ':operatorid'=>$operatorid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}

public function update_testimony($tid, $title, $content,  $photoname, $operatorid){

    $mysqli = $this->connect();
    
    $sql =  ('UPDATE testimony SET title=:title, content=:content, photo=:photoname, operatorid=:operatorid WHERE tid=:tid');
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':tid'=>$tid, ':title'=>$title, ':content'=>$content, ':photoname'=>$photoname,  ':operatorid'=>$operatorid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}


public function update_events($eventid, $theme, $status, $brief, $duration, $venue, $link, $day, $month, $year, $photoname, $poster, $operatorid){

    $mysqli = $this->connect();
    
    $sql =  ('UPDATE events SET theme=:theme, status=:status, brief=:brief, duration=:duration, venue=:venue, link=:link, day=:day, month=:month, year=:year, photo=:photoname, poster=:poster, operatorid=:operatorid WHERE eventid=:eventid');
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':eventid'=>$eventid, ':theme'=>$theme, ':status'=>$status, ':brief'=>$brief, ':duration'=>$duration, ':venue'=>$venue, ':link'=>$link, ':day'=>$day, ':month'=>$month, ':year'=>$year, ':photoname'=>$photoname, ':poster'=>$poster,  ':operatorid'=>$operatorid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}


public function update_slide($id, $photoname, $operatorid){

    $mysqli = $this->connect();
    
    $sql =  ('UPDATE slide SET photo=:photoname, operatorid=:operatorid WHERE id=:id');
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':id'=>$id, ':photoname'=>$photoname, ':operatorid'=>$operatorid])){
        return "Success";
    } else {
        return "failed: " . $mysqli->error;
    }

}


//Newly added
public function delete_web($tablename, $fieldname, $fieldvalue){
    $mysqli = $this->connect();

     $sql = "DELETE FROM {$tablename} WHERE {$fieldname}=$fieldvalue";

    $stmt = $mysqli->prepare($sql);
    
     if($stmt->execute()){
        return "Success";
      } else {
        return "failed: " . $mysqli->error;
    }
        
    }


}// End of class department
?>