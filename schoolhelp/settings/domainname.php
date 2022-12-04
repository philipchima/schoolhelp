<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/schoolhelpinserts.php");
include_once("../phpclass/schoolhelpupdate.php");
include_once("../phpclass/schoolhelpdelete.php");
include_once("../phpclass/schoolhelpOOP.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Domain Name";

$odate=date("Y-m-d");

// Checking page access Authenticity
$schoolhelpsetting=new Allsettings;
$previllages=$schoolhelpsetting->allsettingedit('adminpersons', 'adminid', $schoolhelp);
foreach($previllages as $actualrecord){
  $pageaccess=trim($actualrecord['domain_s']);
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


if($page==2) {
      if($settingadd_s==1) {

  //getting array ofrecords
  $domainnamearray=isset($_POST['domainname'])?$_POST['domainname']:false;

 $domaintypeid=trim(isset($_POST['domaintypeid'])?$_POST['domaintypeid']:false);
 
 $counting=0;
 foreach($domainnamearray as $dataindex => $domainname){
 $domainname=trim(ucwords($domainname));
 
 $tbldomainname=new insertTable;
$state=$tbldomainname->insert_domainname($domaintypeid, $domainname, $schoolhelp, $odate);
$display=$state['action'];
$counting=$counting+$state['counting'];
}
 


$sql=$display.":: Insertion, affected records = ".$counting;

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";

      }
      else{
          $sql="Unauthorised Please contact the Admin";

        echo "<script>
                window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
              </script>";
        }

}




if($page==4) {
  if($settingedit_s==1) {

 //getting array ofrecords
  $domainnameid=trim(isset($_POST['domainnameid'])?$_POST['domainnameid']:false);
  $domaintypeid=trim(isset($_POST['domaintypeid'])?$_POST['domaintypeid']:false);

 $domainname=trim(isset($_POST['domainname'])?$_POST['domainname']:false);
 
$tabledomainname=new updateTable;
$state=$tabledomainname->update_domainname($domaintypeid, $domainname,  $schoolhelp, $domainnameid);

$sql=$state.":: Update Made, affected records = 1";

   }else{
         $sql="Unauthorised Please contact the Admin";
    }

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}
// Checking page access Authenticity

if ($page==6) {
   if($settingdelete_s==1) {

  $domainnameid=trim(isset($_GET['id'])?$_GET['id']:false);
   
   $schoolhelpDHd= new TblDeleterow;
    $state=$schoolhelpDHd->delete_setting('domainname', 'domainnameid', $domainnameid);

        $sql=$state.":: Deletion Made, affected records = 1";
          
    }else{
         $sql="Unauthorised Please contact the Admin";
    }
   
      echo "<script>
                window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
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
                    <h2 id="caption"><?php echo $pagename; ?></h2>
                    <ul class="nav navbar-right panel_toolbox" style="">
                      <li><a class="btn btn-primary" href="../?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                      <li><a class="btn btn-success " href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"> Settings</i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Domain Type</a>
                        <ul class="dropdown-menu" role="menu">
                          <?php if ($settingadd_s==1) {?>
                         <li  ><a href="domaintype?page=1&schoolhelp=<?php echo $schoolhelp; ?>"  ><i class="fa fa-plus"></i>  Add Domain Type</a>
                          <?php } ?>
                      </li>
                          <li ><a  href="domaintype?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  View Type</a>
                      </li>
                        </ul>
                      </li>

                       <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-default" data-toggle="dropdown" style="color:black" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Domain Name</a>
                        <ul class="dropdown-menu" role="menu">
                          <?php if ($settingadd_s==1) {?>
                         <li  ><a href="?page=1&schoolhelp=<?php echo $schoolhelp; ?>"  ><i class="fa fa-plus"></i>  Add <?php echo $pagename; ?></a>
                          <?php } ?>
                      </li>
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  View <?php echo $pagename; ?></a>
                      </li>
                        </ul>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div style="color:#063" <?php if($state=="failed") {?> style="color:red" <?php } ?> ><b><?php echo $sql; ?></b></div>

                  
                    <?php if ($page=="") {?>
                      <div class="x_panel ">
                         <fieldset>
                        <legend style="color:#063"><?php echo $pagename; ?> Record</legend>

                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                       <colgroup>
                        <col>
                        <col>
                        <col style="background-color:#e6ffe6">
                      </colgroup>
                      <thead>
                       
                        <tr>
                          <th>SN</th>
                          <th>Department</th>
                          <th>Domain Type Name </th>
                          <th>Domain Name </th>
                          
                          <?php if ($settingedit_s==1) { ?>
                          <th style="width:10%;"><i class="far fa-address-card" style="color:green"></i> Print</th>
                         
                          <th style="width:10%;"><i class="fa fa-edit" style="color:red"></i> Edit</th>
                              <?php } if ($settingdelete_s==1) { ?>
                           <th style="width:10%;"><i class="fa fa-trash" style="color:red"></i> Delete</th>
                           <?php } ?>
                           <th>User<i class="fa fa-user"></i></th>
                       
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                            
                              $records=$schoolhelpsetting->allsetting('domainname','domainnameid','desc');

                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                $k+=1;
                                $fieldvalue=trim($fieldrecord['operatorid']);
                                 $domaintypeid=$fieldrecord['domaintypeid'];
                                 $domainnameid=$fieldrecord['domainnameid'];

                              $domaintyperecords=$schoolhelpsetting->allsettingedit('domaintype','domaintypeid',$domaintypeid);
                              if (is_array($domaintyperecords)) {
                              foreach($domaintyperecords as $domaintyperecord){
                                $domaintypename=$domaintyperecord['domaintypename'];
                                $departmentid=$domaintyperecord['departmentid'];
                              }
                            }
                               
                               //collecting department record
                              $deptmethod=$deptclass->departmentedit('did', $departmentid);
                              $deptname=$deptmethod['deptname'];
                                //Getting Admin Detials
                                $admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
                                ?>
                                      <tr>
                                        <td><?php echo $k; ?></td>
                                        <td><?php echo  substr($deptname, 0, 12); ?></td>
                                        <td><?php echo  substr($domaintypename,0, 12); ?></td>  
                                        <td><?php echo  substr($fieldrecord['domainname'],0, 12); ?></td>                      
                                        <?php if ($settingedit_s==1) { ?>
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['domainnameid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                          
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['domainnameid']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
                                         <?php } if ($settingdelete_s==1) { ?>
                                        <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['domainnameid']; ?>','');"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
                                        <?php } ?>
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
                              }else{ echo "<span class='required'>Record not inserted yet</span>";}
                             ?>
                        
                      </tbody>
                    </table>
                   </fieldset>
                    </div>
                    <?php } ?>

                    <?php if($page==1) {  
                      if ($settingadd_s==1) {
                    ?>

                    <div class="x_panel">

                      <fieldset>
                        <legend style="color:#063">Add <?php echo $pagename; ?></legend>
                  <form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="formgradeid"  class="form-horizontal form-label-left" >
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="domaintypeid">Domain Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
                          <select name="domaintypeid" id="domaintypeid" required="required"  class="form-control col-md-7 col-xs-12" onchange="addingfields('domainname', 'domaintypeid', 'domaintype', 'domaintypeid', 'numofdomain', this.value, 'checktwotables5');">
                            <option value="">--Select Domain Type--</option>
                            <?php
                            $domaintyperecord=$schoolhelpsetting->allsetting('domaintype', 'domaintypeid', 'ASC');
                            foreach($domaintyperecord as $domaintypedata){
                              if (is_array($domaintypedata)) { 
                              $departmentid=trim($domaintypedata['departmentid']);

                               //collecting department record
                              $deptmethod=$deptclass->departmentedit('did', $departmentid);
                              $deptname=$deptmethod['deptname'];
                               ?>
                            <option value="<?php echo $domaintypedata['domaintypeid']; ?>"><?php echo $domaintypedata['domaintypename'].' => '.$deptname; ?></option>
                            <?php      
                              }
                             } ?>
                          </select>
                        </div>
                      </div>

                      <div id="opencontainer">
                    </div>
                     


                   
                    </form>
                  </div>
                  </fieldset>
                 </div>
                 <?php } 

                      }
                 ?>

                  <?php 

                  if($page==3) {
                    $domainnameid=trim(isset($_GET['id'])?$_GET['id']:false);

                    $records=$schoolhelpsetting->allsettingedit('domainname','domainnameid',$domainnameid);

                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                             

                    ?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Edit <?php echo $pagename; ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="domainname"  class="form-horizontal form-label-left" >
                      <input type="hidden" name="domainnameid" value="<?php echo $domainnameid; ?>">

                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="domaintypeid">Domain Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
                          <select name="domaintypeid" id="domaintypeid" required="required"  class="form-control col-md-7 col-xs-12"  onchange="updatevalidity1('domainname', 'domainname', 'domaintypeid', $('#domainname').val(),  this.value, 'updating', $('#domainname').attr('id'));" value="<?php echo $fieldrecord['domainname']; ?>">
                            <option value="">--Select Domain Type--</option>
                            <?php
                            $domaintyperecord=$schoolhelpsetting->allsetting('domaintype', 'domaintypeid', 'ASC');
                            foreach($domaintyperecord as $domaintypedata){
                              if (is_array($domaintypedata)) { 
                              $departmentid=trim($domaintypedata['departmentid']);

                               //collecting department record
                              $deptmethod=$deptclass->departmentedit('did', $departmentid);
                              $deptname=$deptmethod['deptname'];
                               ?>
                            <option value="<?php echo $domaintypedata['domaintypeid']; ?>" <?php if($domaintypedata['domaintypeid']==$fieldrecord['domaintypeid']) {?> selected="selected" <?php } ?>><?php echo $domaintypedata['domaintypename'].' => '.$deptname; ?></option>
                            <?php      
                              }
                             } ?>
                          </select>
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="remark" class="control-label col-md-3 col-sm-3 col-xs-12">Domain Name</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="domainname" name="domainname" type="text" required="required" class="form-control col-md-7 col-xs-12"  placeholder="Please enter the Domain Name " onblur="return updatevalidity1('domainname', 'domainname', 'domaintypeid',  this.value, $('#domaintypeid').val(), 'updating', $(this).attr('id'));" value="<?php echo $fieldrecord['domainname']; ?>">
                        </div>
                      </div>

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
                <?php }
              }
              } ?>

                <?php if ($page==5) {
                  $domainnameid=trim(isset($_GET['id'])?$_GET['id']:false);
                  $records=$schoolhelpsetting->allsettingedit('domainname','domainnameid', $domainnameid);

                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                           
                                $fieldvalue=trim($fieldrecord['operatorid']);
                                 $domaintypeid=$fieldrecord['domaintypeid'];
                                 $domainnameid=$fieldrecord['domainnameid'];

                              $domaintyperecords=$schoolhelpsetting->allsettingedit('domaintype','domaintypeid',$domaintypeid);
                              if (is_array($domaintyperecords)) {
                              foreach($domaintyperecords as $domaintyperecord){
                                $domaintypename=$domaintyperecord['domaintypename'];
                                $departmentid=$domaintyperecord['departmentid'];
                              }
                            }
                               
                               //collecting department record
                              $deptmethod=$deptclass->departmentedit('did', $departmentid);
                              $deptname=$deptmethod['deptname'];
                                //Getting Admin Detials
                                $admindata=$adminrecord->adminpersons('adminid', $fieldvalue);

                                 //Instition Record
                                 $datas1=new classInstitution;
                                $record1=$datas1->institution();

                                foreach($record1 as $recordinstitution){
                                  $instilogo=trim($recordinstitution['instilogo']);
                                }


                              
                  ?>
                    <div class="x_panel" >
                  <div class="x_title">
                    <h2><?php echo $pagename; ?> Details </h2>
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
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $fieldrecord['domainname']; ?>.
                                          <small class="pull-right">Date: <?php echo $odate; ?></small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                       
                       
                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col">
                         <img id="userimage" <?php if ($instilogo!="") {?> style="display: block" src="../images/logo/<?php echo $instilogo; ?>" <?php } ?> class="img img-responsive img-thumbnail" >
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col" align="right">
                          <h4><b>Admin Details:</b></h4>
                          <address>
                                          Updated by: <strong><?php echo $admindata['surname'] ." ".$admindata['othername']; ?></strong>
                                          <br><b>Date: </b><?php echo $fieldrecord['udate']; ?></strong>
                                          <br><b>Initial Insertion Date: </b><?php echo $fieldrecord['odate']; ?>
                                          
                                      </address>
                        </div>

                      
                      </div>
                      <!-- /.row -->


                   

                      <div class="row">
                       
                        <div class="col-xs-12">
                          <hr>
                          <center><p class="lead schoolhelpcolor"><b><?php echo $deptname.' '.$domaintypename."=> ".$fieldrecord['domainname']; ?>   Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th>Department Name:</th>
                                  <td><?php echo $deptname; ?></td>
                                </tr>
                                <tr>
                                  <th >Domain Type:</th>
                                  <td><?php echo $domaintypename; ?></td>
                                </tr>
                                 <tr>
                                  <th>Domain</th>
                                  <td><?php echo $fieldrecord['domainname']; ?></td>
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
                          <div class="col-xs-6"><button class="btn btn-success print-link" ><i class="fa fa-print"></i> Print</button></div>
                          <?php if ($settingedit_s==1) { ?>
                          <div class="col-xs-6"><a class="btn btn-primary "  href="?page=3&schoolhelp=<?php echo $schoolhelp; ?>&id=<?php echo $fieldrecord['domainnameid']; ?>"><i class="fa fa-edit"></i> Edit</a></div>
                          <?php  } ?>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
                <?php
               } 
              } 
            }?>
              </div>
            </div>
       <?php include("includes/footer.php"); ?>