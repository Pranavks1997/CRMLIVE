<?php
$listViewDefs ['Calls'] = 
array (
  'NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_LIST_SUBJECT',
    'link' => true,
    'default' => true,
  ),
  'TYPE_OF_INTERACTION_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_TYPE_OF_INTERACTION',
    'width' => '10%',
  ),
  'PARENT_NAME' => 
  array (
    'width' => '20%',
    'label' => 'LBL_LIST_RELATED_TO',
    'dynamic_module' => 'PARENT_TYPE',
    'id' => 'PARENT_ID',
    'link' => true,
    'default' => true,
    'sortable' => false,
    'ACLTag' => 'PARENT',
    'related_fields' => 
    array (
      0 => 'parent_id',
      1 => 'parent_type',
    ),
  ),
  'STATUS_NEW_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_STATUS_NEW',
    'width' => '10%',
  ),
  'ACTIVITY_DATE_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_ACTIVITY_DATE',
    'width' => '10%',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '2%',
    'label' => 'LBL_LIST_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
  'NEXT_DATE_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_NEXT_DATE',
    'width' => '10%',
  ),
  'NAME_OF_PERSON_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_NAME_OF_PERSON',
    'width' => '10%',
  ),
);
;
?>
