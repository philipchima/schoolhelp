
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHresultinserts.php");
include_once("../phpclass/schoolhelpothers.php");

include_once("../phpclass/SHresultOOP.php");
include_once("../phpclass/SHresultupdate.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Result Sample";

$odate=date("Y-m-d");

$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

$SHResultOOP=new classResult;
$tableUpdate= new updateTable;
 //$tableUpdate= new updateTable;
$pageaccess="";
$previlleges=$SHResultOOP->allresultedit('adminpersons', 'adminid', $schoolhelp);
if (is_array($previlleges)) {

foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['resultsample_r']);
  $admintype=trim($actualrecord['admintype']);
  $resultedit_r=trim($actualrecord['resultedit_r']);
  $resultadd_r=trim($actualrecord['resultadd_r']);
  $resultdelete_r=trim($actualrecord['resultdelete_r']);
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

$signatorydata=$SHResultOOP->allresultedit('signatoryposition', 'signatorypositionid', $signatorypositionid);
if (is_array($signatorydata)) {
  foreach($signatorydata as $signatoryrec){
  $logindepartmentid=$signatoryrec['departmentid'];
  
  }
}
}

if($page==2) {
  
if ($resultadd_r==1) {
   
$departmentid=trim(isset($_POST['departmentid'])?$_POST['departmentid']:false);
$resultsample=trim(isset($_POST['resultsample'])?$_POST['resultsample']:false);

$udate=date("Y-m-d H:m:s");

$insertedrow=0;
$tbltermdetails=new insertTable;
$state=$tbltermdetails->insert_resultsample($departmentid, $resultsample, $schoolhelp, $odate);
$display=$state['action'];
$insertedrow+=$state['counting'];

$sql=$display.":: Insertion, affected records =".$insertedrow;

}

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}

if($page==4) {

  if ($resultedit_r==1) {

$resultsampleid=trim(isset($_POST['resultsampleid'])?$_POST['resultsampleid']:false);
$departmentid=trim(isset($_POST['departmentid'])?$_POST['departmentid']:false);
$resultsample=trim(isset($_POST['resultsample'])?$_POST['resultsample']:false);

$udate=date("Y-m-d H:m:s");

$state= $tableUpdate->update_resultsample($departmentid, $resultsample, $schoolhelp, $resultsampleid);

$sql=$state.":: Update Made, affected records = 1";
}

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}


