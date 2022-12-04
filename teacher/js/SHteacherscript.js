$(document).ready(function(){
jQuery(function($) { 'use strict';
            $("#printrecord").find('.print-link').on('click', function() {
                //Print ele2 with default options
                $.print("#printrecord");
            });
            
            // Fork https://github.com/sathvikp/jQuery.print for the full list of options
        });


  });

   // Retrieving Some fields for course table experiment done
   function retrieveselection1(tablename, fieldname, fieldvalue, fieldname1, fieldvalue1, section, element2append){
   
    $("#waitprocessing").show();
    
    $.ajax({
      url: 'phpclass/SHteacherserver.php',
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


// Retrieving Some fields
  function addingfields(tabletoadd, tabletoaddfield, tabletocheck, tabletocheckfield, tabletocheckgetfield, tabletocheckid, section){
    $("#waitprocessing").show();
    
    $.ajax({
      url: 'phpclass/SHteacherserver.php',
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
      url: 'phpclass/SHteacherserver.php',
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
  function retrieveselection3(tablename, fieldname, fieldvalue, fieldname1, fieldvalue1, section, element2append, whattoretrieve){
    $("#waitprocessing").show();
    
    $.ajax({
      url: 'phpclass/SHteacherserver.php',
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

function uploadassessment(tablename, fieldname, fieldvalue, fieldname1, fieldvalue1, fieldname2, fieldvalue2, fieldname3, fieldvalue3, fieldname4, fieldvalue4, fieldname5, fieldvalue5, fieldname6, fieldvalue6, fieldname7, fieldvalue7, fieldname8, fieldvalue8, fieldname9, fieldvalue9, fieldname0, fieldvalue0, section){
  
    $("#waitprocessing").show();
    
    $.ajax({
      url: 'phpclass/SHteacherserver.php',
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

 
function funcprint(schoolhelp, id){

       if (confirm("Do you really want to print this record?")) {
          window.location.href="?page=5&schoolhelp="+schoolhelp+"&id="+id;
        }
}

 
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

//tablename, scoreidfieldname, scoreid, scorefieldname, scorevalue,  operatoridfieldname, operatorid, udatefieldname, '<?php echo date("Y-m-d H:i:s") ?>') assessmentupdate
function updateassessment(tablename, fieldname, fieldvalue, fieldname1, fieldvalue1, fieldname2, fieldvalue2, fieldname3, fieldvalue3, section){
  
    $("#waitprocessing").show();
    
    $.ajax({
      url: 'phpclass/SHteacherserver.php',
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
      url: 'phpclass/SHteacherserver.php',
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
      url: 'phpclass/SHteacherserver.php',
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

function funcactivator(schoolhelp, id, status){
        
       if (confirm("Do you want to make this record active?")) {
          window.location.href="?page=7&schoolhelp="+schoolhelp+"&id="+id+"&status="+status;
        }
}

function relocate(refno){
          window.location.href="teacherschangepassword?refno="+refno;
}

function logout(refno){
          window.location.href="logout?refno="+refno;
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

function validatefile(){

  
 // get the file name, possibly with path (depends on browser)
        var filename = $("#file_input").val();

        // Use a regular expression to trim everything before final dot
        var extension = filename.replace(/^.*\./, '');

        // Iff there is no dot anywhere in filename, we would have extension == filename,
        // so we account for this possibility now
        if (extension == filename) {
            extension = '';
        } else {
            // if there is an extension, we convert to lower case
            // (N.B. this conversion will not effect the value of the extension
            // on the file upload.)
            extension = extension.toLowerCase();
        }

        switch (extension) {
            case 'docx':
            case 'doc':
            case 'pdf':
            case 'jpg':
            case 'txt':
            case 'png':
                alert("Right File selected, Are you sure you want to submit");
        jQuery.alerts.okButton = 'Yes';
    jQuery.alerts.cancelButton = 'No';                  
    jConfirm('Right selected, Are you sure??',  '', function(r) {
    if (r == true) {                    
        //Ok button pressed...
    return true
      }  
    });
      
            // uncomment the next line to allow the form to submitted in this case:
//          break;

            default:
      alert("Invalid extension");
      return false;
                // Cancel the form submission
    }
 }
 
 function validatefile1(){
  
 // get the file name, possibly with path (depends on browser)
        var filename = $("#file_input1").val();

        // Use a regular expression to trim everything before final dot
        var extension = filename.replace(/^.*\./, '');

        // Iff there is no dot anywhere in filename, we would have extension == filename,
        // so we account for this possibility now
        if (extension == filename) {
            extension = '';
        } else {
            // if there is an extension, we convert to lower case
            // (N.B. this conversion will not effect the value of the extension
            // on the file upload.)
            extension = extension.toLowerCase();
        }

        switch (extension) {
            case 'docx':
            case 'doc':
            case 'pdf':
            case 'jpg':
            case 'txt':
            case 'png':
                alert("Right File selected, Are you sure you want to submit");
        jQuery.alerts.okButton = 'Yes';
    jQuery.alerts.cancelButton = 'No';                  
    jConfirm('Right selected, Are you sure??',  '', function(r) {
    if (r == true) {                    
        //Ok button pressed...
    return true
      }  
    });
      
            // uncomment the next line to allow the form to submitted in this case:
//          break;

            default:
      alert("Invalid extension");
      return false;
                // Cancel the form submission
    }
 }

  //Exploring a Documnent
  $('a.embed').gdocsViewer({width: 1, height: 1});
  $('#embedURL').gdocsViewer();
 //ending

 function funcdelete(staffid, classinfo, recordid, filename){
       if (confirm("Deletion of this record may cause incompleteness in the uncompleted process!!!\n Do you want to continue?")) {
          window.location.href="?page=6&refno="+staffid+"&tcid="+classinfo+"&filename="+filename+"&recordid="+recordid;

        }
}

function funcedit(staffid, classinfo, recordid){
       if (confirm("Alteration of this record may cause incompleteness in the uncompleted process!!!\n Do you want to continue?")) {
          window.location.href="?page=3&refno="+staffid+"&tcid="+classinfo+"&recordid="+recordid;

        }
}

function funcdelete1(staffid, gid, classid, recordid, filename){
       if (confirm("Deletion of this record may cause incompleteness in the uncompleted process!!!\n Do you want to continue?")) {
          window.location.href="?page=6&refno="+staffid+"&gid="+gid+"&class="+classid+"&filename="+filename+"&recordid="+recordid;

        }
}

function funcedit1(staffid, gid, classid, recordid){
       if (confirm("Alteration of this record may cause incompleteness in the uncompleted process!!!\n Do you want to continue?")) {
          window.location.href="?page=3&refno="+staffid+"&gid="+gid+"&class="+classid+"&recordid="+recordid;

        }
}

function generateresult(refno, levelid, optionid, page) {
                      
           document.frmscoresheet.action="?refno="+refno+"&page="+page+"&class="+levelid+"&group="+optionid;
          document.frmscoresheet.method = "post";
          document.frmscoresheet.submit()  ;
          return false;
        }

  function broadsheet(refno, levelid, optionid, page) {
                      
          document.frmscoresheet.action="printbroadsheet?refno="+refno+"&page="+page+"&classid="+levelid+"&groupid="+optionid;
          document.frmscoresheet.method = "post";
          document.frmscoresheet.submit()  ;
          return false;
        }
