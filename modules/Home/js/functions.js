function initSortable() {

    $('.sortable1, .sortable2').sortable({
        connectWith: ".connectedSortable",
        receive: function (event, ui) {
            if ($(this).children('li').length > 5 && $(this).attr('id') != "sortable2") {
                $(ui.sender).sortable('cancel');
                alert('Maximum allowed columns are already selected');
            }
        }
    });

    $(".sortable1 .nondrag").disableSelection();
}


/* Fetch Opportuinities */
function dateBetween(dateBetween, searchTerm = null, page = null, filter = 0, status = null, type = null, dropped = null, changeColumns = 1) {
    Cookies.set('day', dateBetween, { expires: 1 });
    console.log(dateBetween);
    var isCritical = null;
    getGraph(dateBetween);

    if (changeColumns) // reset columns
        getDefaultColumns('opportunity');
    if (type == "critical") {
        type = null;
        isCritical = true;
    }
    var tabContent = document.getElementById('tab_30days_content');
    $.ajax({
        url: 'index.php?module=Home&action=getOpportunities&' + $('.settings-form').serialize() + '&' + $('.opportunity-filter').serialize() + '&filter=' + filter,
        type: 'GET',
        data: {
            days: dateBetween,
            searchTerm: searchTerm,
            page: page,
            status: status,
            type: type,
            dropped: dropped,
            isCritical: isCritical,
        },
        // beforeSend: function(){
        //     $('.spinner').fadeIn();
        // },
        success: function (check) {
            if (dateBetween == '1200') {
                $('#daysFilterAllLabel').html('All Opportunities');
                $('#daysFilterOpp').html('');
                $('#daysFilter').html('');
                $('#daysFilterDays').html('');
            } else {
                $('#daysFilterAllLabel').html('');
                $('#daysFilterOpp').html('Opportunities Over Last');
                $('#daysFilterDays').html('Days');
                $('#daysFilter').html(dateBetween);
            }
            var data = JSON.parse(check);

            if (!data.delegate) {
                $('#delegateBtn').remove();
            }

            if (changeColumns) {
                $('#opportunity-settings').html(data.columnFilter);
                initSortable();
            }

            if (!filter) {
                $('.opportunity-filter .filter-body').html(data.filters);
                initSelect2();
            }


            /* Filter Values */
            $('.opportunity-filter .filter-method').val('opportunities');
            $('.opportunity-filter .filter-day').val(dateBetween);
            $('.opportunity-filter .filter-status').val(status);
            $('.opportunity-filter .filter-type').val(type);

            $('#tableContent').html(data.data);
            $('#orgCount').html(data.total);
            $('#myTeamCount').html(data.team_count);
            $('#selfCount').html(data.self_count);
            $('#delegateName').html(data.delegate_name);
            $('#criticalStatusCount').html(data.critical_status_count);
            if (data.delegateDetails)
                $('#delegateCount').html(data.delegateDetails);

            $('#fetchedByStatus').html(data.fetched_by_status);
            // tabContent.style.display = 'block';
            document.getElementById('button-30days').style.color = "#c2c2c2";
            document.getElementById('button-60days').style.color = "#c2c2c2";
            document.getElementById('button-90days').style.color = "#c2c2c2";
            if (dateBetween == '30') {
                document.getElementById('button-30days').style.color = "black";
            } else if (dateBetween == '60') {
                document.getElementById('button-60days').style.color = "black";
            } else {
                document.getElementById('button-90days').style.color = "black";
            }
            document.getElementById('search-icon').style.color = "green";
        },
        complete: function(){
    	    $('.spinner').fadeOut();
            console.log('Data Loaded');
        }
    });
    var i, tabcontent, tablinks;

}

