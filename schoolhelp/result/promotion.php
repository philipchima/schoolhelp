<?php
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHresultOOP.php");
include_once("../phpclass/SHresultupdate.php");
include_once("../phpclass/SHresultinserts.php");
confirmcheckin();
$SHResultOOP=new ClassResult;
$tableupdate=new updateTable;
$tableinsert=new insertTable;

$pagename="Promotion";

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
  $pageaccess=trim($actualrecord['promotion_r']);
  $resutadd_r=trim($actualrecord['resutadd_r']);
  
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
    $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
    $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);
    


      // Getting the Department ID
      $levelrankactual=0;     
        $leveldata=$SHResultOOP->allresultedit('level', 'levelid', $levelid);
          if (is_array($leveldata)) {
            foreach($leveldata as $levelrec){ 
              $scoredeptid=trim($levelrec['departmentid']); 
               $tablename="result".$scoredeptid;
                $levelname=trim($levelrec['levelname']); 
                $levelrankactual=trim($levelrec['levelrank']); 
              }
          }

        $optiondata=$SHResultOOP->allresultedit('optiontable', 'optid', $optionid);
         if (is_array($optiondata)) {
          foreach($optiondata as $optionrec){ 
                               
           $optionname=trim($optionrec['optname']); 
         }
      }                       

}


