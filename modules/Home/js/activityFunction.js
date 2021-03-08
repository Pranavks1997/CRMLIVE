function getPendingActivityRequestCount() {
    $.ajax({
        url: 'index.php?module=Home&action=activity_pending_count',
        type: 'POST',
        data: $('.approval-form').serialize(),
        success: function (res) {
            res = JSON.parse(res)
            $('.pending-activity-request-count').html(res.count+" <i class='fa fa-angle-double-down' aria-hidden='true'></i>");
            if (res && res.count == 0) {
                $('#click-here-text').html('');
                $('#approve-pending-text').html('No Requests Pending For Approval');
            } else {
                $('#click-here-text').html('Click here');
                $('#approve-pending-text').html('to Approve Pending request');
            }
        }
    });
}
function fetchActivityByStatus(filter = 0, page = null, changeColumns = 1) {
    if (changeColumns) // reset columns
        getDefaultActivityColumns('pending');

    $.ajax({
        url: 'index.php?module=Home&action=getPendingActivityList&' + $('.activity-pending-settings-form').serialize() + '&' + $('.activity-pending-filter').serialize() + '&filter=' + filter,
        data: {
            status: status,
            page: page
        },
        success: function (data) {
            $('#pending-activity-requests').html(data);
            data = JSON.parse(data);
            $('#pending-activity-requests').html(data.data);
            if (changeColumns) {
                $('#activity-pending-settings').html(data.columnFilter);
                initSortable();
            }
            if (!filter) {
                $('.activity-pending-filter .filter-body').html(data.filters);
                initSelect2();
            }
            document.getElementById(status).style.background = "black";
            document.getElementById(status).style.borderRadius = "4px";
            $('.activity-pending-filter .filter-method').val('pending');
            $('.activity-pending-filter .filter-day').val('30');
            $('.activity-pending-filter .filter-status').val(status);
        }
    });
}
function activitydateBetween(dateBetween, searchTerm = null, page = null, filter = 0, changeColumns = 1) {
    Cookies.set('day', dateBetween, { expires: 1 });
    if (changeColumns) // reset columns
        getDefaultActivityColumns('activity');

    var tabContent = document.getElementById('tab_30days_content');
    $.ajax({
        url: 'index.php?module=Home&action=getActivity&' + $('.activity-settings-form').serialize() + '&' + $('.activity-filter').serialize() + '&filter=' + filter,
        type: 'GET',
        data: {
            days: dateBetween,
            searchTerm: searchTerm,
            page: page,
        },
        success: function (check) {
            debugger;
            if (dateBetween == '1200') {
                $('#daysFilterAllLabelAct').html('All Activities');
                $('#daysFilterAct').html('');
                $('#act-daysFilter').html('');
                $('#daysFilterDays').html('');
            } else {
                $('#daysFilterAllLabelAct').html('');
                $('#daysFilterAct').html('Activities Over Last');
                $('#daysFilterDays').html('Days');
                $('#act-daysFilter').html(dateBetween);
            }
            var data = JSON.parse(check);

            if (!data.delegate) {
                $('#delegateBtn').remove();
            }

            if (changeColumns) {
                $('#activity-settings').html(data.columnFilter);
                initSortable();
            }

            if (!filter) {
                $('.activity-filter .filter-body').html(data.filters);
                initSelect2();
            }

            /* Filter Values */
            $('.activity-filter .filter-method').val('activity');
            $('.activity-filter .filter-day').val(dateBetween);

            $('#activitytableContent').html(data.data);
            $('#orgActivityCount').html(data.total);
            $('#selfActivityCount').html(data.self_count);
            $('#myTeamActivityCount').html(data.team_count);
            // $('#delegateName').html(data.delegate_name);
            $('#delegateActivityName').html('0 (No Delegations)');
            if (data.delegateDetails != '') {
                $('#delegateActivityName').html(data.delegateDetails);
            }
            tabContent.style.display = 'block';

            if (dateBetween === '30') {
                
            } else if (dateBetween === '60') {
                document.getElementsByClassName('btn-30-days').style.color = "#c2c2c2";
            } else {
                document.getElementsByClassName('btn-30-days').style.color = "#c2c2c2";
            }
            document.getElementById('search-icon').style.color = "green";
        }
    });
    var i, tabcontent, tablinks;

}

function activitypaginate(page, method, day, searchTerm = null, filter = 0) {
    if (method == 'activity') {
        activitydateBetween(day, searchTerm, page, filter, 0);
    } else if (method == 'pending') {
        fetchByStatus(status, filter, page, 0);
    }
}

