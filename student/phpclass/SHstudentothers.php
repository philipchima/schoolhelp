 <?php
  
//converting CBT time to minute
class cbt_time_conversion{
public static function to_seconds($totaltime){
    if($totaltime!=""){
                $a=0;
                $hours=0;
                $minutes=0;
                $seconds=0; 
                $s = explode(":",$totaltime);
                foreach($s as $k=>$v){
                    if($k==0){
                        $hours=60*60*$v;
                        }
                    if($k==1){
                        $minutes=60*$v;
                        }
                    if($k==2){
                        $seconds=$hours+$minutes+$v;
                        }
                }
                return $seconds;
            }
            }
            
            public static function completetime($seconds){
                
              $t = round($seconds);
              return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);

                }

}


 class Others{
    
 public static function studenttypename($typeid){
    if ($typeid==1) {
        return "Daytime|Partime";
    }
     if ($typeid==2) {
        return "Boarder|Full Time";
    }else{
         return "";
    }

    }

 public static function stafftypename($staffid){
    if ($staffid==1) {
        return "Academic";
    }
     if ($staffid==2) {
        return "Non Academic";
    }else{
         return "";
    }

    }

public static function sexname($sexid){
    if ($sexid==1) {
        return "Male";
    }
     if ($sexid==2) {
        return "Female";
    }else{
         return "";
    }

    }


public static function passwordconvert($password){
$password1=md5($password);
$password2=sha1($password1);
$password3=md5($password2);
return $password3;
}

}

?>