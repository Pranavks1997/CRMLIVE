<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once('include/MVC/Controller/SugarController.php');
require_once('include/SugarPHPMailer.php');
include_once('include/utils/db_utils.php');

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
//-------------------------------Fetch Reporting manager--------------END--------------------------------

//---------------------------------Editview tagged users ------------------------------------------------

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

//------------------------------------------Category and Sub-category---------------------------------------

    public function action_category() 
     {
         
     
     try{
         $db = \DBManagerFactory::getInstance();
          $GLOBALS['db'];
          
          $sql='SELECT * FROM documents_category';
        
        $result = $GLOBALS['db']->query($sql);
        
        $category_list = array();
       
      while ($row = mysqli_fetch_assoc($result)) {
      
      $category_list[]=$row;
       
    }
   echo json_encode($category_list);
        
      
     }catch(Exception $e){
        echo json_encode(array("status"=>false, "message" => "Some error occured"));
      }
    die();
  }
   
    public function action_subCategory() 
     {
         
        if(isset($_POST['category_name']))
            {
                $category = $_POST['category_name'];
               
            }

         try{
        $db = \DBManagerFactory::getInstance();
          $GLOBALS['db'];
          
          $sql='SELECT document_sub_category.name,document_sub_category.category_id FROM  document_sub_category INNER JOIN documents_category ON document_sub_category.category_id=documents_category.id WHERE documents_category.name="'.$category.'"';
        
        $result = $GLOBALS['db']->query($sql);
        
        $subCategory_list = array();
        $status = array(status=>true);
       
      while ($row = mysqli_fetch_assoc($result)) {
     
       $subCategory_list[]=$row;
       
    }
   echo json_encode( $subCategory_list);
      
         }catch(Exception $e){
        echo json_encode(array("status"=>false, "message" => "Some error occured"));
      }
    die();
        
  }

//------------------------------------------Category and Sub-category----------END-----------------------------


//------------------------------Send Approval----------------------------------------
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
      $doc_id = $_POST['doc_id'];
      $doc_type = $_POST['doc_type'];
                  
      /*if($status == "Upcoming"){
         $status = 'Apply For Completed';
      }*/
      $status = "Pending Approval";
                  
      $sql_approval_status = "SELECT * FROM document_approval_table WHERE id=(SELECT MAX(id) FROM document_approval_table WHERE doc_id ='".$doc_id."' ) ";
        
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
        $sql_insert_activity = "INSERT INTO `document_approval_table`( `doc_id`, `doc_type`, `status`, `sender`, `sent_time`, `approval_status`,`approver`) VALUES ('".$doc_id."','".$doc_type."','".$status."','".$sender."','".$date."','0','".$approver."')";
      if($GLOBALS['db']->query($sql_insert_activity)==TRUE){
        $update_documents_cstm = "UPDATE `documents_cstm` SET `status_c`='".$status."' WHERE `id_c`='".$doc_id."'";
        $GLOBALS['db']->query($update_documents_cstm);
                  
      }
    }
    else{
      $sql_max_id = "SELECT MAX(id) as id FROM document_approval_table";

      $result_max_id = $GLOBALS['db']->query($sql_max_id);

      while ($row = $GLOBALS['db']->fetchByAssoc($result_max_id)) {
        $id = ++$row['id'];
      }
      $sql_insert_activity = "INSERT INTO `document_approval_table`(`id`, `doc_id`, `doc_type`, `status`, `sender`, `sent_time`, `approval_status`,`approver`) VALUES ('".$id."', '".$doc_id."','".$doc_type."','".$status."','".$sender."','".$date."','0','".$approver."')";

      $update_documents_cstm = "UPDATE `documents_cstm` SET `status_c`='".$status."' WHERE `id_c`='".$doc_id."'";

            // die($update_documents_cstm);

      $GLOBALS['db']->query($sql_insert_activity);
      $GLOBALS['db']->query($update_documents_cstm);
    }

    // Get Document Details
    $sql = "SELECT * FROM `documents` WHERE `id`='".$doc_id."';";
    $result = $GLOBALS['db']->query($sql);

    while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
      $assigned_to = $row['assigned_user_id'];
      $document_name = $row['document_name']; 
      $document_id = $row['id'];
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
    
    $alert->description = 'Document "'.$document_name.'" created by "'.$current_user->first_name.' '.$current_user->last_name.'" is pending for your approval.';

    $alert->url_redirect = $base_url.'index.php?action=DetailView&module=Documents&record='.$document_id;
    $alert->target_module = 'Documents';
    $alert->assigned_user_id = $approver_id;
    $alert->type = 'info';
    $alert->is_read = 0;
    $alert->save();

    // Send email to approver
    $template = 'Document "'.$document_name.'" created by "'.$current_user->first_name.' '.$current_user->last_name.'" is pending for your approval.';

    $emailObj = new Email();  
    $defaults = $emailObj->getSystemDefaultEmail();

    $mail = new SugarPHPMailer();  
    $mail->setMailerForSystem();  
    $mail->From = $defaults['email'];  
    $mail->FromName = $defaults['name'];  
    $mail->Subject = 'CRM ALERT - Approval Request';
    $mail->Body =$template;
    $mail->IsHTML(true); 
    $mail->prepForOutbound();  
    $mail->AddAddress($approver_email);
    @$mail->Send(); 

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
//------------------------------Send Approval------------------END-------------------


