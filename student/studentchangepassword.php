<?php include("headernew.php"); ?>
<?php 

$page=trim(isset($_GET['page'])? $_GET['page']:false);
$refno= trim(isset($_GET['refno'])? $_GET['refno']:false);
$stid =trim(isset($_SESSION['stid'.$refno])?$_SESSION['stid'.$refno]:false);


$sql=(isset($_GET['sql'])? $_GET['sql']:false);
  $optionname="";
                             $adminsurname="";
                             $adminothername="";
                             $levelname="";
                             $state="";
                             $sex="";
                             $k=0;
                             $guardiansurname="";
                             $guardianothername="";
                             $housedivisionid="";
 $studentdata=$SHstudent->allstudentedit('students', 'stid', $stid);
      if (is_array($studentdata)) {
        foreach($studentdata as $studentrec){
         $levelid=trim($studentrec['levelid']);
         
         $passport=trim($studentrec['passport']);
         $fullname=trim($studentrec['surname']).' '.trim($studentrec['othername']);
         $stype=trim($studentrec['studenttype']);
         $housedivisionid=trim($studentrec['housedivisionid']);
         $sex=
          $sexname=Others::sexname($studentrec['sexid']);
          $stateid=trim($studentrec['stateid']);
          $countryid=trim($studentrec['countryid']);
          $lgaid=trim($studentrec['lgaid']);
          $levelid= trim($studentrec['levelid']);
          $optionid=trim($studentrec['optid']);
          $guardianid=trim($studentrec['guardianid']);
          $email=trim($studentrec['email']);

        }
      }

//Getting level name
 $leveldata=$SHstudent->allstudentedit('level', 'levelid', $levelid);
      if (is_array($leveldata)) {
        foreach($leveldata as $levelrec){
         $levelname=trim($levelrec['levelname']);
               
        }
      }

//Getting Option name
 $optiondata=$SHstudent->allstudentedit('optiontable', 'optid', $optionid);
      if (is_array($optiondata)) {
        foreach($optiondata as $optionrec){
         $optionname=trim($optionrec['optname']);
               
        }
      }

    $hddata=$SHstudent->allstudentedit('housedivision', 'hdid',  $housedivisionid);
                                 if(is_array($hddata)){
                                    foreach($hddata as $hdrecord){
                                      $hdname=$hdrecord['hdname'];
                                      
                                    }

                                  }

                                    $statedata=$SHstudent->allstudentedit('states', 'id',  $stateid);
                                 if(is_array($statedata)){
                                    foreach($statedata as $staterecord){
                                      $statename=$staterecord['name'];
                                      
                                    }
                                  }
                                       $lgadata=$SHstudent->allstudentedit('lga', 'lgaid',  $lgaid);
                                 if(is_array($lgadata)){
                                    foreach($lgadata as $lgarecord){
                                      $lganame=$lgarecord['name'];
                                      
                                    }
                                  }

                                        $countrydata=$SHstudent->allstudentedit('countries', 'id',  $countryid);
                                 if(is_array($countrydata)){
                                    foreach($countrydata as $countryrecord){
                                      $countryname=$countryrecord['name'];
                                      
                                    }

                                  }

                                  $guardianrecords=$SHstudent->allstudentedit('guardian', 'gid', $guardianid);
                              if (is_array($guardianrecords)) {
                                foreach($guardianrecords as $guardianrecord){
                                  $guardiansurname=$guardianrecord['surname'];
                                   $guardianothername=$guardianrecord['othername'];
                                }
                              }


date_default_timezone_set('Africa/Lagos');

if($page==4){
      $udate=date("Y-m-d H:m:s");
      $password=trim(md5(sha1(md5(isset($_POST['password'])?$_POST['password']:false))));
      $password2=trim(md5(sha1(md5(isset($_POST['password2'])?$_POST['password2']:false))));
      $passwordold=trim(md5(sha1(md5(isset($_POST['passwordold'])?$_POST['passwordold']:false))));

        
         $studentdata=$SHstudent->allstudentedit2('students','stid', $stid, 'password', $passwordold);
                                if (is_array($studentdata)) {
                                  
      
          if($password==$password2){

            $schoolhelpupdate= new updateTable;
            $passwordupdate=$schoolhelpupdate->update_all2('students', 'stid', $stid, 'odate', $udate, 'password', $password);
            
            
                  $sql="<b>Password Changed Updated Successfully</b>";
                echo "<script language='javascript'>
              location.href='studentschangepassword?refno=$stid&sql=$sql'
              </script>";
  
            
            
          }else{ $sql="<b>Password did not Match</b>"; }
      }else{
          $sql="Criminal Action Suspected: Old password invalid";
          echo "<script language='javascript'>
              location.href='studentchangepassword?refno=$stid&sql=$sql'
              </script>";
      }
    }

