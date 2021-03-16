$( document ).ready(function() {
    console.log('new');
    $('[for=next_date_c_advanced]').text('Next Follow-Up Date');
    if($('#parent_type_advanced').val() == ''){
         $('#parent_name_advanced').hide();
           $('.firstChild').hide();
           $('.lastChild').hide();
    }else
    {
        $('#parent_name_advanced').show();
        $('.firstChild').show();
        $('.lastChild').show();
    }
    
    $("#parent_type_advanced").change(function(){
       if($(this).val() == ''){
           $('#parent_name_advanced').hide();
           $('.firstChild').hide();
           $('.lastChild').hide();
       }else{
           $('#parent_name_advanced').show();
           $('.firstChild').show();
           $('.lastChild').show();
       }
    });
    
        // var label = document.querySelector('label[for="next_date_c_advanced"]');
        // // change it's content
        // label.textContent = 'Next Followup Date'

});