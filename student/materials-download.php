<?php include("headernew.php");

date_default_timezone_set('Africa/Lagos');
$page=trim(isset($_GET['page'])? $_GET['page']:false);
$refno= trim(isset($_GET['refno'])? $_GET['refno']:false);
$stid =trim(isset($_SESSION['stid'.$refno])?$_SESSION['stid'.$refno]:false);
?>

    
<div id="page-wrapper">

            <div class="container-fluid">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Hi!</strong> <span style="font:20px Corbel bold; color:#060; "><?php echo $fullname." "; ?> </span><span style="color:#060;">; Class:<span style="color:#FEA318;"><?php echo $levelname ." " ; ?>;</span> Group:<span style="color:#FEA318;"><?php echo $optionname ." " ; ?></span> <span style="font:20px Corbel  bold; color:#F00; ">; <?php echo $semestername; echo " ";?>Term of <?php echo $sessionname; ?></span> </span>
                        </div>
                    </div>
                
                </div>
   <div class="row">
                    <div class="col-lg-11.8 col-xs-11.8 col-sm-11.8 col-md-11.8" style=" margin:0% 2% 2%; background:#FFF; padding:1%; ">
                        <h1 class="page-header" style="margin-top:4px; color:#063;">Subject Material<small></small></h1>
     
       
             
             <div class="row">
                <div class="table col-lg-12 table" >
                	
                    <table class="table table-responsive">
						<?php
               $teacherquestion=$SHstudent->studentedit4order('coursematerials',  'levelid', $levelid, 'optionid', $optionid, 'semesterid', $semesterid, 'sessionid', $sessionid, 'odate', 'DESC');
               
            if (!is_array($teacherquestion)) {
                
            ?> 
                       
                            <tr height="23" onMouseOver="this.style.backgroundColor='#FFCC66';" onMouseOut="this.style.backgroundColor='';" bgcolor="#EFEFEF">
                                 <td   align="center" style="font-size:18px; color:#F00;"> <span class="glyphicon glyphicon-info-sign" style="color:#F00"></span>Subject Material not Uploaded yet<br> Please contact the Class Teacher</td>
                            </tr>	
                        <?php
                        	}
                        else
                        	{
                                
                        ?>
                    		<thead>
								<tr>
                                <th>Subject/Course</th>
                                <th>Details</th>
									<th>Date</th>
                                    <th>Download Materials</th>
                                 </tr>
                            </thead>
                            <tbody style="font-size:16px; color:#060">
                                  <?php
								foreach($teacherquestion as $teacherquestionrec){
                                    $courseid="";
                                    $courseid=trim($teacherquestionrec['courseid']);
								    $csname="";
                                            $teacherscourse=$SHstudent->allstudentedit('course','csid', $courseid);
                                                if (is_array($teacherscourse)) {
                                                    foreach($teacherscourse as $teacherscourserec){
                                                        $csname=$teacherscourserec['csname'];
                                                        
                                                  }
                                              }
                                        ?>
                                           <tr> 
                                           <td><?php echo $csname; ?></td>
                                            <td><?php echo $teacherquestionrec["description"]; ?></td>
                                             <td>
                                              <?php
                                                 echo $teacherquestionrec["odate"];
                                                 ?>				
                                           </td>
                                           <td>
                                               <a class="embed" href="../schoolhelp/uploads/coursematerials/<?php echo $teacherquestionrec['dlink']; ?>" class="link" target="_blank" > <?php
                                                 echo "Download / View";
                                                 ?>	</a>			
                                           </td>
                                           
                                           </tr>
                                        <?php
                                    } 
									?>
                                    
								
								
								</tbody>
                         </tbody>
                         <?php 
						 }
                         ?>
                    </table>
                </div>
             </div>      
                       
        <!--/row-->
        </div>
      
                      
                </div>
                 
				 
                </div>
               
                
                <!-- /.row -->

                

        </div>
 <?php include("footernew.php");?>
    
