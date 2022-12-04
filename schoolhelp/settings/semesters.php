
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/schoolhelpinserts.php");
include_once("../phpclass/schoolhelpupdate.php");
include_once("../phpclass/schoolhelpOOP.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Semester";
$schoolhelp=1;
$xdate=date("Y-m-d");


$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

if($page==1) {
  $numberoffields=trim(isset($_POST['numberoffields'])?$_POST['numberoffields']:false);
}

if($page==2) {
  //getting array ofrecords
  $k=0;
$semesters=isset($_POST['semestername'])?$_POST['semestername']:false;

foreach($semesters as $semestercount=>$semestername){
if ($semestercount<=1) {
  $k+=1;
$semestername=trim(ucwords($semestername));
$description=trim(isset($_POST['description'.$semestercount])?$_POST['description'.$semestercount]:false);
$tableSemester=new insertTable;
$state=$tableSemester->insert_semester($semestername, $description, $schoolhelp, $xdate);
 }
}
$sql=$state.":: Insertion Made, affected records = ".$k;
echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&state=$state&sql=$sql';
      </script>";
}

if($page==4) {
  

$semestername=trim(isset($_POST['semestername'])?$_POST['semestername']:false);
$description=trim(isset($_POST['description'])?$_POST['description']:false);
$semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
$tableSemester=new updateTable;
$state=$tableSemester->update_semester($semesterid, $semestername, $description, $schoolhelp, $xdate);

$sql=$state.":: Update Made, affected records = 1";
echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&state=$state&sql=$sql';
      </script>";
}

if($page==6) {
  
$id=trim(isset($_GET['id'])?$_GET['id']:false);
$updateall=new updateTBLactivate;
//(tablename, tableid, fieldtoupdate, tableidvalue, operatorid)
$state=$updateall->updatingall('semesters', 'semesterid', 'status', $id, $schoolhelp);

$sql=$state.":: This semester is activated, affected records = 1";
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
                    <h2 id="caption">Semester</h2>
                    <ul class="nav navbar-right panel_toolbox" style="">
                      <li><a class="btn btn-primary" href="../?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                      <li><a class="btn btn-success " href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"> Settings</i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                          <?php $actualrow=allTablesrowcount('semesters'); ?>
                         <?php if (!$actualrow>=2){ ?><li><a href="#"  data-toggle="modal" data-target="#myModal" ><i class="fa fa-plus"></i>  Add Semester</a>
                      </li><?php } ?>
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  View Semester</a>
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
                        <legend style="color:#063">Semester Record</legend>
                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Semester</th>
                          <th>Description</th>
                          <th>Active <i class="fa fa-light"></i></th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:red"></i> Edit</th>
                          <th>User<i class="fa fa-user"></i></th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0;
                              $datas=new classSemester; 
                              $records=$datas->semester('asc');
                              $adminrecord= new Adminperson;
                              if (isset($records)) {
                               
                              foreach($records as $fieldrecord){
                                $fieldvalue=trim($fieldrecord['operatorid']);
                               
                                $admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
                              $adminname= $admindata['surname']. " ".$admindata['othername'] ;
                                $k+=1;
                                ?>
                                      <tr>
                                        <td><?php echo $k; ?></td>
                                        <td><?php echo  $fieldrecord['semestername']; ?></td>
                                        <td><?php echo  $fieldrecord['semesterdescription']; ?></td>
                                        <td><button type="button" <?php if ($fieldrecord['status']==1) { $caption='Active';?> class="btn btn-success" <?php } else{$caption='Set Active'; ?> class="btn btn-primary" <?php } ?>   onclick="funcactivate('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['semesterid']; ?>')"><?php echo  $caption; ?></button></td>
                                        
                                        <td><button  onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['semesterid']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
                                     
                                  
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
                        <legend style="color:#063">Add Semester</legend>
                  <form action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST" id="schools" data-parsley-validate class="form-horizontal form-label-left" onSubmit="return updatevalidity('department', 'semestername', this.value, 'updating', $(this).attr('id'));">

                     <?php $count=0; while($numberoffields>=1){
                       $numberoffields-=1; 

                       ?>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Semester<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="semestername<?php echo $count; ?>" name="semestername[]" required="required" class="form-control col-md-7 col-xs-12" onblur="updatevalidity('semesters', 'semestername', this.value, 'inserting', $(this).attr('id'));" placeholder="Example: 1ST or 2ND Semester">
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="description<?php echo $count; ?>" class="form-control col-md-7 col-xs-12"></textarea>  
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
                    $semesterid=trim(isset($_GET['id'])?$_GET['id']:false);

                    $datas=new classSemester;
                    $record=$datas->semesteredit('semesterid', $semesterid)
                    ?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Edit Semester</legend>
                  <form action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST" id="schools" data-parsley-validate class="form-horizontal form-label-left">

                       <input type="hidden" id="semesterid" name="semesterid" value="<?php echo $semesterid ?>" required="required" >
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Semester<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="semestername" name="semestername" value="<?php echo $record['semestername'] ?>" required="required" class="form-control col-md-7 col-xs-12" onblur="updatevalidity('semesters', 'semestername', this.value, 'updating', $(this).attr('id'));" placeholder="Example: 1ST or 2ND Semester" />
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="description" class="form-control col-md-7 col-xs-12"><?php echo $record['semesterdescription'] ?></textarea>  
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
              </div>
            </div>
       <?php include("includes/footer.php"); ?>