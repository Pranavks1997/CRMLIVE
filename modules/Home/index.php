<?php
    if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
    require_once('include/MVC/Controller/SugarController.php');
?>
<html>
<head>
    <title> Dashboard </title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="modules/Home/css/style.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://cdn.jsdelivr.net/npm/handsontable@8.3.1/dist/handsontable.full.min.js"></script>
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable@8.3.1/dist/handsontable.full.min.css">
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        var jq = jQuery.noConflict();
    </script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

</head>

<body>
    <!-- <div class="spinner"><div class="loader"></div></div> -->
    <!-- Navbar start -->

    <!-- Navbar end -->
    <div class="W1400px">
        <div class="d-flex margin-top-adjust">
            <h3 class="page-title">
                Dashboard
            </h3>
            <button onclick="location.href = './index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26action%3DEditView%26return_module%3DOpportunities%26return_action%3DDetailView';" class="oppertunityBtn btn-add-opportunity" id='add_opportunity'>
                <i class="fa fa-plus" style="padding-right: 1rem; font-size: 20px" aria-hidden="true"></i>
                <h3 class="add-opportunity-title">Create Opportunity</h3>
            </button>
        </div>

        <!-- last 30's day tab -->
        <div class="tab_30_days">
            <button class="btn-30-days btn-days-filter" id="button-30days" data-day="30">Last 30 days </button>
            <button class="btn-30-days btn-days-filter" id="button-60days" data-day="60">/ Last 60 days </button>
            <button class="btn-30-days btn-days-filter" id="button-90days" data-day="1200">/ All </button>
        </div>

        <div class="main-content"></div>
        <button class="get-emp-report-button button" id="get-emp-report-button button" onclick="openUserReport()">GET EMPLOYEE REPORT</button>
        <div class="form-group" id="team-lead-dropdown-container">
                <span class="primary-responsibilty-filter-head">Select Team Lead:</span>
                <select class="" name="filter-team_lead" id="team_lead_dropdown">
                </select>
        </div>
        <div class="report-container" id="report-container">
            <div class="employee-report-table-container">
                <div id="example1" class="hot handsontable htRowHeaders"></div>
            </div>
        </div>
    </div>

    <div id="setting_myModal" class="setting-modal">
        <!-- Modal content -->
        <div class="setting-modal-content">
            <span class="closeSetting" onclick="openSettingDialog('close')">&times;</span>
            <h2 class="setting_heading">Drag / Drop Columns to be Displayed / Hidden</h2>
            <p class="setting_subhead">Select 7 columns for the table</p>
            <!-- <hr style="color: #D1D0CE"> -->
            <div class="search-column-container">
                <input type="text" id="search-column1" placeholder="Search here" />
                <i class="fa fa-search"></i>
            </div>
            <div class="search-column-heading-container">
                <h2 class="search-column-heading">Displayed</h2>
                <h2 class="search-column-heading">Hidden</h2>
            </div>
            <section class="section">
                <div class="opportunity-settings" id="opportunity-settings">
                    <form class="settings-form sort-column">
                        <input type="hidden" name="settings-section" class="settings-section" value="">
                        <input type="hidden" name="settings-type" class="settings-type" value="">
                        <input type="hidden" name="settings-type-value" class="settings-type-value" value="">
                        <ul id="sortable1" class="sortable1 connectedSortable ui-sortable">
                            <li style="pointer-events:none;" class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="name" value="name" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Opportunity Name</label>
                            </li>
                            <li style="pointer-events:none;" class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Primary-Responsbility" value="Primary-Responsbility" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Primary Responsibility</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Amount" value="Amount" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Amount (in Cr)</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="REP-EOI-Published" value="REP-EOI-Published" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> RFP/EOI Published</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Closed-Date" value="Closed-Date" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Modified date</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Closed-by" value="Closed-by" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Modified by</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Date-Created" value="Date-Created" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Created Date</label>
                            </li>
                        </ul>
                    </form>
                    <ul id="sortable2" class="sortable2 connectedSortable">
                        <li style="pointer-events:none;" class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="name" value="name" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Opportunity Name</label>
                            </li>
                            <li style="pointer-events:none;" class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Primary-Responsbility" value="Primary-Responsbility" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Primary Responsibility</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Amount" value="Amount" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Amount (in Cr)</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="REP-EOI-Published" value="REP-EOI-Published" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> RFP/EOI Published</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Closed-Date" value="Closed-Date" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Modified date</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Closed-by" value="Closed-by" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Modified by</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Date-Created" value="Date-Created" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Created Date</label>
                            </li>
                    </ul>
                </div>
            </section>
            <div style=" padding-top: 10px;padding-bottom: 20px;padding-left: 20px;">
                <button class="settings_btn1" type="button" onclick="commitFilter();">Save</button>
                <button style="margin-left: 10px;" class="settings_btn2" type="button" onclick="openSettingDialog('discard')">Close</button>
            </div>
        </div>
    </div>

    <div id="pending_setting_myModal" class="setting-modal">
        <!-- Modal content -->
        <div class="setting-modal-content">
            <span class="closeSetting" onclick="openPendingSettingsDialog('close')">&times;</span>

            <h2 class="setting_heading">Drag / Drop Columns to be Displayed / Hidden</h2>
            <p class="setting_subhead">Select 7 columns for the table</p>
            <div class="search-column-container">
                <input type="text" id="search-column2" placeholder="Search here" />
                <i class="fa fa-search"></i>
            </div>
            <div class="search-column-heading-container">
                <h2 class="search-column-heading">Displayed</h2>
                <h2 class="search-column-heading">Hidden</h2>
            </div>
            <!-- <hr style="color: #D1D0CE"> -->
            <section class="section">
                <div class="opportunity-settings" id="pending-settings">
                    <form class="pending-settings-form sort-column">
                        <input type="hidden" name="settings-section" class="pending-settings-section" value="">
                        <input type="hidden" name="settings-type" class="pending-settings-type" value="">
                        <input type="hidden" name="settings-type-value" class="pending-settings-type-value" value="">
                        <ul id="sortable1" class="sortable1 connectedSortable ui-sortable">
                            <li style="pointer-events:none;" class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="name" value="name" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Opportunity Name</label>
                            </li>
                            <li style="pointer-events:none;" class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Primary-Responsbility" value="Primary-Responsbility" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Primary Responsibility</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Amount" value="Amount" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Amount (in Cr)</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="REP-EOI-Published" value="REP-EOI-Published" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> RFP/EOI Published</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Closed-Date" value="Closed-Date" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Modified date</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Closed-by" value="Closed-by" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Modified by</label>
                            </li>
                            <li class="ui-sortable-handle">
                                <input class="settingInputs" type="checkbox" id="name-select" name="Date-Created" value="Date-Created" checked="True" style="display: none">
                                <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Created Date</label>
                            </li>
                        </ul>
                    </form>
                    <ul id="sortable2" class="sortable2 connectedSortable ui-sortable">
                        <li style="pointer-events:none;" class="ui-sortable-handle">
                            <input class="settingInputs" type="checkbox" id="name-select" name="name" value="name" checked="True" style="display: none">
                            <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Opportunity Name</label>
                        </li>
                        <li style="pointer-events:none;" class="ui-sortable-handle">
                            <input class="settingInputs" type="checkbox" id="name-select" name="Primary-Responsbility" value="Primary-Responsbility" checked="True" style="display: none">
                            <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Primary Responsibility</label>
                        </li>
                        <li class="ui-sortable-handle">
                            <input class="settingInputs" type="checkbox" id="name-select" name="Amount" value="Amount" checked="True" style="display: none">
                            <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Amount (in Cr)</label>
                        </li>
                        <li class="ui-sortable-handle">
                            <input class="settingInputs" type="checkbox" id="name-select" name="REP-EOI-Published" value="REP-EOI-Published" checked="True" style="display: none">
                            <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> RFP/EOI Published</label>
                        </li>
                        <li class="ui-sortable-handle">
                            <input class="settingInputs" type="checkbox" id="name-select" name="Closed-Date" value="Closed-Date" checked="True" style="display: none">
                            <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Modified date</label>
                        </li>
                        <li class="ui-sortable-handle">
                            <input class="settingInputs" type="checkbox" id="name-select" name="Closed-by" value="Closed-by" checked="True" style="display: none">
                            <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Modified by</label>
                        </li>
                        <li class="ui-sortable-handle">
                            <input class="settingInputs" type="checkbox" id="name-select" name="Date-Created" value="Date-Created" checked="True" style="display: none">
                            <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> Created Date</label>
                        </li>
                    </ul>
                </div>

            </section>
            <div style=" padding-top: 10px;padding-bottom: 20px;padding-left: 20px;">
                <button class="settings_btn1" type="button" onclick="commitPendingFilter();">Save</button>
                <button style="margin-left: 10px;" class="settings_btn2" type="button" onclick="openPendingSettingsDialog('discard')">Close</button>
            </div>
        </div>
    </div>

    <div id="filter_myModal" class="filter_modal">
        <!-- Modal content -->
        <div class="filtermodal-content">
            <span class="filterclose" onclick="openFilterDialog('close')" style="cursor:pointer;font-size:18px;float: right;">&times;</span>
            <form class="opportunity-filter">

                <input type="hidden" class="filter-type" name="type" value="" />
                <input type="hidden" class="filter-value" name="value" value="" />
                <input type="hidden" class="filter-status" name="status" value="" />

                <h2 class="filterheading">Filter</h2>
                <p class="filtersubhead">Fill out the following details</p>
                <hr class="filtersolid">
                <section class="filtersection" style="margin-top: 10px;">
                    <div class="filter-body" style="padding-top: 10px; padding-right: 15px; margin-bottom: 20px; display: block; max-height: 350px; overflow: hidden; overflow-y: scroll"></div>
                    <div>
                        <button class="btn1" type="button" id="filter_submit" onclick="openFilterDialog('submit')">Filter</button>
                        <button class="btn2" type="button" id="filter_discard" onclick="openFilterDialog('close')" style="border-color: #8a8a8a">Close</button>
                        <a id="filter_clear" class="filter_clear">Clear Filter</a>
                    </div>
                </section>
            </form>
        </div>

    </div>


    <div id="pending_filter_myModal" class="filter_modal">
        <!-- Modal content -->
        <div class="filtermodal-content">
            <span class="filterclose" onclick="openPendingFilterDialog('close')" style="cursor:pointer;font-size:18px;float: right;">&times;</span>
            <form class="pending-filter">

                <input type="hidden" class="filter-type" name="type" value="" />
                <input type="hidden" class="filter-value" name="value" value="" />
                <input type="hidden" class="filter-status" name="status" value="" />

                <h2 class="filterheading">Filter</h2>
                <p class="filtersubhead">Fill out the following details</p>
                <hr class="filtersolid">
                <section class="filtersection" style="margin-top: 10px;">
                    <div class="filter-body" style="padding-top: 10px; padding-right: 15px; margin-bottom: 20px; display: block; max-height: 350px; overflow: hidden; overflow-y: scroll"></div>
                    <div>
                        <button class="btn1" type="button" id="filter_submit" onclick="openPendingFilterDialog('submit')">Filter</button>
                        <button class="btn2" type="button" id="filter_discard" onclick="openPendingFilterDialog('close')" style="border-color: #8a8a8a">Close</button>
                        <a id="filter_clear" class="filter_clear">Clear Filter</a>
                    </div>        
                </section>
            </form>
        </div>

    </div>


    <!-- Modal content -->
    <div id="deSelectModal" class="desModal">
        <!-- Modal content -->
        <div class="deselect-modal-content">
            <span class="deselectclose" onclick="openDeselectDialog('close')">&times;</span>
            <form class="test-tag">
                    <div id="opportunity_info">
                        <!-- /.col-md-12 -->
                    </div>
                    <input type="hidden" id="tag_opporunity_id" name= "tag_opporunity_id" value="" />
                    <!-- <input name="hidden_user" id="hidden_user" style="cursor: pointer;padding-right: 40px;" onclick="deselectDropDownClicked()" readonly/>
                    <i class="fa fa-caret-down icon-dropdown-deselect" style="cursor: pointer;" id="deselect-drop-icon" onclick="clearDeselectDropDownValue()"></i>
                    <select id="deselect_members" name="multi_search_filter" onfocusout="deselectDropDownClicked()" multiple class="form-control selectpicker" 
                                                 style="width:250px;
                                                        padding: 0px;
                                                        border-color: #dee0e3;
                                                        background: white;
                                                        position: absolute;
                                                        height: 105px !important;
                                                        ">
                    </select> -->
                    <div id = "deselect_members_tag">

                    </div>
                    <br><div style="height: 20px;"></div>
                    <div>
                        <button class="saveBtnDeselect" type="button" onclick="openDeselectDialog('submit')">Save</button>
                        <button class="submitBtnDeselect" type="button" onclick="openDeselectDialog('discard')">Close</button>
                    </div>
                </section>
            </form>
        </div>

    </div>

    <!-- The Modal -->
    <div id="delegatemyModel" class="delegatemodal">
        <!-- Modal content -->
        <div class="delegatemodal-content">
            <span class="delegateclose" id="delegateclose">&times;</span>
            <form>
                <input type="hidden" id="hidden_value" name="hidden_value" />
                <h2 class="delegateheading">Delegate</h2>
                <p class="delegatesubhead">Delegated member will be able to perform action on your behalf</p>
                <section style="margin-top: 15px;">
                    <div class="delegatetable-container">
                        <div class="delegetable-item-table">
                            <div id="delegated_info"></div>
                        </div>
                        <!-- <div class="delegate-item-button">
                            <button style="margin-left: 100px; margin-bottom: 10px; margin-top: 20px;" class="btn2" type="submit" href="/">Remove</button>
                        </div> -->
                    </div>
                    <div style="margin-top: 30px; margin-left: 20px;">
                        <div style="width: 36%;float: left;">
                            <label for="Select_Proxy">Select Proxy</label><br>
                            <select class="delegateselect" id="Select_Proxy">

                            </select>


                            <div style="margin-top: -1px;">
                                <!-- <a style="color: black;font-size: 10px;" href="#">Delegated Prevlously - <span style="font-size: 10px;font-weight: bold;">No</span></a> -->
                            </div>
                        </div>
                        <div style="width: 50%;float: left; margin-left: 20px;">
                            <label>Permissions to</label><br>
                            <input style="width: 15px;" type="checkbox" id="delegate_Edit" name="delegate_Edit" value="Edit" checked>
                            <label for="Edit" style="margin: 0;"> Edit(Approve/Reject)</label>
                        </div>
                    </div>
                    <div style="margin-top: 130px; margin-left: 20px;">
                        <!-- <a style="color: #3090C7;" href="#">+ Add another proxy</a> -->
                    </div>

                    <div style="margin-top: 15px;padding-bottom: 20px;margin-left: 20px;">
                        <a class="btn1" id="delegate_submit" style="padding: 5px 20px;">Save</a>
                    </div>
                </section>
            </form>
        </div>

    </div>

    <!-- Activity Delegate Modal -->
    <div id="activityDelegatemyModel" class="delegatemodal">
        <!-- Modal content -->
        <div class="delegatemodal-content">
            <span class="delegateclose" id="activityDelegateclose">&times;</span>
            <form>
                <input type="hidden" id="hidden_value" name="hidden_value" />
                <h2 class="delegateheading">Delegate</h2>
                <p class="delegatesubhead">Delegated member will be able to perform action on your behalf</p>
                <section style="margin-top: 15px;">
                    <div class="delegatetable-container">
                        <div class="delegetable-item-table">
                            <div id="activity_delegated_info"></div>
                        </div>
                        <!-- <div class="delegate-item-button">
                            <button style="margin-left: 100px; margin-bottom: 10px; margin-top: 20px;" class="btn2" type="submit" href="/">Remove</button>
                        </div> -->
                    </div>
                    <div style="margin-top: 30px; margin-left: 20px;">
                        <div style="width: 36%;float: left;">
                            <label for="Select_Proxy">Select Proxy</label><br>
                            <select class="delegateselect Select_Proxy" id="activity_Select_Proxy">

                            </select>

                            <div style="margin-top: -1px;">
                                <!-- <a style="color: black;font-size: 10px;" href="#">Delegated Prevlously - <span style="font-size: 10px;font-weight: bold;">No</span></a> -->
                            </div>
                        </div>
                        <div style="width: 50%;float: left; margin-left: 20px;">
                            <label>Permissions to</label><br>
                            <input style="width: 15px;" type="checkbox" id="activity_delegate_Edit" name="activity_delegate_Edit" value="Edit" checked>
                            <label for="Edit" style="margin: 0;"> Edit(Approve/Reject)</label>
                        </div>
                    </div>
                    <div style="margin-top: 130px; margin-left: 20px;">
                        <!-- <a style="color: #3090C7;" href="#">+ Add another proxy</a> -->
                    </div>

                    <div style="margin-top: 15px;padding-bottom: 20px;margin-left: 20px;">
                        <a class="btn1" id="activity_delegate_submit" style="padding: 5px 20px;">Save</a>
                    </div>
                </section>
            </form>
        </div>

    </div>

    <!-- Sequence Flow -->
    <div class="backdrop"></div>
    <section class="white-bg status-display sequence-flow"></section>


    <!-- The Modal -->
    <div id="approvalModal" class="approvalmodal">
        <!-- Modal content -->
        <div class="approvalmodal-content">
            <span class="approvalclose" onClick="openApprovalDialog('close');">&times;</span>
            <form class="approval-form" name="approval-form">
                <div id="approval-data"></div>
            </form>
        </div>
    </div>

    <!-- Activity Approval Modal -->
    <div id="activityApprovalModal" class="approvalmodal">
        <!-- Modal content -->
        <div class="approvalmodal-content">
            <span class="approvalclose" onClick="openActivityApprovalDialog('close');">&times;</span>
            <form class="activity-approval-form" name="approval-form">
                <div id="activity-approval-data"></div>
            </form>
        </div>
    </div>

    <!-- RA Modal Container -->
    <div id="reassignmentModal" class="raModal">
        <!-- Modal content -->
        <div class="ra-modal-content" id="size">
            <span class="deselectclose" onclick="handleReassignmentDialog('close')">&times;</span>
           <form>
                    <!-- <input type="hidden" id="hidden_multi_select" value="" />
                    <input name="hidden_user" id="hidden_user" style="cursor: pointer;padding-right: 40px;" onclick="deselectDropDownClicked()" readonly/> -->
                    <input name="hidden_user" type="hidden" id="assigned_opp_id"/>
                    <div class="reassignmentModal-header" style="margin-bottom: 30px;">
                        <h3 style="margin:0; padding: 0;font-size: 20px;">Change the Assigned User</h3></br>
                        <h4 id="ra_op_name" style="margin:0; font-size: 15px;">Opportunity Name</h4> </br>
                        <h4 id="ass_name" style="margin:0; font-size: 15px;">Assigned User Name</h4> 
                    </div>
                    
                    <h5 style="padding: 0">Re-assign User:</h5>
                    <input type="text" id="assigned_to_new_c" style="width: 250px; padding: 15px 5px;"/>
                    <br><div style="height: 20px;"></div>
                    <div>
                        <button class="saveBtnDeselect" type="button" onclick="handleReassignmentDialog('submit')">Save</button>
                        <button class="submitBtnDeselect" type="button" onclick="handleReassignmentDialog('discard')">Close</button>
                    </div>
                </section>
            </form>
        </div>

    </div>

    <!--------------------------ACTIVIY ------------------------------------------->
    
    
    <div id="activityreassignmentModal" class="raModal">
        <!-- Modal content -->
        <div class="ra-modal-content" id="size">
            <span class="deselectclose" onclick="activityhandleReassignmentDialog('close')">&times;</span>
           <form>
                    <!-- <input type="hidden" id="hidden_multi_select" value="" />
                    <input name="hidden_user" id="hidden_user" style="cursor: pointer;padding-right: 40px;" onclick="deselectDropDownClicked()" readonly/> -->
                    <input name="hidden_user" type="hidden" id="assigned_activity_id"/>
                    <div class="activityreassignmentModal-header" style="margin-bottom: 30px;">
                        <h3 style="margin:0; padding: 0;font-size: 20px;">Change the Assigned User</h3></br>
                        <h4 id="ra_ac_name" style="margin:0; font-size: 15px;">Activity Name</h4> </br>
                        <h4 id="activity_assigned_name" style="margin:0; font-size: 15px;">Assigned User Name</h4> 
                    </div>
                    
                    <h5 style="padding: 0">Re-assign User:</h5>
                    <input type="text" id="activity_assigned_to_new_c" style="width: 250px; padding: 15px 5px;"/>
                    <br><div style="height: 20px;"></div>
                    <div>
                        <button class="saveBtnDeselect" type="button" onclick="activityhandleReassignmentDialog('submit')">Save</button>
                        <button class="submitBtnDeselect" type="button" onclick="activityhandleReassignmentDialog('discard')">Close</button>
                    </div>
                </section>
            </form>
        </div>

    </div>

    <!-- Reminder Modal Container -->
    <div id="reminderModal" class="desModal">
        <!-- Modal content -->
        <div class="deselect-modal-content">
            <span class="deselectclose" onclick="openDeselectReminderDialog('close')">&times;</span>
            <form>
                    <div id="activity_info">

                    </div>
                
                    <br><div style="height: 40px;"></div>
                    <div>
                        <button class="saveBtnDeselect" type="button" onclick="openDeselectReminderDialog('submit')">Save</button>
                        <button class="submitBtnDeselect" type="button" onclick="openDeselectReminderDialog('discard')">Close</button>
                    </div>
                </section>
            </form>
        </div>

    </div>

    <!-- Activity Columns & Filters -->
    <div id="activity-settings-modal" class="setting-modal">
        <!-- Modal content -->
        <div class="setting-modal-content">
            <span class="closeSetting" onclick="openActivitySettingDialog('close')">&times;</span>
            <h2 class="setting_heading">Drag / Drop Columns to be Displayed / Hidden</h2>
            <p class="setting_subhead">Select 7 columns for the table</p>
            <!-- <hr style="color: #D1D0CE"> -->
            <div class="search-column-container">
                <input type="text" class="activity-search-column1" placeholder="Search here" />
                <i class="fa fa-search"></i>
            </div>
            <div class="search-column-heading-container">
                <h2 class="search-column-heading">Displayed</h2>
                <h2 class="search-column-heading">Hidden</h2>
            </div>
            <section class="section">
                <div class="opportunity-settings" id="activity-settings">
                    
                </div>
            </section>
            <div style=" padding-top: 10px;padding-bottom: 20px;padding-left: 20px;">
                <button class="settings_btn1" type="button" onclick="commitActivityFilter();">Save</button>
                <button style="margin-left: 10px;" class="settings_btn2" type="button" onclick="openActivitySettingDialog('discard')">Close</button>
            </div>
        </div>
    </div>

    <div id="activity-pending-settings-modal" class="setting-modal">
        <!-- Modal content -->
        <div class="setting-modal-content">
            <span class="closeSetting" onclick="openActivityPendingSettingsDialog('close')">&times;</span>

            <h2 class="setting_heading">Drag / Drop Columns to be Displayed / Hidden</h2>
            <p class="setting_subhead">Select 7 columns for the table</p>
            <div class="search-column-container">
                <input type="text" class="activity-search-column2" placeholder="Search here" />
                <i class="fa fa-search"></i>
            </div>
            <div class="search-column-heading-container">
                <h2 class="search-column-heading">Displayed</h2>
                <h2 class="search-column-heading">Hidden</h2>
            </div>
            <!-- <hr style="color: #D1D0CE"> -->
            <section class="section">
                <div class="opportunity-settings" id="activity-pending-settings">
                    
                </div>

            </section>
            <div style=" padding-top: 10px;padding-bottom: 20px;padding-left: 20px;">
                <button class="settings_btn1" type="button" onclick="commitActivityPendingFilter();">Save</button>
                <button style="margin-left: 10px;" class="settings_btn2" type="button" onclick="openActivityPendingSettingsDialog('discard')">Close</button>
            </div>
        </div>
    </div>

    <div id="activity-filter" class="filter_modal">
        <!-- Modal content -->
        <div class="filtermodal-content">
            <span class="filterclose" onclick="openActivityFilterDialog('close')" style="cursor:pointer;font-size:18px;float: right;">&times;</span>
            <form class="activity-filter">

                <input type="hidden" class="filter-type" name="filter-type" value="" />
                <input type="hidden" class="filter-value" name="filter-value" value="" />
                <input type="hidden" class="filter-status" name="filter-status" value="" />

                <h2 class="filterheading">Filter</h2>
                <p class="filtersubhead">Fill out the following details</p>
                <hr class="filtersolid">
                <section class="filtersection" style="margin-top: 10px;">
                    <div class="filter-body" style="padding-top: 10px; padding-right: 15px; margin-bottom: 20px; display: block; max-height: 350px; overflow: hidden; overflow-y: scroll"></div>
                    <div>
                        <button class="btn1" type="button" id="filter_submit" onclick="openActivityFilterDialog('submit')">Filter</button>
                        <button class="btn2" type="button" id="filter_discard" onclick="openActivityFilterDialog('close')" style="border-color: #8a8a8a">Close</button>
                        <a id="filter_clear" class="clear-filter" data-type="activity">Clear Filter</a>
                    </div>
                </section>
            </form>
        </div>

    </div>


    <div id="activity-pending-filter" class="filter_modal">
        <!-- Modal content -->
        <div class="filtermodal-content">
            <span class="filterclose" onclick="openActivityPendingFilterDialog('close')" style="cursor:pointer;font-size:18px;float: right;">&times;</span>
            <form class="activity-pending-filter">

                <input type="hidden" class="filter-type" name="type" value="" />
                <input type="hidden" class="filter-value" name="value" value="" />
                <input type="hidden" class="filter-status" name="status" value="" />

                <h2 class="filterheading">Filter</h2>
                <p class="filtersubhead">Fill out the following details</p>
                <hr class="filtersolid">
                <section class="filtersection" style="margin-top: 10px;">
                    <div class="filter-body" style="padding-top: 10px; padding-right: 15px; margin-bottom: 20px; display: block; max-height: 350px; overflow: hidden; overflow-y: scroll"></div>
                    <div>
                        <button class="btn1" type="button" id="filter_submit" onclick="openActivityPendingFilterDialog('submit')">Filter</button>
                        <button class="btn2" type="button" id="filter_discard" onclick="openActivityPendingFilterDialog('close')" style="border-color: #8a8a8a">Close</button>
                        <a id="filter_clear" class="clear-filter" data-type="activity-pending">Clear Filter</a>
                    </div>        
                </section>
            </form>
        </div>

    </div>
     <!-- Sequence Flow Activity-->
    <div class="backdrop-activity"></div>
    <section class="white-bg status-display sequence-flow-activity"></section>


    <!-- Modal content Tag pop-up Activity-->
    <div id="tag-activity-modal" class="desModal">
        <!-- Modal content -->
        <div class="deselect-modal-content">
            <span class="deselectclose" onclick="handleTagDialog('close')">&times;</span>
            <form class="activity_tag_func">
                    <div id="activity_tag_info">
                        
                    </div>
                    <br><div style="height: 20px;"></div>
                    <input type="hidden" id="activity_tag_id" name="activity_tag_id" value="" />
                    <div id="activity_member_info">

                    </div>
                    <!-- <i class="fa fa-caret-down icon-dropdown-deselect" style="cursor: pointer;" id="deselect-drop-icon" onclick="activityclearDeselectDropDownValue()"></i>
                    <select id="activity_member_info" name="multi_search_filter" onfocusout="activitydeselectDropDownClicked()" multiple class="form-control selectpicker" 
                                                 style="width:250px;
                                                        padding: 0px;
                                                        border-color: #dee0e3;
                                                        background: white;
                                                        position: absolute;
                                                        height: 105px !important;
                                                        display:None;
                                                        "> 
                    </select> -->
                    <br><div style="height: 20px;"></div>
                    <div>
                        <button class="saveBtnDeselect" type="button" onclick="handleTagDialog('submit')">Save</button>
                        <button class="submitBtnDeselect" type="button" onclick="handleTagDialog('discard')">Close</button>
                    </div>
                </section>
            </form>
        </div>

    </div>

