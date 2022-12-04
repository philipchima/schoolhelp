
<?php 
include_once("includes/global.php");
include_once("includes/connection.php");
include_once("phpclass/SHdashOOP.php");
include_once("phpclass/SHdashupdate.php");
include_once("phpclass/SHdashinserts.php");
confirmcheckin();
$SHDashOOP=new ClassDash;
$pagename="Leave Application";
$tablestudents=new insertTable;
$tableUpdate= new updateTable;

// Checking page access Authenticity
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp=trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$page=trim(isset($_GET['page'])?$_GET['page']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);
$status=trim(isset($_GET['status'])?$_GET['status']:false);

$previlleges=$SHDashOOP->alldashedit('adminpersons', 'adminid', $schoolhelp);
if ($previlleges) {
  
foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['leave_d']);
  $dashadd_d=trim($actualrecord['dashadd_d']);
  
}

}

if ($pageaccess!=1) {
  echo "<b style='font-size:100; color:red'>Criminal Attempt Made, contact the admin ask for the access of this page</b>";
  exit();
}

$pagename="Leave Application";
$udate=date("Y-m-d H:i:s");
$odate=date("Y-m-d");

$state=trim(isset($_GET['state'])?$_GET['state']:false);



if($page==4) {
  
 $lid=trim(isset($_POST['lid'])?$_POST['lid']:false); 
 $correction=trim(isset($_POST['correction'])?$_POST['correction']:false);
 $status=trim(isset($_POST['status'])?$_POST['status']:false);

 $state=$tablestudents->insert_5fields('leaveapplicationcomment', 'leaveapplyid', $lid, 'comment', $correction, 'operatorid', $schoolhelp, 'udate', $udate, 'odate', $odate);
 


$state1=$tableUpdate->update_fourfields('leaveapplication', 'lid', $lid, 'status',  $status, 'comment',  $correction, 'operatorid', $schoolhelp, 'udate', $udate);

$sql.=$state1.":: Update Made, affected records = 1";

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&state=$state&sql=$sql';
      </script>";
}

