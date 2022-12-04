
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/schoolhelpinserts.php");
include_once("../phpclass/schoolhelpupdate.php");
include_once("../phpclass/schoolhelpdelete.php");
include_once("../phpclass/schoolhelpOOP.php");
include_once("../phpclass/schoolhelpothers.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Admin Person";
confirmcheckin();
$xdate=date("Y-m-d");

$schoolhelpDH=new Allsettings;
$schoolhelpDH1=new Others;
$tableUpdate=new updateTable;
// Checking page access Authenticity

$previllages=$schoolhelpDH->allsettingedit('adminpersons', 'adminid', $schoolhelp);
foreach($previllages as $actualrecord){
  $pageaccess=trim($actualrecord['adminperson_s']);
  $settingedit_s=trim($actualrecord['settingedit_s']);
  $settingdelete_s=trim($actualrecord['settingdelete_s']);
  $settingadd_s=trim($actualrecord['settingadd_s']);
}
if ($pageaccess!=1) {
  echo "<b style='font-size:100; color:red'>Criminal Attempt Made, contact the admin ask for the access of this page</b>";
  exit();
}

$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);


if($page==2) {

 //Getting array of records
 $staffid=trim(isset($_POST['staffid'])?$_POST['staffid']:false);
 
 $signatorypositionid=trim(isset($_POST['signatorypositionid'])?$_POST['signatorypositionid']:false);
$surname=ucwords(trim(isset($_POST['surname'])?$_POST['surname']:false));
$othername=ucwords(trim(isset($_POST['othername'])?$_POST['othername']:false));

 $username=trim(isset($_POST['username'])?$_POST['username']:false);
 $password="schoolhelp";
 $password=$schoolhelpDH1->passwordconvert($password);
 $sdate=date("Y-m-d H:m:s");
 $tableDepartment=new insertTable;
 $state=$tableDepartment->insert_adminperson($staffid, $signatorypositionid, $surname, $othername, $username, $password, $schoolhelp, $sdate, $xdate);
 $display=$state['action'];
 $insertedrow=$state['counting'];
            
 $sql=$display.":: Insertion, affected records = ".$insertedrow;

 echo "<script>
          window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
       </script>";
}

if($page==4) {

   $staffid=trim(isset($_POST['staffid'])?$_POST['staffid']:false);
 $adminid=trim(isset($_POST['adminid'])?$_POST['adminid']:false);
 $signatorypositionid=trim(isset($_POST['signatorypositionid'])?$_POST['signatorypositionid']:false);
$surname=ucwords(trim(isset($_POST['surname'])?$_POST['surname']:false));
$othername=ucwords(trim(isset($_POST['othername'])?$_POST['othername']:false));
$username=trim(isset($_POST['username'])?$_POST['username']:false);
 $password="schoolhelp";
 $password=$schoolhelpDH1->passwordconvert($password);
 $sdate=date("Y-m-d H:m:s");

          

              
              $state=$tableUpdate->update_adminperson($staffid, $signatorypositionid, $surname, $othername, $username, $password, $schoolhelp, $sdate, $adminid);
             $sql=$state.":: Update Made, affected records = 1";
         
                    echo "<script>
                      window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
                    </script>";
      
}

if ($page==6) {
  $adminid=trim(isset($_GET['id'])?$_GET['id']:false);
   
   $schoolhelpDHd= new TblDeleterow;
    $state=$schoolhelpDHd->delete_setting('adminpersons', 'adminid', $adminid);

        $sql=$state.":: Deletion Made, affected records = 1";
        echo "<script>
                window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
              </script>";
    
}