<!-- 

   :::::::::::::::::::::::::::::::::::::::::::::::::::::  Document Models :::::::::::::::::::::::::::::::::::::::::::::


 -->
    <div id="document-pending-filter" class="filter_modal">
        <!-- Modal content -->
        <div class="filtermodal-content">
            <span class="filterclose" onclick="openDocumentPendingFilterDialog('close')" style="cursor:pointer;font-size:18px;float: right;">&times;</span>
            <form class="document-pending-filter">

                <input type="hidden" class="filter-type" name="type" value="" />
                <input type="hidden" class="filter-value" name="value" value="" />
                <input type="hidden" class="filter-status" name="status" value="" />

                <h2 class="filterheading">Filter</h2>
                <p class="filtersubhead">Fill out the following details</p>
                <hr class="filtersolid">
                <section class="filtersection" style="margin-top: 10px;">
                    <div class="filter-body" style="padding-top: 10px; padding-right: 15px; margin-bottom: 20px; display: block; max-height: 350px; overflow: hidden; overflow-y: scroll"></div>
                    <div>
                        <button class="btn1" type="button" id="filter_submit" onclick="openDocumentPendingFilterDialog('submit')">Filter</button>
                        <button class="btn2" type="button" id="filter_discard" onclick="openDocumentPendingFilterDialog('close')" style="border-color: #8a8a8a">Close</button>
                        <a id="filter_clear" class="clear-filter" data-type="activity-pending">Clear Filter</a>
                    </div>        
                </section>
            </form>
        </div>

    </div>

    <div id="document-filter" class="filter_modal">
        <!-- Modal content -->
        <div class="filtermodal-content">
            <span class="filterclose" onclick="openDocumentFilterDialog('close')" style="cursor:pointer;font-size:18px;float: right;">&times;</span>
            <form class="document-filter">

                <input type="hidden" class="filter-type" name="filter-type" value="" />
                <input type="hidden" class="filter-value" name="filter-value" value="" />
                <input type="hidden" class="filter-status" name="filter-status" value="" />

                <h2 class="filterheading">Filter</h2>
                <p class="filtersubhead">Fill out the following details</p>
                <hr class="filtersolid">
                <section class="filtersection" style="margin-top: 10px;">
                    <div class="filter-body" style="padding-top: 10px; padding-right: 15px; margin-bottom: 20px; display: block; max-height: 350px; overflow: hidden; overflow-y: scroll"></div>
                    <div>
                        <button class="btn1" type="button" id="filter_submit" onclick="openDocumentFilterDialog('submit')">Filter</button>
                        <button class="btn2" type="button" id="filter_discard" onclick="openDocumentFilterDialog('close')" style="border-color: #8a8a8a">Close</button>
                        <a id="filter_clear" class="clear-filter" data-type="document">Clear Filter</a>
                    </div>
                </section>
            </form>
        </div>

    </div>

    <div id="document-settings-modal" class="setting-modal">
        <!-- Modal content -->
        <div class="setting-modal-content">
            <span class="closeSetting" onclick="openDocumentSettingDialog('close')">&times;</span>
            <h2 class="setting_heading">Drag / Drop Columns to be Displayed / Hidden</h2>
            <p class="setting_subhead">Select 7 columns for the table</p>
            <!-- <hr style="color: #D1D0CE"> -->
            <div class="search-column-container">
                <input type="text" class="document-search-column1" placeholder="Search here" />
                <i class="fa fa-search"></i>
            </div>
            <div class="search-column-heading-container">
                <h2 class="search-column-heading">Displayed</h2>
                <h2 class="search-column-heading">Hidden</h2>
            </div>
            <section class="section">
                <div class="opportunity-settings" id="document-settings">
                    
                </div>
            </section>
            <div style=" padding-top: 10px;padding-bottom: 20px;padding-left: 20px;">
                <button class="settings_btn1" type="button" onclick="commitDocumentFilter();">Save</button>
                <button style="margin-left: 10px;" class="settings_btn2" type="button" onclick="openDocumentSettingDialog('discard')">Close</button>
            </div>
        </div>
    </div>

    <div id="document-pending-settings-modal" class="setting-modal">
        <!-- Modal content -->
        <div class="setting-modal-content">
            <span class="closeSetting" onclick="openDocumentPendingSettingsDialog('close')">&times;</span>

            <h2 class="setting_heading">Drag / Drop Columns to be Displayed / Hidden</h2>
            <p class="setting_subhead">Select 7 columns for the table</p>
            <div class="search-column-container">
                <input type="text" class="document-search-column2" placeholder="Search here" />
                <i class="fa fa-search"></i>
            </div>
            <div class="search-column-heading-container">
                <h2 class="search-column-heading">Displayed</h2>
                <h2 class="search-column-heading">Hidden</h2>
            </div>
            <!-- <hr style="color: #D1D0CE"> -->
            <section class="section">
                <div class="opportunity-settings" id="document-pending-settings">
                    
                </div>

            </section>
            <div style=" padding-top: 10px;padding-bottom: 20px;padding-left: 20px;">
                <button class="settings_btn1" type="button" onclick="commitDocumentPendingFilter();">Save</button>
                <button style="margin-left: 10px;" class="settings_btn2" type="button" onclick="openDocumentPendingSettingsDialog('discard')">Close</button>
            </div>
        </div>
    </div>

