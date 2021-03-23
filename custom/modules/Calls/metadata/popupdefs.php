<?php

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


$sql_opp="SELECT calls.id,calls.assigned_user_id,calls_cstm.activity_type_c,calls_cstm.user_id_c AS approvers,calls_cstm.tag_hidden_c AS tagged_users_id,calls_cstm.delegate_id AS delegate_id,users_cstm.user_lineage as lineage FROM calls INNER JOIN calls_cstm ON calls_cstm.id_c=calls.id LEFT JOIN users_cstm ON users_cstm.id_c = calls.assigned_user_id WHERE calls.deleted=0";

$result_opp = $GLOBALS['db']->query($sql_opp);


while($row_opp = $GLOBALS['db']->fetchByAssoc($result_opp) ){
  $acc_id[]=$row_opp['id'];
  $assigned_user_id[]=$row_opp['assigned_user_id'];
  $multiple_approver_id[]=$row_opp['approvers'];
  $lineage[]=$row_opp['lineage'];
  $tagged_users[]=$row_opp['tagged_users_id'];
  $acc_type[]=$row_opp['activity_type_c'];
  $delegte_id[]=$row_opp['delegate_id'];
}


$sql_bid="SELECT id_c FROM `users_cstm` LEFT JOIN users ON users_cstm.id_c=users.id WHERE `bid_commercial_head_c`='commercial_team_head' OR `bid_commercial_head_c`='bid_team_head' AND users.deleted=0";


$result_bid = $GLOBALS['db']->query($sql_bid);

while($row_bid = $GLOBALS['db']->fetchByAssoc($result_bid) ){
  $bid_commercial_id[]=$row_bid['id_c'];
}

$sql_mc="SELECT id_c FROM `users_cstm` LEFT JOIN users ON users_cstm.id_c=users.id WHERE `mc_c`='yes' AND users.deleted=0";


$result_mc = $GLOBALS['db']->query($sql_mc);

while($row_mc = $GLOBALS['db']->fetchByAssoc($result_mc) ){
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

      if( in_array($login_user_id,explode(',',$tagged_users[$i])) || in_array($login_user_id,explode(',',$lineage[$i])) || in_array($login_user_id,explode(',',$multiple_approver_id[$i])) || in_array($login_user_id,explode(',',$assigned_user_id[$i])) || $login_user_id== $delegte_id[$i] ){
          array_push($acc_id_show,$acc_id[$i]);               
        }
                   
    }
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
?>
