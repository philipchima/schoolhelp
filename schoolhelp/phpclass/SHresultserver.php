<?php 
include_once("../includes/connection.php");
include("../phpclass/SHresultOOP.php");
include("../phpclass/SHresultupdate.php");
include("../phpclass/SHresultinserts.php");

$section=trim(isset($_POST['section'])?$_POST['section']:false);
$schoolhelpDash=new classResult;
$SHupdate=new updateTable;
$SHinsert=new insertTable;


//Adding of school fields
 if ($section=="schools") {
 	$numberoffields=trim(isset($_POST['numberoffields'])?$_POST['numberoffields']:false);
 	while($numberoffields>=1){
 		$numberoffields-=1; ?>

 <?php	}
 } ?>

 <?php
 if($section=="excessvalcheck") {
 	$calculate=0;
 	$tblname=trim(isset($_POST['tblname'])?$_POST['tblname']:false);
 	$tblfdcheck=trim(isset($_POST['tblfdcheck'])?$_POST['tblfdcheck']:false);
 	$tblfdcheck1=trim(isset($_POST['tblfdcheck1'])?$_POST['tblfdcheck1']:false);
 	$tblfdid=trim(isset($_POST['tblfdid'])?$_POST['tblfdid']:false);
 	$tblanotherid=trim(isset($_POST['tblanotherid'])?$_POST['tblanotherid']:false);
 	$tblcolfd=trim(isset($_POST['tblcolfd'])?$_POST['tblcolfd']:false);
 	
 	$actualvalue=trim(isset($_POST['actualvalue'])?$_POST['actualvalue']:false);
 	$checkexcessvalue =new Checkexcessvalue;
 	$datas=$checkexcessvalue->alltblselection1($tblname, $tblfdcheck, $tblfdcheck1, $tblfdid, $tblanotherid);
 	foreach($datas as $record){
 		$calculate+=$record[$tblcolfd];
 		
 	}
 	$calculate+=$actualvalue;
 	if ($calculate>0) {
 		echo $calculate;
 		//"Assessment Percentage is ".$calculate." which is greater than 100";
 	}
  }
?>

 <?php
 if($section=="checkduplicates") {

 	$tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
 	$fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
 	$fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
 	
 	$record=allTables($tablename, $fieldname, $fieldvalue);

 	echo $record;
 	
  }
?>


<?php
 if($section=="previlleges") {

  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
  $updatefield=trim(isset($_POST['updatefield'])?$_POST['updatefield']:false);
  $updatevalue=trim(isset($_POST['updatevalue'])?$_POST['updatevalue']:false);
  $updatefield1=trim(isset($_POST['updatefield1'])?$_POST['updatefield1']:false);
  $updatevalue1=trim(isset($_POST['updatevalue1'])?$_POST['updatevalue1']:false);
  $updatefield2=trim(isset($_POST['updatefield2'])?$_POST['updatefield2']:false);
  $updatevalue2=trim(isset($_POST['updatevalue2'])?$_POST['updatevalue2']:false);
  $state=$schoolhelpupdate->updateprevilleges($tablename, $fieldname, $fieldvalue,  $updatefield, $updatevalue,  $updatefield1, $updatevalue1, $updatefield2, $updatevalue2);
  if (isset($state)) {
    echo $state;
  }else{
    echo 'Contact the Swiftotech Microsystems: 08038142333';
  }
  
  }
?>

