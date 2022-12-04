
<?php 
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHresultinserts.php");
include_once("../phpclass/schoolhelpothers.php");

include_once("../phpclass/SHresultOOP.php");
include_once("../phpclass/SHresultupdate.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Setup Comment";

$odate=date("Y-m-d");


$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);


$schoolhelpID=new classResult;
$tableUpdate= new updateTable;
 //$tableUpdate= new updateTable;

$previlleges=$schoolhelpID->allresultedit('adminpersons', 'adminid', $schoolhelp);
if (is_array($previlleges)) {

foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['addcomment_r']);
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

$signatorydata=$schoolhelpID->allresultedit('signatoryposition', 'signatorypositionid', $signatorypositionid);
if (is_array($signatorydata)) {
  foreach($signatorydata as $signatoryrec){
  $logindepartmentid=$signatoryrec['departmentid'];
  
  }
}
}

if($page==2) {
  
  if ($resultadd_r==1) {
   
$departmentid=trim(isset($_POST['departmentid'])?$_POST['departmentid']:false);
$commenttype=trim(isset($_POST['commenttype'])?$_POST['commenttype']:false);
$comment=trim(isset($_POST['comment'])?$_POST['comment']:false);    

$udate=date("Y-m-d H:m:s");

$insertedrow=0;
$tableresultcolor=new insertTable;
$state=$tableresultcolor->insert_commentsetup($departmentid, $commenttype, $comment, $schoolhelp, $odate);
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

  $resultcommentid=trim(isset($_POST['resultcommentid'])?$_POST['resultcommentid']:false);
  $departmentid=trim(isset($_POST['departmentid'])?$_POST['departmentid']:false);
  $commenttype=trim(isset($_POST['commenttype'])?$_POST['commenttype']:false);
  $comment=trim(isset($_POST['comment'])?$_POST['comment']:false);    

$udate=date("Y-m-d H:m:s");

$state= $tableUpdate->update_commentsetup($departmentid, $commenttype, $comment, $schoolhelp, $resultcommentid);

$sql=$state.":: Update Made, affected records = 1";
}


echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}


