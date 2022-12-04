<?php 
include("headernew.php");
include_once("phpclass/SHstudentOOP.php");
include_once("phpclass/SHstudentinserts.php");
include_once("phpclass/SHstudentothers.php");
$conn= new Dbh;
$mysqli = $conn->connect();
$studentinserts=new insertTable;

$page=trim(isset($_GET['page'])? $_GET['page']:false);
$qid=trim(isset($_GET['qid'])? $_GET['qid']:false);
$refno= trim(isset($_GET['refno'])? $_GET['refno']:false);
$stid =$_SESSION['stid'.$refno];
$totaltimeremaining=0;

$quizsetupdata=$SHstudent->allstudentedit('quiz_setup', 'qid', $qid);
      if (is_array($quizsetupdata)) {
        foreach($quizsetupdata as $quizsetupdatarec){
         $levelid=trim($quizsetupdatarec['levelid']);
         $optionid=trim($quizsetupdatarec['optionid']);
         $courseid = trim($quizsetupdatarec['courseid']);
         $totalnoquessetup=trim($quizsetupdatarec['no_of_question']);
         $totaltime=trim($quizsetupdatarec['totaltime']);
         $totalscore=trim($quizsetupdatarec['totalscore']);
         $passmark=trim($quizsetupdatarec['passmark']);
         $startdatetime=trim($quizsetupdatarec['startdatetime']);
         $enddatetime=trim($quizsetupdatarec['enddatetime']);
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

//checking 
//echo "totalquestion=" .
// Querying the quiz table
 $totalquizquestion=$SHstudent->allstudentedit('quiz_question', 'quiz_setup_id', $qid);
$totalnoquesdb=count($totalquizquestion);

//retrieving student total answered question
$totalstuansweredques=$SHstudent->allstudentedit2('quiz_result', 'qsid', $qid, 'stid', $stid);
$totalansweredques=count($totalstuansweredques);
$score=$totalscore/$totalnoquessetup;

if($totalnoquesdb<$totalnoquessetup){
	echo "<script language='javascript'>
					location.href='cbt?refno=$stid&m=1'
				</script>";
	}
	
//---------------------------------------------------------------------//


//remaining time to answer CBT Question
//checking remaining time to answer CBT Question
$quizresulttime=$SHstudent->allstudentedit2('quiz_result_timer', 'qsetupid', $qid, 'stid', $stid);
if (is_array($quizresulttime)) {
        foreach($quizresulttime as $quizresulttimerec){
         $totaltimeremaining=trim($quizresulttimerec['questime']); 
         $cbtstatus=trim($quizresulttimerec['status']);    
    }
}

//Time Conversion
//echo "Time Actually Remaining".
$totaltimetoseconds=cbt_time_conversion::to_seconds($totaltime);

//echo "Seconds Remaining".
$cbtremainingtimetoseconds=cbt_time_conversion::to_seconds($totaltimeremaining);
$cbtusedtime=$totaltimetoseconds-$cbtremainingtimetoseconds;

$returnusedtime=cbt_time_conversion::completetime($cbtusedtime);
//---------------------------------------------------------------------//

 date_default_timezone_set('Africa/Lagos'); 
 $exactdatetime=date('Y-m-d H:i:s');

if(($totalansweredques<$totalnoquessetup) && ($cbtremainingtimetoseconds>0) && ($cbtstatus==0)){

  if ( $exactdatetime>=$startdatetime && $exactdatetime<=$enddatetime ) {

	echo "<script language='javascript'>
	if(confirm('CBT has not been written or completed. Do you wish to write now or complete it?')){
										location.href='cbt_exam?refno=$stid&qid=$qid';}
					else{
						location.href='cbt?refno=$stid&qid=$qid&action=1'
						}
									</script>";
    }else{
        echo "<script language='javascript'>
                    location.href='cbt?refno=$stid&qid=$qid&action=1'
              </script>";
    }

	}
$notanswered="";
$correctanswer="";
$wronganswer="";
//checking Result Details
$resultsummary=$SHstudent->allstudentedit2order('quiz_result', 'stid', $stid, 'qsid', $qid, 'rid', 'ASC', $totalnoquessetup);
if (is_array($resultsummary)) {
        foreach($resultsummary as $resultsummaryrec){
         $qsid=trim($resultsummaryrec['qsid']);
         $quesid=trim($resultsummaryrec['quesid']);
         $answer=trim($resultsummaryrec['answer']);   

             //Checking the answered question
             $quizansquest=$SHstudent->allstudentedit2('quiz_question', 'quiz_setup_id', $qid, 'quiz_ques_id', $quesid);
              if (is_array($quizansquest)) {
                      foreach($quizansquest as $quizansquestrec){
                   
                        if ($answer==0 || $answer=="") {
                          $notanswered+=1;
                        }
                        elseif($answer==trim($quizansquestrec['ans'])){
                            $correctanswer+=1;
                            }
                          else{
                            $wronganswer+=1;
                          }
              

                  }
              }
    }
}


//$notanswered=$totalnoquesdb-($correctanswer+$wronganswer);
$scored=round($score*$correctanswer, 2);
//-------------------------------------


//Placed on probation

$studentdata=$SHstudent->allstudentedit('students', 'stid', $stid);
      if (is_array($studentdata)) {
        foreach($studentdata as $studentrec){
                  
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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
     <noscript>
	<meta http-equiv="refresh" content="0; URL=javascriptenablepage.php"/>
  	</noscript>
	
    <title>SchoolHelp::School Management Application</title>
     <link rel="shortcuticon icon" type="image/x-icon" href="../backend/images/schoolhelpicon.png">
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
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
        pre {
            margin-bottom: 10px;
            padding-left: 10px;
            border-left: 3px #DDD solid;
			
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
    
  #grad {
  background: red; /* For browsers that do not support gradients */
  background: -webkit-linear-gradient(green, white, green); /* For Safari 5.1 to 6.0 */
  background: -o-linear-gradient(green, white, green); /* For Opera 11.1 to 12.0 */
  background: -moz-linear-gradient(green, white, green); /* For Firefox 3.6 to 15 */
  background: linear-gradient(green, white, green); /* Standard syntax */
}

.mainpanel {
    
	border-radius:2%;
    -webkit-border-radius: 2%;
	 -o-border-radius: 2%;
	  -moz-border-radius: 2%;
	  margin-top:2%;
	  margin-bottom:2%;
}


   </style>  
               
</head>

<body style="margin:0px; padding:0px;" id="grad">

<div class="container-fluid mainpanel" id="ele2" style="width:88%; color:#FFF; margin-left:auto; margin-right:auto; margin-top:0.5%; background:#CFC">
<div id="cover" >
 <img  class="img-responsive" id="trans" <?php if($instilogo==""){ echo "src='img/fade.gif'";}else{ echo  "src='../schoolhelp/images/logo/$instilogo'";}?>  src="img/schoolhelpicon.png" />
 </div>
           
				<!-- /.row -->

                <!-- /.row -->
                <!-- Page Heading -->
                <div class="row"  style="background-color:transparent;">
                    <div class="col-lg-11.8 col-xs-11.8 col-sm-11.8 col-md-11.8"  style="margin:0.2% 1% 1%; background-color:inherit;">
                    
                        <div class="col-lg-6" style="color:#063; font-size:25px; float:left ">Welcome to Computer Based-Test </div> 
                        <div class="col-lg-4 glyphicon glyphicon-backward" align="right" style="font-size:16px; color:#063; float:right"><a href="cbt?refno=<?php echo $stid; ?>&action=1" style=" z-index:5; position:relative">Back</a></div>
                       
                        </div>
                        <div style="clear:left"></div>
                </div>
                
				 <div class="row">
                <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12" style="margin:0% 0% 0%;  background:#FFF; padding:1% ;">
                <div class="row">
                  <div style="margin:0% auto 0.5%;  background:#FFF; padding:0% 1% 1% ; width:90%">
                 
                  <div style="float:right;  z-index:7; position:relative"><button  class="btn btn-danger" onClick="logout('<?php echo $stid; ?>');">Logout</button></div>
                   <div style="float:right; color:#060; margin-right:1%; z-index:8; position:relative"><span class="glyphicon glyphicon-home"><a href="dashboard?refno=<?php echo $stid; ?>" >Home</a></span></div>
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
                   <div class="col-lg-4 col-xs-4 col-sm-4 col-md-4" style="float:left; color:#000; margin:0.1% 0.2%;  font:Corbel; font-weight:bold; padding:0.5% 0%">
                   <ul style="list-style-type:none; margin:0%;">
                    <li ><span>Total Time:</span> <span style="color:#060; text-align:right"><?php echo $totaltime; ?></span></li>
                   <li><span>Remaining Time: </span><span style="color:#060; text-align:right"><?php echo $totaltimeremaining; ?></span></li>
                   <li><span>Used Time:</span> <span style="color:#060; text-align:right"><?php echo $returnusedtime; ?></span></li>
<li style="width:100%"><div class="btn-group">
  <button type="button" class="btn btn-success glyphicon glyphicon-save print-link" style="z-index:102;" >Print</button>
</div></li>
                   
                   </ul>
                   </div>
                   <div class="col-lg-3 col-xs-3 col-sm-3 col-md-3" style="float:right; margin:2%">
                   <img  class="img-responsive" <?php if($passport==""){ echo "src='img/fade.gif'";}else{ echo  "src='../schoolhelp/images/uploads/student/$passport'";}?> style='width:45%; height:15%;' />
                   </div>
                  <div style="clear:both"></div>
                  
                  </div>
                  </div>
            
         <div class="table-responsive" style="margin-left:auto; margin-right:auto; background:#FFF; padding:0%;  width:90%; margin-top:0%; color:#666">
         <div class="panel panel-success" style="padding:0px">
  		<div class="panel-heading" style="font:16px; font-weight:bold ">Result Details</div>
  		<div class="panel-body" style="padding:0px 15px; color:#000;">
         <table class="table" id="table1" style="margin:0px; width:100%">
            <tr><td align="right" style="width:40%">Correct Answers:</td> <td><?php echo $correctanswer; ?></td></tr>
            <tr><td align="right">Wrong Answers:</td> <td><?php echo $wronganswer; ?></td></tr>
            <tr><td align="right">Omitted Question:</td> <td><?php echo $notanswered; ?></td></tr>
             <tr><td  align="right">Score:</td><td><?php echo round($scored); ?></td></tr>
            <tr><td align="right">Total Questions</td></td> <td><?php echo $totalnoquessetup; ?></td></tr>
            <tr><td align="right">Total Score</td><td><?php echo $totalscore;?></td></tr>
            </table>
            </div>
            </div>
</div>      
      
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
 
</body>

    <!-- jQuery -->
    <!--<script src="js/jquery.js"></script>-->
    
    <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
    <script type="text/javascript" src="js/jQuery.print.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	<script src="js/myscript.js"></script>
    <!-- Morris Charts JavaScript -->
   
    <script>
	function logout(stid){
		
		if(confirm("Are you sure you want to logout?")){
	location.href="logout?refno="+stid;
		}
	}
	
	 jQuery(function($) { 'use strict';
            $("#ele2").find('.print-link').on('click', function() {
                //Print ele2 with default options
                $.print("#ele2");
            });
            $("#ele4").find('.print-link').on('click', function() {
                //Print ele4 with custom options
                $("#ele4").print({
                    //Use Global styles
                    globalStyles : false,
                    //Add link with attrbute media=print
                    mediaPrint : false,
                    //Custom stylesheet
                    stylesheet : "http://fonts.googleapis.com/css?family=Inconsolata",
                    //Print in a hidden iframe
                    iframe : false,
                    //Don't print this
                    noPrintSelector : ".avoid-this",
                    //Add this at top
                    prepend : "Printed!!!<br/>",
                    //Add this on bottom
                    append : "<br/>Bye!",
                    //Log to console when printing is done via a deffered callback
                    deferred: $.Deferred().done(function() { console.log('Printing done', arguments); })
                });
            });
            // Fork https://github.com/sathvikp/jQuery.print for the full list of options
        });
	</script>
  	
</html>
