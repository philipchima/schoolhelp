<?php  require_once("includes/connection.php"); ?>
<?php
class studentRecord{
		
	public static function st_func($studentid, $fieldrequired){
	
$mysqli=connsetup::con();
$select_content2=("select * from students s INNER JOIN classes c on s.class=c.id INNER JOIN groups g on s.group_id=g.gid INNER JOIN studenttype st on s.type=st.tid where stid ='$studentid'");
$content_result2= mysqli_query($mysqli, $select_content2) or die (mysqli_error($mysqli));
$content2 = mysqli_fetch_assoc($content_result2);
$num_chk2 = mysqli_num_rows ($content_result2);


if($num_chk2 > 0){
							if($fieldrequired=="fullname"){
							return $content2["surname"]." ".$content2["othername"];
							}
							if($fieldrequired=="surname"){
							return $content2["surname"];
							}
							
							if($fieldrequired=="othername"){
							return $content2["othername"];
							}
							if($fieldrequired=="class"){
							return $content2["classname"];
							}
							if($fieldrequired=="group"){
							return $content2["groupname"];
							}
							if($fieldrequired=="groupid"){
							return $content2["group_id"];
							}
							if($fieldrequired=="classid"){
							return $content2["class"];
							}
							if($fieldrequired=="passport"){
							return $content2["passport"];
							}
							if($fieldrequired=="xdate"){
							return $content2["xdate"];
							}
							if($fieldrequired=="studenttype"){
							return $content2["stype"];
							}
							if($fieldrequired=="house"){
							return $content2["house"];
							}
							if($fieldrequired=="sex"){
							return $content2["sex"];
							}
							
							if($fieldrequired=="regno"){
							return $content2["regno"];
							}
							if($fieldrequired=="phone"){
							return $content2["phone"];
							}
							if($fieldrequired=="resident"){
							return $content2["residential"];
							}
							if($fieldrequired=="lga"){
							return $content2["lga"];
							}
							if($fieldrequired=="state"){
							return $content2["state"];
							}
							if($fieldrequired=="country"){
							return $content2["country"];
							}
							if($fieldrequired=="parent"){
							return $content2["parent"];
							}
							if($fieldrequired=="email"){
							return $content2["email"];
							}
							if($fieldrequired=="password"){
							return $content2["password"];
							}
							if($fieldrequired=="username"){
							return $content2["username"];
							}
							
						}else{ 
						
						echo "<script language='javascript'>
										location.href='../index'
									</script>";
						}

					}
						//This function retrieve Parent child's (student) information in parent module
						public static function st_funcp($studentid, $fieldrequired){
	
$mysqli=connsetup::con();
$pid =trim(isset($_SESSION['p_ustcode'])?$_SESSION['p_ustcode']:false);
$select_content2=("select * from students s INNER JOIN classes c on s.class=c.id INNER JOIN groups g on s.group_id=g.gid INNER JOIN studenttype st on s.type=st.tid where stid ='$studentid' and parent='$pid'");
$content_result2= mysqli_query($mysqli, $select_content2) or die (mysqli_error($mysqli));
$content2 = mysqli_fetch_assoc($content_result2);
$num_chk2 = mysqli_num_rows ($content_result2);


if($num_chk2 > 0){
							if($fieldrequired=="fullname"){
							return $content2["surname"]." ".$content2["othername"];
							}
							if($fieldrequired=="surname"){
							return $content2["surname"];
							}
							
							if($fieldrequired=="othername"){
							return $content2["othername"];
							}
							if($fieldrequired=="class"){
							return $content2["classname"];
							}
							if($fieldrequired=="group"){
							return $content2["groupname"];
							}
							if($fieldrequired=="groupid"){
							return $content2["group_id"];
							}
							if($fieldrequired=="classid"){
							return $content2["class"];
							}
							if($fieldrequired=="passport"){
							return $content2["passport"];
							}
							if($fieldrequired=="xdate"){
							return $content2["xdate"];
							}
							if($fieldrequired=="studenttype"){
							return $content2["stype"];
							}
							if($fieldrequired=="house"){
							return $content2["house"];
							}
							if($fieldrequired=="sex"){
							return $content2["sex"];
							}
							
							if($fieldrequired=="regno"){
							return $content2["regno"];
							}
							if($fieldrequired=="phone"){
							return $content2["phone"];
							}
							if($fieldrequired=="resident"){
							return $content2["residential"];
							}
							if($fieldrequired=="lga"){
							return $content2["lga"];
							}
							if($fieldrequired=="state"){
							return $content2["state"];
							}
							if($fieldrequired=="country"){
							return $content2["country"];
							}
							if($fieldrequired=="parent"){
							return $content2["parent"];
							}
							if($fieldrequired=="email"){
							return $content2["email"];
							}
							if($fieldrequired=="password"){
							return $content2["password"];
							}
							if($fieldrequired=="username"){
							return $content2["username"];
							}
							
						}else{ 
						
						echo "<script language='javascript'>
										location.href='../index'
									</script>";
						}
				                    
						
	}
	//Retrieving Student Class information
	public static function classestable_info($classid, $demands){
		$mysqli=connsetup::con();
		$class_query = $mysqli->query("SELECT * FROM classes WHERE id='$classid'");
		$class_rec=$class_query->fetch_assoc();
		$class_row=$class_query->num_rows;
		if($class_row>0){
			if($demands=="classname"){
				$class_id=$class_rec['classname'];
				return $class_id;
			}
			if($demands=="schoolid"){
				$school_id=$class_rec['schoolid'];
				return $school_id;
			}
		}else{return "-----";}
			$class_query->free();
			$mysqli->close();
	}
	//Retrieving Student group information
	public static function grouptable_info($groupid, $demands){
		$mysqli=connsetup::con();
		$group_query = $mysqli->query("SELECT * FROM groups WHERE gid='$groupid'");
		$group_rec=$group_query->fetch_assoc();
		$group_row=$group_query->num_rows;
		if($group_row>0){
			if($demands=="groupname"){
				$group_id=$group_rec['groupname'];
				return $group_id;
			}
		}else{return "-----";}
			$group_query->free();
			$mysqli->close();
	}
	
