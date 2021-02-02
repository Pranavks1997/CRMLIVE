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
        if(in_array("^sales^", $team_func_array) || $current_user->is_admin  || $check_mc =="yes" || $check_team_lead =="team_lead" ) {
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
    $total_input_value =$_POST['total_input_value'];
  
  try{ 
    	$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
   
    
    $sql ='SELECT * FROM l1 WHERE opp_id="'.$id.'"';
			$result = $GLOBALS['db']->query($sql);
			
			if($result->num_rows>0){
			    
				$update_query="UPDATE l1 SET l1_html='".$l1_html."',l1_input='". $l1_input."',total_input_value='".$total_input_value."' WHERE opp_id='".$id."'";
				$res0 = $db->query($update_query);
			}else{
				$insert_query='INSERT INTO l1 (opp_id,l1_html,l1_input,total_input_value) VALUES ("'.$id.'", "'.$l1_html.'","'. $l1_input.'","'.$total_input_value.'")';
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
    
        If($id!='') {
            
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
			    $total_input_value=	$row['total_input_value'];
 				}
			}
// 			else{
// 			    	$l1_input ="";
// 			    	$l1_html ="";
// 			    	 $total_input_value="";
// 			}
	    		echo json_encode(array("status"=>true, "l1_input" =>$l1_input,"l1_html" =>	$l1_html,"total_input_value"=> $total_input_value ));
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
 				echo json_encode(array("status"=>true, "l2_input" =>$l2_input,"l2_html" =>	$l2_html ));
			}
			else{
			    	$l2_input ="";
			    	$l2_html ="";
			    		echo json_encode(array("status"=>false));
			}
			
	    		
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
    $total=$_POST['total_input_value'];
    
    
  try{ 
    	$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
          
          if($num_of_bidders==""||$num_of_bidders==0){
              $num_of_bidders = 1;
          }
          
          $sql ='SELECT * FROM year_quarters WHERE opp_id="'.$id.'"';
			$result = $GLOBALS['db']->query($sql);
			// print_r($result->num_rows);
			if($result->num_rows>0){
				$update_query="UPDATE year_quarters SET start_year='".$start_year."',start_quarter='". $start_quarter."',end_year='". $end_year."',end_quarter='". $end_quarter."',num_of_bidders='". $num_of_bidders."',total_input_value='". $total."' WHERE opp_id='".$id."'";
				$res0 = $db->query($update_query);
			}else{
				$insert_query='INSERT INTO year_quarters (opp_id,start_year,start_quarter,end_year,end_quarter,num_of_bidders,total_input_value) VALUES ("'.$id.'", "'.$start_year.'","'. $start_quarter.'", "'.$end_year.'", "'.$end_quarter.'", "'.$num_of_bidders.'", "'.$total.'")';
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
			    $total=$row['total_input_value'];	
 				}
			
			
			echo json_encode(array("status"=>true, "start_year" =>$start_year,"start_quarter" =>$start_quarter,"end_year" =>$end_year,"end_quarter" =>$end_quarter,"num_of_bidders" =>$num_of_bidders,"id"=>$id,"total"=>$total ));
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
    $total_input_value=$_POST['total_input_value'];
   
  try{ 
    	$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
          
          $sql ='SELECT * FROM DPR_bidchecklist WHERE opp_id="'.$id.'"';
			$result = $GLOBALS['db']->query($sql);
			// print_r($result->num_rows);
			if($result->num_rows>0){
				$update_query="UPDATE DPR_bidchecklist SET emd='".$emd."',pbg='". $pbg."',tenure='". $tenure."',project_value='". $project_value."',project_scope='". $project_scope."',total_input_value='".$total_input_value."' WHERE opp_id='".$id."'";
				$res0 = $db->query($update_query);
			}else{
				$insert_query='INSERT INTO DPR_bidchecklist (opp_id,emd,pbg,tenure,project_value,project_scope,total_input_value) VALUES ("'.$id.'", "'.$emd.'","'. $pbg.'", "'.$tenure.'", "'.$project_value.'", "'.$project_scope.'","'.$total_input_value.'")';
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
			    $total_input_value=$row['total_input_value'];
			 
			    	
 				}
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
			    $total_input_value1=$row1['total_input_value'];
			    	
 				}
			}
			

			
	    		echo json_encode(array("status"=>true, "emd" =>$emd,"pbg" =>$pbg,"tenure" =>$tenure,"project_value" =>$project_value,"project_scope" =>$project_scope,"total_input_value"=>$total_input_value,"emd1" =>$emd1,"pbg1" =>$pbg1,"tenure1" =>$tenure1,"project_value1" =>$project_value1,"project_scope1" =>$project_scope1,"total_input_value1"=>$total_input_value1));
	    	   
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
   $total_input_value=$_POST['total_input_value'];
   
  try{ 
    	$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
          
          $sql ='SELECT * FROM bid_bidchecklist WHERE opp_id="'.$id.'"';
			$result = $GLOBALS['db']->query($sql);
			// print_r($result->num_rows);
			if($result->num_rows>0){
				$update_query="UPDATE bid_bidchecklist SET emd='".$emd."',pbg='". $pbg."',tenure='". $tenure."',project_value='". $project_value."',project_scope='". $project_scope."',total_input_value='".$total_input_value."' WHERE opp_id='".$id."'";
				$res0 = $db->query($update_query);
			}else{
				$insert_query='INSERT INTO bid_bidchecklist (opp_id,emd,pbg,tenure,project_value,project_scope,total_input_value) VALUES ("'.$id.'", "'.$emd.'","'. $pbg.'", "'.$tenure.'", "'.$project_value.'", "'.$project_scope.'","'.$total_input_value.'")';
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
				   $assigned=$row['assigned_user_id'];
				}
			 $sql1 ='SELECT * FROM opportunities_cstm WHERE id_c="'. $opportunity_id.'"';
			$result1 = $GLOBALS['db']->query($sql1);
			
			while($row1 = $GLOBALS['db']->fetchByAssoc($result1) )
				{
				    
				     $approver=$row1['multiple_approver_c'];
				     $deligate=$row1['delegate'];
				     $approver1=$row1['user_id2_c'];
				    
				    
				}
					$sql5 = "SELECT  * FROM tagged_user WHERE opp_id='".$opportunity_id."'";
		 	$result5 = $GLOBALS['db']->query($sql5);
			while($row5 = $GLOBALS['db']->fetchByAssoc($result5))
			{
	    		    $others=$row5['user_id'];
			}	
             
		$others_id_array = explode(",",$others);
				
			 $team_func_array = explode(',', $deligate);
			 $team_func_array1 = explode(',', $approver);
			 //$team_func_array2 = explode(',', $approver1);
			 
			  $sql3 = "SELECT users.id, users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '".$log_in_user_id."' AND users.deleted = 0";
        $result3 = $GLOBALS['db']->query($sql3);
        while($row3 = $GLOBALS['db']->fetchByAssoc($result3)) 
        {
            $check_sales = $row3['teamfunction_c'];
            $check_mc = $row3['mc_c'];
            $check_team_lead = $row3['teamheirarchy_c'];
            
        }
        
			 if(  $check_mc =="yes"|| $log_in_user_id == $created_by || $current_user->is_admin || in_array($log_in_user_id, $team_func_array1)||in_array($log_in_user_id, $others_id_array)  || in_array($log_in_user_id, $team_func_array) || $log_in_user_id == $approver1 || $log_in_user_id == $assigned) {
          	 
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
          
           $sql='SELECT * FROM untagged_user WHERE opp_id="'.$opportunity_id.'" ';
			$result = $GLOBALS['db']->query($sql);
			
			while($row = $GLOBALS['db']->fetchByAssoc($result) )
				{
				    $untag_user=$row['user_id'];
				    
				}
				
			$untag_array = explode(",",$untag_user);	
				
			 if(in_array($log_in_user_id,$untag_array)) {

           	echo json_encode (array("status"=>true));
                
            }else{
                echo json_encode ("false");
            }
        
				
    
  }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}

//------------------------untag users check in detailview-----END--------------------- 
//------------------------tag users check in detailview-------------------------- 
public function action_tag_users_check(){
    
    $opportunity_id=$_POST['opp_id'];
    
     try{ 
         
         global $current_user;
       
    	$log_in_user_id = $current_user->id;
    	
    //	echo $log_in_user_id;
    	
    	$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
          
           $sql='SELECT * FROM opportunities_users_1_c WHERE opportunities_users_1opportunities_ida="'.$opportunity_id.'" AND opportunities_users_1_c.deleted = 0';
			$result = $GLOBALS['db']->query($sql);
			
			$tag_user=array();
			
			while($row = $GLOBALS['db']->fetchByAssoc($result) )
				{
				  $tag_user[]=$row['opportunities_users_1users_idb'];
				    
				}
			
				 $sql2 ='SELECT * FROM opportunities WHERE id="'. $opportunity_id.'"';
			$result2 = $GLOBALS['db']->query($sql2);
			
			while($row2 = $GLOBALS['db']->fetchByAssoc($result2) )
				{
				    $created_by=$row2['created_by'];
				   
				}
			 $sql1 ='SELECT * FROM opportunities_cstm WHERE id_c="'. $opportunity_id.'"';
			$result1 = $GLOBALS['db']->query($sql1);
			
			while($row1 = $GLOBALS['db']->fetchByAssoc($result1) )
				{
				    
				    $approver=$row1['user_id2_c'];
				     $deligate=$row1['delegate'];
				    $assigned=$row1['user_id3_c'];
				    
				}
				
			 $team_func_array = explode(',', $deligate);
			
				
			 if( in_array($log_in_user_id, $tag_user)  ) {
                
           	echo json_encode ("true");
                
            }
            
             else if(  $log_in_user_id == $created_by || $log_in_user_id == 1 ||  $log_in_user_id==$approver || in_array($log_in_user_id, $team_func_array)||$log_in_user_id == $assigned) {

          	echo json_encode ("true-readonly");
                
            }
        
				
    
  }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}

//------------------------tag users check in detailview-----END--------------------- 


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

//------------------------ for enabling first of a kind product and segment ------------


public function action_first_of_kind(){
    
    $opportunity_id=$_POST['opp_id'];
    
     try{ 
         
         global $current_user;
       
    	$log_in_user_id = $current_user->id;
    	
    	
    	$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
          
            $sql="SELECT * FROM users_cstm WHERE id_c = '".$log_in_user_id."'";
          
			$result = $GLOBALS['db']->query($sql);
			
			while($row = $GLOBALS['db']->fetchByAssoc($result) )
				{
				   
				    $check_sales = $row['teamfunction_c'];
                    $check_mc = $row['mc_c'];
                    $check_team_lead = $row['teamheirarchy_c'];
				}
			
			 $team_func_array = explode(',', $check_sales);
			 
			 //echo json_encode(array("check1"=>$check_sales,"check2"=>$check_team_lead,"check3"=>$check_mc));
			 
        if(in_array("^sales^", $team_func_array)  && $check_team_lead =="team_lead" ) {
        // if(in_array("$team_func_array !== 'sales')){
            $can_create_first_Kind = 'yes';
            
        } else {
            $can_create_first_Kind = 'no';
            
        }
        
        
        echo json_encode(array("status"=> true, "value"=>$can_create_first_Kind));
  }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}


//------------------------ for enabling first of a kind product and segment ---END---------

//---------------------Approval Buttons-----------------

    public function action_approval_buttons(){
    
    $opportunity_id=$_POST['opp_id'];
    $status=$_POST['status'];
    $rfp_eoi_published=$_POST['rfp_eoi_published'];
    $next_status='';
     try{ 
         
         global $current_user;
       
    	$log_in_user_id = $current_user->id;
    	
    	
    	$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
          
            $sql="SELECT * FROM opportunities WHERE id = '".$opportunity_id."'";
            
			$result = $GLOBALS['db']->query($sql);
			
			while($row = $GLOBALS['db']->fetchByAssoc($result) )
				{
				   
				    $created_by = $row['created_by'];
				     $assigned=$row['assigned_user_id'];
                    
				}
				  $sql2="SELECT * FROM tagged_user WHERE opp_id='".$opportunity_id."'";
        	$result2 = $GLOBALS['db']->query($sql2);
        	
        	while($row2 = $GLOBALS['db']->fetchByAssoc($result2) )
				{
				
				    $tagged_user=$row2['user_id'];
				    
				}
				
				$sq="SELECT * FROM opportunities_cstm WHERE id_c = '".$opportunity_id."'";
			$resul = $GLOBALS['db']->query($sq);
			
			while($ro = $GLOBALS['db']->fetchByAssoc($resul) )
				{
				   
				   
				    $opp_table_status = $ro ['status_c'];
				    $opp_table_published=$ro['rfporeoipublished_c'];
				    $approver=$ro['multiple_approver_c'];
				    $delegate=$ro['delegate'];
				     $new_approver=$ro['user_id2_c'];
                    
				}	
				
				
				 $tagged_user_array=array();
				 $tagged_user_array=explode(',',$tagged_user);
				 $team_func_array = explode(',', $delegate);
				 $team_func_array1 = explode(',',  $approver);
				 
				 
				  $Approved_array=array();
			    	    $Rejected_array=array();
			    	    $pending_array=array();
				 $id_mc=array();
			 $sql_mc = "SELECT * FROM users_cstm WHERE mc_c='yes'";
        $result_mc = $GLOBALS['db']->query($sql_mc);
        while($row_mc= $GLOBALS['db']->fetchByAssoc($result_mc)) 
        {
        
        array_push($id_mc,$row_mc['id_c']);
     	
        }
     
     if(in_array($log_in_user_id,$id_mc) && $log_in_user_id==$created_by){
         $mc='yes';
         
          
         	$sql2="SELECT * FROM approval_table  WHERE opp_id='".$opportunity_id."' AND status='".$status."' AND rfp_eoi_published='".$rfp_eoi_published."' AND row_count=(SELECT max(row_count) FROM approval_table WHERE sender='".$log_in_user_id."' AND opp_id='".$opportunity_id."' AND status='".$status."' AND rfp_eoi_published='".$rfp_eoi_published."' ) ";
                    			
                    				$result2 = $GLOBALS['db']->query($sql2);
                    			
                    			
                    			    if($result2->num_rows>0){
                    			        
                    			        
                    			    	while($row2 = $GLOBALS['db']->fetchByAssoc($result2) ){
                    				     
                    			    	   array_push( $Approved_array,$row2['Approved']);
                    			    	   array_push( $Rejected_array,$row2['Rejected']);
                    			    	  array_push ( $pending_array,$row2['pending']);
                    			    	   
                    			    	}
                    			    	
                    			    	$value=1;
                    			    	 foreach($Approved_array as $app){
                    			    	     $value=$app*$value;
                    			    	 }
                    			    	
                    			    	 $value1=0;
                    			    	  foreach($Rejected_array as $rej){
                    			    	     $value1=$rej+$value1;
                    			    	 }
                    			    	
                    			    	 
                    			    	 $value2=0;
                    			    	 foreach($pending_array as $pen){
                    			    	     $value2=$pen+$value2;
                    			    	 }
                    			    	 
                    			    	if($value2>0){
                    			    	    $value2=1;
                    			    	    $value1=0;
                    			    	}else{
                    			    	     $value1=1;
                    			    	    $value2=0;
                    			    	}
                    			    
                    			    	
                    	
                    			    	  
                    			   
                    			     if( $value1==1 )	{
                    			          $button = "send_approval_same";
                                     echo json_encode(array("status"=> true, "button"=>$button,'message'=>'rejected',"mc"=>$mc));
                    			    }
                    			     else if($value==1 )	{
                    			    
                    			           $button = "approve_reject";
                                      echo json_encode(array("status"=> true, "button"=>$button,"mc"=>$mc));
                    			         
                    			     }else if( $value2==1 )	{
                    			          $button = "pending";
                                     echo json_encode(array("status"=> true, "button"=>$button,'message'=>'rejected',"mc"=>$mc));
                    			                          			    }
                    			    }
                    			    
                    			    else 	{
                    			        	$sql25="SELECT * FROM approval_table  WHERE approver_rejector='".$log_in_user_id."' AND opp_id='".$opportunity_id."' AND status='".$status."' AND rfp_eoi_published='".$rfp_eoi_published."' AND row_count=(SELECT max(row_count) FROM approval_table WHERE approver_rejector='".$log_in_user_id."'  AND opp_id='".$opportunity_id."' AND status='".$status."' AND rfp_eoi_published='".$rfp_eoi_published."' ) ";
                    			
                    				$result25 = $GLOBALS['db']->query($sql25);
                    			
                    			
                    			    if($result25->num_rows>0){
                    			        
                    			        
                    			    	while($row25 = $GLOBALS['db']->fetchByAssoc($result25) ){
                    				     
                    			    	   array_push( $Approved_array,$row25['Approved']);
                    			    	   array_push( $Rejected_array,$row25['Rejected']);
                    			    	  array_push ( $pending_array,$row25['pending']);
                    			    	   
                    			    	}
                    			    	
                    			    	$value=1;
                    			    	 foreach($Approved_array as $app){
                    			    	     $value=$app*$value;
                    			    	 }
                    			    	
                    			    	 $value1=0;
                    			    	  foreach($Rejected_array as $rej){
                    			    	     $value1=$rej+$value1;
                    			    	 }
                    			    	
                    			    	 
                    			    	 $value2=0;
                    			    	 foreach($pending_array as $pen){
                    			    	     $value2=$pen+$value2;
                    			    	 }
                    			    	 
                    			    	if($value2>0){
                    			    	    $value2=1;
                    			    	    $value1=0;
                    			    	}else{
                    			    	     $value1=1;
                    			    	    $value2=0;
                    			    	}
                    			    
                    			    	
                    	
                    			    	  
                    			   
                    			     if( $value2==1 )	{
                    			          $button = "approve_reject";
                                     echo json_encode(array("status"=> true, "button"=>$button,'message'=>'rejected',"mc"=>$mc));
                    			                          			    }
                    			    }
                    			       
                    			        else{
                    			           $button = 'approve';
                                 echo json_encode(array("status"=> true, "button"=>$button,"mc"=>$mc));
                    			        }
                    				   }
                    			     
     }
     	 
				 
        //------------For approver-----------------------------------------------------------------
		else if(in_array($log_in_user_id, $team_func_array1)||$log_in_user_id==$new_approver){
			 $mc='no';   
			  	$sql2="SELECT * FROM approval_table WHERE id=(SELECT max(id) FROM approval_table WHERE approver_rejector='".$log_in_user_id."' AND opp_id='".$opportunity_id."' AND status='".$status."' AND rfp_eoi_published='".$rfp_eoi_published."')";
				
				$result2 = $GLOBALS['db']->query($sql2);
			
			
			    if($result2->num_rows>0){
			    	while($row2 = $GLOBALS['db']->fetchByAssoc($result2) ){
				    
			    	    $Approved=$row2['Approved'];
			    	    $Rejected=$row2['Rejected'];
			    	    $pending=$row2['pending'];
			    	   
			    	}
			    }
			      if( $Approved == 0 && $Rejected == 0 && $pending==1)	{
			          
			          echo json_encode(array("status"=> true, "button"=>'approve_reject',"mc"=>$mc));
			      }
			  
			}
		//---------------For sender----------------------------------------------------------------		
            else if($log_in_user_id == $created_by|| $log_in_user_id == $assigned || in_array($log_in_user_id,$tagged_user_array)) {
                    	  $mc='no';  
                    	  
                    	  // removed sender condition frpm inside select where clause
                    	    	$sql2="SELECT * FROM approval_table  WHERE opp_id='".$opportunity_id."' AND status='".$status."' AND rfp_eoi_published='".$rfp_eoi_published."' AND row_count=(SELECT max(row_count) FROM approval_table WHERE   opp_id='".$opportunity_id."' AND status='".$status."' AND rfp_eoi_published='".$rfp_eoi_published."' ) ";
                    			
                    				$result2 = $GLOBALS['db']->query($sql2);
                    			
                    			
                    			    if($result2->num_rows>0){
                    			        
                    			        
                    			    	while($row2 = $GLOBALS['db']->fetchByAssoc($result2) ){
                    				     
                    			    	   array_push( $Approved_array,$row2['Approved']);
                    			    	   array_push( $Rejected_array,$row2['Rejected']);
                    			    	  array_push ( $pending_array,$row2['pending']);
                    			    	   
                    			    	}
                    			    	
                    			    	$value=1;
                    			    	 foreach($Approved_array as $app){
                    			    	     $value=$app*$value;
                    			    	 }
                    			    	
                    			    	 $value1=0;
                    			    	  foreach($Rejected_array as $rej){
                    			    	     $value1=$rej+$value1;
                    			    	 }
                    			    	
                    			    	 
                    			    	 $value2=0;
                    			    	 foreach($pending_array as $pen){
                    			    	     $value2=$pen+$value2;
                    			    	 }
                    			    	 
                    			    	if($value2>0){
                    			    	    $value2=1;
                    			    	    $value1=0;
                    			    	}else{
                    			    	     $value1=1;
                    			    	    $value2=0;
                    			    	}
                    			    
                    			    	
                    	
                    			    	  
                    			   
                    			     if( $value1==1 )	{
                    			          $button = "send_approval_same";
                                     echo json_encode(array("status"=> true, "button"=>$button,'message'=>'rejected',"mc"=>$mc));
                    			    }
                    			     else if($value==1 )	{
                    			    
                    			           $button = "send_approval";
                                      echo json_encode(array("status"=> true, "button"=>$button,"mc"=>$mc));
                    			         
                    			     }else if( $value2==1 )	{
                    			          $button = "pending";
                                     echo json_encode(array("status"=> true, "button"=>$button,'message'=>'rejected',"mc"=>$mc));
                    			                          			    }
                    			    }
                    			    
                    			    else 	{
                    			       
                    			        
                    			           $button = 'send_approval';
                                 echo json_encode(array("status"=> true, "button"=>$button,"mc"=>$mc));
                    				  
                    				   }
                    			     
                    	    
                    	    
                    	    
                    	    
                    	    
                    	}
        //-----------------For deligate------------------------------------------------------------      
            else if(in_array($log_in_user_id, $team_func_array)){
			    $mc='no';
			  	$sql2="SELECT * FROM approval_table WHERE id=(SELECT max(id) FROM approval_table WHERE delegate_id='".$log_in_user_id."' AND opp_id='".$opportunity_id."' AND status='".$status."' AND rfp_eoi_published='".$rfp_eoi_published."')";
				
				$result2 = $GLOBALS['db']->query($sql2);
			
			
			    if($result2->num_rows>0){
			    	while($row2 = $GLOBALS['db']->fetchByAssoc($result2) ){
				    
			    	    $Approved=$row2['Approved'];
			    	    $Rejected=$row2['Rejected'];
			    	    $pending=$row2['pending'];
			    	   
			    	}
			    }
			      if( $Approved == 0 && $Rejected == 0 && $pending==1)	{
			          
			          echo json_encode(array("status"=> true, "button"=>'approve_reject',"mc"=>$mc));
			      }
			  
			}         
			    
		    		 
       
		
				
                    
				

	
        
       
        
        
        
  }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}


//---------------------Approval Buttons---------END--------

//----------------------Opp icons in detail view-----------------------

    public function action_opp_icons(){
    
    $opportunity_id=$_POST['opp_id'];
     $status=$_POST['status'];
    $rfp_eoi_published=$_POST['rfp_eoi_published'];
    
     try{ 
         
         global $current_user;
       
    	$log_in_user_id = $current_user->id;
    	
    	
    	$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
          
            $sql="SELECT * FROM opportunities WHERE id = '".$opportunity_id."'";
            
			$result = $GLOBALS['db']->query($sql);
			
			while($row = $GLOBALS['db']->fetchByAssoc($result) )
				{
				   
				    $created_by = $row['created_by'];
				     $assigned=$row['assigned_user_id'];
                    
				}
				
				$sq="SELECT * FROM opportunities_cstm WHERE id_c = '".$opportunity_id."'";
			$resul = $GLOBALS['db']->query($sq);
			
			while($ro = $GLOBALS['db']->fetchByAssoc($resul) )
				{
				   
				   
				    $opp_table_status = $ro ['status_c'];
                    $approver=$ro['multiple_approver_c'];
				    $delegate=$ro['delegate'];
				    $new_approver=$ro['user_id2_c'];
				   
                    
				}	
				
				 $team_func_array = explode(',', $delegate);
				 $team_func_array1 = explode(',',  $approver);
				 $team_func_array2 = explode(',',  $new_approver);
				 
        
		       	if(in_array($log_in_user_id, $team_func_array1)){
			    
			  	$sql2="SELECT * FROM approval_table WHERE id=(SELECT max(id) FROM approval_table  WHERE approver_rejector='".$log_in_user_id."' AND opp_id='".$opportunity_id."'  AND rfp_eoi_published='".$rfp_eoi_published."'  ORDER BY id DESC LIMIT 1)";
				
				$result2 = $GLOBALS['db']->query($sql2);
			
			
			    if($result2->num_rows>0){
			    	while($row2 = $GLOBALS['db']->fetchByAssoc($result2) ){
				    
			    	    $Approved=$row2['Approved'];
			    	    $Rejected=$row2['Rejected'];
			    	    $pending=$row2['pending'];
			    	   
			    	}
			    }
			    
			      if(  $Approved == 0 && $Rejected == 0 && $pending==1 )	{
	    
                    
                        $button = 'pending';
                        echo json_encode(array("status"=> true, "button"=>$button,'rfp_eoi_published'=>$rfp_eoi_published));
                        
        
	    
                	}
                			 
                	else if(  $Approved == 1 && $Rejected == 0 && $pending==0)	{
                	    
                     
                       
                            $button = 'green';
                            echo json_encode(array("status"=> true, "button"=>$button,'rfp_eoi_published'=>$rfp_eoi_published));
                            
                        
                	    
                	}
                else if( $Approved == 0 && $Rejected == 1 && $pending==0)	{
                	    
                      
                       
                            $button = 'red';
                            echo json_encode(array("status"=> true, "button"=>$button,'message'=>'rejected'));
                            
                        
                	    
                	}
			  
			}	
			
			 else if(in_array($log_in_user_id, $team_func_array)){
			     
			    
			  	$sql2="SELECT * FROM approval_table WHERE id=(SELECT max(id) FROM approval_table WHERE delegate_id='".$log_in_user_id."' AND opp_id='".$opportunity_id."'  AND rfp_eoi_published='".$rfp_eoi_published."'  ORDER BY id DESC LIMIT 1)";
				
				$result2 = $GLOBALS['db']->query($sql2);
			
			
			    if($result2->num_rows>0){
			      
			    	while($row2 = $GLOBALS['db']->fetchByAssoc($result2) ){
				    
			    	    $Approved=$row2['Approved'];
			    	    $Rejected=$row2['Rejected'];
			    	    $pending=$row2['pending'];
			    	   
			    	}
			    }
			    
			    
			      if(  $Approved == 0 && $Rejected == 0 && $pending==1 )	{
	    
                    
                        $button = 'pending';
                        echo json_encode(array("status"=> true, "button"=>$button,'rfp_eoi_published'=>$rfp_eoi_published));
                        
        
	    
                	}
                			 
                	else if(  $Approved == 1 && $Rejected == 0 && $pending==0)	{
                	    
                     
                       
                            $button = 'green';
                            echo json_encode(array("status"=> true, "button"=>$button,'rfp_eoi_published'=>$rfp_eoi_published));
                            
                        
                	    
                	}
                else if( $Approved == 0 && $Rejected == 1 && $pending==0)	{
                	    
                      
                       
                            $button = 'red';
                            echo json_encode(array("status"=> true, "button"=>$button,'message'=>'rejected'));
                            
                        
                	    
                	}
			  
			  
			}         
				
// 				$sql2="SELECT * FROM approval_table  WHERE date_time=(SELECT max(date_time) FROM approval_table WHERE opp_id='".$opportunity_id."')";
				
// 				$result2 = $GLOBALS['db']->query($sql2);
			
			
// 			    if($result2->num_rows>0){
// 			    	while($row2 = $GLOBALS['db']->fetchByAssoc($result2) ){
				    
// 			    	    $Approved=$row2['Approved'];
// 			    	    $Rejected=$row2['Rejected'];
// 			    	    $pending=$row2['pending'];
// 			    	    $rfp_eoi_published=$row2['rfp_eoi_published'];
// 			    	    $approval_table_status=$row2['status'];
// 			    	}
// 			    }else{
// 			        $Approved=0;
//                     $Rejected=0;
//                     $pending=0;
			        
// 			    }
			    
			    
			    
		    
				
//      	 if(  $Approved == 0 && $Rejected == 0 && $pending==1 )	{
	    
//         if(in_array($log_in_user_id, $team_func_array)|| in_array($log_in_user_id, $team_func_array1) || in_array($log_in_user_id, $team_func_array2)) {
       
//             $button = 'pending';
//             echo json_encode(array("status"=> true, "button"=>$button,'rfp_eoi_published'=>$rfp_eoi_published));
            
//         } 
	    
// 	}
			 
// 	else if(  $Approved == 1 && $Rejected == 0 && $pending==0)	{
	    
//         if(in_array($log_in_user_id, $team_func_array)|| in_array($log_in_user_id, $team_func_array1) || in_array($log_in_user_id, $team_func_array2)){
       
//             $button = 'green';
//             echo json_encode(array("status"=> true, "button"=>$button,'rfp_eoi_published'=>$rfp_eoi_published));
            
//         } 
	    
// 	}
// else if( $Approved == 0 && $Rejected == 1 && $pending==0)	{
	    
//         if(in_array($log_in_user_id, $team_func_array)|| in_array($log_in_user_id, $team_func_array1) || in_array($log_in_user_id, $team_func_array2)) {
       
//             $button = 'red';
//             echo json_encode(array("status"=> true, "button"=>$button,'message'=>'rejected'));
            
//         } 
	    
// 	}
	

	
        
       
        
        
        
  }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}


//------------------------Opp icons in detail view--END-------------

//-----------------------Send for Approval--------------------

public function action_send_for_approval(){
    
    $opportunity_id=$_POST['opp_id'];
    $status=$_POST['status'];
    $apply_for=$_POST['apply_for'];
    $date_time=$_POST['date_time'];
    $rfp_eoi_published=$_POST['rfp_eoi_published'];
    $base_url=$_POST['base_url'];
    $approver=$_POST['myJSON'];
    $approver_array=array();
    $Approved_array=array();
    $Rejected_array=array();
    $pending_array=array();
    $opp_name=$_POST['opp_name'];
    $approver_name=$_POST['multiple_approver_c'];
    $row_count=1;
     try{ 
         
         global $current_user;
       
    	$log_in_user_id = $current_user->id;
    	
    	
    	$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
	    	
	    	
	    		$sql1 = "SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id='".$log_in_user_id."'  ";
		 	$result1 = $GLOBALS['db']->query($sql1);
			while($row1 = $GLOBALS['db']->fetchByAssoc($result1))
			{
	    		    
	    		   $sender_name=$row1['fullname'];
			}
          
          
          
//           $sql1 ='SELECT * FROM opportunities_cstm WHERE id_c="'. $opportunity_id.'"';
// 			$result1 = $GLOBALS['db']->query($sql1);
			
// 			while($row1 = $GLOBALS['db']->fetchByAssoc($result1) )
// 				{
				    
// 				 echo   $approver=$row1['multiple_approver_c'];
// 				    //  $deligate=$row1['delegate'];
				    
				    
// 				}


                	if($apply_for=='qualifylead')
				{
				    $apply='Qualify Lead';
				    
				}
          else if($apply_for=='qualifyOpportunity'){$apply='Qualify Opportunity';}
          else  if($apply_for=='qualifyDpr'){$apply='Qualify DPR';}
          else  if($apply_for=='qualifyBid'){$apply='Qualify BID';}
          else  if($apply_for=='closure'){$apply='Closure';}
          else  if($apply_for=='Dropping'){$apply='Dropping Opportunity';}
          
	

			
				$approver_array=explode(',',  $approver);
				
				$email_array=array();
					$sql2 = "SELECT  * FROM users WHERE id IN ('".implode("','",$approver_array)."') ";
		 	$result2 = $GLOBALS['db']->query($sql2);
			while($row2 = $GLOBALS['db']->fetchByAssoc($result2))
			{
	    		    
	    		  array_push($email_array,$row2['user_name']);
			}
			$row_array=array();
	
	                $sql_i="SELECT * FROM approval_table WHERE  opp_id='".$opportunity_id."' AND status='".$status."' AND rfp_eoi_published='".$rfp_eoi_published."'";
	                             
	                             	$result_i = $GLOBALS['db']->query($sql_i);
	                             		
	                             			while($row_i = $GLOBALS['db']->fetchByAssoc($result_i))
			{
	    		                                   array_push($row_array,$row_i['row_count']);     
	    		                             
			}	        
			
			if(count($row_array)>=1){
			$row_count=max($row_array);
			}
                                    		
                                    		if($row_count==1||$row_count>1){	
                                    		    $row_count=$row_count+1;
                				foreach($approver_array as $approvers){
                				   
                				      $sql='INSERT INTO approval_table( opp_id,rfp_eoi_published,sender,status,apply_for,Approved,Rejected,approver_rejector,comments,date_time,pending,row_count) VALUES ("'. $opportunity_id.'","'.$rfp_eoi_published.'","'.$log_in_user_id.'","'.$status.'","'.$apply_for.'","0","0","'.$approvers.'","","'.$date_time.'","1","'.$row_count.'")';
                                    				
                                    				     
                                    			if($db->query($sql)==TRUE){
                                    			 
                                    		//alerts
                                    			 //  $alert = BeanFactory::newBean('Alerts');
                                    				// 		$alert->name ='"'.$opp_name.'"';
                                    				// 		$alert->description = ' is recieved for approval for '. $apply.' by '.$sender_name.'';
                                    				// 		$alert->url_redirect = $base_url.'?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D'.$opportunity_id;
                                    				// 		$alert->target_module = 'Opportunities';
                                    				// 		$alert->assigned_user_id = $approvers;
                                    				// 		$alert->type = 'info';
                                    				// 		$alert->is_read = 0;
                                    				// 		$alert->save();
                                    				// 		echo json_encode(array("status"=>true, "message" => "All Forms Saved Successfully and Email Sent to Business Head for Approval"));
                                    				
                                    			
                                                  
                                                 
                                                     }
                                    			
                                    			 $message="true";
                                    			
                                    				
                                    				    
                                    				    
                                            }
                                    		    
                                    		}
                                    		else{
                                    		    	foreach($approver_array as $approvers){
                				   
                				      $sql='INSERT INTO approval_table( opp_id,rfp_eoi_published,sender,status,apply_for,Approved,Rejected,approver_rejector,comments,date_time,pending,row_count) VALUES ("'. $opportunity_id.'","'.$rfp_eoi_published.'","'.$log_in_user_id.'","'.$status.'","'.$apply_for.'","0","0","'.$approvers.'","","'.$date_time.'","1","'.$row_count.'")';
                                    				
                                    				     
                                    			if($db->query($sql)==TRUE){
                                    			 
                                    		//alerts
                                    			 //  $alert = BeanFactory::newBean('Alerts');
                                    				// 		$alert->name ='"'.$opp_name.'"';
                                    				// 		$alert->description = ' is recieved for approval for '. $apply.' by '.$sender_name.'';
                                    				// 		$alert->url_redirect = $base_url.'?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D'.$opportunity_id;
                                    				// 		$alert->target_module = 'Opportunities';
                                    				// 		$alert->assigned_user_id = $approvers;
                                    				// 		$alert->type = 'info';
                                    				// 		$alert->is_read = 0;
                                    				// 		$alert->save();
                                    				// 		echo json_encode(array("status"=>true, "message" => "All Forms Saved Successfully and Email Sent to Business Head for Approval"));
                                    				
                                    			
                                                  
                                                 
                                                     }
                                    			
                                    			 $message="true";
                                    			
                                    				
                                    				    
                                    				    
                                            }
                                    		}
                                    				
	
	
		
//                 	$sql4="SELECT * FROM approval_table WHERE date_time=(SELECT max(date_time) FROM approval_table WHERE  opp_id='".$opportunity_id."' AND status='".$status."' AND rfp_eoi_published='".$rfp_eoi_published."')";
                    				
//                     				$result4 = $GLOBALS['db']->query($sql4);
                    			
                    			
//                     			    if($result4->num_rows>0){
                    			        
//                     			    	while($row4 = $GLOBALS['db']->fetchByAssoc($result4) ){
                    				    
//                     			    	   array_push( $Approved_array,$row4['Approved']);
//                     			    	   array_push( $Rejected_array,$row4['Rejected']);
//                     			    	  array_push ( $pending_array,$row4['pending']);
                    			    	   
//                     			    	}
                    			    	
//                     			    	$value=1;
//                     			    	 foreach($Approved_array as $app){
//                     			    	     $value=$app*$value;
//                     			    	 }
                    			    	 
//                     			    	 $value1=0;
//                     			    	  foreach($Rejected_array as $rej){
//                     			    	     $value1=$rej+$value1;
//                     			    	 }
                    			    	
                    			    	 
//                     			    	 $value2=0;
//                     			    	 foreach($pending_array as $pen){
//                     			    	     $value2=$pen+$value2;
//                     			    	 }
                    			    	
//                     			    	if($value1>0){
//                     			    	    $value1=1;
                    			    	   
//                     			    	}
                    			    	    
//                     			    //	echo $value1;
                    			    	 
//                                         if($value1==1 )	{
                                            
                                            
//                                             	foreach($approver_array as $approvers){
                				     
//                 				          	$sql="UPDATE approval_table SET Approved=0,Rejected=0,pending=1 WHERE approver_rejector='".$approvers."' AND opp_id='".$opportunity_id."' AND status='".$status."' AND rfp_eoi_published='".$rfp_eoi_published."' " ;		     
                                    		
//                                     			if($db->query($sql)==TRUE){
//                                     			 ////alerts
//                                     			 //  $alert = BeanFactory::newBean('Alerts');
//                                     				// 		$alert->name =$opp_name;
//                                     				// 		$alert->description = ' is recieved for approval for '. $apply.' by '.$sender_name.'';
//                                     				// 		$alert->url_redirect = $base_url.'?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D'.$opportunity_id;
//                                     				// 		$alert->target_module = 'Opportunities';
//                                     				// 		$alert->assigned_user_id = $approvers;
//                                     				// 		$alert->type = 'info';
//                                     				// 		$alert->is_read = 0;
//                                     				// 		$alert->save();
//                                     				// 		echo json_encode(array("status"=>true, "message" => "All Forms Saved Successfully and Email Sent to Business Head for Approval"));
                                    				
                                    			
                                                 
//                                                      }
                                    			
//                                     			 $message="true";
                                    			
                                    				
                                    				    
                                    				    
//                                             }
                                    				
                                            
                    			        
//                     			    }
                    			 
//   }
  
     
//         			     else 	{
                                                        			          
                                    			
//                 				foreach($approver_array as $approvers){
                				   
//                 				      $sql='INSERT INTO approval_table( opp_id,rfp_eoi_published,sender,status,apply_for,Approved,Rejected,approver_rejector,comments,date_time,pending) VALUES ("'. $opportunity_id.'","'.$rfp_eoi_published.'","'.$log_in_user_id.'","'.$status.'","'.$apply_for.'","0","0","'.$approvers.'","","'.$date_time.'","1")';
                                    				
                                    				     
//                                     			if($db->query($sql)==TRUE){
                                    			 
//                                     		//alerts
//                                     			 //  $alert = BeanFactory::newBean('Alerts');
//                                     				// 		$alert->name ='"'.$opp_name.'"';
//                                     				// 		$alert->description = ' is recieved for approval for '. $apply.' by '.$sender_name.'';
//                                     				// 		$alert->url_redirect = $base_url.'?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D'.$opportunity_id;
//                                     				// 		$alert->target_module = 'Opportunities';
//                                     				// 		$alert->assigned_user_id = $approvers;
//                                     				// 		$alert->type = 'info';
//                                     				// 		$alert->is_read = 0;
//                                     				// 		$alert->save();
//                                     				// 		echo json_encode(array("status"=>true, "message" => "All Forms Saved Successfully and Email Sent to Business Head for Approval"));
                                    				
                                    			
                                                  
                                                 
//                                                      }
                                    			
//                                     			 $message="true";
                                    			
                                    				
                                    				    
                                    				    
//                                             }
                                    				
//                     			     }			
				
			
			
			
			
			
			
			
			
				if ($message=="true"){
				   echo 'Opportunity  "'.$opp_name.'" has been sent to '.$approver_name.' for approval';
				   	// foreach($email_array as $email){
        //                             				$template = '"'.$opp_name.'" is recieved for approval for '. $apply.' by '.$sender_name.' Please Review : <a href="'.$base_url.'?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D'.$opportunity_id.'">Click Here</a>';
        //                             						require_once('include/SugarPHPMailer.php');
        //                             						include_once('include/utils/db_utils.php');
        //                             					    $emailObj = new Email();  
        //                             					    $defaults = $emailObj->getSystemDefaultEmail();  
        //                             					    $mail = new SugarPHPMailer();  
        //                             					    $mail->setMailerForSystem();  
        //                             					    $mail->From = $defaults['xelpmocdeveloper@gmail.com'];  
        //                             					    $mail->FromName = $defaults['xelpmoc'];  
        //                             					    $mail->Subject = ''. $opp_name.'  is sent for  approval'; 
        //                             						$mail->Body =$template;
        //                             					    $mail->prepForOutbound();  
        //                             					    $mail->AddAddress($email); 
        //                             					    @$mail->Send();
        //                             				}
				}
				
			

		
          

  
  }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}

		die();
}