<!-- Document Delegate Modal -->
<div id="documentDelegatemyModel" class="delegatemodal">
        <!-- Modal content -->
        <div class="delegatemodal-content">
            <span class="delegateclose" id="documentDelegateclose">&times;</span>
            <form>
                <input type="hidden" id="hidden_value" name="hidden_value" />
                <h2 class="delegateheading">Delegate</h2>
                <p class="delegatesubhead">Delegated member will be able to perform action on your behalf</p>
                <section style="margin-top: 15px;">
                    <div class="delegatetable-container">
                        <div class="delegetable-item-table">
                            <div id="document_delegated_info"></div>
                        </div>
                        <!-- <div class="delegate-item-button">
                            <button style="margin-left: 100px; margin-bottom: 10px; margin-top: 20px;" class="btn2" type="submit" href="/">Remove</button>
                        </div> -->
                    </div>
                    <div style="margin-top: 30px; margin-left: 20px;">
                        <div style="width: 36%;float: left;">
                            <label for="Select_Proxy">Select Proxy</label><br>
                            <select class="delegateselect Select_Proxy" id="document_Select_Proxy">

                            </select>

                            <div style="margin-top: -1px;">
                                <!-- <a style="color: black;font-size: 10px;" href="#">Delegated Prevlously - <span style="font-size: 10px;font-weight: bold;">No</span></a> -->
                            </div>
                        </div>
                        <div style="width: 50%;float: left; margin-left: 20px;">
                            <label>Permissions to</label><br>
                            <input style="width: 15px;" type="checkbox" id="document_delegate_Edit" name="document_delegate_Edit" value="Edit" checked>
                            <label for="Edit" style="margin: 0;"> Edit(Approve/Reject)</label>
                        </div>
                    </div>
                    <div style="margin-top: 130px; margin-left: 20px;">
                        <!-- <a style="color: #3090C7;" href="#">+ Add another proxy</a> -->
                    </div>

                    <div style="margin-top: 15px;padding-bottom: 20px;margin-left: 20px;">
                        <a class="btn1" id="document_delegate_submit" style="padding: 5px 20px;">Save</a>
                    </div>
                </section>
            </form>
        </div>

    </div>

    <!-- Modal content Document Note pop-up -->
    <div id="document-note-modal" class="desModal">
        <!-- Modal content -->
        <div class="deselect-modal-content">
            <span class="deselectclose" onclick="handleNoteDialog('close')">&times;</span>
            <form >
                <div id="document_note_info">

                </div>
                <div id="document_note_history">

                </div>
                <br><div style="height: 20px;"></div>
                <input type="hidden" id="doc_id" name= "doc_id" value="" />

                <div class="field-area" id="document_info">
                    <!-- <h2>Send note to <b id="send_note_to" style="float: left;"></b> </h2> -->
                    <p>Send note to <strong id="send_note_to"></strong></p>

                    <div class="input-group">
                        <input type="text" name="note" id="note"/>
                        <div class="input-group-append">
                            <button type ="button" class="saveBtnDeselect" onclick="handleNoteDialog('submit')">Post</button>
                        </div>
                    </div>
                </div>
                </section>
            </form>
        </div>

    </div>

    <!-- Modal content of Document Tag pop-up -->
    <div id="tag-document-modal" class="desModal">
        <!-- Modal content -->
        <div class="deselect-modal-content">
            <span class="deselectclose" onclick="handleTagDialog('close')">&times;</span>
            <form class="document_tag_func">
                    <div id="document_tag_info">
                        
                    </div>
                    <br><div style="height: 20px;"></div>
                    <input type="hidden" id="document_tag_id" name="document_tag_id" value="" />
                    <div id="document_member_info">

                    </div>
                    
                    <br><div style="height: 20px;"></div>
                    <div>
                        <button class="saveBtnDeselect" type="button" onclick="handleTagDialog('submit')">Save</button>
                        <button class="submitBtnDeselect" type="button" onclick="handleTagDialog('discard')">Close</button>
                    </div>
                </section>
            </form>
        </div>

    </div>



 <!-- Document Approval Modal -->
 <div id="documentApprovalModal" class="approvalmodal">
        <!-- Modal content -->
        <div class="approvalmodal-content">
            <span class="approvalclose" onClick="openDocumentApprovalDialog('close');">&times;</span>
            <form class="document-approval-form" name="approval-form">
                <div id="document-approval-data"></div>
            </form>
        </div>
    </div>

    <script src="modules/Home/js/script.js"></script>
    <script src="modules/Home/js/functions.js"></script>
    <script src="modules/Home/js/activityFunction.js"></script>
    <script src="modules/Home/js/documentFunction.js"></script>
</body>
</html>