<?php
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHcbtOOP.php");
include_once("../phpclass/SHcbtupdate.php");
include_once("../phpclass/SHcbtinserts.php");
include_once("../phpclass/SHcbtothers.php");

confirmcheckin();

$SHCbtOOP=new ClassCbt;
$pagename="CBT Score Sheet";
$tablestudents=new insertTable;
$SHcbtupdate= new updateTable;


// Checking page access Authenticity


$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp=trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$page=trim(isset($_GET['page'])?$_GET['page']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

$previlleges=$SHCbtOOP->allcbtedit('adminpersons', 'adminid', $schoolhelp);
if ($previlleges) {
  
foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['cbt_d']);
  $dashadd_d=trim($actualrecord['dashadd_d']);
  
}

}


if ($pageaccess!=1) {
  echo "<b style='font-size:100; color:red'>Criminal Attempt Made, contact the admin ask for the access of this page</b>";
  exit();
}

//This script is to determine the actual admin that is logging whether a super admin or a position holder in a school
$admindata=$SHCbtOOP->allcbtedit('adminpersons', 'adminid', $schoolhelp);
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

$signatorydata=$SHCbtOOP->allcbtedit('signatoryposition', 'signatorypositionid', $signatorypositionid);
if (is_array($signatorydata)) {
  foreach($signatorydata as $signatoryrec){
   $departmentid=$signatoryrec['departmentid'];
  }
}

}


if ($page==1) {
    $classtype="";

  if (empty($sql)) {

    $sessionid=trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);
    $semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
    $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
    $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);
    $courseid=trim(isset($_POST['courseid'])?$_POST['courseid']:false);

  }else{

    $sessionid= trim(isset($_GET['sessionid'])?$_GET['sessionid']:false);
    $semesterid= trim(isset($_GET['semesterid'])?$_GET['semesterid']:false);
    $levelid= trim(isset($_GET['levelid'])?$_GET['levelid']:false);
    $optionid= trim(isset($_GET['optionid'])?$_GET['optionid']:false);
    $courseid= trim(isset($_GET['courseid'])?$_GET['courseid']:false);

  }


                          // Getting the Department ID 
                          $leveldata=$SHCbtOOP->allcbtedit('level', 'levelid', $levelid);
                            if (is_array($leveldata)) {
                              foreach($leveldata as $levelrec){ 
                                $scoredeptid=trim($levelrec['departmentid']); 
                                $levelname=trim($levelrec['levelname']); 
                                $classtype=trim($levelrec['classtype']);
                              }
                            }

                             $optiondata=$SHCbtOOP->allcbtedit('optiontable', 'optid', $optionid);
                            if (is_array($optiondata)) {
                              foreach($optiondata as $optionrec){ 
                                $optionname=trim($optionrec['optname']); 
                              }
                            }

                             $coursedata=$SHCbtOOP->allcbtedit('course', 'csid', $courseid);
                            if (is_array($coursedata)) {
                              foreach($coursedata as $courserec){ 
                                $coursename=trim($courserec['csname']); 
                              }
                            }

                              $sessiondata=$SHCbtOOP->allcbtedit('session', 'sessionid', $sessionid);
                            if (is_array($sessiondata)) {
                              foreach($sessiondata as $sessionrec){ 
                                $sessionname=trim($sessionrec['sessionlow']."/".$sessionrec['sessionhigh']); 
                              }
                            }

                               $semesterdata=$SHCbtOOP->allcbtedit('semesters', 'semesterid', $semesterid);
                            if (is_array($semesterdata)) {
                              foreach($semesterdata as $semesterrec){ 
                                $semestername=trim($semesterrec['semestername']); 
                              }
                            }

                            $quizsetupid='';
                            $quizsetupdetials=$SHCbtOOP->allcbtedit5('quiz_setup', 'semesterid', $semesterid, 'sessionid', $sessionid, 'courseid', $courseid, 'optionid', $optionid, 'levelid', $levelid);
                            if (is_array($quizsetupdetials)) {
                              foreach($quizsetupdetials as $quizsetuprec){ 
                                $quizsetupid=trim($quizsetuprec['qid']); 
                                $totalquestion=trim($quizsetuprec['no_of_question']);
                                $passmark=trim($quizsetuprec['passmark']);
                                $totalscore=trim($quizsetuprec['totalscore']);
                                $totaltime=trim($quizsetuprec['totaltime']);
                              }
                               if ($totalscore!="") {
                                $score=$totalscore/$totalquestion;
                               }
                            }
                               
                            
                            
                           
}


