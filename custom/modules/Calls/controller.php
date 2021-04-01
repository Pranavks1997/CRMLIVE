<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/MVC/Controller/SugarController.php');
require_once('include/SugarPHPMailer.php');
include_once('include/utils/db_utils.php');

class CallsController extends SugarController
{
    function action_oppurtunity_status(){
        try{
            $opp_id = $_POST['opp_id'];
        
             $name = array();
            $date=array();
            $description=array();
            
            
            $db = \DBManagerFactory::getInstance();
          $GLOBALS['db'];
          $sql = 'SELECT CONCAT(users.first_name," ",users.last_name) as name,DATE_FORMAT(description_activity.date_time, "%d/%m/%Y %H:%i:%s") as "date_time",description_activity.description   FROM description_activity INNER JOIN users on users.id=description_activity.user_id WHERE description_activity.opp_id="'.$opp_id.'" ORDER BY `date_time` DESC';
        
        $result = $GLOBALS['db']->query($sql);
        
        while($row = $GLOBALS['db']->fetchByAssoc($result) )
        {
          array_push($name, $row['name']);
          array_push($date,$row['date_time']);
          array_push($description,$row['description']);
        }
        
         $combined = array_map(function($b,$c,$d) { return  '['.$b.' : '.$c.' ] :- '.$d; }, $name,$date, $description);
        
        
        
          echo json_encode(array("status"=>true, "opp_status" => $combined));
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
    



//---------------------------------Editview untagged users ----------------------------------------------

public function action_untagged_users_list(){
     try{  
        global $current_user;
        $acc_id = $_POST['acc_id'];
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
            
    
    $sql1 = "SELECT  id, user_name,CONCAT(IFNULL(first_name,''), ' ', IFNULL(last_name,'')) AS fullname FROM users WHERE id NOT IN ('".implode("','",$reporting)."') ORDER BY first_name ASC";
      $result1 = $GLOBALS['db']->query($sql1);
      while($row1 = $GLOBALS['db']->fetchByAssoc($result1))
      {
              array_push($users_id,$row1['id']);
            array_push($email_id,$row1['user_name']);
             array_push($full_name,$row1['fullname']);
      }
        $sql = "SELECT  * FROM calls_cstm WHERE id_c='".$acc_id."' ";
      $result = $GLOBALS['db']->query($sql);
      while($row = $GLOBALS['db']->fetchByAssoc($result))
      {
              $others=$row['untag_hidden_c'];
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
       $acc_id = $_POST['acc_id'];
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
      
      $sql = "SELECT  * FROM calls_cstm WHERE id_c='".$acc_id."'";
      $result = $GLOBALS['db']->query($sql);
      while($row = $GLOBALS['db']->fetchByAssoc($result))
      {
              $others=$row['tag_hidden_c'];
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


           
public function action_new_assigned_list(){
     try{
         $db = \DBManagerFactory::getInstance();
          $GLOBALS['db'];
            
             global $current_user; 
             
            $acc_id=$_POST['acc_id'];
             $combined=array();
            $id_array1=array();
            $id_array=array();
            $name_array=array();
            $func_array=array();
           $func1_array=array();
              $h_array=array();
              $r_name=array();
              $number=array();
              $Approved_array=array();
              $Rejected_array=array();
              $pending_array=array();
              $func2_array=array();
              $h1_array=array();
              $rr_name=array();
               $n=1;
        $log_in_user_id = $current_user->id;
        
        
        
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
         
         
         //*********************************** Flow Starts here**************************  
        if($check_mc=='yes'){
           
            
          
         
        
   
       
       $sql1 = "SELECT users_cstm.teamfunction_c,users_cstm.teamheirarchy_c, users1.id,CONCAT(IFNULL(users1.first_name,''), ' ', IFNULL(users1.last_name,'')) AS name,CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS r_name , rpt_cstm.teamfunction_c as r_r_tf, rpt_cstm.teamheirarchy_c as r_r_th FROM users INNER JOIN users as users1 ON users.id=users1.reports_to_id INNER JOIN users_cstm as rpt_cstm ON rpt_cstm.id_c= users1.reports_to_id INNER JOIN users_cstm ON users_cstm.id_c=users1.id  WHERE  users1.deleted=0 ORDER BY `name` ASC";
       
      // $sql1="SELECT users_cstm.teamfunction_c,users_cstm.teamheirarchy_c, users1.id,CONCAT(IFNULL(users1.first_name,''), ' ', IFNULL(users1.last_name,'')) AS name,CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS r_name FROM users INNER JOIN users as users1 ON users.id=users1.reports_to_id INNER JOIN users_cstm ON users_cstm.id_c=users1.id WHERE users1.id IN ('".implode("','",$id_array1)."') AND users1.deleted=0 ORDER BY `name` ASC";
        $result1 = $GLOBALS['db']->query($sql1);
        while($row1 = $GLOBALS['db']->fetchByAssoc($result1)) 
        {
            array_push($number,$n);
            array_push($func1_array,$row1['teamfunction_c']);
           
            array_push($name_array,$row1['name']);
           array_push($h_array,$row1['teamheirarchy_c']);
            array_push($r_name,$row1['r_name']);
            array_push($func2_array,$row1['r_r_tf']);
            array_push($h1_array,$row1['r_r_th']);
            $n++;
        }
        
        
      
      $combined = array_map(function($b,$c,$d,$e,$f,$g) { if ($f==""){$f='MC';}return  $b.' / '.$c.' / '.$d.' -> '.$e.' / '.$f.' / '.$g; }, $name_array,$func1_array, $h_array,$r_name,$func2_array,$h1_array);
      
      $mc_no=$n+1;
      $mc_no=strval($mc_no); 
     
      $mc_details=$mc_name.' / ';
      
      array_push($combined,$mc_details);
      
      if($acc_id==''){
          
          echo json_encode(array('1'=>$name_array,'2'=>$h_array,'3'=>$r_name,'a'=>$combined));
      }
      else{
            $sql_approval_status = "SELECT * FROM activity_approval_table WHERE id=(SELECT MAX(id) FROM activity_approval_table WHERE acc_id ='".$acc_id."' ) ";
            $result_approval_status = $GLOBALS['db']->query($sql_approval_status);
            while($row_approval_status=$GLOBALS['db']->fetchByAssoc($result_approval_status)){
                
                $approval_status = $row_approval_status['approval_status'];
                $sender=$row_approval_status['sender'];
                $approver_rejector=$row_approval_status['approver'];
                $status_approval_table=$row_approval_status['status'];
              
            }
            
            
            if($approval_status == '0'){
                 echo json_encode("block");
              
            }
            else{
                 echo json_encode(array('1'=>$name_array,'2'=>$h_array,'3'=>$r_name,'a'=>$combined));
            }
          
          
          
          
      }
      
                           
      
      
        }
        
        
else if($check_team_lead=='team_member_l1'||$check_team_lead=='team_member_l2'||$check_team_lead=='team_member_l3'||$check_team_lead=='team_lead'){
           
         $sql4='SELECT * FROM users WHERE reports_to_id="'.$log_in_user_id.'" AND deleted=0' ;
          $result4 = $GLOBALS['db']->query($sql4);
          
          if($result4->num_rows>0){
               
               while($row4 = $GLOBALS['db']->fetchByAssoc($result4)) 
                {
                
                   $id_array1[]=$row4["id"];
                }
              
            array_push($id_array1,$log_in_user_id);
            
            
            
              
                  
                   $sql1="SELECT users_cstm.teamfunction_c,users_cstm.teamheirarchy_c, users1.id,CONCAT(IFNULL(users1.first_name,''), ' ', IFNULL(users1.last_name,'')) AS name,CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS r_name FROM users INNER JOIN users as users1 ON users.id=users1.reports_to_id INNER JOIN users_cstm ON users_cstm.id_c=users1.id WHERE users1.id IN ('".implode("','",$id_array1)."') AND users1.deleted=0 ORDER BY `name` ASC";
        $result1 = $GLOBALS['db']->query($sql1);
        while($row1 = $GLOBALS['db']->fetchByAssoc($result1)) 
        {
            array_push($number,$n);
            array_push($func1_array,$row1['teamfunction_c']);
           
            array_push($name_array,$row1['name']);
           array_push($h_array,$row1['teamheirarchy_c']);
            array_push($r_name,$row1['r_name']);
            $n++;
        }
        




      
      $combined = array_map(function($b,$c,$d,$e) { return  $b.' / '.$c.' / '.$d.' -> '.$e; }, $name_array,$func1_array, $h_array,$r_name);
      
     
            
             if($acc_id==''){
          
          echo json_encode(array('1'=>$name_array,'2'=>$h_array,'3'=>$r_name,'a'=>$combined));
      }
      else{
            $sql_approval_status = "SELECT * FROM activity_approval_table WHERE id=(SELECT MAX(id) FROM activity_approval_table WHERE acc_id ='".$acc_id."' ) ";
            $result_approval_status = $GLOBALS['db']->query($sql_approval_status);
            while($row_approval_status=$GLOBALS['db']->fetchByAssoc($result_approval_status)){
                
                $approval_status = $row_approval_status['approval_status'];
                $sender=$row_approval_status['sender'];
                $approver_rejector=$row_approval_status['approver'];
                $status_approval_table=$row_approval_status['status'];
              
            }
            
            
            if($approval_status == '0'){
                 echo json_encode("block");
              
            }
            else{
                 echo json_encode(array('1'=>$name_array,'2'=>$h_array,'3'=>$r_name,'a'=>$combined));
            }
          
          
          
          
      }
            
            
          }
          
          else{
            
              echo json_encode("block");
          }
          
        }
        
        
        
   
     }catch(Exception $e){
        echo json_encode(array("status"=>false, "message" => "Some error occured"));
      }
    die();
}



//--------------------------------Assigned user list according to login user-------END------------


//-------------------------------------fetch assigned id---------------------------------------

public function action_fetch_assigned_id(){
     try{
         $db = \DBManagerFactory::getInstance();
          $GLOBALS['db'];
            
             global $current_user; 
              $log_in_user_id = $current_user->id;
              $assigned_name=$_POST['f'];
              $f_name=$_POST['f_name'];
              $l_name=$_POST['l_name'];
              
             
               $sql="SELECT id  FROM users WHERE CONCAT(first_name, ' ', last_name) ='".$assigned_name."' ";
              
               $result = $GLOBALS['db']->query($sql);
               
        while($row = $GLOBALS['db']->fetchByAssoc($result)) 
        {
            
           
            
            
           $a_id=$row['id'];
           
           
    
            
        }
        
        
        
        echo $a_id;
     }catch(Exception $e){
        echo json_encode(array("status"=>false, "message" => "Some error occured"));
      }
    die();
}







//---------------------------------------fetch assigned id------END---------------------------------


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

//--------------------------------follow up activity check-------------------------------------------------

public function action_follow_up_activity_check()
    {
       $p_id=$_POST['p_id'];
       
      
      try{  
          
          
          
            global $current_user;
            $log_in_user_id = $current_user->id;
            
          $sql11='SELECT * FROM `calls` WHERE `parent_id`="'.$p_id.'"';
          
           $result11 = $GLOBALS['db']->query($sql11);
           
           if($result11->num_rows>0){
                while ($row11= mysqli_fetch_assoc($result11)){
            
             $f_name=$row11['name'];
            
             
        }
              echo json_encode(array("status"=>true, "f_name"=>$f_name));
           }
           
             $sql ="SELECT assigned_user_id FROM calls where id ='".$p_id."' "; 
            $result = $GLOBALS['db']->query($sql);
            $row = $result->fetch_assoc();
            $user_id = $row['assigned_user_id'];
            
            //  $sql_status ="SELECT * FROM calls_cstm where id_c='$p_id' "; 
            // $result_status = $GLOBALS['db']->query($sql_status);
            // $row_status = $result_status->fetch_assoc();
            // $status= $row_status['status_new_c'];

            $sql1 = "SELECT user_lineage from users_cstm where id_c = '".$user_id."' ";
            $result1 = $GLOBALS['db']->query($sql1);
             while($row1 = $GLOBALS['db']->fetchByAssoc($result1)) 
            {
              $lineage=$row1['user_lineage'];

            }
             $lineage_array=explode(',',$lineage);
            
            $sql3 = "SELECT users.id, users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '".$log_in_user_id."' AND users.deleted = 0";
            $result3 = $GLOBALS['db']->query($sql3);
            while($row3 = $GLOBALS['db']->fetchByAssoc($result3)) 
            {
                $check_sales = $row3['teamfunction_c'];
                $check_mc = $row3['mc_c'];
                $check_team_lead = $row3['teamheirarchy_c'];

            }
          
            if($check_mc=='yes'){}
     else if(in_array($log_in_user_id,$lineage_array)){}
     else if($log_in_user_id==$user_id){}
     else{
         
         if($p_id!=''){
          echo json_encode(array("status"=>false));
         }
     }
           
           
          
        
      } catch(Exception $e) {
          echo json_encode(array("status"=>false, "message"=>"some error occured"));
      }
      die();
    }
    
//-----------------------------------follow up activity check-------END-----------------------------------


//--------------------------------Opportunity Check--------------------------------------------------------
//--------------------------------follow up activity check-------------------------------------------------

public function action_follow_up_opp_check()
    {
       $p_id=$_POST['p_id'];
       
      
      try{  
          
          
          
            global $current_user;
            $log_in_user_id = $current_user->id;
            
        
    $sql_lineage ='SELECT opportunities.assigned_user_id,users_cstm.user_lineage, tagged_user.user_id FROM opportunities LEFT JOIN users_cstm ON users_cstm.id_c=opportunities.assigned_user_id LEFT JOIN tagged_user ON tagged_user.opp_id=opportunities.id WHERE opportunities.id="'.$p_id.'"';
    $result_lineage = $GLOBALS['db']->query($sql_lineage);
     while($row = $GLOBALS['db']->fetchByAssoc($result_lineage)) 
    {
           $lineage=$row['user_lineage']; 
           $assigned_id=$row['assigned_user_id'];
           $tagged=$row['user_id'];
    }
    $lineage_array= explode(",", $lineage);
    $tagged_array= explode(",", $tagged);
    
    $sql1 ='SELECT users.reports_to_id, users_cstm.mc_c FROM users INNER JOIN users_cstm ON users_cstm.id_c= "'.$log_in_user_id.'" WHERE reports_to_id = "'.$log_in_user_id.'"';
    $result1 = $GLOBALS['db']->query($sql1);
    $reporting_count=$result1->num_rows;
     while($row = $GLOBALS['db']->fetchByAssoc($result1)) {
        $mc_check=$row['mc_c'];
     }
     
     if($mc_check=='yes'){}
     else if(in_array($log_in_user_id,$lineage_array)||in_array($log_in_user_id,$tagged_array)){}
     else if($log_in_user_id==$assigned_id){}
     else{
           if($p_id!=''){
          echo json_encode(array("status"=>true));
         }
     }
    
           
          
        
      } catch(Exception $e) {
          echo json_encode(array("status"=>false, "message"=>"some error occured"));
      }
      die();
    }
    
//-----------------------------------follow up activity check-------END-----------------------------------



//---------------------------------Opportunity Check End---------------------------------------------------

//-------------------------------- activity status Change-------------------------------------------------

public function action_status_change()
    {
       $assigned_id=$_POST['assigned_id'];
       $assigned_name=$_POST['assigned_name'];
      
      try{  
          
          
          
            global $current_user;
            $log_in_user_id = $current_user->id;
            
            
            
            
              
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
                
                
             echo json_encode(array('mc'=>"yes",'login_user'=>$log_in_user_id));
             
            }
            else{
            echo json_encode(array('mc'=>"no",'login_user'=>$log_in_user_id));
            }
            
            
        }else{
            echo json_encode(array('mc'=>"no",'login_user'=>$log_in_user_id));
        }
         
       
            
           
          
        
      } catch(Exception $e) {
          echo json_encode(array("status"=>false, "message"=>"some error occured"));
      }
      die();
    }
    

//----------------------------------- activity status change-------END-----------------------------------

//-----------------------Approval Buttons----------------------------------------------------------------------
public function action_approval_buttons(){
     try{
         $db = \DBManagerFactory::getInstance();
          $GLOBALS['db'];
            
             global $current_user; 
              $log_in_user_id = $current_user->id;
               
                  $assigned_id = $_POST['assigned_id'];
                  $acc_id = $_POST['acc_id'];
                 $approver_id=$_POST['approver_id'];
                 $status=$_POST['status'];  
                 
                 
                 $sql_delegate="SELECT * FROM `calls_cstm` WHERE `id_c`='".$acc_id."';";
                  $result_delegate = $GLOBALS['db']->query($sql_delegate);
                    while($row_delegate = $GLOBALS['db']->fetchByAssoc($result_delegate)) 
                    {
                        $delegate_id=$row_delegate['delegate_id'];
                        
                    }
                    
                  
                 
      $sql_logged_user = "SELECT users.id, users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '".$log_in_user_id."' AND users.deleted = 0";
        $result_logged_user = $GLOBALS['db']->query($sql_logged_user);
        while($row_logged_user = $GLOBALS['db']->fetchByAssoc($result_logged_user)) 
        {
            $check_sales = $row_logged_user['teamfunction_c'];
            $check_mc = $row_logged_user['mc_c'];
            $check_team_lead = $row_logged_user['teamheirarchy_c'];
            
        }

    $sql_assigned_user = "SELECT users.id, users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c,users.reports_to_id,users_cstm.user_lineage FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '".$assigned_id."' AND users.deleted = 0";
        $result_assigned_user = $GLOBALS['db']->query($sql_assigned_user);
        while($row_assigned_user = $GLOBALS['db']->fetchByAssoc($result_assigned_user)) 
        {
           $reports_to=$row_assigned_user['reports_to_id'];
           $lineage=$row_assigned_user['user_lineage'];
           
            
        }    
       
        
        $lineage_array=explode(',',$lineage);
        
               
                  
            $sql_approval_status = "SELECT * FROM activity_approval_table WHERE id=(SELECT MAX(id) FROM activity_approval_table WHERE acc_id ='".$acc_id."' ) ";
            $result_approval_status = $GLOBALS['db']->query($sql_approval_status);
            while($row_approval_status=$GLOBALS['db']->fetchByAssoc($result_approval_status)){
                
                $approval_status = $row_approval_status['approval_status'];
                $sender=$row_approval_status['sender'];
                $approver_rejector=$row_approval_status['approver'];
                $status_approval_table=$row_approval_status['status'];
              
            }
            
            
            if($approval_status == '0'){
                
                if($log_in_user_id==$sender){
                
               echo json_encode(array("message"=>"Pending" )); 
            
                }
                 if($log_in_user_id==$approver_rejector){
                
               echo json_encode(array("message"=>"Pending_approve" )); 
            
                }
                 if($log_in_user_id==$delegate_id){
                
               echo json_encode(array("message"=>"Pending_approve" )); 
            
                }
            }
            
            else if($approval_status == '1'){
                
                echo json_encode(array("message"=>"Approved" ));
            }
            
            else if($approval_status == '2'){
                
                
                 if($log_in_user_id==$sender){
                
               echo json_encode(array("message"=>"Rejected" )); 
            
                }
            }
            else {
                
                if($status=='Upcoming'){
                    
                
                if($log_in_user_id==$assigned_id && $log_in_user_id==$approver_id){
                    
                    echo json_encode(array("message"=>"show_completed"));
                    
                }
                else if($log_in_user_id==$assigned_id){
                echo json_encode(array("message"=>"show_send_approval"));
                }
                else{
                    echo json_encode(array("message"=>"no" )); 
                }
                
                
            }
                else if($status=='Apply For Completed'){
                    
                   if($log_in_user_id==$assigned_id){
                echo json_encode(array("message"=>"show_send_approval"));
                }
                else{
                    echo json_encode(array("message"=>"no" )); 
                }
                     
                }
                else{
                    echo json_encode(array("message"=>"no" )); 
                }
        }
           
           
           
           
           
            
              
     }catch(Exception $e){
        echo json_encode(array("status"=>false, "message" => "Some error occured"));
      }
    die();
}


//-----------------------Approval Buttons----------END------------------------------------------------------------


//----------------------send approval/apply for complete ---------------------------------------------------

public function action_send_approval(){
  try{
    $db = \DBManagerFactory::getInstance();
    $GLOBALS['db'];
            
    global $current_user; 
    $log_in_user_id = $current_user->id;
    $status = $_POST['status'];
    $sender = $_POST['sender'];
    // $date = $_POST['date'];
    $date = date('Y-m-d');
    $approver = $_POST['approver'];
    $acc_id = $_POST['acc_id'];
    $acc_type = $_POST['acc_type'];
                  
    if($status == "Upcoming"){
      $status = 'Apply For Completed';
    }
                  
    $sql_approval_status = "SELECT * FROM activity_approval_table WHERE id=(SELECT MAX(id) FROM activity_approval_table WHERE acc_id ='".$acc_id."' ) ";
    
    $result_approval_status = $GLOBALS['db']->query($sql_approval_status);
    
    while($row_approval_status=$GLOBALS['db']->fetchByAssoc($result_approval_status)){
      $approval_status = $row_approval_status['approval_status'];          
    }
    
    if($approval_status == '0'){
      exit(json_encode(array("status"=>"Pending" ))); 
    }
    else if($approval_status == '1'){
      exit(json_encode(array("status"=>"approved" )));
    }
    else if($approval_status == '2'){
      $sql_insert_activity = "INSERT INTO `activity_approval_table`( `acc_id`, `acc_type`, `status`, `sender`, `sent_time`, `approval_status`,`approver`) VALUES ('".$acc_id."','".$acc_type."','".$status."','".$sender."','".$date."','0','".$approver."')";
      
      if($GLOBALS['db']->query($sql_insert_activity)==TRUE){
        $update_calls_cstm = "UPDATE `calls_cstm` SET `status_new_c`='".$status."' WHERE `id_c`='".$acc_id."'";
      
        $GLOBALS['db']->query($update_calls_cstm);
      }
    }
    else{
      $sql_max_id = "SELECT MAX(id) as id FROM activity_approval_table";

      $result_max_id = $GLOBALS['db']->query($sql_max_id);

      while ($row = $GLOBALS['db']->fetchByAssoc($result_max_id)) {
        $id = ++$row['id'];
      }

      $sql_insert_activity = "INSERT INTO `activity_approval_table`(`id`, `acc_id`, `acc_type`, `status`, `sender`, `sent_time`, `approval_status`,`approver`) VALUES ('".$id."', '".$acc_id."','".$acc_type."','".$status."','".$sender."','".$date."','0','".$approver."')";
      
      // $GLOBALS['db']->query($sql_insert_activity);
      $GLOBALS['db']->query($sql_insert_activity);
                    
                    
    }


    // Get Activity Details
    $sql = "SELECT * FROM `calls` WHERE `id`='".$acc_id."';";
    $result = $GLOBALS['db']->query($sql);

    while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
      $assigned_to = $row['assigned_user_id'];
      $activity_name = $row['name']; 
      $activity_id = $row['id'];
    }

    // Get approver name
    $sql = "SELECT * FROM `users` WHERE `id`='".$approver."';";
    $result = $GLOBALS['db']->query($sql);

    while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
      $approver = $row['first_name'].' '.$row['last_name'];
      $approver_id = $row['id'];
      $approver_email = $row['user_name'];
    }

    //Send Notification to approver
    $alert = BeanFactory::newBean('Alerts');
    $alert->name = '';
    
    $alert->description = 'Activity "'.$activity_name.'" is received for approval from "'.$current_user->first_name.' '.$current_user->last_name.'"';

    $alert->url_redirect = $base_url.'index.php?action=DetailView&module=Calls&record='.$activity_id;
    $alert->target_module = 'Activities';
    $alert->assigned_user_id = $approver_id;
    $alert->type = 'info';
    $alert->is_read = 0;
    $alert->save();

    // Send email to approver
    $subject = 'CRM ALERT - Approval Request';
    $body = 'Activity "'.$activity_name.'" is received for approval from "'.$current_user->first_name.' '.$current_user->last_name.'" <br><br> Click here to view: www.ampersandcrm.com';
    $created_at = date('Y-m-d H:i:s');
    $to = $approver_email;

    $sql="INSERT INTO `email_queue` (`subject`, `body`, `to`, `created_at`) VALUES ('$subject', '$body', '$to', '$created_at')";

    $GLOBALS['db']->query($sql); 

    echo json_encode([
      "button" => "hide",
      "message" => "Approval request has been sent to ".$approver
    ]);
              
  }
  catch(Exception $e){
    echo json_encode(array("status"=>false, "message" => "Some error occured"));
  }
  die();
}

//----------------------send approval/apply for complete ----------END---------------------------------------

//---------------------- edit View access-------------------------------------------------------------------
public function action_editView_access(){
    try{
         $db = \DBManagerFactory::getInstance();
          $GLOBALS['db'];
          
              global $current_user; 
              $log_in_user_id = $current_user->id;
              $acc_id =$_POST['acc_id'];
              $assigned_id = $_POST['assigned_id'];
              
      $sql_logged_user = "SELECT users.id, users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '".$log_in_user_id."' AND users.deleted = 0";
        $result_logged_user = $GLOBALS['db']->query($sql_logged_user);
        while($row_logged_user = $GLOBALS['db']->fetchByAssoc($result_logged_user)) 
        {
            $check_sales = $row_logged_user['teamfunction_c'];
            $check_mc = $row_logged_user['mc_c'];
            $check_team_lead = $row_logged_user['teamheirarchy_c'];
            
        }

    $sql_assigned_user = "SELECT users.id, users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c,users.reports_to_id,users_cstm.user_lineage FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '".$assigned_id."' AND users.deleted = 0";
        $result_assigned_user = $GLOBALS['db']->query($sql_assigned_user);
        while($row_assigned_user = $GLOBALS['db']->fetchByAssoc($result_assigned_user)) 
        {
           $reports_to=$row_assigned_user['reports_to_id'];
           $lineage=$row_assigned_user['user_lineage'];
           
            
        }    
       
        
        $lineage_array=explode(',',$lineage);
        
      $sql_tagged_user = "SELECT * FROM calls_cstm  WHERE id_c= '".$acc_id."'";
        $result_tagged_user = $GLOBALS['db']->query($sql_tagged_user);
        while($row_tagged_user = $GLOBALS['db']->fetchByAssoc($result_tagged_user)) 
        {
           
           $tagged_users=$row_tagged_user['tag_hidden_c'];
            
        }        
        
        $tagged_users_array=explode(',',$tagged_users);
              
              if($acc_id==""){
                  
                  if($check_mc=="yes"||$check_team_lead=="team_lead"){
                      echo json_encode(array('message'=>"no_acc_id_view_all"));
                      
                  }else{
                       echo json_encode(array('message'=>"no_acc_id_view_few"));
                  }
                  
              }
              
              else{
                 
                      
                  if($check_mc=="yes"){
                      
                  }
                  
                  else if(in_array($log_in_user_id,$lineage_array)){
                       
                      if($check_team_lead=="team_lead"){
                          
                      }
                      else{
                           echo json_encode(array('message'=>"acc_id_view_no"));
                      }
                      
                  }
                  else if(in_array($log_in_user_id,$tagged_users_array)){
                      
                      if($check_team_lead=="team_lead"){
                          echo json_encode(array('message'=>"acc_id_view_few"));
                      }
                      else{
                            echo json_encode(array('message'=>"acc_id_view_no"));
                      }
                      
                  } 
                   else if($log_in_user_id==$assigned_id){
                      
                      if($check_team_lead=="team_lead"){
                         
                      }
                      else{
                            echo json_encode(array('message'=>"acc_id_view_no"));
                      }
                      
                  } 
              }
              
         
            
    }catch(Exception $e) {
          echo json_encode(array("status"=>false, "message"=>"some error occured"));
      }
      die();
}


//---------------------- edit View access---------END----------------------------------------------------------


//---------------------------Approve---------------------------------------------------------------------------


public function action_approve(){
  try{
    $db = \DBManagerFactory::getInstance();
    $GLOBALS['db'];
              
    global $current_user; 
    $log_in_user_id = $current_user->id;

    $sender = $_POST['assigned_id'];
    $date = $_POST['date'];
    $approver = $_POST['approver_id'];
    $acc_id = $_POST['acc_id'];
    $comments=$_POST['comments'];
    $status='Completed';
                   
                   
    $sql_delegate="SELECT * FROM `calls_cstm` WHERE `id_c`='".$acc_id."';";
    $result_delegate = $GLOBALS['db']->query($sql_delegate);

    while($row_delegate = $GLOBALS['db']->fetchByAssoc($result_delegate)) {
      $delegate_id=$row_delegate['delegate_id'];
    }

    if($log_in_user_id==$delegate_id){                      
      $update_query="UPDATE `activity_approval_table` SET `approval_status`='1',delegate_approve_reject_date='".$date."',`delegate_comment`='".$comments."',delegate_id='".$log_in_user_id."' WHERE acc_id ='".$acc_id."' AND `sender`='".$sender."'  AND approval_status='0'";
                     
      $GLOBALS['db']->query($update_query);
    }
    else{
      $update_query="UPDATE `activity_approval_table` SET `approval_status`='1',`approve_reject_date`='".$date."',`approver_comment`='".$comments."' WHERE acc_id ='".$acc_id."' AND `sender`='".$sender."' AND`approver`='".$approver."' AND approval_status='0'";
      
      $GLOBALS['db']->query($update_query);
    }

    // Get assigned to user id
    $sql = "SELECT * FROM `calls` WHERE `id`='".$acc_id."';";
    $result = $GLOBALS['db']->query($sql);

    while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
      $assigned_to = $row['assigned_user_id'];
      $activity_name = $row['name']; 
      $activity_id = $row['id'];
    }

    // Get assigned user name
    $sql = "SELECT * FROM `users` WHERE `id`='".$assigned_to."';";
    $result = $GLOBALS['db']->query($sql);

    while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
      $assigned_to_name = $row['first_name'].' '.$row['last_name'];
      $assigned_to_email = $row['user_name'];
    }

    // Get Tagged Users
    $sql = "SELECT * FROM `calls_cstm` WHERE id_c='".$acc_id."'";
    $result = $GLOBALS['db']->query($sql);
    
    while($row = $GLOBALS['db']->fetchByAssoc($result)){
      $tagged_ids = $row['tag_hidden_c'];
    }

    $tagged_id_array = explode(',', $tagged_ids);

    $tagged_users = [];
    foreach ($tagged_id_array as $key => $user_id) {
      $sql = 'SELECT * FROM `users` WHERE id="'.$user_id.'"';
      $result = $GLOBALS['db']->query($sql);

      while($row = $GLOBALS['db']->fetchByAssoc($result)){
        $tagged_users[] = $row;
      }
      
    }

    // If assigned to user exists
    if((bool)$assigned_to_name){
      // Send Notification to assigned user
      $alert = BeanFactory::newBean('Alerts');
      $alert->name = '';

      $alert->description = 'Activity "'.$activity_name.'" is approved by "'.$current_user->first_name.' '.$current_user->last_name.'"';

      $alert->url_redirect = $base_url.'index.php?action=DetailView&module=Calls&record='.$activity_id;
      $alert->target_module = 'Activities';
      $alert->assigned_user_id = $assigned_to;
      $alert->type = 'info';
      $alert->is_read = 0;
      $alert->save();

      // Send email to assigned user
      $subject = 'CRM ALERT - Approved';
      $body = 'Activity "'.$activity_name.'" is approved by "'.$current_user->first_name.' '.$current_user->last_name.'" <br><br> Click here to view: www.ampersandcrm.com';
      $created_at = date('Y-m-d H:i:s');
      $to = $assigned_to_email;

      $sql="INSERT INTO `email_queue` (`subject`, `body`, `to`, `created_at`) VALUES ('$subject', '$body', '$to', '$created_at')";

      $GLOBALS['db']->query($sql);

      // Send Notifications and email to tagged users
      foreach ($tagged_users as $key => $user) {
        // Send Notification to tagged user
        $alert = BeanFactory::newBean('Alerts');
        $alert->name = '';
        
        $alert->description = 'Activity "'.$activity_name.'" assigned to "'.$assigned_to_name.'" has been Approved by "'.$current_user->first_name.' '.$current_user->last_name.'"';

        $alert->url_redirect = $base_url.'index.php?action=DetailView&module=Calls&record='.$activity_id;
        $alert->target_module = 'Activities';
        $alert->assigned_user_id = $user['id'];
        $alert->type = 'info';
        $alert->is_read = 0;
        $alert->save();

        // Send Email to tagged user
        $subject = 'CRM ALERT - Approved';
        $body = 'Activity "'.$activity_name.'" assigned to "'.$assigned_to_name.'" has been Approved by "'.$current_user->first_name.' '.$current_user->last_name.'" <br><br> Click here to view: www.ampersandcrm.com';
        $created_at = date('Y-m-d H:i:s');
        $to = $user['user_name'];

        $sql="INSERT INTO `email_queue` (`subject`, `body`, `to`, `created_at`) VALUES ('$subject', '$body', '$to', '$created_at')";

        $GLOBALS['db']->query($sql);

      }

    }

    echo json_encode([
        'button'=>'hide', 
        'message' => 'Activity "'.$activity_name.'" approved successfully.'
    ]);

  }
  catch(Exception $e){
    echo json_encode(array("status"=>false, "message" => "Some error occured"));
  }
  die();
}

//---------------------------Approve-------------END--------------------------------------------------------------


//---------------------------Reject---------------------------------------------------------------------------


public function action_reject(){
  try{
    $db = \DBManagerFactory::getInstance();
    $GLOBALS['db'];
            
    global $current_user; 
    $log_in_user_id = $current_user->id;

    $sender = $_POST['assigned_id'];
    $date = $_POST['date'];
    $approver = $_POST['approver_id'];
    $acc_id = $_POST['acc_id'];
    $comments=$_POST['comment_reject'];
                              
    $sql_delegate="SELECT * FROM `calls_cstm` WHERE `id_c`='".$acc_id."';";
    $result_delegate = $GLOBALS['db']->query($sql_delegate);
    while($row_delegate = $GLOBALS['db']->fetchByAssoc($result_delegate)) { 
      $delegate_id=$row_delegate['delegate_id'];
    }
    if($log_in_user_id==$delegate_id){                   
      $update_query="UPDATE `activity_approval_table` SET `approval_status`='2',delegate_approve_reject_date='".$date."',`delegate_comment`='".$comments."',delegate_id='".$log_in_user_id."' WHERE acc_id ='".$acc_id."' AND `sender`='".$sender."'  AND approval_status='0'";
                   
      $GLOBALS['db']->query($update_query);
    }                    
    else{              
      $update_query="UPDATE `activity_approval_table` SET `approval_status`='2',`approve_reject_date`='".$date."',`approver_comment`='".$comments."' WHERE acc_id ='".$acc_id."' AND `sender`='".$sender."' AND`approver`='".$approver."' AND approval_status='0'";
      
      $GLOBALS['db']->query($update_query);    
    }
                
    // Get assigned to user id
    $sql = "SELECT * FROM `calls` WHERE `id`='".$acc_id."';";
    $result = $GLOBALS['db']->query($sql);

    while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
      $assigned_to = $row['assigned_user_id'];
      $activity_name = $row['name']; 
      $activity_id = $row['id'];
    }

    // Get assigned user name
    $sql = "SELECT * FROM `users` WHERE `id`='".$assigned_to."';";
    $result = $GLOBALS['db']->query($sql);

    while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
      $assigned_to_name = $row['first_name'].' '.$row['last_name'];
      $assigned_to_email = $row['user_name'];
    }

