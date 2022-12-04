<?php
include_once("includes/global.php");
include_once("includes/connection.php");
include_once("phpclass/SHdashOOP.php");
include_once("phpclass/SHdashupdate.php");
include_once("phpclass/SHdashinserts.php");
confirmcheckin();
$SHDashOOP=new ClassDash;
$pagename="Student Attendance";
$tablestudents=new insertTable;
 $tableUpdate= new updateTable;

// Checking page access Authenticity
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp=trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$page=trim(isset($_GET['page'])?$_GET['page']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

$previlleges=$SHDashOOP->alldashedit('adminpersons', 'adminid', $schoolhelp);
if ($previlleges) {
  
foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['attendance_d']);
  $dashadd_d=trim($actualrecord['dashadd_d']);
  
}

}

if ($pageaccess!=1) {
  echo "<b style='font-size:100; color:red'>Criminal Attempt Made, contact the admin ask for the access of this page</b>";
  exit();
}

//This script is to determine the actual admin that is logging whether a super admin or a position holder in a school
$admindata=$SHDashOOP->alldashedit('adminpersons', 'adminid', $schoolhelp);
if (is_array($admindata)) {
  foreach($admindata as $adminrec){
   $admintype= $adminrec['admintype'];
   $signatorypositionid= $adminrec['signatorypositionid'];
  }
}

if ($admintype==1) {
  $departmentid='';
}
else{

$signatorydata=$SHDashOOP->alldashedit('signatoryposition', 'signatorypositionid', $signatorypositionid);
if (is_array($signatorydata)) {
  foreach($signatorydata as $signatoryrec){
   $departmentid=$signatoryrec['departmentid'];
  }
}

}

  $levelid="";
  $optionid="";
  if($page==5){
    $date=(isset($_POST["mdate"])?$_POST["mdate"]:false);
    $mdate=date('Y-m-d',strtotime($date));
    $levelid=(isset($_POST["levelid"])?$_POST["levelid"]:false);
    $optionid=(isset($_POST["optionid"])?$_POST["optionid"]:false);

     $leveldata=$SHDashOOP->alldashedit('level', 'levelid', $levelid);
        if (is_array($leveldata)) {
        foreach($leveldata as $levelrec){ 
            $scoredeptid=trim($levelrec['departmentid']); 
            $levelname=trim($levelrec['levelname']); 
      }
    }
  
  $optiondata=$SHDashOOP->alldashedit('optiontable', 'optid', $optionid);
    if (is_array($optiondata)) {
     foreach($optiondata as $optionrec){ 
      $optionname=trim($optionrec['optname']); 
   }
  }

    }

