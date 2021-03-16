$( document ).ready(function() {
    
   // alert('I\'m in');
   //-----------------------------------------------Hide onload--------------------------------------
   
      setTimeout(function() {
      $('#check_document a').hide();
      //console.log('sad');
       }, 10);
      
       $('.pagination').hide();
       $('.saveAndContinue').hide();
       $('input[value="View Change Log"]').hide();
       $('#btn_approver_c,#btn_clr_approver_c').hide();
       $('#btn_assigned_user_name,#btn_clr_assigned_user_name').hide();
       $('#btn_parent_name,#follow_up_date_c_trigger').hide();
       $('#tagged_hidden_c,[data-label="LBL_TAGGED_HIDDEN"]').hide();  
       
   //-----------------------------------------------Hide onload--------------------------------------
   
          $('#approver_c').attr('readonly',true);
          $('#assigned_user_name').attr('readonly',true);
          
           $('#parent_name').on('click', function(e) {
        
            $('#btn_parent_name').trigger('click');
        })
          
           $("#follow_up_date_c").datepicker({
                 dateFormat: 'dd/mm/yy',
                 changeYear: true,
                 changeMonth: true,
           }); 
           
           
           
           
  
          
   //------------------------for global----------------------
   
    var doc_id=$('input[name=record]').val();
    var doc_type=$('#activity_type_c').val();
    var assigned_id=$('#assigned_user_id').val();
    var approver_id=$('#user_id_c').val();
    var assigned_name=$('#assigned_user_name').val();
    
   //------------------------for global----------------------
   
   //---------Approver----------------------------------
   
             // $.ajax({
             //    url : 'index.php?module=Documents&action=fetch_reporting_manager',
             //    type : 'POST',
             //    dataType: "json",
             //     data:{
                  
             //     assigned_name,
             //     assigned_id
             //    },
             //    success : function(data){
                 
             //      $('#approver_c').val(data.reporting_name);
             //      $('#user_id_c').val(data.reporting_id);
                  
             //     }
     
             // });
 
   //---------Approver----------------------------------
   
   
  if(doc_id == ""){
        
      $(".panel-heading:contains('Tag Users') ,#detailpanel_0").hide(); 
  }
  
   if(doc_id != ""){
        
      
           
             //     $.ajax({
             //    url : 'index.php?module=Documents&action=tagged_users_list',
             //    type : 'POST',
             //    dataType: "json",
             //    data:{
             //     doc_id,
             //     assigned_id,
             //    approver_id
             //    },
                 
             //    success : function(data){
                 
             //      // $("#tagged_users_c").attr("disabled",false);
             //        $('[field=tagged_users_c]').html('<div class="demo2"><select id="tagged_users_c"  name="" multiple ></select></div>');
                    
             //                            var  data1 ="";
   
             //          if(data.status == true){
             //            var i;
             //            var text = '';
                        
             //              //console.log(data.user_id);
             //                 //console.log(data.other_user_id);
             //                  //console.log(data.other_user_id.includes(data.user_id[i]));
             //                for (i = 0; i<data.user_id.length; i++) {
                            
             //                    if(data.other_user_id.includes(data.user_id[i])){
                               
             //                        text +=  '<option value="'+data.user_id[i]+'" selected>'+data.name[i]+' / '+data.email[i]+'</option>'
                               
                                 
             //                    }else{
                                
             //                        text +=  '<option value="'+data.user_id[i]+'">'+data.name[i]+' / '+data.email[i]+'</option>'
                                    
             //                    }
             //                }
                            
                            
                        
                        
                                                           
             //         //   console.log(text);
                        
             //            // $("#select_approver_c").append(text1);
             //             $("#tagged_users_c").append(text);
                         
             //            $('.demo2').dropdown({});
                        
             //          }
             //          else{
             //                for (i = 0; i<data.user_id.length; i++) {
                                
             //                        text +=  '<option value="'+data.user_id[i]+'">'+data.name[i]+' / '+data.email[i]+'</option>'
             //                }
             //                    }
                 
             //    }
              
             // });
             
           
  }
  
  
  
     //-----------------------tag  users id----------------------------------------------- 

$(document).on('click', function () {


        
       var tag1=$("#tagged_users_c").val();
       
       if(tag1!=null){
        
       var tag=tag1.join();
       
       $('#tagged_hidden_c').val(tag);
       
       }else{
           
            $('#tag_hidden_c').val('');
       }
});
//-----------------------tag  users id--------------END---------------------------------  

 
 
  
});