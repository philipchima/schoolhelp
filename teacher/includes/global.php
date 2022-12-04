<?php session_start(); ?>
<?php
		function checkin() {
				$pointerid=trim(isset($_GET['refno'])?$_GET['refno']:false);
				$tid=trim(isset($_SESSION["t_teacherlog".$pointerid])?$_SESSION["t_teacherlog".$pointerid]:false);
				return $tid;
			}
	
	function confirmcheckin() {
		if (!checkin()) {
			echo "
				<script language='javascript'>
					location.href='../siginin?stakeholder=3'
				</script>
			";
		}
	}
	?>