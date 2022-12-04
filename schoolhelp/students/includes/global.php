<?php session_start();
?>
<?php
		function checkin() {
				$admin=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
				$schoolhelp=trim(isset($_SESSION['schoolhelp'.$admin])?$_SESSION['schoolhelp'.$admin]:false);
				return $schoolhelp;
			}
	
	function confirmcheckin() {
		if (!checkin()) {
			echo "
				<script language='javascript'>
					location.href='../../siginin?stakeholder=3'
				</script>
			";
		}
	}
	?>