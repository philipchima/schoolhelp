
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHwebinserts.php");
//include_once("../phpclass/SHwebupdate.php");
//include_once("../phpclass/SHwebOOP.php");

$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="News";
$schoolhelp=1;
$odate=date("Y-m-d");


$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

if($page==1) {
  //$numberoffields=trim(isset($_POST['numberoffields'])?$_POST['numberoffields']:false);
}

if($page==2) {
  //getting array ofrecords
 echo $topic=trim(ucwords(isset($_POST['topic'])?$_POST['topic']:false));
 echo $content=trim(isset($_POST['content'])?$_POST['content']:false);
 

//Checking whether logo was uploaded(browsed)
echo $photo=$_FILES["photo"]["name"];
exit();
 if($photo!=""){
    $target_dir = "uploads/news/";
    $phototmp=$_FILES['photo']['tmp_name']; 
  $temp = explode(".", $_FILES["photo"]["name"]);
  echo $photoname =strtolower($topic).round(microtime(true)) . '.' . end($temp);
move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/news/" . $photoname);

  }


$tableDepartment=new insertTable;
$state=$tableDepartment->insert_institution($topic, $content,
$photo, $udate, $odate);
$display=$state['action'];
$insertedrow=$state['insertedrow'];


$sql=$display.":: Insertion, affected records = 1";

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&state=$display&sql=$sql';
      </script>";
}

if($page==4) {
  
$topic=trim(ucwords(isset($_POST['topic'])?$_POST['topic']:false));
 $content=trim(isset($_POST['content'])?$_POST['content']:false);
 $photo=trim(isset($_POST['photo'])?$_POST['photo']:false);
$newsid=trim(isset($_POST['newsid'])?$_POST['newsid']:false);

$photo=$_FILES["photo"]["name"];
 if($photo!=""){
    $target_dir = "images/news/";
    $phototmp=$_FILES['photo']['tmp_name']; 
  $temp = explode(".", $_FILES["photo"]["name"]);
  $photoname =strtolower($topic).round(microtime(true)) . '.' . end($temp);
  move_uploaded_file($_FILES["photo"]["tmp_name"], "images/news/" . $photoname);
  @unlink("images/news/".$photoold);
  }else{
    $photoname=$photoold;
  }

$tablenews=new updateTable;
$state=$tablenews->update_news($newsid, $topic, $content,  $photo, $schoolhelp);

$sql=$state.":: Update Made, affected records = 1";
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
                    <h2 id="caption">News</h2>
                    <?php include("menu.php") ?>

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
                          <th>Topic</th>
                          <th>Content</th>
                          <th>Photo</th>
                         
                          <th style="width:10%;"><i class="far fa-address-card" style="color:green"></i> Print</th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:yellow"></i> Edit</th>
                          <th style="width:10%;"><i class="fa fa-trash" style="color:red"></i> Delete</th>
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
                                        <td><?php// echo  substr($fieldrecord['SN'],0, 12); ?></td>
                                        <td><?php //echo  substr($fieldrecord['topic'],0, 12); ?></td>
                                        <td><?php //echo  substr($fieldrecord['content'],0, 12); ?></td>
                                        <td><?php //echo  substr($fieldrecord['photo'],0, 12); ?></td>
                                        
                                     
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['newsid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['newsid']; ?>')"><center><i class="fa fa-edit" style="color:yellow; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['newsid']; ?>')"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
                                           <td ><span class="btn-group">
                                            <center><button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-user"></i> Details<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu">
                                            <li ><span>Update by</span> : <?php// echo  $admindata['surname']. " ".$admindata['othername'] ; ?></li>
                                            <li><span>Upate Date</span> : <?php// echo  $fieldrecord['udate']; ?></li>
                                            <li><span>Initial Date</span> : <?php// echo  $fieldrecord['odate']; ?></li>
                                            
                                          </ul>
                                          </center></span>

                                        </td>
                                      </tr>
                             <?php //}
                              //}
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
                  <form enctype="multipart/form-data" action="?page=2&schoophelp=<?php echo $schoolhelp; ?>" method="POST"  id="newsid"  class="form-horizontal form-label-left" >

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Topic<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="topic" required="required" name="topic" class="form-control col-md-7 col-xs-12" onblur="return updatevalidity('news', 'topic', this.value, 'inserting', $(this).attr('id'));">
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Content</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="content" id="content" class="form-control col-md-7 col-xs-12" type="text" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Photo<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="file-field">
                            <img src="" height="100" width="100" id="showimage"/>
                              <input type="file" name="photo"  id="photo" class="form-control col-md-7 col-xs-12"  onchange="readURL(this, $(this).attr('newsid'),  'showimage');">
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

                  <?php if($page==3) {
                    $newsid=trim(isset($_GET['id'])?$_GET['id']:false);

                    $datas=new classInstitution;
                    $record=$datas->institutionedit('newsid', $newsid)
                    ?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Edit News</legend>
                  <form enctype="multipart/form-data" action="?page=4&schoophelp=<?php echo $schoolhelp; ?>&i_id=<?php echo $newsid; ?>" method="POST"  id="newsid"  class="form-horizontal form-label-left" >
                      <input type="hidden" name="newsid" value="<?php echo $newsid; ?>">
                      <input type="hidden" name="newsid" value="<?php echo $record['newsid']; ?>">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Topic<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="topic" value="<?php echo $record['topic']; ?>" required="required" name="topic" class="form-control col-md-7 col-xs-12" onblur="return updatevalidity('news', 'topic', this.value, 'updating', $(this).attr('newsid'));">
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Content</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="content" class="form-control col-md-7 col-xs-12" type="text" name="content" value="<?php echo $record['content']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Photo<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="file-field">
                            <img  height="100" width="100" id="showimage"  <?php //if($record['photo']!=""){ ?> src="images/news/<?php echo $record['photo'];  ?>" style="display: block;" <?php// } ?>
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
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                  </fieldset>
                 </div>
                <?php } ?>

                <?php if ($page==5) {
                  $newsid=trim(isset($_GET['id'])?$_GET['id']:false);

                    $datas=new classInstitution;
                    $record=$datas->newsedit('newsid', $newsid);

                    //Getting Operators ID
                    $fieldvalue=trim($record['operatorid']);
                    $adminrecord=new Adminperson;
                    $admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
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
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $record['topic']; ?>.
                                          <small class="pull-right">Printed on: <?php echo $odate; ?></small>
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
                                          <br><b>Date: </b><?php echo $record['udate']; ?></strong>
                                          <br><b>Initial Insertion Date: </b><?php echo $record['odate']; ?>
                                          
                                      </address>
                        </div>

                      
                      </div>
                      <!-- /.row -->


                   

                      <div class="row">
                       
                        <div class="col-xs-12">
                          <hr>
                          <center><p class="lead schoolhelpcolor"><b><?php echo $record['topic']; ?> Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Name:</th>
                                  <td><?php echo $record['topic']; ?></td>
                                </tr>
                                <tr>
                                  <th>Slogan:</th>
                                  <td><?php echo $record['content']; ?></td>
                                </tr>
                                <tr>
                                  <th>Phone:</th>
                                  <td><?php echo $record['photo']; ?></td>
                                </tr
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