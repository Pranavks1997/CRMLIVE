
$(document).ready(function(){
   
     $('#fp_user_name').hide(); 
   
    $('#fp_user_mail').on("change",function(){
        $('#fp_user_name').val($(this).val());
    });
   
   
    
});