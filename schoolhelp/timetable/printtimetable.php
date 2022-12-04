
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHtimetableOOP.php");
include_once("../phpclass/SHtimetableupdate.php");
include_once("../phpclass/SHtimetableinserts.php");
confirmcheckin();
$SHtimetableOOP=new classTimetable;
$pagename="Print Timetable";

$tableUpdate= new updateTable;
$tableInsert=new insertTable;
$page=trim(isset($_GET['page'])?$_GET['page']:false);
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);

//collecting category
$categoryid=trim(isset($_GET['categoryid'])?$_GET['categoryid']:false);

$odate=date("Y-m-d");
$udate=date("Y-m-d H:i:s");

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

  $timetablesemesterid="";
  $timetabledid="";

  
  $timetablesemesterid=trim(isset($_POST['timetablesemesterid'])?$_POST['timetablesemesterid']:false);
  $startdate=trim(isset($_POST['startdate'])?$_POST['startdate']:false);
  $enddate=trim(isset($_POST['enddate'])?$_POST['enddate']:false);
  $categoryid=trim(isset($_POST['categoryid'])?$_POST['categoryid']:false);

  if ($categoryid==2) {
    $page=1;
    $timetabletypeid=trim(isset($_POST['timetabletypeid'])?$_POST['timetabletypeid']:false);
    $timetabledid=trim(isset($_POST['timetabledid'])?$_POST['timetabledid']:false);

    $semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
    $sessionid=trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);
  }else if ($categoryid==3) {
    $page=3;
    $typename=trim(isset($_POST['typename'])?$_POST['typename']:false);
   
    $semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
    $sessionid=trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);
  }else{
    $page="";;
  }
  
