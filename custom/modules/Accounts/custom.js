$('document').ready(function(){
    //  $('#btn_view_change_log').hide();
     $('.saveAndContinue').hide();
     $('.paginationWrapper').hide();
    
    $("input[value='View Change Log']").remove();
   
 //---------------------------country list ----------------------------------  
      var selected_country = $("#country_c").val();
$("#country_c").replaceWith('<select name="country_c" id="country_c" onchange="countryFunction(this.value)">Select Country</select>');
    
  $.ajax({
    url : 'index.php?module=Accounts&action=countryList',
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
                if(country.name != selected_country){
                list+='<option value="'+country.name+'">'+country.name+'</option>';
                }
            });
            $("#country_c").html(list);
        }
});


//------------------------------country list--------------END---------------


//----------------------------state list-------------------
var selected_state = $("#state_c").val();
$("#state_c").replaceWith('<select name="state_c" id="state_c">Select State</select>');

if(selected_state !=""){
  $.ajax({
    url : 'index.php?module=Accounts&action=stateList',
        type : 'POST',
        data : {selected_country:selected_country},
        success : function(data){
        // $("#state_c").append(data);
        if(selected_state == ""){
            var list = '<option value=""></option> +'; 
          }else{
                    var list = '<option value="'+selected_state+'">'+selected_state+'</option> +';
                }
         
             
         data=JSON.parse(data);
            data.forEach((state)=>{
                if(state.name != selected_state){
                list+='<option value="'+state.name+'">'+state.name+'</option>';
                }
            });
            $("#state_c").html(list);
        }
});
}
//------------------------------state list--------------END---------------

//-------------------------onchange country--------------------------
  
  countryFunction = function(country){
    $.ajax({
      type: "POST",
     url:
        "index.php?module=Accounts&action=stateList",
      data: { selected_country:country },
      success: function (data) {
      
         $("#state_c").replaceWith('<select name="state_c" id="state_c">select State</select>');
             var list = '<option value=""></option> +';
          
          data=JSON.parse(data);
            data.forEach((state)=>{
                list+='<option value="'+state.name+'">'+state.name+'</option>';
              
            });
            
       $("#state_c").html(list);
      },
    });
  }
  
   //-------------------------onchange country---------END-----------------

    
})