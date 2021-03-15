
<section id="content2" class="tab-content">
    <div class="main">
        <div class="d-flex w-100 py-2">
            <div style="display: flex; justify-content: space-between; width: 390px; height: 125px;">
                <?php include 'partials/documentCards/pendingDocumentRequestCard.php'; ?>
                <?php include 'partials/documentCards/delegatedDocumentRequestCard.php'; ?>
            </div>
            <div style="display: flex;background-color: white;border-radius: 5px;margin-left: 10px;height: 125px;width: 100%;">
                <?php include 'partials/documentCards/documentCard.php'; ?>
                <?php include 'partials/documentCards/graphDocumentCard.php'; ?>
            </div>
        </div>

        <!-- Pending-request-table -->
        <div id="pending-document-request-table-container" class="pending-document-request-table-container">
            <div style="background-color: white;" id="pending-document-requests"></div>
        </div>

        <br>

        <!-- table -->
        <div style="overflow-x:auto;" id="documenttableContent"></div>
        <br>
        <!--table end -->
    </div>
</section>