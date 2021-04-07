$( document ).ready(function() {

 setTimeout(function() {
      $('#check_dept a').hide();
      //console.log('sad');
 }, 10);

 $('.suitepicon-action-info').hide();
 
 $('.email-link').hide();
 $('.selectActionsDisabled').hide();
 $('.glyphicon-th-list').hide();
 $('.columnsFilterLink').hide();
 
 
 $( ".module-title-text" ).replaceWith( '<h2 class="module-title-text"> Departments </h2><span style="display: flex; justify-content: flex-end;"><button class="button primary" onclick="window.location.href=\'index.php?module=Accounts&action=EditView&return_module=Accounts&return_action=index\'">Create Department</button></span>');
 $('#toolbar').find('li.topnav:eq(0)').hide()
});