if ($page==4) {

  //collecting Variables
 
  $oldlevelid  =trim(isset($_POST["oldlevelid"])?$_POST["oldlevelid"]:false);
  $sessionid= trim(isset($_POST["sessionid"])?$_POST["sessionid"]:false);
  $newlevelid  = trim(isset($_POST["newlevelid"])?$_POST["newlevelid"]:false);
  $passmark  = trim(isset($_POST["passmark"])?$_POST["passmark"]:false);
  $newoptionid=trim(isset($_POST["newoptionid"])?$_POST["newoptionid"]:false);
  $oldoptionid=trim(isset($_POST["oldoptionid"])?$_POST["oldoptionid"]:false);
   // Getting the Department ID
                           
  $date = date("Y-m-d");
       
    
    //$select_content=("select * from students WHERE  class ='$oldlevelid' and group_id='$oldoptionid' ");
    //$content_result= mysqli_query($mysqli, $select_content) or die (mysqli_error($mysqli));
    //$content = mysqli_fetch_assoc($content_result);
    //$num_chk = mysqli_num_rows ($content_result);

    $records=$SHResultOOP->allresultedit2('students', 'levelid', $oldlevelid, 'optid', $oldoptionid);
    $numchk=count($records);
       
                          
    $cout =0;
    $coutf=0;
    $status=0;
    $statuscheck=0;
    if ($newlevelid==1000) {
      $status=3;
    }
  $stuid=isset($_POST['studid'])?$_POST['studid']:false;
  
  //echo $bno = count(isset($_POST['studid'])?$_POST['studid']:false);
  if ($stuid!="") {
   if (is_array($records)) {    
 foreach($records as $fieldrecord){
 $sid = trim($fieldrecord["stid"]);
 $presencestatus=0;
  $studentave=trim(isset($_POST['stu'.$sid])?$_POST['stu'.$sid]:false);
  $statuscheck=0;
  foreach($stuid as $i => $sdentid){
    
    $sdentid=trim($sdentid);
    if ($sdentid==$sid) {
      //check whether it has be added already
       //$presencestatus=trim(Resultactive::promotionstatus($sdentid, $cgroup, $year, $oldlevelid, $newlevelid, $passmark, $studentave, 'pid'));
      $records1=$SHResultOOP->allresultedit7('promotion', 'stid', $sdentid, 'newlevelid', $newlevelid, 'newoptionid', $newoptionid, 'oldoptionid', $oldoptionid, 'oldlevelid', $oldlevelid, 'sessionid', $sessionid, 'passmark', $passmark);
        if (is_array($records1)) {
          foreach($records1 as $fieldrecord1){
            $presencestatus=trim($fieldrecord1['pid']);
          }
       }

     //mysqli_query($mysqli, "UPDATE students set class='$newlevelid', status='$status', group_id='$cgroup'  where stid='$sdentid'") or die("could not insert, reason: ".mysqli_error($mysqli));
       $tableupdate->update_threefields('students', 'stid', $sdentid, 'levelid',  $newlevelid,  'optid',  $newoptionid,  'status', $status);
        
      if ($presencestatus>0) {
       // mysqli_query($mysqli, "UPDATE promotion set oldclassid='$oldlevelid', newclassid='$newlevelid', sid='$sdentid', passmark='$passmark',  year='$year', cgroup='$cgroup', oldoptionid='$oldoptionid', user='$xID', xdate='$date' and average='$studentave' WHERE pid='$presencestatus' ") or die("could not insert, reason: ".mysqli_error($mysqli));
        $tableupdate->update_ninefields('promotion', 'pid', $presencestatus, 'oldlevelid',  $oldlevelid, 'newlevelid', $newlevelid, 'stid', $sdentid, 'passmark', $passmark, 'sessionid', $sessionid, 'newoptionid', $newoptionid, 'oldoptionid', $oldoptionid, 'average', $studentave, 'operatorid', $schoolhelp); 
      }
      else{
        $odate=date("Y-m-d");
        // mysqli_query($mysqli, "INSERT into promotion set oldclassid='$oldlevelid', newclassid='$newlevelid', sid='$sdentid', passmark='$passmark', average='$studentave', year='$year', cgroup='$cgroup', oldoptionid='$oldoptionid', user='$xID', xdate='$date' ") or die("could not insert, reason: ".mysqli_error($mysqli));
        $tableinsert->insert_10fields('promotion', 'oldlevelid',  $oldlevelid, 'newlevelid', $newlevelid, 'stid', $sdentid, 'passmark', $passmark, 'sessionid', $sessionid, 'newoptionid', $newoptionid, 'oldoptionid', $oldoptionid, 'operatorid', $schoolhelp, 'average', $studentave, 'odate', $odate);
       
        
      }
      //mysqli_query($mysqli, "DELETE from failedstudents WHERE sid='$sid' and year='$year' and oldclassid='$oldlevelid' and oldoptionid='$oldoptionid'") or die("could not insert, reason: ".mysqli_error($mysqli));
      $tableupdate->delete_result4('failedstudents', 'stid', $sid, 'sessionid', $sessionid, 'oldlevelid', $oldlevelid, 'oldoptionid', $oldoptionid);

      $statuscheck=1;
      $cout+=1;
    }

    
  }

  //When student is not among the passed students
  if ($statuscheck==0) {
    $currentstatus=0;
    $coutf+=1;
      //$currentstatus=trim(Resultactive::failedstatus($sid , $cgroup, $year, $oldlevelid, $newlevelid, $passmark, $studentave, 'pid'));
      $records2=$SHResultOOP->allresultedit7('failedstudents', 'stid', $sid, 'newlevelid', $newlevelid, 'newoptionid', $newoptionid, 'oldoptionid', $oldoptionid, 'oldlevelid', $oldlevelid, 'sessionid', $sessionid, 'passmark', $passmark);
        if (is_array($records2)) {
          foreach($records2 as $fieldrecord2){
            $currentstatus=trim($fieldrecord2['pid']);
          }
       }else{
           $currentstatus=0;
       }
      if ($currentstatus>0) {
        //mysqli_query($mysqli, "UPDATE failedstudents set oldclassid='$oldlevelid', newclassid='$newlevelid', sid='$sid', passmark='$passmark', average='$studentave', year='$year', cgroup='$cgroup', oldoptionid='$oldoptionid', user='$xID', xdate='$date' WHERE pid='$currentstatus' ") or die("could not insert, reason: ".mysqli_error($mysqli));
        $tableupdate->update_ninefields('failedstudents', 'pid', $currentstatus, 'oldlevelid', $oldlevelid, 'newlevelid', $newlevelid, 'stid', $sid, 'passmark', $passmark, 'sessionid', $sessionid, 'newoptionid', $newoptionid, 'oldoptionid', $oldoptionid, 'average', $studentave, 'operatorid', $schoolhelp); 
      }
      else{
        //mysqli_query($mysqli, "INSERT into failedstudents set oldclassid='$oldlevelid', newclassid='$newlevelid', sid='$sid', passmark='$passmark', average='$studentave', year='$year', cgroup='$cgroup', oldoptionid='$oldoptionid', user='$xID', xdate='$date' ") or die("could not insert, reason: ".mysqli_error($mysqli));
         $tableinsert->insert_10fields('failedstudents', 'oldlevelid',  $oldlevelid, 'newlevelid', $newlevelid, 'stid', $sid, 'passmark', $passmark, 'sessionid', $sessionid, 'newoptionid', $newoptionid, 'oldoptionid', $oldoptionid, 'operatorid', $schoolhelp, 'average', $studentave, 'odate', $odate);

      }


    }
  

  } 
}

  }else{
    
    echo " 
        <script language='javascript'>
          alert('Promotion Unsuccessful! Student not selected');
          location.href='promotion?schoolhelp=".$schoolhelp."'
        </script>
      ";
  }
  
    
    $sql= 'Promotion was successfully Completed<br>'.$cout." of ".$numchk." Promoted and ".$coutf ." of ".$numchk." not promoted";
    echo "
      <script language='javascript'>
        location.href='promotion?sql=$sql&schoolhelp=$schoolhelp'
      </script>
    ";

        }

 ?>

    <?php include("includes/header.php"); ?>
        <!-- page content -->
    <div class="right_col" role="main">
          <div class="">

                          <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style="display:none"></button>

                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog" >
                  <div class="modal-dialog">
                  
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header" style="background-color:#063">
                        <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
                        <center><h4 class="modal-title" style="color:white">Attention:: Take Note of This During Promotion</h4></center>
                      </div>
                      <div class="modal-body">
                        <p style="color:re"><ol style="color:red">
                            <li><b>Make sure that the new session is added and also set as current session before promotion</b></li>
                            <li><b>Promotion of Classes must start from most senior school and class.</b></li>
                            
                          </ol>
                        </p>
                      </div>
                      <!--<div class="modal-footer" style="background-color:#063">
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="color:white">Close</button>
                      </div>-->
                    </div>
                    
                  </div>
                </div>
          
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
                           <li ><a  href="promotion?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"></i>  Promotion</a></li>
                           <li ><a  href="promoted?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"></i> Promoted</a></li>
                             <li ><a  href="failedstudent?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-down"></i> Failed Students</a></li>
                          <li ><a  href="scoretemplate?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  View Template</a></li>
                           <li ><a  href="scoreupload?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-check"></i> Score Upload</a></li>
                           <li ><a  href="scoresheet?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-check"></i> Score Sheet</a></li>
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
                        <legend><?php echo $pagename; ?></legend>
                             
                      <table >
                        <thead>
                          <tr>
                            <th class="col-md-3">Level/Class: </th>
                            <th class="col-md-3">Option/Arm:  </th>
                            <th class="col-md-3" title="Session Promoting from">Session</th>                
                            <th class=" col-md-3">Action: </th>
                          </tr>
                        </thead>
                        <tbody>
                         <tr>
                             <td style="padding-right:20px" class="col-md-3">
                        <select  id="levelid" required="required" name="levelid" class="form-control col-md-3" onchange="retrieveselection1('optiontable', 'levelid', this.value, 0, 0, 'retrieveselection4', 'opencontainer');">
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

                  <td id="opencontainer" class="col-md-3">
                            
                            <select  id="optionid" required="required" name="optionid" class="form-control col-md-3">
                            <option value="">--Select Option--</option> 
                          </select>                                                                                                                                                         
                       
                     </td>
                              <td class="col-md-3"><select  name="sessionid" id="sessionid" required="required"  class="form-control col-md-1 col-xs-3" >
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

                  <td class="col-md-3"> <input  type="submit" class="btn btn-primary" value="Search" class="col-md-3"  ></td>
             </tr>
           </tbody>
              </table>
            
            
             </fieldset>
             </form>
           
                  </div>  
                  <div><h3 style="color:green"><?php echo $sql; ?></h3></div>
                  <?php if ($page==1) {
                   $levelincrease="";
                    ?>  
                    <fieldset>

                        <legend style="color:#063"><?php echo $pagename; ?></legend>
                       
                        <form method="POST" action="?schoolhelp=<?php echo $schoolhelp; ?>&page=4" name="frmpromote">
                         
                            
                      <div class="x_panel" >
                         
                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <center><caption><h1><?php echo $levelname.' '.$optionname  ?></h1></caption></center>
                      <thead>
                        <tr>
                 
                                  <th>SN</th>
                                
                  <th><input name="topcheckbox"  type="checkbox" id='checkAll' value="" />  Select All</th>
                  <th>Student Name</th>
                  <th>Active Terms AVE</th>
                  <th title="Accumulated Average">ACC AVE</th>
                  <th>PassMark</th>
                  <th>Status</th>
                                    
                                    
                </tr>
                </thead>            
                       <?php 
                       ?>

                      <tbody>
                        <?php $k=0;
                              if ($levelrankactual>0) { 

                              $levelrankactual+=1; 
                               $levelincrease=0;


                               $leveldata1=$SHResultOOP->allresultedit('level', 'levelrank', $levelrankactual);
                              if (is_array($leveldata1)) {
                                foreach($leveldata1 as $levelrec1){ 
                                  $scoredeptid1=trim($levelrec1['departmentid']); 
                                  $tablename="result". $scoredeptid1;
                                    $levelname=trim($levelrec1['levelname']); 
                                    $levelrankincreased=trim($levelrec1['levelrank']); 
                                    $levelincrease=trim($levelrec1['levelid']);
                                  }
                              }   

                                if ($levelincrease==0 or $levelincrease=="") {
                                    $levelincrease=1000;
                                  }
                            }
                            ?>
                            
                           <?php  
                           //Getting the passmark or grade point of this particular
                              $passmark="";
                               $passmarkrecords=$SHResultOOP->allresultedit('passmark', 'levelid', $levelid);
                               if (is_array($passmarkrecords)) {
                                  foreach($passmarkrecords as $passmarkrecord){
                                $passmark=trim($passmarkrecord['passmark']); 

                                 }

                               }
                            
                            $records=$SHResultOOP->allresultedit2('students', 'levelid', $levelid, 'optid', $optionid);
                              if (is_array($records)) {
                              
                              foreach($records as $fieldrecord){
                               $k+=1;
                                $stid=trim($fieldrecord['stid']);
                               //remember that the averagesemester is fixed
                              $accaverage=0;
                              $totalscore=0;
                              $semestercount=0;
                              $averagesemester1=0;
                              $averagesemester2=0;
                              $averagesemester3=0;

                              $stid=trim($fieldrecord['stid']);
                             
                                  $surname=trim($fieldrecord['surname']);
                                  $othername=trim($fieldrecord['othername']);
                                  $regno=trim($fieldrecord['regno']);

                                //Getting average for 1st semester average
                              $rstrecords1=$SHResultOOP->studenttermscore($tablename, $stid, $levelid, 1, $sessionid);
                               if (is_array($rstrecords1)) {
                                  foreach($rstrecords1 as $rstrecord1){
                                      $cnt1+=1;
                                      $actualscore1+=trim($rstrecord1["score"]);
                                  }
                                      $averagesemester1=round($actualscore1/$cnt1, 2);
                                }else{
                                  $averagesemester1=0;
                                }

                              //Getting average for 2nd semester average
                              $rstrecords2=$SHResultOOP->studenttermscore($tablename, $stid, $levelid, 2, $sessionid);
                               if (is_array($rstrecords2)) {
                                $actualscore2=0;
                                $cnt2=0;
                                  foreach($rstrecords2 as $rstrecord2){
                                      $cnt2+=1;
                                      $actualscore2+=trim($rstrecord2["score"]);
                                  }
                                      $averagesemester2=round($actualscore2/$cnt2, 2);
                                }else{
                                  $averagesemester2=0;
                                }

                                 //Getting average for 3rd semester average
                              $rstrecords3=$SHResultOOP->studenttermscore($tablename, $stid, $levelid, 3, $sessionid);
                               if (is_array($rstrecords3)) {
                                  foreach($rstrecords3 as $rstrecord3){
                                      $cnt3+=1;
                                      $actualscore3+=trim($rstrecord3["score"]);
                                  }
                                      $averagesemester3=round($actualscore3/$cnt3, 2);
                                }else{
                                  $averagesemester3=0;
                                }
                               
                             if ($averagesemester1>0) {
                                $totalscore+=$averagesemester1;
                                $accaverage+=$averagesemester1;
                                $semestercount=1;
                               }
                               
                               if ($averagesemester1<=0 and $averagesemester2<=0 and $averagesemester3>0) {
                                $totalscore=$averagesemester3;
                                $accaverage=$averagesemester3;
                                $semestercount=1;
                               }


                               if ($averagesemester1>0 and $averagesemester2>0) {
                                $totalscore=$averagesemester1+$averagesemester2;
                                $semestercount+=1;
                                $accaverage=$totalscore/$semestercount;

                               }elseif($averagesemester1!=0 and $averagesemester2>0){
                                $totalscore+=$averagesemester2;
                                $accaverage=$totalscore;
                                $semestercount+=1;
                               }

                             
             
             
             
                                if ($semestercount==1 and $averagesemester3>0) {
                                
                                $totalscore+=$averagesemester3;
                                $semestercount+=1;
                                $accaverage=$totalscore/2;
                               }elseif ($semestercount==2 and $averagesemester3>0) {
                                $totalscore+=$averagesemester3;
                                $semestercount+=1;
                                $accaverage=$totalscore/3;
                               }
                               elseif ($semestercount==1 and $averagesemester3>0) {
                                $totalscore+=$averagesemester3;
                                $semestercount+=1;
                                $accaverage=$totalscore;
                               }

                                 if($averagesemester1==0  and $averagesemester3==0  and $averagesemester2>0 and $semestercount==0){
                                $totalscore+=$averagesemester2;
                                $accaverage=$totalscore;
                                
                               }

                               $accaverage=round($accaverage, 2);
                        ?>
                                     <tr height="23" onMouseOver="this.style.backgroundColor='#FFCC66';" onMouseOut="this.style.backgroundColor='';"> 
                                  
                  <td><?php echo $k;  ?></td>
                  
                                      <td> <input name="studid[]" id="<?php echo $fieldrecord['stid']; ?>" type="checkbox" class="status1"  value=""  onchange="if(this.checked){ this.value='<?php echo $fieldrecord["stid"] ?>'; }else{this.value='';}" /> </td>   
                  <td style="font-size:12px;"><?php  echo $fieldrecord['surname']." ". $fieldrecord['othername']; ?></td>
                  <td><b><span style="color:blue">1st:</span> <?php echo $averagesemester1; ?>, <span style="color:blue">2nd:</span> <?php echo $averagesemester2; ?>,<span style="color:blue">3rd:</span> <?php echo $averagesemester3; ?></b></td>
                  <td><?php echo $accaverage; ?> <input type="textbox" name="stu<?php echo $fieldrecord['stid'] ?>" value="<?php echo $accaverage; ?>" hidden="hidden"/></td>
                  <td><?php echo $passmark; ?></td>
                  <td><?php if ($passmark<=$accaverage) {?>
                    <span class="fa fa-check" title="passed" style="font-size:48px; color:green"></span>
                  <?php }else{ ?><span class="fa fa-close" style="font-size:48px; color:red" title="failed"></span><?php } ?></td>
                                                                                                                                
                </tr>

                <?php }
              
              ?>
                      </tbody>
                    </table>
                  
                    <table  class="table table-responsive">


              <tr>
                <td>
                  
                    
            <table width="100%"  style="margin-bottom: 20px">
            <tr>
               <td>class: </td>
                <td >
                  <select name="newlevelid" id="newlevelid"  class="form-control col-md-6 col-xs-12"  onchange="return loadoptionpromote('optiontable', 'levelid', this.value, 'loadoptionpromote', 'grouppromote')" required="required">
                        <option value="">--Select Level--</option>
                        <option value="1000" <?php if ($levelincrease==1000){ ?> selected="selected" <?php } ?>>--Completed--</option>
                        <?php
                          $promolevel=$SHResultOOP->greaterlevelorder('level', 'levelrank', $levelrankincreased, 'levelrank', 'ASC');
                          if (is_array($promolevel)) {
                          
                              $k = 0;
                          ?>
                        <?php  foreach($promolevel as $promolevelrec){   ?>
                        <option value="<?php echo  trim($promolevelrec['levelid']); ?>" <?php if (trim($promolevelrec['levelid'])==$levelincrease){ ?> selected="selected" <?php } ?>><?php echo  $promolevelrec['levelname']?></option>
                        <?php  } 
                      } ?>
                      </select>
                      <input type="hidden" name="oldlevelid" value="<?php echo $levelid; ?>" />
                      <input type="hidden" name="sessionid" value="<?php echo $sessionid; ?>" />  
                      <input type="hidden" name="passmark" value="<?php echo $passmark; ?>" /> 
                       <input type="hidden" name="oldoptionid" value="<?php echo $optionid; ?>" /> 
                       
                                                                                                                                                                                                                                                                                                                                            
                  </td>

                   <td style="padding-left:10px" >Option|Arm: </td>
                      <td style="padding-right:10px" id="grouppromote">
                     <?php  $retrievedata=$SHResultOOP->allresultedit('optiontable', 'levelid', $levelincrease); ?>  
                     <select  name="newoptionid" id="newoptionid" required="required"  class="form-control col-md-6 col-xs-12" onchange="enablingbutton('promotbutton');">
                       <option value="">--Select Option|Arm--</option>
                       <option value="2000">Completed</option>
                        <?php
                        if (is_array($retrievedata)) {
                          foreach($retrievedata as $field){
                        ?>
                              <option value="<?php echo $field['optid']; ?>"><?php echo $field['optname']; ?></option>
                        <?php
                            }
                          }

                        ?>
                              </select>
                         </td>
                  <td> <input  type="submit" class="btn btn-primary" value="Promote Students" id="promotbutton" disabled="disabled" /></td>
             </tr>

             
            </table>
            

                </td>
                  
                </tr>
           </table>
        </form>
         
      <?php
      }else {
      ?>
      <div style="text-align:center; color:red"><strong>Student Record not Available</strong></div>
      <?php } ?>

                    </div>
                  </form>

                    </fieldset>
                    <?php } ?>
                     
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

       

  </div>
</div>
  <script>

function attmark(){
  
     if(!confirm('Are you sure you want to promote the students ?')){
      return false;
      
    }
    else if(document.frmpromote.newlevelid.value == "") {
      alert ("Please select Promotion class");
      document.frmpromote.newlevelid.focus();
      return false;
      
    }
    else if(document.frmpromote.newoptionid.value == "") {
      alert ("Please select Promotion Option/Group");
      document.frmpromote.newoptionid.focus();
      return false;
      
    }
    
    else{
      return true;
    }
  }
  
</script>

<?php include("includes/footer.php"); ?>

<script type="text/javascript">
   $(window).load(function(){
        $('#myModal').modal('show');
    });
</script>