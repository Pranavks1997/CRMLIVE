<?php
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