if ($page==9) {
    $adminid=trim(isset($_GET['id'])?$_GET['id']:false);
    $password=Others::passwordconvert("schoolhelp");
    $sdate=date("Y-m-d H:m:s");
    $state= $tableUpdate->passwordreset('adminpersons', 'adminid', $adminid, $password, $schoolhelp, $sdate);
    $sql="";
     if($state=="Success"){
      $sql=$state.":: Password Reset Made, affected records = 1; this Admin Password is now schoolhelp";
     }

     header("location:?schoolhelp=$schoolhelp&sql=$sql");
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
                    <h2 id="caption"><?php echo $pagename ?></h2>
                    <ul class="nav navbar-right panel_toolbox" style="">
                      <li><a class="btn btn-primary" href="../?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                      <li><a class="btn btn-success " href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"> Settings</i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                         <li  ><a href="?page=1&schoolhelp=<?php echo $schoolhelp; ?>"  ><i class="fa fa-plus"></i>  Add <?php echo $pagename; ?></a>
                      </li>
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  View <?php echo $pagename; ?></a>
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
                        <legend style="color:#063"><?php echo $pagename; ?> Record</legend>

                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Staff</th>
                          <th>Position</th>
                          <th>Department</th>
                          <th>Username</th>
                          <th>Password</th>                        
                          <th style="width:10%;"><i class="far fa-address-card" style="color:green"></i>Priveleges/Print</th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:red"></i> Edit</th>
                          

                          <th style="width:10%;"><i class="fa fa-trash" style="color:red"></i> Delete</th>
                          <th>User<i class="fa fa-user"></i></th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                              
                              $records=$schoolhelpDH->allsetting('adminpersons', 'adminid', 'ASC');
                             $staffsurname="";
                              $staffothername="";
                               $departmentid="";
                               $departmentname="";
                                 $positionname="";
                                 
                              if (is_array($records)) {
                                $adminrecord=new Adminperson;
                              foreach($records as $fieldrecord){
                                $k+=1;
                                $staffid="";
                                 $staffid=trim($fieldrecord['staffid']);
                                 $signatorypositionid=$fieldrecord['signatorypositionid'];
                                  //collecting department record
                             
                                 $signatoryrecords=$schoolhelpDH->allsettingedit('signatoryposition', 'signatorypositionid', $signatorypositionid);
                                 if (is_array($signatoryrecords)) {
                                 foreach($signatoryrecords as $signatoryrecord){
                                    $positionname=$signatoryrecord['positionname']; 
                                    $departmentid=$signatoryrecord['departmentid']; 
                                 }
                               }
                                 
                                 //collecting staff record
                             
                                 $staffrecords=$schoolhelpDH->allsettingedit('staff', 'staffid', $staffid);
                                   if (is_array($staffrecords)) {
                                     foreach($staffrecords as $staffrecord){
                                      $staffsurname=$staffrecord['surname'];
                                      $staffothername=$staffrecord['othername'];
                                   }
                                 }

                               
                                  //collecting department record
                             
                                 $departmentrecords=$schoolhelpDH->allsettingedit('department', 'did', $departmentid);
                                 if (is_array($departmentrecords)) {
                                 foreach($departmentrecords as $departmentrecord){
                                    $departmentname=$departmentrecord['deptname']; 
                                 }
                               }

                              
                             

                                $fieldvalue=trim($fieldrecord['operatorid']);
                                $admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
                                ?>
                                      <tr>
                                        <td><?php echo $k; ?></td>
                                        <td style="width:8%"><?php if ($fieldrecord['admintype']==1) { echo "<b class='schoolhelp'>Main Admin</b>"; }else{ ?><?php echo  substr($staffsurname.' '.$staffothername, 0, 15); } ?></td>
                                        <td><?php echo  substr($positionname, 0, 15); ?></td>
                                        
                                        <td><?php echo  substr($departmentname,0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['username'],0, 12); ?></td>
                                        <td>
                                            <button  class="btn btn-primary" type="button" onclick="funcresetpassword('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['adminid']; ?>');">Reset
                                          </button>
                                          
                                        </td>
                                       

                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['adminid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['adminid']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
                                        
                                        <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['adminid']; ?>','');"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
                                           <td ><span class="btn-group">
                                            <center><button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-user"></i> Details<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu">
                                            <li ><span>Update by</span> : <?php echo  $admindata['surname']. " ".$admindata['othername'] ; ?></li>
                                            <li><span>Upate Date</span> : <?php echo  $fieldrecord['sdate']; ?></li>
                                            <li><span>Initial Date</span> : <?php echo  $fieldrecord['xdate']; ?></li>
                                            <li class="schoolhelp"><b>Login Status</b></li>
                                            <li><span>login Date</span> : <?php echo  $fieldrecord['logintime']; ?></li>
                                            <li><span>logout Date</span> : <?php echo  $fieldrecord['logouttime']; ?></li>
                                          </ul>
                                          </center></span>

                                        </td>
                                      </tr>
                             <?php }
                              }
                             ?>
                        
                      </tbody>
                    </table>
                   </fieldset>
                    </div>
                    <?php } ?>

                    <?php if($page==1) {?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Add <?php echo $pagename; ?></legend>
                  <form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="adminpersons"  class="form-horizontal form-label-left" >

                    
                          <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Department<span class="required">*</span>
                                </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                       <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
                                   <select  name="signatorypositionid" id="signatorypositionid" required="required"  class="form-control col-md-6 col-xs-12" onchange="retrieveselection1('signatoryposition', 'signatorypositionid', this.value, 0, 0, 'adminperson', 'adminperson');" >
                                          <option value="">--Select Admin Position--</option>
                                   <?php
                                   $departmentname="";
                                      $retrievedata=$schoolhelpDH->allsetting('signatoryposition', 'signatorypositionid', 'ASC');
                                      if (isset($retrievedata)) {
                                           foreach($retrievedata as $field){
                                            $departmentid=$field['departmentid'];
                                              $retrievedata1=$schoolhelpDH->allsettingedit('department', 'did', $departmentid);
                                        if (isset($retrievedata1)) {
                                           foreach($retrievedata1 as $field1){
                                            $departmentname=$field1['deptname'];
                                           }
                                           }
                                              
                                            ?>
                                            <option value="<?php echo $field['signatorypositionid']; ?>"><?php echo $field['positionname'].' => '.$departmentname; ?></option>
                                      <?php
                                          }
                                        }?>
                                          </select>
                                       </div>
                                  </div>
                                  
                                  <fieldset>
                                    <legend>Personal Details</legend>
                                  <div id="adminperson">
                                    <input id="staffid" class="form-control col-md-7 col-xs-12" type="hidden" name="staffid"  required="required">
                                 <div class="form-group">
                                    <label for="surname" class="control-label col-md-3 col-sm-3 col-xs-12">Surname<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input name="surname" id="surname" class="form-control col-md-7 col-xs-12" type="text"  disabled="disabled" placeholder="fill me by selecting Admin position" required="required">
                                    </div>
                                  </div>

                                    <div class="form-group">
                                    <label for="positiondesc" class="control-label col-md-3 col-sm-3 col-xs-12">Othername</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input name="othername" id="othername" type="text" class="form-control col-md-7 col-xs-12" disabled="disabled" placeholder="fill me by selecting Admin position">
                                    </div>
                                  </div>
                                  </div>

                                   <div class="form-group">
                                    <label for="username" class="control-label col-md-3 col-sm-3 col-xs-12">Username<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input id="username" class="form-control col-md-7 col-xs-12" type="text" name="username"  placeholder="Please Enter Username" required="required" onblur="return updatevalidity('adminperson', 'username', this.value, 'inserting', $(this).attr('id'));">
                                    </div>
                                  </div>
                                  

                                  
                                  </fieldset>
                                  

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

                  <?php if($page==3) {
                    $adminid=trim(isset($_GET['id'])?$_GET['id']:false);
                     $records=$schoolhelpDH->allsettingedit('adminpersons', 'adminid', $adminid);
                             
                              if (is_array($records)) {
                                $adminrecord=new Adminperson;
                              foreach($records as $fieldrecord){
                                $departmentid="";
                                 $staffid="";
                                $signatorypositionid=$fieldrecord['signatorypositionid'];
                                  //collecting department record
                             
                                 $signatoryrecords=$schoolhelpDH->allsettingedit('signatoryposition', 'signatorypositionid', $signatorypositionid);
                                 if (is_array($signatoryrecords)) {
                                 foreach($signatoryrecords as $signatoryrecord){
                                    $positionname=$signatoryrecord['positionname']; 
                                    $departmentid=$signatoryrecord['departmentid']; 
                                    $staffid=$signatoryrecord['staffid'];
                                 }
                               }
                                 
                                 //collecting staff record
                             
                                 $staffrecords=$schoolhelpDH->allsettingedit('staff', 'staffid', $staffid);
                                   if (is_array($staffrecords)) {
                                     foreach($staffrecords as $staffrecord){
                                      $staffsurname=$staffrecord['surname'];
                                      $staffothername=$staffrecord['othername'];
                                   }
                                 }

                               
                                  //collecting department record
                             
                                 $departmentrecords=$schoolhelpDH->allsettingedit('department', 'did', $departmentid);
                                 if (is_array($departmentrecords)) {
                                 foreach($departmentrecords as $departmentrecord){
                                    $departmentname=$departmentrecord['deptname']; 
                                 }
                               }

                              
                             

                                $fieldvalue=trim($fieldrecord['operatorid']);
                                $admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
                   
                    ?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Edit <?php echo $pagename; ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="adminpersons"  class="form-horizontal form-label-left" >
                      <input type="hidden" name="adminid" value="<?php echo $adminid; ?>">
                      
                       <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Department<span class="required">*</span>
                                </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                       <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
                                   <select  name="signatorypositionid" id="signatorypositionid" required="required"  class="form-control col-md-6 col-xs-12" onchange="retrieveselection('signatoryposition', 'signatorypositionid', this.value, 0, 0, 'adminperson', 'adminperson');" <?php if($fieldrecord['adminid']==1) { ?> disabled="disabled"<?php } ?> >
                                          <option value="">--Select Admin Position--</option>
                                   <?php
                                   $departmentname="";
                                      $retrievedata=$schoolhelpDH->allsetting('signatoryposition', 'signatorypositionid', 'ASC');
                                      if (isset($retrievedata)) {
                                           foreach($retrievedata as $field){
                                            $departmentid=$field['departmentid'];
                                              $retrievedata1=$schoolhelpDH->allsettingedit('department', 'did', $departmentid);
                                        if (isset($retrievedata1)) {
                                           foreach($retrievedata1 as $field1){
                                            $departmentname=$field1['deptname'];
                                           }
                                           }
                                              
                                            ?>
                                            <option value="<?php echo $field['signatorypositionid']; ?>" <?php if ($field['signatorypositionid']==$signatorypositionid) {?> selected="selected"<?php } ?> ><?php echo $field['positionname'].' => '.$departmentname; ?></option>
                                            <?php if ($field['signatorypositionid']==0) { ?>
                                            <option value="0" <?php if ($field['signatorypositionid']==$signatorypositionid) {?> selected="selected"<?php } ?> >Main Admin</option>
                                            <?php } ?>
                                      <?php
                                          }
                                        }?>
                                          </select>
                                       </div>
                                  </div>
                                  
                                  <fieldset>
                                    <legend>Personal Details</legend>
                                  <div id="adminperson">
                                    <input id="staffid" class="form-control col-md-7 col-xs-12" type="hidden" name="staffid"  required="required" value="<?php echo $fieldrecord['staffid']; ?>">
                                 <div class="form-group">
                                    <label for="surname" class="control-label col-md-3 col-sm-3 col-xs-12">Surname<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input name="surname" id="surname" class="form-control col-md-7 col-xs-12" type="text"   placeholder="fill me by selecting Admin position" required="required" value="<?php echo $fieldrecord['surname']; ?>">
                                    </div>
                                  </div>

                                    <div class="form-group">
                                    <label for="positiondesc" class="control-label col-md-3 col-sm-3 col-xs-12">Othername</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input name="othername" id="othername" value="<?php echo $fieldrecord['othername']; ?>" type="text" class="form-control col-md-7 col-xs-12" placeholder="fill me by selecting Admin position">
                                    </div>
                                  </div>
                                  </div>

                                   <div class="form-group">
                                    <label for="username" class="control-label col-md-3 col-sm-3 col-xs-12">Username<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input id="username" class="form-control col-md-7 col-xs-12" type="text" name="username" value="<?php echo $fieldrecord['username']; ?>"  placeholder="Please Enter Username" required="required" onblur="return updatevalidity('adminperson', 'username', this.value, 'updating', $(this).attr('id'));">
                                    </div>
                                  </div>
                                  

                                  
                                  </fieldset>
                                  

                                   <div class="form-group">
                                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        
                                        <button class="btn btn-primary" type="reset">Reset</button>
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                  </div>

                                

              
                    </form>
                  </div>
                  </fieldset>
                 </div>
                <?php }
                }
              } ?>

                <?php if ($page==5) {
                  $sdate=date("Y-m-d H:m:s");
                  $adminid=trim(isset($_GET['id'])?$_GET['id']:false);
                   $staffsurname="";
                  $staffothername="";
                  $positionname="";
                  $departmentid="";
                   $departmentname="";
                    $records=$schoolhelpDH->allsettingedit('adminpersons', 'adminid', $adminid);
                             
                              if (is_array($records)) {
                                $adminrecord=new Adminperson;
                              foreach($records as $fieldrecord){
                                
                                 $staffid=$fieldrecord['staffid'];
                                 $signatorypositionid=$fieldrecord['signatorypositionid'];
                                 $admintype=$fieldrecord['admintype'];
                                  //collecting department record
                             
                                 $signatoryrecords=$schoolhelpDH->allsettingedit('signatoryposition', 'signatorypositionid', $signatorypositionid);
                                 if (is_array($signatoryrecords)) {
                                 foreach($signatoryrecords as $signatoryrecord){
                                    $positionname=$signatoryrecord['positionname']; 
                                    $departmentid=$signatoryrecord['departmentid']; 
                                    $staffid=$signatoryrecord['staffid'];
                                 }
                               }
                                 
                                 

                               
                                  //collecting department record
                             
                                 $departmentrecords=$schoolhelpDH->allsettingedit('department', 'did', $departmentid);
                                 if (is_array($departmentrecords)) {
                                 foreach($departmentrecords as $departmentrecord){
                                    $departmentname=$departmentrecord['deptname']; 
                                 }
                               }

                                           //Instition Record
                                 $datas1=new classInstitution;
                                $record1=$datas1->institution();

                                foreach($record1 as $recordinstitution){
                                  $instilogo=trim($recordinstitution['instilogo']);
                                }

                                $location="../images/uploads/staff/";

                                if ($admintype==1) {
                                  $passport=$instilogo;
                                  $location="../images/logo/";
                                  $staffsurname=$fieldrecord['surname'];
                                      $staffothername=$fieldrecord['othername'];
                                }else{
                                  //collecting staff record
                             
                                 $staffrecords=$schoolhelpDH->allsettingedit('staff', 'staffid', $staffid);
                                   if (is_array($staffrecords)) {
                                     foreach($staffrecords as $staffrecord){
                                      $staffsurname=$staffrecord['surname'];
                                      $staffothername=$staffrecord['othername'];
                                      $passport=trim($staffrecord['passport']);
                                   }
                                 }
                                }
                                $fieldvalue=trim($fieldrecord['operatorid']);
                                $admindata=$adminrecord->adminpersons('adminid', $fieldvalue);

                  ?>
                    <div class="x_panel" >
                  <div class="x_title">
                    <h2><?php echo $pagename; ?> Details </h2>
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
                          <h1>
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $staffsurname.' '.$staffothername.' => '.$positionname; ?>
                                          <small class="pull-right">Date: <?php echo $xdate; ?></small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                       
                       
                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col">
                         <img id="userimage" <?php if ($passport!="") {?> style="display: block" src="<?php echo $location.$passport ?>" <?php } ?> class="img img-responsive img-thumbnail" >
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col" align="right">
                          <h4><b>Admin Details:</b></h4>
                          <address>
                                          Updated by: <strong><?php echo $admindata['surname'] ." ".$admindata['othername']; ?></strong>
                                          <br><b>Date: </b><?php echo $fieldrecord['sdate']; ?></strong>
                                          <br><b>Initial Insertion Date: </b><?php echo $fieldrecord['xdate']; ?>
                                          
                                      </address>
                        </div>

                      
                      </div>
                      <!-- /.row -->


                   

                      <div class="row">
                       
                        <div class="col-xs-12">
                          <hr>
                          <center><p class="lead schoolhelpcolor"><b><?php echo $staffsurname.' '.$staffothername.' => '.$positionname; ?> Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>

                               
                               
                                <tr>
                                  <th style="width:50%">Staff:</th>
                                  <td><?php echo $staffsurname.' '.$staffothername; ?></td>
                                </tr>
                                <tr>
                                  <th>Department:</th>
                                  <td><?php echo $departmentname; ?></td>
                                </tr>
                                  <tr>
                                  <th>Position:</th>
                                  <td><?php echo $positionname; ?></td>
                                </tr>
                                <tr>
                                  <th>Username:</th>
                                  <td><?php echo $fieldrecord['username']; ?></td>
                                </tr>

                              
                              </tbody>
                            </table>
                          </div>
                          <div class="col-xs-12">
                          <fieldset>
                            <legend class="schoolhelp"><h1>Admin Previlleges</h1></legend>
                            <div class="row">
                              <div class="col-xs-12 table">
                                   <fieldset>
                                  <legend class="schoolhelp">Settings</legend>
                                  <table class="table-responsive">
                                    <tr>
                                      <td style="width:10%">
                                      <label><input name="settings" type="checkbox" id="settings" value="<?php echo $fieldrecord['settings']; ?>"  <?php if ($fieldrecord['settings']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')">Settings</label>
                                    </td>
                                    <td style="width:10%">
                                      <label><input name="institution_s" type="checkbox" id="institution_s" value="<?php echo $fieldrecord['institution_s']; ?>"  <?php if ($fieldrecord['institution_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')">Institution</label>
                                    </td>
                                     <td style="width:10%">
                                      <label><input type="checkbox" id="department_s" name="department_s" value="<?php echo $fieldrecord['department_s']; ?>"  <?php if ($fieldrecord['department_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Department</label>
                                    </td>
                                    <td style="width:10%">
                                      <label><input type="checkbox" id="semester_s" name="semester_s" value="<?php echo $fieldrecord['semester_s']; ?>"  <?php if ($fieldrecord['semester_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Semester</label>
                                    </td>
                                     <td style="width:10%">
                                      <label><input type="checkbox" id="level_s" name="level_s" value="<?php echo $fieldrecord['level_s']; ?>"  <?php if ($fieldrecord['level_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Level/Class</label>
                                    </td>
                                    <td style="width:10%">
                                      <label><input type="checkbox" id="option_s" name="option_s" value="<?php echo $fieldrecord['option_s']; ?>"  <?php if ($fieldrecord['option_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Option</label>
                                    </td>
                                    <td style="width:10%">
                                      <label><input type="checkbox" id="course_s" name="course_s" value="<?php echo $fieldrecord['course_s']; ?>"  <?php if ($fieldrecord['course_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Course</label>
                                    </td>
                                    <td style="width:10%">
                                      <label><input type="checkbox" id="title_s" name="title_s"  value="<?php echo $fieldrecord['title_s']; ?>"  <?php if ($fieldrecord['title_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Title</label>
                                    </td>
                                    <td style="width:15%">
                                      <label><input type="checkbox" id="qualification_s" name="qualification_s" value="<?php echo $fieldrecord['qualification_s']; ?>"  <?php if ($fieldrecord['qualification_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Qualification</label>
                                    </td>

                                     <td style="width:10%">
                                      <label><input type="checkbox" id="grade_s" name="grade_s" value="<?php echo $fieldrecord['grade_s']; ?>"  <?php if ($fieldrecord['grade_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Grade</label>
                                    </td>
                                    <td style="width:10%">
                                      <label><input type="checkbox" id="assessment_s" name="assessment_s" value="<?php echo $fieldrecord['assessment_s']; ?>"  <?php if ($fieldrecord['assessment_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Assessment</label>
                                    </td>

                                    <td style="width:10%">
                                      <label><input type="checkbox" id="passmark_s" name="passmark_s" value="<?php echo $fieldrecord['passmark_s']; ?>"  <?php if ($fieldrecord['passmark_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Passmark</label>
                                    </td>

                                   

                                  </tr>
                                  <tr>      
                                    <td style="width:10%">
                                      <label><input type="checkbox" id="activation_s" name="activation_s" value="<?php echo $fieldrecord['activation_s']; ?>"  <?php if ($fieldrecord['activation_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Activation</label>
                                    </td>
                                                
                                    <td style="width:10%">
                                      <label><input type="checkbox" id="session_s" name="session_s" value="<?php echo $fieldrecord['session_s']; ?>"  <?php if ($fieldrecord['session_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Session</label>
                                    </td>
                                     <td style="width:10%">
                                      <label><input type="checkbox" id="housedivision_s" name="housedivision_s" value="<?php echo $fieldrecord['housedivision_s']; ?>"  <?php if ($fieldrecord['housedivision_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >House/Division</label>
                                    </td>
                                    <td style="width:10%">
                                      <label><input type="checkbox" id="signatoryposition_s" name="signatoryposition_s" value="<?php echo $fieldrecord['signatoryposition_s']; ?>"  <?php if ($fieldrecord['adminperson_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Signatory Position</label>
                                    </td>
                                     <td style="width:10%">
                                      <label><input type="checkbox" id="adminperson_s" name="adminperson_s" value="<?php echo $fieldrecord['adminperson_s']; ?>"  <?php if ($fieldrecord['adminperson_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Admin Person</label>
                                    </td>
                                     
                                     <td style="width:10%">
                                      <label><input type="checkbox" id="signatorycomment_s" name="signatorycomment_s" value="<?php echo $fieldrecord['signatorycomment_s']; ?>"  <?php if ($fieldrecord['signatorycomment_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Comment</label>
                                    </td>
                                    
                                     <td style="width:10%">
                                      <label><input type="checkbox" id="domain_s" name="domain_s" value="<?php echo $fieldrecord['domain_s']; ?>"  <?php if ($fieldrecord['domain_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Domain</label>
                                    </td>
                                     <td style="width:10%">
                                      <label><input type="checkbox" id="pin_s" name="pin_s" value="<?php echo $fieldrecord['pin_s']; ?>"  <?php if ($fieldrecord['pin_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Pincode</label>
                                    </td>
                                     <td style="width:10%">
                                      <label><input type="checkbox" id="backup_s" name="backup_s" value="<?php echo $fieldrecord['backup_s']; ?>"  <?php if ($fieldrecord['backup_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Back Up</label>
                                    </td>
                                   
                                     <td style="width:10%">
                                      <label><input type="checkbox" id="settingadd_s" name="settingadd_s" value="<?php echo $fieldrecord['settingadd_s']; ?>"  <?php if ($fieldrecord['settingadd_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Access Add Record</label>
                                    </td>
                                     <td style="width:10%">
                                      <label><input type="checkbox" id="settingedit_s" name="settingedit_s" value="<?php echo $fieldrecord['settingedit_s']; ?>"  <?php if ($fieldrecord['settingedit_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Access Edit</label>
                                    </td>

                                     <td style="width:10%">
                                      <label><input type="checkbox" id="settingdelete_s" name="settingdelete_s" value="<?php echo $fieldrecord['settingdelete_s']; ?>"  <?php if ($fieldrecord['settingdelete_s']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Access Delete</label>
                                    </td>
                                   
                                  </tr>
                                </table>
                                    
                                    
                                    
                                  </fieldset>
                                  <p>
                                  <fieldset>
                                  <legend class="schoolhelp">Dashboard</legend>
                                  <table class="table-responsive">
                                    <tr>
                                      <td style="width:10%">
                                      <label><input name="student_d" type="checkbox" id="student_d" value="<?php echo $fieldrecord['student_d']; ?>"  <?php if ($fieldrecord['student_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')">Student</label>
                                    </td>

                                    <td style="width:10%">
                                      <label><input type="checkbox" id="staff_d" name="staff_d" value="<?php echo $fieldrecord['staff_d']; ?>"  <?php if ($fieldrecord['staff_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Staff</label>
                                    </td>

                                     <td style="width:10%">
                                      <label><input type="checkbox" id="staffsubject_d" name="staffsubject_d" value="<?php echo $fieldrecord['staffsubject_d']; ?>"  <?php if ($fieldrecord['staffsubject_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Staff Subject</label>
                                    </td>
                                   
                                    <td style="width:10%">
                                      <label><input name="guardian_d" type="checkbox" id="guardian_d" value="<?php echo $fieldrecord['guardian_d']; ?>"  <?php if ($fieldrecord['guardian_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')">Guardian</label>
                                    </td>

                                      <td style="width:10%">
                                      <label><input type="checkbox" id="guardianward_d" name="guardianward_d" value="<?php echo $fieldrecord['guardianward_d']; ?>"  <?php if ($fieldrecord['guardianward_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Guardian Ward</label>
                                    </td>
                                    
                                    <td style="width:10%">
                                      <label><input type="checkbox" id="message_d" name="message_d" value="<?php echo $fieldrecord['message_d']; ?>"  <?php if ($fieldrecord['message_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Bulk Message</label>
                                    </td>

                                    <td style="width:10%">
                                      <label><input type="checkbox" id="idcard_d" name="idcard_d" value="<?php echo $fieldrecord['idcard_d']; ?>"  <?php if ($fieldrecord['idcard_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >ID Card</label>
                                    </td>
                                      <td style="width:10%">
                                      <label><input type="checkbox" id="medical_d" name="medical_d" value="<?php echo $fieldrecord['medical_d']; ?>"  <?php if ($fieldrecord['medical_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Medical</label>
                                    </td>
                                    <td style="width:10%">
                                      <label><input type="checkbox" id="timetable_d" name="timetable_d"  value="<?php echo $fieldrecord['timetable_d']; ?>"  <?php if ($fieldrecord['timetable_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Time Table</label>
                                    </td>
                                    <td style="width:15%">
                                      <label><input type="checkbox" id="forecast_d" name="forecast_d" value="<?php echo $fieldrecord['forecast_d']; ?>"  <?php if ($fieldrecord['forecast_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Forecast</label>
                                    </td>
                                       
                                   <td style="width:10%">
                                      <label><input type="checkbox" id="bursary_d" name="bursary_d" value="<?php echo $fieldrecord['bursary_d']; ?>"  <?php if ($fieldrecord['bursary_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Bursary</label>
                                    </td>
                                     <td style="width:10%">
                                      <label><input type="checkbox" id="cbt_d" name="cbt_d" value="<?php echo $fieldrecord['cbt_d']; ?>"  <?php if ($fieldrecord['cbt_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >CBT Test</label>
                                    </td>
                                  </tr>
                                  <tr>
                                   
                                     <td style="width:10%">
                                      <label><input type="checkbox" id="report_d" name="report_d" value="<?php echo $fieldrecord['report_d']; ?>"  <?php if ($fieldrecord['report_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Report</label>
                                    </td>
                                    <td style="width:10%">
                                      <label><input type="checkbox" id="website_d" name="website_d" value="<?php echo $fieldrecord['website_d']; ?>"  <?php if ($fieldrecord['website_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Website</label>
                                    </td>
                                    <td style="width:10%">
                                      <label><input type="checkbox" id="leave_d" name="leave_d" value="<?php echo $fieldrecord['leave_d']; ?>"  <?php if ($fieldrecord['leave_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Leave Applications</label>
                                    </td>
                                     <td style="width:10%">
                                      <label><input type="checkbox" id="hostel_d" name="hostel_d" value="<?php echo $fieldrecord['hostel_d']; ?>"  <?php if ($fieldrecord['hostel_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Hostel</label>
                                    </td>
                                     
                                     <td style="width:10%">
                                      <label><input type="checkbox" id="bookshop_d" name="bookshop_d" value="<?php echo $fieldrecord['bookshop_d']; ?>"  <?php if ($fieldrecord['bookshop_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Book Shop</label>
                                    </td>
                                    
                                     <td style="width:10%">
                                      <label><input type="checkbox" id="library_d" name="domain_s" value="<?php echo $fieldrecord['library_d']; ?>"  <?php if ($fieldrecord['library_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Library</label>
                                    </td>
                                     <td style="width:10%">
                                      <label><input type="checkbox" id="material_d" name="material_d" value="<?php echo $fieldrecord['material_d']; ?>"  <?php if ($fieldrecord['material_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Materials</label>
                                    </td>
                                    <td style="width:10%">
                                      <label><input type="checkbox" id="attendance_d" name="attendance_d" value="<?php echo $fieldrecord['attendance_d']; ?>"  <?php if ($fieldrecord['attendance_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Attendance</label>
                                    </td>
                                     <td style="width:10%">
                                      <label><input type="checkbox" id="dashadd_d" name="add_s" value="<?php echo $fieldrecord['dashadd_d']; ?>"  <?php if ($fieldrecord['dashadd_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Access Add Record</label>
                                    </td>
                                    <td style="width:10%">
                                      <label><input type="checkbox" id="dashedit_d" name="dashedit_s" value="<?php echo $fieldrecord['dashedit_d']; ?>"  <?php if ($fieldrecord['dashedit_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Access Edit</label>
                                    </td>
                                     <td style="width:10%">
                                      <label><input type="checkbox" id="dashdelete_d" name="dashdelete_s" value="<?php echo $fieldrecord['dashdelete_d']; ?>"  <?php if ($fieldrecord['dashdelete_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Access Delete</label>
                                    </td>
                                  </tr>
                                </table>
                                    
                                  </fieldset>

                                   <p>
                                  <fieldset>
                                  <legend class="schoolhelp">Result</legend>
                                  <table class="table-responsive">
                                    <tr>
                                       <td style="width:10%">
                                      <label><input type="checkbox" id="result_d" name="result_d" value="<?php echo $fieldrecord['result_d']; ?>"  <?php if ($fieldrecord['result_d']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Result</label>
                                    </td>
                                      <td style="width:10%">
                                      <label><input name="template_r" type="checkbox" id="template_r" value="<?php echo $fieldrecord['template_r']; ?>"  <?php if ($fieldrecord['template_r']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')">Template</label>
                                    </td>

                                    <td style="width:10%">
                                      <label><input type="checkbox" id="uploadscore_r" name="uploadscore_r" value="<?php echo $fieldrecord['uploadscore_r']; ?>"  <?php if ($fieldrecord['uploadscore_r']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Upload Score</label>
                                    </td>

                                     <td style="width:10%">
                                      <label><input type="checkbox" id="earlyscore_r" name="earlyscore_r" value="<?php echo $fieldrecord['earlyscore_r']; ?>"  <?php if ($fieldrecord['earlyscore_r']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Early Score</label>
                                    </td>
                                   
                                    <td style="width:10%">
                                      <label><input name="scoresheet_r" type="checkbox" id="scoresheet_r" value="<?php echo $fieldrecord['scoresheet_r']; ?>"  <?php if ($fieldrecord['scoresheet_r']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')">Scoresheet</label>
                                    </td>

                                      <td style="width:10%">
                                      <label><input type="checkbox" id="broadsheet_r" name="broadsheet_r" value="<?php echo $fieldrecord['broadsheet_r']; ?>"  <?php if ($fieldrecord['broadsheet_r']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Broadsheet</label>
                                    </td>
                                    
                                    <td style="width:10%">
                                      <label><input type="checkbox" id="resultactivation_r" name="resultactivation_r" value="<?php echo $fieldrecord['resultactivation_r']; ?>"  <?php if ($fieldrecord['resultactivation_r']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Result activation</label>
                                    </td>

                                    <td style="width:10%">
                                      <label><input type="checkbox" id="resultcolor_r" name="resultcolor_r" value="<?php echo $fieldrecord['resultcolor_r']; ?>"  <?php if ($fieldrecord['resultcolor_r']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Result Color</label>
                                    </td>
                                    <td style="width:10%">
                                      <label><input type="checkbox" id="termduration_r" name="termduration_r" value="<?php echo $fieldrecord['termduration_r']; ?>"  <?php if ($fieldrecord['termduration_r']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Term Duration</label>
                                    </td>
                                    <td style="width:10%">
                                      <label><input type="checkbox" id="comment_r" name="comment_r"  value="<?php echo $fieldrecord['comment_r']; ?>"  <?php if ($fieldrecord['comment_r']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Comment</label>
                                    </td>
                                     
                                  </tr>
                                  <tr>

                                    <td style="width:15%">
                                      <label><input type="checkbox" id="reportcard_r" name="reportcard_r" value="<?php echo $fieldrecord['reportcard_r']; ?>"  <?php if ($fieldrecord['reportcard_r']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Report Card</label>
                                    </td>
                                       
                                   <td style="width:10%">
                                      <label><input type="checkbox" id="addcomment_r" name="addcomment_r" value="<?php echo $fieldrecord['addcomment_r']; ?>"  <?php if ($fieldrecord['addcomment_r']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Add Comment</label>
                                    </td>
                                    <td style="width:10%">
                                      <label><input type="checkbox" id="resultsample_r" name="resultsample_r" value="<?php echo $fieldrecord['resultsample_r']; ?>"  <?php if ($fieldrecord['resultsample_r']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Result Sample</label>
                                    </td>
                                     <td style="width:10%">
                                      <label><input type="checkbox" id="promotion_r" name="promotion_r" value="<?php echo $fieldrecord['promotion_r']; ?>"  <?php if ($fieldrecord['promotion_r']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Promotion</label>
                                    </td>
                                    <td style="width:10%">
                                      <label><input type="checkbox" id="resultreversal_r" name="resultreversal_r" value="<?php echo $fieldrecord['resultreversal_r']; ?>"  <?php if ($fieldrecord['resultreversal_r']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Result Reversal</label>
                                    </td>
                                    <td style="width:10%">
                                      <label><input type="checkbox" id="resultspecification_r" name="resultspecification_r" value="<?php echo $fieldrecord['resultspecification_r']; ?>"  <?php if ($fieldrecord['resultspecification_r']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Result Specification</label>
                                    </td>
                                     <td style="width:10%">
                                      <label><input type="checkbox" id="resultadd_r" name="resultadd_r" value="<?php echo $fieldrecord['resultadd_r']; ?>"  <?php if ($fieldrecord['resultadd_r']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Access Add Record</label>
                                    </td>
                                    <td style="width:10%">
                                      <label><input type="checkbox" id="resultedit_r" name="resultedit_d" value="<?php echo $fieldrecord['resultedit_r']; ?>"  <?php if ($fieldrecord['resultedit_r']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Access Edit</label>
                                    </td>
                                     <td style="width:10%">
                                      <label><input type="checkbox" id="resultdelete_r" name="resultdelete_r" value="<?php echo $fieldrecord['resultdelete_r']; ?>"  <?php if ($fieldrecord['resultdelete_r']==1){?> checked="checked" <?php } ?> class="form-control col-md-1 col-xs-2" onclick="updating3field('adminpersons', 'adminid', '<?php echo $adminid ?>', $(this).attr('id'), this.value, 'operatorid', '<?php echo $schoolhelp ?>', 'sdate', '<?php echo $sdate; ?>', 'previlleges')" >Access Delete</label>
                                    </td>
                                     
                                  </tr>
                                </table>
                                    
                                  </fieldset>

                              </div>
                            </div>
                          </fieldset>
                        </div>
                        </div>
                       
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                          <div class="col-xs-6"><button class="btn btn-success print-link" ><i class="fa fa-print"></i> Print</button></div>
                          <div class="col-xs-6"><a class="btn btn-primary "  href="?page=3&schoolhelp=<?php echo $schoolhelp; ?>&id=<?php echo $fieldrecord['adminid']; ?>"><i class="fa fa-edit"></i> Edit</a></div>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
                <?php }} 
              } ?>
              </div>
            </div>
       <?php include("includes/footer.php"); ?>