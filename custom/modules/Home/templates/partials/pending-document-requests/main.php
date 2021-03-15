<ul class="table-ul" style="display: flex; align-items: center;height: 50px;justify-content: space-between;">
    <div class="option_tabs_container">
        <li class="tableHeader-Content option_tab_header_btn" id="qualifylead" for="option_one">
            <div class="prt-top-headings" onClick="fetchDocumentByStatus('qualifylead', '', '', 1)">Qualify Lead (<?php echo @$qlLeadCount; ?>) </div>        </li>
        <li class="option_tab_header_btn" id="qualifyOpportunity" for="option_two">
            <div class="prt-top-headings" onClick="fetchDocumentByStatus('qualifyOpportunity', '', '', 1)">Qualify Opportunity (<?php echo @$qlOppCount; ?>) </div>
        </li>
        <li class="tableHeader-Content option_tab_header_btn" id="qualifyDpr" for="option_three">
            <div class="prt-top-headings" onClick="fetchDocumentByStatus('qualifyDpr', '', '', 1)">Qualify DPR (<?php echo @$qlDPRCount; ?>) </div>
        </li>
        <li class="tableHeader-Content option_tab_header_btn" id="qualifyBid" for="option_four">
            <div class="prt-top-headings" onClick="fetchDocumentByStatus('qualifyBid', '', '', 1)">Qualify Bid (<?php echo @$qlBidCount; ?>) </div>
        </li>
        <li class="tableHeader-Content option_tab_header_btn" id="closure" for="option_five">
            <div class="prt-top-headings" onClick="fetchDocumentByStatus('closure', '', '', 1)">Close (<?php echo @$qlClosedCount; ?>) </div>
        </li>

        <li class="tableHeader-Content option_tab_header_btn" id="Dropping" for="option_six">
            <div class="prt-top-headings" onClick="fetchDocumentByStatus('Dropping', '', '', 1)">Drop (<?php echo @$qlDroppedCount; ?>) </div>
        </li>
    </div>
    <div>
        <li class="search-box-block">
            <div class="search-box">
                <div style="display: flex;">
                    <div style="display: flex; margin-left: auto;">
                        <button class="filter" id="filter_myBtn" onclick="openPendingFilterDialog()" style="padding:10; border: none !important;">
                            <img src="modules/Home/assets/Filter-icon.svg" style="width:30px" alt="filter-icon" />
                        </button>

                        <button class="cog" id="setting_myBtn" onclick="openPendingSettingsDialog('pendings','<?php echo @$_GET['days'] ? @$_GET['days'] : '30'; ?>', '<?php echo $status; ?>', '')" style="padding:10; border: none !important;">
                            <i id="setting_myBtn" class="fa fa-list" aria-hidden="true"> </i>
                        </button>
                    </div>
                </div>
            </div>
        </li>
    </div>
</ul>

<table class="pending-document-request-table" 
    style="
        font-family: Lato, Lato, Arial, sans-serif !important; 
        max-height: 275px;
        overflow-y: auto;
        overflow-x: hidden;
        display: -webkit-box;
        width: 100%;
        flex-direction: column;"
> 
    <tbody style="display: table; width: 100%;">
        <tr class="table-header-row">
            <th class="table-header">Name</th>
            <th class="table-header">Primary Responsibility</th>

            <?php if(!@$_GET['customColumns']): ?>

            <th class="table-header" style="text-align: center">Status</th>
            
            <?php if(@$columnAmount): ?>
            <th class="table-header">Amount ( in Cr )</th>
            <?php endif; ?>
            
            <?php if(@$columnREPEOI): ?>
                <th class="table-header">RFP/EOI Published</th>
            <?php endif; ?>
                        
            <?php if(@$columnClosedDate): ?>
                <th class="table-header">Modified Date</th>
            <?php endif; ?>

            <?php if(@$columnClosedBy): ?>
                <th class="table-header">Modified By</th>
            <?php endif; ?>
            
            <?php if(@$columnDateCreated): ?>
                <th class="table-header">Created Date</th>
            <?php endif; ?>
            
            <?php if(@$columnDateClosed): ?>
                <th class="table-header">Closed Date</th>
            <?php endif; ?>
            
            <?php if(@$columnTaggedMembers): ?>
                <th class="table-header">Tagged Members</th>
            <?php endif; ?>
            
            <?php if(@$columnViewedBy): ?>
                <th class="table-header">Viewed By</th>
            <?php endif; ?>
            
            <?php if(@$columnPreviousResponsibility): ?>
                <th class="table-header">Previous Responsibility</th>
            <?php endif; ?>
            
            <?php if(@$columnAttachment): ?>
                <th class="table-header">Attachment</th>
            <?php endif; ?>

            <?php endif; ?>
            <?php echo $this->getColumnFiltersHeader($_GET); ?>
            <th class="table-header">Action</th>
        </tr>
    