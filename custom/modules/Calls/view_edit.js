$( document ).ready(function() {
    
         setTimeout(function() {
      $('#check_activity a').hide();
      //console.log('sad');
 }, 10);
    
    //------------------------for global----------------------
     var acc_id=$('input[name=record]').val();
     var acc_type=$('#activity_type_c').val();
    var assigned_id=$('#assigned_user_id').val();
    var approver_id=$('#user_id_c').val();
    
    
    //------------------------for global----------------------
    
    if( $("#status_new_c").val()=="Overdue"){
        $('#activity_date_c').attr("disabled",true);
         $('#assigned_to_c').attr("disabled",true);
    }
    
       $('#audit_trail_c').attr('readonly',true);
    $("#status_new_c").attr("readonly",true);
    
    if( $("#status_new_c").val()=="Completed"){
        $('#activity_date_c').attr("disabled",true);
         $('#assigned_to_c').attr("disabled",true);
    }
   
    $('input[name="apply_for_complete_button"]').hide();
    $('input[name="approve_button"]').hide();
    $('input[name="reject_button"]').hide();
    $('input[name="complete_button"]').hide();
    $('input[value="View Change Log"]').hide();
    
    $("#btn_clr_parent_name").hide();
    
    //-------------------------hiding_fields onload -------------------------------------------------------
   
     $('#btn_approver_c').hide();
     $('.edit-view-pagination-desktop-container').hide();
     $('#btn_clr_approver_c').hide();
     $('[data-label=LBL_ASSIGNED_TO_NAME]').hide();
     $('[field=assigned_user_name]').hide();
     $('[value="Close and Create New"]').hide();
     $(".saveAndContinue").hide();
     $('#tag_hidden_c,[data-label="LBL_TAG_HIDDEN"]').hide();
     $('#untag_hidden_c,[data-label="LBL_UNTAG_HIDDEN"]').hide();
     
    
    //-------------------------hiding_fields onload --END----------------------------------------------------
    
    if(acc_id == ""){
        
      $(".panel-heading:contains('Tag/Untag Users') ,#detailpanel_0").hide();
      
    $.ajax({
                url : 'index.php?module=Calls&action=editView_access',
                type : 'POST',
                dataType: "json",
                 data:{
                  
                 assigned_id,
                 acc_id
                },
                success : function(data){
                if(data.message == "no_acc_id_view_all"){
                    
                }else if(data.message == "no_acc_id_view_few"){
                    $("#activity_type_c option[value=non_global]").attr("disabled",true);
                    $("#activity_type_c option[value=global]").attr("disabled",true);
                }
        }
     
 });
 }

//--------------------------------------tagged and untagged user list-----------------------------------           
            
           
           
            
           
           
                 $.ajax({
                url : 'index.php?module=Calls&action=tagged_users_list',
                type : 'POST',
                dataType: "json",
                data:{
                 acc_id,
                 assigned_id,
                approver_id
                },
                 
                success : function(data){
                 
                  // $("#tagged_users_c").attr("disabled",false);
                    $('[field=tag_c]').html('<div class="demo2"><select id="tag_c"  name="" multiple ></select></div>');
                    
                                        var  data1 ="";
   
                      if(data.status == true){
                        var i;
                        var text = '';
                        
                          //console.log(data.user_id);
                             //console.log(data.other_user_id);
                              //console.log(data.other_user_id.includes(data.user_id[i]));
                            for (i = 0; i<data.user_id.length; i++) {
                            
                                if(data.other_user_id.includes(data.user_id[i])){
                               
                                    text +=  '<option value="'+data.user_id[i]+'" selected>'+data.name[i]+' / '+data.email[i]+'</option>'
                               
                                 
                                }else{
                                
                                    text +=  '<option value="'+data.user_id[i]+'">'+data.name[i]+' / '+data.email[i]+'</option>'
                                    
                                }
                            }
                            
                            
                        
                        
                                                           
                     //   console.log(text);
                        
                        // $("#select_approver_c").append(text1);
                         $("#tag_c").append(text);
                         
                        $('.demo2').dropdown({});
                        
                      }
                      else{
                            for (i = 0; i<data.user_id.length; i++) {
                                
                                    text +=  '<option value="'+data.user_id[i]+'">'+data.name[i]+' / '+data.email[i]+'</option>'
                            }
                                }
                 
                }
              
             });
             
           
           
            //  $.ajax({
            //     url : 'index.php?module=Calls&action=untagged_users_list',
            //     type : 'POST',
            //     data:{
            //     acc_id,
            //     assigned_id,
            //     approver_id
            //     },
                 
            //     success : function(data){
                 
            //       // $("#untagged_users_c").attr("disabled",false);
            //         $('[field=untag_c]').html('<div class="demo1"><select id="untag_c"  name="" multiple ></select></div>');
                    
            //          var  data1 ="";
   
            //           if(data.status == true){
            //             var i;
            //             var text = '';
                        
            //             if(acc_id != "" ){
            //               //console.log(data.user_id);
            //                  //console.log(data.other_user_id);
            //                   //console.log(data.other_user_id.includes(data.user_id[i]));
            //                 for (i = 0; i<data.user_id.length; i++) {
                            
            //                     if(data.other_user_id.includes(data.user_id[i])){
                               
            //                         text +=  '<option value="'+data.user_id[i]+'" selected>'+data.name[i]+' / '+data.email[i]+'</option>'
                               
                                 
            //                     }else{
                                
            //                         text +=  '<option value="'+data.user_id[i]+'">'+data.name[i]+' / '+data.email[i]+'</option>'
                                    
            //                     }
            //                 }
                            
                            
            //             }
            //             else{
            //                 for (i = 0; i<data.user_id.length; i++) {
                                
            //                         text +=  '<option value="'+data.user_id[i]+'">'+data.name[i]+' / '+data.email[i]+'</option>'
            //                 }
            //                     }
                        
                                                           
                        
            //              $("#untag_c").append(text);
                         
            //             $('.demo1').dropdown({});
                        
            //           }
                 
            //     }
              
            //  });
            
             
             
            
  //--------------------------------------tagged and untagged user list----------------------------------- 
  
  if(acc_id !=""){
    
                
   //----editView access---------- 
    $.ajax({
                url : 'index.php?module=Calls&action=editView_access',
                type : 'POST',
                dataType: "json",
                 data:{
                  
                 assigned_id,
                 acc_id
                },
                success : function(data){
                    var tagged_users_new= [];
                      $(".dropdown-chose-list span").each(function(){
                      tagged_users_new.push($(this).text())
                      });
                      
                      tagged_users_new= tagged_users_new.filter(tagged=>tagged);
                    
                if(data.message == "acc_id_view_no"){
                    // alert("naanu");
                    $("#activity_type_c option[value=non_global]").attr("disabled",true);
                    $("#activity_type_c option[value=global]").attr("disabled",true);
                    
                     $(".dropdown-chose-list,.dropdown-display").hide(); 
                     $("[field=tag_c]").append(`<span>${tagged_users_new}</span>`);
                     
                }else if(data.message == "acc_id_view_few"){
                    $("#activity_type_c option[value=non_global]").attr("disabled",true);
                    $("#activity_type_c option[value=global]").attr("disabled",true);
                }
        }
     
 });
 
 //----editView access--------END--
 
 //---Approval Button---------------
 var status=$('#status_new_c').val();
 
             $.ajax({
                url : 'index.php?module=Calls&action=approval_buttons',
                type : 'POST',
                dataType: "json",
                 data:{
                  
                 assigned_id,
                 acc_id,
                 approver_id,
                 status
                },
                success : function(data){
                    
                    if(data.message=="show_completed"){
                        $('#complete_activity').show();
                    }
                    
                 else   if(data.message=="show_send_approval"){
                     
                     if(status=="Apply For Completed"){
                           
                        $('#apply_for_complete').val("Send for approval");
                         $('#apply_for_complete').show();
                        
                         
                     }else{
                           
                         $('#apply_for_complete').show();
                          $('#apply_for_complete').val("Apply for Complete");
                         
                     }
                        
                    }
                    
                 else    if(data.message=="Pending"){
                      $('#activity_date_c').attr("disabled",true);
                        $('#apply_for_complete').replaceWith('<h3 id="apply_for_complete" style="color: red; display: inline;">Approval Pending</h3>');
                    }
                    
                  else  if(data.message=="Rejected"){
                        $('#apply_for_complete').show();
                        $("#reject_activity").replaceWith('<h3 id="reject_activity" style="color: red; display: inline;">Rejected (Edit Activity and resend for approval)</h3>')
                    }
                    
                  else  if(data.message=="Pending_approve"){
                      
                        $('#approve_activity').show();
                        $('#reject_activity').show();
                        $('#activity_date_c').attr("disabled",true);
                    }
                    
                    else   if(data.message=="Approved"){
                       
                      $('#activity_date_c').attr("disabled",true);
                    }
                    
                    else{
                        
                        $('#approve_activity').hide();
                        $('#reject_activity').hide();
                        $('#apply_for_complete').hide();
                          $('#complete_activity').hide();
                    }
                }
                   
        
                                         
                     });  
    
 //---Approval Button-------END--------
 
 
 
       
    
    //   $('#activity_date_c').datepicker("option", "disabled", true );
       
} 
    
    //-----------------------tag and untag users id----------------------------------------------- 

$(document).on('click', function () {

 var untag1=$("#untag_c").val();
       
        // if(untag1!=null){
        
        // var untag=untag1.join();
        // $('#untag_hidden_c').val(untag);
        // }
        
       var tag1=$("#tag_c").val();
       
       if(tag1!=null){
        
       var tag=tag1.join();
       
       $('#tag_hidden_c').val(tag);
       
       }else{
           
            $('#tag_hidden_c').val('');
       }
});
//-----------------------tag and untag users id--------------END---------------------------------  

 //----------------------------Activity Type Onload and Onchange----------------------------------------
    
   
    var activity_type1= $('#activity_type_c').val();
    
     $('[field="untag_c"],[data-label="LBL_UNTAG"]').hide();
    
//----------------------------Activity Type Onload and Onchange-----------END-----------------------------

    
    
//--------------------------------------Assigned To -------------------------------------------


//----------------------------------------Onload-------------------------------------------------------------------

 var assigned_name=$('#assigned_user_name').val();

   $('#assigned_to_c').val(assigned_name);

$('#approver_c').attr('readonly',true);
   
  var assigned_id = $("#assigned_user_id").val();
   
 
   
    $.ajax({
                url : 'index.php?module=Calls&action=fetch_reporting_manager',
                type : 'POST',
                dataType: "json",
                 data:{
                  
                 assigned_name,
                 assigned_id
                },
                success : function(data){
                 
                  $('#approver_c').val(data.reporting_name);
                  $('#user_id_c').val(data.reporting_id);
                 
      
 
        }
     
 });

//----------------------------------------Onload-----------END--------------------------------------------------------

//------------------------------------------Assigned List----------------------------------------------------------------------
var res1;

$.ajax({
        url : 'index.php?module=Calls&action=new_assigned_list',
        type : 'POST',
         data: {
           acc_id, 
        },
        
        success : function(data1){
           
           
             datw=JSON.parse(data1);
           
          
           
           if(datw=='block'){
           $('#assigned_to_c').attr('readonly',true);
             
           }
           
          res1=datw.a;
          var user_list= []; 
          
          for(var z in res1){
              res1[z]=res1[z].replace(/\^/g,' ');
              res1[z]=res1[z].replace('team_lead','TL');
              res1[z]=res1[z].replace('team_member_l1','TM L1');
              res1[z]=res1[z].replace('team_member_l2','TM L2');
              res1[z]=res1[z].replace('team_member_l3','TM L3');
               
              
          }
              
            for(var i in res1) {
                user_list.push(res1[i])
                
            }; 
            
           
          
          $('#assigned_to_c').autocomplete({
            source: user_list,
            minLength: 0,
            scroll: true
        }).keydown(function() {
          
            $(this).autocomplete("search", "");
        });
             
        }
     
 });



//-----------------------------------------Assigned List--------------------------------------------------------------------------

//----------------------------------------Onchange--------------------------------------------------------------------
$(document).on('click','#ui-id-1,#ui-id-3',function(){
    
    
    var f=$('#assigned_to_c').val();
    
    var e=f.length;
    
  var s=f.indexOf("/");

f = f.slice(0,s);

f=f.replace(/[^ \, a-zA-Z]+/g,'');

f=f.replace(/^\s+/g, '');

$('#assigned_to_c').val(f);


var a_name= f.split(/\s+/);

var f_name=a_name[0];
var l_name=a_name[1];

$.ajax({
        url : 'index.php?module=Calls&action=fetch_assigned_id',
        type : 'POST',
         data: {
           
            f,
            f_name,
            l_name
        },
        
        success : function(data){
           
           $('#assigned_user_id').val(data);
          $('[name=assigned_user_name]').val(f);
          
             var assigned_name = $("#assigned_to_c").val();
  var assigned_id = $("#assigned_user_id").val();
   
 
   
    $.ajax({
                url : 'index.php?module=Calls&action=fetch_reporting_manager',
                type : 'POST',
                dataType: "json",
                 data:{
                  
                 assigned_name,
                 assigned_id
                },
                success : function(data){
                 
                  $('#approver_c').val(data.reporting_name);
                  $('#user_id_c').val(data.reporting_id);
                  
           var status=$('#status_new_c').val();
 
             $.ajax({
                url : 'index.php?module=Calls&action=approval_buttons',
                type : 'POST',
                dataType: "json",
                 data:{
                  
                 assigned_id,
                 acc_id,
                 approver_id,
                 status
                },
                success : function(data){
                    
                if(data.message=="show_completed"){
                        $('#complete_activity').show();
                    }
                    
                 else   if(data.message=="show_send_approval"){
                     
                         if(status=="Apply For Completed"){
                         $('#apply_for_complete').show();
                         $('#apply_for_complete').val("Send for approval");
                         
                     }else{
                         $('#apply_for_complete').show();
                         $('#apply_for_complete').val("Apply for Complete");
                         
                     }
                    }
                    
                 else    if(data.message=="Pending"){
                      $('#activity_date_c').attr("disabled",true);
                        $('#apply_for_complete').replaceWith('<h3 id="apply_for_complete" style="color: red; display: inline;">Approval Pending</h3>');
                    }
                    
                  else  if(data.message=="Rejected"){
                        $('#apply_for_complete').show();
                        $("#reject_activity").replaceWith('<h3 id="reject_activity" style="color: red; display: inline;">Rejected (Edit Activity and resend for approval)</h3>')
                    }
                    
                  else  if(data.message=="Pending_approve"){
                      
                        $('#approve_activity').show();
                        $('#reject_activity').show();
                        $('#activity_date_c').attr("disabled",true);
                    }
                    
                    else   if(data.message=="Approved"){
                       
                      $('#activity_date_c').attr("disabled",true);
                    }
                    
                    else{
                        
                        $('#approve_activity').hide();
                        $('#reject_activity').hide();
                        $('#apply_for_complete').hide();
                          $('#complete_activity').hide();
                    }
                }
                 
            });  
                     
         
                  
                  
                  
        }
     
 });

}
});

//----------------------------
});

$(document).on('change','#assigned_to_c',function(){
    
    
    var f=$('#assigned_to_c').val();
    
    var e=f.length;
    
  var s=f.indexOf("/");

f = f.slice(0,s);

f=f.replace(/[^ \, a-zA-Z]+/g,'');

f=f.replace(/^\s+/g, '');

$('#assigned_to_c').val(f);


var a_name= f.split(/\s+/);

var f_name=a_name[0];
var l_name=a_name[1];

$.ajax({
        url : 'index.php?module=Calls&action=fetch_assigned_id',
        type : 'POST',
         data: {
           
            f,
            f_name,
            l_name
        },
        
        success : function(data){
           
           $('#assigned_user_id').val(data);
          $('[name=assigned_user_name]').val(f);
          
             var assigned_name = $("#assigned_to_c").val();
  var assigned_id = $("#assigned_user_id").val();
   
 
   
    $.ajax({
                url : 'index.php?module=Calls&action=fetch_reporting_manager',
                type : 'POST',
                dataType: "json",
                 data:{
                  
                 assigned_name,
                 assigned_id
                },
                success : function(data){
                 
                  $('#approver_c').val(data.reporting_name);
                  $('#user_id_c').val(data.reporting_id);
    
      
                        
           var status=$('#status_new_c').val();
 
             $.ajax({
                url : 'index.php?module=Calls&action=approval_buttons',
                type : 'POST',
                dataType: "json",
                 data:{
                  
                 assigned_id,
                 acc_id,
                 approver_id,
                 status
                },
                success : function(data){
                    
                if(data.message=="show_completed"){
                        $('#complete_activity').show();
                    }
                    
                 else   if(data.message=="show_send_approval"){
                     
                         if(status=="Apply For Completed"){
                         $('#apply_for_complete').show();
                         $('#apply_for_complete').val("Send for approval");
                         
                     }else{
                         $('#apply_for_complete').show();
                         $('#apply_for_complete').val("Apply for Complete");
                         
                     }
                    }
                    
                 else    if(data.message=="Pending"){
                      $('#activity_date_c').attr("disabled",true);
                        $('#apply_for_complete').replaceWith('<h3 id="apply_for_complete" style="color: red; display: inline;">Approval Pending</h3>');
                    }
                    
                  else  if(data.message=="Rejected"){
                        $('#apply_for_complete').show();
                        $("#reject_activity").replaceWith('<h3 id="reject_activity" style="color: red; display: inline;">Rejected (Edit Activity and resend for approval)</h3>')
                    }
                    
                  else  if(data.message=="Pending_approve"){
                      
                        $('#approve_activity').show();
                        $('#reject_activity').show();
                        $('#activity_date_c').attr("disabled",true);
                    }
                    
                    else   if(data.message=="Approved"){
                       
                      $('#activity_date_c').attr("disabled",true);
                    }
                    
                    else{
                        
                        $('#approve_activity').hide();
                        $('#reject_activity').hide();
                        $('#apply_for_complete').hide();
                          $('#complete_activity').hide();
                    }
                }
                 
            });  
                     
         
                

 
 
        }
     
 });

}
});

//----------------------------
});

//----------------------------------------Onchange--------------------------------------------------------------------


//--------------------------------------Assigned To -----------END------------------------------------

    
    $('#for_quick_create_c').val('no');
    $('#for_quick_create_c').hide();
   $('[data-label=LBL_FOR_QUICK_CREATE]').hide();
    
    function dateFormatchange(value) {
        var res = value.split("/");
        var format_change = res[1]+'/'+res[0]+'/'+res[2];
        return format_change;
    }
    
    $('#activity_date_c_trigger').hide();
    $('#next_date_c_trigger').hide();
    $('#btn_parent_name').hide();
    $('#btn_assigned_user_name').hide();
    $('#parent_name').prop('readonly',true);
    $('#activity_date_c').prop('readonly',true);
    $('#next_date_c').prop('readonly',true);
    
    // $("#activity_date_c").click(function(){
    //     $('#activity_date_c').val('');
    // });
    // $("#next_date_c").click(function(){
    //     $('#next_date_c').val('');
    // });

 
 

  
    $("#activity_date_c").datepicker({
        dateFormat: 'dd/mm/yy',
        changeYear: true,
        changeMonth: true,
        onSelect: function(date1){
            var newDate = $(this).datepicker('getDate');
            var today = new Date();
            if (newDate) { // Not null
              newDate.setDate(newDate.getDate() + 1);
            }
            $('#next_date_c').datepicker('option', 'minDate', newDate);
            
           
           
           var assigned_name=$('#assigned_user_name').val();
           var assigned_id = $("#assigned_user_id").val();
        
           $.ajax({
                url : 'index.php?module=Calls&action=status_change',
                type : 'POST',
                dataType: "json",
                 data:{
                  
                 assigned_name,
                 assigned_id
                },
                success : function(data){
                
                
                if(data.mc == "yes"){
                    
                       if(newDate.getTime() >= today.getTime()){
                           $("#status_new_c").val("Upcoming"); 
                        }else if(newDate.getTime() < today.getTime()){
                          $("#status_new_c").val("Completed")  
                        }
                        }else{
                             if(newDate.getTime() >= today.getTime()){
                                   $("#status_new_c").val("Upcoming"); 
                                   
                                }else if(newDate.getTime() < today.getTime()){
                                  $("#status_new_c").val("Apply For Completed");
                                  
                                } 
                        }
                        
                         //---Approval Button---------------
           if(acc_id!=''){              
                         
             var status=$('#status_new_c').val();
 
             $.ajax({
                url : 'index.php?module=Calls&action=approval_buttons',
                type : 'POST',
                dataType: "json",
                 data:{
                  
                 assigned_id,
                 acc_id,
                 approver_id,
                 status
                },
                success : function(data){
                    
                if(data.message=="show_completed"){
                        $('#complete_activity').show();
                    }
                    
                 else   if(data.message=="show_send_approval"){
                     
                         if(status=="Apply For Completed"){
                         $('#apply_for_complete').show();
                         $('#apply_for_complete').val("Send for approval");
                         
                     }else{
                         $('#apply_for_complete').show();
                         $('#apply_for_complete').val("Apply for Complete");
                         
                     }
                    }
                    
                 else    if(data.message=="Pending"){
                      $('#activity_date_c').attr("disabled",true);
                        $('#apply_for_complete').replaceWith('<h3 id="apply_for_complete" style="color: red; display: inline;">Approval Pending</h3>');
                    }
                    
                  else  if(data.message=="Rejected"){
                        $('#apply_for_complete').show();
                        $("#reject_activity").replaceWith('<h3 id="reject_activity" style="color: red; display: inline;">Rejected (Edit Activity and resend for approval)</h3>')
                    }
                    
                  else  if(data.message=="Pending_approve"){
                      
                        $('#approve_activity').show();
                        $('#reject_activity').show();
                        $('#activity_date_c').attr("disabled",true);
                    }
                    
                    else   if(data.message=="Approved"){
                       
                      $('#activity_date_c').attr("disabled",true);
                    }
                    
                    else{
                        
                        $('#approve_activity').hide();
                        $('#reject_activity').hide();
                        $('#apply_for_complete').hide();
                          $('#complete_activity').hide();
                    }
                }
                 
                    
                
                   
        
                                         
                     });  
                     
           }
    
 //---Approval Button-------END--------
 
                        
                            
                            
                       
 
        }
     
 });
 
        }
    });
    
  
    
    $("#next_date_c").datepicker({
        dateFormat: 'dd/mm/yy',
        changeYear: true,
        changeMonth: true,
         onSelect: function(date1){
            if($("#activity_date_c").val() == ''){
                alert('Please enter Activity Date first');
                $("#next_date_c").val('');
            }
        }
    });
    
     if($("#activity_date_c") != '' ){
        var activity_date = new Date(dateFormatchange($("#activity_date_c").val()));
        // console.log(activity_date);
        if (activity_date) { // Not null
          activity_date.setDate(activity_date.getDate() + 1);
        }
        $('#next_date_c').datepicker('option', 'minDate', activity_date);
    }
    
    
    function decodeHtml(html) {
        var txt = document.createElement("textarea");
        txt.innerHTML = html;
        return txt.value;
    }
  
    
    
    $('#parent_name').on('click blur', function(e) {
        if(e.type === 'click'){
            $('#btn_parent_name').trigger('click');
        }
        else if(e.type === 'blur'){
            var oppurtunity_id = $('#parent_id').val();
            if($('#parent_type').val() == 'Opportunities'){
                if(oppurtunity_id != ''){
                    $.ajax({
                        url : 'index.php?module=Calls&action=oppurtunity_status',
                        type : 'POST',
                        dataType: "json",
                         data :
                            {
                                opp_id:oppurtunity_id ,
                            },
                        success : function(data){
                            var x=data.opp_status;
                          if (data.status = true){
                              
                                 $('#audit_trail_c').val(x.join('\r\n'))
                                $('#audit_trail_c').attr('readonly',true);
                          }else{
                              alert(data.message);
                              window.location.reload();
                          }
                        }
                    });
                }
            }
        }
    });
    
  
    
    $('#assigned_user_name').click(function() {
        $('#btn_assigned_user_name').trigger('click');
    });
    
  $('#type_of_interaction_c').change(function(){
    if($(this).val() != 'Preparation'){
        if($("[data-label=LBL_NAME_OF_PERSON] span").text() == ""){
            $('[data-label=LBL_NAME_OF_PERSON]').append(" <span style='color:red;'>*</span>");
        }
    }else{
        $('[data-label=LBL_NAME_OF_PERSON] span').remove();
    }
  });
  
  if($('#type_of_interaction_c').val() != 'Preparation'){
        if($("[data-label=LBL_NAME_OF_PERSON] span").text() == ""){
            $('[data-label=LBL_NAME_OF_PERSON]').append(" <span style='color:red;'>*</span>");
        }
    }
    else{
        $('[data-label=LBL_NAME_OF_PERSON] span').remove();
    }
    
    custom_check_form = function(view){
        var validate = true;
        if($('#type_of_interaction_c').val()=='select'){
             alert('Please Select Type of Interaction');
              $("#type_of_interaction_c").css("background-color", "Red");
               validate = false;
        }
        if($('#type_of_interaction_c').val() != 'Preparation' ) {
           if($('#name_of_person_c').val() == ''){
            alert('Please fill Name of Person Contacted');
               validate = false;
           }
            
        }
       
        if(validate && check_form(view)) {
              return true;
        }
        else {
              return false;
        }
    }
    
    
    
//------------------------------------------------------Relate to onchange-------------------------------------------------    
    
    $(document).on('click blur','#parent_name',function() {
        
      //  alert('a');
        var type=$('#parent_type').val();
        var p_id=$('#parent_id').val();
         var name=$('#parent_name').val();
         
        if(type=='Calls'){
            
             $.ajax({
                        url : 'index.php?module=Calls&action=follow_up_activity_check',
                        type : 'POST',
                        dataType: "json",
                         data :
                            {
                                p_id
                            },
                        success : function(data){
                            
                            if(data.status==true){
                                
                                alert('Follow up Activity "'+data.f_name+'" for Activity "'+name+ '"  already exists');
                                $('#parent_name').val('');
                                $('#parent_id').val('');
                            }
                            
                             if(data.status==false){
                                
                                alert("Permission denied to create Follow UP Activity for  '"+name+"'");
                                $('#parent_name').val('');
                                $('#parent_id').val('');
                            }
                            
                            
                            
                            
                            
                            
                            
                        }
             })
            
            
            
        }
        
          if(type=='Opportunities'){
          
             $.ajax({
                        url : 'index.php?module=Calls&action=follow_up_opp_check',
                        type : 'POST',
                        dataType: "json",
                         data :
                            {
                                p_id
                            },
                        success : function(data){
                            
                            if(data.status==true){
                                
                                alert("Permission denied to create Activity for opportunity '"+name+"'");
                                $('#parent_name').val('');
                                $('#parent_id').val('');
                                 $('#audit_trail_c').val('');
                            }
                            
                         
                            
                        }
             });
            
            
            
        }
        
    })
    
    
    
    
//------------------------------------------------------Relate to onchange--------------END--------------------------------

//----------------------send approval/apply for complete ---------------------------------------------------
     
      $("#apply_for_complete").on("click",function() {
          
           let status = $("#status_new_c").val();
           let sender = $('#assigned_user_id').val();
           let m= new Date();
           let date  = m.getUTCFullYear() +"/"+ (m.getUTCMonth()+1) +"/"+ m.getUTCDate() + " " + m.getUTCHours() + ":" + m.getUTCMinutes() + ":" + m.getUTCSeconds();
           let approver = $('#user_id_c').val();
          
           $.ajax({
                url : 'index.php?module=Calls&action=send_approval',
                type : 'POST',
                dataType: "json",
                 data:{
                  acc_id,
                  acc_type,
                  status,
                  sender,
                  date,
                  approver
                 
                 },
                success : function(data){
                if(data.button == 'hide'){
                    $("#status_new_c").val("Apply for Completed");
                    $("#apply_for_complete").hide();
                   $("#SAVE_HEADER").trigger("click");
                }
            
            }
     
           });
      })
     
       

//----------------------send approval/apply for complete ----------END---------------------------------------

//---------------------------------------click comments Approve or reject-------------------------------------------
$('#approve_activity').on('click',function validation(view){
     $('#approve_comments').css("display","block");
});

 $('#reject_activity').on('click',function validation(view){
       $('#reject_comments').css("display","block");
 });
 
 $("#complete_activity").on("click",function() {
     
        let m= new Date();
           let date  = m.getUTCFullYear() +"/"+ (m.getUTCMonth()+1) +"/"+ m.getUTCDate() + " " + m.getUTCHours() + ":" + m.getUTCMinutes() + ":" + m.getUTCSeconds();
        
      
         $.ajax({
                url : 'index.php?module=Calls&action=completed',
                type : 'POST',
                dataType: "json",
                 data:{
                  acc_id,
                  assigned_id,
                  date,
                  approver_id,
                  acc_type
                 
                 },
                success : function(data){
                
                if(data.button == 'hide'){
                    $("#approve_activity").hide();
                    $("#reject_activity").hide();
                    $("#complete_activity").hide();
                    $("#status_new_c").val('Completed');
                    $("#SAVE_HEADER").trigger("click");
                }
            
            }
     
           });
         
      
     
    
 });
  
  
  
  $("#close_reject").on('click',function(){
   
    $('#reject_comments').hide();
  });   

//---------------------------------------click comments Approve or reject--------END--------------------------------------

//------------------------------------Update Approve or Reject----------------------------------------

 $('#submit_comment_approve').on('click',function(){
     
     var comments=$('#get_comments_approve').val();
       if(comments!=''){  
         
         $('#submit_comment_approve').hide();
         $('#close_approve').hide();
         
         $('.loader').css("display","block");
         
          let m= new Date();
           let date  = m.getUTCFullYear() +"/"+ (m.getUTCMonth()+1) +"/"+ m.getUTCDate() + " " + m.getUTCHours() + ":" + m.getUTCMinutes() + ":" + m.getUTCSeconds();
         
         
         $.ajax({
                url : 'index.php?module=Calls&action=approve',
                type : 'POST',
                dataType: "json",
                 data:{
                  acc_id,
                  assigned_id,
                  date,
                  approver_id,
                  comments
                 
                 },
                success : function(data){
                
                if(data.button == 'hide'){
                    $("#approve_activity").hide();
                    $("#reject_activity").hide();
                    $("#status_new_c").val('Completed');
                    $("#SAVE_HEADER").trigger("click");
                }
            
            }
     
           });
         
       }
       else{
           alert("Please write comments");
       }
     
 });
  $('#submit_comment_reject').on('click',function(){
      
      var comment_reject=$('#get_comments_reject').val();
       if (comment_reject !=''){ 
      
       $('#submit_comment_reject').hide();
       $('#close_reject').hide();
         $('.loader').css("display","block");
         
          let m= new Date();
           let date  = m.getUTCFullYear() +"/"+ (m.getUTCMonth()+1) +"/"+ m.getUTCDate() + " " + m.getUTCHours() + ":" + m.getUTCMinutes() + ":" + m.getUTCSeconds();
        
         
         $.ajax({
                url : 'index.php?module=Calls&action=reject',
                type : 'POST',
                dataType: "json",
                 data:{
                  acc_id,
                  assigned_id,
                  date,
                  approver_id,
                  comment_reject
                 
                 },
                success : function(data){
                
                if(data.button == 'hide'){
                    $("#approve_activity").hide();
                    $("#reject_activity").hide();
                   $("#SAVE_HEADER").trigger("click");
                }
            
            }
     
           });
       }
       else{
           alert("Please write comments");
       }
      
  });




$("#type_of_interaction_c").on("click", function () {
  //console.log("if in");

  if ($("#type_of_interaction_c").css("background-color", "Red")) {
    // console.log("check in");

    $("#type_of_interaction_c").css("background-color", "#d8f5ee");
  }
});


//------------------------------------Write code above this line---------------------------------------------------------------------
});