function getActivityGraph(dateBetween) {
    $.ajax({
        url: 'index.php?module=Home&action=get_activity_graph&dateBetween=' + dateBetween,
        type: 'GET',
        data: {
            dateBetween: '30'
        },
        success: function (data) {
            data = JSON.parse(data)
            console.log(data)
            $('#activitygraph').html(data.data);
        }
    });
}

function fetchReminderDialog(id) {
    var dialog = document.getElementById('reminderModal');
    console.log("bharat")
    $.ajax({
        url: 'index.php?module=Home&action=activity_dialog_info',
        type: 'GET',
        data: {
            id: id
        },
        success: function (data) {
            var parsed_data = JSON.parse(data);
            $('#opportunity_info').html(parsed_data.opportunity_info);
            document.getElementById('hidden_value').value = parsed_data.opportunity_id;
            dialog.style.display = "block";
            $('#hidden_user').val(parsed_data.msuname);
            var temp = parsed_data.msuid.split(',');
            $('#deselect_members').val(temp);
        }
    })

}

/**
 * TO OPEN TAG POP-UP
 * @param {opp_id} id
 */

function fetchTagDialog(id) {
    var dialog = document.getElementById('deSelectModal');

    $.ajax({
        url: 'index.php?module=Home&action=opportunity_dialog_info',
        type: 'GET',
        data: {
            id: id
        },
        success: function (data) {
            var parsed_data = JSON.parse(data);
            $('#opportunity_info').html(parsed_data.opportunity_info);
            document.getElementById('hidden_value').value = parsed_data.opportunity_id;
            dialog.style.display = "block";
            $('#hidden_user').val(parsed_data.msuname);
            var temp = parsed_data.msuid.split(',');
            $('#deselect_members').val(temp);
        }
    })

}

/**
 * TO HANDLE DIFFERENT EVENTS OF TAG POPUP
 * @param {discard,submit and close} event 
 */

function handleTagDialog(event) {

    var dialog = document.getElementById('deSelectModal');
    if (event === "discard") {
        dialog.style.display = "none";
    } else if (event === "close") {
        dialog.style.display = "none";
    } else if (event === "submit") {
        var hidden_id = document.getElementById('hidden_value').value;
        var user_id = document.getElementById('hidden_multi_select').value;
        console.log(hidden_id);
        console.log(user_id);
        $.ajax({
            url: 'index.php?module=Home&action=deselect_members_from_global_opportunity',
            type: 'POST',
            data: {
                opportunityId: hidden_id,
                userIdList: user_id
            },
            success: function (data) {
                console.log(data);
                dialog.style.display = "none";
            }
        });
    } else {
        dialog.style.display = "block"
    }
}

function openDeselectReminderDialog(event) {

    var dialog = document.getElementById('reminderModal');
    if (event === "discard") {
        dialog.style.display = "none";
    } else if (event === "close") {
        dialog.style.display = "none";
    } else if (event === "submit") {
        var hidden_id = document.getElementById('hidden_value').value;
        var user_id = document.getElementById('hidden_multi_select').value;
        console.log(hidden_id);
        console.log(user_id);
        $.ajax({
            url: 'index.php?module=Home&action=deselect_members_from_global_opportunity',
            type: 'POST',
            data: {
                opportunityId: hidden_id,
                userIdList: user_id
            },
            success: function (data) {
                console.log(data);
                dialog.style.display = "none";
            }
        });
    } else {
        dialog.style.display = "block"
    }
}

function getDefaultActivityColumns(type) {
    if (type == 'activity') {
        var html = $('#activity-settings');
        var DefaultColumns = '<form class="activity-settings-form sort-column">';
    } else if (type == 'pending') {
        var html = $('#activity-pending-settings');
        var DefaultColumns = '<form class="activity-pending-settings-form sort-column">';
    }

    DefaultColumns += '<input type="hidden" name="activity-settings-section" class="activity-settings-section" value=""> <input type="hidden" name="acitivity-settings-type" class="activity-settings-type" value=""> <input type="hidden" name="activity-settings-type-value" class="activity-settings-type-value" value=""> <ul id="sortable1" class="sortable1 connectedSortable ui-sortable"> <li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="name" value="name" checked="True" style="display: none"> <input class="settingInputs" type="checkbox" id="name-select" name="customActivityColumns[]" value="name" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Activity</label> </li><li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="related_to" value="related_to" checked="True" style="display: none"> <input class="settingInputs" type="checkbox" id="name-select" name="customActivityColumns[]" value="related_to" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Related To</label> </li><li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="status" value="status" checked="True" style="display: none"> <input class="settingInputs" type="checkbox" id="name-select" name="customActivityColumns[]" value="status" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Status</label> </li><li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="activity_date_c" value="activity_date_c" checked="True" style="display: none"> <input class="settingInputs" type="checkbox" id="name-select" name="customActivityColumns[]" value="activity_date_c" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> End Date</label> </li><li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="date_modified" value="date_modified" checked="True" style="display: none"> <input class="settingInputs" type="checkbox" id="name-select" name="customActivityColumns[]" value="date_modified" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Last Updated</label> </li><li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="assigned_to_c" value="assigned_to_c" checked="True" style="display: none"> <input class="settingInputs" type="checkbox" id="name-select" name="customActivityColumns[]" value="assigned_to_c" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Assigned To</label> </li></ul>';
    html.html(DefaultColumns);
    initSortable();
}

