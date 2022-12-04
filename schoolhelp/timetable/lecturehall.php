
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHtimetableOOP.php");
include_once("../phpclass/SHtimetableupdate.php");
include_once("../phpclass/SHtimetableinserts.php");
confirmcheckin();
$SHtimetableOOP=new classTimetable;
$pagename="Lecture Halls";

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
$hallname=isset($_POST['hallname'])?$_POST['hallname']:false;
$departmentid=trim(isset($_POST['departmentid'])?$_POST['departmentid']:false);


$state="Completely Unsuccessfully";

foreach($hallname as $typecount=>$typenames){

$name=trim(ucwords($typenames));
$description=trim(isset($_POST['description'.$typecount])?$_POST['description'.$typecount]:false);
$shortname=trim(isset($_POST['shortname'.$typecount])?$_POST['shortname'.$typecount]:false);
$capacity=trim(isset($_POST['capacity'.$typecount])?$_POST['capacity'.$typecount]:false);
$halltype=trim(isset($_POST['halltype'.$typecount])?$_POST['halltype'.$typecount]:false);

  
//Checking Whetter Exam type has been added
 $records=$SHtimetableOOP->alltimetableedit2('lecturehall', 'hallname', $name, 'departmentid', $departmentid);
    if (is_array($records)) {
       $sql="This ".$pagename." is found in the database";
    }
else{

$insertedrec+=1;
$state=$tableInsert->insert_9fields('lecturehall', 'departmentid', $departmentid, 'hallname', $name, 'description', $description, 'shortname', $shortname,  'halltype', $halltype, 'capacity', $capacity, 'operatorid', $schoolhelp, 'udate', $udate, 'odate', $odate);
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
  $lecturehallid=trim(isset($_POST['lecturehallid'])?$_POST['lecturehallid']:false);
  $hallname=trim(isset($_POST['hallname'])?$_POST['hallname']:false);
  $description=trim(isset($_POST['description'])?$_POST['description']:false);
  $departmentid=trim(isset($_POST['departmentid'])?$_POST['departmentid']:false);
  $shortname=trim(isset($_POST['shortname'])?$_POST['shortname']:false);
  $capacity=trim(isset($_POST['capacity'])?$_POST['capacity']:false);
  $halltype=trim(isset($_POST['halltype'])?$_POST['halltype']:false);
 
$state=$tableUpdate->update_sevenfields('lecturehall', 'lecturehallid', $lecturehallid, 'departmentid', $departmentid, 'hallname',  $hallname, 'description', $description, 'shortname', $shortname, 'capacity', $capacity, 'halltype', $halltype, 'operatorid', $schoolhelp);

$sql=$state.":: Update Made, affected records = 1";
 }

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
 
}


