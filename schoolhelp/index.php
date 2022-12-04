<?php
include_once("includes/global.php");
include_once("includes/connection.php");
include_once("phpclass/SHdashOOP.php");
confirmcheckin();
$schoolhelpindex=new ClassDash;

$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);

$previlleges=$schoolhelpindex->alldashedit('adminpersons', 'adminid', $schoolhelp);
if (is_array($previlleges)) {

foreach($previlleges as $actualrecord){
  $guardian=trim($actualrecord['guardian_d']);
  $admintype=trim($actualrecord['admintype']);
  $dashedit_d=trim($actualrecord['dashedit_d']);
  $dashadd_d=trim($actualrecord['dashadd_d']);
  $dashdelete_d=trim($actualrecord['dashdelete_d']);
  $signatorypositionid=trim($actualrecord['signatorypositionid']);
  $attendance=trim($actualrecord['attendance_d']);
  $result=trim($actualrecord['result_d']);
  $idcard=trim($actualrecord['idcard_d']);
  $website=trim($actualrecord['website_d']);
  $staff=trim($actualrecord['staff_d']);
  $student=trim($actualrecord['student_d']);
  $guardianward=trim($actualrecord['guardianward_d']);
  $staffsubject=trim($actualrecord['staffsubject_d']);
  $leave=trim($actualrecord['leave_d']);
  $settings=trim($actualrecord['settings']);
  $medical=trim($actualrecord['medical_d']);
  $forecast=trim($actualrecord['forecast_d']);
  $timetable=trim($actualrecord['timetable_d']);
  $bursary=trim($actualrecord['bursary_d']);
  $cbt_d=trim($actualrecord['cbt_d']);
  $message_d=trim($actualrecord['message_d']);
}
  
}

$session=$schoolhelpindex->alldashedit('session', 'status', 1);
if (is_array($session)) {
  foreach($session as $sessionrec){
   $sessionname= $sessionrec['sessionlow'].'|'.$sessionrec['sessionhigh'];
  }
}

$semester=$schoolhelpindex->alldashedit('semesters', 'status', 1);
if (is_array($semester)) {
  foreach($semester as $semesterrec){
   $semestername= $semesterrec['semestername'];
  }
}

