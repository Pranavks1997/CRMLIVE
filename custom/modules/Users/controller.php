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
        
        if( $log_in_user_id!=$current_user->is_admin) {
            echo json_encode($check_sales);
        }
        
       
        die();
    }
    
  //------------check for bid or commercial head ------------------------------  
  
public function action_bid_commercial_check(){
     try{
         $db = \DBManagerFactory::getInstance();
        	$GLOBALS['db'];
    
    	$sql="SELECT users.id, users.employee_status, users.deleted, users_cstm.bid_commercial_head_c FROM users INNER JOIN users_cstm ON users_cstm.id_c = users.id WHERE users.employee_status='Active' AND users.deleted=0 AND users_cstm.bid_commercial_head_c IN ('bid_team_head','commercial_team_head')";
        
        $result = $GLOBALS['db']->query($sql);
        
        $bid_commercial = array();
       
        
        while ($row = mysqli_fetch_assoc($result)){
            
             array_push($bid_commercial,$row['bid_commercial_head_c']);
            
        }
    
    
    
    
    
   if(in_array('bid_team_head',$bid_commercial) && in_array('commercial_team_head',$bid_commercial)){
       echo "both";
   }
    else if(count($bid_commercial)<2 && count($bid_commercial)>0){
        if(in_array('bid_team_head',$bid_commercial)){
       echo "bid";
       }
        else{
            echo "commercial";
        }
    }  else{
        echo "choose";
    }  
   
     }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}


   //-----------check for bid or commercial head----END------------------------
   
   
   
//*****************************************Write code above this line****************************************************************   
    
}
?>