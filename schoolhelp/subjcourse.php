
<?php 
include_once("includes/global.php");
include_once("includes/connection.php");
include_once("phpclass/SHdashinserts.php");
include_once("phpclass/SHdashupdate.php");
include_once("phpclass/SHdashOOP.php");
//include_once("../phpclass/schoolhelpOOP.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Instructor's Courses";
confirmcheckin();

$odate=date("Y-m-d");
$admintype="";

 //Staff class
 $tableinstructorcourses=new insertTable;
$schoolhelpDH=new classDash;

$previlleges=$schoolhelpDH->alldashedit('adminpersons', 'adminid', $schoolhelp);
foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['staff_d']);
  $settingedit_s=trim($actualrecord['settingedit_s']);
  $settingdelete_s=trim($actualrecord['settingdelete_s']);
  $settingadd_s=trim($actualrecord['settingadd_s']);
  $admintype=trim($actualrecord['admintype']);
  $signatorypositionid=trim($actualrecord['signatorypositionid']);
}
if ($pageaccess!=1) {
  echo "<b style='font-size:100; color:red'>Criminal Attempt Made, contact the admin ask for the access of this page</b>";
  exit();
}

//This script is to determine the actual admin that is logging whether a super admin or a position holder in a school


if ($admintype==1) {
  $logindepartmentid='';
}
else{

$signatorydata=$schoolhelpDH->alldashedit('signatoryposition', 'signatorypositionid', $signatorypositionid);
if (is_array($signatorydata)) {
  foreach($signatorydata as $signatoryrec){
$logindepartmentid=$signatoryrec['departmentid'];
  
  }
}
}

$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);
$staffid=trim(isset($_GET['staffid'])?$_GET['staffid']:false);


if($page==2) {
  //getting array ofrecords
    if ($staffid!="") {
        $page=7;
      }else{$page="";}
$counting=0;
  $departmentid=trim(isset($_POST['departmentid'])?$_POST['departmentid']:false);
  
  $staffid=trim(isset($_POST['staffid'])?$_POST['staffid']:false);
  $courseid=(isset($_POST['courseid'])?$_POST['courseid']:false);
  $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
  $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);
 $bno = count($courseid);
 for($i=0; $i < $bno; $i++){
     $actualcourseid=trim((int)$courseid[$i]);       
       $course_status=trim(isset($_POST[$actualcourseid])?$_POST[$actualcourseid]:false);
      if($course_status > 0){

$state=$tableinstructorcourses->insert_instructorcourses($staffid, $departmentid, $levelid, $optionid, $actualcourseid, $schoolhelp, $odate);
$display=$state['action'];
$counting=$counting+1;


$sql=$display.":: Insertion, affected records = ".$counting;

 }
}

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql&staffid=$staffid&page=$page';
      </script>";
}

if($page==4) {
   if ($staffid!="") {
        $page=7;
      }else{$page="";}
  $icourseid=trim(isset($_POST['icourseid'])?$_POST['icourseid']:false);
  $departmentid=trim(isset($_POST['departmentid'])?$_POST['departmentid']:false);
 
  $staffid=trim(isset($_POST['staffid'])?$_POST['staffid']:false);
  $courseid=trim(isset($_POST['courseid'])?$_POST['courseid']:false);
 

$tableicourse=new updateTable;
$state=$tableicourse->update_instructorcourses($icourseid, $staffid, $departmentid, $levelid, $optionid, $courseid, $schoolhelp);

$sql=$state.":: Update Made, affected records = 1";

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&staffid=$staffid&sql=$sql&page=$page';
      </script>";
}

if ($page==6) {
   if ($staffid!="") {
        $page=7;
      }else{$page="";}
   $icourseid=trim(isset($_GET['id'])?$_GET['id']:false);
   //$photo=trim(isset($_GET['photo'])?$_GET['photo']:false);
   $tableUpdate= new updateTable;
    $state=$tableUpdate->delete_dash('instructorcourses', 'icourseid', $icourseid);

        $sql=$state.":: Deletion Made, affected records = 1";
         /* if ($state=="Success") {
                 $target_dir = "uploads/news/";
                  @unlink($target_dir.$photo);
              }*/

      if ($staffid!="") {
        $page=7;
      }
             
        echo "<script>
                window.location.href='?schoolhelp=$schoolhelp&sql=$sql&staffid=$staffid&page=$page';
              </script>";
    
}

