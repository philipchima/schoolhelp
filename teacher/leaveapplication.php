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

       
		 $odate = date("Y-m-d");
		 // Closure of Variable
		$description="";
?>

<?php
  if ($page == 2)
    {
       $instructorudate=date("Y-m-d H:i:s");
       $udate=date("Y-m-d");

       $description=trim(isset($_POST['description'])?$_POST['description']:false);
       // =============  File Upload Code d  ===========================================
       $letteredname = $_FILES["letter"]["name"] . "";
        
            $target_dir = "../schoolhelp/uploads/leaveapplication/";
            $letteredtemp=$_FILES['letter']['tmp_name'];

            $letteredname = $_FILES["letter"]["name"] . "";
            $lettername=round(microtime(true)).$letteredname;
            $letteredsize = $_FILES["letter"]["size"] . "";
            $letteredtype = $_FILES["letter"]["type"] . "";

            $target_file = $target_dir . basename($lettername);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            // Check if file already exists
            if (file_exists($target_file)) {
                $sql="Sorry, file already exists.";
                $uploadOk = 0;
            }

              // Check file size -- Kept for 500kb
            if ($_FILES["letter"]["size"] > 500000) {
                $sql.=", " ."Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf") {
                $sql.=", " ."Sorry, only doc, docx, pdf files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
               echo  $sql.=", " ."Sorry, your file was not uploaded.";
               
               echo "<script language='javascript'>
                      location.href='?refno=$staffid&sql=$sql&page=1&description=$description'
                    </script>";
                
            } else {
               
                if (move_uploaded_file($letteredtemp, $target_file)) {
                    $sql= "The file ". basename( $_FILES["letter"]["name"]). " has been uploaded.<br>";

              echo $state=$teachersinsert->insert_8fields('leaveapplication', 'semesterid', $semesterid, 'sessionid', $sessionid, 'instructorudate', $instructorudate, 'staffid', $staffid, 'letter', $lettername, 'description', $description, 'status', '0', 'odate', $odate);
              $sql.=", ".$state.":: Insertion Made, affected records = 1";
             
              echo "<script language='javascript'>
                      location.href='?refno=$staffid&sql=$sql'
                    </script>"; 

                } else {
              
                    $sql= "Sorry, there was an error uploading your file.";
                    echo "<script language='javascript'>
                      location.href='?refno=$staffid&sql=$sql&page=1&description=$description'
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
      $lid=trim(isset($_POST['lid'])?$_POST['lid']:false);
      $description=trim(isset($_POST['description'])?$_POST['description']:false);
      $letterold=trim(isset($_POST['letterold'])?$_POST['letterold']:false);
      
       // =============  File Upload Code d  ===========================================
       $letteredname = $_FILES["letter"]["name"] . "";
          if($letteredname!=""){
            $target_dir = "../schoolhelp/uploads/leaveapplication/";
            $letteredtemp=$_FILES['letter']['tmp_name'];

            $letteredname = $_FILES["letter"]["name"] . "";
            $lettername=round(microtime(true)).$letteredname;
            $letteredsize = $_FILES["letter"]["size"] . "";
            $letteredtype = $_FILES["letter"]["type"] . "";

            $target_file = $target_dir . basename($lettername);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            // Check if file already exists
            if (file_exists($target_file)) {
                $sql="Sorry, file already exists.";
                $uploadOk = 0;
            }

             // Check file size -- Kept for 500kb
            if ($_FILES["letter"]["size"] > 500000) {
                $sql.=", " ."Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf") {
                $sql.=", " ."Sorry, only doc, docx, pdf files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
               echo  $sql.=", " ."Sorry, your file was not uploaded.";
               
               echo "<script language='javascript'>
                      location.href='?refno=$staffid&sql=$sql&page=3&description=$description'
                    </script>";
                
            } else {
               
                if (move_uploaded_file($letteredtemp, $target_file.$lettername)) {
                  @unlink($target_dir.$letterold);
                    $sql= "The file ". basename( $_FILES["letter"]["name"]). " has been uploaded.<br>";
            
            echo  $state= $schoolhelpupdate->update_fourfields('leaveapplication', 'lid', $lid, 'description',  $description,  'letter',  $lettername, 'status', '0',  'instructorudate', $instructorudate);
           
              echo "<script language='javascript'>
                      location.href='?refno=$staffid&sql=$sql'
                    </script>"; 

                } else {
              
                    $sql= "Sorry, there was an error uploading your file.";
                    echo "<script language='javascript'>
                      location.href='?refno=$staffid&sql=$sql&page=3&description=$description'
                    </script>"; 
                }
            }

            // ===============================================  File Upload Code u  ==========================================================
          }else{ // if upload is not found
            $lettername=$letterold;
            echo $state= $schoolhelpupdate->update_fourfields('leaveapplication', 'lid', $lid, 'description',  $description, 'status', '0', 'letter',  $lettername,  'instructorudate', $instructorudate);
             
               echo "<script language='javascript'>
                      location.href='?refno=$staffid&sql=$sql'
                    </script>"; 
          }

 
    }
?>

<?php
	if ($page==6) {
  
   $recordid=trim(isset($_GET['recordid'])?$_GET['recordid']:false);
   $filename=trim(isset($_GET['filename'])?$_GET['filename']:false);
  
    $state=$schoolhelpupdate->delete_result('leaveapplication', 'lid', $recordid);

        $sql=$state.":: Deletion Made, affected records = 1";
         if ($state=="Success") {
                 $target_dir = "../schoolhelp/uploads/leaveapplication/";
                  @unlink($target_dir.$filename);
              }
          
          
        echo "<script>
                location.href='?refno=$staffid&sql=$sql'
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
                    <a class="btn btn-success" href="?refno=<?php echo $staffid; ?>">View Application Letter</a>
                    <a class="btn btn-success" href="?page=1&refno=<?php echo $staffid; ?>" >Add Application Letter</a>
                  </div>
                </div>

          <div class="row">
         <div class="table-responsive" style="background:#063; margin:0% 2% 0% 4%; border-bottom:2px solid #063; color:#FFF; border-radius:2px; -moz-border-radius:3px; -o-border-radius:3px; -webkit-border-radius:3px; -o-border-radius:3px; width:88%; font-size:1.3em; margin-left:auto; margin-right:auto; text-align:center;">Leave Application
        </div>
        </div>

        <div style="width:80%; margin-left:auto; margin-right:auto; margin-top:2%;"><?php if($sql){ echo "<span class='glyphicon glyphicon-info-sign' style='color:green'></span><span style='color:green'>$sql</span>";  }?></div>
               
       <?php
  if ($page == "")
  {
    ?>      
      
           <?php  $teacherquestion=$SHteacher->teacheredit3order('leaveapplication', 'staffid', $staffid, 'semesterid', $semesterid, 'sessionid', $sessionid, 'odate', 'DESC');
            if (is_array($teacherquestion)) { ?>

            <div class="table-responsive uploadedques" style="width:80%; margin-left:auto; margin-right:auto">
           
           <table class="table table-bordered table-hover table-responsive" id="datatable-buttons"> 
              <thead>
                <tr>
                  <th>S/N:</th>
                  <th>Letter:</th>
                  <th>Description:</th>
                   <th>Uploaded Date:</th>
                  <th>Admin person:</th>
                  <th>Admin Comment</th>
                  <th>Status:</th>
                  <th>Edit</th>
                  <th>Delete</th>
                  
                  
                </tr>
              </thead>
                <tbody>
              <?php
               $k=0;
              
                foreach($teacherquestion as $teacherquestionrec){
                  $k+=1;
            ?> 
                <tr>  
                   <td align="center"><?php echo $k; ?></td>
                   <td><a target="new" class="embed" href="../schoolhelp/uploads/leaveapplication/<?php echo $teacherquestionrec['letter'];?>">Click on it to Preview <span class="glyphicon glyphicon-arrow-right"></span><?php echo $teacherquestionrec['letter'];?></a></td>
                   <td ><?php echo $teacherquestionrec['description']; ?></td>                 
                   <td><?php echo $teacherquestionrec['odate']; ?></td>
                    <td>
                     <?php
                 
                     /*$instructorrecords=$SHteacher->allteacheredit('staff', 'staffid', trim($teacherquestionrec['staffid']));
                        if (is_array($instructorrecords)) {
                               foreach($instructorrecords as $instructordata){
                                echo "Teacher: ".$instructordata['surname']." ".$instructordata['othername'];
                               }
                        }else{
                            echo "This Record Missing in the Database";
                        }*/
                 
                    $operatorrecords=$SHteacher->allteacheredit('adminpersons', 'adminid', trim($teacherquestionrec['operatorid']));
                        if (is_array($operatorrecords)) {
                               foreach($operatorrecords as $operatordata){
                                echo  $operatordata['surname']." ".$operatordata['othername'];
                               }
                        }else{
                            echo "This Record Missing in the Database";
                        }
                     ?>
                   </td>
                   <td title="Click to view approval report"><a style="text-decoration: underline; color:brown" href="?page=5&lid=<?php echo $teacherquestionrec['lid']; ?>&refno=<?php echo  $staffid; ?>"><?php echo trim($teacherquestionrec['comment']); ?></a></td>
                   <td><b><?php $status=trim($teacherquestionrec['status']);
                      if ($status==0) {
                          echo "<span style='color:red'>Processing...</span>";
                      }
                      elseif($status==1){
                        echo "<span style='color:green'>Approved: Congrats...</span>";
                      }
                      elseif($status==2){
                        echo "<span style='color:yellow'>Not Yet Approved: correction to be made...</span>";
                      }
                       elseif($status==3){
                        echo "<span style='color:yellow'>On View</span>";
                      }
                      else{
                        echo "<span style='color:red'>Processing...</span>";
                      }
                    ?></b></td>
                    <?php if ($teacherquestionrec['status']!=1) { ?>
                     
                    <td><input type="button" id="cbtedit" style="background-color:#060; border-color:#060; color:#FFF" onclick="funcedit('<?php echo $staffid; ?>','','<?php echo trim($teacherquestionrec['lid']); ?>')" value="Edit"></td>
                     <td align="right"><button style="background-color:#060; border-color:#060; color:#FFF" id="cbtdelete" onclick="funcdelete('<?php echo $staffid; ?>','','<?php echo trim($teacherquestionrec['lid']); ?>', '<?php echo $teacherquestionrec['letter']; ?>')" >Delete</button></td>
                     <?php } ?>
                </tr>
                                       
               
                <?php } 

                ?>
                </tbody>
            </table>  
           
            </div> 
              
      <?php 
        }else{ echo "<center><span style='color:red; font-size:16px'>Leave Application Letter not found in Database</span></center>"; }
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
                                <label>Upload Letter</label>
                            </td>
                            <td>
                        <p id="error1" style="display:none; color:#FF0000;">
                        Invalid Image Format! Image Format Must Be doc, docx, pdf.
                        </p>
                        <p id="error2" style="display:none; color:#FF0000;">
                        Maximum File Size Limit is 500KB.
                        </p>
                    </div>
                     <p id="error1" style="display:none; color:#FF0000;">
                        Invalid Image Format! Image Format Must Be doc, docx, pdf.
                        </p>
                        <p id="error2" style="display:none; color:#FF0000;">
                        Maximum File Size Limit is 500KB.
                        </p>
                                <input class="form-control" type="file" name="letter"   required="required" />
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

              $teachersquestions=$SHteacher->allteacheredit('leaveapplication','lid', $recordid);
            if (is_array($teachersquestions)) {
                foreach($teachersquestions as $teachersquestionsrec){
                    $description=$teachersquestionsrec['description'];
                    $filename=$teachersquestionsrec['letter'];
                    
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
                          <td> <label>Semester:</label> </td>
                              <td style="padding-right:40px">
                              <?php echo $semestername; ?>
                              <input id="lid" name="lid" hidden="true" value="<?php echo $recordid; ?>"/>
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
                                <label>Leave Application</label>
                            </td>
                            <td>
                                <input  type="text" name="letterold" value="<?php echo $filename;  ?>" hidden="hidden"/>
                                <input type="file" class="form-control" name="letter"/>
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
           <?php if ($page==5) {
                  $k=0;
                  $lid=trim(isset($_GET['lid'])?$_GET['lid']:false);

                     $records=$SHteacher->allteacheredit('leaveapplication', 'lid', $lid);
                      if (isset($records)) {
                                
                      foreach($records as $fieldrecord){
                      $k+=1;
                      $staffid=trim($fieldrecord['staffid']);
                      $operatorid=trim($fieldrecord['operatorid']);
                      $adminsurname="";
                      $adminothername="";

                      $operatorrecords=$SHteacher->allteacheredit('adminpersons', 'adminid', $operatorid);
                        if (is_array($operatorrecords)) {
                          foreach($operatorrecords as $operatordata){
                              $adminsurname=$operatordata['surname'];
                              $adminothername=$operatordata['othername'];
                          }
                        }

                      $records1=$SHteacher->allteacheredit('staff', 'staffid', $staffid);
                        if (isset($records1)) {
                          foreach($records1 as $fieldrecord1){
                          $staffname=$fieldrecord1['surname']." ".$fieldrecord1['othername'];
                        }
                      }
                      
                        $records2=$SHteacher->allteacher('institution', 'i_id', 'DESC');
                        if (isset($records2)) {
                          foreach($records2 as $fieldrecord2){
                         $instilogo=$fieldrecord2['instilogo'];
                        }
                      }      
                  ?>
                   <div id="editexamquestion"  style="width:80%;  margin-left:auto; margin-right:auto; margin-bottom: 40px">
                    <div class="x_panel" >
                  <div class="x_title">
                    <h3>Leave Application Details </h3>
                    <ul class="nav navbar-right panel_toolbox" id="panel_toolbox">
                      
                      <li class="pull-right"><a href="?refno=<?php echo $staffid; ?>" class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" id="printrecord">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h3>
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $staffname; ?>.
                                          <small class="pull-right">Date: <?php echo $odate; ?></small>
                                      </h3>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                       
                       
                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col">
                         <img id="userimage" <?php if ($instilogo!="") {?> style="display: block" src="../schoolhelp/images/logo/<?php echo $instilogo ?>" <?php } ?> class="img img-responsive img-thumbnail" >
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col" align="right">
                          <h4><b>Admin Details:</b></h4>
                          <address>
                                          Updated by: <strong><?php echo $adminsurname ." ".$adminothername; ?></strong>
                                          <br><b>Date: </b><?php echo $fieldrecord['udate']; ?></strong>
                                          <br><b>Initial Insertion Date: </b><?php echo $fieldrecord['odate']; ?>
                                          
                                      </address>
                        </div>

                      
                      </div>
                      <!-- /.row -->


                   

                      <div class="row">
                       
                        <div class="col-xs-12">
                          <hr>
                         
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Applicant Name:</th>
                                  <td><?php echo $staffname; ?></td>
                                </tr>
                                <tr>
                                  <th>Description:</th>
                                  <td><?php echo $fieldrecord['description']; ?></td>
                                </tr>
                                <tr>
                                  <th>Letter:</th>
                                  <td></td>
                                </tr>
                                <tr>
                                  <th>Admin Comment</th>
                                  <td><?php echo $fieldrecord['comment']; ?></td>
                                </tr>
                                <tr style="margin-bottom:10px">
                                  <th>Status</th>
                                  <td>
                                      <?php 
                                      $status=trim($fieldrecord['status']);
                                       if ($status==0) {
                                          echo "<span style='color:red'>Processing...</span>";
                                        }
                                        elseif($status==1){
                                          echo "<span style='color:green'>Approved: Congrats...</span>";
                                        }
                                        elseif($status==2){
                                         echo "<span style='color:yellow'>Not Yet Approved: correction to be made...</span>";
                                                  }
                                         elseif($status==3){
                                          echo "<span style='color:yellow'>On View</span>";
                                          }
                                         else{
                                          echo "<span style='color:red'>Processing...</span>";
                                        }
                                      ?>
                              </td>
                              </tr>

                               <?php  $k1=0;
                               $records1=$SHteacher->allteacheredit('leaveapplicationcomment', 'leaveapplyid', $lid);
                                      if (is_array($records1)) { 
                                        foreach ($records1 as $record1) { 
                                          $k1+=1; ?>
                                <tr>
                                  <th style="color:red"><b>Previous Correction <?php echo $k1; ?></b></th>
                                  <td class="col-md-6 col-sm-6 col-xs-12">
                                    <?php echo $record1['comment']; ?>
                                    <br>
                                     <b><?php echo $record1['udate']; ?></b>
                                  </td>
                                 
                                </tr>
                                 <?php }
                                      } ?>

                              </tbody>
                            </table>
                          </div>
                        </div>
                          <?php
                            }
                          ?>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                          <button class="btn btn-default print-link" ><i class="fa fa-print"></i> Print</button>
                          
                          
                        </div>
                      </div>
                    </section>
                  </div>
                </div></div> <?php } 
                            }
                          ?>
                     
       
        
    </div>
    
      
        </div>
          
 <?php include("footernew.php");?>
 
