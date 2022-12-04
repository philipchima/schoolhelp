<?php 
include_once("../includes/connection.php");
include("../phpclass/schoolhelpOOP.php");
include("../phpclass/schoolhelpupdate.php");

$section=trim(isset($_POST['section'])?$_POST['section']:false);
$schoolhelpDash=new Allsettings;
$schoolhelpupdate= new updateTBLactivate;

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
 if($section=="checkduplicates1") {

 	$tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
 	$fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
 	$fieldname1=trim(isset($_POST['fieldname1'])?$_POST['fieldname1']:false);
 	$fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
 	$fieldvalue1=trim(isset($_POST['fieldvalue1'])?$_POST['fieldvalue1']:false);

 	$record=allTBL2fields($tablename, $fieldname, $fieldname1, $fieldvalue, $fieldvalue1);

 	echo $record;
 	
  }
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
 	
 	//collecting number of years or levels avaliable for this department
 	//($tablename, $fieldname, $fieldvalue, $fieldrequested)
 	$tabletocheckrecord=allTables1($tabletocheck, $tabletocheckfield, $tabletocheckid, $tabletocheckgetfield);
 	$numofyear=$tabletocheckrecord['fieldrequested'];

 	//checking whether any level or year have been added for this department
 	$tabletoaddrecord=allTables($tabletoadd, $tabletoaddfield, $tabletocheckid);
 	$numboffld2add=$numofyear-$tabletoaddrecord;
 	$k=0;
 	if($numboffld2add>0){ ?>
 	
                      <div class="x_panel" >
 
 	<?php while($numboffld2add>=1){
 		$k+=1;
?>
   <span>Level-<?php echo $k; ?></span>
                      <hr>
                      
                      <div class="form-group">
                       
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="levelname">Level Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="levelname" required="required" name="levelname[]" class="form-control col-md-7 col-xs-12" onblur="return updatevalidity1('level', 'levelname', 'departmentid', this.value, $('#departmentid').val(), 'inserting', $(this).attr('id'));">
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Level Rank<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="levelrank" class="form-control col-md-7 col-xs-12" type="text" name="levelrank[]" required="required" placeholder="Example: 0 or 1 or 2">
                        </div>
                      </div>
                     
                       <div class="form-group">
                        <label for="levelnumoption" class="control-label col-md-3 col-sm-3 col-xs-12">Options</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="levelnumoption" class="form-control col-md-7 col-xs-12" type="number" name="levelnumoption[]" placeholder="Enter operational number of options(groups)">
                        </div>
                      </div>
<?php
  $numboffld2add-=1;
 } ?>
 
                     
                      <div id="msg" ></div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
<?php }else{echo "<span id='msg'>Please check department course duration, Most likely it is not assign or specified levels have not been added</span>";}
 } //End Getting details from two different tables
 ?>


 <?php
//Getting details from two different tables
 if($section=="retrieveselection") {
 	$tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
 	$fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
 	$fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
 	 	
 	
 	//($tablename, $fieldname, $fieldvalue, $fieldrequested)
 	$retrievedata=alltblselection($tablename, $fieldname, $fieldvalue);
 	if (isset($retrievedata)) {
 	?>	 <div class="form-group">
	         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Level<span class="required">*</span>
	         </label>
	         <div class="col-md-6 col-sm-6 col-xs-12">
	         	 <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
		 		 <select  id="levelid" required="required" name="levelid" class="form-control col-md-6 col-xs-12" onchange="addingfields('optiontable', 'levelid', 'level', 'levelid', 'levelnumoption', this.value, 'checktwotables1');">
		 			 <option value="">--Select Level--</option>
 	<?php
 		foreach($retrievedata as $field){
 	?>
 		 		<option value="<?php echo $field['levelid']; ?>"><?php echo $field['levelname']; ?></option>
	<?php
			}?>
				</select>
			</div>
		</div>
			          
                    
<?php }else{echo "<span id='msg'>Please check department course duration, Most likely it is not assign or specified levels have not been added</span>";}
 } //End Getting details from two different tables
 ?>

 <?php
