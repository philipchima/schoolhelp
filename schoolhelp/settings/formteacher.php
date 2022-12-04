
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/schoolhelpinserts.php");
include_once("../phpclass/schoolhelpupdate.php");
include_once("../phpclass/schoolhelpdelete.php");
include_once("../phpclass/schoolhelpOOP.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Form Teacher";

$odate=date("Y-m-d");
$schoolhelpDH=new Allsettings;
// Checking page access Authenticity

$previlleges=$schoolhelpDH->allsettingedit('adminpersons', 'adminid', $schoolhelp);
foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['formteacher_s']);
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

if($page==1) {
  //$numberoffields=trim(isset($_POST['numberoffields'])?$_POST['numberoffields']:false);
}

if($page==2) {
  //getting array ofrecords
 $staffid=trim(isset($_POST['staffid'])?$_POST['staffid']:false);
 
 $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
 $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);
 
 //checking Whether someone has been assign to this group

 $formt=$schoolhelpDH->allsettingedit('formteacher', 'optionid', $optionid);
    if (is_array($formt)) {
        foreach($formt as $formtrecord){
        $optionid1=$formtrecord['optionid'];
        $staffid1=$formtrecord['staffid'];
         $levelid1=$formtrecord['levelid'];
        }

         //collecting option record
                             
          $optionrecords=$schoolhelpDH->allsettingedit('optiontable', 'optid', $optionid1);
            if (is_array($optionrecords)) {
                foreach($optionrecords as $optionrecord){
                    $optionname=$optionrecord['optname'];
                  }
               }

         $staffrecords1=$schoolhelpDH->allsettingedit('staff', 'staffid', $staffid1);
                if (is_array($staffrecords1)) {
                      foreach($staffrecords1 as $staffrecord1){
                       $staffsurname1=$staffrecord1['surname'];
                       $staffothername1=$staffrecord1['othername'];
                        }
                  }

                  //collecting level record
                             
                                  $levelrecords=$schoolhelpDH->allsettingedit('level', 'levelid', $levelid1);
                                  if (is_array($levelrecords)) {
                                 foreach($levelrecords as $levelrecord){
                                    $levelname=$levelrecord['levelname'];
                                    $departmentid=$levelrecord['departmentid'];
                                   }
                                 }

                   $sql=$staffsurname1.' '. $staffothername1.' has been assigned already to '.$levelname.' => '.$optionname;
                   
                        echo "<script>
                      window.location.href='?schoolhelp=$schoolhelp&sql=$sql&page=1';
                    </script>";
           }//End confirming whether array is set
           else{

            $signaturename ="";
            $target_dir ="";
              //Checking whether logo was uploaded(browsed)
              $signature=$_FILES["signature"]["name"];
               if($signature!=""){
                  $target_dir = "../images/signatures/formteacher/";
                  $signaturetmp=$_FILES['signature']['tmp_name']; 
                $temp = explode(".", $_FILES["signature"]["name"]);
                $signaturename =$staffid.round(microtime(true)) . '.' . end($temp);

                }


              $tableDepartment=new insertTable;
              $state=$tableDepartment->insert_formteacher($staffid, $levelid, $optionid, $signaturename, $schoolhelp, $odate);
              $display=$state['action'];
              $insertedrow=$state['counting'];
               if ($insertedrow>0) {
                move_uploaded_file($_FILES["signature"]["tmp_name"], $target_dir . $signaturename);
              }


              $sql=$display.":: Insertion, affected records = ".$insertedrow;
            
                          echo "<script>
                      window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
                    </script>";
           }

}

if($page==4) {

  $formteacherid=trim(isset($_POST['formteacherid'])?$_POST['formteacherid']:false);
  $signatureold=trim(isset($_POST['signatureold'])?$_POST['signatureold']:false);
   $staffid=trim(isset($_POST['staffid'])?$_POST['staffid']:false);
 
 $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
 $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);
 
 //checking Whether someone has been assign to this group
