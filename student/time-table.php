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
                    <div class="col-md-12">
                        <fieldset>
                        <legend style="color:#063">Search Time Table</legend>
                  <form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST" id="frmmedtreatmentid" class="form-horizontal form-label-left" onsubmit="return printdailydate($('#startdate').val(), $('#enddate').val());">
                   
                      <div class="form-group">
                        
                       
                      <div class="row">
                        <div class="col-md-12">
                        <div class="col-md-4">
                      <div class="form-group">
                        <label for="startdate" class="control-label col-md-4 col-sm-4 col-xs-12">Start Date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="date" id="startdate" name="startdate" class="form-control col-xs-12" required="required">
                          </div>
                        </div>
                      </div>
                         <div class="col-md-4">
                      <div class="form-group">
                        <label for="enddate" class="control-label col-md-4 col-sm-4 col-xs-12">End Date</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="date" id="enddate" name="enddate" class="form-control col-xs-12" required="required">
                          </div>
                        </div>
                      </div>
                       
                      <div class="col-md-4"><input type="submit" class="btn btn-primary" value="Search Timetable" /></div>

                    </div>
                      </div>
                     
                   </form>
                  </div>
                  </fieldset>
                        
                </div>
                 
         
                </div>
               
                
                <!-- /.row -->

                

        </div>
 <?php include("footernew.php");?>