//-----------------------Send for Approval-------END-------------

//---------------------Approve or Reject -------------------------------------------
public function action_approve(){
    
    $opportunity_id=$_POST['opp_id'];
    $status=$_POST['status'];
    $apply_for=$_POST['apply_for'];
    $date_time=$_POST['date_time'];
    $rfp_eoi_published=$_POST['rfp_eoi_published'];
    $Approved=$_POST['approved'];
    $Rejected=$_POST['rejected'];
    $Comments=$_POST['comments'];
    $pending=$_POST['pending'];
    $next_status=$_POST['next_status'];
    $base_url=$_POST['base_url'];
    $approver=$_POST['myJSON'];
     $Approved_array=array();
	 $Rejected_array=array();
	 $pending_array=array();
	  $approver_array=array();
	 
	  $row_count=1;
	  
	  $mes='';
     try{ 
         
         global $current_user;
       
    	$log_in_user_id = $current_user->id;
    	
    	
    	$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
	    	
          
          
          
          	
				$sq="SELECT * FROM opportunities_cstm WHERE id_c = '".$opportunity_id."'";
			$resul = $GLOBALS['db']->query($sq);
			
			while($ro = $GLOBALS['db']->fetchByAssoc($resul) )
				{
				   
				   
				    $opp_table_status = $ro ['status_c'];
				    $opp_table_published=$ro['rfporeoipublished_c'];
				   // $approver=$ro['multiple_approver_c'];
				    $delegate=$ro['delegate'];
				     $new_approver=$ro['user_id2_c'];
                    
				}	
				 $team_func_array = explode(',', $delegate);
				 $approver_array=explode(',', $approver);
				$alert_users=array();
				
				  $sql="SELECT * FROM opportunities WHERE id = '".$opportunity_id."'";
            
			$result = $GLOBALS['db']->query($sql);
			
			while($row = $GLOBALS['db']->fetchByAssoc($result) )
				{
				   $opp_name=$row['name'];
				   array_push($alert_users, $row['created_by']);
				   array_push($alert_users,$row['assigned_user_id']);
                    
				}
				  $sql2="SELECT * FROM tagged_user WHERE opp_id='".$opportunity_id."'";
        	$result2 = $GLOBALS['db']->query($sql2);
        	
        	while($row2 = $GLOBALS['db']->fetchByAssoc($result2) )
				{
				
				 $tag=$row2['user_id'];
				    
				}
				$tag_array=array();
				$tag_array=explode(',',$tag);
				
				$alert_users=array_merge($alert_users,$tag_array);
			
			$alert_users=array_unique($alert_users);
			
          	$sql1 = "SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id='".$log_in_user_id."'  ";
		 	$result1 = $GLOBALS['db']->query($sql1);
			while($row1 = $GLOBALS['db']->fetchByAssoc($result1))
			{
	    		    
	    		   $approver_name=$row1['fullname'];
			}
          
           
           	if($apply_for=='qualifylead')
				{
				    $apply='Qualify Lead';
				    
				}
          else if($apply_for=='qualifyOpportunity'){$apply='Qualify Opportunity';}
          else  if($apply_for=='qualifyDpr'){$apply='Qualify DPR';}
          else  if($apply_for=='qualifyBid'){$apply='Qualify BID';}
          else  if($apply_for=='closure'){$apply='Closure';}
          else  if($apply_for=='Dropping'){$apply='Dropping Opportunity';
              
          } 
          
          	$email_array=array();
					$sql23 = "SELECT  * FROM users WHERE id IN ('".implode("','",$alert_users)."') ";
		 	$result23 = $GLOBALS['db']->query($sql23);
			while($row23 = $GLOBALS['db']->fetchByAssoc($result23))
			{
	    		    
	    		  array_push($email_array,$row23['user_name']);
			}
	
		//for mc
		
		$id_mc = array();
		 $sql_mc = "SELECT * FROM users_cstm WHERE mc_c='yes'";
        $result_mc = $GLOBALS['db']->query($sql_mc);
        while($row_mc= $GLOBALS['db']->fetchByAssoc($result_mc)) 
        {
        
        array_push($id_mc,$row_mc['id_c']);
     	
        }
        
        	$opp_mc='SELECT * From opportunities WHERE id="'.$opportunity_id.'"';
				$re_mc= $GLOBALS['db']->query($opp_mc);
			while($ow_mc = $GLOBALS['db']->fetchByAssoc($re_mc))
			{
	    		    $by_mc=$ow_mc['created_by'];
			}
     
     if(in_array($log_in_user_id,$id_mc) && $log_in_user_id==$by_mc){
         
         	$row_array=array();
	
	                $sql_i="SELECT * FROM approval_table WHERE  opp_id='".$opportunity_id."' AND status='".$status."' AND rfp_eoi_published='".$rfp_eoi_published."'";
	                             
	                             	$result_i = $GLOBALS['db']->query($sql_i);
	                             		
	                             			while($row_i = $GLOBALS['db']->fetchByAssoc($result_i))
			{
	    		                                   array_push($row_array,$row_i['row_count']); 
	    		                                  
	    		                                   
	    		                             
			}	        
			
			if(count($row_array)>=1){
			$row_count=max($row_array);
			}
                                    		
                                    		if($row_count==1||$row_count>1){	
                                    		    $row_count=$row_count+1;
                                    		    
                                    		    $sql_i11="SELECT * FROM approval_table WHERE  opp_id='".$opportunity_id."' AND status='".$status."' AND rfp_eoi_published='".$rfp_eoi_published."' AND approver_rejector='".$log_in_user_id."' AND pending=1";
                				   
                				                 $result_i11= $GLOBALS['db']->query($sql_i11);
                				   
                				   if($result_i11->num_rows>0){
              
            
             $sql_i12='UPDATE approval_table SET Approved="'.$Approved.'" ,Rejected="'.$Rejected.'",pending="'.$pending.'",comments="'.$Comments.'",date_time="'.$date_time.'" WHERE opp_id="'.$opportunity_id.'"  AND approver_rejector="'.$log_in_user_id.'" AND status="'.$status.'" AND rfp_eoi_published="'.$rfp_eoi_published.'" AND pending=1';
              $result_i12= $GLOBALS['db']->query($sql_i12);
              
              	$sql27="SELECT * FROM approval_table  WHERE opp_id='".$opportunity_id."' AND status='".$status."' AND rfp_eoi_published='".$rfp_eoi_published."' AND row_count=(SELECT max(row_count) FROM approval_table WHERE  opp_id='".$opportunity_id."' AND status='".$status."' AND rfp_eoi_published='".$rfp_eoi_published."')";
                    			
                    				$result27= $GLOBALS['db']->query($sql27);
                    			
                    			
                    			    if($result27->num_rows>0){
                    			       
                    			        
                    			    	while($row27 = $GLOBALS['db']->fetchByAssoc($result27) ){
                    				     
                    			    	   array_push( $Approved_array,$row27['Approved']);
                    			    	   array_push( $Rejected_array,$row27['Rejected']);
                    			    	  array_push ( $pending_array,$row27['pending']);
                    			    	   
                    			    	}
                    			    	
                    			    	
                    			    	$value=1;
                    			    	 foreach($Approved_array as $app){
                    			    	     
                    			    	     $value=$app*$value;
                    			    	    	$value;
                    			    	 }
                    			    
                    			    }
                    		
                   if($value>0)	{
                    			       
                    			        $sql77="UPDATE opportunities_cstm SET status_c='".$next_status."' WHERE id_c='".$opportunity_id."'";
              
                    			 
                    			    
                    			     if($db->query($sql77)==TRUE){
                    			         
                    			         
                    			        echo json_encode(array("status"=>true,"next_status"=>$next_status));
                    			        
                    			         
                    			        
                    			        
                    			     }  
                    	         
                    			     }else{
                    			         echo json_encode("approved");
                    			         
                    			            
                    			     }
                				       
                				   }
                				   
                				   else{
                				      
                				       
                				       
                				       
                				       
                				       
            $sql_approve = 'INSERT INTO approval_table(opp_id,rfp_eoi_published,sender,status,apply_for,Approved,Rejected,approver_rejector,comments,date_time,pending,row_count) VALUES ("'. $opportunity_id.'","'.$rfp_eoi_published.'","'.$log_in_user_id.'","'.$status.'","'.$apply_for.'","1","0","'.$log_in_user_id.'","'.$Comments.'","'.$date_time.'","0","'.$row_count.'")';
            
       //  $result_approve = $GLOBALS['db']->query($sql_approve);
           if($GLOBALS['db']->query($sql_approve)==TRUE){
               
                array_shift($approver_array);
               	foreach($approver_array as $approvers){
                				   
                				      $sql_1='INSERT INTO approval_table( opp_id,rfp_eoi_published,sender,status,apply_for,Approved,Rejected,approver_rejector,comments,date_time,pending,row_count) VALUES ("'. $opportunity_id.'","'.$rfp_eoi_published.'","'.$log_in_user_id.'","'.$status.'","'.$apply_for.'","0","0","'.$approvers.'","","'.$date_time.'","1","'.$row_count.'")';
                                    				
                                    	$result_approve1 = $GLOBALS['db']->query($sql_1);			     
                                    		
                                  		//  if($GLOBALS['db']->query($sql_approve)==TRUE){}
           	    
           	}
               
               if($rfp_eoi_published=='no'||$rfp_eoi_published=='not_required'){
                   
                   if($status=="Lead"||$status=="QualifiedLead"){
                       
                        $sql7="UPDATE opportunities_cstm SET status_c='".$next_status."' WHERE id_c='".$opportunity_id."'";
              
                    			 
                    			    
                    			     if($db->query($sql7)==TRUE){
                    			         
                    			         
                    			        echo json_encode(array("status"=>true,"next_status"=>$next_status));
                    			         //alerts
                    			       
                    			     }  
                   }
                   else{
                       echo json_encode("approved");
                   }
               }
               else  if($rfp_eoi_published=='yes'){
                   if($status=="Lead"){
                       
                        $sql7="UPDATE opportunities_cstm SET status_c='".$next_status."' WHERE id_c='".$opportunity_id."'";
              
                    			 
                    			    
                    			     if($db->query($sql7)==TRUE){
                    			         
                    			         
                    			        echo json_encode(array("status"=>true,"next_status"=>$next_status));
                    			         //alerts
                    			       
                    			     }  
                   }
                   else{
                       echo json_encode("approved");
                   }
               }
               
               
           }
        
                
                                    		    
                                    		    
                                    		}		
        
                                               		} 
                                               		
                                               		
                                               		
                                               		
                                    		
                                    
                                    		
                                    		
                                    		
                                    		
                                    		
                                    		
                                    		
              
     }
     else{
         
         if(in_array($log_in_user_id, $team_func_array)){
                        
          $sql4="SELECT * FROM approval_table WHERE delegate_id='".$log_in_user_id."'";
          
          $result4= $GLOBALS['db']->query($sql4);
          
         if($result4->num_rows>0){
              
             
              $sql='UPDATE approval_table SET Approved="'.$Approved.'" ,Rejected="'.$Rejected.'",pending="'.$pending.'",delegate_comments="'.$Comments.'",delegate_date_time="'.$date_time.'"  WHERE opp_id="'.$opportunity_id.'"  AND delegate_id="'.$log_in_user_id.'" AND status="'.$status.'" AND rfp_eoi_published="'.$rfp_eoi_published.'" AND pending=1';
              $result= $GLOBALS['db']->query($sql);
               if($GLOBALS['db']->query($sql)==TRUE){
                   
            //   foreach($alert_users as $user){
            //                         			   $alert = BeanFactory::newBean('Alerts');
            //                         						$alert->name ='"'.$opp_name.'"';
            //                         						$alert->description = ' is approved for '. $apply.' by '.$approver_name.'';
            //                         						$alert->url_redirect = $base_url.'?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D'.$opportunity_id;
            //                         						$alert->target_module = 'Opportunities';
            //                         						$alert->assigned_user_id = $user;
            //                         						$alert->type = 'info';
            //                         						$alert->is_read = 0;
            //                         						$alert->save(); 
                    			             
            //         			         }
            //         		// //emails
            //                         					foreach($email_array as $email){
            //                         				$template = '"'.$opp_name.'" is approved for '. $apply.' by '.$sender_name.' Please Review : <a href="'.$base_url.'?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D'.$opportunity_id.'">Click Here</a>';
            //                         						require_once('include/SugarPHPMailer.php');
            //                         						include_once('include/utils/db_utils.php');
            //                         					    $emailObj = new Email();  
            //                         					    $defaults = $emailObj->getSystemDefaultEmail();  
            //                         					    $mail = new SugarPHPMailer();  
            //                         					    $mail->setMailerForSystem();  
            //                         					    $mail->From = $defaults['xelpmocdeveloper@gmail.com'];  
            //                         					    $mail->FromName = $defaults['xelpmoc'];  
            //                         					    $mail->Subject = ''. $opp_name.'  is approved'; 
            //                         						$mail->Body =$template;
            //                         					    $mail->prepForOutbound();  
            //                         					    $mail->AddAddress($email); 
            //                         					    @$mail->Send();
            //                         				}		         
              }
             
           
         }
                           	$sql2="SELECT * FROM approval_table  WHERE opp_id='".$opportunity_id."' AND status='".$status."' AND rfp_eoi_published='".$rfp_eoi_published."' AND row_count=(SELECT max(row_count) FROM approval_table WHERE  opp_id='".$opportunity_id."' AND status='".$status."' AND rfp_eoi_published='".$rfp_eoi_published."') ";
                    			
                    				$result2 = $GLOBALS['db']->query($sql2);
                    			
                    			
                    			    if($result2->num_rows>0){
                    			        
                    			        
                    			    	while($row2 = $GLOBALS['db']->fetchByAssoc($result2) ){
                    				     
                    			    	   array_push( $Approved_array,$row2['Approved']);
                    			    	   array_push( $Rejected_array,$row2['Rejected']);
                    			    	  array_push ( $pending_array,$row2['pending']);
                    			    	   
                    			    	}
                    			    	
                    			    	
                    			    	$value=1;
                    			    	 foreach($Approved_array as $app){
                    			    	     
                    			    	     $value=$app*$value;
                    			    	     	$value;
                    			    	 }
                    			    
                    			    }
                    			    
                   if($value>0)	{
                    			       
                    			        $sql7="UPDATE opportunities_cstm SET status_c='".$next_status."' WHERE id_c='".$opportunity_id."'";
              
                    			 
                    			    
                    			     if($db->query($sql7)==TRUE){
                    			         
                    			         
                    			        echo json_encode(array("status"=>true,"next_status"=>$next_status));
                    			         //alerts
                    			       
                    			     }  
                    	         
                    			     }else{
                    			         echo json_encode("approved");
                    			             //alerts
                    			        
                    			     }
          
         } 
         
         else{
                    
          $sql4="SELECT * FROM approval_table WHERE approver_rejector='".$log_in_user_id."'";
          
          $result4= $GLOBALS['db']->query($sql4);
          
         if($result4->num_rows>0){
              
             
              $sql='UPDATE approval_table SET Approved="'.$Approved.'" ,Rejected="'.$Rejected.'",pending="'.$pending.'",comments="'.$Comments.'",date_time="'.$date_time.'" WHERE opp_id="'.$opportunity_id.'"  AND approver_rejector="'.$log_in_user_id.'" AND status="'.$status.'" AND rfp_eoi_published="'.$rfp_eoi_published.'" AND pending=1';
              $result= $GLOBALS['db']->query($sql);
              if($GLOBALS['db']->query($sql)==TRUE){
                  
            //   foreach($alert_users as $user){
            //                         			   $alert = BeanFactory::newBean('Alerts');
            //                         						$alert->name ='"'.$opp_name.'"';
            //                         						$alert->description = ' is approved for '. $apply.' by '.$approver_name.'';
            //                         						$alert->url_redirect = $base_url.'?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D'.$opportunity_id;
            //                         						$alert->target_module = 'Opportunities';
            //                         						$alert->assigned_user_id = $user;
            //                         						$alert->type = 'info';
            //                         						$alert->is_read = 0;
            //                         						$alert->save(); 
                    			             
            //         			         }
                    			         
            //         			         	// //emails
            //                         					foreach($email_array as $email){
            //                         				$template = '"'.$opp_name.'" is approved for '. $apply.' by '.$sender_name.' Please Review : <a href="'.$base_url.'?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D'.$opportunity_id.'">Click Here</a>';
            //                         						require_once('include/SugarPHPMailer.php');
            //                         						include_once('include/utils/db_utils.php');
            //                         					    $emailObj = new Email();  
            //                         					    $defaults = $emailObj->getSystemDefaultEmail();  
            //                         					    $mail = new SugarPHPMailer();  
            //                         					    $mail->setMailerForSystem();  
            //                         					    $mail->From = $defaults['xelpmocdeveloper@gmail.com'];  
            //                         					    $mail->FromName = $defaults['xelpmoc'];  
            //                         					    $mail->Subject = ''. $opp_name.' is approved'; 
            //                         						$mail->Body =$template;
            //                         					    $mail->prepForOutbound();  
            //                         					    $mail->AddAddress($email); 
            //                         					    @$mail->Send();
            //                         				}
              }
             
           
         }
                           	$sql2="SELECT * FROM approval_table  WHERE opp_id='".$opportunity_id."' AND status='".$status."' AND rfp_eoi_published='".$rfp_eoi_published."' AND row_count=(SELECT max(row_count) FROM approval_table WHERE  opp_id='".$opportunity_id."' AND status='".$status."' AND rfp_eoi_published='".$rfp_eoi_published."')";
                    			
                    				$result2 = $GLOBALS['db']->query($sql2);
                    			
                    			
                    			    if($result2->num_rows>0){
                    			        
                    			        
                    			    	while($row2 = $GLOBALS['db']->fetchByAssoc($result2) ){
                    				     
                    			    	   array_push( $Approved_array,$row2['Approved']);
                    			    	   array_push( $Rejected_array,$row2['Rejected']);
                    			    	  array_push ( $pending_array,$row2['pending']);
                    			    	   
                    			    	}
                    			    	
                    			    	
                    			    	$value=1;
                    			    	 foreach($Approved_array as $app){
                    			    	     
                    			    	     $value=$app*$value;
                    			    	    	$value;
                    			    	 }
                    			    
                    			    }
                    			//echo $value;
                   if($value>0)	{
                    			       
                    			        $sql7="UPDATE opportunities_cstm SET status_c='".$next_status."' WHERE id_c='".$opportunity_id."'";
              
                    			 
                    			    
                    			     if($db->query($sql7)==TRUE){
                    			         
                    			         
                    			        echo json_encode(array("status"=>true,"next_status"=>$next_status));
                    			        
                    			         
                    			        
                    			        
                    			     }  
                    	         
                    			     }else{
                    			         echo json_encode("approved");
                    			         
                    			            
                    			     }
          
         }
     }
          
         
   
      
        
        
  }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}




