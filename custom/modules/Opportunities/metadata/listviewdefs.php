<?php
$listViewDefs ['Opportunities'] = 
array (
  'NAME' => 
  array (
    'width' => '30%',
    'label' => 'LBL_LIST_OPPORTUNITY_NAME',
    'link' => true,
    'default' => true,
  ),
  'OPPORTUNITY_TYPE' => 
  array (
    'width' => '15%',
    'label' => 'LBL_TYPE',
    'default' => true,
  ),
  'SELECT_APPROVER_C' => 
  array (
    'type' => 'relate',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_SELECT_APPROVER',
    'id' => 'USER_ID2_C',
    'link' => true,
    'width' => '10%',
  ),
  'RFPOREOIPUBLISHED_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_RFP/EOIPUBLISHED',
    'width' => '10%',
  ),
  'NEW_DEPARTMENT_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_NEW_DEPARTMENT',
    'width' => '10%',
  ),
  'SOURCE_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_SOURCE',
    'width' => '10%',
  ),
  'SECTOR_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_SECTOR',
    'width' => '10%',
  ),
  'SUB_SECTOR_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_SUB_SECTOR',
    'width' => '10%',
  ),
  'SEGMENT_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_SEGMENT',
    'width' => '10%',
  ),
  'PRODUCT_SERVICE_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_PRODUCT_SERVICE',
    'width' => '10%',
  ),
  'ASSIGNED_TO_NEW_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_ASSIGNED_TO_NEW',
    'width' => '10%',
  ),
  'CASH_FLOW_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_CASH_FLOW',
    'width' => '10%',
  ),
  'COMMENT_C' => 
  array (
    'type' => 'text',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_COMMENT',
    'sortable' => false,
    'width' => '10%',
  ),
  'FUNDING_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_FUNDING',
    'width' => '10%',
  ),
  'PROJECT_IMPLEMENTATION_END_C' => 
  array (
    'type' => 'date',
    'default' => false,
    'label' => 'LBL_PROJECT_IMPLEMENTATION_END',
    'width' => '10%',
  ),
  'SALES_STAGE' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_SALES_STAGE',
    'default' => false,
  ),
  'NEXT_STEP' => 
  array (
    'width' => '10%',
    'label' => 'LBL_NEXT_STEP',
    'default' => false,
  ),
  'DATE_CLOSED' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_DATE_CLOSED',
    'default' => false,
  ),
  'LEAD_SOURCE' => 
  array (
    'width' => '15%',
    'label' => 'LBL_LEAD_SOURCE',
    'default' => false,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '5%',
    'label' => 'LBL_LIST_ASSIGNED_USER',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => false,
  ),
  'COMMENTS_C' => 
  array (
    'type' => 'text',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_COMMENTS',
    'sortable' => false,
    'width' => '10%',
  ),
  'LEARNINGS_C' => 
  array (
    'type' => 'text',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_LEARNINGS',
    'sortable' => false,
    'width' => '10%',
  ),
  'INTERNATIONAL_C' => 
  array (
    'type' => 'radioenum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_INTERNATIONAL',
    'width' => '10%',
  ),
  'SELECTION_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_SELECTION',
    'width' => '10%',
  ),
  'DESCRIPTION' => 
  array (
    'type' => 'text',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
    'default' => false,
  ),
  'RISK_C' => 
  array (
    'type' => 'text',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_RISK',
    'sortable' => false,
    'width' => '10%',
  ),
  'STATE_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_STATE',
    'width' => '10%',
  ),
  'TIMING_BUTTON_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_TIMING_BUTTON',
    'width' => '10%',
  ),
  'STATUS_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_STATUS',
    'width' => '10%',
  ),
  'CLOSURE_STATUS_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_CLOSURE_STATUS',
    'width' => '10%',
  ),
  'SUBMISSIONSTATUS_C' => 
  array (
    'type' => 'enum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_SUBMISSIONSTATUS',
    'width' => '10%',
  ),
  'RFP_EOI_ACHIEVED_C' => 
  array (
    'type' => 'date',
    'default' => false,
    'label' => 'LBL_RFP_EOI_ACHIEVED',
    'width' => '10%',
  ),
  'BUDGET_HEAD_AMOUNT_C' => 
  array (
    'type' => 'float',
    'default' => false,
    'label' => 'LBL_BUDGET_HEAD_AMOUNT',
    'width' => '10%',
  ),
  'WORK_ORDER_PROJECTED_C' => 
  array (
    'type' => 'date',
    'default' => false,
    'label' => 'LBL_WORK_ORDER_PROJECTED',
    'width' => '10%',
  ),
  'RFP_EOI_PUBLISHED_PROJECTED_C' => 
  array (
    'type' => 'date',
    'default' => false,
    'label' => 'LBL_RFP_EOI_PUBLISHED_PROJECTED',
    'width' => '10%',
  ),
  'BUDGET_SOURCE_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_BUDGET_SOURCE',
    'width' => '10%',
  ),
  'RFP_EOI_SUMMARY_C' => 
  array (
    'type' => 'text',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_RFP_EOI_SUMMARY',
    'sortable' => false,
    'width' => '10%',
  ),
  'BID_STRATEGY_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_BID_STRATEGY',
    'width' => '10%',
  ),
  'RFP_EOI_PUBLISHED_ACHIEVED_C' => 
  array (
    'type' => 'date',
    'default' => false,
    'label' => 'LBL_RFP_EOI_PUBLISHED_ACHIEVED',
    'width' => '10%',
  ),
  'COUNTRY_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_COUNTRY',
    'width' => '10%',
  ),
  'WORK_ORDER_ACHIEVED_C' => 
  array (
    'type' => 'date',
    'default' => false,
    'label' => 'LBL_WORK_ORDER_ACHIEVED',
    'width' => '10%',
  ),
  'CREATED_BY_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_CREATED',
    'default' => false,
  ),
  'PROJECT_SCOPE_C' => 
  array (
    'type' => 'text',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_PROJECT_SCOPE',
    'sortable' => false,
    'width' => '10%',
  ),
  'NON_FINANCIAL_CONSIDERATION_C' => 
  array (
    'type' => 'multienum',
    'default' => false,
    'studio' => 'visible',
    'label' => 'LBL_NON_FINANCIAL_CONSIDERATION',
    'width' => '10%',
  ),
  'BUDGET_ALLOCATED_OPPERTUNITY_C' => 
  array (
    'type' => 'float',
    'default' => false,
    'label' => 'LBL_BUDGET_ALLOCATED_OPPERTUNITY',
    'width' => '10%',
  ),
  'SCOPE_BUDGET_ACHIEVED_C' => 
  array (
    'type' => 'date',
    'default' => false,
    'label' => 'LBL_SCOPE_BUDGET_ACHIEVED',
    'width' => '10%',
  ),
  'PROJECT_IMPLEMENTATION_START_C' => 
  array (
    'type' => 'date',
    'default' => false,
    'label' => 'LBL_PROJECT_IMPLEMENTATION_START',
    'width' => '10%',
  ),
  'BUDGET_HEAD_C' => 
  array (
    'type' => 'varchar',
    'default' => false,
    'label' => 'LBL_BUDGET_HEAD',
    'width' => '10%',
  ),
  'FILENAME' => 
  array (
    'type' => 'file',
    'label' => 'LBL_FILENAME',
    'width' => '10%',
    'default' => false,
  ),
  'MODIFIED_BY_NAME' => 
  array (
    'width' => '5%',
    'label' => 'LBL_MODIFIED',
    'default' => false,
  ),
  'DATE_MODIFIED' => 
  array (
    'type' => 'datetime',
    'label' => 'LBL_DATE_MODIFIED',
    'width' => '10%',
    'default' => false,
  ),
  'DATE_ENTERED' => 
  array (
    'width' => '10%',
    'label' => 'LBL_DATE_ENTERED',
    'default' => false,
  ),
);
;
?>
