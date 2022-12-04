<?php 
include("../schoolhelp/includes/connection.php");
include("headernew.php");
include_once("../schoolhelp/phpclass/schoolhelpothers.php");

		 // Variable for collection of data
		 $refno=(isset($_GET['refno'])?$_GET['refno']:false);
		$tid=(isset($_SESSION["t_teacherlog".$refno])?$_SESSION["t_teacherlog".$refno]:false);
		 $levelid = (isset($_GET["class_id"])?$_GET["class_id"]:false);
		 $optionid=(isset($_GET['gid'])?$_GET['gid']:false);
		 $page = trim(isset($_GET['page'])?$_GET['page']:false);
		 
		 $sql = (isset($_GET['sql'])?$_GET['sql']:false);
		
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
                            <i class="fa fa-info-circle"></i>  <strong>Hi!</strong> <span style="font:20px Corbel bold; color:#060; "><?php echo trim(isset($_SESSION["t_fullname".$tid])?$_SESSION["t_fullname".$tid]:false); ?> </span><span style="color:#FEA318;">Note that your operations is only strictly on </span><span style="font:20px Corbel  bold; color:#F00; "><?php echo $semestername; echo " ";?>Term of <?php echo $sessionname; ?>Session </span>
                        </div>
                        <div><h3 style="color:green"><?php echo $sql; ?></h3></div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- Page Heading -->
                
               
        <?php
	if ($page == "")
	{
		?>
        <div class="row">
				 <div class="col-md-11 col-lg-11 col-sm-11 col-xs-11 table-responsive" style="background:#063; margin:0% 2% 0% 4%; border-bottom:2px solid #8DFC6D; color:#FFF; border-radius:2px; -moz-border-radius:3px; -o-border-radius:3px; -webkit-border-radius:3px; -o-border-radius:3px; width:88%; height:35px; font-size:1.3em;">Students Account Details
        </div>
        </div>
      	<div class="row">
        	<div class="col-md-11 col-lg-11 col-sm-11 col-xs-11" style="background:#FFF; margin:0% 2% 2%; padding:2%;">
            <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
			<?php
            $studentdata=$SHteacher->allteacheredit4('students', 'levelid', $levelid, 'optid', $optionid, 'status', 0, 'access', 0);
              /* $content_result=$mysqli->query("SELECT * FROM students s INNER JOIN classes c ON s.class = c.id INNER JOIN groups g ON s.group_id = g.gid INNER JOIN studenttype st ON s.type = st.tid WHERE s.class='$classid' and group_id='$groupid' and status!='3' ORDER BY surname ASC");
                $content =$content_result->fetch_assoc();
                $num_chk = $content_result->num_rows; */
                $k = 0
            ?>
            <?php
            if (!is_array($studentdata))
                {
            ?>
                    <tr height="23" onMouseOut="this.style.backgroundColor='';" bgcolor="#EFEFEF">
                        <td colspan="5"  align="center">No Record Found</td>
                    </tr>	
			<?php
			}
				else
			{

			?>
                <thead>
                    <tr style="background:#79FE72">
                        <th align="center">S/N</th>
                        <th align="center">Reg No</th>
                        <th align="center">Student Name</th>
                        <th align="center">Level/Class</th>
                        <th align="center">Group</th>
                        <th align="center">Gender</th>
                        <th align="center">Type</th>
                        <th align="center">View</th>
                  </tr>
            	</thead>
            <tbody>
			<?php  $x=0;
				foreach($studentdata as $studentrecord) { 
				$color = "#f5f5f5";
				
				$x=$x+1;
                 $sexname=Others::sexname($studentrecord['sexid']);
				 $studenttypename=Others::studenttypename($studentrecord['studenttype']);
					if($x%2 == 0)
						{
							$color = "#ffffff";
						}
						
				$k = $k + 1;
			?>
                <tr bgcolor="<?php echo $color ?>"  height="23">
                
                    <td align="center"><?php echo $k  ?></td>
                    <td align="center"><?php  echo ucfirst($studentrecord['regno'])?></td>
                    <td align="left"><?php  echo $studentrecord['surname']." ". $studentrecord['othername']?></td>
                    <td align="center"><?php  echo ucfirst($levelname)?></td>
                    <td align="center"><?php  echo ucfirst($optionname)?></td>
                    <td align="center"><?php  echo ucfirst($sexname)?></td>
                    <td align="center"><?php echo $studenttypename; ?></td>
                                                                      
                    <td  width="8%" align="center"><a href="studentnew?refno=<?php echo $tid; ?>&id=<?php  echo trim($studentrecord['stid']); ?>&page=2&search=<?php  echo ucfirst($studentrecord['regno']); ?>" target="_parent"><i class="fa fa-search"></i></a> </td>
                </tr>
				<?php } ?>
			<?php 
				}
			?>
			</tbody>
			</table>             
            </div>
        </div>
         <?php
		}
		?>
        
        <?php
	if ($page == 2)
	{
        $id=trim(isset($_GET['id'])?$_GET['id']:false);
        //Retrival Of student Information
        $studentdata1=$SHteacher->allteacheredit('students','stid', $id);
            if (is_array($studentdata1)) {
                foreach($studentdata1 as $fieldrecord){
                   
                     $sfullname=trim($fieldrecord['surname'].' '.$fieldrecord['othername']);
                     $hdid=trim($fieldrecord['housedivisionid']);
                     $sexname=Others::sexname($fieldrecord['sexid']);
                     $stateid=trim($fieldrecord['stateid']);
                     $countryid=$stateid=trim($fieldrecord['countryid']);
                     $lgaid=trim($fieldrecord['lgaid']);
                     $passport=trim($fieldrecord['passport']);

                    //getting level name
                    $levelid= trim($fieldrecord['levelid']);
                    $optid=trim($fieldrecord['optid']);
                    $guardianid=trim($fieldrecord['guardianid']);
                    
                    $studenttype=trim($fieldrecord['studenttype']);
                    $studenttypename=Others::studenttypename($fieldrecord['studenttype']);

                    $levelobject=$SHteacher->allteacheredit('level', 'levelid',  $levelid);
                                if(is_array($levelobject)){
                                foreach($levelobject as $levelrecord){
                                  $levelname=$levelrecord['levelname'];
                                  }
                                }
                              
                                //getting Option name
                               $optid= $fieldrecord['optid'];
                              
                                   $optionobject=$SHteacher->allteacheredit('optiontable', 'optid',  $optid);
                                   if(is_array($optionobject)){
                                      foreach($optionobject as $optionrecord){
                                        $optionname=$optionrecord['optname'];
                                        
                                     }
                                    }
                              
                                   $hddata=$SHteacher->allteacheredit('housedivision', 'hdid',  $hdid);
                                 if(is_array($hddata)){
                                    foreach($hddata as $hdrecord){
                                      $hdname=$hdrecord['hdname'];
                                      
                                    }

                                  }

                                    $statedata=$SHteacher->allteacheredit('states', 'id',  $stateid);
                                 if(is_array($statedata)){
                                    foreach($statedata as $staterecord){
                                      $statename=$staterecord['name'];
                                      
                                    }
                                  }
                                       $lgadata=$SHteacher->allteacheredit('lga', 'lgaid',  $lgaid);
                                 if(is_array($lgadata)){
                                    foreach($lgadata as $lgarecord){
                                      $lganame=$lgarecord['name'];
                                      
                                    }
                                  }

                                        $countrydata=$SHteacher->allteacheredit('countries', 'id',  $countryid);
                                 if(is_array($countrydata)){
                                    foreach($countrydata as $countryrecord){
                                      $countryname=$countryrecord['name'];
                                      
                                    }
                                }
                                  
              }
          }
		?>

      	<div class="row">
        	<div class="col-md-11.8 table-responsive" style="padding-top:2%; margin:0% 5% 2%; border:2px solid #060;" >
            <table class="table " style="background:#FFF;"> 
            <tr><td>
             <table class="table" >
            <tr><td ><table class="table" ><tr><td style="width:60px;"><img src="../schoolhelp/images/uploads/student/<?php if($passport==""){echo "user.png"; }else {echo $passport; }?>" height="100" width="100" style=" border:2px solid #060;"/></td><td align="left" valign="bottom"><table style="margin-top:40px" ><tr><td >Student Information</td></tr></table></td></tr></table></td></tr>
            <tr><td style="width:40%;"><table class="table" id="table1" style="margin:0px"><tr><td align="right" >Name</td> <td><?php echo $sfullname; ?></td></tr>
            <tr><td align="right">Level/Class</td> <td><?php echo $levelname; ?></td></tr>
            <tr><td align="right">Option/Arm</td><td><?php echo $optionname ?></td></tr>
            <tr><td  align="right">Student Type</td><td><?php echo $studenttypename; ?></td></tr>
            <tr><td align="right">House</td><td><?php echo $hdname; ?></td></tr></table></td></tr>
            </table>
            </td></tr>
            <tr><td>
            <?php
					
				?>
             <table class="table"><?php     
                 $guardianrecords=$SHteacher->allteacheredit('guardian', 'gid', $guardianid);
                if (is_array($guardianrecords)) {
                foreach($guardianrecords as $guardianrecord){ 
                    $titleid=trim($guardianrecord['titleid']);
                     $passport1=trim($guardianrecord['passport']);
                     $titlename="";
                  $titledata=$SHteacher->allteacheredit('title', 'titleid',  $titleid);
                                 if(is_array($titledata)){
                                    foreach($titledata as $titlerecord){
                                      $titlename=$titlerecord['titlename'];
                                      
                                    }

                                  }
                                  ?>
             <tr><td><table class="table"><tr><td style="width:60px;"><img src="../schoolhelp/images/uploads/guardian/<?php if($passport1==""){echo "user.png"; }else {echo $passport1; } ?>" height="100" width="100" style=" border:2px solid #060; "/></td><td align="left"><table style="margin-top:40px;"><tr><td >Parent's Information</td></tr></table></td></tr></table></td></tr>
            <tr><td><table class="table" id="table1">
                

            <tr><td align="right" style="width:40%;">Fullname</td><td><?php echo $titlename.". ".$guardianrecord["surname"]." ".$guardianrecord["othername"]; ?></td></tr>
            <tr><td align="right">Address</td><td><?php echo $guardianrecord["address"] ?></td></tr>
             <tr><td align="right">Email</td><td><?php echo $guardianrecord["email"] ?></td></tr>
              <tr><td align="right">Phone No</td><td><?php echo $guardianrecord["phone"] ?></td></tr>
                                 
                <?php       }
                      }else{
                      ?>
            <tr><td >Guardian Record not Uploaded Yet!</td></tr>
            <?php } ?>
              </table>
              </td></tr>
            </table>
            </td></tr>
            </table>
            
         </div>
            
            
        </div>
        </div>
         <?php
		}
		?>
        
      
              
 <?php include("footernew.php");?>
 
 