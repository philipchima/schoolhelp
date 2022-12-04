<?php 
session_start();
include_once("phpclass/SHdashinserts.php");
include_once("phpclass/SHdashupdate.php");
include_once("phpclass/SHdashOOP.php");


$pagename="Subscription";

$odate=date("Y-m-d");

$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

//Destroy all the Session
if ($page==10) {
  session_unset();
  session_destroy();

   echo "<script>
        window.location.href='?sql=$sql';
      </script>";
}

//class declaration
 $datas=new classDash; 

 if ($page==8) {
  $passcode=trim(isset($_POST['passcode'])?$_POST['passcode']:false);
   
      $recordpins=$datas->alldashedit('swiftotechadmin','passcode',$passcode);
      if (is_array($recordpins)) {
      foreach($recordpins as $recordpin){
        
        $_SESSION["swiftotechid"]=$recordpin['swiftotechid'];
        $_SESSION["passcode"]=$recordpin['passcode'];
        $_SESSION["staffname"]=$recordpin['staffname'];
        $_SESSION["swiftotechadd"]=$recordpin['swiftotechadd'];
        $_SESSION["swiftotechedit"]=$recordpin['swiftotechedit'];
        $_SESSION["swiftotechdelete"]=$recordpin['swiftotechdelete'];
      }
      $sql="Login Successfully";
    }
     echo "<script>
        window.location.href='?sql=$sql';
      </script>";
}


if (@$_SESSION["passcode"]!="") {

if($page==2) {
  //getting array ofrecords
  if (@$_SESSION["swiftotechadd"]==1) {
 
  $numofstudent=trim(isset($_POST['numofstudent'])?$_POST['numofstudent']:false);
  $amount=trim(isset($_POST['amount'])?$_POST['amount']:false);

 $subdate=trim(isset($_POST['subdate'])?$_POST['subdate']:false);
 $expirydate=trim(isset($_POST['expirydate'])?$_POST['expirydate']:false);

 $description=trim(isset($_POST['description'])?$_POST['description']:false);
 $operatorid=trim($_SESSION["swiftotechid"]);
 
$tablesubscription=new insertTable;
$state=$tablesubscription->insert_subscription($numofstudent, $amount, $subdate, $expirydate, $description,  $operatorid, $odate);
$display=$state['action'];
$insertedrow=$state['counting'];

$sql=$display.":: Insertion, affected records = 1";

echo "<script>
        window.location.href='?sql=$sql';
      </script>";
    }
}

if($page==4) {
    if ($_SESSION["swiftotechedit"]==1) {

$subsid=trim(isset($_POST['subsid'])?$_POST['subsid']:false);
  
$numofstudent=trim(isset($_POST['numofstudent'])?$_POST['numofstudent']:false);
  $amount=trim(isset($_POST['amount'])?$_POST['amount']:false);

 $subdate=trim(isset($_POST['subdate'])?$_POST['subdate']:false);
 $expirydate=trim(isset($_POST['expirydate'])?$_POST['expirydate']:false);

 $description=trim(isset($_POST['description'])?$_POST['description']:false);
 $operatorid=trim($_SESSION["swiftotechid"]);


$tblsubscription=new updateTable;
$state=$tblsubscription->update_subscription($numofstudent, $amount, $subdate, $expirydate, $description, $operatorid, $subsid);

$sql=$state.":: Update Made, affected records = 1";
echo "<script>
        window.location.href='?sql=$sql';
      </script>";
    }
}

if ($page==6) {
  $subsid=trim(isset($_GET['id'])?$_GET['id']:false);
   
   $schoolhelpDHd= new updateTable;
    $state=$schoolhelpDHd->delete_dash('subscription', 'subsid', $subsid);

        $sql=$state.":: Deletion Made, affected records = 1";
        echo "<script>
                window.location.href='?sql=$sql';
              </script>";
    
}

} //End of checking swiftotech Admin Person
else{
  $_SESSION["passcode"]="";
}




include("includes/header.php");
//this helps you to know the kind of driver you are using
//print_r(PDO::getAvailableDrivers());
?>

   <!-- page content -->
<?php 