//-----------------------------Approve----------------------------------------------
public function action_approve(){
  try{
    $db = \DBManagerFactory::getInstance();
    $GLOBALS['db'];
        
    global $current_user; 
    $log_in_user_id = $current_user->id;
            
    $sender = $_POST['assigned_id'];
    $date = $_POST['date'];
    $approver = $_POST['approver_id'];
    $doc_id = $_POST['doc_id'];
    $comments=$_POST['comments'];
    $status='Approved';

    $sql_delegate="SELECT * FROM `documents_cstm` WHERE `id_c`='".$doc_id."';";
    $result_delegate = $GLOBALS['db']->query($sql_delegate);
        
    while($row_delegate = $GLOBALS['db']->fetchByAssoc($result_delegate)){
      $delegate_id=$row_delegate['delegate_id'];            
    }

    if($log_in_user_id==$delegate_id){
      $update_query="UPDATE `document_approval_table` SET `approval_status`='1',delegate_approve_reject_date='".date('Y-m-d H:i:s')."',`delegate_comment`='".$comments."',delegate_id='".$log_in_user_id."' WHERE doc_id ='".$doc_id."' AND `sender`='".$sender."'  AND approval_status='0'";

      $update_documents_cstm = "UPDATE `documents_cstm` SET `status_c`='".$status."' WHERE `id_c`='".$doc_id."'";

      $GLOBALS['db']->query($update_query);
      $GLOBALS['db']->query($update_documents_cstm);
    }
    else{
      $update_query="UPDATE `document_approval_table` SET `approval_status`='1',`approve_reject_date`='".date('Y-m-d H:i:s')."',`approver_comment`='".$comments."' WHERE doc_id ='".$doc_id."' AND `sender`='".$sender."' AND`approver`='".$approver."' AND approval_status='0'";

      $update_documents_cstm = "UPDATE `documents_cstm` SET `status_c`='".$status."' WHERE `id_c`='".$doc_id."'";

      $GLOBALS['db']->query($update_query);
      $GLOBALS['db']->query($update_documents_cstm);
    }

    // Get assigned to user id
    $sql = "SELECT * FROM `documents` WHERE `id`='".$doc_id."';";
    $result = $GLOBALS['db']->query($sql);

    while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
      $assigned_to = $row['assigned_user_id'];
      $document_name = $row['document_name']; 
      $document_id = $row['id'];
    }

    // Get assigned user name
    $sql = "SELECT * FROM `users` WHERE `id`='".$assigned_to."';";
    $result = $GLOBALS['db']->query($sql);

    while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
      $assigned_to_name = $row['first_name'].' '.$row['last_name'];
      $assigned_to_email = $row['user_name'];
    }

    // Get Tagged Users
    $sql = "SELECT * FROM `documents_cstm` WHERE id_c='".$doc_id."'";
    $result = $GLOBALS['db']->query($sql);
    
    while($row = $GLOBALS['db']->fetchByAssoc($result)){
      $tagged_ids = $row['tagged_hidden_c'];
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
      
      // $alert->description = 'Document "'.$document_name.'" assigned to "'.$assigned_to_name.'" has been Approved by "'.$current_user->first_name.' '.$current_user->last_name.'"';

      $alert->description = 'Document "'.$document_name.'" is approved by "'.$current_user->first_name.' '.$current_user->last_name.'"';

      $alert->url_redirect = 'index.php?action=DetailView&module=Documents&record='.$document_id;
      $alert->target_module = 'Documents';
      $alert->assigned_user_id = $assigned_to;
      $alert->type = 'info';
      $alert->is_read = 0;
      $alert->save();

      // Send email to assigned user
      $template = 'Document "'.$document_name.'" is approved by "'.$current_user->first_name.' '.$current_user->last_name.'"';

      $emailObj = new Email();  
      $defaults = $emailObj->getSystemDefaultEmail();  
      $mail = new SugarPHPMailer();  
      $mail->setMailerForSystem();  
      $mail->From = $defaults['email'];  
      $mail->FromName = $defaults['name'];  
      $mail->Subject = 'CRM ALERT - Approved';
      $mail->Body =$template;
      $mail->prepForOutbound();  
      $mail->AddAddress($assigned_to_email);
      @$mail->Send();


      // Send Notifications and email to tagged users
      foreach ($tagged_users as $key => $user) {
        // Send Notification to tagged user
        $alert = BeanFactory::newBean('Alerts');
        $alert->name = '';
        
        $alert->description = 'Document "'.$document_name.'" assigned to "'.$assigned_to_name.'" has been approved by "'.$current_user->first_name.' '.$current_user->last_name.'"';

        $alert->url_redirect = 'index.php?action=DetailView&module=Documents&record='.$document_id;
        $alert->target_module = 'Documents';
        $alert->assigned_user_id = $user['id'];
        $alert->type = 'info';
        $alert->is_read = 0;
        $alert->save();

        // Send Email to tagged user
        $template = 'Document "'.$document_name.'" assigned to "'.$assigned_to_name.'" has been approved by "'.$current_user->first_name.' '.$current_user->last_name.'"';

        $emailObj = new Email();  
        $defaults = $emailObj->getSystemDefaultEmail();

        $mail = new SugarPHPMailer();  
        $mail->setMailerForSystem();  
        $mail->From = $defaults['email'];  
        $mail->FromName = $defaults['name'];  
        $mail->Subject = 'CRM ALERT - Approved';
        $mail->Body =$template;
        $mail->IsHTML(true); 
        $mail->prepForOutbound();  
        $mail->AddAddress($user['user_name']);
        @$mail->Send();

      }

      echo json_encode([
        'button'=>'hide', 
        'message' => 'Document "'.$document_name.'" approved successfully.'
      ]);
    } 

              
       
          
  }catch(Exception $e){
    echo json_encode(array("status"=>false, "message" => "Some error occured"));
  }
  die();
}
//-----------------------------Approve-------------------------END------------------

