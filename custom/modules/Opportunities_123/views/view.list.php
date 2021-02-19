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
       
      
     $sql="SELECT * FROM untagged_user where ( user_id like '%".$login_user_id."%') ";
			$result = $GLOBALS['db']->query($sql);
			
			while($row = $GLOBALS['db']->fetchByAssoc($result) )
				{
				   $opp_id[]=$row['opp_id'];
				    
				}
				
				
				
	//echo json_encode($opp_id);
		
        $this->processSearchForm();
        
                             
            
                 $this->params['custom_where'] = " AND opportunities.id NOT IN ('".implode("','",$opp_id)."') ";
                 
        
            
      
        if (empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false) {
            $this->lv->setup($this->seed, 'include/ListView/ListViewGeneric.tpl', $this->where, $this->params);
            $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
            echo $this->lv->display();
        }
    }
    
   

} 