				<?php session_start(); 
				require_once ("../schoolhelp/includes/connection.php");
                $conn= new Dbh;
                $mysqli = $conn->connect();

				$staffid=(isset($_GET['refno'])?$_GET['refno']:false);
				$cbtsetupid=trim(isset($_GET['cbtsetupid'])?$_GET['cbtsetupid']:false);
				$item_per_page=10;
				
				if(isset($_POST["page"])?$_POST["page"]:false){
				$page_number = (filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH));
				if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
					}else{
						$page_number = 1;
					}
				?>
                
                
                <div style=" height:auto; text-align:left; margin-top:10px; margin-left:auto; margin-right:auto" class="table" >
             
               <table border="1" style="width:80%; margin-left:auto; margin-right:auto; border-color:#060" class="table table-responsive">
                <tr  align="center"><td colspan="7"><b style="font-family:tahoma">CBT Questions View</b></td></tr>
                <tr  align="center"><th rowspan="2">Questions</th><th colspan="5">Options</th><th>Setting</th></tr>
                <tr align="center"><th>A</th><th>B</th><th>C</th><th>D</th><th>Answer</th><th>Action</th></tr>
                
                <?php
				$position = (($page_number-1) * $item_per_page);
				$query_qQues="SELECT * FROM quiz_question s INNER JOIN quiz_setup c ON s.quiz_setup_id = c.qid WHERE s.quiz_setup_id='$cbtsetupid' ORDER BY quiz_ques_id DESC LIMIT $position, $item_per_page";
				
              $stmt1 = $mysqli->prepare($query_qQues);
              $stmt1->execute();
              $numrecord1=$stmt1->rowCount();
              if ($numrecord1>0) {
           
              while($row1=$stmt1->fetch()){ 
                $q_idt = $row1['quiz_ques_id'];
                $qst = $row1['question'];
				$dlink = $row1['dlink'];
                $ans1 = $row1['A'];
                $ans2 = $row1['B'];
                $ans3 = $row1['C'];
                $ans4 = $row1['D'];
                $ts = $row1['ans'];
                if ($ts == 1){
                $tr1 = 'A';
                }elseif ($ts==2){
                $tr1 = 'B';
                }elseif ($ts==3){
                $tr1 = 'C';
                }else{
                $tr1 = 'D';
                }
                
                ?>
                <tr><td style="width:20%;"><?php if($dlink!=""){?><img class="img img-responsive" style="width:20%; float:left" src="../backend/uploads/cbtquesimage/<?php echo $dlink?>"/><?php }?>&nbsp;&nbsp;&nbsp;<?php echo $qst; ?></td><td><?php echo $ans1; ?></td><td><?php echo $ans2; ?></td><td><?php echo $ans3; ?></td><td><?php echo $ans4; ?></td><td align="center"><?php echo $tr1; ?></td><td><table style="width:100%"><tr><td><input style="width:100%; height:30px; background-color:#060; border-color:#060; color:#FFF " type="submit" onClick="pratical('edit','<?php echo $q_idt; ?>','<?php echo $dlink; ?>','<?php echo $qst; ?>','<?php echo $ans1; ?>','<?php echo $ans2; ?>','<?php echo $ans3; ?>','<?php echo $ans4; ?>','<?php echo $ts; ?>');" name="submit" value="Edit"/></td><td><span id="dlinkdel" style="display:none"><?php echo $dlink; ?></span><input style="width:100%; height:30px; background-color:#060; border-color:#060; color:#FFF " type="submit" onClick="callCrudAction('delete', '<?php echo $q_idt; ?>','','','','','','','','','');" name="submit" value="Delete"/></td></tr></table></td></tr>
                
                <?php 
				$dlink="";
                }
				}
				else{ echo "<td>No Record Found</td>";
				}
                ?>
                <tr>
                <td>
                <input style="width:100%; height:30px; background-color:#060; border-color:#060; color:#FFF " type="submit" onClick="$('#cbtquesview').hide(); $('.paging_link').hide(); $('#addcbtquest').show(); ;"  name="submit" value="Add Question" />
                </td>
                </tr>
                </table>
                
                </div>
                 