//Getting details from two different tables
 if($section=="checktwotables1") {
 	$tabletoadd=trim(isset($_POST['tabletoadd'])?$_POST['tabletoadd']:false);
 	$tabletoaddfield=trim(isset($_POST['tabletoaddfield'])?$_POST['tabletoaddfield']:false);
 	$tabletocheck=trim(isset($_POST['tabletocheck'])?$_POST['tabletocheck']:false);
 	$tabletocheckfield=trim(isset($_POST['tabletocheckfield'])?$_POST['tabletocheckfield']:false);
 	$tabletocheckgetfield=trim(isset($_POST['tabletocheckgetfield'])?$_POST['tabletocheckgetfield']:false);
 	$tabletocheckid=trim(isset($_POST['tabletocheckid'])?$_POST['tabletocheckid']:false);
 	
 	//collecting number of years or levels avaliable for this department
 	//($tablename, $fieldname, $fieldvalue, $fieldrequested)
 	$tabletocheckrecord=allTables1($tabletocheck, $tabletocheckfield, $tabletocheckid, $tabletocheckgetfield);
 	$numofoption=$tabletocheckrecord['fieldrequested'];

 	//checking whether any level or year have been added for this department
 	$tabletoaddrecord=allTables($tabletoadd, $tabletoaddfield, $tabletocheckid);
 	$numboffld2add=$numofoption-$tabletoaddrecord;
 	$k=0;
 	if($numboffld2add>0){ ?>
 	
                      <div class="x_panel" >
 
 	<?php while($numboffld2add>=1){
 		$k+=1;
?>
   <span>Option- <?php echo $k; ?></span>
                      <hr>
                      
                      <div class="form-group">
                       
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="levelname">Option Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="optname" required="required" name="optname[]" class="form-control col-md-7 col-xs-12" placeholder="Please enter Option name here" onblur="return updatevalidity1('optiontable', 'optname', 'levelid', this.value, $('#levelid').val(), 'inserting', $(this).attr('id'));">
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Description<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="optdescription" class="form-control col-md-7 col-xs-12"  name="optdescription[]" required="required" placeholder="PLease Define this specialization"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">No of Courses<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="optcourses" class="form-control col-md-7 col-xs-12"  name="optcourses[]" required="required" placeholder="PLease Enter Number of Courses this is doing">
                        </div>
                      </div>
                     
                       <div class="form-group">
                        <label for="levelnumoption" class="control-label col-md-3 col-sm-3 col-xs-12">Priority</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="optpriority" class="form-control col-md-7 col-xs-12" type="number" name="optpriority[]"  placeholder="Prioritize the option, 1 for most prioritize">
                        </div>
                      </div>
<?php
  $numboffld2add-=1;
 } ?>
 
                     
                      <div id="msg" ></div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
<?php }else{echo "<span id='msg'>Please check department course duration, Most likely it is not assign or specified levels have not been added</span>";}
 } //End Getting details from two different tables
 ?>


 <?php
 //This for  level selection retrieval
//Getting details from two different tables
 if($section=="retrieveselection1") {
 	$tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
 	$fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
 	$fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
 	//$fldname=trim(isset($_POST['fldname'])?$_POST['fldname']:false);
 	//$fldid=trim(isset($_POST['fldid'])?$_POST['fldid']:false);
 	
 	//($tablename, $fieldname, $fieldvalue, $fieldrequested)
 	$retrievedata=alltblselection($tablename, $fieldname, $fieldvalue);
 	if (isset($retrievedata)) {
 	?>	 <div class="form-group">
	         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Level<span class="required">*</span>
	         </label>
	         <div class="col-md-6 col-sm-6 col-xs-12">
	         	 <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
		 		 <select  id="levelid" required="required" name="levelid" class="form-control col-md-6 col-xs-12" onchange="retrieveselection1('optiontable', 'levelid', this.value, 0, 0, 'retrieveselection2', 'retrieveselection2');">
		 			 <option value="">--Select Level--</option>
 	<?php
 		foreach($retrievedata as $field){
 	?>
 		 		<option value="<?php echo $field['levelid']; ?>"><?php echo $field['levelname']; ?></option>
	<?php
			}?>
				</select>
			</div>
		</div>
			          
                    
<?php }else{echo "<span id='msg'>Please check department course duration, Most likely it is not assign or specified levels have not been added</span>";}
 } //End Getting details from two different tables
 ?>

 <?php
 //This for  level selection retrieval
