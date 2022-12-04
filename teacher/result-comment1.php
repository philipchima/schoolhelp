<?php 
include("../schoolhelp/includes/connection.php");
include("phpclass/SHteacherupdate.php");
include("phpclass/SHteacherinserts.php");
include("headernew.php");?>
<?php
		 date_default_timezone_set("Africa/Lagos");
		
		 $page = (isset($_GET['page'])?$_GET['page']:false);
		 $sql = (isset($_GET['sql'])?$_GET['sql']:false);
		 $tid=(isset($_GET['refno'])?$_GET['refno']:false);
		 $staffid = (isset($_SESSION["t_teacherlog".$tid])?$_SESSION["t_teacherlog".$tid]:false);
		 $classinfo=trim(isset($_GET['tcid'])?$_GET['tcid']:false); //this variable should always be passed when reloading this page
		 $udate=date("Y-m-d H:i:s");
     $odate=date("Y-m-d");
     $tabledomainupdate=new updateTable;
		 $tabledomain=new insertTable;

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
						 $scoredeptid=trim($teacherscoursesrec['departmentid']);
						
				 
					}
				}
		
		}else{
		   $levelid =(isset($_GET['classid'])?$_GET['classid']:false);
		   $optionid=(isset($_GET['groupid'])?$_GET['groupid']:false);
		   
		}
		//Getting the class information
            $teachersclass=$SHteacher->allteacheredit('level', 'levelid', $levelid);
            if (is_array($teachersclass)) {
              foreach($teachersclass as $teachersclassrec){
                $levelname=$teachersclassrec['levelname'];
                 $scoredeptid=trim($teachersclassrec['departmentid']);
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

    $sessionid=trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);
    $semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
    $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
    $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);
    $positionresultid=trim(isset($_POST['positionresultid'])?$_POST['positionresultid']:false);


      // Getting the Department ID           
        $leveldata=$SHteacher->allteacheredit('level', 'levelid', $levelid);
          if (is_array($leveldata)) {
            foreach($leveldata as $levelrec){ 
              $scoredeptid=trim($levelrec['departmentid']); 
                $levelname=trim($levelrec['levelname']); 
              }
          }

        $optiondata=$SHteacher->allteacheredit('optiontable', 'optid', $optionid);
         if (is_array($optiondata)) {
          foreach($optiondata as $optionrec){                     
           $optionname=trim($optionrec['optname']); 
         }
      }


     if ($positionresultid!="") {
      $insertedrow=0;
      $insertedrow1=0;
      $numofupdate=0;
      $numofupdate1=0;

      $noofschooldays=trim(isset($_POST['noofschooldays'])?$_POST['noofschooldays']:false);
      $noofdaysattended=trim(isset($_POST['noofdaysattended'])?$_POST['noofdaysattended']:false);

      //Checking Attendance Table
        $retrievedata6=$SHteacher->allteacheredit('attendancemark', 'positionresultid', $positionresultid);
         if (is_array($retrievedata6)) { 
            foreach($retrievedata6 as $field6){

              $attendanemarkid=trim($field6['attendancemarkid']);
      
              $state=$tabledomainupdate->update_attendancemark($noofschooldays, $noofdaysattended, $staffid, $udate, $attendanemarkid);
              $numofupdate1+=1;

            }
          }else{

              
              $state=$tabledomain->insert_attendancemark($noofschooldays, $noofdaysattended, $positionresultid, $staffid, $odate);
              //$display=$state['action'];
              $insertedrow1+=$state['counting'];

          }

          // Checking Domain Type
           $domaindata7=$SHteacher->allteacheredit('domaintype', 'departmentid', $scoredeptid);
            if (is_array($domaindata7)) {
            foreach($domaindata7 as $domainrec7){ 

      // Marking Domain
          $domaindata=$SHteacher->allteacheredit('domainname', 'domaintypeid', trim($domainrec7['domaintypeid']));
          if (is_array($domaindata)) {
            foreach($domaindata as $domainrec){ 
              $domaintypeid=trim($domainrec['domaintypeid']);
              $domainnameid=trim($domainrec['domainnameid']);
              $domaingrade1="domain".$domainnameid;
              $domaingrade=trim(isset($_POST[$domaingrade1])?$_POST[$domaingrade1]:false);

          $retrievedata5=$SHteacher->allteacheredit2('resultdomain', 'positionresultid', $positionresultid, 'domainnameid', trim($domainrec['domainnameid']));
         if (is_array($retrievedata5)) { 
            foreach($retrievedata5 as $field5){

              $resultdomainid=trim($field5['resultdomainid']);
              
              $state=$tabledomainupdate->update_resultdomain($domaingrade, $staffid, $udate, $resultdomainid);
               $numofupdate+=1;
            }
          }else{

              
              $state=$tabledomain->insert_resultdomain($positionresultid, $domaintypeid, $domainnameid, $domaingrade, $staffid, $odate);
              //$display=$state['action'];
              $insertedrow+=$state['counting'];

          }

        }
      }//Close of domain table

    }
  }//Closing of the domain type

        $t="Total Number of Attendance inserted is: ".$insertedrow1."\n";
        $t0="Total Number of Attendance updated is: ".$numofupdate1."\n";
        $t1="Total Number of domain inserted is: ".$insertedrow."\n";
        $t2="Total Number of domain updated is: ".$numofupdate."\n";
        $sql.=$t.$t0.$t1.$t2;
        
     }                     

}

