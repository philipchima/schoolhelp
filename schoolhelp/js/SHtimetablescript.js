$(document).ready(function(){
jQuery(function($) { 'use strict';
            $("#printrecord").find('.print-link').on('click', function() {
                //Print ele2 with default options
                $.print("#printrecord");
            });
            
            // Fork https://github.com/sathvikp/jQuery.print for the full list of options
        });


  });

// Retrieving Some fields
  function addingfields(tabletoadd, tabletoaddfield, tabletocheck, tabletocheckfield, tabletocheckgetfield, tabletocheckid, section){
    $("#waitprocessing").show();
    
    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tabletoadd': tabletoadd,
         'tabletoaddfield': tabletoaddfield,
        'tabletocheck': tabletocheck,
        'tabletocheckfield': tabletocheckfield,
        'tabletocheckgetfield': tabletocheckgetfield,
        'tabletocheckid': tabletocheckid,
      },
       
      success: function(response){
        $("#waitprocessing").hide();
        $('#opencontainer').html(response);
      }
    });
 }



// Retrieving Some fields

  function addingperiods(fieldname, fieldvalue, fieldname1, fieldvalue1, fieldname2, fieldvalue2, operatorid, daysid, noofperiods, section, elementid){
    $("#waitprocessing").show();
    
    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {

        'section':section,
         'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'fieldname1': fieldname1,
        'fieldvalue1': fieldvalue1,
        'fieldname2': fieldname2,
        'fieldvalue2': fieldvalue2,
        'operatorid': operatorid,
        'daysid': daysid,
        'noofperiods': noofperiods,
        'section': section,
        
      },
       
      success: function(response){
        $("#waitprocessing").hide();
        $('#'+elementid).html(response);
      }
    });
 }

// Retrieving Some fields

  function addingdays(tabletoadd, tabletocheck, tabletocheckfield1, tabletocheckid1, tabletocheckfield2, tabletocheckid2, tabletocheckgetfield, section, elementid){
    $("#waitprocessing").show();
    var operatorid=$("#operatorid").val();
    
    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {

        'section':section,
        'tabletoadd': tabletoadd,
        'tabletocheck': tabletocheck,
        'tabletocheckfield1': tabletocheckfield1,
        'tabletocheckid1': tabletocheckid1,
        'tabletocheckfield2': tabletocheckfield2,
        'tabletocheckid2': tabletocheckid2,
        'tabletocheckgetfield': tabletocheckgetfield,
        'operatorid':operatorid,
      },
       
      success: function(response){
        $("#waitprocessing").hide();
        $('#opencontainer').html(response);
      }
    });
 }

 // Retrieving Some fields

  function addingdays2(tabletoadd, tabletocheck, tabletocheckfield1, tabletocheckid1, tabletocheckfield2, tabletocheckid2, section, elementid){
    $("#waitprocessing").show();
   
    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {

        'section':section,
        'tabletoadd': tabletoadd,
        'tabletocheck': tabletocheck,
        'tabletocheckfield1': tabletocheckfield1,
        'tabletocheckid1': tabletocheckid1,
        'tabletocheckfield2': tabletocheckfield2,
        'tabletocheckid2': tabletocheckid2,
        
        
      },
       
      success: function(response){
        
        $("#waitprocessing").hide();
        $('#opencontainer2').html(response);
      }
    });
 }

 //Retrieving of weeks

//Adding Record
 function addingweeks(tablename, fieldname, fieldvalue, section, elementid){
    $("#waitprocessing").show();
    
    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename': tablename,
        'fieldname': fieldname,
        'fieldvalue': fieldvalue,
      },
       
      success: function(response){
        $("#waitprocessing").hide();
        $('#'+elementid).html(response);
      }
    });
 }

//Updating Record
 function addingweeks2(tablename, fieldname, fieldvalue, section, elementid){
    $("#waitprocessing").show();
    
    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename': tablename,
        'fieldname': fieldname,
        'fieldvalue': fieldvalue,
      },
       
      success: function(response){
        $("#waitprocessing").hide();
        $('#'+elementid).html(response);
      }
    });
 }

//Retrieving a particular table based on check on one fieldname or two fieldname
// Retrieving Some fields
  function retrieveselection(tablename, fieldname, fieldvalue, fieldname1, fieldvalue1, section){
    $("#waitprocessing").show();
    
    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename': tablename,
         'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'fieldname1': fieldname1,
        'fieldvalue1': fieldvalue1,
       
      },
       
      success: function(response){
        $("#waitprocessing").hide();
        $('#levelselection').html(response);
      }
    });
 }

