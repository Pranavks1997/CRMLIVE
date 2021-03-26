$( document ).ready(function() {
    
     setTimeout(function() {
      $('#check_document a').show();
      //console.log('sad');
       }, 20);
      var doc_id=$('input[name=record]').val();
     var approver_id=$('#user_id_c').val();
    var approver_name=$('#approver_c').val();
    var assigned_name=$('#assigned_user_name').val();
   
   $('#status_c  input[type=text]').attr('readonly',true);
            $('#parent_name,#parent_type,#btn_clr_parent_name').prop('disabled', true);

   
        
   
 if(approver_name==assigned_name){
    
     $('[field="status_c"] input[type=text]').val('Approved');
      }
      else{
     $('[field="status_c"] input[type=text]').val('Upload');
      }
   
   
    
    
//*********************************Write code above this line*********************************************    
})