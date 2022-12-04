<?php 
include("../schoolhelp/includes/connection.php");
include("phpclass/SHteacherinserts.php");
include("phpclass/SHteacherupdate.php");
include("../schoolhelp/phpclass/schoolhelpothers.php");
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
        

        $regno=trim(isset($_POST['regno'])?$_POST['regno']:false);
        $surname=trim(isset($_POST['surname'])?$_POST['surname']:false);
        $othername=trim(isset($_POST['othername'])?$_POST['othername']:false);
       
        $hdid=0;
        $sex=trim(isset($_POST['sex'])?$_POST['sex']:false);
        $dateofbirth=trim(isset($_POST['dateofbirth'])?$_POST['dateofbirth']:false);
        $address=trim(isset($_POST['address'])?$_POST['address']:false);
        
        $lgaid=trim(isset($_POST['lgaid'])?$_POST['lgaid']:false);
        $stateid=trim(isset($_POST['stateid'])?$_POST['stateid']:false);
        $countryid=trim(isset($_POST['countryid'])?$_POST['countryid']:false);
        $guardianid=trim(isset($_POST['guardianid'])?$_POST['guardianid']:false);
        $phone=trim(isset($_POST['phone'])?$_POST['phone']:false);
        $email=trim(isset($_POST['email'])?$_POST['email']:false);
        $passport=trim(isset($_POST['passport'])?$_POST['passport']:false);
        $username=trim(isset($_POST['username'])?$_POST['username']:false);
        $password=trim(isset($_POST['password'])?$_POST['password']:false);

        $udate=date("Y-m-d H:i:s");
        $odate=date("Y-m-d");
        
    

        $session=trim(isset($_POST['session'])?$_POST['session']:false);
        $studenttype=trim(isset($_POST['studenttype'])?$_POST['studenttype']:false);
        $camphoto=trim(isset($_POST['camphoto'])?$_POST['camphoto']:false);
        
        
        $password=Others::passwordconvert($password);
        
        $udate=date("Y-m-d H:i:s");
        $passportname="";
        $passport=$_FILES["passport"]["name"];
        //Getting Picture from the web Camera
        if ($camphoto!="") {
        $target_dir = "../schoolhelp/images/uploads/student/";
        copy('../schoolhelp/uploads/original/'.$camphoto, '../schoolhelp/uploads/student/'.$camphoto);
        $passportname =$camphoto;
        }
        
        //Checking whether logo was uploaded(browsed)
      
       else if($passport!=""){
        $target_dir = "../schoolhelp/images/uploads/student/";
        $passporttmp=$_FILES['passport']['tmp_name']; 
        $temp = explode(".", $_FILES["passport"]["name"]);
        $passportname =strtolower($surname).round(microtime(true)) . '.' . strtolower(end($temp));
     
        move_uploaded_file($_FILES["passport"]["tmp_name"], $target_dir . $passportname);
    
        }
    
    $insertedrow=0;
    
    
    $tablestudents=new insertTable;
    $state=$tablestudents->insert_students($regno, $session, $studenttype, $surname, $othername, $levelid, $optionid, $hdid, $sex, $dateofbirth, $address,  $lgaid, $stateid, $countryid, $guardianid,  $phone, $email, $passportname, $username, $password, $staffid, $udate, $odate);
    $display=$state['action'];
    $insertedrow=$state['counting'];
    
    
    $sql=$display.":: Insertion, affected records = 1";
       
      
       echo "<script>
        window.location.href='studentnew?refno=$staffid&sql=$sql&tcid=$classinfo&class_id=$levelid&gid=$optionid';
      </script>";
      
 
  
}

?>

