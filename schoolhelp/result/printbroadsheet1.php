<?php
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHresultOOP.php");
include_once("../phpclass/SHresultupdate.php");
include_once("../phpclass/SHresultinserts.php");
include_once("../phpclass/schoolhelpothers.php");

confirmcheckin();
$SHResultOOP=new ClassResult;
$pagename="Result Broadsheet Sheet";
$tablestudents=new insertTable;
 $tableUpdate= new updateTable;

// Checking page access Authenticity

$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp=trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$page=trim(isset($_GET['page'])?$_GET['page']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

$previlleges=$SHResultOOP->allresultedit('adminpersons', 'adminid', $schoolhelp);
if ($previlleges) {
  
foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['broadsheet_r']);
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


if ($page==2) {

    $sessionid=trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);
    $semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
    $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
    // not used $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);
   
    
      // Getting the Department ID
                           
      $leveldata=$SHResultOOP->allresultedit('level', 'levelid', $levelid);
        if (is_array($leveldata)) {
          foreach($leveldata as $levelrec){ 
            $scoredeptid=trim($levelrec['departmentid']); 
            $levelname=trim($levelrec['levelname']); 
          }
        }
                           

}



//this helps you to know the kind of driver you are using
//print_r(PDO::getAvailableDrivers());
 ?>

    <?php include("includes/headerempty.php"); ?>
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
                   $instidata=$SHResultOOP->allresultedit('institution', 'departmentid', $scoredeptid);
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
                            $staffsurname="";
                            $staffothername="";
                            $accstaffname="";
                            $taccstaffname="";

                            $formteacherdata=$SHResultOOP->allresultedit('formteacher', 'levelid', $levelid);
                            if(is_array($formteacherdata)) {
                              foreach($formteacherdata as $formteacherrec){ 
                               $formteacherid=trim($formteacherrec['formteacherid']); 
                               $staffid=trim($formteacherrec['staffid']); 

                                  $staffdata=$SHResultOOP->allresultedit('staff', 'staffid', $staffid);
                                  if (is_array($staffdata)) {
                                    foreach($staffdata as $staffrec){ 
                                     $staffsurname=trim($staffrec['surname']); 
                                     $staffothername=trim($staffrec['othername']); 
                                     $accstaffname=$staffsurname." ".$staffothername; 
                                     

                                       if ($taccstaffname=="") {
                                         $taccstaffname.=$accstaffname;
                                       }else{
                                           $taccstaffname.="/ ".$accstaffname;
                                       }

                                    }
                                  }

                              }
                            }

                            $levelname="";
                            $optionname="";
                            $namesofoptions="";

                            $leveldata=$SHResultOOP->allresultedit('level', 'levelid', $levelid);
                            if (is_array($leveldata)) {
                              foreach($leveldata as $levelrec){ 
                               $levelname=trim($levelrec['levelname']); 
                              }
                            }

                           
                            $optiondata=$SHResultOOP->allresultedit('optiontable', 'levelid', $levelid);
                            if (is_array($optiondata)) {
                              foreach($optiondata as $optionrec){ 

                                $optionname=trim($optionrec['optname']); 
                                if($namesofoptions==""){
                                   $namesofoptions.=$optionname;
                                }else{
                                   $namesofoptions.="/ ".$optionname;
                                }
                                
                                
                              }
                            }

                             $sessionname="";
                             $sessiondata=$SHResultOOP->allresultedit('session', 'sessionid', $sessionid);
                            if (is_array($sessiondata)) {
                              foreach($sessiondata as $sessionrec){ 
                               $sessionname=trim($sessionrec['sessionlow'].' / '.$sessionrec['sessionhigh']); 
                              }
                            }

                             $semestername="";
                             $semesterdata=$SHResultOOP->allresultedit('semesters', 'semesterid', $semesterid);
                            if (is_array($semesterdata)) {
                              foreach($semesterdata as $semesterrec){ 
                               $semestername=trim($semesterrec['semestername']); 
                              }
                            }

                            ?>
                    <td align="center" width="25%"><img src="../images/logo/<?php echo $instilogo; ?>" class="img img-responsive" style="width:40%"></td>
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
                       <td >Form Teacher/Course Adviser:</td> <td style="border-bottom:2px solid black; color:#d2dc2a; font-size: 10px"><b><?php echo $taccstaffname; ?> </b></td>
                      </tr>
                      <tr>
                       <td style="color:black; ?>">LEVEL/CLASS:</td> <td style="border-bottom:2px solid black; color:#d2dc2a;"><b><?php echo  $levelname; ?></b></td>
                      </tr>
                      <tr>
                      <td style="color:black">OPTION/ARM:</td> <td style="border-bottom:2px solid black; color:#d2dc2a; font-size: 10px"><b> <?php echo $namesofoptions; ?></b></td>
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
                          $coursedata=$SHResultOOP->allresultedit('course', 'departmentid', $scoredeptid);
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

                           $counter=0;
                            $p="";
                            $studentave="";
                            $i=0;
                            $actualposition="";
                           
                          //checks of equal average
                          $equalave="";

                            $records=$SHResultOOP->allposi3sort($positiontblname, $levelid,  $sessionid, $semesterid, $posi_measure, 'DESC');
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
                                   if ($actualposition==0) {
                                            $actualposition+=1;
                                            $counter+=1;
                                        }
                              $k+=1;
                              $stid=trim($fieldrecord['stid']);
                               $equalave=$studentave;
                               $sturecords=$SHResultOOP->allresultedit('students', 'stid', $stid);
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
                                 $resultdata=$SHResultOOP->allresultedit5($resulttblname, 'stid', $stid, 'levelid', $levelid, 'courseid', trim($courserec1['csid']), 'semesterid', $semesterid, 'sessionid', $sessionid);
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
                            //Getting the passmark of a class
                              $passmarkdata=$SHResultOOP->allresultedit('passmark', 'passmarkid', trim($fieldrecord["levelid"]));
                            if (is_array($passmarkdata)) { 
                                foreach($passmarkdata as $passmarkrec){
                                  $passmark2=$passmarkrec['passmark'];
                                }
                              }
                            ?>
                            
                           <?php 
                           
                           
                           //getting the total of first term score
                            $positioncheck1=$SHResultOOP->allresultedit4($positiontblname, 'stid', trim($stid), 'levelid', $levelid, 'semesterid', 1, 'sessionid', $sessionid);
                                   if (is_array($positioncheck1)) {
                                    foreach($positioncheck1 as $positioncheckrec1){ 
                                      $total1stterm=trim($positioncheckrec1['score']); 
                                    }
                                  }
                                  
                            

                            //Getting the total of second term
                                 $positioncheck2=$SHResultOOP->allresultedit4($positiontblname, 'stid', trim($fieldrecord['stid']), 'levelid', $levelid,'semesterid', 2, 'sessionid', $sessionid);
                                   if (is_array($positioncheck2)) {
                                    foreach($positioncheck2 as $positioncheckrec2){ 
                                      $total2ndterm=trim($positioncheckrec2['score']);
                                    }
                                  }

                             //Getting the total of second term
                                 $positioncheck3=$SHResultOOP->allresultedit4($positiontblname, 'stid', trim($fieldrecord['stid']), 'levelid', $levelid,  'semesterid', 2, 'sessionid', $sessionid);
                                   if (is_array($positioncheck3)) {
                                    foreach($positioncheck3 as $positioncheckrec3){ 
                                      $total3rdterm=trim($positioncheckrec3['score']);
                                    }
                                  }?>

                                <td  style="padding: 0px; margin:0px; border-collapse: collapse;" cellspacing="0px" cellpadding="0px"><?php echo $studenttotal; ?> </td>
                              <td  style="padding: 0px; margin:0px; border-collapse: collapse;" cellspacing="0px" cellpadding="0px" <?php if ($studentaverage< $passmark2) {?> style="color:red"   <?php }?> ><?php echo $studentaverage; ?> </td>  
                             <?php  if ($semesterid==1) { ?>
                             <td  style="padding: 0px; margin:0px; border-collapse: collapse;" cellspacing="0px" cellpadding="0px"><?php  echo $total1stterm; ?> </td>
                           <?php   }elseif ($semesterid==2) {?>
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
                              <td  style="padding: 0px; margin:0px; border-collapse: collapse;" cellspacing="0px" cellpadding="0px"><?php $totalround=floor($studentaverage); echo $remarkname=$SHResultOOP->grade('remark', $scoredeptid, $totalround); ?></td>                                  
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
        <!-- /page content -->

       <?php include("includes/footerempty.php"); ?>

       