<?php

global $current_user;

$acc_id_show = [];

// Get all the activities with user lineages
$acc_id = getAllActivities();

// Check if the current user is Admin or MC
if($current_user->is_admin || isMC()){
    $acc_id_show = $acc_id;
}
else{
    // Check if the current user is TL or not
    if(checkUserType() == 'team_lead'){
        // Get the activities which is created by logged in TL along with under his users data
        $acc_id_show = getTLActivities(); 
    }
    else{
        // get other activities if user is not TL
        $acc_id_show = getOtherActivities();
    }
}


$popupMeta = 
array (
  'moduleMain' => 'Calls',
  'varName' => 'Call',
  'orderBy' => 'calls.name',
  'whereClauses' => 
  array (
    'name' => 'calls.name',
  ),
  'whereStatement' => "calls.id  IN ('".implode("','",$acc_id_show)."') ",
  'searchInputs' => 
  array (
    0 => 'calls_number',
    1 => 'name',
    2 => 'priority',
    3 => 'status',
  ),
);
;


// Required functions ------------------------>
// Function to get all the activities
function getAllActivities(){

    $sql = "SELECT
                calls.id,
                calls.assigned_user_id,
                calls_cstm.activity_type_c,
                calls_cstm.user_id_c AS approvers,
                calls_cstm.tag_hidden_c AS tagged_users_id,
                calls_cstm.delegate_id AS delegate_id,
                users_cstm.user_lineage as lineage
            FROM
                calls
            INNER JOIN calls_cstm ON
                calls_cstm.id_c = calls.id
            LEFT JOIN users_cstm ON
                users_cstm.id_c = calls.assigned_user_id
            WHERE
                calls.deleted = 0";
    
    $result = $GLOBALS['db']->query($sql);

    $activities = [];
        
    while($row = $GLOBALS['db']->fetchByAssoc($result) ){
        $activities[] = $row['id'];
    }

    return $activities;
}

// Function to get all global activities
function getGlobalActivities(){
    $sql = "SELECT
                calls.id,
                calls.assigned_user_id,
                calls_cstm.activity_type_c,
                calls_cstm.user_id_c AS approvers,
                calls_cstm.tag_hidden_c AS tagged_users_id,
                calls_cstm.delegate_id AS delegate_id,
                users_cstm.user_lineage as lineage
            FROM
                calls
            INNER JOIN calls_cstm ON
                calls_cstm.id_c = calls.id
            LEFT JOIN users_cstm ON
                users_cstm.id_c = calls.assigned_user_id
            WHERE
                calls.deleted = 0
            AND
                calls_cstm.activity_type_c = 'global'";
    
    $result = $GLOBALS['db']->query($sql);

    $activities = [];
        
    while($row = $GLOBALS['db']->fetchByAssoc($result) ){
        $activities[] = $row['id'];
    }

    return $activities;
}

// Function to check if the logged in user is MC or not
function isMC(){
    global $current_user;

    $sql_mc="SELECT
                    COUNT(*) as mc
                FROM
                    `users_cstm`
                LEFT JOIN users ON
                    users_cstm.id_c = users.id
                WHERE
                    `mc_c` = 'yes'
                    AND users.deleted = 0
                    AND id_c = '$current_user->id'";
    
    $result_mc = $GLOBALS['db']->query($sql_mc);
    $is_mc = 0;

    while($row_mc = $GLOBALS['db']->fetchByAssoc($result_mc) ){
        $is_mc = $row_mc['mc'];
    }
    return $is_mc;
}

// Function to check legged in user's type
function checkUserType(){
    global $current_user;

    $sql = "SELECT
                teamheirarchy_c
            FROM
                users_cstm
            WHERE
                id_c = '$current_user->id';";

    $result = $GLOBALS['db']->query($sql);

    $user = '';
    while($row = $GLOBALS['db']->fetchByAssoc($result) ){
        $user = $row['teamheirarchy_c'];
    }
    return $user;
} 

// Function to get all tagged activities
function getTaggedActivities(){
    global $current_user;

    $sql = "SELECT
                calls.id,
                calls.assigned_user_id,
                calls_cstm.activity_type_c,
                calls_cstm.user_id_c AS approvers,
                calls_cstm.tag_hidden_c AS tagged_users_id,
                calls_cstm.delegate_id AS delegate_id,
                users_cstm.user_lineage as lineage
            FROM
                calls
            INNER JOIN calls_cstm ON
                calls_cstm.id_c = calls.id
            LEFT JOIN users_cstm ON
                users_cstm.id_c = calls.assigned_user_id
            WHERE
                calls.deleted = 0
            AND
                FIND_IN_SET('$current_user->id', calls_cstm.tag_hidden_c)";
    
    $result = $GLOBALS['db']->query($sql);

    $activities = [];
        
    while($row = $GLOBALS['db']->fetchByAssoc($result) ){
        $activities[] = $row['id'];
    }

    return $activities;
}

