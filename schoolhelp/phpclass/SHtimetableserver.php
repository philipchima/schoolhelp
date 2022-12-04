
<?php
include_once("../includes/connection.php");
include_once("../phpclass/SHtimetableOOP.php");
include_once("../phpclass/SHtimetableinserts.php");
include_once("../phpclass/SHtimetableupdate.php");
 $SHtimetableOOP= new classTimetable;
 $SHtimetableinsert= new insertTable;
 $SHtimetableupdate= new updateTable;
$section=trim(isset($_POST['section'])?$_POST['section']:false);

//connection for copyweek function
$conn= new Dbh;
$mysqli = $conn->connect();

if($section=="checkduplicates") {
 
 	$tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
 	$fieldvalue=ucwords(trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false));
 	$fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
 	$returnfieldvalue=trim(isset($_POST['returnfieldvalue'])?$_POST['returnfieldvalue']:false);
 	$id="";
 	
 	$record=$SHtimetableOOP->alltimetableedit($tablename, $fieldname, $fieldvalue);
 	if (is_array($record)) {
 		foreach ($record as $records) {
 		$id=trim($records[$returnfieldvalue]);
 		}
 	}
 	echo $id;
  }

 if($section=="checkduplicates1") {
 
 	$tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
 	$fieldvalue=ucwords(trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false));
 	$fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
 	$fieldvalue1=trim(isset($_POST['fieldvalue1'])?$_POST['fieldvalue1']:false);
 	$fieldname1=trim(isset($_POST['fieldname1'])?$_POST['fieldname1']:false);
 	$returnfieldvalue=trim(isset($_POST['returnfieldvalue'])?$_POST['returnfieldvalue']:false);
 	$id="";
 	
 	$record=$SHtimetableOOP->alltimetableedit2($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1);
 	if (is_array($record)) {
 		foreach ($record as $records) {
 		$id=trim($records[$returnfieldvalue]);
 		}
 	}
 	echo $id;
  }

// Inserting Timetable
  if($section=="insertdailytimetable") {
 
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

  $fieldname10=trim(isset($_POST['fieldname10'])?$_POST['fieldname10']:false);
  $fieldvalue10=trim(isset($_POST['fieldvalue10'])?$_POST['fieldvalue10']:false);
 
  $fieldname11=trim(isset($_POST['fieldname11'])?$_POST['fieldname11']:false);
  $fieldvalue11=trim(isset($_POST['fieldvalue11'])?$_POST['fieldvalue11']:false);
  $fieldname12=trim(isset($_POST['fieldname12'])?$_POST['fieldname12']:false);
  $fieldvalue12=trim(isset($_POST['fieldvalue12'])?$_POST['fieldvalue12']:false);
 
  $fieldname13=trim(isset($_POST['fieldname13'])?$_POST['fieldname13']:false);
  $fieldvalue13=trim(isset($_POST['fieldvalue13'])?$_POST['fieldvalue13']:false);
  
  $id="";
  $record=$SHtimetableOOP->alltimetableedit($tablename, $fieldname13, $fieldvalue13);
  if (is_array($record)) {
    foreach ($record as $records) {
    $id=trim($records[$fieldname13]);

    $state=$SHtimetableupdate->update_twelvefields($tablename, $fieldname13, $fieldvalue13, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5, $fieldname6, $fieldvalue6, $fieldname7, $fieldvalue7, $fieldname8, $fieldvalue8, $fieldname9, $fieldvalue9, $fieldname10, $fieldvalue10,  $fieldname11, $fieldvalue11);

    $sql=$state.":: Update Made, affected records = 1";
    }
  }else{
      $state=$SHtimetableinsert->insert_13fields($tablename,  $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4, $fieldname5, $fieldvalue5, $fieldname6, $fieldvalue6, $fieldname7, $fieldvalue7, $fieldname8, $fieldvalue8, $fieldname9, $fieldvalue9, $fieldname10, $fieldvalue10,  $fieldname11, $fieldvalue11, $fieldname12, $fieldvalue12);
  $id=$state['id']; //last_id
  }

  echo $id;
  }

  if($section=="checkduplicates4") {
 
 	$tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
 	$fieldvalue=ucwords(trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false));
 	$fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
 	$fieldvalue1=trim(isset($_POST['fieldvalue1'])?$_POST['fieldvalue1']:false);
 	$fieldname1=trim(isset($_POST['fieldname1'])?$_POST['fieldname1']:false);
 	$fieldvalue2=ucwords(trim(isset($_POST['fieldvalue2'])?$_POST['fieldvalue2']:false));
 	$fieldname2=trim(isset($_POST['fieldname2'])?$_POST['fieldname2']:false);
 	$fieldvalue3=trim(isset($_POST['fieldvalue3'])?$_POST['fieldvalue3']:false);
 	$fieldname3=trim(isset($_POST['fieldname3'])?$_POST['fieldname3']:false);
 	$returnfieldvalue=trim(isset($_POST['returnfieldvalue'])?$_POST['returnfieldvalue']:false);
 	$id="";
 	
 	$record=$SHtimetableOOP->alltimetableedit4($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3);
 	if (is_array($record)) {
 		foreach ($record as $records) {
 		$id=trim($records[$returnfieldvalue]);
 		}
 	}
 	echo $id;
  }

?>
  
  <?php 

  if($section=="checkduplicates5") {

 	$tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
 	$fieldvalue=ucwords(trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false));
 	$fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
 	$fieldvalue1=trim(isset($_POST['fieldvalue1'])?$_POST['fieldvalue1']:false);
 	$fieldname1=trim(isset($_POST['fieldname1'])?$_POST['fieldname1']:false);
 	$fieldvalue2=ucwords(trim(isset($_POST['fieldvalue2'])?$_POST['fieldvalue2']:false));
 	$fieldname2=trim(isset($_POST['fieldname2'])?$_POST['fieldname2']:false);
 	$fieldvalue3=trim(isset($_POST['fieldvalue3'])?$_POST['fieldvalue3']:false);
 	$fieldname3=trim(isset($_POST['fieldname3'])?$_POST['fieldname3']:false);
 	$fieldvalue4=trim(isset($_POST['fieldvalue4'])?$_POST['fieldvalue4']:false);
 	$fieldname4=trim(isset($_POST['fieldname4'])?$_POST['fieldname4']:false);
 	$returnfieldvalue=trim(isset($_POST['returnfieldvalue'])?$_POST['returnfieldvalue']:false);
 	$id="";
 	
 	$record=$SHtimetableOOP->alltimetableedit5($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2, $fieldname3, $fieldvalue3, $fieldname4, $fieldvalue4);
 	if (is_array($record)) {
 		foreach ($record as $records) {
 		$id=trim($records[$returnfieldvalue]);
 		}
 	}
 	echo $id;
  }


?>

  <?php
 //This for  level selection retrieval
//Getting details from two different tables
 if($section=="retrieveselection4") {
  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);

  $uniquecount=trim(isset($_POST['uniquecount'])?$_POST['uniquecount']:false);
  $departmentid="";

  $record=$SHtimetableOOP->alltimetableedit('level', 'levelid', $fieldvalue);
 	if (is_array($record)) {
 		foreach ($record as $records) {
 		$departmentid=trim($records['departmentid']);
 		}
 	}
  
  ?>   <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Option|Arm|Group<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
             <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
         <select  name="optionid<?php echo $uniquecount; ?>" id="optionid" required="required"  class="form-control col-md-6 col-xs-12"  onchange="updatevalidity5('timetablesemester', 'Class Timetable', $('#timetablesemesterid').val(), 'timetablesemesterid', 'optionid', $('#optionid').val(), 'levelid', $('#levelid').val(), 'semesterid', $('#semesterid').val(), 'sessionid', $('#sessionid').val(), 'timetabletypeid', $('#timetabletypeid').val(), 'updating', 'optionid');">
           <option value="">--Select Option|Arm|Group--</option>
		  <?php
		  	$retrievedata=$SHtimetableOOP->alltimetableedit($tablename, $fieldname, $fieldvalue);
		  if (is_array($retrievedata)) {
		    foreach($retrievedata as $field){
		  ?>
		        <option value="<?php echo $field['optid']; ?>"><?php echo $field['optname']; ?></option>
		  <?php
		     }
		     }else{echo "<span id='msg'>Please check Level to see options attach to it, Most likely it is not assign or a particular option has not been added</span>";}
		      ?>
		        </select>
		      </div>
		    </div>

    <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Timetable Type<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
             <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
         <select  name="timetabletypeid<?php echo $uniquecount; ?>" id="timetabletypeid" required="required"  class="form-control col-md-6 col-xs-12"  onchange="updatevalidity5('timetablesemester', 'Class Timetable', $('#timetablesemesterid').val(), 'timetablesemesterid', 'optionid', $('#optionid').val(), 'levelid', $('#levelid').val(), 'semesterid', $('#semesterid').val(), 'sessionid', $('#sessionid').val(), 'timetabletypeid', $('#timetabletypeid').val(), 'updating', 'timetabletypeid');">
           <option value="">--Select Timetable Type--</option>
  <?php
  	$retrievedata1=$SHtimetableOOP->alltimetableedit('timetabletype', 'departmentid', $departmentid);
  if (is_array($retrievedata1)) {
    foreach($retrievedata1 as $field1){
  ?>
        <option value="<?php echo $field1['timetabletypeid']; ?>"><?php echo $field1['typename']; ?></option>
  <?php
     }
     }else{echo "<span id='msg'>No Time type has been added has not been added</span>";}
      ?>
        </select>
      </div>
    </div>
                
                    
