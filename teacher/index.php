<?php 
include("../schoolhelp/includes/connection.php");
include("headernew.php");
//include_once "../includes/app_functions.php";
$refno=(isset($_GET['refno'])?$_GET['refno']:false);
$tid=(isset($_SESSION["t_teacherlog".$refno])?$_SESSION["t_teacherlog".$refno]:false);

//Select current term/semester
 $semesterdata=$SHteacher->allteacheredit('semesters','status', 1);
            if (is_array($semesterdata)) {
                foreach($semesterdata as $semesterrecord){
                    $semestername=$semesterrecord['semestername'];
                    $semesterid=trim($semesterrecord['semesterid']);
                    
              }
          }


//Select current Session
 $sessiondata=$SHteacher->allteacheredit('session','status', 1);
            if (is_array($sessiondata)) {
                foreach($sessiondata as $sessiondrecord){
                    $sessionname=$sessiondrecord['sessionlow']."/".$sessiondrecord['sessionhigh'];
                    $sessionid=trim($sessiondrecord['sessionid']);    
              }
          }

  //Enable a teacher to finalise result and also print broadsheet and report card
 $teacherresultdata=$SHteacher->allteacheredit('resultactivations','titlename', "Generate result by form teachers");
            if (is_array($teacherresultdata)) {
                foreach($teacherresultdata as $teacherresultrecord){
                    $resultvisibility=trim($teacherresultrecord['status']);    
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
                            <i class="fa fa-info-circle"></i>  <strong>Hi!</strong> <span style="font:20px Corbel bold; color:#060; "><?php echo (isset($_SESSION["t_fullname".$tid])?$_SESSION["t_fullname".$tid]:false); ?> </span><span style="color:#FEA318;">Note that your operations is only strictly on <span style="font:20px Corbel  bold; color:#F00; "><?php echo $semestername; echo " ";?>Term of <?php echo $sessionname; ?></span> </span>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-11.8 col-xs-11.8 col-sm-11.8 col-md-11.8" style=" margin:0% 2% 0%; background:#FFF; padding:1%; ">
                        <h1 class="page-header" style="margin-top:4px; color:#063;">Dashboard <small>Teacher's Assigned Classes</small></h1>
                        </div>
                </div>
                
				 <div class="row">
                    <div class="col-lg-11.8 col-xs-11.8 col-sm-11.8 col-md-11.8" style=" background:#FFF; padding:5px; margin:0% 2% 2%;">
                        
                          
                        <div class="row">
                              <?php
                     $levelid="";
                     $optionid="";
                     $optionname="";
                     $levelname="";
                     $csname="";
                     $icourseid="";
                     $courseid="";
                     $classtype="";

          $gid = trim(isset($_SESSION["t_teacherlog".$tid])?$_SESSION["t_teacherlog".$tid]:false);


            $teacherscourses=$SHteacher->allteacheredit('instructorcourses','staffid', $gid);
            if (is_array($teacherscourses)) {
                 $k=count($teacherscourses);
              foreach($teacherscourses as $teacherscoursesrec){

                $optionid=trim($teacherscoursesrec['optionid']);  
                $levelid=trim($teacherscoursesrec['levelid']); 
                $courseid=trim($teacherscoursesrec['courseid']); 

            //Getting the class information
            $teachersclass=$SHteacher->allteacheredit('level', 'levelid', $levelid);
            if (is_array($teachersclass)) {
              foreach($teachersclass as $teachersclassrec){
                $levelname=$teachersclassrec['levelname'];
                $classtype=trim($teachersclassrec['classtype']);
                  }
              }
            
              //Getting the Group information
            $teachersgroup=$SHteacher->allteacheredit('optiontable','optid', $optionid);
            if (is_array($teachersgroup)) {
                foreach($teachersgroup as $teachersgrouprec){
                    $optionname=$teachersgrouprec['optname'];
              }
          }

        //Getting the Course information
        $teacherscourse=$SHteacher->allteacheredit('course','csid', $courseid);
            if (is_array($teacherscourse)) {
                foreach($teacherscourse as $teacherscourserec){
                    $csname=$teacherscourserec['csname'];
                    
              }
          }

             $formteachers=$SHteacher->allteacheredit3('formteacher','staffid', $tid, 'levelid', $levelid, 'optionid', $optionid);
                                if (is_array($formteachers)) {
                                    foreach($formteachers as $formteachersrec){
                                        $classteacher_status=1;
                                  }
                              }
                 
                  if($k==0){$change="";}else{$change="border-bottom:1px solid #F2FFF0";}
                   $vartcid=trim($teacherscoursesrec["icourseid"]);
                                       
                  ?>
			
                    <div class="col-lg-4 col-xs-4 col-sm-4 col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading dropdown" style="background:#A7FEA5">
                                <h3 class="panel-title dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-edit"></i> Class: <span><?php echo $levelname; ?></span><i class="fa fa-fw fa-caret-down"></i></h3>
                   <ul class="dropdown-menu">
                      <li>
                                <a href="studentnew?refno=<?php echo $tid; ?>&class_id=<?php echo $levelid; ?>&gid=<?php echo $optionid; ?>">Student</a>
                            </li>
                        <?php 
						
						if($classteacher_status==1){
						?>
                            <li>
                                <a href="attendancenew.php?refno=<?php echo $tid; ?>&class=<?php echo $levelid; ?>&gid=<?php echo $optionid; ?>">Attendance</a>
                            </li>
                            <li>
                                <a href="addnewstudent.php?refno=<?php echo $tid; ?>&class=<?php echo $levelid; ?>&gid=<?php echo $optionid; ?>">New Student</a>
                            </li>
                           
                             <li>
                                <a href="classresources?refno=<?php echo $tid; ?>&tcid=<?php echo $teacherscoursesrec["icourseid"]; ?>">Class Video</a>
                            </li>
                            
                           <?php } ?>
                            <li>
                                <a href="examquestion?refno=<?php echo $tid; ?>&tcid=<?php echo $teacherscoursesrec["icourseid"]; ?>">Exam Question Paper</a>
                            </li>
                            <li>
                                <a href="classmaterial?refno=<?php echo $tid; ?>&tcid=<?php echo $teacherscoursesrec["icourseid"]; ?>">Class Materials</a>
                            </li>
                            <li>
                                <a href="onlinetest?refno=<?php echo $tid; ?>&tcid=<?php echo $teacherscoursesrec["icourseid"]; ?>">Online Assessment</a>
                            </li>   
                            <li>
                                <a href="term_score?refno=<?php echo $tid; ?>&tcid=<?php echo $teacherscoursesrec["icourseid"]; ?>">Term Score Upload</a>
                            </li>
                           
                           <?php  if($classteacher_status==1){
                            //checking whether class is an early class
                            if ($classtype==1) { ?>
                              <li>
                                <a href="earlyterm_score?refno=<?php echo $tid; ?>&tcid=<?php echo $teacherscoursesrec["icourseid"]; ?>">Early class score</a>
                            </li>
                            <?php }
						                ?>
                            <li>
                                <a href="resultreport?refno=<?php echo $tid; ?>&tcid=<?php echo $teacherscoursesrec["icourseid"]; ?>">Result Report</a>
                            </li>
                            <li>
                                <a href="result-comment?refno=<?php echo $tid; ?>&tcid=<?php echo $teacherscoursesrec["icourseid"]; ?>">Result Commenting</a>
                            </li>

                                <?php  if($resultvisibility==1){ ?>

                            <li>
                                <a href="printbroadsheet?refno=<?php echo $tid; ?>&tcid=<?php echo $teacherscoursesrec["icourseid"]; ?>">Result Broadsheet</a>
                            </li>
                            <li>
                                <a href="reportcard?refno=<?php echo $tid; ?>&tcid=<?php echo $teacherscoursesrec["icourseid"]; ?>&class=<?php echo $levelid; ?>&gid=<?php echo $optionid; ?>">Report Card</a>
                            </li>

                             <?php   } 
                              
                            
                              } ?>
                                
                    </ul>
                            </div>
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-fw fa-group"></i>Group: <span><?php echo $optionname;?></span></h3>
                            </div>
                            <div class="panel-body">
                               <i class="fa fa-fw fa-book"></i>Subject: <span><?php echo $csname;?></span>
                            </div>
                        </div>
                    </div>
                    
                    <?php }  
					
	   				}
					else{
						echo '<div class="col-lg-4 col-xs-4 col-sm-4 col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-fw fa-edit"></i>Sorry!</h3>
                            </div>
                            <div class="panel-body">
                               None has been assigned to you
                            </div>
                        </div>
                    </div>
                    ';
				   }
				  
				   ?>     
                </div>
                        
                        
                    </div>
                </div>
               
                
                <!-- /.row -->

                

        </div>
 <?php include("footernew.php");?>