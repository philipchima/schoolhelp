<?php
require_once("../includes/session.php"); 
require_once("../connection.php");
$page=(isset($_GET['page'])?$_GET['page']:false);
$sql1=(isset($_GET['sql1'])?$_GET['sql1']:false);
$refno=(isset($_GET['refno'])?$_GET['refno']:false);
$action=(isset($_GET['action'])?$_GET['action']:false);
$pg=$_GET['pg'];
if($page=="attendancenew"){
	echo "
				<script language='javascript'>
					location.href='attendancenew.php?&sql1=$sql1&refno=$refno&page=$page'
				</script>
			";
	}
?>