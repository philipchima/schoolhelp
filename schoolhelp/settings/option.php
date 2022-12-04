
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/schoolhelpinserts.php");
include_once("../phpclass/schoolhelpupdate.php");
include_once("../phpclass/schoolhelpOOP.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Option";
$schoolhelp=1;
$xdate=date("Y-m-d");

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


$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);



if($page==2) {
  //getting array ofrecords
  $departmentid=trim(isset($_POST['departmentid'])?$_POST['departmentid']:false);
  $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);

 $optnamearray=isset($_POST['optname'])?$_POST['optname']:false;
 $counting=0;
 foreach($optnamearray as $dataindex => $optname){
 $optname=trim(ucwords($optname));
 $optdescription=trim(isset($_POST['optdescription'][$dataindex])?$_POST['optdescription'][$dataindex]:false);
 $optcourses=trim(isset($_POST['optcourses'][$dataindex])?$_POST['optcourses'][$dataindex]:false);
 $optpriority=trim(isset($_POST['optpriority'][$dataindex])?$_POST['optpriority'][$dataindex]:false);
 
 $tableOption=new insertTable;
$state=$tableOption->insert_option($departmentid, $levelid, $optname, $optdescription, $optcourses, $optpriority, $schoolhelp, $xdate);
$display=$state['action'];
$counting=$counting+$state['counting'];
}

$sql=$display.":: Insertion, affected records = ".$counting;

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}

