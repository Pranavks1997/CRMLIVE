<?php
$viewdefs ['Opportunities'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'enctype' => 'multipart/form-data',
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
            'customCode' => '<input type="button"  name="send_approval_button" value="send for approval" id="send_approval"  class="button" />',
          ),
          3 => 
          array (
            'customCode' => '<input type="button"  name="approve_button" value="approve" id="approve"  class="button" />',
          ),
          4 => 
          array (
            'customCode' => '<input type="button"  name="reject_button" value="reject" id="reject"  class="button" />',
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
      'javascript' => '{$PROBABILITY_SCRIPT}',
      'useTabs' => true,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL3' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL2' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL7' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL8' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL6' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL9' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'custom/modules/Opportunities/edit_view.js',
        ),
        1 => 
        array (
          'file' => 'custom/modules/Opportunities/custom.js',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => '',
          1 => '',
        ),
        1 => 
        array (
          0 => '',
          1 => '',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'rfporeoipublished_c',
            'studio' => 'visible',
            'label' => 'LBL_RFP/EOIPUBLISHED',
          ),
          1 => 
          array (
            'name' => 'filename',
            'label' => 'LBL_FILENAME',
          ),
        ),
        3 => 
        array (
          0 => 'opportunity_type',
          1 => '',
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'status_c',
            'studio' => 'visible',
            'label' => 'LBL_STATUS',
          ),
          1 => 
          array (
            'name' => 'applyfor_c',
            'studio' => 'visible',
            'label' => 'LBL_APPLYFOR',
          ),
        ),
        5 => 
        array (
          0 => 'assigned_user_name',
          1 => '',
        ),
      ),
      'lbl_editview_panel3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
          ),
          1 => 
          array (
            'name' => 'select_approver_c',
            'studio' => 'visible',
            'label' => 'LBL_SELECT_APPROVER',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'international_c',
            'studio' => 'visible',
            'label' => 'LBL_INTERNATIONAL',
          ),
          1 => 
          array (
            'name' => 'currency_c',
            'studio' => 'visible',
            'label' => 'LBL_CURRENCY',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'state_c',
            'studio' => 'visible',
            'label' => 'LBL_STATE',
          ),
          1 => 
          array (
            'name' => 'country_c',
            'label' => 'LBL_COUNTRY',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'source_c',
            'studio' => 'visible',
            'label' => 'LBL_SOURCE',
          ),
          1 => 
          array (
            'name' => 'new_department_c',
            'label' => 'LBL_NEW_DEPARTMENT',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'non_financial_radio_c',
            'studio' => 'visible',
            'label' => 'LBL_NON_FINANCIAL_RADIO',
          ),
          1 => 
          array (
            'name' => 'source_details_c',
            'label' => 'LBL_SOURCE_DETAILS',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'non_financial_consideration_c',
            'type' => 'CheckboxMultienum',
            'studio' => 'visible',
            'label' => 'LBL_NON_FINANCIAL_CONSIDERATION',
            'displayParams' => 
            array (
              'size' => '160',
              'width' => '50',
            ),
          ),
          1 => 
          array (
            'name' => 'assigned_to_new_c',
            'label' => 'LBL_ASSIGNED_TO_NEW',
          ),
        ),
        6 => 
        array (
          0 => 'description',
        ),
      ),
      'lbl_editview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'financial_feasibility_l1_c',
            'label' => 'LBL_FINANCIAL_FEASIBILITY_L1',
          ),
          1 => 
          array (
            'name' => 'financial_feasibility_l2_c',
            'label' => 'LBL_FINANCIAL_FEASIBILITY_L2',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'budget_source_c',
            'label' => 'LBL_BUDGET_SOURCE',
          ),
          1 => 
          array (
            'name' => 'budget_head_c',
            'label' => 'LBL_BUDGET_HEAD',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'budget_head_amount_c',
            'label' => 'LBL_BUDGET_HEAD_AMOUNT',
          ),
          1 => 
          array (
            'name' => 'budget_allocated_oppertunity_c',
            'label' => 'LBL_BUDGET_ALLOCATED_OPPERTUNITY',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'project_implementation_start_c',
            'label' => 'LBL_PROJECT_IMPLEMENTATION_START',
          ),
          1 => 
          array (
            'name' => 'project_implementation_end_c',
            'label' => 'LBL_PROJECT_IMPLEMENTATION_END',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'financial_feasibility_l3_c',
            'label' => 'LBL_FINANCIAL_FEASIBILITY_L3',
          ),
          1 => '',
        ),
      ),
      'lbl_editview_panel7' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'segment_c',
            'label' => 'LBL_SEGMENT',
          ),
          1 => 
          array (
            'name' => 'product_service_c',
            'label' => 'LBL_PRODUCT_SERVICE',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'add_new_segment_c',
            'label' => 'LBL_ADD_NEW_SEGMENT',
          ),
          1 => 
          array (
            'name' => 'add_new_product_service_c',
            'label' => 'LBL_ADD_NEW_PRODUCT_SERVICE',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'sector_c',
            'label' => 'LBL_SECTOR',
          ),
          1 => 
          array (
            'name' => 'sub_sector_c',
            'label' => 'LBL_SUB_SECTOR',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'risk_c',
            'studio' => 'visible',
            'label' => 'LBL_RISK',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'project_scope_c',
            'studio' => 'visible',
            'label' => 'LBL_PROJECT_SCOPE',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'selection_c',
            'studio' => 'visible',
            'label' => 'LBL_SELECTION',
          ),
          1 => '',
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'funding_c',
            'studio' => 'visible',
            'label' => 'LBL_FUNDING',
          ),
          1 => 
          array (
            'name' => 'timing_button_c',
            'studio' => 'visible',
            'label' => 'LBL_TIMING_BUTTON',
          ),
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'scope_budget_projected_c',
            'label' => 'LBL_SCOPE_BUDGET_PROJECTED',
          ),
          1 => 
          array (
            'name' => 'scope_budget_achieved_c',
            'label' => 'LBL_SCOPE_BUDGET_ACHIEVED',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'rfp_eoi_projected_c',
            'label' => 'LBL_RFP_EOI_PROJECTED',
          ),
          1 => 
          array (
            'name' => 'rfp_eoi_achieved_c',
            'label' => 'LBL_RFP_EOI_ACHIEVED',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'rfp_eoi_published_projected_c',
            'label' => 'LBL_RFP_EOI_PUBLISHED_PROJECTED',
          ),
          1 => 
          array (
            'name' => 'rfp_eoi_published_achieved_c',
            'label' => 'LBL_RFP_EOI_PUBLISHED_ACHIEVED',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'work_order_projected_c',
            'label' => 'LBL_WORK_ORDER_PROJECTED',
          ),
          1 => 
          array (
            'name' => 'work_order_achieved_c',
            'label' => 'LBL_WORK_ORDER_ACHIEVED',
          ),
        ),
        4 => 
        array (
          0 => '',
          1 => '',
        ),
      ),
      'lbl_editview_panel8' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'rfp_eoi_summary_c',
            'studio' => 'visible',
            'label' => 'LBL_RFP_EOI_SUMMARY',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'bid_strategy_c',
            'label' => 'LBL_BID_STRATEGY',
          ),
          1 => 
          array (
            'name' => 'submissionstatus_c',
            'studio' => 'visible',
            'label' => 'LBL_SUBMISSIONSTATUS',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'bid_checklist_c',
            'label' => 'LBL_BID_CHECKLIST',
          ),
          1 => 
          array (
            'name' => 'multiple_file',
            'studio' => 'visible',
            'label' => 'Bid Files',
            'customCode' => '{include file=$FILEUPLOAD filename=$ATTACHMENTS}',
          ),
        ),
      ),
      'lbl_editview_panel6' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'closure_status_c',
            'studio' => 'visible',
            'label' => 'LBL_CLOSURE_STATUS',
          ),
          1 => 
          array (
            'name' => 'expected_inflow_c',
            'label' => 'LBL_EXPECTED_INFLOW',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'learnings_c',
            'studio' => 'visible',
            'label' => 'LBL_LEARNINGS',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'comments_c',
            'studio' => 'visible',
            'label' => 'LBL_COMMENTS',
          ),
        ),
      ),
      'lbl_editview_panel9' => 
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
            'name' => 'multiple_approver_c',
            'label' => 'LBL_MULTIPLE_APPROVER',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'tagged_users_comments_c',
            'studio' => 'visible',
            'label' => 'LBL_TAGGED_USERS_COMMENTS',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'tagged_hiden_c',
            'label' => 'LBL_TAGGED_HIDEN',
          ),
          1 => 
          array (
            'name' => 'untagged_hidden_c',
            'label' => 'LBL_UNTAGGED_HIDDEN',
          ),
        ),
      ),
    ),
  ),
);
;
?>