if ($page==6) {

if ($resultdelete_r==1) {
  
   $resultcommentid=trim(isset($_GET['id'])?$_GET['id']:false);
   $passport=trim(isset($_GET['passport'])?$_GET['passport']:false);
  
    $state=$tableUpdate->delete_result('commentsetup', 'resultcommentid', $resultcommentid);

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
                          <th>Department</th>
                          <th>Comment Type</th>
                          <th>Comment</th>
                        
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
                              $records=$schoolhelpID->allresult('commentsetup', 'resultcommentid', 'DESC');
                              if (is_array($records)) {

                              foreach($records as $fieldrecord){
                                $qualificationname="";
                                $adminsurname="";
                                $adminothername="";
                                $statename="";
                                $deptname="";
                              
                                $fieldvalue=trim($fieldrecord['operatorid']);
                                $deptid=trim($fieldrecord['departmentid']);
                                 
                                                          
                                $admindata=$schoolhelpID->allresultedit('adminpersons', 'adminid',  $fieldvalue);
                                 if(is_array($admindata)){
                                    foreach($admindata as $adminrecord){
                                      $adminsurname=$adminrecord['surname'];
                                      $adminothername=$adminrecord['othername'];
                                      $logintime=$adminrecord['logintime'];
                                      $logouttime=$adminrecord['logouttime'];
                                    }

                                  }

                                  $deptdata=$schoolhelpID->allresultedit('department', 'did', $deptid);
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
                                          
                                          <td align="center" ><?php if($fieldrecord['commenttype']==0){ echo "Form Teacher/Course Advisers "; }else{ echo "HOD/Principal"; }?></td>
                                          <td align="center"><?php  echo substr($fieldrecord['comment'],0, 12); ?></td>    
                                       
                                         <?php if ($resultedit_r==1) { ?>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>', '<?php echo $fieldrecord['resultcommentid']; ?>')"><center><i class="fa fa-edit" style="color:yellow; font-size:2em"></i></center></button></td>
                                        <?php } ?>
                                        <?php if ($resultdelete_r==1) { ?>
                                         <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>', '<?php echo $fieldrecord['resultcommentid']; ?>', '')"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
                                         <?php } ?>
                                         <?php if ($resultedit_r==1) { ?>
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
                                          
                                          <td align="center" ><?php if($fieldrecord['commenttype']==0){ echo "Form Teacher/Course Advisers "; }else{ echo "HOD/Principal"; }?></td>
                                          <td align="center"><?php  echo substr($fieldrecord['comment'],0, 12); ?></td>    
                                                         
                                       
                                         <?php if ($resultedit_r==1) { ?>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['resultcommentid']; ?>')"><center><i class="fa fa-edit" style="color:yellow; font-size:2em"></i></center></button></td>
                                        <?php } ?>
                                        <?php if ($resultdelete_r==1) { ?>
                                         <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['resultcommentid']; ?>','')"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
                                         <?php } ?>
                                         <?php if ($resultedit_r==1) { ?>
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, element to append result, fieldid that will appear in the selection, fieldname that will appear in the selection)-->
                          <select  id="departmentid" required="required" name="departmentid" class="form-control col-md-7 col-xs-12" >
                            <option value="">--Select Department--</option>
                            <?php
                            $deptrecord=$schoolhelpID->allresult('department','did',$deptid);
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
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Comment Type<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <select name="commenttype" class="form-control" class="form-control col-md-6 col-xs-12" required>
                                      <option value="">--Select Comment Type--</option>
                                            
                                      <option value="0">Form Teacher/Course Adviser</option>
                                      <option value="1" >HOD/Principal</option>
                                      
                                    </select>
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="otherrname" class="control-label col-md-3 col-sm-3 col-xs-12">Comment<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="comment" id="comment" class="form-control col-md-7 col-xs-12" required="required"></textarea>
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
                    $resultcommentid=trim(isset($_GET['id'])?$_GET['id']:false);

                    
                    $record=$schoolhelpID->allresultedit('commentsetup', 'resultcommentid', $resultcommentid);
                    if(is_array($record)){
                      foreach($record as $records){
                        $resultcommentid=trim($records['resultcommentid']);
                    ?>
                      <div class="x_panel" style="width: 100%">
                      <fieldset>
                        <legend style="color:#063">Edit <?php echo $pagename; ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="formstid"  class="form-horizontal form-label-left" >
                     <input type="hidden" name="resultcommentid" id="resultcommentid" value="<?php echo $resultcommentid; ?>">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Department<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, element to append result, fieldid that will appear in the selection, fieldname that will appear in the selection)-->
                          <select  id="departmentid" required="required" name="departmentid" class="form-control col-md-7 col-xs-12" >
                            <option value="">--Select Department--</option>
                            <?php
                            $deptrecord=$schoolhelpID->allresult('department','did','asc');
                            foreach($deptrecord as $deptdata){
                              if($admintype==0){
                                if($logindepartmentid==trim($deptdata['did'])){
                            ?>
                            <option value="<?php echo $deptdata['did']; ?>" <?php if ($records['departmentid']==$deptdata['did']){ ?> selected="selected" <?php } ?> ><?php echo $deptdata['deptname']; ?></option>
                            <?php }
                              }else{
                            ?>
                            <option value="<?php echo $deptdata['did']; ?>" <?php if ($records['departmentid']==$deptdata['did']){ ?> selected="selected" <?php } ?> ><?php echo $deptdata['deptname']; ?></option>
                            <?php }
                             } ?>
                          </select>
                        </div>
                      </div>

                     <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Comment Type<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <select name="commenttype" class="form-control" class="form-control col-md-6 col-xs-12" required>
                                      <option value="">--Select Comment Type--</option>
                                            
                                      <option value="0" <?php if ($records['commenttype']==0){ ?> selected="selected" <?php } ?> >Form Teacher/Course Adviser</option>
                                      <option value="1" <?php if ($records['commenttype']==1){ ?> selected="selected" <?php } ?> >HOD/Principal</option>
                                      
                                    </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="otherrname" class="control-label col-md-3 col-sm-3 col-xs-12">Comment<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="comment" id="comment" class="form-control col-md-7 col-xs-12" required="required"><?php echo $records['comment']; ?></textarea>
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