<?php
$viewdefs ['Opportunities'] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
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
        ),
      ),
      0 => 
      array (
        'enctype' => 'multipart/form-data',
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
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
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
        1 => 
        array (
          0 => 'opportunity_type',
          1 => '',
        ),
        2 => 
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
      ),
      'lbl_editview_panel3' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'name',
          ),
          1 => 'assigned_user_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'state_c',
            'studio' => 'visible',
            'label' => 'LBL_STATE',
          ),
          1 => 'account_name',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'source_c',
            'studio' => 'visible',
            'label' => 'LBL_SOURCE',
          ),
          1 => 
          array (
            'name' => 'source_details_c',
            'label' => 'LBL_SOURCE_DETAILS',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'non_financial_consideration_c',
            'studio' => 'visible',
            'label' => 'LBL_NON_FINANCIAL_CONSIDERATION',
          ),
        ),
        4 => 
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
            'name' => 'budget_source_c',
            'label' => 'LBL_BUDGET_SOURCE',
          ),
          1 => 
          array (
            'name' => 'budget_head_c',
            'label' => 'LBL_BUDGET_HEAD',
          ),
        ),
        1 => 
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
        2 => 
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
        3 => 
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
        4 => 
        array (
          0 => 
          array (
            'name' => 'financial_feasibility_l3_c',
            'label' => 'LBL_FINANCIAL_FEASIBILITY_L3',
          ),
          1 => 
          array (
            'name' => 'cash_flow_c',
            'label' => 'LBL_CASH_FLOW',
          ),
        ),
      ),
      'lbl_editview_panel7' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'first_of_a_kind_segment_c',
            'studio' => 'visible',
            'label' => 'LBL_FIRST_OF_A_KIND_SEGMENT',
          ),
          1 => 
          array (
            'name' => 'first_of_a_kind_product_c',
            'studio' => 'visible',
            'label' => 'LBL_FIRST_OF_A_KIND_PRODUCT',
          ),
        ),
        1 => 
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
        2 => 
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
        3 => 
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
            'name' => 'risk_c',
            'studio' => 'visible',
            'label' => 'LBL_RISK',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'selection_c',
            'studio' => 'visible',
            'label' => 'LBL_SELECTION',
          ),
          1 => '',
        ),
        7 => 
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
          1 => '',
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
    ),
  ),
);
;
?>
