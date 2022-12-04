<?php
include("../schoolhelp/includes/connection.php");
include("phpclass/SHteacherupdate.php");
include("phpclass/SHteacherinserts.php");
include("../schoolhelp/phpclass/schoolhelpothers.php");

include("headernew.php");?>

<?php 

$refno=trim(isset($_GET['refno'])?$_GET['refno']:false);
          $page = trim(isset($_GET['page'])?$_GET['page']:false);
         $sql = trim(isset($_GET['sql'])?$_GET['sql']:false);
         
         $staffid=trim(isset($_SESSION["t_teacherlog".$refno])?$_SESSION["t_teacherlog".$refno]:false);

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
?>


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
                <!-- Page Heading -->
                
               
        <?php
	if ($page == "")
	{
		?>
        <div class="row">
				 <div class="col-md-11 col-lg-11 col-sm-11 col-xs-11 table-responsive" style="background:#063; margin:0% 2% 0% 4%; border-bottom:2px solid #8DFC6D; color:#FFF; border-radius:2px; -moz-border-radius:3px; -o-border-radius:3px; -webkit-border-radius:3px; -o-border-radius:3px; width:88%; height:35px; font-size:1.3em;">Staff Account Details
        </div>
        </div>
      	<div class="row">
        	<div class="col-md-10 col-lg-10 col-sm-10 col-xs-10" style="background:#FFF; margin:0% 2% 2%; padding:2%;">
            <table class="table table-striped table-bordered" style="width:100%;">
			<?php
             $instructorrecords=$SHteacher->allteacheredit('staff', 'staffid', $staffid);
             if (!is_array($instructorrecords)) {
            ?>
           
            ?>
                    <tr height="23" onMouseOut="this.style.backgroundColor='';" bgcolor="#EFEFEF">
                        <td colspan="5"  align="center">No Record Found</td>
                    </tr>	
			<?php
			}
				else
			{
                foreach($instructorrecords as $instructordata){

                    $titleid=trim($instructordata['titleid']);
                     $countryid=trim($instructordata['countryid']);
                     $stateid=trim($instructordata['stateid']);
                     $lgaid=trim($instructordata['lgaid']);
                      $qualificationid=trim($instructordata['qualification']);
                      $passport=trim($instructordata['passport']);


                    $sexid=trim($instructordata['sex']);
                    $stafftypename=Others::stafftypename($titleid);
                    $sexname=Others::sexname($sexid);

                    $titledata=$SHteacher->allteacheredit('title', 'titleid',  $titleid);
                                 if(is_array($titledata)){
                                    foreach($titledata as $titlerecord){
                                      $titlename=$titlerecord['titlename'];
                                      
                                    }

                                  }
                                  
                              //Country ID
                                    $countrydata=$SHteacher->allteacheredit('countries', 'id',  $countryid);
                                 if(is_array($countrydata)){
                                    foreach($countrydata as $countryrecord){
                                      $countryname=$countryrecord['name'];
                                      
                                    }

                                  }

                                   $statedata=$SHteacher->allteacheredit('states', 'id',  $stateid);
                                 if(is_array($statedata)){
                                    foreach($statedata as $staterecord){
                                      $statename=$staterecord['name'];
                                      
                                    }

                                  }

                                  //LGA ID
                                    $lgadata=$SHteacher->allteacheredit('lga', 'lgaid',  $lgaid);
                                 if(is_array($lgadata)){
                                    foreach($lgadata as $lgarecord){
                                      $lganame=$lgarecord['name'];
                                      
                                    }

                                  }


                                    $qualificationdata=$SHteacher->allteacheredit('qualification', 'qualificationid',  $qualificationid);
                                 if(is_array($qualificationdata)){
                                    foreach($qualificationdata as $qualificationrecord){
                                      $qualificationname=$qualificationrecord['qualificationname'];
                                      
                                    }

                                  }
			?>
            <tr><td >
             <table class="table" >
            <tr><td ><table class="table" ><tr><td style="width:60px;"><img src="../schoolhelp/images/uploads/staff/<?php if($instructordata['passport']==""){echo "user.png"; }else {echo $passport; }?>" height="100" width="100" style=" border:2px solid #060;"/></td><td align="left" valign="bottom"><table style="margin-top:40px" ><tr><td >Staff Information</td></tr></table></td></tr></table></td></tr>
            <tr><td ><table class="table" id="table1" style="margin:0px; width:100%">
            <tr><td align="right" >Title</td> <td><?php echo $titlename; ?></td></tr>
            <tr><td align="right" >Surname</td> <td><?php echo $instructordata['surname']; ?></td></tr>
            <tr><td align="right" >Othername</td> <td><?php echo $instructordata['othername']; ?></td></tr>
            <tr><td align="right" >Sex</td> <td><?php echo $sexname; ?></td></tr>
            <tr><td align="right">Staff Type</td> <td><?php echo ucfirst($stafftypename); ?></td></tr>
            <tr><td align="right">Residential Address</td><td><?php echo ucfirst($instructordata ['address']);?></td></tr>
            <tr><td  align="right">Phone</td><td><?php echo $instructordata['phone']; ?></td></tr>

            <tr><td  align="right">Employment Date</td><td><?php echo $instructordata['employdate']; ?></td></tr>
            </table></td></tr>
           
            
            <tr><td>Security Information</td></tr>
            <tr><td><table class="table table-bordered table-responsive table-striped" id="table1">
            
            <tr><td  align="right" width="40%">Email</td><td><?php echo $instructordata['email']; ?>&nbsp;&nbsp;
   
            <span style="color:#F00"></span></td></tr>
            <tr><td  align="right">Username</td><td><?php echo $instructordata['username']; ?></td></tr>
            <tr><td  align="right">Encrypted Password</td><td  align="left"><?php echo $instructordata['password']; ?></td></tr>
            
           
           </table>
           </td>
           </tr>
            <tr><td  align="center"><button class="btn btn-success"  onClick="if(confirm('Are You sure you want to change password')); relocate('<?php echo $staffid; ?>');" >Change Password</button></td></tr>
            <tr style="border: #090 dotted ; color:#F00; display:none"><td align="center" id='dis'></td></tr>
             
               <tr><td>Subjects Assigned</td></tr>
            <tr><td><table class="table table-bordered table-responsive " id="table1">
            <thead>
             <tr><th  align="right" width="10%">S/N</th><th  align="center" width="30%">Class</th><th align="right" width="30%">Group</th><th align="center" width="30%">Subject</th></tr>
             </thead>
             <tbody>
              <?php 
              $levelid="";
                     $optionid="";
                     $optionname="";
                     $levelname="";
                     $csname="";
                     $icourseid="";
                     $courseid="";
                     $u="";

        

          $teacherscourses=$SHteacher->allteacheredit('instructorcourses','staffid', $gid);
            if (is_array($teacherscourses)) {
                 $k=count($teacherscourses);
              foreach($teacherscourses as $teacherscoursesrec){
                $u+=1;
                $optionid=trim($teacherscoursesrec['optionid']);  
                $levelid=trim($teacherscoursesrec['levelid']); 
                $courseid=trim($teacherscoursesrec['courseid']); 

            //Getting the class information
            $teachersclass=$SHteacher->allteacheredit('level', 'levelid', $levelid);
            if (is_array($teachersclass)) {
              foreach($teachersclass as $teachersclassrec){
                $levelname=$teachersclassrec['levelname'];
                  }
              }
      
              //Getting the Group information
            $teachersgroup=$SHteacher->allteacheredit('optiontable','optid', $optionid);
            if (is_array($teachersgroup)) {
                foreach($teachersgroup as $teachersgrouprec){
                    $optionname=$teachersgrouprec['optname'];
              }
          }

        //Getting the Course information
        $teacherscourse=$SHteacher->allteacheredit('course','csid', $courseid);
            if (is_array($teacherscourse)) {
                foreach($teacherscourse as $teacherscourserec){
                    $csname=$teacherscourserec['csname'];
                    
              }
          }
         ?>
              <tr><td  align="center" width="10%"><?php echo $u; ?></td><td  align="center" width="30%"><?php echo $levelname; ?></td><td  width="30%"  align="center"><?php echo $optionname; ?></td><td width="30%"><?php echo $csname; ?></td></tr>
              <?php } 
            } ?>
            </tbody>
            
           </table>
           </td>
           </tr>
            
            
             
              <tr><td>Class Teacher of</td></tr>
             <tr><td><table class="table table-bordered table-responsive " id="table1">
            <thead>

             <tr><th  align="center" width="20%">S/N</th><th  align="center" width="40%">Class</th><th align="center" width="40%">Group</th></tr>
             </thead>
             <tbody>
              <?php 
                $levelid="";
                     $optionid="";
                     $optionname="";
                     $levelname="";
                     $csname="";
                     $icourseid="";
                     $courseid="";
                     $t="";
                     $u="";
      
            $teacherscourses=$SHteacher->allteacheredit('formteacher','staffid', $staffid);
            if (is_array($teacherscourses)) {
                 $k=count($teacherscourses);
              foreach($teacherscourses as $teacherscoursesrec){
                $u+=1;
                $optionid=trim($teacherscoursesrec['optionid']);  
                $levelid=trim($teacherscoursesrec['levelid']); 
                
                $tcid="";
                 $classteacher_status="";

                $teacherscourses=$SHteacher->allteacheredit3('instructorcourses','staffid', $staffid, 'levelid', $levelid, 'optionid', $optionid);
                                if (is_array($teacherscourses)) {
                                    foreach($teacherscourses as $teacherscoursesrec){
                                       
                                        $tcid=trim($teacherscoursesrec['icourseid']);
                                  }
                              }

                $teachersclass=$SHteacher->allteacheredit('level', 'levelid', $levelid);
            if (is_array($teachersclass)) {
              foreach($teachersclass as $teachersclassrec){
                $levelname=$teachersclassrec['levelname'];
                  }
              }
            
              //Getting the Group information
            $teachersgroup=$SHteacher->allteacheredit('optiontable','optid', $optionid);
            if (is_array($teachersgroup)) {
                foreach($teachersgroup as $teachersgrouprec){
                    $optionname=$teachersgrouprec['optname'];
              }
            }

            
              ?>
              <tr><td  align="center" width="20%"><?php echo $u; ?></td><td  align="center" width="40%"><?php echo $levelname; ?></td><td  width="40%"  align="center"><?php echo $optionname; ?></td></tr>
              <?php 
                }
              }
              ?>
            </tbody>
            
           </table>
           </td>
           </tr>
            
             </table></td></tr>
            <?php } 
        }?>
			 </table>
			             
            </div>
        </div>
       
        </div>
         <?php
		}
		?>
        
      
              
 <?php include("footernew.php");?>
 