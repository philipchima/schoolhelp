$(document).ready(function(){
jQuery(function($) { 'use strict';
            $("#printrecord").find('.print-link').on('click', function() {
                //Print ele2 with default options
                $.print("#printrecord");
            });
            
            // Fork https://github.com/sathvikp/jQuery.print for the full list of options
        });


  });


function inputdatalist(inputlistlistlabel, inputlistid, element2receive){
 $("#"+element2receive).val("");
shownVal = document.getElementById(inputlistlistlabel).value;
var value2send = document.querySelector("#"+inputlistid+" option[value='"+shownVal+"']").dataset.value;
$("#"+element2receive).val(value2send);
}



function funcactivator(schoolhelp, id, status){
        
       if (confirm("Do you want to make this record active?")) {
          window.location.href="?page=7&schoolhelp="+schoolhelp+"&id="+id+"&status="+status;
        }
}

 function funcedit(schoolhelp, id){

       if (confirm("Alteration of this record may cause issues, if not critically viewed!!! \n Do you wish to continue?")) {
          window.location.href="?page=3&schoolhelp="+schoolhelp+"&id="+id;
        }
}

function funcdelete(schoolhelp, id){

       if (confirm("Alteration of this record may cause issues, if not critically viewed!!! \n Do you wish to continue?")) {
          window.location.href="?page=6&schoolhelp="+schoolhelp+"&id="+id;
        }
}


function funcprint(schoolhelp, id){

       if (confirm("Do you really want to print this record?")) {
          window.location.href="?page=5&schoolhelp="+schoolhelp+"&id="+id;
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


// Retrieving Some fields for course table experiment done
  function retrieveselection1(tablename, fieldname, fieldvalue, fieldname1, fieldvalue1, section, element2append){
    $("#waitprocessing").show();
    
    $.ajax({
      url: '../phpclass/SHbusaryserver.php',
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


// Retrieving Some fields
  function retrieveselection(tablename, fieldname, fieldvalue, fieldcount, contentelementid, section, requestedfield1, requestedfield2, requestedelementname, requestedelementtitle, errormessage){
    $("#waitprocessing").show();
    
    
    $.ajax({
      url: '../phpclass/SHbusaryserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename': tablename,
        'fieldname': fieldname,
        'fieldvalue': fieldvalue,
        'fieldcount':fieldcount,

        'requestedfield1': requestedfield1,
        'requestedfield2': requestedfield2,
        'requestedelementname': requestedelementname,
        'requestedelementtitle': requestedelementtitle,
        'errormessage': errormessage,
      },
       
      success: function(response){
        $("#waitprocessing").hide();
        $('#'+contentelementid).html(response);
      }
    });
 }

 //this checks with two fields
 function updatevalidity2(tablename, fieldtitle, tablerowid, returnfieldvalue, fieldname, fieldvalue, fieldname1, fieldvalue1, action, elementid){

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

 function updatevalidity1(tablename, fieldname, fieldvalue, fieldname1, fieldvalue1, action, elementid, pagename, returnfieldvalue, actualid){
    $("#waitprocessing").css({"position": "fixed", "top": "100px"});
    $("#waitprocessing").show();

    $.ajax({
      url: '../phpclass/SHbusaryserver.php',
      type: 'POST',
      data: {
        'tablename': tablename,
        'fieldname': fieldname,
        'fieldname1': fieldname1,
        'fieldvalue': fieldvalue,
        'fieldvalue1': fieldvalue1,
        'returnfieldvalue': returnfieldvalue,
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
          if (actualid!=msgresponse && msgresponse!=0) {
            $("#"+elementid).val("");
            $("#msg").text("This "+pagename+" name has been added already in the database, Please add another "+pagename);
            alert("This "+tablename+" name has been added already in the database");
            return true;
          }else{
            return false;
          }
        }

         else if (action=="inserting") {
          if (msgresponse>0) {
             $("#"+elementid).val("");
            $("#msg").text("This "+pagename+" name has been added already in the database, Please add another "+pagename);
            alert("This "+tablename+" name has been added already in the database");
            return true;
          }
           else{
            return false;
          }
        }


      }
    });

 }