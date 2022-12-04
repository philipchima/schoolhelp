$(document).ready(function(){

   
 
//Enable ToolTip
 $('[data-toggle="tooltip"]').tooltip();

$("#camera").hide();

jQuery(function($) { 'use strict';
            $("#printrecord").find('.print-link').on('click', function() {
                //Print ele2 with default options
                $.print("#printrecord");
            });
            
            // Fork https://github.com/sathvikp/jQuery.print for the full list of options
        });


  });


function checkno(thisstudent) { 
  
    if(thisstudent==1) {
      // Iterate each checkbox
      $('.status1').each(function() {
        this.checked = true;
        
      });
    }
    else {
    $('.status1').each(function() {
        this.checked = false;
        
        
      });
    }
  };


//Retrieving a particular table based on check on one fieldname or two fieldname
// Retrieving Some fields
  function retrievemultistudent(tablename, fieldname, fieldvalue, admintype, logindepartmentid, elementid, section){
    $("#waitprocessing").show();

    $.ajax({
      url: '../phpclass/SHmessageserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename': tablename,
         'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'admintype': admintype,
        'logindepartmentid': logindepartmentid,
       
      },
       
      success: function(response){
        $("#waitprocessing").hide();
        $('#'+elementid).html(response);
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
      url: '../phpclass/SHmessageserver.php',
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

 // Calling of Pictures
  function picture_call(original, section){
    $("#waitprocessing").show();
   
    $.ajax({
      url: '../phpclass/SHmessageserver.php',
      type: 'POST',
      data: {
        'section':section,
      },
       
      success: function(response){
       $("#waitprocessing").hide();
      
       response=$.trim(response);
       if (response!="") {
        
          $("#"+original).show();

          $("#camphoto").val(response);

          $('#'+original)
          .attr('src', 'uploads/original/'+response)
          .width(100)
          .height(100);
       }
      
      }
    });
 }

 // Retrieving Some fields for course table experiment done
  function retrieveselectionmulti1(tablename, fieldname, fieldvalue, fieldname1, fieldvalue1, section, element2append){
    $("#waitprocessing").show();
    
    $.ajax({
      url: '../phpclass/SHmessageserver.php',
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
      url: '../phpclass/SHmessageserver.php',
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

// Retrieving Some fields for course table experiment done
  function retrieveselectionmulti3(tablename, fieldname, fieldvalue, fieldname1, fieldvalue1, section, element2append, whattoretrieve){
    $("#waitprocessing").show();
    
    $.ajax({
      url: '../phpclass/SHmessageserver.php',
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



function funcprint(schoolhelp, id){

       if (confirm("Do you really want to print this record?")) {
          window.location.href="?page=5&schoolhelp="+schoolhelp+"&id="+id;
        }
}

function funcprintm(schoolhelp, id, optionid, levelid, type){

       if (confirm("Do you really want to print this record?")) {
          window.location.href="?page=5&schoolhelp="+schoolhelp+"&id="+id+"&levelid="+levelid+"&type="+type+"&optionid="+optionid;
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

function funcactivatem(schoolhelp, id, accessvalue, optionid, levelid, type){
  var msgcontent;
        if (accessvalue=='1') {
         msgcontent= "You are about to stop this Account from logging in to your system!!!\n Do you want to continue?";
        }else{
          msgcontent= "You are about to give access this Account to loggin to your system!!!\n Do you want to continue?";
        }

       if (confirm(msgcontent)) {
          window.location.href="?page=10&schoolhelp="+schoolhelp+"&id="+id+"&accessvalue="+accessvalue+"&levelid="+levelid+"&type="+type+"&optionid="+optionid;
        }
}




function funcactivator(schoolhelp, id, status){
        
       if (confirm("Do you want to make this record active?")) {
          window.location.href="?page=7&schoolhelp="+schoolhelp+"&id="+id+"&status="+status;
        }
}


 function updatevalidity(tablename, fieldname, fieldvalue, action, elementid){

    $("#waitprocessing").show();
    $.ajax({
      url: '../phpclass/SHmessageserver.php',
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
      url: '../phpclass/SHmessageserver.php',
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

  function check2flds_in_a_tbl(tablename, fieldname, fieldname1, fieldvalue, fieldvalue1, action, section, elementid){
    $("#waitprocessing").css({"position": "fixed", "top": "100px"});
    $("#waitprocessing").show();
    $.ajax({
      url: '../phpclass/SHmessageserver.php',
      type: 'POST',
      data: {
        'tablename': tablename,
        'fieldname': fieldname,
        'fieldname1': fieldname1,
        'fieldvalue': fieldvalue,
        'fieldvalue1': fieldvalue1,
        'section': section,
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
            $("#"+elementid).prop("checked", false);
            $("#"+elementid).val(0)
            $("#msg").text("This "+tablename+" has been added already in the database, Please add another "+tablename);
            alert("This "+tablename+" name has added already in the database");
            return true;
          }else{
            return false;
          }
        }

         else if (action=="inserting") {
          if (msgresponse>0) {
             $("#"+elementid).prop("checked", false);
             $("#"+elementid).val(0);
            $("#msg").text("This "+tablename+"  has been added already in the database, Please add another "+tablename);
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




