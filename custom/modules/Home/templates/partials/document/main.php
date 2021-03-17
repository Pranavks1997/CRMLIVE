<ul 
        class="table-ul" 
        style="display: flex;align-items: center;height: 50px"
    >

        <?php 
            $type = $_GET['type'] ?? ''; 
            $status = $_GET['status'] ?? '';
        ?>   
        <li class="tableHeader-Content">
            <h2 style="margin: 10px; color: white; font-size: 2.4rem; font-weight: bold; ">Documents </h2>
        </li>
        <!-- <li class="tableHeader-Content">
            <div id="global-opportunities" class="global-opportunities <?php echo $type == 'global' ? 'active': ''; ?>" onclick="dateBetween('<?php echo $day; ?>', '', '' ,'', '', 'global', 1)">Global Opportunities (<?php echo $global_organization_count; ?>) </div>
        </li>


        <li class="tableHeader-Content">
            <div id="non-global-opportunities" class="non-global-opportunities <?php echo $type == 'non_global' ? 'active': ''; ?>" onclick="dateBetween('<?php echo $day; ?>', '', '' ,'', '', 'non_global', 1)" >Non-Global Opportunities (<?php echo $non_global_organization_count; ?>) </div>
        </li> -->


        <li class="search-box-block">
            <div class="search-box">
                <!-- ----------- -->
                <div style="display: flex;">
                    <div style="display: flex; justify-content: center; align-items: center;">
                        <input type="search" placeholder="Search by name" class="document-search" id="document-search" data-method="document" data-day="<?php echo $day; ?>" value="<?php echo $searchTerm; ?>" name="search" />
                        <button class="searchhh document-search-btn" id="search-btn">
                            <i id="search-icon" class="fa fa-search" aria-hidden="true"> </i>
                        </button>
                    </div>
                    <div style="display: flex; margin-left: auto;">

                        <button class="filter" id="filter_myBtn" onclick="openDocumentFilterDialog()" style="padding:10; border: none !important;">
                            <img src="modules/Home/assets/Filter-icon.svg" style="width:30px" alt="filter-icon" />
                        </button>
                
                        <button class="cog" id="setting_myBtn" onclick="openDocumentSettingDialog('document');" style="padding:10; border: none !important;">
                            <i id="setting_myBtn" class="fa fa-list" aria-hidden="true"> </i>
                        </button>
                    </div>
                </div>
            </div>
        </li>

    </ul>

    <table 
        class="bottomtable" 
        style="font-family: Lato, Lato, Arial, sans-serif !important;
            height: 400px;
            overflow-y: auto;
            overflow-x: hidden;
            display: -webkit-box;
            width: 100%;
            flex-direction: column;"
    >
        <tbody style="display: table; width: 100%;">
            <tr class="table-header-row">
                <?php /*<th class="table-header">Activity</th>
                <th class="table-header">Related To</th>
                <th class="table-header">Status</th>
                <th class="table-header">End Date</th>
                <th class="table-header">Last Updated</th>
                <th class="table-header">Assigned To</th>
                <?php /*if(!@$_GET['customColumns']): ?>

                <?php if($columnStatus){ ?>
                <th class="table-header">Status</th>
                <?php } if($columnEndDate){ ?>
                <th class="table-header">End Date</th>
                <?php } if($columnLastUpdated){ ?>
                <th class="table-header">Last Updated</th>
                <?php } if($columnAssignedTo){ ?>
                <th class="table-header">Assigned To</th>
                <?php } ?>

                <?php endif; */ ?>
                <?php echo $this->getDocumentColumnFiltersHeader($_GET); ?>
                <th class="table-header text-center">Actions</th>
            </tr>