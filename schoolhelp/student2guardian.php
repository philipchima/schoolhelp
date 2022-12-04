
<?php 
include_once("includes/global.php");
include_once("includes/connection.php");
include_once("phpclass/SHdashinserts.php");
include_once("phpclass/SHdashupdate.php");
include_once("phpclass/SHdashOOP.php");
//include_once("../phpclass/schoolhelpOOP.php");
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Assign Ward to Guardian";
$schoolhelp=1;
$odate=date("Y-m-d");

//guardian class
$schoolhelpDH=new classDash;

$page=trim(isset($_GET['page'])?$_GET['page']:false);
$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);
$guardianid=trim(isset($_GET['guardianid'])?$_GET['guardianid']:false);
$studentid=trim(isset($_GET['studentid'])?$_GET['studentid']:false);


if($page==2) {
  //getting array ofrecords
  
$counting=0;
 $studentid=trim(isset($_POST['studentid'])?$_POST['studentid']:false);
$guardianid=trim(isset($_POST['guardianid'])?$_POST['guardianid']:false);
  $udate=date("Y-m-d H:m:s");

 $tblassignstudent=new updateTable;
$state=$tblassignstudent->updatesingle('students', 'stid', $studentid, 'guardianid', $guardianid, $schoolhelp, $udate);

//getting array ofrecords
    if ($guardianid!="") {
        $page=7;
      }else{$page="";}
echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql&guardianid=$guardianid&page=$page';
      </script>";
}

if($page==4) {
   $counting=0;
 $studentid=trim(isset($_POST['studentid'])?$_POST['studentid']:false);
$guardianid=trim(isset($_POST['guardianid'])?$_POST['guardianid']:false);
  $udate=date("Y-m-d H:m:s");

 $tblassignstudent=new updateTable;
$state=$tblassignstudent->updatesingle('students', 'stid', $studentid, 'guardianid', $guardianid, $schoolhelp, $udate);

//getting array ofrecords
    if ($guardianid!="") {
        $page=7;
      }else{$page="";}
echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql&guardianid=$guardianid&page=$page';
      </script>";
}

