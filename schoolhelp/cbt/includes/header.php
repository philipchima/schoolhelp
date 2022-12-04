
<?php 
//include_once("includes/global.php");
include_once("../phpclass/SHresultOOP.php");
$schoolhelpheader= new classResult;
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);

$previlleges=$schoolhelpheader->allresultedit('adminpersons', 'adminid', $schoolhelp);
if (is_array($previlleges)) {

foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['cbt_d']);
  $admintype=trim($actualrecord['admintype']);
  $dashedit_d=trim($actualrecord['dashedit_d']);
  $dashadd_d=trim($actualrecord['dashadd_d']);
  $dashdelete_d=trim($actualrecord['dashdelete_d']);
  $signatorypositionid=trim($actualrecord['signatorypositionid']);

  $result=trim($actualrecord['result_d']);
  $idcard=trim($actualrecord['idcard_d']);
  $website=trim($actualrecord['website_d']);
  $staff=trim($actualrecord['staff_d']);
  $student=trim($actualrecord['student_d']);
  $guardianward=trim($actualrecord['guardianward_d']);
  $staffsubject=trim($actualrecord['staffsubject_d']);
  $settings=trim($actualrecord['settings']);
  $guardian=trim($actualrecord['guardian_d']);
}
  
}

if ($pageaccess!=1) {
  echo "<b style='font-size:100; color:red'>Criminal Attempt Made, contact the admin ask for the access of this page</b>";
  exit();
}