if ($page==10) {

    $colid=isset($_GET['id'])?$_GET['id']:false;
    $id=explode(",", $colid);
    if ($colid!="") {

      foreach($id as $i => $icourseid){

         $tableUpdate= new updateTable;
          $state=$tableUpdate->delete_dash('instructorcourses', 'icourseid', $icourseid);
        
      }
        $sql="Success:: Deletion Made, affected records = ".count($id);
        $page="";

        echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&staffid=$staffid&sql=$sql&page=$page';
      </script>";

    }

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
                      <li><a class="btn btn-primary" href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                      <li><a class="btn btn-success " href="settings?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"> Settings</i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                         <li  ><a href="?page=1&schoolhelp=<?php echo $schoolhelp; ?>"  ><i class="fa fa-plus"></i>  Assign Courses</a>
                      </li>
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>&staffid=<?php echo $staffid; ?>&page=7"><i class="fa fa-book"></i>  View Assigned Courses (Selected Instructor)</a>
                      </li>
                        </li>
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  View Assigned Courses (All Instructors)</a>
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
                          <th><input name="topcheckbox"  type="checkbox"  onchange="if(this.checked){ this.value='1'; checkno(this.value); }else{this.value=''; checkno(this.value); }" /></th>
                          <th>Staff</th>
                          <th>Course</th>
                        
                          <th>Department</th>
                          <th>Level</th>
                          <th>Option</th>
                          <th style="width:10%;"><i class="far fa-address-card" style="color:green"></i> Print</th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:red"></i> Edit</th>
                          <th><i class="fa fa-trash" style="color:red"></i> Delete</th>
                          <th>User<i class="fa fa-user"></i></th>
                          
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                              $semesterid="";
                              $courseid="";
                              $coursename="";
                              $semestername="";
                              $staffsurname="";
                              $staffothername="";
                              
                              $records=$schoolhelpDH->alldash('instructorcourses', 'staffid', 'ASC');
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                
                                $operatorid=trim($fieldrecord['operatorid']);
                                $departmentid=trim($fieldrecord['departmentid']);
                                $levelid=trim($fieldrecord['levelid']);
                                $optionid=trim($fieldrecord['optionid']);
                                
                                $courseid=trim($fieldrecord['courseid']);
                                $staffid=trim($fieldrecord['staffid']);
                                
                              //Getting Admin Detials
                              //$admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
                                 $adminrecords=$schoolhelpDH->alldashedit('adminpersons', 'adminid', $operatorid);
                                 if (is_array($adminrecords)) {
                                 foreach($adminrecords as $adminrecord){
                                    $adminsurname=$adminrecord['surname'];
                                    $adminothername=$adminrecord['othername'];
                                 }
                                }
                              //collecting staff record
                             
                                 $staffrecords=$schoolhelpDH->alldashedit('staff', 'staffid', $staffid);
                                 if (is_array($staffrecords)) {
                                    foreach($staffrecords as $staffrecord){
                                    $staffsurname=$staffrecord['surname'];
                                    $staffothername=$staffrecord['othername'];
                                  }
                                 }
                                


                                  //collecting department record
                              //$deptmethod=$deptclass->departmentedit('did', $fieldvalue1);
                              //$deptname=$deptmethod['deptname'];
                                 $departmentrecords=$schoolhelpDH->alldashedit('department', 'did', $departmentid);
                                   if (is_array($departmentrecords)) {
                                 foreach($departmentrecords as $departmentrecord){
                                    $departmentname=$departmentrecord['deptname']; 
                                 }
                               }


                                   //collecting option record
                             // $optionmethod=$optionclass->optionedit('optid', $fieldvalue3);
                              //$optionname=$optionmethod['optname'];
                                  $courserecords=$schoolhelpDH->alldashedit('course', 'csid', $courseid);
                                  if (is_array($courserecords)) {
                                 foreach($courserecords as $courserecord){
                                    $coursename=$courserecord['csname'];
                                    $semesterid=trim($courserecord['semesterid']);
                                   }
                                 }

                                  $levelrecords=$schoolhelpDH->alldashedit('level', 'levelid', $levelid);
                                  if (is_array($levelrecords)) {
                                 foreach($levelrecords as $levelrecord){
                                    $levelname=$levelrecord['levelname'];
                                   }

                                }

                              //collecting option record
                             // $optionmethod=$optionclass->optionedit('optid', $fieldvalue3);
                              //$optionname=$optionmethod['optname'];
                                    $optionrecords=$schoolhelpDH->alldashedit('optiontable', 'optid', $optionid);
                                     if (is_array($optionrecords)) {
                                 foreach($optionrecords as $optionrecord){
                                    $optionname=$optionrecord['optname'];
                                   }
                                 }


                              if ($admintype==0) {
                                  $k+=1;

                                  

                                if ($departmentid==$logindepartmentid) {?>
                                
                                      <tr>
                                        <td><?php echo $k; ?></td>
                                        <td><input name="icourseid[]" id="<?php echo $fieldrecord['icourseid']; ?>" type="checkbox" class="status1 " onchange="if(this.checked){ this.value='<?php echo $fieldrecord['icourseid']; ?>'; } else{this.value='';} "  value="<?php echo $fieldrecord['icourseid']; ?>" /></td>
                                        <td><?php echo  $staffsurname ." ".$staffothername; ?></td>
                                        <td><?php echo  substr($coursename, 0, 12); ?></td>
                                       
                                        <td><?php echo  substr($departmentname,0, 12); ?></td>
                                          <td><?php echo  substr($levelname,0, 12); ?></td>
                                          <td><?php echo  substr($optionname,0, 12); ?></td>
                                       
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['icourseid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['icourseid']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcdeletestaff('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['icourseid']; ?>','');"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
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
                             <?php 
                                    }
                                     } else{ $k+=1; ?>

                                        <tr>
                                        <td><?php echo $k; ?></td>
                                        <td><input name="icourseid[]" id="<?php echo $fieldrecord['icourseid']; ?>" type="checkbox" class="status1" onchange="if(this.checked){ this.value='<?php echo $fieldrecord['icourseid']; ?>'; } else{this.value='';} "  value="<?php echo $fieldrecord['icourseid']; ?>" /></td>
                                        <td><?php echo  $staffsurname ." ".$staffothername; ?></td>
                                        <td><?php echo  substr($coursename, 0, 12); ?></td>
                                       
                                        <td><?php echo  substr($departmentname,0, 12); ?></td>
                                        <td><?php echo  substr($levelname,0, 12); ?></td>
                                        <td><?php echo  substr($optionname,0, 12); ?></td>
                                       
                                         <td><button onclick="return funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['icourseid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                        <td><button onclick=" return funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['icourseid']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
                                        <td><button onclick="return funcdeletestaff('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['icourseid']; ?>','');"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
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

                                    <?php  }
                                }
                              }
                             ?>
                        
                      </tbody>
                    </table>
                  

                   </fieldset>
                    <div style="margin-bottom: 10px"><input type="submit" value="Delete" class="btn btn-danger" onclick="deletion('<?php echo $schoolhelp; ?>');"/></div>
                  
                    </div>
                    <?php } ?>

                      <?php if ($page==7) {?>
                      <div class="x_panel ">
                         <fieldset>
                        <legend style="color:#063"><?php echo $pagename ?> Record</legend>

                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th>SN</th>
                           <th><input name="topcheckbox"  type="checkbox"  onchange="if(this.checked){ this.value='1'; checkno(this.value); }else{this.value=''; checkno(this.value); }" /></th>
                          <th>Staff</th>
                          <th>Course</th>
                         
                          <th>Department</th>
                            <th>Level</th>
                          <th>Option</th>
                          <th style="width:10%;"><i class="far fa-address-card" style="color:green"></i> Print</th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:red"></i> Edit</th>
                          <th><i class="fa fa-trash" style="color:red"></i> Delete</th>
                          <th>User<i class="fa fa-user"></i></th>
                          
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                              $semesterid="";
                              $courseid="";
                              $coursename="";
                              $semestername="";
                              $adminsurname="";
                              $adminothername="";
                             $records=$schoolhelpDH->alldashedit('instructorcourses', 'staffid', $staffid);
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                $k+=1;
                                $operatorid=trim($fieldrecord['operatorid']);
                                $departmentid=trim($fieldrecord['departmentid']);
                                $levelid=trim($fieldrecord['levelid']);
                                $optionid=trim($fieldrecord['optionid']);
                                
                                $courseid=trim($fieldrecord['courseid']);
                                $staffid=trim($fieldrecord['staffid']);
                                
                              //Getting Admin Detials
                              //$admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
                                 $adminrecords=$schoolhelpDH->alldashedit('adminpersons', 'adminid', $operatorid);
                                 if (is_array($adminrecords)) {
                                    
                                     foreach($adminrecords as $adminrecord){
                                    $adminsurname=$adminrecord['surname'];
                                    $adminothername=$adminrecord['othername'];
                                   }

                                 }
                                

                              //collecting staff record
                             
                                 $staffrecords=$schoolhelpDH->alldashedit('staff', 'staffid', $staffid);
                                  if (is_array($staffrecords)) {
                                 foreach($staffrecords as $staffrecord){
                                    $staffsurname=$staffrecord['surname'];
                                    $staffothername=$staffrecord['othername'];
                                 }
                               }


                                  //collecting department record
                              //$deptmethod=$deptclass->departmentedit('did', $fieldvalue1);
                              //$deptname=$deptmethod['deptname'];
                                 $departmentrecords=$schoolhelpDH->alldashedit('department', 'did', $departmentid);
                                 if (is_array($departmentrecords)) {
                                 foreach($departmentrecords as $departmentrecord){
                                    $departmentname=$departmentrecord['deptname']; 
                                 }
                               }

                                    $levelname="";
                                    $levelrecords=$schoolhelpDH->alldashedit('level', 'levelid', $levelid);
                                  if (is_array($levelrecords)) {
                                 foreach($levelrecords as $levelrecord){
                                    $levelname=$levelrecord['levelname'];
                                   }

                                }

                              //collecting option record
                             
                              $optionname="";
                                    $optionrecords=$schoolhelpDH->alldashedit('optiontable', 'optid', $optionid);
                                     if (is_array($optionrecords)) {
                                 foreach($optionrecords as $optionrecord){
                                    $optionname=$optionrecord['optname'];
                                   }
                                 }


                             
                                   //collecting option record
                             // $optionmethod=$optionclass->optionedit('optid', $fieldvalue3);
                              //$optionname=$optionmethod['optname'];
                                  $courserecords=$schoolhelpDH->alldashedit('course', 'csid', $courseid);
                                  if (is_array($courserecords)) {
                                 foreach($courserecords as $courserecord){
                                    $coursename=$courserecord['csname'];
                                    $semesterid=trim($courserecord['semesterid']);
                                   }
                                 }

                                if ($admintype==0) {
                                  $k+=1;

                                  //Selecting based department involve
                                 $levelmethod=$schoolhelpDH->alldashedit('level', 'levelid', $fieldrecord['levelid']);
                                  if (is_array($levelmethod)) {
                                  foreach($levelmethod as $leveldata){
                                    $departmentidlevel=trim($leveldata['departmentid']);
                                  }
                                }

                                if ($logindepartmentid==$departmentid) {?>
                                
                                      <tr>
                                        <td><?php echo $k; ?></td>
                                        <td><input name="icourseid[]" id="<?php echo $fieldrecord['icourseid']; ?>" type="checkbox" class="status1 " onchange="if(this.checked){ this.value='<?php echo $fieldrecord['icourseid']; ?>'; } else{this.value='';} "  value="<?php echo $fieldrecord['icourseid']; ?>" /></td>
                                        <td><?php echo  $staffsurname ." ".$staffothername; ?></td>
                                        <td><?php echo  substr($coursename, 0, 12); ?></td>
                                       
                                        <td><?php echo  substr($departmentname,0, 12); ?></td>
                                        <td><?php echo  substr($levelname,0, 12); ?></td>
                                        <td><?php echo  substr($optionname,0, 12); ?></td>

                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['icourseid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['icourseid']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcdeletestaff('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['icourseid']; ?>','');"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
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
                             <?php 
                                    }
                                     } else{ $k+=1; ?>

                                        <tr>
                                        <td><?php echo $k; ?></td>
                                        <td><input name="icourseid[]" id="<?php echo $fieldrecord['icourseid']; ?>" type="checkbox" class="status1 " onchange="if(this.checked){ this.value='<?php echo $fieldrecord['icourseid']; ?>'; } else{this.value='';} "  value="<?php echo $fieldrecord['icourseid']; ?>" /></td>
                                        <td><?php echo  $staffsurname ." ".$staffothername; ?></td>
                                        <td><?php echo  substr($coursename, 0, 12); ?></td>
                                       
                                        <td><?php echo  substr($departmentname,0, 12); ?></td>
                                        <td><?php echo  substr($levelname,0, 12); ?></td>
                                        <td><?php echo  substr($optionname,0, 12); ?></td>
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['icourseid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['icourseid']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcdeletestaff('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['icourseid']; ?>','');"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
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

                                    <?php  }
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
                  <form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>&staffid=<?php echo $staffid; ?>" method="POST"  id="forminstitutionid"  class="form-horizontal form-label-left" >
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Staff<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         
                          <select  id="staffid" required="required" name="staffid" class="form-control col-md-7 col-xs-12" >
                            <option value="">--Select Staff--</option>
                            <?php
                             $records=$schoolhelpDH->alldash('staff', 'staffid', 'ASC');
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                           
                            ?>
                            <option value="<?php echo $fieldrecord['staffid']; ?>" <?php  if($staffid==$fieldrecord['staffid']){ ?> selected="selected" <?php } ?> ><?php echo $fieldrecord['surname']." " .$fieldrecord['othername']; ?></option>
                            <?php } 
                          }?>
                          </select>
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Select Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, element to append result, fieldid that will appear in the selection, fieldname that will appear in the selection)-->
                          <select  id="departmentid" required="required" name="departmentid" class="form-control col-md-7 col-xs-12" onchange="retrieveselectionmulti1('level', 'departmentid', this.value, 0, 0, 'retrieveselectionmulti1', 'retrieveselection1');">
                            <option value="">--Select Department--</option>
                            <?php
                            $deptrecord=$schoolhelpDH->alldash('department','did','asc');
                            foreach($deptrecord as $deptdata){
                            ?>
                            <option value="<?php echo $deptdata['did']; ?>"><?php echo $deptdata['deptname']; ?></option>
                            <?php } ?>
                          </select>


                        </div>
                      </div>
                      <!--Bring level selection button-->
                      <div id="retrieveselection1">
                      </div>
                       <!--Bring course selection button-->
                      <div id="retrieveselection2">
                      </div>
                      <!--Beginning of collection-->
                      <div  id="retrieveselection3">
                      </div>
                    </form>
                  </div>
                  </fieldset>
                 </div>
                 <?php } ?>

                  <?php 

                  if($page==3) {
                    $icourseid=trim(isset($_GET['id'])?$_GET['id']:false);
                    $record=$schoolhelpDH->alldashedit('instructorcourses', 'icourseid', $icourseid);
                    foreach($record as $recorddata){
                      $staffid=$recorddata['staffid'];
                      $departmentid=$recorddata['departmentid'];
                      $levelid=$recorddata['levelid'];
                      $optionid=$recorddata['optionid'];
                      $courseid=$recorddata['courseid'];

                    }
                    ?>
                    
                    <div class="x_panel">

                      <fieldset>
                        <legend style="color:#063">Edit <?php echo $pagename ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>&staffid=<?php echo $staffid; ?>" method="POST"  id="forminstitutionid"  class="form-horizontal form-label-left" >
                       <div class="form-group">
                        <input type="hidden" name="icourseid" id="icourseid" value="<?php echo $icourseid; ?>">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Staff<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         
                          <select  id="staffid" required="required" name="staffid" class="form-control col-md-7 col-xs-12" >
                            <option value="">--Select Staff--</option>
                            <?php
                             $records=$schoolhelpDH->alldash('staff', 'staffid', 'ASC');
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                           
                            ?>
                            <option value="<?php echo $fieldrecord['staffid']; ?>" <?php  if($staffid==$fieldrecord['staffid']){ ?> selected="selected" <?php } ?> ><?php echo $fieldrecord['surname']." " .$fieldrecord['othername']; ?></option>
                            <?php } 
                          }?>
                          </select>
                        </div>
                      </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Select Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, element to append result, fieldid that will appear in the selection, fieldname that will appear in the selection)-->
                          <select  id="departmentid" required="required" name="departmentid" class="form-control col-md-7 col-xs-12" onchange="retrieveselection1('level', 'departmentid', this.value, 0, 0, 'retrieveselection1', 'retrieveselection1');">
                            <option value="">--Select Department--</option>
                            <?php
                            $deptrecord=$schoolhelpDH->alldash('department','did','asc');
                            foreach($deptrecord as $deptdata){
                            ?>
                            <option value="<?php echo $deptdata['did']; ?>" <?php  if($departmentid==$deptdata['did']){ ?> selected="selected" <?php } ?>><?php echo $deptdata['deptname']; ?></option>
                            <?php } ?>
                          </select>


                        </div>
                      </div>
                      <!--Bring level selection button-->
                      <div id="retrieveselection1">
                        <?php 
                          $retrievedata=$schoolhelpDH->alldashedit('level', 'departmentid', $departmentid);
                          if (isset($retrievedata)) {
                          ?>   <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Level<span class="required">*</span>
                                   </label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                     <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
                                 <select  id="levelid" required="required" name="levelid" class="form-control col-md-6 col-xs-12" onchange="retrieveselection1('optiontable', 'levelid', this.value, 0, 0, 'retrieveselection2', 'retrieveselection2');">
                                   <option value="">--Select Level--</option>
                          <?php
                            foreach($retrievedata as $field){
                          ?>
                                <option value="<?php echo $field['levelid']; ?>" <?php  if($levelid==$field['levelid']){ ?> selected="selected" <?php } ?> ><?php echo $field['levelname']; ?></option>
                          <?php
                              }?>
                                </select>
                              </div>
                            </div>
                            <?php } ?>
                      </div>

                       <!--Bring course selection button-->
                      <div id="retrieveselection2">
                        <?php   $retrievedata=$schoolhelpDH->alldashedit('optiontable', 'levelid', $levelid);
                                if (isset($retrievedata)) { ?>
                        <div class="form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Option|Arm|Group<span class="required">*</span>
                             </label>
                             <div class="col-md-6 col-sm-6 col-xs-12">
                               <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
                           <select  id="optionid" required="required" name="optionid" class="form-control col-md-6 col-xs-12" onchange="retrieveselection3('course', 'optionid', this.value, 0, 0, 'retrieveselection3', 'retrieveselection3', 'subjcourse');">
                             <option value="">--Select Option|Arm|Group--</option>
                                <?php
                                  foreach($retrievedata as $fields){
                                ?>
                                      <option value="<?php echo $fields['optid']; ?>" <?php  if($optionid==$fields['optid']){ ?> selected="selected" <?php } ?> ><?php echo $fields['optname']; ?></option>
                                <?php
                                    }?>
                          </select>
                        </div>
                      </div>
                      <?php } ?>
                      </div>
                      <!--Beginning of collection-->

                      <div  id="retrieveselection3">

                                  <?php $retrievedata=$schoolhelpDH->alldashedit('course', 'optionid', $optionid);
                                  if (is_array($retrievedata)) {
                                 
                                  ?>   
                                    
                                    <div class="form-group">
                                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Courses/Subject<span class="required">*</span>
                                     </label>
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                       <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
                                   <select  id="courseid" required="required" name="courseid" class="form-control col-md-6 col-xs-12" onblur="return updatevalidity1('instructorcourses', 'courseid', 'optionid', this.value, $('#optionid').val(), 'updatig', $(this).attr('id'));">
                                     <option value="">--Courses/Subject--</option>
                            <?php
                              foreach($retrievedata as $field){
                                $semestername="";
                                $semesterid=trim($field['semesterid']);
                                $semestermethod=$schoolhelpDH->alldashedit('semesters', 'semesterid', $semesterid);
                                 foreach($semestermethod as $semester){
                                  $semestername=$semester['semestername'];
                                 }
                            ?>
                                  <option value="<?php echo $field['csid']; ?>" <?php  if($courseid==$field['csid']){ ?> selected="selected" <?php } ?> ><?php echo $field['csname']; ?></option>
                            <?php
                                }?>
                                  </select>
                                </div>
                              </div>
                                <div id="msg" ></div>
                                  <div class="ln_solid"></div>
                                  <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                      
                          <button class="btn btn-primary" type="reset">Reset</button>
                                      <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                          </div>
                          <?php  } ?>

                    </form>
                  </div>
                  </fieldset>
                 </div>
                <?php } ?>

                <?php if ($page==5) {
                  $icourseid=trim(isset($_GET['id'])?$_GET['id']:false);
                   $semesterid="";
                              
                              $coursename="";
                              $semestername="";
                              $levelname="";
                              $records=$schoolhelpDH->alldashedit('instructorcourses', 'icourseid', $icourseid);
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                 $operatorid=trim($fieldrecord['operatorid']);
                                $departmentid=trim($fieldrecord['departmentid']);
                                $levelid=trim($fieldrecord['levelid']);
                                $optionid=trim($fieldrecord['optionid']);
                                
                                $courseid=trim($fieldrecord['courseid']);
                                $staffid=trim($fieldrecord['staffid']);
                                $odatet=trim($fieldrecord['odate']);
                                $udate=trim($fieldrecord['udate']);

                               //Getting Admin Detials
                              
                                 $adminrecords=$schoolhelpDH->alldashedit('adminpersons', 'adminid', $operatorid);
                                 foreach($adminrecords as $adminrecord){
                                    $adminsurname=$adminrecord['surname'];
                                    $adminothername=$adminrecord['othername'];
                                 }

                              //collecting staff record
                             
                                 $staffrecords=$schoolhelpDH->alldashedit('staff', 'staffid', $staffid);
                                 foreach($staffrecords as $staffrecord){
                                    $staffsurname=$staffrecord['surname'];
                                    $staffothername=$staffrecord['othername'];
                                    $staffpassport=$staffrecord['passport'];
                                 }


                                  //collecting department record
                             
                                 $departmentrecords=$schoolhelpDH->alldashedit('department', 'did', $departmentid);
                                 foreach($departmentrecords as $departmentrecord){
                                    $departmentname=$departmentrecord['deptname']; 
                                 }

                              //collecting level record
                             
                             

                                   //collecting option record
                          
                                  $courserecords=$schoolhelpDH->alldashedit('course', 'csid', $courseid);
                                  if (is_array($courserecords)) {
                                 foreach($courserecords as $courserecord){
                                    $coursename=$courserecord['csname'];
                                    $semesterid=trim($courserecord['semesterid']);
                                   }
                                 }

                                //collecting semester record
                               
                                

                              }
                    
                    }
                    
                  ?>
                    <div class="x_panel" >
                  <div class="x_title">
                    <h3><?php echo $pagename; ?> Details </h3>
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
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $staffsurname. "  => ".$coursename ; ?>
                                          <small class="pull-right">Date: <?php echo $odate; ?></small>
                                      </h3>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                       
                       
                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col">
                         <img id="userimage" <?php if ($staffpassport!="") {?> style="display: block" src="images/uploads/staff/<?php echo $staffpassport ?>" <?php } ?> class="img img-responsive img-thumbnail" >
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
                          <center><p class="lead schoolhelpcolor"><b><?php echo $coursename; ?> Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Staff:</th>
                                  <td><?php echo $staffsurname; ?></td>
                                </tr>
                                  <tr>
                                  <th>Course</th>
                                  <td><?php echo $coursename; ?></td>
                                </tr>
                              
                                <tr>
                                  <th>Department:</th>
                                  <td><?php echo $departmentname; ?></td>
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