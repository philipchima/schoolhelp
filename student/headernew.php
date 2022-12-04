<?php

include_once("includes/global.php"); 
include_once ("phpclass/SHstudentOOP.php");
include_once ("phpclass/SHstudentupdate.php");
include_once ("phpclass/SHstudentothers.php");

confirmcheckin();
$page=(isset($_GET['page'])? $_GET['page']:false);
$refno= (isset($_GET['refno'])? $_GET['refno']:false);
$stid =(isset($_SESSION['stid'.$refno])?$_SESSION['stid'.$refno]:false);
 $SHstudent=new classStudent;
 $schoolhelpupdate=new updateTable;

  //Select current term/semester
        $semesterdata=$SHstudent->allstudentedit('semesters','status', 1);
            if (is_array($semesterdata)) {
                foreach($semesterdata as $semesterrecord){
                    $semestername=$semesterrecord['semestername'];
                    $semesterid=trim($semesterrecord['semesterid']);
                    
              }
          }

        //Select current Session
         $sessiondata=$SHstudent->allstudentedit('session','status', 1);
            if (is_array($sessiondata)) {
                foreach($sessiondata as $sessiondrecord){
                    $sessionname=$sessiondrecord['sessionlow']."/".$sessiondrecord['sessionhigh'];
                    $sessionid=trim($sessiondrecord['sessionid']);    
              }
          }

$fullname="";
//Getting all the student Information
$studentclass= $SHstudent->allstudentedit('students', 'stid', $stid);
            if (is_array($studentclass)) {
              foreach($studentclass as $studentclassrec){
                $fullname=$studentclassrec['surname']." ".$studentclassrec['othername'];
                $levelid=trim($studentclassrec['levelid']);
                $optionid=trim($studentclassrec['optid']);
                  }
              }

//Getting the class information
            $studentsclass=$SHstudent->allstudentedit('level', 'levelid', $levelid);
            if (is_array($studentsclass)) {
              foreach($studentsclass as $studentsclassrec){
                $levelname=$studentsclassrec['levelname'];
                $departmentid=trim($studentsclassrec['departmentid']);
                  }
              }
            
              //Getting the Group information
            $studentsgroup=$SHstudent->allstudentedit('optiontable','optid', $optionid);
            if (is_array($studentsgroup)) {
                foreach($studentsgroup as $studentgrouprec){
                    $optionname=$studentgrouprec['optname'];
              }
          }

$positiontable=trim("positionresult".$departmentid);
?>
<!DOCTYPE html>
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
	<link rel="icon" href="img/schoolhelpicon.png">
    <!-- Bootstrap Core CSS -->
     
    <link rel="stylesheet" href="../css/bootswatch.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="css/forindexonly.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
     <link href='calendar/fullcalendar/fullcalendar.css' rel='stylesheet' />
	<link href='calendar/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />  
               
</head>

