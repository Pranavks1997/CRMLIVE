<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

/**
 *
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2018 SalesAgility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for technical reasons, the Appropriate Legal Notices must
 * display the words "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 */


class DocumentsViewList extends ViewList
{
    
    public function listViewProcess()
    {
        $this->lv->quickViewLinks = false;
       $this->lv->multiSelect = false;
      echo '<script type="text/javascript" src="custom/modules/Documents/view_list.js"></script>';
        
        
        
//         global $current_user;
        
//         $login_user_id=$current_user->id;
        
//       $acc_id=array();
          
//       $assigned_user_id = array();
//       $multiple_approver_id = array();
//       $lineage = array();
//       $tagged_users=array();
//       $acc_type= array();
//       $acc_id_show=array();
//       $bid_commercial_id=array();
//       $mc_id=array();
//       $delegte_id=array();
       
       
     
//      $sql_opp="SELECT calls.id,calls.assigned_user_id,calls_cstm.activity_type_c,calls_cstm.user_id_c AS approvers,calls_cstm.tag_hidden_c AS tagged_users_id, users_cstm.user_lineage as lineage FROM calls INNER JOIN calls_cstm ON calls_cstm.id_c=calls.id LEFT JOIN users_cstm ON users_cstm.id_c = calls.assigned_user_id WHERE calls.deleted=0";
// 			$result_opp = $GLOBALS['db']->query($sql_opp);
			
// 			while($row_opp = $GLOBALS['db']->fetchByAssoc($result_opp) )
// 				{
// 				   $acc_id[]=$row_opp['id'];
// 				   $assigned_user_id[]=$row_opp['assigned_user_id'];
// 				   $multiple_approver_id[]=$row_opp['approvers'];
// 				   $lineage[]=$row_opp['lineage'];
// 				   $tagged_users[]=$row_opp['tagged_users_id'];
// 				   $acc_type[]=$row_opp['activity_type_c'];
				   
// 				}
				
// 			//	echo json_encode($tagged_users);
// 				 $sql_bid="SELECT id_c FROM `users_cstm` LEFT JOIN users ON users_cstm.id_c=users.id WHERE `bid_commercial_head_c`='commercial_team_head' OR `bid_commercial_head_c`='bid_team_head' AND users.deleted=0";
// 			$result_bid = $GLOBALS['db']->query($sql_bid);
			
// 			while($row_bid = $GLOBALS['db']->fetchByAssoc($result_bid) )
// 				{
// 				   $bid_commercial_id[]=$row_bid['id_c'];
				   
// 				}
// 				 $sql_mc="SELECT id_c FROM `users_cstm` LEFT JOIN users ON users_cstm.id_c=users.id WHERE `mc_c`='yes' AND users.deleted=0";
// 			$result_mc = $GLOBALS['db']->query($sql_mc);
			
// 			while($row_mc = $GLOBALS['db']->fetchByAssoc($result_mc) )
// 				{
// 				   $mc_id[]=$row_mc['id_c'];
				   
// 				}
				
			
				
// 				if(in_array($login_user_id,$mc_id) || $current_user->is_admin==1){
					
				
					
// 				    $acc_id_show=$acc_id;
// 				}
// 				else{
						 	
				
					
// 				    for($i=0;$i<count($acc_id);$i++){
				    	
				    
// 				        if($acc_type[$i]=='global'){
// 				            array_push($acc_id_show,$acc_id[$i]);
// 				        }
// 				        if($acc_type[$i]=='non_global'){
				        	
				        	
				        

// 				            if( in_array($login_user_id,explode(',',$tagged_users[$i])) || in_array($login_user_id,explode(',',$lineage[$i])) || in_array($login_user_id,explode(',',$multiple_approver_id[$i])) || in_array($login_user_id,explode(',',$assigned_user_id[$i]))  ) {
				            
				        
				            
// 				                 array_push($acc_id_show,$acc_id[$i]);
				                 
// 				            }
				            
				           
// 				        }
// 				    }
				    
				    
// 				}
				

        
        
        // $this->processSearchForm();
        // $this->lv->searchColumns = $this->searchForm->searchColumns;
      //  $this->params['custom_where'] = " AND calls.id  IN ('".implode("','",$acc_id_show)."') ";
        // if (!$this->headers) {
        //     return;
        // }
        // if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
        //     $this->lv->ss->assign("SEARCH", true);
        //     $this->lv->ss->assign('savedSearchData', $this->searchForm->getSavedSearchData());
        //     // add recurring_source field to filter to be able acl check to use it on row level
        //     $this->lv->mergeDisplayColumns = true;
        //     $filterFields = array('recurring_source' => 1);
        //     $this->lv->setup($this->seed, 'include/ListView/ListViewGeneric.tpl', $this->where, $this->params, 0, -1, $filterFields);
        //     $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
             
        //   // echo $this->lv->display();
            
        // }
        
        
        
          if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
            $this->lv->setup($this->seed, 'include/ListView/ListViewGeneric.tpl', $this->where, $this->params);
            $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
            echo $this->lv->display();
        }
        
    }

// public function display()
//     {
//         echo"I'm in";
//           echo '<script type="text/javascript" src="custom/modules/Documents/view_list.js"></script>';
//         parent::display();
//     }
}