if ($page==6) {

if ($resultdelete_r==1) {
  
   $resultsampleid=trim(isset($_GET['id'])?$_GET['id']:false);
   
    $state=$tableUpdate->delete_result('resultsample', 'resultsampleid', $resultsampleid);

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

                      <li><a class="btn btn-success" href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home">Result Dashboard</i></a>
                        
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Action</a>
                        <ul class="dropdown-menu" role="menu">
                          <?php if($resultedit_r==1) { ?>
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
                          <th>Photo</th>
                          <th>Department</th>
                          <th>Result Name</th>
                         
                          
                   
                        
                          <?php if ($resultedit_r==1) { ?>
                          <th ><i class="fa fa-edit" style="color:yellow"></i> Edit</th>
                          <?php } if ($resultdelete_r==1) { ?>
                          <th><i class="fa fa-trash" style="color:red"></i> Delete</th>
                          <?php } ?>
                          <th >User<i class="fa fa-user"></i></th>
                          
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                             
                              $records=$SHResultOOP->allresult('resultsample', 'resultsampleid', 'DESC');
                              if (is_array($records)) {

                              foreach($records as $fieldrecord){
                                $qualificationname="";
                                $adminsurname="";
                                 $adminothername="";
                                 $statename="";
                                 $deptname="";
                              
                              $fieldvalue=trim($fieldrecord['operatorid']);
                                $deptid=trim($fieldrecord['departmentid']);
                                 
                                                          
                                $admindata=$SHResultOOP->allresultedit('adminpersons', 'adminid',  $fieldvalue);
                                 if(is_array($admindata)){
                                    foreach($admindata as $adminrecord){
                                      $adminsurname=$adminrecord['surname'];
                                      $adminothername=$adminrecord['othername'];
                                      $logintime=$adminrecord['logintime'];
                                      $logouttime=$adminrecord['logouttime'];
                                    }

                                  }

                                  $deptdata=$SHResultOOP->allresultedit('department', 'did', $deptid);
                                 if(is_array($deptdata)){
                                    foreach($deptdata as $deptrecord){
                                      $deptname=$deptrecord['deptname'];
                                      
                                    }

                                  }
                                
                                 
                                         $k+=1;
                                ?>
                                      <tr>
                                        <td><?php echo  $k; ?></td>
                                         <td style="width:20%"><img src="../images/resultsample/<?php echo  trim($fieldrecord['resultname']).'.png'; ?>" class="img img-responsive img-rounded"/></td>
                                          <td align="center"><?php  echo $deptname; ?></td>
                                          <td align="center" ><?php echo $fieldrecord['resultname']; ?></td>
                                                                                     
                                       
                                         <?php if ($resultedit_r==1) { ?>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['resultsampleid']; ?>')"><center><i class="fa fa-edit" style="color:yellow; font-size:2em"></i></center></button></td>
                                        <?php } ?>
                                        <?php if ($resultdelete_r==1) { ?>
                                         <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['resultsampleid']; ?>','')"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
                                         <?php } ?>
                                        
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
                                     

                                      </tr>
                                      
                                    

                                      
                             <?php 
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
                          <select  id="departmentid" required="required" name="departmentid" class="form-control col-md-7 col-xs-12" onchange="return updatevalidity('resultsample', 'departmentid', this.value, 'inserting', $(this).attr('id'));">
                            <option value="">--Select Department--</option>
                            <?php
                            $deptrecord=$SHResultOOP->allresult('department','did','asc');
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
                        <label for="surname" class="control-label col-md-3 col-sm-3 col-xs-12">Select Result Sample<span class="required">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">

                          <div class="row">
                            <div class="col-lg-6">
                                <center>
                                <img src="../images/resultsample/resultnew1.png" class="img img-responsive img-thumbnail" alt="1st Result"/>
                                 <input type="radio" name="resultsample" class="form-control" value="resultnew1" />
                            </center>
                            </div>
                            <div class="col-lg-6">
                                    <center>
                                <img src="../images/resultsample/resultnew2.png" class="img img-responsive img-thumbnail" alt="@2ND Result" />
                                <br>
                                <input type="radio" name="resultsample" class="form-control" value="resultnew2" />
                            </center>
                            </div>
                              <div class="col-lg-6">
                                    <center>
                                <img src="../images/resultsample/resultnew3.png" class="img img-responsive img-thumbnail" alt="3rd Result" />
                                <br>
                                <input type="radio" name="resultsample" class="form-control" value="resultnew3" />
                            </center>
                            </div>
                            
                        </div>
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
                    $resultsampleid=trim(isset($_GET['id'])?$_GET['id']:false);

                    
                    $record=$SHResultOOP->allresultedit('resultsample', 'resultsampleid', $resultsampleid);
                    if(is_array($record)){
                      foreach($record as $records){
                        
                    ?>
                      <div class="x_panel" style="width: 100%">
                      <fieldset>
                        <legend style="color:#063">Edit <?php echo $pagename; ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="formstid"  class="form-horizontal form-label-left" >
                     <input type="hidden" name="resultsampleid" id="resultsampleid" value="<?php echo $resultsampleid; ?>">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Select Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, element to append result, fieldid that will appear in the selection, fieldname that will appear in the selection)-->
                          <select  id="departmentid" required="required" name="departmentid" class="form-control col-md-7 col-xs-12" onchange="return updatevalidity('resultsample', 'departmentid', this.value, 'updating', $(this).attr('id'));">
                            <option value="">--Select Department--</option>
                            <?php
                            $deptrecord=$SHResultOOP->allresult('department','did','asc');
                            foreach($deptrecord as $deptdata){
                              if($admintype==0){
                                if($logindepartmentid==trim($deptdata['did'])){
                            ?>
                            <option value="<?php echo $deptdata['did']; ?>" <?php if ($records['departmentid']==$deptdata['did']){ ?> selected="selected" <?php } ?>><?php echo $deptdata['deptname']; ?></option>
                            <?php }
                              }else{
                            ?>
                            <option value="<?php echo $deptdata['did']; ?>" <?php if ($records['departmentid']==$deptdata['did']){ ?> selected="selected" <?php } ?>><?php echo $deptdata['deptname']; ?></option>
                            <?php }
                             } ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="surname" class="control-label col-md-3 col-sm-3 col-xs-12">Select Result Sample<span class="required">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">

                          <div class="row">
                            <div class="col-lg-6">
                                <center>
                                <img src="../images/resultsample/resultnew1.png" class="img img-responsive img-thumbnail" alt="1st Result"/>
                                 <input type="radio" name="resultsample" class="form-control" value="resultnew1" <?php if ($records['resultname']=="resultnew1"){ ?> checked="checked" <?php } ?> />
                            </center>
                            </div>
                            <div class="col-lg-6">
                                    <center>
                                <img src="../images/resultsample/resultnew2.png" class="img img-responsive img-thumbnail" alt="2ND Result" />
                                <br>
                                <input type="radio" name="resultsample" class="form-control" value="resultnew2" <?php if ($records['resultname']=="resultnew2"){ ?> checked="checked" <?php } ?> />
                            </center>
                            </div>
                                                         
                        </div>

                        <div class="row">
                           <div class="col-lg-6">
                                    <center>
                                <img src="../images/resultsample/resultnew3.png" class="img img-responsive img-thumbnail" alt="3RD Result" />
                                <br>
                                <input type="radio" name="resultsample" class="form-control" value="resultnew3" <?php if ($records['resultname']=="resultnew3"){ ?> checked="checked" <?php } ?> />
                            </center>
                            </div>
                        </div>

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