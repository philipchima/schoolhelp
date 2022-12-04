<?php 
include("headernew.php");
include_once("phpclass/SHstudentOOP.php");
include_once("phpclass/SHstudentinserts.php");
include_once("phpclass/SHstudentothers.php");
$conn= new Dbh;
$mysqli = $conn->connect();
$studentinserts=new insertTable;
$studentupdates=new updateTable;
?>

<?php  
$page=trim(isset($_GET['page'])? $_GET['page']:false);
$refno= trim(isset($_GET['refno'])? $_GET['refno']:false);
$stid =trim(isset($_SESSION['stid'.$refno])?$_SESSION['stid'.$refno]:false);
$sql=(isset($_GET['sql'])? $_GET['sql']:false);
$page=trim(isset($_GET['page'])? $_GET['page']:false);
$qid=trim(isset($_GET['qid'])? $_GET['qid']:false);

//Submittion of array to the database
if ($page == 2){
			$tbl_name="quiz_result";
			$quesid=isset($_POST['counting'])?$_POST['counting']:false;
			$studentid=$stid;
			$returntime1=trim(isset($_POST['righttime'])?$_POST['righttime']:false);
			 $returntime=cbt_time_conversion::completetime($returntime1);
			//echo 
			$cbtquessetupid=(isset($_POST['cbtquessetupid'])?$_POST['cbtquessetupid']:false);
			$bno = count($quesid);
			$Cnt = 0;
			$unans=0;
			$stuNo = $bno;
			$Cnt333 = 0;
			$k=1;
			for($i=1; $i <=$bno; $i++){
				//echo "Serial No".$i;
			//echo "The quses id". 
			$quesacttualid = (isset($_POST['ques'.$i])?$_POST['ques'.$i]:false);

			
			$checkisset=trim(isset($_POST['ans'.$studentid.$quesacttualid])?$_POST['ans'.$studentid.$quesacttualid]:false);
   
			
			if(isset($checkisset)){
				//echo "answeredid".
				$answeredid=(isset($_POST['ans'.$studentid.$quesacttualid])?$_POST['ans'.$studentid.$quesacttualid]:false);
				}else{$answeredid="";
				$unans+=1;
				}
			
			 echo $answeredid;
			$attcontent=$SHstudent->allstudentedit3('quiz_result', 'qsid', $cbtquessetupid, 'quesid',$quesacttualid, 'stid', $studentid);
			$resultid="";
			if(!is_array($attcontent)){
			$resultid="";
			foreach($attcontent as $value) {
        $resultid=trim($value['rid']);
      }
			
			$Cnt333 += 1;
			$resultupdate=$studentinserts->insert_4fields('quiz_result', 'stid', $studentid, 'qsid', $cbtquessetupid, 'quesid', $quesacttualid, 'answer', $answeredid);
			//$resultupdate=$mysqli->query("INSERT INTO quiz_result SET qsid='$cbtquessetupid', quesid='$quesacttualid', answer='$answeredid', stid='$studentid'")or die(mysqli_error($mysqli));
			
			
			}else{
			//This statement can only be performed if record not found in Attendance table
			
			$Cnt += 1;
      $resultupdate=$studentupdates->update_all('quiz_result', 'answer',  $answeredid, 'rid', $resultid);
			//$resultupdate=$studentupdates->update_onefieldscheck1('quiz_result', 'qsid', $cbtquessetupid, 'quesid', $quesacttualid, 'stid', $studentid,  'answer',  $answeredid, 'stid', $stid);

			//$resultupdate=$mysqli->query("UPDATE quiz_result SET qsid='$cbtquessetupid', quesid='$quesacttualid', answer='$answeredid', stid='$studentid' WHERE qsid='$cbtquessetupid' and quesid='$quesacttualid' and stid='$studentid'")or die(mysqli_error($mysqli));;
			
			}
			$totalque=$Cnt333+$Cnt;
			
			//exit;
	
			}

     
			if($resultupdate){
				$resultupdate=$studentupdates->update_twofieldscheck2('quiz_result_timer', 'qsetupid', $cbtquessetupid, 'stid', $studentid, 'questime',  $returntime, 'status',  '1');
				//$stmt2 =$mysqli->query("UPDATE quiz_result_timer SET questime='$returntime', status=1 WHERE qsetupid='$cbtquessetupid' and stuid='$studentid'") or die(mysqli_error($mysqli));
			$sql= "<b>$Cnt333 Questions newly insert and $Cnt Questions Updated and total question is $totalque<b>";
			//echo "setupid= ".$cbtquessetupid ." quesid=".$quesacttualid .", studentid=".$studentid.", status=".$answeredid.", returntime=".$returntime;
			
			echo "<script language='javascript'>
				location.href='cbt_exam_report?refno=$stid&qid=$qid'
				</script>";
			}else{$sql= "<script language='javascript'>alert('Operation was not successful')</script>";}
			
	}
