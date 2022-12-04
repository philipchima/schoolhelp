<?php 
include("../schoolhelp/includes/connection.php");
include("phpclass/SHteacherupdate.php");
include("phpclass/SHteacherinserts.php");
include("phpclass/SHteacherOOP.php");
include("../schoolhelp/phpclass/schoolhelpothers.php");

$conn= new Dbh;
$mysqli = $conn->connect();
?>
<?php 
  $SHteacher=new classTeacher;
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

	

//Getting the Department information
            $deptclass=$SHteacher->allteacheredit('level', 'levelid', $levelid);
            if (is_array($deptclass)) {
              foreach($deptclass as $deptclassrec){
                $scoredeptid=trim($deptclassrec['departmentid']);
                 $levelname=$deptclassrec['levelname'];
                  }
              }
              $scoretable="score".$departmentid;

?>


 <?php include("../schoolhelp/result/includes/headerempty.php"); 

 if ($resultvisibility==1) {

 ?>
        <!-- page content -->


          
            <div class="row">
              <div class="col-md-12" id="printrecord" style="width: 100%; ">
                <div class="x_panel">
                    
                  
                  <?php 
                    $x=0;
                    $score_tbl_id=""; 
                    $positiontblname=trim("positionresult".$scoredeptid);
                    $resulttblname=trim("result".$scoredeptid);
                     $score_tbl_score="";
                     $score_status="";
                     $assessmentid="";
                     $overallcount="";
                     $acc_ave_count="";
                      $cumutotalscores="";
                      $cumuaveragescores="";
                    ?>  
                    
                        <form method="POST" action="?schoolhelp=<?php echo $schoolhelp; ?>&page=4" name="frmscoresheet">
                          <div><table width="100%" style="">
                <tr><?php 
                    //collection of department Logo
                  $instilogo="";
                  $instiname="";
                  $instiaddress="";
                  $instislogan="";

                   //Institution 
                   $instidata=$SHteacher->allteacheredit('institution', 'departmentid', $scoredeptid);
                            if (is_array($instidata)) {
                              foreach($instidata as $instirec){ 
                               $instilogo=trim($instirec['instilogo']); 
                               $instiname=trim($instirec['instiname']); 
                               $instiaddress=trim($instirec['instiaddress']); 
                               $instislogan=trim($instirec['instislogan']); 
                              }
                            }

                             //Instructor form teacher
                            $formteacherid="";
                            $staffid="";
                   $formteacherdata=$SHteacher->allteacheredit2('formteacher', 'levelid', $levelid, 'optionid', $optionid);
                            if(is_array($formteacherdata)) {
                              foreach($formteacherdata as $formteacherrec){ 
                               $formteacherid=trim($formteacherrec['formteacherid']); 
                               $staffid=trim($formteacherrec['staffid']); 
                              }
                            }

                             //Institution 
                             $staffsurname="";
                               $staffothername="";
                   $staffdata=$SHteacher->allteacheredit('staff', 'staffid', $staffid);
                            if (is_array($staffdata)) {
                              foreach($staffdata as $staffrec){ 
                               $staffsurname=trim($staffrec['surname']); 
                               $staffothername=trim($staffrec['othername']); 
                              }
                            }

                            $levelname="";
                             $leveldata=$SHteacher->allteacheredit('level', 'levelid', $levelid);
                            if (is_array($leveldata)) {
                              foreach($leveldata as $levelrec){ 
                               $levelname=trim($levelrec['levelname']); 
                              }
                            }

                             $optionname="";
                             $optiondata=$SHteacher->allteacheredit('optiontable', 'optid', $optionid);
                            if (is_array($optiondata)) {
                              foreach($optiondata as $optionrec){ 
                               $optionname=trim($optionrec['optname']); 
                              }
                            }


                             $sessionname="";
                             $sessiondata=$SHteacher->allteacheredit('session', 'sessionid', $sessionid);
                            if (is_array($sessiondata)) {
                              foreach($sessiondata as $sessionrec){ 
                               $sessionname=trim($sessionrec['sessionlow'].' / '.$sessionrec['sessionhigh']); 
                              }
                            }

                             $semestername="";
                             $semesterdata=$SHteacher->allteacheredit('semesters', 'semesterid', $semesterid);
                            if (is_array($semesterdata)) {
                              foreach($semesterdata as $semesterrec){ 
                               $semestername=trim($semesterrec['semestername']); 
                              }
                            }

                            ?>
                    <td align="center" width="25%"><img src="../schoolhelp/images/logo/<?php echo $instilogo; ?>" class="img img-responsive" style="width:40%"></td>
                    <td  align="center" width="50%" > <span style="font-size:30px; font-weight:bold; color:#063; "><?php echo $instiname; ?></span>
                      <br>
                      <span style="font-size:16px; font-weight:bold ; color:#d2dc2a"><?php echo $instiaddress; ?></span>
                      <br>
                      <span style="font-size:16px;  "><?php echo $instislogan; ?></span>
                      <br>
                      <h3 style="color:black">Detailed Broad Sheet</h3>
                    </td>
                    <td width="25%" valign="bottom"> 
                      <table>
                        <tr>
                       <td >Form Teacher/Course Adviser:</td> <td style="border-bottom:2px solid black; color:#d2dc2a; "><b><?php echo $staffsurname." ".$staffothername; ?> </b></td>
                      </tr>
                      <tr>
                       <td style="color:black; ?>">LEVEL/CLASS:</td> <td style="border-bottom:2px solid black; color:#d2dc2a;"><b><?php echo  $levelname; ?></b></td>
                      </tr>
                      <tr>
                      <td style="color:black">OPTION/ARM:</td> <td style="border-bottom:2px solid black; color:#d2dc2a;"><b> <?php echo $optionname; ?></b></td>
                    </tr>
                    <tr>
                      <td style="color:black">SEMESTER/TERM:</td> <td style="border-bottom:2px solid black; color:#d2dc2a;"><b><?php echo $semestername; ?></b></td>
                    </tr>
                    <tr>
                      <td style="color:black">YEAR/SESSION:</td> <td style="border-bottom:2px solid black; color:#d2dc2a;"><b><?php echo $sessionname; ?></b></td>
                  </tr>
                  <tr>
                      <td style="color:black">DATE:</td> <td style="border-bottom:2px solid black; color:#d2dc2a;"><b><?php echo date("Y-m-d"); ?></b></td>
                    </tr></table>

                     </td>
                    
                </tr>
               
            </table>
</div>  
                      <div class="x_panel" >
                       
                    <table  style="width:100%; text-align: center" class="table table-striped table-bordered table-responsive" id="printrecord">
                     
                      <thead style="margin: 0px; padding: 0px;">
                        <tr>
                          <th>SN</th>
                      
                          <th>Fullname</th>
                        
                          <?php
                          $coursedata=$SHteacher->allteacheredit('course', 'departmentid', $scoredeptid);
                            if (is_array($coursedata)) {
                              foreach($coursedata as $courserec){ 
                            ?>
                              <th ><span class="vertical"><?php echo str_replace(' ', '_', trim($courserec['csname'])); ?></span></th>
                              
                           <?php   }
                            }
                            ?>

                            <th ><span class="vertical">Total</span></th>
                            <th ><span class="vertical">Average</span></th>

                            <?php if ($semesterid==1) { ?>
                            <th ><span class="vertical">1ST_Term_Total</span></th>
                           <?php  }elseif ($semesterid==2) {?>
                            <th ><span class="vertical" >1ST_Term_Total</span></th>
                            <th ><span class="vertical" > 2ND_Term_Total</span></th>
                           <?php }elseif ($semesterid==3) { ?>
                            <th ><span class="vertical" >1ST_Term_Total</span></th>
                            <th ><span class="vertical" >2ND_Term_Total</span></th>
                           <th ><span class="vertical" >3RD_Term_Total</span></th>
                           <?php } ?>
                           <th ><span class="vertical">CUMU_Total</span></th>
                          <th ><span class="vertical" >CUMU_AVE</span></th>
                          <th><span class="vertical">Posittion</span></th>
                          <th ><span>Remark</span></th>

                        </tr>
                      </thead>

                      <tbody>
                           <?php  $k=0; 
                           $coursescoretotal=array();
                            
                            $overalltotal="";
                            $overallaverage="";

                            //calculating position based on Singular or accummulated result
                              $singularresult="";
                               $activationrecords=$SHteacher->allteacheredit('resultactivations', 'titlename', 'Singular Result');
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

                           $counter=0;
                            $p="";
                            $studentave="";
                            $i=0;
                            $actualposition="";
                           
                          //checks of equal average
                          $equalave="";

                            $records=$SHteacher->allposi4sort($positiontblname, $levelid, $optionid, $sessionid, $semesterid, $posi_measure, 'DESC');
                              if(is_array($records)) {
                              
                              foreach($records as $fieldrecord){
                                $studentave=$fieldrecord[$posi_measure];
                                  $counter+=1;
                              
                              $p=0;
                            //checking whether an average is not empty
                             $actualposition=$counter;
                             
                             //checking 4 tally average, so to calculate position very well
                                if ($studentave==$equalave) {
                                  $p=1;
                                  $actualposition-=$p;
                                }
                              $k+=1;

                               if ($actualposition==0) {
                                  $actualposition=1;
                                  $counter+=1
                                }
                                
                              $stid=trim($fieldrecord['stid']);
                               $equalave=$studentave;
                               $sturecords=$SHteacher->allteacheredit('students', 'stid', $stid);
                               if (is_array($sturecords)) {
                                  foreach($sturecords as $sturecord){
                                  $surname=trim($sturecord['surname']);
                                  $othername=trim($sturecord['othername']);
                                 }

                               }
                            ?>

                                <tr>
                                <td style="padding: 0px; margin:0px; border-collapse: collapse;" cellspacing="0px" cellpadding="0px"><?php echo  $k;  ?></td>
                                <td style="padding: 0px; margin:0px; border-collapse: collapse;" cellspacing="0px" cellpadding="0px"><?php echo  $surname.' '.$othername; ?></td>

                          <?php 
                                  $coursecount="";
                                  $studenttotal="";
                                  $studentaverage="";
                                  $total1stterm="";
                                  $total2ndterm="";
                                  $total3rdterm="";

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
                           
                                      <?php //checking whether last score has been submitted
                                 $resultdata=$SHteacher->allteacheredit6($resulttblname, 'stid', $stid, 'levelid', $levelid, 'optionid', $optionid, 'courseid', trim($courserec1['csid']), 'semesterid', $semesterid, 'sessionid', $sessionid);
                                  if (is_array($resultdata)) {
                                    foreach($resultdata as $resultrec){ 
                                      echo trim($resultrec['score']);
                                      $actualscore=trim($resultrec['score']);
                                      $coursescoretotal[$csid]+=trim($resultrec['score']);
                                    
                                    }
                                   
                                  }

                                  ?>
                              </td>

                                   <?php

                          $studenttotal+=$actualscore;
                            if ($actualscore!="") {
                                        $coursecount+=1;
                                      }
                            ?>

                                    
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
                            
                           <?php 
                           //getting the total of first term score
                            $positioncheck1=$SHteacher->allpositionedit5($positiontblname, 'stid', trim($fieldrecord['stid']), 'levelid', $levelid, 'optionid', $optionid, 'semesterid', 1, 'sessionid', $sessionid);
                                   if (is_array($positioncheck1)) {
                                    foreach($positioncheck1 as $positioncheckrec1){ 
                                      $total1stterm=trim($positioncheckrec1['score']);
                                    }
                                  }

                            //Getting the total of second term
                                 $positioncheck2=$SHteacher->allpositionedit5($positiontblname, 'stid', trim($fieldrecord['stid']), 'levelid', $levelid, 'optionid', $optionid, 'semesterid', 2, 'sessionid', $sessionid);
                                   if (is_array($positioncheck2)) {
                                    foreach($positioncheck2 as $positioncheckrec2){ 
                                      $total2ndterm=trim($positioncheckrec2['score']);
                                    }
                                  }

                             //Getting the total of second term
                                 $positioncheck3=$SHteacher->allpositionedit5($positiontblname, 'stid', trim($fieldrecord['stid']), 'levelid', $levelid, 'optionid', $optionid, 'semesterid', 2, 'sessionid', $sessionid);
                                   if (is_array($positioncheck3)) {
                                    foreach($positioncheck3 as $positioncheckrec3){ 
                                      $total3rdterm=trim($positioncheckrec3['score']);
                                    }
                                  }?>

                                <td  style="padding: 0px; margin:0px; border-collapse: collapse;" cellspacing="0px" cellpadding="0px"><?php echo $studenttotal; ?> </td>
                              <td  style="padding: 0px; margin:0px; border-collapse: collapse;" cellspacing="0px" cellpadding="0px" <?php if ($studentaverage< $passmark2) {?> style="color:red"   <?php }?> ><?php echo $studentaverage; ?> </td>  
                             <?php  if ($semesterid==1) { ?>
                             <td  style="padding: 0px; margin:0px; border-collapse: collapse;" cellspacing="0px" cellpadding="0px"><?php  echo $total1stterm; ?> </td>
                           <?php  }elseif ($semesterid==2) {?>
                            <td  style="padding: 0px; margin:0px; border-collapse: collapse;" cellspacing="0px" cellpadding="0px"><?php echo $total1stterm; ?> </td>
                            <td  style="padding: 0px; margin:0px; border-collapse: collapse;" cellspacing="0px" cellpadding="0px"><?php echo $total2ndterm; ?> </td>
                           <?php }elseif ($semesterid==3) { ?>
                            <td  style="padding: 0px; margin:0px; border-collapse: collapse;" cellspacing="0px" cellpadding="0px"><?php echo $total1stterm; ?> </td>
                            <td  style="padding: 0px; margin:0px; border-collapse: collapse;" cellspacing="0px" cellpadding="0px"><?php echo $total2ndterm; ?> </td>
                            <td  style="padding: 0px; margin:0px; border-collapse: collapse;" cellspacing="0px" cellpadding="0px"><?php echo $total3rdterm; ?> </td>
                           <?php } ?>
                              <td  style="padding: 0px; margin:0px; border-collapse: collapse;" cellspacing="0px" cellpadding="0px"><?php $cumutotalscores+=$fieldrecord['cumulative']; echo $fieldrecord['cumulative']; ?> </td>
                              <td  style="padding: 0px; margin:0px; border-collapse: collapse;" cellspacing="0px" cellpadding="0px" <?php if (trim($fieldrecord['accaverage'])< $passmark2) {?> style="color:red"   <?php }?> ><?php if ($fieldrecord['accaverage']!="") { $cumuaveragescores+=$fieldrecord['accaverage']; $acc_ave_count+=1; } echo $fieldrecord['accaverage']; ?> </td>  
                              <td  style="padding: 0px; margin:0px; border-collapse: collapse;" cellspacing="0px" cellpadding="0px"><?php echo $positionname=Others::ordinalize($actualposition); ?> </td>
                              <td  style="padding: 0px; margin:0px; border-collapse: collapse;" cellspacing="0px" cellpadding="0px"><?php $totalround=floor($studentaverage); echo $remarkname=$SHteacher->grade('remark', $scoredeptid, $totalround); ?></td>                                  
                            </tr>

                             <?php 
                             if ($k<4) {
                                  $i+=1;
                                  //Giving the array an offset
                                  if (!isset($beststu['posi'.$i])) {
                                    $beststu['posi'.$i]="";
                                  }

                                   //Giving the array an offset
                                  if (!isset($beststu['name'.$i])) {
                                    $beststu['name'.$i]="";
                                  }

                                   //Giving the array an offset
                                  if (!isset($beststu['ave'.$i])) {
                                    $beststu['ave'.$i]="";
                                  }

                                   //Giving the array an offset
                                  if (!isset($beststu['rem'.$i])) {
                                    $beststu['rem'.$i]="";
                                  }

                                  $beststu['posi'.$i]=$positionname;
                                  $beststu['name'.$i]= $surname.' '.$othername;;
                                  $beststu['ave'.$i]=$fieldrecord[$posi_measure];
                                  $beststu['rem'.$i]=$remarkname;

                                }

                                }
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
                              }  ?>
                                
                              </td>
                            
                             <?php  if ($semesterid==1) { ?>
                             <td> </td>
                           <?php  }elseif ($semesterid==2) {?>
                            <td> </td>
                            <td> </td>
                           <?php }elseif ($semesterid==3) { ?>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                           <?php } ?>
                            <td><?php echo $cumutotalscores; ?></td>
                            <td><?php if ($cumuaveragescores>0 and $acc_ave_count>0) {
                              echo round($cumuaveragescores/$acc_ave_count, 2);
                            } ?></td>
                            <td></td>
                            <td></td>

                            </tr>
                    </table>
                  </div></form>
                  <table class="table table-responsive">
                    <caption style="font-size:20px; color:green">First Three Students</caption>
                    <thead>
                    <tr>
                      <th>Fullname:
                      </th>
                      <th>Average:
                      </th>
                       <th>Position:
                      </th>
                      <th> Remark:
                      </th>
                    </tr>
                     <tr>
                      <td></td><td></td><td></td><td></td>
                    </tr>
                    <?php for($u=1; $u<=$i; $u++){ ?>
                    <tr>
                      <td><?php echo $beststu['name'.$u]; ?></td><td><?php echo $beststu['ave'.$u]; ?></td><td><?php echo $beststu['posi'.$u]; ?></td><td><?php echo $beststu['rem'.$u]; ?></td>
                    </tr>
                    <?php } ?>
                  </thead>
                     
                  </table>
                 
                     <div class="row no-print" style="margin-bottom: 50px">
                       <center>
                        <button class="btn btn-success print-link" ><i class="fa fa-print"></i> Print</button>   
                        </center>             
                        </div>
                      </div>

                    </div>
           
          </div>
        </div>
      </div>

      <?php } ?>
        <!-- /page content -->

       <?php include("../schoolhelp/result/includes/footerempty.php"); ?>

       