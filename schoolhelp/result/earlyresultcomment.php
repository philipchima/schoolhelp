<?php
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHresultOOP.php");
include_once("../phpclass/SHresultupdate.php");
include_once("../phpclass/SHresultinserts.php");
confirmcheckin();
$SHResultOOP=new ClassResult;
$tabledomainupdate=new updateTable;
$tabledomain=new insertTable;

$pagename="Comment Result";

$odate=date("Y-m-d");
$udate=date("Y-m-d H:i:s");

// Checking page access Authenticity


$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp=trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$page=trim(isset($_GET['page'])?$_GET['page']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

$previlleges=$SHResultOOP->allresultedit('adminpersons', 'adminid', $schoolhelp);
if ($previlleges) {
  
foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['earlyscore_r']);
  $resultadd_r=trim($actualrecord['resultadd_r']);
  
}

}

if ($pageaccess!=1) {
  echo "<b style='font-size:100; color:red'>Criminal Attempt Made, contact the admin ask for the access of this page</b>";
  exit();
}

//This script is to determine the actual admin that is logging whether a super admin or a position holder in a school
$admindata=$SHResultOOP->allresultedit('adminpersons', 'adminid', $schoolhelp);
if (is_array($admindata)) {
  foreach($admindata as $adminrec){
   $admintype= $adminrec['admintype'];
   $signatorypositionid= $adminrec['signatorypositionid'];
  }
}

if ($admintype==1) {
  $departmentid='';
}
else{

$signatorydata=$SHResultOOP->allresultedit('signatoryposition', 'signatorypositionid', $signatorypositionid);
if (is_array($signatorydata)) {
  foreach($signatorydata as $signatoryrec){
   $departmentid=$signatoryrec['departmentid'];
  }
}

}


if ($page==1) {

    $sessionid=trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);
    $semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
    $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
    $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);
    


      // Getting the Department ID
                           
        $leveldata=$SHResultOOP->allresultedit('level', 'levelid', $levelid);
          if (is_array($leveldata)) {
            foreach($leveldata as $levelrec){ 
              $scoredeptid=trim($levelrec['departmentid']); 
                $levelname=trim($levelrec['levelname']); 
                $classtype=trim($levelrec['classtype']);
              }
          }

        $optiondata=$SHResultOOP->allresultedit('optiontable', 'optid', $optionid);
         if (is_array($optiondata)) {
          foreach($optiondata as $optionrec){ 
                               
           $optionname=trim($optionrec['optname']); 
         }
      }

      //Checking whether these class is a pre-class or early class
        if($classtype==0){

                echo "<script>
                          alert('Attenton Please:  This class is a pre-class');
                          window.location.href='resultcomment?schoolhelp=$schoolhelp&sql=$sql';
                      </script>";

                        } 
      
                         
}


