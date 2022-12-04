<?php
require_once("../includes/global.php"); 
include_once("../includes/connection.php");
include_once("../phpclass/SHresultOOP.php");
include_once("../phpclass/schoolhelpothers.php");


	require_once 'dompdf/autoload.inc.php';

	// reference the Dompdf namespace
	use Dompdf\Dompdf;

	// instantiate and use the dompdf class

	$SHResultOOP=new ClassResult;


	/*

$adminid=trim(isset($_GET['schoolhelp'])?$_GET['schoolhelp']:false);
$schoolhelp=trim(isset($_SESSION['schoolhelp'.$adminid])?$_SESSION['schoolhelp'.$adminid]:false);
$page=trim(isset($_GET['page'])?$_GET['page']:false);

$previlleges=$SHResultOOP->allresultedit('adminpersons', 'adminid', $schoolhelp);
foreach($previlleges as $actualrecord){
  $pageaccess=trim($actualrecord['result_d']);
  
}
if ($pageaccess!=1) {
  echo "<b style='font-size:100; color:red'>Criminal Attempt Made, contact the admin ask for the access of this page</b>";
  exit();
}
*/
	
	$t =0;
	$levelid =trim(isset($_SESSION["levelid"])?$_SESSION["levelid"]:false) ;

	$semesterid = trim(isset($_SESSION["semesterid"])?$_SESSION["semesterid"]:false) ;
	
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
	
	//stopped here
	
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
		//when single result is set do this to select position in resultposition table based on singular semesterid average
		$posaverage='average';
	}else{
		//when single result is set do this to select position in resultposition table based on accumulalated semesterid average
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
	
//array check position tally
$positiontally=array();

	
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
				$daysschopen=trim($semesterend['no_of_days']);
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



$html='<html><head>
<title>'.$levelname.$optionname.'</title>
<style>
.studentdata > table, th, td{border:1px solid '.$schnamecolor.'}
.vertical{writing-mode: vertical-lr;-ms-writing-mode: tb-rl; transform: rotate(180deg); letter-spacing:1px;  padding:3px;  text-align:center; }
.resultbody>tr:nth-child(odd){
	background:'.$tablecontentcolor1.'
}
.resultbody>tr:nth-child(even){
	background:'.$tablecontentcolor2.'
}

</style>
</head><body style="">';
$counting=0;

foreach($myArray as $c=>$my_Array2){
	$t =0;
	$c+=1;

$stuid=trim($my_Array2) ;

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
                            $realcomment="";
                           
                          //checks of equal average
                          $equalave="";

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
			
			$divbackground='<img src="'.$logoaddress.'" style="position:fixed; top:140; opacity:0.01;  z-index:-3; width:100%; "/>';
		}
		elseif ($resultbackground==2) {
			$increasedaddress=str_repeat($instiname, 180);
			$divbackground='<div style="color:light-grey; position:fixed; z-index:0; top:0; bottom:0; opacity:0.1; text-align:justify">'.$increasedaddress.'</div>';
		}else{
			$divbackground="";
		}
			$counting+=1;
		if($passport !=""){ 
			$pic= '../images/uploads/student/'.$passport; } else{ $pic= "../images/user.png" ;
		}

		if($c>$counting){
			$div='<div style="page-break-before:always;">';
		}else{ $div='<div style="">'; }
		$html .=$div.$divbackground.'
    

		<div style="width:100%">
		<table style="width:100%; border:0px; ">
		<tr>
		<td style="width:15%; border:0px;">
		</td>
		<td style="width:60%; border:0px;""><center>
		<ul style="list-style:none; align:center; width:100%">
		<li style="color:'.$schnamecolor.';  font-family: Arial Black"><h3>'.strtoupper($instiname).'</h3></li>
		<li style="color:'.$schnameaddress.';font-size:11; font-family: Arial Black"><span ><b>'.strtoupper($instiaddress).'</b></span></li>
		<li style="color:'.$schnameaddress.'; font-size:11; font-family: Arial Black"><b>TEL:'.$instiphone.';	Email: '.$instiemail.'</b></li>
		<li style="color:'.$schnameaddress.'; font-size:11; font-family: Arial Black"><b>MOTTO:'.strtoupper($instislogan).';</b></li>
		<li style="color:'.$schnamecolor.'; font-family: Arial Black"><h5>REPORT SHEET FOR '.strtoupper($semestername). ' TERM, ' . $sessionname. ' SESSION</h5></li>

		</ul>
		</center>
		</td>
		<td style="width:25%; align:left; border:0px;"><center>
		<img src="../images/logo/'.$instilogo.'" width="100px" height="100px">
		</center>
		</td>
		</tr>
		</table>
		</div>


		
		<div style="width:100%;" class="studentdata">
		<table  style="width:100%; border: 2px solid '.$schnamecolor.'; border-collapse: collapse; opacity:0.9" cellspacing="0px" cellpadding="0px">
		<tr>
		<td style="width:15%; border: 2px solid '.$schnamecolor.'; margin;0px">
			<img src="'.$pic.'" width="100px" height="98px"/>
		</td>
		<td style="width:45%;  border-collapse: collapse;">
			<table style="width:100%; font-size:12px; font-weight:bold;  font-family: Arial; border-collapse: collapse; " cellspacing="0px" cellpadding="0px">
			<tr style="width:100%; ">
				<td style="width:30%; margin-left:3px;  color:'.$htitlelabel.'" bgcolor="'.$tableheadbgcolor.'">Fullname:</td><td style="width:70%; align:left; color:'.$htitle.'"> '.strtoupper($studentfullname).'</td>
			</tr>
			<tr>
				<td style=" color:'.$htitlelabel.' " bgcolor="'.$tableheadbgcolor.'">SEX: </td><td style=" color:'.$htitle.'"> '.strtoupper($studentsex).'</td>
			</tr>
			<tr>
				<td style="color:'.$htitlelabel.'  " bgcolor="'.$tableheadbgcolor.'">CURRENT CLASS:</td><td style="color:'.$htitle.' "> '.strtoupper($levelname).'</td>
				</tr>
			<tr>
				<td style=" color:'.$htitlelabel.'" bgcolor="'.$tableheadbgcolor.'">CLASS ARM:</td><td style=" color:'.$htitle.'">'.strtoupper($optionname).'</td>
				</tr>
			<tr >
				<td style=" color:'.$htitlelabel.' " bgcolor="'.$tableheadbgcolor.'">HOUSE:</td><td style="color:'.$htitle.' ">'.strtoupper($studenthouse).'</td>
				</tr>
			<tr>
				<td style=" color:'.$htitlelabel.' " bgcolor="'.$tableheadbgcolor.'">&nbsp</td><td style="color:'.$htitle.' "></td>
			</tr>
			</table>
		</td>
		<td style="width:45%; font-family: Arial Black; " >
			<table style="width:100%;   border-collapse: collapse;" cellspacing="0px" cellpadding="0px">
			<tr style="width:100%; ">
			<td style="font-size:12px; font-weight:bold; font-family: Arial ; " bgcolor="'.$tableheadbgcolor.'"><center>ATTENDANCE</center></td>
			</tr>
			<tr>
			<td style="width:100%;">
			<table style="font-size:10px; font-weight:bold; width:100%;  border-collapse: collapse;">
			<tr>
			<td style="width:80%; color:'.$htitlelabel.'">NUMBER OF DAYS PRESENT:</td><td style="width:20%; color:'.$htitle.'">'.$noattd.'</td>
			</tr>
			<tr>
			<td style="color:'.$htitlelabel.'">NUMBER OF DAYS ABSENT:</td><td style="color:'.$htitle.'">'.($noschopen - $noattd).'</td>
			</tr>
			<tr>
			<td style="color:'.$htitlelabel.'">TOTAL NUMBER OF ACADEMIC DAYS:</td><td style="color:'.$htitle.'">'.$noschopen.'</td>
			</tr>
			<tr>
			<td style="color:'.$htitlelabel.'">TOTAL NUMBER OF DAYS SCHOOL OPENS:</td><td style="color:'.$htitle.'">'.$daysschopen.'</td>
			</tr>
			</table>
			</td>
			</tr>
			<tr>
			<td >&nbsp;</td>
			</tr>
			</table>
		</td>
		</tr>
		</table>
		</div>


		';

		//Creating the result body 
		$html.='<div style="width:100%; margin:2px 0px; border:2px solid '.$schnamecolor.';">
		
		<table style="width:100%;">
		<tr>
		<td style="width:65%;">
		<table style="width:100%; border-collapse:collapse; opacity:0.8">

		<thead bgcolor="'.$tableheadbgcolor.'"  style="font-family: Arial ; font-size:12px; color:'.$htitlelabel.'">
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
    //Header 4 2nd semesterid result
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


   $html.= '<th style="text-align:center; width:auto"><span class="vertical" >CUMMULATIVE'; if ($semesterid==1) {  $html.='(100%)'; }
   	if ($semesterid==2) { 
   		if ($resultstatus==1) { $html.='(100%)';
   	} else { $html.='(200%)'; } 
   } 
   if ($semesterid==3) { 
   	if ($resultstatus==1) { 
   		$html.='(100%)'; 
   	} 
   	else { $html.='(300%)'; }
   } $html.='</span></th>
    <th  style="text-align:center; width:auto;"><span class="vertical" >GRADE</span></th>
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
	                        		
	                        		if (is_array($subjscoredata1)) {
	                        			$q1="";
	                        			$totalscoreq1="";
	                        		foreach ($subjscoredata1 as $subjscorerec1) {
	                        			
						           			$q1+=1;
											$totalscoreq1+=$subjscorerec1['score'];
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
		</table></td>
		<td style="width:35%; "  valign="top"><table><tr>';
		
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

		
		$html.='<tr><td style="width:50%; ">'.$domainrec["domainname"].'</td><td style="width:10%;"><center>'; if($domainstate==5) { $html.= '<img style="width:50%" src="../images/check-mark.png" />'; } $html.='</center></td><td style="width:10%"><center>'; if($domainstate==4) { $html.= '<img style="width:50%" src="../images/check-mark.png" />'; } $html.='</center></td><td style="width:10%"><center>'; if($domainstate==3) { $html.= '<img style="width:50%" src="../images/check-mark.png" />'; } $html.='</center></td><td style="width:10%"><center>'; if($domainstate==2) { $html.= '<img style="width:50%" src="../images/check-mark.png" />'; } $html.='</center></td><td style="width:10%"><center>'; if($domainstate==1) { $html.= '<img style="width:50%" src="../images/check-mark.png" />'; } $html.='</center></td></tr>';
		}
	}
		$html.='</table>
		</td>
		</tr></table></td>';
	}
	}
		

		$html.='<table style="width:100%; margin:2px; padding:2px; height:30%;" cellspacing="0px" cellpadding="0px"><tr><td style="font-family: Arial ; padding:2px; font-size:12px;  color:'.$htitlelabel.'; text-align:center;" bgcolor="'.$tableheadbgcolor.'">SCALE</td></tr>
		<tr><td style="border-collapse:collapse">
		<table  style="width:100%; margin:2px; padding:2px;  border:0px; font-family: Arial ; font-size:12px; font-weight:bold">
		<tr><td style="border:0px">5 - Excellent</td> <td style="border:0px">4 - Very Good</td></tr>
		<tr><td style="border:0px">3 - Good</td> <td style="border:0px">2 - Fair</td></tr>
		<tr><td style="border:0px">1 - Poor</td> <td style="border:0px"></td></tr>
		</table>
		</td></tr></table></td>
		</tr>
		</table>
		</td>
		</tr>
		</table>
		</div>';
		
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
		
		$html.='<div style="width:100%">
		<table style="width:100%">
		<tr><td style="width:70%;" valign="top">
		<table style="width:100%">
		<tr>
		<td style="width:100%; border:0px" valign="top" >
		<table style="width:100%; border:0px; border-collapse:collapse;" cellspacing="0px" cellpadding="0px" valign="top">
		<tr><td style="width:50%; border-collapse:collapse;" valign="top">
		<table style="width:100%; border-collapse:collapse; " cellspacing="0px" cellpadding="0px">
		<tr bgcolor="'.$tableheadbgcolor.'">
		<td style="width:40%; font-family: Arial ; font-size:12px; font-weight:bold; border:0px; color:'.$htitlelabel.'; padding:4px 1px">Resumption Date:</td>
		<td style="width:60%; font-family: Arial ; font-size:12px; font-weight:bold; border:0px; "></td>
		</tr>
		<tr>
		<td style="border:0px"></td>
		<td style="width:60%; font-family: Arial ; font-size:12px; font-weight:bold; border:0px">'.date("l jS F, Y", strtotime($begins)).'</td>
		</tr>
		</table>
		</td>
		<td style="width:50%; border-collapse:collapse;">
		<table style="width:100%; border-collapse:collapse; border:0px; border:0px;" cellspacing="0px" cellpadding="0px">
		<tr bgcolor="'.$tableheadbgcolor.'">
		<td style="width:42%; font-family: Arial ; font-size:12px; font-weight:bold; border:0px; ">Vacation Date:</td>
		<td style="width:58%; font-family: Arial ; font-size:12px; font-weight:bold; text-align:right; border:0px; color:'.$htitlelabel.'; padding:4px 1px"></td>
		</tr>
		<tr>
		<td style="width:55%; font-family: Arial ; font-size:12px; font-weight:bold; text-align:right; border:0px"></td>
		<td style="border:0px">'. date("l jS F, Y", strtotime($ends)).'</td>
		</tr>
		</table>
		</td>
		</tr></table></td>
		</tr>
		<tr>
		<td style="width:100%;">
		<table style="width:100%; border-collapse:collapse; border:0px; border:0px;" cellspacing="0px" cellpadding="0px">
		<tr>
		<td style="width:45%; border-collapse:collapse; border:0px; border:0px;" cellspacing="0px" cellpadding="0px">
		<table style="width:100%; border-collapse:collapse; border:0px; border:0px;" cellspacing="0px" cellpadding="0px">
		<tr>
		<td bgcolor="'.$tableheadbgcolor.'" style="width:100%; font-family: Arial Black ; font-size:12px; color:'.$htitlelabel.'; padding:4px 1px">PERFORMANCE REPORT:</td>
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
		<tr style="color:'.$htitlelabel.';" bgcolor="'.$tableheadbgcolor.'">
		<td style="text-align:center; font-family: Arial Black; font-size:12px; padding:4px 1px">POSITION:</td>
		</tr>
		<tr>
		<td style="text-align:center; font-family: Arial Black; font-size:12px; padding:4px 1px">'; if ($resultpositionstatus==1) { if ($resultpositiongrade==1) { $html.=$positioninggrade;} else{ $html.=$abbreviation.' out of '.$num_chkpg.' Students'; } }else{ $html.='<span>&nbsp</span>';} $html.='</td>					
		</tr>
		</table>
		</td>
		<td style="width:55%;" valign="top">
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
		</td>
		</tr>

		</table>
		</td>
		</tr>
		</table>
		</td><td style="width:30%" valign="top">
		<table style="width:100%">
		<tr bgcolor="'.$tableheadbgcolor.'">
		<td style="width:100%; color:'.$htitlelabel.'; font-family: Arial Black; font-size:12px;">FEES Report:</td>
		</tr>';
		$mafid="";
		$nexttermfee="";
		$arears="";	
		$others="";

		$total="";
		$retrievedata9=$SHResultOOP->manuallyaddfees($semesterid, $sessionid, $levelid, $stuid);
		if (is_array($retrievedata9)) { 
			        foreach($retrievedata9 as $var_manuallyaddfees){
									$mafid=trim($var_manuallyaddfees['mafid']);
									$nexttermfee=$var_manuallyaddfees['nexttermfee'];
									$arears=$var_manuallyaddfees['arears'];	
									$others=$var_manuallyaddfees['others'];	

									$total=$nexttermfee+$arears+$others;
					}
				}
		$html.='<tr>
		<td style="width:100%; border-collapse:collapse; border:0px; " cellspacing="0px" cellpadding="0px">
		<table style="width:100%; border-collapse:collapse; border:0px; " cellspacing="0px" cellpadding="0px">
		<tr><td style="width:50%; font-family: Arial Black; font-size:12px;">Next semesterid Fees:</td><td style="width:50%">'.$nexttermfee.'</td></tr>
		<tr><td style="font-family: Arial Black; font-size:12px;">Arears:</td><td>'.$arears.'</td></tr>
		<tr><td style="font-family: Arial Black; font-size:12px;">Other Fees:</td><td>'.$others.'</td></tr>
		<tr><td style="font-family: Arial Black; font-size:12px;">Total:</td><td>'.$total.'</td></tr>
		</table>
		</td>
		</tr>
		</table>
		<table style="width:100%;  " >
		<tr bgcolor="'.$tableheadbgcolor.'"><td style="width:100%; border-collapse:collapse; color:'.$htitlelabel.'; font-family: Arial; font-size:12px; font-weight:bold" cellspacing="0px" cellpadding="0px">'.$positionname.'`s Signature</td></tr>
		<tr><td style="width:100%; border-collapse:collapse; border:0px; " cellspacing="0px" cellpadding="0px">&nbsp</td></tr>
		
		<tr><td style="width:100%; border-collapse:collapse; border:0px; "><hr><center><span style="font-family: Arial; font-size:12px; font-weight:bold;">Date:&nbsp&nbsp'.date("Y-m-d").'</span></center></td></tr>
		</table>
		</td>
		</tr>

		</table>
		</div></div>';
		$counting--;
} 
echo $html.='</body></html>';

//$dompdf->loadHtml($html);
//$dompdf->set_option('isHtml5ParserEnabled', true);
//$dompdf->render();
//$dompdf->stream("SchoolHelp",array("Attachment"=>0));
	



//exit();