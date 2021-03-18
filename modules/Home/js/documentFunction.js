function openDocumentFilterDialog(event) {
    var dialog = document.getElementById('document-filter');
    if (event === "discard") {
        dialog.style.display = "none";
    } else if (event === "close") {
        dialog.style.display = "none";
    } else if (event == 'submit') {
        documentFilterHelper('document-filter');
        dialog.style.display = "none";
    } else {
        dialog.style.display = "block"
    }
}

function documentFilterHelper(ref) {
    var day = Cookies.get('day') ? Cookies.get('day') : 30;
    if (ref == 'document-filter') {
        var filterMethod = $('.document-filter .filter-method').val();
        var filterDay = $('.document-filter .filter-day').val();
        var filterType = $('.document-filter .filter-type').val();
        var filterStatus = $('.document-filter .filter-status').val();
    } else {
        var filterMethod = $('.document-pending-filter .filter-method').val();
        var filterDay = $('.document-pending-filter .filter-day').val();
        var filterStatus = $('.document-pending-filter .filter-status').val();
    }

    if (ref == 'document-filter') {
        documentdateBetween(day, '', '', 1, filterStatus, filterType, '', 0);
    } else {
        fetchDocumentByStatus(1, '', 0);
    }
}

function openDocumentPendingFilterDialog(event) {
    var dialog = document.getElementById('document-pending-filter');
    if (event === "discard") {
        dialog.style.display = "none";
    } else if (event === "close") {
        dialog.style.display = "none";
    } else if (event == 'submit') {
        documentFilterHelper('document-pending-filter');
        dialog.style.display = "none";
    } else {
        dialog.style.display = "block"
    }
}

function openPendingDocumentRequestTable(event) {
    var temp = document.getElementsByClassName('pending-document-request-count');
    var pendingReqCount = temp[0].innerText;
    var dialog = document.getElementById('pending-document-request-table-container');
    if (pendingReqCount != '0') {
        if (dialog.style.display === "block") {
            dialog.style.display = "none";
        } else {
            dialog.style.display = "block"
        }
    } else {
        dialog.style.display = "none";
    }
    fetchDocumentByStatus();
}

function getPendingDocumentRequestCount() {
    $.ajax({
        url: 'index.php?module=Home&action=document_pending_count',
        type: 'POST',
        data: $('.approval-form').serialize(),
        success: function (res) {
            res = JSON.parse(res)
            console.log(res)
            $('.pending-document-request-count').html(res.count + " <i class='fa fa-angle-double-down' aria-hidden='true'></i>");
            if (res && res.count == 0) {
                $('#click-here-text-document').html('');
                $('#approve-pending-text-document').html('No Requests Pending For Approval');
            } else {
                $('#click-here-text-document').html('Click here');
                $('#approve-pending-text-document').html('to Approve Pending request');
            }
        }
    });
}

function documentSearchColumns(text) {
    // Search text
    //case-insensitive
    class1 = "document-settings";
    class2 = "document-pending-settings";
    jQuery.expr[':'].contains = function (a, i, m) {
        return jQuery(a).text().toUpperCase()
            .indexOf(m[3].toUpperCase()) >= 0;
    };
    //hiding other that matching
    if (text != '') {
        $("#" + class1 + " #sortable2 li")
            .hide()
            .filter(':contains("' + text + '")')
            .show();
        $("#" + class2 + " #sortable2 li")
            .hide()
            .filter(':contains("' + text + '")')
            .show();
    }
    else {
        $("#" + class1 + " li").show();
        $("#" + class2 + " li").show();
    }
}

function openDocumentSettingDialog(event) {

    var dialog = document.getElementById('document-settings-modal');
    $('#search-column1').val('');
    documentSearchColumns('');
    if (event === "discard") {
        dialog.style.display = "none";
    } else if (event === "close") {
        dialog.style.display = "none";
    } else if (event === "submit") {

    } else {
        dialog.style.display = "block"
    }

    if (event == 'document') {
        $('.document-settings-section').val('document');
    } else if (event == 'pendings') {
        $('.document-settings-section').val('document-pendings');
    }

}

