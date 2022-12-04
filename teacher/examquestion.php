<?php 
include("../schoolhelp/includes/connection.php");
include("phpclass/SHteacherinserts.php");
include("phpclass/SHteacherupdate.php");
include("headernew.php"); 

$teachersinsert=new insertTable;
$schoolhelpupdate=new updateTable;
?>
<?php
         date_default_timezone_set("Africa/Lagos");
         $page = trim(isset($_GET['page'])?$_GET['page']:false);
         $sql = trim(isset($_GET['sql'])?$_GET['sql']:false);
          $tid=trim(isset($_GET['refno'])?$_GET['refno']:false);
         $staffid =trim (isset($_SESSION['t_teacherlog'.$tid])?$_SESSION["t_teacherlog".$tid]:false);
         $classinfo=trim(isset($_GET['tcid'])?$_GET['tcid']:false); //this variable should always be passed when reloading this page

        //Select current Semester/semester
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
                    $levelname=$teachersclassrec['levelname'];
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
		 $odate = date("Y-m-d");
		 // Closure of Variable
		 
?>
<?php
	if ($page == 2)
		{
            $instructorudate=date("Y-m-d H:i:s");

            $description=trim(isset($_POST['description'])?$_POST['description']:false);
			$exampaper=$_FILES["exampaper"]["name"];
           if($exampaper!=""){
              $target_dir = "../schoolhelp/uploads/exampaper/";
              $papertmp=$_FILES['exampaper']['tmp_name']; 
            $temp = explode(".", $_FILES["exampaper"]["name"]);
           
            $exampapername =$staffid.round(microtime(true)) . '.' . strtolower(end($temp));
           move_uploaded_file($_FILES["exampaper"]["tmp_name"], $target_dir . $exampapername);
            }

              
              $state=$teachersinsert->insert_10fields('examquestions', 'levelid', $levelid, 'optionid', $optionid, 'semesterid', $semesterid, 'sessionid', $sessionid, 'instructorudate', $instructorudate, 'instructorid', $staffid, 'courseid', $courseid, 'dlink',  $exampapername, 'description',  $description, 'odate', $odate);
             $sql=$state.":: Insertin Made, affected records = 1";
               
			if($exampaper){
				$sql= "<b>Operation was Successful: Record Inserted<b>";
				
	echo "
			<script language='javascript'>
				location.href='examquestion?refno=$staffid&sql=$sql&tcid=$classinfo'
			</script>
		";			
			}else{ $sql= "<b>Operation was not Successful<b>";
				echo "
			<script language='javascript'>
				location.href='examquestion?refno=$staffid&sql=$sql&tcid=$classinfo'
			</script>
		";	
				
				}
		}
?>

<?php
	if ($page == 4)
	
		{
			
			$instructorudate=date("Y-m-d H:i:s");
      $pid=trim(isset($_POST['pid'])?$_POST['pid']:false);
      $description=trim(isset($_POST['description'])?$_POST['description']:false);
      $exampaperold=trim(isset($_POST['exampaperold'])?$_POST['exampaperold']:false);
			$exampaper=$_FILES["exampaper"]["name"];


//Checking whether logo was uploaded(browsed)
  if($exampaper!=""){
  $target_dir = "../schoolhelp/uploads/exampaper/";
  $exampapertmp=$_FILES['exampaper']['tmp_name']; 
  $temp = explode(".", $_FILES["exampaper"]["name"]);
  $exampapername =strtolower($exampaper).round(microtime(true)) . '.' . end($temp);
  move_uploaded_file($_FILES["exampaper"]["tmp_name"], $target_dir. $exampapername);
  @unlink($target_dir.$exampaperold);
  }else{
    $exampapername=$exampaperold;
  }

$state= $schoolhelpupdate->update_threefields('examquestions', 'pid', $pid, 'description',  $description,  'dlink',  $exampapername,  'instructorudate', $instructorudate);
			$sql=$state.":: Update Made, affected records = 1";

			echo "
				<script language='javascript'>
					location.href='examquestion?refno=$staffid&sql=$sql&tcid=$classinfo'
				</script>
			";
		}
