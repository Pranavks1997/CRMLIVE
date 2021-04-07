<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

class DocumentsViewDetail extends ViewDetail
{
    /**
     * @see SugarView::_getModuleTitleParams()
     */
    protected function _getModuleTitleParams($browserTitle = false)
    {
        $params = array();
        $params[] = $this->_getModuleTitleListParam($browserTitle);
        $params[] = $this->bean->document_name;
        
        return $params;
    }

    public function display()
    {

        global $current_user;
        $log_in_user_id = $current_user->id;

        // If current record is not allowed to access
        if(!$this->isAllowed($_REQUEST['record'])){
            SugarApplication::redirect('index.php');
        }

        // Check if logged in user is admin or not sales person
        if($current_user->is_admin || !$this->isSalesPerson()){
            echo "<script>
                $('#opp_hide').hide()
            </script>";
        } 

        if(isset($_SESSION['flash'][$log_in_user_id])){
            echo '<script>
                alert(\''.$_SESSION['flash'][$log_in_user_id]['message'].'\')
            </script>';

            unset($_SESSION['flash'][$log_in_user_id]);
        }

        echo '<script type="text/javascript" src="custom/modules/Documents/view_detail.js"></script>';
        //check to see if the file field is empty.  This should not occur and would only happen when an error has ocurred during upload, or from db manipulation of record.
        if (empty($this->bean->filename)) {
            //print error to screen
            $this->errors[] = $GLOBALS['mod_strings']['ERR_MISSING_FILE'];
            $this->displayErrors();
        }
        if(!empty($this->bean->id)){
            $this->ss->assign('ATTACHMENTS',$this->getAttachments($this->bean->id,'Document'));
        $this->ss->assign('FILEUPLOAD','custom/include/tpls/detailview1.tpl');
    
        }
        parent::display();
    }
    function getAttachments($module_id,$module_name){
        global $db;
        if(isset($module_id)){
            $sql = 'SELECT id,filename,value FROM custom_documents WHERE module_name = "'.$module_name.'" AND module_id = "'.$module_id.'" AND deleted = 0';
            $res = $GLOBALS['db']->query($sql);
            $attachments = array();
            while($row = $db->fetchByAssoc($res)){
                $attachments[] = $row;
            }
            return $attachments;
        }
    
        //  $this->ss->assign('FILEUPLOAD','custom/include/tpls/detailview.tpl');
        //      parent::display();
    }

    // Function to check if logged in user is salesperson or not
    private function isSalesPerson(){
        global $current_user;
        return (bool)in_array('^sales^', explode(',', $current_user->teamfunction_c));
    }

    // Function to check if record is accessible or not
    private function isAllowed($record){
        global $current_user;
        $login_user_id=$current_user->id;

        $doc_id=array();
        
        $assigned_user_id = array();
        $multiple_approver_id = array();
        $lineage = array();
        $tagged_users=array();
        $doc_type= array();
        $doc_id_show=array();
        $bid_commercial_id=array();
        $mc_id=array();
        $delegte_id=array();

        $sql_opp="SELECT
                  d.id,
                  d.assigned_user_id,
                  dc.document_visibility_c,
                  dc.user_id_c AS approvers,
                  dc.tagged_hidden_c AS tagged_users_id,
                  dc.delegate_id AS delegate_id,
                  d.doc_type,
                  uc.user_lineage AS lineage
                FROM
                  documents as d
                INNER JOIN documents_cstm as dc ON
                  dc.id_c = d.id
                LEFT JOIN documents_cstm as dc2 ON
                  dc2.id_c = d.assigned_user_id
                LEFT JOIN users_cstm as uc ON
                  d.assigned_user_id = uc.id_c 
                WHERE
                  d.deleted = 0";
      
        $result_opp = $GLOBALS['db']->query($sql_opp);

        while($row_opp = $GLOBALS['db']->fetchByAssoc($result_opp) ){
            $doc_id[]=$row_opp['id'];
            $assigned_user_id[]=$row_opp['assigned_user_id'];
            $multiple_approver_id[]=$row_opp['approvers'];
            $lineage[]=$row_opp['lineage'];
            $tagged_users[]=$row_opp['tagged_users_id'];
            // $doc_type[]=$row_opp['doc_type'];
            $doc_type[]=$row_opp['document_visibility_c'];
            $delegte_id[]=$row_opp['delegate_id'];
        }

        $sql_bid="SELECT 
                  id_c 
                FROM 
                  `users_cstm` 
                LEFT JOIN `users` ON 
                  `users_cstm`.`id_c`=`users`.`id` 
                WHERE 
                  `bid_commercial_head_c`='commercial_team_head' 
                OR 
                  `bid_commercial_head_c`='bid_team_head' 
                AND 
                  `users`.`deleted`=0";

        $result_bid = $GLOBALS['db']->query($sql_bid);

        while($row_bid = $GLOBALS['db']->fetchByAssoc($result_bid) ){
            $bid_commercial_id[]=$row_bid['id_c'];
        }

        $sql_mc=" SELECT 
                  id_c 
                FROM 
                  `users_cstm` 
                LEFT JOIN users ON 
                  `users_cstm`.`id_c`=`users`.`id` 
                WHERE 
                  `mc_c`='yes' 
                AND 
                  `users`.`deleted`=0";

        $result_mc = $GLOBALS['db']->query($sql_mc);

        while($row_mc = $GLOBALS['db']->fetchByAssoc($result_mc) ){
            $mc_id[]=$row_mc['id_c'];
        }

        if(in_array($login_user_id,$mc_id) || $current_user->is_admin==1){
            $doc_id_show = $doc_id;
        }
        else{
            for($i=0; $i < count($doc_id); $i++){
                if($doc_type[$i]=='global'){
                    array_push($doc_id_show, $doc_id[$i]);
                }

                if($doc_type[$i]=='non_global'){
                    if( in_array($login_user_id,explode(',',$tagged_users[$i])) || 
                        in_array($login_user_id,explode(',',$lineage[$i])) || 
                        in_array($login_user_id,explode(',',$multiple_approver_id[$i])) ||
                        in_array($login_user_id,explode(',',$assigned_user_id[$i])) || 
                        $login_user_id== $delegte_id[$i] ) {

                        array_push($doc_id_show, $doc_id[$i]);
                    }
                }
            }
        }

        return (bool)in_array($record, $doc_id_show);
    }
    
}
