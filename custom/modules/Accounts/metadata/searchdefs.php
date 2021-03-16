<?php
$searchdefs ['Accounts'] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
    ),
    'advanced_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'website' => 
      array (
        'name' => 'website',
        'default' => true,
        'width' => '10%',
      ),
      'country_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_COUNTRY',
        'width' => '10%',
        'name' => 'country_c',
      ),
      'state_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_STATE',
        'width' => '10%',
        'name' => 'state_c',
      ),
      'city_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_CITY',
        'width' => '10%',
        'name' => 'city_c',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
;
?>
