<?php 

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class updateHistory
{
       

    function after_save_method($bean, $event, $arguments)
    {
        
        global $current_user;
    	$log_in_user_id = $current_user->id;
    	$log_in_user_name=$current_user->name;
    	
    	
    $id= $bean->id;
    $name= $bean->name;
    $assigned_by=$current_user->id;
    $assigned_to=$bean->assigned_user_id;
    $assigned_name=$bean->assigned_user_name;
    $approvers=$bean-> multiple_approver_c;
    $opp_status=$bean-> status_c;
    $rfp=$bean-> rfporeoipublished_c;
    
    $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        
        
        
          $sql_old ='SELECT t.id, t.opp_id, t.assigned_by, t.assigned_to_id FROM assign_flow AS t WHERE t.opp_id="'.$id.'"  AND t.id=(SELECT MAX(id) FROM assign_flow WHERE opp_id="'.$id.'")';
			$result_old= $GLOBALS['db']->query($sql_old);
				while($row_old= $GLOBALS['db']->fetchByAssoc($result_old) ){
                    				     
                    			    $assigned_to_old=$row_old['assigned_to_id']	;   
                    			    	   
                    			    	}
                    			    	
                    			    	 $sql_old_email ='SELECT * FROM `users` WHERE id="'.$assigned_to_old.'"';
			$result_old_email= $GLOBALS['db']->query($sql_old_email);
				while($row_old_email= $GLOBALS['db']->fetchByAssoc($result_old_email) ){
                    				     
                    			    $email_old=$row_old_email['user_name']	;   
                    			    	   
                    			    	}
                    			    	
                    			    	 $sql_email ='SELECT * FROM `users` WHERE id="'.$assigned_to.'"';
			$result_email= $GLOBALS['db']->query($sql_email);
				while($row_email= $GLOBALS['db']->fetchByAssoc($result_email) ){
                    				     
                    			    $email=$row_email['user_name']	;   
                    			    	   
                    			    	}
       
        $sql ='SELECT t.id, t.opp_id, t.assigned_by, t.assigned_to_id FROM assign_flow AS t WHERE t.opp_id="'.$id.'" AND t.assigned_to_id="'.$assigned_to.'" AND t.id=(SELECT MAX(id) FROM assign_flow WHERE opp_id="'.$id.'")';
			$result = $GLOBALS['db']->query($sql);
            $count=$result->num_rows;
			if($count>0){
			    
			}
            else{ 
               
               $bean->db->query("INSERT INTO `assign_flow`(`opp_id`, `assigned_by`, `assigned_to_id`, `approver_ids`,`status`,`rfp_eoi`) VALUES ('".$id."','".$assigned_by."','".$assigned_to."','".$approvers."','".$opp_status."','".$rfp."')");
               
            	if((bool)$bean->fetched_row){
            	    $assigned_user = $this->getUserByID($assigned_to);
            	    	$_SESSION['flash'][$current_user->id] = [
			        'message' => 'Opportunity "'.$bean->name.'" was re-assigned to "'.$assigned_user['first_name'].' '.$assigned_user['last_name'].'" by "'.$current_user->first_name.' '.$current_user->last_name.'"'
			    ];
            	    
                                                            $alert = BeanFactory::newBean('Alerts');
                                    						//$alert->name =$opp_name;
                                    						$alert->description = 'You have been assigned to an opportunity "'.$name.'" by "'.$log_in_user_name.'". Now you can edit /make changes.';
                                    						$alert->url_redirect = 'index.php?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D'.$id;
                                    						$alert->target_module = 'Opportunities';
                                    						$alert->assigned_user_id = $assigned_to;
                                    						$alert->type = 'info';
                                    						$alert->is_read = 0;
                                    						$alert->save();
                                    						
                                    		         //     $alert = BeanFactory::newBean('Alerts');
                                    				// 		//$alert->name =$opp_name;
                                    				// 		$alert->description = $assigned_name.' have been assigned to an opportunity. Now you can\'t edit /make changes to opportunity "'.$name.'" ';
                                    				// 		$alert->url_redirect = '';
                                    				// 		$alert->target_module = 'Opportunities';
                                    				// 		$alert->assigned_user_id = $assigned_to_old;
                                    				// 		$alert->type = 'info';
                                    				// 		$alert->is_read = 0;
                                    				// 		$alert->save();
                                    				
                                    					
    
    
                                    			        	$template = 'You have been assigned to an opportunity "'.$name.'" by "'.$log_in_user_name.'". Now you can edit /make changes.<br><br>Click here to view: www.ampersandcrm.com';
                                    						require_once('include/SugarPHPMailer.php');
                                    						include_once('include/utils/db_utils.php');
                                    					    $emailObj = new Email();  
                                    					    $defaults = $emailObj->getSystemDefaultEmail();  
                                    					    $mail = new SugarPHPMailer(); 
                                    					    $mail->IsHTML(true);
                                    					    $mail->setMailerForSystem();  
                                    					    $mail->From = $defaults['email'];  
                                                            $mail->FromName = $defaults['name']; 
                                    					    $mail->Subject = 'CRM ALERT - Reassignment'; 
                                    						$mail->Body =$template;
                                    					    $mail->prepForOutbound();  
                                    					    $mail->AddAddress($email); 
                                    					    @$mail->Send();
                                    							
                                    			            $template = $assigned_name.' has been assigned to an opportunity "'.$name.'" by "'.$log_in_user_name.'"';
                                    						require_once('include/SugarPHPMailer.php');
                                    						include_once('include/utils/db_utils.php');
                                    					    $emailObj = new Email();  
                                    					    $defaults = $emailObj->getSystemDefaultEmail();  
                                    					    $mail = new SugarPHPMailer();
                                    					    $mail->IsHTML(true);
                                    					    $mail->setMailerForSystem();  
                                    					    $mail->From = $defaults['email'];  
                                                            $mail->FromName = $defaults['name']; 
                                    					    $mail->Subject = 'CRM ALERT - Reassignment'; 
                                    						$mail->Body =$template;
                                    					    $mail->prepForOutbound();  
                                    					    $mail->AddAddress($email_old); 
                                    					    @$mail->Send();
                                    					
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