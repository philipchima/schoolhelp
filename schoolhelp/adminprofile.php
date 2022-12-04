
<?php 
include_once("includes/global.php");
include_once("includes/connection.php");
include_once("phpclass/SHdashinserts.php");
include_once("phpclass/schoolhelpothers.php");
include_once("phpclass/schoolhelpOOP.php");
include_once("phpclass/SHdashOOP.php");
include_once("phpclass/SHdashupdate.php");
confirmcheckin();
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Admin`s Profile";

$odate=date("Y-m-d");
$udate=date("Y-m-d H:m:s");
$schoolhelpDH= new classDash;
$schhelpupdate= new updateTable;

$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

if ($page==4) {
      $password=trim(isset($_POST['password'])?$_POST['password']:false);
      $password2=trim(isset($_POST['password2'])?$_POST['password2']:false);
      $passwordold=trim(isset($_POST['passwordold'])?$_POST['passwordold']:false);
      echo $passwordold=Others::passwordconvert($passwordold);

      $passmethod=$schoolhelpDH->alldashedit2('adminpersons', 'adminid', $schoolhelp, 'password', $passwordold);
      if (is_array($passmethod)) {
              foreach($passmethod as $passrecord){
                echo $passwordnew=Others::passwordconvert($password);
               
              }

          if($password==$password2){
           $state=$schhelpupdate->updatesingle2('adminpersons', 'adminid', $schoolhelp, 'password', $passwordnew, $schoolhelp, $udate);
            
            $sql=$state.":: Change Made, affected records = 1";
                echo "<script language='javascript'>
              location.href='schoolhelp=$schoolhelp&sql=$sql&page=1'
              </script>";       
            
          }
          else{ $sql="<b>Password did not Match</b>"; }

      }else{
          $sql="Criminal Action Suspected: Old password invalid";
          echo "<script language='javascript'>
              location.href='?schoolhelp=$schoolhelp&sql=$sql&page=1'
              </script>";
      }
}


include("includes/header.php");
//this helps you to know the kind of driver you are using
//print_r(PDO::getAvailableDrivers());
 ?>
   <!-- page content -->
    <div class="right_col" role="main">
         <div class="row">
          <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title" style="background: #61dc42; padding-top: 10px; border-radius: 6px;">
                    <h3 id="caption" style="float:left;"><?php echo $pagename ?></h3>
                    <ul class="nav navbar-right panel_toolbox" style="">
                      <li><a class="btn btn-primary" href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a></li>
                      <li><a class="btn btn-success " href="../settings/?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"> Settings</i></a>
                      </li>
                      
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div style="color:#063"  ><b><?php echo $sql; ?></b></div>
                   <?php if($page==1) { 

                      ?>
                    <div class="x_panel" style="width: 100%">

                      <fieldset>
                        <legend style="color:#063">Add <?php echo $pagename; ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="formstid"  class="form-horizontal form-label-left" >

                     

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Old Password<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" class="form-control form-control-padded" name="passwordold" id="Passwordold"  value=""  placeholder="Enter Old Password" required/>
                        </div>
                      </div>


                      

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">New Password<span class="required">*</span></label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" class="form-control form-control-padded" name="password" id="Password"  value=""  placeholder="Enter Password" required />
                          <span>Enter a password longer than 8 characters</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm New Password<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" class="form-control form-control-padded" name="password2" id="ConfirmPassword" value=""   placeholder="Re-enter Password" required />
                          <span>Please confirm your password</span> </p>
                        </div>
                      </div>
                      

                   
                  
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

                <?php if ($page=="") {
                
             
                $records=$schoolhelpDH->alldashedit('adminpersons', 'adminid', $schoolhelp);
                    if (is_array($records)) {
                      
                   
                     foreach($records as $fieldrecord){
                                
                               $admintype=trim($fieldrecord['admintype']);
                               $surname= trim($fieldrecord['surname']);
                               $othername= trim($fieldrecord['othername']);
                               $email= trim($fieldrecord['email']);
                             
                               $address=trim($fieldrecord['address']);
                               $phone=trim($fieldrecord['phone']);
                               $email=trim($fieldrecord['email']);
                               $logintime=$fieldrecord['logintime'];
                               $logouttime=$fieldrecord['logouttime'];

                               if ($admintype==1) {
                                  $positionname="Super Admin";
                                  $photo="images/swifto_logo.png";
                                  $department="General";
                                } else{
                                  $signatorypositionid=trim($fieldrecord['signatorypositionid']);

                                  //Getting Staff ID
                                        $signatorydata=$schoolhelpDH->alldashedit('signatoryposition', 'signatorypositionid',  $signatorypositionid);
                                           if(is_array($signatorydata)){
                                              foreach($signatorydata as $signatoryrec){
                                                $positionname=$signatoryrec['positionname'];
                                                $staffid=$signatoryrec['staffid'];
                                                $departmentid=$signatoryrec['departmentid'];
                                              }
                                            }

                                        //Getting Staff ID
                                        $staffdata=$schoolhelpDH->alldashedit('staff', 'staffid',  $staffid);
                                           if(is_array($staffdata)){
                                              foreach($staffdata as $staffrec){
                                                $surname=$staffrec['surname'];
                                                $othername=$staffrec['othername'];
                                                $address=$staffrec['address'];
                                                $phone=$staffrec['phone'];
                                                $email=$staffrec['email'];
                                                $passport=$staffrec['passport'];
                                                
                                              }
                                            }
                                            //getting department Name
                                             $departmentdata=$schoolhelpDH->alldashedit('department', 'did',  $departmentid);
                                           if(is_array($departmentdata)){
                                              foreach($departmentdata as $departmentrec){
                                                $departmentname=$departmentrec['deptname'];
                                              }
                                            }
                                            $photo="images/uploads/staff/".$passport;
                                }

                  ?>
                    
                  <div class="x_title">
                    <h3 class="schoolhelp"><?php echo $pagename; ?> Details </h3>
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
                          <h3 class="schoolhelp">
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $surname." ".$othername; ?> Details.
                                          <small class="pull-right">Pinted on: <?php echo $odate; ?></small>
                                      </h3>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                       
                       
                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col">
                         <img id="userimage" <?php if (file_exists($photo)) {?> style="display: block" src="<?php echo $photo; ?>" <?php } ?> class="img img-responsive img-thumbnail" >
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col" align="right">
                          <h4><b>Login Details:</b></h4>
                          <address>
                                          
                                          <br><b>Last Login: </b><?php echo $logintime; ?></strong>
                                          <br><b>last Logout </b><?php echo $logouttime; ?>
                                          
                                      </address>
                        </div>

                      
                      </div>
                      <!-- /.row -->


                   

                      <div class="row">
                       
                        <div class="col-xs-12">
                          <hr>
                          <center><p class="lead schoolhelpcolor"><b><?php echo $positionname; ?> Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                               
                                <tr>
                                  <th style="width:50%">Surname:</th>
                                  <td><?php echo $surname; ?></td>
                                </tr>
                                <tr>
                                  <th>OtherName:</th>
                                  <td><?php echo $othername; ?></td>
                                </tr>
                                 <tr>
                                  <th>Position:</th>
                                  <td><?php echo $positionname; ?></td>
                                </tr>
                                 <tr>
                                  <th>Department:</th>
                                  <td><?php echo $departmentname; ?></td>
                                </tr>
                                <tr>
                                  <th>Residential Address:</th>
                                  <td><?php echo $address; ?></td>
                                </tr>
                                <tr>
                                  <th>Phone:</th>
                                  <td><?php echo $phone; ?></td>
                                </tr>
                                <tr>
                                  <th>Email:</th>
                                  <td><?php echo $email; ?></td>
                                </tr>
                               
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                      <?php 
                    }
                  }
                      ?>
                      <!-- this row will not appear when printing -->
                      <div class="row no-print" style="margin-bottom: 50px">
                        <div class="col-xs-12">
                          <div class="col-xs-6">
                          <button class="btn btn-default print-link" ><i class="fa fa-print"></i> Print</button>  
                        </div>
                        <div class="col-xs-6">
                          <a class="btn btn-success" href="?schoolhelp=<?php echo $schoolhelp; ?>&page=1" ><i class="fa fa-edit"></i> Change Password</a>
                        </div>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>

                <?php } ?>

              </div>
            </div>
            
       <?php include("includes/footer.php"); ?>