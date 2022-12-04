<?php 

include("headernew.php"); ?>

<?php 
confirmcheckin();
$refno= trim((isset($_GET['refno'])?$_GET['refno']:false));
$stid =trim((isset($_SESSION['stid'.$refno])?$_SESSION['stid'.$refno]:false));
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
                        <h1 class="page-header" style="margin-top:4px; color:#063;">Dashboard <small></small></h1>
                        </div>
                </div>
                
				 <div class="row">
                    <div class="col-lg-11.8 col-xs-11.8 col-sm-11.8 col-md-11.8" style=" background:#FFF; padding:5px; margin:0% 2% 2%;">
                        
                          
                        <div class="row">
                       
			 
                    <div class="col-lg-3 col-xs-3 col-sm-3 col-md-3" style="">
                        <div class="panel panel-default" >
                            <div class="panel-heading dropdown" style="background:#D7FFEB;  height:100px"  align="center">
                            
                                <h3 class="panel-title dropdown-toggle" data-toggle="dropdown"><div ><img src="img/assessment.png"  class="img-responsive"/></div><span> Computer Based Test </span><i class="fa fa-fw fa-caret-down"></i></h3>
                   <ul class="dropdown-menu">
                      <li>
                                <a href="cbt?refno=<?php echo $stid;?>">Write Test</a>
                            </li>
                            <li>
                                <a href="cbt?refno=<?php echo $stid;?>&action=1">View Test Result</a>
                            </li>
                            
                                
                    </ul>
                            </div>
                            <!--<div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-fw fa-group"></i>Group: <span></span></h3>
                            </div>
                            <div class="panel-body">
                               <i class="fa fa-fw fa-book"></i>Subject: <span></span>
                            </div>-->
                        </div>
                    </div>
                    
                   <div class="col-lg-3 col-xs-3 col-sm-3 col-md-3" style="">
                        <div class="panel panel-default" style="">
                            <div class="panel-heading dropdown" style="background:#D7FFEB; height:100px "  align="center">
                            
                                <h3 class="panel-title dropdown-toggle" data-toggle="dropdown"><div ><img src="img/result2.png" class="img-responsive"/></div><span> Result </span><i class="fa fa-fw fa-caret-down"></i></h3>
                   <ul class="dropdown-menu">
                      <li>
                                <a href="result_check?refno=<?php echo $stid; ?>">Check Result</a>
                            </li>
                           
                            
                                
                    </ul>
                            </div>
                            <!--<div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-fw fa-group"></i>Group: <span><</span></h3>
                            </div>
                            <div class="panel-body">
                               <i class="fa fa-fw fa-book"></i>Subject: <span></span>
                            </div>-->
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-xs-3 col-sm-3 col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading dropdown" style="background:#D7FFEB; height:100px"  align="center">
                            
                                <h3 class="panel-title dropdown-toggle" data-toggle="dropdown"><div ><img src="img/attendance.png" class="img-responsive"/></div> <span>Student Daily Attendance </span><i class="fa fa-fw fa-caret-down"></i></h3>
                   <ul class="dropdown-menu">
                      <li>
                                <a href="student_attendance?refno=<?php echo $stid; ?>">Attendance</a>
                            </li>
                           
                    </ul>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-xs-3 col-sm-3 col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading dropdown" style="background:#D7FFEB; height:100px"  align="center">
                            
                                <h3 class="panel-title dropdown-toggle" data-toggle="dropdown"><div ><img src="img/bursary.png" class="img-responsive"/></div><span> School Fees </span><i class="fa fa-fw fa-caret-down"></i></h3>
                   <ul class="dropdown-menu">
                      <li>
                         <!--<a href="school-fee?refno=<?php //echo $stid; ?>">Fees</a>-->
                                <a href="#">Fees</a>
                            </li>
                           
                            
                                
                    </ul>
                            </div>
                           
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-xs-3 col-sm-3 col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading dropdown" style="background:#D7FFEB; height:100px"  align="center">
                            
                                <h3 class="panel-title dropdown-toggle" data-toggle="dropdown"><div ><img src="img/timetables.png" class="img-responsive"/></div><span> Class Time Table </span><i class="fa fa-fw fa-caret-down"></i></h3>
                   <ul class="dropdown-menu">
                      <li>
                                <a href="time-table?refno=<?php echo $stid; ?>">Time Table</a>
                               
                            </li>
                           
                            
                                
                    </ul>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-xs-3 col-sm-3 col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading dropdown" style="background:#D7FFEB; height:100px"  align="center">
                            
                                <h3 class="panel-title dropdown-toggle" data-toggle="dropdown"><div ><img src="img/mLearn.png" class="img-responsive" style="width:50px"/></div> <span>Subject Material </span><i class="fa fa-fw fa-caret-down"></i></h3>
                   <ul class="dropdown-menu">
                      <li >
                                <a  class="check" href="materials-download?refno=<?php echo $stid; ?>">Download Subject Material</a>
                            </li>
                            
                            
                                
                    </ul>
                            </div>
                          
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-xs-3 col-sm-3 col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading dropdown" style="background:#D7FFEB; height:100px"  align="center">
                            
                                <h3 class="panel-title dropdown-toggle" data-toggle="dropdown"><div ><img src="img/medical.png" class="img-responsive" /></div> <span>Medical Reports </span><i class="fa fa-fw fa-caret-down"></i></h3>
                   <ul class="dropdown-menu">
                      <li>
                        <a href="medical-report?refno=<?php echo $stid; ?>">Reports</a>
                                
                            </li>
                           
                            
                                
                    </ul>
                            </div>
                          
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-xs-3 col-sm-3 col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading dropdown" style="background:#D7FFEB; height:100px"  align="center">
                            
                                <h3 class="panel-title dropdown-toggle" data-toggle="dropdown"><div ><img src="img/calendar.png" class="img-responsive"/></div><span> School Calenda </span><i class="fa fa-fw fa-caret-down"></i></h3>
                   <ul class="dropdown-menu">
                      <li>
                      
                               <a class="check" href="school-calenda?refno=<?php echo $stid; ?>">Calenda</a>
                            </li>
                            
                    </ul>
                            </div>
                            <!--<div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-fw fa-group"></i>Group: <span><</span></h3>
                            </div>
                            <div class="panel-body">
                               <i class="fa fa-fw fa-book"></i>Subject: <span></span>
                            </div>-->
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-xs-3 col-sm-3 col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading dropdown" style="background:#D7FFEB; height:100px"  align="center">
                            
                                <h3 class="panel-title dropdown-toggle" data-toggle="dropdown"><div ><img src="img/ppa.png" class="img-responsive" style="width:50px"/></div><span> PTA Meeting </span><i class="fa fa-fw fa-caret-down"></i></h3>
                   <ul class="dropdown-menu">
                      <li>
                        <!--<a  class="check" href="ppa-meeting?refno=<?php //echo $stid; ?>">Meeting</a>-->
                                <a  class="check" href="#">Meeting</a>
                            </li>
                            
                            
                                
                    </ul>
                            </div>
                           
                        </div>
                    </div>
                    
                    
                        </div>
                    </div>
                       
                    </div>
                   
                </div>
                        
                        
                    </div>
                </div>
               
                
                <!-- /.row -->

                

        </div>
 <?php include("footernew.php");?>