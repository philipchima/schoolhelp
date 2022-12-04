<?php 
include_once("includes/global.php");
include_once("includes/connection.php");
include_once("phpclass/SHdashOOP.php");
include_once("phpclass/SHdashupdate.php");
include_once("phpclass/SHdashinserts.php");
confirmcheckin();
$SHDashOOP=new ClassDash;
$pagename="School Calendar";

$tableUpdate= new updateTable;

// Checking page access Authenticity
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp=trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$page=trim(isset($_GET['page'])?$_GET['page']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);
$status=trim(isset($_GET['status'])?$_GET['status']:false);

$odate=date("Y-m-d");
$udate=date("Y-m-d H:i:s");


$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

$pageaccess="";

$previlleges=$SHDashOOP->alldashedit('adminpersons', 'adminid', $schoolhelp);
if (is_array($previlleges)) {

foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['forecast_d']);
  $admintype=trim($actualrecord['admintype']);
  $dashedit_d=trim($actualrecord['dashedit_d']);
  $dashadd_d=trim($actualrecord['dashadd_d']);
  $dashdelete_d=trim($actualrecord['dashdelete_d']);
  $signatorypositionid=trim($actualrecord['signatorypositionid']);
}
  
}

if ($pageaccess!=1) {
  echo "<b style='font-size:100; color:red'>Criminal Attempt Made, contact the admin ask for the access of this page</b>";
  exit();
}

//This script is to determine the actual admin that is logging whether a super admin or a position holder in a school
if ($admintype==1) {
  $logindepartmentid='';
}
else{

$signatorydata=$SHDashOOP->alldashedit('signatoryposition', 'signatorypositionid', $signatorypositionid);
if (is_array($signatorydata)) {
  foreach($signatorydata as $signatoryrec){
  $logindepartmentid=$signatoryrec['departmentid'];
  
  }
}
}

if($page==2) {
  
  if ($dashadd_d==1) {

$kickoftime=trim(isset($_POST['kickoftime'])?$_POST['kickoftime']:false);
$title=trim(isset($_POST['titlename'])?$_POST['titlename']:false);
$description=trim(isset($_POST['description'])?$_POST['description']:false);

$startdate=trim(isset($_POST['startdate'])?$_POST['startdate']:false);
$enddate=trim(isset($_POST['enddate'])?$_POST['enddate']:false);


$udate=date("Y-m-d H:m:s");

$insertedrow=0;
$tbltermdetails=new insertTable;
$state=$tbltermdetails->insert_7fields('schoolcalenda', 'kickoftime', $kickoftime, 'title', $title, 'description', $description, 'startdate', $startdate, 'enddate', $enddate, 'operatorid', $schoolhelp, 'odate', $odate);

$sql=$state.":: Insertion, affected records =1";

}

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}

if($page==4) {

  if ($dashedit_d==1) {

$schoolcalendaid=trim(isset($_POST['schoolcalendaid'])?$_POST['schoolcalendaid']:false);
$kickoftime=trim(isset($_POST['kickoftime'])?$_POST['kickoftime']:false);
$title=trim(isset($_POST['titlename'])?$_POST['titlename']:false);
$description=trim(isset($_POST['description'])?$_POST['description']:false);

$startdate=trim(isset($_POST['startdate'])?$_POST['startdate']:false);
$enddate=trim(isset($_POST['enddate'])?$_POST['enddate']:false);

$state= $tableUpdate->update_sixfields('schoolcalenda', 'schoolcalendaid', $schoolcalendaid, 'kickoftime',  $kickoftime, 'title', $title, 'description',  $description, 'startdate',  $startdate, 'enddate',  $enddate, 'operatorid', $schoolhelp);

$sql=$state.":: Update Made, affected records = 1";
}

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}


