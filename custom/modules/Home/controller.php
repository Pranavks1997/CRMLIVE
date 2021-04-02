
<?php

use Robo\Task\File\Concat;


if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/MVC/Controller/SugarController.php');
require_once('includes/functions.php');
require_once('includes/helpers.php');

class HomeController extends SugarController{
    
    public function action_getHtml(){
        ob_start();
        include_once 'templates/main.php';
        $contents = ob_get_contents();
        ob_end_clean();
        echo json_encode(array('data' => $contents)); die;
    }

    /* opportunities table */
    public function action_getOpportunities(){
        try
        {
            $GLOBALS['db'];
            global $current_user;
            $db      = \DBManagerFactory::getInstance();
            
            $content = '';
            $log_in_user_id = $current_user->id;
            
            $day        = $_GET['days'];
            $searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';
            $type       = isset($_GET['type']) ? $_GET['type'] : '';
            $status     = isset($_GET['status']) ? $_GET['status'] : '';
            $dropped    = isset($_GET['dropped']) ? $_GET['dropped'] : '';
            $isCritical = isset($_GET['isCritical']) ? $_GET['isCritical'] : false;

            /* getting column filters to variables */
            $columnAmount                   = isset( $_GET['Amount'] ) ? $_GET['Amount'] : '';
            $columnREPEOI                   = isset( $_GET['REP-EOI-Published'] ) ? $_GET['REP-EOI-Published'] : '';
            $columnClosedDate               = isset( $_GET['Closed-Date'] ) ? $_GET['Closed-Date'] : '';
            $columnClosedBy                 = isset( $_GET['Closed-by'] ) ? $_GET['Closed-by'] : '';
            $columnDateCreated              = isset( $_GET['Date-Created'] ) ? $_GET['Date-Created'] : '';
            $columnDateClosed               = isset( $_GET['Date-Closed'] ) ? $_GET['Date-Closed'] : '';

            $columnTaggedMembers            = isset( $_GET['Tagged-Members'] ) ? $_GET['Tagged-Members'] : '';
            $columnViewedBy                 = isset( $_GET['Viewed-by'] ) ? $_GET['Viewed-by'] : '';
            $columnPreviousResponsibility   = isset( $_GET['Previous-Responsbility'] ) ? $_GET['Previous-Responsbility'] : '';
            $columnAttachment               = isset( $_GET['Attachment'] ) ? $_GET['Attachment'] : '';
            /* end column filters */

            $user_for_delegates             = '';
            $self_count                     = 0;
            $team_count                     = 0;
            $lead_data                      = "";
            $global_organization_count      = 0;
            $non_global_organization_count  = 0;
            $fetch_by_status_c              = '';
            $critical_status_count          = 0;


            $user_team                      = userTeam($log_in_user_id);
            $total                          = getCount('opportunities', " date_entered >= now() - interval '".$day."' day ");
            $global_organization_count      = getCount('opportunities', " opportunity_type = 'global' AND date_entered >= now() - interval '".$day."' day");
            $non_global_organization_count  = $this->get_non_global_op_count($day);

            $isCritical_query = "SELECT id_c FROM opportunities_cstm WHERE critical_c LIKE '%$log_in_user_id%' AND critical_c LIKE '%yes%'";
            $result_testing = $GLOBALS['db']->query($isCritical_query);
            $idData = array();
            while($row = $GLOBALS['db']->fetchByAssoc($result_testing)){
                $dData = $row['id_c'];
                array_push($idData, $dData);
            }

            $critical_status_count_query = "SELECT count(*) as totalCount FROM opportunities_cstm WHERE critical_c LIKE '%$log_in_user_id%' AND critical_c LIKE '%yes%'";
            $critical_status_count = executeCountQuery($critical_status_count_query);

            $selfCountQuery = "SELECT count(*) as totalCount FROM opportunities 
                LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c 
                WHERE assigned_user_id = '$log_in_user_id' AND deleted != 1 AND date_entered >= now() - interval '".$day."' day";
            $self_count = executeCountQuery($selfCountQuery);

            $user_manager = get_user_manager();
            $teamCountQuery = "SELECT count(*) as totalCount from opportunities 
                WHERE  deleted != 1 AND date_entered >= now() - interval '".$day."' day AND 
                assigned_user_id IN (
                    SELECT id_c FROM users_cstm WHERE user_lineage LIKE '%$user_manager%' OR id_c ='$user_manager' 
                )";
            
            $team_count = executeCountQuery($teamCountQuery);

            $fetch_by_status    = "";
            $result             = array();

            $fetch_status_leads         = "SELECT count(oc.id_c) as mainCount, oc.status_c FROM opportunities o LEFT JOIN opportunities_cstm oc ON o.id = oc.id_c WHERE o.deleted != 1 AND o.date_entered >= now() - interval '".$day."' day GROUP BY oc.status_c";
            $fetch_status_leads_result  = $GLOBALS['db']->query($fetch_status_leads);

            $Lead_chunk                 = $this->get_default_chunk('Lead');
            $QualifiedLead_chunk        = $this->get_default_chunk('QualifiedLead'); 
            $QualifiedOpportunity_chunk = $this->get_default_chunk('Qualified');
            $QualifiedDpr_chunk         = $this->get_default_chunk('QualifiedDpr');
            $QualifiedBid_chunk         = $this->get_default_chunk('QualifiedBid'); 
            $CloseWin_chunk             = $this->get_default_chunk('ClosedWin');
            $ClosedLost_chunk           = $this->get_default_chunk('ClosedLost');
            $Dropped_chunk              = $this->get_default_chunk('Dropped');
            
            $fetch_by_status .= $Lead_chunk .$QualifiedLead_chunk . $QualifiedOpportunity_chunk . $QualifiedDpr_chunk . $QualifiedBid_chunk . $CloseWin_chunk . $ClosedLost_chunk .$Dropped_chunk;
            /* end generate cards */
            $check_mc = $this->is_mc($log_in_user_id);
            /* Opportunities main HTML */
            ob_start();
            include_once 'templates/partials/opportunities/main.php';
            $content = ob_get_contents();
            ob_end_clean();

            $fetch_query = getOpportunitiesQuery(); // getOpportunities Query

            //Pagination Query
            $limit = 5;
            $paginationQuery = $GLOBALS['db']->query($fetch_query);
            $totalCount = 0;
            if($paginationQuery)
                $totalCount = mysqli_num_rows($paginationQuery);
            $numberOfPages = ceil( $totalCount / $limit );
            
            $offset = $_GET['page'] ? ($_GET['page'] - 1)  * $limit : 0;

            $fetch_query .= " LIMIT $offset, $limit";

            $result = $GLOBALS['db']->query($fetch_query);
            $response = $this->mysql_fetch_assoc_all($result); //get all result in an array

            /* Opportunities repeater HTML (Table ROW) */
            ob_start();
            include_once 'includes/helpers.php';
            include_once 'templates/partials/opportunities/repeater.php';
            $content .= ob_get_contents();
            ob_end_clean();

            $delegated_user_name = '';
            $delegated_user_id = $this->get_delegated_user($log_in_user_id);
            if ($delegated_user_id != null) {
                $delegated_user = $this->get_user_details_by_id($delegated_user_id);
                $delegated_user_name = $delegated_user['first_name'] . $delegated_user['last_name'];
            }

            /* Pagination HTML */
            $page = $_GET['page'] ? $_GET['page'] : 1;
            if ($totalCount > ( $page * $limit)){
                $currentPost = ($page * $limit);
            } else {
                $currentPost = $totalCount;
            }
            $content .= '<div class="pagination text-right">';
            $content .= '<p class="d-inline-block">Showing '.$currentPost.' of '.$totalCount.'</p>';

            $type = array(
                'method' => 'opportunity',
                'status' => $_GET['status'],
                'type' => $_GET['type']
            );

            $content .= $this->pagination($page, $numberOfPages, $type, $day, $searchTerm, $_GET['filter']);
            $content .= '</div>';
            /* End Pagination HTML */
            $columnFilterHtml   = $this->getColumnFilters($_GET['status'], $_GET['type']);
            $filters            = $this->getFilterHtml('opportunity', $_GET);

            echo json_encode(array(
                'data'                      => $content,
                'total'                     => $total,
                'self_count'                => $self_count,
                'team_count'                => $team_count,
                'delegate'                  => $this->checkDelegate(),
                'delegateDetails'           => $this->getDelegateDetails(),
                'global_organization_count' => $global_organization_count,
                'non_global_organization'   =>  $non_global_organization_count,
                'critical_status_count'     => $critical_status_count,
                'fetched_by_status'         =>  $fetch_by_status,
                'columnFilter'              => $columnFilterHtml,
                'filters'                   => $filters,
                'isCriticalIds'             => $idData,
                'check_mc'                  =>$check_mc,
                'query_test'                 =>$fetch_query ,
                'user_id'                   =>$log_in_user_id,
            ));
            die();
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }

    function get_default_chunk($status) {
        global $current_user;
        $log_in_user_id = $current_user->id;
        
        $day                  = $_GET['days'];
        $statusVal            = $status;
        $id_val               = $status;
        $default_count        = 0;
        $team_count_by_status = 0;
        $self_count_by_status = 0;
        $closure              = null;

        if ($status == 'ClosedWin' || $status == 'ClosedLost') {
            $statusVal = 'Closed';
            if ($status == 'ClosedWin') {
                $closure = 'won';
                $statusVal = 'ClosedWon';
            } else if ($status == 'ClosedLost') {
                $closure = 'lost';
                $statusVal = 'ClosedLost';
            }
            $default_count = getClosedCounts('org', $day, $log_in_user_id, $closure);
            $team_count_by_status = getClosedCounts('team', $day, $log_in_user_id, $closure);
            $self_count_by_status = getClosedCounts('self', $day, $log_in_user_id, $closure);
        }else{
            $query = "SELECT count(oc.id_c) as totalCount FROM opportunities o LEFT JOIN opportunities_cstm oc ON o.id = oc.id_c WHERE o.deleted != 1 AND o.date_entered >= now() - interval '".$day."' day AND oc.status_c = '$status' GROUP BY oc.status_c";
            $default_count  = executeCountQuery($query);
            $user_manager = get_user_manager();
            $teamCountQuery = "SELECT count(*) as totalCount from opportunities 
                LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c 
                WHERE  deleted != 1 AND date_entered >= now() - interval '".$day."' day AND status_c= '".$status."' AND 
                assigned_user_id IN (
                    SELECT id_c FROM users_cstm WHERE user_lineage LIKE '%$user_manager%' OR id_c ='$user_manager' 
                )";
            $selfCountQuery = "SELECT count(*) as totalCount FROM opportunities 
                LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c 
                WHERE status_c= '".$status."' AND assigned_user_id='$log_in_user_id' AND deleted != 1 AND date_entered >= now() - interval '".$day."' day";

            $team_count_by_status = executeCountQuery($teamCountQuery);
            $self_count_by_status = executeCountQuery($selfCountQuery);
        }

        if ($status == 'Qualified') {
            $statusVal = 'QualifiedOpportunity';
        }
        
        if($_GET['status'] == $id_val)
            $active = 'active';
        else
            $active = '';

        return '<div id=\''.$id_val.'\' class="card-status '.$active.'" onclick="dateBetween(\''.$day.'\',\'\',\'\',\'\',\''.$id_val.'\',null,\''.$closure.'\', 1)">
        <p class="card-status-head">'.split_camel_case($statusVal).'</p>
        <p class="card-status-top"><span class="card-status-number">'. $default_count. '</span> <br> <span class="card-status-subtitle">Org </span> </p>
        <p class="card-status-top"><span class="card-status-number-two">'. $team_count_by_status .'</span> <br> <span class="card-status-subtitle-two">Team </span> </p>
        <p class="card-status-top"><span class="card-status-number-three">'. $self_count_by_status .' </span> <br> <span class="card-status-subtitle-three">Self </span> </p>
                
        </div>';
    }

    function checkDelegate(){
        global $current_user;
        $log_in_user_id = $current_user->id;

        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        // $query = "SELECT count(*) as delegate FROM users WHERE id = '$log_in_user_id' AND reports_to_id != '' ";
        $is_reporting_manager_query = "SELECT count(*) as reporting_manager FROM users WHERE reports_to_id = '$log_in_user_id' ";
        $result1 = $GLOBALS['db']->query($is_reporting_manager_query);
        $result1 = $GLOBALS['db']->fetchByAssoc($result1);
        $query = "SELECT count(*) as delegate FROM users_cstm WHERE id_c = '$log_in_user_id' AND (teamheirarchy_c = 'team_lead' OR mc_c = 'yes')";
        $result = $GLOBALS['db']->query($query);
        $result = $GLOBALS['db']->fetchByAssoc($result);
        return (($result['delegate'] > 0) || ($result1['reporting_manager'] > 0)) ? true : false;

    }

    function getDelegateDetails(){
        global $current_user;
        $log_in_user_id = $current_user->id;

        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        $query = "SELECT u.first_name, u.last_name, oc.user_id2_c FROM opportunities o JOIN opportunities_cstm oc ON oc.id_c = o.id JOIN users u ON u.id = oc.user_id2_c WHERE o.deleted != 1 AND o.date_entered >= now() - interval '1200' day AND oc.delegate = '$log_in_user_id' GROUP BY oc.user_id2_c ";
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
    public function getDelegateCount($userID) {
        $qlLeadCount = $this->delegateCountWithStatus('qualifylead', $userID);
        $qlOppCount = $this->delegateCountWithStatus('qualifyOpportunity', $userID);
        $qlDPRCount = $this->delegateCountWithStatus('qualifyDpr', $userID);
        $qlBidCount = $this->delegateCountWithStatus('qualifyBid', $userID);
        $qlClosedCount = $this->delegateCountWithStatus('closure', $userID);
        $qlDroppedCount = $this->delegateCountWithStatus('Dropping', $userID);
        return ($qlLeadCount + $qlOppCount + $qlDPRCount + $qlBidCount + $qlClosedCount + $qlDroppedCount);
    }

    function delegateCountWithStatus($status, $userID){
        global $current_user;
        $log_in_user_id = $current_user->id;
        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        $query = "SELECT count(*) as count FROM approval_table ap";
        $query .= " JOIN opportunities o ON o.id = ap.opp_id";
        $query .= " WHERE ap.Approved = 0 AND ap.Rejected = 0 AND ap.pending = 1 AND o.deleted != 1 AND o.date_entered >= now() - interval '1200' day AND ap.approver_rejector = '$userID' AND ap.delegate_id = '$log_in_user_id' ";
        if($status)
            $query .= " AND apply_for = '$status'";
        $result = $GLOBALS['db']->query($query);
        $count = $GLOBALS['db']->fetchByAssoc($result);
        return $count['count'];
    }

    function get_non_global_op_count($day) {
        global $current_user;
        $log_in_user_id = $current_user->id;
        $organiztion_non_global_count = "SELECT count(*) as org_non_global_count FROM opportunities WHERE opportunity_type = 'non_global' AND deleted != 1 AND date_entered >= now() - interval '".$day."' day";
        $opp_id_show = private_opps();
        $organiztion_non_global_count .= " AND opportunities.id IN ('".implode("','",$opp_id_show)."')";
        $organiztion_count_result = $GLOBALS['db']->query($organiztion_non_global_count);
        $fetch_organization_count = $GLOBALS['db']->fetchByAssoc($organiztion_count_result);
        $non_global_organization_count = $fetch_organization_count['org_non_global_count'];
        return $non_global_organization_count;
    }

    public function get_delegated_user($log_in_user_id) {
        $fetch_query = "SELECT Count(*) as count,opportunities.assigned_user_id, opportunities_cstm.delegate as delegate FROM opportunities
        LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE deleted != 1 AND date_entered >= now() - interval '1200' day AND opportunities_cstm.user_id2_c = '$log_in_user_id' GROUP BY opportunities_cstm.delegate ORDER BY count DESC";
        $fetch_delegated_user = $GLOBALS['db']->query($fetch_query);
        $fetch_delegated_user_result = $GLOBALS['db']->fetchByAssoc($fetch_delegated_user);
        
        if(!empty($fetch_delegated_user_result))
            $delegated_user = $fetch_delegated_user_result['delegate'];
        else
            $delegated_user = 0;
        return $delegated_user;
    }

    // public function get_document_delegated_user($log_in_user_id) {
    //     $fetch_query = "SELECT Count(*) as count,calls.assigned_user_id, calls_cstm.delegate_id as delegate FROM calls
    //     LEFT JOIN calls_cstm ON calls.id = calls_cstm.id_c WHERE deleted != 1 AND date_entered >= now() - interval '1200' day AND calls_cstm.user_id_c = '$log_in_user_id' GROUP BY calls_cstm.delegate_id ORDER BY count DESC";
    //     $fetch_delegated_user = $GLOBALS['db']->query($fetch_query);
    //     $fetch_delegated_user_result = $GLOBALS['db']->fetchByAssoc($fetch_delegated_user);
        
    //     if(!empty($fetch_delegated_user_result))
    //         $delegated_user = $fetch_delegated_user_result['delegate'];
    //     else
    //         $delegated_user = 0;
    //     return $delegated_user;
    // }
    public function get_document_delegated_user($log_in_user_id) {
        $fetch_query = "SELECT Count(*) as count, documents.assigned_user_id, documents_cstm.delegate_id as delegate FROM documents
        LEFT JOIN documents_cstm ON documents.id = documents_cstm.id_c WHERE deleted != 1  AND documents_cstm.user_id_c = '$log_in_user_id' GROUP BY documents_cstm.delegate_id ORDER BY count DESC";
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
    function checkRecentActivity($oppID){
        $query = "SELECT u.first_name, u.last_name, ap.date_time, ap.apply_for, ap.Approved, ap.Rejected, ap.pending FROM approval_table ap JOIN users u ON u.id = ap.approver_rejector WHERE ap.opp_id = '$oppID' AND ap.pending = 0 ORDER BY ap.id DESC, ap.Rejected ASC LIMIT 1";
        $recentActivity = $GLOBALS['db']->query($query);
        $count = mysqli_num_rows($recentActivity);
        return $count;
    }

    public function is_mc($user_id){
        $sql3 = "SELECT users.id, users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '".$user_id."' AND users.deleted = 0";
        $result3 = $GLOBALS['db']->query($sql3);
        while($row3 = $GLOBALS['db']->fetchByAssoc($result3)) 
        {
            $check_sales = $row3['teamfunction_c'];
            $check_mc = $row3['mc_c'];
            $check_team_lead = $row3['teamheirarchy_c'];
        }
        return $check_mc;

    }

    /* Pending Request */
    function action_getPendingOpportunityList(){
        try
        {
            $content = '';
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            global $current_user;
            $log_in_user_id = $current_user->id;
            
            $status         = $_GET['status'];
            $qlLeadCount    = $this->getOpportunityStatusCount('qualifylead');
            $qlOppCount     = $this->getOpportunityStatusCount('qualifyOpportunity');
            $qlDPRCount     = $this->getOpportunityStatusCount('qualifyDpr');
            $qlBidCount     = $this->getOpportunityStatusCount('qualifyBid');
            $qlClosedCount  = $this->getOpportunityStatusCount('closure');
            $qlDroppedCount = $this->getOpportunityStatusCount('Dropping');

            
            $columnAmount                   = isset( $_GET['Amount'] ) ? $_GET['Amount'] : '';
            $columnREPEOI                   = isset( $_GET['REP-EOI-Published'] ) ? $_GET['REP-EOI-Published'] : '';
            $columnClosedDate               = isset( $_GET['Closed-Date'] ) ? $_GET['Closed-Date'] : '';
            $columnClosedBy                 = isset( $_GET['Closed-by'] ) ? $_GET['Closed-by'] : '';
            $columnDateCreated              = isset( $_GET['Date-Created'] ) ? $_GET['Date-Created'] : '';
            $columnDateClosed               = isset( $_GET['Date-Closed'] ) ? $_GET['Date-Closed'] : '';

            $columnTaggedMembers            = isset( $_GET['Tagged-Members'] ) ? $_GET['Tagged-Members'] : '';
            $columnViewedBy                 = isset( $_GET['Viewed-by'] ) ? $_GET['Viewed-by'] : '';
            $columnPreviousResponsibility   = isset( $_GET['Previous-Responsbility'] ) ? $_GET['Previous-Responsbility'] : '';
            $columnAttachment               = isset( $_GET['Attachment'] ) ? $_GET['Attachment'] : '';
            
            $maxQuery   = "SELECT row_count FROM approval_table 
                    WHERE ap.Approved = 0 AND ap.Rejected = 0 AND ap.pending = 1 
                    AND ( ap.approver_rejector = '$log_in_user_id' OR ap.delegate_id = '$log_in_user_id' ) 
                    AND ap.apply_for = '$status' 
                    ORDER BY row_count 
                    DESC LIMIT 1";
            $result     = $GLOBALS['db']->query($maxQuery);
            $rowCount   = $GLOBALS['db']->fetchByAssoc($result);

            if($rowCount)
                $rowCount = $rowCount['row_count'];

            $fetch_query = getPendingOpportunitiesQuery($rowCount);

            //Pagination Count
            $limit = 5;
            $paginationQuery = $GLOBALS['db']->query($fetch_query);
            $totalCount = mysqli_num_rows($paginationQuery);
            $numberOfPages = ceil( $totalCount / $limit );
            
            $offset = $_GET['page'] ? ($_GET['page'] - 1) * $limit : 0;

            $fetch_query .= " LIMIT $offset, $limit";

            ob_start();
            include_once 'templates/partials/pending-requests/main.php';
            $content = ob_get_contents();
            ob_end_clean();

            $result = $GLOBALS['db']->query($fetch_query);

            $response = $this->mysql_fetch_assoc_all($result); //get all result in an array

            /* Pending Opportunities repeater HTML (Table ROW) */
            ob_start();
            include_once 'templates/partials/pending-requests/repeater.php';
            $content .= ob_get_contents();
            ob_end_clean();


            //Pagination 
            $page = $_GET['page'] ? $_GET['page'] : 1;
            if ($totalCount > ( $page * $limit)){
                $currentPost = ($page * $limit);
            } else {
                $currentPost = $totalCount;
            }
            $content .= '<div class="pagination text-right">';
            $content .= '<p class="d-inline-block">Showing '.$currentPost.' of '.$totalCount.'</p>';

            $type = array(
                'method' => 'pending',
                'status' => $status,
                'type'   => ''
            );
            $content .= $this->pagination($page, $numberOfPages, $type, '30', '', $_GET['filter']);
            $content .= '</div>';

            // echo $content;
            $columnFilterHtml   = $this->getColumnFilters($_GET['status'], 'pending');
            $filters            = $this->getFilterHtml('opportunity', $_GET);

            echo json_encode(array(
                'data'                      => $content,
                'columnFilter'              => $columnFilterHtml,
                'filters'                   => $filters
            )); die();

        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }

    /* Get Opportuinity Status Count */
    function getOpportunityStatusCount($status = null){
        global $current_user;
        $log_in_user_id = $current_user->id;

        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];

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

        $result = $GLOBALS['db']->query($query);
        $count = $GLOBALS['db']->fetchByAssoc($result);
        return $count['count'];
    }
    /* Get Pending Approval Status */
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
    /* get tagged members */
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
    /* get modified user */
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

    /* get opportunity details for approval */
    function action_get_approval_item(){
        try
        {
            global $current_user;
            $log_in_user_id = $current_user->id;
            
            $id = $_POST['opp_id'];
            $event = $_POST['event'];

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $fetch_query = "SELECT o.*, oc.* FROM opportunities o JOIN approval_table ap ON ap.opp_id = o.id LEFT JOIN opportunities_cstm oc ON o.id = oc.id_c WHERE o.deleted != 1 AND o.date_entered >= now() - interval '1200' day AND ap.id = '$id'";
            $result = $GLOBALS['db']->query($fetch_query);
            while($row = $GLOBALS['db']->fetchByAssoc($result))
            {

                $ChangedStatus = $this->getChangeStatus($row['status_c'], $row['rfporeoipublished_c']);

                $created_by_id = $row['assigned_user_id'];
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
                <input type="hidden" name="rfp_eoi" value="'.(beautify_label($row['rfporeoipublished_c'])).'" />
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
                                    <td class="approvaltable-data-boolean-popup">'.(beautify_label($row['rfporeoipublished_c'])).'</td>
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
            echo json_encode(array("status"=>false, "message" => "Some error occured",));
        }
        die();
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
    /* approve / reject pending opportunities */
    function action_opportunity_status_update(){
        try
        {
            global $current_user;
            $log_in_user_id = $current_user->id;
            
            $id = $_POST['opp_id'];
            $status = $_POST['status'];

            $opp_tagged_emails = [];
            $count_query ="SELECT user_id
            FROM tagged_user 
            WHERE opp_id ='$id' ";
            $result = $GLOBALS['db']->query($count_query);
            $row = $GLOBALS['db']->fetchByAssoc($result);

            if($row) {
                
                $opp_tagged_users = explode(',', $row['user_id']);
                
                foreach ($opp_tagged_users as $u) {
                    array_push($opp_tagged_emails, getUserEmail($u));
                }

                // echo json_encode(array("status"=>true, "message" => $row, "extra_data" => $opp_tagged_emails));
                // die();

            } else {

                $opp_tagged_users = [];
                // echo json_encode(array("status"=>false, "message" => $row));
                // die();
            }



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

            $updateOpportunityStatus = "";
            $assigned_id = "";
            $assigned_name = "";
            if($db->query($updateOpportunity)==TRUE){
                if($Approved){
                    if(!$this->checkPendingAndRejectedApprovals($id, $_POST['changed-status'])){
                        $updateOpportunity = "UPDATE opportunities_cstm SET status_c = '$changedStatus' WHERE id_c = '$id'";
                        $db->query($updateOpportunity);
                        
                         $sql_assigned_id = "SELECT assigned_user_id FROM opportunities WHERE id = '$id'";
                         $result_assigned_id = $db->query($sql_assigned_id);
                         while ($row_assigned_id = mysqli_fetch_assoc($result_assigned_id)){
                               $assigned_id=$row_assigned_id['assigned_user_id'];
                            }
                            
                            $sql_assigned_name = "SELECT CONCAT(first_name, ' ',last_name) as name FROM users WHERE id = '$assigned_id'";
                         $result_assigned_name = $db->query($sql_assigned_name);
                         while ($row_assigned_name = mysqli_fetch_assoc($result_assigned_name)){
                                $assigned_name=$row_assigned_name['name'];
                            }
                            
                         }
                }
                $updateOpportunityStatus = "true";
                // echo json_encode(array("status"=>true,  "message" => "Status changed successfully.","opps_id"=>$id,"rfp"=>$rfp_eoi,"opp_status"=>$changedStatus,"assigned_id"=>$assigned_id,"assigned_name"=>$assigned_name));
            }else{
                $updateOpportunityStatus = "false";
                // echo json_encode(array("status"=>false, "message" => "Some error occured"));
            }


            

            $result1 = getQuery('*', 'opportunities', 'id = "'.$id.'"');
            $row1 = $result1->fetch_assoc();

            $result1 = getQuery('multiple_approver_c', 'opportunities_cstm', 'id_c = "'.$id.'"');
            $row2 = $result1->fetch_assoc();

            $multiple_approvers_array = explode(',', $row2['multiple_approver_c']);
            $assigned_user_id = $row1['assigned_user_id'];
            $approver_name = $this->getUserName($log_in_user_id);
            $opportunity_link = "index.php?action=DetailView&module=Opportunities&record=".$id;

            $statusForNotification = '';
            if($changedStatus == "QualifiedLead") {
                $statusForNotification = "Qualified Lead";
            } elseif ($changedStatus == "QualifiedDpr") {
                $statusForNotification = "Qualified DPR";
            } elseif ($changedStatus == "QualifiedBid") {
                $statusForNotification = "Qualified Bid";
            } else {
                $statusForNotification = $changedStatus;
            }



            
            if($event == "Approve") {
        
                $receiver_email = getUserEmail($assigned_user_id);


                if (!in_array($receiver_email, $opp_tagged_emails)) {
                    array_push($opp_tagged_emails, $receiver_email);
                }

                if (!in_array($assigned_user_id, $opp_tagged_users)) {
                    array_push($opp_tagged_users, $assigned_user_id);
                }

                $description = 'Opportunity "'.$row1['name'].'" is approved for "'.$statusForNotification.'" by "'.$approver_name.'".';
                send_notification("Opportunity", $row1['name'], $description, $opp_tagged_users, $opportunity_link);

                $description = $description."<br><br>Click here to view: www.ampersandcrm.com";
                send_email($description, $opp_tagged_emails,'CRM ALERT - Approved');


            } elseif($event == "Reject") {
                
                // $receivers = [$assigned_user_id];
                // $receiver_emails = [getUserEmail($assigned_user_id)];

                $r_email = getUserEmail($assigned_user_id);
                $receivers = $opp_tagged_users;
                $receiver_emails = $opp_tagged_emails;


                if (!in_array($r_email, $receiver_emails)) {
                    array_push($receiver_emails, $r_email);
                }

                if (!in_array($assigned_user_id, $receivers)) {
                    array_push($receivers, $assigned_user_id);
                }

                if($this->isDelegate($log_in_user_id, $id)){
                    foreach($multiple_approvers_array as $a) {
                        if (!in_array($a, $receivers)) {
                            array_push($receivers, $a);
                        }
                    }
                } else {
                    foreach($multiple_approvers_array as $a) {
                        if($a != $log_in_user_id) {
                            if (!in_array($a, $receivers)) {
                                array_push($receivers, $a);
                            }
                        }
                    }
                }

                foreach($receivers as $r) {
                    if (!in_array(getUserEmail($r),$receiver_emails)) {
                        array_push($receiver_emails, getUserEmail($r));
                    }
                }



                $description = 'Opportunity "'.$row1['name'].'" is rejected for "'.$statusForNotification.'" by "'.$approver_name.'".';
                send_notification("Opportunity", $row1['name'], $description, $receivers, $opportunity_link);
                
                $description = $description."<br><br>Click here to view: www.ampersandcrm.com";
                send_email($description,$receiver_emails,'CRM ALERT - Rejected');
            }

            if ($updateOpportunityStatus == "true") {
                echo json_encode(array("status"=>true,  "message" => "Status changed successfully.","opps_id"=>$id,"rfp"=>$rfp_eoi,"opp_status"=>$statusForNotification,"assigned_id"=>$assigned_id,"assigned_name"=>$assigned_name, "is_approved"=>$Approved, "opp_name" =>$row1['name']));
            } else {
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

    /* get pending opp count */
    public function action_opportunity_pending_count(){
        try {
            global $current_user;
            $log_in_user_id = $current_user->id;
    
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            
            $PRC = $this->get_pending_request_count();
            echo json_encode(
                array(
                      'data' => "$PRC <i class=\"fa fa-angle-double-down\" aria-hidden=\"true\"></i>",
                      'count' => $PRC
                    )
            );
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

    /**
     * After Qualified opportunity approver flow changes
     */
    function action_update_multiple_approver(){
        try{
            $db = \DBManagerFactory::getInstance();
               $GLOBALS['db'];
                 
                  global $current_user; 
                   $log_in_user_id = $current_user->id;
                   $approvers_id=$_POST['multiple_approvers_id'];
                   $opps_id=$_POST['opps_id'];
                   
                   $id_array=implode(',',$approvers_id);
                   
                   $update_multiple_approver_id='UPDATE opportunities_cstm SET multiple_approver_c="'.$id_array.'" WHERE id_c="'.$opps_id.'"';
                   
                   $GLOBALS['db']->query($update_multiple_approver_id);
                   
                 
        }catch(Exception $e){
               echo json_encode(array("status"=>false, "message" => "Some error occured"));
           }
           die();
    }

    /* generate pagination */
    function pagination($page, $numberOfPages, $type, $day, $searchTerm, $filter){

        $ends_count = 1;  //how many items at the ends (before and after [...])
        $middle_count = 2;  //how many items before and after current page
        $dots = false;

        $data = '<ul class="d-inline-block">';
        
        if($page > 1)
            $data .= '<li class="" onClick=paginate("'.($page - 1).'","'.$type['method'].'","'.$day.'","'.$searchTerm.'","'.$filter.'","'.$type['status'].'","'.$type['type'].'")><strong>&laquo;</strong> Prev</li>';

        for ($i = 1; $i <= $numberOfPages; $i++) {
            $currentPage = $page ? $page : 1;
            $class = $currentPage == $i ? 'active paginate-class' : 'paginate-class';

            
            $onClick = 'onClick=paginate("'.$i.'","'.$type['method'].'","'.$day.'","'.$searchTerm.'","'.$filter.'","'.$type['status'].'","'.$type['type'].'")';

            if ($i == $page) {
                $data .= '<li class="'.$class.'" '.$onClick.'>'.$i.'</li>';
                $dots = true;
            } else {
                if ($i <= $ends_count || ($page && $i >= $page - $middle_count && $i <= $page + $middle_count) || $i > $numberOfPages - $ends_count) { 
                    $data .= '<li class="'.$class.'" '.$onClick.'>'.$i.'</li>';
                    $dots = true;
                } elseif ($dots){
                    $data .= '<li class="paginate-class">&hellip;</li>';
                    $dots = false;
                }
            }
        }
        if ($page < $numberOfPages || -1 == $numberOfPages) { 
           $data .= '<li class="" onClick=paginate("'.($page + 1).'","'.$type['method'].'","'.$day.'","'.$searchTerm.'","'.$filter.'","'.$type['status'].'","'.$type['type'].'")>Next <strong>&raquo;</strong></li>';
        }
            
        $data .= '</ul>';
        return $data;
    }

    /* Get Seqeunce Flow */
    public function action_getOpportunityStatusTimeline(){
        try{
            $oppID = $_POST['oppID']; 
            $data = '<span class="close-sequence-flow">×</span><div class="wrap padding-tb black-color">';

            $query = "SELECT name,created_by,assigned_user_id,date_entered FROM opportunities WHERE id = '$oppID'";
            $result = $GLOBALS['db']->query($query);
            $result = $GLOBALS['db']->fetchByAssoc($result);
            $created_by = $result['created_by'];
            $created_date = substr($result['date_entered'],0,10);
            $created_date = date('d/m/Y', strtotime($created_date));
            $data .= '<div class="d-block padding">
                    <h2 class="">'.$result['name'].'</h2>
                    <h3 class="gray-color">Approval/Rejection Audit Trail</h3>
                </div>
                <hr>';

            $query = "select u.first_name, u.last_name, ap.opp_id, ap.date_time, ap.apply_for,ap.assigned_by, ap.Approved, ap.Rejected, ap.pending, ap.assign from 
            ( (select opp_id , assigned_to_id, date_time, 'Reassignment' as apply_for, assigned_by, 0 as Approved, 0 as Rejected, 0 as pending, 1 as assign from assign_flow where opp_id ='$oppID'
            and (NOT (assigned_to_id ='$created_by' and status='Lead' and assigned_by ='$created_by')))
            union (select opp_id , approver_rejector as assigned_to_id,updated_at as date_time, apply_for, '' as assigned_by, Approved, Rejected, pending, 0 as assign from approval_table where opp_id ='$oppID') ) ap 
            JOIN users u ON u.id = ap.assigned_to_id order by date_time DESC LIMIT 1";
            $result = $GLOBALS['db']->query($query);
            $result = $GLOBALS['db']->fetchByAssoc($result);
            
            if($result):
            
                $dateExtracted = substr($result['date_time'],0,10);
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
                } else if($result['assign'] == 1) {
                    $class = 'label-blue';
                    $circleClass = 'blue-color blue-bg';
                    $status = 'Reassigned';
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
                            <h5 class="gray-color">'.$created_date.'</h5>
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
                $dateExtracted = substr($row['date_time'],0,10);
                $updateDate = date('d/m/Y', strtotime($dateExtracted));

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

            $data .= '</div>';
            echo json_encode(array('data' => $data));
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
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
    /* End Sequence Flow */

    /* Get Graph */
    public function action_get_graph(){
        $day = $_GET['dateBetween'];
        $totalCount = 0;
        $totalCount = $this->getOpportunityStatusCountGraph(null , $day);
        // $leadCount = round($this->getOpportunityStatusCountGraph('Lead') / $totalCount * 100, 0);
        if ($totalCount > 0) {
            $LeadCount = round($this->getOpportunityStatusCountGraph('Lead', $day) / $totalCount * 100, 0);
            $QualifiedLeadCount = round($this->getOpportunityStatusCountGraph('QualifiedLead', $day) / $totalCount * 100, 0);
            $QualifiedOpporunityCount = round($this->getOpportunityStatusCountGraph('Qualified', $day) / $totalCount * 100, 0);
            $QualifiedDPR = round($this->getOpportunityStatusCountGraph('QualifiedDpr', $day) / $totalCount * 100, 0);
            $QualifiedBid = round($this->getOpportunityStatusCountGraph('QualifiedBid', $day) / $totalCount * 100, 0);
            $Drop = round($this->getOpportunityStatusCountGraph('Dropped', $day) / $totalCount * 100, 0);
            $CloseWon = round($this->getOpportunityStatusCountGraph('Closed', $day, 'won') / $totalCount * 100, 0);
            $CloseLost = round($this->getOpportunityStatusCountGraph('Closed', $day, 'lost') / $totalCount * 100, 0);
        }
        $LeadCount = isset($LeadCount) ? $LeadCount : 0;
        $QualifiedLeadCount = isset($QualifiedLeadCount) ? $QualifiedLeadCount : 0;
        $QualifiedOpporunityCount = isset($QualifiedOpporunityCount) ? $QualifiedOpporunityCount : 0;
        $QualifiedDPR = isset($QualifiedDPR) ? $QualifiedDPR : 0;
        $QualifiedBid = isset($QualifiedBid) ? $QualifiedBid : 0;
        $CloseWon = isset($CloseWon) ? $CloseWon : 0;
        $CloseLost = isset($CloseLost) ? $CloseLost : 0;
        $Drop = isset($Drop) ? $Drop : 0;
        
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

        if($Drop):
            $data .= '<div style="width: '.$Drop.'%" class="graph-bar-each">
                    <div style="width: 100%; height: 70px; background-color: #FF0000;"></div>
                    <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$Drop.'%</p>
                </div>';
        endif; 

        echo $data;
        die();
    }
    function getOpportunityStatusCountGraph($status = null, $day, $closure_status = null){
        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        if($status)
            $query = "SELECT count(*) as count FROM opportunities_cstm oc LEFT JOIN opportunities o ON o.id = oc.id_c WHERE oc.status_c = '".$status."' AND o.deleted != 1 AND o.date_entered >= now() - interval '".$day."' day";
        else
            $query = "SELECT count(*) as count FROM opportunities_cstm oc LEFT JOIN opportunities o ON o.id = oc.id_c WHERE o.deleted != 1 AND date_entered >= now() - interval '".$day."' day";
        
        if ($status == 'Closed' && $closure_status)
            $query .= " AND oc.closure_status_c = '$closure_status'"; 
        $count = $GLOBALS['db']->query($query);
        $count = $GLOBALS['db']->fetchByAssoc($count);
        return $count['count'];
    }

    function mysql_fetch_assoc_all($result){
        $data = array();
        while  ($row = $GLOBALS['db']->fetchByAssoc($result)){
            $data[] = $row;
        }
        return $data;
    }

    /* Misc loading */
    public function action_get_user_details() {
        try{
            global $current_user;
            $log_in_user_id = $current_user->id;
            $check_user_team = "SELECT teamfunction_c, mc_c from users LEFT JOIN users_cstm ON users.id = users_cstm.id_c WHERE id = '$log_in_user_id'";
            $check_user_team_result = $GLOBALS['db']->query($check_user_team);
            $user_team_row = $GLOBALS['db']->fetchByAssoc($check_user_team_result);
            $user_team = $user_team_row['teamfunction_c'];
            $mc_c = $user_team_row['mc_c'];
            echo json_encode(array('user_team'=>$user_team, 'mc_c' =>$mc_c , 'user_id'=> $log_in_user_id));
        }catch(Exception $e){
            echo json_encode(array("message" => "Some error occured"));
        }
        die();
    }
    public function action_delegate_members(){
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
            
            $fetch_query = "SELECT * FROM users WHERE `id` != '$log_in_user_id' AND `id` != '1' AND deleted !=1 ORDER BY `users`.`first_name` ASC";
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
            $full_name = "$first_name  $last_name";

            $sub_head = 'Selected members will be able to view details or take action';
            $change_font = 'Tag Members';

            $data = '
                <h2 class="deselectheading">' . $row['name'] . '</h2><br>
                <p class="deselectsubhead">'.$sub_head.'</p>
                <hr class="deselectsolid">
                <section class="deselectsection">
                <table align="centered" width="100%">
                    <thead>
                    <tr class="tabname">
                        <th>Primary Responsbility</th>
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
                        <td>' . beautify_amount($row["budget_allocated_oppertunity_c"]) . '</td>
                        <td>' . beautify_label($row["rfporeoipublished_c"]) . '</td>
                        <td>' . date_format(date_create($row['date_modified']), 'd/m/Y') . '</td>
                        <td>' . $this->get_closed_by($row) . '</td>
                        <td>'  . date_format(date_create($row['date_entered']), 'd/m/Y') . '</td>
                        </tr>';
                    $data .= '</tbody></table>
                    <hr class="deselectsolid">
                            <label for="Deselect-Members">'.$change_font.'</label><br>';
          $tag_html = $this->getTagUserHtml();
          $msuname = $this->get_initial_multi_selected_dropdown_value($opportunity_id, $this->is_global($opportunity_id), false);
          $msuid = $this->get_initial_multi_selected_dropdown_value($opportunity_id, $this->is_global($opportunity_id), true);
          echo json_encode(array('opportunity_info'=>$data,'msuname'=>$msuname,'msuid'=> $msuid, 'opportunity_id'=>$opportunity_id,"opporunity_tag"=>$tag_html));
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
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

    function get_users_with_opporuntity_tag_options($opportunity_id) {

        try {
            global $current_user;
            $log_in_user_id = $current_user->id;
            $fetch_query = "SELECT * FROM users WHERE deleted = 0 AND `id` != '$log_in_user_id' AND `id` != '1' ORDER BY `users`.`first_name` ASC";
            $result = $GLOBALS['db']->query($fetch_query);
            $data = '';
            $tagged_user_query = "SELECT * from tagged_user where opp_id = '$opportunity_id'";
            $result1 = $GLOBALS['db']->query($tagged_user_query);
            $tagged_user_row = $result1->fetch_assoc();
            $tagged_user_array = explode(',', $tagged_user_row['user_id']);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $full_name = $row['first_name'] . ' ' . $row['last_name'];
                    if (in_array($row['id'],$tagged_user_array)){
                        $data .= '<option value="'.$row['id'].'" selected>'.$full_name.'</option>';
                    }
                    else{
                        $data .= '<option value="'.$row['id'].'" >'.$full_name.'</option>';
                    }
                }
            }
            else{
                $data .= "<option> No value </option>";
            }
            return $data;
        }catch(Exception $e){
            // return False;
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }

    function getTagUserHtml(){
        $opportunity_id = $_GET['id'];
        $users = $this->get_users_with_opporuntity_tag_options($opportunity_id);

        $html = '
            <select class="select2" name="tag_opporunity[]" id="" multiple>
                '.$users.'
            </select>
            '; 
        return $html;
    }
    public function is_global($op_id) {
        $response = getCount('opportunities', " id = '$op_id' AND opportunity_type = 'global' ");
        return $response ? true : false;
    }
    public function multi_id_select_name_map($ids) {
        $arr = explode(',', $ids);
        for ($x = 0; $x < count($arr); $x++) {
            $temp = getUsername($arr[$x]);
            $temp = trim($temp," ");
            $arr[$x] = "$arr[$x]---$temp";
        }
        $str = join(',', $arr);
        return $str;
    }
    public function multi_id_name_map($ids) {
        $arr = explode(',', $ids);
        for ($x = 0; $x < count($arr); $x++) {
            $arr[$x] = getUsername($arr[$x]);
        }
        $str = join(',', $arr);
        return $str;
    }


    function getColumnFilters($status = null, $type = null){
        /* Default Columns */
        if($type == 'pending'){
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
            case 'ClosedWin':
                $fields['addons'] = $QualifiedBid;
                break;
            case 'ClosedLost':
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

        // $testData = ['Amount','REP-EOI-Published','Closed-Date','Closed-by','Date-Created',
        // 'Date-Closed','multiple_approver_c',
        // 'state_c','new_department_c','source_c','non_financial_consideration_c',
        // 'segment_c','product_service_c','international_c','total_input_value','sector_c','sub_sector_c','scope_budget_projected_c','rfp_eoi_projected_c','rfp_eoi_published_projected_c','work_order_projected_c','budget_head_amount_c','budget_allocated_oppertunity_c',
        // 'project_implementation_start_c','project_implementation_end_c','selection_c',
        // 'submissionstatus_c','closure_status_c'];

        // $hidden = array_diff($testData, $customColumns);

        if($customColumns):
        foreach($customColumns as $column){
            $data .= $this->getColumnDataHtml($column, $row);
        }
        endif;
        // echo json_encode(array("status" => false, "data" => $hidden));
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
                $data .= '<td class="table-data">'.(beautify_label((beautify_label($row['rfporeoipublished_c'])))).'</td>';
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
                $data .= '<td class="table-data" >'.beautify_label( $row['state_c'] ).'</td>';
                break;

            case 'new_department_c':
                $data .= '<td class="table-data" >'.beautify_label( $row['new_department_c'] ).'</td>';
                break;

            case 'source_c':
                $data .= '<td class="table-data" >'.beautify_label( $row['source_c'] ).'</td>';
                break;

            case 'non_financial_consideration_c':
                if ($row['non_financial_consideration_c'] == null || $row['non_financial_consideration_c'] == '') {
                    $row['non_financial_consideration_c'] = '^NA^';
                }
                $data .= '<td class="table-data" >'.beautify_test(beautify_label_n_f( $row['non_financial_consideration_c'] )).'</td>';
                break;

            case 'segment_c':
                $data .= '<td class="table-data" >'.beautify_label( $row['segment_c'] ).'</td>';
                break;

            case 'product_service_c':
                $data .= '<td class="table-data" >'.beautify_label( $row['product_service_c'] ).'</td>';
                break;

            case 'international_c':
                $data .= '<td class="table-data" >'.beautify_label( $row['international_c'] ).'</td>';
                break;

            case 'total_input_value':
                $data .= '<td class="table-data" >'.$this->append_currency($row['currency_c'], $this->beautify_amount($row['total_input_value'] )).'</td>';
                break;

            case 'sector_c':
                $data .= '<td class="table-data" >'.beautify_label( $row['sector_c'] ).'</td>';
                break;

            case 'sub_sector_c':
                $data .= '<td class="table-data" >'.beautify_label( $row['sub_sector_c'] ).'</td>';
                break;

            case 'scope_budget_projected_c':
                $scope_budget_projected_c = $row['scope_budget_projected_c'] ? beautify_label( date('d/m/Y', strtotime($row['scope_budget_projected_c'])) ) : '';
                $data .= '<td class="table-data" >'.$scope_budget_projected_c.'</td>';
                break;

            case 'rfp_eoi_projected_c':
                $rfp_eoi_projected_c = $row['rfp_eoi_projected_c'] ? beautify_label( date('d/m/Y', strtotime($row['rfp_eoi_projected_c'])) ) : '';
                $data .= '<td class="table-data" >'.$rfp_eoi_projected_c.'</td>';
                break;

            case 'rfp_eoi_published_projected_c':
                $rfp_eoi_published_projected_c = $row['rfp_eoi_published_projected_c'] ? beautify_label( date('d/m/Y', strtotime($row['rfp_eoi_published_projected_c'])) ) : '';
                $data .= '<td class="table-data" >'.
                $rfp_eoi_published_projected_c
                .'</td>';
                break;

            case 'work_order_projected_c':
                $work_order_projected_c = $row['work_order_projected_c'] ? beautify_label( date('d/m/Y', strtotime($row['work_order_projected_c'])) ) : '';
                $data .= '<td class="table-data" >'.$work_order_projected_c.'</td>';
                break;

            case 'budget_head_amount_c':
                $data .= '<td class="table-data" >'.$this->append_currency($row['currency_c'], $this->beautify_amount(( $row['budget_head_amount_c'] ))).'</td>';
                break;

            case 'budget_allocated_oppertunity_c':
                $data .= '<td class="table-data" >'.beautify_label( $row['budget_allocated_oppertunity_c'] ).'</td>';
                break;

            case 'project_implementation_start_c':
                $project_implementation_start_c = $row['project_implementation_start_c'] ? beautify_label( date('d/m/Y', strtotime($row['project_implementation_start_c'])) ) : '';
                $data .= '<td class="table-data" >'.$project_implementation_start_c.'</td>';
                break;

            case 'project_implementation_end_c':
                $project_implementation_end_c = $row['project_implementation_end_c'] ? beautify_label( date('d/m/Y', strtotime($row['project_implementation_end_c'])) ) : '';
                $data .= '<td class="table-data" >'.$project_implementation_end_c.'</td>';
                break;

            case 'selection_c':
                $data .= '<td class="table-data" >';
                $data .= $this->getColor( $row['selection_c'] );
                $data .= $this->getColor( $row['funding_c'] );
                $data .= $this->getColor( $row['timing_button_c'] );
                $data .= '</td>';
                break;

            case 'submissionstatus_c':
                $data .= '<td class="table-data" >'.beautify_label( $row['submissionstatus_c'] ).'</td>';
                break;

            case 'closure_status_c':
                $data .= '<td class="table-data" >'.beautify_label( $row['closure_status_c'] ).'</td>';
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

        $budget_head_c                  = @$columnFilter['budget_head_amount_c'];
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
                $states .= '<option value="'.$s['name'].'">'.beautify_label( $s['name'] ).'</option>';
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
                $departmentList .= '<option value="'.$d['name'].'">'.beautify_label( $d['name'] ).'</option>';
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
                $sourceList .= '<option value="'.$d['source_c'].'">'.beautify_label( $d['source_c'] ).'</option>';
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
                $dataList .= '<option value="'.$d.'">'.beautify_test(beautify_label( $d )).'</option>';
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
                $segmentList .= '<option value="'.$d['segment_name'].'">'.beautify_label( $d['segment_name'] ).'</option>';
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
                $dataList .= '<option value="'.$d['service_name'].'">'.beautify_label( $d['service_name'] ).'</option>';
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
                $dataList .= '<option value="'.$d['name'].'">'.beautify_label( $d['name'] ).'</option>';
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
                $dataList .= '<option value="'.$d['name'].'">'.beautify_label( $d['name'] ).'</option>';
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

        if($budget_head_c){
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
                    <input class="min lowerVal" name="filter-budget_head_c_min" id="lowerVal" type="range" min="0" max="200" value="0" step="10"/>
                    <input class="max upperVal" name="filter-budget_head_c_max" id="upperVal" type="range" min="0" max="200" value="200" step="10"/>
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
                $dataList .= '<option value="'.$d['submissionstatus_c'].'">'.beautify_label( $d['submissionstatus_c'] ).'</option>';
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

        $scope_budget_projected_c_from  = date_format_helper(@$_GET['filter-scope_budget_projected_c_from']);
        $scope_budget_projected_c_to    = date_format_helper(@$_GET['filter-scope_budget_projected_c_to']);

        $rfp_eoi_projected_c_from       = date_format_helper(@$_GET['filter-rfp_eoi_projected_c_from']);
        $rfp_eoi_projected_c_to         = date_format_helper(@$_GET['filter-rfp_eoi_projected_c_to']);

        $rfp_eoi_published_projected_c_from = date_format_helper(@$_GET['filter-rfp_eoi_published_projected_c_from']);
        $rfp_eoi_published_projected_c_to   = date_format_helper(@$_GET['filter-rfp_eoi_published_projected_c_to']);

        $work_order_projected_c_from    = date_format_helper(@$_GET['filter-work_order_projected_c_from']);
        $work_order_projected_c_to      = date_format_helper(@$_GET['filter-work_order_projected_c_to']);

        $budget_head_c_min              = @$_GET['filter-budget_head_c_min'];
        $budget_head_c_max              = @$_GET['filter-budget_head_c_max'];

        $budget_allocated_oppertunity_c_min = @$_GET['filter-budget_allocated_oppertunity_c_min'];
        $budget_allocated_oppertunity_c_max = @$_GET['filter-budget_allocated_oppertunity_c_max'];

        $project_implementation_start_c_from = date_format_helper(@$_GET['filter-project_implementation_start_c_from']);
        $project_implementation_start_c_to   = date_format_helper(@$_GET['filter-project_implementation_start_c_to']);

        $project_implementation_end_c_from  = date_format_helper(@$_GET['filter-project_implementation_end_c_from']);
        $project_implementation_end_c_to    = date_format_helper(@$_GET['filter-project_implementation_end_c_to']);

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
                if($key)
                    $fetch_query .= " OR ";
                if (strpos($res, 'andTeam') !== false) {
                    $arr = explode('andTeam',$res,0);
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
            $closedDateFrom = date_format_helper($_GET['filter-closed-date-from']);
            $closedDateTo   = date_format_helper($_GET['filter-closed-date-to']);
            $fetch_query    .= " AND DATE(opportunities.date_modified) BETWEEN '$closedDateFrom' AND '$closedDateTo' ";
        }
        if(isset( $_GET['filter'] ) && @$_GET['filter-created-date-from'] && @$_GET['filter-created-date-to']){
            $createdDateFrom    = date_format_helper($_GET['filter-created-date-from']);
            $createdDateTo      = date_format_helper($_GET['filter-created-date-to']);
            $fetch_query        .= " AND DATE(opportunities.date_entered) BETWEEN '$createdDateFrom' AND '$createdDateTo' ";
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
                    $fetch_query .= " `opportunities_cstm`.non_financial_consideration_c LIKE '%$res%' OR `opportunities_cstm`.non_financial_consideration_c IS NULL";
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
            $fetch_query .= " AND DATE(opportunities_cstm.scope_budget_projected_c) BETWEEN '$scope_budget_projected_c_from' AND '$scope_budget_projected_c_to' ";
        }

        if($rfp_eoi_projected_c_from && $rfp_eoi_projected_c_to){
            $fetch_query .= " AND DATE(opportunities_cstm.rfp_eoi_projected_c) BETWEEN '$rfp_eoi_projected_c_from' AND '$rfp_eoi_projected_c_to' ";
        }
        if($rfp_eoi_published_projected_c_from && $rfp_eoi_published_projected_c_to){
            $fetch_query .= " AND DATE(opportunities_cstm.rfp_eoi_published_projected_c) BETWEEN '$rfp_eoi_published_projected_c_from' AND '$rfp_eoi_published_projected_c_to' ";
        }

        if($work_order_projected_c_from && $work_order_projected_c_to){
            $fetch_query .= " AND DATE(opportunities_cstm.work_order_projected_c) BETWEEN '$work_order_projected_c_from' AND '$work_order_projected_c_to' ";
        }

        if($budget_head_c_min && $budget_head_c_max){
            $fetch_query .= " AND opportunities_cstm.budget_head_amount_c BETWEEN '$budget_head_c_min' AND '$budget_head_c_max' ";
        }

        if($budget_allocated_oppertunity_c_min && $budget_allocated_oppertunity_c_max){
            $fetch_query .= " AND opportunities_cstm.budget_allocated_oppertunity_c BETWEEN '$budget_allocated_oppertunity_c_min' AND '$budget_allocated_oppertunity_c_max' ";
        }

        if($project_implementation_start_c_from && $project_implementation_start_c_to){
            $fetch_query .= " AND DATE(opportunities_cstm.project_implementation_start_c) BETWEEN '$project_implementation_start_c_from' AND '$project_implementation_start_c_to' ";
        }

        if($project_implementation_end_c_from && $project_implementation_end_c_to){
            $fetch_query .= " AND DATE(opportunities_cstm.project_implementation_end_c) BETWEEN '$project_implementation_end_c_from' AND '$project_implementation_end_c_to' ";
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

    public function append_currency($oppCurrency, $amount) {
        if ($amount != '') {
            $symbol = ($oppCurrency == 'USD') ? '$' : '₹';
            $unit = ($oppCurrency == 'USD') ? ' Mn' : ' Cr';
            $amount = $symbol . $amount . $unit;
        }
        return $amount;
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

    public function action_delegated_dialog_info(){
        try {
            $db = \DBManagerFactory::getInstance();
            global $current_user;
            $log_in_user_id = $current_user->id;
            $GLOBALS['db'];

            $delegated_user_id = $this->get_delegated_user($log_in_user_id);
            if ($delegated_user_id) {
                $delegated_user = $this->get_user_details_by_id($delegated_user_id);
            }
            
            if (!empty(@$delegated_user) && (@$delegated_user['first_name'] || @$delegated_user['last_name'])) {
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
            $description = "You have been delegated to approve & reject opportunities by ".'"'.getUserName($log_in_user_id).'".';
            $description_email = "You have been delegated to approve & reject opportunities by ".'"'.getUserName($log_in_user_id).'".'."<br><br>Click here to view: www.ampersandcrm.com";
            send_notification('Opportunity','Delegate',$description,[$proxy],'');
    
            $reciever_email = getUserEmail($proxy);
            send_email($description_email,[$reciever_email],'CRM ALERT - Delegation');
            echo json_encode(array("status"=>true, "message"=>"Data Succesfully updated", "proxy"=> $proxy,"proxy_name"=>getUserName($proxy)));
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();

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

    public function beautify_amount($amount) {
        return preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $amount);
    }
    function get_all_users_option(){
        global $current_user;
        $log_in_user_id = $current_user->id;
        $fetch_query = "SELECT users.id, users.first_name, users.last_name, users_cstm.teamheirarchy_c
        FROM users LEFT JOIN users_cstm ON users.id = users_cstm.id_c
        WHERE users.`deleted` != '1' AND users.`id` != '1' ORDER BY users.`first_name` ASC";
        $result = $GLOBALS['db']->query($fetch_query);
        $data = '';
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $full_name = $row['first_name'] . ' ' . $row['last_name'];
                $data .= '<option value="'.$row['id'].'">'.$full_name.'</option>';
            }
        }
        return $data;
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

    //---------------------------------------- For Critical Status ---------------//

    public function action_update_critical_status(){
        try{
            $db = \DBManagerFactory::getInstance();
            global $current_user;
            $log_in_user_id = $current_user->id;
            $id = $_GET['id'];
            $GLOBALS['db'];

            $get_data_query="SELECT critical_c FROM opportunities_cstm WHERE id_c = '$id'";
            $result = $GLOBALS['db']->query($get_data_query);
            $fetch = $GLOBALS['db']->fetchByAssoc($result);
            $fetch['critical_c'] ='yes';


            $array_log_in_user = array();
            array_push($array_log_in_user,$fetch['critical_c'],$log_in_user_id);
            $string_log_in_user = rtrim(implode(',', $array_log_in_user));

            $update_query = "UPDATE opportunities_cstm SET critical_c = '$string_log_in_user' WHERE id_c = '$id'";
            $GLOBALS['db']->query($update_query);

            $color="red";

            $critical_status_count_query = "SELECT count(*) as totalCount FROM opportunities_cstm WHERE critical_c LIKE '%$log_in_user_id%' AND critical_c LIKE '%yes%'";
            $critical_status_count = executeCountQuery($critical_status_count_query);
            // ob_start();
            // include_once 'templates/partials/opportunities/repeater.php';
            // $content .= ob_get_contents();
            // ob_end_clean();


            echo json_encode(array('status'=>true, 
                                    'message' => 'Success',
                                    'color'=>$color,
                                    'critical_status_count'=>$critical_status_count,
                                    'loged_in_user' => $string_log_in_user,

                                ));

            die;
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
            die;
        }
    }

    public function action_update_critical_status_changed(){
        try{
            $db = \DBManagerFactory::getInstance();
            global $current_user;
            $log_in_user_id = $current_user->id;
            $id = $_GET['id'];
            $GLOBALS['db'];
            
            $array_critical_data = array();
            $get_data_query="SELECT critical_c FROM opportunities_cstm WHERE id_c = '$id'";
            // $result = $GLOBALS['db']->query($get_data_query);
            // $fetch = $GLOBALS['db']->fetchByAssoc($result);

            // $array_critical_data = explode(',',trim($fetch['critical_c']));
            // while($row = $GLOBALS['db']->fetchByAssoc($result)){
            //     $critical_data_test = $row['critical'];
            //     $array_critical_data = explode(',',trim($critical_data_test));

            // }
            $array_critical_data[0]= 'no';

            $string_critical_data = implode(',',$array_critical_data);

            
            $update_query = "UPDATE opportunities_cstm SET critical_c = '$string_critical_data' WHERE id_c = '$id'";
            $GLOBALS['db']->query($update_query);
            
            $critical_status_count_query = "SELECT count(*) as totalCount FROM opportunities_cstm WHERE critical_c LIKE '%$log_in_user_id%' AND critical_c LIKE '%yes%'";
            $critical_status_count = executeCountQuery($critical_status_count_query);


            // ob_start();
            // include_once 'templates/partials/opportunities/repeater.php';
            // $content .= ob_get_contents();
            // ob_end_clean();


            echo json_encode(array('status'=>true, 'message' => 'Success','data'=>$string_critical_data,'critical_status_count'=>$critical_status_count));

            die;
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
            die;
        }
    }

    function is_critical_applicable($log_in_user_id, $opp_id, $isCritical){
        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        $is_mc = $this->is_mc($log_in_user_id);
        $query = "SELECT critical_c FROM opportunities_cstm WHERE id_c = '$opp_id'";
        $result = $GLOBALS['db']->query($query);
        $fetch = $GLOBALS['db']->fetchByAssoc($result);

        $array_critical_data = explode(',',trim($fetch['critical_c']));
        if (strpos($fetch['critical_c'], $log_in_user_id) !== false) {
            $array_critical_data[0] = 'yes';
        } else {
            $array_critical_data[0] = 'no';
        }

        return $is_mc && (($array_critical_data[0] == $isCritical));

    }


        //--------------------------------------for download----------------------//

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
            $opp_id_show = private_opps();
            if($type == 'non_global') {
                $query .= " opportunities.id  IN ('".implode("','",$opp_id_show)."'))";
            }
            else {
                $query .= " AND opportunities.opportunity_type='$type' ";
            }
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
                beautify_label( $row['new_department_c'] ),
                beautify_label( beautify_label($row['rfporeoipublished_c']) ),
                $row['date_modified'] ? date_format(date_create($row['date_modified']),'dS F Y') : '',
                $closed_by,
                $row['date_entered'] ? date_format(date_create($row['date_entered']), 'dS F Y') : '',
                //$row['date_closed'] ? date_format(date_create($row['date_closed']),'d/m/Y') : '',
                $this->getMultipleApproverNames( $row['multiple_approver_c'] ),
                beautify_label( $row['state_c'] ),
                // beautify_label( $row['new_department_c'] ),
                beautify_label( $row['source_c'] ),
                beautify_test(beautify_label( $row['non_financial_consideration_c'] )),
                beautify_label( $row['segment_c'] ),
                beautify_label( $row['product_service_c'] ),
                beautify_label( $row['international_c'] ),
                beautify_label( $row['total_input_value'] ),
                beautify_label( $row['sector_c'] ),
                beautify_label( $row['sub_sector_c'] ),
                $row['scope_budget_projected_c'] ? beautify_label( date( 'dS F Y', strtotime($row['scope_budget_projected_c']) ) ) : '',
                $row['rfp_eoi_projected_c'] ? beautify_label( date('dS F Y', strtotime($row['rfp_eoi_projected_c']) ) ) : '',
                $row['rfp_eoi_published_projected_c'] ? beautify_label( date('dS F Y', strtotime($row['rfp_eoi_published_projected_c']) ) ) : '',
                $row['work_order_projected_c'] ? beautify_label( date('dS F Y', strtotime($row['work_order_projected_c']) ) ) : '',
                $this->append_currency($row['currency_c'], $this->beautify_amount( $row['budget_head_amount_c'] )),
                beautify_label( $row['budget_allocated_oppertunity_c'] ),
                $row['project_implementation_start_c'] ? beautify_label( date('dS F Y', strtotime($row['project_implementation_start_c']) ) ) : '',
                $row['project_implementation_end_c'] ? beautify_label( date('dS F Y', strtotime($row['project_implementation_end_c']) ) ) : '',
                $row['selection_c'].' '.$row['funding_c'].' '.$row['timing_button_c'],
                beautify_label( $row['submissionstatus_c'] ),
                beautify_label( $row['closure_status_c'] )
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
        
public function is_reassignment_applicable($opportunity_id) {
    global $current_user;
     $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
    $log_in_user_id = $current_user->id;
    
    $sql ='SELECT * FROM `approval_table` WHERE `opp_id`="'.$opportunity_id.'" AND `pending`="1"';
    $result = $GLOBALS['db']->query($sql);
    $pending_count=$result->num_rows;
    
    $sql_lineage ='SELECT opportunities.assigned_user_id,users_cstm.user_lineage FROM opportunities LEFT JOIN users_cstm ON users_cstm.id_c=opportunities.assigned_user_id WHERE opportunities.id="'.$opportunity_id.'"';
    $result_lineage = $GLOBALS['db']->query($sql_lineage);
     while($row = $GLOBALS['db']->fetchByAssoc($result_lineage)) 
    {
           $lineage=$row['user_lineage']; 
           $assigned_id=$row['assigned_user_id'];
    }
    $lineage_arry= explode(",", $lineage);
    
    $sql1 ='SELECT users.reports_to_id, users_cstm.mc_c FROM users INNER JOIN users_cstm ON users_cstm.id_c= "'.$log_in_user_id.'" WHERE reports_to_id = "'.$log_in_user_id.'"';
    $result1 = $GLOBALS['db']->query($sql1);
    $reporting_count=$result1->num_rows;
     while($row = $GLOBALS['db']->fetchByAssoc($result1)) {
        $mc_check=$row['mc_c'];
     }
     $sql_reports_id = "SELECT * FROM users WHERE reports_to_id='".$log_in_user_id."'";
     $result_reports_id= $GLOBALS['db']->query($sql_reports_id);
    $reports_count=$result_reports_id->num_rows;

    if(!empty($mc_check)  && $mc_check=="yes"){
     return (($pending_count <= 0));
    } 
    else{
        
        if(in_array($log_in_user_id,$lineage_arry)){
            return (($pending_count <= 0));
        }
        elseif($log_in_user_id==$assigned_id && $reports_count > 0){
            return (($pending_count <= 0));
        }
        
        //  return (($pending_count <= 0) && ($reporting_count > 0) && ($reporting_count1 > 0) );
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
            
            
            
                  $sql_tl="SELECT case when teamheirarchy_c='team_member_l1' then 'l1' when teamheirarchy_c ='team_member_l2' then 'l2' when teamheirarchy_c ='team_member_l3' then 'l3' when teamheirarchy_c='team_lead' then 'tl' end AS 'heirarchy' FROM users_cstm WHERE id_c='".$assigned_id."'";
            
            $result_tl = $GLOBALS['db']->query($sql_tl);
            
        while ($row_tl = mysqli_fetch_assoc($result_tl)){
                
            $team_h=$row_tl['heirarchy'];
            }
        
            if($team_h=="tl"){
                
                $sql_tlr='SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="'.$assigned_id.'")';
                $result_tlr = $GLOBALS['db']->query($sql_tlr);
                while ($row_tlr = mysqli_fetch_assoc($result_tlr)){
                
            $team_lead_name=$row_tlr['name'];
            $team_lead_id=$row_tlr['id'];
            }
            
            
                
            }
        
        else if($team_h=="l1"){
                
                $sql_tlr='SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="'.$assigned_id.'")';
                $result_tlr = $GLOBALS['db']->query($sql_tlr);
                while ($row_tlr = mysqli_fetch_assoc($result_tlr)){
                
            $team_lead_name=$row_tlr['name'];
            $team_lead_id=$row_tlr['id'];
            }
                
            }
            else if($team_h=="l2"){
                
                $sql_tlr='SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="'.$assigned_id.'"))';
                $result_tlr = $GLOBALS['db']->query($sql_tlr);
                while ($row_tlr = mysqli_fetch_assoc($result_tlr)){
                
            $team_lead_name=$row_tlr['name'];
            $team_lead_id=$row_tlr['id'];
            }
                
            }
            else if($team_h=="l3"){
                
                $sql_tlr='SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="'.$assigned_id.'")))';
                $result_tlr = $GLOBALS['db']->query($sql_tlr);
                while ($row_tlr = mysqli_fetch_assoc($result_tlr)){
                
            $team_lead_name=$row_tlr['name'];
            $team_lead_id=$row_tlr['id'];
            }
                
                
                
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
               
              
               
                if($log_in_user_id==$assigned_id||$log_in_user_id==$reports_to||$opportunity_id=='' || $log_in_user_id==$team_lead_id){
                    
              
                    
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

                   $opp_ex_assign_query = "SELECT * FROM `opportunities` where id ='".$opportunity_id."'";
                   $result_opp_ex_assign = $GLOBALS['db']->query($opp_ex_assign_query);
                   $row_opp_ex_assign = $GLOBALS['db']->fetchByAssoc($result_opp_ex_assign);

                   $ex_assigne_id = $row_opp_ex_assign['assigned_user_id'];

                    $sql="SELECT id,reports_to_id  FROM users WHERE CONCAT(first_name, ' ', last_name) ='".$assigned_name."' ";
                   
                    $result = $GLOBALS['db']->query($sql);
                    
           while($row = $GLOBALS['db']->fetchByAssoc($result)) 
           {
               
               
             $assigned_id=$row['id'];
              
             $reports_to_id = $row['reports_to_id'];
       
               
           }
           $testing_id = $assigned_id;
           
               $sql_tl="SELECT case when teamheirarchy_c='team_member_l1' then 'l1' when teamheirarchy_c ='team_member_l2' then 'l2' when teamheirarchy_c ='team_member_l3' then 'l3' when teamheirarchy_c='team_lead' then 'tl' end AS 'heirarchy' FROM users_cstm WHERE id_c='".$assigned_id."'";
           
           $result_tl = $GLOBALS['db']->query($sql_tl);
           
        while ($row_tl = mysqli_fetch_assoc($result_tl)){
               
              $team_h=$row_tl['heirarchy'];
           }
          
            if($team_h=="tl"){
                
               $sql_tlr='SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="'.$assigned_id.'")';
               $result_tlr = $GLOBALS['db']->query($sql_tlr);
               while ($row_tlr = mysqli_fetch_assoc($result_tlr)){
               
              $team_lead_name=$row_tlr['name'];
              $team_lead_id=$row_tlr['id'];
           }
           
           
               
           }
          
          else if($team_h=="l1"){
               
               $sql_tlr='SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="'.$assigned_id.'")';
               $result_tlr = $GLOBALS['db']->query($sql_tlr);
               while ($row_tlr = mysqli_fetch_assoc($result_tlr)){
               
              $team_lead_name=$row_tlr['name'];
              $team_lead_id=$row_tlr['id'];
           }
               
           }
           else if($team_h=="l2"){
               
                 $sql_tlr='SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="'.$assigned_id.'"))';
               $result_tlr = $GLOBALS['db']->query($sql_tlr);
               while ($row_tlr = mysqli_fetch_assoc($result_tlr)){
               
              $team_lead_name=$row_tlr['name'];
              $team_lead_id=$row_tlr['id'];
           }
               
           }
           else if($team_h=="l3"){
               
                $sql_tlr='SELECT CONCAT(first_name," ",last_name) as name,id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id=(SELECT reports_to_id FROM users WHERE id="'.$assigned_id.'")))';
               $result_tlr = $GLOBALS['db']->query($sql_tlr);
               while ($row_tlr = mysqli_fetch_assoc($result_tlr)){
               
              $team_lead_name=$row_tlr['name'];
              $team_lead_id=$row_tlr['id'];
           }
               
               
               
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
                         $status_new=$row1['status_c'];
                         $rfp_new=$row1['rfporeoipublished_c'];
           }
                   $sql23='UPDATE `opportunities_cstm` SET `assigned_to_new_c`="'.$assigned_name.'" WHERE id_c="'.$opportunity_id.'"';
                    
                    $result23 = $GLOBALS['db']->query($sql23);
                      
                    $sql2='UPDATE `opportunities` SET `assigned_user_id`="'.$assigned_id.'" WHERE id="'.$opportunity_id.'"';
                    
                    $result2 = $GLOBALS['db']->query($sql2);
                    
                    if($rfp_new=='no'){
                        if($status_new=='Qualified' || $status_new=='QualifiedDpr' || $status_new=='QualifiedBid' || $status_new=='Closed'){
                           $reports_to_id=$team_lead_id;
                            
                        }
                        
                    }
                   else if($rfp_new=='yes'){
                       if($status_new=='QualifiedLead' || $status_new=='QualifiedBid' || $status_new=='Closed'){
                            $reports_to_id=$team_lead_id;
                        }
                        
                    }
                   else if($rfp_new=='not_required'){
                        
                   
                       if($status_new=='Qualified' || $status_new=='QualifiedDpr' || $status_new=='QualifiedBid' || $status_new=='Closed'){
                           
                           
                             $reports_to_id=$team_lead_id;
                             
                             
                        }
                        
                    }
                  
                    
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

                            //Notification
                            $opp_name_query = "SELECT * FROM `opportunities` where id ='".$opportunity_id."'";
                            $result_opp_name = $GLOBALS['db']->query($opp_name_query);
                            $row_opp_name = $GLOBALS['db']->fetchByAssoc($result_opp_name);
                            
                            $link = 'index.php?action=DetailView&module=Opportunities&record='.$row_opp_name['id'];
                            $description ="Oppurtunity ".'"'.$row_opp_name['name'].'"'." was re-assigned to ".getUserName($assigned_id)." by ".'"'.getUserName($log_in_user_id).'".';
                            $description_notification = "You have been assigned to opportunity ".'"'.$row_opp_name['name'].'"'." by ".'"'.getUserName($log_in_user_id).'"'.". Now you can edit /make changes.";  
                            $description_for_ex_assigned_user = getUserName($assigned_id)." has been assigned to opportunity ".'"'.$row_opp_name['name'].'"'." by ".'"'.getUserName($log_in_user_id).'".';
                            $description_for_assigned_user_email = "You have been assigned to opportunity ".'"'.$row_opp_name['name'].'"'." by ".'"'.getUserName($log_in_user_id).'"'.". Now you can edit /make changes.<br><br> Click here to view: www.ampersandcrm.com";
                            send_email($description_for_ex_assigned_user,[getUserEmail($ex_assigne_id)],"CRM ALERT - Reassignment");
 
                             send_notification('Opportunity','Re-assign User',$description_notification,[$assigned_id],$link);
                             send_email($description_for_assigned_user_email,[getUserEmail($assigned_id)],"CRM ALERT - Reassignment"); 
                             echo json_encode(array("status"=>true, "message" => "Success","description"=>$description,"opp"=>$opportunity_id,"testing_id" =>$testing_id));
                              
                          }
                                 
                            }
                            else{
                                 $sql31='UPDATE `opportunities_cstm` SET `user_id2_c`="'.$reports_to_id.'" WHERE id_c="'.$opportunity_id.'"';
                          $result31 = $GLOBALS['db']->query($sql31);
                                 $sql3='UPDATE `opportunities_cstm` SET `multiple_approver_c`="'.$reports_to_id.'" WHERE id_c="'.$opportunity_id.'"';
                          $result3 = $GLOBALS['db']->query($sql3);
                          
                          if($db->query($sql3)==TRUE){

                            $opp_name_query = "SELECT * FROM `opportunities` where id ='".$opportunity_id."'";
                            $result_opp_name = $GLOBALS['db']->query($opp_name_query);
                            $row_opp_name = $GLOBALS['db']->fetchByAssoc($result_opp_name);
                            
                            $link = 'index.php?action=DetailView&module=Opportunities&record='.$row_opp_name['id'];
                            $description ="Oppurtunity ".'"'.$row_opp_name['name'].'"'." was re-assigned to ".getUserName($assigned_id)." by ".'"'.getUserName($log_in_user_id).'".';
                            $description_notification = "You have been assigned to opportunity ".'"'.$row_opp_name['name'].'"'." by ".'"'.getUserName($log_in_user_id).'"'.". Now you can edit /make changes.";  
                            $description_for_ex_assigned_user = getUserName($assigned_id)." has been assigned to opportunity ".'"'.$row_opp_name['name'].'"'." by ".'"'.getUserName($log_in_user_id).'".';
                            $description_for_assigned_user_email = "You have been assigned to opportunity ".'"'.$row_opp_name['name'].'"'." by ".'"'.getUserName($log_in_user_id).'"'.". Now you can edit /make changes.<br><br> Click here to view: www.ampersandcrm.com";
                            send_email($description_for_ex_assigned_user,[getUserEmail($ex_assigne_id)],"CRM ALERT - Reassignment");
 
                             send_notification('Opportunity','Re-assign User',$description_notification,[$assigned_id],$link);
                             send_email($description_for_assigned_user_email,[getUserEmail($assigned_id)],"CRM ALERT - Reassignment");
                             echo json_encode(array("status"=>true, "message" => "Success","description"=>$description,"opp"=>$opportunity_id,"testing_id" =>$testing_id));
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

//-----------------------Activity assigned history-----------------------------//


           //--------------------------------------for user-report-table----------------------//
           public function action_get_report_table_data() {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            $team_lead_filter = null;
            if (isset($_GET['team_lead'])) {
                $team_lead_filter = @$_GET['team_lead'];
            }
            $day = isset( $_GET['day'] ) ? $_GET['day'] : $_COOKIE['day'];
            $query = "SELECT users.id,users.first_name,users.last_name
                        FROM users
                        JOIN users_cstm uc ON users.id = uc.id_c
                        WHERE users.deleted != 1 AND users.id != '1' AND users.id != '' ";
            if($team_lead_filter) {
                $query .= " AND (uc.user_lineage LIKE '%$team_lead_filter%' OR uc.id_c = '$team_lead_filter')";
            }
            $result = $GLOBALS['db']->query($query);
            if ($result->num_rows == 0) {
                $data[] = array(); 
            }
            $team_sum_count = 0;
            $team_sum_value = 0;
            $team_participation = 0;
            $team_sum_value_usd = 0;
            while($row = $GLOBALS['db']->fetchByAssoc($result)){
                $Lead = $QualifiedLead = $Qualified = $QualifiedDpr = $QualifiedBid = $Closed = $Dropped = 0;
                $total_value=array("Lead"=>0,"QualifiedLead"=>0,"Qualified"=>0,"QualifiedDpr"=>0,"QualifiedBid"=>0,"Closed"=>0,"Dropped"=>0);
                $total_value_usd=array("Lead"=>0,"QualifiedLead"=>0,"Qualified"=>0,"QualifiedDpr"=>0,"QualifiedBid"=>0,"Closed"=>0,"Dropped"=>0);

                $user_id = $row['id'];
                $user_full_name = $row['first_name'] . ' ' . $row['last_name'];
                $closed_arr = $this->user_report_closed_count($user_id, $day);
                $expected_inflow_date = $this->get_nearest_inflow_date($user_id, $day);

                $sub_query = "SELECT opportunities_cstm.status_c, count(*) as op_count,
                                SUM(CAST(REPLACE(year_quarters.total_input_value, ',', '')as SIGNED)) as total_input_value
                                FROM `opportunities` 
                                LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c 
                                LEFT JOIN year_quarters ON year_quarters.opp_id = opportunities.id 
                                WHERE opportunities.assigned_user_id = '$user_id' AND opportunities.deleted != 1 
                                AND opportunities.date_entered >= now() - interval '$day' day ";
                $sub_query_group_by = " GROUP BY opportunities_cstm.status_c";
                $sub_query1 = $sub_query . " AND (opportunities_cstm.currency_c = 'INR' OR opportunities_cstm.currency_c = '' OR opportunities_cstm.currency_c is NULL)" . $sub_query_group_by;
                $sub_query2 = $sub_query . " AND (opportunities_cstm.currency_c = 'USD')" . $sub_query_group_by;
                $sub_query3 = $sub_query.$sub_query_group_by;

                $fetch_result = $GLOBALS['db']->query($sub_query3);
                while($sub_row = $GLOBALS['db']->fetchByAssoc($fetch_result)){
                    $status = $sub_row['status_c'];
                    $$status = $sub_row['op_count'];
                }
                
                
                $fetch_result1 = $GLOBALS['db']->query($sub_query1);
                while($sub_row = $GLOBALS['db']->fetchByAssoc($fetch_result1)){
                    if ($sub_row['total_input_value'])
                    $total_value[$sub_row['status_c']] = $sub_row['total_input_value'];
                }

                $fetch_result2 = $GLOBALS['db']->query($sub_query2);
                while($sub_row = $GLOBALS['db']->fetchByAssoc($fetch_result2)){
                    if ($sub_row['total_input_value'])
                    $total_value_usd[$sub_row['status_c']] = $sub_row['total_input_value'];
                }

                
                $total_count = $Lead + $QualifiedLead + $Qualified + $QualifiedDpr + $QualifiedBid + $Closed + $Dropped;
                $total_value_individual = $total_value['Lead'] + $total_value['QualifiedLead'] + $total_value['Qualified'] + $total_value['QualifiedDpr'] +
                $total_value['QualifiedBid'] + $total_value['Closed'] + $total_value['Dropped'];
                $total_value_individual_usd = $total_value_usd['Lead'] + $total_value_usd['QualifiedLead'] + $total_value_usd['Qualified'] + $total_value_usd['QualifiedDpr'] +
                $total_value_usd['QualifiedBid'] + $total_value_usd['Closed'] + $total_value_usd['Dropped'];
                $team_sum_count += $total_count;
                $team_sum_value += $total_value_individual;
                $team_sum_value_usd += $total_value_individual_usd;
                $participated_count = $this->get_participated_count($user_id, $total_count);
                $team_participation += $participated_count;

                $data[] = array(
                    $user_full_name,
                    $total_count,
                    $this->append_currency('INR', $this->beautify_amount($total_value_individual))
                    . ' - ' .$this->append_currency('USD', $this->beautify_amount($total_value_individual_usd)),
                    $Lead,
                    $this->append_currency('INR', $this->beautify_amount($total_value['Lead']))
                    . ' - ' .$this->append_currency('USD', $this->beautify_amount($total_value_usd['Lead'])),
                    $QualifiedLead,
                    $this->append_currency('INR', $this->beautify_amount($total_value['QualifiedLead']))
                    . ' - ' .$this->append_currency('USD', $this->beautify_amount($total_value_usd['QualifiedLead'])),
                    $Qualified,
                    $this->append_currency('INR', $this->beautify_amount($total_value['Qualified']))
                    . ' - ' .$this->append_currency('USD', $this->beautify_amount($total_value_usd['Qualified'])),
                    $QualifiedDpr,
                    $this->append_currency('INR', $this->beautify_amount($total_value['QualifiedDpr']))
                    . ' - ' .$this->append_currency('USD', $this->beautify_amount($total_value_usd['QualifiedDpr'])),
                    $QualifiedBid,
                    $this->append_currency('INR', $this->beautify_amount($total_value['QualifiedBid']))
                    . ' - ' .$this->append_currency('USD', $this->beautify_amount($total_value_usd['QualifiedBid'])),
                    $closed_arr['won'],
                    $this->append_currency('INR', $this->beautify_amount($closed_arr['won_value']))
                    . ' - ' .$this->append_currency('USD', $this->beautify_amount($closed_arr['won_value_usd'])),
                    $closed_arr['lost'],
                    $this->append_currency('INR', $this->beautify_amount($closed_arr['lost_value']))
                    . ' - ' .$this->append_currency('USD', $this->beautify_amount($closed_arr['lost_value_usd'])),
                    $Dropped,
                    $this->append_currency('INR', $this->beautify_amount($total_value['Dropped']))
                    . ' - ' .$this->append_currency('USD', $this->beautify_amount($total_value_usd['Dropped'])),
                    $participated_count,
                    $expected_inflow_date
                );
            }
            if (count($data) > 0) {
                $data[] = array(
                    'TOTAL',
                    $team_sum_count,
                    $this->append_currency('INR', $this->beautify_amount($team_sum_value))
                    . ' - ' .$this->append_currency('USD', $this->beautify_amount($team_sum_value_usd)));
            }
            
            $response = json_encode(
                array(
                    'data' => $data,
                    'status' => 'success',
                    'query' => $query
                )
            );
    
            echo $response; die;
        }

    function user_report_closed_count($user_id, $day) {
        $closed_query = "SELECT count(*) as op_count,
                        SUM(CAST(REPLACE(year_quarters.total_input_value, ',', '')as SIGNED)) as total_input_value
                        FROM `opportunities` 
                        LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c 
                        LEFT JOIN year_quarters ON year_quarters.opp_id = opportunities.id 
                        WHERE opportunities.assigned_user_id = '$user_id' AND opportunities.deleted != 1
                        AND opportunities.date_entered >= now() - interval '$day' day
                        AND opportunities_cstm.status_c = 'Closed' ";
        $closed_win_query = $closed_query . " AND opportunities_cstm.closure_status_c = 'won'";
        $closed_lost_query = $closed_query . " AND opportunities_cstm.closure_status_c = 'lost'";

        $fetch_won_result = $GLOBALS['db']->query($closed_win_query);
        $fetch_won = $GLOBALS['db']->fetchByAssoc($fetch_won_result);
        $fetch_lost_result = $GLOBALS['db']->query($closed_lost_query);
        $fetch_lost = $GLOBALS['db']->fetchByAssoc($fetch_lost_result);

        $closed_win_query_usd = $closed_win_query . " AND (opportunities_cstm.currency_c = 'INR' OR opportunities_cstm.currency_c = '' OR opportunities_cstm.currency_c is NULL)";
        $closed_lost_query_usd = $closed_lost_query . " AND (opportunities_cstm.currency_c = 'USD')";

        $fetch_won_result_usd = $GLOBALS['db']->query($closed_win_query_usd);
        $fetch_won_usd = $GLOBALS['db']->fetchByAssoc($fetch_won_result_usd);
        $fetch_lost_result_usd = $GLOBALS['db']->query($closed_lost_query_usd);
        $fetch_lost_usd = $GLOBALS['db']->fetchByAssoc($fetch_lost_result_usd);

        return array(
            'won' => $fetch_won['op_count'],
            'won_value' => ($fetch_won['total_input_value']) ? ($fetch_won['total_input_value']) : 0,
            'lost' => $fetch_lost['op_count'],
            'lost_value' => ($fetch_lost['total_input_value']) ? ($fetch_lost['total_input_value']) : 0,
            'won_value_usd' => ($fetch_won_usd['total_input_value']) ? ($fetch_won_usd['total_input_value']) : 0,
            'lost_value_usd' => ($fetch_lost_usd['total_input_value']) ? ($fetch_lost_usd['total_input_value']) : 0,

        );
    }

    function get_participated_count($user_id, $assigned_count = 0) {
        $approval_count = $modification_count = 0;
        //Approval contribution (Lineage or delegated)
        $approval_count_query = "SELECT count(DISTINCT opp_id) as approval_count FROM `approval_table` WHERE approver_rejector = '$user_id' or delegate_id = '$user_id'";
        $fetch_result = $GLOBALS['db']->query($approval_count_query);
        $result = $GLOBALS['db']->fetchByAssoc($fetch_result);
        if ($result && $result['approval_count'] > 0)
            $approval_count = $result['approval_count'];
            
        // Modification Contribution (reassigned, tagged)
        $modification_count_query = "SELECT count(DISTINCT opportunities.id) as modification_count FROM opportunities 
                                    JOIN opportunities_audit ON opportunities.id = opportunities_audit.parent_id
                                    JOIN l1_audit ON opportunities.id = l1_audit.opp_id
                                    JOIN l2_audit ON opportunities.id = l2_audit.opp_id
                                    WHERE (opportunities_audit.created_by = '$user_id'
                                    AND opportunities.assigned_user_id != '$user_id')
                                    OR (l1_audit.created_by = '$user_id')
                                    OR (l2_audit.created_by = '$user_id')";
        $fetch_result = $GLOBALS['db']->query($modification_count_query);
        $result = $GLOBALS['db']->fetchByAssoc($fetch_result);
        if ($result && $result['modification_count'] > 0)
            $modification_count = $result['modification_count'];
        
        return $assigned_count + $approval_count + $modification_count;
    }

    function get_nearest_inflow_date($user_id, $day) {
        $final = '';
        $query = "SELECT oc.expected_inflow_c as expected_inflow_c from opportunities_cstm as oc
                JOIN opportunities ON opportunities.id = oc.id_c 
                WHERE oc.status_c = 'Closed' AND oc.expected_inflow_c IS NOT NULL
                AND opportunities.assigned_user_id = '$user_id'
                AND opportunities.deleted != 1 AND opportunities.date_entered >= now() - interval '$day' day
                AND oc.expected_inflow_c >= now()
                ORDER BY oc.expected_inflow_c ASC LIMIT 1";
        $fetch_result = $GLOBALS['db']->query($query);
        $result = $GLOBALS['db']->fetchByAssoc($fetch_result);
        if ($result && $result['expected_inflow_c'] > 0) {
            $final = date_format(date_create($result['expected_inflow_c']),'d/m/Y');;
        }
        return  $final;
    }
    function currencyConverter($currency_from, $currency_to, $currency_input) {
        $req_url = 'https://api.exchangerate-api.com/v4/latest/USD';
        $response_json = file_get_contents($req_url);
        if(false !== $response_json) {
            try {    
            $response_object = json_decode($response_json);
            $INR_price = round(($currency_input * $response_object->rates->INR), 2);
            }
            catch(Exception $e) {
            }
        }
    
        return $INR_price;
    }
    
    function action_get_team_filter_report_table(){
        $query = "SELECT users.id, users.first_name, users.last_name FROM users 
                    JOIN users_cstm ON users.id = users_cstm.id_c
                    WHERE users_cstm.teamheirarchy_c = 'team_lead'";
        $fetch_result = $GLOBALS['db']->query($query);
        $teamLeadList = '<option value="" selected disabled>Select</option>';
        while($row = $GLOBALS['db']->fetchByAssoc($fetch_result)){
            $teamLeadList .= '<option value="'.$row['id'].'">'.beautify_label( $row['first_name']. ' ' .$row['last_name'] ).'</option>';
        }
        echo json_encode(
            array(
                'data' => $teamLeadList,
                'status' => 'success',
            )
        );
        die;
    }


    /**
     * Activity Functions////////////////////////////////////////////////////////////////////////////////
     * 
     * 
     * 
     * 
     *-----------------------------------------------------------------------------------------------------------

    */
    
    
  //-----------------------------------------------Activity Reassignment----------------------------------------
            
public function is_activity_reassignment_applicable($activity_id) {
   
             global $current_user;
            $log_in_user_id = $current_user->id;
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $team_func_array = $team_func_array1 = $others_id_array = array();

            $sql ="SELECT assigned_user_id FROM calls where id ='".$activity_id."' "; 
            $result = $GLOBALS['db']->query($sql);
            $row = $result->fetch_assoc();
            $user_id = $row['assigned_user_id'];
            
             $sql_status ="SELECT * FROM calls_cstm where id_c='$activity_id' "; 
            $result_status = $GLOBALS['db']->query($sql_status);
            $row_status = $result_status->fetch_assoc();
            $status= $row_status['status_new_c'];

            $sql1 = "SELECT user_lineage from users_cstm where id_c = '".$user_id."' ";
            $result1 = $GLOBALS['db']->query($sql1);
             while($row1 = $GLOBALS['db']->fetchByAssoc($result1)) 
            {
              $lineage=$row1['user_lineage'];

            }
             $team_func_array=explode(',',$lineage);
            
            $sql3 = "SELECT users.id, users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '".$log_in_user_id."' AND users.deleted = 0";
            $result3 = $GLOBALS['db']->query($sql3);
            while($row3 = $GLOBALS['db']->fetchByAssoc($result3)) 
            {
                $check_sales = $row3['teamfunction_c'];
                $check_mc = $row3['mc_c'];
                $check_team_lead = $row3['teamheirarchy_c'];

            }
            
              $sql_pending ='SELECT * FROM `activity_approval_table` WHERE `acc_id`="'.$activity_id.'" AND `approval_status`="0"';
                 $result_pending = $GLOBALS['db']->query($sql_pending);
                $pending_count=$result_pending->num_rows;
            
        if($pending_count<=0){
            
            if($status=="Upcoming"||$status=="Apply For Completed"){
            
            if($check_mc =="yes"||  $log_in_user_id == "1" || in_array($log_in_user_id, $team_func_array) ){
                return true;
            }
            else if($log_in_user_id==$user_id){
                
                $sql_reports_id = "SELECT * FROM users WHERE reports_to_id='".$log_in_user_id."'";
                 $result_reports_id= $GLOBALS['db']->query($sql_reports_id);
                $reports_count=$result_reports_id->num_rows;
                
                if($reports_count>0){
                     return true;
                }
                else{
                    return false;
                }
            
            }
            else {
                return false;
            }
            
            }
            else{
                return false;
            }
        }else{
             return false;
        }

    
}


    
    //------------------Feteching the all data for Activity modules on click---------------//
     
    public function action_getActivity(){
        try
        {
            $GLOBALS['db'];
            global $current_user;
            $db      = \DBManagerFactory::getInstance();
            
            $content = '';
            $log_in_user_id = $current_user->id;
            
            $day        = $_GET['days'];
            $searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';

            $user_for_delegates             = '';
            $self_count                     = 0;
            $team_count                     = 0;
            $lead_data                      = "";
            $global_organization_count      = 0;
            $non_global_organization_count  = 0;
            $fetch_by_status_c              = '';

            $user_team                      = userTeam($log_in_user_id);

            $counts = $this->get_activity_history();
            if( !empty($counts) ){
                $self_count = $counts['self_count'];
                $team_count = $counts['team'];
                $total      = $counts['organisation'];
            }

            $fetch_by_status    = "";
            $result             = array();

            /* Activities main HTML */
            ob_start();
            include_once 'templates/partials/activities/main.php';
            $content = ob_get_contents();
            ob_end_clean();

            $fetch_query = getActivityQuery(); // getActivity Query

            //Pagination Query
            $limit = 5;
            $paginationQuery = $GLOBALS['db']->query($fetch_query);
            $totalCount = mysqli_num_rows($paginationQuery);
            $numberOfPages = ceil( $totalCount / $limit );
            
            $offset = $_GET['page'] ? ($_GET['page'] - 1)  * $limit : 0;

            $fetch_query .= " LIMIT $offset, $limit";

            $result = $GLOBALS['db']->query($fetch_query);
            $response = $this->mysql_fetch_assoc_all($result); //get all result in an array

            /* Activities repeater HTML (Table ROW) */
            ob_start();
            include_once 'includes/helpers.php';
            include_once 'templates/partials/activities/repeater.php';
            $content .= ob_get_contents();
            ob_end_clean();

            $delegated_user_name = '';
            $delegated_user_id = $this->get_delegated_user($log_in_user_id);
            if ($delegated_user_id != null) {
                $delegated_user = $this->get_user_details_by_id($delegated_user_id);
                $delegated_user_name = $delegated_user['first_name'] . $delegated_user['last_name'];
            }

            /* Pagination HTML */
            $page = $_GET['page'] ? $_GET['page'] : 1;
            if ($totalCount > ( $page * $limit)){
                $currentPost = ($page * $limit);
            } else {
                $currentPost = $totalCount;
            }
            $content .= '<div class="pagination text-right">';
            $content .= '<p class="d-inline-block">Showing '.$currentPost.' of '.$totalCount.'</p>';

            $type = array(
                'method' => 'activity',
                'status' => '',
                'type' => ''
            );

            $content .= $this->activitypagination($page, $numberOfPages, $type, $day, $searchTerm, $_GET['filter']);
            $content .= '</div>';
            /* End Pagination HTML */
            $columnFilterHtml   = $this->getActivityColumnFilters();
            $filters            = $this->getActivityFilterHtml('activity', $_GET);

            echo json_encode(array(
                'data'                      => $content,
                'total'                     => $total,
                'self_count'                => $self_count,
                'team_count'                => $team_count,
                'delegate'                  => $this->checkDelegate(),
                'delegateDetails'           => $this->getActivityDelegateDetails(),
                'global_organization_count' => $global_organization_count,
                'non_global_organization'   =>  $non_global_organization_count,
                'fetched_by_status'         =>  $fetch_by_status,
                'columnFilter'              => $columnFilterHtml,
                'filters'                   => $filters,
                'user_id'                   => $log_in_user_id,
            
            ));
            die();
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }
    
    //------------For Activity Pending Table----------------------------------------//
    function action_getPendingActivityList(){
        try
        {
            $content = '';
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            global $current_user;
            $log_in_user_id = $current_user->id;

            /*$columnAmount                   = isset( $_GET['Amount'] ) ? $_GET['Amount'] : '';
            $columnREPEOI                   = isset( $_GET['REP-EOI-Published'] ) ? $_GET['REP-EOI-Published'] : '';
            $columnClosedDate               = isset( $_GET['Closed-Date'] ) ? $_GET['Closed-Date'] : '';
            $columnClosedBy                 = isset( $_GET['Closed-by'] ) ? $_GET['Closed-by'] : '';
            $columnDateCreated              = isset( $_GET['Date-Created'] ) ? $_GET['Date-Created'] : '';
            $columnDateClosed               = isset( $_GET['Date-Closed'] ) ? $_GET['Date-Closed'] : '';

            $columnTaggedMembers            = isset( $_GET['Tagged-Members'] ) ? $_GET['Tagged-Members'] : '';
            $columnViewedBy                 = isset( $_GET['Viewed-by'] ) ? $_GET['Viewed-by'] : '';
            $columnPreviousResponsibility   = isset( $_GET['Previous-Responsbility'] ) ? $_GET['Previous-Responsbility'] : '';
            $columnAttachment               = isset( $_GET['Attachment'] ) ? $_GET['Attachment'] : '';*/
            
            /*$maxQuery   = "SELECT row_count FROM approval_table 
                    WHERE ap.Approved = 0 AND ap.Rejected = 0 AND ap.pending = 1 
                    AND ( ap.approver_rejector = '$log_in_user_id' OR ap.delegate_id = '$log_in_user_id' ) 
                    AND ap.apply_for = '$status' 
                    ORDER BY row_count 
                    DESC LIMIT 1";
            $result     = $GLOBALS['db']->query($maxQuery);
            $rowCount   = $GLOBALS['db']->fetchByAssoc($result);

            if($rowCount)
                $rowCount = $rowCount['row_count'];*/

            //Pagination Count
            /*$limit = 5;
            $paginationQuery = $GLOBALS['db']->query($fetch_query);
            $totalCount = mysqli_num_rows($paginationQuery);
            $numberOfPages = ceil( $totalCount / $limit );
            
            $offset = $_GET['page'] ? ($_GET['page'] - 1) * $limit : 0;

            $fetch_query .= " LIMIT $offset, $limit";*/

            ob_start();
            include_once 'templates/partials/pending-activity-requests/main.php';
            $content = ob_get_contents();
            ob_end_clean();

            $fetch_query    = getActivityQuery(); // getActivity Query
            $result         = $GLOBALS['db']->query($fetch_query);
            $response       = $this->mysql_fetch_assoc_all($result); //get all result in an array

            /* Pending Activity repeater HTML (Table ROW) */
            ob_start();
            include_once 'templates/partials/pending-activity-requests/repeater.php';
            $content .= ob_get_contents();
            ob_end_clean();


            //Pagination 
            /*$page = $_GET['page'] ? $_GET['page'] : 1;
            if ($totalCount > ( $page * $limit)){
                $currentPost = ($page * $limit);
            } else {
                $currentPost = $totalCount;
            }
            $content .= '<div class="pagination text-right">';
            $content .= '<p class="d-inline-block">Showing '.$currentPost.' of '.$totalCount.'</p>';

            $type = array(
                'method' => 'pending',
                'status' => $status,
                'type'   => '',
            );
            
            $content .= $this->activitypagination($page, $numberOfPages, $type, '30', '', $_GET['filter']);
            $content .= '</div>';*/

            // echo $content;
            $columnFilterHtml   = $this->getActivityColumnFilters('pendings');
            $filters            = $this->getActivityFilterHtml('activity', $_GET);

            echo json_encode(array(
                'data'                      => $content,
                'columnFilter'              => $columnFilterHtml,
                'filters'                   => $filters
            )); die;

        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }
    
    //---------------------For Activity Graph---------------------------//
    public function action_get_activity_graph(){
        $day = $_GET['dateBetween'];
        $totalCount = 0;
        $totalCount = $this->getActivityStatusCountGraph(null , $day);
        // $leadCount = round($this->getActivityStatusCountGraph('Lead') / $totalCount * 100, 0);
        if ($totalCount > 0) {
            $UpcomingCount  = round($this->getActivityStatusCountGraph('Upcoming', $day) / $totalCount * 100, 0);
            $DelayedCount   = round($this->getActivityStatusCountGraph('Overdue', $day) / $totalCount * 100, 0);
            $CompletedCount = round($this->getActivityStatusCountGraph('Completed', $day) / $totalCount * 100, 0);
        }
        $UpcomingCount      = $UpcomingCount ?? 0;
        $DelayedCount       = $DelayedCount ?? 0;
        $CompletedCount     = $CompletedCount ?? 0;
        
        $data = '';
    
        if($UpcomingCount):
            $data .= '<div style="width: '.$UpcomingCount.'%" class="graph-bar-each upcoming">
                    <div style="width: 100%;height: 70px;background-color: #DDA0DD;"></div>
                    <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$UpcomingCount.'%</p>
                </div>';
        endif;
    
        if($CompletedCount):
            $data .= '<div style="width: '.$CompletedCount.'%" class="graph-bar-each completed">
                    <div style="width: 100%;height: 70px;background-color: #4B0082;"></div>
                    <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$CompletedCount.'%</p>
                </div>';
        endif;
        
        if($DelayedCount):
            $data .= '<div style="width: '.$DelayedCount.'%" class="graph-bar-each delayed">
                    <div style="width: 100%; height: 70px; background-color: #0000FF;"></div>
                    <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$DelayedCount.'%</p>
                </div>';
        endif;

        echo json_encode(array("data"=>$data, "message" => "Success"));
        die;
    }
    
    function getActivityStatusCountGraph($status = null, $day, $closure_status = null){
        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];

        $query = "SELECT count(*) as count FROM calls_cstm cc LEFT JOIN calls c ON c.id = cc.id_c WHERE c.deleted != 1 AND c.date_entered >= now() - interval '".$day."' day";
        if($status)
            $query .= " AND cc.status_new_c = '".$status."' ";

        $count = $GLOBALS['db']->query($query);
        $count = $GLOBALS['db']->fetchByAssoc($count);
        return $count['count'];
    }
    //-------------------------End Activity Graph---------------------------//

    //--------------------For count of Pending Activity------------------//
    public function action_activity_pending_count(){
        try {
            global $current_user;
            $log_in_user_id = $current_user->id;
    
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $PRC = 0;
            $DELE_COUNT = 0 ;

            $query = "SELECT id FROM calls WHERE deleted != 1 AND date_entered >= now() - interval '1200' day";
            $result = $GLOBALS['db']->query($query);
            $response = $this->mysql_fetch_assoc_all($result); //get all result in an array
            foreach($response as $r){
                $id = $r['id'];
                $query = "SELECT approval_status FROM activity_approval_table WHERE acc_id = '$id' AND ( approver = '$log_in_user_id' OR delegate_id = '$log_in_user_id' ) ORDER BY `id` DESC LIMIT 1";
                $result = $GLOBALS['db']->query($query);
                $count = $GLOBALS['db']->fetchByAssoc($result);
                if($count && $count['approval_status'] == '0')
                    $PRC += 1;
                
                $dele_count_query = "SELECT approval_status FROM activity_approval_table WHERE acc_id = '$id' AND approver = '$log_in_user_id' ORDER BY `id` DESC LIMIT 1";
                $dele_count_res = $GLOBALS['db']->query($dele_count_query);
                $count_del_count = $GLOBALS['db']->fetchByAssoc($dele_count_res);
                if($count_del_count && $count_del_count['approval_status'] == '0')
                    $DELE_COUNT += 1;
            }

            echo json_encode(
                array(
                    'data' => "$PRC <i class=\"fa fa-angle-double-down\" aria-hidden=\"true\"></i>",
                    'count' => $PRC,
                    'delegate_count' => $DELE_COUNT,
                )
            );
        }
        catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }
    
    //Pagination
    function activitypagination($page, $numberOfPages, $type, $day, $searchTerm, $filter){

        $ends_count = 1;  //how many items at the ends (before and after [...])
        $middle_count = 2;  //how many items before and after current page
        $dots = false;

        $data = '<ul class="d-inline-block">';
        
        if($page > 1)
            $data .= '<li class="" onClick=activitypaginate("'.($page - 1).'","'.$type['method'].'","'.$day.'","'.$searchTerm.'","'.$filter.'","'.$type['status'].'","'.$type['type'].'")><strong>&laquo;</strong> Prev</li>';

        for ($i = 1; $i <= $numberOfPages; $i++) {
            $currentPage = $page ? $page : 1;
            $class = $currentPage == $i ? 'active paginate-class' : 'paginate-class';

            
            $onClick = 'onClick=activitypaginate("'.$i.'","'.$type['method'].'","'.$day.'","'.$searchTerm.'","'.$filter.'","'.$type['status'].'","'.$type['type'].'")';

            if ($i == $page) {
                $data .= '<li class="'.$class.'" '.$onClick.'>'.$i.'</li>';
                $dots = true;
            } else {
                if ($i <= $ends_count || ($page && $i >= $page - $middle_count && $i <= $page + $middle_count) || $i > $numberOfPages - $ends_count) { 
                    $data .= '<li class="'.$class.'" '.$onClick.'>'.$i.'</li>';
                    $dots = true;
                } elseif ($dots){
                    $data .= '<li class="paginate-class">&hellip;</li>';
                    $dots = false;
                }
            }
        }
        if ($page < $numberOfPages || -1 == $numberOfPages) { 
           $data .= '<li class="" onClick=activitypaginate("'.($page + 1).'","'.$type['method'].'","'.$day.'","'.$searchTerm.'","'.$filter.'","'.$type['status'].'","'.$type['type'].'")>Next <strong>&raquo;</strong></li>';
        }
            
        $data .= '</ul>';
        return $data;
    }
    
    //-------------------------For Activity Reminder----------------------------//
    public function action_activity_reminder_dialog_info()
    {
        try {
            $db = \DBManagerFactory::getInstance();
            global $current_user;
            $log_in_user_id = $current_user->id;
            $activity_id = $_GET['id'];
            $fetch_activity_info = "SELECT * FROM calls
            LEFT JOIN calls_cstm ON calls.id = calls_cstm.id_c WHERE id = '$activity_id'";
            $fetch_activity_info_result = $GLOBALS['db']->query($fetch_activity_info);
            $row = $GLOBALS['db']->fetchByAssoc($fetch_activity_info_result);
            $assigned_user_id = $row['assigned_user_id'];
            $user_full_name = getUsername($assigned_user_id);

            $label_1 = "Frequency";
            $label_2 = "Time";
            
            
            $fetch_query = "SELECT frequency, time from activity_reminder where created_by = '$log_in_user_id' AND activity_id='$activity_id'";
            $result = $GLOBALS['db']->query($fetch_query);
            $data1 = $result->fetch_assoc();

            $data = '
                <h2 class="deselectheading">' . $row['name'] . '</h2><br>
                <p class="deselectsubhead">Select a frequency and time for the reminder</p>
                <hr class="deselectsolid">
                <section class="deselectsection">
                <table align="centered" width="100%">
                    <thead>
                    <tr class="tabname">
                        <th>Last Update</th>
                        <th>Activity Type</th>
                        <th>Subject</th>
                        <th>Assigned to</th>
                        <th>End Date</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr class="tabvalue">
                        <td>' . date_format(date_create($row['date_modified']), 'd/m/Y') . '</td>
                        <td>' . ucfirst($row['type_of_interaction_c']) . '</td>
                        <td>' . ucfirst($row['name']) . '</td>
                        <td>' . ucwords($user_full_name). '</td>
                        <td>'  . date_format(date_create($row['activity_date_c']), 'd/m/Y') . '</td>
                        </tr>
                        </tbody></table><br>';

            if ($result){
                if ($result->num_rows > 0 ){
                $data .= '
                    <label for="Deselect-Members">'.$label_1 .'</label><br>
                    <select name="frequency" id="frequency" style="width:250px;
                                                        padding: 0px;
                                                        border-color: #dee0e3;
                                                        background: white;
                                                        position: absolute;
                                                        height: 30px !important;
                                                        ">
                        <option value='.$data1['frequency'].' selected>'.$data1['frequency'].'</option>
                        <option value="Daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="Monthly">Monthly</option>
                    </select>
                    <br>
                    <div style="height: 20px;"></div>
                    <label for="Deselect-Members">'.$label_2 .'</label><br>
                    <input type= "time" name="time" id="time" style="width:250px;
                                                        padding: 0px;
                                                        border-color: #dee0e3;
                                                        background: white;
                                                        position: absolute;
                                                        height: 30px !important;
                                                        "
                                                        value='.$data1['time'].'>
                    </input>
                ';
            }
            else{
                    $data .= '
                        <label for="Deselect-Members">'.$label_1 .'</label><br>
                        <select name="frequency" id="frequency" style="width:250px;
                                                            padding: 0px;
                                                            border-color: #dee0e3;
                                                            background: white;
                                                            position: absolute;
                                                            height: 30px !important;
                                                            ">
                        <option value="Daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="Monthly">Monthly</option>
                        </select>
                        <br>
                        <div style="height: 20px;"></div>
                        <label for="Deselect-Members">'.$label_2 .'</label><br>
                        <input type= "time" name="time" id="time" style="width:250px;
                                                            padding: 0px;
                                                            border-color: #dee0e3;
                                                            background: white;
                                                            position: absolute;
                                                            height: 30px !important;
                                                            ">
                        </input>
                    ';
                }

            }



          echo json_encode(array('activity_info'=>$data,'activity_id'=>$activity_id));
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }


    public function action_deselect_members_from_global_opportunity(){
        try {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            $opportunity_id = $_POST['tag_opporunity_id'];
            $user_id_list = '';
            if (isset($_POST['tag_opporunity'])) {
                $user_id_list = $_POST['tag_opporunity'];
                $user_id_list = implode(',',$user_id_list);
            } else {
                echo json_encode(array("status" => false, "message" => "Nothing has been updated"));
                die();
            }
            // $count_query = "SELECT * FROM tagged_user WHERE opp_id='$opportunity_id'";

            $count_query ="SELECT tagged_user.*, opportunities.name
            FROM opportunities 
            LEFT JOIN tagged_user ON opportunities.id = tagged_user.opp_id
            WHERE opportunities.id ='$opportunity_id' ";
            $result = $GLOBALS['db']->query($count_query);
            $row = $GLOBALS['db']->fetchByAssoc($result);

            $untagged_user_ids = $tagged_user_ids = $untagged_names_arr = $tagged_names_arr = [];
            $last_users_array = explode(',', $row['user_id']);
            $latest_users_array = $_POST['tag_opporunity'];
            $untagged_user_ids = array_diff($last_users_array, $latest_users_array);
            $tagged_user_ids = array_diff($latest_users_array, $last_users_array);


            // if ($result->num_rows > 0) {
            if ($row["user_id"]) {   
                $query = "UPDATE tagged_user SET user_id = '$user_id_list' WHERE opp_id='$opportunity_id'";
                $result = $GLOBALS['db']->query($query);
            } else {
                $users_array = explode(',', $user_id_list);
                foreach($users_array as $id) {
                    $query = "INSERT into tagged_user(opp_id,user_id) VALUES('$opportunity_id','$id')";
                    $result = $GLOBALS['db']->query($query);
                } 
            }

            
            $sub_query = "UPDATE opportunities_cstm SET tagged_hiden_c = '$user_id_list' WHERE id_c='$opportunity_id'";
            $GLOBALS['db']->query($sub_query);


            foreach($untagged_user_ids as $id) {
                array_push($untagged_names_arr, getUsername($id));
            }    
            foreach($tagged_user_ids as $id) {
                array_push($tagged_names_arr, getUsername($id));
            }     

            $tagged_users_string = implode(',',$tagged_names_arr);
            $untagged_users_string = implode(',',$untagged_names_arr);



            // $notification_message = "You have been tagged. Now you can edit /make changes to opportunities ".$row['name'];
            // send_notification("Opportunities", $row['name'], $notification_message, $tagged_user_ids);

            $opportunity_link = "index.php?action=DetailView&module=Opportunities&record=".$opportunity_id;
            $notification_message = 'You have been tagged for opportunity "'.$row['name'].'". Now you can edit /make changes.';
            send_notification("Opportunity", $row['name'], $notification_message, $tagged_user_ids, $opportunity_link);


            $receiver_emails = []; 
            foreach($tagged_user_ids as $user_id) {
                array_push($receiver_emails, getUserEmail($user_id));
            }
            
            if(count($receiver_emails) > 0) {
                $notification_message = $notification_message."<br><br>Click here to view: www.ampersandcrm.com";
                send_email($notification_message, $receiver_emails, 'CRM ALERT - Tagged');
            }

            $untagged_receiver_emails = [];
            foreach($untagged_user_ids as $user_id) {
                array_push($untagged_receiver_emails, getUserEmail($user_id));
            }
            if(count($untagged_receiver_emails) > 0) {
                $untagged_notification_message = 'You have been untagged from opportunity "'.$row['name'].'".';
                send_email($untagged_notification_message, $untagged_receiver_emails, 'CRM ALERT - Untagged');
            }


            echo json_encode(array("status" => true, "message" => "Tag Updated.", "Result"=>$result, "tagged_users" => $tagged_users_string, "untagged_users" => $untagged_users_string, "opp_name" => $row['name']));
        } catch (Exception $e) {
            echo json_encode(array("status" => false, "message" => "Some error occured"));
        }
        die();
    }

    /* Activity Filters & Columns */
    function getActivityColumnFilters($type = null){
        /* Default Columns */
        if($type){
            $columnFilterHtml = '<form class="activity-pending-settings-form sort-column">';
            $columnFilterHtml .= '<input type="hidden" name="activity-settings-section" class="activity-pending-settings-section" value="" />
            <input type="hidden" name="activity-settings-type" class="activity-pending-settings-type" value="" />
            <input type="hidden" name="activity-settings-type-value" class="activity-pending-settings-type-value" value="" />';
        }else{
            $columnFilterHtml = '<form class="activity-settings-form sort-column">';
            $columnFilterHtml .= '<input type="hidden" name="activity-settings-section" class="activity-settings-section" value="" />
            <input type="hidden" name="activity-settings-type" class="activity-settings-type" value="" />
            <input type="hidden" name="activity-settings-type-value" class="activity-settings-type-value" value="" />';
        }
        $columnFields = $this->ActivityColumns();
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
                    <input class="settingInputs" type="checkbox" id="name-select" name="customActivityColumns[]" value="'.$key.'" checked="True" style="display: none">
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
                    <input class="settingInputs" type="checkbox" id="name-select" name="customActivityColumns[]" value="'.$key.'" checked="True" style="display: none">
                    <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> '.$field.'</label>
                </li>';
        }
        $columnFilterHtml .= '</ul>';

        return $columnFilterHtml;
    }

    function ActivityColumns(){
        $fields = array();

        $default = array(
            'name'                  => 'Activity Name',
            'related_to'            => 'Related To',
            'status'                => 'Status',
            'activity_date_c'       => 'Activity Due Date',
            'assigned_to_c'         => 'Assigned To',
            'next_date_c'           => 'Next Follow-Up / Interaction Date',
            'name_of_person_c'      => 'Name of Person Contacted'
        );

        $default2 = array(
            'new_current_status_c'          => 'Comments',
            // 'description'                   => 'Summary of Interaction',
            // 'new_key_action_c'              => 'Key Actionable / Next Steps identified from the Interaction',
            

        );

        $fields['default'] = $default;
        $fields['addons'] = $default2;

        return $fields;
    }
    function DocumentColumns(){
        $fields = array();

        $default = array(
            'name'                  => 'Document Name',
            'document_type'         => 'Document Type',
            'related_to'            => 'Related To',
            'category'              => 'Category',
            'sub_category'          => 'Sub Category',
            'uploaded_by'           => 'Uploaded by'
        );

        $default2 = array(
            // 'new_current_status_c'          => 'Comments',
            // 'description'                   => 'Summary of Interaction',
            // 'new_key_action_c'              => 'Key Actionable / Next Steps identified from the Interaction',
            

        );

        $fields['default'] = $default;
        $fields['addons'] = $default2;

        return $fields;
    }

    function getActivityColumnFiltersHeader($columnFilter){

        $data = '';
        $customColumns = $_GET['customActivityColumns'];
        if($customColumns):
        foreach($customColumns as $key => $column){
            $data .= $this->getActivityColumnHtml($column);
        }
        endif;

        return $data;
    }

    function getActivityColumnHtml($column){
        $data = '';
        switch($column){
            case 'name':
                $data .= '<th class="table-header">Activity Name</th>';
                break; 
            case 'related_to':
                $data .= '<th class="table-header">Related To</th>';
                break;
            case 'status':
                $data .= '<th class="table-header">Status</th>';
                break;
            case 'activity_date_c':
                $data .= '<th class="table-header">Activity Due Date</th>';
                break;
            // case 'date_modified':
            //     $data .= '<th class="table-header">Last Modified</th>';
            //     break;
            case 'assigned_to_c':
                $data .= '<th class="table-header">Assigned To</th>';
                break;
            case 'new_current_status_c':
                $data .= '<th class="table-header">Comments</th>';
                break;
            case 'description':
                $data .= '<th class="table-header">Summary of Interaction</th>';
                break;
            case 'new_key_action_c':
                $data .= '<th class="table-header">Key Actionable / Next Steps identified from the Interaction</th>';
                break;
            case 'next_date_c':
                $data .= '<th class="table-header">Next Follow-Up / Interaction Date</th>';
                break;
            case 'name_of_person_c':
                $data .= '<th class="table-header">Name of Person Contacted</th>';
                break;
        }
        return $data;
    }

    function getActivityColumnFiltersBody($columnFilter, $row){

        $data = '';
        $customColumns = @$_GET['customActivityColumns'];

        if($customColumns):
        foreach($customColumns as $column){
            $data .= $this->getActivityColumnDataHtml($column, $row);
        }
        endif;

        return $data;

    }

    function getActivityColumnDataHtml($column, $row){
        $data = '';
        global $current_user;
        $log_in_user_id = $current_user->id;

        switch($column){
            case 'name':
                $data .= '<td class="table-data">';
                    $data .= '<a href="index.php?module=Calls&action=DetailView&record='.$row['id'].'">';

                    $tag_icon_query = 'SELECT * FROM calls_cstm where id_c = "' .$row['id'].'"';
                    $result = $GLOBALS['db']->query($tag_icon_query);
                    $tagged_user = $result->fetch_assoc();
                    $tagged_user_array = explode(',',$tagged_user['tag_hidden_c']); 

                    $data .= '<h2 class="activity-title">'. $row['name'];
                    if (in_array($log_in_user_id,$tagged_user_array)){
                        $data .= '   <i class="fa fa-tag" style="font-size: 12px; color:green"></i></h2></a>';
                    }
                    else {
                        $data .= '</h2></a>';
                    }
                    $data .= '<span class="activity-type d-block">'. beautify_label($row['type_of_interaction_c']) .'</span></td>';

                    break; 
            case 'related_to':
                $parent_type = '';
                $data .= '<td class="table-data">';
                $data .= '<h2 class="activity-related-name">'. getActivityRelatedTo($row['parent_type'], $row['parent_id']) .'</h2>';
                if( strtolower($row['parent_type']) == 'calls'){
                    $parent_type = 'Activity';
                }
                elseif( strtolower($row['parent_type']) == 'accounts'){
                    $parent_type = 'Department';
                }
                else{
                    $parent_type = $row['parent_type'];
                }
                $data .= '<span class="activity-related-type">'. $parent_type .'</span></td>';
                break;
            case 'status':
                $data .= '<td class="table-data">'. $row['status_new_c'] .'</td>';
                break;
            case 'activity_date_c':
                $data .= '<td class="table-data">'. date( 'd/m/Y', strtotime($row['activity_date_c']) ) .'</td>';
                break;
            // case 'date_modified':
            //     $data .= '<td class="table-data">'. date( 'd/m/Y', strtotime($row['date_modified']) ) .'</td>';
            //     break;
            case 'assigned_to_c':
                $data .= '<td class="table-data">'. $row['assigned_to_c'] .'</td>';
                break;
            case 'new_current_status_c':
                $data .= '<td class="table-data">'. $row['new_current_status_c'] .'</td>';
                break;
            case 'description':
                $data .= '<td class="table-data">'. $row['description'] .'</td>';
                break;
            case 'new_key_action_c':
                $data .= '<td class="table-data">'. $row['new_key_action_c'] .'</td>';
                break;
            case 'next_date_c':
                $data .= '<td class="table-data">'. date( 'd/m/Y', strtotime($row['next_date_c'] ) ) .'</td>';
                break;
            case 'name_of_person_c':
                $data .= '<td class="table-data">'. $row['name_of_person_c'] .'</td>';
                break;
        }
        return $data;
    }

    function getActivityFilterHtml($type, $columnFilter){

        $query = getQuery('DISTINCT(type_of_interaction_c)', 'calls_cstm');
        $interactions = $this->mysql_fetch_assoc_all($query);
        /* default fields */
        $html = '<div class="form-group">
                <span class="primary-responsibilty-filter-head">Activity Name</span>
                <input type="text" class="form-control filter-name" name="filter-name" />
            </div>';

        $html .= '<div class="form-group">
                <span class="primary-responsibilty-filter-head">Type of Interaction</span>
                <select class="" name="filter-type_of_interaction">
                    <option value="">Select Type</option>';
        foreach($interactions as $i){
            $html .= '<option value="'.$i['type_of_interaction_c'].'">'.beautify_label($i['type_of_interaction_c']).'</option>';
        }
        $html .= '</select></div>';

        /*$html .= '<div class="form-group">
                <span class="primary-responsibilty-filter-head">Related to</span>
                <select class="activity-filter" name="filter-related_to">
                    <option value="">Select</option>
                    <option value="Accounts">Accounts</option>
                    <option value="Opportunities">Opportunities</option>
                    <option value="Calls">Calls</option>
                    <option value="Document">Document</option>
                </select></div>';*/

        $columns = $this->ActivityColumns();
        foreach($columns['default'] as $key => $c){
            if(isset($columnFilter[$key])){
                $html .= $this->ActivityfilterFields($type, $columnFilter[$key]);
            }
        }

        foreach($columns['addons'] as $key => $c){
            if(isset($columnFilter[$key])){
                $html .= $this->ActivityfilterFields($type, $columnFilter[$key]);
            }
        }
        
        return $html;
    }

    function ActivityfilterFields($type, $columnFilter){
        $data = '';
        switch($columnFilter){
            case 'related_to':
                $data = '<div class="form-group">
                    <span class="primary-responsibilty-filter-head">Related to</span>
                    <select class="activity-filter-related-to" name="filter-related_to_new">
                        <option value="">Select</option>
                        <option value="Accounts">Accounts</option>
                        <option value="Opportunities">Opportunities</option>
                        <option value="Calls">Activity</option>
                        <option value="Document">Document</option>
                    </select></div>';
                break;
            case 'status':
                $data = '<div class="form-group">
                    <span class="primary-responsibilty-filter-head">Status</span>
                    <select class="" name="filter-status" id="">
                        <option value="">Select</option>
                        <option value="Upcoming">Upcoming</option>
                        <option value="Completed">Completed</option>
                        <option value="Overdue">Overdue</option>
                    </select>
                    
                </div>';
                break;
            
            case 'activity_date_c':
                $data = '<div class="form-group">
                    <div class="date-filter">
                        <label>Activity Date Range</label><br>
                        From: <input class="filterdatebox" name="filter-activity_date_c_from" id="closed_date_from" width="300" />
                        To: <input class="filterdatebox" name="filter-activity_date_c_to" id="closed_date_to" width="300" />
                    </div>
                </div>';
                break;
            
            case 'date_modified':
                $data = '<div class="form-group">
                    <div class="date-filter">
                        <label>Modified Date Range</label><br>
                        From: <input class="filterdatebox" name="filter-date_modified_from" id="closed_date_from" width="300" />
                        To: <input class="filterdatebox" name="filter-date_modified_to" id="closed_date_to" width="300" />
                    </div>
                </div>';
                break;
            
            case 'assigned_to_c':
                $users = $this->get_users_with_team_options();
                $data = '<div class="form-group">
                    <span class="primary-responsibilty-filter-head">Assigned To</span>
                    <select class="select2" name="filter-assigned_to_c[]" id="" multiple>
                        '.$users.'
                    </select>
                </div>';
                break;
            
            case 'new_current_status_c':
                $data = '<div class="form-group">
                    <span class="primary-responsibilty-filter-head">Comments</span>
                    <input class="form-control" name="filter-new_current_status_c" id="" />
                </div>';
                break;
            
            case 'description':
                $data = '<div class="form-group">
                    <span class="primary-responsibilty-filter-head">Summary of Interaction</span>
                    <input class="form-control" name="filter-description" id="" />
                </div>';
                break;

            case 'new_key_action_c':
                $data = '<div class="form-group">
                    <span class="primary-responsibilty-filter-head">Key Actionable / Next Steps identified from the Interaction</span>
                    <input class="form-control" name="filter-new_key_action_c" id="" />
                </div>';
                break;
            

            case 'next_date_c':
                $data = '<div class="form-group">
                    <div class="date-filter">
                        <label>Next Follow Up Date</label><br>
                        From: <input class="filterdatebox" name="filter-next_date_c_from" id="closed_date_from" width="300" />
                        To: <input class="filterdatebox" name="filter-next_date_c_to" id="closed_date_to" width="300" />
                    </div>
                </div>';
                break;
            case 'name_of_person_c':
                $data = '<div class="form-group">
                    <span class="primary-responsibilty-filter-head">Name of Person Contacted </span>
                    <input class="form-control" name="filter-name_of_person_c" id="" />
                </div>';
                break;
            
            default:
                $data = '';
                break;
        }
        return $data;
    }

    /* End Activity Filters & Columns */

    /* Activity Approvals */
    /* get activity details for approval */
    function action_get_activity_approval_item(){
        try
        {
            global $current_user;
            $log_in_user_id = $current_user->id;
            
            $id = $_POST['id'];
            $event = $_POST['event'];

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $fetch_query = "SELECT c.*, cs.* FROM calls c JOIN activity_approval_table ap ON ap.acc_id = c.id LEFT JOIN calls_cstm cs ON c.id = cs.id_c WHERE c.deleted != 1 AND c.date_entered >= now() - interval '1200' day AND ap.id = '$id'";
            $result = $GLOBALS['db']->query($fetch_query);
            while($row = $GLOBALS['db']->fetchByAssoc($result))
            {
                $temp = ($event == 'Approve') ? 'Approval' : 'Rejection';
                $data = '
                <input type="hidden" name="acc_id" value="'.$row['id'].'" />
                <input type="hidden" name="event" value="'.$event.'" />
                <input type="hidden" name="approval_id" value="'.$id.'" />
                <h2 class="approvalheading">'.$row['name'].'</h2><br>
                <p class="approvalsubhead">'. $temp .' of Activity
                </p>
                <section>
                    <div style="padding: 10px 15px;">
                        <table class="approvaltable" width="100%">
                            <tr class="tapprovalable-header-row-popup">
                                <th class="approvaltable-header-popup">Activity</th>
                                <th class="approvaltable-header-popup">Related To</th>
                                <th class="approvaltable-header-popup">Status</th>
                                <th class="approvaltable-header-popup">Activity Date</th>
                                <th class="approvaltable-header-popup">Last Updated</th>
                            </tr>';

                        $data .='
                            <tr>
                                <td class="approvaltable-data-popup">'.$row['name'].'<br><span class="activity-type d-block">'. beautify_label($row['type_of_interaction_c']) .'</span></td>
                                <td class="approvaltable-data-popup">'.getActivityRelatedTo($row['parent_type'], $row['parent_id']).'<br><span class="activity-related-type">'. $row['parent_type'] .'</span></td>
                                <td class="approvaltable-data-boolean-popup">'.$row['status_new_c'].'</td>
                                <td class="approvaltable-data-popup">'.date( 'd/m/Y', strtotime($row['activity_date_c']) ).'</td>
                                <td class="approvaltable-data-popup">'.date( 'd/m/Y', strtotime($row['date_modified']) ).'</td>
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
                        <button class="btn1" type="button" onClick=updateActivityStatus();>'.$event.'</button>
                        <button type="button" style="margin-left: 10px;" class="btn2" id="approvalclose" onClick="openActivityApprovalDialog(\'close\');">Cancel</button>
                    </div>
                </section>';
            }
            echo $data;
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }
    
    /* approve / reject pending activities */
    function action_activity_status_update(){
        try
        {
            global $current_user;
            $log_in_user_id = $current_user->id;
            
            $id = $_POST['acc_id'];
            $approval_id = $_POST['approval_id'];
            $event = $_POST['event'];
            $comment = $_POST['comment'];

            if($event == 'Approve')
                $ApprovalStatus = '1';
            else
                $ApprovalStatus = '2';
            
            date_default_timezone_set('Asia/Kolkata');
            $date = date('Y-m-d');
        
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $data = $this->getDbData('activity_approval_table', '*', "acc_id = '$id' ");
            
            $data = $data[0];
            $acc_id = $data['acc_id'];
            $acc_type = $data['acc_type'];
            $status = $data['status'];
            $sender = $data['sender'];
            $sent_time = $data['sent_time'];
            $approver = $data['approver'];
            $delegateID = $data['delegate_id'];
            $notification_id = $data['id'];
            $description='';
            
            // $insertQuery = "INSERT INTO activity_approval_table (";
            // $insertFields = " acc_id, acc_type, status, sender, sent_time, approval_status, approver, delegate_id, ";
            // if($this->isActivityDelegate($log_in_user_id, $id))
            //     $insertFields .= " delegate_comment, delegate_approve_reject_date )";
            // else
            //     $insertFields .= " approver_comment, approve_reject_date )";
            
            // $insertValues = " VALUES ( '$acc_id', '$acc_type', '$status', '$sender', '$sent_time', '$ApprovalStatus', '$approver', '$delegateID', '$comment', '$date' ) ";

            // $finalQuery = $insertQuery . $insertFields . $insertValues ;

            $updateQuery = "UPDATE activity_approval_table SET approval_status = '$ApprovalStatus' ";
            if($this->isActivityDelegate($log_in_user_id, $id))
                $updateQuery .= ", delegate_comment = '$comment' , delegate_approve_reject_date = '$date' ";
            else
                $updateQuery .= " , approver_comment = '$comment' , approve_reject_date= '$date' ";
            $updateQuery .= " WHERE acc_id = '$id' ";

            if($db->query($updateQuery)==TRUE){
                if($ApprovalStatus == 1){
                    $updateOpportunity = "UPDATE calls_cstm SET status_new_c = 'Completed' WHERE id_c = '$id'";
                    $db->query($updateOpportunity);
                    require_once 'data/BeanFactory.php';
                    require_once 'include/utils.php';
                    $u_id = create_guid();
                    $created_date= date("Y-m-d H:i:s", time());
            		$sql_insert_audit = 'INSERT INTO `calls_audit`(`id`, `parent_id`, `date_created`, `created_by`, `field_name`, `data_type`, `before_value_string`, `after_value_string`, `before_value_text`, `after_value_text`) VALUES ("'.$u_id.'","'.$id.'","'.$created_date.'","'.$log_in_user_id.'","status_new_c","varchar","Apply for Completed","Completed"," "," ")';
            		$result_audit = $GLOBALS['db']->query($sql_insert_audit);
                }

                 //For Notification
                 $fetch_query = "SELECT c.*, cs.* FROM calls c JOIN activity_approval_table ap ON ap.acc_id = c.id LEFT JOIN calls_cstm cs ON c.id = cs.id_c WHERE c.deleted != 1 AND c.date_entered >= now() - interval '1200' day AND ap.id = '$notification_id'";
                 $result_query = $GLOBALS['db']->query($fetch_query);
                 $row = $GLOBALS['db']->fetchByAssoc($result_query);

 
                 //Assigned_user_id
                 $created_by_id_test = $row['created_by'];
                 $user_lineage_query ="SELECT user_lineage FROM users_cstm WHERE id_c ='$created_by_id_test'";
                 $result_lineage_query = $GLOBALS['db']->query($user_lineage_query);
                 $row_lineage = $GLOBALS['db']->fetchByAssoc($result_lineage_query); 
                 
                 if($row_lineage['user_lineage']!=0){
                    $assigned_user_id_approve =explode(',',$row_lineage['user_lineage']);
                    $team_lead = array_slice($assigned_user_id_approve, -1)[0];
                    if($team_lead==$log_in_user_id){
                        $team_lead = null; 
                    }
                 }else{
                     $team_lead = null;
                 }
                 

                 if($row['tag_hidden_c']!=0){
                    $tag_users = explode(',',$row['tag_hidden_c']);
                    if($team_lead!=null){
                        array_push($tag_users,$team_lead,$created_by_id_test);
                    }else{
                        array_push($tag_users,$created_by_id_test);
                    }
                     $assigned_user_id = $tag_users;
                 }else{
                     if($team_lead!=null){
                        $assigned_user_id = [$team_lead,$created_by_id_test];
                     }else{
                        $assigned_user_id = [$created_by_id_test];
                     }
                    
                 }
                 

                 $link = 'index.php?module=Calls&action=DetailView&record='.$row['id'];

                 if($event =='Approve'){
                     // $assigned_user_id_approval = [$team_lead,$created_by_id_test];

                    // array_push($assigned_user_id_approve,$row['created_by']);
                     // $assigned_user_id_approve = array_diff($assigned_user_id_approve, array($log_in_user_id) );
 
                     // $description = "Activity ".'"'.$row['name'].'"'." created by ".'"'.getUsername($row['created_by']).'"'." has been approved by ".'"'.getUsername($log_in_user_id).'"';
                     $description = "Activity ".'"'.$row['name'].'"'." has been approved.";
                     $description_notification = "Activity ".'"'.$row['name'].'"'." is approved by ".'"'.getUsername($log_in_user_id).'".';
                     $description_email = "Activity ".'"'.$row['name'].'"'." is approved by ".'"'.getUsername($log_in_user_id).'".'."<br><br>Click here to view: www.ampersandcrm.com";
                     send_notification('Activity', $row['name'], $description_notification,$assigned_user_id,$link);
                     $receiver_emails_approve = []; 
                    foreach($assigned_user_id as $user_id) {
                         array_push($receiver_emails_approve, getUserEmail($user_id));
                        }
                    
                    send_email($description_email,$receiver_emails_approve,'CRM ALERT - Approved');
                 }
                 if($event =='Reject'){
                     // $assigned_user_id_reject =[$team_lead,$created_by_id_test];
                     //$description = "Activity ".'"'.$row['name'].'"'." created by ".'"'.getUsername($row['created_by']).'"'." has been rejected by ".'"'.getUsername($log_in_user_id).'"';
                     $description = "Activity ".'"'.$row['name'].'"'." has been rejected.";
                     $description_notification = "Activity ".'"'.$row['name'].'"'." is rejected by ".'"'.getUsername($log_in_user_id).'".';
                     $description_email = "Activity ".'"'.$row['name'].'"'." is rejected by ".'"'.getUsername($log_in_user_id).'".'."<br><br>Click here to view: www.ampersandcrm.com";
                     send_notification('Activity',$row['name'],$description_notification,$assigned_user_id,$link);
                    
                     $receiver_emails_reject = []; 
                    foreach($assigned_user_id as $user_id) {
                         array_push($receiver_emails_reject, getUserEmail($user_id));
                        }
                    send_email($description_email,$receiver_emails_reject,'CRM ALERT - Rejected');
                }

                echo json_encode(array("status"=>true,  "message" => "Status changed successfully.", "description"=>$description, "user"=>$assigned_user_id));
            }else{
                echo json_encode(array("status"=>false, "message" => "Some error occured"));
            }
            
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured", "query" => $updateQuery));
        }
        die();
    }

    /* kalpaj queries */
    public function get_activity_history(){
        try {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            $day = $_COOKIE['day'];

            global $current_user;
            $log_in_user_id = $current_user->id;

            $self_count = "SELECT count(*) as totalCount FROM calls 
                LEFT JOIN calls_cstm ON calls.id = calls_cstm.id_c 
                WHERE assigned_user_id = '$log_in_user_id' AND deleted != 1 AND date_entered >= now() - interval '".$day."' day";
            $response['self_count'] = executeCountQuery($self_count);

            $user_manager = get_user_manager();

            $team_count = "SELECT count(*) as totalCount from calls LEFT JOIN calls_cstm ON calls.id = calls_cstm.id_c WHERE  deleted != 1 AND date_entered >= now() - interval '".$day."' day AND assigned_user_id IN (SELECT id_c FROM users_cstm WHERE user_lineage LIKE '%$user_manager%' OR id_c='$user_manager')";
            $response['team'] = executeCountQuery($team_count);

            $sql4 = "SELECT count(DISTINCT(id)) as totalCount FROM `calls` WHERE deleted != 1 AND date_entered >= now() - interval '$day' day ";
            
            $response['organisation'] = executeCountQuery($sql4);
            
            return $response;
            //echo json_encode(array("status"=>true, "data" => json_encode($response),"message" => "Successful"));

        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
        
    }

    // delegate functions 
    public function action_activity_delegated_dialog_info(){
        try {
            $db = \DBManagerFactory::getInstance();
            global $current_user;
            $log_in_user_id = $current_user->id;
            $GLOBALS['db'];

            $delegated_user_id = $this->get_activity_delegated_user($log_in_user_id);
            
            if ($delegated_user_id) {
                $delegated_user = $this->get_user_details_by_id($delegated_user_id);
            }
            
            if (!empty(@$delegated_user) && (@$delegated_user['first_name'] || @$delegated_user['last_name'])) {
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
                $data .= '
                    <tbody>
                    <tr>
                    <td class="delegatetable-data-popup">'.$delegated_user_name.'</td>
                    <td class="delegatetable-data-popup" style="color: #00f;">'.$this->activity_delegateActionCompleted($delegated_user_id).'</td>
                    <td class="delegatetable-data-popup">Edit</td>
                    <td>
                        <button type="button" style="margin-left: 100px; margin-bottom: 10px; margin-top: 20px;" class="btn2 remove-activity-delegate">Remove</button>
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
    //------------------For storing the Result of Delegate in Activity----------------//
    public function action_activity_store_delegate_result(){
        try{
            $db = \DBManagerFactory::getInstance();
            global $current_user;
            $log_in_user_id = $current_user->id;
            $GLOBALS['db'];
            $proxy = $_POST['Select_Proxy'];

            $save_delegate_query = "UPDATE calls_cstm as c2 
                LEFT JOIN calls ON calls.id = c2.id_c
                SET c2.delegate_id = '$proxy' , delegated_date = now()
                WHERE calls.deleted != 1 AND c2.user_id_c = '$log_in_user_id'";
            
            $save_delegate_query_result = $GLOBALS['db']->query($save_delegate_query);

            $approvalDelegateUpdate = "UPDATE activity_approval_table SET delegate_id = '$proxy' WHERE approver = '$log_in_user_id' AND approval_status = 1";
            $approvalDelegateUpdateQuery = $GLOBALS['db']->query($approvalDelegateUpdate);

            //$fetch_organization_count = $GLOBALS['db']->fetchByAssoc($save_delegate_query_result);
            //Notification
            
            $description = "You have been delegated to approve & reject activities by ".'"'.getUserName($log_in_user_id).'".';
            $description_email = "You have been delegated to approve & reject activities by ".'"'.getUserName($log_in_user_id).'".'."<br><br>Click here to view: www.ampersandcrm.com";
            send_notification('Activity','Delegate',$description,[$proxy],'');
    
            $reciever_email = getUserEmail($proxy);
            send_email($description_email,[$reciever_email],'CRM ALERT - Delegation');
            echo json_encode(array("status"=>true, "message"=>"Data Succesfully updated", "proxy"=> $proxy,"proxy_name"=>getUserName($proxy)));
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }

        die();
    }

    //-----------------------For Activity Remove Button-----------------------//
    public function action_activity_remove_delegate_user(){
        try{
            $db = \DBManagerFactory::getInstance();
            global $current_user;
            $log_in_user_id = $current_user->id;
            $GLOBALS['db'];
            $save_delegate_query = "UPDATE calls_cstm as c2 
                LEFT JOIN calls ON calls.id = c2.id_c
                SET c2.delegate_id = '', delegated_date = NULL
                WHERE calls.deleted != 1 AND c2.user_id_c = '$log_in_user_id' ";
            
            $save_delegate_query_result = $GLOBALS['db']->query($save_delegate_query);

            $save_delegate_query = "UPDATE activity_approval_table  
                SET delegate_id = ''
                WHERE approver = '$log_in_user_id'";
            
            $save_delegate_query_result = $GLOBALS['db']->query($save_delegate_query);

        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
    }
    function activity_delegateActionCompleted($userID){
        global $current_user;
        $log_in_user_id = $current_user->id;
        $query = "SELECT count(*) as count FROM activity_approval_table aap";
        $query .= " JOIN calls c ON c.id = aap.acc_id";
        $query .= " WHERE approval_status = '1' AND c.deleted != 1 AND aap.approver = '$log_in_user_id' AND aap.delegate_id = '$userID' ";

        $result = $GLOBALS['db']->query($query);
        $count = $GLOBALS['db']->fetchByAssoc($result);
        return $count['count'];
    }

    public function get_activity_delegated_user($log_in_user_id) {
        $fetch_query = "SELECT Count(*) as count, calls.assigned_user_id, calls_cstm.delegate_id as delegate FROM calls
        LEFT JOIN calls_cstm ON calls.id = calls_cstm.id_c WHERE deleted != 1  AND calls_cstm.user_id_c = '$log_in_user_id' GROUP BY calls_cstm.delegate_id ORDER BY count DESC";
        $fetch_delegated_user = $GLOBALS['db']->query($fetch_query);
        $fetch_delegated_user_result = $GLOBALS['db']->fetchByAssoc($fetch_delegated_user);
        
        if(!empty($fetch_delegated_user_result))
            $delegated_user = $fetch_delegated_user_result['delegate'];
        else
            $delegated_user = 0;
        return $delegated_user;
    }

    //------------------For Activity Reminder-----------------------//
    public function action_set_activity_reminder(){
        try{
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            global $current_user;
            $time = $_POST['time'];
            $frequency = $_POST['frequency'];
            $activity_id = $_POST['activityId'];


            $log_in_user_id = $current_user->id;

            $fetch_query = "SELECT parent_id, parent_type from calls where id='$activity_id'";
            $result = $GLOBALS['db']->query($fetch_query);
            // echo json_encode(array("result "=>$result , "activity_is"=>$activity_id));

            $data = $result->fetch_assoc();
            $related_id = $data['parent_id'];
            $related_type = $data['parent_type'];

            $fetch_query = "SELECT frequency, time from activity_reminder where created_by = '$log_in_user_id' AND activity_id='$activity_id'";
            $result = $GLOBALS['db']->query($fetch_query);

            if($result){
                if ($result->num_rows > 0 ){
                    $query = "UPDATE activity_reminder SET  frequency='$frequency' , time='$time' WHERE created_by='$log_in_user_id' AND activity_id='$activity_id'";
                    $save_reminder_query = $GLOBALS['db']->query($query);
                    echo json_encode(array('message'=>"Value Updated.", "status"=>true));
                }
                else {
                    $query = "INSERT INTO activity_reminder(related_id, related_type,activity_id, frequency, time, created_by, created_at) 
                    VALUES ( '$related_id','$related_type','$activity_id','$frequency','$time','$log_in_user_id',now())";
                    $save_reminder_query = $GLOBALS['db']->query($query);
                    echo json_encode(array('message'=>"Value Instered.", "status"=>true));   
                }
            }


        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();

    }
    

    function isActivityDelegate($userID, $id){
        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];

        $delegateQuery = "SELECT count(*) as count FROM activity_approval_table WHERE delegate_id = '$userID' AND id = '$id'";
        $count = $GLOBALS['db']->query($delegateQuery);
        $count = $GLOBALS['db']->fetchByAssoc($count);
        return $count['count'];
    }

    function isDocumentDelegate($userID, $id){
        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];

        $delegateQuery = "SELECT count(*) as count FROM document_approval_table WHERE delegate_id = '$userID' AND id = '$id'";
        $count = $GLOBALS['db']->query($delegateQuery);
        $count = $GLOBALS['db']->fetchByAssoc($count);
        return $count['count'];
    }

    function getActivityDelegateDetails(){
        global $current_user;
        $log_in_user_id = $current_user->id;

        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        $query = "SELECT u.first_name, u.last_name, cs.user_id_c FROM calls c JOIN calls_cstm cs ON cs.id_c = c.id JOIN users u ON u.id = cs.user_id_c WHERE c.deleted != 1 AND c.date_entered >= now() - interval '1200' day AND cs.delegate_id = '$log_in_user_id' GROUP BY cs.user_id_c ";
        $result = $GLOBALS['db']->query($query);
        $delegateData = array();
        while($row = $GLOBALS['db']->fetchByAssoc($result)){
            $dData = array(
                'name' => $row['first_name'].' '.$row['last_name'],
                'count' => $this->getActivityDelegateCount($row['user_id_c'])
            );
            array_push($delegateData, $dData);
        }
        $output = '';
        foreach($delegateData as $d){
            $output .= $d['name'].' - '.$d['count'].'<br>';
        }
        return $output;
    }
    function getActivityDelegateCount($userID){
        global $current_user;
        $log_in_user_id = $current_user->id;
        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        $query = "SELECT count(*) as count FROM activity_approval_table ap";
        $query .= " JOIN calls c ON c.id = ap.acc_id";
        $query .= " WHERE ap.approval_status = '0' AND c.deleted != 1 AND c.date_entered >= now() - interval '1200' day AND ap.approver = '$userID' AND ap.delegate_id = '$log_in_user_id' ";
        $result = $GLOBALS['db']->query($query);
        $count = $GLOBALS['db']->fetchByAssoc($result);
        return $count['count'];
    }

    //----------------------For activity Tag---------------------//
    // public function action_set_activity_for_tag(){
    //     try {
    //         $db = \DBManagerFactory::getInstance();
    //         $GLOBALS['db'];
    //         // $activity_id = $_POST['activity_id'];
    //         $activity_id = $_POST['activity_tag_id'];
    //         $user_id_list = '';
            
       
    //         // if ($_POST['userIdList']) {
    //         //     $user_id_list = $_POST['userIdList'];
    //         // }
    //         if ($_POST['tag_activity']) {
    //             $user_id_list = $_POST['tag_activity'];
    //             $user_id_list = implode(',',$user_id_list);
    //         }


    //         $sql ="SELECT calls.name, calls.created_by, calls_cstm.tag_hidden_c
    //         FROM calls 
    //         LEFT JOIN calls_cstm ON calls.id = calls_cstm.id_c
    //         WHERE id ='$activity_id' ";
    //         $fetch_activity_info_result = $GLOBALS['db']->query($sql);
    //         $row = $GLOBALS['db']->fetchByAssoc($fetch_activity_info_result);

            
    //         $last_users_array = explode(',', $row['tag_hidden_c']);
    //         $latest_users_array = $_POST['tag_activity'];
    //         $untagged_user_ids = $tagged_user_ids = $untagged_names_arr = $tagged_names_arr = [];

    //         $untagged_user_ids = array_diff($last_users_array, $latest_users_array);
    //         $tagged_user_ids = array_diff($latest_users_array, $last_users_array);
            
    //         echo "tagged_check";
    //         echo $tagged_user_ids;
    //         echo "kalpaj";
            
    //         if($untagged_user_ids != [""]) {
    //             foreach($untagged_user_ids as $id) {
    //                 array_push($untagged_names_arr, getUsername($id));
    //             }    
    //         }
    //         foreach($tagged_user_ids as $id) {
    //             array_push($tagged_names_arr, getUsername($id));
    //         }     

    //         $tagged_users_string = implode(',',$tagged_names_arr);
    //         $untagged_users_string = implode(',',$untagged_names_arr);

    //         $activity_link = "index.php?action=DetailView&module=Calls&record=".$activity_id;
    //         $notification_message = 'You have been tagged for activity "'.$row['name'].'". Now you can edit /make changes.';
    //         send_notification("Activity", $row['name'], $notification_message, $tagged_user_ids, $activity_link);
            
    //         echo json_encode(array("Tagged user" => $tagged_user_ids , "tagged user string"=> $tagged_users_string));
    //         $receiver_emails = []; 
    //         foreach($tagged_user_ids as $user_id) {
    //             array_push($receiver_emails, getUserEmail($user_id));
    //         }
    //         echo json_encode(array("tagged user reciever mail "=> $receiver_email));
    //         // die();
    //         // send_email($notification_message, $receiver_emails, 'You have been tagged');

    //         if(count($receiver_emails) > 0) {
    //             $notification_message = $notification_message."<br><br>Click here to view: www.ampersandcrm.com";
    //             send_email($notification_message, $receiver_emails, 'CRM ALERT - Tagged');
    //         }

    //         $untagged_receiver_emails = [];
    //         if($untagged_user_ids != [""]) {
    //             foreach($untagged_user_ids as $user_id) {
    //                 array_push($untagged_receiver_emails, getUserEmail($user_id));
    //             }
    //         }
    //         echo json_encode(array("Untagged user reciever mail "=> $untagged_receiver_emails));
    //         // die();
            
    //         if(count($untagged_receiver_emails) > 0) {
    //             $untagged_notification_message = 'You have been untagged from activity "'.$row['name'].'".';
    //             send_email($untagged_notification_message, $untagged_receiver_emails, 'CRM ALERT - Untagged');
    //         }




    //         $count_query = "SELECT * FROM calls_cstm WHERE id_c='$activity_id'";
    //         $result = $GLOBALS['db']->query($count_query);

    //         $sub_query = "UPDATE calls_cstm SET tag_hidden_c = '$user_id_list' WHERE id_c='$activity_id'";
    //         $GLOBALS['db']->query($sub_query);

    //         echo json_encode(array("status"=> true, "message" => "Value Updated", "tagged_users" => $tagged_users_string, "untagged_users" => $untagged_users_string, "act_name"=>$row['name']));
    //     } catch (Exception $e) {
    //         echo json_encode(array("status" => false, "message" => "Some error occured", "name"=>""));
    //     }
    //     die();

    // }
    
    public function action_set_activity_for_tag(){
        try {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            // $activity_id = $_POST['activity_id'];
            $activity_id = $_POST['activity_tag_id'];
            $user_id_list = '';
            // if ($_POST['userIdList']) {
            //     $user_id_list = $_POST['userIdList'];
            // }
            if ($_POST['tag_activity']) {
                $user_id_list = $_POST['tag_activity'];
                $user_id_list = implode(',',$user_id_list);
            }

            $sql ="SELECT calls.name, calls.created_by, calls_cstm.tag_hidden_c
            FROM calls 
            LEFT JOIN calls_cstm ON calls.id = calls_cstm.id_c
            WHERE id ='$activity_id' ";
            $fetch_activity_info_result = $GLOBALS['db']->query($sql);
            $row = $GLOBALS['db']->fetchByAssoc($fetch_activity_info_result);

            
            $last_users_array = explode(',', $row['tag_hidden_c']);
            if ($_POST['tag_activity']){
                $latest_users_array = $_POST['tag_activity'];
            }else {
                $latest_users_array =[];
            }
            
            
            $untagged_user_ids = $tagged_user_ids = $untagged_names_arr = $tagged_names_arr = [];

            $untagged_user_ids = array_diff($last_users_array, $latest_users_array);
            $tagged_user_ids = array_diff($latest_users_array, $last_users_array);

            if($untagged_user_ids != [""]) {
                foreach($untagged_user_ids as $id) {
                    array_push($untagged_names_arr, getUsername($id));
                } 
            }    
                
            foreach($tagged_user_ids as $id) {
                array_push($tagged_names_arr, getUsername($id));
            }     

            $tagged_users_string = implode(', ',$tagged_names_arr);
            $untagged_users_string = implode(', ',$untagged_names_arr);

            $activity_link = "index.php?action=DetailView&module=Calls&record=".$activity_id;
            $notification_message = 'You have been tagged for activity "'.$row['name'].'". Now you can edit /make changes.';
            send_notification("Activity", $row['name'], $notification_message, $tagged_user_ids, $activity_link);

            $receiver_emails = []; 
            foreach($tagged_user_ids as $user_id) {
                array_push($receiver_emails, getUserEmail($user_id));
            }
            // send_email($notification_message, $receiver_emails, 'You have been tagged');

            if(count($receiver_emails) > 0) {
                $notification_message = $notification_message."<br><br>Click here to view: www.ampersandcrm.com";
                send_email($notification_message, $receiver_emails, 'CRM ALERT - Tagged');
            }

            $untagged_receiver_emails = [];

            // echo json_encode(array("status" => true, "untagged" => $untagged_user_ids, "tagged" => $receiver_emails));
            // die();

            if($untagged_user_ids != [""]) {
                foreach($untagged_user_ids as $user_id) {
                    array_push($untagged_receiver_emails, getUserEmail($user_id));
                }
            }

            if(count($untagged_receiver_emails) > 0) {
                $untagged_notification_message = 'You have been untagged from activity "'.$row['name'].'".';
                
                // echo json_encode(array("status" => true, "untagged" => $untagged_receiver_emails, "tagged" => $receiver_emails));
                // die();
                send_email($untagged_notification_message, $untagged_receiver_emails, 'CRM ALERT - Untagged');
            }



            $count_query = "SELECT * FROM calls_cstm WHERE id_c='$activity_id'";
            $result = $GLOBALS['db']->query($count_query);

            $sub_query = "UPDATE calls_cstm SET tag_hidden_c = '$user_id_list' WHERE id_c='$activity_id'";
            $GLOBALS['db']->query($sub_query);

            echo json_encode(array("status"=> true, "message" => "Value Updated", "tagged_users" => $tagged_users_string, "untagged_users" => $untagged_users_string, "act_name"=>$row['name']));
        } catch (Exception $e) {
            echo json_encode(array("status" => false, "message" => "Some error occured", "name"=>""));
        }
        die();

    }
    
    
    
    public function action_activity_tag_dialog_info()
    {
        try {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            $activity_id = $_GET['id'];
            $fetch_activity_info = "SELECT * FROM calls
                LEFT JOIN calls_cstm ON calls.id = calls_cstm.id_c WHERE id = '$activity_id'";
            $fetch_activity_info_result = $GLOBALS['db']->query($fetch_activity_info);
            $row = $GLOBALS['db']->fetchByAssoc($fetch_activity_info_result);
            $assigned_user_id = $row['assigned_user_id'];
            $user_full_name = getUsername($assigned_user_id);
            $sub_head = 'Selected members will be able to view details or take action';
            $change_font = "Select Member";


            $data = '
                <h2 class="deselectheading">' . $row['name'] . '</h2><br>
                <p class="deselectsubhead">'.$sub_head.'</p>
                <hr class="deselectsolid">
                <section class="deselectsection">
                <table align="centered" width="100%">
                    <thead>
                    <tr class="tabname">
                        <th>Last Update</th>
                        <th>Activity Type</th>
                        <th>Subject</th>
                        <th>Assigned to</th>
                        <th>End Date</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr class="tabvalue">
                        <td>' . date_format(date_create($row['date_modified']), 'd/m/Y') . '</td>
                        <td>' . ucfirst($row['type_of_interaction_c']) . '</td>
                        <td>' . ucfirst($row['name']) . '</td>
                        <td>' . ucwords($user_full_name). '</td>
                        <td>'  . date_format(date_create($row['activity_date_c']), 'd/m/Y') . '</td>
                        </tr>';
            $data .= '</tbody></table>';
            $optionList = $this->tag_dialog_dropdown_info("activities", $activity_id);
          echo json_encode(array('activity_info'=>$data,'activity_id'=>$activity_id, 'optionList'=> $optionList));
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }

    public function get_assigned_user_activity($activity_id) {
        $fetch_activity_info = "SELECT * FROM calls
        LEFT JOIN calls_cstm ON calls.id = calls_cstm.id_c WHERE id = '$activity_id'";
        $fetch_activity_info_result = $GLOBALS['db']->query($fetch_activity_info);
        $result = $GLOBALS['db']->fetchByAssoc($fetch_activity_info_result);
    }
    
 public function action_activity_new_assigned_list(){
     try{
         $db = \DBManagerFactory::getInstance();
        	$GLOBALS['db'];
        	  
        	   global $current_user; 
        	   
            $activity_id = $_POST['acc_id'];
        	   $combined=array();
        	  $id_array1=array();
        	  $id_array=array();
        	  $name_array=array();
        	  $func_array=array();
        	 $func1_array=array();
              $h_array=array();
              $r_name=array();
              $number=array();
              $Approved_array=array();
              $Rejected_array=array();
              $pending_array=array();
              $func2_array=array();
              $h1_array=array();
              $rr_name=array();
              $n=1;
    	  $log_in_user_id = $current_user->id;
    	  
    	$query = "SELECT name,assigned_user_id FROM calls where id = '$activity_id'";
    	$result_query = $GLOBALS['db']->query($query);
    	while($row = $GLOBALS['db']->fetchByAssoc($result_query)) {
    	    $activity_name = $row['name'];
    	    $assigned_user_id = $row['assigned_user_id'];
    	}
    	$query_assigned = "SELECT CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) as assigned_name FROM users where id = '$assigned_user_id'";
    	$result_query_assigned = $GLOBALS['db']->query($query_assigned);
    	while($row = $GLOBALS['db']->fetchByAssoc($result_query_assigned)) {
    	    $assigned_user_name = $row['assigned_name'];
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
           
       
      $sql1 = "SELECT users_cstm.teamfunction_c,users_cstm.teamheirarchy_c, users1.id,CONCAT(IFNULL(users1.first_name,''), ' ', IFNULL(users1.last_name,'')) AS name,CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS r_name , rpt_cstm.teamfunction_c as r_r_tf, rpt_cstm.teamheirarchy_c as r_r_th FROM users INNER JOIN users as users1 ON users.id=users1.reports_to_id INNER JOIN users_cstm as rpt_cstm ON rpt_cstm.id_c= users1.reports_to_id INNER JOIN users_cstm ON users_cstm.id_c=users1.id  WHERE  users1.deleted=0 ORDER BY `name` ASC";
       
      // $sql1="SELECT users_cstm.teamfunction_c,users_cstm.teamheirarchy_c, users1.id,CONCAT(IFNULL(users1.first_name,''), ' ', IFNULL(users1.last_name,'')) AS name,CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS r_name FROM users INNER JOIN users as users1 ON users.id=users1.reports_to_id INNER JOIN users_cstm ON users_cstm.id_c=users1.id WHERE users1.id IN ('".implode("','",$id_array1)."') AND users1.deleted=0 ORDER BY `name` ASC";
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
     
      $mc_details=$mc_name.' / ';
      
      array_push($combined,$mc_details);
      
                    
      echo json_encode(array('1'=>$name_array,'2'=>$h_array,'3'=>$r_name,'a'=>$combined,'acc_name'=>$activity_name, 'present_assigned_user'=> $assigned_user_name,'id'=> $activity_id));
      
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
      
     
             echo json_encode(array('1'=>$name_array,'2'=>$h_array,'3'=>$r_name,'a'=>$combined,
             'acc_name'=>$activity_name, 'present_assigned_user'=> $assigned_user_name,'id'=> $activity_id));
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
   
 //---------------------------------Update Activity assigned id------------------------------------    

    public function action_activity_update_assigned(){
     try{
         $db = \DBManagerFactory::getInstance();
        	$GLOBALS['db'];
        	  
        	   global $current_user; 
        	    $log_in_user_id = $current_user->id;
        	    $assigned_name=$_POST['assigned_name'];  // fetch the name of assignee here
        	   $activity_id=$_POST['opp_id'];  // fetch the activity id to update the table
        	 //  $tagged_user_frontend=$_POST[''];// fetch tagged users id from frontend in comma separated string
        	   
             $activity_ex_assigne_query = "SELECT * FROM `calls` where id ='".$activity_id."'";
             $result_activity_ex_assigne = $GLOBALS['db']->query($activity_ex_assigne_query);
             $row_activity_ex_assigne = $GLOBALS['db']->fetchByAssoc($result_activity_ex_assigne);
        	  
             $ex_assigne_id = $row_activity_ex_assigne['assigned_user_id'];
        	   
        	//    $tagged_user_frontend_array=explode(',',$tagged_user_frontend);
        	   
        	   
        	   $tagged_users_array = array();
        	   
        	     $sql="SELECT * FROM users WHERE CONCAT(first_name, ' ', last_name) ='".$assigned_name."'";
        	    
        	     $result = $GLOBALS['db']->query($sql);
        	     
                while($row = $GLOBALS['db']->fetchByAssoc($result)) 
                {   
                    $assigned_id=$row['id'];
                    $approver_id=$row['reports_to_id'];
                }
$update_activty_querry="UPDATE `calls` SET `assigned_user_id`='".$assigned_id."' WHERE id='".$activity_id."'";//updating new assigned id
        
      if($db->query($update_activty_querry)==TRUE){
           
          $update_activty_cstm_querry="UPDATE `calls_cstm` SET user_id_c='".$approver_id."',assigned_to_c='".$assigned_name."' WHERE id_c= '".$activity_id."'";//updating new assignee approver id
           
            if($db->query($update_activty_cstm_querry)==TRUE){
                
                $sql_tagged_activity_users_database="SELECT `tag_hidden_c` FROM `calls_cstm` WHERE id_c = '".$activity_id."'"; //tagged users from database
                
                  $result_tagged_database = $GLOBALS['db']->query($sql_tagged_activity_users_database);
        	     
                 while($row_tagged_database = $GLOBALS['db']->fetchByAssoc($result_tagged_database)) 
                     {
                         $tagged_user_database=$row_tagged_database['tag_hidden_c'];
                      }
                      
                      $tagged_user_database_array=explode(',',$tagged_user_database);
                      
                    //  $tagged_users_array=array_merge($tagged_user_database_array,$tagged_user_frontend_array);
                 
                        $tagged_user_database_array=array_unique( $tagged_user_database_array);
                 
                 	if(in_array($approver_id, $tagged_user_database_array)){
	    
	    			   if (($key = array_search($approver_id, $tagged_user_database_array)) !== false) {
	    			       
                         unset( $tagged_user_database_array[$key]);
                        }
	    			}
	    			
	    				if(in_array($assigned_id, $tagged_user_database_array)){
	    
	    			   if (($key = array_search($assigned_id, $tagged_user_database_array)) !== false) {
	    			       
                         unset( $tagged_user_database_array[$key]);
                        }
	    			}
	    			
	    	        $tagged_users_array=implode(',', $tagged_user_database_array);
	    	        
	    	         $update_activty_cstm_tagged_querry="UPDATE `calls_cstm` SET tag_hidden_c='".$tagged_users_array."' WHERE id_c= '".$activity_id."'"; //updating tag users  id
           
	    		     //   $db->query($update_activty_cstm_tagged_querry);
	    		        
	    		          if($db->query($update_activty_cstm_tagged_querry)==TRUE){
	    		              
                           $activity_name_query = "SELECT * FROM `calls` where id ='".$activity_id."'";
                           $result_activity_name = $GLOBALS['db']->query($activity_name_query);
                           $row_activity_name = $GLOBALS['db']->fetchByAssoc($result_activity_name);

                           $link = "index.php?module=Calls&action=DetailView&record=".$row_activity_name['id'];
                           
                           $description ="Activity ".'"'. $row_activity_name['name'] .'"'." was re-assigned to ".'"'.getUserName($assigned_id).'"'." by ".'"'.getUserName($log_in_user_id).'".';
                            
                           $description_notification = "You have been assigned to activity ".'"'.$row_activity_name['name'].'"'." by ".'"'.getUserName($log_in_user_id).'"'.". Now you can edit /make changes.";  
                            $description_for_ex_assigned_user = getUserName($assigned_id)." has been assigned to activity ".'"'.$row_activity_name['name'].'"'." by ".'"'.getUserName($log_in_user_id).'".';
                            $description_for_assigned_user_email = "You have been assigned to activity ".'"'.$row_activity_name['name'].'"'." by ".'"'.getUserName($log_in_user_id).'"'.". Now you can edit /make changes.<br><br> Click here to view: www.ampersandcrm.com";
                            send_email($description_for_ex_assigned_user,[getUserEmail($ex_assigne_id)],"CRM ALERT - Reassignment");

                            send_notification('Activity','Re-assign User',$description_notification,[$assigned_id],$link);
                            send_email($description_for_assigned_user_email,[getUserEmail($assigned_id)],"CRM ALERT - Reassignment"); 
                            
                            echo json_encode(array('message'=>true,"description"=>$description));
	    		             
	    		          }
                 
                
            }
           
      }
        
     }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}


 //---------------------------------Update Activity assigned id---END---------------------------------   
 //----------------Activity Assigned history-------------------------------
   public function action_activity_assigned_history(){
        try{
            $db = \DBManagerFactory::getInstance();
                $GLOBALS['db'];
                
                global $current_user; 
                    $log_in_user_id = $current_user->id;
                    $assigned_name=$_POST['assigned_name'];
                    $activity_id=$_POST['opp_id'];
                    
              
                    $sql="SELECT id,reports_to_id  FROM users WHERE CONCAT(first_name, ' ', last_name) ='".$assigned_name."' ";
                    
                    $result = $GLOBALS['db']->query($sql);
                    
            while($row = $GLOBALS['db']->fetchByAssoc($result)) 
            {
                
                
            $assigned_id=$row['id'];
            
            $reports_to_id = $row['reports_to_id'];
        
                
            }
            
        
            
            
            $assigned_to_new= $assigned_id;
            $approvers_new = $reports_to_id;
            
            
            $sql41='SELECT calls_cstm.status_new_c,calls_cstm.activity_type_c,calls.assigned_user_id  FROM calls_cstm INNER JOIN calls ON calls.id=calls_cstm.id_c WHERE calls_cstm.id_c="'.$activity_id.'"';	    
            $result41 = $GLOBALS['db']->query($sql41);
            while($row41 = $GLOBALS['db']->fetchByAssoc($result41)) 
            { 
               $activity_status=$row41['status_new_c'];
               $activity_type=$row41['activity_type_c'];
               $assigned_id=$row41['assigned_user_id'];
           
            }
           
        
            $sql51 ='SELECT id, acc_id, assigned_by, assigned_to_id FROM activity_assign_flow  WHERE acc_id="'.$activity_id.'" AND assigned_to_id="'.$assigned_id.'" AND id=(SELECT MAX(id) FROM activity_assign_flow WHERE acc_id="'.$activity_id.'")';
                $result51 = $GLOBALS['db']->query($sql51);
                
                $count=$result51->num_rows;
              // echo $count;
                if($count>0){
                    
                }
                else{ 
                    
                    $sql25='INSERT INTO `activity_assign_flow`(`acc_id`, `assigned_by`, `assigned_to_id`, `approver_ids`,`status`,acc_type) VALUES ("'.$activity_id.'","'.$log_in_user_id.'","'.$assigned_to_new.'","'.$approvers_new.'","'.$activity_status.'","'.$activity_type.'")';
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
//----------------Activity Assigned history-------------END------------------
    
//-----------------------activity delegate------------------------------

// public function action_activity_store_delegate_result(){
//         try{
//             $db = \DBManagerFactory::getInstance();
//             global $current_user;
//             $log_in_user_id = $current_user->id;
//             $GLOBALS['db'];
//             $proxy = $_POST['Select_Proxy'];
//             // $permission_to_edit = $_POST['delegate_Edit'];
//             $save_delegate_query = "UPDATE calls_cstm as o2 
//                 LEFT JOIN calls ON calls.id = o2.id_c
//                 SET o2.delegate_id = '$proxy',o2.delegated_date = CURRENT_DATE
//                 WHERE calls.deleted != 1 AND o2.user_id_c = '$log_in_user_id'";
            
//             $save_delegate_query_result = $GLOBALS['db']->query($save_delegate_query);

//             $approvalDelegateUpdate = "UPDATE activity_approval_table SET delegate_id = '$proxy' WHERE approver = '$log_in_user_id' AND approval_status = 0";
//             $approvalDelegateUpdateQuery = $GLOBALS['db']->query($approvalDelegateUpdate);

//             //$fetch_organization_count = $GLOBALS['db']->fetchByAssoc($save_delegate_query_result);
//         }catch(Exception $e){
//             echo json_encode(array("status"=>false, "message" => "Some error occured"));
//         }

//     }
    
//     public function action_remove_activity_delegate_user(){
//         try{
//             $db = \DBManagerFactory::getInstance();
//             global $current_user;
//             $log_in_user_id = $current_user->id;
//             $GLOBALS['db'];
//             $save_delegate_query = "UPDATE calls_cstm as o2 
//                 LEFT JOIN calls ON calls.id = o2.id_c
//                 SET o2.delegate_id = ''
//                 WHERE calls.deleted != 1 AND o2.user_id_c = '$log_in_user_id'";
            
//             $save_delegate_query_result = $GLOBALS['db']->query($save_delegate_query);

//             $save_delegate_query = "UPDATE activity_approval_table  
//                 SET delegate_id = ''
//                 WHERE approver = '$log_in_user_id'";
            
//             $save_delegate_query_result = $GLOBALS['db']->query($save_delegate_query);

//         }catch(Exception $e){
//             echo json_encode(array("status"=>false, "message" => "Some error occured"));
//         }
//     }

    /* Get Seqeunce Flow */
    public function action_getActivityStatusTimeline(){
        try{
            $accID = $_POST['accID']; 
            $data = '<span class="close-sequence-flow-activity">×</span><div class="wrap padding-tb black-color">';
  
            $query = "SELECT name,created_by,assigned_user_id,date_entered FROM calls WHERE id = '$accID'";
            $result = $GLOBALS['db']->query($query);
            $result = $GLOBALS['db']->fetchByAssoc($result);
            $created_by = $result['created_by'];
  
            $updatedDate = date('d/m/Y', strtotime($result['date_entered']));
  
            $data .= '<div class="d-block padding">
                    <h2 class="">'.$result['name'].'</h2>
                    <h3 class="gray-color">Approval/Rejection Audit Trail</h3>
                </div>
                <hr>';

            /* Approval Query */
            $approvalQuery = 
                "SELECT 
                    'approval' as type, '' as apply_for, ap.acc_id, u.first_name, u.last_name, ap.acc_id, ap.approval_status, ap.updated_at as date_time, UNIX_TIMESTAMP(ap.updated_at) as timestamp
                FROM 
                    activity_approval_table ap
                JOIN
                    users u ON u.id = ap.delegate_id OR u.id = approver
                WHERE 
                    ap.acc_id ='$accID'
                ORDER BY ap.updated_at ASC
            ";
            $result = $GLOBALS['db']->query($approvalQuery);
            $ApprovalData = $this->mysql_fetch_assoc_all($result);

            /* Call Audits */
            $auditQuery = 
                "SELECT 
                    'audit' as type, u.first_name, ca.parent_id as acc_id, u.last_name, ca.field_name, ca.before_value_string, ca.after_value_string as apply_for, ca.date_created as date_time, UNIX_TIMESTAMP(ca.date_created) as timestamp
                FROM 
                    calls_audit ca
                JOIN 
                    calls c ON c.id = ca.parent_id
                JOIN
                    users u ON u.id = c.assigned_user_id
                WHERE 
                    ca.parent_id ='$accID' AND ca.field_name = 'status_new_c' AND ca.after_value_string != 'Completed'
                ORDER BY ca.date_created ASC
            ";
            $result = $GLOBALS['db']->query($auditQuery);
            $auditData = $this->mysql_fetch_assoc_all($result);

            $sequenceArray = array_merge($ApprovalData, $auditData);

            /* assign flow */
            $assignFlowQuery = 
                "SELECT 
                    'reassignment' as type, 'Reassignment' as apply_for, ra.acc_id, u.first_name, u.last_name, ra.assigned_by, ra.assigned_to_id, ra.date_time, UNIX_TIMESTAMP(ra.date_time) as timestamp
                FROM 
                    activity_assign_flow ra
                JOIN
                    users u ON u.id = ra.assigned_to_id
                WHERE 
                    ra.acc_id ='$accID' and (NOT (assigned_to_id ='$created_by' and assigned_by ='$created_by'))
                ORDER BY ra.date_time ASC
            ";
            $result = $GLOBALS['db']->query($assignFlowQuery);
            $assignFlowData = $this->mysql_fetch_assoc_all($result);

            $sequenceArray = array_merge($sequenceArray, $assignFlowData);
            
            $sortArray = usort($sequenceArray, function($a, $b) {
                return $a['timestamp'] <=> $b['timestamp'];
            });
            //print_r( $sequenceArray );
            //die;
  
            /*$query1 = "select u.first_name, u.last_name, ap.acc_id, ap.updated_at, ap.datetime, ap.apply_for,ap.assigned_by, ap.Approved, ap.Rejected, ap.pending, ap.assign from 
            ( (select acc_id , assigned_to_id, date_time as updated_at, 'Reassignment' as apply_for, assigned_by, 0 as Approved, 0 as Rejected, 0 as pending, 1 as assign from activity_assign_flow where acc_id ='$accID'
            and (NOT (assigned_to_id ='$created_by' and status='Lead' and assigned_by ='$created_by')))
            union (select acc_id , approver as assigned_to_id,updated_at as updated_at, '' as apply_for, '' as assigned_by,0 as Approved,0 as Rejected,0 as pending, 0 as assign from activity_approval_table where acc_id ='$accID') ) ap 
            JOIN users u ON u.id = ap.assigned_to_id order by updated_at DESC LIMIT 1";
            $result = $GLOBALS['db']->query($query1);
            $result = $GLOBALS['db']->fetchByAssoc($result);
  
            $data .= '<div class="approved">';
  
  
            $query = "
            select u.first_name, u.last_name, ac.acc_id, ac.date_time, ac.apply_for,ac.assigned_by, ac.pending, ac.Approved, ac.Rejected, ac.assign 
  
            from 
  
            ((select acc_id , assigned_to_id, date_time, 'Reassignment' as apply_for, assigned_by,  0 as pending, 0 as Approved, 0 as Rejected, 1 as assign
            from activity_assign_flow 
            where acc_id ='$accID' and (NOT (assigned_to_id ='$created_by' and status='Lead' and assigned_by ='$created_by')))
  
            union
  
            (select acc_id , approver as assigned_to_id,updated_at as date_time, '' as apply_for, '' as assigned_by, if(approval_status = 0,1,0) as pending, if(approval_status = 1,1,0) as approved, if(approval_status = 2,1,0) as rejected, 1 as assign
            from 
            activity_approval_table where acc_id ='$accID')) as ac
            JOIN 
            users u ON u.id = ac.assigned_to_id ";
            $recentUpdate = $query;
            $recentUpdate .= " order by date_time DESC LIMIT 1";
  
            $result = $GLOBALS['db']->query($recentUpdate);
            $result = $GLOBALS['db']->fetchByAssoc($result);
            if($result):
  
                $full_name = $result['first_name'].' '.$result['last_name'];
                $class = '';
  
                if($result['Approved'] == 1){
                    $class = 'status-badge-green-b';
                    $lineClass = 'green';
                }else if($result['Rejected'] == 1){
                    $class = 'status-badge-red-b';
                    $lineClass = 'red';
                } else if($result['pending'] == 1) {
                    $class = 'status-badge-yellow-b';
                    $result = 'yellow';
                } else if ($result['assign'] == 1) {
                    $class = 'status-badge-blue-b';
                    $lineClass = 'blue';
                    $assigned_by = $this->getUserName($result['assigned_by']);
                    $full_name = $assigned_by. ' <i class="fa fa-arrow-right"></i> ' . $full_name;
                }
                $dateExtracted = substr($result['date_time'],0,10);
                $updateDate = date('d/m/Y', strtotime($dateExtracted));
  
                $dateExtracted = substr($result['date_time'],0,10);
                $updateDate = date('d/m/Y', strtotime($dateExtracted));*/
            if(!empty($sequenceArray)):
                $recentUpdate = end( $sequenceArray );
                $full_name = $recentUpdate['first_name'].' '.$recentUpdate['last_name'];
                $class = '';
  
                if( $recentUpdate['type'] == 'approval' && $recentUpdate['approval_status'] == 1 ){
                    $class = 'status-badge-green-b';
                    $lineClass = 'green';
                }else if( $recentUpdate['type'] == 'approval' && $recentUpdate['approval_status'] == 2 ){
                    $class = 'status-badge-red-b';
                    $lineClass = 'red';
                } else if( $recentUpdate['type'] == 'approval' && $recentUpdate['approval_status'] == 0 ) {
                    $class = 'status-badge-yellow-b';
                    $result = 'yellow';
                } else if ($recentUpdate['type'] == 'reassignment') {
                    $class = 'status-badge-blue-b';
                    $lineClass = 'blue';
                    $assigned_by = $this->getUserName($recentUpdate['assigned_by']);
                    $full_name = $assigned_by. ' <i class="fa fa-arrow-right"></i> ' . $full_name;
                }else if ($recentUpdate['type'] == 'audit' && $recentUpdate['apply_for'] == 'Upcoming'){
                    $class = 'status-badge-orange-b';
                    $lineClass = 'orange';
                }else{
                    $class = 'status-badge-gray-b';
                    $lineClass = 'gray';
                }
                $dateExtracted = substr($recentUpdate['date_time'],0,10);
                $updateDate = date('d/m/Y', strtotime($dateExtracted));
  
                $dateExtracted = substr($recentUpdate['date_time'],0,10);
                $updateDate = date('d/m/Y', strtotime($dateExtracted));
                $data .= '<div class="row padding">
                        <div class="d-inline-block w-50 py-2">
                            <h4 class="">Recent Update</h4>
                            <!--<h5 class="'.$class.'">'.$this->getStatusCharActivity($recentUpdate['apply_for'],$recentUpdate['acc_id']).'</h5>-->
                            <h5>'.$recentUpdate['first_name'].' '.$recentUpdate['last_name'].'<span class="status-badge '.$class.'">'.$this->getStatusCharActivity($recentUpdate['apply_for'],$recentUpdate['acc_id']).'</span></h5> 
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
                            <h5><span class="status-badge-green-b">C</span>
                            <span class="line-bottom green"></span> 
                            <span style="font-size: 12px;margin:0">'.$full_name.'</span></h5> 
                        </div>
                        <div class="d-inline-block w-50 align-self-end text-right">
                            <h5 class="gray-color">'.$updatedDate.'</h5>
                        </div>
                    </div>';
            
            /*$query .= " order by date_time ASC ";
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
                $dateExtracted = substr($row['date_time'],0,10);
                $updateDate = date('d/m/Y', strtotime($dateExtracted));
  
                $data .= '<!-- single -->
                    <div class="row half-padding-tb">
                        <div class="d-inline-block" style="width:75%">
                            <!--<h5><span class="status-badge-green-b">'.$this->getStatusCharActivity($row['apply_for'],$row['acc_id']).'</span> 
                            <span class="line-bottom"></span> '.$this->getApproverNames($row['acc_id'], $row['apply_for'], 0).'</h5> -->
  
                            <h5><span class="'.$class.'">'.$this->getStatusCharActivity($row['apply_for'],$row['acc_id']).'</span> 
                            <span class="line-bottom '.$lineClass.'"></span> 
                            <span style="font-size: 12px;margin:0">'.$full_name.'</span></h5> 
                        </div>
                        <div class="d-inline-block align-self-end text-right" style="width:25%">
                            <h5 class="gray-color">'.$updateDate.'</h5>
                        </div>
                    </div>';
            }
            $data .= '</div>';*/

            foreach( $sequenceArray as $row ){
                $full_name = $row['first_name'].' '.$row['last_name'];
                $class = '';
                $lineClass = '';
                if( $row['type'] == 'approval' && $row['approval_status'] == 1 ){
                    
                    $class = 'status-badge-green-b';
                    $lineClass = 'green';

                }else if( $row['type'] == 'approval' && $row['approval_status'] == 2 ){
                    
                    $class = 'status-badge-red-b';
                    $lineClass = 'red';

                } else if($row['type'] == 'approval' && $row['approval_status'] == 0 ) {
                    
                    $class = 'status-badge-yellow-b';
                    $lineClass = 'yellow';

                } else if ($row['type'] == 'reassignment' && $row['type'] == 'reassignment' ) {
                    
                    $class = 'status-badge-blue-b';
                    $lineClass = 'blue';
                    $assigned_by = $this->getUserName($row['assigned_by']);
                    $full_name = $assigned_by. ' <i class="fa fa-arrow-right"></i> ' . $full_name;

                }else if ($row['type'] == 'audit' && $row['apply_for'] == 'Upcoming'){
                    
                    $class = 'status-badge-orange-b';
                    $lineClass = 'orange';

                }else{
                    
                    $class = 'status-badge-gray-b';
                    $lineClass = 'gray';

                }
                $dateExtracted = substr($row['date_time'],0,10);
                $updateDate = date('d/m/Y', strtotime($dateExtracted));
  
                $data .= '<!-- single -->
                    <div class="row half-padding-tb">
                        <div class="d-inline-block" style="width:75%">
                            <!--<h5><span class="status-badge-green-b">'.$this->getStatusCharActivity($row['apply_for'],$row['acc_id']).'</span> 
                            <span class="line-bottom"></span> '.$this->getApproverNames($row['acc_id'], $row['apply_for'], 0).'</h5> -->
  
                            <h5><span class="'.$class.'">'.$this->getStatusCharActivity($row['apply_for'],$row['acc_id']).'</span> 
                            <span class="line-bottom '.$lineClass.'"></span> 
                            <span style="font-size: 12px;margin:0">'.$full_name.'</span></h5> 
                        </div>
                        <div class="d-inline-block align-self-end text-right" style="width:25%">
                            <h5 class="gray-color">'.$updateDate.'</h5>
                        </div>
                    </div>';
            }
            $data .= '</div>';
  
            $data .= '</div>';
            echo json_encode(array('data' => $data, 'array' => $sequenceArray));
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }
    
    function checkRecentActivityForActivity($accID){
        $query = "SELECT u.first_name, u.last_name, ap.updated_at, ap.approval_status FROM activity_approval_table ap JOIN users u ON u.id = ap.approver WHERE ap.acc_id = '$accID' AND ap.approval_status > 0 ORDER BY ap.id DESC LIMIT 1";
        $recentActivity = $GLOBALS['db']->query($query);
        $count = mysqli_num_rows($recentActivity);
        return $count;
    }
    function getStatusCharActivity($status, $oppID = null){
        switch ($status){
            case 'Reassignment':
                $statusChar = 'R';
                break;
            case 'Upcoming':
                $statusChar = 'U';
                break;
            case 'Overdue':
                $statusChar = 'OD';
                break;    
            default:
                $statusChar = 'AC';
                break;
        }
        return $statusChar;
    }
    


    public function is_activity_reminder_applicable($activity_id){
        try{
            global $current_user;
            $log_in_user_id = $current_user->id;
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $sql ="SELECT * FROM calls  where assigned_user_id= '$log_in_user_id' AND id='$activity_id'";
            $result = $GLOBALS['db']->query($sql);
            if ($result){
                if ($result->num_rows > 0){
                    return True;
                }
                else {
                    return false;
                }
            }
        }catch (Exception $e) {
            echo json_encode(array("status" => false, "message" => "Some error occured"));
        }
        die();
    }


    
    
        /**
     * Document Functions////////////////////////////////////////////////////////////////////////////////
     * 
     * 
     * 
     * 
     *-----------------------------------------------------------------------------------------------------------

    */

    //---------------------For document Pending Table list--------------------/////

    function action_getPendingDocumentList(){
        try
        {
            $content = '';
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            global $current_user;
            $log_in_user_id = $current_user->id;

            ob_start();
            include_once 'templates/partials/pending-document-requests/main.php';
            $content = ob_get_contents();
            ob_end_clean();

            $fetch_query    = getDocumentQuery(); // getActivity Query
            $result         = $GLOBALS['db']->query($fetch_query);
            $response       = $this->mysql_fetch_assoc_all($result); //get all result in an array

            /* Pending Activity repeater HTML (Table ROW) */
            ob_start();
            include_once 'templates/partials/pending-document-requests/repeater.php';
            $content .= ob_get_contents();
            ob_end_clean();


            //Pagination 
            /*$page = $_GET['page'] ? $_GET['page'] : 1;
            if ($totalCount > ( $page * $limit)){
                $currentPost = ($page * $limit);
            } else {
                $currentPost = $totalCount;
            }
            $content .= '<div class="pagination text-right">';
            $content .= '<p class="d-inline-block">Showing '.$currentPost.' of '.$totalCount.'</p>';

            $type = array(
                'method' => 'pending',
                'status' => $status,
                'type'   => '',
            );
            
            $content .= $this->activitypagination($page, $numberOfPages, $type, '30', '', $_GET['filter']);
            $content .= '</div>';*/

            // echo $content;
            $columnFilterHtml   = $this->getDocumentColumnFilters('pendings');
            $filters            = $this->getDocumentFilterHtml('document', $_GET);

            echo json_encode(array(
                'data'                      => $content,
                'columnFilter'              => $columnFilterHtml,
                'filters'                   => $filters
            )); die;

        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }

    public function action_document_pending_count(){
        try {
            global $current_user;
            $log_in_user_id = $current_user->id;
    
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $PRC = 0;
            $DELE_COUNT = 0 ;

            $query = "SELECT id FROM documents WHERE deleted != 1 AND date_entered >= now() - interval '1200' day";
            $result = $GLOBALS['db']->query($query);
            $response = $this->mysql_fetch_assoc_all($result); //get all result in an array
            foreach($response as $r){
                $id = $r['id'];
                
                $query_count_for_delegate_button = "SELECT approval_status FROM document_approval_table WHERE doc_id = '$id' AND  approver = '$log_in_user_id' ORDER BY `id` DESC LIMIT 1";
                $result_self_delegate = $GLOBALS['db']->query($query_count_for_delegate_button);
                $count_delegate = $GLOBALS['db']->fetchByAssoc($result_self_delegate);
                if($count_delegate && $count_delegate['approval_status'] == '0')
                    $DELE_COUNT += 1;
                
                $query = "SELECT approval_status FROM document_approval_table WHERE doc_id = '$id' AND ( approver = '$log_in_user_id' OR delegate_id = '$log_in_user_id' ) ORDER BY `id` DESC LIMIT 1";
                $result = $GLOBALS['db']->query($query);
                $count = $GLOBALS['db']->fetchByAssoc($result);
                if($count && $count['approval_status'] == '0')
                    $PRC += 1;
            }

            echo json_encode(
                array(
                    'data' => "$PRC <i class=\"fa fa-angle-double-down\" aria-hidden=\"true\"></i>",
                    'count' => $PRC,
                    'delegate_count' => $DELE_COUNT,
                    'response'=>$response
                )
            );
        }
        catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }



    
    public function get_document_history(){
        try {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            $day = $_COOKIE['day'];

            global $current_user;
            $log_in_user_id = $current_user->id;

            $self_count = "SELECT count(*) as totalCount FROM documents  
                WHERE assigned_user_id = '$log_in_user_id' AND deleted != 1 AND date_entered >= now() - interval '".$day."' day";
            $response['self_count'] = executeCountQuery($self_count);

            $user_manager = get_user_manager();

            $team_count = "SELECT count(*) as totalCount from documents
                WHERE  deleted != 1 AND date_entered >= now() - interval '".$day."' day AND assigned_user_id 
                    IN (
                        SELECT id_c FROM users_cstm 
                        WHERE user_lineage LIKE '%$user_manager%' OR id_c='$user_manager'
                        )";
            $response['team'] = executeCountQuery($team_count);

            $sql4 = "SELECT count(DISTINCT(id)) as totalCount FROM documents WHERE deleted != 1 AND date_entered >= now() - interval '$day' day ";
            
            $response['organisation'] = executeCountQuery($sql4);
            
            return $response;
            //echo json_encode(array("status"=>true, "data" => json_encode($response),"message" => "Successful"));

        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
        
    }


    function getDocumentColumnFilters($type = null){
        /* Default Columns */
        if($type){
            $columnFilterHtml = '<form class="document-pending-settings-form sort-column">';
            $columnFilterHtml .= '<input type="hidden" name="document-settings-section" class="document-pending-settings-section" value="" />
            <input type="hidden" name="document-settings-type" class="document-pending-settings-type" value="" />
            <input type="hidden" name="document-settings-type-value" class="document-pending-settings-type-value" value="" />';
        }else{
            $columnFilterHtml = '<form class="document-settings-form sort-column">';
            $columnFilterHtml .= '<input type="hidden" name="document-settings-section" class="document-settings-section" value="" />
            <input type="hidden" name="document-settings-type" class="document-settings-type" value="" />
            <input type="hidden" name="document-settings-type-value" class="document-settings-type-value" value="" />';
        }
        $columnFields = $this->DocumentColumns();
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
                    <input class="settingInputs" type="checkbox" id="name-select" name="customDocumentColumns[]" value="'.$key.'" checked="True" style="display: none">
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
                    <input class="settingInputs" type="checkbox" id="name-select" name="customDocumentColumns[]" value="'.$key.'" checked="True" style="display: none">
                    <label style="color: #837E7C; font-family: Arial; font-size: 13px;" for="name"> '.$field.'</label>
                </li>';
        }
        $columnFilterHtml .= '</ul>';

        return $columnFilterHtml;
    }

    //Feteching the all data for Documents modules on click
    public function action_getDocument(){
        try
        {
            $GLOBALS['db'];
            global $current_user;
            $db      = \DBManagerFactory::getInstance();
            
            $content = '';
            $log_in_user_id = $current_user->id;
            
            $day        = $_GET['days'];
            $searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';
          
            $user_for_delegates             = '';
            $self_count                     = 0;
            $team_count                     = 0;
            $lead_data                      = "";
            $global_organization_count      = 0;
            $non_global_organization_count  = 0;
            $fetch_by_status_c              = '';

            $user_team                      = userTeam($log_in_user_id);
            
            $counts = $this->get_document_history();
            if( !empty($counts) ){
                $self_count = $counts['self_count'];
                $team_count = $counts['team'];
                $total      = $counts['organisation'];
            }

            $fetch_by_status    = "";
            $result             = array();

            $check_mc = $this->is_mc($log_in_user_id);

            /* Document main HTML */
            ob_start();
            include_once 'templates/partials/document/main.php';
            $content = ob_get_contents();
            ob_end_clean();

            $fetch_query = getDocumentQuery(); // getDocument Query.
            // TODO : Need to change the functions and helper function ... check crm .txt file.
            
            //Pagination Query
            $limit = 5;
            $paginationQuery = $GLOBALS['db']->query($fetch_query);
            $totalCount = mysqli_num_rows($paginationQuery);
            $numberOfPages = ceil( $totalCount / $limit );
            
            $offset = $_GET['page'] ? ($_GET['page'] - 1)  * $limit : 0;

            $fetch_query .= " LIMIT $offset, $limit";

            $result = $GLOBALS['db']->query($fetch_query);
            $response = $this->mysql_fetch_assoc_all($result); //get all result in an array

            // /* Opportunities repeater HTML (Table ROW) */
            ob_start();
            include_once 'includes/helpers.php';
            include_once 'templates/partials/document/repeater.php';
            $content .= ob_get_contents();
            ob_end_clean();

            $delegated_user_name = '';
            $delegated_user_id = $this->get_document_delegated_user($log_in_user_id);
            if ($delegated_user_id != null) {
                $delegated_user = $this->get_user_details_by_id($delegated_user_id);
                $delegated_user_name = $delegated_user['first_name'] . $delegated_user['last_name'];
            }

            // /* Pagination HTML */
            $page = $_GET['page'] ? $_GET['page'] : 1;
            if ($totalCount > ( $page * $limit)){
                $currentPost = ($page * $limit);
            } else {
                $currentPost = $totalCount;
            }
            $content .= '<div class="pagination text-right">';
            $content .= '<p class="d-inline-block">Showing '.$currentPost.' of '.$totalCount.'</p>';

            $type = array(
                'method' => 'document',
                'status' => '',
                'type' => ''
            );

            $content .= $this->documentpagination($page, $numberOfPages, $type, $day, $searchTerm, $_GET['filter']);
            $content .= '</div>';
            // /* End Pagination HTML */
            $columnFilterHtml   = $this->getDocumentColumnFilters();
            $filters            = $this->getDocumentFilterHtml('document', $_GET);

            echo json_encode(array(
                'data'                      => $content,
                'total'                     => $total,
                'self_count'                => $self_count,
                'team_count'                => $team_count,
                'delegate'                  => $this->checkDelegate(),
                'delegateDetails'           => $this->getDocumentDelegateDetails(),
                'global_organization_count' => $global_organization_count,
                'non_global_organization'   =>  $non_global_organization_count,
                'fetched_by_status'         =>  $fetch_by_status,
                'columnFilter'              => $columnFilterHtml,
                'filters'                   => $filters
            ));


            die;
        }
        catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }

    function getDocumentDelegateDetails(){
        global $current_user;
        $log_in_user_id = $current_user->id;

        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        $query = "SELECT u.first_name, u.last_name, ds.user_id_c FROM documents d JOIN documents_cstm ds ON ds.id_c = d.id JOIN users u ON u.id = ds.user_id_c WHERE d.deleted != 1 AND d.date_entered >= now() - interval '1200' day AND ds.delegate_id = '$log_in_user_id' GROUP BY ds.user_id_c ";
        $result = $GLOBALS['db']->query($query);
        $delegateData = array();
        while($row = $GLOBALS['db']->fetchByAssoc($result)){
            $dData = array(
                'name' => $row['first_name'].' '.$row['last_name'],
                'count' => $this->getDocumentDelegateCount($row['user_id_c'])
            );
            array_push($delegateData, $dData);
        }
        $output = '';
        foreach($delegateData as $d){
            $output .= $d['name'].' - '.$d['count'].'<br>';
        }
        return $output;
    }

    function getDocumentDelegateCount($userID){
        global $current_user;
        $log_in_user_id = $current_user->id;
        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        $query = "SELECT count(*) as count FROM document_approval_table dp";
        $query .= " JOIN documents d ON d.id = dp.doc_id";
        $query .= " WHERE dp.approval_status = '0' AND d.deleted != 1 AND d.date_entered >= now() - interval '1200' day AND dp.approver = '$userID' AND dp.delegate_id = '$log_in_user_id' ";
        $result = $GLOBALS['db']->query($query);
        $count = $GLOBALS['db']->fetchByAssoc($result);
        return $count['count'];
    }
    

    
    function getDocumentFilterHtml($type, $columnFilter){

        $query = getQuery('DISTINCT(template_type)', 'documents');
        $interactions = $this->mysql_fetch_assoc_all($query);
        $html = '';
        /* default fields */
        $html = '<div class="form-group">
            <span class="primary-responsibilty-filter-head">Document Name</span>
            <input type="text" class="form-control filter-name" name="filter-name" />
            </div>';

        // $html = '<div class="form-group">
        //         <span class="primary-responsibilty-filter-head">Document Type</span>
        //         <select class="" name="filter-document_type">
        //             <option value="">Select Type</option>';
        
        // foreach($interactions as $i){
        //     if( ! is_null( $i['template_type'])&& $i['template_type']!== ''){

        //        $html .= '<option value="'.$i['template_type'].'">'.beautify_label($i['template_type']).'</option>';
        //     }
        // }   
        // $html .= '</select></div>';

        $columns = $this->DocumentColumns();
        foreach($columns['default'] as $key => $c){
            if(isset($columnFilter[$key])){
                $html .= $this->DocumentfilterFields($type, $columnFilter[$key]);
            }
        }

        foreach($columns['addons'] as $key => $c){
            if(isset($columnFilter[$key])){
                $html .= $this->DocumentfilterFields($type, $columnFilter[$key]);
            }
        }
        
        return $html;
    }

    function get_all_option($column){
        global $current_user;
        $log_in_user_id = $current_user->id;
        $parent_type = '';
        $fetch_query = 'SELECT DISTINCT('.$column.') as category FROM documents LEFT JOIN documents_cstm ON documents.id = documents_cstm.id_c WHERE deleted != 1';
        $result = $GLOBALS['db']->query($fetch_query);
        $data = '<option value="">Select Type</option>';
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if( ! is_null( $row['category'])&& $row['category']!== ''){
                    if( strtolower($row['category']) == 'calls'){
                    $parent_type = 'Activity';
                    }
                    elseif( strtolower($row['category']) == 'accounts'){
                        $parent_type = 'Department';
                    }
                    else{
                        $parent_type = $row['category'];
                    }
                    $data .= '<option value="'.$row['category'].'">'.beautify_label($parent_type).'</option>';
                }
            }
        }
        return $data;
    }


    //-------------------For Filtering Document Tables-------------------------//
    function DocumentfilterFields($type, $columnFilter){
        $data = '';
        switch($columnFilter){
            case 'related_to':
                $option = $this->get_all_option('parent_type');
                $data = '<div class="form-group">
                    <span class="primary-responsibilty-filter-head">Related to</span>
                    <select class="" name="filter-related_to" id="">
                        '.$option.'
                    </select>
                    </div>';
                break;

            case 'document_type':
                $option = $this->get_all_option('template_type');
                $data = '<div class="form-group">
                    <span class="primary-responsibilty-filter-head">Document Type</span>
                    <select class="" name="filter-document_type" id="">
                        '.$option.'
                    </select>
                    </div>';
                break;
            
            case 'category':
                $option = $this->get_all_option('category_c');
                $data = '<div class="form-group">
                    <span class="primary-responsibilty-filter-head">Category</span>
                    <select class="" name="filter-category" id="">
                        '.$option.'
                    </select>
                    </div>';
                break;
            case 'sub_category':
                $option = $this->get_all_option('sub_category_c');
                $data = '<div class="form-group">
                    <span class="primary-responsibilty-filter-head">Sub Category</span>
                    <select class="" name="filter-sub_category" id="">
                        '.$option.'
                    </select>
                    
                    </div>';
                break;
            case 'uploaded_by':
                $users = $this->get_all_users_option();
                $data = '<div class="form-group">
                    <span class="primary-responsibilty-filter-head">Uploaded by</span>
                    <select class="select2" name="filter-uploaded-by[]" id="" multiple>
                        '.$users.'
                    </select>
                    </div>';
                break;            
            default:
                $data = '';
                break;
        }
        return $data;
    }

    //---------------For Document Columns Header-------------------//

    function getDocumentColumnFiltersHeader($columnFilter){

        $data = '';
        $customColumns = $_GET['customDocumentColumns'];
        // echo $_GET['customDocumentColumns'];
        if($customColumns):
        foreach($customColumns as $key => $column){
            $data .= $this->getDocumentColumnHtml($column);
        }
        endif;

        return $data;
    }

    function getDocumentColumnHtml($column){
        $data = '';
        switch($column){
            case 'name':
                $data .= '<th class="table-header">Document Name</th>';
                break; 
            case 'document_type':
                $data .= '<th class="table-header">Document Type</th>';
                break; 
            case 'related_to':
                $data .= '<th class="table-header">Related To</th>';
                break;
            case 'category':
                $data .= '<th class="table-header">Category</th>';
                break;
            case 'sub_category':
                $data .= '<th class="table-header">Sub Category</th>';
                break;
            case 'uploaded_by':
                $data .= '<th class="table-header">Uploaded by</th>';
                break;
            // case 'new_current_status_c':
            //     $data .= '<th class="table-header">Comments</th>';
            //     break;
            // case 'description':
            //     $data .= '<th class="table-header">Summary of Interaction</th>';
            //     break;
            // case 'new_key_action_c':
            //     $data .= '<th class="table-header">Key Actionable / Next Steps identified from the Interaction</th>';
            //     break;
            // case 'next_date_c':
            //     $data .= '<th class="table-header">Next Follow-Up / Interaction Date</th>';
            //     break;
            // case 'name_of_person_c':
            //     $data .= '<th class="table-header">Name of Person Contacted</th>';
            //     break;
        }
        return $data;
    }


    //-----------------For Document list view Table-------------------------------------//
    function getDocumentColumnFiltersBody($columnFilter, $row){

        

        $data = '';
        $customColumns = @$_GET['customDocumentColumns'];

        if($customColumns):
        foreach($customColumns as $column){
            $data .= $this->getDocumentColumnDataHtml($column, $row);
        }
        endif;

        return $data;

    }

    function getDocumentColumnDataHtml($column, $row){
        $data = '';
        global $current_user;
        $log_in_user_id = $current_user->id;

        switch($column){
            case 'name':
                $data .= '<td class="table-data">';
                    $data .= '<a href="index.php?module=Documents&action=DetailView&record='.$row['id'].'">';

                    $tag_icon_query = 'SELECT * FROM documents_cstm where id_c = "' .$row['id'].'"';
                    $result = $GLOBALS['db']->query($tag_icon_query);
                    $tagged_user = $result->fetch_assoc();
                    $tagged_user_array = explode(',',$tagged_user['tagged_hidden_c']); 

                    $data .= '<h2 class="document-title">'. $row['document_name'];
                    if (in_array($log_in_user_id,$tagged_user_array)){
                        $data .= '   <i class="fa fa-tag" style="font-size: 12px; color:green"></i></h2></a>';
                    }
                    else {
                        $data .= '</h2></a>';
                    }
                    $data .= '</td>';

                    break; 
            case 'related_to':
                $parent_type = '';
                $data .= '<td class="table-data">';

                $data .= '<h2 class="document-related-name">'. beautify_label(getDocumentRelatedTo($row['parent_type'], $row['parent_id'])) .'</h2>';
                
                if( strtolower($row['parent_type']) == 'calls'){
                    $parent_type = 'Activity';
                }
                elseif( strtolower($row['parent_type']) == 'accounts'){
                    $parent_type = 'Department';
                }
                else{
                    $parent_type = $row['parent_type'];
                }

                $data .= '<span class="document-related-type">'. $parent_type .'</span></td>';
                break;
            case 'document_type':
                $data .= '<td class="table-data">'. beautify_label($row['template_type']) .'</td>';
                break;
            case 'category':
                $data .= '<td class="table-data">'. $row['category_c'] .'</td>';
                break;
            case 'sub_category':
                $data .= '<td class="table-data">'. $row['sub_category_c'] .'</td>';
                break;
            case 'uploaded_by':
                $data .= '<td class="table-data">';
                $data .= '<h2 class="document-related-uploaded_by">'. getUsername($row['created_by']) .'</h2>';
                $data .= '<span class="document-related-uploaded_date">'. date( 'd/m/Y', strtotime($row['date_entered']) ) .'</span></td>';
                break;
            // case 'date_modified':
            //     $data .= '<td class="table-data">'. date( 'd/m/Y', strtotime($row['date_modified']) ) .'</td>';
            //     break;
            // case 'assigned_to_c':
            //     $data .= '<td class="table-data">'. $row['assigned_to_c'] .'</td>';
            //     break;
            // case 'new_current_status_c':
            //     $data .= '<td class="table-data">'. $row['new_current_status_c'] .'</td>';
            //     break;
            // case 'description':
            //     $data .= '<td class="table-data">'. $row['description'] .'</td>';
            //     break;
            // case 'new_key_action_c':
            //     $data .= '<td class="table-data">'. $row['new_key_action_c'] .'</td>';
            //     break;
            // case 'next_date_c':
            //     $data .= '<td class="table-data">'. date( 'd/m/Y', strtotime($row['next_date_c'] ) ) .'</td>';
            //     break;
            // case 'name_of_person_c':
            //     $data .= '<td class="table-data">'. $row['name_of_person_c'] .'</td>';
            //     break;
        }
        return $data;
    }

    //--------------------For Document pending Aproval Table------------------------------//
    function getPendingDocumentColumnFiltersBody($columnFilter, $row){

        

        $data = '';
        $customColumns = @$_GET['customDocumentColumns'];

        if($customColumns):
        foreach($customColumns as $column){
            $data .= $this->getPendingDocumentColumnDataHtml($column, $row);
        }
        endif;

        return $data;

    }

    function getPendingDocumentColumnDataHtml($column, $row){
        $data = '';
        global $current_user;
        $log_in_user_id = $current_user->id;

        switch($column){
            case 'name':
                $data .= '<td class="table-data">';
                    $data .= '<a href="index.php?module=Documents&action=DetailView&record='.$row['id'].'">';

                    $tag_icon_query = 'SELECT * FROM documents_cstm where id_c = "' .$row['id'].'"';
                    $result = $GLOBALS['db']->query($tag_icon_query);
                    $delegate_user = $result->fetch_assoc();
                    $delegated_id_array = explode(',',$delegate_user['delegate_id']); 

                    $data .= '<h2 class="document-title">'. $row['document_name'];
                    if (in_array($log_in_user_id,$delegated_id_array)){
                        $data .= ' <img src="modules/Home/assets/Delegate-icon.svg" style="width: 25px; color:green" />';
                    
                    }
                    else {
                        $data .= '</h2></a>';
                    }
                    $data .= '</td>';

                    break; 
            case 'related_to':
                $parent_type = '';
                $data .= '<td class="table-data">';

                $data .= '<h2 class="document-related-name">'. beautify_label(getDocumentRelatedTo($row['parent_type'], $row['parent_id'])) .'</h2>';

                $data .= '<span class="document-related-type">'. $row['parent_type'] .'</span></td>';
                break;
            case 'document_type':
                $data .= '<td class="table-data">'. beautify_label($row['template_type']) .'</td>';
                break;
            case 'category':
                $data .= '<td class="table-data">'. $row['category_c'] .'</td>';
                break;
            case 'sub_category':
                $data .= '<td class="table-data">'. $row['sub_category_c'] .'</td>';
                break;
            case 'uploaded_by':
                $data .= '<td class="table-data">';
                $data .= '<h2 class="document-related-uploaded_by">'. getUsername($row['created_by']) .'</h2>';
                $data .= '<span class="document-related-uploaded_date">'. date( 'd/m/Y', strtotime($row['date_entered']) ) .'</span></td>';
                break;
            // case 'date_modified':
            //     $data .= '<td class="table-data">'. date( 'd/m/Y', strtotime($row['date_modified']) ) .'</td>';
            //     break;
            // case 'assigned_to_c':
            //     $data .= '<td class="table-data">'. $row['assigned_to_c'] .'</td>';
            //     break;
            // case 'new_current_status_c':
            //     $data .= '<td class="table-data">'. $row['new_current_status_c'] .'</td>';
            //     break;
            // case 'description':
            //     $data .= '<td class="table-data">'. $row['description'] .'</td>';
            //     break;
            // case 'new_key_action_c':
            //     $data .= '<td class="table-data">'. $row['new_key_action_c'] .'</td>';
            //     break;
            // case 'next_date_c':
            //     $data .= '<td class="table-data">'. date( 'd/m/Y', strtotime($row['next_date_c'] ) ) .'</td>';
            //     break;
            // case 'name_of_person_c':
            //     $data .= '<td class="table-data">'. $row['name_of_person_c'] .'</td>';
            //     break;
        }
        return $data;
    }
    
   


    function documentpagination($page, $numberOfPages, $type, $day, $searchTerm, $filter){

        $ends_count = 1;  //how many items at the ends (before and after [...])
        $middle_count = 2;  //how many items before and after current page
        $dots = false;

        $data = '<ul class="d-inline-block">';
        
        if($page > 1)
            $data .= '<li class="" onClick=documentpaginate("'.($page - 1).'","'.$type['method'].'","'.$day.'","'.$searchTerm.'","'.$filter.'","'.$type['status'].'","'.$type['type'].'")><strong>&laquo;</strong> Prev</li>';

        for ($i = 1; $i <= $numberOfPages; $i++) {
            $currentPage = $page ? $page : 1;
            $class = $currentPage == $i ? 'active paginate-class' : 'paginate-class';

            
            $onClick = 'onClick=documentpaginate("'.$i.'","'.$type['method'].'","'.$day.'","'.$searchTerm.'","'.$filter.'","'.$type['status'].'","'.$type['type'].'")';

            if ($i == $page) {
                $data .= '<li class="'.$class.'" '.$onClick.'>'.$i.'</li>';
                $dots = true;
            } else {
                if ($i <= $ends_count || ($page && $i >= $page - $middle_count && $i <= $page + $middle_count) || $i > $numberOfPages - $ends_count) { 
                    $data .= '<li class="'.$class.'" '.$onClick.'>'.$i.'</li>';
                    $dots = true;
                } elseif ($dots){
                    $data .= '<li class="paginate-class">&hellip;</li>';
                    $dots = false;
                }
            }
        }
        if ($page < $numberOfPages || -1 == $numberOfPages) { 
        $data .= '<li class="" onClick=documentpaginate("'.($page + 1).'","'.$type['method'].'","'.$day.'","'.$searchTerm.'","'.$filter.'","'.$type['status'].'","'.$type['type'].'")>Next <strong>&raquo;</strong></li>';
        }
            
        $data .= '</ul>';
        return $data;
    }

   //---------------For Document Graph-----------------------------//
    public function action_get_document_graph(){
        $day = $_GET['dateBetween'];
        $totalCount = 0;
        $totalCount = $this->getDocumentStatusCountGraph(null , $day);
        // $leadCount = round($this->getDocumentStatusCountGraph('Lead') / $totalCount * 100, 0);
        if ($totalCount > 0) {
            $Sales = round($this->getDocumentStatusCountGraph('sales', $day) / $totalCount * 100, 0);
            $EntityDocuments = round($this->getDocumentStatusCountGraph('entity_documents', $day) / $totalCount * 100, 0);
            $ResearchandIntelligence = round($this->getDocumentStatusCountGraph('research_intelligence', $day) / $totalCount * 100, 0);
            $Others = round($this->getDocumentStatusCountGraph('Others', $day) / $totalCount * 100, 0);
        }
        $Sales = $Sales ? $Sales : 0;
        $EntityDocuments = $EntityDocuments ? $EntityDocuments : 0;
        $ResearchandIntelligence = $ResearchandIntelligence ? $ResearchandIntelligence : 0;
        $Others = $Others ? $Others : 0;
        $data = '';

        if($Sales):
            $data .= '<div style="width: '.$Sales.'%" class="graph-bar-each">
                    <div style="width: 100%;height: 70px;background-color: #DDA0DD;"></div>
                    <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$Sales.'%</p>
                </div>';
        endif;

        if($EntityDocuments):
            $data .= '<div style="width: '.$EntityDocuments.'%" class="graph-bar-each">
                    <div style="width: 100%;height: 70px;background-color: #4B0082;"></div>
                    <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$EntityDocuments.'%</p>
                </div>';
        endif;
        
        if($ResearchandIntelligence):
            $data .= '<div style="width: '.$ResearchandIntelligence.'%" class="graph-bar-each">
                    <div style="width: 100%; height: 70px; background-color: #0000FF;"></div>
                    <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$ResearchandIntelligence.'%</p>
                </div>';
        endif;
        if($Others):
            $data .= '<div style="width: '.$Others.'%" class="graph-bar-each">
                    <div style="width: 100%; height: 70px; background-color: #FFFF00;"></div>
                    <p style="text-align: center; margin-top: 5px;font-size: 9px;">'.$Others.'%</p>
                </div>';
        endif;
        echo json_encode(array("data"=>$data, "message" => "Success"));
        // echo $data;
        die;
    }

    
    function getDocumentStatusCountGraph($status = null, $day, $closure_status = null){
        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];

        $query = "SELECT count(*) as count FROM documents_cstm dc LEFT JOIN documents d ON d.id = dc.id_c WHERE d.deleted != 1 AND d.date_entered >= now() - interval '".$day."' day";
        if($status)
            $query .= " AND d.template_type = '".$status."' ";

        $count = $GLOBALS['db']->query($query);
        $count = $GLOBALS['db']->fetchByAssoc($count);
        return $count['count'];
    }
    
    ///  ::::::::::::::::::::::::::::::::::::::::::::::::::::::  Joytrimoy Code ::::::::::::::::::::::::::::::::::::::::::::::::::

    public function action_set_note_for_document() {
        try {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            global $current_user;
            $doc_id = $_POST['doc_id'];
            $note = $_POST['note'];
            $user_id = $current_user->id;

            $query = "INSERT INTO document_note (doc_id, created_by, notes) VALUES ('$doc_id', '$user_id', '$note')";
            $GLOBALS['db']->query($query);

            $result1 = getQuery('*', 'documents', 'id = "'.$doc_id.'"');
            $row = $result1->fetch_assoc();

            if($user_id != $row['created_by']) {
                $notification_message = '"'.getUsername($user_id).'" has written a note on document "'.$row['document_name'].'".';
                send_notification("Document", $row['document_name'], $notification_message, [$row['created_by']], '');

                $receiver_email = getUserEmail($row['created_by']);
                $notification_message = $notification_message."<br><br>Click here to view: www.ampersandcrm.com";
                send_email($notification_message, [$receiver_email], 'CRM ALERT - New Note');  
            }

            echo json_encode(array("status"=> true, "message" => "Note Added", "doc_name" => $row['document_name']));
            die();
        } catch (Exception $e) {
            echo json_encode(array("status" => false, "message" => "Some error occured"));
        }
        die();
    }


    // Function for checking DB if the specific document note is applicable
    public function is_document_note_applicable($doc_id) {
        try {

            global $current_user;
            $log_in_user_id = $current_user->id;
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $team_func_array = $team_func_array1 = $others_id_array = $tagged_user_array = array();
            $is_creator = false;
            // $sql ="SELECT assigned_user_id FROM documents where id ='$doc_id' ";
            $sql ="SELECT documents.assigned_user_id, documents.created_by, documents_cstm.tagged_hidden_c
            FROM documents 
            LEFT JOIN documents_cstm ON documents.id = documents_cstm.id_c
            WHERE id ='$doc_id' ";

            $result = $GLOBALS['db']->query($sql);
            $row = $result->fetch_assoc();
            if(strpos($row['tagged_hidden_c'], ',') !== false) {
                $tagged_user_array = explode(',',  $row['tagged_hidden_c']);
            } else {
                $tagged_user_array = [$row['tagged_hidden_c']];
            }
            if($row['created_by'] == $log_in_user_id) {
                $is_creator = true;
            }
            $user_id = $row['assigned_user_id'];

            $result1 = getQuery('user_lineage', 'users_cstm', 'id_c = "'.$user_id.'"');
            $row = $result1->fetch_assoc();
            if (strpos($row['user_lineage'], ',') !== false) {
                $team_func_array = explode(',',  $row['user_lineage']);
            }
            else {
                $team_func_array = [$row['user_lineage']];
            }
            $sql3 = "SELECT users.id, users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '".$log_in_user_id."' AND users.deleted = 0";
            $result3 = $GLOBALS['db']->query($sql3);
            while($row3 = $GLOBALS['db']->fetchByAssoc($result3))
            {
                $check_sales = $row3['teamfunction_c'];
                $check_mc = $row3['mc_c'];
                $check_team_lead = $row3['teamheirarchy_c'];

            }

            if($check_mc =="yes"||  $log_in_user_id == "1" || in_array($log_in_user_id, $team_func_array) || in_array($log_in_user_id, $tagged_user_array) || $is_creator == true){
                return true;
            }
            else {
                return false;
            }


        }catch (Exception $e) {
            echo json_encode(array("status" => false, "message" => "Some error occured"));
        }
        die();
    }



    // delegate document functions 
    public function action_document_delegated_dialog_info(){
        try {
            $db = \DBManagerFactory::getInstance();
            global $current_user;
            $log_in_user_id = $current_user->id;
            $GLOBALS['db'];
            // $data = '';

            $delegated_user_id = $this->get_document_delegated_user($log_in_user_id);
            
            if ($delegated_user_id) {
                $delegated_user = $this->get_user_details_by_id($delegated_user_id);
            }
            
            if (!empty(@$delegated_user) && (@$delegated_user['first_name'] || @$delegated_user['last_name'])) {
                $delegated_user_name = $delegated_user['first_name'] . $delegated_user['last_name'];
            }
            // if($delegated_user_id==0){
            //     $data = '<p>There are no documents to delegate </p>';
            // }else{
            //     $data = $delegated_user_id;
            // }
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
                $data .= '
                    <tbody>
                    <tr>
                    <td class="delegatetable-data-popup">'.$delegated_user_name.'</td>
                    <td class="delegatetable-data-popup" style="color: #00f;">'.$this->document_delegateActionCompleted($delegated_user_id).'</td>
                    <td class="delegatetable-data-popup">Edit</td>
                    <td>
                        <button type="button" style="margin-left: 100px; margin-bottom: 10px; margin-top: 20px;" class="btn2 remove-document-delegate">Remove</button>
                    </td>
                </tr>';
                $data .= '</tbody></table>';
            endif; 
        
        
            echo json_encode(array('delegated_info' => $data, 'delegated_id' => $log_in_user_id, 'delegated_user_id' =>$delegated_user_id));
        } catch (Exception $e) {
            echo json_encode(array("status" => false, "message" => "Some error occured"));
        }
        die();
    }

    //-------------------------For storing the Delegate result in Dialog box-------------------//
    public function action_document_store_delegate_result(){
        try{
            $db = \DBManagerFactory::getInstance();
            global $current_user;
            $log_in_user_id = $current_user->id;
            $GLOBALS['db'];
            $proxy = $_POST['Select_Proxy'];

            $save_delegate_query = "UPDATE documents_cstm as d2 
                LEFT JOIN documents ON documents.id = d2.id_c
                SET d2.delegate_id = '$proxy' , delegate_date = now()
                WHERE documents.deleted != 1 AND d2.user_id_c = '$log_in_user_id'";
            
            $save_delegate_query_result = $GLOBALS['db']->query($save_delegate_query);

            $approvalDelegateUpdate = "UPDATE document_approval_table SET delegate_id = '$proxy' WHERE approver = '$log_in_user_id' AND approval_status = 1";
            $approvalDelegateUpdateQuery = $GLOBALS['db']->query($approvalDelegateUpdate);

            //$fetch_organization_count = $GLOBALS['db']->fetchByAssoc($save_delegate_query_result);
        
        //Notification
        $description = "You have been delegated to approve & reject documents by ".'"'.getUserName($log_in_user_id).'".';
        $description_email = "You have been delegated to approve & reject documents by ".'"'.getUserName($log_in_user_id).'".'."<br><br>Click here to view: www.ampersandcrm.com";
        send_notification('Document','Delegate',$description,[$proxy],'');

        $reciever_email = getUserEmail($proxy);
        send_email($description_email,[$reciever_email],'CRM ALERT - Delegation');
        echo json_encode(array("status"=>true, "message"=>"Data Succesfully updated", "proxy"=> $proxy,"proxy_name"=>getUserName($proxy)));
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }

    //------------------For Rejection-------------//
    public function action_document_remove_delegate_user(){
        try{
            $db = \DBManagerFactory::getInstance();
            global $current_user;
            $log_in_user_id = $current_user->id;
            $GLOBALS['db'];
            $save_delegate_query = "UPDATE documents_cstm as d2 
                LEFT JOIN documents ON documents.id = d2.id_c
                SET d2.delegate_id = '', delegate_date = NULL
                WHERE documents.deleted != 1 AND d2.user_id_c = '$log_in_user_id' ";
            
            $save_delegate_query_result = $GLOBALS['db']->query($save_delegate_query);

            $save_delegate_query = "UPDATE document_approval_table  
                SET delegate_id = ''
                WHERE approver = '$log_in_user_id'";
            
            $save_delegate_query_result = $GLOBALS['db']->query($save_delegate_query);

        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
    }

    //----------------For Count Of Document Delegate-----------------//
    function document_delegateActionCompleted($userID){
        global $current_user;
        $log_in_user_id = $current_user->id;
        $query = "SELECT count(*) as count FROM document_approval_table aap";
        $query .= " JOIN documents d ON d.id = aap.doc_id";
        $query .= " WHERE approval_status = '1' AND d.deleted != 1 AND aap.approver = '$log_in_user_id' AND aap.delegate_id = '$userID' ";

        $result = $GLOBALS['db']->query($query);
        $count = $GLOBALS['db']->fetchByAssoc($result);
        return $count['count'];
    }

    //---------------------For Document Aprroval Table-------------------//
    function action_get_document_approval_item(){
        try
        {
            global $current_user;
            $log_in_user_id = $current_user->id;
            
            $id = $_POST['id'];
            $event = $_POST['event'];

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            $data= '';
            $fetch_query = "SELECT d.*, ds.* FROM documents d JOIN document_approval_table ap ON ap.doc_id = d.id LEFT JOIN documents_cstm ds ON d.id = ds.id_c WHERE d.deleted != 1 AND d.date_entered >= now() - interval '1200' day AND ap.id = '$id'";
            $result = $GLOBALS['db']->query($fetch_query);
            while($row = $GLOBALS['db']->fetchByAssoc($result))
            {
                $temp = ($event == 'Approve') ? 'Approval' : 'Rejection';
                $data = '
                <input type="hidden" name="doc_id" value="'.$row['id'].'" />
                <input type="hidden" name="event" value="'.$event.'" />
                <input type="hidden" name="approval_id" value="'.$id.'" />
                <h2 class="approvalheading">'.$row['document_name'].'</h2><br>
                <p class="approvalsubhead">'. $temp .' of Document
                </p>
                <section>
                    <div style="padding: 10px 15px;">
                        <table class="approvaltable" width="100%">
                            <tr class="tapprovalable-header-row-popup">
                                <th class="approvaltable-header-popup">Document</th>
                                <th class="approvaltable-header-popup">Related To</th>
                                <th class="approvaltable-header-popup">Status</th>
                                <th class="approvaltable-header-popup">Document Type</th>
                                <th class="approvaltable-header-popup">Uploaded By</th>
                                <th class="approvaltable-header-popup">Last Updated</th>
                            </tr>';

                        $data .='
                            <tr>
                                <td class="approvaltable-data-popup">'.$row['document_name'].'</td>
                                <td class="approvaltable-data-popup">'.beautify_label(getDocumentRelatedTo($row['parent_type'], $row['parent_id'])).'<br><span class="document-related-type">'. $row['parent_type'] .'</span></td>
                                <td class="approvaltable-data-popup">'.beautify_label($row['status_c']).'</td>
                                <td class="approvaltable-data-popup">'.beautify_label($row['template_type']).'</td>
                                <td class="approvaltable-data-popup">'. getUsername($row['created_by']) .'<br><span class="document-related-uploaded_date">'. date( 'd/m/Y', strtotime($row['date_entered']) ) .'</span></td>
                                <td class="approvaltable-data-popup">'.date( 'd/m/Y', strtotime($row['date_modified']) ).'</td>
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
                        <button class="btn1" type="button" onClick=updateDocumentStatus();>'.$event.'</button>
                        <button type="button" style="margin-left: 10px;" class="btn2" id="approvalclose" onClick="openDocumentApprovalDialog(\'close\');">Cancel</button>
                    </div>
                </section>';
            }
            echo $data;
                  }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }

    //-----------------For Document Note--------------------------//

    public function action_document_note_dialog_info() {
        try {

            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            $doc_id = $_REQUEST['id'];

            $fetch_document_info = "SELECT documents.document_name, documents.date_entered, documents.created_by, documents.template_type, documents.id as doc_id, documents_cstm.category_c as category_name, documents_cstm.sub_category_c as sub_category_name, documents_cstm.parent_type, documents_cstm.parent_id FROM documents
            LEFT JOIN documents_cstm ON documents.id = documents_cstm.id_c WHERE documents.id = '$doc_id'";

            $fetch_document_info_result = $GLOBALS['db']->query($fetch_document_info);
            $row = $GLOBALS['db']->fetchByAssoc($fetch_document_info_result);
            $created_user_id = $row['created_by'];
            $user_full_name = getUsername($created_user_id);
            $sub_head = 'Write a note';

            $fetch_notes_history_result = getQuery('*', 'document_note', 'doc_id = "'.$doc_id.'"');

            $data = '
                <h2 class="deselectheading">' . $row['document_name'] . '</h2><br>
                <p class="deselectsubhead">'.$sub_head.'</p>
                <hr class="deselectsolid" style="border-bottom: 1px solid black;">
                <section class="deselectsection">
                <table align="centered" width="100%">
                    <thead>
                    <tr class="tabname" style="font-size: 15px;">
                        <th><strong>Document Type</strong></th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Related To</th>
                        <th>Uploaded By</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr class="tabvalue">
                        <td>' . beautify_label($row['template_type']) . '</td>
                        <td>' . ucfirst($row['category_name']) . '</td>
                        <td>' . ucfirst($row['sub_category_name']) . '</td>
                        <td> <h2 class="document-related-name">' . beautify_label(getDocumentRelatedTo($row['parent_type'] , $row['parent_id'])) . '</h2> <span class="document-related-type">'. $row['parent_type'] .'</span></td>
                        <td> <h2 class="document-related-name">' . ucwords($user_full_name) . '</h2> <span class="document-related-type">'.date( 'd/m/Y', strtotime($row['date_entered']) ).'</span></td>

                      
                        </tr>';
            $data .= '</tbody></table>';

            $notes_history = '
                
                <hr class="deselectsolid" style="border-bottom: 1px solid black;">
                <section class="deselectsection">
                <table align="centered" width="100%">
                    <thead>
                    <tr class="tabname">
                        <th>Previous Notes</th>
                        <th>By</th>
                        <th>Posted On</th>
                    </tr>
                    </thead>
                    <tbody>';

            while($row1 = $GLOBALS['db']->fetchByAssoc($fetch_notes_history_result))
            {
                $note_creator_id = $row1['created_by'];
                $note_creator = getUsername($note_creator_id);
                $notes_history .= '<tr class="tabvalue">
                        <td>' . ucfirst($row1['notes']) . '</td>
                        <td>' . ucwords($note_creator). '</td>
                        <td>'.date( 'd/m/Y', strtotime($row1['posted_date']) ). '</td>
                       
                        </tr>';
            }

            $notes_history .= '</tbody></table>';



            echo json_encode(array('document_info'=>$data, 'doc_id'=>$doc_id, 'notes_history'=>$notes_history, 'doc_creator'=>ucwords($user_full_name)));

        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }


    /* approve / reject pending document */
    function action_document_status_update(){
        try
        {
            global $current_user;
            $log_in_user_id = $current_user->id;
            
            $id = $_POST['doc_id'];
            $approval_id = $_POST['approval_id'];
            $event = $_POST['event'];
            $comment = $_POST['comment'];

            if($event == 'Approve')
                $ApprovalStatus = '1';
            else
                $ApprovalStatus = '2';
            
            date_default_timezone_set('Asia/Kolkata');
            $date = date('Y-m-d');
        
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];

            $data = $this->getDbData('document_approval_table', '*', "doc_id = '$id' ");
            
            $data = $data[0];
            $doc_id = $data['doc_id'];
            $doc_type = $data['doc_type'];
            $status = $data['status'];
            $sender = $data['sender'];
            $sent_time = $data['sent_time'];
            $approver = $data['approver'];
            $delegateID = $data['delegate_id'];
            $notification_id = $data['id'];
            $description='';

            $updateQuery = "UPDATE document_approval_table SET approval_status = '$ApprovalStatus' ";
            if($this->isDocumentDelegate($log_in_user_id, $id))
                $updateQuery .= ", delegate_comment = '$comment' , delegate_approve_reject_date = '$date' ";
            else
                $updateQuery .= " , approver_comment = '$comment' , approve_reject_date= '$date' ";
            $updateQuery .= " WHERE doc_id = '$id' ";

            if($db->query($updateQuery)==TRUE){
                if($ApprovalStatus == 1){
                    $updateDocument = "UPDATE documents_cstm SET status_c = 'Completed' WHERE id_c = '$id'";
                    $db->query($updateDocument);
                    require_once 'data/BeanFactory.php';
                    require_once 'include/utils.php';
                    $u_id = create_guid();
                    $created_date= date("Y-m-d H:i:s", time());
            		$sql_insert_audit = 'INSERT INTO `documents_audit`(`id`, `parent_id`, `date_created`, `created_by`, `field_name`, `data_type`, `before_value_string`, `after_value_string`, `before_value_text`, `after_value_text`) VALUES ("'.$u_id.'","'.$id.'","'.$created_date.'","'.$log_in_user_id.'","status_new_c","varchar","Apply for Completed","Completed"," "," ")';
            		$result_audit = $GLOBALS['db']->query($sql_insert_audit);
                }

                //For Notification
                $fetch_query = "SELECT d.*, ds.* FROM documents d JOIN document_approval_table ap ON ap.doc_id = d.id LEFT JOIN documents_cstm ds ON d.id = ds.id_c WHERE d.deleted != 1 AND d.date_entered >= now() - interval '1200' day AND ap.id = '$notification_id'";
                $result_query = $GLOBALS['db']->query($fetch_query);
                $row = $GLOBALS['db']->fetchByAssoc($result_query);

                

                //Assigned_user_id
                $created_by_id_test = $row['created_by'];
                $user_lineage_query ="SELECT user_lineage FROM users_cstm WHERE id_c ='$created_by_id_test'";
                $result_lineage_query = $GLOBALS['db']->query($user_lineage_query);
                $row_lineage = $GLOBALS['db']->fetchByAssoc($result_lineage_query); 

                if($row_lineage['user_lineage']!=0){
                    $assigned_user_id_approve =explode(',',$row_lineage['user_lineage']);
                    $team_lead = array_slice($assigned_user_id_approve, -1)[0];
                    if($team_lead == $log_in_user_id){
                        $team_lead = null;
                    }
                }else{
                    $team_lead = null;
                }
                if($row['tagged_hidden_c']!=0){
                    $tag_users = explode(',',$row['tagged_hidden_c']);
                    if($team_lead!=null){
                        array_push($tag_users,$team_lead,$created_by_id_test);
                    }else{
                        array_push($tag_users,$created_by_id_test);
                    }
                     $assigned_user_id = $tag_users;
                 }else{
                     if($team_lead!=null){
                        $assigned_user_id = [$team_lead,$created_by_id_test];
                     }else{
                        $assigned_user_id = [$created_by_id_test];
                     }
                    
                 }
                
                
                

                $link = "index.php?module=Documents&action=DetailView&record=".$row['id'];

                if($event =='Approve'){
                    //$assigned_user_id_approval = [$team_lead,$created_by_id_test];
                    //array_push($assigned_user_id_approve,$row['created_by']);
                    //$assigned_user_id_approve = array_diff($assigned_user_id_approve, array($log_in_user_id) );

                    //$description = "Document ".'"'.$row['document_name'].'"'." uploaded by ".'"'.getUsername($row['created_by']).'"'." has been approved by ".'"'.getUsername($log_in_user_id).'"';
                    $description = "Document ".'"'.$row['document_name'].'"'." has been approved.";
                    $description_notification = "Document ".'"'.$row['document_name'].'"'." is approved by ".'"'.getUsername($log_in_user_id).'".';
                    $description_email = "Document ".'"'.$row['document_name'].'"'." is approved by ".'"'.getUsername($log_in_user_id).'".'."<br><br>Click here to view: www.ampersandcrm.com";
                    send_notification('Document', $row['document_name'], $description_notification, $assigned_user_id,$link);
                    
                    $receiver_emails_approve = []; 
                    foreach( $assigned_user_id as $user_id) {
                         array_push($receiver_emails_approve, getUserEmail($user_id));
                        }
                    
                    send_email($description_email,$receiver_emails_approve,'CRM ALERT - Approved');
                }
                if($event =='Reject'){
                    //$assigned_user_id_reject =[$team_lead,$created_by_id_test];
                    //$description = "Document ".'"'.$row['document_name'].'"'." uploaded by ".'"'.getUsername($row['created_by']).'"'." has been rejected by ".'"'.getUsername($log_in_user_id).'"';
                    $description = "Document ".'"'.$row['document_name'].'"'." has been rejected.";
                    $description_notification = "Document ".'"'.$row['document_name'].'"'." is rejected by ".'"'.getUsername($log_in_user_id).'".';
                    $description_email = "Document ".'"'.$row['document_name'].'"'." is rejected by ".'"'.getUsername($log_in_user_id).'".'."<br><br>Click here to view: www.ampersandcrm.com";
                    send_notification('Document',$row['document_name'],$description_notification,$assigned_user_id,$link);
                    
                    $receiver_emails_reject = []; 
                    foreach($assigned_user_id as $user_id) {
                         array_push($receiver_emails_reject, getUserEmail($user_id));
                        }
                    send_email($description_email,$receiver_emails_reject,'CRM ALERT - Rejected');
                }
                
                
                
                echo json_encode(array("status"=>true,  "message" => "Status changed successfully.","description"=>$description,"link"=>$link));
            
            }else{
                echo json_encode(array("status"=>false, "message" => "Some error occured"));
            }
        
            
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured", "query" => $updateQuery));
        }
        die();
    }

    //---------------------------For document Tag---------------------//

    public function action_document_tag_dialog_info()
    {
        try {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            $doc_id = $_REQUEST['id'];
            $fetch_document_info = "SELECT * FROM documents
                LEFT JOIN documents_cstm ON documents.id = documents_cstm.id_c WHERE id = '$doc_id'";
            $fetch_document_info_result = $GLOBALS['db']->query($fetch_document_info);
            $row = $GLOBALS['db']->fetchByAssoc($fetch_document_info_result);
            $assigned_user_id = $row['assigned_user_id'];
            $created_by = $row['created_by'];
            $user_full_name = getUsername($assigned_user_id);
            $creator_full_name = getUsername($created_by);
            $sub_head = 'Selected members will be able to view details or take action';
            $change_font = "Select Member";


            $data = '
                <h2 class="deselectheading">' . $row['document_name'] . '</h2><br>
                <p class="deselectsubhead">'.$sub_head.'</p>
                <hr class="deselectsolid">
                <section class="deselectsection">
                <table align="centered" width="100%">
                    <thead>
                    <tr class="tabname">
                        <th>Last Update</th>
                        <th>Document Type</th>
                        <th>Assigned to</th>
                        <th>Uploaded By</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr class="tabvalue">
                        <td>' . date_format(date_create($row['date_modified']), 'd/m/Y') . '</td>
                        <td>' . beautify_label($row['template_type']) . '</td>
                        <td>' . ucwords($user_full_name). '</td>
                        <td>' . ucwords($creator_full_name). '</td>
                        </tr>';
            $data .= '</tbody></table>';
            $optionList = $this->tag_dialog_dropdown_info("documents", $doc_id);


          echo json_encode(array('document_info'=>$data,'document_id'=>$doc_id, 'optionList'=> $optionList));
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();
    }
    

    public function action_set_document_for_tag(){
        try {
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            $document_id = $_POST['document_tag_id'];
            $user_id_list = '';
            // if ($_POST['userIdList'] != "undefined") {
            //     $user_id_list = $_POST['userIdList'];
            // }
            if ($_POST['tag_document']) {
                $user_id_list = $_POST['tag_document'];
                $user_id_list = implode(',',$user_id_list);
            } else {
                $latest_users_array = [];
            }

            $sql ="SELECT documents.document_name, documents.created_by, documents_cstm.tagged_hidden_c
            FROM documents 
            LEFT JOIN documents_cstm ON documents.id = documents_cstm.id_c
            WHERE id ='$document_id' ";
            $fetch_document_info_result = $GLOBALS['db']->query($sql);
            $row = $GLOBALS['db']->fetchByAssoc($fetch_document_info_result);


            $last_users_array = explode(',', $row['tagged_hidden_c']);
             if ($_POST['tag_document']){
                $latest_users_array = $_POST['tag_document'];
            }else {
                $latest_users_array =[];
            }
            // $latest_users_array = $_POST['tag_document'];
            $untagged_user_ids = $tagged_user_ids = $untagged_names_arr = $tagged_names_arr = [];

            $untagged_user_ids = array_diff($last_users_array, $latest_users_array);
            $tagged_user_ids = array_diff($latest_users_array, $last_users_array);
            
            if($untagged_user_ids != [""]) {
                foreach($untagged_user_ids as $id) {
                    array_push($untagged_names_arr, getUsername($id));
                }  
            }
            foreach($tagged_user_ids as $id) {
                array_push($tagged_names_arr, getUsername($id));
            }     

            $tagged_users_string = implode(', ',$tagged_names_arr);
            $untagged_users_string = implode(', ',$untagged_names_arr);

            $document_link = "index.php?action=DetailView&module=Documents&record=".$document_id;
            // $notification_message = "You have been tagged. Now you can edit /make changes to document ".$row['document_name'];
            $notification_message = 'You have been tagged for document "'.$row['document_name'].'". Now you can edit /make changes.';
            send_notification("Document", $row['document_name'], $notification_message, $tagged_user_ids, $document_link);

            $receiver_emails = []; 
            foreach($tagged_user_ids as $user_id) {
                array_push($receiver_emails, getUserEmail($user_id));
            }
            if(count($receiver_emails) > 0) {
                $notification_message = $notification_message."<br><br>Click here to view: www.ampersandcrm.com";
                send_email($notification_message, $receiver_emails, 'CRM ALERT - Tagged');
            }

            $untagged_receiver_emails = [];
            if($untagged_user_ids != [""]) {
                foreach($untagged_user_ids as $user_id) {
                    array_push($untagged_receiver_emails, getUserEmail($user_id));
                }
            }
            if(count($untagged_receiver_emails) > 0) {
                $untagged_notification_message = 'You have been untagged from document "'.$row['document_name'].'".';
                send_email($untagged_notification_message, $untagged_receiver_emails, 'CRM ALERT - Untagged');
            }


            $sub_query = "UPDATE documents_cstm SET tagged_hidden_c = '$user_id_list' WHERE id_c='$document_id'";
            $GLOBALS['db']->query($sub_query);

            echo json_encode(array("status"=> true, "message" => "Value Updated", "tagged_users" => $tagged_users_string, "untagged_users" => $untagged_users_string, "doc_name" => $row['document_name']));
        } catch (Exception $e) {
            echo json_encode(array("status" => false, "message" => "Some error occured", "name"=>''));
        }
        die();

    }

    

    //--------------------------------------for download----------------------//

     function action_document_export(){

        global $current_user;

        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        $log_in_user_id = $current_user->id;

        $day        = isset( $_GET['day'] ) ? $_GET['day'] : $_COOKIE['day'];
        $status_c   = isset( $_GET['status_c'] ) ? $_GET['status_c'] : '';
        $dropped    = isset( $_GET['dropped'] ) ? $_GET['dropped'] : '';
        $type       = isset( $_GET['csvtype'] ) ? $_GET['csvtype'] : '';


        //  LEFT JOIN year_quarters ON year_quarters.opp_id = opportunities.id
        
        $query = "SELECT documents.*, documents_cstm.*,
            FROM documents 
            LEFT JOIN documents_cstm ON documents.id = documents_cstm.id_c 
            WHERE documents.deleted != 1 AND documents.date_entered >= now() - interval '$day' day ";

        // if($status_c){
        //     $query .= " AND documents.status_c='$status_c'";
        // }

        // if($type){
        //     $opp_id_show = private_opps();
        //     if($type == 'non_global') {
        //         $query .= " opportunities.id  IN ('".implode("','",$opp_id_show)."'))";
        //     }
        //     else {
        //         $query .= " AND opportunities.opportunity_type='$type' ";
        //     }
        // }
        

        // if($status_c == 'Closed'){
        //     $query .= ' AND opportunities_cstm.closure_status_c = "won" ';
        // }else if($status_c == 'Dropped' ){
        //     $query = "SELECT opportunities.*, opportunities_cstm.*,
        //         CAST(REPLACE(year_quarters.total_input_value, ',', '')as SIGNED) as total_input_value FROM opportunities 
        //         LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c 
        //         LEFT JOIN year_quarters ON year_quarters.opp_id = opportunities.id
        //         WHERE opportunities.deleted != 1 AND opportunities.date_entered >= now() - interval '$day' day ";
        //     if ($dropped) {
        //         if ($dropped == 'Dropped') {
        //             $query .= "AND opportunities_cstm.status_c='Dropped'";
        //         } else {
        //             $query .= "AND (opportunities_cstm.status_c='Closed' AND opportunities_cstm.closure_status_c = 'lost')";
        //         }
        //     } else {
        //         $query .= "AND (opportunities_cstm.status_c='Dropped' OR (opportunities_cstm.status_c='Closed' AND opportunities_cstm.closure_status_c = 'lost'))";
        //     }
        // }


        $query .= $this->getDocumentFilterQuery();  //get filter query if any;

        // echo $query;

        $columnFields = $this->DocumentColumns();
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
            $docID = $row['id'];

            /*$tagged_user_query = "SELECT user_id, count(*) FROM `tagged_user` WHERE `opp_id`='$oppID' GROUP BY user_id";
            $tagged_user_query_fetch = $GLOBALS['db']->query($tagged_user_query);
            $tagged_user_query_fetch_row = $GLOBALS['db']->fetchByAssoc($tagged_user_query_fetch);
            $tagged_users = $tagged_user_query_fetch_row['user_id'];*/

            // if($row['date_closed'])
            //     $closedDate = date_format(date_create($row['date_closed']),'d/m/Y');
            // else
            //     $closedDate = '';



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
                $row['document_name'],
                str_replace( '<i class="fa fa-arrow-right"></i>', '-', $full_name),
                // $this->beautify_amount( $row['budget_allocated_oppertunity_c'] ),
                $row['date_modified'] ? date_format(date_create($row['date_modified']),'dS F Y') : '',
                $closed_by,
                $row['date_entered'] ? date_format(date_create($row['date_entered']), 'dS F Y') : '',
                //$row['date_closed'] ? date_format(date_create($row['date_closed']),'d/m/Y') : '',
            );

        }

        $_SESSION['csvHeaders'] = serialize($headers);
        $_SESSION['csvData']    = serialize($data);

        $response = json_encode(
            array(
                'status' => 'success',
            )
        );

        die;
    }


    function action_document_downloadCSV(){
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
    

    public function tag_dialog_dropdown_info($type, $id) {

        try {

            if ($type == "documents") {
                $table = "documents_cstm";
                $select_name = "tag_document";
                $hidden_tags = "tagged_hidden_c";
            } elseif ($type == "activities") {
                $table = "calls_cstm";
                $select_name = "tag_activity";
                $hidden_tags = "tag_hidden_c";
            }

            global $current_user;
            $log_in_user_id = $current_user->id;

            $result = getQuery("*", "users", "deleted = 0 AND `id` != '$log_in_user_id' AND `id` != '1' ORDER BY `users`.`first_name` ASC");
            $data = '<select class="select2" name="'.$select_name.'[]" id="" multiple>';

            $result1 = getQuery("*", $table, "id_c = '$id'");
            $tagged_user_row = $result1->fetch_assoc();

            $tagged_user_array = explode(',', $tagged_user_row[$hidden_tags]);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $full_name = $row['first_name'] . ' ' . $row['last_name'];
                    if (in_array($row['id'],$tagged_user_array)){
                        $data .= '<option value="'.$row['id'].'" selected>'.$full_name.'</option>';
                    }
                    else{
                        $data .= '<option value="'.$row['id'].'" >'.$full_name.'</option>';
                    }
                }
            }
            $data .= "</select>";
            return $data;
        }catch(Exception $e){
            echo json_encode(array("status"=>false, "message" => "Some error occured"));
        }
        die();

    }

   
            
}
?>