<?php
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHresultOOP.php");
include_once("../phpclass/SHresultupdate.php");
confirmcheckin();
$SHResultOOP=new ClassResult;
$SHResultupdate=new updateTable;
$pagename="Student Report Card";

// Checking page access Authenticity


$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp=trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$page=trim(isset($_GET['page'])?$_GET['page']:false);

$previlleges=$SHResultOOP->allresultedit('adminpersons', 'adminid', $schoolhelp);
foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['reportcard_r']);
   $resultdelete_r=trim($actualrecord['resultdelete_r']);
  
}
if ($pageaccess!=1) {
  echo "<b style='font-size:100; color:red'>Criminal Attempt Made, contact the admin ask for the access of this page</b>";
  exit();
}


if ($page==1) {
    $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
    $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);
     $semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
    $sessionid=trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);

    $leveldata=$SHResultOOP->allresultedit('level', 'levelid', $levelid);
      if (is_array($leveldata)) {
        foreach($leveldata as $levelrec){
         $deptid=$levelrec['departmentid'];
         $levelname=$levelrec['levelname'];
         $classtype=trim($levelrec['classtype']);
        }
      }

       $optiondata=$SHResultOOP->allresultedit('optiontable', 'optid', $optionid);
      if (is_array($optiondata)) {
        foreach($optiondata as $optionrec){
         
         $optionname=$optionrec['optname'];
        }
      }
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

  if($page == 2){
  $classtype="";   
  $sessionid=trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);
  $semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
  $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
  $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);

    $_SESSION["sessionid"] =$sessionid;
    $_SESSION["semesterid"] =$semesterid;
    $_SESSION["levelid"] =$levelid;
    $_SESSION["optionid"] =$optionid; 

    //Getting Department ID
    $leveldata=$SHResultOOP->allresultedit('level', 'levelid', $levelid);
      if (is_array($leveldata)) {
        foreach($leveldata as $levelrec){
         $deptid=trim($levelrec['departmentid']);
         $classtype=trim($levelrec['classtype']);
        }
      }

  //Getting Report Card Sample
    if ($classtype==1) {
       $actualpage="earlyresult";
    }else{
        $rsampledata=$SHResultOOP->allresultedit('resultsample', 'departmentid', $deptid);
          if (is_array($rsampledata)) {
            foreach($rsampledata as $rsamplerec){
             $actualpage=$rsamplerec['resultname'];
             
            }
          }else{
            $actualpage="resultnew1";
          }
      }

  $stuid=(isset($_POST['studid'])?$_POST['studid']:false);
  
  $idcol="";
  foreach($stuid as $i => $sdentid){
    //echo  $studentid= (int)$stuid[$i];
      //echo $studentid=$_POST[$sdentid];
      //if ($i!="") {
        if(empty(trim($idcol))){
          $idcol.=$sdentid;
        }else{
          $idcol.=",".$sdentid;
        }
      //}
  }
  echo $idcol;
  //$actualpage
    echo "
      <script language='javascript'>
        window.location.href='../printpdf/$actualpage?schoolhelp=$schoolhelp&idcol=$idcol'
      </script>
    ";
  }

