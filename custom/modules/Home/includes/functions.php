<?php 

    function getOpportunitiesQuery(){
        $searchTerm = isset( $_GET['searchTerm'] ) ? $_GET['searchTerm'] : '';
        $status     = isset( $_GET['status'] ) ? $_GET['status'] : '';
        $type       = isset( $_GET['type'] ) ? $_GET['type'] : '';
        $closure    = isset( $_GET['closure'] ) ? $_GET['closure'] : '';
        $isCritical = isset( $_GET['isCritical'] ) ? $_GET['isCritical'] : '';
        $day        = $_GET['days'];
        global $current_user;
        $log_in_user_id = $current_user->id;
        
        $fetch_query = "SELECT opportunities.*, opportunities_cstm.*,
                CAST(REPLACE(year_quarters.total_input_value, ',', '')as SIGNED) as total_input_value 
                FROM opportunities
                LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c
                LEFT JOIN year_quarters ON year_quarters.opp_id = opportunities.id
                WHERE deleted != 1 ";
                
        $opp_id_show = private_opps();
        
        /* Check if status is set. This will be firing if we click on the cards above the table */
        if($status){
            if($status == 'ClosedWin' || $status == 'ClosedLost'){
                $fetch_query .= " AND opportunities_cstm.status_c='Closed'";
                $closure = (strpos($status, 'Win') !== false) ? 'won' : 'lost';
                if ($closure) {
                    $fetch_query .= " AND opportunities_cstm.closure_status_c = '$closure'";
                }
            }else if($status == 'Dropped' ){
                $fetch_query .= " AND ( opportunities_cstm.status_c = 'Dropped' )";
            }else{
                $fetch_query .= " AND opportunities_cstm.status_c='$status'";
            }
        }
        if($type && $type!= ''){
            if ($type == 'global')
                $fetch_query .= " AND opportunity_type = '$type' ";
            else
                $fetch_query .= " AND opportunity_type = 'non_global' AND (opportunities.id IN ('".implode("','",$opp_id_show)."')) ";
        } else {
            $fetch_query .= " AND (opportunities.opportunity_type = 'global' OR opportunities.id IN ('".implode("','",$opp_id_show)."')) ";
        }

        if($isCritical){
            $fetch_query .= " AND critical_c LIKE '%$log_in_user_id%' AND critical_c LIKE '%yes%'";
        }

        if($searchTerm) /* Check if SearchTerm is there or not */
            $fetch_query .= " AND opportunities.name LIKE '%$searchTerm%' ";

        /* Checking if any filters are set or not */
        
        /* End filter check */
        if($_GET['filter'])
            $fetch_query .= getFilterQuery();

        $fetch_query .= " AND DATEDIFF(CURDATE(), DATE(opportunities.date_entered)) <= '$day' "; // getting records with respect to number of days
        $fetch_query .= " ORDER BY `opportunities`.`date_modified` DESC"; 

        return $fetch_query;
    }

    function getPendingOpportunitiesQuery($rowCount){

        global $current_user;
        $log_in_user_id = $current_user->id;

        $status = $_GET['status'];

        $fetch_query = "SELECT ap.id as approval_id, ap.delegate_id as delegate_id,opportunities.*, opportunities_cstm.*,
        CAST(REPLACE(year_quarters.total_input_value, ',', '')as SIGNED) as total_input_value FROM approval_table ap";
        $fetch_query .= " JOIN opportunities opportunities ON opportunities.id = ap.opp_id";
        $fetch_query .= " JOIN opportunities_cstm ON opportunities_cstm.id_c = ap.opp_id";
        $fetch_query .= " LEFT JOIN year_quarters ON year_quarters.opp_id = opportunities.id";
        $fetch_query .= " WHERE ap.Approved = 0 AND ap.Rejected = 0 AND ap.pending = 1 AND opportunities.deleted != 1 AND ( ap.approver_rejector = '$log_in_user_id' OR ap.delegate_id = '$log_in_user_id' ) AND ap.apply_for = '$status'";
        if($rowCount)
            $fetch_query .= " AND ap.row_count = '$rowCount'";

        if($_GET['filter'])
            $fetch_query .= getFilterQuery();

        $fetch_query .= "  ORDER BY `opportunities`.`date_modified` DESC";

        return $fetch_query;
    }

    function getActivityQuery(){
        $searchTerm = isset( $_GET['searchTerm'] ) ? $_GET['searchTerm'] : '';
        $status     = isset( $_GET['status'] ) ? $_GET['status'] : '';
        $type       = isset( $_GET['type'] ) ? $_GET['type'] : '';
        $closure    = isset( $_GET['closure'] ) ? $_GET['closure'] : '';
        $day        = $_GET['days'] ?? $_COOKIE['day'];
        
        $fetch_query = "SELECT calls.*, calls_cstm.*
                FROM calls
                LEFT JOIN calls_cstm ON calls.id = calls_cstm.id_c
                WHERE deleted != 1 ";

        if($type){
            $fetch_query .= " AND opportunity_type = '$type'";
        }

        if($searchTerm) /* Check if SearchTerm is there or not */
            $fetch_query .= " AND calls.name LIKE '%$searchTerm%' ";

        /* Checking if any filters are set or not */
        /* End filter check */
        if($_GET['filter'])
            $fetch_query .= getActivityFilterQuery();

        $fetch_query .= " AND DATEDIFF(CURDATE(), DATE(calls.date_entered)) <= '$day' "; // getting records with respect to number of days
        $fetch_query .= " ORDER BY `calls`.`date_modified` DESC"; 
        // echo $fetch_query; die;
        return $fetch_query;
    }

?>