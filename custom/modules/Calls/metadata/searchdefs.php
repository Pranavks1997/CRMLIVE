<?php
$searchdefs ['Calls'] = 
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
      'parent_type' => 
      array (
        'type' => 'parent_type',
        'label' => 'LBL_PARENT_TYPE',
        'width' => '10%',
        'default' => true,
        'name' => 'parent_type',
      ),
      'parent_name' => 
      array (
        'type' => 'parent',
        'label' => 'LBL_LIST_RELATED_TO',
        'width' => '10%',
        'default' => true,
        'name' => 'parent_name',
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
      'status_new_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_STATUS_NEW',
        'width' => '10%',
        'name' => 'status_new_c',
      ),
      'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'type' => 'enum',
        'label' => 'LBL_ASSIGNED_TO',
        'function' => 
        array (
          'name' => 'get_user_array',
          'params' => 
          array (
            0 => false,
          ),
        ),
        'default' => true,
        'width' => '10%',
      ),
      'activity_date_c' => 
      array (
        'type' => 'date',
        'default' => true,
        'label' => 'LBL_ACTIVITY_DATE',
        'width' => '10%',
        'name' => 'activity_date_c',
      ),
      'date_entered' => 
      array (
        'type' => 'datetime',
        'label' => 'LBL_DATE_ENTERED',
        'width' => '10%',
        'default' => true,
        'name' => 'date_entered',
      ),
      'next_date_c' => 
      array (
        'type' => 'date',
        'default' => true,
        'label' => 'LBL_NEXT_DATE',
        'width' => '10%',
        'name' => 'next_date_c',
      ),
      'name_of_person_c' => 
      array (
        'type' => 'varchar',
        'default' => true,
        'label' => 'LBL_NAME_OF_PERSON',
        'width' => '10%',
        'name' => 'name_of_person_c',
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
