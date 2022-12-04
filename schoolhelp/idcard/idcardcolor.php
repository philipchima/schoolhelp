
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHidcardinserts.php");
include_once("../phpclass/schoolhelpothers.php");

include_once("../phpclass/SHidcardOOP.php");
include_once("../phpclass/SHidcardupdate.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="ID Card Color";

$odate=date("Y-m-d");


$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);


$schoolhelpID=new classIdcard;
$tableUpdate= new updateTable;
 //$tableUpdate= new updateTable;

$previlleges=$schoolhelpID->allidcardedit('adminpersons', 'adminid', $schoolhelp);
if (is_array($previlleges)) {

foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['guardian_d']);
  $admintype=trim($actualrecord['admintype']);
  $dashedit_d=trim($actualrecord['dashedit_d']);
  $dashadd_d=trim($actualrecord['dashadd_d']);
  $dashdelete_d=trim($actualrecord['dashdelete_d']);
  $signatorypositionid=trim($actualrecord['signatorypositionid']);
}
  
}

if ($pageaccess!=1) {
  echo "<b style='font-size:100; color:red'>Criminal Attempt Made, contact the admin ask for the access of this page</b>";
  exit();
}

//This script is to determine the actual admin that is logging whether a super admin or a position holder in a school
if ($admintype==1) {
  $logindepartmentid='';
}
else{

$signatorydata=$schoolhelpID->allidcardedit('signatoryposition', 'signatorypositionid', $signatorypositionid);
if (is_array($signatorydata)) {
  foreach($signatorydata as $signatoryrec){
  $logindepartmentid=$signatoryrec['departmentid'];
  
  }
}
}

if($page==2) {
  
  if ($dashadd_d==1) {
   
$departmentid=trim(isset($_POST['departmentid'])?$_POST['departmentid']:false);
$deptname=trim(isset($_POST['deptname'])?$_POST['deptname']:false);
$deptaddress=trim(isset($_POST['deptaddress'])?$_POST['deptaddress']:false);
 
$labelcolor=trim(isset($_POST['labelcolor'])?$_POST['labelcolor']:false);

 $detailcolor=trim(isset($_POST['detailcolor'])?$_POST['detailcolor']:false);
$headbgcolor=trim(isset($_POST['headbgcolor'])?$_POST['headbgcolor']:false);
$contentbgcolor1=trim(isset($_POST['contentbgcolor1'])?$_POST['contentbgcolor1']:false);
$contentbgcolor2=trim(isset($_POST['contentbgcolor2'])?$_POST['contentbgcolor2']:false);

$backgroundtype=trim(isset($_POST['backgroundtype'])?$_POST['backgroundtype']:false);
     

$udate=date("Y-m-d H:m:s");

$insertedrow=0;
$tableidcard=new insertTable;
$state=$tableidcard->insert_idcard($departmentid, $deptname, $deptaddress,  $labelcolor, $detailcolor, $headbgcolor, $contentbgcolor1, $contentbgcolor2, $backgroundtype, $schoolhelp,  $odate);
$display=$state['action'];
$insertedrow+=$state['counting'];

$sql=$display.":: Insertion, affected records =".$insertedrow;

}

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}

if($page==4) {

  if ($dashedit_d==1) {

$colorid=trim(isset($_POST['colorid'])?$_POST['colorid']:false);
$departmentid=trim(isset($_POST['departmentid'])?$_POST['departmentid']:false);
$deptname=trim(isset($_POST['deptname'])?$_POST['deptname']:false);
$deptaddress=trim(isset($_POST['deptaddress'])?$_POST['deptaddress']:false);
 
$labelcolor=trim(isset($_POST['labelcolor'])?$_POST['labelcolor']:false);

 $detailcolor=trim(isset($_POST['detailcolor'])?$_POST['detailcolor']:false);
$headbgcolor=trim(isset($_POST['headbgcolor'])?$_POST['headbgcolor']:false);
$contentbgcolor1=trim(isset($_POST['contentbgcolor1'])?$_POST['contentbgcolor1']:false);
$contentbgcolor2=trim(isset($_POST['contentbgcolor2'])?$_POST['contentbgcolor2']:false);
$backgroundtype=trim(isset($_POST['backgroundtype'])?$_POST['backgroundtype']:false);

$udate=date("Y-m-d H:m:s");

$state= $tableUpdate->update_idcard($departmentid, $deptname, $deptaddress,  $labelcolor, $detailcolor, $headbgcolor, $contentbgcolor1, $contentbgcolor2, $backgroundtype, $schoolhelp, $colorid);

$sql=$state.":: Update Made, affected records = 1";
}

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}


