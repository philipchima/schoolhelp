
<?php 
/*include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/schoolhelpinserts.php");
include_once("../phpclass/schoolhelpupdate.php");
include_once("../phpclass/schoolhelpOOP.php");*/
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="News";
$schoolhelp=1;
$xdate=date("Y-m-d");


$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

if($page==1) {
  //$numberoffields=trim(isset($_POST['numberoffields'])?$_POST['numberoffields']:false);
}

if($page==2) {
  //getting array ofrecords
 $institutionname=trim(ucwords(isset($_POST['institutionname'])?$_POST['institutionname']:false));
 $institutionslogan=trim(isset($_POST['institutionslogan'])?$_POST['institutionslogan']:false);
 $institutionphone=trim(isset($_POST['institutionphone'])?$_POST['institutionphone']:false);
 $institutionaddress=trim(isset($_POST['institutionaddress'])?$_POST['institutionaddress']:false);
 $institutionemail=trim(isset($_POST['institutionemail'])?$_POST['institutionemail']:false);
 $institutionregpre=trim(isset($_POST['institutionregpre'])?$_POST['institutionregpre']:false);

//Checking whether logo was uploaded(browsed)
$institutionlogo=$_FILES["institutionlogo"]["name"];
 if($institutionlogo!=""){
    $target_dir = "../images/logo/";
    $institutionlogotmp=$_FILES['institutionlogo']['tmp_name']; 
  $temp = explode(".", $_FILES["institutionlogo"]["name"]);
  $institutionlogoname =strtolower($institutionname).round(microtime(true)) . '.' . end($temp);
move_uploaded_file($_FILES["institutionlogo"]["tmp_name"], "../images/logo/" . $institutionlogoname);

  }


$tableDepartment=new insertTable;
$state=$tableDepartment->insert_institution($institutionname, $institutionslogan, 
$institutionphone, $institutionaddress, $institutionemail, $institutionregpre,
$institutionlogoname, $schoolhelp, $xdate);
$display=$state['action'];
$insertedrow=$state['insertedrow'];


$sql=$display.":: Insertion, affected records = 1";

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&state=$display&sql=$sql';
      </script>";
}

if($page==4) {
  
$institutionname=trim(ucwords(isset($_POST['institutionname'])?$_POST['institutionname']:false));
 $institutionslogan=trim(isset($_POST['institutionslogan'])?$_POST['institutionslogan']:false);
 $institutionphone=trim(isset($_POST['institutionphone'])?$_POST['institutionphone']:false);
 $institutionaddress=trim(isset($_POST['institutionaddress'])?$_POST['institutionaddress']:false);
 $institutionemail=trim(isset($_POST['institutionemail'])?$_POST['institutionemail']:false);
 $institutionregpre=trim(isset($_POST['institutionregpre'])?$_POST['institutionregpre']:false);
 $institutionlogoold=trim(isset($_POST['instilogoold'])?$_POST['instilogoold']:false);
$i_id=trim(isset($_POST['i_id'])?$_POST['i_id']:false);

$institutionlogo=$_FILES["institutionlogo"]["name"];
 if($institutionlogo!=""){
    $target_dir = "../images/logo/";
    $institutionlogotmp=$_FILES['institutionlogo']['tmp_name']; 
  $temp = explode(".", $_FILES["institutionlogo"]["name"]);
  $institutionlogoname =strtolower($institutionname).round(microtime(true)) . '.' . end($temp);
  move_uploaded_file($_FILES["institutionlogo"]["tmp_name"], "../images/logo/" . $institutionlogoname);
  @unlink("../images/logo/".$institutionlogoold);
  }else{
    $institutionlogoname=$institutionlogoold;
  }

$tableinstitution=new updateTable;
$state=$tableinstitution->update_institution($i_id, $institutionname, $institutionslogan,  $institutionphone,  $institutionaddress, $institutionemail, $institutionregpre, $institutionlogoname, $schoolhelp);

$sql=$state.":: Update Made, affected records = 1";
echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&state=$state&sql=$sql';
      </script>";
}

