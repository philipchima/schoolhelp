<?php
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHbusaryOOP.php");
confirmcheckin();
$SHbursaryOOP=new classBusary;

$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);

/*$session=$SHbursaryOOP->alldashedit('session', 'status', 1);
if (is_array($session)) {
  foreach($session as $sessionrec){
   $sessionname= $sessionrec['sessionlow'].'|'.$sessionrec['sessionhigh'];
  }
}

$semester=$SHbursaryOOP->alldashedit('semesters', 'status', 1);
if (is_array($semester)) {
  foreach($semester as $semesterrec){
   $semestername= $semesterrec['semestername'];
  }
}*/

//this helps you to know the kind of driver you are using
//print_r(PDO::getAvailableDrivers());
 ?>

    <?php include("includes/header.php"); ?>
        <!-- page content -->
    <div class="right_col" role="main">
          <div class="">

          
            <div class="row">
              <div class="col-md-12" style="width: 100%">
                <div class="x_panel"  >
                  <div class="x_title">
                   <span style="float:left"> <h4>Bursary Management</h4></span>
                   <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link" style="color:#d2dc2a;"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench" style="color:#d2dc2a;"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="../settings?schoolhelp=<?php echo $schoolhelp ?>">System Settings</a>
                          </li>
                          <li><a href="../?schoolhelp=<?php echo $schoolhelp ?>">Dashboard</a>
                          </li>
                        </ul>
                      </li>
                      <li><a  class="close-link" href="../index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-close " style="color:#d2dc2a;"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="row">

                       <div class="col-md-55">
                         <a href="../?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none; "> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/home.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:red">Access the Home page</span>
                              <div class="tools tools-bottom">
                               <span  style="color:red">Home Page Modules</span>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size: 16px"> Dashboard</span></center>
                          </div>
                        </div>
                         </a>
                      </div>

                      <div class="col-md-55">
                         <a href="paymentmode?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/modes_payments.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Payments Mode</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Payment Mode</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Payment Mode</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>

                      <div class="col-md-55">
                         <a href="Banks?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/bank.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Banks</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Banks</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Banks</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>

                    <div class="col-md-55">
                         <a href="setupfees?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/controlpanel.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Setup Fees</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Payable Fees</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Setup Fees</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                     
                        <div class="col-md-55">
                         <a href="manualschoolfee?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/manualfee1.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Add and Edit School fee Manually</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Manual Fee</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Manual Fee</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>

                       <div class="col-md-55">
                         <a href="generatefee?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/term_fee.jpg" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Banks</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Generate Term Fee</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Generate Term Fee</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
              
              </div>
            </div>


                <div class="x_title">
                   <span style="float:left"> <h4>Inventory Modules</h4></span>
                    <div class="clearfix"></div>
                  </div>

                 <?php if ($admintype==1) { ?>
                      <div class="col-md-55">
                         <a href="setupinventory?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/inventory1.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Setup Inventories</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Add Inventories Details</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Setup Inventory</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>
                      <?php } ?>
                      
                       <div class="col-md-55">
                         <a href="inventoryname?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/inventoryname.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Add, Edit, Delete Inventory Name</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Inventory Name</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Inventory Name</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>

                        <div class="col-md-55">
                         <a href="item?schoolhelp=<?php echo $schoolhelp; ?>" style="text-decoration:none;"> 
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <center>
                            <img  src="../images/products.png" alt="image" class="img-responsive">
                            </center>
                            <div class="mask">
                               <span  style="color:#063"><b>Add, Edit, Delete Inventory Item</b></span>
                              <div class="tools tools-bottom">
                               <i  style="color:white; font-size:10px;" class="fa fa-hand-o-down">Inventory Item</i>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                          <center> <span style="font-size:16px; color:#060;"><b>Add Item</b></span></center>
                          </div>
                        </div>
                         </a>
                      </div>   


          </div>
        </div>

      

  </div>
</form>
</div>

       <?php include("includes/footer.php"); ?>