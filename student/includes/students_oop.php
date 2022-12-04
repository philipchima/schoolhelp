<?php

/*==================================================================
====  This page is full of classes that will help us display =======
====  content of a particular table ===============================*/
 include_once("connection.php");

 //chechecking the offered Subject
class subjectcheck{

public static function resultsample(){
		$mysqli = connsetup::con();
	$select_contentd=("select * from resultsample where resultsampleid='1'");
$content_resultd= mysqli_query($mysqli, $select_contentd) or die (mysqli_error($mysqli));
$contentd = mysqli_fetch_assoc($content_resultd);
$num_chkd = mysqli_num_rows ($content_resultd);
	if($num_chkd >0){
		return $contentd['resultname'];
			
	}
	

}
	public static function subtable($yearb, $term, $stid, $classv, $subject){
		$mysqli = connsetup::con();

		if($term==1){
		  $content_result4=$mysqli->query("select * from scores where sid ='$stid' and class='$classv' and term=1 and year='$yearb' and subject='$subject' and score!=''")or die ($mysqli->error());
          }  
          if($term==2){
		  $content_result4=$mysqli->query("select * from scores where sid ='$stid' and class='$classv' and (term=1 or term=2) and year='$yearb' and subject='$subject' and score!=''")or die ($mysqli->error());
          } 
           if($term==3){
		  $content_result4=$mysqli->query("select * from scores where sid ='$stid' and class='$classv' and (term=1 or term=2 or term=3) and year='$yearb' and subject='$subject' and score!=''")or die ($mysqli->error());
          }  
                            
                        $content4 = $content_result4->fetch_assoc();
                        $num_chk4 = $content_result4->num_rows ;
						if($num_chk4 > 0){
							
							return 1;
							}else{ return 0; }
							
					
			              
						$content4->free();
						$mysqli->close();


						}
		
	public static function subjectscore($yearb, $term, $stid, $classv){
		$mysqli = connsetup::con();

		if($term==1){
		  $content_result4=$mysqli->query("select * from results where sid ='$stid' and class='$classv' and term=1 and year='$yearb' and score!=''")or die ($mysqli->error());
          }  
          if($term==2){
		  $content_result4=$mysqli->query("select * from results where sid ='$stid' and class='$classv' and (term=1 or term=2) and year='$yearb' and score!=''")or die ($mysqli->error());
          } 
           if($term==3){
		  $content_result4=$mysqli->query("select * from results where sid ='$stid' and class='$classv' and (term=1 or term=2 or term=3) and year='$yearb' and score!=''")or die ($mysqli->error());
          }  
                            
                        $content4 = $content_result4->fetch_assoc();
                        $num_chk4 = $content_result4->num_rows ;
                        $k=0;
						if($num_chk4 > 0){
							do  {
								$k+=1;
							}while($content4 = $content_result4->fetch_assoc());
							}
							
							return $k;
					
			              
						$content4->free();
						$mysqli->close();


					}

						public static function histogram($yearb, $term, $stid, $classv, $subject){
		$mysqli = connsetup::con();

		  $content_result4=$mysqli->query("select * from scores where sid ='$stid' and class='$classv' and term=1 and year='$yearb' and subject='$subject' and score!=''")or die ($mysqli->error());
                     
                        $content4 = $content_result4->fetch_assoc();
                        $num_chk4 = $content_result4->num_rows ;
						if($num_chk4 > 0){
							
							return 1;
							}else{ return 0; }
							
					
			              
						$content4->free();
						$mysqli->close();


						}
		}