if ($page==6) {
   $sql="Criminal Suspected";
  if ($dashdelete_d==1) {
  
   $lecturehallid=trim(isset($_GET['id'])?$_GET['id']:false);
   //$photo=trim(isset($_GET['photo'])?$_GET['photo']:false);
   $tableUpdate= new updateTable;
    $state=$tableUpdate->delete_timetable('lecturehall', 'lecturehallid', $lecturehallid);

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
                          
                      <li><a href="#" data-toggle="modal" data-target="#myModal" ><i class="fa fa-plus"></i> Add Lecture Hall</a>
                      </li>
                      <?php } ?>
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> View Lecture Hall</a>
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
                          <th> Hall Name</th>
                          <th> Short Name</th>
                          <th> Capacity</th>
                          <th> Hall Type</th>
                          <th> Description</th>

                         
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
                              
                              $records=$SHtimetableOOP->alltimetable('lecturehall', 'lecturehallid', 'DESC');
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                $deptname="";
                                $departmentid="";
                                $k+=1;
                                $operatorid=trim($fieldrecord['operatorid']);
                               
                                $departmentid=trim($fieldrecord['departmentid']);
                                
                              //Getting Admin Detials
                              
                                 $adminrecords=$SHtimetableOOP->alltimetableedit('adminpersons', 'adminid', $operatorid);
                                  if (is_array($adminrecords)) {
                                 foreach($adminrecords as $adminrecord){
                                    $adminsurname=$adminrecord['surname'];
                                    $adminothername=$adminrecord['othername'];
                                 }
                               }

                                //collecting Department record
                             
                                     $deptrecords=$SHtimetableOOP->alltimetableedit('department', 'did', $departmentid);
                                     if (is_array($deptrecords)) {
                                     foreach($deptrecords as $deptrecord){
                                        $deptname=$deptrecord['deptname'];
                                        
                                     }
                                   }
                                 if ($admintype==0) {
                                 
                                if ($departmentid==$logindepartmentid) {
                                   $k1+=1;
                                ?>
                                      <tr>
                                          <td><?php echo $k1; ?></td>
                                        <td><?php echo  $deptname; ?></td>                               
                                        <td><?php echo  $fieldrecord['hallname']; ?></td>
                                        <td><?php echo  $fieldrecord['shortname']; ?></td>
                                        <td><?php echo  $fieldrecord['capacity']; ?></td>
                                        <td><?php if(trim($fieldrecord['halltype'])==1){ echo "General Hall"; }else{ echo "Department's"; } ?></td>
                                        <td><?php echo  $fieldrecord['description']; ?></td>
                                     
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['lecturehallid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                          <?php if ($dashedit_d==1) { ?>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['lecturehallid']; ?>')"><center><i class="fa fa-edit" style="color:#d2dc2a; font-size:2em"></i></center></button></td>
                                        <?php } ?>
                                         <?php if ($dashdelete_d==1) { ?>
                                        <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['lecturehallid']; ?>','');"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
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
                                        <td><?php echo  $deptname; ?></td>                               
                                        <td><?php echo  $fieldrecord['hallname']; ?></td>
                                        <td><?php echo  $fieldrecord['shortname']; ?></td>
                                        <td><?php echo  $fieldrecord['capacity']; ?></td>
                                        <td><?php if(trim($fieldrecord['halltype'])==1){ echo "General Hall"; }else{ echo "Department's"; } ?></td>
                                        <td><?php echo  $fieldrecord['description']; ?></td>
                                     
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['lecturehallid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                          <?php if ($dashedit_d==1) { ?>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['lecturehallid']; ?>')"><center><i class="fa fa-edit" style="color:#d2dc2a; font-size:2em"></i></center></button></td>
                                        <?php } ?>
                                         <?php if ($dashdelete_d==1) { ?>
                                        <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['lecturehallid']; ?>','');"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
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
                  <form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="frmmedtreatmentid"  class="form-horizontal form-label-left" >

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Select Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
                          <select  id="departmentid" required="required" name="departmentid" class="form-control col-md-7 col-xs-12" >
                            <option value="">--Select Department--</option>
                            <?php
                            $deptrecord=$SHtimetableOOP->alltimetable('department', 'did', "ASC");
                            if (is_array($deptrecord)) {
                           
                            foreach($deptrecord as $deptdata){
                              $departmentid=trim($deptdata['did']);
                              if ($admintype==0) {
                                  if ($departmentid==$logindepartmentid) {
                            ?>
                            <option value="<?php echo $departmentid; ?>"><?php echo $deptdata['deptname']; ?></option>
                            <?php 
                                }
                                  }//end of checking whether someone is a super
                                  else{ ?>
                              <option value="<?php echo $departmentid; ?>"><?php echo $deptdata['deptname']; ?></option>
                         <?php
                            }
                          } 

                            }?>
                          </select>
                        </div>
                      </div>

                     <?php $count=0; $u=1; while($numberoffields>=1){
                       $numberoffields-=1;  ?>
                       <?php echo $pagename; ?>  <?php echo $u; ?>
                       <hr>
                     <div class="form-group">
                        <label for="hallname" class="control-label col-md-3 col-sm-3 col-xs-12">Hall Name<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="hallname" class="form-control col-md-7 col-xs-12" placeholder="please enter lecture hall name" name="hallname[]" required="required" type="text">
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="hallname" class="control-label col-md-3 col-sm-3 col-xs-12">Short Name<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="shortname" class="form-control col-md-7 col-xs-12" placeholder="please Hall shortname eg AUD" name="shortname<?php echo $count; ?>" required="required" type="text">
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="hallname" class="control-label col-md-3 col-sm-3 col-xs-12">Capacity<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="shortname" class="form-control col-md-7 col-xs-12" placeholder="please Hall's Capacity, The number of student it can contain" name="capacity<?php echo $count; ?>" required="required" type="number">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="hallname" class="control-label col-md-3 col-sm-3 col-xs-12">Hall Type<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="halltype" class="form-control col-md-7 col-xs-12"  name="halltype<?php echo $count; ?>" >
                            <option value="">--Select Hall Type--</option>
                            <option value="0">Department's Hall</option>
                            <option value="1">Genereal Hall</option>
                          </select>
                        </div>
                      </div>

                        <div class="form-group">
                        <label for="description" class="control-label col-md-3 col-sm-3 col-xs-12">Description<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="description" class="form-control col-md-7 col-xs-12"  name="description<?php echo $count; ?>" placeholder="Please describe this kind of Lecture"></textarea>
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
                    $lecturehallid=trim(isset($_GET['id'])?$_GET['id']:false);
                   $records=$SHtimetableOOP->alltimetableedit('lecturehall', 'lecturehallid', $lecturehallid);
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                $description=trim($fieldrecord['description']);
                                $hallname=trim($fieldrecord['hallname']);
                                $departmentidrec=trim($fieldrecord['departmentid']);
                                $capacity=trim($fieldrecord['capacity']);
                                $shortname=trim($fieldrecord['shortname']);
                                $halltype=trim($fieldrecord['halltype']);

                          }

                          
                    }
                    ?>
                    
                    <div class="x_panel">

                      <fieldset>
                        <legend style="color:#063">Edit <?php echo $pagename ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="forminstitutionid"  class="form-horizontal form-label-left" >
                    <input id="lecturehallid" class="form-control col-md-7 col-xs-12" type="hidden" name="lecturehallid" required="required" value="<?php echo $lecturehallid; ?>">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Select Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
                          <select  id="departmentid" required="required" name="departmentid" class="form-control col-md-7 col-xs-12" >
                            <option value="">--Select Department--</option>
                            <?php
                            $deptrecord=$SHtimetableOOP->alltimetable('department', 'did', "ASC");
                             if (is_array($deptrecord)) {
                            foreach($deptrecord as $deptdata){
                              $departmentid=trim($deptdata['did']);
                              if ($admintype==0) {
                                  if ($departmentid==$logindepartmentid) {
                            ?>
                            <option value="<?php echo $departmentid; ?>" <?php if ($departmentidrec==$departmentid) {?> selected="selected" <?php } ?> ><?php echo $deptdata['deptname']; ?></option>
                            <?php 
                                }
                                  }//end of checking whether someone is a super
                                  else{ ?>
                              <option value="<?php echo $departmentid; ?>" <?php if ($departmentidrec==$departmentid) {?> selected="selected" <?php } ?>><?php echo $deptdata['deptname']; ?></option>
                         <?php
                            }
                          } 
                        } ?>
                          </select>
                        </div>
                      </div>

                    

                       <div class="form-group">
                        <label for="hallname" class="control-label col-md-3 col-sm-3 col-xs-12">Hall Name<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="hallname" class="form-control col-md-7 col-xs-12" placeholder="please enter Exam or Lecture or special training" name="hallname" required="required" type="text" value="<?php echo $hallname; ?>"  onblur="return updatevalidity1('lecturehall', 'Lecture type', '<?php echo $lecturehallid; ?>', 'lecturehallid', 'hallname', this.value, 'departmentid',  $('#departmentid').val(), 'updating', $(this).attr('id'));" >
                        </div>
                      </div>

                     <div class="form-group">
                       <label for="shortname" class="control-label col-md-3 col-sm-3 col-xs-12">shortname<span class="required">*</span></label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="shortname" class="form-control col-md-7 col-xs-12" placeholder="Enter shortcode of this hall" name="shortname" required="required" type="text" value="<?php echo $shortname; ?>"  >
                       </div>
                    </div>

                      <div class="form-group">
                       <label for="shortname" class="control-label col-md-3 col-sm-3 col-xs-12">Capacity<span class="required">*</span></label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="capacity" class="form-control col-md-7 col-xs-12" placeholder="Enter the capacity of this hall" name="capacity" required="required" type="number" value="<?php echo $capacity; ?>"  >
                       </div>
                    </div>

                     <div class="form-group">
                        <label for="hallname" class="control-label col-md-3 col-sm-3 col-xs-12">Hall Type<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="halltype" class="form-control col-md-7 col-xs-12"  name="halltype<?php echo $count; ?>" >
                            <option value="" i>--Select Hall Type--</option>
                            <option value="0" <?php if($halltype==0){ ?> selected="selected" <?php } ?>>Department's Hall</option>
                            <option value="1" <?php if($halltype==1){ ?> selected="selected" <?php } ?> >Genereal Hall</option>
                          </select>
                        </div>
                      </div>

                        <div class="form-group">
                        <label for="description" class="control-label col-md-3 col-sm-3 col-xs-12">Descripton<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="description" class="form-control col-md-7 col-xs-12"  name="description" placeholder="Please describe this Hall"><?php echo $description; ?></textarea>
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
                  $odate=date("Y-m-d");
                  $deptname="";
                   $lecturehallid=trim(isset($_GET['id'])?$_GET['id']:false);
                   $records=$SHtimetableOOP->alltimetableedit('lecturehall', 'lecturehallid', $lecturehallid);
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                $description=trim($fieldrecord['description']);
                                $hallname=trim($fieldrecord['hallname']);
                                $shortname=trim($fieldrecord['shortname']);
                                $capacity=trim($fieldrecord['capacity']);
                                $halltype=trim($fieldrecord['halltype']);
                                $operatorid=trim($fieldrecord['operatorid']);
                                $udate=trim($fieldrecord['udate']);
                                $odatet=trim($fieldrecord['odate']);
                                $departmentid=trim($fieldrecord['departmentid']);

                                 //collecting Department record
                             
                                     $deptrecords=$SHtimetableOOP->alltimetableedit('department', 'did', $departmentid);
                                     if (is_array($deptrecords)) {
                                     foreach($deptrecords as $deptrecord){
                                        $deptname=$deptrecord['deptname'];
                                        
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
                    <h3><?php echo $hallname; ?> Details </h3>
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
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $hallname ; ?>
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
                                  <th style="width:50%">Lecture Hall Name</th>
                                  <td><?php echo $hallname; ?></td>
                                </tr>
                                 <tr>
                                  <th style="width:50%">Short Name</th>
                                  <td><?php echo $shortname; ?></td>
                                </tr>
                                  <tr>
                                    <th style="width:50%">Hall Type</th>
                                  <td><?php if(trim($halltype)==1){ echo "General Hall"; }else{ echo "Department's"; } ?></td>
                                </tr>
                                 <tr>
                                    <th style="width:50%">Capacity</th>
                                    <td><?php echo $capacity; ?></td>
                                </tr>
                                  <tr>
                                  <th>Description</th>
                                  <td><?php echo $description; ?></td>
                                </tr>
                                <tr>
                                  <th>Department</th>
                                  <td><?php echo $deptname; ?></td>
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