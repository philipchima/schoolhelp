<?php 
include("../schoolhelp/includes/connection.php");
include("phpclass/SHteacherinserts.php");
include("phpclass/SHteacherupdate.php");
include("headernew.php"); 
?>
<?php
		 date_default_timezone_set("Africa/Lagos");
		 $page = trim(isset($_GET['page'])?$_GET['page']:false);
		 $sql = trim(isset($_GET['sql'])?$_GET['sql']:false);
		  $tid=trim(isset($_GET['refno'])?$_GET['refno']:false);
		 $staffid =trim(isset($_SESSION['t_teacherlog'.$tid])?$_SESSION["t_teacherlog".$tid]:false);
		 $classinfo=trim(isset($_GET['tcid'])?$_GET['tcid']:false); //this variable should always be passed when reloading this page
     $odate=date("Y-m-d");
     $udate=date("Y-m-d H:i:s");

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

		 $teacherscourses=$SHteacher->allteacheredit('instructorcourses','icourseid', $classinfo);
            if (is_array($teacherscourses)) {
            	 foreach($teacherscourses as $teacherscoursesrec){
      		  	 $optionid=trim($teacherscoursesrec['optionid']);  
               $levelid=trim($teacherscoursesrec['levelid']); 
               $courseid=trim($teacherscoursesrec['courseid']);
      				 $scoredeptid=trim($teacherscoursesrec['departmentid']);
          			}
        		}

          //Getting Department ID
              $leveldata=$SHteacher->allteacheredit('level', 'levelid', $levelid);
                if (is_array($leveldata)) {
                  foreach($leveldata as $levelrec){
                   $levelname=trim($teachersclassrec['levelname']);
                   $deptid=trim($levelrec['departmentid']);
                   $classtype=trim($levelrec['classtype']);
                  }
                }
            
              //Getting the Group information
            $teachersgroup=$SHteacher->allteacheredit('optiontable','optid', $optionid);
            if (is_array($teachersgroup)) {
                foreach($teachersgroup as $teachersgrouprec){
                    $optionname=$teachersgrouprec['optname'];
              }
          }

		$csname="";
		$teacherscourse=$SHteacher->allteacheredit('course','csid', $courseid);
            if (is_array($teacherscourse)) {
                foreach($teacherscourse as $teacherscourserec){
                    $csname=$teacherscourserec['csname'];
                    
              }
          }

		 if ($page==1) {
        $stid=trim(isset($_GET['stid'])?$_GET['stid']:false);
          $studentdata=$SHteacher->allteacheredit('students', 'stid', $stid);
                            if (is_array($studentdata)) {
                              foreach($studentdata as $studentrec){ 

                                $studentname=trim($studentrec['surname']." ".$studentrec['othername']); 
                              }
                            }
     }
		 
		 // Script the inserts score to the date base
	if ($page==4) {
  $k=0;
    $sessionid=trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);
    $semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
    $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
    $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);
    $stid=trim(isset($_POST['stid'])?$_POST['stid']:false);
    $noofschooldays=trim(isset($_POST['noofschooldays'])?$_POST['noofschooldays']:false);
    $noofdaysattended=trim(isset($_POST['noofdaysattended'])?$_POST['noofdaysattended']:false);
    $earlycattendid=trim(isset($_POST['earlycattendid'])?$_POST['earlycattendid']:false);
    $comment=trim(isset($_POST['comment'])?$_POST['comment']:false);
    $headcomment=trim(isset($_POST['headcomment'])?$_POST['headcomment']:false);
    $insertedrow="";
                                
                              //checking whether score has been submitted before
                               $earlycmentattend1=$SHteacher->allteacheredit5('earlycmentattend', 'stid', $stid , 'sessionid', $sessionid, 'semesterid', $semesterid, 'levelid', $levelid, 'optionid', $optionid);
                                  if (is_array($earlycmentattend1)) {
                                    foreach($earlycmentattend1 as $key7 => $earlycmentattendrec1){
                                     $earlycattendid1=trim($earlycmentattendrec1['earlycattendid']);
                                    }

                            //Updating Score
                            $tableUpdate= new updateTable;
                            $state= $tableUpdate->update_sixfields('earlycmentattend', 'earlycattendid', $earlycattendid1, 'comment',  $comment, 'headcomment',  $headcomment, 'noofschooldays', $noofschooldays, 'noofdaysattended', $noofdaysattended, 'instructorid', $staffid, 'instructorudate', $udate);
                              //Counting number of record that updated
                                  if ($state=="Success") {
                                    $k+=1;
                                  }
                      
                            }else{
                              //check whether the input box is empty
                              
                                //Inserting New Score
                                
                                  $tablestudents=new insertTable;
                                  $state=$tablestudents->insert_12fields('earlycmentattend', 'stid', $stid, 'sessionid', $sessionid, 'semesterid', $semesterid, 'levelid', $levelid, 'optionid', $optionid,  'comment',  $comment, 'headcomment',  $headcomment, 'noofschooldays', $noofschooldays, 'noofdaysattended', $noofdaysattended, 'instructorid', $staffid, 'instructorudate', $udate, 'odate', $odate);
                                  
                                  $insertedrow+=1;      

       }
       $inserting="No of Inserted record=".$insertedrow;
       $updating="No of update record=".$k;
       $sql=$inserting.';  '.$updating;
     
       echo "<script>
        window.location.href='?tcid=$classinfo&sql=$sql&refno=$staffid';
      </script>";
      
  }


  