//student classtable: collection of information from mentioned table
	class Studentclass{
		
	public static function classtable_func($classid, $ctdemand){
		$mysqli = connsetup::con();
		  $content_result4=$mysqli->query("select * from classes where id ='$classid'")or die ($mysqli->error());
                                
                        $content4 = $content_result4->fetch_assoc();
                        $num_chk4 = $content_result4->num_rows ;
						if($num_chk4 > 0){
							if($ctdemand=="schoolid"){
							return $content4["schoolid"];
							}
							
							
						/*else{ echo "<script language='javascript'>
										location.href='../index'
									</script>"; */
						
				                    
						$content4->free();
						$mysqli->close();
						}
		}
		
		//Retrieving  CBT Subjects 
		public static function subjecttable_func($subject, $ctdemand){
		$mysqli = connsetup::con();
								  	$select_content3=("select * from subjects where sid='$subject'");
									$content_result3= mysqli_query($mysqli, $select_content3) or die (mysqli_error($mysqli));
									$content3 = mysqli_fetch_assoc($content_result3);
									$num_chk4=mysqli_num_rows($content_result3);
						if($num_chk4 > 0){
							if($ctdemand=="subjectname"){
							return $content3["subject"];
							}
						
				                    
						$content3->free();
						$mysqli->close();
						}
		}
			
		
		//Retrieving CBT details
		public static function quizsetup($classid, $schoolid, $subjectid, $groupid,  $termid, $sessionid, $demand){
		$mysqli = connsetup::con();
		   $select_content1=("select * from quiz_setup where class_id='$classid' and schoolid='$schoolid' and group_id='$groupid' and termid='$termid' and sessionid='$sessionid' and subject_id='$subjectid'");
												  $content_result1= mysqli_query($mysqli, $select_content1) or die (mysqli_error($mysqli));
												  $content1 = mysqli_fetch_assoc($content_result1);
                          $num_class = mysqli_num_rows($content_result1);
						if($num_class > 0){
							if($demand=='totalquestion'){
								return $content1['no_of_question'];
								}
								if($demand=='passmark'){
								return $content1['passmark'];
								}
								if($demand=='totalscore'){
								return $content1['totalscore'];
								}
								if($demand=='totaltime'){
								return $content1['totaltime'];
								}
								if($demand=='quizsetupid'){
								return $content1['qid'];
								}
							
						}
				                    
						$content_result1->free();
						$mysqli->close();
		}
		
	
		
	}//end of class
	
	

//Class Information
class Classesinfo{
	public static function classes_func($classid, $demand){
		$mysqli = connsetup::con();
		  $content_result=$mysqli->query("select * from classes WHERE id='$classid'")or die ($mysqli->error());
                                
                                $content=$content_result->fetch_assoc();
                                $num_chk = $content_result->num_rows ;
						if($num_chk > 0){
							if($demand=="schoolid"){
							return $content['schoolid'];
							}
							if($demand=="schoolname"){
							return $content['classid'];
							}
						}
						$content->free();
						$mysqli->close();
		}
	}


//Collect Subject teacher Information
class quizinfo{
	
	public static function quizsetup($quizsetupid, $request){
		$mysqli = connsetup::con();
		
		$quizquery=$mysqli->query("select * from quiz_setup qs INNER JOIN classes cs on qs.class_id=cs.id INNER JOIN subjects sbj on qs.subject_id=sbj.sid INNER JOIN groups gp on qs.group_id=gp.gid where qid='$quizsetupid'"); 
						$quizresult=$quizquery->fetch_assoc();
						$quizrow=$quizquery->num_rows;
						if($quizrow > 0){
							if($request=='classid'){
							return $quizresult['class_id'];
							}
							if($request=='classname'){
							return $quizresult['classname'];
							}
							if($request=='schoolid'){
							return $quizresult['schoolid'];
							}
							if($request=='groupid'){
							return $quizresult['group_id'];
							}
							if($request=='groupname'){
							return $quizresult['groupname'];
							}
							if($request=='termid'){
							return $quizresult['termid'];
							}
							if($request=='sessionid'){
							return $quizresult['sessionid'];
							}
							if($request=='subjectid'){
							return $quizresult['subject_id'];
							}
							if($request=='subjectname'){
							return $quizresult['subject'];
							}
							if($request=='totaltime'){
							return $quizresult['totaltime'];
							}
							if($request=='totalscore'){
							return $quizresult['totalscore'];
							}
							if($request=='passmark'){
							return $quizresult['passmark'];
							}
							if($request=='no_of_question'){
							return $quizresult['no_of_question'];
							}
						}
						
						$quizquery->free();
						$mysqli->close();
		}
		
