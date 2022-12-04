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
         $levelid=trim(isset($_GET['class'])?$_GET['class']:false);
         $optionid=trim(isset($_GET['gid'])?$_GET['gid']:false);

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
		 $description="";
     $description=trim(isset($_GET['description'])?$_GET['description']:false);
?>

<?php
	if ($page == 2)
		{
       $instructorudate=date("Y-m-d H:i:s");
       $udate=date("Y-m-d");

       $description=trim(isset($_POST['description'])?$_POST['description']:false);
       // =============  File Upload Code d  ===========================================
       $vidname = $_FILES["video"]["name"] . "";
        
            $target_dir = "../schoolhelp/uploads/videoresource/";
            $videotemp=$_FILES['video']['tmp_name'];

            $vidname = $_FILES["video"]["name"] . "";
            $videoname=$vidname;
            $vidsize = $_FILES["video"]["size"] . "";
            $vidtype = $_FILES["video"]["type"] . "";

            $target_file = $target_dir . basename($_FILES["video"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            // Check if file already exists
            if (file_exists($target_file)) {
                $sql="Sorry, file already exists.";
                $uploadOk = 0;
            }

             // Check file size -- Kept for 500Mb
            if ($_FILES["video"]["size"] > 500000000) {
                $sql.=", " ."Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "webm" && $imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mp3" && $imageFileType != "JPG" && $imageFileType != "PNG") {
                $sql.=", " ."Sorry, only webm, mp4, mp3, avi, png files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
               echo  $sql.=", " ."Sorry, your file was not uploaded.";
               
               echo "<script language='javascript'>
                      location.href='?refno=$staffid&sql=$sql&gid=$optionid&class=$levelid&page=1&description=$description'
                    </script>";
                
            } else {
               
                if (move_uploaded_file($videotemp, $target_file)) {
                    $sql= "The file ". basename( $_FILES["video"]["name"]). " has been uploaded.<br>";

              $state=$teachersinsert->insert_9fields('classresources', 'levelid', $levelid, 'optionid', $optionid, 'semesterid', $semesterid, 'sessionid', $sessionid, 'instructorudate', $instructorudate, 'instructorid', $staffid, 'video', $videoname, 'description', $description, 'odate', $odate);
              $sql.=", ".$state.":: Insertion Made, affected records = 1";
              
              echo "<script language='javascript'>
                      location.href='?refno=$staffid&sql=$sql&gid=$optionid&class=$levelid'
                    </script>"; 

                } else {
              
                    $sql= "Sorry, there was an error uploading your file.";
                    echo "<script language='javascript'>
                      location.href='?refno=$staffid&sql=$sql&gid=$optionid&class=$levelid&page=1&description=$description'
                    </script>"; 
                }
            }

            // ===============================================  File Upload Code u  ==========================================================
        

		}
?>

<?php
	if ($page == 4)
	
		{
			
			$instructorudate=date("Y-m-d H:i:s");
      $resourcesid=trim(isset($_POST['resourcesid'])?$_POST['resourcesid']:false);
      $description=trim(isset($_POST['description'])?$_POST['description']:false);
      $videoold=trim(isset($_POST['videoold'])?$_POST['videoold']:false);
			
       // =============  File Upload Code d  ===========================================
       $vidname = $_FILES["video"]["name"] . "";
          if($vidname!=""){
            $target_dir = "../schoolhelp/uploads/videoresource/";
            $videotemp=$_FILES['video']['tmp_name'];

            $vidname = $_FILES["video"]["name"] . "";
            $videoname=$vidname;
            $vidsize = $_FILES["video"]["size"] . "";
            $vidtype = $_FILES["video"]["type"] . "";

            $target_file = $target_dir . basename($_FILES["video"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            // Check if file already exists
            if (file_exists($target_file)) {
                $sql="Sorry, file already exists.";
                $uploadOk = 0;
            }

             // Check file size -- Kept for 500Mb
            if ($_FILES["video"]["size"] > 500000000) {
                $sql.=", " ."Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "webm" && $imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mp3" && $imageFileType != "JPG" && $imageFileType != "PNG") {
                $sql.=", " ."Sorry, only webm, mp4, mp3, avi, png files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
               echo  $sql.=", " ."Sorry, your file was not uploaded.";
               
               echo "<script language='javascript'>
                      location.href='?refno=$staffid&sql=$sql&gid=$optionid&class=$levelid&page=3&description=$description'
                    </script>";
                
            } else {
               
                if (move_uploaded_file($videotemp, $target_file)) {
                  @unlink($target_dir.$videoold);
                    $sql= "The file ". basename( $_FILES["video"]["name"]). " has been uploaded.<br>";
            
             $state= $schoolhelpupdate->update_fourfields('classresources', 'resourcesid', $resourcesid, 'description',  $description, 'instructorid',  $staffid,  'video',  $videoname,  'instructorudate', $instructorudate);
               
              echo "<script language='javascript'>
                      location.href='?refno=$staffid&sql=$sql&gid=$optionid&class=$levelid'
                    </script>"; 

                } else {
              
                    $sql= "Sorry, there was an error uploading your file.";
                    echo "<script language='javascript'>
                      location.href='?refno=$staffid&sql=$sql&gid=$optionid&class=$levelid&page=3&description=$description'
                    </script>"; 
                }
            }

            // ===============================================  File Upload Code u  ==========================================================
          }else{ // if upload is not found
            $videoname=$videoold;
            echo $state= $schoolhelpupdate->update_fourfields('classresources', 'resourcesid', $resourcesid, 'description',  $description, 'instructorid',  $staffid,  'video',  $videoname,  'instructorudate', $instructorudate);
             
               echo "<script language='javascript'>
                      location.href='?refno=$staffid&sql=$sql&gid=$optionid&class=$levelid'
                    </script>"; 
          }

 
		}
?>


<?php
	if ($page==6) {
  
   $recordid=trim(isset($_GET['recordid'])?$_GET['recordid']:false);
   $filename=trim(isset($_GET['filename'])?$_GET['filename']:false);
  
    $state=$schoolhelpupdate->delete_result('classresources', 'resourcesid', $recordid);

        $sql=$state.":: Deletion Made, affected records = 1";
         if ($state=="Success") {
                 $target_dir = "../schoolhelp/uploads/videoresource/";
                  @unlink($target_dir.$filename);
              }
          
        echo "<script>
                location.href='?refno=$staffid&sql=$sql&class=$levelid&gid=$optionid'
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
                 <div class="row">
                  <div style="margin:0% 2% 0% 4%; width:88%; font-size:1.3em; margin-left:auto; margin-right:auto;">
                    <a class="btn btn-success" href="?gid=<?php echo $optionid; ?>&class=<?php echo $levelid; ?>&refno=<?php echo $staffid; ?>">View Videos</a>
                    <a class="btn btn-success" href="?page=1&gid=<?php echo $optionid; ?>&class=<?php echo $levelid; ?>&refno=<?php echo $staffid; ?>" >Add Video</a>
                  </div>
                </div>
               
          <div class="row">
         <div class="table-responsive" style="background:#063; margin:0% 2% 0% 4%; border-bottom:2px solid #063; color:#FFF; border-radius:2px; -moz-border-radius:3px; -o-border-radius:3px; -webkit-border-radius:3px; -o-border-radius:3px; width:88%; font-size:1.3em; margin-left:auto; margin-right:auto; text-align:center;">Video Resources Document Uploads for  <?php echo $levelname . " " . $optionname; ?> 
        </div>
        </div>

        <div style="width:80%; margin-left:auto; margin-right:auto; margin-top:2%;"><?php if($sql){ echo "<span class='glyphicon glyphicon-info-sign' style='color:green'></span><span style='color:green'>$sql</span>";  }?></div>

        <?php
	if ($page == "")
	{
		?>     	
			
           <?php  $teacherquestion=$SHteacher->teacheredit5order('classresources', 'levelid', $levelid, 'optionid', $optionid, 'instructorid', $staffid, 'semesterid', $semesterid, 'sessionid', $sessionid, 'odate', 'DESC');
            if (is_array($teacherquestion)) { ?>

            <div class="table-responsive uploadedques" style="width:80%; margin-left:auto; margin-right:auto">
           
           <table class="table table-bordered table-hover table-responsive" id="datatable-buttons"> 
              <thead>
                <tr>
                  <th>S/N:</th>
                  <th>Video:</th>
                  <th>Description:</th>
                  <th>Updated By:</th>
                  <th>Uploaded Date:</th>
                  <th>Delete</th>
                  <th>Edit</th>
                  
                </tr>
              </thead>
                <tbody>
              <?php
               $k=0;
              
                foreach($teacherquestion as $teacherquestionrec){
                  $k+=1;
            ?> 
                <tr>  
                   <td align="center"><?php echo $k; ?></td><td><a target="new" class="embed" href="../schoolhelp/uploads/videoresource/<?php echo $teacherquestionrec['video'];?>">Click on it to Preview <span class="glyphicon glyphicon-arrow-right"></span><?php echo $teacherquestionrec['video'];?></a></td>
                   <td><?php echo $teacherquestionrec['description']; ?></td>
                   <td>
                     <?php
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
                   
                   <td><?php echo $teacherquestionrec['odate']; ?></td>
                    <td><input type="button" id="cbtedit" style="background-color:#060; border-color:#060; color:#FFF" onclick="funcedit1('<?php echo $staffid; ?>','<?php echo $optionid; ?>','<?php echo $levelid; ?>','<?php echo trim($teacherquestionrec['resourcesid']); ?>')" value="Edit"></td>
                     <td align="right"><button style="background-color:#060; border-color:#060; color:#FFF" id="cbtdelete" onclick="funcdelete1('<?php echo $staffid; ?>','<?php echo $optionid; ?>','<?php echo $levelid; ?>','<?php echo trim($teacherquestionrec['resourcesid']); ?>', '<?php echo $teacherquestionrec['video']; ?>')" >Delete</button></td>
                </tr>
                                       
               
                <?php } 

                ?>
                </tbody>
            </table>  
           
            </div> 
              
			<?php 
        }else{ echo "<center><span style='color:red; font-size:16px'>Level/Class Video Resources not uploaded</span></center>"; }
		  }
			?>
             <?php 
             if ($page==1) {
             
             ?>   
           	 <div class="" style="background:#FFF; margin:0% 2% 2%; padding:2%; width:80%; margin-left:auto; margin-right:auto;">
            
                    <table class="table table-striped table-bordered">
                        <caption></caption>
                    <tr height="23" onMouseOut="this.style.backgroundColor='';" bgcolor="#EFEFEF">
                        <td colspan="5"  align="center">
                        <form method="post" action="?refno=<?php echo $staffid; ?>&page=2&class=<?php echo $levelid; ?>&gid=<?php echo $optionid; ?>" name="frmReg"  enctype="multipart/form-data">
                    <table class="table" style="border:none">
                         
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
                                <label>Resourse Video</label>
                            </td>
                            <td>
                        <p id="error1" style="display:none; color:#FF0000;">
                        Invalid Image Format! Image Format Must Be MP4, MPEG, MP3 or GIF, PNG, JPG.
                        </p>
                        <p id="error2" style="display:none; color:#FF0000;">
                        Maximum File Size Limit is 20MB.
                        </p>
                    </div>
                     <p id="error1" style="display:none; color:#FF0000;">
                        Invalid Image Format! Image Format Must Be MP4, MPEG, MP3, GIF, PNG, JPG.
                        </p>
                        <p id="error2" style="display:none; color:#FF0000;">
                        Maximum File Size Limit is 20MB.
                        </p>
                                <input class="form-control" type="file" name="video"   required="required" />
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
       
              
           
            <?php if ($page==3) { 
                $recordid=trim(isset($_GET['recordid'])?$_GET['recordid']:false);
                $filename="";
                $description="";

              $teachersquestions=$SHteacher->allteacheredit('classresources','resourcesid', $recordid);
            if (is_array($teachersquestions)) {
                foreach($teachersquestions as $teachersquestionsrec){
                    $description=$teachersquestionsrec['description'];
                    $filename=$teachersquestionsrec['video'];
                    
              }
          }
             ?>
            <div id="editexamquestion" class="table-responsive" style="width:80%; margin-top:3%; margin-bottom:3%; margin-left:auto; margin-right:auto; "">
            <table class="table table-striped table-bordered table-responsive">
			
              
                    <tr height="23"  bgcolor="#EFEFEF">
                        <td colspan="5"  align="center">
                        <form method="post" action="?refno=<?php echo $staffid; ?>&page=4&class=<?php echo $levelid; ?>&gid=<?php echo $optionid; ?>" name="frmedit"  enctype="multipart/form-data">
                    <table class="table" style="border:none">
                    	 
                         <tr>
                              <td><label>Subject:  </label></td>
                              <td style="padding-right:20px; border-width:thick">
                               <?php echo $csname; ?>  
                               <input id="resourcesid" name="resourcesid" hidden="true" value="<?php echo $recordid; ?>"/>
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
                                <input  type="text" name="videoold" value="<?php echo $filename;  ?>" hidden="hidden"/>
                                <input type="file" class="form-control" name="video" />
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
 
