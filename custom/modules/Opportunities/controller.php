<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/MVC/Controller/SugarController.php');



class OpportunitiesController extends SugarController
{
    
    
      public function action_sales_create_opportunity()
    {
      try{  
        global $current_user;
        // print_r($current_user);
        // die();
    	  $log_in_user_id = $current_user->id;
    // 	if($current_user->is_admin !=1){
    // 	    echo 'not admin';
    // 	}else{
    // 	     echo 'admin';
    // 	}
    // 	die();
    	  $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        // $user_id = $_POST[''];
        $sql = "SELECT users.id, users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '".$log_in_user_id."' AND users.deleted = 0";
        $result = $GLOBALS['db']->query($sql);
        while($row = $GLOBALS['db']->fetchByAssoc($result)) 
        {
            $check_sales = $row['teamfunction_c'];
            $check_mc = $row['mc_c'];
            $check_team_lead = $row['teamheirarchy_c'];
            
        }
        // $fields = unencodeMultienum($this->bean->report_vars);
        $team_func_array = explode(',', $check_sales);
        if(in_array("^sales^", $team_func_array) || $current_user->is_admin ==1 || $check_mc =="yes" || $check_team_lead =="team_lead" ) {
        // if(in_array("$team_func_array !== 'sales')){
            $can_create = 'yes';
        } else {
            $can_create = 'no';
        }
        
        
        echo json_encode(array("status"=> true, 'view'=>$can_create,"c"=>$check_team_lead));
        
      } catch(Exception $e) {
          echo json_encode(array("status"=>false, "message"=>"some error occured"));
      }
      die();
    }
    
   
   

  
  public function action_sector() 
  {
         
     
     try{
         $db = \DBManagerFactory::getInstance();
        	$GLOBALS['db'];
        	
        	$sql='SELECT * FROM sector';
        
        $result = $GLOBALS['db']->query($sql);
        
        $sector_list = array();
       
      while ($row = mysqli_fetch_assoc($result)) {
      
      $sector_list[]=$row;
       
    }
   echo json_encode($sector_list);
        
      
     }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
  }
   
