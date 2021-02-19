
<?php

use Robo\Task\File\Concat;

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/MVC/Controller/SugarController.php');
require_once('include/UploadStream.php');

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
        <img src="modules/Home/assets/Filter-icon.svg" style="width:30px" alt="filter-icon" />
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
        <th class="table-header">Amount ( in Cr/Mn )</th>
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
            $created_by_id = $pending_data_opportunity_row['assigned_user_id'];
            $user_name_fetch = "SELECT * FROM users WHERE id='$created_by_id'";
            $user_name_fetch_result = $GLOBALS['db']->query($user_name_fetch);
            $user_name_fetch_row = $GLOBALS['db']->fetchByAssoc($user_name_fetch_result);
            $user_name = $user_name_fetch_row['user_name'];
            $first_name = $user_name_fetch_row['first_name'];
            $last_name = $user_name_fetch_row['last_name'];
            $full_name = $first_name .' '. $last_name;
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
            $log_in_user_id = $current_user->id;
            $organiztion_global_count = "SELECT count(*) as org_global_count FROM opportunities WHERE opportunity_type = 'global' AND deleted != 1 AND date_entered >= now() - interval '$day' day";
            $organiztion_count_result = $GLOBALS['db']->query($organiztion_global_count);
            $fetch_organization_count = $GLOBALS['db']->fetchByAssoc($organiztion_count_result);
            $global_organization_count = $fetch_organization_count['org_global_count'];

            $columnFilter = @$_GET;
            //$columnAmount = @$columnFilter['Amount'];
            $columnDepartment = @$columnFilter['new_department_c'];
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
                                    <img src="modules/Home/assets/Filter-icon.svg" style="width:30px" alt="filter-icon" />
                                </button>
                               
                                <button class="cog" id="setting_myBtn" onclick=openSettingDialog("opportunities","action_filter_opportunities_by_status","'.$status_c.'") style="padding:10; border: none !important;">
                                    <i id="setting_myBtn" class="fa fa-list" aria-hidden="true"> </i>
                                </button>';
            if ($log_in_user_id == '1') {
                $data .='<button class="cog download" id="download_btn" class="download-btn" data-type="opportunity" data-action="status" data-value="'.$status_c.'" data-dropped="'.$dropped.'" style="padding:10; border: none !important;">
                            <i class="fa fa-download" aria-hidden="true"> </i>
                        </button>';
            }
            
            $data .= '</div>
                    </div>
                </div>

                </li>

            </ul>
            <tr class="table-header-row">
            <th class="table-header">Name</th>
            <th class="table-header">Primary Responsibility</th>';

            if(!@$_GET['customColumns']):
            /*if($columnAmount){
                $data .= '<th class="table-header">Amount ( in Cr )</th>';
            }*/
            if($columnDepartment){
                $data .= '<th class="table-header">Department</th>';
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
            endif;

            $data .= $this->getColumnFiltersHeader($columnFilter);
            
            $data .= '<th class="table-header">Action</th></tr>';
           //$fetch_by_status = "SELECT * FROM opportunities LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE status_c='$status_c' AND  date_entered BETWEEN '".$intervalDate."' AND '".$todayDate."'  AND deleted != 1";
            if($searchTerm){
                $fetch_by_status = "SELECT opportunities.*, opportunities_cstm.*, 
                CAST(REPLACE(year_quarters.total_input_value, ',', '')as SIGNED) as total_input_value FROM opportunities 
                LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c 
                LEFT JOIN year_quarters ON year_quarters.opp_id = opportunities.id
                WHERE opportunities_cstm.status_c='$status_c' AND opportunities.deleted != 1 AND opportunities.date_entered >= now() - interval '$day' day AND opportunities.name LIKE '%$searchTerm%' ";
            }else{
                $fetch_by_status = "SELECT opportunities.*, opportunities_cstm.*, 
                CAST(REPLACE(year_quarters.total_input_value, ',', '')as SIGNED) as total_input_value FROM opportunities 
                    LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c 
                    LEFT JOIN year_quarters ON year_quarters.opp_id = opportunities.id
                    WHERE opportunities_cstm.status_c='$status_c' AND opportunities.deleted != 1 AND opportunities.date_entered >= now() - interval '$day' day ";
            }

            if($status_c == 'Closed'){
                $fetch_by_status .= ' AND opportunities_cstm.closure_status_c = "won" ';
            }else if($status_c == 'Dropped' ){
                $fetch_by_status = "SELECT opportunities.*, opportunities_cstm.*, 
                CAST(REPLACE(year_quarters.total_input_value, ',', '')as SIGNED) as total_input_value
                FROM opportunities 
                LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c 
                LEFT JOIN year_quarters ON year_quarters.opp_id = opportunities.id
                WHERE opportunities.deleted != 1 AND opportunities.date_entered >= now() - interval '$day' day ";
                if ($dropped) {
                    if ($dropped == 'Dropped') {
                        $fetch_by_status .= "AND status_c='Dropped'";
                    } else {
                        $fetch_by_status .= "AND (status_c='Closed' AND opportunities_cstm.closure_status_c = 'lost')";
                    }
                } else {
                    $fetch_by_status .= "AND (status_c='Dropped')";
                }
            }

            if($_GET['filter'])
                $fetch_by_status .= $this->getFilterQuery();

            /*if($_GET['filter'] && @$_GET['filter-responsibility']){
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
            }*/

            $fetch_by_status .= "  ORDER BY `opportunities`.`date_modified` DESC";

            // echo $fetch_by_status; die;

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
                $created_by_id = $row['assigned_user_id'];
                $user_name_fetch = "SELECT * FROM users WHERE id='$created_by_id'";
                $user_name_fetch_result = $GLOBALS['db']->query($user_name_fetch);
                $user_name_fetch_row = $GLOBALS['db']->fetchByAssoc($user_name_fetch_result);
                $user_name = $user_name_fetch_row['user_name'];
                $first_name = $user_name_fetch_row['first_name'];
                $last_name = $user_name_fetch_row['last_name'];
                if ($user_name_fetch_row['reports_to_id']) {
                    $reports_to = $this->get_user_details_by_id($user_name_fetch_row['reports_to_id']);
                    $reports_to_full_name = ' <i class="fa fa-arrow-right"></i> ' . $reports_to['first_name'] .' '. $reports_to['last_name'];
                } else {
                    $reports_to_full_name = "";
                }
                $full_name = "$first_name  $last_name $reports_to_full_name";
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
                $oppID = $row['id'];
                $data .='<tr>
                            <td class="table-data">';
                $tagged_user_query = "SELECT user_id, count(*) FROM `tagged_user` WHERE `opp_id`='$oppID' GROUP BY user_id";
                $tagged_user_query_fetch = $GLOBALS['db']->query($tagged_user_query);
                $tagged_user_query_fetch_row = $GLOBALS['db']->fetchByAssoc($tagged_user_query_fetch);
                if($tagged_user_query_fetch_row)
                    $tagged_users = $tagged_user_query_fetch_row['user_id'];
                else
                    $tagged_users = '';

                if ((strpos($tagged_users, $log_in_user_id) !== false)) {
                    $data .= $row['name']. ' <i class="fa fa-tag" style="font-size: 12px; color:green"></i>';
                } else {
                    $data .= $row['name'];
                }
                $data .='</td><td class="table-data">'.$full_name.'</td>';

                if(!@$_GET['customColumns']):
                /*if($columnAmount){
                $data .= '<th class="table-header">Amount ( in Cr )</th>';
            }*/
            if($columnDepartment){
                $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label($row['new_department_c'])))).'</td>';
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
                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $this->getModifiedUser($row['assigned_user_id']) )))).'</td>';
                }
                if($columnAttachment){
                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $row['file_url'] ? $row['file_url'] : '' )))).'</td>';
                }
                endif;

                $data .= $this->getColumnFiltersBody($columnFilter, $row);
                        
                        
                        /*<td class="table-data">'.($this->beautify_amount($row['budget_allocated_oppertunity_c'])).'</td>
                                        <td class="table-data">'.($this->beautify_label($row['rfporeoipublished_c'])).'</td>
                                        <td class="table-data">'.date_format(date_create($row['date_closed']),'d/m/Y').'</td>
                                        <td class="table-data"  style="color: blue">'.$closed_by.'</td>
                                        <td class="table-data">'.date_format(date_create($row['date_entered']),'d/m/Y').'</td>*/;
                $data .= '
                    <td class="table-data">
                    <div style="display: flex; width: 150px; align-items: center; padding: 10px; justify-content: space-between; margin:0;">';
                
                $data .= '<button class="tag1" id="reassignmentBtn" style="margin-right: 0px;width: 18px;" onclick="fetchReassignmentDialog(\''.$row['id'].'\')">';
                if ($this->is_reassignment_applicable($row['id'])):
                    $data .= '<i id="reassignment-icon" title="Re-assign User" class="fa fa-user" aria-hidden="true" style="color:black; font-size: 1.8rem;"> </i>';
                endif;
                $data .= '</button>';
                
                $data .= '<button class="tag1" id="deselectBtn" style="margin-right: 0px; width: 18px;" onClick=getSequenceFlow("'.$row['id'].'")>';
                if($this->checkRecentActivity($row['id'])):
                    $data .= '<img id="search-icon" title="Audit Trail" src="modules/Home/assets/Frame-12.svg" alt="svg" style="color: #333333;"/>';   
                endif;
                $data .= '</button>';

                // if ($this->is_tagging_applicable($row['id'])) {
                //     $data .='<button class="tag" id="deselectBtn" onclick="fetchDeselectDialog(\''.$row['id'].'\')">                                            <i id="search-icon" class="fa fa-tag" aria-hidden="true"> </i>
                //             </button>';
                // }
                $data .= '<button class="tag1 action-item-space" id="deselectBtn" onclick="fetchDeselectDialog(\''.$row['id'].'\')">';
                    if ($this->is_tagging_applicable($row['id'])) {
                        $data .='<i id="search-icon" title="Tag/Untag Users" class="fa fa-tag" aria-hidden="true"> </i>';
                    }
                    $data .= '</button>';
                $data .='<a href="index.php?action=DetailView&module=Opportunities&record='.$row['id'].'" class="eye" id="search-btn">
                        <i id="search-icon" title="View" class="fa fa-eye" aria-hidden="true"> </i>
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

            $columnFilterHtml = $this->getColumnFilters($status_c);
            $filters            = $this->getFilterHtml('opportunity', $columnFilter);

            echo json_encode(array(
                'data'          => $data,
                'columnFilter'  => $columnFilterHtml,
                'filters'       => $filters
            ));

            //echo $data;
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
            //$columnAmount = @$columnFilter['Amount'];
            $columnDepartment = @$columnFilter['new_department_c'];
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
                                    <img src="modules/Home/assets/Filter-icon.svg" style="width:30px" alt="filter-icon" />
                                </button>
                               
                                <button class="cog" id="setting_myBtn" onclick=openSettingDialog("opportunities","action_filter_by_opportunity_type","'.$type.'") style="padding:10; border: none !important;">
                                    <i id="setting_myBtn" class="fa fa-list" aria-hidden="true"> </i>
                                </button>';
                                if ($log_in_user_id == '1') {
                                    $data .='<button class="cog download" id="download_btn" class="download-btn" data-type="opportunity" data-action="type" data-value="'.$type.'" style="padding:10; border: none !important;">
                                                <i class="fa fa-download" aria-hidden="true"> </i>
                                            </button>';
                                }
                                
                                $data .= '</div>
                        </div>
                    </div>

                </li>

            </ul>
            <tr class="table-header-row">
            <th class="table-header">Name</th>
            <th class="table-header">Primary Responsibility</th>';

            if(!@$_GET['customColumns']):
            /*if($columnAmount){
                $data .= '<th class="table-header">Amount ( in Cr )</th>';
            }*/
            if($columnDepartment){
                $data .= '<th class="table-header">Department</th>';
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
            endif;

            $data .= $this->getColumnFiltersHeader($columnFilter);

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


            /*if($_GET['filter'] && @$_GET['filter-responsibility']){
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
            }*/
            
            if($_GET['filter'])
                $fetch_query .= $this->getFilterQuery();

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
                $created_by_id = $row['assigned_user_id'];
                $user_name_fetch = "SELECT * FROM users WHERE id='$created_by_id'";
                $user_name_fetch_result = $GLOBALS['db']->query($user_name_fetch);
                $user_name_fetch_row = $GLOBALS['db']->fetchByAssoc($user_name_fetch_result);
                $user_name = $user_name_fetch_row['user_name'];
                $first_name = $user_name_fetch_row['first_name'];
                $last_name = $user_name_fetch_row['last_name'];
                if ($user_name_fetch_row['reports_to_id']) {
                    $reports_to = $this->get_user_details_by_id($user_name_fetch_row['reports_to_id']);
                    $reports_to_full_name = ' <i class="fa fa-arrow-right"></i> ' . $reports_to['first_name'] .' '. $reports_to['last_name'];
                } else {
                    $reports_to_full_name = "";
                }
                $full_name = "$first_name  $last_name $reports_to_full_name";
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
                $oppID = $row['id'];
                $data .='<tr>
                            <td class="table-data">';
                $tagged_user_query = "SELECT user_id, count(*) FROM `tagged_user` WHERE `opp_id`='$oppID' GROUP BY user_id";
                $tagged_user_query_fetch = $GLOBALS['db']->query($tagged_user_query);
                $tagged_user_query_fetch_row = $GLOBALS['db']->fetchByAssoc($tagged_user_query_fetch);
                $tagged_users = $tagged_user_query_fetch_row['user_id'];
                if ((strpos($tagged_users, $log_in_user_id) !== false)) {
                    $data .= $row['name']. ' <i class="fa fa-tag" style="font-size: 12px; color:green"></i>';
                } else {
                    $data .= $row['name'];
                }
                $data .='</td><td class="table-data">'.$full_name.'</td>';

                if(!@$_GET['customColumns']):
                /*if($columnAmount){
                $data .= '<th class="table-header">Amount ( in Cr )</th>';
            }*/
            if($columnDepartment){
                $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label($row['new_department_c'])))).'</td>';
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
                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $this->getModifiedUser($row['assigned_user_id']) )))).'</td>';
                }
                if($columnAttachment){
                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $row['file_url'] ? $row['file_url'] : '' )))).'</td>';
                }
                endif;

                $data .= $this->getColumnFiltersBody($columnFilter, $row);
                        
                        
                /*<td class="table-data">'.($this->beautify_amount($row['budget_allocated_oppertunity_c'])).'</td>
                    <td class="table-data">'.($this->beautify_label($row['rfporeoipublished_c'])).'</td>
                    <td class="table-data">'.date_format(date_create($row['date_closed']),'d/m/Y').'</td>
                    <td class="table-data"  style="color: blue">'.$closed_by.'</td>
                    <td class="table-data">'.date_format(date_create($row['date_entered']),'d/m/Y').'</td>*/;

                $data .= '
                    <td class="table-data">
                    <div style="display: flex; width: 150px; align-items: center; padding: 10px; justify-content: space-between; margin: 0;">';

                $data .= '<button class="tag1" id="reassignmentBtn" style="margin-right: 0px;width: 18px;" onclick="fetchReassignmentDialog(\''.$row['id'].'\')">';
                if ($this->is_reassignment_applicable($row['id'])):
                    $data .= '<i id="reassignment-icon" title="Re-assign User" class="fa fa-user" aria-hidden="true" style="color:black; font-size: 1.8rem;"> </i>';
                endif;
                $data .= '</button>';

                $data .= '<button class="tag1" id="deselectBtn" style="margin-right: 0px;width: 18px;" onClick=getSequenceFlow("'.$row['id'].'")>';
                if($this->checkRecentActivity($row['id'])):
                    $data .= '<img id="search-icon" title="Audit Trail" src="modules/Home/assets/Frame-12.svg" alt="svg" style="color: #333333;"/>';   
                endif;
                $data .= '</button>';

                // if ($this->is_tagging_applicable($row['id'])) {
                //     $data .='<button class="tag" id="deselectBtn" onclick="fetchDeselectDialog(\''.$row['id'].'\')">                                            <i id="search-icon" class="fa fa-tag" aria-hidden="true"> </i>
                //             </button>';
                // }
                $data .= '<button class="tag1 action-item-space" id="deselectBtn" onclick="fetchDeselectDialog(\''.$row['id'].'\')">';
                if ($this->is_tagging_applicable($row['id'])) {
                    $data .='<i id="search-icon" title="Tag/Untag Users" class="fa fa-tag" aria-hidden="true"> </i>';
                }
                $data .= '</button>';
                $data .='
                        <a href="index.php?action=DetailView&module=Opportunities&record='.$row['id'].'" class="eye" id="search-btn">
                        <i id="search-icon" title="View" class="fa fa-eye" aria-hidden="true"> </i>
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

            $columnFilterHtml = $this->getColumnFilters();
            $filters            = $this->getFilterHtml('opportunity', $columnFilter);
            echo json_encode(array(
                'data'          => $data,
                'columnFilter'  => $columnFilterHtml,
                'filters'       => $filters
            ));

            //echo $data;
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
            //$columnAmount = @$columnFilter['Amount'];
            $columnDepartment = @$columnFilter['new_department_c'];
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

            setcookie('day', $day, time() + (86400 * 30), '/');

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

           $fetch_self_count = "SELECT count(*) as self_count FROM opportunities LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE  assigned_user_id='$log_in_user_id' AND deleted != 1 AND date_entered >= now() - interval '$day' day";
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

                $fetch_self_count_by_status = "SELECT count(*) as self_count_by_status FROM opportunities LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE status_c= '".$row['status_c']."' AND assigned_user_id='$log_in_user_id' AND deleted != 1 AND date_entered >= now() - interval '$day' day";
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
                    $closed_lost_count_self_query = "SELECT count(*) as lost_count FROM opportunities o LEFT JOIN opportunities_cstm oc ON o.id = oc.id_c WHERE o.deleted != 1 AND o.date_entered >= now() - interval '$day' day AND oc.status_c='Closed' AND oc.closure_status_c ='lost' AND assigned_user_id='$log_in_user_id'";
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
                                    <img src="modules/Home/assets/Filter-icon.svg" style="width:30px" alt="filter-icon" />
                                </button>
                             

                                <button class="cog" id="setting_myBtn" onclick=openSettingDialog("opportunities","action_show_data_between_date") style="padding:10; border: none !important;">
                                    <i id="setting_myBtn" class="fa fa-list" aria-hidden="true"> </i>
                                </button>';
                                if ($log_in_user_id == '1') {
                                    $data .='<button class="cog download" id="download_btn" class="download-btn" data-type="opportunity" data-action="dayFilter" data-value="'.$day.'" style="padding:10; border: none !important;">
                                                <i class="fa fa-download" aria-hidden="true"> </i>
                                            </button>';
                                }
                                
                                $data .= '</div>
                        </div>
                    </div>

                </li>

            </ul>
            <tr class="table-header-row">
                <th class="table-header">Name</th>
                <th class="table-header">Primary Responsibility</th>';
            
            if(!@$_GET['customColumns']):

            /*if($columnAmount){
                $data .= '<th class="table-header">Amount ( in Cr )</th>';
            }*/
            if($columnDepartment){
                $data .= '<th class="table-header">Department</th>';
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

            endif; 

            $data .= $this->getColumnFiltersHeader($columnFilter);


            $data .= '<th class="table-header text-center">Action</th>
            </tr>';

            if($searchTerm){
                $fetch_query = "SELECT opportunities.*, opportunities_cstm.*,
                CAST(REPLACE(year_quarters.total_input_value, ',', '')as SIGNED) as total_input_value FROM opportunities
                    LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c 
                    LEFT JOIN year_quarters ON year_quarters.opp_id = opportunities.id
                    WHERE opportunities.deleted != 1 AND opportunities.date_entered >= now() - interval '$day' day AND opportunities.name LIKE '%$searchTerm%' ";
            }else{
                $fetch_query = "SELECT opportunities.*, opportunities_cstm.*,
                CAST(REPLACE(year_quarters.total_input_value, ',', '')as SIGNED) as total_input_value FROM opportunities
                    LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c 
                    LEFT JOIN year_quarters ON year_quarters.opp_id = opportunities.id
                    WHERE deleted != 1 AND date_entered >= now() - interval '$day' day ";
            }

            if($_GET['filter'])
                $fetch_query .= $this->getFilterQuery();

            $fetch_query .= " ORDER BY `opportunities`.`date_modified` DESC";

            // echo $fetch_query; die;

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
                $created_by_id = $row['assigned_user_id'];
                $user_name_fetch = "SELECT * FROM users WHERE id='$created_by_id'";
                $user_name_fetch_result = $GLOBALS['db']->query($user_name_fetch);
                $user_name_fetch_row = $GLOBALS['db']->fetchByAssoc($user_name_fetch_result);
                $user_name = $user_name_fetch_row['user_name'];
                $first_name = $user_name_fetch_row['first_name'];
                $last_name = $user_name_fetch_row['last_name'];
                if ($user_name_fetch_row['reports_to_id']) {
                    $reports_to = $this->get_user_details_by_id($user_name_fetch_row['reports_to_id']);
                    $reports_to_full_name = ' <i class="fa fa-arrow-right"></i> ' . $reports_to['first_name'] .' '. $reports_to['last_name'];
                } else {
                    $reports_to_full_name = "";
                }
                $full_name = "$first_name  $last_name $reports_to_full_name";
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
                $oppID = $row['id'];
                $data .='<tr>
                            <td class="table-data">';
                $tagged_user_query = "SELECT user_id, count(*) FROM `tagged_user` WHERE `opp_id`='$oppID' GROUP BY user_id";
                $tagged_user_query_fetch = $GLOBALS['db']->query($tagged_user_query);
                $tagged_user_query_fetch_row = $GLOBALS['db']->fetchByAssoc($tagged_user_query_fetch);
                $tagged_users = '';
                if($tagged_user_query_fetch_row)
                    $tagged_users = $tagged_user_query_fetch_row['user_id'];

                if ((strpos($tagged_users, $log_in_user_id) !== false)) {
                    $data .= $row['name']. ' <i class="fa fa-tag" style="font-size: 12px; color:green"></i>';
                } else {
                    $data .= $row['name'];
                }
                $data .='</td><td class="table-data">'.$full_name.'</td>';

                if(!@$_GET['customColumns']):

                /*if($columnAmount){
                $data .= '<th class="table-header">Amount ( in Cr )</th>';
            }*/
            if($columnDepartment){
                $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label($row['new_department_c'])))).'</td>';
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
                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $this->getModifiedUser($row['assigned_user_id']) )))).'</td>';
                }
                if($columnAttachment){
                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $row['file_url'] ? $row['file_url'] : '' )))).'</td>';
                }

                endif; 

                $data .= $this->getColumnFiltersBody($columnFilter, $row);
                
                $data .= '<td class="table-data">
                        <div style="display: flex; width: 150px; align-items: center; padding: 10px; justify-content: space-between; margin: 0;">';
                
                $data .= '<button class="tag1" id="reassignmentBtn" style="margin-right: 0px;width: 18px;" onclick="fetchReassignmentDialog(\''.$row['id'].'\')">';
                if ($this->is_reassignment_applicable($row['id'])):
                    $data .= '<i id="reassignment-icon" title="Re-assign User" class="fa fa-user" aria-hidden="true" style="color:black; font-size: 1.8rem;"> </i>';
                endif;
                $data .= '</button>';

                $data .= '<button class="tag1" id="deselectBtn" style="margin-right: 0px;width: 18px;" onClick=getSequenceFlow("'.$row['id'].'")>';
                if($this->checkRecentActivity($row['id'])):
                    $data .= '<img id="search-icon" title="Audit Trail" src="modules/Home/assets/Frame-12.svg" alt="svg" style="color: #333333;"/>';   
                endif;
                $data .= '</button>';

                $data .= '<button class="tag1" id="deselectBtn" onclick="fetchDeselectDialog(\''.$row['id'].'\')" style="margin-right: 0px;width: 18px;">';
                if ($this->is_tagging_applicable($row['id'])) {
                    $data .='<i id="search-icon" title="Tag/Untag Users" class="fa fa-tag" aria-hidden="true"> </i>';
                }
                $data .= '</button>';
                $data .='
                      <a href="index.php?action=DetailView&module=Opportunities&record='.$row['id'].'" class="eye" id="search-btn">
                        <i id="search-icon" title="View" class="fa fa-eye" aria-hidden="true"> </i>
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


            $columnFilterHtml   = $this->getColumnFilters();
            $filters            = $this->getFilterHtml('opportunity', $columnFilter);

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
                'fetched_by_status'         =>  $fetch_by_status,
                'columnFilter'              => $columnFilterHtml,
                'filters'                   => $filters
            ));
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }

    public function get_delegated_user($log_in_user_id) {
        $fetch_query = "SELECT Count(*)as count, opportunities_cstm.delegate as delegate FROM opportunities
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
            $closed_lost_count_self_query = "SELECT count(*) as lost_count FROM opportunities o LEFT JOIN opportunities_cstm oc ON o.id = oc.id_c WHERE o.deleted != 1 AND o.date_entered >= now() - interval '$day' day AND oc.status_c='Closed' AND oc.closure_status_c ='lost' AND assigned_user_id='$log_in_user_id'";
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
            $created_by_id = $row['assigned_user_id'];
            $user_name_fetch = "SELECT * FROM users WHERE id='$created_by_id'";
            $user_name_fetch_result = $GLOBALS['db']->query($user_name_fetch);
            $user_name_fetch_row = $GLOBALS['db']->fetchByAssoc($user_name_fetch_result);
            $user_name = $user_name_fetch_row['user_name'];
            $first_name = $user_name_fetch_row['first_name'];
            $last_name = $user_name_fetch_row['last_name'];
            if ($user_name_fetch_row['reports_to_id']) {
                    $reports_to = $this->get_user_details_by_id($user_name_fetch_row['reports_to_id']);
                    $reports_to_full_name = ' <i class="fa fa-arrow-right"></i> ' . $reports_to['first_name'] .' '. $reports_to['last_name'];
                } else {
                    $reports_to_full_name = "";
                }
                $full_name = "$first_name  $last_name $reports_to_full_name";

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
                        <th>Amount (in Cr/Mn)</th>
                        <th>RFP/EOI Published</th>
                        <th>Modified Date</th>
                        <th>Modified By</th>
                        <th>Date Created</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr class="tabvalue">
                        <td>' . $full_name . '</td>
                        <td>' . $this->append_currency($row['currency_c'], $this->beautify_amount($row["budget_allocated_oppertunity_c"])) . '</td>
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
        $full_name = '';
        $query = "SELECT first_name,last_name FROM users WHERE id = '$v'";
        $result = $GLOBALS['db']->query($query);
        $result_row = $GLOBALS['db']->fetchByAssoc($result);
        if($result_row){
            $first_name = $result_row['first_name'];
            $last_name = $result_row['last_name'];
            $full_name = "$first_name $last_name";
        }
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
            $data = $delegated_user_id;
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
        $string = str_replace('_', ' ', $string);
        $string = str_replace('^', '', $string);
        $string = str_replace(',', ', ', $string);
        $string = preg_replace('/(?<!\ )[A-Z]/', ' $0', $string);
        return ucwords($string);
    }
    public function beautify_label_n_f($string) {
        $string = str_replace('_', '', $string);
        if (strpos($string, '^PilotforFutureOpportunity^') !== false) {
            $string = str_replace('^PilotforFutureOpportunity^', '^PilotForFutureOpportunity^', $string);
        }
        if (strpos($string, '^StrategicAlignmentforFutureOpportunity^') !== false) {
            $string = str_replace('^StrategicAlignmentforFutureOpportunity^', '^StrategicAlignmentForFutureOpportunity^', $string);
        }
        return $this->beautify_label($string);
    }

    public function beautify_amount($amount) {
        return preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $amount);
    }

    public function append_currency($oppCurrency, $amount) {
        if ($amount != '') {
            $symbol = ($oppCurrency == 'USD') ? '$' : '₹';
            $unit = ($oppCurrency == 'USD') ? ' Mn' : ' Cr';
            $amount = $symbol . $amount . $unit;
        }
        return $amount;
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
            global $current_user;
            $log_in_user_id = $current_user->id;

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
                                    <img src="modules/Home/assets/Filter-icon.svg" style="width:30px" alt="filter-icon" />
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
            <th class="table-header">Amount ( in Cr/Mn )</th>
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
                    $custom_filter_query .= " AND assigned_user_id = '$responsibility'";
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
                    $created_by_id = $row['assigned_user_id'];
                    $user_name_fetch = "SELECT * FROM users WHERE id='$created_by_id'";
                    $user_name_fetch_result = $GLOBALS['db']->query($user_name_fetch);
                    $user_name_fetch_row = $GLOBALS['db']->fetchByAssoc($user_name_fetch_result);
                    $user_name = $user_name_fetch_row['user_name'];
                    $first_name = $user_name_fetch_row['first_name'];
                    $last_name = $user_name_fetch_row['last_name'];
                    if ($user_name_fetch_row['reports_to_id']) {
                    $reports_to = $this->get_user_details_by_id($user_name_fetch_row['reports_to_id']);
                    $reports_to_full_name = ' <i class="fa fa-arrow-right"></i> ' . $reports_to['first_name'] .' '. $reports_to['last_name'];
                } else {
                    $reports_to_full_name = "";
                }
                $full_name = "$first_name  $last_name $reports_to_full_name";
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
                    $oppID = $row['id'];
                    $data .='<tr>
                                <td class="table-data">';
                    $tagged_user_query = "SELECT user_id, count(*) FROM `tagged_user` WHERE `opp_id`='$oppID' GROUP BY user_id";
                    $tagged_user_query_fetch = $GLOBALS['db']->query($tagged_user_query);
                    $tagged_user_query_fetch_row = $GLOBALS['db']->fetchByAssoc($tagged_user_query_fetch);
                    $tagged_users = $tagged_user_query_fetch_row['user_id'];
                    if ((strpos($tagged_users, $log_in_user_id) !== false)) {
                        $data .= $row['name']. ' <i class="fa fa-tag" style="font-size: 12px; color:green"></i>';
                    } else {
                        $data .= $row['name'];
                    }
                    $data .='
                    </td><td class="table-data">'.$full_name.'</td>
                    <td class="table-data">'.($this->append_currency( $row['currency_c'], $this->beautify_amount($row['budget_allocated_oppertunity_c']))).'</td>
                    <td class="table-data">'.($this->beautify_label($row['rfporeoipublished_c'])).'</td>
                    <td class="table-data">'.date_format(date_create($row['date_modified']),'d/m/Y').'</td>
                    <td class="table-data">'.$closed_by.'</td>
                    <td class="table-data">'.date_format(date_create($row['date_entered']),'d/m/Y').'</td>
                    <td class="table-data">
                    <div style="display: flex; width: 150px; align-items: center; padding: 10px; justify-content: space-between; margin:0;">';
                    
                    $data .= '<button class="tag1" id="reassignmentBtn" style="margin-right: 0px;width: 18px;" onclick="fetchReassignmentDialog(\''.$row['id'].'\')">';
                    if ($this->is_reassignment_applicable($row['id'])):
                        $data .= '<i id="reassignment-icon" title="Re-assign User" class="fa fa-user" aria-hidden="true" style="color:black; font-size: 1.8rem;"> </i>';
                    endif;
                    $data .= '</button>';

                    $data .= '<button class="tag1 action-item-space" id="deselectBtn" onclick="fetchDeselectDialog(\''.$row['id'].'\')">';
                    if ($this->is_tagging_applicable($row['id'])) {
                        $data .='<i id="search-icon" title="Tag/Untag Users" class="fa fa-tag" aria-hidden="true"> </i>';
                    }
                    $data .= '</button>';
                    $data .='
                      <a href="index.php?action=DetailView&module=Opportunities&record='.$row['id'].'" class="eye" id="search-btn">
                        <i id="search-icon" title="View" class="fa fa-eye" aria-hidden="true"> </i>
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
                                    <img src="modules/Home/assets/Filter-icon.svg" style="width:30px" alt="filter-icon" />
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
            //$columnAmount = @$columnFilter['Amount'];
            $columnDepartment = @$columnFilter['new_department_c'];
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
                                                <img src="modules/Home/assets/Filter-icon.svg" style="width:30px" alt="filter-icon" />
                                            </button>

                                            <button class="cog" id="setting_myBtn" onclick=openPendingSettingsDialog("pendings","action_filter_by_opportunity_status","'.$status.'") style="padding:10; border: none !important;">
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

                        if(!@$_GET['customColumns']):

                        /*if($columnAmount){
                $data .= '<th class="table-header">Amount ( in Cr )</th>';
            }*/
            if($columnDepartment){
                $data .= '<th class="table-header">Department</th>';
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
                        endif;

                        $data .= $this->getColumnFiltersHeader($columnFilter);
                        
                    $data .= '<th class="table-header">Action</th></tr>';
                
            /* $fetch_query = "SELECT o.*, oc.* FROM opportunities AS o LEFT JOIN opportunities_cstm oc ON o.id = oc.id_c JOIN (
                    SELECT *, count(opp_id) as opp_count  FROM approval_table GROUP BY opp_id ORDER BY id DESC
                ) AS ap ON o.id = ap.opp_id AND ap.opp_count = 1
                WHERE oc.user_id2_c = '$log_in_user_id' AND ap.apply_for = '".$status."' AND ap.Approved = 0 AND ap.pending = 1 AND o.deleted != 1 AND date_entered >= now() - interval '$day' day";*/
            
            /*$fetch_query = " SELECT o.*, oc.* FROM opportunities AS o JOIN opportunities_cstm oc ON o.id = oc.id_c
                WHERE ( oc.user_id2_c = '$log_in_user_id' OR oc.delegate = '$log_in_user_id' ) AND o.deleted != 1 AND date_entered >= now() - interval '$day' day ";*/
            
            $maxQuery = "SELECT row_count FROM approval_table ap WHERE ap.Approved = 0 AND ap.Rejected = 0 AND ap.pending = 1 AND ( ap.approver_rejector = '$log_in_user_id' OR ap.delegate_id = '$log_in_user_id' ) AND ap.apply_for = '$status' ORDER BY row_count DESC LIMIT 1";
            $result = $GLOBALS['db']->query($maxQuery);
            $rowCount = $GLOBALS['db']->fetchByAssoc($result);
            if($rowCount)
                $rowCount = $rowCount['row_count'];

            $fetch_query = "SELECT ap.id as approval_id, ap.delegate_id as delegate_id, opportunities.*, opportunities_cstm.*, 
            CAST(REPLACE(year_quarters.total_input_value, ',', '')as SIGNED) as total_input_value FROM approval_table ap";
            $fetch_query .= " JOIN opportunities ON opportunities.id = ap.opp_id";
            $fetch_query .= " JOIN opportunities_cstm ON opportunities_cstm.id_c = ap.opp_id";
            $fetch_query .= " LEFT JOIN year_quarters ON year_quarters.opp_id = opportunities.id";
            $fetch_query .= " WHERE ap.Approved = 0 AND ap.Rejected = 0 AND ap.pending = 1 AND opportunities.deleted != 1 AND opportunities.date_entered >= now() - interval '1200' day AND ( ap.approver_rejector = '$log_in_user_id' OR ap.delegate_id = '$log_in_user_id' ) AND ap.apply_for = '$status'";
            if($rowCount)
                $fetch_query .= " AND ap.row_count = '$rowCount'";
            
            /*if($_GET['filter'] && @$_GET['filter-responsibility']){
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
            }*/
            if($_GET['filter'])
                $fetch_query .= $this->getFilterQuery();

            $fetch_query .= "  ORDER BY `opportunities`.`date_modified` DESC";

            // echo $fetch_query; die;

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
                $created_by_id = $row['assigned_user_id'];
                $user_name_fetch = "SELECT * FROM users WHERE id='$created_by_id'";
                $user_name_fetch_result = $GLOBALS['db']->query($user_name_fetch);
                $user_name_fetch_row = $GLOBALS['db']->fetchByAssoc($user_name_fetch_result);

                $user_name = $user_name_fetch_row['user_name'];
                $first_name = $user_name_fetch_row['first_name'];
                $last_name = $user_name_fetch_row['last_name'];
                if ($user_name_fetch_row['reports_to_id']) {
                    $reports_to = $this->get_user_details_by_id($user_name_fetch_row['reports_to_id']);
                    $reports_to_full_name = ' <i class="fa fa-arrow-right"></i> ' . $reports_to['first_name'] .' '. $reports_to['last_name'];
                } else {
                    $reports_to_full_name = "";
                }
                $full_name = "$first_name  $last_name $reports_to_full_name";

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
                        $oppID = $row['id'];
                        $data .='<tr>
                                    <td class="table-data">';
                        $tagged_user_query = "SELECT user_id, count(*) FROM `tagged_user` WHERE `opp_id`='$oppID' GROUP BY user_id";
                        $tagged_user_query_fetch = $GLOBALS['db']->query($tagged_user_query);
                        $tagged_user_query_fetch_row = $GLOBALS['db']->fetchByAssoc($tagged_user_query_fetch);
                        $tagged_users = $tagged_user_query_fetch_row['user_id'];
                        $delegated_u_id = $row['delegate_id'];
                        if ((strpos($tagged_users, $log_in_user_id) !== false)) {
                            $data .= $row['name']. ' <i class="fa fa-tag" style="font-size: 12px; color:green"></i>';
                        } else if (strpos($delegated_u_id, $log_in_user_id) !== false) {
                            $data .= $row['name']. ' <img src="modules/Home/assets/Delegate-icon.svg" style="width: 25px; color:green" />';
                        } else {
                            $data .= $row['name'];
                        }
                        $data .='
                                </td><td class="table-data">'.$full_name.'</td>
                                
                                <td class="table-data" style="text-align: center">'.$this->pendingApprovalStatus($row['id'], $status).'</td>';

                                if(!@$_GET['customColumns']):
                                /*if($columnAmount){
                $data .= '<th class="table-header">Amount ( in Cr )</th>';
            }*/
            if($columnDepartment){
                $data .= '<th class="table-header">Department</th>';
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
                                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $this->getModifiedUser($row['assigned_user_id']) )))).'</td>';
                                }
                                if($columnAttachment){
                                    $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label( $row['file_url'] ? $row['file_url'] : '' )))).'</td>';
                                }
                                endif;

                                $data .= $this->getColumnFiltersBody($columnFilter, $row);
                            
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

            $columnFilterHtml = $this->getColumnFilters($status, 'pending');
            $filters          = $this->getFilterHtml('opportunity', $columnFilter);

            echo json_encode(array(
                'data'          => $data,
                'columnFilter'  => $columnFilterHtml,
                'filters'       => $filters
            ));

            //echo $data;
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

        $maxQuery = "SELECT row_count FROM approval_table ap WHERE ap.Approved = 0 AND ap.Rejected = 0 AND ap.pending = 1 AND ( ap.approver_rejector = '$log_in_user_id' OR ap.delegate_id = '$log_in_user_id' )";
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

                $created_by_id = $row['assigned_user_id'];
                $user_name_fetch = "SELECT * FROM users WHERE id='$created_by_id'";
                $user_name_fetch_result = $GLOBALS['db']->query($user_name_fetch);
                $user_name_fetch_row = $GLOBALS['db']->fetchByAssoc($user_name_fetch_result);

                $user_name = $user_name_fetch_row['user_name'];
                $first_name = $user_name_fetch_row['first_name'];
                $last_name = $user_name_fetch_row['last_name'];
                if ($user_name_fetch_row['reports_to_id']) {
                    $reports_to = $this->get_user_details_by_id($user_name_fetch_row['reports_to_id']);
                    $reports_to_full_name = ' <i class="fa fa-arrow-right"></i> ' . $reports_to['first_name'] .' '. $reports_to['last_name'];
                } else {
                    $reports_to_full_name = "";
                }
                $full_name = "$first_name  $last_name $reports_to_full_name";
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
                                    <td class="approvaltable-data-popup">'.$this->append_currency($row['currency_c'], $this->beautify_amount($row['budget_allocated_oppertunity_c'])).'</td>
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
                $created_by=$row['assigned_user_id'];
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
        try {
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
            echo json_encode(
                array(
                      'data' => $PRC . '<i class="fa fa-angle-double-down" aria-hidden="true"></i>',
                      'count' => $PRC
                    ));
        }
        catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
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
            $data .= '<div style="width: '.$LeadCount.'%" class="graph-bar-each">
                    <div style="width: 100%;height: 70px;background-color: #DDA0DD;"></div>
                    <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$LeadCount.'%</p>
                </div>';
        endif;

        if($QualifiedLeadCount):
            $data .= '<div style="width: '.$QualifiedLeadCount.'%" class="graph-bar-each">
                    <div style="width: 100%;height: 70px;background-color: #4B0082;"></div>
                    <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$QualifiedLeadCount.'%</p>
                </div>';
        endif;
        
        if($QualifiedOpporunityCount):
            $data .= '<div style="width: '.$QualifiedOpporunityCount.'%" class="graph-bar-each">
                    <div style="width: 100%; height: 70px; background-color: #0000FF;"></div>
                    <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$QualifiedOpporunityCount.'%</p>
                </div>';
        endif;

        if($QualifiedDPR):
            $data .= '<div style="width: '.$QualifiedDPR.'%" class="graph-bar-each">
                    <div style="width: 100%; height: 70px; background-color: #FFFF00;"></div>
                    <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$QualifiedDPR.'%</p>
                </div>';
        endif; 

        if($QualifiedBid):
            $data .= '<div style="width: '.$QualifiedBid.'%" class="graph-bar-each">
                    <div style="width: 100%; height: 70px; background-color: #00FF00;"></div>
                    <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$QualifiedBid.'%</p>
                </div>';
        endif;
        
        if($Close):
            if($CloseWon):
                $data .= '<div style="width: '.$CloseWon.'%" class="graph-bar-each">
                        <div style="width: 100%; height: 70px; background-color: #006400;"></div>
                        <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$CloseWon.'%</p>
                    </div>';
            endif;
            if($CloseLost):
                $data .= '<div style="width: '.$CloseLost.'%" class="graph-bar-each">
                        <div style="width: 100%; height: 70px; background-color: #FF7F00;"></div>
                        <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$CloseLost.'%</p>
                    </div>';
            endif;
        endif; 

        if($Drop):
            $data .= '<div style="width: '.$Drop.'%" class="graph-bar-each">
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

            $query = "SELECT name,created_by,assigned_user_id FROM opportunities WHERE id = '$oppID'";
            $result = $GLOBALS['db']->query($query);
            $result = $GLOBALS['db']->fetchByAssoc($result);
            $created_by = $result['created_by'];
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
            $user = $this->get_user_details_by_id($created_by);
            $first_name = $user['first_name'];
            $last_name = $user['last_name'];
            $full_name = "$first_name $last_name";
            $data .= '<div class="approved">';
            $data .= '<!-- For Lead stage -->
                    <div class="row half-padding-tb">
                        <div class="d-inline-block w-50">                            
                            <h5><span class="status-badge-green-b">L</span>
                            <span class="line-bottom green"></span> 
                            <span style="font-size: 12px;margin:0">'.$full_name.'</span></h5> 
                        </div>
                        <div class="d-inline-block w-50 align-self-end text-right">
                            <h5 class="gray-color">'.$updateDate.'</h5>
                        </div>
                    </div>';
            $query = "select u.first_name, u.last_name, ap.opp_id, ap.date_time, ap.apply_for,ap.assigned_by, ap.Approved, ap.Rejected, ap.pending, ap.assign from 
            ( (select opp_id , assigned_to_id, date_time, 'Reassignment' as apply_for, assigned_by, 0 as Approved, 0 as Rejected, 0 as pending, 1 as assign from assign_flow where opp_id ='$oppID'
            and (NOT (assigned_to_id ='$created_by' and status='Lead' and assigned_by ='$created_by')))
            union (select opp_id , approver_rejector as assigned_to_id,updated_at as date_time, apply_for, '' as assigned_by, Approved, Rejected, pending, 0 as assign from approval_table where opp_id ='$oppID') ) ap 
            JOIN users u ON u.id = ap.assigned_to_id order by date_time ASC";
            $result = $GLOBALS['db']->query($query);
            while($row = $GLOBALS['db']->fetchByAssoc($result)){
                $full_name = $row['first_name'].' '.$row['last_name'];
                $class = '';
                
                if($row['Approved'] == 1){
                    $class = 'status-badge-green-b';
                    $lineClass = 'green';
                }else if($row['Rejected'] == 1){
                    $class = 'status-badge-red-b';
                    $lineClass = 'red';
                } else if($row['pending'] == 1) {
                    $class = 'status-badge-yellow-b';
                    $lineClass = 'yellow';
                } else if ($row['assign'] == 1) {
                    $class = 'status-badge-blue-b';
                    $lineClass = 'blue';
                    $assigned_by = $this->getUserName($row['assigned_by']);
                    $full_name = $assigned_by. ' <i class="fa fa-arrow-right"></i> ' . $full_name;
                }
                
                $dateExtracted = substr($row['date_time'],4,11);
                $updateDate = date('d/m/Y', strtotime($dateExtracted));

                //$data .= '<a href="javascript:void(0);" title="'.$row['first_name'].' '.$row['last_name'].'" class="label '.$class.'">'.substr($row['first_name'], 0, 1).substr($row['last_name'], 0, 1).'</a>';
                $data .= '<!-- single -->
                    <div class="row half-padding-tb">
                        <div class="d-inline-block" style="width:75%">
                            <!--<h5><span class="status-badge-green-b">'.$this->getStatusChar($row['apply_for'],$row['opp_id']).'</span> 
                            <span class="line-bottom"></span> '.$this->getApproverNames($row['opp_id'], $row['apply_for'], 0).'</h5> -->
                            
                            <h5><span class="'.$class.'">'.$this->getStatusChar($row['apply_for'],$row['opp_id']).'</span> 
                            <span class="line-bottom '.$lineClass.'"></span> 
                            <span style="font-size: 12px;margin:0">'.$full_name.'</span></h5> 
                        </div>
                        <div class="d-inline-block align-self-end text-right" style="width:25%">
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
            case 'Reassignment':
                $statusChar = 'R';
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


    function getColumnFilters($status = null, $type = null){
        /* Default Columns */
        if($type){
            $columnFilterHtml = '<form class="pending-settings-form sort-column">';
            $columnFilterHtml .= '<input type="hidden" name="settings-section" class="pending-settings-section" value="" />
            <input type="hidden" name="settings-type" class="pending-settings-type" value="" />
            <input type="hidden" name="settings-type-value" class="pending-settings-type-value" value="" />';
        }else{
            $columnFilterHtml = '<form class="settings-form sort-column">';
            $columnFilterHtml .= '<input type="hidden" name="settings-section" class="settings-section" value="" />
            <input type="hidden" name="settings-type" class="settings-type" value="" />
            <input type="hidden" name="settings-type-value" class="settings-type-value" value="" />';
        }
        $columnFields = $this->opportunityColumns($status);
        $i = 0;
        foreach($columnFields['default'] as $key => $field){
            $style = '';
            if($i <= 1)
                $style = 'class="nondrag" style="pointer-events:none; background: #eeeeef;"';
            
            if($i == 2){
                $columnFilterHtml .= '<ul id="sortable1" class="sortable1 connectedSortable">';
            }

            $columnFilterHtml .= 
                '<li '.$style.'>
                    <input class="settingInputs" type="checkbox" id="name-select" name="'.$key.'" value="'.$key.'" checked="True" style="display: none">
                    <input class="settingInputs" type="checkbox" id="name-select" name="customColumns[]" value="'.$key.'" checked="True" style="display: none">
                    <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> '.$field.'</label>
                </li>';
            $i++;
        }
        $columnFilterHtml .= '</ul></form>';

        /* Addon Columns */
        $columnFilterHtml .= '<div class="divider"></div><ul id="sortable2" class="sortable2 sort-column connectedSortable" style="padding-right: 0; float: right;">';
        foreach($columnFields['addons'] as $key => $field){
            $columnFilterHtml .= 
                '<li>
                    <input class="settingInputs" type="checkbox" id="name-select" name="'.$key.'" value="'.$key.'" checked="True" style="display: none">
                    <input class="settingInputs" type="checkbox" id="name-select" name="customColumns[]" value="'.$key.'" checked="True" style="display: none">
                    <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> '.$field.'</label>
                </li>';
        }
        $columnFilterHtml .= '</ul>';

        return $columnFilterHtml;
    }

    function opportunityColumns($status = null){
        $fields = array();
        
        $default = array(
            'name'                  => 'Opportunity Name',
            'Primary-Responsbility' => 'Primary Responsibility',
            //'Amount'                => 'Amount (in Cr/Mn)',
            'new_department_c'      => 'Department',
            'REP-EOI-Published'     => 'RFP/EOI Published',
            'Closed-Date'           => 'Modified Date',
            'Closed-by'             => 'Modified By',
            'Date-Created'          => 'Created Date',
        );
        
        $default2 = array(
            'multiple_approver_c'           => 'Approver',
            'state_c'                       => 'State',
            
            'source_c'                      => 'Source',
            'non_financial_consideration_c' => 'Non Financial Consideration',
            'segment_c'                     => 'Segment',
            'product_service_c'             => 'Product/ Service',
            'international_c'               => 'International Opportunity'
        );

        $QualifiedLead = array(
            'total_input_value'             => 'Amount (Cr/Mn)',
            'sector_c'                      => 'Sector',
            'product_service_c'             => 'Product/ Service',
            'sub_sector_c'                  => 'Sub Sector',
            'scope_budget_projected_c'      => 'DPR/Scope & Budget Accepted (Projected)',
            'rfp_eoi_projected_c'           => 'RFP/EOI Initiated Drafting (Projected)',
            'rfp_eoi_published_projected_c' => 'RFP/EOI Published (Projected)',
            'work_order_projected_c'        => 'Work Order (Projected)'
        );
        $QualifiedLead = array_merge($default2, $QualifiedLead);

        $QualifiedOpportunity = array(
            'budget_head_amount_c'                     => 'Budget Head Amount (In Cr)',
            'budget_allocated_oppertunity_c'    => 'Budget Allocated For Opportunity (in Cr)',
            'project_implementation_start_c'    => 'Project Implementation Start Date',
            'project_implementation_end_c'      => 'Project Implementation End Date',
            'selection_c'                       => 'Selection/Funding/Timing',
            /*'funding_c'                         => 'Funding',
            'timing_button_c'                   => 'Timing',*/
        );
        $QualifiedOpportunity = array_merge($QualifiedLead, $QualifiedOpportunity);

        $QualifiedDPR = array(
            'submissionstatus_c' => 'Submission Status'
        );
        $QualifiedDPR = array_merge($QualifiedOpportunity, $QualifiedDPR);

        $QualifiedBid = array(
            'closure_status_c'  => 'Closure Status'
        );
        $QualifiedBid = array_merge($QualifiedDPR, $QualifiedBid);
        
        $fields['default'] = $default;
        switch($status){
            case 'Lead':
                $fields['addons'] = $default2;
                break;
            case 'QualifiedLead':
                $fields['addons'] = $QualifiedLead;
                break;
            case 'qualifylead':
                $fields['addons'] = $QualifiedLead;
                break;
            
            case 'Qualified':
                $fields['addons'] = $QualifiedOpportunity;
                break;
            case 'qualifyOpportunity':
                $fields['addons'] = $QualifiedOpportunity;
                break;

            case 'QualifiedDpr':
                $fields['addons'] = $QualifiedDPR;
                break;
            case 'qualifyDpr':
                $fields['addons'] = $QualifiedDPR;
                break;

            case 'QualifiedBid':
                $fields['addons'] = $QualifiedBid;
                break;
            case 'qualifyBid':
                $fields['addons'] = $QualifiedBid;
                break;

            case 'Closed':
                $fields['addons'] = $QualifiedBid;
                break;
            case 'closure':
                $fields['addons'] = $QualifiedBid;
                break;

            case 'Dropped':
                $fields['addons'] = $QualifiedBid;
                break;
            case 'Dropping':
                $fields['addons'] = $QualifiedBid;
                break;

            default:
                $fields['addons'] = $default2;
                break;
        }
        
        return $fields;
    }

    function getColumnFiltersHeader($columnFilter){

        $data = '';
        $customColumns = @$_GET['customColumns'];
        
        if($customColumns):
        foreach($customColumns as $column){
            $data .= $this->getColumnHtml($column);
        }
        endif;

        return $data;
    }

    function getColumnHtml($column){
        $data = '';
        switch($column){
            case 'Amount':
                $data .= '<th class="table-header">Amount ( in Cr/Mn )</th>';
                break; 
            
            case 'REP-EOI-Published':
                $data .= '<th class="table-header">RFP/EOI Published</th>';
                break;

            case 'Closed-Date':
                $data .= '<th class="table-header">Modified Date</th>';
                break;

            case 'Closed-by':
                $data .= '<th class="table-header">Modified By</th>';
                break;

            case 'Date-Created':
                $data .= '<th class="table-header">Created Date</th>';
                break;
            
            case 'Date-Closed':
                $data .= '<th class="table-header">Closed Date</th>';
                break;

            case 'multiple_approver_c':
                $data .= '<th class="table-header">Approver</th>';
                break;
            
            case 'state_c':
                $data .= '<th class="table-header">State</th>';
                break;
            
            case 'new_department_c':
                $data .= '<th class="table-header">Department</th>';
                break;

            case 'source_c':
                $data .= '<th class="table-header">Source</th>';
                break;
            
            case 'non_financial_consideration_c':
                $data .= '<th class="table-header">Non Financial Consideration</th>';
                break;
            
            case 'segment_c':
                $data .= '<th class="table-header">Segment</th>';
                break;
            
            case 'product_service_c':
                $data .= '<th class="table-header">Product/Service</th>';
                break;
            
            case 'international_c':
                $data .= '<th class="table-header">International Opportunity</th>';
                break;
    
            case 'total_input_value':
                $data .= '<th class="table-header">Amount (Cr/Mn)</th>';
                break;

            case 'sector_c':
                $data .= '<th class="table-header">Sector</th>';
                break;

            case 'sub_sector_c':
                $data .= '<th class="table-header">Sub sector</th>';
                break;

            case 'scope_budget_projected_c':
                $data .= '<th class="table-header">DPR/Scope & Budget Accepted (Projected)</th>';
                break;

            case 'rfp_eoi_projected_c':
                $data .= '<th class="table-header">RFP/EOI Initiated Drafting (Projected)</th>';
                break;

            case 'rfp_eoi_published_projected_c':
                $data .= '<th class="table-header">RFP/EOI Published (Projected)</th>';
                break;

            case 'work_order_projected_c':
                $data .= '<th class="table-header">Work Order (Projected)</th>';
                break;

            case 'budget_head_amount_c':
                $data .= '<th class="table-header">Budget Head Amount (In Cr)</th>';
                break;

            case 'budget_allocated_oppertunity_c':
                $data .= '<th class="table-header">Budget Allocated for Opportunity (in Cr)</th>';
                break;

            case 'project_implementation_start_c':
                $data .= '<th class="table-header">Project Implementation Start Date</th>';
                break;

            case 'project_implementation_end_c':
                $data .= '<th class="table-header">Project Implementation End Date</th>';
                break;

            case 'selection_c':
                $data .= '<th class="table-header">Selection/Funding/Timing</th>';
                break;
                
            case 'submissionstatus_c':
                $data .= '<th class="table-header">Submission Status</th>';
                break;
    
            case 'closure_status_c':
                $data .= '<th class="table-header">Closure Status</th>';
                break;
        }
        return $data;
    }

    function getColumnFiltersBody($columnFilter, $row){

        $data = '';
        $customColumns = @$_GET['customColumns'];
        
        if($customColumns):
        foreach($customColumns as $column){
            $data .= $this->getColumnDataHtml($column, $row);
        }
        endif;

        return $data;

    }

    function getColumnDataHtml($column, $row){
        $data = '';
        
        if($row['date_closed']){
            $closedDate = date_format(date_create($row['date_closed']),'d/m/Y');
        }else{
            $closedDate = '';
        }
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

        switch($column){
            case 'Amount':
                $data .= '<td class="table-data">'.$this->append_currency($row['currency_c'], $this->beautify_amount($row['budget_allocated_oppertunity_c'])).'</td>';
                break; 
            
            case 'REP-EOI-Published':
                $data .= '<td class="table-data">'.($this->beautify_label(($this->beautify_label($row['rfporeoipublished_c'])))).'</td>';
                break;

            case 'Closed-Date':
                $data .= '<td class="table-data">'.date_format(date_create($row['date_modified']),'d/m/Y').'</td>'; 
                break;

            case 'Closed-by':
                $data .= '<td class="table-data" >'.$closed_by.'</td>';
                break;

            case 'Date-Created':
                $data .= '<td class="table-data">'.date_format(date_create($row['date_entered']),'d/m/Y').'</td>';
                break;
            
            case 'Date-Closed':
                $data .= '<td class="table-data">'.$closedDate.'</td>';
                break;

            case 'multiple_approver_c':
                $data .= '<td class="table-data" >'.$this->getMultipleApproverNames($row['multiple_approver_c']).'</td>';
                break;
            
            case 'state_c':
                $data .= '<td class="table-data" >'.$this->beautify_label( $row['state_c'] ).'</td>';
                break;
            
            case 'new_department_c':
                $data .= '<td class="table-data" >'.$this->beautify_label( $row['new_department_c'] ).'</td>';
                break;

            case 'source_c':
                $data .= '<td class="table-data" >'.$this->beautify_label( $row['source_c'] ).'</td>';
                break;
            
            case 'non_financial_consideration_c':
                if ($row['non_financial_consideration_c'] == null || $row['non_financial_consideration_c'] == '') {
                    $row['non_financial_consideration_c'] = '^NA^';
                }
                $data .= '<td class="table-data" >'.$this->beautify_label_n_f( $row['non_financial_consideration_c'] ).'</td>';
                break;
            
            case 'segment_c':
                $data .= '<td class="table-data" >'.$this->beautify_label( $row['segment_c'] ).'</td>';
                break;
            
            case 'product_service_c':
                $data .= '<td class="table-data" >'.$this->beautify_label( $row['product_service_c'] ).'</td>';
                break;
            
            case 'international_c':
                $data .= '<td class="table-data" >'.$this->beautify_label( $row['international_c'] ).'</td>';
                break;
    
            case 'total_input_value':
                $data .= '<td class="table-data" >'.$this->append_currency($row['currency_c'], $this->beautify_amount($row['total_input_value'] )).'</td>';
                break;

            case 'sector_c':
                $data .= '<td class="table-data" >'.$this->beautify_label( $row['sector_c'] ).'</td>';
                break;

            case 'sub_sector_c':
                $data .= '<td class="table-data" >'.$this->beautify_label( $row['sub_sector_c'] ).'</td>';
                break;

            case 'scope_budget_projected_c':
                $data .= '<td class="table-data" >'.$this->beautify_label( date('d/m/Y', strtotime($row['scope_budget_projected_c'])) ).'</td>';
                break;

            case 'rfp_eoi_projected_c':
                $data .= '<td class="table-data" >'.$this->beautify_label( date('d/m/Y', strtotime($row['rfp_eoi_projected_c'])) ).'</td>';
                break;

            case 'rfp_eoi_published_projected_c':
                $data .= '<td class="table-data" >'.$this->beautify_label( date('d/m/Y', strtotime($row['rfp_eoi_published_projected_c'])) ).'</td>';
                break;

            case 'work_order_projected_c':
                $data .= '<td class="table-data" >'.$this->beautify_label( date('d/m/Y', strtotime($row['work_order_projected_c'])) ).'</td>';
                break;

            case 'budget_head_amount_c':
                $data .= '<td class="table-data" >'.$this->beautify_amount( $row['budget_head_amount_c'] ).'</td>';
                break;

            case 'budget_allocated_oppertunity_c':
                $data .= '<td class="table-data" >'.$this->beautify_label( $row['budget_allocated_oppertunity_c'] ).'</td>';
                break;

            case 'project_implementation_start_c':
                $data .= '<td class="table-data" >'.$this->beautify_label( date('d/m/Y', strtotime($row['project_implementation_start_c'])) ).'</td>';
                break;

            case 'project_implementation_end_c':
                $data .= '<td class="table-data" >'.$this->beautify_label( date('d/m/Y', strtotime($row['project_implementation_end_c'])) ).'</td>';
                break;

            case 'selection_c':
                $data .= '<td class="table-data" >';
                $data .= $this->getColor( $row['selection_c'] );
                $data .= $this->getColor( $row['funding_c'] );
                $data .= $this->getColor( $row['timing_button_c'] );
                $data .= '</td>';
                break;
                
            case 'submissionstatus_c':
                $data .= '<td class="table-data" >'.$this->beautify_label( $row['submissionstatus_c'] ).'</td>';
                break;
    
            case 'closure_status_c':
                $data .= '<td class="table-data" >'.$this->beautify_label( $row['closure_status_c'] ).'</td>';
                break;
        }
        return $data;
    }

    function getFilterHtml($type, $columnFilter){

        $users = $this->get_users_with_team_options();

        /* default fields */
        $html = '<div class="form-group">
                <span class="primary-responsibilty-filter-head">Opportunity Name</span>
                <input type="text" class="form-control filter-name" name="filter-name" />
            </div>';

        $html .= '<div class="form-group">
                <span class="primary-responsibilty-filter-head">Primary Responsibility</span>
                <select class="select2" name="filter-responsibility[]" id="" multiple>
                    '.$users.'
                </select>
                
            </div>';
        
        $html .= $this->filterFields($type, $columnFilter);
        return $html;
    }

    function filterFields($type, $columnFilter){
        
        //$columnAmount = @$columnFilter['Amount'];
            $columnDepartment = @$columnFilter['new_department_c'];
        $columnREPEOI = @$columnFilter['REP-EOI-Published'];
        $columnClosedDate = @$columnFilter['Closed-Date'];
        $columnClosedBy = @$columnFilter['Closed-by'];
        $columnDateCreated = @$columnFilter['Date-Created'];
        $columnDateClosed = @$columnFilter['Date-Closed'];

        $multiple_approver_c            = @$columnFilter['multiple_approver_c'];
        $state_c                        = @$columnFilter['state_c'];
        $new_department_c               = @$columnFilter['new_department_c'];
        $source_c                       = @$columnFilter['source_c'];
        $non_financial_consideration_c  = @$columnFilter['non_financial_consideration_c'];
        $segment_c                      = @$columnFilter['segment_c'];
        $product_service_c              = @$columnFilter['product_service_c'];
        $international_c                = @$columnFilter['international_c'];
        
        $total_input_value              = @$columnFilter['total_input_value'];
        $sector_c                       = @$columnFilter['sector_c'];
        $product_service_c              = @$columnFilter['product_service_c'];
        $sub_sector_c                   = @$columnFilter['sub_sector_c'];
        $scope_budget_projected_c       = @$columnFilter['scope_budget_projected_c'];
        $rfp_eoi_projected_c            = @$columnFilter['rfp_eoi_projected_c'];
        $rfp_eoi_published_projected_c  = @$columnFilter['rfp_eoi_published_projected_c'];
        $work_order_projected_c         = @$columnFilter['work_order_projected_c'];
        
        $budget_head_amount_c                  = @$columnFilter['budget_head_amount_c'];
        $budget_allocated_oppertunity_c = @$columnFilter['budget_allocated_oppertunity_c'];
        $project_implementation_start_c = @$columnFilter['project_implementation_start_c'];
        $project_implementation_end_c   = @$columnFilter['project_implementation_end_c'];
        $selection_c                    = @$columnFilter['selection_c'];
        $funding_c                      = @$columnFilter['funding_c'];
        $timing_button_c                = @$columnFilter['timing_button_c'];

        $submissionstatus_c             = @$columnFilter['submissionstatus_c'];

        $closure_status_c               = @$columnFilter['closure_status_c'];

        $data = '';


        if($total_input_value){
            $data .= '<div class="amount-range-container">
                <div class="amount-range">
                    <span class="primary-responsibilty-filter-head">
                        Amount Range (₹)
                        <span class="range_min color-red">0 Cr</span>
                        <span class="color-red"> - </span>
                        <span class="range_max color-red">200 Cr</span>
                    </span>
                </div>
                <div class="rangeslider">
                    <input class="min lowerVal" name="filter-total_input_value_min" id="lowerVal" type="range" min="0" max="200" value="0" step="10"/>
                    <input class="max upperVal" name="filter-total_input_value_max" id="upperVal" type="range" min="0" max="200" value="200" step="10"/>
                    <span class="light left">0 Cr</span>
                    <span class="light right">200 Cr</span>
                </div>
            </div>';
            $data .= '<div class="amount-range-container">
                <div class="amount-range">
                    <span class="primary-responsibilty-filter-head">
                        Amount Range ($)
                        <span class="range_min color-red">0 Mn</span>
                        <span class="color-red"> - </span>
                        <span class="range_max color-red">50 Mn</span>
                    </span>
                </div>
                <div class="rangeslider usd">
                    <input class="min lowerVal" name="filter-total_input_value_min-usd" id="lowerVal" type="range" min="0" max="50" value="0" step="5"/>
                    <input class="max upperVal" name="filter-total_input_value_max-usd" id="upperVal" type="range" min="0" max="50" value="50" step="5"/>
                    <span class="light left">0 Mn</span>
                    <span class="light right">50 Mn</span>
                </div>
            </div>';
        }
        if($columnREPEOI){
            $data .= '<div class="form-group">
                <SPAN style="font-weight: bold;">RFP/EOI Published</SPAN>
                <div class="filterchecklist">

                    <input type="checkbox" id="required_field" class="rfp-checkbox" name="filter-rfp-eoi-status[]" value="yes">
                    <label for="yes"> Yes</label>
                    <input type="checkbox" id="required_field" class="rfp-checkbox" name="filter-rfp-eoi-status[]" value="no">
                    <label for="No"> No</label>
                    <input type="checkbox" id="required_field" class="rfp-checkbox" name="filter-rfp-eoi-status[]" value="not_required">
                    <label for="Not-Required"> Not required</label><br>

                </div>
            </div>';
        }
        if($columnClosedDate){
            $data .= '<div class="form-group">
                <div class="date-filter">
                    <label>Modified Date Range</label><br>
                    From: <input class="filterdatebox" name="filter-closed-date-from" id="closed_date_from" width="300" />
                    To: <input class="filterdatebox" name="filter-closed-date-to" id="closed_date_to" width="300" />
                </div>
            </div>';
        }
        if($columnClosedBy){
            $users = json_decode( $this->delegate_members(), true);
            $data .= '<div class="form-group">
                <span class="primary-responsibilty-filter-head">Modified By</span>
                <select class="select2" name="filter-Closed-by[]" id="" multiple>
                '.$users['members'].'
                </select>
                
            </div>';
        }
        if($columnDateCreated){
            $data .= '<div class="form-group">
                <div class="date-filter">
                    <label>Created Date Range</label><br>
                    From: <input class="filterdatebox" name="filter-created-date-from" id="date_from" width="300" />
                    To: <input class="filterdatebox" name="filter-created-date-to" id="date_to" width="300" /><br>
                </div>
            </div>';
        }
        if($columnDateClosed){
            $data .= '<div class="form-group">
                <div class="date-filter">
                    <label>Created Date Range</label><br>
                    From: <input class="filterdatebox" name="filter-created-date-from" id="date_from" width="300" />
                    To: <input class="filterdatebox" name="filter-created-date-to" id="date_to" width="300" /><br>
                </div>
            </div>';
        }

        if($multiple_approver_c){
            $users = json_decode( $this->delegate_members(), true);
            $data .= '<div class="form-group">
                <span class="primary-responsibilty-filter-head">Approver</span>
                <select class="filter-multiple_approver_c select2" name="filter-multiple_approver_c[]" id="filter-multiple_approver_c" multiple>
                '.$users['members'].'
                </select>
                
            </div>';
        }

        if($state_c){
            $states = '';
            $stateArray = $this->getDbData('states', 'name', "country_id = '101' ");
            foreach($stateArray as $s){
                $states .= '<option value="'.$s['name'].'">'.$this->beautify_label( $s['name'] ).'</option>';
            }
            $data .= '<div class="form-group">
                <span class="primary-responsibilty-filter-head">State</span>
                <select class="state_c" name="filter-state_c" id="state_c">
                <option value="">Select</option>
                '.$states.'
                </select>
                
            </div>';
        }

        if($new_department_c){
            $departments = $this->getDbData('accounts', 'name', "name != '' ");
            $departmentList = '';
            foreach($departments as $d){
                $departmentList .= '<option value="'.$d['name'].'">'.$this->beautify_label( $d['name'] ).'</option>';
            }
            $data .= '<div class="form-group">
                <span class="primary-responsibilty-filter-head">Department</span>
                <select class="" name="filter-new_department_c" id="new_department_c">
                <option value="">Select</option>
                '.$departmentList.'
                </select>
                
            </div>';
        }

        if($source_c){
            $sources = $this->getDbData('opportunities_cstm', 'DISTINCT source_c', " source_c != '' ");
            $sourceList = '';
            foreach($sources as $d){
                $sourceList .= '<option value="'.$d['source_c'].'">'.$this->beautify_label( $d['source_c'] ).'</option>';
            }
            $data .= '<div class="form-group">
                <span class="primary-responsibilty-filter-head">Source</span>
                <select class="" name="filter-source_c" id="source_c">
                <option value="">Select</option>
                '.$sourceList.'
                </select>
                
            </div>';
        }

        if($non_financial_consideration_c){
            // $dbData = $this->getDbData('opportunities_cstm', 'DISTINCT non_financial_consideration_c', " non_financial_consideration_c != '' ");
            $dbData = ['^NA^' , '^BrandEstablishment^', '^NewServiceLine^','^NewRegionalDevelopment^',
            '^PilotforFutureOpportunity^', '^Relationship^', '^StrategicAlignmentforFutureOpportunity^'];
            $dataList = '';
            foreach($dbData as $d){
                $dataList .= '<option value="'.$d.'">'.$this->beautify_label( $d ).'</option>';
            }
            $data .= '<div class="form-group">
                <span class="primary-responsibilty-filter-head">Non Financial Consideration</span>
                <select class="select2" name="filter-non_financial_consideration_c[]" id="non_financial_consideration_c" multiple>
                '.$dataList.'
                </select>
                
            </div>';
        }

        if($segment_c){
            $dbData = $this->getDbData('segment', 'segment_name', " segment_name != '' ");
            $segmentList = '';
            foreach($dbData as $d){
                $segmentList .= '<option value="'.$d['segment_name'].'">'.$this->beautify_label( $d['segment_name'] ).'</option>';
            }
            $data .= '<div class="form-group">
                <span class="primary-responsibilty-filter-head">Segment</span>
                <select class="" name="filter-segment_c" id="segment_c">
                <option value="">Select</option>
                '.$segmentList.'
                </select>
                
            </div>';
        }

        if($product_service_c){
            $dbData = $this->getDbData('service', 'DISTINCT service_name', " service_name != '' ");
            $dataList = '';
            foreach($dbData as $d){
                $dataList .= '<option value="'.$d['service_name'].'">'.$this->beautify_label( $d['service_name'] ).'</option>';
            }
            $data .= '<div class="form-group">
                <span class="primary-responsibilty-filter-head">Product/Service</span>
                <select class="" name="filter-product_service_c" id="product_service_c">
                <option value="">Select</option>
                '.$dataList.'
                </select>
                
            </div>';
        }

        if($international_c){
            $data .= '<div class="form-group">
                <SPAN style="font-weight:bold">International Opportunity</SPAN>
                <div class="filterchecklist" style="width:30%;">
                    <input type="checkbox" id="required_field" class="rfp-checkbox" name="filter-international_c" value="yes">
                    <label for="yes"> Yes</label>
                    <input type="checkbox" id="required_field" class="rfp-checkbox" name="filter-international_c" value="no">
                    <label for="No"> No</label>
                </div>
            </div>';
        }

        /*if($total_input_value){
            $data .= '<div class="amount-range-container">
                <div class="amount-range">
                    <span class="primary-responsibilty-filter-head">
                        Total Amount
                        <span class="range_min color-red">0 Cr</span>
                        <span class="color-red"> - </span>
                        <span class="range_max color-red">200 Cr</span>
                    </span>
                    
                </div>
                <div class="rangeslider">
                    <input class="min lowerVal" name="filter-total_input_value_min" id="lowerVal" type="range" min="0" max="200" value="0" step="10"/>
                    <input class="max upperVal" name="filter-total_input_value_max" id="upperVal" type="range" min="0" max="200" value="200" step="10"/>
                    <span class="light left">0 Cr</span>
                    <span class="light right">200 Cr</span>
                </div>
            </div>';
        }*/
        
        if($sector_c){
            $dbData = $this->getDbData('sector', 'name', " name != '' ");
            $dataList = '';
            foreach($dbData as $d){
                $dataList .= '<option value="'.$d['name'].'">'.$this->beautify_label( $d['name'] ).'</option>';
            }
            $data .= '<div class="form-group">
                <span class="primary-responsibilty-filter-head">Sector</span>
                <select class="" name="filter-sector_c" id="sector_c">
                <option value="">Select</option>
                '.$dataList.'
                </select>
                
            </div>';
        }

        if($sub_sector_c){
            $dbData = $this->getDbData('sub_sector', 'name', " name != '' ");
            $dataList = '';
            foreach($dbData as $d){
                $dataList .= '<option value="'.$d['name'].'">'.$this->beautify_label( $d['name'] ).'</option>';
            }
            $data .= '<div class="form-group">
                <span class="primary-responsibilty-filter-head">Sub Sector</span>
                <select class="" name="filter-sub_sector_c" id="sub_sector_c">
                <option value="">Select</option>
                '.$dataList.'
                </select>
                
            </div>';
        }
        
        if($scope_budget_projected_c){
            $data .= '<div class="form-group">
                <div class="date-filter">
                    <label>DPR/Scope & Budget Accepted (Projected)</label><br>
                    From: <input class="filterdatebox" name="filter-scope_budget_projected_c_from" id="scope_budget_projected_c_from" width="300" />
                    To: <input class="filterdatebox" name="filter-scope_budget_projected_c_to" id="scope_budget_projected_c_to" width="300" />
                </div>
            </div>';
        }

        if($rfp_eoi_projected_c){
            $data .= '<div class="form-group">
                <div class="date-filter">
                    <label>RFP/EOI Initiated Drafting (Projected)</label><br>
                    From: <input class="filterdatebox" name="filter-rfp_eoi_projected_c_from" id="rfp_eoi_projected_c_from" width="300" />
                    To: <input class="filterdatebox" name="filter-rfp_eoi_projected_c_to" id="rfp_eoi_projected_c_to" width="300" />
                </div>
            </div>';
        }

        if($rfp_eoi_published_projected_c){
            $data .= '<div class="form-group">
                <div class="date-filter">
                    <label>RFP/EOI Published (Projected)</label><br>
                    From: <input class="filterdatebox" name="filter-rfp_eoi_published_projected_c_from" id="rfp_eoi_projected_c_from" width="300" />
                    To: <input class="filterdatebox" name="filter-rfp_eoi_published_projected_c_to" id="rfp_eoi_projected_c_to" width="300" />
                </div>
            </div>';
        }

        if($work_order_projected_c){
            $data .= '<div class="form-group">
                <div class="date-filter">
                    <label>Work Order (Projected)</label><br>
                    From: <input class="filterdatebox" name="filter-work_order_projected_c_from" id="work_order_projected_c_from" width="300" />
                    To: <input class="filterdatebox" name="filter-work_order_projected_c_to" id="work_order_projected_c_to" width="300" />
                </div>
            </div>';
        }
        
        if($budget_head_amount_c){
            $data .= '<div class="amount-range-container">
                <div class="amount-range">
                    <span class="primary-responsibilty-filter-head">
                        Budget Head Amount (In Cr)
                        <span class="range_min color-red">0 Cr</span>
                        <span class="color-red"> - </span>
                        <span class="range_max color-red">200 Cr</span>
                    </span>
                </div>
                <div class="rangeslider">
                    <input class="min lowerVal" name="filter-budget_head_amount_c_min" id="lowerVal" type="range" min="0" max="200" value="0" step="10"/>
                    <input class="max upperVal" name="filter-budget_head_amount_c_max" id="upperVal" type="range" min="0" max="200" value="200" step="10"/>
                    <span class="light left">0 Cr</span>
                    <span class="light right">200 Cr</span>
                </div>
            </div>';
        }

        if($budget_allocated_oppertunity_c){
            $data .= '<div class="amount-range-container">
                <div class="amount-range">
                    <span class="primary-responsibilty-filter-head">
                        Budget Allocated for Opportunity (in Cr)
                        <span class="range_min color-red">0 Cr</span>
                        <span class="color-red"> - </span>
                        <span class="range_max color-red">200 Cr</span>
                    </span>
                </div>
                <div class="rangeslider">
                    <input class="min lowerVal" name="filter-budget_allocated_oppertunity_c_min" id="lowerVal" type="range" min="0" max="200" value="0" step="10"/>
                    <input class="max upperVal" name="filter-budget_allocated_oppertunity_c_max" id="upperVal" type="range" min="0" max="200" value="200" step="10"/>
                    <span class="light left">0 Cr</span>
                    <span class="light right">200 Cr</span>
                </div>
            </div>';
        }

        if($project_implementation_start_c){
            $data .= '<div class="form-group">
                <div class="date-filter">
                    <label>Project Implementation Start Date</label><br>
                    From: <input class="filterdatebox" name="filter-project_implementation_start_c_from" id="project_implementation_start_c_from" width="300" />
                    To: <input class="filterdatebox" name="filter-project_implementation_start_c_to" id="project_implementation_start_c_to" width="300" />
                </div>
            </div>';
        }

        if($project_implementation_end_c){
            $data .= '<div class="form-group">
                <div class="date-filter">
                    <label>Project Implementation Start Date</label><br>
                    From: <input class="filterdatebox" name="filter-project_implementation_end_c_from" id="project_implementation_end_c_from" width="300" />
                    To: <input class="filterdatebox" name="filter-project_implementation_end_c_to" id="project_implementation_end_c_to" width="300" />
                </div>
            </div>';
        }
        
        if($selection_c){
            $data .= '<div class="form-group">
                <span class="primary-responsibilty-filter-head">Selection</span>
                <select class="" name="filter-selection_c" id="selection_c">
                    <option value="">Select</option>
                    <option value="Not_selected">Not Selected</option>
                    <option value="Red">Red</option>
                    <option value="Yellow">Yellow</option>
                    <option value="Green">Green</option>
                </select>
                
            </div>';
        }

        if($selection_c){
            $data .= '<div class="form-group">
                <span class="primary-responsibilty-filter-head">Funding</span>
                <select class="" name="filter-funding_c" id="funding_c">
                    <option value="">Select</option>
                    <option value="Not_selected">Not Selected</option>
                    <option value="Red">Red</option>
                    <option value="Yellow">Yellow</option>
                    <option value="Green">Green</option>
                </select>
                
            </div>';
        }

        if($selection_c){
            $data .= '<div class="form-group">
                <span class="primary-responsibilty-filter-head">Timing</span>
                <select class="" name="filter-timing_button_c" id="timing_button_c">
                    <option value="">Select</option>
                    <option value="Not_selected">Not Selected</option>
                    <option value="Red">Red</option>
                    <option value="Yellow">Yellow</option>
                    <option value="Green">Green</option>
                </select>
                
            </div>';
        }

        if($submissionstatus_c){
            $dbData = $this->getDbData('opportunities_cstm', 'DISTINCT submissionstatus_c', " submissionstatus_c != '' ");
            $dataList = '';
            foreach($dbData as $d){
                $dataList .= '<option value="'.$d['submissionstatus_c'].'">'.$this->beautify_label( $d['submissionstatus_c'] ).'</option>';
            }
            $data .= '<div class="form-group">
                <span class="primary-responsibilty-filter-head">Submission Status</span>
                <select class="" name="filter-submissionstatus_c" id="submissionstatus_c">
                '.$dataList.'
                </select>
                
            </div>';
        }

        if($closure_status_c){
            $data .= '<div class="form-group">
                <span class="primary-responsibilty-filter-head">Closure Status</span>
                <select class="" name="filter-closure_status_c" id="timing_c">
                    <option value="">Select</option>
                    <option value="won">Won</option>
                    <option value="lost">Lost</option>
                </select>
                
            </div>';
        }

        return $data;
    }

    function getFilterQuery(){
        global $current_user;
        $log_in_user_id = $current_user->id;
        
        $multiple_approver_c            = @$_GET['filter-multiple_approver_c'];
        $state_c                        = @$_GET['filter-state_c'];
        $new_department_c               = @$_GET['filter-new_department_c'];
        $source_c                       = @$_GET['filter-source_c'];
        $non_financial_consideration_c  = @$_GET['filter-non_financial_consideration_c'];
        $segment_c                      = @$_GET['filter-segment_c'];
        $product_service_c              = @$_GET['filter-product_service_c'];
        $international_c                = @$_GET['filter-international_c'];
        
        $total_input_value_min          = @$_GET['filter-total_input_value_min'];
        $total_input_value_max          = @$_GET['filter-total_input_value_max'];
        $sector_c                       = @$_GET['filter-sector_c'];
        $product_service_c              = @$_GET['filter-product_service_c'];
        $sub_sector_c                   = @$_GET['filter-sub_sector_c'];
        
        $scope_budget_projected_c_from  = @$_GET['filter-scope_budget_projected_c_from'];
        $scope_budget_projected_c_to    = @$_GET['filter-scope_budget_projected_c_to'];
        
        $rfp_eoi_projected_c_from       = @$_GET['filter-rfp_eoi_projected_c_from'];
        $rfp_eoi_projected_c_to         = @$_GET['filter-rfp_eoi_projected_c_to'];

        $rfp_eoi_published_projected_c_from = @$_GET['filter-rfp_eoi_published_projected_c_from'];
        $rfp_eoi_published_projected_c_to   = @$_GET['filter-rfp_eoi_published_projected_c_to'];

        $work_order_projected_c_from    = @$_GET['filter-work_order_projected_c_from'];
        $work_order_projected_c_to      = @$_GET['filter-work_order_projected_c_to'];
        
        $budget_head_amount_c_min              = @$_GET['filter-budget_head_amount_c_min'];
        $budget_head_amount_c_max              = @$_GET['filter-budget_head_amount_c_max'];

        $budget_allocated_oppertunity_c_min = @$_GET['filter-budget_allocated_oppertunity_c_min'];
        $budget_allocated_oppertunity_c_max = @$_GET['filter-budget_allocated_oppertunity_c_max'];

        $project_implementation_start_c_from = @$_GET['filter-project_implementation_start_c_from'];
        $project_implementation_start_c_to   = @$_GET['filter-project_implementation_start_c_to'];

        $project_implementation_end_c_from  = @$_GET['filter-project_implementation_end_c_from'];
        $project_implementation_end_c_to    = @$_GET['filter-project_implementation_end_c_to'];

        $selection_c                    = @$_GET['filter-selection_c'];
        $funding_c                      = @$_GET['filter-funding_c'];
        $timing_button_c                = @$_GET['filter-timing_button_c'];

        $submissionstatus_c             = @$_GET['filter-submissionstatus_c'];

        $closure_status_c               = @$_GET['filter-closure_status_c'];

        $fetch_query = '';

        if(isset( $_GET['filter'] ) && @$_GET['filter-name']){
            $name = $_GET["filter-name"];
            $fetch_query .= " AND opportunities.name LIKE '%$name%' ";
        }

        if(isset( $_GET['filter'] ) && @$_GET['filter-responsibility']){
            $responsibility = $_GET['filter-responsibility'];
            $fetch_query .= " AND (";
            foreach($responsibility as $key => $res){
                $arr = explode('andTeam',$res,0);
                if($key)
                    $fetch_query .= " OR ";
                if($res == 'MyTeam') {
                    $fetch_query .= " opportunities.assigned_user_id IN 
                    (SELECT id FROM users WHERE reports_to_id = '$log_in_user_id' OR id = '$log_in_user_id')";
                } else if ($arr && count($arr) > 0) {
                    $arr[0] = chop($arr[0],"andTeam");
                    $fetch_query .= " opportunities.assigned_user_id IN 
                    (SELECT id FROM users WHERE reports_to_id = '$arr[0]' OR id = '$arr[0]')";
                } else {
                    $fetch_query .= " opportunities.assigned_user_id = '$res' ";
                }
                    
                
            }
            $fetch_query .= " )";
            //$fetch_query .= " AND opportunities.created_by = '$responsibility' ";
        }

        if(isset( $_GET['filter'] ) && @$_GET['filter-Closed-by']){
            $modified = $_GET['filter-Closed-by'];
            $fetch_query .= " AND (";
            foreach($modified as $key => $res){
                if($key)
                    $fetch_query .= " OR ";
                $fetch_query .= " opportunities.modified_user_id = '$res' ";
            }
            $fetch_query .= " )";
            //$fetch_query .= " AND opportunities.created_by = '$responsibility' ";
        }

        if(isset( $_GET['filter'] ) && @$_GET['filter-rfp-eoi-status']){
            $rpfEOIStatus = $_GET['filter-rfp-eoi-status'];
            $fetch_query .= " AND (";
            foreach($rpfEOIStatus as $key => $res){
                if($key)
                    $fetch_query .= " OR ";
                $fetch_query .= " opportunities_cstm.rfporeoipublished_c = '$res' ";
            }
            $fetch_query .= " )";
            //$fetch_query .= " AND opportunities_cstm.rfporeoipublished_c = '$rpfEOIStatus' ";
        }
        if (isset( $_GET['filter'] ) && (@$_GET['filter-min-price'] || @$_GET['filter-max-price'] || 
        @$_GET['filter-min-price-usd'] || @$_GET['filter-max-price-usd'])) {
            $minPrice = 0;
            $maxPrice = 200;
            $minPriceUSD = 0;
            $maxPriceUSD = 50;
            if (@$_GET['filter-min-price']) {
                $minPrice = $_GET['filter-min-price'];
             }
            if(@$_GET['filter-max-price']) {
                $maxPrice = $_GET['filter-max-price'];
            }
            if (@$_GET['filter-min-price-usd']) {
                $minPriceUSD = $_GET['filter-min-price-usd'];
            }
            if(@$_GET['filter-max-price-usd']) {
                $maxPriceUSD = $_GET['filter-max-price-usd'];
            }
            $inrquery = "((opportunities_cstm.budget_allocated_oppertunity_c BETWEEN '$minPrice' AND '$maxPrice') 
            AND (opportunities_cstm.currency_c = 'INR' OR opportunities_cstm.currency_c = '' OR opportunities_cstm.currency_c is NULL))";
            $usdquery = "((opportunities_cstm.budget_allocated_oppertunity_c BETWEEN '$minPriceUSD' AND '$maxPriceUSD') 
            AND (opportunities_cstm.currency_c = 'USD'))";
            $or = " OR ";
            if ($minPrice == 0 && $maxPrice == 200) {
                $inrquery = "(opportunities_cstm.currency_c = 'INR' OR opportunities_cstm.currency_c = '' OR opportunities_cstm.currency_c is NULL)";
            }
            if ($minPriceUSD == 0 && $maxPriceUSD == 50) {
                $usdquery = "(opportunities_cstm.currency_c = 'USD')";
            }
            $fetch_query .= " AND ($inrquery $or $usdquery)";
        }
        
        if(isset( $_GET['filter'] ) && @$_GET['filter-closed-date-from'] && @$_GET['filter-closed-date-to']){
            $closedDateFrom = $_GET['filter-closed-date-from'];
            $closedDateTo   = $_GET['filter-closed-date-to'];
            $fetch_query    .= " AND DATE_FORMAT(opportunities.date_modified, '%d/%m/%Y') BETWEEN '$closedDateFrom' AND '$closedDateTo' ";
        }
        if(isset( $_GET['filter'] ) && @$_GET['filter-created-date-from'] && @$_GET['filter-created-date-to']){
            $createdDateFrom    = $_GET['filter-created-date-from'];
            $createdDateTo      = $_GET['filter-created-date-to'];
            $fetch_query        .= " AND DATE_FORMAT(opportunities.date_entered, '%d/%m/%Y') BETWEEN '$createdDateFrom' AND '$createdDateTo' ";
        }

        if($multiple_approver_c){
            //$approvers = implode(',', $multiple_approver_c);
            $fetch_query .= " AND (";
            foreach($multiple_approver_c as $key => $approver){
                if($key)
                    $fetch_query .= " OR ";
                $fetch_query .= " opportunities_cstm.multiple_approver_c LIKE '%$approver%' ";
            }
            $fetch_query .= " )";
            
        }
        if($state_c){
            $fetch_query .= " AND opportunities_cstm.state_c = '$state_c' ";
        }
        if($new_department_c){
            $fetch_query .= " AND opportunities_cstm.new_department_c = '$new_department_c' ";
        }
        if($source_c){
            $fetch_query .= " AND opportunities_cstm.source_c = '$source_c' ";
        }
        if($non_financial_consideration_c){
            $fetch_query .= " AND (";
            foreach($non_financial_consideration_c as $key => $res){
                if($key)
                    $fetch_query .= " OR ";
                if($res== '^NA^') {
                    $res = 'NA';
                    $fetch_query .= " `opportunities_cstm`.non_financial_consideration_c NOT LIKE '%$res%' OR `opportunities_cstm`.non_financial_consideration_c IS NULL";
                } else {
                    $fetch_query .= " opportunities_cstm.non_financial_consideration_c LIKE '%$res%' ";
                }
                
            }
            $fetch_query .= " )";
            //$fetch_query .= " AND opportunities_cstm.non_financial_consideration_c = '$non_financial_consideration_c' ";
        }
        if($segment_c){
            $fetch_query .= " AND opportunities_cstm.segment_c = '$segment_c' ";
        }
        if($product_service_c){
            $fetch_query .= " AND opportunities_cstm.product_service_c = '$product_service_c' ";
        }
        if($international_c){
            $fetch_query .= " AND opportunities_cstm.international_c = '$international_c' ";
        }

        if (isset( $_GET['filter'] ) && (@$_GET['filter-min-price'] || @$_GET['filter-max-price'] || 
        @$_GET['filter-min-price-usd'] || @$_GET['filter-max-price-usd'])) {
            $minPrice = 0;
            $maxPrice = 200;
            $minPriceUSD = 0;
            $maxPriceUSD = 50;
            if (@$_GET['filter-min-price']) {
                $minPrice = $_GET['filter-min-price'];
             }
            if(@$_GET['filter-max-price']) {
                $maxPrice = $_GET['filter-max-price'];
            }
            if (@$_GET['filter-min-price-usd']) {
                $minPriceUSD = $_GET['filter-min-price-usd'];
            }
            if(@$_GET['filter-max-price-usd']) {
                $maxPriceUSD = $_GET['filter-max-price-usd'];
            }
            $inrquery = "((opportunities_cstm.budget_allocated_oppertunity_c BETWEEN '$minPrice' AND '$maxPrice') 
            AND (opportunities_cstm.currency_c = 'INR' OR opportunities_cstm.currency_c = '' OR opportunities_cstm.currency_c is NULL))";
            $usdquery = "((opportunities_cstm.budget_allocated_oppertunity_c BETWEEN '$minPriceUSD' AND '$maxPriceUSD') 
            AND (opportunities_cstm.currency_c = 'USD'))";
            $or = " OR ";
            if ($minPrice == 0 && $maxPrice == 200) {
                $inrquery = "(opportunities_cstm.currency_c = 'INR' OR opportunities_cstm.currency_c = '' OR opportunities_cstm.currency_c is NULL)";
            }
            if ($minPriceUSD == 0 && $maxPriceUSD == 50) {
                $usdquery = "(opportunities_cstm.currency_c = 'USD')";
            }
            $fetch_query .= " AND ($inrquery $or $usdquery)";
        }
        if( ($total_input_value_min || $total_input_value_max) || ( @$_GET['filter-total_input_value_min-usd'] || @$_GET['filter-total_input_value_min-usd'] ) ){
            /*$minPrice = $total_input_value_min;
            $maxPrice = $total_input_value_max;*/
            
            $minPrice = 0;
            $maxPrice = 200;
            $minPriceUSD = 0;
            $maxPriceUSD = 50;
            if( $total_input_value_min ) {
                $minPrice = $total_input_value_min;
            }
            if( $total_input_value_max ) {
                $maxPrice = $total_input_value_max;
            }
            if (@$_GET['filter-total_input_value_min-usd']) {
                $minPriceUSD = $_GET['filter-total_input_value_min-usd'];
            }
            if(@$_GET['filter-total_input_value_max-usd']) {
                $maxPriceUSD = $_GET['filter-total_input_value_max-usd'];
            }
            $inrquery = "((CAST(REPLACE(year_quarters.total_input_value, ',', '')as SIGNED) BETWEEN '$minPrice' AND '$maxPrice') 
            AND (opportunities_cstm.currency_c = 'INR' OR opportunities_cstm.currency_c = '' OR opportunities_cstm.currency_c is NULL))";
            $usdquery = "((CAST(REPLACE(year_quarters.total_input_value, ',', '')as SIGNED) BETWEEN '$minPriceUSD' AND '$maxPriceUSD') 
            AND (opportunities_cstm.currency_c = 'USD'))";
            $or = " OR ";
            if ($minPrice == 0 && $maxPrice == 200) {
                $inrquery = "(opportunities_cstm.currency_c = 'INR' OR opportunities_cstm.currency_c = '' OR opportunities_cstm.currency_c is NULL)";
            }
            if ($minPriceUSD == 0 && $maxPriceUSD == 50) {
                $usdquery = "(opportunities_cstm.currency_c = 'USD')";
            }
            $fetch_query .= " AND ($inrquery $or $usdquery)";

            //$fetch_query .= " AND year_quarters.total_input_value BETWEEN '$minPrice' AND '$maxPrice' ";
        }


        if($sector_c){
            $fetch_query .= " AND opportunities_cstm.sector_c = '$sector_c' ";
        }
        if($sub_sector_c){
            $fetch_query .= " AND opportunities_cstm.sub_sector_c = '$sub_sector_c' ";
        }

        if($scope_budget_projected_c_from && $scope_budget_projected_c_to){
            $fetch_query .= " AND DATE_FORMAT(opportunities_cstm.scope_budget_projected_c, '%d/%m/%Y') BETWEEN '$scope_budget_projected_c_from' AND '$scope_budget_projected_c_to' ";
        }

        if($rfp_eoi_projected_c_from && $rfp_eoi_projected_c_to){
            $fetch_query .= " AND DATE_FORMAT(opportunities_cstm.rfp_eoi_projected_c, '%d/%m/%Y') BETWEEN '$rfp_eoi_projected_c_from' AND '$rfp_eoi_projected_c_to' ";
        }
        if($rfp_eoi_published_projected_c_from && $rfp_eoi_published_projected_c_to){
            $fetch_query .= " AND DATE_FORMAT(opportunities_cstm.rfp_eoi_published_projected_c,'%d/%m/%Y') BETWEEN '$rfp_eoi_published_projected_c_from' AND '$rfp_eoi_published_projected_c_to' ";
        }

        if($work_order_projected_c_from && $work_order_projected_c_to){
            $fetch_query .= " AND DATE_FORMAT(opportunities_cstm.work_order_projected_c, '%d/%m/%Y') BETWEEN '$work_order_projected_c_from' AND '$work_order_projected_c_to' ";
        }

        if($budget_head_amount_c_min && $budget_head_amount_c_max){
            $fetch_query .= " AND opportunities_cstm.budget_head_amount_c BETWEEN '$budget_head_amount_c_min' AND '$budget_head_amount_c_max' ";
        }
        
        if($budget_allocated_oppertunity_c_min && $budget_allocated_oppertunity_c_max){
            $fetch_query .= " AND opportunities_cstm.budget_allocated_oppertunity_c BETWEEN '$budget_allocated_oppertunity_c_min' AND '$budget_allocated_oppertunity_c_max' ";
        }
        
        if($project_implementation_start_c_from && $project_implementation_start_c_to){
            $fetch_query .= " AND DATE_FORMAT(opportunities_cstm.project_implementation_start_c,'%d/%m/%Y') BETWEEN '$project_implementation_start_c_from' AND '$project_implementation_start_c_to' ";
        }
        
        if($project_implementation_end_c_from && $project_implementation_end_c_to){
            $fetch_query .= " AND DATE_FORMAT(opportunities_cstm.project_implementation_end_c,'%d/%m/%Y') BETWEEN '$project_implementation_end_c_from' AND '$project_implementation_end_c_to' ";
        }

        if($selection_c){
            $fetch_query .= " AND opportunities_cstm.selection_c = '$selection_c' ";
        }
        if($funding_c){
            $fetch_query .= " AND opportunities_cstm.funding_c = '$funding_c' ";
        }
        if($timing_button_c){
            $fetch_query .= " AND opportunities_cstm.timing_button_c = '$timing_button_c' ";
        }

        if($submissionstatus_c){
            $fetch_query .= " AND opportunities_cstm.submissionstatus_c = '$submissionstatus_c' ";
        }

        if($closure_status_c){
            $fetch_query .= " AND opportunities_cstm.closure_status_c = '$closure_status_c' ";
        }
        // echo $fetch_query;
        // die;
        return $fetch_query;
    }


    function delegate_members(){
        try
        {
            global $current_user;
            $log_in_user_id = $current_user->id;
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            $check_user_team = "SELECT teamfunction_c from users LEFT JOIN users_cstm ON users.id = users_cstm.id_c WHERE id = '$log_in_user_id'";
            $check_user_team_result = $GLOBALS['db']->query($check_user_team);
            $user_team_row = $GLOBALS['db']->fetchByAssoc($check_user_team_result);
            $user_team = $user_team_row['teamfunction_c'];
            

            // $fetch_query = "SELECT  u.* from users u JOIN users_cstm u2 ON u2.id_c = u.id WHERE u2.teamheirarchy_c = 'team_lead' ";
            $fetch_query = "SELECT * FROM users WHERE `deleted` != '1' AND `id` != '1' ORDER BY `users`.`first_name` ASC";
            $result = $GLOBALS['db']->query($fetch_query);
            //$data = '<option value="" disabled selected>Select Option</option>';
            $data = '';
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $full_name = $row['first_name'] . ' ' . $row['last_name'];
                    $data .= '<option value="'.$row['id'].'">'.$full_name.'</option>';
                }
            } else {
                return false;
            }
            return json_encode(array('members'=>$data, 'logged_in_user_team'=>$user_team, 'logged_in_id' => $log_in_user_id));

        }catch(Exception $e){
            return json_encode(array("status"=>false, "message" => "Some error occured"));
        }
    }

    function get_users_with_team_options() {
        global $current_user;
        $log_in_user_id = $current_user->id;
        $fetch_query = "SELECT users.id, users.first_name, users.last_name, users_cstm.teamheirarchy_c
        FROM users LEFT JOIN users_cstm ON users.id = users_cstm.id_c
        WHERE users.`deleted` != '1' AND users.`id` != '1' ORDER BY users.`first_name` ASC";
        $result = $GLOBALS['db']->query($fetch_query);
        //$data = '<option value="" disabled selected>Select Option</option>';
        $data = '';
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $full_name = $row['first_name'] . ' ' . $row['last_name'];
                $data .= '<option value="'.$row['id'].'">'.$full_name.'</option>';
                if ($row['teamheirarchy_c'] == 'team_lead') {
                    $data .= '<option value="'.$row['id'].'andTeam">'.$full_name.' and Team</option>';
                }
            }
        }
        return $data;

    }

    function action_reassignment_dialog_dropdown_info() {
        try
        {
            global $current_user;
            $log_in_user_id = $current_user->id;
            $fetch_query = "SELECT * FROM users WHERE `id` != '$log_in_user_id' AND `id` != '1' ORDER BY `users`.`first_name` ASC";
            $result = $GLOBALS['db']->query($fetch_query);
            $data = '';
            while($row = $result->fetch_assoc()) {
                $full_name = $row['first_name'] . ' ' . $row['last_name'];
                $data .= '<option value="'.$row['id'].'">'.$full_name.'</option>';
            }
            return json_encode(array('user_info'=>$data, 'logged_in_id' => $log_in_user_id));
        }catch(Exception $e){
            return json_encode(array("status"=>false, "message" => "Some error occured"));
        }
    }


    function getDbData($table, $fields, $condition = null){
        $GLOBALS['db'];
        $query = "SELECT $fields from $table ";
        if($condition){
            $query .= "WHERE ".$condition;
        }
        $result = $GLOBALS['db']->query($query);
        while($r = $result->fetch_assoc()){
            $rows[] = $r;
        }
        return $rows;
    }

    function getMultipleApproverNames($approvers){
        $approvers = explode(',', $approvers);
        $data = '';
        $i = 0;
        foreach($approvers as $a){
            if($i != 0)
                $data .= ', ';
            $data .= $this->getUserName($a);
            $i++;
        }
        return $data;
    }

    function getUserName($id){
        $user_name_fetch = "SELECT * FROM users WHERE id='$id'";
        $user_name_fetch_result = $GLOBALS['db']->query($user_name_fetch);
        $user_name_fetch_row = $GLOBALS['db']->fetchByAssoc($user_name_fetch_result);
        $first_name = $last_name = '';
        if(!empty($user_name_fetch_row)){
            $user_name = $user_name_fetch_row['user_name'];
            $first_name = $user_name_fetch_row['first_name'];
            $last_name = $user_name_fetch_row['last_name'];
        }
        return $first_name.' '.$last_name;
    }

    function action_getDefaultColumns(){
        $columnFilterHtml = $this->getColumnFilters();
        echo json_encode(array(
            'columnFilter' => $columnFilterHtml
        )); die;
    }

    function getColor($color){
        switch($color){
            case 'Red':
                $html = '<div class="color-palette bg-red"></div>';
                break;
            case 'Green':
                $html = '<div class="color-palette bg-green"></div>';
                break;
            case 'Yellow':
                $html = '<div class="color-palette bg-yellow"></div>';
                break;
            case 'Not_Selected':
                $html = '<div class="color-palette bg-default"></div>';
                break;
            default:
                $html = '<div class="color-palette bg-default"></div>';
                break;
        }
        return $html;
    }

    function action_export(){

        global $current_user;

        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        $log_in_user_id = $current_user->id;

        $day        = isset( $_GET['day'] ) ? $_GET['day'] : $_COOKIE['day'];
        $status_c   = isset( $_GET['status_c'] ) ? $_GET['status_c'] : '';
        $dropped    = isset( $_GET['dropped'] ) ? $_GET['dropped'] : '';
        $type       = isset( $_GET['csvtype'] ) ? $_GET['csvtype'] : '';

        $query = "SELECT opportunities.*, opportunities_cstm.*,
        CAST(REPLACE(year_quarters.total_input_value, ',', '')as SIGNED) as total_input_value FROM opportunities 
            LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c 
            LEFT JOIN year_quarters ON year_quarters.opp_id = opportunities.id
            WHERE opportunities.deleted != 1 AND opportunities.date_entered >= now() - interval '$day' day ";

        if($status_c){
            $query .= " AND opportunities_cstm.status_c='$status_c'";
        }

        if($type){
            $query .= " AND opportunities.opportunity_type='$type' AND opportunities.id NOT IN(
                SELECT opp_id FROM untagged_user WHERE user_id LIKE '%$log_in_user_id%'
            )";
        }

        if($status_c == 'Closed'){
            $query .= ' AND opportunities_cstm.closure_status_c = "won" ';
        }else if($status_c == 'Dropped' ){
            $query = "SELECT opportunities.*, opportunities_cstm.*,
        CAST(REPLACE(year_quarters.total_input_value, ',', '')as SIGNED) as total_input_value FROM opportunities 
                LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c 
                LEFT JOIN year_quarters ON year_quarters.opp_id = opportunities.id
                WHERE opportunities.deleted != 1 AND opportunities.date_entered >= now() - interval '$day' day ";
            if ($dropped) {
                if ($dropped == 'Dropped') {
                    $query .= "AND opportunities_cstm.status_c='Dropped'";
                } else {
                    $query .= "AND (opportunities_cstm.status_c='Closed' AND opportunities_cstm.closure_status_c = 'lost')";
                }
            } else {
                $query .= "AND (opportunities_cstm.status_c='Dropped' OR (opportunities_cstm.status_c='Closed' AND opportunities_cstm.closure_status_c = 'lost'))";
            }
        }


        $query .= $this->getFilterQuery();  //get filter query if any;

        // echo $query;

        $columnFields = $this->opportunityColumns('Dropped');
        foreach($columnFields['default'] as $key => $field){
            $headers[] = $field;
        }
        foreach($columnFields['addons'] as $key => $field){
            $headers[] = $field;
        }

        $result = $GLOBALS['db']->query($query);
        while($row = $GLOBALS['db']->fetchByAssoc($result)){
            $created_by_id = $row['created_by'];

            $user_name_fetch = "SELECT * FROM users WHERE id='$created_by_id'";
            $user_name_fetch_result = $GLOBALS['db']->query($user_name_fetch);
            $user_name_fetch_row = $GLOBALS['db']->fetchByAssoc($user_name_fetch_result);

            $user_name = $user_name_fetch_row['user_name'];
            $first_name = $user_name_fetch_row['first_name'];
            $last_name = $user_name_fetch_row['last_name'];

            if ($user_name_fetch_row['reports_to_id']) {
                $reports_to = $this->get_user_details_by_id($user_name_fetch_row['reports_to_id']);
                $reports_to_full_name = ' <i class="fa fa-arrow-right"></i> ' . $reports_to['first_name'] .' '. $reports_to['last_name'];
            } else {
                $reports_to_full_name = "";
            }

            $full_name = "$first_name  $last_name $reports_to_full_name";
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
            $oppID = $row['id'];

            /*$tagged_user_query = "SELECT user_id, count(*) FROM `tagged_user` WHERE `opp_id`='$oppID' GROUP BY user_id";
            $tagged_user_query_fetch = $GLOBALS['db']->query($tagged_user_query);
            $tagged_user_query_fetch_row = $GLOBALS['db']->fetchByAssoc($tagged_user_query_fetch);
            $tagged_users = $tagged_user_query_fetch_row['user_id'];*/

            if($row['date_closed'])
                $closedDate = date_format(date_create($row['date_closed']),'d/m/Y');
            else
                $closedDate = '';



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

            $data[] = array(
                $row['name'],
                str_replace( '<i class="fa fa-arrow-right"></i>', '-', $full_name),
                // $this->beautify_amount( $row['budget_allocated_oppertunity_c'] ),
                $this->beautify_label( $row['new_department_c'] ),
                $this->beautify_label( $this->beautify_label($row['rfporeoipublished_c']) ),
                $row['date_modified'] ? date_format(date_create($row['date_modified']),'dS F Y') : '',
                $closed_by,
                $row['date_entered'] ? date_format(date_create($row['date_entered']), 'dS F Y') : '',
                //$row['date_closed'] ? date_format(date_create($row['date_closed']),'d/m/Y') : '',
                $this->getMultipleApproverNames( $row['multiple_approver_c'] ),
                $this->beautify_label( $row['state_c'] ),
                // $this->beautify_label( $row['new_department_c'] ),
                $this->beautify_label( $row['source_c'] ),
                $this->beautify_label( $row['non_financial_consideration_c'] ),
                $this->beautify_label( $row['segment_c'] ),
                $this->beautify_label( $row['product_service_c'] ),
                $this->beautify_label( $row['international_c'] ),
                $this->beautify_label( $row['total_input_value'] ),
                $this->beautify_label( $row['sector_c'] ),
                $this->beautify_label( $row['sub_sector_c'] ),
                $row['scope_budget_projected_c'] ? $this->beautify_label( date( 'dS F Y', strtotime($row['scope_budget_projected_c']) ) ) : '',
                $row['rfp_eoi_projected_c'] ? $this->beautify_label( date('dS F Y', strtotime($row['rfp_eoi_projected_c']) ) ) : '',
                $row['rfp_eoi_published_projected_c'] ? $this->beautify_label( date('dS F Y', strtotime($row['rfp_eoi_published_projected_c']) ) ) : '',
                $row['work_order_projected_c'] ? $this->beautify_label( date('dS F Y', strtotime($row['work_order_projected_c']) ) ) : '',
                $this->beautify_amount( $row['budget_head_amount_c'] ),
                $this->beautify_label( $row['budget_allocated_oppertunity_c'] ),
                $row['project_implementation_start_c'] ? $this->beautify_label( date('dS F Y', strtotime($row['project_implementation_start_c']) ) ) : '',
                $row['project_implementation_end_c'] ? $this->beautify_label( date('dS F Y', strtotime($row['project_implementation_end_c']) ) ) : '',
                $row['selection_c'].' '.$row['funding_c'].' '.$row['timing_button_c'],
                $this->beautify_label( $row['submissionstatus_c'] ),
                $this->beautify_label( $row['closure_status_c'] )
            );

        }

        $_SESSION['csvHeaders'] = serialize($headers);
        $_SESSION['csvData']    = serialize($data);

        $response = json_encode(
            array(
                'status' => 'success',
            )
        );

        echo $response; die;
    }

    function action_downloadCSV(){
        $data    = unserialize($_SESSION['csvData']);
        $headers = unserialize($_SESSION['csvHeaders']);

        $filename = date('Ymdhis');
        ob_clean();
        $fp = fopen("php://output", 'w');
        if($fp){
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="'.$filename.'".csv"');
            fputcsv($fp, array_values($headers));
            foreach($data as $d){
                fputcsv($fp, array_values($d));
            }
            fpassthru($fp);
            fclose($fp);
            unset($_SESSION['csvHeaders']);
            unset($_SESSION['csvData']);
            exit;
        }
    }



    //--------------------------------------for re-assignment----------------------//
   function is_reassignment_applicable($opportunity_id) {
        global $current_user;
         $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
    	$log_in_user_id = $current_user->id;
        $sql ='SELECT * FROM `approval_table` WHERE `opp_id`="'.$opportunity_id.'" AND `pending`="1"';
        $result = $GLOBALS['db']->query($sql);
        $pending_count=$result->num_rows;
        $sql1 ='SELECT users.reports_to_id, users_cstm.mc_c FROM users INNER JOIN users_cstm ON users_cstm.id_c= "'.$log_in_user_id.'" WHERE reports_to_id = "'.$log_in_user_id.'"';
        $result1 = $GLOBALS['db']->query($sql1);
        $reporting_count=$result1->num_rows;
         while($row = $GLOBALS['db']->fetchByAssoc($result1)) {
            $mc_check=$row['mc_c'];
         }
        
        $sql2 ='SELECT t1.id ,t1.assigned_user_id,t2.multiple_approver_c FROM opportunities as t1 LEFT JOIN opportunities_cstm as t2 ON t2.id_c = t1.id WHERE t1.id= "'.$opportunity_id.'" AND (t1.assigned_user_id="'.$log_in_user_id.'" OR t2.multiple_approver_c LIKE "%'.$log_in_user_id.'%")';
        $result2 = $GLOBALS['db']->query($sql2);
        $reporting_count1=$result2->num_rows;
         \LoggerManager::getLogger()->debug($reporting_count);
        // $GLOBALS['log']->debug('Debug level message'); 
        // return true;
        // print($reporting_count);
        if($mc_check=="yes"){
         return (($pending_count <= 0));
        } 
        else{
             return (($pending_count <= 0) && ($reporting_count > 0) && ($reporting_count1 > 0));
        }
    }
    
    
    
    public function action_new_assigned_list(){
     try{
         $db = \DBManagerFactory::getInstance();
        	$GLOBALS['db'];
        	  
        	   global $current_user; 
        	   
            $opportunity_id=$_POST['oppss_id'];
            $fetch_total_opportunity = "SELECT * FROM opportunities LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE id = '$opportunity_id'";
            $fetch_total_result = $GLOBALS['db']->query($fetch_total_opportunity);
            $fetch_total = $GLOBALS['db']->fetchByAssoc($fetch_total_result);
    	    $rfp=$fetch_total['rfporeoipublished_c'];
    	    $status=$fetch_total['status_c'];
    	    $op_name = $fetch_total['name'];
    	    $present_assigned_user=$fetch_total['assigned_to_new_c'];

    	   
    	    $combined=array();
        	  $id_array1=array();
        	  $id_array=array();
        	  $name_array=array();
        	  $func_array=array();
        	 $func1_array=array();
              $h_array=array();
              $r_name=array();
              $number=array();
              $func2_array=array();
              $h1_array=array();
              $Approved_array=array();
              $Rejected_array=array();
              $pending_array=array();
              
              $n=1;
    	  $log_in_user_id = $current_user->id;
    	  
    	  
    	   $sql5='SELECT * FROM opportunities WHERE id="'.$opportunity_id.'"';
    	    $result5 = $GLOBALS['db']->query($sql5);
        while($row5 = $GLOBALS['db']->fetchByAssoc($result5)) 
        {
    	       $created_by=$row5['assigned_user_id']; 
    	       $assigned_id=$row5['assigned_user_id'];
    	       
        }
          
        	
        	$sql6='SELECT * FROM users WHERE id="'.$assigned_id.'"';
    	    $result6 = $GLOBALS['db']->query($sql6);
        while($row6 = $GLOBALS['db']->fetchByAssoc($result6)) 
        {
    	       $reports_to=$row6['reports_to_id'];  
    	       
        }
        		$sql7="SELECT CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS name FROM users WHERE id='".$log_in_user_id."'";
    	    $result7 = $GLOBALS['db']->query($sql7);
        while($row7 = $GLOBALS['db']->fetchByAssoc($result7)) 
        {
    	       $mc_name=$row7['name'];  
    	       
        }
        	
         $sql = "SELECT users.id, users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '".$log_in_user_id."' AND users.deleted = 0";
        $result = $GLOBALS['db']->query($sql);
        while($row = $GLOBALS['db']->fetchByAssoc($result)) 
        {
            $check_sales = $row['teamfunction_c'];
            $check_mc = $row['mc_c'];
            $check_team_lead = $row['teamheirarchy_c'];
            
        }
         
         
         //*********************************** Flow Starts here**************************  
        if($check_mc=='yes'){
           
            
            $sql3 = "SELECT * FROM users_cstm" ;
        $result3 = $GLOBALS['db']->query($sql3);
        while($row3 = $GLOBALS['db']->fetchByAssoc($result3)) 
        {
         $func_array=$row3['teamfunction_c'];
          
     	$array = explode(",",$func_array);
     	
     	if($rfp=='no'|| $rfp=='select'){
     	  
     	    if($status=='Lead'){
     	      
     	        	if(in_array("^sales^",$array)){
     	        	  
     	              $id_array1[]=$row3["id_c"];
     	    
              	  };
     	    }
     	    
     	    else if($status=='QualifiedLead'){
     	        	if(in_array("^sales^",$array)||in_array("^presales^",$array)){
     	              $id_array1[]=$row3["id_c"];
     	    
              	  };
     	    }
     	    else if($status=='Qualified'){
     	        
     	        if(in_array("^sales^",$array)||in_array("^presales^",$array)){
     	              $id_array1[]=$row3["id_c"];
     	    
              	  };
     	        
     	    }
     	    else if($status=='QualifiedDpr'){
     	        
     	        if(in_array("^sales^",$array)||in_array("^bid^",$array)){
     	              $id_array1[]=$row3["id_c"];
     	    
              	  };
               	  
     	    }
     	    else if($status=='QualifiedBid'){
     	        if(in_array("^sales^",$array)||in_array("^bid^",$array)){
     	              $id_array1[]=$row3["id_c"];
     	    
              	  };
     	    }
     	    else if($status=='Closed'){
     	        	if(in_array("^sales^",$array)){
     	              $id_array1[]=$row3["id_c"];
     	    
              	  };
     	    }
     	     else if($status=='Drop'){
     	        	if(in_array("^sales^",$array)){
     	              $id_array1[]=$row3["id_c"];
     	    
              	  };
     	    }
     	}
     	else if($rfp=='yes' || $rfp=='select'){
     	    
     	      if($status=='Lead'){
     	        	if(in_array("^sales^",$array)){
     	              $id_array1[]=$row3["id_c"];
     	    
              	  };
     	    }
     	    
     	    else if($status=='QualifiedLead'){
     	         if(in_array("^sales^",$array)||in_array("^presales^",$array)||in_array("^bid^",$array)){
     	              $id_array1[]=$row3["id_c"];
     	    
              	  };
     	    }
     	   
     	    else if($status=='QualifiedBid'){
     	         if(in_array("^sales^",$array)||in_array("^bid^",$array)){
     	              $id_array1[]=$row3["id_c"];
     	    
              	  };
     	    }
     	    else if($status=='Closed'){
     	        	if(in_array("^sales^",$array)){
     	              $id_array1[]=$row3["id_c"];
     	    
              	  };
     	    }
     	     else if($status=='Drop'){
     	        	if(in_array("^sales^",$array)){
     	              $id_array1[]=$row3["id_c"];
     	    
              	  };
     	    }
     	    
     	    
     	    
     	}
     	else if($rfp=='not_required' || $rfp=='select'){
     	    
     	    
     	      if($status=='Lead'){
     	        	if(in_array("^sales^",$array)){
     	              $id_array1[]=$row3["id_c"];
     	    
              	  };
     	    }
     	    
     	    else if($status=='QualifiedLead'){
     	         if(in_array("^sales^",$array)||in_array("^presales^",$array)){
     	              $id_array1[]=$row3["id_c"];
     	    
              	  };
     	    }
     	    else if($status=='Qualified'){
     	         if(in_array("^sales^",$array)||in_array("^presales^",$array)){
     	              $id_array1[]=$row3["id_c"];
     	    
              	  };
     	    }
     	    else if($status=='QualifiedDpr'){
     	         if(in_array("^sales^",$array)||in_array("^bid^",$array)){
     	              $id_array1[]=$row3["id_c"];
     	    
              	  };
     	    }
     	  
     	    else if($status=='Closed'){
     	        	if(in_array("^sales^",$array)){
     	              $id_array1[]=$row3["id_c"];
     	    
              	  };
     	    }
     	     else if($status=='Drop'){
     	        	if(in_array("^sales^",$array)){
     	              $id_array1[]=$row3["id_c"];
     	    
              	  };
     	    }
     	    
     	    
     	}
     
     	
        }
         
        
   
       
      // $sql1 = "SELECT users.id, CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS name,users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE id IN ('".implode("','",$id_array1)."') AND users.deleted = 0 ORDER BY `name` ASC";
       
       $sql1 = "SELECT users_cstm.teamfunction_c,users_cstm.teamheirarchy_c, users1.id,CONCAT(IFNULL(users1.first_name,''), ' ', IFNULL(users1.last_name,'')) AS name,CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS r_name , rpt_cstm.teamfunction_c as r_r_tf, rpt_cstm.teamheirarchy_c as r_r_th FROM users INNER JOIN users as users1 ON users.id=users1.reports_to_id INNER JOIN users_cstm as rpt_cstm ON rpt_cstm.id_c= users1.reports_to_id INNER JOIN users_cstm ON users_cstm.id_c=users1.id  WHERE users1.id IN ('".implode("','",$id_array1)."') AND users1.deleted=0 ORDER BY `name` ASC";
        $result1 = $GLOBALS['db']->query($sql1);
        while($row1 = $GLOBALS['db']->fetchByAssoc($result1)) 
        {
            array_push($number,$n);
            array_push($func1_array,$row1['teamfunction_c']);
           
            array_push($name_array,$row1['name']);
          array_push($h_array,$row1['teamheirarchy_c']);
            array_push($r_name,$row1['r_name']);
            array_push($func2_array,$row1['r_r_tf']);
            array_push($h1_array,$row1['r_r_th']);
            $n++;
        }
        




      
    $combined = array_map(function($b,$c,$d,$e,$f,$g) { if ($f==""){$f='MC';}return  $b.' / '.$c.' / '.$d.' -> '.$e.' / '.$f.' / '.$g; }, $name_array,$func1_array, $h_array,$r_name,$func2_array,$h1_array);      
      $mc_no=$n+1;
      $mc_no=strval($mc_no); 
     
      $mc_details=$mc_name.' / MC / ';
      
      array_push($combined,$mc_details);
      
   
     
      echo json_encode(array('1'=>$name_array,'2'=>$h_array,'3'=>$r_name,'a'=>$combined,'op_name'=>$op_name,'id'=>$opportunity_id,'present_assigned_user'=>$present_assigned_user));
      
      
        }
        
        
        else if($check_team_lead=='team_member_l1'||$check_team_lead=='team_member_l2'||$check_team_lead=='team_member_l3'||$check_team_lead=='team_lead'){
           
         $sql4='SELECT * FROM users WHERE reports_to_id="'.$log_in_user_id.'" AND deleted=0' ;
          $result4 = $GLOBALS['db']->query($sql4);
          
          if($result4->num_rows>0){
               
              while($row4 = $GLOBALS['db']->fetchByAssoc($result4)) 
                {
                
                  $id_array1[]=$row4["id"];
                }
              
            array_push($id_array1,$log_in_user_id);
            
             if($log_in_user_id==$assigned_id||$log_in_user_id==$reports_to||$opportunity_id==''){
                 
               
                  
                  $sql1="SELECT users_cstm.teamfunction_c,users_cstm.teamheirarchy_c, users1.id,CONCAT(IFNULL(users1.first_name,''), ' ', IFNULL(users1.last_name,'')) AS name,CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS r_name FROM users INNER JOIN users as users1 ON users.id=users1.reports_to_id INNER JOIN users_cstm ON users_cstm.id_c=users1.id WHERE users1.id IN ('".implode("','",$id_array1)."') AND users1.deleted=0 ORDER BY `name` ASC";
                    $result1 = $GLOBALS['db']->query($sql1);
                    while($row1 = $GLOBALS['db']->fetchByAssoc($result1)) 
                    {
                        array_push($number,$n);
                        array_push($func1_array,$row1['teamfunction_c']);
                       
                        array_push($name_array,$row1['name']);
                      array_push($h_array,$row1['teamheirarchy_c']);
                        array_push($r_name,$row1['r_name']);
                        $n++;
                    }
                    




      
      $combined = array_map(function($b,$c,$d,$e) { return  $b.' / '.$c.' / '.$d.' -> '.$e; }, $name_array,$func1_array, $h_array,$r_name);
      
     
          
     
      echo json_encode(array('1'=>$name_array,'2'=>$h_array,'3'=>$r_name,'a'=>$combined, 'op_name'=>$op_name,'id'=>$opportunity_id,'present_assigned_user'=>$present_assigned_user));
                 
                 
             }
             
             else{
                 echo json_encode("block");
             }
          }
          
          else{
            
              echo json_encode("block");
          }
          
        }
        
        
        
   
     }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}


