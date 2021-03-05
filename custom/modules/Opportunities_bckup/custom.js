

$(document).ready(function () {
 


 $(".add_field_button").attr("class",'add_field_button add_btn button');
 //-------------------hiding navigation----
  $(".opp_hide").hide();
  
  
  
  $("[data-label=LBL_TAGGED_HIDEN],[data-label=LBL_UNTAGGED_HIDDEN],#tagged_hiden_c,#untagged_hidden_c,[field=assigned_user_name],[data-label=LBL_ASSIGNED_TO_NAME]").hide();
  
  $( ".label:contains('Bid Files:'),.downloadAttachment,.remove_attachment,.multiple_file,#add_button" ).hide();
  
 //---------------------expected cash inflow Date -----------------------------------------------
 
 $("#expected_inflow_c_trigger").hide();
  $("#expected_inflow_c").attr("readonly",true).datepicker({
        dateFormat: 'dd/mm/yy',
        changeYear: true,
        changeMonth: true,
        onSelect: function(){
           
            
        }
    });
    
    
    //--------showing only when the closure status won -- onload----------------------------------
    
    
   
     
     let closure_status = $("#closure_status_c").val();
     
     if(closure_status == 'won'){
      $("[data-label=LBL_EXPECTED_INFLOW]").show();
      $("#expected_inflow_c").show();
     }
     
     if(closure_status == 'lost'){
      $("[data-label=LBL_EXPECTED_INFLOW]").hide();
      $("#expected_inflow_c").hide();
     }
     
     if(closure_status == 'reinitiate'){
      $("[data-label=LBL_EXPECTED_INFLOW]").hide();
      $("#expected_inflow_c").hide();
     }
     
   
    
   //--------showing only when the closure status won -- onload-----END-----------------------------
    
    //--------showing only when the closure status won -- onchange----------------------------------
    
    
    $("#closure_status_c").on("change",function(){
     
     let closure_status = $("#closure_status_c").val();
     
     switch (closure_status) {
      case 'won':
       $("[data-label=LBL_EXPECTED_INFLOW]").show();
       $("#expected_inflow_c").show();
       break;
       
       case 'lost':
        $("[data-label=LBL_EXPECTED_INFLOW]").hide();
        $("#expected_inflow_c").hide();
        break;
        
       case 'reinitiate':
        $("[data-label=LBL_EXPECTED_INFLOW]").hide();
        $("#expected_inflow_c").hide();
        break;
      
      default:
       // code
     }
     
    })
    
   //--------showing only when the closure status won -- onchange-----END-----------------------------
 
 //---------------------expected cash inflow Date -----END------------------------------------------
  
//------------------------------------------------------------Global and non global----------------------------------------------------------  
  
 $('#opportunity_type').on('change', function(e) {
  // Does some stuff and logs the event to the console
  if($("#opportunity_type").val()=="global"){
   
    $("[data-label=LBL_UNTAGGED_USERS]").hide();
    $("[field=untagged_users_c]").hide();
    $("[data-label=LBL_TAGGED_USERS]").show();
    $("[field=tagged_users_c]").show();
    
   }
   else  {
    
   $("[data-label=LBL_UNTAGGED_USERS]").hide();
    $("[field=untagged_users_c]").hide();
    $("[data-label=LBL_TAGGED_USERS]").show();
    $("[field=tagged_users_c]").show();
    
    
   }
});

if($("#opportunity_type").val()=="global"){
    $("[data-label=LBL_UNTAGGED_USERS]").hide();
    $("[field=untagged_users_c]").hide();
    $("[data-label=LBL_TAGGED_USERS]").show();
    $("[field=tagged_users_c]").show();
    
   }
   else  {
    
    $("[data-label=LBL_UNTAGGED_USERS]").hide();
    $("[field=untagged_users_c]").hide();
    $("[data-label=LBL_TAGGED_USERS]").show();
    $("[field=tagged_users_c]").show();
   }
  
 //------------------------------------------------------------Global and non global-----------END----------------------------------------------- 
  
 
 
  
 //---------------------------------------Multiple Approver--------------------------------------
 
 

 var opps_id = $('[name=record]').val();
 
 $("#btn_select_approver_c").hide();
 $("#select_approver_c").attr("disabled",true);
 $('#multiple_approver_c').hide();
 $("[data-label=LBL_MULTIPLE_APPROVER_C]").hide();
 
 //------------------ aprover default selection  --------------------------
 
   var assigned_name = $("#assigned_user_name").val();
   var assigned_id = $("#assigned_user_id").val();
  
    var s=$('#status_c').val();
    var r=$('#rfporeoipublished_c').val(); 
    
    $.ajax({
                url : 'index.php?module=Opportunities&action=fetch_reporting_manager',
                type : 'POST',
                dataType: "json",
                 data:{
                  opps_id,
                 assigned_name,
                 assigned_id,
                 s,
                 r
                },
                success : function(data_approver){
                 
                  
               // data=JSON.parse(data_approver);
                
                
                 $("#select_approver_c").val(data_approver.reporting_name);
                 $("#user_id2_c").val(data_approver.reporting_id);
                $('#multiple_approver_c').val(data_approver.reporting_id);
                
                      if(r=="no")  {
               
                if (s=="Qualified"||s=="QualifiedDpr"){
                  
                  
                   
                     $("#select_approver_c").val(data_approver.approvers_name);
                // $("#user_id2_c").val(data.reporting_id);
                $('#multiple_approver_c').val(data_approver.approvers_id);
                  
        
                }
                
                 }
                 
                    else  if(r=="not_required"){
                     
                  if (s=="Qualified"){
                  
                        $("#select_approver_c").val(data_approver.approvers_name);
                // $("#user_id2_c").val(data.reporting_id);
                $('#multiple_approver_c').val(data_approver.approvers_id);
                  
                 
                 
                 }
                  
                    }
                    
                       else  if(r=="yes")  {
               
                if (s=="QualifiedLead"){
                 
                   $("#select_approver_c").val(data_approver.approvers_name);
                // $("#user_id2_c").val(data.reporting_id);
                $('#multiple_approver_c').val(data_approver.approvers_id);
                  }
                }
                
               } 
            });
 
 
 
 
 
 if(opps_id ==""){
                          $('#detailpanel_6').hide();
                          $( ".panel-heading:contains('Tag And Untag Users')").hide();

           
 } 
            
 if(opps_id !=""){
     $( ".panel-heading:contains('Tag And Untag Users')").show();
  
  
            
 //--------------------------------------tagged and untagged user list-----------------------------------           
            
            
            
             $.ajax({
                url : 'index.php?module=Opportunities&action=untagged_users_list',
                type : 'POST',
                dataType: "json",
                data:{
                 opps_id
                },
                 
                success : function(data){
                 
                    $("#untagged_users_c").attr("disabled",false);
                    $('[field=untagged_users_c]').html('<div class="demo1"><select id="untagged_users_c"  name="" multiple ></select></div>');
                    
                     var  data1 ="";
   
                      if(data.status == true){
                        var i;
                        var text = '';
                        if(opps_id != "" ){
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
                            
                            
                        }
                        
                                                           
                        //
                        
                        // $("#select_approver_c").append(text1);
                         $("#untagged_users_c").append(text);
                         
                        $('.demo1').dropdown({});
                        
                      }
                 
                }
              
             });
            
             
             
                   $.ajax({
                url : 'index.php?module=Opportunities&action=tagged_users_list',
                type : 'POST',
                dataType: "json",
                data:{
                 opps_id
                },
                 
                success : function(data){
                 
                    $("#tagged_users_c").attr("disabled",false);
                    $('[field=tagged_users_c]').html('<div class="demo2"><select id="tagged_users_c"  name="" multiple ></select></div>');
                    
                                        var  data1 ="";
   
                      if(data.status == true){
                        var i;
                        var text = '';
                        if(opps_id != "" ){
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
                            
                            
                        }
                        
                                                           
                        //
                        
                        // $("#select_approver_c").append(text1);
                         $("#tagged_users_c").append(text);
                         
                        $('.demo2').dropdown({});
                        
                      }
                 
                }
              
             });
  //--------------------------------------tagged and untagged user list-----------------------------------       
  
 } 

//------------------ aprover default selection  -----END---------------------

 //---------------------------------------Multiple Approver------------END--------------------------
 
 //-----------------------------------------------------------------------------------------------
$('#selection_c').find('option').css('background-color','white');
$('#funding_c').find('option').css('background-color','white');
$('#timing_button_c').find('option').css('background-color','white');


 $("#close_bid").on("click",function(){
  $("#bidChecklistForm").css("display","none");
 })
 
 //-----------------------------------------------fetch l1 and l2 and quarters------------------------------------
 var decodeHTML = function (html) {
  	var txt = document.createElement('textarea');
  	txt.innerHTML = html;
  	return txt.value;
  };
 
 var id=$('#EditView input[name=record]').val();
 // alert(id);
 
//   $.ajax({
//         url : 'index.php?module=Opportunities&action=fetch_l1',
//         type : 'POST',
//         dataType: "json",
//           data :
//             {
//                 id,
                
//             },
//             success: function (return_data) {
                
//                 if(return_data.status == true ){
//                     //console.log('in');
//                      if (return_data.total_input_value!='') {
                       


//                       $('#total_input_value').val(return_data.total_input_value);
                       
                       
//                   }
//         //   if(return_data.l1_html != ''&& return_data.l1_input!=""){
              
             
//         //       var l1HTML_decoded = decodeHTML(return_data.l1_html);
//         //       //var l1INPUT_decoded = decodeHTML(return_data.l1_input);
//         //       $('#total_value').html(l1HTML_decoded);
//         //       $('#total_value input').each(function(index) {
//         //           $(this).val(decodeHTML(return_data.l1_input[index]));
//         //         });
              
//         //          }
//                 }
                
//             }
//   });
 
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
              // alert(total);
                 if(start_year!=''&& start_quarter !=''&& end_quarter!=''&& end_year !=''){
                  
                   $('#total_input_value').val(total);
                     
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
                         
                         
                          var starty = $('#startYear').val();
                          
                         var endy = $('#endYear').val();
                         var startq =$('#start_quarter').val();
                          var endq = $('#end_quarter').val();
                          // var total = $('#total_input_value').val();
                   
                   //alert(starty+" "+startq+" "+endy+" "+endq+""+total)
                   
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
                
                if($('#status_c').val()=="Qualified" && ($('#rfporeoipublished_c').val()=='no' || $('#rfporeoipublished_c').val()=='not_required')){
               
              if(return_data.status == false ){
               
               setTimeout(function() {
                //alert('l2');
      $('#first_form').trigger('click');
 }, 100);
             
               
              
             }
                }
                
             //     if($('#status_c').val()=="QualifiedLead" && $('#rfporeoipublished_c').val()=='yes'){
             //        if(return_data.status == false ){
             
             //   // $('#first_form').trigger('click');
              
             // }
             //     }
                
              
            }
  });
  
  
  
  
 
     
     
                          
                         $('#total_input_value').on('blur',function(event) {


                                        // skip for arrow keys
                                        if(event.which >= 37 && event.which <= 40) return;
                                        
                                       
                                        // format number
                                        $(this).val(function(index, value) {
                                         
                                         
                                          
                                         
                                          return value
                                           .replace( /[\- a-z A-Z]*$/g, "")
                                          .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                                          
                                          ;
                                          
                                        });
                                          
                                      });
                                      
                 
                                      
                  
     
     $(document).on('click','#close1',function(){
     
     document.getElementById("myForm").style.display = "none";
     
     //----for l1 and l2 audit trai--------------------------------------------------
            var start_year=$('#startYear').val();
            var end_year=$('#endYear').val();
            var start_quarter=$('#start_quarter').val();
            var end_quarter=$('#end_quarter').val();
            var no_of_bidders=$('#bid').val();
            var total_input_value=$('#total_input_value').val();
             var l2_html;
             var l2_input=[];
              var id = $('[name=record]').val();
              $('#mtenth input').each(function() {
                  l2_input.push($(this).val());
                   });
                 l2_html=$('#mtenth').html();
            $.ajax({
                url : 'index.php?module=Opportunities&action=l1_l2_audit_trail',
                type : 'POST',
                dataType: "json",
                 data :
                    {
                      start_year,
                      end_year,
                      start_quarter,
                      end_quarter,
                      no_of_bidders,
                      total_input_value,
                      l2_input,
                      l2_html,
                      id
                    },
                success : function(data){
                 
                //alert(data);
                 console.log(data);
               
                    var start_year=$('#startYear').val();
                    var end_year=$('#endYear').val();
                    var start_quarter=$('#start_quarter').val();
                    var end_quarter=$('#end_quarter').val();
                    var no_of_bidders=$('#bid').val();
                   
                    
                   
                   
                    
                    if(start_year!=''&& start_quarter !=''&& end_quarter!=''&& end_year !=''){
                      
                      // alert(start_year,start_quarter,end_year,end_quarter,no_of_bidders);
                      var id=$('#EditView input[name=record]').val();
                   
                      $.ajax({
                        url : 'index.php?module=Opportunities&action=year_quarters',
                        type : 'POST',
                          data :
                            {
                                id,
                                start_year,
                                end_year,
                                start_quarter,
                                 end_quarter,
                                 no_of_bidders,
                                 total_input_value
                            },
                            success: function (data) {
                                
                                
                            }
                  });
                  
                    }
 
                
                 
                }
            });
  
  //------------------for l1 and l2 audit trail----------END---------------------------------------- 
  
     
     
     
     
          var id=$('#EditView input[name=record]').val();
 var total_input_value=$('#total_input_value').val();
      var l1_html;
      var l1_input=[];
      $('#total_value input').each(function() {
        l1_input.push($(this).val());
      });
      l1_html=$('#total_value').html();
    //   console.log(l1_html,l1_input);
//       $.ajax({
//         url : 'index.php?module=Opportunities&action=l1',
//         type : 'POST',
//         dataType: "json",
//           data :
//             {
//                 id,
//                 l1_html,
//                 l1_input,
//                 total_input_value
//             },
//             success: function (data) {
                
//               // alert(data.message);
//               // $("#myForm").css("display","none");
                
//                 // console.log(data.message);
//             }
//   });
         
       var starty = $('#startYear').val();
       var endy = $('#endYear').val();
    var startq =$('#start_quarter').val();
     var endq = $('#end_quarter').val();
     var total = $('#total_input_value').val();
     
     
     
     if( starty!='' &&  endy!='' && startq!='' && endq!='' && total!='' ){
      
    
      $('#financial_feasibility_l1_c').css("background","#2ecc71")
      
      $('#financial_feasibility_l1_c').text("View L1 Details");
     }
     else{
       $('#financial_feasibility_l1_c').css("background","#f08377")
      
      $('#financial_feasibility_l1_c').text("Add L1 Details");
     }
      
     });
     
     $(document).on('click', '#close2', function(){
      
      
      
      
         //----for l1 and l2 audit trai--------------------------------------------------
            var start_year=$('#startYear').val();
            var end_year=$('#endYear').val();
            var start_quarter=$('#start_quarter').val();
            var end_quarter=$('#end_quarter').val();
            var no_of_bidders=$('#bid').val();
            var total_input_value=$('#total_input_value').val();
             var l2_html;
             var l2_input=[];
             var close="l2";
              var id = $('[name=record]').val();
              $('#mtenth input').each(function() {
                  l2_input.push($(this).val());
                   });
                 l2_html=$('#mtenth').html();
            $.ajax({
                url : 'index.php?module=Opportunities&action=l1_l2_audit_trail',
                type : 'POST',
                dataType: "json",
                 data :
                    {
                      start_year,
                      end_year,
                      start_quarter,
                      end_quarter,
                      no_of_bidders,
                      total_input_value,
                      l2_input,
                      l2_html,
                      id,
                      close
                    },
                success : function(data){
                 
                console.log(data);
                 
               
                    var start_year=$('#startYear').val();
                    var end_year=$('#endYear').val();
                    var start_quarter=$('#start_quarter').val();
                    var end_quarter=$('#end_quarter').val();
                    var no_of_bidders=$('#bid').val();
                   
                    
                      var total_input_value=$('#total_input_value').val();
                   
                    
                    if(start_year!=''&& start_quarter !=''&& end_quarter!=''&& end_year !=''){
                      
                      // alert(start_year,start_quarter,end_year,end_quarter,no_of_bidders);
                      var id=$('#EditView input[name=record]').val();
                   
                      $.ajax({
                        url : 'index.php?module=Opportunities&action=year_quarters',
                        type : 'POST',
                          data :
                            {
                                id,
                                start_year,
                                end_year,
                                start_quarter,
                                 end_quarter,
                                 no_of_bidders,
                                 total_input_value
                            },
                            success: function (data) {
                                
                                
                            }
                  });
                  
                    }
                    
                    var id=$('#EditView input[name=record]').val();         
                    var total_input_value=$('#total_input_value').val();
                      var l1_html;
                      var l1_input=[];
                      $('#total_value input').each(function() {
                        l1_input.push($(this).val());
                      });
                      l1_html=$('#total_value').html();
                    //   console.log(l1_html,l1_input);
                //       $.ajax({
                //         url : 'index.php?module=Opportunities&action=l1',
                //         type : 'POST',
                //         dataType: "json",
                //           data :
                //             {
                //                 id,
                //                 l1_html,
                //                 l1_input,
                //                 total_input_value
                //             },
                //             success: function (data) {
                                
                //               // alert(data.message);
                //               // $("#myForm").css("display","none");
                                
                //                 // console.log(data.message);
                //             }
                //   });
                 
                 var l2_html;
                      var l2_input=[];
                      $('#mtenth input').each(function() {
                        l2_input.push($(this).val());
                      });
                      l2_html=$('#mtenth').html();
                    
                      $.ajax({
                        url : 'index.php?module=Opportunities&action=l2',
                        type : 'POST',
                        dataType: "json",
                          data :
                            {
                                id,
                                l2_html,
                                l2_input
                            },
                            success: function (data) {
                                    
                                // alert(data.message);
                               // $("#myForm").css("display","none");
                                
                                // console.log(data);
                            }
                  });
                  
 
                
                 
                }
            });
  
  //------------------for l1 and l2 audit trail----------END---------------------------------------- 
  
     
     
                
                  
                  //   var start_year=$('#startYear').val();
                  //   var end_year=$('#endYear').val();
                  //   var start_quarter=$('#start_quarter').val();
                  //   var end_quarter=$('#end_quarter').val();
                  //   var no_of_bidders=$('#bid').val();
                   
                    
                   
                   
                    
                  //   if(start_year!=''&& start_quarter !=''&& end_quarter!=''&& end_year !=''){
                      
                  //      // alert(start_year,start_quarter,end_year,end_quarter,no_of_bidders);
                  //     var id=$('#EditView input[name=record]').val();
                   
                  //     $.ajax({
                  //       url : 'index.php?module=Opportunities&action=year_quarters',
                  //       type : 'POST',
                  //         data :
                  //           {
                  //               id,
                  //               start_year,
                  //               end_year,
                  //               start_quarter,
                  //                end_quarter,
                  //                no_of_bidders
                  //           },
                  //           success: function (data) {
                                
                                
                  //           }
                  // });
                  
                  //   }   
                    
                    
                  
                    var cumalitive = $("#cum td input").val();
                    
                     if(cumalitive != "" && cumalitive != 0){
                         
                         $('#financial_feasibility_l2_c').text("View L2 Details");
                         $('#financial_feasibility_l2_c').css("background","#2ecc71")
                         $('#financial_feasibility_l3_c').text("View L3 Details");
                         $('#financial_feasibility_l3_c').css("background","#2ecc71")
                     }
                     else{
                         $('#financial_feasibility_l2_c').text("Add L2 Details");
                         $('#financial_feasibility_l2_c').css("background","#f08377")
                         $('#financial_feasibility_l3_c').text("View L3 Details");
                         $('#financial_feasibility_l3_c').css("background","#f08377")
                     }
                      document.getElementById("myForm").style.display = "none";
                         
     });
     
     
     
 
//-----------------------------------------------------fetch l1 and l2 and quarters--------------END------------------------- 
  if ($("#selection_c").val() == "Green") {
     $('#selection_c').css('background-color','#2ecc71');
               }
    if ($("#selection_c").val() == "Red") {
     $('#selection_c').css('background-color','#de3b33');
               }
    if ($("#selection_c").val() == "Yellow") {
     $('#selection_c').css('background-color','#feca57');
               }    
               
     if ($("#selection_c").val() == "") {
     $('#selection_c').css('background-color','#FFFFFF');
     }
     
     if ($("#funding_c").val() == "Green") {
     $('#funding_c').css('background-color','#2ecc71');
               }
    if ($("#funding_c").val() == "Red") {
     $('#funding_c').css('background-color','#de3b33');
               }
    if ($("#funding_c").val() == "Yellow") {
     $('#funding_c').css('background-color','#feca57');
               }     
    
    if ($("#funding_c").val() == "") {
     $('#funding_c').css('background-color','#FFFFFF');
               }
               
     if ($("#timing_button_c").val() == "Green") {
     $('#timing_button_c').css('background-color','#2ecc71');
               }
    if ($("#timing_button_c").val() == "Red") {
     $('#timing_button_c').css('background-color','#de3b33');
               }
    if ($("#timing_button_c").val() == "Yellow") {
     $('#timing_button_c').css('background-color','#feca57');
               } 
    
    if ($("#timing_button_c").val() == "") {
     $('#timing_button_c').css('background-color','#FFFFFF');
               } 
               