if ($page==6) {

if ($dashdelete_d==1) {
  
   $colorid=trim(isset($_GET['id'])?$_GET['id']:false);
   $passport=trim(isset($_GET['passport'])?$_GET['passport']:false);
  
    $state=$tableUpdate->delete_idcard('idcardcolor', 'colorid', $colorid);

        $sql=$state.":: Deletion Made, affected records = 1";
         
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
                    <h4 id="caption" style="float:left;"><?php echo $pagename; ?></h4>
                    
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="btn btn-primary" href="../index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>

                      <li><a class="btn btn-success" href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home">ID Card Dashboard</i></a>
                        
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Action</a>
                        <ul class="dropdown-menu" role="menu">
                          <?php if($dashedit_d==1) { ?>
                        <li><a href="?schoolhelp=<?php echo $schoolhelp; ?>&page=1"  ><i class="fa fa-plus"></i>  Add <?php echo $pagename; ?></a></li>
                       
                        <?php } ?>
                        <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> View <?php echo $pagename; ?></a></li>
                        
                        </ul>
                      </li>
                    </li>
                    </ul>

                    <div class="clearfix"></div>
                  </div>

                  <div style="color:#063"  ><b><?php echo $sql; ?></b></div>

                  
                    <?php if ($page=="") {?>
                      <div class="x_panel ">
                         <fieldset>
                        <legend style="color:#063"><?php echo $pagename; ?> Record</legend>
                    <table id="datatable-buttons"  class="table table-striped table-bordered table-responsive" style="width: 100%">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Department</th>
                          <th>Title</th>
                          <th>Address</th>
                          <th>Label</th>
                          <th>Details</th>
                          
                          <th>Head Background</th>
                        <th>Color One</th>
                        
                          <th>Color One</th>
                      <?php if ($dashedit_d==1) { ?>
                         <th >Action<i class="fa fa-cog"></i></th>
                         <?php } ?>
                        
                          <?php if ($dashedit_d==1) { ?>
                          <th ><i class="fa fa-edit" style="color:yellow"></i> Edit</th>
                          <?php } if ($dashdelete_d==1) { ?>
                          <th><i class="fa fa-trash" style="color:red"></i> Delete</th>
                          <?php } ?>
                          <th >User<i class="fa fa-user"></i></th>
                          
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                             
                              $records=$schoolhelpID->allidcard('idcardcolor', 'colorid', 'DESC');
                              if (is_array($records)) {

                              foreach($records as $fieldrecord){
                                $qualificationname="";
                                $adminsurname="";
                             $adminothername="";
                             $statename="";
                             $deptname="";
                              
                                $fieldvalue=trim($fieldrecord['operatorid']);
                                $deptid=trim($fieldrecord['departmentid']);
                                 
                                                          
                                $admindata=$schoolhelpID->allidcardedit('adminpersons', 'adminid',  $fieldvalue);
                                 if(is_array($admindata)){
                                    foreach($admindata as $adminrecord){
                                      $adminsurname=$adminrecord['surname'];
                                      $adminothername=$adminrecord['othername'];
                                      $logintime=$adminrecord['logintime'];
                                      $logouttime=$adminrecord['logouttime'];
                                    }

                                  }

                                  $deptdata=$schoolhelpID->allidcardedit('department', 'did',  $deptid);
                                 if(is_array($deptdata)){
                                    foreach($deptdata as $deptrecord){
                                      $deptname=$deptrecord['deptname'];
                                      
                                    }

                                  }
                                  if ($admintype==0) {
                                 
                                       if ($deptid==$logindepartmentid) {
                                         $k+=1;
                                ?>
                                      <tr>
                                        <td><?php echo  $k; ?></td>
                                          <td align="center"><?php  echo ucfirst($deptname)?></td>
                                          <td align="left" bgcolor="<?php  echo $fieldrecord['schname']?>"><?php  echo $fieldrecord['schname']?></td>
                                          <td align="center" bgcolor="<?php  echo $fieldrecord['schaddress']?>"><?php  echo $fieldrecord['schaddress']?></td>
                                          <td align="center" bgcolor="<?php  echo $fieldrecord['htitlelabel']?>"><?php  echo $fieldrecord['htitlelabel']?></td>
                                          <td align="center" bgcolor="<?php  echo $fieldrecord['htitle']?>"><?php  echo $fieldrecord['htitle']?></td>
                                          <td align="center" bgcolor="<?php echo $fieldrecord['tableheadbgcolor'] ;?>"><?php echo $fieldrecord['tableheadbgcolor'] ;?></td>
                                          <td align="center" bgcolor="<?php  echo $fieldrecord['tablecontentcolor1'];?>"><?php  echo $fieldrecord['tablecontentcolor1']?></td>
                                          <td align="center" bgcolor="<?php echo $fieldrecord['tablecontentcolor2'] ;?>"><?php echo $fieldrecord['tablecontentcolor2'] ;?></td>
                                          <td align="center" ><?php if($fieldrecord['idcardbackground']==1){ echo "School Logo"; }elseif($fieldrecord['idcardbackground']==2){ echo "School Name";}else{ echo "Empty"; }?></td>
                                                         
                                       
                                         <?php if ($dashedit_d==1) { ?>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['colorid']; ?>')"><center><i class="fa fa-edit" style="color:yellow; font-size:2em"></i></center></button></td>
                                        <?php } ?>
                                        <?php if ($dashdelete_d==1) { ?>
                                         <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['colorid']; ?>','')"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
                                         <?php } ?>
                                         <?php if ($dashedit_d==1) { ?>
                                           <td ><span class="btn-group">
                                            <center><button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-user"></i> Details<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu">
                                            <li ><span>Update by</span> : <?php echo  $adminsurname. " ".$adminothername ; ?></li>
                                            <li><span>Upate Date</span> : <?php echo  $fieldrecord['udate']; ?></li>
                                            <li><span>Initial Date</span> : <?php echo $fieldrecord['odate']; ?></li>
                                            <li class="schoolhelp"><b>Login Status</b></li>
                                            <li><span>login Date</span> : <?php echo  $logintime; ?></li>
                                            <li><span>logout Date</span> : <?php echo  $logouttime; ?></li>
                                          </ul>
                                          </center></span>

                                        </td>
                                        <?php } ?>

                                      </tr>
                                      <?php  }
                                     } else{ $k+=1; ?>
                                     <tr>
                                        <td><?php echo  $k; ?></td>
                                          <td align="center"><?php  echo ucfirst($deptname)?></td>
                                          <td align="left" bgcolor="<?php  echo $fieldrecord['schname']?>"><?php  echo $fieldrecord['schname']?></td>
                                          <td align="center" bgcolor="<?php  echo $fieldrecord['schaddress']?>"><?php  echo $fieldrecord['schaddress']?></td>
                                          <td align="center" bgcolor="<?php  echo $fieldrecord['htitlelabel']?>"><?php  echo $fieldrecord['htitlelabel']?></td>
                                          <td align="center" bgcolor="<?php  echo $fieldrecord['htitle']?>"><?php  echo $fieldrecord['htitle']?></td>
                                          <td align="center" bgcolor="<?php echo $fieldrecord['tableheadbgcolor'] ;?>"><?php echo $fieldrecord['tableheadbgcolor'] ;?></td>
                                          <td align="center" bgcolor="<?php  echo $fieldrecord['tablecontentcolor1'];?>"><?php  echo $fieldrecord['tablecontentcolor1']?></td>
                                          <td align="center" bgcolor="<?php echo $fieldrecord['tablecontentcolor2'] ;?>"><?php echo $fieldrecord['tablecontentcolor2'] ;?></td>
                                          <td align="center" ><?php if($fieldrecord['idcardbackground']==1){ echo "School Logo"; }elseif($fieldrecord['idcardbackground']==2){ echo "School Name";}else{ echo "Empty"; }?></td>
                                                         
                                       
                                         <?php if ($dashedit_d==1) { ?>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['colorid']; ?>')"><center><i class="fa fa-edit" style="color:yellow; font-size:2em"></i></center></button></td>
                                        <?php } ?>
                                        <?php if ($dashdelete_d==1) { ?>
                                         <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['colorid']; ?>','')"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
                                         <?php } ?>
                                         <?php if ($dashedit_d==1) { ?>
                                           <td ><span class="btn-group">
                                            <center><button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-user"></i> Details<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu">
                                            <li ><span>Update by</span> : <?php echo  $adminsurname. " ".$adminothername ; ?></li>
                                            <li><span>Upate Date</span> : <?php echo  $fieldrecord['udate']; ?></li>
                                            <li><span>Initial Date</span> : <?php echo $fieldrecord['odate']; ?></li>
                                            <li class="schoolhelp"><b>Login Status</b></li>
                                            
                                            <li><span>login Date</span> : <?php echo  $logintime; ?></li>
                                            <li><span>logout Date</span> : <?php echo  $logouttime; ?></li>
                                          </ul>
                                          </center></span>

                                        </td>
                                        <?php } ?>

                                      </tr>
                             <?php }
                                 }
                              }
                             ?>
                        
                      </tbody>
                    </table>
                   </fieldset>
                    </div>
                    <?php } ?>

                    <?php if($page==1) { 

                      ?>
                    <div class="x_panel" style="width: 100%">
                      <fieldset>
                        <legend style="color:#063">Add <?php echo $pagename; ?></legend>
                  <form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="formstid"  class="form-horizontal form-label-left" >
                   
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Select Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, element to append result, fieldid that will appear in the selection, fieldname that will appear in the selection)-->
                          <select  id="departmentid" required="required" name="departmentid" class="form-control col-md-7 col-xs-12" onblur="return updatevalidity('idcardcolor', 'departmentid', this.value, 'inserting', $(this).attr('id'));">
                            <option value="">--Select Department--</option>
                            <?php
                            $deptrecord=$schoolhelpID->allidcard('department','did','asc');
                            foreach($deptrecord as $deptdata){
                              if($admintype==0){
                                if($logindepartmentid==trim($deptdata['did'])){
                            ?>
                            <option value="<?php echo $deptdata['did']; ?>"><?php echo $deptdata['deptname']; ?></option>
                            <?php }
                              }else{
                            ?>
                            <option value="<?php echo $deptdata['did']; ?>"><?php echo $deptdata['deptname']; ?></option>
                            <?php }
                             } ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="surname" class="control-label col-md-3 col-sm-3 col-xs-12">Department Name<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                          <input name="deptname" id="deptname" class="form-control col-md-7 col-xs-12" type="color" required="required">
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="otherrname" class="control-label col-md-3 col-sm-3 col-xs-12">Department Address<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="deptaddress" id="deptaddress" class="form-control col-md-7 col-xs-12" type="color"  required="required">
                        </div>
                      </div>

                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Label Color<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="color" name="labelcolor" id="labelcolor" class="form-control col-md-7 col-xs-12"   required="required">
                        </div>
                      </div>
                    

                       
                       <div class="form-group">
                        <label for="otherrname" class="control-label col-md-3 col-sm-3 col-xs-12">Detail Color<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="detailcolor" id="detailcolor" class="form-control col-md-7 col-xs-12" type="color"  required="required">
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Head Background Color<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="headbgcolor" id="headbgcolor" class="form-control col-md-7 col-xs-12" type="color"  required="required">
                        </div>
                      </div>

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Content Background Color<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="contentbgcolor1" id="contentbgcolor1" class="form-control col-md-7 col-xs-12" type="color"  required="required">
                        </div>
                      </div>

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Content Background Color One<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="contentbgcolor2" id="contentbgcolor2" class="form-control col-md-7 col-xs-12" type="color"  required="required">
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Background Type<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <select name="backgroundtype" class="form-control"  required>
                                      <option value="" selected>--Select result background--</option>
                                            
                                      <option value="1" >Use School's logo</option>
                                      <option value="2" >Use School Name</option>
                                      
                                    </select>
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

                  <?php if($page==3) {
                    $colorid=trim(isset($_GET['id'])?$_GET['id']:false);

                    
                    $record=$schoolhelpID->allidcardedit('idcardcolor', 'colorid',  $colorid);
                    if(is_array($record)){
                      foreach($record as $records){
                        $departmentid=$records['departmentid'];
                    ?>
                      <div class="x_panel" style="width: 100%">
                      <fieldset>
                        <legend style="color:#063">Edit <?php echo $pagename; ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="formstid"  class="form-horizontal form-label-left" >
                     <input type="hidden" name="colorid" id="colorid" value="<?php echo $colorid; ?>">
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Select Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, element to append result, fieldid that will appear in the selection, fieldname that will appear in the selection)-->
                          <select  id="departmentid" required="required" name="departmentid" class="form-control col-md-7 col-xs-12" onblur="return updatevalidity('idcardcolor', 'departmentid', this.value, 'updating', $(this).attr('id'));">
                            <option value="">--Select Department--</option>
                            <?php
                            $deptrecord=$schoolhelpID->allidcard('department','did','asc');
                            foreach($deptrecord as $deptdata){
                              if($admintype==0){
                                if($logindepartmentid==trim($deptdata['did'])){
                            ?>
                            <option value="<?php echo $deptdata['did']; ?>" <?php if ($departmentid==trim($deptdata['did'])) {?> selected <?php }?> ><?php echo $deptdata['deptname']; ?></option>
                            <?php }
                              }else{
                            ?>
                            <option value="<?php echo $deptdata['did']; ?>"  <?php if ($departmentid==trim($deptdata['did'])) {?> selected <?php }?>><?php echo $deptdata['deptname']; ?></option>
                            <?php }
                             } ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="surname" class="control-label col-md-3 col-sm-3 col-xs-12">Department Name<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                          <input name="deptname" id="deptname" class="form-control col-md-7 col-xs-12" type="color" required="required" value="<?php echo $records['schname'] ?>">
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="otherrname" class="control-label col-md-3 col-sm-3 col-xs-12">Department Address<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="deptaddress" id="deptaddress" class="form-control col-md-7 col-xs-12" type="color"  required="required" value="<?php echo $records['schaddress'] ?>">
                        </div>
                      </div>

                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Label Color<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="color" name="labelcolor" id="labelcolor" class="form-control col-md-7 col-xs-12" required="required" value="<?php echo $records['htitlelabel'] ?>">
                        </div>
                      </div>
                    

                       
                       <div class="form-group">
                        <label for="otherrname" class="control-label col-md-3 col-sm-3 col-xs-12">Detail Color<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="detailcolor" id="detailcolor" class="form-control col-md-7 col-xs-12" type="color"  required="required" value="<?php echo $records['htitle'] ?>">
                        </div>
                      </div>


                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Head Background Color<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="headbgcolor" id="headbgcolor" class="form-control col-md-7 col-xs-12" type="color"  required="required" value="<?php echo $records['tableheadbgcolor'] ?>">
                        </div>
                      </div>

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Content Background Color<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="contentbgcolor1" id="contentbgcolor1" class="form-control col-md-7 col-xs-12" type="color"  required="required" value="<?php echo $records['tablecontentcolor1'] ?>">
                        </div>
                      </div>

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Content Background Color One<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="contentbgcolor2" id="contentbgcolor2" class="form-control col-md-7 col-xs-12" type="color"  required="required" value="<?php echo $records['tablecontentcolor2'] ?>" >
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Background Type<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <select name="backgroundtype" class="form-control"  required>
                                      <option value="" selected>--Select result background--</option>
                                            
                                      <option value="1" <?php if ($records['idcardbackground']==1) {?> selected <?php } ?>>Use School's logo</option>
                                      <option value="2" <?php if ($records['idcardbackground']==2) {?> selected <?php } ?>>Use School Name</option>
                                      
                                    </select>
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
              }else{ echo "Manipulation is wrought!";}

              } ?>

               
              </div>
            </div>
            
<!--Webcamp-->
       <?php include("includes/footer.php"); ?>