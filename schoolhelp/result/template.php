<?php
include_once("../includes/global.php");
include_once("../includes/connection.php");
include_once("../phpclass/SHresultOOP.php");
confirmcheckin();
$SHResultOOP=new ClassResult;
$pagename="Template";

// Checking page access Authenticity


$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp=trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$page=trim(isset($_GET['page'])?$_GET['page']:false);

$previlleges=$SHResultOOP->allresultedit('adminpersons', 'adminid', $schoolhelp);
foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['template_r']);
  
}
if ($pageaccess!=1) {
  echo "<b style='font-size:100; color:red'>Criminal Attempt Made, contact the admin ask for the access of this page</b>";
  exit();
}


if ($page==1) {
    $levelid=trim(isset($_POST['levelid'])?$_POST['levelid']:false);
    $optionid=trim(isset($_POST['optionid'])?$_POST['optionid']:false);

    $leveldata=$SHResultOOP->allresultedit('level', 'levelid', $levelid);
      if (is_array($leveldata)) {
        foreach($leveldata as $levelrec){
         $deptid=$levelrec['departmentid'];
         $levelname=$levelrec['levelname'];
        }
      }

       $optiondata=$SHResultOOP->allresultedit('optiontable', 'optid', $optionid);
      if (is_array($optiondata)) {
        foreach($optiondata as $optionrec){
         
         $optionname=$optionrec['optname'];
        }
      }
}

//This script is to determine the actual admin that is logging whether a super admin or a position holder in a school
$admindata=$SHResultOOP->allresultedit('adminpersons', 'adminid', $schoolhelp);
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

$signatorydata=$SHResultOOP->allresultedit('signatoryposition', 'signatorypositionid', $signatorypositionid);
if (is_array($signatorydata)) {
  foreach($signatorydata as $signatoryrec){
   $departmentid=$signatoryrec['departmentid'];
  }
}



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
                          <li ><a  href="?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-book"></i>  View <?php echo $pagename; ?></a></li>
                        </ul>
                      </li>
                      
                    </ul>
                  </h3></center></div>
                   <div class="col-md-4"><span style="float:left"> <h3 style="color:black">Result Management</h3></span></div>
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
                      <li><a  class="close-link" href="../index?schoolhelp=<?php echo $schoolhelp; ?>"><i class="fa fa-close " style="color:#d2dc2a;"></i></a>
                      </li>
                    </ul>
                  </div>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    <div class="row">

                   <div class="x_panel">
                    <form  action="?page=1&schoolhelp=<?php echo $schoolhelp ?>" name="search" method="post" >
                      <fieldset>
                        <legend>Print Score Sheet Template</legend>
                        
                             
                      <table class="table table-responsive" style="overflow-y:hidden;">
                        <thead>
                          <tr>
                            <th> Level/Class: </th>
                           <th>Option/Arm: </th>
                                                       
                            <th>Action: </th>
                          </tr>
                        </thead>
                        <tbody>
                         <tr>
              
                    <td style="padding-right:20px">
                        <select  id="levelid" required="required" name="levelid" class="form-control col-md-4" onchange="retrieveselection1('optiontable', 'levelid', this.value, 0, 0, 'retrieveselection4', 'optioncontainer');">
                            <option value="">--Select Level--</option>
                            <?php
                            $levelmethod=$SHResultOOP->allresult('level','levelid','asc');
                            if (is_array($levelmethod)) {
                            foreach($levelmethod as $leveldata){

                               $deptdata=$SHResultOOP->allresultedit('department', 'did', $leveldata['departmentid']);
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

                    
                        <td >
                          <div id="optioncontainer" >
                            <select  id="optionid" required="required" name="optionid" class="form-control col-md-4" >
                            <option value="">--Select Option--</option>
                            
                          </select>                                                                                                                                                            </div>                                                                                                                                
                       </td>
                         
                  <td> <input  type="submit" class="btn btn-primary" value="Search" class="form-control col-md-4" /></td>
             </tr>
           </tbody>
              </table>
            
            </form>
             </fieldset>
                  </div>  
                  <?php if ($page==1) {
                    $x=0;
                    ?>
                      <div class="x_panel" id="printrecord">
                         <fieldset>
                        <legend style="color:#063"> Score Template</legend>
                    <table id="datatable-buttons" style="width:100%" class="table table-striped table-bordered table-responsive">
                      <center><caption><h2><?php echo $levelname.' '.$optionname ; ?></h2></caption></center>
                      <thead>
                        <tr>
                          <th>SN</th>
                          <th>Reg No</th>
                          <th>Surname</th>
                          <th>Othername</th>
                          <?php
                          $assessmentdata=$SHResultOOP->allresultedit('assessment', 'departmentid', $deptid);
                            if (is_array($assessmentdata)) {
                              foreach($assessmentdata as $assessmentrec){ 
                                $x=$x+1;
                                ?>
                              <th><?php echo $assessmentrec['assname'].' '.' ( '.$assessmentrec['asspercent'].'% ) '; ?></th>
                           <?php   }
                            }
                            ?>
                          
                        </tr>
                      </thead>

                      <tbody>
                        <?php $k=0; 
                            $records=$SHResultOOP->allresultedit3('students', 'levelid', $levelid, 'optid', $optionid, 'status', 0);
                              if (is_array($records)) {
                               
                              foreach($records as $fieldrecord){
                               $k+=1;
                        ?>
                                      <tr>
                                        <td><?php echo  $k; ?></td>
                                        <td><?php echo  $fieldrecord['regno']; ?></td>
                                        <td><?php echo  $fieldrecord['surname']; ?></td>
                                        <td><?php echo  $fieldrecord['othername']; ?></td>
                                        <?php for($q=1; $q<=$x; $q++){ ?>
                                        <td style="width:10%"></td>
                                        <?php } ?>
                                      </tr>
                             <?php }
                              }
                             ?>
                        
                      </tbody>
                    </table>
                   </fieldset>
                    </div>
                     <div class="row no-print" style="margin-bottom: 50px">
                        <div class="col-xs-12">
                          <div class="col-xs-6"><button class="btn btn-success print-link" ><i class="fa fa-print"></i> Print</button></div>
                         
                        </div>
                      </div>
                    <?php } ?>
                     
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

       <?php include("includes/footer.php"); ?>