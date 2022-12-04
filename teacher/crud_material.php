<?php

include("../schoolhelp/includes/connection.php");
$udate=date("y-m-d");
					
$action = (isset($_POST["action"])?$_POST["action"]:false);
$id=(isset($_POST["id"])?$_POST["id"]:false);
$docdel=(isset($_POST["dlink"])?$_POST["dlink"]:false);


if($action) {
switch($action) {

case "add":
break;


case "update":
$result = mysqli_query($mysqli, "UPDATE quiz_question set question = '$questfirst', A='$option1first',  B='$option2first',  C='$option3first',  D='$option4first',  ans='$trueansfirst' WHERE quiz_ques_id='$id'") or die(mysqli_error($mysqli));

break;	

case "delete": 
if(!empty($_POST["id"])) {
	echo $file = "../schoolhelp/uploads/classmaterial/".$docdel;
			unlink($file);
$result=mysqli_query($mysqli,"DELETE FROM coursematerials WHERE cm_id='$id'")or die(mysqli_error($mysqli));
if($result) {
	echo "Course Material Deleted Successully" ;
}
else{
	echo "Course Material Could'nt Delete";
	}
}
break;
} // Ending of Switch Statement
} // Ending of checking Action


?>