<?php 
include_once("../includes/connection.php");
include_once("../phpclass/SHstudentOOP.php");
 $schoolhelpDash= new classStudent;
$section=trim(isset($_POST['section'])?$_POST['section']:false);

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
  $schoolhelpDash= new classStudent;
 	$tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
 	$fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
 	$fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
 	
 	$record=$schoolhelpDash->allTables($tablename, $fieldname, $fieldvalue);

 	echo $record;
 	
  }
?>

<?php
 if($section=="picturecall") {
  $k=0; 
  $i=0;
  $picturename="";
  $ffs = scandir('../uploads/original/');
  unset($ffs[array_search('.', $ffs, true)]);
  unset($ffs[array_search('..', $ffs, true)]);

  if (count($ffs) > 0){
      foreach($ffs as $ff){  
        $picturename=$ff;
       }                                             
      }   
      echo  $picturename;             
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
 if($section=="state") {
  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
    
  //($tablename, $fieldname, $fieldvalue, $fieldrequested)

  $retrievedata=$schoolhelpDash->allstudentedit($tablename, $fieldname, $fieldvalue);
  if (is_array($retrievedata)) {
  ?>   <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">State<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
             <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
         <select name="stateid" id="stateid" required="required"  class="form-control col-md-6 col-xs-12"  onchange="retrieveselection1('lga', 'stateid', this.value, 0, 0, 'lga', 'lga');">
           <option value="">--Select State--</option>
  <?php
    foreach($retrievedata as $field){
  ?>
        <option value="<?php echo $field['id']; ?>"><?php echo $field['name']; ?></option>
  <?php
      }?>
        </select>
      </div>
    </div>
                
                    
<?php }else{echo "<span id='msg'>Please Contact the admin to add states on the database</span>";}
 } //End Getting details from two different tables
 ?>

 <?php
//Getting details from two different tables
 if($section=="lga") {
  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
    
  
  //($tablename, $fieldname, $fieldvalue, $fieldrequested)



  $retrievedata=$schoolhelpDash->allstudentedit($tablename, $fieldname, $fieldvalue);
  if (is_array($retrievedata)) {
  ?>   <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">LGA<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
             <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
         <select  id="lgaid" required="required" name="lgaid" class="form-control col-md-6 col-xs-12"  >
           <option value="">--Select LGA--</option>
  <?php
    foreach($retrievedata as $field){
  ?>
        <option value="<?php echo $field['lgaid']; ?>"><?php echo $field['name']; ?></option>
  <?php
      }?>
        </select>
      </div>
    </div>
                
                    
<?php }else{echo "<span id='msg'>Please Contact the admin to add states on the database</span>";}
 } //End Getting details from two different tables
 ?>

 <?php
//Getting details from two different tables
 if($section=="retrieveselection") {
 	$tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
 	$fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
 	$fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
 	 	
 	
 	//($tablename, $fieldname, $fieldvalue, $fieldrequested)
 	$retrievedata=$schoolhelpDash->allstudentedit($tablename, $fieldname, $fieldvalue);
 	if (isset($retrievedata)) {
 	?>	 <div class="form-group">
	         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="levelid">Level<span class="required">*</span>
	         </label>
	         <div class="col-md-6 col-sm-6 col-xs-12">
	         	 <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
		 		 <select name="levelid" id="levelid" required="required"  class="form-control col-md-6 col-xs-12" onchange="addingfields('optiontable', 'levelid', 'level', 'levelid', 'levelnumoption', this.value, 'checktwotables1');">
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
                          <input type="text" name="optname[]" id="optname" required="required"  class="form-control col-md-7 col-xs-12" placeholder="Please enter Option name here" onblur="return updatevalidity1('optiontable', 'optname', 'levelid', this.value, $('#levelid').val(), 'inserting', $(this).attr('id'));">
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
 	$retrievedata=$schoolhelpDash->allstudentedit($tablename, $fieldname, $fieldvalue);
 	if (isset($retrievedata)) {
 	?>	 <div class="form-group">
	         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Level<span class="required">*</span>
	         </label>
	         <div class="col-md-6 col-sm-6 col-xs-12">
	         	 <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
		 		 <select  name="levelid" id="levelid" required="required"  class="form-control col-md-6 col-xs-12" onchange="retrieveselection1('optiontable', 'levelid', this.value, 0, 0, 'retrieveselection2', 'retrieveselection2');">
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
 if($section=="retrieveselectionmulti1") {
  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
  //$fldname=trim(isset($_POST['fldname'])?$_POST['fldname']:false);
  //$fldid=trim(isset($_POST['fldid'])?$_POST['fldid']:false);
  
  //($tablename, $fieldname, $fieldvalue, $fieldrequested)
  $retrievedata=$schoolhelpDash->allstudentedit($tablename, $fieldname, $fieldvalue);
  if (isset($retrievedata)) {
  ?>   <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Level<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
             <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
         <select  name="levelid" id="levelid" required="required"  class="form-control col-md-6 col-xs-12" onchange="retrieveselectionmulti1('optiontable', 'levelid', this.value, 0, 0, 'retrieveselectionmulti2', 'retrieveselection2');">
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
 if($section=="twofieldscheck") {
  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
  $fieldname1=trim(isset($_POST['fieldname1'])?$_POST['fieldname1']:false);
  $fieldvalue1=trim(isset($_POST['fieldvalue1'])?$_POST['fieldvalue1']:false);

  
  //($tablename, $fieldname, $fieldvalue, $fieldrequested)
  $retrievedata=$schoolhelpDash->allstudentedit2($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1);
  if (is_array($retrievedata)) {
    echo 1;
  ?>                
                    
<?php }else{ echo 0;}
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
  $retrievedata=$schoolhelpDash->allstudentedit($tablename, $fieldname, $fieldvalue);
  if (isset($retrievedata)) {
  ?>   <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="optionid">Option|Arm|Group<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
             <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
         <select name="optionid" id="optionid" required="required"  class="form-control col-md-6 col-xs-12" onchange="retrieveselection3('course', 'departmentid', $('#departmentid').val(), 0, 0, 'retrieveselection3', 'retrieveselection3', 'subjcourse');">
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
 if($section=="retrieveselectionmulti2") {
 	$tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
 	$fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
 	$fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
 	//$fldname=trim(isset($_POST['fldname'])?$_POST['fldname']:false);
 	//$fldid=trim(isset($_POST['fldid'])?$_POST['fldid']:false);
 	
 	//($tablename, $fieldname, $fieldvalue, $fieldrequested)
 	$retrievedata=$schoolhelpDash->allstudentedit($tablename, $fieldname, $fieldvalue);
 	if (isset($retrievedata)) {
 	?>	 <div class="form-group">
	         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Option|Arm|Group<span class="required">*</span>
	         </label>
	         <div class="col-md-6 col-sm-6 col-xs-12">
	         	 <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
		 		 <select name="optionid" id="optionid" required="required"  class="form-control col-md-6 col-xs-12" onchange="retrieveselectionmulti3('course', 'departmentid', $('#departmentid').val(), 0, 0, 'retrieveselectionmulti3', 'retrieveselection3', 'subjcourse');">
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
 if($section=="retrieveselection4") {
  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
  //$fldname=trim(isset($_POST['fldname'])?$_POST['fldname']:false);
  //$fldid=trim(isset($_POST['fldid'])?$_POST['fldid']:false);
  
  //($tablename, $fieldname, $fieldvalue, $fieldrequested)
  $retrievedata=$schoolhelpDash->allstudentedit($tablename, $fieldname, $fieldvalue);
  if (is_array($retrievedata)) {
  ?>   <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Option|Arm|Group<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
             <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
         <select  name="optionid" id="optionid" required="required"  class="form-control col-md-6 col-xs-12" >
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
 if($section=="retrieveselection3") {
   $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
 $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);

   $whattoretrieve=trim(isset($_POST['whattoretrieve'])?$_POST['whattoretrieve']:false);
  //$fldname=trim(isset($_POST['fldname'])?$_POST['fldname']:false);
  //$fldid=trim(isset($_POST['fldid'])?$_POST['fldid']:false);
  if ($whattoretrieve=="subjcourse") {

  //($tablename, $fieldname, $fieldvalue, $fieldrequested)
  $retrievedata=$schoolhelpDash->allstudentedit($tablename, $fieldname, $fieldvalue);
  if (is_array($retrievedata)) { 

    ?>   
         
          <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Courses/Subject<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
             <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
         <select  name="courseid" id="courseid" required="required"  class="form-control col-md-6 col-xs-12" onblur="return updatevalidity1('instructorcourses', 'courseid', 'optionid', this.value, $('#optionid').val(), 'updating', $(this).attr('id'));">
           <option value="">--Courses/Subject--</option>
  <?php
    foreach($retrievedata as $field){
      $departmentid=trim($field['departmentid']);
      $departmentmethod=$schoolhelpDash->allstudentedit('department', 'did', $departmentid);
       foreach($departmentmethod as $department){
        $departmentname=$department['deptname'];
       }
  ?>
        <option value="<?php echo $field['csid']; ?>"><?php echo $field['csname'] ; ?></option>
  <?php
      }?>
        </select>
      </div>
    </div>
         <div id="msg" ></div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                         
                    
<?php }else{echo "<span id='msg'>Please contact the admin to add Courses/Subject under this option</span>";}
 } //End Getting details from two different tables
}
 ?>

 <?php
 //This for  level selection retrieval
//Getting details from two different tables
 if($section=="retrieveselectionmulti3") {
  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
 $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
$fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);

   $whattoretrieve=trim(isset($_POST['whattoretrieve'])?$_POST['whattoretrieve']:false);
  
  if ($whattoretrieve=="subjcourse") {

  //($tablename, $fieldname, $fieldvalue, $fieldrequested)
  $retrievedata=$schoolhelpDash->allstudentedit($tablename, $fieldname, $fieldvalue);
  if (is_array($retrievedata)) { 

    ?>   
         
          <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Courses/Subject<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
             <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
         <div style="color:green"><b>Tick the Courses/Subjects to assign to this Instructor before submission</b></div>
  <?php
    foreach($retrievedata as $field){
      $departmentid=trim($field['departmentid']);
      
  ?>    <input name="courseid[]"  id="courseid[]" value="<?php  echo $field['csid']; ?>" type="hidden"/>
        <div class="col-xs-3 col-md-3"><input type="checkbox" class="form-control" name="<?php echo $field['csid']; ?>" id="<?php echo $field['csid']; ?>" onchange="if(this.checked){ this.value=1; }else{this.value=0;} check2flds_in_a_tbl('instructorcourses', 'courseid', 'optionid', $(this).attr('id'), $('#optionid').val(), 'inserting', 'twofieldscheck', $(this).attr('id'));" ><?php echo $field['csname'] ; ?></div>
  <?php
      }?>
        
      </div>
    </div>
         <div id="msg" ></div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                         
                    
<?php }else{echo "<span id='msg'>Please contact the admin to add Courses/Subject under this option</span>";}
 } //End Getting details from two different tables
}
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
                      <?php
                      $classSemester= new classSemester;
                      $retrievedata=$classSemester->semester('asc');
				 	if (isset($retrievedata)) {
				 	?>	 <div class="form-group">
					         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Semester<span class="required">*</span>
					         </label>
					         <div class="col-md-6 col-sm-6 col-xs-12">
					         	 <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
						 		 <select  id="semesterid" required="required" name="semesterid[]" class="form-control col-md-6 col-xs-12" >
						 			 <option value="">--Select Semester--</option>
							 	<?php
							 		foreach($retrievedata as $field){
							 	?>
							 		 		<option value="<?php echo $field['semesterid']; ?>"><?php echo $field['semestername']; ?></option>
								<?php
										}?>
								</select>
							</div>
						</div>
						<?php }else{echo "Semesters not added";} ?>
                      <div class="form-group">
                       
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="levelname">Course Name<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="csname" required="required" name="csname[]" class="form-control col-md-7 col-xs-12" placeholder="Please enter Option name here" onblur="return updatevalidity1('course', 'csname', 'optionid', this.value, $('#optid').val(), 'inserting', $(this).attr('id'));">
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
<?php }else{echo "<span id='msg'>Please check department course duration, Most likely it is not assign or specified levels have not been added</span>";}
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

