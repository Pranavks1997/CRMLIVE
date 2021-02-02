$(document).ready(function() {
 
$('#whole_subpanel_history').remove();

     setTimeout(function() {
      $('#check a').hide();
      console.log('sad');
 }, 10);
 
 
 //------------------------fetch l1 and l2--------------------------------
  var decodeHTML = function (html) {
  	var txt = document.createElement('textarea');
  	txt.innerHTML = html;
  	return txt.value;
  };
 
 var id=$('#formDetailView input[name=record]').val();
 // alert(id);

  $.ajax({
        url : 'index.php?module=Opportunities&action=fetch_l1',
        type : 'POST',
        dataType: "json",
          data :
            {
                id,
                
            },
            success: function (return_data) {
                
                if(return_data.status == true ){
                    //console.log('in');
                     if (return_data.total_input_value!='') {
                       


                       $('#total_input_value').val(return_data.total_input_value);
                       
                   
                   }
                   
        //   if(return_data.l1_html != ''&& return_data.l1_input!=""){
              
             
        //       var l1HTML_decoded = decodeHTML(return_data.l1_html);
        //       //var l1INPUT_decoded = decodeHTML(return_data.l1_input);
        //       $('#total_value').html(l1HTML_decoded);
        //       $('#total_value input').each(function(index) {
        //           $(this).val(decodeHTML(return_data.l1_input[index]));
        //         });
              
        //          }
                }
                
            }
  });
 
   $.ajax({
        url : 'index.php?module=Opportunities&action=fetch_year_quarters',
        type : 'POST',
        dataType: "json",
          data :
            {
                id,
                
            },
            success: function (return_data) {
                var start_year=return_data.start_year;
                var start_quarter=return_data.start_quarter;
                var end_year=return_data.end_year;
                var end_quarter=return_data.end_quarter;
                var num_of_bidders=return_data.num_of_bidders;
                var total=return_data.total;
                
                
                 if(start_year!=''&& start_quarter !=''&& end_quarter!=''&& end_year !=''){
                  
                     
                            $('#startYear').val(start_year);
                             var start_year=$('#startYear').val();
     
                             var fields1= start_year.split(/-/);
                             
                            var start1 = parseInt(fields1[0]);
                            
//start1=start1+1;
                             
                             var text = '';
                              for (var i = 0; i < 50; i++) {
                                   
                                  
                                  text += '<option value="'+start1 + '-' + (start1+1)+'">'+start1 + '-' + (start1+1)+'</option>';
                                 
                            //       $('#endYear').replaceWith('<option value="start1 + "-" + (start1+1)"></option>'
                            // $('<option></option>').val(start1 + "-" + (start1+1)).html(start1 + "-" + (start1+1))
                            //  );  
                                 start1=start1+1;  
                              }
                              $('#endYear').replaceWith('<select name="endYear" id="endYear"></select>');
                              $('#endYear').html(text);
                            
                            $('#endYear').val(end_year);
                            $('#start_quarter').val(start_quarter);
                            $('#end_quarter').val(end_quarter);
                            $('#bid').val( num_of_bidders);
                         //   $('#first_form').attr('disabled',true);
                         
                         $("#endYear").attr("disabled",true);
                          var starty = $('#startYear').val();
                          
                         var endy = $('#endYear').val();
                         var startq =$('#start_quarter').val();
                          var endq = $('#end_quarter').val();
                          // var total = $('#total_input_value').val();
                   
                    
                  // alert(starty+" "+startq+" "+endy+" "+endq+""+total);
                   if( starty!='' &&  endy!='' && startq!='' && endq!='' && total!='' ){
                   
                   
                   $('#financial_feasibility_l1_c').text("View L1 Details");
                    $('#financial_feasibility_l1_c').css("background","#2ecc71")
                    
                   
                   }
                 }
                 
                
            }
         
         
     });
 
  $.ajax({
        url : 'index.php?module=Opportunities&action=fetch_l2',
        type : 'POST',
        dataType: "json",
          data :
            {
                id,
                
            },
            success: function (return_data) {
                
                if(return_data.status == true ){
                  //  console.log('in');
                    
          if(return_data.l2_html != ''&& return_data.l2_input!=""){
              
          // alert("innnn l2");
            $('#first_form').hide();
            
              var l2HTML_decoded = decodeHTML(return_data.l2_html);
              //var l1INPUT_decoded = decodeHTML(return_data.l1_input);
              $('#mtenth').html(l2HTML_decoded);
              $('#mtenth input').each(function(index) {
   
                  $(this).val(decodeHTML(return_data.l2_input[index]));
                });
                
                $("#mtenth td .row_add").attr("disabled",true);
                
                 var cumalitive = $("#cum td input").val();
    
      if(cumalitive != "" && cumalitive != 0){
                       //  alert("if");
                       
                       
                         $('#financial_feasibility_l2_c').text("View L2 Details");
                         $('#financial_feasibility_l2_c').css("background","#2ecc71")
                         $('#financial_feasibility_l3_c').text("View L3 Details");
                         $('#financial_feasibility_l3_c').css("background","#2ecc71")
                     }
                     else{
                      //alert("else");
                         $('#financial_feasibility_l2_c').text("Add L2 Details");
                         $('#financial_feasibility_l2_c').css("background","#f08377")
                         $('#financial_feasibility_l3_c').text("View L3 Details");
                         $('#financial_feasibility_l3_c').css("background","#f08377")
                     }
             }
             
            
             
             
                 
                }
                
            
              
            }
  });
  
  

 //------------------------fetch l1 and l2------END-----------------
 //----- file view icon -----------------------------//
 $("#filename a:eq(1)").hide();
 
 // if($("#rfporeoipublished_c").val() == "no"){
 //  if($("#status_c").val() == "QualifiedDpr"){
   
 //  }
 // }   



 $('#delete_button').remove();
 //-------------onload of color selection,funding,timing -------------//
 
    if ($("#selection_c").val() == "Green") {
     $('[field=selection_c]').css('background-color','#2ecc71');
               }
    if ($("#selection_c").val() == "Red") {
     $('[field=selection_c]').css('background-color','#de3b33');
               }
    if ($("#selection_c").val() == "Yellow") {
     $('[field=selection_c]').css('background-color','#feca57');
               }    
               
     if ($("#funding_c").val() == "Green") {
     $('[field=funding_c]').css('background-color','#2ecc71');
               }
    if ($("#funding_c").val() == "Red") {
     $('[field=funding_c]').css('background-color','#de3b33');
               }
    if ($("#funding_c").val() == "Yellow") {
     $('[field=funding_c]').css('background-color','#feca57');
               }     
               
               
     if ($("#timing_button_c").val() == "Green") {
     $('[field=timing_button_c]').css('background-color','#2ecc71');
               }
    if ($("#timing_button_c").val() == "Red") {
     $('[field=timing_button_c]').css('background-color','#de3b33');
               }
    if ($("#timing_button_c").val() == "Yellow") {
     $('[field=timing_button_c]').css('background-color','#feca57');
               } 
               
   //-------------onload of color selection,funding,timing ----END---------//
               
               
    $("#btn_view_change_log").hide() ;
    
    $("#whole_subpanel_opportunities_users_1").css("display","none");
    $("#whole_subpanel_opportunities_users_2").css("display","none");
   
  // $("#top-panel-6").removeAttr("aria-expanded");
   
  //*****************************************************MAIN***************************************************************************************** 
  
  $( ".label:contains('Apply For:')").hide();
       
       $("div[field=applyfor_c]").hide();
       
       $( ".label:contains('Multiple Approver:')").hide();
       
       $("div[field=multiple_approver_c]").hide();
  
   $( ".label:contains('Add new segment:')").hide();
       $( ".label:contains('Add new product/service:')").hide();
       
       $("div[field=add_new_segment_c]").hide();
       $("div[field=add_new_product_service_c]").hide();
       
        var opp_id=$('#formDetailView input[name=record]').val();
        
        //adding buttons to financial feasiblity
        $("div[field=financial_feasibility_l1_c]").replaceWith('<button type="button" class="button new" id="financial_feasibility_l1_c">View L1 Details</button>');
        $("div[field=financial_feasibility_l2_c]").replaceWith('<button type="button" class="button" id="financial_feasibility_l2_c">Add L2 Details</button>');
        $("div[field=financial_feasibility_l3_c]").replaceWith('<button type="button" class="button" id="financial_feasibility_l3_c">Add L3 Details</button>');
   
  // //------------------------------------------------International-----------------------------------------------------------
      $.ajax({
        url : 'index.php?module=Opportunities&action=international',
        type : 'POST',
        data: {
            opp_id,
          
        },
        success : function(data){
         
         
         if(data=="no"){
           $( ".label:contains('Country Name:')").hide();
      // $( ".label:contains('Department(s):')").hide();
       $("div[field=country_c]").hide();
      // $("div[field=new_department_c]").hide();
        //  $( ".label:contains('Department:')").hide();
         // $("div[field=account_name]").hide();
         }
          if(data=="yes"){
            $( ".label:contains('State/UTs:')").hide();
     //  $( ".label:contains('Department:')").hide();
       $("div[field=state_c]").hide();
      // $("div[field=account_name]").hide();
         
         }
        }
       
      });
       
       
  //  //--------------------------------------International-----END-------------------------------------------------------------------    
       
       
  
  // //*****************************************************Dummy*****************************************************************************************
  //   //---------------------------hiding the tab based on the rfp==no and status---------------------------
    
   if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "Lead" ){
     
     
      
       $("#top-panel-1").hide() ;
       $("#top-panel-3").hide() ;
       $("#top-panel-4").hide() ;
       $("#top-panel-5").hide() ;
       $("#top-panel-6").hide() ;
       
       //hiding fields
       
       $( ".label:contains('Risk:')").hide();
       $( ".label:contains('Project Scope:')").hide();
       $( ".label:contains('Selection:')").hide();
       $( ".label:contains('Funding:')").hide();
       $( ".label:contains('Timing:')").hide();
       // $( ".label:contains('Apply For:')").hide();
       
       // $("div[field=applyfor_c]").hide();
       $("div[field=risk_c]").hide();
       $("div[field=project_scope_c]").hide();
       $("div[field=selection_c]").hide();
       $("div[field=funding_c]").hide();
       $("div[field=timing_button_c]").hide();
       
      
       
   }
   
   if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "QualifiedLead" ){
       
       $("#top-panel-1").show() ;
       $("#top-panel-3").show() ;
       
       $("#top-panel-4").hide() ;
       $("#top-panel-5").hide() ;
       $("#top-panel-6").hide() ;
       
       
       $( ".label:contains('Project Scope:')").hide();
       $( ".label:contains('Selection:')").hide();
       $( ".label:contains('Funding:')").hide();
       $( ".label:contains('Timing:')").hide();
       $( ".label:contains('Financial Feasibility (L2):')").hide();
       $( ".label:contains('Budget Source:')").hide();
       $( ".label:contains('Budget Head:')").hide();
       $( ".label:contains('Budget Head Amount (in Cr):')").hide();
       $( ".label:contains('Budget Allocated for Opportunity (in Cr):')").hide();
       $( ".label:contains('Project Implementation Start Date:')").hide();
       $( ".label:contains('Project Implementation End Date:')").hide();
       $( ".label:contains('Financial Feasibility (L3):')").hide();
       
         $("div[field=project_scope_c]").hide();
       $("div[field=selection_c]").hide();
       $("div[field=funding_c]").hide();
       $("div[field=timing_button_c]").hide();
        $("#financial_feasibility_l2_c").hide();
       $("div[field=budget_source_c]").hide();
       $("div[field=budget_head_c]").hide();
       $("div[field=budget_head_amount_c]").hide();
        $("#financial_feasibility_l3_c").hide();
       $("div[field=budget_allocated_oppertunity_c]").hide();
       $("div[field=project_implementation_start_c]").hide();
       $("div[field=project_implementation_end_c]").hide();
       
       // $( ".label:contains('Apply For:')").hide();
       
       // $("div[field=applyfor_c]").hide();
   }
   
   if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "Qualified" ){
       
      $("#top-panel-1").show() ;
       $("#top-panel-3").show() ;
       $("#top-panel-4").show() ;
       $("#top-panel-5").hide() ;
        $("#top-panel-6").hide() ;
        
          $( ".label:contains('Bid Strategy:')").hide();
       $( ".label:contains('Submission Status:')").hide();
       $( ".label:contains('Bid Checklist:')").hide();
       $( ".label:contains('Bid Files:')").hide();
      
          $("div[field=bid_strategy_c]").hide();
       $("div[field=submissionstatus_c]").hide();
       $("div[field=bid_checklist_c]").hide();
      // $("div[field=timing_button_c]").hide();
      
      // $( ".label:contains('Apply For:')").hide();
       
      //  $("div[field=applyfor_c]").hide();
       
       $("div[field='']").hide();
   }
   
   if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "QualifiedDpr" ){
    
       $("#top-panel-1").show() ;
       $("#top-panel-3").show() ;
       $("#top-panel-4").show() ;
       $("#top-panel-5").hide() ;
        $("#top-panel-6").hide() ;
        
        if($('#filename a:eq(0)').text() !=""){
          $("#filename a:eq(1)").show();
        }else{
           $("#filename a:eq(1)").hide();
           $('#filename a:eq(0)').removeAttr("href");
         $('#filename a:eq(0)').append("File is not uploaded")
        }
         
       // $( ".label:contains('Apply For:')").hide();
       
       // $("div[field=applyfor_c]").hide();
       
       $("div[field='']").show();
   }
   
   if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "QualifiedBid" ){
      $("#top-panel-1").show() ;
       $("#top-panel-3").show() ;
       $("#top-panel-4").show() ;
       $("#top-panel-5").show() ;
       $("#top-panel-6").hide() ; 
       
      
        if($('#filename a:eq(0)').text() !=""){
          $("#filename a:eq(1)").show();
        }else{
           $("#filename a:eq(1)").hide();
           $('#filename a:eq(0)').removeAttr("href");
         $('#filename a:eq(0)').append("File is not uploaded")
        }
        
       //  $( ".label:contains('Apply For:')").hide();
       
       // $("div[field=applyfor_c]").hide();
       
       $("div[field='']").show();
       
        
   }
   
   if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "Closed" ){
      $("#top-panel-1").show() ;
       $("#top-panel-3").show() ;
       $("#top-panel-4").show() ;
       $("#top-panel-5").show() ;
       $("#top-panel-6").hide() ; 
       
       
      
        if($('#filename a:eq(0)').text() !=""){
          $("#filename a:eq(1)").show();
        }else{
           $("#filename a:eq(1)").hide();
           $('#filename a:eq(0)').removeAttr("href");
         $('#filename a:eq(0)').append("File is not uploaded")
        }
        
       //  $( ".label:contains('Apply For:')").hide();
       
       // $("div[field=applyfor_c]").hide();
       
      
   }
   
  //  //---------------------------hiding the tab based on the rfp == no and status----end-----------------------
   
   
   
  //  //---------------------------hiding the tab based on the rfp == yes and status----start-----------------------
   if($("#rfporeoipublished_c").val() == "yes"){
     $( ".label:contains('Bid Checklist:')").hide();
       
       $("div[field=bid_checklist_c]").hide();
   }
   
    if($("#rfporeoipublished_c").val() == "yes" && $("#status_c").val() == "Lead" ){
     
        
     
      
       $("#top-panel-1").hide() ;
       $("#top-panel-3").hide() ;
       $("#top-panel-4").hide() ;
       $("#top-panel-5").hide() ;
       $("#top-panel-6").hide() ;
       
       //hiding fields
       
       $( ".label:contains('Risk:')").hide();
       $( ".label:contains('Project Scope:')").hide();
       $( ".label:contains('Selection:')").hide();
       $( ".label:contains('Funding:')").hide();
       $( ".label:contains('Timing:')").hide();
       
       $("div[field=risk_c]").hide();
       $("div[field=project_scope_c]").hide();
       $("div[field=selection_c]").hide();
       $("div[field=funding_c]").hide();
       $("div[field=timing_button_c]").hide();
       
       
        if($('#filename a:eq(0)').text() !=""){
          $("#filename a:eq(1)").show();
        }else{
           $("#filename a:eq(1)").hide();
           $('#filename a:eq(0)').removeAttr("href");
         $('#filename a:eq(0)').append("File is not uploaded")
        }
   }
   
    if($("#rfporeoipublished_c").val() == "yes" && $("#status_c").val() == "QualifiedLead" ){
       
       $("#top-panel-1").show() ;
       $("#top-panel-3").show() ;
       $("#top-panel-4").show() ;
       $("#top-panel-5").hide() ;
       
      $("#top-panel-6").hide() ;
       $( ".label:contains('Bid Checklist:')").hide();
      
          $("div[field=bid_checklist_c]").hide();
      
        if($('#filename a:eq(0)').text() !=""){
          $("#filename a:eq(1)").show();
        }else{
           $("#filename a:eq(1)").hide();
           $('#filename a:eq(0)').removeAttr("href");
         $('#filename a:eq(0)').append("File is not uploaded")
        }
   }
   
   if($("#rfporeoipublished_c").val() == "yes" && $("#status_c").val() == "QualifiedBid" ){
      $("#top-panel-1").show() ;
       $("#top-panel-3").show() ;
       $("#top-panel-4").show() ;
       $("#top-panel-5").show() ;
       $("#top-panel-6").hide() ;
      
     
        if($('#filename a:eq(0)').text() !=""){
          $("#filename a:eq(1)").show();
        }else{
           $("#filename a:eq(1)").hide();
           $('#filename a:eq(0)').removeAttr("href");
         $('#filename a:eq(0)').append("File is not uploaded")
        }
       
   }
   
   if($("#rfporeoipublished_c").val() == "yes" && $("#status_c").val() == "Closed" ){
      $("#top-panel-1").show() ;
       $("#top-panel-3").show() ;
       $("#top-panel-4").show() ;
       $("#top-panel-5").show() ;
       $("#top-panel-6").hide() ;
      
      
        if($('#filename a:eq(0)').text() !=""){
          $("#filename a:eq(1)").show();
        }else{
           $("#filename a:eq(1)").hide();
           $('#filename a:eq(0)').removeAttr("href");
         $('#filename a:eq(0)').append("File is not uploaded")
        }
       
   }
  //   //---------------------------hiding the tab based on the rfp == yes and status----end-----------------------
   
  //  //-------------hiding tabs for not_required-----------------------------------
    if($("#rfporeoipublished_c").val() == "not_required" && $("#status_c").val() == "Lead" ){
     
       
     
      
       $("#top-panel-1").hide() ;
       $("#top-panel-3").hide() ;
       $("#top-panel-4").hide() ;
       $("#top-panel-5").hide() ;
       $("#top-panel-6").hide() ;
       
       //hiding fields
       
       $( ".label:contains('Risk:')").hide();
       $( ".label:contains('Project Scope:')").hide();
       $( ".label:contains('Selection:')").hide();
       $( ".label:contains('Funding:')").hide();
       $( ".label:contains('Timing:')").hide();
       
       $("div[field=risk_c]").hide();
       $("div[field=project_scope_c]").hide();
       $("div[field=selection_c]").hide();
       $("div[field=funding_c]").hide();
       $("div[field=timing_button_c]").hide();
       
   }
   
   if($("#rfporeoipublished_c").val() == "not_required" && $("#status_c").val() == "QualifiedLead" ){
       $("#top-panel-1").show() ;
       $("#top-panel-3").show() ;
       
       $("#top-panel-4").hide() ;
       $("#top-panel-5").hide() ;
       $("#top-panel-6").hide() ;
       
       
       $( ".label:contains('Project Scope:')").hide();
       $( ".label:contains('Selection:')").hide();
       $( ".label:contains('Funding:')").hide();
       $( ".label:contains('Timing:')").hide();
       $( ".label:contains('Financial Feasibility (L2):')").hide();
       $( ".label:contains('Budget Source:')").hide();
       $( ".label:contains('Budget Head:')").hide();
       $( ".label:contains('Budget Head Amount (in Cr):')").hide();
       $( ".label:contains('Budget Allocated for Opportunity (in Cr):')").hide();
       $( ".label:contains('Project Implementation Start Date:')").hide();
       $( ".label:contains('Project Implementation End Date:')").hide();
       $( ".label:contains('Financial Feasibility (L3):')").hide();
       
         $("div[field=project_scope_c]").hide();
       $("div[field=selection_c]").hide();
       $("div[field=funding_c]").hide();
       $("div[field=timing_button_c]").hide();
        $("#financial_feasibility_l2_c").hide();
       $("div[field=budget_source_c]").hide();
       $("div[field=budget_head_c]").hide();
       $("div[field=budget_head_amount_c]").hide();
        $("#financial_feasibility_l3_c").hide();
       $("div[field=budget_allocated_oppertunity_c]").hide();
       $("div[field=project_implementation_start_c]").hide();
       $("div[field=project_implementation_end_c]").hide();
       
   }
   
   if($("#rfporeoipublished_c").val() == "not_required" && $("#status_c").val() == "Qualified" ){
       
      $("#top-panel-1").show() ;
       $("#top-panel-3").show() ;
       $("#top-panel-4").show() ;
       $("#top-panel-5").hide() ;
        $("#top-panel-6").hide() ;
        
          $( ".label:contains('Bid Strategy:')").hide();
       $( ".label:contains('Submission Status:')").hide();
       $( ".label:contains('Bid Checklist:')").hide();
       $( ".label:contains('Bid Files:')").hide();
      
          $("div[field=bid_strategy_c]").hide();
       $("div[field=submissionstatus_c]").hide();
       $("div[field=bid_checklist_c]").hide();
   }
   
   if($("#rfporeoipublished_c").val() == "not_required" && $("#status_c").val() == "QualifiedDpr" ){
       $("#top-panel-1").show() ;
       $("#top-panel-3").show() ;
       $("#top-panel-4").hide() ;
       $("#top-panel-5").show() ;
       
      $("#top-panel-6").hide() ;
   }
   
   if($("#rfporeoipublished_c").val() == "not_required" && $("#status_c").val() == "Closed" ){
       $("#top-panel-1").show() ;
       $("#top-panel-3").show() ;
       $("#top-panel-4").hide() ;
       $("#top-panel-5").show() ;
       
      $("#top-panel-6").hide() ;
   }
   
  //  //-------------hiding tabs for not_required---------END--------------------------
   
  
   
  
  
  
  
  // //************************************************DUMMY END*******************************************************************************************
  
  
    //---------------------------hiding the tab based on the rfp==no and status---------------------------
    
   // if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "Lead" ){
     
     
      
   //     $("#top-panel-1").hide() ;
   //     $("#top-panel-3").hide() ;
   //     $("#top-panel-4").hide() ;
   //     $("#top-panel-5").hide() ;
   //     $("#top-panel-6").hide() ;
   // }
   
   // if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "QualifiedLead" ){
       
   //     $("#top-panel-1").show() ;
   //     $("#top-panel-3").show() ;
       
   //     $("#top-panel-4").hide() ;
   //     $("#top-panel-5").hide() ;
   //     $("#top-panel-6").hide() ;
   // }
   
   // if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "Qualified" ){
       
   //    $("#top-panel-1").show() ;
   //     $("#top-panel-3").show() ;
   //     $("#top-panel-4").show() ;
   //     $("#top-panel-5").hide() ;
   //      $("#top-panel-6").hide() ;
      
   // }
   
   // if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "QualifiedDpr" ){
    
   //     $("#top-panel-1").show() ;
   //     $("#top-panel-3").show() ;
   //     $("#top-panel-4").show() ;
   //     $("#top-panel-5").hide() ;
   //      $("#top-panel-6").hide() ;
        
   //      if($('#filename a:eq(0)').text() !=""){
   //        $("#filename a:eq(1)").show();
   //      }else{
   //         $("#filename a:eq(1)").hide();
   //         $('#filename a:eq(0)').removeAttr("href");
   //       $('#filename a:eq(0)').append("File is not uploaded")
   //      }
         
       
   // }
   
   // if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "QualifiedBid" ){
   //    $("#top-panel-1").show() ;
   //     $("#top-panel-3").show() ;
   //     $("#top-panel-4").show() ;
   //     $("#top-panel-5").show() ;
   //     $("#top-panel-6").hide() ; 
       
      
   //      if($('#filename a:eq(0)').text() !=""){
   //        $("#filename a:eq(1)").show();
   //      }else{
   //         $("#filename a:eq(1)").hide();
   //         $('#filename a:eq(0)').removeAttr("href");
   //       $('#filename a:eq(0)').append("File is not uploaded")
   //      }
   // }
   
   // if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "Closed" ){
   //    $("#top-panel-1").show() ;
   //     $("#top-panel-3").show() ;
   //     $("#top-panel-4").show() ;
   //     $("#top-panel-5").show() ;
   //     $("#top-panel-6").hide() ; 
       
       
      
   //      if($('#filename a:eq(0)').text() !=""){
   //        $("#filename a:eq(1)").show();
   //      }else{
   //         $("#filename a:eq(1)").hide();
   //         $('#filename a:eq(0)').removeAttr("href");
   //       $('#filename a:eq(0)').append("File is not uploaded")
   //      }
   // }
   
   // //---------------------------hiding the tab based on the rfp == no and status----end-----------------------
   
   
   
   // //---------------------------hiding the tab based on the rfp == yes and status----start-----------------------
   
   //  if($("#rfporeoipublished_c").val() == "yes" && $("#status_c").val() == "Lead" ){
     
     
      
   //     $("#top-panel-1").hide() ;
   //     $("#top-panel-3").hide() ;
   //     $("#top-panel-4").hide() ;
   //     $("#top-panel-5").hide() ;
   //     $("#top-panel-6").hide() ;
       
       
   //      if($('#filename a:eq(0)').text() !=""){
   //        $("#filename a:eq(1)").show();
   //      }else{
   //         $("#filename a:eq(1)").hide();
   //         $('#filename a:eq(0)').removeAttr("href");
   //       $('#filename a:eq(0)').append("File is not uploaded")
   //      }
   // }
   
   //  if($("#rfporeoipublished_c").val() == "yes" && $("#status_c").val() == "QualifiedLead" ){
       
   //     $("#top-panel-1").show() ;
   //     $("#top-panel-3").show() ;
   //     $("#top-panel-4").show() ;
   //     $("#top-panel-5").hide() ;
       
   //    $("#top-panel-6").hide() ;
      
      
   //      if($('#filename a:eq(0)').text() !=""){
   //        $("#filename a:eq(1)").show();
   //      }else{
   //         $("#filename a:eq(1)").hide();
   //         $('#filename a:eq(0)').removeAttr("href");
   //       $('#filename a:eq(0)').append("File is not uploaded")
   //      }
   // }
   
   // if($("#rfporeoipublished_c").val() == "yes" && $("#status_c").val() == "QualifiedBid" ){
   //    $("#top-panel-1").show() ;
   //     $("#top-panel-3").show() ;
   //     $("#top-panel-4").show() ;
   //     $("#top-panel-5").show() ;
   //     $("#top-panel-6").hide() ;
      
     
   //      if($('#filename a:eq(0)').text() !=""){
   //        $("#filename a:eq(1)").show();
   //      }else{
   //         $("#filename a:eq(1)").hide();
   //         $('#filename a:eq(0)').removeAttr("href");
   //       $('#filename a:eq(0)').append("File is not uploaded")
   //      }
       
   // }
   
   // if($("#rfporeoipublished_c").val() == "yes" && $("#status_c").val() == "Closed" ){
   //    $("#top-panel-1").show() ;
   //     $("#top-panel-3").show() ;
   //     $("#top-panel-4").show() ;
   //     $("#top-panel-5").show() ;
   //     $("#top-panel-6").hide() ;
      
      
   //      if($('#filename a:eq(0)').text() !=""){
   //        $("#filename a:eq(1)").show();
   //      }else{
   //         $("#filename a:eq(1)").hide();
   //         $('#filename a:eq(0)').removeAttr("href");
   //       $('#filename a:eq(0)').append("File is not uploaded")
   //      }
       
   // }
   //  //---------------------------hiding the tab based on the rfp == yes and status----end-----------------------
   
   // //-------------hiding tabs for not_required-----------------------------------
   //  if($("#rfporeoipublished_c").val() == "not_required" && $("#status_c").val() == "Lead" ){
     
     
      
   //     $("#top-panel-1").hide() ;
   //     $("#top-panel-3").hide() ;
   //     $("#top-panel-4").hide() ;
   //     $("#top-panel-5").hide() ;
   //    $("#top-panel-6").hide() ;
   // }
   
   // if($("#rfporeoipublished_c").val() == "not_required" && $("#status_c").val() == "QualifiedLead" ){
       
   //     $("#top-panel-1").show() ;
   //     $("#top-panel-3").show() ;
       
   //     $("#top-panel-4").hide() ;
   //     $("#top-panel-5").hide() ;
   //     $("#top-panel-6").hide() ;
   // }
   
   // if($("#rfporeoipublished_c").val() == "not_required" && $("#status_c").val() == "Qualified" ){
       
   //    $("#top-panel-1").show() ;
   //     $("#top-panel-3").show() ;
   //     $("#top-panel-4").show() ;
   //     $("#top-panel-5").hide() ;
       
   //     $("#top-panel-6").hide() ;
   // }
   
   // if($("#rfporeoipublished_c").val() == "not_required" && $("#status_c").val() == "QualifiedDpr" ){
   //     $("#top-panel-1").show() ;
   //     $("#top-panel-3").show() ;
   //     $("#top-panel-4").hide() ;
   //     $("#top-panel-5").show() ;
       
   //    $("#top-panel-6").hide() ;
   // }
   
   // if($("#rfporeoipublished_c").val() == "not_required" && $("#status_c").val() == "Closed" ){
   //     $("#top-panel-1").show() ;
   //     $("#top-panel-3").show() ;
   //     $("#top-panel-4").hide() ;
   //     $("#top-panel-5").show() ;
       
   //    $("#top-panel-6").hide() ;
   // }
   
   // //-------------hiding tabs for not_required---------END--------------------------
   
  
   
  
   
   
   //****************************************************END********************************************************************************************
   
   //****************************************to remove edit and delete options and check untag users in Detail View opportunities****************************
    var opp_id=$('#formDetailView input[name=record]').val();
    var status = $("#status_c").val();
    var rfp_eoi_published = $("#rfporeoipublished_c").val();
   //-----------------------------------opp icons------------------------------------------------------------- 
      $.ajax({
        url : 'index.php?module=Opportunities&action=opp_icons',
        type : 'POST',
        data: {
            opp_id,
            status,
            rfp_eoi_published
        },
        success : function(data){
         
         data=JSON.parse(data);
         
         if(data.button=="pending"){
              
    //---------------------------hiding the tab based on the rfp and status---------------------------
    var status;
     if( $("#status_c").val() == "Drop" ){
     
     status='Dropping Opportunity';
      
     
   }
    
   if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "Lead" ){
     
     status='Qualify Lead';
      
     
   }
   
   if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "QualifiedLead" ){
       
     status='Qualify Opportunity';
   }
   
   if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "Qualified" ){
       
      status="Qualify DPR"
      
   }
   
   if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "QualifiedDpr" ){
    
       
        status='Qualify BID';
       
         
       
   }
   
   if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "QualifiedBid" ){
     status='Closure';
       
      
        
   }
   
  
   
   //---------------------------hiding the tab based on the rfp == no and status----end-----------------------
   
   
   
   //---------------------------hiding the tab based on the rfp == yes and status----start-----------------------
   
    if($("#rfporeoipublished_c").val() == "yes" && $("#status_c").val() == "Lead" ){
     
       
     status = "Qualify Lead";  
       
   }
   
    if($("#rfporeoipublished_c").val() == "yes" && $("#status_c").val() == "QualifiedLead" ){
       
      status = "Qualify Bid"
      
       
   }
   
   if($("#rfporeoipublished_c").val() == "yes" && $("#status_c").val() == "QualifiedBid" ){
      
      status = "Closure" 
   }
   
   
   
   //-------------hiding tabs for not_required-----------------------------------
    if($("#rfporeoipublished_c").val() == "not_required" && $("#status_c").val() == "Lead" ){
     
     
      status='Qualify Lead';
      
   }
   
   if($("#rfporeoipublished_c").val() == "not_required" && $("#status_c").val() == "QualifiedLead" ){
       
      status='Qualify Opportunity';
   }
   
   if($("#rfporeoipublished_c").val() == "not_required" && $("#status_c").val() == "Qualified" ){
       
     status='Qualify DPR';
   }
   
   if($("#rfporeoipublished_c").val() == "not_required" && $("#status_c").val() == "QualifiedDpr" ){
      
      status='Closure';
   }
   
 
   
   //-------------hiding tabs for not_required---------END--------------------------
    $('.moduleTitle').append('<img style="display:inline; width:3%; margin:0 1% 1% " src="/UAT/custom/modules/Opportunities/rahul_pending.png"><p style="display:inline">Approval for '+status+' is pending</p>')
          
          
         }
         else if(data.button=="green"){
          
                         var status= $("#status_c").val();
                         
                         if(status=='QualifiedLead'){
                          
                          status='Qualify Lead'
                         }
                         else if(status=='Qualified'){
                          
                          status='Qualify Opportunity'
                         }
                         else if(status=='QualifiedDpr'){
                          
                          status='Qualify DPR'
                         }
                         else if(status=='QualifiedBid'){
                          
                          status='Qualify BID'
                         }
                             else if( $("#status_c").val() == "Drop" ){
             
                                status='Opportunity Dropped';
                                 
                                
                              }
                         
                         $('.moduleTitle').append('<img style="display:inline; width:3%; margin:0 1% 1% " src="/UAT/custom/modules/Opportunities/green.png"><p style="display:inline">Status '+status+' is Approved</p>')
                         
          
         }
         else if(data.button=="red"){
          
                 var status;
            
                 if( $("#status_c").val() == "Drop" ){
             
             status='Dropping Opportunity';
              
             
           }
            
             if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "Lead" ){
     
     status='Qualify Lead';
      
     
   }
   
   if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "QualifiedLead" ){
       
     status='Qualify Opportunity';
   }
   
   if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "Qualified" ){
       
      status="Qualify DPR"
      
   }
   
   if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "QualifiedDpr" ){
    
       
        status='Qualify BID';
       
         
       
   }
   
   if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "QualifiedBid" ){
     status='Closure';
       
      
        
   }
   
  
   
   //---------------------------hiding the tab based on the rfp == no and status----end-----------------------
   
   
   
   //---------------------------hiding the tab based on the rfp == yes and status----start-----------------------
   
    if($("#rfporeoipublished_c").val() == "yes" && $("#status_c").val() == "Lead" ){
     
       
     status = "Qualify Lead";  
       
   }
   
    if($("#rfporeoipublished_c").val() == "yes" && $("#status_c").val() == "QualifiedLead" ){
       
      status = "Qualify Bid"
      
       
   }
   
   if($("#rfporeoipublished_c").val() == "yes" && $("#status_c").val() == "QualifiedBid" ){
      
      status = "Closure" 
   }
   
   
   
   //-------------hiding tabs for not_required-----------------------------------
    if($("#rfporeoipublished_c").val() == "not_required" && $("#status_c").val() == "Lead" ){
     
     
      status='Qualify Lead';
      
   }
   
   if($("#rfporeoipublished_c").val() == "not_required" && $("#status_c").val() == "QualifiedLead" ){
       
      status='Qualify Opportunity';
   }
   
   if($("#rfporeoipublished_c").val() == "not_required" && $("#status_c").val() == "Qualified" ){
       
     status='Qualify DPR';
   }
   
   if($("#rfporeoipublished_c").val() == "not_required" && $("#status_c").val() == "QualifiedDpr" ){
      
      status='Closure';
   }
   
 
   
   //-------------hiding tabs for not_required---------END--------------------------
                         
                         
                         
                   $('.moduleTitle').append('<img style="display:inline; width:3%; margin:0 1% 1% " src="/UAT/custom/modules/Opportunities/red.png"><p style="display:inline">Approval for '+status+' is Rejected</p>')
                         
          
         }
         
        }
   
  });
  
   //-----------------------------------opp icons------------------------------------------------------------- 
  
      $.ajax({
        url : 'index.php?module=Opportunities&action=detailView_check',
        type : 'POST',
        dataType: "json",
          data :
            {
                opp_id
                
            },
             success: function (data) {
              
           // alert(data);
           
            var data1=data;
           console.log(data1);
            
            if(data1==='true'){
             
             console.log("in");
             $('#edit_button').show();
             $('#delete_button').show();
            }
           if(data1==='false') {
             console.log("else");
             $('#edit_button').hide();
             $('#delete_button').hide();
            }
              
             }
       
      });
      
       $.ajax({
        url : 'index.php?module=Opportunities&action=untag_users_check',
        type : 'POST',
        dataType: "json",
          data :
            {
                opp_id
                
            },
             success: function (data) {
              var data1=data;
              
             // alert(data1);
              
         if(data.status == true){
             // alert("in id");
              window.location.replace(window.location.href.split('?')[0]+"?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26action%3Dindex%26return_module%3DOpportunities%26return_action%3DDetailView");
             
            }
            
           // if(data1==='false') {
            
            
           //  }
              
             }
       
      });
		
		//****************************************to remove edit and delete options and check untag users in Detail View opportunities**END**************************
     
  //------------------------------------tag user check---------------------------------------    
  
   //     $.ajax({
   //      url : 'index.php?module=Opportunities&action=tag_users_check',
   //      type : 'POST',
   //      dataType: "json",
   //        data :
   //          {
   //              opp_id
                
   //          },
   //           success: function (data) {
   //            var data1=data;
              
   //           // alert(data1);
              
   //       if(data1==='true'){
           
   //            $("#top-panel-6").show() ;
   //          $('div[field=comment_c]').append('<textarea rows="4" cols="50" style="width:80%; " id="taggged_comments_data"></textarea><center><button style="display:block; margin-top:10px; " type="button" class="button" id="submit_taggged_comments">Add Comments</button></center> ');
             
   //           $.ajax({
   //      url : 'index.php?module=Opportunities&action=tag_users_comments_fetch',
   //      type : 'POST',
   //      dataType: "json",
   //        data :
   //          {
   //              opp_id
                
   //          },
   //           success: function (data) {
              
   //            data=JSON.parse(data);
   //            //alert(data);
   //            if(data.comments!=''){
               
   //              $('#top-panel-6').text(data.comments);
   //            }
              
   //           }
    
   // });
   
   //          }
            
   //          else if(data1 === 'true-readonly'){
             
   //          if($("#opportunity_type").val()=="global"){
   //            $("#whole_subpanel_opportunities_users_1").css("display","block");
   //            $("#top-panel-6").show();
   
   // }else{
   //   $("#whole_subpanel_opportunities_users_1").css("display","block");
   //            $("#top-panel-6").show();
   //  $("#whole_subpanel_opportunities_users_2").css("display","block");
   // }
             
             
             
   //            $.ajax({
   //      url : 'index.php?module=Opportunities&action=tag_users_comments_fetch',
   //      type : 'POST',
   //      dataType: "json",
   //        data :
   //          {
   //              opp_id
                
   //          },
   //           success: function (data) {
              
   //            data=JSON.parse(data);
              
               
               
   //            if(data.comments!=''){
               
               
   //             $('#top-panel-6').text(data.comments);
   //            }
              
   //           }
    
   // });
             
   //          }
            
            
           
              
   //           }
       
   //    });
   
  //------------------------------------tag user check-------------------END--------------------
  
  //----------------------------------------- save and fetch the data for tagged-users in comment---------------------------------
  
  
  
  $(document).on("click","#submit_taggged_comments",function(){
   
   //alert("comm");
    
   var tagged_comments=$('#taggged_comments_data').val();
   
   $.ajax({
        url : 'index.php?module=Opportunities&action=tag_users_comments_save',
        type : 'POST',
        dataType: "json",
          data :
            {
                opp_id,
                tagged_comments
                
            },
             success: function (data) {
              
            
              
              
              
             }
  
    
   });
   
    window.location.reload();
   
  })
  //----------------------------------------- save and fetch the data for tagged-users in comment-------------END--------------------
   //---------------------------multiple file upload -------------------------------------------------     
 
 
	var record_id = $('#formDetailView input[name=record]').val();
	$('#DetailView').attr('enctype','multipart/form-data');
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
   
     $("#financial_feasibility_l1_c").on('click',function(){
    // console.log("Hi there!");
     $(".open-button").trigger('click');
     
   });
   $("#financial_feasibility_l2_c").on('click',function(){
     $(".open-button1").trigger('click');
   });
    $("#financial_feasibility_l3_c").on('click',function(){
     document.getElementById("myForm").style.display = "block";
       document.getElementById("mtwenty").style.display = "block";
       document.getElementById("mtenth").style.display = "block";
       document.getElementById("close2").style.display = "block";
        document.getElementById("tenth").style.display = "inline";
         document.getElementById("chec").style.display = "inline";
        document.getElementById("close1").style.display = "none";
         document.getElementById("first_form").style.display = "none";
        document.getElementById("reset").style.display = "none";
   });
   
     $(document).on('click','#close1',function(){
     // alert('custom');
     document.getElementById("myForm").style.display = "none";});
      $(document).on('click', '#close2', function(){
         document.getElementById("myForm").style.display = "none";
});

 

                   $('#myForm input').attr("disabled",true);
                   $('#myForm select').attr("disabled",true);
                   $('#tenth').attr("disabled",true);
                   $('#close1,#close2').attr("disabled",false);
  
                 

   //**************************Write code above this line******************************************************
});