		public static function quiz_result_timer($quizsetupid, $stid, $totaltime, $request){
		$mysqli = connsetup::con();
		
		$quiz_result_query=$mysqli->query("select * from quiz_result_timer where qsetupid='$quizsetupid' and stuid='$stid'"); 
						$quizresult=$quiz_result_query->fetch_assoc();
						$quizrow=$quiz_result_query->num_rows;
						if($quizrow > 0){
							if($request=="questime"){
							return $quizresult['questime'];
							}
							if($request=="status"){
							return $quizresult['status'];
							}
							if($request=="remainingtime"){
							return $quizresult['questime'];
							}
						}else{ 
						if($request=="questime"){
						mysqli_query($mysqli,"insert into quiz_result_timer set qsetupid='$quizsetupid', stuid='$stid', questime='$totaltime', status='0'");
						return $totaltime;
						}
						if($request=="status"){
							mysqli_query($mysqli,"updtate quiz_result_timer set qsetupid='$quizsetupid', stuid='$stid', questime='$totaltime', status='0' where qsetupid='$quizsetupid' and stuid='$stid'");
						
						return 0;
						}
						}
						
						$quiz_result_query->free();
						$mysqli->close();
		}
		
		public static function quiz_question($quizsetupid, $request){
		$mysqli = connsetup::con();
		
		$quiz_question_query=$mysqli->query("select * from quiz_question where quiz_setup_id='$quizsetupid'"); 
						$quizquestion=$quiz_question_query->fetch_assoc();
						$quizquestionrow=$quiz_question_query->num_rows;
						if($quizquestionrow > 0){
							if($request=='no_of_question'){
							return $quizquestionrow;
							}
							
						}else{ return $quizquestionrow;}
						
						$quiz_question_query->free();
						$mysqli->close();
		}
		
		public static function quiz_result($quizsetupid, $stid, $request){
		$mysqli = connsetup::con();
		
		$quiz_result_query=$mysqli->query("select * from quiz_result where qsid='$quizsetupid' and sid='$stid'"); 
						$quizresult=$quiz_result_query->fetch_assoc();
						$quizresultrow=$quiz_result_query->num_rows;
						if($quizresultrow > 0){
							if($request=='no_of_answered'){
							return $quizresultrow;
							}
							
						}else{
							if($request=='no_of_answered'){
							return $quizresultrow;
							}
							}
						
						$quiz_result_query->free();
						$mysqli->close();
		}
		
		//checking answered question
		public static function quiz_result_check($quizsetupid, $stid, $quesid, $request){
		$mysqli = connsetup::con();
		
		$quiz_result_query=$mysqli->query("select * from quiz_result where qsid='$quizsetupid' and sid='$stid' and quesid='$quesid'"); 
						$quizresult=$quiz_result_query->fetch_assoc();
						$quizresultrow=$quiz_result_query->num_rows;
						if($quizresultrow > 0){
							if($request=='validity'){
							return 0;
							}
							
						}else{
							if($request=='validity'){
							return 1;
							}
							}
						
						$quiz_result_query->free();
						$mysqli->close();
		}

