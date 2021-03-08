<?php

if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require SUGAR_PATH . '/include/MVC/Controller/entry_point_registry.php';
$entry_point_registry['multiple_file']=array('file' => 'custom/modules/Opportunities/custom_file.php', 'auth' => true);

?>