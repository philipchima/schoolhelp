
<?php 
include_once("includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHmessageinserts.php");
include_once("../phpclass/SHmessageupdate.php");
include_once("../phpclass/SHmessageOOP.php");
//include_once("../phpclass/schoolhelpOOP.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Student Messages";
confirmcheckin();

$odate=date("Y-m-d");
$admintype="";
$stuid="";

//Staff class
$tableinstructorcourses=new insertTable;
$schoolhelpDH=new classMessage;

$previlleges=$schoolhelpDH->allmessageedit('adminpersons', 'adminid', $schoolhelp);
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

$signatorydata=$schoolhelpDH->allmessageedit('signatoryposition', 'signatorypositionid', $signatorypositionid);
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


if ($page==2) {

  //collecting Variables

  $levelid=trim(isset($_POST["levelid"])?$_POST["levelid"]:false);
  $messagetitle=trim(isset($_POST["messagetitle"])?$_POST["messagetitle"]:false);
  $stumessage= trim(isset($_POST["stumessage"])?$_POST["stumessage"]:false);
  $odate=date("Y-m-d");
  
   // Getting the Department ID
                           
  $date = date("Y-m-d");
    
  $stuid=isset($_POST['studid'])?$_POST['studid']:false;
  
  //echo $bno = count(isset($_POST['studid'])?$_POST['studid']:false);
 if ($stuid!="") {

  $bulkno="";

  foreach($stuid as $i => $sdentid){

    if ($bulkno!="") {
      $bulkno.=', '.$sdentid;
    }else{
    $bulkno=trim($sdentid);
    }

 }
echo $bulkno; */

  //$tableinsert->insert_7fields('sentbulkmsg', 'departmentid', $departmentid, 'levelid',  $levelid, 'mesagetitle', $mesagetitle, ' messagecontent', $stumessage, ' phonenoinvolved', $bulkno,  'operatorid', $schoolhelp,  'odate', $odate);

echo "<script>
        window.location.href='https://www.smsmobile24.com/index.php?option=com_spc&comm=spc_api&username=swiftotech&password=schoolhelp&sender=@@JACLASON@@&recipient=@@$bulkno@@&message=@@//$stumessage@@&';
      </script>";
}


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
                      <li><a class="btn btn-primary" href="../?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                      <li><a class="btn btn-success " href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"> Message Home</i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                         <li  ><a href="?page=1&schoolhelp=<?php echo $schoolhelp; ?>"  ><i class="fa fa-plus"></i>Send Message to Student</a>
                      </li>
                          <li ><a  href="messaguardian?schoolhelp=<?php echo $schoolhelp; ?>&staffid=<?php echo $staffid; ?>&page=1"><i class="fa fa-book"></i>Send Message to Guardian</a>
                      </li>
                       <li ><a  href="messastaff?schoolhelp=<?php echo $schoolhelp; ?>&staffid=<?php echo $staffid; ?>&page=1"><i class="fa fa-book"></i>Send Message to Staff</a></li>
                        
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  View Student SMS Messages</a></li>
                          <li ><a  href="messaguardian?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  View Guardian SMS Messages</a></li>
                          <li ><a  href="messastaff?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  View Staff SMS Messages</a></li>


                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>&type=1"><i class="fa fa-book"></i>  View Student Email Messages</a></li>
                          <li ><a  href="messaguardian?schoolhelp=<?php echo $schoolhelp; ?>&type=1"><i class="fa fa-book"></i>  View Guardian Email Messages</a></li>
                          <li ><a  href="messastaff?schoolhelp=<?php echo $schoolhelp; ?>&type=1"><i class="fa fa-book"></i>  View Staff Email Messages</a></li>
                        </ul>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div style="color:#063" <?php if ($state=="failed") {?> style="color:red" <?php } ?> ><b><?php echo $sql; ?></b></div>
                   <div class="x_panel ">

                        <?php if ($stuid!=""){ ?>
                        <fieldset>
                          
                        <legend style="color:#063">Sent Bulk SMS</legend>

                         <iframe width="100%" style="width:100%;height:700;" height="700" frameborder="0" scrolling="auto" seamless="seamless" allowtransparency="true" src="https://www.smsmobile24.com/index.php?option=com_spc&comm=spc_api&username=swiftotech&password=schoolhelp&sender=@@JACLASON@@&recipient=@@<?php echo $bulkno; ?>@@&message=@@<?php echo $messagecontent; ?>@@&"></iframe>

                       </fieldset>
                       <?php } ?>
                     </div>

                  
                    <?php if ($page=="") {?>
                      <div class="x_panel ">

                      <fieldset>
                        <legend style="color:#063"><?php echo $pagename ?> Record</legend>

                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Staff</th>
                          <th>Course</th>
                        
                          <th>Department</th>
                          <th>Level</th>
                          <th>Option</th>
                          <th style="width:10%;"><i class="far fa-address-card" style="color:green"></i> Print</th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:red"></i> Edit</th>
                          <th><i class="fa fa-trash" style="color:red"></i> Delete</th>
                          
                          
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
                              
                              $records=$schoolhelpDH->allmessage('instructorcourses', 'staffid', 'ASC');
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
                                 $adminrecords=$schoolhelpDH->allmessageedit('adminpersons', 'adminid', $operatorid);
                                 if (is_array($adminrecords)) {
                                 foreach($adminrecords as $adminrecord){
                                    $adminsurname=$adminrecord['surname'];
                                    $adminothername=$adminrecord['othername'];
                                 }
                                }
                              //collecting staff record
                             
                                 $staffrecords=$schoolhelpDH->allmessageedit('staff', 'staffid', $staffid);
                                 if (is_array($staffrecords)) {
                                    foreach($staffrecords as $staffrecord){
                                    $staffsurname=$staffrecord['surname'];
                                    $staffothername=$staffrecord['othername'];
                                  }
                                 }
                                


                                  //collecting department record
                              //$deptmethod=$deptclass->departmentedit('did', $fieldvalue1);
                              //$deptname=$deptmethod['deptname'];
                                 $departmentrecords=$schoolhelpDH->allmessageedit('department', 'did', $departmentid);
                                   if (is_array($departmentrecords)) {
                                 foreach($departmentrecords as $departmentrecord){
                                    $departmentname=$departmentrecord['deptname']; 
                                 }
                               }


                                   //collecting option record
                             // $optionmethod=$optionclass->optionedit('optid', $fieldvalue3);
                              //$optionname=$optionmethod['optname'];
                                  $courserecords=$schoolhelpDH->allmessageedit('course', 'csid', $courseid);
                                  if (is_array($courserecords)) {
                                 foreach($courserecords as $courserecord){
                                    $coursename=$courserecord['csname'];
                                    $semesterid=trim($courserecord['semesterid']);
                                   }
                                 }

                                  $levelrecords=$schoolhelpDH->allmessageedit('level', 'levelid', $levelid);
                                  if (is_array($levelrecords)) {
                                 foreach($levelrecords as $levelrecord){
                                    $levelname=$levelrecord['levelname'];
                                   }

                                }

                              //collecting option record
                             // $optionmethod=$optionclass->optionedit('optid', $fieldvalue3);
                              //$optionname=$optionmethod['optname'];
                                    $optionrecords=$schoolhelpDH->allmessageedit('optiontable', 'optid', $optionid);
                                     if (is_array($optionrecords)) {
                                 foreach($optionrecords as $optionrecord){
                                    $optionname=$optionrecord['optname'];
                                   }
                                 }


                              if ($admintype==0) {
                                  $k+=1;

                                  

                                if ($departmentid==$logindepartmentid) {?>
                                
                                      <tr data-toggle="tooltip" data-placement="top"  required="required" data-html="true" title="<em> <ul >
                                            <li ><span>Update by</span> : <?php echo  $adminsurname. " ".$adminothername ; ?></li>
                                            <li><span>Upate Date</span> : <?php echo  $fieldrecord['udate']; ?></li>
                                            <li><span>Initial Date</span> : <?php echo  $fieldrecord['odate']; ?></li>
                                            
                                          </ul></em>">
                                        <td><?php echo $k; ?></td>
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

                                        <tr data-toggle="tooltip" data-placement="top"  required="required" data-html="true" title="<em> <ul >
                                            <li ><span>Update by</span> : <?php echo  $adminsurname. " ".$adminothername ; ?></li>
                                            <li><span>Upate Date</span> : <?php echo  $fieldrecord['udate']; ?></li>
                                            <li><span>Initial Date</span> : <?php echo  $fieldrecord['odate']; ?></li>
                                            
                                          </ul></em>">
                                        <td><?php echo $k; ?></td>
                                        <td><?php echo  $staffsurname ." ".$staffothername; ?></td>
                                        <td><?php echo  substr($coursename, 0, 12); ?></td>
                                       
                                        <td><?php echo  substr($departmentname,0, 12); ?></td>
                                        <td><?php echo  substr($levelname,0, 12); ?></td>
                                        <td><?php echo  substr($optionname,0, 12); ?></td>
                                       
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['icourseid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['icourseid']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcdeletestaff('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['icourseid']; ?>','');"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
                                         
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
                       
                    <input type="hidden" value="<?php echo $admintype; ?>" name="admintype">
                     
                      <!--Bring level selection button-->
                      <div class="form-group">
                        <label for="level" class="control-label col-md-3 col-sm-3 col-xs-12">Level|Class</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="levelid" id="levelid" class="form-control col-md-7 col-xs-12"  onchange="retrievemultistudent('students', 'levelid', this.value, '<?php echo $admintype; ?>', '<?php echo $logindepartmentid; ?>', 'retrievemultistudent', 'retrievemultistudent');" required="required">
                             <option>--Select Level|Class--</option>
                             <option value="10000">All Level/Class</option>
                            <?php 
                            $record=$schoolhelpDH->allmessage('level', 'levelid', 'ASC');
                            if (is_array($record)) {
                            foreach($record as $records){
                              $did=trim($records['departmentid']);
                              $record1=$schoolhelpDH->allmessageedit('department', 'did', $did);
                              if (is_array($record1)) {
                              foreach($record1 as $record1s){
                                $deptname=$record1s['deptname'];
                              }
                            }

                          if ($admintype==0) { ?>
                             
                           <?php  if ($logindepartmentid==$did) {
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
                       <!--Bring course selection button-->
                      <div id="retrievemultistudent">
                      </div>
                      
                    </form>
                  </div>
                  </fieldset>
                 </div>
                 <?php } ?>

                  <?php 

                  if($page==3) {
                    $icourseid=trim(isset($_GET['id'])?$_GET['id']:false);
                    $record=$schoolhelpDH->allmessageedit('instructorcourses', 'icourseid', $icourseid);
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
                             $records=$schoolhelpDH->allmessage('staff', 'staffid', 'ASC');
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
                            $deptrecord=$schoolhelpDH->allmessage('department','did','asc');
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
                          $retrievedata=$schoolhelpDH->allmessageedit('level', 'departmentid', $departmentid);
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
                        <?php   $retrievedata=$schoolhelpDH->allmessageedit('optiontable', 'levelid', $levelid);
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

                                  <?php $retrievedata=$schoolhelpDH->allmessageedit('course', 'optionid', $optionid);
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
                                $semestermethod=$schoolhelpDH->allmessageedit('semesters', 'semesterid', $semesterid);
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
                              $records=$schoolhelpDH->allmessageedit('instructorcourses', 'icourseid', $icourseid);
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
                              
                                 $adminrecords=$schoolhelpDH->allmessageedit('adminpersons', 'adminid', $operatorid);
                                 foreach($adminrecords as $adminrecord){
                                    $adminsurname=$adminrecord['surname'];
                                    $adminothername=$adminrecord['othername'];
                                 }

                              //collecting staff record
                             
                                 $staffrecords=$schoolhelpDH->allmessageedit('staff', 'staffid', $staffid);
                                 foreach($staffrecords as $staffrecord){
                                    $staffsurname=$staffrecord['surname'];
                                    $staffothername=$staffrecord['othername'];
                                    $staffpassport=$staffrecord['passport'];
                                 }


                                  //collecting department record
                             
                                 $departmentrecords=$schoolhelpDH->allmessageedit('department', 'did', $departmentid);
                                 foreach($departmentrecords as $departmentrecord){
                                    $departmentname=$departmentrecord['deptname']; 
                                 }

                              //collecting level record
                             
                             

                                   //collecting option record
                          
                                  $courserecords=$schoolhelpDH->allmessageedit('course', 'csid', $courseid);
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