//----------------------------Reject------------------------------------------------
public function action_reject(){
  try{
    $db = \DBManagerFactory::getInstance();
    $GLOBALS['db'];
        
    global $current_user; 
    $log_in_user_id = $current_user->id;
            
    $sender = $_POST['assigned_id'];
    $date = $_POST['date'];
    $approver = $_POST['approver_id'];
    $doc_id = $_POST['doc_id'];
    $comments=$_POST['comment_reject'];

    $status = 'Pending Approval';
             
    // echo $sender.'--/--'.$approver.'--/--'.$comments.'--/--'.$doc_id;

    $sql_delegate="SELECT * FROM `documents_cstm` WHERE `id_c`='".$doc_id."';";
    $result_delegate = $GLOBALS['db']->query($sql_delegate);
      
    while($row_delegate = $GLOBALS['db']->fetchByAssoc($result_delegate)) {
      $delegate_id=$row_delegate['delegate_id'];
    }
    if($log_in_user_id==$delegate_id){
      $update_query="UPDATE `document_approval_table` SET `approval_status`='2',delegate_approve_reject_date='".date('Y-m-d H:i:s')."',`delegate_comment`='".$comments."',delegate_id='".$log_in_user_id."' WHERE doc_id ='".$doc_id."' AND `sender`='".$sender."'  AND approval_status='0'";

      $update_documents_cstm = "UPDATE `documents_cstm` SET `status_c`='".$status."' WHERE `id_c`='".$doc_id."'";

      $GLOBALS['db']->query($update_query);
      $GLOBALS['db']->query($update_documents_cstm);
    }
    else{
      $update_query="UPDATE `document_approval_table` SET `approval_status`='2',`approve_reject_date`='".date('Y-m-d H:i:s')."',`approver_comment`='".$comments."' WHERE doc_id ='".$doc_id."' AND `sender`='".$sender."' AND`approver`='".$approver."' AND approval_status='0'";

      $update_documents_cstm = "UPDATE `documents_cstm` SET `status_c`='".$status."' WHERE `id_c`='".$doc_id."'";
      
      $GLOBALS['db']->query($update_query); 
      $GLOBALS['db']->query($update_documents_cstm);
    }

    // Get assigned to user id
    $sql = "SELECT * FROM `documents` WHERE `id`='".$doc_id."';";
    $result = $GLOBALS['db']->query($sql);

    while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
      $assigned_to = $row['assigned_user_id'];
      $document_name = $row['document_name']; 
      $document_id = $row['id'];
    }

    // Get assigned user name
    $sql = "SELECT * FROM `users` WHERE `id`='".$assigned_to."';";
    $result = $GLOBALS['db']->query($sql);

    while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
      $assigned_to_name = $row['first_name'].' '.$row['last_name'];
      $assigned_to_email = $row['user_name'];
    }

    $sql = "SELECT * FROM `documents_cstm` WHERE id_c='".$doc_id."'";
    $result = $GLOBALS['db']->query($sql);
    
    while($row = $GLOBALS['db']->fetchByAssoc($result)){
      $tagged_ids = $row['tagged_hidden_c'];
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
      
      // $alert->description = 'Document "'.$document_name.'" assigned to "'.$assigned_to_name.'" has been Rejected by "'.$current_user->first_name.' '.$current_user->last_name.'"';

      $alert->description = 'Document "'.$document_name.'" is rejected by "'.$current_user->first_name.' '.$current_user->last_name.'"';

      $alert->url_redirect = 'index.php?action=DetailView&module=Documents&record='.$document_id;
      $alert->target_module = 'Documents';
      $alert->assigned_user_id = $assigned_to;
      $alert->type = 'info';
      $alert->is_read = 0;
      $alert->save();

      // Send email to assigned user
      $template = 'Document "'.$document_name.'" is rejected by "'.$current_user->first_name.' '.$current_user->last_name.'"';

      $emailObj = new Email();  
      $defaults = $emailObj->getSystemDefaultEmail();  
      $mail = new SugarPHPMailer();  
      $mail->setMailerForSystem();  
      $mail->From = $defaults['email'];  
      $mail->FromName = $defaults['name'];  
      $mail->Subject = 'CRM ALERT - Rejected';
      $mail->Body =$template;
      $mail->prepForOutbound();  
      $mail->AddAddress($assigned_to_email);
      @$mail->Send();

      // Send Notifications and email to tagged users
      foreach ($tagged_users as $key => $user) {
        // Send Notification to tagged user
        $alert = BeanFactory::newBean('Alerts');
        $alert->name = '';
        
        $alert->description = 'Document "'.$document_name.'" assigned to "'.$assigned_to_name.'" has been rejected by "'.$current_user->first_name.' '.$current_user->last_name.'"';

        $alert->url_redirect = 'index.php?action=DetailView&module=Documents&record='.$document_id;
        $alert->target_module = 'Documents';
        $alert->assigned_user_id = $user['id'];
        $alert->type = 'info';
        $alert->is_read = 0;
        $alert->save();

        // Send Email to tagged user
        $template = 'Document - "'.$document_name.'" has been rejected by "'.$current_user->first_name.' '.$current_user->last_name.'"';

        $emailObj = new Email();  
        $defaults = $emailObj->getSystemDefaultEmail();

        $mail = new SugarPHPMailer();  
        $mail->setMailerForSystem();  
        $mail->From = $defaults['email'];  
        $mail->FromName = $defaults['name'];  
        $mail->Subject = 'CRM ALERT - Rejected';
        $mail->Body =$template;
        $mail->IsHTML(true); 
        $mail->prepForOutbound();  
        $mail->AddAddress($user['user_name']);
        @$mail->Send();

      }


      echo json_encode([
        'button'=>'hide', 
        'message' => 'Document "'.$document_name.'" rejected successfully.'
      ]);   
    }   
  }
  catch(Exception $e){
    echo json_encode(array("status"=>false, "message" => "Some error occured"));
  }
  die();
}
//----------------------------Reject---------------------------END------------------

