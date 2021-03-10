<?php 

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class updateHistory
{


    function after_save_method($bean, $event, $arguments)
    {
        global $current_user;
    	$log_in_user_id = $current_user->id;
    	
    	print_r('lohith');
    	die();
    	
    $id= $bean->id;
    $assigned_by=$current_user->id;
    $assigned_to=$bean->assigned_user_id;
    $approvers=$bean-> multiple_approver_c;
    $opp_status=$bean-> status_c;
    $rfp=$bean-> rfporeoipublished_c;

    $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
       
        $sql ='SELECT t.id, t.opp_id, t.assigned_by, t.assigned_to_id FROM assign_flow AS t WHERE t.opp_id="'.$id.'" AND t.assigned_to_id="'.$assigned_to.'" AND t.id=(SELECT MAX(id) FROM assign_flow WHERE opp_id="'.$id.'")';
			$result = $GLOBALS['db']->query($sql);
            $count=$result->num_rows;
			if($count>0){
			    
			}
            else{ 
               
               $bean->db->query("INSERT INTO `assign_flow`(`opp_id`, `assigned_by`, `assigned_to_id`, `approver_ids`,`status`,`rfp_eoi`) VALUES ('".$id."','".$assigned_by."','".$assigned_to."','".$approvers."','".$opp_status."','".$rfp."')");
            
                     

            }
            
             

        
    }}