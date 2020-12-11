<?php
$popupMeta = array (
    'moduleMain' => 'User',
    'varName' => 'USER',
    'orderBy' => 'user_name',
    'whereClauses' => array (
    'first_name' => 'users.first_name',
    'user_name' => 'users.user_name',
    'is_group' => 'users.is_group',
    'status' => 'users.status',
    'is_admin' => 'users.is_admin',
    'title' => 'users.title',
    'department' => 'users.department',
    'phone' => 'users.phone',
    'address_street' => 'users.address_street',
    'email' => 'users.email',
    'address_city' => 'users.address_city',
    'address_state' => 'users.address_state',
    'address_postalcode' => 'users.address_postalcode',
    'address_country' => 'users.address_country',
    'teamheirarchy_c' => 'users_cstm.teamheirarchy_c',
    'teamfunction_c' => 'users_cstm.teamfunction_c',
),
    'searchInputs' => array (
  0 => 'first_name',
  2 => 'user_name',
  3 => 'is_group',
  5 => 'status',
  6 => 'is_admin',
  7 => 'title',
  8 => 'department',
  9 => 'phone',
  10 => 'address_street',
  11 => 'email',
  12 => 'address_city',
  13 => 'address_state',
  14 => 'address_postalcode',
  15 => 'address_country',
  16 => 'teamheirarchy_c',
  17 => 'teamfunction_c',
),
    'searchdefs' => array (
  'first_name' => 
  array (
    'name' => 'first_name',
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
  'is_admin' => 
  array (
    'name' => 'is_admin',
    'width' => '10%',
  ),
  'title' => 
  array (
    'name' => 'title',
    'width' => '10%',
  ),
  'is_group' => 
  array (
    'name' => 'is_group',
    'width' => '10%',
  ),
  'department' => 
  array (
    'name' => 'department',
    'width' => '10%',
  ),
  'phone' => 
  array (
    'name' => 'phone',
    'label' => 'LBL_ANY_PHONE',
    'type' => 'name',
    'width' => '10%',
  ),
  'address_street' => 
  array (
    'name' => 'address_street',
    'label' => 'LBL_ANY_ADDRESS',
    'type' => 'name',
    'width' => '10%',
  ),
  'email' => 
  array (
    'name' => 'email',
    'label' => 'LBL_ANY_EMAIL',
    'type' => 'name',
    'width' => '10%',
  ),
  'address_city' => 
  array (
    'name' => 'address_city',
    'label' => 'LBL_CITY',
    'type' => 'name',
    'width' => '10%',
  ),
  'address_state' => 
  array (
    'name' => 'address_state',
    'label' => 'LBL_STATE',
    'type' => 'name',
    'width' => '10%',
  ),
  'address_postalcode' => 
  array (
    'name' => 'address_postalcode',
    'label' => 'LBL_POSTAL_CODE',
    'type' => 'name',
    'width' => '10%',
  ),
  'address_country' => 
  array (
    'name' => 'address_country',
    'label' => 'LBL_COUNTRY',
    'type' => 'name',
    'width' => '10%',
  ),
),
);

echo '<script src="custom/modules/Users/popup.js"></script>';