function inputdatalist(inputlistlistlabel, inputlistid, element2receive){
 $("#"+element2receive).val("");
shownVal = document.getElementById(inputlistlistlabel).value;
var value2send = document.querySelector("#"+inputlistid+" option[value='"+shownVal+"']").dataset.value;
$("#"+element2receive).val(value2send);
}

// Retrieving Some fields for course table experiment done
  function retrieveselection1(tablename, fieldname, fieldvalue, fieldname1, fieldvalue1, section, element2append, uniquecount){
    $("#waitprocessing").show();
    
    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename': tablename,
         'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'fieldname1': fieldname1,
        'fieldvalue1': fieldvalue1,
        'uniquecount':uniquecount,

      },
       
      success: function(response){
        $("#waitprocessing").hide();
        $('#'+element2append).html(response);
      }
    });
 }

//Retrieving Some Records
  function collectdate(fieldvalue, section, elementid){
    $("#waitprocessing").show();
    
    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'section':section,
        'fieldvalue': fieldvalue,
      },
       
      success: function(response){
        $("#waitprocessing").hide();
        $('#'+elementid).html(response);
        checktime3('dailytimetable', 'dailytimetableid', $('#dailytimetableid').val(),'timetablesemesterid', $('#timetablesemesterid').val(), 'daydate', $('#date').val(), 'starttime', $('#starttime').val(), 'endtime', $('#endtime').val(), 'checktime3', 'weeklyday', 'date');
      }
    });
 }

  function insertdailytimetable(tablename, fieldname, fieldvalue, fieldname1, fieldvalue1, fieldname2, fieldvalue2, fieldname3, fieldvalue3, fieldname4, fieldvalue4, fieldname5, fieldvalue5, fieldname6, fieldvalue6, fieldname7, fieldvalue7, fieldname8, fieldvalue8, fieldname9, fieldvalue9, fieldname10, fieldvalue10, fieldname11, fieldvalue11, fieldname12, fieldvalue12, fieldname13, fieldvalue13, section, elementid, elementid1){
    $("#waitprocessing").show();
   
    if (fieldvalue=='') {
      alert("Please select a Semester/Term Timetable Setup");
       $("#waitprocessing").hide();
      return false;
    }
    else if(fieldvalue1=='') {
      alert("Please select Week");
       $("#waitprocessing").hide();
      return false;
    }

     else if(fieldvalue2=='') {
      alert("Please select Week Day");
       $("#waitprocessing").hide();
      return false;
    }

    else if(new Date(fieldvalue3)=="Invalid Date") {
      alert("Please select a valid date, Please enter in this formate 29/12/2021");
       $("#waitprocessing").hide();
      return false;
    }
     else if(fieldvalue9>=fieldvalue10) {
      alert("Please took note lecture starting time should not be greater than lecture ending.  \n Please enter the time in this formart:: 00:00");
       $("#waitprocessing").hide();
      return false;
    }
     else if(fieldvalue9==fieldvalue10) {
      alert("Please took note lecture starting time should not be same with lecture ending. \n Please enter the time in this time formart:: 00:00");
       $("#waitprocessing").hide();
      return false;
    }
    else if(fieldvalue9=='') {
      alert("Please select enter lecture end time in this time formart:: 00:00");
       $("#waitprocessing").hide();
      return false;
    }
     else if(fieldvalue10=='') {
      alert("Please select enter lecture end time in this time formart:: 00:00");
       $("#waitprocessing").hide();
      return false;
    }
    else if(fieldvalue7=='') {
      alert("Please select Hall of usage");
       $("#waitprocessing").hide();
      return false;
    }
     else if(fieldvalue6=='') {
      alert("Please select Schedule/Lecture Type");
       $("#waitprocessing").hide();
      return false;
    }
     else if(fieldvalue5=='') {
      alert("Please select Instructor/Invigilator");
       $("#waitprocessing").hide();
      return false;
    }
    else if(fieldvalue4=='') {
      alert("Please select Course/Subject");
       $("#waitprocessing").hide();
      return false;
    }else{
    
    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename': tablename,
         'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'fieldname1': fieldname1,
        'fieldvalue1': fieldvalue1,
        'fieldname2': fieldname2,
        'fieldvalue2': fieldvalue2,
        'fieldname3': fieldname3,
        'fieldvalue3': fieldvalue3,
        'fieldname4': fieldname4,
        'fieldvalue4': fieldvalue4,
        'fieldname5': fieldname5,
        'fieldvalue5': fieldvalue5,
        'fieldname6': fieldname6,
        'fieldvalue6': fieldvalue6,
        'fieldname7': fieldname7,
        'fieldvalue7': fieldvalue7,
         'fieldname8': fieldname8,
        'fieldvalue8': fieldvalue8,
        'fieldname9': fieldname9,
        'fieldvalue9': fieldvalue9,
        'fieldname10': fieldname10,
        'fieldvalue10': fieldvalue10,
        'fieldname11': fieldname11,
        'fieldvalue11': fieldvalue11,
        'fieldname12': fieldname12,
        'fieldvalue12': fieldvalue12,
        'fieldname13': fieldname13,
        'fieldvalue13': fieldvalue13,
      },
       
      success: function(response){
        $("#waitprocessing").hide();
         msgresponse=$.trim(response);
         
        if (fieldvalue13==""){

        $('#'+elementid).val(msgresponse);
          alert("This record has been inserted");
           $('#'+elementid1).val('Update');
        }else{
          alert("This record has been updated");
        }
      }
    });

  }// Ending of the validation
 }

 // Checking Time
 
  function checktime(tablename, operatorid, schoolhelp, fieldname, fieldvalue, fieldname1, fieldvalue1, fieldname2, fieldvalue2, fieldname3, fieldvalue3, elementid, section){
    $("#waitprocessing").show();

    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename': tablename,
         'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'fieldname1': fieldname1,
        'fieldvalue1': fieldvalue1,
        'fieldname2': fieldname2,
        'fieldvalue2': fieldvalue2,
        'fieldname3': fieldname3,
        'fieldvalue3': fieldvalue3,
      },
       
      success: function(response){
        $("#waitprocessing").hide();
        
        msgresponse=$.trim(response);
        if (msgresponse>0) {
         
           if(!confirm("This Timetable(period) has been added already, \n Please try entering another Timetable Period \n Confirmation of this may cause clash of lecture periods in the Timetable \n Do you want to continue?")){
                $('#'+elementid).val("");
                $('#'+elementid).append("<a href='?pg=7&schoolhelp="+schoolhelp+"&dailytimetableid="+response+"'>Check Already Added Record</a>"); 
            } 
        }
        
      }
    });
 }

 function checktime3(tablename, fieldname, fieldvalue, fieldname1, fieldvalue1, fieldname2, fieldvalue2, fieldname3, fieldvalue3, fieldname4, fieldvalue4, section, elementid, elementid1){
    $("#waitprocessing").show();
    var schoolhelp=$("#operatorid").val();

    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename': tablename,
         'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'fieldname1': fieldname1,
        'fieldvalue1': fieldvalue1,
        'fieldname2': fieldname2,
        'fieldvalue2': fieldvalue2,
        'fieldname3': fieldname3,
        'fieldvalue3': fieldvalue3,
         'fieldname4': fieldname4,
        'fieldvalue4': fieldvalue4,
      },
       
      success: function(response){
        $("#waitprocessing").hide();
        
        msgresponse=$.trim(response);
        if (msgresponse!="") {
         
           if(!confirm(response+" \n Confirmation of this may cause clash of lecture periods in the Timetable \n Do you want to continue?")){
                $('#'+elementid).val("");
                $('#'+elementid1).val("");
            } 
        }
        
      }
    });
 }

 // This retrieves selected course lecturer or to be selected and also checks whether courses has been assigned that day or that week
 //coursecheck('instructorcourses', 'dailytimetable', 'courseid', this.value, 'timetablesemesterid', $('#timetablesemesterid').val(), 'timetableweekid', $('#timetableweekid').val(), 'daydate', $('#date<?php echo $daysid; ?>').val(), 'starttime',  $('#starttime<?php echo $daysid.$u; ?>').val(), 'endtime', $('#endtime<?php echo $daysid.$u; ?>').val(), 'coursecheck', $(this).val())
  
  function coursecheck(tablename, tablename1, fieldname, fieldvalue, fieldname1, fieldvalue1, fieldname2, fieldvalue2, fieldname3, fieldvalue3, fieldname4, fieldvalue4, fieldname5, fieldvalue5, retrievefieldidno, section, elementid, elementid2){
    $("#waitprocessing").show();
    var schoolhelp=$("#operatorid").val();

    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename': tablename,
        'tablename1': tablename1,
         'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'fieldname1': fieldname1,
        'fieldvalue1': fieldvalue1,
        'fieldname2': fieldname2,
        'fieldvalue2': fieldvalue2,
        'fieldname3': fieldname3,
        'fieldvalue3': fieldvalue3,
        'fieldname4': fieldname4,
        'fieldvalue4': fieldvalue4, 
        'fieldname5': fieldname5,
        'fieldvalue5': fieldvalue5,   
      },
       
      success: function(response){
        $("#waitprocessing").hide();
        
        msgresponse=$.trim(response);
        if (msgresponse!="") {
           if(!confirm(msgresponse+" \n Confirmation of this may cause duplication of periods on daily or weekly basis in the Timetable if not scrutinised\n Do you want to continue?")){
                $('#'+elementid).val("");
            } 
        }
        
      }
    });


    //Retrieve Instructor/Teacher or Invigilator based on selected Subject/Course
        instructorsel(tablename, tablename1, fieldname, fieldvalue, fieldname1, fieldvalue1, fieldname3, fieldvalue3, fieldname4, fieldvalue4, fieldname5, fieldvalue5, retrievefieldidno, 'staffretrieve', elementid2);
 }

 //Retrieve Instructor/Teacher or Invigilator based on selected Subject/Course::function
