<div style="display: flex;flex-direction: column;width: 220px;background-color: white;border-radius: 5px;padding: 10px;width: 170px;">
    <div style="color: grey; padding: 5px" id="click-pending-request">
        <b id="click-here-text-activity" style="float: left; padding-right: 5px;">
                Click here
        </b>
        <p id="approve-pending-text-activity">No Requests Pending For Approval</p>
    </div>

    <div style="display: flex;margin-top: 10px;justify-content: space-around;" class="pending-button-class">
        <button onclick="openPendingActivityRequestTable()" class="pending-activity-request-count">
        0 <i class="fa fa-angle-double-down" aria-hidden="true"></i></button>
        <button id="delegateBtn" onclick="fetchActivityDelegateDialog()" style=" background-color: #242422; color: white; height: 30px; width: 90px; border-radius: 5px; padding: 5px; font-size: 14px; box-shadow: 0px 2px 2px rgba(0,0,0,0.4);">
            Delegate
        </button>
    </div>
</div>