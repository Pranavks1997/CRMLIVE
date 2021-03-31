<?php

class notification{
	
	function send($bean, $event, $arguments){
		global $current_user;
    	$log_in_user_id = $current_user->id;

    	
    	if(!(bool)$bean->fetched_row){
        	$sql="SELECT * FROM opportunities_cstm WHERE id_c='".$bean->id."'";
        	$result = $GLOBALS['db']->query($sql);

        	while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
                // var_dump($row['multiple_approver_c']);die;
        		if((bool)$row['multiple_approver_c']){
        		    $approvers = explode(',', $row['multiple_approver_c']);
        		    
        		    // Send Notification To All Approvers
        		    foreach($approvers as $approver){
        		        // Send Notification To Respective Approver
        		        $alert = BeanFactory::newBean('Alerts');
                        $alert->name = '';
                        $alert->description = 'New opportunity "'.$bean->name.'" created by "'.$current_user->first_name.' '.$current_user->last_name.'"';
                        $alert->url_redirect = $base_url.'index.php?action=DetailView&module=Opportunities&record='.$bean->id;
                        $alert->target_module = 'Opportunities';
                        $alert->assigned_user_id = $approver;
                        $alert->type = 'info';
                        $alert->is_read = 0;
                        $alert->save();
                        
                        // Get Respective Approver Details
                        $user = $this->getUserByID($approver);
                        
                        // Send mail to approver
                        $template = 'New opportunity "'.$bean->name.'" created by "'.$current_user->first_name.' '.$current_user->last_name.'".<br><br>Click here to view: www.ampersandcrm.com';

                        $emailObj = new Email();  
                        $defaults = $emailObj->getSystemDefaultEmail();  
                        $mail = new SugarPHPMailer(); 
                        $mail->IsHTML(true);
                        $mail->setMailerForSystem();  
                        $mail->From = $defaults['email'];  
                        $mail->FromName = $defaults['name'];  
                        $mail->Subject = 'CRM ALERT - Opportunity created.';
                        $mail->Body =$template;
                        $mail->prepForOutbound();  
                        $mail->AddAddress($user['user_name']);
                        @$mail->Send();
        		    }
        		    
        		    // Send Mail To Creator
        		    $template = 'You have created opportunity "'.$bean->name.'".<br><br>Click here to view: www.ampersandcrm.com';

                    $emailObj = new Email();  
                    $defaults = $emailObj->getSystemDefaultEmail();  
                    $mail = new SugarPHPMailer();  
                    $mail->IsHTML(true);
                    $mail->setMailerForSystem();  
                    $mail->From = $defaults['email'];  
                    $mail->FromName = $defaults['name'];  
                    $mail->Subject = 'CRM ALERT - Opportunity created.';
                    $mail->Body =$template;
                    $mail->prepForOutbound();  
                    $mail->AddAddress($current_user->user_name);
                    @$mail->Send();

                    // Setting session data for alert
                    $_SESSION['flash'][$current_user->id] = [
                        'message' => 'Opportunity "'.$bean->name.'" created successfully.'
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