//include("includes/header.php");
//this helps you to know the kind of driver you are using
//print_r(PDO::getAvailableDrivers());
 ?>
   <!-- page content -->
    <div class="right_col" role="main">
         

            <div class="row">
              <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12" style="margin-bottom: 20px;">
                <div class="x_panel">
                  <div class="x_title" style="background: #61dc42; padding-top: 10px; border-radius: 6px;">
                    <h2 id="caption">Institution</h2>
                    <?php include("menu.php") ?>

                    <div class="clearfix"></div>
                  </div>
                  <div style="color:#063" <?php if ($state=="failed") {?> style="color:red" <?php } ?> ><b><?php echo $sql; ?></b></div>

                  
                    <?php //if ($page=="") {?>
                      <div class="x_panel ">
                         <fieldset>
                        <legend style="color:#063"><?php echo $pagename; ?> Record</legend>

                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Name</th>
                          <th>Slogan</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>Email</th>
                          <th>Prefix</th>
                         
                          <th style="width:10%;"><i class="far fa-address-card" style="color:green"></i> Print</th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:yellow"></i> Edit</th>
                          <th style="width:10%;"><i class="fa fa-delete" style="color:red"></i> Delete</th>
                           <th>User<i class="fa fa-user"></i></th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php /*$k=0; 
                             $datas=new classInstitution; 
                              $records=$datas->institution();
                              if (isset($records)) {
                                $adminrecord=new Adminperson;
                              foreach($records as $fieldrecord){
                                $k+=1;
                                $fieldvalue=trim($fieldrecord['operatorid']);
                               
                                $admindata=$adminrecord->adminpersons('adminid', $fieldvalue);*/
                                ?>
                                      <tr>
                                        <td><?php //echo $k; ?></td>
                                        <td><?php// echo  substr($fieldrecord['instiname'],0, 12); ?></td>
                                        <td><?php //echo  substr($fieldrecord['instislogan'],0, 12); ?></td>
                                        <td><?php //echo  substr($fieldrecord['instiphone'],0, 12); ?></td>
                                        <td><?php //echo  substr($fieldrecord['instiaddress'],0, 12); ?></td>
                                        <td><?php //echo  substr($fieldrecord['instiemail'],0, 12); ?></td>
                                        <td><?php //echo substr($fieldrecord['instiprefix'],0, 12); ?></td>
                                        
                                     
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['i_id']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['i_id']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['i_id']; ?>')"><center><i class="fa fa-delete" style="color:red; font-size:2em"></i></center></button></td>
                                           <td ><span class="btn-group">
                                            <center><button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-user"></i> Details<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu">
                                            <li ><span>Update by</span> : <?php// echo  $admindata['surname']. " ".$admindata['othername'] ; ?></li>
                                            <li><span>Upate Date</span> : <?php// echo  $fieldrecord['sdate']; ?></li>
                                            <li><span>Initial Date</span> : <?php// echo  $fieldrecord['xdate']; ?></li>
                                            
                                          </ul>
                                          </center></span>

                                        </td>
                                      </tr>
                             <?php// }
                              //}
                             ?>
                        
                      </tbody>
                    </table>
                   </fieldset>
                    </div>
                    <?php //} ?>

                    <?php //if($page==1) {?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Add <?php echo $pagename; ?></legend>
                  <form enctype="multipart/form-data" action="?page=2&schoophelp=<?php echo $schoolhelp; ?>" method="POST"  id="forminstitutionid"  class="form-horizontal form-label-left" >

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Topic<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="topic" required="required" name="topic" class="form-control col-md-7 col-xs-12" onblur="return updatevalidity('institution', 'instiname', this.value, 'inserting', $(this).attr('id'));">
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Content</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="content" class="form-control col-md-7 col-xs-12" type="text" name="content">
                        </div>
                      </div>
                     
                       <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Institution Phone No</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="institutionphone" class="form-control col-md-7 col-xs-12" type="number" name="institutionphone">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Institution Address<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="institutionaddress" class="form-control col-md-7 col-xs-12"  name="institutionaddress" required="required"></textarea>
                        </div>
                      </div>
                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Institution Email</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="institutionemail" class="form-control col-md-7 col-xs-12" type="text" name="institutionemail">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Prefix of Registration No<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="institutionregpre" class="form-control col-md-7 col-xs-12" type="text" name="institutionregpre" required="required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Photo<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="file-field">
                            <img src="" height="100" width="100" id="showimage"/>
                              <input type="file" name="dlink"  id="institutionlogo" class="form-control col-md-7 col-xs-12"  onchange="readURL(this, $(this).attr('id'),  'showimage');">
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
                 <?php// } ?>

                  <?php /*if($page==3) {
                    $i_id=trim(isset($_GET['id'])?$_GET['id']:false);

                    $datas=new classInstitution;
                    $record=$datas->institutionedit('i_id', $i_id)*/
                    ?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Edit News</legend>
                  <form enctype="multipart/form-data" action="?page=4&schoophelp=<?php echo $schoolhelp; ?>&i_id=<?php echo $i_id; ?>" method="POST"  id="forminstitutionid"  class="form-horizontal form-label-left" >
                      <input type="hidden" name="i_id" value="<?php echo $i_id; ?>">
                      <input type="hidden" name="institutionlogoold" value="<?php echo $record['instilogo']; ?>">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Topic<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="institutionname" value="<?php echo $record['instiname']; ?>" required="required" name="institutionname" class="form-control col-md-7 col-xs-12" onblur="return updatevalidity('institution', 'instiname', this.value, 'updating', $(this).attr('id'));">
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Content</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="content" class="form-control col-md-7 col-xs-12" type="text" name="content" value="<?php echo $record['instislogan']; ?>">
                        </div>
                      </div>
                     
                       <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Institution Phone No</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="institutionphone" class="form-control col-md-7 col-xs-12" type="number" name="institutionphone" value="<?php echo $record['instiphone']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Institution Address<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="institutionaddress" class="form-control col-md-7 col-xs-12"  name="institutionaddress" required="required"><?php echo $record['instiaddress']; ?></textarea>
                        </div>
                      </div>
                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Institution Email</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="institutionemail" class="form-control col-md-7 col-xs-12" type="text" name="institutionemail" value="<?php echo $record['instiemail']; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Prefix of Registration No<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="institutionregpre" class="form-control col-md-7 col-xs-12" type="text" name="institutionregpre" required="required" value="<?php echo $record['instiprefix']; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Institution Logo<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="file-field">
                            <img  height="100" width="100" id="showimage"  <?php if($record['instilogo']!=""){ ?> src="../images/logo/<?php echo $record['instilogo'];  ?>" style="display: block;" <?php } ?> />
                              <input type="file" name="institutionlogo"  id="institutionlogo" class="form-control col-md-7 col-xs-12"  onchange="readURL(this, $(this).attr('id'),  'showimage');">
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
                <?php// } ?>

                <?php if ($page==5) {
                  $i_id=trim(isset($_GET['id'])?$_GET['id']:false);

                    $datas=new classInstitution;
                    $record=$datas->institutionedit('i_id', $i_id);

                    //Getting Operators ID
                    $fieldvalue=trim($record['operatorid']);
                    $adminrecord=new Adminperson;
                    $admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
                  ?>
                    <div class="x_panel" >
                  <div class="x_title">
                    <h2>Institution Details </h2>
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
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $record['instiname']; ?>.
                                          <small class="pull-right">Date: <?php echo $xdate; ?></small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                       
                       
                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col">
                         <img id="userimage" <?php if ($record['instilogo']!="") {?> style="display: block" src="../images/logo/<?php echo $record['instilogo'] ?>" <?php } ?> class="img img-responsive img-thumbnail" >
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
                          <center><p class="lead schoolhelpcolor"><b><?php echo $record['instiname']; ?> Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Name:</th>
                                  <td><?php echo $record['instiname']; ?></td>
                                </tr>
                                <tr>
                                  <th>Slogan:</th>
                                  <td><?php echo $record['instislogan']; ?></td>
                                </tr>
                                <tr>
                                  <th>Phone:</th>
                                  <td><?php echo $record['instiphone']; ?></td>
                                </tr>
                                <tr>
                                  <th>Address:</th>
                                  <td><?php echo $record['instiaddress']; ?></td>
                                </tr>

                               <tr>
                                  <th>Email:</th>
                                  <td><?php echo $record['instiemail']; ?></td>
                                </tr>
                                <tr>
                                  <th>Prefix:</th>
                                  <td><?php echo $record['instiprefix']; ?></td>
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