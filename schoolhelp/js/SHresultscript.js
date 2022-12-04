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

//Deleting a score 4rm score and result table
  function deleteresult(section, table1, table2, label1, content1, label2, content2, label3, content3, label4, content4, label5, content5, label6, content6){

    if (confirm("Alteration of this record may cause issues, Please make sure result is updated immediately!!! \n Do you wish to continue?")) {

           $.ajax({
      url: '../phpclass/SHresultserver.php',
      type: 'POST',
      data: {
        
        'section':section,
        'table1': table1,
        'table2': table2,
        'label1': label1,
        'content1': content1,
        'label2': label2,
        'content2': content2,
        'label3': label3,
        'content3': content3,
        'label4': label4,
        'content4': content4,
        'label5': label5,
        'content5': content5,
        'label6': label6,
        'content6': content6,
      },
       
      success: function(response){
        $("#deleteresult"+content1).hide();
        alert(response);
      }
    });
         
  }

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

function funcdeleteresultc(schoolhelp, stid, studeptid, levelid, optionid, semesterid, sessionid){
       
       if (confirm("Deletion of this record delete his/her result for the selection term and section, Do you want to continue?")) {
          window.location.href="?page=6&schoolhelp="+schoolhelp+"&stid="+stid+"&studeptid="+studeptid+"&levelid="+levelid+"&optionid="+optionid+"&semesterid="+semesterid+"&sessionid="+sessionid;
        }
}

/*function funcdeletestaff(schoolhelp, id, staffid){
       
       if (confirm("Deletion of this record may cause limitation to the Instructor, Do you want to continue?")) {
          window.location.href="?page=6&schoolhelp="+schoolhelp+"&id="+id+"&staffid="+staffid;
        }
}*/

function checkscore(id, pervalue1){
  pervalue=parseInt(pervalue1);

  if(id.value==""){
    return true
  }
   if(id.value >pervalue){
     alert ("Score inputed by you is greater than the assigned score");
     id.value="";
     id.focus();
     return false
     }
     
     if(isNaN(id.value)){
        alert ("Score inputed by you is not a valid Number");
     id.value="";
     id.focus();
     return false
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

function readURL(input, inputid, imagename) {

              //binds to onchange event of your input field
              if ($('input:submit').attr('disabled',false)){
               $('input:submit').attr('disabled',true);
               }
              var ext = $('#'+inputid).val().split('.').pop().toLowerCase();
              if ($.inArray(ext, ['gif','png','jpg','jpeg']) == -1){
                $('#'+inputid).val("");
               $('#error1').slideDown("slow");
               $('#error2').slideUp("slow");
               a=0;
               }else{
               var picsize = (input.files[0].size);
               if (picsize > 1000000){
                $('#'+inputid).val("");
               $('#error2').slideDown("slow");
               a=0;
               }else{
               a=1;
               $('#error2').slideUp("slow");
               }
               $('#error1').slideUp("slow");
               if (a==1){
               $('input:submit').attr('disabled',false);

               //Please the image in the right place
                if (input.files && input.files[0]) {
                $("#"+imagename).show();
                  var reader = new FileReader();

                  reader.onload = function (e) {
                      $('#'+imagename)
                          .attr('src', e.target.result)
                          .width(100)
                          .height(100);
                  };

                  reader.readAsDataURL(input.files[0]);
              }

               }
         }
}

function readexcelfile(input, inputid, imagename) {

              //binds to onchange event of your input field
              if ($('input:submit').attr('disabled',false)){
               $('input:submit').attr('disabled',true);
               }
              var ext = $('#'+inputid).val().split('.').pop().toLowerCase();
              if ($.inArray(ext, ['csv','xls']) == -1){
                $('#'+inputid).val("");
               $('#error1').slideDown("slow");
               $('#error2').slideUp("slow");
               a=0;
               }else{
               var picsize = (input.files[0].size);
               if (picsize > 10000000){
                $('#'+inputid).val("");
               $('#error2').slideDown("slow");
               a=0;
               }else{
               a=1;
               $('#error2').slideUp("slow");
               }
               $('#error1').slideUp("slow");
               if (a==1){
               $('input:submit').attr('disabled',false);

               //Please the image in the right place
                if (input.files && input.files[0]) {
                $("#"+imagename).show();
                  //var reader = new FileReader();

                  //reader.onload = function (e) {
                      $('#'+imagename)
                          .attr('src', 'images/excel.png')
                          .width(100)
                          .height(100);
                  //};

                 // reader.readAsDataURL(input.files[0]);
              }

               }
         }
}


function uploadassessment(tablename, fieldname, fieldvalue, fieldname1, fieldvalue1, fieldname2, fieldvalue2, fieldname3, fieldvalue3, fieldname4, fieldvalue4, fieldname5, fieldvalue5, fieldname6, fieldvalue6, fieldname7, fieldvalue7, fieldname8, fieldvalue8, fieldname9, fieldvalue9, fieldname0, fieldvalue0, section){
  
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
         'fieldname0': fieldname0,
        'fieldvalue0': fieldvalue0,
      },
       
      success: function(response){
        $("#waitprocessing").hide();
        response=$.trim(response);
        alert(response);
      }
    });
  
  }