		//Retreiving CBT Result
		public static function quiz_result_detail($quizsetupid, $stid, $setnoques, $request){
		$mysqli = connsetup::con();
		
		$quiz_result_query=$mysqli->query("select * from quiz_result where qsid='$quizsetupid' and sid='$stid' ORDER BY rid ASC LIMIT $setnoques")or die(mysqli_error($mysqli)); 
						$quizresult=$quiz_result_query->fetch_assoc();
						$quizresultrow=$quiz_result_query->num_rows;
						$correctans=0;
						$notanswered=0;
						$wronganswer=0;
						if($quizresultrow > 0){
							do{
								$qsid=$quizresult['qsid'];
								$quesid=$quizresult['quesid'];
								$answer=$quizresult['answer'];
								$quiz_question_query=$mysqli->query("select * from quiz_question where quiz_setup_id='$quizsetupid' and quiz_ques_id='$quesid'")or die(mysqli_error($mysqli)); 
						$quizquestion=$quiz_question_query->fetch_assoc();
						$quizquestionrow=$quiz_question_query->num_rows;
						if($quizquestionrow > 0){
							if($answer==5){
								$notanswered+=1;
								}
							elseif($answer==$quizquestion['ans']){
								$correctans+=1;
								}
							else{
								$wronganswer+=1;
								}
							}
								
							}while($quizresult=$quiz_result_query->fetch_assoc());
							if($request=='notanswered'){
								return $notanswered;
								}
								if($request=='correctans'){
								return $correctans;
								}
								if($request=='wronganswer'){
								return $wronganswer;
								}
							}
						$quiz_result_query->free();
						$mysqli->close();
		}

		
	}

//Collect Admin Information
class admininfo{
	public static function admin($adminid, $request){
		$mysqli = connsetup::con();
		$admin_query=$mysqli->query("SELECT * FROM systemusers WHERE id='$adminid'"); 
						$adminresult=$admin_query->fetch_assoc();
						$admin_row=$admin_query->num_rows;
						if($admin_row > 0){
							if($request=="names"){
							echo $adminresult['surname'] . " " . $adminresult['fname'];
							}
						}else{ echo "No Approved Person yet or Record Moved";}
						$admin_query->free();
						$mysqli->close();
		}
		
		
	}
	
	//Accumulating Average of the available semester to get the position of a student
	 
class average{
	public static function studentaverage($demand, $stid, $term, $cgroup, $yeardb, $classv){
		$mysqli = connsetup::con();
			$position1=array();
		$k=0;
		$admin_query=mysqli_query($mysqli, "SELECT * FROM resultposition WHERE class='$classv' and cgroup='$cgroup' and year='$yeardb' and term='$term'")or die(mysqli_error($mysqli)); 
						$adminresult=mysqli_fetch_assoc($admin_query);
						
						do {
								$average=0;
								$i=1;
								$sid=trim($adminresult['sid']);
								while($i<=$term){
								
								$admin_query1=$mysqli->query("SELECT * FROM resultposition WHERE class='$classv' and sid='$sid' and cgroup='$cgroup' and year='$yeardb' and term='$i'"); 
								$adminresult1=$admin_query1->fetch_assoc();
								$average+=$adminresult1['average'];
								$i+=1;
								}
								
								//store in an array
								$position1[$sid]=$average;
						}while($adminresult=mysqli_fetch_assoc($admin_query));
						
						arsort($position1);
						foreach($position1 as $key=> $averagevalue){
						$k+=1;

						if($key==$stid){
						return $k;
						break;
						}
						
						}
						
						$admin_query->free();
						$mysqli->close();
		}
		
		
	}

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


class Date_Selected{
	public static function seldate($mdate){
			if($mdate=="yyyy-MM-dd" or $mdate=="" ){
			$mdate=date("Y-m-d");
			return $mdate;
			} else{
				$mdate=date("Y-m-d");
				return $mdate;
				}
		}
		
		public static function termperiod($termid, $sessid, $request){
		$mysqli = connsetup::con();
		$date_query=$mysqli->query("SELECT * FROM term_ending_date WHERE termid='$termid' and sessionid='$sessid'"); 
						$dateresult=$date_query->fetch_assoc();
						$date_row=$date_query->num_rows;
						if($date_row > 0){
							if($request=="startdate"){
							return $mdate=date('Y-m-d',strtotime($dateresult['begins']));
							}
							if($request=="enddate"){
							return $mdate=date('Y-m-d',strtotime($dateresult['ends']));
							
							}
						}else{ return 0;}
						$date_query->free();
						$mysqli->close();
		}
		
	
	}
	
	
	


?>