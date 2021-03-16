<?php
// created: 2020-11-03 11:32:56
$dictionary["opportunities_users_2"] = array (
  'true_relationship_type' => 'one-to-many',
  'from_studio' => true,
  'relationships' => 
  array (
    'opportunities_users_2' => 
    array (
      'lhs_module' => 'Opportunities',
      'lhs_table' => 'opportunities',
      'lhs_key' => 'id',
      'rhs_module' => 'Users',
      'rhs_table' => 'users',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'opportunities_users_2_c',
      'join_key_lhs' => 'opportunities_users_2opportunities_ida',
      'join_key_rhs' => 'opportunities_users_2users_idb',
    ),
  ),
  'table' => 'opportunities_users_2_c',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'varchar',
      'len' => 36,
    ),
    1 => 
    array (
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    2 => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'opportunities_users_2opportunities_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'opportunities_users_2users_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'opportunities_users_2spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'opportunities_users_2_ida1',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'opportunities_users_2opportunities_ida',
      ),
    ),
    2 => 
    array (
      'name' => 'opportunities_users_2_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'opportunities_users_2users_idb',
      ),
    ),
  ),
);