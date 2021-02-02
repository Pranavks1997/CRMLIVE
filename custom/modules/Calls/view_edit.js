$( document ).ready(function() {
    
    $('#for_quick_create_c').val('no');
    $('#for_quick_create_c').hide();
   $('[data-label=LBL_FOR_QUICK_CREATE]').hide();
    
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
    
    function decodeHtml(html) {
        var txt = document.createElement("textarea");
        txt.innerHTML = html;
        return txt.value;
    }
    // $("#activity_date_c").datepicker('option', 'maxDate',new Date());
    
    $('#parent_name').on('click blur', function(e) {
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
                                $('#new_current_status_c').val(decodeHtml(data.opp_status));
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
    
    // $('#parent_type').change(function() {
    //     $('#new_current_status_c').val('');
    // });
    
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