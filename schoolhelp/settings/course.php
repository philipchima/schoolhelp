
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/schoolhelpinserts.php");
include_once("../phpclass/schoolhelpupdate.php");
include_once("../phpclass/schoolhelpOOP.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Course";

$odate=date("Y-m-d");

//calling of classes
//department Table
$optionclass=new classOption;
//department Table
$deptclass=new classDepartment;
//Level table
$levelclass=new classLevel;
//Admin Methods
$adminrecord=new Adminperson;
//institution Class
 $datas1=new classInstitution;
 //course Class
 $courseclass=new classCourse;
 //institution Class
 $semesterclass=new classSemester;

$schoolhelpsetting=new Allsettings;
$previlleges=$schoolhelpsetting->allsettingedit('adminpersons', 'adminid', $schoolhelp);
foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['course_s']);
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
  //getting array ofrecords
  $departmentid=trim(isset($_POST['departmentid'])?$_POST['departmentid']:false);
  $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
  $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);

 $csnamearray=isset($_POST['csname'])?$_POST['csname']:false;
 $counting=0;
 foreach($csnamearray as $dataindex => $csname){
 $csname=trim(ucwords($csname));
 $csdescription=trim(isset($_POST['csdescription'][$dataindex])?$_POST['csdescription'][$dataindex]:false);
 $cscourses=trim(isset($_POST['cscourses'][$dataindex])?$_POST['cscourses'][$dataindex]:false);
 $cscreditunit=trim(isset($_POST['cscreditunit'][$dataindex])?$_POST['cscreditunit'][$dataindex]:false);
 $cspassmark=trim(isset($_POST['cspassmark'][$dataindex])?$_POST['cspassmark'][$dataindex]:false);
 $semesterid=trim(isset($_POST['semesterid'][$dataindex])?$_POST['semesterid'][$dataindex]:false);
 
 
 $tablecourse=new insertTable;
$state=$tablecourse->insert_course($departmentid, $levelid, $optionid, $semesterid, $csname, $csdescription, $cscreditunit, $cspassmark, $schoolhelp, $odate);
$display=$state['action'];
$counting=$counting+$state['counting'];
}

$sql=$display.":: Insertion, affected records = ".$counting;

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}