//Getting details from two different tables
 if($section=="retrieveselection2") {
 	$tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
 	$fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
 	$fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
 	//$fldname=trim(isset($_POST['fldname'])?$_POST['fldname']:false);
 	//$fldid=trim(isset($_POST['fldid'])?$_POST['fldid']:false);
 	
 	//($tablename, $fieldname, $fieldvalue, $fieldrequested)
 	$retrievedata=alltblselection($tablename, $fieldname, $fieldvalue);
 	if (isset($retrievedata)) {
 	?>	 <div class="form-group">
	         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Option<span class="required">*</span>
	         </label>
	         <div class="col-md-6 col-sm-6 col-xs-12">
	         	 <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
		 		 <select  id="optionid" required="required" name="optionid" class="form-control col-md-6 col-xs-12" onchange="addingfields('course', 'optionid', 'optiontable', 'optid', 'optcourses', this.value, 'checktwotables2');">
		 			 <option value="">--Select Option--</option>
 	<?php
 		foreach($retrievedata as $field){
 	?>
 		 		<option value="<?php echo $field['optid']; ?>"><?php echo $field['optname']; ?></option>
	<?php
			}?>
				</select>
			</div>
		</div>
			          
                    
<?php }else{echo "<span id='msg'>Please check Level to see options attach to it, Most likely it is not assign or a particular option has not been added</span>";}
 } //End Getting details from two different tables
 ?>

 <?php
 //This 4 course page
//Getting details from two different tables
 if($section=="checktwotables2") {
 	$tabletoadd=trim(isset($_POST['tabletoadd'])?$_POST['tabletoadd']:false);
 	$tabletoaddfield=trim(isset($_POST['tabletoaddfield'])?$_POST['tabletoaddfield']:false);
 	$tabletocheck=trim(isset($_POST['tabletocheck'])?$_POST['tabletocheck']:false);
 	$tabletocheckfield=trim(isset($_POST['tabletocheckfield'])?$_POST['tabletocheckfield']:false);
 	$tabletocheckgetfield=trim(isset($_POST['tabletocheckgetfield'])?$_POST['tabletocheckgetfield']:false);
 	$tabletocheckid=trim(isset($_POST['tabletocheckid'])?$_POST['tabletocheckid']:false);
 	
 	//collecting number of years or levels avaliable for this department
 	//($tablename, $fieldname, $fieldvalue, $fieldrequested)
 	$tabletocheckrecord=allTables1($tabletocheck, $tabletocheckfield, $tabletocheckid, $tabletocheckgetfield);
 	$numofoption=$tabletocheckrecord['fieldrequested'];

 	//checking whether any level or year have been added for this department
 	$tabletoaddrecord=allTables($tabletoadd, $tabletoaddfield, $tabletocheckid);
 	$numboffld2add=$numofoption-$tabletoaddrecord;
 	$k=0;
 	if($numboffld2add>0){ ?>
 	
                      <div class="x_panel" >
 
 	<?php while($numboffld2add>=1){
 		$k+=1;
?>
   <span>Course- <?php echo $k; ?></span>
                      <hr>
                   
                      <div class="form-group">
                       
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="levelname">Course Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="csname" required="required" name="csname[]" class="form-control col-md-7 col-xs-12" placeholder="Please enter Course name here" onblur="return updatevalidity1('course', 'csname', 'departmentid', this.value, $('#departmentid').val(), 'inserting', $(this).attr('id'));">
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Description<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="csdescription" class="form-control col-md-7 col-xs-12"  name="csdescription[]" required="required" placeholder="PLease Define this specialization"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Credit Unit<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="cscreditunit" class="form-control col-md-7 col-xs-12"  name="cscreditunit[]" required="required" placeholder="PLease Enter the credit unit of this course">
                        </div>
                      </div>
                     
                       <div class="form-group">
                        <label for="levelnumoption" class="control-label col-md-3 col-sm-3 col-xs-12">Passmark</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="cspassmark" class="form-control col-md-7 col-xs-12" type="number" name="cspassmark[]" required="required"  placeholder="Please Enter the passmark">
                        </div>
                      </div>
<?php
  $numboffld2add-=1;
 } ?>
 
                     
                      <div id="msg" ></div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
<?php }else{echo "<span id='msg'>Please check department number of courses , Most likely it is not assigned or number of courses is completed</span>";}
 } //End Getting details from two different tables
 ?>

 <?php
 // To dispaly on grade insert page
