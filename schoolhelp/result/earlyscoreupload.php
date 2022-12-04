<?php
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHresultOOP.php");
include_once("../phpclass/SHresultupdate.php");
include_once("../phpclass/SHresultinserts.php");
confirmcheckin();
$SHResultOOP=new ClassResult;

$pagename="Early Class Score Upload";


// Checking page access Authenticity
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp=trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$page=trim(isset($_GET['page'])?$_GET['page']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);
$odate=date("Y-m-d");
$udate=date("Y-m-d H:i:s");

$previlleges=$SHResultOOP->allresultedit('adminpersons', 'adminid', $schoolhelp);
if (is_array($previlleges)) {
  
foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['earlyscore_r']);
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
    $studentid=trim(isset($_POST['studentid'])?$_POST['studentid']:false);

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

                             $coursedata=$SHResultOOP->allresultedit('students', 'stid', $studentid);
                            if (is_array($coursedata)) {
                              foreach($coursedata as $courserec){ 

                                $studentname=trim($courserec['surname']." ".$courserec['othername']); 
                              }
                            }

                               
}

if ($page==4) {
  $k=0;
    $sessionid=trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);
    $semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
    $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
    $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);
    $studentid=trim(isset($_POST['studentid'])?$_POST['studentid']:false);
    $noofschooldays=trim(isset($_POST['noofschooldays'])?$_POST['noofschooldays']:false);
    $noofdaysattended=trim(isset($_POST['noofdaysattended'])?$_POST['noofdaysattended']:false);
    $earlycattendid=trim(isset($_POST['earlycattendid'])?$_POST['earlycattendid']:false);
    $comment=trim(isset($_POST['comment'])?$_POST['comment']:false);
    $headcomment=trim(isset($_POST['headcomment'])?$_POST['headcomment']:false);
    $insertedrow="";
                                
                              //checking whether score has been submitted before
                               $earlycmentattend1=$SHResultOOP->allresultedit5('earlycmentattend', 'stid', $studentid , 'sessionid', $sessionid, 'semesterid', $semesterid, 'levelid', $levelid, 'optionid', $optionid);
                                  if (is_array($earlycmentattend1)) {
                                    foreach($earlycmentattend1 as $key7 => $earlycmentattendrec1){
                                     $earlycattendid1=trim($earlycmentattendrec1['earlycattendid']);
                                    }

                            //Updating Score
                            $tableUpdate= new updateTable;
                            $state= $tableUpdate->update_sixfields('earlycmentattend', 'earlycattendid', $earlycattendid1, 'comment',  $comment, 'headcomment',  $headcomment, 'noofschooldays', $noofschooldays, 'noofdaysattended', $noofdaysattended, 'operatorid', $schoolhelp, 'udate', $udate);
                              //Counting number of record that updated
                                  if ($state=="Success") {
                                    $k+=1;
                                  }
                      
                            }else{
                              //check whether the input box is empty
                              
                                //Inserting New Score
                                
                                  $tablestudents=new insertTable;
                                  $state=$tablestudents->insert_12fields('earlycmentattend', 'stid', $studentid, 'sessionid', $sessionid, 'semesterid', $semesterid, 'levelid', $levelid, 'optionid', $optionid,  'comment',  $comment, 'headcomment',  $headcomment, 'noofschooldays', $noofschooldays, 'noofdaysattended', $noofdaysattended, 'operatorid', $schoolhelp, 'udate', $udate, 'odate', $odate);
                                  
                                  
                                  $insertedrow+=1;      

       }
       $inserting="No of Inserted record=".$insertedrow;
       $updating="No of update record=".$k;
       $sql=$inserting.';  '.$updating;
      
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
                            <th class="col-md-2"> Option/Arm:</th>
                            <th class="col-md-2">Student: </th>                
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
                        <select  id="levelid" required="required" name="levelid" class="form-control col-md-2" onchange="retrieveselection1('optiontable', 'levelid', this.value, 0, 0, 'retrieveselection5', 'opencontainer');">
                            <option value="">--Select Level--</option>
                            <?php
                            $levelmethod=$SHResultOOP->allresultedit('level','classtype',1);
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
                        
                          <select  id="optionid" required="required" name="optionid" class="form-control col-md-2" >
                            <option value="">--Select Option--</option> 
                          </select>                                                                                                                                                         
                       </td>
                        <td id="opencontainer1">
                            <select  id="studentid" required="required" name="studentid" class="form-control col-md-2" >
                            <option value="">--Select Student--</option>
                          </select>                                                                                                                                                            
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
                    ?>  
                    <fieldset>
                        <legend style="color:#063">Early Class Score Upload</legend>
                        <form method="POST" action="?schoolhelp=<?php echo $schoolhelp; ?>&page=4">
                          <input name="optionid"  id="optionid" value="<?php  echo trim($optionid); ?>" type="hidden"/>
                          <input name="levelid"  id="levelid" value="<?php  echo trim($levelid); ?>" type="hidden"/>
                          <input name="semesterid"  id="semesterid" value="<?php  echo trim($semesterid); ?>" type="hidden"/>
                          <input name="sessionid"  id="sessionid" value="<?php  echo trim($sessionid); ?>" type="hidden"/>
                           <input name="studentid"  id="studentid" value="<?php  echo trim($studentid); ?>" type="hidden"/>
                          <input name="deptid"  id="deptid" value="<?php  echo trim($scoredeptid); ?>" type="hidden"/>
                            
                      <div class="x_panel" >
          <?php 
          $ecscount="";
          $ecscountreminder="";
          $ecscountdivision="";
          $secondcolumnrec="";
          $gradetitle="";
          $gradetitle1="";
          $k=0;
          $f=0;
          $s=0;
          $earlyclassscore=$SHResultOOP->allresultedit('earlyclasscategory', 'levelid',  $levelid);
          if (is_array($earlyclassscore)) {
            
          $ecscount=count($earlyclassscore);
          $ecscountreminder=$ecscount%2;
          $ecscountdivision=floor($ecscount/2);
          

          if ($ecscountreminder>0) {
            $firstcolumnrec=$ecscountdivision+$ecscountreminder;
            
            $secondcolumnrec=$ecscountdivision;
          }else{
            $firstcolumnrec=$ecscountdivision;
            $secondcolumnrec=$ecscountdivision;
          }
          $firstcolumnarray=array();
          $secondcolumnarray=array();
          $firstcolumnarray1=array();
          $secondcolumnarray1=array();
          $gradearray=array();

            $gradearray['id']="";
                  $gradearray['name']="";
                  $gradearray['des']="";

          //Collecting record from early class category table with an array variable
          foreach($earlyclassscore as $earlyclassrecord){
            $k+=1;
            $earlycatid=trim($earlyclassrecord['earlycatid']);
            if ($k<=$firstcolumnrec) {
              $f+=1;
              if (!isset($firstcolumnarray['earlycatid'.$f])) {
                $firstcolumnarray['earlycatid'.$f]="";
              }
              $firstcolumnarray['earlycatid'.$f]=$earlyclassrecord['earlycatid'];
              if (!isset($firstcolumnarray['earlycatname'.$f])) {
                $firstcolumnarray['earlycatname'.$f]="";
              }
              $firstcolumnarray['earlycatname'.$f]=$earlyclassrecord['earlycatname'];
            }

             if ($k>$firstcolumnrec) {
              $s+=1;
               if (!isset($secondcolumnarray['earlycatid'.$s])) {
                $secondcolumnarray['earlycatid'.$s]="";
              }
              $secondcolumnarray['earlycatid'.$s]=$earlyclassrecord['earlycatid'];
              if (!isset($secondcolumnarray['earlycatname'.$s])) {
                $secondcolumnarray['earlycatname'.$s]="";
              }
              $secondcolumnarray['earlycatname'.$s]=$earlyclassrecord['earlycatname'];

             
            }

          }

           //Collecting record from early class grade table with an array variable
           $earlygradedata=$SHResultOOP->allresultedit('earlygrade', 'levelid', $levelid);
              if (is_array($earlygradedata)) {
                $l=0;
                foreach($earlygradedata as $key1 => $earlygraderec){
                $l+=1;
                  $gradearray['id'.$l]=trim($earlygraderec['earlygradeid']); 
                  if (!isset($gradearray['name'.$l])) {
                   $gradearray['name'.$l]="";
                  }
                    $gradearray['name'.$l]=trim($earlygraderec['gradename']);
                  $gradearray['des'.$l]=trim($earlygraderec['description']);

              }
            }
          ?>
          <table  style="width:100%" class="table table-striped table-bordered table-responsive">
            <center><caption><h1><?php echo $levelname.' '.$optionname .' => '.$studentname ; ?></h1></caption></center>

              <tr>
                <td>
                  <table class="table table-responsive table-striped">
                    <?php if (is_array($firstcolumnarray)) { 
                      $fss=0;
                     
                      
                      for($u=1; $u<=$firstcolumnrec; $u++) { //this loop through the stored category in an array
                      $fss+=1;
                       $retrievecatid=trim($firstcolumnarray['earlycatid'.$fss]);
                       
                      ?>
                      <input name="earlycatid[]" value="<?php echo trim($firstcolumnarray['earlycatid'.$fss]); ?>" type="text" hidden="hidden">
                    <tr style="margin:0px">
                      <td style="margin:0px; width:70% ; background:#063; color:white"><b><?php echo $firstcolumnarray['earlycatname'.$fss]; ?></b></td>
                      <?php //Placing the Grade Names
                      if (is_array($gradearray)) { 
                        

                        for ($c=1; $c<=$l; $c++) {
                          
                          if ($gradetitle=="") { ?>
                            <td style="margin:0px; width:10%; background: #d2dc2a"><b><?php echo $gradearray['name'.$c] ?></b></td>
                            <?php    }else{
                             ?> 
                              <td style="margin:0px; width:10%; background: #d2dc2a"></td>
                            <?php 
                                 }
                               }
                              
                      } 
                    ?>
                    </tr>
              <?php //Collecting record from early class grade table with an array variable
              $earlycatsubdata=$SHResultOOP->allresultedit('earlycatsub', 'earlyclasscatid', $retrievecatid);
              if (is_array($earlycatsubdata)) {
                foreach($earlycatsubdata as $key3 => $earlycatsubrec){
                  $markgradeid="";
                  $earlyscoreid="";
                  $earlycatsubid=trim($earlycatsubrec['earlycatsubid']);
              //checking whether this result has been marked
              $earlyscoredata=$SHResultOOP->allresultedit6('earlyclassscore', 'earlycatsubid', $earlycatsubrec['earlycatsubid'], 'stid', $studentid, 'sessionid', $sessionid, 'semesterid', $semesterid, 'levelid', $levelid, 'optionid', $optionid);
              if (is_array($earlyscoredata)) {
                foreach($earlyscoredata as $key4 => $earlyscorerec){
                  $markgradeid=trim($earlyscorerec['gradeid']);
                  $earlyscoreid=trim($earlyscorerec['earlyscoreid']);
                }
              }
                 ?>

                     <tr style="margin:0px; width:70%">
                      <td style="margin:0px"><?php echo $earlycatsubrec['subcatname']; ?></td>
                       <?php //Placing the Grade Names
                      if (is_array($gradearray)) { 
                        $keygrade="";
                         for ($d=1; $d<=$l; $d++) { 
                          $keygrade+=1;
                         $actualgradeid=trim($gradearray['id'.$d]);
                          ?>
                          <td style="margin:0px; width:10%"><input type="radio"  name="<?php echo trim($retrievecatid).trim($earlycatsubrec['earlycatsubid']); ?>" <?php if ($actualgradeid==$markgradeid){ ?> checked="checked"  value="<?php echo $actualgradeid; ?>" <?php }else{?> unchecked value=""  <?php } ?>  onClick="uploadassessment('earlyclassscore', 'earlyscoreid', '<?php echo $earlyscoreid; ?>', 'gradeid', '<?php echo $actualgradeid; ?>', 'stid', '<?php echo $studentid; ?>', 'sessionid', '<?php echo $sessionid ?>', 'semesterid', '<?php echo $semesterid; ?>', 'levelid', '<?php echo $levelid; ?>', 'optionid', '<?php echo $optionid; ?>', 'operatorid','<?php echo $schoolhelp ?>', 'udate', '<?php echo date("Y-m-d H:i:s"); ?>', 'odate', '<?php echo date("Y-m-d"); ?>', 'earlycatsubid', '<?php echo $earlycatsubid; ?>', 'earlyassessment');"></td>  
                            <?php 
                            } 
                      } 
                    ?>

                    </tr>
                <?php
                    }
                } ?>
                    <?php
                    $gradetitle=1;
                      } //earlycategory loop end
                     } ?>
                  </table>
                </td>

                <td>
                  <table class="table table-responsive table-striped">
                    <?php if (is_array($secondcolumnarray)) { 
                      $fss=0;
                      $actualgradeid="";
                      
                      for($u=1; $u<=$secondcolumnrec; $u++) { //this loop through the stored category in an array
                      $fss+=1;
                       $retrievecatid=trim($secondcolumnarray['earlycatid'.$fss]);
                       
                      ?>
                      <input name="earlycatid[]" value="<?php echo trim($secondcolumnarray['earlycatid'.$fss]); ?>" type="text" hidden="hidden">
                    <tr style="margin:0px">
                      <td style="margin:0px; width:70%; background:#063; color:white"><b><?php echo $secondcolumnarray['earlycatname'.$fss]; ?></b></td>
                      <?php //Placing the Grade Names
                      if (is_array($gradearray)) { 
                        

                        for ($c=1; $c<=$l; $c++) {
                          
                          if ($gradetitle1=="") { ?>
                            <td style="margin:0px; width:10%; background: #d2dc2a"><b><?php echo $gradearray['name'.$c] ?></b></td>
                            <?php    }else{
                             ?> 
                              <td style="margin:0px; width:10%; background: #d2dc2a"></td>
                            <?php 
                                 }
                               }
                              
                      } 
                    ?>
                    </tr>
              <?php //Collecting record from early class grade table with an array variable
              $earlycatsubdata=$SHResultOOP->allresultedit('earlycatsub', 'earlyclasscatid', $retrievecatid);
              if (is_array($earlycatsubdata)) {
                foreach($earlycatsubdata as $key3 => $earlycatsubrec){
                   $markgradeid="";
                  $earlyscoreid="";
                  $earlycatsubid=trim($earlycatsubrec['earlycatsubid']);
              //checking whether this result has been marked
              $earlyscoredata=$SHResultOOP->allresultedit6('earlyclassscore', 'earlycatsubid', $earlycatsubrec['earlycatsubid'], 'stid', $studentid, 'sessionid', $sessionid, 'semesterid', $semesterid, 'levelid', $levelid, 'optionid', $optionid);
              if (is_array($earlyscoredata)) {
                foreach($earlyscoredata as $key4 => $earlyscorerec){
                   $markgradeid=trim($earlyscorerec['gradeid']);
                  $earlyscoreid=trim($earlyscorerec['earlyscoreid']);
                }
              }
                 ?>

                     <tr style="margin:0px; width:70%">
                      <td style="margin:0px"><?php echo $earlycatsubrec['subcatname']; ?></td>
                       <?php //Placing the Grade Names
                      if (is_array($gradearray)) { 
                        $keygrade="";
                         for ($d=1; $d<=$l; $d++) { 
                          $keygrade+=1;
                         $actualgradeid=trim($gradearray['id'.$d]);
                          ?>
                          <td style="margin:0px; width:10%"><input type="radio"  name="<?php echo trim($retrievecatid).trim($earlycatsubrec['earlycatsubid']); ?>" <?php if ($actualgradeid==$markgradeid){ ?> checked="checked"  value="<?php echo $actualgradeid; ?>" <?php }else{?> unchecked value=""  <?php } ?>  onClick="uploadassessment('earlyclassscore', 'earlyscoreid', '<?php echo $earlyscoreid; ?>', 'gradeid', '<?php echo $actualgradeid; ?>', 'stid', '<?php echo $studentid; ?>', 'sessionid', '<?php echo $sessionid ?>', 'semesterid', '<?php echo $semesterid; ?>', 'levelid', '<?php echo $levelid; ?>', 'optionid', '<?php echo $optionid; ?>', 'operatorid','<?php echo $schoolhelp ?>', 'udate', '<?php echo date("Y-m-d H:i:s"); ?>', 'odate', '<?php echo date("Y-m-d"); ?>', 'earlycatsubid', '<?php echo $earlycatsubid; ?>', 'earlyassessment');"></td>  
                              
                            <?php 
                               }
                              
                      } 
                    ?>

                    </tr>
              <?php
                  }
              } ?>
                    <?php
                    $gradetitle1=1;
                      } //earlycategory loop end
                     } ?>


                  </table> 
                  <?php 
              $earlycattendid="";
              $comment="";
              $headcomment="";
              $noofschooldays="";
              $noofdaysattended="";

              $earlycmentattend=$SHResultOOP->allresultedit5('earlycmentattend', 'stid', $studentid , 'sessionid', $sessionid, 'semesterid', $semesterid, 'levelid', $levelid, 'optionid', $optionid);
              if (is_array($earlycmentattend)) {
                foreach($earlycmentattend as $key6 => $earlycmentattendrec){
                 $earlycattendid=trim($earlycmentattendrec['earlycattendid']);
                 $comment=trim($earlycmentattendrec['comment']);
                 $headcomment=trim($earlycmentattendrec['headcomment']);
                 $noofschooldays=trim($earlycmentattendrec['noofschooldays']);
                 $noofdaysattended=trim($earlycmentattendrec['noofdaysattended']);
                }
              }

                  ?>

                  <table class="table table-responsive">
                 <tr>
                      <td style="background: #d2dc2a"><b>General Comment:</b><br>
                        <input name="earlycattendid" id="earlycattendid"  type="number"  hidden value="<?php echo $earlycattendid; ?>">
                        <textarea class="form-control col-xs-12" name="comment" id="comment"><?php echo $comment; ?></textarea>
                      </td>
                    </tr>
                    <tr>
                      <td style="background: #d2dc2a"><b>Head Teacher`s Comment:</b><br>
                        <textarea class="form-control col-xs-12" name="headcomment" id="headcomment"><?php echo $headcomment; ?></textarea>
                        <table class="table-responsive" style="width:100%; background:green">
                          <tr>
                          <td style="color:white"><b>No of School Days:</b></td>
                          <td><input name="noofschooldays" id="noofschooldays" class="form-control" type="number"  value="<?php echo $noofschooldays; ?>"></td>
                        </tr>
                        <tr>
                          <td style="color:white"><b>No of Days Attended:</b></td>
                          <td ><input name="noofdaysattended" id="noofdaysattended" class="form-control" type="number" value="<?php echo $noofdaysattended; ?>"></td>
                        </tr>
                        </table>
                      </td>
                  </tr>

                   <tr>
                      <td style="background: #d2dc2a"><b>Progress Code:</b><br>
                       <?php for ($c=1; $c<=$l; $c++) {
                          
                           ?><table class="table table-responsive table-bordered" style="margin-bottom:0px; border-collapse:collapse" cellspacing="0px" cellpadding="0px">
                            <tr style="margin-bottom:0px; ">
                            <td style="width: 50%; " align="right" ><b> <?php echo $gradearray['name'.$c]; ?></b></td> 
                            <td style="width: 50%;" ><b><?php echo $gradearray['des'.$c]; ?></b></td>
                            </tr>
                          </table>
                             
                            <?php 
                                 }
                              ?>
                      </td>
                  </tr>
                </table>


                </td>

              </tr>
          </table>
                  
                     <div class="row no-print" style="margin-bottom: 50px">
                        <div class="col-xs-12">
                          <div class="col-xs-6"><button type="submit" class="btn btn-success " ><i class="fa fa-send"></i>Update</button></div>
                        </div>
                      </div>
                         <?php 
                     }else{ echo "Result Category not found: has not be upoaded";}
                  } ?>

                    </div>
                  </form>
                    </fieldset>
                 
                     
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

       <?php include("includes/footer.php"); ?>