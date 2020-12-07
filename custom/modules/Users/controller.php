<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/MVC/Controller/SugarController.php');

class UsersController extends SugarController
{
    public function action_remove_arrow()
    {
        global $current_user;
        $log_in_user_id = $current_user->id;
        
        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        $sql = "SELECT users.id, users_cstm.teamfunction_c FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '".$log_in_user_id."' AND users.deleted = 0";
        
        $result = $GLOBALS['db']->query($sql);
        $check_sales = array();
        while($row = $GLOBALS['db']->fetchByAssoc($result)) 
        {
            $check_sales = $row;
        }
        
        if($current_user->is_admin !== 1) {
            echo json_encode($check_sales);
        }
        
       
        die();
    }
}
?>