if ($page==1) {

   $sessionid=trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);
   $semesterid=trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
   $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
   $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);
     //$courseid=trim(isset($_POST['courseid'])?$_POST['courseid']:false);

                          // Getting the Department ID
                           
                          $leveldata=$SHDashOOP->alldashedit('level', 'levelid', $levelid);
                            if (is_array($leveldata)) {
                              foreach($leveldata as $levelrec){ 
                                $scoredeptid=trim($levelrec['departmentid']); 
                                $levelname=trim($levelrec['levelname']); 
                              }
                            }
                             $optiondata=$SHDashOOP->alldashedit('optiontable', 'optid', $optionid);
                            if (is_array($optiondata)) {
                              foreach($optiondata as $optionrec){ 
                               
                                $optionname=trim($optionrec['optname']); 
                              }
                            }

}

  if((isset($_GET['mdate'])?$_GET['mdate']:false)==""){
  $date=date('Y-m-d');
  $mdate=date('Y-m-d', strtotime($date));
  }else{$mdate=(isset($_GET['mdate'])?$_GET['mdate']:false);}

  if ($page == 2){
      $udate=date("Y-m-d H:i:s");
      $odate=date("Y-m-d");

      $semesterid=(isset($_GET["semesterid"])?$_GET["semesterid"]:false);
      $sessionid=(isset($_GET["sessionid"])?$_GET["sessionid"]:false);
      $levelid=(isset($_GET["levelid"])?$_GET["levelid"]:false);
      $optionid=(isset($_GET["optionid"])?$_GET["optionid"]:false);

       //Getting the class information
                    $studentsclass=$SHDashOOP->alldashedit('level', 'levelid', $levelid);
                    if (is_array($studentsclass)) {
                      foreach($studentsclass as $studentsclassrec){
                        $levelname=$studentsclassrec['levelname'];
                        $departmentid=trim($studentsclassrec['departmentid']);
                        $tbl_attendance="attendance".$departmentid;
                          }
                      }
      
      
      $mdate=date('Y-m-d', strtotime($mdate));
      $stuid=(isset($_POST['studid'])?$_POST['studid']:false);
      
      $atid="";
      
      $Cnt = 0;
      $stutotal = count($stuid);
      $Cnt333 = 0;
      
      foreach($stuid as $i => $stuid1){
   
      
      $student_status=(isset($_POST[$levelid.$stuid1])?$_POST[$levelid.$stuid1]:false);
      if($student_status==""){
        $student_status=0;
      }
       if($student_status>0){
        $student_status=1;
      }
        
      $student_group = $optionid;
      
      $studentsattend=$SHDashOOP->alldashedit2($tbl_attendance, 'stid', $stuid1, 'attendancedate', $mdate);
      if (is_array($studentsattend)) {
        foreach ($studentsattend as $attendrec) {
          echo $atid=trim($attendrec['attendanceid']);
        }
      
      $resultupdate=$tableUpdate->update_attendance($tbl_attendance, $atid, $student_status, $schoolhelp, $udate);
      $Cnt += 1;
      }else{
       $resultupdate=$tablestudents->insert_attendance($tbl_attendance, $stuid1, $student_status, $levelid, $optionid, $semesterid, $sessionid, $schoolhelp, $mdate, $udate, $odate);
      $Cnt333 += 1;
     
      
      
      }
      
  
  }
  
  if($resultupdate){
      $sql= "<b>$Cnt333 Student Attendance newly Marked and $Cnt Attendance Updated out of $stutotal<b>";
      
      
      echo "<script language='javascript'>
        location.href='attendance?schoolhelp=$schoolhelp&class=$levelid&gid=$optionid&sql=$sql';
        </script>";
      }else{$sql= "<b>Operation was not successful<b>";}
      
      
    $stuid="";
    $page="";
  }