//End of Submittion of array to the databas
	//Extracting information from quiz setup ID
    $quizsetupdata=$SHstudent->allstudentedit('quiz_setup', 'qid', $qid);
      if (is_array($quizsetupdata)) {
        foreach($quizsetupdata as $quizsetupdatarec){
         $levelid=trim($quizsetupdatarec['levelid']);
         $optionid=trim($quizsetupdatarec['optionid']);
         $courseid = trim($quizsetupdatarec['courseid']);
         //echo "Total Number of setup question".
         $totalnoquessetup=trim($quizsetupdatarec['no_of_question']);
         $totaltime=trim($quizsetupdatarec['totaltime']);
         $totalscore=trim($quizsetupdatarec['totalscore']);
         $passmark=trim($quizsetupdatarec['passmark']);
        }
      }

  //Getting level name
 $leveldata=$SHstudent->allstudentedit('level', 'levelid', $levelid);
      if (is_array($leveldata)) {
        foreach($leveldata as $levelrec){
         $levelname=trim($levelrec['levelname']);
         $departmentid=trim($levelrec['departmentid']);     
        }
      }

//Getting course name
      
      $coursename="";
 $coursedata=$SHstudent->allstudentedit('course', 'csid', $courseid);
      if (is_array($coursedata)) {
        foreach($coursedata as $courserec){
         $coursename=trim($courserec['csname']);    
        }
      }

//Getting option name 
      $optionname="";
 $optiondata=$SHstudent->allstudentedit('optiontable', 'optid', $optionid);
      if (is_array($optiondata)) {
        foreach($optiondata as $optionrec){
         $optionname=trim($optionrec['optname']);    
        }
      }

// Querying the quiz table
 $totalquizquestion=$SHstudent->allstudentedit('quiz_question', 'quiz_setup_id', $qid);
//echo "To number of question avaliable".  
$totalnoquesdb=count($totalquizquestion);

//checking 
//echo "totalnoquestion to answer=" .$totalnoquessetup;

//retrieving student total answered question
$totalstuansweredques=$SHstudent->allstudentedit2('quiz_result', 'qsid', $qid, 'stid', $stid);
$totalansweredques=count($totalstuansweredques);

//echo "totalanswered=" .$totalansweredques;


if($totalansweredques==$totalnoquessetup){
	echo "<script language='javascript'>
			'cbt_exam_report?refno=$stid&qid=$qid&action=1'
		</script>";
	}

if($totalnoquesdb<$totalnoquessetup){
	echo "<script language='javascript'>
			location.href='cbt?refno=$stid&m=1'
		</script>";
	}

