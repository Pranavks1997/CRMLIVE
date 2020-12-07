<?php 
 //WARNING: The contents of this file are auto-generated


// created: 2020-11-03 10:04:46
$dictionary["User"]["fields"]["opportunities_users_1"] = array (
  'name' => 'opportunities_users_1',
  'type' => 'link',
  'relationship' => 'opportunities_users_1',
  'source' => 'non-db',
  'module' => 'Opportunities',
  'bean_name' => 'Opportunity',
  'vname' => 'LBL_OPPORTUNITIES_USERS_1_FROM_OPPORTUNITIES_TITLE',
  'id_name' => 'opportunities_users_1opportunities_ida',
);
$dictionary["User"]["fields"]["opportunities_users_1_name"] = array (
  'name' => 'opportunities_users_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_OPPORTUNITIES_USERS_1_FROM_OPPORTUNITIES_TITLE',
  'save' => true,
  'id_name' => 'opportunities_users_1opportunities_ida',
  'link' => 'opportunities_users_1',
  'table' => 'opportunities',
  'module' => 'Opportunities',
  'rname' => 'name',
);
$dictionary["User"]["fields"]["opportunities_users_1opportunities_ida"] = array (
  'name' => 'opportunities_users_1opportunities_ida',
  'type' => 'link',
  'relationship' => 'opportunities_users_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_OPPORTUNITIES_USERS_1_FROM_USERS_TITLE',
);


// created: 2020-11-03 11:32:56
$dictionary["User"]["fields"]["opportunities_users_2"] = array (
  'name' => 'opportunities_users_2',
  'type' => 'link',
  'relationship' => 'opportunities_users_2',
  'source' => 'non-db',
  'module' => 'Opportunities',
  'bean_name' => 'Opportunity',
  'vname' => 'LBL_OPPORTUNITIES_USERS_2_FROM_OPPORTUNITIES_TITLE',
  'id_name' => 'opportunities_users_2opportunities_ida',
);
$dictionary["User"]["fields"]["opportunities_users_2_name"] = array (
  'name' => 'opportunities_users_2_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_OPPORTUNITIES_USERS_2_FROM_OPPORTUNITIES_TITLE',
  'save' => true,
  'id_name' => 'opportunities_users_2opportunities_ida',
  'link' => 'opportunities_users_2',
  'table' => 'opportunities',
  'module' => 'Opportunities',
  'rname' => 'name',
);
$dictionary["User"]["fields"]["opportunities_users_2opportunities_ida"] = array (
  'name' => 'opportunities_users_2opportunities_ida',
  'type' => 'link',
  'relationship' => 'opportunities_users_2',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_OPPORTUNITIES_USERS_2_FROM_USERS_TITLE',
);


 // created: 2020-11-02 10:05:39
$dictionary['User']['fields']['mc_c']['inline_edit']='1';
$dictionary['User']['fields']['mc_c']['labelValue']='Management Committee';

 

 // created: 2020-11-02 10:09:10
$dictionary['User']['fields']['teamfunction_c']['inline_edit']='1';
$dictionary['User']['fields']['teamfunction_c']['labelValue']='Team Function';

 

 // created: 2020-11-02 10:10:47
$dictionary['User']['fields']['teamheirarchy_c']['inline_edit']='1';
$dictionary['User']['fields']['teamheirarchy_c']['labelValue']='Team Heirarchy';

 
?>