<?php
$viewdefs ['Opportunities'] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'custom/modules/Opportunities/detail_view.js',
        ),
      ),
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DELETE',
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
      'useTabs' => true,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
        'LBL_DETAILVIEW_PANEL1' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_DETAILVIEW_PANEL2' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_DETAILVIEW_PANEL7' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_DETAILVIEW_PANEL4' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_DETAILVIEW_PANEL10' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_DETAILVIEW_PANEL8' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_DETAILVIEW_PANEL6' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
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
        ),
      ),
      'lbl_detailview_panel1' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 
          array (
            'name' => 'assigned_user_name',
            'label' => 'LBL_ASSIGNED_TO',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'state_c',
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
          0 => 
          array (
            'name' => 'description',
            'nl2br' => true,
          ),
        ),
      ),
      'lbl_detailview_panel2' => 
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
      ),
      'lbl_detailview_panel7' => 
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
            'name' => 'sector_c',
            'label' => 'LBL_SECTOR',
          ),
          1 => 
          array (
            'name' => 'sub_sector_c',
            'label' => 'LBL_SUB_SECTOR',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'risk_c',
            'studio' => 'visible',
            'label' => 'LBL_RISK',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'project_scope_c',
            'studio' => 'visible',
            'label' => 'LBL_PROJECT_SCOPE',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'selection_c',
            'studio' => 'visible',
            'label' => 'LBL_SELECTION',
          ),
          1 => '',
        ),
        5 => 
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
      'lbl_detailview_panel4' => 
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
      ),
      'lbl_detailview_panel10' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'influencersl1_c',
            'studio' => 'visible',
            'label' => 'LBL_INFLUENCERSL1',
          ),
          1 => 
          array (
            'name' => 'influencersl2_c',
            'studio' => 'visible',
            'label' => 'LBL_INFLUENCERSL2',
          ),
        ),
      ),
      'lbl_detailview_panel8' => 
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
      ),
      'lbl_detailview_panel6' => 
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
