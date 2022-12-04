<?php include("headernew.php");?>
<?php require_once("includes/session.php"); ?>
<?php confirm_logged_in(); ?>
<?php 
include_once "includes/connection.php";
include_once "classes.php";

$refno= (isset($_GET['refno'])? $_GET['refno']:false);
$stid =$_SESSION['stid'.$refno];
$amount =0; $amountPaid =0;
$pamount=0;
$debt = 0;
$classv = (isset($_POST["class"])?$_POST["class"]:false) ;
if($classv!=""){
	$classv = (isset($_POST["class"])?$_POST["class"]:false) ;
	$term = (isset($_POST["term"])?$_POST["term"]:false) ;
	$stid = (isset($_SESSION["stid"])?$_SESSION["stid"]:false) ;
	
	$_SESSION["classv"] =(isset($_POST["class"])?$_POST["class"]:false)  ;
	$_SESSION["term"] =(isset($_POST["term"])?$_POST["term"]:false)  ;
}


$date = studentRecord::st_func($stid,"xdate");
$year = date('Y', strtotime($date));

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
                    <div class="col-lg-11.8 col-xs-11.8 col-sm-11.8 col-md-11.8" style=" margin:0% 2% 0%; background:#FFF; padding:1%; ">
                        <h1 class="page-header" style="margin-top:4px; color:#063;">Student School fees<small></small></h1>
             <div class="row">
                <div class="col-lg-12 " >
                <h3>
                	<div class="alert alert-info">
					<?php
						$select_contentf=("select * from studentaccount INNER JOIN classes ON classes.id=studentaccount.cid INNER JOIN terms ON terms.tid=studentaccount.tid where student_id = '$stid' order by studentaccount.id asc");
						$content_resultf= mysqli_query($mysqli, $select_contentf) or die (mysql_error($mysqli));
						$contentf = mysqli_fetch_assoc($content_resultf);
						$num_chkf = mysqli_num_rows ($content_resultf);
						$k = 0
						
						?>
						<?php
						if ($num_chkf == 0)
						{
								 echo "School Fee Has Not Been Announced";
						}
												
						else
						{
							do { 
								$amount += $contentf['amount'] ;
								$amountPaid += $contentf['amountPaid'];
							} while ($contentf = mysqli_fetch_assoc($content_resultf));
							$debt = $amount - $amountPaid ;
							echo "Student Debt: ". $debt ;
							 $amount =0; $amountPaid =0;
						}
					?></div>
                 </h3>
                    <table class="table">
					  <?php
						$select_content=("select * from studentspayment s INNER JOIN expensestype p ON s.mode=p.eid where student_id = '$stid' order by spid desc");
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
									  <td colspan="4" class="smallxnormal" align="left" style="padding:20px">You have not made any payment</td>
								  </tr>	
						<?php
						}
												
						else
						{
						?>
                        
                        <thead>
                          <tr style="background:#999;" >
                              <th width="5%" style="padding-left:10px">S/N</th>
                              <th width="20%">Date</th>
                              <th width="25%">Document No</th>
                              <th width="30%">Mode of Payment</th>
                              <th width="20%">Amount Paid</th>
                          </tr>
                          </thead>
                          <tbody>
                        
						<?php $x=0; do { 
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
                              <td ><?php  echo ucfirst($content['docno'])?>	 </td>
                              <td ><?php  echo $content['name']?>	 </td>
                              <td > <?php  echo $content['amount']?> </td>
                          </tr>
			<?php 
				$pamount += $content['amount'] ;
			
			} while ($content = mysqli_fetch_assoc($content_result)); ?>
			
            <tr style="font-weight:bold; font-size:18px; border-top:#036 solid 1px">
                <td colspan="4" align="left"> Total </td>
                <td ><?php echo $pamount ?> </td>
            </tr>
            
            <tr style="font-weight:bold; font-size:18px; border-top:#036 solid 1px; color:#F00">
                <td colspan="5" align="center"> Comment </td>
            </tr>
            <tr style="font-weight:bold; font-size:18px; border-top:#036 solid 1px">
                <td colspan="5" align="center"> 
                	<?php 
					//echo $amount ." ". $pamount;
					if($debt > 0){
						echo "This student is owing " . $debt ;
					}
					else{
						echo "This student is debt free ";
					}
					?>
                 </td>
            </tr>
            <?php 
				}
			?>
			</tbody>
			</table>
                </div>
             </div>   
                       
          </div>
                        
                </div>
                 
				 
                </div>
               
                
                <!-- /.row -->

                

        </div>
 <?php include("footernew.php");?>