<?php include("headernew.php"); ?>
<?php  $page=trim(isset($_GET['page'])? $_GET['page']:false);
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
          $regno=trim($studentrec['regno']);
          $phone=trim($studentrec['phone']);
          $address=trim($studentrec['address']);
          $username=trim($studentrec['username']);
          $password=trim($studentrec['password']);

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
                        <h1 class="page-header" style="margin-top:4px; color:#063;">Student Profile<small></small></h1>
     
       
             
           <div class="row">
        	<div class="col-md-11.8 table-responsive" style="padding-top:2%; margin:0% 5% 2%; border:2px solid #060;" >
            <table class="table " style="background:#FFF;"> 
            <tr><td>
             <table class="table" >
            <tr><td ><table class="table" ><tr><td style="width:60px;"><img src="../schoolhelp/images/uploads/student/<?php if($passport==""){echo "user.png"; }else {echo $passport; }?>" height="100" width="100" style=" border:2px solid #060;"/></td><td align="left" valign="bottom"><table style="margin-top:40px" ><tr><td style="font-size:16px; color:#060;"><b>Student Information</b></td></tr></table></td></tr></table></td></tr>
            <tr><td style="width:40%;"><table class="table" id="table1" style="margin:0px"><tr><td align="right" >Name</td> <td><?php echo $fullname ?></td></tr>
            <tr><td align="right">Class</td> <td><?php echo $levelname?></td></tr>
             <tr><td align="right">Regno</td> <td><?php echo $regno; ?></td></tr>
            <tr><td align="right">Sex</td> <td><?php echo $sex; ?></td></tr>
            <tr><td align="right">Option|Group</td><td><?php echo $optionname; ?></td></tr>
            <tr><td  align="right">Student Type</td><td><?php echo  $studenttypename=Others::studenttypename($stype); ?></td></tr>
            <tr><td align="right">House</td><td><?php echo $hdname; ?></td></tr>
            <tr><td  align="right">Phone No</td><td><?php echo $phone; ?></td></tr>
            <tr><td  align="right">Address</td><td><?php echo $address; ?></td></tr>
            <tr><td  align="right">L.G.A</td><td><?php echo $lganame; ?></td></tr>
            <tr><td  align="right">State</td><td><?php echo $statename; ?></td></tr>
            <tr><td  align="right">Country</td><td><?php echo $countryname; ?></td></tr>
            </table></td></tr>
            
            <tr><td style="color:green"><b>Security Information</b></td></tr>
            <tr><td><table class="table table-bordered table-responsive table-striped" id="table1">
            
            <tr><td  align="right" width="40%">Email</td><td><?php echo $email; ?>&nbsp;&nbsp;</td></tr>
            <tr><td  align="right">Username</td><td><?php echo $username; ?></td></tr>
            <tr><td  align="right">Password</td><td  align="left"><?php echo$password; ?></td></tr>
            
           
           </table>
           </td>
           </tr>
            <tr><td  align="center"><a class="btn btn-success" href="studentchangepassword?refno=<?php echo $stid; ?>&page=1"  onClick="if(confirm('Are You sure you want to change password'))" >Change Password</a></td></tr>
            
            </table>
            </td></tr>
            <tr><td>
            <?php
            $titlename="";
					 $record=$SHstudent->allstudentedit('guardian', 'gid', $guardianid);
                    if(is_array($record)){
                      foreach($record as $records){
                        $titleid=trim($records['titleid']);
                         $SHtitle=$SHstudent->allstudentedit('title', 'titleid', $titleid); 
                         if (is_array($SHtitle)) {
                           foreach($SHtitle as $titlerecords){
                            $titlename=$titlerecords['titlename'];
                            }
                         }
                           
                ?>
             <table class="table">
             <tr><td><table class="table"><tr><td style="width:60px;"><img src="../schoolhelp/images/uploads/guardian/<?php if($records["passport"]==""){echo "user.png"; }else {echo $records["passport"]; } ?>" height="100" width="100" style=" border:2px solid #060; "/></td><td align="left"><table style="margin-top:40px;"><tr><td >Parent's Information</td></tr></table></td></tr></table></td></tr>
            <tr><td><table class="table" id="table1">
            
            <tr><td align="right" style="width:40%;">Fullname</td><td><?php echo $titlename.". ".$records["surname"]." ".$records["othername"]; ?></td></tr>
            <tr><td align="right">Address</td><td><?php echo $records["address"] ?></td></tr>
             <tr><td align="right">Email</td><td><?php echo $records["email"] ?></td></tr>
              <tr><td align="right">Phone No</td><td><?php echo $records["phone"] ?></td></tr>
              <!--<a href="#?refno=<?php echo $records['gid'] ?>"  class="btn btn-info btn-mini"> <i class="glyphicon glyphicon-info"></i> Contact Parent</a>	-->
              </table>
              </td></tr>
            </table>
            </td></tr>
            </table>
          <?php }
        }
        ?>
         </div>
            
            
        </div>
                       
        <!--/row-->
        </div>
      
                      
                </div>
                 
				 
                </div>
               
                
                <!-- /.row -->

                

        </div>
 <?php include("footernew.php");?>
    
 <script type="text/javascript">
 	function sendemail(userid, istname, surname, toemail, fromemail){
		
	  queryString = 'userid='+userid+'&istname='+istname+'&surname='+surname+'&toemail='+toemail+
	  '&fromemail='+fromemail;

	jQuery.ajax({
	url: "send_email.php",
	data:queryString,
	type: "POST",
	success:function(data){$("#dis").show();$("#dis").append(data);
	}
	/* Update Record  */
});
	}
 </script>