if ($page==6) {
    $studentid=trim(isset($_GET['id'])?$_GET['id']:false);
    $guardianid=trim(isset($_GET['guardianid'])?$_GET['guardianid']:false);
      $tblassignstudent=new updateTable;
      $udate=date("Y-m-d H:m:s");
      $state=$tblassignstudent->updatesingle('students', 'stid', $studentid, 'guardianid', '0', $schoolhelp, $udate);
      if ($guardianid!="") {
        $page=7;
      }
             
        echo "<script>
                window.location.href='?schoolhelp=$schoolhelp&sql=$sql&guardianid=$guardianid&page=$page';
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
                    <h3 class="schoolhelp" id="caption" style="float:left;"><?php echo $pagename ?></h3>
                    <ul class="nav navbar-right panel_toolbox" style="">
                      <li><a class="btn btn-primary" href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                      <li><a class="btn btn-success " href="Settings?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"> Settings</i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                         <li  ><a href="?page=1&schoolhelp=<?php echo $schoolhelp; ?>"  ><i class="fa fa-plus"></i>  Assign Students</a>
                      </li>
                        </li>
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  View all Assigned Students</a>
                      </li>
                      <?php if ($guardianid!="") {
                          //collecting guardian record
                             
                                 $guardianrecords1=$schoolhelpDH->alldashedit('guardian', 'gid', $guardianid);
                                 if (is_array($guardianrecords1)) {
                                    foreach($guardianrecords1 as $guardianrecord1){
                                    $guardiansurname1=$guardianrecord1['surname'];
                                    $guardianothername1=$guardianrecord1['othername'];
                                  }
                                 }
                        ?>
                      </li>
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> View <?php echo $guardiansurname1.' '.$guardianothername1 ?> Assigned Wards</a>
                      </li>
                      <?php } ?>
                        </ul>
                      </li>
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div style="color:#063" <?php if ($state=="failed") {?> style="color:red" <?php } ?> ><b><?php echo $sql; ?></b></div>

                  
                    <?php if ($page=="") {?>
                      <div class="x_panel ">
                         <fieldset>
                        <legend style="color:#063"><?php echo $pagename ?> Record</legend>

                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Guardian</th>
                          <th>Student</th>
                          <th>Option</th>
                          <th>Level</th>
                          <th>Department</th>
                          
                          <th style="width:10%;"><i class="far fa-address-card" style="color:green"></i> Print</th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:red"></i> Edit</th>
                          <th><i class="fa fa-trash" style="color:red"></i> Disengage</th>
                          <th>User<i class="fa fa-user"></i></th>
                          
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                              $studentsurname="";
                              $studentothername="";
                              $optionname="";
                              $levelname="";
                              $deptname="";
                              $guardiansurname="";
                              $guardianothername="";
                              
                              $records=$schoolhelpDH->alldash('students', 'stid', 'ASC');
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                                 if ($fieldrecord['guardianid']!=0) { //Checking Whetter Guardian is avaliable
                                 
                                $k+=1;
                                $operatorid=trim($fieldrecord['operatorid']);
                                
                                $levelid=trim($fieldrecord['levelid']);
                                $optionid=trim($fieldrecord['optid']);
                               $guardianid=trim($fieldrecord['guardianid']);                            
                                
                               //Getting Level Detials
                              
                                 $levelrecords=$schoolhelpDH->alldashedit('level', 'levelid', $levelid);
                                 foreach($levelrecords as $levelrecord){
                                    $departmentid=trim($levelrecord['departmentid']);
                                 }
                                
                              //Getting Admin Detials
                              //$admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
                                 $adminrecords=$schoolhelpDH->alldashedit('adminpersons', 'adminid', $operatorid);
                                 foreach($adminrecords as $adminrecord){
                                    $adminsurname=$adminrecord['surname'];
                                    $adminothername=$adminrecord['othername'];
                                 }

                              //collecting guardian record
                             
                                 $guardianrecords=$schoolhelpDH->alldashedit('guardian', 'gid', $guardianid);
                                 if (is_array($guardianrecords)) {
                                    foreach($guardianrecords as $guardianrecord){
                                    $guardiansurname=$guardianrecord['surname'];
                                    $guardianothername=$guardianrecord['othername'];
                                  }
                                 }
                                


                                  //collecting department record
                              //$deptmethod=$deptclass->departmentedit('did', $fieldvalue1);
                              //$deptname=$deptmethod['deptname'];
                                 $departmentrecords=$schoolhelpDH->alldashedit('department', 'did', $departmentid);
                                 foreach($departmentrecords as $departmentrecord){
                                    $departmentname=$departmentrecord['deptname']; 
                                 }

                              //collecting level record
                              //$levelmethod=$levelclass->leveledit('levelid', $fieldvalue2);
                              //$levelname=$levelmethod['levelname'];
                                  $levelrecords=$schoolhelpDH->alldashedit('level', 'levelid', $levelid);
                                 foreach($levelrecords as $levelrecord){
                                    $levelname=$levelrecord['levelname'];
                                   }

                              //collecting option record
                             // $optionmethod=$optionclass->optionedit('optid', $fieldvalue3);
                              //$optionname=$optionmethod['optname'];
                                    $optionrecords=$schoolhelpDH->alldashedit('optiontable', 'optid', $optionid);
                                 foreach($optionrecords as $optionrecord){
                                    $optionname=$optionrecord['optname'];
                                   }

                                  
                                ?>
                                      <tr>
                                        <td><?php echo $k; ?></td>
                                        <td><?php echo  substr($guardiansurname ." ".$guardianothername, 0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['surname']." ".$fieldrecord['othername'], 0, 16); ?></td>
                                        <td><?php echo  substr($optionname,0, 12); ?></td>
                                        <td><?php echo  substr($levelname,0, 12); ?></td>
                                        <td><?php echo  substr($departmentname,0, 12); ?></td>
                                        
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['stid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['stid']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcdisengage('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['stid']; ?>','<?php echo $guardianid ?>');"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
                                           <td ><span class="btn-group">
                                            <center><button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-user"></i> Details<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu">
                                            <li ><span>Update by</span> : <?php echo  $adminsurname. " ".$adminothername ; ?></li>
                                            <li><span>Upate Date</span> : <?php echo  $fieldrecord['udate']; ?></li>
                                            <li><span>Initial Date</span> : <?php echo  $fieldrecord['odate']; ?></li> 
                                          </ul>
                                          </center></span>

                                        </td>
                                      </tr>
                             <?php 
                                  }//End of checking whether student is available
                                }
                              }
                             ?>
                        
                      </tbody>
                    </table>
                   </fieldset>
                    </div>
                    <?php } ?>

                      <?php if ($page==7) {?>
                      <div class="x_panel ">
                         <fieldset>
                        <legend style="color:#063"><?php echo $pagename ?> Record</legend>

                     <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Guardian</th>
                          <th>Student</th>
                          <th>Option</th>
                          <th>Level</th>
                          <th>Department</th>
                          
                          <th style="width:10%;"><i class="far fa-address-card" style="color:green"></i> Print</th>
                          <th style="width:10%;"><i class="fa fa-edit" style="color:red"></i> Edit</th>
                          <th><i class="fa fa-trash" style="color:red"></i> Disengage</th>
                          <th>User<i class="fa fa-user"></i></th>
                          
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                              $studentsurname="";
                              $studentothername="";
                              $optionname="";
                              $levelname="";
                              $deptname="";
                              $guardiansurname="";
                              $guardianothername="";
                              
                              $records=$schoolhelpDH->alldashedit('students', 'guardianid', $guardianid);
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                                 if ($fieldrecord['guardianid']!=0) { //Checking Whetter Guardian is avaliable
                                 
                                $k+=1;
                                $operatorid=trim($fieldrecord['operatorid']);
                                
                                $levelid=trim($fieldrecord['levelid']);
                                $optionid=trim($fieldrecord['optid']);
                               $guardianid=trim($fieldrecord['guardianid']);                            
                                
                               //Getting Level Detials
                              
                                 $levelrecords=$schoolhelpDH->alldashedit('level', 'levelid', $levelid);
                                 foreach($levelrecords as $levelrecord){
                                    $departmentid=trim($levelrecord['departmentid']);
                                 }
                                
                              //Getting Admin Detials
                              //$admindata=$adminrecord->adminpersons('adminid', $fieldvalue);
                                 $adminrecords=$schoolhelpDH->alldashedit('adminpersons', 'adminid', $operatorid);
                                 foreach($adminrecords as $adminrecord){
                                    $adminsurname=$adminrecord['surname'];
                                    $adminothername=$adminrecord['othername'];
                                 }

                              //collecting guardian record
                             
                                 $guardianrecords=$schoolhelpDH->alldashedit('guardian', 'gid', $guardianid);
                                 if (is_array($guardianrecords)) {
                                    foreach($guardianrecords as $guardianrecord){
                                    $guardiansurname=$guardianrecord['surname'];
                                    $guardianothername=$guardianrecord['othername'];
                                  }
                                 }
                                
                                  //collecting department record
                              //$deptmethod=$deptclass->departmentedit('did', $fieldvalue1);
                              //$deptname=$deptmethod['deptname'];
                                 $departmentrecords=$schoolhelpDH->alldashedit('department', 'did', $departmentid);
                                 foreach($departmentrecords as $departmentrecord){
                                    $departmentname=$departmentrecord['deptname']; 
                                 }

                              //collecting level record
                              //$levelmethod=$levelclass->leveledit('levelid', $fieldvalue2);
                              //$levelname=$levelmethod['levelname'];
                                  $levelrecords=$schoolhelpDH->alldashedit('level', 'levelid', $levelid);
                                 foreach($levelrecords as $levelrecord){
                                    $levelname=$levelrecord['levelname'];
                                   }

                              //collecting option record
                             // $optionmethod=$optionclass->optionedit('optid', $fieldvalue3);
                              //$optionname=$optionmethod['optname'];
                                    $optionrecords=$schoolhelpDH->alldashedit('optiontable', 'optid', $optionid);
                                 foreach($optionrecords as $optionrecord){
                                    $optionname=$optionrecord['optname'];
                                   }

                                  
                                ?>
                                      <tr>
                                        <td><?php echo $k; ?></td>
                                        <td><?php echo  substr($guardiansurname ." ".$guardianothername, 0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['surname']." ".$fieldrecord['othername'], 0, 16); ?></td>
                                        <td><?php echo  substr($optionname,0, 12); ?></td>
                                        <td><?php echo  substr($levelname,0, 12); ?></td>
                                        <td><?php echo  substr($departmentname,0, 12); ?></td>
                                        
                                         <td><button onclick="funcprint('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['stid']; ?>')"><center><i class="fa fa-print" style="color:green; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcedit('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['stid']; ?>')"><center><i class="fa fa-edit" style="color:red; font-size:2em"></i></center></button></td>
                                        <td><button onclick="funcdisengage('<?php echo $schoolhelp; ?>','<?php echo $fieldrecord['stid']; ?>','<?php echo $guardianid ?>');"><center><i class="fa fa-trash" style="color:red; font-size:2em"></i></center></button></td>
                                           <td ><span class="btn-group">
                                            <center><button data-toggle="dropdown" class="btn btn-success dropdown-toggle" type="button" aria-expanded="false"><i class="fa fa-user"></i> Details<span class="caret"></span>
                                          </button>
                                          <ul role="menu" class="dropdown-menu">
                                            <li ><span>Update by</span> : <?php echo  $adminsurname. " ".$adminothername ; ?></li>
                                            <li><span>Upate Date</span> : <?php echo  $fieldrecord['udate']; ?></li>
                                            <li><span>Initial Date</span> : <?php echo  $fieldrecord['odate']; ?></li> 
                                          </ul>
                                          </center></span>

                                        </td>
                                      </tr>
                             <?php 
                                  }//End of checking whether student is available
                                }
                              }
                             ?>
                        
                      </tbody>
                    </table>
                   </fieldset>
                    </div>
                    <?php } ?>


                    <?php if($page==1) {  
                      //Getting staff
                      $guardiansurname="";
                      $guardianothername="";
                      $studentsurname="";
                      $studentothername="";
                       $records=$schoolhelpDH->alldashedit('guardian', 'gid', $guardianid);
                      if (is_array($records)) {         
                      foreach($records as $guardianrecord){
                        $guardiansurname=trim($guardianrecord['surname']);
                        $guardianothername=trim($guardianrecord['otherrname']);
                      }
                      }

                      //Getting Student
                      $records=$schoolhelpDH->alldashedit('students', 'stid', $studentid);
                      if (is_array($records)) {         
                      foreach($records as $studentrecord){
                        $studentsurname=trim($studentnrecord['surname']);
                        $studentothername=trim($studentrecord['otherrname']);
                      }
                      }
                      ?>

                    <div class="x_panel">

                      <fieldset>
                        <legend style="color:#063"><?php echo $pagename ?></legend>
                  <form enctype="multipart/form-data" action="?page=2&schoolhelp=<?php echo $schoolhelp; ?>&guardianid=<?php echo $guardianid; ?>" method="POST"  id="formguardian"  class="form-horizontal form-label-left" >
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="guardianname">Guardian</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         
                       <input type="text" list="guardiannames" id="guardianname" <?php if ($guardiansurname!="" or $guardianothername!=""){ ?> value="<?php echo $guardiansurname.' '.$guardianothername ?>" <?php } ?>  class="form-control col-md-7 col-xs-12" placeholder="Please type and select Guardian name" required="required" onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'guardianid');">

                        <datalist id="guardiannames">

                            <?php
                             $records=$schoolhelpDH->alldash('guardian', 'gid', 'ASC');
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                           
                            ?>
                            <option data-value="<?php echo $fieldrecord['gid']; ?>"  value="<?php echo $fieldrecord['surname'].' '.$fieldrecord['othername']; ?>">
                            <?php } 
                          }?>
                           </datalist>
                           <input name="guardianid" id="guardianid" class="form-control col-md-7 col-xs-12" type="hidden"  required="required" value="<?php echo $guardianid; ?>" >
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="studentnname">Student</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         
                       <input type="text" list="studentnames" id="studentnname" <?php if ($studentsurname!="" or $studentothername!=""){ ?> value="<?php echo $studentsurname.' '.$studentothername ?>" <?php } ?>  class="form-control col-md-7 col-xs-12" placeholder="Please type and select Guardian Wards Name " required="required" onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'studentid');">

                        <datalist id="studentnames">

                            <?php
                             $records1=$schoolhelpDH->alldash('students', 'stid', 'ASC');
                              if (is_array($records)) {
                               
                              foreach($records1 as $fieldrecord1){
                           
                            ?>
                            <option data-value="<?php echo $fieldrecord1['stid']; ?>"  value="<?php echo $fieldrecord1['surname'].' '.$fieldrecord1['othername']; ?>">
                            <?php } 
                          }?>
                           </datalist>
                           <input name="studentid" id="studentid" class="form-control col-md-7 col-xs-12" type="hidden"  required="required" value="<?php echo $studentid; ?>" >
                        </div>
                      </div>

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

                  <?php 

                  if($page==3) {
                    $studentid=trim(isset($_GET['id'])?$_GET['id']:false);
                    $record=$schoolhelpDH->alldashedit('students', 'stid', $studentid);

                    foreach($record as $recorddata){
                      $guardianid=$recorddata['guardianid'];
                      //$departmentid=$recorddata['departmentid'];
                      $levelid=$recorddata['levelid'];
                      $optionid=$recorddata['optid'];
                       //Getting staff
                      $guardiansurname="";
                      $guardianothername="";
                      $studentsurname="";
                      $studentothername="";
                       $records=$schoolhelpDH->alldashedit('guardian', 'gid', $guardianid);
                      if (is_array($records)) {         
                      foreach($records as $guardianrecord){
                        $guardiansurname=trim($guardianrecord['surname']);
                        $guardianothername=trim($guardianrecord['othername']);
                      }
                      }
                    
                    ?>
                    
                    <div class="x_panel">

                      <fieldset>
                        <legend style="color:#063">Edit <?php echo $pagename ?></legend>
                  <form enctype="multipart/form-data" action="?page=4&schoolhelp=<?php echo $schoolhelp; ?>&guardianid=<?php echo $guardianid; ?>" method="POST"  id="forminstitutionid"  class="form-horizontal form-label-left" >
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="guardianname">Guardian</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         
                       <input type="text" list="guardiannames" id="guardianname" <?php if ($guardiansurname!="" or $guardianothername!=""){ ?> value="<?php echo $guardiansurname.' '.$guardianothername ?>" <?php } ?>  class="form-control col-md-7 col-xs-12" placeholder="Please type and select Guardian name" required="required" onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'guardianid');">

                        <datalist id="guardiannames">

                            <?php
                             $records=$schoolhelpDH->alldash('guardian', 'gid', 'ASC');
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                           
                            ?>
                            <option data-value="<?php echo $fieldrecord['gid']; ?>"  value="<?php echo $fieldrecord['surname'].' '.$fieldrecord['othername']; ?>">
                            <?php } 
                          }?>
                           </datalist>
                           <input name="guardianid" id="guardianid" class="form-control col-md-7 col-xs-12" type="hidden"  required="required" value="<?php echo $guardianid; ?>" >
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="studentnname">Student</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         
                       <input type="text" list="studentnames" id="studentnname" <?php if ($recorddata['surname']!="" or $recorddata['othername']!=""){ ?> value="<?php echo $recorddata['surname'].' '.$recorddata['othername'] ?>" <?php } ?>  class="form-control col-md-7 col-xs-12" placeholder="Please type and select Guardian Wards Name " required="required" onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'studentid');">

                        <datalist id="studentnames">

                            <?php
                             $records1=$schoolhelpDH->alldash('students', 'stid', 'ASC');
                              if (is_array($records)) {
                               
                              foreach($records1 as $fieldrecord1){
                           
                            ?>
                            <option data-value="<?php echo $fieldrecord1['stid']; ?>"  value="<?php echo $fieldrecord1['surname'].' '.$fieldrecord1['othername']; ?>">
                            <?php } 
                          }?>
                           </datalist>
                           <input name="studentid" id="studentid" class="form-control col-md-7 col-xs-12" type="hidden"  required="required" value="<?php echo $recorddata['stid']; ?>" >
                        </div>
                      </div>

                       <div id="msg" ></div>
                                  <div class="ln_solid"></div>
                                  <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                      
                                      <button class="btn btn-primary" type="reset">Reset</button>
                                      <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                          </div>

                          <?php  } ?>

                    </form>
                  </div>
                  </fieldset>
                 </div>
                <?php } ?>

                <?php if ($page==5) {
                   $studentid=trim(isset($_GET['id'])?$_GET['id']:false);
                    $record=$schoolhelpDH->alldashedit('students', 'stid', $studentid);

                        if (is_array($record)) {
                        
                          foreach($record as $recorddata){
                            $guardianid=$recorddata['guardianid'];
                           
                            $levelid=$recorddata['levelid'];
                            $optionid=$recorddata['optid'];
                            $operatorid=$recorddata['operatorid'];
                             //Getting staff
                            $guardiansurname="";
                            $guardianothername="";
                            $studentsurname="";
                            $studentothername="";
                             $records=$schoolhelpDH->alldashedit('guardian', 'gid', $guardianid);
                            if (is_array($records)) {         
                            foreach($records as $guardianrecord){
                              $guardiansurname=trim($guardianrecord['surname']);
                              $guardianothername=trim($guardianrecord['othername']);
                              $guardianpassport=trim($guardianrecord['passport']);
                            }
                            }
                                $odatet=trim($recorddata['odate']);
                                $udate=trim($recorddata['udate']);

                               //Getting Admin Detials
                              
                                 $adminrecords=$schoolhelpDH->alldashedit('adminpersons', 'adminid', $operatorid);
                                  if (is_array($adminrecords)) { 
                                 foreach($adminrecords as $adminrecord){
                                    $adminsurname=$adminrecord['surname'];
                                    $adminothername=$adminrecord['othername'];
                                 }
                               }
                           


                                

                              //collecting level record
                             
                                  $levelrecords=$schoolhelpDH->alldashedit('level', 'levelid', $levelid);
                                  if (is_array($levelrecords)) { 
                                 foreach($levelrecords as $levelrecord){
                                    $levelname=$levelrecord['levelname'];
                                    $departmentid=$levelrecord['departmentid'];
                                   }
                                 }

                                   //collecting department record
                             
                                 $departmentrecords=$schoolhelpDH->alldashedit('department', 'did', $departmentid);
                                 if (is_array($departmentrecords)) { 
                                 foreach($departmentrecords as $departmentrecord){
                                    $departmentname=$departmentrecord['deptname']; 
                                 }
                               }

                              //collecting option record
                                  $optionrecords=$schoolhelpDH->alldashedit('optiontable', 'optid', $optionid);
                                  if (is_array($optionrecords)) { 
                                 foreach($optionrecords as $optionrecord){
                                    $optionname=$optionrecord['optname'];
                                   }
                                 }
                    
                    
                  ?>
                    <div class="x_panel" >
                  <div class="x_title">
                    <h3><?php echo $pagename; ?> Details </h3>
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
                          <h3>
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo  $recorddata['surname']. ' '.$recorddata['othername']."  assigned to ". $guardiansurname. ' '.$guardianothername; ?>
                                          <small class="pull-right">Date: <?php echo $odate; ?></small>
                                      </h3>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                       
                       
                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col">
                         <img id="userimage" <?php if ($guardianpassport!="") {?> style="display: block" src="images/uploads/guardian/<?php echo $guardianpassport ?>" <?php } ?> class="img img-responsive img-thumbnail" >
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
                          <center><p class="lead schoolhelpcolor"><b><?php echo  $recorddata['surname']. ' '.$recorddata['othername']."  assigned to ". $guardiansurname. ' '.$guardianothername; ?> Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Guardian:</th>
                                  <td><?php echo $guardiansurname.' '.$guardianothername; ?></td>
                                </tr>
                                  <tr>
                                  <th>Student</th>
                                  <td><?php echo $recorddata['surname']. ' '.$recorddata['othername']; ?></td>
                                </tr>
                               
                                <tr>
                                  <th>Department:</th>
                                  <td><?php echo $departmentname; ?></td>
                                </tr>
                                 <tr>
                                  <th>Level:</th>
                                  <td><?php echo $levelname; ?></td>
                                </tr>
                                 <tr>
                                  <th>Option:</th>
                                  <td><?php echo $optionname; ?></td>
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
                          <div class="col-xs-6"><button class="btn btn-success print-link" ><i class="fa fa-print"></i> Print</button></div>
                          <div class="col-xs-6"><a class="btn btn-danger "  href="?page=3&schoolhelp=<?php echo $schoolhelp; ?>&id=<?php echo $recorddata['stid']; ?>"><i class="fa fa-edit"></i> Edit</a></div>
                          
                          
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
                <?php


                              }
                    
                    }
                 } ?>
              </div>
            </div>
       <?php include("includes/footer.php"); ?>