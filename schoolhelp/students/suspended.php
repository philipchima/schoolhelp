
<?php 

include_once("../includes/connection.php");
include_once("../phpclass/SHstudentinserts.php");
include_once("../phpclass/schoolhelpothers.php");
include_once("../phpclass/schoolhelpOOP.php");
include_once("../phpclass/SHstudentOOP.php");
include_once("../phpclass/SHstudentupdate.php");
include("includes/header.php");
confirmcheckin();
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Students";

$odate=date("Y-m-d");

$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

 $type=trim(isset($_GET['type'])?$_GET['type']:false);
 $levelid=trim(isset($_GET['levelid'])?$_GET['levelid']:false);
 $optionid=trim(isset($_GET['optionid'])?$_GET['optionid']:false);

//Classes
//level/Class class
$data=new classLevel;
//Option/Class class
$optiondata=new classOption;

//Session Class 
$sessiondata=new classSession;

//Student class
$schoolhelpDH=new classStudent;

//Excel Template class

$template=new Databasebackup;

$mysqli1=new Dbh;
$mysqli=$mysqli1->connect();

$tablestudents=new updateTable;
$pageaccess="";
$previlleges=$schoolhelpDH->allstudentedit('adminpersons', 'adminid', $schoolhelp);
if (is_array($previlleges)) {
 
foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['student_d']);
  $admintype=trim($actualrecord['admintype']);
  $dashedit_d=trim($actualrecord['dashedit_d']);
  $dashadd_d=trim($actualrecord['dashadd_d']);
  $dashdelete_d=trim($actualrecord['dashdelete_d']);
  $signatorypositionid=trim($actualrecord['signatorypositionid']);
}

}
if ($pageaccess!=1) {
  echo "<b style='font-size:100; color:red'>Criminal Attempt Made, contact the admin ask for the access of this page</b>";
  exit();
}

//This script is to determine the actual admin that is logging whether a super admin or a position holder in a school


if ($admintype==1) {
  $logindepartmentid='';
}
else{

$signatorydata=$schoolhelpDH->allstudentedit('signatoryposition', 'signatorypositionid', $signatorypositionid);
if (is_array($signatorydata)) {
  foreach($signatorydata as $signatoryrec){
  $logindepartmentid=$signatoryrec['departmentid'];
  
  }
}
}

if($page==2) {
  if ($dashadd_d==1) {
  
$regno=trim(isset($_POST['regno'])?$_POST['regno']:false);
 $surname=trim(isset($_POST['surname'])?$_POST['surname']:false);
 $othername=trim(isset($_POST['othername'])?$_POST['othername']:false);
 $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
 $optid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);
 $hdid=trim(isset($_POST['hdid'])?$_POST['hdid']:false);
 $sex=trim(isset($_POST['sex'])?$_POST['sex']:false);
 $dateofbirth=trim(isset($_POST['dateofbirth'])?$_POST['dateofbirth']:false);
 $address=trim(isset($_POST['address'])?$_POST['address']:false);
 
 $lgaid=trim(isset($_POST['lgaid'])?$_POST['lgaid']:false);
 $stateid=trim(isset($_POST['stateid'])?$_POST['stateid']:false);
 $countryid=trim(isset($_POST['countryid'])?$_POST['countryid']:false);
 $guardianid=trim(isset($_POST['guardianid'])?$_POST['guardianid']:false);
 $phone=trim(isset($_POST['phone'])?$_POST['phone']:false);
 $email=trim(isset($_POST['email'])?$_POST['email']:false);
 $passport=trim(isset($_POST['passport'])?$_POST['passport']:false);
 $username=trim(isset($_POST['username'])?$_POST['username']:false);
 $password=trim(isset($_POST['password'])?$_POST['password']:false);
 
 $session=trim(isset($_POST['session'])?$_POST['session']:false);
 $studenttype=trim(isset($_POST['studenttype'])?$_POST['studenttype']:false);
$camphoto=trim(isset($_POST['camphoto'])?$_POST['camphoto']:false);


 $password=Others::passwordconvert($password);
 
$udate=date("Y-m-d H:i:s");
$passportname="";
$passport=$_FILES["passport"]["name"];
//Getting Picture from the web Camera
if ($camphoto!="") {
  $target_dir = "../images/uploads/student/";
  copy('uploads/original/'.$camphoto, 'images/uploads/student/'.$camphoto);
   $passportname =$camphoto;
}

//Checking whether logo was uploaded(browsed)
  
   else if($passport!=""){
    $target_dir = "../images/uploads/student/";
    $passporttmp=$_FILES['passport']['tmp_name']; 
    $temp = explode(".", $_FILES["passport"]["name"]);
    $passportname =strtolower($surname).round(microtime(true)) . '.' . strtolower(end($temp));
 
    move_uploaded_file($_FILES["passport"]["tmp_name"], $target_dir . $passportname);

    }

$insertedrow=0;


$tablestudents=new insertTable;
$state=$tablestudents->insert_students($regno, $session, $studenttype, $surname, $othername, $levelid, $optid, $hdid, $sex, $dateofbirth, $address,  $lgaid, $stateid, $countryid, $guardianid,  $phone, $email, $passportname, $username, $password, $schoolhelp, $udate, $odate);
$display=$state['action'];
$insertedrow=$state['counting'];


$sql=$display.":: Insertion, affected records = 1";
}

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql&type=$type&levelid=$levelid&optionid=$optionid';
      </script>";
}