//-----------------------Approval Buttons----------------------------------------------------------------------
public function action_approval_buttons(){
    try{
        $db = \DBManagerFactory::getInstance();
        $GLOBALS['db'];
            
        global $current_user; 
        $log_in_user_id = $current_user->id;

    $assigned_id = $_POST['assigned_id'];
    $doc_id = $_POST['doc_id'];
    $approver_id=$_POST['approver_id'];
    $status=$_POST['status'];

    $sql_delegate="SELECT * FROM `documents_cstm` WHERE `id_c`='".$doc_id."';";
    $result_delegate = $GLOBALS['db']->query($sql_delegate);
    while($row_delegate = $GLOBALS['db']->fetchByAssoc($result_delegate)){
      $delegate_id=$row_delegate['delegate_id'];            
    }

        $sql_logged_user = "SELECT users.id, users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '".$log_in_user_id."' AND users.deleted = 0";
        
        $result_logged_user = $GLOBALS['db']->query($sql_logged_user);
        
        while($row_logged_user = $GLOBALS['db']->fetchByAssoc($result_logged_user)) {
            $check_sales = $row_logged_user['teamfunction_c'];
            $check_mc = $row_logged_user['mc_c'];
            $check_team_lead = $row_logged_user['teamheirarchy_c'];
        }

      $sql_assigned_user = "SELECT users.id, users_cstm.teamfunction_c, users_cstm.mc_c, users_cstm.teamheirarchy_c,users.reports_to_id,users_cstm.user_lineage FROM users INNER JOIN users_cstm ON users.id = users_cstm.id_c WHERE users_cstm.id_c = '".$assigned_id."' AND users.deleted = 0";
        
        $result_assigned_user = $GLOBALS['db']->query($sql_assigned_user);

        while($row_assigned_user = $GLOBALS['db']->fetchByAssoc($result_assigned_user)){
           $reports_to=$row_assigned_user['reports_to_id'];
           $lineage=$row_assigned_user['user_lineage'];    
        }

        $lineage_array=explode(',',$lineage);
                  
    $sql_approval_status = "SELECT * FROM document_approval_table WHERE id=(SELECT MAX(id) FROM document_approval_table WHERE doc_id ='".$doc_id."' ) ";
        
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
          if($log_in_user_id==$assigned_id && $log_in_user_id==$approver_id){    
                echo json_encode(array("message"=>"show_completed"));
            }
            else if($log_in_user_id==$assigned_id){
              echo json_encode(array("message"=>"show_send_approval"));
            }
            else{
                echo json_encode(array("message"=>"no" )); 
            }

            /*if($status=='Upcoming'){

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
            }*/
        }         
  }catch(Exception $e){
      echo json_encode(array("status"=>false, "message" => "Some error occured"));
    }
  die();
}
//-----------------------Approval Buttons----------END------------------------------------------------------------

