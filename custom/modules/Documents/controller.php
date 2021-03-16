<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/MVC/Controller/SugarController.php');

class DocumentsController extends SugarController
{
   
 //-------------------------------Fetch Reporting manager------------------------------------------------

    public function action_fetch_reporting_manager()
        {
       $assigned_id=$_POST['assigned_id'];
       $assigned_name=$_POST['assigned_name'];
      
      try{  
          
          
          
            global $current_user;
          	$log_in_user_id = $current_user->id;
          	
          	
          	if($assigned_id==""){
             
               $sql2="SELECT id  FROM users WHERE CONCAT(first_name, ' ', last_name) ='".$assigned_name."' ";
        	    
        	     $result2 = $GLOBALS['db']->query($sql2);
        	     
        while($row2= $GLOBALS['db']->fetchByAssoc($result2)) 
        {
            
           
            
            
           $assigned_id=$row2['id'];
           
           
    
            
        }
        
          }
          	
          	
            $sql7="SELECT CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS name FROM users WHERE id='".$log_in_user_id."'";
    	    $result7 = $GLOBALS['db']->query($sql7);
        while($row7 = $GLOBALS['db']->fetchByAssoc($result7)) 
        {
    	       $mc_name=$row7['name'];  
    	       
        }	
          	
          	 	
         $sql = "SELECT users.id, users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '".$log_in_user_id."' AND users.deleted = 0";
        $result = $GLOBALS['db']->query($sql);
        while($row = $GLOBALS['db']->fetchByAssoc($result)) 
        {
            $check_sales = $row['teamfunction_c'];
            $check_mc = $row['mc_c'];
            $check_team_lead = $row['teamheirarchy_c'];
            
        }
        
         $sql1 = "SELECT users.id, CONCAT(users.first_name,' ',users.last_name) as name ,users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '".$assigned_id."' AND users.deleted = 0";
        $result1 = $GLOBALS['db']->query($sql1);
        while($row1 = $GLOBALS['db']->fetchByAssoc($result1)) 
        {
            
            $assigned_check_mc = $row1['mc_c'];
            $assigned_check_mc_team_name = $row1['name'];
            
        }
         
         
         //*********************************** Flow Starts here**************************  
        if($check_mc=='yes'){
            
            
            if($log_in_user_id==$assigned_id){
                
                
             echo json_encode(array('reporting_name'=>$mc_name,'reporting_id'=>$log_in_user_id,'mc'=>"yes",'login_user'=>$log_in_user_id));
             
            }
            else if($assigned_check_mc=="yes"){
                
                
             echo json_encode(array('reporting_name'=>$assigned_name,'reporting_id'=>$assigned_id,'assign_mc'=>"yes",'login_user'=>$log_in_user_id));
             
            }
            else{
                
                
                  $sql_assigned="SELECT users.id, users.employee_status, users.deleted,CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS fullname FROM users INNER JOIN users_cstm ON users_cstm.id_c = users.id WHERE users.employee_status='Active' AND users.deleted=0 AND users.id IN (SELECT reports_to_id  FROM users WHERE id='".$assigned_id."')";
      $result_assigned = $GLOBALS['db']->query($sql_assigned);
        
     while ($row_assigned = mysqli_fetch_assoc($result_assigned)){
            
             $reporting_id=$row_assigned['id'];
             $reporting_name=$row_assigned['fullname'];
             
        }
      
            
            
             echo json_encode(array('reporting_name'=>$reporting_name,'reporting_id'=>$reporting_id,'member'=>"yes",'login_user'=>$log_in_user_id));
            
        
       
          	
            }
            
        }else{
            
            if($assigned_check_mc=="yes"){
                
                
             echo json_encode(array('reporting_name'=>$assigned_name,'reporting_id'=>$assigned_id,'login_user'=>$log_in_user_id));
             
            }
           else{ 
            
              $sql_assigned="SELECT users.id, users.employee_status, users.deleted,CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS fullname FROM users INNER JOIN users_cstm ON users_cstm.id_c = users.id WHERE users.employee_status='Active' AND users.deleted=0 AND users.id IN (SELECT reports_to_id  FROM users WHERE id='".$assigned_id."')";
      $result_assigned = $GLOBALS['db']->query($sql_assigned);
        
     while ($row_assigned = mysqli_fetch_assoc($result_assigned)){
            
             $reporting_id=$row_assigned['id'];
             $reporting_name=$row_assigned['fullname'];
             
        }
      
            
            
             echo json_encode(array('reporting_name'=>$reporting_name,'reporting_id'=>$reporting_id,'login_user'=>$log_in_user_id));
        }
        }
       
          	
           
          
        
      } catch(Exception $e) {
          echo json_encode(array("status"=>false, "message"=>"some error occured"));
      }
      die();
    }
//-------------------------------Fetch Reporting manager--------------END----------------------------------
//---------------------------------Editview tagged users ----------------------------------------------

public function action_tagged_users_list(){
     try{  
        global $current_user;
       $doc_id = $_POST['doc_id'];
    	  $log_in_user_id = $current_user->id;
      $assigned_id=$_POST['assigned_id'];
      $approver_id=$_POST['approver_id'];
    	  $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
       
        $id_array=array();
        $team_func_array=array();
       
       
     
			
			$email_id = array();
        	$full_name = array();
            $users_id = array();
            
            $reporting=array();
            
            	$id_mc = array();
		 $sql_mc = "SELECT * FROM users_cstm WHERE mc_c='yes'";
        $result_mc = $GLOBALS['db']->query($sql_mc);
        while($row_mc= $GLOBALS['db']->fetchByAssoc($result_mc)) 
        {
        
        array_push($id_mc,$row_mc['id_c']);
     	
        }
    
            
            
            array_push($reporting,'1');
            array_push($reporting,$assigned_id);
            array_push($reporting,$approver_id);
            $reporting=array_merge($reporting,$id_mc);
           
		
		$sql1 = "SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id NOT IN ('".implode("','",$reporting)."') ORDER BY first_name ASC";
		 	$result1 = $GLOBALS['db']->query($sql1);
			while($row1 = $GLOBALS['db']->fetchByAssoc($result1))
			{
	    		    array_push($users_id,$row1['id']);
	    			array_push($email_id,$row1['user_name']);
	    		   array_push($full_name,$row1['fullname']);
			}
			
			$sql = "SELECT  * FROM documents_cstm WHERE id_c='".$doc_id."'";
		 	$result = $GLOBALS['db']->query($sql);
			while($row = $GLOBALS['db']->fetchByAssoc($result))
			{
	    		    $others=$row['tagged_hidden_c'];
			}	
             
		$others_id_array = explode(",",$others);
       
        
        echo json_encode(array("status"=>true,  "user_id" => $users_id,"email" => $email_id, "name" => $full_name,"other_user_id" => $others_id_array));
        
      } catch(Exception $e) {
          echo json_encode(array("status"=>false, "message"=>"some error occured"));
      }
      die();
}

//---------------------------------Editview tagged users --------END--------------------------------------



//--------------------------------Assigned user list according to login user-------------------


           
// public function action_new_assigned_list(){
//      try{
//          $db = \DBManagerFactory::getInstance();
//         	$GLOBALS['db'];
        	  
//         	   global $current_user; 
        	   
//         	  $acc_id=$_POST['acc_id'];
//         	   $combined=array();
//         	  $id_array1=array();
//         	  $id_array=array();
//         	  $name_array=array();
//         	  $func_array=array();
//         	 $func1_array=array();
//               $h_array=array();
//               $r_name=array();
//               $number=array();
//               $Approved_array=array();
//               $Rejected_array=array();
//               $pending_array=array();
//               $func2_array=array();
//               $h1_array=array();
//               $rr_name=array();
//               $n=1;
//     	  $log_in_user_id = $current_user->id;
    	  
    	  
    	 	
//         $sql7="SELECT CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS name FROM users WHERE id='".$log_in_user_id."'";
//     	    $result7 = $GLOBALS['db']->query($sql7);
//         while($row7 = $GLOBALS['db']->fetchByAssoc($result7)) 
//         {
//     	       $mc_name=$row7['name'];  
    	       
//         }
        	
//          $sql = "SELECT users.id, users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '".$log_in_user_id."' AND users.deleted = 0";
//         $result = $GLOBALS['db']->query($sql);
//         while($row = $GLOBALS['db']->fetchByAssoc($result)) 
//         {
//             $check_sales = $row['teamfunction_c'];
//             $check_mc = $row['mc_c'];
//             $check_team_lead = $row['teamheirarchy_c'];
            
//         }
         
         
//          //*********************************** Flow Starts here**************************  
//         if($check_mc=='yes'){
           
            
          
         
        
   
       
//       $sql1 = "SELECT users_cstm.teamfunction_c,users_cstm.teamheirarchy_c, users1.id,CONCAT(IFNULL(users1.first_name,''), ' ', IFNULL(users1.last_name,'')) AS name,CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS r_name , rpt_cstm.teamfunction_c as r_r_tf, rpt_cstm.teamheirarchy_c as r_r_th FROM users INNER JOIN users as users1 ON users.id=users1.reports_to_id INNER JOIN users_cstm as rpt_cstm ON rpt_cstm.id_c= users1.reports_to_id INNER JOIN users_cstm ON users_cstm.id_c=users1.id  WHERE  users1.deleted=0 ORDER BY `name` ASC";
       
//       // $sql1="SELECT users_cstm.teamfunction_c,users_cstm.teamheirarchy_c, users1.id,CONCAT(IFNULL(users1.first_name,''), ' ', IFNULL(users1.last_name,'')) AS name,CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS r_name FROM users INNER JOIN users as users1 ON users.id=users1.reports_to_id INNER JOIN users_cstm ON users_cstm.id_c=users1.id WHERE users1.id IN ('".implode("','",$id_array1)."') AND users1.deleted=0 ORDER BY `name` ASC";
//         $result1 = $GLOBALS['db']->query($sql1);
//         while($row1 = $GLOBALS['db']->fetchByAssoc($result1)) 
//         {
//             array_push($number,$n);
//             array_push($func1_array,$row1['teamfunction_c']);
           
//             array_push($name_array,$row1['name']);
//           array_push($h_array,$row1['teamheirarchy_c']);
//             array_push($r_name,$row1['r_name']);
//             array_push($func2_array,$row1['r_r_tf']);
//             array_push($h1_array,$row1['r_r_th']);
//             $n++;
//         }
        
        
      
//       $combined = array_map(function($b,$c,$d,$e,$f,$g) { if ($f==""){$f='MC';}return  $b.' / '.$c.' / '.$d.' -> '.$e.' / '.$f.' / '.$g; }, $name_array,$func1_array, $h_array,$r_name,$func2_array,$h1_array);
      
//       $mc_no=$n+1;
//       $mc_no=strval($mc_no); 
     
//       $mc_details=$mc_name.' / ';
      
//       array_push($combined,$mc_details);
      
//       if($acc_id==''){
          
//           echo json_encode(array('1'=>$name_array,'2'=>$h_array,'3'=>$r_name,'a'=>$combined));
//       }
//       else{
//             $sql_approval_status = "SELECT * FROM activity_approval_table WHERE id=(SELECT MAX(id) FROM activity_approval_table WHERE acc_id ='".$acc_id."' ) ";
//             $result_approval_status = $GLOBALS['db']->query($sql_approval_status);
//             while($row_approval_status=$GLOBALS['db']->fetchByAssoc($result_approval_status)){
                
//                 $approval_status = $row_approval_status['approval_status'];
//                 $sender=$row_approval_status['sender'];
//                 $approver_rejector=$row_approval_status['approver'];
//                 $status_approval_table=$row_approval_status['status'];
              
//             }
            
            
//             if($approval_status == '0'){
//                  echo json_encode("block");
              
//             }
//             else{
//                  echo json_encode(array('1'=>$name_array,'2'=>$h_array,'3'=>$r_name,'a'=>$combined));
//             }
          
          
          
          
//       }
      
                           
      
      
//         }
        
        
// else if($check_team_lead=='team_member_l1'||$check_team_lead=='team_member_l2'||$check_team_lead=='team_member_l3'||$check_team_lead=='team_lead'){
           
//          $sql4='SELECT * FROM users WHERE reports_to_id="'.$log_in_user_id.'" AND deleted=0' ;
//           $result4 = $GLOBALS['db']->query($sql4);
          
//           if($result4->num_rows>0){
               
//               while($row4 = $GLOBALS['db']->fetchByAssoc($result4)) 
//                 {
                
//                   $id_array1[]=$row4["id"];
//                 }
              
//             array_push($id_array1,$log_in_user_id);
            
            
            
              
                  
//                   $sql1="SELECT users_cstm.teamfunction_c,users_cstm.teamheirarchy_c, users1.id,CONCAT(IFNULL(users1.first_name,''), ' ', IFNULL(users1.last_name,'')) AS name,CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS r_name FROM users INNER JOIN users as users1 ON users.id=users1.reports_to_id INNER JOIN users_cstm ON users_cstm.id_c=users1.id WHERE users1.id IN ('".implode("','",$id_array1)."') AND users1.deleted=0 ORDER BY `name` ASC";
//         $result1 = $GLOBALS['db']->query($sql1);
//         while($row1 = $GLOBALS['db']->fetchByAssoc($result1)) 
//         {
//             array_push($number,$n);
//             array_push($func1_array,$row1['teamfunction_c']);
           
//             array_push($name_array,$row1['name']);
//           array_push($h_array,$row1['teamheirarchy_c']);
//             array_push($r_name,$row1['r_name']);
//             $n++;
//         }
        




      
//       $combined = array_map(function($b,$c,$d,$e) { return  $b.' / '.$c.' / '.$d.' -> '.$e; }, $name_array,$func1_array, $h_array,$r_name);
      
     
            
//              if($acc_id==''){
          
//           echo json_encode(array('1'=>$name_array,'2'=>$h_array,'3'=>$r_name,'a'=>$combined));
//       }
//       else{
//             $sql_approval_status = "SELECT * FROM activity_approval_table WHERE id=(SELECT MAX(id) FROM activity_approval_table WHERE acc_id ='".$acc_id."' ) ";
//             $result_approval_status = $GLOBALS['db']->query($sql_approval_status);
//             while($row_approval_status=$GLOBALS['db']->fetchByAssoc($result_approval_status)){
                
//                 $approval_status = $row_approval_status['approval_status'];
//                 $sender=$row_approval_status['sender'];
//                 $approver_rejector=$row_approval_status['approver'];
//                 $status_approval_table=$row_approval_status['status'];
              
//             }
            
            
//             if($approval_status == '0'){
//                  echo json_encode("block");
              
//             }
//             else{
//                  echo json_encode(array('1'=>$name_array,'2'=>$h_array,'3'=>$r_name,'a'=>$combined));
//             }
          
          
          
          
//       }
            
            
//           }
          
//           else{
            
//               echo json_encode("block");
//           }
          
//         }
        
        
        
   
//      }catch(Exception $e){
//     		echo json_encode(array("status"=>false, "message" => "Some error occured"));
//     	}
// 		die();
// }



//--------------------------------Assigned user list according to login user-------END------------


//-------------------------------------fetch assigned id---------------------------------------

// public function action_fetch_assigned_id(){
//      try{
//          $db = \DBManagerFactory::getInstance();
//         	$GLOBALS['db'];
        	  
//         	   global $current_user; 
//         	    $log_in_user_id = $current_user->id;
//         	    $assigned_name=$_POST['f'];
//         	    $f_name=$_POST['f_name'];
//         	    $l_name=$_POST['l_name'];
        	    
        	   
//         	     $sql="SELECT id  FROM users WHERE CONCAT(first_name, ' ', last_name) ='".$assigned_name."' ";
        	    
//         	     $result = $GLOBALS['db']->query($sql);
        	     
//         while($row = $GLOBALS['db']->fetchByAssoc($result)) 
//         {
            
           
            
            
//           $a_id=$row['id'];
           
           
    
            
//         }
        
        
        
//         echo $a_id;
//      }catch(Exception $e){
//     		echo json_encode(array("status"=>false, "message" => "Some error occured"));
//     	}
// 		die();
// }


//---------------------------------------fetch assigned id------END---------------------------------





//*******************************************************Write code above**************************************************
}