//---------------------------------------------------------------------//
//checking remaining time to answer CBT Question
$quizresulttime=$SHstudent->allstudentedit2('quiz_result_timer', 'qsetupid', $qid, 'stid', $stid);
if (is_array($quizresulttime)) {
        foreach($quizresulttime as $quizresulttimerec){
         $totaltimeremaining=trim($quizresulttimerec['questime']); 
         $cbtstatus=trim($quizresulttimerec['status']);    
        }
      }else{
	$sqlinsertion=$studentinserts->insert_4fields('quiz_result_timer', 'stid', $stid, 'qsetupid', $qid, 'questime', $totaltime, 'status', '0');
      }


//Time Conversion
//echo "Time Actually Remaining".
$cbttimetoseconds=cbt_time_conversion::to_seconds($totaltimeremaining);
$cbtsetuptoseconds=cbt_time_conversion::to_seconds($totaltime);
$returntime=cbt_time_conversion::completetime($cbttimetoseconds);
//---------------------------------------------------------------------//
if(($cbttimetoseconds<=0)||($cbtstatus==1)){
	echo "<script language='javascript'>
			location.href='cbt_exam_report?refno=$stid&qid=$qid'
		</script>";
	}
//Placed on probation
//Placed on probation

$studentdata=$SHstudent->allstudentedit('students', 'stid', $stid);
      if (is_array($studentdata)) {
        foreach($studentdata as $studentrec){
         $levelid1=trim($studentrec['levelid']);  
         $passport=trim($studentrec['passport']);
         $name=trim($studentrec['surname']).' '.trim($studentrec['othername']);
  }
}

$records2=$SHstudent->allstudentedit('institution', 'departmentid', $departmentid);
                        if (isset($records2)) {
                          foreach($records2 as $fieldrecord2){
                         $instilogo=$fieldrecord2['instilogo'];
                        }
                      }
//End of the probated varaible
                      
?>
<!DOCTYPE html PUBLIC>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
     <noscript>
	<meta http-equiv="refresh" content="0; URL=javascriptenablepage.php"/>
  	</noscript>

    <title>SchoolHelp::School Management Application</title>
    <link rel="shortcuticon icon" type="image/x-icon" href="../backend/images/schoolhelpicon.png">
	<link rel="stylesheet" href="css/jquery.paginate.css" />
	<style>
		.paginate { padding: 0; margin: 0; }
		.paginate > li { list-style: none; padding: 10px 20px; border: 1px solid #ddd; margin: 10px 0; }
	</style>
	
    <!-- Bootstrap Core CSS -->
     
    <link rel="stylesheet" href="../css/bootswatch.min.css"/>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
     <link href="css/forindexonly.css" rel="stylesheet"/>

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet"/>

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet"/>

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/timeTo.css" type="text/css" rel="stylesheet"/>

    <style>

    input[type="radio"] {
    -ms-transform: scale(2.5); /* IE 9 */
    -webkit-transform: scale(2.5); /* Chrome, Safari, Opera */
    transform: scale(2.5);
    }

        pre {
            margin-bottom: 10px;
            padding-left: 10px;
            border-left: 3px #DDD solid;
        }
		.mainpanel {
    
	  border-radius:2%;
    -webkit-border-radius: 2%;
	  -o-border-radius: 2%;
	  -moz-border-radius: 2%;
	  margin-top:2%;
	  margin-bottom:2%;
}

		#cover{
	 position:absolute;
			left: 0px;
			top: 0px;
			z-index:2;
			width:100%;
			
			margin-left:auto;
			margin-right:auto;
		}
		
		#trans{
	 
			opacity: 0.1;
			filter: alpha(opacity=10); /* For IE8 and earlier */ width:100%; height:100%;
			}
    
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<!--<script type="text/javascript" src="js/crud.js"></script>-->
   
               
</head>

<body style="margin:0px; padding:0px;" id="grad">
<div id="cover" >
 <img id="trans" class="img-responsive" <?php if($instilogo==""){ echo "src='img/fade.gif'";}else{ echo  "src='../backend/logos/$instilogo'";}?>  src="img/schoolhelpicon.png" />
 </div>
