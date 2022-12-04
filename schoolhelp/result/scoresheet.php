<?php

include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHresultOOP.php");
include_once("../phpclass/SHresultupdate.php");
include_once("../phpclass/SHresultinserts.php");

confirmcheckin();
$SHResultOOP=new ClassResult;
$pagename="Result Score Sheet";
$tablestudents=new insertTable;
 $tableUpdate= new updateTable;

// Checking page access Authenticity


$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp=trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$page=trim(isset($_GET['page'])?$_GET['page']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

$previlleges=$SHResultOOP->allresultedit('adminpersons', 'adminid', $schoolhelp);
if (is_array($previlleges)) {
  
foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['scoresheet_r']);
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
     //$courseid=trim(isset($_POST['courseid'])?$_POST['courseid']:false);

                          // Getting the Department ID
                           
                          $leveldata=$SHResultOOP->allresultedit('level', 'levelid', $levelid);
                            if (is_array($leveldata)) {
                              foreach($leveldata as $levelrec){ 
                                $scoredeptid=trim($levelrec['departmentid']); 
                                $levelname=trim($levelrec['levelname']); 
                              }
                            }
                             $optiondata=$SHResultOOP->allresultedit('optiontable', 'optid', $optionid);
                            if (is_array($optiondata)) {
                              foreach($optiondata as $optionrec){ 
                               
                                $optionname=trim($optionrec['optname']); 
                              }
                            }

                             /*$coursedata=$SHResultOOP->allresultedit('course', 'csid', $courseid);
                            if (is_array($coursedata)) {
                              foreach($coursedata as $courserec){ 
                               
                                $coursename=trim($courserec['csname']); 
                              }
                            }*/

}


