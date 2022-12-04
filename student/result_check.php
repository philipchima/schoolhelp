<?php include("headernew.php");
?>
<?php 

$page=trim(isset($_GET['page'])? $_GET['page']:false);
$refno= trim(isset($_GET['refno'])? $_GET['refno']:false);
$stid =trim(isset($_SESSION['stid'.$refno])?$_SESSION['stid'.$refno]:false);

if ($page==2) {
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
    $leveldata=$SHstudent->allstudentedit('level', 'levelid', $levelid);
      if (is_array($leveldata)) {
        foreach($leveldata as $levelrec){
         $deptid=$levelrec['departmentid'];
         $classtype=trim($levelrec['classtype']);
         
        }
      }

  //Getting Report Card Sample
    if ($classtype==1) {
      $actualpage="earlyresult";
          }
    else{
    $rsampledata=$SHstudent->allstudentedit('resultsample', 'departmentid', $deptid);
      if (is_array($rsampledata)) {
        foreach($rsampledata as $rsamplerec){
         $actualpage=$rsamplerec['resultname'];
         
        }
      }else{
        $actualpage="resultnew1";
      }

    }

  $actualpage=$actualpage;
  
  $idcol=$stid;
  
  //$actualpage
    echo "
      <script language='javascript'>
        window.location.href='../schoolhelp/printpdf/$actualpage?idcol=$idcol'
      </script>
    ";
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
                    <div class="col-lg-11.8 col-xs-11.8 col-sm-11.8 col-md-11.8" style=" margin:0% 2% 0%; background:#FFF; padding:0% 0% 0%; ">
                    
                    
                <div class="row">
                    <div class="col-lg-11.8 col-xs-11.8 col-sm-11.8 col-md-11.8" style=" margin:0% 2% 0%; background:#FFF; padding:1% 1% 0%; ">
                        <h1 class="page-header" style="margin-top:4px; color:#063;">Check Result<small></small></h1>
                        </div>
                </div>
                 
				<div class="row">
                <div class="col-lg-11.8 col-xs-11.8 col-sm-11.8 col-md-11.8" style=" margin:0% 2% 0%; background:#FFF; padding:0% 1% 0%; ">
                	
                    <table class="table table-hover">
                    	<thead>
                        	<tr>
                                  <th>Option</th>
                                 <th>Class</th>
                                 <th>Term</th>
                                 <th>Year</th>
                                 <th>&nbsp;</th>
                            </tr>
                        </thead>
                         <tbody>
                         	<form method="post" action="?page=2&refno=<?php echo $stid; ?>" name="resultcheck" >
                           
                            <tr>
                               <td>
                                <select name="optionid"  class="form-control" required="required">
                                  <option value="">--Select Option/Group--</option>
                                  <?php
                                  $optionid1="";
                                  $levelid1="";
                                  $semesterid1="";
                                  $sessionid1="";
                                  $levelname1="";
                                  $optionname1="";
                                  $semestername1="";
                                  $sessionname1="";

                                       $studentoption= $SHstudent->allstudenteditunion($positiontable, 'stid', $stid, 'optionid');
                                          if (is_array($studentoption)) {
                                            foreach($studentoption as $studentoptionrec){
                                              $optionid1=trim($studentoptionrec['optionid']);

                                              //Getting the class information
                                          $studentsoption1=$SHstudent->allstudentedit('optiontable', 'optid', $optionid1);
                                          if (is_array($studentsoption1)) {
                                            foreach($studentsoption1 as $studentsoptionrec1){
                                              $optionname1=$studentsoptionrec1['optname'];
                                              
                                                }
                                            }
                                    ?>
                                  
                                  <option value="<?php echo  $optionid1; ?>" <?php if($optionid1==$optionid){?> selected="selected" <?php } ?>><?php echo $optionname1; ?></option>
                                  <?php }
                                }
                                   ?>
                                </select>
                                </td>
                                <td>
                                <select name="levelid"  class="form-control" required="required">
                                  <option value="">--Select Level/Class--</option>
                                  <?php
                                       $studentclass= $SHstudent->allstudenteditunion($positiontable, 'stid', $stid, 'levelid');
                                          if (is_array($studentclass)) {
                                            foreach($studentclass as $studentclassrec){
                                              $levelid1=trim($studentclassrec['levelid']);

                                              //Getting the class information
                                          $studentsclass1=$SHstudent->allstudentedit('level', 'levelid', $levelid1);
                                          if (is_array($studentsclass1)) {
                                            foreach($studentsclass1 as $studentsclassrec1){
                                              $levelname1=$studentsclassrec1['levelname'];
                                              $departmentid1=trim($studentsclassrec1['departmentid']);
                                                }
                                            }
                                    ?>
                                  
                                  <option value="<?php echo  $levelid1; ?>" <?php if($levelid1==$levelid){?> selected="selected" <?php } ?>><?php echo $levelname1; ?></option>
                                  <?php }
                                }
                                   ?>
                                </select>
                                </td>
                                <td>
                                	
                                      <select name="semesterid"  class="form-control" required="required">
                                            <option value="">--Select Semester/Term--</option>
                                            <?php
                                             $studentterm= $SHstudent->allstudenteditunion($positiontable, 'stid', $stid, 'semesterid');
                                          if (is_array($studentterm)) {
                                            foreach($studentterm as $studenttermrec){
                                              $semesterid1=trim($studenttermrec['semesterid']);
                                                  $semesterdata1=$SHstudent->allstudentedit('semesters','semesterid', $semesterid1);
                                              if (is_array($semesterdata1)) {
                                                  foreach($semesterdata1 as $semesterrecord1){
                                                      $semestername1=$semesterrecord1['semestername'];
                                                      
                                                }
                                            }
													 
                                              ?>
                                            <option value="<?php echo trim($studenttermrec['semesterid']); ?>" <?php if($semesterid1 == $semesterid){?> selected="selected" <?php } ?>><?php echo  $semestername1; ?></option>
                                            <?php }
                                            } ?>
                                          </select>
                                 </td>
                                  <td>
                                <select name="sessionid" class="form-control" >
                                  <option value="">--Select Year--</option>
                                 <?php
                                             $studentsession= $SHstudent->allstudenteditunion($positiontable, 'stid', $stid, 'sessionid');
                                          if (is_array($studentsession)) {
                                            foreach($studentsession as $studentsessionrec){
                                              $sessionid1="";
                                              $sessionid1=trim($studentsessionrec['sessionid']);

                                                  $sessiondata1=$SHstudent->allstudentedit('session','sessionid', $sessionid1);
                                              if (is_array($sessiondata1)) {
                                                  foreach($sessiondata1 as $sessionrecord1){
                                                      $sessionname1=$sessionrecord1['sessionlow']."/".$sessionrecord1['sessionhigh'];
                                                      
                                                }
                                            }
                                              ?>
                                            <option value="<?php echo trim($studentsessionrec['sessionid']); ?>" <?php if($sessionid1 == $sessionid){?> selected="selected" <?php } ?> ><?php echo  $sessionname1; ?></option>
                                            <?php }
                                            } ?>
                                </select>
                                </td>
                                 <td> <input type="submit" value="View Result" class="form-control" style="background:#060; color:#FFF" /></td>
                            </tr>
                            </form>
                            
                         </tbody>
                    </table>
                </div>
             </div>
             	<div class="row">
                     <div class="col-lg-11.6 col-xs-11.6 col-sm-11.8 col-md-11.6" style=" margin:0% 3% 5%; background:#FFF; padding:0% 1% 1%; ">
               
 
 </div>
 </div>
 
 
                 </div>
                 </div>
                </div>
               
                
                <!-- /.row -->

                

        </div>
 <?php include("footernew.php");?>