//this helps you to know the kind of driver you are using
//print_r(PDO::getAvailableDrivers());
 ?>

    <?php include("includes/header.php"); ?>
        <!-- page content -->
    <div class="right_col" role="main">
          <div class="">

            <div class="row top_tiles">
              <a href="students?studentstatus=1&schoolhelp=<?php echo $schoolhelp ?>">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-user fa-5x"></i></i></div>
                  <div class="count"><?php echo $schoolhelpindex->allTables('students', 'status', 1); ?></div>
                  <h3>Applied Students</h3>
                  <p>Online Applicants</p>
                </div>
              </div>
            </a>
             <a href="students?studentstatus=0&schoolhelp=<?php echo $schoolhelp ?>" >
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><!--<i class="fa fa-comments-o">--><i class="fa fa-users fa-5x"></i></i></div>
                  <div class="count"><?php echo $schoolhelpindex->allTables('students', 'status', 0); ?></div>
                  <h3>Active Students</h3>
                  <p>The records that are operational</p>
                </div>
              </div>
            </a>
              <a href="leaveapplication?leavestatus=0&schoolhelp=<?php echo $schoolhelp ?>" >
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-question"></i></div>
                  <div class="count"><?php echo $schoolhelpindex->allTables('leaveapplication', 'status', 0); ?></div>
                  <h3>Staff Leave</h3>
                  <p>Staff Commiserative Leave Application</p>
                </div>
              </div>
            </a>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count">
                    <?php echo $semestername; ?>
                  </div>
                  <h3><?php echo $sessionname; ?> </h3>
                  <p>Semester/Term</p>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12" style="width: 100%">
                <div class="x_panel"  >
                  <div class="x_title">
                   <span style="float:left"> <h4>DASHBOARD</h4></span>
                   <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link" style="color:#d2dc2a;" ><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench" style="color:#d2dc2a;"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <?php if ($settings==1) {?>
                          <li><a href="settings">System Settings</a>
                          </li>
                          <?php } ?>
                           <?php if ($result==1) {?>
                          <li><a href="result">Result </a></li>
                          <?php } ?>
                        </ul>
                      </li>
                      <li><a  class="close-link" ><i class="fa fa-close " style="color:#d2dc2a;"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="row">

                    
                      <?php if ($settings==1) {?>
                      <div class="col-md-55">
                         <a href="settings?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none; "> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="images/controlpanel.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:red">Avoid deleting of records</span>
                              <div class="tools tools-bottom">
                               <span  style="color:red">System Setup</span>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size: 16px"> Setup</span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                      
                      <?php if ($student==1) {?>
                       <div class="col-md-55">
                         <a href="students?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="images/students.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>single adding or multiple</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Add single, multiple, edit, and delete Student</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Student</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                        <?php if ($staff==1) {?>
                       <div class="col-md-55">
                         <a href="staff?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="images/staff.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>single adding or multiple</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Add single, multiple, edit, and delete Staff</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Staff</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                      <?php if ($guardian==1) {?>
                       <div class="col-md-55">
                         <a href="guardian?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="images/parent.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>single adding or multiple</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Add single, multiple, edit, and delete Guardian</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Guardian</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                      <?php if ($guardianward==1) {?>
                       <div class="col-md-55">
                         <a href="student2guardian?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="images/student2guardian.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Assign Student to a  Guardian</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Assign Ward to Guardian and view Guardian's Ward</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Student to Guardian</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                      <?php if ($idcard==1) {?>
                      <div class="col-md-55">
                         <a href="idcard/?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="images/studentid.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Print Student, Staff and Parent Passport</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Print passport for all</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Passport</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                        <?php } ?>

                        <?php if ($website==1) {?>
                       <div class="col-md-55">
                         <a href="website/?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="images/website.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>single adding or multiple</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Add Slides, News, Testimony, and Events</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Website</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                       <?php } ?>

                       <?php if ($staffsubject==1) {?>

                       <div class="col-md-55">
                         <a href="subjcourse?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="images/subject.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>View Assigned Course/Subject and Delete</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Assign Course/Subject to Instructors or Teachers</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Assign Subject</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                        <?php if ($result==1) {?>
                      <div class="col-md-55">
                         <a href="result?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="images/result.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Result Management</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Upload Scores, Print Broadsheet, Comment result etc</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Manage Result</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                        <?php if ($attendance==1) {?>
                      <div class="col-md-55">
                         <a href="attendance?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="images/attendance.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Check Present student</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Mark Student Attendance</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Attendance</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                        <?php if ($medical==1) {?>
                      <div class="col-md-55">
                         <a href="medical?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="images/medical.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Medical Commitment</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down"> Medical Treatment on a Student</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Medical</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                       <?php if ($leave==1) {?>
                      <div class="col-md-55">
                         <a href="leaveapplication?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="images/leaveapplication.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Leave Applications</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Staff Compassionate leave letters</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Staff Leave</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                    <?php if ($forecast==1) {?>
                      <div class="col-md-55">
                         <a href="calenda?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="images/calendar.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>School Dated Activity</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">School Planned and Proposed Activity</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>School Calenda</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                      <?php if ($timetable==1) {?>
                      <div class="col-md-55">
                         <a href="timetable?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="images/timetables.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Studies & Exam Schedules</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Lecture Activities and Exam Timetable</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Time Table</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                        <?php if ($bursary==1) {?>
                      <div class="col-md-55">
                         <a href="bursary?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="images/finance1.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>School Finance</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">School Financial Computations</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Bursary</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                      <?php if ($cbt_d==1) {?>
                      <div class="col-md-55">
                         <a href="cbt?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="images/assessment.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>CBT</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Computer Base Test</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Manage CBT</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                      <?php if ($message_d==1) {?>
                      <div class="col-md-55">
                         <a href="message?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="images/message.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Bulk SMS</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Manage Messages</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Messages</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>
                     
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

       <?php include("includes/footer.php"); ?>