if ($page==4) {
  $k=0;
   $score_tbl_id="";
   $score_tbl_status="";
   $score_tbl_score="";
   $cumulative="";

   $stuaveragearray= array();

    $sessionid=trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);
    $semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
    $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
    $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);
    
    $deptid=trim(isset($_POST['deptid'])?$_POST['deptid']:false);

      $studid=isset($_POST['studid'])?$_POST['studid']:false;

     $udate=date("Y-m-d H:i:s");
     $odate=date("Y-m-d");
      $bno = count($studid);
      $Cnt = 0;
      $stuNo = $bno;
      $Cnt333 = 0;
       $status=1;
      
  if ($bno>0) {

    $resulttblname="result".$deptid;
    $positiontblname="position".$deptid;
    $scoretblname="score".$deptid;
        $insertedrow=0;
      for($i=0; $i < $bno; $i++){

      $acumupositionscore="";
      $stid= (int)$studid[$i];
      $assessmentid="";
      $deptid=trim(isset($_POST['deptid'])?$_POST['deptid']:false);

        $course1=$SHResultOOP->allresultedit('course', 'departmentid', $deptid);
                            if (is_array($course1)) {
                              foreach($course1 as $courserec1){ 
                                $csid=trim($courserec1['csid']);
                                $courseid=trim($courserec1['csid']);
                                $cumuresultscore="";
                                $cumuresultscore1="";
                                $cumuresultscore2="";
                                $cumuresultscoreplus="";
                              
                                $studentsubjectscore= "subjtotalscore".trim($stid).trim($courserec1['csid']);
                                //$courseid1= "subjtotalscore".trim($stid).trim($courserec1['csid']);

                                $studentsubjectscore1=trim(isset($_POST["{$studentsubjectscore}"])?$_POST["{$studentsubjectscore}"]:false);
                                 //$courseid=trim(isset($_POST["{$courseid1}"])?$_POST["{$courseid1}"]:false);

                                //Getting Previous Term/semester Result Score 
                                if ($semesterid==2) {

                                  $resultcheck=$SHResultOOP->allresultedit6($resulttblname, 'stid', $stid, 'levelid', $levelid, 'optionid', $optionid, 'courseid', $courseid, 'semesterid', 1, 'sessionid', $sessionid);
                                   if (is_array($resultcheck)) {
                                    foreach($resultcheck as $resultcheckrec){ 
                                      $cumuresultscore=trim($resultcheckrec['score']);
                                    }
                                  }

                                  $cumuresultscoreplus=$cumuresultscore;

                                }

                                 if ($semesterid==3) {

                                    $resultcheck=$SHResultOOP->allresultedit6($resulttblname, 'stid', $stid, 'levelid', $levelid, 'optionid', $optionid, 'courseid', $courseid, 'semesterid', 1, 'sessionid', $sessionid);
                                   if (is_array($resultcheck)) {
                                    foreach($resultcheck as $resultcheckrec){ 
                                      $cumuresultscore=trim($resultcheckrec['score']);
                                    }
                                  }

                                  $resultcheck1=$SHResultOOP->allresultedit6($resulttblname, 'stid', $stid, 'levelid', $levelid, 'optionid', $optionid, 'courseid', $courseid, 'semesterid', 2, 'sessionid', $sessionid);
                                   if (is_array($resultcheck1)) {
                                    foreach($resultcheck1 as $resultcheckrec1){ 
                                      $cumuresultscore1=trim($resultcheckrec1['score']);
                                    }
                                  }   

                                  $cumuresultscoreplus=$cumuresultscore+$cumuresultscore1;
                                 
                                }

                                $cumuresultscoreplus+=$studentsubjectscore1;
                                 
                              //checking whether result has been submitted before
                                 $resultscoredata=$SHResultOOP->allresultedit6($resulttblname, 'stid', $stid, 'levelid', $levelid, 'optionid', $optionid, 'courseid', $courseid, 'semesterid', $semesterid, 'sessionid', $sessionid);
                                if (is_array($resultscoredata)) {
                                  foreach($resultscoredata as $resultdatarec){ 
                                    $result_tbl_id=trim($resultdatarec['resultid']);
                                    $result_tbl_status=trim($resultdatarec['status']);
                                    $result_tbl_score=trim($resultdatarec['score']);
                                  }
                              //Updating Result
                              
                             
                            $state= $tableUpdate->update_result($resulttblname, 'resultid', $result_tbl_id, 'score',  $studentsubjectscore1, 'cumulative',  $cumuresultscoreplus, 'operatorid', $schoolhelp, 'udate', $udate);
                              //Counting number of record that updated
                                  if ($state=="Success") {
                                    $k+=1;
                                  }
                      
                            }else{
                              //check whether the input box is empty
                              if ($studentsubjectscore1!="") {
                                //Inserting New Score
                                
                                  
                                  $state=$tablestudents->insert_result($resulttblname, $sessionid, $semesterid, $levelid, $optionid, $stid, $courseid, $studentsubjectscore1, $cumuresultscoreplus, 'operatorid', $schoolhelp, 'udate', $udate, $odate);
                                  $insertedrow+=$state['counting'];
                              }

                            }

                             //Updating the status of student score
                                 $statusupdate=$tableUpdate->update_scorestatus($scoretblname, 'status', $status, 'operatorid', $schoolhelp, 'udate', $udate, $sessionid, $semesterid, $levelid, $optionid, $stid);
                            
                }
              }
              //Position Result Table

              //To initialize array offset
                                if (!isset($stuaveragearray[$stid])) {
                                  $stuaveragearray[$stid] = '';
                                }
               
                 $studentaveragescore= "averagescore".trim($stid);
              $stuaveragearray[$stid]=trim(isset($_POST["{$studentaveragescore}"])?$_POST["{$studentaveragescore}"]:false); 

                
       }//Closing Student loop
      
                $counter=0;
                 $positiontblname='positionresult'.trim($deptid);
                 
                  $actualposition="";
                  $positionk="";
                  $positionrow="";
                //checks of equal average
                $equalave="";
                arsort($stuaveragearray); //sorting array in descending order

                foreach($stuaveragearray as $studentid => $studentave) {
                  $counter+=1;
                  $actualposition=$counter;
                  $p=0;
                //checking whether an average is not empty
                  if ($studentave>0) {
                 
                 //checking 4 tally average, so to calculate position very well
                    if ($studentave==$equalave) {
                      $p=1;
                      $actualposition-=$p;
                    }
                  
                // Getting student total score  
                 $studenttotalscore="totalscore".trim($studentid);
                 $studenttotalscore1=trim(isset($_POST["{$studenttotalscore}"])?$_POST["{$studenttotalscore}"]:false);


                // Getting student total no of subject
                 $stucoursecount="coursecount".trim($studentid);
                $stucoursecount1=trim(isset($_POST["{$stucoursecount}"])?$_POST["{$stucoursecount}"]:false);

                $cumupositionscore="";
                $cumupositionscore1="";
                $cumupositionscoreplus="";
                $cumupositionave="";
                $cumupositionave1="";
                $cumupositionaveplus="";
                $divide="";
                //Getting Previous Term/semester position Score

                                if ($semesterid==2) {

                                  $positioncheck=$SHResultOOP->allpositionedit5($positiontblname, 'stid', $studentid, 'levelid', $levelid, 'optionid', $optionid, 'semesterid', 1, 'sessionid', $sessionid);
                                   if (is_array($positioncheck)) {
                                    foreach($positioncheck as $positioncheckrec){ 
                                      $cumupositionscore=trim($positioncheckrec['score']);
                                      $cumupositionave=trim($positioncheckrec['average']);
                                        if ($cumupositionave=="") {
                                          $divide+=1;
                                        }
                                    }
                                  }
                                  if ($cumupositionave!="" and $cumupositionave!="") {
                                          $divide+=1;
                                        }

                                  $cumupositionscoreplus=$cumupositionscore;
                                  $cumupositionaveplus=$cumupositionave;

                                }

                                 if ($semesterid==3) {

                                    $positioncheck=$SHResultOOP->allpositionedit5($positiontblname, 'stid', $studentid, 'levelid', $levelid, 'optionid', $optionid,  'semesterid', 1, 'sessionid', $sessionid);
                                   if (is_array($positioncheck)) {
                                    foreach($positioncheck as $positioncheckrec){ 
                                      $cumupositionscore=trim($positioncheckrec['score']);
                                      $cumupositionave=trim($positioncheckrec['average']);

                                       if ($cumupositionave!="" and $cumupositionave!="") {
                                          $divide+=1;
                                        }
                                    }
                                  }

                                  $positioncheck1=$SHResultOOP->allpositionedit5($positiontblname, 'stid', $studentid, 'levelid', $levelid, 'optionid', $optionid,  'semesterid', 2, 'sessionid', $sessionid);
                                   if (is_array($positioncheck1)) {
                                    foreach($positioncheck1 as $positioncheckrec1){ 
                                      $cumupositionscore=trim($positioncheckrec1['score']);
                                       $cumupositionave1=trim($positioncheckrec1['average']);
                                    }
                                  }   

                                   if ($cumupositionave1!="" and $studentave!=0) {
                                          $divide+=1;
                                        }

                                  $cumupositionscoreplus=$cumupositionscore+$cumupositionscore1;
                                  $cumupositionaveplus= $cumupositionave+ $cumupositionave1;
                                 
                                }

                               

                                $cumupositionscoreplus+=$studenttotalscore1;
                                if ($studentave!="" and $studentave!=0) {
                                    $divide+=1;
                                }
                                $cumupositionaveplus+=$studentave;
                                $cumupositionaveplus=round(($cumupositionaveplus/$divide), 2);
                                 //checking whether position result has been submitted before
                                 $positionresult=$SHResultOOP->allpositionedit5($positiontblname, 'stid', $studentid, 'levelid', $levelid, 'optionid', $optionid,  'semesterid', $semesterid, 'sessionid', $sessionid);

                            if (is_array($positionresult)) {
                              foreach($positionresult as $positionresultrec){ 
                                $posi_tbl_id=trim($positionresultrec['positionid']);
                              }
                              //Updating Result

                            $state= $tableUpdate->update_position($positiontblname,  $posi_tbl_id,  $studenttotalscore1, $cumupositionscoreplus,  $studentave,  $cumupositionaveplus,  $stucoursecount1, $actualposition, 'operatorid', $schoolhelp, 'udate', $udate);
                              //Counting number of record that updated
                                  if ($state=="Success") {
                                    $positionk+=1;
                                  }
                      
                            }else{
                              //check whether the input box is empty
                              if ($studenttotalscore1!="") {
                                //Inserting New Score
                                
                                  $tablestudents=new insertTable;
                                  $state=$tablestudents->insert_position($positiontblname, $sessionid, $semesterid, $levelid, $optionid, $studentid, $studenttotalscore1, $cumupositionscoreplus, $studentave,  $cumupositionaveplus,  $stucoursecount1, $actualposition, 'operatorid', $schoolhelp, 'udate', $udate, $odate);
                                  $positionrow+=$state['counting'];
                              }

                            }

                            //Getting Student average assign to another variable
                             $equalave=$studentave;
                             
                    }// Closing of checking whether student average is greater than zero

                    
                  }

                  

       $inserting="No of inserted result record=".$insertedrow;
       $updating="No of updated result record=".$k;

       $inserting1="No of inserted position record=".$insertedrow;
       $updating1="No of updated position record=".$positionk;

       $sql=$inserting.';  '.$updating.' \n '.$inserting1.';  '.$updating1;
       
       echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
      
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
                          <li ><a  href="template?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  View Template</a></li>
                           <li ><a  href="scoreupload?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> Score Upload</a></li>
                           <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> Score Sheet</a></li>
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
                        <legend>Score Sheet</legend>
                        
                             
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
           
                  </div>  
                  <div><h3 style="color:green"><?php echo $sql; ?></h3></div>
                  <?php if ($page==1) {
                    $x=0;
                    $score_tbl_id=""; 
                     $score_tbl_score="";
                     $score_status="";
                     $assessmentid="";
                     $overallcount="";
                    ?>  
                    <fieldset>
                        <legend style="color:#063"> Score Sheet</legend>
                        <form method="POST" action="?schoolhelp=<?php echo $schoolhelp; ?>&page=4" name="frmscoresheet">
                          <input name="optionid"  id="optionid" value="<?php  echo trim($optionid); ?>" type="hidden"/>
                          <input name="levelid"  id="levelid" value="<?php  echo trim($levelid); ?>" type="hidden"/>
                          <input name="semesterid"  id="semesterid" value="<?php  echo trim($semesterid); ?>" type="hidden"/>
                          <input name="sessionid"  id="sessionid" value="<?php  echo trim($sessionid); ?>" type="hidden"/>
                          
                          <input name="deptid"  id="deptid" value="<?php  echo trim($scoredeptid); ?>" type="hidden"/>

                          <?php //Checking whether result has been finalized 
                           $positiontblname='positionresult'.trim($scoredeptid);
                               $positioncheck2=$SHResultOOP->allpositionedit4($positiontblname,  'levelid', $levelid, 'optionid', $optionid,  'semesterid', $semesterid, 'sessionid', $sessionid);
                                  
                          ?>
                          <div><h3 style="color:green"><?php echo $sql; ?></h3></div>  
                      <div class="x_panel" >
                       
                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <center><caption><h1><?php echo $levelname.'  => '.$optionname ; ?></h1></caption></center>
                      <thead>
                        <tr>
                          <th>SN</th>
                      
                          <th>Fullname</th>
                        
                          <?php
                          $coursedata=$SHResultOOP->allresultedit('course', 'departmentid', $scoredeptid);
                            if (is_array($coursedata)) {
                              foreach($coursedata as $courserec){ 
                            ?>
                              <th ><span class="vertical"><?php echo $courserec['csname']; ?></span></th>
                           <?php   }
                            }
                            ?>
                           <th><span class="vertical">Total</span></th>
                          <th ><span class="vertical">Average</span></th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 

                            ?>
                            
                           <?php  
                           $coursescoretotal=array();
                            $scoretblname="score".$scoredeptid;
                            $overalltotal="";
                            $overallaverage="";
                            $records=$SHResultOOP->allresultedit3('students', 'levelid', $levelid, 'optid', $optionid, 'status', 0);
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                               $k+=1;
                               
                               $stid=trim($fieldrecord['stid']);
                        ?>
                                      <tr cellspacing="0px" cellpadding="0px">
                                        <td><?php echo  $k; ?><input name="studid[]"  id="studid[]" value="<?php  echo trim($fieldrecord['stid']); ?>" type="hidden"/></td>
                                        
                                        <td  style="border-collapse: collapse; padding: 0px; ">
                                          <table >
                                            <tr >
                                            <td  ><?php echo  $fieldrecord['surname'].' '.$fieldrecord['othername']; ?></td>
                                            <td > 
                                                                       
                                        <?php
                            $assessmentdata1=$SHResultOOP->allresultedit('assessment', 'departmentid', $scoredeptid);
                            if (is_array($assessmentdata1)) {?>
                            <table class="table"  cellspacing="0px" cellpadding="0px" style="border-collapse: collapse;  padding: 0px;  margin:0px;"  > 
                             <?php  foreach($assessmentdata1 as $assessmentrec1){ ?>
                                    <tr style="border-collapse: collapse">
                                      <td style="border-bottom:1px solid black; color:#060" ><?php echo $assessmentrec1['assname'].' :' ?></td>
                                    </tr>
                            <?php } ?>
                                    <tr>
                                      <td style="border-bottom:1px solid black;  padding-bottom: 0px;  color:#060" >Total:</td>
                                    </tr>
                                    </table>
                            <?php }else{echo "Assessments not assigned yet to this department"; }
                            ?></td>
                                    </tr>
                                  </table>
                                  </td>  
                                  <?php 
                                  
                                  $coursecount="";
                                  $studenttotal="";
                                  $studentaverage="";
                              if (is_array($coursedata)) {
                              foreach($coursedata as $courserec1){ 
                                $actualscore="";
                                $csid=$courserec1['csid'];
                               
                                //To initialize array offset
                                if (!isset($coursescoretotal[$csid])) {
                                  $coursescoretotal[$csid] = '';
                                }
                              ?> 
                            <td style="padding: 0px; margin:0px; border-collapse: collapse;" cellspacing="0px" cellpadding="0px">
                            <?php  if (is_array($assessmentdata1)) {?>
                            <table class="table"  cellspacing="0px" cellpadding="0px" style="border-collapse: collapse;  padding: 0px;  margin:0px;"  > 
                             <?php  foreach($assessmentdata1 as $assessmentrec2){                              
                                ?>
                                    <tr style="border-collapse: collapse; ">
                                      <td  >
                                      <?php //checking whether last score has been submitted
                                 $scoredata=$SHResultOOP->allresultedit7($scoretblname, 'stid', $stid, 'levelid', $levelid, 'optionid', $optionid, 'courseid', trim($courserec1['csid']), 'assessmentid', trim($assessmentrec2['assid']), 'semesterid', $semesterid, 'sessionid', $sessionid);
                                  if (is_array($scoredata)) {
                                    foreach($scoredata as $scoredatarec){ 
                                      echo trim($scoredatarec['score']);
                                      $actualscore+=trim($scoredatarec['score']);

                                     $coursescoretotal[$csid]+=trim($scoredatarec['score']);
                                    }
                                   
                                  }

                                  ?>
                              
                            </td>
                            </tr>
                                 <?php 

                            } ?>
                                    <tr>
                                      <td style="color:#060; padding-left: 5px; border-bottom: 1px solid black; padding-bottom: 0px"><span <?php if ($actualscore<$courserec1['cspassmark']) {?> style="color:red" <?php } ?>><?php echo $actualscore; ?></span>
                                        <input type='text' name='<?php echo "course".trim($fieldrecord["stid"]).trim($courserec1['csid']); ?>' value='<?php echo trim($courserec1['csid']); ?>'  hidden />
                                         <input type='text' name='<?php echo "subjtotalscore".trim($fieldrecord["stid"]).trim($courserec1['csid']); ?>' value='<?php echo $actualscore; ?>'  hidden />
                                      </td>
                                    </tr>
                                    </table>
                            <?php 

                            
                            
                          }else{echo "Assessments not assigned yet to this department"; }

                          $studenttotal+=$actualscore;
                            if ($actualscore!="") {
                                        $coursecount+=1;
                                      }
                            ?></td>

                                    
                           <?php   }
                            }
                            if ($coursecount>0 and $studenttotal >0) {
                              $studentaverage=round($studenttotal/$coursecount, 2);
                              $overallcount+=$coursecount;
                            }
                            
                            $passmark="";
                            //Getting the passmark o a class
                              $passmarkdata=$SHResultOOP->allresultedit('passmark', 'passmarkid', trim($fieldrecord["levelid"]));
                            if (is_array($passmarkdata)) { 
                                foreach($passmarkdata as $passmarkrec){
                                  $passmark2=$passmarkrec['passmark'];
                                }
                              }
                            ?>
                              <td style="vertical-align: bottom;"><?php echo $studenttotal; ?> <input type='text' name='<?php echo "totalscore".trim($fieldrecord["stid"]); ?>' value="<?php echo $studenttotal; ?>"   hidden/>  <input type='text' name='<?php echo "coursecount".trim($fieldrecord["stid"]); ?>' value="<?php echo $coursecount; ?>" hidden></td>
                              <td  style="vertical-align: bottom;" <?php if ($studentaverage< $passmark2) {?> style="color:red"   <?php }?> ><?php echo $studentaverage; ?> <input type='text' name='<?php echo "averagescore".trim($fieldrecord["stid"]); ?>' value="<?php echo $studentaverage; ?>"   hidden/></td>                                      
                            </tr>

                             <?php }
                              }
                             ?>
                             
                      </tbody>
                       <tr style="color:green">
                              <td></td>
                              <td>Total</td>
                              <?php 
                              $averagetotal="";

                              if (is_array($coursedata)) {
                              foreach($coursedata as $courserec2){  
                                $csid2=$courserec2['csid'];
                                //Initiating the offset of this array
                                if (!isset($coursescoretotal[$csid2])) {
                                  $coursescoretotal[$csid2]="";
                                }
                                ?>
                              <td><?php echo $coursescoretotal[$csid2] ?></td>
                              <?php }
                                  }
                                  $arraytotal="";
                                  foreach($coursescoretotal as $totalallover){
                                    $arraytotal+=$totalallover;
                                  }
                              ?>
                              <td><?php echo $arraytotal; ?></td>
                              <td><?php if ($arraytotal>0) {
                                echo round($arraytotal/$overallcount, 2);
                              }  ?></td>
                            </tr>
                    </table>
                  
                     <div class="row no-print" style="margin-bottom: 50px">
                        <div class="col-xs-12">
                         <?php if ($positioncheck2!="") {?>
                         <div class="col-xs-6"><button type="submit" class="btn btn-success"  onClick="return generateresult('<?php echo $schoolhelp; ?>', 4)"><i class="fa fa-send"></i> Update Result</button></div>
                          <div class="col-xs-6"><button type="submit" class="btn btn-success " onClick="return broadsheet('<?php echo $schoolhelp; ?>', 2)"><i class="fa fa-send"></i> Print Broadsheet</button></div>
                         <?php } else{ ?>
                          <div class="col-xs-6"><button type="submit" class="btn btn-success" onClick="return generateresult('<?php echo $schoolhelp; ?>', 4)"><i class="fa fa-send"></i> Generate Result</button></div>
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

       <?php include("includes/footer.php"); ?>

       