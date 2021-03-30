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
    
}