$counter="";
 $formt=$schoolhelpDH->allsettingedit('formteacher', 'optionid', $optionid);
    if (is_array($formt)) {
        foreach($formt as $counter => $formtrecord){
        $optionid1=$formtrecord['optionid'];
        $staffid1=$formtrecord['staffid'];
         $levelid1=$formtrecord['levelid'];
        }
      }
        if ($counter>1) {
        
         //collecting option record
                             
          $optionrecords=$schoolhelpDH->allsettingedit('optiontable', 'optid', $optionid1);
            if (is_array($optionrecords)) {
                foreach($optionrecords as $optionrecord){
                    $optionname=$optionrecord['optname'];
                  }
               }

         $staffrecords1=$schoolhelpDH->allsettingedit('staff', 'staffid', $staffid1);
                if (is_array($staffrecords1)) {
                      foreach($staffrecords1 as $staffrecord1){
                       $staffsurname1=$staffrecord1['surname'];
                       $staffothername1=$staffrecord1['othername'];
                        }
                  }

                  //collecting level record
                             
                                  $levelrecords=$schoolhelpDH->allsettingedit('level', 'levelid', $levelid1);
                                  if (is_array($levelrecords)) {
                                     foreach($levelrecords as $levelrecord){
                                        $levelname=$levelrecord['levelname'];
                                        $departmentid=$levelrecord['departmentid'];
                                       }
                                 }

                   $sql=$staffsurname1.' '. $staffothername1.' has been assigned already to '.$levelname.' => '.$optionname;
                   
                        echo "<script>
                      window.location.href='?schoolhelp=$schoolhelp&sql=$sql&page=4&id=$formteacherid';
                    </script>";
                  
           }//End confirming whether array is set
           else{

          $signature=$_FILES["signature"]["name"];
           if($signature!=""){
              $target_dir = "../images/signatures/formteacher/";
              $signaturetmp=$_FILES['signature']['tmp_name']; 
            $temp = explode(".", $_FILES["signature"]["name"]);
            $signaturename =$staffid.round(microtime(true)) . '.' . end($temp);
           move_uploaded_file($_FILES["signature"]["tmp_name"], $target_dir . $signaturename);
            @unlink($target_dir.$signatureold);
            }else{
              $signaturename=$signatureold;
            }

              $tableDepartment=new updateTable;
              $state=$tableDepartment->update_formteacher($formteacherid, $staffid, $levelid, $optionid, $signaturename, $schoolhelp);
             $sql=$state.":: Update Made, affected records = 1";
               
           
                    echo "<script>
                      window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
                    </script>";
           }

  

}
if ($page==6) {
  $formteacherid=trim(isset($_GET['id'])?$_GET['id']:false);
    $signature=trim(isset($_GET['passport'])?$_GET['passport']:false);
   
   $schoolhelpDHd= new TblDeleterow;
    $state=$schoolhelpDHd->delete_setting('formteacher', 'formteacherid', $formteacherid);

        $sql=$state.":: Deletion Made, affected records = 1";
          if ($state=="Success") {
                 $target_dir = "../images/signatures/formteacher/";
                 if ( $signature!="") {
                  unlink($target_dir.$signature);
                 }
                  
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
                          <th>Signature</th>
                          <th>Staff</th>
                           <th>Department</th>
                          <th>Level</th>
                          <th>Option</th>
                        
                         
                          <th style="width:10%;"><i class="far fa-address-card" style="color:green"></i> Print</th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:yellow"></i> Edit</th>
                          <th style="width:10%;"><i class="fa fa-trash" style="color:red"></i> Delete</th>
                           <th>User<i class="fa fa-user"></i></th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                              
                              $records=$schoolhelpDH->allsetting('formteacher', 'formteacherid', 'ASC');
                             $staffsurname="";
                              $staffothername="";
                              if (is_array($records)) {
                                $adminrecord=new Adminperson;
                              foreach($records as $fieldrecord){
                                $k+=1;
                                 $staffid=$fieldrecord['staffid'];
                                 $levelid=$fieldrecord['levelid'];
                                 $optionid=$fieldrecord['optionid'];
                                 //collecting staff record
                             
                                 $staffrecords=$schoolhelpDH->allsettingedit('staff', 'staffid', $staffid);
                                   if (is_array($staffrecords)) {
                                     foreach($staffrecords as $staffrecord){
                                      $staffsurname=$staffrecord['surname'];
                                      $staffothername=$staffrecord['othername'];
                                   }
                                 }

                                 //collecting level record
                             
                                  $levelrecords=$schoolhelpDH->allsettingedit('level', 'levelid', $levelid);
                                  if (is_array($levelrecords)) {
                                 foreach($levelrecords as $levelrecord){
                                    $levelname=$levelrecord['levelname'];
                                    $departmentid=$levelrecord['departmentid'];
                                   }
                                 }
                                  //collecting department record
                             
                                 $departmentrecords=$schoolhelpDH->allsettingedit('department', 'did', $departmentid);
                                 if (is_array($departmentrecords)) {
                                 foreach($departmentrecords as $departmentrecord){
                                    $departmentname=$departmentrecord['deptname']; 
                                 }
                               }

                              
                              //collecting option record
                             
                                    $optionrecords=$schoolhelpDH->allsettingedit('optiontable', 'optid', $optionid);
                                    if (is_array($optionrecords)) {
                                 foreach($optionrecords as $optionrecord){
                                    $optionname=$optionrecord['optname'];
                                   }
                                 }

                                $fieldvalue=trim($fieldrecord['operatorid']);
                                $admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
                                ?>
                                      <tr>
                                        <td><?php echo $k; ?></td>
                                        <td style="width:8%"><img src="../images/signatures/formteacher/<?php echo $fieldrecord['signature'];  ?>" class="img img-responsive img-rounded"></td>
                                        <td><?php echo  substr($staffsurname.' '. $staffothername, 0, 16); ?></td>
                                        <td><?php echo  substr($departmentname,0, 12); ?></td>
                                        <td><?php echo  substr($levelname, 0, 12); ?></td>
                                        <td><?php echo  substr($optionname,0, 12); ?></td>
                                        
                                     
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['formteacherid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['formteacherid']; ?>')"><center><i class="fa fa-edit" style="color:yellow; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['formteacherid']; ?>','<?php echo $fieldrecord['signature']; ?>');"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
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
                  <form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="formteacherid"  class="form-horizontal form-label-left" >

                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Staff</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" list="staffnames" id="staffname"   class="form-control col-md-7 col-xs-12" placeholder="Please type and select Staff name" required="required" onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'staffid');">

                        <datalist id="staffnames">

                            <?php
                             $records=$schoolhelpDH->allsetting('staff', 'staffid', 'ASC');
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                           
                            ?>
                            <option data-value="<?php echo $fieldrecord['staffid']; ?>"  value="<?php echo $fieldrecord['surname'].' '.$fieldrecord['othername']; ?>">
                            <?php } 
                          }?>
                           </datalist>
                           <input name="staffid" id="staffid" class="form-control col-md-7 col-xs-12" type="hidden"  required="required"  >
                        </div>
                      </div>


                          <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Level<span class="required">*</span>
                                </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                       <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
                                   <select  name="levelid" id="levelid" required="required"  class="form-control col-md-6 col-xs-12" onchange="retrieveselection1('optiontable', 'levelid', this.value, 0, 0, 'retrieveselection4', 'retrieveselection4');">
                                          <option value="">--Select Level--</option>
                                   <?php
                                      $retrievedata=$schoolhelpDH->allsetting('level', 'levelid', 'ASC');
                                      if (isset($retrievedata)) {
                                           foreach($retrievedata as $field){
                                              $departmentid=$field['departmentid'];
                                              $departmentrecords=$schoolhelpDH->allsettingedit('department', 'did', $departmentid);
                                               if (is_array($departmentrecords)) {
                                               foreach($departmentrecords as $departmentrecord){
                                                  $departmentname=$departmentrecord['deptname']; 
                                               }
                                             }
                                          ?>
                                            <option value="<?php echo $field['levelid']; ?>"><?php echo $field['levelname']." => ".$departmentname; ?></option>
                                      <?php
                                          }
                                        }?>
                                          </select>
                                       </div>
                                  </div>

                                    <!--Bring course selection button-->
                      <div id="retrieveselection4">
                       
                      <div class="form-group">
                        <label for="optionid" class="control-label col-md-3 col-sm-3 col-xs-12">Option<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="file-field">
                             <select name="optionid" id="optionid" class="form-control col-md-6 col-xs-12" required="required">
                            <option value="">--Selection Option--</option>
                          </select>
                        </div>
                      </div>

                      </div>
                    </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Signature<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="file-field">
                            <img src="" height="100" width="100" id="showimage"/>
                              <input type="file" name="signature"  id="signature" class="form-control col-md-7 col-xs-12"  onchange="readURL(this, $(this).attr('id'),  'showimage');">
                        </div>
                      </div>
                      <p id="error1" style="display:none; color:#FF0000;">
                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                        </p>
                        <p id="error2" style="display:none; color:#FF0000;">
                        Maximum File Size Limit is 1MB.
                        </p>
                    </div>
                     <p id="error1" style="display:none; color:#FF0000;">
                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                        </p>
                        <p id="error2" style="display:none; color:#FF0000;">
                        Maximum File Size Limit is 1MB.
                        </p>
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

                  <?php if($page==3) {
                    $formteacherid=trim(isset($_GET['id'])?$_GET['id']:false);
                     $records=$schoolhelpDH->allsettingedit('formteacher', 'formteacherid', $formteacherid);
                             
                              if (is_array($records)) {
                                $adminrecord=new Adminperson;
                              foreach($records as $fieldrecord){
                                
                                 $staffid=$fieldrecord['staffid'];
                                 $levelid=$fieldrecord['levelid'];
                                 $optionid=$fieldrecord['optionid'];
                                 //$odatet=$fieldrecord['odate'];
                                 //$udate=$fieldrecord['udate'];
                                 //collecting staff record
                             
                                 $staffrecords=$schoolhelpDH->allsettingedit('staff', 'staffid', $staffid);
                                   if (is_array($staffrecords)) {
                                     foreach($staffrecords as $staffrecord){
                                      $staffsurname=$staffrecord['surname'];
                                      $staffothername=$staffrecord['othername'];
                                   }
                                 }

                                 //collecting level record
                             
                                  $levelrecords=$schoolhelpDH->allsettingedit('level', 'levelid', $levelid);
                                  if (is_array($levelrecords)) {
                                 foreach($levelrecords as $levelrecord){
                                    $levelname=$levelrecord['levelname'];
                                    $departmentid=$levelrecord['departmentid'];
                                   }
                                 }
                                  //collecting department record
                             
                                 $departmentrecords=$schoolhelpDH->allsettingedit('department', 'did', $departmentid);
                                 if (is_array($departmentrecords)) {
                                 foreach($departmentrecords as $departmentrecord){
                                    $departmentname=$departmentrecord['deptname']; 
                                 }
                               }

                              
                              //collecting option record
                             
                                    $optionrecords=$schoolhelpDH->allsettingedit('optiontable', 'optid', $optionid);
                                    if (is_array($optionrecords)) {
                                 foreach($optionrecords as $optionrecord){
                                    $optionname=$optionrecord['optname'];
                                   }
                                 }

                                $fieldvalue=trim($fieldrecord['operatorid']);
                                $admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
                   
                    ?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Edit teacher</legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="formteacherid"  class="form-horizontal form-label-left" >
                      <input type="hidden" name="formteacherid" value="<?php echo $formteacherid; ?>">
                      <input type="hidden" name="signatureold" value="<?php echo $fieldrecord['signature']; ?>">
                       <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Staff</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" list="staffnames" id="staffname"   class="form-control col-md-7 col-xs-12" <?php if ($staffsurname!="" or $staffothername!=""){ ?> value="<?php echo $staffsurname.' '.$staffothername; ?>" <?php } ?> placeholder="Please type and select Staff name" required="required" onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'staffid');">

                        <datalist id="staffnames">

                            <?php
                             $records=$schoolhelpDH->allsetting('staff', 'staffid', 'ASC');
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord1){
                           
                            ?>
                            <option data-value="<?php echo $fieldrecord1['staffid']; ?>"  value="<?php echo $fieldrecord1['surname'].' '.$fieldrecord1['othername']; ?>">
                            <?php } 
                          }?>
                           </datalist>
                           <input name="staffid" id="staffid" class="form-control col-md-7 col-xs-12" type="hidden"  required="required"  value="<?php echo $staffid; ?>">
                        </div>
                      </div>


                          <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Level<span class="required">*</span>
                                </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                       <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
                                   <select  name="levelid" id="levelid" required="required"  class="form-control col-md-6 col-xs-12" onchange="retrieveselection1('optiontable', 'levelid', this.value, 0, 0, 'retrieveselection4', 'retrieveselection4');">
                                          <option value="">--Select Level--</option>
                                   <?php
                                      $retrievedata=$schoolhelpDH->allsetting('level', 'levelid', 'ASC');
                                      if (isset($retrievedata)) {
                                           foreach($retrievedata as $field){
                                              $departmentid=$field['departmentid'];
                                              $departmentrecords=$schoolhelpDH->allsettingedit('department', 'did', $departmentid);
                                               if (is_array($departmentrecords)) {
                                               foreach($departmentrecords as $departmentrecord){
                                                  $departmentname=$departmentrecord['deptname']; 
                                               }
                                             }
                                          ?>
                                            <option value="<?php echo $field['levelid']; ?>"  <?php if ($field['levelid']==$levelid){ ?> selected="selected" <?php } ?>><?php echo $field['levelname']." => ".$departmentname; ?></option>
                                      <?php
                                          }
                                        }?>
                                          </select>
                                       </div>
                                  </div>

                                    <!--Bring course selection button-->
                      <div id="retrieveselection4">
                           
                       <div class="form-group">
                                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Option|Arm|Group<span class="required">*</span>
                                 </label>
                                 <div class="col-md-6 col-sm-6 col-xs-12">
                                   <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
                               <select  name="optionid" id="optionid" required="required"  class="form-control col-md-6 col-xs-12" >
                                 <option value="">--Select Option|Arm|Group--</option>
                        <?php  
                        $retrievedata1=$schoolhelpDH->allsettingedit('optiontable', 'levelid', $levelid);
                        if (is_array($retrievedata1)) {
                          foreach($retrievedata1 as $field1){
                        ?>
                              <option value="<?php echo $field1['optid']; ?>" <?php if ($field1['optid']==$optionid){ ?> selected="selected" <?php } ?> ><?php echo $field1['optname']; ?></option>
                        <?php
                            }
                          }?>
                              </select>
                            </div>
                          </div>
                     

                      </div>
                    

                      <div class="form-group">

                         
                        <label for="photo" class="control-label col-md-3 col-sm-3 col-xs-12">Signature</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <img <?php if ($fieldrecord['signature']!="") {?> src="../images/signatures/formteacher/<?php echo $fieldrecord['signature']; ?>" style="display: block"<?php }  ?> height="100" width="100"   id="showimage"  />
                          <input name="signature" id="signature" type="file" class="form-control col-md-7 col-xs-12" onchange="readURL(this, $(this).attr('id'),  'showimage');">

                        </div>
                      </div>
                      <p id="error1" style="display:none; color:#FF0000;">
                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                        </p>
                        <p id="error2" style="display:none; color:#FF0000;">
                        Maximum File Size Limit is 1MB.
                        </p>
                    </div>
                     <p id="error1" style="display:none; color:#FF0000;">
                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                        </p>
                        <p id="error2" style="display:none; color:#FF0000;">
                        Maximum File Size Limit is 1MB.
                        </p>
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
                <?php }}
              } ?>

                <?php if ($page==5) {
                  $formteacherid=trim(isset($_GET['id'])?$_GET['id']:false);

                    $records=$schoolhelpDH->allsettingedit('formteacher', 'formteacherid', $formteacherid);
                             
                              if (is_array($records)) {
                                $adminrecord=new Adminperson;
                              foreach($records as $fieldrecord){
                                
                                 $staffid=$fieldrecord['staffid'];
                                 $levelid=$fieldrecord['levelid'];
                                 $optionid=$fieldrecord['optionid'];
                                 //$odatet=$fieldrecord['odate'];
                                 //$udate=$fieldrecord['udate'];
                                 //collecting staff record
                             
                                 $staffrecords=$schoolhelpDH->allsettingedit('staff', 'staffid', $staffid);
                                   if (is_array($staffrecords)) {
                                     foreach($staffrecords as $staffrecord){
                                      $staffsurname=$staffrecord['surname'];
                                      $staffothername=$staffrecord['othername'];
                                   }
                                 }

                                 //collecting level record
                             
                                  $levelrecords=$schoolhelpDH->allsettingedit('level', 'levelid', $levelid);
                                  if (is_array($levelrecords)) {
                                 foreach($levelrecords as $levelrecord){
                                    $levelname=$levelrecord['levelname'];
                                    $departmentid=$levelrecord['departmentid'];
                                   }
                                 }
                                  //collecting department record
                             
                                 $departmentrecords=$schoolhelpDH->allsettingedit('department', 'did', $departmentid);
                                 if (is_array($departmentrecords)) {
                                 foreach($departmentrecords as $departmentrecord){
                                    $departmentname=$departmentrecord['deptname']; 
                                 }
                               }

                              
                              //collecting option record
                             
                                    $optionrecords=$schoolhelpDH->allsettingedit('optiontable', 'optid', $optionid);
                                    if (is_array($optionrecords)) {
                                 foreach($optionrecords as $optionrecord){
                                    $optionname=$optionrecord['optname'];
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
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $levelname.' => '.$optionname; ?>
                                          <small class="pull-right">Date: <?php echo $odate; ?></small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                       
                       
                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col">
                         <img id="userimage" <?php if ( $fieldrecord['signature']!="") {?> style="display: block" src="../images/signatures/formteacher/<?php echo $fieldrecord['signature'] ?>" <?php } ?> class="img img-responsive img-thumbnail" >
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
                          <center><p class="lead schoolhelpcolor"><b> <?php echo $levelname.' => '.$optionname; ?> Details</p></b></center>
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
                                  <th>Level:</th>
                                  <td><?php echo $levelname; ?></td>
                                </tr>
                                <tr>
                                  <th>Option:</th>
                                  <td><?php echo $optionname; ?></td>
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
                          <div class="col-xs-6"><a class="btn btn-primary "  href="?page=3&schoolhelp=<?php echo $schoolhelp; ?>&id=<?php echo $fieldrecord['formteacherid']; ?>"><i class="fa fa-edit"></i> Edit</a></div>
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