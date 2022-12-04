$(document).ready(function(){
jQuery(function($) { 'use strict';
            $("#printrecord").find('.print-link').on('click', function() {
                //Print ele2 with default options
                $.print("#printrecord");
            });
            
            // Fork https://github.com/sathvikp/jQuery.print for the full list of options
        });


  });


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