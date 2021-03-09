<?php
    /* check isset and return */
    function checkIsset($var){
        return isset( $var ) ? $var : '';
    }
    function beautify_label($string) {
        return ucwords(str_replace('_', ' ', $string));
    }
    function beautify_label_n_f($string) {
        $string = str_replace('_', '', $string);
        if (strpos($string, '^PilotforFutureOpportunity^') !== false) {
            $string = str_replace('^PilotforFutureOpportunity^', '^PilotForFutureOpportunity^', $string);
        }
        if (strpos($string, '^StrategicAlignmentforFutureOpportunity^') !== false) {
            $string = str_replace('^StrategicAlignmentforFutureOpportunity^', '^StrategicAlignmentForFutureOpportunity^', $string);
        }
        return beautify_label($string);
    }
    function beautify_amount($amount) {
        return preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $amount);
    }
    function date_format_helper($date) {
        if($date){
            $dateArr = explode('/', $date);
            return $dateArr[2].'-'.$dateArr[1].'-'.$dateArr[0];
        }
    }
    function split_camel_case($label) {
        if($label == 'QualifiedDpr') {
            return 'Qualified DPR';
        }
        $array = preg_split('/(?=[A-Z])/',$label);
        return implode(' ', $array);
    }

    function getUsername($userID){
        $user_name_fetch        = "SELECT user_name, first_name, last_name FROM users WHERE id='$userID'";
        $user_name_fetch_result = $GLOBALS['db']->query($user_name_fetch);
        $user_name_fetch_row    = $GLOBALS['db']->fetchByAssoc($user_name_fetch_result);
        $user_name              = $user_name_fetch_row['user_name'];
        $first_name             = $user_name_fetch_row['first_name'];
        $last_name              = $user_name_fetch_row['last_name'];

        return "$first_name  $last_name";
    }
    
    function userTeam($userID){
        $query  = "SELECT teamfunction_c from users 
            LEFT JOIN users_cstm ON users.id = users_cstm.id_c 
            WHERE id = '$userID'";
        $result = $GLOBALS['db']->query($query);
        $row    = $GLOBALS['db']->fetchByAssoc($result);
        return $row['teamfunction_c'];
    }

    function getCount($table, $condition = null){
        $query    = "SELECT count(*) as totalCount from $table WHERE deleted != 1 ";
        if($condition){
            $query .= " AND ".$condition;
        }
        return executeCountQuery($query);
    }
    function getQueryData($select, $table, $condition = null){
        $query    = "SELECT $select from $table";
        if($condition)
            $query .= " WHERE ".$condition;
        return executeQuery($query);
    }
    function executeCountQuery($query){
        $result = $GLOBALS['db']->query($query);
        $total = $GLOBALS['db']->fetchByAssoc($result);
        if($total) {
            return $total['totalCount'];
        } else {
            return 0;
        }
    }
    function executeQuery($query){
        $result = $GLOBALS['db']->query($query);
        $data = $GLOBALS['db']->fetchByAssoc($result);
        if(!empty($data))
            return $data['name'];
    }
    function getQuery($select, $table, $condition = null){
        $query    = "SELECT $select from $table";
        if($condition)
            $query .= " WHERE ".$condition;
        return $GLOBALS['db']->query($query);
    }

    function getClosedCounts($type = null, $day, $userID, $closure) {
        $query = "SELECT count(*) as close_count FROM opportunities o LEFT JOIN opportunities_cstm oc ON o.id = oc.id_c WHERE o.deleted != 1 AND o.date_entered >= now() - interval '$day' day AND oc.status_c='Closed' AND oc.closure_status_c ='$closure' ";
        if ($type) {
            if ($type == 'team') {
                $query .= "AND assigned_user_id IN (SELECT id_c FROM users_cstm WHERE teamfunction_c = (SELECT teamfunction_c FROM users_cstm WHERE id_c = '$userID'))";
            } else if ($type == 'self') {
                $query .= "AND created_by='$userID'";
            }
        } 
        $result = $GLOBALS['db']->query($query);
        $res = $GLOBALS['db']->fetchByAssoc($result);
        $closed_count = $res['close_count'];

        return $closed_count;
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
        
        $budget_head_c_min              = @$_GET['filter-budget_head_c_min'];
        $budget_head_c_max              = @$_GET['filter-budget_head_c_max'];

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
            $closedDateFrom = $_GET['filter-closed-date-from'];
            $closedDateTo   = $_GET['filter-closed-date-to'];

            $dateFrom = explode('/', $closedDateFrom);
            $closedDateFrom = $dateFrom[2].'-'.$dateFrom[1].'-'.$dateFrom[0];

            $dateTo = explode('/', $closedDateTo);
            $closedDateTo = $dateTo[2].'-'.$dateTo[1].'-'.$dateTo[0];

            $fetch_query    .= " AND DATE(opportunities.date_modified) BETWEEN '$closedDateFrom' AND '$closedDateTo' ";
        }
        if(isset( $_GET['filter'] ) && @$_GET['filter-created-date-from'] && @$_GET['filter-created-date-to']){
            $createdDateFrom    = $_GET['filter-created-date-from'];
            $createdDateTo      = $_GET['filter-created-date-to'];

            $dateFrom = explode('/', $createdDateFrom);
            $createdDateFrom = $dateFrom[2].'-'.$dateFrom[1].'-'.$dateFrom[0];

            $dateTo = explode('/', $createdDateTo);
            $createdDateTo = $dateTo[2].'-'.$dateTo[1].'-'.$dateTo[0];

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
            $dateFrom = explode('/', $scope_budget_projected_c_from);
            $scope_budget_projected_c_from = $dateFrom[2].'-'.$dateFrom[1].'-'.$dateFrom[0];

            $dateTo = explode('/', $scope_budget_projected_c_to);
            $scope_budget_projected_c_to = $dateTo[2].'-'.$dateTo[1].'-'.$dateTo[0];
            
            $fetch_query .= " AND DATE(opportunities_cstm.scope_budget_projected_c) BETWEEN '$scope_budget_projected_c_from' AND '$scope_budget_projected_c_to' ";
        }

        if($rfp_eoi_projected_c_from && $rfp_eoi_projected_c_to){
            $dateFrom = explode('/', $rfp_eoi_projected_c_from);
            $rfp_eoi_projected_c_from = $dateFrom[2].'-'.$dateFrom[1].'-'.$dateFrom[0];

            $dateTo = explode('/', $rfp_eoi_projected_c_to);
            $rfp_eoi_projected_c_to = $dateTo[2].'-'.$dateTo[1].'-'.$dateTo[0];

            $fetch_query .= " AND DATE(opportunities_cstm.rfp_eoi_projected_c) BETWEEN '$rfp_eoi_projected_c_from' AND '$rfp_eoi_projected_c_to' ";
        }
        if($rfp_eoi_published_projected_c_from && $rfp_eoi_published_projected_c_to){
            $dateFrom = explode('/', $rfp_eoi_published_projected_c_from);
            $rfp_eoi_published_projected_c_from = $dateFrom[2].'-'.$dateFrom[1].'-'.$dateFrom[0];

            $dateTo = explode('/', $rfp_eoi_published_projected_c_to);
            $rfp_eoi_published_projected_c_to = $dateTo[2].'-'.$dateTo[1].'-'.$dateTo[0];

            $fetch_query .= " AND DATE(opportunities_cstm.rfp_eoi_published_projected_c) BETWEEN '$rfp_eoi_published_projected_c_from' AND '$rfp_eoi_published_projected_c_to' ";
        }

        if($work_order_projected_c_from && $work_order_projected_c_to){
            $dateFrom = explode('/', $work_order_projected_c_from);
            $work_order_projected_c_from = $dateFrom[2].'-'.$dateFrom[1].'-'.$dateFrom[0];

            $dateTo = explode('/', $work_order_projected_c_to);
            $work_order_projected_c_to = $dateTo[2].'-'.$dateTo[1].'-'.$dateTo[0];

            $fetch_query .= " AND DATE(opportunities_cstm.work_order_projected_c) BETWEEN '$work_order_projected_c_from' AND '$work_order_projected_c_to' ";
        }

        if($budget_head_c_min && $budget_head_c_max){
            $fetch_query .= " AND opportunities_cstm.budget_head_c BETWEEN '$budget_head_c_min' AND '$budget_head_c_max' ";
        }
        
        if($budget_allocated_oppertunity_c_min && $budget_allocated_oppertunity_c_max){
            $fetch_query .= " AND opportunities_cstm.budget_allocated_oppertunity_c BETWEEN '$budget_allocated_oppertunity_c_min' AND '$budget_allocated_oppertunity_c_max' ";
        }
        
        if($project_implementation_start_c_from && $project_implementation_start_c_to){
            $dateFrom = explode('/', $project_implementation_start_c_from);
            $project_implementation_start_c_from = $dateFrom[2].'-'.$dateFrom[1].'-'.$dateFrom[0];

            $dateTo = explode('/', $project_implementation_start_c_to);
            $project_implementation_start_c_to = $dateTo[2].'-'.$dateTo[1].'-'.$dateTo[0];

            $fetch_query .= " AND DATE(opportunities_cstm.project_implementation_start_c) BETWEEN '$project_implementation_start_c_from' AND '$project_implementation_start_c_to' ";
        }
        
        if($project_implementation_end_c_from && $project_implementation_end_c_to){
            $dateFrom = explode('/', $project_implementation_end_c_from);
            $project_implementation_end_c_from = $dateFrom[2].'-'.$dateFrom[1].'-'.$dateFrom[0];

            $dateTo = explode('/', $project_implementation_end_c_to);
            $project_implementation_end_c_to = $dateTo[2].'-'.$dateTo[1].'-'.$dateTo[0];

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

    function getActivityRelatedTo($type, $id){
        switch($type){
            case 'Accounts':
                $data = getQueryData('name', 'accounts', 'id = "'.$id.'"');
                break;
            case 'Opportunities':
                $data = getQueryData('name', 'opportunities', 'id = "'.$id.'"');
                break;
            case 'Calls':
                $data = getQueryData('name', 'calls', 'id = "'.$id.'"');
                break;
            default:
                $data = '';
                break;
        }
        return $data;
    }

    function getActivityFilterQuery(){
        global $current_user;
        $log_in_user_id = $current_user->id;

        $fetch_query = '';

        if( isset( $_GET['filter'] ) && isset( $_GET['filter-name'] ) && $_GET['filter-name'] ){
            $name           = $_GET['filter-name'] ?? '';
            $fetch_query    .= " AND calls.name LIKE '%$name%' ";
        }
        if( isset( $_GET['filter'] ) && isset( $_GET['filter-related_to'] ) && $_GET['filter-related_to'] ){
            $relatedTo      = $_GET['filter-related_to'] ?? '';
            $fetch_query    .= " AND calls.parent_type = '$relatedTo' ";
        }
        if( isset( $_GET['filter'] ) && isset( $_GET['filter-status'] ) && $_GET['filter-status'] ){
            $status         = $_GET['filter-status'] ?? '';
            $fetch_query    .= " AND calls_cstm.status_new_c = '$status' ";
        }
        if( isset( $_GET['filter'] ) && ( isset( $_GET['filter-activity_date_c_from'] ) || isset( $_GET['filter-activity_date_c_to'] ) ) && $_GET['filter-activity_date_c_from'] && $_GET['filter-activity_date_c_to'] ){
            $activityDateFrom   = date_format_helper($_GET['filter-activity_date_c_from']) ?? '';
            $activityDateTo     = date_format_helper($_GET['filter-activity_date_c_to']) ?? '';
            $fetch_query        .= " AND DATE(calls_cstm.activity_date_c) BETWEEN '$activityDateFrom' AND '$activityDateTo' ";
        }
        if( isset( $_GET['filter'] ) && ( isset( $_GET['filter-date_modified_from'] ) || isset( $_GET['filter-date_modified_to'] ) ) && $_GET['filter-date_modified_from'] && $_GET['filter-date_modified_to'] ){
            $activityDateFrom   = date_format_helper($_GET['filter-date_modified_from']) ?? '';
            $activityDateTo     = date_format_helper($_GET['filter-date_modified_to']) ?? '';
            $fetch_query        .= " AND DATE(calls.date_modified) BETWEEN '$activityDateFrom' AND '$activityDateTo' ";
        }
        if( isset( $_GET['filter'] ) && isset( $_GET['filter-assigned_to_c'] ) && $_GET['filter-assigned_to_c'] ){
            $assignedTo      = $_GET['filter-assigned_to_c'] ?? '';
            $fetch_query    .= " AND calls.assigned_user_id = '$assignedTo' ";
        }
        if( isset( $_GET['filter'] ) && isset( $_GET['filter-new_current_status_c'] ) && $_GET['filter-new_current_status_c'] ){
            $comments       = $_GET['filter-new_current_status_c'] ?? '';
            $fetch_query    .= " AND calls_cstm.new_current_status_c = '$comments' ";
        }
        if( isset( $_GET['filter'] ) && isset( $_GET['filter-description'] ) && $_GET['filter-description'] ){
            $description     = $_GET['filter-description'] ?? '';
            $fetch_query    .= " AND calls.description LIKE '%$description%' ";
        }
        if( isset( $_GET['filter'] ) && isset( $_GET['filter-new_key_action_c'] ) && $_GET['filter-new_key_action_c'] ){
            $newKeyAction   = $_GET['filter-new_key_action_c'] ?? '';
            $fetch_query    .= " AND calls_cstm.new_key_action_c = '$newKeyAction' ";
        }
        if( isset( $_GET['filter'] ) && isset( $_GET['filter-non_financial_consideration_c'] ) && $_GET['filter-non_financial_consideration_c'] ){
            $nonFinancial   = $_GET['filter-non_financial_consideration_c'] ?? '';
            $fetch_query    .= " AND calls_cstm.non_financial_consideration_c = '$nonFinancial' ";
        }
        if( isset( $_GET['filter'] ) && isset( $_GET['filter-audit_trail_c'] ) && $_GET['filter-audit_trail_c'] ){
            $auditTrial   = $_GET['filter-audit_trail_c'] ?? '';
            $fetch_query    .= " AND calls_cstm.audit_trail_c = '$auditTrial' ";
        }
        if( isset( $_GET['filter'] ) && isset( $_GET['filter-approver_c'] ) && $_GET['filter-approver_c'] ){
            $approver       = $_GET['filter-approver_c'] ?? '';
            $fetch_query    .= " AND calls_cstm.user_id_c = '$approver' ";
        }
        if( isset( $_GET['filter'] ) && ( isset( $_GET['filter-next_date_c_from'] ) || isset( $_GET['filter-next_date_c_to'] ) ) && $_GET['filter-next_date_c_from'] && $_GET['filter-next_date_c_to'] ){
            $nextDateFrom   = date_format_helper($_GET['filter-next_date_c_from']) ?? '';
            $nextDateTo     = date_format_helper($_GET['filter-next_date_c_to']) ?? '';
            $fetch_query    .= " AND DATE(calls_cstm.next_date_c) BETWEEN '$nextDateFrom' AND '$nextDateTo' ";
        }
        if( isset( $_GET['filter'] ) && isset( $_GET['filter-name_of_person_c'] ) && $_GET['filter-name_of_person_c'] ){
            $contactPerson  = $_GET['filter-name_of_person_c'] ?? '';
            $fetch_query    .= " AND calls_cstm.name_of_person_c = '$contactPerson' ";
        }
        
        return $fetch_query;
    }