//Getting details from two different tables 
 if($section=="checktwotables3") {
 	$tabletoadd=trim(isset($_POST['tabletoadd'])?$_POST['tabletoadd']:false);
 	$tabletoaddfield=trim(isset($_POST['tabletoaddfield'])?$_POST['tabletoaddfield']:false);
 	$tabletocheck=trim(isset($_POST['tabletocheck'])?$_POST['tabletocheck']:false);
 	$tabletocheckfield=trim(isset($_POST['tabletocheckfield'])?$_POST['tabletocheckfield']:false);
 	$tabletocheckgetfield=trim(isset($_POST['tabletocheckgetfield'])?$_POST['tabletocheckgetfield']:false);
 	$tabletocheckid=trim(isset($_POST['tabletocheckid'])?$_POST['tabletocheckid']:false);
 	
 	//collecting number of years or levels avaliable for this department
 	//($tablename, $fieldname, $fieldvalue, $fieldrequested)
 	$tabletocheckrecord=allTables1($tabletocheck, $tabletocheckfield, $tabletocheckid, $tabletocheckgetfield);
 	$numofyear=$tabletocheckrecord['fieldrequested'];

 	//checking whether any level or year have been added for this department
 	$tabletoaddrecord=allTables($tabletoadd, $tabletoaddfield, $tabletocheckid);
 	$numboffld2add=$numofyear-$tabletoaddrecord;
 	$k=0;
 	if($numboffld2add>0){ ?>
 	
                      <div class="x_panel" >
 
 	<?php while($numboffld2add>=1){
 		$k+=1;
?>
   <span>Grade Range -<?php echo $k; ?></span>
                      <hr>
                      
                      <div class="form-group">
                       
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="levelname">Grade Range<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="low" required="required" name="low[]" placeholder="Low range: eg. 80" class="form-control col-md-3 col-xs-6" onblur="return updatevalidity1('grade', 'low', 'departmentid', this.value, $('#departmentid').val(), 'inserting', $(this).attr('id'));">
                          <input type="number" id="high" required="required" name="high[]"  placeholder="High range: eg. 100" class="form-control col-md-3 col-xs-6" onblur="return updatevalidity1('grade', 'high', 'departmentid', this.value, $('#departmentid').val(), 'inserting', $(this).attr('id'));">
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label for="gradeletter" class="control-label col-md-3 col-sm-3 col-xs-12">Grade Letter<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="gradeletter" class="form-control col-md-7 col-xs-12" type="text" name="gradeletter[]" required="required" placeholder="Example: A, AB, B">
                        </div>
                      </div>
                     
                       <div class="form-group">
                        <label for="gradepoint" class="control-label col-md-3 col-sm-3 col-xs-12">Grade Point</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="gradepoint" class="form-control col-md-7 col-xs-12" type="text" name="gradepoint[]" placeholder="Example: 5">
                        </div>
                      </div>
 						<div class="form-group">
                      
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="levelname">Grade Range<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="low" name="cgpalow[]" placeholder="Low range: eg. 3.50; applicable to polytechnics" class="form-control col-md-3 col-xs-6" >
                          <input type="text" id="high"  name="cgpahigh[]"  placeholder="High range: eg. 4.00; applicable to polytechnics" class="form-control col-md-3 col-xs-6" >
                        </div>
                      </div>
                       <div class="form-group">
                        <label for="remark" class="control-label col-md-3 col-sm-3 col-xs-12">Remark</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="remark" name="remark[]" required="required" class="form-control col-md-7 col-xs-12" type="text"  placeholder="Example: Excellent">
                        </div>
                      </div>

                       
<?php
  $numboffld2add-=1;
 } ?>
 
                     
                      <div id="msg" ></div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
<?php }else{echo "<span id='msg'>Please check department for Grade, Most likely it is not assigned </span>";}
 } //End Getting details from two different tables
 ?>

 <?php
 // To dispaly on grade insert page
