
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
$pagename="Guardian";

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

//guardian class
$schoolhelpDH=new classDash;
 $tableUpdate= new updateTable;

//Excel Template class

$template=new Databasebackup;


$mysqli1=new Dbh;
$mysqli=$mysqli1->connect();

$previlleges=$schoolhelpDH->alldashedit('adminpersons', 'adminid', $schoolhelp);
foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['guardian_d']);
  $admintype=trim($actualrecord['admintype']);
  $dashedit_d=trim($actualrecord['dashedit_d']);
  $dashadd_d=trim($actualrecord['dashadd_d']);
  $dashdelete_d=trim($actualrecord['dashdelete_d']);
  $signatorypositionid=trim($actualrecord['signatorypositionid']);
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
 
$address=trim(isset($_POST['address'])?$_POST['address']:false);

 
$phone=trim(isset($_POST['phone'])?$_POST['phone']:false);
$email=trim(isset($_POST['email'])?$_POST['email']:false);
$occupation=trim(isset($_POST['occupation'])?$_POST['occupation']:false);


$username=trim(strtolower(isset($_POST['username'])?$_POST['username']:false));
$password=trim(strtolower(isset($_POST['password'])?$_POST['password']:false));
     
$password=Others::passwordconvert($password);
$udate=date("Y-m-d H:m:s");

$passportname="";
$camphoto=trim(strtolower(isset($_POST['camphoto'])?$_POST['camphoto']:false));
$passport=$_FILES["passport"]["name"];
//Getting Picture from the web Camera
if ($camphoto!="") {
  $target_dir = "images/uploads/guardian/";
  copy('uploads/original/'.$camphoto, 'images/uploads/guardian/'.$camphoto);
   $passportname =$camphoto;
}

//Checking whether logo was uploaded(browsed)
  
   else if($passport!=""){
    $target_dir = "images/uploads/guardian/";
    $passporttmp=$_FILES['passport']['tmp_name']; 
    $temp = explode(".", $_FILES["passport"]["name"]);
    $passportname =strtolower($surname).round(microtime(true)) . '.' . strtolower(end($temp));
 
    move_uploaded_file($_FILES["passport"]["tmp_name"], $target_dir . $passportname);

    }


$insertedrow=0;
$tableguardian=new insertTable;
$state=$tableguardian->insert_guardian($title, $surname, $othername,   $address, $phone, $email, $occupation, $passportname, $username, $password, $schoolhelp, $udate, $odate);
$display=$state['action'];
$insertedrow+=$state['counting'];


$sql=$display.":: Insertion, affected records =".$insertedrow;

}

echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
}

if($page==4) {

  if ($dashedit_d==1) {

 $guardianid=trim(isset($_POST['guardianid'])?$_POST['guardianid']:false);
 $passportold=trim(isset($_POST['passportold'])?$_POST['passportold']:false);
 $title=trim(isset($_POST['title'])?$_POST['title']:false);
$surname=trim(ucwords(isset($_POST['surname'])?$_POST['surname']:false));
$othername=trim(ucwords(isset($_POST['othername'])?$_POST['othername']:false));
 

$address=trim(isset($_POST['address'])?$_POST['address']:false);

 
$phone=trim(isset($_POST['phone'])?$_POST['phone']:false);
$email=trim(isset($_POST['email'])?$_POST['email']:false);
$occupation=trim(isset($_POST['occupation'])?$_POST['occupation']:false);



$username=trim(strtolower(isset($_POST['username'])?$_POST['username']:false));
$udate=date("Y-m-d H:m:s");


$camphoto=trim(strtolower(isset($_POST['camphoto'])?$_POST['camphoto']:false));
$passport=$_FILES["passport"]["name"];
//Getting picture from camera
if ($camphoto!="") {
  copy('uploads/original/'.$camphoto, 'images/uploads/guardian/'.$camphoto);
   $passportname =$camphoto;
   $target_dir = "images/uploads/guardian/";
   if (file_exists($target_dir.$passportold)) {
      @unlink($target_dir.$passportold);
   }
  
}

//Checking whether logo was uploaded(browsed)
 else if($passport!=""){
  $target_dir = "images/uploads/guardian/";
  $passporttmp=$_FILES['passport']['tmp_name']; 
  $temp = explode(".", $_FILES["passport"]["name"]);
  $passportname =strtolower($surname).round(microtime(true)) . '.' . end($temp);
  move_uploaded_file($_FILES["passport"]["tmp_name"], $target_dir. $passportname);
  @unlink($target_dir.$passportold);
  }else{
    $passportname=$passportold;
  }



$state= $tableUpdate->update_guardian($title, $surname, $othername, $address, $phone, $email, $occupation, $passportname, $username,  $schoolhelp, $udate, $guardianid);

$sql=$state.":: Update Made, affected records = 1";
}
echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";
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
                                              
          $titleid = $filesop[0];
          $surname= $filesop[1];
          $othername = $filesop[2];
         $address = $filesop[3];
          $phone = $filesop[4];
          $email = $filesop[5];
           
          
           
          $occupation = $filesop[6];
          
          
          $username = $filesop[7];
          $password = $filesop[8];
          $password=Others::passwordconvert($password);

          $operatorid= $filesop[9];
          $udate= date("Y-m-d H:m:s");
          

          $sql = "insert into guardian(titleid, surname, othername,  phone,  address, occupation, email,  username, password, operatorid, udate, odate) values ('$titleid','$surname','$othername', '$phone', '$address', '$occupation', '$email', '$username','$password', '$operatorid', '$udate', '$odate')";
          $stmt = $mysqli->prepare($sql);

                      if($stmt->execute()){
                        $c = $c + 1;
                      }
                     
              }  
           }//End of while statement

         }
         
            if($sql){
              $sql=$state.":: Insertion Made, affected records =".$c;

            echo "<script>
                    window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
                  </script>";
             } 
               else
                   {
                          $sql ="Sorry! Unable to import.";
                           echo "<script>
                    window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
                  </script>";
             }

}

