
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHtimetableOOP.php");
include_once("../phpclass/SHtimetableupdate.php");
include_once("../phpclass/SHtimetableinserts.php");
confirmcheckin();
$SHtimetableOOP=new classTimetable;
$pagename="Semester Timetable Setup";

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
$levelid=isset($_POST['levelid'])?$_POST['levelid']:false;
$sessionid=trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);
$semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);

$state="Completely Unsuccessfully";

foreach($levelid as $arraycount=>$arrayid){

$levelnameid=trim(ucwords($arrayid));
$description=trim(isset($_POST['description'.$arraycount])?$_POST['description'.$arraycount]:false);
$optionid=trim(isset($_POST['optionid'.$arraycount])?$_POST['optionid'.$arraycount]:false);
$timetabletypeid=trim(isset($_POST['timetabletypeid'.$arraycount])?$_POST['timetabletypeid'.$arraycount]:false);
$noofweeks=trim(isset($_POST['noofweeks'.$arraycount])?$_POST['noofweeks'.$arraycount]:false);
$startdate=trim(isset($_POST['startdate'.$arraycount])?$_POST['startdate'.$arraycount]:false);
$enddate=trim(isset($_POST['enddate'.$arraycount])?$_POST['enddate'.$arraycount]:false);
  
//Checking Whetter Exam type has been added
 $records=$SHtimetableOOP->alltimetableedit5('timetablesemester', 'optionid', $optionid, 'levelid', $levelnameid, 'semesterid', $semesterid, 'sessionid', $sessionid, 'timetabletypeid', $timetabletypeid);
    if (is_array($records)) {
       $sql="This ".$pagename." is found in the database";
    }
else{

$insertedrec+=1;
$state=$tableInsert->insert_12fields('timetablesemester',  'optionid', $optionid, 'timetabletypeid', $timetabletypeid, 'levelid', $levelnameid, 'semesterid', $semesterid, 'sessionid', $sessionid, 'description', $description, 'noofweeks', $noofweeks,  'startdate', $startdate, 'enddate', $enddate, 'operatorid', $schoolhelp, 'udate', $udate, 'odate', $odate);
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
  $timetablesemesterid=trim(isset($_POST['timetablesemesterid'])?$_POST['timetablesemesterid']:false);
  $semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
  $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);
  $description=trim(isset($_POST['description'])?$_POST['description']:false);
  $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
  $sessionid=trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);
  $noofweeks=trim(isset($_POST['noofweeks'])?$_POST['noofweeks']:false);
  $startdate=trim(isset($_POST['startdate'])?$_POST['startdate']:false);
  $enddate=trim(isset($_POST['enddate'])?$_POST['enddate']:false);
  $timetabletypeid=trim(isset($_POST['timetabletypeid'])?$_POST['timetabletypeid']:false);
 
$state=$tableUpdate->update_tenfields('timetablesemester', 'timetablesemesterid', $timetablesemesterid, 'timetabletypeid', $timetabletypeid, 'sessionid', $sessionid, 'semesterid',  $semesterid, 'description', $description, 'optionid', $optionid, 'levelid', $levelid, 'noofweeks', $noofweeks, 'startdate', $startdate, 'enddate', $enddate, 'operatorid', $schoolhelp);

$sql=$state.":: Update Made, affected records = 1";
 }

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
 
}


