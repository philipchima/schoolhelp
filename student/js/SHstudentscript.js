$(document).ready(function(){
jQuery(function($) { 'use strict';
            $("#printrecord").find('.print-link').on('click', function() {
                //Print ele2 with default options
                $.print("#printrecord");
            });
            
            // Fork https://github.com/sathvikp/jQuery.print for the full list of options
        });


  });



 
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



function funcactivator(schoolhelp, id, status){
        
       if (confirm("Do you want to make this record active?")) {
          window.location.href="?page=7&schoolhelp="+schoolhelp+"&id="+id+"&status="+status;
        }
}

function relocate(refno){
          window.location.href="studentchangepassword?refno="+refno;
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