	//Retrieving Student house information
	public static function housetable_info($hid, $demands){
		$mysqli=connsetup::con();
		$house_query = $mysqli->query("SELECT * FROM houses WHERE hid='$hid'");
		$house_rec=$house_query->fetch_assoc();
		$house_row=$house_query->num_rows;
		if($house_row>0){
			if($demands=="house"){
				$house_id=$house_rec['house'];
				return $house_id;
			}
		}else{return "-----";}
			$house_query->free();
			$mysqli->close();
	}
	
	//Checking class teachers information
	
	public static function contentfunc($groupid, $classid, $ctdemand){
		$mysqli =connnsetup::con();
		  $content_result4=$mysqli->query("select * from class_teacher WHERE groupid='$groupid' and classid='$classid'")or die (mysqli_error($mysqli));
                                
                                $content4 = $content_result4->fetch_assoc();
                                $num_chk4 = $content_result4->num_rows ;
						if($num_chk4 > 0){
							if($ctdemand=="teacherid"){
							return $content4['teacherid'];
							}
							
							
						}
						
						$mysqli->close();
		}
}


class About_term_name{
	
	public static function curterm_name($demands){
		$mysqli=connsetup::con();
		$curterm_query = $mysqli->query("SELECT * FROM terms WHERE status=1 ");
		$curterm_rec=$curterm_query->fetch_assoc();
		$curterm_row=$curterm_query->num_rows;
		if($curterm_row>0){
			if($demands=="termid"){
				$curterm_id=$curterm_rec['tid'];
				return $curterm_id;
			}elseif($demands=="termname"){
			$curterm_name=$curterm_rec['term'];
			echo $curterm_name; 
			}
			
			}
			$curterm_query->free();
			$mysqli->close();
	}
	
	}
	
	//This class Collects Information about the session
class About_School_name{
	public static function cursess_name($demandsess){
		$mysqli=connsetup::con();
		$cursess_query=$mysqli->query("SELECT * FROM schsession WHERE status=1")or die(mysqli_error());
		$cursess_rec=$cursess_query->fetch_assoc();
		$cursess_row=$cursess_query->num_rows;
		if($cursess_row>0){
			
			if($demandsess=="sessid"){
				$cursess_id=$cursess_rec['sid'];
				return $cursess_id;
			}elseif($demandsess=="sessname"){
			$cursess_name=$cursess_rec['sesion'];
			echo $cursess_name; 
			} 
			}
			$cursess_query->free();
			$mysqli->close();
	}
	
	//Collects Info about the school
	public static function school($demandsess){
		$mysqli=connsetup::con();
		$school_query=$mysqli->query("SELECT * FROM school WHERE user=1")or die(mysqli_error());
		$school_rec=$school_query->fetch_assoc();
		$school_row=$school_query->num_rows;
		if($school_row>0){
			
			if($demandsess=="logo"){
				$school_logo=$school_rec['logo'];
				return $school_logo;
			}
			$school_query->free();
			$mysqli->close();
	}
	}


	}
	class Signatory{
		public static function signatoryposition($demand, $tablefield, $personid){
		$mysqli=connsetup::con();
		$select_content1=("select * from signatoryposition WHERE {$tablefield}='$personid'");
		$content_result1= mysqli_query($mysqli, $select_content1) or die (mysqli_error($mysqli));
		$content1 = mysqli_fetch_assoc($content_result1);
		$num_chk1 = mysqli_num_rows ($content_result1);
		if ($num_chk1>0) {
			
		if ($demand=='position') {
			return $content1["position1"];
		}
		}
	}
	}
?>