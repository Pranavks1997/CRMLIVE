<?php 

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class activity_assign
{


    function activity_reassign_save($bean, $event, $arguments)
    {
        global $current_user;
    	$log_in_user_id = $current_user->id;
    	
    $id= $bean->id;
    $assigned_by=$current_user->id;
    $assigned_to=$bean->assigned_user_id;
    $approvers=$bean-> user_id_c;
    $acc_status=$bean-> status_new_c;
    $acc_type=$bean-> activity_type_c;
    
    

    $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
       
        $sql ='SELECT t.id, t.acc_id, t.assigned_by, t.assigned_to_id FROM activity_assign_flow AS t WHERE t.acc_id="'.$id.'" AND t.assigned_to_id="'.$assigned_to.'" AND t.id=(SELECT MAX(id) FROM activity_assign_flow WHERE acc_id="'.$id.'")';
			$result = $GLOBALS['db']->query($sql);
            $count=$result->num_rows;
            
			if($count>0){
			    
			}
            else{ 
               
               $bean->db->query("INSERT INTO `activity_assign_flow`(`acc_id`, `assigned_by`, `assigned_to_id`, `approver_ids`,`status`,`acc_type`) VALUES ('".$id."','".$assigned_by."','".$assigned_to."','".$approvers."','".$acc_status."','".$acc_type."')");



                if(!(bool)$bean->fetched_row){
                    // Send Notification To Respective Approver 
                    $sql = "SELECT * FROM users WHERE id='".$bean->user_id_c."'";
                    $result = $GLOBALS['db']->query($sql);
                   
                    while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
                        $alert = BeanFactory::newBean('Alerts');
                        $alert->name = '';
                        $alert->description = 'New Activity "'.$bean->name.'" Created by "'.$current_user->first_name.' '.$current_user->last_name.'"';
                        $alert->url_redirect = $base_url.'index.php?action=DetailView&module=Calls&record='.$bean->id;
                        $alert->target_module = 'Activities';
                        $alert->assigned_user_id = $bean->user_id_c;
                        $alert->type = 'info';
                        $alert->is_read = 0;
                        $alert->save();

                        // Setting session data for alert
                        $_SESSION['flash'][$current_user->id] = [
                            'message' => 'Activity "'.$bean->name.'" created successfully.'
                        ];  
                    }
                }
            }
            
             

        
    }}
