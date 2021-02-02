$(document).ready(function(){
    
  $('#SAVE_HEADER').replaceWith('<input type="submit" value="Save" name="button" value="Save" id="SAVE_HEADER" onclick="var _form = document.getElementById(\'EditView\'); _form.return_id.value=\'\'; _form.action.value=\'Save\'; if(custom_check_form(\'EditView\'))SUGAR.ajaxUI.submitForm(_form);return false;" class="button" accesskey="{$APP.LBL_SAVE_BUTTON_KEY}" title="{$APP.LBL_SAVE_BUTTON_TITLE}"/>')
   
  
    custom_check_form=function(){
    //   alert('in');
       
       var alert_validation = [];
       
        var validate = true;
        if($('#mc_c').val() == 'no'){
            
            if($("#reports_to_name").val() == ""){
          validate = false;
          alert_validation.push("Reports TO"); 
          $("#reports_to_name").css("background-color", "Red");
          }
          
            if($("#teamheirarchy_c").val() == ""){
          validate = false;
           alert_validation.push("Team Heirachy");
          $("#teamheirarchy_c").css("background-color", "Red");
          }
        }
       
          
          
          if($("#first_name").val() == ""){
           validate = false;
           alert_validation.push("First Name");
          $("#first_name").css("background-color", "Red");
          }
          
          if($("#last_name").val() == ""){
          validate = false;
          alert_validation.push("Last Name");
          $("#last_name").css("background-color", "Red");
          }
          
        
          
          if($("#Users0emailAddress0").val() == ""){
           validate = false;
           alert_validation.push("Email Address");
          $("#Users0emailAddress0").css("background-color", "Red");
          }
          
           if($("#teamfunction_c").val() == ""){
           validate = false;
           alert_validation.push("Team Function");
          $("#teamfunction_c").css("background-color", "Red");
          }
          
        if (validate && check_form(view)) {
            
              return true;
               alert_validation = [];
             } else {
                 
                  if(alert_validation.length>0) {
            alert(`Please fill the required fields : \n${alert_validation.join('\n')} `);
           }
                 
              return false;
              
             }
   }
   
   
   $("#reports_to_name,#btn_reports_to_name").on("click", function () {
  //console.log("if in");

  if ($("#reports_to_name").css("background-color", "Red")) {
    // console.log("check in");

    $("#reports_to_name").css("background-color", "#d8f5ee");
  }
});

 $("#teamheirarchy_c").on("click", function () {
  //console.log("if in");

  if ($("#teamheirarchy_c").css("background-color", "Red")) {
    // console.log("check in");

    $("#teamheirarchy_c").css("background-color", "#d8f5ee");
  }
});

 $("#first_name").on("click", function () {
  //console.log("if in");

  if ($("#first_name").css("background-color", "Red")) {
    // console.log("check in");

    $("#first_name").css("background-color", "#d8f5ee");
  }
});

 $("#last_name").on("click", function () {
  //console.log("if in");

  if ($("#last_name").css("background-color", "Red")) {
    // console.log("check in");

    $("#last_name").css("background-color", "#d8f5ee");
  }
});

$("#Users0emailAddress0").on("click", function () {
  //console.log("if in");

  if ($("#Users0emailAddress0").css("background-color", "Red")) {
    // console.log("check in");

    $("#Users0emailAddress0").css("background-color", "#d8f5ee");
  }
});

$("#teamfunction_c").on("click", function () {
  //console.log("if in");

  if ($("#teamfunction_c").css("background-color", "Red")) {
    // console.log("check in");

    $("#teamfunction_c").css("background-color", "#d8f5ee");
  }
});

   $.get("index.php?module=Users&action=remove_arrow", function (data, status) {
      // alert("Data: " + data + "\nStatus: " + status);
      type : 'POST'
      data = JSON.parse(data);
      data = data.teamfunction_c.toString().replace(/[^a-zA-Z 0-9]+/g,' ');
       if(data!=""){
        $('[field=teamfunction_c]').text(data);
        
       }
    });
    
    //----------------------------adding asterisk-------------------//
    if ($("[data-label=LBL_LAST_NAME] span").text() == "") {
               
             $("[data-label=LBL_LAST_NAME]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
     if ($("[data-label=LBL_REPORTS_TO_NAME] span").text() == "") {
               
             $("[data-label=LBL_REPORTS_TO_NAME]").append(
              "<span style='color:red;'>*</span>"
              );
               }
    if ($("[data-label=LBL_TEAMHEIRARCHY] span").text() == "") {
               
             $("[data-label=LBL_TEAMHEIRARCHY]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
    
               
             $("td:contains('Email Address')").append(
              "<span style='color:red;'>*</span>"
              );
               
               
    $("#mc_c").on("change",function() {
      let manage =  $("#mc_c").val();
      
      switch(manage){
          case "yes" :
               $("[data-label=LBL_REPORTS_TO_NAME] span").empty();
               $("[data-label=LBL_TEAMHEIRARCHY] span").empty();
               
               $("#reports_to_name").attr("disabled",true);
               $("#btn_reports_to_name").attr("disabled",true);
               $("#btn_clr_reports_to_name").attr("disabled",true);
               $("#teamheirarchy_c").attr("disabled",true);
               
            break;
            
         case "no":
             if ($("[data-label=LBL_REPORTS_TO_NAME] span").text() == "") {
               
             $("[data-label=LBL_REPORTS_TO_NAME]").append(
              "<span style='color:red;'>*</span>"
              );
               }
    if ($("[data-label=LBL_TEAMHEIRARCHY] span").text() == "") {
               
             $("[data-label=LBL_TEAMHEIRARCHY]").append(
              "<span style='color:red;'>*</span>"
              );
               }
               
               $("#reports_to_name").attr("disabled",false);
               $("#btn_reports_to_name").attr("disabled",false);
               $("#btn_clr_reports_to_name").attr("disabled",false);
               $("#teamheirarchy_c").attr("disabled",false);
               
               break;
      }
      
    })
    
    if($('#mc_c').val() == 'yes'){
        $("[data-label=LBL_REPORTS_TO_NAME] span").empty();
        $("[data-label=LBL_TEAMHEIRARCHY] span").empty();
        
               $("#reports_to_name").attr("disabled",true);
               $("#btn_reports_to_name").attr("disabled",true);
               $("#btn_clr_reports_to_name").attr("disabled",true);
               $("#teamheirarchy_c").attr("disabled",true);
    }
    
});



//----------------------------adding asterisk-------END------------//