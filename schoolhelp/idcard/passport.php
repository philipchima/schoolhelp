<?php require_once("../includes/global.php"); ?>
<?php confirmcheckin(); ?>
<?php 
include_once("../includes/connection.php");
  include_once("../phpclass/SHidcardOOP.php");

 $adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="ID Card";
  
$SHIdcardOOP=new classIdcard;
$idcol=trim(isset($_GET['idcol'])?$_GET['idcol']:false);
$myArray = explode(',', $idcol);
$counting=0;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Passport: SchooolHelp</title>
<link rel="shortcuticon icon" type="image/x-icon" href="../images/schoolhelpicon.png">
  <!-- Bootstrap core CSS -->
	
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    
<div class="container-fluid">
    <div class="row">
   
           
<?php
if (is_array($myArray)) {

    foreach($myArray as $my_Array2){
    $stid=trim($my_Array2) ;
    $counting+=1;
    $levelid="";
    $departmentid="";

    $regno="";
    $surname="";
    $othername="";
    $sessionid="";
    $passport="";
    $studentmethod=$SHIdcardOOP->allidcardedit('students','stid', $stid);
      if (is_array($studentmethod)) {
      foreach($studentmethod as $studentdata){
        $sessionid=$studentdata['sessionid'];
        $levelid=$studentdata['levelid'];
        $optionid=$studentdata['optid'];
        $surname=$studentdata['surname'];
        $othername=$studentdata['othername'];
        $regno=$studentdata['regno'];
        $passport=$studentdata['passport'];
        
      }
    }

  $levelmethod=$SHIdcardOOP->allidcardedit('level','levelid', $levelid);
      if (is_array($levelmethod)) {
      foreach($levelmethod as $leveldata){
        $levelname=$leveldata['levelname'];
        $departmentid=$leveldata['departmentid'];
      }
    }

    $deptname="";
     $deptmethod=$SHIdcardOOP->allidcardedit('department','did', $departmentid);
      if (is_array($deptmethod)) {
      foreach($deptmethod as $deptdata){
        $deptname=$deptdata['deptname'];
      }
    }

    $positionname="";
    $signatorymethod=$SHIdcardOOP->allidcardedit2('signatoryposition','departmentid', $departmentid, 'status', 1);
      if (is_array($signatorymethod)) {
      foreach($signatorymethod as $signatorydata){
       $signatorypositionid=$signatorydata['signatorypositionid'];
       $positionname=$signatorydata['positionname'];
       $signature=$signatorydata['signature'];
      }
    }

 $schoolname="";
 $schnameaddress="";
 $schooladdress="";
     $institutionmethod=$SHIdcardOOP->allidcardedit('institution', 'departmentid', $departmentid);
      if (is_array($institutionmethod)) {
      foreach($institutionmethod as $institutiondata){
        $schoollogo=$institutiondata['instilogo'];
        $schoolname=$institutiondata['instiname'];
        $schooladdress=$institutiondata['instiaddress'];
      }
    }

     $sessionlow="";
       $sessionhigh="";
    $sessionmethod=$SHIdcardOOP->allidcardedit('session', 'sessionid', $sessionid);
      if (is_array($sessionmethod)) {
      foreach($sessionmethod as $sessiodata){
       $sessionlow=$sessiodata['sessionlow'];
       $sessionhigh=$sessiodata['sessionhigh'];
      }
    }

    $idcardbackground="";
    //Result Coloring and Background
     $idcardmethod=$SHIdcardOOP->allidcardedit('idcardcolor', 'departmentid', $departmentid);
      if (is_array($idcardmethod)) {
      foreach($idcardmethod as $idcarddata){
        $schnamecolor=$idcarddata['schname'];
        $schnameaddress=$idcarddata['schaddress'];
        $htitlelabel=$idcarddata['htitlelabel'];

        $htitle=$idcarddata['htitle'];
        $tableheadbgcolor=$idcarddata['tableheadbgcolor'];
        $tablecontentcolor1=$idcarddata['tablecontentcolor1'];

        $htitle=$idcarddata['htitle'];
        $tablecontentcolor2=$idcarddata['tablecontentcolor2'];
        $idcardbackground=$idcarddata['idcardbackground'];
      }
    }
    

   if ($idcardbackground==1) {
        $logoaddress="../images/logo/".$schoollogo;
        
        $divbackground='<img src="'.$logoaddress.'" style="position:absolute; top:200; left:-200; opacity:0.1;  z-index:-2; width:80%; "/>';
    }
    elseif ($idcardbackground==2) {
        $increasedaddress=str_repeat($schoolname, 18);
        $divbackground='<div style="color:light-grey; z-index:-2; position:absolute;  opacity:0.1; text-align:justify">'.$increasedaddress.'</div>';
    }else{
        $divbackground="";
    }

?>
<div class="col-lg-12 col-xs-12 col-sm-12 col-md-12" >
  <div class="row">
   <div class="col-lg-6 col-xs-6 col-sm-6 col-md-6"  style="border:#000 solid 2px; width:350px; height:210px; margin:2px 2px;  padding:1px 1px" >
    <?php echo $divbackground; ?>
   	<table width="320px"  height="60" border="0">
      <tr>
        <td width="65px" height="62"><img src="../images/logo/<?php echo $schoollogo; ?>" width="60px" height="60px"></td>
        <td>
          <center>
          <table>
            <tr>
        <td style="font-weight:bold; font-family: Arial Black; text-align:center; color:<?php echo $schnamecolor; ?>; font-size:13px; text-align:center; " height="28px" valign="top"> <b><?php echo strtoupper($schoolname) ?></b></td> 
      </tr>
        <tr>
        <td style=" color:<?php echo $schnameaddress; ?>; font-size:11px; text-align:center " height="28px" valign="top"><?php echo $schooladdress ?></td>
      </tr>
    </table>
  </center>
      </td>
     </tr>
   </table>
   <table width="345px"  height="60" border="0">
   	  <tr >
      	<td rowspan="3" width="100px" height="90px"><img width="100px" height="90px"  <?php if($passport==""){ ?> src="../images/user.png" <?php }else{ ?> src="../images/uploads/student/<?php echo $passport; ?>" <?php } ?>  style="border:<?php echo $schnameaddress; ?> solid 3px; border-radius: 15px;"></td>
        <td style="width:100%;" align="center"> <span style="background:<?php echo $schnamecolor; ?>; color:#FFF; padding:3px; margin-bottom:2%;   border-radius: 50px;"> STUDENT IDENTITY CARD </span></td>
      </tr>
      <tr>
        <td style="font-size:12px; text-align:center; color:<?php echo $tableheadbgcolor;  ?>; font-family: Arial Black;" valign="top" height="32"> <b><?php echo strtoupper($surname ." ".$othername) ?></b></td>
      </tr>
      <tr>
        <td>
        	<table width="100%" style="margin-left:1%; font-size:12px;" valign="top" >
              <tr>
                <td style="color:<?php echo $htitlelabel; ?>">REG NO:</td>
                <td style="border-bottom:2px solid black; color:<?php echo $htitle ?>"> <b><?php echo $regno ?></b></td>
              </tr>
              <tr>
                <td style="color:<?php echo $htitlelabel; ?>">SCHOOL</td>
                <td style="border-bottom:2px solid black; color:<?php echo $htitle ?>"><b><?php echo $deptname ?></b></td>
              </tr>
              <tr>
                <td style="color:<?php echo $htitlelabel; ?>">SESSION:</td>
                <td style="border-bottom:2px solid black; color:<?php echo $htitle ?>"><b><?php echo $sessionlow.' - '.$sessionhigh; ?></b</td>
              </tr>
               
        	</table>
        </td>
     </tr>
     <tr >
      	<td   style="font-size:9px ; text-align:center; "><span style="font-style:italic; " width="47px" height="20px"><?php echo $surname; ?> </span> <br> STUDENT'S SIGN</td>
        <td  ><div style="background:<?php echo $tableheadbgcolor;  ?>; width:80%; margin-left:auto; margin-right:auto;  border-radius: 15px 50px; color:#FFF; font-size:14px; text-align:center; "> <b><?php echo strtoupper($surname) ?> </b></div></td>
     </tr>
	</table>
   </div>
   
	<div class="col-lg-6 col-xs-6 col-sm-6 col-md-6" style="border:#000 solid 2px; width:350px;  font-size:13px; margin:2px 2px; padding:0px; height:210px">
    <?php echo $divbackground; ?>
   	<table width="345px"  height="63" border="0">
      <tr>
        <td width="65px" height="60" align="center"> This Card is issued for the identification of the holder whose name photograph and Signature appear on the reverse side.</td>
     </tr>
     <tr>
        <td width="65px" height="60" align="center"> This Card is the property of  <b><?php echo strtoupper($surname.' '.$othername) ?></b> , Nigeria and remains valid for the period stated overleaf. If found please, return to the above Institution.</td>
     </tr>
     <tr>
        <td width="440px" height="60" align="center"> 
        	<table >
            	<tr style="margin:2px;">
                    
                    <td align="center" style="width:40%">  
                    
                    <b>Date Issued:</b><br>
                    <?php echo date("d-m-Y");?>
                    </td>
                
                   
                    <td  align="center" style="width:40%"> SIGN <br>
                    <img style="width:20%" src="../images/signatures/signatoryposition/<?php echo $signature; ?>"><br>
                    <b><?php echo $positionname; ?></b>
                    </td>
                 </tr>
            </table>
        </td>
     </tr>
   </table>
   </div>
   
   </div>
   </div>
 <?php $check=$counting%5; if($check==0) {?> 
 <div style="page-break-after: always;"></div> <?php }else{ ?>
 <div style="page-break-after: none;"></div><?php } ?>
   <?php } ?>
   <div style="clear:both"></div>
   
   </div>
   </div>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>