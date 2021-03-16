
$(document).ready(function(){
  $('#tab2').hide();
  $('#tab6').hide();
  
   $('#tab4').hide();
    $('#tab5').hide();
    $('#user_name').hide();
    $('[data-label=LBL_USER_NAME]').hide();
   
    
     var store= $('#bid_commercial_head_c').val();
    
      $(' input[value="Reset Homepage"],input[value="Reset User Preferences"]').hide();
      
        if($('#teamheirarchy_c').val()=='team_lead'){
            
               $('#bid_commercial_head_c').attr('disabled',false);
               
                if( store=='bid_team_head'){
           
             $('option[value="bid_team_head"]').attr('disabled',false);
               
         }
         
         if( store=='commercial_team_head'){
           
             $('option[value="commercial_team_head"]').attr('disabled',false);
               
         }
               
           }
           else{
               $('#bid_commercial_head_c').val('na');
               $('#bid_commercial_head_c').attr('disabled',true);
           }
      
       $('#teamheirarchy_c').on('change',function(){
           
           if($('#teamheirarchy_c').val()=='team_lead'){
               $('#bid_commercial_head_c').attr('disabled',false);
           }
           else{
               $('#bid_commercial_head_c').val('na');
               $('#bid_commercial_head_c').attr('disabled',true);
           }
           
       });
      
      
    
    // console.log("akash u are very big one");
    // console.log($('#email_options table tr:eq(1) td').html('***'));
  //  $('[data-label=LBL_USER_NAME]').hide();
  //  $('#user_name').hide();
    // $('#email_options table tr:eq(1) td:nth-child(1)').append(" <span style='color:red;'>*</span>");
    // $('#Users0emailAddress0').prop('required',true);
    
    $('#Users0emailAddress0').change(function(){
        $('#user_name').val($(this).val());
    });

$.ajax({
      type: "POST",
      url:
        "index.php?module=Users&action=bid_commercial_check",
      success: function (data) {
      // alert(data);
       
       if(data=='bid'){
        // alert('b');
         $('option[value="bid_team_head"]').attr('disabled',true);
         $('option[value="commercial_team_head"]').attr('disabled',false);
       }
       if(data=='commercial'){
        // alert('c');
         $('option[value="bid_team_head"]').attr('disabled',false);
         $('option[value="commercial_team_head"]').attr('disabled',true);
       }
       
       if(data=='both'){
         //alert('both');
         $('option[value="bid_team_head"]').attr('disabled',true);
         $('option[value="commercial_team_head"]').attr('disabled',true);
       }
       if(data=='choose'){
       //  alert('choose');
         $('option[value="bid_team_head"]').attr('disabled',false);
         $('option[value="commercial_team_head"]').attr('disabled',false);
       }
       
      },
    });
    
    var x=   $('[name="employee_status"]').val();
    
     $('[name="employee_status"]').on('change',function(){
         
            if($('[name="employee_status"]').val()=='Active'){
                
                $.ajax({
                  type: "POST",
                  url:
                    "index.php?module=Users&action=bid_commercial_check",
                  success: function (data) {
                  // alert(data);
                   
                  
                   
                   if(data=='both'){
                   
                           
                            if( store=='bid_team_head'){
                       
                          $('[name="employee_status"]').val(x);
                          alert('Bid Team head is already present' );
                           
                     }
                     
                     if( store=='commercial_team_head'){
                          $('[name="employee_status"]').val(x);
                          alert('Commercial Team head is already present' );
                           
                        
                     }
                   }
               
                   
                  },
                });
                
                
}
            
            
            });
   
    
    $('#bid_commercial_head_c').on('change',function(){
      
         if($('#bid_commercial_head_c').val()=='na' && store=='bid_team_head'){
           
             $('option[value="bid_team_head"]').attr('disabled',false);
               
         }
         
         if($('#bid_commercial_head_c').val()=='na' && store=='commercial_team_head'){
           
             $('option[value="commercial_team_head"]').attr('disabled',false);
               
         }
      
    })

    
});
