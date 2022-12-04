<?php 
include_once("phpclass/schoolhsignoop.php");
$schoolhelp= new AllSignins;
$activationtbl=$schoolhelp->allsigninedit('cpanelactivations','titlename','Pin');
if (is_array($activationtbl)) {
  foreach($activationtbl as $activationrec){
   $signinstatus=$activationrec['status'];
  }
}

$stakeholder=trim(isset($_GET["stakeholder"])?$_GET["stakeholder"]:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);
?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>School Help| School Management Application</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="School Management System, Attendance, Medical Records, E-learning, E-library, Result Proccessing system, Students Record, Nigeria Nursery, Primary and Secondary School">
    <link rel="shortcuticon icon" type="image/x-icon" href="images/schoolhelpicon.png">
    <link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/bootstrap.css" media="screen">
    
        <link rel="stylesheet" href="css/forindexonly.css">
    
  </head>
 <body style="background:#CFFEE8; ">
 <div class="">
 <?php include("headermain.php");?>

<div class="form"> 
  <div style="color:#060; font-weight:bold"> <?php 
  $state=trim(isset($_GET['state'])?$_GET['state']:false);
  if ($state==1) {
    $sql="Invalid Username/Password: Please Try again";
  }
  			
  			if($stakeholder==3){echo "Signin as an Admin";} 
		  else if($stakeholder==2){echo "Signin as a Student";} 
		  else if($stakeholder==1){echo "Signin as a Parent";}
		   else if($stakeholder==4){echo "Signin as a Teacher";}
		  ?></div>
  <div class="thumbnail"><img src="images/schoolhelpicon.png" /></div>
  
  <?php if(($stakeholder==3)||($stakeholder==4)){ ?>
  <form class="signin-form" name="signinform" action="indexing.php" method="post"  >
    <input id="username" type="text" name="username" placeholder="Username" required="required"/>
    <input type="password" name="password" placeholder="Password" />
    <input type="hidden" name="stakeholder" value="<?php echo $stakeholder; ?>" required="required">
    <button>Signin</button>
    <p class="message">Forgotten Username/Password? <a href="#">Recover Account</a></p>
    <?php  if($state==1){ ?>
        <div>
          <h4 style="color:#F00">signin Unsuccessfull! Check your Username and Password</h4>
         <span style="color:#F60">or Contact the Admin for help</span>

        </div>
        <?php } ?>
  </form>
  <?php } ?>

  <?php if(($stakeholder==1)||($stakeholder==2)){ 
    if ($signinstatus==1) {
      $username="Enter Student's Reg NO";
      $password="Enter Student's Pin";
    }else{
      $username="Username";
      $password="Password";
    }
    ?>
  <form  name="signinform" action="indexing.php" method="post"  >
    <input id="username" type="text" name="username" required="required" placeholder="<?php echo $username; ?>" class="form-control col-md-6">
    <input type="password" name="password" placeholder="<?php echo $password; ?>" required="required"  class="form-control col-md-6">
    <input type="hidden" name="stakeholder" value="<?php echo $stakeholder; ?>" >

    <button>Signin</button>
    <?php  if ($signinstatus==0) { ?>
    <p class="message">Forgotten Username/Password? <a href="#">Recover Account</a></p>
    <?php } ?>
    <?php  if($state==1){ ?>
        <div>
          <h4 style="color:#F00">Signin Unsuccessfull! Check your Username and Password</h4>
         <span style="color:#F60">or Contact the Admin for help</span>

        </div>
         <?php }else if ($sql!="") {?>
            <div>
          <h4 style="color:#F00">Unsuccessfull! <?php echo $sql; ?></h4>
         <span style="color:#F60">or Contact the Admin for help</span>
       <?php } ?>
        
  </form>
  <?php } ?>
  </div>
  </div>

<?php include("footermain.php");?>

  </body>
</html>
