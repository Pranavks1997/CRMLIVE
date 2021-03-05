<?php 

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
class description
{

    function description_save($bean, $event, $arguments)
    {
        global $current_user;
    	$log_in_user_id = $current_user->id;
    	
    $id= $bean->id;
    $created_by=$current_user->id;
    $opp_description=$bean->description;

    $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        
        $sql='SELECT * FROM description_activity WHERE opp_id="'.$id.'" AND id=(SELECT MAX(id) FROM description_activity WHERE opp_id="'.$id.'")';
        	$result = $GLOBALS['db']->query($sql);
                    		
                    		
                    			while($row = $GLOBALS['db']->fetchByAssoc($result))
			{	
			    $latest_description=$row['description'];
			}
			

			if($opp_description==$latest_description){
			        	
			}
			else{
			        
			    $bean->db->query('INSERT INTO `description_activity`(`opp_id`, `description`, `user_id`) VALUES ("'.$id.'","'.$opp_description.'","'.$created_by.'")'); 
			
			}
			
			
                    
             
            
}}