//Getting details from two different tables 
 if($section=="checktwotables4") {
 	$tabletoadd=trim(isset($_POST['tabletoadd'])?$_POST['tabletoadd']:false);
 	$tabletoaddfield=trim(isset($_POST['tabletoaddfield'])?$_POST['tabletoaddfield']:false);
 	$tabletocheck=trim(isset($_POST['tabletocheck'])?$_POST['tabletocheck']:false);
 	$tabletocheckfield=trim(isset($_POST['tabletocheckfield'])?$_POST['tabletocheckfield']:false);
 	$tabletocheckgetfield=trim(isset($_POST['tabletocheckgetfield'])?$_POST['tabletocheckgetfield']:false);
 	$tabletocheckid=trim(isset($_POST['tabletocheckid'])?$_POST['tabletocheckid']:false);
 	
 	//collecting number of years or levels avaliable for this department
 	//($tablename, $fieldname, $fieldvalue, $fieldrequested)
 	$tabletocheckrecord=allTables1($tabletocheck, $tabletocheckfield, $tabletocheckid, $tabletocheckgetfield);
 	$numofyear=$tabletocheckrecord['fieldrequested'];

 	//checking whether any level or year have been added for this department
 	$tabletoaddrecord=allTables($tabletoadd, $tabletoaddfield, $tabletocheckid);
 	$numboffld2add=$numofyear-$tabletoaddrecord;
 	$k=0;
 	if($numboffld2add>0){ ?>
 	
                      <div class="x_panel" >
 
 	<?php while($numboffld2add>=1){
 		$k+=1;
 		if ($k>1) {
 			$asstype="Exam";
 			$assper="60";
 		}
 		else{
 			$asstype="Test";
 			$assper="40";
 		}
?>
   <span>Assessment -<?php echo $k; ?></span>
                      <hr>
                                           
                      <div class="form-group">
                        <label for="gradeletter" class="control-label col-md-3 col-sm-3 col-xs-12">Assessment Name<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="assname" class="form-control col-md-7 col-xs-12" type="text" name="assname[]" required="required" placeholder="Example: <?php echo $asstype ?>">
                        </div>
                      </div>
                     
                       <div class="form-group">
                        <label for="gradepoint" class="control-label col-md-3 col-sm-3 col-xs-12">Assessment Percentage<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input name="asspercent[]" id="asspercent" class="form-control col-md-7 col-xs-12" type="number"  placeholder="Example: <?php echo $assper ?>" onblur="addition($(this).attr('id'));">
                        </div>
                      </div>
 						
                       <div class="form-group">
                        <label for="remark" class="control-label col-md-3 col-sm-3 col-xs-12">Assessment Description</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="assdescription" name="assdescription[]" required="required" class="form-control col-md-7 col-xs-12"  placeholder="Please Describe this assessment"></textarea>
                        </div>
                      </div>

                       
<?php
  $numboffld2add-=1;
 } ?>
 
                     
                      <div id="msg" ></div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
<?php }else{echo "<span id='msg'>Please check department for Assessment, Most likely it is not assigned Yet </span>";}
 } //End Getting details from two different tables
 ?>

<?php
 //This for  level selection retrieval
