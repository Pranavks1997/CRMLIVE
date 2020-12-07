<?php
$viewdefs ['Users'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'custom/modules/Users/user.js',
        ),
      ),
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'form' => 
      array (
        'headerTpl' => 'modules/Users/tpls/EditViewHeader.tpl',
        'footerTpl' => 'modules/Users/tpls/EditViewFooter.tpl',
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'LBL_USER_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EMPLOYEE_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'LBL_USER_INFORMATION' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'user_name',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
          1 => 'first_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'status',
            'customCode' => '{if $IS_ADMIN}@@FIELD@@{else}{$STATUS_READONLY}{/if}',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
          1 => 'last_name',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'UserType',
            'customCode' => '{if $IS_ADMIN}{$USER_TYPE_DROPDOWN}{else}{$USER_TYPE_READONLY}{/if}',
          ),
        ),
        3 => 
        array (
          0 => 'photo',
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'factor_auth',
            'label' => 'LBL_FACTOR_AUTH',
          ),
          1 => 
          array (
            'name' => 'opportunities_users_1_name',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'opportunities_users_2_name',
          ),
        ),
      ),
      'LBL_EMPLOYEE_INFORMATION' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'employee_status',
            'customCode' => '{if $IS_ADMIN}@@FIELD@@{else}{$EMPLOYEE_STATUS_READONLY}{/if}',
          ),
          1 => 'show_on_employees',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'title',
            'customCode' => '{if $IS_ADMIN}@@FIELD@@{else}{$TITLE_READONLY}{/if}',
          ),
          1 => 'phone_work',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'department',
            'customCode' => '{if $IS_ADMIN}@@FIELD@@{else}{$DEPT_READONLY}{/if}',
          ),
          1 => 'phone_mobile',
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'mc_c',
            'studio' => 'visible',
            'label' => 'LBL_MC',
            'customCode' => '{if $IS_ADMIN}@@FIELD@@{else}{$fields.mc_c.value}{/if}',
          ),
          1 => '',
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'reports_to_name',
            'customCode' => '{if $IS_ADMIN}@@FIELD@@{else}{$REPORTS_TO_READONLY}{/if}',
          ),
          1 => 'phone_other',
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'teamheirarchy_c',
            'studio' => 'visible',
            'label' => 'LBL_TEAMHEIRARCHY',
            'customCode' => '{if $IS_ADMIN}@@FIELD@@{else}{$fields.teamheirarchy_c.value}{/if}',
          ),
          1 => 'phone_fax',
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'teamfunction_c',
            'studio' => 'visible',
            'label' => 'LBL_TEAMFUNCTION',
            'customCode' => '{if $IS_ADMIN}@@FIELD@@{else}{$fields.teamfunction_c.value}{/if}',
          ),
          1 => 'phone_home',
        ),
        7 => 
        array (
          0 => 'messenger_type',
          1 => 'messenger_id',
        ),
        8 => 
        array (
          0 => 'address_street',
          1 => 'address_city',
        ),
        9 => 
        array (
          0 => 'address_state',
          1 => 'address_postalcode',
        ),
        10 => 
        array (
          0 => 'address_country',
        ),
        11 => 
        array (
          0 => 'description',
        ),
      ),
    ),
  ),
);
;
?>
