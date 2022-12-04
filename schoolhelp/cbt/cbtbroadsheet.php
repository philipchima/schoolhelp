<?php
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHcbtOOP.php");
include_once("../phpclass/SHcbtupdate.php");
include_once("../phpclass/SHcbtinserts.php");
include_once("../phpclass/schoolhelpothers.php");

confirmcheckin();
$SHCbtOOP=new ClassCbt;
$pagename="CBT Broadsheet Sheet";
$tablestudents=new insertTable;
 $tableUpdate= new updateTable;

// Checking page access Authenticity


$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp=trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$page=trim(isset($_GET['page'])?$_GET['page']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

$previlleges=$SHCbtOOP->allresultedit('adminpersons', 'adminid', $schoolhelp);
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
$admindata=$SHCbtOOP->allresultedit('adminpersons', 'adminid', $schoolhelp);
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

$signatorydata=$SHCbtOOP->allresultedit('signatoryposition', 'signatorypositionid', $signatorypositionid);
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
                           
                          $leveldata=$SHCbtOOP->allresultedit('level', 'levelid', $levelid);
                            if (is_array($leveldata)) {
                              foreach($leveldata as $levelrec){ 
                                $scoredeptid=trim($levelrec['departmentid']); 
                                $levelname=trim($levelrec['levelname']); 
                              }
                            }
                             $optiondata=$SHCbtOOP->allresultedit('optiontable', 'optid', $optionid);
                            if (is_array($optiondata)) {
                              foreach($optiondata as $optionrec){ 
                               
                                $optionname=trim($optionrec['optname']); 
                              }
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
                           <li ><a  href="scoresheet?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> Score Sheet</a></li>
                           <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> Broad Sheet</a></li>
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
                        <legend>Broad Sheet</legend>
                            
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
                               $retrievedata1=$SHCbtOOP->allresult('session', 'sessionid', 'desc');
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
                              $retrievedata=$SHCbtOOP->allresult('semesters', 'semesterid', 'desc');
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
                            $levelmethod=$SHCbtOOP->allresult('level','levelid','asc');
                            if (is_array($levelmethod)) {
                            foreach($levelmethod as $leveldata){

                               $deptdata=$SHCbtOOP->allresultedit('department', 'did', $leveldata['departmentid']);
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
                    <fieldset>
                        <legend style="color:#063"> Broad Sheet</legend>
                        <form method="POST"  name="frmscoresheet">
                          <input name="optionid"  id="optionid" value="<?php  echo trim($optionid); ?>" type="hidden"/>
                          <input name="levelid"  id="levelid" value="<?php  echo trim($levelid); ?>" type="hidden"/>
                          <input name="semesterid"  id="semesterid" value="<?php  echo trim($semesterid); ?>" type="hidden"/>
                          <input name="sessionid"  id="sessionid" value="<?php  echo trim($sessionid); ?>" type="hidden"/>
                          
                          <input name="deptid"  id="deptid" value="<?php  echo trim($scoredeptid); ?>" type="hidden"/>

                                  
                          
                          <div><h3 style="color:green"><?php echo $sql; ?></h3></div>  
                      <div class="x_panel" >
                       
                    <table  style="width:100%; text-align: center" class="table table-striped table-bordered table-responsive" id="printrecord">
                      <center><caption><h1><?php echo $levelname.'  => '.$optionname ; ?></h1></caption></center>
                      <thead style="margin: 0px; padding: 0px;">
                        <tr>
                          <th>SN</th>
                      
                          <th>Fullname</th>
                        
                          <?php
                          $coursedata=$SHCbtOOP->allresultedit('course', 'departmentid', $scoredeptid);
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

                            
                           <?php  
                            //calculating position based on Singular or accummulated result
                              $singularresult="";
                               $activationrecords=$SHCbtOOP->allresultedit('resultactivations', 'titlename', 'Singular Result');
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

                           $k=0; 
                           $coursescoretotal=array();
                            
                            $overalltotal="";
                            $overallaverage="";
                             $p="";
                            $studentave="";
                            $i=0;
                            $actualposition="";
                           
                          //checks of equal average
                          $equalave="";


                            $records=$SHCbtOOP->allposi4sort($positiontblname, $levelid, $optionid, $sessionid, $semesterid, 'average', 'DESC');
                              if(is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                               $studentave=$fieldrecord[$posi_measure];
                                $k+=1;  
                              
                              $p=0;
                            //checking whether an average is not empty
                             $actualposition=$k;
                             
                             //checking 4 tally average, so to calculate position very well
                                if ($studentave==$equalave) {
                                  $p=1;
                                  $actualposition-=$p;
                                }
                              
                              $stid=trim($fieldrecord['stid']);
                               $equalave=$studentave;
                               
                               $sturecords=$SHCbtOOP->allresultedit('students', 'stid', $stid);
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
                                 $resultdata=$SHCbtOOP->allresultedit6($resulttblname, 'stid', $stid, 'levelid', $levelid, 'optionid', $optionid, 'courseid', trim($courserec1['csid']), 'semesterid', $semesterid, 'sessionid', $sessionid);
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
                              $passmarkdata=$SHCbtOOP->allresultedit('passmark', 'passmarkid', trim($fieldrecord["levelid"]));
                            if (is_array($passmarkdata)) { 
                                foreach($passmarkdata as $passmarkrec){
                                  $passmark2=$passmarkrec['passmark'];
                                }
                              }
                            ?>
                            
                           <?php 
                           //getting the total of first term score
                            $positioncheck1=$SHCbtOOP->allpositionedit5($positiontblname, 'stid', trim($fieldrecord['stid']), 'levelid', $levelid, 'optionid', $optionid, 'semesterid', 1, 'sessionid', $sessionid);
                                   if (is_array($positioncheck1)) {
                                    foreach($positioncheck1 as $positioncheckrec1){ 
                                      $total1stterm=trim($positioncheckrec1['score']);
                                    }
                                  }

                            //Getting the total of second term
                                 $positioncheck2=$SHCbtOOP->allpositionedit5($positiontblname, 'stid', trim($fieldrecord['stid']), 'levelid', $levelid, 'optionid', $optionid, 'semesterid', 2, 'sessionid', $sessionid);
                                   if (is_array($positioncheck2)) {
                                    foreach($positioncheck2 as $positioncheckrec2){ 
                                      $total2ndterm=trim($positioncheckrec2['score']);
                                    }
                                  }

                             //Getting the total of second term
                                 $positioncheck3=$SHCbtOOP->allpositionedit5($positiontblname, 'stid', trim($fieldrecord['stid']), 'levelid', $levelid, 'optionid', $optionid, 'semesterid', 2, 'sessionid', $sessionid);
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
                              <td  style="padding: 0px; margin:0px; border-collapse: collapse;" cellspacing="0px" cellpadding="0px" <?php if (trim($fieldrecord['accaverage'])< $passmark2) {?> style="color:red"   <?php }?> ><?php if ($fieldrecord['accaverage']!="") { $cumuaveragescores+=$fieldrecord['accaverage']; $acc_ave_count+=1; } echo $fieldrecord['average']; ?> </td>  
                              <td  style="padding: 0px; margin:0px; border-collapse: collapse;" cellspacing="0px" cellpadding="0px"><?php echo Others::ordinalize($actualposition); ?> </td>
                              <td  style="padding: 0px; margin:0px; border-collapse: collapse;" cellspacing="0px" cellpadding="0px"><?php $totalround=floor($studentaverage); echo $SHCbtOOP->grade('remark', $scoredeptid, $totalround); ?></td>                                  
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
                  
                     <div class="row no-print" style="margin-bottom: 50px">
                        <div class="col-xs-12">
                         
                          <div class="col-xs-6"><button type="submit" class="btn btn-success" onClick="return broadsheet('<?php echo $schoolhelp; ?>', 2)"><i class="fa fa-send"></i> Print BroadSheet</button></div>
                       
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

       