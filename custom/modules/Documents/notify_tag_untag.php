<?php	

class notify_tag_untag
{
	function send($bean, $event, $arguments){

		if((bool)$bean->fetched_row){
			global $current_user;
			$message = '';
			
			$tagged_ids = $_REQUEST['tagged_hidden_c'];

			$tagged_array = explode(',', $tagged_ids);

		    // Get Newly tagged users
		    $sql = "SELECT * FROM `documents_cstm` WHERE id_c='".$bean->id."'";
		    $result = $GLOBALS['db']->query($sql);
		    while($row = $GLOBALS['db']->fetchByAssoc($result)){
		      	$old_tagged_ids = $row['tagged_hidden_c'];
		    }
		    $old_tagged_array = explode(',', $old_tagged_ids);
		    $new_tagged_array = array_diff($tagged_array, $old_tagged_array);
		    $new_untagged_array = array_diff($old_tagged_array, $tagged_array);


		    // Notify New Tagged Memers
		    if (count($new_tagged_array)) {
			    $tagged_users = $this->getTaggedUsersName($new_tagged_array);
			    if (!empty($tagged_users)) {
			    	
				    //Send Notification To Respective TL
				    $alert = BeanFactory::newBean('Alerts');
		            $alert->name = '';
		            $alert->description = 'Document "'.$bean->document_name.'" has been tagged to - '.$tagged_users;
		            $alert->url_redirect = 'index.php?action=DetailView&module=Documents&record='.$bean->id;
		            $alert->target_module = 'Documents';
		            $alert->assigned_user_id = $bean->user_id_c;
		            $alert->type = 'info';
		            $alert->is_read = 0;
		            $alert->save();
				    
				    foreach ($new_tagged_array as $key => $user_id) {
				    	$user = $this->getUserByID($user_id);

				    	// Send Notification to newly tagged member
				    	$alert = BeanFactory::newBean('Alerts');
		                $alert->name = '';
		                $alert->description = 'You have been tagged for Document "'.$bean->document_name.'".Now you can edit / make changes';
		                $alert->url_redirect = 'index.php?action=DetailView&module=Documents&record='.$bean->id;
		                $alert->target_module = 'Documents';
		                $alert->assigned_user_id = $user_id;
		                $alert->type = 'info';
		                $alert->is_read = 0;
		                $alert->save();

		                // Send email to newly tagged member
						$template = 'You have been tagged for Document "'.$bean->document_name.'".Now you can edit / make changes';

						$emailObj = new Email();  
						$defaults = $emailObj->getSystemDefaultEmail();  
						$mail = new SugarPHPMailer();  
						$mail->setMailerForSystem();  
						$mail->From = $defaults['email'];  
						$mail->FromName = $defaults['name'];  
						$mail->Subject = 'Document tagging mail for - '.$bean->document_name.'';
						$mail->Body =$template;
						$mail->prepForOutbound();  
						$mail->AddAddress($user['user_name']);
						@$mail->Send();
				    }
				    $message .= $tagged_users.' has been tagged successfully. ';
			    }
		    }

		    //Notify New Untagged Members
		    if(count($new_untagged_array)){
		    	$untagged_users = $this->getTaggedUsersName($new_untagged_array);

		    	if (!empty($untagged_users)) {
			    	//Send Notification To Respective TL
				    $alert = BeanFactory::newBean('Alerts');
		            $alert->name = '';
		            $alert->description = 'Document "'.$bean->document_name.'" has been untagged from - '.$untagged_users;
		            $alert->url_redirect = 'index.php?action=DetailView&module=Documents&record='.$bean->id;
		            $alert->target_module = 'Documents';
		            $alert->assigned_user_id = $bean->user_id_c;
		            $alert->type = 'info';
		            $alert->is_read = 0;
		            $alert->save();

		            foreach ($new_untagged_array as $key => $user_id) {
		            	$user = $this->getUserByID($user_id);
				    	// Send Notification to newly untagged member
				    	$alert = BeanFactory::newBean('Alerts');
		                $alert->name = '';
		                $alert->description = 'You have been untagged from Document "'.$bean->document_name.'"';
		                $alert->url_redirect = 'index.php?action=listView&module=Documents';
		                $alert->target_module = 'Documents';
		                $alert->assigned_user_id = $user_id;
		                $alert->type = 'info';
		                $alert->is_read = 0;
		                $alert->save();

		                // Send email to newly untagged member
						$template = 'Document "'.$bean->document_name.'" has been untagged from you';

						$emailObj = new Email();  
						$defaults = $emailObj->getSystemDefaultEmail();  
						$mail = new SugarPHPMailer();  
						$mail->setMailerForSystem();  
						$mail->From = $defaults['email'];  
						$mail->FromName = $defaults['name'];  
						$mail->Subject = 'You have been untagged from Document "'.$bean->document_name.'"';
						$mail->Body =$template;
						$mail->prepForOutbound();  
						$mail->AddAddress($user['user_name']);
						@$mail->Send();
				    }

				    
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