    // Get Tagged Users
    $sql = "SELECT * FROM `calls_cstm` WHERE id_c='".$acc_id."'";
    $result = $GLOBALS['db']->query($sql);
    
    while($row = $GLOBALS['db']->fetchByAssoc($result)){
      $tagged_ids = $row['tag_hidden_c'];
    }

    $tagged_id_array = explode(',', $tagged_ids);

    $tagged_users = [];
    foreach ($tagged_id_array as $key => $user_id) {
      $sql = 'SELECT * FROM `users` WHERE id="'.$user_id.'"';
      $result = $GLOBALS['db']->query($sql);

      while($row = $GLOBALS['db']->fetchByAssoc($result)){
        $tagged_users[] = $row;
      }
      
    }

    // If assigned to user exists
    if((bool)$assigned_to_name){
      // Send Notification to assigned user
      $alert = BeanFactory::newBean('Alerts');
      $alert->name = '';
      
      // $alert->description = 'Activity "'.$activity_name.'" assigned to "'.$assigned_to_name.'" has been Rejected by "'.$current_user->first_name.' '.$current_user->last_name.'"';

      $alert->description = 'Activity "'.$activity_name.'" is rejected by "'.$current_user->first_name.' '.$current_user->last_name.'"';

      $alert->url_redirect = $base_url.'index.php?action=DetailView&module=Calls&record='.$activity_id;
      $alert->target_module = 'Activities';
      $alert->assigned_user_id = $assigned_to;
      $alert->type = 'info';
      $alert->is_read = 0;
      $alert->save();

      // Send email to assigned user
      $subject = 'CRM ALERT - Rejected';
      $body = 'Activity "'.$activity_name.'" is rejected by "'.$current_user->first_name.' '.$current_user->last_name.'" <br><br> Click here to view: www.ampersandcrm.com';
      $created_at = date('Y-m-d H:i:s');
      $to = $assigned_to_email;

      $sql="INSERT INTO `email_queue` (`subject`, `body`, `to`, `created_at`) VALUES ('$subject', '$body', '$to', '$created_at')";

      $GLOBALS['db']->query($sql);

      // Send Notifications and email to tagged users
      foreach ($tagged_users as $key => $user) {
        // Send Notification to tagged user
        $alert = BeanFactory::newBean('Alerts');
        $alert->name = '';
        
        $alert->description = 'Activity "'.$activity_name.'" assigned to "'.$assigned_to_name.'" has been Rejected by "'.$current_user->first_name.' '.$current_user->last_name.'"';

        $alert->url_redirect = $base_url.'index.php?action=DetailView&module=Calls&record='.$activity_id;
        $alert->target_module = 'Activities';
        $alert->assigned_user_id = $user['id'];
        $alert->type = 'info';
        $alert->is_read = 0;
        $alert->save();

        // Send Email to tagged user
        $subject = 'CRM ALERT - Rejected';
        $body = 'Activity "'.$activity_name.'" assigned to "'.$assigned_to_name.'" has been Rejected by "'.$current_user->first_name.' '.$current_user->last_name.'" <br><br> Click here to view: www.ampersandcrm.com';
        $created_at = date('Y-m-d H:i:s');
        $to = $user['user_name'];

        $sql="INSERT INTO `email_queue` (`subject`, `body`, `to`, `created_at`) VALUES ('$subject', '$body', '$to', '$created_at')";

        $GLOBALS['db']->query($sql);

      }
    }           
                  
    
    echo json_encode([
      'button'=>'hide', 
      'message' => 'Activity "'.$activity_name.'" rejected successfully.'
    ]);     
              
  }catch(Exception $e){
        echo json_encode(array("status"=>false, "message" => "Some error occured"));
  }
  die();
}



