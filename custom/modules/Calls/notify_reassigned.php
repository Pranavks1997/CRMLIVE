<?php 
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/SugarPHPMailer.php');
include_once('include/utils/db_utils.php');

class notify_reassigned
{
	function send($bean, $event, $arguments){
		global $current_user;
		
		if((bool)$bean->fetched_row){
			$assigned_user_id = $_REQUEST['assigned_user_id'];

			$sql = 'SELECT * FROM calls WHERE id="'.$bean->id.'"';

			$result = $GLOBALS['db']->query($sql);

			while($row = $GLOBALS['db']->fetchByAssoc($result)){
			    $old_assigned_user_id = $row['assigned_user_id'];
			}


			if($old_assigned_user_id != $assigned_user_id){
				// Send Notification To New Assigned User

				$alert = BeanFactory::newBean('Alerts');
	            $alert->name = '';
	            $alert->description = 'You have been assigned to activity "'.$bean->name.'" by '.$current_user->first_name.' '.$current_user->last_name.'. Now you can edit / make changes.';

	            $alert->url_redirect = 'index.php?action=DetailView&module=Calls&record='.$bean->id;
	            $alert->target_module = 'Activities';
	            $alert->assigned_user_id = $assigned_user_id;
	            $alert->type = 'info';
	            $alert->is_read = 0;
	            $alert->save();

	            // Send Email To New Assigned User
	            $assigned_user = $this->getUserByID($assigned_user_id);

	            $subject = 'CRM ALERT - Reassignment';
                $body = 'You have been assigned to activity "'.$bean->name.'" by '.$current_user->first_name.' '.$current_user->last_name.'. Now you can edit / make changes. <br><br> Click here to view: www.ampersandcrm.com';
                $to = $assigned_user['user_name'];
                $created_at = date('Y-m-d H:i:s');

                $sql="INSERT INTO `email_queue` (`subject`, `body`, `to`, `created_at`) VALUES ('$subject', '$body', '$to', '$created_at')";

                $GLOBALS['db']->query($sql);

				// Send Email To Old Assigned User
				$old_assigned_user = $this->getUserByID($old_assigned_user_id);

				$subject = 'CRM ALERT - Reassignment';
                $body = $assigned_user['first_name'].' '.$assigned_user['last_name'].' has been assigned to an activity "'.$bean->name.'" by '.$current_user->first_name.' '.$current_user->last_name;
                $to = $old_assigned_user['user_name'];
                $created_at = date('Y-m-d H:i:s');

                $sql="INSERT INTO `email_queue` (`subject`, `body`, `to`, `created_at`) VALUES ('$subject', '$body', '$to', '$created_at')";

                $GLOBALS['db']->query($sql);


				$_SESSION['flash'][$current_user->id] = [
			        'message' => 'The activity "'.$bean->name.'" was re-assigned to "'.$assigned_user['first_name'].' '.$assigned_user['last_name'].'" by "'.$current_user->first_name.' '.$current_user->last_name.'"'
			    ]; 
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