<?php
	
	 date_default_timezone_set("Africa/Lagos");
	 include_once "phpclass/SHstudentothers.php";
	 include_once "phpclass/SHstudentOOP.php";
	  include_once "phpclass/SHstudentupdate.php";
	  include_once "phpclass/SHstudentinserts.php";
	  $SHstudentupdate=new updateTable;	
	  $SHstudentinsert=new insertTable;	 
	   $SHstudent=new classStudent;
	
	$action=trim(isset($_POST['action'])?$_POST['action']:false);
	if($action==1){
		
		$quesid=trim(isset($_POST['quesid'])?$_POST['quesid']:false);
		
        $answeredid=trim(isset($_POST['answeredid'])?$_POST['answeredid']:false); 
        $quessetupid=trim(isset($_POST['quessetupid'])?$_POST['quessetupid']:false); 
		$stid = trim(isset($_POST['stid'])?$_POST['stid']:false);
		$quesserialno = trim(isset($_POST['quesserialno'])?$_POST['quesserialno']:false);
		$timeremaining= trim(isset($_POST['timeremaining'])?$_POST['timeremaining']:false);
		$returntime=cbt_time_conversion::completetime($timeremaining);
	
			$totalstuansweredques=$SHstudent->allstudentedit3('quiz_result', 'qsid', $quessetupid, 'quesid', $quesid, 'stid', $stid);
			if (is_array($totalstuansweredques)) {
			
			//$stmt_content=$stmt->fetch_assoc();
			//$stmt_row=$stmt->num_rows;
			
			//echo "Updating Quiz Result".	
				$stmt1=$SHstudentupdate->update_fourfieldscheck3('quiz_result', 'qsid', $quessetupid, 'quesid', $quesid, 'stid', $stid, 'qsid',  $quessetupid, 'quesid',  $quesid, 'answer',  $answeredid, 'stid',  $stid);
			
			//$stmt1=$mysqli->query("UPDATE quiz_result SET qsid='$quessetupid', quesid='$quesid', answer='$answeredid', sid='$stid' WHERE qsid='$quessetupid' and quesid='$quesid' and sid='$stid'") or die(mysqli_error($mysqli));
				//Updating quiz result timer
				$stmt2=$SHstudentupdate->update_onefieldscheck2('quiz_result_timer', 'qsetupid', $quessetupid, 'stid', $stid, 'questime', $returntime);
				
				//$stmt2 =$mysqli->query("UPDATE quiz_result_timer SET questime='$returntime' WHERE qsetupid='$quessetupid' and stuid='$stid'") or die(mysqli_error($mysqli));
			}
			else{
				//"inserting quiz result"
				$stmt3 =$SHstudentinsert->insert_4fields('quiz_result', 'qsid', $quessetupid, 'quesid', $quesid, 'answer', $answeredid, 'stid', $stid);

				//$stmt3 =$mysqli->query("INSERT INTO quiz_result SET qsid='$quessetupid', quesid='$quesid', answer='$answeredid', sid='$stid'") or die(mysqli_error($mysqli));
				//"Updating quiz result timer"
				$stmt4=$SHstudentupdate->update_onefieldscheck2('quiz_result_timer', 'qsetupid', $quessetupid, 'stid', $stid, 'questime', $returntime);
				//$stmt4 =$mysqli->query("UPDATE quiz_result_timer SET questime='$returntime' WHERE qsetupid='$quessetupid' and stuid='$stid'") or die(mysqli_error($mysqli));
			}	
		}
		//Updating of CBT Setup
if($action==2){

				
		$quesid=trim(isset($_POST['quesid'])?$_POST['quesid']:false);
		$status=0;
        $answeredid=trim(isset($_POST['answeredid'])?$_POST['answeredid']:false); 
        $quessetupid=trim(isset($_POST['quessetupid'])?$_POST['quessetupid']:false); 
		$stid = trim(isset($_POST['stid'])?$_POST['stid']:false);
		$quesserialno = trim(isset($_POST['quesserialno'])?$_POST['quesserialno']:false);
		$timeremaining= trim(isset($_POST['timeremaining'])?$_POST['timeremaining']:false);
		$returntime=cbt_time_conversion::completetime($timeremaining);
	

		$stmt=$SHstudent->allstudentedit2('quiz_result_timer', 'qsetupid', $quessetupid, 'stid', $stid);
		if (is_array($stmt)) {

			//$stmt =$mysqli->query("SELECT * from quiz_result_timer WHERE qsetupid='$quessetupid' and stuid='$stid'")or die(mysqli_error($mysqli));
			//$stmt_content=$stmt->fetch_assoc();
			//$stmt_row=$stmt->num_rows;
			
			//if($stmt_row>0)
			//{
				//echo "Updating quiz result timer".
				$stmt2=$SHstudentupdate->update_onefieldscheck2('quiz_result_timer', 'qsetupid', $quessetupid, 'stid', $stid, 'questime', $returntime);
				//$stmt2 =$mysqli->query("UPDATE quiz_result_timer SET questime='$returntime' WHERE qsetupid='$quessetupid' and stuid='$stid'") or die(mysqli_error($mysqli));
			}
			
		}

?>