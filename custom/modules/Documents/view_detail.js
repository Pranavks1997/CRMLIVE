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
    $('.panel-heading:contains("Cases")').hide();
    $('.panel-heading:contains("Bugs")').hide();
    
//-----------------------------------------------Hide onload--------------------------------------

  //---------------------------multiple file upload -------------------------------------------------     
 
 
	var record_id = $('#formDetailView input[name=record]').val();
	$('#DetailView').attr('enctype','multipart/form-data');
	var x = 1; //initlal text box count
	$(".add_field_button").click(function(e){ //on add input button click
		e.preventDefault();
			x++; //text box increment
			var val = x-1;
			$(".input_fields_wrap").append('<div><input type="file" name="attachments['+val+']" id="attachments['+val+']" onclick="file_size(this.id)"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
	});
		
    $(".input_fields_wrap").on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    });
	
	$(".downloadAttachment").click(function(e) {
        var fileName = $(this).attr("name");
        var name = $(this).text();
        
        var data = [
            {
                "id": fileName,
                "type": name.substr((name.lastIndexOf('.') + 1)),
                "module": "Document",
                "folder": "Document",
                
            }
        ];
        downloadAttachment(data);
        
        
    });
	
	$(".remove_attachment").click(function(e) {
        var fileName = $(this).attr("name");
        var name = $(this).prev().text();
        var extension = name.substr((name.lastIndexOf('.') + 1));
        var flag = confirm("Are you want to delete " + name + " attachment");
        if (flag) {
            removeAttachment(fileName, extension)
        }
    });	


function downloadAttachment(data) {
    var $form = $('<form></form>')
        .attr('action', 'index.php?entryPoint=multiple_file&action_type=download')
        .attr('method', 'post')
        .attr('target', '_blank')
        .appendTo('body');
    for (var i in data) {
        if (!data.hasOwnProperty(i)) continue;
        $('<input type="hidden"/>')
            .attr('name', i)
            .val(JSON.stringify(data[i]))
            .appendTo($form);
    }
    $form.submit();
}

function removeAttachment(fileName, extension) {
    $.ajax({
        url: 'index.php?entryPoint=multiple_file',
        type: 'POST',
        async: false,
        data: {
            id: fileName,
            extension: extension,
            module: 'Document',
         			folder: 'Document',
         			action_type: "remove"
        },
        success: function(result) {
            var data = $.parseJSON(result);
            $('[name=' + data.attachment_id + ']').prev().hide();
            $('[name=' + data.attachment_id + ']').hide();
        }
    });
}
 
 //------------------------------multiple file upload ---------END------------------------------------ 


});