$sql="";
$weeknoofdays="";
$message="";
$insertedrec="";

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
                                                    
                      <li><a href="?schoolhelp=<?php echo $schoolhelp; ?>" ><i class="fa fa-print"></i> Class Timetable</a>
                      </li>
                      <li ><a  href="?page=1&schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-print"></i> Department Timetable</a>
                      </li>
                      <?php if ($admintype==1) { ?>
                       <li ><a  href="?page=3&schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-print"></i> All Department Timetable</a>
                      </li>
                       <?php } ?>  
                        </ul>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div style="color:#063" <?php if ($state=="failed") {?> style="color:red" <?php } ?> ><b><?php echo $sql; ?></b></div>

                  <div class="x_panel">
                  <?php if ($page=="") { ?>
                  
                      <fieldset>
                        <legend style="color:#063"><?php echo $pagename ?></legend>
                  <form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST" id="frmmedtreatmentid" class="form-horizontal form-label-left" onsubmit="return printdailydate($('#startdate').val(), $('#enddate').val());">
                   
                      <div class="form-group">
                        <label for="semester" class="control-label col-md-3 col-sm-3 col-xs-12">Semester's Timetable Setup</label>
                        <div class="col-md-8 col-sm-9 col-xs-12">
                            <input type="hidden" id="categoryid" name="categoryid" value="1" >
                            <select name="timetablesemesterid" id="timetablesemesterid" class="form-control col-md-12 col-xs-12"  required="required">
                             <option value="">Semester's Timetable Setup</option>
                            <?php 
                            $record=$SHtimetableOOP->alltimetable('timetablesemester', 'levelid', 'DESC');
                            if (is_array($record)) {
                            foreach($record as $records){
                              $levelid=trim($records['levelid']);
                              $optionid=trim($records['optionid']);
                              $semesterid=trim($records['semesterid']);
                              $sessionid=trim($records['sessionid']);
                              $timetabletypeid=trim($records['timetabletypeid']);

                               //collecting Timetable record
                                    $typename="";
                                     $typerecords=$SHtimetableOOP->alltimetableedit('timetabletype', 'timetabletypeid', $timetabletypeid);
                                     if (is_array($typerecords)) {
                                     foreach($typerecords as $typerecord){
                                        $typename=$typerecord['typename'];
                                        
                                     }
                                   }
                             
                               $levelname="";
                              $levelobject=$SHtimetableOOP->alltimetableedit('level', 'levelid',  $levelid);
                                if(is_array($levelobject)){
                                foreach($levelobject as $levelrecord){
                                  $levelname=$levelrecord['levelname'];
                                   $did=trim($levelrecord['departmentid']);
                                  }
                                }

                                $deptname="";
                              //Getting Department information
                              $record1=$SHtimetableOOP->alltimetableedit('department', 'did', $did);
                              if (is_array($record1)) {
                              foreach($record1 as $record1s){
                                $deptname=$record1s['deptname'];
                              }
                            }

                             $optionname="";
                              
                                   $optionobject=$SHtimetableOOP->alltimetableedit('optiontable', 'optid',  $optionid);
                                   if(is_array($optionobject)){
                                      foreach($optionobject as $optionrecord){
                                        $optionname=$optionrecord['optname'];
                                        
                                     }
                                    }

                                      //Select current term/semester
                              $semesterdata=$SHtimetableOOP->alltimetableedit('semesters','semesterid', $semesterid);
                                  if (is_array($semesterdata)) {
                                      foreach($semesterdata as $semesterrecord){
                                          $semestername=$semesterrecord['semestername'];
                                          $semesterid=trim($semesterrecord['semesterid']);
                                          
                                    }
                                }


                              //Select current Session
                               $sessiondata=$SHtimetableOOP->alltimetableedit('session', 'sessionid', $sessionid);
                                  if (is_array($sessiondata)) {
                                      foreach($sessiondata as $sessiondrecord){
                                          $sessionname=$sessiondrecord['sessionlow']."/".$sessiondrecord['sessionhigh'];
                                          $sessionid=trim($sessiondrecord['sessionid']);    
                                    }
                                }

                          if ($admintype==0) {
                            if ($logindepartmentid==$did) {
                            ?>
                             <option value="<?php echo $records['timetablesemesterid'] ?>"><?php echo $typename." - ".$sessionname." => ".$semestername. "::". $levelname."::".$optionname." => ".$deptname; ?></option>
                           <?php }
                              }
                           else{ ?>
                             <option value="<?php echo $records['timetablesemesterid'] ?>"><?php echo $typename." - ".$sessionname." => ".$semestername. "::". $levelname."::".$optionname." => ".$deptname; ?></option>
                            <?php 
                                  }
                              } 
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                        <div class="col-md-4">
                      <div class="form-group">
                        <label for="startdate" class="control-label col-md-4 col-sm-4 col-xs-12">Start Date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="date" id="startdate" name="startdate" class="form-control col-xs-12" required="required">
                          </div>
                        </div>
                      </div>
                         <div class="col-md-4">
                      <div class="form-group">
                        <label for="enddate" class="control-label col-md-4 col-sm-4 col-xs-12">End Date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="date" id="enddate" name="enddate" class="form-control col-xs-12" required="required">
                          </div>
                        </div>
                      </div>
                       
                      <div class="col-md-4"><input type="submit" class="btn btn-primary" value="Search Timetable" /></div>

                    </div>
                      </div>
                     
                   </form>
                  </div>
                  </fieldset>
                 
                 <?php } ?>

                 <?php if ($page==1) { ?>
                  
                      <fieldset>
                        <legend style="color:#063"><?php echo $pagename ?></legend>
                  <form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST" id="frmmedtreatmentid" class="form-horizontal form-label-left" onsubmit="return printdailydate($('#startdate').val(), $('#enddate').val());">
                  
                   <div class="row">
                        <div class="col-md-12">

                       <div class="col-md-4">
                       <div class="form-group">
                        <label for="level" class="control-label col-md-4 col-sm-4 col-xs-12">Department</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <input type="hidden" id="categoryid" name="categoryid" value="2" >
                          <select name="timetabledid" id="timetabledid" class="form-control col-md-7 col-xs-12"  required="required" onchange="getdepartmenttype('timetabletype', 'departmentid', $(this).val(), 'getdepartmenttype', 'typecontainer')">
                             <option>--Select Department--</option>
                            <?php 
                            $record=$SHtimetableOOP->alltimetable('department', 'did', 'ASC');
                            if (is_array($record)) {
                            foreach($record as $records){
                              $did=trim($records['did']);
                              $deptname=$records['deptname'];
                             
                          if ($admintype==0) {
                            if ($logindepartmentid==$did) {
                            ?>
                             <option value="<?php echo trim($records['did']) ?>"><?php echo $records['deptname']; ?></option>
                           <?php }
                              }
                           else{ ?>
                            <option value="<?php echo $records['did'] ?>"><?php echo $records['deptname']; ?></option>
                            <?php 
                                  }
                              } 
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>

                      <div class="col-md-4">
                       <div class="form-group">
                        <label for="session" class="control-label col-md-4 col-sm-4 col-xs-12">Session</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select name="sessionid" id="sessionid" class="form-control col-md-7 col-xs-12" onchange="return updatevalidity5('timetablesemester', 'Class Timetable', '<?php echo $timetablesemesterid;  ?>', 'timetablesemesterid', 'optionid', $('#optionid').val(), 'levelid', $('#levelid').val(), 'semesterid', $('#semesterid').val(), 'sessionid', $('#sessionid').val(), 'timetabletypeid', $('#timetabletypeid').val(), 'updating', 'sessionid');">
                             <option>--Select Session--</option>
                            <?php $record=$SHtimetableOOP->alltimetable('session', 'sessionid',  'ASC'); 
                             if (is_array($record)) {
                            foreach($record as $records){
                            ?>
                            <option value="<?php echo $records['sessionid']; ?>" <?php if ($records['sessionid']==$sessionid){ ?> selected="selected" <?php } ?>><?php echo $records['sessionlow'].'/'.$records['sessionhigh'] ?></option>
                            <?php } 
                          }?>
                          </select>
                        </div>
                      </div>
                    
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                        <label for="semester" class="control-label col-md-4 col-sm-4 col-xs-12">Semester</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                        
                            <select  name="semesterid" id="semesterid" required="required"  class="form-control col-md-1 col-xs-2" onchange="return updatevalidity5('timetablesemester', 'Class Timetable', '<?php echo $timetablesemesterid;  ?>', 'timetablesemesterid', 'optionid', $('#optionid').val(), 'levelid', $('#levelid').val(), 'semesterid', $('#semesterid').val(), 'sessionid', $('#sessionid').val(), 'timetabletypeid', $('#timetabletypeid').val(), 'updating', 'sessionid');">
                               <option value="">--Select Semester/Term--</option>
                              <?php  
                              $retrievedata=$SHtimetableOOP->alltimetable('semesters', 'semesterid', 'ASC');
                                if (is_array($retrievedata)) {
                                foreach($retrievedata as $field){
                              ?>
                                    <option value="<?php echo $field['semesterid']; ?>" <?php if ($field['semesterid']==$semesterid) {?> selected="selected" <?php } ?> ><?php echo $field['semestername']; ?></option>
                              <?php
                                  }
                                }
                                ?>
                            </select>
                        </div>
                      </div>   
                    </div>

                   </div>           
                  </div>

                  <div class="row">
                        <div class="col-md-12">

                           <div class="col-md-4">
                    <div id="typecontainer">
                    
                    <div class="form-group">
                                   <label class="control-label col-md-4 col-sm-4 col-xs-12" for="departmentid">Timetable Type<span class="required">*</span>
                                   </label>
                                   <div class="col-md-8 col-sm-8 col-xs-12">
                                  <select name="timetabletypeid" id="timetabletypeid" class="form-control col-md-7 col-xs-12"  required="required">
                                   <option value="">--Select Timetable Type--</option>
                                     <?php  $retrievedata=$SHtimetableOOP->alltimetable('timetabletype', 'timetabletypeid', 'ASC');
                                        if (is_array($retrievedata)) {

                                          $did1=""; 
                                        ?> 
                                        <?php
                                          foreach($retrievedata as $field){
                                              $did1=trim($field['departmentid']);

                                              $record1=$SHtimetableOOP->alltimetableedit('department', 'did', $did1);
                                              if (is_array($record1)) {
                                              foreach($record1 as $record1s){
                                               
                                                $deptname=$record1s['deptname'];
                                              }
                                            }

                                            if ($admintype==0) {
                                            if ($logindepartmentid==$did1) {
                                        ?>
                                              <option value="<?php echo $field['timetabletypeid']; ?>" ><?php echo $field['typename']. "=>".$deptname; ?></option>
                                        <?php
                                                }
                                              } else{?>
                                              <option value="<?php echo $field['timetabletypeid']; ?>" ><?php echo $field['typename']. "=>".$deptname; ?></option>
                                              <?php }

                                             }
                                        }?>
                                              </select>
                                            </div>
                                    </div>
                                    </div>  
                                    </div> 
                        

                        <div class="col-md-4">
                      <div class="form-group">
                        <label for="startdate" class="control-label col-md-4 col-sm-4 col-xs-12">Start Date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="date" id="startdate" name="startdate" class="form-control col-xs-12" required="required">
                          </div>
                        </div>
                      </div>
                         <div class="col-md-4">
                      <div class="form-group">
                        <label for="enddate" class="control-label col-md-4 col-sm-4 col-xs-12">End Date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="date" id="enddate" name="enddate" class="form-control col-xs-12" required="required">
                          </div>
                        </div>
                      </div>

                    </div>
                      </div>

                       <div class="col-md-12"><center><input type="submit" class="btn btn-primary" value="Search Timetable" /></center></div>

                </div>

                      
                     
                   </form>
                  </div>
                  </fieldset>
                 
                 <?php } ?>

                  <?php if ($page==3) { ?>
                  
                     <fieldset>
                        <legend style="color:#063"><?php echo $pagename ?></legend>
                  <form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST" id="frmmedtreatmentid" class="form-horizontal form-label-left" onsubmit="return printdailydate($('#startdate').val(), $('#enddate').val());">
                  
                   <div class="row">
                        <div class="col-md-12">
                        <input type="hidden" id="categoryid" name="categoryid" value="3">
                     

                      <div class="col-md-4">
                       <div class="form-group">
                        <label for="session" class="control-label col-md-4 col-sm-4 col-xs-12">Session</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                          <select name="sessionid" id="sessionid" class="form-control col-md-7 col-xs-12" onchange="return updatevalidity5('timetablesemester', 'Class Timetable', '<?php echo $timetablesemesterid;  ?>', 'timetablesemesterid', 'optionid', $('#optionid').val(), 'levelid', $('#levelid').val(), 'semesterid', $('#semesterid').val(), 'sessionid', $('#sessionid').val(), 'timetabletypeid', $('#timetabletypeid').val(), 'updating', 'sessionid');">
                             <option>--Select Session--</option>
                            <?php $record=$SHtimetableOOP->alltimetable('session', 'sessionid',  'ASC'); 
                             if (is_array($record)) {
                            foreach($record as $records){
                            ?>
                            <option value="<?php echo $records['sessionid']; ?>" <?php if ($records['sessionid']==$sessionid){ ?> selected="selected" <?php } ?>><?php echo $records['sessionlow'].'/'.$records['sessionhigh'] ?></option>
                            <?php } 
                          }?>
                          </select>
                        </div>
                      </div>
                    
                  </div>

                  <div class="col-md-4">
                  <div class="form-group">
                        <label for="semester" class="control-label col-md-4 col-sm-4 col-xs-12">Semester</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                        
                            <select  name="semesterid" id="semesterid" required="required"  class="form-control col-md-1 col-xs-2" onchange="return updatevalidity5('timetablesemester', 'Class Timetable', '<?php echo $timetablesemesterid;  ?>', 'timetablesemesterid', 'optionid', $('#optionid').val(), 'levelid', $('#levelid').val(), 'semesterid', $('#semesterid').val(), 'sessionid', $('#sessionid').val(), 'timetabletypeid', $('#timetabletypeid').val(), 'updating', 'sessionid');">
                               <option value="">--Select Semester/Term--</option>
                              <?php  
                              $retrievedata=$SHtimetableOOP->alltimetable('semesters', 'semesterid', 'ASC');
                                if (is_array($retrievedata)) {
                                foreach($retrievedata as $field){
                              ?>
                                    <option value="<?php echo $field['semesterid']; ?>" <?php if ($field['semesterid']==$semesterid) {?> selected="selected" <?php } ?> ><?php echo $field['semestername']; ?></option>
                              <?php
                                  }
                                }
                                ?>
                            </select>
                        </div>
                      </div>   
                    </div>

                      <div class="col-md-4">
                    <div id="typecontainer">
                    
                    <div class="form-group">
                                   <label class="control-label col-md-4 col-sm-4 col-xs-12" for="departmentid">Timetable Type<span class="required">*</span>
                                   </label>
                                   <div class="col-md-8 col-sm-8 col-xs-12">
                                  <select name="typename" id="typename" class="form-control col-md-7 col-xs-12"  required="required">
                                   <option value="">--Select Timetable Type--</option>

                                     <?php  $retrievedata=$SHtimetableOOP->alltorderdistinct0('timetabletype', 'typename', 'ASC', 'typename');
                                        if (is_array($retrievedata)) {

                                        ?> 
                                        <?php
                                          foreach($retrievedata as $field){ 
                                        ?>
                                            <option value="<?php echo $field['typename']; ?>" ><?php echo $field['typename']; ?></option>
                                              <?php }
                                        }?>
                                              </select>
                                            </div>
                                    </div>
                                    </div>  
                                    </div> 

                   </div>           
                  </div>

                  <div class="row">
                        <div class="col-md-12">                      

                        <div class="col-md-4">
                      <div class="form-group">
                        <label for="startdate" class="control-label col-md-4 col-sm-4 col-xs-12">Start Date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="date" id="startdate" name="startdate" class="form-control col-xs-12" required="required">
                          </div>
                        </div>
                      </div>
                         <div class="col-md-4">
                      <div class="form-group">
                        <label for="enddate" class="control-label col-md-4 col-sm-4 col-xs-12">End Date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="date" id="enddate" name="enddate" class="form-control col-xs-12" required="required">
                          </div>
                        </div>
                      </div>

                       <div class="col-md-4"><center><input type="submit" class="btn btn-primary" value="Search Timetable" /></center></div>
                    </div>
                      </div>

                       
                </div>

                      
                     
                   </form>
                  </div>
                  </fieldset>
                 
                 <?php } ?>
                </div>
                  <?php if($categoryid==1) {  
                   
                        $priority="";
                        $timetableweekid="";
                        $timetableweekid1="";
                        $i="";
                          
                          //$datetime1 = new DateTime($startdate);

              //$datetime2 = new DateTime($enddate);
              $start_date = strtotime($startdate); 
              $end_date = strtotime($enddate); 

              //$difference = $datetime1->diff($datetime2);
              $totaldate=($end_date - $start_date)/60/60/24; 
            
              $startingdate=$startdate; ?>
              <div class="x_panel">
              <table  id="printrecord" style="width:100%; " class="table table-striped table-bordered table-responsive">    
                <?php //Getting Timetable Information

                $record=$SHtimetableOOP->alltimetableedit('timetablesemester', 'timetablesemesterid', $timetablesemesterid);
                            if (is_array($record)) {
                            foreach($record as $records){
                              $levelid=trim($records['levelid']);
                              $optionid=trim($records['optionid']);
                              $semesterid=trim($records['semesterid']);
                              $sessionid=trim($records['sessionid']);
                              $timetabletypeid=trim($records['timetabletypeid']);

                               //collecting Timetable record
                                    $typename="";
                                     $typerecords=$SHtimetableOOP->alltimetableedit('timetabletype', 'timetabletypeid', $timetabletypeid);
                                     if (is_array($typerecords)) {
                                     foreach($typerecords as $typerecord){
                                        $typename=$typerecord['typename'];
                                        
                                     }
                                   }
                             
                               $levelname="";
                              $levelobject=$SHtimetableOOP->alltimetableedit('level', 'levelid',  $levelid);
                                if(is_array($levelobject)){
                                foreach($levelobject as $levelrecord){
                                  $levelname=$levelrecord['levelname'];
                                   $did=trim($levelrecord['departmentid']);
                                  }
                                }


                                $deptname="";
                              //Getting Department information
                              $record1=$SHtimetableOOP->alltimetableedit('department', 'did', $did);
                              if (is_array($record1)) {
                              foreach($record1 as $record1s){
                                $deptname=$record1s['deptname'];
                              }
                            }

                             $instiname="";
                              //Getting Department information
                              $institution1=$SHtimetableOOP->alltimetableedit('institution', 'departmentid', $did);
                              if (is_array($institution1)) {
                              foreach($institution1 as $institution1s){
                                $instiname=$institution1s['instiname'];
                              }
                            }

                             $optionname="";
                              
                                   $optionobject=$SHtimetableOOP->alltimetableedit('optiontable', 'optid',  $optionid);
                                   if(is_array($optionobject)){
                                      foreach($optionobject as $optionrecord){
                                        $optionname=$optionrecord['optname'];
                                        
                                     }
                                    }

                                      //Select current term/semester
                              $semesterdata=$SHtimetableOOP->alltimetableedit('semesters','semesterid', $semesterid);
                                  if (is_array($semesterdata)) {
                                      foreach($semesterdata as $semesterrecord){
                                          $semestername=$semesterrecord['semestername'];
                                          $semesterid=trim($semesterrecord['semesterid']);
                                          
                                    }
                                }


                              //Select current Session
                               $sessiondata=$SHtimetableOOP->alltimetableedit('session', 'sessionid', $sessionid);
                                  if (is_array($sessiondata)) {
                                      foreach($sessiondata as $sessiondrecord){
                                          $sessionname=$sessiondrecord['sessionlow']."/".$sessiondrecord['sessionhigh'];
                                          $sessionid=trim($sessiondrecord['sessionid']);    
                                    }
                                }

                              }
                            }

                 ?>
                 <tr style="background: white; border-collapse: collapse;" cellpadding="0px" cellspacing="0px"><td style="text-align: center"><span style="font-size: 30px"><?php echo $instiname; ?> </span><br>
                  <span style="font-size: 18px"><?php echo $typename; ?> Timetable for <?php echo $semestername ; ?> of <?php echo $sessionname; ?></span>
                  <br>Department: <?php echo $deptname ?> | Level: <?php echo $levelname; ?> | Option: <?php echo $optionname; ?></td></tr>
              <?php if ((is_numeric($totaldate)) && ($totaldate>=0)) {?>
              <tr cellpadding="0px" cellspacing="0px" style="border-collapse: collapse; background: white">
                <td cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                  <table id="datatable-buttons" style="width:100%; text-align:center; border-collapse: collapse;" class="table table-striped table-bordered table-responsive" >
                    <tr>
                    <thead>
                      
                        <th style="width:11%;">Date</th><th style="width:11%">Time</th><th style="width:11%">Type</th><th style="width:11%">Course</th><th style="width:11%">Title</th><th style="width:11%">Location</th><th style="width:11%">Instructor</th><th style="width:11%">Supervisor</th><th style="width:11%">Remark</th>
                     
                    </thead>
                     </tr>
                  
              <?php 

              for($i=0; $i<=$totaldate; $i++){ 
                //Declaration of array
                //if (!isset($dailydate[$i])) {
                 // $dailydate[$i]="";
                //}
                $datename="";
                $currentdate="";
                if ($i!=0) {
                  $startingdate=date('Y-m-d', strtotime($startingdate.'+ 1 days'));
                }
                

                  $recordday2=$SHtimetableOOP->alltimetableorder2('dailytimetable', 'timetablesemesterid', $timetablesemesterid, 'daydate', $startingdate, 'starttime', 'ASC');

                 if (is_array($recordday2)) {
                  foreach($recordday2 as $recordday2s){
                    
                    $sql="";
                    $timetableweekid=trim($recordday2s['timetableweekid']);
                    $datename=date("l jS F, Y", strtotime($startingdate));

                    $starttime=trim($recordday2s['starttime']);
                    $endtime=trim($recordday2s['endtime']);
                    $courseid=trim($recordday2s['courseid']);
                    $hallid=trim($recordday2s['hallid']);
                    $scheduletypeid=trim($recordday2s['scheduletypeid']);
                    $instructorid=trim($recordday2s['instructorid']);
                    $supervisorid=trim($recordday2s['supervisor']);

                    //Getting Week priority
                    $timetableweekdata=$SHtimetableOOP->alltimetableedit('timetableweek', 'timetableweekid', $timetableweekid);
                    if ($timetableweekdata) {
                    foreach($timetableweekdata as $timetableweekrecord){
                      $priority=trim($timetableweekrecord['priority']);
                      }
                    }

                    //Hall record
                    $hallrecords=$SHtimetableOOP->alltimetableedit('lecturehall', 'lecturehallid', $hallid);
                    if (is_array($hallrecords)) {
                      foreach($hallrecords as $hallrecord){
                        $hallname=trim($hallrecord['hallname']);
                        $hallcode=trim($hallrecord['shortname']);
                          }
                      }

                       //collecting Timetable record
                        $lecturecode="";
                        $lecturerecords=$SHtimetableOOP->alltimetableedit('lecturetype', 'lecturetypeid', $scheduletypeid);
                          if (is_array($lecturerecords)) {
                            foreach($lecturerecords as $lecturerecord){
                              $lecturecode=$lecturerecord['code'];
                              $lecturename=$lecturerecord['name'];
                               }
                          }

                    //Getting Course
                    $coursedata=$SHtimetableOOP->alltimetableedit('course', 'csid', $courseid);
                    if ($coursedata) {
                    foreach($coursedata as $courserecord){
                      $csname=trim($courserecord['csname']);
                      $coursecode=trim($courserecord['coursecode']);
                      }
                    }

                     //Getting Staff Detials
                    $staffsurname="";
                    $staffothername="";
                      $staffrecords=$SHtimetableOOP->alltimetableedit('staff', 'staffid', $instructorid);
                        if (is_array($staffrecords)) {
                          foreach($staffrecords as $staffrecord){
                            $staffsurname=$staffrecord['surname'];
                            $staffothername=$staffrecord['othername'];
                            }
                        }

                     //Getting Supervisor Detials
                                    $supersurname="";
                                    $superothername="";
                                 $superrecords=$SHtimetableOOP->alltimetableedit('staff', 'staffid', $supervisorid);
                                  if (is_array($superrecords)) {
                                 foreach($superrecords as $superrecord){
                                    $supersurname=$superrecord['surname'];
                                    $superothername=$superrecord['othername'];
                                 }
                               } ?>
                        <?php  if ($timetableweekid1!=$timetableweekid) { ?>
                        <tr  style="border:none"><td style="border:none"></td><td style="border:none" ></td><td style="border:none"></td><td style="border:none" ></td><td style="border:none; text-align: center; "><b> Week <?php echo $priority ?></b></td><td style="border:none" ></td><td style="border:none" ></td><td style="border:none"></td><td style="border:none"></td></tr>
                      <?php  } ?>

                      <tr>
                       <td style="font-size:12px; width:11%"><?php if ($datename!=$currentdate) { echo $datename; } ?></td><td><?php echo $starttime."-".$endtime;  ?></td><td title="<?php echo $lecturename; ?>"><?php echo $lecturecode; ?></td><td title="<?php echo $csname; ?>"><?php echo $coursecode; ?></td><td><?php echo $csname; ?></td><td title="<?php echo $hallname; ?>"><?php echo $hallcode ?></td><td><?php echo $staffsurname." ".$staffothername; ?></td><td><?php echo $supersurname." ".$superothername; ?></td><td></td>
                     </tr>
                    
                   <?php $timetableweekid1=$timetableweekid; $currentdate=$datename;
                    }//End of timetable loop ?>
                   
                  <?php }else{ $sql="Timetable Not found"; }
                
                //$dailydate[$i]=$startingdate;
                           
               }   ?>
               
                 </table>
                </td>
              </tr>
                  
              <?php }
              ?>

              <tr><td><?php echo $sql; ?></td></tr>
              <?php if ($i!="") { ?>
                   <tr><td><center><button class="btn btn-success print-link" ><i class="fa fa-print"></i> Print Timetable</button></center></td></tr>
              <?php } ?>
            </table>


         
                  </div>
         <?php  } ?>

         <?php //Second Category ?>
         <?php if($categoryid==2) {  
                   $i=0;
                        $priority="";
                        $priority1="";
                        $timetableweekid="";
                        $timetableweekid1="";
                        
                          //$datetime1 = new DateTime($startdate);

              //$datetime2 = new DateTime($enddate);
              $start_date = strtotime($startdate); 
              $end_date = strtotime($enddate); 

              //$difference = $datetime1->diff($datetime2);
              $totaldate=($end_date - $start_date)/60/60/24; 
            
              $startingdate=$startdate; ?>
              <div class="x_panel">
              <table  id="printrecord" style="width:100%;" class="table table-striped table-bordered table-responsive">    
                <?php //Getting Timetable Information

               
                            $instiname="";
                              //Getting Department information
                              $institution1=$SHtimetableOOP->alltimetableedit('institution', 'departmentid', $timetabledid);
                              if (is_array($institution1)) {
                              foreach($institution1 as $institution1s){
                                $instiname=$institution1s['instiname'];
                              }
                            }

                             //collecting Timetable record
                                    $typename="";
                                     $typerecords=$SHtimetableOOP->alltimetableedit('timetabletype', 'timetabletypeid', $timetabletypeid);
                                     if (is_array($typerecords)) {
                                     foreach($typerecords as $typerecord){
                                        $typename=$typerecord['typename'];
                                        
                                     }
                                   }

                               $deptname="";
                              //Getting Department information
                              $record1=$SHtimetableOOP->alltimetableedit('department', 'did', $timetabledid);
                              if (is_array($record1)) {
                              foreach($record1 as $record1s){
                                $deptname=$record1s['deptname'];
                              }
                            }
                 ?>
                 <tr style="background: white; border-collapse: collapse;" cellpadding="0px" cellspacing="0px"><td style="text-align: center"><span style="font-size: 30px"><?php echo $instiname; ?> </span><br>
                  <span style="font-size: 18px"><?php echo $typename; ?> Timetable for <?php echo $semestername ; ?> of <?php echo $sessionname; ?></span>
                  <br>Department: <?php echo $deptname ?> </td></tr>
              <?php if ((is_numeric($totaldate)) && ($totaldate>=0)) {?>
              <tr cellpadding="0px" cellspacing="0px" style="border-collapse: collapse; background: white">
                <td cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                  <table  style="width:100%; text-align:center; border-collapse: collapse; padding:2px" class="table table-striped table-bordered table-responsive" >
                    <tr>
                    <thead>
                      
                        <th style="width:12%;">Date</th><th style="width:9%">Time</th><th style="width:11%">Level|Class</th><th style="width:9%">Option|Group</th><th style="width:9%">Type</th><th style="width:9%">Course</th><th style="width:9%">Title</th><th style="width:9%">Location</th><th style="width:11%">Instructor</th><th style="width:9%">Supervisor</th><th style="width:9%">Remark</th>
                     
                    </thead>
                     </tr>
                  
              <?php 
                   //Sorting out classes under this department
                 $ttlevelid="";

                 $r=0;

                 $array_semesterid=array();
                
                $levelobject1=$SHtimetableOOP->alltimetableorder('level', 'departmentid', $timetabledid, 'levelrank', 'ASC');
                                if(is_array($levelobject1)){
                                foreach($levelobject1 as $levelrecord1){
                                  $ttlevelid=trim($levelrecord1['levelid']);
                                  $optionname="";
                                  $ttoptionid="";                             
                                   $optionobject1=$SHtimetableOOP->alltimetableorder2('optiontable', 'levelid', $ttlevelid, 'departmentid', $timetabledid, 'optpriority', 'ASC');
                                   if(is_array($optionobject1)){
                                      foreach($optionobject1 as $optionrecord1){
                                        $optionname=$optionrecord1['optname'];
                                        $ttoptionid=trim($optionrecord1['optid']);

                                        
                                         $records=$SHtimetableOOP->alltimetableedit4('timetablesemester', 'levelid', $ttlevelid, 'timetabletypeid', $timetabletypeid, 'optionid', $ttoptionid, 'levelid', $ttlevelid);
                                          
                                          if (is_array($records)) {
                                            $tt_timetablesemesterid="";
                                          foreach($records as $fieldrecord){

                                             
                                              if (!isset($array_semesterid[$r])) {
                                                $array_semesterid[$r]="";
                                              }
                                              $array_semesterid[$r]=trim($fieldrecord['timetablesemesterid']);
                                              $r+=1;
                                            }
                                          }

                                     }
                                    }

                                   
                                   
                                   

                    }//class loop end
                }// class check end

                        $array_uniquetime=array();    
               $timetablesemeste3=$SHtimetableOOP->alltorder2distinct('dailytimetable',  'starttime', 'ASC', 'starttime', 'endtime');
                                if (is_array($timetablesemeste3)) {
                                foreach($timetablesemeste3 as $timetablesemeste3s){

                                        
                                        if(count($array_uniquetime)>0){

                                        foreach($array_uniquetime as $key1 =>$array_uniquetimeval){
                                          
                                            //Checking whether starttime has been added already
                                            if ($array_uniquetimeval!=trim($timetablesemeste3s['starttime']) ) {
                                             
                                             $starttimestatus=1;
                                             
                                            }

                                          }
                                        }else{
                                          $starttimestatus=1;
                                        }

                                 //Adding to the timetable array
                                        if ($starttimestatus==1) {

                                          if (!isset($array_uniquetime)) {
                                            $array_uniquetime[]="";
                                          }
                                         
                                          $array_uniquetime[]=trim($timetablesemeste3s['starttime']);
                                          $starttimestatus=0;
                                         
                                        }

                                  }
                                }
        

              for($i=0; $i<=$totaldate; $i++){ 
                //Declaration of array
                //if (!isset($dailydate[$i])) {
                 // $dailydate[$i]="";
                //}
                $datename="";
                $currentdate="";
                if ($i!=0) {
                  $startingdate=date('Y-m-d', strtotime($startingdate.'+ 1 days'));
                }

                if (is_array($array_uniquetime)) {
                                 
                 sort($array_uniquetime); //Sort array in ascending order
                 foreach($array_uniquetime as $selectstarttime){ //Going through selected timetable
                          

                 foreach ($array_semesterid as $key => $timetablesemesterid) { //Looping Timetable semesterid

                      $levelidcol="";
                      $levelidcolname="";
                      $optionidcol="";
                      $optionidcolname="";
                     $record10=$SHtimetableOOP->alltimetableedit('timetablesemester', 'timetablesemesterid', $timetablesemesterid);
                     if (is_array($record10)) {
                       foreach($record10 as $record10data){
                        $levelidcol=trim($record10data['levelid']);
                        $optionidcol=trim($record10data['optionid']);

                        $levelname="";
                              $levelobject=$SHtimetableOOP->alltimetableedit('level', 'levelid', $levelidcol);
                                if(is_array($levelobject)){
                                foreach($levelobject as $levelrecord){
                                  $levelidcolname=$levelrecord['levelname'];
                                  
                                  }
                                }

                        $optionname="";
                        $optionobject=$SHtimetableOOP->alltimetableedit('optiontable', 'optid',  $optionidcol);
                            if(is_array($optionobject)){
                              foreach($optionobject as $optionrecord){
                              $optionidcolname=$optionrecord['optname'];
                              }
                            }

                       }
                     }

                
                  $recordday2=$SHtimetableOOP->alltimetableedit3('dailytimetable', 'timetablesemesterid', $timetablesemesterid, 'daydate', $startingdate, 'starttime', $selectstarttime);

                 if (is_array($recordday2)) {
                  foreach($recordday2 as $recordday2s){
                    
                    $sql="";

                    $timetableweekid=trim($recordday2s['timetableweekid']);
                    $datename=date("l jS F, Y", strtotime($startingdate));

                    $starttime=trim($recordday2s['starttime']);
                    $endtime=trim($recordday2s['endtime']);
                    $courseid=trim($recordday2s['courseid']);
                    $hallid=trim($recordday2s['hallid']);
                    $scheduletypeid=trim($recordday2s['scheduletypeid']);
                    $instructorid=trim($recordday2s['instructorid']);
                    $supervisorid=trim($recordday2s['supervisor']);

                    //Getting Week priority
                    $timetableweekdata=$SHtimetableOOP->alltimetableedit('timetableweek', 'timetableweekid', $timetableweekid);
                    if ($timetableweekdata) {
                    foreach($timetableweekdata as $timetableweekrecord){
                      $priority=trim($timetableweekrecord['priority']);
                      }
                    }

                    //Hall record
                    $hallrecords=$SHtimetableOOP->alltimetableedit('lecturehall', 'lecturehallid', $hallid);
                    if (is_array($hallrecords)) {
                      foreach($hallrecords as $hallrecord){
                        $hallname=trim($hallrecord['hallname']);
                        $hallcode=trim($hallrecord['shortname']);
                          }
                      }

                       //collecting Timetable record
                        $lecturecode="";
                        $lecturerecords=$SHtimetableOOP->alltimetableedit('lecturetype', 'lecturetypeid', $scheduletypeid);
                          if (is_array($lecturerecords)) {
                            foreach($lecturerecords as $lecturerecord){
                              $lecturecode=$lecturerecord['code'];
                              $lecturename=$lecturerecord['name'];
                               }
                          }

                    //Getting Course
                    $coursedata=$SHtimetableOOP->alltimetableedit('course', 'csid', $courseid);
                    if ($coursedata) {
                    foreach($coursedata as $courserecord){
                      $csname=trim($courserecord['csname']);
                      $coursecode=trim($courserecord['coursecode']);
                      }
                    }

                     //Getting Staff Detials
                    $staffsurname="";
                    $staffothername="";
                      $staffrecords=$SHtimetableOOP->alltimetableedit('staff', 'staffid', $instructorid);
                        if (is_array($staffrecords)) {
                          foreach($staffrecords as $staffrecord){
                            $staffsurname=$staffrecord['surname'];
                            $staffothername=$staffrecord['othername'];
                            }
                        }

                     //Getting Supervisor Detials
                                    $supersurname="";
                                    $superothername="";
                                 $superrecords=$SHtimetableOOP->alltimetableedit('staff', 'staffid', $supervisorid);
                                  if (is_array($superrecords)) {
                                 foreach($superrecords as $superrecord){
                                    $supersurname=$superrecord['surname'];
                                    $superothername=$superrecord['othername'];
                                 }
                               } ?>
                        <?php  if ($priority1!=$priority) {   ?>
                        <tr  style="border:none"><td style="border:none"></td><td style="border:none" ></td><td style="border:none"></td><td style="border:none" ></td><td style="border:none; text-align: center; "></td><td style="border:none" ><b> Week <?php echo $priority ?></b></td><td style="border:none" ></td><td style="border:none"></td><td style="border:none"></td><td style="border:none"></td><td style="border:none"></td></tr>
                      <?php  } ?>

                      <tr>
                       <td style="font-size:8px; "><b><?php if ($datename!=$currentdate) { echo $datename; } ?></b></td><td><?php echo $starttime."-".$endtime;  ?></td><td ><?php echo $levelidcolname; ?></td><td ><?php echo $optionidcolname; ?></td><td title="<?php echo $lecturename; ?>"><?php echo $lecturecode; ?></td><td title="<?php echo $csname; ?>"><?php echo $coursecode; ?></td><td style="font-size:8px; width:9%"><b><?php echo $csname; ?></b></td><td title="<?php echo $hallname; ?>"><?php echo $hallcode ?></td><td style="font-size:10px;"><?php echo $staffsurname." ".$staffothername; ?></td><td style="font-size:10px; width:9%"><?php echo $supersurname." ".$superothername; ?></td><td></td>
                     </tr>
                    
                   <?php $timetableweekid1=$timetableweekid; 
                        $priority1=$priority;
                          $currentdate=$datename;
                    }//End of timetable loop 

                   ?>
                  <?php }else{ $sql="Some Daily Timetable Not found"; }

                   //$dailydate[$i]=$startingdate;
                   } //End of timetable semester setup loop 

                 } //End of lecturetime loop 
                }//End of lecturetime array check
                
               }  //this  End of for loop
               ?>
               
                 </table>
                </td></tr>
              
                  
              <?php }
              ?>

              <tr><td><?php echo $sql; ?></td></tr>
              <?php if ($i!=0) { ?>
                   <tr><td><center><button class="btn btn-success print-link" ><i class="fa fa-print"></i> Print Timetable</button></center></td></tr>
              <?php } ?>
            </table>
                  </div>
         <?php  } ?>


         <?php //Second Category ?>
         <?php if($categoryid==3) {  
                   $i=0;
                        $priority="";
                        $priority1="";
                        $timetableweekid="";
                        $timetableweekid1="";
                        
                          //$datetime1 = new DateTime($startdate);

              //$datetime2 = new DateTime($enddate);
              $start_date = strtotime($startdate); 
              $end_date = strtotime($enddate); 

              //$difference = $datetime1->diff($datetime2);
              $totaldate=($end_date - $start_date)/60/60/24; 
            
              $startingdate=$startdate; ?>
              <div class="x_panel">
              <table  id="printrecord" style="width:100%; " class="table table-striped table-bordered table-responsive">    
                <?php //Getting Timetable Information

                             $instiname="";
                              //Getting Department information
                              $institution1=$SHtimetableOOP->alltimetable('institution', 'i_id', 'ASC');
                              if (is_array($institution1)) {
                              foreach($institution1 as $institution1s){
                                $instiname=$institution1s['instiname'];
                              }
                            }

                            

                 ?>
                 <tr style="background: white; border-collapse: collapse;" cellpadding="0px" cellspacing="0px"><td style="text-align: center"><span style="font-size: 30px"><?php echo $instiname; ?> </span><br>
                  <span style="font-size: 18px"><?php echo $typename; ?> Timetable for <?php echo $semestername ; ?> of <?php echo $sessionname; ?></span>
                   </td></tr>
              <?php if ((is_numeric($totaldate)) && ($totaldate>=0)) {?>
              <tr cellpadding="0px" cellspacing="0px" style="border-collapse: collapse; background: white">
                <td cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                  <table  style="width:100%; text-align:center; border-collapse: collapse; padding:2px" class="table table-striped table-bordered table-responsive" >
                    <tr>
                    <thead>
                      
                        <th style="width:12%;">Date</th><th style="width:9%">Time</th><th style="width:9%;">Department</th><th style="width:9%">Level|Class</th><th style="width:9%">Option|Group</th><th style="width:9%">Type</th><th style="width:9%">Course</th><th style="width:9%">Title</th><th style="width:9%">Location</th><th style="width:11%">Instructor</th><th style="width:9%">Supervisor</th><th style="width:9%">Remark</th>
                     
                    </thead>
                     </tr>
                  
              <?php 
                   //Sorting out classes under this department
                 $ttlevelid="";

                 $r=0;
                  $r1=0;

                 $array_semesterid=array();

                  //Department
                  $departobject1=$SHtimetableOOP->alltorderdistinct0('department', 'did', 'ASC', 'did');
                                if(is_array($departobject1)){
                                foreach($departobject1 as $departrecord1){
                                $timetabledid=trim($departrecord1['did']);
                               

                  $levelobject1=$SHtimetableOOP->alltimetableorder('level', 'departmentid', $timetabledid, 'levelrank', 'ASC');
                                if(is_array($levelobject1)){
                                foreach($levelobject1 as $levelrecord1){
                                   $ttlevelid=trim($levelrecord1['levelid']);
                                  $optionname="";
                                  $ttoptionid=""; 
                                   

                                   $optionobject1=$SHtimetableOOP->alltimetableorder2('optiontable', 'levelid', $ttlevelid, 'departmentid', $timetabledid, 'optpriority', 'ASC');
                                   if(is_array($optionobject1)){
                                      foreach($optionobject1 as $optionrecord1){
                                       $optionname=$optionrecord1['optname'];
                                        $ttoptionid=trim($optionrecord1['optid']);
                                        

                                    $typeobject=$SHtimetableOOP->alltimetableedit2('timetabletype', 'typename', $typename, 'departmentid', $timetabledid);
                                    if(is_array($typeobject)){
                                    foreach($typeobject as $typerecord){
                                     $timetabletypeid=trim($typerecord['timetabletypeid']);

                                        
                                        $records=$SHtimetableOOP->alltimetableedit4('timetablesemester', 'levelid', $ttlevelid, 'timetabletypeid', $timetabletypeid, 'optionid', $ttoptionid, 'levelid', $ttlevelid);
                              
                                          if (is_array($records)) {
                                            $tt_timetablesemesterid="";
                                          foreach($records as $fieldrecord){
                                             
                                        if(count($array_semesterid)>0){

                                        foreach($array_semesterid as $key2 =>$array_semesterval){
                                            $array_semesterval=trim($array_semesterval);
                                            //Checking whether starttime has been added already


                                            if ($array_semesterval!=trim($fieldrecord['timetablesemesterid']) ){
                                             $semesterstatus=1;
                                            }

                                          }
                                        }else{
                                          $semesterstatus=1;
                                        }

                                 //Adding to the timetable array
                                        if ($semesterstatus==1) {

                                          if (!isset($array_semesterid[$r1])) {
                                                $array_semesterid[$r1]="";
                                              }
                                           $array_semesterid[$r1]=trim($fieldrecord['timetablesemesterid']);

                                              $r1+=1;
                                          $semesterstatus=0;
                                         
                                        }

                                             
                                            }
                                          }

                                     }
                                    }

                                   
                                    //array to collect unique timetable time
                                    $array_uniquetime=array();
                                   
                                    $capturestarttime="";
                                    $array_uniquetimeval="";



                                  
                                    
                                
                          }
                        }
                        
                            

                    }//class loop end
                  }// class check end

                }
              }
                            
                
              $timetablesemeste3=$SHtimetableOOP->alltorder2distinct('dailytimetable',  'starttime', 'ASC', 'starttime', 'endtime');
                                if (is_array($timetablesemeste3)) {
                                foreach($timetablesemeste3 as $timetablesemeste3s){

                                        
                                        if(count($array_uniquetime)>0){

                                        foreach($array_uniquetime as $key1 =>$array_uniquetimeval){
                                          
                                            //Checking whether starttime has been added already
                                            if ($array_uniquetimeval!=trim($timetablesemeste3s['starttime']) ) {
                                             
                                             $starttimestatus=1;
                                             
                                            }

                                          }
                                        }else{
                                          $starttimestatus=1;
                                        }

                                 //Adding to the timetable array
                                        if ($starttimestatus==1) {

                                          if (!isset($array_uniquetime)) {
                                            $array_uniquetime[]="";
                                          }
                                         
                                          $array_uniquetime[]=trim($timetablesemeste3s['starttime']);
                                          $starttimestatus=0;
                                         
                                        }

                                  }
                                }
        

              for($i=0; $i<=$totaldate; $i++){ 
                //Declaration of array
                //if (!isset($dailydate[$i])) {
                 // $dailydate[$i]="";
                //}
                $datename="";
                $currentdate="";
                if ($i!=0) {
                  $startingdate=date('Y-m-d', strtotime($startingdate.'+ 1 days'));
                }

                if (is_array($array_uniquetime)) {
                                 
                 sort($array_uniquetime); //Sort array in ascending order
                 foreach($array_uniquetime as $endtime=> $selectstarttime){ //Going through selected timetable
                          

                 foreach ($array_semesterid as $key => $timetablesemesterid) { //Looping Timetable semesterid

                      $levelidcol="";
                      $levelidcolname="";
                      $optionidcol="";
                      $optionidcolname="";
                     $record10=$SHtimetableOOP->alltimetableedit('timetablesemester', 'timetablesemesterid', $timetablesemesterid);
                     if (is_array($record10)) {
                       foreach($record10 as $record10data){
                        $levelidcol=trim($record10data['levelid']);
                        $optionidcol=trim($record10data['optionid']);

                        $levelname="";
                              $levelobject=$SHtimetableOOP->alltimetableedit('level', 'levelid', $levelidcol);
                                if(is_array($levelobject)){
                                foreach($levelobject as $levelrecord){
                                  $levelidcolname=$levelrecord['levelname'];
                                  $departmentid=trim($levelrecord['departmentid']);
                                  }
                                }

                        $optionname="";
                        $optionobject=$SHtimetableOOP->alltimetableedit('optiontable', 'optid',  $optionidcol);
                            if(is_array($optionobject)){
                              foreach($optionobject as $optionrecord){
                              $optionidcolname=$optionrecord['optname'];
                              }
                            }

                               $deptname="";
                              //Getting Department information
                              $record1=$SHtimetableOOP->alltimetableedit('department', 'did', $departmentid);
                              if (is_array($record1)) {
                              foreach($record1 as $record1s){
                                $deptname=$record1s['deptname'];
                                  }
                                }


                       }
                     }

                
                  $recordday2=$SHtimetableOOP->alltimetableedit3('dailytimetable', 'timetablesemesterid', $timetablesemesterid, 'daydate', $startingdate, 'starttime', $selectstarttime);

                 if (is_array($recordday2)) {
                  foreach($recordday2 as $recordday2s){
                    
                    $sql="";

                    $timetableweekid=trim($recordday2s['timetableweekid']);
                    $datename=date("l jS F, Y", strtotime($startingdate));

                    $starttime=trim($recordday2s['starttime']);
                    $endtime=trim($recordday2s['endtime']);
                    $courseid=trim($recordday2s['courseid']);
                    $hallid=trim($recordday2s['hallid']);
                    $scheduletypeid=trim($recordday2s['scheduletypeid']);
                    $instructorid=trim($recordday2s['instructorid']);
                    $supervisorid=trim($recordday2s['supervisor']);


                    //Getting Week priority
                    $timetableweekdata=$SHtimetableOOP->alltimetableedit('timetableweek', 'timetableweekid', $timetableweekid);
                    if ($timetableweekdata) {
                    foreach($timetableweekdata as $timetableweekrecord){
                      $priority=trim($timetableweekrecord['priority']);
                      }
                    }

                    //Hall record
                    $hallrecords=$SHtimetableOOP->alltimetableedit('lecturehall', 'lecturehallid', $hallid);
                    if (is_array($hallrecords)) {
                      foreach($hallrecords as $hallrecord){
                        $hallname=trim($hallrecord['hallname']);
                        $hallcode=trim($hallrecord['shortname']);
                          }
                      }

                       //collecting Timetable record
                        $lecturecode="";
                        $lecturerecords=$SHtimetableOOP->alltimetableedit('lecturetype', 'lecturetypeid', $scheduletypeid);
                          if (is_array($lecturerecords)) {
                            foreach($lecturerecords as $lecturerecord){
                              $lecturecode=$lecturerecord['code'];
                              $lecturename=$lecturerecord['name'];
                               }
                          }

                    //Getting Course
                    $coursedata=$SHtimetableOOP->alltimetableedit('course', 'csid', $courseid);
                    if ($coursedata) {
                    foreach($coursedata as $courserecord){
                      $csname=trim($courserecord['csname']);
                      $coursecode=trim($courserecord['coursecode']);
                      }
                    }

                     //Getting Staff Detials
                    $staffsurname="";
                    $staffothername="";
                      $staffrecords=$SHtimetableOOP->alltimetableedit('staff', 'staffid', $instructorid);
                        if (is_array($staffrecords)) {
                          foreach($staffrecords as $staffrecord){
                            $staffsurname=$staffrecord['surname'];
                            $staffothername=$staffrecord['othername'];
                            }
                        }

                     //Getting Supervisor Detials
                                    $supersurname="";
                                    $superothername="";
                                 $superrecords=$SHtimetableOOP->alltimetableedit('staff', 'staffid', $supervisorid);
                                  if (is_array($superrecords)) {
                                 foreach($superrecords as $superrecord){
                                    $supersurname=$superrecord['surname'];
                                    $superothername=$superrecord['othername'];
                                 }
                               } 

                               
                               ?>
                        <?php  if ($priority1!=$priority) {   ?>
                        <tr  style="border:none"><td style="border:none"></td><td style="border:none"></td><td style="border:none" ></td><td style="border:none"></td><td style="border:none" ></td><td style="border:none; text-align: center; "><b> Week <?php echo $priority ?></b></td><td style="border:none" ></td><td style="border:none" ></td><td style="border:none"></td><td style="border:none"></td><td style="border:none"></td><td style="border:none"></td></tr>
                      <?php  } ?>

                      <tr>
                       <td style="font-size:8px; margin: 0.5px; padding: 0.5px"><b><?php if ($datename!=$currentdate) { echo $datename; } ?></b></td><td style="margin: 0.5px; padding: 0.5px"><?php echo $starttime."-".$endtime;  ?></td><td  style="font-size:8px; margin: 0.5px; padding: 0.5px"><?php echo $deptname; ?></td><td style="margin: 0.5px; padding: 0.5px"><?php echo $levelidcolname; ?></td><td style="margin: 0.5px; padding: 0.5px"><?php echo $optionidcolname; ?></td><td style="margin: 0.5px; padding: 0.5px" title="<?php echo $lecturename; ?>"><?php echo $lecturecode; ?></td><td title="<?php echo $csname; ?>" style="margin: 0.5px; padding: 0.5px"><?php echo $coursecode; ?></td><td style="font-size:8px; width:9%; margin: 0.5px; padding: 0.5px"><b><?php echo $csname; ?></b></td><td title="<?php echo $hallname; ?>"  style="margin: 0.5px; padding: 0.5px"><?php echo $hallcode ?></td><td style="font-size:10px; margin: 0.5px; padding: 0.5px"><?php echo $staffsurname." ".$staffothername; ?></td><td style="font-size:10px; width:9%; margin: 0.5px; padding: 0.5px"><?php echo $supersurname." ".$superothername; ?></td><td></td>
                     </tr>
                    
                   <?php $timetableweekid1=$timetableweekid; 
                        $priority1=$priority;
                          $currentdate=$datename;
                    }//End of timetable loop 

                   ?>
                  <?php }else{ $sql="Some Daily Timetable Not found"; }

                   //$dailydate[$i]=$startingdate;
                   } //End of timetable semester setup loop 

                 } //End of lecturetime loop 
                }//End of lecturetime array check
                
               }  //this  End of for loop
               ?>
               
                 </table>
                </td></tr>
              
                  
              <?php }
              ?>

              <tr><td><?php echo $sql; ?></td></tr>
              <?php if ($i!=0) { ?>
                   <tr><td><center><button class="btn btn-success print-link" ><i class="fa fa-print"></i> Print Timetable</button></center></td></tr>
              <?php } ?>
            </table>
                  </div>
         <?php  } ?>

              </div>
            </div>
       <?php include("includes/footer.php"); ?>