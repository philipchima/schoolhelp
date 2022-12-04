<?php
require_once("../includes/global.php"); 
include_once("../includes/connection.php");
include_once("../phpclass/SHresultOOP.php");
include_once("../phpclass/schoolhelpothers.php");

$mysqlicon=new Dbh;
$mysqli=$mysqlicon->connect();
// include autoloader
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$SHResultOOP=new ClassResult;

	$trcount=2;
	
	$t =0;
	$departmentid="";

	$levelid =trim(isset($_SESSION["levelid"])?$_SESSION["levelid"]:false);

	$semesterid = trim(isset($_SESSION["semesterid"])?$_SESSION["semesterid"]:false);
	//$stid = $_SESSION["stid"] ;
	$sessionid =trim(isset($_SESSION["sessionid"])?$_SESSION["sessionid"]:false); 
	$optionid =trim(isset($_SESSION["optionid"])?$_SESSION["optionid"]:false); 
	$houseid="";
  $passport="";
  $studentfullname="";
  $dateofbirth="";
  $regno="";
	
	//Getting Semester Details
	$semestername="";
      $semesterdata=$SHResultOOP->allresultedit('semesters', 'semesterid', $semesterid);
       if (is_array($semesterdata)) {
          foreach($semesterdata as $semesterrec){ 
          $semestername=trim($semesterrec['semestername']); 
          }
        }
	
	$sessionname="";
    $sessiondata=$SHResultOOP->allresultedit('session', 'sessionid', $sessionid);
        if (is_array($sessiondata)) {
            foreach($sessiondata as $sessionrec){ 
            $sessionname=trim($sessionrec['sessionlow'].' / '.$sessionrec['sessionhigh']); 
           }
        }

	//Class Teachers Details
	$teacherrecord1=$SHResultOOP->allresultedit2('formteacher', 'levelid', $levelid, 'optionid', $optionid);
	if (is_array($teacherrecord1)) {
           
        foreach($teacherrecord1 as $teacherrecord){ 
		$staffid=trim($teacherrecord['staffid']);
		$teachersignature=trim($teacherrecord['signature']);

		}
	}

	//Class Teachers Name and Surname
	$staffrecord1=$SHResultOOP->allresultedit('staff', 'staffid', $staffid);
	if (is_array($teacherrecord1)) {
           
        foreach($staffrecord1 as $staffrecord){ 
		$teachersurname=$staffrecord['surname'];
		$teacherothername=$staffrecord['othername'];
		}
	}


    //Getting Level/Class Information
    //$levelname="";
    $departmentid="";
    $scoretablename="";
    $leveldata=$SHResultOOP->allresultedit('level', 'levelid', $levelid);
    if (is_array($leveldata)) {
        foreach($leveldata as $levelrec){ 
       	$levelname=trim($levelrec['levelname']); 
       	$departmentid=trim($levelrec['departmentid']); 
       	$scoretablename="score".$departmentid;
       	$resulttablename="result".$departmentid;
        }
  	}

  	//Head teacher's Information
  	$retrievedata8=$SHResultOOP->allresultedit2('signatoryposition', 'departmentid', $departmentid, 'status', '1');
			       if (is_array($retrievedata8)) { 
			        foreach($retrievedata8 as $field8){
			          $positionid=trim($field8['signatorypositionid']);
			          $positionsignature=trim($field8['signature']);
			          $signatoryid=trim($field8['staffid']);
			          $positionname=trim($field8['positionname']);
			       }
			     }

	 $optionname="";
     $optiondata=$SHResultOOP->allresultedit('optiontable', 'optid', $optionid);
     if (is_array($optiondata)) {
        foreach($optiondata as $optionrec){ 
        $optionname=trim($optionrec['optname']); 
        }
    }
	
	//Semester Starting and Ending
	 $begins="";
	 $ends="";
    $semesterends=$SHResultOOP->allresultedit2('term_start_end', 'sessionid', $sessionid, 'semesterid', $semesterid);
    if (is_array($semesterends)) {
        foreach($semesterends as $semesterend){
               $begins=trim($semesterend['begins']);
				$ends=trim($semesterend['ends']);
               }
      }

    //collecting Institution Details
     $instidata=$SHResultOOP->allresultedit('institution', 'departmentid', $departmentid);
     if (is_array($instidata)) {
     	foreach($instidata as $instirequest){ 
	
	$instilogo=trim($instirequest['instilogo']);
	$instiname=trim($instirequest['instiname']);
	$instiaddress=trim($instirequest['instiaddress']);
	$instiphone=trim($instirequest['instiphone']);
	$instiemail=trim($instirequest['instiemail']);
	$instislogan=trim($instirequest['instislogan']);
		}
	}
	
	//Result Coloring and Background
	 $resultcolors=$SHResultOOP->allresultedit('resultcolor', 'departmentid', $departmentid);
