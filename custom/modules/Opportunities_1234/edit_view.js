$(document).ready(function(){
 
  setTimeout(function() {
      $('#check a').hide();
      //console.log('sad');
 }, 10);
 
  $("#grouptab").hide();
 $('#financial_feasibility_l1_c').css('background-color','green');
    //console.log('checking');
    // $('.actionmenulinks').first().hide();
    // $('.actionmenulinks').first().hide();
   
     $.ajax({
        url : 'index.php?module=Opportunities&action=sales_create_opportunity',
        type : 'POST',
        dataType: "json",
        success : function(data){
            if(data.status == true){
                if(data.view == 'no'){
                    var create_query_string = 'action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26action%3DEditView%26return_module%3DOpportunities%26return_action%3DDetailView';
                    var url = window.location.href;
                    var queryString = url ? url.split('?')[1] : window.location.search.slice(1);
                    if (queryString == create_query_string || ($_GET('module') == 'Opportunities' && $_GET('action') == 'EditView' && $_GET('record') == '' )) {
                        alert("You are not authorized to create.");
                        window.location.replace(window.location.href.split('?')[0]+"?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26action%3Dindex%26return_module%3DOpportunities%26return_action%3DDetailView");
                    }
                }
            }
        }
    });
//-----------------------------------------------------------------------------------------------------------------------------    
 
 var base_url = window.location.href.split('?')[0];  
 
 
   
 //--------- hiding  button edit mode ------------------------------------------------  
 
 $(".saveAndContinue").css("display","none");

               
   $('input[name="send_approval_button"]').hide();
     
    $('input[name="approve_button"]').hide();
    $('input[name="reject_button"]').hide();
 
 //--------- hiding button edit mode -----------------END-------------------------------
 
 
 
 
 
 //-----------------------------------For Approve or reject or Send for approval button---------------------------
 var opp_id=$('#EditView input[name=record]').val();
   //alert(opp_id);
    
 if (opp_id!=''){
  
   var status=$('#status_c').val();
      var rfp_eoi_published=$('#rfporeoipublished_c').val();
     var apply_for=$('#applyfor_c').val();
     var date_time=Date();
   
    
     
      $.ajax({
        url : 'index.php?module=Opportunities&action=approval_buttons',
        type : 'POST',
        data: {
            opp_id,
            status,
            rfp_eoi_published,
            apply_for
            
        },
        success : function(data1){
            
             ////alert(data);
            var data = JSON.parse(data1);
           // var data=dat;
           //console.log(data.button);
            
           if(data.button=='send_approval') {
            
              
                  if( $("#status_c").val()=="Closed"  ){ 
      
                                   $("#send_approval").css("display","none");
                              }
                                 else if( $("#status_c").val()=="Dropped"){
                                     
                                  
                                  
                                   $("#send_approval").css("display","none");
                                   
                              } 
                              else if($("#status_c").val()=="Lead"){ 
                                  
                                    
                                     $("#send_approval").css("display","inline");
                                     
                                 }
                                 
                                 else if($("#status_c").val()=="QualifiedLead"){ 
                                     
                                     $("#send_approval").css("display","inline");
                                     
                                 }
                                  else if($("#status_c").val()=="Qualified"){ 
                                     
                                     $("#send_approval").css("display","inline");
                                     
                                 }
                                 else if($("#status_c").val()=="QualifiedDpr"){ 
                                     
                                     $("#send_approval").css("display","inline");
                                     
                                 }
                                 else if($("#status_c").val()=="QualifiedBid"){ 
                                     
                                     $("#send_approval").css("display","inline");
                                     
                                 }
                                  
              
        }
           
                   else   if(data.button=='send_approval_next') {
                          
                            
                            
                          
                             
   
                
                    }
           
                  else  if(data.button=='send_approval_same'){
                        
                       
                        $("#send_approval").css("display","inline");
                         $("#approve").css("display","inline");
                        
                       $("#approve").replaceWith('<h3 id="approve" style="color: red; display: inline;">Rejected ,make change in opportunity and resend for Approval</h3>')
                    }
           
           
           
                    else   if(data.button=='pending') {
                  $("#send_approval").css("display","inline");
      
                   $("#send_approval").replaceWith('<h3 id="send_approval" style="color: red; display: inline;">Approval Pending</h3>')
                   }
           
           
                else  if(data.button=='approve_reject'){
                  
                      $("#approve").css("display","inline");
                      $("#reject").css("display","inline"); 
               
               
                 }
     
            }
      });
 }
 
  //-----------------------------------For Approve or reject or Send for approval button---------END------------------
 
 //-----------------------------Send for Approval---------------------------------------------
 $('#send_approval').on('click',function validation(view){
     //console.log('send');
     
      
  
  // console.log('sadsnds');
  
     var validate = true;
   
     var form_validation = $("#rfporeoipublished_c").val();
    var alert_validation = [];
     
   //-----------------onload lead status validation for all cases----------------       
    if (form_validation == "yes" || form_validation == "no" || form_validation == "not_required") {
      
                if($("#name").val() == ""){
           validate = false;
           alert_validation.push("Opportunity name");
           $("#name").css("background-color", "Red");
          }
          if($("#state_c").val() == ""){
           validate = false;
            alert_validation.push("State");
           $("#state_c").css("background-color", "Red");
          }
          if($("#account_name").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#account_name").css("background-color", "Red");
          }
          if($("#source_c").val() == ""){
           validate = false;
           alert_validation.push("Source");
           $("#source_c").css("background-color", "Red");
          }
          if($("#product_service_c").val() == ""){
           validate = false;
           alert_validation.push("Product/Service");
           $("#product_service_c").css("background-color", "Red");
          }
          // if($("#non_financial_consideration_c").val() == ""){
          //  validate = false;
          //  alert_validation.push("Non Financial Consideration");
          //  $("#non_financial_consideration_c").css("background-color", "Red");
          // }
          
          
            if($("#segment_c").val() == ""){
                     validate = false;
                     alert_validation.push("Segment");
                     $("#segment_c").css("background-color", "Red");
                    }
                    
                    
          if(validate == false){
           if(alert_validation.length>0) {
            alert(`Please fill the required fields : \n${alert_validation.join('\n')} `);
           }
             
          }
         
             // if (validate && check_form(view)) {
             //   return true;
             // } else {
             //   return false;
             // }
             
             
          
          
  }
  
   //-----------------onload lead status validation for all cases---------END-------    
          
    //--------------------validation for no case and different status-----------------------      
          if($("#status_c").val()=="QualifiedLead" && $("#rfporeoipublished_c").val()=="no"){
                  
   
             if($("#name").val() == ""){
           validate = false;
           alert_validation.push("Opportunity name");
           $("#name").css("background-color", "Red");
          }
          if($("#state_c").val() == ""){
           validate = false;
            alert_validation.push("State");
           $("#state_c").css("background-color", "Red");
          }
          if($("#account_name").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#account_name").css("background-color", "Red");
          }
          if($("#source_c").val() == ""){
           validate = false;
           alert_validation.push("Source");
           $("#source_c").css("background-color", "Red");
          }
          if($("#product_service_c").val() == ""){
           validate = false;
           alert_validation.push("Product/Service");
           $("#product_service_c").css("background-color", "Red");
          }
          // if($("#non_financial_consideration_c").val() == ""){
          //  validate = false;
          //  alert_validation.push("Non Financial Consideration");
          //  $("#non_financial_consideration_c").css("background-color", "Red");
          // }
          
          
            if($("#segment_c").val() == ""){
                     validate = false;
                     alert_validation.push("Segment");
                     $("#segment_c").css("background-color", "Red");
                    }
             
               if($("#sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
               alert_validation.push("Sector");
              $("#sector_c").css("background-color", "Red");
             } 
             
               if($("#sub_sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
               alert_validation.push("Sub Sector");
              $("#sub_sector_c").css("background-color", "Red");
             } 
             
               if($("#risk_c").val() == ""){
                      //console.log("ps");
              validate = false;
               alert_validation.push("Risk");
              $("#risk_c").css("background-color", "Red");
             } 
             
                 if($("#scope_budget_projected_c").val() == ""){
              validate = false;
               alert_validation.push("DPR/Scope & Budget Accepted (Projected)");
              $("#scope_budget_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_projected_c").val() == ""){
              validate = false;
              $("#rfp_eoi_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_projected_c").val() == ""){
              validate = false;
              $("#rfp_eoi_published_projected_c").css("background-color", "Red");
             }
             if($("#work_order_projected_c").val() == ""){
              validate = false;
              $("#work_order_projected_c").css("background-color", "Red");
             }
            
             if($('#startYear').val()==""){
              validate = false;
              alert_validation.push("L1 Details");
              $('[field=financial_feasibility_l1_c]').append("<span class='message_lbl' style='color:red;'>"+"<br>Please fill Financial Feasibity L1</span>")
             }
             else{
                           $('.message_lbl').remove();
             }
             
             if(validate == false){
           if(alert_validation.length>0) {
            alert(`Please fill the required fields : \n${alert_validation.join('\n')} `);
           }
             
          }
            
                // if (validate && check_form(view)) {
                //   return true;
                // } else {
                //   return false;
                // }
              
            }
            
          if($("#status_c").val()=="Qualified" && form_validation == "no"){
              
               
             if($("#name").val() == ""){
              validate = false;
              alert_validation.push("Opportunity name");
              $("#name").css("background-color", "Red");
             }
             if($("#state_c").val() == ""){
              validate = false;
              alert_validation.push("State");
              $("#state_c").css("background-color", "Red");
             }
             if($("#account_name").val() == ""){
              validate = false;
               alert_validation.push("Department");
              $("#account_name").css("background-color", "Red");
             }
             if($("#source_c").val() == ""){
              validate = false;
               alert_validation.push("Source");
              $("#source_c").css("background-color", "Red");
             }
          
             
            var cumalitive = $("#cum td input").val();
                    
                     if(cumalitive == ""||cumalitive==0){
                      
                      validate = false;
                      
                       alert_validation.push("L2 Details");
                      
                      $('[field=financial_feasibility_l2_c]').append("<span class='message_lbl' style='color:red;'>"+"<br>Please fill Financial Feasibity L2</span>")
             }
             else{
                           $('.message_lbl').remove();
             }
             
             // if($("#non_financial_consideration_c").val() == ""){
             //  validate = false;
               
             //  $("#non_financial_consideration_c").css("background-color", "Red");
             // }
                 if($("#budget_source_c").val() == ""){
              validate = false;
               alert_validation.push("Budget Source");
              $("#budget_source_c").css("background-color", "Red");
             }
              if($("#budget_head_c").val() == ""){
              validate = false;
               alert_validation.push("Budget Head");
              $("#budget_head_c").css("background-color", "Red");
             }
              if($("#budget_head_amount_c").val() == ""){
              validate = false;
              alert_validation.push("Budget Head Amount (in Cr)");
              $("#budget_head_amount_c").css("background-color", "Red");
             }
              if($("#project_implementation_start_c").val() == ""){
              validate = false;
              alert_validation.push("Project Implementation Start Date");
              $("#project_implementation_start_c").css("background-color", "Red");
             }
              if($("#project_implementation_end_c").val() == ""){
              validate = false;
              alert_validation.push("Project Implementation End Date");
              $("#project_implementation_end_c").css("background-color", "Red");
             }
              if($("#budget_allocated_oppertunity_c").val() == ""){
              validate = false;
              alert_validation.push("Budget Allocated for Oportunity (in Cr)");
              $("#budget_allocated_oppertunity_c").css("background-color", "Red");
             }
             
             if($("#segment_c").val() == ""){
              validate = false;
              alert_validation.push("Segment");
              $("#segment_c").css("background-color", "Red");
             }

                 if($("#product_service_c").val() == ""){
                     // console.log("ps");
              validate = false;
              alert_validation.push("Product/Service");
              $("#product_service_c").css("background-color", "Red");
             } 
             
               if($("#sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
              alert_validation.push("Sector");
              $("#sector_c").css("background-color", "Red");
             } 
             
               if($("#sub_sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
              alert_validation.push("Sub Sector");
              $("#sub_sector_c").css("background-color", "Red");
             } 
             
               if($("#risk_c").val() == ""){
                     // console.log("ps");
              validate = false;
              alert_validation.push("Risk");
              $("#risk_c").css("background-color", "Red");
             } 
             
                  if($("#scope_budget_projected_c").val() == ""){
              validate = false;
              alert_validation.push("DPR/Scope & Budget Accepted (Projected)");
              $("#scope_budget_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_projected_c").val() == ""){
              validate = false;
              $("#rfp_eoi_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_projected_c").val() == ""){
              validate = false;
              $("#rfp_eoi_published_projected_c").css("background-color", "Red");
             }
             if($("#work_order_projected_c").val() == ""){
              validate = false;
              $("#work_order_projected_c").css("background-color", "Red");
             }
            
             
             //  if($("#rfp_eoi_summary_c").val() == ""){
             //  validate = false;
             //  $("#rfp_eoi_summary_c").css("background-color", "Red");
             // }
             
             if($("#project_scope_c").val() == ""){
              validate = false;
              alert_validation.push("Project Scope");
              $("#project_scope_c").css("background-color", "Red");
             }
              if($("#selection_c").val() == ""){
              validate = false;
              
              $("#selection_c").css("background-color", "Red");
             }
              if($("#funding_c").val() == ""){
              validate = false;
              $("#funding_c").css("background-color", "Red");
             }
              if($("#timing_button_c").val() == ""){
              validate = false;
              $("#timing_button_c").css("background-color", "Red");
             }
             
             if(validate == false){
           if(alert_validation.length>0) {
            alert(`Please fill the required fields : \n${alert_validation.join('\n')} `);
           }
             
          }
            
                // if (validate && check_form(view)) {
                //   return true;
                // } else {
                //   return false;
                // }
              
            }
            
          if($("#status_c").val()=="QualifiedDpr" && form_validation == "no"){
             
              var file_name=$('#filename_file').val();
             
             if(file_name ==""){
              
              if($('#filename_old a').text()==""){
              $("#filename_file").css("background-color", "Red");
              validate=false;
              alert_validation.push("File Name");
               
              }
              
             }
             
             var cumalitive = $("#cum td input").val();
                    
                     if(cumalitive == ""||cumalitive==0){
                      
                      validate = false;
                      alert_validation.push("L2 Details");
                      
                      $('[field=financial_feasibility_l2_c]').append("<span class='message_lbl' style='color:red;'>"+"<br>Please fill Financial Feasibity L2</span>")
             }
             else{
                           $('.message_lbl').remove();
             }
             
             if($("#name").val() == ""){
              validate = false;
              alert_validation.push("Opportunity Name");
              $("#name").css("background-color", "Red");
             }
             if($("#state_c").val() == ""){
              validate = false;
              alert_validation.push("State");
              $("#state_c").css("background-color", "Red");
             }
             if($("#account_name").val() == ""){
              validate = false;
              alert_validation.push("Department");
              $("#account_name").css("background-color", "Red");
             }
             if($("#source_c").val() == ""){
              validate = false;
              alert_validation.push("Source");
              $("#source_c").css("background-color", "Red");
             }
            
             
             // if($("#non_financial_consideration_c").val() == ""){
             //  validate = false;
             //  $("#non_financial_consideration_c").css("background-color", "Red");
             // }
                 if($("#budget_source_c").val() == ""){
              validate = false;
              alert_validation.push("Budget Source");
              $("#budget_source_c").css("background-color", "Red");
             }
              if($("#budget_head_c").val() == ""){
              validate = false;
              alert_validation.push("Budget Head");
              $("#budget_head_c").css("background-color", "Red");
             }
              if($("#budget_head_amount_c").val() == ""){
              validate = false;
              alert_validation.push("Budget Head Amount (in Cr)");
              $("#budget_head_amount_c").css("background-color", "Red");
             }
              if($("#project_implementation_start_c").val() == ""){
              validate = false;
              alert_validation.push("Project Implementation Start Date");
              $("#project_implementation_start_c").css("background-color", "Red");
             }
              if($("#project_implementation_end_c").val() == ""){
              validate = false;
              alert_validation.push("Project Implementation End Date");
              $("#project_implementation_end_c").css("background-color", "Red");
             }
              if($("#budget_allocated_oppertunity_c").val() == ""){
              validate = false;
              alert_validation.push("Budget Allocated for Oportunity (in Cr)");
              $("#budget_allocated_oppertunity_c").css("background-color", "Red");
             }
             
             if($("#segment_c").val() == ""){
              validate = false;
              alert_validation.push("Segment");
              $("#segment_c").css("background-color", "Red");
             }

                 if($("#product_service_c").val() == ""){
                      //console.log("ps");
              validate = false;
              alert_validation.push("Product/Service");
              $("#product_service_c").css("background-color", "Red");
             } 
             
               if($("#sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
              alert_validation.push("Sector");
              $("#sector_c").css("background-color", "Red");
             } 
             
               if($("#sub_sector_c").val() == ""){
                     // console.log("ps");
              validate = false;
              alert_validation.push("Sub Sector");
              $("#sub_sector_c").css("background-color", "Red");
             } 
             
               if($("#risk_c").val() == ""){
                     // console.log("ps");
              validate = false;
              alert_validation.push("Risk");
              $("#risk_c").css("background-color", "Red");
             } 
             
                  if($("#scope_budget_projected_c").val() == ""){
              validate = false;
              alert_validation.push("DPR/Scope & Budget Accepted (Projected)");
              $("#scope_budget_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_projected_c").val() == ""){
              validate = false;
              $("#rfp_eoi_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_projected_c").val() == ""){
              validate = false;
              $("#rfp_eoi_published_projected_c").css("background-color", "Red");
             }
             if($("#work_order_projected_c").val() == ""){
              validate = false;
              $("#work_order_projected_c").css("background-color", "Red");
             }
            
           
             
              if($("#rfp_eoi_summary_c").val() == ""){
              validate = false;
               alert_validation.push("RFP/EOI Summary");
              $("#rfp_eoi_summary_c").css("background-color", "Red");
             }
             
                 if($("#project_scope_c").val() == ""){
              validate = false;
              alert_validation.push("Project Scope");
              $("#project_scope_c").css("background-color", "Red");
             }
             
             //  if($("#influencersl2_c").val() == ""){
             //  validate = false;
             //  $("#influencersl2_c").css("background-color", "Red");
             // }
              if($("#bid_strategy_c").val() == ""){
              validate = false;
              alert_validation.push("Bid Strategy");
              $("#bid_strategy_c").css("background-color", "Red");
             }
              if($("#submissionstatus_c").val() == ""){
              validate = false;
              alert_validation.push("Submission Status");
              $("#submissionstatus_c").css("background-color", "Red");
             }
              if($("#selection_c").val() == ""){
              validate = false;
              $("#selection_c").css("background-color", "Red");
             }
              if($("#funding_c").val() == ""){
              validate = false;
              $("#funding_c").css("background-color", "Red");
             }
              if($("#timing_button_c").val() == ""){
              validate = false;
              $("#timing_button_c").css("background-color", "Red");
             }
             
             
             
             if(validate == false){
           if(alert_validation.length>0) {
            alert(`Please fill the required fields : \n${alert_validation.join('\n')} `);
           }
             
          }
            
                // if (validate && check_form(view)) {
                //   return true;
                // } else {
                //   return false;
                // }
              
            }
            
          if($("#status_c").val()=="QualifiedBid" && form_validation == "no"){
             
             var file_name=$('#filename_file').val();
             
             if(file_name ==""){
              
              if($('#filename_old a').text()==""){
              $("#filename_file").css("background-color", "Red");
              validate=false;
               alert_validation.push("File Name");
              }
              
             }
             var cumalitive = $("#cum td input").val();
                    
                     if(cumalitive == ""||cumalitive==0){
                      
                      validate = false;
                      
                      alert_validation.push("L2 Details");
                      $('[field=financial_feasibility_l2_c]').append("<span class='message_lbl' style='color:red;'>"+"<br>Please fill Financial Feasibity L2</span>")
             }
             else{
                           $('.message_lbl').remove();
             }
             if($("#name").val() == ""){
              validate = false;
              alert_validation.push("Oppertunity name");
              $("#name").css("background-color", "Red");
             }
             if($("#state_c").val() == ""){
              validate = false;
              alert_validation.push("state");
              $("#state_c").css("background-color", "Red");
             }
             if($("#account_name").val() == ""){
              validate = false;
              alert_validation.push("Department");
              $("#account_name").css("background-color", "Red");
             }
             if($("#source_c").val() == ""){
              validate = false;
              alert_validation.push("Source");
              $("#source_c").css("background-color", "Red");
             }
            
             
             // if($("#non_financial_consideration_c").val() == ""){
             //  validate = false;
             //  $("#non_financial_consideration_c").css("background-color", "Red");
             // }
                 if($("#budget_source_c").val() == ""){
              validate = false;
              alert_validation.push("Budget Source");
              $("#budget_source_c").css("background-color", "Red");
             }
              if($("#budget_head_c").val() == ""){
              validate = false;
              alert_validation.push("Budget Head");
              $("#budget_head_c").css("background-color", "Red");
             }
              if($("#budget_head_amount_c").val() == ""){
              validate = false;
              alert_validation.push("Budget Head Amount (in Cr)");
              $("#budget_head_amount_c").css("background-color", "Red");
             }
              if($("#project_implementation_start_c").val() == ""){
              validate = false;
              alert_validation.push("Project Implementation Start Date");
              $("#project_implementation_start_c").css("background-color", "Red");
             }
              if($("#project_implementation_end_c").val() == ""){
              validate = false;
              alert_validation.push("Project Implementation End Date");
              $("#project_implementation_end_c").css("background-color", "Red");
             }
              if($("#budget_allocated_oppertunity_c").val() == ""){
              validate = false;
              alert_validation.push("Budget Allocated for Oportunity (in Cr)");
              $("#budget_allocated_oppertunity_c").css("background-color", "Red");
             }
             
             if($("#segment_c").val() == ""){
              validate = false;
              alert_validation.push("Segment");
              $("#segment_c").css("background-color", "Red");
             }

                 if($("#product_service_c").val() == ""){
                     // console.log("ps");
              validate = false;
              alert_validation.push("Product/Service");
              $("#product_service_c").css("background-color", "Red");
             } 
             
               if($("#sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
              alert_validation.push("Sector");
              $("#sector_c").css("background-color", "Red");
             } 
             
               if($("#sub_sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
              alert_validation.push("Sub Sector");
              $("#sub_sector_c").css("background-color", "Red");
             } 
             
               if($("#risk_c").val() == ""){
                     // console.log("ps");
              validate = false;
              alert_validation.push("Risk");
              $("#risk_c").css("background-color", "Red");
             } 
             
                  if($("#scope_budget_projected_c").val() == ""){
              validate = false;
              alert_validation.push("DPR/Scope & Budget Accepted (Projected)");
              $("#scope_budget_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_projected_c").val() == ""){
              validate = false;
              
              $("#rfp_eoi_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_projected_c").val() == ""){
              validate = false;
              $("#rfp_eoi_published_projected_c").css("background-color", "Red");
             }
             if($("#work_order_projected_c").val() == ""){
              validate = false;
              $("#work_order_projected_c").css("background-color", "Red");
             }
             
             
              if($("#rfp_eoi_summary_c").val() == ""){
              validate = false;
              alert_validation.push("RFP/EOI Summary");
              $("#rfp_eoi_summary_c").css("background-color", "Red");
             }
             
             
                 if($("#project_scope_c").val() == ""){
              validate = false;
              alert_validation.push("Project Scope");
              $("#project_scope_c").css("background-color", "Red");
             }
             
             
              if($("#bid_strategy_c").val() == ""){
              validate = false;
              alert_validation.push("Bid Strategy");
              $("#bid_strategy_c").css("background-color", "Red");
             }
              if($("#submissionstatus_c").val() == ""){
              validate = false;
              alert_validation.push("RFP/EOI Summary");
              $("#submissionstatus_c").css("background-color", "Red");
             }
             
              if($("#learnings_c").val() == ""){
              validate = false;
              alert_validation.push("Learnings");
              $("#learnings_c").css("background-color", "Red");
             }
             
              if($("#closure_status_c").val() == ""){
              validate = false;
              alert_validation.push("Closure Status");
              $("#closure_status_c").css("background-color", "Red");
             }
             
               if($("#selection_c").val() == ""){
              validate = false;
              $("#selection_c").css("background-color", "Red");
             }
              if($("#funding_c").val() == ""){
              validate = false;
              $("#funding_c").css("background-color", "Red");
             }
              if($("#timing_button_c").val() == ""){
              validate = false;
              $("#timing_button_c").css("background-color", "Red");
             }
             
             
             
             if(validate == false){
           if(alert_validation.length>0) {
            alert(`Please fill the required fields : \n${alert_validation.join('\n')} `);
           }
             
          }
            
                // if (validate && check_form(view)) {
                //   return true;
                // } else {
                //   return false;
                // }
              
            }
          
    //--------------------validation for no case and different status-----END------------------
    
     //--------------------validation for not required case and different status-----------------------
 if($("#status_c").val()=="QualifiedLead" && $("#rfporeoipublished_c").val()=="not_required"){
                  
   
             if($("#name").val() == ""){
           validate = false;
           alert_validation.push("Opportunity name");
           $("#name").css("background-color", "Red");
          }
          if($("#state_c").val() == ""){
           validate = false;
            alert_validation.push("State");
           $("#state_c").css("background-color", "Red");
          }
          if($("#account_name").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#account_name").css("background-color", "Red");
          }
          if($("#source_c").val() == ""){
           validate = false;
           alert_validation.push("Source");
           $("#source_c").css("background-color", "Red");
          }
          if($("#product_service_c").val() == ""){
           validate = false;
           alert_validation.push("Product/Service");
           $("#product_service_c").css("background-color", "Red");
          }
          // if($("#non_financial_consideration_c").val() == ""){
          //  validate = false;
          //  alert_validation.push("Non Financial Consideration");
          //  $("#non_financial_consideration_c").css("background-color", "Red");
          // }
          
          
            if($("#segment_c").val() == ""){
                     validate = false;
                     alert_validation.push("Segment");
                     $("#segment_c").css("background-color", "Red");
                    }
             
               if($("#sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
               alert_validation.push("Sector");
              $("#sector_c").css("background-color", "Red");
             } 
             
               if($("#sub_sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
               alert_validation.push("Sub Sector");
              $("#sub_sector_c").css("background-color", "Red");
             } 
             
               if($("#risk_c").val() == ""){
                      //console.log("ps");
              validate = false;
               alert_validation.push("Risk");
              $("#risk_c").css("background-color", "Red");
             } 
             
                 if($("#scope_budget_projected_c").val() == ""){
              validate = false;
               alert_validation.push("DPR/Scope & Budget Accepted (Projected)");
              $("#scope_budget_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_projected_c").val() == ""){
              validate = false;
              $("#rfp_eoi_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_projected_c").val() == ""){
              validate = false;
              $("#rfp_eoi_published_projected_c").css("background-color", "Red");
             }
             if($("#work_order_projected_c").val() == ""){
              validate = false;
              $("#work_order_projected_c").css("background-color", "Red");
             }
            
             if($('#startYear').val()==""){
              validate = false;
              alert_validation.push("L1 Details");
              $('[field=financial_feasibility_l1_c]').append("<span class='message_lbl' style='color:red;'>"+"<br>Please fill Financial Feasibity L1</span>")
             }
             else{
                           $('.message_lbl').remove();
             }
             
             if(validate == false){
           if(alert_validation.length>0) {
            alert(`Please fill the required fields : \n${alert_validation.join('\n')} `);
           }
             
          }
            
                // if (validate && check_form(view)) {
                //   return true;
                // } else {
                //   return false;
                // }
              
            }
            
          if($("#status_c").val()=="Qualified" && form_validation == "not_required"){
              
               
             if($("#name").val() == ""){
              validate = false;
              alert_validation.push("Opportunity name");
              $("#name").css("background-color", "Red");
             }
             if($("#state_c").val() == ""){
              validate = false;
              alert_validation.push("State");
              $("#state_c").css("background-color", "Red");
             }
             if($("#account_name").val() == ""){
              validate = false;
               alert_validation.push("Department");
              $("#account_name").css("background-color", "Red");
             }
             if($("#source_c").val() == ""){
              validate = false;
               alert_validation.push("Source");
              $("#source_c").css("background-color", "Red");
             }
          
             
            var cumalitive = $("#cum td input").val();
                    
                     if(cumalitive == ""||cumalitive==0){
                      
                      validate = false;
                      
                       alert_validation.push("L2 Details");
                      
                      $('[field=financial_feasibility_l2_c]').append("<span class='message_lbl' style='color:red;'>"+"<br>Please fill Financial Feasibity L2</span>")
             }
             else{
                           $('.message_lbl').remove();
             }
             
             // if($("#non_financial_consideration_c").val() == ""){
             //  validate = false;
               
             //  $("#non_financial_consideration_c").css("background-color", "Red");
             // }
                 if($("#budget_source_c").val() == ""){
              validate = false;
               alert_validation.push("Budget Source");
              $("#budget_source_c").css("background-color", "Red");
             }
              if($("#budget_head_c").val() == ""){
              validate = false;
               alert_validation.push("Budget Head");
              $("#budget_head_c").css("background-color", "Red");
             }
              if($("#budget_head_amount_c").val() == ""){
              validate = false;
              alert_validation.push("Budget Head Amount (in Cr)");
              $("#budget_head_amount_c").css("background-color", "Red");
             }
              if($("#project_implementation_start_c").val() == ""){
              validate = false;
              alert_validation.push("Project Implementation Start Date");
              $("#project_implementation_start_c").css("background-color", "Red");
             }
              if($("#project_implementation_end_c").val() == ""){
              validate = false;
              alert_validation.push("Project Implementation End Date");
              $("#project_implementation_end_c").css("background-color", "Red");
             }
              if($("#budget_allocated_oppertunity_c").val() == ""){
              validate = false;
              alert_validation.push("Budget Allocated for Oportunity (in Cr)");
              $("#budget_allocated_oppertunity_c").css("background-color", "Red");
             }
             
             if($("#segment_c").val() == ""){
              validate = false;
              alert_validation.push("Segment");
              $("#segment_c").css("background-color", "Red");
             }

                 if($("#product_service_c").val() == ""){
                     // console.log("ps");
              validate = false;
              alert_validation.push("Product/Service");
              $("#product_service_c").css("background-color", "Red");
             } 
             
               if($("#sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
              alert_validation.push("Sector");
              $("#sector_c").css("background-color", "Red");
             } 
             
               if($("#sub_sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
              alert_validation.push("Sub Sector");
              $("#sub_sector_c").css("background-color", "Red");
             } 
             
               if($("#risk_c").val() == ""){
                     // console.log("ps");
              validate = false;
              alert_validation.push("Risk");
              $("#risk_c").css("background-color", "Red");
             } 
             
                  if($("#scope_budget_projected_c").val() == ""){
              validate = false;
              alert_validation.push("DPR/Scope & Budget Accepted (Projected)");
              $("#scope_budget_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_projected_c").val() == ""){
              validate = false;
              $("#rfp_eoi_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_projected_c").val() == ""){
              validate = false;
              $("#rfp_eoi_published_projected_c").css("background-color", "Red");
             }
             if($("#work_order_projected_c").val() == ""){
              validate = false;
              $("#work_order_projected_c").css("background-color", "Red");
             }
            
             
             //  if($("#rfp_eoi_summary_c").val() == ""){
             //  validate = false;
             //  $("#rfp_eoi_summary_c").css("background-color", "Red");
             // }
             
             if($("#project_scope_c").val() == ""){
              validate = false;
              alert_validation.push("Project Scope");
              $("#project_scope_c").css("background-color", "Red");
             }
              if($("#selection_c").val() == ""){
              validate = false;
              
              $("#selection_c").css("background-color", "Red");
             }
              if($("#funding_c").val() == ""){
              validate = false;
              $("#funding_c").css("background-color", "Red");
             }
              if($("#timing_button_c").val() == ""){
              validate = false;
              $("#timing_button_c").css("background-color", "Red");
             }
             
             if(validate == false){
           if(alert_validation.length>0) {
            alert(`Please fill the required fields : \n${alert_validation.join('\n')} `);
           }
             
          }
            
                // if (validate && check_form(view)) {
                //   return true;
                // } else {
                //   return false;
                // }
              
            }
            
       if($("#status_c").val()=="QualifiedDpr" && form_validation == "not_required"){
             
             var cumalitive = $("#cum td input").val();
                    
                     if(cumalitive == ""||cumalitive==0){
                      
                      validate = false;
                      
                      $('[field=financial_feasibility_l2_c]').append("<span class='message_lbl' style='color:red;'>"+"<br>Please fill Financial Feasibity L2</span>")
                      
                       alert_validation.push("L2 Details");
             }
             else{
                           $('.message_lbl').remove();
             }
             
             if($("#name").val() == ""){
              validate = false;
              $("#name").css("background-color", "Red");
               alert_validation.push("Opportunity Name");
              
             }
             if($("#state_c").val() == ""){
              validate = false;
              $("#state_c").css("background-color", "Red");
               alert_validation.push("State");
             }
             if($("#account_name").val() == ""){
              validate = false;
              $("#account_name").css("background-color", "Red");
               alert_validation.push("Department");
             }
             if($("#source_c").val() == ""){
              validate = false;
              $("#source_c").css("background-color", "Red");
               alert_validation.push("Source");
             }
            
             
             // if($("#non_financial_consideration_c").val() == ""){
             //  validate = false;
             //  $("#non_financial_consideration_c").css("background-color", "Red");
             // }
                 if($("#budget_source_c").val() == ""){
              validate = false;
              $("#budget_source_c").css("background-color", "Red");
               alert_validation.push("Budget Source");
             }
              if($("#budget_head_c").val() == ""){
              validate = false;
              $("#budget_head_c").css("background-color", "Red");
               alert_validation.push("Budget Head");
             }
              if($("#budget_head_amount_c").val() == ""){
              validate = false;
              $("#budget_head_amount_c").css("background-color", "Red");
               alert_validation.push("Budget Head Amount (in Cr)");
             }
              if($("#project_implementation_start_c").val() == ""){
              validate = false;
              $("#project_implementation_start_c").css("background-color", "Red");
              alert_validation.push("Project Implementation Start Date");
             }
              if($("#project_implementation_end_c").val() == ""){
              validate = false;
              $("#project_implementation_end_c").css("background-color", "Red");
              alert_validation.push("Project Implementation End Date");
              
             }
              if($("#budget_allocated_oppertunity_c").val() == ""){
              validate = false;
              $("#budget_allocated_oppertunity_c").css("background-color", "Red");
              alert_validation.push("Budget Allocated for Opportunity (in Cr)");
             }
             
             if($("#segment_c").val() == ""){
              validate = false;
              $("#segment_c").css("background-color", "Red");
              alert_validation.push("Segment");
             }

                 if($("#product_service_c").val() == ""){
                     // console.log("ps");
              validate = false;
              $("#product_service_c").css("background-color", "Red");
              alert_validation.push("Product/Service");
             } 
             
               if($("#sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
              $("#sector_c").css("background-color", "Red");
              alert_validation.push("Sector");
             } 
             
               if($("#sub_sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
              $("#sub_sector_c").css("background-color", "Red");
              alert_validation.push("Sub Sector");
             } 
             
               if($("#risk_c").val() == ""){
                     // console.log("ps");
              validate = false;
              $("#risk_c").css("background-color", "Red");
              alert_validation.push("Risk");
             } 
             
                  if($("#scope_budget_projected_c").val() == ""){
              validate = false;
              $("#scope_budget_projected_c").css("background-color", "Red");
              alert_validation.push("DPR/Scope & Budget Accepted (Projected)");
             }
             if($("#rfp_eoi_projected_c").val() == ""){
              validate = false;
              $("#rfp_eoi_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_projected_c").val() == ""){
              validate = false;
              $("#rfp_eoi_published_projected_c").css("background-color", "Red");
             }
             if($("#work_order_projected_c").val() == ""){
              validate = false;
              $("#work_order_projected_c").css("background-color", "Red");
             }
             
             
                 if($("#project_scope_c").val() == ""){
              validate = false;
              $("#project_scope_c").css("background-color", "Red");
              alert_validation.push("Project Scope");
             }
             
             
             
              if($("#learnings_c").val() == ""){
              validate = false;
              $("#learnings_c").css("background-color", "Red");
              alert_validation.push("Learnings");
             }
             
              if($("#closure_status_c").val() == ""){
              validate = false;
              $("#closure_status_c").css("background-color", "Red");
              alert_validation.push("Clousre Status");
             }
              if($("#selection_c").val() == ""){
              validate = false;
              $("#selection_c").css("background-color", "Red");
             }
              if($("#funding_c").val() == ""){
              validate = false;
              $("#funding_c").css("background-color", "Red");
             }
              if($("#timing_button_c").val() == ""){
              validate = false;
              $("#timing_button_c").css("background-color", "Red");
             }
             
             
             
             
             if(validate == false){
           if(alert_validation.length>0) {
            alert(`Please fill the required fields : \n${alert_validation.join('\n')} `);
           }
             
          }
            
                // if (validate && check_form(view)) {
                //   return true;
                // } else {
                //   return false;
                // }
              
            }
            
            
     //--------------------validation for not required case and different status-----END------------------
    
   //--------------------validation for yes case and different status-----------------------  
      if($("#status_c").val()=="QualifiedLead" && form_validation == "yes"){
       
        var file_name=$('#filename_file').val();
             
             if(file_name ==""){
              
              if($('#filename_old a').text()==""){
              $("#filename_file").css("background-color", "Red");
              validate=false;
              alert_validation.push("File Name");
               
              }
              
             }
       
       var cumalitive = $("#cum td input").val();
                    
                     if(cumalitive == ""||cumalitive==0){
                      
                      validate = false;
                      alert_validation.push("L2 Details");
                      
                      $('[field=financial_feasibility_l2_c]').append("<span class='message_lbl' style='color:red;'>"+"<br>Please fill Financial Feasibity L2</span>")
             }
             else{
                           $('.message_lbl').remove();
             }
             
             if($("#name").val() == ""){
              validate = false;
              alert_validation.push("Opportunity name");
              $("#name").css("background-color", "Red");
             }
             if($("#state_c").val() == ""){
              validate = false;
              alert_validation.push("State");
              $("#state_c").css("background-color", "Red");
             }
             
              if($('#startYear').val()==""){
              validate = false;
              alert_validation.push("L1 Details");
              $('[field=financial_feasibility_l1_c]').append("<span class='message_lbl' style='color:red;'>"+"<br>Please fill Financial Feasibity L1</span>")
             }
             
             if($("#account_name").val() == ""){
              validate = false;
              alert_validation.push("Department");
              $("#account_name").css("background-color", "Red");
             }
             if($("#source_c").val() == ""){
              validate = false;
              alert_validation.push("Source");
              $("#source_c").css("background-color", "Red");
             }
            
             
             // if($("#non_financial_consideration_c").val() == ""){
             //  validate = false;
             //  $("#non_financial_consideration_c").css("background-color", "Red");
             // }
                 if($("#budget_source_c").val() == ""){
              validate = false;
              alert_validation.push("Budget Source");
              $("#budget_source_c").css("background-color", "Red");
             }
              if($("#budget_head_c").val() == ""){
              validate = false;
              alert_validation.push("Budget Head");
              $("#budget_head_c").css("background-color", "Red");
             }
              if($("#budget_head_amount_c").val() == ""){
              validate = false;
              alert_validation.push("Budget Head Amount (in Cr)");
              $("#budget_head_amount_c").css("background-color", "Red");
             }
              if($("#project_implementation_start_c").val() == ""){
              validate = false;
              alert_validation.push("Project Implementation Start Date");
              $("#project_implementation_start_c").css("background-color", "Red");
             }
              if($("#project_implementation_end_c").val() == ""){
              validate = false;
              alert_validation.push("Project Implementation End Date");
              $("#project_implementation_end_c").css("background-color", "Red");
             }
              if($("#budget_allocated_oppertunity_c").val() == ""){
              validate = false;
              alert_validation.push("Budget Allocated for Oportunity (in Cr)");
              $("#budget_allocated_oppertunity_c").css("background-color", "Red");
             }
             
             if($("#segment_c").val() == ""){
              validate = false;
               alert_validation.push("Segment");
              $("#segment_c").css("background-color", "Red");
             }

                 if($("#product_service_c").val() == ""){
                      //console.log("ps");
              validate = false;
              alert_validation.push("Product/Service");
              $("#product_service_c").css("background-color", "Red");
             } 
             
               if($("#sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
              alert_validation.push("Sector");
              $("#sector_c").css("background-color", "Red");
             } 
             
               if($("#sub_sector_c").val() == ""){
                     // console.log("ps");
              validate = false;
              alert_validation.push("Sub Sector");
              $("#sub_sector_c").css("background-color", "Red");
             } 
             
               if($("#risk_c").val() == ""){
                     // console.log("ps");
              validate = false;
              alert_validation.push("Risk");
              $("#risk_c").css("background-color", "Red");
             } 
             
                  if($("#scope_budget_projected_c").val() == ""){
              validate = false;
              alert_validation.push("DPR/Scope & Budget Accepted (Projected)");
              $("#scope_budget_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_projected_c").val() == ""){
              validate = false;
              $("#rfp_eoi_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_projected_c").val() == ""){
              validate = false;
              $("#rfp_eoi_published_projected_c").css("background-color", "Red");
             }
             if($("#work_order_projected_c").val() == ""){
              validate = false;
              $("#work_order_projected_c").css("background-color", "Red");
             }
            
              if($("#rfp_eoi_summary_c").val() == ""){
              validate = false;
              alert_validation.push("RFP/EOI Summary");
              $("#rfp_eoi_summary_c").css("background-color", "Red");
             }
             
           
              if($("#bid_strategy_c").val() == ""){
              validate = false;
              alert_validation.push("Bid Strategy");
              $("#bid_strategy_c").css("background-color", "Red");
             }
            
             
             if($("#project_scope_c").val() == ""){
              validate = false;
              alert_validation.push("Project Scope");
              $("#project_scope_c").css("background-color", "Red");
             }
             
              if($("#selection_c").val() == ""){
              validate = false;
              $("#selection_c").css("background-color", "Red");
             }
              if($("#funding_c").val() == ""){
              validate = false;
              $("#funding_c").css("background-color", "Red");
             }
              if($("#timing_button_c").val() == ""){
              validate = false;
              $("#timing_button_c").css("background-color", "Red");
             }
             
             if(validate == false){
           if(alert_validation.length>0) {
            alert(`Please fill the required fields : \n${alert_validation.join('\n')} `);
           }
             
          }
            
                // if (validate && check_form(view)) {
                //   return true;
                // } else {
                //   return false;
                // }
              
            }
            
       if($("#status_c").val()=="QualifiedBid" && form_validation == "yes"){
          
           var file_name=$('#filename_file').val();
             
             if(file_name ==""){
              
              if($('#filename_old a').text()==""){
              $("#filename_file").css("background-color", "Red");
              validate=false;
               alert_validation.push("File Name");
              }
              
             }
             
              var cumalitive = $("#cum td input").val();
                    
                     if(cumalitive == ""||cumalitive==0){
                      
                      validate = false;
                      
                      $('[field=financial_feasibility_l2_c]').append("<span class='message_lbl' style='color:red;'>"+"<br>Please fill Financial Feasibity L2</span>")
            
            alert_validation.push("Cumulative");
              
              
             }
             else{
                           $('.message_lbl').remove();
             }
             
             if($("#name").val() == ""){
              validate = false;
              $("#name").css("background-color", "Red");
              alert_validation.push("Opportunity Name");
             }
             if($("#state_c").val() == ""){
              validate = false;
              $("#state_c").css("background-color", "Red");
              alert_validation.push("State");
             }
             if($("#account_name").val() == ""){
              validate = false;
              $("#account_name").css("background-color", "Red");
              alert_validation.push("Department");
             }
             if($("#source_c").val() == ""){
              validate = false;
              $("#source_c").css("background-color", "Red");
              alert_validation.push("Source");
             }
            
             
             // if($("#non_financial_consideration_c").val() == ""){
             //  validate = false;
             //  $("#non_financial_consideration_c").css("background-color", "Red");
             // }
                 if($("#budget_source_c").val() == ""){
              validate = false;
              $("#budget_source_c").css("background-color", "Red");
              alert_validation.push("Budget Source");
             }
              if($("#budget_head_c").val() == ""){
              validate = false;
              $("#budget_head_c").css("background-color", "Red");
              alert_validation.push("Budget Head");
             }
              if($("#budget_head_amount_c").val() == ""){
              validate = false;
              $("#budget_head_amount_c").css("background-color", "Red");
              alert_validation.push("Budget Head Amount");
             }
              if($("#project_implementation_start_c").val() == ""){
              validate = false;
              $("#project_implementation_start_c").css("background-color", "Red");
               alert_validation.push("Project Implementation Start Date");
             }
              if($("#project_implementation_end_c").val() == ""){
              validate = false;
              $("#project_implementation_end_c").css("background-color", "Red");
               alert_validation.push("Project Implementation End Date");
             }
              if($("#budget_allocated_oppertunity_c").val() == ""){
              validate = false;
              $("#budget_allocated_oppertunity_c").css("background-color", "Red");
               alert_validation.push("Budget Allocated for Opportunity (in Cr)");
             }
             
             if($("#segment_c").val() == ""){
              validate = false;
              $("#segment_c").css("background-color", "Red");
              alert_validation.push("Segment");
             }

                 if($("#product_service_c").val() == ""){
                     // console.log("ps");
              validate = false;
              $("#product_service_c").css("background-color", "Red");
              alert_validation.push("Product/Service");
             } 
             
               if($("#sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
              $("#sector_c").css("background-color", "Red");
              alert_validation.push("Sector");
             } 
             
               if($("#sub_sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
              $("#sub_sector_c").css("background-color", "Red");
              alert_validation.push("Sub Sector");
             } 
             
             //   if($("#risk_c").val() == ""){
             //         // console.log("ps");
             //  validate = false;
             //  $("#risk_c").css("background-color", "Red");
             // } 
             
                  if($("#scope_budget_projected_c").val() == ""){
              validate = false;
              $("#scope_budget_projected_c").css("background-color", "Red");
              alert_validation.push("DPR/Scope & Budget Accepted (Projected)");
             }
             if($("#rfp_eoi_projected_c").val() == ""){
              validate = false;
              $("#rfp_eoi_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_projected_c").val() == ""){
              validate = false;
              $("#rfp_eoi_published_projected_c").css("background-color", "Red");
             }
             if($("#work_order_projected_c").val() == ""){
              validate = false;
              $("#work_order_projected_c").css("background-color", "Red");
             }
            
             
              if($("#rfp_eoi_summary_c").val() == ""){
              validate = false;
              $("#rfp_eoi_summary_c").css("background-color", "Red");
               alert_validation.push("RFP/EOI Summary");
              
             }
             
             //  if($("#influencersl2_c").val() == ""){
             //  validate = false;
             //  $("#influencersl2_c").css("background-color", "Red");
             // }
              if($("#bid_strategy_c").val() == ""){
              validate = false;
              $("#bid_strategy_c").css("background-color", "Red");
              alert_validation.push("Bid Strategy");
             }
             //  if($("#submissionstatus_c").val() == ""){
             //  validate = false;
             //  $("#submissionstatus_c").css("background-color", "Red");
             // }
             
              if($("#learnings_c").val() == ""){
              validate = false;
              $("#learnings_c").css("background-color", "Red");
              alert_validation.push("Learnings");
             }
             
              if($("#closure_status_c").val() == ""){
              validate = false;
              $("#closure_status_c").css("background-color", "Red");
              alert_validation.push("Clousre Status");
             }
             
            
             if($("#project_scope_c").val() == ""){
              validate = false;
              $("#project_scope_c").css("background-color", "Red");
              alert_validation.push("Project Scope");
             }
             
              if($("#selection_c").val() == ""){
              validate = false;
              $("#selection_c").css("background-color", "Red");
             }
              if($("#funding_c").val() == ""){
              validate = false;
              $("#funding_c").css("background-color", "Red");
             }
              if($("#timing_button_c").val() == ""){
              validate = false;
              $("#timing_button_c").css("background-color", "Red");
             }
             
             if(validate == false){
           if(alert_validation.length>0) {
            alert(`Please fill the required fields : \n${alert_validation.join('\n')} `);
           }
             
          }
            
                // if (validate && check_form(view)) {
                //   return true;
                // } else {
                //   return false;
                // }
              
            }      
            
    //--------------------validation for yes case and different status-----END------------------
            
      if (validate && check_form(view)) {
       
        $('#send_approval').hide();
        // $('.loader').css("display","block");
          
          var status=$('#status_c').val();
          var rfp_eoi_published=$('#rfporeoipublished_c').val();
          var apply_for=$('#applyfor_c').val();
          var date_time=Date();
          var opp_name=$('#name').val();
          var multiple_approver_c=$('#select_approver_c').val();
          var myJSON=$('#multiple_approver_c').val();
          if(typeof(multiple_approver_c)==='string'){
           
           myJSON
          
          }else{
           
          myJSON = multiple_approver_c.join();
           
          }
         // alert(myJSON);
        $('#multiple_approver_c').val(myJSON);
        
                 $.ajax({
                         url : 'index.php?module=Opportunities&action=send_for_approval',
                         type : 'POST',
                         data: {
                             opp_id,
                             status,
                             apply_for,
                             date_time,
                             rfp_eoi_published,
                             base_url,
                            myJSON,
                            opp_name,
                            multiple_approver_c
                             
                         },
                         success : function(data){
                             
                             alert(data);
                             
                             
                             window.location.replace(window.location.href.split('?')[0]+"?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26action%3Dindex%26return_module%3DOpportunities%26return_action%3DDetailView");
                             
                         }
                          
                      });
                
        
      $('#SAVE_HEADER').trigger('click');
    
          
               return true;
             } else {
               return false;
             }
  
     
     
     
     
     
 });
 
  //-----------------------------Send for Approval-----------END----------------------------------
 //--------------------------Approve or Reject onclick-------------------------------------
 
 
  $('#approve').on('click',function(){
      
       $('#approve_comments').css("display","block");
  });
  
  $('#reject').on('click',function(){
      
       $('#reject_comments').css("display","block");
  });
  
  
  
  
  
  
  
   $('#submit_comment_approve').on('click',function(){
      
      var status=$('#status_c').val();
      var rfp_eoi_published=$('#rfporeoipublished_c').val();
     var apply_for=$('#applyfor_c').val();
     var date_time=Date();
     var approved=1;
     var rejected=0;
     var pending=0;
     var comments=$('#get_comments_approve').val();
     var next_status="";
     
     if(comments!=''){  
         
         $('#submit_comment_approve').hide();
         $('#close_approve').hide();
         
         $('.loader').css("display","block");
         
         if(status=='Lead'&& rfp_eoi_published=='no'){
             
             next_status='QualifiedLead';
         }
        else  if(status=='QualifiedLead'&& rfp_eoi_published=='no'){
            next_status='Qualified';
        }
        else  if(status=='Qualified'&& rfp_eoi_published=='no'){
            next_status='QualifiedDpr';
        }
        else if(status=='QualifiedDpr'&& rfp_eoi_published=='no'){
            next_status='QualifiedBid';
        }
        else  if(status=='QualifiedBid'&& rfp_eoi_published=='no'){
            next_status='Closed';
        }
        else if(status=='Lead'&& rfp_eoi_published=='yes'){
             
             next_status='QualifiedLead';
         }
        else  if(status=='QualifiedLead'&& rfp_eoi_published=='yes'){
            
            next_status='QualifiedBid';
        }
        else  if(status=='QualifiedBid'&& rfp_eoi_published=='yes'){
            next_status='Closed';
        } 
        else if(status=='Lead'&& rfp_eoi_published=='not_required'){
             
             next_status='QualifiedLead';
         }
        else  if(status=='QualifiedLead'&& rfp_eoi_published=='not_required'){
            next_status='Qualified';
        }
        else  if(status=='Qualified'&& rfp_eoi_published=='not_required'){
            next_status='QualifiedDpr';
        }
        else if(status=='QualifiedDpr'&& rfp_eoi_published=='not_required'){
            next_status='Closed';
        }
         else if(status=='Drop' && rfp_eoi_published=='not_required'){
            next_status='Dropped';
        }
        else if(status=='Drop'&& rfp_eoi_published=='no'){
            next_status='Dropped';
        }
         else if(status=='Drop'&& rfp_eoi_published=='yes'){
            next_status='Dropped';
        }
        
     $.ajax({
        url : 'index.php?module=Opportunities&action=approve',
        type : 'POST',
        data: {
            opp_id,
            status,
            apply_for,
            date_time,
            rfp_eoi_published,
            approved,
            rejected,
            comments,
            pending,
            base_url,
            next_status
            
        },
        success : function(data1){
         
         $('#approve_comments').hide();
            $('#approve').hide();
            $('#reject').hide();
        var data=JSON.parse(data1);
          
           
            
         if(data.status==true) {
         // alert("in");
             $('#status_c').val(data.next_status);
              
             //  alert(data.next_status);
           
            
          if(rfp_eoi_published=='no')  {
           
          
           
            if(data.next_status=='QualifiedLead'){
             
             $('#applyfor_c').val('qualifyOpportunity');
            //  $('#SAVE_HEADER').trigger('click');
         }
        if(data.next_status=='Qualified' ){
        
       
         
            $('#applyfor_c').val('qualifyDpr');
          // $('#SAVE_HEADER').trigger('click');
        }
        
         if(data.next_status=='QualifiedDpr'){
         
             $('#applyfor_c').val('qualifyBid');
           //  $('#SAVE_HEADER').trigger('click');
        }
         if(data.next_status=='QualifiedBid'){
            $('#applyfor_c').val('closure');
           // $('#SAVE_HEADER').trigger('click');
        }
         if( data.next_status=='Dropped'){
         //alert("dropped");
            $('#applyfor_c').val('');
          //  $('#SAVE_HEADER').trigger('click');
        }
        
          }
       
     else  if(rfp_eoi_published=='yes')  { 
         if(data.next_status=='QualifiedLead'){
             
             $('#applyfor_c').val('qualifyBid');
          //  $('#SAVE_HEADER').trigger('click');
         }
         else if(data.next_status=='QualifiedBid'){
            
            $('#applyfor_c').val('closure');
           // $('#SAVE_HEADER').trigger('click');
        }
        
        else  if(data.next_status=='Dropped' ){
            $('#applyfor_c').val('');
          //  $('#SAVE_HEADER').trigger('click');
        }
        
       }
       
      else if(rfp_eoi_published=='not_required'){
        
       if(data.next_status=='QualifiedLead' ){
             
              $('#applyfor_c').val('qualifyOpportunity');
             //  $('#SAVE_HEADER').trigger('click');
         }
        else  if(data.next_status=='Qualified'){
             $('#applyfor_c').val('qualifyDpr');
             // $('#SAVE_HEADER').trigger('click');
        }
        else  if( data.next_status=='QualifiedDpr'){
             $('#applyfor_c').val('closure');
            //  $('#SAVE_HEADER').trigger('click');
        }
       
       else  if( data.next_status=='Dropped'){
          //alert("y");
            $('#applyfor_c').val('');
           // $('#SAVE_HEADER').trigger('click');
         }
       }
       
        
       $('#SAVE_HEADER').trigger('click');
         }
         
            $('#SAVE_HEADER').trigger('click');
         
        }
         
     });
   
    
  }else{
      
      alert("Please write comments");
  }
          
          
  });
  
   $('#submit_comment_reject').on('click',function(){
      //alert("reject");
      var status=$('#status_c').val();
      var rfp_eoi_published=$('#rfporeoipublished_c').val();
     var apply_for=$('#applyfor_c').val();
     var date_time=Date();
     var approved_reject=0;
     var rejected_reject=1;
     var pending_reject=0;
     var comment_reject=$('#get_comments_reject').val();
     
     
     
  if (comment_reject !=''){ 
      
       $('#submit_comment_reject').hide();
       $('#close_reject').hide();
         $('.loader').css("display","block");
      
     $.ajax({
        url : 'index.php?module=Opportunities&action=reject',
        type : 'POST',
        data: {
            opp_id,
            status,
            apply_for,
            date_time,
            rfp_eoi_published,
            approved_reject,
            rejected_reject,
            comment_reject,
            base_url,
            pending_reject
            
        },
        success : function(data){
             $('#reject_comments').hide();
           
             $('#approve').hide();
            $('#reject').hide();
             $('#SAVE_HEADER').trigger('click');
          
        }
         
     });
    // window.location.reload();
   
  }else{
      
      alert("Please write comments");
  }
          
  });
  
  
 $("#close_approve").on("click",function() {
     $("#approve_comments").hide();
 });
  
  
  
  $("#close_reject").on('click',function(){
   
    $('#reject_comments').hide();
  });    
       //--------------------------Approve or Reject onclick----------END---------------------------
       
  //---------------------------multiple file upload -------------------------------------------------     
 
 
	var record_id = $('input[name="record"]').val();
	$('#EditView').attr('enctype','multipart/form-data');
	var x = 1; //initlal text box count
	$(".add_field_button").click(function(e){ //on add input button click
		e.preventDefault();
			x++; //text box increment
			var val = x-1;
			$(".input_fields_wrap").append('<div><input type="file" name="attachments['+val+']" id="attachments['+val+']" onclick="file_size(this.id)"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
	});
		
    $(".input_fields_wrap").on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    });
	
	$(".downloadAttachment").click(function(e) {
        var fileName = $(this).attr("name");
        var name = $(this).text();
        
        var data = [
            {
                "id": fileName,
                "type": name.substr((name.lastIndexOf('.') + 1)),
                "module": "Opportunity",
                "folder": "Opportunity",
                
            }
        ];
        downloadAttachment(data);
        
        
    });
	
	$(".remove_attachment").click(function(e) {
        var fileName = $(this).attr("name");
        var name = $(this).prev().text();
        var extension = name.substr((name.lastIndexOf('.') + 1));
        var flag = confirm("Are you want to delete " + name + " attachment");
        if (flag) {
            removeAttachment(fileName, extension)
        }
    });	


function downloadAttachment(data) {
    var $form = $('<form></form>')
        .attr('action', 'index.php?entryPoint=multiple_file&action_type=download')
        .attr('method', 'post')
        .attr('target', '_blank')
        .appendTo('body');
    for (var i in data) {
        if (!data.hasOwnProperty(i)) continue;
        $('<input type="hidden"/>')
            .attr('name', i)
            .val(JSON.stringify(data[i]))
            .appendTo($form);
    }
    $form.submit();
}

function removeAttachment(fileName, extension) {
    $.ajax({
        url: 'index.php?entryPoint=multiple_file',
        type: 'POST',
        async: false,
        data: {
            id: fileName,
            extension: extension,
            module: 'Opportunity',
         			folder: 'Opportunities',
         			action_type: "remove"
        },
        success: function(result) {
            var data = $.parseJSON(result);
            $('[name=' + data.attachment_id + ']').prev().hide();
            $('[name=' + data.attachment_id + ']').hide();
        }
    });
}
 
 //------------------------------multiple file upload ---------END------------------------------------   
   //-----------------------Write Code above this--------------------------
});