$adminsurname1="";
$adminothername1="";
$instilogo="";

   $records1=$schoolhelpheader->allresultedit('adminpersons', 'adminid', $schoolhelp);
                    if (is_array($records1)) {
                      $signatoryposition1="";
                      $departmentid1="";
                      $staffid1="";
                      $passport1="";
                      $positionname1="";
                   
                     foreach($records1 as $fieldrecord1){
                                
                               $admintype1=trim($fieldrecord1['admintype']);
                               $adminsurname1= trim($fieldrecord1['surname']);
                               $adminothername1= trim($fieldrecord1['othername']);
                               $email1= trim($fieldrecord1['email']);
                             
                               $address1=trim($fieldrecord1['address']);
                               $phone1=trim($fieldrecord1['phone']);
                               $email1=trim($fieldrecord1['email']);
                               $logintime1=$fieldrecord1['logintime'];
                               $logouttime1=$fieldrecord1['logouttime'];
                               $signatorypositionid1=trim($fieldrecord1['signatorypositionid']);

                               if ($admintype1==1) {
                                  $positionname1="Super Admin";
                                  $photo1="../images/swifto_logo.png";
                                  $department1="General";

                                  //To retrieve any schools logo
                                   $logodata1=$schoolhelpheader->allresult('institution', 'i_id',  'ASC');
                                           if(is_array($logodata1)){
                                              foreach($logodata1 as $logorec1){
                                                $photologo=$logorec1['instilogo'];
                                                $instilogo="../images/logo/".$photologo;
                                              }
                                            }

                                } else{
                                  

                                  //Getting Staff ID
                                        $signatorydata1=$schoolhelpheader->allresultedit('signatoryposition', 'signatorypositionid',  $signatorypositionid1);
                                           if(is_array($signatorydata1)){
                                              foreach($signatorydata1 as $signatoryrec1){
                                                $positionname1=$signatoryrec1['positionname'];
                                                $staffid1=$signatoryrec1['staffid'];
                                                
                                                $departmentid1=$signatoryrec1['departmentid'];
                                              }
                                            }

                                             $logodata1=$schoolhelpheader->allresultedit('institution', 'departmentid',  $departmentid1);
                                           if(is_array($logodata1)){
                                              foreach($logodata1 as $logorec1){
                                                $photologo=$logorec1['instilogo'];
                                                $instilogo="../images/logo/".$photologo;
                                              }
                                            }

                                        //Getting Staff ID
                                        $staffdata1=$schoolhelpheader->allresultedit('staff', 'staffid',  $staffid1);
                                           if(is_array($staffdata1)){
                                              foreach($staffdata1 as $staffrec1){
                                                $adminsurname1=$staffrec1['surname'];
                                                $adminothername1=$staffrec1['othername'];
                                                $address1=$staffrec1['address'];
                                                $phone1=$staffrec1['phone'];
                                                $email1=$staffrec1['email'];
                                                $passport1=$staffrec1['passport'];
                                                
                                              }
                                            }
                                            //getting department Name
                                             $departmentdata1=$schoolhelpheader->allresultedit('department', 'did',  $departmentid1);
                                           if(is_array($departmentdata1)){
                                              foreach($departmentdata1 as $departmentrec1){
                                                $departmentname1=$departmentrec1['deptname'];
                                              }
                                            }
                                            $photo1="../images/uploads/staff/".$passport1;
                                }
                              }
                            }

            ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>School Help| School Management Application</title>
    <!--Schoolhelp icon -->
    <link rel="shortcuticon icon" type="image/x-icon" href="../images/schoolhelpicon.png">

    
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


      <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <!-- Schoolhelpcss Theme Style -->
    <link href="../css/schoolhelpstyle.css" rel="stylesheet">

  </head>

  <body class="nav-md">
    <div class="row" style="background:#063; margin: 0px; padding:0px">
      <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12" style="margin: 0px; padding:0px">
     <!-- top navigation -->
        <div class="top_nav" style="margin: 0px; padding:0px; ">
          <div class="nav_menu" style="background:#060">
            <nav>
              <div class="row">
              <div class="nav toggle col-lg-1" style="padding-top: 10px; padding-bottom: 0px">
                <a  id="menu_toggle" ><i class="fa fa-bars" style="color:#d2dc2a" ></i></a>
              </div>
              <div class="col-lg-3" style="padding-top: 10px; padding-bottom: 0px">
              <img  src="../images/schoolhelplogo1.png" class="img img-responsive" >
            </div>
              <div class="col-lg-6 col-md-6  col-xs-6 col-sm-6   pull-right" >
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img   src="<?php echo $photo1; ?>"  class="img-responsive img-thumbnail" alt="" ><b style="color:white"><?php echo $adminsurname1. " ".$adminothername1; ?>
                    </b><span class=" fa fa-angle-down" style="color:#d2dc2a" ></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="../adminprofile?schoolhelp=<?php echo $schoolhelp; ?>&page=5"> Profile</a></li>
                    <li>
                      <a href="../adminprofile?schoolhelp=<?php echo $schoolhelp; ?>">
                        
                        <span>Change Password</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="../../logout?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o" style="color:#d2dc2a" ></i>
                    <span class="badge bg-green" >6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <!--
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>-->
                 
                      <!--<div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>-->
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
      </div>
    </div>


    <div class="container body" >
      <div class="main_container" >
        <div class="col-md-3 left_col" >
          <div class="left_col scroll-view">
            <span  style="border: 0;  ">
            <center><div><a href="../index?schoolhelp=<?php echo $schoolhelp;?>" class="site_title"><img src="<?php echo $instilogo; ?>" class="img-responsive" style="width:85px"></a></div>
            </center></span>

            <div class="clearfix" style="background:#063;"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix" style="background:#063;">
              <div class="profile_pic">
                <img src="<?php echo $photo1; ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h4 style="color:white"><?php echo $positionname1; ?></h4>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" style="background:#063;">
              <div class="menu_section">
                <h3>Dashboard</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="../index?schoolhelp=<?php echo $schoolhelp; ?>">Dashboard</a></li>
                      <?php if ($settings==1) { ?>
                       <li><a href="index?schoolhelp=<?php echo $schoolhelp; ?>">Setting</a></li>
                      <?php } ?>  
                    </ul>
                  </li>
                  
                  <li><a><i class="fa fa-table"></i> Student <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if ($student==1) { ?>
                      <li><a href="../students?schoolhelp=<?php echo $schoolhelp; ?>">Student</a></li>
                      <?php } ?> 
                      <?php if ($guardian==1) { ?>
                      <li><a href="../student2guardian?schoolhelp=<?php echo $schoolhelp; ?>">Guardian's Ward</a></li>
                      <?php } ?> 
                    </ul>
                  </li>
                   <li><a><i class="fa fa-table"></i> Staff <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if ($staff==1) { ?>
                      <li><a href="../staff?schoolhelp=<?php echo $schoolhelp; ?>">Staff </a></li>
                      <?php } ?> 
                      <?php if ($staffsubject==1) { ?>
                      <li><a href="../subjcourse?schoolhelp=<?php echo $schoolhelp; ?>">Instructor Subject</a></li>
                      <?php } ?> 
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bar-chart-o"></i> Guardian <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if ($guardian==1) { ?>
                      <li><a href="../guardian?schoolhelp=<?php echo $schoolhelp; ?>">Guardian</a></li>
                      <?php } ?> 
                      <?php if ($guardianward==1) { ?>
                      <li><a href="../student2guardian?schoolhelp=<?php echo $schoolhelp; ?>">Guardian's Ward</a></li>
                     <?php } ?> 
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>ID Card<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if ($idcard==1) { ?>
                      <li><a href="../idcard/index?schoolhelp=<?php echo $schoolhelp; ?>">ID Card</a></li>
                      <?php } ?> 
                    </ul>
                  </li>
                   <li><a><i class="fa fa-clone"></i>Result<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if ($template==1) { ?>
                      <li><a href="../result/template?schoolhelp=<?php echo $schoolhelp; ?>">Template</a></li>
                      <?php } ?> 
                    </ul>
                  </li>
                  <li><a><i class="fa fa-clone"></i>Website<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if ($website==1) { ?>
                      <li><a href="../website/slides?schoolhelp=<?php echo $schoolhelp; ?>">Slides</a></li>
                      <li><a href="../website/news?schoolhelp=<?php echo $schoolhelp; ?>">News</a></li>
                      <li><a href="../website/testimony?schoolhelp=<?php echo $schoolhelp; ?>">Testimony</a></li>
                      <li><a href="../website/events?schoolhelp=<?php echo $schoolhelp; ?>">Events</a></li>
                       <?php } ?> 
                    </ul>
                  </li>
                </ul>
              </div>
              <!--<div class="menu_section">
                <h3>Settings</h3>
                <ul class="nav side-menu">
                 
                  <li><a><i class="fa fa-sitemap"></i> Settings <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#level1_1">Level One</a>
                        <li><a>Level One<span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu">
                            <li class="sub_menu"><a href="level2">Level Two</a>
                            </li>
                            <li><a href="#level2_1">Level Two</a>
                            </li>
                            <li><a href="#level2_2">Level Two</a>
                            </li>
                          </ul>
                        </li>
                      </li>
                        <li><a href="#level1_2">Level One</a></li>
                    </ul>
                  </li>                  
                 
                </ul>
              </div>-->

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings" href="index?schoolhelp=<?php echo $schoolhelp; ?>">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="../../logout?schoolhelp=<?php echo $schoolhelp ?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

       