<?php
 if($section=="twotblwithsixfield") {

  $table1=trim(isset($_POST['table1'])?$_POST['table1']:false);
  $table2=trim(isset($_POST['table2'])?$_POST['table2']:false);
  $label1=trim(isset($_POST['label1'])?$_POST['label1']:false);
  $content1=trim(isset($_POST['content1'])?$_POST['content1']:false);
  $label2=trim(isset($_POST['label2'])?$_POST['label2']:false);
  $content2=trim(isset($_POST['content2'])?$_POST['content2']:false);
  $label3=trim(isset($_POST['label3'])?$_POST['label3']:false);
  $content3=trim(isset($_POST['content3'])?$_POST['content3']:false);
  $label4=trim(isset($_POST['label4'])?$_POST['label4']:false);
  $content4=trim(isset($_POST['content4'])?$_POST['content4']:false);
  $label5=trim(isset($_POST['label5'])?$_POST['label5']:false);
  $content5=trim(isset($_POST['content5'])?$_POST['content5']:false);
  $label6=trim(isset($_POST['label6'])?$_POST['label6']:false);
  $content6=trim(isset($_POST['content6'])?$_POST['content6']:false);
  $state=$SHupdate->deletechecksix($table1, $label1, $content1, $label2, $content2, $label3, $content3, $label4, $content4, $label5, $content5, $label6, $content6);
  $state1=$SHupdate->deletechecksix($table2, $label1, $content1, $label2, $content2, $label3, $content3, $label4, $content4, $label5, $content5, $label6, $content6);
  
  if (isset($state)) {
    echo $state ." and ".$state;
  }else{
    echo 'Contact the Swiftotech Microsystems: 08038142333';
  }
  
  }
?>

<?php
 if($section=="earlyassessment") {

  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);

   $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
   $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);

   $fieldname1=trim(isset($_POST['fieldname1'])?$_POST['fieldname1']:false);
   $fieldvalue1=trim(isset($_POST['fieldvalue1'])?$_POST['fieldvalue1']:false);

   $fieldname2=trim(isset($_POST['fieldname2'])?$_POST['fieldname2']:false);
   $fieldvalue2=trim(isset($_POST['fieldvalue2'])?$_POST['fieldvalue2']:false);

   $fieldname3=trim(isset($_POST['fieldname3'])?$_POST['fieldname3']:false);
   $fieldvalue3=trim(isset($_POST['fieldvalue3'])?$_POST['fieldvalue3']:false);

   $fieldname4=trim(isset($_POST['fieldname4'])?$_POST['fieldname4']:false);
   $fieldvalue4=trim(isset($_POST['fieldvalue4'])?$_POST['fieldvalue4']:false);

   $fieldname5=trim(isset($_POST['fieldname5'])?$_POST['fieldname5']:false);
   $fieldvalue5=trim(isset($_POST['fieldvalue5'])?$_POST['fieldvalue5']:false);

   $fieldname6=trim(isset($_POST['fieldname6'])?$_POST['fieldname6']:false);
   $fieldvalue6=trim(isset($_POST['fieldvalue6'])?$_POST['fieldvalue6']:false);

   $fieldname7=trim(isset($_POST['fieldname7'])?$_POST['fieldname7']:false);
   $fieldvalue7=trim(isset($_POST['fieldvalue7'])?$_POST['fieldvalue7']:false);

   $fieldname8=trim(isset($_POST['fieldname8'])?$_POST['fieldname8']:false);
   $fieldvalue8=trim(isset($_POST['fieldvalue8'])?$_POST['fieldvalue8']:false);

   $fieldname9=trim(isset($_POST['fieldname9'])?$_POST['fieldname9']:false);
   $fieldvalue9=trim(isset($_POST['fieldvalue9'])?$_POST['fieldvalue9']:false);

  $fieldname0=trim(isset($_POST['fieldname0'])?$_POST['fieldname0']:false);
  $fieldvalue0=trim(isset($_POST['fieldvalue0'])?$_POST['fieldvalue0']:false);

  $earlyscoreid="";
  //checking whether score has been submitted before
  $earlycmentattend1=$schoolhelpDash->allresultedit6($tablename, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5, $fieldname6, $fieldvalue6, $fieldname0, $fieldvalue0);
    if (is_array($earlycmentattend1)) {
      foreach($earlycmentattend1 as $key7 => $earlycmentattendrec1){
        $earlyscoreid=trim($earlycmentattendrec1['earlyscoreid']);
    }
 
     $state=$SHupdate->update_score($tablename, $fieldname, $earlyscoreid, $fieldname1, $fieldvalue1, $fieldname7, $fieldvalue7, $fieldname8, $fieldvalue8);
      echo $state;
    }else{
      echo $state=$SHinsert->insert_10fields($tablename, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5, $fieldname6, $fieldvalue6, $fieldname7, $fieldvalue7, $fieldname8, $fieldvalue8, $fieldname9, $fieldvalue9, $fieldname0, $fieldvalue0);
      
    }

  }