function openPendingActivityRequestTable(event) {
    var temp = document.getElementsByClassName('pending-activity-request-count');
    var pendingReqCount = temp[0].innerText;
    var dialog = document.getElementById('pending-activity-request-table-container');
    if (pendingReqCount != '0') {
        if (dialog.style.display === "block") {
            dialog.style.display = "none";
        } else {
            dialog.style.display = "block"
        }
    } else {
        dialog.style.display = "none";
    }
    fetchActivityByStatus();
}

/* Settings Helper */
function openActivitySettingDialog(event) {

    var dialog = document.getElementById('activity-settings-modal');
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

    if(event == 'activity'){
        $('.activity-settings-section').val('activity');
    }else if(event == 'pendings'){
        $('.acitivity-settings-section').val('activity-pendings');
    }

}
function commitActivityFilter() {
    var settingsSection = $('.activity-settings-section').val();
    var settingsType = $('.activity-settings-type').val();
    var settingsStatus = $('.activity-settings-status').val();
    var settingsValue = $('.activity-settings-type-value').val();
    var day = Cookies.get('day');

    if (settingsSection == 'activity') {
        activitydateBetween(day, '', '', '', 0);
    } else {
        fetchActivityByStatus('', '', 0);
    }
    openActivitySettingDialog('close');
}

function openActivityPendingSettingsDialog(event) {
    var dialog = document.getElementById('activity-pending-settings-modal');
    $('.activity-search-column1').val('');
    activitySearchColumns('');
    if (event === "discard") {
        dialog.style.display = "none";
    } else if (event === "close") {
        dialog.style.display = "none";
    } else if (event === "submit") {

    } else {
        dialog.style.display = "block"
    }

    $('.activity-pending-settings-section').val('pendings');
    if (type) {
        $('.activity-pending-settings-type').val(type);
    }
    if (value) {
        $('.activity-pending-settings-type-value').val(value);
    }
}

function commitActivityPendingFilter() {
    var settingsSection = $('.activity-pending-settings-section').val();
    var settingsType = $('.activity-pending-settings-type').val();
    var settingsValue = $('.activity-pending-settings-type-value').val();
    $('.activity-search-column2').val('');
    activitySearchColumns('');
    fetchActivityByStatus('', '', 0);
    openActivityPendingSettingsDialog('close');
}

