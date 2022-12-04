
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/schoolhelpinserts.php");
include_once("../phpclass/schoolhelpupdate.php");
include_once("../phpclass/SHdashOOP.php");
include_once("../phpclass/schoolhelpOOP.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="House/Divisions";

$odate=date("Y-m-d");



 //Staff class
$schoolhelpDH=new classDash;
$schoolhelpsetting=new Allsettings;
$previllages=$schoolhelpsetting->allsettingedit('adminpersons', 'adminid', $schoolhelp);
foreach($previllages as $actualrecord){
  $pageaccess=trim($actualrecord['housedivision_s']);
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
$staffid=trim(isset($_GET['staffid'])?$_GET['staffid']:false);


if($page==2) {
  $counting=0;
  $hdname=trim(isset($_POST['hdname'])?$_POST['hdname']:false);
  $hddescription=trim(isset($_POST['hddescription'])?$_POST['hddescription']:false);
  $staffid=trim(isset($_POST['staffid'])?$_POST['staffid']:false);
  $studentid=trim(isset($_POST['studentid'])?$_POST['studentid']:false);

 
 
 $tblhousedivision=new insertTable;
$state=$tblhousedivision->insert_housedivision($hdname, $hddescription,  $studentid, $staffid,  $schoolhelp, $odate);
$display=$state['action'];
$counting=$counting+$state['counting'];


$sql=$display.":: Insertion, affected records = ".$counting;

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}

if($page==4) {
   
  $hdid=trim(isset($_POST['hdid'])?$_POST['hdid']:false);
  $hdname=trim(isset($_POST['hdname'])?$_POST['hdname']:false);
  $hddescription=trim(isset($_POST['hddescription'])?$_POST['hddescription']:false);
  $staffid=trim(isset($_POST['staffid'])?$_POST['staffid']:false);
  $studentid=trim(isset($_POST['studentid'])?$_POST['studentid']:false);
 

$tblhousedivision=new updateTable;
$state=$tblhousedivision->update_housedivision($hdname, $hddescription, $studentid, $staffid, $schoolhelp, $hdid);

$sql=$state.":: Update Made, affected records = 1";

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}

if ($page==6) {
  
   $hdid=trim(isset($_GET['id'])?$_GET['id']:false);
   //$photo=trim(isset($_GET['photo'])?$_GET['photo']:false);
   $tableUpdate= new updateTable;
    $state=$tableUpdate->delete_dash('housedivision', 'hdid', $hdid);

        $sql=$state.":: Deletion Made, affected records = 1";
         /* if ($state=="Success") {
                 $target_dir = "uploads/news/";
                  @unlink($target_dir.$photo);
              }*/

    
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
                      <li><a class="btn btn-primary" href="../?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                      <li><a class="btn btn-success " href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"> Settings</i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                         <li  ><a href="?page=1&schoolhelp=<?php echo $schoolhelp; ?>"  ><i class="fa fa-plus"></i> Add <?php echo $pagename; ?></a>
                      </li>
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> View <?php echo $pagename; ?></a>
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
                          <th>Name</th>
                          <th>Description</th>
                          <th><?php echo $pagename; ?> Staff</th>
                          <th><?php echo $pagename; ?> Student</th>
                         
                          <th style="width:10%;"><i class="fa fa-address-card" style="color:green"></i> Print</th>
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
                              
                              $records=$schoolhelpDH->alldash('housedivision', 'hdid', 'DESC');
                              if (isset($records)) {
                                
                              foreach($records as $fieldrecord){
                                $k+=1;
                                $operatorid=trim($fieldrecord['operatorid']);
                                $studentid=trim($fieldrecord['studentid']);
                              
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
                                
                                  $studentrecords=$schoolhelpDH->alldashedit('students', 'stid', $studentid);
                                 if (is_array($studentrecords)) {
                                    foreach($studentrecords as $studentrecord){
                                    $studentsurname=$studentrecord['surname'];
                                    $studentothername=$studentrecord['othername'];
                                  }
                                 }

                 
                                ?>
                                      <tr>
                                          <td><?php echo $k; ?></td>
                                        <td><?php echo  substr($fieldrecord['hdname'], 0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['hddescription'], 0, 12); ?></td>
                                      
                                        <td><?php echo  $staffsurname ." ".$staffothername; ?></td>
                                         <td><?php echo  $studentsurname ." ".$studentothername; ?></td>
                                     
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['hdid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['hdid']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['hdid']; ?>','');"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
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
                  <form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="formhousedivionid"  class="form-horizontal form-label-left" >

                     <div class="form-group">
                        <label for="hdname" class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $pagename ?> Name<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="hdname" class="form-control col-md-7 col-xs-12" type="text" name="hdname" required="required">
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="hddescription" class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $pagename ?> Description<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="hddescription" class="form-control col-md-7 col-xs-12"  name="hddescription" required="required"></textarea>
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid"><?php echo $pagename ?> Chief(Staff)<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         
                           <input type="text" list="staffnames" id="staffname" class="form-control col-md-7 col-xs-12" placeholder="Please type and select staff name " onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'staffid');">

                        <datalist id="staffnames">

                            <?php
                             $records=$schoolhelpDH->alldash('staff', 'staffid', 'ASC');
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                           
                            ?>
                            <option data-value="<?php echo $fieldrecord['staffid']; ?>"  value="<?php echo $fieldrecord['surname'].' '.$fieldrecord['othername']; ?>">
                            <?php } 
                          }?>
                           </datalist>
                           <input id="staffid" class="form-control col-md-7 col-xs-12" name="staffid" type="hidden">
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="staffid"><?php echo $pagename ?> Chief(Student)<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         
                       <input type="text" list="studentnames" id="studentname" class="form-control col-md-7 col-xs-12" placeholder="Please type and select student name " onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'studentid');">

                        <datalist id="studentnames">

                            <?php
                             $records=$schoolhelpDH->alldash('students', 'stid', 'ASC');
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                           
                            ?>
                            <option data-value="<?php echo $fieldrecord['stid']; ?>"  value="<?php echo $fieldrecord['surname'].' '.$fieldrecord['othername']; ?>">
                            <?php } 
                          }?>
                           </datalist>
                           <input id="studentid" class="form-control col-md-7 col-xs-12" type="hidden" name="studentid" >
                        </div>
                      </div>

                       
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
                    $hdid=trim(isset($_GET['id'])?$_GET['id']:false);
                   $records=$schoolhelpDH->alldashedit('housedivision', 'hdid', $hdid);
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                $hdname=trim($fieldrecord['hdname']);
                                $hddescription=trim($fieldrecord['hddescription']);
                                $operatorid=trim($fieldrecord['operatorid']);
                                $staffid=trim($fieldrecord['staffid']);
                                $studentid=trim($fieldrecord['studentid']);
                                $odatet=trim($fieldrecord['odate']);
                                $udate=trim($fieldrecord['udate']);
                          }

                          //collecting staff record
                             
                                     $staffrecords=$schoolhelpDH->alldashedit('staff', 'staffid', $staffid);
                                     if (is_array($staffrecords)) {
                                     foreach($staffrecords as $staffrecord){
                                        $staffsurname=$staffrecord['surname'];
                                        $staffothername=$staffrecord['othername'];
                                       
                                     }
                                   }

                                   //collecting staff record
                                   $studentrecords=$schoolhelpDH->alldashedit('students', 'stid', $studentid);
                                   if (is_array($studentrecords)) {
                                  
                                   foreach($studentrecords as $studentrecord){
                                      $studentsurname=$studentrecord['surname'];
                                      $studentothername=$studentrecord['othername'];
                                     
                                   }
                                   
                                  } 

                    
                    }
                    ?>
                    
                    <div class="x_panel">

                      <fieldset>
                        <legend style="color:#063">Edit <?php echo $pagename ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="forminstitutionid"  class="form-horizontal form-label-left" >
                    <input id="hdid" class="form-control col-md-7 col-xs-12" type="hidden" name="hdid" required="required" value="<?php echo $hdid; ?>">
                       <div class="form-group">
                        <label for="hdname" class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $pagename ?> Name<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="hdname" class="form-control col-md-7 col-xs-12" type="text" name="hdname" required="required" value="<?php echo $hdname; ?>">
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="hddescription" class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $pagename ?> Description<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="hddescription" class="form-control col-md-7 col-xs-12"  name="hddescription" required="required"><?php echo $hddescription; ?></textarea>
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid"><?php echo $pagename ?> Chief(Staff)<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         
                           <input type="text" list="staffnames" id="staffname" class="form-control col-md-7 col-xs-12"  value="<?php echo $staffsurname.' '.$staffothername; ?>" placeholder="Please type and select staff name " onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'staffid');">

                        <datalist id="staffnames">

                            <?php
                             $records=$schoolhelpDH->alldash('staff', 'staffid', 'ASC');
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                           
                            ?>
                            <option data-value="<?php echo $fieldrecord['staffid']; ?>"  value="<?php echo $fieldrecord['surname'].' '.$fieldrecord['othername']; ?>">
                            <?php } 
                          }?>
                           </datalist>
                           <input id="staffid" class="form-control col-md-7 col-xs-12" name="staffid" type="hidden" value="<?php echo $staffid; ?>">
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="staffid"><?php echo $pagename ?> Chief(Student)<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         
                       <input type="text" list="studentnames" id="studentname" class="form-control col-md-7 col-xs-12" placeholder="Please type and select student name " onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'studentid');"   value="<?php echo $studentsurname.' '.$studentothername; ?>">

                        <datalist id="studentnames">

                            <?php
                             $records=$schoolhelpDH->alldash('students', 'stid', 'ASC');
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                           
                            ?>
                            <option data-value="<?php echo $fieldrecord['stid']; ?>"  value="<?php echo $fieldrecord['surname'].' '.$fieldrecord['othername']; ?>">
                            <?php } 
                          }?>
                           </datalist>
                           <input id="studentid" class="form-control col-md-7 col-xs-12" type="hidden" name="studentid" value="<?php echo $studentid; ?>">
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
                       

                    </form>
                  </div>
                  </fieldset>
                 </div>
                <?php } ?>

                <?php if ($page==5) {
                  $hdid=trim(isset($_GET['id'])?$_GET['id']:false);
                   
                              $studentid="";
                              
                              $staffid="";
                              $hddescription="";
                              $hdname="";
                              $records=$schoolhelpDH->alldashedit('housedivision', 'hdid', $hdid);
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                $hdname=trim($fieldrecord['hdname']);
                                $hddescription=trim($fieldrecord['hddescription']);
                                $operatorid=trim($fieldrecord['operatorid']);
                                $staffid=trim($fieldrecord['staffid']);
                                $studentid=trim($fieldrecord['studentid']);
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
                                     if (is_array($staffrecords)) {
                                     foreach($staffrecords as $staffrecord){
                                        $staffsurname=$staffrecord['surname'];
                                        $staffothername=$staffrecord['othername'];
                                       // $staffpassport=$staffrecord['passport'];
                                     }
                                   }

                                   //collecting staff record
                                   $studentrecords=$schoolhelpDH->alldashedit('students', 'stid', $studentid);
                                   if (is_array($studentrecords)) {
                                  
                                   foreach($studentrecords as $studentrecord){
                                      $studentsurname=$studentrecord['surname'];
                                      $studentothername=$studentrecord['othername'];
                                     
                                   }
                                   
                                  }         
                                  
                                  //Instition Record
                                   $datas1=new classInstitution;
                                  $record1=$datas1->institution();

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
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $hdname ; ?>
                                          <small class="pull-right">Date: <?php echo $odate; ?></small>
                                      </h3>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                       
                       
                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col">
                         <img id="userimage" <?php if ($instilogo!="") {?> style="display: block" src="../images/logo/<?php echo $instilogo ?>" <?php } ?> class="img img-responsive img-thumbnail" >
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
                          <center><p class="lead schoolhelpcolor"><b><?php echo $hdname; ?> Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%"><?php echo $pagename;?> Name</th>
                                  <td><?php echo $hdname; ?></td>
                                </tr>
                                  <tr>
                                  <th><?php echo $pagename;?> Description</th>
                                  <td><?php echo $hddescription; ?></td>
                                </tr>
                                <tr>
                                  <th><?php echo $pagename; ?> Cordinator (Staff)</th>
                                  <td><?php echo $staffsurname. ' ' .$staffothername; ?></td>
                                </tr>
                                <tr>
                                  <th><?php echo $pagename; ?> Chief (Student)</th>
                                  <td><?php echo $studentsurname. ' ' .$studentothername; ?></td>
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