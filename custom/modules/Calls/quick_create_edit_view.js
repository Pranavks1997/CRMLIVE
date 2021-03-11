$( document ).ready(function() {
   
    $("#status_new_c").prop('readonly',true);
     $('#parent_name').prop('disabled', true);
        $('#audit_trail_c').attr('readonly',true);
  
     
     //-------------------------hiding_fields onload -------------------------------------------------------
   
     $('#btn_approver_c').hide();
     $('.edit-view-pagination-desktop-container').hide();
     $('#btn_clr_approver_c').hide();
     $('[data-label=LBL_ASSIGNED_TO_NAME]').hide();
     $('[field=assigned_user_name]').hide();
     $('[value="Close and Create New"]').hide();
     $('#tag_hidden_c,[data-label="LBL_TAG_HIDDEN"]').hide();
     $('#untag_hidden_c,[data-label="LBL_UNTAG_HIDDEN"]').hide();
    
    
    //-------------------------hiding_fields onload --END----------------------------------------------------
    
         //--------------------------------------tagged and untagged user list-----------------------------------           
            
            var acc_id=$('input[name=record]').val();
           
          var assigned_id=$('#assigned_user_id').val();
           var approver_id=$('#user_id_c').val();
            
           
           
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
            //     dataType: "json",
            //     data:{
            //     acc_id
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
    
    //------------------------------Onload-----------------------------------------------------------------
    var activity_type1= $('#activity_type_c').val();
        
        $('[field="untag_c"],[data-label="LBL_UNTAG"]').hide();
          $('[field="tag_c"],[data-label="LBL_TAG"],#detailpanel_0,.panel-heading:contains("Tag/Untag Users")').hide();
    //------------------------------Onchange-----------END------------------------------------------------------
    
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

//------------------------------------------List----------------------------------------------------------------------
var res1;

$.ajax({
        url : 'index.php?module=Calls&action=new_assigned_list',
        type : 'POST',
         data: {
            
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



//-----------------------------------------List--------------------------------------------------------------------------

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
    
      
               
                

 
 
        }
     
 });

}
});

//----------------------------
});

//----------------------------------------Onchange--------------------------------------------------------------------


//--------------------------------------Assigned To -----------END-------------------------------

    


    $('#btn_clr_parent_name').hide();
    $('[field=parent_name]').css({"width": "63%"});
    $('#for_quick_create_c').val('yes');
    $('#for_quick_create_c').hide();
    $('[data-label=LBL_FOR_QUICK_CREATE]').hide();
    
    function dateFormatchange(value) {
        var res = value.split("/");
        var format_change = res[1]+'/'+res[0]+'/'+res[2];
        return format_change;
    }
    $('#parent_type').prop('disabled', true);
    // $('#current_status_c').prop("readonly",true);
    $('#btn_parent_name').hide();
    $('#btn_assigned_user_name').hide();
    // $('#date_start_trigger').hide();
    // $('#date_start_date').prop('readonly',true);
    // $('#next_date_c_trigger').hide();
    // $('#next_date_c').prop('readonly',true);
    $('#activity_date_c_trigger').hide();
    $('#next_date_c_trigger').hide();
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
            if (newDate) { // Not null
              newDate.setDate(newDate.getDate() + 1);
            }
            $('#next_date_c').datepicker('option', 'minDate', newDate);
            
           var today = new Date();
           
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
                           console.log($("#status_new_c").val());
                           $("#status_new_c").val("Upcoming"); 
                        }else if(newDate.getTime() < today.getTime()){
                          $("#status_new_c").val("Completed")  
                        }
                }else{
                     if(newDate.getTime() >= today.getTime()){
                           $("#status_new_c").val("Upcoming"); 
                        }else if(newDate.getTime() < today.getTime()){
                          $("#status_new_c").val("Apply For Completed")  
                        } 
                }
 
        }
     
 });
            
            // console.log(newDate);
            // console.log(today);
            
            
            
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
   
    
    
    
   
    $('#assigned_user_name').click(function() {
        $('#btn_assigned_user_name').trigger('click');
    });
  
   
    
    function decodeHtml(html) {
        var txt = document.createElement("textarea");
        txt.innerHTML = html;
        return txt.value;
    }
    
    var loaded_opp_status = $('#description').text();
    var oppurtunity_id = $('[name=opportunity_id]').val();
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
                
                     alert("hi");

                  
                    $('#audit_trail_c').val(x.join('\r\n'))
                    $('#audit_trail_c').attr('readonly',true);
                  
               
          }else{
              alert(data.message);
              window.location.reload();
          }
        }
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
    }else{
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
    
    $("#type_of_interaction_c").on("click", function () {
  //console.log("if in");

  if ($("#type_of_interaction_c").css("background-color", "Red")) {
    // console.log("check in");

    $("#type_of_interaction_c").css("background-color", "#d8f5ee");
  }
});
   
  //*************************************************Write code above this line**********************************  
});