<div class="container-fluid mainpanel" style="width:88%; color:#FFF; margin-left:auto; margin-right:auto; margin-top:0.5%; background:#CFC">
				<!-- /.row -->
                <!-- /.row -->
                <!-- Page Heading -->
                <div class="row"  style="background-color:transparent;"  >
                    <div class="col-lg-11.8 col-xs-11.8 col-sm-11.8 col-md-11.8"  style="margin:0.2% 1% 1%; background-color:inherit;">
                    
                        <div class="col-lg-6" style="color:#063; font-size:25px; float:left ">Welcome to Computer Based-Test </div> 
                        <div class="col-lg-4 glyphicon glyphicon-backward" align="right" style="font-size:16px; color:#063; float:right"><a href="cbt?refno=<?php echo $stid; ?>" style="z-index:6; position:relative">Back</a></div>
                       
                        </div>
                        <div style="clear:left"></div>
                </div>
                
				 <div class="row" >
                <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12" style="margin:0% 0% 0%;  background:#FFF; padding:1%; " id="paging"> 
                <div class="row">
                  <div style="margin:0% auto 0.5%;  background:#FFF; padding:0% 1% 1% ; width:90%">
                  <div style="float:right"><button style="z-index:8; position:relative" class="btn btn-danger" onClick="logout('<?php echo $stid; ?>');">Logout</button></div>
                   <div style="float:right; color:#060; margin-right:1%"><span class="glyphicon glyphicon-home" ><a href="dashboard?refno=<?php echo $stid; ?>" style="z-index:6; position:relative">Home</a></span></div>
                  <div style="clear:both"></div>
                  
                  </div>
                  </div>
                  
                  <div class="row" >
                  <div class="mainpanel" style="width:91%; color:#000; background:#E0E0E0; margin-left:auto; margin-right:auto; padding:0% 0.2%; margin-top:0px; ">
                  <div class="col-lg-4 col-xs-4 col-sm-4 col-md-4" style="float:left;  font:Corbel; font-weight:bold; margin:0%; padding:1% 2%;">
                   <ul style="list-style-type:none; padding:0.2% 1%; width:90%; font-size:100%;">
                    <li style="width:100%"><ul style="list-style-type:none; display:inline-block; padding:0%; margin:0.6%; width:100%;"><li style="float:left; width:32%">Fullname: </li><li style="float:right; color:#090">&nbsp;<?php echo $name; ?></li></ul></li>
                   <li style="width:100%"><ul style="list-style-type:none; display: inline-block; padding:0%; margin:0.6%; width:100%;"><li style="float:left; ">Class CBT:</li><li style="float:right; color:#090">&nbsp;<?php echo $levelname; ?></li></ul></li>
                   <li style="width:100%"><ul style="list-style-type:none; display:inline-block; padding:0%; margin:0.6%; width:100% "><li style="float:left;">Subject:</li><li style="float:right; color:#090"><?php echo $coursename; ?></li></ul></li>
                   <li><ul style="list-style-type:none; display:inline-block; padding:0%; margin:0.6%; width:100% "><li style="float:left; width:32%">Group:</li><li style="float:right; color:#090"><?php echo $optionname; ?></li></ul></li>
                   </ul>
                    <div style="clear:both"></div>
                  </div>
                   <div class="col-lg-5 col-xs-5 col-sm-5 col-md-5" style="float:left; color:#060; margin:0.1% 0.2%;  font:Corbel; font-weight:bold; padding:0.5% 3%">
                   <ul style="list-style-type:none; margin:0%;">
                   <li style="color:#000; font-size:100%">Remaining Time</li>
                  <li>

					<div id="timecontent" style="margin:0%; padding:0%; color:#090"></div>
					<span id="timer" style="display:none"></span>
					</li>
                   <li><div class="progress" style="margin:0% 0% 0.8%; width:68%; background:#FFF;" >
  <div class="progress-bar progress-bar-success progress-bar-striped" id="progressbar" role="progressbar" aria-valuenow="100" aria-* aria-valuemin="0" aria-valuemax="100" style="margin:0%; padding:0%">
  </div>
