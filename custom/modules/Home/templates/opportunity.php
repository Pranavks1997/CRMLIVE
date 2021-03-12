
<section id="content1" class="tab-content">
    <div class="main">
        <div class="d-flex w-100 py-2">
            <div style="display: flex; justify-content: space-between; width: 390px; height: 125px;">
                <?php include_once 'partials/cards/pendingRequestCard.php'; ?>
                <?php include_once 'partials/cards/delegatedRequestCard.php'; ?>
            </div>
            <div style="display: flex;background-color: white;border-radius: 5px;margin-left: 10px;height: 125px;width: 100%;">
                <?php include_once 'partials/cards/opportunitiesCard.php'; ?>
                <?php include_once 'partials/cards/graphCard.php'; ?>
            </div>
        </div>

        <!-- Pending-request-table -->
        <div id="pending-request-table-container" class="pending-request-table-container">
            <div style="background-color: white;" id="pending-requests"></div>
        </div>

        <!-- /card-status -->
        <section class="card-container" id="fetchedByStatus"></section>

        <br />
        <!-- card-status-end -->
        <!-- table -->
        <div style="overflow-x:auto;" id="tableContent"></div>
        <br>
        <!--table end -->
    </div>
</section>