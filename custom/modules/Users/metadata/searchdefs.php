<?php
$searchdefs ['Users'] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      0 => 
      array (
        'name' => 'search_name',
        'label' => 'LBL_NAME',
        'type' => 'name',
      ),
    ),
    'advanced_search' => 
    array (
      'full_name' => 
      array (
        'type' => 'name',
        'studio' => 
        array (
          'formula' => false,
        ),
        'label' => 'LBL_NAME',
        'width' => '10%',
        'default' => true,
        'name' => 'full_name',
      ),
      'reports_to_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_REPORTS_TO_NAME',
        'id' => 'REPORTS_TO_ID',
        'width' => '10%',
        'default' => true,
        'name' => 'reports_to_name',
      ),
      'user_name' => 
      array (
        'name' => 'user_name',
        'default' => true,
        'width' => '10%',
      ),
      'status' => 
      array (
        'name' => 'status',
        'default' => true,
        'width' => '10%',
      ),
      'teamheirarchy_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_TEAMHEIRARCHY',
        'width' => '10%',
        'name' => 'teamheirarchy_c',
      ),
      'teamfunction_c' => 
      array (
        'type' => 'multienum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_TEAMFUNCTION',
        'width' => '10%',
        'name' => 'teamfunction_c',
      ),
      'bid_commercial_head_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_BID_COMMERCIAL_HEAD',
        'width' => '10%',
        'name' => 'bid_commercial_head_c',
      ),
      'mc_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_MC',
        'width' => '10%',
        'name' => 'mc_c',
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
