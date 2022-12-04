<?php
include("../schoolhelp/includes/connection.php");
include("phpclass/SHteacherupdate.php");
include("phpclass/SHteacherinserts.php");
include("../schoolhelp/phpclass/schoolhelpothers.php");
$conn= new Dbh;
$mysqli = $conn->connect();
$SHteacherinserts=new insertTable;
$SHteacherupdate=new updateTable;
include("headernew.php");?>

<?php 
	$resultupdate="";
	date_default_timezone_set("Africa/Lagos");
	
	$pageserver=basename($_SERVER['PHP_SELF'],".php");
	$tid=(isset($_GET['refno'])?$_GET['refno']:false);
	$staffid = (isset($_SESSION["t_teacherlog".$tid])?$_SESSION["t_teacherlog".$tid]:false);
	
	$page = (isset($_GET['page'])?$_GET['page']:false);
	$sql = (isset($_GET['sql'])?$_GET['sql']:false);
	
	$levelid=trim((isset($_GET['class'])?$_GET['class']:false));  //Class ID
	$optionid=trim((isset($_GET['gid'])?$_GET['gid']:false));  //Group ID
	
	$odate=date("Y-m-d");
	

	$refnogroup="";
	 $teacherscourses=$SHteacher->allteacheredit3('instructorcourses','staffid', $staffid, 'levelid', $levelid, 'optionid', $optionid);
        if (is_array($teacherscourses)) {
         foreach($teacherscourses as $teacherscoursesrec){
           $refnogroup=trim($teacherscoursesrec['icourseid']);
            }
        }
	
	
	if((isset($_GET['mdate'])?$_GET['mdate']:false)==""){
	$date=date('Y-m-d');
	$mdate=date('Y-m-d', strtotime($date));
	}else{$mdate=(isset($_GET['mdate'])?$_GET['mdate']:false);}
	
	if($page==5){
		$date=(isset($_POST["mdate"])?$_POST["mdate"]:false);
		$mdate=date('Y-m-d',strtotime($date));
		$levelid=(isset($_POST["levelid"])?$_POST["levelid"]:false);
		$optionid=(isset($_POST["optionid"])?$_POST["optionid"]:false);
		}
?>

<?php 
	if ($page == 2){
			$instructorudate=date("Y-m-d H:i:s");
			$odate=date("Y-m-d");

			$levelid=trim(isset($_POST["levelid"])?$_POST["levelid"]:false);

			 $optionid=trim(isset($_GET["optionid"])?$_GET["optionid"]:false);
			 $mdate=(isset($_GET["mdate"])?$_GET["mdate"]:false);
			 

			 //Getting the class information
				            $studentsclass=$SHteacher->allteacheredit('level', 'levelid', $levelid);
				            if (is_array($studentsclass)) {
				              foreach($studentsclass as $studentsclassrec){
				                $levelname=$studentsclassrec['levelname'];
				                $departmentid=trim($studentsclassrec['departmentid']);
				                $tbl_attendance="attendance".$departmentid;
				                  }
				              }
			
			$staffid = trim(isset($_SESSION["t_teacherlog".$tid])?$_SESSION["t_teacherlog".$tid]:false);
			$mdate=date('Y-m-d', strtotime($mdate));
			$stuid=(isset($_POST['studid'])?$_POST['studid']:false);
			
			
			$bno = count($stuid);
			 $Cnt = 0;
      $stutotal = count($stuid);
      $Cnt333 = 0;
      
      foreach($stuid as $i => $stuid1){
   
      
      $student_status=(isset($_POST[$levelid.$stuid1])?$_POST[$levelid.$stuid1]:false);
      if($student_status==""){
        $student_status=0;
      }
       if($student_status>0){
        $student_status=1;
      }
        
      $student_group = $optionid;
      
      $studentsattend=$SHteacher->allteacheredit2($tbl_attendance, 'stid', $stuid1, 'attendancedate', $mdate);
      if (is_array($studentsattend)) {
        foreach ($studentsattend as $attendrec) {
          echo $atid=trim($attendrec['attendanceid']);
        }
      
      $resultupdate=$SHteacherupdate->update_attenadance($tbl_attendance, $atid, $student_status, $staffid, $instructorudate);
      $Cnt += 1;
      }else{
       $resultupdate=$SHteacherinserts->insert_attenadance($tbl_attendance, $stuid1, $student_status, $levelid, $optionid, $semesterid, $sessionid, $staffid, $mdate, $instructorudate, $odate);
      $Cnt333 += 1;
     
      
      
      }
      
  
  }
	
	if($resultupdate){
			$sql= "<b>$Cnt333 Student Attendance newly Marked and $Cnt Attendance Updated out of $stutotal<b>";
			unset($sdentid);
			unset($student_status);
			unset($atid);
			echo "<script language='javascript'>
				location.href='attendancenew?refno=$staffid&class=$levelid&gid=$optionid&sql=$sql';
				</script>";
			}else{$sql= "<b>Operation was not successful<b>";}
			
			
		$stuid="";
		$page="";
	}