//---------------------Approve or Reject -------------------------------------------

//---------------------Approve or Reject -------------------------------------------
public function action_reject(){
    
    $opportunity_id=$_POST['opp_id'];
    $status=$_POST['status'];
    $apply_for=$_POST['apply_for'];
    $date_time=$_POST['date_time'];
    $rfp_eoi_published=$_POST['rfp_eoi_published'];
    $Approved=$_POST['approved_reject'];
    $Rejected=$_POST['rejected_reject'];
    $pending=$_POST['pending_reject'];
    $Comments=$_POST['comment_reject'];
    $base_url=$_POST['base_url'];
   
     try{ 
         
         global $current_user;
       
    	$log_in_user_id = $current_user->id;
    	
    	
    	$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
	    	
	    		
				$sq="SELECT * FROM opportunities_cstm WHERE id_c = '".$opportunity_id."'";
			$resul = $GLOBALS['db']->query($sq);
			
			while($ro = $GLOBALS['db']->fetchByAssoc($resul) )
				{
				   
				   
				    $opp_table_status = $ro ['status_c'];
				    $opp_table_published=$ro['rfporeoipublished_c'];
				    $approver=$ro['multiple_approver_c'];
				    $delegate=$ro['delegate'];
				     $new_approver=$ro['user_id2_c'];
                    
				}	
          
           $team_func_array = explode(',', $delegate);
           
           	$alert_users=array();
				
				  $sql="SELECT * FROM opportunities WHERE id = '".$opportunity_id."'";
            
			$result = $GLOBALS['db']->query($sql);
			
			while($row = $GLOBALS['db']->fetchByAssoc($result) )
				{
				   $opp_name=$row['name'];
				   array_push($alert_users, $row['created_by']);
				   array_push($alert_users,$row['assigned_user_id']);
                    
				}
				  $sql2="SELECT * FROM tagged_user WHERE opp_id='".$opportunity_id."'";
        	$result2 = $GLOBALS['db']->query($sql2);
        	
        	while($row2 = $GLOBALS['db']->fetchByAssoc($result2) )
				{
				
				   $tag=$row2['user_id'];
				    
				}
				$tag_array=array();
				$tag_array=explode(',',$tag);
				
				$alert_users=array_merge($alert_users,$tag_array);
			
			$alert_users=array_unique($alert_users);
          	$sql1 = "SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id='".$log_in_user_id."'  ";
		 	$result1 = $GLOBALS['db']->query($sql1);
			while($row1 = $GLOBALS['db']->fetchByAssoc($result1))
			{
	    		    
	    		   $approver_name=$row1['fullname'];
			}
          
           
           	if($apply_for=='qualifylead')
				{
				    $apply='Qualify Lead';
				    
				}
          else if($apply_for=='qualifyOpportunity'){$apply='Qualify Opportunity';}
          else  if($apply_for=='qualifyDpr'){$apply='Qualify DPR';}
          else  if($apply_for=='qualifyBid'){$apply='Qualify BID';}
          else  if($apply_for=='closure'){$apply='Closure';}
          else  if($apply_for=='Dropping'){$apply='Dropping Opportunity';
              
          } 
          	$email_array=array();
					$sql23 = "SELECT  * FROM users WHERE id IN ('".implode("','",$alert_users)."') ";
		 	$result23 = $GLOBALS['db']->query($sql23);
			while($row23 = $GLOBALS['db']->fetchByAssoc($result23))
			{
	    		    
	    		  array_push($email_array,$row23['user_name']);
			}
	
           
           
           
           
          
         if(in_array($log_in_user_id, $team_func_array)){
             
                $sql4="SELECT * FROM approval_table WHERE delegate_id='".$log_in_user_id."'";
          
          $result4= $GLOBALS['db']->query($sql4);
          
         if($result4->num_rows>0){
             
             
              $sql='UPDATE approval_table SET Approved="'.$Approved.'" ,Rejected="'.$Rejected.'",pending="'.$pending.'", delegate_comments="'.$Comments.'", delegate_date_time="'.$date_time.'" WHERE opp_id="'.$opportunity_id.'"   AND delegate_id="'.$log_in_user_id.'"  AND status="'.$status.'" AND rfp_eoi_published="'.$rfp_eoi_published.'" AND pending=1';
              $result= $GLOBALS['db']->query($sql);
              echo "rejected";
                   //alerts
                    			         //foreach($alert_users as $user){
                                //     			   $alert = BeanFactory::newBean('Alerts');
                                //     						$alert->name ='"'.$opp_name.'"';
                                //     						$alert->description = ' is rejected for '. $apply.' by '.$approver_name.'';
                                //     						$alert->url_redirect = $base_url.'?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D'.$opportunity_id;
                                //     						$alert->target_module = 'Opportunities';
                                //     						$alert->assigned_user_id = $user;
                                //     						$alert->type = 'info';
                                //     						$alert->is_read = 0;
                                //     						$alert->save(); 
                    			             
                    			         //}
                    			         //	foreach($email_array as $email){
                                //     				$template = '"'.$opp_name.'" is rejected for '. $apply.' by '.$sender_name.' Please Review : <a href="'.$base_url.'?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D'.$opportunity_id.'">Click Here</a>';
                                //     						require_once('include/SugarPHPMailer.php');
                                //     						include_once('include/utils/db_utils.php');
                                //     					    $emailObj = new Email();  
                                //     					    $defaults = $emailObj->getSystemDefaultEmail();  
                                //     					    $mail = new SugarPHPMailer();  
                                //     					    $mail->setMailerForSystem();  
                                //     					    $mail->From = $defaults['xelpmocdeveloper@gmail.com'];  
                                //     					    $mail->FromName = $defaults['xelpmoc'];  
                                //     					    $mail->Subject = ''. $opp_name.'  is rejected'; 
                                //     						$mail->Body =$template;
                                //     					    $mail->prepForOutbound();  
                                //     					    $mail->AddAddress($email); 
                                //     					    @$mail->Send();
                                //     				}
         }
         
             
         }
         
         else{
                $sql4="SELECT * FROM approval_table WHERE approver_rejector='".$log_in_user_id."'";
          
          $result4= $GLOBALS['db']->query($sql4);
          
         if($result4->num_rows>0){

             
              $sql='UPDATE approval_table SET Approved="'.$Approved.'" ,Rejected="'.$Rejected.'",pending="'.$pending.'",comments="'.$Comments.'",date_time="'.$date_time.'" WHERE opp_id="'.$opportunity_id.'"  AND approver_rejector="'.$log_in_user_id.'"  AND  status="'.$status.'" AND rfp_eoi_published="'.$rfp_eoi_published.'" AND pending=1';
              $result= $GLOBALS['db']->query($sql);
              echo "rejected";
              
               //alerts
                    			         //foreach($alert_users as $user){
                                //     			   $alert = BeanFactory::newBean('Alerts');
                                //     						$alert->name ='"'.$opp_name.'"';
                                //     						$alert->description = ' is rejected for '. $apply.' by '.$approver_name.'';
                                //     						$alert->url_redirect = $base_url.'?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D'.$opportunity_id;
                                //     						$alert->target_module = 'Opportunities';
                                //     						$alert->assigned_user_id = $user;
                                //     						$alert->type = 'info';
                                //     						$alert->is_read = 0;
                                //     						$alert->save(); 
                    			             
                    			         //}
                    			         //	foreach($email_array as $email){
                                //     				$template = '"'.$opp_name.'" is rejected for '. $apply.' by '.$sender_name.' Please Review : <a href="'.$base_url.'?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D'.$opportunity_id.'">Click Here</a>';
                                //     						require_once('include/SugarPHPMailer.php');
                                //     						include_once('include/utils/db_utils.php');
                                //     					    $emailObj = new Email();  
                                //     					    $defaults = $emailObj->getSystemDefaultEmail();  
                                //     					    $mail = new SugarPHPMailer();  
                                //     					    $mail->setMailerForSystem();  
                                //     					    $mail->From = $defaults['xelpmocdeveloper@gmail.com'];  
                                //     					    $mail->FromName = $defaults['xelpmoc'];  
                                //     					    $mail->Subject = ''. $opp_name.'  is rejected'; 
                                //     						$mail->Body =$template;
                                //     					    $mail->prepForOutbound();  
                                //     					    $mail->AddAddress($email); 
                                //     					    @$mail->Send();
                                //     				}
         }
         
         }
                        
	    	
	    	
          
            
         

        
  }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}