if ($page==7) {
  $lid=trim(isset($_GET['id'])?$_GET['id']:false);
  $status=trim(isset($_GET['status'])?$_GET['status']:false);
 
    $state=$tableUpdate->update_threefields('leaveapplication', 'lid', $lid, 'operatorid',  $schoolhelp,  'status',  $status, 'udate', $udate);
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
                      <li><a class="btn btn-primary" href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                      <li><a class="btn btn-success " href="Settings?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"> Settings</i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                         <li  ><a href="?page=1&schoolhelp=<?php echo $schoolhelp; ?>&status=0"  ><i class="fa fa-plus"></i>  Newly Submitted Leave</a>
                      </li>
                          <li ><a  href="?page=1&schoolhelp=<?php echo $schoolhelp; ?>&status=3"><i class="fa fa-book"></i> Leave in Process</a>
                      </li>
                       </li>
                          <li ><a  href="?page=1&schoolhelp=<?php echo $schoolhelp; ?>&status=1"><i class="fa fa-book"></i> Approved</a>
                      </li>
                       </li>
                          <li ><a  href="?page=1&schoolhelp=<?php echo $schoolhelp; ?>&status=2"><i class="fa fa-book"></i>Not Approved</a>
                      </li>
                       </li>
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>All Applications</a>
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
                        <legend style="color:#063">Leave Application Records</legend>

                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Staff</th>
                          <th>Letter</th>
                          <th>State</th>
                          <th>Description</th>
                          
                          <th>Submiitted</th>
                         
                          <th style="width:10%;"><i class="far fa-address-card" style="color:green"></i> Print</th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:red"></i> Edit</th>
                          <th title="Please Select Early class or Later class">Status</th>
                           <th>Action<i class="fa fa-user"></i></th>
                           
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                              $leavestatus=0;
                              $leavestatus=trim(isset($_GET['leavestatus'])?$_GET['leavestatus']:false);

                              if ($leavestatus==0) {
                               $records=$SHDashOOP->alldashedit('leaveapplication', 'status', '0');
                              }else{
                              $records=$SHDashOOP->alldash('leaveapplication', 'lid', 'DESC');
                              }
                              if (isset($records)) {
                                
                              foreach($records as $fieldrecord){
                                $k+=1;
                                $staffid=trim($fieldrecord['staffid']);
                                $operatorid=trim($fieldrecord['operatorid']);
                                   $adminsurname="";
                                          $adminothername="";
                                 $operatorrecords=$SHDashOOP->alldashedit('adminpersons', 'adminid', $operatorid);
                                  if (is_array($operatorrecords)) {
                                         foreach($operatorrecords as $operatordata){
                                          $adminsurname=$operatordata['surname'];
                                          $adminothername=$operatordata['othername'];
                                         }
                                  }

                                $records1=$SHDashOOP->alldashedit('staff', 'staffid', $staffid);
                                  if (isset($records1)) {
                                    
                                    foreach($records1 as $fieldrecord1){
                                        $staffname=$fieldrecord1['surname']." ".$fieldrecord1['othername'];
                                    }
                                  }
                               
                              
                                ?>
                                      <tr>
                                        <td><?php echo $k; ?></td>
                                        <td><?php echo  substr($staffname,0, 12); ?></td>
                                        <td><a title="<?php echo $fieldrecord['letter']; ?>" target="new" class="embed" href="uploads/leaveapplication/<?php echo $fieldrecord['letter']; ?>">Click on it to Preview <span class="glyphicon glyphicon-arrow-right"></span></a></td>
                                        <td>
                                        <?php 
                                        $status=trim($fieldrecord['status']);
                                          if ($status==0) {
                                                echo "<span style='color:red'>Processing...</span>";
                                            }
                                            elseif($status==1){
                                              echo "<span style='color:green'>Approved: Congrats...</span>";
                                            }
                                            elseif($status==2){
                                              echo "<span style='color:yellow'>Not Yet Approved: correction to be made...</span>";
                                            }
                                             elseif($status==3){
                                              echo "<span style='color:yellow'>On View</span>";
                                            }
                                            else{
                                              echo "<span style='color:red'>Processing...</span>";
                                            } ?>
                                        </td>
                                        <td title="<?php echo $fieldrecord['description']; ?>"><?php echo  substr($fieldrecord['description'],0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['instructorudate'],0, 12); ?></td>                                  
                                     
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['lid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['lid']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
                                            <td><button type="click to approve or disapprove" type="button" <?php if ($fieldrecord['status']!=1) { $caption='Not Approved'; $status=1; ?> class="btn btn-success" <?php } else{$caption='Approved'; $status=2 ?> class="btn btn-primary" <?php } ?>   onclick="funcactivator('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord["lid"]; ?>', '<?php echo $status; ?>')"><?php echo  $caption; ?></button></td>
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
                              }
                             ?>
                        
                      </tbody>
                    </table>
                   </fieldset>
                    </div>
                    <?php } ?>

                    <?php if($page==1) { ?>
                     <div class="x_panel ">
                         <fieldset>
                        <legend style="color:#063">Leave Application Records</legend>

                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Staff</th>
                          <th>Letter</th>
                          <th>State</th>
                          <th>Description</th>
                          
                          <th>Submiitted</th>
                         
                          <th style="width:10%;"><i class="far fa-address-card" style="color:green"></i> Print</th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:red"></i> Edit</th>
                          <th title="Please Select Early class or Later class">Status</th>
                           <th>Action<i class="fa fa-user"></i></th>
                           
                        </tr>
                      </thead>

                      <tbody>
                       <?php $k=0; 
                              
                              $records=$SHDashOOP->alldasheditorder('leaveapplication', 'status', $status, 'lid', 'DESC');
                              if (isset($records)) {
                                
                              foreach($records as $fieldrecord){
                                $k+=1;
                                $staffid=trim($fieldrecord['staffid']);
                                $operatorid=trim($fieldrecord['operatorid']);
                                   $adminsurname="";
                                          $adminothername="";
                                 $operatorrecords=$SHDashOOP->alldashedit('adminpersons', 'adminid', $operatorid);
                                  if (is_array($operatorrecords)) {
                                         foreach($operatorrecords as $operatordata){
                                          $adminsurname=$operatordata['surname'];
                                          $adminothername=$operatordata['othername'];
                                         }
                                  }

                                $records1=$SHDashOOP->alldashedit('staff', 'staffid', $staffid);
                                  if (isset($records1)) {
                                    
                                    foreach($records1 as $fieldrecord1){
                                        $staffname=$fieldrecord1['surname']." ".$fieldrecord1['othername'];
                                    }
                                  }
                               
                              
                                ?>
                                      <tr>
                                        <td><?php echo $k; ?></td>
                                        <td><?php echo  substr($staffname,0, 12); ?></td>
                                        <td><a title="<?php echo $fieldrecord['letter']; ?>" target="new" class="embed" href="uploads/leaveapplication/<?php echo $fieldrecord['letter']; ?>">Click on it to Preview <span class="glyphicon glyphicon-arrow-right"></span></a></td>
                                        <td>
                                        <?php 
                                        $status=trim($fieldrecord['status']);
                                          if ($status==0) {
                                                echo "<span style='color:red'>Processing...</span>";
                                            }
                                            elseif($status==1){
                                              echo "<span style='color:green'>Approved: Congrats...</span>";
                                            }
                                            elseif($status==2){
                                              echo "<span style='color:yellow'>Not Yet Approved: correction to be made...</span>";
                                            }
                                             elseif($status==3){
                                              echo "<span style='color:yellow'>On View</span>";
                                            }
                                            else{
                                              echo "<span style='color:red'>Processing...</span>";
                                            } ?>
                                        </td>
                                        <td title="<?php echo $fieldrecord['description']; ?>"><?php echo  substr($fieldrecord['description'],0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['instructorudate'],0, 12); ?></td>                                  
                                     
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['lid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['lid']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
                                            <td><button type="click to approve or disapprove" type="button" <?php if ($fieldrecord['status']!=1) { $caption='Not Approved'; $status=1; ?> class="btn btn-success" <?php } else{$caption='Approved'; $status=2 ?> class="btn btn-primary" <?php } ?>   onclick="funcactivator('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord["lid"]; ?>', '<?php echo $status; ?>')"><?php echo  $caption; ?></button></td>
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
                              }
                             ?>
                        
                      </tbody>
                    </table>
                   </fieldset>
                    </div>

                    <?php } ?>

                  <?php 

                  if($page==3) {
                    $lid=trim(isset($_GET['id'])?$_GET['id']:false);

                    $k=0;
                    $records=$SHDashOOP->alldashedit('leaveapplication', 'lid', $lid);
                    if (is_array($records)) { 
                      foreach ($records as $record) {
                      ?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Correct Leave Application</legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="formleaveapplication"  class="form-horizontal form-label-left" >
                      <input type="hidden" name="lid" value="<?php echo $lid; ?>">


                     <?php  $records1=$SHDashOOP->alldashedit('leaveapplicationcomment', 'leaveapplyid', $lid);
                            if (is_array($records1)) { 
                              foreach ($records1 as $record1) { 
                                $k+=1; ?>
                      <div class="form-group">
                       
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="levelname">Previous Correction <?php echo $k; ?>
                        </label>
                       
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php echo $record1['comment']; ?>
                          <br>
                           <b><?php echo $record1['udate']; ?></b>
                        </div>
                       
                      </div>
                       <?php }
                            } ?>

                      <div class="form-group">
                       
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="levelname">Leave Description
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <?php echo $record['description']; ?>
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Leave Letter<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <a target="new" class="embed" href="../schoolhelp/uploads/leaveapplication/<?php echo $record['letter'];?>">Click on it to Preview <span class="glyphicon glyphicon-arrow-right"></span><?php echo $record['letter'];?></a>
                        </div>
                      </div>
                     
                       <div class="form-group">
                        <label for="levelnumoption" class="control-label col-md-3 col-sm-3 col-xs-12">Corrective Measures</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <textarea class="form-control col-md-7 col-xs-12" id="correction" name="correction" required="required"></textarea>
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Select Leave Status<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         
                          <select  id="status" required="required" name="status" class="form-control col-md-7 col-xs-12">
                            <option value="">--Select Leave Status--</option>
                            <option value="1">Approved</option>
                            <option value="2">Not Approved</option>
                            <option value="3">On Process</option>
                            <?php } ?>
                          </select>
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
                <?php
                     }
                 } ?>

                <?php if ($page==5) {
                  $k=0;
                  $lid=trim(isset($_GET['id'])?$_GET['id']:false);

                     $records=$SHDashOOP->alldashedit('leaveapplication', 'lid', $lid);
                      if (isset($records)) {
                                
                      foreach($records as $fieldrecord){
                      $k+=1;
                      $staffid=trim($fieldrecord['staffid']);
                      $operatorid=trim($fieldrecord['operatorid']);
                      $adminsurname="";
                      $adminothername="";

                      $operatorrecords=$SHDashOOP->alldashedit('adminpersons', 'adminid', $operatorid);
                        if (is_array($operatorrecords)) {
                          foreach($operatorrecords as $operatordata){
                              $adminsurname=$operatordata['surname'];
                              $adminothername=$operatordata['othername'];
                          }
                        }

                      $records1=$SHDashOOP->alldashedit('staff', 'staffid', $staffid);
                        if (isset($records1)) {
                          foreach($records1 as $fieldrecord1){
                          $staffname=$fieldrecord1['surname']." ".$fieldrecord1['othername'];
                        }
                      }

                       $records2=$SHDashOOP->alldash('institution', 'i_id', 'DESC');
                        if (isset($records2)) {
                          foreach($records2 as $fieldrecord2){
                         $instilogo=$fieldrecord2['instilogo'];
                        }
                      }
                               
                  ?>
                    <div class="x_panel" >
                  <div class="x_title">
                    <h3>Leave Application Details </h3>
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
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $staffname; ?>.
                                          <small class="pull-right">Date: <?php echo $odate; ?></small>
                                      </h3>
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
                                          Updated by: <strong><?php echo $adminsurname ." ".$adminothername; ?></strong>
                                          <br><b>Date: </b><?php echo $fieldrecord['udate']; ?></strong>
                                          <br><b>Initial Insertion Date: </b><?php echo $fieldrecord['odate']; ?>
                                          
                                      </address>
                        </div>

                      
                      </div>
                      <!-- /.row -->


                   

                      <div class="row">
                       
                        <div class="col-xs-12">
                          <hr>
                          <center><p class="lead schoolhelpcolor"><b>Leave Application Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Applicant Name:</th>
                                  <td><?php echo $staffname; ?></td>
                                </tr>
                                <tr>
                                  <th>Description:</th>
                                  <td><?php echo $fieldrecord['description']; ?></td>
                                </tr>
                                <tr>
                                  <th>Letter:</th>
                                  <td></td>
                                </tr>
                                <tr>
                                  <th>Admin Comment</th>
                                  <td><?php echo $fieldrecord['comment']; ?></td>
                                </tr>
                                <tr style="margin-bottom:10px">
                                  <th>Status</th>
                                  <td>
                                      <?php 
                                      $status=trim($fieldrecord['status']);
                                       if ($status==0) {
                                          echo "<span style='color:red'>Processing...</span>";
                                        }
                                        elseif($status==1){
                                          echo "<span style='color:green'>Approved: Congrats...</span>";
                                        }
                                        elseif($status==2){
                                         echo "<span style='color:yellow'>Not Yet Approved: correction to be made...</span>";
                                                  }
                                         elseif($status==3){
                                          echo "<span style='color:yellow'>On View</span>";
                                          }
                                         else{
                                          echo "<span style='color:red'>Processing...</span>";
                                        }
                                      ?>
                              </td>
                              </tr>

                               <?php  $k1=0;
                               $records1=$SHDashOOP->alldashedit('leaveapplicationcomment', 'leaveapplyid', $lid);
                                      if (is_array($records1)) { 
                                        foreach ($records1 as $record1) { 
                                          $k1+=1; ?>
                                <tr>
                                  <th style="color:red"><b>Previous Correction <?php echo $k1; ?></b></th>
                                  <td class="col-md-6 col-sm-6 col-xs-12">
                                    <?php echo $record1['comment']; ?>
                                    <br>
                                     <b><?php echo $record1['udate']; ?></b>
                                  </td>
                                 
                                </tr>
                                 <?php }
                                      } ?>

                              </tbody>
                            </table>
                          </div>
                        </div>
                          <?php } 
                            }
                          ?>
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
                      <?php
                            }
                          ?>
              </div>
            </div>
       <?php include("includes/footer.php"); ?>