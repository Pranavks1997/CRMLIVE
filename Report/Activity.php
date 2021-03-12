<?php
$server_hostname = "localhost"; 
$database_name = "final_live2"; 
$username = "xelp";
$password = "xelp@123"; 

$link_sqli = mysqli_connect($server_hostname, $username, $password, $database_name);

if (!$link_sqli) {
   echo "Error: Unable to connect to MySQL." . PHP_EOL;
   echo "Debugging error #: " . mysqli_connect_errno() . PHP_EOL;
   echo "Error description: " . mysqli_connect_error() . PHP_EOL;
   exit;
}
$Filename = "Activity Report"; 
$Output = "";
$strSQL = "SELECT t1.name as 'Subject', CONCAT(IFNULL(t2.name,''), ' ', IFNULL(t4.name,'')) AS 'Related To',CONCAT(IFNULL(t3.first_name,''), ' ', IFNULL(t3.last_name,'')) AS 'User',t3.user_name AS 'Email Id',t1.status as 'Status',t1.date_entered as 'Date Entered',t1.date_modified as 'Date Modified', t5.type_of_interaction_c as 'Type of Interaction',t5.activity_date_c as 'Activity Date',t5.next_date_c as 'Next Activity Date',t5.name_of_person_c as 'Name of Person Contacted',t5.new_current_status_c as 'Comments',t1.description as 'Summary of Interation',t5.key_action_c as 'Key Actionable / Next Steps identified from the Interaction' FROM calls as t1 LEFT JOIN calls_cstm as t5 ON t5.id_c=t1.id LEFT JOIN opportunities as t2 ON t1.parent_id = t2.id LEFT JOIN accounts as t4 ON t1.parent_id = t4.id LEFT JOIN users as t3 ON t3.id = t1.created_by";
$sql = mysqli_query($link_sqli, $strSQL); 
if (mysqli_error($link_sqli)) { 
   echo mysqli_error($link_sqli);
} else {
  
   $columns_total = mysqli_num_fields($sql);
   
   for ($i = 0; $i < $columns_total; $i++) {
      $Heading = mysqli_fetch_field_direct($sql, $i);
      $Output .= '"' . $Heading->name . '",';
   }
   $Output .= "\n";		
   while ($row = mysqli_fetch_array($sql)) {
      for ($i = 0; $i < $columns_total; $i++) {
         $Output .= '"' . $row["$i"] . '",';
      }
      $Output .= "\n";
   }

   $TimeNow = date("YmdHis");
   $Filename .= $TimeNow . ".csv";
   header('Content-type: application/csv');
   header('Content-Disposition: attachment; filename=' . $Filename);
   echo $Output;
}
exit;
?>