?>


    
<div id="page-wrapper">

            <div class="container-fluid">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Hi!</strong> <span style="font:20px Corbel bold; color:#060; "><?php echo $fullname." "; ?> </span><span style="color:#060;">; Class:<span style="color:#FEA318;"><?php echo $levelname ." " ; ?>;</span> Group:<span style="color:#FEA318;"><?php echo $optionname ." " ; ?></span> <span style="font:20px Corbel  bold; color:#F00; ">; <?php echo $semestername; echo " ";?>Term of <?php echo $sessionname; ?></span> </span>
                        </div>
                    </div>
                </div>
   <div class="row">
                    <div class="col-lg-11.8 col-xs-11.8 col-sm-11.8 col-md-11.8" style=" margin:0% 2% 2%; background:#FFF; padding:1%; ">
                        <h1 class="page-header" style="margin-top:4px; color:#063;">Change Password<small></small></h1>
     
       				  <div class="row">
				 <div class="col-md-11 col-lg-11 col-sm-11 col-xs-11 table-responsive" style="background:#063; margin:0% 2% 0% 4%; border-bottom:2px solid #8DFC6D; color:#FFF; border-radius:2px; -moz-border-radius:3px; -o-border-radius:3px; -webkit-border-radius:3px; -o-border-radius:3px; width:88%; height:35px; font-size:1.3em;">Student Password Change
        </div>
        </div>
               
        <?php
	if ($page == "")
	{
		?>
        
      	<div class="row">
        	<div class="col-md-10 col-lg-10 col-sm-10 col-xs-10" style="background:#FFF; margin:0% 2% 2%; padding:2%;">
            <center>
            <div><p style="color:#F00">
            <?php echo $sql; ?>
            <br/>
           
            </p></div>
			 </center>            
            </div>
        </div>
       
        </div>
         <?php
		}
		?>
        
           <?php
  if ($page == 1)
  {
    ?>
        
      <div class="row">
          <div class="col-md-10 col-lg-10 col-sm-10 col-xs-10" style="background:#FFF; margin:0% 2% 2%; padding:2%;">
            <div><center><?php echo $sql; ?></center></div>
            <div style="width:50%; margin-left:auto; margin-right:auto"><p style="color:#F00">
                <form action="?page=4&refno=<?php echo $stid; ?>" method="post">
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
                <p>
                  <div id="msg" style="text-align:center;"></div>
                  <input type="submit" value="SUBMIT" id="submit">
                </p>
                </form>

            </p></div>
                
            </div>
        </div>
         <?php
    }
    ?>
        
         <?php
	if ($page == 2)
	{
		
		?>
        
      	<div class="row">
        	<div class="col-md-10 col-lg-10 col-sm-10 col-xs-10" style="background:#FFF; margin:0% 2% 2%; padding:2%;">
            
            <div style="width:50%; margin-left:auto; margin-right:auto"><p style="color:#F00">
           <form action="?page=4" method="post">

  <p>
    <label for="username">Old Password</label>
    <input id="username" name="username" type="password" class="form-control">
  </p>
  <p>
    <label for="password">New Password</label>
    <input id="password" name="password" type="password" class="form-control">
    <span>Enter a password longer than 8 characters</span> </p>
  <p>
    <label for="confirm_password">Confirm Password</label>
    <input id="confirm_password" name="confirm_password" type="password" class="form-control">
    <span>Please confirm your password</span> </p>
  <p>
    <input type="submit" value="SUBMIT" id="submit">
  </p>
</form>

            </p></div>
			          
            </div>
        </div>
       
        </div>
         <?php
		
		}
		?>
                    
        <!--/row-->
        </div>
      
                      
                </div>
                 
				 
                </div>
               
                
                <!-- /.row -->

                

        </div>
 <?php include("footernew.php");?>
    <script type="text/javascript">
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

 
 /*Password change Script Closing*/
 
 
 	function sendemail(userid, istname, surname, toemail, fromemail){
		
	  queryString = 'userid='+userid+'&istname='+istname+'&surname='+surname+'&toemail='+toemail+
	  '&fromemail='+fromemail;

	jQuery.ajax({
	url: "send_email.php",
	data:queryString,
	type: "POST",
	success:function(data){$("#dis").append(data);
	}
	/* Update Record  */
});
	}
 </script>
