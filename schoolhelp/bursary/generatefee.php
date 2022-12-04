
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
$page=trim(isset($_GET['page'])?$_GET['page']:false);
$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp =trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$pagename="Generate Term Fee";

$odate=date("Y-m-d");
$udate=date("Y-m-d H:i:s");

 

$previllages=$SHbusaryOOP->allbusaryedit('adminpersons', 'adminid', $schoolhelp);
foreach($previllages as $actualrecord){
  $pageaccess=trim($actualrecord['bursary_d']);
  $dashedit_d=trim($actualrecord['dashedit_d']);
  $dashdelete_d=trim($actualrecord['dashdelete_d']);
  $dashadd_d=trim($actualrecord['dashadd_d']);
  $signatorypositionid=trim($actualrecord['signatorypositionid']);
  $admintype=trim($actualrecord['admintype']);
}
if ($pageaccess!=1) {
  echo "<b style='font-size:100; color:red'>Criminal Attempt Made, contact the admin ask for the access of this page</b>";
  exit();
}

if ($admintype==1) {
  $logindepartmentid='';
}
else{

   $signatorydata=$SHtimetableOOP->alltimetableedit('signatoryposition', 'signatorypositionid', $signatorypositionid);
  if (is_array($signatorydata)) {
    foreach($signatorydata as $signatoryrec){
    $logindepartmentid=$signatoryrec['departmentid'];
    
    }
  }
}


$state=trim(isset($_GET['state'])?$_GET['state']:false);
$sql=trim(isset($_GET['sql'])?$_GET['sql']:false);


//Select current term/semester
        $semesterdata=$SHbusaryOOP->allbusaryedit('semesters','status', 1);
            if (is_array($semesterdata)) {
                foreach($semesterdata as $semesterrecord){
                    $semestername=$semesterrecord['semestername'];
                    $semesterid=trim($semesterrecord['semesterid']);
                    
              }
          }


        //Select current Session
         $sessiondata=$SHbusaryOOP->allbusaryedit('session','status', 1);
            if (is_array($sessiondata)) {
                foreach($sessiondata as $sessiondrecord){
                    $sessionname=$sessiondrecord['sessionlow']."/".$sessiondrecord['sessionhigh'];
                    $sessionid=trim($sessiondrecord['sessionid']);    
              }
          }


if($page==2) {
    $sql="Criminal Suspected";
  if ($dashadd_d==1) {
$insertedrec=0;
$bankname=isset($_POST['bankname'])?$_POST['bankname']:false;
$departmentid=trim(isset($_POST['departmentid'])?$_POST['departmentid']:false);

$state="Completely Unsuccessfully";

foreach($bankname as $typecount=>$typenames){

$name=trim(ucwords($typenames));
$accountname=trim(isset($_POST['accountname'.$typecount])?$_POST['accountname'.$typecount]:false);
$accountno=trim(isset($_POST['accountno'.$typecount])?$_POST['accountno'.$typecount]:false);
$description=trim(isset($_POST['description'.$typecount])?$_POST['description'.$typecount]:false);

  
//Checking Whetter Exam type has been added
 $records=$SHbusaryOOP->allbusaryedit2('bursarybanks', 'bankname', $name, 'departmentid', $departmentid);
    if (is_array($records)) {
       $sql="This ".$pagename." is found in the database";
    }
else{

$insertedrec+=1;
$state=$tableInsert->insert_8fields('bursarybanks', 'departmentid', $departmentid, 'bankname', $name, 'accountname', $accountname, 'accountno', $accountno, 'description', $description, 'operatorid', $schoolhelp, 'udate', $udate, 'odate', $odate);
$sql=$state.":: Insertion Made, affected records = ".$insertedrec;
}
}

}
echo "<script>
        window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
      </script>";

 
}