<?php 
 } //End Getting details from two different tables
 ?>

<?php
 //Retreiving of staff information
 if($section=="staffretrieve") {

  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
 $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
  $fieldname1=trim(isset($_POST['fieldname1'])?$_POST['fieldname1']:false);
  $fieldvalue1=trim(isset($_POST['fieldvalue1'])?$_POST['fieldvalue1']:false);

  $retrievefieldidno=trim(isset($_POST['retrievefieldidno'])?$_POST['retrievefieldidno']:false);
  $levelid="";
    $optionid="";
    $staffid="";

  $record=$SHtimetableOOP->alltimetableedit('timetablesemester', $fieldname1, $fieldvalue1);
  if (is_array($record)) {
    foreach ($record as $records) {
    $levelid=trim($records['levelid']);
    $optionid=trim($records['optionid']);
    }
  }

  $record1=$SHtimetableOOP->alltimetableedit3($tablename, $fieldname, $fieldvalue, 'optionid', $optionid , 'levelid', $levelid);
  if (is_array($record1)) {
    foreach ($record1 as $records1) {
    $staffid=trim($records1['staffid']);
    }
  }

   $ifullname="";
   $record8=$SHtimetableOOP->alltimetableedit('staff', 'staffid', $staffid);
      if (is_array($record8)) {
      foreach ($record8 as $records8) {
      $ifullname=trim($records8['surname'])." ".trim($records8['othername']);
                  
        }
  ?>   
  
            <input type="text" list="staffnames<?php echo $retrievefieldidno; ?>" id="staffname<?php echo $retrievefieldidno; ?>" class="form-control col-md-3 col-xs-6" value="<?php echo $ifullname; ?>" placeholder="Please type or select staff name " onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'staffid<?php echo $retrievefieldidno; ?>');">

               <datalist id="staffnames<?php echo $retrievefieldidno; ?>">

              <?php
                $records=$SHtimetableOOP->alltimetable('staff', 'staffid', 'ASC');
                  if (is_array($records)) {
                               
                  foreach($records as $fieldrecord){
                           
              ?>
              <option data-value="<?php echo $fieldrecord['staffid']; ?>"  value="<?php echo $fieldrecord['surname'].' '.$fieldrecord['othername']; ?>">
               <?php } 
                }?>
              </datalist>
              <input id="staffid<?php echo $retrievefieldidno; ?>" class="form-control col-md-2 col-xs-2" name="staffid<?php echo $retrievefieldidno; ?>" type="hidden" value="<?php echo $staffid; ?>">
                               
<?php 
    }
 } //End Getting details from two different tables
 ?>

 <?php
 //Retreiving of staff information
 if($section=="staffretrieve2") {

  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
 $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
  $fieldname1=trim(isset($_POST['fieldname1'])?$_POST['fieldname1']:false);
  $fieldvalue1=trim(isset($_POST['fieldvalue1'])?$_POST['fieldvalue1']:false);
  $staffid="";
  
  $levelid="";
    $optionid="";

  $record=$SHtimetableOOP->alltimetableedit('timetablesemester', $fieldname1, $fieldvalue1);
  if (is_array($record)) {
    foreach ($record as $records) {
    $levelid=trim($records['levelid']);
    $optionid=trim($records['optionid']);
    }
  }

  $record1=$SHtimetableOOP->alltimetableedit3($tablename, $fieldname, $fieldvalue, 'optionid', $optionid , 'levelid', $levelid);
  if (is_array($record1)) {
    foreach ($record1 as $records1) {
    $staffid=trim($records1['staffid']);
    }
  }

   $ifullname="";
   $record8=$SHtimetableOOP->alltimetableedit('staff', 'staffid', $staffid);
      if (is_array($record8)) {
      foreach ($record8 as $records8) {
      $ifullname=trim($records8['surname'])." ".trim($records8['othername']);
                  
        }
  ?>     <div id="instructoridsel">
                      <div class="form-group col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Instructor/Teacher or Invigilator<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" list="staffnames" id="staffname" class="form-control col-md-3 col-xs-6" value="<?php echo $ifullname; ?>" placeholder="Please type or select staff name " onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'staffid');">

               <datalist id="staffnames<?php echo $retrievefieldidno; ?>">

              <?php
                $records=$SHtimetableOOP->alltimetable('staff', 'staffid', 'ASC');
                  if (is_array($records)) {
                               
                  foreach($records as $fieldrecord){
                           
              ?>
              <option data-value="<?php echo $fieldrecord['staffid']; ?>"  value="<?php echo $fieldrecord['surname'].' '.$fieldrecord['othername']; ?>">   
               <?php } 
                }?>
              </datalist>
              <input id="staffid" class="form-control col-md-2 col-xs-2" name="staffid" type="hidden" value="<?php echo $staffid; ?>">
              </div>   
            </div>                 
<?php 
    }
 } //End Getting details from two different tables
 ?>

  <?php
 //Retreiving weeks
 if($section=="wkretrieve_func") {
  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
  
  ?>   <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="timetableweekid">Semester Week<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            
         <select  name="timetableweekid" id="timetableweekid" required="required"  class="form-control col-md-6 col-xs-12"  onchange="addingdays('dailytimetable', 'timetableweek', 'timetablesemesterid', $('#timetablesemesterid').val(), 'timetableweekid', this.value, 'noofdays', 'addingdays', 'opencontainer');">
           <option value="">--Select Week--</option>
      <?php
        $retrievedata=$SHtimetableOOP->alltimetableedit($tablename, $fieldname, $fieldvalue);
      if (is_array($retrievedata)) {
        foreach($retrievedata as $field){
      ?>
            <option value="<?php echo $field['timetableweekid']; ?>"><?php echo "Week ". $field['priority']; ?></option>
      <?php
         }
         }else{echo "<span id='msg'>Please check and Week Setup has been under the selected semester timetable setup</span>";}
          ?>
            </select>
          </div>
        </div>
                                  
<?php 
 } //End Getting details from two different tables
 ?>

  <?php
 //Retreiving weeks
 if($section=="getdepartmenttype") {
  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
  
  ?>    
                    <div class="form-group">
                                   <label class="control-label col-md-4 col-sm-4 col-xs-12" for="departmentid">Timetable Type<span class="required">*</span>
                                   </label>
                                   <div class="col-md-8 col-sm-8 col-xs-12">
                                  <select name="timetabletypeid" id="timetabletypeid" class="form-control col-md-7 col-xs-12"  required="required">
                                   <option value="">--Select Timetable Type--</option>
                                     <?php  $retrievedata=$SHtimetableOOP->alltimetableedit($tablename, $fieldname, $fieldvalue);
                                        if (is_array($retrievedata)) {

                                          $did1=""; 
                                        ?> 
                                        <?php
                                          foreach($retrievedata as $field){
                                            $did1=trim($field['departmentid']);
                                              $record1=$SHtimetableOOP->alltimetableedit('department', 'did', $did1);
                                              if (is_array($record1)) {
                                              foreach($record1 as $record1s){
                                               
                                                $deptname=$record1s['deptname'];
                                              }
                                            }

                                           
                                        ?>
                                              <option value="<?php echo $field['timetabletypeid']; ?>" ><?php echo $field['typename']. "=>".$deptname; ?></option>
                                        <?php
                                             

                                             }
                                        }?>
                                              </select>
                                            </div>
                                    </div>
                                    </div>  
                                    </div> 
                                  
                                  
<?php 
 } //End Getting details from two different tables
 ?>

  <?php
 //Retreiving No of periods
 if($section=="addingperiods") {
 
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
  $fieldname1=trim(isset($_POST['fieldname1'])?$_POST['fieldname1']:false);
  $fieldvalue1=trim(isset($_POST['fieldvalue1'])?$_POST['fieldvalue1']:false);
  $fieldname2=trim(isset($_POST['fieldname2'])?$_POST['fieldname2']:false);
  $fieldvalue2=trim(isset($_POST['fieldvalue2'])?$_POST['fieldvalue2']:false);
 
  $operatorid=trim(isset($_POST['operatorid'])?$_POST['operatorid']:false);//operatorid
  $daysid=trim(isset($_POST['daysid'])?$_POST['daysid']:false);
  $noofperiods=trim(isset($_POST['noofperiods'])?$_POST['noofperiods']:false);
  $timetabletypename="";

  $record=$SHtimetableOOP->alltimetableedit('timetablesemester', $fieldname, $fieldvalue);
  if (is_array($record)) {
    foreach ($record as $records) {
    $levelid=trim($records['levelid']);
    $timetabletypeid=trim($records['timetabletypeid']);
    }
  }

  $record1=$SHtimetableOOP->alltimetableedit('level', 'levelid', $levelid);
  if (is_array($record1)) {
    foreach ($record1 as $records1) {
    $departmentid=trim($records1['departmentid']);
    }
  }

//Getting Timetable Type
  $record6=$SHtimetableOOP->alltimetableedit('timetabletype', 'timetabletypeid', $timetabletypeid);
  if (is_array($record6)) {
    foreach ($record6 as $records6) {
    $timetabletypename=trim($records6['typename']);
    }
  }

  $record2=$SHtimetableOOP->alltimetableedit('department', 'did', $departmentid);
  if (is_array($record2)) {
    foreach ($record2 as $records2) {
    $deptname=trim($records2['deptname']);
    }
  }
  ?>   
    <table class="table table-responsive table-strippped"  id="">
      <caption><?php echo $timetabletypename ?> Setup </caption>
      <thead>
      <tr>
          <th title="Enter <?php echo $timetabletypename ?> Start Time">Start Time</th>
          <th title="Enter <?php echo $timetabletypename ?> Start Time">End Time</th>
          <th title="Whether it Practical or Theory">Type</th>
          <th title="Select Study Hall for the <?php echo $timetabletypename ?>">Hall</th>
          <th title="Select Subject or Course">Course/Subject</th>
          <th title="Select Instructor/Teacher or Invigilator in Charge of <?php echo $timetabletypename ?>">Instructor/Invigilator</th>
           <th title="Select Instructor/Teacher or Supervisor in Charge of <?php echo $timetabletypename ?>">Instructor/Supervisor</th>
          <th>Action</th>
      </tr>
      </thead>
      <tbody>
        <?php
        //Checking and retrieving already added periods
        $record4=$SHtimetableOOP->alltimetableedit3('dailytimetable', $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2);
            if (is_array($record4)) {
               $lecturehallname="";
               $lecturehallcode="";
               $scheduletypename="";
               $scheduletypecode="";

              foreach ($record4 as $records4) { 
                $dailytimetableid=trim($records4['dailytimetableid']);
                $hallid=trim($records4['hallid']);
                $scheduletypeid=trim($records4['scheduletypeid']);
                $courseid=trim($records4['courseid']);
                $instructorid=trim($records4['instructorid']); // or invigilator
                $supervisorid=trim($records4['supervisor']);

                $record5=$SHtimetableOOP->alltimetableedit('lecturetype', 'lecturetypeid', $scheduletypeid);
                if (is_array($record5)) {
                  foreach ($record5 as $records5) {
                  $scheduletypename=trim($records5['name']);
                  $scheduletypecode=trim($records5['code']);
                  }
                }

                 $record6=$SHtimetableOOP->alltimetableedit('lecturehall', 'lecturehallid', $hallid);
                if (is_array($record6)) {
                  foreach ($record6 as $records6) {
                  $lecturehallname=trim($records6['hallname']);
                  $lecturehallcode=trim($records6['shortname']);
                  }
                }

                $ifullname="";
                  $qualification="";
                 $record8=$SHtimetableOOP->alltimetableedit('staff', 'staffid',  $instructorid);
                if (is_array($record8)) {
                  foreach ($record8 as $records8) {
                  $ifullname=trim($records8['surname'])." ".trim($records8['othername']);
                  $qualification=trim($records8['qualification']);
                  }
                }

                 $sfullname="";
                  $squalification="";
                 $record9=$SHtimetableOOP->alltimetableedit('staff', 'staffid', $supervisorid);
                if (is_array($record9)) {
                  foreach ($record9 as $records9) {
                  $sfullname=trim($records9['surname'])." ".trim($records9['othername']);
                  $squalification=trim($records8['qualification']);
                  }
                }

                $csname="";
                  $coursecode="";
                 $record7=$SHtimetableOOP->alltimetableedit('course', 'csid', $courseid);
                if (is_array($record7)) {
                  foreach ($record7 as $records7) {
                  $csname=trim($records7['csname']);
                  $coursecode=trim($records7['coursecode']);
                  }
                }

                ?>
            <tr>
              <td><?php echo trim($records4['starttime']); ?></td>
              <td><?php echo trim($records4['endtime']); ?></td>
              <td title="<?php echo $scheduletypename; ?>"><?php echo $scheduletypecode; ?></td>
              <td title="<?php echo $lecturehallname; ?>"><?php echo $lecturehallcode; ?></td>
             
              <td title="<?php echo $csname; ?>"><?php echo $coursecode; ?></td>
              <td title="<?php echo $qualification; ?>"><?php echo $ifullname; ?></td>
              <td title="<?php echo $squalification; ?>"><?php echo $sfullname; ?></td>
              <td><div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="?schoolhelp=<?php echo $operatorid; ?>&page=5&id=<?php echo $dailytimetableid; ?>">View</a></li>
                    <li><a onclick="funcedit('<?php echo $operatorid; ?>','<?php echo $dailytimetableid; ?>')">Edit</a></li>
                    <li><a onclick="funcdelete('<?php echo $operatorid; ?>','<?php echo $dailytimetableid; ?>','');">Delete</a></li>
                  </ul>
                </div>
              </td>
              
            <tr>
     <?php }
           ?>
     <?php } ?>
      <?php $u=0; while($noofperiods>=1){ ?>
      
      <tr>
          <td><input type="hidden"  id="insertrowid<?php echo $daysid.$u; ?>" name="insertrowid<?php echo $daysid.$u; ?>">
            <input type="time" class="form-control col-md-2 col-xs-2" name="starttime<?php echo $daysid.$u; ?>" id="starttime<?php echo $daysid.$u; ?>" required="required" onblur="checktime('dailytimetable', 'operatorid', '<?php echo $operatorid; ?>', 'timetablesemesterid', $('#timetablesemesterid').val(), 'timetableweekid', $('#timetableweekid').val(), 'daydate', $('#date<?php echo $daysid; ?>').val(), 'starttime', this.value, $(this).attr('id'), 'lecturetime')" value="00:00"></td>
          <td><input type="time" class="form-control col-md-2 col-xs-2" name="endtime<?php echo $daysid.$u; ?>" id="endtime<?php echo $daysid.$u; ?>" onblur="checktime('dailytimetable', 'timetablesemesterid', $('#timetablesemesterid').val(), 'timetableweekid', $('#timetableweekid').val(), 'daydate', $('#date<?php echo $daysid; ?>').val(), 'endtime', this.value, $(this).attr('id'), 'lecturetime')" value="00:00"></td>
          <td>
           <select title="Select Lecture Type" id="lecturetype<?php echo $daysid.$u; ?>" required="required" name="lecturetype<?php echo $daysid; ?>[]" class="form-control col-md-2 col-xs-2">
                            <option value="">--Select Lecture Type--</option>
                            <?php
                            $lecturetyperec=$SHtimetableOOP->alltimetableedit('lecturetype', 'departmentid', $departmentid);
                            if (is_array($lecturetyperec)) {
                           
                            foreach($lecturetyperec as $lecturetyperecs){    
                            ?>
                            <option value="<?php echo $lecturetyperecs['lecturetypeid']; ?>" title="<?php echo $lecturetyperecs['description']; ?>"><?php echo $lecturetyperecs['name']." (".$deptname." )"; ?></option>
                            <?php
                            }//end of checking whether someone is a super
                                
                          } 
                   ?>
            </select>
          </td>
          <td>
              <select title="Select Study Hall for the Lecture" id="lecturehall<?php echo $daysid.$u; ?>" required="required" name="lecturehall<?php echo $daysid.$u; ?>[]" class="form-control col-md-2 col-xs-2" onchange="checkhall('dailytimetable', 'timetablesemesterid', $('#timetablesemesterid').val(), 'daydate', $('#date<?php echo $daysid; ?>').val(), 'hallid', this.value, 'starttime',  $('#starttime<?php echo $daysid.$u; ?>').val(), 'endtime', $('#endtime<?php echo $daysid.$u; ?>').val(), 'checkhall', $(this).attr('id'));">
                            <option value="">--Select Lecture Hall--</option>
                            <?php
                            $deptrecord=$SHtimetableOOP->alltimetableedit2or('lecturehall', 'departmentid', $departmentid, 'halltype', 1);
                            if (is_array($deptrecord)) {
                           
                            foreach($deptrecord as $deptdata){    
                            ?>
                            <option value="<?php echo $deptdata['lecturehallid']; ?>" title="<?php echo $deptdata['description']; ?>"><?php echo $deptdata['hallname']." (".$deptname." )"; ?></option>
                            <?php
                               
                            }//end of checking whether someone is a super
                                
                  } ?>
            </select>
          </td>
          <td>
            <select title="Select Course of Study" id="course<?php echo $daysid.$u; ?>" required="required" name="course<?php echo $daysid.$u; ?>[]" class="form-control col-md-3 col-xs-6" onchange="coursecheck('instructorcourses', 'dailytimetable', 'courseid', this.value, 'timetablesemesterid', $('#timetablesemesterid').val(), 'timetableweekid', $('#timetableweekid').val(), 'daydate', $('#date<?php echo $daysid; ?>').val(), 'starttime',  $('#starttime<?php echo $daysid.$u; ?>').val(), 'endtime', $('#endtime<?php echo $daysid.$u; ?>').val(), '<?php echo $daysid.$u; ?>', 'coursecheck', $(this).attr('id'), 'instructoridsel<?php echo $daysid.$u; ?>');">
                            <option value="">--Select Course--</option>
                            <?php
                            $courserec=$SHtimetableOOP->alltimetableedit('course', 'departmentid', $departmentid);
                            if (is_array($courserec)) {
                           
                              foreach($courserec as $courserecs){    
                              ?>
                              <option value="<?php echo $courserecs['csid']; ?>" title="<?php echo $courserecs['csdescription']; ?>"><?php echo $courserecs['csname']." => ".$courserecs['coursecode']; ?></option>
                              <?php
                                 
                              }//end of checking whether someone is a super
                                
                            } 
                   ?>
            </select>
          </td>
          <td id="instructoridsel<?php echo $daysid.$u; ?>">
            <input type="text" list="staffnames<?php echo $daysid.$u; ?>" id="staffname<?php echo $daysid.$u; ?>" class="form-control col-md-3 col-xs-6" placeholder="Please type or select staff name " onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'staffid<?php echo $daysid.$u; ?>');" onblur="lectureperiodclash('dailytimetable', 'daydate', $('#date<?php echo $daysid; ?>').val(), 'instructorid', $('#staffid<?php echo $daysid.$u; ?>').val(), 'starttime',  $('#starttime<?php echo $daysid.$u; ?>').val(), 'endtime', $('#endtime<?php echo $daysid.$u; ?>').val(),  'lectureperiodclash', $('staffid<?php echo $daysid.$u; ?>').val(), $('staffname<?php echo $daysid.$u; ?>').val());">

                        <datalist id="staffnames<?php echo $daysid.$u; ?>">

                            <?php
                             $records=$SHtimetableOOP->alltimetable('staff', 'staffid', 'ASC');
                              if (is_array($records)) {
                               
                            foreach($records as $fieldrecord){
                            ?>
                            <option data-value="<?php echo $fieldrecord['staffid']; ?>"  value="<?php echo $fieldrecord['surname'].' '.$fieldrecord['othername']; ?>">
                            <?php } 
                          }?>
                        </datalist>
                        <input id="staffid<?php echo $daysid.$u; ?>" class="form-control col-md-2 col-xs-2" name="staffid<?php echo $daysid.$u; ?>" type="hidden">
          </td>
          <td>
            <input type="text" list="supervisornames<?php echo $daysid.$u; ?>" id="supervisorname<?php echo $daysid.$u; ?>" class="form-control col-md-3 col-xs-6" placeholder="Please type or select staff name " onchange="return inputdatalist($(this).attr('id'), $(this).attr('list'), 'supervisorid<?php echo $daysid.$u; ?>');">

                        <datalist id="supervisornames<?php echo $daysid.$u; ?>">

                            <?php
                             $records10=$SHtimetableOOP->alltimetable('staff', 'staffid', 'ASC');
                              if (is_array($records10)) {
                               
                              foreach($records10 as $fieldrecord10){
                           
                            ?>
                            <option data-value="<?php echo $fieldrecord10['staffid']; ?>"  value="<?php echo $fieldrecord10['surname'].' '.$fieldrecord10['othername']; ?>">
                            <?php } 
                          }?>
                        </datalist>
                        <input id="supervisorid<?php echo $daysid.$u; ?>" class="form-control col-md-2 col-xs-2" name="supervisorid<?php echo $daysid.$u; ?>" type="hidden">
          </td>
          <td>
            <button class="btn btn-primary" type="button" name="button<?php echo $daysid.$u; ?>" id="button<?php echo $daysid.$u; ?>"  onclick="insertdailytimetable('dailytimetable', 'timetablesemesterid', $('#timetablesemesterid').val(), 'timetableweekid', $('#timetableweekid').val(), 'dayid', $('#weeklyday<?php echo $daysid; ?>').val(), 'daydate', $('#date<?php echo $daysid; ?>').val(), 'courseid', $('#course<?php echo $daysid.$u; ?>').val(), 'instructorid', $('#staffid<?php echo $daysid.$u; ?>').val(), 'scheduletypeid', $('#lecturetype<?php echo $daysid.$u; ?>').val(), 'hallid', $('#lecturehall<?php echo $daysid.$u; ?>').val(), 'supervisor', $('#supervisorid<?php echo $daysid.$u; ?>').val(), 'starttime', $('#starttime<?php echo $daysid.$u; ?>').val(), 'endtime', $('#endtime<?php echo $daysid.$u; ?>').val(), 'operatorid', '<?php echo $operatorid ?>', 'odate', '<?php echo date("Y-m-d"); ?>', 'dailytimetableid', $('#insertrowid<?php echo $daysid.$u; ?>').val(), 'insertdailytimetable', $('#insertrowid<?php echo $daysid.$u; ?>').attr('id'), $(this).attr('id'));">Save</button>
          </td>
         
      </tr>
      
      <?php 
      $noofperiods --;
      $u++;
      } ?>
      </tbody>
    </table>                       
