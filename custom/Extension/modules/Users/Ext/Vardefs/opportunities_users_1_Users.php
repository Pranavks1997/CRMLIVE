<?php
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
