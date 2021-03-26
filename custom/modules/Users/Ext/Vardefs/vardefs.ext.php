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

 

 // created: 2020-12-22 08:17:16
$dictionary['User']['fields']['teamheirarchy_c']['inline_edit']='1';
$dictionary['User']['fields']['teamheirarchy_c']['labelValue']='Team Heirarchy';

 

 // created: 2021-01-18 14:16:43
$dictionary['User']['fields']['teamfunction_c']['inline_edit']='1';
$dictionary['User']['fields']['teamfunction_c']['labelValue']='Team Function';

 

 // created: 2020-12-22 08:20:09
$dictionary['User']['fields']['first_name']['required']=true;
$dictionary['User']['fields']['first_name']['inline_edit']=true;
$dictionary['User']['fields']['first_name']['merge_filter']='disabled';

 

 // created: 2021-02-04 10:52:20
$dictionary['User']['fields']['bid_commercial_head_c']['inline_edit']='1';
$dictionary['User']['fields']['bid_commercial_head_c']['labelValue']='Bid/Commercial Head';

 

 // created: 2021-01-18 14:13:16
$dictionary['User']['fields']['last_name']['required']=true;

 
?>