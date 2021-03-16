<?php 

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
class lineage
{

    function update_lineage($bean, $event, $arguments)
    {
        global $current_user;
    	$log_in_user_id = $current_user->id;
    	
    $users_id= $bean->id;
    $hierarchy=$bean->teamheirarchy_c;
    $reports_to=array();
    
    
     if($hierarchy=='team_lead'){
      
      $sql_r="SELECT reports_to_id FROM users WHERE id='".$users_id."'";
      $result_r = $GLOBALS['db']->query($sql_r);
  while ($row_r = mysqli_fetch_assoc($result_r)){
            
             array_push($reports_to,$row_r['reports_to_id']);
             
        }
             }
             
              else if($hierarchy=='team_member_l1'){
                  
                  $sql_r="SELECT reports_to_id FROM users WHERE id='".$users_id."'";
                  $result_r = $GLOBALS['db']->query($sql_r);
                  while ($row_r = mysqli_fetch_assoc($result_r)){
            
                         array_push($reports_to,$row_r['reports_to_id']);
             
             
                     }
              }
              else if($hierarchy=='team_member_l2'){
                  
                  $sql_r="SELECT reports_to_id FROM users WHERE id='".$users_id."'";
      $result_r = $GLOBALS['db']->query($sql_r);
  while ($row_r = mysqli_fetch_assoc($result_r)){
            
            $r=$row_r['reports_to_id'];
             array_push($reports_to,$row_r['reports_to_id']);
             
              $sql_r1="SELECT reports_to_id FROM users WHERE id='".$r."'";
      $result_r1 = $GLOBALS['db']->query($sql_r1);
  while ($row_r1 = mysqli_fetch_assoc($result_r1)){
            
            $r1=$row_r1['reports_to_id'];
             array_push($reports_to,$row_r1['reports_to_id']);
             
             
        }
             
        }
                  
              }
              else if($hierarchy=='team_member_l3'){
                  
                  
                         $sql_r="SELECT reports_to_id FROM users WHERE id='".$users_id."'";
      $result_r = $GLOBALS['db']->query($sql_r);
  while ($row_r = mysqli_fetch_assoc($result_r)){
            
            $r=$row_r['reports_to_id'];
             array_push($reports_to,$row_r['reports_to_id']);
             
              $sql_r1="SELECT reports_to_id FROM users WHERE id='".$r."'";
      $result_r1 = $GLOBALS['db']->query($sql_r1);
  while ($row_r1 = mysqli_fetch_assoc($result_r1)){
            
            $r1=$row_r1['reports_to_id'];
             array_push($reports_to,$row_r1['reports_to_id']);
             
              $sql_r2="SELECT reports_to_id FROM users WHERE id='".$r1."'";
      $result_r2 = $GLOBALS['db']->query($sql_r2);
  while ($row_r2 = mysqli_fetch_assoc($result_r2)){
            
            $r2=$row_r2['reports_to_id'];
             array_push($reports_to,$row_r2['reports_to_id']);
             
             
        }
             
        }
             
        }
            
                  
                  
              }
              
              $reports=implode(',',$reports_to);
              
              $update_sql='UPDATE users_cstm SET user_lineage="'.$reports.'" WHERE id_c="'.$users_id.'"';
              
              $GLOBALS['db']->query($update_sql);
			
			
                    
             
            
}}