//--------------------- Reject -------------------------------------------

//----------------------------fetch comments of tag users--------------------------

public function action_tag_users_comments_fetch(){
    
    $opportunity_id=$_POST['opp_id'];
    
     try{ 
         
    	$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
          
           $sql='SELECT * FROM opportunities_cstm WHERE id_c="'.$opportunity_id.'"';
			$result = $GLOBALS['db']->query($sql);
			
			while($row = $GLOBALS['db']->fetchByAssoc($result) )
				{
				    $comments=$row['comment_c'];
				    
				}
				
			 if(  $comments!='') {

           	echo json_encode (array("status"=>true, "comments" =>$comments ));
                
            }else{
                echo json_encode (array("status"=>false, "comments" =>"" ));
            }
        
				
    
  }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}

//----------------------------fetch comments of tag users--------------------------

//------------------------------Save comments of tag users---------------------------

public function action_tag_users_comments_save(){
    
    $opportunity_id=$_POST['opp_id'];
    $comments=$_POST['tagged_comments'];
    
     try{ 
         
        
    	
    
    	
    	$db = \DBManagerFactory::getInstance();
	    	$GLOBALS['db'];
          
           $sql='UPDATE opportunities_cstm SET comment_c=concat(comment_c,",'.$comments.'") WHERE id_c="'.$opportunity_id.'"';
           
			$result = $GLOBALS['db']->query($sql);
			
			
         
         
         
     }catch(Exception $e){
    		echo json_encode(array("status"=>false, "message" => "Some error occured"));
    	}
		die();
}

