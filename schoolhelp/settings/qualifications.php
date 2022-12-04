
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/schoolhelpinserts.php");
include_once("../phpclass/schoolhelpupdate.php");
include_once("../phpclass/schoolhelpOOP.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Qualification";
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
$qualifications=isset($_POST['qualificationname'])?$_POST['qualificationname']:false;

foreach($qualifications as $qualificationcount=>$qualificationname){
$qualificationname=trim(ucwords($qualificationname));
$description=trim(isset($_POST['description'.$qualificationcount])?$_POST['description'.$qualificationcount]:false);
$tablequalification=new insertTable;
$state=$tablequalification->insert_qualification($qualificationname, $schoolhelp, $xdate);
}
$sql=$state.":: Insertion Made, affected records = ".count($qualifications);
echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&state=$state&sql=$sql';
      </script>";
}

if($page==4) {
  

$qualificationname=trim(isset($_POST['qualificationname'])?$_POST['qualificationname']:false);

$qualificationid=trim(isset($_POST['qualificationid'])?$_POST['qualificationid']:false);
$tablequalification=new updateTable;
$state=$tablequalification->update_qualification($qualificationid, $qualificationname,  $schoolhelp);

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
                  <div class="x_qualification" style="background: #61dc42; padding-top: 10px; border-radius: 6px;">
                    <h2 id="caption"> Qualifications</h2>
                    <ul class="nav navbar-right panel_toolbox" style="">
                      <li><a class="btn btn-primary" href="../?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                      <li><a class="btn btn-success " href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"> Settings</i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                         <li  ><a href="#" data-toggle="modal" data-target="#myModal" ><i class="fa fa-plus"></i>  Add qualification</a>
                      </li>
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  View qualification</a>
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
                        <legend style="color:#063">Qualification Record</legend>
                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Qualification</th>
                         
                          <th>Operator Name</th>
                          <th><i class="fa fa-calendar" style="color:#063"></i> Date Upated</th>
                          <th><i class="fa fa-calendar" style="color:#063"></i>Date inserted</th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:red"></i> Edit</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0;
                              $datas=new classqualification; 
                              $records=$datas->qualification();
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
                                        <td><?php echo  trim(substr($fieldrecord['qualificationname'],0,12)); ?></td>
                                       
                                        <td><?php echo  trim(substr($adminname, 0, 12)); ?></td>
                                        <td><?php echo  $fieldrecord['udate']; ?></td>
                                        <td><?php echo  $fieldrecord['odate']; ?></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['qualificationid']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
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
                        <legend style="color:#063">Add Qualification</legend>
                  <form action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST" id="schools" data-parsley-validate class="form-horizontal form-label-left" onSubmit="return updatevalidity('qualification', 'qualificationname', this.value, 'updating', $(this).attr('id'));">

                     <?php $count=0; while($numberoffields>=1){
                       $numberoffields-=1; 

                       ?>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qualificationname">Name of qualification<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="qualificationname<?php echo $count; ?>" name="qualificationname[]" required="required" class="form-control col-md-7 col-xs-12" onblur="updatevalidity('qualification', 'qualificationname', this.value, 'inserting', $(this).attr('id'));">
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
                    $qualificationid=trim(isset($_GET['id'])?$_GET['id']:false);
                    

                    $datas=new classqualification;
                    $record=$datas->qualificationedit('qualificationid', $qualificationid)
                    ?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Edit Qualification</legend>
                  <form action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST" id="qualification" data-parsley-validate class="form-horizontal form-label-left">

                       <input type="hidden" id="qualificationid" name="qualificationid" value="<?php echo $qualificationid ?>" required="required" >
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qualificationname">Name of qualification<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="qualificationname" name="qualificationname" value="<?php echo $record['qualificationname'] ;?>" required="required" class="form-control col-md-7 col-xs-12" onblur="updatevalidity('qualification', 'qualificationname', this.value, 'updating', $(this).attr('id'));" />
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