if (is_array($resultcolors)) {
    foreach($resultcolors as $resultcolor){ 
	
	$schnamecolor=trim($resultcolor['schname']);
	
	$schnameaddress=trim($resultcolor['schaddress']);
	$htitlelabel=trim($resultcolor['htitlelabel']);
	$htitle=trim($resultcolor['htitle']);
	$tableheadbgcolor=trim($resultcolor['tableheadbgcolor']);
	$tablecontentcolor1	=trim($resultcolor['tablecontentcolor1']);
	$tablecontentcolor2	=trim($resultcolor['tablecontentcolor2']);
	$resultbackground=trim($resultcolor['resultbackground']);
	}
}else{
	$schnamecolor="#060";
	
	$schnameaddress="#d2dc2a";
	$htitlelabel="#063";
	$htitle="black";
	$tableheadbgcolor="#d2dc2a";
	$tablecontentcolor1	="";
	$tablecontentcolor2	="#d2dc2a";
	$resultbackground="";
}


// set default header data

// ---------------------------------------------------------

// set default font subsetting mode
	$dompdf = new Dompdf();

$idcol=trim(isset($_GET['idcol'])?$_GET['idcol']:false);
$myArray = explode(',', $idcol);

$counting=trim(count($myArray));

$html='<html><head>
<title>'.$levelname.$optionname.'</title>
<!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<style>
.resultbody > table tbody tr td, table thead tr th{border:1px solid '.$schnamecolor.'; border-collapse:collapse; }
.heading >  th, td{border:0px }

.domain >td {border:1px solid '.$schnamecolor.'; border-collapse:collapse}

.resultbody>tr:nth-child(odd){
	background:'.$tablecontentcolor1.'
}
.resultbody>tr:nth-child(even){
	background:'.$tablecontentcolor2.'
}

</style>
</head><body style="">';