if($page==4) {
  
  $departmentid=trim(isset($_POST['departmentid'])?$_POST['departmentid']:false);
  $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
  $optid=trim(isset($_POST['optid'])?$_POST['optid']:false);

$optname=trim(ucwords(isset($_POST['optname'])?$_POST['optname']:false));
 $optdescription=trim(isset($_POST['optdescription'])?$_POST['optdescription']:false);
$optcourses=trim(isset($_POST['optcourses'])?$_POST['optcourses']:false);
 $optpriority=trim(isset($_POST['optpriority'])?$_POST['optpriority']:false);
 

$tableoption=new updateTable;
$state=$tableoption->update_option($optid, $departmentid, $levelid, $optname, $optdescription, $optcourses, $optpriority, $schoolhelp, $xdate);

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
                    <h2 id="caption">Option</h2>
                    <ul class="nav navbar-right panel_toolbox" style="">
                      <li><a class="btn btn-primary" href="../?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                      <li><a class="btn btn-success " href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"> Settings</i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                         <li  ><a href="?page=1&schoolhelp=<?php echo $schoolhelp; ?>"  ><i class="fa fa-plus"></i>  Add Option</a>
                      </li>
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  View Option</a>
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
                        <legend style="color:#063">Option Record</legend>

                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Name</th>
                          <th>Description</th>
                          <th>Priority</th>
                          <th>No of Courses</th>
                          <th>Department</th>
                          <th>Level</th>
                          
                          <th style="width:10%;"><i class="far fa-address-card" style="color:green"></i> Print</th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:red"></i> Edit</th>
                           <th>User<i class="fa fa-user"></i></th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                              
                              $records=$optionclass->option('desc');
                              if (isset($records)) {
                                
                              foreach($records as $fieldrecord){
                                $k+=1;
                                $fieldvalue=trim($fieldrecord['operatorid']);
                                $fieldvalue1=trim($fieldrecord['departmentid']);
                                $fieldvalue2=trim($fieldrecord['levelid']);
                                
                              //Getting Admin Detials
                              $admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
                              //collecting department record
                              $deptmethod=$deptclass->departmentedit('did', $fieldvalue1);
                              $deptname=$deptmethod['deptname'];
                              //collecting level record
                              $levelmethod=$levelclass->leveledit('levelid', $fieldvalue2);
                              $levelname=$levelmethod['levelname'];
                                
                                ?>
                                      <tr>
                                        <td><?php echo $k; ?></td>
                                        <td><?php echo  substr($fieldrecord['optname'],0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['optdescription'],0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['optpriority'],0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['optcourses'],0, 12); ?></td>
                                        <td><?php echo  substr($deptname,0, 12); ?></td>
                                        <td><?php echo  substr($levelname,0, 12); ?></td>

                                     
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['optid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['optid']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
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

                    <?php if($page==1) {  
                      
                      ?>

                    <div class="x_panel">

                      <fieldset>
                        <legend style="color:#063">Add Option</legend>
                  <form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="forminstitutionid"  class="form-horizontal form-label-left" >
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Select Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with)-->
                          <select  id="departmentid" required="required" name="departmentid" class="form-control col-md-7 col-xs-12" onchange="retrieveselection('level', 'departmentid', this.value, 0, 0, 'retrieveselection');">
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
                      <!--Bring selection button-->
                      <div id="levelselection">
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
                    $optid=trim(isset($_GET['id'])?$_GET['id']:false);

                    
                    $record=$optionclass->optionedit('optid', $optid)
                    ?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Edit <?php echo $pagename ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="forminstitutionid"  class="form-horizontal form-label-left" >
                      <input type="hidden" name="optid" value="<?php echo $optid; ?>">

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
                       
                     
                       <!--Bring selection button-->
                      <div id="levelselection">
                          <div class="form-group">
                       
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="levelname">Level Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select  id="levelid" required="required" name="levelid" class="form-control col-md-7 col-xs-12" onchange="retrieveselection('level', 'departmentid', this.value, 0, 0, 'retrieveselection');">
                            <option value="">--Select Level--</option>
                            <?php
                           
                            $levelid=$record['levelid'];
                             $levelrecord=alltblselection('level', 'departmentid', $departmentid);
                            foreach($levelrecord as $leveldata){
                            ?>
                            <option value="<?php echo $leveldata['levelid']; ?>" <?php  if($levelid==$leveldata['levelid']){ ?> selected="selected" <?php } ?> ><?php echo $leveldata['levelname']; ?></option>
                            <?php } ?>
                          </select>
                           </div>
                      </div>
                      </div>
                     
                     <div class="form-group">
                       
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="optname">Option Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="optname" value="<?php echo $record['optname']; ?>"  required="required" name="optname" class="form-control col-md-7 col-xs-12" placeholder="Please enter Option name here" onblur="return updatevalidity1('optiontable', 'optname', 'levelid', this.value, $('#levelid').val(), 'updating', $(this).attr('id'));">
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label for="optdescription" class="control-label col-md-3 col-sm-3 col-xs-12">Description<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="optdescription" class="form-control col-md-7 col-xs-12"  name="optdescription" required="required" placeholder="PLease Define this specialization"><?php echo $record['optdescription']; ?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="optcourses" class="control-label col-md-3 col-sm-3 col-xs-12">No of Courses<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="optcourses"  class="form-control col-md-7 col-xs-12"  name="optcourses" value="<?php echo $record['optcourses']; ?>" required="required" placeholder="PLease Enter Number of Courses offering">
                        </div>
                      </div>
                     
                       <div class="form-group">
                        <label for="optpriority" class="control-label col-md-3 col-sm-3 col-xs-12">Priority</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="optpriority" class="form-control col-md-7 col-xs-12" type="number" name="optpriority" value="<?php echo $record['optpriority']; ?>"   placeholder="Prioritize the option, 1 for most prioritize">
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
                  $optid=trim(isset($_GET['id'])?$_GET['id']:false);

                    
                    $record=$optionclass->optionedit('optid', $optid);

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
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $record['optname']; ?>.
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
                          <center><p class="lead schoolhelpcolor"><b><?php echo $record['optname']; ?> Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Name:</th>
                                  <td><?php echo $record['optname']; ?></td>
                                </tr>
                                <tr>
                                  <th>Desciption:</th>
                                  <td><?php echo $record['optdescription']; ?></td>
                                </tr>
                                 <tr>
                                  <th>No of Courses:</th>
                                  <td><?php echo $record['optcourses']; ?></td>
                                </tr>
                                 <tr>
                                  <th>Priority:</th>
                                  <td><?php echo $record['optpriority']; ?></td>
                                </tr>
                                <tr>
                                  <th>Department Name:</th>
                                  <td><?php echo $deptname; ?></td>
                                </tr>
                                <tr>
                                  <th>Level</th>
                                  <td><?php echo $levelname; ?></td>
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