//--------------------------------------------------------------------------------------------------------------

//--------------------------------custom popup------------------------------------------------------------------

public function action_Popup()
	{
		$this->view = 'Popup';
	}



//----------------------------------custom popup---------------END----------------------------------------------
//----------------------------------------feedback saving-----------------------------------------------
public function action_feedback()
    {
        $date=$_POST['date_time'];
        $link=$_POST['base_url'];
        $issue=$_POST['issue'];
        $module_id=$_POST['opp_id'];
      try{  
        global $current_user;
       
    	  $log_in_user_id = $current_user->id;
   
    	  $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
       
      $sql='SELECT * FROM users WHERE id="'.$log_in_user_id.'"';
       	$result = $GLOBALS['db']->query($sql);
       	while($row = $GLOBALS['db']->fetchByAssoc($result) )
				{
				    $first_name=$row['first_name'];
				     $last_name=$row['last_name'];
				     $email=$row['user_name'];
				    
				}
				
       	$sql1 = 'INSERT INTO feedback (user_id,link,date_time,first_name,last_name,issue,module_id,email) VALUES ("'.$log_in_user_id.'","'. $link.'","'.$date.'","'. $first_name.'","'. $last_name.'","'. $issue.'","'.$module_id.'","'.$email.'")';

          if($db->query($sql1)==TRUE){
              
              echo "Issues Submitted Successfully";
          }
        
        
        
        
      } catch(Exception $e) {
          echo json_encode(array("status"=>false, "message"=>"some error occured"));
      }
      die();
    }
    
