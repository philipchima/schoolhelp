
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/schoolhelpinserts.php");
include_once("../phpclass/schoolhelpupdate.php");
include_once("../phpclass/schoolhelpOOP.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Title";
$schoolhelp=1;
$xdate=date("Y-m-d");


$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

if($page==1) {
  $numberoffields=trim(isset($_POST['numberoffields'])?$_POST['numberoffields']:false);
}

if($page==2) {
  //getting array ofrecords
$titles=isset($_POST['titlename'])?$_POST['titlename']:false;

foreach($titles as $titlecount=>$titlename){
$titlename=trim(ucwords($titlename));
$description=trim(isset($_POST['description'.$titlecount])?$_POST['description'.$titlecount]:false);
$tableTitle=new insertTable;
$state=$tableTitle->insert_title($titlename, $schoolhelp, $xdate);
}
$sql=$state.":: Insertion Made, affected records = ".count($titles);
echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&state=$state&sql=$sql';
      </script>";
}

if($page==4) {
  

$titlename=trim(isset($_POST['titlename'])?$_POST['titlename']:false);

$titleid=trim(isset($_POST['titleid'])?$_POST['titleid']:false);
$tableTitle=new updateTable;
$state=$tableTitle->update_title($titleid, $titlename,  $schoolhelp);

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
                    <h2 id="caption"> Titles</h2>
                    <ul class="nav navbar-right panel_toolbox" style="">
                      <li><a class="btn btn-primary" href="../?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                      <li><a class="btn btn-success " href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"> Settings</i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                         <li  ><a href="#" data-toggle="modal" data-target="#myModal" ><i class="fa fa-plus"></i>  Add Title</a>
                      </li>
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  View Title</a>
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
                        <legend style="color:#063">Title Record</legend>
                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>title</th>
                         
                          <th>Operator Name</th>
                          <th><i class="fa fa-calendar" style="color:#063"></i> Date Upated</th>
                          <th><i class="fa fa-calendar" style="color:#063"></i>Date inserted</th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:red"></i> Edit</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0;
                              $datas=new classtitle; 
                              $records=$datas->title();
                              $adminrecord= new Adminperson;
                              if (isset($records)) {
                               
                              foreach($records as $fieldrecord){
                                
                                $fieldvalue=trim($fieldrecord['operatorid']);
                               
                                $admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
                              $adminname= $admindata['surname']. " ".$admindata['othername'] ;
                                $k+=1;
                                ?>
                                      <tr>
                                        <td><?php echo $k; ?></td>
                                        <td><?php echo  trim(substr($fieldrecord['titlename'],0,12)); ?></td>
                                       
                                        <td><?php echo  trim(substr($adminname, 0, 12)); ?></td>
                                        <td><?php echo  $fieldrecord['sdate']; ?></td>
                                        <td><?php echo  $fieldrecord['xdate']; ?></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['titleid']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
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
                        <legend style="color:#063">Add Title</legend>
                  <form action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST" id="schools" data-parsley-validate class="form-horizontal form-label-left" onSubmit="return updatevalidity('title', 'titlename', this.value, 'updating', $(this).attr('id'));">

                     <?php $count=0; while($numberoffields>=1){
                       $numberoffields-=1; 

                       ?>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titlename">Name of title<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="titlename<?php echo $count; ?>" name="titlename[]" required="required" class="form-control col-md-7 col-xs-12" onblur="updatevalidity('title', 'titlename', this.value, 'inserting', $(this).attr('id'));">
                        </div>
                      </div>

                      
                       <hr>
                      <?php $count+=1; } ?>
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
                    $titleid=trim(isset($_GET['id'])?$_GET['id']:false);
                    

                    $datas=new classtitle;
                    $record=$datas->titleedit('titleid', $titleid)
                    ?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Edit Title</legend>
                  <form action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST" id="title" data-parsley-validate class="form-horizontal form-label-left">

                       <input type="hidden" id="titleid" name="titleid" value="<?php echo $titleid ?>" required="required" >
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titlename">Name of title<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="titlename" name="titlename" value="<?php echo $record['titlename'] ;?>" required="required" class="form-control col-md-7 col-xs-12" onblur="updatevalidity('title', 'titlename', this.value, 'updating', $(this).attr('id'));" />
                        </div>
                      </div>

                      
                       <hr>
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