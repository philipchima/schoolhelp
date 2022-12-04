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
	$deptid="";
	date_default_timezone_set("Africa/Lagos");
	
	$pageserver=basename($_SERVER['PHP_SELF'],".php");
	$tid=(isset($_GET['refno'])?$_GET['refno']:false);
	$staffid = (isset($_SESSION["t_teacherlog".$tid])?$_SESSION["t_teacherlog".$tid]:false);
	
	echo $page = (isset($_GET['page'])?$_GET['page']:false);
	$sql = (isset($_GET['sql'])?$_GET['sql']:false);
	
	$levelid=trim((isset($_GET['class'])?$_GET['class']:false));  //Class ID
	$optionid=trim((isset($_GET['gid'])?$_GET['gid']:false));  //Group ID
	  //Getting Department ID
    $leveldata=$SHteacher->allteacheredit('level', 'levelid', $levelid);
      if (is_array($leveldata)) {
        foreach($leveldata as $levelrec){
         $deptid=trim($levelrec['departmentid']);
         $classtype=trim($levelrec['classtype']);
        }
      }
	
	$odate=date("Y-m-d");
	

	$refnogroup="";
	 $teacherscourses=$SHteacher->allteacheredit3('instructorcourses','staffid', $staffid, 'levelid', $levelid, 'optionid', $optionid);
        if (is_array($teacherscourses)) {
         foreach($teacherscourses as $teacherscoursesrec){
           $refnogroup=trim($teacherscoursesrec['icourseid']);
            }
        }
	
	

	if($page==5){
		
		$levelid=(isset($_POST["levelid"])?$_POST["levelid"]:false);
		$optionid=(isset($_POST["optionid"])?$_POST["optionid"]:false);
		}

?>

