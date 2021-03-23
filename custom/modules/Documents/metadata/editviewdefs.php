<?php
$viewdefs ['Documents'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'enctype' => 'multipart/form-data',
        'hidden' => 
        array (
          0 => '<input type="hidden" name="old_id" value="{$fields.document_revision_id.value}">',
          1 => '<input type="hidden" name="contract_id" value="{$smarty.request.contract_id}">',
        ),
        'buttons' => 
        array (
          0 => 
          array (
            'customCode' => '<input type="submit" value="{$APP.LBL_SAVE_BUTTON_LABEL}" name="button" value="Save" id="SAVE_HEADER" 
                            onclick="var _form = document.getElementById(\'EditView\'); _form.return_id.value=\'\'; _form.action.value=\'Save\'; 
                            if(custom_check_form(\'EditView\'))SUGAR.ajaxUI.submitForm(_form);return false;" class="button" accesskey="{$APP.LBL_SAVE_BUTTON_KEY}" 
                            title="{$APP.LBL_SAVE_BUTTON_TITLE}"/>',
          ),
          1 => 'CANCEL',
          2 => 
          array (
            'customCode' => '<input type="button"  name="send_for_approval" value="send for approval" id="apply_for_complete"  class="button"  />',
          ),
          3 => 
          array (
            'customCode' => '<input type="button"  name="approve_button" value="approve" id="approve_document"  class="button"  />',
          ),
          4 => 
          array (
            'customCode' => '<input type="button"  name="reject_button" value="reject" id="reject_document"  class="button"  />',
          ),
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
      'javascript' => '{sugar_getscript file="include/javascript/popup_parent_helper.js"}
{sugar_getscript file="cache/include/javascript/sugar_grp_jsolait.js"}
{sugar_getscript file="modules/Documents/documents.js"}',
      'useTabs' => false,
      'tabDefs' => 
      array (
        'LBL_DOCUMENT_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
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
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'tagged_users_c',
            'label' => 'LBL_TAGGED_USERS',
          ),
          1 => 
          array (
            'name' => 'tagged_hidden_c',
            'label' => 'LBL_TAGGED_HIDDEN',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'tag_comments_c',
            'studio' => 'visible',
            'label' => 'LBL_TAG_COMMENTS',
          ),
        ),
      ),
    ),
  ),
);
;
?>
