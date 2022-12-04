<?php
		
		include_once("../schoolhelp/includes/connection.php");
		include_once("phpclass/SHteacherupdate.php");
		$refno=trim(isset($_GET['refno'])?$_GET['refno']:false);
		$tid =trim(isset($_SESSION["t_teacherlog".$refno])?$_SESSION["t_teacherlog".$refno]:false);
		// Four steps to closing a session
		// (i.e. logging out)

		// 1. Find the session
		session_start();
		////////////////////Time Logout
		$schoolhelpupdate=new updateTable;
		$udate = date("Y-m-d H:i:s");
		$loginupdate=$schoolhelpupdate->update_all('staff','staffid', $tid, 'logouttime', $udate);
		
		//exit;
		
		// 2. Unset all the session variables
		$_SESSION = array();
		
		// 3. Destroy the session cookie
		if(isset($_COOKIE[session_name()])) {
			setcookie(session_name(), '', time()-42000, '/');
		}
		
		// 4. Destroy the session
		session_destroy();
		
		
		echo "
			<script language='javascript'>
				location.href='../index.php'
			</script>
		";
?>