$(document).ready(function () {
 // console.log('custom.js');
  
  // var id=$('#EditView input[name=record]').val();
  // console.log(id);
  $('#btn_assigned_user_name,#btn_clr_assigned_user_name,#btn_account_name,#btn_clr_account_name,#btn_influencersl1_c,#btn_clr_influencersl1_c,#btn_influencersl2_c,#btn_clr_influencersl2_c').css("display","none");
  
   $(document).on('click','#assigned_user_name',function() {
   console.log("in");
   
   $('#btn_assigned_user_name').trigger('click');
      
  });
  
  $(document).on('click','#account_name',function() {
   console.log("in");
   
   $('#btn_account_name').trigger('click');
      
  });
  
  
  $('#detailpanel_4').hide();
  
  //  $(document).on('click','#influencersl1_c',function() {
  //  console.log("in");
   
  //  $('#btn_influencersl1_c').trigger('click');
      
  // });
  
  //  $(document).on('click','#influencersl2_c',function() {
  //  console.log("in");
   
  //  $('#btn_influencersl2_c').trigger('click');
      
  // });
  
  
   $("#status_c").attr("disabled",true);
    $(".pagination").hide();
    $("#btn_view_change_log").remove();
    $('#btn_view_change_log').remove();
    
    //required * after label
     $("[data-label=LBL_OPPORTUNITY_NAME],[data-label=LBL_STATE],[data-label=LBL_SOURCE]").append(
           '<span class="required">*</span>'
          ); 
    
    
    
     //adding asterisk
          if ($("[data-label=LBL_SEGMENT] span").text() == "") {
             $("[data-label=LBL_SEGMENT]").append(
              "<span style='color:red;'>*</span>"
              );
               } 
               
               if ($("[data-label=LBL_PRODUCT_SERVICE] span").text() == "") {
             $("[data-label=LBL_PRODUCT_SERVICE]").append(
              "<span style='color:red;'>*</span>"
              );
               } 
    
  $('#financial_feasibility_l1_c').replaceWith('<button type="button" class="button" id="financial_feasibility_l1_c">Add L1 Details</button>');
  
  $('#financial_feasibility_l2_c').replaceWith('<button type="button" class="button" id="financial_feasibility_l2_c">Add L2 Details</button>');
  
  $('#financial_feasibility_l3_c').replaceWith('<button type="button" class="button" id="financial_feasibility_l3_c">Add L3 Details</button>');
  
  $("#bid_checklist_c").replaceWith('<button type="button" class="button" id="bid_checklist_c">Add Bid Checklist</button>');
    $("#bid_checklist_c").on('click',function(){
   //  console.log("checklist");
     $(".open_bidChecklist").trigger('click');
   });
   
   
  $("#cash_flow_c").replaceWith('<button type="button" class="button" id="cash_flow_c">Add Cash Flow</button>');
  
   $("#cash_flow_c").on('click',function(){
    // console.log("Hi there!");
     $(".open-button").trigger('click');
   });
   
   
  
   $("#financial_feasibility_l1_c").on('click',function(){
    // console.log("Hi there!");
     $(".open-button").trigger('click');
   });
   
    
  
   $("#financial_feasibility_l2_c").on('click',function(){
     //console.log("Hi there!");
    
     $(".open-button1").trigger('click');
   });
   
    
  
   $("#financial_feasibility_l3_c").on('click',function(){
    // console.log("Hi there!");
     $(".open-button1").trigger('click');
   });
   
   
  //dropdown for sector
    var selected_sector = $("#sector_c").val();
    
    $("#sector_c").replaceWith('<select name="sector_c" id="sector_c" onchange="sectorFunction(this.value)"></select>');
  
  $.ajax({
    url : 'index.php?module=Opportunities&action=sector',
        type : 'GET',
        success : function(all_sector_list){
          if(selected_sector == ""){
            var list = '<option value=""></option> +'; 
          }else{
                    var list = '<option value="'+selected_sector+'">'+selected_sector+'</option> +';
                }
            
            all_sector_list=JSON.parse(all_sector_list);
            all_sector_list.forEach((sector)=>{
              if(sector.name != selected_sector){
                list+='<option value="'+sector.name+'">'+sector.name+'</option>';
              }
            })
            $("#sector_c").html(list);
        }
});
  
  //Dependable dropdown according to sector selection
  
  var selected_subSector = $("#sub_sector_c").val();
  $("#sub_sector_c").replaceWith('<select name="sub_sector_c" id="sub_sector_c"></select>');

    if(selected_subSector !== ""){
      $.ajax({
      type: "POST",
      url:
        "index.php?module=Opportunities&action=subSector",
      data: { sector_name:selected_sector },
      success: function (data) {
            var list = '<option value="'+selected_subSector+'">'+selected_subSector+'</option> +';
          data=JSON.parse(data);
            data.forEach((subSector)=>{
              if(subSector.name != selected_subSector){
                list+='<option value="'+subSector.name+'">'+subSector.name+'</option>';
              }
            });
            $("#sub_sector_c").html(list);
      },
    });
    }
    
   
  
  //onchange sector 
  
  sectorFunction = function(sector){
    $.ajax({
      type: "POST",
     url:
        "index.php?module=Opportunities&action=subSector",
      data: { sector_name:sector },
      success: function (data) {
       
          // $("#sub_sector1_c").append(data);
         $("#sub_sector_c").replaceWith('<select name="sub_sector_c" id="sub_sector_c"></select>');
             var list = '<option value=""></option> +';
          
          data=JSON.parse(data);
            data.forEach((subSector)=>{
            
                list+='<option value="'+subSector.name+'">'+subSector.name+'</option>';
              
            });
            $("#sub_sector_c").html(list);
      },
    });
  }

//segment dropdown
    var selected_segment = $("#segment_c").val();
    
    $("#segment_c").replaceWith('<select name="segment_c" id="segment_c" onchange="segmentFunction(this.value)"></select>');
  
  $.ajax({
    url : 'index.php?module=Opportunities&action=segment',
        type : 'GET',
        success : function(all_segment_list){
          if(selected_segment == ""){
            var list = '<option value=""></option> +'; 
          }else{
                    var list = '<option value="'+selected_segment+'">'+selected_segment+'</option> +';
                }
            
            all_segment_list=JSON.parse(all_segment_list);
            all_segment_list.forEach((segment)=>{
              if(segment.segment_name != selected_segment){
                list+='<option value="'+segment.segment_name+'">'+segment.segment_name+'</option>';
              }
            });
            $("#segment_c").html(list);
        }
});

//sevrice dropdown
 var selected_service = $("#product_service_c").val();
  $("#product_service_c").replaceWith('<select name="product_service_c" id="product_service_c"></select>');

    if(selected_service != ""){
      $.ajax({
      type: "POST",
      url:
        "index.php?module=Opportunities&action=productService",
      data: { segment_name:selected_segment },
      success: function (data) {
            var list = '<option value="'+selected_service+'">'+selected_service+'</option> +';
          data=JSON.parse(data);
            data.forEach((service)=>{
              if(service.service_name != selected_service){
                list+='<option value="'+service.service_name+'">'+service.service_name+'</option>';
              }
            });
            $("#product_service_c").html(list);
      },
    });
    }
    
   
  
  //onchange segment
  
  segmentFunction = function(segment){
    $.ajax({
      type: "POST",
     url:
        "index.php?module=Opportunities&action=productService",
      data: { segment_name:segment },
      success: function (data) {
       
         $("#product_service_c").replaceWith('<select name="product_service_c" id="product_service_c"></select>');
             var list = '<option value=""></option> +';
          
          data=JSON.parse(data);
            data.forEach((service)=>{
                list+='<option value="'+service.service_name+'">'+service.service_name+'</option>';
              
            });
            $("#product_service_c").html(list);
       
      },
    });
  }
  
  
  // // function blocking(){
   
    $("#filename_file").attr("disabled",true);          
    $("#applyfor_c").attr("disabled",true);
    
    
  // //if nothing  is selected
  if ( $("#rfporeoipublished_c").val()=='select'){
    //console.log('in')
        $("#detailpanel_0").hide();
        $("#detailpanel_1").hide();
        $("#detailpanel_2").hide();
        $("#detailpanel_3").hide();
        // $("#detailpanel_4").hide();
        $("#detailpanel_5").hide();
        $("#detailpanel_6").hide();
        $("#status_c").attr("disabled",true);
        
  }
  
  
  if($("#rfporeoipublished_c").val()=="no"){ 
   
   $("#status_c option[value='Qualified']").show();
    $("#status_c option[value='QualifiedDpr']").show();
    
    $("#filename_file").attr("disabled",true);     
              $("#status_c").attr("disabled",false);
              $("#detailpanel_0").show() ;
              $("#detailpanel_1").show() ;
              $("#detailpanel_2").show();
              $("#detailpanel_3").hide() ;
              // $("#detailpanel_4").hide() ;
              $("#detailpanel_5").hide() ;
              $("#detailpanel_6").hide() ;
              $("#detailpanel_7").hide() ;
              $("#financial_feasibility_l1_c").attr("disabled",true);
              $("#budget_source_c").attr("disabled",true);
              $("#budget_head_c").attr("disabled",true);
              $("#budget_head_amount_c").attr("disabled",true);
              $("#project_implementation_start_c").attr("disabled",true);
              $("#project_implementation_end_c").attr("disabled",true);
              $("#budget_allocated_oppertunity_c").attr("disabled",true);
              $("#financial_feasibility_l2_c").attr("disabled",true);
              $("#financial_feasibility_l3_c").attr("disabled",true);
              $("#cash_flow_c").attr("disabled",true);
              $("#project_implementation_start_c_trigger").attr("disabled",true);
              $("#project_implementation_end_c_trigger").attr("disabled",true);
             // $("#status_c").val("Lead");
              $("#applyfor_c").val('qualifylead');
              $("#applyfor_c").val('qualifylead');
          $("#detailpanel_2").show() ;
          $("#sector_c").attr("disabled",true);
          $("#sub_sector_c").attr("disabled",true);
          $("#selection_c").attr("disabled",true);
          $("#funding_c").attr("disabled",true);
          $("#timing_button_c").attr("disabled",true);
          $("#risk_c").attr("disabled",true);
          
          
  }
  
  
  if ( $("#rfporeoipublished_c").val()=='yes'){
   
                 $("#status_c option[value='Qualified']").hide();
                 $("#status_c option[value='QualifiedDpr']").hide();
                 
                $("#detailpanel_0").show() ;
                $("#detailpanel_1").show() ;
                $("#detailpanel_2").show() ;
                $("#detailpanel_3").show() ;
                // $("#detailpanel_4").show() ;
                $("#detailpanel_5").show() ;
                $("#detailpanel_6").hide() ;
                $("#status_c").attr("disabled",false);
                $("#budget_source_c").attr("disabled",false);
                 $("#filename_file").attr("disabled",false);
              $("#budget_head_c").attr("disabled",false);
              $("#budget_head_amount_c").attr("disabled",false);
              $("#project_implementation_start_c").attr("disabled",false);
              $("#project_implementation_end_c").attr("disabled",false);
              $("#budget_allocated_oppertunity_c").attr("disabled",false);
              $("#financial_feasibility_l2_c").attr("disabled",false);
              $("#financial_feasibility_l3_c").attr("disabled",false);
              $("#cash_flow_c").attr("disabled",false);
              $("#project_implementation_start_c_trigger").attr("disabled",false);
              $("#project_implementation_end_c_trigger").attr("disabled",false);
             $("#status_c").val("QualifiedLead");
              $("#applyfor_c").val('qualifyBid');
              
            
          //      $("#selection_c").attr("disabled",false);
          // $("#funding_c").attr("disabled",false);
          // $("#timing_button_c").attr("disabled",false);
          // $("#risk_c").attr("disabled",false);
               
               if ($("[data-label=LBL_FILENAME] span").text() == "") {
               
             $("[data-label=LBL_FILENAME]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
                if ($("[data-label=LBL_BUDGET_SOURCE] span").text() == "") {
             $("[data-label=LBL_BUDGET_SOURCE]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
                if ($("[data-label=LBL_BUDGET_HEAD] span").text() == "") {
             $("[data-label=LBL_BUDGET_HEAD]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
                if ($("[data-label=LBL_BUDGET_HEAD_AMOUNT] span").text() == "") {
             $("[data-label=LBL_BUDGET_HEAD_AMOUNT]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
                if ($("[data-label=LBL_BUDGET_ALLOCATED_OPPERTUNITY] span").text() == "") {
             $("[data-label=LBL_BUDGET_ALLOCATED_OPPERTUNITY]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
                if ($("[data-label=LBL_PROJECT_IMPLEMENTATION_START] span").text() == "") {
             $("[data-label=LBL_PROJECT_IMPLEMENTATION_START]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
                if ($("[data-label=LBL_PROJECT_IMPLEMENTATION_END] span").text() == "") {
             $("[data-label=LBL_PROJECT_IMPLEMENTATION_END]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               $("[data-label=LBL_FINANCIAL_FEASIBILITY_L1] span").empty();
               
             //    if ($("[data-label=LBL_FINANCIAL_FEASIBILITY_L2] span").text() == "") {
             // $("[data-label=LBL_FINANCIAL_FEASIBILITY_L2]").append(
             //  "<span style='color:red;'>*</span>"
             //  );
             //   }
               
                if ($("[data-label=LBL_FINANCIAL_FEASIBILITY_L3] span").text() == "") {
             $("[data-label=LBL_FINANCIAL_FEASIBILITY_L3]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
                if ($("[data-label=LBL_CASH_FLOW] span").text() == "") {
             $("[data-label=LBL_CASH_FLOW]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               
                if ($("[data-label=LBL_FIRST_OF_A_KIND_SEGMENT] span").text() == "") {
             $("[data-label=LBL_FIRST_OF_A_KIND_SEGMENT]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
                if ($("[data-label=LBL_FIRST_OF_A_KIND_PRODUCT] span").text() == "") {
             $("[data-label=LBL_FIRST_OF_A_KIND_PRODUCT]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               if ($("[data-label=LBL_SECTOR] span").text() == "") {
             $("[data-label=LBL_SECTOR]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               if ($("[data-label=LBL_SUB_SECTOR] span").text() == "") {
             $("[data-label=LBL_SUB_SECTOR]").append(
              "<span style='color:red;'>*</span>"
              );
               } 
              
               if ($("[data-label=LBL_SEGMENT] span").text() == "") {
             $("[data-label=LBL_SEGMENT]").append(
              "<span style='color:red;'>*</span>"
              );
               } 
               
                if ($("[data-label=LBL_PRODUCT_SERVICE] span").text() == "") {
             $("[data-label=LBL_PRODUCT_SERVICE]").append(
              "<span style='color:red;'>*</span>"
              );
               } 
               
             //    if ($("[data-label=LBL_ADD_NEW_SEGMENT] span").text() == "") {
             // $("[data-label=LBL_ADD_NEW_SEGMENT]").append(
             //  "<span style='color:red;'>*</span>"
             //  );
             //   } 
               
             //    if ($("[data-label=LBL_ADD_NEW_PRODUCT_SERVICE] span").text() == "") {
             // $("[data-label=LBL_ADD_NEW_PRODUCT_SERVICE]").append(
             //  "<span style='color:red;'>*</span>"
             //  );
             //   } 
               
               if ($("[data-label=LBL_SELECTION] span").text() == "") {
             $("[data-label=LBL_SELECTION]").append(
              "<span style='color:red;'>*</span>"
              );
               } 
               
                if ($("[data-label=LBL_FUNDING] span").text() == "") {
             $("[data-label=LBL_FUNDING]").append(
              "<span style='color:red;'>*</span>"
              );
               } 
               
                if ($("[data-label=LBL_TIMING_BUTTON] span").text() == "") {
             $("[data-label=LBL_TIMING_BUTTON]").append(
              "<span style='color:red;'>*</span>"
              );
               } 
               
               
          
          //adding asterisk to financial tab
          if ($("[data-label=LBL_SCOPE_BUDGET_PROJECTED] span").text() == "") {
             $("[data-label=LBL_SCOPE_BUDGET_PROJECTED]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               if ($("[data-label=LBL_RFP_EOI_PROJECTED] span").text() == "") {
             $("[data-label=LBL_RFP_EOI_PROJECTED]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               if ($("[data-label=LBL_RFP_EOI_PUBLISHED_PROJECTED] span").text() == "") {
             $("[data-label=LBL_RFP_EOI_PUBLISHED_PROJECTED]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               if ($("[data-label=LBL_WORK_ORDER_PROJECTED] span").text() == "") {
             $("[data-label=LBL_WORK_ORDER_PROJECTED]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
              if ($("[data-label=LBL_SCOPE_BUDGET_ACHIEVED] span").text() == "") {
             $("[data-label=LBL_SCOPE_BUDGET_ACHIEVED]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
                if ($("[data-label=LBL_RFP_EOI_ACHIEVED] span").text() == "") {
             $("[data-label=LBL_RFP_EOI_ACHIEVED]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               if ($("[data-label=LBL_RFP_EOI_PUBLISHED_ACHIEVED] span").text() == "") {
             $("[data-label=LBL_RFP_EOI_PUBLISHED_ACHIEVED]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               if ($("[data-label=LBL_WORK_ORDER_ACHIEVED] span").text() == "") {
             $("[data-label=LBL_WORK_ORDER_ACHIEVED]").append(
              "<span style='color:red;'>*</span>"
              );
               }
         
          
          //adding asterisk to influencer tab
           // if ($("[data-label=LBL_INFLUENCERSL1] span").text() == "") {
           //   $("[data-label=LBL_INFLUENCERSL1]").append(
           //    "<span style='color:red;'>*</span>"
           //    );
           //     }
               
             //   if ($("[data-label=LBL_INFLUENCERSL2] span").text() == "") {
             // $("[data-label=LBL_INFLUENCERSL2]").append(
             //  "<span style='color:red;'>*</span>"
             //  );
             //   }
       
          //adding asterisk to bid tab
           if ($("[data-label=LBL_BID_STRATEGY] span").text() == "") {
             $("[data-label=LBL_BID_STRATEGY]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               if ($("[data-label=LBL_SUBMISSIONSTATUS] span").text() == "") {
             $("[data-label=LBL_SUBMISSIONSTATUS]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               if ($("[data-label=LBL_RFP_EOI_SUMMARY] span").text() == "") {
             $("[data-label=LBL_RFP_EOI_SUMMARY]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               if ($("[data-label=LBL_BID_CHECKLIST] span").text() == "") {
             $("[data-label=LBL_BID_CHECKLIST]").append(
              "<span style='color:red;'>*</span>"
              );
               }
  }
  
              
    
  
  
    
     
  
    $("#rfporeoipublished_c").on("change", function () {
       
       
      var x=$("#rfporeoipublished_c").val();
      //console.log(x);
      
      switch (x){
        
        case "yes":
        
          
            // $("#status_c option[value='Lead']").remove();
              $("#status_c option[value='Qualified']").hide();
               $("#status_c option[value='QualifiedDpr']").hide();
              
               $("#filename_file").attr("disabled",false);     
              $("#detailpanel_0").show() ;
              $("#detailpanel_1").hide() ;
              $("#detailpanel_2").show();
              $("#detailpanel_3").hide() ;
              // $("#detailpanel_4").hide() ;
              $("#detailpanel_5").hide() ;
              $("#detailpanel_6").hide() ;
              $("#detailpanel_7").hide() ;
              
              $("#financial_feasibility_l1_c").attr("disabled",true);
              $("#budget_source_c").attr("disabled",true);
              $("#budget_head_c").attr("disabled",true);
              $("#budget_head_amount_c").attr("disabled",true);
              $("#project_implementation_start_c").attr("disabled",true);
              $("#project_implementation_end_c").attr("disabled",true);
              $("#budget_allocated_oppertunity_c").attr("disabled",true);
              $("#financial_feasibility_l2_c").attr("disabled",true);
              $("#financial_feasibility_l3_c").attr("disabled",true);
              $("#cash_flow_c").attr("disabled",true);
              $("#project_implementation_start_c_trigger").attr("disabled",true);
              $("#project_implementation_end_c_trigger").attr("disabled",true);
              $("#status_c").val("Lead");
              $("#applyfor_c").val('qualifylead');
              
             
              
               $("#detailpanel_2").show() ;
          $("#sector_c").attr("disabled",true);
          $("#sub_sector_c").attr("disabled",true);
          $("#selection_c").attr("disabled",true);
          $("#funding_c").attr("disabled",true);
          $("#timing_button_c").attr("disabled",true);
          $("#risk_c").attr("disabled",true);
          
          $("#status_c").attr("disabled",false);
          
          
          
          //removing asterisk frm not mandatory field in NO condition
          
               
          
               break;
              
        
          
          case "no":
           //console.log(x,"no");
           
            $("#status_c option[value='Qualified']").show();
            $("#status_c option[value='QualifiedDpr']").show();
           
            $("#filename_file").attr("disabled",true);     
              // document.getElementById("source_details_c").requi#f59542;
              // $("input").prop('required',true);
              $("#detailpanel_0").show() ;
              $("#detailpanel_1").hide() ;
              $("#detailpanel_2").show();
              $("#detailpanel_3").hide() ;
              // $("#detailpanel_4").hide() ;
              $("#detailpanel_5").hide() ;
              $("#detailpanel_6").hide() ;
              $("#detailpanel_7").hide() ;
              
              $("#financial_feasibility_l1_c").attr("disabled",true);
              $("#budget_source_c").attr("disabled",true);
              $("#budget_head_c").attr("disabled",true);
              $("#budget_head_amount_c").attr("disabled",true);
              $("#project_implementation_start_c").attr("disabled",true);
              $("#project_implementation_end_c").attr("disabled",true);
              $("#budget_allocated_oppertunity_c").attr("disabled",true);
              $("#financial_feasibility_l2_c").attr("disabled",true);
              $("#financial_feasibility_l3_c").attr("disabled",true);
              $("#cash_flow_c").attr("disabled",true);
              $("#project_implementation_start_c_trigger").attr("disabled",true);
              $("#project_implementation_end_c_trigger").attr("disabled",true);
              
              $("#status_c").val("Lead");
              $("#applyfor_c").val('qualifylead');
              
               $("#detailpanel_2").show() ;
          $("#sector_c").attr("disabled",true);
          $("#sub_sector_c").attr("disabled",true);
          $("#selection_c").attr("disabled",true);
          $("#funding_c").attr("disabled",true);
          $("#timing_button_c").attr("disabled",true);
          $("#risk_c").attr("disabled",true);
          $("#status_c").attr("disabled",false);
          
          $("#project_scope_c").attr("disabled",true);
          
          
          
          //removing asterisk frm not mandatory field in NO condition
          
           $("[data-label=LBL_FILENAME] span").empty();
           
           $("[data-label=LBL_BUDGET_SOURCE] span").empty();
               
                $("[data-label=LBL_BUDGET_HEAD] span").empty();
               
                $("[data-label=LBL_BUDGET_HEAD_AMOUNT] span").empty();
               
                $("[data-label=LBL_BUDGET_ALLOCATED_OPPERTUNITY] span").empty();
               
                $("[data-label=LBL_PROJECT_IMPLEMENTATION_START] span").empty();
               
              $("[data-label=LBL_PROJECT_IMPLEMENTATION_END] span").empty();
               
                $("[data-label=LBL_FINANCIAL_FEASIBILITY_L2] span").empty();
               
                $("[data-label=LBL_FINANCIAL_FEASIBILITY_L3] span").empty();
               
                $("[data-label=LBL_CASH_FLOW] span").empty();
               
               
                $("[data-label=LBL_FIRST_OF_A_KIND_SEGMENT] span").empty();
               
                $("[data-label=LBL_FIRST_OF_A_KIND_PRODUCT] span").empty();
               
               $("[data-label=LBL_SECTOR] span").empty();
               
               $("[data-label=LBL_SUB_SECTOR] span").empty();
              
               
               
                $("[data-label=LBL_ADD_NEW_SEGMENT] span").empty();
               
                $("[data-label=LBL_ADD_NEW_PRODUCT_SERVICE] span").empty();
               
               $("[data-label=LBL_SELECTION] span").empty();
               
                $("[data-label=LBL_FUNDING] span").empty();
               
                $("[data-label=LBL_TIMING_BUTTON] span").empty();
               
            
        break;
        
            case "select":
           //  console.log(x,"select");
              $("#filename_file").attr("disabled",true);     
              $("#detailpanel_0").hide() ;
              $("#detailpanel_1").hide() ;
              $("#detailpanel_2").hide() ;
              $("#detailpanel_3").hide() ;
              // $("#detailpanel_4").hide() ;
              $("#detailpanel_5").hide() ;
              $("#detailpanel_6").hide() ;
              $("#detailpanel_7").hide() ;
               $("#status_c").val("Lead");
              $("#applyfor_c").val('qualifylead');
              $("#status_c").attr("disabled",true);
            break;
        
      }
       
    });
    
    //.................status change and apply for change onload...................................................
    
    
    if($("#status_c").val()=="QualifiedLead" && $("#rfporeoipublished_c").val()=="no")
    {    
          $("#detailpanel_1").show() ;
          $("#detailpanel_2").show() ;
          $("#detailpanel_3").show() ;
          $("#sector_c").attr("disabled",false);
          $("#sub_sector_c").attr("disabled",false);
          $("#risk_c").attr("disabled",false);
          $("#selection_c").attr("disabled",true);
          $("#funding_c").attr("disabled",true);
          $("#timing_button_c").attr("disabled",true);
           $("#financial_feasibility_l1_c").attr("disabled",false);
           
           $("#project_scope_c").attr("disabled",true);
            $("[data-label=LBL_TYPE],[data-label=LBL_FINANCIAL_FEASIBILITY_L1]").append(
           '<span class="required">*</span>'
          ); 
          
     // console.log("insidee edit1");
    }else{
         // console.log("insidee edit");
        
          $("#sector_c").attr("disabled",false);
          $("#sub_sector_c").attr("disabled",false);
          $("#risk_c").attr("disabled",false);
          $("#selection_c").attr("disabled",false);
          $("#funding_c").attr("disabled",false);
          $("#timing_button_c").attr("disabled",false);
    };
    
     if($("#status_c").val()=="Qualified"){
       $("#detailpanel_1").show() ;
      $("#detailpanel_2").show() ;
         $("#detailpanel_3").show() ;
         // $("#detailpanel_4").show() ;
         $("#detailpanel_5").show() ;
         // $("#influencersl2_c").attr("disabled",true);
         $("#bid_strategy_c").attr("disabled",true);
         $("#submissionstatus_c").attr("disabled",true);
         $("#bid_checklist_c").attr("disabled",true);
         $("#sector_c").attr("disabled",false);
         $("#sub_sector_c").attr("disabled",false);
         $("#budget_source_c").attr("disabled",false);
         $("#budget_head_c").attr("disabled",false);
         $("#budget_head_amount_c").attr("disabled",false);
         $("#project_implementation_start_c").attr("disabled",false);
         $("#project_implementation_end_c").attr("disabled",false);
         $("#budget_allocated_oppertunity_c").attr("disabled",false);
         $("#financial_feasibility_l2_c").attr("disabled",false);
         $("#selection_c").attr("disabled",false);
         $("#funding_c").attr("disabled",false);
         $("#timing_button_c").attr("disabled",false);
         $("#risk_c").attr("disabled",false);
         
          $("#financial_feasibility_l1_c").attr("disabled",false);
         $("#project_scope_c").attr("disabled",false);
         
          if ($("[data-label=LBL_PROJECT_SCOPE] span").text() == "") {
             $("[data-label=LBL_PROJECT_SCOPE]").append(
              "<span style='color:red;'>*</span>"
              );
               }
         
          // $("#project_scope_c").attr("disabled",false);
          
          // //adding asterisk to project scope
          // if ($("[data-label=LBL_PROJECT_SCOPE] span").text() == "") {
          //    $("[data-label=LBL_PROJECT_SCOPE]").append(
          //     "<span style='color:red;'>*</span>"
          //     );
          //      }
     };
      if($("#status_c").val()=="QualifiedDpr"){
            $("#detailpanel_1").show() ;
           $("#detailpanel_2").show() ;
         $("#detailpanel_3").show() ;
         // $("#detailpanel_4").show() ;
         $("#detailpanel_5").show() ;
         $("#sector_c").attr("disabled",false);
         $("#sub_sector_c").attr("disabled",false);
         $("#budget_source_c").attr("disabled",false);
         $("#budget_head_c").attr("disabled",false);
         $("#budget_head_amount_c").attr("disabled",false);
         $("#project_implementation_start_c").attr("disabled",false);
         $("#project_implementation_end_c").attr("disabled",false);
         $("#budget_allocated_oppertunity_c").attr("disabled",false);
         $("#financial_feasibility_l2_c").attr("disabled",false);
         $("#financial_feasibility_l3_c").attr("disabled",false);
         $("#cash_flow_c").attr("disabled",false);
         $("#selection_c").attr("disabled",false);
         $("#funding_c").attr("disabled",false);
         $("#timing_button_c").attr("disabled",false);
         $("#risk_c").attr("disabled",false);
         // $("#influencersl2_c").attr("disabled",false);
         $("#bid_strategy_c").attr("disabled",false);
         $("#submissionstatus_c").attr("disabled",false);
         $("#bid_checklist_c").attr("disabled",false);   
         
          $("#financial_feasibility_l1_c").attr("disabled",false);
   
      };
       if($("#status_c").val()=="QualifiedBid"){
        
         $("#detailpanel_1").show() ;
          $("#applyfor_c").val('closure');
         $("#detailpanel_2").show() ;
          $("#detailpanel_3").show() ;
         // $("#detailpanel_4").show() ;
         $("#detailpanel_5").show() ;
         $("#detailpanel_6").show() ;
         $("#sector_c").attr("disabled",false);
         $("#sub_sector_c").attr("disabled",false);
         // $("#influencersl2_c").attr("disabled",false);
         $("#bid_strategy_c").attr("disabled",false);
         $("#submissionstatus_c").attr("disabled",false);
         $("#bid_checklist_c").attr("disabled",false); 
         $("#budget_source_c").attr("disabled",false);
         $("#budget_head_c").attr("disabled",false);
         $("#budget_head_amount_c").attr("disabled",false);
         $("#project_implementation_start_c").attr("disabled",false);
         $("#project_implementation_end_c").attr("disabled",false);
         $("#budget_allocated_oppertunity_c").attr("disabled",false);
         $("#financial_feasibility_l2_c").attr("disabled",false);
         $("#financial_feasibility_l3_c").attr("disabled",false);
         $("#cash_flow_c").attr("disabled",false);
         $("#selection_c").attr("disabled",false);
         $("#funding_c").attr("disabled",false);
         $("#timing_button_c").attr("disabled",false);
         $("#risk_c").attr("disabled",false);
         
          $("#financial_feasibility_l1_c").attr("disabled",false);
        
       };
       
      
     // status change and apply for changes
      
     $("#status_c").on("change", function () {
       
       
      var s=$("#status_c").val();
      
      $("#applyfor_c").val();
      
      switch (s){
        
        case "Lead":
        if($("#rfporeoipublished_c").val()=='no'){
         $("#applyfor_c").val('qualifylead');
          $("#detailpanel_2").show() ;
          $("#sector_c").attr("disabled",true);
          $("#sub_sector_c").attr("disabled",true);
          $("#selection_c").attr("disabled",true);
          $("#funding_c").attr("disabled",true);
          $("#timing_button_c").attr("disabled",true);
          $("#risk_c").attr("disabled",true);
           $("#project_scope_c").attr("disabled",true);
         
        }
         
        
        break;
        
        case "QualifiedLead":
          if($("#rfporeoipublished_c").val()=='no'){
           
            $("#detailpanel_1").show() ;
            $("#applyfor_c").val('qualifyOpportunity');
          $("#financial_feasibility_l1_c").attr("disabled",false);  
          $("#detailpanel_2").show() ;
          $("#detailpanel_3").show() ;
          $("#sector_c").attr("disabled",false);
          $("#sub_sector_c").attr("disabled",false);
          $("#risk_c").attr("disabled",false);
          $("#selection_c").attr("disabled",true);
          $("#funding_c").attr("disabled",true);
          $("#timing_button_c").attr("disabled",true);
          $("[data-label=LBL_PROJECT_SCOPE] span").empty();
          $("[data-label=LBL_TYPE],[data-label=LBL_FINANCIAL_FEASIBILITY_L1]").append(
           '<span class="required">*</span>'); 
           
            $("#financial_feasibility_l1_c").attr("disabled",false);
          
           $("#project_scope_c").attr("disabled",true);
           custom_check_form = function (view/*,EditView*/) {
                    var validate = true;
   
          var form_validation = $("#rfporeoipublished_c").val();
          
          if(form_validation == "no"){
   
   
             if($("#name").val() == ""){
              validate = false;
              $("#name").css("background-color", "Red");
             }
             if($("#state_c").val() == ""){
              validate = false;
              $("#state_c").css("background-color", "Red");
             }
             if($("#account_name").val() == ""){
              validate = false;
              $("#account_name").css("background-color", "Red");
             }
             if($("#source_c").val() == ""){
              validate = false;
              $("#source_c").css("background-color", "Red");
             }
            
             
             if($("#non_financial_consideration_c").val() == ""){
              validate = false;
              $("#non_financial_consideration_c").css("background-color", "Red");
             }
             
              if($("#segment_c").val() == ""){
              validate = false;
              $("#segment_c").css("background-color", "Red");
             }

                 if($("#product_service_c").val() == ""){
                     // console.log("ps");
              validate = false;
              $("#product_service_c").css("background-color", "Red");
             } 
             
               if($("#sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
              $("#sector_c").css("background-color", "Red");
             } 
             
               if($("#sub_sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
              $("#sub_sector_c").css("background-color", "Red");
             } 
             
               if($("#risk_c").val() == ""){
                      //console.log("ps");
              validate = false;
              $("#risk_c").css("background-color", "Red");
             } 
             
                 if($("#scope_budget_projected_c").val() == ""){
              validate = false;
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
             if($("#scope_budget_achieved_c").val() == ""){
              validate = false;
              $("#scope_budget_achieved_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_achieved_c").val() == ""){
              validate = false;
              $("#rfp_eoi_achieved_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_achieved_c").val() == ""){
              validate = false;
              $("#rfp_eoi_published_achieved_c").css("background-color", "Red");
             }
             
             if($("#work_order_achieved_c").val() == ""){
              validate = false;
              $("#work_order_achieved_c").css("background-color", "Red");
             }
             
             if(validate == false){
               alert("please fill the required fields"); 
             }
            
                if (validate && check_form(view)) {
                  return true;
                } else {
                  return false;
                }
              
            }
            
           }
           
         //adding asterisk
          if ($("[data-label=LBL_SECTOR] span").text() == "") {
             $("[data-label=LBL_SECTOR]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               if ($("[data-label=LBL_SUB_SECTOR] span").text() == "") {
             $("[data-label=LBL_SUB_SECTOR]").append(
              "<span style='color:red;'>*</span>"
              );
               } 
               
               if ($("[data-label=LBL_RISK] span").text() == "") {
             $("[data-label=LBL_RISK]").append(
              "<span style='color:red;'>*</span>"
              );
               } 
               
          
          //adding asterisk to financial tab
          if ($("[data-label=LBL_SCOPE_BUDGET_PROJECTED] span").text() == "") {
             $("[data-label=LBL_SCOPE_BUDGET_PROJECTED]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               if ($("[data-label=LBL_RFP_EOI_PROJECTED] span").text() == "") {
             $("[data-label=LBL_RFP_EOI_PROJECTED]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               if ($("[data-label=LBL_RFP_EOI_PUBLISHED_PROJECTED] span").text() == "") {
             $("[data-label=LBL_RFP_EOI_PUBLISHED_PROJECTED]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               if ($("[data-label=LBL_WORK_ORDER_PROJECTED] span").text() == "") {
             $("[data-label=LBL_WORK_ORDER_PROJECTED]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
              if ($("[data-label=LBL_SCOPE_BUDGET_ACHIEVED] span").text() == "") {
             $("[data-label=LBL_SCOPE_BUDGET_ACHIEVED]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
                if ($("[data-label=LBL_RFP_EOI_ACHIEVED] span").text() == "") {
             $("[data-label=LBL_RFP_EOI_ACHIEVED]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               if ($("[data-label=LBL_RFP_EOI_PUBLISHED_ACHIEVED] span").text() == "") {
             $("[data-label=LBL_RFP_EOI_PUBLISHED_ACHIEVED]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               if ($("[data-label=LBL_WORK_ORDER_ACHIEVED] span").text() == "") {
             $("[data-label=LBL_WORK_ORDER_ACHIEVED]").append(
              "<span style='color:red;'>*</span>"
              );
               }
        }
         
          
         
        break;
        
        case "Qualified":
          if($("#rfporeoipublished_c").val()=='no'){
         $("#applyfor_c").val('qualifyDpr');
          $("#detailpanel_1").show() ;
         $("#detailpanel_2").show() ;
         $("#detailpanel_3").show() ;
         // $("#detailpanel_4").show() ;
         $("#detailpanel_5").show() ;
         // $("#influencersl2_c").attr("disabled",true);
         $("#bid_strategy_c").attr("disabled",true);
         $("#submissionstatus_c").attr("disabled",true);
         $("#bid_checklist_c").attr("disabled",true);
         $("#sector_c").attr("disabled",false);
         $("#sub_sector_c").attr("disabled",false);
         $("#budget_source_c").attr("disabled",false);
         $("#budget_head_c").attr("disabled",false);
         $("#budget_head_amount_c").attr("disabled",false);
         $("#project_implementation_start_c").attr("disabled",false);
         $("#project_implementation_end_c").attr("disabled",false);
         $("#budget_allocated_oppertunity_c").attr("disabled",false);
         $("#financial_feasibility_l2_c").attr("disabled",false);
         $("#selection_c").attr("disabled",false);
         $("#funding_c").attr("disabled",false);
         $("#timing_button_c").attr("disabled",false);
         $("#risk_c").attr("disabled",false);
         
          $("#financial_feasibility_l1_c").attr("disabled",false);
         
         $("#project_scope_c").attr("disabled",false);
          
          
         
         
          custom_check_form = function (view/*,EditView*/) {
                    var validate = true;
   
          var form_validation = $("#rfporeoipublished_c").val();
          
          if(form_validation == "no"){
               
               
             if($("#name").val() == ""){
              validate = false;
              $("#name").css("background-color", "Red");
             }
             if($("#state_c").val() == ""){
              validate = false;
              $("#state_c").css("background-color", "Red");
             }
             if($("#account_name").val() == ""){
              validate = false;
              $("#account_name").css("background-color", "Red");
             }
             if($("#source_c").val() == ""){
              validate = false;
              $("#source_c").css("background-color", "Red");
             }
            
             
             if($("#non_financial_consideration_c").val() == ""){
              validate = false;
              $("#non_financial_consideration_c").css("background-color", "Red");
             }
                 if($("#budget_source_c").val() == ""){
              validate = false;
              $("#budget_source_c").css("background-color", "Red");
             }
              if($("#budget_head_c").val() == ""){
              validate = false;
              $("#budget_head_c").css("background-color", "Red");
             }
              if($("#budget_head_amount_c").val() == ""){
              validate = false;
              $("#budget_head_amount_c").css("background-color", "Red");
             }
              if($("#project_implementation_start_c").val() == ""){
              validate = false;
              $("#project_implementation_start_c").css("background-color", "Red");
             }
              if($("#project_implementation_end_c").val() == ""){
              validate = false;
              $("#project_implementation_end_c").css("background-color", "Red");
             }
              if($("#budget_allocated_oppertunity_c").val() == ""){
              validate = false;
              $("#budget_allocated_oppertunity_c").css("background-color", "Red");
             }
             
             if($("#segment_c").val() == ""){
              validate = false;
              $("#segment_c").css("background-color", "Red");
             }

                 if($("#product_service_c").val() == ""){
                     // console.log("ps");
              validate = false;
              $("#product_service_c").css("background-color", "Red");
             } 
             
               if($("#sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
              $("#sector_c").css("background-color", "Red");
             } 
             
               if($("#sub_sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
              $("#sub_sector_c").css("background-color", "Red");
             } 
             
               if($("#risk_c").val() == ""){
                     // console.log("ps");
              validate = false;
              $("#risk_c").css("background-color", "Red");
             } 
             
                  if($("#scope_budget_projected_c").val() == ""){
              validate = false;
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
             if($("#scope_budget_achieved_c").val() == ""){
              validate = false;
              $("#scope_budget_achieved_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_achieved_c").val() == ""){
              validate = false;
              $("#rfp_eoi_achieved_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_achieved_c").val() == ""){
              validate = false;
              $("#rfp_eoi_published_achieved_c").css("background-color", "Red");
             }
             
              if($("#work_order_achieved_c").val() == ""){
              validate = false;
              $("#work_order_achieved_c").css("background-color", "Red");
             }
             
             //  if($("#influencersl1_c").val() == ""){
             //  validate = false;
             //  $("#influencersl1_c").css("background-color", "Red");
             // }
             
              if($("#rfp_eoi_summary_c").val() == ""){
              validate = false;
              $("#rfp_eoi_summary_c").css("background-color", "Red");
             }
             
             if($("#project_scope_c").val() == ""){
              validate = false;
              $("#project_scope_c").css("background-color", "Red");
             }
             
             
             if(validate == false){
               alert("please fill the required fields"); 
             }
            
                if (validate && check_form(view)) {
                  return true;
                } else {
                  return false;
                }
              
            }
            
           }
           
           //adding asterisk to financial tab
           if ($("[data-label=LBL_BUDGET_SOURCE] span").text() == "") {
             $("[data-label=LBL_BUDGET_SOURCE]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
                if ($("[data-label=LBL_BUDGET_HEAD] span").text() == "") {
             $("[data-label=LBL_BUDGET_HEAD]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
                if ($("[data-label=LBL_BUDGET_HEAD_AMOUNT] span").text() == "") {
             $("[data-label=LBL_BUDGET_HEAD_AMOUNT]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
                if ($("[data-label=LBL_BUDGET_ALLOCATED_OPPERTUNITY] span").text() == "") {
             $("[data-label=LBL_BUDGET_ALLOCATED_OPPERTUNITY]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
                if ($("[data-label=LBL_PROJECT_IMPLEMENTATION_START] span").text() == "") {
             $("[data-label=LBL_PROJECT_IMPLEMENTATION_START]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
                if ($("[data-label=LBL_PROJECT_IMPLEMENTATION_END] span").text() == "") {
             $("[data-label=LBL_PROJECT_IMPLEMENTATION_END]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
                if ($("[data-label=LBL_FINANCIAL_FEASIBILITY_L2] span").text() == "") {
             $("[data-label=LBL_FINANCIAL_FEASIBILITY_L2]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
         // adding asterisk to scope
          if ($("[data-label=LBL_SELECTION] span").text() == "") {
             $("[data-label=LBL_SELECTION]").append(
              "<span style='color:red;'>*</span>"
              );
               } 
               
                if ($("[data-label=LBL_FUNDING] span").text() == "") {
             $("[data-label=LBL_FUNDING]").append(
              "<span style='color:red;'>*</span>"
              );
               } 
               
                if ($("[data-label=LBL_TIMING_BUTTON] span").text() == "") {
             $("[data-label=LBL_TIMING_BUTTON]").append(
              "<span style='color:red;'>*</span>"
              );
               } 
         
         // adding asterisk to influencer tab
         // if ($("[data-label=LBL_INFLUENCERSL1] span").text() == "") {
         //     $("[data-label=LBL_INFLUENCERSL1]").append(
         //      "<span style='color:red;'>*</span>"
         //      );
         //       }
               
           //adding asterisk to bid tab
           if ($("[data-label=LBL_RFP_EOI_SUMMARY] span").text() == "") {
             $("[data-label=LBL_RFP_EOI_SUMMARY]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               //adding asterisk to project scope
          if ($("[data-label=LBL_PROJECT_SCOPE] span").text() == "") {
             $("[data-label=LBL_PROJECT_SCOPE]").append(
              "<span style='color:red;'>*</span>"
              );
               }
        }
         
        break;
        
        case "QualifiedDpr":
         
        if($("#rfporeoipublished_c").val()=='no'){
         
         $("#applyfor_c").val('qualifyBid');
          $("#detailpanel_1").show() ;
         $("#detailpanel_2").show() ;
         $("#detailpanel_3").show() ;
         // $("#detailpanel_4").show() ;
         $("#detailpanel_5").show() ;
         $("#sector_c").attr("disabled",false);
         $("#sub_sector_c").attr("disabled",false);
         $("#budget_source_c").attr("disabled",false);
         $("#budget_head_c").attr("disabled",false);
         $("#budget_head_amount_c").attr("disabled",false);
         $("#project_implementation_start_c").attr("disabled",false);
         $("#project_implementation_end_c").attr("disabled",false);
         $("#budget_allocated_oppertunity_c").attr("disabled",false);
         $("#financial_feasibility_l2_c").attr("disabled",false);
         $("#financial_feasibility_l3_c").attr("disabled",false);
         $("#cash_flow_c").attr("disabled",false);
         $("#selection_c").attr("disabled",false);
         $("#funding_c").attr("disabled",false);
         $("#timing_button_c").attr("disabled",false);
         $("#risk_c").attr("disabled",false);
         // $("#influencersl2_c").attr("disabled",false);
         $("#bid_strategy_c").attr("disabled",false);
         $("#submissionstatus_c").attr("disabled",false);
         $("#bid_checklist_c").attr("disabled",false); 
         
          $("#financial_feasibility_l1_c").attr("disabled",false);
         
         
           custom_check_form = function (view/*,EditView*/) {
                    var validate = true;
   
          var form_validation = $("#rfporeoipublished_c").val();
          
          if(form_validation == "no"){
             
             if($("#name").val() == ""){
              validate = false;
              $("#name").css("background-color", "Red");
             }
             if($("#state_c").val() == ""){
              validate = false;
              $("#state_c").css("background-color", "Red");
             }
             if($("#account_name").val() == ""){
              validate = false;
              $("#account_name").css("background-color", "Red");
             }
             if($("#source_c").val() == ""){
              validate = false;
              $("#source_c").css("background-color", "Red");
             }
            
             
             if($("#non_financial_consideration_c").val() == ""){
              validate = false;
              $("#non_financial_consideration_c").css("background-color", "Red");
             }
                 if($("#budget_source_c").val() == ""){
              validate = false;
              $("#budget_source_c").css("background-color", "Red");
             }
              if($("#budget_head_c").val() == ""){
              validate = false;
              $("#budget_head_c").css("background-color", "Red");
             }
              if($("#budget_head_amount_c").val() == ""){
              validate = false;
              $("#budget_head_amount_c").css("background-color", "Red");
             }
              if($("#project_implementation_start_c").val() == ""){
              validate = false;
              $("#project_implementation_start_c").css("background-color", "Red");
             }
              if($("#project_implementation_end_c").val() == ""){
              validate = false;
              $("#project_implementation_end_c").css("background-color", "Red");
             }
              if($("#budget_allocated_oppertunity_c").val() == ""){
              validate = false;
              $("#budget_allocated_oppertunity_c").css("background-color", "Red");
             }
             
             if($("#segment_c").val() == ""){
              validate = false;
              $("#segment_c").css("background-color", "Red");
             }

                 if($("#product_service_c").val() == ""){
                      //console.log("ps");
              validate = false;
              $("#product_service_c").css("background-color", "Red");
             } 
             
               if($("#sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
              $("#sector_c").css("background-color", "Red");
             } 
             
               if($("#sub_sector_c").val() == ""){
                     // console.log("ps");
              validate = false;
              $("#sub_sector_c").css("background-color", "Red");
             } 
             
               if($("#risk_c").val() == ""){
                     // console.log("ps");
              validate = false;
              $("#risk_c").css("background-color", "Red");
             } 
             
                  if($("#scope_budget_projected_c").val() == ""){
              validate = false;
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
             if($("#scope_budget_achieved_c").val() == ""){
              validate = false;
              $("#scope_budget_achieved_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_achieved_c").val() == ""){
              validate = false;
              $("#rfp_eoi_achieved_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_achieved_c").val() == ""){
              validate = false;
              $("#rfp_eoi_published_achieved_c").css("background-color", "Red");
             }
             
              if($("#work_order_achieved_c").val() == ""){
              validate = false;
              $("#work_order_achieved_c").css("background-color", "Red");
             }
             
             //  if($("#influencersl1_c").val() == ""){
             //  validate = false;
             //  $("#influencersl1_c").css("background-color", "Red");
             // }
             
              if($("#rfp_eoi_summary_c").val() == ""){
              validate = false;
              $("#rfp_eoi_summary_c").css("background-color", "Red");
             }
             
                 if($("#project_scope_c").val() == ""){
              validate = false;
              $("#project_scope_c").css("background-color", "Red");
             }
             
             //  if($("#influencersl2_c").val() == ""){
             //  validate = false;
             //  $("#influencersl2_c").css("background-color", "Red");
             // }
              if($("#bid_strategy_c").val() == ""){
              validate = false;
              $("#bid_strategy_c").css("background-color", "Red");
             }
              if($("#submissionstatus_c").val() == ""){
              validate = false;
              $("#submissionstatus_c").css("background-color", "Red");
             }
             
             
             
             
             if(validate == false){
               alert("please fill the required fields"); 
             }
            
                if (validate && check_form(view)) {
                  return true;
                } else {
                  return false;
                }
              
            }
            
           }
           
         //adding asterisk to influencer tab
         // if ($("[data-label=LBL_INFLUENCERSL2] span").text() == "") {
         //     $("[data-label=LBL_INFLUENCERSL2]").append(
         //      "<span style='color:red;'>*</span>"
         //      );
         //       }
         
         //adding asterisk to bid tab
           if ($("[data-label=LBL_BID_STRATEGY] span").text() == "") {
             $("[data-label=LBL_BID_STRATEGY]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               if ($("[data-label=LBL_SUBMISSIONSTATUS] span").text() == "") {
             $("[data-label=LBL_SUBMISSIONSTATUS]").append(
              "<span style='color:red;'>*</span>"
              );
               }
         
        }
         
        
        break;
        
        case "QualifiedBid":
          if($("#rfporeoipublished_c").val()=='no'){
           
         $("#applyfor_c").val('closure');
          $("#detailpanel_1").show() ;
         $("#detailpanel_2").show() ;
          $("#detailpanel_3").show() ;
         // $("#detailpanel_4").show() ;
         $("#detailpanel_5").show() ;
         $("#detailpanel_6").show() ;
         $("#sector_c").attr("disabled",false);
         $("#sub_sector_c").attr("disabled",false);
         // $("#influencersl2_c").attr("disabled",false);
         $("#bid_strategy_c").attr("disabled",false);
         $("#submissionstatus_c").attr("disabled",false);
         $("#bid_checklist_c").attr("disabled",false); 
         $("#budget_source_c").attr("disabled",false);
         $("#budget_head_c").attr("disabled",false);
         $("#budget_head_amount_c").attr("disabled",false);
         $("#project_implementation_start_c").attr("disabled",false);
         $("#project_implementation_end_c").attr("disabled",false);
         $("#budget_allocated_oppertunity_c").attr("disabled",false);
         $("#financial_feasibility_l2_c").attr("disabled",false);
         $("#financial_feasibility_l3_c").attr("disabled",false);
         $("#cash_flow_c").attr("disabled",false);
         $("#selection_c").attr("disabled",false);
         $("#funding_c").attr("disabled",false);
         $("#timing_button_c").attr("disabled",false);
         $("#risk_c").attr("disabled",false);
         
          $("#financial_feasibility_l1_c").attr("disabled",false);
         
          custom_check_form = function (view/*,EditView*/) {
                    var validate = true;
   
          var form_validation = $("#rfporeoipublished_c").val();
          
          if(form_validation == "no"){
             
             if($("#name").val() == ""){
              validate = false;
              $("#name").css("background-color", "Red");
             }
             if($("#state_c").val() == ""){
              validate = false;
              $("#state_c").css("background-color", "Red");
             }
             if($("#account_name").val() == ""){
              validate = false;
              $("#account_name").css("background-color", "Red");
             }
             if($("#source_c").val() == ""){
              validate = false;
              $("#source_c").css("background-color", "Red");
             }
            
             
             if($("#non_financial_consideration_c").val() == ""){
              validate = false;
              $("#non_financial_consideration_c").css("background-color", "Red");
             }
                 if($("#budget_source_c").val() == ""){
              validate = false;
              $("#budget_source_c").css("background-color", "Red");
             }
              if($("#budget_head_c").val() == ""){
              validate = false;
              $("#budget_head_c").css("background-color", "Red");
             }
              if($("#budget_head_amount_c").val() == ""){
              validate = false;
              $("#budget_head_amount_c").css("background-color", "Red");
             }
              if($("#project_implementation_start_c").val() == ""){
              validate = false;
              $("#project_implementation_start_c").css("background-color", "Red");
             }
              if($("#project_implementation_end_c").val() == ""){
              validate = false;
              $("#project_implementation_end_c").css("background-color", "Red");
             }
              if($("#budget_allocated_oppertunity_c").val() == ""){
              validate = false;
              $("#budget_allocated_oppertunity_c").css("background-color", "Red");
             }
             
             if($("#segment_c").val() == ""){
              validate = false;
              $("#segment_c").css("background-color", "Red");
             }

                 if($("#product_service_c").val() == ""){
                     // console.log("ps");
              validate = false;
              $("#product_service_c").css("background-color", "Red");
             } 
             
               if($("#sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
              $("#sector_c").css("background-color", "Red");
             } 
             
               if($("#sub_sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
              $("#sub_sector_c").css("background-color", "Red");
             } 
             
               if($("#risk_c").val() == ""){
                     // console.log("ps");
              validate = false;
              $("#risk_c").css("background-color", "Red");
             } 
             
                  if($("#scope_budget_projected_c").val() == ""){
              validate = false;
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
             if($("#scope_budget_achieved_c").val() == ""){
              validate = false;
              $("#scope_budget_achieved_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_achieved_c").val() == ""){
              validate = false;
              $("#rfp_eoi_achieved_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_achieved_c").val() == ""){
              validate = false;
              $("#rfp_eoi_published_achieved_c").css("background-color", "Red");
             }
             
              if($("#work_order_achieved_c").val() == ""){
              validate = false;
              $("#work_order_achieved_c").css("background-color", "Red");
             }
             
             //  if($("#influencersl1_c").val() == ""){
             //  validate = false;
             //  $("#influencersl1_c").css("background-color", "Red");
             // }
             
              if($("#rfp_eoi_summary_c").val() == ""){
              validate = false;
              $("#rfp_eoi_summary_c").css("background-color", "Red");
             }
             
             
                 if($("#project_scope_c").val() == ""){
              validate = false;
              $("#project_scope_c").css("background-color", "Red");
             }
             
             //  if($("#influencersl2_c").val() == ""){
             //  validate = false;
             //  $("#influencersl2_c").css("background-color", "Red");
             // }
              if($("#bid_strategy_c").val() == ""){
              validate = false;
              $("#bid_strategy_c").css("background-color", "Red");
             }
              if($("#submissionstatus_c").val() == ""){
              validate = false;
              $("#submissionstatus_c").css("background-color", "Red");
             }
             
              if($("#learnings_c").val() == ""){
              validate = false;
              $("#learnings_c").css("background-color", "Red");
             }
             
              if($("#closure_status_c").val() == ""){
              validate = false;
              $("#closure_status_c").css("background-color", "Red");
             }
             
              if($("#comments_c").val() == ""){
              validate = false;
              $("#comments_c").css("background-color", "Red");
             }
             
             
             
             if(validate == false){
               alert("please fill the required fields"); 
             }
            
                if (validate && check_form(view)) {
                  return true;
                } else {
                  return false;
                }
              
            }
            
           }
        
        //adding asterisk to closure tab
         if ($("[data-label=LBL_CLOSURE_STATUS] span").text() == "") {
             $("[data-label=LBL_CLOSURE_STATUS]").append(
              "<span style='color:red;'>*</span>"
              );
               }
         
           if ($("[data-label=LBL_LEARNINGS] span").text() == "") {
             $("[data-label=LBL_LEARNINGS]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
              
        
        }
        
        break;
        
        case "Closed":
           
        $("#applyfor_c").val('');
        
        break;
        
      }
      
      
      
   });
    
 
 //............status change on conditon of YES .........................................
 
 $("#status_c").on("change", function () {
  
  var status = $('#status_c').val();
  
   switch(status){
    
    case "Lead":
        if($("#rfporeoipublished_c").val()=='yes'){
         $("#applyfor_c").val('qualifylead');
          $("#detailpanel_1").hide() ;
          $("#detailpanel_2").show() ;
          $("#sector_c").attr("disabled",true);
          $("#sub_sector_c").attr("disabled",true);
          $("#selection_c").attr("disabled",true);
          $("#funding_c").attr("disabled",true);
          $("#timing_button_c").attr("disabled",true);
          $("#risk_c").attr("disabled",true);
             }
   
          break;
          
    case "QualifiedLead" :
     if($("#rfporeoipublished_c").val()=='yes'){
       $("#applyfor_c").val('qualifyBid');
       
        //$("#status_c option[value='Lead']").remove();
       
          $("#detailpanel_1").show() ;
         $("#detailpanel_2").show() ;
         $("#detailpanel_3").show() ;
         // $("#detailpanel_4").show() ;
         $("#detailpanel_5").show() ;
         $("#sector_c").attr("disabled",false);
         $("#sub_sector_c").attr("disabled",false);
         $("#budget_source_c").attr("disabled",false);
         $("#budget_head_c").attr("disabled",false);
         $("#budget_head_amount_c").attr("disabled",false);
         $("#project_implementation_start_c").attr("disabled",false);
         $("#project_implementation_end_c").attr("disabled",false);
         $("#budget_allocated_oppertunity_c").attr("disabled",false);
         $("#financial_feasibility_l2_c").attr("disabled",false);
         $("#financial_feasibility_l3_c").attr("disabled",false);
         $("#cash_flow_c").attr("disabled",false);
         $("#selection_c").attr("disabled",false);
         $("#funding_c").attr("disabled",false);
         $("#timing_button_c").attr("disabled",false);
         $("#risk_c").attr("disabled",false);
         // $("#influencersl2_c").attr("disabled",false);
         $("#bid_strategy_c").attr("disabled",false);
         $("#submissionstatus_c").attr("disabled",false);
         $("#bid_checklist_c").attr("disabled",false); 
         
         if ($("[data-label=LBL_PROJECT_SCOPE] span").text() == "") {
             $("[data-label=LBL_PROJECT_SCOPE]").append(
              "<span style='color:red;'>*</span>"
              );
               }
           custom_check_form = function (view/*,EditView*/) {
                    var validate = true;
   
          var form_validation = $("#rfporeoipublished_c").val();
          
          if(form_validation == "yes"){
             
             if($("#name").val() == ""){
              validate = false;
              $("#name").css("background-color", "Red");
             }
             if($("#state_c").val() == ""){
              validate = false;
              $("#state_c").css("background-color", "Red");
             }
             if($("#account_name").val() == ""){
              validate = false;
              $("#account_name").css("background-color", "Red");
             }
             if($("#source_c").val() == ""){
              validate = false;
              $("#source_c").css("background-color", "Red");
             }
            
             
             if($("#non_financial_consideration_c").val() == ""){
              validate = false;
              $("#non_financial_consideration_c").css("background-color", "Red");
             }
                 if($("#budget_source_c").val() == ""){
              validate = false;
              $("#budget_source_c").css("background-color", "Red");
             }
              if($("#budget_head_c").val() == ""){
              validate = false;
              $("#budget_head_c").css("background-color", "Red");
             }
              if($("#budget_head_amount_c").val() == ""){
              validate = false;
              $("#budget_head_amount_c").css("background-color", "Red");
             }
              if($("#project_implementation_start_c").val() == ""){
              validate = false;
              $("#project_implementation_start_c").css("background-color", "Red");
             }
              if($("#project_implementation_end_c").val() == ""){
              validate = false;
              $("#project_implementation_end_c").css("background-color", "Red");
             }
              if($("#budget_allocated_oppertunity_c").val() == ""){
              validate = false;
              $("#budget_allocated_oppertunity_c").css("background-color", "Red");
             }
             
             if($("#segment_c").val() == ""){
              validate = false;
              $("#segment_c").css("background-color", "Red");
             }

                 if($("#product_service_c").val() == ""){
                      //console.log("ps");
              validate = false;
              $("#product_service_c").css("background-color", "Red");
             } 
             
               if($("#sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
              $("#sector_c").css("background-color", "Red");
             } 
             
               if($("#sub_sector_c").val() == ""){
                     // console.log("ps");
              validate = false;
              $("#sub_sector_c").css("background-color", "Red");
             } 
             
               if($("#risk_c").val() == ""){
                     // console.log("ps");
              validate = false;
              $("#risk_c").css("background-color", "Red");
             } 
             
                  if($("#scope_budget_projected_c").val() == ""){
              validate = false;
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
             if($("#scope_budget_achieved_c").val() == ""){
              validate = false;
              $("#scope_budget_achieved_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_achieved_c").val() == ""){
              validate = false;
              $("#rfp_eoi_achieved_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_achieved_c").val() == ""){
              validate = false;
              $("#rfp_eoi_published_achieved_c").css("background-color", "Red");
             }
             
              if($("#work_order_achieved_c").val() == ""){
              validate = false;
              $("#work_order_achieved_c").css("background-color", "Red");
             }
             
             //  if($("#influencersl1_c").val() == ""){
             //  validate = false;
             //  $("#influencersl1_c").css("background-color", "Red");
             // }
             
              if($("#rfp_eoi_summary_c").val() == ""){
              validate = false;
              $("#rfp_eoi_summary_c").css("background-color", "Red");
             }
             
             //  if($("#influencersl2_c").val() == ""){
             //  validate = false;
             //  $("#influencersl2_c").css("background-color", "Red");
             // }
              if($("#bid_strategy_c").val() == ""){
              validate = false;
              $("#bid_strategy_c").css("background-color", "Red");
             }
             //  if($("#submissionstatus_c").val() == ""){
             //  validate = false;
             //  $("#submissionstatus_c").css("background-color", "Red");
             // }
             
             if($("#project_scope_c").val() == ""){
              validate = false;
              $("#project_scope_c").css("background-color", "Red");
             }
             
             
             
             if(validate == false){
               alert("please fill the required fields"); 
             }
            
                if (validate && check_form(view)) {
                  return true;
                } else {
                  return false;
                }
              
            }
            
           }
           
         //adding asterisk to influencer tab
         // if ($("[data-label=LBL_INFLUENCERSL2] span").text() == "") {
         //     $("[data-label=LBL_INFLUENCERSL2]").append(
         //      "<span style='color:red;'>*</span>"
         //      );
         //       }
         
         //adding asterisk to bid tab
           if ($("[data-label=LBL_BID_STRATEGY] span").text() == "") {
             $("[data-label=LBL_BID_STRATEGY]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               if ($("[data-label=LBL_SUBMISSIONSTATUS] span").text() == "") {
             $("[data-label=LBL_SUBMISSIONSTATUS]").append(
              "<span style='color:red;'>*</span>"
              );
               }
     }
     
     break;
     
             case "QualifiedBid":
          if($("#rfporeoipublished_c").val()=='yes'){
           
         $("#applyfor_c").val('closure');
          $("#detailpanel_1").show() ;
         $("#detailpanel_2").show() ;
          $("#detailpanel_3").show() ;
         // $("#detailpanel_4").show() ;
         $("#detailpanel_5").show() ;
         $("#detailpanel_6").show() ;
         $("#sector_c").attr("disabled",false);
         $("#sub_sector_c").attr("disabled",false);
         // $("#influencersl2_c").attr("disabled",false);
         $("#bid_strategy_c").attr("disabled",false);
         $("#submissionstatus_c").attr("disabled",false);
         $("#bid_checklist_c").attr("disabled",false); 
         $("#budget_source_c").attr("disabled",false);
         $("#budget_head_c").attr("disabled",false);
         $("#budget_head_amount_c").attr("disabled",false);
         $("#project_implementation_start_c").attr("disabled",false);
         $("#project_implementation_end_c").attr("disabled",false);
         $("#budget_allocated_oppertunity_c").attr("disabled",false);
         $("#financial_feasibility_l2_c").attr("disabled",false);
         $("#financial_feasibility_l3_c").attr("disabled",false);
         $("#cash_flow_c").attr("disabled",false);
         $("#selection_c").attr("disabled",false);
         $("#funding_c").attr("disabled",false);
         $("#timing_button_c").attr("disabled",false);
         $("#risk_c").attr("disabled",false);
         
          custom_check_form = function (view/*,EditView*/) {
                    var validate = true;
   
          var form_validation = $("#rfporeoipublished_c").val();
          
          if(form_validation == "yes"){
             
             if($("#name").val() == ""){
              validate = false;
              $("#name").css("background-color", "Red");
             }
             if($("#state_c").val() == ""){
              validate = false;
              $("#state_c").css("background-color", "Red");
             }
             if($("#account_name").val() == ""){
              validate = false;
              $("#account_name").css("background-color", "Red");
             }
             if($("#source_c").val() == ""){
              validate = false;
              $("#source_c").css("background-color", "Red");
             }
            
             
             if($("#non_financial_consideration_c").val() == ""){
              validate = false;
              $("#non_financial_consideration_c").css("background-color", "Red");
             }
                 if($("#budget_source_c").val() == ""){
              validate = false;
              $("#budget_source_c").css("background-color", "Red");
             }
              if($("#budget_head_c").val() == ""){
              validate = false;
              $("#budget_head_c").css("background-color", "Red");
             }
              if($("#budget_head_amount_c").val() == ""){
              validate = false;
              $("#budget_head_amount_c").css("background-color", "Red");
             }
              if($("#project_implementation_start_c").val() == ""){
              validate = false;
              $("#project_implementation_start_c").css("background-color", "Red");
             }
              if($("#project_implementation_end_c").val() == ""){
              validate = false;
              $("#project_implementation_end_c").css("background-color", "Red");
             }
              if($("#budget_allocated_oppertunity_c").val() == ""){
              validate = false;
              $("#budget_allocated_oppertunity_c").css("background-color", "Red");
             }
             
             if($("#segment_c").val() == ""){
              validate = false;
              $("#segment_c").css("background-color", "Red");
             }

                 if($("#product_service_c").val() == ""){
                     // console.log("ps");
              validate = false;
              $("#product_service_c").css("background-color", "Red");
             } 
             
               if($("#sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
              $("#sector_c").css("background-color", "Red");
             } 
             
               if($("#sub_sector_c").val() == ""){
                      //console.log("ps");
              validate = false;
              $("#sub_sector_c").css("background-color", "Red");
             } 
             
             //   if($("#risk_c").val() == ""){
             //         // console.log("ps");
             //  validate = false;
             //  $("#risk_c").css("background-color", "Red");
             // } 
             
                  if($("#scope_budget_projected_c").val() == ""){
              validate = false;
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
             if($("#scope_budget_achieved_c").val() == ""){
              validate = false;
              $("#scope_budget_achieved_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_achieved_c").val() == ""){
              validate = false;
              $("#rfp_eoi_achieved_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_achieved_c").val() == ""){
              validate = false;
              $("#rfp_eoi_published_achieved_c").css("background-color", "Red");
             }
             
              if($("#work_order_achieved_c").val() == ""){
              validate = false;
              $("#work_order_achieved_c").css("background-color", "Red");
             }
             
             //  if($("#influencersl1_c").val() == ""){
             //  validate = false;
             //  $("#influencersl1_c").css("background-color", "Red");
             // }
             
              if($("#rfp_eoi_summary_c").val() == ""){
              validate = false;
              $("#rfp_eoi_summary_c").css("background-color", "Red");
             }
             
             //  if($("#influencersl2_c").val() == ""){
             //  validate = false;
             //  $("#influencersl2_c").css("background-color", "Red");
             // }
              if($("#bid_strategy_c").val() == ""){
              validate = false;
              $("#bid_strategy_c").css("background-color", "Red");
             }
             //  if($("#submissionstatus_c").val() == ""){
             //  validate = false;
             //  $("#submissionstatus_c").css("background-color", "Red");
             // }
             
              if($("#learnings_c").val() == ""){
              validate = false;
              $("#learnings_c").css("background-color", "Red");
             }
             
              if($("#closure_status_c").val() == ""){
              validate = false;
              $("#closure_status_c").css("background-color", "Red");
             }
             
             //  if($("#comments_c").val() == ""){
             //  validate = false;
             //  $("#comments_c").css("background-color", "Red");
             // }
             
             if($("#project_scope_c").val() == ""){
              validate = false;
              $("#project_scope_c").css("background-color", "Red");
             }
             
             if(validate == false){
               alert("please fill the required fields"); 
             }
            
                if (validate && check_form(view)) {
                  return true;
                } else {
                  return false;
                }
              
            }
            
           }
        
        //adding asterisk to closure tab
         if ($("[data-label=LBL_CLOSURE_STATUS] span").text() == "") {
             $("[data-label=LBL_CLOSURE_STATUS]").append(
              "<span style='color:red;'>*</span>"
              );
               }
         
           if ($("[data-label=LBL_LEARNINGS] span").text() == "") {
             $("[data-label=LBL_LEARNINGS]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
              
        
        }
        
        break;
   
   }
  
 })
 
    
    
    //for disabling date buttons
    $("#scope_budget_projected_c_trigger").hide();
    $("#rfp_eoi_projected_c_trigger").hide();
    $("#rfp_eoi_published_projected_c_trigger").hide();
    $("#work_order_projected_c_trigger").hide();
    $("#scope_budget_achieved_c_trigger").hide();
    $("#rfp_eoi_achieved_c_trigger").hide();
    $("#rfp_eoi_published_achieved_c_trigger").hide();
    $("#work_order_achieved_c_trigger").hide();
    $("#project_implementation_start_c_trigger").hide();
    $("#project_implementation_end_c_trigger").hide();
    
    
    var scope;
    //if user click the date field other than scope and budget projected date field
    
    $(()=>{
      $("#rfp_eoi_projected_c").click(()=>{
         scope = $("#scope_budget_projected_c").val();
      if(scope == "" ){
         $('#rfp_eoi_projected_c').attr('readonly',true).datepicker("option", "showOn", "off");
    alert("please first select DPR/Scope Budget accepted Projected date");
   
  }else{
      $('#rfp_eoi_projected_c').attr('readonly',true).datepicker("option", "showOn", "off");
  }
    });
   $("#rfp_eoi_published_projected_c").click(()=>{
         scope = $("#scope_budget_projected_c").val();
      if(scope == "" ){
    alert("please first select DPR/Scope Budget accepted Projected date");
    $('#rfp_eoi_published_projected_c').attr('readonly',true).datepicker("option", "showOn", "off");
  }else{
      $('#rfp_eoi_published_projected_c').attr('readonly',true).datepicker("option", "showOn", "off");
  }
    });
    
    $("#work_order_projected_c").click(()=>{
         scope = $("#scope_budget_projected_c").val();
      if(scope == "" ){
    alert("please first select DPR/Scope Budget accepted Projected date");
    $('#work_order_projected_c').attr('readonly',true).datepicker("option", "showOn", "off");
  }else{
      $('#work_order_projected_c').attr('readonly',true).datepicker("option", "showOn", "off");
  }
    });
    
    $("#scope_budget_achieved_c").click(()=>{
         scope = $("#scope_budget_projected_c").val();
      if(scope == "" ){
    alert("please first select DPR/Scope Budget accepted Projected date");
  }
    });
    
    $("#rfp_eoi_achieved_c").click(()=>{
         scope = $("#scope_budget_projected_c").val();
      if(scope == "" ){
    alert("please first select DPR/Scope Budget accepted Projected date");
  }
    });
    
    $("#rfp_eoi_published_achieved_c").click(()=>{
         scope = $("#scope_budget_projected_c").val();
      if(scope == "" ){
    alert("please first select DPR/Scope Budget accepted Projected date");
  }
    });
    
    $("#work_order_achieved_c").click(()=>{
         scope = $("#scope_budget_projected_c").val();
      if(scope == "" ){
    alert("please first select DPR/Scope Budget accepted Projected date");
  }
    });
    
    });
    
    
  
    
    
    // making date default values
    $(function(){
    $("#scope_budget_projected_c").datepicker({
    dateFormat : 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
    mindate:0,
    onSelect: function(selected) {
      $('#rfp_eoi_projected_c').css('background-color','#d8f5ee');
      $('#rfp_eoi_published_projected_c').css('background-color','#d8f5ee');
      $('#work_order_projected_c').css('background-color','#d8f5ee');
    //rfp initiated
   let drafting = $("#scope_budget_projected_c").datepicker('getDate');
   drafting.setMonth(drafting.getMonth()+1);
    $("#rfp_eoi_projected_c").datepicker('setDate',drafting);
    $('#rfp_eoi_projected_c').datepicker('option', 'minDate', drafting);

  
    
    // rfp published
    
    let published = $("#rfp_eoi_projected_c").datepicker('getDate');
    published.setMonth(published.getMonth()+1);
    $("#rfp_eoi_published_projected_c").datepicker('setDate',published);
    $('#rfp_eoi_published_projected_c').datepicker('option', 'minDate', published);
    
    //work projected
    let work = $("#rfp_eoi_published_projected_c").datepicker('getDate');
      work.setMonth(published.getMonth()+1);
      $("#work_order_projected_c").datepicker('setDate',work);
      $('#work_order_projected_c').datepicker('option', 'minDate', work);
       }
       
    
   
});


//scope-budget achieved
$("#scope_budget_achieved_c").datepicker({ 
    dateFormat : 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
    beforeShow: function() {
      let scope_achieved = $("#scope_budget_projected_c").datepicker('getDate');
      scope_achieved.setDate(scope_achieved.getDate());
        $("#scope_budget_achieved_c").datepicker("option","minDate", scope_achieved);
        
    }
});  

//rfp initiated projected


  $("#rfp_eoi_projected_c").datepicker({ 
    dateFormat : 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
    // onClose: function() {
      
    //     let date1 = $("#scope_budget_projected_c").datepicker('getDate');
    //   let date2 = $("#rfp_eoi_projected_c").datepicker('getDate');
      
    //   //check to prevent a user from entering a date below date of dt1
    //   if(date1 <= date2){
    //     let minDate = $('#rfp_eoi_projected_c').datepicker('option', 'minDate');
    //     $("#rfp_eoi_projected_c").datepicker('setDate', minDate)
    //   }
    //   }
      
       
    
});  

  
  



// rfp intiated achieved

    $("#rfp_eoi_achieved_c").datepicker({ 
    dateFormat : 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
     beforeShow:function() {
    let drafting_achieved = $("#rfp_eoi_projected_c").datepicker('getDate');
    drafting_achieved.setDate(drafting_achieved.getDate());
    $("#rfp_eoi_achieved_c").datepicker('option', 'minDate', drafting_achieved);
    
    }
});
  

//published 
$("#rfp_eoi_published_projected_c").datepicker({ 
    dateFormat : 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
    // onClose: function() {
    //   let date1 = $("#rfp_eoi_projected_c").datepicker('getDate');
    //   let date2 = $("#rfp_eoi_published_projected_c").datepicker('getDate');
      
    //   //check to prevent a user from entering a date below date of date1
    //   if(date1 <= date2){
    //     let minDate = $('#rfp_eoi_published_projected_c').datepicker('option', 'minDate');
    //     $("#rfp_eoi_published_projected_c").datepicker('setDate', minDate)
    //   }
       
    // }
});  

//publish achieved

    $("#rfp_eoi_published_achieved_c").datepicker({ 
    dateFormat : 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
     beforeShow:function() {
    let publish_achieved = $("#rfp_eoi_published_projected_c").datepicker('getDate');
    publish_achieved.setDate(publish_achieved.getDate());
    $("#rfp_eoi_published_achieved_c").datepicker('option', 'minDate', publish_achieved);
    
    }
});


//work projected

$("#work_order_projected_c").datepicker({ 
    dateFormat : 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
    // onClose: function() {
    //   let date1 = $("#rfp_eoi_published_projected_c").datepicker('getDate');
    //   let date2 = $("#work_order_projected_c").datepicker('getDate');
      
    //   //check to prevent a user from entering a date below date of date1
    //   if(date1 <= date2){
    //     let minDate = $('#work_order_projected_c').datepicker('option', 'minDate');
    //     $("#work_order_projected_c").datepicker('setDate', minDate)
    //   }
       
    // }
});  

// work achieved
 $("#work_order_achieved_c").datepicker({ 
    dateFormat : 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
     beforeShow:function() {
    let work_achieved = $("#work_order_projected_c").datepicker('getDate');
    work_achieved.setDate(work_achieved.getDate());
    $("#work_order_achieved_c").datepicker('option', 'minDate', work_achieved);
    
    }
});

$('#project_implementation_start_c').datepicker({
      dateFormat: 'dd/mm/yy',
      changeMonth: true,
      changeYear: true,
      // yearRange:  '1964:1991',
      // defaultDate: '01-01-1964'
      onSelect: function(selected) {
      $('#project_implementation_start_c').css('background-color','#d8f5ee');}
});

$('#project_implementation_end_c').datepicker({
      dateFormat: 'dd/mm/yy',
      changeMonth: true,
      changeYear: true,
      // yearRange:  '1964:1991',
      // defaultDate: '01-01-1964'
       onSelect: function(selected) {
      $('#project_implementation_end_c').css('background-color','#d8f5ee');}
});

});


//state list
var selected_state = $("#state_c").val();
$("#state_c").replaceWith('<select name="state_c" id="state_c"></select>');
  $.ajax({
    url : 'index.php?module=Opportunities&action=stateList',
        type : 'GET',
        success : function(data){
        // $("#state_c").append(data);
        if(selected_state == ""){
            var list = '<option value=""></option> +'; 
          }else{
                    var list = '<option value="'+selected_state+'">'+selected_state+'</option> +';
                }
         
             
         data=JSON.parse(data);
            data.forEach((state)=>{
                list+='<option value="'+state.name+'">'+state.name+'</option>';
              
            });
            $("#state_c").html(list);
        }
});

//first of a kind radio button


  $('#add_new_segment_c').attr("disabled",true);
  $('#add_new_product_service_c').attr("disabled",true);
  
  
$($('div[field="first_of_a_kind_segment_c"] input:radio')).on("click", function() {
 console.log(" in");
  let new_kind = $('input[name="first_of_a_kind_segment_c"]:checked').val();
  
  if(new_kind==2){
  
  $('#segment_c').attr("disabled",false);
  $('#add_new_segment_c').attr("disabled",true);
  $('#add_new_segment_c').replaceWith(`<input type="text" name="add_new_segment_c" id="add_new_segment_c" size="30" maxlength="255" value="" title="" disabled="disabled">`);
  // $('#first_kind_segment').remove();
  $('#first_of_a_kind_segment_c[type=radio][value="1"]').attr("disabled",false);
  
  // // for making default yes in product service
  // $('#product_service_c').attr("disabled",false);
  // $('#add_new_product_service_c').attr("disabled",true);
 // $('#add_new_product_service_c').replaceWith(`<input type="text" name="add_new_product_service_c" id="add_new_product_service_c" size="30" maxlength="255" value="" title="" disabled="disabled">`);
  $('#first_kind_product1').remove();
   //$('#first_kind_product').remove();
  $('#first_kind_segment').remove();
 // $('#first_of_a_kind_product_c[type=radio][value="1"]').attr("disabled",false);
  
}else{
  
  $('#segment_c').attr("disabled",true);
  $('#add_new_segment_c').attr("disabled",false);
  $('#add_new_segment_c').replaceWith(`<input type="text" name="add_new_segment_c" id="add_new_segment_c" size="30" maxlength="255" value="" title=""><input type="button" class="btn button" id="first_kind_segment" value="Add Segment"/ >`);
  $('#first_of_a_kind_segment_c[type=radio][value="1"]').attr("disabled",true);
  
  // // for making default yes in product service
  //  $('#product_service_c').attr("disabled",true);
  // $('#add_new_product_service_c').attr("disabled",false);
  // $('#add_new_product_service_c').replaceWith(`<input type="text" name="add_new_product_service_c" id="add_new_product_service_c" size="30" maxlength="255" value="" title="" ><input type="button" class="btn button" id="first_kind_product" value="Add  product"/ >`);
 
  // $('#first_of_a_kind_product_c[type=radio]').attr("disabled",true);
  
}
  

});



$($('div[field="first_of_a_kind_product_c"] input:radio')).on("click", function() {
 console.log("product");
  let new_kind = $('input[name="first_of_a_kind_product_c"]:checked').val();
  
  if(new_kind==2){
  
  $('#product_service_c').attr("disabled",false);
  $('#add_new_product_service_c').attr("disabled",true);
  $('#add_new_product_service_c').replaceWith(`<input type="text" name="add_new_product_service_c" id="add_new_product_service_c" size="30" maxlength="255" value="" title="" disabled="disabled">`);
  //$('#first_kind_product').remove();
  $('#first_kind_product1').remove();
  $('#first_of_a_kind_product_c[type=radio][value="1"]').attr("disabled",false);
  
  $('#first_of_a_kind_segment_c[type=radio]').attr("disabled",false);
  
}else{
  
  $('#product_service_c').attr("disabled",true);
  $('#add_new_product_service_c').attr("disabled",false);
  $('#add_new_product_service_c').replaceWith(`<input type="text" name="add_new_product_service_c" id="add_new_product_service_c" size="30" maxlength="255" value="" title="" ><input type="button" class="btn button" id="first_kind_product1" value="Add Product"/ >`);
  $('#first_of_a_kind_product_c[type=radio][value="1"]').attr("disabled",true);
   $('#first_of_a_kind_product_c[type=radio][value="2"]').attr("disabled",false);
   
   $('#first_of_a_kind_segment_c[type=radio]').attr("disabled",true);
}
  

});


// ............... storing new segment and new product ............................
$(document).on("click","#first_kind_segment",function() {
 console.log("first of kind");

 var segment = $('#add_new_segment_c').val();
  
    if(segment != "" ){
     
     
    $.ajax({
     url:
        "index.php?module=Opportunities&action=firstSegment",
      type: "POST",
     
      data: { segment:segment},
       success:function(data){
        console.log(data);
       alert (data);
        window.location.reload();
      }
      
    })
    
  
    
     
    }else{
      alert("Please enter Segment field");
    }
    
    
    
    
});


// ............... storing new segment and new product ............................


// ............... storing  new product ............................

// $(document).on("click","#first_kind_product",function() {
//  // console.log("first of kind");
//  var service = $('#add_new_product_service_c').val();
//  var segment = $('#add_new_segment_c').val();
  
//     if(service !="" && segment!=""){
     
     
//     $.ajax({
//      url:
//         "index.php?module=Opportunities&action=product",
//       type: "POST",
     
//       data: {service:service,segment:segment},
//       success:function(data){
//        console.log(data);
//        alert (data);
       
//         window.location.reload();
//       }
      
      
//     })
    
    
     
//     }else{
//       alert("please enter both fields");
//     }
    
    
// });


// ............... storing  new product ............................

 // ----- storing only product/service ------------------------

$(document).on("click","#first_kind_product1",function() {
 // console.log("first of kind");
 var service = $('#add_new_product_service_c').val();
 var segment = $('#segment_c').val();
  
    if(service !="" && segment!=""){
     
     
    $.ajax({
     url:
        "index.php?module=Opportunities&action=product",
      type: "POST",
     
      data: {service:service,segment:segment},
      success:function(data){
       console.log(data);
       alert (data);
        window.location.reload();
      }
      
      
    })
    
    
    }else if(segment ==""){
      alert("Please select Segment from dropdown");
    }else if(service ==""){
     alert("Please enter the new product/service");
    }
    
    
  // ----- storing only product/service ------------------------
  
});
  $("#selection_c").css('background-color','#2ecc71');
  $("#selection_c").on("click", function () {
              if ($(this).val()=='Red' ){
                  $(this).css('background-color','#de3b33');
              }else if($(this).val()=='Green'){
                $(this).css('background-color','#2ecc71');
              }else{
                $(this).css('background-color','#feca57');
              }
            });
  
  $("#funding_c").css('background-color','#2ecc71');
  $("#funding_c").on("click", function () {
              if ($(this).val()=='Red' ){
                  $(this).css('background-color','#de3b33');
              }else if($(this).val()=='Green'){
                $(this).css('background-color','#2ecc71');
              }else{
                $(this).css('background-color','#feca57');
              }
            });
   
  $("#timing_button_c").css('background-color','#2ecc71');         
  $("#timing_button_c").on("click", function () {
              if ($(this).val()=='Red' ){
                  $(this).css('background-color','#de3b33');
              }else if($(this).val()=='Green'){
                $(this).css('background-color','#2ecc71');
              }else{
                $(this).css('background-color','#feca57');
              }
            });
            
            
 //validating the oppertunity form while creating

  $("#rfporeoipublished_c").on("change", () => {
   custom_check_form = function (view/*,EditView*/) {
    var validate = true;
   
  var form_validation = $("#rfporeoipublished_c").val();


  if (form_validation == "yes") {
       
    
    
  
      
      
      
         if($("#name").val() == ""){
    validate = false;
    $("#name").css("background-color", "Red");
   }
   if($("#state_c").val() == ""){
    validate = false;
    $("#state_c").css("background-color", "Red");
   }
   if($("#account_name").val() == ""){
    validate = false;
    $("#account_name").css("background-color", "Red");
   }
   if($("#source_c").val() == ""){
    validate = false;
    $("#source_c").css("background-color", "Red");
   }
   if($("#product_service_c").val() == ""){
    validate = false;
    $("#product_service_c").css("background-color", "Red");
   }
   if($("#non_financial_consideration_c").val() == ""){
    validate = false;
    $("#non_financial_consideration_c").css("background-color", "Red");
   }
   
   if($("#account_name").val() == ""){
    validate = false;
    $("#account_name").css("background-color", "Red");
   }
   
     if($("#segment_c").val() == ""){
              validate = false;
              $("#segment_c").css("background-color", "Red");
             }

   if($("#product_service_c").val() == ""){
    //console.log("ps");
              validate = false;
              $("#product_service_c").css("background-color", "Red");
             } 
             
   if(validate == false){
     alert("please fill the required fields"); 
   }
  
      if (validate && check_form(view)) {
        return true;
      } else {
        return false;
      }
      
      
   
   
  }else if(form_validation == "no"){
   
   // if($("#financial_feasibility_l1_c").val() == ""){
   //  validate = false;
   //  $("#financial_feasibility_l1_c").css("background-color", "Red");
   // }
   if($("#name").val() == ""){
    validate = false;
    $("#name").css("background-color", "Red");
   }
   if($("#state_c").val() == ""){
    validate = false;
    $("#state_c").css("background-color", "Red");
   }
   if($("#account_name").val() == ""){
    validate = false;
    $("#account_name").css("background-color", "Red");
   }
   if($("#source_c").val() == ""){
    validate = false;
    $("#source_c").css("background-color", "Red");
   }
   if($("#product_service_c").val() == ""){
    validate = false;
    $("#product_service_c").css("background-color", "Red");
   }
   if($("#non_financial_consideration_c").val() == ""){
    validate = false;
    $("#non_financial_consideration_c").css("background-color", "Red");
   }
   
   if($("#account_name").val() == ""){
    validate = false;
    $("#account_name").css("background-color", "Red");
   }
   
     if($("#segment_c").val() == ""){
              validate = false;
              $("#segment_c").css("background-color", "Red");
             }

   if($("#product_service_c").val() == ""){
    //console.log("ps");
              validate = false;
              $("#product_service_c").css("background-color", "Red");
             } 
             
   if(validate == false){
     alert("please fill the required fields"); 
   }
  
      if (validate && check_form(view)) {
        return true;
      } else {
        return false;
      }
    
  }
  
   }
   
});

//validating opportunity form while in edit mode

   custom_check_form = function (view) {
    var validate = true;
   
  var form_validation = $("#rfporeoipublished_c").val();


  if (form_validation == "yes") {
       
    
    
    if(  $("#state_c").val() == ""){ 
        validate = false;
        $("#state_c").css("background-color", "Red");}
        
    if( $("#name").val() == ""){ 
        validate = false;
        $("#name").css("background-color", "Red"); }
        
     if( $("#sector_c").val() == ""){ 
        validate = false;
        $("#sector_c").css("background-color", "Red"); }   
        
      if( $("#sub_sector_c").val() == ""){ 
        validate = false;
        $("#sub_sector_c").css("background-color", "Red"); }   
        
        if( $("#sub_sector_c").val() == ""){ 
        validate = false;
        $("#sub_sector_cc").css("background-color", "Red"); }   
        
         if( $("#rfp_eoi_achieved_c").val() == ""){ 
        validate = false;
        $("#rfp_eoi_achieved_c").css("background-color", "Red"); } 
        
        if( $("#rfp_eoi_published_achieved_c").val() == ""){ 
        validate = false;
        $("#rfp_eoi_published_achieved_c").css("background-color", "Red"); }
        
          if( $("#budget_head_c").val() == ""){ 
        validate = false;
        $("#budget_head_c").css("background-color", "Red"); }
        
         if( $("#budget_source_c").val() == ""){ 
        validate = false;
        $("#budget_source_c").css("background-color", "Red"); }
        
         if( $("#scope_budget_achieved_c").val() == ""){ 
        validate = false;
        $("#scope_budget_achieved_c").css("background-color", "Red"); }
        
         if( $("#project_implementation_end_c").val() == ""){ 
        validate = false;
        $("#project_implementation_end_c").css("background-color", "Red"); }
        
        // if( $("#financial_feasibility_l2_c").val() == ""){ 
        // validate = false;
        // $("#financial_feasibility_l2_c").css("background-color", "Red"); }
        
         if( $("#work_order_achieved_c").val() == ""){ 
        validate = false;
        $("#work_order_achieved_c").css("background-color", "Red"); }
        
        if( $("#scope_budget_projected_c").val() == ""){ 
        validate = false;
        $("#scope_budget_projected_c").css("background-color", "Red"); }
        
        if( $("#rfp_eoi_projected_c").val() == ""){ 
        validate = false;
        $("#rfp_eoi_projected_c").css("background-color", "Red"); }
        
         if( $("#rfp_eoi_published_projected_c").val() == ""){ 
        validate = false;
        $("#rfp_eoi_published_projected_c").css("background-color", "Red"); }
        
         if( $("#work_order_projected_c").val() == ""){ 
        validate = false;
        $("#work_order_projected_c").css("background-color", "Red"); }
        
         if( $("#budget_source_c").val() == ""){ 
        validate = false;
        $("#budget_source_c").css("background-color", "Red"); }
        
        if( $("#budget_head_amount_c").val() == ""){ 
        validate = false;
        $("#budget_head_amount_c").css("background-color", "Red"); }
        
        if( $("#project_implementation_start_c").val() == ""){ 
        validate = false;
        $("#project_implementation_start_c").css("background-color", "Red"); }
        
        // if( $("#financial_feasibility_l1_c").val() == ""){ 
        // validate = false;
        // $("#financial_feasibility_l1_c").css("background-color", "Red"); }
        
        //  if( $("#financial_feasibility_l3_c").val() == ""){ 
        // validate = false;
        // $("#financial_feasibility_l3_c").css("background-color", "Red"); }
        
         if( $("#budget_allocated_oppertunity_c").val() == ""){ 
        validate = false;
        $("#budget_allocated_oppertunity_c").css("background-color", "Red"); }
        
        if( $("#source_c").val() == ""){ 
        validate = false;
        $("#source_c").css("background-color", "Red"); }
        
        if( $("#account_name").val() == ""){ 
        validate = false;
        $("#account_name").css("background-color", "Red"); }
        
        if( $("#non_financial_consideration_c").val() == ""){ 
        validate = false;
        $("#non_financial_consideration_c").css("background-color", "Red"); }
 
              if($("#segment_c").val() == ""){
              validate = false;
              $("#segment_c").css("background-color", "Red");
             }

   if($("#product_service_c").val() == ""){
   // console.log("ps");
              validate = false;
              $("#product_service_c").css("background-color", "Red");
             }  
 
      if(validate == false){
     alert("please fill the required fields"); 
   }
   
      if (validate && check_form(view)) {
        return true;
      } else {
        return false;
      }
      
      
   
   
  }else if(form_validation == "no"){
   
   // if($("#financial_feasibility_l1_c").val() == ""){
   //  validate = false;
   //  $("#financial_feasibility_l1_c").css("background-color", "Red");
   // }
   if($("#name").val() == ""){
    validate = false;
    $("#name").css("background-color", "Red");
   }
   if($("#state_c").val() == ""){
    validate = false;
    $("#state_c").css("background-color", "Red");
   }
   if($("#account_name").val() == ""){
    validate = false;
    $("#account_name").css("background-color", "Red");
   }
   if($("#source_c").val() == ""){
    validate = false;
    $("#source_c").css("background-color", "Red");
   }
   if($("#product_service_c").val() == ""){
    validate = false;
    $("#product_service_c").css("background-color", "Red");
   }
   if($("#non_financial_consideration_c").val() == ""){
    validate = false;
    $("#non_financial_consideration_c").css("background-color", "Red");
   }
   
   if($("#account_name").val() == ""){
    validate = false;
    $("#account_name").css("background-color", "Red");
   }
   
    if($("#segment_c").val() == ""){
              validate = false;
              $("#segment_c").css("background-color", "Red");
             }

   if($("#product_service_c").val() == ""){
              validate = false;
              $("#product_service_c").css("background-color", "Red");
             } 
   if(validate == false){
     alert("please fill the required fields"); 
   }
  
      if (validate && check_form(view)) {
        return true;
      } else {
        return false;
      }
    
  }
  
   }
   
 
 

//   //for changing the required background color red to normal


$("#project_implementation_end_c_trigger").on("click", function () {
  //console.log("if in");

  if ($("#project_implementation_end_c").css("background-color", "Red")) {
    // console.log("check in");

    $("#project_implementation_end_c").css("background-color", "#d8f5ee");
  }
});

$("#project_implementation_start_c_trigger").on("click", function () {
  if ($("#project_implementation_start_c").css("background-color", "Red")) {
    $("#project_implementation_start_c").css("background-color", "#d8f5ee");
  }
});

//for budget source field

$("#budget_source_c").on("click", function () {
  if ($("#budget_source_c").css("background-color", "Red")) {
    $("#budget_source_c").css("background-color", "#d8f5ee");
  }
});

$("#budget_head_c").on("click", function () {
  if ($("#budget_head_c").css("background-color", "Red")) {
    $("#budget_head_c").css("background-color", "#d8f5ee");
  }
});

$("#budget_head_amount_c").on("click", function () {
  if ($("#budget_head_amount_c").css("background-color", "Red")) {
    $("#budget_head_amount_c").css("background-color", "#d8f5ee");
  }
});

$("#budget_allocated_oppertunity_c").on("click", function () {
  if ($("#budget_allocated_oppertunity_c").css("background-color", "Red")) {
    $("#budget_allocated_oppertunity_c").css("background-color", "#d8f5ee");
  }
});

$("#sector_c").on("click", function () {
  if ($("#sector_c").css("background-color", "Red")) {
    $("#sector_c").css("background-color", "#d8f5ee");
  }
});

$("#scope_budget_projected_c").on("click", function () {
  if ($("#scope_budget_projected_c").css("background-color", "Red")) {
    $("#scope_budget_projected_c").css("background-color", "#d8f5ee");
  }
});

$("#scope_budget_achieved_c").on("click", function () {
  if ($("#scope_budget_achieved_c").css("background-color", "Red")) {
    $("#scope_budget_achieved_c").css("background-color", "#d8f5ee");
  }
});

$("#rfp_eoi_projected_c").on("click", function () {
  if ($("#rfp_eoi_projected_c").css("background-color", "Red")) {
    $("#rfp_eoi_projected_c").css("background-color", "#d8f5ee");
  }
});

$("#rfp_eoi_achieved_c").on("click", function () {
  if ($("#rfp_eoi_achieved_c").css("background-color", "Red")) {
    $("#rfp_eoi_achieved_c").css("background-color", "#d8f5ee");
  }
});

$("#rfp_eoi_published_projected_c").on("click", function () {
  if ($("#rfp_eoi_published_projected_c").css("background-color", "Red")) {
    $("#rfp_eoi_published_projected_c").css("background-color", "#d8f5ee");
  }
});

$("#rfp_eoi_published_achieved_c").on("click", function () {
  if ($("#rfp_eoi_published_achieved_c").css("background-color", "Red")) {
    $("#rfp_eoi_published_achieved_c").css("background-color", "#d8f5ee");
  }
});

$("#work_order_projected_c").on("click", function () {
  if ($("#work_order_projected_c").css("background-color", "Red")) {
    $("#work_order_projected_c").css("background-color", "#d8f5ee");
  }
});

$("#work_order_achieved_c").on("click", function () {
  if ($("#work_order_achieved_c").css("background-color", "Red")) {
    $("#work_order_achieved_c").css("background-color", "#d8f5ee");
  }
});

$("#name").on("click", function () {
  if ($("#name").css("background-color", "Red")) {
    $("#name").css("background-color", "#d8f5ee");
  }
});

$("#state_c").on("click", function () {
  if ($("#state_c").css("background-color", "Red")) {
    $("#state_c").css("background-color", "#d8f5ee");
  }
});

$("#btn_account_name").on("click", function () {
  if ($("#account_name").css("background-color", "Red")) {
    $("#account_name").css("background-color", "#d8f5ee");
  }
});

$("#source_c").on("click", function () {
  if ($("#source_c").css("background-color", "Red")) {
    $("#source_c").css("background-color", "#d8f5ee");
  }
});

$("#segment_c").on("click", function () {
  if ($("#segment_c").css("background-color", "Red")) {
    $("#segment_c").css("background-color", "#d8f5ee");
  }
});

$("#product_service_c").on("click", function () {
  if ($("#product_service_c").css("background-color", "Red")) {
    $("#product_service_c").css("background-color", "#d8f5ee");
  }
});

$("#non_financial_consideration_c").on("click", function () {
  if ($("#non_financial_consideration_c").css("background-color", "Red")) {
    $("#non_financial_consideration_c").css("background-color", "#d8f5ee");
  }
});

// $("#influencersl1_c,#btn_influencersl1_c").on("click", function () {
//   if ($("#influencersl1_c").css("background-color", "Red")) {
//     $("#influencersl1_c").css("background-color", "#d8f5ee");
//   }
// });

// $("#influencersl2_c,#btn_influencersl2_c").on("click", function () {
//   if ($("#influencersl2_c").css("background-color", "Red")) {
//     $("#influencersl2_c").css("background-color", "#d8f5ee");
//   }
// });

$("#rfp_eoi_summary_c").on("click", function () {
  if ($("#rfp_eoi_summary_c").css("background-color", "Red")) {
    $("#rfp_eoi_summary_c").css("background-color", "#d8f5ee");
  }
});

$("#bid_strategy_c").on("click", function () {
  if ($("#bid_strategy_c").css("background-color", "Red")) {
    $("#bid_strategy_c").css("background-color", "#d8f5ee");
  }
});

$("#submissionstatus_c").on("click", function () {
  if ($("#submissionstatus_c").css("background-color", "Red")) {
    $("#submissionstatus_c").css("background-color", "#d8f5ee");
  }
});

$("#closure_status_c").on("click", function () {
  if ($("#closure_status_c").css("background-color", "Red")) {
    $("#closure_status_c").css("background-color", "#d8f5ee");
  }
});

$("#learnings_c").on("click", function () {
  if ($("#learnings_c").css("background-color", "Red")) {
    $("#learnings_c").css("background-color", "#d8f5ee");
  }
});

$("#comments_c").on("click", function () {
  if ($("#comments_c").css("background-color", "Red")) {
    $("#comments_c").css("background-color", "#d8f5ee");
  }
});

$("#risk_c").on("click", function () {
  if ($("#risk_c").css("background-color", "Red")) {
    $("#risk_c").css("background-color", "#d8f5ee");
  }
});

$("#project_scope_c").on("click", function () {
  if ($("#project_scope_c").css("background-color", "Red")) {
    $("#project_scope_c").css("background-color", "#d8f5ee");
  }
});

// $("#influencersl1_c,#btn_clr_influencersl1_c").on("click", function () {
//   if ($("#risk_c").css("background-color", "Red")) {
//     $("#risk_c").css("background-color", "#d8f5ee");
//   }
// });

//---------------------------Reset Button for Cash flow------------------------

$('#reset').click(function () {
 
  $('#first_form').attr('disabled',false);
   
 
 if (confirm('Are you sure to reset?')) {
   console.log('asdas');
   $( "#total_value").html(' <thead><tr id="header"><th name="1"><b>Year</b></th> <th>Selected  Years</th>  </tr></thead><tbody><tr id="tot_values"><td  name="2" style="min-width: 125px"><center><b>Project Value in Rs</b></center></th><td><input class="row_add col_add"  required name="" type="number"/></td> </tr></tbody>');
                          
                         
                
                      
   var text = `<thead>
        <tr style="text-align: center;">
            <th></th>
            <th class="ExportLabelTD">S No</th>
            <th>Stage</th>
            <th>Milestones</th>
            <th>Type of Expenditure</th>
            <th>Quarter</th>
        </tr>
      </thead>
      <tbody>
        <tr id="cash_flow" >
          <td class="ExportLabelTD"></td>
          <td class="ExportLabelTD">
              1
          </td>
          <td >
              Pre-Tender
          </td>
          <td >
              Tender Publishing
          </td>
          <td >
              Expense
          </td>
          <td>
            <input class="row_add col_add" required name="" type="number"/>
          </td>
        </tr>
        <tr class="addition" id='two'>
          <td class="ExportLabelTD"></td>
          <td class="ExportLabelTD">
              2
          </td>
          <td >
              Post-Tender
          </td>
          <td >
              Tender Fee per Bidder
          </td>
          <td >
              Expense
          </td>
          <td>
            <input class="row_add col_add" id="tender1" required name="TenderFee" type="number"/>
          </td>
        </tr>
        <tr class="addition" id="three">
          <td class="ExportLabelTD"></td>
          <td class="ExportLabelTD">
              3
          </td>
          <td >
              Post-Tender
          </td>
          <td >
              EMD
          </td>
          <td >
              Returnable
          </td>
          <td>
            <input class="row_add col_add" required name="EMD" type="number"/>
          </td>
        </tr>
        <tr class="addition" id="four">
          <td class="ExportLabelTD"></td>
          <td class="ExportLabelTD">
              4
          </td>
          <td >
              Agreement Stage
          </td>
          <td >
              Work Order Receipt (PBG)
          </td>
          <td >
              Returnable
          </td>
          <td>
            <input class="row_add col_add"  required name="" type="number"/>
          </td>
        </tr>
        <tr class="addition" id="five">
          <td class="ExportLabelTD"></td>
          <td class="ExportLabelTD">
              5
          </td>
          <td >
              Agreement Stage
          </td>
          <td >
              Agreement Signing
          </td>
          <td >
                --
          </td>
          <td>
            <input class="row_add col_add" required name="" type="number"/>
          </td>
        </tr>
        <tr class="addition" id="six">
          <td class="ExportLabelTD"></td>
          <td class="ExportLabelTD">
              6
          </td>
          <td >
              Project GO-Live
          </td>
          <td class="Col3">
              Marketing Expenses
          </td>
          <td >
              Expense
          </td>
          <td>
            <input class="row_add col_add"  required name="" type="number"/>
          </td>
        </tr>
        <tr class="addition" id="seven">
          <td class="ExportLabelTD"></td>
          <td class="ExportLabelTD">
              7
          </td>
          <td >
              Project GO-Live
          </td>
          <td >
              Capex Procurement
          </td>
          <td >
              Expense
          </td>
          <td>
            <input class="row_add col_add" required name="" type="number"/>
          </td>
        </tr>
        <tr class="addition" id="eight">
          <td class="ExportLabelTD"></td>
          <td class="ExportLabelTD">
              8
          </td>
          <td >
              Project GO-Live
          </td>
          <td >
              Capex Reimbursement from NMMC
          </td>
          <td >
              Income
          </td>
          <td>
            <input class="row_add col_add" required name="" type="number"/>
          </td>
        </tr>
        <tr class="addition" id="nine">
          <td class="ExportLabelTD"></td>
          <td class="ExportLabelTD">
              9
          </td>
          <td >
              Project GO-Live
          </td>
          <td >
              Opex Expenses
          </td>
          <td >
              Expense
          </td>
          <td>
            <input class="row_add col_add" required name="" type="number"/>
          </td>
        </tr>
        <tr class="addition" id="10">
          <td class="ExportLabelTD"></td>
          <td class="ExportLabelTD">
              10
          </td>
          <td >
              Project GO-Live
          </td>
          <td >
              Quarterly Opex Receipt
          </td>
          <td >
              Income
          </td>
          <td>
            <input  class="row_add col_add" required name="" type="number"/>
          </td>
        </tr>
     
         </tbody>
         
        <tfoot>
        <tr id="tot">
          <td class="ExportLabelTD"></td>
          <td >
              
          </td>
          <td >
              
          </td>
          <td >
              Total
          </td>
          <td >
             
          </td>
          <td>
            <input class="total"  required name="" type="text" readonly/>
          </td>
        </tr>
        <tr id="cum">
          <td class="ExportLabelTD"></td>
          <td class="tdWidth" >
              
          </td>
          <td class="tdWidth">
              
          </td>
          <td class="tdWidth" >
              Cumulative
          </td>
          <td >
             
          </td>
          <td class="tdWidth">
            <input  required name="" type="text" readonly/>
          </td>
        </tr>
        
     </tfoot>`;
   $('#mtenth').html(text);
 }
});
//---------------------------Reset Button for Cash flow------------------------

//-----------saving l1 and l2 template on Main opportunity save button-------------------

$(document).on('click','#SAVE_HEADER',function() {
 
 
   
    var status=$('#status_c').val();
    
    if (status=="QualifiedLead") {
        
      //  alert ("main save 1");
         $('#save1').trigger('click');
    }
    
     if ( status=="Qualified" || status=="QualifiedDpr" || status=="QualifiedBid") {
        
      //  alert ("main save 2");
         $('#save2').trigger('click');
    }
        
    
    
  
});



//-----------saving l1 and l2 template on Main opportunity save button----END---------------




/**************************************Don't delete anything after this line **************************************************************/
});
