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
$Filename = "Opportunity Report"; 
$Output = "";
$strSQL = "SELECT t1.name,t1.date_entered as 'Date Entered',t1.date_modified as 'Date Modified',t2.new_department_c as 'Department',CONCAT(IFNULL(t6.first_name,''), ' ', IFNULL(t6.last_name,'')) AS 'Created By',CONCAT(IFNULL(t5.first_name,''), ' ', IFNULL(t5.last_name,'')) AS 'Reporting Manager', 
case when t1.opportunity_type='global' then 'Global'
when t1.opportunity_type='non_global' then 'Non Global'
           end as 'Opportunity Type',
           
case when t2.rfporeoipublished_c='no' then 'No'
when t2.rfporeoipublished_c='yes' then 'Yes'
when t2.rfporeoipublished_c='not_required' then 'Not Required'
           end as 'RFP EOI Published',
           
case when t2.status_c='Qualified' then 'Qualified Opportunity'
when t2.status_c='QualifiedLead' then 'Qualified Lead' 
when t2.status_c='Lead' then 'Lead'
when t2.status_c='QualifiedDpr' then 'Qualified DPR'
when t2.status_c='QualifiedBid' then 'Qualified BID'
when t2.status_c='Closed' then 'Closed'
when t2.status_c='Dropped' then 'Dropped'
           end as Status
FROM opportunities as t1
LEFT JOIN opportunities_cstm as t2 ON t2.id_c = t1.id 
LEFT JOIN users as t5 ON t5.id = t2.user_id2_c
LEFT JOIN users as t6 ON t6.id = t1.created_by ORDER BY t1.name";
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