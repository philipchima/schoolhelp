
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHtimetableOOP.php");
include_once("../phpclass/SHtimetableupdate.php");
include_once("../phpclass/SHtimetableinserts.php");
confirmcheckin();
$SHtimetableOOP=new classTimetable;
$pagename="Daily Timetable";

$tableUpdate= new updateTable;
$tableInsert=new insertTable;
$page=trim(isset($_GET['page'])?$_GET['page']:false);
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);


$odate=date("Y-m-d");
$udate=date("Y-m-d H:i:s");

 //Staff class
if($page==1) {
  $numberoffields=trim(isset($_POST['numberoffields'])?$_POST['numberoffields']:false);
}

$previllages=$SHtimetableOOP->alltimetableedit('adminpersons', 'adminid', $schoolhelp);
foreach($previllages as $actualrecord){
  $pageaccess=trim($actualrecord['timetable_d']);
  $dashedit_d=trim($actualrecord['dashedit_d']);
  $dashdelete_d=trim($actualrecord['dashdelete_d']);
  $dashadd_d=trim($actualrecord['dashadd_d']);

  $signatorypositionid=trim($actualrecord['signatorypositionid']);
  $admintype=trim($actualrecord['admintype']);
}
if ($pageaccess!=1) {
  echo "<b style='font-size:100; color:red'>Criminal Attempt Made, contact the admin ask for the access of this page</b>";
  exit();
}

if ($admintype==1) {
  $logindepartmentid='';
}
else{

$signatorydata=$SHtimetableOOP->alltimetableedit('signatoryposition', 'signatorypositionid', $signatorypositionid);
if (is_array($signatorydata)) {
  foreach($signatorydata as $signatoryrec){
  $logindepartmentid=$signatoryrec['departmentid'];
  
  }
}
}


$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);


//Select current term/semester
        $semesterdata=$SHtimetableOOP->alltimetableedit('semesters','status', 1);
            if (is_array($semesterdata)) {
                foreach($semesterdata as $semesterrecord){
                    $semestername=$semesterrecord['semestername'];
                    $semesterid=trim($semesterrecord['semesterid']);
                    
              }
          }


        //Select current Session
         $sessiondata=$SHtimetableOOP->alltimetableedit('session','status', 1);
            if (is_array($sessiondata)) {
                foreach($sessiondata as $sessiondrecord){
                    $sessionname=$sessiondrecord['sessionlow']."/".$sessiondrecord['sessionhigh'];
                    $sessionid=trim($sessiondrecord['sessionid']);    
              }
          }


/*if($page==2) {
    $sql="Criminal Suspected";
  if ($dashadd_d==1) {
$insertedrec=0;
$noofdays=isset($_POST['noofdays'])?$_POST['noofdays']:false;
$timetablesemesterid=trim(isset($_POST['timetablesemesterid'])?$_POST['timetablesemesterid']:false);


$state="Completely Unsuccessfully";

foreach($noofdays as $arraycount=>$arrayid){

$noofdaysvalue=trim(ucwords($arrayid));


$startdate=trim(isset($_POST['startdate'.$arraycount])?$_POST['startdate'.$arraycount]:false);
$enddate=trim(isset($_POST['enddate'.$arraycount])?$_POST['enddate'.$arraycount]:false);

$priority=trim(isset($_POST['priority'.$arraycount])?$_POST['priority'.$arraycount]:false);
$description=trim(isset($_POST['description'.$arraycount])?$_POST['description'.$arraycount]:false);
$noofperiod=trim(isset($_POST['noofperiod'.$arraycount])?$_POST['noofperiod'.$arraycount]:false);
  
//Checking Whetter Exam type has been added
 $records=$SHtimetableOOP->alltimetableedit2('dailytimetable', 'timetablesemesterid', $timetablesemesterid, 'priority', $priority);
    if (is_array($records)) {
       $sql="This ".$pagename." is found in the database";
    }
else{

$insertedrec+=1;
$state=$tableInsert->insert_10fields('dailytimetable', 'timetablesemesterid', $timetablesemesterid, 'noofperiod', $noofperiod, 'noofdays', $noofdaysvalue,  'priority', $priority, 'description', $description,  'startdate', $startdate, 'enddate', $enddate, 'operatorid', $schoolhelp, 'udate', $udate, 'odate', $odate);
$sql=$state.":: Insertion Made, affected records = ".$insertedrec;
}
}

}

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}
*/

if($page==4) {
    $sql="Criminal Suspected";
  if ($dashedit_d==1) {
  $dailytimetableid=trim(isset($_POST['dailytimetableid'])?$_POST['dailytimetableid']:false);
  $timetablesemesterid=trim(isset($_POST['timetablesemesterid'])?$_POST['timetablesemesterid']:false);
  $timetableweekid=trim(isset($_POST['timetableweekid'])?$_POST['timetableweekid']:false);
  $date=trim(isset($_POST['date'])?$_POST['date']:false);
  $weeklyday=trim(isset($_POST['weeklyday'])?$_POST['weeklyday']:false);
  
  $starttime=trim(isset($_POST['starttime'])?$_POST['starttime']:false);
  $endtime=trim(isset($_POST['endtime'])?$_POST['endtime']:false);
  $lecturetype=trim(isset($_POST['lecturetype'])?$_POST['lecturetype']:false);
  $lecturehall=trim(isset($_POST['lecturehall'])?$_POST['lecturehall']:false);
  $course=trim(isset($_POST['course'])?$_POST['course']:false);
  $staffid=trim(isset($_POST['staffid'])?$_POST['staffid']:false);
  $supervisor=trim(isset($_POST['supervisor'])?$_POST['supervisor']:false);
 
$state=$tableUpdate->update_elevenfields('dailytimetable', 'dailytimetableid', $dailytimetableid, 'timetablesemesterid', $timetablesemesterid, 'timetableweekid',  $timetableweekid, 'daydate', $date, 'starttime', $starttime, 'endtime', $endtime, 'scheduletypeid', $lecturetype, 'hallid', $lecturehall, 'courseid', $course, 'instructorid', $staffid, 'supervisor', $supervisor, 'operatorid', $schoolhelp);

$sql=$state.":: Update Made, affected records = 1";
 }

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
 
}


if ($page==6) {
   $sql="Criminal Suspected";
  if ($dashdelete_d==1) {
  
   $dailytimetableid=trim(isset($_GET['id'])?$_GET['id']:false);
   //$photo=trim(isset($_GET['photo'])?$_GET['photo']:false);
   $tableUpdate= new updateTable;
    $state=$tableUpdate->delete_timetable('dailytimetable', 'dailytimetableid', $dailytimetableid);

        $sql=$state.":: Deletion Made, affected records = 1";
         /* if ($state=="Success") {
                 $target_dir = "uploads/news/";
                  @unlink($target_dir.$photo);
              }*/

   
  
 }
    
        echo "<script>
                window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
              </script>";
}

