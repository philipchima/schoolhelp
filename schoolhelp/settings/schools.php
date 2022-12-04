
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/schoolhelpinserts.php");
include_once("../phpclass/schoolhelpupdate.php");
include_once("../phpclass/schoolhelpOOP.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Department";
confirmcheckin();


$xdate=date("Y-m-d");
$datas=new classDepartment;
//Admin Methods
$adminrecord=new Adminperson;


$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

// Checking page access Authenticity
$schoolhelpsetting=new Allsettings;
$previllages=$schoolhelpsetting->allsettingedit('adminpersons', 'adminid', $schoolhelp);
foreach($previllages as $actualrecord){
  $pageaccess=trim($actualrecord['department_s']);
  $settingedit_s=trim($actualrecord['settingedit_s']);
  $settingdelete_s=trim($actualrecord['settingdelete_s']);
  $settingadd_s=trim($actualrecord['settingadd_s']);
}
if ($pageaccess!=1) {
  echo "<b style='font-size:100; color:red'>Criminal Attempt Made, contact the admin ask for the access of this page</b>";
  exit();
}

if($page==1) {
  $numberoffields=trim(isset($_POST['numberoffields'])?$_POST['numberoffields']:false);
}

if($page==2) {
  //getting array ofrecords
$departments=isset($_POST['departmentname'])?$_POST['departmentname']:false;

foreach($departments as $deptcount=>$departmentname){
$departmentname=trim(ucwords($departmentname));
$description=trim(isset($_POST['description'.$deptcount])?$_POST['description'.$deptcount]:false);
$years=trim(isset($_POST['years'.$deptcount])?$_POST['years'.$deptcount]:false);
$grades=trim(isset($_POST['grades'.$deptcount])?$_POST['grades'.$deptcount]:false);
$assnum=trim(isset($_POST['assnum'.$deptcount])?$_POST['assnum'.$deptcount]:false);
$signnum=trim(isset($_POST['signnum'.$deptcount])?$_POST['signnum'.$deptcount]:false);
$subjnum=trim(isset($_POST['subjnum'.$deptcount])?$_POST['subjnum'.$deptcount]:false);
$tableDepartment=new insertTable;
$state=$tableDepartment->insert_department($departmentname, $years, $grades, $assnum, $signnum, $subjnum, $description, $schoolhelp, $xdate);
}
$sql=$state.":: Insertion Made, affected records = ".count($departments);
echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&state=$state&sql=$sql';
      </script>";
}

if($page==4) {
  
$departmentname=trim(isset($_POST['departmentname'])?$_POST['departmentname']:false);
$description=trim(isset($_POST['description'])?$_POST['description']:false);
$years=trim(isset($_POST['years'])?$_POST['years']:false);
$grades=trim(isset($_POST['grades'])?$_POST['grades']:false);
$assnum=trim(isset($_POST['assnum'])?$_POST['assnum']:false);
$signnum=trim(isset($_POST['signnum'])?$_POST['signnum']:false);
$subjnum=trim(isset($_POST['subjnum'])?$_POST['subjnum']:false);

$did=trim(isset($_POST['did'])?$_POST['did']:false);
$tableDepartment=new updateTable;
$state=$tableDepartment->update_department($did, $departmentname, $years, $grades, $assnum, $signnum, $subjnum, $description, $schoolhelp, $xdate);

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
                    <h2 id="caption">Department</h2>
                    <ul class="nav navbar-right panel_toolbox" style="">
                      <li><a class="btn btn-primary" href="../?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                      <li><a class="btn btn-success " href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"> Settings</i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                         <li  ><a href="#" data-toggle="modal" data-target="#myModal" ><i class="fa fa-plus"></i>  Add School</a>
                      </li>
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  View School</a>
                      </li>
                        </ul>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div style="color:#063" <?php if ($state=="failed") {?> style="color:red" <?php } ?> ><b><?php echo $sql; ?></b></div>

                  
                    <?php if ($page=="") {?>
                      <div class="x_panel">
                         <fieldset>
                        <legend style="color:#063">Department Record</legend>
                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Department</th>
                          <th>Description</th>
                          <th>No of Years</th>
                          <th>No of Grades</th>
                          <th>No of Assessment</th>
                          <th>No of Signatories</th>
                          <th>No of Subjects</th>
                         
                           <th style="width:10%;"><i class="far fa-address-card" style="color:green"></i> Print</th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:red"></i> Edit</th>
                           <th>User<i class="fa fa-user"></i></th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0;
                              $datas=new classDepartment; 
                              $records=$datas->department('desc');
                              $adminrecord= new Adminperson;

                              if (isset($records)) {
                               
                              foreach($records as $fieldrecord){
                                $fieldvalue=trim($fieldrecord['adminid']);
                               
                                $admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
                              $adminname= $admindata['surname']. " ".$admindata['othername'] ;
                                $k+=1;
                                ?>
                                      <tr>
                                        <td><?php echo $k; ?></td>
                                        <td><?php echo  $fieldrecord['deptname']; ?></td>
                                        <td><?php echo  $fieldrecord['description']; ?></td>
                                        <td><?php echo  $fieldrecord['years']; ?></td>
                                        <td><?php echo  $fieldrecord['grades']; ?></td>
                                        <td><?php echo  $fieldrecord['assnum']; ?></td>
                                        <td><?php echo  $fieldrecord['signnum']; ?></td>
                                        <td><?php echo  $fieldrecord['subjnum']; ?></td>
                                       
                                        <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['did']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['did']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
                                           <td ><span class="btn-group">
                                            <center><button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-user"></i> Details<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu">
                                            <li ><span>Update by</span> : <?php echo  $admindata['surname']. " ".$admindata['othername'] ; ?></li>
                                            <li><span>Upate Date</span> : <?php echo  $fieldrecord['sdate']; ?></li>
                                            <li><span>Initial Date</span> : <?php echo  $fieldrecord['xdate']; ?></li>
                                            
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
                        <legend style="color:#063">Add Department</legend>
                  <form action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST" id="schools" data-parsley-validate class="form-horizontal form-label-left" onSubmit="return updatevalidity('department', 'deptname', this.value, 'updating', $(this).attr('id'));">

                     <?php $count=0; while($numberoffields>=1){
                       $numberoffields-=1; 

                       ?>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Name of Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="departmentname<?php echo $count; ?>" name="departmentname[]" required="required" class="form-control col-md-7 col-xs-12" onblur="updatevalidity('department', 'deptname', this.value, 'inserting', $(this).attr('id'));">
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Years<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number"  name="years<?php echo $count; ?>" class="form-control col-md-7 col-xs-12" required="required" placeholder="Enter number of years allocated for this department; eg: 1 or 2 or 3,4,5...">  
                          
                        </div>
                      </div>

                     
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="description<?php echo $count; ?>" class="form-control col-md-7 col-xs-12"></textarea>  
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="grades">Grades<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="grades"  name="grades<?php echo $count; ?>" class="form-control col-md-7 col-xs-12" required="required" placeholder="Enter number of grades obtainable for this department; eg: 1 or 2 or 3,4,5...">  
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">No of Assessment<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" name="assnum<?php echo $count; ?>" id="assnum"   class="form-control col-md-7 col-xs-12" required="required" placeholder="Enter number of Assessment obtainable for this department; eg: 1 or 2 or 3,4,5...">  
                        </div>
                      </div>
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="signnum">No of Signatories<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" name="signnum<?php echo $count; ?>" id="signnum"   class="form-control col-md-7 col-xs-12" required="required" placeholder="Enter number of Signatories involved in this department; eg: 1 or 2 or 3,4,5...">  
                        </div>

                      </div>

                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="signnum">No of Subject<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" name="subjnum<?php echo $count; ?>" id="subjnum"   class="form-control col-md-7 col-xs-12" required="required" placeholder="Enter number of Subjects taught in this department; eg: 1 or 2 or 3,4,5...">  
                        </div>
                        
                      </div>
                       <hr>
                      <?php $count+=1; } ?>
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
                    $did=trim(isset($_GET['id'])?$_GET['id']:false);

                    $datas=new classDepartment;
                    $record=$datas->departmentedit('did', $did)
                    ?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Edit Department</legend>
                  <form action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST" id="schools" data-parsley-validate class="form-horizontal form-label-left">

                       <input type="hidden" id="did" name="did" value="<?php echo $did ?>" required="required" >
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Name of Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="departmentname" name="departmentname" value="<?php echo $record['deptname'] ?>" required="required" class="form-control col-md-7 col-xs-12" onblur="return updatevalidity('department', 'deptname', this.value, 'updating', $(this).attr('id'));" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Years<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" value="<?php echo $record['years'] ?>" name="years" class="form-control col-md-7 col-xs-12" required="required" placeholder="Enter number of years allocated for this department; eg: 1 or 2 or 3,4,5...">  
                         </div>
                      </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="description" class="form-control col-md-7 col-xs-12"><?php echo $record['description'] ?></textarea>  
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="grades">Grades<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" name="grades" value="<?php echo $record['grades']; ?>"  class="form-control col-md-7 col-xs-12" required="required" placeholder="Enter number of grades obtainable for this department; eg: 1 or 2 or 3,4,5...">  
                          
                        </div>
                      </div>
                     
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="assnum">No of Assessment<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" name="assnum" id="assnum" value="<?php echo $record['assnum']; ?>" class="form-control col-md-7 col-xs-12" required="required" placeholder="Enter number of Assessment obtainable for this department; eg: 1 or 2 or 3,4,5...">  
                        </div>
                      </div>
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="signnum">No of Signatories<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" name="signnum" id="signnum"   class="form-control col-md-7 col-xs-12" required="required" placeholder="Enter number of Signatories involved in this department; eg: 1 or 2 or 3,4,5..." value="<?php echo $record['signnum']; ?>">  
                        </div>
                      </div>
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="signnum">No of Subject<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" name="subjnum" id="subjnum"  class="form-control col-md-7 col-xs-12" required="required" placeholder="Enter number of Subjects taught in this department; eg: 1 or 2 or 3,4,5..." value="<?php echo $record['subjnum']; ?>">  
                        </div>
                      </div>
                       <hr>
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
                  $deptid=trim(isset($_GET['id'])?$_GET['id']:false);

                    //$datas=new classdepartment;
                    $record=$datas->departmentedit('did', $deptid);
                    $deptname=$record['deptname'];
                    //Instition Record
                     $datas1=new classInstitution;
                    $record1=$datas1->institution();


                    foreach($record1 as $recordinstitution){
                      $instilogo=$recordinstitution['instilogo'];
                    }

                    //Getting Operators ID
                    $fieldvalue=trim($record['adminid']);
                    
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
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $deptname; ?>.
                                          <small class="pull-right">Date: <?php echo $xdate; ?></small>
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
                                          <br><b>Date: </b><?php echo $record['sdate']; ?></strong>
                                          <br><b>Initial Insertion Date: </b><?php echo $record['xdate']; ?>
                                          
                                      </address>
                        </div>

                      
                      </div>
                      <!-- /.row -->

                      <div class="row">
                       
                        <div class="col-xs-12">
                          <hr>
                          <center><p class="lead schoolhelpcolor"><b><?php echo $deptname; ?> Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th>Department Name:</th>
                                  <td><?php echo $deptname; ?></td>
                                </tr>
                                <tr>
                                  <th >Description:</th>
                                  <td><?php echo $record['description']; ?></td>
                                </tr>
                                <tr>
                                  <th>No of Years:</th>
                                  <td><?php echo $record['years']; ?></td>
                                </tr>
                                <tr>
                                  <th>No of Grade</th>
                                  <td><?php echo $record['grades']; ?></td>
                                </tr>
                                 <tr>
                                  <th>No of Assessment</th>
                                  <td><?php echo $record['assnum']; ?></td>
                                </tr>
                                 <tr>
                                  <th>No of Signatories</th>
                                  <td><?php echo $record['signnum']; ?></td>
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