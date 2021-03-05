<?php

require_once('include/MVC/View/views/view.list.php');


class OpportunitiesViewList extends ViewList {
    
   
     public function preDisplay()
    {
        parent::preDisplay();

        $this->lv->quickViewLinks = false;
        // $this->lv->multiSelect = false;
    }
    

    function listViewProcess() {
        
        echo '<link rel="stylesheet" href="custom/modules/Opportunities/table.css" type="text/css">';
         echo '<script src="custom/modules/Opportunities/list_view.js"></script>';
         
        global $current_user;
        
        $login_user_id=$current_user->id;
        
       $opp_id=array();
       $assigned_user_id = array();
       $multiple_approver_id = array();
       $lineage = array();
       $tagged_users=array();
       $opp_type= array();
       //$opp_id_show=array('c82c632a-8fe4-d6a2-c9d1-603602f103fa');
        $opp_id_show=array();
       $bid_commercial_id=array();
       $mc_id=array();
       $delegte_id=array();
       
       
     
     $sql_opp="SELECT opportunities.id,opportunities.assigned_user_id,opportunities.opportunity_type,opportunities_cstm.multiple_approver_c AS approvers,opportunities_cstm.delegate,tagged_user.user_id AS tagged_users_id, users_cstm.user_lineage as lineage FROM opportunities INNER JOIN opportunities_cstm ON opportunities_cstm.id_c=opportunities.id LEFT JOIN tagged_user ON tagged_user.opp_id = opportunities.id LEFT JOIN users_cstm ON users_cstm.id_c = opportunities.assigned_user_id WHERE opportunities.deleted=0";
			$result_opp = $GLOBALS['db']->query($sql_opp);
			
			while($row_opp = $GLOBALS['db']->fetchByAssoc($result_opp) )
				{
				   $opp_id[]=$row_opp['id'];
				   $assigned_user_id[]=$row_opp['assigned_user_id'];
				   $multiple_approver_id[]=$row_opp['approvers'];
				   $lineage[]=$row_opp['lineage'];
				   $tagged_users[]=$row_opp['tagged_users_id'];
				   $opp_type[]=$row_opp['opportunity_type'];
				   $delegte_id[]=$row_opp['delegate'];
				}
				
				//echo json_encode($delegte_id);
				 $sql_bid="SELECT id_c FROM `users_cstm` LEFT JOIN users ON users_cstm.id_c=users.id WHERE `bid_commercial_head_c`='commercial_team_head' OR `bid_commercial_head_c`='bid_team_head' AND users.deleted=0";
			$result_bid = $GLOBALS['db']->query($sql_bid);
			
			while($row_bid = $GLOBALS['db']->fetchByAssoc($result_bid) )
				{
				   $bid_commercial_id[]=$row_bid['id_c'];
				   
				}
				 $sql_mc="SELECT id_c FROM `users_cstm` LEFT JOIN users ON users_cstm.id_c=users.id WHERE `mc_c`='yes' AND users.deleted=0";
			$result_mc = $GLOBALS['db']->query($sql_mc);
			
			while($row_mc = $GLOBALS['db']->fetchByAssoc($result_mc) )
				{
				   $mc_id[]=$row_mc['id_c'];
				   
				}
				
			
				
				if(in_array($login_user_id,$mc_id) || $current_user->is_admin==1){
					
				
					
				    $opp_id_show=$opp_id;
				}
				else{
						 	
				
					
				    for($i=0;$i<count($opp_id);$i++){
				    	
				    
				        if($opp_type[$i]=='global'){
				            array_push($opp_id_show,$opp_id[$i]);
				        }
				        if($opp_type[$i]=='non_global'){
				        	
				        	
				        

				            if( in_array($login_user_id,explode(',',$tagged_users[$i])) || in_array($login_user_id,explode(',',$lineage[$i])) || in_array($login_user_id,explode(',',$multiple_approver_id[$i])) || in_array($login_user_id,explode(',',$assigned_user_id[$i]))|| in_array($login_user_id,explode(',',$delegte_id[$i]))  ) {
				            
				        
				            
				                 array_push($opp_id_show,$opp_id[$i]);
				                 
				            }
				            
				           
				        }
				    }
				    
				    
				}
				
				
		
        $this->processSearchForm();
        
                             
            
                 $this->params['custom_where'] = " AND opportunities.id  IN ('".implode("','",$opp_id_show)."') ";
                 
              
                 
        
            
      
        if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
            $this->lv->setup($this->seed, 'include/ListView/ListViewGeneric.tpl', $this->where, $this->params);
            $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
            echo $this->lv->display();
        }
    }
    
   

} 