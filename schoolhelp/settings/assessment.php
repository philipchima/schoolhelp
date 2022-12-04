
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/schoolhelpinserts.php");
include_once("../phpclass/schoolhelpupdate.php");
include_once("../phpclass/schoolhelpOOP.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Asssesment";

$odate=date("Y-m-d");

//calling of classes
//department Table
$deptclass=new classDepartment;
//grade table
$datas=new classAssessment;
//Admin Methods
$adminrecord=new Adminperson;

// Checking page access Authenticity
$schoolhelpsetting=new Allsettings;
$previlleges=$schoolhelpsetting->allsettingedit('adminpersons', 'adminid', $schoolhelp);
foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['assessment_s']);
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
  $departmentid=trim(isset($_POST['departmentid'])?$_POST['departmentid']:false);

 $assessmentarray=isset($_POST['assname'])?$_POST['assname']:false;
 $counting=0;
 foreach($assessmentarray as $dataindex => $assname){
  $assname=ucwords($assname);
 $asspercent=trim(isset($_POST['asspercent'][$dataindex])?$_POST['asspercent'][$dataindex]:false);
 $assdescription=trim(isset($_POST['assdescription'][$dataindex])?$_POST['assdescription'][$dataindex]:false);

 $tableassessment=new insertTable;
$state=$tableassessment->insert_assessment($departmentid, $assname, $asspercent, $assdescription, $schoolhelp, $odate);
$display=$state['action'];
$counting=$counting+$state['counting'];
}
 
$sql=$display.":: Insertion, affected records = ".$counting;

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}

if($page==4) {
  $assid=trim(isset($_POST['assid'])?$_POST['assid']:false);
 $assname=trim(ucwords(isset($_POST['assname'])?$_POST['assname']:false));
 
 $asspercent=trim(isset($_POST['asspercent'])?$_POST['asspercent']:false);
 $assdescription=trim(isset($_POST['assdescription'])?$_POST['assdescription']:false);
 
 $departmentid=trim(isset($_POST['departmentid'])?$_POST['departmentid']:false);

$tableassessment=new updateTable;
$state=$tableassessment->update_assessment($assid, $departmentid, $assname, $asspercent, $assdescription, $schoolhelp, $odate);

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
                    <h2 id="caption"><?php echo $pagename; ?></h2>
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
                      <div class="x_panel">
                         <fieldset>
                        <legend style="color:#063"><?php echo $pagename; ?> Record</legend>

                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                       <colgroup>
                        <col span="2">
                        
                        <col span="2" style="background-color:#e6ffe6">
                      </colgroup>
                      <thead>
                      
                        <tr>
                          <th>SN</th>
                          <th>Department</th>
                          <th>Name</th>
                          <th>Percentage</th>
                          <th>Description</th>
                         
                          
                         
                          <th style="width:10%;"><i class="fa fa-print" style="color:green"></i> Print</th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:red"></i> Edit</th>
                           <th>User<i class="fa fa-user"></i></th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                              
                              $records=$datas->assessment('desc');
                              if (isset($records)) {
                                
                              foreach($records as $fieldrecord){
                                $k+=1;
                                $fieldvalue=trim($fieldrecord['operatorid']);
                                $fieldvalue1=trim($fieldrecord['departmentid']);
                               //collecting department record
                              $deptmethod=$deptclass->departmentedit('did', $fieldvalue1);
                              $deptname=$deptmethod['deptname'];
                                //Getting Admin Detials
                                $admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
                                ?>
                                      <tr>
                                        <td><?php echo $k; ?></td>
                                        <td><?php echo  substr($deptname, 0, 12); ?></td>
                                        <td><?php echo  $fieldrecord['assname']; ?></td>
                                        <td><?php echo  substr($fieldrecord['asspercent'],0, 12); ?></td>  
                                        <td><?php echo  substr($fieldrecord['assdescription'],0, 12); ?></td>                       
                                     
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['assid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['assid']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
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

                    <?php if($page==1) {  
                      
                      ?>

                    <div class="x_panel">

                      <fieldset>
                        <legend style="color:#063">Add <?php echo $pagename; ?></legend>
                  <form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="formgradeid"  class="form-horizontal form-label-left" >
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Select Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
                          <select  id="departmentid" required="required" name="departmentid" class="form-control col-md-7 col-xs-12" onchange="addingfields('assessment', 'departmentid', 'department', 'did', 'assnum', this.value, 'checktwotables4');">
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
                    $assid=trim(isset($_GET['id'])?$_GET['id']:false);

                    
                    $record=$datas->assessmentedit('assid', $assid)
                    ?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Edit <?php echo $pagename; ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="formassessmentid"  class="form-horizontal form-label-left" >
                      <input type="hidden" name="assid" id="assid"  value="<?php echo $assid; ?>">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Select Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         
                          <select  id="departmentid" required="required" name="departmentid" class="form-control col-md-7 col-xs-12" >
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
                        <label for="assname" class="control-label col-md-3 col-sm-3 col-xs-12">Assessment Name<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="assname" value="<?php echo $record['assname']; ?>" id="assname" class="form-control col-md-7 col-xs-12" type="text"  required="required" placeholder="Example: Test, Exam" onchange="return updatevalidity1('assessment', 'assname', 'departmentid', this.value, $('#departmentid').val(),'updating', $(this).attr('id'));">
                        </div>
                      </div>
                     
                       <div class="form-group">
                        <label for="asspercent" class="control-label col-md-3 col-sm-3 col-xs-12">Assessment Percent</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                          <input name="asspercent" id="asspercent" value="<?php echo $record['asspercent']; ?>" class="form-control col-md-7 col-xs-12" type="text"  placeholder="Example: 40" onblur="excessvalcheck('assessment', 'assid', 'departmentid', $('#assid').val(), $('#departmentid').val(), 'asspercent', this.value, $(this).attr('id'), 'excessvalcheck');">
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <label for="assdescription" class="control-label col-md-3 col-sm-3 col-xs-12">Assessment Description</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="assdescription" id="assdescription" value="<?php echo $record['assdescription']; ?>" class="form-control col-md-7 col-xs-12" type="text"  placeholder="Describe the Assessment">
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
                  $gradeid=trim(isset($_GET['id'])?$_GET['id']:false);

                    //$datas=new classgrade;
                    $record=$datas->assementedit('gradeid', $gradeid);

                    //collecting department record
                    $fieldvalue=$record['departmentid'];
                    $deptmethod=$deptclass->departmentedit('did', $fieldvalue);
                    $deptname=$deptmethod['deptname'];

                    //Instition Record
                     $datas1=new classInstitution;
                    $record1=$datas1->institution();


                    foreach($record1 as $recordinstitution){
                      $instilogo=$recordinstitution['instilogo'];
                    }

                    //Getting Operators ID
                    $fieldvalue=trim($record['operatorid']);
                    
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
                          <center><p class="lead schoolhelpcolor"><b><?php echo $deptname; ?> <?php echo $page; ?> Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th>Department Name:</th>
                                  <td><?php echo $deptname; ?></td>
                                </tr>
                                <tr>
                                  <th >Assessment Name:</th>
                                  <td><?php echo $record['assname']; ?></td>
                                </tr>
                                <tr>
                                  <th>Assessment Percentage:</th>
                                  <td><?php echo $record['asspercent']; ?></td>
                                </tr>
                                <tr>
                                  <th>Assessment Description</th>
                                  <td><?php echo $record['assdescription']; ?></td>
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