<body style="background:#FFF;">

    <div id="wrapper">

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
                <a class="navbar-brand" href="index.php"><img src="img/schoolhelplogo1.png" alt="SCHOOL HELP"></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
               
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#FFF"><i class="fa fa-user" style="color:#FFF"></i> <?php echo $fullname; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu dropdown-toggle">
                        <li>
                            <a href="studentprofile?refno=<?php echo $stid; ?>"><i class="fa fa-fw fa-user"></i>Profile</a>
                        </li>
                       
                        <li>
                            <a href="studentchangepassword?refno=<?php echo $stid; ?>&page=1"><i class="fa fa-fw fa-gear"></i>Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a onclick="if(confirm('Are You sure you want to logout')); logout('<?php echo $stid; ?>');"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse" >
           
                <ul class="nav navbar-nav side-nav" style="border:0px; color:#FFF;">
                 <div style="text-align:center;"><a href="#"><i class="fa fa-user fa-5x" style="color:#FFF;"></i></a></div>
                
                    <li class="active" >
                        <a href="dashboard?refno=<?php echo $stid; ?>"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    
                    
                    <li style="font:85% comic; font-weight:bold; border-bottom:2px solid #FFF ">
                        <a href="javascript:;" data-toggle="collapse" data-target="#cbt"><i class="glyphicon glyphicon-pencil">&nbsp;</i><span>Computer Based Test</span> <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="cbt" class="collapse">
                            <li>
                                <a href="cbt?refno=<?php echo $stid;?>">Write Test</a>
                            </li>
                            <li>
                                <a href="cbt?refno=<?php echo $stid;?>&action=1">View Test Result</a>
                            </li>
                            
                        </ul>
                    </li>
                    
                    <li style="font:85% comic; font-weight:bold;  border-bottom:2px solid #FFF ">
                        <a href="javascript:;" data-toggle="collapse" data-target="#result"><i class="glyphicon glyphicon-book">&nbsp;</i><span>Result</span> <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="result" class="collapse">
                            <li>
                                <a href="result_check?refno=<?php echo $refno; ?>">Check Result</a>
                            </li>
                            
                            
                        </ul>
                    </li>
                
                <li style="font:85% comic; font-weight:bold;  border-bottom:2px solid #FFF ">
                        <a href="javascript:;" data-toggle="collapse" data-target="#attendance"><i class="glyphicon glyphicon-briefcase">&nbsp;</i><span>Student Daily Attendance</span> <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="attendance" class="collapse">
                            <li>
                                <a href="student_attendance?refno=<?php echo $refno; ?>">Attendance</a>
                            </li>
                            
                            
                        </ul>
                    </li>
                
                   
                
                
                   <li style="font:85% comic; font-weight:bold;  border-bottom:2px solid #FFF ">
                        <a href="javascript:;" data-toggle="collapse" data-target="#fee"><i class="glyphicon glyphicon-briefcase">&nbsp;</i><span>School Fees</span> <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="fee" class="collapse">
                            <li>
                                <!--<a href="school-fee?refno=<?php //echo $refno; ?>">Fees</a>-->
                                 <a href="#">Fees</a>
                            </li>
                            
                            
                        </ul>
                    </li>
                    
                    <li style="font:85% comic; font-weight:bold;  border-bottom:2px solid #FFF ">
                        <a href="javascript:;" data-toggle="collapse" data-target="#Class"><i class="glyphicon glyphicon-time">&nbsp;</i><span>Class Time-Table</span> <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="Class" class="collapse">
                            <li>
                                
                                 <!--<a href="time-table?refno=<?php //echo $stid; ?>">Time Table</a>-->
                                <a href="#">Time Table</a>
                            </li>
                            
                            
                        </ul>
                    </li>
                    
                   <li style="font:85% comic; font-weight:bold;  border-bottom:2px solid #FFF ">
                        <a href="javascript:;" data-toggle="collapse" data-target="#Materials"><i class="glyphicon glyphicon-download-alt">&nbsp;</i><span>Subject Materials</span> <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="Materials" class="collapse">
                            <li>
                                <a href="materials-download?refno=<?php echo $stid; ?>">Download Subject Materials</a>
                            </li>
                            
                            
                        </ul>
                    </li>
                    
                    
                   <li style="font:85% comic; font-weight:bold;  border-bottom:2px solid #FFF ">
                        <a href="javascript:;" data-toggle="collapse" data-target="#Reports"><i class="glyphicon glyphicon-eye-close">&nbsp;</i><span>Medical Report</span> <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="Reports" class="collapse">
                            <li>
                                <!-- <a href="medical-report?refno=<?php //echo $stid; ?>">Reports</a>-->
                                <a href="#">Reports</a>
                            </li>
                            
                            
                        </ul>
                    </li>
                    
                    
                   <li style="font:85% comic; font-weight:bold;  border-bottom:2px solid #FFF ">
                        <a href="javascript:;" data-toggle="collapse" data-target="#Calendar"><i class="glyphicon glyphicon-briefcase">&nbsp;</i><span>School Calendar</span> <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="Calendar" class="collapse">
                            <li>
                               <a class="check" href="#">Calenda</a>
                                <!--<a class="check" href="school-calenda?refno=<?php //echo $stid; ?>">Calenda</a>-->
                            </li>
                            
                            
                        </ul>
                    </li>
                    
                    
                   <li style="font:85% comic; font-weight:bold; ">
                        <a href="javascript:;" data-toggle="collapse" data-target="#meeting"><i class="glyphicon glyphicon-envelope">&nbsp;</i><span>PTA-Meeting</span> <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="meeting" class="collapse">
                            <li>
                                <!--<a  class="check" href="ppa-meeting?refno=<?php //echo $stid; ?>">Meeting</a>-->
                                <a  class="check" href="#">Meeting</a>
                            </li>
                            
                            
                        </ul>
                    </li>
                
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        
        <!-- /#page-wrapper -->

  
