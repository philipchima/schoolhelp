<?php
include("../schoolhelp/includes/connection.php");
include("phpclass/SHteacherinserts.php");
include("phpclass/SHteacherupdate.php");
include("headernew.php"); 
$conn= new Dbh;
$mysqli = $conn->connect();
$teachersinsert=new insertTable;
$schoolhelpupdate=new updateTable;
$item_per_page=12;
?>
<?php
         date_default_timezone_set("Africa/Lagos");
         $page1 = trim(isset($_GET['page1'])?$_GET['page1']:false);
         $sql = trim(isset($_GET['sql'])?$_GET['sql']:false);
          $tid=trim(isset($_GET['refno'])?$_GET['refno']:false);
         $staffid =trim (isset($_SESSION['t_teacherlog'.$tid])?$_SESSION["t_teacherlog".$tid]:false);
         $classinfo=trim(isset($_GET['tcid'])?$_GET['tcid']:false); //this variable should always be passed when reloading this page1

        //Select current Semester/semester
        $semesterdata=$SHteacher->allteacheredit('semesters','status', 1);
            if (is_array($semesterdata)) {
                foreach($semesterdata as $semesterrecord){
                    $semestername=$semesterrecord['semestername'];
                    $semesterid=trim($semesterrecord['semesterid']);
                    
              }
          }


        //Select current Session
         $sessiondata=$SHteacher->allteacheredit('session','status', 1);
            if (is_array($sessiondata)) {
                foreach($sessiondata as $sessiondrecord){
                    $sessionname=$sessiondrecord['sessionlow']."/".$sessiondrecord['sessionhigh'];
                     $sessionid=trim($sessiondrecord['sessionid']);    
              }
          }

         $teacherscourses=$SHteacher->allteacheredit('instructorcourses','icourseid', $classinfo);
            if (is_array($teacherscourses)) {
                 foreach($teacherscourses as $teacherscoursesrec){
                 $optionid=trim($teacherscoursesrec['optionid']);  

                 $levelid=trim($teacherscoursesrec['levelid']); 
                 $courseid=trim($teacherscoursesrec['courseid']);
                 $scoredeptid=trim($teacherscoursesrec['departmentid']);
                
         
            }
        }

            //Getting Department ID
              $leveldata=$SHteacher->allteacheredit('level', 'levelid', $levelid);
                if (is_array($leveldata)) {
                  foreach($leveldata as $levelrec){
                    $levelname=$teachersclassrec['levelname'];
                   $deptid=trim($levelrec['departmentid']);
                   $classtype=trim($levelrec['classtype']);
                  }
                }

            
              //Getting the Group information
            $teachersgroup=$SHteacher->allteacheredit('optiontable','optid', $optionid);
            if (is_array($teachersgroup)) {
                foreach($teachersgroup as $teachersgrouprec){
                    $optionname=$teachersgrouprec['optname'];
              }
          }

        $csname="";
        $teacherscourse=$SHteacher->allteacheredit('course','csid', $courseid);
            if (is_array($teacherscourse)) {
                foreach($teacherscourse as $teacherscourserec){
                    $csname=$teacherscourserec['csname'];
                    
              }
          }
     $odate = date("Y-m-d");
     // Closure of Variable
		 
		 
		 
	if ($page1 == 2)
	{
		$totaltime=(isset($_POST['totaltime'])?$_POST['totaltime']:false);
		$passmark=(isset($_POST['passmark'])?$_POST['passmark']:false);
		$totalscore=(isset($_POST['totalscore'])?$_POST['totalscore']:false);
		$noquestion=(isset($_POST['noquestion'])?$_POST['noquestion']:false);
    
    $startdatetime=(isset($_POST['startdatetime'])?$_POST['startdatetime']:false);
    $enddatetime=(isset($_POST['enddatetime'])?$_POST['enddatetime']:false);
  

		$odate=date("Y-m-d");
		$udate=date("Y-m-d H:i:s");
		$usertype=2;
		$status=2;
		
		// Inserting Assessment Parameter into the Database
     $state=$teachersinsert->insert_17fields('quiz_setup', 'levelid', $levelid, 'optionid', $optionid, 'semesterid', $semesterid, 'sessionid', $sessionid, 'courseid', $courseid, 'totaltime', $totaltime, 'totalscore', $totalscore, 'no_of_question', $noquestion, 'passmark', $passmark, 'startdatetime', $startdatetime, 'enddatetime', $enddatetime, 'instructorid', $staffid, 'instructorudate', $udate, 'usertype', $usertype, 'status', $status, 'departmentid', $deptid, 'odate', $odate);
			
     
		if($state){
		$sql="CBT Setup Parameter Inserted Successully";
		
			}else{
				$page1="";
				$sql= "<b>Operation was not successful<b>";
		}

    echo "<script language='javascript'>
        location.href='onlinetest?refno=$staffid&tcid=$classinfo&sql=$sql'
        </script>";

	}

  //Updating Quiz Setup
  if ($page1 == 21)
  {
    $cbtsetupid=(isset($_POST['cbtsetupid'])?$_POST['cbtsetupid']:false);
    $totaltime=(isset($_POST['totaltimeedit'])?$_POST['totaltimeedit']:false);
    $passmark=(isset($_POST['passmarkedit'])?$_POST['passmarkedit']:false);
    $totalscore=(isset($_POST['totalscoreedit'])?$_POST['totalscoreedit']:false);
    $noquestion=(isset($_POST['noquestionedit'])?$_POST['noquestionedit']:false);
    $startdatetime=(isset($_POST['startdatetime'])?$_POST['startdatetime']:false);
    $enddatetime=(isset($_POST['enddatetime'])?$_POST['enddatetime']:false);

    $startdatetime1=(isset($_POST['startdatetime1'])?$_POST['startdatetime1']:false);
    $enddatetime1=(isset($_POST['enddatetime1'])?$_POST['enddatetime1']:false);

    if ($startdatetime=="") {
      $startdatetime=$startdatetime1;
    }

     if ($enddatetime=="") {
      $enddatetime=$enddatetime1;
    }

    $odate=date("Y-m-d");
    $udate=date("Y-m-d H:i:s");
    $usertype=2;
    
     $state=$schoolhelpupdate->update_ninefields('quiz_setup', 'qid', $cbtsetupid, 'totaltime', $totaltime, 'totalscore', $totalscore, 'no_of_question', $noquestion, 'passmark', $passmark, 'startdatetime', $startdatetime, 'enddatetime', $enddatetime, 'instructorid', $staffid,  'usertype', $usertype, 'instructorudate', $udate);
      
 
    if($state!=""){
    $sql="CBT Setup Parameter Updated Successully";
    
      }else{
        $page1="";
        $sql= "<b>Operation was not successful<b>";
    }

    echo "<script language='javascript'>
        location.href='onlinetest?refno=$staffid&tcid=$classinfo&sql=$sql'
        </script>";

  }
	
	if ($page1 == 3)
	{
		 $cbtsetupid=(isset($_GET['cbtsetupid'])?$_GET['cbtsetupid']:false);
		
		$questfirst=trim(isset($_GET['questfirst'])?$_GET['questfirst']:false);
		$option1first=trim(isset($_GET['option1first'])?$_GET['option1first']:false);
		$A2=1;
		$option2first=trim(isset($_GET['option2first'])?$_GET['option2first']:false);
		$B2=2;
		$option3first=trim(isset($_GET['option3first'])?$_GET['option3first']:false);
		$C2 =3;
		$option4first=trim(isset($_GET['option4first'])?$_GET['option4first']:false);
		$D2=4;
		$trueansfirst=trim(isset($_GET['trueansfirst'])?$_GET['trueansfirst']:false);
    $odate=date("Y-m-d");
    $udate=date("Y-m-d H:i:s");
		
		//Inserting Image file
		if($_FILES['fileInput']['name']){
				$errors= array();
				$file_name = $_FILES['fileInput']['name'];
				$file_size =$_FILES['fileInput']['size'];
				$file_tmp =$_FILES['fileInput']['tmp_name'];
				$file_type=$_FILES['fileInput']['type'];   
				$file_ext=strtolower(end(explode('.', $file_name)));		
				$expensions= array("jpg","jpeg","gif","png","ico"); 		
				if(in_array($file_ext,$expensions)=== false){
					$errors[]="extension not allowed, please choose a JPEG or PNG file.";
				}
				if($file_size >100097152){
				$errors[]='File size must be excately 20 MB';
				}				
				if(empty($errors)==true){
					move_uploaded_file($file_tmp,"../schoolhelp/uploads/cbtquesimage/".$file_name);
					//echo "Success ". $file_name;
				}else{
					print_r($errors);
				}
			}
		
	
		// Inserting Assessment Parameter into the Database
	 $result=$teachersinsert->insert_15fields('quiz_question', 'quiz_setup_id', $cbtsetupid, 'dlink', $file_name, 'question', $questfirst, 'A', $option1first, 'A2', $A2, 'B', $option2first, 'B2', $B2, 'C', $option3first, 'C2', $C2, 'D', $option4first, 'D2', $D2, 'instructorudate', $udate,  'instructorid', $staffid, 'dlink', $file_name, 'odate', $odate);

if($result){
				
				$sql="CBT Question Parameter Inserted Successully";
				echo "<script language='javascript'>
				location.href='onlinetest?page1=1&refno=$staffid&tcid=$classinfo&sql=$sql'
				</script>";
			}else{
				$sql= "<b>Operation was not successful<b>";
				echo "<script language='javascript'>
				location.href='onlinetest?refno=$staffid&tcid=$classinfo&sql=$sql'
				</script>";
				}

	}
