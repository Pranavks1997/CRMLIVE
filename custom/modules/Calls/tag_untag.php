<?php 

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

class taguntag
{

  function tag_untag_save($bean, $event, $arguments){
    global $current_user;
    $log_in_user_id = $current_user->id;
    	
    $id= $bean->id;
    $activity_type=$bean->activity_type_c;
    $assigned_id=$bean->assigned_user_id;
    $tagged_ids=$bean->tag_hidden_c;
    $approver=$bean->user_id_c;
    
   
    
    $db = \DBManagerFactory::getInstance();
    $GLOBALS['db'];

    $sql_lineage='SELECT * FROM users_cstm WHERE id_c="'.$assigned_id.'"';
    $result_lineage = $GLOBALS['db']->query($sql_lineage);
    
    while($row_lineage = $GLOBALS['db']->fetchByAssoc($result_lineage)) {
      $lineage=$row_lineage['user_lineage'];            	       
    }	                
    
    $tagged_ids_array=explode(',',$tagged_ids);
                    
    $lineage_ids_array=explode(',',$lineage);
                  
                    
    if (($key = array_search($assigned_id,$tagged_ids_array)) !== false) {
      unset($tagged_ids_array[$key]);                           
    }
    
    if (($key = array_search($approver,$tagged_ids_array)) !== false) {
      unset($tagged_ids_array[$key]);                           
    }
                         
    $tagged_ids_array=array_diff($tagged_ids_array,$lineage_ids_array);
    $tagged_ids=implode(',',$tagged_ids_array);  
    
    $bean->db->query('UPDATE `calls_cstm` SET `tag_hidden_c`="'.$tagged_ids.'" WHERE `id_c`="'.$id.'"');


// 			if($activity_type=="non_global"){
// 			    $bean->db->query('UPDATE `calls_cstm` SET `tag_hidden_c`="" WHERE `id_c`="'.$id.'"'); 	
// 			}
// 			else{
			        
// 			    $bean->db->query('UPDATE `calls_cstm` SET `untag_hidden_c`="" WHERE `id_c`="'.$id.'"'); 
			
// 			}
            
}}