if($page==4) {
  if ($dashedit_d==1) {
 $stid=trim(isset($_POST['stid'])?$_POST['stid']:false);
 $passportold=trim(isset($_POST['passportold'])?$_POST['passportold']:false);
$regno=trim(isset($_POST['regno'])?$_POST['regno']:false);
 $surname=trim(isset($_POST['surname'])?$_POST['surname']:false);
 $othername=trim(isset($_POST['othername'])?$_POST['othername']:false);
 $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
$optid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);
 $oldoptionid=trim(isset($_POST['oldoptionid'])?$_POST['oldoptionid']:false);
 $hdid=trim(isset($_POST['hdid'])?$_POST['hdid']:false);
 $sex=trim(isset($_POST['sex'])?$_POST['sex']:false);
 $dateofbirth=trim(isset($_POST['dateofbirth'])?$_POST['dateofbirth']:false);
 $address=trim(isset($_POST['address'])?$_POST['address']:false);
 
 $lgaid=trim(isset($_POST['lgaid'])?$_POST['lgaid']:false);
 $stateid=trim(isset($_POST['stateid'])?$_POST['stateid']:false);
 $countryid=trim(isset($_POST['countryid'])?$_POST['countryid']:false);
 $guardianid=trim(isset($_POST['guardianid'])?$_POST['guardianid']:false);
 $phone=trim(isset($_POST['phone'])?$_POST['phone']:false);
 $email=trim(isset($_POST['email'])?$_POST['email']:false);
 $passport=trim(isset($_POST['passport'])?$_POST['passport']:false);
 $username=trim(isset($_POST['username'])?$_POST['username']:false);
 
 $sessionid=trim(isset($_POST['session'])?$_POST['session']:false);
 $studenttype=trim(isset($_POST['studenttype'])?$_POST['studenttype']:false);
 $camphoto=trim(isset($_POST['camphoto'])?$_POST['camphoto']:false);



$udate=date("Y-m-d H:m:s");
$passportname="";
 $passport=$_FILES["passport"]["name"];
//Getting picture from camera
if ($camphoto!="") {
  copy('../uploads/original/'.$camphoto, '../images/uploads/student/'.$camphoto);
   $passportname =$camphoto;
   $target_dir = "../images/uploads/student/";
   if (file_exists($target_dir.$passportold)) {
      unlink($target_dir.$passportold);
   }
  
}

//Checking whether logo was uploaded(browsed)
 else if($passport!=""){
  $target_dir = "../images/uploads/student/";
  $passporttmp=$_FILES['passport']['tmp_name']; 
  $temp = explode(".", $_FILES["passport"]["name"]);
  $passportname =strtolower($surname).round(microtime(true)) . '.' . end($temp);
  move_uploaded_file($_FILES["passport"]["tmp_name"], $target_dir. $passportname);
  @unlink($target_dir.$passportold);
  }else{
    $passportname=$passportold;
  }

/*$state=$tablestudents->update_students($regno, $sessionid, $studenttype, $surname, $othername, $levelid, $optid, $hdid, $sex, $dateofbirth, $address, $lgaid, $stateid, $countryid, $guardianid,  $phone, $email, $passportname, $username, $password, $schoolhelp, $udate, $stid);*/
$sql=('UPDATE students SET regno=:regno, sessionid=:sessionid, studenttype=:studenttype, surname=:surname, othername=:othername, levelid=:levelid, optid=:optid, housedivisionid=:hdid, sexid=:sex, dateofbirth=:dateofbirth, address=:address, lgaid=:lgaid, stateid=:stateid, countryid=:countryid, guardianid=:guardianid, phone=:phone, email=:email, passport=:passportname, username=:username, operatorid=:schoolhelp, udate=:udate WHERE stid=:stid');
    
    // Prepare statement
     $stmt = $mysqli->prepare($sql);
     $stmt1=$stmt->execute([':regno'=>$regno, ':sessionid'=>$sessionid, ':studenttype'=>$studenttype, ':surname'=>$surname, ':othername'=>$othername, ':levelid'=>$levelid, ':optid'=>$optid, ':hdid'=>$hdid, ':sex'=>$sex, ':dateofbirth'=>$dateofbirth, ':address'=>$address, ':lgaid'=>$lgaid, ':stateid'=>$stateid, ':countryid'=>$countryid, ':guardianid'=>$guardianid, ':phone'=>$phone, ':email'=>$email, ':passportname'=>$passportname, ':username'=>$username, ':schoolhelp'=>$schoolhelp, ':udate'=>$udate, ':stid'=>$stid]);

    if($stmt1){
        $state= "Success";
    } else {
        $state= "failed: " . $mysqli->error;
    }


$sql=$state.":: Update Made, affected records = 1";
 ;
//Updating Results Tables
if ($state=="Success") {
  if ($oldoptionid!=$optid) {
   
 
  //Getting the Current Session
  $sessmethod=$schoolhelpDH->allstudentedit('session', 'status', '1');
  foreach($sessmethod as $sessrecord){
    $sessionid1=trim($sessrecord['sessionid']);
  }

  //getting schoolid
  $deptmethod=$schoolhelpDH->allstudentedit('level', 'levelid', $levelid);
  foreach($deptmethod as $deptrecord){
    $departmentid=trim($deptrecord['departmentid']);
  }
  // Declaring of table names to update
    $score=trim("score".$departmentid);
    $result=trim("result".$departmentid);
    $positionresult=trim("positionresult".$departmentid);
    echo "<script>if(!confirm('Student`s scores on this current session (if there is) would be moved to the current Option/Arm, Do you want to continue?')) {
      window.location.href='?schoolhelp=$schoolhelp&sql=$sql';}
    </script>";
    $position=$tablestudents->result_dash($positionresult, 'sessionid', $sessionid1, 'stid', $stid, 'levelid', $levelid, 'optionid', $optid);
    $result1=$tablestudents->result_dash($result, 'sessionid', $sessionid1, 'stid', $stid, 'levelid', $levelid, 'optionid', $optid);
    $score1=$tablestudents->result_dash($score, 'sessionid', $sessionid1, 'stid', $stid, 'levelid', $levelid, 'optionid', $optid);
  
  }

}

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql&type=$type&levelid=$levelid&optionid=$optionid';
      </script>";
    }
}

if ($page==7) {
  if ($dashadd_d==1) {
   $file = $_FILES['export']['tmp_name'];
          $handle = fopen($file, "r");
          $c = 0;
          $n=0;
          while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
                    {
                      $n+=1;
                      if ($n>1) {
                      
          $regno = $filesop[0];
          $studenttype= $filesop[1];
          $surname = $filesop[2];
          $othername = $filesop[3];
          $sex = $filesop[4];
          $phone = $filesop[5];
          $country = $filesop[6];
          $state = $filesop[7];
          $lga= $filesop[8];
          $address = $filesop[9];
          $house = $filesop[10];
          
          $session = $filesop[11];
          $levelid = $filesop[12];
          $optid= $filesop[13];

          $email= $filesop[14];
          
          $dateofbirth = $filesop[15];    
          $username = $filesop[16];
          $password = $filesop[17];
          $password=Others::passwordconvert($password);

          $status = $filesop[18];

          $sql = "insert into students(regno, studenttype, surname, othername, sexid, phone, countryid, stateid, lgaid, address, housedivisionid, sessionid, levelid, optid, email,  dateofbirth, username, password, status) values ('$regno','$studenttype','$surname','$othername','$sex','$phone','$country','$state','$lga','$address','$house','$session','$levelid','$optid','$email','$dateofbirth','$username','$password','$status')";
          $stmt = $mysqli->prepare($sql);

                      if($stmt->execute()){
                        $c = $c + 1;
                      }


                      }
         
           }//End of while statement

            if($sql){
              $sql=$state.":: Insertion Made, affected records =".$c;

            echo "<script>
                    window.location.href='?schoolhelp=$schoolhelp&sql=$sql&type=$type&levelid=$levelid&optionid=$optionid';
                  </script>";
             } 
               else
                   {
                          echo "Sorry! Unable to impo.";
             }
           }
            echo "<script>
                    window.location.href='?schoolhelp=$schoolhelp';
                  </script>";

}
if ($page==6) {
  
  if ($dashdelete_d==1) {
   $stid=trim(isset($_GET['id'])?$_GET['id']:false);
 $passport=trim(isset($_GET['passport'])?$_GET['passport']:false);
  
    $state=$tablestudents->delete_dash('students', 'stid', $stid);
    $page="";
        $sql=$state.":: Deletion Made, affected records = 1";
         if ($state=="Success") {
                if ($passport!="") {
                   $target_dir = "../images/uploads/student/";
                        unlink($target_dir.$passport);
                }
                
            }
 
 }
        echo "<script>
                window.location.href='?schoolhelp=$schoolhelp&sql=$sql&type=$type&levelid=$levelid&optionid=$optionid';
              </script>";
    
}

if ($page==9) {
    if ($dashedit_d==1) {
    $stid=trim(isset($_GET['id'])?$_GET['id']:false);
    $password=Others::passwordconvert("password");
    $udate=date("Y-m-d H:m:s");
    $state= $tablestudents->passwordreset('students', 'stid', $stid, $password, $schoolhelp, $udate);
    $sql="";
     if($state=="Success"){
      $sql=$state.":: Password Reset Made, affected records = 1; He or She's Password is password";
     }
    }
    $page="";
          header("location:?schoolhelp=$schoolhelp&sql=$sql&type=$type&levelid=$levelid&optionid=$optionid");
}

if ($page==10) {
  if ($dashedit_d==1) {
    $stid=trim(isset($_GET['id'])?$_GET['id']:false);
    $accessvalue=trim(isset($_GET['accessvalue'])?$_GET['accessvalue']:false);
    $udate=date("Y-m-d H:m:s");
    $state= $tablestudents->accessgiving('students', 'stid', $stid, $accessvalue, $schoolhelp, $udate);
    $page="";
    $sql="";
     if($state=="Success"){
      $sql=$state.":: Request has taken Effect";
     }
   }
          header("location:?schoolhelp=$schoolhelp&sql=$sql&type=$type&levelid=$levelid&optionid=$optionid");
}


