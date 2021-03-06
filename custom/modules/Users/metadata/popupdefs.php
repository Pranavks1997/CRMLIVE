<?php
$popupMeta = array (
    'moduleMain' => 'User',
    'varName' => 'USER',
    'orderBy' => 'user_name',
    'whereClauses' => array (
  'first_name' => 'users.first_name',
  'user_name' => 'users.user_name',
  'status' => 'users.status',
  'is_admin' => 'users.is_admin',
  'teamheirarchy_c' => 'users_cstm.teamheirarchy_c',
  'teamfunction_c' => 'users_cstm.teamfunction_c',
  'last_name' => 'users.last_name',
),
    'searchInputs' => array (
  0 => 'first_name',
  2 => 'user_name',
  5 => 'status',
  6 => 'is_admin',
  16 => 'teamheirarchy_c',
  17 => 'teamfunction_c',
  18 => 'last_name',
),
    'searchdefs' => array (
  'first_name' => 
  array (
    'name' => 'first_name',
    'width' => '10%',
  ),
  'last_name' => 
  array (
    'name' => 'last_name',
    'width' => '10%',
  ),
  'user_name' => 
  array (
    'name' => 'user_name',
    'width' => '10%',
  ),
  'status' => 
  array (
    'name' => 'status',
    'width' => '10%',
  ),
  'teamheirarchy_c' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_TEAMHEIRARCHY',
    'width' => '10%',
    'name' => 'teamheirarchy_c',
  ),
  'teamfunction_c' => 
  array (
    'type' => 'multienum',
    'studio' => 'visible',
    'label' => 'LBL_TEAMFUNCTION',
    'width' => '10%',
    'name' => 'teamfunction_c',
  ),
  // 'is_admin' => 
  // array (
  //   'name' => 'is_admin',
  //   'width' => '10%',
  // ),
),
);
echo '<script src="custom/modules/Users/popup.js"></script>';