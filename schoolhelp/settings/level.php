
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/schoolhelpinserts.php");
include_once("../phpclass/schoolhelpupdate.php");
include_once("../phpclass/schoolhelpOOP.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Level";

$xdate=date("Y-m-d");

//calling of classes
//department Table
$deptclass=new classDepartment;
//Level table
$datas=new classLevel;
//Admin Methods
$adminrecord=new Adminperson;


$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

if($page==1) {
  //$numberoffields=trim(isset($_POST['numberoffields'])?$_POST['numberoffields']:false);
}

if($page==2) {
  //getting array ofrecords
  $departmentid=trim(isset($_POST['departmentid'])?$_POST['departmentid']:false);

 $levelnamearray=isset($_POST['levelname'])?$_POST['levelname']:false;
 $counting=0;
 foreach($levelnamearray as $dataindex => $levelname){
 $levelname=trim(ucwords($levelname));
 $levelrank=trim(isset($_POST['levelrank'][$dataindex])?$_POST['levelrank'][$dataindex]:false);
 $levelnumoption=trim(isset($_POST['levelnumoption'][$dataindex])?$_POST['levelnumoption'][$dataindex]:false);
 
 $tableLevel=new insertTable;
$state=$tableLevel->insert_level($levelname, $levelrank, $departmentid, $levelnumoption, $schoolhelp, $xdate);
$display=$state['action'];
$counting=$counting+$state['counting'];
}

$sql=$display.":: Insertion, affected records = ".$counting;

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}

if($page==4) {
  
 $levelname=trim(ucwords(isset($_POST['levelname'])?$_POST['levelname']:false));
 $levelrank=trim(isset($_POST['levelrank'])?$_POST['levelrank']:false);
 $departmentid=trim(isset($_POST['departmentid'])?$_POST['departmentid']:false);
 $levelnumoption=trim(isset($_POST['levelnumoption'])?$_POST['levelnumoption']:false);
 
 $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);

$tablelevel=new updateTable;
$state=$tablelevel->update_level($levelid, $levelname, $levelrank,  $departmentid,  $levelnumoption, $schoolhelp);

$sql=$state.":: Update Made, affected records = 1";
echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&state=$state&sql=$sql';
      </script>";
}

if ($page==7) {
  $levelid=trim(isset($_GET['id'])?$_GET['id']:false);
  $classtype=trim(isset($_GET['status'])?$_GET['status']:false);
  if ($classtype==1) {
    $classtype=0;
  }else{
     $classtype=1;
  }
   $tablelevel=new updateTBLactivate;
    $state=$tablelevel->updatingall3('level', 'classtype', $classtype, 'levelid', $levelid, $schoolhelp);
    $sql=$state.":: Operation Performed";
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
                    <h2 id="caption">Level</h2>
                    <ul class="nav navbar-right panel_toolbox" style="">
                      <li><a class="btn btn-primary" href="../?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                      <li><a class="btn btn-success " href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"> Settings</i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                         <li  ><a href="?page=1&schoolhelp=<?php echo $schoolhelp; ?>"  ><i class="fa fa-plus"></i>  Add Level</a>
                      </li>
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  View Level</a>
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
                        <legend style="color:#063">Level Record</legend>

                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Name</th>
                          <th>Rank</th>
                          <th>Department</th>
                          <th>Options</th>
                          
                         
                          <th style="width:10%;"><i class="far fa-address-card" style="color:green"></i> Print</th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:red"></i> Edit</th>
                           <th>User<i class="fa fa-user"></i></th>
                           <th title="Please Select Early class or Later class">Class Type</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                              
                              $records=$datas->level('desc');
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
                                        <td><?php echo  substr($fieldrecord['levelname'],0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['levelrank'],0, 12); ?></td>
                                        <td><?php echo  substr($deptname,0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['levelnumoption'],0, 12); ?></td>                                  
                                     
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['levelid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['levelid']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
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
                                         <td><button type="click to enable another class type" type="button" <?php if ($fieldrecord['classtype']==1) { $caption='Early';?> class="btn btn-success" <?php } else{$caption='Advance'; ?> class="btn btn-primary" <?php } ?>   onclick="funcactivator('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord["levelid"]; ?>', '<?php echo $fieldrecord["classtype"]; ?>')"><?php echo  $caption; ?></button></td>
                                       
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
                        <legend style="color:#063">Add Level</legend>
                  <form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="forminstitutionid"  class="form-horizontal form-label-left" >
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Select Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
                          <select  id="departmentid" required="required" name="departmentid" class="form-control col-md-7 col-xs-12" onchange="addingfields('level', 'departmentid', 'department', 'did', 'years', this.value, 'checktwotables');">
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
                    $levelid=trim(isset($_GET['id'])?$_GET['id']:false);

                    
                    $record=$datas->leveledit('levelid', $levelid)
                    ?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Edit Level</legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>&i_id=<?php echo $levelid; ?>" method="POST"  id="forminstitutionid"  class="form-horizontal form-label-left" >
                      <input type="hidden" name="levelid" value="<?php echo $levelid; ?>">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Select Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         
                          <select  id="departmentid" required="required" name="departmentid" class="form-control col-md-7 col-xs-12" onchange="return updatevalidity1('level', 'levelname', 'departmentid', $('#levelname').val(), this.value,'updating', $('#levelname').attr('id'));">
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
                       
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="levelname">Level Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="levelname" required="required" name="levelname" value="<?php echo $record['levelname']; ?>" class="form-control col-md-7 col-xs-12" onblur="return updatevalidity1('level', 'levelname', 'departmentid', this.value, $('#departmentid').val(), 'updating', $(this).attr('id'));">
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Level Rank<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="levelrank" class="form-control col-md-7 col-xs-12" type="text" name="levelrank" value="<?php echo $record['levelrank']; ?>" required="required" placeholder="Example: 0 or 1 or 2">
                        </div>
                      </div>
                     
                       <div class="form-group">
                        <label for="levelnumoption" class="control-label col-md-3 col-sm-3 col-xs-12">Options</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="levelnumoption" class="form-control col-md-7 col-xs-12" type="number" name="levelnumoption" value="<?php echo $record['levelnumoption']; ?>" placeholder="Enter operational number of options(groups)">
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
                  $levelid=trim(isset($_GET['id'])?$_GET['id']:false);

                    //$datas=new classLevel;
                    $record=$datas->leveledit('levelid', $levelid);

                    //collecting department record
                    $fieldvalue=$record['departmentid'];
                    $deptmethod=$deptclass->departmentedit('departmentid', $fieldvalue);
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
                    <h2>Level Details </h2>
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
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $record['levelname']; ?>.
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
                          <center><p class="lead schoolhelpcolor"><b><?php echo $record['levelname']; ?> Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Name:</th>
                                  <td><?php echo $record['levelname']; ?></td>
                                </tr>
                                <tr>
                                  <th>Rank:</th>
                                  <td><?php echo $record['levelrank']; ?></td>
                                </tr>
                                <tr>
                                  <th>Department Name:</th>
                                  <td><?php echo $deptname; ?></td>
                                </tr>
                                <tr>
                                  <th>Options</th>
                                  <td><?php echo $record['levelnumoption']; ?></td>
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