//----------------------------------------feedback saving-------END----------------------------------------
//----------------------------------------multiple approver-----------------------------------------------

public function action_multiple_approver()
    {
       
      try{  
        global $current_user;
       $op_id = $_POST['opps_id'];
    	  $log_in_user_id = $current_user->id;
   
    	  $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        
        $id_array=array();
        $team_func_array=array();
       
      $sql='SELECT * FROM users_cstm WHERE teamheirarchy_c="team_lead"';
       	$result = $GLOBALS['db']->query($sql);
       	while($row = $GLOBALS['db']->fetchByAssoc($result) )
				{
				   $id_array[]=$row['id_c'];
			       $team_func_array[]=$row['teamfunction_c'];
				    
				    
				}
			
			$email_id = array();
        	$full_name = array();
            $users_id = array();
		
		$sql1 = "SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id IN ('".implode("','",$id_array)."')";
		 	$result1 = $GLOBALS['db']->query($sql1);
			while($row1 = $GLOBALS['db']->fetchByAssoc($result1))
			{
	    		    array_push($users_id,$row1['id']);
	    			array_push($email_id,$row1['user_name']);
	    		   array_push($full_name,$row1['fullname']);
			}
             	$sql2 = 'SELECT * FROM opportunities_cstm WHERE id_c="'.$op_id.'"';
		 	$result2 = $GLOBALS['db']->query($sql2);
			while($row2 = $GLOBALS['db']->fetchByAssoc($result2))
			{
	    		$others = $row2['multiple_approver_c'];
			}
			//echo $others;
			$others_id_array = explode(",",$others);
        
        
        echo json_encode(array("status"=>true,  "user_id" => $users_id,"email" => $email_id, "name" => $full_name,"teamfunction"=>$team_func_array,"other_user_id" => $others_id_array));
        
      } catch(Exception $e) {
          echo json_encode(array("status"=>false, "message"=>"some error occured"));
      }
      die();
    }
    
//----------------------------------------multiple approver-------END----------------------------------------

