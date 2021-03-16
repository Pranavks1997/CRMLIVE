$( document ).ready(function() {
    function dateFormatchange(value) {
        var res = value.split("/");
        var format_change = res[1]+'/'+res[0]+'/'+res[2];
        return format_change;
    }
    
    $('#activity_date_c_trigger').hide();
    $('#next_date_c_trigger').hide();
    $('#btn_parent_name').hide();
    $('#btn_assigned_user_name').hide();
    $('#parent_name').prop('readonly',true);
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
    
    if($("#activity_date_c") != '' ){
        var activity_date = new Date(dateFormatchange($("#activity_date_c").val()));
        // console.log(activity_date);
        if (activity_date) { // Not null
          activity_date.setDate(activity_date.getDate() + 1);
        }
        $('#next_date_c').datepicker('option', 'minDate', activity_date);
    }
    
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
    
    
    // $("#activity_date_c").datepicker('option', 'maxDate',new Date());
    
    $(document).on('click blur', '#parent_name', function(e) {
        if(e.type === 'click'){
            $('#btn_parent_name').trigger('click');
        }
        else if(e.type === 'blur'){
            var oppurtunity_id = $('#parent_id').val();
            if($('#parent_type').val() == 'Opportunities'){
                if(oppurtunity_id != ''){
                    $.ajax({
                        url : 'index.php?module=Calls&action=oppurtunity_status',
                        type : 'POST',
                        dataType: "json",
                         data :
                            {
                                opp_id:oppurtunity_id ,
                            },
                        success : function(data){
                          if (data.status = true){
                              console.log('come');
                              console.log(data.opp_status);
                                $('#new_current_status_c').val(data.opp_status);
                          }else{
                              alert(data.message);
                              window.location.reload();
                          }
                        }
                    });
                }
            }
        }
    });
    
    //  if($('#parent_type').val() == 'Meetings'){
    //     if($('[field=for_others_c]').html().length == 2){
    //         $('[data-label=LBL_FOR_OTHERS]').show();
    //         $('[field=for_others_c]').append('<input type="text" name="for_others_c" id="for_others_c" size="30" maxlength="255" value="" title="">'); 
    //     }
    //     $('#parent_name').remove();
    //     $('#btn_clr_parent_name').hide();
    // }else{
    //     $('[data-label=LBL_FOR_OTHERS]').hide();
    //     $('#for_others_c').remove();
    //     if(!$('#parent_name').hasClass("sqsEnabled yui-ac-input")){
    //         $('#parent_type').after('<input type="text" name="parent_name" id="parent_name" class="sqsEnabled yui-ac-input" tabindex="0" size="" value="" autocomplete="off">');
    //         $('#btn_clr_parent_name').show();
    //     }
        
    // }
    
    
    $(document).on('change', '#parent_type', function() {
        $('#new_current_status_c').val('');
        if($('#parent_type').val() == 'Meetings'){
            if($('[field=for_others_c]').html().length == 2){
                $('[data-label=LBL_FOR_OTHERS]').show();
                $('[field=for_others_c]').append('<input type="text" name="for_others_c" id="for_others_c" size="30" maxlength="255" value="" title="">'); 
            }
            $('#parent_name').remove();
            $('#btn_clr_parent_name').hide();
        }else{
            $('[data-label=LBL_FOR_OTHERS]').hide();
            $('#for_others_c').remove();
            if(!$('#parent_name').hasClass("sqsEnabled yui-ac-input")){
                $('#parent_type').after('<input type="text" name="parent_name" id="parent_name" class="sqsEnabled yui-ac-input" tabindex="0" size="" value="" autocomplete="off">');
                $('#btn_clr_parent_name').show();
            }
            
        }
    });
    
    // $('#btn_clr_parent_name').click(function() {
    //      $('#current_status_c').hide();
    //     $('[data-label=LBL_CURRENT_STATUS]').hide();
    // });
    
    $('#assigned_user_name').click(function() {
        $('#btn_assigned_user_name').trigger('click');
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
    
    custom_check_form = function(view){
        var validate = true;
        if($('#type_of_interaction_c').val() != 'Preparation' ) {
           if($('#name_of_person_c').val() == ''){
            alert('Please fill Name of Person Contacted');
               validate = false;
           }
            
        }
       
        if(validate && check_form(view)) {
              return true;
        }
        else {
              return false;
        }
    }
    
    
    
    
});