public function action_update_home_assigned_id(){
     try{
         $db = \DBManagerFactory::getInstance();
        	$GLOBALS['db'];
        	  
        	   global $current_user; 
        	    $log_in_user_id = $current_user->id;
        	    $assigned_name=$_POST['assigned_name'];
        	    $opportunity_id=$_POST['opp_id'];
        	    
        	   
        	     $sql="SELECT id,reports_to_id  FROM users WHERE CONCAT(first_name, ' ', last_name) ='".$assigned_name."' ";
        	    
        	     $result = $GLOBALS['db']->query($sql);
        	     
        while($row = $GLOBALS['db']->fetchByAssoc($result)) 
        {
            
            
          $assigned_id=$row['id'];
           
          $reports_to_id = $row['reports_to_id'];
    
            
        }
        
        if($assigned_id==''){
            
            echo json_encode(array("message"=>'false'));
            
        }
        else{
        
        $sql1='SELECT * FROM opportunities_cstm WHERE id_c="'.$opportunity_id.'"';
        	   
        	   $result1 = $GLOBALS['db']->query($sql1);
        	 
        	    if($result1->num_rows>0){
        	        
        	        while($row1= $GLOBALS['db']->fetchByAssoc($result1)) 
        {
                      $multiple=$row1['multiple_approver_c'];
        }
                $sql23='UPDATE `opportunities_cstm` SET `assigned_to_new_c`="'.$assigned_name.'" WHERE id_c="'.$opportunity_id.'"';
        	     
        	     $result23 = $GLOBALS['db']->query($sql23);
        	       
        	     $sql2='UPDATE `opportunities` SET `assigned_user_id`="'.$assigned_id.'" WHERE id="'.$opportunity_id.'"';
        	     
        	     $result2 = $GLOBALS['db']->query($sql2);
        	     
        	     
        	     
        	      if($db->query($sql2)==TRUE){
        	          
                         $multiple_array=explode(',',$multiple);
                         
                         if(count($multiple_array)>1){
                             
                             $key=0;
                              unset($multiple_array[$key]);
                              array_unshift($multiple_array,$reports_to_id);
                              
                              $reports=implode(',',$multiple_array);
                               $sql3='UPDATE `opportunities_cstm` SET `multiple_approver_c`="'.$reports.'" WHERE id_c="'.$opportunity_id.'"';
        	           $result3 = $GLOBALS['db']->query($sql3);
        	           
        	          $sql31='UPDATE `opportunities_cstm` SET `user_id2_c`="'.$reports_to_id.'" WHERE id_c="'.$opportunity_id.'"';
        	           $result31 = $GLOBALS['db']->query($sql31);
        	           
        	           if($db->query($sql3)==TRUE){
        	               echo json_encode(array("status"=>true, "message" => "Success"));
        	               
        	           }
                              
                         }
                         else{
                              $sql31='UPDATE `opportunities_cstm` SET `user_id2_c`="'.$reports_to_id.'" WHERE id_c="'.$opportunity_id.'"';
        	           $result31 = $GLOBALS['db']->query($sql31);
                              $sql3='UPDATE `opportunities_cstm` SET `multiple_approver_c`="'.$reports_to_id.'" WHERE id_c="'.$opportunity_id.'"';
        	           $result3 = $GLOBALS['db']->query($sql3);
        	           
        	           if($db->query($sql3)==TRUE){
        	               echo json_encode(array("status"=>true, "message" => "Success"));
        	           }
                         }
        	      
        	          
        	       
              
             	
          }
        	    }
        	    else{
        	        echo json_encode(array("status"=>true, "message" => "Failed"));
        	    }
        }
        
        
        
        
        
        
        
        
        
        
        
     }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}