//-------------------------------Fetch Reporting manager------------------------------------------------
public function action_fetch_reporting_manager()
    {
       
      try{  
        global $current_user;
       $op_id = $_POST['opps_id'];
    	  $log_in_user_id = $current_user->id;
   
    	  $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        
       // $func_array=array();
        $email_id=array();
        $id_array=array();
        $full_name=array();
     $fun_array=array();
     $id_mc=array();
     
     $report_mng = array("2b75371e-ab54-5b09-754e-5fed793eb002","489c14ef-90d7-e837-559b-5fedb62e7ef7"); 
     
     $sql_mc = "SELECT * FROM users_cstm WHERE mc_c='yes'";
        $result_mc = $GLOBALS['db']->query($sql_mc);
        while($row_mc= $GLOBALS['db']->fetchByAssoc($result_mc)) 
        {
        
        array_push($id_mc,$row_mc['id_c']);
     	
        }
        	$opp_mc='SELECT * From opportunities WHERE id="'.$op_id.'"';
				$re_mc= $GLOBALS['db']->query($opp_mc);
			while($ow_mc = $GLOBALS['db']->fetchByAssoc($re_mc))
			{
	    		    $by_mc=$ow_mc['created_by'];
			}
	if($op_id=="" && in_array($log_in_user_id,$id_mc) ){ 
	      $mc='yes';
        
           
           
             $ql1 = " SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id='".$log_in_user_id."' ";
            	    		    	$esult1 = $GLOBALS['db']->query($ql1);
                            			while($ow1 = $GLOBALS['db']->fetchByAssoc($esult1))
                            			{
                            			    	$r_id=$ow1['user_name'];
                            	    		   $r_name=$ow1['fullname'];
                            			}
            			
            			$s5 = "SELECT * FROM users_cstm  WHERE id_c='".$by_mc."'";
            	    		    	$r5 = $GLOBALS['db']->query($s5);
                        			while($ro5 = $GLOBALS['db']->fetchByAssoc($r5))
                        			{
                        			   
                        			    $team_f=$ro5['teamfunction_c'];
                        			}
           
           
           	 $sql3 = "SELECT * FROM users_cstm WHERE teamheirarchy_c='team_lead'";
        $result3 = $GLOBALS['db']->query($sql3);
        while($row3 = $GLOBALS['db']->fetchByAssoc($result3)) 
        {
         $func_array=$row3['teamfunction_c'];
          
     	$array = explode(",",$func_array);
     	
     	if(in_array("^ops^",$array)||in_array("^commercial^",$array)){
     	     $id_array[]=$row3["id_c"];
     	     $fun_array[]=$row3["teamfunction_c"];
     	};
     	
        }
      
    
        
        //	echo  json_encode($id_array);
			$email = array();
        	$fullname = array();
            $usersid = array();
			
            	$sql4 = "SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id IN ('".implode("','",$id_array)."')";
		 	$result4 = $GLOBALS['db']->query($sql4);
			while($row4 = $GLOBALS['db']->fetchByAssoc($result4))
			{
	    		    array_push($usersid,$row4['id']);
	    			array_push($email,$row4['user_name']);
	    		   array_push($fullname,$row4['fullname']);
	    		   
	    		   	}
	    		   	
	    		   	
	    		$sql5 = 'SELECT * FROM opportunities_cstm WHERE id_c="'.$op_id.'"';
		 	$result5 = $GLOBALS['db']->query($sql5);
			while($row5 = $GLOBALS['db']->fetchByAssoc($result5))
			{
	    		$others = $row5['multiple_approver_c'];
	    		$r=$row5['user_id2_c'];
			}
			
			$others_id_array = explode(",",$others);
			
	    	array_unshift($usersid,$log_in_user_id);	   	
	    		array_unshift($email,$r_id);	   	
	    		array_unshift($fullname,$r_name); 
	    			array_unshift($fun_array,$team_f); 
	    			
     echo json_encode(array("status"=>true, "mc"=>$mc,"reporting_id"=>$log_in_user_id,"reportee"=>$email_id,"fullname"=>$r_name, "user_id" => $usersid,"email" => $email, "name" => $fullname,"teamfunction"=>$fun_array,"other_user_id" => $others_id_array));
           
	    
	}		
     
    else if(in_array($log_in_user_id,$id_mc) && $log_in_user_id==$by_mc ){
         
        
         
         $mc='yes';
        
           
           
             $ql1 = " SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id='".$by_mc."' ";
            	    		    	$esult1 = $GLOBALS['db']->query($ql1);
                            			while($ow1 = $GLOBALS['db']->fetchByAssoc($esult1))
                            			{
                            			    	$r_id=$ow1['user_name'];
                            	    		   $r_name=$ow1['fullname'];
                            			}
            			
            			$s5 = "SELECT * FROM users_cstm  WHERE id_c='".$by_mc."'";
            	    		    	$r5 = $GLOBALS['db']->query($s5);
                        			while($ro5 = $GLOBALS['db']->fetchByAssoc($r5))
                        			{
                        			   
                        			    $team_f=$ro5['teamfunction_c'];
                        			}
           
           
           	 $sql3 = "SELECT * FROM users_cstm WHERE teamheirarchy_c='team_lead' AND id_c IN ('".implode("','",$report_mng)."') ";
        $result3 = $GLOBALS['db']->query($sql3);
        while($row3 = $GLOBALS['db']->fetchByAssoc($result3)) 
        {
         $func_array=$row3['teamfunction_c'];
          
     	$array = explode(",",$func_array);
     	
     	if(in_array("^ops^",$array)||in_array("^commercial^",$array)){
     	     $id_array[]=$row3["id_c"];
     	     $fun_array[]=$row3["teamfunction_c"];
     	};
     	
        }
      
    
        
        //	echo  json_encode($id_array);
			$email = array();
        	$fullname = array();
            $usersid = array();
			
            	$sql4 = "SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id IN ('".implode("','",$id_array)."')";
		 	$result4 = $GLOBALS['db']->query($sql4);
			while($row4 = $GLOBALS['db']->fetchByAssoc($result4))
			{
	    		    array_push($usersid,$row4['id']);
	    			array_push($email,$row4['user_name']);
	    		   array_push($fullname,$row4['fullname']);
	    		   
	    		   	}
	    		   	
	    		   	
	    		$sql5 = 'SELECT * FROM opportunities_cstm WHERE id_c="'.$op_id.'"';
		 	$result5 = $GLOBALS['db']->query($sql5);
			while($row5 = $GLOBALS['db']->fetchByAssoc($result5))
			{
	    		$others = $row5['multiple_approver_c'];
	    		$r=$row5['user_id2_c'];
			}
			
			$others_id_array = explode(",",$others);
			
	    	array_unshift($usersid,$log_in_user_id);	   	
	    		array_unshift($email,$r_id);	   	
	    		array_unshift($fullname,$r_name); 
	    			array_unshift($fun_array,$team_f); 
	    			
     echo json_encode(array("status"=>true, "mc"=>$mc,"reporting_id"=>$log_in_user_id,"reportee"=>$email_id,"fullname"=>$r_name, "user_id" => $usersid,"email" => $email, "name" => $fullname,"teamfunction"=>$fun_array,"other_user_id" => $others_id_array));
           
     }
     
     else{
         
     $mc='no';
     
      
           
             $sql_mc1 = "SELECT * FROM users_cstm WHERE id_c='".$by_mc."'";
        $result_mc1 = $GLOBALS['db']->query($sql_mc1);
        while($row_mc1= $GLOBALS['db']->fetchByAssoc($result_mc1)) 
        {
        
        $createdby_mc=$row_mc1['mc_c'];
     	
        }
           if($createdby_mc=='yes'){
           
             $ql1 = " SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id='".$by_mc."' ";
            	    		    	$esult1 = $GLOBALS['db']->query($ql1);
                            			while($ow1 = $GLOBALS['db']->fetchByAssoc($esult1))
                            			{
                            			    	$r_id=$ow1['user_name'];
                            	    		   $r_name=$ow1['fullname'];
                            			}
            			
            			$s5 = "SELECT * FROM users_cstm  WHERE id_c='".$by_mc."'";
            	    		    	$r5 = $GLOBALS['db']->query($s5);
                        			while($ro5 = $GLOBALS['db']->fetchByAssoc($r5))
                        			{
                        			   
                        			    $team_f=$ro5['teamfunction_c'];
                        			}
           
       
           
           	//  $sql3 = "SELECT * FROM users_cstm WHERE teamheirarchy_c='team_lead'";
           	 
           	 $sql3 = "SELECT * FROM users_cstm WHERE teamheirarchy_c='team_lead' AND id_c IN ('".implode("','",$report_mng)."')";
        $result3 = $GLOBALS['db']->query($sql3);
        while($row3 = $GLOBALS['db']->fetchByAssoc($result3)) 
        {
         $func_array=$row3['teamfunction_c'];
          
     	$array = explode(",",$func_array);
     	
     	if(in_array("^ops^",$array)||in_array("^commercial^",$array)){
     	     $id_array[]=$row3["id_c"];
     	     $fun_array[]=$row3["teamfunction_c"];
     	};
     	
        }
      
    
        
        //	echo  json_encode($id_array);
			$email = array();
        	$fullname = array();
            $usersid = array();
			
            	$sql4 = "SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id IN ('".implode("','",$id_array)."')";
		 	$result4 = $GLOBALS['db']->query($sql4);
			while($row4 = $GLOBALS['db']->fetchByAssoc($result4))
			{
	    		    array_push($usersid,$row4['id']);
	    			array_push($email,$row4['user_name']);
	    		   array_push($fullname,$row4['fullname']);
	    		   
	    		   	}
	    		   	
	    		   	
	    		$sql5 = 'SELECT * FROM opportunities_cstm WHERE id_c="'.$op_id.'"';
		 	$result5 = $GLOBALS['db']->query($sql5);
			while($row5 = $GLOBALS['db']->fetchByAssoc($result5))
			{
	    		$others = $row5['multiple_approver_c'];
	    		$r=$row5['user_id2_c'];
			}
			
			$others_id_array = explode(",",$others);
			
	    	array_unshift($usersid,$by_mc);	   	
	    		array_unshift($email,$r_id);	   	
	    		array_unshift($fullname,$r_name); 
	    			array_unshift($fun_array,$team_f); 
	    			
     echo json_encode(array("status"=>true, "mc"=>$mc,"reporting_id"=>$reporting_id,"reportee"=>$email_id,"fullname"=>$full_name, "user_id" => $usersid,"email" => $email, "name" => $fullname,"teamfunction"=>$fun_array,"other_user_id" => $others_id_array));
           }
       		else{
                    			$opp='SELECT * From opportunities WHERE id="'.$op_id.'"';
                    				$re= $GLOBALS['db']->query($opp);
                    			while($ow = $GLOBALS['db']->fetchByAssoc($re))
                    			{
                    	    		    $reporting=$ow['created_by'];
	    		    
	    		                     $sql_creater='SELECT * From users WHERE id="'.$reporting.'"';
		
		
		     	              $result_creater = $GLOBALS['db']->query($sql_creater);
		     	
            		       	while($row22 = $GLOBALS['db']->fetchByAssoc($result_creater))
            		     	{
            	    		    $report_id=$row22['reports_to_id'];
            	    		    
            	    		     $ql1 = " SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id='".$report_id."' ";
            	    		    	$esult1 = $GLOBALS['db']->query($ql1);
                            			while($ow1 = $GLOBALS['db']->fetchByAssoc($esult1))
                            			{
                            			    	$r_id=$ow1['user_name'];
                            	    		   $r_name=$ow1['fullname'];
                            			}
            			
            			$s5 = "SELECT * FROM users_cstm  WHERE id_c='".$report_id."'";
            	    		    	$r5 = $GLOBALS['db']->query($s5);
                        			while($ro5 = $GLOBALS['db']->fetchByAssoc($r5))
                        			{
                        			   
                        			    $team_f=$ro5['teamfunction_c'];
                        			}
            			
            			}	
			    
			}
			
		
			
		$sql='SELECT * From users WHERE id="'.$log_in_user_id.'"';
		
		
		 	$result = $GLOBALS['db']->query($sql);
			while($row = $GLOBALS['db']->fetchByAssoc($result))
			{
	    		    $reporting_id=$row['reports_to_id'];
	    		    
	    		    $sql1 = "SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id='".$reporting_id."'";
	    		    	$result1 = $GLOBALS['db']->query($sql1);
			while($row1 = $GLOBALS['db']->fetchByAssoc($result1))
			{
			    	$email_id=$row1['user_name'];
	    		   $full_name=$row1['fullname'];
			}
		
	    		
			}
			
	
			
			 //  $report_mng = array("2b75371e-ab54-5b09-754e-5fed793eb002","489c14ef-90d7-e837-559b-5fedb62e7ef7"); 
			 
			 //$sql3 = "SELECT * FROM users_cstm WHERE teamheirarchy_c='team_lead' AND id_c = '".$report_id."' ";
			
		 $sql3 = "SELECT * FROM users_cstm WHERE teamheirarchy_c='team_lead' AND id_c IN ('".implode("','",$report_mng)."')";
        $result3 = $GLOBALS['db']->query($sql3);
        while($row3 = $GLOBALS['db']->fetchByAssoc($result3)) 
        {
         $func_array=$row3['teamfunction_c'];
          
     	$array = explode(",",$func_array);
     	
     	if(in_array("^ops^",$array)||in_array("^commercial^",$array)){
     	     $id_array[]=$row3["id_c"];
     	     $fun_array[]=$row3["teamfunction_c"];
     	};
     	
        }
      
      
    
        
        //	echo  json_encode($id_array);
			$email = array();
        	$fullname = array();
            $usersid = array();
			
            	$sql4 = "SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id IN ('".implode("','",$id_array)."')";
		 	$result4 = $GLOBALS['db']->query($sql4);
			while($row4 = $GLOBALS['db']->fetchByAssoc($result4))
			{
	    		    array_push($usersid,$row4['id']);
	    			array_push($email,$row4['user_name']);
	    		   array_push($fullname,$row4['fullname']);
	    		   
	    		   	}
	    		   	
	    		   	
	    		$sql5 = 'SELECT * FROM opportunities_cstm WHERE id_c="'.$op_id.'"';
		 	$result5 = $GLOBALS['db']->query($sql5);
			while($row5 = $GLOBALS['db']->fetchByAssoc($result5))
			{
	    		$others = $row5['multiple_approver_c'];
	    		$r=$row5['user_id2_c'];
			}
			
			$others_id_array = explode(",",$others);
			
	    	array_unshift($usersid,$report_id);	 
	    
	    		array_unshift($email,$r_id);
	    		
	    		array_unshift($fullname,$r_name); 
	    			array_unshift($fun_array,$team_f); 
	    			
     echo json_encode(array("status"=>true, "mc"=>$mc,"reporting_id"=>$reporting_id,"reportee"=>$email_id,"fullname"=>$full_name, "user_id" => $usersid,"email" => $email, "name" => $fullname,"teamfunction"=>$fun_array,"other_user_id" => $others_id_array));
				}
      }
    
        
      } catch(Exception $e) {
          echo json_encode(array("status"=>false, "message"=>"some error occured"));
      }
      die();
    }
    


