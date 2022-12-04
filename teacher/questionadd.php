 <!--relevent Details-->
 <?php
 $xID=(isset($_GET['refno'])?$_GET['refno']:false);
	$cbtsetupid=(isset($_GET['cbtsetupid'])?$_GET['cbtsetupid']:false);
	?>
 <style>
	.invalid{border:#FF0000 1px solid;}
  	.ui-tooltip {padding: 10px;color: #333;font-size: 12px; background: #FFACAC ;}
  
</style> 

<table class="table table-responsive" >
	 <tr>
                    <td height="40" width="50%"><strong> Question Image</strong></td>
                    
                    <td><input class="form-control" type="file" name="fileInput"  id="fileInput" onchange="checkupload($('#fileInput').val(),'1');"/></td>
                </tr>
               <tr>
                    <td ><strong> Enter Question </strong></td>
                    
                    <td><textarea class="form-control" style="border-radius:4px;" name="questfirst"  id="questfirst" required="true"></textarea></td>
                </tr>
                <tr>
                  <td ><strong>Enter Answer A</strong></td>
                 
                  <td><input type="text" class="form-control" style=" border-radius:4px;" name="option1first"  id="option1first" required="true" ></td>
                </tr>
                <tr>
                  <td ><strong>Enter Answer B </strong></td>
                  
                  <td><input type="text" class="form-control" style="border-radius:4px;"  name="option2first"  id="option2first" required="true" ></td>
                </tr>
                <tr>
                  <td ><strong>Enter Answer C</strong></td>
                 
                  <td><input type="text" class="form-control" style="border-radius:4px;" name="option3first"  id="option3first" required="true" ></td>
                </tr>
                <tr>
                  <td ><strong>Enter Answer D</strong></td>
                  
                  <td><input type="text" class="form-control" style="border-radius:4px;" name="option4first"  id="option4first" required="true" ></td>
                </tr>
                <tr>
                  <td ><strong>Enter True Answer </strong></td>
                  
                  <td>
                  <select name="trueansfirst" class="form-control" style=" border-radius:4px;" id="trueansfirst" required="true" >
                  		<option value="">Select Answer</option>
                        <option value="1">A</option>
                         <option value="2">B</option>
                         <option value="3">C</option>
                         <option value="4">D</option>
                  </select>
                  </td>
                </tr>
                <tr>
                  <td><input class="form-control" style=" background-color:#060; border-color:#060; color:#FFF; border-radius:4px;" type="submit"  onClick="return callCrudAction('add','',$('.num_qQues').attr('id'), $('.cbtsetupid').attr('id'), $('.classinfo').attr('id'), $('#questfirst').val(), $('#option1first').val(), $('#option2first').val(), $('#option3first').val(), $('#option4first').val(), $('#trueansfirst').val());" name="submit" value="Add" ></td>
                  <td><input class="form-control" style="background-color:#060; border-color:#060; color:#FFF; border-radius:4px;" type="reset" name="cancel" value="Cancel" onClick="$('#addcbtquestfirst').hide(); $('#addcbtquest').hide(); $('#cbtquesview').show(); $('#cbtquesview').load('cbtquesretrival.php?refno=<?php echo $xID; ?>&cbtsetupid=<?php echo $cbtsetupid; ?>'); $('.paging_link').show(); "></td>
                </tr>
              </table>
          	    
              