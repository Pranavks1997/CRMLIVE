$(document).ready(function(){
    console.log("hello from javascript");
    $('#approveSubmit').click(function(){
        var comment = $('#type-comment').val();
        var add = $('#add').val();
        var link = $('#link').val();
        var Subject = $('#Subject').val();
        if(Select_proxy == '' || edit == '' && viewcheck== ''|| Subject == '')
        {
            $('#response').html('<span class="text-danger">All Fields are required</span>');
        }
        else
        {
            $.ajax({
                url:"index.php?module=Home&action=",
                method:"POST",
                data:$('#submit_form').serialize(),
                beforeSend:function(){
                    $('#response').html('<span class="text-info">Loading response...</span>');
                },
                success:function(data){
                    $('form').trigger("reset");
                    $('#response').fadeIn().html(data);
                    setTimeout(function(){
                        $('#response').fadeOut("slow");
                    }, 5000);
                }
            });
        }
    });


    $('#deSelectSubmit').click(function(){
    var Deselect_Members = $('#Deselect-Members').val();
    if(Deselect-Members == '' )
{
    $('#response').html('<span class="text-danger">All Fields are required</span>');
}
    else
{
    $.ajax({
    url:"insert.php",
    method:"POST",
    data:$('#submit_form').serialize(),
    beforeSend:function(){
    $('#response').html('<span class="text-info">Loading response...</span>');
},
    success:function(data){
    $('form').trigger("reset");
    $('#response').fadeIn().html(data);
    setTimeout(function(){
    $('#response').fadeOut("slow");
}, 5000);
}
});
}
});


    $('#delegate_submit').click(function(){
    var Select_proxy = $('#Select-Proxy').val();
    var edit = $('#delegate_Edit').val();
    var viewcheck = $('#delegate_Viewcheck').val();
    if(Select_proxy == '' || edit == '' && viewcheck== '')
{
    $('#response').html('<span class="text-danger">All Fields are required</span>');
}
    else
{
    $.ajax({
    url:"insert.php",
    method:"POST",
    data:$('#submit_form').serialize(),
    beforeSend:function(){
    $('#response').html('<span class="text-info">Loading response...</span>');
},
    success:function(data){
    $('form').trigger("reset");
    $('#response').fadeIn().html(data);
    setTimeout(function(){
    $('#response').fadeOut("slow");
}, 5000);
}
});
}
});

    $('#columnMasterListSubmit').click(function(){
        var name = $('#name-select').val();
        var Primary_Responsbility_select = $('#Primary-Responsbility-select').val();
        var Ammount_select = $('#Ammount-select').val();
        var REP_EOI_Published_select = $('#REP-EOI-Published-select').val();
        var Closed_Date_select = $('#Closed-Date-select').val();
        var Closed_by_select = $('#Closed-by-select').val();
        var Date_Created_select = $('#Date-Created-select').val();
        var Tagged_Members_select = $('#Tagged-Members-select').val();
        var Team_Members_select = $('#Team-Members-select').val();
        var Viewed_by_select = $('#Viewed-by-select').val();
        var Previous_Responsbility_select = $('#Previous-Responsbility-select').val();
        var Members_select = $('#Members-select').val();
        var Date_of_creation_select = $('#Date-of-creation-select').val();
        var Activities_select = $('#Activities-select').val();
        var Attachment-select = $('#Attachment-select').val();
        if(name == '')
        {
            $('#response').html('<span class="text-danger">All Fields are required</span>');
        }
        else
        {
            $.ajax({
                url:"insert.php",
                method:"POST",
                data:$('#submit_form').serialize(),
                beforeSend:function(){
                    $('#response').html('<span class="text-info">Loading response...</span>');
                },
                success:function(data){
                    $('form').trigger("reset");
                    $('#response').fadeIn().html(data);
                    setTimeout(function(){
                        $('#response').fadeOut("slow");
                    }, 5000);
                }
            });
        }
    });



$('#filterOnOpportunityListSubmit').click(function(){
    //drop down
    var resposnibility = ["Rustam D", "Devoop D", "Rahul"];
    $("#resposnibility").select2({
    data: resposnibility
});
    //dropdown end
    //slider
    var lowerSlider = document.querySelector('#lower');
    var  upperSlider = document.querySelector('#upper');

    document.querySelector('#two').value=upperSlider.value;
    document.querySelector('#one').value=lowerSlider.value;

    var  lowerVal = parseInt(lowerSlider.value);
    var upperVal = parseInt(upperSlider.value);

    upperSlider.oninput = function () {
    lowerVal = parseInt(lowerSlider.value);
    upperVal = parseInt(upperSlider.value);

    if (upperVal < lowerVal + 4) {
    lowerSlider.value = upperVal - 4;
    if (lowerVal == lowerSlider.min) {
    upperSlider.value = 4;
}
}
    document.querySelector('#two').value=this.value
};

    lowerSlider.oninput = function () {
    lowerVal = parseInt(lowerSlider.value);
    upperVal = parseInt(upperSlider.value);
    if (lowerVal > upperVal - 4) {
    upperSlider.value = lowerVal + 4;
    if (upperVal == upperSlider.max) {
    lowerSlider.value = parseInt(upperSlider.max) - 4;
}
}
    document.querySelector('#one').value=this.value
};
    //slider end
    //date
    var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
    $('#startDate').datepicker({
    uiLibrary: 'bootstrap4',
    iconsLibrary: 'fontawesome',
    minDate: today,
    maxDate: function () {
    return $('#endDate').val();
}
});
    $('#endDate').datepicker({
    uiLibrary: 'bootstrap4',
    iconsLibrary: 'fontawesome',
    minDate: function () {
    return $('#startDate').val();
}
});
    //date end
    // check button
    var yes = $('#yes').val();
    var No = $('#No').val();
    var Not = $('#Not-Required')
    if(yes == '' || No == '' || Not == ''|| lowerVal == '' || upperVal == '' || resposnibility == '' || today == '')
{
    $('#response').html('<span class="text-danger">All Fields are required</span>');
}
    else
{
    $.ajax({
    url:"insert.php",
    method:"POST",
    data:$('#submit_form').serialize(),
    beforeSend:function(){
    $('#response').html('<span class="text-info">Loading response...</span>');
},
    success:function(data){
    $('form').trigger("reset");
    $('#response').fadeIn().html(data);
    setTimeout(function(){
    $('#response').fadeOut("slow");
}, 5000);
}
});
}

});
});