<style>.required{color:red}</style>

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
				 <div class="col-md-11 col-lg-11 col-sm-11 col-xs-11 table-responsive" style="background:#063; margin:0% 2% 0% 4%; border-bottom:2px solid #8DFC6D; color:#FFF; border-radius:2px; -moz-border-radius:3px; -o-border-radius:3px; -webkit-border-radius:3px; -o-border-radius:3px; width:88%; height:35px; font-size:1.3em;"> Upload student record for <?php echo $levelname . " " . $optionname." on ". $csname;?> 
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
                        <legend style="color:#063"> Add Student</legend>
                        <form method="POST" action="?refno=<?php echo $staffid; ?>&page=4&tcid=<?php echo $classinfo; ?>">
                          <input name="optionid"  id="optionid" value="<?php  echo trim($optionid); ?>" type="hidden"/>
                          <input name="levelid"  id="levelid" value="<?php  echo trim($levelid); ?>" type="hidden"/>
                          <input name="semesterid"  id="semesterid" value="<?php  echo trim($semesterid); ?>" type="hidden"/>
                          <input name="sessionid"  id="sessionid" value="<?php  echo trim($sessionid); ?>" type="hidden"/>
                           <input name="courseid"  id="courseid" value="<?php  echo trim($courseid); ?>" type="hidden"/>
                          <input name="scoredeptid"  id="scoredeptid" value="<?php  echo trim($scoredeptid); ?>" type="hidden"/>
                          <input name="camphoto" id="camphoto" value="" class="form-control col-md-7 col-xs-12" type="hidden">
                          <div class="row">

                        <div class="col-md-11.8 table-responsive" style="padding-top:2%; margin:0% 5% 2%; border:2px solid #060;" >
                        
                            <table class="table" >
                                    <tr><td align="right"><label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Registration No.<span class="required">*</span></label></td><td><input type="text" id="regno" required="required" name="regno" class="form-control col-md-7 col-xs-12" onblur="return updatevalidity('students', 'regno', this.value, 'inserting', $(this).attr('id'));"></td></tr>
                                    
                                    <tr><td align="right"><label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Surname<span class="required">*</span></label></td> <td><input id="surname" class="form-control col-md-7 col-xs-12" type="text" name="surname" required="required"></td></tr>
                                    <tr><td align="right"> <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Othername<span class="required">*</span></label></td><td><input id="othername" class="form-control col-md-7 col-xs-12" type="text" name="othername" required="required"></td></tr>
                                    <tr><td  align="right"><label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Student Type</label></td><td> <select id="studenttype" class="form-control col-md-7 col-xs-12" type="text" name="studenttype">
                                        <option value="">-Select Student Type-</option>
                                        <option value="1">Daytime|Partime</option>
                                        <option value="2">Boarder|Full Time</option>
                                    </select></td></tr>
                                   
                              
                                    <tr><td align="right"> <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Sex<span class="required">*</span></label></td><td> 
                                        <select id="sex" class="form-control col-md-7 col-xs-12"" name="sex" required="required">
                                        <option value="">--select--</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select></td></tr>
                       
                                    <tr><td  align="right"><label for="middle-name" class="control-label col-md-4 col-sm-4 col-xs-12">Date of Birth</label></td>
                                    <td> <input id="dateofbirth" class="form-control col-md-7 col-xs-12" type="date" name="dateofbirth" required="required"></td></tr>
                                    <tr><td  align="right"><label for="middle-name" class="control-label col-md-4 col-sm-4 col-xs-12">Country</label></td>
                                    <td> <select id="countryid" class="form-control col-md-7 col-xs-12" name="countryid" required="required" onchange="retrieveselection1('states', 'country_id', this.value, 0, 0, 'state', 'state');">
                                        <option value="">--Select Country--</option>
                                    <?php //Getting title table
                                        $SHcountry=$SHteacher->allteacher('countries', 'id', 'ASC'); 
                                        foreach($SHcountry as $countryrecords){
                                        ?>
                                        <option value="<?php echo $countryrecords['id']; ?>" ><?php echo $countryrecords['name']; ?></option>
                                        <?php } ?>
                                    </select></td></tr>

                                    <tr><td  align="right"><label for="middle-name" class="control-label col-md-4 col-sm-4 col-xs-12">State</label></td>
                                    <td id="state"> 
                                        <select id="stateid" class="form-control col-md-7 col-xs-12" type="text" name="state" required="required" data-toggle="tooltip" data-placement="top" title="Make sure country is selected">
                                        <option value="">--Select State--</option>
                                    
                                    </select></td></tr>

                                    <tr><td  align="right"><label for="middle-name" class="control-label col-md-4 col-sm-4 col-xs-12">L.G.A</label></td>
                                    <td id="lga">  <select id="lgaid" class="form-control col-md-7 col-xs-12" type="text" name="lgaid" required="required" data-toggle="tooltip" data-placement="top" title="Make sure State is selected">
                                                <option value="">--Select LGA--</option>
                                            
                                    </select</td></tr>

                                    <tr><td  align="right"><label for="middle-name" class="control-label col-md-4 col-sm-4 col-xs-12">Residential Address</label></td>
                                    <td> <textarea id="address" class="form-control col-md-7 col-xs-12"  name="address" required="required"></textarea></td></tr>

                                    <tr><td  align="right"><label for="middle-name" class="control-label col-md-4 col-sm-4 col-xs-12">Phone</label></td>
                                    <td> <input id="phone" class="form-control col-md-7 col-xs-12" type="number" name="phone"></td></tr>

                                    <tr><td  align="right"><label for="middle-name" class="control-label col-md-4 col-sm-4 col-xs-12">Email</label></td>
                                    <td> <input id="email" class="form-control col-md-7 col-xs-12" type="text" name="email" ></td></tr>

                                    <tr><td  align="right"><label for="middle-name" class="control-label col-md-4 col-sm-4 col-xs-12">Guardian</label></td>
                                    <td> <input type="text" list="guardiannames" id="guardianname" class="form-control col-md-7 col-xs-12" placeholder="Please type and select guardian name " onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'guardianid');">

                                        <datalist id="guardiannames">

                                            <?php
                                            $records=$SHteacher->allteacher('guardian', 'gid', 'ASC');
                                            if (is_array($records)) {
                                            
                                            foreach($records as $fieldrecord){
                                        
                                            ?>
                                            <option data-value="<?php echo $fieldrecord['gid']; ?>"  value="<?php echo $fieldrecord['surname'].' '.$fieldrecord['othername']; ?>">
                                            <?php } 
                                        }?>
                                        </datalist>
                                        <input name="guardianid" id="guardianid" class="form-control col-md-7 col-xs-12" type="hidden"  >
                                        </td></tr>

                                    <tr><td  align="right"><label for="middle-name" class="control-label col-md-4 col-sm-4 col-xs-12">Username</label></td>
                                    <td> <input id="username" class="form-control col-md-7 col-xs-12" type="text" name="username" required="required"></td></tr>

                                    <tr><td  align="right"><label for="middle-name" class="control-label col-md-4 col-sm-4 col-xs-12">Password</label></td>
                                    <td> <input id="username" class="form-control col-md-7 col-xs-12" type="text" name="username" required="required"></td></tr>

                                    <tr><td  align="right"><label for="middle-name" class="control-label col-md-4 col-sm-4 col-xs-12">Passport</label></td>
                                    <td>  <img src="img/fade.gif" height="100" width="100" id="showimage" />
                          <input name="passport" id="passport" type="file" class="form-control col-md-7 col-xs-12"  onchange="readURL(this, $(this).attr('id'),  'showimage');"></td>
                                                          <p id="error2" style="display:none; color:#FF0000;">
                                    Maximum File Size Limit is 1MB.
                                    </p>
                                <div id="msg" ></div>
                                <div class="ln_solid"></div>
                                <div class="col-md-4 ">
                           
                          </div>
                          
                           <div class="col-md-4 hidden" id="photos">
                                    </td></tr>
                                    <tr><td  align="right"><button class="btn btn-primary" type="reset">Reset</button></td>
                                    <td>
                          <button type="submit" class="btn btn-success">Submit</button></td></tr>

                                        </table>
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