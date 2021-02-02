<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/MVC/Controller/SugarController.php');

class CallsController extends SugarController
{
    function action_oppurtunity_status(){
        try{
            $opp_id = $_POST['opp_id'];
            $db = \DBManagerFactory::getInstance();
        	$GLOBALS['db'];
        	$sql = 'SELECT description FROM opportunities WHERE id="'.$opp_id.'"';
    		
    		$result = $GLOBALS['db']->query($sql);
    		
    		while($row = $GLOBALS['db']->fetchByAssoc($result) )
    		{
    		    $opp_status = $row['description'];
    		}
    			echo json_encode(array("status"=>true, "opp_status" => $opp_status));
    	}catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
            die();
    }
    
    function action_check_activity_date(){
        date_default_timezone_set('Asia/Kolkata');
        try{
            $date = date('yy-m-d');
            $db = \DBManagerFactory::getInstance();
        	$GLOBALS['db'];
    		$sql = 'SELECT calls.status, calls_cstm.id_c, calls_cstm.activity_date_c FROM calls_cstm INNER JOIN calls ON calls_cstm.id_c= calls.id WHERE calls.status="Planned" AND calls_cstm.activity_date_c IS NOT NULL AND calls_cstm.activity_date_c < "'.$date.'"';
    		$result = $GLOBALS['db']->query($sql);
    		if($result->num_rows>0){
				while($row = $GLOBALS['db']->fetchByAssoc($result) )
				{
				  	$update_query="UPDATE calls SET status ='Delayed' WHERE id='".$row['id_c']."'";
					$res_update = $db->query($update_query);
				}
    		}
    		var_dump($res_update);
    	}catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
    }
    
//      function action_hide_user_subpanel_for_view_only_user(){
//         try{
//             global $current_user;
//     		$log_in_user_id = $current_user->id;
//             $db = \DBManagerFactory::getInstance();
//         	$GLOBALS['db'];
//             $view_only_user = array();
// 			$sql = 'SELECT role_id, user_id FROM acl_roles_users where role_id="af3c481e-708f-64e1-f795-5f896b40d41c" AND deleted="0"';
// 			$result = $GLOBALS['db']->query($sql);
			
// 			while($row = $GLOBALS['db']->fetchByAssoc($result) )
// 			{
// 			    array_push($view_only_user,$row['user_id']);
// 			}
// 			if(in_array($log_in_user_id, $view_only_user)) {
// 			    echo json_encode(array("status"=>true, "access" => 'no'));
// 			}else{
// 			    echo json_encode(array("status"=>true, "access" => 'yes'));
// 			}
//     	}catch(Exception $e){
//     		echo json_encode(array("status"=>false, "message" => "Some error occured"));
//     	}
//     	die();
//      }
}