?>
 	
            
    		  
            <div class="container-fluid">
				<!-- /.row -->

              <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Hi!</strong> <span style="font:20px Corbel bold; color:#060; "><?php echo (isset($_SESSION["t_fullname".$tid])?$_SESSION["t_fullname".$tid]:false); ?> </span><span style="color:#FEA318;">Note that your operations is only strictly on <span style="font:20px Corbel  bold; color:#F00; "><?php echo $semestername; echo " ";?>Semester of <?php echo $sessionname; ?></span> </span>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- page1 Heading -->
                
               
      <?php
	  			// THIS IS B
      
               $scorecontent="SELECT * FROM quiz_setup s INNER JOIN level c ON s.levelid = c.levelid INNER JOIN optiontable g ON s.optionid = g.optid INNER JOIN course st ON s.courseid = st.csid WHERE s.levelid='$levelid' and s.optionid='$optionid' and s.courseid='$courseid' and s.semesterid='$semesterid' and s.sessionid='$sessionid'";
                $stmt = $mysqli->prepare($scorecontent);
              $stmt->execute([':fieldvalue'=>$staffid]);
              $numrecord=$stmt->rowCount();
              

                   
            ?>
        <div class="row">
				 <div class="col-md-11 col-lg-11 col-sm-11 col-xs-11 table-responsive" style="background:#063; margin:0% 2% 0% 4%; border-bottom:2px solid #8DFC6D; color:#FFF; border-radius:2px; -moz-border-radius:3px; -o-border-radius:3px; -webkit-border-radius:3px; -o-border-radius:3px; width:88%; height:35px; font-size:1.3em;">Computer Base Test</div>
        </div>

       
      	<div class="row">
        <div class="col-md-11 col-lg-11 col-sm-11 col-xs-11" style="background:#FFF; margin:0% 2% 1%; padding:1% 2%;">
         
      	<a class="btn btn-success" href="?tcid=<?php echo $classinfo; ?>&refno=<?php echo $staffid; ?>">CBT Setup</a>
        <?php if ($numrecord>0) { ?>
         <a class="btn btn-success" href="?page1=1&tcid=<?php echo $classinfo; ?>&refno=<?php echo $staffid; ?>" >CBT Questions Setup</a>
   	 	 <?php } ?>
        </div>
        </div>
        <?php if ($page1=="") {
          if($numrecord==0){ ?>
        
        <div class="col-md-11 col-lg-11 col-sm-11 col-xs-11" style="background:#FFF; margin:0% 2% 0%; padding:0.1% 2%;">
         <div class="tab-content">
         
            <!-- open 1st tab-->
         <div class="tab-pane fade in active">
      		
      
            		<h5>Please Setup CBT Parameters</h5>
                     <table class="table table-striped table-bordered example">
                    <tr height="23" onMouseOut="this.style.backgroundColor='';" >
                        <td colspan="5"  align="center" style="color:#F00;">CBT for<?php echo " ". $semestername; echo " "; ?>Term of <?php echo " ". $sessionname;?> <label id="dis">This Session CBT is not Setup Yet</label></td>
                    </tr>	
                   </table>
              <div class="form"> 
                <form class="login-form" name="cbtsaveform" action="onlinetest?refno=<?php echo $staffid; ?>&tcid=<?php echo $classinfo ?>&page1=2" method="post" onSubmit="return checkcbt()">
                <!--relevent Details-->
                
       			<table class="table table-responsive">
                <tr >
              	<td >Total Time</td>
                <td ><input  class="timepicker username" type="text" name="totaltime" placeholder="eg: 00:00:00" required="required" /></td>
                </tr>
                <tr>
                <td>Pass Mark</td>
                <td><input  class="username" type="number" name="passmark" placeholder="Pass Mark" /></td>
                </tr>
                 <tr>
                <td>Number of question</td>
                <td><input  class="noquestion" type="text" name="noquestion" placeholder="total number of question" /></td>
                </tr>
                <tr>
                <td>Total Score</td>
                <td><input  class="username" type="text" name="totalscore" placeholder="Total Score" /></td>
                </tr>
                
                <tr>
                <td>Start Datetime</td>
                <td> <input type="datetime-local" id="startdatetime" name="startdatetime" required="required"></td>
                </tr>
                   <tr>
                <td>End Datetime</td>
                <td><input type="datetime-local" id="enddatetime" name="enddatetime" required="required"></td>
                </tr>
                <tr>
                <td>
                <button type="submit">Save</button>
                </td>
                <td>
                <button type="reset">Cancel</button>
                
                </td>
                </tr>
              </table>
              </form>
  			</div>
            
                    <?php } 
              
				else{
			   while($row=$stmt->fetch()){ 
			?>
            	
                <div class="form"  id="cbtview"> 
                <h4>CBT View</h4>
                <div id="dis"></div>
                <div style="color:#060;"><b><?php echo $sql; ?></b></div>
                <div >
                 <table class="table table-striped table-bordered example table-responsive" >
                
                <tr >  
                   <td style="width:50%">Uploaded Person</td><td align="center" style="width:50%">
                    <?php $person_id=trim($row['instructorid']);
                          $adminid=trim($row['operatorid']);
                        $staffdata=$SHteacher->allteacheredit('staff','staffid', $person_id);
                          if (is_array($staffdata)) {
                              foreach($staffdata as $staffdatarec){
                                  $staffname=$staffdatarec['surname'].' '.$staffdatarec['othername'];
                            }
                        }

                     if($row['usertype']==2){ echo $staffname; 
                      }else{ 

                          $admindata=$SHteacher->allteacheredit('adminperson','adminid', $adminid);
                          if (is_array($admindata)) {
                              foreach($admindata as $admindatarec){
                                  $adminname=$admindatarec['surname'].' '.$admindatarec['othername'];
                            }
                        }

                        echo $adminname; }
                        ?>
                          
                        </td>
                    </tr>
                    <tr>
                    <td>Uploaded Date</td><td align="center"><?php  echo $row['odate']?></td>
                    </tr>
                    <tr>
                    <td>Total Time</td><td align="left"><?php  echo $row['totaltime'];?></td>
                      </tr>
                    <tr>
               		<td>Pass Mark</td><td align="left"><?php  echo $row['passmark']; ?></td>
                      </tr>
                       <tr>
               		<td>Number Question to Answer</td><td align="left"><?php  echo $row['no_of_question']; ?></td>
                      </tr>
                    <tr>
                    <td>Total Score</td><td align="left"><?php  echo $row['totalscore']; ?></td></tr>
                    <tr>  
  <tr>
                    <td>Start Date/Time</td><td align="left"><?php  echo $row['startdatetime']; ?></td></tr>
                    <tr> 

                      <tr>
                    <td>End Date/Time</td><td align="left"><?php  echo $row['enddatetime']; ?></td></tr>
                    <tr> 
                    <td   ></td><td ><button style="background-color:#060; border-color:#060; color:#FFF" id="cbtedit">Edit</button></td>
                    
                </tr>
			</table> 
            </div>
            </div>
            
            <div class="form" id="cbteditform" style="display:none"> 
            <h4>CBT Setup Edit </h4>
            
                <form class="login-form2" name="cbtedit"  id="cbtupdateform" action="onlinetest?refno=<?php echo $staffid; ?>&tcid=<?php echo $classinfo ?>&page1=21" method="post"  onSubmit="return checkcbtedit()">
   				     <table class="table table-responsive">
                <tr>
                 <td>

                <input id="cbtsetupid" name="cbtsetupid"  value="<?php  echo $row['qid'];?>" hidden="hidden"/>
                <span id="<?php  echo $row['qid'];?>"  class="qid" hidden="hidden"><?php  echo $row['qid'];?></span>
                <span id="<?php echo $deptid; ?>"  class="schoolid" hidden="hidden"> <?php echo $deptid; ?></span>
                <span id="<?php echo $sessionid; ?>" class="sessionid" hidden="hidden"> <?php echo $sessionid; ?></span>
                <span id=" <?php echo $semesterid; ?>" class="termid" hidden="hidden"> <?php echo $semesterid; ?></span>
                <span id="<?php echo $levelid; ?>" class="levelid" hidden="hidden"> <?php echo $levelid; ?></span>
                <span id="<?php echo $courseid; ?>" class="subjectid" hidden="hidden"> <?php echo $courseid; ?></span>
                <span id="<?php echo $optionid; ?>" class="groupid" hidden="hidden"> <?php echo $optionid; ?></span>
                <span id="<?php echo $staffid; ?>" class="teacherid" hidden="hidden"> <?php echo $staffid; ?></span>
                 
                 </td>
                 </tr>
                <tr >
              	<td ><label>Total Time</label></td>
                <td ><input  class="username" id="totaltime" type="text" name="totaltimeedit" placeholder="Total Time" value="<?php  echo $row['totaltime'];?>" /></td>
                </tr>
                <tr>
                <td><label>Pass Mark</label></td>
                <td><input  class="username" id="passmark" type="number" name="passmarkedit" placeholder="Pass Mark" value="<?php  echo $row['passmark'];?>" /></td>
                </tr>
                <tr>
                <td><label>No of Question</label></td>
                <td><input  class="username" id="noquestion" name="noquestionedit" placeholder="Number of question to answer" value="<?php  echo $row['no_of_question'];?>"/></td>
                </tr>
                <tr>
                <td><label>Total Score</label></td>
                <td><input  class="username" id="totalscore" name="totalscoreedit" placeholder="Total Score" value="<?php  echo $row['totalscore'];?>"/></td>
                </tr>
                <tr>
                <td>Start Date/Time</td>
                <td> <input type="text" id="startdatetime1" name="startdatetime1" value="<?php echo $row['startdatetime']; ?>" style="border: none" />
                  <input type="datetime-local" id="startdatetime" name="startdatetime" value=""></td>
                </tr>
                   <tr>
                <td>End DateTime</td>
                <td><input type="text" id="enddatetime1" name="enddatetime1" value="<?php echo $row['enddatetime']; ?>" style="border: none" />
                  <input type="datetime-local" id="enddatetime" name="enddatetime"></td>
                </tr>
                <tr>
                 <td>
                </td>
                <td>
                
                <button type="submit" id="cbtformupdate">Update</button>
                </td>
                <td>
                
                </td>
                </tr>
                    
              </table>
              </form>
  			</div>
			<?php } 
        }
      }
      //end cbtsetup check ?>
          </div>
          <!-- end 1st tab-->
          

      
      		 
			<?php
				$cbtsetupid="";
				$_SESSION['sql']=$sql;
          $query_qQues="SELECT * FROM quiz_setup s  WHERE s.levelid='$levelid' and s.optionid='$optionid' and  s.semesterid='$semesterid' and s.sessionid='$sessionid' and s.courseid='$courseid'";
              $stmt1 = $mysqli->prepare($query_qQues);
              $stmt1->execute();
              $numrecord1=$stmt1->rowCount();

              while($row1=$stmt1->fetch()){ 
                $cbtsetupid=$row1['qid'];
              }
              
              $_SESSION['cbtsetupid']=$cbtsetupid;
                $k = 0
            ?>
            
            <?php 
				//Record Total Number  
				/* echo 'particular id' . */ $cbtsetupid;

         $quizquestion=$SHteacher->allteacheredit('quiz_question', 'quiz_setup_id', $cbtsetupid);
                         
				/* echo "Total Num row" .*/ $get_total_rows = count($quizquestion);
				/*echo "item per page1" . */
				//breaking total records into pages
				/*echo "Total Num pages" . */ $pages = ceil($get_total_rows/$item_per_page);
				
				?>
        <?php if($page1==1) { ?>
        <!-- open 2st tab-->
        <div id="cbtQsetup" class="tab-pane addform" style="width:90%; margin-left:auto; margin-right:auto;">
            
              <span id="<?php  echo $numrecord1; ?>"  class="num_qQues" style="display:none"><?php echo $numrecord1; ?></span>
              <span id="<?php echo $cbtsetupid; ?>"  class="cbtsetupid" style="display:none"> <?php echo $cbtsetupid; ?></span>
              <span id="<?php echo $classinfo; ?>" class="classinfo" style="display:none"> <?php echo $classinfo; ?></span>
            
          
            		<h5>Please Add Up CBT Questions</h5>
                    <div style="width:80%; margin-left:auto; margin-right:auto;">
                     <table class="table table-striped table-bordered example">
                    <tr height="23" onMouseOut="this.style.backgroundColor='';" >
                   <td colspan="5"  align="center" style="color:#F00;">CBT Question for<?php echo $semestername; echo " ";?>Term of <?php echo " ". $sessionname; ?> </td>
                    </tr>	
                   </table>
                 
                   </div>
                   <div class="glyphicon-info-sign info" id="qusdis1" <?php if($sql==""){?> style="display:none;" <?php } ?>> <?php echo $sql; ?></div>
                      <div id="addcbtquestfirst"  style="width:0%; margin-left:auto; margin-right:auto; border:2px #060 solid;">
        				 
                      <form method="post" name="cbtadd" enctype="multipart/form-data">
                      <div id="cbtadd">
                      
                      </div>
                      </form>
                      
          				</div>
            
          
            <div id="viewquesdis"  style=" color:#0C0; font-weight:bold"></div>
            	<div class="glyphicon-info-sign info" id="qusdis" <?php if($sql==""){?> style="display:none" <?php }?>><?php echo $sql;?> </div>
                 
                <div class="table" id="addcbtquest" style="display:none; width:70%; border:1px solid #060; margin-right:auto; margin-left:auto; padding:2%"> 
                 <form method="post" name="cbtaddsecond" id="cbtaddsecond" enctype="multipart/form-data" onSubmit="return callCrudAction('add','',$('.num_qQues').attr('id'), $('.cbtsetupid').attr('id'), $('.classinfo').attr('id'), $('#questfirst').val(), $('#option1first').val(), $('#option2first').val(), $('#option3first').val(), $('#option4first').val(), $('#trueansfirst').val());">
                <table class="table table-responsive">
                  <input type="text" style="border-radius:4px;" name="staffid"  id="staffid" value="<?php echo $staffid ?>" hidden="hidden">
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
                  <td><input class="form-control" style=" background-color:#060; border-color:#060; color:#FFF; border-radius:4px;" type="submit"  onClick="" name="submit" value="Add" ></td>
                  <td><input class="form-control" style="background-color:#060; border-color:#060; color:#FFF; border-radius:4px;" type="reset" name="cancel" value="Cancel" onClick="$('#addcbtquestfirst').hide(); $('#addcbtquest').hide(); $('#cbtquesview').show(); $('#cbtquesview').load('cbtquesretrival.php?refno=<?php echo $staffid; ?>&cbtsetupid=<?php echo $cbtsetupid; ?>'); $('.paging_link').show(); "></td>
                </tr>
              </table>
              </form>
                </div>
               
                
                <div id="cbtquesview" class="table cbtquesview"> 
                <!-- Retrival of CBT Question-->

                  <div style=" height:auto; text-align:left; margin-top:10px; margin-left:auto; margin-right:auto" class="table" >
             
               <table border="1" style="width:80%; margin-left:auto; margin-right:auto; border-color:#060" class="table table-responsive">
                <tr  align="center"><td colspan="7"><b style="font-family:tahoma">CBT Questions View</b></td></tr>
                <tr  align="center"><th rowspan="2">Questions</th><th colspan="5">Options</th><th>Setting</th></tr>
                <tr align="center"><th>A</th><th>B</th><th>C</th><th>D</th><th>Answer</th><th>Action</th></tr>
                
        <?php
        if(isset($_POST["page"])?$_POST["page"]:false){
        $page_number = (filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH));
        if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
          }else{
            $page_number = 1;
          }

        $position = (($page_number-1) * $item_per_page);
        $query_qQues="SELECT * FROM quiz_question s INNER JOIN quiz_setup c ON s.quiz_setup_id = c.qid WHERE s.quiz_setup_id='$cbtsetupid' ORDER BY quiz_ques_id DESC LIMIT $position, $item_per_page";


        
              $stmt1 = $mysqli->prepare($query_qQues);
              $stmt1->execute();
              $numrecord1=$stmt1->rowCount();
              if ($numrecord1>0) {
           
              while($row1=$stmt1->fetch()){ 
                $q_idt = trim($row1['quiz_ques_id']);
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
                <tr><td style="width:20%;"><?php if($dlink!=""){?><img class="img img-responsive" style="width:20%; float:left" src="../schoolhelp/uploads/cbtquesimage/<?php echo $dlink; ?>"/><?php }?>&nbsp;&nbsp;&nbsp;<?php echo $qst; ?></td><td><?php echo $ans1; ?></td><td><?php echo $ans2; ?></td><td><?php echo $ans3; ?></td><td><?php echo $ans4; ?></td><td align="center"><?php echo $tr1; ?></td><td><table style="width:100%"><tr><td><input style="width:100%; height:30px; background-color:#060; border-color:#060; color:#FFF " type="submit" onClick="pratical('edit','<?php echo $q_idt; ?>','<?php echo $dlink; ?>','<?php echo $qst; ?>','<?php echo $ans1; ?>','<?php echo $ans2; ?>','<?php echo $ans3; ?>','<?php echo $ans4; ?>','<?php echo $ts; ?>');" name="submit" value="Edit"/></td><td><span id="dlinkdel" style="display:none"><?php echo $dlink; ?></span><input style="width:100%; height:30px; background-color:#060; border-color:#060; color:#FFF " type="submit" onClick="callCrudAction('delete', '<?php echo $q_idt; ?>','','','','','','','','','');" name="submit" value="Delete"/></td></tr></table></td></tr>
                
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

				        <!-- Close retrival of CBT Question-->
            	</div>
               <div class="paging_link" style="display:none;"></div>
                
           		
            <div id="editcbtquest" class="table editcbtquest" style=" width:80%; display:none; margin-bottom:5%; margin-left:auto; margin-right:auto; border:2px #060 solid;"> 
           
            <span id="cbtid"></span>
            <!--<form class="login-form" name="cbtqueseditsaveform"  id="cbtqueseditsaveform">-->
                <!--relevent Details--> 
				<style>
      	  .invalid{border:#FF0000 1px solid;}
        	.ui-tooltip {padding:10px; color:#333; font-size: 12px; background:#FFACAC;}
			  </style>
            <form  name="cbtupdate" id="cbtupdate" enctype="multipart/form-data" onSubmit="return callCrudAction('update','',$('.num_qQues').attr('id'), $('.cbtsetupid').attr('id'), $('.classinfo').attr('id'), $('#questfirst').val(), $('#option1first').val(), $('#option2first').val(), $('#option3first').val(), $('#option4first').val(), $('#trueansfirst').val());">
                <table class="table table-responsive" >
                <input  style="border-radius:4px;" name="staffid"  id="staffid" value="<?php echo $staffid ?>" hidden="hidden">
                <input  style="border-radius:4px;" name="dlink"  id="dlink" value="" hidden="hidden">
                <input  style="border-radius:4px;" name="cbtquesid"  id="cbtquesid" value="" hidden="hidden">
                <tr>
                    <td ><strong> Question Image</strong></td>
                    
                    <td><input class="form-control" type="file" id="fileInput" name="fileInput" onChange="checkupload($('#cbtupdate #fileInput').val(),'2');"/></td>
                </tr>
               <tr>
                    <td  ><strong> Enter Question </strong></td>
                    
                    <td><textarea class="form-control" style="border-radius:4px;" name="questfirst"  id="questfirst" required></textarea></td>
                </tr>
                <tr>
                  <td ><strong>Enter Answer A</strong></td>
                 
                  <td><input type="text"  class="form-control" style="border-radius:4px;" name="option1first"  id="option1first" required ></td>
                </tr>
                <tr>
                  <td ><strong>Enter Answer B </strong></td>
                  
                  <td><input type="text" class="form-control" style="border-radius:4px;"  name="option2first"  id="option2first" required ></td>
                </tr>
                <tr>
                  <td ><strong>Enter Answer C</strong></td>
                 
                  <td><input type="text" class="form-control" style="border-radius:4px;" name="option3first"  id="option3first" required ></td>
                </tr>
                <tr>
                  <td><strong>Enter Answer D</strong></td>
                  
                  <td><input type="text" class="form-control" style=" border-radius:4px;" name="option4first"  id="option4first" required ></td>
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
                  <td><input class="form-control" style="background-color:#060; border-color:#060; color:#FFF; border-radius:4px;" type="submit" onClick="" name="submit" value="Update" ></td>
                  <td><input class="form-control" style=" background-color:#060; border-color:#060; color:#FFF; border-radius:4px;" type="reset" name="cancel" value="View Questions" onClick="$('#editcbtquest').hide(); $('#cbtquesview').show('fast'); $('#cbtquesview').load('cbtquesretrival?refno=<?php echo $staffid; ?>&cbtsetupid=<?php echo $cbtsetupid; ?>'); $('.paging_link').show();  " ></td>
                </tr>
              </table>
             </form>
   				 <!--End of Details-->
              <!--</form>-->
              </div>
			
      <?php } // These closes the page1 ?>
          </div>
            <!-- end 2st tab-->
            
            </div>
            
			</div>
			
        </div>   
        
        
 <?php include("footernew.php");?>
 
  <!-- Validation-->
    <script type="text/javascript">
	  
			
				//alert(<?php //echo $pages; ?>)
	//$("#results").load("get_records.php");  //initial page1 number to load
	$(".paging_link").bootpag({
	   total: <?php echo $pages; ?>
	}).on("page", function(e, num){
		e.preventDefault();
		//$("#results").prepend('<div class="loading"><img src="ajax-loader.gif" /> Loading...</div>');
		$("#cbtquesview").load('cbtquesretrival.php?refno=<?php echo $staffid; ?>&cbtsetupid=<?php echo $cbtsetupid; ?>', {'page1':num});
		$(".paging_link").show();
	});



 
      // Retriving Add form Dialogue Box
	
	 $("#toclick").click(function(){
		$("#cbtquesview").load('cbtquesretrival.php?refno=<?php echo $staffid; ?>&cbtsetupid=<?php echo $cbtsetupid; ?>');
		$(".paging_link").show();
         $("#cbtadd").load('questionadd.php?refno=<?php echo $staffid; ?>&cbtsetupid=<?php echo $cbtsetupid; ?>');		 
     });

       
	
	//  End of Retriving Add form Dialogue Box
	   
	
	$("#cbtedit").click(function(e) {
        $("#cbtview").fadeOut("fast", $("#cbtview").hide());
		$("#cbteditform").fadeIn("fast");
    });
	
		function checkcbt(){
			
			if((document.cbtsaveform.totaltime.value == "")||($.isNumeric(document.cbtsaveform.totaltime.value))){
			alert ("Please enter Total Time");
			document.cbtsaveform.totaltime.focus();
			return false;
			}
			
			if((document.cbtsaveform.passmark.value == "")||(!$.isNumeric(document.cbtsaveform.passmark.value))) {
			alert ("Please enter Passmark");
			document.cbtsaveform.passmark.focus();
			return false;
			}
			
			if((document.cbtsaveform.noquestion.value == "")||(!$.isNumeric(document.cbtsaveform.noquestion.value))) {
			alert ("Please enter no of questions to be answered by student");
			document.cbtsaveform.noquestion.focus();
			return false
			}
			
			if((document.cbtsaveform.totalscore.value == "")||(!$.isNumeric(document.cbtsaveform.totalscore.value))) {
			alert ("Please enter Total Score");
			document.cbtsaveform.totalscore.focus();
			return false
			}
			
		}
		
		function checkcbtedit(){
			if(document.cbtedit.totaltimeedit.value == "") {
			alert ("Please Enter Total Time")
			document.cbtedit.totaltimeedit.focus();
			return false
			}
			
			
			if((document.cbtedit.noquestionedit.value == "")||(!$.isNumeric(document.cbtedit.noquestionedit.value))) {
			alert ("Please Enter no of questions to be answered by student" )
			document.cbtedit.noquestionedit.focus();
			return false
			}
			
			if((document.cbtedit.passmarkedit.value == "")||(!$.isNumeric(document.cbtedit.passmarkedit.value))) {
			alert ("Please Enter passmark")
			document.cbtedit.passmarkedit.focus();
			return false
			}
			
			if((document.cbtedit.totalscoreedit.value == "")||(!$.isNumeric(document.cbtedit.totalscoreedit.value))) {
			alert ("Please Enter Total Score")
			document.cbtedit.totalscoreedit.focus();
			return false
			}
			
		}
		
		
		$("#cbtformupdate").click(function(e) {
		
		var action=1; // Updating CBT Setup
	 	var qid = $(".qid").attr("id");
		var groupid = $(".groupid").attr("id");
		var teacherid = $(".teacherid").attr("id");
		var totaltime = $("#totaltime").val();
		var passmark = $("#passmark").val();
		var noquestion = $("#noquestion").val();
		var totalscore = $("#totalscore").val();
		
	  queryString = 'action='+action+'&qid='+qid+'&groupid='+groupid+'&teacherid='+teacherid+
	  '&totaltime='+totaltime+'&passmark='+passmark+'&noquestion='+noquestion+'&totalscore='+totalscore;

	jQuery.ajax({
	url: "cbt_js.php",
	data:queryString,
	type: "POST",
	beforeSend: function () {
                    $("#loaderIcon").addClass('.img1');
                },
	success:function(data){$("#dis").append(data);
	},
	complete: function () {
                   $("#loaderIcon").removeClass('.img1');
                },
				error:function (){$("#loaderIcon").removeClass('.img1');}
	/* Update Record  */
});
});


/* Select data to be updated */
	
	function pratical(action,cbtid,dlink,qst,ans1,ans2,ans3,ans4,ts){
	
	
	$("#editcbtquest").show();
	$("#cbtquesview").hide();
	$(".paging_link").hide();
	
	$(".editcbtquest #cbtid").text(cbtid);
	$("#editcbtquest #dlink").text(dlink);
  $(".editcbtquest #cbtquesid").val(cbtid);
  $("#editcbtquest #dlink").val(dlink);
	$("#editcbtquest #questfirst").val(qst);
	$("#editcbtquest #option1first").val(ans1);
	$("#editcbtquest #option2first").val(ans2);
	$("#editcbtquest #option3first").val(ans3);
	$("#editcbtquest #option4first").val(ans4);
	$("#editcbtquest #trueansfirst").val(ts);
	
	
	}
	
	function checkupload(fieldvalue, par){
		
		
		
		 var extension = fieldvalue.replace(/^.*\./, '');
		 if (extension == fieldvalue) {
            extension = '';
			alert("empty extension");
        } else {
            // if there is an extension, we convert to lower case
            // (N.B. this conversion will not effect the value of the extension
            // on the file upload.)
            extension = extension.toLowerCase();
        }

        switch (extension) {
            case 'ico': 
            case 'gif': 
            case 'jpeg':
			case 'jpg':
			case 'png':
			return true;
		default:
		
			alert('Please upload an image file having the following format \n jpg",".jpeg",".JPEG",".JPG",".PNG",".png",".ico",".ICO",".GIF",".gif"');
			
			if(par==1){
				$("#fileInput").val("");
		$("#fileInput").replaceWith($("#fileInput")=$("#fileInput").clone(true));
			}else{
		$("#cbtupdate #fileInput").val("");
		$("#cbtupdate #fileInput").replaceWith($("#cbtupdate #fileInput")=$("#cbtupdate #fileInput").clone(true));
		}
                // Cancel the form submission
		
		}
	}
/* Validate Question Upload */
	function callCrudAction(action, id, minor, cbtsetupid, classinfo, questfirst, option1first, option2first, option3first, option4first, trueansfirst){
		
		var queryString;
		var valid;	
		
		valid = validatecbtquest(action, minor, questfirst, option1first, option2first, option3first, option4first, trueansfirst); // pass 		action to the validation function
		
		if(valid) { //Checking Whether Validation is true
    
		switch(action) { //Case Statement to check the right action
		case "add":		// To add

		var form = $('#cbtaddsecond')[0];

		// Create an FormData object
        var datat = new FormData(form);
		  datat.append('action',action);
		  datat.append('cbtsetupid',cbtsetupid);
	
		
		
		break;
		
		case "update":
		var form = $('#cbtupdate')[0];
		 var datat = new FormData(form);
		  datat.append('action',action);
		  datat.append('cbtsetupid',cbtsetupid);
		  datat.append('id',id);
		   datat.append('dlink',$('#cbtupdate #dlink').text());
		  
		
		break;
		
		case "delete":
		
		 var datat = new FormData();
		 datat.append('action',action);
		  datat.append('cbtsetupid',cbtsetupid);
		  datat.append('id',id);
		   datat.append('dlink',$('#dlinkdel').text());
		
		break;
		}	 
		 
		//$("#addcbtquestfirst").text(queryString)
		jQuery.ajax({url: "crud_action.php", data:datat, type: "POST",
		beforeSend: function () {
                    $("#loaderIcon").addClass('.img1');
                },
				processData: false,  // tell jQuery not to process the data
       contentType: false,  // tell jQuery not to set contentType
		success: function(data){
		switch(action) {
		case "add":
		
		
		$("#addcbtquest").hide();
		//alert(data);
		$("#viewquesdis").text(data);
		$("#cbtquesview").show();
		$("#cbtquesview").load("cbtquesretrival?refno=<?php echo $staffid; ?>&cbtsetupid=<?php echo $cbtsetupid; ?>");
		$(".paging_link").show();  
		
		break;
		
		case "update":
			
		
		$("#editcbtquest").hide();
		$("#cbtquesview").show();
		$("#cbtquesview").load('cbtquesretrival?refno=<?php echo $staffid; ?>&cbtsetupid=<?php echo $cbtsetupid; ?>'); 
		$(".paging_link").show();  
		$("#viewquesdis").text(data);
		$("#cbtupdate #fileInput").val("");
		$("#cbtupdate #fileInput").replaceWith($("#cbtupdate #fileInput")=$("#cbtupdate #fileInput").clone(true));
		
		break;
		
		case "delete":
		$("#editcbtquest").hide();
		$("#cbtquesview").show();
		$("#cbtquesview").load('cbtquesretrival?refno=<?php echo $staffid; ?>&cbtsetupid=<?php echo $cbtsetupid; ?>'); 
		$(".paging_link").show();  
		$("#viewquesdis").text(data);
		
		$("#cbtupdate #fileInput").val("");
		$("#cbtupdate #fileInput").replaceWith($("#cbtupdate #fileInput")=$("#cbtupdate #fileInput").clone(true));
		}
		$("#txtmessage").val();
		
		//$("#loaderIcon").hide();
		},
		
		complete: function () {
                   $("#loaderIcon").removeClass('.img1');
                },
		error:function (){alert("Not success");$("#loaderIcon").removeClass('.img1');}
	});
	return false
	}// Closing of if statement Checking validation
	}// Closing of function


	function validatecbtquest(action, minor, questfirst, option1first, option2first, option3first, option4first, trueansfirst) {
		
    var valid = true;
	
	switch(action){ // Check the particular forms to Update
	
	case "add":
	
	if(minor==0){
		
	$("#addcbtquestfirst textarea[required=true], #addcbtquestfirst select[required=true], #addcbtquestfirst input[required=true]").each(function(){
		$(this).removeClass('invalid');
		$(this).attr('title','');
		if(!$(this).val()){ 
			$(this).addClass('invalid');
			$(this).attr('title','This field is required');
			valid = false;
		}
		
		//if($(this).attr("type")=="email" && !$(this).val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)){
		//	$(this).addClass('invalid');
		//	$(this).attr('title','Enter valid email');
		//	valid = false;
		//}  
	}); 
	
	document.cbtadd.action="onlinetest?page1=3&refno=<?php echo $staffid; ?>&tcid=<?php echo $classinfo?>&cbtsetupid=<?php echo $cbtsetupid;?>"+'&questfirst='+ questfirst + '&option1first='+option1first+'&option2first='+option2first+'&option3first='+option3first+'&option4first='+option4first+'&trueansfirst='+trueansfirst;
	document.cbtadd.method = "post";
	document.cbtadd.submit() ;	
	//return valid;
	}// Closing of If Statement
	
	if(minor=>1){
	$("#addcbtquest input[required=true], #addcbtquest textarea[required=true], #addcbtquest select[required=true]").each	(function(){
		$(this).removeClass('invalid');
		$(this).attr('title','');
		if(!$(this).val()){ 
			$(this).addClass('invalid');
			$(this).attr('title','This field is required');
			valid = false;
		}
		//if($(this).attr("type")=="email" && !$(this).val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)){
		//	$(this).addClass('invalid');
		//	$(this).attr('title','Enter valid email');
		//	valid = false;
		//}  
	}); 
	return valid;
	}// Closing of If Statement
	
	break;
	
	case "update":
	
	$("#editcbtquest input[required=true], #editcbtquest textarea[required=true], #editcbtquest select[required=true]").each(function(){
		$(this).removeClass('invalid');
		$(this).attr('title','');
		if(!$(this).val()){ 
			$(this).addClass('invalid');
			$(this).attr('title','This field is required');
			valid = false;
		}
		//if($(this).attr("type")=="email" && !$(this).val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)){
		//	$(this).addClass('invalid');
		//	$(this).attr('title','Enter valid email');
		//	valid = false;
		//} 
		 
	}); 
	return valid;
	break;
	
	/*case "edit":
	$("#quesediteform input[required=true], #queseditform textarea[required=true]").each(function(){
		$(this).removeClass('invalid');
		$(this).attr('title','');
		if(!$(this).val()){ 
			$(this).addClass('invalid');
			$(this).attr('title','This field is required');
			valid = false;
		}
		
	}); 
	return valid;
	break; */
	
	case "delete":
	
	return valid;
	break;
	
	
	}
	
 }

  $(function() {
    $( document ).tooltip({
		position: {my: "left top", at: "right top"},
	  items: "input[required=true], textarea[required=true], select[required=true]",
      content: function() { return $(this).attr( "title" ); }
    });
  });
  
 $('.timepicker').timepicker({
    timeFormat: 'HH:mm:ss',
    interval: 15,
    minTime: '00',
    maxTime: '2:00',
    defaultTime: '00:15',
    startTime: '00:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
    
	</script>