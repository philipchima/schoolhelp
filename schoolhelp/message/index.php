<?php
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHmessageOOP.php");
confirmcheckin();
$schoolhelpindex=new classMessage;

$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);

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
                   <span style="float:left"> <h4>Message Management</h4></span>
                   <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link" style="color:#d2dc2a;"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench" style="color:#d2dc2a;"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="../settings?schoolhelp=<?php echo $schoolhelp ?>">System Settings</a>
                          </li>
                          <li><a href="index?schoolhelp=<?php echo $schoolhelp ?>">Message Dashboard</a>
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

                      
                      
                       <div class="col-md-55">
                         <a href="messastudent?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/sendmessage.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Send Message</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Send Message to Students </i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Student Messages</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>


                       <div class="col-md-55">
                         <a href="messastudent?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/sendmessage.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Send Message</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Send Message to Teachers </i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Teacher's Message</b></span></center>
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