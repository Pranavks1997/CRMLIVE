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
});