//---------------------- edit View access-------------------------------------------------------------------
public function action_editView_access(){
    try{
         $db = \DBManagerFactory::getInstance();
          $GLOBALS['db'];
          
              global $current_user; 
              $log_in_user_id = $current_user->id;
              $doc_id =$_POST['doc_id'];
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




//--------------------------------Assigned user list according to login user-------------------


           
            // public function action_new_assigned_list(){
//      try{
//          $db = \DBManagerFactory::getInstance();
//          $GLOBALS['db'];
            
//             global $current_user; 
             
//            $acc_id=$_POST['acc_id'];
//             $combined=array();
//            $id_array1=array();
//            $id_array=array();
//            $name_array=array();
//            $func_array=array();
//           $func1_array=array();
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
//        $log_in_user_id = $current_user->id;
        
        
        
//         $sql7="SELECT CONCAT(IFNULL(users.first_name,''), ' ', IFNULL(users.last_name,'')) AS name FROM users WHERE id='".$log_in_user_id."'";
//          $result7 = $GLOBALS['db']->query($sql7);
//         while($row7 = $GLOBALS['db']->fetchByAssoc($result7)) 
//         {
//             $mc_name=$row7['name'];  
             
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
//        echo json_encode(array("status"=>false, "message" => "Some error occured"));
//      }
//    die();
// }



//--------------------------------Assigned user list according to login user-------END------------


//-------------------------------------fetch assigned id---------------------------------------

        // public function action_fetch_assigned_id(){
//      try{
//          $db = \DBManagerFactory::getInstance();
//          $GLOBALS['db'];
            
//             global $current_user; 
//              $log_in_user_id = $current_user->id;
//              $assigned_name=$_POST['f'];
//              $f_name=$_POST['f_name'];
//              $l_name=$_POST['l_name'];
              
             
//               $sql="SELECT id  FROM users WHERE CONCAT(first_name, ' ', last_name) ='".$assigned_name."' ";
              
//               $result = $GLOBALS['db']->query($sql);
               
//         while($row = $GLOBALS['db']->fetchByAssoc($result)) 
//         {
            
           
            
            
//           $a_id=$row['id'];
           
           
    
            
//         }
        
        
        
//         echo $a_id;
//      }catch(Exception $e){
//        echo json_encode(array("status"=>false, "message" => "Some error occured"));
//      }
//    die();
// }


//---------------------------------------fetch assigned id------END---------------------------------





//*******************************************************Write code above**************************************************
}

