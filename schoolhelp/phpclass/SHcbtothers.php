<?php 

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


?>