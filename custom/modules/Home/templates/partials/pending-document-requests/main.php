<ul class="table-ul" style="display: flex; align-items: center;height: 50px;justify-content: space-between;">
    <div class="option_tabs_container">
        <li class="tableHeader-Content option_tab_header_btn" id="documentComplete" for="option_one">
            <div class="prt-top-headings" style="font-size:1.6rem;font-weight: 900">Pending Document Approvals</div>        
        </li>
    </div>
    <div>
        <li class="search-box-block">
            <div class="search-box">
                <div style="display: flex;">
                    <div style="display: flex; margin-left: auto;">
                        <button class="filter" id="filter_myBtn" onclick="openDocumentPendingFilterDialog()" style="padding:10; border: none !important;">
                            <img src="modules/Home/assets/Filter-icon.svg" style="width:30px" alt="filter-icon" />
                        </button>

                        <button class="cog" id="setting_myBtn" onclick="openDocumentPendingSettingsDialog('pendings')" style="padding:10; border: none !important;">
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
            <?php echo $this->getDocumentColumnFiltersHeader($_GET); ?>
            <th class="table-header">Action</th>
        </tr>
    