//---------------------------Reject-------------END--------------------------------------------------------------

//--------------------------------------Completed--------------------------------------------------
   public function action_completed(){
     try{
         $db = \DBManagerFactory::getInstance();
          $GLOBALS['db'];
            
             global $current_user; 
              $log_in_user_id = $current_user->id;
                $acc_type=$_POST['acc_type'];
                  $sender = $_POST['assigned_id'];
                  $date = $_POST['date'];
                  $approver = $_POST['approver_id'];
                  $acc_id = $_POST['acc_id'];
               
                 $status='Completed';
                  
              $update_query="INSERT INTO `activity_approval_table`( `acc_id`, `acc_type`, `status`, `sender`, `sent_time`, `approval_status`,approve_reject_date,`approver`) VALUES ('".$acc_id."','".$acc_type."','".$status."','".$sender."','".$date."','1','".$date."','".$approver."')";
                   if($GLOBALS['db']->query($update_query)==TRUE){
                       
                  
                       
                          echo json_encode(array("button"=>"hide"));
                    }
           
              
     }catch(Exception $e){
        echo json_encode(array("status"=>false, "message" => "Some error occured"));
      }
    die();
}



   

//--------------------------------------Completed-------END-------------------------------------------


function action_insert(){
        try{
            require_once 'data/BeanFactory.php';
            require_once 'include/utils.php';
            $id = create_guid();
            $created_date= date("Y-m-d H:i:s", time());
            $db = \DBManagerFactory::getInstance();
          $GLOBALS['db'];
        $sql = 'INSERT INTO `calls_audit`(`id`, `parent_id`, `date_created`, `created_by`, `field_name`, `data_type`, `before_value_string`, `after_value_string`, `before_value_text`, `after_value_text`) VALUES ("'.$id.'","'.$activity_id.'","'.$created_date.'","'.$log_in_user_id.'","status_new_c","varchar"," "," "," "," ")';
        $result = $GLOBALS['db']->query($sql);
      }catch(Exception $e){
        echo json_encode(array("status"=>false, "message" => "Some error occured"));
      }
    }
    
