<?php
$viewdefs ['Documents'] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'enctype' => 'multipart/form-data',
        'hidden' => 
        array (
          0 => '<input type="hidden" name="old_id" value="{$fields.document_revision_id.value}">',
          1 => '<input type="hidden" name="parent_id" value="{$smarty.request.parent_id}">',
          2 => '<input type="hidden" name="parent_type" value="{$smarty.request.parent_type}">',
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
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'include/javascript/popup_parent_helper.js',
        ),
        1 => 
        array (
          'file' => 'cache/include/javascript/sugar_grp_jsolait.js',
        ),
        2 => 
        array (
          'file' => 'modules/Documents/documents.js',
        ),
        3 => 
        array (
          'file' => 'custom/modules/Documents/quick_create.js',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'LBL_DOCUMENT_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'lbl_document_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'document_visibility_c',
            'studio' => 'visible',
            'label' => 'LBL_DOCUMENT_VISIBILITY',
          ),
          1 => 
          array (
            'name' => 'status_c',
            'label' => 'LBL_STATUS',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'filename',
            'displayParams' => 
            array (
              'required' => true,
              'onchangeSetFileNameTo' => 'document_name',
            ),
          ),
          1 => 
          array (
            'name' => 'template_type',
            'label' => 'LBL_DET_TEMPLATE_TYPE',
          ),
        ),
        2 => 
        array (
          0 => 'document_name',
          1 => 
          array (
            'name' => 'approver_c',
            'studio' => 'visible',
            'label' => 'LBL_APPROVER',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'parent_name',
            'studio' => 'visible',
            'label' => 'RELATED TO',
          ),
          1 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO_NAME',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'category_c',
            'label' => 'LBL_CATEGORY',
          ),
          1 => 
          array (
            'name' => 'sub_category_c',
            'label' => 'LBL_SUB_CATEGORY',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'multiple_file',
            'studio' => 'visible',
            'label' => 'Follow-up Documents',
            'customCode' => '{include file=$FILEUPLOAD filename=$ATTACHMENTS}',
          ),
          1 => 
          array (
            'name' => 'follow_up_date_c',
            'label' => 'LBL_FOLLOW_UP_DATE',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'displayParams' => 
            array (
              'rows' => 10,
              'cols' => 120,
            ),
          ),
        ),
      ),
    ),
  ),
);
;
?>