function commitDocumentFilter() {
    var settingsSection = $('.document-settings-section').val();
    var settingsType = $('.document-settings-type').val();
    var settingsStatus = $('.document-settings-status').val();
    var settingsValue = $('.document-settings-type-value').val();
    var day = Cookies.get('day');

    if (settingsSection == 'document') {
        documentdateBetween(day, '', '', '', 0);
    } else {
        fetchDocumentByStatus('', '', 0);
    }
    openDocumentSettingDialog('close');
}




function openDocumentSettingDialog(event) {

    var dialog = document.getElementById('document-settings-modal');
    $('#search-column1').val('');
    activitySearchColumns('');
    if (event === "discard") {
        dialog.style.display = "none";
    } else if (event === "close") {
        dialog.style.display = "none";
    } else if (event === "submit") {

    } else {
        dialog.style.display = "block"
    }

    if (event == 'activity') {
        $('.document-settings-section').val('document');
    } else if (event == 'pendings') {
        $('.document-settings-section').val('document-pendings');
    }

}


// TODO :

// check with thsi function.
function getDelegateMembersDocument() {
    $.ajax({
        url: "index.php?module=Home&action=delegate_members",
        method: "GET",
        success: function (data) {
            var parsed_data = JSON.parse(data);
            // console.log(parsed_data);
            $('#document_Select_Proxy').html(parsed_data.members);
            $('#document_Select_Proxy').val('');
            $('.responsibility').html(parsed_data.members);
            document.getElementById('responsibility1').value = null;
            document.getElementById('responsibility').value = null;
        }
    });
}



function getDefaultDocumentColumns(type) {
    if (type == 'document') {
        var html = $('#document-settings');
        var DefaultColumns = '<form class="document-settings-form sort-column">';
    } else if (type == 'pending') {
        var html = $('#document-pending-settings');
        var DefaultColumns = '<form class="document-pending-settings-form sort-column">';
    }
    DefaultColumns += '<input type="hidden" name="document-settings-section" class="document-settings-section" value="" /><input type="hidden" name="document-settings-type" class="document-settings-type" value="" /><input type="hidden" name="document-settings-type-value" class="document-settings-type-value" value="" /><ul id="sortable1" class="sortable1 connectedSortable ui-sortable"> <li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="name" value="name" checked="True" style="display: none" /> <input class="settingInputs" type="checkbox" id="name-select" name="customDocumentColumns[]" value="name" checked="True" style="display: none" /> <label style="color: #837e7c; font-family: Arial; font-size: 13px" for="name"> Documents</label> </li> <li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="related_to" value="related_to" checked="True" style="display: none" /> <input class="settingInputs" type="checkbox" id="name-select" name="customDocumentColumns[]" value="related_to" checked="True" style="display: none" /> <label style="color: #837e7c; font-family: Arial; font-size: 13px" for="name"> Related To</label> </li> <li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="document_type" value="document_type" checked="True" style="display: none" /> <input class="settingInputs" type="checkbox" id="name-select" name="customDocumentColumns[]" value="document_type" checked="True" style="display: none" /> <label style="color: #837e7c; font-family: Arial; font-size: 13px" for="name"> Document type</label> </li> <li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="category" value="category" checked="True" style="display: none" /> <input class="settingInputs" type="checkbox" id="name-select" name="customDocumentColumns[]" value="category" checked="True" style="display: none" /> <label style="color: #837e7c; font-family: Arial; font-size: 13px" for="name"> Category</label> </li> <li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="sub_category" value="sub_category" checked="True" style="display: none" /> <input class="settingInputs" type="checkbox" id="name-select" name="customDocumentColumns[]" value="sub_category" checked="True" style="display: none" /> <label style="color: #837e7c; font-family: Arial; font-size: 13px" for="name"> Sub Category</label> </li> <li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="uploaded_by" value="uploaded_by" checked="True" style="display: none" /> <input class="settingInputs" type="checkbox" id="name-select" name="customDocumentColumns[]" value="uploaded_by" checked="True" style="display: none" /> <label style="color: #837e7c; font-family: Arial; font-size: 13px" for="name"> Uploaded by</label> </li></ul>';

    html.html(DefaultColumns);
    initSortable();
}

