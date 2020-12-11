
$(document).ready(function(){
    // console.log("akash u are very big one");
    // console.log($('#email_options table tr:eq(1) td').html('***'));
  //  $('[data-label=LBL_USER_NAME]').hide();
  //  $('#user_name').hide();
    // $('#email_options table tr:eq(1) td:nth-child(1)').append(" <span style='color:red;'>*</span>");
    // $('#Users0emailAddress0').prop('required',true);
    $('#Users0emailAddress0').change(function(){
        $('#user_name').val($(this).val());
    });

    
});
