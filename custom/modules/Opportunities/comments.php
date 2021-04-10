<?php 

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
    
class comments
{
    function comments_save($bean, $event, $arguments)
    {
        global $current_user;
    	$log_in_user_id = $current_user->id;
    	
        $id = $bean->id;
        $created_by = $current_user->id;
        $opp_description = $bean->write_note_c;

        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        
        $sql='SELECT * FROM description_opportunity WHERE opp_id="'.$id.'" AND id=(SELECT MAX(id) FROM description_opportunity WHERE opp_id="'.$id.'")';
        $result = $GLOBALS['db']->query($sql);
        
        while($row = $GLOBALS['db']->fetchByAssoc($result)){	
		    $latest_description = $row['description'];
		}
			

		if($opp_description != $latest_description){
		    $bean->db->query('INSERT INTO `description_opportunity`(`opp_id`, `description`, `user_id`) VALUES ("'.$id.'","'.$opp_description.'","'.$created_by.'")'); 	
		}
            
}}