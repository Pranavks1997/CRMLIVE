<?php	
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/SugarPHPMailer.php');
include_once('include/utils/db_utils.php');

class notify_tag_untag
{
	function send($bean, $event, $arguments){

		if((bool)$bean->fetched_row){
			global $current_user;
			$message = '';
			
			$tagged_ids = $_REQUEST['tag_hidden_c'];
			$tagged_array = explode(',', $tagged_ids);

		    // Get Newly tagged users
		    $sql = "SELECT * FROM `calls_cstm` WHERE id_c='".$bean->id."'";
		    $result = $GLOBALS['db']->query($sql);
		    while($row = $GLOBALS['db']->fetchByAssoc($result)){
		      $old_tagged_ids = $row['tag_hidden_c'];
		    }
		    $old_tagged_array = explode(',', $old_tagged_ids);
		    $new_tagged_array = array_diff($tagged_array, $old_tagged_array);
		    $new_untagged_array = array_diff($old_tagged_array, $tagged_array);

		    // Notify New Tagged Memers
		    if (count($new_tagged_array)) {
			    //Send Notification To Respective TL
			    $alert = BeanFactory::newBean('Alerts');
	            $alert->name = '';
	            $alert->description = 'Activity "'.$bean->name.'" has been tagged to - '.$this->getTaggedUsersName($new_tagged_array);
	            $alert->url_redirect = 'index.php?action=DetailView&module=Calls&record='.$bean->id;
	            $alert->target_module = 'Activities';
	            $alert->assigned_user_id = $bean->user_id_c;
	            $alert->type = 'info';
	            $alert->is_read = 0;
	            $alert->save();
			    
			    foreach ($new_tagged_array as $key => $user_id) {
			    	$user = $this->getUserByID($user_id);

			    	// Send Notification to newly tagged member
			    	$alert = BeanFactory::newBean('Alerts');
	                $alert->name = '';
	                $alert->description = 'You have been tagged to activity "'.$bean->name.'". Now you can edit / make changes';
	                $alert->url_redirect = 'index.php?action=DetailView&module=Calls&record='.$bean->id;
	                $alert->target_module = 'Activities';
	                $alert->assigned_user_id = $user_id;
	                $alert->type = 'info';
	                $alert->is_read = 0;
	                $alert->save();

	                // Send email to newly tagged member
					$template = 'You have been tagged to activity "'.$bean->name.'". Now you can edit / make changes <br><br> Click here to view: www.ampersandcrm.com';

					$emailObj = new Email();  
					$defaults = $emailObj->getSystemDefaultEmail();  
					$mail = new SugarPHPMailer();  
					$mail->setMailerForSystem();  
					$mail->From = $defaults['email'];  
					$mail->FromName = $defaults['name'];  
					$mail->Subject = 'CRM ALERT - Tagged';
					$mail->Body =$template;
					$mail->prepForOutbound();  
					$mail->IsHTML(true);
					$mail->AddAddress($user['user_name']);
					@$mail->Send();
			    }

			    $tagged_users = $this->getTaggedUsersName($new_tagged_array);
			    if(!empty($tagged_users)){
			    	$message .= $tagged_users.' has been tagged successfully. ';
			    }
		    }

		    //Notify New Untagged Members
		    if(count($new_untagged_array)){
		    	//Send Notification To Respective TL
			    $alert = BeanFactory::newBean('Alerts');
	            $alert->name = '';
	            $alert->description = 'Activity "'.$bean->name.'" has been untagged from - '.$this->getTaggedUsersName($new_untagged_array);
	            $alert->url_redirect = 'index.php?action=DetailView&module=Calls&record='.$bean->id;
	            $alert->target_module = 'Activities';
	            $alert->assigned_user_id = $bean->user_id_c;
	            $alert->type = 'info';
	            $alert->is_read = 0;
	            $alert->save();

	            foreach ($new_untagged_array as $key => $user_id) {
	            	$user = $this->getUserByID($user_id);
			    	// Send Notification to newly untagged member
			    	$alert = BeanFactory::newBean('Alerts');
	                $alert->name = '';
	                $alert->description = 'You have been untagged from activity "'.$bean->name.'"';
	                $alert->url_redirect = 'index.php?action=listView&module=Calls';
	                $alert->target_module = 'Activities';
	                $alert->assigned_user_id = $user_id;
	                $alert->type = 'info';
	                $alert->is_read = 0;
	                $alert->save();

	                // Send email to newly untagged member
					$template = 'You have been untagged from activity "'.$bean->name.'"';

					$emailObj = new Email();  
					$defaults = $emailObj->getSystemDefaultEmail();  
					$mail = new SugarPHPMailer();  
					$mail->setMailerForSystem();  
					$mail->From = $defaults['email'];  
					$mail->FromName = $defaults['name'];  
					$mail->Subject = 'CRM ALERT - Untagged';
					$mail->Body =$template;
					$mail->prepForOutbound();  
					$mail->AddAddress($user['user_name']);
					@$mail->Send();
			    }

			    $untagged_users = $this->getTaggedUsersName($new_untagged_array);
			    if(!empty($untagged_users)){
			    	$message .= $untagged_users.' has been untagged successfully. ';
			    }
		    }

		    if (!empty($message)) {
			    // Setting session data for alert
		        $_SESSION['flash'][$current_user->id] = [
		            'message' => $message
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

	private function getTaggedUsersName($users){
		$names = [];
		foreach ($users as $key => $user_id) {
			$user = $this->getUserByID($user_id);
			$names[] = $user['first_name'].' '.$user['last_name'];
		}

		return trim(implode(', ', $names));
	}

}