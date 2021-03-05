<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}
if($_GET['action_type'] == 'download'){

	$data = array_shift($_POST);
	$array = explode(",",$data); 
	$id_trim = trim($array[0], '{}');
	$module_trim = trim($array[2], '{}');
	$folder_trim = trim($array[3], '{}');
	$id = substr($id_trim, 21, -6);
	$module_name = substr($module_trim, 25, -6);
	$folder = substr($folder_trim, 25, -6);
	
	global $db;
	$db = \DBManagerFactory::getInstance();
	if(!empty($data)){
		$query = "SELECT filename,file_mime_type FROM custom_documents WHERE id= '$id' and module_name = '$module_name' and deleted=0";
		$result = $db->query($query);
		$row = $db->fetchByAssoc($result);
		$mime_type = $row['file_mime_type'];
		$filename = $row['filename'];
		$file = 'upload/'.$folder.'/'.$id;
		ob_end_clean();
		header("Content-Description: File Transfer");
		header("Content-Type: $mime_type");
		header('Content-Disposition: attachment; filename="'.basename($filename).'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' .filesize($file));
		readfile($file);
	}
}

if($_POST['action_type'] == 'remove'){
	global $db;
	$id = trim($_POST['id']);
	if(!empty($id)){
		$remove_attachments = "update custom_documents set deleted=1 where id ='$id'";
		$result_remove_attachments = $db->query($remove_attachments);
		//unlink('upload/'.$_POST['folder'].'/'.$id);
		$data = array();
		$data['flag'] = true;
		$data['attachment_id'] = $id;
		echo json_encode($data);
	}
	else{
		$data = array();
		$data['flag'] = false;
		echo json_encode($data);
	}
}