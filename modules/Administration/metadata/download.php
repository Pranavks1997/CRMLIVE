<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}
require_once('include/MVC/Controller/SugarController.php');

class AdministrationController extends SugarController

{
     function download_opp()
        {
            $setCounter = 0;
            $setExcelName = "OPP_Report";
            $db = \DBManagerFactory::getInstance();
                    	$GLOBALS['db'];
            $setSql = "SELECT t1.name,t2.name AS opportunity_name,CONCAT(IFNULL(t3.first_name,''), ' ', IFNULL(t3.last_name,'')) AS user,t3.user_name AS email_id,t1.status,t1.date_entered,t1.date_modified
            FROM calls as t1
            LEFT JOIN opportunities as t2 ON t1.parent_id = t2.id
            LEFT JOIN users as t3 ON t3.id = t1.created_by";
            
            $setRec = mysql_query($setSql);
            
            $setCounter = mysql_num_fields($setRec);
            
            for ($i = 0; $i < $setCounter; $i++) {
            $setMainHeader .= mysql_field_name($setRec, $i)."t";
            }
            
            while($rec = mysql_fetch_row($setRec)) {
            $rowLine = '';
            foreach($rec as $value) {
            if(!isset($value) || $value == "") {
            $value = "t";
            } else {
            //It escape all the special charactor, quotes from the data.
            $value = strip_tags(str_replace('"', '""', $value));
            $value = '"' . $value . '"' . "t";
            }
            $rowLine .= $value;
            }
            $setData .= trim($rowLine)."n";
            }
            $setData = str_replace("r", "", $setData);
            
            if ($setData == "") {
            $setData = "nno matching records foundn";
            }
            
            $setCounter = mysql_num_fields($setRec);
            
            //This Header is used to make data download instead of display the data
            header("Content-type: application/octet-stream");
            
            header("Content-Disposition: attachment; filename=".$setExcelName."_Reoprt.xls");
            
            header("Pragma: no-cache");
            header("Expires: 0");
            
            //It will print all the Table row as Excel file row with selected column name as header.
            echo ucwords($setMainHeader)."n".$setData."n";
}
}

?>