function activitySearchColumns(text) {
    // Search text
    //case-insensitive
    class1 = "activity-settings";
    class2 = "activity-pending-settings";
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
/* end settings helper */

/* search helper */
function activitySearchHelper() {
    var $this = $('#activity-search');
    var searchTerm = $this.val();
    var method = $this.data('method');
    var day = $this.data('day');
    var type = $this.data('type');
    var status = $this.data('status');
    activitydateBetween(day, searchTerm, '', '', 0);
}

/* Filter Helper */
function openActivityFilterDialog(event) {
    var dialog = document.getElementById('activity-filter');
    if (event === "discard") {
        dialog.style.display = "none";
    } else if (event === "close") {
        dialog.style.display = "none";
    } else if (event == 'submit') {
        activityFilterHelper('activity-filter');
        dialog.style.display = "none";
    } else {
        dialog.style.display = "block"
    }
}

function openActivityPendingFilterDialog(event) {
    var dialog = document.getElementById('activity-pending-filter');
    if (event === "discard") {
        dialog.style.display = "none";
    } else if (event === "close") {
        dialog.style.display = "none";
    } else if (event == 'submit') {
        activityFilterHelper('acitivity-pending-filter');
        dialog.style.display = "none";
    } else {
        dialog.style.display = "block"
    }
}

function activityFilterHelper(ref) {
    if (ref == 'activity-filter') {
        var filterMethod = $('.activity-filter .filter-method').val();
        var filterDay = $('.activity-filter .filter-day').val();
        var filterType = $('.activity-filter .filter-type').val();
        var filterStatus = $('.activity-filter .filter-status').val();
    } else {
        var filterMethod = $('.activity-pending-filter .filter-method').val();
        var filterDay = $('.activity-pending-filter .filter-day').val();
        var filterStatus = $('.activity-pending-filter .filter-status').val();
    }

    if (ref == 'activity-filter') {
        activitydateBetween(30, '', '', 1, filterStatus, filterType, '', 0);
    } else {
        fetchActivityByStatus(1, '', 0);
    }
}

/* approval popup */
function openActivityApprovalDialog(event, id = null) {
    var dialog = document.getElementById('activityApprovalModal');
    if (event === "discard") {
        dialog.style.display = "none";
    } else if (event === "close") {
        dialog.style.display = "none";
    } else {
        dialog.style.display = "block"
    }

    if (id) {
        $.ajax({
            url: 'index.php?module=Home&action=get_activity_approval_item',
            type: 'POST',
            data: {
                id: id,
                event: event
            },
            success: function (data) {
                $('#activity-approval-data').html(data);
            }
        });
    }
}

/* Approve / Reject Opportunity */
function updateActivityStatus() {
    var Status = $('.changed-status').val();
    $.ajax({
        url: 'index.php?module=Home&action=activity_status_update',
        type: 'POST',
        data: $('.activity-approval-form').serialize(),
        success: function (data) {
            data = JSON.parse(data);
            if (data.status) {
                fetchActivityByStatus();
                getPendingActivityRequestCount();
                openActivityApprovalDialog('close');
                activitydateBetween('30')
            } else {
                alert(data.message);
            }
        }
    });
}

/* Delegate */
function fetchActivityDelegateDialog() {
    var dialog = document.getElementById('activityDelegatemyModel');
    dialog.style.display = "block";
    $.ajax({
        url: 'index.php?module=Home&action=activity_delegated_dialog_info',
        type: 'GET',
        data: {},
        success: function (data) {
            var parsed_data = JSON.parse(data);
            $('#activity_delegated_info').html(parsed_data.delegated_info);
            // dialog.style.display = "block";
        }
    });
}
$('#activity_delegate_submit').click(function () {
    var Select_Proxy = $('#activity_Select_Proxy').val();
    var delegate_Edit = $('#activity_delegate_Edit').val();
    if (Select_Proxy == '' && delegate_Edit == '') {
        alert('All Fields are required');
    } else {
        $.ajax({
            url: 'index.php?module=Home&action=activity_store_delegate_result',
            method: 'POST',
            data: {
                Select_Proxy: Select_Proxy,
                // delegate_Edit: delegate_Edit,
            },
            success: function (data) {
                var delegateModel = document.getElementById("activityDelegatemyModel");
                delegateModel.style.display = "none";
            }
        });
    }
});
var delegateModel = document.getElementById("activityDelegatemyModel");
$(document).on('click', '#activityDelegateclose', function () {
    delegateModel.style.display = "none";
});
$(document).on('click', '.remove-activity-delegate', function () {
    $.ajax({
        url: 'index.php?module=Home&action=activity_remove_delegate_user',
        method: 'POST',
        success: function (data) {
            fetchActivityDelegateDialog();
        }
    });
});

(function ($) {
    $(window).on('load', function () {
        fetchActivityByStatus();
        getPendingActivityRequestCount();
        activitydateBetween('30');
        getActivityGraph('30');
    });
    $('.btn-days-filter').on('click', function () {
        var day = $(this).data('day');
        activitydateBetween(day);
        $('.btn-days-filter').css('color', '');
        $(this).css('color', 'black');
    });
    $(document).on('click', '.activity-search-btn', function () {
        activitySearchHelper();
    });
    $(document).on('keyup', '#activity-search', function (event) {
        if (event.keyCode === 13) {
            activitySearchHelper();
        }
    });

    $('.activity-search-column1').keyup(function () {
        var text = $(this).val().toUpperCase();
        activitySearchColumns(text);
    });
    $('.activity-search-column2').keyup(function () {
        var text = $(this).val().toUpperCase();
        activitySearchColumns(text);
    });

    /* Clear filter on click */
    $('.clear-filter').on('click', function (event) {
        event.preventDefault();
        var type = $(this).data('type');
        if(type == 'activity'){
            $('.activity-filter input:not([type=hidden]').val('');
            $('.activity-filter select').val('');
        }else{
            $('.activity-pending-filter input:not([type=hidden]').val('');
            $('.activity-pending-filter select').val('');
        }
        $('.select2-selection__rendered').html('');
        $('.responsibility').val('');
        $('.filterdatebox').val('');
    });

})(jQuery);