<?php 
 } //End Getting No of periods
 ?>

 <?php
//Getting details from two different tables
 if($section=="checktwotables") {
 	$tabletoadd=trim(isset($_POST['tabletoadd'])?$_POST['tabletoadd']:false);
 	$tabletoaddfield=trim(isset($_POST['tabletoaddfield'])?$_POST['tabletoaddfield']:false);
 	$tabletocheck=trim(isset($_POST['tabletocheck'])?$_POST['tabletocheck']:false);
 	$tabletocheckfield=trim(isset($_POST['tabletocheckfield'])?$_POST['tabletocheckfield']:false);
 	$tabletocheckgetfield=trim(isset($_POST['tabletocheckgetfield'])?$_POST['tabletocheckgetfield']:false);
 	$tabletocheckid=trim(isset($_POST['tabletocheckid'])?$_POST['tabletocheckid']:false);
 	
 	//collecting number of weeks avaliable for this semester timetable setup
 	 $retrievedata=$SHtimetableOOP->alltimetableedit($tabletocheck, $tabletocheckfield, $tabletocheckid);
 	 
  	if (is_array($retrievedata)) {
  		foreach ($retrievedata as $retrievedatarec) {
  			$startdate=$retrievedatarec['startdate'];
 			$enddate=$retrievedatarec['enddate'];
 			$numofyear=$retrievedatarec['noofweeks'];
  		}
  	}
 	
 	$daycount="";
 	$dayname="";

 	// Checking the already added record
 	 $retrievedata1=$SHtimetableOOP->alltimetableedit($tabletoadd, $tabletoaddfield, $tabletocheckid);
 	 $tabletoaddrecord=count($retrievedata1);

  	$starting=date("l jS F, Y", strtotime($startdate));
 	$myArray = explode(' ', $starting);
 	foreach ($myArray as $key => $value) {
 		if ($key==0) {
 			$dayname=strtolower($value);
 		}
 	}


 	if ($dayname=="monday") {
 		$daycountstart=7;
 		$dayend=4;
 	}
 	elseif ($dayname=="tuesday") {
 		$daycountstart=6;
 		$dayend=3;
 	}
 	elseif ($dayname=="wednesday") {
 		$daycountstart=5;
 		$dayend=2;
 	}
 	elseif ($dayname=="thursday") {
 		$daycountstart=4;
 		$dayend=1;
 	}
 	elseif ($dayname=="friday") {
 		$daycountstart=3;
 		$dayend=0;
 	}

 	else{
 		$daycountstart=7;
 		$dayend=4;
 	}

 	$startingdate=$startdate;
 	$numboffld2add=$numofyear-$tabletoaddrecord;
 	$k=0;
 	if($numboffld2add>0){ ?>
 	
           	<div class="x_panel" >
 			
 	<?php 
 	//increasing number of weeks based on added record
 	$k+=$tabletoaddrecord;
 	$u=0; while($numboffld2add>=1){
 		$k+=1;
 		$startingdate=$startdate;
 			$endingdate=date('Y-m-d', strtotime($enddate.'+ '.$dayend. ' days'));
 		
 		if ($k!=1) {
 			$startingdate=date('Y-m-d', strtotime($startingdate.'+ '.$daycountstart. ' days'));
 			$endingdate=date('Y-m-d', strtotime($startingdate.'+ 4 days'));
 		}

?>
   <span>Week Setup-<?php echo $k; ?></span>
                      <hr><input class="col-md-7 col-xs-12"  name="priority<?php echo $u; ?>" hidden="hidden" value="<?php echo $k; ?>">
                      <div class="form-group">
                       
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="levelname">No of Days<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="noofdays" required="required" name="noofdays[]" class="form-control col-md-7 col-xs-12" placeholder="Please Enter no of lecture days in a week" value="<?php echo '5'; ?>">
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Start Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="startdate" class="form-control col-md-7 col-xs-12" type="date" name="startdate<?php echo $u; ?>" required="required" placeholder="Enter the start date" value="<?php echo $startingdate; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">End Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="enddate" class="form-control col-md-7 col-xs-12" type="date" name="enddate<?php echo $u; ?>" required="required" placeholder="Enter the end date" value="<?php echo $endingdate; ?>">
                        </div>
                      </div>
                     
                      <div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="levelname">No of Periods<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="noofperiod"  name="noofperiod<?php echo $u; ?>" class="form-control col-md-7 col-xs-12" placeholder="Please Enter no of Periods in a week" >
                        </div>
                      </div>

                      <div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="levelname">Description<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea  id="description"  name="description<?php echo $u; ?>" class="form-control col-md-7 col-xs-12" placeholder="Please describe this record" ></textarea>
                        </div>
                      </div>
    <?php
      $numboffld2add-=1;
      $u+=1;
     } ?>
                     
                      <div id="msg" ></div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
              				<button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
<?php }else{echo "<span id='msg'>Please check no of week semester setup, Most likely it is not assign or specified levels have not been added</span>";}
 } //End Getting details from two different tables
 ?>

  <?php
