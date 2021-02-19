<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}


class OpportunitiesViewDetail extends ViewDetail
{
    public function __construct()
    {
        parent::__construct();
    }

 public function OpportunitiesViewDetail()
    {
        $deprecatedMessage = 'PHP4 Style Constructors are deprecated and will be remove in 7.8, please update your code';
        if (isset($GLOBALS['log'])) {
            $GLOBALS['log']->deprecated($deprecatedMessage);
        } else {
            trigger_error($deprecatedMessage, E_USER_DEPRECATED);
        }
        self::__construct();
    }

public function display(){
		
	 echo file_get_contents("custom/modules/Opportunities/form.html");
		if(!empty($this->bean->id)){
			$this->ss->assign('ATTACHMENTS',$this->getAttachments($this->bean->id,'Opportunity'));
		}
		$this->ss->assign('FILEUPLOAD','custom/include/tpls/detailview.tpl');
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
	
// 	$this->ss->assign('FILEUPLOAD','custom/include/tpls/detailview.tpl');
// 		parent::display();
}

 }