?>

<?php
 if($section=="assessmentupdate") {

 	$tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
 	$fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
 	$fieldname1=trim(isset($_POST['fieldname1'])?$_POST['fieldname1']:false);
 	
 	$fieldvalue1=trim(isset($_POST['fieldvalue1'])?$_POST['fieldvalue1']:false);

  $fieldname2=trim(isset($_POST['fieldname2'])?$_POST['fieldname2']:false);
  $fieldvalue2=trim(isset($_POST['fieldvalue2'])?$_POST['fieldvalue2']:false);
  $fieldname3=trim(isset($_POST['fieldname3'])?$_POST['fieldname3']:false);
 
  $fieldvalue3=trim(isset($_POST['fieldvalue3'])?$_POST['fieldvalue3']:false);

  $state=$SHupdate->update_score($tablename, $fieldname, $fieldvalue, $fieldname1,  $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3);
 	echo $state;
 	
  }
?>

<?php
 if($section=="assessmentdelete") {

  echo $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
  echo $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  echo $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
 
  $state=$SHupdate->delete_score($tablename, $fieldname, $fieldvalue);
  echo $state;
  
  }
?>

<?php
//this is used
 //This for  level selection retrieval
//Getting details from two different tables
 if($section=="retrieveselection") {
  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
  $departmentid="";
  //$fldname=trim(isset($_POST['fldname'])?$_POST['fldname']:false);
  //$fldid=trim(isset($_POST['fldid'])?$_POST['fldid']:false);
  ?>
   <td id="opencontainer">
        <table>
          <tr>
            
  <?php //($tablename, $fieldname, $fieldvalue, $fieldrequested)
  $retrievedata=$schoolhelpDash->allresultedit($tablename, $fieldname, $fieldvalue);
  if (is_array($retrievedata)) {
  ?>  <td>
         <select  name="optionid" id="optionid" required="required"  class="form-control col-md-6 col-xs-12" >
           <option value="">--Select Option|Arm|Group--</option>
  <?php
    foreach($retrievedata as $field){
      $departmentid=trim($field['departmentid']);
  ?>
        <option value="<?php echo $field['optid']; ?>"><?php echo $field['optname']; ?></option>
  <?php
      }?>
        </select>
      </td>
  <?php }else{echo "<span id='msg' style='font-size:10px'>Please check Level to see options attach to it, Most likely it is not assign or level options not added yet</span>";}
 
 ?>

  <?php  
  // Getting all the courses

  $retrievedata1=$schoolhelpDash->allresultedit('course', 'departmentid', $departmentid);
  if (is_array($retrievedata1)) {
  ?>  
         <td><select  name="courseid" id="courseid" required="required"  class="form-control col-md-6 col-xs-12" >
           <option value="">--Select Course/Subject--</option>
  <?php
    foreach($retrievedata1 as $field1){
  ?>
        <option value="<?php echo $field1['csid']; ?>"><?php echo $field1['csname']; ?></option>
  <?php
      }?>
        </select></td>
                    
<?php }else{echo "<span id='msg' style='font-size:10px'>The Option`s department does not have course/subject attached to it";}?>
</tr>
</table>
</td>
 <?php } //End retrieving from department table
 ?>

<?php

