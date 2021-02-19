$(document).ready(function() {
   $('.paginationWrapper').hide();
$('[field=website]').css({"overflow-wrap": "anywhere"});

//      setTimeout(function() {
//       $('#check a').hide();
//       console.log('sad');
//  }, 10);
 
 $('#btn_view_change_log').hide();
 
  $('input[value="Print as PDF"]').hide();
 
 
 var id=$('#formDetailView input[name=record]').val();
 // alert(id);
 
   
      $.ajax({
        url : 'index.php?module=Accounts&action=detailView_check',
        type : 'POST',
        dataType: "json",
          data :
            {
                id
                
            },
             success: function (data) {
              
           // alert(data);
           
            var data1=data;
           console.log(data1);
            
            if(data1==='true'){
             
             console.log("in");
             $('#edit_button').show();
             $('#delete_button').show();
            }
           if(data1==='false') {
             console.log("else");
             $('#tab-actions').hide();
            }
              
             }
       
      });
      
 //***************************Write code above*********************************************************************************************************
 
});