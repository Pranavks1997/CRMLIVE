$( document ).ready(function() {
    //  var id=$('#EditView input[name=record]').val();
    //  console.log(id);
//     function myFunction() {
//   var popup = document.getElementById("myPopup");
//   popup.classList.toggle("show");
// }
//     // console.log("hey!");


    var myForm = document.getElementById("myForm");
   
    var bidChecklistForm = document.getElementById("bidChecklistForm");
   
//   window.onclick = function(event) {
      
//           if (event.target == myForm || event.target == bidChecklistForm) {
//             myForm.style.display = "none";
            
//             bidChecklistForm.style.display = "none";
            
//          //   $('#EditView').show();
            
//           }
//     };
    
     
     
   
     
     
 //-----decode function--------------
    var decodeHTML = function (html) {
  	var txt = document.createElement('textarea');
  	txt.innerHTML = html;
  	return txt.value;
  };
  
  //-----------------decode function-----END--------------------
    
    $(document).on('click','#open_button', function() {
        
        document.getElementById("first_form").style.display = "none";
        document.getElementById("reset").style.display = "none";
        document.getElementById("myForm").style.display = "block";
        document.getElementById("mtwenty").style.display = "block";
        document.getElementById("close1").style.display = "block";
        document.getElementById("close2").style.display = "none";
        document.getElementById("tenth").style.display = "none";
         document.getElementById("chec").style.display = "none";
         document.getElementById("stage").style.display = "none";
           document.getElementById("milestone").style.display = "none";
         document.getElementById("mtenth").style.display = "none";
         document.getElementById("l2p").style.display = "none";
         var id=$('#EditView input[name=record]').val();
         
         
  });
  
  
  //-----------------Saving L1 template--END--------------------
  
  $(document).on('click', '#open_button1', function(){
      
       document.getElementById("myForm").style.display = "block";
       document.getElementById("mtwenty").style.display = "block";
       document.getElementById("mtenth").style.display = "block";
       document.getElementById("close2").style.display = "block";
        document.getElementById("tenth").style.display = "inline";
         document.getElementById("chec").style.display = "inline";
          document.getElementById("stage").style.display = "inline";
           document.getElementById("milestone").style.display = "inline";
        document.getElementById("close1").style.display = "none";
         if($('#rfporeoipublished_c').val()=='yes' && $('#status_c').val()=='QualifiedLead'){
             
              
              var al=$('#cum ').find('td').length;

 
                              if(al==6){
                                  $('#first_form').trigger('click');
                              }
            
                    
         }
        document.getElementById("reset").style.display = "inline";
        document.getElementById("l2p").style.display = "block";
      
      
      var id=$('#EditView input[name=record]').val();
       var decodeHTML = function (html) {
  	var txt = document.createElement('textarea');
  	txt.innerHTML = html;
  	return txt.value;
  };
      
//       //------------for L2---------------------
//           $.ajax({
//         url : 'index.php?module=Opportunities&action=fetch_l2',
//         type : 'POST',
//         dataType: "json",
//           data :
//             {
//                 id,
                
//             },
//             success: function (return_data) {
                
//                 if(return_data.status == true ){
//                     console.log('in');
//           if(return_data.l2_html != ''&& return_data.l2_input!=""){
              
              
//               var l2HTML_decoded = decodeHTML(return_data.l2_html);
//               //var l1INPUT_decoded = decodeHTML(return_data.l1_input);
//               $('#mtenth').html(l2HTML_decoded);
//               $('#mtenth input').each(function(index) {
//                   $(this).val(decodeHTML(return_data.l2_input[index]));
//                 });
                
//              }
                 
//                 }
                
//             }
//   });

   
});
 

$(document).on('click', '#open_bidChecklist', function(){
   var id=$('#EditView input[name=record]').val();
   
   $("#bidChecklistForm").css("display", "block");
   
   //console.log(id);
 //--------------fetch dpr data -----------------------------------------------  
   $.ajax({
        url : 'index.php?module=Opportunities&action=fetch_bidchecklist',
        type : 'POST',
        dataType: "json",
          data :
            {
                id,
                
            },
             success: function (return_data) {
                 
                //  console.table(return_data);
                 
                 var emd = return_data.emd;
                 var pbg = return_data.pbg;
                 var tenure = return_data.tenure;
                 var project_value = return_data.project_value;
                 var project_scope = return_data.project_scope;
                 var total_input_value=return_data.total_input_value;
                  var emd1 = return_data.emd1;
                 var pbg1 = return_data.pbg1;
                 var tenure1 = return_data.tenure1;
                 var project_value1 = return_data.project_value1;
                 var project_scope1 = return_data.project_scope1;
                  var total_input_value1=return_data.total_input_value1;
                 $("#dpr_emd").val(emd);
                 $("#dpr_pbg").val(pbg);
                 $("#dpr_tenure").val(tenure);
                 $("#dpr_value").val(total_input_value);
                 $("#dpr_scope").val(project_scope);
                 
                 
             //--------------fetch bid data -----------------------------------------------
            
            if($("#status_c").val() == "QualifiedDpr"||$("#status_c").val() == "QualifiedBid"||$("#status_c").val()=="Closed") {
                       
                   
              //   console.log("bid if");
                 
                            
                            
                            if(emd1!=emd ) {
                                 $("#bid_emd").val(emd1);
                                         
                            } else{
                                $("#bid_emd").val(emd);
                            } 
                            
                            if(pbg1!=pbg ) {
                                 $("#bid_pbg").val(pbg1);
                                         
                            } else{
                                $("#bid_pbg").val(pbg);
                            }   
                            
                            if(tenure1!=tenure ) {
                                  $("#bid_tenure").val(tenure1);
                                         
                            } else{
                                 $("#bid_tenure").val(tenure);
                            }   
                            
                            if(total_input_value1!=total_input_value ) {
                                  $("#bid_value").val(total_input_value1);
                                         
                            } else{
                                 $("#bid_value").val(total_input_value);
                            }  
                            
                            
                            if(project_scope1!=project_scope ) {
                                  $("#bid_scope").val(project_scope1);
                                         
                            } else{
                                 $("#bid_scope").val(project_scope);
                            }   
       
                  }
//--------------fetch bid data -----END------------------------------------------
             }
});

//--------------fetch dpr data ---END--------------------------------------------
           





});
  
 
  

    
  
      
  //*****************************to delete column in cashflow template and bidchecklist template*********************
  $('#mtenth, #mcheckst').on('click', '.remove-column', function(){
      WRN_PROFILE_DELETE = "Are you sure you want to delete this column?";  
  		var check = confirm(WRN_PROFILE_DELETE);  
  		if(check == true){
  		  var table_id = $(this).closest('table').attr('id');
  			var head_position = $(this).closest('th').index();
  			$('#'+table_id+' tr').find('td:eq('+head_position+'),th:eq('+head_position+')').remove();
  		}
  });
//------------------insert row in cash flow------------------------------------

  $('.add_rows_cls').click(function(){
      var stage=$("#stage").val();
      var milestone=$("#milestone").val();
       var select_value = $("#chec").val();
      var last_sno = Number($('#mtenth tbody tr:last-child td:eq(1)').html());
       var id_no =Number($('#mtenth tbody tr:last').attr('id'));
      if (stage!='' && milestone!=''){
   $('#mtenth tbody tr:last').after(`<tr class="addition ir" id="`+(Number(id_no)+1)+`">
           <td class="ExportLabelTD"><a class=" remove-row pull-right pointer"><i class="glyphicon glyphicon-trash"></i></a></td>
          <td class="ExportLabelTD">
            `+(Number(last_sno)+1)+`
          </td>
          <td>`+stage+`</td>
          <td>`+milestone+`</td>
          <td class="valuee">
      
      <input required name="Other_three1"  class='new' type="text" placeholder="Other(Please  Specify )"  />
          </td>
          <td >
            <input  class="row_add col_add" required name="" type="text"/>
          </td>
        </tr>`);
        
        $('#mtenth .addition:last').find("td:eq(4)").html(select_value);
        var start_year=$('#startYear').val();
        var end_year=$('#endYear').val();
        var start_quarter=$('#start_quarter').val();
        var end_quarter=$('#end_quarter').val();
        var no_of_bidders=$('#bid').val();
   
    
   
    // console.log(no_of_bidders);
    
    if(start_year!=''&& start_quarter !=''&& end_quarter!=''&& end_year !=''){
      // console.log('as');
     
      var start_quarter_col;
      var end_quarter_col;
      
      if(start_quarter=='Q1'){
      start_quarter_col=4;
        
      }else if(start_quarter=='Q2'){
      start_quarter_col=3;
        
      
    }else if(start_quarter=='Q3'){
      start_quarter_col=2;
        
      }else{start_quarter_col=1;}
      
        if(end_quarter=='Q1'){
      end_quarter_col=1;
        
      }else if(end_quarter=='Q2'){
      end_quarter_col=2;
        
      
    }else if(end_quarter=='Q3'){
      end_quarter_col=3;
        
    }else{end_quarter_col=4;}
      
    var array_start_quater = start_quarter.split(/Q/);
    var start_quarter_no = Number(array_start_quater[1]);
     //console.log(start_quarter_no);
    
    var array_end_quater = end_quarter.split(/Q/);
    var end_quarter_no = Number(array_end_quater[1]);
    // console.log(start_end_no);
    
    var fields1= start_year.split(/-/);
    var start1 = fields1[0];
   
    
    var fields2=  end_year.split(/-/);
    var end2= fields2[1];
    // var end1= fields2[0];
    var inbtw=((end2-start1)-2)*4;
    
    var no_of_years=(end2-start1)+1;
    
    var no_of_col=start_quarter_col+end_quarter_col+inbtw+1;
      
    // console.log(end_quarter_col,start_quarter_col,inbtw,no_of_col);
    
      for(var i=1; i<Number(no_of_col); i++) {
          
      $('#'+(Number(id_no)+1)).each(function(){
        $('#mtenth tbody .addition:last' ).append($('#mtenth tbody .addition:last').find("td:last").clone(true).find('input, textarea').val('').end());
         
     
      });
      
 
      
      }
    
    }
   $('#mtenth tbody .addition:last').find('td:last-child input').attr('readonly',true);
      }else{
          
          alert("Please fille Stage and Milestone before inserting new row");
      }
  });
  
  //----------------------------------------------------------------------------------------------------------
 
 //---------------expense and income for Dynamic rows-----------------------------
 
   $(document).on('change', '.row_add', function() {  
      //Get the clicked row ID
        var input_row_position = $(this).val();
        
        
      
     var rowId = event.target.parentNode.parentNode.id;
     
     if(rowId>10){
       
       var s=$('#'+rowId).find('td:eq(4)').text();
       
       
       
       if(s=='expense'){
           console.log('in');
            input_row_position=-(input_row_position);
             $(this).css('background','#FFB6C1');
             $(this).val(input_row_position);
                   }
                   
                   
                   
        if(s=='income'){
           console.log('in');
            
             $(this).css('background','#90EE90');
            
                   }
                   
     }
     
     
   });
   
   
   //---------------expense and income for Dynamic rows------------END-----------------
   
  //*******************************/adding rows in bidchecklist form  ***********************************
  $('.add_rows_cls1').click(function(){
    // console.log();
    var add_row_id = $(this).attr('id');
    $('#m'+add_row_id).append($('#m'+add_row_id+' tbody tr:last').clone(true).find('input, textarea').val('').end());
      
    $('#m'+add_row_id+' tbody tr:last').find("td:eq(1)").text(Number($('#m'+add_row_id+' tbody tr:last').find("td:eq(1)").text()) + 1);
  });
  
  
  
  // *******************************************for adding the column in Bid Checklist*******************************
  $('.add_doc_col').click(function(){
      var add_column_id = $(this).attr('id');
      if($("[name='"+add_column_id+"']").val()){
          $('#m'+add_column_id+'t thead tr').append('<th><center>'+$("[name='"+add_column_id+"']").val()+'&nbsp &nbsp &nbsp <a class="remove-column pointer"><i class="glyphicon glyphicon-trash"></i></a></center></th>');
          $('#m'+add_column_id+'t tbody tr').each(function(){$(this).append($('<td width="150px"> <textarea rows="1" cols="30" class="for_info_popup txtarea" required="" name="Comments" type="text"></textarea></td>'))});
      }else{alert('Enter Column Name');}
  });
  
 
 
  
  //*********************************** delete rows function for cashflow and bid Checklist********************
 $('#mcheckst,#mtenth').on('click', '.remove-row', function(){
     
    
      
    var row_length =$(this).closest('table').find('tr').length;
    // console.log(row_length);
    var form_nam = $(this).closest('form').attr('name');
    if(form_nam == 'fc' ){
      min_row = 14;
    }else{
      min_row = 2;
    }
    if(row_length > min_row){
    	WRN_PROFILE_DELETE = "Are you sure you want to delete this row?";  
    		var check = confirm(WRN_PROFILE_DELETE);
    		// $(this).closest('table').find('tr').length;
    		if(check == true){
    	
    		  var row_index = $(this).closest('tr').index();
    			$(this).closest('table tbody').find("tr:gt("+row_index+")").each(function(){
    			   var prev_val = Number($(this).find("td:eq(1)").text());
    			   var new_value = prev_val - 1;
    			   $(this).find("td:eq(1)").text(new_value);
    			});
    		 
    			$(this).closest('tr').remove();          

          $('#mtenth  .row_add').trigger('blur')
    		}
    }else{
      alert('Last row delete not allowed');
    }
  });
  

  
  
 //*********************************** delete rows function for cashflow and bid Checklist********************** 
  var startYear = 2020;
  var nextYear = 2021; 
  for (var i = 0; i < 50; i++) {
  startYear = startYear + 1;
  nextYear = nextYear + 1;
  
  $('#startYear').append(
    $('<option></option>').val(startYear + "-" + nextYear).html(startYear + "-" + nextYear)
     );
     
    //  $('#endYear').append(
    // $('<option></option>').val(startYear + "-" + nextYear).html(startYear + "-" + nextYear)
    //  ); 
  }
  
  $("#startYear").on("change",function(){
      
     var start_year=$('#startYear').val();
     
     var fields1= start_year.split(/-/);
     
    var start1 = parseInt(fields1[0]);
    
    // start1=start1+1;
     
     var text = '<option value=""></option>';
      for (var i = 0; i < 50; i++) {
           
          
          text += '<option value="'+start1 + '-' + (start1+1)+'">'+start1 + '-' + (start1+1)+'</option>';
         
    //       $('#endYear').replaceWith('<option value="start1 + "-" + (start1+1)"></option>'
    // $('<option></option>').val(start1 + "-" + (start1+1)).html(start1 + "-" + (start1+1))
    //  );  
         start1=start1+1;  
      }
      $('#endYear').replaceWith('<select name="endYear" id="endYear"></select>');
      $('#endYear').html(text);
     
      
  });
  
   $("#start_quarter").on("change",function(){
     if($('#startYear').val()==$('#endYear').val())  {
   if( $("#start_quarter").val()=='Q1'){
          
          $('#end_quarter option[value=Q1]').attr("disabled", false);
           $('#end_quarter option[value=Q2]').attr("disabled", false);
            $('#end_quarter option[value=Q3]').attr("disabled", false);
             $('#end_quarter option[value=Q4]').attr("disabled", false);
      }  
      else if( $("#start_quarter").val()=='Q2'){
          
          $('#end_quarter option[value=Q1]').attr("disabled", "disabled");
           $('#end_quarter option[value=Q2]').attr("disabled", false);
            $('#end_quarter option[value=Q3]').attr("disabled", false);
             $('#end_quarter option[value=Q4]').attr("disabled", false);
      }
      else if( $("#start_quarter").val()=='Q3'){
          
          $('#end_quarter option[value=Q1]').attr("disabled", "disabled");
           $('#end_quarter option[value=Q2]').attr("disabled", "disabled");
            $('#end_quarter option[value=Q3]').attr("disabled", false);
             $('#end_quarter option[value=Q4]').attr("disabled", false);
      }
       else if( $("#start_quarter").val()=='Q4'){
          
          $('#end_quarter option[value=Q1]').attr("disabled", "disabled");
           $('#end_quarter option[value=Q2]').attr("disabled", "disabled");
            $('#end_quarter option[value=Q3]').attr("disabled", "disabled");
             
             $('#end_quarter option[value=Q4]').attr("disabled", false);
      }
   }
       
   });
   
       $(document).on("change","#endYear",function(){
           
           console.log("in");
           
     if($('#startYear').val()==$('#endYear').val())  {
      if( $("#start_quarter").val()=='Q2'){
          
          $('#end_quarter option[value=Q1]').attr("disabled", "disabled");
      }
      else if( $("#start_quarter").val()=='Q3'){
          
          $('#end_quarter option[value=Q1]').attr("disabled", "disabled");
           $('#end_quarter option[value=Q2]').attr("disabled", "disabled");
      }
       else if( $("#start_quarter").val()=='Q4'){
          
          $('#end_quarter option[value=Q1]').attr("disabled", "disabled");
           $('#end_quarter option[value=Q2]').attr("disabled", "disabled");
            $('#end_quarter option[value=Q3]').attr("disabled", "disabled");
      }
   }
   else{
       console.log("else");
        $('#end_quarter option[value=Q1]').attr("disabled",false);
         $('#end_quarter option[value=Q2]').attr("disabled", false);
          $('#end_quarter option[value=Q3]').attr("disabled", false);
           $('#end_quarter option[value=Q4]').attr("disabled",false);
   }
       
   });
      
  

//***************************************************For Column Insert Cash Flow*********************************  
  $('#first_form').click(function(){
    
    
     $('#first_form').hide();
     //$('#first_form').attr('disabled',true);
    
    
    var start_year=$('#startYear').val();
    var end_year=$('#endYear').val();
    var start_quarter=$('#start_quarter').val();
    var end_quarter=$('#end_quarter').val();
    var no_of_bidders=$('#bid').val();
   
    
   
 //console.log(end_year);
    
    if(start_year!=''&& start_quarter !=''&& end_quarter!=''&& end_year !=''){
      // console.log('as');
      
      //----------------------- sending data to backend controller ---------------//
      
        // console.log('year');
//       var id=$('#EditView input[name=record]').val();
//     //   console.log(id);
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
//                  no_of_bidders
//             },
//             success: function (data) {
                
//                 console.log(data);
//             }
//   });
      
      //----------------------- sending data to backend controller--end ---------------//
     
      var start_quarter_col;
      var end_quarter_col;
      
      if(start_quarter=='Q1'){
       start_quarter_col=4;
        
      }else if(start_quarter=='Q2'){
       start_quarter_col=3;
        
      
    }else if(start_quarter=='Q3'){
       start_quarter_col=2;
        
      }else{start_quarter_col=1;}
      
        if(end_quarter=='Q1'){
       end_quarter_col=1;
        
      }else if(end_quarter=='Q2'){
       end_quarter_col=2;
        
      
    }else if(end_quarter=='Q3'){
       end_quarter_col=3;
        
    }else{end_quarter_col=4;}
      
    var array_start_quater = start_quarter.split(/Q/);
    var start_quarter_no = Number(array_start_quater[1]);
     //console.log(start_quarter_no);
    
    var array_end_quater = end_quarter.split(/Q/);
    var end_quarter_no = Number(array_end_quater[1]);
    // console.log(start_end_no);
    
    var fields1= start_year.split(/-/);
    var start1 = fields1[0];
   
    
    var fields2=  end_year.split(/-/);
    var end2= fields2[1];
    // var end1= fields2[0];
    var inbtw=((end2-start1)-2)*4;
    
    var no_of_years=(end2-start1)+1;
    
    var no_of_col=start_quarter_col+end_quarter_col+inbtw+1;
      
    // console.log(end_quarter_col,start_quarter_col,inbtw,no_of_col);
    
    // for(var i=1; i<Number(no_of_years); i++) {
      
    //   $('#addValue tbody tr').each(function(){
    //   $(this).append($(this).find("td:last").clone(true).find('input, textarea').val('').end());   
         
         
    //   });
    //   $('#addValue thead tr').each(function(){
    //   $(this).append($(this).find("th:last").clone(true).find('input, textarea').val('').end());   
         
        
    // });
    // }
    
    
     
    for(var i=1; i<Number(no_of_col); i++) {
          
      $('#mtenth tbody tr,#mtenth tfoot tr').each(function(){
        $(this).append($(this).find("td:last").clone(true).find('input, textarea').val('').end());
      });
      
      
      $('#mtenth thead tr').each(function(){
        $(this).append($(this).find("th:last").clone(true).find('input, textarea').val('').end());
        // console.log($(this).text());
      });
    }
    
   //adding dynamic heading column------------------------
    var dynamic_column = ['','S No','Stage','Milestones','Type of Expenditure'];
     
      
      
    var i=Number(start1);
    var j = 1;
    
  
      
    
        for(i; i<Number(end2); i++) {
          
          if(i == Number(start1)){
            j = start_quarter_no;
          }
          for(j; j<=4; j++) {
            // console.log('Q'+j+' '+i+'-'+(i+1));
            dynamic_column.push('Q'+j+' '+i+'-'+(i+1));
            
            if(i==(Number(end2)-1) && j== end_quarter_no){
              //console.log('enter');
              break;
            }
          }
          j = 1;
        }
     
      
      dynamic_column.push('Total');
      $('#mtenth thead tr th').each(function(index){
        $(this).text(dynamic_column[index]);
      });
      
       $('#mtenth tbody tr').each(function(){
        $(this).find('td:last-child input').attr('readonly',true);
    });
      
      //console.log(dynamic_column);
      
    //   var year_column = ['year'];
      
      
    // var i=Number(start1);
    // var j = 1;
    
    // for(i; i<Number(end2); i++) {
        
    //      year_column.push(i+'-'+(i+1));
         
    //   }
    //  // console.log(year_column);
      
    //   year_column.push('Total');
    //     $('#addValue thead tr th').each(function(index){
    //     $(this).text(year_column[index]);
        
    //   });
    //   $('#addValue tbody tr').each(function(){
    //     $(this).find('td:last-child input').attr('readonly',true);
    // });
      
      
      // -------------------------------------------------------------------
      
      
    }
    
    else{
        
        alert("fill all the fields");
        
    };
    
    
    
   });
   //***Tender fee per bidder calcuations-------------------
 $(document).on('change', '#tender1',function(){
    var no_of_bidders=$('#bid').val();
    var value= $('#tender1').val();
    
    if(value!=''){
      
      value=value*no_of_bidders;  
    }else{
        value="";
    }
  //console.log(value);
  
  $('#tender1').val(value);
     
     
 });
 
 //---------------------------------------------------------------

  //---------------changing the value of expense ----------------------------------------------
   $(document).on('change','#cash_flow  .row_add,#two  .row_add,#six .row_add,#seven .row_add,#nine .row_add',function(){
       
       
       var input_row_position = $(this).val();
       
       if(input_row_position!=""){
           
           input_row_position=-(input_row_position);
           
           $(this).css('background','#FFB6C1');
           
       }else{
           input_row_position="";
           
            $(this).css('background','#d8f5ee');
       }
       
       $(this).val(input_row_position);
       
        $(this).val(function(index, value) {
                                         
                                         
                                          
                                         
                                          return value
                                          
                                          .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                                          
                                          ;
                                          
                                        })
   });
   
 //---------------changing the value of expense ---------------------------------------------- 
 
   //---------------changing the color of income ----------------------------------------------
   $(document).on('change','#10 .row_add,#eight .row_add',function(){
       
       
        var input_row_position = $(this).val();
       
       if(input_row_position!=""){
           
          
           
           $(this).css('background','#90EE90');
           
       }else{
           input_row_position="";
           
            $(this).css('background','#d8f5ee');
       }
       
       $(this).val(input_row_position);
       
        $(this).val(function(index, value) {
                                         
                                         
                                          
                                         
                                          return value
                                          
                                          .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                                          
                                          ;
                                          
                                        });  
         
   });
        //---------------changing the color of income ----------------------------------------------
  
  //--------------for EMD row 3------------------------------------------ 
  $(document).on('change','#three .row_add',function(){
      
      var input_pos_rev = $(this).closest('td').index();
    //   console.log("hi");
      var input_row_position = $(this).val();
       
      if(input_row_position!=""){
          
          input_row_position=-(input_row_position);
           
          $(this).css('background','#FFB6C1');
           
         var k=input_pos_rev+1;
         
         $('#three td:eq('+k+') input').css("background",'#90EE90').val(-(input_row_position));
         
      //console.log(k);
       
      }else{
          input_row_position="";
           
            $(this).css('background','#d8f5ee');
      }
       
      $(this).val(input_row_position);
      
      
  });
  
  //--------------for EMD row 3------------------------------------------ 
  
   //--------------for EMD row 4------------------------------------------ 
  $(document).on('change','#four .row_add',function(){
      
     
      
     
        var input_row_position = $(this).val();
       
      if(input_row_position!=""){
          
          input_row_position=-(input_row_position);
           
          $(this).css('background','#FFB6C1');
           
          
          $('#four  td:nth-last-child(2) input').css("background",'#90EE90').val(-(input_row_position));
          
     
      
      }else{
          input_row_position="";
           
            $(this).css('background','#d8f5ee');
      }
       
      $(this).val(input_row_position);
      
      
  });
  
  //--------------for EMD row 4------------------------------------------ 
 
 
 
 
 
 
  // adding total and cumalitive total  logic==================================================================
  
  $(document).on('blur', '#mtenth  .row_add', function(){
     var input_pos_rev = $(this).closest('td').index();
     var input_row_position = $(this).closest("tr").index();
     var count_row =0;
     var count_col = 0;
    // column total ------------------------------------------------
     $('#mtenth tbody tr ').each(function(index){ 
      var column_input1 = $(this).find("td:eq("+input_pos_rev+") input").val();
          column_input1 = column_input1.replace(/[\, ]/g, "");
      
       var column_input = Number(column_input1);
      if(column_input == ''){
        column_input = 0;
      }
      count_col = count_col + column_input;
     });
      count_col=count_col.toString();
    count_col=count_col.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
     
  // console.log(count_col);
   $('#mtenth tfoot tr').find("td:eq("+input_pos_rev+") .total").val(count_col);
  // -----------------------------------------------------------------------------
  // row total ----------------------------------------------------------------------
   var td_length = Number($('#mtenth tbody tr:eq('+input_row_position+') td').length);
    $('#mtenth tbody tr:eq('+input_row_position+') td input').each(function(index){
        
     // row_inputs= Number($(this).val());
     row_inputs1= $(this).val();
      row_inputs1=row_inputs1.replace(/[\, ]/g, "")
     
       row_inputs=Number(row_inputs1);
      if(row_inputs == ''){
        row_inputs = 0;
      }
      
      if($(this).closest('td').index() != (td_length-1)){
         count_row = count_row + row_inputs;
      }
    });
    count_row=count_row.toString();
    count_row=count_row.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  //  console.log(count_row);
    $('#mtenth tbody tr:eq('+input_row_position+') td:last-child input').val(count_row);
    
    //-----------horizontal total column color change---------------------------  
    
   var z= $('#mtenth tbody tr:eq('+input_row_position+') td:last-child input').val();
   
   z=z.replace(/[\, ]/g, "");
 //  console.log(z,typeof z)
 
   if(Math.sign(z)==-1){
       //console.log(Math.sign(z));
       $('#mtenth tbody tr:eq('+input_row_position+') td:last-child input').css('background','#FFB6C1');
   }else{
        $('#mtenth tbody tr:eq('+input_row_position+') td:last-child input').css('background','#90EE90');
   }
   //-----------vertical total column color change---------------------------  
   
    //-----------------------------------------------------------------------------------
    
    // current cummalative total by adding prevoius cummaltive and current total -----------------------------------------------------
    if(input_pos_rev == 5){
        
        
       current_cum = count_col;
       $('#cum').find('td:eq('+input_pos_rev+') input').val(current_cum);
     }else{
         count_col=count_col.replace(/[\, ]/g, "");
         count_col=Number(count_col);
        
       change_input_pos_for_cum = input_pos_rev - 1;
       
       var previous_cum1 = $('#cum').find('td:eq('+change_input_pos_for_cum+') input').val();
       previous_cum1=previous_cum1.replace(/[\, ]/g, "");
       previous_cum=Number(previous_cum1);
       
       if(previous_cum == ''){
        previous_cum = 0;
       }
       current_cum = count_col + previous_cum;
        current_cum=current_cum.toString();
    current_cum=current_cum.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
       
       $('#cum').find('td:eq('+input_pos_rev+') input').val(current_cum);
       
     }
     
    // total of row 'total' ----------------------------------------------------
    var row_total = 0;
    $('.total').each(function(index){
        
        current_total1=$(this).val();
         current_total1=current_total1.replace(/[\, ]/g, "");
        //console.log(current_total1);
      current_total = Number(current_total1);
      
      if(current_total == ''){
        current_total = 0;
      }
      
      if($(this).closest('td').index() != (td_length-1)){
         row_total = row_total+current_total;
      }
    });
     row_total=row_total.toString();
    row_total=row_total.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $('#tot td:last-child input').val(row_total);
    // --------------------------------------------------------------------------------------
    
    // change cummalative total anywhere you change input-------------------------------
      
    var k;
    for (k = input_pos_rev; k < $('#mtenth th').length ; k++) {
        
    if(k==($('#mtenth th').length)-1){
        break;
    }
      var curr_cum1 = $('#cum').find('td:eq('+k+') input').val();
      curr_cum1=curr_cum1.replace(/[\, ]/g, "");
      var curr_cum=Number(curr_cum1);
      if(curr_cum == ''){
        curr_cum = 0;
      }
      
      var next_column_net_flow1 = $('#tot').find('td:eq('+(k+1)+') input').val();
          console.log(typeof next_column_net_flow1,next_column_net_flow1);
          
            next_column_net_flow1=next_column_net_flow1.replace(/[\, ]/g, "");
            
             //console.log(typeof next_column_net_flow1,next_column_net_flow1);
      var next_column_net_flow = Number(next_column_net_flow1);
       if(next_column_net_flow == ''){
        next_column_net_flow = 0;
       }
      next_column_cumulative = curr_cum + next_column_net_flow;
       next_column_cumulative=next_column_cumulative.toString();
    next_column_cumulative=next_column_cumulative.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      
      $('#cum').find('td:eq('+(k+1)+') input').val(next_column_cumulative);
      
    }
    //--------------------------------------------------------------
    
    //---------------- total and cummulative color change-------------------------------- 
       var x= $('#cum').find('td:eq('+input_pos_rev+') input').val();
        x=x.replace(/[\, ]/g, "");
        console.log(typeof x,x);
        if(Math.sign(x)==-1){
           // alert("cumal");
            $('#cum').find('td:eq('+input_pos_rev+') input').css('background','#FFB6C1');
        }else{
           $('#cum').find('td:eq('+input_pos_rev+') input').css('background','#90EE90');
        }
        
         var y=$('#tot').find('td:eq('+input_pos_rev+') input').val();
        y=y.replace(/[\, ]/g, "");
         console.log(typeof y,y);
        if(Math.sign(x)==-1){
          // alert("cumal");
           $('#tot').find('td:eq('+input_pos_rev+') input').css('background','#FFB6C1');
        }else{
            $('#tot').find('td:eq('+input_pos_rev+') input').css('background','#90EE90');
        }
        
        var x1=  $('#cum td:last-child input').val();
         x1=x1.replace(/[\, ]/g, "");
            if(Math.sign(x)==-1){
           $('#cum td:last-child input').css('background','#FFB6C1');
        }else{
          $('#cum td:last-child input').css('background','#90EE90');
        }
        
        var y1=  $('#tot td:last-child input').val();
         y1=y1.replace(/[\, ]/g, "");
            if(Math.sign(x)==-1){
           $('#tot td:last-child input').css('background','#FFB6C1');
        }else{
          $('#tot td:last-child input').css('background','#90EE90');
        }
     
    // --------------------------------------------------------------------------------------
    
    
    // ==============================================================================
    
  });
  
  // ==========================================================================================================
   
  // total value based on number of years************************************
  
  $(document).on('change', '#total_value .row_add', function(){
          //console.log("add in")
      var input_pos_rev = $(this).closest('td').index();
      var input_row_position = $(this).closest("tr").index();
      var count_row =0;
      
      var td_length = Number($('#total_value tbody tr:eq('+input_row_position+') td').length);
       $('#total_value tbody tr:eq('+input_row_position+') td input').each(function(index){
         row_inputs= Number($(this).val());
         if(row_inputs == ''){
              row_inputs = 0;
      }
      if($(this).closest('td').index() != (td_length-1)){
         count_row = count_row + row_inputs;
         
      }
      
    });
     $('#total_value tbody tr:eq('+input_row_position+') td:last-child input').val(count_row);
      
      
  });
  
  //-------------------------------------------------------------------------------------------------
  
 
  
   
  
  
  
  
  
   //------------for saving template l1 data--------------------------------
  $(document).on('click', '#save1', function(){
      
      var id=$('#EditView input[name=record]').val();
      var l1_html;
      var l1_input=[];
      $('#total_value input').each(function() {
        l1_input.push($(this).val());
      });
      l1_html=$('#total_value').html();
    //   console.log(l1_html,l1_input);
      $.ajax({
        url : 'index.php?module=Opportunities&action=l1',
        type : 'POST',
        dataType: "json",
          data :
            {
                id,
                l1_html,
                l1_input
            },
            success: function (data) {
                
               // alert(data.message);
               // $("#myForm").css("display","none");
                
                // console.log(data.message);
            }
  });
  
 
  });
  //-------------------------saving l1 template---END-----------------------
  
  //-------------------------saving L2 template---------------------------
   $(document).on('click', '#save2', function(){
     
      var id=$('#EditView input[name=record]').val();
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
                project_scope
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
   
     console.log(project_value,emd,pbg,project_scope,id,tenure);
    
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
                project_scope
            },
            success: function (data) {
                    
                 // alert(data.message);
                // // $("#myForm").css("display","none");
                
                console.log(data);
            }
  });
    
    
  }
 //---------------------saving for  Bid bidchecklist-----END----------------------
 
 

  });
//  ------------for saving template data--End------------------------------




  
  /*=================       Add custom code before this line     =============================*/
  
});