//Getting details from two different tables
 if($section=="addingdays") {
  $numofdays="";
  $tabletoadd=trim(isset($_POST['tabletoadd'])?$_POST['tabletoadd']:false);
  
  $tabletocheck=trim(isset($_POST['tabletocheck'])?$_POST['tabletocheck']:false);
  $tabletocheckfield1=trim(isset($_POST['tabletocheckfield1'])?$_POST['tabletocheckfield1']:false);
  $tabletocheckid1=trim(isset($_POST['tabletocheckid1'])?$_POST['tabletocheckid1']:false);
  $tabletocheckfield2=trim(isset($_POST['tabletocheckfield2'])?$_POST['tabletocheckfield2']:false);
  $tabletocheckid2=trim(isset($_POST['tabletocheckid2'])?$_POST['tabletocheckid2']:false);
  $tabletocheckgetfield=trim(isset($_POST['tabletocheckgetfield'])?$_POST['tabletocheckgetfield']:false);
   $operatorid=trim(isset($_POST['operatorid'])?$_POST['operatorid']:false);
  
  
  //collecting number of days avaliable for this week timetable setup
   $retrievedata=$SHtimetableOOP->alltimetableedit2($tabletocheck, $tabletocheckfield1, $tabletocheckid1, $tabletocheckfield2, $tabletocheckid2);
   
    if (is_array($retrievedata)) {
      foreach ($retrievedata as $retrievedatarec) {
      $startdate=$retrievedatarec['startdate'];
      $enddate=$retrievedatarec['enddate'];
      $numofdays=$retrievedatarec[$tabletocheckgetfield];
      }
    }
  
  $daycount="";
  $dayname="";
 
  $k=0;
  if($numofdays>0){ 
  $startingdate=$startdate;
   
    $datename=date("l jS F, Y", strtotime($startingdate));

    ?>
  
            <div class="x_panel" >

              <div class="form-group col-xs-12">
                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Week's Start Date<span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php echo $datename; ?>
                    </div>
              </div>
  <?php 
  //increasing number of days based on added record
 // $k+=$tabletoaddrecord;
  $u=0; while($numofdays>=1){
    $k+=1;
    if ($k!=1) {
      $startingdate=date('Y-m-d', strtotime($startingdate.'+ 1 days'));
    }
    $datename=date("l jS F, Y", strtotime($startingdate));

      $myArray = explode(' ', $datename);
  foreach ($myArray as $key => $value) {
    if ($key==0) {
      $dayname=strtolower($value);
    }
  }

  $priority1=1;
  if ($dayname=="monday") {
   $priority1=1;
  }
  elseif ($dayname=="tuesday") {
    $priority1=2;
  }
  elseif ($dayname=="wednesday") {
   $priority1=3;
  }
  elseif ($dayname=="thursday") {
    $priority1=4;
  }
  elseif ($dayname=="friday") {
    $priority1=5;
  }
   elseif ($dayname=="saturday") {
    $priority1=6;
  }
   elseif ($dayname=="sunday") {
    $priority1=7;
  }
  ?>

   <span>Week Day-<?php echo $k; ?></span>
                      <hr><input class="col-md-7 col-xs-12"  name="days<?php echo $u; ?>" hidden="hidden" value="<?php echo $k; ?>">
                      
                       <div class="form-group col-xs-12">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Day Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="date<?php echo $u; ?>" class="form-control col-md-7 col-xs-12" type="date" name="date<?php echo $tabletocheckid1.$tabletocheckid2.$u; ?>" required="required" placeholder="Enter the Lecture Day date"  min="<?php echo $startdate; ?>" max="<?php echo $enddate; ?>" value="<?php echo $startingdate ?>" onchange="checkdate('dailytimetable', 'timetablesemesterid', $('#timetablesemesterid').val(), 'timetableweekid', $('#timetableweekid').val(), 'daydate', this.value, 'checkdate', 'containerperiod<?php echo $u; ?>')">
                        </div>
                      </div>

                      <div class="form-group col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Weekly Day<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
                          <select  id="weeklyday<?php echo $u; ?>" required="required" name="weeklyday<?php echo $u; ?>" class="form-control col-md-7 col-xs-12" >
                            <option value="">--Select Weekly Day--</option>
                            <?php
                            $daysinaweek=$SHtimetableOOP->alltimetable('daysinaweek', 'priority', "ASC");
                          if (is_array($daysinaweek)) {
                            foreach($daysinaweek as $daysinaweeks){
                              $priority=trim($daysinaweeks['priority']);
                            ?>
                            <option value="<?php echo $priority; ?>" <?php if ($priority==$priority1) {?> selected="selected" <?php } ?> ><?php echo $daysinaweeks['name']; ?></option>
                         <?php
                            } 
                          } 
                          ?>
                          </select>
                        </div>
                      </div>
                     
                      <div class="form-group  col-xs-12">
                       <label class="control-label col-xs-3 col-xs-3 col-xs-12" for="levelname">No of Periods<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         
                            <select  id="noofperiod<?php echo $u; ?>" required="required" name="noofperiod<?php echo $u; ?>" class="form-control col-md-7 col-xs-12" onchange="addingperiods('timetablesemesterid', $('#timetablesemesterid').val(), 'timetableweekid', $('#timetableweekid').val(), 'daydate', $('#date<?php echo $u; ?>').val(), $('#operatorid').val(), '<?php echo $u; ?>', this.value, 'addingperiods', 'containerperiod<?php echo $u; ?>');">
                            <option value="">--No of Periods--</option>
                            <?php
                          
                            for($i=1; $i<=20; $i++){
                             
                            ?>
                            <option value="<?php echo $i; ?>" ><?php echo $i; ?></option>
                         <?php
                            }  
                          ?>
                          </select>
                        </div>
                      </div>
                      
                      <div id="containerperiod<?php echo $u; ?>">
                      </div>                 
            <?php
              $numofdays-=1;
              //$numboffld2add-=1;
              $u+=1;
             } ?>
 
                     
                      <div id="msg" ></div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
                    
                          <a href="?schoolhelp=<?php echo $operatorid; ?>" class="btn btn-success">Finish</a>
                        </div>
                      </div>

<?php }else{echo "<div id='msg'>Please check selected week whether it empty, Most likely that no of days has not been assigned to the selected week </div>";}
 } //End Getting details from two different tables
 ?>

 <?php

 ?>

  <?php
