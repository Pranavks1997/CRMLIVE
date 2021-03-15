<ul 
        class="table-ul" 
        style="display: flex;align-items: center;height: 50px"
    >

        <?php 
            $type = $_GET['type']; 
            $status = $_GET['status'];
        ?>   
        <li class="tableHeader-Content">
            <h2 style="margin: 10px; color: white; font-size: 2.4rem; font-weight: bold; ">All Documents </h2>
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
                        <input type="search" placeholder="Search by name" class="opportunity-search" id="opportunity-search" data-method="opportunity" data-day="<?php echo $day; ?>" data-status="<?php echo $status; ?>" data-type="<?php echo $type; ?>" value="<?php echo $searchTerm; ?>" name="search" />
                        <button class="searchhh opportunity-search-btn" id="search-btn">
                            <i id="search-icon" class="fa fa-search" aria-hidden="true"> </i>
                        </button>
                    </div>
                    <div style="display: flex; margin-left: auto;">

                        <button class="filter" id="filter_myBtn" onclick="openFilterDialog()" style="padding:10; border: none !important;">
                            <img src="modules/Home/assets/Filter-icon.svg" style="width:30px" alt="filter-icon" />
                        </button>
                
                        <button class="cog" id="setting_myBtn" onclick="openSettingDialog('opportunities','<?php echo $_GET['status']; ?>','<?php echo $_GET['type']; ?>');" style="padding:10; border: none !important;">
                            <i id="setting_myBtn" class="fa fa-list" aria-hidden="true"> </i>
                        </button>
                        <?php if ($log_in_user_id == '1'): ?>
                            <button class="cog download" id="download_btn" class="download-btn" data-type="opportunity" data-action="status" data-value="<?php echo $status; ?>" data-dropped="<?php echo $dropped; ?>" style="padding:10; border: none !important;">
                                <i class="fa fa-download" aria-hidden="true"> </i>
                            </button>
                        <?php endif ?>
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
                <th class="table-header">Name</th>
                <th class="table-header">Primary Responsibility</th>
                <?php if(!@$_GET['customColumns']): ?>

                <?php if($columnAmount){ ?>
                <th class="table-header">Amount ( in Cr )</th>
                <?php } if($columnREPEOI){ ?>
                <th class="table-header">RFP/EOI Published</th>
                <?php } if($columnClosedDate){ ?>
                <th class="table-header">Modified Date</th>
                <?php } if($columnClosedBy){ ?>
                <th class="table-header">Modified By</th>
                <?php } if($columnDateCreated){ ?>
                <th class="table-header">Created Date</th>
                <?php } if($columnDateClosed){ ?>
                <th class="table-header">Closed Date</th>
                <?php } if($columnTaggedMembers){ ?>
                <th class="table-header">Tagged Members</th>
                <?php } if($columnViewedBy){ ?>
                <th class="table-header">Viewed By</th>
                <?php } if($columnPreviousResponsibility){ ?>
                <th class="table-header">Previous Responsibility</th>
                <?php } if($columnAttachment){ ?>
                <th class="table-header">Attachment</th>
                <?php } ?>

                <?php endif; ?>

                <?php echo $this->getColumnFiltersHeader($_GET); ?>
                <th class="table-header text-center">Action</th>
            </tr>