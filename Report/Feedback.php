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
$Filename = "Feedback Report"; 
$Output = "";
$strSQL = "SELECT CONCAT(first_name,' ',last_name) as 'User Name',`issue` as 'Issue',`link` as 'URL(Link)',`date` as 'Date Entered',`email` as 'Email id' FROM `feedback`";
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