?>
<div id="pageserver-wrapper">

            <div class="container-fluid">
				<!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Hi!</strong> <span style="font:20px Corbel bold; color:#060; "><?php echo (isset($_SESSION["t_fullname".$staffid])?$_SESSION["t_fullname".$staffid]:false); ?> </span><span style="color:#FEA318;">Note that your operations is only strictly on <span style="font:20px Corbel  bold; color:#F00; "><?php echo $semestername; echo " ";?>Term of <?php echo $sessionname; ?></span> </span>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- pageserver Heading -->
                <div class="row">
                    <div class="col-lg-11.8 col-xs-11.8 col-sm-11.8 col-md-11.8" style=" margin:0% 1% 0%; background:#FFF; padding:1%; ">
                        <h1 class="page-header" style="margin-top:4px; color:#063;"><small>Student Attendance <a href="#"><strong><i class="glyphicon glyphicon-info-sign"></i> 
       </strong></a>  </small></h1>
                        </div>
                </div>
                
				 <div class="row">
                    <div class="col-lg-11.8 col-xs-11.8 col-sm-11.8 col-md-11.8" style="background:#FFF; padding:1px 5px 5px; margin:0% 1% 3%; ">
                   
      <!-- column 2 -->	
      <div class="table">
     	<form method="post" action="attendancenew?refno=<?php echo $staffid; ?>&page=5" name="frmSearch" onSubmit="return attendancecheck();">
              <table id="datatable-buttons" class="table table-responsive table-stripped">
              	<thead><tr><th>Date:</th><th>Option/Group:</th><th>Level|Class:</th><th>Action</th></tr></thead>
              	<tbody>
                  <tr style="padding-left:6%;">
                      
                      <td>
                      	<input  class="form-control" name="mdate"  type="date"  value="<?php echo $mdate; ?>"/>
                      </td>
                       <td >
                      	<select name="optionid"  class="form-control" required="required">
                            <option value="">--Select Option|Group--</option>
                            <?php
                            $optioncontent="SELECT DISTINCT a.optionid, optname from formteacher a INNER JOIN optiontable cls ON a.optionid=cls.optid where a.staffid=:fieldvalue";
                            $stmt = $mysqli->prepare($optioncontent);
							$stmt->execute([ ':fieldvalue'=>$staffid]);
								if($stmt->rowCount()){

									while($row=$stmt->fetch()){	  								
                                ?>
                                <option value="<?php echo  $row['optionid']; ?>"<?php if($row['optionid']==$optionid){?> selected <?php } ?>><?php echo  $row['optname']?></option>
                                <?php  } 
                                           } ?>
                                 </select>
                      </td>
                      <td >
                      	<select name="levelid"  class="form-control" required="required">
                            <option value="">--Select Level--</option>
                            <?php
                            $scorecontent="SELECT DISTINCT a.levelid, levelname from formteacher a INNER JOIN level cls ON a.levelid=cls.levelid where a.staffid=:fieldvalue";
                            $stmt = $mysqli->prepare($scorecontent);
							$stmt->execute([ ':fieldvalue'=>$staffid]);
								if($stmt->rowCount()){

									while($row=$stmt->fetch()){	  								
                                ?>
                                <option value="<?php echo  $row['levelid']; ?>"<?php if($row['levelid']==$levelid){?> selected <?php } ?>><?php echo  $row['levelname']?></option>
                                <?php  } 
                                           } ?>
                                 </select>
                      </td>
                      <td><table><tr><td style="padding-left:15px;"><input type="submit" class="btn btn-info btn-mini" value="Load Students" /></td></tr></table></td>
                  </tr>
                  </tbody>
              </table>
            </form>
            
      </div>
     <form method="post" action="?refno=<?php echo $staffid; ?>&page=2&class=<?php echo $levelid; ?>&mdate=<?php echo $mdate; ?>&optionid=<?php echo $optionid; ?>" name="frmReg" onSubmit="return attmark();" >
			<div style="padding-top:15px">  
			 <input name="levelid"  id="levelid" value="<?php  echo $levelid; ?>" type="hidden"/>
             <input name="optionid"  id="optionid" value="<?php  echo $optionid; ?>" type="hidden"/>  
             <input name="mdate"  id="mdate" value="<?php  echo $mdate; ?>" type="hidden"/>
                                     
			<span style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#0C0;"><?php echo $sql; ?></span>
							<table class="table table-bordered" id="table2"> 	
									<thead>
								<tr>
                                	<th>SN</th>
									<th><input name="topcheckbox"  type="checkbox" id='checkAll' value="" />  Select All</th>
									<th>Reg No</th>
									<th>Student Name</th>
									
                                    
                                    <th>Status</th>
								</tr>
								</thead>
                                <?php
						 $records=$SHteacher->teacheredit3order('students', 'levelid', $levelid, 'optid', $optionid, 'status', 0, 'surname');

                              if (is_array($records)) {
                               $sn=0;
                              foreach($records as $fieldrecord){
						  
						   $sn+= 1; 
						 $cstuid=trim($fieldrecord['stid']);
						 $levelname="";
						 $departmentid="";

						 //Getting the class information
				            $studentsclass=$SHteacher->allteacheredit('level', 'levelid', $levelid);
				            if (is_array($studentsclass)) {
				              foreach($studentsclass as $studentsclassrec){
				                $levelname=$studentsclassrec['levelname'];
				                $departmentid=trim($studentsclassrec['departmentid']);
				                  }
				              }

				              //Getting the class information
				            $studentsoption=$SHteacher->allteacheredit('optiontable', 'optid', $optionid);
				            if (is_array($studentsclass)) {
				              foreach($studentsoption as $studentoptionrec){
				                $optionname=$studentoptionrec['optname'];
				               
				                  }
				              }

				              $attendancetable="attendance".trim($departmentid);
				              $attendanceid="";
				              	$attendancestatus="";


						 $records1=$SHteacher->allteacheredit4($attendancetable, 'levelid', $levelid, 'optionid', $optionid, 'stid', $cstuid, 'attendancedate', $mdate);
						 if (is_array($records1)) {
				              foreach($records1 as $records1rec){
				              	$attendanceid=trim($records1rec['attendanceid']);
				              	$attendancestatus=trim($records1rec['status']);
				              }
				          }
                        $retrieveattend_num=count($records1);
					?>    
                        
								<tbody ><tr height="23" onMouseOver="this.style.backgroundColor='#FFCC66';" onMouseOut="this.style.backgroundColor='';"> 
                                	
									 <td><?php echo $sn;  ?><input name="studid[]"  id="studid[]" value="<?php  echo $fieldrecord['stid']; ?>" type="hidden"/>
                                      <td> <input name="<?php echo trim($levelid.$cstuid); ?>" id="<?php echo trim($cstuid); ?>" type="checkbox" class="status1"  value="<?php if($retrieveattend_num>0){ echo 1;}else{echo 0;} ?>"  onchange="if(this.checked){ this.value=1; }else{this.value=0;}" <?php if($attendancestatus==1){?>checked<?php } ?>/> </td>      
									<td><?php  echo ucfirst($fieldrecord ['regno']); ?></td>
									<td><?php  echo $fieldrecord ['surname']." ". $fieldrecord ['othername']; ?></td>
									
									 <td>
                                    <?php if($attendancestatus==1){ echo "Present"; }else { echo "Absent"; }?>
                                   
                                    </td>                                                   
								</tr></tbody>
						 <?php } 


						  }?>
							
			</table>
            <table style="margin-bottom:20px">
            	<tr>
                	<td colspan="4" > <input id="save" type="submit" class="btn btn-info btn-mini" value=" Mark Present " /> </td>
                </tr>
            </table>
	 </div>
     </form> 	
    <!--/row-->
    </div>
    </div>
  	</div>
    </div>
                <!-- /.row -->
	
 <?php include("footernew.php");?>
 
 	<script>
	
	function attendancecheck() {
		
	if((document.frmSearch.mdate.value == "") || (document.frmSearch.mdate.value=="yyyy-MM-dd")  || (document.frmSearch.mdate.value=="dd-mm-yyyy")) {
	alert ("Please Select Valid Date");
	document.frmSearch.mdate.focus();
	document.frmSearch.mdate.value='<?php echo $mdate; ?>';
	return false;
	} 
	if(document.frmSearch.cclass.value == "") {
	alert ("Please Select Class");
	document.frmSearch.cclass.focus();
	return false;
	}
	else{return true;}
	}
	
	function attmark(){
		
		if(!confirm('Are you sure the attendance is marked correctly?'))
		{return false;}
		}
	
 	
	 $("#checkAll").click(function(event) {
	  if(this.checked) {
		  // Iterate each checkbox
		  $('.status1').each(function() {
			  this.checked = true;
			  this.value=1;
		  });
	  }
	  else {
		$('.status1').each(function() {
			  this.checked = false;
			  this.value=0;
			  
		  });
	  }
	});
	
	</script>