</div>
</li>

<li style="width:100%"><div class="btn-group" style="z-index:9; position:relative">
  <button type="button" class="btn btn-success glyphicon glyphicon-book" onClick="location.href='cbt?refno=<?php echo $stid; ?>&qid=<?php echo $qid;?>&page=2';">Instruction</button>
  <button type="button" class="btn btn-success glyphicon glyphicon-edit">Edit</button>
  <button type="button" class="btn btn-success glyphicon glyphicon-save" onClick="$('#righttime').val($('#timer').text()); if(confirm('Are you sure you to submit all')){document.form1.submit();} " >Submit</button>
</div></li>
                   
                   </ul>
                   </div>
                   <div class="col-lg-2 col-xs-2 col-sm-2 col-md-2" style="float:right; margin:2%">
                     <img <?php if($passport==""){echo "src='img/fade.gif'";}else{ echo "src='../schoolhelp/images/uploads/student/$passport'"; }?> style='width:50%; height:15%;' />
                   </div>
                  <div style="clear:both"></div>
                  
                  </div>
                  </div>
            
         <div style="margin-left:auto; margin-right:auto; background:#FFF; padding:0%;  width:90%; margin-top:0%; color:#666; position:relative; z-index:10;">
         <form id="form1" name="form1" method="post" action="?page=2&refno=<?php echo $stid; ?>&qid=<?php echo $qid; ?>">
         <input name="studentid" value="<?php echo $stid; ?>" type="hidden"/>
                 <input name="cbtquessetupid" value="<?php echo $qid;?>" type="hidden"/>
                 <input name="righttime" id="righttime" value="" type="hidden"/>
  <ul id="example" style="padding:0px;margin:0px; ">
  <?php if($cbtstatus==0){ ?>
  
  <?php if($totalansweredques<$totalnoquessetup){ 
  ?> 
			
           <?php 
		   $numques=$totalnoquessetup-$totalansweredques;
		   if($numques>0){$x=1; ?>
          
			  <?php 
			  $counter=array();
			  $u=0;
		   while($numques>=$x){
			
			
			$result=$SHstudent->allstudenteditrand('quiz_question', 'quiz_setup_id', $qid);
			
			     
                       // $num_questions = $result->num_rows ;
						if(is_array($result)){
							foreach ($result as $content_questions) {
							
            		$cbtquestion=trim($content_questions['question']);
					      $cbtquesid=trim($content_questions['quiz_ques_id']);
								$cbtquessetupid=trim($content_questions['quiz_setup_id']);
								$cbtans1=trim($content_questions['A']);
								$cbtans1id=trim($content_questions['A2']);
								$cbtans2=trim($content_questions['B']);
								$cbtans2id=trim($content_questions['B2']);
								$cbtans3=trim($content_questions['C']);
								$cbtans3id=trim($content_questions['C2']);
								$cbtans4=trim($content_questions['D']);
								$cbtans4id=trim($content_questions['D2']);
								$dlink=trim($content_questions['dlink']);

								$totalstuansweredques=$SHstudent->allstudentedit3('quiz_result', 'qsid', $qid, 'quesid', $cbtquesid, 'stid', $stid);

								$questionvalidity=count($totalstuansweredques);
								
							}
								if($questionvalidity==0){
									$partof=0;
									if(count($counter) > 0){
									foreach($counter as $k){
										
										if($k==$cbtquestion){
											$partof=1;
											}
										}
									}
										$counter[]=$cbtquestion;
										if($partof!=1){
									
								?>
								<li><div class="panel panel-success" style="padding:0px">
  <div class="panel-heading">Question No: <?php echo $x; ?></div>
  <div class="panel-body" style="padding:0px 15px; color:#000;">
  
                 <input name="counting[]" value="<?php echo $cbtquesid; ?>" type="hidden"/>
				 <input name="ques<?php echo $x; ?>" value="<?php echo $cbtquesid; ?>" type="hidden"/>
				
 <ul style="list-style-type:none; margin:0px 0px; padding:0px 0px; font-size: 24px">
 <?php if(file_exists("../schoolhelp/uploads/cbtquesimage/<?php echo $dlink; ?>")){?>
 <li style="position:relative; z-index:10; height:46%; margin:1%; float:right; font-size: 14px">
 
  				<img class="img img-responsive" style="width:60%; " src="../schoolhelp/uploads/cbtquesimage/<?php echo $dlink; ?>"/>
				 
				
                </li><?php } ?>
                <li style="text-align:justify; margin-bottom:1%; font-size: 20px">
 <?php echo $cbtquestion; ?>
 </li>
 <li>
     <input name="ans<?php echo $stid.$cbtquesid; ?>" type="radio" value="<?php echo $cbtans1id; ?>" id="<?php echo $cbtquesid; ?>" onClick="questsub($(this).attr('id'),$(this).val(),'<?php echo $qid; ?>','<?php echo $stid; ?>','<?php echo $x;?>');"/>&nbsp;&nbsp; A.&nbsp;&nbsp; <?php echo $cbtans1; ?>
		</li>					  
  <li>
    <input name="ans<?php echo $stid.$cbtquesid; ?>" type="radio" value="<?php echo $cbtans2id; ?>" id="<?php echo $cbtquesid; ?>" onClick="questsub($(this).attr('id'),$(this).val(),'<?php echo $qid;?>','<?php echo $stid; ?>','<?php echo $x;?>');"/>&nbsp;&nbsp; B. &nbsp;&nbsp;<?php echo $cbtans2; ?>
	</li>						  
    <li>
    <input name="ans<?php echo $stid.$cbtquesid; ?>" type="radio" value='<?php echo $cbtans3id; ?>' id='<?php echo $cbtquesid; ?>' onClick="questsub($(this).attr('id'),$(this).val(),'<?php echo $qid;?>','<?php echo $stid;?>','<?php echo $x;?>')"/>&nbsp;&nbsp;  C. &nbsp;&nbsp;<?php echo $cbtans3; ?>
	</li>
 	<li>
    <input name='ans<?php echo $stid.$cbtquesid; ?>'  type="radio" value='<?php echo $cbtans4id; ?>' id='<?php echo $cbtquesid; ?>' onClick="questsub($(this).attr('id'),$(this).val(),'<?php echo $qid;?>','<?php echo $stid;?>','<?php echo $x;?>');" style="font-size: 20px"/>&nbsp;&nbsp; D. &nbsp;&nbsp;<?php echo $cbtans4; ?>
	</li>
  
  </ul>
</div>
	</div>
    
		</li>	
            
		  <?php $x+=1; }// Checking whether Question has been selected
      
		  }//checking whether the question has been answer already
		  }?>
				
					
		    <?php } }else{ echo "<script language='javascript'>
										location.href='cbt_exam_report?refno=$stid&qid=$qid'
									</script>";} ?>
            
             <?php }else{ echo "<script language='javascript'>
										location.href='cbt?refno=$stid&qid=$qid'
									</script>";}?>
           <?php }else{ echo "<script language='javascript'>
										location.href='cbt_exam_report?refno=$stid&qid=$qid'
									</script>";}?>
           
           
          </ul>
          </form>
</div>  
<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<script src="js/jquery.paginate.js"></script>

	<script>
		//call paginate
		$('#example').paginate();
	</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>   
  </div>
    <div class="row" style=" background-color:transparent; ">
    <div class="col-lg-12" style=" background-color:transparent;   margin:0%;" >
        <p class="pull-right">Designed by <a href="http://swiftomicrosystems.com" target="_blank" style=" font-weight:bold">Swiftotech Microsystems. | 
             <img src="img/swifto_logo.png" width="60" height="40" /> </a> 
        </p>
    </div>
    <div class="clearfix"></div>
    
</div>
</div>
</div>

    <!-- jQuery -->
    <!--<script src="js/jquery.js"></script>-->
    <!-- Bootstrap Core JavaScript -->
   
    <script src="js/bootstrap.min.js"></script>
    <!-- Morris Charts JavaScript -->
  	
	 <script src="js/jquery.time-to.js"></script>
     
     
    <script>
	/**
         * Simple digital clock
         */
        var actualtime=parseInt('<?php echo $cbtsetuptoseconds; ?>');
		var remaintime=parseInt('<?php echo $cbttimetoseconds; ?>');
		
		
		//$('#clock-1').timeTo(remaintime, function(){});

       
		
		var count=remaintime;

var counter=setInterval(timer, 1000); //1000 will  run it every 1 second

function timer()
{
  count=count-1;
  if (count <= 0)
  {
	  window.onbeforeunload = null; 
	  $('#righttime').val($('#timer').text()); 
	  document.form1.submit();
     clearInterval(counter);
     //counter ended, do something here
     return;
  }
   if (count <= 600)
  {
   $('#timecontent').css({"color":"#F00"})
  }
  
  //The Digital Time
  function secondsTimeSpanToHMS(s) {
    var h = Math.floor(s/3600); //Get whole hours
    s -= h*3600;
    var m = Math.floor(s/60); //Get remaining minutes
    s -= m*60;
    return (h < 10 ? '0'+h : h)+":"+(m < 10 ? '0'+m : m)+":"+(s < 10 ? '0'+s : s); //zero padding on minutes and seconds
}

$("#timecontent").text(secondsTimeSpanToHMS(count));
  
document.getElementById("timer").innerHTML=count;
var per=Math.round(count/actualtime*100);
$("#progressbar").text(per+"%"+"Remaining");
$("#progressbar").attr({"aria-valuenow":per});
$("#progressbar").css({"width":per+"%"});

  //Do code for showing the number of seconds here
}
	
	
	function questsub(quesid, answeredid, quessetupid, stid, quesserialno){
		var action=1;
		var timeremaining=$("#timer").text();
		//alert(timeremaining+" "+quesid+" "+answeredid+" "+quessetupid+" "+stid+" "+quesserialno);
		$(".page-"+quesserialno).parent().css({"background-color":"#0F0","color":"#FFF","padding":"0.2%"});
		 queryString = 'action='+action+'&quesid='+quesid+'&answeredid='+answeredid+'&quessetupid='+quessetupid+
	  '&stid='+stid+'&quesserialno='+quesserialno+'&timeremaining='+timeremaining;

	jQuery.ajax({
	url: "cbt_js.php",
	data:queryString,
	type: "POST",
	success:function(data){//alert(data);
		alert("Answered")
	}
	//Update Record  
}); 
		
		}
	
	
	window.onbeforeunload = function() {
		
	var timeremaining=$('#timer').text();
	var quizsetupid='<?php echo $qid; ?>';
	var stid='<?php echo $stid; ?>';
	var action=2;

  if (timeremaining!="" && quizsetupid!="" && stid!="") {
    
	queryString = 'action='+action+'&quessetupid='+quizsetupid+
	  '&stid='+stid+'&timeremaining='+timeremaining;

	jQuery.ajax({
	url: "cbt_js.php",
	data:queryString,
	type: "POST",
	success:function(data){
		
	}
	//Update Record 
	 
}); 
return "Bye now!";

}

};
	    // Student Logout Script
        function logout(stid){
		
		if(confirm("Are you sure you want to logout?")){
	location.href="logout?refno="+stid;
		}
	}
    </script>

</body>
</html>