//-------------------------------Fetch Reporting manager--------------END----------------------------------

//---------------------------------Editview untagged users ----------------------------------------------

public function action_untagged_users_list(){
     try{  
        global $current_user;
       $op_id = $_POST['opps_id'];
    	  $log_in_user_id = $current_user->id;
   
    	  $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        
        $id_array=array();
        $team_func_array=array();
       
      
			
			$email_id = array();
        	$full_name = array();
            $users_id = array();
            
             $reporting=array();
            array_push($reporting,'1');
            
            	$opp='SELECT * From opportunities WHERE id="'.$op_id.'"';
				$re= $GLOBALS['db']->query($opp);
			while($ow = $GLOBALS['db']->fetchByAssoc($re))
			{
	    		   array_push ($reporting,$ow['created_by']);
	    		   
	    		       $creator=$ow['created_by'];
	    		     $sql_creater='SELECT * From users WHERE id="'.$creator.'"';
		
		
		     	              $result_creater = $GLOBALS['db']->query($sql_creater);
		     	
            		       	while($row22 = $GLOBALS['db']->fetchByAssoc($result_creater))
            		     	{
            	    		    array_push($reporting,$row22['reports_to_id']);
            		     	    
            		     	}
			    
			}
			
			$sql3="SELECT * FROM opportunities_cstm WHERE id_c='".$op_id."'";
			$result3=$GLOBALS['db']->query($sql3);
			
			while($row3=$GLOBALS['db']->fetchByAssoc($result3)){
			    
			    
			    $string=$row3['multiple_approver_c'];
			    
			}
			$array=explode(',',$string);
			
			$reporting=array_merge($reporting,$array);
		
		$sql1 = "SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id NOT IN ('".implode("','",$reporting)."') ORDER BY first_name ASC";
		 	$result1 = $GLOBALS['db']->query($sql1);
			while($row1 = $GLOBALS['db']->fetchByAssoc($result1))
			{
	    		    array_push($users_id,$row1['id']);
	    			array_push($email_id,$row1['user_name']);
	    		   array_push($full_name,$row1['fullname']);
			}
				$sql = "SELECT  * FROM untagged_user WHERE opp_id='".$op_id."' ";
		 	$result = $GLOBALS['db']->query($sql);
			while($row = $GLOBALS['db']->fetchByAssoc($result))
			{
	    		    $others=$row['user_id'];
			}	
             
		$others_id_array = explode(",",$others);

        
        echo json_encode(array("status"=>true,  "user_id" => $users_id,"email" => $email_id, "name" => $full_name,"other_user_id" => $others_id_array));
        
      } catch(Exception $e) {
          echo json_encode(array("status"=>false, "message"=>"some error occured"));
      }
      die();
}

//---------------------------------Editview untagged users -------END--------------------------------------
//---------------------------------Editview tagged users ----------------------------------------------

public function action_tagged_users_list(){
     try{  
        global $current_user;
       $op_id = $_POST['opps_id'];
    	  $log_in_user_id = $current_user->id;
   
    	  $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        
        $id_array=array();
        $team_func_array=array();
       
      
			
			$email_id = array();
        	$full_name = array();
            $users_id = array();
            
            $reporting=array();
            array_push($reporting,'1');
            
            	$opp='SELECT * From opportunities WHERE id="'.$op_id.'"';
				$re= $GLOBALS['db']->query($opp);
			while($ow = $GLOBALS['db']->fetchByAssoc($re))
			{
	    		   array_push ($reporting,$ow['created_by']);
	    		   
	    		       $creator=$ow['created_by'];
	    		     $sql_creater='SELECT * From users WHERE id="'.$creator.'"';
		
		
		     	              $result_creater = $GLOBALS['db']->query($sql_creater);
		     	
            		       	while($row22 = $GLOBALS['db']->fetchByAssoc($result_creater))
            		     	{
            	    		    array_push($reporting,$row22['reports_to_id']);
            		     	    
            		     	}
			    
			}
		
				$sql3="SELECT * FROM opportunities_cstm WHERE id_c='".$op_id."'";
			$result3=$GLOBALS['db']->query($sql3);
			
			while($row3=$GLOBALS['db']->fetchByAssoc($result3)){
			    
			    
			    $string=$row3['multiple_approver_c'];
			    
			}
			$array=explode(',',$string);
			
			$reporting=array_merge($reporting,$array);
			
			
		
		
		$sql1 = "SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id NOT IN ('".implode("','",$reporting)."') ORDER BY first_name ASC";
		 	$result1 = $GLOBALS['db']->query($sql1);
			while($row1 = $GLOBALS['db']->fetchByAssoc($result1))
			{
	    		    array_push($users_id,$row1['id']);
	    			array_push($email_id,$row1['user_name']);
	    		   array_push($full_name,$row1['fullname']);
			}
			
			$sql = "SELECT  * FROM tagged_user WHERE opp_id='".$op_id."'";
		 	$result = $GLOBALS['db']->query($sql);
			while($row = $GLOBALS['db']->fetchByAssoc($result))
			{
	    		    $others=$row['user_id'];
			}	
             
		$others_id_array = explode(",",$others);
       
        
        echo json_encode(array("status"=>true,  "user_id" => $users_id,"email" => $email_id, "name" => $full_name,"other_user_id" => $others_id_array));
        
      } catch(Exception $e) {
          echo json_encode(array("status"=>false, "message"=>"some error occured"));
      }
      die();
}

//---------------------------------Editview untagged users -------END--------------------------------------
//--------------------------------------Save tagged and untagged user list-------------------------------------
public function action_save_untagged_users_list(){
     try{  
        global $current_user;
       $op_id = $_POST['opps_id'];
       $untagged=$_POST['untagged'];
    	  $log_in_user_id = $current_user->id;
   
    	  $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        
        $sql="SELECT * FROM untagged_user WHERE opp_id='".$op_id."'";
        	$result = $GLOBALS['db']->query($sql);
        	
        	if($result->num_rows>0){
			    
				$update_query="UPDATE untagged_user SET user_id='".$untagged."'  WHERE opp_id='".$op_id."'";
				$res0 = $db->query($update_query);
			}else{
				$insert_query='INSERT INTO  untagged_user (opp_id,user_id) VALUES ("'.$op_id.'","'.$untagged.'")';
				$res0 = $db->query($insert_query);
			}
        
       
      } catch(Exception $e) {
          echo json_encode(array("status"=>false, "message"=>"some error occured"));
      }
      die();
}
public function action_save_tagged_users_list(){
     try{  
        global $current_user;
       $op_id = $_POST['opps_id'];
       $tagged=$_POST['tagged'];
       $opp_name=$_POST['opp_name'];
       $base_url=$_POST['base_url'];
    	  $log_in_user_id = $current_user->id;
   
   $tagged_array=explode(',',$tagged);
   
    	  $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
        
        $sql="SELECT * FROM tagged_user WHERE opp_id='".$op_id."'";
        	$result = $GLOBALS['db']->query($sql);
        	
        	if($result->num_rows>0){
			    
				$update_query="UPDATE tagged_user SET user_id='".$tagged."'  WHERE opp_id='".$op_id."'";
				$res0 = $db->query($update_query);
			if( $db->query($update_query)==TRUE){	
				while($row = $GLOBALS['db']->fetchByAssoc($result)){
				    $old=$row['user_id'];
				}
				
				$old_array=explode(',',$old);
				
				$arr_1 = array_diff($tagged_array,$old_array);
				// echo $old_array;
				// echo $tagged_array;
				// echo $arr_1;
					$email_array=array();
					$sql23 = "SELECT  * FROM users WHERE id IN ('".implode("','",$arr_1)."') ";
		 	$result23 = $GLOBALS['db']->query($sql23);
			while($row23 = $GLOBALS['db']->fetchByAssoc($result23))
			{
	    		    
	    		  array_push($email_array,$row23['user_name']);
			}
	
				// foreach($arr_1 as $user){
    //                                 			   $alert = BeanFactory::newBean('Alerts');
    //                                 						//$alert->name =$opp_name;
    //                                 						$alert->description = 'You have been tagged for opportunity "'.$opp_name.'"';
    //                                 						$alert->url_redirect = $base_url.'?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D'.$op_id;
    //                                 						$alert->target_module = 'Opportunities';
    //                                 						$alert->assigned_user_id = $user;
    //                                 						$alert->type = 'info';
    //                                 						$alert->is_read = 0;
    //                                 						$alert->save();
    //                                 						}
    //                                 				// //emails
    //                                 					foreach($email_array as $email){
    //                                 				$template = 'You have been tagged for opportunity "'.$opp_name.'" Please Review : <a href="'.$base_url.'?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D'.$op_id.'">Click Here</a>';
    //                                 						require_once('include/SugarPHPMailer.php');
    //                                 						include_once('include/utils/db_utils.php');
    //                                 					    $emailObj = new Email();  
    //                                 					    $defaults = $emailObj->getSystemDefaultEmail();  
    //                                 					    $mail = new SugarPHPMailer();  
    //                                 					    $mail->setMailerForSystem();  
    //                                 					    $mail->From = $defaults['xelpmocdeveloper@gmail.com'];  
    //                                 					    $mail->FromName = $defaults['xelpmoc'];  
    //                                 					    $mail->Subject = 'You have been tagged for opportunity "'.$opp_name.'"'; 
    //                                 						$mail->Body =$template;
    //                                 					    $mail->prepForOutbound();  
    //                                 					    $mail->AddAddress($email); 
    //                                 					    @$mail->Send();
    //                                 				}			
			}
				
			}
			else{
				$insert_query='INSERT INTO  tagged_user (opp_id,user_id) VALUES ("'.$op_id.'","'.$tagged.'")';
				$res0 = $db->query($insert_query);
					$email_array=array();
					$sql23 = "SELECT  * FROM users WHERE id IN ('".implode("','",$tagged_array)."') ";
		 	$result23 = $GLOBALS['db']->query($sql23);
			while($row23 = $GLOBALS['db']->fetchByAssoc($result23))
			{
	    		    
	    		  array_push($email_array,$row23['user_name']);
			}
				 if($db->query($insert_query)==TRUE){
				 //alerts
                    			         //foreach($tagged_array as $user){
                                //     			   $alert = BeanFactory::newBean('Alerts');
                                //     						//$alert->name =$opp_name;
                                //     						$alert->description = 'You have been tagged for opportunity "'.$opp_name.'"';
                                //     						$alert->url_redirect = $base_url.'?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D'.$op_id;
                                //     						$alert->target_module = 'Opportunities';
                                //     						$alert->assigned_user_id = $user;
                                //     						$alert->type = 'info';
                                //     						$alert->is_read = 0;
                                //     						$alert->save();
                                //     						}
                                //     							// //emails
                                //     					foreach($email_array as $email){
                                //     				$template = 'You have been tagged for opportunity "'.$opp_name.'"  Please Review : <a href="'.$base_url.'?action=ajaxui#ajaxUILoc=index.php%3Fmodule%3DOpportunities%26offset%3D7%26stamp%3D1595474141045235900%26return_module%3DOpportunities%26action%3DDetailView%26record%3D'.$op_id.'">Click Here</a>';
                                //     						require_once('include/SugarPHPMailer.php');
                                //     						include_once('include/utils/db_utils.php');
                                //     					    $emailObj = new Email();  
                                //     					    $defaults = $emailObj->getSystemDefaultEmail();  
                                //     					    $mail = new SugarPHPMailer();  
                                //     					    $mail->setMailerForSystem();  
                                //     					    $mail->From = $defaults['xelpmocdeveloper@gmail.com'];  
                                //     					    $mail->FromName = $defaults['xelpmoc'];  
                                //     					    $mail->Subject = 'You have been tagged for opportunity "'.$opp_name.'"'; 
                                //     						$mail->Body =$template;
                                //     					    $mail->prepForOutbound();  
                                //     					    $mail->AddAddress($email); 
                                //     					    @$mail->Send();
                                //     				}
				 }
			}
        
       
      } catch(Exception $e) {
          echo json_encode(array("status"=>false, "message"=>"some error occured"));
      }
      die();
}
//--------------------------------------Save tagged user list--------END-----------------------------


//----------------------------------International----------------------------------------------


public function action_international()
    {
       
      try{  
        global $current_user;
       $op_id = $_POST['opp_id'];
    	
       
      $sql='SELECT * FROM opportunities_cstm WHERE id_c="'.$op_id.'"';
       	$result = $GLOBALS['db']->query($sql);
       	while($row = $GLOBALS['db']->fetchByAssoc($result) )
				{
				   $international=$row['international_c'];
				    
				    
				}
			
		
        
        
        echo $international;
        
      } catch(Exception $e) {
          echo json_encode(array("status"=>false, "message"=>"some error occured"));
      }
      die();
    }
    



//---------------------------------International------------END---------------------------------




//===========================Write code above this line=========================================    
}
?>