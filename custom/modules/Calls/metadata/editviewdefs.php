<?php
$viewdefs ['Calls'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'modules/Reminders/Reminders.js',
        ),
        1 => 
        array (
          'file' => 'custom/modules/Calls/editview.css',
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
            'customCode' => '<input type="submit" value="{$APP.LBL_SAVE_BUTTON_LABEL}" name="button" value="Save" id="SAVE_HEADER" 
                onclick="var _form = document.getElementById(\'EditView\'); _form.return_id.value=\'\'; _form.action.value=\'Save\';
                if(custom_check_form(\'EditView\'))SUGAR.ajaxUI.submitForm(_form);return false;" class="button" 
                accesskey="{$APP.LBL_SAVE_BUTTON_KEY}" title="{$APP.LBL_SAVE_BUTTON_TITLE}"/>',
          ),
          1 => 'CANCEL',
          2 => 
        
          array (
            'customCode' => '<input type="button"  name="apply_for_complete_button" value="apply for complete" id="apply_for_complete"  class="button"  />',
          ),
          3 =>
          array (
            'customCode' => '<input type="button"  name="approve_button" value="approve" id="approve_activity"  class="button"  />',
          ),
          
          4=>
          array (
            'customCode' => '<input type="button"  name="reject_button" value="reject" id="reject_activity"  class="button"  />',
          ),
          5=>
          array (
            'customCode' => '<input type="button"  name="complete_button" value="completed" id="complete_activity"  class="button"  />',
          ),
          6=>
          array (
            'customCode' => '{if $fields.status.value != "Held"}<input title="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_TITLE}" id="CLOSE_CREATE_HEADER" accessKey="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_KEY}" class="button" onclick="SUGAR.calls.fill_invitees(); document.EditView.status.value=\'Held\'; document.EditView.action.value=\'Save\'; document.EditView.return_module.value=\'Calls\'; document.EditView.isDuplicate.value=true; document.EditView.isSaveAndNew.value=true; document.EditView.return_action.value=\'EditView\'; document.EditView.return_id.value=\'{$fields.id.value}\'; formSubmitCheck();" type="button" name="button" value="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_LABEL}">{/if}',
          ),
        ),
        'buttons_footer' => 
        array (
          0 => 
          array (
            'customCode' => '<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" id ="SAVE_FOOTER" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button primary" onclick="SUGAR.calls.fill_invitees();document.EditView.action.value=\'Save\'; document.EditView.return_action.value=\'DetailView\'; {if isset($smarty.request.isDuplicate) && $smarty.request.isDuplicate eq "true"}document.EditView.return_id.value=\'\'; {/if} formSubmitCheck();"type="button" name="button" value="{$APP.LBL_SAVE_BUTTON_LABEL}">',
          ),
          1 => 'CANCEL',
          2 => 
          array (
            'customCode' => '<input title="{$MOD.LBL_SEND_BUTTON_TITLE}" id="save_and_send_invites_footer" class="button" onclick="document.EditView.send_invites.value=\'1\';SUGAR.calls.fill_invitees();document.EditView.action.value=\'Save\';document.EditView.return_action.value=\'EditView\';document.EditView.return_module.value=\'{$smarty.request.return_module}\'; formSubmitCheck();"type="button" name="button" value="{$MOD.LBL_SEND_BUTTON_LABEL}">',
          ),
          3 => 
          array (
            'customCode' => '{if $fields.status.value != "Held"}<input title="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_TITLE}" id="close_and_create_new_footer" class="button" onclick="SUGAR.calls.fill_invitees(); document.EditView.status.value=\'Held\'; document.EditView.action.value=\'Save\'; document.EditView.return_module.value=\'Meetings\'; document.EditView.isDuplicate.value=true; document.EditView.isSaveAndNew.value=true; document.EditView.return_action.value=\'EditView\'; document.EditView.return_id.value=\'{$fields.id.value}\'; formSubmitCheck();"type="button" name="button" value="{$APP.LBL_CLOSE_AND_CREATE_BUTTON_LABEL}">{/if}',
          ),
        ),
        'headerTpl' => 'modules/Calls/tpls/header.tpl',
        'footerTpl' => 'modules/Calls/tpls/footer.tpl',
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
      'javascript' => '{sugar_getscript file="cache/include/javascript/sugar_grp_jsolait.js"}
<script type="text/javascript">{$JSON_CONFIG_JAVASCRIPT}</script>
<script>toggle_portal_flag();function toggle_portal_flag()  {ldelim} {$TOGGLE_JS} {rdelim}
function formSubmitCheck(){ldelim}var duration=true;if(typeof(isValidDuration)!="undefined"){ldelim}duration=isValidDuration();{rdelim}if(check_form(\'EditView\') && duration){ldelim}SUGAR.ajaxUI.submitForm("EditView");{rdelim}{rdelim}</script>',
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
      'syncDetailEditViews' => true,
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
            0 => 
            array (
              'required' => true,
            ),
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
