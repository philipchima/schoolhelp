<?php
 include "includes/global.php"; 
 include "phpclass/SHteacherOOP.php";
 $SHteacher=new classTeacher;
confirmcheckin();
$refno=trim(isset($_GET['refno'])?$_GET['refno']:false);
$staffid=trim(isset($_SESSION["t_teacherlog".$refno])?$_SESSION["t_teacherlog".$refno]:false);
$_SESSION['staffid'] = trim(isset($_GET['refno'])?$_GET['refno']:false);

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
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SchoolHelp::Teachers Module School Management Application</title>
	<link rel="icon" href="img/schoolhelpicon.png">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="css/forindexonly.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/jquery.timepicker.min.css" rel="stylesheet">
      
    <!-- Datatables -->
    <link href="../schoolhelp/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../schoolhelp/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../schoolhelp/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../schoolhelp/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../schoolhelp/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
              
</head>

<body style="background:#FFF;">

    <div id="wrapper"  >

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="border:0px; ">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img src="img/schoolhelplogo1.png" alt="SCHOOLHELP"></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <?php
                  $fullname=trim(isset($_SESSION["t_fullname".$staffid])?$_SESSION["t_fullname".$staffid]:false);
								?>
                                       
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#FFF"><i class="fa fa-user" style="color:#FFF"></i>  <?php echo $fullname; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu dropdown-toggle">
                        <li>
                            <a href="teacherprofile?refno=<?php echo $staffid; ?>"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="leaveapplication?refno=<?php echo $staffid; ?>"><i class="fa fa-fw fa-envelope"></i>Apply for Leave</a>
                        </li>
                        <li>
                            <a href="teacherschangepassword?refno=<?php echo $staffid; ?>&pg=1"><i class="fa fa-fw fa-gear"></i>Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a onclick="if(confirm('Are You sure you want to logout')); logout('<?php echo $staffid; ?>');"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse" >
           
                <ul class="nav navbar-nav side-nav" style="border:0px; color:#FFF;">
                 <div style="text-align:center;"><a href="#"><i class="fa fa-user fa-5x" style="color:#FFF;"></i></a></div>
                
                    <li class="active" >
                        <a href="index?refno=<?php echo $staffid; ?>"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                     <?php
                     $levelid="";
                     $optionid="";
                     $optionname="";
                     $levelname="";
                     $csname="";
                     $icourseid="";
                     $courseid="";

	   	   $gid = trim(isset($_SESSION["t_teacherlog".$staffid])?$_SESSION["t_teacherlog".$staffid]:false);

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
				 
				  if($k==0){$change="";}else{$change="border-bottom:1px solid #F2FFF0";}
				   $vartcid=trim($teacherscoursesrec["icourseid"]);
				   
                    
				  ?>
             
                    <li style="font:85% comic; font-weight:bold; <?php echo $change ?>">
                        <a href="javascript:;" data-toggle="collapse" data-target="#<?php echo $vartcid;?>"><i class="fa fa-fw fa-edit"></i> <?php echo $levelname. ' '.$optionname." ".'<span style="color:yellow">'.$csname.'<span>';?><i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id='<?php echo $vartcid; ?>' class="collapse">
                            <li>
                                <a href="studentnew?refno=<?php echo $staffid; ?>&class=<?php echo $levelid; ?>&gid=<?php echo $optionid; ?>">Student</a>
                            </li>
                             <?php 
                             $classteacher_status="";
                                $formteachers=$SHteacher->allteacheredit3('formteacher','staffid', $staffid, 'levelid', $levelid, 'optionid', $optionid);
                                if (is_array($formteachers)) {
                                    foreach($formteachers as $formteachersrec){
                                        $classteacher_status=1;
                                  }
                              }
						
						
						
						if($classteacher_status==1){
              						?>
                            <li>
                                <a href="attendancenew?refno=<?php echo $staffid; ?>&class=<?php echo $levelid; ?>&gid=<?php echo $optionid; ?>">Attendance</a>
                            </li>
                            <li>
                                <a href="addnewstudent?refno=<?php echo $staffid; ?>&class=<?php echo $levelid; ?>&gid=<?php echo $optionid; ?>">New Student</a>
                            </li>
                           
                            <?php } ?>
                             <li>
                                <a href="examquestion?refno=<?php echo $staffid; ?>&tcid=<?php echo trim($teacherscoursesrec["icourseid"]); ?>">Exam Question Paper</a>
                            </li>
                            <li>
                              <a href="classmaterial?refno=<?php echo $staffid; ?>&tcid=<?php echo trim($teacherscoursesrec["icourseid"]); ?>">Class Materials</a>
                            </li>
                            
                            <li>
                                <a href="onlinetest?refno=<?php echo $staffid; ?>&tcid=<?php echo trim($teacherscoursesrec["icourseid"]); ?>">Online Assessment</a>
                            </li>
                           
                             
                            <li>
                                <a href="term_score?refno=<?php echo $staffid; ?>&tcid=<?php echo trim($teacherscoursesrec["icourseid"]); ?>">Term Score Upload</a>
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
                                <a href="resultreport?refno=<?php echo $staffid; ?>&tcid=<?php echo trim($teacherscoursesrec["icourseid"]);; ?>">Result Report</a>
                            </li>
                            <li>
                                <a href="result-comment?refno=<?php echo $staffid; ?>&tcid=<?php echo trim($teacherscoursesrec["icourseid"]);; ?>">Result Commenting</a>
                            </li>
                             
                            <?php  } ?>
                                
                        </ul>
                    </li>
                     <?php } 
	   				}
					else{
						echo '<a href="#" class="btn btn-info"> <i class="glyphicon glyphicon-download"></i>No Subject has been assign to you yet</a>';
				   }
				   
				   ?>    
				   
				    <?php
                    $levelid="";
                     $optionid="";
                     $optionname="";
                     $levelname="";
                     $csname="";
                     $icourseid="";
                     $courseid="";
                     $classtype="";
                     $t="";
			
            $teacherscourses=$SHteacher->allteacheredit('formteacher','staffid', $gid);
            if (is_array($teacherscourses)) {
                 $k=count($teacherscourses);
              foreach($teacherscourses as $teacherscoursesrec){

                $optionid=trim($teacherscoursesrec['optionid']);  
                $levelid=trim($teacherscoursesrec['levelid']); 
                
                $tcid="";
                 $classteacher_status="";

                $teacherscourses=$SHteacher->allteacheredit3('instructorcourses','staffid', $staffid, 'levelid', $levelid, 'optionid', $optionid);
                                if (is_array($teacherscourses)) {
                                    foreach($teacherscourses as $teacherscoursesrec){
                                       
                                        $tcid=trim($teacherscoursesrec['icourseid']);
                                  }
                              }

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

                $k-=1; $t+=1;			

				  if($k==0){$change="";}else{$change="border-bottom:1px solid #F2FFF0";}?>
               
                    
                    <li style="font:85% comic; font-weight:bold; <?php echo $change ?>">
                        <a href="javascript:;" data-toggle="collapse" data-target="#t<?php echo $t.$tcid;?>"><i class="fa fa-fw fa-edit"></i>Class Teacher of: <?php echo $levelname. " ".$optionname." ".'<span style="color:yellow">'.'<span>';?><i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="t<?php echo $t.$tcid;?>" class="collapse">
                          
                            <li>
                                <a href="studentnew?refno=<?php echo $staffid; ?>&staffid=<?php echo $levelid; ?>&gid=<?php echo $optionid; ?>">Student</a>
                            </li>
                            
                            <li>
                                <a href="attendancenew?refno=<?php echo $staffid; ?>&class=<?php echo $levelid; ?>&gid=<?php echo $optionid; ?>">Attendance</a>
                            </li>
                             <li>
                                <a href="classresources?refno=<?php echo $staffid; ?>&class=<?php echo $levelid; ?>&gid=<?php echo $optionid; ?>">Class Videos</a>
                            </li>
                           
                           
                           
                          
                            <li>
                                <a href="resultreport?refno=<?php echo $staffid; ?>&groupid=<?php echo $levelid; ?>&classid=<?php echo $levelid; ?>&tcid=<?php echo $tcid; ?>" >Result Report</a>
                            </li>
                                                        <li>
                                <a href="result-comment?refno=<?php echo $staffid; ?>&groupid=<?php echo $levelid; ?>&classid=<?php echo $levelid; ?>&tcid=<?php echo $tcid; ?>" >Result Commenting</a>
                            </li>
                           
                            <?php if ($classtype==1) { ?>
                              <li>
                                <a href="earlyterm_score?refno=<?php echo $tid; ?>&tcid=<?php echo $teacherscoursesrec["icourseid"]; ?>">Early class score</a>
                            </li>
                            <?php } ?>     
                        </ul>
                    </li>
                     <?php }
	   				}
					else{
						echo '<a href="#" class="btn btn-info"> <i class="glyphicon glyphicon-download"></i>You are not  a class teacher</a>';
				   }
				  
				   ?>    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        
        <!-- /#page-wrapper -->

  
