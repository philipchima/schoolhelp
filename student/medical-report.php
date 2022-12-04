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
                        <h1 class="page-header" style="margin-top:4px; color:#063;">Medical-report<small></small></h1>
     
       
             
            <div class="row">
                <div class="col-lg-12 table" >
  
    
      <!--############################################################################ -->
                	
                    <table class="table table-responsive">
					  <?php
						
            $k = 0;
            $records=$SHstudent->allstudentedit('medicaltreatment', 'medicaltreatmentid', $stid);
            						
						if (!is_array($records)) {
						?>
								  <tr height="23" onMouseOver="this.style.backgroundColor='#FFCC66';" onMouseOut="this.style.backgroundColor='';" bgcolor="#EFEFEF">
									   <td   align="center" style="font-size:18px; color:#F00;"> <span class="glyphicon glyphicon-info-sign" style="color:#F00"></span>No Record of Sickness Traced</td>
								  </tr>	
						<?php
						}
												
						else
						{
						?>
                        
                        <thead>
                          <tr>
                              <th>S/N</th>
                              <th>Date</th>
                              <th>Diagnosis</th>
                              <th></th>
                          </tr>
                          </thead>
                          <tbody>
                        
						<?php foreach($records as $fieldrecord){
						$color = "#f5f5f5";
						$x < $num_chk;
						$x=$x+1;
						
						if($x%2 == 0)
						{
						$color = "#ffffff";
						}
						
						$k = $k + 1;
						?>
                          <tr bgcolor="<?php echo $color ?>" height="23" onMouseOver="this.style.backgroundColor='#FFCC66';" onMouseOut="this.style.backgroundColor='';">
                             <td > <?php echo $k  ?> </td>
                  <td > <?php  echo ucfirst($content['xdate'])?>  </td>
                  <td ><?php  echo ucfirst($content['diagnosis'])?>	 </td>
                 
                  <td class="show" >
                          <font face="verdana" style="font-size: 11px; color:#000000">
         				
                        <a onClick="emailwindow=dhtmlmodal.open('EmailBox', 'iframe', 'viewHealth.php?orderID=<?php echo $content['id']?>', '', 'width=900px,height=550px,center=1,resize=0,scrolling=1'); return false" style="color:#FF0000" href="#"><img border="0" src="../img/search.gif" /></a>
                     </font>
                  </td>
              </tr>
			<?php }  ?>
			<?php 
				}
			?>
			</tbody>
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
    