if($_SESSION["passcode"]=="") { ?>
                    <div class="right_col" role="main">
                        <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12" style="margin-bottom: 20px;">
                          <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Swiftotech Login</legend>
                      <form enctype="multipart/form-data" action="?page=8" method="POST"  id="formsubid"  class="form-horizontal form-label-left" >

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Subscription Date<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="passcode" id="passcode" required="required"  class="form-control col-md-7 col-xs-12" >
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
                          <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </fieldset>
                </div>
              </div>
            </div>
          </div>
                     
   <?php } else{ ?>
    <div class="right_col" role="main">
         

            <div class="row">
              <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12" style="margin-bottom: 20px;">
                <div class="x_panel">
                  <div class="x_title" style="background: #61dc42; padding-top: 10px; border-radius: 6px;">
                    <h3 id="caption" style="float:left;">Subscription</h3>
                    <ul class="nav navbar-right panel_toolbox" style="">
                      
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                        <?php if ($_SESSION["swiftotechadd"]==1) {?>
                         <li  ><a href="?page=1"  ><i class="fa fa-plus"></i>  Add <?php echo $pagename; ?></a></li>
                         <?php } ?>
                          <li ><a  href="?"><i class="fa fa-book"></i>  View <?php echo $pagename; ?></a>
                      </li>
                        <li ><a  href="?page=10"><i class="fa fa-book"></i>  Logout</a>
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
                        <legend style="color:#063"><?php echo $pagename; ?> Record</legend>

                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Subscription Date</th>
                          <th>Expiry Date</th>
                          <th>Description</th>
                          <th>Number of Student</th>
                          <th>Amount</th>
                          
                          <th ><i class="far fa-address-card" style="color:green"></i> Print</th>
                          <?php  if ($_SESSION["swiftotechedit"]==1) { ?>
                          <th ><i class="fa fa-edit" style="color:yellow"></i> Edit</th>
                          <?php } ?>
                          <?php  if ($_SESSION["swiftotechdelete"]==1) { ?>
                          <th ><i class="fa fa-delete" style="color:red"></i> Delete</th>
                          <?php } ?>
                           <th>User<i class="fa fa-user"></i></th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                            
                              $records=$datas->alldash('subscription','subsid','DESC');
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                $k+=1;
                                $fieldvalue=trim($fieldrecord['operatorid']);

                              $swirecords=$datas->alldashedit('swiftotechadmin','swiftotechid',$fieldvalue);
                              if (is_array($swirecords)) {
                                
                              foreach($swirecords as $swirecord){
                                $staffname=$swirecord['staffname'];
                                $logindate=$swirecord['udate'];
                                $swiftotechid=$swirecord['swiftotechid'];
                                    }
                                  }
                                
                                ?>
                                      <tr>
                                        <td><?php echo $k; ?></td>
                                        <td><?php echo  substr($fieldrecord['subdate'],0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['expirydate'],0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['description'],0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['numofstudent'],0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['amount'],0, 12); ?></td>
                                        
                                     
                                         <td><button onclick="funcprint('','<?php echo $fieldrecord['subsid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                          <?php  if ($_SESSION["swiftotechedit"]==1) { ?>
                                        <td><button onclick="funcedit('','<?php echo $fieldrecord['subsid']; ?>')"><center><i class="fa fa-edit" style="color:yellow; font-size:2em"></i></center></button></td>
                                        <?php } ?>
                                         <?php  if ($_SESSION["swiftotechdelete"]==1) { ?>
                                        <td><button onclick="funcdelete('','<?php echo $fieldrecord['subsid']; ?>')"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
                                        <?php } ?>
                                           <td ><span class="btn-group">
                                            <center><button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-user"></i> Details<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu">
                                            <li ><span>Update by</span> : <?php echo  $staffname ; ?></li>
                                            <li><span>Upate Date</span> : <?php echo  $fieldrecord['udate']; ?></li>
                                            <li><span>Initial Date</span> : <?php echo  $fieldrecord['odate']; ?></li>
                                            <hr>
                                            <li>Login Date</li>
                                            <li><?php echo $logindate; ?></li>
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
                     <?php  if ($_SESSION["swiftotechadd"]==1) { ?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Add <?php echo $pagename; ?></legend>
                  <form enctype="multipart/form-data" action="?page=2" method="POST"  id="formsubid"  class="form-horizontal form-label-left" >

                       <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Number of Student</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  type="number" name="numofstudent" id="numofstudent" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Amount</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="amount" id="amount" class="form-control col-md-7 col-xs-12"  >
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Subscription Date<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="date"  id="subdate" name="subdate" required="required"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Expiry Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="date" name="expirydate" id="expdate" class="form-control col-md-7 col-xs-12"  >
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Description<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea  name="description" id="description" class="form-control col-md-7 col-xs-12"  required="required"></textarea>
                        </div>
                      </div>
                
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

                 <?php  }
               } ?>

                  <?php if($page==3) {
                              $subsid=trim(isset($_GET['id'])?$_GET['id']:false);
                              $records=$datas->alldashedit('subscription','subsid',$subsid);
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                              $fieldvalue=trim($fieldrecord['operatorid']);
                    ?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Edit <?php echo $pagename ?></legend>
                  <form enctype="multipart/form-data" action="?page=4" method="POST"  id="formsubid"  class="form-horizontal form-label-left" >
                      <input type="hidden" name="subsid" value="<?php echo $subsid; ?>">
                      
                       <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Number of Student</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  type="number" name="numofstudent" id="numofstudent" class="form-control col-md-7 col-xs-12" value="<?php echo $fieldrecord['numofstudent'] ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Amount</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="amount" id="amount" class="form-control col-md-7 col-xs-12"  value="<?php echo $fieldrecord['amount'] ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Subscription Date<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="date"  id="subdate" name="subdate" required="required"  class="form-control col-md-7 col-xs-12" value="<?php echo $fieldrecord['subdate'] ?>">
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Expiry Date</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="date" name="expirydate" id="expdate" class="form-control col-md-7 col-xs-12"  value="<?php echo $fieldrecord['expirydate'] ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Description<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea  name="description" id="description" class="form-control col-md-7 col-xs-12"  required="required"><?php echo $fieldrecord['description'] ?></textarea>
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
                <?php   } 
                   }
                }
                ?>

                <?php if ($page==5) {
                  $subsid=trim(isset($_GET['id'])?$_GET['id']:false);
                              $records=$datas->alldashedit('subscription','subsid',$subsid);
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                              $fieldvalue=trim($fieldrecord['operatorid']);
                                $swirecords=$datas->alldashedit('swiftotechadmin','swiftotechid',$fieldvalue);
                              if (is_array($swirecords)) {
                                
                              foreach($swirecords as $swirecord){
                                $staffname=$swirecord['staffname'];
                                $logindate=$swirecord['udate'];
                                $swiftotechid=$swirecord['swiftotechid'];
                                    }
                                  }
                  ?>
                    <div class="x_panel" >
                  <div class="x_title">
                    <h3>Swiftotech Microsystem</h3>
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
                                          <i class="fa fa-tag" style="color:#063; "></i> Payment Receipt
                                          <small class="pull-right">Dated: <?php echo $odate; ?></small>
                                      </h3>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                       
                       
                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col">
                         <img style="display: block" src="images/swifto_logo.png" <?php } ?> class="img img-responsive img-thumbnail" >
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col" align="right">
                          <h4><b>Admin Details:</b></h4>
                          <address>
                                          Updated by: <strong><?php echo $staffname; ?></strong>
                                          <br><b>Date: </b><?php echo $fieldrecord['udate']; ?></strong>
                                          <br><b>Initial Insertion Date: </b><?php echo $fieldrecord['odate']; ?>
                                          
                                      </address>
                        </div>

                      
                      </div>
                      <!-- /.row -->


                   

                      <div class="row">
                       
                        <div class="col-xs-12">
                          <hr>
                          <center><p class="lead schoolhelpcolor"><b>Subscription Details </p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                 <tr>
                                  <th>Number of Student:</th>
                                  <td><?php echo $fieldrecord['numofstudent']; ?></td>
                                </tr>

                               <tr>
                                  <th>Amount:</th>
                                  <td><?php echo $fieldrecord['amount']; ?></td>
                                </tr>
                                <tr>
                                  <th style="width:50%">Subscription Date:</th>
                                  <td><?php echo  date("l jS F, Y", strtotime($fieldrecord['subdate'])) ; ?></td>
                                </tr>
                                <tr>
                                  <th>Expiry Date:</th>
                                  <td><?php echo date("l jS F, Y", strtotime($fieldrecord['expirydate'])); ?></td>
                                </tr>
                                <tr>
                                  <th>Description:</th>
                                  <td><?php echo $fieldrecord['description']; ?></td>
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
                          <div class="col-xs-6"><button class="btn btn-success print-link" ><i class="fa fa-print"></i> Print</button></div>
                          <?php if ($_SESSION['swiftotechedit']==1) { ?>
                          <div class="col-xs-6"><a class="btn btn-primary "  href="?page=3&id=<?php echo $fieldrecord['subsid']; ?>"><i class="fa fa-edit"></i> Edit</a></div>
                          <?php  } ?>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
                <?php }
                
                } ?>
              </div>
            </div> 
            <?php } ?>
       <?php include("includes/footer.php"); ?>