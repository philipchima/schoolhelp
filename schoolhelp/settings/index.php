
<?php include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/schoolhelpOOP.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
confirmcheckin();

// Checking page access Authenticity
$schoolhelpsetting=new Allsettings;
$previllages=$schoolhelpsetting->allsettingedit('adminpersons', 'adminid', $schoolhelp);
foreach($previllages as $actualrecord){
  //$pageaccess=trim($actualrecord['signatorycomment_s']);
  $settingedit_s=trim($actualrecord['settingedit_s']);
  $settingdelete_s=trim($actualrecord['settingdelete_s']);
  $settingadd_s=trim($actualrecord['settingadd_s']);
  $signatorycomment_s=trim($actualrecord['signatorycomment_s']);
   $adminperson_s=trim($actualrecord['adminperson_s']);
   $settings=trim($actualrecord['settings']);
   $domain_s=trim($actualrecord['domain_s']);
   $pin_s=trim($actualrecord['pin_s']);
   $backup_s=trim($actualrecord['backup_s']);
   $activation_s=trim($actualrecord['activation_s']);
   $institution_s=trim($actualrecord['institution_s']);
   $department_s=trim($actualrecord['department_s']);
   $result_d=trim($actualrecord['result_d']);
   $semester_s=trim($actualrecord['semester_s']);
   $level_s=trim($actualrecord['level_s']);
   $option_s=trim($actualrecord['option_s']);
   $course_s=trim($actualrecord['course_s']);
   $title_s=trim($actualrecord['title_s']);
    $passmark_s=trim($actualrecord['passmark_s']);
   $qualification_s=trim($actualrecord['qualification_s']);
    $grade_s=trim($actualrecord['grade_s']);
   $assessment_s=trim($actualrecord['assessment_s']);
   $session_s=trim($actualrecord['session_s']);
   $housedivision_s=trim($actualrecord['housedivision_s']);
   $formteacher_s=trim($actualrecord['formteacher_s']);
   $signatoryperson_s=trim($actualrecord['signatoryperson_s']);
   $result_d=trim($actualrecord['result_d']);
  
}
if ($settings!=1) {
  echo "<b style='font-size:100; color:red'>Criminal Attempt Made, contact the admin ask for the access of this page</b>";
  exit();
}
//this helps you to know the kind of driver you are using
//print_r(PDO::getAvailableDrivers());
include("includes/header.php"); ?>

    
        <!-- page content -->
    <div class="right_col" role="main">
         

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>System Settings</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up" style="color:#d2dc2a;"></i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench" style="color:#d2dc2a;"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <?php if ($settings==1) { ?>
                          <li><a href="settings">System Settings</a></li>
                          <?php } ?>
                           <?php if ($result_d==1) { ?>
                          <li><a href="../result">Result</a></li>
                          <?php } ?>
                        </ul>
                      </li>
                      <li><a href="../?schoolhelp=<?php echo $schoolhelp; ?>" class="close-link"><i class="fa fa-close" style="color:#d2dc2a;"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="row">

                    

                      <div class="col-md-55">
                         <a href="../?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/home.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Access to all modules</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white" class="fa fa-arrow-left"></i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060"><b>Dashboard</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php if ($department_s==1) { ?>
                      <div class="col-md-55">
                         <a href="schools?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/school.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>View, Add and Edit</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white" class="fa fa-hand-o-down"></i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Departments</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>
                      <?php if ($institution_s==1) { ?>
                       <div class="col-md-55">
                         <a href="institution?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/institution.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>View, Add and Edit</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white" class="fa fa-hand-o-down"></i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Institution</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                    <?php } ?>
                      <?php if ($semester_s==1) { ?>
                       <div class="col-md-55">
                         <a href="semesters?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/term.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>View, Add and Edit</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white" class="fa fa-hand-o-down"></i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Semesters</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>
                      <?php if ($level_s==1) { ?>
                       <div class="col-md-55">
                         <a href="level?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/level.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>View, Add and Edit</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:12px;" class="fa fa-hand-o-down">Different Level in a department(school)</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Level(classes)</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>
                      
                      <?php if ($option_s==1) { ?>        
                      <div class="col-md-55">
                         <a href="option?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/group.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>View, Add and Edit</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:12px;" class="fa fa-hand-o-down">Groups in a class</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Options</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                      <?php if ($course_s==1) { ?>   
                       <div class="col-md-55">
                         <a href="course?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/subject.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>View, Add and Edit</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Attach courses to options of different level</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Courses</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>
                      <?php if ($title_s==1) { ?> 
                       <div class="col-md-55">
                         <a href="title?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/title.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>View, Add and Edit</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white" class="fa fa-hand-o-down"></i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Titles</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                       <?php } ?>
                      
                       <?php if ($qualification_s==1) { ?> 
                       <div class="col-md-55">
                         <a href="qualifications?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/title.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>View, Add and Edit</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white" class="fa fa-hand-o-down"></i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Qualifications</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                        <?php } ?>

                         <?php if ($grade_s==1) { ?> 
                      <div class="col-md-55">
                         <a href="grade?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/grade.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>View, Add and Edit</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Upload the grades</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Grade</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>
                      <?php if ($assessment_s==1) { ?> 
                      <div class="col-md-55">
                         <a href="assessment?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/assessment.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>View, Add and Edit</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Set Assessments based on department</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Assessment</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>
                      <?php if ($passmark_s==1) { ?> 
                      <div class="col-md-55">
                         <a href="passmark?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/passmark.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>View, Add and Edit</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Set Passmark for each Class</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Passmark</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>
                      <?php if ($session_s==1) { ?> 
                      <div class="col-md-55">
                         <a href="session?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/session.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>View, Add and Edit</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">This should be added at the of a session</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Session</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>
                      <?php if ($housedivision_s==1) { ?> 

                      <div class="col-md-55">
                         <a href="housedivision?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/divisions.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>View, Add and Edit</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">School's various interhouse sports division or house</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>House/Division</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>
                      <?php if ($formteacher_s==1) { ?> 

                       <div class="col-md-55">
                         <a href="formteacher?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/teacher.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b></b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Assign Level's Option (Class's Arm) to a Teacher</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Form Teacher</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                        <?php } ?>
                      <?php if ($signatoryperson_s==1) { ?> 

                      <div class="col-md-55">
                         <a href="signatoryposition?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/signatoryposition.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Departmental Head</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Assign a Staff position</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Signatory Person</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                       <?php } ?>
                  <?php if ($adminperson_s==1) { ?>
                      <div class="col-md-55">
                         <a href="adminperson?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/admins.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Administrative Operator</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Assign Signatory Person(staff) as an Sub-Admin</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Admin</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                      <?php if ($signatorycomment_s==1) { ?>
                      
                       <div class="col-md-55">
                         <a href="signatorycomment?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/signatorycomment.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Upload Comment for a Signatory Position</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Upload for a staff assigned to a position</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Signatory Comment</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                       <?php if ($domain_s==1) { ?>
                       <div class="col-md-55">
                         <a href="domaintype?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/domain.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Add various Schools Domain</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Add Departmental Domain Types and Do</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Domain</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                       <?php if ($pin_s==1) { ?>
                       <div class="col-md-55">
                         <a href="pingeneration?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/pincode.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Generation of generation</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Adding Students and Guardian login Pin Pins</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Pin Generation</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                       <?php if ($activation_s==1) { ?>
                       <div class="col-md-55">
                         <a href="activation?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/activate.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Activation of Various things</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Activate Necessary things</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Activation</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                       <?php if ($backup_s==1) { ?>
                       <div class="col-md-55">
                         <a href="backupdb?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/backup.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Your Database can be saved</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Please Backup your database for easy recovery</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Backup Database</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                       
                       <div class="col-md-55" title="Early Classes Category Setup">
                         <a href="earlyclasscategory?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/classtype.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Early Class Result</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Early Class Result Categories Setup</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Category</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>

                      <div class="col-md-55" title="Early Classes Category Setup">
                         <a href="earlycatsub?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/classtype.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Early Class Sub Category Setup</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Early Class Result Sub Category Setup</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Sub Titles</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                     
                      <div class="col-md-55" title="please Setup the grades that will be will be obtainnable in the early class result">
                         <a href="earlygrade?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/classtype.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Early Class Grade Setup</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Early class grades</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Early Grade</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                    
                    </div>
                  </div>
                </div>
              </div>
            </div>

           

                  </div>
                </div>
              </div>
            </div>





           

             

             
            </div>
          </div>
        </div>
        <!-- /page content -->

       <?php include("includes/footer.php"); ?>