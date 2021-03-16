$( document ).ready(function() {
    
    //alert('I\'m in');
//-----------------------------------------------Hide onload--------------------------------------
       setTimeout(function() {
      $('#check_document a').hide();
      //console.log('sad');
 }, 10);
 
    $('.pagination').hide();
    $("#btn_view_change_log").hide();
    $('#duplicate_button,#tab1,#top-panel-0').hide();
    $('.panel-heading:contains("Tag Users")').hide();
    $('.panel-heading:contains("Document Revisions")').hide();
    $('.panel-heading:contains("Activities")').hide();
    $('.panel-heading:contains("Departments")').hide();
    $('.panel-heading:contains("Opportunities")').hide();
    
//-----------------------------------------------Hide onload--------------------------------------
});