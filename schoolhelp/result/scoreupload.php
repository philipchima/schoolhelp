<?php
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHresultOOP.php");
include_once("../phpclass/SHresultupdate.php");
include_once("../phpclass/SHresultinserts.php");
confirmcheckin();
$SHResultOOP=new ClassResult;
$pagename="Assessments Score Upload";


// Checking page access Authenticity
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp=trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$page=trim(isset($_GET['page'])?$_GET['page']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

$previlleges=$SHResultOOP->allresultedit('adminpersons', 'adminid', $schoolhelp);
if ($previlleges) {
  
foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['uploadscore_r']);
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
    $classtype="";
    $sessionid=trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);
    $semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
    $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
    $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);
    $courseid=trim(isset($_POST['courseid'])?$_POST['courseid']:false);

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

                             $coursedata=$SHResultOOP->allresultedit('course', 'csid', $courseid);
                            if (is_array($coursedata)) {
                              foreach($coursedata as $courserec){ 
                                $coursename=trim($courserec['csname']); 
                              }
                            }

                               //Checking whether these class is a pre-class or early class
                                if($classtype==1){

                                     echo "<script>
                                            alert('Attenton Please:  This class is a pre-class');
                                            window.location.href='earlyscoreupload?schoolhelp=$schoolhelp&sql=$sql';
                                          </script>";
                                }

}