if ($page==4) {

  //collecting Variables
  $sessionid=trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);
  $semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
  $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
  $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);
  $s=0;
   // Getting the Department ID
                           
                          $leveldata=$SHteacher->allteacheredit('level', 'levelid', $levelid);
                            if (is_array($leveldata)) {
                              foreach($leveldata as $levelrec){ 
                                $scoredeptid=trim($levelrec['departmentid']); 
                                $levelname=trim($levelrec['levelname']); 
                              }
                            }

                            $positiontblname="positionresult".trim($scoredeptid);
  
    $records=$SHteacher->allposi4sort($positiontblname, $levelid, $optionid, $sessionid, $semesterid, 'average', 'DESC');
            if (is_array($records)) {
            foreach($records as $fieldrecord){
              $staffcommentid1='staffcomment'.trim($fieldrecord['positionid']);
              $comment1='comment'.trim($fieldrecord['positionid']);
              //$principalcommentid1='principalcomment'.trim($fieldrecord['positionid']);
              $staffcommentid=trim(isset($_POST[$staffcommentid1])?$_POST[$staffcommentid1]:false);
              $comment=trim(isset($_POST[$comment1])?$_POST[$comment1]:false);
              //$principalcommentid=trim(isset($_POST[$principalcommentid1])?$_POST[$principalcommentid1]:false);
              $tableUpdate=new updateTable;
               $state= $tableUpdate->update_fourfields($positiontblname, 'positionid', trim($fieldrecord['positionid']), 'hodcommentid',  $staffcommentid, 'comment',  $comment,   'operatorid', $staffid, 'udate', $udate);
               if ($state=="Success") {
                $s+=1;
              }
               $sql=$state.":: Update Made, affected records =".$s;
            
            }

          }else{
            $sql="This Record not found";
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

     
            
			<?php 
                    $x=0;
                    $score_tbl_id=""; 
                     $score_tbl_score="";
                     $score_status="";
                     $assessmentid="";
                    ?>  
                    <fieldset>

                        <legend style="color:#063">Result Comment</legend>
                        <form method="POST" action="?refno=<?php echo $staffid; ?>&page=4&tcid=<?php echo $classinfo; ?>">
                          <input name="optionid"  id="optionid" value="<?php  echo trim($optionid); ?>" type="hidden"/>
                          <input name="levelid"  id="levelid" value="<?php  echo trim($levelid); ?>" type="hidden"/>
                          <input name="semesterid"  id="semesterid" value="<?php  echo trim($semesterid); ?>" type="hidden"/>
                          <input name="sessionid"  id="sessionid" value="<?php  echo trim($sessionid); ?>" type="hidden"/>
                         
                          <input name="deptid"  id="deptid" value="<?php  echo trim($scoredeptid); ?>" type="hidden"/>
                            
                      <div class="x_panel" >
                       
                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <center><caption><h1><?php echo $levelname.' '.$optionname  ?></h1></caption></center>
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Reg No</th>
                          <th>Fullname</th>
                          <th>Average</th>
                          <th>Banked Comment</th> 
                          <th>Comment</th>
                          <th>Domain Grade</th>              
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0;  ?>
                           <?php  
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

                            $positiontblname="positionresult".$scoredeptid;
                            $records=$SHteacher->allposi4sort($positiontblname, $levelid, $optionid, $sessionid, $semesterid, 'average', 'DESC');
                              if (is_array($records)) {
                               $hodcommentname="";
                               $dircommentname="";
                              foreach($records as $fieldrecord){
                               $k+=1;
                              $stid=trim($fieldrecord['stid']);
                              $hodcommentid=trim($fieldrecord['hodcommentid']);
                              $dircommentid=trim($fieldrecord['dircommentid']);

                                 $sturecords=$SHteacher->allteacheredit('students', 'stid', $stid);
                               if (is_array($sturecords)) {
                                  foreach($sturecords as $sturecord){
                                  $surname=trim($sturecord['surname']);
                                  $othername=trim($sturecord['othername']);
                                  $regno=trim($sturecord['regno']);
                                 }

                               }
                               
                               //Getting HOD's Comment
                                $rstcomrecords=$SHteacher->allteacheredit('commentsetup', 'resultcommentid', $hodcommentid);
                               if (is_array($rstcomrecords)) {
                                  foreach($rstcomrecords as $rstcomrecord){
                                  $hodcommentname=trim($rstcomrecord['comment']);                               
                                 }
                               }

                               //Getting Director's Comment
                                $rstcomrecords1=$SHteacher->allteacheredit('commentsetup', 'resultcommentid', $dircommentid);
                               if (is_array($rstcomrecords1)) {
                                  foreach($rstcomrecords1 as $rstcomrecord1){
                                  $dircommentname=trim($rstcomrecord1['comment']);                               
                                 }

                               }
                               
                        ?>
                                      <tr>
                                        <td><?php echo  $k; ?><input name="studid[]"  id="studid[]" value="<?php  echo trim($fieldrecord['stid']); ?>" type="hidden"/></td>
                                        <td><?php echo  $regno; ?></td>
                                        <td><?php echo  $surname.' '.$othername; ?></td>
                                        <td><?php echo  trim($fieldrecord[$posi_measure]); ?></td>
                                        
                            <td> 
                              <input type="text" list="staffcommentlists<?php echo $fieldrecord['positionid']; ?>" id="staffcommentlist<?php echo $fieldrecord['positionid']; ?>" class="form-control col-md-12 col-xs-12"  placeholder="Please type and select Form Teachers Comment" onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), '<?php echo "staffcomment".$fieldrecord["positionid"]; ?>');" style="width:100%" <?php if ($hodcommentname!=""){ ?>  value="<?php echo $hodcommentname; ?>" <?php } ?> >

                        <datalist id="staffcommentlists<?php echo $fieldrecord['positionid']; ?>" >

                            <?php
                             $records1=$SHteacher->allteacheredit2('commentsetup', 'departmentid', $scoredeptid, 'commenttype', 0);
                              if (is_array($records1)) {
                               
                              foreach($records1 as $fieldrecord1){
                           
                            ?>
                            <option data-value="<?php echo $fieldrecord1['resultcommentid']; ?>"  value="<?php echo $fieldrecord1['comment'] ?>">
                            <?php } 
                          }?>
                           </datalist>
                           <input name="<?php echo 'staffcomment'.trim($fieldrecord['positionid']); ?>" id="<?php echo 'staffcomment'.$fieldrecord['positionid']; ?>" class="form-control col-md-7 col-xs-12" type="hidden"  value="<?php echo $fieldrecord['hodcommentid']; ?>">

                           </td>
                           <td><textarea name="<?php echo 'comment'.trim($fieldrecord['positionid']); ?>" class="form-control" placeholder="Please type in <?php echo $surname.' '.$othername; ?> comment"><?php echo trim($fieldrecord['comment']); ?></textarea></td>
                         
                           <?php    
                             $records4=$SHteacher->allteacheredit('resultdomain', 'positionresultid', trim($fieldrecord['positionid']));
                              if (is_array($records4)) {  ?>
                                                                                                            <!-- Retrieving Domain and attendane -->
                           <td><button type="submit" class="btn btn-success"  id="button<?php echo trim($fieldrecord['positionid']); ?>" onclick="return domaingrade_attendance('<?php echo $scoredeptid; ?>', '<?php echo trim($fieldrecord['positionid']); ?>', 'domaingrade_attendance')"><i class="fa fa-check"></i> Mark Domain</button></td>

                           <?php } else{ ?>
                           <td><button type="submit" class="btn btn-danger"  id="button<?php echo trim($fieldrecord['positionid']); ?>" onclick="return domaingrade_attendance('<?php echo $scoredeptid; ?>', '<?php echo trim($fieldrecord['positionid']); ?>', 'domaingrade_attendance')"><i class="fa fa-close"></i> Mark Domain</button></td>
                           <?php } ?>

                           <?php  } ?>
                            
                            <?php }else{echo "This result is not generated yet"; }
                            ?>    
                            </tr>
                      </tbody>
                    </table>
                  
                     <div class="row no-print" style="margin-bottom: 50px">
                        <div class="col-xs-12">
                         <?php if ($k!="") {?>

                         <div class="col-xs-6"><button type="submit" class="btn btn-success " ><i class="fa fa-send"></i> Save </button></div>
                         <?php } ?>
                        </div>
                      </div>

                    </div>
                  </form>

                    </fieldset>
                   
                     
        </div>
   </div>
 </div>

    <!-- Modal -->
