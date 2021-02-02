
<?php

use Robo\Task\File\Concat;

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/MVC/Controller/SugarController.php');

class HomeController extends SugarController
{
    public function starting_fetch(){
        try
        {
            global $current_user;

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            $log_in_user_id = $current_user->id;
            $fetch_total_opportunity = "SELECT count(*) as total from opportunities";
            $fetch_total_result = $GLOBALS['db']->query($fetch_total_opportunity);
            $fetch_total = $GLOBALS['db']->fetchByAssoc($fetch_total_result);
            $total = $fetch_total['total'];

            $fetch_self_count = "SELECT count(*) as self_count from opportunities LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE assigned_user_id='$log_in_user_id'";
            $fetch_self_result = $GLOBALS['db']->query($fetch_self_count);
            $fetch_self = $GLOBALS['db']->fetchByAssoc($fetch_self_result);
            $self_count = $fetch_self['self_count'];

            $fetch_team_count = "SELECT count(*) as team_count from opportunities LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE team_id=''";
            $fetch_team_result = $GLOBALS['db']->query($fetch_team_count);
            $fetch_team = $GLOBALS['db']->fetchByAssoc($fetch_team_result);
            $team_count = $fetch_team['team_count'];

            print_r(array($total, $self_count, $team_count));

        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();

    }


public function action_pending_records()
{
    $db = \DBManagerFactory::getInstance();
    $GLOBALS['db'];

    $fetch_pending_records = "SELECT opp_id  FROM approval_table WHERE pending = 1";
    $fetch_total_pending_record_result = $GLOBALS['db']->query($fetch_pending_records);
    $data = '<table class="pending-request-table" style="font-family: Lato, Lato, Arial, sans-serif !important;
        height: 400px;
        overflow-y: auto;
        overflow-x: hidden;
        display: -webkit-box;
        width: 100%;
        flex-direction: column;"
        >
        <tbody style="display: table; width: 100%;">
        <ul class="table-ul" style="display: flex;
        align-items: center;height: 50px;justify-content: space-between;">
        
        <div class="option_tabs_container">
        <li class="tableHeader-Content option_tab_header_btn" id="option_one-tab" for="option_one">
        <div class="prt-top-headings">Qualify Lead (25) </div>
        </li>
        
        
        <li class="option_tab_header_btn" id="option_two-tab" for="option_two">
        <div class="prt-top-headings" >Qualify Opportunity (23) </div>
        </li>
        <li class="tableHeader-Content option_tab_header_btn" id="option_three-tab" for="option_three">
        <div class="prt-top-headings">Qualify DPR (20) </div>
        </li>
        
        
        <li class="tableHeader-Content option_tab_header_btn" id="option_four-tab" for="option_four">
        <div class="prt-top-headings" >Qualify Bid (16) </div>
        </li>
        <li class="tableHeader-Content option_tab_header_btn" id="option_five-tab" for="option_five">
        <div class="prt-top-headings">Close (12) </div>
        </li>
        
        
        <li class="tableHeader-Content option_tab_header_btn" id="option_six-tab" for="option_six">
        <div class="prt-top-headings" >Drop (2) </div>
        </li>
        </div>
        
        <div>
        <li class="search-box-block">
        <div class="search-box">
        <div style="display: flex;">
        <div style="display: flex; margin-left: auto;">
        <button class="filter" id="filter_myBtn" onclick="openFilterDialog()" style="padding:10; border: none !important;">
        <i class="fa fa-filter" aria-hidden="true"> </i>
        </button>
        
        <button class="cog" id="setting_myBtn" onclick="openSettingDialog()" style="padding:10; border: none !important;">
        <i id="setting_myBtn" class="fa fa-list" aria-hidden="true"> </i>
        </button>
        </div>
        </div>
        </div>
        
        </li>
        </div>
        
        </ul>
        <tr class="table-header-row">
        <th class="table-header">Name</th>
        <th class="table-header">Primary Responsibility</th>
        <th class="table-header">Amount ( in Cr )</th>
        <th class="table-header">RFP/EOI Published</th>
        <th class="table-header">Modified Date</th>
        <th class="table-header">Status</th>
        <th class="table-header">Created Date</th>
        <th class="table-header">Action</th>
        </tr>
       ';
    while($pending_data_row = $GLOBALS['db']->fetchByAssoc($fetch_total_pending_record_result))
    {
        $opportunity_id = $pending_data_row["opp_id"];
        $pending_opportunitiy_data = "SELECT * FROM opportunities LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE id = '$opportunity_id'  ORDER BY `opportunities`.`date_modified` DESC";
        $fetch_result_pending_opportunity = $GLOBALS['db']->query($pending_opportunitiy_data);

        while($pending_data_opportunity_row =  $GLOBALS['db']->fetchByAssoc($fetch_result_pending_opportunity))
        {
            $created_by_id = $pending_data_opportunity_row['created_by'];
            $user_name_fetch = "SELECT * FROM users WHERE id='$created_by_id'";
            $user_name_fetch_result = $GLOBALS['db']->query($user_name_fetch);
            $user_name_fetch_row = $GLOBALS['db']->fetchByAssoc($user_name_fetch_result);
            $user_name = $user_name_fetch_row['user_name'];
            $first_name = $user_name_fetch_row['first_name'];
            $last_name = $user_name_fetch_row['last_name'];
            $full_name = $first_name . $last_name;
            $data .= ' <tr class="tabvalue">
                    <td>'.$pending_data_opportunity_row['name'].'</td>
                    <td>'.$full_name.'</td>
                    <td>'.$pending_data_opportunity_row['amount'].'</td>
                    <td>'.$pending_data_opportunity_row['rfporeoipublished_c'].'</td>
                    <td>'.$pending_data_opportunity_row['date_modified'].'</td>
                    <td>'.$pending_data_opportunity_row['status_c'].'</td>
                    <td>'.$pending_data_opportunity_row['date_entered'].'</td>
                    <td>
                    <div style="font-size: 20px;">
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-times-circle"></i>
                    <i class="fa fa-info-circle"></i>
                    </div>
                    </td>
                    </tr>';
        }
    }
    }

    public function action_filter_opportunities_by_status(){
        try
        {
            global $current_user;
            $searchTerm = @$_GET['searchTerm'];
            $status_c = $_GET['status_c'];
            $day = $_GET['day'];
            $dropped = $_GET['dropped'];
            $fetch_by_status = "";
            $todayDate = date("Y/m/d");
            $intervalDate = date('y-m-d', strtotime( -$day." ".'days'));
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            $organiztion_global_count = "SELECT count(*) as org_global_count FROM opportunities WHERE opportunity_type = 'global' AND deleted != 1 AND date_entered >= now() - interval '$day' day";
            $organiztion_count_result = $GLOBALS['db']->query($organiztion_global_count);
            $fetch_organization_count = $GLOBALS['db']->fetchByAssoc($organiztion_count_result);
            $global_organization_count = $fetch_organization_count['org_global_count'];

            $columnFilter = @$_GET;
            $columnAmount = @$columnFilter['Amount'];
            $columnREPEOI = @$columnFilter['REP-EOI-Published'];
            $columnClosedDate = @$columnFilter['Closed-Date'];
            $columnClosedBy = @$columnFilter['Closed-by'];
            $columnDateCreated = @$columnFilter['Date-Created'];
            $columnDateClosed = @$columnFilter['Date-Closed'];

            $columnTaggedMembers = @$columnFilter['Tagged-Members'];
            $columnViewedBy = @$columnFilter['Viewed-by'];
            $columnPreviousResponsibility = @$columnFilter['Previous-Responsbility'];
            $columnAttachment = @$columnFilter['Attachment'];

            $non_global_organization_count = $this->get_non_global_op_count($day);
            $data = '<table class="bottomtable" style="font-family: Lato, Lato, Arial, sans-serif !important;
            height: 400px;
            overflow-y: auto;
            overflow-x: hidden;
            display: -webkit-box;
            width: 100%;
            flex-direction: column;">
            <tbody style="display: table; width: 100%;">
            <ul class="table-ul" style="display: flex;
            align-items: center;height: 50px">

                <li class="tableHeader-Content">
                    <div id="global-opportunities" class="global-opportunities" onclick="filter_by_type(\'global\','.$day.')">Global Opportunities ('.$global_organization_count.') </div>
                </li>


                <li class="tableHeader-Content">
                    <div id="non-global-opportunities" class="non-global-opportunities" onclick="filter_by_type(\'non_global\','.$day.')">Non-Global Opportunities ('.$non_global_organization_count.') </div>
                </li>


                <li class="search-box-block">
                    <div class="search-box">
                        <!-- ----------- -->
                        <div style="display: flex;">
                            <div style="display: flex; justify-content: center; align-items: center;">
                                <input type="search" placeholder="Search by name" class="opportunity-search" id="opportunity-search" data-type="filter_opportunities_by_status" data-value="'.$status_c.'" value="'.$searchTerm.'" name="search" />
                                <button class="searchhh opportunity-search-btn" id="search-btn">
                                    <i id="search-icon" class="fa fa-search" aria-hidden="true"> </i>
                                </button>
                            </div>
                            <div style="display: flex; margin-left: auto;">
                                <button class="filter" id="filter_myBtn" onclick="openFilterDialog()" style="padding:10; border: none !important;">
                                    <i class="fa fa-filter" aria-hidden="true"> </i>
                                </button>
                               
                                <button class="cog" id="setting_myBtn" onclick=openSettingDialog("opportunities","action_filter_opportunities_by_status","'.$status_c.'") style="padding:10; border: none !important;">
                                    <i id="setting_myBtn" class="fa fa-list" aria-hidden="true"> </i>
                                </button>
                            </div>
                        </div>
                    </div>

                </li>

            </ul>
            <tr class="table-header-row">
            <th class="table-header">Name</th>
            <th class="table-header">Primary Responsibility</th>';
            if($columnAmount){
                $data .= '<th class="table-header">Amount ( in Cr )</th>';
            }
            if($columnREPEOI){
                $data .= '<th class="table-header">RFP/EOI Published</th>';
            }
            if($columnClosedDate){
                $data .= '<th class="table-header">Modified Date</th>';
            }
            if($columnClosedBy){
                $data .= '<th class="table-header">Modified By</th>';
            }
            if($columnDateCreated){
                $data .= '<th class="table-header">Created Date</th>';
}
if($columnDateClosed){
                $data .= '<th class="table-header">Closed Date</th>';
}
            if($columnTaggedMembers){
                $data .= '<th class="table-header">Tagged Members</th>';
            }
            if($columnViewedBy){
                $data .= '<th class="table-header">Viewed By</th>';
            }
            if($columnPreviousResponsibility){
                $data .= '<th class="table-header">Previous Responsibility</th>';
            }
            if($columnAttachment){
                $data .= '<th class="table-header">Attachment</th>';
            }
        $data .= '<th class="table-header">Action</th></tr>';
           //$fetch_by_status = "SELECT * FROM opportunities LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE status_c='$status_c' AND  date_entered BETWEEN '".$intervalDate."' AND '".$todayDate."'  AND deleted != 1";
           if($searchTerm){
            $fetch_by_status = "SELECT * FROM opportunities LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE status_c='$status_c' AND deleted != 1 AND date_entered >= now() - interval '$day' day AND name LIKE '%$searchTerm%' ";
           }else{
            $fetch_by_status = "SELECT * FROM opportunities LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE status_c='$status_c' AND deleted != 1 AND date_entered >= now() - interval '$day' day ";
           }

            if($status_c == 'Closed'){
                $fetch_by_status .= ' AND opportunities_cstm.closure_status_c = "won" ';
            }else if($status_c == 'Dropped' ){
                $fetch_by_status = "SELECT * FROM opportunities LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE
                deleted != 1 AND date_entered >= now() - interval '$day' day ";
                if ($dropped) {
                    if ($dropped == 'Dropped') {
                        $fetch_by_status .= "AND status_c='Dropped'";
                    } else {
                        $fetch_by_status .= "AND (status_c='Closed' AND opportunities_cstm.closure_status_c = 'lost')";
                    }
                } else {
                    $fetch_by_status .= "AND (status_c='Dropped' OR (status_c='Closed' AND opportunities_cstm.closure_status_c = 'lost'))";
                }
            }


            if($_GET['filter'] && @$_GET['filter-responsibility']){
                $responsibility = $_GET['filter-responsibility'];
                $fetch_by_status .= " AND opportunities.created_by = '$responsibility' ";
            }
            if($_GET['filter'] && @$_GET['filter-rfp-eoi-status']){
                $rpfEOIStatus = $_GET['filter-rfp-eoi-status'];
                $fetch_by_status .= " AND opportunities_cstm.rfporeoipublished_c = '$rpfEOIStatus' ";
            }
            if($_GET['filter'] && @$_GET['filter-min-price'] && @$_GET['filter-max-price']){
                $minPrice = $_GET['filter-min-price'];
                $maxPrice = $_GET['filter-max-price'];
                $fetch_by_status .= " AND opportunities_cstm.budget_allocated_oppertunity_c BETWEEN '$minPrice' AND '$maxPrice' ";
            }
            if($_GET['filter'] && @$_GET['filter-closed-date-from'] && @$_GET['filter-closed-date-to']){
                $closedDateFrom = $_GET['filter-closed-date-from'];
                $closedDateTo = $_GET['filter-closed-date-to'];
                $fetch_by_status .= " AND DATE_FORMAT(opportunities.date_modified, '%d/%m/%Y') BETWEEN '$closedDateFrom' AND '$closedDateTo' ";
            }
            if($_GET['filter'] && @$_GET['filter-created-date-from'] && @$_GET['filter-created-date-to']){
                $createdDateFrom = $_GET['filter-created-date-from'];
                $createdDateTo = $_GET['filter-created-date-to'];
                $fetch_by_status .= " AND DATE_FORMAT(opportunities.date_entered,'%d/%m/%Y') BETWEEN '$createdDateFrom' AND '$createdDateTo' ";
            }

            $fetch_by_status .= "  ORDER BY `opportunities`.`date_modified` DESC";

           //Pagination Count
           $limit = 5;
           $paginationQuery = $GLOBALS['db']->query($fetch_by_status);
           $totalCount = mysqli_num_rows($paginationQuery);
           $numberOfPages = ceil( $totalCount / $limit );
           
           $offset = @$_GET['page'] ? ($_GET['page'] - 1)  * $limit : 0;

           $fetch_by_status .= " LIMIT $offset, $limit";
           
            $fetch_by_status_result = $GLOBALS['db']->query($fetch_by_status);
            while($row = $GLOBALS['db']->fetchByAssoc($fetch_by_status_result))
            {
                $created_by_id = $row['created_by'];
                $user_name_fetch = "SELECT * FROM users WHERE id='$created_by_id'";
                $user_name_fetch_result = $GLOBALS['db']->query($user_name_fetch);
                $user_name_fetch_row = $GLOBALS['db']->fetchByAssoc($user_name_fetch_result);
                $user_name = $user_name_fetch_row['user_name'];
                $first_name = $user_name_fetch_row['first_name'];
                $last_name = $user_name_fetch_row['last_name'];
                $full_name = "$first_name  $last_name";
                $closed_by = '';
                if (!empty($row['date_modified'])) {
                    $modified_user_id = $row['modified_user_id'];
                    $modified_user_query = "SELECT * FROM users WHERE id='$modified_user_id'";
                    $modified_user_query_fetch = $GLOBALS['db']->query($modified_user_query);
                    $modified_user_query_fetch_row = $GLOBALS['db']->fetchByAssoc($modified_user_query_fetch);
                    $closed_by_first_name = $modified_user_query_fetch_row['first_name'];
                    $closed_by_last_name = $modified_user_query_fetch_row['last_name'];
                    $closed_by = "$closed_by_first_name $closed_by_last_name";
                    // To Do: Find actual closed by
                }
                $data .='
                     <tr>
                        <td class="table-data">'.$row['name'].'</td>
                        <td class="table-data">'.$full_name.'</td>';
                if($columnAmount){
                    $data .= '<td class="table-data">'.($this->beautify_amount($row['budget_allocated_oppertunity_c'])).'</td>';
                }
                if($columnREPEOI){
                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label($row['rfporeoipublished_c'])))).'</td>';
                }
                if($columnClosedDate){
                    $data .= '<td class="table-data">'.date_format(date_create($row['date_modified']),'d/m/Y').'</td>'; 
                }
                if($columnClosedBy){
                    $data .= '<td class="table-data" >'.$closed_by.'</td>';
                }
                if($columnDateCreated){
                    $data .= '<td class="table-data">'.date_format(date_create($row['date_entered']),'d/m/Y').'</td>';
                }
if($columnDateClosed){
                    if($row['date_closed']){
                        $closedDate = date_format(date_create($row['date_closed']),'d/m/Y');
                    }else{
                        $closedDate = '';
                    }
                    $data .= '<td class="table-data">'.$closedDate.'</td>';
                }
                
                if($columnTaggedMembers){
                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $this->getTaggedMembers($row['id']) )))).'</td>';
                }
                if($columnViewedBy){
                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $this->getModifiedUser($row['modified_user_id']) )))).'</td>';
                }
                if($columnPreviousResponsibility){
                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $this->getModifiedUser($row['created_by']) )))).'</td>';
                }
                if($columnAttachment){
                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $row['file_url'] ? $row['file_url'] : '' )))).'</td>';
                }
                        
                        
                        /*<td class="table-data">'.($this->beautify_amount($row['budget_allocated_oppertunity_c'])).'</td>
                                        <td class="table-data">'.($this->beautify_label($row['rfporeoipublished_c'])).'</td>
                                        <td class="table-data">'.date_format(date_create($row['date_closed']),'d/m/Y').'</td>
                                        <td class="table-data"  style="color: blue">'.$closed_by.'</td>
                                        <td class="table-data">'.date_format(date_create($row['date_entered']),'d/m/Y').'</td>*/;
                $data .= '
                    <td class="table-data">
                    <div style="display: flex; width: 80%; align-items: center; padding: 10px; justify-content: space-between; margin-left: 20px;">';
                
                $data .= '<button class="tag1" id="deselectBtn" style="margin-right: 15px; width: 18px;" onClick=getSequenceFlow("'.$row['id'].'")>';
                if($this->checkRecentActivity($row['id'])):
                    $data .= '<img id="search-icon" src="modules/Home/assets/Frame-12.svg" alt="svg" style="color: #333333;"/>';   
                endif;
                $data .= '</button>';

                if ($this->is_tagging_applicable($row['id'])) {
                    $data .='<button class="tag" id="deselectBtn" onclick="fetchDeselectDialog(\''.$row['id'].'\')">                                            <i id="search-icon" class="fa fa-tag" aria-hidden="true"> </i>
                            </button>';
                }
                $data .='<a href="index.php?action=DetailView&module=Opportunities&record='.$row['id'].'" class="eye" id="search-btn">
                        <i id="search-icon" class="fa fa-eye" aria-hidden="true"> </i>
                        </a>
                    </div>
                    </td>
                </tr>';
                /*$data .='
                     <tr>
                        <td class="table-data">'.$row['name'].'</td>
                        <td class="table-data" style="color: blue">'.$full_name.'</td>
                                        <td class="table-data">'.($this->beautify_amount($row['budget_allocated_oppertunity_c'])).'</td>
                                        <td class="table-data">'.($this->beautify_label($row['rfporeoipublished_c'])).'</td>
                                        <td class="table-data" >'.date_format(date_create($row['date_closed']),'d/m/Y').'</td>
                                        <td class="table-data"  style="color: blue">'.$closed_by.'</td>
                                        <td class="table-data">'.date_format(date_create($row['date_entered']),'d/m/Y').'</td>
                                        <td class="table-data">
                                        <div style="display: flex; width: 100%; align-items: center; padding: 10px; justify-content: flex-start;">
                                          <button class="tag" id="deselectBtn" onclick="fetchDeselectDialog(\''.$row['id'].'\')">
                                            <i id="search-icon" class="fa fa-tag" aria-hidden="true"> </i>
                                          </button>
                                          <a href="index.php?action=DetailView&module=Opportunities&record='.$row['id'].'" class="eye" id="search-btn">
                                            <i id="search-icon" class="fa fa-eye" aria-hidden="true"> </i>
                                          </a>
                                        </div>
                                      </td>
                                    </tr>';*/
            }
            $data.='</tbody></table>';

            //Pagination 
            $page = @$_GET['page'] ? $_GET['page'] : 1;
            if ($totalCount > ( $page * $limit)){
                $currentPost = ($page * $limit);
            } else {
                $currentPost = $totalCount;
            }
            
            $data .= '<div class="pagination text-right">';
            $data .= '<p class="d-inline-block">Showing '.$currentPost.' of '.$totalCount.'</p>';
            $data .= $this->pagination($page, $numberOfPages, 'filter_opportunities_by_status', $status_c, $searchTerm, $_GET['filter']);
            $data .= '</div>';

            echo $data;
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }

    public function action_filter_by_opportunity_type(){
        try
        {
            global $current_user;
            // print_r($current_user);
            // die();
            $log_in_user_id = $current_user->id;
            // 	if($current_user->is_admin !=1){
            // 	    echo 'not admin';
            // 	}else{
            // 	     echo 'admin';
            // 	}
            // 	die();
            $db = \DBManagerFactory::getInstance();

            $searchTerm = @$_GET['searchTerm'];
            $type = $_GET['type'];
            $day = $_GET['day'];
            $todayDate = date("Y/m/d");
            $intervalDate = date('y-m-d', strtotime( -$day." ".'days'));
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $columnFilter = @$_GET;
            $columnAmount = @$columnFilter['Amount'];
            $columnREPEOI = @$columnFilter['REP-EOI-Published'];
            $columnClosedDate = @$columnFilter['Closed-Date'];
            $columnClosedBy = @$columnFilter['Closed-by'];
            $columnDateCreated = @$columnFilter['Date-Created'];
$columnDateClosed = @$columnFilter['Date-Closed'];

            $columnTaggedMembers = @$columnFilter['Tagged-Members'];
            $columnViewedBy = @$columnFilter['Viewed-by'];
            $columnPreviousResponsibility = @$columnFilter['Previous-Responsbility'];
            $columnAttachment = @$columnFilter['Attachment'];



            $organiztion_global_count = "SELECT count(*) as org_global_count FROM opportunities WHERE opportunity_type = 'global' AND deleted != 1 AND date_entered >= now() - interval '$day' day";
            $organiztion_count_result = $GLOBALS['db']->query($organiztion_global_count);
            $fetch_organization_count = $GLOBALS['db']->fetchByAssoc($organiztion_count_result);
            $global_organization_count = $fetch_organization_count['org_global_count'];

            $non_global_organization_count = $this->get_non_global_op_count($day);

            $data = '<table class="bottomtable" style="font-family: Lato, Lato, Arial, sans-serif !important;
            height: 400px;
            overflow-y: auto;
            overflow-x: hidden;
            display: -webkit-box;
            width: 100%;
            flex-direction: column;">
            <tbody style="display: table; width: 100%;">
            <ul class="table-ul" style="display: flex;
            align-items: center;height: 50px">

                <li class="tableHeader-Content">
                    <div id="global-opportunities" class="global-opportunities" onclick="filter_by_type(\'global\','.$day.')">Global Opportunities ('.$global_organization_count.') </div>
                </li>


                <li class="tableHeader-Content">
                    <div id="non-global-opportunities" class="non-global-opportunities" onclick="filter_by_type(\'non_global\','.$day.')">Non-Global Opportunities ('.$non_global_organization_count.') </div>
                </li>


                <li class="search-box-block">
                    <div class="search-box">
                        <!-- ----------- -->
                        <div style="display: flex;">
                            <div style="display: flex; justify-content: center; align-items: center;">
                                <input type="search" placeholder="Search by name" class="opportunity-search" id="opportunity-search" data-type="filter_by_opportunity_type" data-value="'.$type.'" value="'.$searchTerm.'" name="search" />
                                <button class="searchhh opportunity-search-btn" id="search-btn">
                                    <i id="search-icon" class="fa fa-search" aria-hidden="true"> </i>
                                </button>
                            </div>
                            <div style="display: flex; margin-left: auto;">
                                <button class="filter" id="filter_myBtn" onclick="openFilterDialog()" style="padding:10; border: none !important;">
                                    <i class="fa fa-filter" aria-hidden="true"> </i>
                                </button>
                               
                                <button class="cog" id="setting_myBtn" onclick=openSettingDialog("opportunities","action_filter_by_opportunity_type","'.$type.'") style="padding:10; border: none !important;">
                                    <i id="setting_myBtn" class="fa fa-list" aria-hidden="true"> </i>
                                </button>
                            </div>
                        </div>
                    </div>

                </li>

            </ul>
            <tr class="table-header-row">
            <th class="table-header">Name</th>
            <th class="table-header">Primary Responsibility</th>';
            if($columnAmount){
                $data .= '<th class="table-header">Amount ( in Cr )</th>';
            }
            if($columnREPEOI){
                $data .= '<th class="table-header">RFP/EOI Published</th>';
            }
            if($columnClosedDate){
                $data .= '<th class="table-header">Modified Date</th>';
            }
            if($columnClosedBy){
                $data .= '<th class="table-header">Modified By</th>';
            }
            if($columnDateCreated){
                $data .= '<th class="table-header">Created Date</th>';
}
if($columnDateClosed){
                $data .= '<th class="table-header">Closed Date</th>';
}
            if($columnTaggedMembers){
                $data .= '<th class="table-header">Tagged Members</th>';
            }
            if($columnViewedBy){
                $data .= '<th class="table-header">Viewed By</th>';
            }
            if($columnPreviousResponsibility){
                $data .= '<th class="table-header">Previous Responsibility</th>';
            }
            if($columnAttachment){
                $data .= '<th class="table-header">Attachment</th>';
            }
            $data .= '<th class="table-header">Action</th>
        </tr>';
            $type = $_GET['type'];
            if($searchTerm){
                $fetch_query = "SELECT * FROM opportunities LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE opportunity_type='$type' AND deleted != 1 AND date_entered >= now() - interval '$day' day AND name LIKE '%$searchTerm%' AND 
                opportunities.id NOT IN(
                SELECT opp_id FROM untagged_user WHERE user_id LIKE '%$log_in_user_id%'
                ) ";
            }else{
                $fetch_query = "SELECT * FROM opportunities LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE opportunity_type='$type' AND deleted != 1 AND date_entered >= now() - interval '$day' day AND 
                opportunities.id NOT IN(
                SELECT opp_id FROM untagged_user WHERE user_id LIKE '%$log_in_user_id%'
                )";
            }


            if($_GET['filter'] && @$_GET['filter-responsibility']){
                $responsibility = $_GET['filter-responsibility'];
                $fetch_query .= " AND opportunities.created_by = '$responsibility' ";
            }
            if($_GET['filter'] && @$_GET['filter-rfp-eoi-status']){
                $rpfEOIStatus = $_GET['filter-rfp-eoi-status'];
                $fetch_query .= " AND opportunities_cstm.rfporeoipublished_c = '$rpfEOIStatus' ";
            }
            if($_GET['filter'] && @$_GET['filter-min-price'] && @$_GET['filter-max-price']){
                $minPrice = $_GET['filter-min-price'];
                $maxPrice = $_GET['filter-max-price'];
                $fetch_query .= " AND opportunities_cstm.budget_allocated_oppertunity_c BETWEEN '$minPrice' AND '$maxPrice' ";
            }
            if($_GET['filter'] && @$_GET['filter-closed-date-from'] && @$_GET['filter-closed-date-to']){
                $closedDateFrom = $_GET['filter-closed-date-from'];
                $closedDateTo = $_GET['filter-closed-date-to'];
                $fetch_query .= " AND DATE_FORMAT(opportunities.date_modified, '%d/%m/%Y') BETWEEN '$closedDateFrom' AND '$closedDateTo' ";
            }
            if($_GET['filter'] && @$_GET['filter-created-date-from'] && @$_GET['filter-created-date-to']){
                $createdDateFrom = $_GET['filter-created-date-from'];
                $createdDateTo = $_GET['filter-created-date-to'];
                $fetch_query .= " AND DATE_FORMAT(opportunities.date_entered, '%d/%m/%Y') BETWEEN '$createdDateFrom' AND '$createdDateTo' ";
            }

            $fetch_query .= " ORDER BY `opportunities`.`date_modified` DESC";

            //Pagination Count
            $limit = 5;
            $paginationQuery = $GLOBALS['db']->query($fetch_query);
            $totalCount = mysqli_num_rows($paginationQuery);
            $numberOfPages = ceil( $totalCount / $limit );
            
            $offset = @$_GET['page'] ? ($_GET['page'] - 1)  * $limit : 0;

            $fetch_query .= " LIMIT $offset, $limit";

            $result = $GLOBALS['db']->query($fetch_query);
            while($row = $GLOBALS['db']->fetchByAssoc($result))
            {
                $created_by_id = $row['created_by'];
                $user_name_fetch = "SELECT * FROM users WHERE id='$created_by_id'";
                $user_name_fetch_result = $GLOBALS['db']->query($user_name_fetch);
                $user_name_fetch_row = $GLOBALS['db']->fetchByAssoc($user_name_fetch_result);
                $user_name = $user_name_fetch_row['user_name'];
                $first_name = $user_name_fetch_row['first_name'];
                $last_name = $user_name_fetch_row['last_name'];
                $full_name = "$first_name  $last_name";
                $closed_by = '';
                if (!empty($row['date_modified'])) {
                    $modified_user_id = $row['modified_user_id'];
                    $modified_user_query = "SELECT * FROM users WHERE id='$modified_user_id'";
                    $modified_user_query_fetch = $GLOBALS['db']->query($modified_user_query);
                    $modified_user_query_fetch_row = $GLOBALS['db']->fetchByAssoc($modified_user_query_fetch);
                    $closed_by_first_name = $modified_user_query_fetch_row['first_name'];
                    $closed_by_last_name = $modified_user_query_fetch_row['last_name'];
                    $closed_by = "$closed_by_first_name $closed_by_last_name";
                    // To Do: Find actual closed by
                }
                $data .='
                     <tr>
                        <td class="table-data">'.$row['name'].'</td>
                        <td class="table-data">'.$full_name.'</td>';
                if($columnAmount){
                    $data .= '<td class="table-data">'.($this->beautify_amount($row['budget_allocated_oppertunity_c'])).'</td>';
                }
                if($columnREPEOI){
                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label($row['rfporeoipublished_c'])))).'</td>';
                }
                if($columnClosedDate){
                    $data .= '<td class="table-data">'.date_format(date_create($row['date_modified']),'d/m/Y').'</td>'; 
                }
                if($columnClosedBy){
                    $data .= '<td class="table-data" >'.$closed_by.'</td>';
                }
                if($columnDateCreated){
                    $data .= '<td class="table-data">'.date_format(date_create($row['date_entered']),'d/m/Y').'</td>';
                }
