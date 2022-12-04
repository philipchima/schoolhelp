<?php 


class insertTable extends Dbh{


//Inserting data to Session table
public function insert_news($topic, $content, $photoname, $operatorid,  $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO news SET topic=:topic, content=:content, photo=:photoname, operatorid=:operatorid, odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':topic'=>$topic, ':content'=>$content, ':photoname'=>$photoname, ':operatorid'=>$operatorid, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=> $failed, 'counting'=>0);
    }

}

//Inserting data to Session table
public function insert_testimony($title, $content, $photo, $operatorid, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO testimony SET title=:title, content=:content, photo=:photo, operatorid=:operatorid, odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':title'=>$title, ':content'=>$content, ':photo'=>$photo, ':operatorid'=>$operatorid, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=> $failed, 'counting'=>0);
    }

}

//Inserting data to Events table
public function insert_events($theme, $status, $brief, $duration, $venue, $link, $day, $month, $year, $photo, $poster, $operatorid, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO events SET theme=:theme, status=:status, brief=:brief, duration=:duration, venue=:venue, link=:link, day=:day, month=:month, year=:year, photo=:photo, poster=:poster, operatorid=:operatorid, odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':theme'=>$theme, ':status'=>$status, ':brief'=>$brief, ':duration'=>$duration, ':venue'=>$venue, ':link'=>$link, ':day'=>$day, ':month'=>$month, ':year'=>$year, ':photo'=>$photo, ':poster'=>$poster, ':operatorid'=>$operatorid, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=> $failed, 'counting'=>0);
    }

}

//Inserting data to Slides table
public function insert_slide($photo, $operatorid, $odate){

    $mysqli = $this->connect();

    $sql = ('INSERT INTO slide SET photo=:photo, operatorid=:operatorid, odate=:odate');

    $stmt = $mysqli->prepare($sql);

    if($stmt->execute([':photo'=>$photo, ':operatorid'=>$operatorid, ':odate'=>$odate])){
        
       
        return array('action'=>'Success', 'counting'=>1);
    } else {
         $failed="failed: " . $mysqli->error;
         return array('action'=> $failed, 'counting'=>0);
    }

}

}// End of class insertTable
?>