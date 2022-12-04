<?php require_once("connection.php"); ?>
<style style="text/css">
.lcdstyle{ /*Example CSS to create LCD countdown look*/
color:#FFFFFF;
font: 20px Arial Black;
padding: 3px;
}

.lcdstyle sup{ /*Example CSS to create LCD countdown look*/
font-size: 60%
}
</style>

<script type="text/javascript">
function cdtime(container, targetdate){
if (!document.getElementById || !document.getElementById(container)) return
this.container=document.getElementById(container)
this.currentTime=new Date()
this.targetdate=new Date(targetdate)
this.timesup=false
this.updateTime()
}

cdtime.prototype.updateTime=function(){
var thisobj=this
this.currentTime.setSeconds(this.currentTime.getSeconds()+1)
setTimeout(function(){thisobj.updateTime()}, 1000) //update time every second
}

cdtime.prototype.displaycountdown=function(baseunit, functionref){
this.baseunit=baseunit
this.formatresults=functionref
this.showresults()
}

cdtime.prototype.showresults=function(){
var thisobj=this

var timediff=(this.targetdate-this.currentTime)/1000 //difference btw target date and current date, in seconds
if (timediff<0){ //if time is up
this.timesup=true
this.container.innerHTML=this.formatresults()
return
}
var oneMinute=60 //minute unit in seconds
var oneHour=60*60 //hour unit in seconds
var oneDay=60*60*24 //day unit in seconds
var dayfield=Math.floor(timediff/oneDay)
var hourfield=Math.floor((timediff-dayfield*oneDay)/oneHour)
var minutefield=Math.floor((timediff-dayfield*oneDay-hourfield*oneHour)/oneMinute)
var secondfield=Math.floor((timediff-dayfield*oneDay-hourfield*oneHour-minutefield*oneMinute))
if (this.baseunit=="hours"){ //if base unit is hours, set "hourfield" to be topmost level
hourfield=dayfield*24+hourfield
dayfield="n/a"
}
else if (this.baseunit=="minutes"){ //if base unit is minutes, set "minutefield" to be topmost level
minutefield=dayfield*24*60+hourfield*60+minutefield
dayfield=hourfield="n/a"
}
else if (this.baseunit=="seconds"){ //if base unit is seconds, set "secondfield" to be topmost level
var secondfield=timediff
dayfield=hourfield=minutefield="n/a"
}
this.container.innerHTML=this.formatresults(dayfield, hourfield, minutefield, secondfield)
setTimeout(function(){thisobj.showresults()}, 1000) //update results every second
}

function formatresults2(){
if (this.timesup==false){ //if target date/time not yet met
var displaystring="<span class='lcdstyle'>"+arguments[0]+" <sup>day(s)</sup> "+arguments[1]+" <sup>hour(s)</sup> "+arguments[2]+" <sup>minute(s)</sup> "+arguments[3]+" <sup>second(s)</sup></span>"
}
else{ //else if target date/time met
var displaystring="" //Don't display any text
//alert("WELCOME TO THE NIGHT OF TRANSFORMATION!") //Instead, perform a custom alert
}
return displaystring
}
</script>



        <div id="top-bar">
            <div class="fixed">
                <ul class="contact">
                    <li><i class="icon-mobile-phone"></i>+2348065758588</li>
                    <li><i class="icon-envelope"></i><a href="mailto:info@noraktech.com">info@noraktech.com</a></li>
                </ul>
                
               <ul class="login">
                    <li><a style="color:#FFFFFF" href="http://rccgchristchurch.org/webmail" target="_blank">Email</a> |</li>
					<li><a style="color:#FFFFFF" href="rccg-christ-church?&p=1&id=1h">Prayer Request</a> |</li>
					<li><a style="color:#FFFFFF" href="rccg-christ-church?p=1&id=1a">Feedback</a> |</li>
					<l><a style="color:#FFFFFF" href="rccg-christ-church?p=1&id=1a">Directions</a></li>
                </ul>
            </div>
        </div>
    
		<div id="header-container">
			<div id="header" class="wrap">
                <div id="logo-wrap">
                    <div id="logo"><a href="index.html"><img src="images/logo1.png" alt="logo" /></a> </div> 
                </div><!-- END logo --> 

<?php
$xdate = date("Y-m-d h:m:s"); 
$select_content=("select * from cms_events where startdate > '$xdate' order by startdate Asc limit 1");
$content_result= mysql_query($select_content) or die (mysql_error());
$content = mysql_fetch_assoc($content_result);
$user_rows = mysql_num_rows($content_result);
 
 
$date = $content["startdate"];
$year = date('Y', strtotime($date));
$day = date('d', strtotime($date));
$month = date('F', strtotime($date));
$monthfigure = date('m', strtotime($date));
 
 if ($user_rows != 0)
 
 	{

?>
	<div id="counter-wrapper" align="right" style="padding-right:10px;">
                    <a href="#">Upcoming event: </a>
							<br />
					<b style="color:#679B2D;font-size:12px;font-family:Arial, Helvetica, sans-serif;"> <?php echo $content["title"] ?></b>
						<div id="countdowncontainer2"></div>
							<script type="text/javascript">
							//var futuredate=new cdtime("countdowncontainer", "July 02, 2011 08:00:00")
							//futuredate.displaycountdown("days", formatresults)
							var currentyear=new Date().getFullYear()
							//dynamically get this Christmas' year value. If Christmas already passed, then year=current year+1
							 var thischristmasyear=(new Date().getMonth()>=<?php echo $monthfigure ?> && new Date().getDate()><?php echo $day ?>)? currentyear+1 : currentyear
            				 var christmas=new cdtime("countdowncontainer2", " <?php echo $month." ".$day ?>, "+thischristmasyear+" 0:11:00")
							christmas.displaycountdown("days", formatresults2)
							</script>
            </div>
<?php
	}

else

{
?>
			<div id="counter-wrapper" align="right" style="padding-right:10px;">
                   <a href="#">Upcoming event: </a>
							<br />
					<b style="color:#679B2D;font-size:12px;font-family:Arial, Helvetica, sans-serif;">None</b>
            </div>
<?php
}
?>
		<div class="clearboth"></div>
		</div><!-- END Header --> 
        
        <div id="second-menu">

    <div class="menu-container">
    <!-- Mega Menu / Start
    ================================================== -->
    <div class="menu style-3">
        <ul class="menu">
        <li><a href="index"><i class="icon-home"></i> Home</a></li>
    	<?php
			$query1  = "SELECT * FROM menu ORDER BY position ASC";
			$result1 = mysql_query($query1);
			
			while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
			{
		?>
            <li><a href="rccg-christ-church?p=1&id=<?php echo $row1['link']?>"><?php echo $row1['name']?></a>
                <ul>
                	<?php
                    	$mid = $row1['mid'];
						$query  = "SELECT * FROM submenu where parent_id='$mid' ORDER BY position ASC";
						$result = mysql_query($query);
						
						while($row = mysql_fetch_array($result, MYSQL_ASSOC))
						{
					?>
                     <li><a href="rccg-christ-church?&p=1&id=<?php echo $row['link']?>"><?php echo $row['name']?></a></li>
                     
                     <?php	}?>
                    
                </ul>
            </li>
       <?php } ?>
		
		</li>
        </ul>
    </div>
    
    <!-- Mega Menu / End
    ================================================== -->
</div>
        </div><!-- END second-menu -->
    </div><!-- END header-container -->