function instructorsel(tablename, tablename1, fieldname, fieldvalue, fieldname1, fieldvalue1, fieldname3, fieldvalue3, fieldname4, fieldvalue4, fieldname5, fieldvalue5, retrievefieldidno, section, elementid){
   $("#waitprocessing").show();
   
    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename': tablename,
         'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'fieldname1': fieldname1,
        'fieldvalue1': fieldvalue1,
        
        'retrievefieldidno':retrievefieldidno,
      },
       
      success: function(response1){
        response1=$.trim(response1);
        $("#waitprocessing").hide();
        if (response1!="") {
          
        $('#'+elementid).html(response1);
        var staffid=$.trim($('#staffid'+retrievefieldidno).val());

        //this called function checks whether lecturer class period is clashing with another
        var elementid1='staffid'+retrievefieldidno; //Elements to clear
        var elementid2='staffname'+retrievefieldidno; //Elements to clear
        lectureperiodclash(tablename1, fieldname3, fieldvalue3, 'instructorid', staffid, fieldname4, fieldvalue4, fieldname5, fieldvalue5, 'lectureperiodclash', elementid1, elementid2);
        }

      }
    });
}

function lectureperiodclash(tablename1, fieldname, fieldvalue, fieldname1, fieldvalue1, fieldname2, fieldvalue2, fieldname3, fieldvalue3,  section, elementid1, elementid2){
    $("#waitprocessing").show();
    
    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename1': tablename1,
        'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'fieldname1': fieldname1,
        'fieldvalue1': fieldvalue1,
        'fieldname2': fieldname2,
        'fieldvalue2': fieldvalue2,
        'fieldname3': fieldname3,
        'fieldvalue3': fieldvalue3,
      },
       
      success: function(response){
        $("#waitprocessing").hide();
         msgresponse=$.trim(response);
        if (msgresponse!="") {
           if(!confirm(msgresponse+" \n Confirmation of this may cause clash of lecture periods for the selected if not critically checked \n Do you want to continue?")){
                $('#'+elementid1).val("");
                $('#'+elementid2).val("");
            } 
        }

      }
    });
 }

