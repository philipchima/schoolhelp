 <!--relevent Details-->
 <style>
	.invalid{border:#FF0000 1px solid;}
  	.ui-tooltip {padding: 10px;color: #333;font-size: 12px; background: #FFACAC ;}
  
</style> 

                <form action="" method="POST">
                <table class="table table-responsive" >
                <tr>
                  <td ><strong>Topic</strong></td>
                 
                  <td><input type="text" class="form-control" style=" height:36px; border-radius:4px;" name="topic"  id="topic" required="true" placeholder="Please Provide Material Topic"></td>
                </tr>
               <tr>
                    <td ><strong> Material Details</strong></td>
                    
                    <td><textarea class="form-control"  style=" height:60px; border-radius:4px;" name="detail" id="detail" required="true" placeholder="Please provide detailed inormation on what the material covers"></textarea></td>
                </tr>
                
                <tr>
                  <td ><strong>Upload Material</strong></td>
                  
                  <td> <input type="file" name="image" id="file_input" class="form-control" /></td>
                </tr>
               
                
                <tr>
                  <td><input style="width:100%; height:30px; background-color:#060; border-color:#060; color:#FFF; border-radius:4px;" type="submit" onClick="callCrudAction('add', '', $('.num_qQues').attr('id'),  $('.levelid').attr('id'),  $('.optionid').attr('id'), $('.courseid').attr('id'), $('.semesterid').attr('id'), $('.sessionid').attr('id'), $('#topic').val(), $('#detail').val(), $('#file_input').val());" name="submit" value="Add" ></td>
                  <td><input style="width:50%; height:30px; background-color:#060; border-color:#060; color:#FFF; border-radius:4px;" type="reset" name="cancel" value="Cancel" onClick="$('#addcbtquestfirst').hide(); $('#addcbtquest').hide(); $('#cbtquesview').show(); $('#cbtquesview').load('cbtquesretrival.php'); $('.paging_link').show(); "></td>
                </tr>
              </table>
            </form>
