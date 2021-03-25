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
        $user_manager = get_user_manager();
        if ($type) {
            if ($type == 'team') {
                $query .= " AND assigned_user_id IN (
                    SELECT id_c FROM users_cstm WHERE user_lineage LIKE '%$user_manager%' OR id_c ='$user_manager' 
                ) ";
            } else if ($type == 'self') {
                $query .= "AND created_by='$userID'";
            }
        } 
        $result = $GLOBALS['db']->query($query);
        $res = $GLOBALS['db']->fetchByAssoc($result);
        $closed_count = $res['close_count'];

        return $closed_count;
    }
    function get_user_manager() {
        global $current_user; 
        $log_in_user_id = $current_user->id;
        $user_manager = '';
            $result2 = getDbData('users_cstm', '*', "id_c = '$log_in_user_id' ");
            foreach($result2 as $s){
                $teamHierarchy = $s['teamheirarchy_c'];
                if ($teamHierarchy == 'team_lead') {
                    $user_manager = $log_in_user_id;
                } else {
                    if (strpos($s['user_lineage'], ',') !== false) {
                        $user_manager = explode(",", $s['user_lineage']);
                        $user_manager = end($user_manager);
                    } else {
                        $user_manager = $s['user_lineage'];
                    }
                }
            }
            return $user_manager;
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
    function private_opps() {
        global $current_user;
        
        $login_user_id=$current_user->id;
            
        $opp_id=array();
        $assigned_user_id = array();
        $multiple_approver_id = array();
        $lineage = array();
        $tagged_users=array();
        $opp_type= array();
        $opp_id_show=array();
        $bid_commercial_id=array();
        $mc_id=array();

        // Assigned_user
        // Multiple approver
        // Lineage
        // Tagged_user
        // Delegate


        //

        $sql_opp="SELECT opportunities.id,opportunities.assigned_user_id,opportunities.opportunity_type,opportunities_cstm.multiple_approver_c AS approvers,tagged_user.user_id AS tagged_users_id, users_cstm.user_lineage as lineage 
        FROM opportunities INNER JOIN opportunities_cstm ON opportunities_cstm.id_c=opportunities.id LEFT JOIN tagged_user ON tagged_user.opp_id = opportunities.id LEFT JOIN users_cstm ON users_cstm.id_c = opportunities.assigned_user_id 
        WHERE opportunities.deleted=0";
        $result_opp = $GLOBALS['db']->query($sql_opp);
        
        while($row_opp = $GLOBALS['db']->fetchByAssoc($result_opp) )
        {
            $opp_id[]=$row_opp['id'];
            $assigned_user_id[]=$row_opp['assigned_user_id'];
            $multiple_approver_id[]=$row_opp['approvers'];
            $lineage[]=$row_opp['lineage'];
            $tagged_users[]=$row_opp['tagged_users_id'];
            $opp_type[]=$row_opp['opportunity_type'];
        }
        $sql_bid="SELECT id_c FROM `users_cstm` LEFT JOIN users ON users_cstm.id_c=users.id WHERE `bid_commercial_head_c`='commercial_team_head' OR `bid_commercial_head_c`='bid_team_head' AND users.deleted=0";
        $result_bid = $GLOBALS['db']->query($sql_bid);
    
        while($row_bid = $GLOBALS['db']->fetchByAssoc($result_bid) )
        {
            $bid_commercial_id[]=$row_bid['id_c'];
            
        }
        $sql_mc="SELECT id_c FROM `users_cstm` LEFT JOIN users ON users_cstm.id_c=users.id WHERE `mc_c`='yes' AND users.deleted=0";
        $result_mc = $GLOBALS['db']->query($sql_mc);
        
        while($row_mc = $GLOBALS['db']->fetchByAssoc($result_mc) )
        {
            $mc_id[]=$row_mc['id_c'];
            
        }
        if(in_array($login_user_id,$mc_id) || $current_user->is_admin==1){ 
            $opp_id_show=$opp_id;
        }
        else{
                    
            for($i=0;$i<count($opp_id);$i++){
                
                if($opp_type[$i]=='non_global'){

                    if( in_array($login_user_id,explode(',',$tagged_users[$i])) || in_array($login_user_id,explode(',',$lineage[$i])) || in_array($login_user_id,explode(',',$multiple_approver_id[$i])) || in_array($login_user_id,explode(',',$assigned_user_id[$i]))  ) {
                    
                    
                            array_push($opp_id_show,$opp_id[$i]);
                            
                    }
                    
                    
                }
            }
            
        }
        return $opp_id_show;
    }
    function private_activities() {
        global $current_user;
            
        $login_user_id=$current_user->id;
            
        $acc_id=array();
            
        $assigned_user_id = array();
        $multiple_approver_id = array();
        $lineage = array();
        $tagged_users=array();
        $acc_type= array();
        $acc_id_show=array();
        $bid_commercial_id=array();
        $mc_id=array();
        $delegte_id=array();
       
       
     
        $sql_opp="SELECT calls.id,calls.assigned_user_id,calls_cstm.activity_type_c,calls_cstm.user_id_c AS approvers,calls_cstm.tag_hidden_c AS tagged_users_id, users_cstm.user_lineage as lineage FROM calls INNER JOIN calls_cstm ON calls_cstm.id_c=calls.id LEFT JOIN users_cstm ON users_cstm.id_c = calls.assigned_user_id WHERE calls.deleted=0";
            $result_opp = $GLOBALS['db']->query($sql_opp);
            
            while($row_opp = $GLOBALS['db']->fetchByAssoc($result_opp) )
                {
                $acc_id[]=$row_opp['id'];
                $assigned_user_id[]=$row_opp['assigned_user_id'];
                $multiple_approver_id[]=$row_opp['approvers'];
                $lineage[]=$row_opp['lineage'];
                $tagged_users[]=$row_opp['tagged_users_id'];
                $acc_type[]=$row_opp['activity_type_c'];
                
                }
                
            //	echo json_encode($tagged_users);
                $sql_bid="SELECT id_c FROM `users_cstm` LEFT JOIN users ON users_cstm.id_c=users.id WHERE `bid_commercial_head_c`='commercial_team_head' OR `bid_commercial_head_c`='bid_team_head' AND users.deleted=0";
            $result_bid = $GLOBALS['db']->query($sql_bid);
            
            while($row_bid = $GLOBALS['db']->fetchByAssoc($result_bid) )
                {
                $bid_commercial_id[]=$row_bid['id_c'];
                
                }
                $sql_mc="SELECT id_c FROM `users_cstm` LEFT JOIN users ON users_cstm.id_c=users.id WHERE `mc_c`='yes' AND users.deleted=0";
            $result_mc = $GLOBALS['db']->query($sql_mc);
            
            while($row_mc = $GLOBALS['db']->fetchByAssoc($result_mc) )
                {
                $mc_id[]=$row_mc['id_c'];
                
                }
                
            
                
                if(in_array($login_user_id,$mc_id) || $current_user->is_admin==1){
                    
                
                    
                    $acc_id_show=$acc_id;
                }
                else{
                            
                
                    
                    for($i=0;$i<count($acc_id);$i++){
                        
                    
                        if($acc_type[$i]=='global'){
                            array_push($acc_id_show,$acc_id[$i]);
                        }
                        if($acc_type[$i]=='non_global'){
                            
                            
                        

                            if( in_array($login_user_id,explode(',',$tagged_users[$i])) || in_array($login_user_id,explode(',',$lineage[$i])) || in_array($login_user_id,explode(',',$multiple_approver_id[$i])) || in_array($login_user_id,explode(',',$assigned_user_id[$i]))  ) {
                            
                        
                            
                                array_push($acc_id_show,$acc_id[$i]);
                                
                            }
                            
                        
                        }
                    }
                    
                    
                }
        return $acc_id_show;
    }

    function private_documents() {
        global $current_user;
            
        $login_user_id=$current_user->id;
            
        $doc_id=array();
            
        $assigned_user_id = array();
        $multiple_approver_id = array();
        $lineage = array();
        $tagged_users=array();
        $doc_type= array();
        $doc_id_show=array();
        $bid_commercial_id=array();
        $mc_id=array();
        $delegte_id=array();
       
       
     
        $sql_opp="SELECT documents.id,documents.assigned_user_id,documents_cstm.document_visibility_c,documents_cstm.user_id_c AS approvers,documents_cstm.tagged_hidden_c AS tagged_users_id, users_cstm.user_lineage as lineage FROM documents INNER JOIN documents_cstm ON documents_cstm.id_c=documents.id LEFT JOIN users_cstm ON users_cstm.id_c = documents.assigned_user_id WHERE documents.deleted=0";
            $result_opp = $GLOBALS['db']->query($sql_opp);
            
            while($row_opp = $GLOBALS['db']->fetchByAssoc($result_opp) )
                {
                $doc_id[]=$row_opp['id'];
                $assigned_user_id[]=$row_opp['assigned_user_id'];
                $multiple_approver_id[]=$row_opp['approvers'];
                $lineage[]=$row_opp['lineage'];
                $tagged_users[]=$row_opp['tagged_users_id'];
                $doc_type[]=$row_opp['document_visibility_c'];
                
                }
                
            //	echo json_encode($tagged_users);
            $sql_bid="SELECT id_c FROM `users_cstm` LEFT JOIN users ON users_cstm.id_c=users.id WHERE `bid_commercial_head_c`='commercial_team_head' OR `bid_commercial_head_c`='bid_team_head' AND users.deleted=0";
            $result_bid = $GLOBALS['db']->query($sql_bid);
            
            while($row_bid = $GLOBALS['db']->fetchByAssoc($result_bid) )
                {
                $bid_commercial_id[]=$row_bid['id_c'];
                
                }

            $sql_mc="SELECT id_c FROM `users_cstm` LEFT JOIN users ON users_cstm.id_c=users.id WHERE `mc_c`='yes' AND users.deleted=0";
            $result_mc = $GLOBALS['db']->query($sql_mc);
            
            while($row_mc = $GLOBALS['db']->fetchByAssoc($result_mc) )
                {
                $mc_id[]=$row_mc['id_c'];
                
                }
                
            
                
                if(in_array($login_user_id,$mc_id) || $current_user->is_admin==1){
                    $doc_id_show=$doc_id;
                }
                else{
                            
                
                    
                    for($i=0;$i<count($doc_id);$i++){
                        
                    
                        if($doc_type[$i]=='global'){
                            array_push($doc_id_show,$doc_id[$i]);
                        }
                        if($doc_type[$i]=='non_global'){
                            
                            
                        

                            if( in_array($login_user_id,explode(',',$tagged_users[$i])) || in_array($login_user_id,explode(',',$lineage[$i])) || in_array($login_user_id,explode(',',$multiple_approver_id[$i])) || in_array($login_user_id,explode(',',$assigned_user_id[$i]))  ) {
                            
                        
                            
                                array_push($doc_id_show,$doc_id[$i]);
                                
                            }
                            
                        
                        }
                    }
                    
                    
                }
        return $doc_id_show;
    }

    function getDocumentFilterQuery(){
        global $current_user;
        $log_in_user_id = $current_user->id;

        $fetch_query = '';
        
        if( isset( $_GET['filter'] ) && isset( $_GET['filter-name'] ) && $_GET['filter-name'] ){
            $name           = $_GET['filter-name'] ?? '';
            $fetch_query    .= " AND documents.document_name LIKE '%$name%' ";
        }
        if( isset( $_GET['filter'] ) && isset( $_GET['filter-related_to'] ) && $_GET['filter-related_to'] ){
            $relatedTo      = $_GET['filter-related_to'] ?? '';
            $fetch_query    .= " AND documents_cstm.parent_type = '$relatedTo' ";
        }
        if( isset( $_GET['filter'] ) && isset( $_GET['filter-document_type'] ) && $_GET['filter-document_type'] ){
            $document_type         = $_GET['filter-document_type'] ?? '';
            $fetch_query    .= " AND documents.template_type = '$document_type' ";
        }
        if( isset( $_GET['filter'] ) && isset( $_GET['filter-category'] ) && $_GET['filter-category'] ){
            $category         = $_GET['filter-category'] ?? '';
            $fetch_query    .= " AND documents_cstm.category_c = '$category' ";
        }
        if( isset( $_GET['filter'] ) && isset( $_GET['filter-sub_category'] ) && $_GET['filter-sub_category'] ){
            $sub_category         = $_GET['filter-sub_category'] ?? '';
            $fetch_query    .= " AND documents_cstm.sub_category_c = '$sub_category' ";
        }
        if( isset( $_GET['filter'] ) && isset( $_GET['filter-uploaded-by'] ) && $_GET['filter-uploaded-by'] ){
            $assignedTo      = $_GET['filter-uploaded-by'] ?? '';
            $fetch_query .= " AND (";
            foreach($assignedTo as $key => $res){
                if($key){
                    $fetch_query .= " OR ";
                    $fetch_query .= " documents.created_by = '$res' ";
                }
                else {
                    $fetch_query .= " documents.created_by = '$res' ";
                }
            }
            $fetch_query .= " )";
        }
        
        return $fetch_query;
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
                    $a = $arr[0];
                    $fetch_query .= " opportunities.assigned_user_id IN 
                    (SELECT id_c FROM users_cstm WHERE user_lineage LIKE '%$a%' OR id_c = '$a') ";
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
    function getDocumentRelatedTo($type, $id){
        $data = '' ; 
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
            case 'Documents':
                $data = getQueryData('document_name AS name', 'documents', 'id = "'.$id.'"');
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
        if( isset( $_GET['filter'] ) && isset( $_GET['filter-related_to_new'] ) && $_GET['filter-related_to_new'] ){
            $relatedTo      = $_GET['filter-related_to_new'] ?? '';
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
            $fetch_query .= " AND (";
            foreach($assignedTo as $key => $res){
                if($key)
                    $fetch_query .= " OR ";
                if (strpos($res, 'andTeam') !== false) {
                    $arr = explode('andTeam',$res,0);
                    $arr[0] = chop($arr[0],"andTeam");
                    $a = $arr[0];
                    $fetch_query .= " calls.assigned_user_id IN 
                    (SELECT id_c FROM users_cstm WHERE user_lineage LIKE '%$a%' OR id_c = '$a') ";
                } else {
                    $fetch_query .= " calls.assigned_user_id = '$res' ";
                }
            }
            $fetch_query .= " )";
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
    function beautify_test($string){
        $string = str_replace("^","",$string);
        $re = '/(?#! splitCamelCase Rev:20140412)
        # Split camelCase "words". Two global alternatives. Either g1of2:
          (?<=[a-z])      # Position is after a lowercase,
          (?=[A-Z])       # and before an uppercase letter.
        | (?<=[A-Z])      # Or g2of2; Position is after uppercase,
          (?=[A-Z][a-z])  # and before upper-then-lower case.
        /x';
        $a = preg_split($re, $string);
        return implode(' ',$a);;
    }



    ///  ::::::::::::::::::::::::::::::::::::::::::::::::::::::  Joytrimoy Code ::::::::::::::::::::::::::::::::::::::::::::::::::


    function is_tagging_applicable($type, $id) {
        try {
            global $current_user;
            $log_in_user_id = $current_user->id;
            $db = \DBManagerFactory::getInstance();
            $GLOBALS['db'];
            $team_func_array = $team_func_array1 = $others_id_array = $tagged_user_array = array();

            if($type == "opportunities") {
                $sql ='SELECT * FROM opportunities LEFT JOIN opportunities_cstm ON opportunities.id = opportunities_cstm.id_c WHERE opportunities.id="'. $id.'"';
                $result = $GLOBALS['db']->query($sql);
                while($row = $GLOBALS['db']->fetchByAssoc($result) )
                    {
                        $created_by=$row['assigned_user_id'];
                        $assigned=$row['assigned_user_id'];
                        $approver=$row['multiple_approver_c'];
                        $deligate = $row['delegate'];
                        $approver1=$row['user_id2_c'];
                    }
                $result5 = getQuery('user_id', 'tagged_user', 'opp_id = "'.$id.'"');    
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
            } else {

                if($type == "documents") {
                    $table1 = $type;
                    $table2 = $type."_cstm";
                    $tag_column = "tagged_hidden_c";
                } elseif ($type == "activities") {
                    $table1 = "calls";
                    $table2 = "calls_cstm";
                    $tag_column = "tag_hidden_c";
                } else {
                    return false;
                    die();
                }

                $sql ="SELECT ".$table1.".assigned_user_id, ".$table1.".created_by, ".$table2.".".$tag_column." FROM ".$table1." 
                LEFT JOIN ".$table2." ON ".$table1.".id = ".$table2.".id_c
                WHERE id ='$id' ";

                $result = $GLOBALS['db']->query($sql);
                $row = $result->fetch_assoc();

                if(strpos($row[$tag_column], ',') !== false) {
                    $tagged_user_array = explode(',',  $row[$tag_column]);
                } else {
                    $tagged_user_array = [$row[$tag_column]];
                }

                $document_creator = $row['created_by'];
                $user_id = $row['assigned_user_id'];

                $result1 = getQuery('user_lineage', 'users_cstm', 'id_c = "'.$user_id.'"');
                $row = $result1->fetch_assoc();
                if (strpos($row['user_lineage'], ',') !== false) {
                    $team_func_array = explode(',',  $row['user_lineage']);
                } else {
                    $team_func_array = [$row['user_lineage']];
                }
            }

            $sql3 = "SELECT users.id, users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '".$log_in_user_id."' AND users.deleted = 0";
            $result3 = $GLOBALS['db']->query($sql3);
            while($row3 = $GLOBALS['db']->fetchByAssoc($result3)) {
                $check_sales = $row3['teamfunction_c'];
                $check_mc = $row3['mc_c'];
                $check_team_lead = $row3['teamheirarchy_c'];
            }

            if($type == "opportunities") {
                if($check_mc =="yes"|| $log_in_user_id == $created_by || $log_in_user_id == "1"
                || in_array($log_in_user_id, $team_func_array1)||in_array($log_in_user_id, $others_id_array)  || in_array($log_in_user_id, $team_func_array) 
                || $log_in_user_id == $approver1 || $log_in_user_id == $assigned)
                {
                    return true;
                } else{
                    return false;
                }
            } else {
                if( $check_mc =="yes"||  $log_in_user_id == "1" || in_array($log_in_user_id, $team_func_array) || in_array($log_in_user_id, $tagged_user_array) ||  is_creator($document_creator, $log_in_user_id) == true ){
                    return true;
                } else {
                    return false;
                }
            }           
        } catch (Exception $e) {
            echo json_encode(array("status" => false, "message" => "Some error occured"));
        }
        die();    
    }


    function is_creator($creator_id, $logged_in_user_id) {
        if($creator_id == $logged_in_user_id) {
            return true;
        } else {
            return false;
        }
    }
    ///  ::::::::::::::::::::::::::::::::::::::::::::::::::::::  Joytrimoy Code ::::::::::::::::::::::::::::::::::::::::::::::::::

    function send_notification($module,$name,$description,$users,$redirectUrl){
        foreach($users as $id){
            $alert = BeanFactory::newBean('Alerts');
            $alert->name =$name;
            $alert->description = $description;
            $alert->url_redirect = $redirectUrl;
            $alert->target_module = $module;
            $alert->assigned_user_id = $id;
            $alert->type = 'info';
            $alert->is_read = 0;
            $alert->save();
        }
        
        // echo json_encode(array("status"=>true, "message" => "All Forms Saved Successfully and Email Sent to Business Head for Approval"));
    }

    function send_email($description,$emails,$subject){
        $template = $description;
        require_once('include/SugarPHPMailer.php');
        include_once('include/utils/db_utils.php');
        foreach($emails as $email) {
           $emailObj = new Email();  
           $defaults = $emailObj->getSystemDefaultEmail();  
           $mail = new SugarPHPMailer();  
           $mail->setMailerForSystem();  
           $mail->From = $defaults['email'];  
           $mail->FromName = $defaults['name'];  
           $mail->Subject = $subject;
           $mail->Body =$template;
           $mail->prepForOutbound();  
           $mail->AddAddress($email);
           @$mail->Send();
        }
    }
        
           
    
    function getUserEmail($userID){
        $user_email_fetch        = "SELECT user_name FROM users WHERE id='$userID'";
        $user_email_fetch_result = $GLOBALS['db']->query($user_email_fetch);
        $user_email_fetch_row    = $GLOBALS['db']->fetchByAssoc($user_email_fetch_result);
        $user_email              = $user_email_fetch_row['user_name'];
        return $user_email;
    }
    

        