// This retrieves selected course lecturer or to be selected and also checks whether courses has been assigned that day or that week
 //coursecheck('instructorcourses', 'dailytimetable', 'courseid', this.value, 'timetablesemesterid', $('#timetablesemesterid').val(), 'timetableweekid', $('#timetableweekid').val(), 'daydate', $('#date<?php echo $daysid; ?>').val(), 'starttime',  $('#starttime<?php echo $daysid.$u; ?>').val(), 'endtime', $('#endtime<?php echo $daysid.$u; ?>').val(), 'coursecheck', $(this).val())
  
  function coursecheck2(tablename, tablename1, fieldname, fieldvalue, fieldname1, fieldvalue1, fieldname2, fieldvalue2, fieldname3, fieldvalue3, fieldname4, fieldvalue4, fieldname5, fieldvalue5,  fieldname6, fieldvalue6, section, elementid, elementid2){
    $("#waitprocessing").show();
    var schoolhelp=$("#operatorid").val();

    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename': tablename,
        'tablename1': tablename1,
         'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'fieldname1': fieldname1,
        'fieldvalue1': fieldvalue1,
        'fieldname2': fieldname2,
        'fieldvalue2': fieldvalue2,
        'fieldname3': fieldname3,
        'fieldvalue3': fieldvalue3,
        'fieldname4': fieldname4,
        'fieldvalue4': fieldvalue4, 
        'fieldname5': fieldname5,
        'fieldvalue5': fieldvalue5,
        'fieldname6': fieldname6,
        'fieldvalue6': fieldvalue6,   
      },
       
      success: function(response){
        $("#waitprocessing").hide();
        
        msgresponse=$.trim(response);
        if (msgresponse!="") {
           if(!confirm(msgresponse+" \n Confirmation of this may cause duplication of periods on daily or weekly basis in the Timetable if not accepted\n Do you want to continue?")){
                $('#'+elementid).val("");
            } 
        }
        
      }
    });


    //Retrieve Instructor/Teacher or Invigilator based on selected Subject/Course
        instructorsel2(tablename, tablename1, fieldname, fieldvalue, fieldname1, fieldvalue1, fieldname3, fieldvalue3, fieldname4, fieldvalue4, fieldname5, fieldvalue5, fieldname6, fieldvalue6, 'staffretrieve2', elementid2);
 }