if ($page==6) {
   $sql="Criminal Suspected";
  if ($dashdelete_d==1) {
  
   $timetablesemesterid=trim(isset($_GET['id'])?$_GET['id']:false);
   //$photo=trim(isset($_GET['photo'])?$_GET['photo']:false);
   $tableUpdate= new updateTable;
    $state=$tableUpdate->delete_timetable('timetablesemester', 'timetablesemesterid', $timetablesemesterid);

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
                          
                      <li><a href="#" data-toggle="modal" data-target="#myModal" ><i class="fa fa-plus"></i> Add <?php echo $pagename ?></a>
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
                          <th> Weeks</th>
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
                              $k1=0; 
                              $hallname="";
                              
                              $records=$SHtimetableOOP->alltimetable('timetablesemester', 'timetablesemesterid', 'DESC');
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                $optionid="";
                                $deptname="";
                                $departmentid="";
                                $levelname="";
                                
                                $operatorid=trim($fieldrecord['operatorid']);
                               
                                $levelid=trim($fieldrecord['levelid']);
                                $optionid=trim($fieldrecord['optionid']);
                                $semesterid=trim($fieldrecord['semesterid']);
                                $sessionid=trim($fieldrecord['sessionid']);
                                $timetabletypeid=trim($fieldrecord['timetabletypeid']);
                                
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

                                 //collecting Timetable record
                                    $typename="";
                                     $typerecords=$SHtimetableOOP->alltimetableedit('timetabletype', 'timetabletypeid', $timetabletypeid);
                                     if (is_array($typerecords)) {
                                     foreach($typerecords as $typerecord){
                                        $typename=$typerecord['typename'];
                                        
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
                                        <td><?php echo  substr($fieldrecord['noofweeks'],0,12); ?></td>
                                        <td><?php echo substr($fieldrecord['startdate'],0,12) ?></td>
                                        <td><?php echo  substr($fieldrecord['enddate'],0,12); ?></td>
                                         
                                     
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['timetablesemesterid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                          <?php if ($dashedit_d==1) { ?>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['timetablesemesterid']; ?>')"><center><i class="fa fa-edit" style="color:#d2dc2a; font-size:2em"></i></center></button></td>
                                        <?php } ?>
                                         <?php if ($dashdelete_d==1) { ?>
                                        <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['timetablesemesterid']; ?>','');"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
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
                                        <td><?php echo  substr($fieldrecord['noofweeks'],0,12); ?></td>
                                        <td><?php echo substr($fieldrecord['startdate'],0,12) ?></td>
                                        <td><?php echo  substr($fieldrecord['enddate'],0,12); ?></td>
                                         
                                     
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['timetablesemesterid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                          <?php if ($dashedit_d==1) { ?>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['timetablesemesterid']; ?>')"><center><i class="fa fa-edit" style="color:#d2dc2a; font-size:2em"></i></center></button></td>
                                        <?php } ?>
                                         <?php if ($dashdelete_d==1) { ?>
                                        <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['timetablesemesterid']; ?>','');"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
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
                        <label for="session" class="control-label col-md-3 col-sm-3 col-xs-12">Session</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                      <select  name="sessionid" id="sessionid" required="required"  class="form-control col-md-1 col-xs-2" >
                               <option value="">--Select Session--</option>
                              <?php
                               $retrievedata1=$SHtimetableOOP->alltimetable('session', 'sessionid', 'desc');
                                if (is_array($retrievedata1)) {
                                foreach($retrievedata1 as $field1){
                              ?>
                                    <option value="<?php echo $field1['sessionid']; ?>" <?php if ($field1['status']==1) {?> selected="selected" <?php } ?> ><?php echo $field1['sessionlow'].' - '.$field1['sessionhigh']; ?></option>
                              <?php
                                  }
                                }
                                ?>
                            </select>
                          </div>
                        </div>

                           <div class="form-group">
                        <label for="semester" class="control-label col-md-3 col-sm-3 col-xs-12">Semester</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        
                            <select  name="semesterid" id="semesterid" required="required"  class="form-control col-md-1 col-xs-2" >
                               <option value="">--Select Semester/Term--</option>
                              <?php
                              $retrievedata=$SHtimetableOOP->alltimetable('semesters', 'semesterid', 'ASC');
                                if (is_array($retrievedata)) {
                                foreach($retrievedata as $field){
                              ?>
                                    <option value="<?php echo $field['semesterid']; ?>" <?php if ($field['status']==1) {?> selected="selected" <?php } ?> ><?php echo $field['semestername']; ?></option>
                              <?php
                                  }
                                }
                                ?>
                            </select>
                        </div>
                      </div>

                     <?php $count=0; $u=1; while($numberoffields>=1){
                       $numberoffields-=1;  ?>
                       <?php echo $pagename; ?>  <?php echo $u; ?>
                       <hr>

                        <div class="form-group">
                        <label for="level" class="control-label col-md-3 col-sm-3 col-xs-12">Level|Class</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="levelid[]" id="levelid[]" class="form-control col-md-7 col-xs-12"  onchange="retrieveselection1('optiontable', 'levelid', this.value, 0, 0, 'retrieveselection4', 'retrieveselection<?php echo $count; ?>', '<?php echo $count; ?>');" required="required">
                             <option>--Select Level|Class--</option>
                            <?php 
                            $record=$SHtimetableOOP->alltimetable('level', 'levelid', 'ASC');
                            if (is_array($record)) {
                            foreach($record as $records){
                              $did=trim($records['departmentid']);
                              $record1=$SHtimetableOOP->alltimetableedit('department', 'did', $did);
                              if (is_array($record1)) {
                              foreach($record1 as $record1s){
                                $deptname=$record1s['deptname'];
                              }
                            }

                          if ($admintype==0) {
                            if ($logindepartmentid==$did) {
                            ?>
                             <option value="<?php echo $records['levelid'] ?>"><?php echo $records['levelname']." => ".$deptname; ?></option>
                           <?php }
                              }
                           else{ ?>
                            <option value="<?php echo $records['levelid'] ?>"><?php echo $records['levelname']." => ".$deptname; ?></option>
                            <?php 
                                  }
                              } 
                            }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div id="retrieveselection<?php echo $count; ?>">
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Option|Group|Arm</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                          <select name="optionid<?php echo $count; ?>" id="optionid" class="form-control col-md-7 col-xs-12" type="text"  data-toggle="tooltip" data-placement="top" title="Make sure Level|Class is selected" required="required">
                            <option value="">-Select Option|Group|Arm-</option>

                          </select>
                        </div>
                      </div>
                       <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Timetable Type</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                          <select name="timetabletypeid<?php echo $count; ?>" id="timetabletypeid" class="form-control col-md-7 col-xs-12" type="text"  data-toggle="tooltip" data-placement="top" title="Make sure Level|Class is selected" required="required">
                            <option value="">-Select Timetable Type-</option>

                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                        <label for="hallname" class="control-label col-md-3 col-sm-3 col-xs-12">No of Weeks<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="noofweeks" class="form-control col-md-7 col-xs-12" placeholder="Please enter the total number of weeks" name="noofweeks<?php echo $count; ?>" required="required" type="number">
                        </div>
                      </div>

                     <div class="form-group">
                        <label for="hallname" class="control-label col-md-3 col-sm-3 col-xs-12">Start Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="startdate" class="form-control col-md-7 col-xs-12" placeholder="please enter when semester will start" name="startdate<?php echo $count; ?>" required="required" type="date">
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="hallname" class="control-label col-md-3 col-sm-3 col-xs-12">End date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="enddate" class="form-control col-md-7 col-xs-12" placeholder="please enter when semester will end" name="enddate<?php echo $count; ?>" required="required" type="date">
                        </div>
                      </div>


                        <div class="form-group">
                        <label for="description" class="control-label col-md-3 col-sm-3 col-xs-12">Description<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="description" class="form-control col-md-7 col-xs-12"  name="description<?php echo $count; ?>" placeholder="Please describe this record"></textarea>
                        </div>
                      </div>

                    <?php $count++; $u++; } ?>
                          <div id="msg" ></div>
                                  <div class="ln_solid"></div>
                                  <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                      
                          <button class="btn btn-primary" type="reset">Reset</button>
                                      <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                          </div>
                    </form>
                  </div>
                  </fieldset>
                 </div>
                 <?php } ?>

                  <?php 

                  if($page==3) {
                    $timetablesemesterid=trim(isset($_GET['id'])?$_GET['id']:false);
                   $records=$SHtimetableOOP->alltimetableedit('timetablesemester', 'timetablesemesterid', $timetablesemesterid);
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                
                                $description=trim($fieldrecord['description']);
                                $sessionid=trim($fieldrecord['sessionid']);
                                $semesterid=trim($fieldrecord['semesterid']);
                                $optionid=trim($fieldrecord['optionid']);
                                $levelid=trim($fieldrecord['levelid']);
                                $noofweeks=trim($fieldrecord['noofweeks']);
                                $startdate=trim($fieldrecord['startdate']);
                                $enddate=trim($fieldrecord['enddate']);
                                $timetabletypeid=trim($fieldrecord['timetabletypeid']);
                                $record=$SHtimetableOOP->alltimetableedit('level', 'levelid', $levelid);
                                if (is_array($record)) {
                                  foreach ($record as $records) {
                                  $departmentid=trim($records['departmentid']);
                                  }
                                }

                          }
                      }
                    ?>
                    
                    <div class="x_panel">

                      <fieldset>
                        <legend style="color:#063">Edit <?php echo $pagename ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="forminstitutionid"  class="form-horizontal form-label-left" >
                    <input id="timetablesemesterid" class="form-control col-md-7 col-xs-12" type="hidden" name="timetablesemesterid" required="required" value="<?php echo $timetablesemesterid; ?>">

                      <div class="form-group">
                        <label for="session" class="control-label col-md-3 col-sm-3 col-xs-12">Session</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="sessionid" id="sessionid" class="form-control col-md-7 col-xs-12" onchange="return updatevalidity5('timetablesemester', 'Class Timetable', '<?php echo $timetablesemesterid;  ?>', 'timetablesemesterid', 'optionid', $('#optionid').val(), 'levelid', $('#levelid').val(), 'semesterid', $('#semesterid').val(), 'sessionid', $('#sessionid').val(), 'timetabletypeid', $('#timetabletypeid').val(), 'updating', 'sessionid');">
                             <option>--Select Session--</option>
                            <?php $record=$SHtimetableOOP->alltimetable('session', 'sessionid',  'ASC'); 
                             if (is_array($record)) {
                            foreach($record as $records){
                            ?>
                            <option value="<?php echo $records['sessionid']; ?>" <?php if ($records['sessionid']==$sessionid){ ?> selected="selected" <?php } ?>><?php echo $records['sessionlow'].'/'.$records['sessionhigh'] ?></option>
                            <?php } 
                          }?>
                          </select>
                        </div>
                      </div>
                      
                        <div class="form-group">
                        <label for="semester" class="control-label col-md-3 col-sm-3 col-xs-12">Semester</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        
                            <select  name="semesterid" id="semesterid" required="required"  class="form-control col-md-1 col-xs-2" onchange="return updatevalidity5('timetablesemester', 'Class Timetable', '<?php echo $timetablesemesterid;  ?>', 'timetablesemesterid', 'optionid', $('#optionid').val(), 'levelid', $('#levelid').val(), 'semesterid', $('#semesterid').val(), 'sessionid', $('#sessionid').val(), 'timetabletypeid', $('#timetabletypeid').val(), 'updating', 'sessionid');">
                               <option value="">--Select Semester/Term--</option>
                              <?php  
                              $retrievedata=$SHtimetableOOP->alltimetable('semesters', 'semesterid', 'ASC');
                                if (is_array($retrievedata)) {
                                foreach($retrievedata as $field){
                              ?>
                                    <option value="<?php echo $field['semesterid']; ?>" <?php if ($field['semesterid']==$semesterid) {?> selected="selected" <?php } ?> ><?php echo $field['semestername']; ?></option>
                              <?php
                                  }
                                }
                                ?>
                            </select>
                        </div>
                      </div>   

                       <div class="form-group">
                        <label for="level" class="control-label col-md-3 col-sm-3 col-xs-12">Level|Class</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="levelid" id="levelid" class="form-control col-md-7 col-xs-12"  onchange="retrieveselection1('optiontable', 'levelid', this.value, 0, 0, 'retrieveselection4', 'retrieveselection4', '');" required="required" >
                             <option>--Select Level|Class--</option>
                            <?php 
                            $record=$SHtimetableOOP->alltimetable('level', 'levelid', 'ASC');
                            if (is_array($record)) {
                            foreach($record as $records){
                              $did=trim($records['departmentid']);
                              $record1=$SHtimetableOOP->alltimetableedit('department', 'did', $did);
                              if (is_array($record1)) {
                              foreach($record1 as $record1s){
                                $deptname=$record1s['deptname'];
                              }
                            }

                          if ($admintype==0) {
                            if ($logindepartmentid==$did) {
                            ?>
                             <option value="<?php echo $records['levelid'] ?>" <?php if ($records['levelid']==$fieldrecord['levelid']){ ?> selected="selected" <?php } ?>><?php echo $records['levelname']." => ".$deptname; ?></option>
                           <?php }
                              }
                           else{ ?>
                            <option value="<?php echo $records['levelid'] ?>" <?php if ($records['levelid']==$fieldrecord['levelid']){ ?> selected="selected" <?php } ?>><?php echo $records['levelname']." => ".$deptname; ?></option>
                            <?php 
                                  }
                              } 
                            }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div id="retrieveselection4">
                            <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Option|Arm|Group<span class="required">*</span>
                                   </label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                    
                                  <select name="optionid" id="optionid" required="required" class="form-control col-md-6 col-xs-12" onchange=" updatevalidity5('timetablesemester', 'Class Timetable', '<?php echo $timetablesemesterid;  ?>', 'timetablesemesterid', 'optionid', $('#optionid').val(), 'levelid', $('#levelid').val(), 'semesterid', $('#semesterid').val(), 'sessionid', $('#sessionid').val(), 'timetabletypeid', $('#timetabletypeid').val(), 'updating', 'sessionid');">
                                   <option value="">--Select Option|Arm|Group--</option>
                                     <?php  $retrievedata=$SHtimetableOOP->alltimetableedit('optiontable', 'levelid', $levelid);
                                        if (is_array($retrievedata)) {
                                        ?> 
                                        <?php
                                          foreach($retrievedata as $field){
                                        ?>
                                              <option value="<?php echo $field['optid']; ?>" <?php if($field['optid']==$optionid){ ?> selected="selected" <?php } ?>><?php echo $field['optname']; ?></option>
                                        <?php
                                             }

                                        }?>
                                              </select>
                                            </div>
                                          </div>

                                  <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Timetable Type<span class="required">*</span>
                                   </label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                    
                                  <select name="timetabletypeid" id="timetabletypeid" required="required" class="form-control col-md-6 col-xs-12" onchange=" updatevalidity5('timetablesemester', 'Class Timetable', '<?php echo $timetablesemesterid;  ?>', 'timetablesemesterid', 'optionid', $('#optionid').val(), 'levelid', $('#levelid').val(), 'semesterid', $('#semesterid').val(), 'sessionid', $('#sessionid').val(), 'timetabletypeid', $('#timetabletypeid').val(), 'updating', 'sessionid');">
                                   <option value="">--Select Timetable Type--</option>
                                     <?php  $retrievedata=$SHtimetableOOP->alltimetableedit('timetabletype', 'departmentid', $departmentid);
                                        if (is_array($retrievedata)) {
                                        ?> 
                                        <?php
                                          foreach($retrievedata as $field){
                                        ?>
                                              <option value="<?php echo $field['timetabletypeid']; ?>" <?php if($field['timetabletypeid']==$timetabletypeid){ ?> selected="selected" <?php } ?>><?php echo $field['typename']; ?></option>
                                        <?php
                                             }

                                        }?>
                                              </select>
                                            </div>
                                          </div>
                                    </div>              

                           <div class="form-group">
                        <label for="hallname" class="control-label col-md-3 col-sm-3 col-xs-12">No of Weeks<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="noofweeks" class="form-control col-md-7 col-xs-12" placeholder="Please enter the total number of weeks" name="noofweeks" required="required" type="number" value="<?php echo $noofweeks; ?>">
                        </div>
                      </div>

                     <div class="form-group">
                        <label for="hallname" class="control-label col-md-3 col-sm-3 col-xs-12">Start Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="startdate" class="form-control col-md-7 col-xs-12" placeholder="please enter when semester will start" name="startdate" required="required" type="date" value="<?php echo $startdate; ?>">
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="hallname" class="control-label col-md-3 col-sm-3 col-xs-12">End date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="enddate" class="form-control col-md-7 col-xs-12" placeholder="please enter when semester will end" name="enddate" value="<?php echo $enddate; ?>" required="required" type="date">
                        </div>
                      </div>


                        <div class="form-group">
                        <label for="description" class="control-label col-md-3 col-sm-3 col-xs-12">Description<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="description" class="form-control col-md-7 col-xs-12"  name="description" placeholder="Please describe this kind of this record"><?php echo $description; ?></textarea>
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
                   $timetablesemesterid=trim(isset($_GET['id'])?$_GET['id']:false);
                   $records=$SHtimetableOOP->alltimetableedit('timetablesemester', 'timetablesemesterid', $timetablesemesterid);
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                $description=trim($fieldrecord['description']);
                                $levelid=trim($fieldrecord['levelid']);
                                $optionid=trim($fieldrecord['optionid']);
                                $sessionid=trim($fieldrecord['sessionid']);
                                $semesterid=trim($fieldrecord['semesterid']);
                                $operatorid=trim($fieldrecord['operatorid']);
                                $udate=trim($fieldrecord['udate']);
                                $odatet=trim($fieldrecord['odate']);
                                $noofweeks=trim($fieldrecord['noofweeks']);
                                $startdate=trim($fieldrecord['startdate']);
                                $enddate=trim($fieldrecord['enddate']);
                                $timetabletypeid=trim($fieldrecord['timetabletypeid']);

                                 $record3=$SHtimetableOOP->alltimetableedit('level', 'levelid', $levelid);
                                if (is_array($record3)) {
                                  foreach ($record3 as $records3) {
                                  $departmentid=trim($records3['departmentid']);
                                  }
                                }

                                 $record4=$SHtimetableOOP->alltimetableedit('timetabletype', 'timetabletypeid', $timetabletypeid);
                                if (is_array($record4)) {
                                  foreach ($record4 as $records4) {
                                  $typename=trim($records4['typename']);
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
                        
                               //Getting Admin Detials
                              
                                 $adminrecords=$SHtimetableOOP->alltimetableedit('adminpersons', 'adminid', $operatorid);
                                 foreach($adminrecords as $adminrecord){
                                    $adminsurname=$adminrecord['surname'];
                                    $adminothername=$adminrecord['othername'];
                                 }

                             
                                  
                                  //Instition Record
                                  
                                  $record1=$SHtimetableOOP->alltimetable('institution', 'i_id', 'DESC');

                                   if (is_array($record1)) {
                                  foreach($record1 as $recordinstitution){
                                    $instilogo=$recordinstitution['instilogo'];
                                  }
                                }



                              }
                    
                    }
                    
                  ?>
                    <div class="x_panel" >
                  <div class="x_title">
                    <h3><?php echo $levelname." ".$optionname." ".$pagename; ?> Details </h3>
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
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $levelname." ".$optionname." ".$pagename; ?>
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
                                    <th style="width:50%">Timetable Type</th>
                                    <td><?php echo $typename; ?></td>
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
                                    <th style="width:50%">No of Weeks</th>
                                    <td><?php echo $noofweeks; ?></td>
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