
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHwebinserts.php");
include_once("../phpclass/SHwebupdate.php");
include_once("../phpclass/SHwebOOP.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="News";
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
 $topic=trim(ucwords(isset($_POST['topic'])?$_POST['topic']:false));
 $content=trim(isset($_POST['content'])?$_POST['content']:false);
 

//Checking whether logo was uploaded(browsed)
$photo=$_FILES["photo"]["name"];

 if($photo!=""){
    $target_dir = "uploads/news/";
    $phototmp=$_FILES['photo']['tmp_name']; 
  $temp = explode(".", $_FILES["photo"]["name"]);
  $photoname1 =strtolower($topic).round(microtime(true)) . '.' . end($temp);
   $photoname=trim(preg_replace('/\s+/','', $photoname1));
move_uploaded_file($_FILES["photo"]["tmp_name"], $target_dir  . $photoname);

  }


$tableNews=new insertTable;
$state=$tableNews->insert_news($topic, $content, $photoname, $schoolhelp,  $odate);
$display=$state['action'];
$insertedrow=$state['counting'];


$sql=$display.":: Insertion, affected records = ".$insertedrow;

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}

if($page==4) {
  
$topic=trim(ucwords(isset($_POST['topic'])?$_POST['topic']:false));
 $content=trim(isset($_POST['content'])?$_POST['content']:false);
 $photo=trim(isset($_POST['photo'])?$_POST['photo']:false);
$newsid=trim(isset($_POST['newsid'])?$_POST['newsid']:false);
$newsphotoold=trim(isset($_POST['newsphotoold'])?$_POST['newsphotoold']:false);

$photo=$_FILES["photo"]["name"];
 if($photo!=""){
    $target_dir = "uploads/news/";
    $phototmp=$_FILES['photo']['tmp_name']; 
  $temp = explode(".", $_FILES["photo"]["name"]);
  $photoname1 =strtolower($topic).round(microtime(true)) . '.' . end($temp);
   $photoname=trim(preg_replace('/\s+/','', $photoname1));
  move_uploaded_file($_FILES["photo"]["tmp_name"], $target_dir  . $photoname);
  @unlink($target_dir.$newsphotoold);
  }else{
    $photoname=$newsphotoold;
  }


$state=$tableUpdate->update_news($newsid, $topic, $content,  $photoname, $schoolhelp);

$sql=$state.":: Update Made, affected records = 1";
echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&state=$state&sql=$sql';
      </script>";
}

if ($page==6) {
   $newsid=trim(isset($_GET['id'])?$_GET['id']:false);
   $photo=trim(isset($_GET['photo'])?$_GET['photo']:false);
   
    $state=$tableUpdate->delete_web('news', 'newsid', $newsid);

        $sql=$state.":: Deletion Made, affected records = 1";
          if ($state=="Success") {
                 $target_dir = "uploads/news/";
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
                          <th>Photo</th>
                          <th>Topic</th>
                          <th>Content</th>
                         
                          <th style="width:10%;"><i class="far fa-address-card" style="color:green"></i> Print</th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:yellow"></i> Edit</th>
                          <th style="width:10%;"><i class="fa fa-trash" style="color:red"></i> Delete</th>
                           <th>User<i class="fa fa-user"></i></th>
                        </tr>
                      </thead> 

                      <tbody>
                        <?php $k=0; 
                             
                              $records=$datas->allweb('news', 'newsid', 'DESC');
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
                                        <td><?php echo  $k; ?></td>
                                        <td style="width:15%"><img src="uploads/news/<?php echo  $fieldrecord['photo']; ?>" class="img img-responsive img-rounded"></td>
                                        
                                        
                                        <td><?php echo  substr($fieldrecord['topic'],0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['content'],0, 12); ?></td>
                                        
                                     
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['newsid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['newsid']; ?>')"><center><i class="fa fa-edit" style="color:yellow; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['newsid']; ?>','<?php echo $fieldrecord['photo']; ?>')"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
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
                    $newsid=trim(isset($_GET['id'])?$_GET['id']:false);

                    $newsdata=$datas->allwebedit('news', 'newsid',  $newsid);
                                foreach($newsdata as $newsrecord){
                                  $topic=$newsrecord['topic'];
                                  $content=$newsrecord['content'];
                                  $photo=$newsrecord['photo'];
                                  $operatorid=$newsrecord['operatorid'];
                                   $udate=$newsrecord['udate'];
                                  $odatetb=$newsrecord['odate'];
                                }
                    ?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Edit News</legend>
                  <form enctype="multipart/form-data" action="?page=4&schoophelp=<?php echo $schoolhelp; ?>&i_id=<?php echo $newsid; ?>" method="POST"  id="newsid"  class="form-horizontal form-label-left" >
                      <input type="hidden" name="newsid" value="<?php echo $newsid; ?>">
                      <input type="hidden" name="newsphotoold" value="<?php echo $photo; ?>">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Topic<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="topic" value="<?php echo $topic; ?>" required="required" name="topic" class="form-control col-md-7 col-xs-12" onblur="return updatevalidity('news', 'topic', this.value, 'updating', $(this).attr('newsid'));">
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Content</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="content" class="form-control col-md-7 col-xs-12" type="text" name="content" required="required" value="<?php echo $content; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Photo<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="file-field">
                            <img  height="100" width="100" id="showimage"  <?php if($photo!=""){ ?> src="uploads/news/<?php echo $photo;  ?>" style="display: block;" <?php } ?> >
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
                          <button type="submit" class="btn btn-success">Update</button>
                        </div>
                      </div>

                    </form>
                  </div>
                  </fieldset>
                 </div>
                <?php } ?>

                <?php if ($page==5) {
                  $newsid=trim(isset($_GET['id'])?$_GET['id']:false);

                   $newsdata=$datas->allwebedit('news', 'newsid',  $newsid);
                                foreach($newsdata as $newsrecord){
                                  $topic=$newsrecord['topic'];
                                  $content=$newsrecord['content'];
                                  $photo=$newsrecord['photo'];
                                  $operatorid=$newsrecord['operatorid'];
                                   $udate=$newsrecord['udate'];
                                  $odatetb=$newsrecord['odate'];
                                }
                    //Getting Operators ID
                   $admindata=$datas->allwebedit('adminpersons', 'adminid',   $operatorid);
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
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $topic; ?>.
                                          <small class="pull-right">Date: <?php echo $odate; ?></small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                       
                       
                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col">
                         <img id="userimage" <?php if ($photo!="") {?> style="display: block" src="uploads/news/<?php echo $photo ?>" <?php } ?> class="img img-responsive img-thumbnail" >
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col" align="right">
                          <h4><b>Admin Details:</b></h4>
                          <address>
                                          Updated by: <strong><?php echo $adminsurname ." ".$adminothername; ?></strong>
                                          <br><b>Date: </b><?php echo $udate; ?></strong>
                                          <br><b>Initial Insertion Date: </b><?php echo $odatetb; ?>
                                          
                                      </address>
                        </div>

                      
                      </div>
                      <!-- /.row -->


                   

                      <div class="row">
                       
                        <div class="col-xs-12">
                          <hr>
                          <center><p class="lead schoolhelpcolor"><b><?php echo $topic; ?> Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Topic:</th>
                                  <td><?php echo $topic; ?></td>
                                </tr>
                                <tr>
                                  <th>Content:</th>
                                  <td><?php echo $content; ?></td>
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