//Retrieve Instructor/Teacher or Invigilator based on selected Subject/Course::function
function instructorsel2(tablename, tablename1, fieldname, fieldvalue, fieldname1, fieldvalue1, fieldname3, fieldvalue3, fieldname4, fieldvalue4, fieldname5, fieldvalue5, fieldname6, fieldvalue6, section, elementid){
   $("#waitprocessing").show();
   
    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename': tablename,
         'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'fieldname1': fieldname1,
        'fieldvalue1': fieldvalue1,
        
        
      },
       
      success: function(response1){
        response1=$.trim(response1);
        $("#waitprocessing").hide();
        if (response1!="") {
          
        $('#'+elementid).html(response1);
        var staffid=$.trim($('#staffid').val());

        //this called function checks whether lecturer class period is clashing with another
        var elementid1='staffid'; //Elements to clear
        var elementid2='staffname'; //Elements to clear
        lectureperiodclash2(tablename1, fieldname3, fieldvalue3, 'instructorid', staffid, fieldname4, fieldvalue4, fieldname5, fieldvalue5, fieldname6, fieldvalue6, 'lectureperiodclash2', elementid1, elementid2);
        }

      }
    });
}

 function lectureperiodclash2(tablename1, fieldname, fieldvalue, fieldname1, fieldvalue1, fieldname2, fieldvalue2, fieldname3, fieldvalue3, fieldname4, fieldvalue4, section, elementid1, elementid2){
    $("#waitprocessing").show();
    
    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename1': tablename1,
        'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'fieldname1': fieldname1,
        'fieldvalue1': fieldvalue1,
        'fieldname2': fieldname2,
        'fieldvalue2': fieldvalue2,
        'fieldname3': fieldname3,
        'fieldvalue3': fieldvalue3,
         'fieldname4': fieldname4,
        'fieldvalue4': fieldvalue4,
      },
       
      success: function(response){
        $("#waitprocessing").hide();
         msgresponse=$.trim(response);
        if (msgresponse!="") {
           if(!confirm(msgresponse+" \n Confirmation of this may cause clash of lecture periods for the selected if not critically checked \n Do you want to continue?")){
                $('#'+elementid1).val("");
                $('#'+elementid2).val("");
            } 
        }

      }
    });
 }

 //  Checks the hall
  function checkhall(tablename, fieldname, fieldvalue, fieldname1, fieldvalue1, fieldname2, fieldvalue2, fieldname3, fieldvalue3, fieldname4, fieldvalue4,  section, elementid){
    $("#waitprocessing").show();
    var schoolhelp=$("#operatorid").val();

    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename': tablename,
         'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'fieldname1': fieldname1,
        'fieldvalue1': fieldvalue1,
        'fieldname2': fieldname2,
        'fieldvalue2': fieldvalue2,
        'fieldname3': fieldname3,
        'fieldvalue3': fieldvalue3,
        'fieldname4': fieldname4,
        'fieldvalue4': fieldvalue4,    
      },
       
      success: function(response){
        $("#waitprocessing").hide();
        
        msgresponse=$.trim(response);
        if (msgresponse!="") {
           if(!confirm(msgresponse+" \n Confirmation of this may cause clash of lectures/classes hall in the Timetable if not critically checked \n Do you want to continue?")){
                $('#'+elementid).val("");
            } 
        }
        
      }
    });
 }

 //  Checks the the hall
  function checkhall2(tablename, fieldname, fieldvalue, fieldname1, fieldvalue1, fieldname2, fieldvalue2, fieldname3, fieldvalue3, fieldname4, fieldvalue4, fieldname5, fieldvalue5, section, elementid){
    $("#waitprocessing").show();

    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename': tablename,
         'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'fieldname1': fieldname1,
        'fieldvalue1': fieldvalue1,
        'fieldname2': fieldname2,
        'fieldvalue2': fieldvalue2,
        'fieldname3': fieldname3,
        'fieldvalue3': fieldvalue3,
        'fieldname4': fieldname4,
        'fieldvalue4': fieldvalue4, 
        'fieldname5': fieldname5,
        'fieldvalue5': fieldvalue5,    
      },
       
      success: function(response){
        $("#waitprocessing").hide();
        
        msgresponse=$.trim(response);
        if (msgresponse!="") {
           if(!confirm(msgresponse+" \n Confirmation of this may cause clash of lectures/classes hall in the Timetable if not critically checked \n Do you want to continue?")){
                $('#'+elementid).val("");
            } 
        }
        
      }
    });
 }
  //  Checks the changed date whether lecture periods has been added under it
  
  function checkdate(tablename, fieldname, fieldvalue, fieldname1, fieldvalue1, fieldname2, fieldvalue2,  section, elementid){
    $("#waitprocessing").show();
    var schoolhelp=$("#operatorid").val();

    $.ajax({
      url: 'phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename': tablename,
         'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'fieldname1': fieldname1,
        'fieldvalue1': fieldvalue1,
        'fieldname2': fieldname2,
        'fieldvalue2': fieldvalue2,
        
      },
       
      success: function(response){
        $("#waitprocessing").hide();
        
        msgresponse=$.trim(response);
        if (msgresponse>0) {
         
           if(!confirm(response+" Timetable(period) had been added already under this date, \n Please try entering another Timetable Period \n Confirmation of this may cause duplicates of lecture periods in the Timetable if not critically checked \n Do you want to continue?")){
                $('#'+elementid).html("");
            } 
        }
        
      }
    });
 }

 // copyweek('timetableweek', 'dailytimetable', 'timetablesemesterid', this.value, 'copyweek', 'weekscontainer')
  function copyweek(tablename, tablename1, fieldname, fieldvalue, section, elementid){
    $("#waitprocessing").show();
    
    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename': tablename,
        'tablename1': tablename1,
         'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        

      },
       
      success: function(response){
        $("#waitprocessing").hide();
         msgresponse=$.trim(response);
        $('#'+elementid).html(msgresponse);
      }
    });
 }

 function getdepartmenttype(tablename, fieldname, fieldvalue, section, elementid){
    $("#waitprocessing").show();
    
    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename': tablename,
         'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        

      },
       
      success: function(response){
        $("#waitprocessing").hide();
         msgresponse=$.trim(response);
        $('#'+elementid).html(msgresponse);
      }
    });
 }

 function funcedit(schoolhelp, id){

       if (confirm("Alteration of this record may cause issues, if not critically viewed!!! \n Do you wish to continue?")) {
          window.location.href="?page=3&schoolhelp="+schoolhelp+"&id="+id;
        }
}



