
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/schoolhelpinserts.php");
include_once("../phpclass/schoolhelpupdate.php");
include_once("../phpclass/schoolhelpOOP.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Session";
$schoolhelp=1;
$odate=date("Y-m-d");
$year=date("Y");
$year1=$year+1;


$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

if($page==1) {
  $numberoffields=trim(isset($_POST['numberoffields'])?$_POST['numberoffields']:false);
}

if($page==2) {
  //getting array ofrecords
  $k=0;
$sessions=isset($_POST['sessionlow'])?$_POST['sessionlow']:false;
$counting=0;
foreach($sessions as $sessioncount=>$sessionname){
if ($sessioncount<=1) {
  

$sessionhigh=trim(isset($_POST['sessionhigh'.$sessioncount])?$_POST['sessionhigh'.$sessioncount]:false);
$description=trim(isset($_POST['description'.$sessioncount])?$_POST['description'.$sessioncount]:false);
$tablesession=new insertTable;
$state=$tablesession->insert_session($sessionname, $sessionhigh, $description, $schoolhelp, $odate);

$display=$state['action'];
$counting=$counting+$state['counting'];

}


 }

$sql=$display.":: Insertion, affected records = ".$counting;

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}

if($page==4) {
  

$sessionid=trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);
$sessionlow=trim(isset($_POST['sessionlow'])?$_POST['sessionlow']:false);
$sessionhigh=trim(isset($_POST['sessionhigh'])?$_POST['sessionhigh']:false);
$description=trim(isset($_POST['description'])?$_POST['description']:false);

$tablesession=new updateTable;
$state=$tablesession->update_session($sessionid, $sessionlow, $sessionhigh, $description, $schoolhelp);

$sql=$state.":: Update Made, affected records = 1";
echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&state=$state&sql=$sql';
      </script>";
}

if($page==6) {
  
$id=trim(isset($_GET['id'])?$_GET['id']:false);
$updateall=new updateTBLactivate;
//(tablename, tableid, fieldtoupdate, tableidvalue, operatorid)
$state=$updateall->updatingall('session', 'sessionid', 'status', $id, $schoolhelp);

$sql=$state.":: This session is activated, affected records = 1";
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
                    <h2 id="caption">session</h2>
                    <ul class="nav navbar-right panel_toolbox" style="">
                      <li><a class="btn btn-primary" href="../?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                      <li><a class="btn btn-success " href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"> Settings</i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                          
                         <li><a href="#"  data-toggle="modal" data-target="#myModal" ><i class="fa fa-plus"></i>  Add session</a>
                      </li>
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  View session</a>
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
                        <legend style="color:#063">session Record</legend>
                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>session</th>
                        
                          <th>Description</th>
                          <th>Active <i class="fa fa-light"></i></th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:red"></i> Edit</th>
                          <th>User<i class="fa fa-user"></i></th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0;
                              $datas=new classsession; 
                              $records=$datas->session('asc');
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
                                        <td><?php echo  $fieldrecord['sessionlow']. " / ".$fieldrecord['sessionhigh']; ?></td>
                                        <td><?php echo  $fieldrecord['description']; ?></td>
                                        <td><button type="button" <?php if ($fieldrecord['status']==1) { $caption='Active';?> class="btn btn-success" <?php } else{$caption='Set Active'; ?> class="btn btn-primary" <?php } ?>   onclick="funcactivate('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['sessionid']; ?>')"><?php echo  $caption; ?></button></td>
                                        
                                        <td><button  onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['sessionid']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
                                     
                                  
                                           <td ><span class="btn-group">
                                            <center><button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-user"></i> Details<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu">
                                            <li ><span>Update by</span> : <?php echo  $admindata['surname']. " ".$admindata['othername'] ; ?></li>
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
                        <legend style="color:#063">Add <?php echo $pagename ?></legend>
                  <form action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST" id="schools" data-parsley-validate class="form-horizontal form-label-left" onSubmit="return updatevalidity('department', 'sessionname', this.value, 'updating', $(this).attr('id'));">

                     <?php $count=0; while($numberoffields>=1){
                       $numberoffields-=1; 

                       ?>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sessionlow">Session Low<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="sessionlow<?php echo $count; ?>" name="sessionlow[]" required="required" class="form-control col-md-7 col-xs-12" onblur="updatevalidity('session', 'sessionlow', this.value, 'inserting', $(this).attr('id'));" placeholder="Example: <?php echo $year; ?>">
                          <br><b>to</b>
                           <input type="number" id="sessionhigh<?php echo $count; ?>" name="sessionhigh<?php echo $count; ?>" required="required" class="form-control col-md-7 col-xs-12" onblur="updatevalidity('session', 'sessionhigh', this.value, 'inserting', $(this).attr('id'));" placeholder="Example:  <?php echo $year1; ?>">
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="description<?php echo $count; ?>" class="form-control col-md-7 col-xs-12"></textarea>  
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
                   echo  $sessionid=trim(isset($_GET['id'])?$_GET['id']:false);

                    $datas=new classsession;
                    $record=$datas->sessionedit('sessionid', $sessionid)
                    ?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Edit session</legend>
                  <form action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST" id="schools" data-parsley-validate class="form-horizontal form-label-left">

                       <input name="sessionid" type="hidden" id="sessionid"  value="<?php echo $sessionid ?>" required="required" >
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sessionlow">Session Low<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="sessionlow" type="text" id="sessionlow"  required="required" class="form-control col-md-7 col-xs-12" onblur="updatevalidity('session', 'sessionlow', this.value, 'updating', $(this).attr('id'));" placeholder="Example: <?php echo $year; ?>" value="<?php echo $record['sessionlow'] ?>">
                          <br><b>to</b>
                           <input type="text" name="sessionhigh" id="sessionhigh" required="required" class="form-control col-md-7 col-xs-12" onblur="updatevalidity('session', 'sessionhigh', this.value, 'updating', $(this).attr('id'));" placeholder="Example: <?php echo $year1; ?>" value="<?php echo $record['sessionhigh'] ?>">
                        </div>
                      </div>
                      
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="description" class="form-control col-md-7 col-xs-12"><?php echo $record['description']; ?></textarea>  
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