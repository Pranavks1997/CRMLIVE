$(document).ready(function(){
    //console.log('checking');
    // $('.actionmenulinks').first().hide();
    // $('.actionmenulinks').first().hide();
   
     $.ajax({
        url : 'index.php?module=Opportunities&action=sales_create_opportunity',
        type : 'POST',
        dataType: "json",
        success : function(data){
            if(data.status == true){
                if(data.view == 'no'){
                    var create_query_string = 'action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26action%3DEditView%26return_module%3DOpportunities%26return_action%3DDetailView';
                    var url = window.location.href;
                    var queryString = url ? url.split('?')[1] : window.location.search.slice(1);
                    if (queryString == create_query_string || ($_GET('module') == 'Opportunities' && $_GET('action') == 'EditView' && $_GET('record') == '' )) {
                        alert("You are not authorized to create.");
                        window.location.replace(window.location.href.split('?')[0]+"?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26action%3Dindex%26return_module%3DOpportunities%26return_action%3DDetailView");
                    }
                }
            }
        }
    });
//-----------------------------------------------------------------------------------------------------------------------------    
   
    
   //-----------------------Write Code above this--------------------------
});