foreach($myArray as $c=>$my_Array2){
	$c+=1;
	$totalground =0;
 $averageground =0;
 $t =0;
 $stuid=trim($my_Array2) ;

//Collecting Student Record
 $studentdata=$SHResultOOP->allresultedit('students', 'stid', $stuid);
    if (is_array($studentdata)) {
        foreach($studentdata as  $studentrec){

 $surname=trim($studentrec['surname']);
 $othername=trim($studentrec['othername']);

 $studentfullname=$surname.' '.$othername;
 $sex=trim($studentrec['sexid']);
 if ($sex==2) {
 	$studentsex="Female";
 }
 else{
 	$studentsex="Male";
 }

 $houseid=trim($studentrec['housedivisionid']);
 //
 $passport=trim($studentrec['passport']);
 $dateofbirth=trim($studentrec['dateofbirth']);
 $regno=trim($studentrec['regno']);

	}
}
//Getting Student House
   $hddata=$SHResultOOP->allresultedit('housedivision', 'hdid',  $houseid);
       if(is_array($hddata)){
          foreach($hddata as $hdrecord){
               $studenthouse=$hdrecord['hdname'];                  
                 }
           }

//result comment
 //Checking Attendance Table
           $noattd="";
           $noschopen="";
        $retrievedata6=$SHResultOOP->allresultedit5('earlycmentattend', 'stid', $stuid , 'sessionid', $sessionid, 'semesterid', $semesterid, 'levelid', $levelid, 'optionid', $optionid);
         if (is_array($retrievedata6)) { 
            foreach($retrievedata6 as $field6){
            	$noattd=trim($field6['noofdaysattended']);
				$noschopen=trim($field6['noofschooldays']);
            }
        }



	if ($resultbackground==1) {
		$logoaddress="../images/logo/".$instilogo;
		$divbackground='<img src="'.$logoaddress.'" style="position:fixed; top:140; opacity:0.1;  z-index:-2; width:100%; "/>';
	}
	elseif ($resultbackground==2) {
		$increasedaddress=str_repeat($instiname, 180);
		$divbackground='<div style="color:light-grey; position:relative; z-index:-1; top:0; bottom:0; left:0; right:0; opacity:0.1; overflow:hidden;  text-align:justify;">'.$increasedaddress.'</div>';
	}else{
		$divbackground="";
	}

if($passport !=""){ 
	$pic= '../images/uploads/student/'.$passport; } else{ $pic= "../images/user.png" ;
}

if($c>$counting){
	$div='<div style="page-break-before:always;">';
}else{ $div='<div style="">'; }
$html .=$div.$divbackground.'
		<div style="width:100%" >
		<table width="100%" cellpadding="0" cellspacing="0" class="heading">
    	<tr>
        	<td colspan="3" width="100%">
				<table width="100%">
					<tr>
						<td width="20%"><img src="../images/logo/'.$instilogo.'" width="100px" height="100px"></td>
						<td width="60%" align="center" valign="top"><span style="color:'.$schnamecolor.'; font-size:1.5em; font-family: Arial Black"><b>'.strtoupper($instiname).'</b></span><br><span style="color:'.$schnameaddress.'; font-size:0.8em;"><b>'.$instiaddress.'</b></span> 
						<p><span style="font-family: Arial Black; color:'.$schnamecolor.'; font-size:0.8em;"><b>REPORT CARD</b></span><br>
						<span style="color:'.$htitlelabel.'; font-size:0.8em;" ><b>CLASS</b></span> : <span style="color:'.$htitle.'; font-size:0.8em">'.$levelname." ".$optionname  .'</span><br>
						 <span style="color:'.$htitlelabel.'; font-size:0.8em;"><b>ACADEMIC SESSION:</b> </span><span style="color:'.$htitle.'; font-size:0.8em;">'.strtoupper($semestername). ' TERM ' . $sessionname.  ' 
						</span></td>
						<td width="20%" align="right"><img src="'.$pic.'" width="100px" height="110px" style="border-radius:5px"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
            <td colspan="3">
            	<table width="100%" >
                	<tr>
                    	<td width="100%">
                        	<table width="100%">
                        	

                                <tr >
                                <td>
                                <table width="">
                                <tr><td align="left" style="color:'.$htitlelabel.'" >Student Name :</td><td align="left" style="border-bottom:2px solid black; font-size:12px; color:'.$htitle.'"><b>'. strtoupper($studentfullname) .'</b></td></tr>
                                <tr><td align="left" style="color:'.$htitlelabel.'; font-size:11px">Date of Birth:</td><td align="left" style="border-bottom:2px solid black; color:'.$htitle.'; font-size:10px"><b> '. date("l jS F, Y", strtotime($dateofbirth)).'</b></td></tr>
                                <tr><td align="left" style="color:'.$htitlelabel.'; font-size:12px;">Admission No:</td><td align="left" style="border-bottom:2px solid black; color:'.$htitle.'"><b>  '. $regno.'</b></td></tr>
								
                                	
                                </table>
                                	</td>
                                <td align="right">
                                <table width="">
                                <tr><td align="left" style="color:'.$htitlelabel.'"">Times Present:</td><td align="left" style="border-bottom:2px solid black; font-size:12px; color:'.$htitle.'"><b>'.$noattd.'</b></td></tr>
                               
                                <tr><td align="left" style="color:'.$htitlelabel.'">Times Absent:</td><td align="left" style="border-bottom:2px solid black; color:'.$htitle.'; font-size:12px;"><b>'.($noschopen - $noattd).'</b></td></td></tr>
                                

								<tr><td align="left" style="color:'.$htitlelabel.'">Active Days:</td><td align="left" style="border-bottom:2px solid black; font-size:12px; color:'.$htitle.'"><b>'.$noschopen.'</b></td></tr>
								
                                </table>  
									
                                </td>
                                 <td align="right">
                                <table width="">
                                
                                <tr><td align="left" style="color:'.$htitlelabel.'">Resumption Date:</td><td align="left" style="border-bottom:2px solid black; font-size:12px; color:'.$htitle.'"><b> '. date("l jS F, Y", strtotime($begins)).'</b></td></tr>
									
								<tr><td align="left" style="color:'.$htitlelabel.'">Term Ends:</td><td align="left" style="border-bottom:2px solid black; font-size:12px; color:'.$htitle.'"><b> '.date("l jS F, Y", strtotime($ends)).'</b></td></tr>';
								
											
												
								$html.='<tr><td align="left" style="color:'.$htitlelabel.'">Class Teacher:</td><td align="left" style="border-bottom:2px solid black; font-size:12px; color:'.$htitle.'"><b> '.$teachersurname.' '.$teacherothername.'</b></td></tr>';
								
                                $html.='</table>  
									
                                </td>
								
								</tr>
                             </table>
                         </td>
                        
                     </tr>
                </table>
            </td>
        </tr>
		</table>
		</div>';

		//Creating the result body 
		$html.='<div class="resultbody">';
					
          $ecscount="";
          $ecscountreminder="";
          $ecscountdivision="";
          $secondcolumnrec="";
          $gradetitle="";
          $gradetitle1="";
          $k=0;
          $f=0;
          $s=0;
          $earlyclassscore=$SHResultOOP->allresultedit("earlyclasscategory", "levelid",  $levelid);
          if (is_array($earlyclassscore)) {
            
          $ecscount=count($earlyclassscore);
          $ecscountreminder=$ecscount%2;
          $ecscountdivision=floor($ecscount/2);
          
          if ($ecscountreminder>0) {
            $firstcolumnrec=$ecscountdivision+$ecscountreminder;
            
            $secondcolumnrec=$ecscountdivision;
          }else{
            $firstcolumnrec=$ecscountdivision;
            $secondcolumnrec=$ecscountdivision;
          }
          $firstcolumnarray=array();
          $secondcolumnarray=array();
          $firstcolumnarray1=array();
          $secondcolumnarray1=array();
          $gradearray=array();

            $gradearray["id"]="";
            $gradearray["name"]="";
            $gradearray["des"]="";

          //Collecting record from early class category table with an array variable
          foreach($earlyclassscore as $earlyclassrecord){
            $k+=1;
            $earlycatid=trim($earlyclassrecord["earlycatid"]);
            if ($k<=$firstcolumnrec) {
              $f+=1;
              if (!isset($firstcolumnarray["earlycatid".$f])) {
                $firstcolumnarray["earlycatid".$f]="";
              }
              $firstcolumnarray["earlycatid".$f]=$earlyclassrecord["earlycatid"];
              if (!isset($firstcolumnarray["earlycatname".$f])) {
                $firstcolumnarray['earlycatname'.$f]="";
              }
              $firstcolumnarray['earlycatname'.$f]=$earlyclassrecord['earlycatname'];
            }

             if ($k>$firstcolumnrec) {
              $s+=1;
               if (!isset($secondcolumnarray['earlycatid'.$s])) {
                $secondcolumnarray['earlycatid'.$s]="";
              }
              $secondcolumnarray['earlycatid'.$s]=$earlyclassrecord['earlycatid'];
              if (!isset($secondcolumnarray['earlycatname'.$s])) {
                $secondcolumnarray['earlycatname'.$s]="";
              }
              $secondcolumnarray['earlycatname'.$s]=$earlyclassrecord['earlycatname'];

             
            }

          }

           //Collecting record from early class grade table with an array variable
           $earlygradedata=$SHResultOOP->allresultedit('earlygrade', 'levelid', $levelid);
              if (is_array($earlygradedata)) {
                $l=0;
                foreach($earlygradedata as $key1 => $earlygraderec){
                $l+=1;
                  $gradearray['id'.$l]=trim($earlygraderec['earlygradeid']); 
                  if (!isset($gradearray['name'.$l])) {
                   $gradearray['name'.$l]="";
                  }
                    $gradearray['name'.$l]=trim($earlygraderec['gradename']);
                  $gradearray['des'.$l]=trim($earlygraderec['description']);

              }
            }
          
          $html.='<table  style="width:100%; " cellspacing="0px" cellpadding="0px" >
            
              <tr>
                <td valign="top">
                  <table class="table table-responsive table-striped"  cellspacing="0px" cellpadding="0px" style="font-family: Arial">';
                    if (is_array($firstcolumnarray)) { 
                      $fss=0;
                     
                      
                      for($u=1; $u<=$firstcolumnrec; $u++) { //this loop through the stored category in an array
                      $fss+=1;
                       $retrievecatid=trim($firstcolumnarray['earlycatid'.$fss]);
                       
                    $html.='<tr style="margin:0px">';
                     if ($gradetitle=="") {
                      $html.='<td style="margin:0px; width:70% ; background:'.$schnamecolor.'; color:white"><b>'.$firstcolumnarray["earlycatname".$fss].'</b></td>';
                        }else{
                           $html.='<td style="margin:0px; width:70% ; color:'.$schnamecolor.'; "><b>'.$firstcolumnarray["earlycatname".$fss].'</b></td>';
                         }
                      
                      if (is_array($gradearray)) { 
                        
                        for ($c=1; $c<=$l; $c++) {
                          
                          if ($gradetitle=="") { 
                            $html.='<td style="margin:0px; width:10%; background:'.$tableheadbgcolor.'; color:'.$htitle.';" align="center"><b>'.$gradearray["name".$c].'</b></td>';
                               }else{
                             
                            $html.='<td style="margin:0px; width:10%; " align="center"></td>';
                            
                                 }
                               }
                              
                      } 
                    
                    $html.='</tr>';
              //Collecting record from early class grade table with an array variable
              $earlycatsubdata=$SHResultOOP->allresultedit('earlycatsub', 'earlyclasscatid', $retrievecatid);
              if (is_array($earlycatsubdata)) {
                foreach($earlycatsubdata as $key3 => $earlycatsubrec){
                  $markgradeid="";
                  $earlyscoreid="";
                  $earlycatsubid=trim($earlycatsubrec['earlycatsubid']);
              //checking whether this result has been marked
              $earlyscoredata=$SHResultOOP->allresultedit6('earlyclassscore', 'earlycatsubid', $earlycatsubrec['earlycatsubid'], 'stid', $stuid, 'sessionid', $sessionid, 'semesterid', $semesterid, 'levelid', $levelid, 'optionid', $optionid);
              if (is_array($earlyscoredata)) {
                foreach($earlyscoredata as $key4 => $earlyscorerec){
                  $markgradeid=trim($earlyscorerec['gradeid']);
                  $earlyscoreid=trim($earlyscorerec['earlyscoreid']);
                }
              }
                

              $html.='<tr style="margin:0px; width:70%">
                      <td style="margin:0px">'.$earlycatsubrec["subcatname"].'</td>';
                       //Placing the Grade Names
                      if (is_array($gradearray)) { 
                        $keygrade="";
                         for ($d=1; $d<=$l; $d++) { 
                          $keygrade+=1;
                         $actualgradeid=trim($gradearray['id'.$d]);
                          
                          $html.='<td style="margin:0px; width:10%">';
                           if ($actualgradeid==$markgradeid){
                          $html.='<center><i class="fa fa-check" style="color:'.$tableheadbgcolor.'"></i></center>';
                      		}
                      $html.='</td>'; 
     
                            } 
                      } 
                    $html.='</tr>';
	                 
                    $gradetitle=1;
                      } //earlycategory loop end
                     } 
                 }
             }
                  $html.='</table>
                </td>
                <td valign="top">
                  <table class="table table-responsive table-striped"  cellspacing="0px" cellpadding="0px" style="font-family: Arial">';
                    if (is_array($secondcolumnarray)) { 
                      $fss=0;
                      $actualgradeid="";
                      
                      for($u=1; $u<=$secondcolumnrec; $u++) { //this loop through the stored category in an array
                      $fss+=1;
                       $retrievecatid=trim($secondcolumnarray['earlycatid'.$fss]);
                    
                    $html.='<tr style="margin:0px">';
                       if ($gradetitle1=="") {
                      $html.='<td style="margin:0px; width:70% ; background:'.$schnamecolor.'; color:white"><b>'.$secondcolumnarray["earlycatname".$fss].'</b></td>';
                        }else{
                           $html.='<td style="margin:0px; width:70% ; color:'.$schnamecolor.'; "><b>'.$secondcolumnarray["earlycatname".$fss].'</b></td>';
                         }
                      //Placing the Grade Names
                      if (is_array($gradearray)) { 

                        for ($c=1; $c<=$l; $c++) {
                          
                           
                          if ($gradetitle1=="") { 
                            $html.='<td style="margin:0px; width:10%; background:'.$tableheadbgcolor.'; color:'.$htitle.';" align="center"><b>'.$gradearray["name".$c].'</b></td>';
                               }else{
                             
                            $html.='<td style="margin:0px; width:10%; " align="center"></td>';
                            
                                 }
                               }   
                      } 
                    
                    $html.='</tr>';
              //Collecting record from early class grade table with an array variable
              $earlycatsubdata=$SHResultOOP->allresultedit('earlycatsub', 'earlyclasscatid', $retrievecatid);
              if (is_array($earlycatsubdata)) {
                foreach($earlycatsubdata as $key3 => $earlycatsubrec){
                   $markgradeid="";
                  $earlyscoreid="";
                  $earlycatsubid=trim($earlycatsubrec['earlycatsubid']);
              //checking whether this result has been marked
              $earlyscoredata=$SHResultOOP->allresultedit6('earlyclassscore', 'earlycatsubid', $earlycatsubrec['earlycatsubid'], 'stid', $stuid, 'sessionid', $sessionid, 'semesterid', $semesterid, 'levelid', $levelid, 'optionid', $optionid);
              if (is_array($earlyscoredata)) {
                foreach($earlyscoredata as $key4 => $earlyscorerec){
                   $markgradeid=trim($earlyscorerec['gradeid']);
                  $earlyscoreid=trim($earlyscorerec['earlyscoreid']);
                }
              }
                 
					$html.='<tr style="margin:0px; width:70%">
                      <td style="margin:0px">'.$earlycatsubrec["subcatname"].'</td>';
                       //Placing the Grade Names
                      if (is_array($gradearray)) { 
                        $keygrade="";
                         for ($d=1; $d<=$l; $d++) { 
                          $keygrade+=1;
                         $actualgradeid=trim($gradearray['id'.$d]);
                         
                         $html.='<td style="margin:0px; width:10%">';
                           if ($actualgradeid==$markgradeid){
                          $html.='<center><i class="fa fa-check" style="color:'.$tableheadbgcolor.'"></i></center>';
                      		}
                      $html.='</td>'; 
                            
                               }   
                      }

                    $html.='</tr>';
                  }
              } 
                    $gradetitle1=1;
                      } //earlycategory loop end
                     } 

                  $html.='</table>';
                  
              $earlycattendid="";
              $comment="";
              $headcomment="";
              $noofschooldays="";
              $noofdaysattended="";

              $earlycmentattend=$SHResultOOP->allresultedit5('earlycmentattend', 'stid', $stuid , 'sessionid', $sessionid, 'semesterid', $semesterid, 'levelid', $levelid, 'optionid', $optionid);
              if (is_array($earlycmentattend)) {
                foreach($earlycmentattend as $key6 => $earlycmentattendrec){
                 $earlycattendid=trim($earlycmentattendrec['earlycattendid']);
                 $comment=trim($earlycmentattendrec['comment']);
                 $headcomment=trim($earlycmentattendrec['headcomment']);
                 $noofschooldays=trim($earlycmentattendrec['noofschooldays']);
                 $noofdaysattended=trim($earlycmentattendrec['noofdaysattended']);
                }
              }

                  $html.='<table class="table table-responsive" style="width:100%"  cellspacing="0px" cellpadding="0px">';
                  $html.='<tr>
                      <td style="background:'.$tableheadbgcolor.'; color:'.$htitle.'; width:30%"><b>General Comment:</b></td><td style="width:70%">'.$comment.'</td>
                  </tr>
                  <tr>
                      <td style="background:'.$tableheadbgcolor.'; color:'.$htitle.'; width:30%"><b>Head Teacher`s Comment:</b></td><td style="width:70%">'.$headcomment.'</td>
                  </tr>
                  </table>
                  <table style="width:100%" cellspacing="0px" cellpadding="0px">
                   <tr>
                      <td ><b>Progress Code:</b><br>';
                        for ($c=1; $c<=$l; $c++) {
                          $html.='<table  style="margin-bottom:0px; border-collapse:collapse; width:100%" cellspacing="0px" cellpadding="0px">
                            <tr style="margin-bottom:0px; ">
                            <td style="width: 50%;" align="right" ><b>'.$gradearray["name".$c].'</b></td> 
                            <td style="width: 50%;" ><b>'.$gradearray["des".$c].'</b></td>
                            </tr>
                          </table>';
                            
                           }
                           
                       $html.='<table style="width:100%" cellspacing="0px" cellpadding="0px">
                       	<tr>
                       		<td align="center" width="50%">';
							   if(file_exists("../images/signatures/signatoryposition/".$positionsignature)){ 
							   		$sign="../images/signatures/signatoryposition/".$positionsignature;
									$html .='<img align="center" src="'.$sign.'" style="width:60px; height:30px" />';
								}
								else{

									  $rstcomrecords1=$SHResultOOP->allresultedit('staff', 'staffid', $signatoryid);
		                               if (is_array($rstcomrecords1)) {
		                                  foreach($rstcomrecords1 as $rstcomrecord1){
		                                  $surname=trim($rstcomrecord1['surname']);  
		                                  $othername=trim($rstcomrecord1['othername']);                             
		                                 }

		                               }
									
									 $html .='<span>'.$surname. " ".$othername;
								}
								   $html .='<br align="center">-------------------------------<br><span style="font:14px Arial Black">'.strtoupper($positionname);
							      
							 $html.='</span></td>
                       	</tr>
                       </table>
                       </td>
                  </tr>
                </table></td></tr>
          </table>';

            } else{ $html.='<div>Result Category not found: has not be Upoaded</div>';
      }
             
                    
		$html.='</div></div>';
		$counting--;
	
} 
echo $html.='</body></html>';

//$dompdf->loadHtml($html);
//$dompdf->set_option('isHtml5ParserEnabled', true);
//$dompdf->render();
//$dompdf->stream("SchoolHelp",array("Attachment"=>0));
