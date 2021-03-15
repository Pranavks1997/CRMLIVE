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
       
        $('input[name="send_for_approval"]').hide();
        $('input[name="approve_button"]').hide();
        $('input[name="reject_button"]').hide();
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
    var status=$('#status_c').val();
    
   //------------------------for global----------------------
   
   //---------------Approver----------------------------------
   
             $.ajax({
                url : 'index.php?module=Documents&action=fetch_reporting_manager',
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
 
   //---------------Approver----------------------------------
   
   
  if(doc_id == ""){
        
      $(".panel-heading:contains('Tag Users') ,#detailpanel_0").hide(); 
      
      
  }
  
   if(doc_id != ""){
        
      
         //--------------------------------Tagged user  list--------------------------  
                 $.ajax({
                url : 'index.php?module=Documents&action=tagged_users_list',
                type : 'POST',
                dataType: "json",
                data:{
                 doc_id,
                 assigned_id,
                approver_id
                },
                 
                success : function(data){
                 
                  // $("#tagged_users_c").attr("disabled",false);
                    $('[field=tagged_users_c]').html('<div class="demo2"><select id="tagged_users_c"  name="" multiple ></select></div>');
                    
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
                         $("#tagged_users_c").append(text);
                         
                        $('.demo2').dropdown({});
                        
                      }
                      else{
                            for (i = 0; i<data.user_id.length; i++) {
                                
                                    text +=  '<option value="'+data.user_id[i]+'">'+data.name[i]+' / '+data.email[i]+'</option>'
                            }
                                }
                 
                }
              
             });
             
         //--------------------------------Tagged user  list-----END---------------------      
             
         //--------------------------------approval buttons-------------------------------
         
         
               $.ajax({
                url : 'index.php?module=Documents&action=approval_buttons',
                type : 'POST',
                dataType: "json",
                 data:{
                  
                 assigned_id,
                 doc_id,
                 approver_id,
                 status
                },
                success : function(data){
                 
                    
                }
                 
            });  
         //--------------------------------approval buttons---------------END----------------   
         
         
             
    //-----------end of if condition------------------------------------       
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

//----------------------send approval/apply for complete ---------------------------------------------------
     
      $("#apply_for_complete").on("click",function() {
          
           
           let sender = assigned_id;
           let m= new Date();
           let date  = m.getUTCFullYear() +"/"+ (m.getUTCMonth()+1) +"/"+ m.getUTCDate() + " " + m.getUTCHours() + ":" + m.getUTCMinutes() + ":" + m.getUTCSeconds();
           let approver = $('#user_id_c').val();
          
           $.ajax({
                url : 'index.php?module=Documents&action=send_approval',
                type : 'POST',
                dataType: "json",
                 data:{
                  doc_id,
                  doc_type,
                  status,
                  sender,
                  date,
                  approver
                 },
                success : function(data){
                if(data.button == 'hide'){
                    $("#status_c").val("Apply for Completed");
                    $("#apply_for_complete").hide();
                   $("#SAVE_HEADER").trigger("click");
                }
            
            }
     
           });
      })
     
       

//----------------------send approval/apply for complete ----------END---------------------------------------


  $('#approve_document').on('click',function validation(view){
     $('#approve_comments').css("display","block");
});

  $('#reject_document').on('click',function validation(view){
       $('#reject_comments').css("display","block");
 });

  $("#close_reject").on('click',function(){
   
    $('#reject_comments').hide();
    
  }); 
  
  
  $("#close_approve").on('click',function(){
   
    $('#approve_comments').hide();
  });   
  
  
 
  $('#submit_comment_approve').on('click',function(){
     
     var comments=$('#get_comments_approve').val();
       if(comments!=''){  
         
         $('#submit_comment_approve').hide();
         $('#close_approve').hide();
         
         $('.loader').css("display","block");
         
          let m= new Date();
           let date  = m.getUTCFullYear() +"/"+ (m.getUTCMonth()+1) +"/"+ m.getUTCDate() + " " + m.getUTCHours() + ":" + m.getUTCMinutes() + ":" + m.getUTCSeconds();
         
         
         $.ajax({
                url : 'index.php?module=Documents&action=approve',
                type : 'POST',
                dataType: "json",
                 data:{
                  doc_id,
                  assigned_id,
                  date,
                  approver_id,
                  comments
                 
                 },
                success : function(data){
                
                if(data.button == 'hide'){
                    $("#approve_document").hide();
                    $("#reject_document").hide();
                    $('#status_c').val('Completed');
                    $("#SAVE").trigger("click");
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
                url : 'index.php?module=Documents&action=reject',
                type : 'POST',
                dataType: "json",
                 data:{
                  doc_id,
                  assigned_id,
                  date,
                  approver_id,
                  comment_reject
                 
                 },
                success : function(data){
                
                if(data.button == 'hide'){
                    $("#approve_activity").hide();
                    $("#reject_activity").hide();
                   $("#SAVE").trigger("click");
                }
            
            }
     
           });
       }
       else{
           alert("Please write comments");
       }
      
  });
  
  
  //------------------------------dropdown for sector-----------------------
    var selected_category = $("#category_c").val();
    
    $("#category_c").replaceWith('<select name="category_c" id="category_c" onchange="categoryFunction(this.value)"></select>');
  
     $.ajax({
    url : 'index.php?module=Documents&action=category',
        type : 'GET',
        success : function(all_category_list){
          if(selected_category == ""){
            var list = '<option value=""></option> +'; 
          }else{
                    var list = '<option value="'+selected_category+'">'+selected_category+'</option> +';
                }
            
            all_category_list=JSON.parse(all_category_list);
            all_category_list.forEach((category)=>{
              if(category.name != selected_category){
                list+='<option value="'+category.name+'">'+category.name+'</option>';
              }
            })
            $("#category_c").html(list);
        }
});
  
  //-----------------------------------------Dependable dropdown according to sector selection----------------
  
  var selected_subCategory = $("#sub_category_c").val();
  $("#sub_category_c").replaceWith('<select name="sub_category_c" id="sub_category_c"></select>');

    if(selected_subCategory !== ""){
      $.ajax({
      type: "POST",
      url:
        "index.php?module=Documents&action=subCategory",
      data: { category_name:selected_category },
      success: function (data) {
            var list = '<option value="'+selected_subCategory+'">'+selected_subCategory+'</option> +';
          data=JSON.parse(data);
            data.forEach((subcategory)=>{
              if(subcategory.name != selected_subCategory){
                list+='<option value="'+subcategory.name+'">'+subcategory.name+'</option>';
              }
            });
            $("#sub_category_c").html(list);
      },
    });
    }
    
   
  
  //--------------------------------------------------------onchange category -------------------------
  
  categoryFunction = function(category){
   
   
    $.ajax({
      type: "POST",
     url:
        "index.php?module=Documents&action=subCategory",
      data: { category_name:category },
      success: function (data) {
       
          // $("#sub_sector1_c").append(data);
         $("#sub_category_c").replaceWith('<select name="sub_category_c" id="sub_category_c"></select>');
             var list = '<option value=""></option> +';
          
          data=JSON.parse(data);
            data.forEach((subcategory)=>{
            
                list+='<option value="'+subcategory.name+'">'+subcategory.name+'</option>';
              
            });
            $("#sub_category_c").html(list);
      },
    });
  }
  
   //--------------------------------------------------------onchange category -------------------------
  
  
  //-----------------------------------------------Astericks--------------------------------------
   if ($("[data-label=LBL_STATUS] span").text() == "") {
             $("[data-label=LBL_STATUS]").append(
              "<span style='color:red;'>*</span>"
              );
               } 
               
    if ($("[data-label=LBL_TEMPLATE_TYPE] span").text() == "") {
             $("[data-label=LBL_TEMPLATE_TYPE]").append(
              "<span style='color:red;'>*</span>"
              );
               }           
               
    if ($("[data-label='RELATED TO'] span").text() == "") {
             $("[data-label='RELATED TO']").append(
              "<span style='color:red;'>*</span>"
              );
               } 
               
    if ($("[data-label=LBL_APPROVER] span").text() == "") {
             $("[data-label=LBL_APPROVER]").append(
              "<span style='color:red;'>*</span>"
              );
               }      
    
     if ($("[data-label=LBL_ASSIGNED_TO_NAME] span").text() == "") {
             $("[data-label=LBL_ASSIGNED_TO_NAME]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
     if ($("[data-label=LBL_CATEGORY] span").text() == "") {
             $("[data-label=LBL_CATEGORY]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               
    if ($("[data-label=LBL_SUB_CATEGORY] span").text() == "") {
             $("[data-label=LBL_SUB_CATEGORY]").append(
              "<span style='color:red;'>*</span>"
              );
               }           
  //-----------------------------------------------Astericks------END--------------------------------
  
  //------------------------------------Custom Validation--------------------------------------------
    check_form = function(view){
        var validate = true;
         var alert_validation = [];
         
        if($('#status_c').val()==''){
            
             alert_validation.push("Status");
            
              $("#status_c").css("background-color", "Red");
               validate = false;
        }
        
         if($('#parent_name').val()==''){
            
             alert_validation.push("Related To");
            
              $("#parent_name").css("background-color", "Red");
               validate = false;
        }
        
         if($('#template_type').val()==''){
            
             alert_validation.push("Document Type");
            
              $("#template_type").css("background-color", "Red");
               validate = false;
         }
         
          if($('#category_c').val()==''){
            
             alert_validation.push("Category");
            
              $("#category_c").css("background-color", "Red");
               validate = false;
         }
         
         if($('#sub_category_c').val()==''){
            
             alert_validation.push("Sub Category");
            
              $("#sub_category_c").css("background-color", "Red");
               validate = false;
         }
       
       
       //------------------------------------- 
           if(validate == false){
           if(alert_validation.length>0) {
            alert(`Please fill the required fields : \n${alert_validation.join('\n')} `);
           }
             
          }
        
        if(validate && check_form(view)) {
            alert_validation = [];
              return true;
        }
        else {
              return false;
        }
    }
   //------------------------------------Custom Validation--------------------------------------------
   
        $("#status_c").on("click", function () {
  //console.log("if in");
        
          if ($("#status_c").css("background-color", "Red")) {
            // console.log("check in");
        
            $("#status_c").css("background-color", "#d8f5ee");
          }
    });
    
     $("[field=template_type]").on("click", function () {
  //console.log("if in");
        
          if ($("#template_type").css("background-color", "Red")) {
            // console.log("check in");
        
            $("#template_type").css("background-color", "#d8f5ee");
          }
    });
    
    $("#category_c").on("click", function () {
  //console.log("if in");
        
          if ($("#category_c").css("background-color", "Red")) {
            // console.log("check in");
        
            $("#category_c").css("background-color", "#d8f5ee");
          }
    });
   
     $("#sub_category_c").on("click", function () {
  //console.log("if in");
        
          if ($("#sub_category_c").css("background-color", "Red")) {
            // console.log("check in");
        
            $("#sub_category_c").css("background-color", "#d8f5ee");
          }
    });
    
    $("#parent_name").on("click", function () {
  //console.log("if in");
        
          if ($("#parent_name").css("background-color", "Red")) {
            // console.log("check in");
        
            $("#parent_name").css("background-color", "#d8f5ee");
          }
    });
   
  
//***************************************Write code above this line***************************************  
});