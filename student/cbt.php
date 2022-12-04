<?php 
include("headernew.php");
include_once("phpclass/SHstudentOOP.php");
$conn= new Dbh;
$mysqli = $conn->connect();
?>

<?php  $page=trim(isset($_GET['page'])? $_GET['page']:false);
$refno= trim(isset($_GET['refno'])? $_GET['refno']:false);
$stid =trim(isset($_SESSION['stid'.$refno])?$_SESSION['stid'.$refno]:false);


$sql=(isset($_GET['sql'])? $_GET['sql']:false);

 $optionname="";
                             $adminsurname="";
                             $adminothername="";
                             $levelname="";
                             $state="";
                             $sex="";
                             $k=0;
                             $guardiansurname="";
                             $guardianothername="";
                             $housedivisionid="";
 $studentdata=$SHstudent->allstudentedit('students', 'stid', $stid);
      if (is_array($studentdata)) {
        foreach($studentdata as $studentrec){
         $levelid=trim($studentrec['levelid']);
         
         $passport=trim($studentrec['passport']);
         $fullname=trim($studentrec['surname']).' '.trim($studentrec['othername']);
         $stype=trim($studentrec['studenttype']);
         $housedivisionid=trim($studentrec['housedivisionid']);
         $sex=
          $sexname=Others::sexname($studentrec['sexid']);
          $stateid=trim($studentrec['stateid']);
          $countryid=trim($studentrec['countryid']);
          $lgaid=trim($studentrec['lgaid']);
          $levelid= trim($studentrec['levelid']);
          $optionid=trim($studentrec['optid']);
          $guardianid=trim($studentrec['guardianid']);
          $email=trim($studentrec['email']);
          $regno=trim($studentrec['regno']);
          $phone=trim($studentrec['phone']);
          $address=trim($studentrec['address']);
          $username=trim($studentrec['username']);
          $password=trim($studentrec['password']);

        }
      }


$courseid="";
$m=(isset($_GET['m'])?$_GET['m']:false);
$action=(isset($_GET['action'])?$_GET['action']:false);