//Getting details from two different tables
 if($section=="addingdays2") {
  $numofdays="";
  $startdate="";
  $enddate="";

  $tabletoadd=trim(isset($_POST['tabletoadd'])?$_POST['tabletoadd']:false);
  
 $tabletocheck=trim(isset($_POST['tabletocheck'])?$_POST['tabletocheck']:false);
 $tabletocheckfield1=trim(isset($_POST['tabletocheckfield1'])?$_POST['tabletocheckfield1']:false);
 $tabletocheckid1=trim(isset($_POST['tabletocheckid1'])?$_POST['tabletocheckid1']:false);
 $tabletocheckfield2=trim(isset($_POST['tabletocheckfield2'])?$_POST['tabletocheckfield2']:false);
 $tabletocheckid2=trim(isset($_POST['tabletocheckid2'])?$_POST['tabletocheckid2']:false);

  
  //collecting number of days avaliable for this week timetable setup
   $retrievedata=$SHtimetableOOP->alltimetableedit2($tabletocheck, $tabletocheckfield1, $tabletocheckid1, $tabletocheckfield2, $tabletocheckid2);
   
    if (is_array($retrievedata)) {
      foreach ($retrievedata as $retrievedatarec) {
      $startdate=$retrievedatarec['startdate'];
      $enddate=$retrievedatarec['enddate'];
      $numofdays=$retrievedatarec['noofdays'];
      }
    }
  
  $daycount="";
  $dayname="";
 
  $k=0;
  if($numofdays>0){ ?>  

                       <div class="form-group col-xs-12">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Day Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="date" class="form-control col-md-7 col-xs-12" type="date" name="date"  placeholder="Enter the Lecture Day date"  min="<?php echo $startdate; ?>" max="<?php echo $enddate; ?>" value="" required="required" onchange="collectdate(this.value, 'collectdate', 'opencontainer3');">
                        </div>
                       </div>
                      
                      <div id="opencontainer3">
                         <div class="form-group col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Weekly Day<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
                          <select  id="weeklyday" required="required" name="weeklyday" class="form-control col-md-7 col-xs-12" required="required" >
                            <option value="">--Select Weekly Day--</option>
                            <?php
                            $daysinaweek=$SHtimetableOOP->alltimetable('daysinaweek', 'priority', "ASC");
                          if (is_array($daysinaweek)) {
                            foreach($daysinaweek as $daysinaweeks){
                              $priority=trim($daysinaweeks['priority']);
                            ?>
                            <option value="<?php echo $priority; ?>" ><?php echo trim($daysinaweeks['name']); ?></option>
                         <?php
                            } 
                          } 
                          ?>
                          </select>
                        </div>
                      </div>      
                      </div>           
         
<?php }else{echo "<div id='msg'>Please check selected week whether it empty, Most likely that no of days has not been assigned to the selected week</div>
<input type='hidden' id='date' name='date'  required='required'>
<input type='hidden' id='weeklyday' name='weeklyday' required='required'>
";}
 } //End Getting details from two different tables
 ?>

<?php
//Checking whether a time period has been added
 if($section=="lectureperiodclash") {
  $tablename1=trim(isset($_POST['tablename1'])?$_POST['tablename1']:false);
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
  $fieldname1=trim(isset($_POST['fieldname1'])?$_POST['fieldname1']:false);
  $fieldvalue1=trim(isset($_POST['fieldvalue1'])?$_POST['fieldvalue1']:false);
  $fieldname2=trim(isset($_POST['fieldname2'])?$_POST['fieldname2']:false);
  $fieldvalue2=trim(isset($_POST['fieldvalue2'])?$_POST['fieldvalue2']:false);
  $fieldname3=trim(isset($_POST['fieldname3'])?$_POST['fieldname3']:false);
  $fieldvalue3=trim(isset($_POST['fieldvalue3'])?$_POST['fieldvalue3']:false);
  $timetablesemesterid="";
  $levelid="";
  $optionid="";

  $messages="";
  $record=$SHtimetableOOP->alltimetableedit2($tablename1, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1);
  if (is_array($record)) {
    foreach ($record as $records) {
      $timestatus="";
      $starttime=trim($records['starttime']);
      $endtime=trim($records['endtime']);
      $daydate=trim($records['daydate']);
      $courseid=trim($records['courseid']);
      $timetablesemesterid=trim($records['timetablesemesterid']);
       $staffid=trim($records['instructorid']);

      $record10=$SHtimetableOOP->alltimetableedit('timetablesemester', 'timetablesemesterid', $timetablesemesterid);
        if (is_array($record10)) {
          foreach ($record10 as $records10) {
            $levelid=trim($records10['levelid']);
            $optionid=trim($records10['optionid']);
          }
        }
      
      $csname="";

          if (($fieldvalue2>=$starttime)&&($fieldvalue2<$endtime)) {
            $timestatus=1;
          }

           if (($fieldvalue3>$starttime)&&($fieldvalue3<$endtime)) {
            $timestatus=1;
          }
          if ($timestatus==1) {

             $sfullname="";
                  $squalification="";
                 $record9=$SHtimetableOOP->alltimetableedit('staff', 'staffid', $staffid);
                if (is_array($record9)) {
                  foreach ($record9 as $records9) {
                  $sfullname=trim($records9['surname'])." ".trim($records9['othername']);
                  
                  }
                }

             $record7=$SHtimetableOOP->alltimetableedit('course', 'csid', $courseid);
                if (is_array($record7)) {
                  foreach ($record7 as $records7) {
                  $csname=trim($records7['csname']);
                  $coursecode=trim($records7['coursecode']);
                  }
                }

                $record6=$SHtimetableOOP->alltimetableedit('level', 'levelid', $levelid);
                if (is_array($record6)) {
                  foreach ($record6 as $records6) {
                  $levelname=trim($records6['levelname']);
                  }
                }

                $record5=$SHtimetableOOP->alltimetableedit('optiontable', 'optid', $optionid);
                if (is_array($record5)) {
                  foreach ($record5 as $records5) {
                  $optname=trim($records5['optname']);
                  }
                }

            $messages.=$sfullname." has been scheduled already within the selected period to man for". $csname. " for ". $levelname." :: ".$optname." in this very selected day (". $daydate." by ".$starttime." - ".$endtime." )";
          }

    }

  }
  echo $messages;
}
?>

<?php
//Checking whether a time period has been added
 if($section=="lectureperiodclash2") {
  $tablename1=trim(isset($_POST['tablename1'])?$_POST['tablename1']:false);
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
  $timetablesemesterid="";
  $levelid="";
  $optionid="";

  $messages="";
  $record=$SHtimetableOOP->alltimetableedit2($tablename1, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1);
  if (is_array($record)) {
    foreach ($record as $records) {
      $timestatus="";
      $starttime=trim($records['starttime']);
      $endtime=trim($records['endtime']);
      $daydate=trim($records['daydate']);
      $courseid=trim($records['courseid']);
      $timetablesemesterid=trim($records['timetablesemesterid']);
       $staffid=trim($records['instructorid']);
     $dailytimetableid=trim($records[$fieldname4]);
     if ($fieldvalue4!=$dailytimetableid) {

      $record10=$SHtimetableOOP->alltimetableedit('timetablesemester', 'timetablesemesterid', $timetablesemesterid);
        if (is_array($record10)) {
          foreach ($record10 as $records10) {
            $levelid=trim($records10['levelid']);
            $optionid=trim($records10['optionid']);
          }
        }
      
      $csname="";

          if (($fieldvalue2>$starttime)&&($fieldvalue2<$endtime)) {
            $timestatus=1;
          }

           if (($fieldvalue3>$starttime)&&($fieldvalue3<$endtime)) {
            $timestatus=1;
          }
          if ($timestatus==1) {

             $sfullname="";
                  $squalification="";
                 $record9=$SHtimetableOOP->alltimetableedit('staff', 'staffid', $staffid);
                if (is_array($record9)) {
                  foreach ($record9 as $records9) {
                  $sfullname=trim($records9['surname'])." ".trim($records9['othername']);
                  
                  }
                }

             $record7=$SHtimetableOOP->alltimetableedit('course', 'csid', $courseid);
                if (is_array($record7)) {
                  foreach ($record7 as $records7) {
                  $csname=trim($records7['csname']);
                  $coursecode=trim($records7['coursecode']);
                  }
                }

                $record6=$SHtimetableOOP->alltimetableedit('level', 'levelid', $levelid);
                if (is_array($record6)) {
                  foreach ($record6 as $records6) {
                  $levelname=trim($records6['levelname']);
                  }
                }

                $record5=$SHtimetableOOP->alltimetableedit('optiontable', 'optid', $optionid);
                if (is_array($record5)) {
                  foreach ($record5 as $records5) {
                  $optname=trim($records5['optname']);
                  }
                }

            $messages.=$sfullname." has been scheduled already within the selected period to man for". $csname. " for ". $levelname." :: ".$optname." in this very selected day (". $daydate." by ".$starttime." - ".$endtime." )";
          }
        }
    }

  }
  echo $messages;
}
?>

<?php
//Checking whether a time period has been added
 if($section=="checktime3") {
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
  $timetablesemesterid="";
  $levelid="";
  $optionid="";
  $staffid="";
  $sfullname="";

  $messages="";
  $record=$SHtimetableOOP->alltimetableedit2($tablename, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2);
  if (is_array($record)) {
    foreach ($record as $records) {
      
     $dailytimetableid=trim($records['dailytimetableid']);

      if ($dailytimetableid!=$fieldvalue) { // Checking where Supplied ID  is not equal to selected ID
      
      $timestatus="";
      $starttime=trim($records['starttime']);
      $endtime=trim($records['endtime']);
      $daydate=trim($records['daydate']);
      $courseid=trim($records['courseid']);
      $staffid=trim($records['instructorid']);
      $timetablesemesterid=trim($records['timetablesemesterid']);

      $record10=$SHtimetableOOP->alltimetableedit('timetablesemester', 'timetablesemesterid', $timetablesemesterid);
        if (is_array($record10)) {
          foreach ($record10 as $records10) {
            $levelid=trim($records10['levelid']);
            $optionid=trim($records10['optionid']);
          }
        }

      $sfullname="";
                  $squalification="";
                 $record9=$SHtimetableOOP->alltimetableedit('staff', 'staffid', $staffid);
                if (is_array($record9)) {
                  foreach ($record9 as $records9) {
                  $sfullname=trim($records9['surname'])." ".trim($records9['othername']);
                  
                  }
                }
      
      $csname="";
          if (($fieldvalue3>=$starttime)&&($fieldvalue3<=$endtime)) {
            $timestatus=1;
          }

           if (($fieldvalue4>=$starttime)&&($fieldvalue4<=$endtime)) {
            $timestatus=1;
          }
          if ($timestatus==1) {

             $record7=$SHtimetableOOP->alltimetableedit('course', 'csid', $courseid);
                if (is_array($record7)) {
                  foreach ($record7 as $records7) {
                  $csname=trim($records7['csname']);
                  $coursecode=trim($records7['coursecode']);
                  }
                }

                $record6=$SHtimetableOOP->alltimetableedit('level', 'levelid', $levelid);
                if (is_array($record6)) {
                  foreach ($record6 as $records6) {
                  $levelname=trim($records6['levelname']);
                  }
                }

                $record5=$SHtimetableOOP->alltimetableedit('optiontable', 'optid', $optionid);
                if (is_array($record5)) {
                  foreach ($record5 as $records5) {
                  $optname=trim($records5['optname']);
                  }
                }

            $messages.=$sfullname." has been scheduled already within the selected period to man for ". $csname. " for ". $levelname." :: ".$optname." in this very selected day (". $daydate." by ".$starttime." - ".$endtime." )";
          }

        }//End of checking whether equal to
    }

  }
  echo $messages;
}
?>


<?php
 
//Checking whether a time period has been added
 if($section=="collectdate") {
  $startingdate="";
 
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
  
  $startingdate=$fieldvalue;
   
  $datename=date("l jS F, Y", strtotime($startingdate));

  $myArray = explode(' ', $datename);
  foreach ($myArray as $key => $value) {
    if ($key==0) {
      $dayname=strtolower($value);
    }
  }

  $priority1=1;
  if ($dayname=="monday") {
   $priority1=1;
  }
  elseif ($dayname=="tuesday") {
    $priority1=2;
  }
  elseif ($dayname=="wednesday") {
   $priority1=3;
  }
  elseif ($dayname=="thursday") {
    $priority1=4;
  }
  elseif ($dayname=="friday") {
    $priority1=5;
  }
   elseif ($dayname=="saturday") {
    $priority1=6;
  }
   elseif ($dayname=="sunday") {
    $priority1=7;
  } ?>

      <div class="form-group col-xs-12">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Weekly Day<span class="required">*</span></label>
          <div class="col-md-6 col-sm-6 col-xs-12">
                          
            <select  id="weeklyday" required="required" name="weeklyday" class="form-control col-md-7 col-xs-12" >
              <option value="">--Select Weekly Day--</option>
                <?php
                  $daysinaweek=$SHtimetableOOP->alltimetable('daysinaweek', 'priority', "ASC");
                    if (is_array($daysinaweek)) {
                      foreach($daysinaweek as $daysinaweeks){
                ?>
                    <option value="<?php echo trim($daysinaweeks['priority']); ?>" <?php if (trim($daysinaweeks['priority'])==$priority1) {?> selected="selected" <?php } ?> ><?php echo $daysinaweeks['name']; ?></option>
                <?php
                      } 
                    } 
                ?>
            </select>
          </div>
        </div>
<?php }
?>

 <?php
//Checking whether a time period has been added
 if($section=="lecturetime") {
  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
  $fieldname1=trim(isset($_POST['fieldname1'])?$_POST['fieldname1']:false);
  $fieldvalue1=trim(isset($_POST['fieldvalue1'])?$_POST['fieldvalue1']:false);
  $fieldname2=trim(isset($_POST['fieldname2'])?$_POST['fieldname2']:false);
  $fieldvalue2=trim(isset($_POST['fieldvalue2'])?$_POST['fieldvalue2']:false);
  $fieldname3=trim(isset($_POST['fieldname3'])?$_POST['fieldname3']:false);
  $fieldvalue3=trim(isset($_POST['fieldvalue3'])?$_POST['fieldvalue3']:false);
  
  $dailytimetable=0;
  $record=$SHtimetableOOP->alltimetableedit3($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2);
  if (is_array($record)) {
    foreach ($record as $records) {
      $fieldnametoget=trim($records[$fieldname3]);
      $starttime=trim($records['starttime']);
      $endtime=trim($records['endtime']);

      if ($fieldvalue3==$fieldnametoget) {
        $dailytimetableid=trim($records['dailytimetableid']);
      }elseif ($fieldvalue3>$starttime && $fieldvalue3<$endtime) {
        $dailytimetableid=trim($records['dailytimetableid']);
      }

    }
  }
  echo $dailytimetableid;
}
?>

<?php
 
//Checking whether a time period has been added
// This was formally lecturetime but now addedlecturetime

 if($section=="addedlecturetime") {
  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
  $fieldname1=trim(isset($_POST['fieldname1'])?$_POST['fieldname1']:false);
  $fieldvalue1=trim(isset($_POST['fieldvalue1'])?$_POST['fieldvalue1']:false);
  $fieldname2=trim(isset($_POST['fieldname2'])?$_POST['fieldname2']:false);
  $fieldvalue2=trim(isset($_POST['fieldvalue2'])?$_POST['fieldvalue2']:false);
 
  
  $countofperiods=0;
  $record=$SHtimetableOOP->alltimetableedit3($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2);
  if (is_array($record)) {
    foreach ($record as $records) { 
      $countofperiods++;
    }
  }
  echo $countofperiods;
}
?>

<?php
 
//Checking whether a time period has been added
 if($section=="checkhall") {
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

  
  $totalstudent="";
  $levelid="";
  $optionid="";
  $timestatus=0;

   $retrievedata=$SHtimetableOOP->alltimetableedit('timetablesemester', $fieldname, $fieldvalue);
    if (is_array($retrievedata)) {
      foreach ($retrievedata as $retrievedatarec) {
         $levelid=trim($retrievedatarec['levelid']);
         $optionid=trim($retrievedatarec['optionid']);
      }
    }
  $hallcapacity="";
    //Getting Hall Capacity
    $retrievedata1=$SHtimetableOOP->alltimetableedit('lecturehall', 'lecturehallid', $fieldvalue2);
    if (is_array($retrievedata1)) {
      foreach ($retrievedata1 as $retrievedatarec1) {
        $hallcapacity=trim($retrievedatarec1['capacity']);
      }
    }

    //Getting total number of student in the class
    $retrievedata2=$SHtimetableOOP->alltimetableedit2('students', 'levelid', $levelid, 'optid', $optionid);
    $totalstudent=count($retrievedata2);
 
  
  $hallengagements="";
  $messages="";
  $starttime="";
  $endtime="";

// Accessing the dialytimetable table
  $record=$SHtimetableOOP->alltimetableedit2($tablename,$fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2);
  if (is_array($record)) {
    foreach ($record as $records) { 
      $starttime=trim($records[$fieldname3]);
      $endtime=trim($records[$fieldname3]);
    }
  }

  if ($totalstudent>$hallcapacity) {
    $messages.="No of Students ( ". $totalstudent." ) has exceeded Hall's capacity(".$hallcapacity." ) ";
  }

  if (($fieldvalue2>$starttime)&&($fieldvalue2<$endtime)) {
    $timestatus=1;
  }

   if (($fieldvalue3>$starttime)&&($fieldvalue3<$endtime)) {
    $timestatus=1;
  }
  if ($timestatus==1) {
    $messages.="\n This Hall is engaged by this allocated period of time";
  }

  echo $messages;

}
?>

<?php
 
//Checking whether a time period has been added
 if($section=="checkhall2") {
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
  
  $totalstudent="";
  $levelid="";
  $optionid="";
  $timestatus=0;

   $retrievedata=$SHtimetableOOP->alltimetableedit('timetablesemester', $fieldname, $fieldvalue);
    if (is_array($retrievedata)) {
      foreach ($retrievedata as $retrievedatarec) {
         $levelid=trim($retrievedatarec['levelid']);
         $optionid=trim($retrievedatarec['optionid']);
      }
    }
  $hallcapacity="";
    //Getting Hall Capacity
    $retrievedata1=$SHtimetableOOP->alltimetableedit('lecturehall', 'lecturehallid', $fieldvalue2);
    if (is_array($retrievedata1)) {
      foreach ($retrievedata1 as $retrievedatarec1) {
        $hallcapacity=trim($retrievedatarec1['capacity']);
      }
    }

    //Getting total number of student in the class
    $retrievedata2=$SHtimetableOOP->alltimetableedit2('students', 'levelid', $levelid, 'optid', $optionid);
    $totalstudent=count($retrievedata2);
 
  
  $hallengagements="";
  $messages="";
  $starttime="";
  $endtime="";
  $dailytimetableid="";

// Accessing the dialytimetable table
  $record=$SHtimetableOOP->alltimetableedit2($tablename, $fieldname1, $fieldvalue1, $fieldname2, $fieldvalue2);
  if (is_array($record)) {
    foreach ($record as $records) { 
      $starttime=trim($records[$fieldname3]);
      $endtime=trim($records[$fieldname3]);
      $dailytimetableid=trim($records[$fieldname5]);
    }
  }

if (is_numeric($dailytimetableid)) {
  
if ($dailytimetableid!=$fieldvalue5) {
  if ($totalstudent>$hallcapacity) {
    $messages.="No of Students ( ". $totalstudent." ) has exceeded Hall's capacity(".$hallcapacity." ) ";
  }

  if (($fieldvalue2>$starttime)&&($fieldvalue2<$endtime)) {
    $timestatus=1;
  }

   if (($fieldvalue3>$starttime)&&($fieldvalue3<$endtime)) {
    $timestatus=1;
  }
  if ($timestatus==1) {
    $messages.="\n This Hall is engaged by this allocated period of time";
  }

  echo $messages;
  }

}//Checking whether value is numeric

}
?>

<?php
 
//Checking whether a time period has been added
 if($section=="coursecheck") {

  $tablename1=trim(isset($_POST['tablename1'])?$_POST['tablename1']:false);
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

  $totalstudent="";
   $levelid="";
  $optionid="";
  $timestatus=0;
  $messages="";

  // Checking Whether this timetable period has been added for the selected day date
   $retrievedata=$SHtimetableOOP->alltimetableedit('dailytimetable', $fieldname, $fieldvalue, $fieldname1, $fieldvalue1);
    if (is_array($retrievedata)) {
      foreach ($retrievedata as $retrievedatarec) {

        $daydate=trim($retrievedatarec['daydate']);
        $timetableweekid=trim($retrievedatarec['timetableweekid']);

        //Checking whether time has added for the selected day date
        if ($fieldvalue3==$daydate) {
           $timestatus=1;
           $starttime=trim($retrievedatarec['starttime']);
           $endtime=trim($retrievedatarec['endtime']);
           $daydate=trim($retrievedatarec['daydate']);
           $messages.="The selected course/subject has been scheduled already for this very selected day (". $daydate." by ".$starttime." - ".$endtime." ) ";
        }

          //Checking whether time has added for the selected week
         if ($fieldvalue2==$timetableweekid) {
           $timestatus=1;
           $starttime=trim($retrievedatarec['starttime']);
           $endtime=trim($retrievedatarec['endtime']);
           $daydate=trim($retrievedatarec['daydate']);
           $dayid=trim($retrievedatarec['dayid']);

           $messages.=" \n Day ".$dayid." The selected course/subject has been scheduled already for this very selected Week ( ".$daydate." ) by ".$starttime." - ".$endtime;
        }
       
      }
    }

   
  echo $messages;

}
?>

<?php
 
//Checking whether a time period has been added
 if($section=="coursecheck2") {

  $tablename1=trim(isset($_POST['tablename1'])?$_POST['tablename1']:false);
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

  $totalstudent="";
   $levelid="";
  $optionid="";
  $timestatus=0;
  $messages="";

  // Checking Whether this timetable period has been added for the selected day date
   $retrievedata=$SHtimetableOOP->alltimetableedit2('dailytimetable', $fieldname, $fieldvalue, $fieldname1, $fieldvalue1);
    if (is_array($retrievedata)) {
      foreach ($retrievedata as $retrievedatarec) {
        $dailytimetableid=trim($retrievedatarec['dailytimetableid']);

        if ($dailytimetableid!=$fieldvalue6) {
        $daydate=trim($retrievedatarec['daydate']);
        $timetableweekid=trim($retrievedatarec['timetableweekid']);

        //Checking whether time has added for the selected day date
        if ($fieldvalue3==$daydate) {
           $timestatus=1;
           $starttime=trim($retrievedatarec['starttime']);
           $endtime=trim($retrievedatarec['endtime']);
           $daydate=trim($retrievedatarec['daydate']);
           $messages.="The selected course/subject has been scheduled already for this very selected day (". $daydate." by ".$starttime." - ".$endtime." ) ";
        }

          //Checking whether time has added for the selected week
         if ($fieldvalue2==$timetableweekid) {
           $timestatus=1;
           $starttime=trim($retrievedatarec['starttime']);
           $endtime=trim($retrievedatarec['endtime']);
           $daydate=trim($retrievedatarec['daydate']);
           $dayid=trim($retrievedatarec['dayid']);

           $messages.=" \n Day ".$dayid." The selected course/subject has been scheduled already for this very selected Week(". $fieldvalue1. " ( ".$daydate." ) by ".$starttime." - ".$endtime;
        }
       
      }
    }

   }//End of checking daily timetable

  echo $messages;

}
?>

<?php
 //Retreiving weeks
 if($section=="copyweek") {
  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
  $tablename1=trim(isset($_POST['tablename1'])?$_POST['tablename1']:false);
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
  
  ?> <div class="row x_panel" >
    <div class="col-md-12 col-sm-12 col-xs-12">

      <div class="col-md-5 col-sm-5 col-xs-5">
    <div class="form-group">
           <label class="control-label col-md-6 col-sm-6 col-xs-12" for="timetableweekid">Week to Copy from<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            
         <select  name="timetableweekidcf" id="timetableweekidcf" required="required"  class="form-control col-md-6 col-xs-12"  >
           <option value="">--Select Week--</option>
      <?php
      $status="";
      $status1="";
     $sql = "SELECT distinct tw.timetableweekid, tw.priority FROM {$tablename}  AS d INNER JOIN {$tablename1} AS tw ON d.timetableweekid=tw.timetableweekid WHERE d.{$fieldname}= :fieldvalue order by tw.priority ASC";

    $stmt = $mysqli->prepare($sql);
    $stmt->execute([ ':fieldvalue'=>$fieldvalue]);
     if($stmt->rowCount()){
      $status=1;
        while($row=$stmt->fetch()){
          
      ?>
            <option value="<?php echo $row['timetableweekid']; ?>"><?php echo "Week ". $row['priority']; ?></option>
      <?php
         }
         }else{echo "<span id='msg'>Please check and Week Setup has been under the selected semester timetable setup</span>";}
          ?>
            </select>
          </div>
        </div>
      </div>

        <div class="col-xs-2 col-md-2 col-sm-2 " >
          <span class="fa fa-arrow-right" style="font-size:26px; margin:0px 5px"></span>
           <span class="fa fa-copy" style="color:green; font-size:26px; margin:0px 5px"></span>
            <span class="fa fa-arrow-right" style="color:green; font-size:26px; margin:0px 5px"></span>
        </div>

 <div class="col-md-5 col-sm-5 col-xs-5">
        <div class="form-group">
           <label class="control-label col-md-6 col-sm-6 col-xs-12" for="timetableweekid">Week to Copy to<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            
         <select  name="timetableweekidct" id="timetableweekidct" required="required"  class="form-control col-md-6 col-xs-12"  >
           <option value="">--Select Week--</option>
      <?php
      $weekid="";
      $priority="";
      $retrievedata=$SHtimetableOOP->alltimetableedit($tablename1, $fieldname, $fieldvalue);
    if (is_array($retrievedata)) {
      foreach ($retrievedata as $retrievedatarec) {
        $weekid=trim($retrievedatarec['timetableweekid']);
        $priority=trim($retrievedatarec['priority']);

      $retrievedata1=$SHtimetableOOP->alltimetableedit($tablename, 'timetableweekid', $weekid);
      if (!is_array($retrievedata1)) {
          $status1=1;
        ?>
              <option value="<?php echo $weekid; ?>"><?php echo "Week ". $priority; ?></option>
        <?php
           }
         }
         }else{echo "<span id='msg'>No timetable for the selected semester or there daily timetable attached to all the weeks</span>";} // End of checking all the weeks attached to this semester
   
          ?>
            </select>
          </div>
       </div>
     </div>

    <?php if ($status==1 and $status1==1) { ?>
    
     <div class="col-md-12 col-xs-12 col-sm-12">
      <center><input type="submit" name="" class="btn btn-success" value="Copy"></center>
      </div>
    <?php } ?>

   </div>
  </div>
                                  
<?php 
 } //End Getting details from two different tables
 ?>
