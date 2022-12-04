<?php require_once("includes/session.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once ('../connection.php');
include_once "classes.php";

$refno= (isset($_GET['refno'])? $_GET['refno']:false);
$stid =(isset($_SESSION['stid'.$refno])?$_SESSION['stid'.$refno]:false);
if($_GET["refno"] != ""){
	$_SESSION["stid"] = $_GET["refno"];
}

$stid = $_SESSION["stid"] ;
$select_content2=("select * from students where stid ='$stid'");
$content_result2= mysqli_query($mysqli, $select_content2) or die (mysqli_error($mysqli));
$content2 = mysqli_fetch_assoc($content_result2);
$num_chk2 = mysqli_num_rows ($content_result2);

$classv = $content2["class"];
$select_content3=("select * from classes where id='$classv'");
$content_result3= mysqli_query($mysqli, $select_content3) or die (mysqli_error($mysqli));
$content3 = mysqli_fetch_assoc($content_result3);



$select_content4=("select * from terms where status='1'");
$content_result4= mysqli_query($mysqli, $select_content4) or die (mysqli_error($mysqli));
$content4 = mysqli_fetch_assoc($content_result4);
$term = $content4["tid"];

date_default_timezone_set('Africa/Lagos');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SchoolHelp Suite: School Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="../css/bootswatch.min.css">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
      <script src="../bower_components/respond/dest/respond.min.js"></script>
    <![endif]-->
    <script>

     var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-23019901-1']);
      _gaq.push(['_setDomainName', "bootswatch.com"]);
        _gaq.push(['_setAllowLinker', true]);
      _gaq.push(['_trackPageview']);

     (function() {
       var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
       ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
     })();

    </script>
    

  </head>
  <body>
  <div style="border-top:3px solid rgba(0,0,51,1);">
       <div class="container">
		
		<?php include("includes/head.php"); ?>
 <!-- carosul
      ================================================== -->



 <!-- end of carosul
      ================================================== -->
       <!-- begin of grid
      ================================================== -->
            <!-- begin of row-->
      <div class="row" style="  padding-bottom:0px;  border-bottom:4px solid rgba(0,0,51,1); box-shadow:0px 5px 0px 0px #0066CC;"><!-- end of row -->
   		 <div class="col-lg-3 panel panel-default">
          <!-- left -->
          <?php include("includes/leftmenu.php")?>
          
        </div><!-- /span-3 -->
        
        <div class="col-lg-9">
        	<div class="row">
                <div class="col-lg-12">
                    <div class="col-md-6">
                         <strong><i class=" icon-list"></i> <?php echo $content3["class"] ."  ". $content4["term"] ."  Term"?></strong>
                    </div>
                    <div class="col-md-6">
                         Student: <strong> <?php echo $content2["surname"]." ".$content2["othername"]?></strong>
                                      <?php if($content2["passport"] !=""){ ?><img src="../backend/uploads/studentpassport/<?php echo $content2["passport"] ?>" width="20" height="20"> <?php } else{ ?><img src="../backend/uploads/studentpassport/fade.gif" width="20" height="20">  <?php }?>
                   </div> 
                </div><br>
                <hr> 
                
               
             </div>
             
             <div class="row">
                <div class="col-lg-12 " >
                <?php
				if(!isset($_GET["pg"]))
				{
					?>
                
                 <?php
				 
				 
                  
				   $query = mysql_query("select * from student_quiz where class_id='$classv' and term='$term' and status=1 order by qid asc") or die(mysql_error());
				   if(mysql_num_rows($query)==0)
				   {
					   ?><h3 style="color:rgb(0,0,102);"><i class="glyphicon glyphicon-info-sign"></i> No Quiz set yet for this term</h3>
				 <?php  }else
				   {
					   ?>
                       <h3 style="color:rgb(0,0,102);"><i class="glyphicon glyphicon-info-sign"></i>Quiz Dashboard</h3>
                        please ensure to read instructions before answering them<br/>
                       <p>Good Luck</p>
                       <?php
                        while ($row = mysql_fetch_array($query)) {
                            $id = $row['qid'];
							 $subject = $row['subject_id'];
							$_SESSION["stid"];
							$k = $k + 1;
							
							//check if the student has answered the quiz
							//check first if the student ha\ve alredy answered the quiz
				 $check = mysql_query("select * from quiz_result where sid='".$_SESSION["stid"]."' and quiz_ID='$id' and sub_id='$subject'") or die(mysql_error());
				 $num=mysql_num_rows($check);
                            ?>
                            
                            
						<a href="<?php  if($num>0){ echo '#'; } else{ ?>online-test?pg=11&id=<?php echo $row['qid'];?> <?php } ?>">  
                         <div class="col-lg-3" <?php if($num>0){?> style="box-shadow:1px 2px 2px 2px  #990000; background-color:rgb(255,232,232);" <?php }else{ ?> style="box-shadow:1px 2px 2px 2px #CCCCCC; background-color:#F2F9FF;"<?php } ?> >
                           <?php $sid = ucfirst($row['subject_id']);
											 $select_content2=("select * from subjects where sid = '$sid'");
																				 
											 $content_result2= mysql_query($select_content2) or die (mysql_error());
											 $content2 = mysql_fetch_assoc($content_result2);
											 $num_chk2 = mysql_num_rows ($content_result2);
																				 
											echo "<br/> <img src='../img/accept.png' align='absmiddle'/><strong > ". $content2['subject']."</strong><br/>"; 
                                            echo "Total Score : <strong>". $row['totalscore']." %</strong><br/>";
											echo "<strong>Answerable Qtn : </strong>". $row['ansNo']." Qtn<br/>";
											echo "Duration : <strong>". $row['time']." min(s)</strong><br/>"; 
											 echo "Since : <strong>". $row['date_announce']." </strong><br/><br/>";
											?>
                           </div></a>
                           <?php  }} ?>
                
              <?php
						}
						if($_GET["pg"]==11 and !isset($_POST["proceed"]) ){
						?>
                
                
       <?php   
		  echo' <h3 style="color:rgba(0,153,0,1);">Online Test Rules</h3>';
		 ?>
		  
          <table class="table" style="font-size:12px;">
          <tr>
			<td align="left">
                        <ol>
                            <li>Subject Name <b>.<?php echo $_GET["eN"]; ?>.</b></li>
                            
                            <li>Total Questions <b>10</b>.</li>
                            <li>You need to score <b>50%</b> or above to pass. </li>
                            <li>Allocated time is <b>1 minute(s) 0 second(s) per question</b>. If you complete the question within allocated time, you can move to next question.</li>
                            <li>You cannot go back to a previous question.</li>
                        </ol>
                        
                        <b><h4>Note:</h4></b>
                         <ol>
                                <li>Poor internet connection or temporary disconnection does not affect the online exam. <br />
                                Once you reconnect, resume the exam by clicking the next button again.</li>                               
                                <li>While writing the exam, you can see the remaining time in the top right side.</li>
                                <li>After the allocated time, you are automatically moved to the next question. </li>
                                <li class=rec>Do not use browser's back / refresh button. It may lead to next question or termination of assessment.</li>
                         </ol>
                         <h4>Troubleshooting</h4>
                                    <ol class="li14">
                                    <li>If you accidentally close the window, or you cannot complete the assessment due to power failure you can resume the assessment by clicking on it again. Note that you can resume only from the next question and you have to resume the assessment within 48 hours.</li>
                                    </ol>
                                    <form method="post">
                                    <button name="proceed" id="proceed" class="btn btn-success btn-large"><i class="glyphicon glyphicon-certificate"></i> Proceed to Exam</button>
                                    </form>
                    </td>
		</tr>
        </table>
        
        
        <?php }
		if(isset($_GET["id"]) and isset($_POST["proceed"]))
		{
		?><center>
          <div style="background-color:rgba(224,244,221,1); margin-top:50px; border:1px solid rgba(0,51,0,1); color:#003300; font-size:14px; padding:15px; margin:8px;">
        <i class="glyphicon glyphicon-info-sign"></i> <b>Warning:</b> Once the exam has started DO NOT move focus outside the exam tab/window otherwise your exam will be aborted and you will not be able to complete it.
          </div><br><p>We recommend that you use full screen mode on your browser while attending the online exam. Most of the popular browsers support F11 key for full screen mode. Please use full screen mode before starting the online exam.</p><br/> 
                                    <a href="exam_page.php?id=<?php echo $_GET['id']; ?>&sid=<?php echo $_SESSION["stid"]; ?>" class="btn btn-success btn-large"><i class="glyphicon glyphicon-certificate"></i>Start Online Exam</a>
                                    </center>
                           
<?php
		}
		?>
                </div>
             </div>   
                       
        <!--/row-->
        </div><!--/col-span-9-->
        
        

    
  </div><!--/row-->
  <!-- /upper section -->
      
    
      <!--############################################################################ -->
       <?php include("../includes/footer.php"); ?>

        <!-- Le javascript
    ================================================== -->


  

    <script src="js/bootstrap.min.js"></script>
    <script src="ajax/myscript.js"></script>
    </div>
  </body>
  
</html>
