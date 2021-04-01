<?php 

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/SugarPHPMailer.php');
include_once('include/utils/db_utils.php');

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
                        $alert->description = 'New activity "'.$bean->name.'" created by "'.$current_user->first_name.' '.$current_user->last_name.'"';
                        $alert->url_redirect = $base_url.'index.php?action=DetailView&module=Calls&record='.$bean->id;
                        $alert->target_module = 'Activities';
                        $alert->assigned_user_id = $bean->user_id_c;
                        $alert->type = 'info';
                        $alert->is_read = 0;
                        $alert->save();

                        // Get approver user details
                        $user = $this->getUserByID($bean->user_id_c);

                        // Send mail to approver
                        $subject = 'CRM ALERT - Activity created';
                        $body = 'New activity "'.$bean->name.'" created by "'.$current_user->first_name.' '.$current_user->last_name.'" <br><br>Click here to view: www.ampersandcrm.com';
                        $to = $user['user_name'];
                        $created_at = date('Y-m-d H:i:s');

                        $sql="INSERT INTO `email_queue` (`subject`, `body`, `to`, `created_at`) VALUES ('$subject', '$body', '$to', '$created_at')";

                        $GLOBALS['db']->query($sql);

                        // Send mail to creator
                        $subject = 'CRM ALERT - Activity created';
                        $body = 'You have created activity "'.$bean->name.'". <br><br>Click here to view: www.ampersandcrm.com';
                        $to = $current_user->user_name;
                        $created_at = date('Y-m-d H:i:s');

                        $sql="INSERT INTO `email_queue` (`subject`, `body`, `to`, `created_at`) VALUES ('$subject', '$body', '$to', '$created_at')";

                        $GLOBALS['db']->query($sql);

                        // Setting session data for alert
                        $_SESSION['flash'][$current_user->id] = [
                            'message' => 'Activity "'.$bean->name.'" created successfully.'
                        ];  
                    }
                }
                    
            }
            
             

        
    }

    private function getUserByID($user_id){
        $sql = "SELECT * FROM `users` WHERE id='".$user_id."'";
        $result = $GLOBALS['db']->query($sql);
        
        $data = [];
        while($row = $GLOBALS['db']->fetchByAssoc($result)){
            $data = $row;
        }

        return $data;
    }
}