include("includes/header.php");
//this helps you to know the kind of driver you are using
//print_r(PDO::getAvailableDrivers());
 ?>
   <!-- page content -->
    <div class="right_col" role="main">
         

            <div class="row">
              <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12" style="margin-bottom: 20px;">
                <div class="x_panel">
                  <div class="x_title" style="background: #61dc42; padding-top: 10px; border-radius: 6px;">
                    <h3 class="schoolhelp" id="caption" style="float:left;"><?php echo $pagename ?></h3>
                    <ul class="nav navbar-right panel_toolbox" style="">
                      <li><a class="btn btn-primary" href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Timetable Board</i></a>
                      <li><a class="btn btn-success " href="../?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"> Dashbord</i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                          <?php if ($dashadd_d==1) { ?>
                          
                      <li><a href="?schoolhelp=<?php echo $schoolhelp; ?>&page=1" ><i class="fa fa-plus"></i> Add <?php echo $pagename ?></a>
                      </li>
                      <?php } ?>
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> View <?php echo $pagename ?></a>
                      </li>
                        </li>
                         
                        </ul>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div style="color:#063" <?php if ($state=="failed") {?> style="color:red" <?php } ?> ><b><?php echo $sql; ?></b></div>

                  
                    <?php if ($page=="") {?>
                      <div class="x_panel ">
                         <fieldset>
                        <legend style="color:#063"><?php echo $pagename ?> Record</legend>

                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th style="font-size: 9px">SN</th>
                          <th style="font-size: 9px"> Department</th>
                          <th style="font-size: 9px"> Level</th>
                          <th style="font-size: 9px"> Option</th>
                          <th style="font-size: 9px"> Session</th>
                          <th style="font-size: 9px"> Semester</th>
                          <th style="font-size: 9px"> Type</th>
                          <th style="font-size: 9px"> Week</th>
                          <th> Day</th>
                          <th> Course</th>
                          <th> Lecturer</th>
                          <th> Hall</th>
                          <th> Starts</th>
                          <th> Ends</th>
                                                   
                          <th style="width:10%;"><i class="fa fa-address-card" style="color:green"></i> Print</th>
                          <?php if ($dashedit_d==1) { ?>
                          
                          <th style="width:10%;"><i class="fa fa-edit" style="color:#d2dc2a"></i> Edit</th>
                          <?php } ?>
                            <?php if ($dashdelete_d==1) { ?>
                          <th><i class="fa fa-trash" style="color:red"></i> Delete</th>
                          <?php } ?>
                          <th>User<i class="fa fa-user"></i></th>
                          
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                              
                              $hallname="";
                              
                              $records=$SHtimetableOOP->alltimetable('dailytimetable', 'dailytimetableid', 'ASC');
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                  $optionid="";
                                $deptname="";
                                $departmentid="";
                                $levelname="";
                                $levelid="";
                                $optionid="";
                                $semesterid="";
                                $sessionid="";
                                $timetabletypeid="";
                                
                                $operatorid=trim($fieldrecord['operatorid']);
                                $timetablesemesterid=trim($fieldrecord['timetablesemesterid']);
                                $timetableweekid=trim($fieldrecord['timetableweekid']);
                                $timetabledaysetupid=trim($fieldrecord['timetabledaysetupid']);
                                $courseid=trim($fieldrecord['courseid']);
                                $instructorid=trim($fieldrecord['instructorid']);
                                $hallid=trim($fieldrecord['hallid']);
                                $starttime=trim($fieldrecord['starttime']);
                                $endtime=trim($fieldrecord['endtime']);
                                $dayid=trim($fieldrecord['dayid']);
                                 
                               $records1=$SHtimetableOOP->alltimetableedit('timetablesemester', 'timetablesemesterid', $timetablesemesterid);
                                if (is_array($records1)) {
                                foreach($records1 as $fieldrecord1){
                                
                                $levelid=trim($fieldrecord1['levelid']);
                                $optionid=trim($fieldrecord1['optionid']);
                                $semesterid=trim($fieldrecord1['semesterid']);
                                $sessionid=trim($fieldrecord1['sessionid']);
                                $timetabletypeid=trim($fieldrecord1['timetabletypeid']);
                                }
                              }
                                
                               //Daily Timetable record
                                     $typerecords=$SHtimetableOOP->alltimetableedit('daysinaweek', 'daysinaweekid', $dayid);
                                     if (is_array($typerecords)) {
                                     foreach($typerecords as $typerecord){
                                        $dayname=trim($typerecord['name']);
                                     }
                                   }

                                   //Hall record

                                     $hallrecords=$SHtimetableOOP->alltimetableedit('lecturehall', 'lecturehallid', $hallid);
                                     if (is_array($hallrecords)) {
                                     foreach($hallrecords as $hallrecord){
                                        $hallname=trim($hallrecord['hallname']);
                                     }
                                   }

                                    //Course Info Timetable record
                                     $courserecords=$SHtimetableOOP->alltimetableedit('course', 'csid', $courseid);
                                     if (is_array($courserecords)) {
                                     foreach($courserecords as $courserecord){
                                        $csname=trim($courserecord['csname']);
                                     }
                                   }

                               //Week Timetable record
                                     $weekrecords=$SHtimetableOOP->alltimetableedit('timetableweek', 'timetableweekid', $timetableweekid);
                                     if (is_array($weekrecords)) {
                                     foreach($weekrecords as $weekrecord){
                                        $weekpriority=trim($weekrecord['priority']);
                                     }
                                   }


                                //collecting Timetable record
                                    $typename="";
                                     $typerecords=$SHtimetableOOP->alltimetableedit('timetabletype', 'timetabletypeid', $timetabletypeid);
                                     if (is_array($typerecords)) {
                                     foreach($typerecords as $typerecord){
                                        $typename=$typerecord['typename'];
                                        
                                     }
                                   }

                              //Getting Admin Detials
                                 $adminrecords=$SHtimetableOOP->alltimetableedit('adminpersons', 'adminid', $operatorid);
                                  if (is_array($adminrecords)) {
                                 foreach($adminrecords as $adminrecord){
                                    $adminsurname=$adminrecord['surname'];
                                    $adminothername=$adminrecord['othername'];
                                 }
                               }

                                //Getting Staff Detials
                                 $staffrecords=$SHtimetableOOP->alltimetableedit('staff', 'staffid', $instructorid);
                                  if (is_array($adminrecords)) {
                                 foreach($staffrecords as $staffrecord){
                                    $staffsurname=$staffrecord['surname'];
                                    $staffothername=$staffrecord['othername'];
                                 }
                               }

                                  $levelobject=$SHtimetableOOP->alltimetableedit('level', 'levelid',  $levelid);
                                if(is_array($levelobject)){
                                foreach($levelobject as $levelrecord){
                                  $levelname=$levelrecord['levelname'];
                                  $departmentid= $levelrecord['departmentid'];
                                  }
                                }

                                //collecting Department record
                             
                                     $deptrecords=$SHtimetableOOP->alltimetableedit('department', 'did', $departmentid);
                                     if (is_array($deptrecords)) {
                                     foreach($deptrecords as $deptrecord){
                                        $deptname=$deptrecord['deptname'];
                                        
                                     }
                                   }

                                 //getting Option name
                            
                               $optionname="";
                              
                                   $optionobject=$SHtimetableOOP->alltimetableedit('optiontable', 'optid',  $optionid);
                                   if(is_array($optionobject)){
                                      foreach($optionobject as $optionrecord){
                                        $optionname=$optionrecord['optname'];
                                        
                                     }
                                    }

                                      //Select current term/semester
                              $semesterdata=$SHtimetableOOP->alltimetableedit('semesters','semesterid', $semesterid);
                                  if (is_array($semesterdata)) {
                                      foreach($semesterdata as $semesterrecord){
                                          $semestername=$semesterrecord['semestername'];
                                          $semesterid=trim($semesterrecord['semesterid']);
                                          
                                    }
                                }


                              //Select current Session
                               $sessiondata=$SHtimetableOOP->alltimetableedit('session', 'sessionid', $sessionid);
                                  if (is_array($sessiondata)) {
                                      foreach($sessiondata as $sessiondrecord){
                                          $sessionname=$sessiondrecord['sessionlow']."/".$sessiondrecord['sessionhigh'];
                                          $sessionid=trim($sessiondrecord['sessionid']);    
                                    }
                                }
                                 $k+=1;
                                if ($admintype==0) {
                                 
                                if ($departmentid==$logindepartmentid) {
                                  $k1+=1;
                                ?>
                                      <tr>
                                        <td style="font-size: 9px"><?php echo $k1; ?></td>
                                        <td style="font-size: 9px"><?php echo substr($deptname, 0,12); ?></td>                               
                                        <td style="font-size: 9px"><?php echo  $levelname; ?></td>
                                        <td style="font-size: 9px"><?php echo  $optionname; ?></td>
                                        <td style="font-size: 9px"><?php echo substr($sessionname, 0,12); ?></td>   
                                        <td style="font-size: 9px"><?php echo substr($semestername, 0,12); ?></td>  
                                         <td><?php echo  substr($typename, 0,12); ?></td>
                                        <td><?php echo   substr($weekpriority, 0,12); ?></td>    
                                        
                                        <td><?php echo  substr($dayname,0,12); ?></td>
                                        <td><?php echo  substr($csname,0,12); ?></td>

                                        <td><?php echo substr($staffsurname." ".$staffothername,0,12) ?></td>
                                        <td><?php echo  substr($hallname,0,12); ?></td>

                                        <td><?php echo substr($fieldrecord['starttime'],0,12); ?></td>
                                        <td><?php echo substr($fieldrecord['endtime'],0,12);; ?></td>
                                        
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['dailytimetableid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                          <?php if ($dashedit_d==1) { ?>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['dailytimetableid']; ?>')"><center><i class="fa fa-edit" style="color:#d2dc2a; font-size:2em"></i></center></button></td>
                                        <?php } ?>
                                         <?php if ($dashdelete_d==1) { ?>
                                        <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['dailytimetableid']; ?>','');"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
                                        <?php } ?>
                                           <td ><span class="btn-group">
                                            <center><button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-user"></i> Details<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu">
                                            <li ><span>Update by</span> : <?php echo  $adminsurname. " ".$adminothername ; ?></li>
                                            <li><span>Upate Date</span> : <?php echo  $fieldrecord['udate']; ?></li>
                                            <li><span>Initial Date</span> : <?php echo  $fieldrecord['odate']; ?></li>
                                            
                                          </ul>
                                          </center></span>

                                        </td>
                                      </tr>
                                    <?php }
                                    }else{  ?>
                                      <tr>
                                        <td style="font-size: 9px"><?php echo $k; ?></td>
                                        <td style="font-size: 9px"><?php echo substr($deptname, 0,12); ?></td>                               
                                        <td style="font-size: 9px"><?php echo  $levelname; ?></td>
                                        <td style="font-size: 9px"><?php echo  $optionname; ?></td>
                                        <td style="font-size: 9px"><?php echo substr($sessionname, 0,12); ?></td>   
                                        <td style="font-size: 9px"><?php echo substr($semestername, 0,12); ?></td>  
                                         <td><?php echo  substr($typename, 0,12); ?></td>
                                        <td><?php echo   substr($weekpriority, 0,12); ?></td>    
                                        
                                        <td><?php echo  substr($dayname,0,12); ?></td>
                                        <td><?php echo  substr($csname,0,12); ?></td>

                                        <td><?php echo substr($staffsurname." ".$staffothername,0,12) ?></td>
                                        <td><?php echo  substr($hallname,0,12); ?></td>

                                        <td><?php echo substr($fieldrecord['starttime'],0,12); ?></td>
                                        <td><?php echo substr($fieldrecord['endtime'],0,12);; ?></td>
                                        
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['dailytimetableid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                          <?php if ($dashedit_d==1) { ?>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['dailytimetableid']; ?>')"><center><i class="fa fa-edit" style="color:#d2dc2a; font-size:2em"></i></center></button></td>
                                        <?php } ?>
                                         <?php if ($dashdelete_d==1) { ?>
                                        <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['dailytimetableid']; ?>','');"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
                                        <?php } ?>
                                           <td ><span class="btn-group">
                                            <center><button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-user"></i> Details<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu">
                                            <li ><span>Update by</span> : <?php echo  $adminsurname. " ".$adminothername ; ?></li>
                                            <li><span>Upate Date</span> : <?php echo  $fieldrecord['udate']; ?></li>
                                            <li><span>Initial Date</span> : <?php echo  $fieldrecord['odate']; ?></li>
                                            
                                          </ul>
                                          </center></span>

                                        </td>
                                      </tr>
                                      <?php } ?>
                            <?php
                                }
                              }
                             ?>
                        
                      </tbody>
                    </table>
                   </fieldset>
                    </div>
                    <?php } ?>

                     

                    <?php if($page==1) {  
                      
                      ?>

                    <div class="x_panel">

                      <fieldset>
                        <legend style="color:#063">Add <?php echo $pagename ?></legend>
                  <!--<form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php //echo $schoolhelp; ?>" method="POST"  id="frmmedtreatmentid"   class="form-horizontal form-label-left" >-->
                   
                      <div class="form-group">
                        <label for="semester" class="control-label col-md-3 col-sm-3 col-xs-12">Semester's Timetable Setup</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="hidden" id="operatorid" name="operatorid" value="<?php echo $schoolhelp; ?>" >
                            <select name="timetablesemesterid" id="timetablesemesterid" class="form-control col-md-8 col-xs-12" onchange="addingweeks('timetableweek', 'timetablesemesterid', this.value, 'wkretrieve_func', 'weekscontainer');">
                             <option value="">Semester's Timetable Setup</option>
                            <?php 
                            $record=$SHtimetableOOP->alltimetable('timetablesemester', 'levelid', 'DESC');
                            if (is_array($record)) {
                            foreach($record as $records){
                              $levelid=trim($records['levelid']);
                              $optionid=trim($records['optionid']);
                              $semesterid=trim($records['semesterid']);
                              $sessionid=trim($records['sessionid']);
                              $timetabletypeid=trim($records['timetabletypeid']);

                               //collecting Timetable record
                                    $typename="";
                                     $typerecords=$SHtimetableOOP->alltimetableedit('timetabletype', 'timetabletypeid', $timetabletypeid);
                                     if (is_array($typerecords)) {
                                     foreach($typerecords as $typerecord){
                                        $typename=$typerecord['typename'];
                                        
                                     }
                                   }
                             
                               $levelname="";
                              $levelobject=$SHtimetableOOP->alltimetableedit('level', 'levelid',  $levelid);
                                if(is_array($levelobject)){
                                foreach($levelobject as $levelrecord){
                                  $levelname=$levelrecord['levelname'];
                                   $did=trim($levelrecord['departmentid']);
                                  }
                                }

                                $deptname="";
                              //Getting Department information
                              $record1=$SHtimetableOOP->alltimetableedit('department', 'did', $did);
                              if (is_array($record1)) {
                              foreach($record1 as $record1s){
                                $deptname=$record1s['deptname'];
                              }
                            }

                             $optionname="";
                              
                                   $optionobject=$SHtimetableOOP->alltimetableedit('optiontable', 'optid',  $optionid);
                                   if(is_array($optionobject)){
                                      foreach($optionobject as $optionrecord){
                                        $optionname=$optionrecord['optname'];
                                        
                                     }
                                    }

                                      //Select current term/semester
                              $semesterdata=$SHtimetableOOP->alltimetableedit('semesters','semesterid', $semesterid);
                                  if (is_array($semesterdata)) {
                                      foreach($semesterdata as $semesterrecord){
                                          $semestername=$semesterrecord['semestername'];
                                          $semesterid=trim($semesterrecord['semesterid']);
                                          
                                    }
                                }


                              //Select current Session
                               $sessiondata=$SHtimetableOOP->alltimetableedit('session', 'sessionid', $sessionid);
                                  if (is_array($sessiondata)) {
                                      foreach($sessiondata as $sessiondrecord){
                                          $sessionname=$sessiondrecord['sessionlow']."/".$sessiondrecord['sessionhigh'];
                                          $sessionid=trim($sessiondrecord['sessionid']);    
                                    }
                                }

                          if ($admintype==0) {
                            if ($logindepartmentid==$did) {
                            ?>
                             <option value="<?php echo $records['timetablesemesterid'] ?>"><?php echo $typename." - ".$sessionname." => ".$semestername. "::". $levelname."::".$optionname." => ".$deptname; ?></option>
                           <?php }
                              }
                           else{ ?>
                             <option value="<?php echo $records['timetablesemesterid'] ?>"><?php echo $typename." - ".$sessionname." => ".$semestername. "::". $levelname."::".$optionname." => ".$deptname; ?></option>
                            <?php 
                                  }
                              } 
                            }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div id="weekscontainer">
                       
                      </div>

                     <div id="opencontainer">

                     </div>

                   <!-- </form>-->
                  </div>
                  </fieldset>
                 </div>
                 <?php } ?>

                  <?php 

                  if($page==3) {
                    $dailytimetableid=trim(isset($_GET['id'])?$_GET['id']:false);
                   $odate=date("Y-m-d");
                  $deptname="";
                  $fulldate="";
                  $timetableweekid="";
                  $dayid="";
                  $daydate="";
                  $courseid="";
                  $instructorid="";
                  $supervisorid="";
                  $starttime="";
                  $endtime="";
                  $timetablesemesterid="";
                  $operatorid="";
                  $odatet="";
                  $scheduletypeid="";
                  $hallid="";
                  $udate="";
                  $fulldate="";
                  $supervisorid="";
                   $dailytimetableid=trim(isset($_GET['id'])?$_GET['id']:false);
                   $records=$SHtimetableOOP->alltimetableedit('dailytimetable', 'dailytimetableid', $dailytimetableid);
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                $timetableweekid=trim($fieldrecord['timetableweekid']);

                                $dayid=trim($fieldrecord['dayid']);
                                $staffid=trim($fieldrecord['instructorid']);
                                $daydate=trim($fieldrecord['daydate']);
                                $courseid=trim($fieldrecord['courseid']);
                                $instructorid=trim($fieldrecord['instructorid']);
                                $supervisorid=trim($fieldrecord['supervisor']);
                                $starttime=trim($fieldrecord['starttime']);
                                $endtime=trim($fieldrecord['endtime']);
                                 $timetablesemesterid=trim($fieldrecord['timetablesemesterid']);
                                $operatorid=trim($fieldrecord['operatorid']);
                                $odatet=trim($fieldrecord['odate']);
                                $scheduletypeid=trim($fieldrecord['scheduletypeid']);
                                $hallid=trim($fieldrecord['hallid']);
                                $udate=trim($fieldrecord['udate']);
                                $fulldate=date("l jS F, Y", strtotime($daydate));
                          }

                          //collecting Timetable record
                                    $typename="";
                                    
                                $timetabletypeid="";
                                $levelid="";
                                $optionid="";
                                $semesterid="";
                                $sessionid="";
                           $records1=$SHtimetableOOP->alltimetableedit('timetablesemester', 'timetablesemesterid', $timetablesemesterid);
                                if (is_array($records1)) {
                                foreach($records1 as $fieldrecord1){
                                $levelid=trim($fieldrecord1['levelid']);
                                $optionid=trim($fieldrecord1['optionid']);
                                $semesterid=trim($fieldrecord1['semesterid']);
                                $sessionid=trim($fieldrecord1['sessionid']);
                                $timetabletypeid=trim($fieldrecord1['timetabletypeid']);
                                }
                              }
                                
                                $startdate="";
                                $enddate="";
                                //Getting Time Table Detials
                                 $timetableweekdata=$SHtimetableOOP->alltimetableedit('timetableweek', 'timetableweekid', $timetableweekid);
                                  if (is_array($timetableweekdata)) {
                                 foreach($timetableweekdata as $timetableweekrec){
                                    $priority=trim($timetableweekrec['priority']);
                                    $startdate=trim($timetableweekrec['startdate']);
                                    $enddate=trim($timetableweekrec['enddate']);
                                 }
                               }

                               //Getting Time Table Detials
                                 $timetabletypedata=$SHtimetableOOP->alltimetableedit('timetabletype', 'timetabletypeid', $timetabletypeid);
                                  if (is_array($timetabletypedata)) {
                                 foreach($timetabletypedata as $timetabletyperec){
                                    $timetabletypename=$timetabletyperec['typename'];
                                 }
                               }

                              //Getting Admin Detials
                              
                                 $adminrecords=$SHtimetableOOP->alltimetableedit('adminpersons', 'adminid', $operatorid);
                                  if (is_array($adminrecords)) {
                                 foreach($adminrecords as $adminrecord){
                                    $adminsurname=$adminrecord['surname'];
                                    $adminothername=$adminrecord['othername'];
                                 }
                               }
                                  $levelname="";
                                  $levelobject=$SHtimetableOOP->alltimetableedit('level', 'levelid',  $levelid);
                                if(is_array($levelobject)){
                                foreach($levelobject as $levelrecord){
                                  $levelname=$levelrecord['levelname'];
                                  $departmentid= $levelrecord['departmentid'];
                                  }
                                }

                                //collecting Department record
                             
                                     $deptrecords=$SHtimetableOOP->alltimetableedit('department', 'did', $departmentid);
                                     if (is_array($deptrecords)) {
                                     foreach($deptrecords as $deptrecord){
                                        $deptname=$deptrecord['deptname'];
                                        
                                     }
                                   }

                                 //getting Option name
                            
                               $optionname="";
                              
                                   $optionobject=$SHtimetableOOP->alltimetableedit('optiontable', 'optid',  $optionid);
                                   if(is_array($optionobject)){
                                      foreach($optionobject as $optionrecord){
                                        $optionname=$optionrecord['optname'];
                                        
                                     }
                                    }

                                      //Select current term/semester
                                    $semestername="";
                                          
                              $semesterdata=$SHtimetableOOP->alltimetableedit('semesters','semesterid', $semesterid);
                                  if (is_array($semesterdata)) {
                                      foreach($semesterdata as $semesterrecord){
                                          $semestername=$semesterrecord['semestername'];
                                          $semesterid=trim($semesterrecord['semesterid']);
                                          
                                    }
                                }


                              //Select current Session
                               $sessiondata=$SHtimetableOOP->alltimetableedit('session', 'sessionid', $sessionid);
                                  if (is_array($sessiondata)) {
                                      foreach($sessiondata as $sessiondrecord){
                                          $sessionname=$sessiondrecord['sessionlow']."/".$sessiondrecord['sessionhigh'];
                                          $sessionid=trim($sessiondrecord['sessionid']);    
                                    }
                                }

                                $scheduletypename="";
                                $scheduletypecode="";
                              $record5=$SHtimetableOOP->alltimetableedit('lecturetype', 'lecturetypeid', $scheduletypeid);
                              if (is_array($record5)) {
                                foreach ($record5 as $records5) {
                                $scheduletypename=trim($records5['name']);
                                $scheduletypecode=trim($records5['code']);
                                }
                              }

                               $lecturehallname="";
                                $lecturehallcode="";
                               $record6=$SHtimetableOOP->alltimetableedit('lecturehall', 'lecturehallid', $hallid);
                              if (is_array($record6)) {
                                foreach ($record6 as $records6) {
                                $lecturehallname=trim($records6['hallname']);
                                $lecturehallcode=trim($records6['shortname']);
                                }
                              }

                              $ifullname="";
                                $qualification="";
                               $record8=$SHtimetableOOP->alltimetableedit('staff', 'staffid',  $instructorid);
                              if (is_array($record8)) {
                                foreach ($record8 as $records8) {
                                $ifullname=trim($records8['surname'])." ".trim($records8['othername']);
                                $qualification=trim($records8['qualification']);
                                }
                              }

                               $sfullname="";
                                $squalification="";
                               $record9=$SHtimetableOOP->alltimetableedit('staff', 'staffid', $supervisorid);
                              if (is_array($record9)) {
                                foreach ($record9 as $records9) {
                                $sfullname=trim($records9['surname'])." ".trim($records9['othername']);
                                $squalification=trim($records8['qualification']);
                                }
                              }

                              $csname="";
                                $coursecode="";
                               $record7=$SHtimetableOOP->alltimetableedit('course', 'csid', $courseid);
                              if (is_array($record7)) {
                                foreach ($record7 as $records7) {
                                $csname=trim($records7['csname']);
                                $coursecode=trim($records7['coursecode']);
                                }
                              }

                      }
                    ?>
                    
                    <div class="x_panel">

                      <fieldset>
                        <legend style="color:#063; font-size: 12px">Edit Time <?php echo $starttime." - ".$endtime; ?> Day: <?php echo $fulldate; ?> Week <?php echo $priority." - ".$timetabletypename." - "; ?> <?php echo  $sessionname." => ".$semestername. "::". $levelname." => ".$deptname; ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="forminstitutionid"  class="form-horizontal form-label-left" >
                    <input id="dailytimetableid" class="form-control col-md-7 col-xs-12" type="hidden" name="dailytimetableid" required="required" value="<?php echo $dailytimetableid; ?>">

                     <div class="form-group">
                        <label for="semester" class="control-label col-md-3 col-sm-3 col-xs-12">Semester's Timetable Setup</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="hidden" id="operatorid" name="operatorid" value="<?php echo $schoolhelp; ?>" >
                            <select name="timetablesemesterid" id="timetablesemesterid" class="form-control col-md-8 col-xs-12" 
                            onchange="addingweeks2('timetableweek', 'timetablesemesterid', this.value, 'wkretrieve_func2', 'weekscontainer2')">
                             <option value="">Semester's Timetable Setup</option>
                            <?php 
                            $record=$SHtimetableOOP->alltimetable('timetablesemester', 'levelid', 'DESC');
                            if (is_array($record)) {
                            foreach($record as $records){
                              $levelid=trim($records['levelid']);
                              $optionid=trim($records['optionid']);
                              $semesterid=trim($records['semesterid']);
                              $sessionid=trim($records['sessionid']);
                              $timetabletypeid=trim($records['timetabletypeid']);

                               //collecting Timetable record
                                    $typename="";
                                     $typerecords=$SHtimetableOOP->alltimetableedit('timetabletype', 'timetabletypeid', $timetabletypeid);
                                     if (is_array($typerecords)) {
                                     foreach($typerecords as $typerecord){
                                        $typename=$typerecord['typename'];
                                        
                                     }
                                   }
                             
                               $levelname="";
                              $levelobject=$SHtimetableOOP->alltimetableedit('level', 'levelid',  $levelid);
                                if(is_array($levelobject)){
                                foreach($levelobject as $levelrecord){
                                  $levelname=$levelrecord['levelname'];
                                   $did=trim($levelrecord['departmentid']);
                                  }
                                }

                                $deptname="";
                              //Getting Department information
                              $record1=$SHtimetableOOP->alltimetableedit('department', 'did', $did);
                              if (is_array($record1)) {
                              foreach($record1 as $record1s){
                                $deptname=$record1s['deptname'];
                              }
                            }

                             $optionname="";
                              
                                   $optionobject=$SHtimetableOOP->alltimetableedit('optiontable', 'optid',  $optionid);
                                   if(is_array($optionobject)){
                                      foreach($optionobject as $optionrecord){
                                        $optionname=$optionrecord['optname'];
                                        
                                     }
                                    }

                                      //Select current term/semester
                              $semesterdata=$SHtimetableOOP->alltimetableedit('semesters','semesterid', $semesterid);
                                  if (is_array($semesterdata)) {
                                      foreach($semesterdata as $semesterrecord){
                                          $semestername=$semesterrecord['semestername'];
                                          $semesterid=trim($semesterrecord['semesterid']);
                                          
                                    }
                                }


                              //Select current Session
                               $sessiondata=$SHtimetableOOP->alltimetableedit('session', 'sessionid', $sessionid);
                                  if (is_array($sessiondata)) {
                                      foreach($sessiondata as $sessiondrecord){
                                          $sessionname=$sessiondrecord['sessionlow']."/".$sessiondrecord['sessionhigh'];
                                          $sessionid=trim($sessiondrecord['sessionid']);    
                                    }
                                }

                          if ($admintype==0) {
                            if ($logindepartmentid==$did) {
                            ?>
                             <option value="<?php echo trim($records['timetablesemesterid']) ?>" <?php if(trim($records['timetablesemesterid'])==$timetablesemesterid){ ?> selected="selected" <?php } ?> ><?php echo $typename." - ".$sessionname." => ".$semestername. "::". $levelname."::".$optionname." => ".$deptname; ?></option>
                           <?php }
                              }
                           else{ ?>
                             <option value="<?php echo trim($records['timetablesemesterid']); ?>" <?php if(trim($records['timetablesemesterid'])==$timetablesemesterid){ ?> selected="selected" <?php } ?> ><?php echo $typename." - ".$sessionname." => ".$semestername. "::". $levelname."::".$optionname." => ".$deptname; ?></option>
                            <?php 
                                  }
                              } 
                            }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div id="weekscontainer2">
                      <div class="form-group col-xs-12">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="timetableweekid">Semester Week<span class="required">*</span>
                           </label>
                           <div class="col-md-6 col-sm-6 col-xs-12">
                            
                         <select  name="timetableweekid" id="timetableweekid" required="required"  class="form-control col-md-6 col-xs-12"  onchange="addingdays2('dailytimetable', 'timetableweek', 'timetablesemesterid', $('#timetablesemesterid').val(), 'timetableweekid', this.value, 'addingdays2', 'opencontainer2');">
                           <option value="">--Select Week--</option>
                      <?php
                        $retrievedata=$SHtimetableOOP->alltimetableedit('timetableweek', 'timetablesemesterid', $timetablesemesterid);
                      if (is_array($retrievedata)) {
                        foreach($retrievedata as $field){
                      ?>
                            <option value="<?php echo $field['timetableweekid']; ?>" <?php if(trim($field['timetableweekid'])==$timetableweekid){ ?> selected <?php } ?>><?php echo "Week ". $field['priority']; ?></option>
                      <?php
                         }
                         }else{echo "<span id='msg'>Please check and Week Setup has been under the selected semester timetable setup</span>";}
                          ?>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div id="opencontainer2">
                         <div class="form-group col-xs-12">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Day Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="date" class="form-control col-md-7 col-xs-12" type="date" name="date" required="required" placeholder="Enter the Lecture Day date"  min="<?php echo $startdate; ?>" max="<?php echo $enddate; ?>" value="<?php echo $daydate ?>" onchange="collectdate(this.value, 'collectdate', 'opencontainer3');">
                        </div>
                      </div>
                      

                      <div id="opencontainer3">
                       <div class="form-group col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Weekly Day<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
                          <select  id="weeklyday" required="required" name="weeklyday" class="form-control col-md-7 col-xs-12" >
                            <option value="">--Select Weekly Day--</option>
                            <?php
                            $daysinaweek=$SHtimetableOOP->alltimetable('daysinaweek', 'priority', "ASC");
                          if (is_array($daysinaweek)) {
                            foreach($daysinaweek as $daysinaweeks){
                            ?>
                            <option value="<?php echo trim($daysinaweeks['priority']); ?>" <?php if (trim($daysinaweeks['priority'])==$dayid) {?> selected="selected" <?php } ?> ><?php echo $daysinaweeks['name']; ?></option>
                         <?php
                            } 
                          } 
                          ?>
                          </select>
                        </div>
                      </div>
                      </div>

                    </div><!-- end of opencontainer2-->
    
                      <div class="form-group col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Start Time<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
                          <input type="time" class="form-control col-md-2 col-xs-2" name="starttime" id="starttime" required="required" onblur="checktime3('dailytimetable', 'dailytimetableid', $('#dailytimetableid').val(),'timetablesemesterid', $('#timetablesemesterid').val(), 'daydate', $('#date').val(), 'starttime', $(this).val(), 'endtime', $('#endtime').val(), 'checktime3', 'starttime', 'date');" value="<?php echo $starttime; ?>">
                        </div>
                      </div>

                       <div class="form-group col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="endtime">End Time<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
                          <input type="time" class="form-control col-md-2 col-xs-2" name="endtime" id="endtime" onblur="checktime3('dailytimetable', 'dailytimetableid', $('#dailytimetableid').val(),'timetablesemesterid', $('#timetablesemesterid').val(), 'daydate', $('#date').val(), 'starttime', $(this).val(), 'endtime', $(this).val(), 'checktime3', '', 'endtime');" value="<?php echo $endtime; ?>">
                        </div>
                      </div>

                       <div class="form-group col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Schedule Type<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
                           <select title="Select Lecture Type" id="lecturetype" required="required" name="lecturetype" class="form-control col-md-2 col-xs-2">
                            <option value="">--Select Lecture Type--</option>
                            <?php
                                                                            //Schedule type
                            $lecturetyperec=$SHtimetableOOP->alltimetableedit('lecturetype', 'departmentid', $departmentid);
                            if (is_array($lecturetyperec)) {
                           
                            foreach($lecturetyperec as $lecturetyperecs){    
                            ?>
                            <option value="<?php echo $lecturetyperecs['lecturetypeid']; ?>" title="<?php echo $lecturetyperecs['description']; ?>" <?php if (trim($lecturetyperecs['lecturetypeid'])==$scheduletypeid){?> selected="selected" <?php } ?> ><?php echo $lecturetyperecs['name']." (".$deptname." )"; ?></option>
                            <?php
                            }//end of checking whether someone is a super
                                
                          } 
                               ?>
                        </select>
                        </div>
                      </div>

                       <div class="form-group col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Hall Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
                           <select title="Select Study Hall for the Lecture" id="lecturehall" required="required" name="lecturehall" class="form-control col-md-2 col-xs-2" onchange="checkhall2('dailytimetable', 'timetablesemesterid', $('#timetablesemesterid').val(), 'daydate', $('#date').val(), 'hallid', this.value, 'starttime',  $('#starttime').val(), 'endtime', $('#endtime').val(), 'dailytimetableid', $('#dailytimetableid').val(), 'checkhall2', $(this).attr('id'));">
                            <option value="">--Select Lecture Hall--</option>
                            <?php
                            $deptrecord=$SHtimetableOOP->alltimetableedit2or('lecturehall', 'departmentid', $departmentid, 'halltype', 1);
                            if (is_array($deptrecord)) {
                           
                            foreach($deptrecord as $deptdata){    
                            ?>
                            <option value="<?php echo $deptdata['lecturehallid']; ?>" title="<?php echo $deptdata['description']; ?>" <?php if (trim($deptdata['lecturehallid'])==$hallid) { ?> selected="selected" <?php } ?> ><?php echo $deptdata['hallname']." (".$deptname." )"; ?></option>
                            <?php
                               
                            }//end of checking whether someone is a super
                                
                            } ?>
                            </select>
                        </div>
                      </div>

                       
                       <div class="form-group col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Course Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
                           <select title="Select Course of Study" id="course" required="required" name="course" class="form-control col-md-3 col-xs-6" onchange="coursecheck2('instructorcourses', 'dailytimetable', 'courseid', this.value, 'timetablesemesterid', $('#timetablesemesterid').val(), 'timetableweekid', $('#timetableweekid').val(), 'daydate', $('#date').val(), 'starttime',  $('#starttime').val(), 'endtime', $('#endtime').val(), 'dailytimetableid', $('#dailytimetableid').val(), 'coursecheck2',  $(this).attr('id'), 'instructoridsel');">
                            <option value="">--Select Course--</option>
                            <?php
                            $courserec=$SHtimetableOOP->alltimetableedit('course', 'departmentid', $departmentid);
                            if (is_array($courserec)) {
                           
                              foreach($courserec as $courserecs){    
                              ?>
                              <option value="<?php echo $courserecs['csid']; ?>" title="<?php echo $courserecs['csdescription']; ?>" <?php if (trim($courserecs['csid'])==$courseid) { ?> selected="selected" <?php } ?>><?php echo $courserecs['csname']." => ".$courserecs['coursecode']; ?></option>
                              <?php
                                 
                              }//end of checking whether someone is a super
                                
                            } 
                             ?>
                            </select>
                        </div>
                      </div>

                      <div id="instructoridsel">
                      <div class="form-group col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Instructor/Teacher or Invigilator<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                          <?php $record8=$SHtimetableOOP->alltimetableedit('staff', 'staffid', $staffid);
                                if (is_array($record8)) {
                                foreach ($record8 as $records8) {
                                $ifullname=trim($records8['surname'])." ".trim($records8['othername']);
                                            
                                  }
                                }
                          ?>

                           <input type="text" list="staffnames" id="staffname" class="form-control col-md-3 col-xs-6" value="<?php echo $ifullname; ?>" placeholder="Please type or select staff name " onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'staffid');">

                           <datalist id="staffnames">

                          <?php
                            $records=$SHtimetableOOP->alltimetable('staff', 'staffid', 'ASC');
                              if (is_array($records)) {
                                           
                              foreach($records as $fieldrecord){
                                       
                          ?>
                          <option data-value="<?php echo $fieldrecord['staffid']; ?>"  value="<?php echo $fieldrecord['surname'].' '.$fieldrecord['othername']; ?>"></option>
                           <?php } 
                            }?>
                          </datalist>
                          <input id="staffid" class="form-control col-md-2 col-xs-2" name="staffid" type="hidden" value="<?php echo $staffid; ?>">
                           
                        </div>
                      </div>
                    </div>

                       <div class="form-group col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Supervisor<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                          <?php $record8=$SHtimetableOOP->alltimetableedit('staff', 'staffid', $supervisorid);
                                if (is_array($record8)) {
                                foreach ($record8 as $records8) {
                                $sfullname=trim($records8['surname'])." ".trim($records8['othername']);
                                            
                                  }
                                }
                          ?>

                           <input type="text" list="supervisornames" id="supervisorname" class="form-control col-md-3 col-xs-6" value="<?php echo $sfullname; ?>" placeholder="Please type or select staff name " onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'supervisorid');">

                           <datalist id="staffnames">

                          <?php
                            $records=$SHtimetableOOP->alltimetable('staff', 'staffid', 'ASC');
                              if (is_array($records)) {
                                           
                              foreach($records as $fieldrecord){
                                       
                          ?>
                          <option data-value="<?php echo $fieldrecord['staffid']; ?>"  value="<?php echo $fieldrecord['surname'].' '.$fieldrecord['othername']; ?>">
                           <?php } 
                            }?>
                          </datalist>
                          <input id="supervisorid" class="form-control col-md-2 col-xs-2" name="supervisorid" type="hidden" value="<?php echo $supervisorid; ?>">
                           
                        </div>
                      </div>
                                                         
                          <div id="msg" ></div>
                          <div class="ln_solid"></div>
                          <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                      
                          <button class="btn btn-primary" type="reset">Reset</button>
                                      <button type="submit" class="btn btn-success" >Update</button>
                                    </div>
                          </div>
                      
                    </form>
                  </div>

                  </fieldset>
                 </div>
                <?php } ?>

                <?php if ($page==5) {
                  $odate=date("Y-m-d");
                  $deptname="";
                  $fulldate="";
                  $timetableweekid="";
                  $dayid="";
                  $daydate="";
                  $courseid="";
                  $instructorid="";
                  $supervisorid="";
                  $starttime="";
                  $endtime="";
                  $timetablesemesterid="";
                  $operatorid="";
                  $odatet="";
                  $scheduletypeid="";
                  $hallid="";
                  $udate="";
                  $fulldate="";
                  $supervisorid="";
                   $dailytimetableid=trim(isset($_GET['id'])?$_GET['id']:false);
                   $records=$SHtimetableOOP->alltimetableedit('dailytimetable', 'dailytimetableid', $dailytimetableid);
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                $timetableweekid=trim($fieldrecord['timetableweekid']);
                                $dayid=trim($fieldrecord['dayid']);
                                $daydate=trim($fieldrecord['daydate']);
                                $courseid=trim($fieldrecord['courseid']);
                                $instructorid=trim($fieldrecord['instructorid']);
                                $supervisorid=trim($fieldrecord['supervisor']);
                                $starttime=trim($fieldrecord['starttime']);
                                $endtime=trim($fieldrecord['endtime']);
                                 $timetablesemesterid=trim($fieldrecord['timetablesemesterid']);
                                $operatorid=trim($fieldrecord['operatorid']);
                                $odatet=trim($fieldrecord['odate']);
                                $scheduletypeid=trim($fieldrecord['scheduletypeid']);
                                $hallid=trim($fieldrecord['hallid']);
                                $udate=trim($fieldrecord['udate']);
                                $fulldate=date("l jS F, Y", strtotime($daydate));
                          }

                          //collecting Timetable record
                                    $typename="";
                                    

                                $timetabletypeid="";
                                $levelid="";
                                $optionid="";
                                $semesterid="";
                                $sessionid="";
                           $records1=$SHtimetableOOP->alltimetableedit('timetablesemester', 'timetablesemesterid', $timetablesemesterid);
                                if (is_array($records1)) {
                                foreach($records1 as $fieldrecord1){
                                $levelid=trim($fieldrecord1['levelid']);
                                $optionid=trim($fieldrecord1['optionid']);
                                $semesterid=trim($fieldrecord1['semesterid']);
                                $sessionid=trim($fieldrecord1['sessionid']);
                                $timetabletypeid=trim($fieldrecord1['timetabletypeid']);
                                }
                              }
                                
                                //Getting Time Table Detials
                                 $timetableweekdata=$SHtimetableOOP->alltimetableedit('timetableweek', 'timetableweekid', $timetableweekid);
                                  if (is_array($timetableweekdata)) {
                                 foreach($timetableweekdata as $timetableweekrec){
                                    $priority=$timetableweekrec['priority'];
                                 }
                               }

                               //Getting Time Table Detials
                                 $timetabletypedata=$SHtimetableOOP->alltimetableedit('timetabletype', 'timetabletypeid', $timetabletypeid);
                                  if (is_array($timetabletypedata)) {
                                 foreach($timetabletypedata as $timetabletyperec){
                                    $timetabletypename=$timetabletyperec['typename'];
                                 }
                               }

                              //Getting Admin Detials
                              
                                 $adminrecords=$SHtimetableOOP->alltimetableedit('adminpersons', 'adminid', $operatorid);
                                  if (is_array($adminrecords)) {
                                 foreach($adminrecords as $adminrecord){
                                    $adminsurname=$adminrecord['surname'];
                                    $adminothername=$adminrecord['othername'];
                                 }
                               }
                                  $levelname="";
                                  $levelobject=$SHtimetableOOP->alltimetableedit('level', 'levelid',  $levelid);
                                if(is_array($levelobject)){
                                foreach($levelobject as $levelrecord){
                                  $levelname=$levelrecord['levelname'];
                                  $departmentid= $levelrecord['departmentid'];
                                  }
                                }

                                //collecting Department record
                             
                                     $deptrecords=$SHtimetableOOP->alltimetableedit('department', 'did', $departmentid);
                                     if (is_array($deptrecords)) {
                                     foreach($deptrecords as $deptrecord){
                                        $deptname=$deptrecord['deptname'];
                                        
                                     }
                                   }

                                 //getting Option name
                            
                               $optionname="";
                              
                                   $optionobject=$SHtimetableOOP->alltimetableedit('optiontable', 'optid',  $optionid);
                                   if(is_array($optionobject)){
                                      foreach($optionobject as $optionrecord){
                                        $optionname=$optionrecord['optname'];
                                        
                                     }
                                    }

                                      //Select current term/semester
                                    $semestername="";
                                          
                              $semesterdata=$SHtimetableOOP->alltimetableedit('semesters','semesterid', $semesterid);
                                  if (is_array($semesterdata)) {
                                      foreach($semesterdata as $semesterrecord){
                                          $semestername=$semesterrecord['semestername'];
                                          $semesterid=trim($semesterrecord['semesterid']);
                                          
                                    }
                                }


                              //Select current Session
                               $sessiondata=$SHtimetableOOP->alltimetableedit('session', 'sessionid', $sessionid);
                                  if (is_array($sessiondata)) {
                                      foreach($sessiondata as $sessiondrecord){
                                          $sessionname=$sessiondrecord['sessionlow']."/".$sessiondrecord['sessionhigh'];
                                          $sessionid=trim($sessiondrecord['sessionid']);    
                                    }
                                }

                                $scheduletypename="";
                                $scheduletypecode="";
                              $record5=$SHtimetableOOP->alltimetableedit('lecturetype', 'lecturetypeid', $scheduletypeid);
                              if (is_array($record5)) {
                                foreach ($record5 as $records5) {
                                $scheduletypename=trim($records5['name']);
                                $scheduletypecode=trim($records5['code']);
                                }
                              }

                               $lecturehallname="";
                                $lecturehallcode="";
                               $record6=$SHtimetableOOP->alltimetableedit('lecturehall', 'lecturehallid', $hallid);
                              if (is_array($record6)) {
                                foreach ($record6 as $records6) {
                                $lecturehallname=trim($records6['hallname']);
                                $lecturehallcode=trim($records6['shortname']);
                                }
                              }

                              $ifullname="";
                                $qualification="";
                               $record8=$SHtimetableOOP->alltimetableedit('staff', 'staffid',  $instructorid);
                              if (is_array($record8)) {
                                foreach ($record8 as $records8) {
                                $ifullname=trim($records8['surname'])." ".trim($records8['othername']);
                                $qualification=trim($records8['qualification']);
                                }
                              }

                               $sfullname="";
                                $squalification="";
                               $record9=$SHtimetableOOP->alltimetableedit('staff', 'staffid', $supervisorid);
                              if (is_array($record9)) {
                                foreach ($record9 as $records9) {
                                $sfullname=trim($records9['surname'])." ".trim($records9['othername']);
                                $squalification=trim($records8['qualification']);
                                }
                              }

                              $csname="";
                                $coursecode="";
                               $record7=$SHtimetableOOP->alltimetableedit('course', 'csid', $courseid);
                              if (is_array($record7)) {
                                foreach ($record7 as $records7) {
                                $csname=trim($records7['csname']);
                                $coursecode=trim($records7['coursecode']);
                                }
                              }

                      }
                    
                  ?>
                    <div class="x_panel" >
                  <div class="x_title">
                    <h3> <?php echo $fulldate." :: ".$starttime." - ".$endtime; ?> <?php echo $sessionname." => ".$semestername. "::". $levelname." => ".$deptname; ?> Details </h3>
                    <ul class="nav navbar-right panel_toolbox" id="panel_toolbox">
                      
                      <li class="pull-right"><a href="?schoolhelp=<?php echo $schoolhelp; ?>" class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" id="printrecord">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h3>
                                          <i class="fa fa-tag" style="color:#063"></i>Week <?php echo $priority." - "; ?> <?php echo $sessionname." => ".$semestername. "::". $levelname." => ".$deptname; ?>
                                          <small class="pull-right">Date: <?php echo $odate; ?></small>
                                      </h3>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                       
                       
                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col">
                         <img id="userimage" <?php if (file_exists("../images/logo/".$instilogo) ){?> style="display: block" src="../images/logo/<?php echo $instilogo ?>" <?php } ?> class="img img-responsive img-thumbnail" >
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col" align="right">
                          <h4><b>Admin Details:</b></h4>
                          <address>
                                          Updated by: <strong><?php echo $adminsurname ." ".$adminothername; ?></strong>
                                          <br><b>Date: </b><?php echo $udate; ?></strong>
                                          <br><b>Initial Insertion Date: </b><?php echo $odatet; ?>
                                          
                                      </address>
                        </div>

                      
                      </div>
                      <!-- /.row -->


                   

                      <div class="row">
                       
                        <div class="col-xs-12">
                          <hr>
                          <center><p class="lead schoolhelpcolor"><b><?php echo $pagename; ?> Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Session</th>
                                  <td><?php echo $sessionname; ?></td>
                                </tr>
                                <tr>
                                    <th style="width:50%">Semester</th>
                                    <td><?php echo $semestername; ?></td>
                                </tr>
                                <tr>
                                  <th>Department</th>
                                  <td><?php echo $deptname; ?></td>
                                </tr>
                                 <tr>
                                  <th style="width:50%">Level</th>
                                  <td><?php echo $levelname; ?></td>
                                </tr>
                                  <tr>
                                    <th style="width:50%">Option</th>
                                    <td><?php echo $optionname; ?></td>
                                </tr>
                                <tr>
                                    <th style="width:50%">Type of Timetable</th>
                                    <td><?php echo $timetabletypename; ?></td>
                                </tr>
                                <tr>
                                    <th style="width:50%">Week</th>
                                    <td><?php echo $priority; ?></td>
                                </tr>
                                <tr>
                                    <th style="width:50%">Lecture Date</th>
                                    <td><?php echo $fulldate; ?></td>
                                </tr>
                                 <tr>
                                    <th style="width:50%">Lecture Time</th>
                                    <td><?php echo $starttime." - ".$endtime; ?></td>
                                </tr>
                                  <tr>
                                    <th style="width:50%">Schedule Type Name</th>
                                    <td><?php echo $scheduletypename; ?></td>
                                </tr>
                                 <tr>
                                    <th style="width:50%">Hall Name</th>
                                    <td><?php echo $lecturehallname; ?></td>
                                </tr>
                                  <tr>
                                  <th>Course</th>
                                  <td><?php echo $csname; ?></td>
                                </tr>
                                 <tr>
                                  <th>Instructor/Teacher or Invigilator</th>
                                  <td><?php echo $ifullname; ?></td>
                                </tr>
                                <tr>
                                  <th>Instructor/Teacher or invigilator</th>
                                  <td><?php echo $sfullname; ?></td>
                                </tr>     
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-6">
                          <button class="btn btn-primary" onclick="funcedit('<?php echo $operatorid; ?>','<?php echo $dailytimetableid; ?>')">Edit</button>
                        </div>
                        <div class="col-xs-6">
                          <button class="btn btn-default print-link" ><i class="fa fa-print"></i> Print</button>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
       <?php include("includes/footer.php"); ?>