if ($page==6) {

if ($dashdelete_d==1) {
  
   $guardianid=trim(isset($_GET['id'])?$_GET['id']:false);
   $passport=trim(isset($_GET['passport'])?$_GET['passport']:false);
  
    $state=$tableUpdate->delete_dash('guardian', 'gid', $guardianid);

        $sql=$state.":: Deletion Made, affected records = 1";
         if ($state=="Success") {
                 $target_dir = "images/uploads/guardian/";
                  @unlink($target_dir.$passport);
              }
  }
        echo "<script>
                window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
              </script>";
    
}

if ($page==9) {
  if ($dashedit_d==1) {
    $guardianid=trim(isset($_GET['id'])?$_GET['id']:false);
    $password=Others::passwordconvert("password");
    $udate=date("Y-m-d H:m:s");
    $state= $tableUpdate->passwordreset('guardian', 'gid', $guardianid, $password, $schoolhelp, $udate);
    $sql="";
     if($state=="Success"){
      $sql=$state.":: Password Reset Made, affected records = 1; He or She's Password is password";
     }
 }

     header("location:?schoolhelp=$schoolhelp&sql=$sql");
}

if ($page==10) {
  if ($dashedit_d==1) {
    $guardianid=trim(isset($_GET['id'])?$_GET['id']:false);
   $accessvalue=trim(isset($_GET['accessvalue'])?$_GET['accessvalue']:false);
    $udate=date("Y-m-d H:m:s");
    $state= $tableUpdate->accessgiving('guardian', 'gid', $guardianid, $accessvalue, $schoolhelp, $udate);
    $sql="";
     if($state=="Success"){
      $sql=$state.":: Request has taken Effect";
     }
   }
          header("location:?schoolhelp=$schoolhelp&sql=$sql");
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
                    <h4 id="caption" style="float:left;"><?php echo $pagename; ?></h4>
                    
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="btn btn-primary" href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                        
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Action</a>
                        <ul class="dropdown-menu" role="menu">
                         <?php if ($dashedit_d==1) { ?>
                        <li><a href="?schoolhelp=<?php echo $schoolhelp; ?>&page=1"  ><i class="fa fa-plus"></i>  Add <?php echo $pagename; ?></a></li>

                        <li><a href="?schoolhelp=<?php echo $schoolhelp; ?>&page=8"  ><i class="fa fa-plus"></i>  Upload Multiple <?php echo $pagename; ?></a></li>
                        <?php } ?>
                        <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> View <?php echo $pagename; ?></a></li>
                        <li ><a  href="#" onclick="funcdownload('<?php echo $schoolhelp; ?>','9','guardian','1','0')"><i class="fa fa-book"></i>  Download Template</a></li>
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
                          <th>Address</th>
                          
                          <th>Phone</th>
                          <th>Email</th>
                        
                          <th>Occupation</th>
                      <?php if ($dashedit_d==1) { ?>
                         <th >Action<i class="fa fa-cog"></i></th>
                         <?php } ?>
                          <th ><i class="fa fa-print" style="color:green"></i> Print</th>
                          <?php if ($dashedit_d==1) { ?>
                          <th ><i class="fa fa-edit" style="color:yellow"></i> Edit</th>
                          <?php } if ($dashdelete_d==1) { ?>
                          <th><i class="fa fa-trash" style="color:red"></i> Delete</th>
                          <?php } ?>
                          <th >User<i class="fa fa-user"></i></th>
                          
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                             
                              $records=$schoolhelpDH->alldash('guardian', 'gid', 'DESC');
                              if (is_array($records)) {

                              foreach($records as $fieldrecord){
                                $qualificationname="";
                                $adminsurname="";
                             $adminothername="";
                             $statename="";
                             $titlename="";
                                
                                $fieldvalue=trim($fieldrecord['operatorid']);
                                $titleid=trim($fieldrecord['titleid']);
                                 
                                                          
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

                                ?>
                                      <tr>
                                        <td><?php echo  $k; ?></td>
                                        <td style="width:8%"><img src="images/uploads/guardian/<?php echo  $fieldrecord['passport']; ?>" class="img img-responsive img-rounded"></td>
                                        <td><?php echo  substr($titlename,0, 12); ?></td>

                                        <td><?php echo  substr($fieldrecord['surname'],0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['othername'],0, 12); ?></td>
                                         <td><?php echo  substr($fieldrecord['address'], 0, 12); ?></td>
                                        
                                        <td><?php echo  substr($fieldrecord['phone'],0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['email'],0, 12); ?></td>
                                       
                                        <td><?php echo substr($fieldrecord['occupation'],0, 12); ?></td>
                                        <?php if ($dashedit_d==1) { ?>
                                        <td><span class="btn-group">
                                            <button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-cog"></i> Action<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu" style="list-style-type: none"><center>
                                            
                                            <li><a target="_blank" href="student2guardian?schoolhelp=<?php echo $schoolhelp ?>&gid=<?php echo $fieldrecord['gid']; ?>&page=1">Assign Ward</a></li>
                                            <li><a target="_blank" href="student2guardian?schoolhelp=<?php echo $schoolhelp ?>&gid=<?php echo $fieldrecord['gid']; ?>&page=7">View Assigned Wards</a></li>
                                            
                                            <li onclick="funcresetpassword('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['gid']; ?>');"><a href="#">Reset Password</a></li>
                                            <?php if ($fieldrecord['access']==0) {?>
                                            <li onclick="funcactivate('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['gid']; ?>', '1');"><a href="#">De-Activate</a></li>
                                            <?php } else{ ?>
                                            <li onclick="funcactivate('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['gid']; ?>', '0');"><a href="#">Activate</a></li>
                                            <?php } ?>
                                          </center>
                                          </ul>
                                          </span>

                                        </td>  
                                        <?php } ?>                  
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['gid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                         <?php if ($dashedit_d==1) { ?>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['gid']; ?>')"><center><i class="fa fa-edit" style="color:yellow; font-size:2em"></i></center></button></td>
                                        <?php } ?>
                                        <?php if ($dashdelete_d==1) { ?>
                                         <td><button onclick="funcdelete('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['gid']; ?>','<?php echo $fieldrecord['passport']; ?>')"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
                                         <?php } ?>
                                         <?php if ($dashedit_d==1) { ?>
                                           <td ><span class="btn-group">
                                            <center><button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-user"></i> Details<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu">
                                            <li ><span>Update by</span> : <?php echo  $adminsurname. " ".$adminothername ; ?></li>
                                            <li><span>Upate Date</span> : <?php echo  $fieldrecord['udate']; ?></li>
                                            <li><span>Initial Date</span> : <?php echo $fieldrecord['odate']; ?></li>
                                            <li class="schoolhelp"><b>Login Status</b></li>
                                            <li><span>login Date</span> : <?php echo  $fieldrecord['logintime']; ?></li>
                                            <li><span>logout Date</span> : <?php echo  $fieldrecord['logouttime']; ?></li>
                                          </ul>
                                          </center></span>

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
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Residential Address<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea name="address" id="address" class="form-control col-md-7 col-xs-12"   required="required"></textarea>
                        </div>
                      </div>
                    

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="phone" id="phone" class="form-control col-md-7 col-xs-12" type="text" >
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="email" id="email" class="form-control col-md-7 col-xs-12" type="text"  required="required">
                        </div>
                      </div>

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Occupation<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="occupation" id="occupation" class="form-control col-md-7 col-xs-12" type="text"  required="required">
                        </div>
                      </div>


                      

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Username<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="username" id="username" class="form-control col-md-7 col-xs-12" type="text"  required="required"  onblur="return updatevalidity('guardian', 'username', this.value, 'inserting', $(this).attr('id'));">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Password<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="password" id="password" class="form-control col-md-7 col-xs-12" type="text"  value="password" required="required">
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
                    $guardianid=trim(isset($_GET['id'])?$_GET['id']:false);

                    
                    $record=$schoolhelpDH->alldashedit('guardian', 'gid', $guardianid);
                    if(is_array($record)){
                      foreach($record as $records){
                    ?>
                    <div class="x_panel" style="width: 100%">
                      <fieldset>
                        <legend style="color:#063">Add <?php echo $pagename; ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>" method="POST"  id="formstid"  class="form-horizontal form-label-left" >
                     <input name="camphoto" id="camphoto" value="" class="form-control col-md-7 col-xs-12" type="hidden">
                     <input name="guardianid" id="guardianid" value="<?php echo $guardianid; ?>" class="form-control col-md-7 col-xs-12" type="hidden">
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
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Residential Address<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="address" class="form-control col-md-7 col-xs-12"  name="address" required="required"><?php echo $records['address']; ?></textarea>
                        </div>
                      </div>
                    

                        <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="phone" id="phone" class="form-control col-md-7 col-xs-12" type="text"  value="<?php echo $records['phone']; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="email" class="form-control col-md-7 col-xs-12" type="text" name="email" required="required" value="<?php echo $records['email']; ?>">
                        </div>
                      </div>

                       

                       

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Occupation<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="occupation" id="occupation" class="form-control col-md-7 col-xs-12" type="text"  required="required" value="<?php echo $records['occupation']; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Username<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="username" class="form-control col-md-7 col-xs-12" type="text" name="username" required="required"  onblur="return updatevalidity('guardian', 'username', this.value, 'updating', $(this).attr('id'));"  value="<?php echo $records['username']; ?>">
                        </div>
                      </div>

                      

                      <div class="form-group">

                         
                        <label for="photo" class="control-label col-md-3 col-sm-3 col-xs-12">Passport</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <img <?php if ($records['passport']!="") {?> src="images/uploads/guardian/<?php echo $records['passport']; ?>" style="display: block"<?php }  ?> height="100" width="100"   id="showimage"  />
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
                  $guardianid=trim(isset($_GET['id'])?$_GET['id']:false);
                 
                   
                    $records=$schoolhelpDH->alldashedit('guardian', 'gid', $guardianid);
                     foreach($records as $fieldrecord){
                                
                                $fieldvalue=trim($fieldrecord['operatorid']);
                                $titleid=trim($fieldrecord['titleid']);
                                
                                  $occupation= trim($fieldrecord['occupation']);
                                
                               $surname= trim($fieldrecord['surname']);
                               $othername= trim($fieldrecord['othername']);
                               $udate= trim($fieldrecord['udate']);
                               $odatet= trim($fieldrecord['odate']);
                                $passport=trim($fieldrecord['passport']);
                                $address=trim($fieldrecord['address']);
                                 $phone=trim($fieldrecord['phone']);
                                 $email=trim($fieldrecord['email']);
                                $titlename="";


                               

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
                                  
                           


                  ?>
                    <div class="x_panel" >
                  <div class="x_title">
                    <h3 class="schoolhelp"><?php echo $pagename; ?> Details </h3>
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
                                          <small class="pull-right">Printed on: <?php echo $odate; ?></small>
                                      </h3>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                       
                       
                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col">
                         <img id="userimage" <?php if ($passport!="") {?> style="display: block" src="images/uploads/guardian/<?php echo $passport; ?>" <?php } ?> class="img img-responsive img-thumbnail" >
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
                                  <th>Occupation:</th>
                                  <td><?php echo $occupation; ?></td>
                                </tr>
                               
                                
                                 <tr>
                                  <th>Guardian's Ward</th>
                                  <td><a href="student2guardian?page=7&gid=<?php echo $guardianid; ?>&schoolhelp=<?php echo $schoolhelp; ?>">View Wards</a></td>
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