//Getting details from two different tables
 if($section=="retrieveselection4") {
  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
  //$fldname=trim(isset($_POST['fldname'])?$_POST['fldname']:false);
  //$fldid=trim(isset($_POST['fldid'])?$_POST['fldid']:false);
  
  //($tablename, $fieldname, $fieldvalue, $fieldrequested)
  $retrievedata=$schoolhelpDash->allsettingedit($tablename, $fieldname, $fieldvalue);
  if (is_array($retrievedata)) {
  ?>   <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Option|Arm|Group<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
             <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
         <select  name="optionid" id="optionid" required="required"  class="form-control col-md-6 col-xs-12" onblur="return updatevalidity('formteacher', 'optionid', this.value, 'inserting', $(this).attr('id'));">
           <option value="">--Select Option|Arm|Group--</option>
  <?php
    foreach($retrievedata as $field){
  ?>
        <option value="<?php echo $field['optid']; ?>"><?php echo $field['optname']; ?></option>
  <?php
      }?>
        </select>
      </div>
    </div>
                
                    
<?php }else{echo "<span id='msg'>Please check Level to see options attach to it, Most likely it is not assign or a particular option has not been added</span>";}
 } //End Getting details from two different tables
 ?>

 <?php
 //This for  level selection retrieval
//Getting details from two different tables
 if($section=="adminperson") {
  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
  //$fldname=trim(isset($_POST['fldname'])?$_POST['fldname']:false);
  //$fldid=trim(isset($_POST['fldid'])?$_POST['fldid']:false);
  $staffsurname="";
  $staffothername="";
  //($tablename, $fieldname, $fieldvalue, $fieldrequested)
   $retrievedata1=$schoolhelpDash->allsettingedit($tablename, $fieldname, $fieldvalue);
  if (is_array($retrievedata1)) {
    foreach($retrievedata1 as $field1){ 
      $staffid=trim($field1['staffid']);
    }
  }

  $retrievedata=$schoolhelpDash->allsettingedit('staff', 'staffid', $staffid);
  if (is_array($retrievedata)) {
    foreach($retrievedata as $field){ 
        $staffsurname=$field['surname'];
         $staffothername=$field['othername'];
     } ?>
                        <input id="staffid" class="form-control col-md-7 col-xs-12" type="hidden" name="staffid"  required="required" value="<?php echo $staffid ?>" >
                        <div class="form-group">
                          <label for="surname" class="control-label col-md-3 col-sm-3 col-xs-12">Surname<span class="required">*</span></label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="surname" id="surname" class="form-control col-md-7 col-xs-12" type="text"   placeholder="fill me by selecting Admin position" required="required" value="<?php echo $field['surname']; ?>" >
                                 </div>
                            </div>

                            <div class="form-group">
                              <label for="positiondesc" class="control-label col-md-3 col-sm-3 col-xs-12">Othername</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input name="othername" id="othername" value="<?php echo $field['othername']; ?>" type="text" class="form-control col-md-7 col-xs-12"  placeholder="fill me by selecting Admin position">
                              </div>
                            </div>
        </select>
      </div>
    </div>
                
                    
<?php }else{echo "<span id='msg'>This Signatory Person Does not have record in Staff records</span>";}
 } //End Getting details from two different tables
 ?>

 <?php
 // To dispaly on grade insert page
