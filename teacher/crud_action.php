<?php
include("../schoolhelp/includes/connection.php");
include("phpclass/SHteacherinserts.php");
include("phpclass/SHteacherupdate.php");

$teachersinsert=new insertTable;
$schoolhelpupdate=new updateTable;

$udate=date("Y-m-d H:i:s");
$odate=date("Y-m-d");
	$action=(isset($_POST["action"])?$_POST["action"]:false);
	if($action!="delete"){
		$file_name = $_FILES['fileInput']['name'];
		if($_FILES['fileInput']['name']){
				$errors= array();
				$file_name = $_FILES['fileInput']['name'];
				 $file_size =$_FILES['fileInput']['size'];
				 $file_tmp =$_FILES['fileInput']['tmp_name'];
				$file_type=$_FILES['fileInput']['type'];   
				$file_ext = strtolower(strrchr($file_name, "."));
						
				$expensions= array("jpg","jpeg","gif","png","ico"); 		
				//if(in_array($file_ext,$expensions)=== false){
				//	$errors[]="extension not allowed, please choose a JPEG or PNG file.";
				//}
				if($file_size >100097152){
				$errors[]='File size must be excately 20 MB';
				}				
				if(empty($errors)==true){
					move_uploaded_file($file_tmp,"../schoolhelp/uploads/cbtquesimage/".round(microtime(true)).$file_name);
					//echo "Success ". $file_name;
				}else{
					print_r($errors);
				}
			}
	}
					
	$action=(isset($_POST["action"])?$_POST["action"]:false);
	$questfirst=(isset($_POST["questfirst"])?$_POST["questfirst"]:false);
	$option1first=(isset($_POST["option1first"])?$_POST["option1first"]:false);
	$A2=1;
	$option2first=(isset($_POST["option2first"])?$_POST["option2first"]:false);
	$B2=2;
    $option3first=(isset($_POST["option3first"])?$_POST["option3first"]:false);
	$C2 =3;
	$option4first=(isset($_POST["option4first"])?$_POST["option4first"]:false);
	$D2=4;
	$trueansfirst=(isset($_POST["trueansfirst"])?$_POST["trueansfirst"]:false);
	$cbtsetupid=(isset($_POST["cbtsetupid"])?$_POST["cbtsetupid"]:false);
	$id=(isset($_POST["id"])?$_POST["id"]:false);


	$cbtquesid=(isset($_POST["cbtquesid"])?$_POST["cbtquesid"]:false);

	$staffid=(isset($_POST["staffid"])?$_POST["staffid"]:false);
	$dlink=(isset($_POST["dlink"])?$_POST["dlink"]:false);
 
	
	 
	
	

if(isset($action)) {
switch($action) {

case "add":



 $result=$teachersinsert->insert_15fields('quiz_question', 'quiz_setup_id', $cbtsetupid, 'dlink', $file_name, 'question', $questfirst, 'A', $option1first, 'A2', $A2, 'B', $option2first, 'B2', $B2, 'C', $option3first, 'C2', $C2, 'D', $option4first, 'D2', $D2, 'ans', $trueansfirst, 'instructorudate', $udate,  'instructorid', $staffid,  'odate', $odate);

if($result){
				
echo "Question Added Successfully";
}else{ echo "Question couldn't be added"; }		

break;


case "update":

	if($file_name!=""){
	 $file = "../schoolhelp/uploads/cbtquesimage/".$dlink;
				@unlink($file);
}

$result=$schoolhelpupdate->update_ninefields('quiz_question', 'quiz_ques_id', $cbtquesid, 'dlink', $file_name, 'question',  $questfirst, 'A', $option1first, 'B',  $option2first, 'C', $option3first, 'D', $option4first, 'ans', $trueansfirst, 'instructorid', $staffid, 'instructorudate', $udate);

if($result) {
	echo "CBT Question Upadated Successully" ;
}
else{
	echo "CBT Question not Upadated";
	}
break;	

case "delete": 
if($dlink!=""){
	$file = "../schoolhelp/uploads/cbtquesimage/$dlink";
				unlink($file);
	}
$result=$schoolhelpupdate->delete_result('quiz_question', 'quiz_ques_id', $id);

if($result) {
	echo "CBT Question Deleted Successully" ;
}
else{
	echo "CBT Question not Delete";
	}
break;
} // Ending of Switch Statement
} // Ending of checking Action


?>