function fetchDocumentByStatus(filter = 0, page = null, changeColumns = 1) {
    if (changeColumns) // reset columns
        getDefaultDocumentColumns('pending');

    $.ajax({
        url: 'index.php?module=Home&action=getPendingDocumentList&' + $('.document-pending-settings-form').serialize() + '&' + $('.document-pending-filter').serialize() + '&filter=' + filter,
        data: {
            status: status,
            page: page
        },
        success: function (data) {
            $('#pending-document-requests').html(data);
            data = JSON.parse(data);
            $('#pending-document-requests').html(data.data);
            if (changeColumns) {
                $('#document-pending-settings').html(data.columnFilter);
                initSortable();
            }
            if (!filter) {
                $('.document-pending-filter .filter-body').html(data.filters);
                initSelect2();
            }
            if (document.getElementById(status)) {
                document.getElementById(status).style.background = "black";
                document.getElementById(status).style.borderRadius = "4px";
            }
            $('.document-pending-filter .filter-method').val('pending');
            $('.document-pending-filter .filter-day').val('30');
            $('.document-pending-filter .filter-status').val(status);
        }
    });
}

function documentdateBetween(dateBetween, searchTerm = null, page = null, filter = 0, changeColumns = 1) {
    Cookies.set('day', dateBetween, { expires: 1 });
    if (changeColumns) // reset columns
        getDefaultDocumentColumns('document');

    var tabContent = document.getElementById('tab_30days_content');

    $.ajax({
        url: 'index.php?module=Home&action=getDocument&' + $('.document-settings-form').serialize() + '&' + $('.document-filter').serialize() + '&filter=' + filter,
        type: 'GET',
        data: {
            days: dateBetween,
            searchTerm: searchTerm,
            page: page,
        },
        success: function (check) {
            var i, tabcontent, tablinks;
            if (dateBetween == '1200') {
                $('#daysFilterAllLabelDoc').html('All Documents');
                $('#daysFilterDoc').html('');
                $('#doc-daysFilter').html('');
                $('#daysFilterDays').html('');
            } else {
                $('#daysFilterAllLabelDoc').html('');
                $('#daysFilterDoc').html('Documents Over Last');
                $('#daysFilterDays').html('Days');
                $('#doc-daysFilter').html(dateBetween);
            }
            console.log("get ACtivity ", check);

            var data = JSON.parse(check);
            // console.log("get ACtivity ", check);

            if (!data.delegate) {
                $('#delegateBtn').remove();
            }

            if (changeColumns) {
                $('#document-settings').html(data.columnFilter);
                initSortable();
            }

            if (!filter) {
                $('.document-filter .filter-body').html(data.filters);
                initSelect2();
            }

            /* Filter Values */
            $('.document-filter .filter-method').val('document');
            $('.document-filter .filter-day').val(dateBetween);
            $('#documenttableContent').html(data.data);
            $('#orgDocumentCount').html(data.total);
            $('#selfDocumentCount').html(data.self_count);
            $('#myTeamDocumentCount').html(data.team_count);
            // $('#delegateName').html(data.delegate_name);
            $('#delegateDocumentName').html('0 (No Delegations)');
            if (data.delegateDetails != '') {
                $('#delegateDocumentName').html(data.delegateDetails);
            }
            if (tabContent) {
                tabContent.style.display = 'block';
            }

            // if (dateBetween === '30') {

            // } else if (dateBetween === '60') {
            //     document.getElementsByClassName('btn-30-days').style.color = "#c2c2c2";
            // } else {
            //     document.getElementsByClassName('btn-30-days').style.color = "#c2c2c2";
            // }
            // document.getElementById('search-icon').style.color = "green";
        },
        complete: function () {
            $('.spinner').fadeOut();
            console.log('Data Loaded');
        }
    });

    var i, tabcontent, tablinks;

}

