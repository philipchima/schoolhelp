<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/schoolhelpinserts.php");
include_once("../phpclass/schoolhelpupdate.php");
include_once("../phpclass/schoolhelpdelete.php");
include_once("../phpclass/schoolhelpOOP.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Print Pins";
$schoolhelp=1;
$odate=date("Y-m-d");

// Checking page access Authenticity
$schoolhelpsetting=new Allsettings;
$previllages=$schoolhelpsetting->allsettingedit('adminpersons', 'adminid', $schoolhelp);
foreach($previllages as $actualrecord){
  $pageaccess=trim($actualrecord['pin_s']);
  $settingedit_s=trim($actualrecord['settingedit_s']);
  $settingdelete_s=trim($actualrecord['settingdelete_s']);
  $settingadd_s=trim($actualrecord['settingadd_s']);
}
if ($pageaccess!=1) {
  echo "<b style='font-size:100; color:red'>Criminal Attempt Made, contact the admin ask for the access of this page</b>";
  exit();
}

//calling of classes
//department Table
$deptclass=new classDepartment;
//grade table
$datas=new classGrade;
//Admin Methods
$adminrecord=new Adminperson;

$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);


  if($page == 2){

  $departmentid =trim(isset($_POST["departmentid"])?$_POST["departmentid"]:false);
  $cardstatus=trim(isset($_POST["cardstatus"])?$_POST["cardstatus"]:false);
  $quantity=trim(isset($_POST["quantity"])?$_POST["quantity"]:false);
  
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
                    <h2 id="caption"><?php echo $pagename; ?></h2>
                    <ul class="nav navbar-right panel_toolbox" style="">
                      <li><a class="btn btn-primary" href="../?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                      <li><a class="btn btn-success " href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"> Settings</i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                          <?php if ($settingadd_s==1) {?>
                         <li  ><a href="pingeneration?schoolhelp=<?php echo $schoolhelp; ?>"  ><i class="fa fa-plus"></i>  Generate Pin</a>
                          <?php } ?>
                      </li>
                          <li ><a  href="printpins?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  Print Pins</a>
                      </li>
                      <li ><a  href="viewpins?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  View Pins</a>
                      </li>
                        </ul>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div style="color:#063" <?php if($state=="failed") {?> style="color:red" <?php } ?> ><b><?php echo $sql; ?></b></div>

                  <div class="x_panel">
                    <form  action="printpins?page=2&schoolhelp=<?php echo $schoolhelp ?>" name="search" method="post" >
                      <fieldset>
                        <legend>Generate Pins</legend>
                        
                             
                      <table class="table table-responsive" style="overflow-y:hidden;">
                        <thead>
                          <tr>
                            <th> Department: </th>
                           <th>Pin Status: </th>
                            <th>Quantity: </th>
                            
                            <th>Action: </th>
                          </tr>
                        </thead>
                        <tbody>
                         <tr>
              
                    <td style="padding-right:20px">
                        <select  id="departmentid" required="required" name="departmentid" class="form-control col-md-4" >
                            <option value="">--Select Department--</option>
                            <?php
                            $deptrecord=$deptclass->department('asc');
                            if (is_array($deptrecord)) {
                            
                            foreach($deptrecord as $deptdata){
                            ?>
                            <option value="<?php echo $deptdata['did']; ?>"  ><?php echo $deptdata['deptname']; ?></option>
                            <?php } 
                            }
                            ?>
                          </select>
                    </td>

                    
                        <td >
                      <select name="cardstatus" id="cardstatus"  class="form-control col-md-4" required="required">
                        <option value="">--Select--</option>
                         <option value="0" >Valid</option>
                         <option value="1" >Active</option>
                         <option value="2" >Expired</option>
                      </select>                                                                                                                                                                                                                                                                                                              
                  </td>

                    

                      <td style="padding-right:10px">
                             <select name="quantity" class="form-control col-md-4" id="quantity" required="required">
                              <option value="">--Select--</option>
                               <?php
                $k = 0;
                              ?>
                            <?php do { $k+=1; ?>
                            <option value="<?php echo  $k; ?>" ><?php echo  $k; ?></option>
                            <?php } while ($k<1000); ?>
                            </select>
                         </td>
                         
                  <td> <input  type="submit" class="btn btn-primary" value="Print Pin" class="form-control col-md-4" /></td>
             </tr>
           </tbody>
              </table>
            
            </form>
             </fieldset>
                  </div>
                  <?php if ($page=="") {
          //Valid Pin
         $records=$schoolhelpsetting->allsettingeditg('pingenerate','status',0, 'expirydate',$odate);
          $totalvalid=count($records);
          //$validstatus=Pin_manipulate::pincode("status", 0);
          //$totalvalid=trim($validstatus['numrow']);
          if ($totalvalid=="") {
            $totalvalid=0;
          }
          //Active Pin
          $records1=$schoolhelpsetting->allsettingeditg('pingenerate','status',1, 'expirydate',$odate);
          $totalactive=count($records1);
          
          if ($totalactive=="") {
            $totalactive=0;
          }
          //Expired Pin
          $records2=$schoolhelpsetting->allsettingeditl('pingenerate','status',2, 'expirydate',$odate);
          $totalexpired=count($records2);
    
          if ($totalexpired=="") {
            $totalexpired=0;
          }
          ?>
          <div classs="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <table class="table table-responsive table-striped table-bordered">
              <caption><h3>Pin Report</h3></caption>
              <thead>
                <tr>
                  <td></td><th>Total</th><th>View</th>
                </tr>
              </thead>
              <tr><td>Valid Pins</td><td><?php echo $totalvalid; ?></td><td><a href="viewpins?page=2&pinstatus=0&schoolhelp=<?php echo $schoolhelp; ?>" style="color:green;">View</a></td></tr>
              <tr><td>Active Pins</td><td><?php echo $totalactive; ?></td><td><a href="viewpins?page=2&pinstatus=1&schoolhelp=<?php echo $schoolhelp; ?>" style="color:green;">View</a></td></tr>
              <tr><td>Expired Pins</td><td><?php echo $totalexpired; ?></td><td><a href="viewpins?page=2&pinstatus=2&schoolhelp=<?php echo $schoolhelp; ?>" style="color:green;">View</a></td></tr></tr>
            </table>
          </div>
        <?php } ?>

                  <?php
                    if ($page == 2){
                ?>
                <div class="x_panel" id="printrecord">
                  <div class='row'>
                  <?php 
                  $records=$schoolhelpsetting->allsettingeditg3limit('pingenerate','departmentid',$departmentid,'status',0, 'expirydate',$odate, $quantity);
                  $cardnumrow=count($records);
                  if ($cardnumrow>=$quantity) {
                    if (is_array($records)) {
                                
                    foreach($records as $fieldrecord){
                      $duration1=$odate-$fieldrecord['expirydate'];
                      $duration=$fieldrecord['duration'];
                      $departmentid=trim($fieldrecord['departmentid']);

                       //collecting department record
                              $deptmethod=$deptclass->departmentedit('did', $departmentid);
                              $deptname=$deptmethod['deptname'];
                      
                      if ($duration1>$fieldrecord['duration']) {
                        $duration1=$fieldrecord['duration'];
                      }
                      ?>
                       <div class='col-md-4' style='border:2px solid black'>
                        <div style=' align:center'><center><h3>Student|Parent Login Pin</h3></center></div>
                        <div>Allocated School: <span style='color:red'><?php echo $deptname; ?></span></div>
                        <div>Pin: <span style='color:red'><?php echo $fieldrecord['pincode']; ?></span></div>
                        <div>The Actual Days Allocated is: <?php echo $duration; ?></div>
                        <div>You have <?php echo $duration1; ?> days to use this Pin</div>
                        <div>The Pin becomes Invalid on <?php echo $fieldrecord['expirydate']; ?></div>
                        <div><b>NB: The Count starts from the day you start using it</b></div>
        
                </div>
                <?php 
                   }
                 }?>
               <div class="col-lg-12"><button type="button" class="btn btn-success glyphicon glyphicon-save print-link">Print</button></div>
                <?php  }else{ echo "The Quantity of Pins selected is below what we have in the database"; }?>
                
                
                </div>   
                </div>
                <?php } ?>
              
              </div>
            </div>
       <?php include("includes/footer.php"); ?>