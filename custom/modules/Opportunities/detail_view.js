$(document).ready(function() {
    
   
    
    //---------------------------hiding the tab based on the rfp and status---------------------------
    
   if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "Lead" ){
     
     
      
       $("#top-panel-1").hide() ;
       $("#top-panel-3").hide() ;
       $("#top-panel-4").hide() ;
       $("#top-panel-5").hide() ;
       $("#top-panel-6").hide() ;
   }
   
   if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "QualifiedLead" ){
       
       $("#top-panel-1").show() ;
       $("#top-panel-3").show() ;
       
       $("#top-panel-4").hide() ;
       $("#top-panel-5").hide() ;
       $("#top-panel-6").hide() ;
   }
   
   if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "Qualified" ){
       
      $("#top-panel-1").show() ;
       $("#top-panel-3").show() ;
       $("#top-panel-4").show() ;
       $("#top-panel-5").show() ;
       
       $("#top-panel-6").hide() ;
   }
   
   if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "QualifiedDpr" ){
       $("#top-panel-1").show() ;
       $("#top-panel-3").show() ;
       $("#top-panel-4").show() ;
       $("#top-panel-5").show() ;
       
       $("#top-panel-6").hide() ;
   }
   
   if($("#rfporeoipublished_c").val() == "no" && $("#status_c").val() == "QualifiedBid" ){
      $("#top-panel-1").show() ;
       $("#top-panel-3").show() ;
       $("#top-panel-4").show() ;
       $("#top-panel-5").show() ;
        $("#top-panel-6").show() ;
      
       
   }
   
   
   //---------------------------hiding the tab based on the rfp == no and status----end-----------------------
   
   
   
   //---------------------------hiding the tab based on the rfp == yes and status----start-----------------------
   
    if($("#rfporeoipublished_c").val() == "yes" && $("#status_c").val() == "Lead" ){
     
     
      
       $("#top-panel-1").hide() ;
       $("#top-panel-3").hide() ;
       $("#top-panel-4").hide() ;
       $("#top-panel-5").hide() ;
       $("#top-panel-6").hide() ;
   }
   
    if($("#rfporeoipublished_c").val() == "yes" && $("#status_c").val() == "QualifiedLead" ){
       
       $("#top-panel-1").show() ;
       $("#top-panel-3").show() ;
       $("#top-panel-4").show() ;
       $("#top-panel-5").show() ;
       
       $("#top-panel-6").hide() ;
   }
   
   if($("#rfporeoipublished_c").val() == "yes" && $("#status_c").val() == "QualifiedBid" ){
      $("#top-panel-1").show() ;
       $("#top-panel-3").show() ;
       $("#top-panel-4").show() ;
       $("#top-panel-5").show() ;
        $("#top-panel-6").show() ;
      
       
   }
   
   //----- based on oppertunity type hiding the untag user tab ------------------------------
   
   if($("#opportunity_type").val()=="global"){
    $("#whole_subpanel_opportunities_users_2").hide();
   }else{
    $("#whole_subpanel_opportunities_users_2").show();
   }
   
   
   //----- based on oppertunity type hiding the untag user tab--end ------------------------------
   
   //---------------------------hiding the tab based on the rfp == yes and status----end-----------------------
   
   //****************************************to remove edit and delete options and check untag users in Detail View opportunities****************************
    var opp_id=$('#formDetailView input[name=record]').val();
    
      $.ajax({
        url : 'index.php?module=Opportunities&action=detailView_check',
        type : 'POST',
        dataType: "json",
          data :
            {
                opp_id
                
            },
             success: function (data) {
              
           //alert(data);
           
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
              
         if(data1==='true'){
             
              window.location.replace(window.location.href.split('?')[0]+"?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26action%3Dindex%26return_module%3DOpportunities%26return_action%3DDetailView");
             
            }
            
           // if(data1==='false') {
            
            
           //  }
              
             }
       
      });
		
		//****************************************to remove edit and delete options and check untag users in Detail View opportunities**END**************************
   
   
   //**************************Write code above this line******************************************************
});
