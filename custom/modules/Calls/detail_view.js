$( document ).ready(function() {
    
     setTimeout(function() {
      $('#check_activity a').hide();
      //console.log('sad');
 }, 10);
     $('.pagination').hide();
    $('#duplicate_button').hide();
    
    //---------------hiding in detail_view----------------------
     $( ".panel-heading:contains('Tag/Untag Users')").hide();
     $("#top-panel-0").hide();
     
    $("#delete_button").hide();
    $("#close_create_button").hide();
    $("#close_button").hide();
    $("#reschedule_button").hide();
    $("#btn_view_change_log").hide();
    
    $(".label:contains(Untagged Users:)").hide();
    $(".label:contains(Tag hidden:)").hide();
    $(".label:contains(Untag hidden:)").hide();
    $(".label:contains(Assigned to:)").hide();
    $(".label:contains(for quick create:)").hide();
    
    $("[field=for_quick_create_c]").hide();
    $("[field=untag_c]").hide();
    $("[field=tag_hidden_c]").hide();
    $("[field=untag_hidden_c]").hide();
    $("[field=assigned_user_name]").hide();
    
    
    
    //---------------hiding in detail_view----------------------
    
//     var realted_to = $('.col-1-label:eq(2)').text();
//     if(realted_to.trim() != "Opportunities"){
//         $('.col-1-label:eq(5)').hide();
//         $('[field=current_status_c]').hide();
//     }

    //  $.ajax({
    //     type: "POST",
    //     url: 'index.php?module=Calls&action=hide_user_subpanel_for_view_only_user',
    //     //data: {ids : opp_id},
    //     dataType: "json",
    //     cache: false,
    //     success: function(data){
    //         // console.log(data);
    //         if(data.access == 'no'){
    //           $('#whole_subpanel_users').hide();
    //         }
    //     }
    // });
});