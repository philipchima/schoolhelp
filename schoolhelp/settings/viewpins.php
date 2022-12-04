<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/schoolhelpinserts.php");
include_once("../phpclass/schoolhelpupdate.php");
include_once("../phpclass/schoolhelpdelete.php");
include_once("../phpclass/schoolhelpOOP.php");

$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="View Pins";
$schoolhelp=1;
$odate=date("Y-m-d");

// Checking page access Authenticity
$schoolhelpsetting=new Allsettings;
$previllages=$schoolhelpsetting->allsettingedit('adminpersons', 'adminid', $schoolhelp);
foreach($previllages as $actualrecord){
  $pageaccess=trim($actualrecord['pin_s']);
  $settingedit_s=trim($actualrecord['settingedit_s']);
  $settingdelete_s=trim($actualrecord['settingdelete_s']);
  $settingadd_s=trim($actualrecord['settingadd_s']);
}
if ($pageaccess!=1) {
  echo "<b style='font-size:100; color:red'>Criminal Attempt Made, contact the admin ask for the access of this page</b>";
  exit();
}

//calling of classes
//department Table
$deptclass=new classDepartment;
//grade table
$datas=new classGrade;
//Admin Methods
$adminrecord=new Adminperson;

$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);
?>

<?php
if($page==4) {
  if($settingedit_s==1) {

 $pinid=trim(isset($_POST["pinid"])?$_POST["pinid"]:false);
  $departmentid=trim(isset($_POST["departmentid"])?$_POST["departmentid"]:false);
  $pincode=trim(isset($_POST["pincode"])?$_POST["pincode"]:false);
  $duration=trim(isset($_POST["duration"])?$_POST["duration"]:false);
  $expirydate=trim(isset($_POST["expirydate"])?$_POST["expirydate"]:false);
  
$tablepin=new UpdateTable;
$state=$tablepin->update_pin($departmentid, $pincode, $duration,  $expirydate, $schoolhelp, $pinid);

$sql=$state.":: Pin Changed Successfully, updated row = 1";

   }else{
         $sql="Unauthorised Please contact the Admin";
    }

echo "<script>
        window.location.href='viewpins?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}
// Checking page access Authenticity

if ($page==6) {
   if($settingdelete_s==1) {

  $pinid1 =trim(isset($_GET["id"])?$_GET["id"]:false);
   
   $schoolhelpDHd= new TblDeleterow;
    $state=$schoolhelpDHd->delete_setting('pingenerate', 'pinid', $pinid1);

        $sql=$state.":: Deletion Made, affected records = 1";
          
    }else{
         $sql="Unauthorised Please contact the Admin";
    }
   
      echo "<script>
                window.location.href='viewpins?schoolhelp=$schoolhelp&sql=$sql';
              </script>";
}

 
  if($page == 2){
  $status=trim(isset($_GET["pinstatus"])?$_GET["pinstatus"]:false);
  }
?>

<?php 
  if($page == 3){
$departmentid=trim(isset($_POST["departmentid"])?$_POST["departmentid"]:false);
$status=trim(isset($_POST["cardstatus"])?$_POST["cardstatus"]:false);

  }
?>





<?php

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
                    <h2 id="caption"><?php echo $pagename; ?></h2>
                    <ul class="nav navbar-right panel_toolbox" style="">
                      <li><a class="btn btn-primary" href="../?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                      <li><a class="btn btn-success " href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"> Settings</i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                          <?php if ($settingadd_s==1) {?>
                         <li  ><a href="pingeneration?schoolhelp=<?php echo $schoolhelp; ?>"  ><i class="fa fa-plus"></i>  Generate Pin</a>
                          <?php } ?>
                      </li>
                          <li ><a  href="printpins?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  Print Pins</a>
                      </li>
                      <li ><a  href="viewpins?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  View Pins</a>
                      </li>
                        </ul>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div style="color:#063" <?php if($state=="failed") {?> style="color:red" <?php } ?> ><b><?php echo $sql; ?></b></div>

                  <div class="x_panel ">
                    <form  action="viewpins?page=3&schoolhelp=<?php echo $schoolhelp ?>" name="search" method="post" >
                      <fieldset>
                        <legend>Search Pins</legend>
                        
                             
                      <table class="table" style="overflow-y:hidden;">
                        <thead>
                          <tr>
                            <th> Department: </th>
                            <th> Pin Status: </th>
                            
                            <th>Action: </th>
                          </tr>
                        </thead>
                        <tbody>
                         <tr>
              
                    <td style="padding-right:20px">
                        <select  name="departmentid" id="departmentid" required="required"  class="form-control col-md-4" >
                            <option value="">--Select Department--</option>
                            <?php
                            $deptrecord=$deptclass->department('asc');
                            if (is_array($deptrecord)) {
                            
                            foreach($deptrecord as $deptdata){
                            ?>
                            <option value="<?php echo $deptdata['did']; ?>"  ><?php echo $deptdata['deptname']; ?></option>
                            <?php } 
                            }
                            ?>
                          </select>
                    </td>
               
                <td >
                 <select name="cardstatus" id="cardstatus"  class="form-control col-md-4" required="required">
                        <option value="">--Select--</option>
                         <option value="0" >Valid</option>
                         <option value="1" >Active</option>
                         <option value="2" >Expired</option>
                      </select>                                                                                                                                                                                                                                                                                                              
                  </td>

                 
                  <td> <input  type="submit" class="btn btn-primary" value="Search" class="form-control col-md-4" /></td>
             </tr>
           </tbody>
              </table>
            
            </form>
             </fieldset>
                  </div>

              
                    <?php if ($page=="") {?>
                      <div class="x_panel ">
                         <fieldset>
                        <legend style="color:#063"><?php echo $pagename; ?> Record</legend>

                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                       <colgroup>
                        <col>
                        <col>
                        <col style="background-color:#e6ffe6">
                      </colgroup>
                      <thead>
                       
                        <tr>
                          <th>SN</th>
                         <th>Department</th>
                          <th>Student</th>
                          <th>Pin</th>
                          <th>No of Days</th>
                          <th>Expiry Date</th>
                          <th>Term</th>
                          <th>Session</th>
                          <th>Status</th>
                          
                          <?php if ($settingedit_s==1) { ?>
                          <th style="width:10%;"><i class="far fa-address-card" style="color:green"></i> Print</th>
                         
                          <th style="width:10%;"><i class="fa fa-edit" style="color:red"></i> Edit</th>
                              <?php } if ($settingdelete_s==1) { ?>
                           <th style="width:10%;"><i class="fa fa-trash" style="color:red"></i> Delete</th>
                           <?php } ?>
                           <th>User<i class="fa fa-user"></i></th>
                       
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                            
                              $records=$schoolhelpsetting->allsetting('pingenerate','pinid','desc');
                              $fullname="";
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                $k+=1;
                                $fieldvalue=trim($fieldrecord['operatorid']);
                                 $stid=trim($fieldrecord['stid']);
                                 $departmentid=trim($fieldrecord['departmentid']);
                                 $semesterid=trim($fieldrecord['semesterid']);
                                 $sessionid=trim($fieldrecord['sessionid']);


                              $studentrecords=$schoolhelpsetting->allsettingedit('students','stid',$stid);
                              if (is_array($studentrecords)) {
                              foreach($studentrecords as $studentrecord){
                                $studentsurname=$studentrecord['surname'];
                                $studentothername=$studentrecord['departmentid'];
                                $fullname=$studentsurname.' '.$studentothername;
                              }
                            }

                            $semesterrecords=$schoolhelpsetting->allsettingedit('semesters','semesterid',$semesterid);
                              if (is_array($semesterrecords)) {
                              foreach($semesterrecords as $semesterrecord){
                                $semestername=$semesterrecord['semestername'];
                              }
                            }

                             $sessionrecords=$schoolhelpsetting->allsettingedit('session','sessionid',$sessionid);
                              if (is_array($sessionrecords)) {
                              foreach($sessionrecords as $sessionrecord){
                                $sessionlow=$sessionrecord['sessionlow'];
                                $sessionhigh=$sessionrecord['sessionhigh'];
                                $sessionname=$sessionlow.'|'.$sessionhigh;
                              }
                            }
                               
                               //collecting department record
                              $deptmethod=$deptclass->departmentedit('did', $departmentid);
                              $deptname=$deptmethod['deptname'];
                                //Getting Admin Detials
                                $admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
                                ?>
                                      <tr>
                                        <td><?php echo $k; ?></td>
                                       <td style="font-size:12px;"><?php  echo  $deptname; ?></td>
                                      <td style="font-size:10px;"><?php echo $fullname; ?></td>
                                      <td><?php echo $fieldrecord['pincode']; ?></td>
                                      <td><?php echo $fieldrecord['duration']; ?></td>
                                      <td><?php echo $fieldrecord['expirydate']; ?></td>
                                      <td><?php echo  $semestername; ?></td>
                                      <td><?php echo $sessionname; ?></td>
                                      
                                      <td><?php if(($fieldrecord['status']==0)&&($fieldrecord['expirydate']>$odate)) {
                                        echo "Valid";
                                      }elseif ($fieldrecord['status']==1) {
                                        echo "Active";
                                      }elseif (($fieldrecord['status']==2)||($odate>$fieldrecord['expirydate'])) {
                                        echo "Expired";
                                      } ?></td>                    
                                        <?php if ($settingedit_s==1) { ?>
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['pinid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                          
                                       <td width="5%" style="font-weight:normal" class=" "><?php if(($fieldrecord['status']==0)&&($fieldrecord['expirydate']>$odate)) {?><a href="viewpins?schoolhelp=<?php echo $schoolhelp; ?>&page=7&id=<?php echo $fieldrecord['pinid'] ?>" target="_parent" class="btn btn-dark"><i class="fa fa-edit"></i></a></td><?php } ?></td>
                                         <?php } if ($settingdelete_s==1) { ?>
                                       <td width="8%" align="center" class=" "><?php if (($fieldrecord['status']==2)||($odate>$fieldrecord['expirydate'])) { ?><a href="viewpins?schoolhelp=<?php echo $schoolhelp; ?>&page=6&id=<?php echo $fieldrecord['pinid']; ?>" target="_parent" onclick="return confirmDel();" class="btn btn-danger"><i class="fa fa-close"></i></a> <?php } ?></td>
                                        <?php } ?>
                                           <td ><span class="btn-group">
                                            <center><button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-user"></i> Details<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu">
                                            <li ><span>Update by</span> : <?php echo  $admindata['surname']. " ".$admindata['othername'] ; ?></li>
                                            <li><span>Upate Date</span> : <?php echo  $fieldrecord['udate']; ?></li>
                                            <li><span>Initial Date</span> : <?php echo  $fieldrecord['odate']; ?></li>
                                            
                                          </ul>
                                          </center></span>

                                        </td>
                                      </tr>
                             <?php }
                              }else{ echo "<span class='required'>Record not inserted yet</span>";}
                             ?>
                        
                      </tbody>
                    </table>
                   </fieldset>
                    </div>
                    <?php } ?>

                    <?php
                    if ($page == 3){
                    ?>
                        <div class="x_panel ">
                         <fieldset>
                        <legend style="color:#063"><?php echo $pagename; ?> Record</legend>

                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                       <colgroup>
                        <col>
                        <col>
                        <col style="background-color:#e6ffe6">
                      </colgroup>
                      <thead>
                       
                        <tr>
                          <th>SN</th>
                         <th>Department</th>
                          <th>Student</th>
                          <th>Pin</th>
                          <th>No of Days</th>
                          <th>Expiry Date</th>
                          <th>Term</th>
                          <th>Session</th>
                          <th>Status</th>
                          
                          <?php if ($settingedit_s==1) { ?>
                          <th style="width:10%;"><i class="far fa-address-card" style="color:green"></i> Print</th>
                         
                          <th style="width:10%;"><i class="fa fa-edit" style="color:red"></i> Edit</th>
                              <?php } if ($settingdelete_s==1) { ?>
                           <th style="width:10%;"><i class="fa fa-trash" style="color:red"></i> Delete</th>
                           <?php } ?>
                           <th>User<i class="fa fa-user"></i></th>
                       
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 

                            if ($status==0 or $status==1) {
                                $records=$schoolhelpsetting->allsettingeditg3('pingenerate','departmentid', $departmentid, 'status',$status, 'expirydate',$odate);
                              }
                                else  {
                                $records=$schoolhelpsetting->allsettingeditl3('pingenerate','departmentid', $departmentid, 'status',$status, 'expirydate',$odate);
                              }
                            
            
                              
                              $fullname="";
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                $k+=1;
                                $fieldvalue=trim($fieldrecord['operatorid']);
                                 $stid=trim($fieldrecord['stid']);
                                 $departmentid=trim($fieldrecord['departmentid']);
                                 $semesterid=trim($fieldrecord['semesterid']);
                                 $sessionid=trim($fieldrecord['sessionid']);


                              $studentrecords=$schoolhelpsetting->allsettingedit('students','stid',$stid);
                              if (is_array($studentrecords)) {
                              foreach($studentrecords as $studentrecord){
                                $studentsurname=$studentrecord['surname'];
                                $studentothername=$studentrecord['departmentid'];
                                $fullname=$studentsurname.' '.$studentothername;
                              }
                            }

                            $semesterrecords=$schoolhelpsetting->allsettingedit('semesters','semesterid',$semesterid);
                              if (is_array($semesterrecords)) {
                              foreach($semesterrecords as $semesterrecord){
                                $semestername=$semesterrecord['semestername'];
                              }
                            }

                             $sessionrecords=$schoolhelpsetting->allsettingedit('session','sessionid',$sessionid);
                              if (is_array($sessionrecords)) {
                              foreach($sessionrecords as $sessionrecord){
                                $sessionlow=$sessionrecord['sessionlow'];
                                $sessionhigh=$sessionrecord['sessionhigh'];
                                $sessionname=$sessionlow.'|'.$sessionhigh;
                              }
                            }
                               
                               //collecting department record
                              $deptmethod=$deptclass->departmentedit('did', $departmentid);
                              $deptname=$deptmethod['deptname'];
                                //Getting Admin Detials
                                $admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
                                ?>
                                      <tr>
                                        <td><?php echo $k; ?></td>
                                       <td style="font-size:12px;"><?php  echo  $deptname; ?></td>
                                      <td style="font-size:10px;"><?php echo $fullname; ?></td>
                                      <td><?php echo $fieldrecord['pincode']; ?></td>
                                      <td><?php echo $fieldrecord['duration']; ?></td>
                                      <td><?php echo $fieldrecord['expirydate']; ?></td>
                                      <td><?php echo  $semestername; ?></td>
                                      <td><?php echo $sessionname; ?></td>
                                      
                                      <td><?php if(($fieldrecord['status']==0)&&($fieldrecord['expirydate']>$odate)) {
                                        echo "Valid";
                                      }elseif ($fieldrecord['status']==1) {
                                        echo "Active";
                                      }elseif (($fieldrecord['status']==2)||($odate>$fieldrecord['expirydate'])) {
                                        echo "Expired";
                                      } ?></td>                    
                                        <?php if ($settingedit_s==1) { ?>
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['pinid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                          
                                       <td width="5%" style="font-weight:normal" class=" "><?php if(($fieldrecord['status']==0)&&($fieldrecord['expirydate']>$odate)) {?><a href="viewpins?schoolhelp=<?php echo $schoolhelp; ?>&page=7&id=<?php echo $fieldrecord['pinid'] ?>" target="_parent" class="btn btn-dark"><i class="fa fa-edit"></i></a></td><?php } ?></td>
                                         <?php } if ($settingdelete_s==1) { ?>
                                       <td width="8%" align="center" class=" "><?php if (($fieldrecord['status']==2)||($odate>$fieldrecord['expirydate'])) { ?><a href="viewpins?schoolhelp=<?php echo $schoolhelp; ?>&page=6&id=<?php echo $fieldrecord['pinid']; ?>" target="_parent" onclick="return confirmDel();" class="btn btn-danger"><i class="fa fa-close"></i></a> <?php } ?></td>
                                        <?php } ?>
                                           <td ><span class="btn-group">
                                            <center><button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-user"></i> Details<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu">
                                            <li ><span>Update by</span> : <?php echo  $admindata['surname']. " ".$admindata['othername'] ; ?></li>
                                            <li><span>Upate Date</span> : <?php echo  $fieldrecord['udate']; ?></li>
                                            <li><span>Initial Date</span> : <?php echo  $fieldrecord['odate']; ?></li>
                                            
                                          </ul>
                                          </center></span>

                                        </td>
                                      </tr>
                             <?php }
                              }else{ echo "<span class='required'>Record not inserted yet</span>";}
                             ?>
                        
                      </tbody>
                    </table>
                   </fieldset>
                    </div>
                    <?php } ?>

                     <?php
                    if ($page == 2){
                    ?>
                        <div class="x_panel ">
                         <fieldset>
                        <legend style="color:#063"><?php echo $pagename; ?> Record</legend>

                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                       <colgroup>
                        <col>
                        <col>
                        <col style="background-color:#e6ffe6">
                      </colgroup>
                      <thead>
                       
                        <tr>
                          <th>SN</th>
                         <th>Department</th>
                          <th>Student</th>
                          <th>Pin</th>
                          <th>No of Days</th>
                          <th>Expiry Date</th>
                          <th>Term</th>
                          <th>Session</th>
                          <th>Status</th>
                          
                          <?php if ($settingedit_s==1) { ?>
                          <th style="width:10%;"><i class="far fa-address-card" style="color:green"></i> Print</th>
                         
                          <th style="width:10%;"><i class="fa fa-edit" style="color:red"></i> Edit</th>
                              <?php } if ($settingdelete_s==1) { ?>
                           <th style="width:10%;"><i class="fa fa-trash" style="color:red"></i> Delete</th>
                           <?php } ?>
                           <th>User<i class="fa fa-user"></i></th>
                       
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                            if ($status==0) {
                                $records=$schoolhelpsetting->allsettingeditg('pingenerate','status',$status, 'expirydate',$odate);
                              }
                                else if ($status==1) {
                               $records=$schoolhelpsetting->allsettingeditg('pingenerate','status',$status, 'expirydate',$odate);
                              }
                              else if ($status==2) {
                                
                                 $records=$schoolhelpsetting->allsettingeditl('pingenerate','status',$status, 'expirydate',$odate);
                              }else{
                                $records=$schoolhelpsetting->allsetting('pingenerate','pinid','desc');
                              }
            
                              
                              $fullname="";
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                $k+=1;
                                $fieldvalue=trim($fieldrecord['operatorid']);
                                 $stid=trim($fieldrecord['stid']);
                                 $departmentid=trim($fieldrecord['departmentid']);
                                 $semesterid=trim($fieldrecord['semesterid']);
                                 $sessionid=trim($fieldrecord['sessionid']);


                              $studentrecords=$schoolhelpsetting->allsettingedit('students','stid',$stid);
                              if (is_array($studentrecords)) {
                              foreach($studentrecords as $studentrecord){
                                $studentsurname=$studentrecord['surname'];
                                $studentothername=$studentrecord['departmentid'];
                                $fullname=$studentsurname.' '.$studentothername;
                              }
                            }

                            $semesterrecords=$schoolhelpsetting->allsettingedit('semesters','semesterid',$semesterid);
                              if (is_array($semesterrecords)) {
                              foreach($semesterrecords as $semesterrecord){
                                $semestername=$semesterrecord['semestername'];
                              }
                            }

                             $sessionrecords=$schoolhelpsetting->allsettingedit('session','sessionid',$sessionid);
                              if (is_array($sessionrecords)) {
                              foreach($sessionrecords as $sessionrecord){
                                $sessionlow=$sessionrecord['sessionlow'];
                                $sessionhigh=$sessionrecord['sessionhigh'];
                                $sessionname=$sessionlow.'|'.$sessionhigh;
                              }
                            }
                               
                               //collecting department record
                              $deptmethod=$deptclass->departmentedit('did', $departmentid);
                              $deptname=$deptmethod['deptname'];
                                //Getting Admin Detials
                                $admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
                                ?>
                                      <tr>
                                        <td><?php echo $k; ?></td>
                                       <td style="font-size:12px;"><?php  echo  $deptname; ?></td>
                                      <td style="font-size:10px;"><?php echo $fullname; ?></td>
                                      <td><?php echo $fieldrecord['pincode']; ?></td>
                                      <td><?php echo $fieldrecord['duration']; ?></td>
                                      <td><?php echo $fieldrecord['expirydate']; ?></td>
                                      <td><?php echo  $semestername; ?></td>
                                      <td><?php echo $sessionname; ?></td>
                                      
                                      <td><?php if(($fieldrecord['status']==0)&&($fieldrecord['expirydate']>$odate)) {
                                        echo "Valid";
                                      }elseif ($fieldrecord['status']==1) {
                                        echo "Active";
                                      }elseif (($fieldrecord['status']==2)||($odate>$fieldrecord['expirydate'])) {
                                        echo "Expired";
                                      } ?></td>                    
                                        <?php if ($settingedit_s==1) { ?>
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['pinid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                          
                                       <td width="5%" style="font-weight:normal" class=" "><?php if(($fieldrecord['status']==0)&&($fieldrecord['expirydate']>$odate)) {?><a href="viewpins?schoolhelp=<?php echo $schoolhelp; ?>&page=7&id=<?php echo $fieldrecord['pinid'] ?>" target="_parent" class="btn btn-dark"><i class="fa fa-edit"></i></a></td><?php } ?></td>
                                         <?php } if ($settingdelete_s==1) { ?>
                                       <td width="8%" align="center" class=" "><?php if (($fieldrecord['status']==2)||($odate>$fieldrecord['expirydate'])) { ?><a href="viewpins?schoolhelp=<?php echo $schoolhelp; ?>&page=6&id=<?php echo $fieldrecord['pinid']; ?>" target="_parent" onclick="return confirmDel();" class="btn btn-danger"><i class="fa fa-close"></i></a> <?php } ?></td>
                                        <?php } ?>
                                           <td ><span class="btn-group">
                                            <center><button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-user"></i> Details<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu">
                                            <li ><span>Update by</span> : <?php echo  $admindata['surname']. " ".$admindata['othername'] ; ?></li>
                                            <li><span>Upate Date</span> : <?php echo  $fieldrecord['udate']; ?></li>
                                            <li><span>Initial Date</span> : <?php echo  $fieldrecord['odate']; ?></li>
                                            
                                          </ul>
                                          </center></span>

                                        </td>
                                      </tr>
                             <?php }
                              }else{ echo "<span class='required'>Record not inserted yet</span>";}
                             ?>
                        
                      </tbody>
                    </table>
                   </fieldset>
                    </div>
                    <?php } ?>
                       <?php 

                  if($page==7) {
                    $pinid1 =trim(isset($_GET["id"])?$_GET["id"]:false);

                    $records=$schoolhelpsetting->allsettingedit('pingenerate','pinid',$pinid1);

                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){

                             

                    ?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Edit <?php echo $pagename; ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="domainname"  class="form-horizontal form-label-left" >
                      <input type="hidden" name="pinid" value="<?php echo $pinid1; ?>">

                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="domaintypeid">Department <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
                           <select  id="departmentid" required="required" name="departmentid" class="form-control col-md-4" >
                            <option value="">--Select Department--</option>
                            <?php
                            $deptrecord=$deptclass->department('asc');
                            if (is_array($deptrecord)) {
                            
                            foreach($deptrecord as $deptdata){
                            ?>
                            <option value="<?php echo $deptdata['did']; ?>" <?php if($fieldrecord['departmentid'] == $deptdata['did']){?> selected="selected" <?php } ?> ><?php echo $deptdata['deptname']; ?></option>
                            <?php } 
                            }
                            ?>
                          </select>
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="remark" class="control-label col-md-3 col-sm-3 col-xs-12">Allocated Days</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="duration" id="duration"  class="form-control col-md-6 col-sm-6 col-xs-12" required="required">
                                      <option value="">--Select--</option>
                                      <?php
                          $k1 = 0;
                                        ?>
                                      <?php do { $k1+=1;  ?>
                                       <option value="<?php echo  $k1; ?>" <?php if ($k1==$fieldrecord['duration']) {?> selected="selected" <?php } ?> ><?php echo  $k1; ?></option>
                                      <?php } while ($k1<365); ?>
                                    </select>             
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="remark" class="control-label col-md-3 col-sm-3 col-xs-12">Expiry Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="date" class="form-control col-md-6 col-xs-12" name="expirydate" value="<?php echo $fieldrecord['expirydate']; ?>">          
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="remark" class="control-label col-md-3 col-sm-3 col-xs-12">Pin Code</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="text" class="form-control col-md-6 col-xs-12" name="pincode" value="<?php echo $fieldrecord['pincode']; ?>">          
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
                <?php }
              }
              } ?>
                <?php if ($page==5) {
                  $pinid =trim(isset($_GET["id"])?$_GET["id"]:false);

                    $records=$schoolhelpsetting->allsettingedit('pingenerate','pinid',$pinid);
                    $fullname="";
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){

                            
                           
                                $fieldvalue=trim($fieldrecord['operatorid']);
                                 $stid=trim($fieldrecord['stid']);
                                 $departmentid=trim($fieldrecord['departmentid']);
                                 $semesterid=trim($fieldrecord['semesterid']);
                                 $sessionid=trim($fieldrecord['sessionid']);


                              $studentrecords=$schoolhelpsetting->allsettingedit('students','stid',$stid);
                              if (is_array($studentrecords)) {
                              foreach($studentrecords as $studentrecord){
                                $studentsurname=$studentrecord['surname'];
                                $studentothername=$studentrecord['departmentid'];
                                $fullname=$studentsurname.' '.$studentothername;
                              }
                            }

                            $semesterrecords=$schoolhelpsetting->allsettingedit('semesters','semesterid',$semesterid);
                              if (is_array($semesterrecords)) {
                              foreach($semesterrecords as $semesterrecord){
                                $semestername=$semesterrecord['semestername'];
                              }
                            }

                             $sessionrecords=$schoolhelpsetting->allsettingedit('session','sessionid',$sessionid);
                              if (is_array($sessionrecords)) {
                              foreach($sessionrecords as $sessionrecord){
                                $sessionlow=$sessionrecord['sessionlow'];
                                $sessionhigh=$sessionrecord['sessionhigh'];
                                $sessionname=$sessionlow.'|'.$sessionhigh;
                              }
                            }
                               
                               //collecting department record
                              $deptmethod=$deptclass->departmentedit('did', $departmentid);
                              $deptname=$deptmethod['deptname'];
                                //Getting Admin Detials
                                $admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
                                 //Instition Record
                                 $datas1=new classInstitution;
                                $record1=$datas1->institution();

                                foreach($record1 as $recordinstitution){
                                  $instilogo=trim($recordinstitution['instilogo']);
                                }


                              
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
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $fieldrecord['pincode']; ?>.
                                          <small class="pull-right">Date: <?php echo $odate; ?></small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                       
                       
                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col">
                         <img id="userimage" <?php if ($instilogo!="") {?> style="display: block" src="../images/logo/<?php echo $instilogo; ?>" <?php } ?> class="img img-responsive img-thumbnail" >
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col" align="right">
                          <h4><b>Admin Details:</b></h4>
                          <address>
                                          Updated by: <strong><?php echo $admindata['surname'] ." ".$admindata['othername']; ?></strong>
                                          <br><b>Date: </b><?php echo $fieldrecord['udate']; ?></strong>
                                          <br><b>Initial Insertion Date: </b><?php echo $fieldrecord['odate']; ?>
                                          
                                      </address>
                        </div>

                      
                      </div>
                      <!-- /.row -->


                   

                      <div class="row">
                       
                        <div class="col-xs-12">
                          <hr>
                          <center><p class="lead schoolhelpcolor"><b><?php echo $fieldrecord['pincode']; ?>   Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th>Department Name:</th>
                                  <td><?php echo $deptname; ?></td>
                                </tr>
                                <tr>
                                  <th >Student Name:</th>
                                  <td><?php echo $fullname; ?></td>
                                </tr>
                                 <tr>
                                  <th>Semester</th>
                                  <td><?php echo $semestername; ?></td>
                                </tr>
                                  <tr>
                                  <th>Session</th>
                                  <td><?php echo $sessionname; ?></td>
                                </tr>
                                 <tr>
                                  <th>Pin Code</th>
                                  <td><?php echo $fieldrecord['pincode']; ?></td>
                                </tr>
                                 <tr>
                                  <th>Expiry Date</th>
                                  <td><?php echo $fieldrecord['expirydate']; ?></td>
                                </tr>
                                 <tr>
                                  <th>No of Days</th>
                                  <td><?php echo $fieldrecord['duration']; ?></td>
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
                          <div class="col-xs-6"><button class="btn btn-success print-link" ><i class="fa fa-print"></i> Print</button></div>
                          <?php if ($settingedit_s==1) { ?>
                          <div class="col-xs-6"><a class="btn btn-primary "  href="?page=7&schoolhelp=<?php echo $schoolhelp; ?>&id=<?php echo $fieldrecord['pinid']; ?>"><i class="fa fa-edit"></i> Edit</a></div>
                          <?php  } ?>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
                <?php
               } 
              } 
            }?>
              </div>
            </div>
       <?php include("includes/footer.php"); ?>