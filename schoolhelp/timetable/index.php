<?php
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHtimetableOOP.php");
confirmcheckin();
$SHtimetableOOP=new classTimetable;

$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);

/*$session=$SHtimetableOOP->alldashedit('session', 'status', 1);
if (is_array($session)) {
  foreach($session as $sessionrec){
   $sessionname= $sessionrec['sessionlow'].'|'.$sessionrec['sessionhigh'];
  }
}

$semester=$SHtimetableOOP->alldashedit('semesters', 'status', 1);
if (is_array($semester)) {
  foreach($semester as $semesterrec){
   $semestername= $semesterrec['semestername'];
  }
}*/

//this helps you to know the kind of driver you are using
//print_r(PDO::getAvailableDrivers());
 ?>

    <?php include("includes/header.php"); ?>
        <!-- page content -->
    <div class="right_col" role="main">
          <div class="">

          
            <div class="row">
              <div class="col-md-12" style="width: 100%">
                <div class="x_panel"  >
                  <div class="x_title">
                   <span style="float:left"> <h4>TimeTable Management</h4></span>
                   <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link" style="color:#d2dc2a;"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench" style="color:#d2dc2a;"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="../settings?schoolhelp=<?php echo $schoolhelp ?>">System Settings</a>
                          </li>
                          <li><a href="../?schoolhelp=<?php echo $schoolhelp ?>">Dashboard</a>
                          </li>
                        </ul>
                      </li>
                      <li><a  class="close-link" href="../index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-close " style="color:#d2dc2a;"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="row">

                    

                      <div class="col-md-55">
                         <a href="../?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none; "> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/home.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:red">Access the Home page</span>
                              <div class="tools tools-bottom">
                               <span  style="color:red">Home Page Modules</span>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size: 16px"> Dashboard</span></center>
                          </div>
                        </div>
                         </a>
                      </div>

                      <?php if ($admintype==1) { ?>
                      <div class="col-md-55">
                         <a href="daysinaweek?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/weektimetable.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Setup Weekly Days</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Add Names of days in a Week</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Days in a Weeks</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>
                      
                       <div class="col-md-55">
                         <a href="scheduletypes?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/classtype.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Activity Types</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Types of Timetable that can be scheduled</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Timetable Types</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>

                        <div class="col-md-55">
                         <a href="lecturetype?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/lecturetype.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Setup Lecture Type</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Practical or Theory</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Lecture Type</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>

                      <div class="col-md-55">
                         <a href="lecturehall?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/lecturehall1.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Add Lecture Halls</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">School Lecture Halls</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Lecture Hall</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>

                       <div class="col-md-55">
                         <a href="timetablesemester?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/timetables3.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Add Class Timetable</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Class Timetable Properties Setup for a Semester and Session</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Timetable Setup</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>

                       <div class="col-md-55">
                         <a href="timetableweek?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/weektimetable.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Timetable Weekly Content</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Setup Timetable Weekly features</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Week Content Setup</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>

                       <div class="col-md-55">
                         <a href="dailytimetable?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/timetables4.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Schedule dialy Lectures</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Setup daily courses for lectures and their timing</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Daily Lectures</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>

                      <div class="col-md-55">
                         <a href="copytimetable?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/duplicate.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Duplicate Weekly Timetable</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Copy a week daily timetable to another empty week</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Copy Timetable</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>

                      <div class="col-md-55">
                         <a href="printtimetable?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <!--<img  src="../images/duplicate.png" alt="image" class="img-responsive">-->
                            <span class="fa fa-print" style="font-size:70px; color:green"></span>
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Timetable Generation</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Print for a class, department and school</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Print Timetable</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                     
              </div>
            </div>
          </div>
        </div>
      

  </div>
</form>
</div>

       <?php include("includes/footer.php"); ?>