if ($page==6) {
  
  if ($resultdelete_r==1) {
   $stid=trim(isset($_GET['stid'])?$_GET['stid']:false);
   $studeptid=trim(isset($_GET['studeptid'])?$_GET['studeptid']:false);
   $levelid=trim(isset($_GET['levelid'])?$_GET['levelid']:false);
   $optionid=trim(isset($_GET['optionid'])?$_GET['optionid']:false);
   $semesterid=trim(isset($_GET['semesterid'])?$_GET['semesterid']:false);
   $sessionid=trim(isset($_GET['sessionid'])?$_GET['sessionid']:false);
   $tablename="positionresult".$studeptid;
   $tablename1="result".$studeptid;
   $tablename2="score".$studeptid;
  
    $state=$SHResultupdate->deletecheck5($tablename, 'stid', $stid, 'levelid', $levelid, 'optionid', $optionid, 'semesterid', $semesterid, 'sessionid', $sessionid);
    $state1=$SHResultupdate->deletecheck5($tablename1, 'stid', $stid, 'levelid', $levelid, 'optionid', $optionid, 'semesterid', $semesterid, 'sessionid', $sessionid);
    $state2=$SHResultupdate->deletecheck5($tablename2, 'stid', $stid, 'levelid', $levelid, 'optionid', $optionid, 'semesterid', $semesterid, 'sessionid', $sessionid);
    
    if (is_array($state)) {
      $sql=$state.$state1.$state2."Result has been Deleted";
    }else{
      $sql="Result not found";
    }
    
  
 
 }
        echo "<script>
                window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
              </script>";
    
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
                           <li ><a  href="resultcomment?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>Comment Result</a></li>
                           
                           <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>Report Card</a></li>
                        </ul>
                      </li>
                      
                    </ul>
                  </h3></center></div>
                   <div class="col-md-4"><span style="float:left"> <h3 style="color:black">Report Card</h3></span></div>
                   <div class="col-md-4"><ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link" style="color:#d2dc2a;"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench" style="color:#d2dc2a;"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="../settings?schoolhelp=<?php echo $schoolhelp; ?>">System Settings</a>
                          </li>
                          <li><a href="index?schoolhelp=<?php echo $schoolhelp ?>">Result Dashboard</a>
                          </li>
                        </ul>
                      </li>
                      <li><a  class="close-link" href="../index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-close " style="color:#d2dc2a;"></i></a>
                      </li>
                    </ul>
                  </div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="row">

                   <div class="x_panel">
                    <form  action="?page=1&schoolhelp=<?php echo $schoolhelp ?>" name="search" method="post" >
                      <fieldset>
                        <legend>Report Card</legend>
                        
                             
                      <table>
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
             </fieldset>
                  </div>  
                  <?php if ($page==1) {
                    $x=0;

                    ?>
                      <div class="x_panel" id="printrecord">
                         <fieldset>
                        <legend style="color:#063"> <?php echo $pagename ?></legend>
                    <form method="post" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" name="idcard" onSubmit="return printmarked();" >
                      <input name="levelid"  type="hidden" id='levelid' value="<?php echo $levelid; ?>" > 
                      <input name="optionid"  type="hidden" id="optionid" value="<?php echo $optionid; ?>" >
                      <input name="semesterid"  type="hidden" id='semesterid' value="<?php echo $semesterid; ?>" > 
                      <input name="sessionid"  type="hidden" id="sessionid" value="<?php echo $sessionid; ?>" >
                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <center><caption><h2><?php echo $levelname.' '.$optionname ; ?></h2></caption></center>
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th><input name="topcheckbox"  type="checkbox" id='checkAll' value=""/>  Select All</th>
                          <th>Reg No</th>
                          <th>Surname</th>
                          <th>Othername</th>
                          <th>Delete</th>
                        </tr>
                      </thead>

                      <?php if($classtype==1) { ?>

                      <tbody>
                        <?php $k=0; 
                        
                         

                            $records=$SHResultOOP->allresultedit2('students', 'levelid', $levelid, 'optid', $optionid);
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                               $k+=1;
                               $regno="";
                               $surname="";
                               $othername="";
                                
                                    $stid=trim($fieldrecord['stid']);
                                    $regno=$fieldrecord['regno'];
                                    $surname=$fieldrecord['surname'];
                                    $othername=$fieldrecord['othername'];
                                  
                        ?>
                                      <tr>
                                        <td><?php echo  $k; ?></td>
                                        <td> <input name="studid[]" id="<?php echo $stid; ?>" type="checkbox" class="status1"  value=""  onchange="if(this.checked){ this.value='<?php echo $stid; ?>'; }else{this.value='';}" /> </td>  
                                        <td><?php echo  $regno; ?></td>
                                        <td><?php echo  $surname; ?></td>
                                        <td><?php echo  $othername; ?></td>
                                        <td><input style="background:red" type='button' id="deleteresultc<?php echo $stid ?>"  name="deleteresultc<?php echo $stid ?>" value="Delete" onClick="funcdeleteresultc('<?php echo $schoolhelp; ?>', '<?php echo $stid; ?>', '<?php echo $deptid ?>',  '<?php echo $levelid ?>', '<?php echo $optionid ?>',  '<?php echo $semesterid ?>', '<?php echo $sessionid ?>');"></td>
                                      </tr>
                             <?php }
                              }
                             ?>
                        
                      </tbody>

                    <?php }else { ?>
                      <tbody>
                        <?php $k=0; 
                        $positionresult="positionresult".$deptid;
                         $regno="";
                         $surname="";
                         $othername="";

                            $records=$SHResultOOP->positionresult_sel($positionresult, 'levelid', $levelid, 'optionid', $optionid, 'semesterid', $semesterid, 'sessionid', $sessionid, 'stid');
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                                $regno="";
	                         $surname="";
	                         $othername="";
                               $k+=1;
                               $stid=trim($fieldrecord['stid']);
                                 $records1=$SHResultOOP->allresultedit('students', 'stid', $stid);
                                  if (isset($records1)) {
                                      foreach($records1 as $fieldrecord1){
                                        $regno=$fieldrecord1['regno'];
                                        $surname=$fieldrecord1['surname'];
                                        $othername=$fieldrecord1['othername'];
                                    }
                                  }
                        ?>
                                      <tr>
                                        <td><?php echo  $k; ?></td>
                                        <td> <input name="studid[]" id="<?php echo $stid; ?>" type="checkbox" class="status1"  value=""  onchange="if(this.checked){ this.value='<?php echo $stid; ?>'; }else{this.value='';}" /> </td>  
                                        <td><?php echo  $regno; ?></td>
                                        <td><?php echo  $surname; ?></td>
                                        <td><?php echo  $othername; ?></td>
                                        <td><input style="background:red" type='button' id="deleteresultc<?php echo $stid; ?>"  name="deleteresultc<?php echo $stid ?>" value="Delete" onClick="funcdeleteresultc('<?php echo $schoolhelp; ?>', '<?php echo $stid; ?>', '<?php echo $deptid ?>',  '<?php echo $levelid ?>', '<?php echo $optionid ?>',  '<?php echo $semesterid ?>', '<?php echo $sessionid ?>');"></td>
                                      </tr>
                             <?php }
                              }
                             ?>
                        
                      </tbody>
                      <?php  }  ?>

                    </table>
                    <div class="row no-print" style="margin-bottom: 50px">
                        <div class="col-xs-12">
                      <input id="save" type="submit" class="btn btn-info btn-mini" value=" Print Result Card " /> </td>
              
                         
                        </div>
                      </div>
                  </form>
                   </fieldset>
                    </div>
                     
                    <?php } ?>
                     
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

       <?php include("includes/footer.php"); ?>