//Collection of cbt exam details
if($page==2){
	$qid=trim(isset($_POST['quizsetupid'])?$_POST['quizsetupid']:false);
  $action=(isset($_POST['action'])?$_POST['action']:false);
	if($action==1){
		$qid=trim(isset($_POST['quizsetupid'])?$_POST['quizsetupid']:false);
		echo "<script type='text/javascript'>
		location.href='cbt_exam_report?refno=$stid&qid=$qid'
		</script>";
		}

    
	//Extracting information from quiz setup ID
    $quizsetupdata=$SHstudent->allstudentedit('quiz_setup', 'qid', $qid);
      if (is_array($quizsetupdata)) {
        foreach($quizsetupdata as $quizsetupdatarec){
         $levelid=trim($quizsetupdatarec['levelid']);
         $optionid=trim($quizsetupdatarec['optionid']);
         $courseid = trim($quizsetupdatarec['courseid']);
         $noofquestion=trim($quizsetupdatarec['no_of_question']);
         $totaltime=trim($quizsetupdatarec['totaltime']);
         $totalscore=trim($quizsetupdatarec['totalscore']);
         $passmark=trim($quizsetupdatarec['passmark']);
        }
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
?>


<div id="page-wrapper">

            <div class="container-fluid">
				<!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Hi!</strong> <span style="font:20px Corbel bold; color:#060; "><?php echo $fullname." "; ?> </span><span style="color:#060;">; Class:<span style="color:#FEA318;"><?php echo $levelname ." " ; ?>;</span> Group:<span style="color:#FEA318;"><?php echo $optionname ." " ; ?></span> <span style="font:20px Corbel  bold; color:#F00; ">; <?php echo $semestername; echo " ";?>Term of <?php echo $sessionname; ?></span> </span>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-11.8 col-xs-11.8 col-sm-11.8 col-md-11.8" style=" margin:0% 2% 0%; background:#FFF; padding:1%; ">
                        <h1 class="page-header" style="margin-top:4px; color:#063;">Quiz Dashboard <small></small></h1>
                        </div>
                </div>
                
				 <div class="row">
                    <div class="col-lg-11.8 col-xs-11.8 col-sm-11.8 col-md-11.8" style=" background:#FFF; padding:5px; margin:0% 2% 2%;">
                     <!-- Writing of CBT -->
                    <?php if(empty($page)){ ?>
                    <div class="row">
                <div class="col-lg-11.8 col-xs-11.8 col-sm-11.8 col-md-11.8" style=" margin:0% 2% 0%; background:#FFF; padding:0% 1% 0%; ">
                	
                    <table class="table table-hover">
                    	<thead>
                        	<tr>
                                 <th>Course/Subject</th>
                                 <th>Action</th>
                            </tr>
                        </thead>
                         <tbody>
                         	<form method="post" action="?page=2&refno=<?php echo $stid; ?>"  name="cbtedit">
                            
                            <tr>
                                <td>
                                  <input type="text" name="action" value="<?php echo $action ?>" hidden="hidden">
                                <select name="quizsetupid"  class="form-control" required="required">
                                  <option value="">--Select Course/Subject--</option>
                                  <?php 
                    								  $select_content1="SELECT DISTINCT qid, courseid, csname, startdatetime, enddatetime  from quiz_setup a INNER JOIN quiz_question b ON a.qid=b.quiz_setup_id INNER JOIN course c on a.courseid=c.csid where a.levelid='$levelid' and a.optionid='$optionid' and  a.semesterid='$semesterid' and a.sessionid='$sessionid' order by courseid ASC";
                    												  $stmt = $mysqli->prepare($select_content1);
                                              $stmt->execute();
                                      if($stmt->rowCount()){
                                      while($row=$stmt->fetch()){  
                                        

                                        date_default_timezone_set('Africa/Lagos'); 
                                        $exactdatetime=date('Y-m-d H:i:s');

                                        //Checking whether request is to check CBT result
                                        if ($action==1) {?>

                                        <option value="<?php echo  $row['qid']; ?>" ><?php echo  $row['csname']; ?></option>
                                         
                                       <?php  } else{

                                       if ( $exactdatetime>=trim($row['startdatetime']) && $exactdatetime<=trim($row['enddatetime']) ) {
                                          ?>

                                          <option value="<?php echo  $row['qid']; ?>" ><?php echo  $row['csname']; ?></option>

                                         <?php 
                                          }
                                        }
                                    } 
                                  } ?>
                                </select>
                                </td>
                               
                                 <td> <input type="submit" value="Proceed" class="form-control" style="background:#060; color:#FFF" /></td>
                            </tr>
                            </form>
                            
                         </tbody>
                    </table>
                    <div style="font-weight:bold; color:#F00">
                    <?php if($m!=""){ echo "Contact the Admin or your class teacher to upload complete questions"; } ?>
                    </div>
                </div>
             </div>
             <?php }  ?>
              <?php if($page==2){ ?>
                       
                    	<div id="istwarning">
                        <div style="margin-left:1%">Please ensure to read following instructions before answering questions</div>
                       
                       <table class="table"  style="font-size:12px; ">
          <tr>
			<td align="left">
                        <ol>
                            <li>Course/Subject Name: <b style="color:#090; font-size:16px"><?php echo $coursename; ?></b></li>
                            
                            <li>Total Questions: <b style="color:#090; font-size:16px"><?php echo $noofquestion; ?></b></li>
                            <li>You need to score <b style="color:#090; font-size:16px"><?php echo $passmark; ?></b> or above to pass. </li>
                            <li>Total Score: <b style="color:#090; font-size:16px"><?php echo $totalscore; ?></b></li>
                            <li>Allocated time allocated for all question:<b style="color:#090; font-size:16px"><?php echo $totaltime; ?></b>.</li>
                            <li>You can go back to a previous questions.</li>
                        </ol>
                        
                        <b><h4>Note:</h4></b>
                         <ol>
                                <li>Poor internet connection or temporary disconnection does not affect the online exam. <br />
                                Once you reconnect, resume the exam by clicking the next button again.</li>                               
                                <li>While writing the exam, you can see the remaining time in the top right side.</li>
                                <li>CBT Question will be submitted once the time  finishes </li>
                                <li class=rec>Do not use browser's back / refresh button. It may lead to next question or termination of assessment.</li>
                         </ol>
                         <h4>Troubleshooting</h4>
                                    <ol class="li14">
                                    <li>If you accidentally close the window, or you cannot complete the assessment due to power failure you can resume the assessment by clicking on it again. Note that you can resume only from the next question and you have to resume the assessment within 48 hours.</li>
                                    </ol>
                                    
                                    <button name="proceed" id="proceed" class="btn btn-success btn-large" onClick="$('#istwarning').hide();$('#warning').show();"><i class="glyphicon glyphicon-certificate"></i> Proceed to Exam</button>
                                    
                    </td>
		</tr>
        </table>
        </div>
        
        <center>
          <div id="warning" style="background-color:rgba(224,244,221,1); margin-top:50px; border:1px solid rgba(0,51,0,1); color:#003300; font-size:14px; padding:15px; margin:8px; display:none">
        <i class="glyphicon glyphicon-info-sign"></i> <b>Warning:</b> Once the exam has started DO NOT move focus outside the exam tab/window otherwise your exam will be aborted and you will not be able to complete it.
          <br><p>We recommend that you use full screen mode on your browser while attending the online exam. Most of the popular browsers support F11 key for full screen mode. Please use full screen mode before starting the online exam.</p><br/> 
            <a href="cbt_exam?refno=<?php echo $stid ; ?>&qid=<?php echo $qid; ?>" class="btn btn-success btn-large"><i class="glyphicon glyphicon-certificate"></i>Start Online Exam</a></div>
                                    </center>
                       
						<?php } ?>   
                     
                   
                </div>
                        
                        
                    </div>
                </div>
               
                
                <!-- /.row -->

                

        </div>
 <?php include("footernew.php");?>
 
 