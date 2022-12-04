
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHwebinserts.php");
include_once("../phpclass/SHwebupdate.php");
include_once("../phpclass/SHwebOOP.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Slide";
$schoolhelp=1;
$odate=date("Y-m-d");

//calling of class
$datas=new classWeb; 
$tableUpdate=new updateWeb;


$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

if($page==1) {
  //$numberoffields=trim(isset($_POST['numberoffields'])?$_POST['numberoffields']:false);
}

if($page==2) {
  //getting array ofrecords
 
//Checking whether photo was uploaded(browsed)
$photo=$_FILES["photo"]["name"];
 if($photo!=""){
    $target_dir = "uploads/slide/";
    $phototmp=$_FILES['photo']['tmp_name']; 
  $temp = explode(".", $_FILES["photo"]["name"]);
  $photoname1 =strtolower($photo).round(microtime(true)) . '.' . end($temp);
   $photoname=trim(preg_replace('/\s+/','', $photoname1));
  move_uploaded_file($_FILES["photo"]["tmp_name"], $target_dir  . $photoname);
  }

$insertedrow=0;
$tableslide=new insertTable;
$state=$tableslide->insert_slide($photoname, $schoolhelp, $odate);
$display=$state['action'];
$insertedrow=$state['counting'];


$sql=$display.":: Insertion, affected records = 1";

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&state=$display&sql=$sql';
      </script>";
}

if($page==4) {
  
echo $id=trim(isset($_POST['id'])?$_POST['id']:false);
$photoold=trim(isset($_POST['photoold'])?$_POST['photoold']:false);


$photo=$_FILES["photo"]["name"];
 if($photo!=""){
    $target_dir = "uploads/slide/";
    $phototmp=$_FILES['photo']['tmp_name']; 
  $temp = explode(".", $_FILES["photo"]["name"]);
  $photoname1 =strtolower($photo).round(microtime(true)) . '.' . end($temp);
   $photoname=trim(preg_replace('/\s+/','', $photoname1));
  move_uploaded_file($_FILES["photo"]["tmp_name"], $target_dir  . $photoname);
  @unlink($target_dir.$photoold);
  }else{
    $photoname=$photoold;
  }


$state=$tableUpdate->update_slide($id, $photoname, $schoolhelp);

$sql=$state.":: Update Made, affected records = 1";
echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&state=$state&sql=$sql';
      </script>";
}


if ($page==6) {
   $id=trim(isset($_GET['id'])?$_GET['id']:false);
   $photo=trim(isset($_GET['photo'])?$_GET['photo']:false);
   
    $state=$tableUpdate->delete_web('slide', 'id', $id);

        $sql=$state.":: Deletion Made, affected records = 1";
          if ($state=="Success") {
                 $target_dir = "uploads/slide/";
                  @unlink($target_dir.$photo);
              }
             
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
                    <h2 id="caption">Slide</h2>
                    <?php include("menu.php"); ?>

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
                          <th>Photo</th>
                         
                          
                          <th style="width:10%;"><i class="fa fa-address-card" style="color:green"></i> Print</th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:yellow"></i> Edit</th>
                          <th style="width:10%;"><i class="fa fa-trash" style="color:red"></i> Delete</th>
                           <th>User<i class="fa fa-user"></i></th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                             
                              $records=$datas->allweb('slide', 'id', 'DESC');
                              if (isset($records)) {
                               
                              foreach($records as $fieldrecord){
                                $k+=1;
                                $fieldvalue=trim($fieldrecord['operatorid']);
                               
                                $admindata=$datas->allwebedit('adminpersons', 'adminid',  $fieldvalue);
                                foreach($admindata as $adminrecord){
                                  $adminsurname=$adminrecord['surname'];
                                  $adminothername=$adminrecord['othername'];
                                }
                                ?>
                                      <tr>
                                        <td><?php echo  $k ?></td>
                                         <td style="width:15%"><img src="uploads/slide/<?php echo  $fieldrecord['photo']; ?>" class="img img-responsive img-rounded"></td>
                                     
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['id']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['id']; ?>')"><center><i class="fa fa-edit" style="color:yellow; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['id']; ?>','<?php echo $fieldrecord['photo']; ?>')"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
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

                    <?php if($page==1) {?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Add <?php echo $pagename; ?></legend>
                  <form enctype="multipart/form-data" action="?page=2&schoophelp=<?php echo $schoolhelp; ?>" method="POST"  id="slide"  class="form-horizontal form-label-left" >

                      
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $pagename; ?>Photo<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="file-field">
                            <img src="" height="100" width="100" id="showimage"/>
                              <input type="file" name="photo"  id="photo" class="form-control col-md-7 col-xs-12"  onchange="readURL(this, $(this).attr('id'),  'showimage');">
                        </div>
                      </div>
                      <p id="error1" style="display:none; color:#FF0000;">
                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                        </p>
                        <p id="error2" style="display:none; color:#FF0000;">
                        Maximum File Size Limit is 1MB.
                        </p>
                    </div>
                     <p id="error1" style="display:none; color:#FF0000;">
                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                        </p>
                        <p id="error2" style="display:none; color:#FF0000;">
                        Maximum File Size Limit is 1MB.
                        </p>
                      <div id="msg" ></div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Add</button>
                        </div>
                      </div>

                    </form>
                  </div>
                  </fieldset>
                 </div>
                 <?php } ?>

                  <?php if($page==3) {
                    $id=trim(isset($_GET['id'])?$_GET['id']:false);

                    $slidedata=$datas->allwebedit('slide', 'id',  $id);
                                foreach($slidedata as $sliderecord){
                                  $photo=$sliderecord['photo'];
                                  $operatorid=$sliderecord['operatorid'];
                                   $udate=$sliderecord['udate'];
                                  $odatetb=$sliderecord['odate'];
                                }
                    ?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Edit <?php echo $pagename ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoophelp=<?php echo $schoolhelp; ?>&id=<?php echo $id; ?>" method="POST"  id="id"  class="form-horizontal form-label-left" >
                      <input type="hidden" name="id" value="<?php echo $id; ?>">
                      <input type="hidden" name="photoold" value="<?php echo $photo; ?>">
                      
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Photo<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="file-field">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="photo" name="photo" value="<?php echo $photo; ?>" required="required" class="form-control col-md-7 col-xs-12" onblur="return updatevalidity('slide', 'photo', this.value, 'updating', $(this).attr('id'));">
                        </div>
                        </div>
                      </div>
                      <p id="error1" style="display:none; color:#FF0000;">
                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                        </p>
                        <p id="error2" style="display:none; color:#FF0000;">
                        Maximum File Size Limit is 1MB.
                        </p>
                    </div>
                     <p id="error1" style="display:none; color:#FF0000;">
                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                        </p>
                        <p id="error2" style="display:none; color:#FF0000;">
                        Maximum File Size Limit is 1MB.
                        </p>
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

                <?php if ($page==5) {
                    $id=trim(isset($_GET['id'])?$_GET['id']:false);

                    $slidedata=$datas->allwebedit('slide', 'id',  $id);
                                foreach($slidedata as $sliderecord){
                                  $photo=$sliderecord['photo'];
                                  $operatorid=$sliderecord['operatorid'];
                                  $udate=$sliderecord['udate'];
                                  $odatetb=$sliderecord['odate'];
                                }
                    //Getting Operators ID
                    $admindata=$datas->allwebedit('adminpersons', 'adminid', $operatorid);
                                foreach($admindata as $adminrecord){
                                  $adminsurname=$adminrecord['surname'];
                                  $adminothername=$adminrecord['othername'];
                                }
                  
                  ?>
                    <div class="x_panel" >
                  <div class="x_title">
                    <h2>New Details </h2>
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
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $photo; ?>.
                                          <s<small class="pull-right">Printed on: <?php echo $odate; ?></small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                       
                       
                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col">
                         <img id="userimage" <?php if ($photo!="") {?> style="display: block" src="uploads/slide/<?php echo $photo; ?>" <?php } ?> class="img img-responsive img-thumbnail" >
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col" align="right">
                          <h4><b>Admin Details:</b></h4>
                          <address>
                                          Updated by: <strong><?php echo $adminsurname ." ".$adminothername; ?></strong>
                                          <br><b>Date: </b><?php echo $udate; ?></strong>
                                          <br><b>Initial Insertion Date: </b><?php echo $odate; ?>
                                          
                                      </address>
                        </div>

                      
                      </div>
                      <!-- /.row -->


                   

                      <div class="row">
                       
                        <div class="col-xs-12">
                          <hr>
                          <center><p class="lead schoolhelpcolor"><b><?php echo $photo; ?> Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Photo:</th>
                                  <td><?php echo $photo; ?></td>
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