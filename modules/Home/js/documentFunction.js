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
    fetchDocumentByStatus('qualifylead');
}

function fetchDocumentByStatus(status, filter = 0, page = null, changeColumns = 1) {
    if (changeColumns) // reset columns
        getDefaultColumns('pending');

    $.ajax({
        url: 'index.php?module=Home&action=getPendingDocumentList&' + $('.pending-settings-form').serialize() + '&' + $('.pending-filter').serialize() + '&filter=' + filter,
        data: {
            status: status,
            page: page
        },
        success: function (data) {
            $('#pending-document-requests').html(data);
            data = JSON.parse(data);
            $('#pending-document-requests').html(data.data);
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
function getPendingDocumentRequestCount() {
    $.ajax({
        url: 'index.php?module=Home&action=opportunity_pending_count',
        type: 'POST',
        data: $('.approval-form').serialize(),
        success: function (res) {
            res = JSON.parse(res)
            $('.pending-document-request-count').html("6 <i class='fa fa-angle-double-down' aria-hidden='true'></i>");
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

function documentdateBetween(dateBetween, searchTerm = null, page = null, filter = 0, status = null, type = null, dropped = null, changeColumns = 1) {
    Cookies.set('day', dateBetween, { expires: 1 });
    if (changeColumns) // reset columns
        getDefaultColumns('opportunity');

    var tabContent = document.getElementById('tab_30days_content');
    $.ajax({
        url: 'index.php?module=Home&action=getDocument&' + $('.settings-form').serialize() + '&' + $('.opportunity-filter').serialize() + '&filter=' + filter,
        type: 'GET',
        data: {
            days: dateBetween,
            searchTerm: searchTerm,
            page: page,
            status: status,
            type: type,
            dropped: dropped,
        },
        success: function (check) {
            // console.log(check);
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

            if (dateBetween === '30') {
                $('#documenttableContent').html(data.data);
                $('#orgDocumentCount').html("35");
                $('#myTeamDocumentCount').html("40");
                $('#selfDocumentCount').html("5");
                $('#delegateDocumentName').html("<p>Bharat Karnani- 35</p><p>Pranav- 20</p><p>Webknot- 25</p>");
                if (data.delegateDetails)
                    $('#delegateDocumentCount').html(data.delegateDetails);

                $('#fetchedByStatus').html(data.fetched_by_status);
                tabContent.style.display = 'block';
            } else if (dateBetween === '60') {
                $('#documenttableContent').html(data.data);
                $('#orgDocumentCount').html("20");
                $('#selfDocumentCount').html("20");
                $('#myTeamDocumentCount').html("20");
                $('#delegateDocumentName').html("<p>Bharat- 15</p><p>Pranav- 20</p><p>Webknot- 25</p>");
                if (data.delegate_name != '') {
                    $('#delegateDocumentCount').html("5");
                }
                $('#fetchedByStatus').html(data.fetched_by_status)
                tabContent.style.display = 'block';

                document.getElementsByClassName('btn-30-days').style.color = "#c2c2c2";
            } else {
                $('#documenttableContent').html(data.data);
                $('#orgDocumentCount').html(data.total);
                $('#selfDocumentCount').html(data.self_count);
                $('#myTeamDocumentCount').html(data.team_count);
                // $('#delegateName').html(data.delegate_name);
                $('#delegateDocumentName').html("<p>Bharat- 15</p><p>Pranav- 20</p><p>Webknot- 25</p>");
                if (data.delegate_name != '') {
                    $('#delegateCount').html(data.delegated_count);
                }
                $('#fetchedByStatus').html(data.fetched_by_status)
                tabContent.style.display = 'block';

                document.getElementsByClassName('btn-30-days').style.color = "#c2c2c2";

            }
            document.getElementById('search-icon').style.color = "green";
        }
    });
    var i, tabcontent, tablinks;

}

function documentpaginate(page, method, day, searchTerm = null, filter = 0, status = null, type = null) {
    if (method == 'opportunity') {
        documentdateBetween(day, searchTerm, page, filter, status, type, 0);
    } else if (method == 'pending') {
        fetchByStatus(status, filter, page, 0);
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
(function ($) {
    $(window).on('load', function () {
        fetchDocumentByStatus('qualifylead');
        getPendingDocumentRequestCount();
        documentdateBetween('30');
        getDocumentGraph('30');
    });
})(jQuery);