
<?php

/*==================================================================
====  This page is full of classes that will help us display =======
====  content of a particular table ===============================*/
 include_once("connection.php");
//teacherstable: collection of information from mentioned table
	class Teachersclass{
		
	public static function tc_func($tcinfo, $teacherid, $ctdemand){
		$mysqli = connnsetup::con();
		  $content_result4=$mysqli->query("select * from teacherclasses WHERE tcid='$tcinfo' and teacherid='$teacherid'")or die ($mysqli->error());
                                
                        $content4 = $content_result4->fetch_assoc();
                        $num_chk4 = $content_result4->num_rows ;
						if($num_chk4 > 0){
							if($ctdemand=="groupid"){
							return $content4["groupid"];
							}
							if($ctdemand=="classid"){
							return $content4["classid"];
							}
							if($ctdemand=="subjectid"){
							return $content4["subjectid"];
							}
						}else{ echo "<script language='javascript'>
										location.href='../index'
									</script>";
						}
				                    
						$content4->free();
						$mysqli->close();
		}
		
		//Retrieving Subjects Assigned to Teacher
		public static function assignedsubject($teacherid){
		$mysqli = connnsetup::con();
		  $assignedsubject=$mysqli->query("select * from teacherclasses t INNER JOIN classes c ON t.classid = c.id  INNER JOIN groups g ON t.groupid = g.gid INNER JOIN subjects sj ON t.subjectid = sj.sid WHERE teacherid='$teacherid'")or die ($mysqli->error());
                         $content_subjects = $assignedsubject->fetch_assoc();     
                        $num_subjects = $assignedsubject->num_rows ;
						if($num_subjects > 0){
							$x=0;
							do {
								$x+=1;
								$classname=$content_subjects['classname'];
								$groupname=$content_subjects['groupname'];
								$subjectname=$content_subjects['subject'];
								echo "<tr><td align='right' width='10%'>$x</td><td  align='center' width='30%'>$classname</td><td align='center' width='30%'>$groupname</td><td align='center' width='30%'>$subjectname</td></tr>";
								} while($content_subjects = $assignedsubject->fetch_assoc());
						}else{ echo "</table></td></tr><tr><td  align='center' width='100%' >Subject Not Assigned</td></tr>";
						}
				                    
						$assignedsubject->free();
						$mysqli->close();
		}
		
		//Retrieving Classes that the Teacher is the class Teacher
		public static function assignedclasses($teacherid){
		$mysqli = connnsetup::con();
		  $assignedclass=$mysqli->query("select * from class_teacher t INNER JOIN classes c ON t.classid = c.id  INNER JOIN groups g ON t.groupid = g.gid  WHERE t.teacherid='$teacherid'")or die ($mysqli->error());
                         $content_class = $assignedclass->fetch_assoc();     
                        $num_class = $assignedclass->num_rows ;
						if($num_class > 0){
							$x=0;
							do {
								$x+=1;
								$classname=$content_class['classname'];
								$groupname=$content_class['groupname'];
								$signature=$content_class['signature'];
								echo "<tr><td align='right' width='10%'>$x</td><td  align='center' width='30%'>$classname</td><td align='center' width='30%'>$groupname</td><td align='center' style='width:100%; height:100%' ><img src='../backend/uploads/signatures/$signature'/></td></tr>";
								} while($content_class = $assignedclass->fetch_assoc());
						}else{ echo "</table></td></tr><tr><td  align='center' width='100%'>You are not Assigned as a Class Teacher Yet</td></tr>";
						}
				                    
						$assignedclass->free();
						$mysqli->close();
		}
		
	
		
	}//end of class
	
	

//Class Information
class Classesinfo{
	public static function classes_func($classid, $demand){
		$mysqli = connnsetup::con();
		  $content_result=$mysqli->query("select * from classes WHERE id='$classid'")or die ($mysqli->error());
                                
                                $content=$content_result->fetch_assoc();
                                $num_chk = $content_result->num_rows ;
						if($num_chk > 0){
							if($demand=="schoolid"){
							return $content['schoolid'];
							}
							if($demand=="schoolname"){
							return $content['classid'];
							}
							if($demand=="classname"){
							return $content['classname'];
							}
						}
						$content->free();
						$mysqli->close();
		}
	}


//Collect Subject teacher Information
class teacherinfo{
	public static function teacher($tcid, $request){
		$mysqli = connnsetup::con();
		
		$teacherquery=$mysqli->query("SELECT * FROM teachers WHERE gid='$tcid'"); 
						$teacherresult=$teacherquery->fetch_assoc();
						$teacherrow=$teacherquery->num_rows;
						if($teacherrow > 0){
							if($request=='names'){
							echo  $teacherresult['surname'] . " " . $teacherresult['othername']. " (Teacher)" ;
							}
						}
						$teacherquery->free();
						$mysqli->close();
		}
	}

//Collect Admin Information
class admininfo{
	public static function admin($adminid, $request){
		$mysqli = connnsetup::con();
		$admin_query=$mysqli->query("SELECT * FROM systemusers WHERE id='$adminid'"); 
						$adminresult=$admin_query->fetch_assoc();
						$admin_row=$admin_query->num_rows;
						if($admin_row > 0){
							if($request=="names"){
							echo $adminresult['surname'] . " " . $adminresult['fname'];
							}
						}else{ echo "No Approved Person yet or Record Moved";}
						$admin_query->free();
						$mysqli->close();
		}
	}


class Date_Selected{
	public static function seldate($mdate){
			if($mdate=="yyyy-MM-dd" or $mdate=="" ){
			$mdate=date("Y-m-d");
			return $mdate;
			} else{
				$mdate=date("Y-m-d");
				return $mdate;
				}
		}
		
		public static function termperiod($termid, $sessid, $request){
		$mysqli = connnsetup::con();
		$date_query=$mysqli->query("SELECT * FROM term_ending_date WHERE termid='$termid' and sessionid='$sessid'"); 
						$dateresult=$date_query->fetch_assoc();
						$date_row=$date_query->num_rows;
						if($date_row > 0){
							if($request=="startdate"){
							return $mdate=date('Y-m-d',strtotime($dateresult['begins']));
							}
							if($request=="enddate"){
							return $mdate=date('Y-m-d',strtotime($dateresult['ends']));
							
							}
						}else{ return 0;}
						$date_query->free();
						$mysqli->close();
		}
		
	
	}
	
class Class_Selected{
	
	
	}

?>