  public function action_subSector() 
  {
         
        if(isset($_POST['sector_name']))
{
    $sector = $_POST['sector_name'];
   
}
         try{
        $db = \DBManagerFactory::getInstance();
        	$GLOBALS['db'];
        	
        	$sql='SELECT sub_sector.name,sector_id FROM  sub_sector INNER JOIN sector ON sub_sector.sector_id=sector.id WHERE sector.name="'.$sector.'"';
        
        $result = $GLOBALS['db']->query($sql);
        
        $subSector_list = array();
        $status = array(status=>true);
       
      while ($row = mysqli_fetch_assoc($result)) {
     
      $subSector_list[]=$row;
       
    }
   echo json_encode($subSector_list);
      
         }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
        
  }

public function action_segment(){
     try{
         $db = \DBManagerFactory::getInstance();
        	$GLOBALS['db'];
        	
        	$sql='SELECT * FROM segment';
        
        $result = $GLOBALS['db']->query($sql);
        
        $segment_list = array();
        
        while ($row = mysqli_fetch_assoc($result)) {
     
      $segment_list[]=$row;
       
    }
   echo json_encode($segment_list);
        
    
     }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}

public function action_productService() 
  {
         
     
    if(isset($_POST['segment_name']))
{
    $segment = $_POST['segment_name'];
   
}
         try{
        $db = \DBManagerFactory::getInstance();
        	$GLOBALS['db'];
        	
        	$sql='SELECT service.service_name, segment.id FROM service INNER JOIN segment ON service.segment_id= segment.id where segment.segment_name="'.$segment.'"';
        
        $result = $GLOBALS['db']->query($sql);
        
        $service_list =array();
        
        while ($row = mysqli_fetch_assoc($result)) {
      
      $service_list[]=$row;
       
    }
   echo json_encode($service_list);
        
    
         }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
        
  }

public function action_stateList(){
     try{
         $db = \DBManagerFactory::getInstance();
        	$GLOBALS['db'];
        	
        	$sql='SELECT * FROM `states` WHERE country_id=101';
        
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



public function action_firstSegment(){
    
    
    $segment_name = $_POST['segment'];
    
    
    
     try{
         $db = \DBManagerFactory::getInstance();
        	$GLOBALS['db'];
        	
        	$sql = 'INSERT INTO segment (segment_name) VALUES ("'.$segment_name.'")';

          if($db->query($sql)==TRUE){
              
              echo "Segment Added Successfully";
          }else{
              echo "Refresh and add Segment again";
          }
          
            
          
        //   $result = 'SELECT id FROM segment WHERE segment_name="ECCE"';
          
        //  $res=$db->query($result);
             
              
        // echo $res;      
          
   
     }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}

public function action_product(){
     
    
     $segment_name = $_POST['segment'];
    $service_name = $_POST['service'];
    
    
     try{
         $db = \DBManagerFactory::getInstance();
        	$GLOBALS['db'];
        	
         $sql='SELECT id FROM `segment` WHERE segment_name="'.$segment_name.'"';
        
        $result = $GLOBALS['db']->query($sql);
        
        
        
        while ($row = mysqli_fetch_assoc($result)) {
     
   
    
   
    	$service = 'INSERT INTO service (segment_id,service_name) VALUES ("'.$row['id'].'","'.$service_name.'")';

          
          
       if($GLOBALS['db']->query($service)==TRUE){
              
              echo "Product Added Successfully";
          }else{
              echo "Refresh and add Product again";
          }
    }
  
  
        
        
          
   
     }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}

//------------saving l1 and l2 template to database------------------

public function action_l1(){
    
    
    $id=$_POST['id'];
    $l1_html=base64_encode($_POST['l1_html']);
    $l1_input=base64_encode(serialize($_POST['l1_input']));
     
   
  try{ 
    	$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
   
    
    $sql ='SELECT * FROM l1 WHERE opp_id="'.$id.'"';
			$result = $GLOBALS['db']->query($sql);
			
			if($result->num_rows>0){
			    
				$update_query="UPDATE l1 SET l1_html='".$l1_html."',l1_input='". $l1_input."' WHERE opp_id='".$id."'";
				$res0 = $db->query($update_query);
			}else{
				$insert_query='INSERT INTO l1 (opp_id,l1_html,l1_input) VALUES ("'.$id.'", "'.$l1_html.'","'. $l1_input.'")';
				$res0 = $db->query($insert_query);
			}
   
    
    	echo json_encode(array("status"=>true, "message" => "Data saved Successfully"));
  }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}

public function action_l2(){
   
    $id=$_POST['id'];
    $l2_html=base64_encode($_POST['l2_html']);
    $l2_input=base64_encode(serialize($_POST['l2_input']));
   
  try{ 
    	$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
    
          
          $sql ='SELECT * FROM l2 WHERE opp_id="'.$id.'"';
			$result = $GLOBALS['db']->query($sql);
			// print_r($result->num_rows);
			if($result->num_rows>0){
				$update_query="UPDATE l2 SET l2_html='".$l2_html."',l2_input='". $l2_input."' WHERE opp_id='".$id."'";
				$res0 = $db->query($update_query);
			}else{
				$insert_query='INSERT INTO l2 (opp_id,l2_html,l2_input) VALUES ("'.$id.'", "'.$l2_html.'","'. $l2_input.'")';
				$res0 = $db->query($insert_query);
			}
    echo json_encode(array("status"=>true, "message" => "Data saved Successfully"));
  }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}

//------------saving l1 and l2 template to database----ENDS------------

//------------fetching l1 and l2 template data and displaying to FE------------

public function action_fetch_l1(){
    
    $id=$_POST['id'];
    	try{
			$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
	    	
	    		$sql ='SELECT * FROM l1 WHERE opp_id="'.$id.'"';
	    		
			$result = $GLOBALS['db']->query($sql);
			
			if($result->num_rows>0){
			   
				while($row = $GLOBALS['db']->fetchByAssoc($result) )
				{
				      
			    
			   	$l1_input =unserialize(base64_decode( $row['l1_input']));
			   	$l1_html = base64_decode($row['l1_html']);
			    	
 				}
			}else{
			    	$l1_input ="";
			    	$l1_html ="";
			}
	    		echo json_encode(array("status"=>true, "l1_input" =>$l1_input,"l1_html" =>	$l1_html ));
    	}catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
    
    
}

public function action_fetch_l2(){
    
    $id=$_POST['id'];
    	try{
			$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
	    	
	    		$sql ='SELECT * FROM l2 WHERE opp_id="'.$id.'"';
	    		
			$result = $GLOBALS['db']->query($sql);
			
			if($result->num_rows>0){
			   
				while($row = $GLOBALS['db']->fetchByAssoc($result) )
				{
				      
			    
			   	$l2_input =unserialize(base64_decode( $row['l2_input']));
			   	$l2_html = base64_decode($row['l2_html']);
			    	
 				}
			}else{
			    	$l2_input ="";
			    	$l2_html ="";
			}
			
	    		echo json_encode(array("status"=>true, "l2_input" =>$l2_input,"l2_html" =>	$l2_html ));
    	}catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
    
    
}

//------------fetching l1 and l2 template data and displaying to FE----ENDS------------

//------------ saving Year-quarters to database ---------------------------------------------------

public function action_year_quarters(){
   
    
    $id=$_POST['id'];
    $start_year = $_POST['start_year'];
     $start_quarter = $_POST['start_quarter'];
    $end_year = $_POST['end_year'];
    $end_quarter = $_POST['end_quarter'];
    $num_of_bidders = $_POST['no_of_bidders'];
   
    // echo $id,$start_year,$end_year,$start_quarter,$end_quarter,$num_of_bidders;
  try{ 
    	$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
          
          $sql ='SELECT * FROM year_quarters WHERE opp_id="'.$id.'"';
			$result = $GLOBALS['db']->query($sql);
			// print_r($result->num_rows);
			if($result->num_rows>0){
				$update_query="UPDATE year_quarters SET start_year='".$start_year."',start_quarter='". $start_quarter."',end_year='". $end_year."',end_quarter='". $end_quarter."',num_of_bidders='". $num_of_bidders."' WHERE opp_id='".$id."'";
				$res0 = $db->query($update_query);
			}else{
				$insert_query='INSERT INTO year_quarters (opp_id,start_year,start_quarter,end_year,end_quarter,num_of_bidders) VALUES ("'.$id.'", "'.$start_year.'","'. $start_quarter.'", "'.$end_year.'", "'.$end_quarter.'", "'.$num_of_bidders.'")';
				$res0 = $db->query($insert_query);
			}
    
  }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}


//------------ saving Year-quarters to database-End ---------------------------------------------------

//----------------------- fetching the year_quarters from database ----------------------------------

public function action_fetch_year_quarters(){
    
    $id=$_POST['id'];
   
    	try{
    	    
    	     if($id!=""){
    	         
    	    
			$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
	    	
	    		$sql ='SELECT * FROM year_quarters WHERE opp_id="'.$id.'"';
	    		
			$result = $GLOBALS['db']->query($sql);
			
			
			   
				while($row = $GLOBALS['db']->fetchByAssoc($result) )
				{
			   	$start_year = $row['start_year'];
			   	$start_quarter = $row['start_quarter'];
			   	$end_year = $row['end_year'];
			   	$end_quarter = $row['end_quarter'];
			   	$num_of_bidders = $row['num_of_bidders'];
			    	
 				}
			
			
			echo json_encode(array("status"=>true, "start_year" =>$start_year,"start_quarter" =>$start_quarter,"end_year" =>$end_year,"end_quarter" =>$end_quarter,"num_of_bidders" =>$num_of_bidders,"id"=>$id ));
    	     }			else{
    	         echo json_encode(array("status"=>true,"start_year" =>"","start_quarter" =>"","end_year" =>"","end_quarter" =>"","num_of_bidders" =>"","id"=>"" ));
    	     }
	    		
    	}catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
    
    
}

//----------------------- fetching the year_quarters from database ----------------------------------

//-------------------- saving the data to database dpr-bidcheckliist---------------------------------

public function action_dpr_bidchecklist(){
   
    
    $id=$_POST['id'];
    $emd = $_POST['emd'];
    $pbg = $_POST['pbg'];
    $tenure = $_POST['tenure'];
    $project_value = $_POST['project_value'];
    $project_scope = $_POST['project_scope'];
   
   
  try{ 
    	$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
          
          $sql ='SELECT * FROM DPR_bidchecklist WHERE opp_id="'.$id.'"';
			$result = $GLOBALS['db']->query($sql);
			// print_r($result->num_rows);
			if($result->num_rows>0){
				$update_query="UPDATE DPR_bidchecklist SET emd='".$emd."',pbg='". $pbg."',tenure='". $tenure."',project_value='". $project_value."',project_scope='". $project_scope."' WHERE opp_id='".$id."'";
				$res0 = $db->query($update_query);
			}else{
				$insert_query='INSERT INTO DPR_bidchecklist (opp_id,emd,pbg,tenure,project_value,project_scope) VALUES ("'.$id.'", "'.$emd.'","'. $pbg.'", "'.$tenure.'", "'.$project_value.'", "'.$project_scope.'")';
				$res0 = $db->query($insert_query);
			}
    
  }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}

//-------------------- saving the data to database dpr-bidcheckliist--end ---------------------------------

//----------------------- fetching the bidchecklist from database ----------------------------------

public function action_fetch_bidchecklist(){
    
    $id=$_POST['id'];
    	try{
			$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
	    	
	    		$sql ='SELECT * FROM DPR_bidchecklist WHERE opp_id="'.$id.'"';
	    		
			$result = $GLOBALS['db']->query($sql);
			
			if($result->num_rows>0){
			   
				while($row = $GLOBALS['db']->fetchByAssoc($result) )
				{
				      
			    
			   	$emd = $row['emd'];
			   	$pbg = $row['pbg'];
			   	$tenure = $row['tenure'];
			   	$project_value = $row['project_value'];
			   	$project_scope = $row['project_scope'];
			 
			 
			    	
 				}
			}else{
			   $emd = "";
			   	$pbg = "";
			   	$tenure = "";
			   	$project_value = "";
			   	$project_scope ="";
			}
			
				$sql1 ='SELECT * FROM bid_bidchecklist WHERE opp_id="'.$id.'"';
	    		
			$result1 = $GLOBALS['db']->query($sql1);
			
			if($result1->num_rows>0){
			   
				while($row1 = $GLOBALS['db']->fetchByAssoc($result1) )
				{
				      
			    
			   	$emd1 = $row1['emd'];
			   	$pbg1 = $row1['pbg'];
			   	$tenure1 = $row1['tenure'];
			   	$project_value1 = $row1['project_value'];
			   	$project_scope1 = $row1 ['project_scope'];
			 
			    	
 				}
			}else{
			   $emd1 = "";
			   	$pbg1 = "";
			   	$tenure1 = "";
			   	$project_value1 = "";
			   	$project_scope1 ="";
			}
			

			
	    		echo json_encode(array("status"=>true, "emd" =>$emd,"pbg" =>$pbg,"tenure" =>$tenure,"project_value" =>$project_value,"project_scope" =>$project_scope,"emd1" =>$emd1,"pbg1" =>$pbg1,"tenure1" =>$tenure1,"project_value1" =>$project_value1,"project_scope1" =>$project_scope1));
	    	   
    	}catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
    
    
}

//----------------------- fetching the  bidchecklist from database ----------------------------------

//-------------------- saving the data to database bidcheckliist---------------------------------

public function action_bid_bidchecklist(){
   
    
    $id=$_POST['id'];
    $emd = $_POST['emd'];
    $pbg = $_POST['pbg'];
    $tenure = $_POST['tenure'];
    $project_value = $_POST['project_value'];
    $project_scope = $_POST['project_scope'];
   
   
  try{ 
    	$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
          
          $sql ='SELECT * FROM bid_bidchecklist WHERE opp_id="'.$id.'"';
			$result = $GLOBALS['db']->query($sql);
			// print_r($result->num_rows);
			if($result->num_rows>0){
				$update_query="UPDATE bid_bidchecklist SET emd='".$emd."',pbg='". $pbg."',tenure='". $tenure."',project_value='". $project_value."',project_scope='". $project_scope."' WHERE opp_id='".$id."'";
				$res0 = $db->query($update_query);
			}else{
				$insert_query='INSERT INTO bid_bidchecklist (opp_id,emd,pbg,tenure,project_value,project_scope) VALUES ("'.$id.'", "'.$emd.'","'. $pbg.'", "'.$tenure.'", "'.$project_value.'", "'.$project_scope.'")';
				$res0 = $db->query($insert_query);
			}
    
  }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}

//-------------------- saving the data to database bid-bidcheckliist--end ---------------------------------
//---------------Detail View Opportunity creation checking----------------------------------------
public function action_detailView_check(){
    
    $opportunity_id=$_POST['opp_id'];
    
     try{ 
         
         global $current_user;
       
    	$log_in_user_id = $current_user->id;
    	
    //	echo $log_in_user_id;
    	
    	$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
          
          $sql ='SELECT * FROM opportunities WHERE id="'. $opportunity_id.'"';
			$result = $GLOBALS['db']->query($sql);
			
			while($row = $GLOBALS['db']->fetchByAssoc($result) )
				{
				    $created_by=$row['created_by'];
				    
				}
				
			 if(  $log_in_user_id == $created_by || $log_in_user_id == 1 ) {

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


//------------------------untag users check in detailview-------------------------- 
public function action_untag_users_check(){
    
    $opportunity_id=$_POST['opp_id'];
    
     try{ 
         
         global $current_user;
       
    	$log_in_user_id = $current_user->id;
    	
    //	echo $log_in_user_id;
    	
    	$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
          
           $sql='SELECT * FROM opportunities_users_2_c WHERE opportunities_users_2opportunities_ida="'.$opportunity_id.'" AND opportunities_users_2_c.deleted = 0';
			$result = $GLOBALS['db']->query($sql);
			
			while($row = $GLOBALS['db']->fetchByAssoc($result) )
				{
				    $untag_user=$row['opportunities_users_2users_idb'];
				    
				}
				
			 if(  $log_in_user_id == $untag_user  ) {

           	echo json_encode ("true");
                
            }else{
                echo json_encode ("false");
            }
        
				
    
  }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}

//------------------------untag users check in detailview-----END--------------------- 


//--------------------------approver selection checking process ------------------------   
    public function action_aprover_check(){
        
        $aprover_id=$_POST['aprover_id'];
        
        //echo json_encode($aprover_id);
        
         try{ 
         
       
    	
    	$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
          
          $sql="SELECT * FROM users_cstm WHERE id_c = '".$aprover_id."'";
          
			$result = $GLOBALS['db']->query($sql);
			
			while($row = $GLOBALS['db']->fetchByAssoc($result) )
				{
				   
				    $check_sales = $row['teamfunction_c'];
                    $check_mc = $row['mc_c'];
                    $check_team_lead = $row['teamheirarchy_c'];
				}
				
			
			 $team_func_array = explode(',', $check_sales);
			 
			 //echo json_encode(array("check1"=>$check_sales,"check2"=>$check_team_lead,"check3"=>$check_mc));
			 
        if((in_array("^sales^", $team_func_array)  && $check_team_lead =="team_lead")||  $check_mc =="yes" ) {
        // if(in_array("$team_func_array !== 'sales')){
            $can_approve = 'yes';
            $message = "";
        } else {
            $can_approve = 'no';
            $message = "Select Team Lead from sales for approval.";
        }
        
        
        echo json_encode(array("status"=> true, "check2"=>$check_team_lead,'approver'=>$can_approve, 'message'=>$message));
        
      } catch(Exception $e) {
          echo json_encode(array("status"=>false, "message"=>"Error Occurred"));
      }
        die();
				
    }
    
//--------------------------approver selection checking process ------END------------------       
    
//===========================Write code above this line=========================================    
}
?>