function documentpaginate(page, method, day, searchTerm = null, filter = 0, status = null, type = null) {
    if (method == 'document') {
        documentdateBetween(day, searchTerm, page, filter, status, type, 0);
    } else if (method == 'pending') {
        fetchDocumentByStatus(status, filter, page, 0);
    }
}

function getDocumentGraph(dateBetween) {
    $.ajax({
        url: 'index.php?module=Home&action=get_document_graph&dateBetween=' + dateBetween,
        type: 'GET',
        data: {
            dateBetween: '30'
        },
        success: function (data) {
            data = JSON.parse(data)
            $('#documentgraph').html(data.data);
        }
    });
}

// Todo : Change the function...
// Look at the functions
//Done
function updateDocumentStatus() {
    var Status = $('.changed-status').val();
    $.ajax({
        url: 'index.php?module=Home&action=document_status_update',
        type: 'POST',
        data: $('.document-approval-form').serialize(),
        success: function (data) {
            data = JSON.parse(data);
            if (data.status) {
                fetchDocumentByStatus();
                getPendingDocumentRequestCount();
                openDocumentApprovalDialog('close');
                activitydateBetween('30')
            } else {
                alert(data.message);
            }
        }
    });
}

function openDocumentApprovalDialog(event, id = null) {
    var dialog = document.getElementById('documentApprovalModal');
    if (event === "discard") {
        dialog.style.display = "none";
    } else if (event === "close") {
        dialog.style.display = "none";
    } else {
        dialog.style.display = "block"
    }

    if (id) {
        $.ajax({
            url: 'index.php?module=Home&action=get_document_approval_item',
            type: 'POST',
            data: {
                id: id,
                event: event
            },
            success: function (data) {
                $('#document-approval-data').html(data);
            }
        });
    }
}

function openDocumentPendingSettingsDialog(event, type = null, value = null) {
    var dialog = document.getElementById('document-pending-settings-modal');
    $('.document-search-column1').val('');
    documentSearchColumns('');
    if (event === "discard") {
        dialog.style.display = "none";
    } else if (event === "close") {
        dialog.style.display = "none";
    } else if (event === "submit") {

    } else {
        dialog.style.display = "block"
    }

    $('.document-pending-settings-section').val('pendings');
    if (type) {
        $('.document-pending-settings-type').val(type);
    }
    if (value) {
        $('.document-pending-settings-type-value').val(value);
    }
}


function commitDocumentPendingFilter() {
    var settingsSection = $('.document-pending-settings-section').val();
    var settingsType = $('.document-pending-settings-type').val();
    var settingsValue = $('.document-pending-settings-type-value').val();
    $('.document-search-column2').val('');
    documentSearchColumns('');
    fetchDocumentByStatus('', '', 0);
    openDocumentPendingSettingsDialog('close');
}

// :::::::::::::::::::::::::::::::::::::::::::: Joytirmoy Code :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::


function handleNoteDialog(event) {


    var dialog = document.getElementById('document-note-modal');
    if (event === "discard") {
        dialog.style.display = "none";
    } else if (event === "close") {
        dialog.style.display = "none";
    } else if (event === "submit") {
        // var hidden_note_id = document.getElementById('hidden_note_value').value;
        var doc_id = document.getElementById('hidden_doc_id').value;
        var note = document.getElementById('note').value;
        var user_id = document.getElementById('user_id').value;
        $.ajax({
            url: 'index.php?module=Home&action=set_note_for_document',
            type: 'POST',
            data: {
                // note_id: hidden_note_id,
                user_id: user_id,
                doc_id: doc_id,
                note: note
            },
            success: function (data) {
                dialog.style.display = "none";
            }
        });
    } else {
        dialog.style.display = "block"
    }
}