if($columnDateClosed){
                    if($row['date_closed']){
                        $closedDate = date_format(date_create($row['date_closed']),'d/m/Y');
                    }else{
                        $closedDate = '';
                    }
                    $data .= '<td class="table-data">'.$closedDate.'</td>';
                }
                
                if($columnTaggedMembers){
                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $this->getTaggedMembers($row['id']) )))).'</td>';
                }
                if($columnViewedBy){
                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $this->getModifiedUser($row['modified_user_id']) )))).'</td>';
                }
                if($columnPreviousResponsibility){
                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $this->getModifiedUser($row['created_by']) )))).'</td>';
                }
                if($columnAttachment){
                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $row['file_url'] ? $row['file_url'] : '' )))).'</td>';
                }
                        
                        
                        /*<td class="table-data">'.($this->beautify_amount($row['budget_allocated_oppertunity_c'])).'</td>
                                        <td class="table-data">'.($this->beautify_label($row['rfporeoipublished_c'])).'</td>
                                        <td class="table-data">'.date_format(date_create($row['date_closed']),'d/m/Y').'</td>
                                        <td class="table-data"  style="color: blue">'.$closed_by.'</td>
                                        <td class="table-data">'.date_format(date_create($row['date_entered']),'d/m/Y').'</td>*/;
                $data .= '
                    <td class="table-data">
                    <div style="display: flex; width: 80%; align-items: center; padding: 10px; justify-content: space-between; margin-left: 20px;">';

                $data .= '<button class="tag1" id="deselectBtn" style="margin-right: 15px;width: 18px;" onClick=getSequenceFlow("'.$row['id'].'")>';
                if($this->checkRecentActivity($row['id'])):
                    $data .= '<img id="search-icon" src="modules/Home/assets/Frame-12.svg" alt="svg" style="color: #333333;"/>';   
                endif;
                $data .= '</button>';
                
                if ($this->is_tagging_applicable($row['id'])) {
                    $data .='<button class="tag" id="deselectBtn" onclick="fetchDeselectDialog(\''.$row['id'].'\')">                                            <i id="search-icon" class="fa fa-tag" aria-hidden="true"> </i>
                            </button>';
                }
                $data .='
                        <a href="index.php?action=DetailView&module=Opportunities&record='.$row['id'].'" class="eye" id="search-btn">
                        <i id="search-icon" class="fa fa-eye" aria-hidden="true"> </i>
                        </a>
                    </div>
                    </td>
                </tr>';
            }
            $data.='</tbody></table>';

            //Pagination 
            $page = @$_GET['page'] ? $_GET['page'] : 1;
            if ($totalCount > ( $page * $limit)){
                $currentPost = ($page * $limit);
            } else {
                $currentPost = $totalCount;
            }
            $data .= '<div class="pagination text-right">';
            $data .= '<p class="d-inline-block">Showing '.$currentPost.' of '.$totalCount.'</p>';
            $data .= $this->pagination($page, $numberOfPages, 'filter_by_opportunity_type', $type, $searchTerm, $_GET['filter']);
            $data .= '</div>';

            echo $data;
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }




    public function action_delegate_members(){
        try
        {
            global $current_user;
            // print_r($current_user);
            // die();
            $log_in_user_id = $current_user->id;
            // 	if($current_user->is_admin !=1){
            // 	    echo 'not admin';
            // 	}else{
            // 	     echo 'admin';
            // 	}
            // 	die();

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            $check_user_team = "SELECT teamfunction_c from users LEFT JOIN users_cstm ON users.id = users_cstm.id_c WHERE id = '$log_in_user_id'";
            $check_user_team_result = $GLOBALS['db']->query($check_user_team);
            $user_team_row = $GLOBALS['db']->fetchByAssoc($check_user_team_result);
            $user_team = $user_team_row['teamfunction_c'];
            

            // $fetch_query = "SELECT  u.* from users u JOIN users_cstm u2 ON u2.id_c = u.id WHERE u2.teamheirarchy_c = 'team_lead' ";
            $fetch_query = "SELECT * FROM users WHERE `id` != '$log_in_user_id' AND `id` != '1' ORDER BY `users`.`first_name` ASC";
            $result = $GLOBALS['db']->query($fetch_query);
            $data = '<option value="" disabled selected>Select Option</option>';
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $full_name = $row['first_name'] . ' ' . $row['last_name'];
                    $data .= '<option value="'.$row['id'].'" selected="">'.$full_name.'</option>';
                }
            } else {
                echo "0 results";
            }
            echo json_encode(array('members'=>$data, 'logged_in_user_team'=>$user_team, 'logged_in_id' => $log_in_user_id));

        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }





    public function action_show_data_between_date(){
        try
        {
            global $current_user;

            $searchTerm = @$_GET['searchTerm'];

            $columnFilter = @$_GET;
            $columnAmount = @$columnFilter['Amount'];
            $columnREPEOI = @$columnFilter['REP-EOI-Published'];
            $columnClosedDate = @$columnFilter['Closed-Date'];
            $columnClosedBy = @$columnFilter['Closed-by'];
            $columnDateCreated = @$columnFilter['Date-Created'];
$columnDateClosed = @$columnFilter['Date-Closed'];

            $columnTaggedMembers = @$columnFilter['Tagged-Members'];
            $columnViewedBy = @$columnFilter['Viewed-by'];
            $columnPreviousResponsibility = @$columnFilter['Previous-Responsbility'];
            $columnAttachment = @$columnFilter['Attachment'];

            $user_for_delegates = '';
            $self_count = 0;
            $team_count = 0;
            $lead_data = "";
            $log_in_user_id = $current_user->id;
            $global_organization_count = 0;
            $non_global_organization_count = 0;
            $fetch_by_status_c = '';


            $db = \DBManagerFactory::getInstance();
            $day = $_GET['days'];
            $GLOBALS['db'];
            
            // print_r($_GET['filter']); die;


            $check_user_team = "SELECT teamfunction_c from users LEFT JOIN users_cstm ON users.id = users_cstm.id_c WHERE id = '$log_in_user_id'";
            $check_user_team_result = $GLOBALS['db']->query($check_user_team);
            $user_team_row = $GLOBALS['db']->fetchByAssoc($check_user_team_result);
            $user_team = $user_team_row['teamfunction_c'];

            $todayDate = date("Y/m/d");
            $intervalDate = date('y-m-d', strtotime( -$day." ".'days'));


            $fetch_total_opportunity = "SELECT count(*) as total from opportunities WHERE deleted != 1 AND date_entered >= now() - interval '$day' day";
            $fetch_total_result = $GLOBALS['db']->query($fetch_total_opportunity);
            $fetch_total = $GLOBALS['db']->fetchByAssoc($fetch_total_result);
            $total = $fetch_total['total'];


            $organiztion_global_count = "SELECT count(*) as org_global_count FROM opportunities WHERE opportunity_type = 'global' AND deleted != 1 AND date_entered >= now() - interval '$day' day";
            $organiztion_count_result = $GLOBALS['db']->query($organiztion_global_count);
            $fetch_organization_count = $GLOBALS['db']->fetchByAssoc($organiztion_count_result);
            $global_organization_count = $fetch_organization_count['org_global_count'];

            $non_global_organization_count = $this->get_non_global_op_count($day);

           $fetch_self_count = "SELECT count(*) as self_count FROM opportunities LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE  created_by='$log_in_user_id' AND deleted != 1 AND date_entered >= now() - interval '$day' day";
           $fetch_self_result = $GLOBALS['db']->query($fetch_self_count);
           $fetch_self = $GLOBALS['db']->fetchByAssoc($fetch_self_result);
           $self_count = $fetch_self['self_count'];
           

           $fetch_team_count = "SELECT count(*) as team_count from opportunities LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE  deleted != 1 AND date_entered >= now() - interval '$day' day AND assigned_user_id IN (SELECT id_c FROM users_cstm WHERE teamfunction_c = (SELECT teamfunction_c FROM users_cstm WHERE id_c = '$log_in_user_id'))";
            $fetch_team_result = $GLOBALS['db']->query($fetch_team_count);
            $fetch_team = $GLOBALS['db']->fetchByAssoc($fetch_team_result);
            $team_count = $fetch_team['team_count'];

           $fetch_by_status = "";
           $result = array();


            //$fetch_status_leads = "SELECT count(oc.id_c) as mainCount, oc.status_c FROM opportunities o LEFT JOIN opportunities_cstm oc ON o.id = oc.id_c WHERE o.date_entered BETWEEN '".$intervalDate."' AND '".$todayDate."'  AND o.deleted != 1 GROUP BY oc.status_c";
            $fetch_status_leads = "SELECT count(oc.id_c) as mainCount, oc.status_c FROM opportunities o LEFT JOIN opportunities_cstm oc ON o.id = oc.id_c WHERE o.deleted != 1 AND o.date_entered >= now() - interval '$day' day GROUP BY oc.status_c";
            $fetch_status_leads_result = $GLOBALS['db']->query($fetch_status_leads);

            $Lead_chunk = $this->get_default_chunk('Lead');
            $QualifiedLead_chunk = $this->get_default_chunk('QualifiedLead'); $QualifiedOpportunity_chunk = $this->get_default_chunk('Qualified');
            $QualifiedDpr_chunk = $this->get_default_chunk('QualifiedDpr');
            $QualifiedBid_chunk = $this->get_default_chunk('QualifiedBid'); $Close_chunk = $this->get_default_chunk('Closed');
            $Qualified_chunk = ''; $Dropped_chunk = $this->get_default_chunk('Dropped'); $Drop_chunk = '';
            $Closed_Lost_chunk = $this->get_default_chunk('ClosedLost');
            
            while($row = $GLOBALS['db']->fetchByAssoc($fetch_status_leads_result))
            {   
                $main_count = $row['mainCount'];
                $Status = $row['status_c'];
                if ($Status == 'Qualified') {
                    $Status = 'QualifiedOpportunity';
                }
                
                $fetch_team_count_by_status = "SELECT count(*) as team_count_by_status from opportunities LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE  deleted != 1 AND date_entered >= now() - interval '$day' day AND status_c= '".$row['status_c']."' AND assigned_user_id IN (SELECT id_c FROM users_cstm WHERE teamfunction_c = (SELECT teamfunction_c FROM users_cstm WHERE id_c = '$log_in_user_id')) ";
                $fetch_team_count_by_status_result = $GLOBALS['db']->query($fetch_team_count_by_status);
                $fetch_team_result_by_status = $GLOBALS['db']->fetchByAssoc($fetch_team_count_by_status_result);
                $team_count_by_status = $fetch_team_result_by_status['team_count_by_status'];

                $fetch_self_count_by_status = "SELECT count(*) as self_count_by_status FROM opportunities LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE status_c= '".$row['status_c']."' AND created_by='$log_in_user_id' AND deleted != 1 AND date_entered >= now() - interval '$day' day";
                $fetch_self_count_by_status_result = $GLOBALS['db']->query($fetch_self_count_by_status);
                $fetch_self_result_by_status = $GLOBALS['db']->fetchByAssoc($fetch_self_count_by_status_result);
                $self_count_by_status = $fetch_self_result_by_status['self_count_by_status'];
                
                if ($Status == 'Closed' || $Status == 'Dropped') {
                    $closed_lost_count_org_query = "SELECT count(*) as lost_count FROM opportunities o LEFT JOIN opportunities_cstm oc ON o.id = oc.id_c WHERE o.deleted != 1 AND o.date_entered >= now() - interval '$day' day AND oc.status_c='Closed' AND oc.closure_status_c ='lost' ";
                    $closed_lost_count_org_result = $GLOBALS['db']->query($closed_lost_count_org_query);
                    $closed_lost_count_org_res = $GLOBALS['db']->fetchByAssoc($closed_lost_count_org_result);
                    $closed_lost_count_org = $closed_lost_count_org_res['lost_count'];
                    $closed_lost_count_team_query = "SELECT count(*) as lost_count FROM opportunities o LEFT JOIN opportunities_cstm oc ON o.id = oc.id_c WHERE o.deleted != 1 AND o.date_entered >= now() - interval '$day' day AND oc.status_c='Closed' AND oc.closure_status_c ='lost' AND assigned_user_id IN (SELECT id_c FROM users_cstm WHERE teamfunction_c = (SELECT teamfunction_c FROM users_cstm WHERE id_c = '$log_in_user_id'))";
                    $closed_lost_count_team_result = $GLOBALS['db']->query($closed_lost_count_team_query);
                    $closed_lost_count_team_res = $GLOBALS['db']->fetchByAssoc($closed_lost_count_team_result);
                    $closed_lost_count_team = $closed_lost_count_team_res['lost_count'];
                    $closed_lost_count_self_query = "SELECT count(*) as lost_count FROM opportunities o LEFT JOIN opportunities_cstm oc ON o.id = oc.id_c WHERE o.deleted != 1 AND o.date_entered >= now() - interval '$day' day AND oc.status_c='Closed' AND oc.closure_status_c ='lost' AND created_by='$log_in_user_id'";
                    $closed_lost_count_self_result = $GLOBALS['db']->query($closed_lost_count_self_query);
                    $closed_lost_count_self_res = $GLOBALS['db']->fetchByAssoc($closed_lost_count_self_result);
                    $closed_lost_count_self = $closed_lost_count_self_res['lost_count'];
                    if ($Status == 'Closed') {
                        $Status = 'Closed Won';
                        $main_count = $main_count - $closed_lost_count_org;
                        if ($team_count_by_status > $closed_lost_count_team) {
                            $team_count_by_status = $team_count_by_status - $closed_lost_count_team;
                        }
                        if ($self_count_by_status > $closed_lost_count_self) {
                            $self_count_by_status = $self_count_by_status - $closed_lost_count_self;
                        }
                    }else if ($Status == 'Dropped') {
                    }
                }
                $temp = '<div id=\''.$row["status_c"].'\' class="card-status" onclick="fetchRecordByStatus_C(\''.$row['status_c'].'\',\''.$day.'\')">
                <p class="card-status-head">'.$this->split_camel_case($Status).'</p>
                <p class="card-status-top"><span class="card-status-number">'.$main_count.'</span> <br> <span class="card-status-subtitle">Org </span> </p>
                <p class="card-status-top"><span class="card-status-number-two"> '.$team_count_by_status.' </span> <br> <span class="card-status-subtitle-two">Team </span> </p>
                <p class="card-status-top"><span class="card-status-number-three"> '.$self_count_by_status.' </span> <br> <span class="card-status-subtitle-three">Self </span> </p>
                                
                </div>';
                switch ($row['status_c']) {
                    case 'Lead':
                        $Lead_chunk = $temp;
                        break;
                    case 'QualifiedOpportunity':
                        $Qualified_chunk = $temp;
                        break;
                    case 'QualifiedLead':
                        $QualifiedLead_chunk = $temp;
                        break;
                    case 'Qualified':
                        $QualifiedOpportunity_chunk = $temp;
                        break;
                    case 'QualifiedDpr':
                        $QualifiedDpr_chunk = $temp;
                        break;
                    case 'QualifiedBid':
                        $QualifiedBid_chunk = $temp;
                        break;
                    case 'Closed':
                        $Close_chunk = $temp;
                        break;
                    case 'Drop':
                        $Drop_chunk = $temp;
                        break;
                    case 'Dropped':
                        $temp = '<div id=\''.$row["status_c"].'\' class="card-status" onclick="fetchRecordByStatus_C(\'Dropped\',\''.$day.'\',null, null, 0, \'Dropped\')">
                                <p class="card-status-head">
                                    Dropped
                                </p>
                                <p class="card-status-top"><span class="card-status-number">'.$main_count.'</span> <br> <span class="card-status-subtitle">Org </span> </p>
                                <p class="card-status-top"><span class="card-status-number-two"> '.$team_count_by_status.' </span> <br> <span class="card-status-subtitle-two">Team </span> </p>
                                <p class="card-status-top"><span class="card-status-number-three"> '.$self_count_by_status.' </span> <br> <span class="card-status-subtitle-three">Self </span> </p>
                                                
                                </div>';
                        $temp1 = '<div id=\'ClosedLost\' class="card-status" onclick="fetchRecordByStatus_C(\'Dropped\',\''.$day.'\',null, null, 0, \'ClosedLost\')">
                                <p class="card-status-head">
                                    Closed Lost
                                </p>
                                <p class="card-status-top"><span class="card-status-number">'.$closed_lost_count_org.'</span> <br> <span class="card-status-subtitle">Org </span> </p>
                                <p class="card-status-top"><span class="card-status-number-two"> '.$closed_lost_count_team.' </span> <br> <span class="card-status-subtitle-two">Team </span> </p>
                                <p class="card-status-top"><span class="card-status-number-three"> '.$closed_lost_count_self.' </span> <br> <span class="card-status-subtitle-three">Self </span> </p>
                                                
                                </div>';
                        $Dropped_chunk = $temp;
                        $Closed_Lost_chunk = $temp1;
                        break;
                }
                
            }
            $fetch_by_status .= $Lead_chunk .$QualifiedLead_chunk . $QualifiedOpportunity_chunk . $QualifiedDpr_chunk . $QualifiedBid_chunk . $Close_chunk .$Closed_Lost_chunk .$Dropped_chunk;
            $data = '<table class="bottomtable" style="font-family: Lato, Lato, Arial, sans-serif !important;
            height: 400px;
            overflow-y: auto;
            overflow-x: hidden;
            display: -webkit-box;
            width: 100%;
            flex-direction: column;">
            <tbody style="display: table; width: 100%;">
            <ul class="table-ul" style="display: flex;
            align-items: center;height: 50px">

                <li class="tableHeader-Content">
                    <div id="global-opportunities" class="global-opportunities" onclick="filter_by_type(\'global\','.$day.')">Global Opportunities ('.$global_organization_count.') </div>
                </li>


                <li class="tableHeader-Content">
                    <div id="non-global-opportunities" class="non-global-opportunities" onclick="filter_by_type(\'non_global\','.$day.')">Non-Global Opportunities ('.$non_global_organization_count.') </div>
                </li>


                <li class="search-box-block">
                    <div class="search-box">
                        <!-- ----------- -->
                        <div style="display: flex;">
                            <div style="display: flex; justify-content: center; align-items: center;">
                                <input type="search" placeholder="Search by name" class="opportunity-search" id="opportunity-search" data-type="show_data_between_date" data-value="'.$day.'" value="'.$searchTerm.'" name="search" />
                                <button class="searchhh opportunity-search-btn" id="search-btn">
                                    <i id="search-icon" class="fa fa-search" aria-hidden="true"> </i>
                                </button>
                            </div>
                            <div style="display: flex; margin-left: auto;">

                                <button class="filter" id="filter_myBtn" onclick="openFilterDialog()" style="padding:10; border: none !important;">
                                    <i class="fa fa-filter" aria-hidden="true"> </i>
                                </button>
                             

                                <button class="cog" id="setting_myBtn" onclick=openSettingDialog("opportunities","action_show_data_between_date") style="padding:10; border: none !important;">
                                    <i id="setting_myBtn" class="fa fa-list" aria-hidden="true"> </i>
                                </button>
                            </div>
                        </div>
                    </div>

                </li>

            </ul>
            <tr class="table-header-row">
                <th class="table-header">Name</th>
                <th class="table-header">Primary Responsibility</th>';
            if($columnAmount){
                $data .= '<th class="table-header">Amount ( in Cr )</th>';
            }
            if($columnREPEOI){
                $data .= '<th class="table-header">RFP/EOI Published</th>';
            }
            if($columnClosedDate){
                $data .= '<th class="table-header">Modified Date</th>';
            }
            if($columnClosedBy){
                $data .= '<th class="table-header">Modified By</th>';
            }
            if($columnDateCreated){
                $data .= '<th class="table-header">Created Date</th>';
}
if($columnDateClosed){
                $data .= '<th class="table-header">Closed Date</th>';
}
            if($columnTaggedMembers){
                $data .= '<th class="table-header">Tagged Members</th>';
            }
            if($columnViewedBy){
                $data .= '<th class="table-header">Viewed By</th>';
            }
            if($columnPreviousResponsibility){
                $data .= '<th class="table-header">Previous Responsibility</th>';
            }
            if($columnAttachment){
                $data .= '<th class="table-header">Attachment</th>';
            }

            $data .= '<th class="table-header text-center">Action</th>
            </tr>';

            if($searchTerm){
                $fetch_query = "SELECT opportunities.*, opportunities_cstm.* FROM opportunities
                    LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE opportunities.deleted != 1 AND opportunities.date_entered >= now() - interval '$day' day AND opportunities.name LIKE '%$searchTerm%' ";
            }else{
                $fetch_query = "SELECT opportunities.*, opportunities_cstm.* FROM opportunities
                    LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE deleted != 1 AND date_entered >= now() - interval '$day' day ";
            }

            if($_GET['filter'] && @$_GET['filter-responsibility']){
                $responsibility = $_GET['filter-responsibility'];
                $fetch_query .= " AND opportunities.created_by = '$responsibility' ";
            }
            if($_GET['filter'] && @$_GET['filter-rfp-eoi-status']){
                $rpfEOIStatus = $_GET['filter-rfp-eoi-status'];
                $fetch_query .= " AND opportunities_cstm.rfporeoipublished_c = '$rpfEOIStatus' ";
            }
            if($_GET['filter'] && @$_GET['filter-min-price'] && @$_GET['filter-max-price']){
                $minPrice = $_GET['filter-min-price'];
                $maxPrice = $_GET['filter-max-price'];
                $fetch_query .= " AND opportunities_cstm.budget_allocated_oppertunity_c BETWEEN '$minPrice' AND '$maxPrice' ";
            }
            if($_GET['filter'] && @$_GET['filter-closed-date-from'] && @$_GET['filter-closed-date-to']){
                $closedDateFrom = $_GET['filter-closed-date-from'];
                $closedDateTo = $_GET['filter-closed-date-to'];
                $fetch_query .= " AND DATE_FORMAT(opportunities.date_modified,'%d/%m/%Y') BETWEEN '$closedDateFrom' AND '$closedDateTo' ";
            }
            if($_GET['filter'] && @$_GET['filter-created-date-from'] && @$_GET['filter-created-date-to']){
                $createdDateFrom = $_GET['filter-created-date-from'];
                $createdDateTo = $_GET['filter-created-date-to'];
                $fetch_query .= " AND DATE_FORMAT(opportunities.date_entered,'%d/%m/%Y') BETWEEN '$createdDateFrom' AND '$createdDateTo' ";
            }

            $fetch_query .= " ORDER BY `opportunities`.`date_modified` DESC";

            //echo $fetch_query; die;

            //Pagination Count
            $limit = 5;
            $paginationQuery = $GLOBALS['db']->query($fetch_query);
            $totalCount = mysqli_num_rows($paginationQuery);
            $numberOfPages = ceil( $totalCount / $limit );
            
            $offset = @$_GET['page'] ? ($_GET['page'] - 1)  * $limit : 0;

            $fetch_query .= " LIMIT $offset, $limit";

            $result = $GLOBALS['db']->query($fetch_query);
            while($row = $GLOBALS['db']->fetchByAssoc($result))
            {
                $created_by_id = $row['created_by'];
                $user_name_fetch = "SELECT * FROM users WHERE id='$created_by_id'";
                $user_name_fetch_result = $GLOBALS['db']->query($user_name_fetch);
                $user_name_fetch_row = $GLOBALS['db']->fetchByAssoc($user_name_fetch_result);
                $user_name = $user_name_fetch_row['user_name'];
                $first_name = $user_name_fetch_row['first_name'];
                $last_name = $user_name_fetch_row['last_name'];
                $full_name = "$first_name  $last_name";
                $closed_by = '';
                if (!empty(date_format(date_create($row['date_modified']),'d/m/Y'))) {
                    $modified_user_id = $row['modified_user_id'];
                    $modified_user_query = "SELECT * FROM users WHERE id='$modified_user_id'";
                    $modified_user_query_fetch = $GLOBALS['db']->query($modified_user_query);
                    $modified_user_query_fetch_row = $GLOBALS['db']->fetchByAssoc($modified_user_query_fetch);
                    $closed_by_first_name = $modified_user_query_fetch_row['first_name'];
                    $closed_by_last_name = $modified_user_query_fetch_row['last_name'];
                    $closed_by = "$closed_by_first_name $closed_by_last_name";
                    // To Do: Find actual closed by
                }
                $data .='
                <tr>
                    <td class="table-data">'.$row['name'].'</td>
                    <td class="table-data">'.$full_name.'</td>';
                if($columnAmount){
                    $data .= '<td class="table-data">'.($this->beautify_amount($row['budget_allocated_oppertunity_c'])).'</td>';
                }
                if($columnREPEOI){
                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label($row['rfporeoipublished_c'])))).'</td>';
                }
                if($columnClosedDate){
                    $data .= '<td class="table-data">'.date_format(date_create($row['date_modified']),'d/m/Y').'</td>'; 
                }
                if($columnClosedBy){
                    $data .= '<td class="table-data" >'.$closed_by.'</td>';
                }
                if($columnDateCreated){
                    $data .= '<td class="table-data">'.date_format(date_create($row['date_entered']),'d/m/Y').'</td>';
                }
                
                if($columnDateClosed){
                    if($row['date_closed']){
                        $closedDate = date_format(date_create($row['date_closed']),'d/m/Y');
                    }else{
                        $closedDate = '';
                    }
                    $data .= '<td class="table-data">'.$closedDate.'</td>';
                }
                
                if($columnTaggedMembers){
                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $this->getTaggedMembers($row['id']) )))).'</td>';
                }
                if($columnViewedBy){
                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $this->getModifiedUser($row['modified_user_id']) )))).'</td>';
                }
                if($columnPreviousResponsibility){
                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $this->getModifiedUser($row['created_by']) )))).'</td>';
                }
                if($columnAttachment){
                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $row['file_url'] ? $row['file_url'] : '' )))).'</td>';
                }
                
                $data .= '<td class="table-data">
                        <div style="display: flex; width: 80%; align-items: center; padding: 10px; justify-content: space-between; margin-left: 20px;">';
                
                $data .= '<button class="tag1" id="deselectBtn" style="margin-right: 15px;width: 18px;" onClick=getSequenceFlow("'.$row['id'].'")>';
                if($this->checkRecentActivity($row['id'])):
                    $data .= '<img id="search-icon" src="modules/Home/assets/Frame-12.svg" alt="svg" style="color: #333333;"/>';   
                endif;
                $data .= '</button>';
                
                if ($this->is_tagging_applicable($row['id'])) {
                    $data .='<button class="tag1" id="deselectBtn" onclick="fetchDeselectDialog(\''.$row['id'].'\')">
                    <i id="search-icon" class="fa fa-tag" aria-hidden="true"> </i>
                     </button>';
                }
                $data .='
                      <a href="index.php?action=DetailView&module=Opportunities&record='.$row['id'].'" class="eye" id="search-btn">
                        <i id="search-icon" class="fa fa-eye" aria-hidden="true"> </i>
                      </a>
                    </div>
                  </td>
                </tr>';
            }
            $delegated_user_name = '';
            $delegated_user_id = $this->get_delegated_user($log_in_user_id);
            if ($delegated_user_id != null) {
                $delegated_user = $this->get_user_details_by_id($delegated_user_id);
                $delegated_user_name = $delegated_user['first_name'] . $delegated_user['last_name'];
            }            

            $data .= '</tbody></table>';

            //Pagination 
            $page = @$_GET['page'] ? $_GET['page'] : 1;
            if ($totalCount > ( $page * $limit)){
                $currentPost = ($page * $limit);
            } else {
                $currentPost = $totalCount;
            }
            $data .= '<div class="pagination text-right">';
            $data .= '<p class="d-inline-block">Showing '.$currentPost.' of '.$totalCount.'</p>';

            $data .= $this->pagination($page, $numberOfPages, 'show_data_between_date', $day, $searchTerm, $_GET['filter']);
            $data .= '</div>';

            echo json_encode(array(
                'data'          => $data,
                'total'         => $total,
                'self_count'    => $self_count,
                'team_count'    => $team_count,
                'delegate'          => $this->checkDelegate(),
                'delegateDetails'   => $this->getDelegateDetails(),
                //'delegate_count' => $this->getDelegateCount(),
                'global_organization_count' => $global_organization_count,
                'non_global_organization'   =>  $non_global_organization_count,
                'fetched_by_status'         =>  $fetch_by_status
            ));
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }

    public function get_delegated_user($log_in_user_id) {
        $fetch_query = "SELECT Count(*)as count,opportunities.created_by, opportunities_cstm.delegate as delegate FROM opportunities
        LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE deleted != 1 AND opportunities_cstm.user_id2_c = '$log_in_user_id' GROUP BY opportunities_cstm.delegate ORDER BY count DESC";
        $fetch_delegated_user = $GLOBALS['db']->query($fetch_query);
        $fetch_delegated_user_result = $GLOBALS['db']->fetchByAssoc($fetch_delegated_user);
        
        if(!empty($fetch_delegated_user_result))
            $delegated_user = $fetch_delegated_user_result['delegate'];
        else
            $delegated_user = 0;
        return $delegated_user;
    }

    public function get_user_details_by_id($user_id) {
        $fetch_query = "SELECT * from users WHERE id='$user_id'";
        $fetch_user = $GLOBALS['db']->query($fetch_query);
        $fetch_user_result = $GLOBALS['db']->fetchByAssoc($fetch_user);
        $user = $fetch_user_result;
        return $user;
    }

    public function get_default_chunk($status) {
        global $current_user;
        $log_in_user_id = $current_user->id;
        $day = $_GET['days'];
        $statusVal = $status;
        $default_count = 0;
        $team_count_by_status = 0;
        $self_count_by_status = 0;
        if ($status == 'Qualified') {
            $status = 'QualifiedOpportunity';
        }
        if ($status == 'Closed' || $status == 'Dropped' || $status == 'ClosedLost') {
            $closed_lost_count_org_query = "SELECT count(*) as lost_count FROM opportunities o LEFT JOIN opportunities_cstm oc ON o.id = oc.id_c WHERE o.deleted != 1 AND o.date_entered >= now() - interval '$day' day AND oc.status_c='Closed' AND oc.closure_status_c ='lost' ";
            $closed_lost_count_org_result = $GLOBALS['db']->query($closed_lost_count_org_query);
            $closed_lost_count_org_res = $GLOBALS['db']->fetchByAssoc($closed_lost_count_org_result);
            $closed_lost_count_org = $closed_lost_count_org_res['lost_count'];
            $closed_lost_count_team_query = "SELECT count(*) as lost_count FROM opportunities o LEFT JOIN opportunities_cstm oc ON o.id = oc.id_c WHERE o.deleted != 1 AND o.date_entered >= now() - interval '$day' day AND oc.status_c='Closed' AND oc.closure_status_c ='lost' AND assigned_user_id IN (SELECT id_c FROM users_cstm WHERE teamfunction_c = (SELECT teamfunction_c FROM users_cstm WHERE id_c = '$log_in_user_id'))";
            $closed_lost_count_team_result = $GLOBALS['db']->query($closed_lost_count_team_query);
            $closed_lost_count_team_res = $GLOBALS['db']->fetchByAssoc($closed_lost_count_team_result);
            $closed_lost_count_team = $closed_lost_count_team_res['lost_count'];
            $closed_lost_count_self_query = "SELECT count(*) as lost_count FROM opportunities o LEFT JOIN opportunities_cstm oc ON o.id = oc.id_c WHERE o.deleted != 1 AND o.date_entered >= now() - interval '$day' day AND oc.status_c='Closed' AND oc.closure_status_c ='lost' AND created_by='$log_in_user_id'";
            $closed_lost_count_self_result = $GLOBALS['db']->query($closed_lost_count_self_query);
            $closed_lost_count_self_res = $GLOBALS['db']->fetchByAssoc($closed_lost_count_self_result);
            $closed_lost_count_self = $closed_lost_count_self_res['lost_count'];
            if ($status == 'Closed') {
                $status = 'Closed Won';
            }else if ($status == 'Dropped' || $status == 'ClosedLost') {
                if ($status == 'ClosedLost') {
                    $default_count = $closed_lost_count_org;
                    $team_count_by_status = $closed_lost_count_team;
                    $self_count_by_status = $closed_lost_count_self;
                }
                $statusVal = ($status == 'Dropped') ? 'Dropped' : 'ClosedLost';
                $droppedData = '<div id=\''.$statusVal.'\' class="card-status" onclick="fetchRecordByStatus_C(\'Dropped\',\''.$day.'\',null, null, 0,\''.$statusVal.'\')">
                <p class="card-status-head">
                    '.$this->split_camel_case($status).'
                </p>
                <p class="card-status-top"><span class="card-status-number">'. $default_count. '</span> <br> <span class="card-status-subtitle">Org </span> </p>
                <p class="card-status-top"><span class="card-status-number-two">'. $team_count_by_status .'</span> <br> <span class="card-status-subtitle-two">Team </span> </p>
                <p class="card-status-top"><span class="card-status-number-three">'. $self_count_by_status .' </span> <br> <span class="card-status-subtitle-three">Self </span> </p>
                        
                </div>';
                return $droppedData;
            }
        }
        $data = '<div id=\''.$statusVal.'\' class="card-status" onclick="fetchRecordByStatus_C(\''.$statusVal.'\',\''.$day.'\')">
        <p class="card-status-head">'.$this->split_camel_case($status).'</p>
        <p class="card-status-top"><span class="card-status-number">'. $default_count. '</span> <br> <span class="card-status-subtitle">Org </span> </p>
        <p class="card-status-top"><span class="card-status-number-two">'. $team_count_by_status .'</span> <br> <span class="card-status-subtitle-two">Team </span> </p>
        <p class="card-status-top"><span class="card-status-number-three">'. $self_count_by_status .' </span> <br> <span class="card-status-subtitle-three">Self </span> </p>
                
        </div>';
        return $data;
    }


    public function action_deselect_members_from_global_opportunity(){
            try {
                $db = \DBManagerFactory::getInstance();
                $GLOBALS['db'];
                $opportunity_id = $_POST['opportunityId'];
                $user_id_list = '';
                if ($_POST['userIdList']) {
                    $user_id_list = $_POST['userIdList'];
                }
                if ($this->is_global($opportunity_id)) {
                    $count_query = "SELECT * FROM tagged_user WHERE opp_id='$opportunity_id'";
                    $result = $GLOBALS['db']->query($count_query);
                    if ($result->num_rows > 0) {
                        $query = "UPDATE  tagged_user SET user_id = '$user_id_list' WHERE opp_id='$opportunity_id'";
                    } else {
                        $query = "INSERT into tagged_user(opp_id,user_id) VALUES('$opportunity_id','$user_id_list')";
                    }
                } else {
                    $count_query = "SELECT * FROM untagged_user WHERE opp_id='$opportunity_id'";
                    $result = $GLOBALS['db']->query($count_query);
                    if ($result->num_rows > 0) {
                        $query = "UPDATE  untagged_user SET user_id = '$user_id_list' WHERE opp_id='$opportunity_id'";
                    } else {
                        $query = "INSERT into untagged_user(opp_id,user_id) VALUES('$opportunity_id','$user_id_list')";
                    }
                }
                if($db->query($query)==TRUE){
                    echo $query;
                }else{
                    echo "Refresh and add Segment again";
                }
            } catch (Exception $e) {
                echo json_encode(array("status" => false, "message" => "Some error occured"));
            }
        die();
    }

    public function is_global($op_id) {
        $query = "SELECT count(opportunity_type) as cnt from opportunities where id = '$op_id' AND opportunity_type='global' AND deleted != 1";
        $fetch_query = $GLOBALS['db']->query($query);
        $result = $GLOBALS['db']->fetchByAssoc($fetch_query);
        return $result['cnt'] == '1' ? true : false;
    }



    public function action_opportunity_dialog_info()
    {
        try {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            $opportunity_id = $_GET['id'];
            $fetch_opportunity_info = "SELECT * FROM opportunities
            LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE id = '$opportunity_id'";
            $fetch_opportunity_info_result = $GLOBALS['db']->query($fetch_opportunity_info);
            $row = $GLOBALS['db']->fetchByAssoc($fetch_opportunity_info_result);
            $created_by_id = $row['created_by'];
            $user_name_fetch = "SELECT * FROM users WHERE id='$created_by_id'";
            $user_name_fetch_result = $GLOBALS['db']->query($user_name_fetch);
            $user_name_fetch_row = $GLOBALS['db']->fetchByAssoc($user_name_fetch_result);
            $user_name = $user_name_fetch_row['user_name'];
            $first_name = $user_name_fetch_row['first_name'];
            $last_name = $user_name_fetch_row['last_name'];
            $full_name = "$first_name  $last_name";

            if($row['opportunity_type'] == 'global'){
                $sub_head = 'Selected members will be able to view details or take action';
                $change_font = 'Select Members';
            }else{
                $sub_head = "Deselected members won't be able to view details or take action";
                $change_font = 'Deselect Members';
            }

            $data = '
                <h2 class="deselectheading">' . $row['name'] . '</h2><br>
                <p class="deselectsubhead">'.$sub_head.'</p>
                <hr class="deselectsolid">
                <section class="deselectsection">
                <table align="centered" width="100%">
                    <thead>
                    <tr class="tabname">
                        <th>Primary Responsibility</th>
                        <th>Amount (in Cr)</th>
                        <th>RFP/EOI Published</th>
                        <th>Modified Date</th>
                        <th>Modified By</th>
                        <th>Date Created</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr class="tabvalue">
                        <td>' . $full_name . '</td>
                        <td>' . $this->beautify_amount($row["budget_allocated_oppertunity_c"]) . '</td>
                        <td>' . $this->beautify_label($row["rfporeoipublished_c"]) . '</td>
                        <td>' . date_format(date_create($row['date_modified']), 'd/m/Y') . '</td>
                        <td>' . $this->get_closed_by($row) . '</td>
                        <td>'  . date_format(date_create($row['date_entered']), 'd/m/Y') . '</td>
                        </tr>';
                    $data .= '</tbody></table>
                    <hr class="deselectsolid">
                            <label for="Deselect-Members">'.$change_font.'</label><br>';
          $msuname = $this->get_initial_multi_selected_dropdown_value($opportunity_id, $this->is_global($opportunity_id), false);
          $msuid = $this->get_initial_multi_selected_dropdown_value($opportunity_id, $this->is_global($opportunity_id), true);
          echo json_encode(array('opportunity_info'=>$data,'msuname'=>$msuname,'msuid'=> $msuid, 'opportunity_id'=>$opportunity_id));
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }

    public function get_initial_multi_selected_dropdown_value($opportunity_id, $is_global, $useridreq) {
        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        if ($is_global == true) {
            $query = "SELECT user_id FROM tagged_user WHERE opp_id = '$opportunity_id'";
        } else {
            $query = "SELECT user_id FROM untagged_user WHERE opp_id = '$opportunity_id'";
        }
        $result = $GLOBALS['db']->query($query);
        $result_row = $GLOBALS['db']->fetchByAssoc($result);
        if ($useridreq) {
            $str1 = $this->multi_id_select_name_map($result_row['user_id']);
            $res = $result_row['user_id'];
            return $str1;
        } else {
            $str1 = $this->multi_id_name_map($result_row['user_id']);
            return $str1;
        }
    }
    public function multi_id_select_name_map($ids) {
        $arr = explode(',', $ids);
        for ($x = 0; $x < count($arr); $x++) {
            $temp = $this->multi_id_name_map_helper($arr[$x]);
            $temp = trim($temp," ");
            $arr[$x] = "$arr[$x]---$temp";
        }
        $str = join(',', $arr);
        return $str;
    }

    public function multi_id_name_map($ids) {
        $arr = explode(',', $ids);
        for ($x = 0; $x < count($arr); $x++) {
            $arr[$x] = $this-> multi_id_name_map_helper($arr[$x]);
        }
        $str = join(',', $arr);
        return $str;
    }
    public function multi_id_name_map_helper($v) {
        $query = "SELECT first_name,last_name FROM users WHERE id = '$v'";
        $result = $GLOBALS['db']->query($query);
        $result_row = $GLOBALS['db']->fetchByAssoc($result);
        $first_name = $result_row['first_name'];
        $last_name = $result_row['last_name'];
        $full_name = "$first_name $last_name";
        return $full_name;
    }
    public function action_delegated_dialog_info()
    {
        try {
            $db = \DBManagerFactory::getInstance();
            global $current_user;
            $log_in_user_id = $current_user->id;
            $GLOBALS['db'];

            $delegated_user_id = $this->get_delegated_user($log_in_user_id);
            if ($delegated_user_id) {
                $delegated_user = $this->get_user_details_by_id($delegated_user_id);
            }
            
            if (!empty(@$delegated_user) && @$delegated_user['first_name'] || @$delegated_user['last_name']) {
                $delegated_user_name = $delegated_user['first_name'] . $delegated_user['last_name'];
            }
            $data = '';
            if(@$delegated_user_name):
            $data = ' <table class="delegatetable">
                        <thead>
                            <tr class="delegatetable-header-row-popup">
                                <th class="delegatetable-header-popup">Current Delegate</th>
                                <th class="delegatetable-header-popup">Action Completed</th>
                                <th class="delegatetable-header-popup">Permissions</th>
                                <th></th>
                            </tr></thead>';
            // $fetch_delegated_info = "SELECT * FROM opportunities
            // LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE id = '$log_in_user_id'";
            // $fetch_delegated_info_result = $GLOBALS['db']->query($fetch_delegated_info);
            // $row = $GLOBALS['db']->fetchByAssoc($fetch_delegated_info_result);
            // $created_by_id = $row['created_by'];
            // $user_name_fetch = "SELECT * FROM users WHERE id='$created_by_id'";
            // $user_name_fetch_result = $GLOBALS['db']->query($user_name_fetch);
            // $user_name_fetch_row = $GLOBALS['db']->fetchByAssoc($user_name_fetch_result);
            // $user_name = $user_name_fetch_row['user_name'];
            $data .= '
                <tbody>
                <tr>
                <td class="delegatetable-data-popup">'.$delegated_user_name.'</td>
                <td class="delegatetable-data-popup" style="color: #00f;">'.$this->delegateActionCompleted($delegated_user_id).'</td>
                <td class="delegatetable-data-popup">Edit</td>
                <td>
                    <button type="button" style="margin-left: 100px; margin-bottom: 10px; margin-top: 20px;" class="btn2 remove-delegate">Remove</button>
                </td>
            </tr>';
            $data .= '</tbody></table>';
            endif; 
        
        
            echo json_encode(array('delegated_info' => $data, 'delegated_id' => $log_in_user_id));
        } catch (Exception $e) {
            echo json_encode(array("status" => false, "message" => "Some error occured"));
        }
        die();
    }

    function delegateActionCompleted($userID){
        global $current_user;
        $log_in_user_id = $current_user->id;
        $query = "SELECT count(*) as count FROM approval_table ap";
        $query .= " JOIN opportunities o ON o.id = ap.opp_id";
        $query .= " WHERE ap.pending = 0 AND o.deleted != 1 AND ap.approver_rejector = '$log_in_user_id' AND ap.delegate_id = '$userID' AND ( delegate_date_time != '' OR delegate_date_time <> NULL) ";

        // echo $query; die;

        $result = $GLOBALS['db']->query($query);
        $count = $GLOBALS['db']->fetchByAssoc($result);
        return $count['count'];
    }


    public function action_filter_for_opportunity_list(){
        try
        {
            global $current_user;
            $log_in_user_id = $current_user->id;
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }



    public function action_store_delegate_result(){
        try{
            $db = \DBManagerFactory::getInstance();
            global $current_user;
            $log_in_user_id = $current_user->id;
            $GLOBALS['db'];
            $proxy = $_POST['Select_Proxy'];
            // $permission_to_edit = $_POST['delegate_Edit'];
            $save_delegate_query = "UPDATE opportunities_cstm as o2 
                LEFT JOIN opportunities ON opportunities.id = o2.id_c
                SET o2.delegate = '$proxy'
                WHERE opportunities.deleted != 1 AND o2.user_id2_c = '$log_in_user_id'";
            
            $save_delegate_query_result = $GLOBALS['db']->query($save_delegate_query);

            $approvalDelegateUpdate = "UPDATE approval_table SET delegate_id = '$proxy' WHERE approver_rejector = '$log_in_user_id' AND Approved = 0 AND Rejected = 0 AND pending = 1";
            $approvalDelegateUpdateQuery = $GLOBALS['db']->query($approvalDelegateUpdate);

            //$fetch_organization_count = $GLOBALS['db']->fetchByAssoc($save_delegate_query_result);
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }

    }

    public function action_remove_delegate_user(){
        try{
            $db = \DBManagerFactory::getInstance();
            global $current_user;
            $log_in_user_id = $current_user->id;
            $GLOBALS['db'];
            $save_delegate_query = "UPDATE opportunities_cstm as o2 
                LEFT JOIN opportunities ON opportunities.id = o2.id_c
                SET o2.delegate = ''
                WHERE opportunities.deleted != 1 AND o2.user_id2_c = '$log_in_user_id'";
            
            $save_delegate_query_result = $GLOBALS['db']->query($save_delegate_query);

            $save_delegate_query = "UPDATE approval_table  
                SET delegate_id = ''
                WHERE approver_rejector = '$log_in_user_id'";
            
            $save_delegate_query_result = $GLOBALS['db']->query($save_delegate_query);

        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
    }

    public function beautify_label($string) {
        return ucwords(str_replace('_', ' ', $string));
    }

    public function beautify_amount($amount) {
        return preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $amount);
    }

    public function split_camel_case($label) {
        if($label == 'QualifiedDpr') {
            return 'Qualified DPR';
        }
        $array = preg_split('/(?=[A-Z])/',$label);
        return implode(' ', $array);
    }


    public function action_custom_filters(){
        try{
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];


            if($_POST['required_field'] == 'yes'){
               $required_field = 'yes'; 
            }else if($_POST['required_field'] == 'No'){
                $required_field = 'no';
            }else{
                $required_field = null;
            }
            $lowerVal = $_POST['lowerVal'];
            $upperVal = $_POST['upperVal'];
            $date_from = $_POST['date_from'];
            $date_to = $_POST['date_to'];
            $closed_date_from = $_POST['closed_date_from'];
            $closed_date_to = $_POST['closed_date_to'];
             
            $responsibility = $_POST['responsibility'];

            $day = $_POST['day'];

            $todayDate = date("Y/m/d");
            $intervalDate = date('y-m-d', strtotime( $day." ".'days'));

            
            $organiztion_global_count = "SELECT count(*) as org_global_count FROM opportunities WHERE opportunity_type = 'global' AND deleted != 1 AND date_entered >= now() - interval '$day' day";
            $organiztion_count_result = $GLOBALS['db']->query($organiztion_global_count);
            $fetch_organization_count = $GLOBALS['db']->fetchByAssoc($organiztion_count_result);
            $global_organization_count = $fetch_organization_count['org_global_count'];

            $non_global_organization_count = $this->get_non_global_op_count($day);
            $data = '<table class="bottomtable" style="font-family: Lato, Lato, Arial, sans-serif !important;
            height: 400px;
            overflow-y: auto;
            overflow-x: hidden;
            display: -webkit-box;
            width: 100%;
            flex-direction: column;">
            <tbody style="display: table; width: 100%;">
            <ul class="table-ul" style="display: flex;
            align-items: center;height: 50px">

                <li class="tableHeader-Content">
                    <div id="global-opportunities" class="global-opportunities" onclick="filter_by_type(\'global\','.$day.')">Global Opportunities ('.$global_organization_count.') </div>
                </li>


                <li class="tableHeader-Content">
                    <div id="non-global-opportunities" class="non-global-opportunities" onclick="filter_by_type(\'non_global\','.$day.')">Non-Global Opportunities ('.$non_global_organization_count.') </div>
                </li>


                <li class="search-box-block">
                    <div class="search-box">
                        <!-- ----------- -->
                        <div style="display: flex;">
                            <div style="display: flex; justify-content: center; align-items: center;">
                                <input type="search" placeholder="Search by name" class="opportunity-search" name="search" />
                                <button class="searchhh" id="search-btn">
                                    <i id="search-icon" class="fa fa-search" aria-hidden="true"> </i>
                                </button>
                            </div>
                            <div style="display: flex; margin-left: auto;">
                                <button class="filter" id="filter_myBtn" onclick="openFilterDialog()" style="padding:10; border: none !important;">
                                    <i class="fa fa-filter" aria-hidden="true"> </i>
                                </button>
                               
                                <button class="cog" id="setting_myBtn" onclick="openSettingDialog(\'opportunities\')" style="padding:10; border: none !important;">
                                    <i id="setting_myBtn" class="fa fa-list" aria-hidden="true"> </i>
                                </button>
                            </div>
                        </div>
                    </div>

                </li>

            </ul>
            <tr class="table-header-row">
            <th class="table-header">Name</th>
            <th class="table-header">Primary Responsibility</th>
            <th class="table-header">Amount ( in Cr )</th>
            <th class="table-header">RFP/EOI Published</th>
            <th class="table-header">Modified Date</th>
            <th class="table-header">Modified By</th>
            <th class="table-header">Created Date</th>
            <th class="table-header">Action</th>
        </tr>';


            if(!empty($required_field) || !empty($lowerVal) || !empty($upperVal) || !empty($responsibility) || !empty($today) || !empty($closed_date_from) || !empty($closed_date_to)){
                $custom_filter_query = "SELECT * FROM opportunities LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE deleted != 1 AND date_entered >= now() - interval '$day' day AND date_entered >= now() - interval '$day' day AND ";
                if (!empty($required_field)) {
                    $custom_filter_query .= "rfporeoipublished_c = '$required_field'";
                }
                if (!empty($responsibility)) {
                    $custom_filter_query .= " AND created_by = '$responsibility'";
                }
                if (!(($lowerVal == 0) && ($upperVal == 0))) {
                    $custom_filter_query .= "AND amount BETWEEN '$upperVal' AND '$lowerVal'";
                }
                if (!empty($closed_date_from) && !empty($closed_date_to)) {
                    $custom_filter_query .= " AND date_closed BETWEEN '$closed_date_from' AND '$closed_date_to'";
                }
                if (!empty($date_from) && !empty($date_to)) {
                    $custom_filter_query .= " AND date_entered BETWEEN '$date_from' AND '$date_to'";
                }
                $custom_filter_query .= " ORDER BY `opportunities`.`date_modified` DESC";
                // echo $custom_filter_query;
                $custom_filter_query_result = $GLOBALS['db']->query($custom_filter_query);
                while($row = $GLOBALS['db']->fetchByAssoc($custom_filter_query_result))
                {
                    $created_by_id = $row['created_by'];
                    $user_name_fetch = "SELECT * FROM users WHERE id='$created_by_id'";
                    $user_name_fetch_result = $GLOBALS['db']->query($user_name_fetch);
                    $user_name_fetch_row = $GLOBALS['db']->fetchByAssoc($user_name_fetch_result);
                    $user_name = $user_name_fetch_row['user_name'];
                    $first_name = $user_name_fetch_row['first_name'];
                    $last_name = $user_name_fetch_row['last_name'];
                    $full_name = "$first_name  $last_name";
                    $closed_by = '';
                    if (!empty($row['date_modified'])) {
                        $modified_user_id = $row['modified_user_id'];
                        $modified_user_query = "SELECT * FROM users WHERE id='$modified_user_id'";
                        $modified_user_query_fetch = $GLOBALS['db']->query($modified_user_query);
                        $modified_user_query_fetch_row = $GLOBALS['db']->fetchByAssoc($modified_user_query_fetch);
                        $closed_by_first_name = $modified_user_query_fetch_row['first_name'];
                        $closed_by_last_name = $modified_user_query_fetch_row['last_name'];
                        $closed_by = "$closed_by_first_name $closed_by_last_name";
                    }
                    $data .='
                    <tr>
                    <td class="table-data">'.$row['name'].'</td>
                    <td class="table-data">'.$full_name.'</td>
                    <td class="table-data">'.($this->beautify_amount(($this->beautify_amount($row['budget_allocated_oppertunity_c'])))).'</td>
                    <td class="table-data">'.($this->beautify_label($row['rfporeoipublished_c'])).'</td>
                    <td class="table-data">'.date_format(date_create($row['date_modified']),'d/m/Y').'</td>
                    <td class="table-data">'.$closed_by.'</td>
                    <td class="table-data">'.date_format(date_create($row['date_entered']),'d/m/Y').'</td>
                    <td class="table-data">
                    <div style="display: flex; width: 80%; align-items: center; padding: 10px; justify-content: space-between; margin-left: 20px; margin-left: 20px;">';
                    
                    if ($this->is_tagging_applicable($row['id'])) {
                        $data .='<button class="tag1" id="deselectBtn" onclick="fetchDeselectDialog(\''.$row['id'].'\')">
                                        <i id="search-icon" class="fa fa-tag" aria-hidden="true"> </i>
                                </button>';
                    }
                    $data .='
                      <a href="index.php?action=DetailView&module=Opportunities&record='.$row['id'].'" class="eye" id="search-btn">
                        <i id="search-icon" class="fa fa-eye" aria-hidden="true"> </i>
                      </a>
                    </div>
                  </td>
                </tr>';
                }
    
                $data .= '</tbody></table>';
                echo $data;
            }
           



        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
    }



    public function action_filter_by_column(){
        try
        {
            global $current_user;
            $todayDate = date("Y/m/d");
            $intervalDate = date('y-m-d', strtotime( -$todayDate." ".'days'));
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];


            $name = $_POST['name'];
            $primary_responsbility_select = $_POST['primary_responsbility_select'];
            $ammount_select = $_POST['ammount_select'];
            $REP_EOI_Published_select = $_POST['REP_EOI_Published_select'];
            $closed_date_select = $_POST['closed_date_select'];
            $closed_by_select = $_POST['closed_by_select'];
            $date_created_select = $_POST['date_created_select'];
            $tagged_members_select = $_POST['tagged_members_select'];
            $team_members_select = $_POST['team_members_select'];
            $viewed_by_select = $_POST['viewed_by_select'];
            $previous_responsbility_select = $_POST['previous_responsbility_select'];
            $members_select = $_POST['members_select'];
            $date_of_creation_select = $_POST['date_of_creation_select'];
            $activities_select = $_POST['activities_select'];
            $attachment_select = $_POST['attachment_select'];


            if(!empty($name)){
                $custom_column = array_push($custom_column,$name);
            }
            if(!empty($primary_responsbility_select)){
                $custom_column = array_push($custom_column,$primary_responsbility_select);
            }
            if(!empty($ammount_select)){
                $custom_column = array_push($custom_column,$ammount_select);
            }
            if(!empty($REP_EOI_Published_select)){
                $custom_column = array_push($custom_column,$REP_EOI_Published_select);
            }
            if(!empty($closed_date_select)){
                $custom_column = array_push($custom_column,$closed_date_select);
            }
            if(!empty($closed_by_select)){
                $custom_column = array_push($custom_column,$closed_by_select);
            }
            if(!empty($date_created_select)){
                $custom_column = array_push($custom_column,$date_created_select);
            }
            if(!empty($tagged_members_select)){
                $custom_column = array_push($custom_column,$tagged_members_select);
            }
            if(!empty($team_members_select)){
                $custom_column = array_push($custom_column,$team_members_select);
            }
            if(!empty($viewed_by_select)){
                $custom_column = array_push($custom_column,$viewed_by_select);
            }
            if(!empty($previous_responsbility_select)){
                $custom_column = array_push($custom_column,$previous_responsbility_select);
            }
            if(!empty($members_select)){
                $custom_column = array_push($custom_column,$members_select);
            }
            if(!empty($date_of_creation_select)){
                $custom_column = array_push($custom_column,$date_of_creation_select);
            }
            if(!empty($activities_select)){
                $custom_column = array_push($custom_column,$activities_select);
            }
            if(!empty($attachment_select)){
                $custom_column = array_push($custom_column,$attachment_select);
            }



            $organiztion_global_count = "SELECT count(*) as org_global_count FROM opportunities WHERE opportunity_type = 'global' AND deleted != 1 AND date_entered >= now() - interval '1200' day";
            $organiztion_count_result = $GLOBALS['db']->query($organiztion_global_count);
            $fetch_organization_count = $GLOBALS['db']->fetchByAssoc($organiztion_count_result);
            $global_organization_count = $fetch_organization_count['org_global_count'];

            $non_global_organization_count = $this->get_non_global_op_count('1200');
            $data = '<table class="bottomtable" style="font-family: Lato, Lato, Arial, sans-serif !important;
            height: 400px;
            overflow-y: auto;
            overflow-x: hidden;
            display: -webkit-box;
            width: 100%;
            flex-direction: column;">
            <tbody style="display: table; width: 100%;">
            <ul class="table-ul" style="display: flex;
            align-items: center;height: 50px">

                <li class="tableHeader-Content">
                    <div id="global-opportunities" class="global-opportunities" onclick="filter_by_type(\'global\','.$todayDate.')">Global Opportunities ('.$global_organization_count.') </div>
                </li>


                <li class="tableHeader-Content">
                    <div id="non-global-opportunities" class="non-global-opportunities" onclick="filter_by_type(\'non_global\','.$todayDate.')">Non-Global Opportunities ('.$non_global_organization_count.') </div>
                </li>


                <li class="search-box-block">
                    <div class="search-box">
                        <!-- ----------- -->
                        <div style="display: flex;">
                            <div style="display: flex; justify-content: center; align-items: center;">
                                <input type="search" placeholder="Search by name" class="opportunity-search" name="search" />
                                <button class="searchhh" id="search-btn">
                                    <i id="search-icon" class="fa fa-search" aria-hidden="true"> </i>
                                </button>
                            </div>
                            <div style="display: flex; margin-left: auto;">
                                <button class="filter" id="filter_myBtn" onclick="openFilterDialog()" style="padding:10; border: none !important;">
                                    <i class="fa fa-filter" aria-hidden="true"> </i>
                                </button>
                               
                                <button class="cog" id="setting_myBtn" onclick="openSettingDialog(\'opportunities\')" style="padding:10; border: none !important;">
                                    <i id="setting_myBtn" class="fa fa-list" aria-hidden="true"> </i>
                                </button>
                            </div>
                        </div>
                    </div>

                </li>

            </ul>
            <tr class="table-header-row">
        </tr>';
            $column_name = join(', ', $custom_column);
            $fetch_query = "SELECT '.$column_name.' from opportunities";
            $result = $GLOBALS['db']->query($fetch_query);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {

                }
            } else {
                echo "0 results";
            }

        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }
    
    public function action_filter_by_opportunity_status(){
        try
        {
            
            global $current_user;
            $log_in_user_id = $current_user->id;
            
            $status = $_GET['status'];

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $qlLeadCount = $this->getOpportunityStatusCount('qualifylead');
            $qlOppCount = $this->getOpportunityStatusCount('qualifyOpportunity');
            $qlDPRCount = $this->getOpportunityStatusCount('qualifyDpr');
            $qlBidCount = $this->getOpportunityStatusCount('qualifyBid');
            $qlClosedCount = $this->getOpportunityStatusCount('closure');
            $qlDroppedCount = $this->getOpportunityStatusCount('Dropping');

            $columnFilter = @$_GET;
            $columnAmount = @$columnFilter['Amount'];
            $columnREPEOI = @$columnFilter['REP-EOI-Published'];
            //$columnStatus = @$columnFilter['status'];
            $columnClosedDate = @$columnFilter['Closed-Date'];
            $columnClosedBy = @$columnFilter['Closed-by'];
            $columnDateCreated = @$columnFilter['Date-Created'];
            $columnDateClosed = @$columnFilter['Date-Closed'];

            $columnTaggedMembers = @$columnFilter['Tagged-Members'];
            $columnViewedBy = @$columnFilter['Viewed-by'];
            $columnPreviousResponsibility = @$columnFilter['Previous-Responsbility'];
            $columnAttachment = @$columnFilter['Attachment'];


            $data = '<table class="pending-request-table" style="font-family: Lato, Lato, Arial, sans-serif !important;
                    max-height: 275px;
                    overflow-y: auto;
                    overflow-x: hidden;
                    display: -webkit-box;
                    width: 100%;
                    flex-direction: column;"
                > 
                <tbody style="display: table; width: 100%;">
                    <ul class="table-ul" style="display: flex; align-items: center;height: 50px;justify-content: space-between;">

                        <div class="option_tabs_container">
                            <li class="tableHeader-Content option_tab_header_btn" id="qualifylead" for="option_one">
                                <div class="prt-top-headings" onClick="fetchByStatus(\'qualifylead\')">Qualify Lead ('.$qlLeadCount.') </div>
                            </li>


                            <li class="option_tab_header_btn" id="qualifyOpportunity" for="option_two">
                                <div class="prt-top-headings" onClick="fetchByStatus(\'qualifyOpportunity\')">Qualify Opportunity ('.$qlOppCount.') </div>
                            </li>
                            <li class="tableHeader-Content option_tab_header_btn" id="qualifyDpr" for="option_three">
                                <div class="prt-top-headings" onClick="fetchByStatus(\'qualifyDpr\')">Qualify DPR ('.$qlDPRCount.') </div>
                            </li>


                            <li class="tableHeader-Content option_tab_header_btn" id="qualifyBid" for="option_four">
                                <div class="prt-top-headings" onClick="fetchByStatus(\'qualifyBid\')">Qualify Bid ('.$qlBidCount.') </div>
                            </li>
                            <li class="tableHeader-Content option_tab_header_btn" id="closure" for="option_five">
                                <div class="prt-top-headings" onClick="fetchByStatus(\'closure\')">Close ('.$qlClosedCount.') </div>
                            </li>


                            <li class="tableHeader-Content option_tab_header_btn" id="Dropping" for="option_six">
                                <div class="prt-top-headings" onClick="fetchByStatus(\'Dropping\')">Drop ('.$qlDroppedCount.') </div>
                            </li>
                        </div>

                        <div>
                            <li class="search-box-block">
                                <div class="search-box">
                                    <div style="display: flex;">
                                        <div style="display: flex; margin-left: auto;">
                                            <button class="filter" id="filter_myBtn" onclick="openPendingFilterDialog()" style="padding:10; border: none !important;">
                                                <i class="fa fa-filter" aria-hidden="true"> </i>
                                            </button>

                                            <button class="cog" id="setting_myBtn" onclick=openSettingDialog("pendings","action_filter_by_opportunity_status","'.$status.'") style="padding:10; border: none !important;">
                                                <i id="setting_myBtn" class="fa fa-list" aria-hidden="true"> </i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </li>
                        </div>

                    </ul>
                    <tr class="table-header-row">
                        <th class="table-header">Name</th>
                        <th class="table-header">Primary Responsibility</th>';
                        $data .= '<th class="table-header" style="text-align: center">Status</th>';
                        if($columnAmount){
                            $data .= '<th class="table-header">Amount ( in Cr )</th>';
                        }
                        if($columnREPEOI){
                            $data .= '<th class="table-header">RFP/EOI Published</th>';
                        }
                        
                        if($columnClosedDate){
                            $data .= '<th class="table-header">Modified Date</th>';
                        }
                        if($columnClosedBy){
                            $data .= '<th class="table-header">Modified By</th>';
                        }
                        if($columnDateCreated){
                            $data .= '<th class="table-header">Created Date</th>';
                        }
                        if($columnDateClosed){
                            $data .= '<th class="table-header">Closed Date</th>';
                        }
                        if($columnTaggedMembers){
                            $data .= '<th class="table-header">Tagged Members</th>';
                        }
                        if($columnViewedBy){
                            $data .= '<th class="table-header">Viewed By</th>';
                        }
                        if($columnPreviousResponsibility){
                            $data .= '<th class="table-header">Previous Responsibility</th>';
                        }
                        if($columnAttachment){
                            $data .= '<th class="table-header">Attachment</th>';
                        }
                    $data .= '<th class="table-header">Action</th></tr>';
                
            /* $fetch_query = "SELECT o.*, oc.* FROM opportunities AS o LEFT JOIN opportunities_cstm oc ON o.id = oc.id_c JOIN (
                    SELECT *, count(opp_id) as opp_count  FROM approval_table GROUP BY opp_id ORDER BY id DESC
                ) AS ap ON o.id = ap.opp_id AND ap.opp_count = 1
                WHERE oc.user_id2_c = '$log_in_user_id' AND ap.apply_for = '".$status."' AND ap.Approved = 0 AND ap.pending = 1 AND o.deleted != 1 AND date_entered >= now() - interval '$day' day";*/
            
            /*$fetch_query = " SELECT o.*, oc.* FROM opportunities AS o JOIN opportunities_cstm oc ON o.id = oc.id_c
                WHERE ( oc.user_id2_c = '$log_in_user_id' OR oc.delegate = '$log_in_user_id' ) AND o.deleted != 1 AND date_entered >= now() - interval '$day' day ";*/
            
            $maxQuery = "SELECT row_count FROM approval_table WHERE ap.Approved = 0 AND ap.Rejected = 0 AND ap.pending = 1 AND ( ap.approver_rejector = '$log_in_user_id' OR ap.delegate_id = '$log_in_user_id' ) AND ap.apply_for = '$status' ORDER BY row_count DESC LIMIT 1";
            $result = $GLOBALS['db']->query($maxQuery);
            $rowCount = $GLOBALS['db']->fetchByAssoc($result);
            if($rowCount)
                $rowCount = $rowCount['row_count'];

            $fetch_query = "SELECT ap.id as approval_id, o.*, oc.* FROM approval_table ap";
            $fetch_query .= " JOIN opportunities o ON o.id = ap.opp_id";
            $fetch_query .= " JOIN opportunities_cstm oc ON oc.id_c = ap.opp_id";
            $fetch_query .= " WHERE ap.Approved = 0 AND ap.Rejected = 0 AND ap.pending = 1 AND o.deleted != 1 AND o.date_entered >= now() - interval '1200' day AND ( ap.approver_rejector = '$log_in_user_id' OR ap.delegate_id = '$log_in_user_id' ) AND ap.apply_for = '$status'";
            if($rowCount)
                $fetch_query .= " AND ap.row_count = '$rowCount'";
            
            if($_GET['filter'] && @$_GET['filter-responsibility']){
                $responsibility = $_GET['filter-responsibility'];
                $fetch_query .= " AND o.created_by = '$responsibility' ";
            }
            if($_GET['filter'] && @$_GET['filter-rfp-eoi-status']){
                $rpfEOIStatus = $_GET['filter-rfp-eoi-status'];
                $fetch_query .= " AND oc.rfporeoipublished_c = '$rpfEOIStatus' ";
            }
            if($_GET['filter'] && @$_GET['filter-min-price'] && @$_GET['filter-max-price']){
                $minPrice = $_GET['filter-min-price'];
                $maxPrice = $_GET['filter-max-price'];
                $fetch_query .= " AND oc.budget_allocated_oppertunity_c BETWEEN '$minPrice' AND '$maxPrice' ";
            }
            if($_GET['filter'] && @$_GET['filter-closed-date-from'] && @$_GET['filter-closed-date-to']){
                $closedDateFrom = $_GET['filter-closed-date-from'];
                $closedDateTo = $_GET['filter-closed-date-to'];
                $fetch_query .= " AND DATE_FORMAT(o.date_modified, '%d/%m/%Y') BETWEEN '$closedDateFrom' AND '$closedDateTo' ";
            }
            if($_GET['filter'] && @$_GET['filter-created-date-from'] && @$_GET['filter-created-date-to']){
                $createdDateFrom = $_GET['filter-created-date-from'];
                $createdDateTo = $_GET['filter-created-date-to'];
                $fetch_query .= " AND DATE_FORMAT(o.date_entered, '%d/%m/%Y') BETWEEN '$createdDateFrom' AND '$createdDateTo' ";
            }

            $fetch_query .= "  ORDER BY `o`.`date_modified` DESC";

            // echo $fetch_query;

            //Pagination Count
            $limit = 5;
            $paginationQuery = $GLOBALS['db']->query($fetch_query);
            $totalCount = mysqli_num_rows($paginationQuery);
            $numberOfPages = ceil( $totalCount / $limit );
            
            $offset = @$_GET['page'] ? ($_GET['page'] - 1)  * $limit : 0;

            $fetch_query .= " LIMIT $offset, $limit";


            $result = $GLOBALS['db']->query($fetch_query);
            while($row = $GLOBALS['db']->fetchByAssoc($result))
            {
                $created_by_id = $row['created_by'];
                $user_name_fetch = "SELECT * FROM users WHERE id='$created_by_id'";
                $user_name_fetch_result = $GLOBALS['db']->query($user_name_fetch);
                $user_name_fetch_row = $GLOBALS['db']->fetchByAssoc($user_name_fetch_result);

                $user_name = $user_name_fetch_row['user_name'];
                $first_name = $user_name_fetch_row['first_name'];
                $last_name = $user_name_fetch_row['last_name'];
                $full_name = "$first_name  $last_name";

                $id = $row['id'];
                $closed_by = '';
                if (!empty($row['date_modified'])) {
                    $modified_user_id = $row['modified_user_id'];
                    $modified_user_query = "SELECT * FROM users WHERE id='$modified_user_id'";
                    $modified_user_query_fetch = $GLOBALS['db']->query($modified_user_query);
                    $modified_user_query_fetch_row = $GLOBALS['db']->fetchByAssoc($modified_user_query_fetch);
                    $closed_by_first_name = $modified_user_query_fetch_row['first_name'];
                    $closed_by_last_name = $modified_user_query_fetch_row['last_name'];
                    $closed_by = "$closed_by_first_name $closed_by_last_name";
                    // To Do: Find actual closed by
                }

                /*$oppID = $row['id'];
                $query2 = "SELECT id, Approved, pending FROM approval_table WHERE opp_id = '$oppID' AND apply_for = '$status' ORDER BY id DESC LIMIT 1";
                $result2 = $GLOBALS['db']->query($query2);
                while($row2 = $GLOBALS['db']->fetchByAssoc($result2)){
                    if($row2['Approved'] == 0 && $row2['pending'] == 1){*/

                        $data .='
                            <tr>
                                <td class="table-data">'.$row['name'].'</td>
                                <td class="table-data">'.$full_name.'</td>
                                
                                <td class="table-data" style="text-align: center">'.$this->pendingApprovalStatus($row['id'], $status).'</td>';

                                if($columnAmount){
                                    $data .= '<td class="table-data">'.($this->beautify_amount($row['budget_allocated_oppertunity_c'])).'</td>';
                                }
                                if($columnREPEOI){
                                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label($row['rfporeoipublished_c'])))).'</td>';
                                }
                                if($columnClosedDate){
                                    $data .= '<td class="table-data">'.date_format(date_create($row['date_modified']),'d/m/Y').'</td>'; 
                                }
                                if($columnClosedBy){
                                    $data .= '<td class="table-data" >'.$closed_by.'</td>';
                                }
                                if($columnDateCreated){
                                    $data .= '<td class="table-data">'.date_format(date_create($row['date_entered']),'d/m/Y').'</td>';
                                }
                                
                                if($columnDateClosed){
                                    if($row['date_closed']){
                                        $closedDate = date_format(date_create($row['date_closed']),'d/m/Y');
                                    }else{
                                        $closedDate = '';
                                    }
                                    $data .= '<td class="table-data">'.$closedDate.'</td>';
                                }

                                if($columnTaggedMembers){
                                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $this->getTaggedMembers($row['id']) )))).'</td>';
                                }
                                if($columnViewedBy){
                                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $this->getModifiedUser($row['modified_user_id']) )))).'</td>';
                                }
                                if($columnPreviousResponsibility){
                                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $this->getModifiedUser($row['created_by']) )))).'</td>';
                                }
                                if($columnAttachment){
                                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $row['file_url'] ? $row['file_url'] : '' )))).'</td>';
                                }
                            
                        $data .= '<td class="table-data">
                            <div style="font-size: 20px;">
                                <i class="fa fa-check-circle" onClick=openApprovalDialog("Approve","'.$row['status_c'].'","'.addslashes($row['approval_id']).'");></i>
                                <i class="fa fa-times-circle" onClick=openApprovalDialog("Reject","'.$row['status_c'].'","'.addslashes($row['approval_id']).'");></i>
                                <i class="fa fa-info-circle" onClick="location.href=\'index.php?action=DetailView&module=Opportunities&record='.$row['id'].'\'"></i>
                            </div>
                            </td>
                        </tr>';
                    /*}
                }*/    
            }
            $data .= '
                </tbody>
            </table>';

            //Pagination 
            $page = @$_GET['page'] ? $_GET['page'] : 1;
            if ($totalCount > ( $page * $limit)){
                $currentPost = ($page * $limit);
            } else {
                $currentPost = $totalCount;
            }
            $data .= '<div class="pagination text-right">';
            $data .= '<p class="d-inline-block">Showing '.$currentPost.' of '.$totalCount.'</p>';

            $data .= $this->pagination($page, $numberOfPages, 'filter_by_opportunity_status', $status, '', $_GET['filter']);
            $data .= '</div>';

            echo $data;
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }

    function pagination($page, $numberOfPages, $type, $status, $searchTerm, $filter){

        $ends_count = 1;  //how many items at the ends (before and after [...])
        $middle_count = 2;  //how many items before and after current page
        $dots = false;

        $data = '<ul class="d-inline-block">';
        
        if($page > 1)
            $data .= '<li class="" onClick=paginate("'.($page - 1).'","'.$type.'","'.$status.'","'.$searchTerm.'","'.@$filter.'")><strong>&laquo;</strong> Prev</li>';

        /*$show = 0;
        for($i = 1; $i <= $numberOfPages; $i++ ){
            $currentPage = @$page ? $page : 1;
            $class = $currentPage == $i ? 'active paginate-class' : 'paginate-class';
            $show++;
            if (($show < 5) || ($numberOfPages == $i))
                $data .= '<li class="'.$class.'" onClick=paginate("'.$i.'","'.$type.'","'.$status.'","'.$searchTerm.'","'.@$filter.'")>'.$i.'</li>';
            else
                $data .= '<li class="dot">.</li>';
        }*/

        for ($i = 1; $i <= $numberOfPages; $i++) {
            $currentPage = @$page ? $page : 1;
            $class = $currentPage == $i ? 'active paginate-class' : 'paginate-class';
            if ($i == $page) {
                $data .= '<li class="'.$class.'" onClick=paginate("'.$i.'","'.$type.'","'.$status.'","'.$searchTerm.'","'.@$filter.'")>'.$i.'</li>';
                $dots = true;
            } else {
                if ($i <= $ends_count || ($page && $i >= $page - $middle_count && $i <= $page + $middle_count) || $i > $numberOfPages - $ends_count) { 
                    $data .= '<li class="'.$class.'" onClick=paginate("'.$i.'","'.$type.'","'.$status.'","'.$searchTerm.'","'.@$filter.'")>'.$i.'</li>';
                    $dots = true;
                } elseif ($dots){
                    $data .= '<li class="paginate-class">&hellip;</li>';
                    $dots = false;
                }
            }
        }
        if ($page < $numberOfPages || -1 == $numberOfPages) { 
           $data .= '<li class="" onClick=paginate("'.($page + 1).'","'.$type.'","'.$status.'","'.$searchTerm.'","'.@$filter.'")>Next <strong>&raquo;</strong></li>';
        }
            
        $data .= '</ul>';
        return $data;
    }

    function pendingApprovalStatus($oppID, $status){
        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];

        $maxQuery = "SELECT row_count FROM approval_table ap WHERE ap.opp_id = '$oppID' AND ap.apply_for = '$status'";
        if($status)
            $maxQuery .= " AND ap.apply_for = '$status'";

        $maxQuery .= " ORDER BY row_count DESC LIMIT 1";
        
        $result = $GLOBALS['db']->query($maxQuery);
        $rowCount = $GLOBALS['db']->fetchByAssoc($result);
        if($rowCount)
            $rowCount = $rowCount['row_count'];

        $query = "SELECT u.first_name, u.last_name, ap.Approved, ap.Rejected, ap.pending FROM approval_table ap JOIN users u ON u.id = ap.approver_rejector WHERE ap.opp_id = '$oppID' AND ap.apply_for = '$status'";
        if($rowCount)
            $query .= " AND ap.row_count = '$rowCount'";

        $result = $GLOBALS['db']->query($query);
        $data = '';
        while($row = $GLOBALS['db']->fetchByAssoc($result)){
            $class = '';
            if($row['pending'] == 1)
                $class = 'label-yellow';
            else if($row['Approved'] == 1)
                $class = 'label-green';
            else if($row['Rejected'] == 1)
                $class = 'label-red';

            $data .= '<a href="javascript:void(0);" title="'.$row['first_name'].' '.$row['last_name'].'" class="label '.$class.'">'.substr($row['first_name'], 0, 1).substr($row['last_name'], 0, 1).'</a>';
        }
        return $data;
    }

    function getOpportunityStatusCount($status = null){

        global $current_user;
        $log_in_user_id = $current_user->id;

        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        /*if($status){
            /*$query = "SELECT count(*) as count FROM opportunities AS o JOIN opportunities_cstm oc ON o.id = oc.id_c JOIN (
                SELECT *, count(opp_id) as opp_count  FROM approval_table GROUP BY opp_id ORDER BY id DESC
            ) AS ap ON o.id = ap.opp_id AND ap.opp_count = 1
            WHERE oc.user_id2_c = '$log_in_user_id' AND ap.apply_for = '".$status."' AND ap.Approved = 0 AND ap.pending = 1 AND o.deleted != 1";*/
            /*$query = "SELECT count(*) as count FROM opportunities AS o JOIN opportunities_cstm oc ON oc.id_c = o.id JOIN (
                SELECT *, MAX(id) as id_count, count(opp_id) as opp_count  FROM approval_table GROUP BY opp_id ORDER BY id DESC
            ) AS ap ON o.id = ap.opp_id
            WHERE oc.user_id2_c = '$log_in_user_id' AND ap.apply_for = '".$status."' AND ap.Approved = 0 AND ap.pending = 1 AND o.deleted != 1";
            $query = "SELECT o.id FROM opportunities o JOIN opportunities_cstm oc ON oc.id_c = o.id WHERE o.deleted != 1 AND ( oc.user_id2_c = '$log_in_user_id' OR oc.delegate = '$log_in_user_id' )";
            $result = $GLOBALS['db']->query($query);
            $count = 0;
            while($row = $GLOBALS['db']->fetchByAssoc($result)){
                $oppID = $row['id'];
                $query2 = "SELECT id, Approved, pending FROM approval_table WHERE opp_id = '$oppID' AND apply_for = '$status' ORDER BY id DESC LIMIT 1";
                $result2 = $GLOBALS['db']->query($query2);
                while($row2 = $GLOBALS['db']->fetchByAssoc($result2)){
                    // echo $row2['id'].'<br>';
                    if($row2['Approved'] == 0 && $row2['pending'] == 1)
                        $count++;
                }
            }
            return $count;
        }
        else{
            $query = "SELECT count(*) as count FROM opportunities_cstm oc LEFT JOIN opportunities o ON o.id = oc.id_c WHERE o.deleted != 1";

            $count = $GLOBALS['db']->query($query);
            $count = $GLOBALS['db']->fetchByAssoc($count);
            return $count['count'];
        }*/

        $maxQuery = "SELECT row_count FROM approval_table WHERE ap.Approved = 0 AND ap.Rejected = 0 AND ap.pending = 1 AND ( ap.approver_rejector = '$log_in_user_id' OR ap.delegate_id = '$log_in_user_id' )";
        if($status)
            $maxQuery .= " AND ap.apply_for = '$status'";

        $maxQuery .= " ORDER BY row_count DESC LIMIT 1";
        
        $result = $GLOBALS['db']->query($maxQuery);
        $rowCount = $GLOBALS['db']->fetchByAssoc($result);
        if($rowCount)
            $rowCount = $rowCount['row_count'];

        $query = "SELECT count(*) as count FROM approval_table ap";
        $query .= " JOIN opportunities o ON o.id = ap.opp_id";
        $query .= " WHERE ap.Approved = 0 AND ap.Rejected = 0 AND ap.pending = 1 AND o.deleted != 1 AND o.date_entered >= now() - interval '1200' day AND ( ap.approver_rejector = '$log_in_user_id' OR ap.delegate_id = '$log_in_user_id' )";

        if($status)
            $query .= " AND ap.apply_for = '$status'";
        if($rowCount)
            $query .= " AND ap.row_count = '$rowCount'";

        //echo $query; die;

        $result = $GLOBALS['db']->query($query);
        $count = $GLOBALS['db']->fetchByAssoc($result);
        return $count['count'];
    }

    function delegateCountWithStatus($status, $userID){
        global $current_user;
        $log_in_user_id = $current_user->id;

        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        /*$query = "SELECT o.id FROM opportunities o JOIN opportunities_cstm oc ON oc.id_c = o.id WHERE o.deleted != 1 AND oc.delegate = '$log_in_user_id' AND oc.user_id2_c = '$userID' ";
        $result = $GLOBALS['db']->query($query);
        $dCount = 0;
        while($row = $GLOBALS['db']->fetchByAssoc($result)){
            $oppID = $row['id'];
            $query2 = "SELECT id, Approved, pending FROM approval_table WHERE opp_id = '$oppID' AND apply_for = '$status' ORDER BY id DESC LIMIT 1";
            $result2 = $GLOBALS['db']->query($query2);
            while($row2 = $GLOBALS['db']->fetchByAssoc($result2)){
                // echo $row2['id'].'<br>';
                if($row2['Approved'] == 0 && $row2['pending'] == 1)
                    $dCount++;
            }
        }*/
        $query = "SELECT count(*) as count FROM approval_table ap";
        $query .= " JOIN opportunities o ON o.id = ap.opp_id";
        $query .= " WHERE ap.Approved = 0 AND ap.Rejected = 0 AND ap.pending = 1 AND o.deleted != 1 AND o.date_entered >= now() - interval '1200' day AND ap.approver_rejector = '$userID' AND ap.delegate_id = '$log_in_user_id' ";

        if($status)
            $query .= " AND apply_for = '$status'";

        // echo $query; die;

        $result = $GLOBALS['db']->query($query);
        $count = $GLOBALS['db']->fetchByAssoc($result);
        return $count['count'];
        //return $dCount;
    }

    public function getDelegateCount($userID) {
        $qlLeadCount = $this->delegateCountWithStatus('qualifylead', $userID);
        $qlOppCount = $this->delegateCountWithStatus('qualifyOpportunity', $userID);
        $qlDPRCount = $this->delegateCountWithStatus('qualifyDpr', $userID);
        $qlBidCount = $this->delegateCountWithStatus('qualifyBid', $userID);
        $qlClosedCount = $this->delegateCountWithStatus('closure', $userID);
        $qlDroppedCount = $this->delegateCountWithStatus('Dropping', $userID);
        return ($qlLeadCount + $qlOppCount + $qlDPRCount + $qlBidCount + $qlClosedCount + $qlDroppedCount);
    }

    function checkDelegate(){
        global $current_user;
        $log_in_user_id = $current_user->id;

        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        // $query = "SELECT count(*) as delegate FROM users WHERE id = '$log_in_user_id' AND reports_to_id != '' ";
        $query = "SELECT count(*) as delegate FROM users_cstm WHERE id_c = '$log_in_user_id' AND (teamheirarchy_c = 'team_lead' OR mc_c = 'yes')";
        $result = $GLOBALS['db']->query($query);
        $result = $GLOBALS['db']->fetchByAssoc($result);
        return $result['delegate'] ? true : false;

    }

    function getDelegateDetails(){
        global $current_user;
        $log_in_user_id = $current_user->id;

        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        $query = "SELECT u.first_name, u.last_name, oc.user_id2_c FROM opportunities o JOIN opportunities_cstm oc ON oc.id_c = o.id JOIN users u ON u.id = oc.user_id2_c WHERE o.deleted != 1 AND date_entered >= now() - interval '1200' day AND oc.delegate = '$log_in_user_id' GROUP BY oc.user_id2_c ";
        $result = $GLOBALS['db']->query($query);
        $delegateData = array();
        while($row = $GLOBALS['db']->fetchByAssoc($result)){
            $dData = array(
                'name' => $row['first_name'].' '.$row['last_name'],
                'count' => $this->getDelegateCount($row['user_id2_c'])
            );
            array_push($delegateData, $dData);
        }
        $output = '';
        foreach($delegateData as $d){
            $output .= $d['name'].' - '.$d['count'].'<br>';
        }
        return $output;
    }

    function getOpportunityStatusCountGraph($status = null, $day, $closure_status = false){
        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        if($status)
            $query = "SELECT count(*) as count FROM opportunities_cstm oc LEFT JOIN opportunities o ON o.id = oc.id_c WHERE oc.status_c = '".$status."' AND o.deleted != 1 AND o.date_entered >= now() - interval '".$day."' day";
        else
            $query = "SELECT count(*) as count FROM opportunities_cstm oc LEFT JOIN opportunities o ON o.id = oc.id_c WHERE o.deleted != 1 AND o.date_entered >= now() - interval '".$day."' day";

        if ($status == 'Closed' && $closure_status)
            $query = "SELECT count(*) as count FROM opportunities_cstm oc LEFT JOIN opportunities o ON o.id = oc.id_c WHERE oc.status_c = '".$status."' AND o.deleted != 1 AND o.date_entered >= now() - interval '".$day."' day AND oc.closure_status_c = 'won'"; 
        
        $count = $GLOBALS['db']->query($query);
        $count = $GLOBALS['db']->fetchByAssoc($count);
        
        return $count['count'];
    }

    function action_get_approval_item(){
        try
        {
            global $current_user;
            $log_in_user_id = $current_user->id;
            
            $id = $_POST['opp_id'];
            $event = $_POST['event'];

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            //$fetch_query = "SELECT * FROM opportunities o WHERE o.id = '$id' AND o.deleted != 1";
            $fetch_query = "SELECT o.*, oc.* FROM opportunities o JOIN approval_table ap ON ap.opp_id = o.id LEFT JOIN opportunities_cstm oc ON o.id = oc.id_c WHERE o.deleted != 1 AND o.date_entered >= now() - interval '1200' day AND ap.id = '$id'";
            $result = $GLOBALS['db']->query($fetch_query);
            while($row = $GLOBALS['db']->fetchByAssoc($result))
            {

                /*switch ($row['status_c']){
                    case 'Lead':
                        $ChangedStatus = 'qualifylead';
                        break;
                    case 'QualifiedLead':
                        $ChangedStatus = 'qualifyOpportunity'; 
                        break;
                    case 'Qualified':
                        $ChangedStatus = 'qualifyDpr';
                        break;
                    case 'QualifiedDpr':
                        $ChangedStatus = 'qualifyBid';
                        break;
                    case 'QualifiedBid':
                        $ChangedStatus = 'closure';
                        break;
                    case 'Drop':
                        $ChangedStatus = 'Dropping';
                        break;
                    default:
                        $ChangedStatus = '';
                        $AppliedStatus = '';
                        break;
                }*/

                $ChangedStatus = $this->getChangeStatus($row['status_c'], $row['rfporeoipublished_c']);

                $created_by_id = $row['created_by'];
                $user_name_fetch = "SELECT * FROM users WHERE id='$created_by_id'";
                $user_name_fetch_result = $GLOBALS['db']->query($user_name_fetch);
                $user_name_fetch_row = $GLOBALS['db']->fetchByAssoc($user_name_fetch_result);

                $user_name = $user_name_fetch_row['user_name'];
                $first_name = $user_name_fetch_row['first_name'];
                $last_name = $user_name_fetch_row['last_name'];
                $full_name = "$first_name  $last_name";
                $approver_first_name = $this->get_user_details_by_id($log_in_user_id)['first_name'];
                $approver_last_name = $this->get_user_details_by_id($log_in_user_id)['last_name'];
                $approver_full_name = "$approver_first_name $approver_last_name";
                $temp = ($event == 'Approve') ? 'Approval' : 'Rejection';
                $data = '
                <input type="hidden" class="current-approval-status" name="status" value="'.$row['status_c'].'" />
                <input type="hidden" class="changed-status" name="changed-status" value="'.$ChangedStatus.'" />
                <input type="hidden" name="opp_id" value="'.$row['id'].'" />
                <input type="hidden" name="event" value="'.$event.'" />
                <input type="hidden" name="approval_id" value="'.$id.'" />
                <input type="hidden" name="rfp_eoi" value="'.($this->beautify_label($row['rfporeoipublished_c'])).'" />
                <h2 class="approvalheading">'.$row['name'].'</h2><br>
                <p class="approvalsubhead">'. $temp .' of Opportunity
                </p>
                <section>
                    <div style="padding: 10px 15px;">
                        <table class="approvaltable" width="100%">
                            <tr class="tapprovalable-header-row-popup">
                                <th class="approvaltable-header-popup">Primary Responsibility</th>
                                <th class="approvaltable-header-popup">Amount</th>
                                <th class="approvaltable-header-popup">RFP/EOI<br>Published</th>
                                <th class="approvaltable-header-popup">Modified Date</th>
                                <th class="approvaltable-header-popup">Approval<br>status</th>
                                <th class="approvaltable-header-popup">Date Created</th>
                            </tr>';

                $data .='
                                <tr>
                                    <td class="approvaltable-data-popup">'.$full_name.'</td>
                                    <td class="approvaltable-data-popup">'.($this->beautify_amount($row['budget_allocated_oppertunity_c'])).'</td>
                                    <td class="approvaltable-data-boolean-popup">'.($this->beautify_label($row['rfporeoipublished_c'])).'</td>
                                    <td class="approvaltable-data-popup">'.date_format(date_create($row['date_modified']),'d/m/Y').'</td>
                                    <td class="approvaltable-data-popup">
                                        <span style="color:orange;">'.$approver_full_name.'</span>
                                    </td>
                                    <td class="approvaltable-data-popup">'.date_format(date_create($row['date_entered']),'d/m/Y').'</td>
                                </tr>';
                    $data .= '
                        </table> <!-- /.col-md-12 -->
                    </div>
                    <div style="padding: 30px 15px 0;">
                        <label style="font-family: "Noto Sans JP", sans-serif; padding-left: 15px; font-size: 15px;" for="approvaltype-comment">Write a comment</label>
                        <!-- <textarea class="approvaltextarea" placeholder="Type here" style="border-color: #C0C0C0; font-family: "Noto Sans JP", sans-serif; border-radius: 3px; margin-top: 3px;" id="approvaltype-comment" rows="3"></textarea> -->
                    </div>
        
                    <textarea class="approvaltextarea" name="comment" placeholder="Type Subject here" style="border-color: #C0C0C0; font-family: \'Noto Sans JP\', sans-serif; border-radius: 3px; margin-top: 10px; width: 94%; height: 100px;" id="approvalSubject" rows="1"></textarea>
                    <div style=" padding-top: 20px;padding-bottom: 20px;padding-left: 20px;">
                        <button class="btn1" type="button" onClick=updateStatus();>'.$event.'</button>
                        <button type="button" style="margin-left: 10px;" class="btn2" id="approvalclose" onClick="openApprovalDialog(\'close\');">Cancel</button>
                    </div>
                </section>';
            }
            echo $data;
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }

    function get_multiple_approvers($op_id) {
        $query = "SELECT DISTINCT approver_rejector,Approved,Rejected,date_time,pending FROM approval_table WHERE opp_id = '$op_id'";
    }

    public function action_tag_list() {
        try{
            global $current_user;
            $log_in_user_id = $current_user->id;            
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            $fetch_query = "SELECT * FROM `users` WHERE `id` != '$log_in_user_id' AND id != '1' AND
             id NOT IN (SELECT reports_to_id FROM users WHERE id = '$log_in_user_id' OR id = '1') ORDER BY `users`.`first_name` ASC";
            $result = $GLOBALS['db']->query($fetch_query);
            $data = "";
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $full_name = $row['first_name'] . ' ' . $row['last_name'];
                    $full_name = trim($full_name," ");
                    $data .= '<option value="'.$row["id"].'---'.$full_name.'">'.$full_name.'</option>';
                }
            } else {
                echo "0 results";
            }
            echo json_encode(array('members'=>$data, 'logged_in_id' => $log_in_user_id));
        }
        catch(Exception $e){
            echo json_encode(array("message" => "Some error occured"));
        }
        die();
    }

    public function is_tagging_applicable($opportunity_id) {
        global $current_user;
    	$log_in_user_id = $current_user->id;
    	$db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];

        $team_func_array = $team_func_array1 = $others_id_array = array();

        $sql ='SELECT * FROM opportunities LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE opportunities.id="'. $opportunity_id.'"';
        $result = $GLOBALS['db']->query($sql);
        while($row = $GLOBALS['db']->fetchByAssoc($result) )
            {
                $created_by=$row['created_by'];
                $assigned=$row['assigned_user_id'];
                $approver=$row['multiple_approver_c'];
                $deligate = $row['delegate'];
                $approver1=$row['user_id2_c'];
            }
        $sql5 = "SELECT user_id FROM tagged_user WHERE opp_id='".$opportunity_id."'";
        $result5 = $GLOBALS['db']->query($sql5);
        while($row5 = $GLOBALS['db']->fetchByAssoc($result5))
        {
                $other1=$row5['user_id'];
                $others_id_array = explode(',', $other1);
        }
        if (strpos($deligate, ',') !== false) {
            $team_func_array = explode(',', $deligate);
        }
        if (strpos($approver, ',') !== false) {
            $team_func_array1 = explode(',', $approver);
        }
        $sql3 = "SELECT users.id, users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '".$log_in_user_id."' AND users.deleted = 0";
        $result3 = $GLOBALS['db']->query($sql3);
        while($row3 = $GLOBALS['db']->fetchByAssoc($result3)) 
        {
            $check_sales = $row3['teamfunction_c'];
            $check_mc = $row3['mc_c'];
            $check_team_lead = $row3['teamheirarchy_c'];
            
        }
        if($check_mc =="yes"|| $log_in_user_id == $created_by || $log_in_user_id == "1"
        || in_array($log_in_user_id, $team_func_array1)||in_array($log_in_user_id, $others_id_array)  || in_array($log_in_user_id, $team_func_array) 
        || $log_in_user_id == $approver1 || $log_in_user_id == $assigned)
        {
            return true;
        } else{
            return false;
        }
    }

    public function action_get_user_details() {
        try{
            global $current_user;
            $log_in_user_id = $current_user->id;
            $check_user_team = "SELECT teamfunction_c from users LEFT JOIN users_cstm ON users.id = users_cstm.id_c WHERE id = '$log_in_user_id'";
            $check_user_team_result = $GLOBALS['db']->query($check_user_team);
            $user_team_row = $GLOBALS['db']->fetchByAssoc($check_user_team_result);
            $user_team = $user_team_row['teamfunction_c'];
            echo json_encode(array('user_team'=>$user_team, 'user_id'=> $log_in_user_id));
        }catch(Exception $e){
            echo json_encode(array("message" => "Some error occured"));
        }
        die();
    }

    public function action_load_multi_select() {
        try{
            global $current_user;
    	    $log_in_user_id = $current_user->id;
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            if($_POST["query"] != '')
            {
                $search_array = explode(",", $_POST["query"]);
                $search_text = "'" . implode("','", $search_array) . "'";
                $query = "
                SELECT * FROM users,users_cstm 
                WHERE id IN (".$search_text.") 
                ";
            }
            else
            {
                $query = "SELECT * FROM `users` WHERE `id` != '$log_in_user_id' AND id != '1'
                AND id NOT IN (SELECT reports_to_id FROM users WHERE id = '$log_in_user_id') ORDER BY `users`.`first_name` ASC ";
            }
            $statement = $GLOBALS['db']->query($query);
            $total_row = $statement->num_rows;
            $output = '';

            if($total_row > 0)
            {
                while($row = $statement->fetch_assoc())
                {   
                    $full_name = $row['first_name'] . ' ' . $row['last_name'];
                    $output .= '
                    <tr>
                        <td>'.$full_name.'</td>
                    </tr>
                    ';
                }
            }
            else
            {
                $output .= '
                <tr>
                    <td colspan="5" align="center">No Data Found</td>
                </tr>
                ';
            }

            echo $output;
        }catch(Exception $e){
            echo json_encode(array("message" => "Some error occured"));
        }
        die();
    }
    

    function action_opportunity_status_update(){
        try
        {
            global $current_user;
            $log_in_user_id = $current_user->id;
            
            $id = $_POST['opp_id'];
            $status = $_POST['status'];

            $approval_id = $_POST['approval_id'];

            if ($status == 'QualifiedOpportunity') {
                $status = 'Qualified';
            }
            $changedStatus = $_POST['changed-status'];
            $event = $_POST['event'];
            $comment = $_POST['comment'];
            $rfp_eoi = $_POST['rfp_eoi'];

            $Approved = $event == 'Approve' ? 1 : 0;
            $Rejected = $event == 'Reject' ? 1 : 0;
            
            date_default_timezone_set('Asia/Kolkata');
            $date = date('D M d Y H:i:s').' GMT+0530 (India Standard Time)';
        
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $opportunityDetails = "SELECT rfporeoipublished_c FROM opportunities_cstm WHERE id_c = '$id'";
            $result = $GLOBALS['db']->query($opportunityDetails);
            $opportunity = $GLOBALS['db']->fetchByAssoc($result);

            $changedStatus = $this->getApprovalStatus($changedStatus, $opportunity['rfporeoipublished_c']);

            $this->checkPendingAndRejectedApprovals($id, $_POST['changed-status']);

            //$insertApprovalQuery = "INSERT into approval_table(opp_id,rfp_eoi_published,status,apply_for,Approved,Rejected,approver_rejector,comments,date_time,pending) VALUES('$id','$rfp_eoi', '$status', '$changedStatus', '$Approved', '$Rejected', '$log_in_user_id', '$comment', '$date', '0')";
            $updateOpportunity = "UPDATE approval_table SET";
            $updateOpportunity .= " Approved = '$Approved', Rejected = '$Rejected', pending = 0,";

            if($this->isDelegate($log_in_user_id, $id)){
                $updateOpportunity .= " delegate_comments = '$comment', delegate_date_time = '$date'";
            }else{
                $updateOpportunity .= " comments = '$comment', date_time = '$date'";
            }

            $updateOpportunity .= " WHERE opp_id = '$id' AND id = '$approval_id'";
            if($this->isDelegate($log_in_user_id, $id)){
                $updateOpportunity .= " AND delegate_id = '$log_in_user_id'";
            }else{
                $updateOpportunity .= " AND approver_rejector = '$log_in_user_id'";
            }

            if($db->query($updateOpportunity)==TRUE){
                if($Approved){
                    if(!$this->checkPendingAndRejectedApprovals($id, $_POST['changed-status'])){
                        $updateOpportunity = "UPDATE opportunities_cstm SET status_c = '$changedStatus' WHERE id_c = '$id'";
                        $db->query($updateOpportunity);
                    }
                }
                echo json_encode(array("status"=>true, "message" => "Status changed successfully."));
            }else{
                echo json_encode(array("status"=>false, "message" => "Some error occured"));
            }
            
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }

    function getApprovalStatus($status, $rfp_eoi_status){
        $ChangedStatus = '';
        if($rfp_eoi_status == 'no'){
            switch ($status){
                case 'qualifylead':
                    $ChangedStatus = 'QualifiedLead';
                    break;
                case 'qualifyOpportunity':
                    $ChangedStatus = 'Qualified'; 
                    break;
                case 'qualifyDpr':
                    $ChangedStatus = 'QualifiedDpr';
                    break;
                case 'qualifyBid':
                    $ChangedStatus = 'QualifiedBid';
                    break;
                case 'closure':
                    $ChangedStatus = 'Closed';
                    break;
                case 'Dropping':
                    $ChangedStatus = 'Dropped';
                    break;
                default:
                    $ChangedStatus = '';
                    $AppliedStatus = '';
                    break;
            }
        }else if($rfp_eoi_status == 'yes'){
            switch ($status){
                case 'qualifylead':
                    $ChangedStatus = 'QualifiedLead';
                    break;
                case 'qualifyOpportunity':
                    $ChangedStatus = 'QualifiedBid'; 
                    break;
                /*case 'qualifyDpr':
                    $ChangedStatus = 'QualifiedDpr';
                    break;*/
                case 'qualifyBid':
                    $ChangedStatus = 'QualifiedBid';
                    break;
                case 'closure':
                    $ChangedStatus = 'Closed';
                    break;
                case 'Dropping':
                    $ChangedStatus = 'Dropped';
                    break;
                default:
                    $ChangedStatus = '';
                    $AppliedStatus = '';
                    break;
            }
        }else{
            switch ($status){
                case 'qualifylead':
                    $ChangedStatus = 'QualifiedLead';
                    break;
                case 'qualifyOpportunity':
                    $ChangedStatus = 'Qualified'; 
                    break;
                case 'qualifyDpr':
                    $ChangedStatus = 'QualifiedDpr';
                    break;
                case 'qualifyBid':
                    $ChangedStatus = 'QualifiedBid';
                    break;
                case 'closure':
                    $ChangedStatus = 'Closed';
                    break;
                case 'Dropping':
                    $ChangedStatus = 'Dropped';
                    break;
                default:
                    $ChangedStatus = '';
                    $AppliedStatus = '';
                    break;
            }
        }
        return $ChangedStatus;
    }

    function getChangeStatus($status, $rfp_eoi_status){
        $ChangedStatus = '';
        if($rfp_eoi_status == 'no'){
            switch ($status){
                case 'Lead':
                    $ChangedStatus = 'qualifylead';
                    break;
                case 'QualifiedLead':
                    $ChangedStatus = 'qualifyOpportunity'; 
                    break;
                case 'Qualified':
                    $ChangedStatus = 'qualifyDpr';
                    break;
                case 'QualifiedDpr':
                    $ChangedStatus = 'qualifyBid';
                    break;
                case 'QualifiedBid':
                    $ChangedStatus = 'closure';
                    break;
                case 'Drop':
                    $ChangedStatus = 'Dropping';
                    break;
                default:
                    $ChangedStatus = '';
                    $AppliedStatus = '';
                    break;
            }
        }else if($rfp_eoi_status == 'yes'){
            switch ($status){
                case 'Lead':
                    $ChangedStatus = 'qualifylead';
                    break;
                case 'QualifiedLead':
                    $ChangedStatus = 'qualifyBid'; 
                    break;
                case 'QualifiedBid':
                    $ChangedStatus = 'closure';
                    break;
                case 'Drop':
                    $ChangedStatus = 'Dropping';
                    break;
                default:
                    $ChangedStatus = '';
                    $AppliedStatus = '';
                    break;
            }
        }else{
            switch ($status){
                case 'Lead':
                    $ChangedStatus = 'qualifylead';
                    break;
                case 'QualifiedLead':
                    $ChangedStatus = 'qualifyOpportunity'; 
                    break;
                case 'Qualified':
                    $ChangedStatus = 'qualifyDpr';
                    break;
                case 'QualifiedDpr':
                    $ChangedStatus = 'closure';
                    break;
                case 'Drop':
                    $ChangedStatus = 'Dropping';
                    break;
                default:
                    $ChangedStatus = '';
                    $AppliedStatus = '';
                    break;
            }
        }
        return $ChangedStatus;
    }

    function isDelegate($userID, $oppID){
        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];

        $delegateQuery = "SELECT count(*) as count FROM approval_table WHERE delegate_id = '$userID' AND opp_id = '$oppID'";
        $count = $GLOBALS['db']->query($delegateQuery);
        $count = $GLOBALS['db']->fetchByAssoc($count);
        return $count['count'];
    }
    function checkPendingAndRejectedApprovals($oppID, $status){
        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];

        $maxQuery = "SELECT row_count FROM approval_table WHERE opp_id = '$oppID' AND apply_for = '$status' ORDER BY row_count DESC LIMIT 1";
        $result = $GLOBALS['db']->query($maxQuery);
        $rowCount = $GLOBALS['db']->fetchByAssoc($result);
        if($rowCount)
            $rowCount = $rowCount['row_count'];

        $finalApprover = "SELECT count(*) as count FROM approval_table WHERE opp_id = '$oppID' AND apply_for = '$status' AND Approved = 0 AND ((Rejected =  0 AND pending = 1 ) Or (Rejected = 1 AND pending = 0))";
        if($rowCount)
            $finalApprover .= " AND row_count = '$rowCount'";

        $count = $GLOBALS['db']->query($finalApprover);
        $count = $GLOBALS['db']->fetchByAssoc($count);
        return $count['count'];
    }

    public function action_opportunity_pending_count(){

        global $current_user;
        $log_in_user_id = $current_user->id;

        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        
        $PRC = $this->get_pending_request_count();
        /*$query = "SELECT count(*) as count FROM opportunities AS o JOIN opportunities_cstm oc ON oc.id_c = o.id JOIN (
                SELECT *, count(opp_id) as opp_count  FROM approval_table GROUP BY opp_id ORDER BY id DESC
            ) AS ap ON o.id = ap.opp_id AND ap.opp_count = 1
            WHERE oc.user_id2_c = '$log_in_user_id' AND ap.Approved = 0 AND ap.pending = 1 AND o.deleted != 1";*/
        /*$query = "SELECT count(*) as count FROM opportunities AS o JOIN opportunities_cstm oc ON oc.id_c = o.id JOIN (
            SELECT *, MAX(id) as id_count, count(opp_id) as opp_count  FROM approval_table GROUP BY opp_id ORDER BY id DESC
        ) AS ap ON o.id = ap.opp_id
        WHERE oc.user_id2_c = '$log_in_user_id' AND ap.Approved = 0 AND ap.pending = 1 AND o.deleted != 1";
        $count = $GLOBALS['db']->query($query);
        $count = $GLOBALS['db']->fetchByAssoc($count);*/
        
        /*$query = "SELECT o.id FROM opportunities o JOIN opportunities_cstm oc ON oc.id_c = o.id WHERE o.deleted != 1 AND (oc.user_id2_c = '$log_in_user_id' OR oc.delegate = '$log_in_user_id' )";
        $result = $GLOBALS['db']->query($query);
        $count = 0;
        while($row = $GLOBALS['db']->fetchByAssoc($result)){
            $oppID = $row['id'];
            $query2 = "SELECT id, Approved, pending FROM approval_table WHERE opp_id = '$oppID' ORDER BY id DESC LIMIT 1";
            $result2 = $GLOBALS['db']->query($query2);
            while($row2 = $GLOBALS['db']->fetchByAssoc($result2)){
                // echo $row2['id'].'<br>';
                if($row2['Approved'] == 0 && $row2['pending'] == 1)
                    $count++;
            }
        }*/
        echo $PRC . '<i class="fa fa-angle-double-down" aria-hidden="true"></i>';
    }

    public function get_pending_request_count() {
        $qlLeadCount = $this->getOpportunityStatusCount('qualifylead');
        $qlOppCount = $this->getOpportunityStatusCount('qualifyOpportunity');
        $qlDPRCount = $this->getOpportunityStatusCount('qualifyDpr');
        $qlBidCount = $this->getOpportunityStatusCount('qualifyBid');
        $qlClosedCount = $this->getOpportunityStatusCount('closure');
        $qlDroppedCount = $this->getOpportunityStatusCount('Dropping');
        return ($qlLeadCount + $qlOppCount + $qlDPRCount + $qlBidCount + $qlClosedCount + $qlDroppedCount);
    }

    public function get_closed_by($row) {
        if (!empty($row['date_modified'])) {
            $modified_user_id = $row['modified_user_id'];
            $modified_user_query = "SELECT * FROM users WHERE id='$modified_user_id'";
            $modified_user_query_fetch = $GLOBALS['db']->query($modified_user_query);
            $modified_user_query_fetch_row = $GLOBALS['db']->fetchByAssoc($modified_user_query_fetch);
            $closed_by_first_name = $modified_user_query_fetch_row['first_name'];
            $closed_by_last_name = $modified_user_query_fetch_row['last_name'];
            $closed_by = "$closed_by_first_name $closed_by_last_name";
            return $closed_by;
        }
    }

    public function action_get_graph(){
        $day = $_GET['dateBetween'];
        $totalCount = 0;
        $totalCount = $this->getOpportunityStatusCountGraph(null, $day);
        // $leadCount = round($this->getOpportunityStatusCountGraph('Lead') / $totalCount * 100, 0);
        if ($totalCount > 0) {
            $LeadCount = round($this->getOpportunityStatusCountGraph('Lead', $day) / $totalCount * 100, 0);
            $QualifiedLeadCount = round($this->getOpportunityStatusCountGraph('QualifiedLead', $day) / $totalCount * 100, 0);
            $QualifiedOpporunityCount = round($this->getOpportunityStatusCountGraph('Qualified', $day) / $totalCount * 100, 0);
            $QualifiedDPR = round($this->getOpportunityStatusCountGraph('QualifiedDpr', $day) / $totalCount * 100, 0);
            $QualifiedBid = round($this->getOpportunityStatusCountGraph('QualifiedBid', $day) / $totalCount * 100, 0);
            $Close = round($this->getOpportunityStatusCountGraph('Closed', $day, false) / $totalCount * 100, 0);
            $CloseWon = round($this->getOpportunityStatusCountGraph('Closed', $day, true) / $totalCount * 100, 0);
            if ($Close) {
                $CloseLost = $Close - $CloseWon;
            }
            $Drop = round($this->getOpportunityStatusCountGraph('Dropped', $day) / $totalCount * 100, 0);
        }

        $LeadCount = $LeadCount ? $LeadCount : 0;
        $QualifiedLeadCount = $QualifiedLeadCount ? $QualifiedLeadCount : 0;
        $QualifiedOpporunityCount = $QualifiedOpporunityCount ? $QualifiedOpporunityCount : 0;
        $QualifiedDPR = $QualifiedDPR ? $QualifiedDPR : 0;
        $QualifiedBid = $QualifiedBid ? $QualifiedBid : 0;
        $Close = $Close ? $Close : 0;
        $CloseWon = $CloseWon ? $CloseWon : 0;
        $CloseLost = $CloseLost ? $CloseLost : 0;
        $Drop = $Drop ? $Drop : 0;
        
        $data = '';

        if($LeadCount):
            $data .= '<div style="width: '.$LeadCount.'%">
                    <div style="width: 100%;height: 70px;background-color: #DDA0DD;"></div>
                    <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$LeadCount.'%</p>
                </div>';
        endif;

        if($QualifiedLeadCount):
            $data .= '<div style="width: '.$QualifiedLeadCount.'%">
                    <div style="width: 100%;height: 70px;background-color: #4B0082;"></div>
                    <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$QualifiedLeadCount.'%</p>
                </div>';
        endif;
        
        if($QualifiedOpporunityCount):
            $data .= '<div style="width: '.$QualifiedOpporunityCount.'%">
                    <div style="width: 100%; height: 70px; background-color: #0000FF;"></div>
                    <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$QualifiedOpporunityCount.'%</p>
                </div>';
        endif;

        if($QualifiedDPR):
            $data .= '<div style="width: '.$QualifiedDPR.'%">
                    <div style="width: 100%; height: 70px; background-color: #FFFF00;"></div>
                    <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$QualifiedDPR.'%</p>
                </div>';
        endif; 

        if($QualifiedBid):
            $data .= '<div style="width: '.$QualifiedBid.'%">
                    <div style="width: 100%; height: 70px; background-color: #00FF00;"></div>
                    <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$QualifiedBid.'%</p>
                </div>';
        endif;
        
        if($Close):
            if($CloseWon):
                $data .= '<div style="width: '.$CloseWon.'%">
                        <div style="width: 100%; height: 70px; background-color: #006400;"></div>
                        <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$CloseWon.'%</p>
                    </div>';
            endif;
            if($CloseLost):
                $data .= '<div style="width: '.$CloseLost.'%">
                        <div style="width: 100%; height: 70px; background-color: #FF7F00;"></div>
                        <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$CloseLost.'%</p>
                    </div>';
            endif;
        endif; 

        if($Drop):
            $data .= '<div style="width: '.$Drop.'%">
                    <div style="width: 100%; height: 70px; background-color: #FF0000;"></div>
                    <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$Drop.'%</p>
                </div>';
        endif; 

        echo $data;
    }

    function getTaggedMembers($id){
        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        $query = "SELECT opportunities_users_2users_idb FROM opportunities_users_2_c WHERE opportunities_users_2opportunities_ida = '$id'";
        $data = $GLOBALS['db']->query($query);
        $usersArray = array();
        while($d = $GLOBALS['db']->fetchByAssoc($data)){
            array_push($usersArray, $d['opportunities_users_2users_idb']);
        }
        $query = "SELECT first_name, last_name FROM users WHERE id IN ('" . implode(',', $usersArray) . "')";
        $data = $GLOBALS['db']->query($query);
        $members = '';
        while($row = $GLOBALS['db']->fetchByAssoc($data)){
            $members .= $row['first_name'].' '.$row['last_name'].', ';
        }
        return $members;
    }

    function getModifiedUser($id){
        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        $query = "SELECT first_name, last_name FROM users WHERE id = '$id'";
        $data = $GLOBALS['db']->query($query);
        $user = '';
        while($row = $GLOBALS['db']->fetchByAssoc($data)){
            $user .= $row['first_name'].' '.$row['last_name'];
        }
        return $user;
    }

    public function get_non_global_op_count($day) {
        global $current_user;
        $log_in_user_id = $current_user->id;
        $organiztion_non_global_count = "SELECT count(*) as org_non_global_count FROM opportunities WHERE opportunity_type = 'non_global' AND deleted != 1 AND date_entered >= now() - interval '$day' day AND 
            opportunities.id NOT IN(
            SELECT opp_id FROM untagged_user WHERE user_id LIKE '%$log_in_user_id%'
            )";
        $organiztion_count_result = $GLOBALS['db']->query($organiztion_non_global_count);
        $fetch_organization_count = $GLOBALS['db']->fetchByAssoc($organiztion_count_result);
        $non_global_organization_count = $fetch_organization_count['org_non_global_count'];
        return $non_global_organization_count;
    }

    public function action_getOpportunityStatusTimeline(){
        try{
            $oppID = $_POST['oppID']; 
            
            $data = '<span class="close-sequence-flow">×</span><div class="wrap padding-tb black-color">';

            $query = "SELECT name FROM opportunities WHERE id = '$oppID'";
            $result = $GLOBALS['db']->query($query);
            $result = $GLOBALS['db']->fetchByAssoc($result);

            $data .= '<div class="d-block padding">
                    <h2 class="">'.$result['name'].'</h2>
                    <h3 class="gray-color">Approval/Rejection Audit Trail</h3>
                </div>
                <hr>';

            $query = "SELECT u.first_name, u.last_name, ap.date_time, ap.apply_for, ap.Approved, ap.Rejected, ap.pending FROM approval_table ap JOIN users u ON u.id = ap.approver_rejector WHERE ap.opp_id = '$oppID' AND ap.pending = 0 ORDER BY ap.updated_at DESC, ap.Rejected ASC LIMIT 1";
            $result = $GLOBALS['db']->query($query);
            $result = $GLOBALS['db']->fetchByAssoc($result);
            
            if($result):
            
                $dateExtracted = substr($result['date_time'],4,11);
                $updateDate = date('d/m/Y', strtotime($dateExtracted));
            
                if($result['pending'] == 1){
                    $class = 'label-yellow';
                    $circleClass = 'black-color yellow-bg';
                    $status = 'Pending';
                }else if($result['Approved'] == 1){
                    $class = 'label-green';
                    $circleClass = 'gray-color green-bg';
                    $status = 'Approved';
                }else if($result['Rejected'] == 1){
                    $class = 'label-red';
                    $circleClass = 'red-color red-bg';
                    $status = 'Rejected';
                }

                $data .= '<div class="row padding">
                        <div class="d-inline-block w-50 py-2">
                            <h4 class="">Recent Update</h4>
                            <h5 class="'.$class.'">'.$status.'</h5>
                            <h5>'.$result['first_name'].' '.$result['last_name'].'<span class="status-badge '.$circleClass.'">'.$this->getStatusChar($result['apply_for'], $oppID).'</span></h5> 
                        </div>
                        <div class="d-inline-block w-50 align-self-end text-right">
                            <h5 class="gray-color">'.$updateDate.'</h5>
                        </div>
                    </div>
                    <hr>';
            endif;
            
            $data .= '<div class="approved">';
            $query = "SELECT u.first_name, u.last_name, ap.opp_id, ap.date_time, ap.apply_for, ap.Approved, ap.Rejected, ap.pending FROM approval_table ap JOIN users u ON u.id = ap.approver_rejector WHERE ap.opp_id = '$oppID' AND ap.pending = 0 ORDER BY ap.updated_at ASC";
            $result = $GLOBALS['db']->query($query);
            while($row = $GLOBALS['db']->fetchByAssoc($result)){
                
                $class = '';
                
                if($row['Approved'] == 1){
                    $class = 'status-badge-green-b';
                    $lineClass = 'green';
                }else if($row['Rejected'] == 1){
                    $class = 'status-badge-red-b';
                    $lineClass = 'red';
                }
                
                $dateExtracted = substr($row['date_time'],4,11);
                $updateDate = date('d/m/Y', strtotime($dateExtracted));

                //$data .= '<a href="javascript:void(0);" title="'.$row['first_name'].' '.$row['last_name'].'" class="label '.$class.'">'.substr($row['first_name'], 0, 1).substr($row['last_name'], 0, 1).'</a>';
                $data .= '<!-- single -->
                    <div class="row half-padding-tb">
                        <div class="d-inline-block w-50">
                            <!--<h5><span class="status-badge-green-b">'.$this->getStatusChar($row['apply_for'],$row['opp_id']).'</span> 
                            <span class="line-bottom"></span> '.$this->getApproverNames($row['opp_id'], $row['apply_for'], 0).'</h5> -->
                            
                            <h5><span class="'.$class.'">'.$this->getStatusChar($row['apply_for'],$row['opp_id']).'</span> 
                            <span class="line-bottom '.$lineClass.'"></span> '.$row['first_name'].' '.$row['last_name'].'</h5> 
                        </div>
                        <div class="d-inline-block w-50 align-self-end text-right">
                            <h5 class="gray-color">'.$updateDate.'</h5>
                        </div>
                    </div>';
            }
            $data .= '</div>';

            /*$query = "SELECT u.first_name, u.last_name, ap.opp_id, ap.date_time, ap.apply_for, ap.Approved, ap.Rejected, ap.pending FROM approval_table ap JOIN users u ON u.id = ap.approver_rejector WHERE ap.opp_id = '$oppID' AND ap.pending = 0 AND ap.Rejected = 1 GROUP BY ap.apply_for";
            $result = $GLOBALS['db']->query($query);
            while($row = $GLOBALS['db']->fetchByAssoc($result)){
                
                $class = '';
                if($row['pending'] == 1)
                    $class = 'label-yellow';
                else if($row['Approved'] == 1)
                    $class = 'label-green';
                else if($row['Rejected'] == 1)
                    $class = 'label-red';
                
                $dateExtracted = substr($row['date_time'],4,11);
                $updateDate = date('d/m/Y', strtotime($dateExtracted));

                //$data .= '<a href="javascript:void(0);" title="'.$row['first_name'].' '.$row['last_name'].'" class="label '.$class.'">'.substr($row['first_name'], 0, 1).substr($row['last_name'], 0, 1).'</a>';
                $data .= '<!-- single -->
                    <div class="row half-padding-tb rejected">
                        <div class="d-inline-block w-50">
                            <h5><span class="status-badge-red-b">'.$this->getStatusChar($row['apply_for']).'</span> 
                            <span class="line-up"></span> '.$this->getApproverNames($row['opp_id'], $row['apply_for'], 1).'</h5> 
                        </div>
                        <div class="d-inline-block w-50 align-self-end text-right">
                            <h5 class="gray-color">'.$updateDate.'</h5>
                        </div>
                    </div>';
            }*/

            $data .= '</div>';
            echo json_encode(array('data' => $data));
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }

    function checkRecentActivity($oppID){
        $query = "SELECT u.first_name, u.last_name, ap.date_time, ap.apply_for, ap.Approved, ap.Rejected, ap.pending FROM approval_table ap JOIN users u ON u.id = ap.approver_rejector WHERE ap.opp_id = '$oppID' AND ap.pending = 0 ORDER BY ap.id DESC, ap.Rejected ASC LIMIT 1";
        $recentActivity = $GLOBALS['db']->query($query);
        $count = mysqli_num_rows($recentActivity);
        return $count;
    }

    function getApproverNames($oppID, $status, $rejected){
        $query = "SELECT u.first_name, u.last_name, ap.date_time, ap.apply_for, ap.Approved, ap.Rejected, ap.pending FROM approval_table ap JOIN users u ON u.id = ap.approver_rejector WHERE ap.opp_id = '$oppID' AND ap.pending = 0 AND ap.Rejected = '$rejected' AND ap.apply_for = '$status'";
        $result = $GLOBALS['db']->query($query);
        $count = mysqli_num_rows($result);
        $data = '';
        $class = '';
        $i = 0;
        while($row = $GLOBALS['db']->fetchByAssoc($result)){
            if($count > 1){
                if($i)
                    $data .= ", ";
                $data .= '<a href="javascript:void(0);" title="'.$row['first_name'].' '.$row['last_name'].'" class="'.$class.'" style="color: #000;">'.substr($row['first_name'], 0, 1).substr($row['last_name'], 0, 1).'</a>';
                $i++;
            }else{
                $data = $row['first_name'].' '.$row['last_name'];
            }
        }
        return $data;
    }

    function getStatusChar($status, $oppID = null){
        switch ($status){
            case 'qualifylead':
                $statusChar = 'QL';
                break;
            case 'qualifyOpportunity':
                $statusChar = 'QO'; 
                break;
            case 'qualifyDpr':
                $statusChar = 'QD';
                break;
            case 'qualifyBid':
                $statusChar = 'QB';
                break;
            case 'closure':
                $statusChar = 'CW';
                break;
            case 'Dropping':
                $statusChar = 'DP';
                break;
            default:
                $statusChar = '';
                break;
        }
        if($statusChar == 'CW'){
            $query = "SELECT closure_status_c FROM opportunities_cstm WHERE id_c = '$oppID'";
            $result = $GLOBALS['db']->query($query);
            $result = $GLOBALS['db']->fetchByAssoc($result);
            if($result['closure_status_c'] == 'won'){
                $statusChar = 'CW';
            }else{
                $statusChar = 'CL';
            }
        }
        return $statusChar;
    }

}

?>