//this helps you to know the kind of driver you are using
//print_r(PDO::getAvailableDrivers());
 ?>
   <!-- page content -->
    <div class="right_col" role="main">
         

            <div class="row">
              <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12" style="margin-bottom: 20px;">
                <div class="x_panel">
                  <div class="x_title" style="background: #61dc42; padding-top: 10px; border-radius: 6px;">
                    <h3 id="caption" style="float:left;">Student</h3>
                    
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="btn btn-primary" href="../index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                      <li><a class="btn btn-default" href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-arrow-left" style="color:black"> Student Home</i></a>
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Action</a>
                        <ul class="dropdown-menu" role="menu">
                        <?php  if ($dashadd_d==1) {?>
                        <li><a href="?schoolhelp=<?php echo $schoolhelp; ?>&page=1&levelid=<?php echo $levelid; ?>&optionid=<?php echo $optionid; ?>&type=<?php echo $type; ?>"  ><i class="fa fa-plus"></i>  Add Student</a></li>

                        <li><a href="?schoolhelp=<?php echo $schoolhelp; ?>&page=8&levelid=<?php echo $levelid; ?>&optionid=<?php echo $optionid; ?>&type=<?php echo $type; ?>"  ><i class="fa fa-plus"></i>  Upload Multiple Students</a></li>
                        <?php } ?>
                        <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>&levelid=<?php echo $levelid; ?>&optionid=<?php echo $optionid; ?>&type=<?php echo $type; ?>"><i class="fa fa-book"></i> View</a></li>
                        <?php  if ($dashadd_d==1) {?>
                        <li ><a  href="#" onclick="funcdownload('<?php echo $schoolhelp; ?>','9','students','1','0')"><i class="fa fa-book"></i>  Download Template</a></li>
                        <?php } ?>
                        </ul>
                      </li>

                    </ul>

                    <div class="clearfix"></div>
                  </div>
                  <div style="color:#063" <?php if ($state=="failed") {?> style="color:red" <?php } ?> ><b><?php echo $sql; ?></b></div>

                

                  
                    <?php if ($page=="") {

                     
                      if ($type!="") {
                      
                      ?>
                      <div class="x_panel ">
                         <fieldset>
                        <legend style="color:#063"><?php echo $pagename; ?> Record</legend>
                    <table id="datatable-buttons"  style="width:100%" class="table table-striped table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th style="width:3%;">Passport</th>
                          <th>Reg No</th>
                          <th>Surname</th>
                          <th>Othername</th>
                          <th>Department</th>
                          <th>Level</th>
                          <th>Option</th>
                          <th>House</th>
                          <th>Sex</th>
                         
                          <th>State</th>
                      
                         <th>User<i class="fa fa-user"></i></th>
                        
                          <th style="width:5%;"><i class="fa fa-print" style="color:green"></i> Print</th>
                          <?php  if($dashdelete_d==1) { ?>
                           <th style="width:5%;"><i class="fa fa-trash" style="color:red"></i> Delete</th>
                          <?php } if($dashedit_d==1) { ?>
                         <th style="width:5%;"><i class="fa fa-edit" style="color:yellow"></i> Edit</th>
                          <?php } ?>
                          <th>Action<i class="fa fa-cog"></i></th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                             $optionname="";
                             $adminsurname="";
                             $adminothername="";
                             $levelname="";
                             $state="";
                             $sex="";
                             $hdname="";
                             $statename="";
                             $studentstaus=0;
                             $studentstaus=trim(isset($_GET['studentstatus'])?$_GET['studentstatus']:false);

                             if ($type==1) {
                                //Active Students
                              $records=$schoolhelpDH->allstudentedit3('students', 'status', 0, 'access', 1,  'levelid', $levelid);
                             }
                             elseif ($type==2) {
                              $records=$schoolhelpDH->allstudentedit4('students', 'status', 0, 'access', 1, 'levelid', $levelid, 'optid', $optionid); 
                             }else{
                              //All Students
                                $records=$schoolhelpDH->allstudentedit2('students', 'status', 0, 'access', 1); 
                              }

                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                              
                                $fieldvalue=trim($fieldrecord['operatorid']);
                                $hdid=trim($fieldrecord['housedivisionid']);
                                $sexname=Others::sexname($fieldrecord['sexid']);
                                $stateid=trim($fieldrecord['stateid']);
                               
                               //getting level name
                                $levelid= $fieldrecord['levelid'];
                                
                                $levelobject=$schoolhelpDH->allstudentedit('level', 'levelid',  $levelid);
                                if(is_array($levelobject)){
                                foreach($levelobject as $levelrecord){
                                  $levelname=$levelrecord['levelname'];
                                  $departmentid= $levelrecord['departmentid'];
                                  }
                                }

                                //Getting department name
                                   $deptobject=$schoolhelpDH->allstudentedit('department', 'did',  $departmentid);
                                   if(is_array($deptobject)){
                                      foreach($deptobject as $deptrecord){
                                        $deptname=$deptrecord['deptname'];
                                        
                                     }
                                    }
                              
                                //getting Option name
                               $optid= $fieldrecord['optid'];
                              
                                   $optionobject=$schoolhelpDH->allstudentedit('optiontable', 'optid',  $optid);
                                   if(is_array($optionobject)){
                                      foreach($optionobject as $optionrecord){
                                        $optionname=$optionrecord['optname'];
                                        
                                     }
                                    }
                              
                                $admindata=$schoolhelpDH->allstudentedit('adminpersons', 'adminid',  $fieldvalue);
                                 if(is_array($admindata)){
                                    foreach($admindata as $adminrecord){
                                      $adminsurname=$adminrecord['surname'];
                                      $adminothername=$adminrecord['othername'];
                                    }

                                  }
                                   $hddata=$schoolhelpDH->allstudentedit('housedivision', 'hdid',  $hdid);
                                 if(is_array($hddata)){
                                    foreach($hddata as $hdrecord){
                                      $hdname=$hdrecord['hdname'];
                                      
                                    }

                                  }

                                    $statedata=$schoolhelpDH->allstudentedit('states', 'id',  $stateid);
                                     if(is_array($statedata)){
                                        foreach($statedata as $staterecord){
                                          $statename=$staterecord['name'];
                                          
                                        }

                                  }
                                      if ($admintype==0) {
                                  $k+=1;
                                if ($departmentid==$logindepartmentid) {?>
                                
                                      <tr>
                                        <td><?php echo  $k; ?></td>
                                        <td style="width:3%"><img src="../images/uploads/student/<?php echo  trim($fieldrecord['passport']); ?>" class="img img-responsive img-rounded"></td>
                                        <td><?php echo  substr($fieldrecord['regno'],0, 12); ?></td>

                                        <td><?php echo  substr($fieldrecord['surname'],0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['othername'],0, 12); ?></td>
                                         <td><?php echo  substr($deptname,0, 12); ?></td>
                                        <td><?php echo  substr($levelname,0, 12); ?></td>
                                        <td><?php echo  substr($optionname,0, 12); ?></td>
                                        <td><?php echo substr($hdname,0, 12); ?></td>
                                        <td><?php echo  substr($sexname,0, 12); ?></td>
                                        
                                        <td><?php echo  substr($statename,0, 12); ?></td>
                                       
                                        
                                      <td ><span class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-cog"></i> Action<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu" style="list-style-type: none;" >
                                            
                                               <?php  if ($dashedit_d==1) { ?>
                                              <?php if ($fieldrecord['guardianid']==0 or $fieldrecord['guardianid']=="") { ?>
                                               <li ><a href="../student2guardian?page=1&schoolhelp=<?php echo $schoolhelp; ?>">Assign Guardian</a></li>
                                             <?php } ?>
                                            
                                             <li onclick="funcresetpasswordm('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['stid']; ?>','<?php echo $optionid; ?>','<?php echo $fieldrecord['levelid']; ?>','<?php echo $type; ?>');"><a href="#">Reset Password</a></li>
                                             <?php if ($fieldrecord['access']==0) {?>
                                            <li onclick="funcactivate('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['stid']; ?>', '1');"><a href="#">De-Activate</a></li>
                                            <?php } else{ ?>
                                            <li onclick="funcactivate('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['stid']; ?>', '0');"><a href="#">Activate</a></li>
                                            <?php }
                                          }
                                             ?>
                                          
                                          </ul>
                                          </span>

                                        </td>
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['stid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                          <?php  if ($dashdelete_d==1) { ?>
                                          <td><button onclick="funcdeletestudent('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['stid']; ?>','<?php echo $fieldrecord['passport']; ?>')"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
                                          <?php } if ($dashedit_d==1) { ?>
                                          <td><button onclick="funceditstudent('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['stid']; ?>')"><center><i class="fa fa-edit" style="color:yellow; font-size:2em"></i></center></button></td>
                                         <?php }  ?>
                                           <td ><span class="btn-group">
                                            <center><button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-user"></i> Details<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu">
                                            <li ><span>Update by</span> : <?php echo  $adminsurname." ".$adminothername ; ?></li>
                                            <li><span>Upate Date</span> : <?php echo  $fieldrecord['udate']; ?></li>
                                            <li><span>Initial Date</span> : <?php echo  $fieldrecord['odate']; ?></li>
                                            <li class="schoolhelp"><b>Login Status</b></li>
                                            <li><span>login Date</span> : <?php echo  $fieldrecord['logintime']; ?></li>
                                            <li><span>logout Date</span> : <?php echo  $fieldrecord['logouttime']; ?></li>
                                          </ul>
                                          </center></span>

                                        </td>

                                       
                                      </tr>
                                      <?php }
                                    }else{ $k+=1; ?>
                                    <tr>
                                        <td><?php echo  $k; ?></td>
                                        <td style="width:10%"><img src="../images/uploads/student/<?php echo trim($fieldrecord['passport']); ?>" class="img img-responsive img-rounded"></td>
                                        <td><?php echo  substr($fieldrecord['regno'],0, 12); ?></td>

                                        <td><?php echo  substr($fieldrecord['surname'],0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['othername'],0, 12); ?></td>
                                        <td><?php echo  substr($deptname,0, 12); ?></td>
                                        <td><?php echo  substr($levelname,0, 12); ?></td>
                                        <td><?php echo  substr($optionname,0, 12); ?></td>
                                        <td><?php echo substr($hdname,0, 12); ?></td>
                                        <td><?php echo  substr($sexname,0, 12); ?></td>
                                        
                                        <td><?php echo  substr($statename,0, 12); ?></td>
                                       
                                        
                                      <td ><span class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-cog"></i> Action<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu" style="list-style-type: none">
                                            <center>
                                              <?php if ($fieldrecord['guardianid']==0 or $fieldrecord['guardianid']=="") { ?>
                                               <li ><a href="student2guardian?page=1&schoolhelp=<?php echo $schoolhelp; ?>">Assign Guardian</a></li>
                                             <?php } ?>
                                            
                                              
                                             <li onclick="funcresetpasswordm('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['stid']; ?>','<?php echo $optionid; ?>','<?php echo $fieldrecord['levelid']; ?>','<?php echo $type; ?>');"><a href="#">Reset Password</a></li>
                                             <?php if ($fieldrecord['access']==0) {?>
                                            <li onclick="funcactivatem('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['stid']; ?>', '1','<?php echo $optionid; ?>','<?php echo $fieldrecord['levelid']; ?>','<?php echo $type; ?>');"><a href="#">De-Activate</a></li>
                                            <?php } else{ ?>
                                            <li onclick="funcactivatem('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['stid']; ?>', '0', '<?php echo $optionid; ?>','<?php echo $fieldrecord['levelid']; ?>','<?php echo $type; ?>');"><a href="#">Activate</a></li>
                                            <?php } ?>
                                          </center>
                                          </ul>
                                          </span>

                                        </td>
                                         <td><button onclick="funcprintm('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['stid']; ?>','<?php echo $optionid; ?>','<?php echo $fieldrecord['levelid']; ?>','<?php echo $type; ?>');"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                       
                                         <td><button onclick="funcdeletestudentm('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['stid']; ?>','<?php echo $fieldrecord['passport']; ?>','<?php echo $optionid; ?>','<?php echo $fieldrecord['levelid']; ?>','<?php echo $type; ?>')"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
                                          <td><button onclick="funceditstudentm('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['stid']; ?>', '<?php echo $optionid; ?>','<?php echo $fieldrecord['levelid']; ?>','<?php echo $type; ?>')"><center><i class="fa fa-edit" style="color:yellow; font-size:2em"></i></center></button></td>
                                           <td ><span class="btn-group">
                                            <center><button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-user"></i> Details<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu">
                                            <li ><span>Update by</span> : <?php echo  $adminsurname." ".$adminothername ; ?></li>
                                            <li><span>Upate Date</span> : <?php echo  $fieldrecord['udate']; ?></li>
                                            <li><span>Initial Date</span> : <?php echo  $fieldrecord['odate']; ?></li>
                                            <li class="schoolhelp"><b>Login Status</b></li>
                                            <li><span>login Date</span> : <?php echo  $fieldrecord['logintime']; ?></li>
                                            <li><span>logout Date</span> : <?php echo  $fieldrecord['logouttime']; ?></li>
                                          </ul>
                                          </center></span>

                                        </td>

                                       
                                      </tr>
                                      <?php } ?>
                             <?php }
                              }
                             ?>
                        
                      </tbody>
                    </table>
                   </fieldset>
                    </div>
                    <?php }
                    } ?>

                    <?php if($page==1) {?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Add <?php echo $pagename; ?></legend>
                      <form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>&levelid=<?php echo $levelid; ?>&optionid=<?php echo $optionid; ?>&type=<?php echo $type; ?>" method="POST"  id="formstid"  class="form-horizontal form-label-left" >
                      <input name="camphoto" id="camphoto" value="" class="form-control col-md-7 col-xs-12" type="hidden">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Registration No.<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="regno" required="required" name="regno" class="form-control col-md-7 col-xs-12" onblur="return updatevalidity('students', 'regno', this.value, 'inserting', $(this).attr('id'));">
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Surname<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="surname" class="form-control col-md-7 col-xs-12" type="text" name="surname" required="required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Othername<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="othername" class="form-control col-md-7 col-xs-12" type="text" name="othername" required="required">
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Student Type</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="studenttype" class="form-control col-md-7 col-xs-12" type="text" name="studenttype">
                            <option value="">-Select Student Type-</option>
                             <option value="1">Daytime|Partime</option>
                             <option value="2">Boarder|Full Time</option>
                          </select>
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="session" class="control-label col-md-3 col-sm-3 col-xs-12">Session</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="session" id="session" class="form-control col-md-7 col-xs-12" >
                             <option>--Select Session--</option>
                            <?php $record=$schoolhelpDH->allstudent('session', 'sessionid',  'ASC'); 
                            foreach($record as $records){
                            ?>
                            <option value="<?php echo $records['sessionid'] ?>" <?php if ($records['status']==1){ ?> selected="selected" <?php } ?>><?php echo $records['sessionlow'].'/'.$records['sessionhigh'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="level" class="control-label col-md-3 col-sm-3 col-xs-12">Level|Class</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="levelid" id="levelid" class="form-control col-md-7 col-xs-12"  onchange="retrieveselection1('optiontable', 'levelid', this.value, 0, 0, 'retrieveselection4', 'retrieveselection4');" required="required">
                             <option>--Select Level|Class--</option>
                            <?php 
                            $record=$schoolhelpDH->allstudent('level', 'levelid', 'ASC');
                            if (is_array($record)) {
                            foreach($record as $records){
                              $did=trim($records['departmentid']);
                              $record1=$schoolhelpDH->allstudentedit('department', 'did', $did);
                              if (is_array($record1)) {
                              foreach($record1 as $record1s){
                                $deptname=$record1s['deptname'];
                              }
                            }

                          if ($admintype==0) {
                            if ($logindepartmentid==$did) {
                            ?>
                             <option value="<?php echo $records['levelid'] ?>"><?php echo $records['levelname']." => ".$deptname; ?></option>
                           <?php }
                              }
                           else{ ?>
                            <option value="<?php echo $records['levelid'] ?>"><?php echo $records['levelname']." => ".$deptname; ?></option>
                            <?php 
                                  }
                              } 
                            }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div id="retrieveselection4">
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Option|Group|Arm</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="optionid" id="optionid" class="form-control col-md-7 col-xs-12" type="text"  data-toggle="tooltip" data-placement="top" title="Make sure Level|Class is selected" required="required">
                            <option value="">-Select Option|Group|Arm-</option>

                          </select>
                        </div>
                      </div>
                    </div>

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">House</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <select name="hdid" id="hdid" class="form-control col-md-7 col-xs-12" required="required">
                             <option value="">--Select House|Division--</option>
                            <?php 
                            $record=$schoolhelpDH->allstudent('housedivision', 'hdid', 'ASC');
                            if (is_array($record)) {
                            foreach($record as $records){
                             
                            ?>
                            <option value="<?php echo $records['hdid'] ?>"><?php echo $records['hdname']; ?></option>
                            <?php } 
                            }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Sex<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="sex" class="form-control col-md-7 col-xs-12"" name="sex" required="required">
                            <option value="">--select--</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="dateofbirth" class="form-control col-md-7 col-xs-12" type="date" name="dateofbirth" required="required">
                        </div>
                      </div>
                      

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Country<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <select id="countryid" class="form-control col-md-7 col-xs-12" name="countryid" required="required" onchange="retrieveselection1('states', 'country_id', this.value, 0, 0, 'state', 'state');">
                             <option value="">--Select Country--</option>
                           <?php //Getting title table
                               $SHcountry=$schoolhelpDH->allstudent('countries', 'id', 'ASC'); 
                            foreach($SHcountry as $countryrecords){
                            ?>
                            <option value="<?php echo $countryrecords['id']; ?>" ><?php echo $countryrecords['name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      <div id="state">
                      <div class="form-group">
                        <label for="state" class="control-label col-md-3 col-sm-3 col-xs-12">State</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="stateid" class="form-control col-md-7 col-xs-12" type="text" name="state" required="required" data-toggle="tooltip" data-placement="top" title="Make sure country is selected">
                            <option value="">--Select State--</option>
                           
                          </select>
                        </div>
                      </div>
                    </div>

                     <div id="lga">
                      <div class="form-group">
                        <label for="lga" class="control-label col-md-3 col-sm-3 col-xs-12">L.G.A</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="lgaid" class="form-control col-md-7 col-xs-12" type="text" name="lgaid" required="required" data-toggle="tooltip" data-placement="top" title="Make sure State is selected">
                            <option value="">--Select LGA--</option>
                           
                          </select>
                        </div>
                      </div>
                    </div>

                       <div class="form-group">
                        <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">Residential Address<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="address" class="form-control col-md-7 col-xs-12"  name="address" required="required"></textarea>
                        </div>
                      </div>

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="phone" class="form-control col-md-7 col-xs-12" type="number" name="phone">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="email" class="form-control col-md-7 col-xs-12" type="text" name="email" >
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="guardianname">Guardian</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         
                       <input type="text" list="guardiannames" id="guardianname" class="form-control col-md-7 col-xs-12" placeholder="Please type and select guardian name " onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'guardianid');">

                        <datalist id="guardiannames">

                            <?php
                             $records=$schoolhelpDH->allstudent('guardian', 'gid', 'ASC');
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                           
                            ?>
                            <option data-value="<?php echo $fieldrecord['gid']; ?>"  value="<?php echo $fieldrecord['surname'].' '.$fieldrecord['othername']; ?>">
                            <?php } 
                          }?>
                           </datalist>
                           <input name="guardianid" id="guardianid" class="form-control col-md-7 col-xs-12" type="hidden"  >
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Username<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="username" class="form-control col-md-7 col-xs-12" type="text" name="username" required="required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Password<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="text" class="form-control col-md-7 col-xs-12" type="password" name="password" value="password" required="required">
                        </div>
                      </div>
                      
                      
                      

                      <div class="form-group">

                         
                        <label for="passport" class="control-label col-md-3 col-sm-3 col-xs-12">Passport</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <img src="" height="100" width="100" id="showimage"/>
                          <input name="passport" id="passport" type="file" class="form-control col-md-7 col-xs-12"  onchange="readURL(this, $(this).attr('id'),  'showimage');">

                          <div class="col-md-12 col-sm-12 col-xs-12">
                                                          
                          <div class="col-md-4 ">
                            <img src="../images/webcam.png" class="camTop" style="position:relative"  id="webcamicon" onclick="$('#camera').toggle(); $('#photos').toggle();" data-toggle="tooltip" data-placement="top" title="Make use of your system camera if it is available" style="width:40%" />
                          </div>
                          
                           <div class="col-md-4 hidden" id="photos">
                           
                          </div>
                          
                        </div>

                        </div>
                      </div>
                      
                     <p id="error1" style="display:none; color:#FF0000;">
                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                        </p>
                        <p id="error2" style="display:none; color:#FF0000;">
                        Maximum File Size Limit is 1MB.
                        </p>
                      <div id="msg" ></div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                  </fieldset>
                 </div>
                 <?php } ?>

                  <?php if($page==3) {
                    $stid=trim(isset($_GET['id'])?$_GET['id']:false);

                    $optionname="";
                             $adminsurname="";
                             $adminothername="";
                             $levelname="";
                             $state="";
                             $sex="";
                             $k=0;
                             $guardiansurname="";
                             $guardianothername="";
                              $records=$schoolhelpDH->allstudentedit('students', 'stid', $stid);
                              if (isset($records)) {
                               
                              foreach($records as $fieldrecord){
                                $k+=1;
                                $fieldvalue=trim($fieldrecord['operatorid']);
                                $hdid=trim($fieldrecord['housedivisionid']);
                                $sexname=Others::sexname($fieldrecord['sexid']);
                                $stateid=trim($fieldrecord['stateid']);
                               $countryid=trim($fieldrecord['countryid']);
                               $lgaid=trim($fieldrecord['lgaid']);
                               //getting level name
                                $levelid= $fieldrecord['levelid'];
                                $optid=trim($fieldrecord['optid']);
                                $guardianid=trim($fieldrecord['guardianid']);
                              
                                $levelobject=$schoolhelpDH->allstudentedit('level', 'levelid',  $levelid);
                                if(is_array($levelobject)){
                                foreach($levelobject as $levelrecord){
                                  $levelname=$levelrecord['levelname'];
                                  }
                                }
                              
                               

                                
                                $admindata=$schoolhelpDH->allstudentedit('adminpersons', 'adminid',  $fieldvalue);
                                 if(is_array($admindata)){
                                    foreach($admindata as $adminrecord){
                                      $adminsurname=$adminrecord['surname'];
                                      $adminothername=$adminrecord['othername'];
                                    }

                                  }
                                   $hddata=$schoolhelpDH->allstudentedit('housedivision', 'hdid',  $hdid);
                                 if(is_array($hddata)){
                                    foreach($hddata as $hdrecord){
                                      $hdname=$hdrecord['hdname'];
                                      
                                    }

                                  }

                                    $statedata=$schoolhelpDH->allstudentedit('states', 'id',  $stateid);
                                 if(is_array($statedata)){
                                    foreach($statedata as $staterecord){
                                      $statename=$staterecord['name'];
                                      
                                    }
                                  }
                                       $lgadata=$schoolhelpDH->allstudentedit('lga', 'lgaid',  $lgaid);
                                 if(is_array($lgadata)){
                                    foreach($lgadata as $lgarecord){
                                      $lganame=$lgarecord['name'];
                                      
                                    }
                                  }

                                        $countrydata=$schoolhelpDH->allstudentedit('countries', 'id',  $countryid);
                                 if(is_array($countrydata)){
                                    foreach($countrydata as $countryrecord){
                                      $countryname=$countryrecord['name'];
                                      
                                    }

                                  }

                                  $guardianrecords=$schoolhelpDH->allstudentedit('guardian', 'gid', $guardianid);
                              if (is_array($guardianrecords)) {
                                foreach($guardianrecords as $guardianrecord){
                                  $guardiansurname=$guardianrecord['surname'];
                                   $guardianothername=$guardianrecord['othername'];
                                }
                              }
                    ?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Edit <?php echo $pagename; ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>&levelid=<?php echo $levelid; ?>&optionid=<?php echo $optionid; ?>&type=<?php echo $type; ?>" method="POST"  id="formstid"  class="form-horizontal form-label-left" >
                    <input name="oldlevelid" id="oldlevelid" class="form-control col-md-7 col-xs-12" type="hidden"  value="<?php echo $levelid; ?>">
                    <input name="oldoptionid" id="oldoptionid" class="form-control col-md-7 col-xs-12" type="hidden"  value="<?php echo $optid; ?>">
                      <input name="stid" id="stid" value="<?php echo $stid; ?>" class="form-control col-md-7 col-xs-12" type="hidden">
                      <input name="camphoto" id="camphoto" value="" class="form-control col-md-7 col-xs-12" type="hidden">
                     <input name="passportold" id="passportold" value="<?php echo $fieldrecord['passport']; ?>" class="form-control col-md-7 col-xs-12" type="hidden">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Registration No.<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="regno" type="text" id="regno" required="required"  class="form-control col-md-7 col-xs-12" onblur="return updatevalidity('students', 'regno', this.value, 'inserting', $(this).attr('id'));" value="<?php echo $fieldrecord['regno']; ?>">
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Surname<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="surname" class="form-control col-md-7 col-xs-12" type="text" name="surname" required="required" value="<?php echo $fieldrecord['surname']; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Othername<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="othername" class="form-control col-md-7 col-xs-12" type="text" name="othername" required="required" value="<?php echo $fieldrecord['othername']; ?>">
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Student Type</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="studenttype" class="form-control col-md-7 col-xs-12" type="text" name="studenttype">
                            <option value="">-Select Student Type-</option>
                             <option value="1" <?php if ($fieldrecord['studenttype']==1){ ?> selected="selected" <?php } ?>>Daytime|Partime</option>
                             <option value="2" <?php if ($fieldrecord['studenttype']==2){ ?> selected="selected" <?php } ?>>Boarder|Full Time</option>
                          </select>
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="session" class="control-label col-md-3 col-sm-3 col-xs-12">Session</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="session" id="session" class="form-control col-md-7 col-xs-12" >
                             <option>--Select Session--</option>
                            <?php $record=$schoolhelpDH->allstudent('session', 'sessionid',  'ASC'); 
                             if (is_array($record)) {
                            foreach($record as $records){
                            ?>
                            <option value="<?php echo $records['sessionid'] ?>" <?php if ($records['sessionid']==$fieldrecord['sessionid']){ ?> selected="selected" <?php } ?>><?php echo $records['sessionlow'].'/'.$records['sessionhigh'] ?></option>
                            <?php } 
                          }?>
                          </select>
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="level" class="control-label col-md-3 col-sm-3 col-xs-12">Level|Class</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="levelid" id="levelid" class="form-control col-md-7 col-xs-12"  onchange="retrieveselection1('optiontable', 'levelid', this.value, 0, 0, 'retrieveselection4', 'retrieveselection4');" required="required">
                             <option>--Select Level|Class--</option>
                            <?php 
                            $record=$schoolhelpDH->allstudent('level', 'levelid', 'ASC');
                            if (is_array($record)) {
                            foreach($record as $records){
                              $did=trim($records['departmentid']);
                              $record1=$schoolhelpDH->allstudentedit('department', 'did', $did);
                              if (is_array($record1)) {
                              foreach($record1 as $record1s){
                                $deptname=$record1s['deptname'];
                              }
                            }

                          if ($admintype==0) {
                            if ($logindepartmentid==$did) {
                            ?>
                             <option value="<?php echo $records['levelid'] ?>" <?php if ($records['levelid']==$fieldrecord['levelid']){ ?> selected="selected" <?php } ?>><?php echo $records['levelname']." => ".$deptname; ?></option>
                           <?php }
                              }
                           else{ ?>
                            <option value="<?php echo $records['levelid'] ?>" <?php if ($records['levelid']==$fieldrecord['levelid']){ ?> selected="selected" <?php } ?>><?php echo $records['levelname']." => ".$deptname; ?></option>
                            <?php 
                                  }
                              } 
                            }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div id="retrieveselection4">
                            <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Option|Arm|Group<span class="required">*</span>
                                   </label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                     <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
                                 <select  name="optionid" id="optionid" required="required"  class="form-control col-md-6 col-xs-12" >
                                   <option value="">--Select Option|Arm|Group--</option>
                                     <?php  $retrievedata=$schoolhelpDH->allstudentedit('optiontable', 'levelid', $levelid);
                                        if (is_array($retrievedata)) {
                                        ?> 
                                        <?php
                                          foreach($retrievedata as $field){
                                        ?>
                                              <option value="<?php echo $field['optid']; ?>" <?php if ($field['optid']==$fieldrecord['optid']){ ?> selected="selected" <?php } ?>><?php echo $field['optname']; ?></option>
                                        <?php
                                             }

                                        }?>
                                              </select>
                                            </div>
                                          </div>
                    </div>

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">House</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <select name="hdid" id="hdid" class="form-control col-md-7 col-xs-12" required="required">
                             <option value="">--Select House|Division--</option>
                            <?php 
                            $record=$schoolhelpDH->allstudent('housedivision', 'hdid', 'ASC');
                            if (is_array($record)) {
                            foreach($record as $records){
                             
                            ?>
                            <option value="<?php echo $records['hdid'] ?>" <?php if ($records['hdid']==$fieldrecord['housedivisionid']){ ?> selected="selected" <?php } ?>><?php echo $records['hdname']; ?></option>
                            <?php } 
                            }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Sex<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="sex" class="form-control col-md-7 col-xs-12"" name="sex" required="required">
                            <option value="">--select--</option>
                             <option value="1" <?php if ($fieldrecord['sexid']==1){ ?> selected="selected" <?php } ?>>Male</option>
                             <option value="2" <?php if ($fieldrecord['sexid']==2){ ?> selected="selected" <?php } ?>>Female</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Date of Birth<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="dateofbirth" class="form-control col-md-7 col-xs-12" type="date" name="dateofbirth" required="required" value="<?php echo $fieldrecord['dateofbirth']; ?>">
                        </div>
                      </div>
                      

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Country<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <select id="countryid" class="form-control col-md-7 col-xs-12" name="countryid" required="required" onchange="retrieveselection1('states', 'country_id', this.value, 0, 0, 'state', 'state');">
                             <option value="">--Select Country--</option>
                           <?php //Getting title table
                               $SHcountry=$schoolhelpDH->allstudent('countries', 'id', 'ASC'); 
                              if (is_array($SHcountry)) {
                             
                            foreach($SHcountry as $countryrecords){
                            ?>
                            <option value="<?php echo $countryrecords['id']; ?>" <?php if ($countryrecords['id']==$countryid){ ?> selected="selected" <?php } ?> ><?php echo $countryrecords['name']; ?></option>
                            <?php } 

                              }?>
                          </select>
                        </div>
                      </div>

                      <div id="state">
                          <div class="form-group">
                                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">State<span class="required">*</span>
                                 </label>
                                 <div class="col-md-6 col-sm-6 col-xs-12">
                                   <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
                               <select  name="stateid" id="stateid" required="required"  class="form-control col-md-6 col-xs-12"  onchange="retrieveselection1('lga', 'stateid', this.value, 0, 0, 'lga', 'lga');">
                                 <option value="">--Select State--</option>
                      
                        <?php  $retrievedata=$schoolhelpDH->allstudentedit('states', 'country_id', $countryid);
                        if (is_array($retrievedata)) {
                      
                          foreach($retrievedata as $field){
                        ?>
                              <option value="<?php echo $field['id']; ?>" <?php if ($field['id']==$stateid){ ?> selected="selected" <?php } ?> ><?php echo $field['name']; ?></option>
                        <?php
                            }
                          } ?>
                              </select>
                            </div>
                          </div>
                    </div>

                     <div id="lga">
                     
                   <div class="form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">LGA<span class="required">*</span>
                             </label>
                                     <div class="col-md-6 col-sm-6 col-xs-12">
                                       <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
                                   <select name="lgaid" id="lgaid" required="required"  class="form-control col-md-6 col-xs-12"  >
                                     <option value="">--Select LGA--</option>
                            <?php  $retrievedata=$schoolhelpDH->allstudentedit('lga', 'stateid', $stateid);
                            if (is_array($retrievedata)) {
                              foreach($retrievedata as $field){
                            ?>
                                  <option value="<?php echo $field['lgaid']; ?>"  <?php if ($field['lgaid']==$lgaid){ ?> selected="selected" <?php } ?> ><?php echo $field['name']; ?></option>
                            <?php
                                } 
                              }?>
                          </select>
                        </div>
                      </div>
                                      </div>

                       <div class="form-group">
                        <label for="address" class="control-label col-md-3 col-sm-3 col-xs-12">Residential Address<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="address" class="form-control col-md-7 col-xs-12"  name="address" required="required"><?php echo $fieldrecord['address']; ?></textarea>
                        </div>
                      </div>

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="phone" class="form-control col-md-7 col-xs-12" type="number" name="phone" value="<?php echo $fieldrecord['phone']; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="email" class="form-control col-md-7 col-xs-12" type="text" name="email"  value="<?php echo $fieldrecord['email']; ?>">
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="guardianname">Guardian</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                       <input type="text" list="guardiannames" id="guardianname" class="form-control col-md-7 col-xs-12" value="<?php echo $guardiansurname.' '.$guardianothername; ?>" placeholder="Please type and select guardian name " onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'guardianid');">

                        <datalist id="guardiannames">

                            <?php
                             $guardianrecords=$schoolhelpDH->allstudent('guardian', 'gid', 'ASC');
                              if (is_array($guardianrecords)) {
                               
                              foreach($guardianrecords as $guardianrecord){
                           
                            ?>
                            <option data-value="<?php echo $guardianrecord['gid']; ?>"  value="<?php echo $guardianrecord['surname'].' '.$guardianrecord['othername']; ?>">
                            <?php } 
                          }?>
                           </datalist>
                           <input name="guardianid" id="guardianid" class="form-control col-md-7 col-xs-12" type="hidden"   value="<?php echo $guardianid; ?>" >
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Username<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="username" class="form-control col-md-7 col-xs-12" type="text" name="username" required="required"  value="<?php echo $fieldrecord['username']; ?>">
                        </div>
                      </div>
                      
                      
                      <div class="form-group">

                         
                        <label for="photo" class="control-label col-md-3 col-sm-3 col-xs-12">Passport</label>
                        <div class="col-md-6 col-sm-6 col-xs-12" >
                          <img <?php if ($fieldrecord['passport']!="") {?> src="../images/uploads/student/<?php echo $fieldrecord['passport']; ?>" style="display: block"<?php }  ?> height="100" width="100"   id="showimage"  />
                          <input name="passport" id="passport" type="file" class="form-control col-md-7 col-xs-12" onchange="readURL(this, $(this).attr('id'),  'showimage');">

                          <div class="col-md-12 col-sm-12 col-xs-12">
                                                          
                          <div class="col-md-4 ">
                            <img src="../images/webcam.png" class="camTop" style="position:relative"  id="webcamicon" onclick="$('#camera').toggle(); $('#photos').toggle();" data-toggle="tooltip" data-placement="top" title="Make use of your system camera if it is available" style="width:40%" />
                          </div>
                          
                           <div class="col-md-4 hidden" id="photos">
                           
                          </div>
                          
                        </div>

                        </div>
                      </div>
                      
                     <p id="error1" style="display:none; color:#FF0000;">
                        Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
                        </p>
                        <p id="error2" style="display:none; color:#FF0000;">
                        Maximum File Size Limit is 1MB.
                        </p>
                      <div id="msg" ></div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Update</button>
                        </div>
                      </div>

                    </form>
                  </div>
                  </fieldset>
                 </div>
                <?php }//closing loop 
                }//Closing Array Check 
              }//closing page ?>

                <?php if ($page==5) {
                  $stid=trim(isset($_GET['id'])?$_GET['id']:false);

                     $optionname="";
                             $adminsurname="";
                             $adminothername="";
                             $levelname="";
                             $state="";
                             $sex="";
                             $countryname="";
                             $lganame="";
                             $statename="";
                             $hdname="";
                             $k=0;

                              $records=$schoolhelpDH->allstudentedit('students', 'stid', $stid);
                              if (isset($records)) {
                               
                              foreach($records as $fieldrecord){
                                $k+=1;
                                $fieldvalue=trim($fieldrecord['operatorid']);
                                $hdid=trim($fieldrecord['housedivisionid']);
                                $sexname=Others::sexname($fieldrecord['sexid']);
                                $stateid=trim($fieldrecord['stateid']);
                               $countryid=$stateid=trim($fieldrecord['countryid']);
                               $lgaid=trim($fieldrecord['lgaid']);
                               //getting level name
                                $levelid= $fieldrecord['levelid'];
                                $optid=trim($fieldrecord['optid']);
                                $guardianid=trim($fieldrecord['guardianid']);
                                $levelobject=$schoolhelpDH->allstudentedit('level', 'levelid',  $levelid);
                                if(is_array($levelobject)){
                                foreach($levelobject as $levelrecord){
                                  $levelname=$levelrecord['levelname'];
                                  }
                                }
                              
                                //getting Option name
                               $optid= $fieldrecord['optid'];
                              
                                   $optionobject=$schoolhelpDH->allstudentedit('optiontable', 'optid',  $optid);
                                   if(is_array($optionobject)){
                                      foreach($optionobject as $optionrecord){
                                        $optionname=$optionrecord['optname'];
                                        
                                     }
                                    }
                              

                                
                                $admindata=$schoolhelpDH->allstudentedit('adminpersons', 'adminid',  $fieldvalue);
                                 if(is_array($admindata)){
                                    foreach($admindata as $adminrecord){
                                      $adminsurname=$adminrecord['surname'];
                                      $adminothername=$adminrecord['othername'];
                                    }

                                  }
                                   $hddata=$schoolhelpDH->allstudentedit('housedivision', 'hdid',  $hdid);
                                 if(is_array($hddata)){
                                    foreach($hddata as $hdrecord){
                                      $hdname=$hdrecord['hdname'];
                                      
                                    }

                                  }

                                    $statedata=$schoolhelpDH->allstudentedit('states', 'id',  $stateid);
                                 if(is_array($statedata)){
                                    foreach($statedata as $staterecord){
                                      $statename=$staterecord['name'];
                                      
                                    }
                                  }
                                       $lgadata=$schoolhelpDH->allstudentedit('lga', 'lgaid',  $lgaid);
                                 if(is_array($lgadata)){
                                    foreach($lgadata as $lgarecord){
                                      $lganame=$lgarecord['name'];
                                      
                                    }
                                  }

                                        $countrydata=$schoolhelpDH->allstudentedit('countries', 'id',  $countryid);
                                 if(is_array($countrydata)){
                                    foreach($countrydata as $countryrecord){
                                      $countryname=$countryrecord['name'];
                                      
                                    }
                                       $guardianrecords=$schoolhelpDH->allstudentedit('guardian', 'gid', $guardianid);
                              if (is_array($guardianrecords)) {
                                foreach($guardianrecords as $guardianrecord){
                                  $guardiansurname=$guardianrecord['surname'];
                                   $guardianothername=$guardianrecord['othername'];
                                }
                              }

                                  }
                  ?>
                    <div class="x_panel" >
                  <div class="x_title">
                    <h3 class="schoolhelp">Student Details </h3>
                    <ul class="nav navbar-right panel_toolbox" id="panel_toolbox">
                      
                      <li class="pull-right"><a href="?schoolhelp=<?php echo $schoolhelp; ?>&levelid=<?php echo $levelid; ?>&optionid=<?php echo $optionid; ?>&type=<?php echo $type; ?>" class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" id="printrecord">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h3>
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $fieldrecord['surname']; ?>.
                                          <small class="pull-right">Date: <?php echo $odate; ?></small>
                                      </h3>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                       
                       
                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col">
                         <img id="userimage" <?php if ($fieldrecord['passport']!="") {?> style="display: block" src="images/uploads/student/<?php echo $fieldrecord['passport'] ?>" <?php } ?> class="img img-responsive img-thumbnail" >
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col" align="right">
                          <h3><b>Admin Details:</b></h3>
                          <address>
                                          Updated by: <strong><?php echo $adminsurname ." ".$adminothername; ?></strong>
                                          <br><b>Date: </b><?php echo $fieldrecord['udate']; ?></strong>
                                          <br><b>Initial Insertion Date: </b><?php echo $fieldrecord['odate']; ?>
                                          
                                      </address>
                        </div>

                      
                      </div>
                      <!-- /.row -->


                   

                      <div class="row">
                       
                        <div class="col-xs-12">
                          <hr>
                          <center><p class="lead schoolhelpcolor"><b><?php echo $fieldrecord['surname']; ?> Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Surname:</th>
                                  <td><?php echo $fieldrecord['surname']; ?></td>
                                </tr>
                                <tr>
                                  <th>Othername:</th>
                                  <td><?php echo $fieldrecord['othername']; ?></td>
                                </tr>
                                <tr>
                                  <th>Registration/Service No:</th>
                                  <td><?php echo $fieldrecord['regno']; ?></td>
                                </tr>
                                 <tr>
                                  <th>Student Type</th>
                                  <td><?php echo  $studenttypename=Others::studenttypename($fieldrecord['studenttype']); ?></td>
                                </tr>
                                <tr>
                                  <th>Level(Class)</th>
                                  <td><?php echo  $levelname; ?></td>
                                </tr>
                                <tr>
                                  <th>Option(Arm or Group)</th>
                                  <td><?php echo  $optionname; ?></td>
                                </tr>
                                 <tr>
                                  <th>House/Division</th>
                                  <td><?php echo  $hdname; ?></td>
                                </tr>
                                 <tr>
                                  <th>Sex:</th>
                                  <td><?php echo $sexname ?></td>
                                </tr>
                                 <tr>
                                  <th>Country:</th>
                                  <td><?php echo $countryname ?></td>
                                </tr>
                                 <tr>
                                  <th>State:</th>
                                  <td><?php echo $statename ?></td>
                                </tr>
                                 <tr>
                                  <th>L.G.A:</th>
                                  <td><?php echo $lganame ?></td>
                                </tr>
                                <tr>
                                  <th>Address:</th>
                                  <td><?php echo $fieldrecord['address']; ?></td>
                                </tr>

                                 <tr>
                                  <th>Phone:</th>
                                  <td><?php echo $fieldrecord['phone']; ?></td>
                                </tr>

                               <tr>
                                  <th>Email:</th>
                                  <td><?php echo $fieldrecord['email']; ?></td>
                                </tr>
                               
                               
                                <tr>
                                  <th>Date of Birth:</th>
                                  <td><?php echo $fieldrecord['dateofbirth']; ?></td>
                                </tr>
                                <tr>
                                  <th>Guardian</th>
                                  <td><?php if ($fieldrecord['guardianid']!=0) { echo $guardiansurname .' '.$guardianothername; ?><a href="guardian?id=<?php echo $fieldrecord['guardianid']; ?>&page=5&schoolhelp=<?php echo $schoolhelp ; ?>"> View Details </a><?php }  ?> </td>
                                </tr>
                               
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                          <div class="col-xs-6"><button class="btn btn-default print-link" ><i class="fa fa-print"></i> Print</button></div>
                          <div class="col-xs-6"><a class="btn btn-danger "  href="?page=3&schoolhelp=<?php echo $schoolhelp; ?>&id=<?php echo $stid; ?>&levelid=<?php echo $levelid; ?>&optionid=<?php echo $optionid; ?>&type=<?php echo $type; ?>"><i class="fa fa-edit"></i> Edit</a></div>
                          
                          
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
                <?php }//closing loop 
                }//Closing Array Check 
              }//closing page ?>
                 <?php if($page==8) {?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Upload Multiple</legend>
                  <form enctype="multipart/form-data" action="?page=7&schoolhelp=<?php echo $schoolhelp; ?>&levelid=<?php echo $levelid; ?>&optionid=<?php echo $optionid; ?>&type=<?php echo $type; ?>" method="POST"  id="forminstitutionid"  class="form-horizontal form-label-left" >

                     

                      <div class="form-group">
                        <label for="export" class="control-label col-md-3 col-sm-3 col-xs-12">Excel Records<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="file-field">
                              <img src="" height="100" width="100" id="showimage"/>
                              <input type="file" name="export"  id="export" class="form-control col-md-7 col-xs-12" onchange="readexcelfile(this, $(this).attr('id'),  'showimage');" required="required">

                        </div>
                      </div>
                    </div>
                     
                     <p id="error1" style="display:none; color:#FF0000;">
                        Invalid Image Format! Image Format Must Be CSV.
                        </p>
                        <p id="error2" style="display:none; color:#FF0000;">
                        Maximum File Size Limit is 1MB.
                        </p>
                      <div id="msg" ></div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                  </fieldset>
                 </div>
                 <?php } ?>

              </div>
            </div>
              <div id="camera" onclick="picture_call('showimage', 'picturecall');">
                          
                          <span  onclick="$('#camera').toggle();" class="camTop"></span>
                            
                            <div id="screen"></div>
                            <div id="buttons">
                              <div class="buttonPane">
                                  <a id="shootButton" href="" class="blueButton" onclick="$('#photos').show();">Shoot!</a>
                                </div>
                                <div class="buttonPane ">
                                  <a id="cancelButton" href="" class="blueButton">Cancel</a> <a id="uploadButton" href=""  class="greenButton" >Upload!</a>
                                </div>
                            </div>
                            
                            <span class="settings"></span>
                        </div>
       <?php include("includes/footer.php"); ?>