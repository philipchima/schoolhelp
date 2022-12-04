
<?php 
include_once("includes/global.php");
include_once("includes/connection.php");
include_once("phpclass/SHdashinserts.php");
include_once("phpclass/schoolhelpothers.php");
include_once("phpclass/schoolhelpOOP.php");
include_once("phpclass/SHdashOOP.php");
include_once("phpclass/SHdashupdate.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Staff";

$odate=date("Y-m-d");

$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

//Classes
//level/Class class
$data=new classLevel;
//Option/Class class
$optiondata=new classOption;

//Session Class 
$sessiondata=new classSession;

//Staff class
$schoolhelpDH=new classDash;
 $tableUpdate= new updateTable;

//Excel Template class

$template=new Databasebackup;


$mysqli1=new Dbh;
$mysqli=$mysqli1->connect();

$previlleges=$schoolhelpDH->alldashedit('adminpersons', 'adminid', $schoolhelp);

if (is_array($previlleges)) {
 
    foreach($previlleges as $actualrecord){
      $pageaccess=trim($actualrecord['staff_d']);
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

if($page==2) {
  if ($dashadd_d==1) {
 
$title=trim(isset($_POST['title'])?$_POST['title']:false);
$surname=trim(ucwords(isset($_POST['surname'])?$_POST['surname']:false));
$othername=trim(ucwords(isset($_POST['othername'])?$_POST['othername']:false));
      $stafftype=trim(isset($_POST['stafftype'])?$_POST['stafftype']:false);
$sex=trim(isset($_POST['sex'])?$_POST['sex']:false);

$address=trim(isset($_POST['address'])?$_POST['address']:false);
$lgaid=trim(isset($_POST['lgaid'])?$_POST['lgaid']:false);
$stateid=trim(isset($_POST['stateid'])?$_POST['stateid']:false);
$countryid=trim(isset($_POST['countryid'])?$_POST['countryid']:false);
 
$phone=trim(isset($_POST['phone'])?$_POST['phone']:false);
$email=trim(isset($_POST['email'])?$_POST['email']:false);
$qualification=trim(isset($_POST['qualification'])?$_POST['qualification']:false);
$employdate=trim(isset($_POST['employdate'])?$_POST['employdate']:false);

$username=trim(strtolower(isset($_POST['username'])?$_POST['username']:false));
$password=trim(strtolower(isset($_POST['password'])?$_POST['password']:false));
$camphoto=trim(strtolower(isset($_POST['camphoto'])?$_POST['camphoto']:false));
     
$password=Others::passwordconvert($password);
$udate=date("Y-m-d H:m:s");
$passportname="";
$passport=$_FILES["passport"]["name"];
//Getting Picture from the web Camera
if ($camphoto!="") {
  $target_dir = "images/uploads/staff/";
  copy('uploads/original/'.$camphoto, 'images/uploads/staff/'.$camphoto);
   $passportname =$camphoto;
}

//Checking whether logo was uploaded(browsed)
  
   else if($passport!=""){
    $target_dir = "images/uploads/staff/";
    $passporttmp=$_FILES['passport']['tmp_name']; 
    $temp = explode(".", $_FILES["passport"]["name"]);
    $passportname =strtolower($surname).round(microtime(true)) . '.' . strtolower(end($temp));
 
    move_uploaded_file($_FILES["passport"]["tmp_name"], $target_dir . $passportname);

    }

$insertedrow=0;
$tablestaff=new insertTable;
$state=$tablestaff->insert_staff($title, $surname, $othername,  $sex, $address, $employdate, $lgaid, $stateid, $countryid, 
$phone, $email, $qualification, $passportname, $username, $password, $stafftype,  $schoolhelp, $udate, $odate);
$display=$state['action'];
$insertedrow+=$state['counting'];


$sql=$display.":: Insertion, affected records =".$insertedrow;
  
  }
echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&state=$display&sql=$sql';
      </script>";
}

if($page==4) {
  if ($dashedit_d==1) {
 $staffid=trim(isset($_POST['staffid'])?$_POST['staffid']:false);
 $passportold=trim(isset($_POST['passportold'])?$_POST['passportold']:false);
 $title=trim(isset($_POST['title'])?$_POST['title']:false);
$surname=trim(ucwords(isset($_POST['surname'])?$_POST['surname']:false));
$othername=trim(ucwords(isset($_POST['othername'])?$_POST['othername']:false));
      $stafftype=trim(isset($_POST['stafftype'])?$_POST['stafftype']:false);
$sex=trim(isset($_POST['sex'])?$_POST['sex']:false);

$address=trim(isset($_POST['address'])?$_POST['address']:false);

$lgaid=trim(isset($_POST['lgaid'])?$_POST['lgaid']:false);
$stateid=trim(isset($_POST['stateid'])?$_POST['stateid']:false);
$countryid=trim(isset($_POST['countryid'])?$_POST['countryid']:false);
 $camphoto=trim(strtolower(isset($_POST['camphoto'])?$_POST['camphoto']:false));
$phone=trim(isset($_POST['phone'])?$_POST['phone']:false);
$email=trim(isset($_POST['email'])?$_POST['email']:false);
$qualification=trim(isset($_POST['qualification'])?$_POST['qualification']:false);
$employdate=trim(isset($_POST['employdate'])?$_POST['employdate']:false);
$passport=trim(isset($_POST['passport'])?$_POST['passport']:false);
$username=trim(strtolower(isset($_POST['username'])?$_POST['username']:false));
$udate=date("Y-m-d H:m:s");

$passport=$_FILES["passport"]["name"];
//Getting picture from camera
if ($camphoto!="") {
  copy('uploads/original/'.$camphoto, 'images/uploads/staff/'.$camphoto);
   $passportname =$camphoto;
   $target_dir = "images/uploads/staff/";
   if (file_exists($target_dir.$passportold)) {
      @unlink($target_dir.$passportold);
   }
  
}

//Checking whether logo was uploaded(browsed)
 else if($passport!=""){
  $target_dir = "images/uploads/staff/";
  $passporttmp=$_FILES['passport']['tmp_name']; 
  $temp = explode(".", $_FILES["passport"]["name"]);
  $passportname =strtolower($surname).round(microtime(true)) . '.' . end($temp);
  move_uploaded_file($_FILES["passport"]["tmp_name"], $target_dir. $passportname);
  @unlink($target_dir.$passportold);
  }else{
    $passportname=$passportold;
  }


$state= $tableUpdate->update_staff($staffid, $title, $surname, $othername,  $sex, $address, $employdate, $lgaid, $stateid, $countryid, 
$phone, $email, $qualification, $passportname, $username, $stafftype,  $schoolhelp, $udate);

$sql=$state.":: Update Made, affected records = 1";
}
echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&state=$state&sql=$sql';
      </script>";
}

if ($page==7) {
   $file = $_FILES['export']['tmp_name'];
          $handle = fopen($file, "r");
          $c = 0;
          $n=0;
          while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
                    {
                  $n+=1;
                  if ($n>1) {
                                              
          $titleid = $filesop[0];
          $surname= $filesop[1];
          $othername = $filesop[2];
          $stafftype = $filesop[3];
          $sex = $filesop[4];
          $phone = $filesop[5];
          $email = $filesop[6];
           $address = $filesop[7];
          $employdate = $filesop[8];
          $countryid = $filesop[9];
          $stateid = $filesop[10];
          $lgaid= $filesop[11];
           
          $qualificationid = $filesop[12];
          
          
          $username = $filesop[13];
          $password = $filesop[14];
          $password=Others::passwordconvert($password);

          $operatorid= $filesop[15];
          $udate= date("Y-m-d H:m:s");
          

          $sql = "insert into staff(titleid, surname, othername, sex, phone,  address, employdate, countryid, stateid, lgaid, email,  qualification, username, password, operatorid, udate, odate) values ('$titleid','$surname','$othername','$sex','$phone', '$address', '$employdate','$countryid','$stateid','$lgaid', '$email','$qualificationid','$username','$password', '$operatorid', '$udate', '$odate')";
          $stmt = $mysqli->prepare($sql);

                      if($stmt->execute()){
                        $c = $c + 1;
                      }
                     
              }  
           }//End of while statement
         
            if($sql){
              $sql=$state.":: Insertion Made, affected records =".$c;

            echo "<script>
                    window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
                  </script>";
             } 
               else
                   {
                          echo "Sorry! Unable to impo.";
             }

}
if ($page==6) {
  if ($dashdelete_d==1) {
   $staffid=trim(isset($_GET['id'])?$_GET['id']:false);
   $passport=trim(isset($_GET['passport'])?$_GET['passport']:false);
  
    $state=$tableUpdate->delete_dash('staff', 'staffid', $staffid);

        $sql=$state.":: Deletion Made, affected records = 1";
         if ($state=="Success") {
                 $target_dir = "images/uploads/staff/";
                  @unlink($target_dir.$passport);
              }
          }
             $page="";
        echo "<script>
                window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
              </script>";
    
}

if ($page==9) {
  if ($dashedit_d==1) {
    $staffid=trim(isset($_GET['id'])?$_GET['id']:false);
    $password=Others::passwordconvert("password");
    $udate=date("Y-m-d H:m:s");
    $state= $tableUpdate->passwordreset('staff', 'staffid', $staffid, $password, $schoolhelp, $udate);
    $sql="";
     if($state=="Success"){
      $sql=$state.":: Password Reset Made, affected records = 1; He or She's Password is password";
     }
   }
   $page="";
echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}

if ($page==10) {
  if ($dashedit_d==1) {
    $staffid=trim(isset($_GET['id'])?$_GET['id']:false);
   $accessvalue=trim(isset($_GET['accessvalue'])?$_GET['accessvalue']:false);
    $udate=date("Y-m-d H:m:s");
    $state= $tableUpdate->accessgiving('staff', 'staffid', $staffid, $accessvalue, $schoolhelp, $udate);
    $sql="";
     if($state=="Success"){
      $sql=$state.":: Request has taken Effect";
     }
  }
   $page="";
         echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}

include("includes/header.php");
//this helps you to know the kind of driver you are using
//print_r(PDO::getAvailableDrivers());
 ?>
   <!-- page content -->
    <div class="right_col" role="main">
         

            <div class="row">
              <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12" style="margin-bottom: 20px;">
                <div class="x_panel">
                  <div class="x_title" style="background: #61dc42; padding-top: 10px; border-radius: 6px;">
                    <h4 id="caption" style="float:left;">Staff</h4>
                    
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="btn btn-primary" href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                        
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Action</a>
                        <ul class="dropdown-menu" role="menu">
                          <?php if ($dashadd_d==1) { ?>
                        <li><a href="?schoolhelp=<?php echo $schoolhelp; ?>&page=1"  ><i class="fa fa-plus"></i>  Add Staff</a></li>
                        <li><a href="?schoolhelp=<?php echo $schoolhelp; ?>&page=8"  ><i class="fa fa-plus"></i>  Upload Multiple Staff</a></li>
                        <?php } ?>
                        <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> View <?php echo $pagename; ?></a></li>
                        <?php if ($dashadd_d==1) { ?>
                        <li ><a  href="#" onclick="funcdownload('<?php echo $schoolhelp; ?>','9','staff','1','0')"><i class="fa fa-book"></i>  Download Template</a></li>
                        <?php } ?>
                        </ul>
                      </li>
                    </li>
                    </ul>

                    <div class="clearfix"></div>
                  </div>

                  <div style="color:#063"  ><b><?php echo $sql; ?></b></div>

                  
                    <?php if ($page=="") {?>
                      <div class="x_panel ">
                         <fieldset>
                        <legend style="color:#063"><?php echo $pagename; ?> Record</legend>
                    <table id="datatable-buttons"  class="table table-striped table-bordered table-responsive" style="width: 100%">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Passport</th>
                          <th>Title</th>
                          <th>Surname</th>
                          <th>Othername</th>
                          <th>Sex</th>
                          <th>Staff </th>
                          <th>Phone</th>
                        
                          <th>State</th>
                          <th>Qualification</th>
                  
                          <th ><i class="fa fa-print" style="color:green"></i> Print</th>
                           <?php if ($dashedit_d==1) { ?>
                          <th ><i class="fa fa-edit" style="color:yellow"></i> Edit</th>
                          <?php } ?>
                          <?php if ($dashdelete_d==1) { ?>
                          <th><i class="fa fa-trash" style="color:red"></i> Delete</th>
                          <?php } ?>
                             <?php if ($dashadd_d==1) { ?>
                         <th >Action<i class="fa fa-cog"></i></th>
                         <?php } ?>
                          
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                             
                              $records=$schoolhelpDH->alldash('staff', 'staffid', 'DESC');
                              if (is_array($records)) {

                              foreach($records as $fieldrecord){
                                $qualificationname="";
                                $adminsurname="";
                             $adminothername="";
                             $statename="";
                             $titlename="";
                                $k+=1;
                                $fieldvalue=trim($fieldrecord['operatorid']);
                                $titleid=trim($fieldrecord['titleid']);
                                 $stateid=trim($fieldrecord['stateid']);
                                  $qualificationid= trim($fieldrecord['qualification']);
                                $sexid=trim($fieldrecord['sex']);
                                $stafftype=trim($fieldrecord['stafftype']);
                               $stafftypename=Others::stafftypename($stafftype);
                               $sexname=Others::sexname($sexid);

                                
                                $admindata=$schoolhelpDH->alldashedit('adminpersons', 'adminid',  $fieldvalue);
                                 if(is_array($admindata)){
                                    foreach($admindata as $adminrecord){
                                      $adminsurname=$adminrecord['surname'];
                                      $adminothername=$adminrecord['othername'];
                                     
                                    }

                                  }

                                  $titledata=$schoolhelpDH->alldashedit('title', 'titleid',  $titleid);
                                 if(is_array($titledata)){
                                    foreach($titledata as $titlerecord){
                                      $titlename=$titlerecord['titlename'];
                                      
                                    }

                                  }
                                  
                                   $statedata=$schoolhelpDH->alldashedit('states', 'id',  $stateid);
                                 if(is_array($statedata)){
                                    foreach($statedata as $staterecord){
                                      $statename=$staterecord['name'];
                                      
                                    }

                                  }

                                    $qualificationdata=$schoolhelpDH->alldashedit('qualification', 'qualificationid',  $qualificationid);
                                 if(is_array($qualificationdata)){
                                    foreach($qualificationdata as $qualificationrecord){
                                      $qualificationname=$qualificationrecord['qualificationname'];
                                      
                                    }

                                  }

                                ?>
                                      <tr data-toggle="tooltip" data-placement="top"  required="required" data-html="true" title="<em> <ul >
                                            <li ><span>Update by</span> : <?php echo  $adminsurname. " ".$adminothername ; ?></li>
                                            <li><span>Upate Date</span> : <?php echo  $fieldrecord['udate']; ?></li>
                                            <li><span>Initial Date</span> : <?php echo  $fieldrecord['odate']; ?></li>
                                            
                                          </ul></em>">
                                        <td><?php echo  $k; ?></td>
                                        <td style="width:8%"><img src="images/uploads/staff/<?php echo  $fieldrecord['passport']; ?>" class="img img-responsive img-rounded"></td>
                                        <td><?php echo  substr($titlename,0, 12); ?></td>

                                        <td><?php echo  substr($fieldrecord['surname'],0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['othername'],0, 12); ?></td>
                                        <td><?php echo  $sexname;  ?></td>
                                        <td><?php echo  $stafftypename;  ?></td>
                                        <td><?php echo  substr($fieldrecord['phone'],0, 12); ?></td>
                                        <td><?php echo  substr($statename, 0, 12); ?></td>
                                        
                                        <td><?php echo substr($qualificationname,0, 12); ?></td>
                                        
                                                                                                                  
                                               
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['staffid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                         <?php if ($dashedit_d==1) { ?>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['staffid']; ?>')"><center><i class="fa fa-edit" style="color:yellow; font-size:2em"></i></center></button></td>
                                        <?php } ?> 
                                        <?php if ($dashdelete_d==1) { ?>
                                         <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['staffid']; ?>','<?php echo $fieldrecord['passport']; ?>')"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
                                         <?php } ?> 
                                             <?php if ($dashadd_d==1) { ?>
                                        <td ><span class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-cog"></i> Action<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu" style="list-style-type: none"><center>
                                            <?php if ($fieldrecord['stafftype']==1) { ?>
                                            <li><a target="_blank" href="subjcourse?schoolhelp=<?php echo $schoolhelp ?>&staffid=<?php echo $fieldrecord['staffid']; ?>&page=1">Assign Course/Subjects</a></li>
                                            <?php } ?>
                                            <li onclick="funcresetpassword('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['staffid']; ?>');"><a href="#">Reset Password</a></li>
                                            <?php if ($fieldrecord['access']==0) {?>
                                            <li onclick="funcactivate('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['staffid']; ?>', '1');"><a href="#">De-Activate</a></li>
                                            <?php } else{ ?>
                                            <li onclick="funcactivate('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['staffid']; ?>', '0');"><a href="#">Activate</a></li>
                                            <?php } ?>
                                          </center>
                                          </ul>
                                          </span>

                                        </td> 
                                        <?php } ?>         

                                      </tr>
                             <?php }
                              }
                             ?>
                        
                      </tbody>
                    </table>
                   </fieldset>
                    </div>
                    <?php } ?>

                    <?php if($page==1) { 

                      ?>
                    <div class="x_panel" style="width: 100%">
                      <fieldset>
                        <legend style="color:#063">Add <?php echo $pagename; ?></legend>
                  <form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="formstid"  class="form-horizontal form-label-left" >
                     <input name="camphoto" id="camphoto" value="" class="form-control col-md-7 col-xs-12" type="hidden">
                     <div class="form-group">
                        <label for="session" class="control-label col-md-3 col-sm-3 col-xs-12">Title</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="title" id="level" class="form-control col-md-7 col-xs-12" >
                             <option value="">--Select Title--</option>
                            <?php //Getting title table
                               $SHtitle=$schoolhelpDH->alldash('title', 'titleid', 'ASC'); 
                            foreach($SHtitle as $titlerecords){
                            ?>
                            <option value="<?php echo $titlerecords['titleid']; ?>" ><?php echo $titlerecords['titlename'] ;?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="surname" class="control-label col-md-3 col-sm-3 col-xs-12">Surname<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="surname" id="surname" class="form-control col-md-7 col-xs-12" type="text" required="required">
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="otherrname" class="control-label col-md-3 col-sm-3 col-xs-12">Otherrname<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="otherrname" class="form-control col-md-7 col-xs-12" type="text" name="othername" required="required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="sex" class="control-label col-md-3 col-sm-3 col-xs-12">Sex</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="sex" id="sex" class="form-control col-md-7 col-xs-12" type="text"  required="required">
                            <option value="">--Select Sex--</option>
                             <option value="1">Male</option>
                             <option value="2">Female</option>
                          </select>
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="sex" class="control-label col-md-3 col-sm-3 col-xs-12">Staff Type</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="stafftype" id="stafftype" class="form-control col-md-7 col-xs-12" type="text"  required="required">
                            <option value="">--Select Staff--</option>
                             <option value="1">Academic</option>
                             <option value="2">Non Academic</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Country<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <select id="countryid" class="form-control col-md-7 col-xs-12" name="countryid" required="required" onchange="retrieveselection1('states', 'country_id', this.value, 0, 0, 'state', 'state');">
                             <option value="">--Select Country--</option>
                           <?php //Getting title table
                               $SHcountry=$schoolhelpDH->alldash('countries', 'id', 'ASC'); 
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
                          <select id="state" class="form-control col-md-7 col-xs-12" type="text" name="state" required="required" data-toggle="tooltip" data-placement="top" title="Make sure country is selected">
                            <option value="">--Select State--</option>
                           
                          </select>
                        </div>
                      </div>
                    </div>

                     <div id="lga">
                      <div class="form-group">
                        <label for="lga" class="control-label col-md-3 col-sm-3 col-xs-12">L.G.A</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="lga" class="form-control col-md-7 col-xs-12" type="text" name="lga" required="required" data-toggle="tooltip" data-placement="top" title="Make sure State is selected">
                            <option value="">--Select LGA--</option>
                           
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Residential Address<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="address" class="form-control col-md-7 col-xs-12"  name="address" required="required"></textarea>
                        </div>
                      </div>
                    

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="phone" class="form-control col-md-7 col-xs-12" type="text" name="phone">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="email" class="form-control col-md-7 col-xs-12" type="text" name="email" required="required">
                        </div>
                      </div>

                       

                       <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Qualification<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <select id="qualification" class="form-control col-md-7 col-xs-12" name="qualification" required="required" >
                             <option value="">--Select Qualification--</option>
                           <?php //Getting title table
                               $SHqualification=$schoolhelpDH->alldash('qualification', 'qualificationid', 'ASC'); 
                            foreach($SHqualification as $qualificationrecords){
                            ?>
                            <option value="<?php echo $qualificationrecords['qualificationid']; ?>" ><?php echo $qualificationrecords['qualificationname']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Employment Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="employdate" class="form-control col-md-7 col-xs-12" type="date" name="employdate" required="required" value="">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Username<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="username" class="form-control col-md-7 col-xs-12" type="text" name="username" required="required"  onblur="return updatevalidity('staff', 'username', this.value, 'inserting', $(this).attr('id'));">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Password<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password" class="form-control col-md-7 col-xs-12" type="text" name="password" value="password" required="required">
                        </div>
                      </div>
                      

                      <div class="form-group">

                         
                        <label for="photo" class="control-label col-md-3 col-sm-3 col-xs-12">Passport</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <img src="" height="100" width="100" id="showimage"/>
                          <input name="passport" id="passport" type="file" class="form-control col-md-7 col-xs-12"  onchange="readURL(this, $(this).attr('id'),  'showimage');">

                          <div class="col-md-12 col-sm-12 col-xs-12">
                                                          
                          <div class="col-md-4 ">
                            <img src="images/webcam.png" class="camTop" style="position:relative"  id="webcamicon" onclick="$('#camera').toggle(); $('#photos').toggle();" data-toggle="tooltip" data-placement="top" title="Make use of your system camera if it is available" style="width:40%" />
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
                    $staffid=trim(isset($_GET['id'])?$_GET['id']:false);

                    
                    $record=$schoolhelpDH->alldashedit('staff', 'staffid', $staffid);
                    if(is_array($record)){
                      foreach($record as $records){
                    ?>
                    <div class="x_panel" style="width: 100%">
                      <fieldset>
                        <legend style="color:#063">Add <?php echo $pagename; ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="formstid"  class="form-horizontal form-label-left" >
                      <input name="camphoto" id="camphoto" value="" class="form-control col-md-7 col-xs-12" type="hidden">
                     <input name="staffid" id="staffid" value="<?php echo $staffid; ?>" class="form-control col-md-7 col-xs-12" type="hidden">
                     <input name="passportold" id="passportold" value="<?php echo $records['passport']; ?>" class="form-control col-md-7 col-xs-12" type="hidden">
                     <div class="form-group">
                        <label for="session" class="control-label col-md-3 col-sm-3 col-xs-12">Title</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="title" id="level" class="form-control col-md-7 col-xs-12" >
                             <option value="">--Select Title--</option>
                            <?php //Getting title table
                               $SHtitle=$schoolhelpDH->alldash('title', 'titleid', 'ASC'); 
                            foreach($SHtitle as $titlerecords){
                            ?>
                            <option value="<?php echo $titlerecords['titleid']; ?>" <?php if($titlerecords['titleid']==$records['titleid']){ ?> selected="selected" <?php } ?> ><?php echo $titlerecords['titlename'] ;?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="surname" class="control-label col-md-3 col-sm-3 col-xs-12">Surname<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="surname" id="surname" value="<?php echo $records['surname']; ?>" class="form-control col-md-7 col-xs-12" type="text" required="required">
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="otherrname" class="control-label col-md-3 col-sm-3 col-xs-12">Otherrname<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="othername" value="<?php echo $records['othername']; ?>" id="otherrname" class="form-control col-md-7 col-xs-12" type="text"  required="required">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="sex" class="control-label col-md-3 col-sm-3 col-xs-12">Sex</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="sex" id="sex" class="form-control col-md-7 col-xs-12" type="text"  required="required">
                            <option value="">--Select Sex--</option>
                             <option value="1" <?php if($records['sex']==1){ ?> selected="selected" <?php } ?>>Male</option>
                             <option value="2" <?php if($records['sex']==2){ ?> selected="selected" <?php } ?>>Female</option>
                          </select>
                        </div>
                      </div>

                       <div class="form-group">
                        <label for="sex" class="control-label col-md-3 col-sm-3 col-xs-12">Staff Type</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="stafftype" id="stafftype" class="form-control col-md-7 col-xs-12" type="text"  required="required">
                            <option value="" >--Select Staff--</option>
                             <option value="1" <?php if($records['stafftype']==1){ ?> selected="selected" <?php } ?>>Academic</option>
                             <option value="2" <?php if($records['stafftype']==2){ ?> selected="selected" <?php } ?>>Non Academic</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Country<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <select id="countryid" class="form-control col-md-7 col-xs-12" name="countryid" required="required" onchange="retrieveselection1('states', 'country_id', this.value, 0, 0, 'state', 'state');">
                             <option value="">--Select Country--</option>
                           <?php //Getting country table
                               $SHcountry=$schoolhelpDH->alldash('countries', 'id', 'ASC'); 
                            foreach($SHcountry as $countryrecords){
                            ?>
                            <option value="<?php echo $countryrecords['id']; ?>" <?php if($countryrecords['id']==$records['countryid']){ ?> selected="selected" <?php } ?> ><?php echo $countryrecords['name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      <div id="state">
                      <div class="form-group">
                        <label for="state" class="control-label col-md-3 col-sm-3 col-xs-12">State</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="stateid" class="form-control col-md-7 col-xs-12" type="text" name="stateid" required="required" data-toggle="tooltip" data-placement="top" title="Make sure country is selected" onchange="retrieveselection1('lga', 'stateid', this.value, 0, 0, 'lga', 'lga');">
                            <option value="">--Select State--</option>
                            <?php //Getting State table
                               $SHstate=$schoolhelpDH->alldashedit('states', 'country_id', $records['countryid']); 
                            foreach($SHstate as $staterecords){
                            ?>

                           <option value="<?php echo $staterecords['id']; ?>" <?php if($staterecords['id']==$records['stateid']){ ?> selected="selected" <?php } ?> ><?php echo $staterecords['name']; ?></option>
                            <?php } ?>
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
                           <?php //Getting State table
                               $SHlga=$schoolhelpDH->alldashedit('lga', 'stateid', $records['stateid']); 
                            foreach($SHlga as $lgarecords){
                            ?>

                           <option value="<?php echo $lgarecords['lgaid']; ?>" <?php if($lgarecords['lgaid']==$records['lgaid']){ ?> selected="selected" <?php } ?> ><?php echo $staterecords['name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Residential Address<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="address" class="form-control col-md-7 col-xs-12"  name="address" required="required"><?php echo $records['address']; ?></textarea>
                        </div>
                      </div>
                    

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="phone" class="form-control col-md-7 col-xs-12" type="text" name="phone" value="<?php echo $records['phone']; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="email" class="form-control col-md-7 col-xs-12" type="text" name="email" required="required" value="<?php echo $records['email']; ?>">
                        </div>
                      </div>

                       

                       <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Qualification<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <select id="qualification" class="form-control col-md-7 col-xs-12" name="qualification" required="required" >
                             <option value="">--Select Qualification--</option>
                           <?php //Getting title table
                               $SHqualification=$schoolhelpDH->alldash('qualification', 'qualificationid', 'ASC'); 
                            foreach($SHqualification as $qualificationrecords){
                            ?>
                            <option value="<?php echo $qualificationrecords['qualificationid']; ?>" <?php if($qualificationrecords['qualificationid']==$records['qualification']){ ?> selected="selected" <?php } ?> ><?php echo $qualificationrecords['qualificationname']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Employment Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="employdate" class="form-control col-md-7 col-xs-12" type="date" name="employdate" required="required" value="<?php echo $records['employdate']; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Username<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="username" class="form-control col-md-7 col-xs-12" type="text" name="username" required="required"  onblur="return updatevalidity('staff', 'username', this.value, 'updating', $(this).attr('id'));"  value="<?php echo $records['username']; ?>">
                        </div>
                      </div>

                      

                      <div class="form-group">

                         
                        <label for="photo" class="control-label col-md-3 col-sm-3 col-xs-12">Passport</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <img <?php if ($records['passport']!="") {?> src="images/uploads/staff/<?php echo $records['passport']; ?>" style="display: block"<?php }  ?> height="100" width="100"   id="showimage"  />
                          <input name="passport" id="passport" type="file" class="form-control col-md-7 col-xs-12" onchange="readURL(this, $(this).attr('id'),  'showimage');">

                          <div class="col-md-12 col-sm-12 col-xs-12">
                                                          
                          <div class="col-md-4 ">
                            <img src="images/webcam.png" class="camTop" style="position:relative"  id="webcamicon" onclick="$('#camera').toggle(); $('#photos').toggle();" data-toggle="tooltip" data-placement="top" title="Make use of your system camera if it is available" style="width:40%" />
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

                <?php } 
              }else{ echo "Manipulation is wrought!";}

              } ?>

                <?php if ($page==5) {
                  $staffid=trim(isset($_GET['id'])?$_GET['id']:false);
                  $hdname="";
                   
                    $records=$schoolhelpDH->alldashedit('staff', 'staffid', $staffid);
                     foreach($records as $fieldrecord){
                                
                                $fieldvalue=trim($fieldrecord['operatorid']);
                                $titleid=trim($fieldrecord['titleid']);
                                $stafftype=trim($fieldrecord['stafftype']);
                                $countryid=trim($fieldrecord['countryid']);
                                 $stateid=trim($fieldrecord['stateid']);
                                 $lgaid=trim($fieldrecord['lgaid']);
                                  $qualificationid= trim($fieldrecord['qualification']);
                                $sexid=trim($fieldrecord['sex']);
                               
                               $sexname=Others::sexname($sexid);
                               $surname= trim($fieldrecord['surname']);
                               $othername= trim($fieldrecord['othername']);
                               $udate= trim($fieldrecord['udate']);
                               $odatet= trim($fieldrecord['odate']);
                                $passport=trim($fieldrecord['passport']);
                                $address=trim($fieldrecord['address']);
                                 $phone=trim($fieldrecord['phone']);
                                 $email=trim($fieldrecord['email']);
                                 $qualification=trim($fieldrecord['qualification']);
                                 $employdate=trim($fieldrecord['employdate']);



                               $stafftypename=Others::stafftypename($stafftype);

                      }

                    //Getting Operators ID
                     $admindata=$schoolhelpDH->alldashedit('adminpersons', 'adminid',  $fieldvalue);
                                 if(is_array($admindata)){
                                    foreach($admindata as $adminrecord){
                                      $adminsurname=$adminrecord['surname'];
                                      $adminothername=$adminrecord['othername'];
                                    }

                                  }

                           $titledata=$schoolhelpDH->alldashedit('title', 'titleid',  $titleid);
                                 if(is_array($titledata)){
                                    foreach($titledata as $titlerecord){
                                      $titlename=$titlerecord['titlename'];
                                      
                                    }

                                  }
                                  
                              //Country ID
                                    $countrydata=$schoolhelpDH->alldashedit('countries', 'id',  $countryid);
                                 if(is_array($countrydata)){
                                    foreach($countrydata as $countryrecord){
                                      $countryname=$countryrecord['name'];
                                      
                                    }

                                  }

                                   $statedata=$schoolhelpDH->alldashedit('states', 'id',  $stateid);
                                 if(is_array($statedata)){
                                    foreach($statedata as $staterecord){
                                      $statename=$staterecord['name'];
                                      
                                    }

                                  }

                                  //LGA ID
                                    $lgadata=$schoolhelpDH->alldashedit('lga', 'lgaid',  $lgaid);
                                 if(is_array($lgadata)){
                                    foreach($lgadata as $lgarecord){
                                      $lganame=$lgarecord['name'];
                                      
                                    }

                                  }


                                    $qualificationdata=$schoolhelpDH->alldashedit('qualification', 'qualificationid',  $qualificationid);
                                 if(is_array($qualificationdata)){
                                    foreach($qualificationdata as $qualificationrecord){
                                      $qualificationname=$qualificationrecord['qualificationname'];
                                      
                                    }

                                  }
                  ?>
                    <div class="x_panel" >
                  <div class="x_title">
                    <h3 class="schoolhelp">Staff Details </h3>
                    <ul class="nav navbar-right panel_toolbox" id="panel_toolbox">
                      
                      <li class="pull-right"><a href="?schoolhelp=<?php echo $schoolhelp; ?>" class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" id="printrecord">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h3 class="schoolhelp">
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $surname." ".$othername; ?>.
                                          <small class="pull-right">Pinted on: <?php echo $odate; ?></small>
                                      </h3>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                       
                       
                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col">
                         <img id="userimage" <?php if ($passport!="") {?> style="display: block" src="images/uploads/staff/<?php echo $passport; ?>" <?php } ?> class="img img-responsive img-thumbnail" >
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col" align="right">
                          <h4><b>Admin Details:</b></h4>
                          <address>
                                          Updated by: <strong><?php echo $adminsurname ." ".$adminothername; ?></strong>
                                          <br><b>Date: </b><?php echo $udate; ?></strong>
                                          <br><b>Initial Insertion Date: </b><?php echo $odatet; ?>
                                          
                                      </address>
                        </div>

                      
                      </div>
                      <!-- /.row -->


                   

                      <div class="row">
                       
                        <div class="col-xs-12">
                          <hr>
                          <center><p class="lead schoolhelpcolor"><b><?php echo $titlename." ". $surname." ".$othername; ?> Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                 <tr>
                                  <th style="width:50%">Title:</th>
                                  <td><?php echo $titlename; ?></td>
                                </tr>
                                <tr>
                                  <th style="width:50%">Surname:</th>
                                  <td><?php echo $surname; ?></td>
                                </tr>
                                <tr>
                                  <th>OtherName:</th>
                                  <td><?php echo $othername; ?></td>
                                </tr>
                                <tr>
                                  <th>Staff Type:</th>
                                  <td><?php echo $stafftypename; ?></td>
                                </tr>
                                <tr>
                                  <th>Sex:</th>
                                  <td><?php echo $sexname; ?></td>
                                </tr>

                               <tr>
                                  <th>Country:</th>
                                  <td><?php echo $countryname; ?></td>
                                </tr>
                                <tr>
                                  <th>State:</th>
                                  <td><?php echo $statename ?></td>
                                </tr>
                                <tr>
                                  <th>L.G.A:</th>
                                  <td><?php echo $lganame; ?></td>
                                </tr>
                                <tr>
                                  <th>Residential Address:</th>
                                  <td><?php echo $address; ?></td>
                                </tr>
                                <tr>
                                  <th>Phone:</th>
                                  <td><?php echo $phone; ?></td>
                                </tr>
                                <tr>
                                  <th>Email:</th>
                                  <td><?php echo $email; ?></td>
                                </tr>
                                <tr>
                                  <th>Qualification:</th>
                                  <td><?php echo $qualificationname; ?></td>
                                </tr>
                                <tr>
                                  <th>Employment Date:</th>
                                  <td><?php echo $employdate; ?></td>
                                </tr>
                                <?php if ($stafftype==1) { ?>
                                 <tr>
                                  <th>Instructor's Courses</th>
                                  <td><a href="subjcourse?page=7&staffid=<?php echo $staffid; ?>&schoolhelp=<?php echo $schoolhelp; ?>">View Courses</a></td>
                                </tr>
                                <?php  } ?>
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
                          <button class="btn btn-default print-link" ><i class="fa fa-print"></i> Print</button>
                          
                          
                        </div>
                      </div>
                    </section>
                  </div>
                </div>

                  
                <?php } ?>
                 <?php if($page==8) {?>
                    <div class="x_panel">
                      <fieldset>
                        <legend style="color:#063">Upload Multiple</legend>
                  <form enctype="multipart/form-data" action="?page=7&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="forminstitutionid"  class="form-horizontal form-label-left" >

                     

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

              </div>
            </div>
             <!--Web camp-->
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
<!--Webcamp-->
       <?php include("includes/footer.php"); ?>