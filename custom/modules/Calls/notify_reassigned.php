<?php 

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
	            $alert->description = 'You have been assigned to an activity. Now you can edit / make changes to activity "'.$bean->name.'" by '.$current_user->first_name.' '.$current_user->last_name;

	            $alert->url_redirect = 'index.php?action=DetailView&module=Calls&record='.$bean->id;
	            $alert->target_module = 'Activities';
	            $alert->assigned_user_id = $assigned_user_id;
	            $alert->type = 'info';
	            $alert->is_read = 0;
	            $alert->save();

	            // Send Email To New Assigned User
	            $assigned_user = $this->getUserByID($assigned_user_id);

	            $template = 'You have been assigned to an activity. Now you can edit / make changes to activity "'.$bean->name.'" by '.$current_user->first_name.' '.$current_user->last_name;

				$emailObj = new Email();  
				$defaults = $emailObj->getSystemDefaultEmail();  
				$mail = new SugarPHPMailer();  
				$mail->setMailerForSystem();  
				$mail->From = $defaults['email'];  
				$mail->FromName = $defaults['name'];  
				$mail->Subject = 'Activity ressignment mail for - "'.$bean->name.'"';
				$mail->Body =$template;
				$mail->prepForOutbound();  
				$mail->AddAddress($assigned_user['user_name']);
				@$mail->Send();

				// Send Email To Old Assigned User
				$old_assigned_user = $this->getUserByID($old_assigned_user_id);
				$template = $old_assigned_user['first_name'].' '.$old_assigned_user['last_name'].' have been assigned to an activity "'.$bean->name.'" by '.$current_user->first_name.' '.$current_user->last_name;

				$emailObj = new Email();  
				$defaults = $emailObj->getSystemDefaultEmail();  
				$mail = new SugarPHPMailer();  
				$mail->setMailerForSystem();  
				$mail->From = $defaults['email'];  
				$mail->FromName = $defaults['name'];  
				$mail->Subject = 'Activity ressignment mail for - "'.$bean->name.'"';
				$mail->Body =$template;
				$mail->prepForOutbound();  
				$mail->AddAddress($old_assigned_user['user_name']);
				@$mail->Send();



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