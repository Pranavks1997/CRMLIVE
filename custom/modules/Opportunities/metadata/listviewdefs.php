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
  'DESCRIPTION' => 
  array (
    'type' => 'text',
    'label' => 'LBL_DESCRIPTION',
    'sortable' => false,
    'width' => '10%',
    'default' => true,
  ),
  'RFPOREOIPUBLISHED_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_RFP/EOIPUBLISHED',
    'width' => '10%',
  ),
  'ACCOUNT_NAME' => 
  array (
    'width' => '20%',
    'label' => 'LBL_LIST_ACCOUNT_NAME',
    'id' => 'ACCOUNT_ID',
    'module' => 'Accounts',
    'link' => true,
    'default' => true,
    'sortable' => true,
    'ACLTag' => 'ACCOUNT',
    'contextMenu' => 
    array (
      'objectType' => 'sugarAccount',
      'metaData' => 
      array (
        'return_module' => 'Contacts',
        'return_action' => 'ListView',
        'module' => 'Accounts',
        'parent_id' => '{$ACCOUNT_ID}',
        'parent_name' => '{$ACCOUNT_NAME}',
        'account_id' => '{$ACCOUNT_ID}',
        'account_name' => '{$ACCOUNT_NAME}',
      ),
    ),
    'related_fields' => 
    array (
      0 => 'account_id',
    ),
  ),
  'SOURCE_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_SOURCE',
    'width' => '10%',
  ),
  'FILENAME' => 
  array (
    'type' => 'file',
    'label' => 'LBL_FILENAME',
    'width' => '10%',
    'default' => true,
  ),
  'SOURCE_DETAILS_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_SOURCE_DETAILS',
    'width' => '10%',
  ),
  'SCOPE_BUDGET_PROJECTED_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_SCOPE_BUDGET_PROJECTED',
    'width' => '10%',
  ),
  'SCOPE_BUDGET_ACHIEVED_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_SCOPE_BUDGET_ACHIEVED',
    'width' => '10%',
  ),
  'RFP_EOI_PROJECTED_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_RFP_EOI_PROJECTED',
    'width' => '10%',
  ),
  'RFP_EOI_ACHIEVED_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_RFP_EOI_ACHIEVED',
    'width' => '10%',
  ),
  'RFP_EOI_PUBLISHED_PROJECTED_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_RFP_EOI_PUBLISHED_PROJECTED',
    'width' => '10%',
  ),
  'RFP_EOI_PUBLISHED_ACHIEVED_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_RFP_EOI_PUBLISHED_ACHIEVED',
    'width' => '10%',
  ),
  'WORK_ORDER_PROJECTED_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_WORK_ORDER_PROJECTED',
    'width' => '10%',
  ),
  'WORK_ORDER_ACHIEVED_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_WORK_ORDER_ACHIEVED',
    'width' => '10%',
  ),
  'BUDGET_SOURCE_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_BUDGET_SOURCE',
    'width' => '10%',
  ),
  'BUDGET_HEAD_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_BUDGET_HEAD',
    'width' => '10%',
  ),
  'BUDGET_HEAD_AMOUNT_C' => 
  array (
    'type' => 'float',
    'default' => true,
    'label' => 'LBL_BUDGET_HEAD_AMOUNT',
    'width' => '10%',
  ),
  'BUDGET_ALLOCATED_OPPERTUNITY_C' => 
  array (
    'type' => 'float',
    'default' => true,
    'label' => 'LBL_BUDGET_ALLOCATED_OPPERTUNITY',
    'width' => '10%',
  ),
  'PROJECT_IMPLEMENTATION_START_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_PROJECT_IMPLEMENTATION_START',
    'width' => '10%',
  ),
  'PROJECT_IMPLEMENTATION_END_C' => 
  array (
    'type' => 'date',
    'default' => true,
    'label' => 'LBL_PROJECT_IMPLEMENTATION_END',
    'width' => '10%',
  ),
  'FINANCIAL_FEASIBILITY_L1_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_FINANCIAL_FEASIBILITY_L1',
    'width' => '10%',
  ),
  'FINANCIAL_FEASIBILITY_L2_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_FINANCIAL_FEASIBILITY_L2',
    'width' => '10%',
  ),
  'FINANCIAL_FEASIBILITY_L3_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_FINANCIAL_FEASIBILITY_L3',
    'width' => '10%',
  ),
  'CASH_FLOW_C' => 
  array (
    'type' => 'varchar',
    'default' => true,
    'label' => 'LBL_CASH_FLOW',
    'width' => '10%',
  ),
  'CLOSURE_STATUS_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_CLOSURE_STATUS',
    'width' => '10%',
  ),
  'LEARNINGS_C' => 
  array (
    'type' => 'text',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_LEARNINGS',
    'sortable' => false,
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
  'OPPORTUNITY_TYPE' => 
  array (
    'width' => '15%',
    'label' => 'LBL_TYPE',
    'default' => false,
  ),
  'LEAD_SOURCE' => 
  array (
    'width' => '15%',
    'label' => 'LBL_LEAD_SOURCE',
    'default' => false,
  ),
  'NEXT_STEP' => 
  array (
    'width' => '10%',
    'label' => 'LBL_NEXT_STEP',
    'default' => false,
  ),
  'PROBABILITY' => 
  array (
    'width' => '10%',
    'label' => 'LBL_PROBABILITY',
    'default' => false,
  ),
  'CREATED_BY_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_CREATED',
    'default' => false,
  ),
  'MODIFIED_BY_NAME' => 
  array (
    'width' => '5%',
    'label' => 'LBL_MODIFIED',
    'default' => false,
  ),
);
;
?>
