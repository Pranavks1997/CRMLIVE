<?php
$listViewDefs ['Opportunities'] = 
array (
  'NAME' => 
  array (
    'width' => '30%',
    'label' => 'LBL_LIST_OPPORTUNITY_NAME',
    'link' => true,
    'default' => true,
  ),
  'OPPORTUNITY_TYPE' => 
  array (
    'width' => '15%',
    'label' => 'LBL_TYPE',
    'default' => true,
  ),
  'RFPOREOIPUBLISHED_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_RFP/EOIPUBLISHED',
    'width' => '10%',
  ),
  'ACCOUNT_NAME' => 
  array (
    'width' => '20%',
    'label' => 'LBL_LIST_ACCOUNT_NAME',
    'id' => 'ACCOUNT_ID',
    'module' => 'Accounts',
    'link' => true,
    'default' => true,
    'sortable' => true,
    'ACLTag' => 'ACCOUNT',
    'contextMenu' => 
    array (
      'objectType' => 'sugarAccount',
      'metaData' => 
      array (
        'return_module' => 'Contacts',
        'return_action' => 'ListView',
        'module' => 'Accounts',
        'parent_id' => '{$ACCOUNT_ID}',
        'parent_name' => '{$ACCOUNT_NAME}',
        'account_id' => '{$ACCOUNT_ID}',
        'account_name' => '{$ACCOUNT_NAME}',
      ),
    ),
    'related_fields' => 
    array (
      0 => 'account_id',
    ),
  ),
  'SOURCE_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_SOURCE',
    'width' => '10%',
  ),
  'SECTOR_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_SECTOR',
    'width' => '10%',
  ),
  'SUB_SECTOR_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_SUB_SECTOR',
    'width' => '10%',
  ),
  'SEGMENT_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_SEGMENT',
    'width' => '10%',
  ),
  'PRODUCT_SERVICE_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_PRODUCT_SERVICE',
    'width' => '10%',
  ),
);
;
?>
