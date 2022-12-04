<?php 
include("../schoolhelp/includes/connection.php");
include("phpclass/SHteacherupdate.php");
include("phpclass/SHteacherinserts.php");
include("headernew.php"); 
$conn= new Dbh;
$mysqli = $conn->connect();
?>
<?php 
       $tablestudents=new insertTable;
       $tableUpdate= new updateTable;
		 $page = trim(isset($_GET['page'])?$_GET['page']:false);
		 $sql = trim(isset($_GET['sql'])?$_GET['sql']:false);
		 $tid=trim(isset($_GET['refno'])?$_GET['refno']:false);
		 $staffid = trim(isset($_SESSION["t_teacherlog".$tid])?$_SESSION["t_teacherlog".$tid]:false);
		 $classinfo=trim(isset($_GET['tcid'])?$_GET['tcid']:false); //this variable should always be passed when reloading this page

  //Enable a teacher to finalise result and also print broadsheet and report card
 $teacherresultdata=$SHteacher->allteacheredit('resultactivations','titlename', "Generate result by form teachers");
            if (is_array($teacherresultdata)) {
                foreach($teacherresultdata as $teacherresultrecord){
                    $resultvisibility=trim($teacherresultrecord['status']);    
              }
          }

		//Select current term/semester
 		$semesterdata=$SHteacher->allteacheredit('semesters','status', 1);
            if (is_array($semesterdata)) {
                foreach($semesterdata as $semesterrecord){
                    $semestername=$semesterrecord['semestername'];
                    $semesterid=trim($semesterrecord['semesterid']);
                    
              }
          }


		//Select current Session
		 $sessiondata=$SHteacher->allteacheredit('session','status', 1);
            if (is_array($sessiondata)) {
                foreach($sessiondata as $sessiondrecord){
                    $sessionname=$sessiondrecord['sessionlow']."/".$sessiondrecord['sessionhigh'];
                    $sessionid=trim($sessiondrecord['sessionid']);    
              }
          }

		if($classinfo!=""){
				 $teacherscourses=$SHteacher->allteacheredit('instructorcourses','icourseid', $classinfo);
		            if (is_array($teacherscourses)) {
		            	 foreach($teacherscourses as $teacherscoursesrec){
				  		$optionid=trim($teacherscoursesrec['optionid']);  

		                 $levelid=trim($teacherscoursesrec['levelid']); 
		                 $courseid=trim($teacherscoursesrec['courseid']);
						 $departmentid=trim($teacherscoursesrec['departmentid']);
						
				 
					}
				}
		
		}else{
		   echo $levelid =(isset($_GET['classid'])?$_GET['classid']:false);
		   $optionid=(isset($_GET['groupid'])?$_GET['groupid']:false);
		   
		}
		
		
		$cnt="";
		if ($page==2) {
			$levelid=trim(isset($_POST['class'])?$_POST['class']:false);
			$optionid=trim(isset($_POST['group'])?$_POST['group']:false);
		}

	 