function funcprint(schoolhelp, id){

       if (confirm("Do you really want to print this record?")) {
          window.location.href="?page=5&schoolhelp="+schoolhelp+"&id="+id;
        }
}

  function funcactivate(schoolhelp, id){

       if (confirm("Do you really want to activate this Semester?")) {
          window.location.href="?page=6&schoolhelp="+schoolhelp+"&id="+id;
        }
}



function funcdelete(schoolhelp, id, passport){
       if (confirm("Deletion of this record may cause serious issue in time to come, Do you want to continue?")) {
          window.location.href="?page=6&schoolhelp="+schoolhelp+"&id="+id+"&passport="+passport;
        }
}

//redirecting link dailytimetable
function funcedit1(schoolhelp, id){
       if (confirm("Alteration of this record may cause issues, if not critically viewed!!! \n Do you wish to continue?")) {
          window.location.href="dailytimetable?page=3&schoolhelp="+schoolhelp+"&id="+id;
        }
}

function funcprint1(schoolhelp, id){
       if (confirm("Do you really want to print this record?")) {
          window.location.href="dailytimetable?page=5&schoolhelp="+schoolhelp+"&id="+id;
        }
}

function funcdelete1(schoolhelp, id, passport){
       if (confirm("Deletion of this record may cause serious issue in time to come, Do you want to continue?")) {
          window.location.href="dailytimetable?page=6&schoolhelp="+schoolhelp+"&id="+id+"&passport="+passport;
        }
}

   //this checks with one fields
 function updatevalidity(tablename, fieldtitle, tablerowid, returnfieldvalue, fieldname, fieldvalue, action, elementid){

    $("#waitprocessing").show();
    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'tablename': tablename,
        'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'returnfieldvalue':returnfieldvalue,
        'section': 'checkduplicates',
      },
        start: function(response){
       
      },
      success: function(response){
      $("#waitprocessing").hide();
        var msgresponse=$.trim(response);
        
       //msgresponse=parseInt(msgresponse);
       //alert(msgresponse);
        if (action=="updating") {
          if (msgresponse!=tablerowid && msgresponse!="") {
            $("#"+elementid).val("");

                $("#msg").text("This "+fieldtitle+" name has been added already in the database, Please add another "+fieldtitle);
                return true;
            }else{
               return false;
            }
   
        }

         else if (action=="inserting") {
          if (msgresponse>0) {
             $("#"+elementid).val("");
            if (tablename=='instructorcourses'){
            $("#msg").text("This course/Subject has been assign to another instructor, Please click on 'view all' to detached assigned courses/subject from whom it is assigned to");
            }
            else{
                $("#msg").text("This "+tablename+" name has added already in the database, Please add another "+tablename);
            }
          }
           else{
            return false;
          }
        }


      }
    });

 }

 //this checks with two fields
 function updatevalidity1(tablename, fieldtitle, tablerowid, returnfieldvalue, fieldname, fieldvalue, fieldname1, fieldvalue1, action, elementid){

    $("#waitprocessing").show();
    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'tablename': tablename,
        'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'fieldname1': fieldname1,
        'fieldvalue1': fieldvalue1,
        'returnfieldvalue':returnfieldvalue,
        'section': 'checkduplicates1',
      },
        start: function(response){
       
      },
      success: function(response){
      $("#waitprocessing").hide();
        var msgresponse=$.trim(response);
        
       //msgresponse=parseInt(msgresponse);
       //alert(msgresponse);
        if (action=="updating") {
          if (msgresponse!=tablerowid && msgresponse!="") {
            $("#"+elementid).val("");

                $("#msg").text("This "+fieldtitle+" name has been added already in the database, Please add another "+fieldtitle);
            }
   
        }

         else if (action=="inserting") {
          if (msgresponse>0) {
             $("#"+elementid).val("");
            if (tablename=='instructorcourses'){
            $("#msg").text("This course/Subject has been assign to another instructor, Please click on 'view all' to detached assigned courses/subject from whom it is assigned to");
            }
            else{
                $("#msg").text("This "+tablename+" name has added already in the database, Please add another "+tablename);
            }
          }
           else{
            return false;
          }
        }


      }
    });

 }


 //this checks with four fields
 function updatevalidity4(tablename, fieldtitle, tablerowid, returnfieldvalue, fieldname, fieldvalue, fieldname1, fieldvalue1, fieldname2, fieldvalue2, fieldname3, fieldvalue3, action, elementid){
 // alert(tablerowid+"returnfieldvalue" + returnfieldvalue + "fieldname" + fieldname + "fieldvalue" + fieldvalue + "fieldname1" +fieldname1 + "fieldvalue1" + fieldvalue1 + "fieldname2" + fieldname2 + "fieldvalue2" + fieldvalue2 + "fieldname3" + fieldname3 + "fieldvalue3" + fieldvalue3 + "action" +  action + "elementid" + elementid);
 var stateo;
    $("#waitprocessing").show();
    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'tablename': tablename,
        'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'fieldname1': fieldname1,
        'fieldvalue1': fieldvalue1,

         'fieldname2': fieldname2,
        'fieldvalue2': fieldvalue2,
        'fieldname3': fieldname3,
        'fieldvalue3': fieldvalue3,

        'returnfieldvalue':returnfieldvalue,
        'section': 'checkduplicates4',
      },
        start: function(response){
       
      },
      success: function(response){
      $("#waitprocessing").hide();
        var msgresponse=$.trim(response);
        
       //msgresponse=parseInt(msgresponse);
       //alert(msgresponse);
        if (action=="updating") {
          if (msgresponse!=tablerowid && msgresponse!="") {
            $("#"+elementid).val("");

                $("#msg").text("This "+fieldtitle+" has been added already in the database, Please add another "+fieldtitle);
               stateo=false;
            }else{
                stateo=true;
            }
          return stateo;
        }

         else if (action=="inserting") {
          if (msgresponse>0) {
             $("#"+elementid).val("");
            if (tablename=='instructorcourses'){
            $("#msg").text("This course/Subject has been assign to another instructor, Please click on 'view all' to detached assigned courses/subject from whom it is assigned to");
            }
            else{
                $("#msg").text("This "+tablename+" name has added already in the database, Please add another "+tablename);
            }
          }
           else{
            stateo=false;
          }
        }
        return stateo;

      }
    });

 }

