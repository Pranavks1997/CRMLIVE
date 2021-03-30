<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/SugarPHPMailer.php');
include_once('include/utils/db_utils.php');

class notification{
    
    function send($bean, $event, $arguments){
        global $current_user;
        $log_in_user_id = $current_user->id;

        
        if(!(bool)$bean->fetched_row){
            $sql="SELECT * FROM documents_cstm WHERE id_c='".$bean->id."'";
            $result = $GLOBALS['db']->query($sql);

            while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
                // var_dump($row['user_id_c']);die;
                if((bool)$row['user_id_c']){
                    $alert = BeanFactory::newBean('Alerts');
                    $alert->name = '';
                    $alert->description = 'New Document "'.$bean->document_name.'" uploaded by "'.$current_user->first_name.' '.$current_user->last_name.'"';
                    $alert->url_redirect = $base_url.'index.php?action=DetailView&module=Documents&record='.$bean->id;
                    $alert->target_module = 'Documents';
                    $alert->assigned_user_id = $row['user_id_c'];
                    $alert->type = 'info';
                    $alert->is_read = 0;
                    $alert->save();

                    // Setting session data for alert
                    $_SESSION['flash'][$current_user->id] = [
                        'message' => 'Document "'.$bean->document_name.'" created successfully.'
                    ];  
                }
            }
        }


    }
    
}