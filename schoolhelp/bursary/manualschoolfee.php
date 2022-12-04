<?php
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHbusaryOOP.php");
include_once("../phpclass/SHbusaryupdate.php");
include_once("../phpclass/SHbusaryinserts.php");
confirmcheckin();
$SHbusaryOOP=new classBusary;


$tableUpdate= new updateTable;
$tableInsert=new insertTable;
$pagename="Add school fees manually";


// Checking page access Authenticity


$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp=trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$page=trim(isset($_GET['page'])?$_GET['page']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);

$previlleges=$SHbusaryOOP->allbusaryedit('adminpersons', 'adminid', $schoolhelp);
if ($previlleges) {
  
  foreach($previlleges as $actualrecord){
    $pageaccess=trim($actualrecord['result_d']);
    $dashadd_d=trim($actualrecord['dashadd_d']);
    
  }

}

if ($pageaccess!=1) {
  echo "<b style='font-size:100; color:red'>Criminal Attempt Made, contact the admin ask for the access of this page</b>";
  exit();
}

//This script is to determine the actual admin that is logging whether a super admin or a position holder in a school
$admindata=$SHbusaryOOP->allbusaryedit('adminpersons', 'adminid', $schoolhelp);
if (is_array($admindata)) {
  foreach($admindata as $adminrec){
   $admintype= trim($adminrec['admintype']);
   $signatorypositionid= trim($adminrec['signatorypositionid']);
   $fullname=trim($adminrec['surname'])." ".trim($adminrec['surname']);
  }
}

if ($admintype==1) {
  $departmentid='';
}
else{

$signatorydata=$SHbusaryOOP->allbusaryedit('signatoryposition', 'signatorypositionid', $signatorypositionid);
if (is_array($signatorydata)) {
  foreach($signatorydata as $signatoryrec){
   $departmentid=trim($signatoryrec['departmentid']);
  }
}

}