if($page==4) {
  $csid=trim(isset($_POST['csid'])?$_POST['csid']:false);
  $departmentid=trim(isset($_POST['departmentid'])?$_POST['departmentid']:false);
  //$levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
  
  //$optionid=trim(isset($_POST['optid'])?$_POST['optid']:false);
  //$semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
$csname=trim(ucwords(isset($_POST['csname'])?$_POST['csname']:false));
 $csdescription=trim(isset($_POST['csdescription'])?$_POST['csdescription']:false);
 $cscourses=trim(isset($_POST['cscourses'])?$_POST['cscourses']:false);
 $cscreditunit=trim(isset($_POST['cscreditunit'])?$_POST['cscreditunit']:false);
 $cspassmark=trim(isset($_POST['cspassmark'])?$_POST['cspassmark']:false);
 //$semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
 

$tablecourse=new updateTable;
$state=$tablecourse->update_course($csid, $departmentid,  $csname, $csdescription, $cscreditunit, $cspassmark, $schoolhelp, $odate);

$sql=$state.":: Update Made, affected records = 1";
echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&state=$state&sql=$sql';
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
                         <li  ><a href="?page=1&schoolhelp=<?php echo $schoolhelp; ?>"  ><i class="fa fa-plus"></i>  Add Course</a>
                      </li>
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  View Course</a>
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
                          <th>Credit Unit</th>
                          <th>Passmark</th>
                          <th>Department</th>
                         
                          <th style="width:10%;"><i class="far fa-address-card" style="color:green"></i> Print</th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:red"></i> Edit</th>
                           <th>User<i class="fa fa-user"></i></th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                              
                              $records=$courseclass->course('desc');
                              if (isset($records)) {
                                
                              foreach($records as $fieldrecord){
                                $k+=1;
                                $fieldvalue=trim($fieldrecord['operatorid']);
                                $fieldvalue1=trim($fieldrecord['departmentid']);
                                $fieldvalue2=trim($fieldrecord['levelid']);
                                $fieldvalue3=trim($fieldrecord['optionid']);
                                $fieldvalue4=trim($fieldrecord['semesterid']);
                                
                              //Getting Admin Detials
                              $admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
                              //collecting department record
                              $deptmethod=$deptclass->departmentedit('did', $fieldvalue1);
                              $deptname=$deptmethod['deptname'];
                              //collecting level record
                              $levelmethod=$levelclass->leveledit('levelid', $fieldvalue2);
                              $levelname=$levelmethod['levelname'];
                              //collecting option record
                              $optionmethod=$optionclass->optionedit('optid', $fieldvalue3);
                              $optionname=$optionmethod['optname'];
                                //collecting semester record
                              $semestermethod=$semesterclass->semesteredit('semesterid', $fieldvalue4);
                              $semestername=$semestermethod['semestername'];
                                
                                ?>
                                      <tr>
                                        <td><?php echo $k; ?></td>
                                        <td><?php echo  substr($fieldrecord['csname'],0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['csdescription'],0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['cscreditunit'],0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['cspassmark'],0, 12); ?></td>
                                        <td><?php echo  substr($deptname,0, 12); ?></td>
                                        
                                     
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['csid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['csid']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
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

                    <?php if($page==1) {  
                      
                      ?>

                    <div class="x_panel">

                      <fieldset>
                        <legend style="color:#063">Add <?php echo $pagename ?></legend>
                  <form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="forminstitutionid"  class="form-horizontal form-label-left" >
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Select Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, element to append result, fieldid that will appear in the selection, fieldname that will appear in the selection)-->
                          <select  id="departmentid" required="required" name="departmentid" class="form-control col-md-7 col-xs-12"  onchange="addingfields('course', 'departmentid', 'department', 'did', 'subjnum', this.value, 'checktwotables2');">
                            <option value="">--Select Department--</option>
                            <?php
                            $deptrecord=$deptclass->department('asc');
                            foreach($deptrecord as $deptdata){
                            ?>
                            <option value="<?php echo $deptdata['did']; ?>"><?php echo $deptdata['deptname']; ?></option>
                            <?php } ?>
                          </select>


                        </div>
                      </div>
                    
                      <!--Beginning of collection-->
                      <div  id="opencontainer">
                      
                      </div>
                    </form>
                  </div>
                  </fieldset>
                 </div>
                 <?php } ?>

                  <?php 

                  if($page==3) {
                    $csid=trim(isset($_GET['id'])?$_GET['id']:false);

                    
                    $record=$courseclass->courseedit('csid', $csid)
                    ?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Edit <?php echo $pagename ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="forminstitutionid"  class="form-horizontal form-label-left" >
                      <input type="hidden" name="csid" value="<?php echo $csid; ?>">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Select Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         
                          <select  id="departmentid" required="required" name="departmentid" class="form-control col-md-7 col-xs-12" onchange="retrieveselection('level', 'departmentid', this.value, 0, 0, 'retrieveselection');">
                            <option value="">--Select Department--</option>
                            <?php
                            $deptrecord=$deptclass->department('asc');
                            $departmentid=$record['departmentid'];
                            foreach($deptrecord as $deptdata){
                            ?>
                            <option value="<?php echo $deptdata['did']; ?>" <?php  if($departmentid==$deptdata['did']){ ?> selected="selected" <?php } ?> ><?php echo $deptdata['deptname']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                                             
                     
                      <div class="form-group">
                       
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="csname">Course Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="csname" required="required" name="csname" class="form-control col-md-7 col-xs-12" value="<?php echo $record['csname']; ?> " placeholder="Please enter Option name here" onblur="return updatevalidity1('course', 'csname', 'departmentid', this.value, $('#departmentid').val(), 'inserting', $(this).attr('id'));">
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label for="csdescription" class="control-label col-md-3 col-sm-3 col-xs-12">Description<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="csdescription" class="form-control col-md-7 col-xs-12"  name="csdescription" required="required" placeholder="PLease Define this specialization"><?php echo $record['csdescription']; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="cscreditunit" class="control-label col-md-3 col-sm-3 col-xs-12">Credit Unit<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="cscreditunit" class="form-control col-md-7 col-xs-12" value="<?php echo $record['cscreditunit']; ?>"  name="cscreditunit" required="required" placeholder="PLease Enter the credit unit of this course">
                        </div>
                      </div>
                     
                       <div class="form-group">
                        <label for="cspassmark" class="control-label col-md-3 col-sm-3 col-xs-12">Passmark</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="cspassmark" class="form-control col-md-7 col-xs-12" type="number" value="<?php echo $record['cspassmark']; ?>" name="cspassmark" required="required"  placeholder="Please Enter the passmark">
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
                  $csid=trim(isset($_GET['id'])?$_GET['id']:false);

                    
                    $record=$courseclass->courseedit('csid', $csid);

                    //collecting department record
                    $fieldvalue=$record['departmentid'];
                    $deptmethod=$deptclass->departmentedit('did', $fieldvalue);
                    $deptname=$deptmethod['deptname'];

                   

                    //Instition Record
                    $record1=$datas1->institution();

                     
                    //collecting level record
                    $fieldvalue2=trim($record['levelid']);
                    $levelmethod=$levelclass->leveledit('levelid', $fieldvalue2);
                    $levelname=$levelmethod['levelname']; 

                    //collecting option record
                    $fieldvalue4=trim($record['optionid']);
                    $optionmethod=$optionclass->optionedit('optid', $fieldvalue4);
                    $optionname=$optionmethod['optname']; 

                     //collecting semester record
                    $fieldvalue5=trim($record['semesterid']);
                    $semestermethod=$semesterclass->semesteredit('semesterid', $fieldvalue5);
                    $semestername=$semestermethod['semestername']; 


                    foreach($record1 as $recordinstitution){
                      $instilogo=$recordinstitution['instilogo'];
                    }

                    //Getting Operators ID
                    $fieldvalue3=trim($record['operatorid']);
                    
                    $admindata=$adminrecord->adminpersons('adminid', $fieldvalue3);
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
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $record['csname']; ?>.
                                          <small class="pull-right">Date: <?php echo $odate; ?></small>
                                      </h1>
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
                                          Updated by: <strong><?php echo $admindata['surname'] ." ".$admindata['othername']; ?></strong>
                                          <br><b>Date: </b><?php echo $record['udate']; ?></strong>
                                          <br><b>Initial Insertion Date: </b><?php echo $record['odate']; ?>
                                          
                                      </address>
                        </div>

                      
                      </div>
                      <!-- /.row -->


                   

                      <div class="row">
                       
                        <div class="col-xs-12">
                          <hr>
                          <center><p class="lead schoolhelpcolor"><b><?php echo $record['csname']; ?> Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Name:</th>
                                  <td><?php echo $record['csname']; ?></td>
                                </tr>
                                <tr>
                                  <th>Desciption:</th>
                                  <td><?php echo $record['csdescription']; ?></td>
                                </tr>
                                 <tr>
                                  <th>Credit Unit:</th>
                                  <td><?php echo $record['cscreditunit']; ?></td>
                                </tr>
                                 <tr>
                                  <th>Passmark:</th>
                                  <td><?php echo $record['cspassmark']; ?></td>
                                </tr>
                                <tr>
                                  <th>Department</th>
                                  <td><?php echo $deptname; ?></td>
                                </tr>
                                <tr>
                                  <th>Level</th>
                                  <td><?php echo $levelname; ?></td>
                                </tr>
                                <tr>
                                  <th>Option</th>
                                  <td><?php echo $optionname; ?></td>
                                </tr>
                                <tr>
                                  <th>Semester</th>
                                  <td><?php echo $semestername; ?></td>
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