//this checks with four fields
 function updatevalidity5(tablename, fieldtitle, tablerowid, returnfieldvalue, fieldname, fieldvalue, fieldname1, fieldvalue1, fieldname2, fieldvalue2, fieldname3, fieldvalue3, fieldname4, fieldvalue4, action, elementid){
 // alert(tablerowid+"returnfieldvalue" + returnfieldvalue + "fieldname" + fieldname + "fieldvalue" + fieldvalue + "fieldname1" +fieldname1 + "fieldvalue1" + fieldvalue1 + "fieldname2" + fieldname2 + "fieldvalue2" + fieldvalue2 + "fieldname3" + fieldname3 + "fieldvalue3" + fieldvalue3 + "action" +  action + "elementid" + elementid);
 var stateo;
    $("#waitprocessing").show();
    $.ajax({
      url: '../phpclass/SHtimetableserver.php',
      type: 'POST',
      data: {
        'tablename': tablename,
        'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'fieldname1': fieldname1,
        'fieldvalue1': fieldvalue1,

         'fieldname2': fieldname2,
        'fieldvalue2': fieldvalue2,
        'fieldname3': fieldname3,
        'fieldvalue3': fieldvalue3,

        'fieldname4': fieldname4,
        'fieldvalue4': fieldvalue4,

        'returnfieldvalue':returnfieldvalue,
        'section': 'checkduplicates5',
      },
        start: function(response){
       
      },
      success: function(response){
      $("#waitprocessing").hide();
        var msgresponse=$.trim(response);
        
       //msgresponse=parseInt(msgresponse);
       alert(msgresponse);
        if (action=="updating") {
          if (msgresponse!=tablerowid && msgresponse!="") {
            $("#"+elementid).val("");

                $("#msg").text("This "+fieldtitle+" has been added already in the database, Please add another "+fieldtitle);
               stateo=false;
            }else{
                stateo=true;
            }
          return stateo;
        }

         else if (action=="inserting") {
          if (msgresponse>0) {
             $("#"+elementid).val("");
            if (tablename=='instructorcourses'){
            $("#msg").text("This course/Subject has been assign to another instructor, Please click on 'view all' to detached assigned courses/subject from whom it is assigned to");
            }
            else{
                $("#msg").text("This "+tablename+" name has added already in the database, Please add another "+tablename);
            }
          }
           else{
            stateo=false;
          }
        }
        return stateo;

      }
    });

 }


function funcactivator(schoolhelp, id, status){
        
       if (confirm("Do you want to make this record active?")) {
          window.location.href="?page=7&schoolhelp="+schoolhelp+"&id="+id+"&status="+status;
        }
}

$("#checkAll").click(function(event) {
    if(this.checked) {
      // Iterate each checkbox
      $('.status1').each(function() {
        this.checked = true;
        $(this).val($(this).attr("id"));
      });
    }
    else {
    $('.status1').each(function() {
        this.checked = false;
        this.value="";
        
      });
    }
  });

function funcactivator(startdate, enddate){
        
       if (startdate>enddate) {
          alert('Start Date is greater than End Date');
          $('#startdate').val('');
        }
}