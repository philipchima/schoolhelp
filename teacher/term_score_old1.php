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
		 $staffid =trim (isset($_SESSION['t_teacherlog'.$tid])?$_SESSION["t_teacherlog".$tid]:false);
		 $classinfo=trim(isset($_GET['tcid'])?$_GET['tcid']:false); //this variable should always be passed when reloading this page

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
                    $levelname=$levelrec['levelname'];
                   $deptid=trim($levelrec['departmentid']);
                   $classtype=trim($levelrec['classtype']);
                  }
                }

            //Getting Report Card Sample
              if ($classtype==1) {
                  echo "<script>
                         alert('Attenton Please:  This class is a pre-class');
                         window.location.href='earlyterm_score?refno=$staffid&tcid=$classinfo';
                       </script>";
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

		 
		 
		 // Script the inserts score to the date base
		if ($page==4) {
  $k=0;
      $sessionid=trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);
    $semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
    $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
   $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);
     $courseid=trim(isset($_POST['courseid'])?$_POST['courseid']:false);
     $scoredeptid=trim(isset($_POST['scoredeptid'])?$_POST['scoredeptid']:false);

      $studid=isset($_POST['studid'])?$_POST['studid']:false;

     $udate=date("Y-m-d H:i:s");
     $odate=date("Y-m-d");
      $bno = count($studid);
      $Cnt = 0;
      $stuNo = $bno;
      $Cnt333 = 0;
      
  if ($bno>0) {

    $scoretblname="score".$scoredeptid;
        $insertedrow=0;
      for($i=0; $i < $bno; $i++){

      $stid= (int)$studid[$i];
      $assessmentid="";

        $assessmentdata1=$SHteacher->allteacheredit('assessment', 'departmentid', $scoredeptid);
                            if (is_array($assessmentdata1)) {
                              foreach($assessmentdata1 as $assessmentrec1){ 
                                $assessmentid=trim($assessmentrec1['assid']);

                                $scoreidname='scoreid'.$stid.trim($assessmentrec1['assid']);
                                $scorename= 'score'.$stid.trim($assessmentrec1['assid']);
                                $scorestatus= 'status'.$stid.trim($assessmentrec1['assid']);
                                $scoreid=trim(isset($_POST["{$scoreidname}"])?$_POST["{$scoreidname}"]:false);
                                $score=trim(isset($_POST["{$scorename}"])?$_POST["{$scorename}"]:false);
                                
                              //checking whether score has been submitted before
                                 $scoredata=$SHteacher->allteacheredit7($scoretblname, 'stid', $stid, 'levelid', $levelid, 'optionid', $optionid, 'courseid', $courseid, 'assessmentid', $assessmentid, 'semesterid', $semesterid, 'sessionid', $sessionid);
                            if (is_array($scoredata)) {
                              foreach($scoredata as $scoredatarec){ 
                                $score_tbl_id=trim($scoredatarec['scoreid']);
                                $score_tbl_status=trim($scoredatarec['status']);
                                $score_tbl_score=trim($scoredatarec['score']);
                              }
                              //Updating Score
                              
                              $tableUpdate= new updateTable;
                            $state= $tableUpdate->update_score($scoretblname, 'scoreid', $scoreid, 'score',  $score, 'instructorid', $staffid, 'udate', $udate);
                              //Counting number of record that updated
                                  if ($state=="Success") {
                                    $k+=1;
                                  }
                      
                            }else{
                              //check whether the input box is empty
                              if ($score!="") {
                                //Inserting New Score
                                
                                  $tablestudents=new insertTable;
                                  $state=$tablestudents->insert_score($scoretblname, $sessionid, $semesterid, $levelid, $optionid, $stid, $courseid, $assessmentid, $score, 'instructorid', $staffid, 'udate', $udate, $odate);
                                  
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
        window.location.href='?refno=$staffid&sql=$sql&tcid=$classinfo';
      </script>";
      
  }

  
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
                
               
        <?php
	if ($page == "")
	{
		?>
        <div class="row">
				 <div class="col-md-11 col-lg-11 col-sm-11 col-xs-11 table-responsive" style="background:#063; margin:0% 2% 0% 4%; border-bottom:2px solid #8DFC6D; color:#FFF; border-radius:2px; -moz-border-radius:3px; -o-border-radius:3px; -webkit-border-radius:3px; -o-border-radius:3px; width:88%; height:35px; font-size:1.3em;">Term's Score Upload for <?php echo $levelname . " " . $optionname." on ". $csname;?> 
        </div>
        </div>
      	<div class="row">
        	<div class="col-md-11 col-lg-11 col-sm-11 col-xs-11" style="background:#FFF; margin:0% 2% 2%; padding:2%;">
             <div><h3 style="color:green"><?php echo $sql; ?></h3></div>
                  <?php 
                    $x=0;
                    $score_tbl_id=""; 
                     $score_tbl_score="";
                     $score_tbl_status=0;
                     $assessmentid="";
                    ?>  
                    <fieldset>
                        <legend style="color:#063"> Score Template</legend>
                        <form method="POST" action="?refno=<?php echo $staffid; ?>&page=4&tcid=<?php echo $classinfo; ?>">
                          <input name="optionid"  id="optionid" value="<?php  echo trim($optionid); ?>" type="hidden"/>
                          <input name="levelid"  id="levelid" value="<?php  echo trim($levelid); ?>" type="hidden"/>
                          <input name="semesterid"  id="semesterid" value="<?php  echo trim($semesterid); ?>" type="hidden"/>
                          <input name="sessionid"  id="sessionid" value="<?php  echo trim($sessionid); ?>" type="hidden"/>
                           <input name="courseid"  id="courseid" value="<?php  echo trim($courseid); ?>" type="hidden"/>
                          <input name="scoredeptid"  id="scoredeptid" value="<?php  echo trim($scoredeptid); ?>" type="hidden"/>
                            
                      <div class="x_panel" >
                       
                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <center><caption><h1><?php echo $levelname.' '.$optionname .' => '.$csname ; ?></h1></caption></center>
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Reg No</th>
                          <th>Surname</th>
                          <th>Othername</th>
                          <?php
                          $assessmentdata=$SHteacher->allteacheredit('assessment', 'departmentid', $scoredeptid);
                            if (is_array($assessmentdata)) {
                              foreach($assessmentdata as $assessmentrec){ 
                            ?>
                              <th><?php echo $assessmentrec['assname'].' '.' ( '.$assessmentrec['asspercent'].'% ) '; ?></th>
                           <?php   }
                            }
                            ?>
                          
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                        	  $r=0;
                            ?>
                            
                           <?php  
                           
                            $scoretblname="score".$scoredeptid;
                            $records=$SHteacher->teacheredit3order('students', 'levelid', $levelid, 'optid', $optionid, 'status', 0, 'surname');
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
                          $assessmentdata1=$SHteacher->allteacheredit('assessment', 'departmentid', $scoredeptid);
                            if (is_array($assessmentdata1)) {
                              foreach($assessmentdata1 as $assessmentrec1){ 
                                $assessmentid=trim($assessmentrec1['assid']);
                                $scoreid="";
                                 $score_tbl_id="";
                                $score_tbl_status="";
                                $score_tbl_score="";
                              //checking whether score has been submitted before
                                 $scoredata=$SHteacher->allteacheredit7($scoretblname, 'stid', $stid, 'levelid', $levelid, 'optionid', $optionid, 'courseid', $courseid, 'assessmentid', $assessmentid, 'semesterid', $semesterid, 'sessionid', $sessionid);
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
                            <td> <input type="text" class="form-control col-md-7 col-xs-12" style="width:70%"  name='<?php echo "score".$fieldrecord['stid'].$assessmentrec1["assid"]; ?>' value='<?php echo $score_tbl_score; ?>' id="<?php echo "idname".$score_tbl_id; ?>" onchange='return checkscore(this, "<?php echo $assessmentrec1['asspercent']?>");' <?php if($score_tbl_status==1){ $r+=1; echo "readonly"; ?>  <?php } ?> placeholder="Enter <?php echo $assessmentrec1['assname']; ?> score">
                                <?php if($score_tbl_status==1 && $score_tbl_id!=""){?>
                            <div class="btn btn-success col-md-3 col-xs-6"  style=" float:left; width:30%" class="btn btn-success" onClick="updateassessment('<?php echo $scoretblname; ?>',  'scoreid', '<?php echo $score_tbl_id; ?>', 'score', $('#<?php echo 'idname'.$score_tbl_id; ?>').val(), 'instructoid','<?php echo $staffid ?>', 'udate', '<?php echo date("Y-m-d H:i:s") ?>', 'assessmentupdate');">Update</div> <?php } 

                    //Checking whether there is redundancy
                              $scoredata1=$SHteacher->allteacheredit8not($scoretblname, 'stid', $stid, 'levelid', $levelid, 'optionid', $optionid, 'courseid', $courseid, 'assessmentid', $assessmentid, 'semesterid', $semesterid, 'sessionid', $sessionid, 'scoreid', $score_tbl_id);
                            if (is_array($scoredata1)) {
                              foreach($scoredata1 as $scoredatarec1){ 
                                $dscoreid=trim($scoredatarec1["scoreid"]);
                      ?>
                    <input style="background:red" type='button' id="<?php echo $dscoreid; ?>"  name="<?php echo $dscoreid; ?>" value='<?php echo $scoredatarec1["score"]; ?>' onClick="deleteassessment('<?php echo $scoretblname; ?>', 'scoreid', '<?php echo $dscoreid; ?>', 'deleteassessment');">
                               
                         <?php     }
                            } ?>
                            </td>
                           
                           <?php  }
                            }else{echo "Assessments not assigned yet to this department"; }
                            ?>
                                        
                                      </tr>
                             <?php }
                              }
                             ?>
                        
                      </tbody>
                    </table>
                  
                     <div class="row no-print" style="margin-bottom: 50px">
                        <div class="col-xs-12">

                         <?php 
                          
                         if ($score_tbl_id=="") {?>
                         <div class="col-xs-6"><button type="submit" class="btn btn-success " ><i class="fa fa-send"></i> Submit</button></div>
                         <?php } else{ ?>
                          <div class="col-xs-6"><button type="submit" class="btn btn-success " ><i class="fa fa-send"></i> Update</button></div>
                         <?php } 
                     			?>
                        </div>
                      </div>

                    </div>
                  </form>
                    </fieldset>
                    
                     
              </div>
            </div>
        </div>
         <?php
		}
		?>
         <img src="img/LoaderIcon.gif" class="img img-responsive" id="loaderIcon" style="display:none" />
 <?php include("footernew.php");?>
 
 <script language="javascript">
 
 </script>