<?php include("headernew.php");
?>
<?php 

$page=trim(isset($_GET['page'])? $_GET['page']:false);
$refno= trim(isset($_GET['refno'])? $_GET['refno']:false);
$stid =trim(isset($_SESSION['stid'.$refno])?$_SESSION['stid'.$refno]:false);

  $studentdata=$SHstudent->allstudentedit('students', 'stid', $stid);
      if (is_array($studentdata)) {
        foreach($studentdata as $studentrec){
         $levelid=trim($studentrec['levelid']);
         
        }
      }

        $leveldata=$SHstudent->allstudentedit('level', 'levelid', $levelid);
      if (is_array($leveldata)) {
        foreach($leveldata as $levelrec){
         $deptid=trim($levelrec['departmentid']);
        $attendance="attendance".trim($deptid);
         
        }
      }
?>


<div id="page-wrapper">

            <div class="container-fluid">
				<!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Hi!</strong> <span style="font:20px Corbel bold; color:#060; "><?php echo $fullname." "; ?> </span><span style="color:#060;">; Class:<span style="color:#FEA318;"><?php echo $levelname ." " ; ?>;</span> Group:<span style="color:#FEA318;"><?php echo $optionname ." " ; ?></span> <span style="font:20px Corbel  bold; color:#F00; ">; <?php echo $semestername; echo " ";?>Term of <?php echo $sessionname; ?></span> </span>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-11.8 col-xs-11.8 col-sm-11.8 col-md-11.8" style=" margin:0% 2% 0%; background:#FFF; padding:1%; ">
                        <h1 class="page-header" style="margin-top:4px; color:#063;">Student Attendance<small></small></h1>
                        <div id='calendar'></div>
                        </div>
                        
                </div>
                 
				 
                </div>
               
                
                <!-- /.row -->

                

        </div>
 <?php include("footernew.php");?>
 <script>
	$(document).ready(function() {
	
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			editable: true,
			events: [
				<?php
					$k=0;
					 $studentsattend=$SHstudent->allstudentedit($attendance, 'stid', $stid);
					 $attendcount=count($studentsattend);
                        if(is_array($studentsattend)) {
                         foreach($studentsattend as $studentsattendrec1){
							$k = $k + 1;
							$attendancedate = $studentsattendrec1["attendancedate"];
							$year = date('Y', strtotime($attendancedate));
							$day = date('d', strtotime($attendancedate));
							$month = date('m', strtotime($attendancedate));
							
						?>
						
							{      
								<?php if($studentsattendrec1["status"]==1){ ?>
								title:  '<?php echo "Present" ?>',
								<?php } else{?>
								title:  '<?php echo "Absent" ?>',
								<?php } ?>
								start: new Date( <?php echo  $year; ?>,  <?php echo $month-1; ?>,  <?php echo $day; ?>),

							}<?php if ($k!=$attendcount) {
								echo ",";
							} ?>
						
							
						<?php 
						
					}  
				}
				?>
			]
		});
		
	});

</script>