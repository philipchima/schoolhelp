
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHbusaryOOP.php");
include_once("../phpclass/SHbusaryupdate.php");
include_once("../phpclass/SHbusaryinserts.php");
confirmcheckin();
$SHbusaryOOP=new classBusary;


$tableUpdate= new updateTable;
$tableInsert=new insertTable;
$page=trim(isset($_GET['page'])?$_GET['page']:false);
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Setup Fee";

$odate=date("Y-m-d");
$udate=date("Y-m-d H:i:s");

 //Staff class
if($page==1) {
  $numberoffields=trim(isset($_POST['numberoffields'])?$_POST['numberoffields']:false);
}

$previllages=$SHbusaryOOP->allbusaryedit('adminpersons', 'adminid', $schoolhelp);
foreach($previllages as $actualrecord){
  $pageaccess=trim($actualrecord['bursary_d']);
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
        $semesterdata=$SHbusaryOOP->allbusaryedit('semesters','status', 1);
            if (is_array($semesterdata)) {
                foreach($semesterdata as $semesterrecord){
                    $semestername=$semesterrecord['semestername'];
                    $semesterid=trim($semesterrecord['semesterid']);
                    
              }
          }


        //Select current Session
         $sessiondata=$SHbusaryOOP->allbusaryedit('session','status', 1);
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
    $feename=isset($_POST['feename'])?$_POST['feename']:false;
    $departmentid=trim(isset($_POST['departmentid'])?$_POST['departmentid']:false);


    $state="Completely Unsuccessfully";

    foreach($feename as $typecount=>$typenames){

    $name=trim(ucwords($typenames));
    $description=trim(isset($_POST['description'.$typecount])?$_POST['description'.$typecount]:false);
    $amount=trim(isset($_POST['amount'.$typecount])?$_POST['amount'.$typecount]:false);
    $compulsory=trim(isset($_POST['compulsory'.$typecount])?$_POST['compulsory'.$typecount]:false);

      
    //Checking Whetter Exam type has been added
     $records=$SHbusaryOOP->allbusaryedit2('setupfees', 'feename', $name, 'departmentid', $departmentid);
        if (is_array($records)) {
           $sql="This ".$pagename." is found in the database";
        }
    else{

    $insertedrec+=1;
    $state=$tableInsert->insert_8fields('setupfees', 'departmentid', $departmentid, 'feename', $name, 'amount', $amount, 'description', $description, 'compulsory', $compulsory, 'operatorid', $schoolhelp, 'udate', $udate, 'odate', $odate);
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
  $setupfeesid=trim(isset($_POST['setupfeesid'])?$_POST['setupfeesid']:false);

  $feename=trim(isset($_POST['feename'])?$_POST['feename']:false);
  $amount=trim(isset($_POST['amount'])?$_POST['amount']:false);
  $compulsory=trim(isset($_POST['compulsory'])?$_POST['compulsory']:false);
  $description=trim(isset($_POST['description'])?$_POST['description']:false);
  $departmentid=trim(isset($_POST['departmentid'])?$_POST['departmentid']:false);
 
$state=$tableUpdate->update_sixfields('setupfees', 'setupfeesid', $setupfeesid, 'departmentid', $departmentid, 'feename',  $feename, 'amount', $amount, 'compulsory', $compulsory, 'description', $description, 'operatorid', $schoolhelp);

$sql=$state.":: Update Made, affected records = 1";
 }
 
echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
 
}


if ($page==6) {
   $sql="Criminal Suspected";
  if ($dashdelete_d==1) {
  
   $setupfeesid=trim(isset($_GET['id'])?$_GET['id']:false);
   //$photo=trim(isset($_GET['photo'])?$_GET['photo']:false);
   $tableUpdate= new updateTable;
    $state=$tableUpdate->delete_bursary('setupfees', 'setupfeesid', $setupfeesid);

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
                      
                      <li><a class="btn btn-success " href="../?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"> Dashboard</i></a>
                      <li><a class="btn btn-primary" href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Bursary Dashboard </i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                          <?php if ($dashadd_d==1) { ?>
                          
                      <li><a href="#" data-toggle="modal" data-target="#myModal" ><i class="fa fa-plus"></i> Add Fee</a>
                      </li>
                      <?php } ?>
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> View Fee</a>
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
                      <legend style="color:#063"><?php echo $pagename; ?> Reports</legend>
                      <table   class="table table-striped table-bordered table-responsive">
                        <thead>
                          <tr>
                            <th style="width: 5px">SN</th>

                             <th>Dept Name</th>
                             <th>Level Name</th>
                             <th>Involved Fees</th>
                            <th>View</th>
                            <th>Generate Fee</th>
                          
                          </tr>
                        </thead>

                        <tbody>

                          <?php 
                          $k=0;
                          

                          if ($admintype==1) {
                              $records=$SHbusaryOOP->allstudent('level', 'levelrank', 'ASC');
                            }else{
                              $records=$SHbusaryOOP->allbusaryorder('level', 'departmentid', $logindepartmentid, 'levelrank', 'ASC')
                            }

                           if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                                $departmentid="";
                                $k+=1;
                                $optionid="";
                                $male="";
                                $female="";
                                $boarder="";
                                $departmentid=trim($fieldrecord['departmentid']);
                                
                              $records3=$SHbusaryOOP->allstudentedit('department', 'did', $departmentid);
                              if (is_array($records3)) {
                                 foreach($record3 as $fieldrecord3){
                                  $deptname=trim($fieldrecord3['deptname']);
                                 }
                               }

                           ?>

                          <tr>

                            <td><?php echo $k; ?></td>
                             <td><?php echo $deptname; ?></td>
                            <td><?php echo trim($fieldrecord['levelname']); ?> (All Group)</td>
                            
                            <!-- Involved fees -->
                            <td>
                              <table>
                                <tr>
                                  <?php 
                                  $amount="";
                                    $records3=$SHbusaryOOP->allstudentedit('setupfees', 'departmentid', $departmentid);
                                      if (is_array($records3)) { 
                                        foreach($record3 as $fieldrecord3){
                                        ?>
                                        <td style="font-size:12px" data-toggle="tooltip" data-placement="top"  required="required" data-html="true" title="<em> <ul >
                                            <li><span><?php echo trim($records3['feename']); ?></span> : <?php echo trim($records3['amount']); ?></li>
                                            
                                            </ul></em>"><?php echo substr(trim($records3['feename'])); ?>:<b><?php echo trim($records3['amount']); ?></b></td>
                                      <?php 
                                          $amount+=trim($records3['feename']);
                                         }
                                      }
                                   ?>
                                   <td>Total: <?php echo $amount; ?></td>
                                </tr>
                              </table>
                            </td>

                            <?php // Checking Whether payment has been generated

                                $records4=$SHbusaryOOP->allstudentedit('setupfees', 'departmentid', $departmentid);
                                      if (is_array($records4)) { 
                                        foreach($record4 as $fieldrecord4){
                                        }
                                      }
                            ?>


                            <td>Generate</td>
                            <td>View debt, add and update</td>
                            <td>Payments</td>

                          </tr>

                           <?php 
                           // Selecting groups
                           $records1=$SHbusaryOOP->allstudenteditorder('optiontable', 'levelid', trim($fieldrecord['levelid']), 'optpriority', 'ASC');
                            if (is_array($records1)) { ?>
                                 
                          <?php foreach($records1 as $fieldrecord1){ 
                                 $k+=1;
                                $optionid="";
                                $male="";
                                $female="";
                                $boarder="";
                                $daily=0;
                                $suspended=0;
                                $active=0;
                                $all=0;

                            ?>

                            <tr>

                            <td><?php echo $k; ?></td>
                            <td><?php echo trim($fieldrecord['levelname'])." ".trim($fieldrecord1['optname']) ; ?> </td>
                            <td style="font-size:24px"><center><a href="male?schoolhelp=<?php echo $schoolhelp; ?>&type=2&levelid=<?php echo trim($fieldrecord['levelid']) ?>&optionid=<?php echo trim($fieldrecord1['optid']); ?>"><?php echo  $male=count($records=$SHbusaryOOP->allstudentedit5('students', 'status', 0, 'access', 0, 'sexid', 1, 'levelid', trim($fieldrecord['levelid']),  'optid', trim($fieldrecord1['optid']))); 
                            $total_male+=$male;
                            ?></a></center></td>
                            <td style="font-size:24px"><center><a href="female?schoolhelp=<?php echo $schoolhelp; ?>&type=2&levelid=<?php echo trim($fieldrecord['levelid']) ?>&optionid=<?php echo trim($fieldrecord1['optid']); ?>"><?php echo  $female=count($records=$SHbusaryOOP->allstudentedit5('students', 'status', 0, 'access', 0, 'sexid', 2, 'levelid', trim($fieldrecord['levelid']), 'optid', trim($fieldrecord1['optid']) )); 
                            $total_female+=$female;
                            ?></a></center></td>
                             <td style="font-size:24px"><center><a href="boarder?schoolhelp=<?php echo $schoolhelp; ?>&type=2&levelid=<?php echo trim($fieldrecord['levelid']) ?>&optionid=<?php echo trim($fieldrecord1['optid']); ?>"><?php echo  $boarder=count($records=$SHbusaryOOP->allstudentedit5('students', 'status', 0, 'access', 0, 'studenttype', 2, 'levelid', trim($fieldrecord['levelid']),  'optid', trim($fieldrecord1['optid']))); 
                             $total_boarder+=$boarder;
                            ?></a></center></td>
                            <td style="font-size:24px"><center><a href="daily?schoolhelp=<?php echo $schoolhelp; ?>&type=2&levelid=<?php echo trim($fieldrecord['levelid']) ?>&optionid=<?php echo trim($fieldrecord1['optid']); ?>"><?php echo  $dialy=count($records=$SHbusaryOOP->allstudentedit5('students', 'status', 0, 'access', 0, 'studenttype', 1, 'levelid', trim($fieldrecord['levelid']),  'optid', trim($fieldrecord1['optid']) )); 
                             $total_daily+=$daily;
                            ?></a></center></td>
                           
                            <td style="font-size:24px"><center><a href="suspended?schoolhelp=<?php echo $schoolhelp; ?>&type=2&levelid=<?php echo trim($fieldrecord['levelid']) ?>&optionid=<?php echo trim($fieldrecord1['optid']); ?>"><?php echo $suspended=count($records=$SHbusaryOOP->allstudentedit4('students', 'status', 0, 'access', 1, 'levelid', trim($fieldrecord['levelid']),  'optid', trim($fieldrecord1['optid']) )); 
                            $total_suspended+=$suspended;
                            ?></a></td>
                            <td style="font-size:24px"><center><a href="active?schoolhelp=<?php echo $schoolhelp; ?>&type=2&levelid=<?php echo trim($fieldrecord['levelid']) ?>&optionid=<?php echo trim($fieldrecord1['optid']); ?>"><?php echo $active=count($records=$SHbusaryOOP->allstudentedit4('students', 'status', 0, 'access', 0, 'levelid', trim($fieldrecord['levelid']),  'optid', trim($fieldrecord1['optid']) )); 
                            $total_active+=$active;
                            ?></a></td>
                            <td style="font-size:24px"><center><a href="total?schoolhelp=<?php echo $schoolhelp; ?>&type=2&levelid=<?php echo trim($fieldrecord['levelid']) ?>&optionid=<?php echo trim($fieldrecord1['optid']); ?>"><?php echo $all=count($records=$SHbusaryOOP->allstudentedit3('students', 'status', 0,  'levelid', trim($fieldrecord['levelid']),  'optid', trim($fieldrecord1['optid']) )); 
                            $total_all+=$all;
                            ?></a></td>

                          </tr>

                        

                          <?php }
                            } 
                            ?>

                         <?php } ?>

                            <tr style="background: #064; color:white">
                            <td></td>
                              <td>Total </td>
                            <td style="font-size:24px"><center><a href="male?schoolhelp=<?php echo $schoolhelp; ?>&type=3"><?php echo  count($records=$SHbusaryOOP->allstudentedit3('students', 'status', 0, 'access', 0, 'sexid', 1)); ?></a></center></td>
                            
                            
                            <td style="font-size:24px"><center><a href="female?schoolhelp=<?php echo $schoolhelp; ?>&type=3"><?php echo count($records=$SHbusaryOOP->allstudentedit3('students', 'status', 0, 'access', 0, 'sexid', 2)); ?></a></center></td>
                            <td style="font-size:24px"><center><a href="boarder?schoolhelp=<?php echo $schoolhelp; ?>&type=3"><?php echo count($records=$SHbusaryOOP->allstudentedit3('students', 'status', 0, 'access', 0, 'studenttype', 2)); ?></a></center></td>
                             <td style="font-size:24px"><center><a href="dialy?schoolhelp=<?php echo $schoolhelp; ?>&type=3"><?php echo  count($records=$SHbusaryOOP->allstudentedit3('students', 'status', 0, 'access', 0, 'studenttype', 2)); ?></a></center></td>
                              <td style="font-size:24px"><center><a href="suspended?schoolhelp=<?php echo $schoolhelp; ?>&type=3"><?php echo  count($records=$SHbusaryOOP->allstudentedit2('students', 'status', 0, 'access', 1)); ?></a></center></td>

                            <td style="font-size:24px"><center><a href="active?schoolhelp=<?php echo $schoolhelp; ?>&type=3"><?php echo  count($records=$SHbusaryOOP->allstudentedit2('students', 'status', 0, 'access', 0)); ?></a></center></td>
                             <td style="font-size:24px"><center><a href="total?schoolhelp=<?php echo $schoolhelp; ?>&type=3"><?php echo  count($records=$SHbusaryOOP->allstudentedit('students', 'status', 0)); ?></a></center></td>
                            
                            </tr>

                          <?php } else{
                            echo "Record not found";
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
                            <option value="0" title="This is applicable for all department">All Department</option>
                            <?php
                            $deptrecord=$SHbusaryOOP->allbusary('department', 'did', "ASC");
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
                       <?php echo $pagename; ?> <?php echo $u; ?>
                       <hr>
                     <div class="form-group">
                        <label for="feename" class="control-label col-md-3 col-sm-3 col-xs-12">Fee Name<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="feename<?php echo $count; ?>" class="form-control col-md-7 col-xs-12" placeholder="please enter <?php echo $pagename; ?>" name="feename[]" required="required" type="text" onblur="return updatevalidity1('setupfees', 'feename', this.value, 'departmentid', $('#departmentid').val(), 'inserting', $(this).attr('id'), '<?php echo $pagename; ?>', 'setupfeesid', '');">
                        </div>
                      </div>

                        <div class="form-group">
                        <label for="amount" class="control-label col-md-3 col-sm-3 col-xs-12">Amount<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="amount<?php echo $count; ?>" class="form-control col-md-7 col-xs-12" placeholder="Please enter <?php echo $pagename; ?> Amount" name="amount<?php echo $count; ?>" required="required" type="text">
                        </div>
                      </div>

                        <div class="form-group">
                        <label for="description" class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="description<?php echo $count; ?>" class="form-control col-md-7 col-xs-12"  name="description<?php echo $count; ?>" placeholder="Please describe this Fee"></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="amount" class="control-label col-md-3 col-sm-3 col-xs-12">Compulsory</label>
                        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 20px; padding-top: 10px">
                        <input id="compulsory<?php echo $count; ?>" name="compulsory<?php echo $count; ?>" value="0"  type="checkbox" onclick="if (this.value==0) {this.value=1}else{ this.value=0 }" style="-ms-transform: scale(1.5); -webkit-transform: scale(1.5); transform: scale(2.5); margin-right: 15px" ><b style="color:green">Tick this if this payment is compulsory</b>
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
                   $setupfeesid=trim(isset($_GET['id'])?$_GET['id']:false);
                                $description="";
                                $feename="";
                                $departmentidrec="";
                                $amount="";
                                $compulsory="";

                   $records=$SHbusaryOOP->allbusaryedit('setupfees', 'setupfeesid', $setupfeesid);
                  if (is_array($records)) {
                                
                          foreach($records as $fieldrecord){
                            $description=trim($fieldrecord['description']);
                            $feename=trim($fieldrecord['feename']);
                            $departmentidrec=trim($fieldrecord['departmentid']);
                            $amount=trim($fieldrecord['amount']);
                            $compulsory=trim($fieldrecord['compulsory']);
                          }
                          
                    }
                    ?>
                    
                    <div class="x_panel">

                      <fieldset>
                        <legend style="color:#063">Edit <?php echo $pagename ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="forminstitutionid"  class="form-horizontal form-label-left" >
                    <input id="setupfeesid" class="form-control col-md-7 col-xs-12" type="hidden" name="setupfeesid" required="required" value="<?php echo $setupfeesid; ?>">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Select Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
                          <select  id="departmentid" required="required" name="departmentid" class="form-control col-md-7 col-xs-12" >
                            <option value="">--Select Department--</option>
                             <option value="0" title="This is applicable for all department" <?php if ($departmentidrec==0) {?> selected="selected" <?php } ?>>All Department</option>
                            <?php
                            $deptrecord=$SHbusaryOOP->allbusary('department', 'did', "ASC");
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
                        <label for="feename" class="control-label col-md-3 col-sm-3 col-xs-12">Fee Name<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="feename" class="form-control col-md-7 col-xs-12" placeholder="please enter <?php echo $pagename; ?>" name="feename" required="required" type="text" onblur="return updatevalidity1('setupfees', 'feename', this.value, 'departmentid', $('#departmentid').val(), 'updating', $(this).attr('id'), '<?php echo $pagename; ?>', 'setupfeesid', '<?php echo $setupfeesid; ?>');" value="<?php echo $feename; ?>">
                        </div>
                      </div>

                        <div class="form-group">
                        <label for="amount" class="control-label col-md-3 col-sm-3 col-xs-12">Amount<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="amount" class="form-control col-md-7 col-xs-12" placeholder="Please enter <?php echo $pagename; ?> Amount" name="amount" required="required" type="text" value="<?php echo $amount; ?>">
                        </div>
                      </div>

                        <div class="form-group">
                        <label for="description" class="control-label col-md-3 col-sm-3 col-xs-12">Description</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="description" class="form-control col-md-7 col-xs-12"  name="description" placeholder="Please describe this Fee"><?php echo $amount; ?></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="amount" class="control-label col-md-3 col-sm-3 col-xs-12">Compulsory</label>
                        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-left: 20px; padding-top: 10px">
                        <input id="compulsory" name="compulsory" value="<?php echo $compulsory; ?>"  type="checkbox" <?php if ($compulsory==1) { ?> checked="checked" <?php } ?> onclick="if (this.value==0) {this.value=1}else{ this.value=0 }" style="-ms-transform: scale(1.5); -webkit-transform: scale(1.5); transform: scale(2.5); margin-right: 15px" ><b style="color:green">Tick this if this payment is compulsory</b>
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
                  $setupfeesid=trim(isset($_GET['id'])?$_GET['id']:false);
                  $records=$SHbusaryOOP->allbusaryedit('setupfees', 'setupfeesid', $setupfeesid);
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                $description=trim($fieldrecord['description']);
                                $feename=trim($fieldrecord['feename']);
                                $amount=trim($fieldrecord['amount']);
                                $compulsory=trim($fieldrecord['compulsory']);
                                $operatorid=trim($fieldrecord['operatorid']);
                                $udate=trim($fieldrecord['udate']);
                                $odatet=trim($fieldrecord['odate']);
                                $departmentid=trim($fieldrecord['departmentid']);

                                //collecting Department record
                                  $deptrecords=$SHbusaryOOP->allbusaryedit('department', 'did', $departmentid);
                                    if (is_array($deptrecords)) {
                                     foreach($deptrecords as $deptrecord){
                                        $deptname=$deptrecord['deptname'];
                                        
                                     }
                                   }
                        
                               //Getting Admin Detials
                              
                                 $adminrecords=$SHbusaryOOP->allbusaryedit('adminpersons', 'adminid', $operatorid);
                                 foreach($adminrecords as $adminrecord){
                                    $adminsurname=$adminrecord['surname'];
                                    $adminothername=$adminrecord['othername'];
                                 }

                             
                                  
                                  //Instition Record
                                  
                                  $record1=$SHbusaryOOP->allbusary('institution', 'i_id', 'DESC');

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
                    <h3><?php echo $feename; ?>'s Setup Fee </h3>
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
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $feename ; ?>
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
                          <center><p class="lead schoolhelpcolor"><b>Setup Fees Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Fee Name</th>
                                  <td><?php echo $feename; ?></td>
                                </tr>
                                <tr>
                                  <th style="width:50%">Amount</th>
                                  <td><?php echo $amount; ?></td>
                                </tr>
                                <tr>
                                  <th style="width:50%">Status</th>
                                  <td><?php if ($compulsory==1) { echo  "Compulsory"; }else{ echo "Not Compulsory"; }  ?></td>
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