if ($page==4) {
  $k=0;
      $sessionid=trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);
    $semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
    $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
   $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);
     $courseid=trim(isset($_POST['courseid'])?$_POST['courseid']:false);
     $deptid=trim(isset($_POST['deptid'])?$_POST['deptid']:false);

      $studid=isset($_POST['studid'])?$_POST['studid']:false;

     $udate=date("Y-m-d H:i:s");
     $odate=date("Y-m-d");
      $bno = count($studid);
      $Cnt = 0;
      $stuNo = $bno;
      $Cnt333 = 0;
      
  if ($bno>0) {

    $scoretblname="score".$deptid;
        $insertedrow=0;
      for($i=0; $i < $bno; $i++){

      $stid= (int)$studid[$i];
      $assessmentid="";

        $assessmentdata1=$SHResultOOP->allresultedit('assessment', 'departmentid', $deptid);
                            if (is_array($assessmentdata1)) {
                              foreach($assessmentdata1 as $assessmentrec1){ 
                                $assessmentid=trim($assessmentrec1['assid']);

                                $scoreidname='scoreid'.$stid.trim($assessmentrec1['assid']);
                                $scorename= 'score'.$stid.trim($assessmentrec1['assid']);
                                $scorestatus= 'status'.$stid.trim($assessmentrec1['assid']);
                                $scoreid=trim(isset($_POST["{$scoreidname}"])?$_POST["{$scoreidname}"]:false);
                                $score=trim(isset($_POST["{$scorename}"])?$_POST["{$scorename}"]:false);
                                
                              //checking whether score has been submitted before
                                 $scoredata=$SHResultOOP->allresultedit7($scoretblname, 'stid', $stid, 'levelid', $levelid, 'optionid', $optionid, 'courseid', $courseid, 'assessmentid', $assessmentid, 'semesterid', $semesterid, 'sessionid', $sessionid);
                            if (is_array($scoredata)) {
                              foreach($scoredata as $scoredatarec){ 
                                $score_tbl_id=trim($scoredatarec['scoreid']);
                                $score_tbl_status=trim($scoredatarec['status']);
                                $score_tbl_score=trim($scoredatarec['score']);
                              }
                              //Updating Score
                              
                              $tableUpdate= new updateTable;
                            $state= $tableUpdate->update_score($scoretblname, 'scoreid', $scoreid, 'score',  $score, 'operatorid', $schoolhelp, 'udate', $udate);
                              //Counting number of record that updated
                                  if ($state=="Success") {
                                    $k+=1;
                                  }
                      
                            }else{
                              //check whether the input box is empty
                              if ($score!="") {
                                //Inserting New Score
                                
                                  $tablestudents=new insertTable;
                                  $state=$tablestudents->insert_score($scoretblname, $sessionid, $semesterid, $levelid, $optionid, $stid, $courseid, $assessmentid, $score, 'operatorid', $schoolhelp, 'udate', $udate, $odate);
                                  
                                  $insertedrow+=$state['counting'];

                              }

                            }
                }
              }

              

       }//Closing Student loop
       $inserting="No of Inserted record=".$insertedrow;
       $updating="No of update record=".$k;
       $sql=$inserting.';  '.$updating;
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
                           <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> Score Upload</a></li>
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
                        <legend>Upload Scores</legend>
                        
                             
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
                        <select  id="levelid" required="required" name="levelid" class="form-control col-md-2" onchange="retrieveselection1('optiontable', 'levelid', this.value, 0, 0, 'retrieveselection', 'opencontainer');">
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
                    $x=0;
                    $score_tbl_id=""; 
                     $score_tbl_score="";
                     $score_status="";
                     $assessmentid="";

                    $score_tbl_status="";        
                    ?>  
                    <fieldset>
                        <legend style="color:#063"> Score Upload</legend>
                        <form method="POST" action="?schoolhelp=<?php echo $schoolhelp; ?>&page=4">
                          <input name="optionid"  id="optionid" value="<?php  echo trim($optionid); ?>" type="hidden"/>
                          <input name="levelid"  id="levelid" value="<?php  echo trim($levelid); ?>" type="hidden"/>
                          <input name="semesterid"  id="semesterid" value="<?php  echo trim($semesterid); ?>" type="hidden"/>
                          <input name="sessionid"  id="sessionid" value="<?php  echo trim($sessionid); ?>" type="hidden"/>
                           <input name="courseid"  id="courseid" value="<?php  echo trim($courseid); ?>" type="hidden"/>
                          <input name="deptid"  id="deptid" value="<?php  echo trim($scoredeptid); ?>" type="hidden"/>
                            
                      <div class="x_panel" >
                       
                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <center><caption><h1><?php echo $levelname.' '.$optionname .' => '.$coursename ; ?></h1></caption></center>
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Reg No</th>
                          <th>Surname</th>
                          <th>Othername</th>
                          <?php
                          $assessmentdata=$SHResultOOP->allresultedit('assessment', 'departmentid', $scoredeptid);
                            if (is_array($assessmentdata)) {
                              foreach($assessmentdata as $assessmentrec){ 
                            ?>
                              <th><?php echo $assessmentrec['assname'].' '.' ( '.$assessmentrec['asspercent'].'% ) '; ?></th>
                              
                           <?php   }
                           ?>
                           <th>Delete</th>
                           <?php  }
                            ?>
                          
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 

                            ?>
                            
                           <?php  
                           
                            $scoretblname="score".$scoredeptid;
                            $records=$SHResultOOP->allresultedit3('students', 'levelid', $levelid, 'optid', $optionid, 'status', 0);
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                               $k+=1;
                               
                               $stid=trim($fieldrecord['stid']);
                        ?>
                                      <tr>
                                        <td><?php echo  $k; ?><input name="studid[]"  id="studid[]" value="<?php  echo trim($fieldrecord['stid']); ?>" type="hidden"/></td>
                                        <td><?php echo  $fieldrecord['regno']; ?></td>
                                        <td><?php echo  $fieldrecord['surname']; ?></td>
                                        <td><?php echo  $fieldrecord['othername']; ?></td>

                                        
                                        <?php
                          $assessmentdata1=$SHResultOOP->allresultedit('assessment', 'departmentid', $scoredeptid);
                            if (is_array($assessmentdata1)) {
                              foreach($assessmentdata1 as $assessmentrec1){ 
                                $assessmentid=trim($assessmentrec1['assid']);
                                $scoreid="";
                                 $score_tbl_id="";
                                $score_tbl_status="";
                                $score_tbl_score="";
                              //checking whether score has been submitted before
                                 $scoredata=$SHResultOOP->allresultedit7($scoretblname, 'stid', $stid, 'levelid', $levelid, 'optionid', $optionid, 'courseid', $courseid, 'assessmentid', $assessmentid, 'semesterid', $semesterid, 'sessionid', $sessionid);
                            if (is_array($scoredata)) {
                              foreach($scoredata as $scoredatarec){ 
                                $score_tbl_id=trim($scoredatarec['scoreid']);
                                $score_tbl_status=trim($scoredatarec['status']);
                                $score_tbl_score=trim($scoredatarec['score']);
                              }
                            }
                                ?>
                                <input type='text' name='<?php echo "scoreid".$fieldrecord['stid'].$assessmentrec1["assid"]; ?>' value='<?php echo $score_tbl_id;?>' style='width:0%;'  hidden/>
                            <input type='text' name='<?php echo "status".$fieldrecord["stid"].$assessmentrec1["assid"]; ?>' value='<?php echo $score_tbl_status; ?>' style='width:0%;'  hidden/>
                            <td> <input type="text" class="form-control col-md-7 col-xs-12"  name='<?php echo "score".$fieldrecord['stid'].$assessmentrec1["assid"]; ?>' value='<?php echo $score_tbl_score; ?>' id="<?php echo "idname".$score_tbl_id; ?>" onchange='return checkscore(this, "<?php echo $assessmentrec1['asspercent']?>");' <?php //if($score_tbl_status==1){ echo readonly ?>  <?php //} ?> placeholder="Enter <?php echo $assessmentrec1['assname']; ?> score">
                               <?php if($score_tbl_status==0 && $score_tbl_id!=""){?>
                            <div class="btn btn-success"  style=" float:left" class="btn btn-success" onClick="updateassessment('<?php echo $scoretblname; ?>',  'scoreid', '<?php echo $score_tbl_id; ?>', 'score', $('#<?php echo 'idname'.$score_tbl_id; ?>').val(), 'operatorid','<?php echo $schoolhelp ?>', 'udate', '<?php echo date("Y-m-d H:i:s") ?>', 'assessmentupdate');">Update</div> <?php } 

                    //Checking whether there is redundancy
                              $scoredata1=$SHResultOOP->allresultedit8not($scoretblname, 'stid', $stid, 'levelid', $levelid, 'optionid', $optionid, 'courseid', $courseid, 'assessmentid', $assessmentid, 'semesterid', $semesterid, 'sessionid', $sessionid, 'scoreid', $score_tbl_id);
                            if (is_array($scoredata1)) {
                              foreach($scoredata1 as $scoredatarec1){ 
                                $dscoreid=trim($scoredatarec1["scoreid"]);
                      ?>
                    <input style="background:red" type='button' id="<?php echo $dscoreid; ?>"  name="<?php echo $dscoreid; ?>" value='<?php echo $scoredatarec1["score"]; ?>' onClick="deleteassessment('<?php echo $scoretblname; ?>', 'scoreid', '<?php echo $dscoreid; ?>', 'deleteassessment');">
                               
                         <?php     }
                            } ?>
                            </td>
                            
                           
                           <?php  } ?>
                           <td> <?php if($score_tbl_id!=""){?> <input style="background:red" type='button' id="deleteresult<?php echo $stid ?>"  name="deleteresult<?php echo $stid ?>" value="Delete" onClick="deleteresult('twotblwithsixfield', '<?php echo "score".$scoredeptid ?>', '<?php echo "result".$scoredeptid ?>', 'stid', '<?php echo $stid; ?>', 'levelid', '<?php echo $levelid ?>', 'optionid', '<?php echo $optionid ?>', 'courseid', '<?php echo $courseid; ?>', 'semesterid', '<?php echo $semesterid ?>', 'sessionid', '<?php echo $sessionid ?>');"> <?php } ?></td>
                          <?php  }else{echo "Assessments not assigned yet to this department"; }
                            ?>
                                        
                                      </tr>
                             <?php }
                              }
                             ?>
                        
                      </tbody>
                    </table>
                  
                     <div class="row no-print" style="margin-bottom: 50px">
                        <div class="col-xs-12">
                         <?php if ($score_tbl_id=="") {?>
                         <div class="col-xs-6"><button type="submit" class="btn btn-success " ><i class="fa fa-send"></i> Submit</button></div>
                         <?php } else{ ?>
                          <div class="col-xs-6"><button type="submit" class="btn btn-success " ><i class="fa fa-send"></i> Update</button></div>
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