// Function to get the activities which is created by logged in TL along with under his users data
function getTLActivities(){
    global $current_user;

    $acc_ids = [];

    // Get activities which are tagged to logged in user
    $acc_ids = getTaggedActivities();

    // Get the activities created by logged in TL
    $sql = "SELECT
                calls.id,
                calls.assigned_user_id,
                calls_cstm.activity_type_c,
                calls_cstm.user_id_c AS approvers,
                calls_cstm.tag_hidden_c AS tagged_users_id,
                calls_cstm.delegate_id AS delegate_id,
                users_cstm.user_lineage as lineage
            FROM
                calls
            INNER JOIN calls_cstm ON
                calls_cstm.id_c = calls.id
            LEFT JOIN users_cstm ON
                users_cstm.id_c = calls.assigned_user_id
            WHERE
                calls.deleted = 0
            AND (
                created_by = '$current_user->id'
                    OR 
                FIND_IN_SET('$current_user->id', calls.assigned_user_id)
                    OR
                FIND_IN_SET('$current_user->id', calls_cstm.user_id_c)
                    OR  
                FIND_IN_SET('$current_user->id', calls_cstm.tag_hidden_c)
                    OR
                FIND_IN_SET('$current_user->id', calls_cstm.delegate_id)
                    OR
                FIND_IN_SET('$current_user->id', users_cstm.user_lineage)
            )";
    
    $result = $GLOBALS['db']->query($sql);

    while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
        $acc_ids[] = $row['id'];
    }

    $global_activities = getGlobalActivities();

    $acc_ids = array_unique(array_merge($acc_ids, $global_activities));

    return $acc_ids;
}

// Function to get the activities which is created by logged in users
function getOtherActivities(){
    global $current_user;

    $acc_ids = [];
    // Get activities which are tagged to logged in user
    $acc_ids = getTaggedActivities();

    // Get logged in user's type
    $user_type = checkUserType();

    // If current user is L1
    if($user_type == 'team_member_l1' || $user_type == 'team_member_l2' || $user_type == 'team_member_l3'){
        $tl_id = getMyTL();

        $sql = "SELECT
                calls.id,
                calls.assigned_user_id,
                calls_cstm.activity_type_c,
                calls_cstm.user_id_c AS approvers,
                calls_cstm.tag_hidden_c AS tagged_users_id,
                calls_cstm.delegate_id AS delegate_id,
                users_cstm.user_lineage as lineage
            FROM
                calls
            INNER JOIN calls_cstm ON
                calls_cstm.id_c = calls.id
            LEFT JOIN users_cstm ON
                users_cstm.id_c = calls.assigned_user_id
            WHERE
                calls.deleted = 0
            AND (
                created_by = '$tl_id'
                    OR 
                FIND_IN_SET('$tl_id', calls.assigned_user_id)
                    OR
                FIND_IN_SET('$tl_id', calls_cstm.user_id_c)
                    OR  
                FIND_IN_SET('$tl_id', calls_cstm.tag_hidden_c)
                    OR
                FIND_IN_SET('$tl_id', calls_cstm.delegate_id)
                    OR
                FIND_IN_SET('$tl_id', users_cstm.user_lineage)
            )
            AND ";

            if($user_type == 'team_member_l1'){

                $sql .= "(
                    users_cstm.teamheirarchy_c = 'team_member_l1'
                        OR
                    users_cstm.teamheirarchy_c = 'team_member_l2'
                        OR
                    users_cstm.teamheirarchy_c = 'team_member_l3'
                )";

            }
            if($user_type == 'team_member_l2'){
                $sql .= "(
                    users_cstm.teamheirarchy_c = 'team_member_l2'
                        OR
                    users_cstm.teamheirarchy_c = 'team_member_l3'
                )";
            }
            if($user_type == 'team_member_l3'){
                $sql .= "(
                    users_cstm.teamheirarchy_c = 'team_member_l3'
                )";
            }

        $result = $GLOBALS['db']->query($sql);

        while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
            $acc_ids[] = $row['id'];
        }
    }

    $global_activities = getGlobalActivities();

    $acc_ids = array_unique(array_merge($acc_ids, $global_activities));

    return $acc_ids;
}

// Function to get Logged In User's TL
function getMyTL(){
    global $current_user;

    $sql = "SELECT 
                SUBSTRING_INDEX(user_lineage, ',', -1) as id
            FROM 
                users_cstm 
            WHERE 
                id_c = '$current_user->id'";

    $result = $GLOBALS['db']->query($sql);

    $tl = [];
    while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
        $tl = $row['id'];
    }

    return $tl;
}
?>