if ($page==4) {

  $quiztimerid= trim(isset($_GET['quiztimerid'])?$_GET['quiztimerid']:false);
  $sessionide=trim(isset($_POST['sessionide'.$quiztimerid])?$_POST['sessionide'.$quiztimerid]:false);
  $semesteride=trim(isset($_POST['semesteride'.$quiztimerid])?$_POST['semesteride'.$quiztimerid]:false);
  $levelide=trim(isset($_POST['levelide'.$quiztimerid])?$_POST['levelide'.$quiztimerid]:false);
  $optionide=trim(isset($_POST['optionide'.$quiztimerid])?$_POST['optionide'.$quiztimerid]:false);
  $courseide=trim(isset($_POST['courseide'.$quiztimerid])?$_POST['courseide'.$quiztimerid]:false);
  $stide=trim(isset($_POST['stide'.$quiztimerid])?$_POST['stide'.$quiztimerid]:false);
  $quizsetupide=trim(isset($_POST['quizsetupide'.$quiztimerid])?$_POST['quizsetupide'.$quiztimerid]:false);
  $sql="Action Reversed";

  echo "<script>
  if(!confirm('Are you sure you want to enable this CBT for the student to complete test'))
   window.location.href='?schoolhelp=$schoolhelp&page=1&sql=$sql&sessionid=$sessionide&semesterid=$semesteride&levelid=$levelide&optionid=$optionide&courseid=$courseide';
  </script>";

  $updatequiztimer=$SHcbtupdate->updateonecheckone('quiz_result_timer', 'status', 0, 'qrtid', $quiztimerid);

 
  $sql=$updatequiztimer." Update";
 
  echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&page=1&sql=$sql&sessionid=$sessionide&semesterid=$semesteride&levelid=$levelide&optionid=$optionide&courseid=$courseide';
      </script>";

}


