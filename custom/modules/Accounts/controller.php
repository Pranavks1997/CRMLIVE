<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/MVC/Controller/SugarController.php');



class AccountsController extends SugarController

{

//---------------Detail View Opportunity creation checking----------------------------------------


public function action_detailView_check(){
    
    $acc_id=$_POST['id'];
    
     try{ 
         
         global $current_user;
       
    	$log_in_user_id = $current_user->id;
    	
    //	echo $log_in_user_id;
    	
    	$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
          
          $sql ='SELECT * FROM accounts WHERE id="'. $acc_id.'"';
			$result = $GLOBALS['db']->query($sql);
			
			while($row = $GLOBALS['db']->fetchByAssoc($result) )
				{
				    $created_by=$row['created_by'];
				  
				}
	
	
    
			 
			  $sql3 = "SELECT users.id, users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '".$log_in_user_id."' AND users.deleted = 0";
        $result3 = $GLOBALS['db']->query($sql3);
        while($row3 = $GLOBALS['db']->fetchByAssoc($result3)) 
        {
            $check_sales = $row3['teamfunction_c'];
            $check_mc = $row3['mc_c'];
            $check_team_lead = $row3['teamheirarchy_c'];
            
        }
        //|| $current_user->is_admin
        
			 if(  $check_mc =="yes"|| $log_in_user_id == $created_by  ) {
          	 
          	  echo json_encode ("true");
                
            }else{
                echo json_encode ("false");
            }
        
				
    
  }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}
   

//---------------Detail View Opportunity creation checking--------END--------------------------------


   

 //--------state list------------------------------------------------ 
 

public function action_stateList(){
     try{
         $db = \DBManagerFactory::getInstance();
        	$GLOBALS['db'];
        	
        	   if(isset($_POST['selected_country']))
{
    $country = $_POST['selected_country'];
   
}
     
     
        	$sql='SELECT * FROM `states` WHERE country_id=(SELECT id FROM country_department WHERE name="'.$country.'" )';
        
        $result = $GLOBALS['db']->query($sql);
        
        $state_list = array();
        
        while ($row = mysqli_fetch_assoc($result)) {
     
      $state_list[]=$row;
       
    }
    
   echo json_encode($state_list);
        
   
     }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}

//---state list-------END---------------------------------



//-----------------------------------countrylist---------------------------------------------------

public function action_countryList(){
     try{
         $db = \DBManagerFactory::getInstance();
        	$GLOBALS['db'];
        	
        	$sql='SELECT * FROM `country_department`';
        
        $result = $GLOBALS['db']->query($sql);
        
        $country_list = array();
        
        while ($row = mysqli_fetch_assoc($result)) {
     
      $country_list[]=$row;
       
    }
   echo json_encode($country_list);
        
   
     }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}

//---------------------------countrylist------------------------END-----------------------------





//===========================Write code above this line=========================================    
}
?>