//Domain grading and manuel marking of attendance
 if($section=="domaingrade_attendance") {
  $departmentid=trim(isset($_POST['departmentid'])?$_POST['departmentid']:false);
  $positionid=trim(isset($_POST['positionid'])?$_POST['positionid']:false); 
  $noofschooldays="";
  $noofdaysattended=""; 

   $retrievedata4=$schoolhelpDash->allresultedit('attendancemark', 'positionresultid', $positionid);
  if (is_array($retrievedata4)) {
    foreach($retrievedata4 as $field4){
      $noofschooldays=$field4['noofschooldays'];
      $noofdaysattended=$field4['stuattendance'];
    }
  }

  ?>

  <table class="table table-responsive table-stripped" style="padding:0px; margin:0px">
  <tr style="padding:0px; margin:0px">
      <td>No of School Days<span class="required">*</span></td>
      <td>
          <input id="noofschooldays" class="form-control col-md-3 col-xs-6" type="number" name="noofschooldays" required="required" placeholder="Example: 0 or 1 or 2" <?php if ($noofschooldays!="") { ?> value="<?php echo $noofschooldays; ?>" <?php } ?> >
      </td>
  </tr>
                     
  <tr  style="padding:0px; margin:0px">
    <td>No of Days Attended</td>
    <td class="col-md-6 col-sm-6 col-xs-12">
        <input id="noofdaysattended" class="form-control col-md-3 col-xs-6" type="number" name="noofdaysattended" placeholder="Example: 0 or 1 or 2" <?php if ($noofdaysattended!="") { ?> value="<?php echo $noofdaysattended; ?>" <?php } ?>>
    </td>
  </tr>
  </table>
 <input type="text" id="positionresultid" required="required" name="positionresultid"   value="<?php echo $positionid; ?>"  hidden>
 
 <?php 
  $retrievedata=$schoolhelpDash->allresultedit('domaintype', 'departmentid', $departmentid);
  if (is_array($retrievedata)) {

    foreach($retrievedata as $field){
  ?>
 
  <center><div style="color:green; border-top:1px solid #063 "><b><?php echo $field['domaintypename'] ?></b></div></center>

  <?php  $retrievedata1=$schoolhelpDash->allresultedit('domainname', 'domaintypeid', trim($field['domaintypeid']));
  if (is_array($retrievedata1)) {

    foreach($retrievedata1 as $field1){
      $domaingrade="";
    $retrievedata5=$schoolhelpDash->allresultedit2('resultdomain', 'positionresultid', $positionid, 'domainnameid', trim($field1['domainnameid']));
       if (is_array($retrievedata5)) { 
        foreach($retrievedata5 as $field5){
          $domaingrade=trim($field5['domaingrade']);
       }
     }
  ?>

      <table class="table table-responsive" style="padding:0px; margin:0px">
       <tr  style="padding:0px; margin:0px">            
        <td><?php echo $field1['domainname']; ?><span class="required">*</span></td>
        <td>
            <select id="domain<?php echo trim($field1['domainnameid']); ?>"  name="domain<?php echo trim($field1['domainnameid']); ?>" class="form-control col-md-7 col-xs-12"  required="required">
              <option value="" >-- Select Grade --</option>

              <option value="1" <?php if ($domaingrade==1) { ?> selected="selected" <?php } ?> >Poor</option>
              <option value="2" <?php if ($domaingrade==2) { ?> selected="selected" <?php } ?> >Fair</option>
              <option value="3" <?php if ($domaingrade==3) { ?> selected="selected" <?php } ?> >Good</option>
              <option value="4" <?php if ($domaingrade==4) { ?> selected="selected" <?php } ?> >Very Good</option>
              <option value="5" <?php if ($domaingrade==5) { ?> selected="selected" <?php } ?> >Excellent</option>
             
            </select>
          </td>
        </tr>
       </table>

  <?php }
  } else { ?>
          <div>This Domain name has not been added to this domain type</div>
 <?php  }
?>


  <?php
      } ?>

    <center> <button type="submit" class="btn btn-success " ><i class="fa fa-send"></i>Update</button></center>
  <?php } else { echo "<div>This Domain Type has not been added to the school were this class belong to</div>";} ?>
  
 <?php } 
 ?>

<?php
//this is used
 //This for  level selection retrieval