if ($page==6) {

if ($dashdelete_d==1) {
  
   $schoolcalendaid=trim(isset($_GET['id'])?$_GET['id']:false);
  
    $state=$tableUpdate->delete_dash('schoolcalenda', 'schoolcalendaid', $schoolcalendaid);

        $sql=$state.":: Deletion Made, affected records = 1";
         
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
                    <h4 id="caption" style="float:left;"><?php echo $pagename; ?></h4>
                    
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="btn btn-primary" href="../index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home">Settings</i></a>

                      <li><a class="btn btn-success" href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home">Dashboard</i></a>
                        
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Action</a>
                        <ul class="dropdown-menu" role="menu">
                          <?php if($dashedit_d==1) { ?>
                        <li><a href="?schoolhelp=<?php echo $schoolhelp; ?>&page=1"  ><i class="fa fa-plus"></i>  Add <?php echo $pagename; ?></a></li>
                       
                        <?php } ?>
                        <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> View <?php echo $pagename; ?></a></li>
                        
                        </ul>
                      </li>
                    </li>
                    </ul>

                    <div class="clearfix"></div>
                  </div>

                  <div style="color:#063"  ><b><?php echo $sql; ?></b></div>

                  
                    <?php if ($page=="") {?>
                      <div class="x_panel ">
                         <fieldset>
                        <legend style="color:#063"><?php echo $pagename; ?> Record</legend>
                    <table id="datatable-buttons"  class="table table-striped table-bordered table-responsive" style="width: 100%">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Kick Up Time</th>
                          <th>Title</th>
                          <th>Description</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          
                   
                          <th ><i class="fa fa-print" style="color:green"></i> Print</th>
                          <?php if ($dashedit_d==1) { ?>
                          <th ><i class="fa fa-edit" style="color:yellow"></i> Edit</th>
                          <?php } if ($dashdelete_d==1) { ?>
                          <th><i class="fa fa-trash" style="color:red"></i> Delete</th>
                          <?php } ?>
                          <th >User<i class="fa fa-user"></i></th>
                          
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                             
                              $records=$SHDashOOP->alldash('schoolcalenda', 'schoolcalendaid', 'DESC');
                              if (is_array($records)) {

                              foreach($records as $fieldrecord){
                                $qualificationname="";
                                $adminsurname="";
                                 $adminothername="";
                                 $statename="";
                                 $deptname="";
                              
                                $fieldvalue=trim($fieldrecord['operatorid']);
                             
                                 
                                                          
                                $admindata=$SHDashOOP->alldashedit('adminpersons', 'adminid',  $fieldvalue);
                                 if(is_array($admindata)){
                                    foreach($admindata as $adminrecord){
                                      $adminsurname=$adminrecord['surname'];
                                      $adminothername=$adminrecord['othername'];
                                      $logintime=$adminrecord['logintime'];
                                      $logouttime=$adminrecord['logouttime'];
                                    }

                                  }

                                
                                         $k+=1;
                                ?>
                                      <tr>
                                        <td><?php echo  $k; ?></td>
                                        <td align="center" ><?php  echo $fieldrecord['kickoftime']?></td> 
                                          <td align="center"><?php  echo $fieldrecord['title']; ?></td>
                                          <td align="left" ><?php  echo $fieldrecord['description']; ?></td>
                                          <td align="center"><?php  echo $fieldrecord['startdate']; ?></td>
                                          <td align="center" ><?php echo $fieldrecord['enddate']; ?></td>
                                                                                          
                                       <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['schoolcalendaid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                         <?php if ($dashedit_d==1) { ?>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['schoolcalendaid']; ?>')"><center><i class="fa fa-edit" style="color:yellow; font-size:2em"></i></center></button></td>
                                        <?php } ?>
                                        <?php if ($dashdelete_d==1) { ?>
                                         <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['schoolcalendaid']; ?>','')"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
                                         <?php } ?>
                                        
                                           <td ><span class="btn-group">
                                            <center><button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-user"></i> Details<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu">
                                            <li ><span>Update by</span> : <?php echo  $adminsurname. " ".$adminothername ; ?></li>
                                            <li><span>Upate Date</span> : <?php echo  $fieldrecord['udate']; ?></li>
                                            <li><span>Initial Date</span> : <?php echo $fieldrecord['odate']; ?></li>
                                            <li class="schoolhelp"><b>Login Status</b></li>
                                            <li><span>login Date</span> : <?php echo  $logintime; ?></li>
                                            <li><span>logout Date</span> : <?php echo  $logouttime; ?></li>
                                          </ul>
                                          </center></span>

                                        </td>
                                     

                                      </tr>
                                      
                                    

                                      
                             <?php 
                                 }
                              }
                             ?>
                        
                      </tbody>
                    </table>
                   </fieldset>
                    </div>
                    <?php } ?>

                    <?php if($page==1) { 

                      ?>
                    <div class="x_panel" style="width: 100%">
                      <fieldset>
                        <legend style="color:#063">Add <?php echo $pagename; ?></legend>
                  <form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="formstid"  class="form-horizontal form-label-left" >
                   
                       <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Kick Up Time<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input name="kickoftime" id="kickoftime" class="form-control col-md-7 col-xs-12" type="text"  required="required"> 
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Title<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input name="titlename" id="titlename" class="form-control col-md-7 col-xs-12" type="text"  required="required"> 
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Description<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="description" id="description" class="form-control col-md-7 col-xs-12"   required="required"></textarea> 
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="otherrname" class="control-label col-md-3 col-sm-3 col-xs-12">Start Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="startdate" id="startdate" class="form-control col-md-7 col-xs-12" type="date"  required="required">
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">End Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="enddate" id="enddate" class="form-control col-md-7 col-xs-12" type="date"  required="required">
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

                  <?php if($page==3) {
                    $schoolcalendaid=trim(isset($_GET['id'])?$_GET['id']:false);

                    
                    $record=$SHDashOOP->alldashedit('schoolcalenda', 'schoolcalendaid', $schoolcalendaid);
                    if(is_array($record)){
                      foreach($record as $records){
                        
                    ?>
                      <div class="x_panel" style="width: 100%">
                      <fieldset>
                        <legend style="color:#063">Edit <?php echo $pagename; ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="formstid"  class="form-horizontal form-label-left" >
                     <input type="hidden" name="schoolcalendaid" id="schoolcalendaid" value="<?php echo $schoolcalendaid; ?>">
                     <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Kick Up Time<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input name="kickoftime" id="kickoftime" class="form-control col-md-7 col-xs-12" type="text"  required="required" value="<?php echo $records['kickoftime']; ?>"> 
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Title<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input name="titlename" id="titlename" class="form-control col-md-7 col-xs-12" type="text"  required="required" value="<?php echo $records['title']; ?>"> 
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Description<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="description" id="description" class="form-control col-md-7 col-xs-12"   required="required"><?php echo $records['description']; ?></textarea> 
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="otherrname" class="control-label col-md-3 col-sm-3 col-xs-12">Start Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="startdate" id="startdate" class="form-control col-md-7 col-xs-12" type="date"  required="required" value="<?php echo $records['startdate']; ?>">
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">End Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="enddate" id="enddate" class="form-control col-md-7 col-xs-12" type="date"  required="required" value="<?php echo $records['startdate']; ?>">
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

                <?php } 
              }else{ echo "Manipulation is wrought!";}

              } ?>

               <?php if ($page==5) {
                  $schoolcalendaid=trim(isset($_GET['id'])?$_GET['id']:false);
                 
                   
                    $records=$SHDashOOP->alldashedit('schoolcalenda', 'schoolcalendaid', $schoolcalendaid);
                     foreach($records as $fieldrecord){
                                
                                $fieldvalue=trim($fieldrecord['operatorid']);
                                $title=trim($fieldrecord['title']);
                                
                                  $kickoftime= trim($fieldrecord['kickoftime']);
                                
                               $description= trim($fieldrecord['description']);
                               $startdate= trim($fieldrecord['startdate']);
                               $enddate= trim($fieldrecord['enddate']);
                               $odatet= trim($fieldrecord['odate']);
                               $udate= trim($fieldrecord['udate']);
                      }

                    //Getting Operators ID
                     $admindata=$SHDashOOP->alldashedit('adminpersons', 'adminid',  $fieldvalue);
                                 if(is_array($admindata)){
                                    foreach($admindata as $adminrecord){
                                      $adminsurname=$adminrecord['surname'];
                                      $adminothername=$adminrecord['othername'];
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
                    <h3 class="schoolhelp"><?php echo $pagename; ?> Details </h3>
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
                          <h3 class="schoolhelp">
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $title; ?>.
                                          <small class="pull-right">Printed on: <?php echo $odate; ?></small>
                                      </h3>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                       
                       
                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col">
                         <img id="userimage" <?php if ($instilogo!="") {?> style="display: block" src="images/logo/<?php echo $instilogo; ?>" <?php } ?> class="img img-responsive img-thumbnail" >
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
                          <center><p class="lead schoolhelpcolor"><b><?php echo $title; ?> Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                 <tr>
                                  <th style="width:50%">Kick Up Time:</th>
                                  <td><?php echo $kickoftime; ?></td>
                                </tr>
                                <tr>
                                  <th style="width:50%">Title:</th>
                                  <td><?php echo $title; ?></td>
                                </tr>
                                <tr>
                                  <th>Description:</th>
                                  <td><?php echo $description; ?></td>
                                </tr>
                               
                                <tr>
                                  <th>Start Date:</th>
                                  <td><?php echo $startdate; ?></td>
                                </tr>
                                <tr>
                                  <th>End Date:</th>
                                  <td><?php echo $enddate; ?></td>
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
            
<!--Webcamp-->
       <?php include("includes/footer.php"); ?>