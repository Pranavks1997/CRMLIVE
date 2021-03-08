<?php
$dashletData['CallsDashlet']['searchFields'] = array (
  'name' => 
  array (
    'default' => '',
  ),
  'status' => 
  array (
    'default' => 
    array (
      0 => 'Planned',
    ),
  ),
  'date_entered' => 
  array (
    'default' => '',
  ),
  'date_start' => 
  array (
    'default' => '',
  ),
  'assigned_user_id' => 
  array (
    'type' => 'assigned_user_name',
    'label' => 'LBL_ASSIGNED_TO',
    'default' => 'Admin',
  ),
);
$dashletData['CallsDashlet']['columns'] = array (
  'name' => 
  array (
    'width' => '40%',
    'label' => 'LBL_SUBJECT',
    'link' => true,
    'default' => true,
    'name' => 'name',
  ),
  'status' => 
  array (
    'width' => '8%',
    'label' => 'LBL_STATUS',
    'default' => true,
    'name' => 'status',
  ),
  'assigned_user_name' => 
  array (
    'width' => '8%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'name' => 'assigned_user_name',
    'default' => true,
  ),
  'type_of_interaction_c' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_TYPE_OF_INTERACTION',
    'width' => '10%',
    'name' => 'type_of_interaction_c',
  ),
  'activity_date_c' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_ACTIVITY_DATE',
    'width' => '10%',
    'name' => 'activity_date_c',
  ),
);
