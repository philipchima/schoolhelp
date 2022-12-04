<?php
	require_once 'includes/connection.php';
	 date_default_timezone_set("Africa/Lagos");
	 
	 
	//Updating of CBT Setup
	$action=trim(isset($_POST['action'])?$_POST['action']:false);
	if($action==1){

				
		$qid=trim(isset($_POST['qid'])?$_POST['qid']:false);
		
        $groupid=trim(isset($_POST['groupid'])?$_POST['groupid']:false); 
        $teacherid=trim(isset($_POST['teacherid'])?$_POST['teacherid']:false); 
		$totaltime = trim(isset($_POST['totaltime'])?$_POST['totaltime']:false);
		$passmark = trim(isset($_POST['passmark'])?$_POST['passmark']:false);
		$noquestion = trim(isset($_POST['noquestion'])?$_POST['noquestion']:false);
		$totalscore =trim(isset($_POST['totalscore'])?$_POST['totalscore']:false); 
		$usertype=2; // 2 represent Teachers and 1 represent Admin
		$status=0;
		$sdate=date("y-m-d");
		
	
			$stmt =$mysqli->query("UPDATE quiz_setup SET totaltime='$totaltime', totalscore='$totalscore', passmark='$passmark', no_of_question='$noquestion', usertype='$usertype', teacher_id='$teacherid', sdate='$sdate' WHERE qid='$qid'");
			
			
			if($stmt)
			{
				echo "Successfully Added";
			}
			else{
				echo "Query Problem";
			}	
		}
		
//Submittion of assessment score from term_score.php
if($action==2){

				
		$scorevalue=trim(isset($_POST['scorevalue'])?$_POST['scorevalue']:false);
        $scoreid=trim(isset($_POST['scoreid'])?$_POST['scoreid']:false); 
		$status=1;
        
			$stmt =$mysqli->query("UPDATE scores SET score='$scorevalue', status='$status' WHERE scoreid='$scoreid'");
			
			
			if($stmt)
			{
				echo "Successfully Added";
			}
			else{
				echo "Query Problem";
			}	
		}

if($action==3){

				
		
        $scoreid=trim(isset($_POST['scoreid'])?$_POST['scoreid']:false); 
		$status=1;
         
			$stmt =$mysqli->query("DELETE FROM scores WHERE scoreid='$scoreid'");
			
			
			if($stmt)
			{
				echo "Successfully Added";
			}
			else{
				echo "Query Problem";
			}	
		}
?>