//tablename, scoreidfieldname, scoreid, scorefieldname, scorevalue,  operatoridfieldname, operatorid, udatefieldname, '<?php echo date("Y-m-d H:i:s") ?>') assessmentupdate
function updateassessment(tablename, fieldname, fieldvalue, fieldname1, fieldvalue1, fieldname2, fieldvalue2, fieldname3, fieldvalue3, section){
  
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
        'fieldname2': fieldname2,
        'fieldvalue2': fieldvalue2,
         'fieldname3': fieldname3,
        'fieldvalue3': fieldvalue3,
      },
       
      success: function(response){
        $("#waitprocessing").hide();
        response=$.trim(response);
        alert(response);
      }
    });
  
  }
  
  function deleteassessment(tablename, fieldname, fieldvalue, section){
  alert(fieldvalue);
   $("#waitprocessing").show();
    
    $.ajax({
      url: '../phpclass/SHresultserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename': tablename,
         'fieldname': fieldname,
        'fieldvalue': fieldvalue,
       
      },
       
      success: function(response){
        $("#waitprocessing").hide();
  $("#"+fieldvalue).hide();
        response=$.trim(response);
        alert(response);
      }
    });

  }

//Getting Detials from resultdomain table and attendacemark table 
   function domaingrade_attendance(departmentid, positionid, section){
  
  
   $("#waitprocessing").show();
    
    $.ajax({
      url: '../phpclass/SHresultserver.php',
      type: 'POST',
      data: {
        'section':section,
        'departmentid': departmentid,
        'positionid': positionid,
        'section': section,
       
      },
       
      success: function(response){
       
        $("#waitprocessing").hide();
        $("#myModalbutton").trigger("click");
        $("#domaincontent").html(response);
        //alert(response);
      }
    });
    return false;
  }


   function loadgrouppromote(tablename, fieldname, fieldvalue, section, elementid){

     $("#waitprocessing").show();
   
    //declare a variable that collects the value in the select container
    if(fieldvalue=="")
    {
      $('#container').html("<strong> No value selected for the search record");
      return false;
    }

      $.ajax({
      url: '../phpclass/SHresultserver.php',
      type: 'POST',
      data: {
        'section':section,
        'tablename': tablename,
         'fieldname': fieldname,
        'fieldvalue': fieldvalue,
       
      },
       
      success: function(response){
        $("#waitprocessing").hide();

        response=$.trim(response);
        alert(response);
        $("#"+elementid).html(response);
         $("#promotbutton").prop('disabled', true); 
        
      }
    });

   
    return false;
  }

    function generateresult(schoolhelp, page) {
                      
           document.frmscoresheet.action="scoresheet?schoolhelp="+schoolhelp+"&page="+page;
          document.frmscoresheet.method = "post";
          document.frmscoresheet.submit()  ;
          return false;
        }


    function broadsheet(schoolhelp, page) {
                      
          document.frmscoresheet.action="printbroadsheet?schoolhelp="+schoolhelp+"&page="+page;
          document.frmscoresheet.method = "post";
          document.frmscoresheet.submit()  ;
          return false;
        }

  function broadsheet1(schoolhelp, page) {
                      
          document.frmscoresheet.action="printbroadsheet1?schoolhelp="+schoolhelp+"&page="+page;
          document.frmscoresheet.method = "post";
          document.frmscoresheet.submit()  ;
          return false;
        }

function funcactivator(schoolhelp, id, status){
        
       if (confirm("Do you want to make this record active?")) {
          window.location.href="?page=7&schoolhelp="+schoolhelp+"&id="+id+"&status="+status;
        }
}
//This method is for promotion page
function enablingbutton(uibutton){
      $("#"+uibutton).prop('disabled', false); 
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