
<?php
include_once("../includes/connection.php");
include_once("../phpclass/SHcbtOOP.php");
include_once("../phpclass/SHcbtinserts.php");
include_once("../phpclass/SHcbtupdate.php");
 $SHcbtOOP= new classCbt;
 $SHcbtinsert= new insertTable;
 $SHcbtupdate= new updateTable;
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
 	
 	$record=$SHcbtOOP->allbusaryedit($tablename, $fieldname, $fieldvalue);
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
 	
 	$record=$SHcbtOOP->allbusaryedit2($tablename, $fieldname, $fieldvalue, $fieldname1, $fieldvalue1);
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
 if($section=="retrieveselection") {
  $tablename=trim(isset($_POST['tablename'])?$_POST['tablename']:false);
  $fieldname=trim(isset($_POST['fieldname'])?$_POST['fieldname']:false);
  $fieldvalue=trim(isset($_POST['fieldvalue'])?$_POST['fieldvalue']:false);
 

  $fieldcount=trim(isset($_POST['fieldcount'])?$_POST['fieldcount']:false);
     
  //Requested fields from database tables
    $requestedfield1=trim(isset($_POST['requestedfield1'])?$_POST['requestedfield1']:false);
    $requestedfield2=trim(isset($_POST['requestedfield2'])?$_POST['requestedfield2']:false);

  //This Generated Element Name
    $requestedelementname=trim(isset($_POST['requestedelementname'])?$_POST['requestedelementname']:false);
    $requestedelementtitle=trim(isset($_POST['requestedelementtitle'])?$_POST['requestedelementtitle']:false);
    $errormessage=trim(isset($_POST['errormessage'])?$_POST['errormessage']:false);
    
  
  //Error message to display
    

  ?>   <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departmentid"><?php echo $requestedelementtitle; ?><span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
             <!-- (table to add name, table to add field to check, table to check name,  table to check field to check, table to check field to get, table to check value to check with, section to operate)-->
         <select  name="<?php echo $requestedelementname.$count; ?>" id="<?php echo $requestedelementname.$count; ?>" required="required"  class="form-control col-md-6 col-xs-12" >
           <option value="">--Select <?php echo $requestedelementtitle; ?>--</option>
		  <?php
		  	$retrievedata=$SHcbtOOP->allbusaryedit($tablename, $fieldname, $fieldvalue);
		  if (is_array($retrievedata)) {
		    foreach($retrievedata as $field){
		  ?>
		        <option value="<?php echo $field[$requestedfield1]; ?>"><?php echo $field[$requestedfield2]; ?></option>
		  <?php
		     }
		     }else{echo "<span id='msg'> ". $errormessage." </span>";}
		      ?>
		        </select>
		      </div>
		    </div>
                                            
<?php 
 } //End Getting details from two different tables
 ?>
