<?php
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHresultOOP.php");
confirmcheckin();
$schoolhelpindex=new classResult;

$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$previlleges=$schoolhelpindex->allresultedit('adminpersons', 'adminid', $schoolhelp);
if (is_array($previlleges)) {

foreach($previlleges as $actualrecord){
  $template_r=trim($actualrecord['template_r']);
  $admintype=trim($actualrecord['admintype']);
  $uploadscore_r=trim($actualrecord['uploadscore_r']);
 
  $earlyscore_r=trim($actualrecord['earlyscore_r']);
  $scoresheet_r=trim($actualrecord['scoresheet_r']);
  $broadsheet_r=trim($actualrecord['broadsheet_r']);
  $resultactivation_r=trim($actualrecord['resultactivation_r']);
  $resultcolor_r=trim($actualrecord['resultcolor_r']);
  $termduration_r=trim($actualrecord['termduration_r']);
  $comment_r=trim($actualrecord['comment_r']);
  $reportcard_r=trim($actualrecord['reportcard_r']);
  $addcomment_r=trim($actualrecord['addcomment_r']);
  $resultsample_r=trim($actualrecord['resultsample_r']);
  $promotion_r=trim($actualrecord['promotion_r']);
  $resultreversal_r=trim($actualrecord['resultreversal_r']);
  $resultspecification_r=trim($actualrecord['resultspecification_r']);
  $resultadd_r=trim($actualrecord['resultadd_r']);
  $resultdelete_d=trim($actualrecord['resultdelete_r']);
   $resultedit_r=trim($actualrecord['resultedit_r']);
  
}
  
}

/*$session=$schoolhelpindex->alldashedit('session', 'status', 1);
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
                   <span style="float:left"> <h4>Result Management</h4></span>
                   <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link" style="color:#d2dc2a;"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench" style="color:#d2dc2a;"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="../settings?schoolhelp=<?php echo $schoolhelp ?>">System Settings</a>
                          </li>
                          <li><a href="index?schoolhelp=<?php echo $schoolhelp ?>">Result Settings</a>
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

                      
                      <?php if ($template_r==1) {?>
                       <div class="col-md-55">
                         <a href="template?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/template.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Print Score Template</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">This Accomodates filling of Scores Manually </i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Template</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                       <?php } ?>

                       <?php if ($uploadscore_r==1) {?>
                        <div class="col-md-55">
                         <a href="scoreupload?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/score.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Score Upload</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down"> Upload Result Scores</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Upload Score</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>


                      <?php if ($earlyscore_r==1) {?>
                      <div class="col-md-55">
                         <a href="earlyscoreupload?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/score.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Pre-school/Score Upload</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Early class Scores Upload</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Early Score</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                       <?php if ($scoresheet_r==1) {?>
                       <div class="col-md-55">
                         <a href="scoresheet?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/broadsheet.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Finalize Result</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down"> View class Score Sheet with the assessment scores</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Score Sheet</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                       <?php if ($broadsheet_r==1) {?>
                       <div class="col-md-55">
                         <a href="broadsheet?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/result.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Print Result Broadsheet</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down"> View class Broad for the student</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Broadheet</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                      <?php if ($resultactivation_r==1) {?>
                      <div class="col-md-55">
                         <a href="resultactivation?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/activate.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Result functions activation</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Format Your Result</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Result Activation</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>
                      
                        <?php if ($resultcolor_r==1) {?>
                       <div class="col-md-55">
                         <a href="resultcolor?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/coloricon.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Apply color to your result</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Set colors to your result</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Result Color</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                        <?php if ($termduration_r==1) {?>
                        <div class="col-md-55">
                         <a href="termdetails?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/term.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Set Up term duration details</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Set up Term starting date and Ending date</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Term Duration</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                      <?php if ($comment_r==1) {?>
                       <div class="col-md-55">
                         <a href="resultcomment?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/comment.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Form Teacher/Course Adviser Commment</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">HOD/Principal Comments</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Comment Result</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                      <?php if ($reportcard_r==1) {?>
                       <div class="col-md-55">
                         <a href="report?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;" target="new_blank"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/resultcard.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Print Student Report Card</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Generate Result for a student</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Report Card</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                      

                      <?php if ($addcomment_r==1) {?>
                       <div class="col-md-55">
                         <a href="setupcomment?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/addcomment.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Customize Your result comment</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Add result comment to the database</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Add Comment</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                        <?php if ($resultsample_r==1) {?>
                       <div class="col-md-55">
                         <a href="resultsample?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"  > 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/template.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Select a result sample</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Result Sample for a school</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Result Sample</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                        <?php if ($promotion_r==1) {?>
                       <div class="col-md-55">
                         <a href="promotion?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"  > 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/promote.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Promote a class</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">promotion starts from the highest class</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Promotion</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                       <?php if ($resultreversal_r==1) {?>
                      <div class="col-md-55">
                         <a href="resultreversal?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"  > 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/reverse.jpg" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Promote a class</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Reverse already generated result</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Result Reversal</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>

                       <?php if ($resultspecification_r==1) {?>
                       <div class="col-md-55">
                         <a href="resultspecific?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"  > 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/Specific.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Result Specification</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Student Result Specification</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Result Specification</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>
                     
              </div>
            </div>
          </div>
        </div>
      

  </div>
</form>
</div>

       <?php include("includes/footer.php"); ?>