<?php 
	if($page==2){
		
  $classtype="";   
  $sessionid=trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);
  $semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
  $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
  $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);

    $_SESSION["sessionid"] =$sessionid;
    $_SESSION["semesterid"] =$semesterid;
    $_SESSION["levelid"] =$levelid;
    $_SESSION["optionid"] =$optionid; 

    //Getting Department ID
    $leveldata=$SHteacher->allteacheredit('level', 'levelid', $levelid);
      if (is_array($leveldata)) {
        foreach($leveldata as $levelrec){
         $deptid=trim($levelrec['departmentid']);
         $classtype=trim($levelrec['classtype']);
        }
      }

  //Getting Report Card Sample
    if ($classtype==1) {
       $actualpage="earlyresult";
    }else{
        $rsampledata=$SHteacher->allteacheredit('resultsample', 'departmentid', $deptid);
          if (is_array($rsampledata)) {
            foreach($rsampledata as $rsamplerec){
             $actualpage=$rsamplerec['resultname'];
             
            }
          }else{
            $actualpage="resultnew1";
          }
      }



  $stuid=(isset($_POST['studid'])?$_POST['studid']:false);
  
  $idcol="";
  foreach($stuid as $i => $sdentid){
    //echo  $studentid= (int)$stuid[$i];
      //echo $studentid=$_POST[$sdentid];
      //if ($i!="") {
        if(empty(trim($idcol))){
          $idcol.=$sdentid;
        }else{
          $idcol.=",".$sdentid;
        }
      //}
  }
  echo $idcol;
  //$actualpage
    echo "
      <script language='javascript'>
       window.location.href='../schoolhelp/printpdf/$actualpage?idcol=$idcol'
      </script>
    ";
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
     	<form method="post" action="?refno=<?php echo $staffid; ?>&page=5" name="frmSearch" onSubmit="return attendancecheck();">
              <table id="datatable-buttons" class="table table-responsive table-stripped">
              	<thead><tr><th>Option/Group:</th><th>Level|Class:</th><th>Action</th></tr></thead>
              	<tbody>
                  <tr style="padding-left:6%;">
                      
                    
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
      <div class="x_panel" id="printrecord">
                         
                    <form method="post" action="?page=2&refno=<?php echo $staffid; ?>" name="idcard" onSubmit="return printresult();">
                      <input name="levelid"  type="hidden" id='levelid' value="<?php echo $levelid; ?>" > 
                      <input name="optionid"  type="hidden" id="optionid" value="<?php echo $optionid; ?>" >
                      <input name="semesterid"  type="hidden" id='semesterid' value="<?php echo $semesterid; ?>" > 
                      <input name="sessionid"  type="hidden" id="sessionid" value="<?php echo $sessionid; ?>" >
                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <center><caption><h2><?php echo $levelname.' '.$optionname ; ?></h2></caption></center>
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th><input name="topcheckbox"  type="checkbox" id='checkAll' value=""/>  Select All</th>
                          <th>Reg No</th>
                          <th>Surname</th>
                          <th>Othername</th>
                        </tr>
                      </thead>

                      <?php if($classtype==1) { ?>

                      <tbody>
                        <?php $k=0; 
                        
                         

                            $records=$SHteacher->allteacheredit2('students', 'levelid', $levelid, 'optid', $optionid);
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                               $k+=1;
                               $regno="";
                               $surname="";
                               $othername="";
                                
                                    $stid=trim($fieldrecord['stid']);
                                    $regno=$fieldrecord['regno'];
                                    $surname=$fieldrecord['surname'];
                                    $othername=$fieldrecord['othername'];
                                  
                        ?>
                                      <tr>
                                        <td><?php echo  $k; ?></td>
                                        <td> <input name="studid[]" id="<?php echo $stid; ?>" type="checkbox" class="status1"  value=""  onchange="if(this.checked){ this.value='<?php echo $stid; ?>'; }else{this.value='';}" /> </td>  
                                        <td><?php echo  $regno; ?></td>
                                        <td><?php echo  $surname; ?></td>
                                        <td><?php echo  $othername; ?></td>
                                       
                                      </tr>
                             <?php }
                              }
                             ?>
                        
                      </tbody>

                    <?php }else { ?>
                      <tbody>
                        <?php $k=0; 
                        $positionresult="positionresult".$deptid;
                         $regno="";
                         $surname="";
                         $othername="";

                            $records=$SHteacher->positionresult_sel($positionresult, 'levelid', $levelid, 'optionid', $optionid, 'semesterid', $semesterid, 'sessionid', $sessionid, 'stid');
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                                $regno="";
	                         $surname="";
	                         $othername="";
                               $k+=1;
                               $stid=trim($fieldrecord['stid']);
                                 $records1=$SHteacher->allteacheredit('students', 'stid', $stid);
                                  if (isset($records1)) {
                                      foreach($records1 as $fieldrecord1){
                                        $regno=$fieldrecord1['regno'];
                                        $surname=$fieldrecord1['surname'];
                                        $othername=$fieldrecord1['othername'];
                                    }
                                  }
                        ?>
                                      <tr>
                                        <td><?php echo  $k; ?></td>
                                        <td> <input name="studid[]" id="<?php echo $stid; ?>" type="checkbox" class="status1"  value="<?php echo $stid; ?>"  onchange="if(this.checked){ this.value='<?php echo $stid; ?>'; }else{this.value='';}" /> </td>  
                                        <td><?php echo  $regno; ?></td>
                                        <td><?php echo  $surname; ?></td>
                                        <td><?php echo  $othername; ?></td>
                                       
                                      </tr>
                             <?php }
                              }
                             ?>
                        
                      </tbody>
                      <?php  }  ?>

                    </table>
                    <div class="row no-print" style="margin-bottom: 50px">
                        <div class="col-xs-12">
                      		<input id="save" type="submit" class="btn btn-info btn-mini" value=" Print Result Card " />
                        </div>
                      </div>
                  </form>
                  
                    </div>
              
    <!--/row-->
    </div>
    </div>
  	</div>
    </div>
                <!-- /.row -->
	
 <?php include("footernew.php");?>
 
 	<script>
	
	
	function printresult(){
		
		if(!confirm('Are you sure the attendance is marked correctly?'))
		{return false;}
		}
	
 	
	 $("#checkAll").click(function(event) {
	  if(this.checked) {
		  // Iterate each checkbox
		  $('.status1').each(function() {
			  this.checked = true;
			  
		  });
	  }
	  else {
		$('.status1').each(function() {
			  this.checked = false;
			  
			  
		  });
	  }
	});
	
	</script>