/* Fetch Pending Opportunities */
function fetchByStatus(status, filter = 0, page = null, changeColumns = 1) {
    console.log(status);
    if (changeColumns) // reset columns
        getDefaultColumns('pending');

    $.ajax({
        url: 'index.php?module=Home&action=getPendingOpportunityList&' + $('.pending-settings-form').serialize() + '&' + $('.pending-filter').serialize() + '&filter=' + filter,
        data: {
            status: status,
            page: page
        },
        success: function (data) {
            $('#pending-requests').html(data);
            data = JSON.parse(data);
            $('#pending-requests').html(data.data);
            if (changeColumns) {
                $('#pending-settings').html(data.columnFilter);
                initSortable();
            }
            if (!filter) {
                $('.pending-filter .filter-body').html(data.filters);
                initSelect2();
            }
            document.getElementById(status).style.background = "black";
            document.getElementById(status).style.borderRadius = "4px";
            $('.pending-filter .filter-method').val('pending');
            $('.pending-filter .filter-day').val('30');
            $('.pending-filter .filter-status').val(status);
        }
    });
}

/* Fetch pending opportunities count */
function getPendingRequestCount() {
    $.ajax({
        url: 'index.php?module=Home&action=opportunity_pending_count',
        type: 'POST',
        data: $('.approval-form').serialize(),
        success: function (res) {
            res = JSON.parse(res)
            $('.pending-request-count').html(res.data);
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

/* Fetch Graph */
function getGraph(dateBetween = null) {
    /*if(!dateBetween)
        dateBetween = 30;*/
    $.ajax({
        url: 'index.php?module=Home&action=get_graph&dateBetween=' + dateBetween,
        type: 'GET',
        /*data: {
            dateBetween: dateBetween
        },*/
        success: function (data) {
            $('#graph').html(data);
        }
    });
}

/* approval popup */
function openApprovalDialog(event, status = null, id = null) {
    var dialog = document.getElementById('approvalModal');
    if (event === "discard") {
        dialog.style.display = "none";
    } else if (event === "close") {
        dialog.style.display = "none";
    } else {
        dialog.style.display = "block"
    }

    if (id) {
        $.ajax({
            url: 'index.php?module=Home&action=get_approval_item',
            type: 'POST',
            data: {
                opp_id: id,
                status: status,
                event: event
            },
            success: function (data) {
                $('#approval-data').html(data);
            }
        });
    }
}

/* Approve / Reject Opportunity */
function updateStatus() {
    var Status = $('.changed-status').val();
    $.ajax({
        url: 'index.php?module=Home&action=opportunity_status_update',
        type: 'POST',
        data: $('.approval-form').serialize(),
        success: function (data) {
            data = JSON.parse(data);
            if (data.status) {
                fetchByStatus(Status);
                getPendingRequestCount();
                openApprovalDialog('close');
                dateBetween('30')
            } else {
                alert(data.message);
            }
            //$('#approval-data').html(data);
            var assigned_name = data.assigned_name;
            var assigned_id = data.assigned_id;
            var s=data.opp_status;
            var r=data.rfp; 
            var opps_id= data.opps_id
            if(r=="Yes"){
                r="yes";
            }
            else if(r=="No"){
                r="no";
            }
            else if(r=="Not Required"){
                r="not_required";
            }
            $.ajax({
                        url : 'index.php?module=Opportunities&action=fetch_reporting_manager',
                        type : 'POST',
                        dataType: "json",
                        data:{
                        opps_id,
                        assigned_name,
                        assigned_id,
                        s,
                        r
                        },
                        success : function(data_approver){
                        
                        
                    // data=JSON.parse(data_approver);
                        var multiple_approvers_id=data_approver.approvers_id;
                        if(r=='no'){
                            
                            if(s=='Qualified'){
                                
                                $.ajax({
                                        url : 'index.php?module=Home&action=update_multiple_approver',
                                        type : 'POST',
                                        dataType: "json",
                                        data:{
                                        opps_id,
                                        multiple_approvers_id
                                        },
                                        success : function(data_approver){
                                            
                                        }
                                                })
                                
                            }
                            
                        }
                        else if(r=='yes'){
                            if(s=='QualifiedLead'){
                                $.ajax({
                                        url : 'index.php?module=Home&action=update_multiple_approver',
                                        type : 'POST',
                                        dataType: "json",
                                        data:{
                                        opps_id,
                                        multiple_approvers_id
                                        },
                                        success : function(data_approver){
                                            
                                        }
                                                })
                                
                                
                            }
                            
                        }
                        else if(r=='not_required'){
                            if(s=='Qualified'){
                                $.ajax({
                                        url : 'index.php?module=Home&action=update_multiple_approver',
                                        type : 'POST',
                                        dataType: "json",
                                        data:{
                                        opps_id,
                                        multiple_approvers_id
                                        },
                                        success : function(data_approver){
                                            
                                        }
                                                })
                                
                                
                            }
                            
                        }
                        
                        
                    } 
            });
        }
    });
}


function openPendingRequestTable(event) {
    var temp = document.getElementsByClassName('pending-request-count');
    var pendingReqCount = temp[0].innerText;
    var dialog = document.getElementById('pending-request-table-container');
    if (pendingReqCount != '0') {
        if (dialog.style.display === "block") {
            dialog.style.display = "none";
        } else {
            dialog.style.display = "block"
        }
    } else {
        dialog.style.display = "none";
    }
    fetchByStatus('qualifylead');
}


/* Pagination Helper */
function paginate(page, method, day, searchTerm = null, filter = 0, status = null, type = null) {
    if (method == 'opportunity') {
        dateBetween(day, searchTerm, page, filter, status, type, '', 0);
    } else if (method == 'pending') {
        fetchByStatus(status, filter, page, 0);
    }
}

/* Search Helper */
function searchHelper() {
    var $this = $('#opportunity-search');
    var searchTerm = $this.val();
    var method = $this.data('method');
    var day = $this.data('day');
    var type = $this.data('type');
    var status = $this.data('status');

    dateBetween(day, searchTerm, '', '', status, type, 0);
}

/* settings helper */
/*function openSettingDialog(event, status = null, type = null) {

    console.log(status);
    console.log(type);

    var dialog = document.getElementById('setting_myModal');
    if (event === "discard") {
        dialog.style.display = "none";
    } else if (event === "close") {
        dialog.style.display = "none";
    } else if (event === "submit") {
        //
    } else {
        dialog.style.display = "block"
    }

    if (event == 'opportunities') {
        $('.settings-section').val('opportunities');
    } else if (event == 'pendings') {
        $('.settings-section').val('pendings');
    }
    // $('.settings-day').val(day);

    if (type)
        $('.settings-type').val(type);
    else
        $('.settings-type').val('');

    if (status)
        $('.settings-status').val(status);
    else
        $('.settings-status').val('');

}*/

function openSettingDialog(event, type = null, value = null) {

    var dialog = document.getElementById('setting_myModal');
    $('#search-column1').val('');
    searchColumns('');
    if (event === "discard") {
        dialog.style.display = "none";
    } else if (event === "close") {
        dialog.style.display = "none";
    } else if (event === "submit") {

    } else {
        dialog.style.display = "block"
    }

    if(event == 'opportunities'){
        $('.settings-section').val('opportunities');
    }else if(event == 'pendings'){
        $('.settings-section').val('pendings');
    }

    if(type){
        $('.settings-type').val(type);
    }
    if(value){
        $('.settings-type-value').val(value);
    }

}

function openPendingSettingsDialog(event, type = null, value = null) {
    var dialog = document.getElementById('pending_setting_myModal');
    $('#search-column2').val('');
    searchColumns('');
    if (event === "discard") {
        dialog.style.display = "none";
    } else if (event === "close") {
        dialog.style.display = "none";
    } else if (event === "submit") {

    } else {
        dialog.style.display = "block"
    }

    $('.pending-settings-section').val('pendings');
    if (type) {
        $('.pending-settings-type').val(type);
    }
    if (value) {
        $('.pending-settings-type-value').val(value);
    }
}

function commitFilter() {
    var settingsSection = $('.settings-section').val();
    // var settingsDay = $('.settings-day').val();
    var settingsType = $('.settings-type').val();
    var settingsStatus = $('.settings-status').val();
    var settingsValue = $('.settings-type-value').val();
    var day = Cookies.get('day');


    if (settingsSection == 'opportunities') {
        dateBetween(day, '', '', '', settingsValue, settingsType, '', 0);
    } else {
        fetchByStatus(settingsValue, '', '', 0);
    }
    openSettingDialog('close');
}
/* end settings helper */

function commitPendingFilter() {
    var settingsSection = $('.pending-settings-section').val();
    var settingsType = $('.pending-settings-type').val();
    var settingsValue = $('.pending-settings-type-value').val();
    $('#search-column1').val('');
    searchColumns('');
    settingsValue = settingsValue.replace('-', ' ');
    fetchByStatus(settingsValue, '', '', 0);

    openPendingSettingsDialog('close');
}

$('#search-column1').keyup(function () {
    var text = $(this).val().toUpperCase();
    searchColumns(text);
});
$('#search-column2').keyup(function () {
    var text = $(this).val().toUpperCase();
    searchColumns(text);
});

function searchColumns(text) {
    // Search text
    //case-insensitive
    class1 = "opportunity-settings";
    class2 = "pending-settings";
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

/* Filter Helper */
function openFilterDialog(event) {
    var dialog = document.getElementById('filter_myModal');
    if (event === "discard") {
        dialog.style.display = "none";
    } else if (event === "close") {
        dialog.style.display = "none";
    } else if (event == 'submit') {
        filterHelper('opportunity-filter');
        dialog.style.display = "none";
    } else {
        dialog.style.display = "block"
    }
}

function openPendingFilterDialog(event) {
    var dialog = document.getElementById('pending_filter_myModal');
    if (event === "discard") {
        dialog.style.display = "none";
    } else if (event === "close") {
        dialog.style.display = "none";
    } else if (event == 'submit') {
        filterHelper('pending-filter');
        dialog.style.display = "none";
    } else {
        dialog.style.display = "block"
    }
}

/**
 * Delegate pop-up open
 *
 */

function fetchDelegateDialog() {
    getDelegateMembers();
    var dialog = document.getElementById('delegatemyModel');
    dialog.style.display = "block";
    $.ajax({
        url: 'index.php?module=Home&action=delegated_dialog_info',
        type: 'GET',
        data: {},
        success: function (data) {
            debugger
            var parsed_data = JSON.parse(data);
            $('#delegated_info').html(parsed_data.delegated_info);
            // dialog.style.display = "block";
        }
    });
}

function filterHelper(ref) {
    if (ref == 'opportunity-filter') {
        var filterMethod = $('.opportunity-filter .filter-method').val();
        var filterDay = $('.opportunity-filter .filter-day').val();
        var filterType = $('.opportunity-filter .filter-type').val();
        var filterStatus = $('.opportunity-filter .filter-status').val();
    } else {
        var filterMethod = $('.pending-filter .filter-method').val();
        var filterDay = $('.pending-filter .filter-day').val();
        var filterStatus = $('.pending-filter .filter-status').val();
    }

    if (ref == 'opportunity-filter') {
        dateBetween(30, '', '', 1, filterStatus, filterType, '', 0);
    } else {
        fetchByStatus(filterStatus, 1, '', 0);
    }
}
/* End Pending filter */

/* Sequence Flow */
function getSequenceFlow(oppID) {
    $.ajax({
        url: "index.php?module=Home&action=getOpportunityStatusTimeline",
        method: "POST",
        data: { oppID: oppID },
        success: function (response) {
            var html = JSON.parse(response).data;
            $('.sequence-flow').html(html);
            $('.backdrop').fadeIn();
            $('.sequence-flow').fadeIn();
            $('body').addClass('no-scroll');
        }
    });
}

function fetchDeselectDialog(id) {
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

/* load misc data */
function getUserDetails() {
    $.ajax({
        url: "index.php?module=Home&action=get_user_details",
        method: "GET",
        success: function (data) {
            var addOpportunity = document.getElementById('add_opportunity');
            var parsed_data = JSON.parse(data);
            if ((parsed_data && parsed_data.user_team && !(parsed_data.user_team.includes('^sales^')))
                    || parsed_data.user_id == '1') {
                addOpportunity.style.display = "none";
                setTimeout(function () {
                    var hideOpportunity = document.getElementsByClassName('dashboard_opp_hide');
                    for (let i = 0; i < hideOpportunity.length; i++) {
                        hideOpportunity[i].style.display = "none";
                    }
                }, 100);

            }
            if (parsed_data.mc_c == "no") {
                var reportContainerBtn = document.getElementById('get-emp-report-button button');
                reportContainerBtn.style.display = "none";
            }
        }
    });
}

function getDelegateMembers() {
    $.ajax({
        url: "index.php?module=Home&action=delegate_members",
        method: "GET",
        success: function (data) {
            var parsed_data = JSON.parse(data);
            // console.log(parsed_data);
            $('#Select_Proxy').html(parsed_data.members);
            $('#Select_Proxy').val('');
            $('.responsibility').html(parsed_data.members);
            document.getElementById('responsibility1').value = null;
            document.getElementById('responsibility').value = null;
        }
    });
}
function getTagList() {
    $.ajax({
        url: "index.php?module=Home&action=tag_list",
        method: "GET",
        success: function (data) {
            var parsed_data = JSON.parse(data);
            $('#deselect_members').html(parsed_data.members);
        }
    });
}

function openDeselectDialog(event) {

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
function deselectDropDownClicked() {
    document.getElementById('deselect_members').style.display == "none" ?
        document.getElementById('deselect_members').style.display = "block" :
        document.getElementById('deselect_members').style.display = "none";
}
function deselectDropDownUnclicked() {
    document.getElementById('deselect_members').style.display = "none";
}
function clearDeselectDropDownValue() {
    $('#hidden_user').val('');
    $('#deselect_members').val('');
    $('#hidden_multi_select').val('');
}

function getDefaultColumns(type) {
    if (type == 'opportunity') {
        var html = $('#opportunity-settings');
        var DefaultColumns = '<form class="settings-form sort-column">';
    } else if (type == 'pending') {
        var html = $('#pending-settings');
        var DefaultColumns = '<form class="pending-settings-form sort-column">';
    }

    DefaultColumns += '<input type="hidden" name="settings-section" class="settings-section" value=""> <input type="hidden" name="settings-type" class="settings-type" value=""> <input type="hidden" name="settings-type-value" class="settings-type-value" value=""> <ul id="sortable1" class="sortable1 connectedSortable ui-sortable"> <li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="new_department_c" value="new_department_c" checked="True" style="display: none"> <input class="settingInputs" type="checkbox" id="name-select" name="customColumns[]" value="new_department_c" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Department</label> </li><li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="REP-EOI-Published" value="REP-EOI-Published" checked="True" style="display: none"> <input class="settingInputs" type="checkbox" id="name-select" name="customColumns[]" value="REP-EOI-Published" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> RFP/EOI Published</label> </li><li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="Closed-Date" value="Closed-Date" checked="True" style="display: none"> <input class="settingInputs" type="checkbox" id="name-select" name="customColumns[]" value="Closed-Date" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Modified Date</label> </li><li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="Closed-by" value="Closed-by" checked="True" style="display: none"> <input class="settingInputs" type="checkbox" id="name-select" name="customColumns[]" value="Closed-by" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Modified By</label> </li><li class="ui-sortable-handle"> <input class="settingInputs" type="checkbox" id="name-select" name="Date-Created" value="Date-Created" checked="True" style="display: none"> <input class="settingInputs" type="checkbox" id="name-select" name="customColumns[]" value="Date-Created" checked="True" style="display: none"> <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Created Date</label> </li></ul>';
    html.html(DefaultColumns);
    initSortable();
}

function initSelect2() {
    jq('.select2').select2();
    initDatePicker();
}

function initDatePicker() {
    jq('.filterdatebox').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoApply: true,
        open: 'left',
        minYear: 1901,
        maxYear: parseInt(moment().format('YYYY'), 10) + 1,
        locale: {
            format: 'DD/MM/YYYY'
        },
        autoUpdateInput: false,
    }, function (start, end, label) {
        var difference = moment().diff(start, 'years');
    });

    jq('.filterdatebox').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY'));
    });

    jq('.filterdatebox').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('');
    });
}


/**
 * Re-assignment-comment
 */

function fetchReassignmentDialog(oppID) {
    var dialog = document.getElementById('reassignmentModal');
    dialog.style.display = "block";
    var res1;
    var oppss_id = oppID;
    $.ajax({
        url: 'index.php?module=Home&action=new_assigned_list',
        type: 'POST',
        data: {
            oppss_id,
        },

        success: function (data1) {
            datw = JSON.parse(data1);
            res1 = datw.a;
            op_name = datw.op_name;
            var user_list = [];
            $('#ra_op_name').html("Opportunity Name: " + op_name);
            $('#assigned_opp_id').val(datw.id);
            $('#ass_name').html("Assigned User Name: " + datw.present_assigned_user);

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



            $('#assigned_to_new_c').autocomplete({
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
    var f = $('#assigned_to_new_c').val();

    var e = f.length;

    var s = f.indexOf("/");

    f = f.slice(0, s);

    f = f.replace(/[^ \, a-zA-Z]+/g, '');

    f = f.replace(/^\s+/g, '');
    $('#assigned_to_new_c').val(f);
});

function handleReassignmentDialog(event) {
    var dialog = document.getElementById('reassignmentModal');
    switch (event) {
        case "discard":
        case "close":
            dialog.style.display = "none";
            break;
        case "submit":
            if (document.getElementById('hidden_value') && document.getElementById('hidden_multi_select')) {
                var assigned_opportunity_id = document.getElementById('assigned_opp_id').value;
                var assigned_name = document.getElementById('assigned_to_new_c').value;

            }
            $.ajax({
                url: 'index.php?module=Home&action=update_home_assigned_id',
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
                            url: 'index.php?module=Home&action=assigned_history',
                            type: 'POST',
                            data: {
                                opp_id: assigned_opportunity_id,
                                assigned_name: assigned_name
                            },
                            success: function (data) {
                            }
                        });

                        dialog.style.display = "none";
                        location.reload();
                    }
                }
            });
            break;
        default:
            dialog.style.display = "block";
    }
}

function initializeReportTable(changedVal = '3.14') {
    var example1 = document.getElementById('example1');
    var url = 'index.php?module=Home&action=get_report_table_data';
    if (changedVal) {
        url += '&team_lead=' + changedVal;
    }
    $.ajax({
        url: url,
        method: "GET",
        success: function (data) {
            var parsed_data = JSON.parse(data);
            if(parsed_data) {
                var hot = new Handsontable(example1, {
                    data: parsed_data.data,
                    colHeaders: true,
                    rowHeaders: true,
                    manualColumnResize: true,
                    columns: [{type: 'text', readOnly: true},{readOnly: true},{readOnly: true},{readOnly: true},{readOnly: true},
                    {readOnly: true},{readOnly: true},{readOnly: true},{readOnly: true},{readOnly: true},
                    {readOnly: true},{readOnly: true},{readOnly: true},{readOnly: true},{readOnly: true},
                    {readOnly: true},{readOnly: true},{readOnly: true},{readOnly: true},{readOnly: true},{readOnly: true}],
                    colWidths: [200, 60, 150, 60, 150,
                         60, 150, 60, 150, 60,
                         150, 60, 150, 60, 150,
                         60, 150, 60, 150, 100, 100],
                    // filters: true,
                    // dropdownMenu: true,
                    width: '100%',
                    height: 320,
                    // rowHeights: 25,
                    nestedHeaders: [
                      ['', {label: '', colspan: 18}, ''],
                      ['', {label: 'Number of Contracts Created and Total Value of Contracts', colspan: 2}, {label: 'Lead Stage', colspan: 2}, {label: 'Qualified Lead Stage', colspan: 2},
                      {label: 'Qualified Opportunity Stage', colspan: 2}, {label: 'Qualified DPR Stage', colspan: 2}, {label: 'Qualified Bid Stage', colspan: 2},
                      {label: 'Closed Win Stage', colspan: 2},{label: 'Closed Lost Stage', colspan: 2}, {label: 'Dropped Stage', colspan: 2}],
                      ['Users', 'Number Of Contracts', 'Total Value Of Contracts', 'Number', 'Value', 'Number', 'Value', 'Number', 'Value',
                      'Number', 'Value', 'Number', 'Value', 'Number', 'Value', 'Number', 'Value', 'Number', 'Value',
                      'Participated In', 'Expected Inflow Date']
                    ],
                    collapsibleColumns: [
                      {row: -3, col: 1, collapsible: true},
                    ],
                    columnSorting: true,
                    // fixedRowsBottom: 1,
                    afterGetColHeader: function (col, TH) {
                        $(TH).css('text-align', 'left');
                     }
              
                  });
                  hot.getPlugin('collapsibleColumns').collapseSection({row: -3, col: 1});
                  window.hot = hot;
            }
        }
    });
}

function openUserReport() {
    var reportContainer = document.getElementById('example1');
    var reportDropdownContainer = document.getElementById('team-lead-dropdown-container');
    reportDropdownContainer.style.visibility = (reportDropdownContainer.style.visibility == "visible") ? "hidden" : "visible";
    reportContainer.style.visibility = (reportContainer.style.visibility == "visible") ? "hidden" : "visible";
}

function teamFilterForReport() {
    $.ajax({
        url: 'index.php?module=Home&action=get_team_filter_report_table',
        type: 'GET',
        success: function (data) {
            data = JSON.parse(data);
            if (data) {
                $('#team_lead_dropdown').html(data.data);
            }
        }
    });
}

function criticalStatus(id) {
    var criticalIcon = document.getElementById(id);
    if (criticalIcon.style.color == "red") {
        criticalStatusChanged(id, 'no');
    } else {
        $.ajax({
            url: 'index.php?module=Home&action=update_critical_status',
            type: 'GET',
            data: {
                id: id
            },
            success: function (data) {
                var main_data = JSON.parse(data);
                alert("Opportunity added to Critical List");
                $('#criticalStatusCount').html(main_data.critical_status_count);
                criticalIcon.style.color = main_data.color;
            }
        })
    }
    
}

function criticalStatusChanged(id, noRefresh = null) {
    var day = Cookies.get('day');
    var criticalIcon = document.getElementById(id);
    $.ajax({
        url: 'index.php?module=Home&action=update_critical_status_changed',
        type: 'GET',
        data: {
            id: id
        },
        success: function (data) {
            var main_data = JSON.parse(data);
            alert("Removed Opportunity from Critical List");
            debugger
            $('#criticalStatusCount').html(main_data.critical_status_count);
            criticalIcon.style.color = "black";
            if(!noRefresh) {
                dateBetween(day, '', '', '', '', 'critical', 1);
            }
        }
    })
}

/* jQuery Functions */
(function ($) {
    $(window).on('load', function () {
        loadOpportunities()
    });
    $(document).on('click', '#one-tab', function () {
        loadOpportunities();
    });

    function loadOpportunities(){
        var day = Cookies.get('day');
        $('.spinner').fadeIn();
        fetchByStatus('qualifylead');
        dateBetween('30');
        getPendingRequestCount();
        getTagList();
        initializeReportTable();
        teamFilterForReport();
    }

    $('.btn-days-filter').on('click', function () {
        var day = $(this).data('day');
        console.log(day);
        dateBetween(day);
        $('.btn-days-filter').css('color', '');
        $(this).css('color', 'black');
    });

    $(document).on('click', '.opportunity-search-btn', function () {
        searchHelper();
    });
    $(document).on('keyup', '#opportunity-search', function (event) {
        if (event.keyCode === 13) {
            searchHelper();
        }
    });
    $(document).on('change', '#team_lead_dropdown', function (event) {
        initializeReportTable(event.target.value);
    });

    /* Clear filter on click */
    $('#filter_clear').click(function (event) {
        event.preventDefault();
        $('.opportunity-filter input:not([type=hidden]').val('');
        $('.opportunity-filter select').val('');
        $('.pending-filter input:not([type=hidden]').val('');
        $('.pending-filter select').val('');
        $('.select2-selection__rendered').html('');
        $('.responsibility').val('');
        $('.filterdatebox').val('');
        $('.rfp-checkbox').each(function (index) {
            $(this).prop('checked', false);
        });
        var lower = document.getElementsByClassName('lowerVal');
        var upper = document.getElementsByClassName('upperVal');
        var rangeMin = document.getElementsByClassName('range_min');
        var rangeMax = document.getElementsByClassName('range_max');
        for (let index = 0; index < lower.length; index++) {
            lower[index].value = '0';
            upper[index].value = '200';
            rangeMin[index].innerHTML = '0 Cr';
            rangeMax[index].innerHTML = '200 Cr';
        }
    });
    $('#delegate_submit').click(function () {
        var Select_Proxy = $('#Select_Proxy').val();
        var delegate_Edit = $('#delegate_Edit').val();
        if (Select_Proxy == '' && delegate_Edit == '') {
            $('#delegate_response').html('<span class="text-danger">All Fields are required</span>');
        } else {
            $.ajax({
                url: 'index.php?module=Home&action=store_delegate_result',
                method: 'POST',
                data: {
                    Select_Proxy: Select_Proxy,
                    // delegate_Edit: delegate_Edit,
                },
                success: function (data) {
                    var delegateModel = document.getElementById("delegatemyModel");
                    delegateModel.style.display = "none";
                    // fetchDelegateDialog();
                }
            });
        }
    });
    var delegateModel = document.getElementById("delegatemyModel");
    $(document).on('click', '#delegateclose', function () {
        delegateModel.style.display = "none";
    });
    $(document).on('click', '.remove-delegate', function () {
        $.ajax({
            url: 'index.php?module=Home&action=remove_delegate_user',
            method: 'POST',
            success: function (data) {
                fetchDelegateDialog();
            }
        });
    })
    /* Download Button Click */
    $(document).on('click', '#download_btn', function () {
        var type = $(this).data('type');
        var value = $(this).data('value');
        var action = $(this).data('action');
        var formData = '';
        var dropped = '';
        if (action == 'dayFilter') {
            formData = { day: value, filter: 1 };
        } else if (action == 'type') {
            formData = { csvtype: value, filter: 1 }
        } else {
            dropped = $(this).data('dropped') ? $(this).data('dropped') : '';
            formData = { status_c: value, dropped: dropped, filter: 1 }
        }

        if (type == 'opportunity')
            var url = "index.php?module=Home&action=export&" + $('.opportunity-filter').serialize();
        else
            var url = "index.php?module=Home&action=export&" + $('.pending-filter').serialize();

        $.ajax({
            url: url,
            method: "GET",
            data: formData,
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
                if (data.status == 'success') {
                    window.location.href = 'index.php?module=Home&action=downloadCSV';
                } else {
                    alert('Somthing went wrong. Please try again');
                }
            }
        });
    });

    $(document).ready(function () {
        document.getElementById('deselect_members').style.display = "none";
        // var addOpportunity = document.getElementById('add_opportunity');
        getUserDetails();
    });

})(jQuery);