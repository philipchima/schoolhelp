<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>School Help| School Management Application</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="School Management System, Attendance, Medical Records, Computer Based Test, Online Payments E-library, Result Management System, Students Record, Nigeria Secondary School">
    <link rel="shortcuticon icon" type="image/x-icon" href="images/schoolhelpicon.png">
    
	<link rel="stylesheet" href="css/bootstrap.css" media="screen">
        
<style>
a:hover{ text-decoration:none;}
a.thumbnail:hover{ background:#FFF; border:5px solid #060; }
 .thumbnail {
  background:#D7FFEB;
  max-width: 180px;
  max-height: 180px;
  margin: 0.2% auto 0.2%;
  padding:  0.5% 0.5%;
  border:5px solid #BFC;
  border-top-left-radius: 100%;
  border-top-right-radius: 100%;
  border-bottom-left-radius: 100%;
  border-bottom-right-radius: 100%;
  box-sizing: border-box;
}

.thumbnail2 {
  background: #FFF;
  width: 50%;
  height: 70%;
  margin: 1% auto 1%;
  padding: 0.5% 0.5%;
  border:5px solid #060;
  border-top-left-radius: 100%;
  border-top-right-radius: 100%;
  border-bottom-left-radius: 100%;
  border-bottom-right-radius: 100%;
  box-sizing: border-box;
}
.thumbnail img {
  display: block;
  width: 70%;
  height:70%;
}

* Extra small devices (phones, up to 480px) */
@media screen and (max-width: 240px) {
	span { font-size:10%;}
}
@media screen and (max-width: 320px) {
	span{ font-size:10%;}
}
@media screen and (max-width: 767px) {
	span{ font-size:90%;}
}
/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) and (max-width: 991px) {
	span{ font-size:120%;}
}
/* tablets/desktops and up ----------- */
@media (min-width: 992px) and (max-width: 1199px) {
	span{ font-size:120%;}
}
/* large desktops and up ----------- */
@media screen and (min-width: 1200px) {
	span{ font-size:120%;}
}
 </style>
 
    
    
  </head>
 <body style="background:#CFFEE8;">
<div>
<?php include("headermain.php");?>
<div class="container thumbnail2" style="background:#FFF;"> 
<div class="row" >
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="">
  <center>
  <a href="signin?stakeholder=2">
  <div class="thumbnail"><img class="img-responsive" src="images/student.png" />
  <span style="color:#060; font-family: 'Arial Black', Gadget, sans-serif; font-weight:bold;  ">Student</span>
 
  </div>
  </a>
  </center>
  </div></div>
  <div class="row">
  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="">
  <center>
  <a href="signin?stakeholder=3">
  <div class="thumbnail"><img class="img-responsive" src="images/adminmain.png" />
  <span style="color:#060; font-family: 'Arial Black', Gadget, sans-serif; font-weight:bold; ">Admin</span>
 
  </div>
  </a>
  </center>
  </div>
  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="">
  <center>
  <a href="signin?stakeholder=4">
  <div class="thumbnail"><img class="img-responsive" src="images/teacher.png" />
  <span style="color:#060; font-family: 'Arial Black', Gadget, sans-serif; font-weight:bold; ">Teacher</span>
  </div>
  </a>
  </center>
  </div>
  </div>
  <div class="row">
   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="">
  <center>
  <a href="signin?stakeholder=1">
  <div class="thumbnail">
  
  <img class="img-responsive" src="images/parentsmain.png"  alt="Parents"/>
  <span style="color:#060; font-family: 'Arial Black', Gadget, sans-serif; font-weight:bold;  ">Parents</span>
  </div>
  
  </a></center></div>
</div>
</div>
</div>
<?php include("footermain.php");?>
 
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
    <script src="ajax/myscript.js"></script>
     <script src="js/bootstrap-carousel.js"></script>
     <script src="js/bootstrap-transition.js"></script>
  <script src="js/index.js"></script>
    
  </body>
</html>
