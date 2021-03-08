<?php
// if (!defined('sugarEntry') || !sugarEntry){
//     die('Not A Valid Entry Point');
// }




class cls_attachments{
	
    public function fn_attachments(&$bean, $event, $arguments){
    
    	
		foreach ($_FILES["attachments"]["error"] as $key => $error) {
		   $v=$_POST['file_for'][$key];
			if ($error == UPLOAD_ERR_OK) {
				$tmp_name = $_FILES["attachments"]["tmp_name"][$key];
				$name = $_FILES["attachments"]["name"][$key];
				$type = $_FILES["attachments"]["type"][$key];
			fn_upload_attachments($bean->id, $name, $bean->object_name, $type, $tmp_name,$v);
			}
			
	
		}
		 
		

	}
}

function fn_upload_attachments($module_id, $name, $module_name, $type, $tmp_name,$v){
	global $db;
	

	$uploads_dir = $GLOBALS['sugar_config']['upload_dir'];
	$id = create_guid();
	

	$sql = " INSERT into custom_documents(id,module_id,filename,module_name,file_mime_type,deleted,value) VALUES('{$id}','{$module_id}','{$name}','{$module_name}','{$type}','0','{$v}')";
	$db->query($sql);
	if (!file_exists("$uploads_dir/$module_name")) {
		mkdir("$uploads_dir/$module_name", 0777, true);
	}
	move_uploaded_file($tmp_name, "$uploads_dir/$module_name/$id");
}
?>