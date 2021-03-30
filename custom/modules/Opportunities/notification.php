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
        		    
        		    foreach($approvers as $approver){
        		        $alert = BeanFactory::newBean('Alerts');
                        $alert->name = '';
                        // $alert->description = 'New Document "'.$bean->document_name.'" uploaded by "'.$current_user->first_name.' '.$current_user->last_name.'"';
                        $alert->description = 'New Opportunity "'.$bean->name.'" Created by "'.$current_user->first_name.' '.$current_user->last_name.'"';
                        $alert->url_redirect = $base_url.'index.php?action=DetailView&module=Opportunities&record='.$bean->id;
                        $alert->target_module = 'Opportunities';
                        $alert->assigned_user_id = $approver;
                        $alert->type = 'info';
                        $alert->is_read = 0;
                        $alert->save();   
        		    }

                    // Setting session data for alert
                    $_SESSION['flash'][$current_user->id] = [
                        'message' => 'Opportunity "'.$bean->name.'" created successfully.'
                    ];  
        		}
        	}
        }


	}
	
}