//this helps you to know the kind of driver you are using
//print_r(PDO::getAvailableDrivers());
 ?>

    <?php include("includes/header.php"); ?>
        <!-- page content -->
    <div class="right_col" role="main">
          <div class="">

          
            <div class="row">
              <div class="col-md-12" style="width: 100%">
                <div class="x_panel"  >
                  <div class="x_title">
                  <div class="col-md-4" style=""><h3>
                    <ul class="nav panel_toolbox" style="float:left">
                      <li><a class="btn btn-primary" href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                      
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                          <li ><a  href="Csettings?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  System Setup</a></li>
                          <li ><a  href="result?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> Result</a></li>
                        </ul>
                      </li>
                      
                    </ul>
                  </h3></center></div>
                   <div class="col-md-4"><span style="float:right"> <h3 style="color:black"><?php echo $pagename; ?></h3></span></div>
                   <div class="col-md-4"><ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link" style="color:#d2dc2a;"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench" style="color:#d2dc2a;"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="../settings?schoolhelp=<?php echo $schoolhelp; ?>">System Settings</a>
                          </li>
                          <li><a href="index?schoolhelp=<?php echo $schoolhelp ?>">Result Settings</a>
                          </li>
                        </ul>
                      </li>
                      <li><a  class="close-link" href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-close " style="color:#d2dc2a;"></i></a>
                      </li>
                    </ul>
                  </div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="row">
                     
            <fieldset>
            <legend>Attendance</legend>
                                      
            <form method="post" action="attendance?schoolhelp=<?php echo $schoolhelp; ?>&page=5" name="frmSearch" onSubmit="return attendancecheck();">
              <table  class="table table-responsive table-stripped">
                <thead><tr><th class="col-md-3">Session</th><th class="col-md-3">Semester/Term</th><th class="col-md-3">Date:</th><th class="col-md-3">Level|Class:</th><th class="col-md-3">Option/Group:</th><th class="col-md-3">Action</th></tr></thead>
                <tbody>
                  <tr style="padding-left:6%;">
                       <td class="col-md-2"><select  name="sessionid" id="sessionid" required="required"  class="form-control col-md-1 col-xs-2" >
                               <option value="">--Select Session--</option>
                              <?php
                               $retrievedata1=$SHDashOOP->alldash('session', 'sessionid', 'desc');
                                if (is_array($retrievedata1)) {
                                foreach($retrievedata1 as $field1){
                              ?>
                                    <option value="<?php echo $field1['sessionid']; ?>" <?php if ($field1['status']==1) {?> selected="selected" <?php } ?> ><?php echo $field1['sessionlow'].' - '.$field1['sessionhigh']; ?></option>
                              <?php
                                  }
                                }
                                ?>
                            </select></td>

                              <td class="col-md-2"><select  name="semesterid" id="semesterid" required="required"  class="form-control col-md-1 col-xs-2" >
                               <option value="">--Select Semester/Term--</option>
                              <?php
                              $retrievedata=$SHDashOOP->alldash('semesters', 'semesterid', 'desc');
                                if (is_array($retrievedata)) {
                                foreach($retrievedata as $field){
                              ?>
                                    <option value="<?php echo $field['semesterid']; ?>" <?php if ($field['status']==1) {?> selected="selected" <?php } ?> ><?php echo $field['semestername']; ?></option>
                              <?php
                                  }
                                }
                                ?>
                            </select></td>
                      <td>
                        <input  class="form-control" name="mdate"  type="date"  value="<?php echo $mdate; ?>"/>
                      </td>
                       <td style="padding-right:20px">
                        <select  id="levelid" required="required" name="levelid" class="form-control col-md-4" onchange="retrieveselection1('optiontable', 'levelid', this.value, 0, 0, 'retrieveselection4', 'optioncontainer');">
                            <option value="">--Select Level--</option>
                            <?php
                            $levelmethod=$SHDashOOP->alldash('level','levelid','asc');
                            if (is_array($levelmethod)) {
                            foreach($levelmethod as $leveldata){

                               $deptdata=$SHDashOOP->alldashedit('department', 'did', $leveldata['departmentid']);
                              if (is_array($deptdata)) {
                                foreach($deptdata as $deptrec){
                                        $deptname=$deptrec['deptname'];
                                }
                              }

                              if ($admintype==0) {
                                if ($leveldata['departmentid']==$departmentid) {?>
                                  <option value="<?php echo $leveldata['levelid']; ?>" <?php if ($leveldata['levelid']==$levelid){ ?> selected <?php } ?> ><?php echo $leveldata['levelname']; ?></option>
                            <?php  }
                              }else{
                            ?>
                            <option value="<?php echo $leveldata['levelid']; ?>"  <?php if ($leveldata['levelid']==$levelid){ ?> selected <?php } ?> ><?php echo $leveldata['levelname'].' => '.$deptname; ?></option>
                            <?php }
                              } 
                            }
                            ?>
                          </select>
                    </td>

                    
                        <td >
                          <div id="optioncontainer" >
                            <select  id="optionid" required="required" name="optionid" class="form-control col-md-4" >
                            <option value="">--Select Option--</option>
                            
                          </select>                                                                                                                                                            </div>                                                                                                                                
                       </td>
                      <td><table><tr><td style="padding-left:15px;"><input type="submit" class="btn btn-info btn-mini" value="Load Students" /></td></tr></table></td>
                  </tr>
                  </tbody>
              </table>         
            
             </fieldset>
             </form>
           
                  </div>  
                  <div><h3 style="color:green"><?php echo $sql; ?></h3></div>
                  <?php if ($page==5) { ?>  
                    <fieldset>
                        <legend style="color:#063"> <?php echo $levelname.' '.$optionname .' Attendance of '.$mdate ; ?></legend>
                        <form method="post" action="?schoolhelp=<?php echo $schoolhelp; ?>&page=2&levelid=<?php echo $levelid; ?>&mdate=<?php echo $mdate; ?>&optionid=<?php echo $optionid; ?>" name="frmReg" onSubmit="return attmark();" >
                          <input name="optionid"  id="optionid" value="<?php  echo trim($optionid); ?>" type="hidden"/>
                          <input name="levelid"  id="levelid" value="<?php  echo trim($levelid); ?>" type="hidden"/>
                          <input name="semesterid"  id="semesterid" value="<?php  echo trim($semesterid); ?>" type="hidden"/>
                          <input name="sessionid"  id="sessionid" value="<?php  echo trim($sessionid); ?>" type="hidden"/>
                          
                          <input name="deptid"  id="deptid" value="<?php  echo trim($scoredeptid); ?>" type="hidden"/>

                          <div style="padding-top:15px">  
        
      <span style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#0C0;"><?php echo $sql; ?></span>
              <table class="table table-bordered" >  
                 
                  <thead>
                <tr>
                                  <th>SN</th>
                  <th><input name="topcheckbox"  type="checkbox" id='checkAll' value="" />  Select All</th>
                  <th>Reg No</th>
                  <th>Student Name</th>
                  
                                    
                                    <th>Status</th>
                </tr>
                </thead>
                                <?php
             $records=$SHDashOOP->dashedit3order('students', 'levelid', $levelid, 'optid', $optionid, 'status', 0, 'surname');

             if (is_array($records)) {
             $sn=0;
             foreach($records as $fieldrecord){
             $sn+= 1; 
             $cstuid=trim($fieldrecord['stid']);
             $levelname="";
             $departmentid="";

             //Getting the class information
                    $studentsclass=$SHDashOOP->alldashedit('level', 'levelid', $levelid);
                    if (is_array($studentsclass)) {
                      foreach($studentsclass as $studentsclassrec){
                        $levelname=$studentsclassrec['levelname'];
                        $departmentid=trim($studentsclassrec['departmentid']);
                          }
                      }

                      //Getting the class information
                    $studentsoption=$SHDashOOP->alldashedit('optiontable', 'optid', $optionid);
                    if (is_array($studentsclass)) {
                      foreach($studentsoption as $studentoptionrec){
                        $optionname=$studentoptionrec['optname'];
                       
                          }
                      }

                      $attendancetable="attendance".trim($departmentid);
                      $attendanceid="";
                        $attendancestatus="";
                        $retrieveattend_num="";


             $records1=$SHDashOOP->alldashedit4($attendancetable, 'levelid', $levelid, 'optionid', $optionid, 'stid', $cstuid, 'attendancedate', $mdate);
             if (is_array($records1)) {
                      foreach($records1 as $records1rec){
                        $attendanceid=trim($records1rec['attendanceid']);
                        $attendancestatus=trim($records1rec['status']);
                      }
                  }
                        $retrieveattend_num=count($records1);
          ?>    
                        
                <tbody ><tr height="23" onMouseOver="this.style.backgroundColor='#FFCC66';" onMouseOut="this.style.backgroundColor='';"> 
                                  
                  <td><?php echo $sn;  ?><input name="studid[]"  id="studid[]" value="<?php  echo $fieldrecord['stid']; ?>" type="hidden"/>
                                      <td> <input name="<?php echo trim($levelid.$cstuid); ?>" id="<?php echo trim($cstuid); ?>" type="checkbox" class="status1"  value="<?php if($retrieveattend_num>0){ echo 1;}else{echo 0;} ?>"  onchange="if(this.checked){ this.value=1; }else{this.value=0;}" <?php if($attendancestatus==1){?>checked<?php } ?>/> </td>   
                  <td><?php  echo ucfirst($fieldrecord ['regno']); ?></td>
                  <td><?php  echo $fieldrecord ['surname']." ". $fieldrecord ['othername']; ?></td>
                  
                   <td>
                                    <?php if($attendancestatus==1){ echo "Present"; }else { echo "Absent"; }?>
                                   
                                    </td>                                                   
                </tr></tbody>
             <?php } 


              }?>
              
      </table>
            <table style="margin-bottom:20px">
              <tr>
                  <td colspan="4" > <input id="save" type="submit" class="btn btn-info btn-mini" value=" Mark Present " /> </td>
                </tr>
            </table>
   </div>
                  </form>
                    </fieldset>
                    <?php } ?>
                     
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

       <?php include("includes/footer.php"); ?>

       