<?php
include_once ("schoolhelp/includes/global.php"); 
include_once("phpclass/schoolhsignoop.php");
include_once("phpclass/schoolhsignupdate.php");

include_once "schoolhelp/phpclass/schoolhelpothers.php"; 
$schoolhelp= new AllSignins;
$schoolhelpupdate= new updateTable;
$activationtbl=$schoolhelp->allsigninedit('cpanelactivations','titlename','Pin');
if (is_array($activationtbl)) {
  foreach($activationtbl as $activationrec){
   $signinstatus=$activationrec['status'];
  }
}

$odate=date("Y-m-d");
$udate=date("Y-m-d H:m:s");
$sql="";
?>

<?php
$stakeholder=trim(isset($_POST['stakeholder'])?$_POST['stakeholder']:false);
$username=trim(isset($_POST['username'])?$_POST['username']:false);
$password=trim(isset($_POST['password'])?$_POST['password']:false);

if(isset($stakeholder, $username, $password)){
	//converting the password
	$passkey = Others::passwordconvert($password);
	
	if (($signinstatus==1) and ($stakeholder==1 or $stakeholder==2)) {
		//pin detials
		$pincodetbl=$schoolhelp->allsigninedit('pingenerate','pincode',$password);
				if (is_array($pincodetbl)) {
				  foreach($pincodetbl as $pinmethod){
					$pinstatus=trim($pinmethod['status']);
					$pinid=trim($pinmethod['pinid']);
					$pinschoolid=trim($pinmethod['schoolid']);
					$pinno_days=trim($pinmethod['duration']);
					$pinexpirydate=trim($pinmethod['expirydate']);
					$pinstid=trim($pinmethod['stid']);
				  }
				}
	

		//Student Details
				$studenttbl=$schoolhelp->allsigninedit('students','regno',$username);
				if (is_array($studenttbl)) {
				  foreach($studenttbl as $studentrec){
		echo " ". $studentid=trim($studentrec['stid']);
		echo " ". $parentid=trim($studentrec['parent']);
						}
					}
		
		if ($odate>$pinexpirydate or $pinstatus==2) {
			$sql="This card has expired";	
			$pinupdate=$schoolhelpupdate->update_all('pingenerate', 'status', 2, 'pinid', $pinid);
			
		}
		else if ($studentid=="") {
			$sql="Student Registration No not found in database";
		}
		else if ($pinid=="") {
			$sql="Check your pin and type exactly the way it written";
		}
		else if ($pinstid!="" and $studentid!=$pinstid) {
			$sql="This Card is already in use by another";
		}else{
			$pinupdate=$schoolhelpupdate->update_all('pingenerate', 'stid', $studentid, 'pinid', $pinid);
		}
		
		if ($sql!="") {
			echo "
				<script language='javascript'>
					location.href='signin?stakeholder=$stakeholder&sql=$sql';
				</script>
			";
		}
			
	}

	if($stakeholder == 1){

		if ($signinstatus==1) {
			$_SESSION["studentid"]=$studentid;
			$_SESSION["p_schoolhelp"] = $parentid;
			 echo "<script type='text/javascript'>
				 location.href='parent/index';
			 </script>"; 
		}
		else{
		

			$guardiantbl=$schoolhelp->allsigninedit2('guardian','username',$username,'password',$passkey);
				if (is_array($guardiantbl)) {
				  foreach($guardiantbl as $guardianrec){
					 $_SESSION["p_schoolhelp"] = $guardianrec['gid'];
					 $_SESSION["p_username"] = $guardianrec['username'];
					 $gid=$guardianrec['gid'];
					}

					$loginupdate=$schoolhelpupdate->update_all('guardian','gid', $gid, 'logintime', $udate);
			 echo "<script type='text/javascript'>
				 location.href='parent/index';
			 </script>"; 
		 }
		 else{

			 echo "<script type='text/javascript'>
				 location.href='signin?stakeholder=$stakeholder&pg=1&state=1';
			 </script>"; 
		}
		

		}
	}
	else if($stakeholder == 3){
		$expirydate="";
				/*     ADMINISTRATIVE LOGIN SCRIPT STARTING POINT     */
				  $records=$schoolhelp->allsignin('subscription','subsid','ASC');
                              if (is_array($records)) {
                              foreach($records as $fieldrecord){
                              	$subdate=$fieldrecord['subdate'];
                              	$expirydate=trim($fieldrecord['expirydate']);
                              }
                          }
				
				
				$odate = date("Y-m-d");
				
				if($expirydate <= $odate){
					echo "
						<script language='javascript'>
						alert('Your subscription has Expired; Contact Your vendor')
							location.href='signin?stakeholder=$stakeholder'
						</script>
					";
				}
				
				// Checking whetter login has been made before
				
				//Student Details
				$adminpersontbl=$schoolhelp->allsigninedit2('adminpersons','username',$username,'password',$passkey);
				if (is_array($adminpersontbl)) {
				  foreach($adminpersontbl as $adminpersonrec){
						//$status=$adminpersonrec['status'];
						$system1=trim($adminpersonrec ['adminid']);
						$_SESSION['schoolhelp'.$system1] = $adminpersonrec['adminid'];
						}

							$loginupdate=$schoolhelpupdate->update_all('adminpersons', 'logintime', $udate, 'adminid', $system1);
							echo "
								<script language='javascript'>
									location.href='schoolhelp/?schoolhelp=$system1'
								</script>
							";
							
							}
						else 
							{
							echo "
								<script language='javascript'>
								alert('Invalid username or password try again, you may lucky this time')
									location.href='signin?stakeholder=$stakeholder'
								</script>
							";
							
					
				}
				//===ADMIN LOGIN SCRIPT STOPPAGE===//
	}
	else if($stakeholder == 4){
		
			$teachertbl=$schoolhelp->allsigninedit2('staff','username',$username,'password',$passkey);
				if (is_array($teachertbl)) {
				  foreach($teachertbl as $teacherrec){
						$access=trim($teacherrec['access']);
						$staffid=trim($teacherrec['staffid']);
						$surname=trim($teacherrec['surname']);
						$othername=trim($teacherrec['othername']);
						$_SESSION["t_teacherlog".$staffid] = $staffid;
						$_SESSION["t_fullname".$staffid] = $surname.' '.$othername;
						
					}

					if ($access==0) {
							echo "
									<script language='javascript'>
										location.href='teacher/index.php?refno=$staffid';
									</script>
								";
					}
					else{

							echo "<script language='javascript'>
								alert('You have disabled from logging in. Please contact the admin')
									location.href='signin?stakeholder=$stakeholder&pg=1&state=1';
								</script>
							";
					}
			
		}
		else
		{	
			echo "
				<script language='javascript'>
					location.href='signin?stakeholder=$stakeholder&pg=1&state=1';
				</script>
			";
		}
	}
	else if($stakeholder == 2){
		//Selecting Actually what to login with
		if ($signinstatus==1) {

			$refno=$studentid;
			$_SESSION['stid'.$refno]= $studentid;
			
			echo "
				<script language='javascript'>
					location.href='student/dashboard?refno=$refno';
				</script>
			";
		} 
		//logging with username and password
		else{

		$studentstbl=$schoolhelp->allsigninedit2('students','username',$username,'password',$passkey);
				if (is_array($studentstbl)) {
				  foreach($studentstbl as $studentsrec){
						$access=trim($studentsrec['access']);
						$student=trim($studentsrec['stid']);
						$_SESSION["stid".$student] = $student;
					}

						if ($access == 0)
						{
							echo "
								<script language='javascript'>
									location.href='student/dashboard?refno=$student';
								</script>
							";
							
						}

						else
							{	
								echo "
									<script language='javascript'>
									alert('You have been de-activated from logining in contact the admin')
										location.href='signin?stakeholder=$stakeholder';
									</script>
								";
							}	
				}
					else
							{	
								echo "
									<script language='javascript'>
										location.href='signin?stakeholder=$stakeholder&pg=1&state=1';
									</script>
								";
							}	

	}//Login Selection End

	}//ending student login
}else { echo "God will help you";}
?>