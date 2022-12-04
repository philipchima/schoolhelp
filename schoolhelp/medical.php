
<?php 
include_once("includes/global.php");
include_once("includes/connection.php");
include_once("phpclass/SHdashOOP.php");
include_once("phpclass/SHdashupdate.php");
include_once("phpclass/SHdashinserts.php");
confirmcheckin();
$SHDashOOP=new classDash;
$pagename="Medical";

$tableUpdate= new updateTable;
$tableInsert=new insertTable;

$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Medical";

$odate=date("Y-m-d");



 //Staff class


$previllages=$SHDashOOP->alldashedit('adminpersons', 'adminid', $schoolhelp);
foreach($previllages as $actualrecord){
  $pageaccess=trim($actualrecord['medical_d']);
  $dashedit_d=trim($actualrecord['dashedit_d']);
  $dashdelete_d=trim($actualrecord['dashdelete_d']);
  $dashadd_d=trim($actualrecord['dashadd_d']);
}
if ($pageaccess!=1) {
  echo "<b style='font-size:100; color:red'>Criminal Attempt Made, contact the admin ask for the access of this page</b>";
  exit();
}

$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);


//Select current term/semester
        $semesterdata=$SHDashOOP->alldashedit('semesters','status', 1);
            if (is_array($semesterdata)) {
                foreach($semesterdata as $semesterrecord){
                    $semestername=$semesterrecord['semestername'];
                    $semesterid=trim($semesterrecord['semesterid']);
                    
              }
          }


        //Select current Session
         $sessiondata=$SHDashOOP->alldashedit('session','status', 1);
            if (is_array($sessiondata)) {
                foreach($sessiondata as $sessiondrecord){
                    $sessionname=$sessiondrecord['sessionlow']."/".$sessiondrecord['sessionhigh'];
                    $sessionid=trim($sessiondrecord['sessionid']);    
              }
          }


if($page==2) {
  $counting=0;
  $staffid=trim(isset($_POST['staffid'])?$_POST['staffid']:false);
  $stid=trim(isset($_POST['stid'])?$_POST['stid']:false);
  $diagnosis=trim(isset($_POST['diagnosis'])?$_POST['diagnosis']:false);
  $symptoms=trim(isset($_POST['symptoms'])?$_POST['symptoms']:false);
  $treatment=trim(isset($_POST['treatment'])?$_POST['treatment']:false);
  $dateoftreatment=trim(isset($_POST['dateoftreatment'])?$_POST['dateoftreatment']:false);
  $amount=trim(isset($_POST['amount'])?$_POST['amount']:false);
 
$state=$tableInsert->insert_11fields('medicaltreatment', 'staffid', $staffid, 'stid', $stid, 'diagnosis', $diagnosis, 'symptoms', $symptoms, 'treatment', $treatment, 'dateoftreatment', $dateoftreatment, 'amount', $amount, 'semesterid', $semesterid, 'sessionid', $sessionid, 'operatorid', $schoolhelp, 'odate', $odate);

$sql=$state.":: Insertion, affected records = 1";


echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}

if($page==4) {
   
   $medicaltreatmentid=trim(isset($_POST['medicaltreatmentid'])?$_POST['medicaltreatmentid']:false);
   $staffid=trim(isset($_POST['staffid'])?$_POST['staffid']:false);
  $stid=trim(isset($_POST['stid'])?$_POST['stid']:false);
  $diagnosis=trim(isset($_POST['diagnosis'])?$_POST['diagnosis']:false);
  $symptoms=trim(isset($_POST['symptoms'])?$_POST['symptoms']:false);
  $treatment=trim(isset($_POST['treatment'])?$_POST['treatment']:false);
  $dateoftreatment=trim(isset($_POST['dateoftreatment'])?$_POST['dateoftreatment']:false);
  $amount=trim(isset($_POST['amount'])?$_POST['amount']:false);
 

$tableUpdate=new updateTable;
$state=$tableUpdate->update_eightfields('medicaltreatment', 'medicaltreatmentid', $medicaltreatmentid, 'staffid',  $staffid, 'stid', $stid, 'diagnosis', $diagnosis, 'symptoms', $symptoms, 'treatment', $treatment, 'dateoftreatment', $dateoftreatment, 'amount', $amount, 'operatorid', $schoolhelp);

$sql=$state.":: Update Made, affected records = 1";

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}

