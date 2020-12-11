$(document).ready(function(){
    
   
    
   $.get("index.php?module=Users&action=remove_arrow", function (data, status) {
      // alert("Data: " + data + "\nStatus: " + status);
      type : 'POST'
      data = JSON.parse(data);
      data = data.teamfunction_c.toString().replace(/[^a-zA-Z 0-9]+/g,' ');
       if(data!=""){
        $('[field=teamfunction_c]').text(data);
        
       }
    });
});