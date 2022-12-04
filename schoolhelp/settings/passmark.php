
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/schoolhelpinserts.php");
include_once("../phpclass/schoolhelpupdate.php");
include_once("../phpclass/schoolhelpOOP.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Passmark";

$odate=date("Y-m-d");

//calling of classes
//department Table
$deptclass=new classDepartment; 
$levelclass=new classLevel;

$datas=new classPassmark;
//Admin Methods
$adminrecord=new Adminperson;

// Checking page access Authenticity
$schoolhelpsetting=new Allsettings;
$previlleges=$schoolhelpsetting->allsettingedit('adminpersons', 'adminid', $schoolhelp);
foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['passmark_s']);
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
$levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
$passmark=trim(isset($_POST['passmark'])?$_POST['passmark']:false);
$counting=0;
$tablepassmark=new insertTable;
$state=$tablepassmark->insert_passmark($levelid, $passmark,  $schoolhelp, $odate);
$display=$state['action'];
$counting=$counting+$state['counting'];

 
$sql=$display.":: Insertion, affected records = ".$counting;

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}

if($page==4) {

$passmarkid=trim(isset($_POST['passmarkid'])?$_POST['passmarkid']:false);
 $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
$passmark=trim(isset($_POST['passmark'])?$_POST['passmark']:false);
 
$tablepassmark=new updateTable;
$state=$tablepassmark->update_passmark($passmarkid, $levelid, $passmark, $schoolhelp);

$sql=$state.":: Update Made, affected records = 1";

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&state=$state&sql=$sql';
      </script>";
}
if ($page==6) {
  $passmarkid=trim(isset($_GET['id'])?$_GET['id']:false);
   
   $schoolhelpDHd= new TblDeleterow;
    $state=$schoolhelpDHd->delete_setting('passmark', 'passmarkid', $passmarkid);

        $sql=$state.":: Deletion Made, affected records = 1";
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
                          <th>Level</th>
                          <th>Passmark</th>

                          <th style="width:10%;"><i class="fa fa-edit" style="color:green"></i> Edit</th>
                           <th>User<i class="fa fa-user"></i></th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                              
                              $records=$datas->passmark('desc');
                              if (isset($records)) {
                                
                              foreach($records as $fieldrecord){
                                $k+=1;
                                $fieldvalue=trim($fieldrecord['operatorid']);
                                $fieldvalue1=trim($fieldrecord['levelid']);

                               //collecting department record
                              $levelmethod=$levelclass->leveledit('levelid', $fieldvalue1);
                              $levelname=trim($levelmethod['levelname']);
                              $deptid=trim($levelmethod['departmentid']);

                                //collecting department record
                              $deptmethod=$deptclass->departmentedit('did', $deptid);
                              $deptname=$deptmethod['deptname'];
                                //Getting Admin Detials
                                $admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
                                ?>
                                      <tr>
                                        <td><?php echo $k; ?></td>
                                        <td><?php echo  substr($deptname, 0, 12); ?></td>
                                        <td><?php echo  substr($levelname, 0, 12); ?></td>
                                        <td><?php echo  $fieldrecord['passmark']; ?></td>
                                                           
                                     
                                       
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['passmarkid']; ?>')"><center><i class="fa fa-edit" style="color:green; font-size:2em"></i></center></button></td>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Select Level<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
                          <select  id="levelid" required="required" name="levelid" class="form-control col-md-7 col-xs-12" onchange="return updatevalidity1('passmark', 'levelid', this.value, 'inserting', $(this).attr('id'));">
                            <option value="">--Select Level--</option>
                            <?php
                            $levelrecord=$levelclass->level('asc');
                            foreach($levelrecord as $leveldata){
                              $deptid=trim($leveldata['departmentid']);
                              $deptmethod=$deptclass->departmentedit('did', $deptid);
                              $deptname=trim($deptmethod['deptname']);
                            ?>
                            <option value="<?php echo $leveldata['levelid']; ?>"><?php echo $leveldata['levelname'].' => '.$deptname; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="assname" class="control-label col-md-3 col-sm-3 col-xs-12">Passmark<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="passmark"  id="passmark" class="form-control col-md-7 col-xs-12" type="text"  required="required" placeholder="Enter Passmark, eg. 40" onblur="return updatevalidity('passmark', 'levelid', $('#levelid').val(), 'inserting', $(this).attr('id'));">
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
                    $passmarkid=trim(isset($_GET['id'])?$_GET['id']:false);

                    
                    $record=$datas->passmarkedit('passmarkid', $passmarkid);
                    $levelid=trim($record['levelid']);
                    ?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Edit <?php echo $pagename; ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="formassessmentid"  class="form-horizontal form-label-left" >
                      <input type="hidden" name="passmarkid" id="passmarkid"  value="<?php echo $passmarkid; ?>">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Select Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         
                          <select name="levelid" id="levelid" required="required"  class="form-control col-md-7 col-xs-12" onchange="return updatevalidity1('passmark', 'levelid', this.value, 'inserting', $(this).attr('id'));">
                            <option value="">--Select Level--</option>
                            <?php
                            $levelrecord=$levelclass->level('asc');
                            foreach($levelrecord as $leveldata){
                                $deptid=trim($leveldata['departmentid']);
                              $deptmethod=$deptclass->departmentedit('did', $deptid);
                              $deptname=trim($deptmethod['deptname']);
                            ?>
                            <option value="<?php echo $leveldata['levelid']; ?>" <?php  if($levelid==$leveldata['levelid']){ ?> selected="selected" <?php } ?> ><?php echo $leveldata['levelname']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    
                     
                       <div class="form-group">
                        <label for="assname" class="control-label col-md-3 col-sm-3 col-xs-12">Passmark<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="passmark" value="<?php echo $record['passmark']; ?>" id="passmark" class="form-control col-md-7 col-xs-12" type="text"  required="required" placeholder="Enter Passmark, eg. 40" onblur="return updatevalidity('passmark', 'levelid', $('#levelid').val(), 'updating', $(this).attr('id'));">
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

             
              </div>
            </div>
       <?php include("includes/footer.php"); ?>