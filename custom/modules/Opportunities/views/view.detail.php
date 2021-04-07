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
		
		echo file_get_contents("custom/modules/Calls/other_multi_select_user/m-select.html");
		echo '<link rel="stylesheet" type="text/css" href="custom/modules/Calls/quick_create_custom.css">';
		echo file_get_contents("custom/modules/Opportunities/form.html");
	 
		global $current_user;
    	$log_in_user_id = $current_user->id;

    	if(isset($_SESSION['flash'][$log_in_user_id])){
    		echo '<script>
    			alert(\''.$_SESSION['flash'][$log_in_user_id]['message'].'\')
    		</script>';

    		unset($_SESSION['flash'][$log_in_user_id]);
    	}

    	// Check if logged in user is admin or not sales person
        if($current_user->is_admin || !$this->isSalesPerson()){
        	echo "<script>
        		$('#toolbar').find('li.topnav:eq(0) ul li ul li:eq(0)').hide()
        	</script>";
        } 
	 
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

	// Function to check if logged in user is salesperson or not
    private function isSalesPerson(){
        global $current_user;
        return (bool)in_array('^sales^', explode(',', $current_user->teamfunction_c));
    } 

 }