//Getting details from two different tables
 if($section=="retrieveselection4") {
  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
  //$fldname=trim(isset($_POST['fldname'])?$_POST['fldname']:false);
  //$fldid=trim(isset($_POST['fldid'])?$_POST['fldid']:false);
  
  //($tablename, $fieldname, $fieldvalue, $fieldrequested)
  $retrievedata=$schoolhelpDash->allresultedit($tablename, $fieldname, $fieldvalue);
  if (is_array($retrievedata)) {
  ?>  
         <select  name="optionid" id="optionid" required="required"  class="form-control col-md-6 col-xs-12" >
           <option value="">--Select Option|Arm|Group--</option>
  <?php
    foreach($retrievedata as $field){
  ?>
        <option value="<?php echo $field['optid']; ?>"><?php echo $field['optname']; ?></option>
  <?php
      }?>
        </select>
     
                
                    
<?php }else{echo "<span id='msg'>Please check Level to see options attach to it, Most likely it is not assign or level options not added yet</span>";}
 } //End Getting details from two different tables
 ?>

<?php

 //This retrieves student table in returns

 if($section=="retrieveselection5") {
  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
  //$fldname=trim(isset($_POST['fldname'])?$_POST['fldname']:false);
  //$fldid=trim(isset($_POST['fldid'])?$_POST['fldid']:false);
  
  //($tablename, $fieldname, $fieldvalue, $fieldrequested)
  $retrievedata=$schoolhelpDash->allresultedit($tablename, $fieldname, $fieldvalue);
  if (is_array($retrievedata)) {
  ?>  
         <select  name="optionid" id="optionid" required="required"  class="form-control col-md-6 col-xs-12" onchange="retrieveselection1('students', 'optid', this.value, 'levelid', $('#levelid').val(), 'retrieveselection2', 'opencontainer1');">
           <option value="">--Select Option|Arm|Group--</option>
  <?php
    foreach($retrievedata as $field){
  ?>
        <option value="<?php echo $field['optid']; ?>"><?php echo $field['optname']; ?></option>
  <?php
      }?>
        </select>
     
                
                    
<?php }else{echo "<span id='msg'>Please check Level to see options attach to it, Most likely it is not assign or level options not added yet</span>";}
 } //End Getting details from two different tables
 ?>

<?php 
if($section=="loadoptionpromote") {
  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
 
  $retrievedata=$schoolhelpDash->allresultedit($tablename, $fieldname, $fieldvalue);
  
  ?>  
         <select  name="newoptionid" id="newoptionid" required="required"  class="form-control col-md-6 col-xs-12" onchange="enablingbutton($(this).attr('id'))">
           <option value="">--Select Option|Arm|Group--</option>
           <option value="2000">completed</option>
  <?php
  if (is_array($retrievedata)) {
    foreach($retrievedata as $field){
  ?>
        <option value="<?php echo $field['optid']; ?>"><?php echo $field['optname']; ?></option>
  <?php
      }
    }

      ?>
        </select>
     
                
                    
<?php
 } //End Getting details from two different tables
 ?>

 <?php

 //This retrieves student table in returns

 if($section=="retrieveselection2") {
  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
   $fieldname1=trim(isset($_POST['fieldname1'])?$_POST['fieldname1']:false);
  $fieldvalue1=trim(isset($_POST['fieldvalue1'])?$_POST['fieldvalue1']:false);
  //$fldname=trim(isset($_POST['fldname'])?$_POST['fldname']:false);
  //$fldid=trim(isset($_POST['fldid'])?$_POST['fldid']:false);
  
  //($tablename, $fieldname, $fieldvalue, $fieldrequested)
  $retrievedata=$schoolhelpDash->allresultedit2($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1);
  if (is_array($retrievedata)) {
  ?>  
          <input type="text" list="studentnames" id="studentname" class="form-control col-md-7 col-xs-12" placeholder="Please type and select student name " onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'studentid');">

          <datalist id="studentnames">

  <?php
    foreach($retrievedata as $field){
  ?>
        <option data-value="<?php echo $field['stid']; ?>"  value="<?php echo $field['surname'].' '.$field['othername']; ?>">
  <?php
      }?>
       </datalist>
       <input id="studentid" class="form-control col-md-7 col-xs-12" type="hidden" name="studentid" >
                
                    
<?php }else{echo "<span id='msg'>Please check this option and class to see students attach to it, Most likely added yet</span>";}
 } //End Getting details from two different tables
 ?>
 
 
 