public function action_assigned_history(){
     try{
         $db = \DBManagerFactory::getInstance();
        	$GLOBALS['db'];
        	  
        	   global $current_user; 
        	    $log_in_user_id = $current_user->id;
        	    $assigned_name=$_POST['assigned_name'];
        	    $opportunity_id=$_POST['opp_id'];
        	    
        	   
        	     $sql="SELECT id,reports_to_id  FROM users WHERE CONCAT(first_name, ' ', last_name) ='".$assigned_name."' ";
        	    
        	     $result = $GLOBALS['db']->query($sql);
        	     
        while($row = $GLOBALS['db']->fetchByAssoc($result)) 
        {
            
            
          $assigned_id=$row['id'];
           
          $reports_to_id = $row['reports_to_id'];
    
            
        }
        
    
        
        
         $assigned_to_new= $assigned_id;
         $approvers_new = $reports_to_id;
         
         
         $sql41='SELECT t1.id, t1.assigned_user_id,t2.multiple_approver_c,t2.status_c,t2.rfporeoipublished_c FROM opportunities as t1 LEFT JOIN opportunities_cstm as t2 ON t2.id_c = t1.id WHERE t1.id="'.$opportunity_id.'"';	    
        $result41 = $GLOBALS['db']->query($sql41);
        while($row41 = $GLOBALS['db']->fetchByAssoc($result41)) 
        { 
        $opp_id=$row41['id']; 
        $assigned_to=$row41['assigned_user_id'];
        $approvers=$row41['multiple_approver_c'];
        $opp_status=$row41['status_c'];
        $rfp=$row41['rfporeoipublished_c'];
        }
        
      
        $sql51 ='SELECT t.id, t.opp_id, t.assigned_by, t.assigned_to_id FROM assign_flow t WHERE t.opp_id="'.$opp_id.'" AND t.assigned_to_id="'.$assigned_to.'" AND t.id=(SELECT MAX(id) FROM assign_flow WHERE opp_id="'.$opp_id.'")';
			$result51 = $GLOBALS['db']->query($sql51);
			
            $count=$result51->num_rows;
            echo $count;
			if($count>0){
			    
			}
            else{ 
                 
                $sql25='INSERT INTO `assign_flow`(`opp_id`, `assigned_by`, `assigned_to_id`, `approver_ids`,`status`,`rfp_eoi`) VALUES ("'.$opp_id.'","'.$log_in_user_id.'","'.$assigned_to_new.'","'.$approvers_new.'","'.$opp_status.'","'.$rfp.'")';
                //$result25 = $GLOBALS['db']->query($sql25);
                if($db->query($sql25)==TRUE){
                    
                                    echo json_encode(array("status"=>true, "message" => "Success"));
                }
            }
                     
        
        
        
        
        
        
        
        
     }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}





}

?>