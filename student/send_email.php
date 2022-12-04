<?php
require_once 'includes/connection.php';
	 date_default_timezone_set("Africa/Lagos");
	 
	 
	//Collecting of variable Information		
		//$action=(isset($_POST['action'])?$_POST['action']:false);
		
		
		$userid=(isset($_POST['userid'])?$_POST['userid']:false);
		
       $istname=(isset($_POST['istname'])?$_POST['istname']:false); 
        $surname=(isset($_POST['surname'])?$_POST['surname']:false); 
		$email = (isset($_POST['toemail'])?$_POST['toemail']:false);
		$fromemail = (isset($_POST['fromemail'])?$_POST['fromemail']:false);
		
		if(isset($email) && !empty($email) AND isset($fromemail) && !empty($fromemail)){

		$to      = $email; // Send email to our user
		$subject = 'Verification of Account'; // Give the email a subject 
		$message = '
		 
		Welcome '.$surname.'' .$istname.'!
		
		Sorry for this delay, observed during this process.
		We really want to confirm the authenticity of this account to 
		avoid account hijacking. 
		
		Thanks
		 
		
		Please click this link to Change Your Password:
		http://www.schoolhelp.com/studentchangepassword.php?refno=$userid&pg=2
		 
		'; // Our message above including the link
							 
		$headers = $fromemail . "\r\n"; // Set from headers
		mail($to, $subject, $message, $headers); // Send our email
		
				
		}else{
			echo "Email invalid or not provided";
			}
		
		?>