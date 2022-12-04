<?php include("headernew.php");?>
<?php require_once("includes/session.php"); ?>
<?php confirm_logged_in(); ?>
<?php 
include_once "includes/connection.php";
include_once "classes.php";
include_once "includes/students_oop.php";
$pg=trim(isset($_GET['pg'])? $_GET['pg']:false);
$refno= trim(isset($_GET['refno'])? $_GET['refno']:false);
$stid =trim(isset($_SESSION['stid'.$refno])?$_SESSION['stid'.$refno]:false);
$groupid=studentRecord::st_func($stid, "groupid");
$classid=studentRecord::st_func($stid, "classid");
$schid=Studentclass::classtable_func($classid, "schoolid");
$current_termid=About_term_name::curterm_name("termid");
$current_session=About_school_name::cursess_name("sessid");



//Collection of cbt exam details
if($pg==2){
	$cbtsubject=(isset($_GET['subject'])? $_GET['subject']:false);
	$cbtterm=(isset($_GET['term'])? $_GET['term']:false);
	$cbtsession=(isset($_GET['year'])? $_GET['year']:false);
	}
?>


<div id="page-wrapper">

            <div class="container-fluid">
				<!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Hi!</strong> <span style="font:20px Corbel bold; color:#060; "><?php echo studentRecord::st_func($stid, "fullname")." "; ?> </span><span style="color:#060;">; Class:<span style="color:#FEA318;"><?php echo studentRecord::st_func($stid, "class") ." " ; ?>;</span> Group:<span style="color:#FEA318;"><?php echo studentRecord::st_func($stid, "group") ." " ; ?></span> <span style="font:20px Corbel  bold; color:#F00; ">; <?php About_term_name::curterm_name("termname"); echo " ";?>Term of <?php About_School_name::cursess_name("sessname");?></span> </span>
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
                    <?php if(empty($pg)){ ?>
                    <div class="row">
                <div class="col-lg-11.8 col-xs-11.8 col-sm-11.8 col-md-11.8" style=" margin:0% 2% 0%; background:#FFF; padding:0% 1% 0%; ">
                	
                    <table class="table table-hover">
                    	<thead>
                        	<tr>
                                 <th>Subject</th>
                                 <th>Term</th>
                                 <th>Year</th>
                                 <th>&nbsp;</th>
                            </tr>
                        </thead>
                         <tbody>
                         	<form method="post" action="" onSubmit="return checkcbtparametres()" name="cbtedit">
                            
                            <tr>
                                <td>
                                <select name="subject"  class="form-control">
                                  <option value="">--Select Subject--</option>
                                
                                  <?php 
								  $select_content1=("select DISTINCT subject_id from quiz_setup a INNER JOIN quiz_question b ON a.qid=b.quiz_setup_id where class_id='$classid' and group_id='$groupid' and schoolid='$schid' order by subject_id asc");
												  $content_result1= mysqli_query($mysqli, $select_content1) or die (mysqli_error());
												  $content1 = mysqli_fetch_assoc($content_result1);
											 do { 	
											 $subject=$content1['subject_id'];
								  	$select_content3=("select * from subjects where sid='$subject'");
											$content_result3= mysqli_query($mysqli, $select_content3) or die (mysqli_error($mysqli));
											$content3 = mysqli_fetch_assoc($content_result3);
								  ?>
                                  <option value="<?php echo  $content3['sid']?>" ><?php echo  $content3['subject']?></option>
                                  <?php } while ( $content1 = mysqli_fetch_assoc($content_result1)); ?>
                                </select>
                                </td>
                                
                                <td>
                                	
                                      <select name="term"  class="form-control">
                                            <option value="">--Select Term--</option>
                                            <?php
                                                  $select_content1=("select DISTINCT termid from quiz_setup a INNER JOIN quiz_question b ON a.qid=b.quiz_setup_id where group_id='$groupid' and schoolid='$schid' order by termid asc");
												  $content_result1= mysqli_query($mysqli, $select_content1) or die (mysqli_error());
												  $content1 = mysqli_fetch_assoc($content_result1);
												  do {
													  								
													  $t = $content1["termid"];
												  
													  $select_content=("select * from terms where tid = '$t'");
													  $content_result= mysqli_query($mysqli, $select_content) or die (mysqli_error());
													  $content = mysqli_fetch_assoc($content_result);
                                              ?>
                                            <option value="<?php echo  $content['tid']?>"<?php if($content['tid']==$current_termid){?>selected <?php } ?>><?php echo  $content['term']?></option>
                                            <?php } while ($content1 = mysqli_fetch_assoc($content_result1)); ?>
                                          </select>
                                 </td>
                                  <td>
                                <select name="year" class="form-control" >
                                  <option value="">--Select Year--</option>
                                  <?php
                                        $select_content1=("select DISTINCT sessionid from quiz_setup a INNER JOIN quiz_question b ON a.qid=b.quiz_setup_id where class_id='$classid' and group_id='$groupid' and schoolid='$schid' order by sessionid asc");
										$content_result1= mysqli_query($mysqli, $select_content1) or die (mysqli_error($mysqli));
                                        $content1 = mysqli_fetch_assoc($content_result1);
										do {								
										$y = $content1["sessionid"];
										$select_content=("select * from schsession where sid ='$y'");
                                        $content_result= mysqli_query($mysqli,$select_content) or die (mysqli_error($mysqli));
                                        $content = mysqli_fetch_assoc($content_result);
                                    ?>
                                  <option value="<?php echo  $content['sid']?>" <?php if($content['sid']==$current_session){?>selected <?php } ?>><?php echo  $content['sesion']?></option>
                                  <?php } while ($content1 = mysqli_fetch_assoc($content_result1)); ?>
                                </select> 
                                </td>
                                 <td> <input type="submit" value="View Result" class="form-control" style="background:#060; color:#FFF" /></td>
                            </tr>
                            </form>
                            
                         </tbody>
                    </table>
                </div>
             </div>
             <?php }  ?>
              <?php if($pg==2){ ?>
                       
                    	<div id="istwarning">
                        <div style="margin-left:1%">Please ensure to read following instructions before answering questions</div>
                       
                       <table class="table"  style="font-size:12px; ">
          <tr>
			<td align="left">
                        <ol>
                            <li>Subject Name: <b style="color:#090; font-size:16px"><?php echo Studentclass::subjecttable_func($cbtsubject, 'subjectname'); ?></b></li>
                            
                            <li>Total Questions: <b style="color:#090; font-size:16px"><?php echo Studentclass::quizsetup($classid, $schid, $cbtsubject, $groupid,$cbtterm, $cbtsession, 'totalquestion'); ?></b></li>
                            <li>You need to score <b style="color:#090; font-size:16px"><?php echo Studentclass::quizsetup($classid, $schid, $cbtsubject, $groupid,$cbtterm, $cbtsession, 'passmark'); ?></b> or above to pass. </li>
                            <li>Total Score: <b style="color:#090; font-size:16px"><?php echo Studentclass::quizsetup($classid, $schid, $cbtsubject, $groupid,$cbtterm, $cbtsession, 'totalscore'); ?></b></li>
                            <li>Allocated time allocated for all question:<b style="color:#090; font-size:16px"><?php echo Studentclass::quizsetup($classid, $schid, $cbtsubject, $groupid,$cbtterm, $cbtsession, 'totaltime'); ?></b>.</li>
                            <li>You cannot go back to a previous question.</li>
                        </ol>
                        
                        <b><h4>Note:</h4></b>
                         <ol>
                                <li>Poor internet connection or temporary disconnection does not affect the online exam. <br />
                                Once you reconnect, resume the exam by clicking the next button again.</li>                               
                                <li>While writing the exam, you can see the remaining time in the top right side.</li>
                                <li>After the allocated time, you are automatically moved to the next question. </li>
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
                                    <a href="cbt_exam_page?reno=<?php echo $stid ; ?>&qid=<?php echo Studentclass::quizsetup($classid, $schid, $cbtsubject, $groupid,$cbtterm, $cbtsession, 'quizsetupid')?>" class="btn btn-success btn-large"><i class="glyphicon glyphicon-certificate"></i>Start Online Exam</a></div>
                                    </center>
                       
						<?php } ?>   
                      <!--Close Writing of CBT -->    
                        
                     <!-- Writing of CBT -->
                     
                      <!--Close of Writing of CBT -->  
                   
                </div>
                        
                        
                    </div>
                </div>
               
                
                <!-- /.row -->

                

        </div>
 <?php include("footernew.php");?>
 
 <script type="text/javascript">
 
		function checkcbtparametres(){
			if(document.cbtedit.subject.value == "") {
			alert ("Please select Subject")
			document.cbtedit.subject.focus();
			return false
			}
			
			
			if(document.cbtedit.term.value == "") {
			alert ("Please select term" )
			document.cbtedit.term.focus();
			return false
			}
			
			if(document.cbtedit.year.value == ""){
			alert ("Please select session")
			document.cbtedit.year.focus();
			return false
			}
			
			else{
				
				var subject=document.cbtedit.subject.value;
				var term=document.cbtedit.term.value;
				var year=document.cbtedit.year.value;
				document.cbtedit.action="?pg=2&refno=<?php echo $stid;?>"+'&subject='+subject+'&term='+term+'&year='+year;
				}
			
		}
 </script>