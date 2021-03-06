<?php
$viewdefs ['Calls'] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'custom/modules/Calls/quick_create_edit_view.js',
        ),
        1 => 
        array (
          'file' => 'custom/modules/Calls/quick_create_custom.css',
        ),
      ),
      'maxColumns' => '2',
      'form' => 
      array (
        'hidden' => 
        array (
          0 => '<input type="hidden" name="isSaveAndNew" value="false">',
          1 => '<input type="hidden" name="send_invites">',
          2 => '<input type="hidden" name="user_invitees">',
          3 => '<input type="hidden" name="lead_invitees">',
          4 => '<input type="hidden" name="contact_invitees">',
        ),
        'buttons' => 
        array (
          0 => 
          array (
            'customCode' => '<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button" onclick="SUGAR.calls.fill_invitees();this.form.action.value=\'Save\'; this.form.return_action.value=\'DetailView\'; {if isset($smarty.request.isDuplicate) && $smarty.request.isDuplicate eq "true"}this.form.return_id.value=\'\'; {/if}return check_form(\'EditView\') && isValidDuration();" type="submit" name="button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">',
          ),
          1 => 'CANCEL',
          2 => 
          array (
            'customCode' => '<input title="{$MOD.LBL_SEND_BUTTON_TITLE}" class="button" onclick="this.form.send_invites.value=\'1\';SUGAR.calls.fill_invitees();this.form.action.value=\'Save\';this.form.return_action.value=\'EditView\';this.form.return_module.value=\'{$smarty.request.return_module}\';return check_form(\'EditView\') && isValidDuration();" type="submit" name="button" value="{$MOD.LBL_SEND_BUTTON_LABEL}">',
          ),
          3 => 
          array (
            'customCode' => '{if $fields.status.value != "Held"}<input title="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_TITLE}" class="button" onclick="SUGAR.calls.fill_invitees(); this.form.status.value=\'Held\'; this.form.action.value=\'Save\'; this.form.return_module.value=\'Calls\'; this.form.isDuplicate.value=true; this.form.isSaveAndNew.value=true; this.form.return_action.value=\'EditView\'; this.form.return_id.value=\'{$fields.id.value}\'; return check_form(\'EditView\') && isValidDuration();" type="submit" name="button" value="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_LABEL}">{/if}',
          ),
        ),
      ),
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
      'javascript' => '<script type="text/javascript">{$JSON_CONFIG_JAVASCRIPT}</script>{sugar_getscript file="cache/include/javascript/sugar_grp_jsolait.js"}<script>toggle_portal_flag();function toggle_portal_flag()  {literal} { {/literal} {$TOGGLE_JS} {literal} } {/literal} </script>',
      'useTabs' => false,
      'tabDefs' => 
      array (
        'LBL_CALL_INFORMATION' => 
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
    ),
    'panels' => 
    array (
      'lbl_call_information' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'activity_type_c',
            'studio' => 'visible',
            'label' => 'LBL_ACTIVITY_TYPE',
          ),
          1 => 
          array (
            'name' => 'status_new_c',
            'label' => 'LBL_STATUS_NEW',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'name',
            'displayParams' => 
            array (
              'required' => true,
            ),
          ),
          1 => 
          array (
            'name' => 'approver_c',
            'studio' => 'visible',
            'label' => 'LBL_APPROVER',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'type_of_interaction_c',
            'studio' => 'visible',
            'label' => 'LBL_TYPE_OF_INTERACTION',
          ),
          1 => 
          array (
            'name' => 'assigned_to_c',
            'label' => 'LBL_ASSIGNED_TO_C',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'activity_date_c',
            'label' => 'LBL_ACTIVITY_DATE',
          ),
          1 => 
          array (
            'name' => 'next_date_c',
            'label' => 'LBL_NEXT_DATE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'parent_name',
            'label' => 'LBL_LIST_RELATED_TO',
          ),
          1 => 
          array (
            'name' => 'name_of_person_c',
            'label' => 'LBL_NAME_OF_PERSON',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'for_quick_create_c',
            'label' => 'LBL_FOR_QUICK_CREATE',
          ),
          1 => '',
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'audit_trail_c',
            'studio' => 'visible',
            'label' => 'LBL_AUDIT_TRAIL',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'new_current_status_c',
            'studio' => 'visible',
            'label' => 'LBL_NEW_CURRENT_STATUS',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'description',
            'comment' => 'Full text of the note',
            'label' => 'LBL_DESCRIPTION',
          ),
        ),
        9 => 
        array (
          0 => 
          array (
            'name' => 'new_key_action_c',
            'studio' => 'visible',
            'label' => 'LBL_NEW_KEY_ACTION',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'untag_c',
            'label' => 'LBL_UNTAG',
          ),
          1 => '',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'tag_c',
            'label' => 'LBL_TAG',
          ),
          1 => '',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'tagged_comments_c',
            'studio' => 'visible',
            'label' => 'LBL_TAGGED_COMMENTS',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'tag_hidden_c',
            'label' => 'LBL_TAG_HIDDEN',
          ),
          1 => 
          array (
            'name' => 'untag_hidden_c',
            'label' => 'LBL_UNTAG_HIDDEN',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO_NAME',
          ),
        ),
      ),
    ),
  ),
);
;
?>