if ($page==6) {

  $quiztimerid= trim(isset($_GET['quiztimerid'])?$_GET['quiztimerid']:false);
  $sessionidd=trim(isset($_POST['sessionidd'.$quiztimerid])?$_POST['sessionidd'.$quiztimerid]:false);
  $semesteridd=trim(isset($_POST['semesteridd'.$quiztimerid])?$_POST['semesteridd'.$quiztimerid]:false);
  $levelidd=trim(isset($_POST['levelidd'.$quiztimerid])?$_POST['levelidd'.$quiztimerid]:false);
  $optionidd=trim(isset($_POST['optionidd'.$quiztimerid])?$_POST['optionidd'.$quiztimerid]:false);
  $courseidd=trim(isset($_POST['courseidd'.$quiztimerid])?$_POST['courseidd'.$quiztimerid]:false);
  $stidd=trim(isset($_POST['stidd'.$quiztimerid])?$_POST['stidd'.$quiztimerid]:false);
  $quizsetupidd=trim(isset($_POST['quizsetupidd'.$quiztimerid])?$_POST['quizsetupidd'.$quiztimerid]:false);
  $sql="Action Reversed";

  echo "<script>
  if(!confirm('Are you sure you want to delete this Student`s accrued CBT Records'))
   window.location.href='?schoolhelp=$schoolhelp&page=1&sql=$sql&sessionid=$sessionidd&semesterid=$semesteridd&levelid=$levelidd&optionid=$optionidd&courseid=$courseidd'
  </script>";
  
 
  $updatequiztimer=$SHcbtupdate->delete_cbt('quiz_result_timer', 'qrtid', $quiztimerid);
  $updatequiztimer1=$SHcbtupdate->delete_cbt2('quiz_result', 'stid', $stidd, 'qsid', $quizsetupidd);
  $sql=$updatequiztimer." Update";
 
  echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&page=1&sql=$sql&sessionid=$sessionidd&semesterid=$semesteridd&levelid=$levelidd&optionid=$optionidd&courseid=$courseidd';
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
                          <li ><a  href="managecbtresult?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  Manage CBT</a></li>
                           <li ><a  href="cbtbroadsheet?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> CBT Broadsheet</a></li>
                           <li ><a  href="scoretransfer?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> CBT Score Transfer</a></li>
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
                        <legend>Manage CBT Result</legend>
                        
                             
                      <table >
                        <thead>
                          <tr>
                            <th class="col-md-2">Session</th>
                            <th class="col-md-2">Semester/Term</th>
                            <th class="col-md-2">Level/Class: </th>
                            <th class="col-md-2"><table><tr><td class=" col-md-2">Option/Arm:  </td><td align="right" class=" col-md-2">Courses/Subject: </td></tr></table></th>                
                            <th class=" col-md-2">Action: </th>
                          </tr>
                        </thead>
                        <tbody>
                         <tr>
                          
                              <td class="col-md-2"><select  name="sessionid" id="sessionid" required="required"  class="form-control col-md-1 col-xs-2" >
                               <option value="">--Select Session--</option>
                              <?php
                               $retrievedata1=$SHCbtOOP->allcbt('session', 'sessionid', 'desc');
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
                              $retrievedata=$SHCbtOOP->allcbt('semesters', 'semesterid', 'desc');
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
                        <select  id="levelid" required="required" name="levelid" class="form-control col-md-2" onchange="retrieveselection1('optiontable', 'levelid', this.value, 0, 0, 'retrieveselection', 'opencontainer');">
                            <option value="">--Select Level--</option>
                            <?php
                            $levelmethod=$SHCbtOOP->allcbt('level','levelid','asc');
                            if (is_array($levelmethod)) {
                            foreach($levelmethod as $leveldata){

                               $deptdata=$SHCbtOOP->allcbtedit('department', 'did', $leveldata['departmentid']);
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
                          <select  id="optionid" required="required" name="optionid" class="form-control col-md-2" >
                            <option value="">--Select Option--</option> 
                          </select>                                                                                                                                                         
                       </td>
                        <td >
                            <select  id="courseid" required="required" name="courseid" class="form-control col-md-2" >
                            <option value="">--Select Course--</option>
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
                          $k = 0;
                          $statuswork=0;
                    ?>  
                    <fieldset>
                        <legend style="color:#063"> CBT Score Management</legend>
                       
                          <input name="optionid"  id="optionid" value="<?php  echo trim($optionid); ?>" type="hidden"/>
                          <input name="levelid"  id="levelid" value="<?php  echo trim($levelid); ?>" type="hidden"/>
                          <input name="semesterid"  id="semesterid" value="<?php  echo trim($semesterid); ?>" type="hidden"/>
                          <input name="sessionid"  id="sessionid" value="<?php  echo trim($sessionid); ?>" type="hidden"/>
                           <input name="courseid"  id="courseid" value="<?php  echo trim($courseid); ?>" type="hidden"/>
                          <input name="deptid"  id="deptid" value="<?php  echo trim($scoredeptid); ?>" type="hidden"/>
                            
                      <div class="x_panel" >
                       
                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <center><caption><h1><?php echo $levelname.' '.$optionname .' => '.$coursename. ' ( '.$semestername. ' of '. $sessionname .' ) ' ; ?> </h1></caption></center>
                      <thead>
                        <tr>
                        <th>SN</th>
                        <th>Fullname</th>
                        <th align="center">Score</th>
                        <th align="center">Pass Mark</th>
                        <th align="center">Total Score</th>
                        <th align="center">Correct</th>
                        <th align="center">Wrong</th>
                        <th align="center">No Attempt</th>
                        <th align="center">Used Time</th> 
                        <th align="center">Total Time</th> 
                        <th align="center">CBT Status</th>
                        <th align="center">Action</th>     
                          
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 

                            ?>
                            
                           <?php  
                           
                            $status_stateacc=0;  $x=0;
                            
                            $records=$SHCbtOOP->allcbtedit3('students', 'levelid', $levelid, 'optid', $optionid, 'status', 0);
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                               $k+=1;

                               $cbtusedtime="";
                               $totaltimeremaining="";
                               $quizsetup="";
                               $quiztimerid="";
                               $stid="";

                                      if ($quizsetupid!="") {
                                        $stid=trim($fieldrecord['stid']);

                                          $records1=$SHCbtOOP->allcbtedit2('quiz_result', 'qsid', $quizsetupid, 'stid', $stid);
                                          if (is_array($records1)) {
                                            $totalansweredques=count($records1);
                                          }

                                          $records2=$SHCbtOOP->allcbtedit2('quiz_result_timer', 'qsetupid', $quizsetupid, 'stid', $stid);
                                          if (is_array($records2)) {
                                             foreach($records2 as $fieldrecord2){
                                              $totaltimeremaining=trim($fieldrecord2['questime']);
                                              $quiztimerid=trim($fieldrecord2["qrtid"]);
                                              $quizsetup=trim($fieldrecord2["status"]);
                                             }

                                             
                                            
                                          }
                                          //Time Conversion
                                              //echo "Time Actually Remaining".
                                              $totaltimetoseconds=cbt_time_conversion::to_seconds($totaltime);

                                              //echo "Seconds Remaining".
                                              $cbtremainingtimetoseconds=cbt_time_conversion::to_seconds($totaltimeremaining);
                                              $cbtusedtime=$totaltimetoseconds-$cbtremainingtimetoseconds;
                                          $returnusedtime=cbt_time_conversion::completetime($cbtusedtime);

                                          //Checking Student Rightly and wrongly answered questions

                                          $notanswered="";
                                          $correctanswer="";
                                          $wronganswer="";
                                          //checking Result Details
                                          $resultsummary=$SHCbtOOP->allcbtedit2orderlimit('quiz_result', 'stid', $stid, 'qsid', $quizsetupid, 'rid', 'ASC', $totalquestion);
                                          if (is_array($resultsummary)) {
                                                  foreach($resultsummary as $resultsummaryrec){
                                                   $qsid=trim($resultsummaryrec['qsid']);
                                                   $quesid=trim($resultsummaryrec['quesid']);
                                                   $answer=trim($resultsummaryrec['answer']);   

                                                       //Checking the answered question
                                                       $quizansquest=$SHCbtOOP->allcbtedit2('quiz_question', 'quiz_setup_id', $quizsetupid, 'quiz_ques_id', $quesid);
                                                        if (is_array($quizansquest)) {
                                                                foreach($quizansquest as $quizansquestrec){
                                                                 
                                                                  if($answer==5){
                                                                      $notanswered+=1;
                                                                      }
                                                                    elseif($answer==trim($quizansquestrec['ans'])){
                                                                      $correctanswer+=1;
                                                                      }
                                                                    else{
                                                                      $wronganswer+=1;
                                                                    }
                                                        

                                                            }
                                                        }
                                              }
                                          }

                                        if(!is_numeric($wronganswer)){
                                            $wronganswer=0;
                                        }
                                        if(!is_numeric($correctanswer)){
                                            $correctanswer=0;
                                        }
                                         $notanswered=$totalquestion-($correctanswer+$wronganswer);
                                      
                                        $scored=round($score*$correctanswer, 2);
                                        //-------------------------------------
                                        if($totaltimeremaining==""){
                                            $scored="-";
                                            $correctanswer="-";
                                            $wronganswer="-";
                                            $returnusedtime="-";
                                        }
                        ?>
                                      <tr>
                                        <td  align="center"><?php echo $k;  ?></td>
                 
                                            <td align="left"><?php  echo $fieldrecord['surname']." ". $fieldrecord['othername']?></td>
                                            <td  align="center"><?php echo $scored  ?></td>
                                            <td  align="center"><?php echo $passmark;  ?></td>
                                            <td  align="center"><?php echo $totalscore;  ?></td>
                                            <td  align="center"><?php echo $correctanswer;  ?></td>
                                            <td  align="center"><?php echo $wronganswer;  ?></td>
                                            <td  align="center"><?php echo $notanswered  ?></td>
                                            <td  align="center"><?php echo $returnusedtime;  ?></td>                                              
                                            <td  align="center"><?php echo $totaltime;  ?></td>
                                            <td  align="center"><?php if ($quizsetup==1) {
                                              echo "Completed";
                                            }else {
                                              echo "Not Completed";
                                            }  ?></td>

                                              <td >
                                            <?php if ($quiztimerid!="") { ?>
                                                <span class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-cog"></i> Action<span class="caret"></span>
                                            </button>
                                            <ul role="menu" class="dropdown-menu" style="list-style-type: none">
                                            <center>
                                           
                                            
                                             <li>
                                              <form method="post" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>&quiztimerid=<?php echo $quiztimerid; ?>" name="frmcbte<?php echo $quiztimerid; ?>" >
                                              <input type="hidden" name="levelide<?php echo $quiztimerid; ?>" value="<?php echo $levelid; ?>">
                                              <input type="hidden" name="optionide<?php echo $quiztimerid; ?>" value="<?php echo $optionid; ?>">
                                              <input type="hidden" name="courseide<?php echo $quiztimerid; ?>" value="<?php echo $courseid; ?>">
                                              <input type="hidden" name="sessionide<?php echo $quiztimerid; ?>" value="<?php echo $sessionid; ?>">
                                              <input type="hidden" name="semesteride<?php echo $quiztimerid; ?>" value="<?php echo $semesterid; ?>">
                                              <input type="hidden" name="quizsetupide<?php echo $quiztimerid; ?>" value="<?php echo $quizsetupid; ?>">
                                              <input type="hidden" name="stide<?php echo $quiztimerid; ?>" value="<?php echo $stid; ?>">
                                              
                                              <input type="submit" name="cbtbuttone<?php echo $quiztimerid; ?>" value="Enable CBT" class="form-control">
                                              </form>
                                            </li>
                                             
                                            <li>
                                              <form method="post" action="?page=6&schoolhelp=<?php echo $schoolhelp; ?>&quiztimerid=<?php echo $quiztimerid; ?>" name="frmcbtd<?php echo $quiztimerid; ?>" >
                                              <input type="hidden" name="levelidd<?php echo $quiztimerid; ?>" value="<?php echo $levelid; ?>">
                                              <input type="hidden" name="optionidd<?php echo $quiztimerid; ?>" value="<?php echo $optionid; ?>">
                                              <input type="hidden" name="courseidd<?php echo $quiztimerid; ?>" value="<?php echo $courseid; ?>">
                                              <input type="hidden" name="sessionidd<?php echo $quiztimerid; ?>" value="<?php echo $sessionid; ?>">
                                              <input type="hidden" name="semesteridd<?php echo $quiztimerid; ?>" value="<?php echo $semesterid; ?>">
                                              <input type="hidden" name="quizsetupidd<?php echo $quiztimerid; ?>" value="<?php echo $quizsetupid; ?>">
                                              <input type="hidden" name="stidd<?php echo $quiztimerid; ?>" value="<?php echo $stid; ?>">

                                              <input type="submit" name="cbtbuttond<?php echo $quiztimerid; ?>" value="Delete CBT" class="form-control">
                                              </form>
                                            </li>

                                          </center>
                                          </ul>
                                          </span>

                                           <?php } ?>
                                        </td>
                                           
                                      </tr>
                                  <?php   }
                                        } 
                                      }
                                  ?>    
                        
                      </tbody>
                    </table>
                  
                   

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