?>


<?php
	if ($page==6) {
  
   $recordid=trim(isset($_GET['recordid'])?$_GET['recordid']:false);
   $filename=trim(isset($_GET['filename'])?$_GET['filename']:false);
  
    $state=$schoolhelpupdate->delete_result('examquestions', 'pid', $recordid);

        $sql=$state.":: Deletion Made, affected records = 1";
         if ($state=="Success") {
                 $target_dir = "../schoolhelp/uploads/exampaper/";
                  @unlink($target_dir.$filename);
              }
          
          
        echo "<script>
                location.href='examquestion?refno=$staffid&sql=$sql&tcid=$classinfo'
              </script>";
    
}
		
?>

            <div class="container-fluid">
				<!-- /.row -->

             <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Hi!</strong> <span style="font:20px Corbel bold; color:#060; "><?php echo (isset($_SESSION["t_fullname".$tid])?$_SESSION["t_fullname".$tid]:false); ?> </span><span style="color:#FEA318;">Note that your operations is only strictly on <span style="font:20px Corbel  bold; color:#F00; "><?php echo $semestername; echo " ";?>Semester of <?php echo $sessionname; ?></span> </span>
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
				 <div class=" table-responsive" style="background:#063; margin:0% 2% 0% 4%; border-bottom:2px solid #063; color:#FFF; border-radius:2px; -moz-border-radius:3px; -o-border-radius:3px; -webkit-border-radius:3px; -o-border-radius:3px; width:88%; font-size:1.3em; margin-left:auto; margin-right:auto; text-align:center;">Exam Document Uploads for  <?php echo $levelname . " " . $optionname." on ". $csname;?> 
        </div>
        </div>
      	<div class="row">
        <div style=" width:80%; margin-left:auto; margin-right:auto; margin-top:2%;"><?php if($sql){ echo "<span class='glyphicon glyphicon-info-sign' style='color:green'></span><span style='color:green'>$sql</span>";  }?></div>
        	
			<?php
               $teacherquestion=$SHteacher->teacheredit5order('examquestions', 'courseid', $courseid, 'levelid', $levelid, 'optionid', $optionid, 'semesterid', $semesterid, 'sessionid', $sessionid, 'odate', 'DESC');
               
            if (is_array($teacherquestion)) {
                foreach($teacherquestion as $teacherquestionrec){
            ?> 
           
                 <div class="table-responsive uploadedques" style="width:80%; margin-left:auto; margin-right:auto">
                <span id="colquesid" hidden="true"><?php echo $teacherquestionrec['pid']; ?></span>
                <table class="table table-bordered table-hover table-responsive"> 
                
                <tr >  
                   <td >Uploaded By</td><td align="center"><?php
                 if($teacherquestionrec['instructorudate']>$teacherquestionrec['udate']){ 
                     $instructorrecords=$SHteacher->allteacheredit('staff', 'staffid', trim($teacherquestionrec['instructorid']));
                        if (is_array($instructorrecords)) {
                               foreach($instructorrecords as $instructordata){
                                echo "Teacher: ".$instructordata['surname']." ".$instructordata['othername'];
                               }
                        }else{
                            echo "This Record Missing in the Database";
                        }
                }else{ 
                    $operatorrecords=$SHteacher->allteacheredit('adminpersons', 'adminid', trim($teacherquestionrec['operatorid']));
                        if (is_array($operatorrecords)) {
                               foreach($operatorrecords as $operatordata){
                                echo "Teacher: ".$instructordata['surname']." ".$instructordata['othername'];
                               }
                        }else{
                            echo "This Record Missing in the Database";
                        }
                }?>
                    
                </td>
                    </tr>
                    <tr>
                    <td>Course/Subject</td><td align="center"> <?php echo $csname; ?></td>
                    </tr>
                    <tr>
                    <td>Uploaded file</td><td align="center"> <a target="new" class="embed" href="../schoolhelp/uploads/exampaper/<?php echo $teacherquestionrec['dlink'];?>">Click on it to Preview <span class="glyphicon glyphicon-arrow-right"></span><?php echo $teacherquestionrec['dlink'];?></a></td>
                    </tr>
                    <tr>
                    <td>Uploaded Date</td><td align="left"><?php  echo $teacherquestionrec['odate']; ?></td>
                      </tr>
                    <tr>
                    <td>Semester</td><td align="left"> <?php echo $semestername; ?></td>
                      </tr>
                    <tr>
                    <td>Session</td><td align="left"><?php $sessionname; ?></td></tr>
                    
                    <tr>
                    <td>Approved By</td><td align="left"><?php if($teacherquestionrec['approveby']!=0){ 
                        $operatorrecords=$SHteacher->allteacheredit('adminpersons', 'adminid', trim($teacherquestionrec['approveby']));
                        if (!is_array($operatorrecords)) {
                               foreach($operatorrecords as $operatordata){
                                echo "Teacher: ".$instructordata['surname']." ".$instructordata['othername'];
                               }
                        }else{
                            echo "This Record Missing in the Database";
                        }
                    }else{"Not Approved yet";}?></td>                         </tr>
                    <tr>
                    <td>Description</td><td align="left"><?php echo $teacherquestionrec['description']; ?></td>                         
                    </tr>
                     <tr>
                    <td>Status</td><td align="left"><?php if($teacherquestionrec['status']==1){ echo "<span style='color:green;'>Approved</span>"; } elseif($teacherquestionrec['status']==2){echo "<span style='color:red;'>Not Approved</span>";}else{"<span style='color:red;'>Not Attended to</span>";}?></td>                         </tr>
                    <tr>                          
                    <td align="right"><button style="background-color:#060; border-color:#060; color:#FFF" id="cbtdelete" onclick="funcdelete('<?php echo $staffid; ?>','<?php echo $classinfo; ?>','<?php echo $teacherquestionrec['pid']; ?>', '<?php echo $teacherquestionrec['dlink']; ?>')"  <?php if($teacherquestionrec['status']==1){?> disabled <?php }?>>Delete</button></td>
                    <td><input type="button" id="cbtedit" style="background-color:#060; border-color:#060; color:#FFF" onclick="funcedit('<?php echo $staffid; ?>','<?php echo $classinfo; ?>','<?php echo $teacherquestionrec['pid']; ?>')" <?php if($teacherquestionrec['status']==1){?> disabled <?php }?> value="Edit"></td>
                    
                </tr>
            
            </table>  
           
            </div> 
              
			<?php
			}
        }
				else
			{
			?>
                
           	 <div class="" style="background:#FFF; margin:0% 2% 2%; padding:2%; width:50%; margin-left:auto; margin-right:auto;">
            
                    <table class="table table-striped table-bordered">
                        <caption></caption>
                    <tr height="23" onMouseOut="this.style.backgroundColor='';" bgcolor="#EFEFEF">
                        <td colspan="5"  align="center">
                        <form method="post" action="examquestion?refno=<?php echo $staffid; ?>&page=2&tcid=<?php echo $classinfo; ?>" name="frmReg" onSubmit="return validatefile();" enctype="multipart/form-data">
                    <table class="table" style="border:none">
                         
                         <tr>
                              <td><label>Course/Subject:  </label></td>
                              <td style="padding-right:20px; border-width:thick">
                               <?php echo $csname; ?>  
                              </td> 
                        </tr>
                        <tr>
                            <td> <label>Semester:</label> </td>
                              <td style="padding-right:40px">
                              <?php echo $semestername; ?>
                              </td>
                        </tr>
                        <tr>
                             <td>
                                <label>
                                    Session</label>
                            </td>
                            <td>
                            <?php echo $sessionname; ?>
                            </td>
                      </tr>    
                      <tr>
                             <td>
                                <label>
                                    Description</label>
                            </td>
                            <td>
                            <textarea class="form-control" name="description"></textarea>
                            </td>
                      </tr>                                    
                        <tr>
                            <td>
                                <label>Question-paper</label>
                            </td>
                            <td>
                        <p id="error1" style="display:none; color:#FF0000;">
                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF, PDF, DOC, DOCX.
                        </p>
                        <p id="error2" style="display:none; color:#FF0000;">
                        Maximum File Size Limit is 1MB.
                        </p>
                    </div>
                     <p id="error1" style="display:none; color:#FF0000;">
                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG, GIF, DOC, DOCX.
                        </p>
                        <p id="error2" style="display:none; color:#FF0000;">
                        Maximum File Size Limit is 1MB.
                        </p>
                                <input class="form-control" type="file" name="exampaper" id="file_input"  required="required" />
                            </td>
                        </tr>
                       
                        <tr>
                            <td></td>
                            <td>
                          
                                <input  type="submit" class="btn btn-info btn-mini" value="  Submit  " />
                            </td>
                            
                        </tr>
                       
                    </table>
                   
                    </form>
                   
                        </td>
                        
                    </tr>   
                    </table>
                    </div>
                     <?php
        }
        ?>
              <?php
        }
        ?>
              
           
            <?php if ($page==3) { 
                $recordid=trim(isset($_GET['recordid'])?$_GET['recordid']:false);
                $filename="";
                $description="";

              $teachersquestions=$SHteacher->allteacheredit('examquestions','pid', $recordid);
            if (is_array($teachersquestions)) {
                foreach($teachersquestions as $teachersquestionsrec){
                    $description=$teachersquestionsrec['description'];
                    $filename=$teachersquestionsrec['dlink'];
                    
              }
          }
             ?>
            <div id="editexamquestion" class="table-responsive" style="width:80%; margin-top:3%; margin-bottom:3%; margin-left:auto; margin-right:auto; "">
            <table class="table table-striped table-bordered table-responsive">
			
              
                    <tr height="23"  bgcolor="#EFEFEF">
                        <td colspan="5"  align="center">
                        <form method="post" action="examquestion?refno=<?php echo $staffid; ?>&page=4&tcid=<?php echo $classinfo; ?>" name="frmedit" onSubmit="return validatefile1();" enctype="multipart/form-data">
                    <table class="table" style="border:none">
                    	 
                         <tr>
                              <td><label>Subject:  </label></td>
                              <td style="padding-right:20px; border-width:thick">
                               <?php echo $csname; ?>  
                               <input id="quesid" name="pid" hidden="true" value="<?php echo $recordid; ?>"/>
                              </td> 
                        </tr>
                        <tr>
                         	<td> <label>Semester:</label> </td>
                              <td style="padding-right:40px">
                              <?php echo $semestername; ?>
                              </td>
                        </tr>
                        <tr>
                        	 <td>
                                <label>
                                    Session</label>
                            </td>
                            <td>
							<?php echo $sessionname; ?>
                            </td>
                      </tr>  
                      <tr>
                             <td>
                                <label>
                                    Description</label>
                            </td>
                            <td>
                            <textarea class="form-control" name="description"><?php echo $description; ?></textarea>
                            </td>
                      </tr>                                    
                        <tr>
                            <td>
                                <label>Question-paper</label>
                            </td>
                            <td>
                                <input  type="text" name="exampaperold" value="<?php echo $filename;  ?>" hidden="hidden"/>
                                <input type="file" class="form-control" name="exampaper" id="file_input1"/>
                            </td>
                        </tr>
                       
                        <tr>
                            <td align="right">

                              <input  type="submit" class="btn btn-success btn-mini" value="  Update  " />
                            </td>
                            <td>
                                <input  type="cancel" class="btn btn-success btn-mini" value="  Cancel  " />
                            </td>
                        </tr>
                    </table>
                    </form>
                        </td>
                        
                    </tr>	
                    </table>   
                           
            </div>
            <?php } ?>
       
        
    </div>
    
      
        </div>
          
 <?php include("footernew.php");?>
 