if ($page==1) {

  $levelid=trim(isset($_GET['levelid'])?$_GET['levelid']:false);
 
}


  if($page == 2){

  $mafid  =trim(isset($_POST["mafid"])?$_POST["mafid"]:false);
  $stid  =trim(isset($_POST["studentid"])?$_POST["studentid"]:false);
  $nexttermfee =trim(isset($_POST["nexttermfee"])?$_POST["nexttermfee"]:false);
  $arears =trim(isset($_POST["arears"])?$_POST["arears"]:false);
  $otherfee =trim(isset($_POST["otherfee"])?$_POST["otherfee"]:false);
  $semesterid = trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
  $sessionid = trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);
  $odate=date("Y-m-d");

  $levelid="";
  $records1=$SHbusaryOOP->allbusaryedit('students', 'stid', $stid);
    if (is_array($records1)) {
      foreach($records1 as $fieldrecord1){ 
        $levelid=trim($fieldrecord1['levelid']);
        $optionid=trim($fieldrecord1['optid']);
      }
    }
    
   $departmentid="";
   $records2=$SHbusaryOOP->allbusaryedit('level', 'levelid', $levelid);
    if (is_array($records2)) {
      foreach($records2 as $fieldrecord2){ 
        $departmentid=trim($fieldrecord2['departmentid']);
      }
    }

 
  $date = date("Y-m-d");
  $status=trim(isset($_GET["status"])?$_GET["status"]:false);
       
      if($mafid==""){
        
      $state=$tableInsert->insert_11fields('manuallyaddfees', 'stid', $stid, 'departmentid', $departmentid, 'odate', $odate, 'nexttermfee', $nexttermfee, 'sessionid', $sessionid, 'operatorid', $schoolhelp, 'semesterid', $semesterid, 'levelid', $levelid, 'optionid', $optionid, 'arears', $arears, 'others', $otherfee);
      
      if ($status!="") {

        echo " 
        <script language='javascript'>
          alert('Sucessfully Added! ');
          location.href='?page=3&status=1&semesterid=$semesterid&sessionid=$sessionid&levelid=$levelid&schoolhelp=$operatorid'
        </script>
          ";
        }else{
          echo " 
        <script language='javascript'>
          alert(' Sucessfully Added! ');
          location.href='?page=1&levelid=$levelid&schoolhelp=$schoolhelp'
        </script>
          ";
        }

      }else{
        

        echo $state=$tableUpdate->update_eightfields('manuallyaddfees', 'mafid', $mafid, 'departmentid', $departmentid, 'levelid', $levelid, 'optionid', $optionid, 'nexttermfee', $nexttermfee, 'arears', $arears, 'others', $otherfee, 'odate', $odate,  'operatorid', $schoolhelp);

        exit()
        if ($status!="") {
        echo " 
        <script language='javascript'>
          alert(' Sucessfully Updated! ');
          location.href='?page=3&status=1&semesterid=$semesterid&sessionid=$sessionid&levelid=$levelid&schoolhelp=$schoolhelp'
        </script>
          ";
        }else{

          echo " 
        <script language='javascript'>
          alert(' Sucessfully Updated! ');
          location.href='?page=1&levelid=$levelid&schoolhelp=$schoolhelp'
        </script>
          ";
        }
        
      }
      
    
  }


  if ($page==3) {
    $status = trim(isset($_GET['status'])?$_GET['status']:false);
    if ($status!="") {
       $levelid = trim(isset($_GET['levelid'])?$_GET['levelid']:false);
       $semesterid = trim(isset($_GET['semesterid'])?$_GET['semesterid']:false);
       $sessionid = trim(isset($_GET['sessionid'])?$_GET['sessionid']:false);
       $optionid = trim(isset($_GET['optionid'])?$_GET['optionid']:false);
    }else{
      $levelid = trim(isset($_POST['levelid'])?$_POST['levelid']:false);
      $semesterid = trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
      $sessionid = trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);
      $optionid = trim(isset($_POST['optionid'])?$_POST['optionid']:false);
     }
     
  }


  if ($page==4) {
     echo $levelid = trim(isset($_POST['levelid'])?$_POST['levelid']:false);
     $nexttermfee = trim(isset($_POST['nexttermfee'])?$_POST['nexttermfee']:false);
     echo $semesterid = trim(isset($_POST['semesterid'])?$_POST['semesterid']:false);
     echo $sessionid = trim(isset($_POST['sessionid'])?$_POST['sessionid']:false);

       $updatedfees=0;
        $insertedfees=0;
        $odate=date("Y-m-d");
        $optionid="";
        $insertedrec=0;

    $records1=$SHbusaryOOP->allbusary('students', 'stid', 'ASC');
      if (is_array($records1)) { 

      $mafid="";

        foreach($records1 as $fieldrecord1){ 
    
        $optionid=trim($fieldrecord1['optid']);
        echo $stid=trim($fieldrecord1['stid']);

        $leveldata=$SHbusaryOOP->allbusaryedit('level', 'levelid', trim($levelid));
          if (is_array($leveldata)) {
            foreach($leveldata as $levelrec){
              $departmentid=trim($levelrec['departmentid']);
              }
            }

        $records2=$SHbusaryOOP->allbusaryedit4('manuallyaddfees', 'sessionid', $sessionid, 'semesterid', $semesterid, 'levelid', $levelid, 'stid', $stid);
         if (is_array($records2)) {
            foreach($records2 as $fieldrecord2){
              $mafid=trim($fieldrecord2['mafid']);
            }
          }

       
        if ($mafid!="") {
          $updatedfees+=1;
          $state=$tableUpdate->update_twofields('manuallyaddfees', 'mafid', $mafid, 'nexttermfee', $nexttermfee, 'operatorid', $schoolhelp);
         // mysqli_query($mysqli, "UPDATE manuallyaddfees SET nexttermfee='$nexttermfee', sdate='$date', userid='$userID' WHERE mafid='$mafid'")or die(mysqli_error($mysqli));
          $sql=$state.":: Update Made, affected records = 1";
        }
        else{
          $insertedfees+=1;
          $state=$tableInsert->insert_9fields('manuallyaddfees', 'stid', $stid, 'odate', $odate, 'nexttermfee', $nexttermfee, 'sessionid', $sessionid, 'operatorid', $schoolhelp, 'departmentid', $departmentid, 'semesterid', $semesterid, 'levelid', $levelid, 'optionid', $optionid);
          $sql=$state.":: Insertion Made, affected records = ".$insertedrec;

        }

      }
      
      $sql=$insertedfees. "Student fee Inserted and ".$updatedfees. " Student Updated fee";
     }
    
     echo "<script language='javascript'>
          alert('Sucessfully Updated! ');
          location.href='?sql=$sql&schoolhelp=$schoolhelp'
        </script>
          ";
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
                      <li><a class="btn btn-primary" href="../?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Dashboard</i></a>
                      
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                          <li ><a  href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> Busary Home </a></li>
                           <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i> Manual Fee </a></li>
                           
                        </ul>
                      </li>
                      
                    </ul>
                  </h3></center></div>
                   <div class="col-md-4"><span style="float:left"> <h3 style="color:black"><?php echo $pagename; ?></h3></span></div>
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
                     

                   <div class="x_panel table-responsive" style="width: 100%; overflow-y: hidden">
                    <form  action="?page=3&schoolhelp=<?php echo $schoolhelp ?>" name="search" method="post" >
                      <fieldset>
                        <legend>Manual Fee</legend>
                               
                          <table>
                            <thead>
                              <tr>
                                <th class="col-md-2">Session</th>
                                <th class="col-md-2">Semester/Term</th>
                                <th class="col-md-2">Level/Class: </th>
                                <th class="col-md-2"><table><tr><td class=" col-md-2">Option/Arm:  </td></tr></table></th>                
                                <th class=" col-md-2">Action: </th>
                              </tr>
                            </thead>
                            <tbody>
                             <tr>
                          
                              <td class="col-md-2"><select  name="sessionid" id="sessionid" required="required"  class="form-control col-md-1 col-xs-2" >
                               <option value="">--Select Session--</option>
                              <?php
                               $retrievedata1=$SHbusaryOOP->allbusary('session', 'sessionid', 'desc');
                                if (is_array($retrievedata1)) {
                                foreach($retrievedata1 as $field1){
                              ?>
                                    <option value="<?php echo trim($field1['sessionid']); ?>" <?php if ($field1['status']==1) {?> selected="selected" <?php } ?> ><?php echo trim($field1['sessionlow']).' - '.trim($field1['sessionhigh']); ?></option>
                              <?php
                                  }
                                }
                                ?>
                            </select></td>

                              <td class="col-md-2"><select  name="semesterid" id="semesterid" required="required"  class="form-control col-md-1 col-xs-2" >
                               <option value="">--Select Semester/Term--</option>
                              <?php
                              $retrievedata=$SHbusaryOOP->allbusary('semesters', 'semesterid', 'desc');
                                if (is_array($retrievedata)) {
                                foreach($retrievedata as $field){
                              ?>
                                    <option value="<?php echo $field['semesterid']; ?>" <?php if ($field['status']==1) {?> selected="selected" <?php } ?> ><?php echo $field['semestername']; ?></option>
                              <?php
                                  }
                                }
                                ?>
                            </select></td>
                          
                    <td style="padding-right:20px" class="col-md-2">
                        <select  id="levelid" required="required" name="levelid" class="form-control col-md-2" onchange="retrieveselection1('optiontable', 'levelid', this.value, 0, 0, 'retrieveselection4', 'opencontainer');">
                            <option value="">--Select Level--</option>
                            <?php
                            $levelmethod=$SHbusaryOOP->allbusary('level','levelid','ASC');
                            if (is_array($levelmethod)) {
                            foreach($levelmethod as $leveldata){

                              $deptdata=$SHbusaryOOP->allbusaryedit('department', 'did', trim($leveldata['departmentid']));
                              if (is_array($deptdata)) {
                                foreach($deptdata as $deptrec){
                                        $deptname=$deptrec['deptname'];
                                }
                              }

                              if ($admintype==0) {
                                if ($leveldata['departmentid']==$departmentid) {?>
                                  <option value="<?php echo $leveldata['levelid']; ?>"  ><?php echo $leveldata['levelname']; ?></option>
                            <?php  }
                              }else{
                            ?>
                            <option value="<?php echo $leveldata['levelid']; ?>"  ><?php echo $leveldata['levelname'].' => '.$deptname; ?></option>
                            <?php }
                              } 
                            }
                            ?>
                          </select>
                    </td>

                  <td id="opencontainer" class="col-md-2">
                            <table>
                              <tr>
                        <td>
                            <select  id="optionid" required="required" name="optionid" class="form-control col-md-2">
                            <option value="">--Select Option--</option> 
                          </select>                                                                                                                                                         
                       </td>
                        
                     </tr>
                     </table>
                     </td>
                         
                  <td class="col-md-2"> <input  type="submit" class="btn btn-primary" value="Search" class="col-md-2"  ></td>
             </tr>
           </tbody>
              </table>
            
            
             </fieldset>
             </form>
           
                  </div>  
                  <div><h3 style="color:green"><?php echo $sql; ?></h3></div>
                  <?php if ($page==1) {
                    $x=0;

                    $admindata=$SHbusaryOOP->allbusaryedit('adminpersons', 'adminid', trim($schoolhelp));
                    if (is_array($admindata)) {
                        foreach($admindata as $adminrec){
                          $adminsurname=trim($adminrec['surname']);
                          $adminothername=trim($adminrec['othername']);
                        }
                    }

                     $leveldata=$SHbusaryOOP->allbusaryedit('level', 'levelid', trim($levelid));
                    if (is_array($leveldata)) {
                        foreach($leveldata as $levelrec){
                          $levelname=trim($levelrec['levelname']);
                        }
                    }


                    $records2=$SHbusaryOOP->allbusaryedit('semesters', 'status', 1);
                    if (is_array($records2)) { 
                      foreach($records2 as $fieldrecord2){ 
                        $semestername=trim($fieldrecord2['semestername']);
                        $semesterid=trim($fieldrecord2['semesterid']);
                        }
                    }

                    $records2=$SHbusaryOOP->allbusaryedit('session', 'status', 1);
                    if (is_array($records2)) { 
                      foreach($records2 as $fieldrecord2){ 
                        $sessionname=trim($fieldrecord2['sessionlow'])." / ".trim($fieldrecord2['sessionhigh']);
                        $sessionid=trim($fieldrecord2['sessionid']);
                        }
                      }
                    
                 
                    ?>  
                    <fieldset>
                        <legend style="color:#063"> Manual Fee </legend>
                        <form method="POST" action="?schoolhelp=<?php echo $schoolhelp; ?>&page=2" name="frmscoresheet">
                          <input name="optionid"  id="optionid" value="<?php  echo trim($optionid); ?>" type="hidden"/>
                          <input name="levelid"  id="levelid" value="<?php  echo trim($levelid); ?>" type="hidden"/>
                          <input name="semesterid"  id="semesterid" value="<?php  echo trim($semesterid); ?>" type="hidden"/>
                          <input name="sessionid"  id="sessionid" value="<?php  echo trim($sessionid); ?>" type="hidden"/>
                          
                          <input name="deptid"  id="deptid" value="<?php  echo trim($scoredeptid); ?>" type="hidden"/>

                          
                          <div><h3 style="color:green"><?php echo $sql; ?></h3></div>  
                      <div class="x_panel" >
                       
                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <center><caption><h1><?php echo $levelname; ?></h1></caption></center>
                      <thead>
                        <tr>

                          <th>SN</th>
                          <th>Student</th>
                          <th>Class</th>
                          <th>Group</th>
                          <th>Term</th>
                          <th>session</th>
                          <th>Next Term Fees</th>
                          <th>Arears</th>
                          <th>Others</th>
                          <th>Total</th>
                           <?php if ($dashedit_d==1) { ?>
                          
                          <th style="width:10%;"><i class="fa fa-edit" style="color:#d2dc2a"></i> Edit</th>
                          <?php } ?>
                       
                      </thead>

                      <tbody>
                        <?php $k=0; 

                            ?>
                            
                           <?php  
                         
                            $records=$SHbusaryOOP->allbusaryorder2('students', 'levelid', $levelid, 'status', 0, 'surname', 'ASC');
                              if (is_array($records)) {
                               $sn=0;

                              foreach($records as $fieldrecord){
                               
                               $stid=trim($fieldrecord['stid']);

                               $optionid=trim($fieldrecord['optid']);
                               $optionname="";

                               $optiondata=$SHbusaryOOP->allbusaryedit('optiontable', 'optid', trim($optionid));
                                if (is_array($optiondata)) {
                                    foreach($optiondata as $optionrec){
                                      $optionname=trim($optionrec['optname']);
                                    }
                                }

                                $mafid="";
                                $nexttermfee="";
                                $arears="";
                                $others="";
                                $total="";
                                $operatorid="";
                                
                                $udate="";
                                $odate="";

                                 
                            $records1=$SHbusaryOOP->allbusaryedit4('manuallyaddfees', 'levelid', $levelid, 'sessionid', $sessionid, 'semesterid', $semesterid, 'stid', $stid);
                              if (is_array($records1)) {
                               
                              foreach($records1 as $fieldrecord1){
                                $mafid="";
                                $mafid=trim($fieldrecord1['mafid']);
                                $nexttermfee=trim($fieldrecord1['nexttermfee']);
                                $arears=trim($fieldrecord1['arears']) ;
                                $others=trim($fieldrecord1['others']); 
                                $total=$nexttermfee+$arears+$others;
                                $operatorid=trim($fieldrecord1['operatorid']);
                                
                                $udate=trim($fieldrecord1['udate']);
                                $odate=trim($fieldrecord1['odate']);

                                }
                              }
                              $sn+=1;
                        ?>

                                   <!-- Trigger the modal with a button -->
                              <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal<?php echo $stid; ?>" style="display:none"></button>

                              <!-- Modal -->
                              <div class="modal fade" id="myModal<?php echo $stid; ?>" role="dialog" >
                                <div class="modal-dialog">
                                
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header" style="background-color:#063">
                                      <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
                                      <center><h4 class="modal-title" style="color:white">Update <span style='color:yellow'><?php  echo $fieldrecord['surname']." ".$fieldrecord['othername']; ?></span> Fee Information </h4></center>
                                    </div>
                                    <div class="modal-body">
                                      
                                        <form action="?schoolhelp=<?php echo $schoolhelp; ?>&page=2&levelid=<?php echo $levelid; ?>" name="manuallyaddfee" method="POST">
                                            <input type="hidden" class="form-control" value="<?php echo $stid; ?>" id="studentid" name="studentid">
                                            <input type="hidden" class="form-control" value="<?php echo $mafid; ?>" id="mafid" name="mafid">
                                        <div class="form-group">
                                          <label for="nexttermfee">Next Term Fee:</label>
                                          <input type="number" class="form-control" placeholder="Enter Next term fee" name="nexttermfee" id="nexttermfee" value="<?php echo $nexttermfee; ?>" required>
                                        </div>
                                        <div class="form-group">
                                          <label for="arears">Arears</label>
                                          <input type="number" class="form-control" placeholder="Enter Arears" name="arears" id="arears" value="<?php echo $arears; ?>" required>
                                        </div>
                                        <div class="form-group">
                                          <label for="otherfee">Other fees</label>
                                          <input type="number" class="form-control" placeholder="Enter Other fees" name="otherfee"  id="otherfee" value="<?php echo $others; ?>" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary"><?php if ($mafid!="") { ?>Update<?php }else{ ?>Submit<?php } ?></button>
                                        </form>
                                        </div>
                                    
                                  </div>
                                  
                                </div>
                              </div>

                                      <tr height="23" onMouseOver="this.style.backgroundColor='#FFCC66';" onMouseOut="this.style.backgroundColor='';" data-toggle="tooltip" data-placement="top"  required="required" data-html="true" title="<em> <ul >
                                            <li ><span>Update by</span> : <?php echo  $adminsurname. " ".$adminothername ; ?></li>
                                            <li><span>Upate Date</span> : <?php echo  $fieldrecord['udate']; ?></li>
                                            <li><span>Initial Date</span> : <?php echo  $fieldrecord['odate']; ?></li>
                                            
                                          </ul></em>">
                                  
                              <td><?php echo $sn;  ?></td>
                                
                              <td style="font-size:12px;"><?php  echo $fieldrecord['surname']." ".$fieldrecord['othername']; ?></td>
                              <td><?php echo $levelname; ?></td>
                              <td><?php echo $optionname; ?></td>
                              <td><?php echo $semestername; ?></td>
                              <td><?php echo $sessionname; ?></td>
                              <td><?php echo $nexttermfee; ?></td>
                              <td><?php echo $arears; ?></td>
                              <td><?php echo $others; ?></td>
                              <td><?php echo $total; ?></td>
                               <?php if ($dashedit_d==1) { ?>
                              <td width="8%" align="center"><span onclick=" $('#myModal<?php echo $stid; ?>').modal('show');" class="btn btn-primary"><i class="fa fa-edit"></i></span></td>
                              <?php } ?>
                                </tr>
                              <?php } ?>
                              </tbody>           
                              </table>
                            <?php 
                            
                          }else{echo "Assessments not assigned yet to this department"; } ?>

                    </div>
                  </form>
                    </fieldset>
                    <?php } ?>


            <?php
              if ($page=="") {
            ?>

            <!-- Starting Point-->
            <?php
            $records=$SHbusaryOOP->allbusary('level', 'levelrank', 'ASC');
              if (is_array($records)) { $sn=0;                 
          ?>

          <div class="x_panel" >
           <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                <tr>
                  <th>SN</th>
                  <th>Department</th>
                  <th>Level</th>
                  
                  <th>Semester</th>
                  <th>session</th>
                  <th>Next Term fees</th>
                  <th>Status</th>
                  <th>Upload Fees Details</th>
                </tr>
                </thead><tbody>

              <?php 

                 foreach($records as $fieldrecord){ 
                  
                  $deptid=trim($fieldrecord['departmentid']);
                  $departmentname="";
                  $semestername="";
                  $semesterid="";
                  $sessionid="";

                  $records1=$SHbusaryOOP->allbusaryedit('department', 'did', $deptid);
                    if (is_array($records1)) { 
                      foreach($records1 as $fieldrecord1){ 
                        $departmentname=trim($fieldrecord1['deptname']);
                        }
                      }

                   $records2=$SHbusaryOOP->allbusaryedit('semesters', 'status', 1);
                    if (is_array($records2)) { 
                      foreach($records2 as $fieldrecord2){ 
                        $semestername=trim($fieldrecord2['semestername']);
                        $semesterid=trim($fieldrecord2['semesterid']);
                        }
                    }

                    $records2=$SHbusaryOOP->allbusaryedit('session', 'status', 1);
                    if (is_array($records2)) { 
                      foreach($records2 as $fieldrecord2){ 
                        $sessionname=trim($fieldrecord2['sessionlow'])." / ".trim($fieldrecord2['sessionhigh']);
                        $sessionid=trim($fieldrecord2['sessionid']);
                        }
                      }
                    
                    $levelid=trim($fieldrecord['levelid']);
                    $nexttermfee="";

                    $records3=$SHbusaryOOP->allbusaryedit3('manuallyaddfees', 'sessionid', $sessionid, 'semesterid', $semesterid, 'levelid', $levelid);
                     if (is_array($records3)) { 
                        foreach($records3 as $fieldrecord3){ 
                          $nexttermfee=trim($fieldrecord3['nexttermfee']);
                        }
                      }
                    
                    $sn+=1;
                ?>
                <tr height="23" onMouseOver="this.style.backgroundColor='#FFCC66';" onMouseOut="this.style.backgroundColor='';"> 
                                  
                  <td><?php echo $sn;  ?></td>
                    
                  <td style="font-size:12px;"><?php  echo $departmentname; ?></td>
                  <td><?php echo $fieldrecord['levelname']; ?></td>
                  
                  <td><?php echo $semestername; ?></td>
                  <td><?php echo $sessionname; ?></td>
                  <td>
                     <form action="?schoolhelp=<?php echo $schoolhelp; ?>&page=4&status=0" name="manuallyaddfee<?php echo $levelid ?>" method="POST">

                        <input type="hidden" class="form-control"  name="sessionid" id="sessionid" value="<?php echo $sessionid; ?>" >
                        <input type="hidden" class="form-control"  name="semesterid" id="semesterid" value="<?php echo $semesterid; ?>" >
                        <input type="hidden" class="form-control" name="levelid" id="levelid" value="<?php echo $levelid; ?>" required>
                          
                            <input type="number" class="form-control" placeholder="Enter Next term fee" name="nexttermfee" id="nexttermfees" value="<?php echo $nexttermfee; ?>" required style="width:60%; float:left;">
                          
                        <button type="submit" class="btn btn-primary" style="width:25%; float:left;"><?php if (count($records3)!="") { ?>Update<?php }else{ ?>Submit<?php } ?></button>
                      </form>
                  </td>
                  <td width="5%" style="font-weight:normal; clear: both;" class=" "><b><?php if (count($records3)=="" or count($records3)==0) {?><span style="color:red">None Submited</span><?php }else{?><span style="color:green">Some Submitted<?php } ?></span></b></td>

                  <td width="8%" align="center"><a href="?schoolhelp=<?php echo $schoolhelp; ?>&page=1&levelid=<?php echo $levelid; ?>" target="_parent"  class="btn btn-primary"><i class="fa fa-edit"></i></a></td>
                                                                 
                                                                                  
                </tr>
             <?php  }   ?>
                <!--<tr>
                <td> No Record Found</td>
                </tr>-->
                
      
            </tbody>    
        </table>
      </div>
        
         
      <?php
      }else {
      ?>
      <div style="text-align:center; color:red"><strong>Classes Not Found in the database</strong></div>
      <?php } ?>

      <!--End Point-->
      <?php } ?>

                <?php
                    if ($page == 3){
                ?>
               <!-- Starting Point-->
              <?php
                

              $records1=$SHbusaryOOP->allbusaryedit4('manuallyaddfees', 'levelid', $levelid, 'optionid', $optionid, 'sessionid', $sessionid, 'semesterid', $semesterid);
                if (is_array($records1)) {
                    
              ?>
            <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive"> 
                <thead>
                <tr>
                  <th>SN</th>
                  <th>Student</th>
                  <th>Level</th>
                  <th>Option</th>
                  <th>Semester</th>
                  <th>session</th>
                  <th>Next Term Fees</th>
                  <th>Arears</th>
                  <th>Others</th>
                  <th>Total</th>
                  <th>Updated by</th>
                  <th>Date</th>
                  <th>Edit</th>
                </tr>
                </thead><tbody>

            <?php 


               foreach($records1 as $fieldrecord1){
                  $optionid=trim($fieldrecord1['optionid']);
                  $levelname="";
                  $optionname="";

                  $optiondata=$SHbusaryOOP->allbusaryedit('optiontable', 'optid', $optionid);
                    if (is_array($optiondata)) {
                        foreach($optiondata as $optionrec){
                          $optionname=trim($optionrec['optname']);
                        }
                    }

                   $leveldata=$SHbusaryOOP->allbusaryedit('level', 'levelid', $levelid);
                    if (is_array($leveldata)) {
                        foreach($leveldata as $levelrec){
                          $levelname=trim($levelrec['levelname']);
                        }
                    }

                    $records2=$SHbusaryOOP->allbusaryedit('semesters', 'semesterid', $semesterid);
                    if (is_array($records2)) { 
                      foreach($records2 as $fieldrecord2){ 
                        $semestername=trim($fieldrecord2['semestername']);
                      }
                    }

                    $records2=$SHbusaryOOP->allbusaryedit('session', 'sessionid', $sessionid);
                    if (is_array($records2)) { 
                      foreach($records2 as $fieldrecord2){ 
                        $sessionname=trim($fieldrecord2['sessionlow'])." / ".trim($fieldrecord2['sessionhigh']);
                        
                        }
                      }
                 
                  $stid=trim($fieldrecord1['stid']);
                  
                  $mafid=trim($fieldrecord1['mafid']);
                  $nexttermfee=trim($fieldrecord1['nexttermfee']);
                  $arears=trim($fieldrecord1['arears']);
                  $others=trim($fieldrecord1['others']);

                  $operatorid=trim($fieldrecord1['operatorid']);
                  
                  $udate=trim($fieldrecord1['udate']);
                  $total=$nexttermfee+$arears+$others;
                  $sn+=1;
                 
                  $surname="";
                  $othername="";
                    $studentdata=$SHbusaryOOP->allbusaryedit('students', 'stid', $stid);
                    if (is_array($studentdata)) {
                        foreach($studentdata as $studentrec){
                          $surname=trim($studentrec['surname']);
                          $othername=trim($studentrec['othername']);
                        }
                    }
                  
              ?>
                                 <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal<?php echo $stid; ?>" style="display:none"></button>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal<?php echo $stid; ?>" role="dialog" >
                      <div class="modal-dialog">
                      
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#063">
                            <button type="button" class="close" data-dismiss="modal" style="color:white">&times;</button>
                            <center><h4 class="modal-title" style="color:white">Update <span style='color:yellow'><?php  echo $surname." ".$othername; ?></span> fee Information</h4></center>
                          </div>
                          <div class="modal-body">
                            
                            <form action="?schoolhelp=<?php echo $schoolhelp; ?>&page=2&status=0" name="manuallyaddfee" method="POST">
                              <input type="hidden" class="form-control" value="<?php echo $stid; ?>" id="studentid" name="studentid">
                              <input type="hidden" class="form-control" value="<?php echo $mafid; ?>" id="mafid" name="mafid">
                              <input type="hidden" class="form-control" value="<?php echo $sessionid; ?>" id="sessionid" name="sessionid">
                              <input type="hidden" class="form-control" value="<?php echo $semesterid; ?>" id="semesterid" name="semesterid">
                          <div class="form-group">
                            <label for="nexttermfee">Next term fee:</label>
                            <input type="number" class="form-control" placeholder="Enter Next term fee" name="nexttermfee" id="nexttermfee" value="<?php echo $nexttermfee; ?>" required>
                          </div>
                          <div class="form-group">
                            <label for="arears">Arears</label>
                            <input type="number" class="form-control" placeholder="Enter Arears" name="arears" id="arears" value="<?php echo $arears; ?>" required>
                          </div>
                          <div class="form-group">
                            <label for="otherfee">Other fees</label>
                            <input type="number" class="form-control" placeholder="Enter Other fees" name="otherfee"  id="otherfee" value="<?php echo $others; ?>" required>
                          </div>
                          <button type="submit" class="btn btn-primary"><?php if ($mafid!="") { ?>Update<?php }else{ ?>Submit<?php } ?></button>
                        </form>
                          </div>
                          <!--<div class="modal-footer" style="background-color:#063">
                            <button type="button" class="btn btn-default" data-dismiss="modal" style="color:white">Close</button>
                          </div>-->
                        </div>
                        
                      </div>
                    </div>
                <tr height="23" onMouseOver="this.style.backgroundColor='#FFCC66';" onMouseOut="this.style.backgroundColor='';"> 
                                  
                  <td><?php echo $sn;  ?></td>
                    
                  <td style="font-size:12px;"><?php  echo $surname." ".$othername; ?></td>
                  <td><?php echo $levelname; ?></td>
                  <td><?php echo $optionname; ?></td>
                  <td><?php echo $semestername; ?></td>
                  <td><?php echo $sessionname; ?></td>
                  <td><?php echo $nexttermfee; ?></td>
                  <td><?php echo $arears; ?></td>
                  <td><?php echo $others; ?></td>
                  <td><?php echo $total; ?></td>
                  <td><?php echo $fullname; ?></td>
                  <td><?php echo $udate; ?></td>

                  <td width="8%" align="center"><span onclick=" $('#myModal<?php echo $stid; ?>').modal('show');" class="btn btn-primary"><i class="fa fa-edit"></i></span></td>
                                                                 
                                                                                  
                </tr>
             <?php  }  ?>
                <!--<tr>
                <td> No Record Found</td>
                </tr>-->
                
      
          </tbody>    
      </table>

        
         
      <?php
      }else {
      ?>
      <div style="text-align:center; color:red"><strong>Classes Not Found in the database</strong></div>
      <?php } ?>
    

      <!--End Point-->
                <?php } ?>  
            
         

                     
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

       <?php include("includes/footer.php"); ?>

       