function fetchDocumentDelegateDialog() {
    var dialog = document.getElementById('documentDelegatemyModel');
    dialog.style.display = "block";
    $.ajax({
        url: 'index.php?module=Home&action=document_delegated_dialog_info',
        type: 'GET',
        data: {},
        success: function (data) {

            var parsed_data = JSON.parse(data);
            $('#document_delegated_info').html(parsed_data.delegated_info);
            // dialog.style.display = "block";
        }
    });
}
$('#document_delegate_submit').click(function () {
    var Select_Proxy = $('#document_Select_Proxy').val();
    var delegate_Edit = $('#document_delegate_Edit').val();
    console.log("Select_Proxy", Select_Proxy, "delegate_Edit", delegate_Edit)
    if (Select_Proxy == '' && delegate_Edit == '') {
        alert('All Fields are required');
    } else {
        $.ajax({
            url: 'index.php?module=Home&action=document_store_delegate_result',
            method: 'POST',
            data: {
                Select_Proxy: Select_Proxy,
                // delegate_Edit: delegate_Edit,
            },
            success: function (data) {
                console.log(data);
                var delegateModel = document.getElementById("documentDelegatemyModel");
                delegateModel.style.display = "none";
            }
        });
    }
});
var delegateModel = document.getElementById("documentDelegatemyModel");
$(document).on('click', '#documentDelegateclose', function () {
    delegateModel.style.display = "none";
});
$(document).on('click', '.remove-document-delegate', function () {
    $.ajax({
        url: 'index.php?module=Home&action=document_remove_delegate_user',
        method: 'POST',
        success: function (data) {
            fetchDocumentDelegateDialog();
        }
    });
});

// :::::::::::::::::::::::::::::::::::::::::::: Joytirmoy Code :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::


(function ($) {
    $(document).on('click', '#three-tab', function () {
        var day = Cookies.get('day') ? Cookies.get('day') : 30;
        $('.spinner').fadeIn();
        fetchDocumentByStatus();
        getPendingDocumentRequestCount();
        documentdateBetween(day);
        getDocumentGraph(day);
        getDelegateMembersDocument();
    });
    $('.btn-days-filter').on('click', function () {
        var day = $(this).data('day');
        documentdateBetween(day);
        $('.btn-days-filter').css('color', '');
        $(this).css('color', 'black');
    });

    // TODO  
    // Check with serach of the activity.
    $(document).on('click', '.activity-search-btn', function () {
        documentSearchHelper();
    });
    // TODO  
    // Check with serach of the activity.
    $(document).on('keyup', '#activity-search', function (event) {
        if (event.keyCode === 13) {
            documentSearchHelper();
        }
    });

    $('.document-search-column1').keyup(function () {
        var text = $(this).val().toUpperCase();
        documentSearchColumns(text);
    });
    $('.document-search-column2').keyup(function () {
        var text = $(this).val().toUpperCase();
        documentSearchColumns(text);
    });

    /* Clear filter on click */


    // TODO  
    // Check with serach of the activity.
    $('.clear-filter').on('click', function (event) {
        event.preventDefault();
        var type = $(this).data('type');
        if (type == 'activity') {
            $('.activity-filter input:not([type=hidden]').val('');
            $('.activity-filter select').val('');
        } else {
            $('.activity-pending-filter input:not([type=hidden]').val('');
            $('.activity-pending-filter select').val('');
        }
        $('.select2-selection__rendered').html('');
        $('.responsibility').val('');
        $('.filterdatebox').val('');
    });



})(jQuery);