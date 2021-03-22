function getPendingActivityRequestCount() {
    $.ajax({
        url: 'index.php?module=Home&action=activity_pending_count',
        type: 'POST',
        data: $('.approval-form').serialize(),
        success: function (res) {
            res = JSON.parse(res)
            $('.pending-activity-request-count').html(res.count + " <i class='fa fa-angle-double-down' aria-hidden='true'></i>");
            if (res && res.count == 0) {
                $('#click-here-text-activity').html('');
                $('#approve-pending-text-activity').html('No Requests Pending For Approval');
            } else {
                $('#click-here-text-activity').html('Click here');
                $('#approve-pending-text-activity').html('to Approve Pending request');
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
            if (document.getElementById(status)) {
                document.getElementById(status).style.background = "black";
                document.getElementById(status).style.borderRadius = "4px";
            }
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
            var i, tabcontent, tablinks;
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
            var teamCount;
            if (data.user_id == 1) {
                teamCount = 0
            }
            else {
                teamCount = data.team_count;
            }
            $('#myTeamActivityCount').html(teamCount);
            // $('#delegateName').html(data.delegate_name);
            $('#delegateActivityName').html('0 (No Delegations)');
            if (data.delegateDetails != '') {
                $('#delegateActivityName').html(data.delegateDetails);
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
        url: 'index.php?module=Home&action=activity_reminder_dialog_info',
        type: 'GET',
        data: {
            id: id
        },
        success: function (data) {
            var parsed_data = JSON.parse(data);
            $('#activity_info').html(parsed_data.activity_info);
            document.getElementById('hidden_value').value = parsed_data.activity_id;
            dialog.style.display = "block";
            // $('#hidden_user').val(parsed_data.msuname);
            // var temp = parsed_data.msuid.split(',');
            // $('#deselect_members').val(temp);
        }
    })

}

/**
 * TO OPEN TAG POP-UP
 * @param {opp_id} id
 */

function fetchTagDialog(id) {
    var dialog = document.getElementById('tag-activity-modal');

    $.ajax({
        url: 'index.php?module=Home&action=activity_tag_dialog_info',
        type: 'GET',
        data: {
            id: id
        },
        success: function (data) {
            var parsed_data = JSON.parse(data);
            $('#activity_tag_info').html(parsed_data.activity_info);
            $('#activity_member_info').html(parsed_data.optionList);
            document.getElementById('activity_tag_id').value = parsed_data.activity_id;
            dialog.style.display = "block";
            initSelect2();
            // $('#hidden_user').val(parsed_data.msuname);
            // var temp = parsed_data.msuid.split(',');
            // $('#deselect_members').val(temp);
        },
        error: function (data, errorThrown) {
            alert(errorThrown)
        }
    })

}
function activitydeselectDropDownClicked() {
    document.getElementById('activity_member_info').style.display == "none" ?
        document.getElementById('activity_member_info').style.display = "block" :
        document.getElementById('activity_member_info').style.display = "none";
}
function activitydeselectDropDownUnclicked() {
    document.getElementById('activity_member_info').style.display = "none";
}
function activityclearDeselectDropDownValue() {
    $('#activity_hidden_user').val('');
    $('#activity_member_info').val('');
    $('#activity_hidden_multi_select').val('');
}

/**
 * TO HANDLE DIFFERENT EVENTS OF TAG POPUP
 * @param {discard,submit and close} event 
 */

function handleTagDialog(event) {

    var dialog = document.getElementById('tag-activity-modal');
    // var select_dialogue = document.getElementById('activity_member_info');
    if (event === "discard") {
        dialog.style.display = "none";
        // select_dialogue.style.display = "none";
    } else if (event === "close") {
        dialog.style.display = "none";
        // select_dialogue.style.display = "none";
    } else if (event === "submit") {
        console.log($('.activity_tag_func').serialize());
        $.ajax({
            url: 'index.php?module=Home&action=set_activity_for_tag',
            type: 'POST',
            data: $('.activity_tag_func').serialize(),
            success: function (data) {
                dialog.style.display = "none";
                select_dialogue.style.display = "none";
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
        var frequency = document.getElementById('frequency').value;
        var time = document.getElementById('time').value;
        console.log(hidden_id);
        $.ajax({
            url: 'index.php?module=Home&action=set_activity_reminder',
            type: 'POST',
            data: {
                activityId: hidden_id,
                frequency: frequency,
                time: time
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

    DefaultColumns += '<input type="hidden" name="activity-settings-section" class="activity-settings-section" value=""> <input type="hidden" name="acitivity-settings-type" class="activity-settings-type" value=""> <input type="hidden" name="activity-settings-type-value" class="activity-settings-type-value" value=""> <ul id="sortable1" class="sortable1 connectedSortable ui-sortable"> <li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="name" value="name" checked="True" style="display: none"> <input class="settingInputs" type="checkbox" id="name-select" name="customActivityColumns[]" value="name" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Activity</label> </li><li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="related_to" value="related_to" checked="True" style="display: none"> <input class="settingInputs" type="checkbox" id="name-select" name="customActivityColumns[]" value="related_to" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Related To</label> </li><li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="status" value="status" checked="True" style="display: none"> <input class="settingInputs" type="checkbox" id="name-select" name="customActivityColumns[]" value="status" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Status</label> </li><li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="activity_date_c" value="activity_date_c" checked="True" style="display: none"> <input class="settingInputs" type="checkbox" id="name-select" name="customActivityColumns[]" value="activity_date_c" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> End Date</label> </li><li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="date_modified" value="date_modified" checked="True" style="display: none"> <input class="settingInputs" type="checkbox" id="name-select" name="customActivityColumns[]" value="date_modified" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Last Updated</label> </li><li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="assigned_to_c" value="assigned_to_c" checked="True" style="display: none"> <input class="settingInputs" type="checkbox" id="name-select" name="customActivityColumns[]" value="assigned_to_c" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Assigned To</label> </li>';
    DefaultColumns += '<li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="next_date_c" value="next_date_c" checked="True" style="display: none"> <input class="settingInputs" type="checkbox" id="name-select" name="customActivityColumns[]" value="next_date_c" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Next Follow-Up / Interaction Date</label> </li><li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="name_of_person_c" value="name_of_person_c" checked="True" style="display: none"> <input class="settingInputs" type="checkbox" id="name-select" name="customActivityColumns[]" value="name_of_person_c" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Name of Person Contacted</label> </li></ul>';
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

    if (event == 'activity') {
        $('.activity-settings-section').val('activity');
    } else if (event == 'pendings') {
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
function changeAddLabel(evnt) {
    $('.add-opportunity-title').html(evnt);
    var redirectLink = "'./index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26action%3DEditView%26return_module%3DOpportunities%26return_action%3DDetailView'";
    if (evnt == 'Create Activity') {
        redirectLink = "'index.php?module=Calls&action=EditView'";
    }
    $("#add_opportunity").attr("onclick", "location.href = " + redirectLink);
}

function activityFilterHelper(ref) {
    var day = Cookies.get('day') ? Cookies.get('day') : 30;
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
        activitydateBetween(day, '', '', 1, filterStatus, filterType, '', 0);
        console.log("filter status , filter Type", filterStatus, filterType);

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

/* Sequence Flow */
function getActivitySequenceFlow(accID) {
    $.ajax({
        url: "index.php?module=Home&action=getActivityStatusTimeline",
        method: "POST",
        data: { accID: accID },
        success: function (response) {
            var html = JSON.parse(response).data;
            $('.sequence-flow-activity').html(html);
            $('.backdrop-activity').fadeIn();
            $('.sequence-flow-activity').fadeIn();
            $('body').addClass('no-scroll');
        }
    });
}
$(document).on('click', '.close-sequence-flow-activity', function () {
    $('.backdrop').fadeOut();
    $('.sequence-flow-activity').slideUp();
    $('.sequence-flow-activity').html('');
    $('body').removeClass('no-scroll');
})

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
/* reassignment model */

function activityfetchReassignmentDialog(accID) {
    var dialog = document.getElementById('activityreassignmentModal');
    dialog.style.display = "block";
    var res1;
    var acc_id = accID;
    $.ajax({
        url: 'index.php?module=Home&action=activity_new_assigned_list',
        type: 'POST',
        data: {
            acc_id,
        },

        success: function (data1) {
            datw = JSON.parse(data1);
            res1 = datw.a;
            var acc_name = datw.acc_name;
            var user_list = [];
            $('#ra_ac_name').html("Activity Name: " + acc_name);
            $('#assigned_activity_id').val(datw.id);
            $('#activity_assigned_name').html("Assigned User Name: " + datw.present_assigned_user);

            for (var z in res1) {
                res1[z] = res1[z].replace(/\^/g, ' ');
                res1[z] = res1[z].replace('team_lead', 'TL');
                res1[z] = res1[z].replace('team_member_l1', 'TM L1');
                res1[z] = res1[z].replace('team_member_l2', 'TM L2');
                res1[z] = res1[z].replace('team_member_l3', 'TM L3');

            }

            for (var i in res1) {
                user_list.push(res1[i])
            };



            $('#activity_assigned_to_new_c').autocomplete({
                source: user_list,
                minLength: 0,
                scroll: true
            }).keydown(function () {
                $(this).autocomplete("search", "");
            });

        }

    });
}

$(document).on('click', '.ui-autocomplete', function () {
    var f = $('#activity_assigned_to_new_c').val();

    var e = f.length;

    var s = f.indexOf("/");

    f = f.slice(0, s);

    f = f.replace(/[^ \, a-zA-Z]+/g, '');

    f = f.replace(/^\s+/g, '');
    $('#activity_assigned_to_new_c').val(f);
});

function activityhandleReassignmentDialog(event) {
    var dialog = document.getElementById('activityreassignmentModal');
    switch (event) {
        case "discard":
        case "close":
            dialog.style.display = "none";
            break;
        case "submit":

            var assigned_opportunity_id = document.getElementById('assigned_activity_id').value;
            var assigned_name = document.getElementById('activity_assigned_to_new_c').value;

            $.ajax({
                url: 'index.php?module=Home&action=activity_update_assigned',
                type: 'POST',
                data: {
                    opp_id: assigned_opportunity_id,
                    assigned_name: assigned_name
                },
                success: function (data) {
                    dat = JSON.parse(data)
                    if (dat.message == "false") {
                        alert("Please check assigned user name");
                    }

                    else {



                        $.ajax({
                            url: 'index.php?module=Home&action=activity_assigned_history',
                            type: 'POST',
                            data: {
                                opp_id: assigned_opportunity_id,
                                assigned_name: assigned_name
                            },
                            success: function (data) {
                            }
                        });

                        dialog.style.display = "none";


                        $('#two-tab').trigger('click');

                        //  location.reload();


                    }
                },
                complete: function () {
                    activitydateBetween(Cookies.get("day"));
                }
            });

            break;
        default:
            dialog.style.display = "block";
    }
}

function getDelegateMembersActivity() {
    $.ajax({
        url: "index.php?module=Home&action=delegate_members",
        method: "GET",
        success: function (data) {
            var parsed_data = JSON.parse(data);
            // console.log(parsed_data);
            $('#activity_Select_Proxy').html(parsed_data.members);
            $('#activity_Select_Proxy').val('');
            $('.responsibility').html(parsed_data.members);
            document.getElementById('responsibility1').value = null;
            document.getElementById('responsibility').value = null;
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
var delegateModelForClose = document.getElementById("activityDelegatemyModel");
$(document).on('click', '#activityDelegateclose', function () {
    delegateModelForClose.style.display = "none";
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
    $(document).on('click', '#two-tab', function () {
        var day = Cookies.get('day') ? Cookies.get('day') : 30;
        $('.spinner').fadeIn();
        fetchActivityByStatus();
        getPendingActivityRequestCount();
        activitydateBetween(day);
        getActivityGraph(day);
        getDelegateMembersActivity();
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