?>

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
                <!-- /.row -->
                <!-- Page Heading -->
                
     
        <div class="row">
				 <div class="col-md-11 col-lg-11 col-sm-11 col-xs-11 table-responsive" style="background:#063; margin:0% 2% 0% 4%; border-bottom:2px solid #8DFC6D; color:#FFF; border-radius:2px; -moz-border-radius:3px; -o-border-radius:3px; -webkit-border-radius:3px; -o-border-radius:3px; width:88%; height:35px; font-size:1.3em;">Term's Score Upload for <?php echo $levelname . " " . $optionname." on ". $csname;?> 
        </div>
        </div>
      	<div class="row">
          <div class="col-md-11 col-lg-11 col-sm-11 col-xs-11" style="background:#FFF; margin:0% 0% 0% 2%; ">
             <div><h3 style="color:green"><?php echo $sql; ?></h3></div>
                  <?php if ($page=="") { 
                   
                    $x=0;
                    $score_tbl_id=""; 
                     $score_tbl_score="";
                     $score_tbl_status=0;
                     $assessmentid="";
                    ?>  
                    <fieldset>
                        <legend style="color:#063"> Score Template</legend>
                            
                      <div class="x_panel" >
                       
                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                     
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Reg No</th>
                          <th>Surname</th>
                          <th>Othername</th>
                          <th>Action</th>
                          
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                            $r=0;
                            ?>
                            
                           <?php  
                           
                            $scoretblname="score".$scoredeptid;
                            $records=$SHteacher->allteacheredit3('students', 'levelid', $levelid, 'optid', $optionid, 'status', 0);
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
                                        <td><a class="btn btn-success" href="earlyterm_score?tcid=<?php echo $classinfo; ?>&refno=<?php echo $staffid; ?>&stid=<?php echo trim($fieldrecord['stid']); ?>&page=1">Prepare Result</a></td>
                                      </tr>
                             <?php }
                              }
                             ?>
                      </tbody>
                    </table>

                    </div>
                 
                    </fieldset>
                    
                     
              </div>
            </div>
        </div>

        <?php } ?>
                  <?php if ($page==1) {
                    $x=0;
                    ?>  
                    <fieldset>
                        <legend style="color:#063">Early Class Score Upload</legend>
                        <form method="POST" action="?refno=<?php echo $staffid; ?>&page=4&tcid=<?php echo $tcid; ?>">
                          <input name="optionid"  id="optionid" value="<?php  echo trim($optionid); ?>" type="hidden"/>
                          <input name="levelid"  id="levelid" value="<?php  echo trim($levelid); ?>" type="hidden"/>
                          <input name="semesterid"  id="semesterid" value="<?php  echo trim($semesterid); ?>" type="hidden"/>
                          <input name="sessionid"  id="sessionid" value="<?php  echo trim($sessionid); ?>" type="hidden"/>
                           <input name="stid"  id="stid" value="<?php  echo trim($stid); ?>" type="hidden"/>
                          <input name="deptid"  id="deptid" value="<?php  echo trim($scoredeptid); ?>" type="hidden"/>
                            
                      <div class="x_panel">
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
          $earlyclassscore=$SHteacher->allteacheredit('earlyclasscategory', 'levelid',  $levelid);
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
           $earlygradedata=$SHteacher->allteacheredit('earlygrade', 'levelid', $levelid);
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
              $earlycatsubdata=$SHteacher->allteacheredit('earlycatsub', 'earlyclasscatid', $retrievecatid);
              if (is_array($earlycatsubdata)) {
                foreach($earlycatsubdata as $key3 => $earlycatsubrec){
                  $markgradeid="";
                  $earlyscoreid="";
                  $earlycatsubid=trim($earlycatsubrec['earlycatsubid']);
              //checking whether this result has been marked
              $earlyscoredata=$SHteacher->allteacheredit6('earlyclassscore', 'earlycatsubid', $earlycatsubrec['earlycatsubid'], 'stid', $stid, 'sessionid', $sessionid, 'semesterid', $semesterid, 'levelid', $levelid, 'optionid', $optionid);
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
                          <td style="margin:0px; width:10%"><input type="radio"  name="<?php echo trim($retrievecatid).trim($earlycatsubrec['earlycatsubid']); ?>" <?php if ($actualgradeid==$markgradeid){ ?> checked="checked"  value="<?php echo $actualgradeid; ?>" <?php }else{?> unchecked value=""  <?php } ?>  onClick="uploadassessment('earlyclassscore', 'earlyscoreid', '<?php echo $earlyscoreid; ?>', 'gradeid', '<?php echo $actualgradeid; ?>', 'stid', '<?php echo $stid; ?>', 'sessionid', '<?php echo $sessionid ?>', 'semesterid', '<?php echo $semesterid; ?>', 'levelid', '<?php echo $levelid; ?>', 'optionid', '<?php echo $optionid; ?>', 'instructorid','<?php echo $staffid ?>', 'instructordate', '<?php echo date("Y-m-d H:i:s"); ?>', 'odate', '<?php echo date("Y-m-d"); ?>', 'earlycatsubid', '<?php echo $earlycatsubid; ?>', 'earlyassessment');"></td>  
                                
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
              $earlycatsubdata=$SHteacher->allteacheredit('earlycatsub', 'earlyclasscatid', $retrievecatid);
              if (is_array($earlycatsubdata)) {
                foreach($earlycatsubdata as $key3 => $earlycatsubrec){
                   $markgradeid="";
                  $earlyscoreid="";
                  $earlycatsubid=trim($earlycatsubrec['earlycatsubid']);
              //checking whether this result has been marked
              $earlyscoredata=$SHteacher->allteacheredit6('earlyclassscore', 'earlycatsubid', $earlycatsubrec['earlycatsubid'], 'stid', $stid, 'sessionid', $sessionid, 'semesterid', $semesterid, 'levelid', $levelid, 'optionid', $optionid);
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
                          <td style="margin:0px; width:10%"><input type="radio"  name="<?php echo trim($retrievecatid).trim($earlycatsubrec['earlycatsubid']); ?>" <?php if ($actualgradeid==$markgradeid){ ?> checked="checked"  value="<?php echo $actualgradeid; ?>" <?php }else{?> unchecked value=""  <?php } ?>  onClick="uploadassessment('earlyclassscore', 'earlyscoreid', '<?php echo $earlyscoreid; ?>', 'gradeid', '<?php echo $actualgradeid; ?>', 'stid', '<?php echo $stid; ?>', 'sessionid', '<?php echo $sessionid ?>', 'semesterid', '<?php echo $semesterid; ?>', 'levelid', '<?php echo $levelid; ?>', 'optionid', '<?php echo $optionid; ?>', 'instructorid','<?php echo $staffid ?>', 'instructordate', '<?php echo date("Y-m-d H:i:s"); ?>', 'odate', '<?php echo date("Y-m-d"); ?>', 'earlycatsubid', '<?php echo $earlycatsubid; ?>', 'earlyassessment');"></td>  
                              
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

              $earlycmentattend=$SHteacher->allteacheredit5('earlycmentattend', 'stid', $stid , 'sessionid', $sessionid, 'semesterid', $semesterid, 'levelid', $levelid, 'optionid', $optionid);
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
                     ?>
                    </div>
                  </form>
                    </fieldset>
                   <?php 
                  } ?>
                     
              </div>
            </div>
        </div>
      
         <img src="img/LoaderIcon.gif" class="img img-responsive" id="loaderIcon" style="display:none" />
 <?php include("footernew.php");?>
 
 <script language="javascript">
 
 </script>