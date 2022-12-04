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
//use Dompdf\Dompdf;

// instantiate and use the dompdf class
$SHResultOOP=new ClassResult;

	$trcount=2;
	$totalscore=0;
	$t =0;
	$departmentid="";

	$levelid =trim(isset($_SESSION["levelid"])?$_SESSION["levelid"]:false) ;

	$semesterid = trim(isset($_SESSION["semesterid"])?$_SESSION["semesterid"]:false) ;
	//$stid = $_SESSION["stid"] ;
	$sessionid =trim(isset($_SESSION["sessionid"])?$_SESSION["sessionid"]:false) ; 
	$optionid =trim(isset($_SESSION["optionid"])?$_SESSION["optionid"]:false) ; 
	
	
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

	// Activate or De-activate Singular|Accumulate Terms Result Score
    $resultstatus="";
    $activationrecords=$SHResultOOP->allresultedit('resultactivations', 'titlename', 'Singular Result');
    if (is_array($activationrecords)) {
        foreach($activationrecords as $activationrecord){
               $resultstatus=trim($activationrecord['status']); 
               }
      }

    if ($resultstatus==1) {
		//when single result is set do this to select position in resultposition table based on singular term average
		$posaverage='average';
	}else{
		//when single result is set do this to select position in resultposition table based on accumulalated term average
		$posaverage='accaverage';
	}

     // Show student position in the result
    $resultpositionstatus="";
    $activationrecords1=$SHResultOOP->allresultedit('resultactivations', 'titlename', 'Singular Result');
    if (is_array($activationrecords1)) {
        foreach($activationrecords1 as $activationrecord1){
               $resultpositionstatus=trim($activationrecord1['status']); 
               }
      }

	// Show student position in the result
    $resultpositiongrade="";
    $activationrecords2=$SHResultOOP->allresultedit('resultactivations', 'titlename', 'Use Grade As Position');
    if (is_array($activationrecords2)) {
        foreach($activationrecords2 as $activationrecord2){
               $resultpositiongrade=trim($activationrecord2['status']); 
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

$positiontblname=trim("positionresult".$departmentid);
	//Getting Option/Group/Arm Information
	 //$optionname="";
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
	//$dompdf = new Dompdf();

$idcol=trim(isset($_GET['idcol'])?$_GET['idcol']:false);
$myArray = explode(',', $idcol);

$counting=trim(count($myArray));

$html='<html><head>
<title>'.$levelname.$optionname.'</title>
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

							$posi1=0;
                            $p="";
                            $studentave="";
                            $i=0;
                            $posi="";
                           
                          //checks of equal average
                          $equalave="";
                          $realcomment="";

                            $records1=$SHResultOOP->allposi4sort($positiontblname, $levelid, $optionid, $sessionid, $semesterid, $posaverage, 'DESC');
                            //Getting Number of student in the class
                            $num_chkpg=count($records1);
                              if(is_array($records1)) {
                              
                              foreach($records1 as $fieldrecord1){
                                $studentave=$fieldrecord1[$posaverage];
                                  $posi1 +=1;
                              
                              $p=0;
                            //checking whether an average is not empty
                             $posi=$posi1;
                             
                             //checking 4 tally average, so to calculate position very well
                                if ($studentave==$equalave) {
                                  $p=1;
                                  $posi-=$p;
                                }
	   

		$posav2=trim($fieldrecord1[$posaverage]);
		$floorposav2=floor($posav2);

		$hodcommentid="";
		$hodcommentid="";

		//Comments 
		$principlec="";
		$teachersc="";

		if($fieldrecord1["stid"] == $stuid){

		//collection of information from result table
		
		$stid=trim($fieldrecord1['stid']);
		$hodcommentid=trim($fieldrecord1['hodcommentid']);
		$dircommentid=trim($fieldrecord1['dircommentid']);
		$realcomment=trim($fieldrecord1['comment']);
		$rid =trim($fieldrecord1['positionid']);

		if ($realcomment=="") {
				//Getting Class Teachers Details
	 		$records2=$SHResultOOP->allresultedit('commentsetup', 'resultcommentid', $hodcommentid);
	        if (is_array($records2)) {
	            foreach($records2 as $fieldrecord2){
	            	$teachersc=trim($fieldrecord2['comment']);
	            }
	        }
		}else{
			$teachersc=$realcomment;
		}

		

        //Getting Class Teachers Details
 		$records3=$SHResultOOP->allresultedit('commentsetup', 'resultcommentid', $dircommentid);
        if (is_array($records3)) {
            foreach($records3 as $fieldrecord3){
            	$principlec=trim($fieldrecord3['comment']);
            }
        }
		

			if ($resultpositiongrade==1) {
			$grade1=$SHResultOOP->grade('grade', $departmentid, $floorposav2);
			$remark1=$SHResultOOP->grade('remark', $departmentid, $floorposav2);
			$positioninggrade=$grade1." "."( $remark1 )";
			}
			break;
		}
		$equalave=$studentave;
	}
}

$abbreviation=Others::ordinalize($posi);
$overAllScore = 0; $cnt =0;  $max_mark =0;


//result comment
 //Checking Attendance Table
        $retrievedata6=$SHResultOOP->allresultedit('attendancemark', 'positionresultid', $rid);
         if (is_array($retrievedata6)) { 
            foreach($retrievedata6 as $field6){
            	$noattd=trim($field6['stuattendance']);
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
								if ($resultpositionstatus==1) {
											if ($resultpositiongrade==1) {
												
												$html.='<tr><td align="left" style="color:'.$htitlelabel.'">Position:</td><td align="left" style="border-bottom:2px solid black; font-size:12px; color:'.$htitle.'"><b> '.$positioninggrade.'</b></td></tr>';
											} else{
											$html.='<tr><td align="left" style="color:'.$htitlelabel.'">Position:</td><td align="left" style="border-bottom:2px solid black; font-size:12px; color:'.$htitle.'"><b> '. $abbreviation.' out of '.$num_chkpg.'</b></td></tr>';
											}
								} else{
								$html.='<tr><td></td></tr>';
								}
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
		$html.='<div class="resultbody">
		
		<table style="width:100%; opacity:0.9" cellspacing="0px" cellpadding="0px">
		

		<thead bgcolor="'.$tableheadbgcolor.'"  style="font-family: Arial ; font-size:10px; color:'.$htitlelabel.'">
		 <tr >
    <th style="font-family: Arial Black; font-size:14px">SUBJECTS</th>';

     $contentass1=$SHResultOOP->allresultedit('assessment', 'departmentid', $departmentid);
	
	$asscount=array();

    //Header 4 1st term result
    if ($semesterid==1) {
   
	 //if ($num_chkass >0) {	
	 if (is_array($contentass1)) {
     foreach($contentass1 as $contentass){
     	$asscount[]=$contentass["assid"];
    	$html.='<th  style="text-align:center; width:auto"><span class="vertical" >'.$contentass['assname'].' ('.$contentass['asspercent'].'%)'.'</span></th>';
     }

 	}
   
		
		$html.= '<th style="text-align:center; width:auto"><span class="vertical" >1ST TERM TOTAL</span></th>';
    }
    //Header 4 2nd term result
     if ($semesterid==2) {
     	 $html.= '<th style="text-align:center; width:auto;"><span class="vertical" >1ST TERM TOTAL</span></th>';
    
	if (is_array($contentass1)) {
     foreach($contentass1 as $contentass){
     	$asscount[]=$contentass["assid"];
    	$html.='<th  style="text-align:center; width:auto"><span class="vertical" >'.$contentass['assname'].'('.$contentass['asspercent'].'%)'.'</span></th>';
     }

 	}
	
		$html.= '<th style="text-align:center; width:auto;"><span class="vertical" >2ND TERM TOTAL</span></th>';
    }

    //Header 4 3rd term result
    if ($semesterid==3) {

     	 $html.= '<th style="text-align:center; width:auto;"><span class="vertical" >1ST TERM TOTAL</span></th>';
     	 $html.= '<th style="text-align:center; width:auto;"><span class="vertical" >2ND TERM TOTAL</span></th>';
  
	//$num_chkass = mysqli_num_rows ($content_resultass);
	if (is_array($contentass1)) {
     foreach($contentass1 as $contentass){
     	$asscount[]=$contentass["assid"];
    	$html.='<th  style="text-align:center; width:auto"><span class="vertical" >'.$contentass['assname'].'('.$contentass['asspercent'].'%)'.'</span></th>';
     }

 	}
		$html.= '<th style="text-align:center; width:5%;"><span class="vertical" >3RD TERM TOTAL</span></th>';
    }


   $html.= '<th style="text-align:center; width:auto; font-size:8px"><span class="vertical" >CUMMULATIVE'; if ($semesterid==1) {  $html.=' (100%)'; }
   	if ($semesterid==2) { 
   		if ($resultstatus==1) { $html.=' (100%)';
   	} else { $html.='(200%)'; } 
   } 
   if ($semesterid==3) { 
   	if ($resultstatus==1) { 
   		$html.=' (100%)'; 
   	} 
   	else { $html.=' (300%)'; }
   } $html.='</span></th>
    <th  style="text-align:center; width:auto; "><span class="vertical" >GRADE</span></th>
    <th  style="text-align:center; width:auto"><span class="vertical" >STUD. AVERAGE</span></th>
    <th  style="text-align:center; width:auto"><span class="vertical" >HIGHEST. AVERAGE</span></th>
    <th  style="text-align:center; width:auto"><span class="vertical" >CLASS AVERAGE</span></th>
    <th  style="text-align:center; width:auto">Remark</th>
 		 </tr>
 		 <thead>
 		 <tbody  class="resultbody" style="text-align:center">';
 		   $content1=$SHResultOOP->allresultedit('course', 'departmentid', $departmentid);

 		 //$select_content=("select * from subjects where class ='$departmentid'");
				//$content_result= mysqli_query($mysqli, $select_content) or die (mysqli_error($mysqli));
				//$content = mysqli_fetch_assoc($content_result);
				//$num_chk = mysqli_num_rows ($content_result);
				$k = 0;
				$cnt = 0;
				
				if (!is_array($content1)) {
   
                     echo  "No Subject Found";
					  
                }
                    else{
                    	 $subjectidarray=array();
                    	 $accscore4allstuallsub1="";
                    	 $accresultsubjectscoreterm1="";
                        $accresultsubjectscoreterm2="";
                        $stualltermoverallcumu="";
                        $studavescore="";
                        $acchighestsubjtermavescore="";

                    	   foreach($content1 as $content){
                    	 //do{

                    	 	$subjectid = trim($content["csid"]);
						 //This helps to check whether a student have score in a particular subjeect in any of the terms
                        $subjecttodisplay=$SHResultOOP->subtable($sessionid, $semesterid, $stuid, $levelid, $subjectid, $scoretablename, $resultstatus);

                        $subtermsassscore="";
                        $subjtermtotalscore="";
                        $resultsubjectscore="";
                        $resultsubjectscore1="";
                        $accsubjectscore4asubjinterms="";
                        $accsubjscore4allstuterm1="";
						$accsubjscore4allstucurterm="";
						$accsubjscore4allstu="";
						$studentsubjtermavescore="";
						$highestsubjtermavescore="";
						
                        // accumulated score 4 all subject and student
                        
                        if ($subjecttodisplay==1) {

                        	$html.='<tr><td style="text-align:left; font-size:12px; font-weight:bold; font-family: Arial ; ">'.$content ["csname"].'</td>';
                        	if ($semesterid==1) {
                        		
                        		$divide=1;
                        	}

                        	if ($semesterid==2) {
                        		//Checking whether singular result is enabled
                        		
                        		if ($resultstatus==1) {
                        			$divide=1;
                        		}else{$divide=2;}

                        		//Getting Cumulative of subjects 4 1st term when it is second term
                        		$rstsubjscoredata=$SHResultOOP->stusubjecttotalscore($resulttablename, $stuid, $subjectid, $levelid, $optionid,  '1', $sessionid);

                        		
                        		if (is_array($rstsubjscoredata)) {
                        		foreach ($rstsubjscoredata as $rstsubjscorerec) {
                        			$resultsubjectscore=trim($rstsubjscorerec['score']);
                        		}
                        		}
                        		
                        		
                        		$accresultsubjectscoreterm1+=$resultsubjectscore;
                        		$html.='<td>'.$resultsubjectscore.'</td>';
                        	
                        		 }


                        	if ($semesterid==3) {
                        		//Checking whether singular result is enabled
                        		
                        		if ($resultstatus==1) {
                        			$divide=1;
                        		}else{$divide=3;}
                        		
                        		
                        		//Getting Cumulative of subjects  4 1st term when it is 3rd term
                        		$rstsubjscoredata=$SHResultOOP->stusubjecttotalscore($resulttablename, $stuid, $subjectid, $levelid, $optionid,  '1', $sessionid);

                        		
                        		if (is_array($rstsubjscoredata)) {
                        		foreach ($rstsubjscoredata as $rstsubjscorerec) {
                        			$resultsubjectscore=trim($rstsubjscorerec['score']);
                        		}
                        		}

                        		$accresultsubjectscoreterm1+=$resultsubjectscore;

                        		//Getting Cumulative of subjects 4 2nd term when it is 3rd term
                        		$rstsubjscoredata1=$SHResultOOP->stusubjecttotalscore($resulttablename, $stuid, $subjectid, $levelid, $optionid,  '2', $sessionid);
                        		
                        		if (is_array($rstsubjscoredata1)) {
                        		foreach ($rstsubjscoredata1 as $rstsubjscorerec1) {
                        			$resultsubjectscore1=trim($rstsubjscorerec1['score']);
                        		}
                        		}
                        		
                        		$accresultsubjectscoreterm2+=$resultsubjectscore1;
                        		$html.='<td>'.$resultsubjectscore.'</td>';
                        		$html.='<td>'.$resultsubjectscore1.'</td>';
                        		 }
                        		
                        		$subjectidarray[]=$subjectid;
                        		foreach($asscount as $z => $asscounter){
                        			//subject term assessment score

                        		$asssubjscoredata=$SHResultOOP->assessmentscores($scoretablename, $stuid, $subjectid, $levelid, $optionid, $semesterid, $sessionid, $asscounter);
                        		                        		
                        		if (is_array($asssubjscoredata)) {
                        		foreach ($asssubjscoredata as $asssubjscorerec) {
                        			$subtermsassscore=trim($asssubjscorerec['score']);
                        		}
                        		}
                        			//subject term total score
                        			$subjtermtotalscore+=$subtermsassscore;

                        		$html.='<td>'.$subtermsassscore.'</td>';

                        	}

                        

                        	// accumulated subject score 4 1ST term
                        	if ($semesterid==1) {

                        		//Getting total subjects score for all the student in a subject and also getting the highest score in that subject
                        		$subjscoredata=$SHResultOOP->subjecttotalscore($resulttablename, $subjectid, $levelid, $optionid, $semesterid, $sessionid);
                        		
                        		if (is_array($subjscoredata)) {
                        			$q="";
                        			$totalscoreq="";
                        		foreach ($subjscoredata as $subjscorerec) {
                        			
					           			$q+=1;
										$totalscoreq+=$subjscorerec['score'];
										if (trim($subjscorerec['score'])>$highestsubjtermavescore) {
											$highestsubjtermavescore=trim($subjscorerec['score']);
										}
									
                        		}
                        		$accsubjscore4allstu=round($totalscoreq/$q, 1);
                        	}

                        	
                        	$studentsubjtermavescore+=$subjtermtotalscore;
                        	$accsubjectscore4asubjinterms+=$subjtermtotalscore;
                        	$studavescore+=$studentsubjtermavescore;

                        	$acchighestsubjtermavescore+=$highestsubjtermavescore;
                        	}
                        	
                       		if ($semesterid==2) {
                       			if ($resultstatus==1) {
                       				$accsubjectscore4asubjinterms=$subjtermtotalscore;

                        		//Getting total subjects score for all the student in a subject and also getting the highest score in that subject
                        		$subjscoredata=$SHResultOOP->subjecttotalscore($resulttablename, $subjectid, $levelid, $optionid, $semesterid, $sessionid);
                        		
                        		if (is_array($subjscoredata)) {
                        			$q="";
                        			$totalscoreq="";
                        		foreach ($subjscoredata as $subjscorerec) {
                        			
					           			$q+=1;
										$totalscoreq+=$subjscorerec['score'];
										if (trim($subjscorerec['score'])>$highestsubjtermavescore) {
											$highestsubjtermavescore=trim($subjscorerec['score']);
										}
									
                        				}
		                        		$accsubjscore4allstu=round($totalscoreq/$q, 1);
		                        	}

                       				$studentsubjtermavescore=$subjtermtotalscore;
                       				$studavescore+=$studentsubjtermavescore;
                       				
                        			$acchighestsubjtermavescore+=$highestsubjtermavescore;
                       			}else{ 
                       				//rertrival of first term subject class average score

                        		$subjscoredata=$SHResultOOP->subjecttotalscore($resulttablename, $subjectid, $levelid, $optionid, '1', $sessionid);
                        		
                        		if (is_array($subjscoredata)) {
                        			$q="";
                        			$totalscoreq="";
                        		foreach ($subjscoredata as $subjscorerec) {
                        			
					           			$q+=1;
										$totalscoreq+=$subjscorerec['score'];
																			
		                        	}
		                        		$accsubjscore4allstuterm1=round($totalscoreq/$q, 1);
		                        }

                       				

	                       			//rertrival of second term subject class average score
			                        $subjscoredata1=$SHResultOOP->subjecttotalscore($resulttablename, $subjectid, $levelid, $optionid, $semesterid, $sessionid);
	                        		$q1="";
	                        		
	                        			$totalscoreq1="";
	                        		if (is_array($subjscoredata1)) {
	                        			
	                        		foreach ($subjscoredata1 as $subjscorerec1) {
	                        			
						           			$q1+=1;
											$totalscoreq1+=trim($subjscorerec1['score']);
											if (trim($subjscorerec1['cumulative'])>$highestsubjtermavescore) {
												$highestsubjtermavescore=trim($subjscorerec1['score']);
											}
										
			                        	}

			                        		$accsubjscore4allstucurterm=round($totalscoreq1/$q1, 1);
			                        }

                       				//Accumulation 4 a subject class average score
                       				$accsubjscore4allstu=($accsubjscore4allstuterm1+$accsubjscore4allstucurterm)/$divide;
                       				$accsubjectscore4asubjinterms=$resultsubjectscore+$subjtermtotalscore; 
                       				$studentsubjtermavescore=$accsubjectscore4asubjinterms/$divide;
                       				$studavescore+=$studentsubjtermavescore;
                       				
                       				$highestsubjtermavescore=trim($highestsubjtermavescore)/$divide;
                        			$acchighestsubjtermavescore+=$highestsubjtermavescore;

                       			}

                       				
                       		}

                       		if ($semesterid==3) {
                       			if ($resultstatus==1) {
                       				$accsubjectscore4asubjinterms=$subjtermtotalscore;

                       				$subjscoredata=$SHResultOOP->subjecttotalscore($resulttablename, $subjectid, $levelid, $optionid, $semesterid, $sessionid);
                        		
                        		if (is_array($subjscoredata)) {
                        			$q="";
                        			$totalscoreq="";
                        		foreach ($subjscoredata as $subjscorerec) {
                        			
					           			$q+=1;
										$totalscoreq+=$subjscorerec['score'];
										if (trim($subjscorerec['score'])>$highestsubjtermavescore) {
											$highestsubjtermavescore=trim($subjscorerec['score']);
										}
									
                        				}
		                        		$accsubjscore4allstu=round($totalscoreq/$q, 1);
		                        	}

                       				$studentsubjtermavescore=$subjtermtotalscore;
                       				$studavescore+=$studentsubjtermavescore;
                       				
                        			$acchighestsubjtermavescore+=$highestsubjtermavescore;

                       			}else{ 
                       				//rertrival of first term subject class average score
                       				$subjscoredata1=$SHResultOOP->subjecttotalscore($resulttablename, $subjectid, $levelid, $optionid, '1', $sessionid);
                        		
                        		if (is_array($subjscoredata1)) {
                        			$q1="";
                        			$totalscoreq1="";
                        		foreach ($subjscoredata1 as $subjscorerec1) {
                        			
					           			$q1+=1;
										$totalscoreq1+=$subjscorerec1['score'];
																			
		                        	}
		                        		$accsubjscore4allstuterm1=round($totalscoreq1/$q1, 1);
		                        }

                       				//rertrival of second term subject class average score
                       				$subjscoredata1=$SHResultOOP->subjecttotalscore($resulttablename, $subjectid, $levelid, $optionid, '2', $sessionid);
                        		
                        		if (is_array($subjscoredata2)) {
                        			$q2="";
                        			$totalscoreq2="";
                        		foreach ($subjscoredata2 as $subjscorerec2) {
                        			
					           			$q2+=1;
										$totalscoreq2+=$subjscorerec2['score'];
																			
		                        	}
		                        		$accsubjscore4allstuterm2=round($totalscoreq2/$q2, 1);
		                        }

                       				//rertrival of second term subject class average score
		                         $subjscoredata1=$SHResultOOP->subjecttotalscore($resulttablename, $subjectid, $levelid, $optionid, $semesterid, $sessionid);
	                        		
	                        		if (is_array($subjscoredata1)) {
	                        			$q1="";
	                        			$totalscoreq1="";
	                        		foreach ($subjscoredata1 as $subjscorerec1) {
	                        			
						           			$q+=1;
											$totalscoreq1+=$subjscorerec1['score'];
											if (trim($subjscorerec1['cummulative'])>$highestsubjtermavescore) {
												$highestsubjtermavescore=trim($subjscorerec1['score']);
											}
										
			                        	}
			                        		$accsubjscore4allstucurterm=round($totalscoreq1/$q1, 1);
			                        }

                       				
                       				//Accumulation 4 a subject class average score
                       				$accsubjscore4allstu=($accsubjscore4allstuterm1+$accsubjscore4allstucurterm+$accsubjscore4allstuterm2)/$divide;
                       				$accsubjectscore4asubjinterms=$resultsubjectscore+$resultsubjectscore1+$subjtermtotalscore; 
                       				$studentsubjtermavescore=$accsubjectscore4asubjinterms/$divide;
                       				$studavescore+=$studentsubjtermavescore;
                       				
                       				$highestsubjtermavescore=$highestsubjtermavescore/$divide;

                        			$acchighestsubjtermavescore+=$highestsubjtermavescore;
                        			
                       			}

                       				
                       		}

                        	$highestsubjtermavescore=round($highestsubjtermavescore,1);
                        	$studentsubjtermavescore=round($studentsubjtermavescore,1);	
                        	
                        	$accsubjscore4allstu=round($accsubjscore4allstu, 1);
                        	
                        	$html.='<td >'.$subjtermtotalscore.'</td>';
                        	$html.='<td>'.$accsubjectscore4asubjinterms.'</td>';
                        	$subjtermtotalscore=trim(round($subjtermtotalscore));
                        	$remark=$SHResultOOP->grade('remark', $departmentid, $studentsubjtermavescore);
                        	$grade=$SHResultOOP->grade('grade', $departmentid, $studentsubjtermavescore);
                        	$html.='<td>'.$grade.'</td>';
                        	$html.='<td>'.$studentsubjtermavescore.'</td>';
                        	$html.='<td>'.$highestsubjtermavescore.'</td>'; //Highest student in that subject
                        	$html.='<td>'.$accsubjscore4allstu.'</td>';
                        	$html.='<td style="font-size:12px; font-weight:bold; font-family: Arial ; ">'.$remark.'</td>';
                        	

                        	$stualltermoverallcumu+=$accsubjectscore4asubjinterms;
                        	$accscore4allstuallsub1+=$accsubjscore4allstu;

                        $html.='</tr>';
                        		
                        }

                    }


                    	 //} while($content = mysqli_fetch_assoc($content_result));
                    		$empty="\t";
                    	 
                    	 	$html.='<tr>'; if ($semesterid==2) { $html.='<td>'.$empty.'</td>'; } if ($semesterid==3) { $html.='<td></td><td></td>'; } $html.='<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
                    	 	$html.='<tr>'; if ($semesterid==2) { $html.='<td> </td>'; } if ($semesterid==3) { $html.='<td>&nbsp</td><td>&nbsp</td>'; } $html.='<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
                    	 	$html.='<tr>'; if ($semesterid==2) { $html.='<td></td>'; } if ($semesterid==3) { $html.='<td></td><td>&nbsp</td>'; } $html.='<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
                    	 	$html.='<tr><td style="font-size:11px; font-weight:bold; font-family: Arial ; ">CUMULATIVE</td>';

                    	 	if ($semesterid==2) {
                    	 		//The columns Displays the cumulative of first term
                    	 			$html.='<td>'.$accresultsubjectscoreterm1.'</td>';
                    	 		}
                    	 		if ($semesterid==3) {
                    	 			//The two columns Displays the cumulative of second term
                    	 			$html.='<td>'.$accresultsubjectscoreterm1.'</td>';
                    	 			$html.='<td>'.$accresultsubjectscoreterm2.'</td>';
                    	 		}
                    	 	$subtermsassscore="";
                    	 	$accasssubjtotalscore="";
                    	 	$supaccasssubjtotalscore="";

                    	 	foreach($asscount as $u => $asscounter1){
                    	 		
                    	 		foreach($subjectidarray as $y =>$subjectidarrayvalue){
                    	 			
                    	 			$asssubjscoredataT=$SHResultOOP->assessmentscores($scoretablename, $stuid, $subjectidarrayvalue, $levelid, $optionid, $semesterid, $sessionid, $asscounter1);
                        		                        		
                        		if (is_array($asssubjscoredataT)) {
                        		foreach ($asssubjscoredataT as $asssubjscorerecT) {
                        			$subtermsassscore=trim($asssubjscorerecT['score']);
                        		}
                        		}
                    	 		
                    	 			$accasssubjtotalscore+=$subtermsassscore;
                    	 		}
                    	 		
                    	 		$html.='<td>'.$accasssubjtotalscore.'</td>';
                    	 		//Accumulated all the assessment and scores
                    	 		$supaccasssubjtotalscore+=$accasssubjtotalscore;
                    	 		$accasssubjtotalscore="";
                    	 		
                    	 	}
                    	 	if ($accscore4allstuallsub1>0) {
                    	 		$accscore4allstuallsub2=$accscore4allstuallsub1/count($subjectidarray);
                    	 	}
                    	 	
                    	 	$accscore4allstuallsub2=round($accscore4allstuallsub2,1);
                    	 	if ($studavescore>0) {
                    	 		$studavescore=$studavescore/(count($subjectidarray));
                    	 	}
                    	 	
                    	 	$studavescore=round($studavescore, 1);
                    	 	if ($acchighestsubjtermavescore>0) {
                    	 		$acchighestsubjtermavescore=$acchighestsubjtermavescore/(count($subjectidarray));
                    	 	}
                    	 	
                    	 	$acchighestsubjtermavescore=round($acchighestsubjtermavescore, 1);
                    	 	$html.='<td>'.$supaccasssubjtotalscore.'</td><td>'.$stualltermoverallcumu.'</td><td></td><td></td><td></td><td></td><td></td></tr>';
                    	 	$html.='<tr><td style="font-size:11px; font-weight:bold; font-family: Arial ; ">CUMULATIVE(%)</td>'; if ($semesterid==2) { $html.='<td></td>'; } if ($semesterid==3) { $html.='<td></td><td></td>'; } $html.='<td></td><td></td><td></td><td></td><td></td><td></td><td>'.$studavescore.'%</td><td>'.$acchighestsubjtermavescore.'%</td><td>'.$accscore4allstuallsub2.'%</td><td></td></tr>';
                    	 
                    	 
					}
					
 		  $html.='</tbody>
		</table>
		</div>
		<div style="width:100%"><table style="width:100%; border:1px solid '.$schnamecolor.';"><tr><td style="width:60%" valign="top"><table style="width:100%; " cellspacing="0px" cellpadding="0px" valign="top"><tr><td style="font-family: Arial Black ; padding:2px; font-size:12px;  color:'.$htitlelabel.';padding:4px 1px; text-align:center;" bgcolor="'.$tableheadbgcolor.'" valign="top">SCALE</td></tr>
		<tr><td style="border-collapse:collapse">
		<table  style="width:100%; margin:2px; padding:2px;  border:0px; font-family: Arial ; font-size:12px; font-weight:bold">
		<tr><td style="border:0px">5 - Excellent</td> <td style="border:0px">4 - Very Good</td>
		<td style="border:0px">3 - Good</td> <td style="border:0px">2 - Fair</td>
		<td style="border:0px">1 - Poor</td> <td style="border:0px"></td></tr>
		</table>
		</td></tr></table><table class="domain" style="width:100%"><tr>';
		
		   $domaindata7=$SHResultOOP->allresultedit('domaintype', 'departmentid', $departmentid);
            if (is_array($domaindata7)) {
            foreach($domaindata7 as $domainrec7){ 
				$domaintypeid=trim($domainrec7["domaintypeid"]);
		$html.='<td style="width:50%" valign="top"><table valign="top" style="width:100%;  margin:2px; padding:2px; border-collapse:collapse;" cellspacing="0px" cellpadding="0px">
		<tr>
		<td style="font-family: Arial ; font-size:12px;  color:'.$htitlelabel.'; text-align:center; font-weight:bold" bgcolor="'.$tableheadbgcolor.'">'.$domainrec7["domaintypename"].'</td>
		</tr>

		<tr>
		<td style="border-collapse:collapse" >
		<table style="width:100%; margin:2px; padding:2px; border-collapse:collapse; font-family: Arial ; font-size:11px; font-weight:bold"  cellspacing="0px" cellpadding="0px">
		<tr><td style="width:50%; text-align:center"></td><td style="width:10%; text-align:center">5</td><td style="width:10%; text-align:center">4</td><td style="width:10%; text-align:center">3</td><td style="width:10%; text-align:center">2</td><td style="width:10%; text-align:center">1</td></tr>';
		$domaindata=$SHResultOOP->allresultedit('domainname', 'domaintypeid', trim($domainrec7['domaintypeid']));
          if (is_array($domaindata)) {
            foreach($domaindata as $domainrec){ 

				$domainnameid=trim($domainrec["domainnameid"]);

				$retrievedata5=$SHResultOOP->allresultedit2('resultdomain', 'positionresultid', $rid, 'domainnameid', trim($domainnameid));
			       if (is_array($retrievedata5)) { 
			        foreach($retrievedata5 as $field5){
			          $domainstate=trim($field5['domaingrade']);
			       }
			     }

		
		$html.='<tr><td style="width:50%; ">'.$domainrec["domainname"].'</td><td style="width:10%;"><center>'; if($domainstate==5) { $html.= '<img style="width:500%" src="../images/check-mark.png" />'; } $html.='</center></td><td style="width:10%"><center>'; if($domainstate==4) { $html.= '<img style="width:500%" src="../images/check-mark.png" />'; } $html.='</center></td><td style="width:10%"><center>'; if($domainstate==3) { $html.= '<img style="width:500%" src="../images/check-mark.png" />'; } $html.='</center></td><td style="width:10%"><center>'; if($domainstate==2) { $html.= '<img style="width:500%" src="../images/check-mark.png" />'; } $html.='</center></td><td style="width:10%"><center>'; if($domainstate==1) { $html.= '<img style="width:500%" src="../images/check-mark.png" />'; } $html.='</center></td></tr>';
		}
	}
		$html.='</table>
		</td>
		</tr></table></td>';
	}
	}

		$retrievedata8=$SHResultOOP->allresultedit2('signatoryposition', 'departmentid', $departmentid, 'status', '1');
			       if (is_array($retrievedata8)) { 
			        foreach($retrievedata8 as $field8){
			          $positionid=trim($field8['signatorypositionid']);
			          $positionsignature=trim($field8['signature']);
			          $signatoryid=trim($field8['staffid']);
			          $positionname=trim($field8['positionname']);
			       }
			     }

		//Signatory Person
	if ($principlec=="") {
			$principlec=$SHResultOOP->listselection('commentlist', $positionid, $totalscore);
		}

	
		
		$html.='</tr></table><td style="width:40%" valign="top"><table style="width:100%; border-collapse:collapse; border:0px; " cellspacing="0px" cellpadding="0px">
		<tr>
		<td bgcolor="'.$tableheadbgcolor.'" style="width:100%; font-family: Arial Black ; font-size:12px; color:'.$htitlelabel.'; padding:4px 1px">STUDENT PERFORMANCE :</td>
		</tr>
		<tr>
		<td>
		<table style="width:100%; border-collapse:collapse; border:0px; border:0px;" cellspacing="0px" cellpadding="0px">
		<tr>
		<td style="width:60%; font-family: Arial ; font-size:12px; font-weight:bold; text-align:center; padding:4px 1px">TOTAL SCORE:</td>
		<td style="width:40%; font-family: Arial Black ; font-size:12px; font-weight:bold; text-align:center">'.$stualltermoverallcumu.'</td>
		</tr>
		<tr>
		<td style=" font-family: Arial ; font-size:12px; font-weight:bold; text-align:center; padding:4px 1px">AVERAGE SCORE:</td>
		<td style=" font-family: Arial Black ; font-size:12px; font-weight:bold; text-align:center">'.$studavescore.'%</td>
		</tr>
		</table>
		</td>
		</tr>
		</table>
		<table style="width:100%; border-collapse:collapse; border:0px; " cellspacing="0px" cellpadding="0px">
		<tr>
		<td style="font-family: Arial Black; font-size:12px;color:'.$htitlelabel.'; padding:4px 1px" bgcolor="'.$tableheadbgcolor.'">Class Teacher`s Comment:</td>
		</tr>
		<tr>
		<td style="text-align:center; font-family: Arial Black; font-size:12px;" >'.$teachersc.'</td>
		</tr>
		<tr>
		<td style="font-family: Arial Black; font-size:12px; color:'.$htitlelabel.'; padding:4px 1px" bgcolor="'.$tableheadbgcolor.'">'.$positionname.'`s Remark:</td>
		</tr>
		<tr>
		<td style="text-align:center; font-family: Arial Black; font-size:12px;" >'.$principlec.'</td>
		</tr>
		</table>
		</td></tr></table>
		
		</div>';
		
		$html.='<div style="width:100%; border:1px solid '.$schnamecolor.';">
		<table style="width:100%"><tr>';   $pic = "../images/signatures/formteacher/". $teachersignature;
							   $pic2= trim($teachersurname. " " .$teacherothername);
					   $html .='<td style="width:35%" align="center" >';
					   		if (file_exists("../images/signatures/formteacher/".$teachersignature)) {
							  $html .='<img align="center" src="'.$pic.'" style="width:60px; height:30px" alt="'.$pic2.'"/>';
							  
								}
							else{
							    $html .='<span>'.$pic2.'</span>';
							}

						$html .='<br align="center">----------------------------------- <br />
							<span style="font:14px Arial Black">FORM TEACHER</span>
						</td>'; 
						$html .='<td align="center" width="50%">';
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
							      
							 $html.='</span></td><td></td></tr> </table>
		
		</div></div>';
		$counting--;
} 
echo $html.='</body></html>';

//$dompdf->loadHtml($html);
//$dompdf->set_option('isHtml5ParserEnabled', true);
//$dompdf->render();
//$dompdf->stream("SchoolHelp",array("Attachment"=>0));
	



//exit();