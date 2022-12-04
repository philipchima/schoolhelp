
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHtimetableOOP.php");
include_once("../phpclass/SHtimetableupdate.php");
include_once("../phpclass/SHtimetableinserts.php");
confirmcheckin();
$SHtimetableOOP=new classTimetable;
$pagename="Duplicate Timetable";

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


if($page==2) {
    $sql="";
  if ($dashadd_d==1) {
$weeknoofdays="";
$message="";
$insertedrec="";
$timetablesemesterid=trim(isset($_POST['timetablesemesterid'])?$_POST['timetablesemesterid']:false);
$timetableweekidcf=trim(isset($_POST['timetableweekidcf'])?$_POST['timetableweekidcf']:false);
$timetableweekidct=trim(isset($_POST['timetableweekidct'])?$_POST['timetableweekidct']:false);
$startdate="";
$enddate="";
$totaldate=0;



//Getting details attached to the recieving Table
$records3=$SHtimetableOOP->alltimetableedit2('timetableweek', 'timetablesemesterid', $timetablesemesterid, 'timetableweekid', $timetableweekidct);
    if (is_array($records3)) {
      foreach($records3 as $record3){
        $startdate=trim($record3['startdate']);
        $enddate=trim($record3['enddate']);

        $datetime1 = new DateTime($startdate);

$datetime2 = new DateTime( $enddate);

$difference = $datetime1->diff($datetime2);
$totaldate=$difference->d;
       $startingdate=$startdate;
      }

       if ((is_numeric($totaldate)) && ($totaldate>0)) {
               for($i=0; $i<=$totaldate; $i++){
                //Declaration of array
                if (!isset($dailydate[$i])) {
                  $dailydate[$i]="";

                }
                if ($i!=0) {
                  $startingdate=date('Y-m-d', strtotime($startingdate.'+ 1 days'));
                }
                $startingdate;
                $dailydate[$i]=$startingdate;

               }
               
            }        
    }

$daydate="";
$dayid="";

//Checking Whetter
 $records=$SHtimetableOOP->alltimetableedit2('timetableweek', 'timetablesemesterid', $timetablesemesterid, 'timetableweekid', $timetableweekidcf);
    if (is_array($records)) {
      foreach($records as $record){
        $weeknoofdays=trim($record['noofdays']);

    //Retrieving 
        //alltorderdistinct2($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $orderfield, $order, $distinctfield)
        $recordweeks=$SHtimetableOOP->alltorderdistinct2('dailytimetable', 'timetablesemesterid', $timetablesemesterid, 'timetableweekid', $timetableweekidcf, 'dayid', 'ASC', 'daydate');
          if (is_array($recordweeks)) {
            foreach($recordweeks as $recordweek){
            $daydate=trim($recordweek['daydate']);
            
            $datename=date("l jS F, Y", strtotime($daydate));
            
             $myArray = explode(' ', $datename);

                    foreach ($myArray as $key => $value) {
                      if ($key==0) {
                       $dayname=strtolower($value);
                      }
                    }
                    
             

    //Retrieving 

        $recordday2=$SHtimetableOOP->alltimetableorder3('dailytimetable', 'timetablesemesterid', $timetablesemesterid, 'timetableweekid', $timetableweekidcf, 'daydate', $daydate, 'starttime', 'ASC');
          if (is_array($recordday2)) {
            foreach($recordday2 as $recordday2s){
             $starttime=trim($recordday2s['starttime']);
             $endtime=trim($recordday2s['endtime']);
             $courseid=trim($recordday2s['courseid']);
              $scheduletypeid=trim($recordday2s['scheduletypeid']);
              $hallid=trim($recordday2s['hallid']);
              $instructorid=trim($recordday2s['instructorid']);
              $supervisor=trim($recordday2s['supervisor']);
              $copiedweekid=trim($recordday2s['timetableweekid']);
              $dayid=trim($recordday2s['dayid']);
              
             if ((is_numeric($totaldate)) && ($totaldate>0)) {

                for($i=0; $i<=$totaldate; $i++){
                  
                  $timetblcdate=$dailydate[$i];
                  $datename1=date("l jS F, Y", strtotime($timetblcdate));
                  $daydate1=date('Y-m-d', strtotime($timetblcdate));
                   $myArray1 = explode(' ', $datename1);

                    foreach ($myArray1 as $key1 => $value1) {
                      if ($key1==0) {
                        $dayname1=strtolower($value1);
                        
                        if ($dayname==$dayname1) {

                          $state=$tableInsert->insert_14fields('dailytimetable',  'timetablesemesterid', $timetablesemesterid, 'timetableweekid', $timetableweekidct, 'starttime', $starttime, 'endtime', $endtime, 'courseid', $courseid, 'scheduletypeid', $scheduletypeid, 'hallid', $hallid, 'instructorid', $instructorid, 'supervisor', $supervisor, 'copiedweekid', $copiedweekid, 'dayid', $dayid,  'daydate', $daydate1, 'operatorid', $schoolhelp, 'odate', $odate);
                            $message=$state['action'];
                            $insertedrec+=1;
                            $sql=$message.":: Insertion Made, affected records = ".$insertedrec;
                        }

                      }
                    }

                }
                  
              }

            }
          }


            }
          }

      } 
    }


} //Closing of whether this person(admin) can add record

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}


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
                          
                      <li><a href="?schoolhelp=<?php echo $schoolhelp; ?>&page=1" ><i class="fa fa-plus"></i> Copy Timetable</a>
                      </li>
                      <?php } ?>
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> View Copied Timetable</a>
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
                          <th style="font-size: 9px">Copied Week</th>
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
                                $copiedweekid=trim($fieldrecord['copiedweekid']);

                                //Checking Whether Timetable was copied
                                 if ($copiedweekid>0) {
                                 
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

                                //Select copied weekid
                               $copiedweekdata=$SHtimetableOOP->alltimetableedit('timetableweek', 'timetableweekid', $copiedweekid);
                                  if (is_array($copiedweekdata)) {
                                      foreach($copiedweekdata as $copiedweekrec){
                                          $priority1=trim($copiedweekrec['priority']);    
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
                                        <td><?php echo "Week " .$priority1 ; ?></td>
                                        <td><?php echo   trim($fieldrecord['starttime']); ?></td>     
                                        
                                        <td><?php echo  substr($dayname,0,12); ?></td>
                                        <td><?php echo  substr($csname,0,12); ?></td>

                                        <td><?php echo substr($staffsurname." ".$staffothername,0,12) ?></td>
                                        <td><?php echo  substr($hallname,0,12); ?></td>

                                        <td><?php echo substr($fieldrecord['starttime'],0,12); ?></td>
                                        <td><?php echo substr($fieldrecord['endtime'],0,12);; ?></td>
                                        
                                         <td><button onclick="funcprint1('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['dailytimetableid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                          <?php if ($dashedit_d==1) { ?>
                                        <td><button onclick="funcedit1('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['dailytimetableid']; ?>')"><center><i class="fa fa-edit" style="color:#d2dc2a; font-size:2em"></i></center></button></td>
                                        <?php } ?>
                                         <?php if ($dashdelete_d==1) { ?>
                                        <td><button onclick="funcdelete1('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['dailytimetableid']; ?>','');"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
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
                                        <td><?php echo "Week " .$priority1 ; ?></td>
                                        
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
                                       }//End of checking whether week was copied
                                      ?>
                            <?php
                                }
                              }
                             ?>
                        
                      </tbody>
                    </table>
                   </fieldset>
                    </div>
                    <?php } ?>

                     

                    <?php if($page==1) {  ?>

                    <div class="x_panel">

                      <fieldset>
                        <legend style="color:#063"><?php echo $pagename ?></legend>
                  <form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="frmmedtreatmentid"   class="form-horizontal form-label-left" >
                   
                      <div class="form-group">
                        <label for="semester" class="control-label col-md-3 col-sm-3 col-xs-12">Semester's Timetable Setup</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="hidden" id="operatorid" name="operatorid" value="<?php echo $schoolhelp; ?>" ><!--addingweeks--> <!--wkretrieve_func-->
                            <select name="timetablesemesterid" id="timetablesemesterid" class="form-control col-md-8 col-xs-12" onchange="copyweek('dailytimetable', 'timetableweek', 'timetablesemesterid', this.value, 'copyweek', 'weekscontainer');">
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

                     
                   </form>
                  </div>
                  </fieldset>
                 </div>
                 <?php } ?>

               
              </div>
            </div>
       <?php include("includes/footer.php"); ?>