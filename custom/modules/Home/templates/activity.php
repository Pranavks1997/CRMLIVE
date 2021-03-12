
<section id="content2" class="tab-content">
    <div class="main">
        <div class="d-flex w-100 py-2">
            <div style="display: flex; justify-content: space-between; width: 390px; height: 125px;">
                <?php include 'partials/activityCards/pendingActivityRequestCard.php'; ?>
                <?php include 'partials/activityCards/delegatedActivityRequestCard.php'; ?>
            </div>
            <div style="display: flex;background-color: white;border-radius: 5px;margin-left: 10px;height: 125px;width: 100%;">
                <?php include 'partials/activityCards/activityCard.php'; ?>
                <?php include 'partials/activityCards/graphActivityCard.php'; ?>
            </div>
        </div>

        <!-- Pending-request-table -->
        <div id="pending-activity-request-table-container" class="pending-activity-request-table-container">
            <div style="background-color: white;" id="pending-activity-requests"></div>
        </div>

        <br>

        <!-- table -->
        <div style="overflow-x:auto;" id="activitytableContent"></div>
        <br>
        <!--table end -->
    </div>
</section>