if($page==4) {
    $sql="Criminal Suspected";
  if ($dashedit_d==1 and $dashadd_d=1) {
  $levelid=trim(isset($_GET['levelid'])?$_GET['levelid']:false);

          $leveldata=$SHbusaryOOP->allbusaryedit('level','levelid', $levelid);
            if (is_array($leveldata)) {
                foreach($leveldata as $levelrecord){
                    
                $departmentid=trim($levelrecord['departmentid']);
                    
              }
          }



      $setupfeesdatacheck=$SHbusaryOOP->allbusaryedit3or1("setupfees", "departmentid", $departmentid, "departmentid", 0, "compulsory", 1);  
      if (is_array($setupfeesdatacheck)) {
          foreach($setupfeesdatacheck as $setupfeecheckrecord){

            $setupfeesid=trim($setupfeecheckrecord['setupfeesid']);
            $setupfeesamount=trim($setupfeecheckrecord['amount']);
            $nooffeeadded=0;
            $nooffeeupdated=0;
            $noofstudent=0;

              //< Checking whether fee is include in the terms fee
              $schoolfees_payablerec=$SHbusaryOOP->allbusaryedit4("schoolfees_payable", "levelid", $levelid, "setupfeesid", $setupfeesid, "sessionid", $sessionid, "semesterid", $semesterid); 
                if (is_array($schoolfees_payablerec)) {
                  $schoolfees_payableid="";
                  foreach($schoolfees_payablerec as $schoolfees_payablerecord){
                    $schoolfees_payableid=trim($schoolfees_payablerecord['schoolfees_payableid']);
                  }

                  $state=$tableUpdate->update_fourfields('schoolfees_payable',  'schoolfees_payableid', $schoolfees_payableid, 'departmentid', $departmentid, 'feeamount', $setupfeesamount, 'udate', $udate, 'operatorid', $schoolhelp);
                  $nooffeeupdated+=1;

                }else{
                  $state=$tableInsert->insert_9fields('schoolfees_payable', 'departmentid', $departmentid, 'levelid', $levelid, 'sessionid', $sessionid, 'semesterid', $semesterid, 'setupfeesid', $setupfeesid, 'feeamount', $setupfeesamount, 'operatorid', $schoolhelp, 'udate', $udate, 'odate', $odate);
                  $nooffeeadded+=1;
                }



              //>

             $records=$SHbusaryOOP->allbusaryedit2('students', 'status', 0, 'levelid', $levelid);
             if (is_array($records)) {
               foreach($records as $studentrecord){
                $nooffeeupdated+=1;
                $stid=trim($studentrecord['stid']);

                  //< Checking whether fee is include in the terms fee
                  $schoolfees_debtrec=$SHbusaryOOP->allbusaryedit5("schoolfees_debt", "stid", $stid, "levelid", $levelid, "setupfeesid", $setupfeesid, "sessionid", $sessionid, "semesterid", $semesterid); 
                    if (is_array($schoolfees_debtrec)) {
                      $schoolfees_debtid="";
                      foreach($schoolfees_debtrec as $schoolfees_debtrecord){
                        $schoolfees_debtid=trim($schoolfees_debtrecord['schoolfees_debtid']);
                      }

                      $state=$tableUpdate->update_fourfields('schoolfees_debt',  'schoolfees_debtid', $schoolfees_debtid, 'departmentid', $departmentid, 'feeamount', $setupfeesamount, 'udate', $udate, 'operatorid', $schoolhelp);
                    }else{
                      $state=$tableInsert->insert_9fields('schoolfees_debt', 'departmentid', $departmentid, 'levelid', $levelid, 'sessionid', $sessionid, 'stid', $stid, 'semesterid', $semesterid, 'setupfeesid', $setupfeesid, 'feeamount', $setupfeesamount, 'operatorid', $schoolhelp, 'odate', $odate);
                    }
                    

                  //>
                }
                 

                   

             } else{

                    $sql="Student record not found";
                    echo "<script>
                      window.location.href='?schoolhelp=$schoolhelp&sql=$sql&page=1';
                    </script>";

             }
          }
      }


   }
   

  $sql=$state." ".$nooffeeupdated." Student fee record ".$nooffeeadded." Added  and ".$nooffeeupdated." updated";
  echo "<script>
          window.location.href='?schoolhelp=$schoolhelp&sql=$sql';
        </script>";
 
}