if ($page==6) {
  
   $medicaltreatmentid=trim(isset($_GET['id'])?$_GET['id']:false);
   //$photo=trim(isset($_GET['photo'])?$_GET['photo']:false);
   $tableUpdate= new updateTable;
    $state=$tableUpdate->delete_dash('medicaltreatment', 'medicaltreatmentid', $medicaltreatmentid);

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
                      <li><a class="btn btn-primary" href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                      <li><a class="btn btn-success " href="settings?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"> Settings</i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                         <li  ><a href="?page=1&schoolhelp=<?php echo $schoolhelp; ?>"  ><i class="fa fa-plus"></i> Add Case</a>
                      </li>
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> View Cases</a>
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
                         
                          <th> Staff</th>
                          <th> Student</th>
                           <th>Diagnosis</th>
                          <th>Symptoms</th>
                          <th>Treatment</th>
                          <th>Amount</th>
                          <th>Date of Treatment</th>
                         
                          <th style="width:10%;"><i class="fa fa-address-card" style="color:green"></i> Print</th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:red"></i> Edit</th>
                          <th><i class="fa fa-trash" style="color:red"></i> Delete</th>
                          <th>User<i class="fa fa-user"></i></th>
                          
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                              $staffid="";
                              $symptoms="";
                              $diagnosis="";
                              $treatment="";
                              $semestername="";
                              $staffsurname="";
                              $staffothername="";
                              $studentsurname="";
                              $studentothername="";
                              $dateoftreatment="";
                              
                              $records=$SHDashOOP->alldash('medicaltreatment', 'medicaltreatmentid', 'DESC');
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                $k+=1;
                                $operatorid=trim($fieldrecord['operatorid']);
                                $stid=trim($fieldrecord['stid']);
                              
                                $staffid=trim($fieldrecord['staffid']);
                                
                              //Getting Admin Detials
                              //$admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
                                 $adminrecords=$SHDashOOP->alldashedit('adminpersons', 'adminid', $operatorid);
                                  if (is_array($adminrecords)) {
                                 foreach($adminrecords as $adminrecord){
                                    $adminsurname=$adminrecord['surname'];
                                    $adminothername=$adminrecord['othername'];
                                 }
                               }
                              //collecting staff record
                             
                                 $staffrecords=$SHDashOOP->alldashedit('staff', 'staffid', $staffid);
                                 if (is_array($staffrecords)) {
                                    foreach($staffrecords as $staffrecord){
                                    $staffsurname=$staffrecord['surname'];
                                    $staffothername=$staffrecord['othername'];
                                  }
                                 }
                                
                                  $studentrecords=$SHDashOOP->alldashedit('students', 'stid', $stid);
                                 if (is_array($studentrecords)) {
                                    foreach($studentrecords as $studentrecord){
                                    $studentsurname=$studentrecord['surname'];
                                    $studentothername=$studentrecord['othername'];
                                  }
                                 }

                 
                                ?>
                                      <tr>
                                          <td><?php echo $k; ?></td>
                                        <td><?php echo  substr($staffsurname.' '.$staffothername, 0, 12); ?></td>
                                        <td><?php echo  substr($studentsurname.' '.$studentothername, 0, 20); ?></td>
                                      
                                        <td><?php echo  substr($fieldrecord['diagnosis'], 0, 12); ?></td>
                                        <td><?php echo   substr($fieldrecord['symptoms'], 0, 12); ?></td>
                                        <td><?php echo   substr($fieldrecord['treatment'], 0, 12); ?></td>
                                        <td><?php echo   substr($fieldrecord['amount'], 0, 12); ?></td>
                                        <td><?php echo   substr($fieldrecord['dateoftreatment'], 0, 12); ?></td>
                                     
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['medicaltreatmentid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['medicaltreatmentid']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['medicaltreatmentid']; ?>','');"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
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
                  <form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="frmmedtreatmentid"  class="form-horizontal form-label-left" >

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Nurse (Staff)<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         
                           <input type="text" list="staffnames" id="staffname" class="form-control col-md-7 col-xs-12" placeholder="Please type and select staff name " onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'staffid');">

                        <datalist id="staffnames">

                            <?php
                             $records=$SHDashOOP->alldash('staff', 'staffid', 'ASC');
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="staffid">Patience (Student)<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         
                       <input type="text" list="studentnames" id="studentname" class="form-control col-md-7 col-xs-12" placeholder="Please type and select student name " onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'stid');">

                        <datalist id="studentnames">

                            <?php
                             $records=$SHDashOOP->alldash('students', 'stid', 'ASC');
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                           
                            ?>
                            <option data-value="<?php echo $fieldrecord['stid']; ?>"  value="<?php echo $fieldrecord['surname'].' '.$fieldrecord['othername']; ?>">
                            <?php } 
                          }?>
                           </datalist>
                           <input id="stid" class="form-control col-md-7 col-xs-12" type="hidden" name="stid" >
                        </div>
                      </div>

                     <div class="form-group">
                        <label for="diagnosis" class="control-label col-md-3 col-sm-3 col-xs-12">Diagnosis<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="diagnosis" class="form-control col-md-7 col-xs-12" placeholder="please state the result of test conducted" name="diagnosis" required="required"></textarea>
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="diagnosis" class="control-label col-md-3 col-sm-3 col-xs-12">Symptoms<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="symptoms" class="form-control col-md-7 col-xs-12" placeholder="please describe symptoms observed" name="symptoms" required="required"></textarea>
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="diagnosis" class="control-label col-md-3 col-sm-3 col-xs-12">Treatment<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="treatment" class="form-control col-md-7 col-xs-12" placeholder="please describe treatment given" name="treatment" required="required"></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Treatment Amount<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input name="amount" id="amount" class="form-control col-md-7 col-xs-12" type="text"  required="required" placeholder="Amount spent on treatment"> 
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="otherrname" class="control-label col-md-3 col-sm-3 col-xs-12">Date of Incident<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="dateoftreatment" id="dateoftreatment" class="form-control col-md-7 col-xs-12" type="date"  required="required" value="">
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
                    $medicaltreatmentid=trim(isset($_GET['id'])?$_GET['id']:false);
                   $records=$SHDashOOP->alldashedit('medicaltreatment', 'medicaltreatmentid', $medicaltreatmentid);
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                $diagnosis=trim($fieldrecord['diagnosis']);
                                $symptoms=trim($fieldrecord['symptoms']);
                                $treatment=trim($fieldrecord['treatment']);
                                $dateoftreatment=trim($fieldrecord['dateoftreatment']);
                                $amount=trim($fieldrecord['amount']);
                                $operatorid=trim($fieldrecord['operatorid']);
                                $staffid=trim($fieldrecord['staffid']);
                                $stid=trim($fieldrecord['stid']);
                                $odatet=trim($fieldrecord['odate']);
                                $udate=trim($fieldrecord['udate']);
                          }

                          //collecting staff record
                             
                                     $staffrecords=$SHDashOOP->alldashedit('staff', 'staffid', $staffid);
                                     if (is_array($staffrecords)) {
                                     foreach($staffrecords as $staffrecord){
                                        $staffsurname=$staffrecord['surname'];
                                        $staffothername=$staffrecord['othername'];
                                       
                                     }
                                   }

                                   //collecting staff record
                                   $studentrecords=$SHDashOOP->alldashedit('students', 'stid', $stid);
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
                    <input id="medicaltreatmentid" class="form-control col-md-7 col-xs-12" type="hidden" name="medicaltreatmentid" required="required" value="<?php echo $medicaltreatmentid; ?>">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid"><?php echo $pagename ?> Chief(Staff)<span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         
                           <input type="text" list="staffnames" id="staffname" class="form-control col-md-7 col-xs-12"  value="<?php echo $staffsurname.' '.$staffothername; ?>" placeholder="Please type and select staff name " onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'staffid');">

                        <datalist id="staffnames">

                            <?php
                             $records=$SHDashOOP->alldash('staff', 'staffid', 'ASC');
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
                         
                       <input type="text" list="studentnames" id="studentname" class="form-control col-md-7 col-xs-12" placeholder="Please type and select student name " onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'stid');"   value="<?php echo $studentsurname.' '.$studentothername; ?>">

                        <datalist id="studentnames">

                            <?php
                             $records=$SHDashOOP->alldash('students', 'stid', 'ASC');
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                           
                            ?>
                            <option data-value="<?php echo $fieldrecord['stid']; ?>"  value="<?php echo $fieldrecord['surname'].' '.$fieldrecord['othername']; ?>">
                            <?php } 
                          }?>
                           </datalist>
                           <input id="stid" class="form-control col-md-7 col-xs-12" type="hidden" name="stid" value="<?php echo $stid; ?>">
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="diagnosis" class="control-label col-md-3 col-sm-3 col-xs-12">Diagnosis<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="diagnosis" class="form-control col-md-7 col-xs-12"  name="diagnosis" required="required"><?php echo $diagnosis; ?></textarea>
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="symptoms" class="control-label col-md-3 col-sm-3 col-xs-12">Symptoms<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="symptoms" class="form-control col-md-7 col-xs-12"  name="symptoms" required="required"><?php echo $symptoms; ?></textarea>
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="treatment" class="control-label col-md-3 col-sm-3 col-xs-12">Treatment<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="treatment" class="form-control col-md-7 col-xs-12"  name="treatment" required="required"><?php echo $treatment; ?></textarea>
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="amount" class="control-label col-md-3 col-sm-3 col-xs-12">Amount Spent<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="amount" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo $amount; ?>"  name="amount" required="required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="amount" class="control-label col-md-3 col-sm-3 col-xs-12">Date of Incident<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="dateoftreatment" type="date" class="form-control col-md-7 col-xs-12" value="<?php echo $dateoftreatment; ?>"  name="dateoftreatment" required="required">
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
                  $medicaltreatmentid=trim(isset($_GET['id'])?$_GET['id']:false);
                   
                              $stid="";
                              
                              $staffid="";
                              $hddescription="";
                              $diagnosis="";
                              $records=$SHDashOOP->alldashedit('medicaltreatment', 'medicaltreatmentid', $medicaltreatmentid);
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                               $diagnosis=trim($fieldrecord['diagnosis']);
                                $symptoms=trim($fieldrecord['symptoms']);
                                $treatment=trim($fieldrecord['treatment']);
                                $dateoftreatment=trim($fieldrecord['dateoftreatment']);
                                $amount=trim($fieldrecord['amount']);
                                $operatorid=trim($fieldrecord['operatorid']);
                                $staffid=trim($fieldrecord['staffid']);
                                $stid=trim($fieldrecord['stid']);
                                $odatet=trim($fieldrecord['odate']);
                                $udate=trim($fieldrecord['udate']);

                                $semesterid=trim($fieldrecord['semesterid']);
                                $sessionid=trim($fieldrecord['sessionid']);
                                $sessionname="";
                                $semestername="";

                              //Select current term/semester
                              $semesterdata=$SHDashOOP->alldashedit('semesters','semesterid', $semesterid);
                                  if (is_array($semesterdata)) {
                                      foreach($semesterdata as $semesterrecord){
                                          $semestername=$semesterrecord['semestername'];
                                          $semesterid=trim($semesterrecord['semesterid']);
                                          
                                    }
                                }


                              //Select current Session
                               $sessiondata=$SHDashOOP->alldashedit('session', 'sessionid', $sessionid);
                                  if (is_array($sessiondata)) {
                                      foreach($sessiondata as $sessiondrecord){
                                          $sessionname=$sessiondrecord['sessionlow']."/".$sessiondrecord['sessionhigh'];
                                          $sessionid=trim($sessiondrecord['sessionid']);    
                                    }
                                }

                               //Getting Admin Detials
                              
                                 $adminrecords=$SHDashOOP->alldashedit('adminpersons', 'adminid', $operatorid);
                                 foreach($adminrecords as $adminrecord){
                                    $adminsurname=$adminrecord['surname'];
                                    $adminothername=$adminrecord['othername'];
                                 }

                              //collecting staff record
                             
                                     $staffrecords=$SHDashOOP->alldashedit('staff', 'staffid', $staffid);
                                     if (is_array($staffrecords)) {
                                     foreach($staffrecords as $staffrecord){
                                        $staffsurname=$staffrecord['surname'];
                                        $staffothername=$staffrecord['othername'];
                                       // $staffpassport=$staffrecord['passport'];
                                     }
                                   }

                                   //collecting staff record
                                   $studentrecords=$SHDashOOP->alldashedit('students', 'stid', $stid);
                                   if (is_array($studentrecords)) {
                                  
                                   foreach($studentrecords as $studentrecord){
                                      $studentsurname=$studentrecord['surname'];
                                      $studentothername=$studentrecord['othername'];
                                      $levelid=trim($studentrecord['levelid']);
                                     
                                   }
                                   
                                  }    


                                  $record2=$SHDashOOP->alldashedit('level', 'levelid', $levelid);

                                   if (is_array($record2)) {
                                  foreach($record2 as $recorddept){
                                    $departmentid=$recorddept['departmentid'];
                                  }
                                }     
                                  
                                  //Instition Record
                                  
                                  $record1=$SHDashOOP->alldashedit('institution', 'departmentid', $departmentid);

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
                    <h3><?php echo $studentsurname.' '. $studentothername; ?> Treatment Details </h3>
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
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $diagnosis ; ?>
                                          <small class="pull-right">Date: <?php echo $odate; ?></small>
                                      </h3>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                       
                       
                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col">
                         <img id="userimage" <?php if ($instilogo!="") {?> style="display: block" src="images/logo/<?php echo $instilogo ?>" <?php } ?> class="img img-responsive img-thumbnail" >
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
                          <center><p class="lead schoolhelpcolor"><b><?php echo $studentsurname.' '. $studentothername; ?> Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Staff Name(Medical Personnel)</th>
                                  <td><?php echo $staffsurname.' '. $staffothername; ?></td>
                                </tr>
                                  <tr>
                                  <th>Student (Patience)</th>
                                  <td><?php echo $studentsurname.' '. $studentothername; ?></td>
                                </tr>
                                <tr>
                                  <th>Diagnosis (Laboratory Result) or Presumptions</th>
                                  <td><?php echo $diagnosis; ?></td>
                                </tr>
                                <tr>
                                  <th>Symptoms of Sickness</th>
                                  <td><?php echo $symptoms; ?></td>
                                </tr>   
                                <tr>
                                  <th>Treatment</th>
                                  <td><?php echo $treatment; ?></td>
                                </tr>  
                                <tr>
                                  <th>Amount spent on Medication</th>
                                  <td><?php echo $amount; ?></td>
                                </tr>  
                                <tr>
                                  <th>Date of Treatment</th>
                                  <td><?php echo $dateoftreatment; ?></td>
                                </tr>   
                                <tr>
                                  <th>Semester/Term</th>
                                  <td><?php echo $semestername; ?></td>
                                </tr> 
                                 <tr>
                                  <th>Session </th>
                                  <td><?php echo $sessionname; ?></td>
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