<?php
$listViewDefs ['Documents'] = 
array (
  'DOCUMENT_NAME' => 
  array (
    'width' => '20%',
    'label' => 'LBL_NAME',
    'link' => true,
    'default' => true,
    'bold' => true,
  ),
  'TEMPLATE_TYPE' => 
  array (
    'type' => 'enum',
    'label' => 'LBL_TEMPLATE_TYPE',
    'width' => '10%',
    'default' => true,
  ),
  'CATEGORY_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_CATEGORY',
    'width' => '10%',
  ),
  'SUB_CATEGORY_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_SUB_CATEGORY',
    'width' => '10%',
  ),
  'PARENT_NAME' => 
  array (
    'type' => 'parent',
    'default' => true,
    'studio' => 'visible',
    'label' => 'RELATED TO',
    'link' => true,
    'sortable' => false,
    'ACLTag' => 'PARENT',
    'dynamic_module' => 'PARENT_TYPE',
    'id' => 'PARENT_ID',
    'related_fields' => 
    array (
      0 => 'parent_id',
      1 => 'parent_type',
    ),
    'width' => '10%',
  ),
  'CREATED_BY_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'label' => 'LBL_CREATED',
    'id' => 'CREATED_BY',
    'width' => '10%',
    'default' => true,
  ),
);
;
?>