if ($resultvisibility==1) {
 
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

        $course1=$SHteacher->allteacheredit('course', 'departmentid', $deptid);
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

                                  $resultcheck=$SHteacher->allteacheredit6($resulttblname, 'stid', $stid, 'levelid', $levelid, 'optionid', $optionid, 'courseid', $courseid, 'semesterid', 1, 'sessionid', $sessionid);
                                   if (is_array($resultcheck)) {
                                    foreach($resultcheck as $resultcheckrec){ 
                                      $cumuresultscore=trim($resultcheckrec['score']);
                                    }
                                  }

                                  $cumuresultscoreplus=$cumuresultscore;

                                }

                                 if ($semesterid==3) {

                                    $resultcheck=$SHteacher->allteacheredit6($resulttblname, 'stid', $stid, 'levelid', $levelid, 'optionid', $optionid, 'courseid', $courseid, 'semesterid', 1, 'sessionid', $sessionid);
                                   if (is_array($resultcheck)) {
                                    foreach($resultcheck as $resultcheckrec){ 
                                      $cumuresultscore=trim($resultcheckrec['score']);
                                    }
                                  }

                                  $resultcheck1=$SHteacher->allteacheredit6($resulttblname, 'stid', $stid, 'levelid', $levelid, 'optionid', $optionid, 'courseid', $courseid, 'semesterid', 2, 'sessionid', $sessionid);
                                   if (is_array($resultcheck1)) {
                                    foreach($resultcheck1 as $resultcheckrec1){ 
                                      $cumuresultscore1=trim($resultcheckrec1['score']);
                                    }
                                  }   

                                  $cumuresultscoreplus=$cumuresultscore+$cumuresultscore1;
                                 
                                }

                                $cumuresultscoreplus+=$studentsubjectscore1;
                                 
                              //checking whether result has been submitted before
                                 $resultscoredata=$SHteacher->allteacheredit6($resulttblname, 'stid', $stid, 'levelid', $levelid, 'optionid', $optionid, 'courseid', $courseid, 'semesterid', $semesterid, 'sessionid', $sessionid);
                                if (is_array($resultscoredata)) {
                                  foreach($resultscoredata as $resultdatarec){ 
                                    $result_tbl_id=trim($resultdatarec['resultid']);
                                    $result_tbl_status=trim($resultdatarec['status']);
                                    $result_tbl_score=trim($resultdatarec['score']);
                                  }
                              //Updating Result
                              
                             
                            $state= $tableUpdate->update_result($resulttblname, 'resultid', $result_tbl_id, 'score',  $studentsubjectscore1, 'cumulative',  $cumuresultscoreplus, 'instructorid', $staffid, 'udate', $udate);
                              //Counting number of record that updated
                                  if ($state=="Success") {
                                    $k+=1;
                                  }
                      
                            }else{
                              //check whether the input box is empty
                              if ($studentsubjectscore1!="") {
                                //Inserting New Score
                                
                                  
                                  $state=$tablestudents->insert_result($resulttblname, $sessionid, $semesterid, $levelid, $optionid, $stid, $courseid, $studentsubjectscore1, $cumuresultscoreplus, 'instructorid', $refno, 'udate', $udate, $odate);
                                  $insertedrow+=$state['counting'];
                              }

                            }

                             //Updating the status of student score
                                 $statusupdate=$tableUpdate->update_scorestatus($scoretblname, 'status', $status, 'operatorid', '', 'udate', $udate, $sessionid, $semesterid, $levelid, $optionid, $stid);
                            
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
                //Getting Previous Term/semester position Score

                                if ($semesterid==2) {

                                  $positioncheck=$SHteacher->allpositionedit5($positiontblname, 'stid', $studentid, 'levelid', $levelid, 'optionid', $optionid, 'semesterid', 1, 'sessionid', $sessionid);
                                   if (is_array($positioncheck)) {
                                    foreach($positioncheck as $positioncheckrec){ 
                                      $cumupositionscore=trim($positioncheckrec['score']);
                                      $cumupositionave=trim($positioncheckrec1['average']);
                                    }
                                  }

                                  $cumupositionscoreplus=$cumupositionscore;
                                  $cumupositionscoreplus=$cumupositionave;

                                }

                                 if ($semesterid==3) {

                                    $positioncheck=$SHteacher->allpositionedit5($positiontblname, 'stid', $studentid, 'levelid', $levelid, 'optionid', $optionid,  'semesterid', 1, 'sessionid', $sessionid);
                                   if (is_array($positioncheck)) {
                                    foreach($positioncheck as $positioncheckrec){ 
                                      $cumupositionscore=trim($positioncheckrec['score']);
                                      $cumupositionave=trim($positioncheckrec['average']);
                                    }
                                  }

                                  $positioncheck1=$SHteacher->allpositionedit5($positiontblname, 'stid', $studentid, 'levelid', $levelid, 'optionid', $optionid,  'semesterid', 2, 'sessionid', $sessionid);
                                   if (is_array($positioncheck1)) {
                                    foreach($positioncheck1 as $positioncheckrec1){ 
                                      $cumupositionscore=trim($positioncheckrec1['score']);
                                       $cumupositionave1=trim($positioncheckrec1['average']);
                                    }
                                  }   

                                  $cumupositionscoreplus=$cumupositionscore+$cumupositionscore1;
                                  $overallave= $cumupositionave+ $cumupositionave1;
                                 
                                }

                               

                                $cumupositionscoreplus+=$studenttotalscore1;
                                $cumupositionaveplus+=$studentave;
                                 //checking whether position result has been submitted before
                                 $positionresult=$SHteacher->allpositionedit5($positiontblname, 'stid', $studentid, 'levelid', $levelid, 'optionid', $optionid,  'semesterid', $semesterid, 'sessionid', $sessionid);

                            if (is_array($positionresult)) {
                              foreach($positionresult as $positionresultrec){ 
                                $posi_tbl_id=trim($positionresultrec['positionid']);
                              }
                              //Updating Result

                            $state= $tableUpdate->update_position($positiontblname,  $posi_tbl_id,  $studenttotalscore1, $cumupositionscoreplus,  $studentave,  $cumupositionaveplus,  $stucoursecount1, $actualposition, 'instructorid', $staffid, 'udate', $udate);
                              //Counting number of record that updated
                                  if ($state=="Success") {
                                    $positionk+=1;
                                  }
                      
                            }else{
                              //check whether the input box is empty
                              if ($studenttotalscore1!="") {
                                //Inserting New Score
                                
                                  $tablestudents=new insertTable;
                                  $state=$tablestudents->insert_position($positiontblname, $sessionid, $semesterid, $levelid, $optionid, $studentid, $studenttotalscore1, $cumupositionscoreplus,  $cumupositionaveplus,  $stucoursecount1, $actualposition, 'instructorid', $staffid, 'udate', $udate, $odate);
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
        window.location.href='?refno=$staffid&tcid=$classinfo&sql=$sql&groupid=$optionid&classid=$levelid';
      </script>";
      
  }

  
}

} //End of checking whether result is accessible

