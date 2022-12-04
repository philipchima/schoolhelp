				<?php session_start(); 
				require_once ("../schoolhelp/includes/connection.php");
				include_once("phpclass/SHteacherOOP.php");
				$conn= new Dbh;
				$mysqli = $conn->connect();

				$SHteacher=new classTeacher;
				$item_per_page=10;
				
				$staffid=(isset($_GET['staffid'])?$_GET['staffid']:false);
				$classinfo=(isset($_GET['classinfo'])?$_GET['classinfo']:false);
				
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
				
				if(isset($_POST["page"])?$_POST["page"]:false){
				$page_number = (filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH));
				if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
					}else{
						$page_number = 1;
					}
				?>
                
                <div style="width:80%; height:auto; text-align:left; margin-top:10px; margin-left:auto; margin-right:auto" class="table" >
             
              
                
                <?php
				
			 	 $teacherscourses=$SHteacher->allteacheredit('instructorcourses','icourseid', $classinfo);
		            if (is_array($teacherscourses)) {
		                 foreach($teacherscourses as $teacherscoursesrec){
		                 $optionid=trim($teacherscoursesrec['optionid']);  

		                 $levelid=trim($teacherscoursesrec['levelid']); 
		                 $courseid=trim($teacherscoursesrec['courseid']);
		                 $scoredeptid=trim($teacherscoursesrec['departmentid']);
				        }
				    }

				$position = (($page_number-1) * $item_per_page);
				$query_qQues="SELECT * FROM coursematerials s INNER JOIN instructorcourses c ON s.levelid = c.icourseid INNER JOIN optiontable g ON s.optionid = g.optid INNER JOIN course st ON s.courseid = st.csid WHERE s.levelid='$levelid' and s.optionid='$optionid' and s.courseid='$courseid' and s.semesterid='$semesterid' and s.sessionid='$sessionid' and instructorid=:staffid ORDER BY cm_id DESC LIMIT $position, $item_per_page";
				
                //$content_qQues =$query_qQues->fetch_assoc();
				 $stmt = $mysqli->prepare($query_qQues);
							$stmt->execute([':staffid'=>$staffid]);
								if($stmt->rowCount()){ ?>
				 <table  border="1" style="width:100%; margin-left:auto; margin-right:auto; border-color:#060" class="table table-responsive table-hover">
                <tr  align="center"><td colspan="7" style="background:#060; color:#FFF"><b style="font-family:tahoma">Class Material</b></td></tr>
                <tr  align="center" style="background:#090; color:#FFF"><th width="1">S/N</th><th >Topic</th><th >Detail</th><th >Material</th><th >Date</th><th>Action</th></tr>

				<?php 

									while($row=$stmt->fetch()){	  
					$k+=1;
                $topic = $row['topic'];
                $details = $row['materialdetails'];
                $dlink = $row['dlink'];
                $sdate = $row['sdate']; 
                ?>
                
                <tr <?php if($k%2==0){ ?> bgcolor="#CCFFFF" <?php }?> ><td><?php echo $k; ?></td><td><?php echo $topic; ?></td><td><?php echo $details ; ?></td><td align="center"> <a target="new" id="#embedURL" class="embed" href="../schoolhelp/uploads/classmaterial/<?php echo $dlink;?>">Preview <span class="glyphicon glyphicon-arrow-right"></span><?php echo $dlink;?></a></td><td><?php echo $sdate; ?></td><td><table style="width:100%"><tr><td><input style="width:100%; height:30px; background-color:#060; border-color:#060; color:#FFF " type="submit" onClick="pratical('edit','<?php echo $content_qQues['cm_id']; ?>','<?php echo $topic; ?>','<?php echo $details; ?>','<?php echo $dlink; ?>');" name="submit" value="Edit"/></td><td><input style="width:100%; height:30px; background-color:#060; border-color:#060; color:#FFF " type="submit" onClick="callCrudAction('delete', '<?php echo $content_qQues['cm_id']; ?>','','','','<?php echo $dlink; ?>');" name="submit" value="Delete"/></td></tr></table></td></tr>
                 </table>
                <?php 
				
                }
				}
				else{?>
				<table style="width:100%;">
				<tr><td style="font-size:20px; text-align:center; color:red">No Record Found</td></tr>
				 <tr><td><input style="width:100%; height:30px; background-color:#060; border-color:#060; color:#FFF " type="submit" onClick="pratical('add','','','','');"  name="submit" value="Add Question" /></td></tr>
				</table>
				<?php }
                ?>
             
                
                </div>
                 