if ($page==6) {
   $sql="Criminal Suspected";
  if ($dashdelete_d==1) {
  
   $bursarybankid=trim(isset($_GET['id'])?$_GET['id']:false);
   //$photo=trim(isset($_GET['photo'])?$_GET['photo']:false);
   $tableUpdate= new updateTable;
    $state=$tableUpdate->delete_bursary('bursarybanks', 'bursarybankid', $bursarybankid);

        $sql=$state.":: Deletion Made, affected records = 1";
         /* if ($state=="Success") {
                 $target_dir = "uploads/news/";
                  @unlink($target_dir.$photo);
              }*/

   
  
 }
    
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
                    <h3 class="schoolhelp" id="caption" style="float:left;"><?php echo $pagename ?></h3>
                    <ul class="nav navbar-right panel_toolbox" style="">
                      <li><a class="btn btn-primary" href="index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-home"> Bursary Dashboard </i></a>
                      <li><a class="btn btn-success " href="../?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-chevron-up"> Dashbord</i></a>
                      </li>
                      <li class="dropdown">
                        <a  class="dropdown-toggle btn btn-warning" data-toggle="dropdown" role="button" aria-expanded="false" ><i class="fa fa-chevron-down"></i>Actions</a>
                        <ul class="dropdown-menu" role="menu">
                          <?php if ($dashadd_d==1) { ?>
                          
                      <li><a href="?schoolhelp=<?php echo $schoolhelp; ?>"  ><i class="fa fa-plus"></i> Generate fee Per Student</a>
                      </li>
                      
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>&page=1"><i class="fa fa-book"></i> Generate fee Per Class</a>
                      </li>
                      <?php } ?>
                        </li>
                         
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
                         <table id="datatable-buttons"  style="width:100%" class="table table-striped table-bordered table-responsive">
                      <thead>
                          <tr >
                          <th>SN</th>
                         
                          <th>Reg No</th>
                          <th>Surname</th>
                          <th>Othername</th>
                          <th>Department</th>
                          <th>Level</th>
                          <th>Option</th>
                         <th>Old Debt</th>
                         <th>Semester Fee</th>
                        
                        
                        <?php if($dashedit_d==1 and $dashadd_d==1)  { ?>
                          <th>Generate<i class="fa fa-cog"></i></th>
                          <?php } ?>
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

                            
                              //All Students
                                $records=$SHbusaryOOP->allbusaryorder('students', 'status', 0, "levelid", "ASC"); 
                              


                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                              
                                $fieldvalue=trim($fieldrecord['operatorid']);
                                $hdid=trim($fieldrecord['housedivisionid']);
                                
                               
                               //getting level name
                                $levelid= $fieldrecord['levelid'];
                                
                                $levelobject=$SHbusaryOOP->allbusaryedit('level', 'levelid',  $levelid);
                                if(is_array($levelobject)){
                                foreach($levelobject as $levelrecord){
                                  $levelname=$levelrecord['levelname'];
                                  $departmentid= $levelrecord['departmentid'];
                                  }
                                }

                                //Getting department name
                                   $deptobject=$SHbusaryOOP->allbusaryedit('department', 'did',  $departmentid);
                                   if(is_array($deptobject)){
                                      foreach($deptobject as $deptrecord){
                                        $deptname=$deptrecord['deptname'];
                                        
                                     }
                                    }
                              
                                //getting Option name
                               $optid= $fieldrecord['optid'];
                              
                                   $optionobject=$SHbusaryOOP->allbusaryedit('optiontable', 'optid',  $optid);
                                   if(is_array($optionobject)){
                                      foreach($optionobject as $optionrecord){
                                        $optionname=$optionrecord['optname'];
                                        
                                     }
                                    }
                              
                                $admindata=$SHbusaryOOP->allbusaryedit('adminpersons', 'adminid',  $fieldvalue);
                                 if(is_array($admindata)){
                                    foreach($admindata as $adminrecord){
                                      $adminsurname=$adminrecord['surname'];
                                      $adminothername=$adminrecord['othername'];
                                    }

                                  }
                                  

                                   
                                      if ($admintype==0) {
                                  $k+=1;
                                if ($departmentid==$logindepartmentid) {?>
                                
                                      <tr data-toggle="tooltip" data-placement="top"  required="required" data-html="true" title="<em> <ul >
                                            <li ><span>Update by</span> : <?php echo  $adminsurname. " ".$adminothername ; ?></li>
                                            <li><span>Upate Date</span> : <?php echo  $fieldrecord['udate']; ?></li>
                                            <li><span>Initial Date</span> : <?php echo  $fieldrecord['odate']; ?></li>
                                            
                                          </ul></em>">
                                        <td><?php echo  $k; $stid=trim($fieldrecord['surname']) ?></td>
                                        
                                        <td><?php echo  substr($fieldrecord['regno'],0, 12); ?></td>

                                        <td><?php echo  substr($fieldrecord['surname'],0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['othername'],0, 12); ?></td>
                                         <td><?php echo  substr($deptname,0, 12); ?></td>
                                        <td><?php echo  substr($levelname,0, 12); ?></td>
                                        <td><?php echo  substr($optionname,0, 12); ?></td>
                                        <td><?php echo substr($hdname,0, 12); ?></td>
                                        <td><?php echo  substr($sexname,0, 12); ?></td>
                                        <td>
                                          <?php 
                                          $totalbalance=0;
                                          $feeamount=0;
                                          $paidamount=0;

                                          $schoolfees_debtdata=$SHbusaryOOP->allbusaryedit3('schoolfees_debt', 'wavestatus', 0, 'status', 0, 'stid', $stid);
                                           if(is_array($schoolfees_debtdata)){
                                              foreach($schoolfees_debtdata as $schoolfees_debtrecord){
                                                $feeamount+=trim($schoolfees_debtrecord['feeamount']);
                                               
                                              }
                                            }

                                          $schoolfees_paymentdata=$SHbusaryOOP->allbusaryedit2('schoolfees_payment', 'amountpaid', '>0', 'stid', $stid);
                                           if(is_array($schoolfees_paymentdata)){
                                              foreach($schoolfees_paymentdata as $schoolfees_paymentrecord){
                                                $paidamount+=trim($schoolfees_paymentrecord['paidamount']);
                                               
                                              }
                                            }
                                               $totalbalance=$feeamount-$paidamount;
                                            if ($totalbalance>0) {
                                              echo "<span>&#8358;</span>".$totalbalance;
                                            }
                                          
                                          ?>
                                        </td>
                                        <td>
                                          <?php 
                                          $totalbalance1=0;
                                          $feeamount1=0;
                                          $paidamount1=0;

                                          $schoolfees_debtdata=$SHbusaryOOP->allbusaryedit5('schoolfees_debt', 'wavestatus', 0, 'status', 0, 'stid', $stid, 'semesterid', $semesterid, 'sessionid', $sessionid);
                                           if(is_array($schoolfees_debtdata)){
                                              foreach($schoolfees_debtdata as $schoolfees_debtrecord){
                                                $feeamount1+=trim($schoolfees_debtrecord['feeamount']);
                                               
                                              }
                                            }

                                          $schoolfees_paymentdata=$SHbusaryOOP->allbusaryedit4('schoolfees_payment', 'amountpaid', '>0', 'stid', $stid, $semesterid, 'sessionid', $sessionid);
                                           if(is_array($schoolfees_paymentdata)){
                                              foreach($schoolfees_paymentdata as $schoolfees_paymentrecord){
                                                $paidamount1+=trim($schoolfees_paymentrecord['paidamount']);
                                               
                                              }
                                            }

                                            $totalbalance1=$feeamount1-$paidamount1;
                                            if ($totalbalance1>0) {
                                              echo "<span>&#8358;</span>".$totalbalance1;
                                            }
                                            ?>
                                        </td>
                                        
                                        <td><?php echo  substr($statename,0, 12); ?></td>
                                        <?php if($dashedit_d==1 and $dashadd_d==1)  { ?>
                                        
                                          <td ><span class="btn-group">
                                            <button class="btn btn-success" type="button" aria-expanded="false"><i class="fa fa-cog"></i> Action
                                          </button>
                                         
                                          </span>

                                        </td>
                                        <?php } ?>
                                       
                                      </tr>
                                      <?php }
                                    }else{ $k+=1; ?>
                                    <tr>
                                        <td><?php echo  $k; ?></td>
                                        
                                        <td><?php echo  substr($fieldrecord['regno'],0, 12); ?></td>

                                        <td><?php echo  substr($fieldrecord['surname'],0, 12); ?></td>
                                        <td><?php echo  substr($fieldrecord['othername'],0, 12); ?></td>
                                        <td><?php echo  substr($deptname,0, 12); ?></td>
                                        <td><?php echo  substr($levelname,0, 12); ?></td>
                                        <td><?php echo  substr($optionname,0, 12); ?></td>
                                        <td></td>
                                        <td></td>
                                                                                  
                                           <?php if($dashedit_d==1 and $dashadd_d==1)  { ?>
                                        
                                          <td ><span class="btn-group">
                                            <button class="btn btn-success" type="button" aria-expanded="false"><i class="fa fa-cog"></i> Action
                                          </button>
                                         
                                          </span>

                                          </td>
                                        <?php } ?>
                                       
                                      </tr>
                                      <?php } ?>
                             <?php }
                              }
                             ?>
                        
                      </tbody>
                    </table>
                   
                   </fieldset>
                    </div>
                    <?php } ?>

                     

                    <?php if($page==1) {  ?>
                      <div class="x_panel ">
                         <fieldset>
                        <legend style="color:#063">Generate Per Class</legend>
                         <table class="table table-striped" >
                              <?php
                               $leveldata=$SHbusaryOOP->allbusary("level", "levelid", "ASC");
                               
                              
                              ?>
                              <?php
                              if(!is_array($leveldata)){
                              
                              ?>
                                    <tr height="23" >
                                      <td colspan="<?php echo $spanning+1 ?>" class="smallxnormal" align="left">No Record Found</td>
                                    </tr> 
                              <?php
                              }
                                          
                              else
                              {
                              ?>
                                  <?php
                                  $spanning=0;
                                 foreach($leveldata as $levelrecord){
                                  $departmentid=trim($levelrecord['departmentid']);
                                  $levelname=trim($levelrecord['levelname']);
                                  $levelid=trim($levelrecord['levelid']);
                                  $setupfeesdata=$SHbusaryOOP->allbusaryedit3or1("setupfees", "departmentid", $departmentid, "departmentid", 0, "compulsory", 1);
                                   $feestatecaption="Generate";
                                  $schoolfees_payablerec=$SHbusaryOOP->allbusaryedit3("schoolfees_payable", "levelid", $levelid,  "sessionid", $sessionid, "semesterid", $semesterid); 
                                                        if (is_array($schoolfees_payablerec)) {
                                                         $feestatecaption="Updated";
                                                         }else{  $feestatecaption="Generate";}
                                  
                                  $total = 0;
                                    if ($admintype==0) {
                                 
                                if ($departmentid==$logindepartmentid) {
                              ?>
                              <tr ><td ><table class="table-responsive" style="width:100%"><tr><td >
                                            <tr align="center" style=" background:#060; color:#FFF; font-weight:bold; font-size:14px; vertical-align:middle; border:#060 solid 1px">
                                                   <td colspan="<?php echo count($setupfeesdata)+2; ?>"> <?php echo $sessionname." ".$levelname ."  ".$semestername; ?> </td>
                                              </tr>
                                          

                                              <tr  style=" background:#FFC; font-size:12px; vertical-align:middle">
                                                 <?php if (is_array($setupfeesdata)) {
                                                     foreach($setupfeesdata as $setupfeesrecord){  ?>
                                                      <td ><?php echo $setupfeesrecord["feename"]; ?></td>
                                                   <?php } ?>
                                                    
                                                      <td>Total</td>
                                                      <?php if($dashedit_d==1 and $dashadd_d==1)  { ?>
                                                      <td>Action</td>

                                                  <?php }
                                                   } ?>
                                               </tr>
                                           
                                              <tr  style=" font-size:12px; vertical-align:middle">
                                                
                                              <?php
                                                 if (is_array($setupfeesdata)) {
                                                     foreach($setupfeesdata as $setupfeesrecord1){  ?>
                                                
                                                   <td > 
                                                    <?php 
                                                      
                                                          echo $setupfeesrecord1["amount"];
                                                          $total += $setupfeesrecord1["amount"];
                                                      ?>
                                                     </td>
                                                   <?php } 
                                                 } ?>
                                                   <td ><?php echo $total ?></td>
                                                   <?php if($dashedit_d==1 and $dashadd_d==1)  { ?>
                                                      <td rowspan="2" style="background:#FFF; vertical-align:middle; text-align:right; width:100px">
                                                       
                                                        <a class="btn btn-<?php if($feestatecaption=="Generate"){ echo 'primary';  }else{ echo 'danger';}?>" href="generatefee?levelid=<?php  echo trim($levelrecord['levelid'])?>&deptid=<?php echo trim($departmentid)?>&page=4&schoolhelp=<?php echo $schoolhelp ?>" onclick="if(confirm('Mr Bursar are you sure you want to generate school fee for this class, Automatically their fee will be updated')){ return true;}else{return false}"> <?php echo $feestatecaption; ?> </a>
                                                          
                                                      </td>
                                                    <?php } ?>
                                                  
                                                 </tr></td></tr></table></td></tr>

                                                 <?php }
                                                   }else{ ?>

                                                    <tr ><td ><table class="table-responsive" style="width:100%"><tr><td >
                                            <tr align="center" style=" background:#060; color:#FFF; font-weight:bold; font-size:14px; vertical-align:middle; border:#060 solid 1px">
                                                   <td colspan="<?php echo count($setupfeesdata)+2; ?>"> <?php echo $sessionname." ".$semestername ." Term ".$levelname; ?> </td>
                                              </tr>
                                          

                                              <tr  style=" background:#FFC; font-size:12px; vertical-align:middle">
                                                 <?php if (is_array($setupfeesdata)) {
                                                     foreach($setupfeesdata as $setupfeesrecord){  ?>
                                                      <td ><?php echo $setupfeesrecord["feename"]; ?></td>
                                                   <?php } ?>
                                                    
                                                      <td>Total</td>
                                                      <?php if($dashedit_d==1 and $dashadd_d==1)  { ?>
                                                      <td>Action</td>

                                                  <?php }
                                                   } ?>
                                               </tr>
                                           
                                              <tr  style=" font-size:12px; vertical-align:middle">
                                                
                                              <?php
                                                 if (is_array($setupfeesdata)) {
                                                     foreach($setupfeesdata as $setupfeesrecord1){  ?>
                                                
                                                   <td > 
                                                    <?php 
                                                      
                                                          echo $setupfeesrecord1["amount"];
                                                          $total += $setupfeesrecord1["amount"];
                                                      ?>
                                                     </td>
                                                   <?php } 
                                                 } ?>
                                                   <td ><?php echo $total ?></td>
                                                   <?php if($dashedit_d==1 and $dashadd_d==1)  { 
                                                    


                                                    ?>
                                                      <td rowspan="2" style="background:#FFF; vertical-align:middle; text-align:right; width:100px">
                                                       
                                                        <a class="btn btn-<?php if($feestatecaption=="Generate"){ echo 'primary';  }else{ echo 'danger';}?>" href="generatefee?levelid=<?php  echo trim($levelrecord['levelid'])?>&page=4&schoolhelp=<?php echo $schoolhelp ?>" onclick="if(confirm('Mr Bursar are you sure you want to generate school fee for this class, Automatically their fee will be updated')){ return true;}else{return false}"> <?php echo $feestatecaption; ?>  </a>
                                                          
                                                      </td>
                                                    <?php } ?>
                                                  
                                                 </tr></td></tr></table></td></tr>

                                                  <?php } ?>
                                                
                                          
                                          <?php 
                                            } 
                                          }
                                          ?>
                        </tbody>
                        </table>
                   </fieldset>
                    </div>
                   
                    <?php } ?>

                  

                <?php if ($page==5) {
                  $odate=date("Y-m-d");
                  $deptname="";
                   $bursarybankid=trim(isset($_GET['id'])?$_GET['id']:false);
                   $records=$SHbusaryOOP->allbusaryedit('bursarybanks', 'bursarybankid', $bursarybankid);
                              if (is_array($records)) {
                                
                              foreach($records as $fieldrecord){
                                $description=trim($fieldrecord['description']);
                                $bankname=trim($fieldrecord['bankname']);
                                $accountname=trim($fieldrecord['accountname']);
                                $accountno=trim($fieldrecord['accountno']);
                                $operatorid=trim($fieldrecord['operatorid']);
                                $udate=trim($fieldrecord['udate']);
                                $odatet=trim($fieldrecord['odate']);
                                $departmentid=trim($fieldrecord['departmentid']);

                                 //collecting Department record
                             
                                     $deptrecords=$SHbusaryOOP->allbusaryedit('department', 'did', $departmentid);
                                     if (is_array($deptrecords)) {
                                     foreach($deptrecords as $deptrecord){
                                        $deptname=$deptrecord['deptname'];
                                        
                                     }
                                   }
                        
                               //Getting Admin Detials
                              
                                 $adminrecords=$SHbusaryOOP->allbusaryedit('adminpersons', 'adminid', $operatorid);
                                 foreach($adminrecords as $adminrecord){
                                    $adminsurname=$adminrecord['surname'];
                                    $adminothername=$adminrecord['othername'];
                                 }

                             
                                  
                                  //Instition Record
                                  
                                  $record1=$SHbusaryOOP->allbusary('institution', 'i_id', 'DESC');

                                   if (is_array($record1)) {
                                  foreach($record1 as $recordinstitution){
                                    $instilogo=$recordinstitution['instilogo'];
                                  }
                                }



                              }
                    
                    }
                    
                  ?>
                    <div class="x_panel" >
                  <div class="x_title">
                    <h3><?php echo $bankname; ?> Banks </h3>
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
                                          <i class="fa fa-tag" style="color:#063"></i> <?php echo $bankname ; ?>
                                          <small class="pull-right">Date: <?php echo $odate; ?></small>
                                      </h3>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                       
                       
                        <div class="col-sm-6 col-lg-6 col-xs-6 invoice-col">
                         <img id="userimage" <?php if (file_exists("../images/logo/".$instilogo) ){?> style="display: block" src="../images/logo/<?php echo $instilogo ?>" <?php } ?> class="img img-responsive img-thumbnail" >
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
                          <center><p class="lead schoolhelpcolor"><b>Bank Details</p></b></center>
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Bank Name</th>
                                  <td><?php echo $bankname; ?></td>
                                </tr>
                                <tr>
                                  <th style="width:50%">Account Name</th>
                                  <td><?php echo $accountname; ?></td>
                                </tr>
                                <tr>
                                  <th style="width:50%">Account No</th>
                                  <td><?php echo $accountno; ?></td>
                                </tr>
                                  <tr>
                                  <th>Description</th>
                                  <td><?php echo $description; ?></td>
                                </tr>
                                <tr>
                                  <th>Department</th>
                                  <td><?php echo $deptname; ?></td>
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
              </div>
            </div>
       <?php include("includes/footer.php"); ?>