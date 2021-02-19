$( document ).ready(function() {
     $('#parent_name').prop('disabled', true);
    
        $('#btn_clr_parent_name').hide();
    $('[field=parent_name]').css({"width": "63%"});
    $('#for_quick_create_c').val('yes');
    $('#for_quick_create_c').hide();
    $('[data-label=LBL_FOR_QUICK_CREATE]').hide();
    
    function dateFormatchange(value) {
        var res = value.split("/");
        var format_change = res[1]+'/'+res[0]+'/'+res[2];
        return format_change;
    }
    $('#parent_type').prop('disabled', true);
    // $('#current_status_c').prop("readonly",true);
    $('#btn_parent_name').hide();
    $('#btn_assigned_user_name').hide();
    // $('#date_start_trigger').hide();
    // $('#date_start_date').prop('readonly',true);
    // $('#next_date_c_trigger').hide();
    // $('#next_date_c').prop('readonly',true);
    $('#activity_date_c_trigger').hide();
    $('#next_date_c_trigger').hide();
    $('#activity_date_c').prop('readonly',true);
    $('#next_date_c').prop('readonly',true);
    
    $("#activity_date_c").click(function(){
        $('#activity_date_c').val('');
    });
    $("#next_date_c").click(function(){
        $('#next_date_c').val('');
    });
    
    $("#activity_date_c").datepicker({
        dateFormat: 'dd/mm/yy',
        changeYear: true,
        changeMonth: true,
        onSelect: function(date1){
            var newDate = $(this).datepicker('getDate');
            console.log(newDate);
            if (newDate) { // Not null
              newDate.setDate(newDate.getDate() + 1);
            }
            $('#next_date_c').datepicker('option', 'minDate', newDate);
        }
    });
    
    $("#next_date_c").datepicker({
        dateFormat: 'dd/mm/yy',
        changeYear: true,
        changeMonth: true,
         onSelect: function(date1){
            if($("#activity_date_c").val() == ''){
                alert('Please enter Activity Date first');
                $("#next_date_c").val('');
            }
        }
    });
   
    
    // $('#parent_name').click(function() {
    //     $('#btn_parent_name').trigger('click');
    // });
    $('#assigned_user_name').click(function() {
        $('#btn_assigned_user_name').trigger('click');
    });
  
    if($("#status").val() == 'Planned'){
        $("#activity_date_c").datepicker('option', 'minDate',new Date());
    }else{
        $("#activity_date_c").datepicker('option', 'maxDate',new Date());
    }
  
    $("#status").change(function(){
        if($(this).val() == 'Planned'){
            //$("#activity_date_c").datepicker("setDate", new Date());
            $('#activity_date_c').datepicker('destroy');
            $("#activity_date_c").datepicker({ dateFormat: "dd/mm/yy"}).datepicker();
            //$("#activity_date_c").datepicker( "option", "date", new Date());
            $("#activity_date_c").datepicker('option', 'minDate',new Date());
        }
        else{
            //console.log('else');
            $('#activity_date_c').datepicker('destroy');
            $("#activity_date_c").datepicker({ dateFormat: "dd/mm/yy"}).datepicker();
            $("#activity_date_c").datepicker('option', 'maxDate',new Date());
        }
        
    });
    
    function decodeHtml(html) {
        var txt = document.createElement("textarea");
        txt.innerHTML = html;
        return txt.value;
    }
    
    var loaded_opp_status = $('#description').text();
    var oppurtunity_id = $('[name=opportunity_id]').val();
    $.ajax({
        url : 'index.php?module=Calls&action=oppurtunity_status',
        type : 'POST',
        dataType: "json",
         data :
            {
                opp_id:oppurtunity_id ,
            },
        success : function(data){
            
            var x=data.opp_status;
            
           
          if (data.status = true){
                


                  
                    $('#new_current_status_c').val(x.join('\r\n'))
                    $('#new_current_status_c').attr('readonly',true);
                  
               
          }else{
              alert(data.message);
              window.location.reload();
          }
        }
    });
    
    
    $('#type_of_interaction_c').change(function(){
        if($(this).val() != 'Preparation'){
            if($("[data-label=LBL_NAME_OF_PERSON] span").text() == ""){
                $('[data-label=LBL_NAME_OF_PERSON]').append(" <span style='color:red;'>*</span>");
            }
        }else{
            $('[data-label=LBL_NAME_OF_PERSON] span').remove();
        }
    });
  
  if($('#type_of_interaction_c').val() != 'Preparation'){
        if($("[data-label=LBL_NAME_OF_PERSON] span").text() == ""){
            $('[data-label=LBL_NAME_OF_PERSON]').append(" <span style='color:red;'>*</span>");
        }
    }else{
        $('[data-label=LBL_NAME_OF_PERSON] span').remove();
    }
    
    // check_form = function(view){
    //     var validate = true;
    //     // console.log('asdsd');
    //     if($('#type_of_interaction_c').val() != 'Preparation' ) {
    //       if($('#name_of_person_c').val() == ''){
    //         alert('Please fill Name of Person Contacted');
    //           validate = false;
    //       }
    //     }
          
    //     $('#subpanel_activities_newDiv input,select,textarea').each(function() {
    //             if($(this).val() != 'Preparation'){
    //                 if($('#name_of_person_c').val() == ''){
    //                     alert('Please fill all the fields');
    //                     validate = false;
    //                     return false;
    //                 }
    //             }else{
    //                 if($(this).attr('id') != 'activity_date_c'){
    //                     if($(this).val() == ''){
    //                         alert('please fill all fields');
    //                         validate = false;
    //                         return false;
    //                     }
    //                 }
    //             }
    //     //     if($(this).attr('id') != 'activity_date_c' && $(this).attr('id') != 'name_of_person_c'){
    //     //         if($(this).val() == ''){
    //     //             validate = false;
    //     //         }
    //     //     }
    //     });
            
        
    //     // if(validate && check_form(view)) {
            
    //     //       return true;
    //     // }
    //     // else {
    //     //       return false;
    //     // }
    //     // window.location.reload();
        
    // }
    
    custom_check = function(view){
        var validate = true;
        
        console.log('sads');
        
        if(validate && check_form(view)) {
            
              return true;
        }
        else {
              return false;
        }
    }
    
});