//      function action_hide_user_subpanel_for_view_only_user(){
//         try{
//             global $current_user;
//        $log_in_user_id = $current_user->id;
//             $db = \DBManagerFactory::getInstance();
//          $GLOBALS['db'];
//             $view_only_user = array();
//      $sql = 'SELECT role_id, user_id FROM acl_roles_users where role_id="af3c481e-708f-64e1-f795-5f896b40d41c" AND deleted="0"';
//      $result = $GLOBALS['db']->query($sql);
      
//      while($row = $GLOBALS['db']->fetchByAssoc($result) )
//      {
//          array_push($view_only_user,$row['user_id']);
//      }
//      if(in_array($log_in_user_id, $view_only_user)) {
//          echo json_encode(array("status"=>true, "access" => 'no'));
//      }else{
//          echo json_encode(array("status"=>true, "access" => 'yes'));
//      }
//      }catch(Exception $e){
//        echo json_encode(array("status"=>false, "message" => "Some error occured"));
//      }
//      die();
//      }
// public function action_activityDate(){
//         try{
//             $db = \DBManagerFactory::getInstance();
//          $GLOBALS['db'];
//        $sql = 'SELECT * FROM `activity_approval_table` WHERE `approval_status`="0" AND status="Apply For Completed" AND CURRENT_DATE > sent_time + INTERVAL 7 day';
//        $result = $GLOBALS['db']->query($sql);
//        if($result->num_rows>0){
//        while($rows = $GLOBALS['db']->fetchByAssoc($result) )
//        {
//          $update_calls_query="UPDATE calls_cstm SET status_new_c ='Overdue' WHERE id_c='".$rows['acc_id']."'";
//          $res_update = $db->query($update_calls_query);
//          $update_activity_query="UPDATE activity_approval_table SET approval_status ='3' WHERE acc_id='".$rows['acc_id']."'";
//          $res_calls_update = $db->query($update_activity_query);
//        }
//        }
//          $sql1 = 'SELECT t1.acc_id,t2.activity_date_c FROM activity_approval_table as t1 LEFT JOIN calls_cstm as t2 ON t2.id_c = t1.acc_id WHERE t1.approval_status="2" AND t1.status="Apply For Completed" AND t2.activity_date_c < CURRENT_DATE';
//        $result1 = $GLOBALS['db']->query($sql1);
//        if($result1->num_rows>0){
//        while($rows = $GLOBALS['db']->fetchByAssoc($result1) )
//        {
//            $update_calls_query1="UPDATE calls_cstm SET status_new_c ='Overdue' WHERE id_c='".$rows['acc_id']."'";
//          $res_update1 = $db->query($update_calls_query1);
        
//        }
//        }
        
//        $sql2 = 'SELECT t1.id, t2.id_c,t2.status_new_c,t2.activity_date_c FROM calls as t1 LEFT JOIN calls_cstm as t2 ON t2.id_c = t1.id WHERE deleted=0 AND t2.status_new_c="Upcoming" AND t2.activity_date_c < CURRENT_DATE AND t2.id_c NOT IN (SELECT acc_id FROM activity_approval_table)';
//        $result2 = $GLOBALS['db']->query($sql2);
//        if($result2->num_rows>0){
//        while($rows = $GLOBALS['db']->fetchByAssoc($result2) )
//        {
//            $update_calls_query2="UPDATE calls_cstm SET status_new_c ='Overdue' WHERE id_c='".$rows['id_c']."'";
//          $res_update2 = $db->query($update_calls_query2);
        
//        }
//        }
        
//        var_dump($res_update1);
//      }catch(Exception $e){
//        echo json_encode(array("status"=>false, "message" => "Some error occured"));
//      }
//      return true;
//     }




//*******************************************************Write code above**************************************************
}

