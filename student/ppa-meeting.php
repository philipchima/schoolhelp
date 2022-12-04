<?php include("headernew.php");?>
<?php require_once("includes/session.php"); ?>
<?php confirm_logged_in(); ?>
<?php 
include_once "includes/connection.php";
include_once "classes.php";
include_once "includes/students_oop.php";
$pg=(isset($_GET['pg'])? $_GET['pg']:false);
$refno= (isset($_GET['refno'])? $_GET['refno']:false);
$stid =$_SESSION['stid'.$refno];
$groupid=studentRecord::st_func($stid, "groupid");
$classid=studentRecord::st_func($stid, "classid");
$schid=Studentclass::classtable_func($classid, "schoolid");
$current_termid=About_term_name::curterm_name("termid");
$current_session=About_school_name::cursess_name("sessid");
date_default_timezone_set('Africa/Lagos');
?>

    
<div id="page-wrapper">

            <div class="container-fluid">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Hi!</strong> <span style="font:20px Corbel bold; color:#060; "><?php echo studentRecord::st_func($stid, "fullname")." "; ?> </span><span style="color:#060;">; Class:<span style="color:#FEA318;"><?php echo studentRecord::st_func($stid, "class") ." " ; ?>;</span> Group:<span style="color:#FEA318;"><?php echo studentRecord::st_func($stid, "group") ." " ; ?></span> <span style="font:20px Corbel  bold; color:#F00; ">; <?php About_term_name::curterm_name("termname"); echo " ";?>Term of <?php About_School_name::cursess_name("sessname");?></span> </span>
                        </div>
                    </div>
                </div>
   <div class="row">
                    <div class="col-lg-11.8 col-xs-11.8 col-sm-11.8 col-md-11.8" style=" margin:0% 2% 2%; background:#FFF; padding:1%; ">
                        <h1 class="page-header" style="margin-top:4px; color:#063;">PTA Meeting<small></small></h1>
     
       
             
           <div class="row">
                <div class="col-lg-12 " >
                	
                    <table class="table">
						<?php
							$select_content=("select * from ppa order by pid desc limit 10");
							$content_result= mysqli_query($mysqli, $select_content) or die (mysqli_error($mysqli));
							$content = mysqli_fetch_assoc($content_result);
							$num_chk = mysqli_num_rows ($content_result);
							$k = 0
						?>
						<?php
                        if ($num_chk == 0)
                            {
                        ?>
                            <tr height="23" onMouseOver="this.style.backgroundColor='#FFCC66';" onMouseOut="this.style.backgroundColor='';" bgcolor="#EFEFEF">
                                <td colspan="<?php echo $l ?>"  align="center">No Record Found</td>
                            </tr>	
                        <?php
                        	}
                        else
                        	{
                        ?>
                    		<thead>
								<tr>
									<th colspan="2"> Download Past PTA - MEETING</th>
                                 </tr>
                            </thead>
                            <tbody>
                                  <?php
								
								    do { 
                                        ?>
                                           <tr> 
                                           <td width="100px">
                                                <?php echo $content["sdate"]; ?>			
                                           </td>
                                           <td>
                                               <a href="../backend/uploads/ppamaterials/<?php  echo ($content ['dlink'])?>" class="link" target="_blank" > <?php
                                                 echo $content["topic"];
                                                 ?>	</a>			
                                           </td>
                                           
                                           </tr>
                                        <?php
                                    } while ($content5 = mysqli_fetch_assoc($content_result5));
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
    