//Getting the Department information
            $deptclass=$SHteacher->allteacheredit('level', 'levelid', $levelid);
            if (is_array($deptclass)) {
              foreach($deptclass as $deptclassrec){
                $departmentid=trim($deptclassrec['departmentid']);
                 $levelname=$deptclassrec['levelname'];
                  }
              }
              $scoretable="score".$departmentid;

?>


<style>
	.vertical{writing-mode: vertical-lr;-ms-writing-mode: tb-rl; transform: rotate(180deg); letter-spacing:1px;  padding:3px;  text-align:center; }
</style>

            <div class="container-fluid">
				<!-- /.row -->

               <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Hi!</strong> <span style="font:20px Corbel bold; color:#060; "><?php echo (isset($_SESSION["t_fullname".$tid])?$_SESSION["t_fullname".$tid]:false); ?> </span><span style="color:#FEA318;">Note that your operations is only strictly on <span style="font:20px Corbel  bold; color:#F00; "><?php echo $semestername; echo " ";?>Term of <?php echo $sessionname; ?></span> </span>
                        </div>
                    </div>
                </div>

     		<div class="col-lg-12 table-responsive">
     			<table class="table table-hover">
                    	<thead>
                        	<tr>
                                 <th>class|Level</th>
                                 <th>Option|Group</th>
                                 
                                 <th>&nbsp;</th>
                            </tr>
                        </thead>
                         <tbody>
                         	<form method="post" action="resultreport?refno=<?php echo $tid; ?>&tcid=<?php echo $classinfo; ?>&page=2"  name="cbtedit">
                            <tr>
                               <td>
                                     <select name="class"  class="form-control" required="required">
                                            <option value="">--Select Level--</option>
                                            <?php
                                                  $scorecontent="SELECT DISTINCT a.levelid, levelname from {$scoretable} a INNER JOIN formteacher b ON a.levelid=b.levelid INNER JOIN level cls ON a.levelid=cls.levelid where b.staffid=:fieldvalue order by scoreid asc";
                                                  $stmt = $mysqli->prepare($scorecontent);
												    $stmt->execute([ ':fieldvalue'=>$staffid]);
												     if($stmt->rowCount()){

												        while($row=$stmt->fetch()){	  								
                                              ?>
                                            <option value="<?php echo  $row['levelid']; ?>"<?php if($row['levelid']==$levelid){?>selected <?php } ?>><?php echo  $row['levelname']?></option>
                                            <?php  } 
                                            	 } ?>
                                          </select>
                                 </td>
                                  <td>
                                <select name="group" class="form-control"  required="required">
                                  <option value="">--Select Option|Group--</option>
                                  <?php
                                        $scoregroup= "SELECT DISTINCT a.optionid, optname from {$scoretable} a INNER JOIN formteacher b ON a.optionid=b.optionid INNER JOIN optiontable cls ON a.optionid=cls.optid where b.staffid=:fieldvalue order by scoreid asc";
										 $stmt1 = $mysqli->prepare($scoregroup);
												    $stmt1->execute([ ':fieldvalue'=>$staffid]);
												     if($stmt1->rowCount()){

												        while($row1=$stmt1->fetch()){	  								
										
                                    ?>
                                  <option value="<?php echo  $row1['optionid']; ?>" <?php if($row1['optionid']==$optionid){?>selected <?php } ?>><?php echo  $row1['optname']; ?></option>
                                   <?php  } 
                                        } ?>
                                </select> 
                                </td>
                                 <td> <input type="submit" value="View Result" class="form-control" style="background:#060; color:#FFF" /></td>
                            </tr>
                            </form>
                            
                         </tbody>
                    </table>
     			
     		</div>
            
			<div class="col-lg-12 table-responsive" style="margin-bottom:50px">       
			<fieldset>
                        <legend style="color:#063"> Score Sheet</legend>
                        <form method="POST" action="?refno=<?php echo $staffid; ?>&page=4&tcid=<?php echo $classinfo; ?>&classid=<?php echo $levelid ?>&groupid=<?php echo $optionid; ?>" name="frmscoresheet" onSubmit="return false">
                          <input name="optionid"  id="optionid" value="<?php  echo trim($optionid); ?>" type="hidden"/>
                          <input name="levelid"  id="levelid" value="<?php  echo trim($levelid); ?>" type="hidden"/>
                          <input name="semesterid"  id="semesterid" value="<?php  echo trim($semesterid); ?>" type="hidden"/>
                          <input name="sessionid"  id="sessionid" value="<?php  echo trim($sessionid); ?>" type="hidden"/>
                          
                          <input name="deptid"  id="deptid" value="<?php  echo trim($departmentid); ?>" type="hidden"/>

                          <?php //Checking whether result has been finalized 
                           $positiontblname='positionresult'.trim($departmentid);
                               $positioncheck2=$SHteacher->allpositionedit4($positiontblname,  'levelid', $levelid, 'optionid', $optionid,  'semesterid', $semesterid, 'sessionid', $sessionid);
                                  
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
                          $coursedata=$SHteacher->allteacheredit('course', 'departmentid', $departmentid);
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
                        $overallcount=0;
                            ?>
                            
                           <?php  
                           $coursescoretotal=array();
                            $scoretblname="score".$departmentid;
                            $overalltotal="";
                            $overallaverage="";
                            $records=$SHteacher->allteacheredit3('students', 'levelid', $levelid, 'optid', $optionid, 'status', 0);;
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                               $k+=1;
                               $stid="";
                               $stid=trim($fieldrecord['stid']);

                          
                        ?>
                                      <tr cellspacing="0px" cellpadding="0px">
                                        <td><?php echo  $k; ?><input name="studid[]"  id="studid[]" value="<?php  echo trim($fieldrecord['stid']); ?>" type="hidden"/></td>
                                        
                                        <td  style="border-collapse: collapse; padding: 0px; ">
                                          <table >
                                            <tr >
                                            <td  ><?php echo trim($fieldrecord['surname']).' '.trim($fieldrecord['othername']); ?></td>
                                            <td > 
                                                                       
                                        <?php
                            $assessmentdata1=$SHteacher->allteacheredit('assessment', 'departmentid', $departmentid);
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
                                 $scoredata=$SHteacher->allteacheredit7($scoretblname, 'stid', $stid, 'levelid', $levelid, 'optionid', $optionid, 'courseid', trim($courserec1['csid']), 'assessmentid', trim($assessmentrec2['assid']), 'semesterid', $semesterid, 'sessionid', $sessionid);
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
                              $passmarkdata=$SHteacher->allteacheredit('passmark', 'passmarkid', trim($fieldrecord["levelid"]));
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
                         <div class="col-xs-6"><button type="submit" class="btn btn-success"  onClick="return generateresult('<?php echo $staffid ; ?>', '<?php echo $levelid; ?>', '<?php echo $optionid; ?>', 4)"><i class="fa fa-send"></i> Update Result</button></div>
                         
                         <?php } else{ ?>
                          <div class="col-xs-6"><button type="submit" class="btn btn-success" onClick="return generateresult('<?php echo $staffid ; ?>', '<?php echo $levelid; ?>', '<?php echo $optionid; ?>', 4)"><i class="fa fa-send"></i> Generate Result</button></div>
                         <?php } ?>
                        </div>
                      </div>

                    </div>
                  </form>
                    </fieldset>
            </div>
        </div>
   </div>
 </div>
 <?php include("footernew.php");?>