<button id="myModalbutton" data-toggle="modal" data-target="#myModal" hidden="hidden"><i class="fa fa-plus"></i>  Call Domain Dialogue Box </button>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog" >

    <!-- Modal content-->
    
    <div class="modal-content">
      <div class="modal-header">Student Domain Marking
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div>
      <div class="modal-body">
        <div class="row">
           <div classs="col-lg-12">
            <div id="msgnum"></div>
            <form action="?page=1&refno=<?php echo $staffid ; ?>&tcid=<?php echo $classinfo; ?>" method="POST" id="domaingrade" name="domaingrade">
              <input name="optionid"  id="optionid" value="<?php  echo trim($optionid); ?>" type="hidden"/>
              <input name="levelid"  id="levelid" value="<?php  echo trim($levelid); ?>" type="hidden"/>
              <input name="semesterid"  id="semesterid" value="<?php  echo trim($semesterid); ?>" type="hidden"/>
              <input name="sessionid"  id="sessionid" value="<?php  echo trim($sessionid); ?>" type="hidden"/>
              <input name="deptid"  id="deptid" value="<?php  echo trim($scoredeptid); ?>" type="hidden"/>

              <div id="domaincontent">

              </div>
            </form>
           </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="row">
           <div classs="col-lg-12" style="color:red">
            <b>Please fill this appropriately</b>
           </div>
        </div>
      </div>
     
    </div>

  </div>
</div>
 <?php include("footernew.php");?>

