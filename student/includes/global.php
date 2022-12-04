<?php session_start(); ?>
<?php
		function checkin() {
				$pointerid=trim(isset($_GET['refno'])?$_GET['refno']:false);
				$tid=trim(isset($_SESSION['stid'.$pointerid])?$_SESSION['stid'.$pointerid]:false);
				return $tid;
			}
	
	function confirmcheckin() {
		if (!checkin()) {
			echo "
				<script language='javascript'>
					location.href='../siginin?stakeholder=2'
				</script>
			";
		}
	}
	?>