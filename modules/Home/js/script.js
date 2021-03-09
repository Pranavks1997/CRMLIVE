jQuery(document).ready(function($){
    /* amount range slider */
    function addSeparator(nStr) {
        nStr += '';
        var x = nStr.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }

    function rangeInputChangeEventHandler(e) {
        var rangeGroup = $(this).attr('range_1'),
        minBtn = $(this).parent().children('.min'),
        maxBtn = $(this).parent().children('.max'),
        range_min = $(this).parent().children('.range_min'),
        range_max = $(this).parent().children('.range_max'),
        minVal = parseInt($(minBtn).val()),
        maxVal = parseInt($(maxBtn).val()),
        origin = $(this).context.className;
        if (origin === 'min lowerVal' && minVal >= (maxVal - 10)) {
            $(minBtn).val(maxVal - 10);
        }
        var minVal = parseInt($(minBtn).val());
        $(range_min).html(addSeparator(minVal * 1) + ' Cr');


        if (origin === 'max upperVal' && (maxVal - 10) < minVal) {
            $(maxBtn).val(10 + minVal);
        }
        var maxVal = parseInt($(maxBtn).val());
        $(range_max).html(addSeparator(maxVal * 1) + ' Cr');
    }

    $('input[type="range"]').on('input', rangeInputChangeEventHandler);
    /* end amount range slider */

    /* date picker start date */
    $('.filterdatebox').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoApply: true,
        open: 'left',
        minYear: 1901,
        maxYear: parseInt(moment().format('YYYY'), 10),
        locale: {
            format: 'DD/MM/YYYY'
        },
        autoUpdateInput: false
    }, function(start, end, label) {
        var difference = moment().diff(start, 'years');
    });

    $('.filterdatebox').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY'));
    });

    $('.filterdatebox').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });
    /* end date picker start date */

    $.ajax({
        url: "index.php?module=Home&action=getHtml",
        method: "GET",
        success: function(data) {
            var parsed_data = JSON.parse(data);
            $('.main-content').html(parsed_data.data);
        }
    });

    $(document).on('click', '.close-sequence-flow', function(){
        $('.backdrop').fadeOut();
        $('.sequence-flow').slideUp();
        $('.sequence-flow').html('');
        $('body').removeClass('no-scroll');
    })

    $('#deselect_members').change(function(){
        var csu = $('#deselect_members').val();
        display = trimLeft(csu);
        actual = trimRight(csu);
        $('#hidden_multi_select').val(actual);
        $('#hidden_user').val(display);
        var query = $('#hidden_user').val();
        load_data(query);
    });
    
    $('#activity_member_info').change(function(){
        var csu = $('#activity_member_info').val();
        display = trimLeft(csu);
        actual = trimRight(csu);
        $('#activity_hidden_multi_select').val(actual);
        $('#activity_hidden_user').val(display);
        var query = $('#activity_hidden_user').val();
        load_data(query);


    })
    function trimLeft(csu) {
        if (csu && csu.length > 0) {
            csu = csu.map(x => x.split('---')[1]);
        }
        return csu.join();
    }
    function trimRight(csu) {
        if (csu && csu.length > 0) {
            csu = csu.map(x => x.split('---')[0]);
        }
        return csu.join();
    }
})