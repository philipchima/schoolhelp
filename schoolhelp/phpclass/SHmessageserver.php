<?php 
include_once("../includes/connection.php");
include_once("../phpclass/SHmessageOOP.php");
 $schoolhelpMessage= new classMessage;
$section=trim(isset($_POST['section'])?$_POST['section']:false);

//Adding of school fields
 if ($section=="schools") {
 	$numberoffields=trim(isset($_POST['numberoffields'])?$_POST['numberoffields']:false);
 	while($numberoffields>=1){
 		$numberoffields-=1; ?>

 <?php	}
 } ?>

 

 <?php
 if($section=="checkduplicates") {
  $schoolhelpMessage= new classStudent;
 	$tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
 	$fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
 	$fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
 	
 	$record=$schoolhelpMessage->allTables($tablename, $fieldname, $fieldvalue);

 	echo $record;
 	
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
 if($section=="state") {
  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
    
  //($tablename, $fieldname, $fieldvalue, $fieldrequested)

  $retrievedata=$schoolhelpMessage->allmessageedit($tablename, $fieldname, $fieldvalue);
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
  $retrievedata=$schoolhelpMessage->allmessageedit($tablename, $fieldname, $fieldvalue);
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
 	$retrievedata=$schoolhelpMessage->allmessageedit($tablename, $fieldname, $fieldvalue);
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
 	$retrievedata=$schoolhelpMessage->allmessageedit($tablename, $fieldname, $fieldvalue);
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
  $retrievedata=$schoolhelpMessage->allmessageedit($tablename, $fieldname, $fieldvalue);
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
  $retrievedata=$schoolhelpMessage->allstudentedit2($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1);
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
  $retrievedata=$schoolhelpMessage->allmessageedit($tablename, $fieldname, $fieldvalue);
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
 	$retrievedata=$schoolhelpMessage->allmessageedit($tablename, $fieldname, $fieldvalue);
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
 if($section=="retrievemultistudent") {
 $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
 $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
 $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);

$admintype=trim(isset($_POST['admintype'])?$_POST['admintype']:false);
  $logindepartmentid=trim(isset($_POST['logindepartmentid'])?$_POST['logindepartmentid']:false);

   if ($fieldvalue!="") {

        if (!isset($cumulevel[''])) {
                $cumulevel['']="";
            }
   
  
       if ($fieldvalue=="10000") {

              if ($admintype==0) {

                //Getting classes to send message to
                  $retrievedata2=$schoolhelpMessage->allmessageedit('level', 'departmentid', $logindepartmentid);
                  if (is_array($retrievedata2)) { 
                     foreach($retrievedata2 as $field2){
                

                          if (!isset($cumustid[''])) {
                                    $cumustid['']="";
                            }
                       
                           $cumustid[]=trim($field2['levelid']);
                   
                }

              }

              }// End checking whether the admin that select all class is a super admin
              else{

                 $retrievedata2=$schoolhelpMessage->allmessage('level', 'levelid', 'ASC');
                  if (is_array($retrievedata2)) { 
                     foreach($retrievedata2 as $field2){
                
                           $cumulevel[]=trim($field2['levelid']);
                   
                }

              }

              }

       
       }else{

           $cumulevel[]=trim($fieldvalue);
       }
       ?>

        <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Title<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <input name="messagetitle"  type="text" id='messagetitle' placeholder="Please Title of message"  required="required"  class="form-control"/>
           </div>
         </div>

         <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Message<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea placeholder="Please type your message here" name="stumessage" id="stumessage" required="required" class="form-control" style="height: 100px"></textarea>
           </div>
         </div>
      <div style="color:green"><b>Tick here to select all</b><input name="topcheckbox"  type="checkbox" id='checkAll' onchange="if(this.checked){ this.value='1'; checkno(this.value); }else{this.value=''; checkno(this.value); }" />  </div>
       <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid">Students Numbers<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
          <?php //($tablename, $fieldname, $fieldvalue, $fieldrequested)
              foreach ($cumulevel as $key => $value) {
              
          $retrievedata=$schoolhelpMessage->allmessageeditorder('students', 'levelid', $value, 'optid', 'ASC');
          if (is_array($retrievedata)) { 

              foreach($retrievedata as $field){
                 if ($field['phone']!="") {
                
              ?>    
                    <div class="col-xs-3 col-md-3"><input name="studid[]" id="<?php echo $field['phone']; ?>" type="checkbox" class="status1 form-control" onchange="if(this.checked){ this.value='<?php echo $field["phone"]; ?>'; } else{this.value='';} "  value="<?php echo $field['phone']; ?>" /><?php echo $field['surname']." ".$field['othername']; ?> <br><?php echo $field['phone']; ?></div>
              <?php
                     
                     }
                  }

                  }
                }
              ?>
                  



      </div>
    </div>
         <div id="msg" ></div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                         
                    
<?php 
  }//End of checking whether level is empty
 } //End the section
 ?>


 



