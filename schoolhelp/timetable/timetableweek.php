
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHtimetableOOP.php");
include_once("../phpclass/SHtimetableupdate.php");
include_once("../phpclass/SHtimetableinserts.php");
confirmcheckin();
$SHtimetableOOP=new classTimetable;
$pagename="Week Timetable Setup";

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
 $records=$SHtimetableOOP->alltimetableedit2('timetableweek', 'timetablesemesterid', $timetablesemesterid, 'priority', $priority);
    if (is_array($records)) {
       $sql="This ".$pagename." is found in the database";
    }
else{

$insertedrec+=1;
$state=$tableInsert->insert_10fields('timetableweek', 'timetablesemesterid', $timetablesemesterid, 'noofperiod', $noofperiod, 'noofdays', $noofdaysvalue,  'priority', $priority, 'description', $description,  'startdate', $startdate, 'enddate', $enddate, 'operatorid', $schoolhelp, 'udate', $udate, 'odate', $odate);
$sql=$state.":: Insertion Made, affected records = ".$insertedrec;
}
}

}

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}

if($page==4) {
    $sql="Criminal Suspected";
  if ($dashedit_d==1) {
  $timetableweekid=trim(isset($_POST['timetableweekid'])?$_POST['timetableweekid']:false);
  
  $description=trim(isset($_POST['description'])?$_POST['description']:false);
  $noofperiod=trim(isset($_POST['noofperiod'])?$_POST['noofperiod']:false);
  $noofdays=trim(isset($_POST['noofdays'])?$_POST['noofdays']:false);
  $startdate=trim(isset($_POST['startdate'])?$_POST['startdate']:false);
  $enddate=trim(isset($_POST['enddate'])?$_POST['enddate']:false);
 
$state=$tableUpdate->update_sixfields('timetableweek', 'timetableweekid', $timetableweekid, 'noofdays', $noofdays, 'noofperiod',  $noofperiod, 'description', $description, 'startdate', $startdate, 'enddate', $enddate, 'operatorid', $schoolhelp);

$sql=$state.":: Update Made, affected records = 1";
 }

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
 
}


