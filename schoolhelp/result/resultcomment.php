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
  $pageaccess=trim($actualrecord['comment_r']);
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
    $positionresultid=trim(isset($_POST['positionresultid'])?$_POST['positionresultid']:false);


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
        if($classtype==1){

                echo "<script>
                          alert('Attenton Please:  This class is a pre-class');
                          window.location.href='earlyresultcomment?schoolhelp=$schoolhelp&sql=$sql&page=1';
                      </script>";
                      
                        }


     if ($positionresultid!="") {
      $insertedrow=0;
      $insertedrow1=0;
      $numofupdate=0;
      $numofupdate1=0;

      $noofschooldays=trim(isset($_POST['noofschooldays'])?$_POST['noofschooldays']:false);
      $noofdaysattended=trim(isset($_POST['noofdaysattended'])?$_POST['noofdaysattended']:false);

      //Checking Attendance Table
        $retrievedata6=$SHResultOOP->allresultedit('attendancemark', 'positionresultid', $positionresultid);
         if (is_array($retrievedata6)) { 
            foreach($retrievedata6 as $field6){

              $attendanemarkid=trim($field6['attendancemarkid']);
      
              $state=$tabledomainupdate->update_attendancemark($noofschooldays, $noofdaysattended, $schoolhelp, $udate, $attendanemarkid);
              $numofupdate1+=1;

            }
          }else{

              
              $state=$tabledomain->insert_attendancemark($noofschooldays, $noofdaysattended, $positionresultid, $schoolhelp, $odate);
              //$display=$state['action'];
              $insertedrow1+=$state['counting'];

          }

          // Checking Domain Type
           $domaindata7=$SHResultOOP->allresultedit('domaintype', 'departmentid', $scoredeptid);
            if (is_array($domaindata7)) {
            foreach($domaindata7 as $domainrec7){ 

      // Marking Domain
          $domaindata=$SHResultOOP->allresultedit('domainname', 'domaintypeid', trim($domainrec7['domaintypeid']));
          if (is_array($domaindata)) {
            foreach($domaindata as $domainrec){ 
              $domaintypeid=trim($domainrec['domaintypeid']);
              $domainnameid=trim($domainrec['domainnameid']);
              $domaingrade1="domain".$domainnameid;
              $domaingrade=trim(isset($_POST[$domaingrade1])?$_POST[$domaingrade1]:false);

          $retrievedata5=$SHResultOOP->allresultedit2('resultdomain', 'positionresultid', $positionresultid, 'domainnameid', trim($domainrec['domainnameid']));
         if (is_array($retrievedata5)) { 
            foreach($retrievedata5 as $field5){

              $resultdomainid=trim($field5['resultdomainid']);
              
              $state=$tabledomainupdate->update_resultdomain($domaingrade, $schoolhelp, $udate, $resultdomainid);
               $numofupdate+=1;
            }
          }else{

              
              $state=$tabledomain->insert_resultdomain($positionresultid, $domaintypeid, $domainnameid, $domaingrade, $schoolhelp, $odate);
              //$display=$state['action'];
              $insertedrow+=$state['counting'];

          }

        }
      }//Close of domain table

    }
  }//Closing of the domain type

        $t="Total Number of Attendance inserted is: ".$insertedrow1."\n";
        $t0="Total Number of Attendance updated is: ".$numofupdate1."\n";
        $t1="Total Number of domain inserted is: ".$insertedrow."\n";
        $t2="Total Number of domain updated is: ".$numofupdate."\n";
        $sql.=$t.$t0.$t1.$t2;
        
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
  
    $records=$SHResultOOP->allposi4sort($positiontblname, $levelid, $optionid, $sessionid, $semesterid, 'average', 'DESC');
            if (is_array($records)) {
            foreach($records as $fieldrecord){
              $staffcommentid1='staffcomment'.trim($fieldrecord['positionid']);
              $staffcommentid2='staffcommentmanual'.trim($fieldrecord['positionid']);
              $principalcommentid1='principalcomment'.trim($fieldrecord['positionid']);
              $principalcommentid2='principalcommentmanual'.trim($fieldrecord['positionid']);
              $staffcommentid=trim(isset($_POST[$staffcommentid1])?$_POST[$staffcommentid1]:false);
              $comment=trim(isset($_POST[$staffcommentid2])?$_POST[$staffcommentid2]:false);
              $principalcommentid=trim(isset($_POST[$principalcommentid1])?$_POST[$principalcommentid1]:false);
               $comment1=trim(isset($_POST[$principalcommentid2])?$_POST[$principalcommentid2]:false);
              $tableUpdate=new updateTable;
               $state= $tableUpdate->update_sixfields($positiontblname, 'positionid', trim($fieldrecord['positionid']), 'hodcommentid',  $staffcommentid,  'dircommentid',  $principalcommentid, 'comment',  $comment,  'comment1',  $comment1, 'operatorid', $schoolhelp, 'udate', $udate);
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

                        <legend style="color:#063"> Score Template</legend>
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
                          
                          <th>Fullname</th>
                          <th>Average</th>
                          <th>Form Teacher(banked)</th> 
                          <th>Form Teacher(Manual)</th> 
                          <th>School Head(banked)</th>
                          <th>School Head(Manual)</th>     
                          <th>Domain Grade</th>              
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 

                            ?>
                            
                           <?php  
                           //calculating position based on Singular or accummulated result
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
                            }

                            $positiontblname="positionresult".$scoredeptid;
                            $records=$SHResultOOP->allposi4sort($positiontblname, $levelid, $optionid, $sessionid, $semesterid, 'average', 'DESC');
                              if (is_array($records)) {
                               $hodcommentname="";
                               $dircommentname="";
                              foreach($records as $fieldrecord){
                               $k+=1;
                              $stid=trim($fieldrecord['stid']);
                              $hodcommentid=trim($fieldrecord['hodcommentid']);
                              $dircommentid=trim($fieldrecord['dircommentid']);
                              $surname="";
                               $othername="";

                                 $sturecords=$SHResultOOP->allresultedit('students', 'stid', $stid);
                               if (is_array($sturecords)) {
                                  foreach($sturecords as $sturecord){
                                  $surname=trim($sturecord['surname']);
                                  $othername=trim($sturecord['othername']);
                                  $regno=trim($sturecord['regno']);
                                 }

                               }
                               
                               //Getting HOD's Comment
                               $hodcommentname="";
                                $rstcomrecords=$SHResultOOP->allresultedit('commentsetup', 'resultcommentid', $hodcommentid);
                               if (is_array($rstcomrecords)) {
                                  foreach($rstcomrecords as $rstcomrecord){
                                  $hodcommentname=trim($rstcomrecord['comment']);                               
                                 }
                               }

                               //Getting Director's Comment

                               $dircommentname="";
                               $regno="";
                               

                                $rstcomrecords1=$SHResultOOP->allresultedit('commentsetup', 'resultcommentid', $dircommentid);
                               if (is_array($rstcomrecords1)) {
                                  foreach($rstcomrecords1 as $rstcomrecord1){
                                  $dircommentname=trim($rstcomrecord1['comment']);                               
                                 }

                               }
                               
                        ?>
                                      <tr>
                                        <td><?php echo  $k; ?><input name="studid[]"  id="studid[]" value="<?php  echo trim($fieldrecord['stid']); ?>" type="hidden"/></td>
                                        
                                        <td><?php echo  $surname.' '.$othername; ?></td>
                                        <td><?php echo  trim($fieldrecord[$posi_measure]); ?></td>
                                        
                            <td> 
                              <input type="text" list="staffcommentlists<?php echo $fieldrecord['positionid']; ?>" id="staffcommentlist<?php echo $fieldrecord['positionid']; ?>" class="form-control col-md-12 col-xs-12"  placeholder="Please type and select Form Teachers Comment" onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), '<?php echo "staffcomment".$fieldrecord["positionid"]; ?>');" style="width:100%" <?php if ($hodcommentname!=""){ ?>  value="<?php echo $hodcommentname; ?>" <?php } ?> >

                        <datalist id="staffcommentlists<?php echo $fieldrecord['positionid']; ?>" >

                            <?php
                             $records1=$SHResultOOP->allresultedit2('commentsetup', 'departmentid', $scoredeptid, 'commenttype', 0);
                              if (is_array($records1)) {
                               
                              foreach($records1 as $fieldrecord1){
                           
                            ?>
                            <option data-value="<?php echo $fieldrecord1['resultcommentid']; ?>"  value="<?php echo $fieldrecord1['comment'] ?>">
                            <?php } 
                          }?>
                           </datalist>
                           <input name="<?php echo 'staffcomment'.trim($fieldrecord['positionid']); ?>" id="<?php echo 'staffcomment'.$fieldrecord['positionid']; ?>" class="form-control col-md-7 col-xs-12" type="hidden"  value="<?php echo $fieldrecord['hodcommentid']; ?>">

                           </td>

                           <td>
                            <textarea name="<?php echo 'staffcommentmanual'.trim($fieldrecord['positionid']); ?>" id="<?php echo 'staffcommentmanual'.$fieldrecord['positionid']; ?>" class="form-control col-md-7 col-xs-12"><?php echo $fieldrecord['comment']; ?></textarea>
                             
                           </td>

                          <td><input type="text" list="principalcommentlists<?php echo $fieldrecord['positionid']; ?>" id="principalcommentlist<?php echo $fieldrecord['positionid']; ?>" class="form-control col-md-12 col-xs-12"  placeholder="Please type and select Form Principal Comment" onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), '<?php echo "principalcomment".$fieldrecord["positionid"]; ?>');" style="width:100%" <?php if ($dircommentname!=""){ ?>  value="<?php echo $dircommentname; ?>" <?php } ?>  >

                        <datalist id="principalcommentlists<?php echo $fieldrecord['positionid']; ?>" >

                            <?php
                             $records1=$SHResultOOP->allresultedit2('commentsetup', 'departmentid', $scoredeptid, 'commenttype', 1);
                              if (is_array($records1)) {
                               
                              foreach($records1 as $fieldrecord1){
                           
                            ?>
                            <option data-value="<?php echo $fieldrecord1['resultcommentid']; ?>"  value="<?php echo $fieldrecord1['comment'] ?>">
                            <?php } 
                          } ?>
                           </datalist>
                           <input name="<?php echo 'principalcomment'.trim($fieldrecord['positionid']); ?>" id="<?php echo 'principalcomment'.$fieldrecord['positionid']; ?>" class="form-control col-md-7 col-xs-12" type="hidden"  value="<?php echo $fieldrecord['dircommentid']; ?>"></td>

                            <td>
                              <textarea name="<?php echo 'principalcommentmanual'.trim($fieldrecord['positionid']); ?>" id="<?php echo 'principalcommentmanual'.$fieldrecord['positionid']; ?>" class="form-control col-md-7 col-xs-12"><?php echo $fieldrecord['comment1']; ?></textarea>
                           </td>

                           <?php    
                             $records4=$SHResultOOP->allresultedit('resultdomain', 'positionresultid', trim($fieldrecord['positionid']));
                              if (is_array($records4)) {  ?>
                                                                                                            <!-- Retrieving Domain and attendane -->
                           <td><button type="submit" class="btn btn-success"  id="button<?php echo trim($fieldrecord['positionid']); ?>" onclick="return domaingrade_attendance('<?php echo $scoredeptid; ?>', '<?php echo trim($fieldrecord['positionid']); ?>', 'domaingrade_attendance')"><i class="fa fa-check"></i> Mark Domain</button></td>

                           <?php } else{ ?>
                           <td><button type="submit" class="btn btn-danger"  id="button<?php echo trim($fieldrecord['positionid']); ?>" onclick="return domaingrade_attendance('<?php echo $scoredeptid; ?>', '<?php echo trim($fieldrecord['positionid']); ?>', 'domaingrade_attendance')"><i class="fa fa-close"></i> Mark Domain</button></td>
                           <?php } ?>

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