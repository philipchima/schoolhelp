$(document).ready(function(){

  
//Enable ToolTip
 $('[data-toggle="tooltip"]').tooltip();


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
      url: 'phpclass/SHdashserver.php',
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




//Retrieving a particular table based on check on one fieldname or two fieldname
// Retrieving Some fields
  function retrieveselection(tablename, fieldname, fieldvalue, fieldname1, fieldvalue1, section){
    $("#waitprocessing").show();
    
    $.ajax({
      url: 'phpclass/SHdashserver.php',
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
  function retrieveselection1(tablename, fieldname, fieldvalue, fieldname1, fieldvalue1, section, element2append){
    $("#waitprocessing").show();
    
    $.ajax({
      url: '../phpclass/SHresultserver.php',
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
        $('#'+element2append).html(response);
      }
    });
 }

// Retrieving Some fields for course table experiment done
  function retrieveselection3(tablename, fieldname, fieldvalue, fieldname1, fieldvalue1, section, element2append, whattoretrieve){
    $("#waitprocessing").show();
    
    $.ajax({
      url: 'phpclass/SHdashserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename': tablename,
         'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'fieldname1': fieldname1,
        'fieldvalue1': fieldvalue1,
        'whattoretrieve': whattoretrieve,

      },
       
      success: function(response){
        $("#waitprocessing").hide();
        $('#'+element2append).html(response);
      }
    });
 }

 function funcedit(schoolhelp, id){

       if (confirm("Alteration of this record may cause issues, if not critically viewed!!! \n Do you wish to continue?")) {
          window.location.href="?page=3&schoolhelp="+schoolhelp+"&id="+id;
        }
}

function funceditstudent(schoolhelp, id){

       if (confirm("Please make sure you are not changing the department(school), or level(class) of a student if he or has result already in the system!!! \n Do you wish to continue?")) {
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

function funcdownload(schoolhelp,page,tablename,tablefield,tabledata){

       if (confirm("Are you sure you want to download student excel template for collection of record offline?")) {
          window.location.href="downloadtemplate?page="+page+"&schoolhelp="+schoolhelp+"&tablename="+tablename+"&tablefield="+tablefield+"&tabledata="+tabledata;
        }
}

function funcdelete(schoolhelp, id, passport){

       if (confirm("Deletion of this record may cause serious issue in time to come, Do you want to continue?")) {
          window.location.href="?page=6&schoolhelp="+schoolhelp+"&id="+id+"&passport="+passport;
        }
}

function funcdisengage(schoolhelp, id, guardianid){
     if (confirm("You are about to disengage this Student from the Guardian, Do you want to continue?")) {
          window.location.href="?page=6&schoolhelp="+schoolhelp+"&id="+id+"&guardianid="+guardianid;
        }
}

function funcdeletestudent(schoolhelp, id, passport){

       if (confirm("Caution, Deletion of this student record will cause lost of all his results!!!\n Do you want to continue?")) {
          window.location.href="?page=6&schoolhelp="+schoolhelp+"&id="+id+"&passport="+passport;
        }
}

function funcactivate(schoolhelp, id, accessvalue){
  var msgcontent;
        if (accessvalue=='1') {
         msgcontent= "You are about to stop this Account from logging in to your system!!!\n Do you want to continue?";
        }else{
          msgcontent= "You are about to give access this Account to loggin to your system!!!\n Do you want to continue?";
        }

       if (confirm(msgcontent)) {
          window.location.href="?page=10&schoolhelp="+schoolhelp+"&id="+id+"&accessvalue="+accessvalue;
        }
}

function funcresetpassword(schoolhelp, id){

       if (confirm("Resetting of this person's password to 'password' will automatically disengage this person, if not informed, Do you want to continue?")) {
          window.location.href="?page=9&schoolhelp="+schoolhelp+"&id="+id;
        }
}

function funcdeletestaff(schoolhelp, id, staffid){
       
       if (confirm("Deletion of this record may cause limitation to the Instructor, Do you want to continue?")) {
          window.location.href="?page=6&schoolhelp="+schoolhelp+"&id="+id+"&staffid="+staffid;
        }
}


 function updatevalidity(tablename, fieldname, fieldvalue, action, elementid){

    $("#waitprocessing").show();
    $.ajax({
      url: 'phpclass/SHdashserver.php',
      type: 'POST',
      data: {
        'tablename': tablename,
        'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'section': 'checkduplicates',
      },
        start: function(response){
       
      },
      success: function(response){
      $("#waitprocessing").hide();
        var msgresponse=$.trim(response);
        
        msgresponse=parseInt(msgresponse);
       
        if (action=="updating") {
          if (msgresponse>=1) {
            $("#"+elementid).val("");

            if (tablename=='instructorcourses'){
            $("#msg").text("This course/Subject has been assign to another instructor, Please click on 'view all' to detached assigned courses/subject from whom it is assigned to");
            }
            else{
                $("#msg").text("This "+tablename+" name has added already in the database, Please add another "+tablename);
            }

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

 function updatevalidity1(tablename, fieldname, fieldname1, fieldvalue, fieldvalue1, action, elementid){
    $("#waitprocessing").css({"position": "fixed", "top": "100px"});
    $("#waitprocessing").show();
    $.ajax({
      url: 'phpclass/SHdashserver.php',
      type: 'POST',
      data: {
        'tablename': tablename,
        'fieldname': fieldname,
        'fieldname1': fieldname1,
        'fieldvalue': fieldvalue,
        'fieldvalue1': fieldvalue1,
        'section': 'checkduplicates1',
      },
        start: function(response){
       
      },
      success: function(response){

      $("#waitprocessing").hide();
        var msgresponse=$.trim(response);
        //alert(msgresponse);
        msgresponse=parseInt(msgresponse);
       
        if (action=="updating") {
          if (msgresponse>=1) {
            $("#"+elementid).val("");
            $("#msg").text("This "+tablename+" name has added already in the database, Please add another "+tablename);
            alert("This "+tablename+" name has added already in the database");
            return true;
          }else{
            return false;
          }
        }

         else if (action=="inserting") {
          if (msgresponse>0) {
             $("#"+elementid).val("");
            $("#msg").text("This "+tablename+" name has added already in the database, Please add another "+tablename);
            alert("This "+tablename+" name has added already in the database");
            return true;
          }
           else{
            return false;
          }
        }


      }
    });

 }


// To Add assessment whether it is more than 100
function addition(fieldname) {
  var val1, total=0;
    $('input[name^='+fieldname+']').each(function() {
     val1=parseInt($(this).val());
     total=total+val1;
      
    });

 if (total>100) {
          alert("The  Total Assessment Value "+total+"; Accumulation must not exceed 100");
          $('input[name^='+fieldname+']').each(function() {
            $(this).val('');
          });
          return true;
        }else{
          return false;
        }
}

//Loading of image





function printmarked(){
    
    if(!confirm('Are you sure you want to print ID Card ?'))
    {return false;}
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