//Getting details from two different tables 
 if($section=="checktwotables5") {
  $tabletoadd=trim(isset($_POST['tabletoadd'])?$_POST['tabletoadd']:false);
  $tabletoaddfield=trim(isset($_POST['tabletoaddfield'])?$_POST['tabletoaddfield']:false);
  $tabletocheck=trim(isset($_POST['tabletocheck'])?$_POST['tabletocheck']:false);
  $tabletocheckfield=trim(isset($_POST['tabletocheckfield'])?$_POST['tabletocheckfield']:false);
  $tabletocheckgetfield=trim(isset($_POST['tabletocheckgetfield'])?$_POST['tabletocheckgetfield']:false);
  $tabletocheckid=trim(isset($_POST['tabletocheckid'])?$_POST['tabletocheckid']:false);
  
  //collecting number of years or levels avaliable for this department
  //($tablename, $fieldname, $fieldvalue, $fieldrequested)
  $tabletocheckrecord=allTables1($tabletocheck, $tabletocheckfield, $tabletocheckid, $tabletocheckgetfield);
  $numofyear=$tabletocheckrecord['fieldrequested'];

  //checking whether any level or year have been added for this department
  $tabletoaddrecord=allTables($tabletoadd, $tabletoaddfield, $tabletocheckid);
  $numboffld2add=$numofyear-$tabletoaddrecord;
  $k=0;
  if($numboffld2add>0){ ?>
  
                      <div class="x_panel" >
 
  <?php while($numboffld2add>=1){
    $k+=1;
    
?>
   <span>Domain Name -<?php echo $k; ?></span>
                      <hr>
                                           
                    <div class="form-group">
                        <label for="remark" class="control-label col-md-3 col-sm-3 col-xs-12">Domain Name</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="domainname" name="domainname[]" type="text" required="required" class="form-control col-md-7 col-xs-12"  placeholder="Please enter the Domain Name" onblur="return updatevalidity1('domaintype', 'domaintypename', 'domaintypeid',  this.value, $('#domaintypeid').val(), 'inserting', $(this).attr('id'))">
                        </div>
                      </div>
                     
                       
<?php
  $numboffld2add-=1;
 } ?>
 
                     
                      <div id="msg" ></div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
<?php }else{echo "<span id='msg'>This Domain Type sub-domain has gotten to its limit, But you can increase its number of domain</span>";}
 } //End Getting details from two different tables
 ?>

 <?php
 // To dispaly on grade insert page
//Getting details from two different tables 
 if($section=="checktwotables6") {
  $tabletoadd=trim(isset($_POST['tabletoadd'])?$_POST['tabletoadd']:false);
  $tabletoaddfield=trim(isset($_POST['tabletoaddfield'])?$_POST['tabletoaddfield']:false);
  $tabletocheck=trim(isset($_POST['tabletocheck'])?$_POST['tabletocheck']:false);
  $tabletocheckfield=trim(isset($_POST['tabletocheckfield'])?$_POST['tabletocheckfield']:false);
  $tabletocheckgetfield=trim(isset($_POST['tabletocheckgetfield'])?$_POST['tabletocheckgetfield']:false);
  $tabletocheckid=trim(isset($_POST['tabletocheckid'])?$_POST['tabletocheckid']:false);
  
  //collecting number of years or levels avaliable for this department
  //($tablename, $fieldname, $fieldvalue, $fieldrequested)
  $tabletocheckrecord=allTables1($tabletocheck, $tabletocheckfield, $tabletocheckid, $tabletocheckgetfield);
  $numofyear=$tabletocheckrecord['fieldrequested'];

  //checking whether any level or year have been added for this department
  $tabletoaddrecord=allTables($tabletoadd, $tabletoaddfield, $tabletocheckid);
  $numboffld2add=$numofyear-$tabletoaddrecord;
  $k=0;
  if($numboffld2add>0){ ?>
  
                      <div class="x_panel" >
 
  <?php while($numboffld2add>=1){
    $k+=1;
    
?>
  
                      <hr>
                                           
                    <div class="form-group">
                        <label for="remark" class="control-label col-md-3 col-sm-3 col-xs-12">Early Class Sub <?php echo $k; ?></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="subcatname" name="subcatname[]" required="required" class="form-control col-md-7 col-xs-12"  placeholder="Please enter the Category Sub" onblur="return updatevalidity1('earlycatsub', 'subcatname', 'earlycatid',  this.value, $('#earlyclasscatid').val(), 'inserting', $(this).attr('id'))"></textarea>
                        </div>
                      </div>
                     
                       
<?php
  $numboffld2add-=1;
 } ?>
 
                     
                      <div id="msg" ></div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
<?php }else{echo "<span id='msg'>This Domain Type sub-domain has gotten to its limit, But you can increase its number of domain</span>";}
 } //End Getting details from two different tables
 ?>