if ($page==4) {

  //collecting Variables
  $sessionid=trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);
  $semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
  $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
  $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);
  $s=0;
   // Getting the Department ID
                           
                          $leveldata=$SHResultOOP->allresultedit('level', 'levelid', $levelid);
                            if (is_array($leveldata)) {
                              foreach($leveldata as $levelrec){ 
                                $scoredeptid=trim($levelrec['departmentid']); 
                                $levelname=trim($levelrec['levelname']); 
                              }
                            }

                            $positiontblname="positionresult".trim($scoredeptid);
  
    $positiontblname="earlycmentattend";
    $records=$SHResultOOP->allposi4sort($positiontblname, $levelid, $optionid, $sessionid, $semesterid, 'earlycattendid', 'ASC');
            if (is_array($records)) {
            foreach($records as $fieldrecord){
              $varpro="headcomment".trim($fieldrecord["earlycattendid"]);
              $headcomment=trim(isset($_POST[$varpro])?$_POST[$varpro]:false);
              $tableUpdate=new updateTable;
               $state= $tableUpdate->update_threefields($positiontblname, 'earlycattendid', trim($fieldrecord["earlycattendid"]), 'headcomment', $headcomment, 'operatorid', $schoolhelp, 'udate', $udate);
               if ($state=="Success") {
                $s+=1;
              }
               $sql=$state.":: Update Made, affected records =".$s;
            
            }

          }else{
            $sql="This Record not found";
          }

        }



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
                  <div class="col-md-4" style=""><h3>
                    <ul class="nav panel_toolbox" style="float:left">
                      <li><a class="btn btn-primary" href="../?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                      
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                          <li ><a  href="scoretemplate?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  View Template</a></li>
                           <li ><a  href="scoreupload?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> Score Upload</a></li>
                           <li ><a  href="scoresheet?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> Score Sheet</a></li>
                           <li ><a  href="broadsheet?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> Broad Sheet</a></li>
                           <li ><a  href="resultactivations?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>Result Activation</a></li>
                           <li ><a  href="setupcomment?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>Comment Setup</a></li>
                           <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>Comment Result</a></li>
                        </ul>
                      </li>
                      
                    </ul>
                  </h3></center></div>
                   <div class="col-md-4"><span style="float:left"> <h3 style="color:black"><?php echo $pagename; ?></h3></span></div>
                   <div class="col-md-4"><ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link" style="color:#d2dc2a;"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench" style="color:#d2dc2a;"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="../settings?schoolhelp=<?php echo $schoolhelp; ?>">System Settings</a>
                          </li>
                          <li><a href="index?schoolhelp=<?php echo $schoolhelp ?>">Result Settings</a>
                          </li>
                        </ul>
                      </li>
                      <li><a  class="close-link" href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-close " style="color:#d2dc2a;"></i></a>
                      </li>
                    </ul>
                  </div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="row">
                     

                   <div class="x_panel table-responsive" style="width: 100%; overflow-y: hidden">
                    <form  action="?page=1&schoolhelp=<?php echo $schoolhelp ?>" name="search" method="post" >
                      <fieldset>
                        <legend>Comment Student Result</legend>
                             
                      <table >
                        <thead>
                          <tr>
                            <th class="col-md-2">Session</th>
                            <th class="col-md-2">Semester/Term</th>
                            <th class="col-md-2">Level/Class: </th>
                            <th class="col-md-2"><table><tr><td class=" col-md-2">Option/Arm:  </td></tr></table></th>                
                            <th class=" col-md-2">Action: </th>
                          </tr>
                        </thead>
                        <tbody>
                         <tr>
                          
                              <td class="col-md-2"><select  name="sessionid" id="sessionid" required="required"  class="form-control col-md-1 col-xs-2" >
                               <option value="">--Select Session--</option>
                              <?php
                               $retrievedata1=$SHResultOOP->allresult('session', 'sessionid', 'desc');
                                if (is_array($retrievedata1)) {
                                foreach($retrievedata1 as $field1){
                              ?>
                                    <option value="<?php echo $field1['sessionid']; ?>" <?php if ($field1['status']==1) {?> selected="selected" <?php } ?> ><?php echo $field1['sessionlow'].' - '.$field1['sessionhigh']; ?></option>
                              <?php
                                  }
                                }
                                ?>
                            </select></td>

                              <td class="col-md-2"><select  name="semesterid" id="semesterid" required="required"  class="form-control col-md-1 col-xs-2" >
                               <option value="">--Select Semester/Term--</option>
                              <?php
                              $retrievedata=$SHResultOOP->allresult('semesters', 'semesterid', 'desc');
                                if (is_array($retrievedata)) {
                                foreach($retrievedata as $field){
                              ?>
                                    <option value="<?php echo $field['semesterid']; ?>" <?php if ($field['status']==1) {?> selected="selected" <?php } ?> ><?php echo $field['semestername']; ?></option>
                              <?php
                                  }
                                }
                                ?>
                            </select></td>
                          
                    <td style="padding-right:20px" class="col-md-2">
                        <select  id="levelid" required="required" name="levelid" class="form-control col-md-2" onchange="retrieveselection1('optiontable', 'levelid', this.value, 0, 0, 'retrieveselection4', 'opencontainer');">
                            <option value="">--Select Level--</option>
                            <?php
                            $levelmethod=$SHResultOOP->allresult('level','levelid','asc');
                            if (is_array($levelmethod)) {
                            foreach($levelmethod as $leveldata){

                               $deptdata=$SHResultOOP->allresultedit('department', 'did', $leveldata['departmentid']);
                              if (is_array($deptdata)) {
                                foreach($deptdata as $deptrec){
                                        $deptname=$deptrec['deptname'];
                                }
                              }

                              if ($admintype==0) {
                                if ($leveldata['departmentid']==$departmentid) {?>
                                  <option value="<?php echo $leveldata['levelid']; ?>"  ><?php echo $leveldata['levelname']; ?></option>
                            <?php  }
                              }else{
                            ?>
                            <option value="<?php echo $leveldata['levelid']; ?>"  ><?php echo $leveldata['levelname'].' => '.$deptname; ?></option>
                            <?php }
                              } 
                            }
                            ?>
                          </select>
                    </td>

                  <td id="opencontainer" class="col-md-2">
                            <table>
                              <tr>
                        <td>
                            <select  id="optionid" required="required" name="optionid" class="form-control col-md-2">
                            <option value="">--Select Option--</option> 
                          </select>                                                                                                                                                         
                       </td>
                        
                     </tr>
                     </table>
                     </td>
                         
                  <td class="col-md-2"> <input  type="submit" class="btn btn-primary" value="Search" class="col-md-2"  ></td>
             </tr>
           </tbody>
              </table>
            
            
             </fieldset>
             </form>
           
                  </div>  
                  <div><h3 style="color:green"><?php echo $sql; ?></h3></div>
                  <?php if ($page==1) {
                    $x=0;
                    $score_tbl_id=""; 
                     $score_tbl_score="";
                     $score_status="";
                     $assessmentid="";
                    ?>  
                    <fieldset>

                        <legend style="color:#063"> Comment Pre-School Class</legend>
                        <form method="POST" action="?schoolhelp=<?php echo $schoolhelp; ?>&page=4">
                          <input name="optionid"  id="optionid" value="<?php  echo trim($optionid); ?>" type="hidden"/>
                          <input name="levelid"  id="levelid" value="<?php  echo trim($levelid); ?>" type="hidden"/>
                          <input name="semesterid"  id="semesterid" value="<?php  echo trim($semesterid); ?>" type="hidden"/>
                          <input name="sessionid"  id="sessionid" value="<?php  echo trim($sessionid); ?>" type="hidden"/>
                         
                          <input name="deptid"  id="deptid" value="<?php  echo trim($scoredeptid); ?>" type="hidden"/>
                            
                      <div class="x_panel" >
                       
                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <center><caption><h1><?php echo $levelname.' '.$optionname  ?></h1></caption></center>
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Reg No</th>
                          <th>Fullname</th>
                         
                          <th>Form Teacher|Course Adviser</th> 
                          <th>Head Teacher's Comment</th>    
                                      
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 

                            ?>
                            
                           <?php  
                           //calculating position based on Singular or accummulated result
                            /*
                              $singularresult="";
                               $activationrecords=$SHResultOOP->allresultedit('resultactivations', 'titlename', 'Singular Result');
                               if (is_array($activationrecords)) {
                                  foreach($activationrecords as $activationrecord){
                                  $singularresult=trim($activationrecord['status']); 
                                 }

                               }

                        
                            if ($singularresult==1) {
                              $posi_measure="average";                      
                            }else{
                               $posi_measure="accaverage";
                            } */

                            $positiontblname="earlycmentattend";
                            $records=$SHResultOOP->allposi4sort($positiontblname, $levelid, $optionid, $sessionid, $semesterid, 'earlycattendid', 'ASC');
                              if (is_array($records)) {
                               $hodcommentname="";
                               $dircommentname="";
                              foreach($records as $fieldrecord){
                               $k+=1;
                              $stid=trim($fieldrecord['stid']);
                              $comment=trim($fieldrecord['comment']);
                              $headcomment=trim($fieldrecord['headcomment']);

                                 $sturecords=$SHResultOOP->allresultedit('students', 'stid', $stid);
                               if (is_array($sturecords)) {
                                  foreach($sturecords as $sturecord){
                                  $surname=trim($sturecord['surname']);
                                  $othername=trim($sturecord['othername']);
                                  $regno=trim($sturecord['regno']);
                                 }

                               }
                                    
                        ?>
                                      <tr>
                                        <td><?php echo  $k; ?><input name="studid[]"  id="studid[]" value="<?php  echo trim($fieldrecord['stid']); ?>" type="hidden"/></td>
                                        <td><?php echo  $regno; ?></td>
                                        <td><?php echo  $surname.' '.$othername; ?></td>
                                        <td><?php echo $fieldrecord['comment']; ?></td>
                                        
                            <td> 
                           
                            <textarea name="<?php echo 'headcomment'.trim($fieldrecord['earlycattendid']); ?>"  class="form-control col-md-12 col-xs-12" style="width:100%"><?php echo $fieldrecord['headcomment']; ?></textarea>

                            </td>

                           <?php  } ?>
                            
                            <?php }else{echo "This result is not generated yet"; }
                            ?>    
                            </tr>
                      </tbody>
                    </table>
                  
                     <div class="row no-print" style="margin-bottom: 50px">
                        <div class="col-xs-12">
                         <?php if ($k!="") {?>

                         <div class="col-xs-6"><button type="submit" class="btn btn-success " ><i class="fa fa-send"></i> Save </button></div>
                         <?php } ?>
                        </div>
                      </div>

                    </div>
                  </form>

                    </fieldset>
                    <?php } ?>
                     
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- Modal -->
<button id="myModalbutton" data-toggle="modal" data-target="#myModal" hidden="hidden"><i class="fa fa-plus"></i>  Call Domain Dialogue Box </button>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog" >

    <!-- Modal content-->
    
    <div class="modal-content">
      <div class="modal-header">Student Domain Marking
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div>
      <div class="modal-body">
        <div class="row">
           <div classs="col-lg-12">
            <div id="msgnum"></div>
            <form action="?page=1&schoolhelp=<?php echo $schoolhelp; ?>" method="POST" id="domaingrade" name="domaingrade">
              <input name="optionid"  id="optionid" value="<?php  echo trim($optionid); ?>" type="hidden"/>
              <input name="levelid"  id="levelid" value="<?php  echo trim($levelid); ?>" type="hidden"/>
              <input name="semesterid"  id="semesterid" value="<?php  echo trim($semesterid); ?>" type="hidden"/>
              <input name="sessionid"  id="sessionid" value="<?php  echo trim($sessionid); ?>" type="hidden"/>
              <input name="deptid"  id="deptid" value="<?php  echo trim($scoredeptid); ?>" type="hidden"/>

              <div id="domaincontent">

              </div>
            </form>
           </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="row">
           <div classs="col-lg-12" style="color:red">
            <b>Please fill this appropriately</b>
           </div>
        </div>
      </div>
     
    </div>

  </div>
</div>

       <?php include("includes/footer.php"); ?>