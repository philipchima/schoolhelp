
<?php
include("../schoolhelp/includes/connection.php");
include("phpclass/SHteacherupdate.php");

include("../schoolhelp/phpclass/schoolhelpothers.php");

include("headernew.php");
   $refno=trim(isset($_GET['refno'])?$_GET['refno']:false);
          $page = trim(isset($_GET['page'])?$_GET['page']:false);
         $sql = trim(isset($_GET['sql'])?$_GET['sql']:false);
         
         $staffid=trim(isset($_SESSION["t_teacherlog".$refno])?$_SESSION["t_teacherlog".$refno]:false);

         //Select current term/semester
        $semesterdata=$SHteacher->allteacheredit('semesters','status', 1);
            if (is_array($semesterdata)) {
                foreach($semesterdata as $semesterrecord){
                    $semestername=$semesterrecord['semestername'];
                    $semesterid=trim($semesterrecord['semesterid']);
                    
              }
          }

        //Select current Session
         $sessiondata=$SHteacher->allteacheredit('session','status', 1);
            if (is_array($sessiondata)) {
                foreach($sessiondata as $sessiondrecord){
                    $sessionname=$sessiondrecord['sessionlow']."/".$sessiondrecord['sessionhigh'];
                    $sessionid=trim($sessiondrecord['sessionid']);    
              }
          }
		 
		if($page==4){
			$udate=date("Y-m-d H:m:s");
			$password=trim(md5(sha1(md5(isset($_POST['password'])?$_POST['password']:false))));
			$password2=trim(md5(sha1(md5(isset($_POST['password2'])?$_POST['password2']:false))));
			$passwordold=trim(md5(sha1(md5(isset($_POST['passwordold'])?$_POST['passwordold']:false))));

				
			   $teachersdata=$SHteacher->allteacheredit2('staff','staffid', $staffid, 'password', $passwordold);
                                if (is_array($teachersdata)) {
                                  
			
					if($password==$password2){

						$schoolhelpupdate= new updateTable;
						$passwordupdate=$schoolhelpupdate->update_all2('staff', 'staffid', $staffid, 'odate', $udate, 'password', $password);
						
									$sql="<b>Password Changed Updated Successfully</b>";
								echo "<script language='javascript'>
						  location.href='teacherschangepassword?refno=$staffid&sql=$sql'
						  </script>";
	
						
						
					}else{ $sql="<b>Password did not Match</b>"; }
			}else{
					$sql="Criminal Action Suspected: Old password invalid";
					echo "<script language='javascript'>
						  location.href='teacherschangepassword?refno=$staffid&sql=$sql'
						  </script>";
			}
		}

?>

            <div class="container-fluid">
				<!-- /.row -->

              <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Hi!</strong> <span style="font:20px Corbel bold; color:#060; "><?php echo (isset($_SESSION["t_fullname".$staffid])?$_SESSION["t_fullname".$staffid]:false); ?> </span><span style="color:#FEA318;">Note that your operations is only strictly on <span style="font:20px Corbel  bold; color:#F00; "><?php echo $semestername; echo " ";?>Term of <?php echo $sessionname; ?></span> </span>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- Page Heading -->
                <div class="row">
				 <div class="col-md-11 col-lg-11 col-sm-11 col-xs-11 table-responsive" style="background:#063; margin:0% 2% 0% 4%; border-bottom:2px solid #8DFC6D; color:#FFF; border-radius:2px; -moz-border-radius:3px; -o-border-radius:3px; -webkit-border-radius:3px; -o-border-radius:3px; width:88%; height:35px; font-size:1.3em;">Staff Password Change
        </div>
        </div>
               
        <?php
	if ($page ==1)
	{
		?>
        
      	<div class="row">
        	<div class="col-md-10 col-lg-10 col-sm-10 col-xs-10" style="background:#FFF; margin:0% 2% 2%; padding:2%;">
            <center>
            <div><p style="color:#F00">
            <?php echo $sql; ?>
           
            </p></div>
			 </center>            
            </div>
        </div>
       
        </div>
         <?php
		}
		?>
   
        
      <div class="row">
        	<div class="col-md-10 col-lg-10 col-sm-10 col-xs-10" style="background:#FFF; margin:0% 2% 2%; padding:2%;">
            <div><center><?php echo $sql; ?></center></div>
            <div style="width:50%; margin-left:auto; margin-right:auto"><p style="color:#F00">
           <form action="?page=4&refno=<?php echo $staffid; ?>" method="post">

  <p>
    <label for="passwordold">Old Password</label>
     <input type="password" class="form-control form-control-padded" name="passwordold" id="Passwordold"  value=""  placeholder="Enter Old Password" required/>
  <p>
    <label for="password">New Password</label>
    <input type="password" class="form-control form-control-padded" name="password" id="Password"  value=""  placeholder="Enter Password" required />
    <span>Enter a password longer than 8 characters</span> </p>
  <p>
    <label for="ConfirmPassword">Confirm Password</label>
    <input type="password" class="form-control form-control-padded" name="password2" id="ConfirmPassword" value=""   placeholder="Re-enter Password" required />
    <span>Please confirm your password</span> </p>
    <div style="margin-bottom:10px">
  <p>
  	<div id="msg" style="text-align:center;"></div>
    <input type="submit" value="SUBMIT" id="submit" class="btn btn-primary">
  </p>
</div>
</form>

            </p></div>
			          
            </div>
        </div>
        
        
        
              
 <?php include("footernew.php");?>
 

<script>
			
		    $(document).ready(function(){
		        $("#ConfirmPassword").keyup(function(){
		             if ($("#Password").val() != $("#ConfirmPassword").val()) {
		                 $("#msg").html("Password do not match").css("color","red");
		                  $("#submit").attr("disabled", true);
		             }else{
		                 $("#msg").html("Password matched").css("color","green");
		                 $("#submit").removeAttr("disabled");
		            }
		      });
		});

 
 
 </script>