if ($page==6) {
   $sql="Criminal Suspected";
  if ($dashdelete_d==1) {
  
   $timetableweekid=trim(isset($_GET['id'])?$_GET['id']:false);
   //$photo=trim(isset($_GET['photo'])?$_GET['photo']:false);
   $tableUpdate= new updateTable;
    $state=$tableUpdate->delete_timetable('timetableweek', 'timetableweekid', $timetableweekid);

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
                          <th>SN</th>
                          <th> Department</th>
                          <th> Level</th>
                          <th> Option</th>
                          <th> Session</th>
                          <th> Semester</th>
                          <th> Type</th>
                          <th> Week</th>
                          <th> Starts</th>
                          <th> Ends</th>
                          <th> No of Days</th>
                          <th> No of Period</th>
                          

                         
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
                              $k1=0;
                              $hallname="";
                              
                              $records=$SHtimetableOOP->alltimetable('timetableweek', 'timetableweekid', 'ASC');
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
                                        <td><?php echo $k1; ?></td>
                                        <td><?php echo substr($deptname, 0,12); ?></td>                               
                                        <td><?php echo  $levelname; ?></td>
                                        <td><?php echo  $optionname; ?></td>
                                        <td><?php echo substr($sessionname, 0,12); ?></td>   
                                        <td><?php echo substr($semestername, 0,12); ?></td>  
                                        <td><?php echo  substr($typename, 0,12); ?></td>
                                        <td><?php echo   substr($fieldrecord['priority'], 0,12); ?></td>    
                                       
                                        <td><?php echo substr($fieldrecord['startdate'],0,12) ?></td>
                                        <td><?php echo  substr($fieldrecord['enddate'],0,12); ?></td>
                                        <td><?php echo  substr($fieldrecord['noofdays'],0,12); ?></td>
                                        <td><?php echo  substr($fieldrecord['noofperiod'],0,12); ?></td>
                                       
                                        
                                     
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['timetableweekid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                          <?php if ($dashedit_d==1) { ?>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['timetableweekid']; ?>')"><center><i class="fa fa-edit" style="color:#d2dc2a; font-size:2em"></i></center></button></td>
                                        <?php } ?>
                                         <?php if ($dashdelete_d==1) { ?>
                                        <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['timetableweekid']; ?>','');"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
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
                                          <td><?php echo $k; ?></td>
                                        <td><?php echo substr($deptname, 0,12); ?></td>                               
                                        <td><?php echo  $levelname; ?></td>
                                        <td><?php echo  $optionname; ?></td>
                                        <td><?php echo substr($sessionname, 0,12); ?></td>   
                                        <td><?php echo substr($semestername, 0,12); ?></td>  
                                         <td><?php echo  substr($typename, 0,12); ?></td>
                                        <td><?php echo   substr($fieldrecord['priority'], 0,12); ?></td>    
                                       
                                        <td><?php echo substr($fieldrecord['startdate'],0,12) ?></td>
                                        <td><?php echo  substr($fieldrecord['enddate'],0,12); ?></td>
                                         <td><?php echo  substr($fieldrecord['noofdays'],0,12); ?></td>
                                          <td><?php echo  substr($fieldrecord['noofperiod'],0,12); ?></td>
                                       
                                        
                                     
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['timetableweekid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                          <?php if ($dashedit_d==1) { ?>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['timetableweekid']; ?>')"><center><i class="fa fa-edit" style="color:#d2dc2a; font-size:2em"></i></center></button></td>
                                        <?php } ?>
                                         <?php if ($dashdelete_d==1) { ?>
                                        <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['timetableweekid']; ?>','');"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
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
                  <form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="frmmedtreatmentid"   class="form-horizontal form-label-left" >

                      <div class="form-group">
                        <label for="semester" class="control-label col-md-3 col-sm-3 col-xs-12">Semester's Timetable Setup</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                        
                            <select name="timetablesemesterid" id="timetablesemesterid" class="form-control col-md-8 col-xs-12" onchange="addingfields('timetableweek', 'timetablesemesterid', 'timetablesemester', 'timetablesemesterid', 'noofweeks', this.value, 'checktwotables');">
                             <option>Semester's Timetable Setup</option>
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

                     <div id="opencontainer">

                     </div>

                    </form>
                  </div>
                  </fieldset>
                 </div>
                 <?php } ?>

                  <?php 

                  if($page==3) {
                    $timetableweekid=trim(isset($_GET['id'])?$_GET['id']:false);
                   $records=$SHtimetableOOP->alltimetableedit('timetableweek', 'timetableweekid', $timetableweekid);
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                
                                $description=trim($fieldrecord['description']);
                                $noofdays=trim($fieldrecord['noofdays']);
                                $priority=trim($fieldrecord['priority']);
                                
                                $noofperiod=trim($fieldrecord['noofperiod']);
                                $description=trim($fieldrecord['description']);
                                
                                $startdate=trim($fieldrecord['startdate']);
                                $enddate=trim($fieldrecord['enddate']);
                                 $timetablesemesterid=trim($fieldrecord['timetablesemesterid']);
                                $operatorid=trim($fieldrecord['operatorid']);

                          }
                           $records1=$SHtimetableOOP->alltimetableedit('timetablesemester', 'timetablesemesterid', $timetablesemesterid);
                                if (is_array($records1)) {
                                foreach($records1 as $fieldrecord1){
                                $levelid=trim($fieldrecord1['levelid']);
                                $optionid=trim($fieldrecord1['optionid']);
                                $semesterid=trim($fieldrecord1['semesterid']);
                                $sessionid=trim($fieldrecord1['sessionid']);
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
                      }
                    ?>
                    
                    <div class="x_panel">

                      <fieldset>
                        <legend style="color:#063">Edit Week <?php echo $priority." - ".$typename." - "; ?> <?php echo  $sessionname." => ".$semestername. "::". $levelname." => ".$deptname; ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="forminstitutionid"  class="form-horizontal form-label-left" >
                    <input id="timetableweekid" class="form-control col-md-7 col-xs-12" type="hidden" name="timetableweekid" required="required" value="<?php echo $timetableweekid; ?>">

                     <div class="form-group">
                       
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="levelname">Timetable Type<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $typename; ?>
                        </div>
                      </div>

                     <div class="form-group">
                       
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="levelname">No of Days<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="noofdays" required="required" name="noofdays" class="form-control col-md-7 col-xs-12" placeholder="Please Enter no of lecture days in a week" value="<?php echo $noofdays; ?>">
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Start Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="startdate" class="form-control col-md-7 col-xs-12" type="date" name="startdate" required="required" placeholder="Enter the start date" value="<?php echo $startdate; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">End Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="enddate" class="form-control col-md-7 col-xs-12" type="date" name="enddate" required="required" placeholder="Enter the end date" value="<?php echo $enddate; ?>">
                        </div>
                      </div>
                     
                      <div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="levelname">No of Periods<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="noofperiod"  name="noofperiod" class="form-control col-md-7 col-xs-12" placeholder="Please Enter no of Periods in a week" value="<?php echo $noofperiod; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="levelname">Description<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea  id="description"  name="description" class="form-control col-md-7 col-xs-12" placeholder="Please describe this record"> <?php echo $description; ?></textarea>
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
                   $timetableweekid=trim(isset($_GET['id'])?$_GET['id']:false);
                   $records=$SHtimetableOOP->alltimetableedit('timetableweek', 'timetableweekid', $timetableweekid);
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                $description=trim($fieldrecord['description']);
                                $noofdays=trim($fieldrecord['noofdays']);
                                $priority=trim($fieldrecord['priority']);
                                
                                $noofperiod=trim($fieldrecord['noofperiod']);
                                $description=trim($fieldrecord['description']);
                                
                                $startdate=trim($fieldrecord['startdate']);
                                $enddate=trim($fieldrecord['enddate']);
                                 $timetablesemesterid=trim($fieldrecord['timetablesemesterid']);
                                $operatorid=trim($fieldrecord['operatorid']);
                                $odatet=trim($fieldrecord['odate']);
                                $timetabletypeid=trim($fieldrecord['timetabletypeid']);

                          }

                          //collecting Timetable record
                                    $typename="";
                                     $typerecords=$SHtimetableOOP->alltimetableedit('timetabletype', 'timetabletypeid', $timetabletypeid);
                                     if (is_array($typerecords)) {
                                     foreach($typerecords as $typerecord){
                                        $typename=$typerecord['typename'];
                                        
                                     }
                                   }

                           $records1=$SHtimetableOOP->alltimetableedit('timetablesemester', 'timetablesemesterid', $timetablesemesterid);
                                if (is_array($records1)) {
                                foreach($records1 as $fieldrecord1){
                                $levelid=trim($fieldrecord1['levelid']);
                                $optionid=trim($fieldrecord1['optionid']);
                                $semesterid=trim($fieldrecord1['semesterid']);
                                $sessionid=trim($fieldrecord1['sessionid']);
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
                      }
                    
                  ?>
                    <div class="x_panel" >
                  <div class="x_title">
                    <h3>Week <?php echo $priority." - "; ?> <?php echo $sessionname." => ".$semestername. "::". $levelname." => ".$deptname; ?> Details </h3>
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
                                    <th style="width:50%">Week</th>
                                    <td><?php echo $priority; ?></td>
                                </tr>

                                 <tr>
                                    <th style="width:50%">No of Days</th>
                                    <td><?php echo $noofdays; ?></td>
                                </tr>
                                  <tr>
                                    <th style="width:50%">Start Date</th>
                                    <td><?php echo $startdate; ?></td>
                                </tr>
                                 <tr>
                                    <th style="width:50%">End Date</th>
                                    <td><?php echo $enddate; ?></td>
                                </tr>
                                  <tr>
                                  <th>Description</th>
                                  <td><?php echo $description; ?></td>
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
                        <div class="col-xs-12">
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