$( ".module-title-text" ).replaceWith( '<h2 class="module-title-text"> CREATE Opportunity </h2>');

 //============================ First of Kind for team lead only========================
  
  
  //  $.ajax({
  //     type: "GET",
  //     url:"index.php?module=Opportunities&action=first_of_kind",
      
  //     success: function (data) {
       
  //      data=JSON.parse(data);
       
  // //alert(data.value);
   
  
  // if(data.value=="yes"){
  // // alert('in');
  //   $('#add_new_segment_c,[data-label=LBL_ADD_NEW_SEGMENT],[data-label=LBL_FIRST_OF_A_KIND_SEGMENT],[field=first_of_a_kind_segment_c]').css("display", "block");
  // $('#add_new_product_service_c,[data-label=LBL_ADD_NEW_PRODUCT_SERVICE],[data-label=LBL_FIRST_OF_A_KIND_PRODUCT],[field=first_of_a_kind_product_c]').css("display", "block");
  // }else{
  // // alert('else');
  //   $('#add_new_segment_c,[data-label=LBL_ADD_NEW_SEGMENT],[data-label=LBL_FIRST_OF_A_KIND_SEGMENT],[field=first_of_a_kind_segment_c]').css("display", "none");
  // $('#add_new_product_service_c,[data-label=LBL_ADD_NEW_PRODUCT_SERVICE],[data-label=LBL_FIRST_OF_A_KIND_PRODUCT],[field=first_of_a_kind_product_c]').css("display", "none");
  // }
  
 
  //     }
      
  //     });
 
 
 
  //============================ First of Kind for team lead only=======END=================
  
  
 //======================================Astericks ============================
 
  
  
    
     if ($("[data-label=LBL_FILENAME] span").text() == "") {
               
             $("[data-label=LBL_FILENAME]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
     if ($("[data-label=LBL_TYPE] span").text() == "") {
               
             $("[data-label=LBL_TYPE]").append(
              "<span style='color:red;'>*</span>"
              );
               }    
              
              
        if ($("[data-label=LBL_NEW_DEPARTMENT] span").text() == "") {
               
             $("[data-label=LBL_NEW_DEPARTMENT]").append(
              "<span style='color:red;'>*</span>"
              );
               }   
      
        if ($("[data-label=LBL_ASSIGNED_TO_NEW] span").text() == "") {
               
             $("[data-label=LBL_ASSIGNED_TO_NEW]").append(
              "<span style='color:red;'>*</span>"
              );
               }  
         
      if ($("[data-label=LBL_OPPORTUNITY_NAME] span").text() == "") {
    
     $("[data-label=LBL_OPPORTUNITY_NAME]").append(
           '<span class="required">*</span>'
          ); 
          
  }     
  
  if ($("[data-label=LBL_SELECT_APPROVER] span").text() == "") {
    
     $("[data-label=LBL_SELECT_APPROVER]").append(
           '<span class="required">*</span>'
          ); 
          
  }    
  
  if ($("[data-label=LBL_STATE] span").text() == "") {
    
     $("[data-label=LBL_STATE]").append(
           '<span class="required">*</span>'
          ); 
          
  }     
  
   if ($("[data-label=LBL_SOURCE] span").text() == "") {
    
     $("[data-label=LBL_SOURCE]").append(
           '<span class="required">*</span>'
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
    if ($("[data-label=LBL_FINANCIAL_FEASIBILITY_L1] span").text() == "") {
             $("[data-label=LBL_FINANCIAL_FEASIBILITY_L1]").append(
              "<span style='color:red;'>*</span>"
              );
               }           
               
      if ($("[data-label=LBL_FINANCIAL_FEASIBILITY_L2] span").text() == "") {
             $("[data-label=LBL_FINANCIAL_FEASIBILITY_L2]").append(
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
               
               
           if ($("[data-label=LBL_PROJECT_SCOPE] span").text() == "") {
             $("[data-label=LBL_PROJECT_SCOPE]").append(
              "<span style='color:red;'>*</span>"
              );
               }    
               
            if ($("[data-label=LBL_RISK] span").text() == "") {
             $("[data-label=LBL_RISK]").append(
              "<span style='color:red;'>*</span>"
              );
               }   
               
               
            if ($("[data-label=LBL_SCOPE_BUDGET_PROJECTED] span").text() == "") {
             $("[data-label=LBL_SCOPE_BUDGET_PROJECTED]").append(
              "<span style='color:red;'>*</span>"
              );
               }   
               
               
             //    if ($("[data-label=LBL_SCOPE_BUDGET_ACHIEVED] span").text() == "") {
             // $("[data-label=LBL_SCOPE_BUDGET_ACHIEVED]").append(
             //  "<span style='color:red;'>*</span>"
             //  );
             //   }
               
               
             if ($("[data-label=LBL_RFP_EOI_PROJECTED] span").text() == "") {
             $("[data-label=LBL_RFP_EOI_PROJECTED]").append(
              "<span style='color:red;'>*</span>"
              );
               } 
               
               
             //  if ($("[data-label=LBL_RFP_EOI_ACHIEVED] span").text() == "") {
             // $("[data-label=LBL_RFP_EOI_ACHIEVED]").append(
             //  "<span style='color:red;'>*</span>"
             //  );
             //   }  
               
               if ($("[data-label=LBL_RFP_EOI_PUBLISHED_PROJECTED] span").text() == "") {
             $("[data-label=LBL_RFP_EOI_PUBLISHED_PROJECTED]").append(
              "<span style='color:red;'>*</span>"
              );
               } 
               
               
             //    if ($("[data-label=LBL_RFP_EOI_PUBLISHED_ACHIEVED] span").text() == "") {
             // $("[data-label=LBL_RFP_EOI_PUBLISHED_ACHIEVED]").append(
             //  "<span style='color:red;'>*</span>"
             //  );
             //   } 
               
              if ($("[data-label=LBL_WORK_ORDER_PROJECTED] span").text() == "") {
             $("[data-label=LBL_WORK_ORDER_PROJECTED]").append(
              "<span style='color:red;'>*</span>"
              );
               } 
               
             //   if ($("[data-label=LBL_WORK_ORDER_ACHIEVED] span").text() == "") {
             // $("[data-label=LBL_WORK_ORDER_ACHIEVED]").append(
             //  "<span style='color:red;'>*</span>"
             //  );
             //   } 
               
              if ($("[data-label=LBL_RFP_EOI_SUMMARY] span").text() == "") {
             $("[data-label=LBL_RFP_EOI_SUMMARY]").append(
              "<span style='color:red;'>*</span>"
              );
               } 
               
               
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
   
 //======================================Astericks========END==================== 
 
//======================================VALIDATION Part=================================================

 custom_check_form = function(view){
//  alert("validate");
 // $('#multiple_approver_c').val($('#select_approver_c').val());
 //  console.log('sadsnds');
  
     var validate = true;
     
    
   
     var form_validation = $("#rfporeoipublished_c").val();
     
     
      var alert_validation = [];
      
     
      
      
   //-----------------onload lead status validation for all cases----------------       
    if ((form_validation == "yes" || form_validation == "no" || form_validation == "not_required" || form_validation == "select")&&$("#status_c").val()=="Lead" ) {
      
       if($("#assigned_user_id").val() == ""){
        validate = false;
           alert_validation.push("Please check with Assign User Name ");
           $("#assigned_to_new_c").css("background-color", "Red");
      }
      
                if($("#name").val() == ""){
           validate = false;
           alert_validation.push("Opportunity name");
           $("#name").css("background-color", "Red");
          }
          
         if($("input[name='international_c']:checked").val()=='no') {
          
         
          if($("#state_c").val() == ""){
           validate = false;
            alert_validation.push("State");
           $("#state_c").css("background-color", "Red");
          }
          
        //   if($("#account_name").val() == ""){
        //   validate = false;
        //   alert_validation.push("Department");
        //   $("#account_name").css("background-color", "Red");
        //   }
        
         if($("#new_department_c").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#new_department_c").css("background-color", "Red");
          }
        
        
        }
         
         if($("input[name='international_c']:checked").val()=='yes') {
          
          
          
          if($("#currency_c").val() == ""){
           validate = false;
            alert_validation.push("Currency Type");
           $("#currency_c").css("background-color", "Red");
          }
         
          if($("#country_c").val() == ""){
           validate = false;
            alert_validation.push("Country Name");
           $("#country_c").css("background-color", "Red");
          }
           if($("#new_department_c").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#new_department_c").css("background-color", "Red");
          }
          
          
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
             
             if($("#assigned_user_id").val() == ""){
            validate = false;
           alert_validation.push("Please check with Assign User Name ");
           $("#assigned_to_new_c").css("background-color", "Red");
        }     
             
             if($("#name").val() == ""){
           validate = false;
           alert_validation.push("Opportunity name");
           $("#name").css("background-color", "Red");
          }
           
           
           
           
         if($("input[name='international_c']:checked").val()=='no') {
          
         
          if($("#state_c").val() == ""){
           validate = false;
            alert_validation.push("State");
           $("#state_c").css("background-color", "Red");
          }
          
        //   if($("#account_name").val() == ""){
        //   validate = false;
        //   alert_validation.push("Department");
        //   $("#account_name").css("background-color", "Red");
        //   }
            if($("#new_department_c").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#new_department_c").css("background-color", "Red");
          }
         
          
          
          
          
         }
         
         if($("input[name='international_c']:checked").val()=='yes') {
         
          if($("#currency_c").val() == ""){
           validate = false;
            alert_validation.push("Currency Type");
           $("#currency_c").css("background-color", "Red");
          } 
         
          if($("#country_c").val() == ""){
           validate = false;
            alert_validation.push("Country Name");
           $("#country_c").css("background-color", "Red");
          }
           if($("#new_department_c").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#new_department_c").css("background-color", "Red");
          }
          
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
              alert_validation.push("RFP/EOI Initiated Drafting (Projected)");
              $("#rfp_eoi_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_projected_c").val() == ""){
              validate = false;
              alert_validation.push("RFP/EOI Published (Projected)");
              $("#rfp_eoi_published_projected_c").css("background-color", "Red");
             }
             if($("#work_order_projected_c").val() == ""){
              validate = false;
              alert_validation.push("Work Order (Projected)");
              $("#work_order_projected_c").css("background-color", "Red");
             }
            
             if($('#startYear').val()==""||$("#total_input_value").val() == ""){
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
              
               if($("#assigned_user_id").val() == ""){
            validate = false;
           alert_validation.push("Please check with Assign User Name ");
           $("#assigned_to_new_c").css("background-color", "Red");
        }     
               
             if($("#name").val() == ""){
              validate = false;
              alert_validation.push("Opportunity name");
              $("#name").css("background-color", "Red");
             }
           
             if($("#source_c").val() == ""){
              validate = false;
               alert_validation.push("Source");
              $("#source_c").css("background-color", "Red");
             }
          
           if($("input[name='international_c']:checked").val()=='no') {
          
         
          if($("#state_c").val() == ""){
           validate = false;
            alert_validation.push("State");
           $("#state_c").css("background-color", "Red");
          }
          
        //   if($("#account_name").val() == ""){
        //   validate = false;
        //   alert_validation.push("Department");
        //   $("#account_name").css("background-color", "Red");
        //   }
        
         if($("#new_department_c").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#new_department_c").css("background-color", "Red");
          }
        
        
        }
         
         if($("input[name='international_c']:checked").val()=='yes') {
          
          
          
          if($("#currency_c").val() == ""){
           validate = false;
            alert_validation.push("Currency Type");
           $("#currency_c").css("background-color", "Red");
          }
         
          if($("#country_c").val() == ""){
           validate = false;
            alert_validation.push("Country Name");
           $("#country_c").css("background-color", "Red");
          }
           if($("#new_department_c").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#new_department_c").css("background-color", "Red");
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
              alert_validation.push("RFP/EOI Initiated Drafting (Projected)");
              $("#rfp_eoi_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_projected_c").val() == ""){
              validate = false;
              alert_validation.push("RFP/EOI Published (Projected)");
              $("#rfp_eoi_published_projected_c").css("background-color", "Red");
             }
             if($("#work_order_projected_c").val() == ""){
              validate = false;
              alert_validation.push("Work Order (Projected)");
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
             
               if($("#assigned_user_id").val() == ""){
               validate = false;
               alert_validation.push("Please check with Assign User Name ");
              $("#assigned_to_new_c").css("background-color", "Red");
            }  
             
              var file_name=$('#filename_file').val();
             
             if(file_name ==""){
              
              if($('#filename_old a').text()==""){
              $("#filename_file").css("background-color", "Red");
              validate=false;
              alert_validation.push("File Name");
               
              }
              
             }
             
              if($("input[name='international_c']:checked").val()=='no') {
          
         
          if($("#state_c").val() == ""){
           validate = false;
            alert_validation.push("State");
           $("#state_c").css("background-color", "Red");
          }
          
        //   if($("#account_name").val() == ""){
        //   validate = false;
        //   alert_validation.push("Department");
        //   $("#account_name").css("background-color", "Red");
        //   }
        
         if($("#new_department_c").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#new_department_c").css("background-color", "Red");
          }
        
        
        }
         
         if($("input[name='international_c']:checked").val()=='yes') {
          
          
          
          if($("#currency_c").val() == ""){
           validate = false;
            alert_validation.push("Currency Type");
           $("#currency_c").css("background-color", "Red");
          }
         
          if($("#country_c").val() == ""){
           validate = false;
            alert_validation.push("Country Name");
           $("#country_c").css("background-color", "Red");
          }
           if($("#new_department_c").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#new_department_c").css("background-color", "Red");
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
             //
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
              alert_validation.push("RFP/EOI Initiated Drafting (Projected)");
              $("#rfp_eoi_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_projected_c").val() == ""){
              validate = false;
              alert_validation.push("RFP/EOI Published (Projected)");
              $("#rfp_eoi_published_projected_c").css("background-color", "Red");
             }
             if($("#work_order_projected_c").val() == ""){
              validate = false;
              alert_validation.push("Work Order (Projected)");
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
             
              if($("#assigned_user_id").val() == ""){
               validate = false;
               alert_validation.push("Please check with Assign User Name ");
              $("#assigned_to_new_c").css("background-color", "Red");
            }  
             
             var file_name=$('#filename_file').val();
             
             if(file_name ==""){
              
              if($('#filename_old a').text()==""){
              $("#filename_file").css("background-color", "Red");
              validate=false;
               alert_validation.push("File Name");
              }
              
             }
             
              if($("input[name='international_c']:checked").val()=='no') {
          
         
          if($("#state_c").val() == ""){
           validate = false;
            alert_validation.push("State");
           $("#state_c").css("background-color", "Red");
          }
          
        //   if($("#account_name").val() == ""){
        //   validate = false;
        //   alert_validation.push("Department");
        //   $("#account_name").css("background-color", "Red");
        //   }
        
         if($("#new_department_c").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#new_department_c").css("background-color", "Red");
          }
        
        
        }
         
         if($("input[name='international_c']:checked").val()=='yes') {
          
          
          
          if($("#currency_c").val() == ""){
           validate = false;
            alert_validation.push("Currency Type");
           $("#currency_c").css("background-color", "Red");
          }
         
          if($("#country_c").val() == ""){
           validate = false;
            alert_validation.push("Country Name");
           $("#country_c").css("background-color", "Red");
          }
           if($("#new_department_c").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#new_department_c").css("background-color", "Red");
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
             //
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
              alert_validation.push("RFP/EOI Initiated Drafting (Projected)");
              $("#rfp_eoi_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_projected_c").val() == ""){
              validate = false;
              alert_validation.push("RFP/EOI Published (Projected)");
              $("#rfp_eoi_published_projected_c").css("background-color", "Red");
             }
             if($("#work_order_projected_c").val() == ""){
              validate = false;
              alert_validation.push("Work Order (Projected)");
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
              
               if($("#assigned_user_id").val() == ""){
               validate = false;
               alert_validation.push("Please check with Assign User Name ");
              $("#assigned_to_new_c").css("background-color", "Red");
            }      
              
             if($("#name").val() == ""){
           validate = false;
           alert_validation.push("Opportunity name");
           $("#name").css("background-color", "Red");
          }
          
           
         if($("input[name='international_c']:checked").val()=='no') {
          
         
          if($("#state_c").val() == ""){
           validate = false;
            alert_validation.push("State");
           $("#state_c").css("background-color", "Red");
          }
          
        //   if($("#account_name").val() == ""){
        //   validate = false;
        //   alert_validation.push("Department");
        //   $("#account_name").css("background-color", "Red");
        //   }
            if($("#new_department_c").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#new_department_c").css("background-color", "Red");
          }
         
          
         }
         
         if($("input[name='international_c']:checked").val()=='yes') {
          
          
          if($("#currency_c").val() == ""){
           validate = false;
            alert_validation.push("Currency Type");
           $("#currency_c").css("background-color", "Red");
          } 
         
          if($("#country_c").val() == ""){
           validate = false;
            alert_validation.push("Country Name");
           $("#country_c").css("background-color", "Red");
          }
           if($("#new_department_c").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#new_department_c").css("background-color", "Red");
          }
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
              alert_validation.push("RFP/EOI Initiated Drafting (Projected)");
              $("#rfp_eoi_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_projected_c").val() == ""){
              validate = false;
              alert_validation.push("RFP/EOI Published (Projected)");
              $("#rfp_eoi_published_projected_c").css("background-color", "Red");
             }
             if($("#work_order_projected_c").val() == ""){
              validate = false;
              alert_validation.push("Work Order (Projected)");
              $("#work_order_projected_c").css("background-color", "Red");
             }
            
             if($('#startYear').val()==""||$("#total_input_value").val() == ""){
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
              
                if($("#assigned_user_id").val() == ""){
            validate = false;
           alert_validation.push("Please check with Assign User Name ");
           $("#assigned_to_new_c").css("background-color", "Red");
        }  
               
             if($("#name").val() == ""){
              validate = false;
              alert_validation.push("Opportunity name");
              $("#name").css("background-color", "Red");
             }
             
             if($("#source_c").val() == ""){
              validate = false;
               alert_validation.push("Source");
              $("#source_c").css("background-color", "Red");
             }
          
          
           if($("input[name='international_c']:checked").val()=='no') {
          
         
          if($("#state_c").val() == ""){
           validate = false;
            alert_validation.push("State");
           $("#state_c").css("background-color", "Red");
          }
          
        //   if($("#account_name").val() == ""){
        //   validate = false;
        //   alert_validation.push("Department");
        //   $("#account_name").css("background-color", "Red");
        //   }
        
         if($("#new_department_c").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#new_department_c").css("background-color", "Red");
          }
        
        
        }
         
         if($("input[name='international_c']:checked").val()=='yes') {
          
          
          
          if($("#currency_c").val() == ""){
           validate = false;
            alert_validation.push("Currency Type");
           $("#currency_c").css("background-color", "Red");
          }
         
          if($("#country_c").val() == ""){
           validate = false;
            alert_validation.push("Country Name");
           $("#country_c").css("background-color", "Red");
          }
           if($("#new_department_c").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#new_department_c").css("background-color", "Red");
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
              alert_validation.push("RFP/EOI Initiated Drafting (Projected)");
              $("#rfp_eoi_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_projected_c").val() == ""){
              validate = false;
              alert_validation.push("RFP/EOI Published (Projected)");
              $("#rfp_eoi_published_projected_c").css("background-color", "Red");
             }
             if($("#work_order_projected_c").val() == ""){
              validate = false;
              alert_validation.push("Work Order (Projected)");
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
             
               if($("#assigned_user_id").val() == ""){
            validate = false;
           alert_validation.push("Please check with Assign User Name ");
           $("#assigned_to_new_c").css("background-color", "Red");
        }  
           
            if($("input[name='international_c']:checked").val()=='no') {
          
         
          if($("#state_c").val() == ""){
           validate = false;
            alert_validation.push("State");
           $("#state_c").css("background-color", "Red");
          }
          
        //   if($("#account_name").val() == ""){
        //   validate = false;
        //   alert_validation.push("Department");
        //   $("#account_name").css("background-color", "Red");
        //   }
        
         if($("#new_department_c").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#new_department_c").css("background-color", "Red");
          }
        
        
        }
         
         if($("input[name='international_c']:checked").val()=='yes') {
          
          
          
          if($("#currency_c").val() == ""){
           validate = false;
            alert_validation.push("Currency Type");
           $("#currency_c").css("background-color", "Red");
          }
         
          if($("#country_c").val() == ""){
           validate = false;
            alert_validation.push("Country Name");
           $("#country_c").css("background-color", "Red");
          }
           if($("#new_department_c").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#new_department_c").css("background-color", "Red");
          }
          
          
         }
             
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
               alert_validation.push("DPR/Scope & Budget Accepted (Projected)");
              $("#scope_budget_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_projected_c").val() == ""){
              validate = false;
              alert_validation.push("RFP/EOI Initiated Drafting (Projected)");
              $("#rfp_eoi_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_projected_c").val() == ""){
              validate = false;
              alert_validation.push("RFP/EOI Published (Projected)");
              $("#rfp_eoi_published_projected_c").css("background-color", "Red");
             }
             if($("#work_order_projected_c").val() == ""){
              validate = false;
              alert_validation.push("Work Order (Projected)");
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
       
         if($("#assigned_user_id").val() == ""){
            validate = false;
           alert_validation.push("Please check with Assign User Name ");
           $("#assigned_to_new_c").css("background-color", "Red");
        }  
       
        var file_name=$('#filename_file').val();
             
             if(file_name ==""){
              
              if($('#filename_old a').text()==""){
              $("#filename_file").css("background-color", "Red");
              validate=false;
              alert_validation.push("File Name");
               
              }
              
             }
             
              if($("input[name='international_c']:checked").val()=='no') {
          
         
          if($("#state_c").val() == ""){
           validate = false;
            alert_validation.push("State");
           $("#state_c").css("background-color", "Red");
          }
          
        //   if($("#account_name").val() == ""){
        //   validate = false;
        //   alert_validation.push("Department");
        //   $("#account_name").css("background-color", "Red");
        //   }
        
         if($("#new_department_c").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#new_department_c").css("background-color", "Red");
          }
        
        
        }
         
         if($("input[name='international_c']:checked").val()=='yes') {
          
          
          
          if($("#currency_c").val() == ""){
           validate = false;
            alert_validation.push("Currency Type");
           $("#currency_c").css("background-color", "Red");
          }
         
          if($("#country_c").val() == ""){
           validate = false;
            alert_validation.push("Country Name");
           $("#country_c").css("background-color", "Red");
          }
           if($("#new_department_c").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#new_department_c").css("background-color", "Red");
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
          
             
              if($('#startYear').val()==""||$("#total_input_value").val() == ""){
              validate = false;
              alert_validation.push("L1 Details");
              $('[field=financial_feasibility_l1_c]').append("<span class='message_lbl' style='color:red;'>"+"<br>Please fill Financial Feasibity L1</span>")
             }else{
                           $('.message_lbl').remove();
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
              alert_validation.push("RFP/EOI Initiated Drafting (Projected)");
              $("#rfp_eoi_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_projected_c").val() == ""){
              validate = false;
              alert_validation.push("RFP/EOI Published (Projected)");
              $("#rfp_eoi_published_projected_c").css("background-color", "Red");
             }
             if($("#work_order_projected_c").val() == ""){
              validate = false;
              alert_validation.push("Work Order (Projected)");
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
          
            if($("#assigned_user_id").val() == ""){
            validate = false;
           alert_validation.push("Please check with Assign User Name ");
           $("#assigned_to_new_c").css("background-color", "Red");
        }  
          
           var file_name=$('#filename_file').val();
             
             if(file_name ==""){
              
              if($('#filename_old a').text()==""){
              $("#filename_file").css("background-color", "Red");
              validate=false;
               alert_validation.push("File Name");
              }
              
             }
             
              if($("input[name='international_c']:checked").val()=='no') {
          
         
          if($("#state_c").val() == ""){
           validate = false;
            alert_validation.push("State");
           $("#state_c").css("background-color", "Red");
          }
          
        //   if($("#account_name").val() == ""){
        //   validate = false;
        //   alert_validation.push("Department");
        //   $("#account_name").css("background-color", "Red");
        //   }
        
         if($("#new_department_c").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#new_department_c").css("background-color", "Red");
          }
        
        
        }
         
         if($("input[name='international_c']:checked").val()=='yes') {
          
          
          
          if($("#currency_c").val() == ""){
           validate = false;
            alert_validation.push("Currency Type");
           $("#currency_c").css("background-color", "Red");
          }
         
          if($("#country_c").val() == ""){
           validate = false;
            alert_validation.push("Country Name");
           $("#country_c").css("background-color", "Red");
          }
           if($("#new_department_c").val() == ""){
           validate = false;
           alert_validation.push("Department");
           $("#new_department_c").css("background-color", "Red");
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
               alert_validation.push("DPR/Scope & Budget Accepted (Projected)");
              $("#scope_budget_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_projected_c").val() == ""){
              validate = false;
              alert_validation.push("RFP/EOI Initiated Drafting (Projected)");
              $("#rfp_eoi_projected_c").css("background-color", "Red");
             }
             if($("#rfp_eoi_published_projected_c").val() == ""){
              validate = false;
              alert_validation.push("RFP/EOI Published (Projected)");
              $("#rfp_eoi_published_projected_c").css("background-color", "Red");
             }
             if($("#work_order_projected_c").val() == ""){
              validate = false;
              alert_validation.push("Work Order (Projected)");
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
               return true;
               alert_validation = [];
             } else {
               return false;
             }
 }
 
 
 //======================================VALIDATION Part=========END========================================
 
     
  //----------hiding assigned to in opportunity creation page-----------
  // $("[data-label=LBL_ASSIGNED_TO_NAME]").hide();
  // $("#assigned_user_name").hide();
  
   // function blocking(){
   
    $("#filename_file").attr("disabled",true);          
    $("#applyfor_c").attr("disabled",true);
 
  //----------hiding assigned to in oppertunity creation page-----END------
  
  //-----------------------hiding and triggering the studio buttons---------------------
  $('#btn_clr_assigned_to_c,#btn_clr_assigned_user_name,#btn_clr_account_name,#btn_clr_select_approver_c').css("display","none");
  
  
  
  // $(document).on('click','#assigned_to_c',function() {
  //  console.log("in");
   
  //  $('#btn_assigned_to_c').trigger('click');
      
  // });
  
  //  $(document).on('click','#assigned_user_name',function() {
  //  console.log("in");
   
  //  $('#btn_assigned_user_name').trigger('click');
      
  // });
  
  // $(document).on('click','#account_name',function() {
  //  console.log("in");
   
  //  $('#btn_account_name').trigger('click');
      
  // });
  
  // $(document).on('click','#select_approver_c',function() {
  //  console.log("in");
   
  //  $('#btn_select_approver_c').trigger('click');
  //  $("#search_form_submit").trigger("click");
   
   
  
  // });
  
 //-----------------------hiding and triggering the studio buttons--------END-------------   
 
 

 
 //-----------------------hiding the multiple-file upload----------------------
 
 
 
 //-----------------------hiding the multiple-file upload-------END-------------
  
  $('#detailpanel_4').hide();
  
  
  
   $("#status_c").attr("disabled",false);
    $(".pagination").hide();
    $("#btn_view_change_log").remove();
    $('#btn_view_change_log').remove();
    

 
//===================================================================================================================== 



  $('#financial_feasibility_l1_c').replaceWith('<button type="button" class="button new" id="financial_feasibility_l1_c">Add L1 Details</button>');
  
  $('#financial_feasibility_l2_c').replaceWith('<button type="button" class="button" id="financial_feasibility_l2_c">Add L2 Details</button>');
  
  $('#financial_feasibility_l3_c').replaceWith('<button type="button" class="button" id="financial_feasibility_l3_c">Add L3 Details</button>');
  
  $("#bid_checklist_c").replaceWith('<button type="button" class="button" id="bid_checklist_c">Bid Checklist</button>');
  
    $("#bid_checklist_c").on('click',function(){
   //  console.log("checklist");
     $(".open_bidChecklist").trigger('click');
   });
   
   
 
   
   
  
   $("#financial_feasibility_l1_c").on('click',function(){
    // console.log("Hi there!");
     $(".open-button").trigger('click');
      $('.message_lbl').remove();
      
      var currency=$('#currency_c').val();

      if(currency=='USD'){
       $('#curr').html('Project Value in $ (in Mn):<span style="color:red;">*</span>');
      // $('#l2p').html('Financial Feasibility L2 details (to be filled in Mn)');
      }
      else{
       $('#curr').html('Project Value in ₹ (in Cr):<span style="color:red;">*</span>');
      // $('#l2p').html('Financial Feasibility L2 details (to be filled in Cr)');
      }
      
   });
   
    
  
   $("#financial_feasibility_l2_c").on('click',function(){
     //console.log("Hi there!");
     
       var currency=$('#currency_c').val();
      
       if(currency=='USD'){
       $('#curr').html('Project Value in $ (in Mn):<span style="color:red;">*</span>');
       $('#l2p').html('Financial Feasibility L2 details (to be filled in Mn)');
      }
      else{
       $('#curr').html('Project Value in ₹ (in Cr):<span style="color:red;">*</span>');
      $('#l2p').html('Financial Feasibility L2 details (to be filled in Cr)');
      }
    
    if($('#rfporeoipublished_c').val()=='yes' && $('#status_c').val()=='QualifiedLead'){
     
     if( $('#startYear').val()!='' && $('#endYear').val()!='' && $('#total_input_value').val()!=''){
     
    var t= $('#bid').val();
    
    if(t==""||t==0){
        $('#bid').val(1);
    }
     $(".open-button1").trigger('click');
      $('.message_lbl').remove();
     
     }
     else{
      
      alert("Please fill all fields in Financial Feasibility (L1)");
      
     }
      
    }
    
    else{
     $(".open-button1").trigger('click');
      $('.message_lbl').remove();
    }
      
      
      
   });
   
    $("#filename_file").on('click',function(){
     //console.log("Hi there!");
    
     
     $("#filename_file").css("background-color", "");
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
   
 //==============================================END========================================  
 //------------------------------dropdown for sector-----------------------
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
  
  //-----------------------------------------Dependable dropdown according to sector selection----------------
  
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
    
   
  
  //--------------------------------------------------------onchange sector -------------------------
  
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

//-------------------------------------segment dropdown------------------------------------
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
         var   optionText = 'Not Available'; 
           var  optionValue = 'notAvailable';
            $("#segment_c").append($('<option>').val(optionValue).text(optionText));
        }
});

//-------------------------------------segment dropdown------------END------------------------

//--------------------------------------sevrice dropdown--------------------------------------
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
              var   optionText = 'Not Available'; 
           var  optionValue = 'notAvailable';
            $("#product_service_c").append($('<option>').val(optionValue).text(optionText));
       
      },
    });
    }
 //--------------------------------------sevrice dropdown----------END----------------------------   
   
  
  //-------------------------onchange segment--------------------------
  
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
            var   optionText = 'Not Available'; 
           var  optionValue = 'notAvailable';
            $("#product_service_c").append($('<option>').val(optionValue).text(optionText));
       
      },
    });
  }
  
   //-------------------------onchange segment---------END-----------------
   
   //----------onchange of segment and product to Not Available option---------------------
   
   $("#segment_c").on("change",function(){
    
    $('#add_new_product_service_c').hide();
       $("[data-label=LBL_ADD_NEW_PRODUCT_SERVICE]").hide();
       $('#first_kind_product1').remove();
       $("option[value=notAvailable]").attr("disabled", false);
    
    if($("#segment_c").val()=='notAvailable'){
      
      $("option[value=notAvailable]").attr("disabled", true);
  $('#add_new_segment_c').attr("disabled",false);
  $("[data-label=LBL_ADD_NEW_SEGMENT]").show();
  $('#add_new_segment_c').replaceWith(`<input type="text" name="add_new_segment_c" id="add_new_segment_c" size="30" maxlength="35" value="" title=""><input type="button" class="btn button" id="first_kind_segment" value="Add Segment"/ >`);
    }else{

  $('#add_new_segment_c').hide();
  $("[data-label=LBL_ADD_NEW_SEGMENT]").hide();
  $('#first_kind_segment').remove();
  $("option[value=notAvailable]").attr("disabled", false);
  
  }
  });
  
  $(document).on("change","#product_service_c",function(){
   
    $('#segment_c').attr("disabled",false);
  $('#add_new_segment_c').hide();
  $("[data-label=LBL_ADD_NEW_SEGMENT]").hide();
  $('#first_kind_segment').remove();
  $("option[value=notAvailable]").attr("disabled", false);
     
    if($("#product_service_c").val()=='notAvailable'){
     
     if($("#product_service_c").val()=='notAvailable' && $("#segment_c").val()=='notAvailable'){
      alert("Please select different Segment");
     }else{
      $("option[value=notAvailable]").attr("disabled", true);
       $('#add_new_product_service_c').attr("disabled",false);
       $('#add_new_product_service_c').show();
       $("[data-label=LBL_ADD_NEW_PRODUCT_SERVICE]").show();
       $('#add_new_product_service_c').replaceWith(`<input type="text" name="add_new_product_service_c" id="add_new_product_service_c" size="30" maxlength="35" value="" title="" ><input type="button" class="btn button" id="first_kind_product1" value="Add Product"/ >`);
     }
     
    }else{
       $('#add_new_product_service_c').hide();
       $("[data-label=LBL_ADD_NEW_PRODUCT_SERVICE]").hide();
       $('#first_kind_product1').remove();
       $("option[value=notAvailable]").attr("disabled", false);
     }
    
   
  });
  
    // $("#product_service_c").on("change",function(){
    //  alert("in");
    //  // if($("#product_service_c").val()=='notAvailable'){
    //  //  alert(" very in");
    //  //  $("option[value=notAvailable]").attr("disabled", true);
    //  //   $('#add_new_product_service_c').attr("disabled",false);
    //  //   $('#add_new_product_service_c').show();
    //  //   $("[data-label=LBL_ADD_NEW_PRODUCT_SERVICE]").show();
    //  //   $('#add_new_product_service_c').replaceWith(`<input type="text" name="add_new_product_service_c" id="add_new_product_service_c" size="30" maxlength="255" value="" title="" ><input type="button" class="btn button" id="first_kind_product1" value="Add Product"/ >`);
    //  // }else{
    //  //   $('#add_new_product_service_c').hide();
    //  //   $("[data-label=LBL_ADD_NEW_PRODUCT_SERVICE]").hide();
    //  //   $('#first_kind_product1').remove();
    //  //   $("option[value=notAvailable]").attr("disabled", false);
    //  // }
     
    // });
   
   //----------onchange of segment and product to Not Available option--------END------------- 
  
    
    
 //----------------------------------------------Select Case ----and edit view-----------------
  if ( $("#rfporeoipublished_c").val()=='select'){
    //console.log('in')
        $("#detailpanel_0").hide();
        $("#detailpanel_1").hide();
        $("#detailpanel_2").hide();
        $("#detailpanel_3").hide();
        $("#detailpanel_4").hide();
        $("#detailpanel_5").hide();
        
        $("#status_c").attr("disabled",false);
        //$("option[value='Lead']").attr("disabled", true);
  $("option[value='QualifiedLead']").attr("disabled", true);
  $("option[value='Qualified']").attr("disabled", true);
  $("option[value='QualifiedDpr']").attr("disabled", true);
  $("option[value='QualifiedBid']").attr("disabled", true);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
        
  }
  
  if ($("#rfporeoipublished_c").val()=='no' && $("#status_c").val()=='Drop'){
   
   
   
   $("#applyfor_c").val('Dropping');
   
    $("option[value='Lead']").attr("disabled", true);
  $("option[value='QualifiedLead']").attr("disabled", true);
  $("option[value='Qualified']").attr("disabled", true);
  $("option[value='QualifiedDpr']").attr("disabled", true);
  $("option[value='QualifiedBid']").attr("disabled", true);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
   
    
  }
  
  if ( $("#rfporeoipublished_c").val()=='not_required' && $("#status_c").val()=='Drop'){
    $("option[value='Lead']").attr("disabled", true);
  $("option[value='QualifiedLead']").attr("disabled", true);
  $("option[value='Qualified']").attr("disabled", true);
  $("option[value='QualifiedDpr']").attr("disabled", true);
  $("option[value='QualifiedBid']").attr("disabled", true);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
   
    $("#applyfor_c").val('Dropping');
  }
  if (  $("#rfporeoipublished_c").val()=='yes' && $("#status_c").val()=='Drop'){
    $("option[value='Lead']").attr("disabled", true);
  $("option[value='QualifiedLead']").attr("disabled", true);
  $("option[value='Qualified']").attr("disabled", true);
  $("option[value='QualifiedDpr']").attr("disabled", true);
  $("option[value='QualifiedBid']").attr("disabled", true);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
   
    $("#applyfor_c").val('Dropping');
  }
  
  //----------------------------------------
  if ($("#rfporeoipublished_c").val()=='no' && $("#status_c").val()=='Dropped'){
   
   
   
   $("#applyfor_c").val('');
    $('input[name="send_approval_button"]').hide();
    $("option[value='Lead']").attr("disabled", true);
  $("option[value='QualifiedLead']").attr("disabled", true);
  $("option[value='Qualified']").attr("disabled", true);
  $("option[value='QualifiedDpr']").attr("disabled", true);
  $("option[value='QualifiedBid']").attr("disabled", true);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
   $("option[value='Drop']").attr("disabled", true);
   
    
  }
  
  if ( $("#rfporeoipublished_c").val()=='not_required' && $("#status_c").val()=='Dropped'){
    $("option[value='Lead']").attr("disabled", true);
  $("option[value='QualifiedLead']").attr("disabled", true);
  $("option[value='Qualified']").attr("disabled", true);
  $("option[value='QualifiedDpr']").attr("disabled", true);
  $("option[value='QualifiedBid']").attr("disabled", true);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
   $("option[value='Drop']").attr("disabled", true);
    $('input[name="send_approval_button"]').hide();
    $("#applyfor_c").val('');
  }
  if (  $("#rfporeoipublished_c").val()=='yes' && $("#status_c").val()=='Dropped'){
    $("option[value='Lead']").attr("disabled", true);
  $("option[value='QualifiedLead']").attr("disabled", true);
  $("option[value='Qualified']").attr("disabled", true);
  $("option[value='QualifiedDpr']").attr("disabled", true);
  $("option[value='QualifiedBid']").attr("disabled", true);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
   $("option[value='Drop']").attr("disabled", true);
    $('input[name="send_approval_button"]').hide();
    $("#applyfor_c").val('');
  }
  
  // ---------------------------------------Select Case ------  edit view---end----------------
  
 //  $("#opportunity_type").attr("disabled",true);
 
 //*************************************************************************************************************************
 
 
 
 //============================================ONLOAD================================================================= 
 
    //----------for lead status onload in edit mode for case no and not-required -------------------------------
  if($("#rfporeoipublished_c").val()=="no" && $("#status_c").val()=="Lead"){ 
   
   $( ".panel-heading:contains('Financials')").hide();
   $( ".panel-heading:contains('Sales timeline')").hide();
   $( ".panel-heading:contains('Bid')").hide();
   $( ".panel-heading:contains('Closure')").hide();
   
   
   $("#status_c option[value='Qualified']").show();
    $("#status_c option[value='QualifiedDpr']").show();
    //  $("#opportunity_type").attr("disabled",false);
              $("#filename_file").attr("disabled",true);     
              $("#status_c").attr("disabled",false);
              $("#detailpanel_0").show() ;
              $("#detailpanel_1").hide() ;
              $("#detailpanel_2").show();
              $("#detailpanel_3").hide() ;
              $("#detailpanel_4").hide() ;
              $("#detailpanel_5").hide() ;
             
              $("#detailpanel_7").hide() ;
              $("#financial_feasibility_l1_c").attr("disabled",true);
              $("#budget_source_c").attr("disabled",true);
              $("#budget_head_c").attr("disabled",true);
              $("#budget_head_amount_c").attr("disabled",true);
              $("#project_implementation_start_c").attr("disabled",true);
              $("#project_implementation_end_c").attr("disabled",true);
              $("#budget_allocated_oppertunity_c").attr("disabled",true);
              //$("#financial_feasibility_l2_c").attr("disabled",true);
              $("#financial_feasibility_l3_c").attr("disabled",true);
              $("#cash_flow_c").attr("disabled",true);
              $("#project_implementation_start_c_trigger").attr("disabled",true);
              $("#project_implementation_end_c_trigger").attr("disabled",true);
            
              $("#applyfor_c").val('qualifylead');
             
         
          
           $("#sector_c").attr("disabled",false);
          $("#sub_sector_c").attr("disabled",false);
          $("#selection_c").hide();
          $("#funding_c").hide();
          $("#timing_button_c").hide();
          $("#risk_c").hide();
          $("#project_scope_c").hide();
          $("[data-label=LBL_SELECTION]").hide();
          $("[data-label=LBL_FUNDING]").hide();
          $("[data-label=LBL_TIMING_BUTTON]").hide();
          $("[data-label=LBL_PROJECT_SCOPE]").hide();
          $("[data-label=LBL_RISK]").hide();
          
            $("[data-label=LBL_FILENAME] span").empty();
            $("[data-label=LBL_SECTOR] span").empty();
            $("[data-label=LBL_SUB_SECTOR] span").empty();
            $("[data-label=LBL_PROJECT_SCOPE] span").empty();
            $("[data-label=LBL_RISK] span").empty();
            $("option[value='Lead']").attr("disabled", false);
  $("option[value='QualifiedLead']").attr("disabled", true);
  $("option[value='Qualified']").attr("disabled", true);
  $("option[value='QualifiedDpr']").attr("disabled", true);
  $("option[value='QualifiedBid']").attr("disabled", true);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
          
  }
  
  
  if($("#rfporeoipublished_c").val()=="not_required" && $("#status_c").val()=="Lead"){ 
   
    $( ".panel-heading:contains('Financials')").hide();
   $( ".panel-heading:contains('Sales timeline')").hide();
   $( ".panel-heading:contains('Bid')").hide();
   $( ".panel-heading:contains('Closure')").hide();
  
   
   $("#status_c option[value='Qualified']").show();
    $("#status_c option[value='QualifiedDpr']").show();
    $("#status_c option[value='QualifiedBid']").hide();
    //  $("#opportunity_type").attr("disabled",false);
    $("#filename_file").attr("disabled",true);     
              $("#status_c").attr("disabled",false);
              $("#detailpanel_0").show() ;
              $("#detailpanel_1").hide() ;
              $("#detailpanel_2").show();
              $("#detailpanel_3").hide() ;
              $("#detailpanel_4").hide() ;
              $("#detailpanel_5").hide() ;
             
              $("#financial_feasibility_l1_c").attr("disabled",true);
              $("#budget_source_c").attr("disabled",true);
              $("#budget_head_c").attr("disabled",true);
              $("#budget_head_amount_c").attr("disabled",true);
              $("#project_implementation_start_c").attr("disabled",true);
              $("#project_implementation_end_c").attr("disabled",true);
              $("#budget_allocated_oppertunity_c").attr("disabled",true);
             // $("#financial_feasibility_l2_c").attr("disabled",true);
              $("#financial_feasibility_l3_c").attr("disabled",true);
              $("#cash_flow_c").attr("disabled",true);
              $("#project_implementation_start_c_trigger").attr("disabled",true);
              $("#project_implementation_end_c_trigger").attr("disabled",true);
            
              $("#applyfor_c").val('qualifylead');
              
         
           $("#sector_c").attr("disabled",false);
           $("#sub_sector_c").attr("disabled",false);
           $("#selection_c").hide();
           $("#funding_c").hide();
           $("#timing_button_c").hide();
           $("#risk_c").hide();
           $("#project_scope_c").hide();
           $("[data-label=LBL_SELECTION]").hide();
           $("[data-label=LBL_FUNDING]").hide();
           $("[data-label=LBL_TIMING_BUTTON]").hide();
           $("[data-label=LBL_PROJECT_SCOPE]").hide();
           $("[data-label=LBL_RISK]").hide();
          
           $("[data-label=LBL_FILENAME] span").empty();
           
            $("[data-label=LBL_SECTOR] span").empty();
               
               $("[data-label=LBL_SUB_SECTOR] span").empty();
               
               $("[data-label=LBL_PROJECT_SCOPE] span").empty();
            $("[data-label=LBL_RISK] span").empty();
            $("option[value='Lead']").attr("disabled", false);
  $("option[value='QualifiedLead']").attr("disabled", true);
  $("option[value='Qualified']").attr("disabled", true);
  $("option[value='QualifiedDpr']").attr("disabled", true);
  $("option[value='QualifiedBid']").attr("disabled", true);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
  }
  
  
  
  //----------for lead status onload in edit mode for case no and not-required ----------end---------------------

 //.................Onload for case no...................................................
    
    
    if($("#status_c").val()=="QualifiedLead" && $("#rfporeoipublished_c").val()=="no")
    {    
     
      $( ".panel-heading:contains('Bid')").hide();
   $( ".panel-heading:contains('Closure')").hide();
  
 
     
     $("#rfporeoipublished_c").attr("disabled",true);
    //   $("#opportunity_type").attr("disabled",true);
      $("option[value='Lead']").attr("disabled", false);
  $("option[value='QualifiedLead']").attr("disabled", false);
  $("option[value='Qualified']").attr("disabled", true);
  $("option[value='QualifiedDpr']").attr("disabled", true);
  $("option[value='QualifiedBid']").attr("disabled", true);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
     
          $("#detailpanel_1").show() ;
          $("#detailpanel_2").show() ;
          $("#detailpanel_3").show() ;
           $("#detailpanel_5").hide() ;
          $("#sector_c").attr("disabled",false);
          $("#sub_sector_c").attr("disabled",false);
          $("#risk_c").attr("disabled",false);
          $("#selection_c").attr("disabled",true);
          $("#funding_c").attr("disabled",true);
          $("#timing_button_c").attr("disabled",true);
           $("#financial_feasibility_l1_c").attr("disabled",false);
           // $("#financial_feasibility_l2_c").attr("disabled",true);
            $("#financial_feasibility_l3_c").attr("disabled",true);
             $("#budget_source_c").attr("disabled",true);
             $("#budget_head_c").attr("disabled",true);
             $("#budget_head_amount_c").attr("disabled",true);
             $("#budget_allocated_oppertunity_c").attr("disabled",true);
             $("#project_implementation_start_c").attr("disabled",true);
              $("#project_implementation_end_c").attr("disabled",true);
             
                
           $("#applyfor_c").val('qualifyOpportunity');
           
           $("#project_scope_c").attr("disabled",true);
           
            $("#selection_c").hide();
           $("#funding_c").hide();
           $("#timing_button_c").hide();
           $("#project_scope_c").hide();
           $("#budget_source_c").hide();
           $("#budget_head_c").hide();
           $("#budget_head_amount_c").hide();
           $("#budget_allocated_oppertunity_c").hide();
           $("#project_implementation_start_c").hide();
           $("#project_implementation_end_c").hide();
           $("#financial_feasibility_l2_c").hide();
           $("#financial_feasibility_l3_c").hide();
           
           $("[data-label=LBL_SELECTION]").hide();
           $("[data-label=LBL_FUNDING]").hide();
           $("[data-label=LBL_TIMING_BUTTON]").hide();
           $("[data-label=LBL_FINANCIAL_FEASIBILITY_L2]").hide();
           $("[data-label=LBL_BUDGET_HEAD_AMOUNT]").hide();
           $("[data-label=LBL_BUDGET_HEAD]").hide();
           $("[data-label=LBL_PROJECT_IMPLEMENTATION_START]").hide();
           $("[data-label=LBL_BUDGET_ALLOCATED_OPPERTUNITY]").hide();
           $("[data-label=LBL_BUDGET_SOURCE]").hide();
           $("[data-label=LBL_PROJECT_IMPLEMENTATION_END]").hide();
           $("[data-label=LBL_FINANCIAL_FEASIBILITY_L3]").hide(); 
           $("[data-label=LBL_PROJECT_SCOPE]").hide(); 
          
           
                 $("[data-label=LBL_FILENAME] span").empty();
                 
                $("[data-label=LBL_BUDGET_SOURCE] span").empty();
               
                $("[data-label=LBL_BUDGET_HEAD] span").empty();
               
                $("[data-label=LBL_BUDGET_HEAD_AMOUNT] span").empty();
               
                $("[data-label=LBL_BUDGET_ALLOCATED_OPPERTUNITY] span").empty();
               
                $("[data-label=LBL_PROJECT_IMPLEMENTATION_START] span").empty();
               
              $("[data-label=LBL_PROJECT_IMPLEMENTATION_END] span").empty();
               
                $("[data-label=LBL_FINANCIAL_FEASIBILITY_L2] span").empty();
                
                $("[data-label=LBL_PROJECT_SCOPE] span").empty();
                
                
                if( $("[data-label=LBL_RISK] span").text() =='') {
                 $("[data-label=LBL_RISK]").append(
              "<span style='color:red;'>*</span>"
              );
                }
              if( $("[data-label=LBL_SECTOR] span").text() =='') {
               $("[data-label=LBL_SECTOR]").append(
              "<span style='color:red;'>*</span>"
              );
               
              }
              
              if( $("[data-label=LBL_SUB_SECTOR] span").text() =='') {
               $("[data-label=LBL_SUB_SECTOR]").append(
              "<span style='color:red;'>*</span>"
              );
               
              }
          
          
          }
   
    
     if($("#status_c").val()=="Qualified" && $("#rfporeoipublished_c").val()=="no"){
      
      $("#rfporeoipublished_c").attr("disabled",true);
      // $("#opportunity_type").attr("disabled",true);
        $( ".panel-heading:contains('Closure')").hide();
      $("option[value='Lead']").attr("disabled", false);
  $("option[value='QualifiedLead']").attr("disabled", false);
  $("option[value='Qualified']").attr("disabled", false);
  $("option[value='QualifiedDpr']").attr("disabled", true);
  $("option[value='QualifiedBid']").attr("disabled", true);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
      
      
      
       $("#detailpanel_1").show() ;
      $("#detailpanel_2").show() ;
         $("#detailpanel_3").show() ;
         $("#detailpanel_4").show() ;
         $("#detailpanel_5").hide() ;
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
         
         $("#applyfor_c").val('qualifyDpr');
         
         $("#bid_strategy_c").hide();
         $("#submissionstatus_c").hide();
         $("#bid_checklist_c").hide();
          $("[data-label=LBL_BID_STRATEGY] ").hide();
           $("[data-label=LBL_SUBMISSIONSTATUS] ").hide();
           $("[data-label=LBL_BID_CHECKLIST] ").hide();
         
          $("#financial_feasibility_l1_c").attr("disabled",false);
         $("#project_scope_c").attr("disabled",false);
         
          $("[data-label=LBL_FILENAME] span").empty();
          $("[data-label=LBL_BID_STRATEGY] span").empty();
          $("[data-label=LBL_SUBMISSIONSTATUS] span").empty();
         $("[data-label=LBL_RFP_EOI_SUMMARY] span").empty(); 
           
                if( $("[data-label=LBL_RISK] span").text() =='') {
                 $("[data-label=LBL_RISK]").append(
              "<span style='color:red;'>*</span>"
              );
                }
              if( $("[data-label=LBL_SECTOR] span").text() =='') {
               $("[data-label=LBL_SECTOR]").append(
              "<span style='color:red;'>*</span>"
              );
               
              }
              
              if( $("[data-label=LBL_SUB_SECTOR] span").text() =='') {
               $("[data-label=LBL_SUB_SECTOR]").append(
              "<span style='color:red;'>*</span>"
              );
               
              }
          
          
          if( $("[data-label=LBL_PROJECT_SCOPE] span").text() =='') {
            $("[data-label=LBL_PROJECT_SCOPE]").append(
              "<span style='color:red;'>*</span>"
              );
          }
              if( $("[data-label=LBL_BUDGET_SOURCE] span").text()=='') {
            $("[data-label=LBL_BUDGET_SOURCE]").append(
              "<span style='color:red;'>*</span>"
              ); 
              }
              
              if( $("[data-label=LBL_BUDGET_HEAD] span").text()=='') {
              $("[data-label=LBL_BUDGET_HEAD]").append(
              "<span style='color:red;'>*</span>"
              );
              }
             if( $("[data-label=LBL_BUDGET_HEAD_AMOUNT] span").text()=='') { 
            $("[data-label=LBL_BUDGET_HEAD_AMOUNT]").append(
              "<span style='color:red;'>*</span>"
              ); 
             }
             
              if( $("[data-label=LBL_BUDGET_ALLOCATED_OPPERTUNITY] span").text()=='') {  
              $("[data-label=LBL_BUDGET_ALLOCATED_OPPERTUNITY]").append(
              "<span style='color:red;'>*</span>"
              );
             }
             
             if( $("[data-label=LBL_PROJECT_IMPLEMENTATION_START] span").text()=='') {
            $("[data-label=LBL_PROJECT_IMPLEMENTATION_START]").append(
              "<span style='color:red;'>*</span>"
              ); 
              
             }
             
             if( $("[data-label=LBL_PROJECT_IMPLEMENTATION_END] span").text()=='') {
              $("[data-label=LBL_PROJECT_IMPLEMENTATION_END]").append(
              "<span style='color:red;'>*</span>"
              ); 
             }
              if( $("[data-label=LBL_FINANCIAL_FEASIBILITY_L2] span").text()=='') {
              
               $("[data-label=LBL_FINANCIAL_FEASIBILITY_L2]").append(
              "<span style='color:red;'>*</span>"
              ); 
          
              }
        };
     
      if($("#status_c").val()=="QualifiedDpr" && $("#rfporeoipublished_c").val()=="no"){
       
       $("#rfporeoipublished_c").attr("disabled",true);
        // $("#opportunity_type").attr("disabled",true);
       $( ".panel-heading:contains('Closure')").hide();
        $("#applyfor_c").val('qualifyBid');
            $("#detailpanel_1").show() ;
           $("#detailpanel_2").show() ;
         $("#detailpanel_3").show() ;
         $("#detailpanel_4").show() ;
         $("#detailpanel_5").hide() ;
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
          $("#filename_file").attr("disabled",false);
        $( ".label:contains('Bid Files:'),.downloadAttachment,.remove_attachment,.multiple_file,#add_button" ).show();
          $("#financial_feasibility_l1_c").attr("disabled",false);
           $("#project_scope_c").attr("disabled",false);
           
            if( $("[data-label=LBL_RISK] span").text() =='') {
                 $("[data-label=LBL_RISK]").append(
              "<span style='color:red;'>*</span>"
              );
                }
              if( $("[data-label=LBL_SECTOR] span").text() =='') {
               $("[data-label=LBL_SECTOR]").append(
              "<span style='color:red;'>*</span>"
              );
               
              }
              
              if( $("[data-label=LBL_SUB_SECTOR] span").text() =='') {
               $("[data-label=LBL_SUB_SECTOR]").append(
              "<span style='color:red;'>*</span>"
              );
               
              }
          
          
          if( $("[data-label=LBL_PROJECT_SCOPE] span").text() =='') {
            $("[data-label=LBL_PROJECT_SCOPE]").append(
              "<span style='color:red;'>*</span>"
              );
          }
          
           if( $("[data-label=LBL_BID_STRATEGY] span").text()=='') {
               $("[data-label=LBL_BID_STRATEGY]").append(
              "<span style='color:red;'>*</span>"
              );
              
           }
              if( $("[data-label=LBL_SUBMISSIONSTATUS] span").text()=='') {
               $("[data-label=LBL_SUBMISSIONSTATUS]").append(
              "<span style='color:red;'>*</span>"
              );
              }
              
              $("option[value='Lead']").attr("disabled", false);
  $("option[value='QualifiedLead']").attr("disabled", false);
  $("option[value='Qualified']").attr("disabled", false);
  $("option[value='QualifiedDpr']").attr("disabled", false);
  $("option[value='QualifiedBid']").attr("disabled", true);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
   
      };
      
      
       if($("#status_c").val()=="QualifiedBid" && $("#rfporeoipublished_c").val()=="no"){
        
        $("#rfporeoipublished_c").attr("disabled",true);
        //  $("#opportunity_type").attr("disabled",true);
        
         $("#detailpanel_1").show() ;
          $("#applyfor_c").val('closure');
         $("#detailpanel_2").show() ;
          $("#detailpanel_3").show() ;
         $("#detailpanel_4").show() ;
         $("#detailpanel_5").show() ;
        
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
          $("#filename_file").attr("disabled",false);
          $("#financial_feasibility_l1_c").attr("disabled",false);
         $( ".label:contains('Bid Files:'),.downloadAttachment,.remove_attachment,.multiple_file,#add_button" ).show();  
           $("#project_scope_c").attr("disabled",false);
        
         if( $("[data-label=LBL_RISK] span").text() =='') {
                 $("[data-label=LBL_RISK]").append(
              "<span style='color:red;'>*</span>"
              );
                }
              if( $("[data-label=LBL_SECTOR] span").text() =='') {
               $("[data-label=LBL_SECTOR]").append(
              "<span style='color:red;'>*</span>"
              );
               
              }
              
              if( $("[data-label=LBL_SUB_SECTOR] span").text() =='') {
               $("[data-label=LBL_SUB_SECTOR]").append(
              "<span style='color:red;'>*</span>"
              );
               
              }
          
          
          if( $("[data-label=LBL_PROJECT_SCOPE] span").text() =='') {
            $("[data-label=LBL_PROJECT_SCOPE]").append(
              "<span style='color:red;'>*</span>"
              );
          }
          
          $("option[value='Lead']").attr("disabled", false);
  $("option[value='QualifiedLead']").attr("disabled", false);
  $("option[value='Qualified']").attr("disabled", false);
  $("option[value='QualifiedDpr']").attr("disabled", false);
  $("option[value='QualifiedBid']").attr("disabled", false);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
       };
       
        if($("#status_c").val()=="Closed" && $("#rfporeoipublished_c").val()=="no")
    {    
        
        $("#rfporeoipublished_c").attr("disabled",true);
        //  $("#opportunity_type").attr("disabled",true);
        
          $("#applyfor_c").val('');
          $("#detailpanel_0").show() ;
          $("#detailpanel_1").show() ;
          $("#detailpanel_2").show() ;
          $("#detailpanel_3").show() ;
          $("#detailpanel_4").show() ;
          $("#detailpanel_5").show() ;
          
           $("#budget_source_c").attr("disabled",false);
          $("#budget_head_c").attr("disabled",false);
          $("#budget_head_amount_c").attr("disabled",false);
          $("#budget_allocated_oppertunity_c").attr("disabled",false);
           $("#project_implementation_start_c").attr("disabled",false);
           $("#project_implementation_end_c").attr("disabled",false);
           $("#financial_feasibility_l1_c").attr("disabled",false);
           $("#financial_feasibility_l2_c").attr("disabled",false);
           $("#financial_feasibility_l3_c").attr("disabled",false);
            $('input[name="send_approval_button"]').hide();
           $("option[value='Lead']").attr("disabled", false);
  $("option[value='QualifiedLead']").attr("disabled", false);
  $("option[value='Qualified']").attr("disabled", false);
  $("option[value='QualifiedDpr']").attr("disabled", false);
  $("option[value='QualifiedBid']").attr("disabled", false);
  $("option[value='Closed']").attr("disabled", false);
   $("option[value='Dropped']").attr("disabled", true);
   $("option[value='Drop']").attr("disabled", true);
   $( ".label:contains('Bid Files:'),.downloadAttachment,.remove_attachment,.multiple_file,#add_button" ).show(); 
   
  
    }
          
       
  //.................Onload for case no......END.............................................
//--------------------for not_required case-QualifiedLead  ------------------------------------

if($("#status_c").val()=="QualifiedLead" && $("#rfporeoipublished_c").val()=="not_required")
    {    
        
        $("#rfporeoipublished_c").attr("disabled",true);
        
     $("#applyfor_c").val('qualifyOpportunity');
          $("#detailpanel_1").show() ;
          $("#detailpanel_2").show() ;
          $("#detailpanel_3").show() ;
          $("#detailpanel_5").hide() ;
          $("#sector_c").attr("disabled",false);
          $("#sub_sector_c").attr("disabled",false);
          $("#risk_c").attr("disabled",false);
          $("#selection_c").attr("disabled",true);
          $("#funding_c").attr("disabled",true);
          $("#timing_button_c").attr("disabled",true);
          
           $("#financial_feasibility_l1_c").attr("disabled",false);
          // $("#financial_feasibility_l2_c").attr("disabled",true);
            $("#financial_feasibility_l3_c").attr("disabled",true);
             $("#budget_source_c").attr("disabled",true);
             $("#budget_head_c").attr("disabled",true);
             $("#budget_head_amount_c").attr("disabled",true);
             $("#budget_allocated_oppertunity_c").attr("disabled",true);
             $("#project_implementation_start_c").attr("disabled",true);
              $("#project_implementation_end_c").attr("disabled",true);
           
           $("#project_scope_c").attr("disabled",true);
           
           $("#filename_file").attr("disabled",false);
           
           $("[data-label=LBL_FILENAME] span").empty();
          
              $("[data-label=LBL_BUDGET_SOURCE] span").empty();
               
                $("[data-label=LBL_BUDGET_HEAD] span").empty();
               
                $("[data-label=LBL_BUDGET_HEAD_AMOUNT] span").empty();
               
                $("[data-label=LBL_BUDGET_ALLOCATED_OPPERTUNITY] span").empty();
               
                $("[data-label=LBL_PROJECT_IMPLEMENTATION_START] span").empty();
               
              $("[data-label=LBL_PROJECT_IMPLEMENTATION_END] span").empty();
               
                $("[data-label=LBL_FINANCIAL_FEASIBILITY_L2] span").empty();
                
                $("[data-label=LBL_PROJECT_SCOPE] span").empty();
        if( $("[data-label=LBL_RISK] span").text() =='') {
                 $("[data-label=LBL_RISK]").append(
              "<span style='color:red;'>*</span>"
              );
                }
              if( $("[data-label=LBL_SECTOR] span").text() =='') {
               $("[data-label=LBL_SECTOR]").append(
              "<span style='color:red;'>*</span>"
              );
               
              }
              
              if( $("[data-label=LBL_SUB_SECTOR] span").text() =='') {
               $("[data-label=LBL_SUB_SECTOR]").append(
              "<span style='color:red;'>*</span>"
              );
               
              }
              
              $("option[value='Lead']").attr("disabled", false);
  $("option[value='QualifiedLead']").attr("disabled", false);
  $("option[value='Qualified']").attr("disabled", true);
  $("option[value='QualifiedDpr']").attr("disabled", true);
 // $("option[value='QualifiedBid']").attr("disabled", true);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
    $("#selection_c").hide();
           $("#funding_c").hide();
           $("#timing_button_c").hide();
           $("#project_scope_c").hide();
           $("#budget_source_c").hide();
           $("#budget_head_c").hide();
           $("#budget_head_amount_c").hide();
           $("#budget_allocated_oppertunity_c").hide();
           $("#project_implementation_start_c").hide();
           $("#project_implementation_end_c").hide();
           $("#financial_feasibility_l2_c").hide();
           $("#financial_feasibility_l3_c").hide();
           
           $("[data-label=LBL_SELECTION]").hide();
           $("[data-label=LBL_FUNDING]").hide();
           $("[data-label=LBL_TIMING_BUTTON]").hide();
           $("[data-label=LBL_FINANCIAL_FEASIBILITY_L2]").hide();
           $("[data-label=LBL_BUDGET_HEAD_AMOUNT]").hide();
           $("[data-label=LBL_BUDGET_HEAD]").hide();
           $("[data-label=LBL_PROJECT_IMPLEMENTATION_START]").hide();
           $("[data-label=LBL_BUDGET_ALLOCATED_OPPERTUNITY]").hide();
           $("[data-label=LBL_BUDGET_SOURCE]").hide();
           $("[data-label=LBL_PROJECT_IMPLEMENTATION_END]").hide();
           $("[data-label=LBL_FINANCIAL_FEASIBILITY_L3]").hide(); 
           $("[data-label=LBL_PROJECT_SCOPE]").hide(); 
           
           
              
   $( ".panel-heading:contains('Bid')").hide();
   $( ".panel-heading:contains('Closure')").hide();
  
     
    }
    
 //--------------------for not_required case-QualifiedLead  --END----------------------------------

       
 //-------------------- for not_required--onload ---------------------------------------------
 
       if($("#rfporeoipublished_c").val()=='not_required' && $("#status_c").val()=="Qualified"){
        
        $("#rfporeoipublished_c").attr("disabled",true);
        
         $("#applyfor_c").val('qualifyDpr');
          $("#detailpanel_1").show() ;
         $("#detailpanel_2").show() ;
         $("#detailpanel_3").show() ;
         $("#detailpanel_4").hide() ;
         $("#detailpanel_5").hide() ;
        
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
         $("#filename_file").attr("disabled",false);
          
        $("[data-label=LBL_BID_STRATEGY] span").empty();
          $("[data-label=LBL_SUBMISSIONSTATUS] span").empty();
           $("[data-label=LBL_FILENAME] span").empty();
          
                if( $("[data-label=LBL_RISK] span").text() =='') {
                 $("[data-label=LBL_RISK]").append(
              "<span style='color:red;'>*</span>"
              );
                }
              if( $("[data-label=LBL_SECTOR] span").text() =='') {
               $("[data-label=LBL_SECTOR]").append(
              "<span style='color:red;'>*</span>"
              );
               
              }
              
              if( $("[data-label=LBL_SUB_SECTOR] span").text() =='') {
               $("[data-label=LBL_SUB_SECTOR]").append(
              "<span style='color:red;'>*</span>"
              );
               
              }
          
          
          if( $("[data-label=LBL_PROJECT_SCOPE] span").text() =='') {
            $("[data-label=LBL_PROJECT_SCOPE]").append(
              "<span style='color:red;'>*</span>"
              );
          }
              if( $("[data-label=LBL_BUDGET_SOURCE] span").text()=='') {
            $("[data-label=LBL_BUDGET_SOURCE]").append(
              "<span style='color:red;'>*</span>"
              ); 
              }
              
              if( $("[data-label=LBL_BUDGET_HEAD] span").text()=='') {
              $("[data-label=LBL_BUDGET_HEAD]").append(
              "<span style='color:red;'>*</span>"
              );
              }
             if( $("[data-label=LBL_BUDGET_HEAD_AMOUNT] span").text()=='') { 
            $("[data-label=LBL_BUDGET_HEAD_AMOUNT]").append(
              "<span style='color:red;'>*</span>"
              ); 
             }
             
              if( $("[data-label=LBL_BUDGET_ALLOCATED_OPPERTUNITY] span").text()=='') {  
              $("[data-label=LBL_BUDGET_ALLOCATED_OPPERTUNITY]").append(
              "<span style='color:red;'>*</span>"
              );
             }
             
             if( $("[data-label=LBL_PROJECT_IMPLEMENTATION_START] span").text()=='') {
            $("[data-label=LBL_PROJECT_IMPLEMENTATION_START]").append(
              "<span style='color:red;'>*</span>"
              ); 
              
             }
             
             if( $("[data-label=LBL_PROJECT_IMPLEMENTATION_END] span").text()=='') {
              $("[data-label=LBL_PROJECT_IMPLEMENTATION_END]").append(
              "<span style='color:red;'>*</span>"
              ); 
             }
              if( $("[data-label=LBL_FINANCIAL_FEASIBILITY_L2] span").text()=='') {
              
               $("[data-label=LBL_FINANCIAL_FEASIBILITY_L2]").append(
              "<span style='color:red;'>*</span>"
              ); 
          
              }
               $("option[value='Lead']").attr("disabled", false);
  $("option[value='QualifiedLead']").attr("disabled", false);
  $("option[value='Qualified']").attr("disabled", false);
  $("option[value='QualifiedDpr']").attr("disabled", true);
 // $("option[value='QualifiedBid']").attr("disabled", true);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
   
   
    
   $( ".panel-heading:contains('Bid')").hide();
   $( ".panel-heading:contains('Closure')").hide();
  
        }
 
 //-------------------- for not_required--onload --------END-------------------------------------
 
 //------------------ for not_required ---------------------------------
 
          if($("#rfporeoipublished_c").val()=='not_required' && $("#status_c").val()=="QualifiedDpr"){
           
           $("#rfporeoipublished_c").attr("disabled",true);
           
         $("#applyfor_c").val('closure');
          $("#detailpanel_1").show() ;
         $("#detailpanel_2").show() ;
          $("#detailpanel_3").show() ;
         $("#detailpanel_4").hide() ;
         $("#detailpanel_5").show() ;
         
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
          $("#project_scope_c").attr("disabled",false);
          
          
          
          $("option[value='Lead']").attr("disabled", false);
  $("option[value='QualifiedLead']").attr("disabled", false);
  $("option[value='Qualified']").attr("disabled", false);
  $("option[value='QualifiedDpr']").attr("disabled", false);
 // $("option[value='QualifiedBid']").attr("disabled", true);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
   
$("#filename_file").attr("disabled",false);

   $( ".panel-heading:contains('Bid')").hide();
   
  
         
        }
        
 //------------------ for not_required ------END----------------------------------


  
  //--------------- for all status onload in edit mode case is YES ---------------------------------
if ( $("#rfporeoipublished_c").val()=='yes' && $("#status_c").val()=="Lead"){  
    
    
    
     $( ".panel-heading:contains('Financials')").hide();
   $( ".panel-heading:contains('Sales timeline')").hide();
   $( ".panel-heading:contains('Bid')").hide();
   $( ".panel-heading:contains('Closure')").hide();
  
    
     $("#status_c option[value='Qualified']").hide();
               $("#status_c option[value='QualifiedDpr']").hide();
            //   $("#opportunity_type").attr("disabled",false);
               $("#filename_file").attr("disabled",false);     
              $("#detailpanel_0").show() ;
              $("#detailpanel_1").hide() ;
              $("#detailpanel_2").show();
              $("#detailpanel_3").hide() ;
              $("#detailpanel_4").hide() ;
              $("#detailpanel_5").hide() ;
             
              $("#detailpanel_7").hide() ;
              
              $("#financial_feasibility_l1_c").attr("disabled",true);
              $("#budget_source_c").attr("disabled",true);
              $("#budget_head_c").attr("disabled",true);
              $("#budget_head_amount_c").attr("disabled",true);
              $("#project_implementation_start_c").attr("disabled",true);
              $("#project_implementation_end_c").attr("disabled",true);
              $("#budget_allocated_oppertunity_c").attr("disabled",true);
              // $("#financial_feasibility_l2_c").attr("disabled",true);
              $("#financial_feasibility_l3_c").attr("disabled",true);
              $("#cash_flow_c").attr("disabled",true);
              $("#project_implementation_start_c_trigger").attr("disabled",true);
              $("#project_implementation_end_c_trigger").attr("disabled",true);
              $("#status_c").val("Lead");
              $("#applyfor_c").val('qualifylead');
              
             //$("#project_scope_c").attr("disabled",true);
              
               $("#detailpanel_2").show() ;
               
           $("#sector_c").attr("disabled",false);
          $("#sub_sector_c").attr("disabled",false);
          $("#selection_c").hide();
          $("#funding_c").hide();
          $("#timing_button_c").hide();
          $("#risk_c").hide();
          $("#project_scope_c").hide();
          $("[data-label=LBL_SELECTION]").hide();
          $("[data-label=LBL_FUNDING]").hide();
          $("[data-label=LBL_TIMING_BUTTON]").hide();
          $("[data-label=LBL_PROJECT_SCOPE]").hide();
          $("[data-label=LBL_RISK]").hide();
          
          $("#status_c").attr("disabled",false);
          
            $("[data-label=LBL_SECTOR] span").empty();
              
               $("[data-label=LBL_FILENAME] span").empty();
               $("[data-label=LBL_SUB_SECTOR] span").empty();
               $("[data-label=LBL_PROJECT_SCOPE] span").empty();
            $("[data-label=LBL_RISK] span").empty();
            
            $("option[value='Lead']").attr("disabled", false);
  $("option[value='QualifiedLead']").attr("disabled", true);
  //$("option[value='Qualified']").attr("disabled", true);
  //$("option[value='QualifiedDpr']").attr("disabled", true);
  $("option[value='QualifiedBid']").attr("disabled", true);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
}
  
  
  
  
  
  if ( $("#rfporeoipublished_c").val()=='yes' && $("#status_c").val()=="QualifiedLead"){
   
                $("#rfporeoipublished_c").attr("disabled",true);
                
                 $("#status_c option[value='Qualified']").hide();
                 $("#status_c option[value='QualifiedDpr']").hide();
                 
                $("#detailpanel_0").show() ;
                $("#detailpanel_1").show() ;
                $("#detailpanel_2").show() ;
                $("#detailpanel_3").show() ;
                $("#detailpanel_4").show() ;
                $("#detailpanel_5").hide() ;
                
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
             $("#financial_feasibility_l1_c").attr("disabled",false);
             $("#project_scope_c").attr("disabled",false); 
            $("#bid_checklist_c").attr("disabled",true);
          $("option[value='Lead']").attr("disabled", false);
  $("option[value='QualifiedLead']").attr("disabled", false);
  //$("option[value='Qualified']").attr("disabled", true);
  //$("option[value='QualifiedDpr']").attr("disabled", true);
  $("option[value='QualifiedBid']").attr("disabled", true);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
     $( ".label:contains('Bid Files:'),.downloadAttachment,.remove_attachment,.multiple_file,#add_button" ).show();      
     
   $( ".panel-heading:contains('Closure')").hide();
  
  }
  
  if($("#rfporeoipublished_c").val()=='yes'&& $("#status_c").val()=="QualifiedBid" ){
   
   
   $("#rfporeoipublished_c").attr("disabled",true);
   
    $("#status_c option[value='Qualified']").hide();
    $("#status_c option[value='QualifiedDpr']").hide();
           
           $("#filename_file").attr("disabled",false); 
           
           $("#status_c").attr("disabled",false);
         $("#applyfor_c").val('closure');
          $("#detailpanel_1").show() ;
         $("#detailpanel_2").show() ;
          $("#detailpanel_3").show() ;
         $("#detailpanel_4").show() ;
         $("#detailpanel_5").show() ;
         
         $("#sector_c").attr("disabled",false);
         $("#sub_sector_c").attr("disabled",false);
         // $("#influencersl2_c").attr("disabled",false);
         $("#bid_strategy_c").attr("disabled",false);
         $("#submissionstatus_c").attr("disabled",false);
         $("#bid_checklist_c").attr("disabled",true); 
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
         
          $("option[value='Lead']").attr("disabled", false);
  $("option[value='QualifiedLead']").attr("disabled", false);
  //$("option[value='Qualified']").attr("disabled", true);
  //$("option[value='QualifiedDpr']").attr("disabled", true);
  $("option[value='QualifiedBid']").attr("disabled", false);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
        $( ".label:contains('Bid Files:'),.downloadAttachment,.remove_attachment,.multiple_file,#add_button" ).show(); 
        }
  
  //--------------- for onload in edit mode all status case is YES -------End-------------------------- 
  
  //-----------------onload status closed for yes and not required-----------------
  if($("#status_c").val()=="Closed" && $("#rfporeoipublished_c").val()=="not_required")
    {    
     
     
     $("#rfporeoipublished_c").attr("disabled",true);
     
          $("#applyfor_c").val('');
          $("#detailpanel_0").show() ;
          $("#detailpanel_1").show() ;
          $("#detailpanel_2").show() ;
          $("#detailpanel_3").show() ;
          $("#detailpanel_4").hide() ;
          $("#detailpanel_5").show() ;
          $("#bid_checklist_c").attr("disabled",true);
          $("#budget_source_c").attr("disabled",false);
          $("#budget_head_c").attr("disabled",false);
          $("#budget_head_amount_c").attr("disabled",false);
          $("#budget_allocated_oppertunity_c").attr("disabled",false);
           $("#project_implementation_start_c").attr("disabled",false);
           $("#project_implementation_end_c").attr("disabled",false);
           $("#financial_feasibility_l1_c").attr("disabled",false);
           $("#financial_feasibility_l2_c").attr("disabled",false);
           $("#financial_feasibility_l3_c").attr("disabled",false);
           $("#status_c option[value='QualifiedBid']").hide();
            $('input[name="send_approval_button"]').hide();
            $("option[value='Lead']").attr("disabled", false);
  $("option[value='QualifiedLead']").attr("disabled", false);
  $("option[value='Qualified']").attr("disabled", false);
  $("option[value='QualifiedDpr']").attr("disabled", false);
  //$("option[value='QualifiedBid']").attr("disabled", false);
  $("option[value='Closed']").attr("disabled", false);
   $("option[value='Dropped']").attr("disabled", true);
    $("option[value='Drop']").attr("disabled", true);
          
   $( ".panel-heading:contains('Bid')").hide();
   
  
          
    }
    if($("#status_c").val()=="Closed" && $("#rfporeoipublished_c").val()=="yes")
    {  
        $("#rfporeoipublished_c").attr("disabled",true);
        
          $("#applyfor_c").val('');
          $("#detailpanel_0").show() ;
          $("#detailpanel_1").show() ;
          $("#detailpanel_2").show() ;
          $("#detailpanel_3").show() ;
          $("#detailpanel_4").show() ;
          $("#detailpanel_5").show() ;
           $("#budget_source_c").attr("disabled",false);
          $("#budget_head_c").attr("disabled",false);
          $("#budget_head_amount_c").attr("disabled",false);
          $("#budget_allocated_oppertunity_c").attr("disabled",false);
           $("#project_implementation_start_c").attr("disabled",false);
           $("#project_implementation_end_c").attr("disabled",false);
           $("#financial_feasibility_l1_c").attr("disabled",false);
           $("#financial_feasibility_l2_c").attr("disabled",false);
           $("#financial_feasibility_l3_c").attr("disabled",false);
           
            $('input[name="send_approval_button"]').hide();
            $("#status_c option[value='Qualified']").hide();
    $("#status_c option[value='QualifiedDpr']").hide();
           
             
            $("option[value='Lead']").attr("disabled", false);
  $("option[value='QualifiedLead']").attr("disabled", false);
  //$("option[value='Qualified']").attr("disabled", true);
  //$("option[value='QualifiedDpr']").attr("disabled", true);
  $("option[value='QualifiedBid']").attr("disabled", false);
  $("option[value='Closed']").attr("disabled", false);
   $("option[value='Dropped']").attr("disabled", true);
    $("option[value='Drop']").attr("disabled", true);
     $( ".label:contains('Bid Files:'),.downloadAttachment,.remove_attachment,.multiple_file,#add_button" ).show(); 
     $("[data-label=LBL_BID_CHECKLIST]").hide();
    $("#bid_checklist_c").hide();
    }
        
   //-----------------onload status closed for yes and not required---------END-------- 
  
//===================================ONLOAD=========END==========================================================  
//**************************************************************************************************************************    
   
   
//*************************************************************************************************************************
//====================================ONCHANGE====================================================================
   
   
   
    //-------------------------------on change of  rfporeoipublished--------------------------------
  
    $("#rfporeoipublished_c").on("change", function () {
       
       
      var x=$("#rfporeoipublished_c").val();
      //console.log(x);
      
      switch (x){
        
        case "yes":
         $( ".panel-heading:contains('Financials')").hide();
   $( ".panel-heading:contains('Sales timeline')").hide();
   $( ".panel-heading:contains('Bid')").hide();
   $( ".panel-heading:contains('Closure')").hide();
  
          
            // $("#status_c option[value='Lead']").remove();
              $("#status_c option[value='Qualified']").hide();
               $("#status_c option[value='QualifiedDpr']").hide();
              
               $("#filename_file").attr("disabled",false);     
              $("#detailpanel_0").show() ;
              $("#detailpanel_1").hide() ;
              $("#detailpanel_2").show();
              $("#detailpanel_3").hide() ;
              $("#detailpanel_4").hide() ;
              $("#detailpanel_5").hide() ;
             
              $("#detailpanel_7").hide() ;
              
              $("#financial_feasibility_l1_c").attr("disabled",true);
              $("#budget_source_c").attr("disabled",true);
              $("#budget_head_c").attr("disabled",true);
              $("#budget_head_amount_c").attr("disabled",true);
              $("#project_implementation_start_c").attr("disabled",true);
              $("#project_implementation_end_c").attr("disabled",true);
              $("#budget_allocated_oppertunity_c").attr("disabled",true);
              // $("#financial_feasibility_l2_c").attr("disabled",true);
              $("#financial_feasibility_l3_c").attr("disabled",true);
              $("#cash_flow_c").attr("disabled",true);
              $("#project_implementation_start_c_trigger").attr("disabled",true);
              $("#project_implementation_end_c_trigger").attr("disabled",true);
              $("#status_c").val("Lead");
              $("#applyfor_c").val('qualifylead');
              
             
              
               $("#detailpanel_2").show();
               
          $("#sector_c").attr("disabled",false);
          $("#sub_sector_c").attr("disabled",false);
          $("#selection_c").hide();
          $("#funding_c").hide();
          $("#timing_button_c").hide();
          $("#risk_c").hide();
          $("#project_scope_c").hide();
          $("[data-label=LBL_SELECTION]").hide();
          $("[data-label=LBL_FUNDING]").hide();
          $("[data-label=LBL_TIMING_BUTTON]").hide();
          $("[data-label=LBL_PROJECT_SCOPE]").hide();
          $("[data-label=LBL_RISK]").hide();
          
          $("#status_c").attr("disabled",false);
          
          
           $("[data-label=LBL_SECTOR] span").empty();
            $("[data-label=LBL_FILENAME] span").empty();
               
               $("[data-label=LBL_SUB_SECTOR] span").empty();
               $("[data-label=LBL_PROJECT_SCOPE] span").empty();
            $("[data-label=LBL_RISK] span").empty();
            
            $("option[value='Lead']").attr("disabled", false);
  $("option[value='QualifiedLead']").attr("disabled", true);
  //$("option[value='Qualified']").attr("disabled", true);
  //$("option[value='QualifiedDpr']").attr("disabled", true);
  $("option[value='QualifiedBid']").attr("disabled", true);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
        //   $("#opportunity_type").attr("disabled",false);
          
         break;
              
        
          
          case "no":
         
            $( ".panel-heading:contains('Financials')").hide();
   $( ".panel-heading:contains('Sales timeline')").hide();
   $( ".panel-heading:contains('Bid')").hide();
   $( ".panel-heading:contains('Closure')").hide();
  
            $("#status_c option[value='Qualified']").show();
            $("#status_c option[value='QualifiedDpr']").show();
           
            $("#filename_file").attr("disabled",true);     
              
              $("#detailpanel_0").show() ;
              $("#detailpanel_1").hide() ;
              $("#detailpanel_2").show();
              $("#detailpanel_3").hide() ;
              $("#detailpanel_4").hide() ;
              $("#detailpanel_5").hide() ;
            
              
              
              $("#financial_feasibility_l1_c").attr("disabled",true);
              $("#budget_source_c").attr("disabled",true);
              $("#budget_head_c").attr("disabled",true);
              $("#budget_head_amount_c").attr("disabled",true);
              $("#project_implementation_start_c").attr("disabled",true);
              $("#project_implementation_end_c").attr("disabled",true);
              $("#budget_allocated_oppertunity_c").attr("disabled",true);
              // $("#financial_feasibility_l2_c").attr("disabled",true);
              $("#financial_feasibility_l3_c").attr("disabled",true);
              $("#cash_flow_c").attr("disabled",true);
              $("#project_implementation_start_c_trigger").attr("disabled",true);
              $("#project_implementation_end_c_trigger").attr("disabled",true);
              
              $("#status_c").val("Lead");
              $("#applyfor_c").val('qualifylead');
              
               $("#detailpanel_2").show() ;
          $("#sector_c").attr("disabled",false);
          $("#sub_sector_c").attr("disabled",false);
          $("#selection_c").hide();
          $("#funding_c").hide();
          $("#timing_button_c").hide();
          $("#risk_c").hide();
          $("#project_scope_c").hide();
          $("[data-label=LBL_SELECTION]").hide();
          $("[data-label=LBL_FUNDING]").hide();
          $("[data-label=LBL_TIMING_BUTTON]").hide();
          $("[data-label=LBL_PROJECT_SCOPE]").hide();
          $("[data-label=LBL_RISK]").hide();
          $("#status_c").attr("disabled",false);
          
          $("#project_scope_c").attr("disabled",true);
          
          
           $("[data-label=LBL_FILENAME] span").empty();
            $("[data-label=LBL_SECTOR] span").empty();
            $("[data-label=LBL_SUB_SECTOR] span").empty();
            $("[data-label=LBL_PROJECT_SCOPE] span").empty();
            $("[data-label=LBL_RISK] span").empty();
          
               $("option[value='Lead']").attr("disabled", false);
  $("option[value='QualifiedLead']").attr("disabled", true);
  $("option[value='Qualified']").attr("disabled", true);
  $("option[value='QualifiedDpr']").attr("disabled", true);
  $("option[value='QualifiedBid']").attr("disabled", true);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
    // $("#opportunity_type").attr("disabled",false);
            
        break;
        
            case "select":
          
              $("#filename_file").attr("disabled",true);     
              $("#detailpanel_0").hide() ;
              $("#detailpanel_1").hide() ;
              $("#detailpanel_2").hide() ;
              $("#detailpanel_3").hide() ;
              $("#detailpanel_4").hide() ;
              $("#detailpanel_5").hide() ;
             
               $("#status_c").val("Lead");
              $("#applyfor_c").val('qualifylead');
              $("#status_c").attr("disabled",false);
              $("option[value='Lead']").attr("disabled", true);
  $("option[value='QualifiedLead']").attr("disabled", true);
  $("option[value='Qualified']").attr("disabled", true);
  $("option[value='QualifiedDpr']").attr("disabled", true);
  $("option[value='QualifiedBid']").attr("disabled", true);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
              
            break;
          
 
            case "not_required":
             
             
              $( ".panel-heading:contains('Financials')").hide();
   $( ".panel-heading:contains('Sales timeline')").hide();
   $( ".panel-heading:contains('Bid')").hide();
   $( ".panel-heading:contains('Closure')").hide();
  
             $("#status_c option[value='Qualified']").show();
            $("#status_c option[value='QualifiedDpr']").show();
            $("#status_c option[value='QualifiedBid']").hide();
           
            $("#filename_file").attr("disabled",true);     
              
              $("#detailpanel_0").show() ;
              $("#detailpanel_1").hide() ;
              $("#detailpanel_2").show();
              $("#detailpanel_3").hide() ;
              $("#detailpanel_4").hide() ;
              $("#detailpanel_5").hide() ;
              
              
              $("#financial_feasibility_l1_c").attr("disabled",true);
              $("#budget_source_c").attr("disabled",true);
              $("#budget_head_c").attr("disabled",true);
              $("#budget_head_amount_c").attr("disabled",true);
              $("#project_implementation_start_c").attr("disabled",true);
              $("#project_implementation_end_c").attr("disabled",true);
              $("#budget_allocated_oppertunity_c").attr("disabled",true);
              // $("#financial_feasibility_l2_c").attr("disabled",true);
              $("#financial_feasibility_l3_c").attr("disabled",true);
              $("#cash_flow_c").attr("disabled",true);
              $("#project_implementation_start_c_trigger").attr("disabled",true);
              $("#project_implementation_end_c_trigger").attr("disabled",true);
              
              $("#status_c").val("Lead");
              $("#applyfor_c").val('qualifylead');
              
               $("#detailpanel_2").show() ;
           $("#sector_c").attr("disabled",false);
          $("#sub_sector_c").attr("disabled",false);
          $("#selection_c").hide();
          $("#funding_c").hide();
          $("#timing_button_c").hide();
          $("#risk_c").hide();
          $("#project_scope_c").hide();
          $("[data-label=LBL_SELECTION]").hide();
          $("[data-label=LBL_FUNDING]").hide();
          $("[data-label=LBL_TIMING_BUTTON]").hide();
          $("[data-label=LBL_PROJECT_SCOPE]").hide();
          $("[data-label=LBL_RISK]").hide();
          $("#status_c").attr("disabled",false);
          
          $("#project_scope_c").attr("disabled",true);
          
          
           $("[data-label=LBL_FILENAME] span").empty();
            $("[data-label=LBL_SECTOR] span").empty();
            $("[data-label=LBL_SUB_SECTOR] span").empty();
            $("[data-label=LBL_PROJECT_SCOPE] span").empty();
            $("[data-label=LBL_RISK] span").empty();
        
               $("option[value='Lead']").attr("disabled", false);
  $("option[value='QualifiedLead']").attr("disabled", true);
  $("option[value='Qualified']").attr("disabled", true);
  $("option[value='QualifiedDpr']").attr("disabled", true);
  //$("option[value='QualifiedBid']").attr("disabled", true);
  $("option[value='Closed']").attr("disabled", true);
   $("option[value='Dropped']").attr("disabled", true);
    // $("#opportunity_type").attr("disabled",false);
            break;
        
      }
       
    });
    
    //-------------------------------on change of  rfporeoipublished--------END------------------------
    
   
      
       
      
  //--------------------------------------  Onchange  Status-------------------------------------
      
     $("#status_c").on("change", function () {
       
       
      var s=$("#status_c").val();
      
      $("#applyfor_c").val();
      
      switch (s){
       
       case "Drop":
        
         $("#applyfor_c").val('Dropping');
        
        break;
        
        case "Lead":
            
        if($("#rfporeoipublished_c").val()=='no'|| $("#rfporeoipublished_c").val()=='not_required'){
         $("#applyfor_c").val('qualifylead');
          $("#detailpanel_2").show() ;
          $("#sector_c").attr("disabled",true);
          $("#sub_sector_c").attr("disabled",true);
          $("#selection_c").attr("disabled",true);
          $("#funding_c").attr("disabled",true);
          $("#timing_button_c").attr("disabled",true);
          $("#risk_c").attr("disabled",true);
           $("#project_scope_c").attr("disabled",true);
        //   $("#opportunity_type").attr("disabled",false);
        }
         
        
        break;
        
      case "QualifiedLead":
         
          if($("#rfporeoipublished_c").val()=='no'||$("#rfporeoipublished_c").val()=='not_required'){
           
         $("#rfporeoipublished_c").attr("disabled",true);  
           
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
         
          
           
            $("#financial_feasibility_l1_c").attr("disabled",false);
          
            $("#project_scope_c").attr("disabled",true);
           
            $("[data-label=LBL_BUDGET_SOURCE] span").empty();
               
                $("[data-label=LBL_BUDGET_HEAD] span").empty();
               
                $("[data-label=LBL_BUDGET_HEAD_AMOUNT] span").empty();
               
                $("[data-label=LBL_BUDGET_ALLOCATED_OPPERTUNITY] span").empty();
               
                $("[data-label=LBL_PROJECT_IMPLEMENTATION_START] span").empty();
               
              $("[data-label=LBL_PROJECT_IMPLEMENTATION_END] span").empty();
               
                $("[data-label=LBL_FINANCIAL_FEASIBILITY_L2] span").empty();
                
                $("[data-label=LBL_PROJECT_SCOPE] span").empty();
                
               if( $("[data-label=LBL_RISK] span").text()=='') {
                 $("[data-label=LBL_RISK]").append(
              "<span style='color:red;'>*</span>"
              );
              
               }
              if( $("[data-label=LBL_SECTOR] span").text()=='') {
               $("[data-label=LBL_SECTOR]").append(
              "<span style='color:red;'>*</span>"
              );
              }
              
              if( $("[data-label=LBL_SUB_SECTOR] span").text()=='') {
               $("[data-label=LBL_SUB_SECTOR]").append(
              "<span style='color:red;'>*</span>"
              );
              }
          
        }
         
          
         
        break;
        
    case "Qualified":
         
         $("#rfporeoipublished_c").attr("disabled",true);
         
          if($("#rfporeoipublished_c").val()=='no'){
              
              
              
         $("#applyfor_c").val('qualifyDpr');
          $("#detailpanel_1").show() ;
         $("#detailpanel_2").show() ;
         $("#detailpanel_3").show() ;
         $("#detailpanel_4").show() ;
         $("#detailpanel_5").hide() ;
         
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
           $("[data-label=LBL_BID_STRATEGY] span").empty();
          $("[data-label=LBL_SUBMISSIONSTATUS] span").empty();
          
          if( $("[data-label=LBL_PROJECT_SCOPE] span").text()=='') {
            $("[data-label=LBL_PROJECT_SCOPE]").append(
              "<span style='color:red;'>*</span>"
              );
          }
              if( $("[data-label=LBL_BUDGET_SOURCE] span").text()=='') {
            $("[data-label=LBL_BUDGET_SOURCE]").append(
              "<span style='color:red;'>*</span>"
              ); 
              }
              
              if( $("[data-label=LBL_BUDGET_HEAD] span").text()=='') {
              $("[data-label=LBL_BUDGET_HEAD]").append(
              "<span style='color:red;'>*</span>"
              );
              }
             if( $("[data-label=LBL_BUDGET_HEAD_AMOUNT] span").text()=='') { 
            $("[data-label=LBL_BUDGET_HEAD_AMOUNT]").append(
              "<span style='color:red;'>*</span>"
              ); 
             }
             
              if( $("[data-label=LBL_BUDGET_ALLOCATED_OPPERTUNITY] span").text()=='') {  
              $("[data-label=LBL_BUDGET_ALLOCATED_OPPERTUNITY]").append(
              "<span style='color:red;'>*</span>"
              );
             }
             
             if( $("[data-label=LBL_PROJECT_IMPLEMENTATION_START] span").text()=='') {
            $("[data-label=LBL_PROJECT_IMPLEMENTATION_START]").append(
              "<span style='color:red;'>*</span>"
              ); 
              
             }
             
             if( $("[data-label=LBL_PROJECT_IMPLEMENTATION_END] span").text()=='') {
              $("[data-label=LBL_PROJECT_IMPLEMENTATION_END]").append(
              "<span style='color:red;'>*</span>"
              ); 
             }
              if( $("[data-label=LBL_FINANCIAL_FEASIBILITY_L2] span").text()=='') {
              
               $("[data-label=LBL_FINANCIAL_FEASIBILITY_L2]").append(
              "<span style='color:red;'>*</span>"
              ); 
          
              }
        }
        
 //-------------------- for not_required ---------------------------------------------
 
       if($("#rfporeoipublished_c").val()=='not_required'){
         $("#applyfor_c").val('qualifyDpr');
          $("#detailpanel_1").show() ;
         $("#detailpanel_2").show() ;
         $("#detailpanel_3").show() ;
         $("#detailpanel_4").hide() ;
         $("#detailpanel_5").hide() ;
        
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
          
           $("[data-label=LBL_BID_STRATEGY] span").empty();
          $("[data-label=LBL_SUBMISSIONSTATUS] span").empty();
          
          
                if( $("[data-label=LBL_RISK] span").text() =='') {
                 $("[data-label=LBL_RISK]").append(
              "<span style='color:red;'>*</span>"
              );
                }
              if( $("[data-label=LBL_SECTOR] span").text() =='') {
               $("[data-label=LBL_SECTOR]").append(
              "<span style='color:red;'>*</span>"
              );
               
              }
              
              if( $("[data-label=LBL_SUB_SECTOR] span").text() =='') {
               $("[data-label=LBL_SUB_SECTOR]").append(
              "<span style='color:red;'>*</span>"
              );
               
              }
          
          
          if( $("[data-label=LBL_PROJECT_SCOPE] span").text() =='') {
            $("[data-label=LBL_PROJECT_SCOPE]").append(
              "<span style='color:red;'>*</span>"
              );
          }
              if( $("[data-label=LBL_BUDGET_SOURCE] span").text()=='') {
            $("[data-label=LBL_BUDGET_SOURCE]").append(
              "<span style='color:red;'>*</span>"
              ); 
              }
              
              if( $("[data-label=LBL_BUDGET_HEAD] span").text()=='') {
              $("[data-label=LBL_BUDGET_HEAD]").append(
              "<span style='color:red;'>*</span>"
              );
              }
             if( $("[data-label=LBL_BUDGET_HEAD_AMOUNT] span").text()=='') { 
            $("[data-label=LBL_BUDGET_HEAD_AMOUNT]").append(
              "<span style='color:red;'>*</span>"
              ); 
             }
             
              if( $("[data-label=LBL_BUDGET_ALLOCATED_OPPERTUNITY] span").text()=='') {  
              $("[data-label=LBL_BUDGET_ALLOCATED_OPPERTUNITY]").append(
              "<span style='color:red;'>*</span>"
              );
             }
             
             if( $("[data-label=LBL_PROJECT_IMPLEMENTATION_START] span").text()=='') {
            $("[data-label=LBL_PROJECT_IMPLEMENTATION_START]").append(
              "<span style='color:red;'>*</span>"
              ); 
              
             }
             
             if( $("[data-label=LBL_PROJECT_IMPLEMENTATION_END] span").text()=='') {
              $("[data-label=LBL_PROJECT_IMPLEMENTATION_END]").append(
              "<span style='color:red;'>*</span>"
              ); 
             }
              if( $("[data-label=LBL_FINANCIAL_FEASIBILITY_L2] span").text()=='') {
              
               $("[data-label=LBL_FINANCIAL_FEASIBILITY_L2]").append(
              "<span style='color:red;'>*</span>"
              ); 
          
              }
        }
 
 //-------------------- for not_required --------END-------------------------------------
         
        break;
        
        case "QualifiedDpr":
         
         $("#rfporeoipublished_c").attr("disabled",true);
         
        if($("#rfporeoipublished_c").val()=='no'){
         
         $("#applyfor_c").val('qualifyBid');
          $("#detailpanel_1").show() ;
         $("#detailpanel_2").show() ;
         $("#detailpanel_3").show() ;
         $("#detailpanel_4").show() ;
         $("#detailpanel_5").hide() ;
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
         $("#filename_file").attr("disabled",false);
          $("#financial_feasibility_l1_c").attr("disabled",false);
         
          if( $("[data-label=LBL_BID_STRATEGY] span").text()=='') {
               $("[data-label=LBL_BID_STRATEGY]").append(
              "<span style='color:red;'>*</span>"
              );
              }
              
              if( $("[data-label=LBL_SUBMISSIONSTATUS] span").text()=='') {
               $("[data-label=LBL_SUBMISSIONSTATUS]").append(
              "<span style='color:red;'>*</span>"
              );
              }
         
        }
        
 //------------------ for not_required ---------------------------------
 
          if($("#rfporeoipublished_c").val()=='not_required'){
           
         $("#applyfor_c").val('closure');
          $("#detailpanel_1").show() ;
         $("#detailpanel_2").show() ;
          $("#detailpanel_3").show() ;
         $("#detailpanel_4").hide() ;
         $("#detailpanel_5").show() ;
         
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
        }
        
 //------------------ for not_required ------END----------------------------------
         
        
        break;
        
        case "QualifiedBid":
         
         $("#rfporeoipublished_c").attr("disabled",true);
         
          if($("#rfporeoipublished_c").val()=='no'){
           
         $("#applyfor_c").val('closure');
          $("#detailpanel_1").show() ;
         $("#detailpanel_2").show() ;
          $("#detailpanel_3").show() ;
         $("#detailpanel_4").show() ;
         $("#detailpanel_5").show() ;
        
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
          $("#filename_file").attr("disabled",false);
          $("#financial_feasibility_l1_c").attr("disabled",false);
         
      }
        
        break;
        
        case "Closed":
        
        $("#rfporeoipublished_c").attr("disabled",true);
           
        $("#applyfor_c").val('');
        
        if($("#status_c").val()=="Closed" && $("#rfporeoipublished_c").val()=="no")
    {    
          $("#applyfor_c").val('');
          $("#detailpanel_0").show() ;
          $("#detailpanel_1").show() ;
          $("#detailpanel_2").show() ;
          $("#detailpanel_3").show() ;
          $("#detailpanel_4").show() ;
          $("#detailpanel_5").show() ;
    }
    
    if($("#status_c").val()=="Closed" && $("#rfporeoipublished_c").val()=="not_required")
    {    
     
          $("#applyfor_c").val('');
          $("#detailpanel_0").show() ;
          $("#detailpanel_1").show() ;
          $("#detailpanel_2").show() ;
          $("#detailpanel_3").show() ;
          $("#detailpanel_4").hide() ;
          $("#detailpanel_5").show() ;
    }
    if($("#status_c").val()=="Closed" && $("#rfporeoipublished_c").val()=="yes")
    {    
          $("#applyfor_c").val('');
          $("#detailpanel_0").show() ;
          $("#detailpanel_1").show() ;
          $("#detailpanel_2").show() ;
          $("#detailpanel_3").show() ;
          $("#detailpanel_4").show() ;
          $("#detailpanel_5").show() ;
    }
        
        break;
        
      }
      
      
      
   });
    
  //------------ status change and apply for changes onchange------END-------------------------------  
 
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
        //   $("#opportunity_type").attr("disabled",false);
             }
   
          break;
          
    case "QualifiedLead" :
        
        $("#rfporeoipublished_c").attr("disabled",true);
        
     if($("#rfporeoipublished_c").val()=='yes'){
       $("#applyfor_c").val('qualifyBid');
       
       
       
          $("#detailpanel_1").show() ;
         $("#detailpanel_2").show() ;
         $("#detailpanel_3").show() ;
         $("#detailpanel_4").show() ;
         $("#detailpanel_5").hide() ;
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
         
         $("#bid_strategy_c").attr("disabled",false);
         $("#submissionstatus_c").attr("disabled",false);
         $("#bid_checklist_c").attr("disabled",true); 
          $("#financial_feasibility_l1_c").attr("disabled",false);
           $("#project_scope_c").attr("disabled",false);
           
       if( $("[data-label=LBL_RISK] span").text() =='') {
                 $("[data-label=LBL_RISK]").append(
              "<span style='color:red;'>*</span>"
              );
                }
              if( $("[data-label=LBL_SECTOR] span").text() =='') {
               $("[data-label=LBL_SECTOR]").append(
              "<span style='color:red;'>*</span>"
              );
               
              }
              
              if( $("[data-label=LBL_SUB_SECTOR] span").text() =='') {
               $("[data-label=LBL_SUB_SECTOR]").append(
              "<span style='color:red;'>*</span>"
              );
               
              }
          
          
          if( $("[data-label=LBL_PROJECT_SCOPE] span").text() =='') {
            $("[data-label=LBL_PROJECT_SCOPE]").append(
              "<span style='color:red;'>*</span>"
              );
          }
       
     }
     
     break;
     
             case "QualifiedBid":
                 
            $("#rfporeoipublished_c").attr("disabled",true);     
          if($("#rfporeoipublished_c").val()=='yes'){
           
            $("#status_c option[value='Qualified']").hide();
    $("#status_c option[value='QualifiedDpr']").hide();
           $("#status_c").attr("disabled",false);
         $("#applyfor_c").val('closure');
          $("#detailpanel_1").show() ;
         $("#detailpanel_2").show() ;
          $("#detailpanel_3").show() ;
         $("#detailpanel_4").show() ;
         $("#detailpanel_5").show() ;
        
         $("#sector_c").attr("disabled",false);
         $("#sub_sector_c").attr("disabled",false);
        
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
         
      }
        
        break;
   
   }
  
 })
 
 //............Onchange for YES ..........END...............................
 
    
//================================================ONCHANGE==========END============================
//****************************************************************************************************************

 //---------------------------for disabling date buttons
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
    
 //------------------------------------------scope--------------------------   
    var scope;
    
    //if user click the date field other than scope and budget projected date field
    
    $(()=>{
  //     $("#rfp_eoi_projected_c").click(()=>{
  //        scope = $("#scope_budget_projected_c").val();
  //     if(scope == "" ){
  //        // $('#rfp_eoi_projected_c').datepicker("option", "showOn", "off");
  //   alert("please first select DPR/Scope Budget accepted Projected date");
  //   $("#rfp_eoi_projected_c").val('');
   
  // }
  
  //   });
    
    
  //  $("#rfp_eoi_published_projected_c").click(()=>{
  //        scope = $("#scope_budget_projected_c").val();
  //     if(scope == "" ){
  //   alert("please first select DPR/Scope Budget accepted Projected date");
  //   // $('#rfp_eoi_published_projected_c').datepicker("option", "showOn", "off");
  // }
  //   });
    
  //   $("#work_order_projected_c").click(()=>{
  //        scope = $("#scope_budget_projected_c").val();
  //     if(scope == "" ){
  //   alert("please first select DPR/Scope Budget accepted Projected date");
  //   // $('#work_order_projected_c').datepicker("option", "showOn", "off");
     
  // }
  //   });
    
    $("#scope_budget_achieved_c").click(()=>{
         scope = $("#scope_budget_projected_c").val();
  
    });
    
    $("#rfp_eoi_achieved_c").click(()=>{
         scope = $("#scope_budget_projected_c").val();
  
    });
    
    $("#rfp_eoi_published_achieved_c").click(()=>{
         scope = $("#scope_budget_projected_c").val();
  
    });
    
    $("#work_order_achieved_c").click(()=>{
         scope = $("#scope_budget_projected_c").val();
  
    });
    
    });
    
    //------------------------------------------scope--------END------------------ 
    
    
  
    
    
    //------------------------ making date default values-------------------------------
    $(function(){
    $("#scope_budget_projected_c").prop("readonly",true).datepicker({
    dateFormat : 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
    mindate:0,
    onSelect: function(date1) {
      // $('#rfp_eoi_projected_c').css('background-color','#d8f5ee');
      // $('#rfp_eoi_published_projected_c').css('background-color','#d8f5ee');
      // $('#work_order_projected_c').css('background-color','#d8f5ee');
    //rfp initiated
   let drafting = $(this).datepicker('getDate');
   // drafting.setMonth(drafting.getMonth()+1);
   //  $("#rfp_eoi_projected_c").datepicker('setDate',drafting);
    $('#rfp_eoi_projected_c').datepicker('option', 'minDate', drafting);

  
    
   //  // rfp published
    
   //  let published = $("#rfp_eoi_projected_c").datepicker('getDate');
   //  published.setMonth(published.getMonth()+1);
   //  $("#rfp_eoi_published_projected_c").datepicker('setDate',published);
    $('#rfp_eoi_published_projected_c').datepicker('option', 'minDate', drafting);
    
   //  //work projected
   //  let work = $("#rfp_eoi_published_projected_c").datepicker('getDate');
   //    work.setMonth(published.getMonth()+1);
   //    $("#work_order_projected_c").datepicker('setDate',work);
      $('#work_order_projected_c').datepicker('option', 'minDate', drafting);
      
       }
       
       
    
    
   
});


//rfp initiated
   let drafting = $("#scope_budget_projected_c").datepicker('getDate');
   
    
    $('#rfp_eoi_projected_c').prop("readonly",true).datepicker({
     dateFormat : 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
    minDate:drafting,
    onSelect:function(date1) {
     if($("#scope_budget_projected_c").val() == ''){
                alert("please first select DPR/Scope Budget accepted Projected date");
                $("#rfp_eoi_projected_c").val('');
            }
    }
    });
    
    //rfp eoi published
    
  $('#rfp_eoi_published_projected_c').prop("readonly",true).datepicker({
     dateFormat : 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
    minDate:drafting,
    onSelect:function() {
     if($("#scope_budget_projected_c").val() == ''){
                alert("please first select DPR/Scope Budget accepted Projected date");
                $("#rfp_eoi_published_projected_c").val('');
            }
    }
    });
    
   //work order projected
    
  $('#work_order_projected_c').prop("readonly",true).datepicker({
     dateFormat : 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
    minDate:drafting,
    onSelect:function() {
     if($("#scope_budget_projected_c").val() == ''){
                alert("please first select DPR/Scope Budget accepted Projected date");
                $("#work_order_projected_c").val('');
            }
    }
    });

//scope-budget achieved
$("#scope_budget_achieved_c").datepicker({ 
    dateFormat : 'dd/mm/yy',
    changeMonth: true,
    changeYear: true,
    beforeShow: function() {
      // let scope_achieved = $("#scope_budget_projected_c").datepicker('getDate');
      // scope_achieved.setDate(scope_achieved.getDate());
      //   $("#scope_budget_achieved_c").datepicker("option","minDate", scope_achieved);
        
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
    // let drafting_achieved = $("#rfp_eoi_projected_c").datepicker('getDate');
    // drafting_achieved.setDate(drafting_achieved.getDate());
    // $("#rfp_eoi_achieved_c").datepicker('option', 'minDate', drafting_achieved);
    
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
    // let publish_achieved = $("#rfp_eoi_published_projected_c").datepicker('getDate');
    // publish_achieved.setDate(publish_achieved.getDate());
    // $("#rfp_eoi_published_achieved_c").datepicker('option', 'minDate', publish_achieved);
    
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
    // let work_achieved = $("#work_order_projected_c").datepicker('getDate');
    // work_achieved.setDate(work_achieved.getDate());
    // $("#work_order_achieved_c").datepicker('option', 'minDate', work_achieved);
    
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

 //------------------------ making date default values---END----------------------------

var selected_country = $("#country_c").val();
$("#country_c").replaceWith('<select name="country_c" id="country_c"></select>');
  $.ajax({
    url : 'index.php?module=Opportunities&action=countryList',
        type : 'GET',
        success : function(data){
        // $("#state_c").append(data);
        if(selected_country == ""){
            var list = '<option value=""></option> +'; 
          }else{
                    var list = '<option value="'+selected_country+'">'+selected_country+'</option> +';
                }
         
             
         data=JSON.parse(data);
            data.forEach((country)=>{
                list+='<option value="'+country.nicename+'">'+country.nicename+'</option>';
              
            });
            $("#country_c").html(list);
        }
});
//------------------------------country list--------------END---------------
  

//----------------------------state list-------------------
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
//------------------------------state list--------------END---------------

//----------------------first of a kind radio button-------------------


  $('#add_new_segment_c').hide();
  $("[data-label=LBL_ADD_NEW_SEGMENT]").hide();
  $('#add_new_product_service_c').hide();
   $("[data-label=LBL_ADD_NEW_PRODUCT_SERVICE]").hide();
  
$($('div[field="first_of_a_kind_segment_c"] input:radio')).on("click", function() {
 console.log(" in");
  let new_kind = $('input[name="first_of_a_kind_segment_c"]:checked').val();
  
  if(new_kind==2){
  
  $('#segment_c').attr("disabled",false);
  $('#add_new_segment_c').hide();
  $("[data-label=LBL_ADD_NEW_SEGMENT]").hide();
  // $('#add_new_segment_c').replaceWith(`<input type="text" name="add_new_segment_c" id="add_new_segment_c" size="30" maxlength="255" value="" title="" disabled="disabled">`);
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
  $("[data-label=LBL_ADD_NEW_SEGMENT]").show();
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
 //console.log("product");
  let new_kind = $('input[name="first_of_a_kind_product_c"]:checked').val();
  
  if(new_kind==2){
  
  $('#product_service_c').attr("disabled",false);
 $('#add_new_product_service_c').hide();
   $("[data-label=LBL_ADD_NEW_PRODUCT_SERVICE]").hide();
    $('#first_kind_product1').remove();
  // $('#add_new_product_service_c').replaceWith(`<input type="text" name="add_new_product_service_c" id="add_new_product_service_c" size="30" maxlength="255" value="" title="" disabled="disabled">`);
  //$('#first_kind_product').remove();
 
  $('#first_of_a_kind_product_c[type=radio][value="1"]').attr("disabled",false);
  
  $('#first_of_a_kind_segment_c[type=radio]').attr("disabled",false);
  
}else{
  
  $('#product_service_c').attr("disabled",true);
  $('#add_new_product_service_c').attr("disabled",false);
  $('#add_new_product_service_c').show();
   $("[data-label=LBL_ADD_NEW_PRODUCT_SERVICE]").show();
  $('#add_new_product_service_c').replaceWith(`<input type="text" name="add_new_product_service_c" id="add_new_product_service_c" size="30" maxlength="255" value="" title="" ><input type="button" class="btn button" id="first_kind_product1" value="Add Product"/ >`);
  $('#first_of_a_kind_product_c[type=radio][value="1"]').attr("disabled",true);
   $('#first_of_a_kind_product_c[type=radio][value="2"]').attr("disabled",false);
   
   $('#first_of_a_kind_segment_c[type=radio]').attr("disabled",true);
}
  

});


// ............... storing new segment and new product ............................
$(document).on("click","#first_kind_segment",function() {
// console.log("first of kind");

 var segment = $('#add_new_segment_c').val();
  
    if(segment != "" ){
     
     
    $.ajax({
     url:
        "index.php?module=Opportunities&action=firstSegment",
      type: "POST",
     
      data: { segment:segment},
       success:function(data){
       // /console.log(data);
       alert (data);
        //window.location.reload();
        
        if(data!=""){
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
         var   optionText = 'Not Available'; 
           var  optionValue = 'notAvailable';
            $("#segment_c").append($('<option>').val(optionValue).text(optionText));
            $("#segment_c").val(segment);
            $('#add_new_segment_c').hide();
            $("[data-label=LBL_ADD_NEW_SEGMENT]").hide();
            $('#first_kind_segment').remove();
            $("option[value=notAvailable]").attr("disabled", false);
            
        }
});
         
        }
         
        
      }
      
    })
    
  
    
     
    }else{
      alert("Please enter Segment field");
    }
    
    
    
    
});

// ............... storing new segment and new product ......END......................

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
       //console.log(data);
       alert (data);
        //window.location.reload();
        
        if (data!="") {
         
      //  $('#segment_c').val(segment);
        $('#product_service_c').val('');
        var selected_service = $("#product_service_c").val();
  $("#product_service_c").replaceWith('<select name="product_service_c" id="product_service_c"></select>');

    if(selected_service == ""){
      $.ajax({
      type: "POST",
      url:
        "index.php?module=Opportunities&action=productService",
      data: { segment_name:segment },
      success: function (data) {
            var list = '<option value="'+selected_service+'">'+selected_service+'</option> +';
          data=JSON.parse(data);
            data.forEach((service)=>{
              if(service.service_name != selected_service){
                list+='<option value="'+service.service_name+'">'+service.service_name+'</option>';
              }
            });
            $("#product_service_c").html(list);
              var   optionText = 'Not Available'; 
           var  optionValue = 'notAvailable';
            $("#product_service_c").append($('<option>').val(optionValue).text(optionText));
            $("#product_service_c").val(service);
       
      },
    });
    }
       
       $('#add_new_product_service_c').hide();
       $("[data-label=LBL_ADD_NEW_PRODUCT_SERVICE]").hide();
       $('#first_kind_product1').remove();
       $("option[value=notAvailable]").attr("disabled", false);
         
         
        }
      }
      
      
    })
    
    
    }else if(segment ==""){
      alert("Please select Segment from dropdown");
    }else if(service ==""){
     alert("Please enter the new product/service");
    }
    
    
  // ----- storing only product/service ------------------------
  
});


 // ----- storing only product/service -------------END-----------


//----------------------------color change for 3 buttons in scope-----------------------
// console.log($("#selection_c").val());
  // $("#selection_c").css('background-color','#2ecc71');
  
  $("#selection_c").on("click", function () {
              if ($(this).val()=='Red' ){
                  $(this).css('background-color','#de3b33');
              }else if($(this).val()=='Green'){
                $(this).css('background-color','#2ecc71');
              }else if($(this).val()=='Yellow'){
                $(this).css('background-color','#feca57');
              }else{
                $(this).css('background-color','#FFFFFF');
              }
            });
  
  // $("#funding_c").css('background-color','#2ecc71');
  
  $("#funding_c").on("click", function () {
              if ($(this).val()=='Red' ){
                  $(this).css('background-color','#de3b33');
              }else if($(this).val()=='Green'){
                $(this).css('background-color','#2ecc71');
              }else if($(this).val()=='Yellow'){
                $(this).css('background-color','#feca57');
              }else{
                $(this).css('background-color','#FFFFFF');
              }
            });
   
  // $("#timing_button_c").css('background-color','#2ecc71'); 
  
  $("#timing_button_c").on("click", function () {
              if ($(this).val()=='Red' ){
                  $(this).css('background-color','#de3b33');
              }else if($(this).val()=='Green'){
                $(this).css('background-color','#2ecc71');
              }else if($(this).val()=='Yellow'){
                $(this).css('background-color','#feca57');
              }else{
                $(this).css('background-color','#FFFFFF');
              }
            });
            
            
//----------------------------color change for 3 buttons in scope---------END--------------



//==================== fields color red to normal after validation========================

$("#assigned_to_new_c").on("click", function () {
  //console.log("if in");

  if ($("#assigned_to_new_c").css("background-color", "Red")) {
    // console.log("check in");

    $("#assigned_to_new_c").css("background-color", "#d8f5ee");
  }
});


$("#currency_c").on("click", function () {
 
  if ($("#currency_c").css("background-color", "Red")) {
    
    $("#currency_c").css("background-color", "#d8f5ee");
  }
});

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

$("#account_name").on("click", function () {
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



$("#risk_c").on("click", function () {
  if ($("#risk_c").css("background-color", "Red")) {
    $("#risk_c").css("background-color", "#d8f5ee");
  }
});

$("#country_c").on("click", function () {
  if ($("#country_c").css("background-color", "Red")) {
    $("#country_c").css("background-color", "#d8f5ee");
  }
});

$("#project_scope_c").on("click", function () {
  if ($("#project_scope_c").css("background-color", "Red")) {
    $("#project_scope_c").css("background-color", "#d8f5ee");
  }
});

$("#new_department_c").on("click", function () {
  if ($("#new_department_c").css("background-color", "Red")) {
    $("#new_department_c").css("background-color", "#d8f5ee");
  }
});


//==================== fields color red to normal after validation========================



//---------------------------Reset Button for Cash flow------------------------

$('#reset').click(function () {
 $('#first_form').show();
  $('#first_form').attr('disabled',false);
   
 
 if (confirm('Are you sure to reset?')) {
   console.log('asdas');
   $('#startYear,#endYear,#total_input_value').val("");
   
   
   $( "#total_value_1").html('<tbody><tr><td  name="2" style="min-width: 125px"><center><b>Project Value in Rs(in Cr)</b></center></td><td><input id="total_input_value"  required name="" type="text"/></td> </tr></tbody>');
                          
                         
                
                      
   var text = ` <thead>
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
            <input class="row_add col_add" required name="" type="text"/>
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
            <input class="row_add col_add" id="tender1" required name="TenderFee" type="text"/>
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
            <input class="row_add col_add" required name="EMD" type="text"/>
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
            <input class="row_add col_add"  required name="" type="text"/>
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
            <input class="row_add col_add" required name="" type="text"/>
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
            <input class="row_add col_add"  required name="" type="text"/>
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
            <input class="row_add col_add" required name="" type="text"/>
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
            <input class="row_add col_add" required name="" type="text"/>
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
            <input class="row_add col_add" required name="" type="text"/>
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
            <input  class="row_add col_add" required name="" type="text"/>
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
//---------------------------Reset Button for Cash flow-----------END-------------






//-----------saving l1 and l2 template on Main opportunity save button-------------------

$(document).on('click', function () {
   
      var multiple_approver_c=$('#select_approver_c').val();
          var myJSON=$('#multiple_approver_c').val();
          if(typeof(multiple_approver_c)==='string'){
           
           myJSON
          
          }else{
           
          myJSON = multiple_approver_c.join();
           
          }
         //alert(myJSON);
        $('#multiple_approver_c').val(myJSON);
        
      
  });

    

$(document).on('click','#SAVE_HEADER',function() {
    
   
  
    //------------------------------------------Department adding ----------------------------------------------------
var d_name = $("#new_department_c").val();

 $.ajax({
                url : 'index.php?module=Opportunities&action=department_Save',
                type : 'POST',
                dataType: "json",
                 data :
                    {
                      d_name,
                    },
                success : function(data){
                 
                 
                }
            });
            
//-----------------------------------------Department END-------------------------------------
 
   var untag1=$("#untagged_users_c").val();
       
        if(untag1!=null){
        
        var untag=untag1.join();
        $('#untagged_hidden_c').val(untag);
        }
        
       var tag1=$("#tagged_users_c").val();
       
       if(tag1!=null){
        
       var tag=tag1.join();
       
       $('#tagged_hiden_c').val(tag);
       
       }else{
        $('#tagged_hiden_c').val('');
       }
 
   var tagged=$('#tagged_hiden_c').val();
   var untagged=$('#untagged_hidden_c').val();
   var opp_name=$('#name').val();
var base_url = window.location.href.split('?')[0];  

    $.ajax({
                url : 'index.php?module=Opportunities&action=save_untagged_users_list',
                type : 'POST',
                dataType: "json",
                data:{
                 opps_id,
                 untagged
                },
                 
                success : function(data){
                 
                 
                }
     
    })
     var assigned_id = $("#assigned_user_id").val();
     $.ajax({
                url : 'index.php?module=Opportunities&action=save_tagged_users_list',
                type : 'POST',
                dataType: "json",
                data:{
                 opps_id,
                 tagged,
                 opp_name,
                 base_url,
                 assigned_id
                },
                 
                success : function(data){
                
                 //alert(data);
                 
                }
     
    })
 
 

 if($("#status_c").val()=="QualifiedLead" && $('#rfporeoipublished_c').val()=='yes'){
// alert("QL");
 
 //$('#multiple_approver_c').val($('#select_approver_c').val());

 var id=$('#EditView input[name=record]').val();
 var total_input_value=$('#total_input_value').val();
      var l1_html;
      var l1_input=[];
      $('#total_value input').each(function() {
        l1_input.push($(this).val());
      });
      l1_html=$('#total_value').html();
    //   console.log(l1_html,l1_input);
  //     $.ajax({
  //       url : 'index.php?module=Opportunities&action=l1',
  //       type : 'POST',
  //       dataType: "json",
  //         data :
  //           {
  //               id,
  //               l1_html,
  //               l1_input,
  //               total_input_value
  //           },
  //           success: function (data) {
                
  //              // alert(data.message);
  //              // $("#myForm").css("display","none");
                
  //              //  console.log(data.message);
  //           }
  // });
 
 var l2_html;
      var l2_input=[];
      $('#mtenth input').each(function() {
        l2_input.push($(this).val());
      });
      l2_html=$('#mtenth').html();
    
  //     $.ajax({
  //       url : 'index.php?module=Opportunities&action=l2',
  //       type : 'POST',
  //       dataType: "json",
  //         data :
  //           {
  //               id,
  //               l2_html,
  //               l2_input
  //           },
  //           success: function (data) {
                    
  //               // alert(data.message);
  //              // $("#myForm").css("display","none");
                
  //               // console.log(data);
  //           }
  // });
  

  
 var start_year=$('#startYear').val();
    var end_year=$('#endYear').val();
    var start_quarter=$('#start_quarter').val();
    var end_quarter=$('#end_quarter').val();
    var no_of_bidders=$('#bid').val();
   
    
   
   
    
    if(start_year!=''&& start_quarter !=''&& end_quarter!=''&& end_year !=''){
      
     //  alert(start_year+start_quarter+end_year+end_quarter+no_of_bidders);
      var id=$('#EditView input[name=record]').val();
   
  //     $.ajax({
  //       url : 'index.php?module=Opportunities&action=year_quarters',
  //       type : 'POST',
  //         data :
  //           {
  //               id,
  //               start_year,
  //               end_year,
  //               start_quarter,
  //                end_quarter,
  //                no_of_bidders,
  //                total_input_value
  //           },
  //           success: function (data) {
                
                
  //           }
  // });
  
    }
   
}

else if($("#status_c").val()=="QualifiedLead" && $('#rfporeoipublished_c').val()=='no'){
// alert("QL");
 var id=$('#EditView input[name=record]').val();
 var total_input_value=$('#total_input_value').val();
      var l1_html;
      var l1_input=[];
      $('#total_value input').each(function() {
        l1_input.push($(this).val());
      });
      l1_html=$('#total_value').html();
    //   console.log(l1_html,l1_input);
  //     $.ajax({
  //       url : 'index.php?module=Opportunities&action=l1',
  //       type : 'POST',
  //       dataType: "json",
  //         data :
  //           {
  //               id,
  //               l1_html,
  //               l1_input,
  //               total_input_value
  //           },
  //           success: function (data) {
                
  //              // alert(data.message);
  //              // $("#myForm").css("display","none");
                
  //               // console.log(data.message);
  //           }
  // });
 

  

  
 var start_year=$('#startYear').val();
    var end_year=$('#endYear').val();
    var start_quarter=$('#start_quarter').val();
    var end_quarter=$('#end_quarter').val();
    var no_of_bidders=$('#bid').val();
   
    
   
   
    
    if(start_year!=''&& start_quarter !=''&& end_quarter!=''&& end_year !=''){
      
     //  alert(start_year+start_quarter+end_year+end_quarter+no_of_bidders);
      var id=$('#EditView input[name=record]').val();
   
  //     $.ajax({
  //       url : 'index.php?module=Opportunities&action=year_quarters',
  //       type : 'POST',
  //         data :
  //           {
  //               id,
  //               start_year,
  //               end_year,
  //               start_quarter,
  //                end_quarter,
  //                no_of_bidders,
  //                total_input_value
  //           },
  //           success: function (data) {
                
                
  //           }
  // });
  
    }
   
}

else if($("#status_c").val()=="QualifiedLead" && $('#rfporeoipublished_c').val()=='not_required'){
// alert("QL");
 var id=$('#EditView input[name=record]').val();
 var total_input_value=$('#total_input_value').val();
      var l1_html;
      var l1_input=[];
      $('#total_value input').each(function() {
        l1_input.push($(this).val());
      });
      l1_html=$('#total_value').html();
    //   console.log(l1_html,l1_input);
//       $.ajax({
//         url : 'index.php?module=Opportunities&action=l1',
//         type : 'POST',
//         dataType: "json",
//           data :
//             {
//                 id,
//                 l1_html,
//                 l1_input,
//                 total_input_value
//             },
//             success: function (data) {
                
//               // alert(data.message);
//               // $("#myForm").css("display","none");
                
//                 // console.log(data.message);
//             }
//   });
 

  

  
 var start_year=$('#startYear').val();
    var end_year=$('#endYear').val();
    var start_quarter=$('#start_quarter').val();
    var end_quarter=$('#end_quarter').val();
    var no_of_bidders=$('#bid').val();
   
    
   
   
    
    if(start_year!=''&& start_quarter !=''&& end_quarter!=''&& end_year !=''){
      
     //  alert(start_year+start_quarter+end_year+end_quarter+no_of_bidders);
      var id=$('#EditView input[name=record]').val();
   
//       $.ajax({
//         url : 'index.php?module=Opportunities&action=year_quarters',
//         type : 'POST',
//           data :
//             {
//                 id,
//                 start_year,
//                 end_year,
//                 start_quarter,
//                  end_quarter,
//                  no_of_bidders,
//                  total_input_value
//             },
//             success: function (data) {
                
                
//             }
//   });
  
    }
   
}

else if($("#status_c").val()=="Qualified"){
  //alert("QO");

var id=$('#EditView input[name=record]').val();
 var total_input_value=$('#total_input_value').val();
      var l1_html;
      var l1_input=[];
      $('#total_value input').each(function() {
        l1_input.push($(this).val());
      });
      l1_html=$('#total_value').html();
    //   console.log(l1_html,l1_input);
//       $.ajax({
//         url : 'index.php?module=Opportunities&action=l1',
//         type : 'POST',
//         dataType: "json",
//           data :
//             {
//                 id,
//                 l1_html,
//                 l1_input,
//                 total_input_value
//             },
//             success: function (data) {
                
//               // alert(data.message);
//               // $("#myForm").css("display","none");
                
//                 // console.log(data.message);
//             }
//   });
 
 
 var l2_html;
      var l2_input=[];
      $('#mtenth input').each(function() {
        l2_input.push($(this).val());
      });
      l2_html=$('#mtenth').html();
    
//       $.ajax({
//         url : 'index.php?module=Opportunities&action=l2',
//         type : 'POST',
//         dataType: "json",
//           data :
//             {
//                 id,
//                 l2_html,
//                 l2_input
//             },
//             success: function (data) {
                    
//                 // alert(data.message);
//               // $("#myForm").css("display","none");
                
//                 // console.log(data);
//             }
//   });
  
  // --------------- saving for  DPR bidchecklist--------------------------------
  
  if($("#status_c").val()=="Qualified"){
      
     var id=$('#EditView input[name=record]').val();
    var emd_array =[];
    var pbg_array = [];
    $('#three .row_add').each(function(){
        emd_array.push($(this).val());
        
        var rex = /\S/;
emd_array = emd_array.filter(rex.test.bind(rex));
    });
    
    $('#four .row_add').each(function(){
        pbg_array.push($(this).val());
        
        var rex = /\S/;
pbg_array = pbg_array.filter(rex.test.bind(rex));
    });
    
     var start_year=$('#startYear').val();
        var end_year=$('#endYear').val();
        var fields1= start_year.split(/-/);
    var start1 = fields1[0];
   
    
    var fields2=  end_year.split(/-/);
    var end2= fields2[1];
    
    
    var tenure=end2-start1;
    
    var project_value = $("#tot_values td:last-child input").val();
    var emd=emd_array[1];
    var pbg=pbg_array[1];
    var project_scope = $("#project_scope_c").val();
   var total_input_value=$('#total_input_value').val();
//   console.log(project_scope);
    
     $.ajax({
        url : 'index.php?module=Opportunities&action=dpr_bidchecklist',
        type : 'POST',
        dataType: "json",
          data :
            {
                id,
                emd,
                pbg,
                tenure,
                project_value,
                project_scope,
                total_input_value
                
            },
            success: function (data) {
                    
                //  alert(data.message);
                // // $("#myForm").css("display","none");
                
                console.log(data);
            }
  });
    
    
  }
  
 
  
 // --------------- saving for DPR bidchecklist-end------------------------------- 
 
 //---------------------saving for  Bid bidchecklist---------------------------
  if($("#status_c").val()=="QualifiedDpr"|| $("#status_c").val()=="QualifiedBid"||$("#status_c").val()=="Closed"){
      
     var id=$('#EditView input[name=record]').val();
    var emd_array =[];
    var pbg_array = [];
    $('#three .row_add').each(function(){
        emd_array.push($(this).val());
        
        var rex = /\S/;
emd_array = emd_array.filter(rex.test.bind(rex));
    });
    
    $('#four .row_add').each(function(){
        pbg_array.push($(this).val());
        
        var rex = /\S/;
pbg_array = pbg_array.filter(rex.test.bind(rex));
    });
    
     var start_year=$('#startYear').val();
        var end_year=$('#endYear').val();
        var fields1= start_year.split(/-/);
    var start1 = fields1[0];
   
    
    var fields2=  end_year.split(/-/);
    var end2= fields2[1];
    
    
    var tenure=end2-start1;
    
    var project_value = $("#tot_values td:last-child input").val();
    var emd=emd_array[1];
    var pbg=pbg_array[1];
    var project_scope =  $("#project_scope_c").val();
   var total_input_value=$('#total_input_value').val();
    // console.log(project_value,emd,pbg,project_scope,id,tenure);
    
     $.ajax({
        url : 'index.php?module=Opportunities&action=bid_bidchecklist',
        type : 'POST',
        dataType: "json",
          data :
            {
                id,
                emd,
                pbg,
                tenure,
                project_value,
                project_scope,
                total_input_value
            },
            success: function (data) {
                    
                 // alert(data.message);
                // // $("#myForm").css("display","none");
                
                console.log(data);
            }
  });
    
    
  }
  
  
  
 var start_year=$('#startYear').val();
    var end_year=$('#endYear').val();
    var start_quarter=$('#start_quarter').val();
    var end_quarter=$('#end_quarter').val();
    var no_of_bidders=$('#bid').val();
   
    
   
   
    
    if(start_year!=''&& start_quarter !=''&& end_quarter!=''&& end_year !=''){
      
       
      var id=$('#EditView input[name=record]').val();
   
//       $.ajax({
//         url : 'index.php?module=Opportunities&action=year_quarters',
//         type : 'POST',
//           data :
//             {
//                 id,
//                 start_year,
//                 end_year,
//                 start_quarter,
//                  end_quarter,
//                  no_of_bidders,
//                  total_input_value
//             },
//             success: function (data) {
                
                
//             }
//   });
  
    }
    
}

else if($("#status_c").val()=="QualifiedDpr"){
 // alert("QD");
// $('#multiple_approver_c').val($('#select_approver_c').val());
 var id=$('#EditView input[name=record]').val();
 var total_input_value=$('#total_input_value').val();
      var l1_html;
      var l1_input=[];
      $('#total_value input').each(function() {
        l1_input.push($(this).val());
      });
      l1_html=$('#total_value').html();
    //   console.log(l1_html,l1_input);
//       $.ajax({
//         url : 'index.php?module=Opportunities&action=l1',
//         type : 'POST',
//         dataType: "json",
//           data :
//             {
//                 id,
//                 l1_html,
//                 l1_input,
//                 total_input_value
//             },
//             success: function (data) {
                
//               // alert(data.message);
//               // $("#myForm").css("display","none");
                
//                 // console.log(data.message);
//             }
//   });
 
 
 var l2_html;
      var l2_input=[];
      $('#mtenth input').each(function() {
        l2_input.push($(this).val());
      });
      l2_html=$('#mtenth').html();
    
//       $.ajax({
//         url : 'index.php?module=Opportunities&action=l2',
//         type : 'POST',
//         dataType: "json",
//           data :
//             {
//                 id,
//                 l2_html,
//                 l2_input
//             },
//             success: function (data) {
                    
//                 // alert(data.message);
//               // $("#myForm").css("display","none");
                
//                 // console.log(data);
//             }
//   });
  
   // --------------- saving for  DPR bidchecklist--------------------------------
  
  if($("#status_c").val()=="Qualified"){
      
     var id=$('#EditView input[name=record]').val();
    var emd_array =[];
    var pbg_array = [];
    $('#three .row_add').each(function(){
        emd_array.push($(this).val());
        
        var rex = /\S/;
emd_array = emd_array.filter(rex.test.bind(rex));
    });
    
    $('#four .row_add').each(function(){
        pbg_array.push($(this).val());
        
        var rex = /\S/;
pbg_array = pbg_array.filter(rex.test.bind(rex));
    });
    
     var start_year=$('#startYear').val();
        var end_year=$('#endYear').val();
        var fields1= start_year.split(/-/);
    var start1 = fields1[0];
   
    
    var fields2=  end_year.split(/-/);
    var end2= fields2[1];
    
    
    var tenure=end2-start1;
    
    var project_value = $("#tot_values td:last-child input").val();
    var emd=emd_array[1];
    var pbg=pbg_array[1];
    var project_scope = $("#project_scope_c").val();
   var total_input_value=$('#total_input_value').val();
//   console.log(project_scope);
    
     $.ajax({
        url : 'index.php?module=Opportunities&action=dpr_bidchecklist',
        type : 'POST',
        dataType: "json",
          data :
            {
                id,
                emd,
                pbg,
                tenure,
                project_value,
                project_scope,
                total_input_value
                
            },
            success: function (data) {
                    
                //  alert(data.message);
                // // $("#myForm").css("display","none");
                
                console.log(data);
            }
  });
    
    
  }
  
 
  
 // --------------- saving for DPR bidchecklist-end------------------------------- 
 
 //---------------------saving for  Bid bidchecklist---------------------------
  if($("#status_c").val()=="QualifiedDpr"|| $("#status_c").val()=="QualifiedBid"||$("#status_c").val()=="Closed"){
      
     var id=$('#EditView input[name=record]').val();
    var emd_array =[];
    var pbg_array = [];
    $('#three .row_add').each(function(){
        emd_array.push($(this).val());
        
        var rex = /\S/;
emd_array = emd_array.filter(rex.test.bind(rex));
    });
    
    $('#four .row_add').each(function(){
        pbg_array.push($(this).val());
        
        var rex = /\S/;
pbg_array = pbg_array.filter(rex.test.bind(rex));
    });
    
     var start_year=$('#startYear').val();
        var end_year=$('#endYear').val();
        var fields1= start_year.split(/-/);
    var start1 = fields1[0];
   
    
    var fields2=  end_year.split(/-/);
    var end2= fields2[1];
    
    
    var tenure=end2-start1;
    
    var project_value = $("#tot_values td:last-child input").val();
    var emd=emd_array[1];
    var pbg=pbg_array[1];
    var project_scope =  $("#project_scope_c").val();
   var total_input_value=$('#total_input_value').val();
    // console.log(project_value,emd,pbg,project_scope,id,tenure);
    
     $.ajax({
        url : 'index.php?module=Opportunities&action=bid_bidchecklist',
        type : 'POST',
        dataType: "json",
          data :
            {
                id,
                emd,
                pbg,
                tenure,
                project_value,
                project_scope,
                total_input_value
            },
            success: function (data) {
                    
                 // alert(data.message);
                // // $("#myForm").css("display","none");
                
                console.log(data);
            }
  });
    
    
  }
  
  
  
 var start_year=$('#startYear').val();
    var end_year=$('#endYear').val();
    var start_quarter=$('#start_quarter').val();
    var end_quarter=$('#end_quarter').val();
    var no_of_bidders=$('#bid').val();
   
    
   
   
    
    if(start_year!=''&& start_quarter !=''&& end_quarter!=''&& end_year !=''){
      
       
      var id=$('#EditView input[name=record]').val();
   
//       $.ajax({
//         url : 'index.php?module=Opportunities&action=year_quarters',
//         type : 'POST',
//           data :
//             {
//                 id,
//                 start_year,
//                 end_year,
//                 start_quarter,
//                  end_quarter,
//                  no_of_bidders,
//                  total_input_value
//             },
//             success: function (data) {
                
                
//             }
//   });
  
    }
   
}

else if($("#status_c").val()=="QualifiedBid"){
  //alert("QB");
 // $('#multiple_approver_c').val($('#select_approver_c').val());
 var id=$('#EditView input[name=record]').val();
 var total_input_value=$('#total_input_value').val();
      var l1_html;
      var l1_input=[];
      $('#total_value input').each(function() {
        l1_input.push($(this).val());
      });
      l1_html=$('#total_value').html();
    //   console.log(l1_html,l1_input);
//       $.ajax({
//         url : 'index.php?module=Opportunities&action=l1',
//         type : 'POST',
//         dataType: "json",
//           data :
//             {
//                 id,
//                 l1_html,
//                 l1_input,
//                 total_input_value
//             },
//             success: function (data) {
                
//               // alert(data.message);
//               // $("#myForm").css("display","none");
                
//                 // console.log(data.message);
//             }
//   });
 
 
 var l2_html;
      var l2_input=[];
      $('#mtenth input').each(function() {
        l2_input.push($(this).val());
      });
      l2_html=$('#mtenth').html();
    
//       $.ajax({
//         url : 'index.php?module=Opportunities&action=l2',
//         type : 'POST',
//         dataType: "json",
//           data :
//             {
//                 id,
//                 l2_html,
//                 l2_input
//             },
//             success: function (data) {
                    
//                 // alert(data.message);
//               // $("#myForm").css("display","none");
                
//                 // console.log(data);
//             }
//   });
  
 // --------------- saving for  DPR bidchecklist--------------------------------
  
  if($("#status_c").val()=="Qualified"){
      
     var id=$('#EditView input[name=record]').val();
    var emd_array =[];
    var pbg_array = [];
    $('#three .row_add').each(function(){
        emd_array.push($(this).val());
        
        var rex = /\S/;
emd_array = emd_array.filter(rex.test.bind(rex));
    });
    
    $('#four .row_add').each(function(){
        pbg_array.push($(this).val());
        
        var rex = /\S/;
pbg_array = pbg_array.filter(rex.test.bind(rex));
    });
    
     var start_year=$('#startYear').val();
        var end_year=$('#endYear').val();
        var fields1= start_year.split(/-/);
    var start1 = fields1[0];
   
    
    var fields2=  end_year.split(/-/);
    var end2= fields2[1];
    
    
    var tenure=end2-start1;
    
    var project_value = $("#tot_values td:last-child input").val();
    var emd=emd_array[1];
    var pbg=pbg_array[1];
    var project_scope = $("#project_scope_c").val();
   var total_input_value=$('#total_input_value').val();
//   console.log(project_scope);
    
     $.ajax({
        url : 'index.php?module=Opportunities&action=dpr_bidchecklist',
        type : 'POST',
        dataType: "json",
          data :
            {
                id,
                emd,
                pbg,
                tenure,
                project_value,
                project_scope,
                total_input_value
                
            },
            success: function (data) {
                    
                //  alert(data.message);
                // // $("#myForm").css("display","none");
                
                console.log(data);
            }
  });
    
    
  }
  
 
  
 // --------------- saving for DPR bidchecklist-end------------------------------- 
 
 //---------------------saving for  Bid bidchecklist---------------------------
  if($("#status_c").val()=="QualifiedDpr"|| $("#status_c").val()=="QualifiedBid"||$("#status_c").val()=="Closed"){
      
     var id=$('#EditView input[name=record]').val();
    var emd_array =[];
    var pbg_array = [];
    $('#three .row_add').each(function(){
        emd_array.push($(this).val());
        
        var rex = /\S/;
emd_array = emd_array.filter(rex.test.bind(rex));
    });
    
    $('#four .row_add').each(function(){
        pbg_array.push($(this).val());
        
        var rex = /\S/;
pbg_array = pbg_array.filter(rex.test.bind(rex));
    });
    
     var start_year=$('#startYear').val();
        var end_year=$('#endYear').val();
        var fields1= start_year.split(/-/);
    var start1 = fields1[0];
   
    
    var fields2=  end_year.split(/-/);
    var end2= fields2[1];
    
    
    var tenure=end2-start1;
    
    var project_value = $("#tot_values td:last-child input").val();
    var emd=emd_array[1];
    var pbg=pbg_array[1];
    var project_scope =  $("#project_scope_c").val();
   var total_input_value=$('#total_input_value').val();
    // console.log(project_value,emd,pbg,project_scope,id,tenure);
    
     $.ajax({
        url : 'index.php?module=Opportunities&action=bid_bidchecklist',
        type : 'POST',
        dataType: "json",
          data :
            {
                id,
                emd,
                pbg,
                tenure,
                project_value,
                project_scope,
                total_input_value
            },
            success: function (data) {
                    
                 // alert(data.message);
                // // $("#myForm").css("display","none");
                
                console.log(data);
            }
  });
    
    
  }
 var start_year=$('#startYear').val();
    var end_year=$('#endYear').val();
    var start_quarter=$('#start_quarter').val();
    var end_quarter=$('#end_quarter').val();
    var no_of_bidders=$('#bid').val();
   
    
   
   
    
    if(start_year!=''&& start_quarter !=''&& end_quarter!=''&& end_year !=''){
      
       
      var id=$('#EditView input[name=record]').val();
   
//       $.ajax({
//         url : 'index.php?module=Opportunities&action=year_quarters',
//         type : 'POST',
//           data :
//             {
//                 id,
//                 start_year,
//                 end_year,
//                 start_quarter,
//                  end_quarter,
//                  no_of_bidders,
//                  total_input_value
//             },
//             success: function (data) {
                
                
//             }
//   });
  
    }
   
}

else if($("#status_c").val()=="Closed"){
 // alert("C");
// $('#multiple_approver_c').val($('#select_approver_c').val());
var id=$('#EditView input[name=record]').val();
 var total_input_value=$('#total_input_value').val();
      var l1_html;
      var l1_input=[];
      $('#total_value input').each(function() {
        l1_input.push($(this).val());
      });
      l1_html=$('#total_value').html();
    //   console.log(l1_html,l1_input);
//       $.ajax({
//         url : 'index.php?module=Opportunities&action=l1',
//         type : 'POST',
//         dataType: "json",
//           data :
//             {
//                 id,
//                 l1_html,
//                 l1_input,
//                 total_input_value
//             },
//             success: function (data) {
                
//               // alert(data.message);
//               // $("#myForm").css("display","none");
                
//                 // console.log(data.message);
//             }
//   });
 
 var l2_html;
      var l2_input=[];
      $('#mtenth input').each(function() {
        l2_input.push($(this).val());
      });
      l2_html=$('#mtenth').html();
    
//       $.ajax({
//         url : 'index.php?module=Opportunities&action=l2',
//         type : 'POST',
//         dataType: "json",
//           data :
//             {
//                 id,
//                 l2_html,
//                 l2_input
//             },
//             success: function (data) {
                    
//                 // alert(data.message);
//               // $("#myForm").css("display","none");
                
//                 // console.log(data);
//             }
//   });
  
 // --------------- saving for  DPR bidchecklist--------------------------------
  
  if($("#status_c").val()=="Qualified"){
      
     var id=$('#EditView input[name=record]').val();
    var emd_array =[];
    var pbg_array = [];
    $('#three .row_add').each(function(){
        emd_array.push($(this).val());
        
        var rex = /\S/;
emd_array = emd_array.filter(rex.test.bind(rex));
    });
    
    $('#four .row_add').each(function(){
        pbg_array.push($(this).val());
        
        var rex = /\S/;
pbg_array = pbg_array.filter(rex.test.bind(rex));
    });
    
     var start_year=$('#startYear').val();
        var end_year=$('#endYear').val();
        var fields1= start_year.split(/-/);
    var start1 = fields1[0];
   
    
    var fields2=  end_year.split(/-/);
    var end2= fields2[1];
    
    
    var tenure=end2-start1;
    
    var project_value = $("#tot_values td:last-child input").val();
    var emd=emd_array[1];
    var pbg=pbg_array[1];
    var project_scope = $("#project_scope_c").val();
   var total_input_value=$('#total_input_value').val();
//   console.log(project_scope);
    
     $.ajax({
        url : 'index.php?module=Opportunities&action=dpr_bidchecklist',
        type : 'POST',
        dataType: "json",
          data :
            {
                id,
                emd,
                pbg,
                tenure,
                project_value,
                project_scope,
                total_input_value
                
            },
            success: function (data) {
                    
                //  alert(data.message);
                // // $("#myForm").css("display","none");
                
                console.log(data);
            }
  });
    
    
  }
  
 
  
 // --------------- saving for DPR bidchecklist-end------------------------------- 
 
 //---------------------saving for  Bid bidchecklist---------------------------
  if($("#status_c").val()=="QualifiedDpr"|| $("#status_c").val()=="QualifiedBid"||$("#status_c").val()=="Closed"){
      
     var id=$('#EditView input[name=record]').val();
    var emd_array =[];
    var pbg_array = [];
    $('#three .row_add').each(function(){
        emd_array.push($(this).val());
        
        var rex = /\S/;
emd_array = emd_array.filter(rex.test.bind(rex));
    });
    
    $('#four .row_add').each(function(){
        pbg_array.push($(this).val());
        
        var rex = /\S/;
pbg_array = pbg_array.filter(rex.test.bind(rex));
    });
    
     var start_year=$('#startYear').val();
        var end_year=$('#endYear').val();
        var fields1= start_year.split(/-/);
    var start1 = fields1[0];
   
    
    var fields2=  end_year.split(/-/);
    var end2= fields2[1];
    
    
    var tenure=end2-start1;
    
    var project_value = $("#tot_values td:last-child input").val();
    var emd=emd_array[1];
    var pbg=pbg_array[1];
    var project_scope =  $("#project_scope_c").val();
   var total_input_value=$('#total_input_value').val();
    // console.log(project_value,emd,pbg,project_scope,id,tenure);
    
     $.ajax({
        url : 'index.php?module=Opportunities&action=bid_bidchecklist',
        type : 'POST',
        dataType: "json",
          data :
            {
                id,
                emd,
                pbg,
                tenure,
                project_value,
                project_scope,
                total_input_value
            },
            success: function (data) {
                    
                 // alert(data.message);
                // // $("#myForm").css("display","none");
                
                console.log(data);
            }
  });
    
    
  }
  
  
  
  
 var start_year=$('#startYear').val();
    var end_year=$('#endYear').val();
    var start_quarter=$('#start_quarter').val();
    var end_quarter=$('#end_quarter').val();
    var no_of_bidders=$('#bid').val();
   
    
   
   
    
    if(start_year!=''&& start_quarter !=''&& end_quarter!=''&& end_year !=''){
      
       
      var id=$('#EditView input[name=record]').val();
   
//       $.ajax({
//         url : 'index.php?module=Opportunities&action=year_quarters',
//         type : 'POST',
//           data :
//             {
//                 id,
//                 start_year,
//                 end_year,
//                 start_quarter,
//                  end_quarter,
//                  no_of_bidders,
//                  total_input_value
//             },
//             success: function (data) {
                
                
//             }
//   });
  
    }
   
}



 });



//-----------saving l1 and l2 template on Main opportunity save button----END---------------



 
 
 //------------------ aprover selection checking process --------------------------
 
 $('#select_approver_c').on('change', function(e) {
  
        var aprover_id = $('#user_id2_c').val();
       
        if (aprover_id != ''){
          console.log(aprover_id);
            $.ajax({
                url : 'index.php?module=Opportunities&action=aprover_check',
                type : 'POST',
                dataType: "json",
                 data :
                    {
                        aprover_id:aprover_id,
                    },
                success : function(data){
                 
                 
                 
                   if(data.status == true){
                       if(data.approver == 'no'){
                      //  console.log("approve");
                           $('#user_id2_c').val('');
                           $('#select_approver_c').val('');
                           if($('.message_lbl').text().length == 0){
                                $('[field=select_approver_c]').append("<span class='message_lbl' style='color:red;'>"+"<br>"+data.message+"</span>");
                            }
                       }else{
                           $('.message_lbl').remove();
                       }
                   }else{
                    //console.log("redirect");
                       window.location.replace("index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26action%3Dindex%26return_module%3DOpportunities%26return_action%3DDetailView");
                   }
                 }
            });
        }
       
    });

//------------------ aprover selection checking process -----END---------------------
  
 
 //---------------------------International Opportunity------------------------------------------   
 
   //-------------------------------on load-------------------------------------------
   
   let new_kind1 = $('input[name="international_c"]:checked').val();
 
  if(new_kind1 =='yes'){

 $('#state_c').hide();
 $("[data-label=LBL_STATE]").hide();
 $('#state_c').val('');
 $("[data-label=LBL_STATE] span").empty();
 
 $('[data-label=LBL_CURRENCY]').show();
 $('#currency_c').show();

//$('#currency_c').attr('disabled',true);

 
  $('[data-label=LBL_COUNTRY]').show();
 $('#country_c').show();
  if ($("[data-label=LBL_COUNTRY] span").text() == "") {
               
             $("[data-label=LBL_COUNTRY]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               $('div[field="account_name"]').html('');
}
else{
 
 $('#country_c').val('');
  $('#currency_c').val('');
  
 $('[data-label=LBL_COUNTRY]').hide();
 $('#country_c').hide();
 
 $('[data-label=LBL_CURRENCY]').hide();
 $('#currency_c').hide();


   $('#state_c').show();
  $("[data-label=LBL_STATE]").show(); 
  if ($("[data-label=LBL_STATE] span").text() == "") {
               
             $("[data-label=LBL_STATE]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
}
//  //-------------------------------on load-------------END------------------------------ 
//  //-------------------------------on change---------------------------------------------
  
$($('div[field="international_c"] input:radio')).on("click", function() {
 //console.log(" in");
  let new_kind = $('input[name="international_c"]:checked').val();
  

   if(new_kind =='yes'){

 $('#state_c').hide();
 $("[data-label=LBL_STATE]").hide();
 $('#state_c').val('');
 $("[data-label=LBL_STATE] span").empty();
 
 $('[data-label=LBL_CURRENCY]').show();
 $('#currency_c').show();
  
// $('#currency_c').val('USD');
 

 // $('#currency_c').attr('disabled',true);
  $('[data-label=LBL_COUNTRY]').show();
 $('#country_c').show();
 
  if ($("[data-label=LBL_COUNTRY] span").text() == "") {
               
             $("[data-label=LBL_COUNTRY]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               $('div[field="account_name"]').html('');
}
else{
 
 $('#country_c').val('');
 $('#currency_c').val('');
 
 
      
 
 $('[data-label=LBL_COUNTRY]').hide();
 $('#country_c').hide();

$('[data-label=LBL_CURRENCY]').hide();
 $('#currency_c').hide();

   $('#state_c').show();
  $("[data-label=LBL_STATE]").show(); 
  if ($("[data-label=LBL_STATE] span").text() == "") {
               
             $("[data-label=LBL_STATE]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
}

});

 

 //-------------------------------on change----------END----------------------------
 
 
 
  //---------------------------International Opportunity--------END--------------------------------
 
 //---------------------------Currency---------------------------------------------------------
     //--------------------------on load----------------------------------------------------
       var currency1=$('#currency_c').val();
      
      if(currency1=='USD'){
       $('[data-label="LBL_BUDGET_HEAD_AMOUNT"]').html('Budget Head Amount (in Mn):<span style="color:red;">*</span>');
       $('[data-label="LBL_BUDGET_ALLOCATED_OPPERTUNITY"]').html('Budget Allocated for Opportunity (in Mn):<span style="color:red;">*</span>');
      }
      else if(currency1=='INR'){
        $('[data-label="LBL_BUDGET_HEAD_AMOUNT"]').html('Budget Head Amount (in Cr):<span style="color:red;">*</span>');
       $('[data-label="LBL_BUDGET_ALLOCATED_OPPERTUNITY"]').html('Budget Allocated for Opportunity (in Cr):<span style="color:red;">*</span>');
      }
      else {
        $('[data-label="LBL_BUDGET_HEAD_AMOUNT"]').html('Budget Head Amount (in Cr):<span style="color:red;">*</span>');
       $('[data-label="LBL_BUDGET_ALLOCATED_OPPERTUNITY"]').html('Budget Allocated for Opportunity (in Cr):<span style="color:red;">*</span>');
      }
     //--------------------------on load----------------END------------------------------------
     
     //--------------------------on change----------------------------------------------------
     
     $('#currency_c').on('change',function(){
      
      
      var currency=$('#currency_c').val();
      
      if(currency=='USD'){
       $('[data-label="LBL_BUDGET_HEAD_AMOUNT"]').html('Budget Head Amount (in Mn):<span style="color:red;">*</span>');
       $('[data-label="LBL_BUDGET_ALLOCATED_OPPERTUNITY"]').html('Budget Allocated for Opportunity (in Mn):<span style="color:red;">*</span>');
      }
      else if(currency=='INR'){
       
        $('[data-label="LBL_BUDGET_HEAD_AMOUNT"]').html('Budget Head Amount (in Cr):<span style="color:red;">*</span>');
       $('[data-label="LBL_BUDGET_ALLOCATED_OPPERTUNITY"]').html('Budget Allocated for Opportunity (in Cr):<span style="color:red;">*</span>');
      
       
      }
      else {
       
        $('[data-label="LBL_BUDGET_HEAD_AMOUNT"]').html('Budget Head Amount (in Cr):<span style="color:red;">*</span>');
       $('[data-label="LBL_BUDGET_ALLOCATED_OPPERTUNITY"]').html('Budget Allocated for Opportunity (in Cr):<span style="color:red;">*</span>');
      
       
      }
      
     })
     
     
     
     
     //--------------------------on change----------------END------------------------------------

 //---------------------------Currency--------------------END-------------------------------------

//----------------------------------------Department List Auto complete-------------------------------------------------------

var res;

 $.ajax({
        url : 'index.php?module=Opportunities&action=fetch_dList',
        type : 'POST',
        data: {
            
        },
        success : function(data){
            
            dat=JSON.parse(data);
           
          res=dat.dList;
          var department_list= []; 
              
            for(var i in res) {
                department_list.push(res[i])
                
            }; 
          
          $('#new_department_c').autocomplete({
            source: department_list,
            minLength: 0,
            scroll: true
        }).keydown(function() {
            $(this).autocomplete("search", "");
        });
             
        }
     
 });





 
//---------------------------------------Department List Auto complete--END-----------------------------------------------------

//----------------------------------------Non financial consideration-----------------------------------------------

let finance_check1 = $('input[name="non_financial_radio_c"]:checked').val();
  if(finance_check1 == 'NA'){
    $(".check_box").attr('disabled',true);  
    $("[data-label=LBL_NON_FINANCIAL_CONSIDERATION] span").empty();
  }else{
     $(".check_box").attr('disabled',false);  
     
     if ($("[data-label=LBL_NON_FINANCIAL_CONSIDERATION] span").text() == "") {
               
             $("[data-label=LBL_NON_FINANCIAL_CONSIDERATION]").append(
              "<span style='color:red;'>*</span>"
              );
               }
  }

$($('div[field="non_financial_radio_c"] input:radio')).on("click", function() {
 //console.log(" in");
  let finance_check = $('input[name="non_financial_radio_c"]:checked').val();
  if(finance_check == 'NA'){
    $(".check_box").attr('disabled',true);  
    $("[data-label=LBL_NON_FINANCIAL_CONSIDERATION] span").empty();
  }else{
     $(".check_box").attr('disabled',false);  
     
     if ($("[data-label=LBL_NON_FINANCIAL_CONSIDERATION] span").text() == "") {
               
             $("[data-label=LBL_NON_FINANCIAL_CONSIDERATION]").append(
              "<span style='color:red;'>*</span>"
              );
               }
  }
  
});

//----------------------------------------Non financial consideration---------END---------------------------------------



//------------------------------New Assigned to field---------------------------------------------------------------------
$('#assigned_to_new_c').val($('#assigned_user_name').val());

var res1;
var oppss_id = $('[name=record]').val();
var rfp = $("#rfporeoipublished_c").val();
var p_status=$("#status_c").val();
$.ajax({
        url : 'index.php?module=Opportunities&action=new_assigned_list',
        type : 'POST',
         data: {
             oppss_id,
             rfp,
            p_status
        },
        
        success : function(data1){
           
           
             datw=JSON.parse(data1);
           
          
           
           if(datw=='block'){
           $('#assigned_to_new_c').attr('readonly',true);
             
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
            
           
          
          $('#assigned_to_new_c').autocomplete({
            source: user_list,
            minLength: 0,
            scroll: true
        }).keydown(function() {
          
            $(this).autocomplete("search", "");
        });
             
        }
     
 });
 


$(document).on('click','#ui-id-4',function(){
    
    
    var f=$('#assigned_to_new_c').val();
    
    var e=f.length;
    
  var s=f.indexOf("/");

f = f.slice(0,s);

f=f.replace(/[^ \, a-zA-Z]+/g,'');

f=f.replace(/^\s+/g, '');

$('#assigned_to_new_c').val(f);


var a_name= f.split(/\s+/);

var f_name=a_name[0];
var l_name=a_name[1];

$.ajax({
        url : 'index.php?module=Opportunities&action=fetch_assigned_id',
        type : 'POST',
         data: {
           
            f,
            f_name,
            l_name
        },
        
        success : function(data){
           
           $('#assigned_user_id').val(data);
          $('[name=assigned_user_name]').val(f);
          
   var assigned_name = $("#assigned_to_new_c").val();
   var assigned_id = $("#assigned_user_id").val();
    var s=$('#status_c').val();
    var r=$('#rfporeoipublished_c').val(); 
 
   
    $.ajax({
                url : 'index.php?module=Opportunities&action=fetch_reporting_manager',
                type : 'POST',
                dataType: "json",
                 data:{
                  opps_id,
                 assigned_name,
                 assigned_id,
                 s,
                 r,
                },
                success : function(data_approver){
                 
                  
               // data=JSON.parse(data_approver);
                
                
                 $("#select_approver_c").val(data_approver.reporting_name);
                 $("#user_id2_c").val(data_approver.reporting_id);
                $('#multiple_approver_c').val(data_approver.reporting_id);
                
                      if(r=="no")  {
               
                if (s=="Qualified"||s=="QualifiedDpr"){
                  
                  
                   
                     $("#select_approver_c").val(data_approver.approvers_name);
                // $("#user_id2_c").val(data.reporting_id);
                $('#multiple_approver_c').val(data_approver.approvers_id);
                  
        
                }
                
                 }
                 
                    else  if(r=="not_required"){
                     
                  if (s=="Qualified"){
                  
                        $("#select_approver_c").val(data_approver.approvers_name);
                // $("#user_id2_c").val(data.reporting_id);
                $('#multiple_approver_c').val(data_approver.approvers_id);
                  
                 
                 
                 }
                  
                    }
                    
                       else  if(r=="yes")  {
               
                if (s=="QualifiedLead"){
                 
                   $("#select_approver_c").val(data_approver.approvers_name);
                // $("#user_id2_c").val(data.reporting_id);
                $('#multiple_approver_c').val(data_approver.approvers_id);
                  }
                }
                
                   var status=$('#status_c').val();
      var rfp_eoi_published=$('#rfporeoipublished_c').val();
     var apply_for=$('#applyfor_c').val();
     var date_time=Date();
     
    if(oppss_id!=='')
 {    
  //alert("1");
      $.ajax({
        url : 'index.php?module=Opportunities&action=approval_buttons',
        type : 'POST',
        data: {
            opp_id:oppss_id,
            status,
            rfp_eoi_published,
            apply_for,
            assigned_id
            
        },
        success : function(data1){
            
             ////alert(data);
            var data = JSON.parse(data1);
          // var data=dat;
          //console.log(data.button);
         if(data.mc=='yes'){
          
             if(data.button=='approve') {
            
              
                  if( $("#status_c").val()=="Closed"  ){ 
      
                                    $("#approve").css("display","none");
                              }
                                 else if( $("#status_c").val()=="Dropped"){
                                     
                                  
                                  
                                  $("#approve").css("display","none");
                                   
                              } 
                              else if($("#status_c").val()=="Lead"){ 
                                  
                                    
                                     $("#approve").css("display","inline");
                                     
                                 }
                                 
                                 else if($("#status_c").val()=="QualifiedLead"){ 
                                     
                                    $("#approve").css("display","inline");
                                     
                                 }
                                  else if($("#status_c").val()=="Qualified"){ 
                                     
                                     $("#approve").css("display","inline");
                                     
                                 }
                                 else if($("#status_c").val()=="QualifiedDpr"){ 
                                     
                                      $("#approve").css("display","inline");
                                     
                                 }
                                 else if($("#status_c").val()=="QualifiedBid"){ 
                                     
                                     $("#approve").css("display","inline");
                                     
                                 }
                                  
              
        }
           
                  else   if(data.button=='send_approval_next') {
                          
                            
                            
                          
                             
   
                
                    }
           
                  else  if(data.button=='send_approval_same'){
                        
                       
                         $("#approve").css("display","inline");
                      $("#reject").css("display","inline"); 
                         
                        
                      $("#reject").replaceWith('<h3 id="approve" style="color: red; display: inline;">Rejected (Edit opportunity and resend for approval)</h3>')
                    }
           
           
           
                    else   if(data.button=='pending') {
                  $("#send_approval").css("display","inline");
      
                  $("#send_approval").replaceWith('<h3 id="send_approval" style="color: red; display: inline;">Approval Pending</h3>')
                  }
           
           
                else  if(data.button=='approve_reject'){
                  
                     
                            if( $("#status_c").val()=="Closed"  ){ 
      
                                  $("#approve").css("display","none");
                      $("#reject").css("display","none"); 
                              }
                                 else if( $("#status_c").val()=="Dropped"){
                                     
                                  
                                  
                                    $("#approve").css("display","none");
                      $("#reject").css("display","none"); 
                                   
                              } 
                              else if($("#status_c").val()=="Lead"){ 
                                  
                                    
                                     $("#approve").css("display","inline");
                      $("#reject").css("display","inline"); 
                                     
                                 }
                                 
                                 else if($("#status_c").val()=="QualifiedLead"){ 
                                     
                                  $("#approve").css("display","inline");
                      $("#reject").css("display","inline"); 
                                     
                                 }
                                  else if($("#status_c").val()=="Qualified"){ 
                                     
                                  $("#approve").css("display","inline");
                      $("#reject").css("display","inline"); 
                                     
                                 }
                                 else if($("#status_c").val()=="QualifiedDpr"){ 
                                     
                                    $("#approve").css("display","inline");
                      $("#reject").css("display","inline"); 
                                     
                                 }
                                 else if($("#status_c").val()=="QualifiedBid"){ 
                                     
                                     $("#approve").css("display","inline");
                      $("#reject").css("display","inline"); 
                                     
                                 }
                                  
               
               
                 }
                         
                 else if(data.button=="hide_all"){
                     
                      $("#approve").css("display","none");
                      $("#reject").css("display","none"); 
                        $("#send_approval").css("display","none");
                     
                 }
                     
               
           
         }
         
         else{  
             
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
                        
                      $("#approve").replaceWith('<h3 id="approve" style="color: red; display: inline;">Rejected (Edit opportunity and resend for approval)</h3>')
                    }
           
           
           
                    else   if(data.button=='pending') {
                  $("#send_approval").css("display","inline");
      
                  $("#send_approval").replaceWith('<h3 id="send_approval" style="color: red; display: inline;">Approval Pending</h3>')
                  }
           
           
                else  if(data.button=='approve_reject'){
                  
                      $("#approve").css("display","inline");
                      $("#reject").css("display","inline"); 
               
               
                 }
                 
                 else if(data.button=="hide_all"){
                     
                      $("#approve").css("display","none");
                      $("#reject").css("display","none"); 
                        $("#send_approval").css("display","none");
                     
                 }
                     
               
                 }
            }
      });
      
               
                
 }          
                
                
                
               } 
            });
 
 
        }
     
 });


});

$(document).on('click','#ui-id-2',function(){
    
    
    var f=$('#assigned_to_new_c').val();
    
    var e=f.length;
    
  var s=f.indexOf("/");

f = f.slice(0,s);

f=f.replace(/[^ \, a-zA-Z]+/g,'');

f=f.replace(/^\s+/g, '');

$('#assigned_to_new_c').val(f);


var a_name= f.split(/\s+/);

var f_name=a_name[0];
var l_name=a_name[1];

$.ajax({
        url : 'index.php?module=Opportunities&action=fetch_assigned_id',
        type : 'POST',
         data: {
           
            f,
            f_name,
            l_name
        },
        
        success : function(data){
           
           $('#assigned_user_id').val(data);
          $('[name=assigned_user_name]').val(f);
          
             var assigned_name = $("#assigned_to_new_c").val();
   var assigned_id = $("#assigned_user_id").val();
    var s=$('#status_c').val();
    var r=$('#rfporeoipublished_c').val(); 
 
   
    $.ajax({
                url : 'index.php?module=Opportunities&action=fetch_reporting_manager',
                type : 'POST',
                dataType: "json",
                 data:{
                  opps_id,
                 assigned_name,
                 assigned_id,
                 s,
                 r
                },
                success : function(data_approver){
                 
                  
               // data=JSON.parse(data_approver);
                
                
                 $("#select_approver_c").val(data_approver.reporting_name);
                 $("#user_id2_c").val(data_approver.reporting_id);
                $('#multiple_approver_c').val(data_approver.reporting_id);
                
                      if(r=="no")  {
               
                if (s=="Qualified"||s=="QualifiedDpr"){
                  
                  
                   
                     $("#select_approver_c").val(data_approver.approvers_name);
                // $("#user_id2_c").val(data.reporting_id);
                $('#multiple_approver_c').val(data_approver.approvers_id);
                  
        
                }
                
                 }
                 
                    else  if(r=="not_required"){
                     
                  if (s=="Qualified"){
                  
                        $("#select_approver_c").val(data_approver.approvers_name);
                // $("#user_id2_c").val(data.reporting_id);
                $('#multiple_approver_c').val(data_approver.approvers_id);
                  
                 
                 
                 }
                  
                    }
                    
                       else  if(r=="yes")  {
               
                if (s=="QualifiedLead"){
                 
                   $("#select_approver_c").val(data_approver.approvers_name);
                // $("#user_id2_c").val(data.reporting_id);
                $('#multiple_approver_c').val(data_approver.approvers_id);
                  }
                }
                
                   var status=$('#status_c').val();
      var rfp_eoi_published=$('#rfporeoipublished_c').val();
     var apply_for=$('#applyfor_c').val();
     var date_time=Date();
     
    if(oppss_id!="")
   {  
    //alert('2');
      $.ajax({
        url : 'index.php?module=Opportunities&action=approval_buttons',
        type : 'POST',
        data: {
            opp_id:oppss_id,
            status,
            rfp_eoi_published,
            apply_for,
            assigned_id
            
        },
        success : function(data1){
            
             ////alert(data);
            var data = JSON.parse(data1);
          // var data=dat;
          //console.log(data.button);
         if(data.mc=='yes'){
          
             if(data.button=='approve') {
            
              
                  if( $("#status_c").val()=="Closed"  ){ 
      
                                    $("#approve").css("display","none");
                              }
                                 else if( $("#status_c").val()=="Dropped"){
                                     
                                  
                                  
                                  $("#approve").css("display","none");
                                   
                              } 
                              else if($("#status_c").val()=="Lead"){ 
                                  
                                    
                                     $("#approve").css("display","inline");
                                     
                                 }
                                 
                                 else if($("#status_c").val()=="QualifiedLead"){ 
                                     
                                    $("#approve").css("display","inline");
                                     
                                 }
                                  else if($("#status_c").val()=="Qualified"){ 
                                     
                                     $("#approve").css("display","inline");
                                     
                                 }
                                 else if($("#status_c").val()=="QualifiedDpr"){ 
                                     
                                      $("#approve").css("display","inline");
                                     
                                 }
                                 else if($("#status_c").val()=="QualifiedBid"){ 
                                     
                                     $("#approve").css("display","inline");
                                     
                                 }
                                  
              
        }
           
                  else   if(data.button=='send_approval_next') {
                          
                            
                            
                          
                             
   
                
                    }
           
                  else  if(data.button=='send_approval_same'){
                        
                       
                         $("#approve").css("display","inline");
                      $("#reject").css("display","inline"); 
                         
                        
                      $("#reject").replaceWith('<h3 id="approve" style="color: red; display: inline;">Rejected (Edit opportunity and resend for approval)</h3>')
                    }
           
           
           
                    else   if(data.button=='pending') {
                  $("#send_approval").css("display","inline");
      
                  $("#send_approval").replaceWith('<h3 id="send_approval" style="color: red; display: inline;">Approval Pending</h3>')
                  }
           
           
                else  if(data.button=='approve_reject'){
                  
                     
                            if( $("#status_c").val()=="Closed"  ){ 
      
                                  $("#approve").css("display","none");
                      $("#reject").css("display","none"); 
                              }
                                 else if( $("#status_c").val()=="Dropped"){
                                     
                                  
                                  
                                    $("#approve").css("display","none");
                      $("#reject").css("display","none"); 
                                   
                              } 
                              else if($("#status_c").val()=="Lead"){ 
                                  
                                    
                                     $("#approve").css("display","inline");
                      $("#reject").css("display","inline"); 
                                     
                                 }
                                 
                                 else if($("#status_c").val()=="QualifiedLead"){ 
                                     
                                  $("#approve").css("display","inline");
                      $("#reject").css("display","inline"); 
                                     
                                 }
                                  else if($("#status_c").val()=="Qualified"){ 
                                     
                                  $("#approve").css("display","inline");
                      $("#reject").css("display","inline"); 
                                     
                                 }
                                 else if($("#status_c").val()=="QualifiedDpr"){ 
                                     
                                    $("#approve").css("display","inline");
                      $("#reject").css("display","inline"); 
                                     
                                 }
                                 else if($("#status_c").val()=="QualifiedBid"){ 
                                     
                                     $("#approve").css("display","inline");
                      $("#reject").css("display","inline"); 
                                     
                                 }
                                  
               
               
                 }
                         
                 else if(data.button=="hide_all"){
                     
                      $("#approve").css("display","none");
                      $("#reject").css("display","none"); 
                        $("#send_approval").css("display","none");
                     
                 }
                     
               
           
         }
         
         else{  
             
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
                        
                      $("#approve").replaceWith('<h3 id="approve" style="color: red; display: inline;">Rejected (Edit opportunity and resend for approval)</h3>')
                    }
           
           
           
                    else   if(data.button=='pending') {
                  $("#send_approval").css("display","inline");
      
                  $("#send_approval").replaceWith('<h3 id="send_approval" style="color: red; display: inline;">Approval Pending</h3>')
                  }
           
           
                else  if(data.button=='approve_reject'){
                  
                      $("#approve").css("display","inline");
                      $("#reject").css("display","inline"); 
               
               
                 }
                 
                 else if(data.button=="hide_all"){
                     
                      $("#approve").css("display","none");
                      $("#reject").css("display","none"); 
                        $("#send_approval").css("display","none");
                     
                 }
                     
               
                 }
            }
      });
      
   }         
                
                
                
                
                
               } 
            });
 
 
        }
     
 });


});

$(document).on('change','#assigned_to_new_c',function(){
    
    
    var f=$('#assigned_to_new_c').val();
    
    var e=f.length;
    
  var s=f.indexOf("/");

f = f.slice(0,s);

f=f.replace(/[^ \, a-zA-Z]+/g,'');

f=f.replace(/^\s+/g, '');

$('#assigned_to_new_c').val(f);


var a_name= f.split(/\s+/);

var f_name=a_name[0];
var l_name=a_name[1];

$.ajax({
        url : 'index.php?module=Opportunities&action=fetch_assigned_id',
        type : 'POST',
         data: {
           
            f,
            f_name,
            l_name
        },
        
        success : function(data){
           
           $('#assigned_user_id').val(data);
          $('[name=assigned_user_name]').val(f);
          
             var assigned_name = $("#assigned_to_new_c").val();
   var assigned_id = $("#assigned_user_id").val();
    var s=$('#status_c').val();
    var r=$('#rfporeoipublished_c').val(); 
 
   
    $.ajax({
                url : 'index.php?module=Opportunities&action=fetch_reporting_manager',
                type : 'POST',
                dataType: "json",
                 data:{
                  opps_id,
                 assigned_name,
                 assigned_id,
                 s,
                 r
                },
                success : function(data_approver){
                 
                  
               // data=JSON.parse(data_approver);
                
                
                 $("#select_approver_c").val(data_approver.reporting_name);
                 $("#user_id2_c").val(data_approver.reporting_id);
                $('#multiple_approver_c').val(data_approver.reporting_id);
                
                      if(r=="no")  {
               
                if (s=="Qualified"||s=="QualifiedDpr"){
                  
                  
                   
                     $("#select_approver_c").val(data_approver.approvers_name);
                // $("#user_id2_c").val(data.reporting_id);
                $('#multiple_approver_c').val(data_approver.approvers_id);
                  
        
                }
                
                 }
                 
                    else  if(r=="not_required"){
                     
                  if (s=="Qualified"){
                  
                        $("#select_approver_c").val(data_approver.approvers_name);
                // $("#user_id2_c").val(data.reporting_id);
                $('#multiple_approver_c').val(data_approver.approvers_id);
                  
                 
                 
                 }
                  
                    }
                    
                       else  if(r=="yes")  {
               
                if (s=="QualifiedLead"){
                 
                   $("#select_approver_c").val(data_approver.approvers_name);
                // $("#user_id2_c").val(data.reporting_id);
                $('#multiple_approver_c').val(data_approver.approvers_id);
                  }
                }
                
                   var status=$('#status_c').val();
      var rfp_eoi_published=$('#rfporeoipublished_c').val();
     var apply_for=$('#applyfor_c').val();
     var date_time=Date();
     
    if(oppss_id!='')
       {  
      //  alert('assigned');
      $.ajax({
        url : 'index.php?module=Opportunities&action=approval_buttons',
        type : 'POST',
        data: {
            opp_id:oppss_id,
            status,
            rfp_eoi_published,
            apply_for,
            assigned_id
            
        },
        success : function(data1){
            
            // alert(data1);
            var data = JSON.parse(data1);
          // var data=dat;
          //console.log(data.button);
         if(data.mc=='yes'){
          
             if(data.button=='approve') {
            
              
                  if( $("#status_c").val()=="Closed"  ){ 
      
                                    $("#approve").css("display","none");
                              }
                                 else if( $("#status_c").val()=="Dropped"){
                                     
                                  
                                  
                                  $("#approve").css("display","none");
                                   
                              } 
                              else if($("#status_c").val()=="Lead"){ 
                                  
                                    
                                     $("#approve").css("display","inline");
                                     
                                 }
                                 
                                 else if($("#status_c").val()=="QualifiedLead"){ 
                                     
                                    $("#approve").css("display","inline");
                                     
                                 }
                                  else if($("#status_c").val()=="Qualified"){ 
                                     
                                     $("#approve").css("display","inline");
                                     
                                 }
                                 else if($("#status_c").val()=="QualifiedDpr"){ 
                                     
                                      $("#approve").css("display","inline");
                                     
                                 }
                                 else if($("#status_c").val()=="QualifiedBid"){ 
                                     
                                     $("#approve").css("display","inline");
                                     
                                 }
                                  
              
        }
           
                  else   if(data.button=='send_approval_next') {
                          
                            
                            
                          
                             
   
                
                    }
           
                  else  if(data.button=='send_approval_same'){
                        
                       
                         $("#approve").css("display","inline");
                      $("#reject").css("display","inline"); 
                         
                        
                      $("#reject").replaceWith('<h3 id="approve" style="color: red; display: inline;">Rejected (Edit opportunity and resend for approval)</h3>')
                    }
           
           
           
                    else   if(data.button=='pending') {
                  $("#send_approval").css("display","inline");
      
                  $("#send_approval").replaceWith('<h3 id="send_approval" style="color: red; display: inline;">Approval Pending</h3>')
                  }
           
           
                else  if(data.button=='approve_reject'){
                  
                     
                            if( $("#status_c").val()=="Closed"  ){ 
      
                                  $("#approve").css("display","none");
                      $("#reject").css("display","none"); 
                              }
                                 else if( $("#status_c").val()=="Dropped"){
                                     
                                  
                                  
                                    $("#approve").css("display","none");
                      $("#reject").css("display","none"); 
                                   
                              } 
                              else if($("#status_c").val()=="Lead"){ 
                                  
                                    
                                     $("#approve").css("display","inline");
                      $("#reject").css("display","inline"); 
                                     
                                 }
                                 
                                 else if($("#status_c").val()=="QualifiedLead"){ 
                                     
                                  $("#approve").css("display","inline");
                      $("#reject").css("display","inline"); 
                                     
                                 }
                                  else if($("#status_c").val()=="Qualified"){ 
                                     
                                  $("#approve").css("display","inline");
                      $("#reject").css("display","inline"); 
                                     
                                 }
                                 else if($("#status_c").val()=="QualifiedDpr"){ 
                                     
                                    $("#approve").css("display","inline");
                      $("#reject").css("display","inline"); 
                                     
                                 }
                                 else if($("#status_c").val()=="QualifiedBid"){ 
                                     
                                     $("#approve").css("display","inline");
                      $("#reject").css("display","inline"); 
                                     
                                 }
                                  
               
               
                 }
                         
                 else if(data.button=="hide_all"){
                     
                      $("#approve").css("display","none");
                      $("#reject").css("display","none"); 
                        $("#send_approval").css("display","none");
                     
                 }
                     
               
           
         }
         
         else{  
             
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
                        
                      $("#approve").replaceWith('<h3 id="approve" style="color: red; display: inline;">Rejected (Edit opportunity and resend for approval)</h3>')
                    }
           
           
           
                    else   if(data.button=='pending') {
                  $("#send_approval").css("display","inline");
      
                  $("#send_approval").replaceWith('<h3 id="send_approval" style="color: red; display: inline;">Approval Pending</h3>')
                  }
           
           
                else  if(data.button=='approve_reject'){
                  
                      $("#approve").css("display","inline");
                      $("#reject").css("display","inline"); 
               
               
                 }
                 
                 else if(data.button=="hide_all"){
                     
                      $("#approve").css("display","none");
                      $("#reject").css("display","none"); 
                        $("#send_approval").css("display","none");
                     
                 }
                     
               
                 }
            }
      });
      
               
                
   }           
                
                
                
               } 
            });
 
 
        }
     
 });


});

//-------------------------------New Assssigned to field-----END-------------------------------------------------------

//------------------------------tageed user edit_access ----------------------------------------------------------------
var assigned_id_edit= $("#assigned_user_id").val();
$.ajax({
        url : 'index.php?module=Opportunities&action=editView_access',
        type : 'POST',
        data:{
         opps_id,
         assigned_id_edit
        },
        success:function(data){
         var tagged_users_new= [];
          $(".dropdown-chose-list span").each(function(){
          tagged_users_new.push($(this).text())
          });
          
          tagged_users_new= tagged_users_new.filter(tagged=>tagged);
         
         if(data == "block_tag_user"){
          $("#opportunity_type option[value='global']").attr("disabled",true);
          $("#opportunity_type option[value='non_global']").attr("disabled",true);
          $("[field=assigned_to_new_c]").attr("readonly",true);
           $("[field=critical_c],[data-label=LBL_CRITICAL]").hide();
          
         }else if(data == "block_tag_user_all"){
          $("#opportunity_type option[value='global']").attr("disabled",true);
           $("#opportunity_type option[value='non_global']").attr("disabled",true);
          $("[field=tagged_users_c]").html(`<span>${tagged_users_new}</span>`);
          $("[field=assigned_to_new_c]").attr("readonly",true);
           $("[field=critical_c],[data-label=LBL_CRITICAL]").hide();
          
         }else if(data == "block_assigned_user"){
                  if(opps_id!=""){
                   $("#opportunity_type option[value='global']").attr("disabled",true);
                   $("#opportunity_type option[value='non_global']").attr("disabled",true);
                  }
                  else{
                    $("#opportunity_type option[value='global']").attr("disabled",true);
                  }

          $(".dropdown-chose-list,.dropdown-display").hide(); 
          $("[field=tagged_users_c]").append(`<span>${tagged_users_new}</span>`);
           $("[field=critical_c],[data-label=LBL_CRITICAL]").hide();
          
         }else if(data == "block_reports_to_user"){
          $("#opportunity_type option[value='global']").attr("disabled",true);
           $("#opportunity_type option[value='non_global']").attr("disabled",true);
          $(".dropdown-chose-list,.dropdown-display").hide(); 
          $("[field=tagged_users_c]").append(`<span>${tagged_users_new}</span>`);
           $("[field=critical_c],[data-label=LBL_CRITICAL]").hide();
          
         }else if(data == "block_bid_commercial_user"){
         $("#opportunity_type option[value='global']").attr("disabled",true);
           $("#opportunity_type option[value='non_global']").attr("disabled",true);
            $("[field=critical_c],[data-label=LBL_CRITICAL]").hide();
          
         }
         
         
        }
        
        })
        


//------------------------------tageed user edit_access ---------END-------------------------------------------------------


/**************************************Don't delete anything after this line **************************************************************/
});