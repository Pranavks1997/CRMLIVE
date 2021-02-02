<?php 
 //WARNING: The contents of this file are auto-generated



$dictionary['Opportunity']['fields']['documents'] = array(
  'name' => 'documents',
  'vname' => 'LBL_DOCUMENTS',
  'type' => 'file',
  'dbType' => 'varchar',
  'len' => '255',
  'reportable'=>true,
  'importable' => false,
);

// created: 2021-01-07 14:09:44
$dictionary["Opportunity"]["fields"]["opportunities_documents_1"] = array (
  'name' => 'opportunities_documents_1',
  'type' => 'link',
  'relationship' => 'opportunities_documents_1',
  'source' => 'non-db',
  'module' => 'Documents',
  'bean_name' => 'Document',
  'vname' => 'LBL_OPPORTUNITIES_DOCUMENTS_1_FROM_DOCUMENTS_TITLE',
);


// created: 2020-11-03 10:04:46
$dictionary["Opportunity"]["fields"]["opportunities_users_1"] = array (
  'name' => 'opportunities_users_1',
  'type' => 'link',
  'relationship' => 'opportunities_users_1',
  'source' => 'non-db',
  'module' => 'Users',
  'bean_name' => 'User',
  'side' => 'right',
  'vname' => 'LBL_OPPORTUNITIES_USERS_1_FROM_USERS_TITLE',
);


// created: 2020-11-03 11:32:56
$dictionary["Opportunity"]["fields"]["opportunities_users_2"] = array (
  'name' => 'opportunities_users_2',
  'type' => 'link',
  'relationship' => 'opportunities_users_2',
  'source' => 'non-db',
  'module' => 'Users',
  'bean_name' => 'User',
  'side' => 'right',
  'vname' => 'LBL_OPPORTUNITIES_USERS_2_FROM_USERS_TITLE',
);



$dictionary['Opportunity']['fields']['file_mime_type'] = array( 'name' => 'file_mime_type',
'vname' => 'LBL_FILE_MIME_TYPE',
'type' => 'varchar',
'len' => '100',
'importable' => false,
);

$dictionary['Opportunity']['fields']['file_url'] = array( 'name'=>'file_url',
'vname' => 'LBL_FILE_URL',
'type'=>'function',
'function_class'=>'UploadFile',
'function_name'=>'get_upload_url',
'function_params'=> array('$this'),
'source'=>'function',
'reportable'=>false,
'importable' => false,
);

$dictionary['Opportunity']['fields']['filename'] = array(
'name' => 'filename',
'vname' => 'LBL_FILENAME',
'type' => 'file',
'dbType' => 'varchar',
'len' => '255',
'reportable'=>true,
'importable' => false,
);

 // created: 2020-11-11 06:49:41
$dictionary['Opportunity']['fields']['influencersl1_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['influencersl1_c']['labelValue']='Influencers(L1)';

 

 // created: 2021-01-06 09:43:08
$dictionary['Opportunity']['fields']['tagged_users_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['tagged_users_c']['labelValue']='Tagged Users';

 

 // created: 2020-11-09 06:05:27
$dictionary['Opportunity']['fields']['submission_status_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['submission_status_c']['labelValue']='Submission Status';

 

 // created: 2020-11-03 12:01:13
$dictionary['Opportunity']['fields']['opportunity_type_new_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['opportunity_type_new_c']['labelValue']='Opportunity Type';

 

 // created: 2020-11-13 07:33:38
$dictionary['Opportunity']['fields']['product_service_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['product_service_c']['labelValue']='Product/ Service';

 

 // created: 2020-10-20 11:55:30
$dictionary['Opportunity']['fields']['project_implementation_end_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['project_implementation_end_c']['labelValue']='Project Implementation End Date';

 

 // created: 2021-01-04 13:05:14
$dictionary['Opportunity']['fields']['financial_feasibility_l2_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['financial_feasibility_l2_c']['labelValue']='Financial Feasibility (L2)';

 

 // created: 2020-11-13 07:33:24
$dictionary['Opportunity']['fields']['segment_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['segment_c']['labelValue']='Segment';

 

 // created: 2020-11-13 13:24:37
$dictionary['Opportunity']['fields']['add_new_segment_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['add_new_segment_c']['labelValue']='Add new segment';

 

 // created: 2020-12-02 10:56:00
$dictionary['Opportunity']['fields']['source_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['source_c']['labelValue']='Source';

 

 // created: 2020-11-13 13:09:30
$dictionary['Opportunity']['fields']['first_of_a_kind_segment_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['first_of_a_kind_segment_c']['labelValue']='First of a kind segment';

 

 // created: 2020-12-22 07:10:13
$dictionary['Opportunity']['fields']['funding_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['funding_c']['labelValue']='Funding';

 

 // created: 2020-10-31 03:32:39
$dictionary['Opportunity']['fields']['sub_sector_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['sub_sector_c']['labelValue']='Sub  Sector';

 

 // created: 2021-01-12 13:22:16
$dictionary['Opportunity']['fields']['account_name_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['account_name_c']['labelValue']='Departent name';

 

 // created: 2020-12-05 07:24:36
$dictionary['Opportunity']['fields']['comment_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['comment_c']['labelValue']='Comment';

 

 // created: 2020-11-11 06:55:55
$dictionary['Opportunity']['fields']['user_id1_c']['inline_edit']=1;

 

 // created: 2020-11-13 13:09:40
$dictionary['Opportunity']['fields']['first_of_a_kind_product_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['first_of_a_kind_product_c']['labelValue']='First of a kind product';

 

 // created: 2020-10-27 08:00:15
$dictionary['Opportunity']['fields']['department_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['department_c']['labelValue']='Department';

 

 // created: 2020-10-20 11:58:37
$dictionary['Opportunity']['fields']['cash_flow_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['cash_flow_c']['labelValue']='Cash Flow';

 

 // created: 2020-10-20 11:22:55
$dictionary['Opportunity']['fields']['scope_achieved_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['scope_achieved_c']['labelValue']='scope achieved';

 

 // created: 2020-12-31 13:13:17
$dictionary['Opportunity']['fields']['multiple_approver_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['multiple_approver_c']['labelValue']='Multiple Approver';

 

 // created: 2021-01-06 09:41:30
$dictionary['Opportunity']['fields']['untagged_users_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['untagged_users_c']['labelValue']='Untagged Users';

 

 // created: 2021-01-26 06:38:01
$dictionary['Opportunity']['fields']['non_financial_consideration_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['non_financial_consideration_c']['labelValue']='Non Financial Consideration';

 

 // created: 2020-10-20 07:46:31
$dictionary['Opportunity']['fields']['jjwg_maps_lat_c']['inline_edit']=1;

 

 // created: 2020-12-02 03:48:14
$dictionary['Opportunity']['fields']['project_scope_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['project_scope_c']['labelValue']='Project Scope';

 

 // created: 2020-11-11 07:44:42
$dictionary['Opportunity']['fields']['rfp_eoi_projected_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['rfp_eoi_projected_c']['labelValue']='RFP/EOI Initiated Drafting (Projected)';

 

 // created: 2020-10-20 07:46:31
$dictionary['Opportunity']['fields']['jjwg_maps_address_c']['inline_edit']=1;

 

 // created: 2020-12-17 17:28:09
$dictionary['Opportunity']['fields']['assigned_to_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['assigned_to_c']['labelValue']='Assigned To';

 

 // created: 2020-10-20 11:37:04
$dictionary['Opportunity']['fields']['work_order_achieved_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['work_order_achieved_c']['labelValue']='Work Order (Achieved)';

 

 // created: 2021-01-12 06:53:46
$dictionary['Opportunity']['fields']['country_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['country_c']['labelValue']='Country Name';

 

 // created: 2020-11-11 07:45:07
$dictionary['Opportunity']['fields']['rfp_eoi_published_achieved_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['rfp_eoi_published_achieved_c']['labelValue']='RFP/EOI Published (Achieved)';

 

 // created: 2020-12-28 06:42:15
$dictionary['Opportunity']['fields']['opportunity_id_c']['inline_edit']=1;

 

 // created: 2020-11-07 08:18:50
$dictionary['Opportunity']['fields']['bid_strategy_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['bid_strategy_c']['labelValue']='Bid Strategy';

 

 // created: 2020-11-11 07:47:31
$dictionary['Opportunity']['fields']['rfp_eoi_summary_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['rfp_eoi_summary_c']['labelValue']='RFP/EOI Summary';

 

 // created: 2020-12-31 12:04:02
$dictionary['Opportunity']['fields']['select_approver_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['select_approver_c']['labelValue']='Approver';

 

 // created: 2020-12-17 17:28:09
$dictionary['Opportunity']['fields']['user_id3_c']['inline_edit']=1;

 

 // created: 2020-10-20 12:27:17
$dictionary['Opportunity']['fields']['amount']['required']=false;
$dictionary['Opportunity']['fields']['amount']['inline_edit']=true;
$dictionary['Opportunity']['fields']['amount']['comments']='Unconverted amount of the opportunity';
$dictionary['Opportunity']['fields']['amount']['duplicate_merge']='enabled';
$dictionary['Opportunity']['fields']['amount']['duplicate_merge_dom_value']='1';
$dictionary['Opportunity']['fields']['amount']['merge_filter']='disabled';

 

 // created: 2020-10-20 11:48:54
$dictionary['Opportunity']['fields']['budget_source_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['budget_source_c']['labelValue']='Budget Source';

 

 // created: 2021-01-14 11:46:04
$dictionary['Opportunity']['fields']['new_department_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['new_department_c']['labelValue']='Department.';

 

 // created: 2021-01-06 09:48:25
$dictionary['Opportunity']['fields']['tagged_hiden_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['tagged_hiden_c']['labelValue']='tagged hiden';

 

 // created: 2020-11-09 05:10:59
$dictionary['Opportunity']['fields']['bid_checklist_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['bid_checklist_c']['labelValue']='Bid Checklist';

 

 // created: 2020-11-13 06:58:55
$dictionary['Opportunity']['fields']['name']['required']=false;
$dictionary['Opportunity']['fields']['name']['full_text_search']=array (
);

 

 // created: 2020-11-11 06:49:41
$dictionary['Opportunity']['fields']['user_id_c']['inline_edit']=1;

 

 // created: 2020-11-11 07:45:24
$dictionary['Opportunity']['fields']['rfp_eoi_published_projected_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['rfp_eoi_published_projected_c']['labelValue']='RFP/EOI Published (Projected)';

 

 // created: 2020-10-20 11:36:07
$dictionary['Opportunity']['fields']['work_order_projected_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['work_order_projected_c']['labelValue']='Work Order (projected)';

 

 // created: 2021-01-12 13:22:16
$dictionary['Opportunity']['fields']['account_id_c']['inline_edit']=1;

 

 // created: 2020-11-26 05:52:43
$dictionary['Opportunity']['fields']['rfporeoipublished_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['rfporeoipublished_c']['labelValue']='RFP/EOI Published';

 

 // created: 2020-10-31 03:32:04
$dictionary['Opportunity']['fields']['sector_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['sector_c']['labelValue']='Sector';

 

 // created: 2020-11-13 08:59:17
$dictionary['Opportunity']['fields']['first_of_a_kind_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['first_of_a_kind_c']['labelValue']='First of a kind';

 

 // created: 2020-11-06 06:03:59
$dictionary['Opportunity']['fields']['cash_f_c']['inline_edit']='';
$dictionary['Opportunity']['fields']['cash_f_c']['labelValue']='Cash F';

 

 // created: 2021-01-06 09:39:43
$dictionary['Opportunity']['fields']['tag_users_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['tag_users_c']['labelValue']='Tag Users';

 

 // created: 2020-12-23 12:23:50
$dictionary['Opportunity']['fields']['budget_head_amount_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['budget_head_amount_c']['labelValue']='Budget Head Amount (in Cr)';

 

 // created: 2021-01-04 13:05:05
$dictionary['Opportunity']['fields']['financial_feasibility_l1_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['financial_feasibility_l1_c']['labelValue']='Financial Feasibility (L1)';

 

 // created: 2020-11-11 07:24:22
$dictionary['Opportunity']['fields']['comments_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['comments_c']['labelValue']='Comments';

 

 // created: 2020-11-11 07:24:33
$dictionary['Opportunity']['fields']['learnings_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['learnings_c']['labelValue']='Learnings';

 

 // created: 2020-11-02 10:51:40
$dictionary['Opportunity']['fields']['upload_file_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['upload_file_c']['labelValue']='Upload File';

 

 // created: 2020-11-13 13:24:29
$dictionary['Opportunity']['fields']['add_new_product_service_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['add_new_product_service_c']['labelValue']='Add new product/service';

 

 // created: 2020-10-20 07:46:31
$dictionary['Opportunity']['fields']['jjwg_maps_lng_c']['inline_edit']=1;

 

 // created: 2021-01-12 06:53:08
$dictionary['Opportunity']['fields']['international_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['international_c']['labelValue']='International Opportunity';

 

 // created: 2020-10-20 11:14:50
$dictionary['Opportunity']['fields']['assign_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['assign_c']['labelValue']='Assign';

 

 // created: 2020-11-11 07:44:16
$dictionary['Opportunity']['fields']['rfp_eoi_achieved_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['rfp_eoi_achieved_c']['labelValue']='RFP/ EOI Initiated Drafting (Achieved)';

 

 // created: 2020-10-27 08:19:21
$dictionary['Opportunity']['fields']['scope_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['scope_c']['labelValue']='Scope';

 

 // created: 2020-11-03 12:01:38
$dictionary['Opportunity']['fields']['opportunity_type']['len']=100;
$dictionary['Opportunity']['fields']['opportunity_type']['inline_edit']=true;
$dictionary['Opportunity']['fields']['opportunity_type']['options']='opportunity_type';
$dictionary['Opportunity']['fields']['opportunity_type']['comments']='Type of opportunity (ex: Existing, New)';
$dictionary['Opportunity']['fields']['opportunity_type']['merge_filter']='disabled';

 

 // created: 2020-11-09 06:06:27
$dictionary['Opportunity']['fields']['bidstrategy_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['bidstrategy_c']['labelValue']='Bid Strategy';

 

 // created: 2020-11-11 09:48:36
$dictionary['Opportunity']['fields']['filename']['required']=false;

 

 // created: 2021-01-04 13:05:25
$dictionary['Opportunity']['fields']['financial_feasibility_l3_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['financial_feasibility_l3_c']['labelValue']='Financial Feasibility (L3)';

 

 // created: 2020-11-11 07:54:02
$dictionary['Opportunity']['fields']['scope_budget_projected_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['scope_budget_projected_c']['labelValue']='DPR/Scope & Budget Accepted (Projected)';

 

 // created: 2020-12-17 17:09:05
$dictionary['Opportunity']['fields']['example_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['example_c']['labelValue']='example';

 

 // created: 2020-12-21 15:32:15
$dictionary['Opportunity']['fields']['submissionstatus_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['submissionstatus_c']['labelValue']='Submission Status';

 

 // created: 2021-01-07 07:26:19
$dictionary['Opportunity']['fields']['multiple_file_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['multiple_file_c']['labelValue']='Multiple File';

 

 // created: 2021-01-06 09:44:29
$dictionary['Opportunity']['fields']['tagged_user_comments_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['tagged_user_comments_c']['labelValue']='Tagged User Comments';

 

 // created: 2020-12-28 17:51:41
$dictionary['Opportunity']['fields']['test_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['test_c']['labelValue']='test';

 

 // created: 2020-10-20 11:49:35
$dictionary['Opportunity']['fields']['budget_head_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['budget_head_c']['labelValue']='Budget Head';

 

 // created: 2020-12-22 07:09:11
$dictionary['Opportunity']['fields']['selection_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['selection_c']['labelValue']='Selection';

 

 // created: 2020-10-20 11:10:34
$dictionary['Opportunity']['fields']['financial_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['financial_c']['labelValue']='Non Financial Considerations';

 

 // created: 2020-11-11 11:44:44
$dictionary['Opportunity']['fields']['closure_status_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['closure_status_c']['labelValue']='Closure Status';

 

 // created: 2020-10-30 09:54:24
$dictionary['Opportunity']['fields']['sector1_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['sector1_c']['labelValue']='sector1';

 

 // created: 2020-12-22 07:10:23
$dictionary['Opportunity']['fields']['timing_button_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['timing_button_c']['labelValue']='Timing';

 

 // created: 2020-11-11 07:48:17
$dictionary['Opportunity']['fields']['description']['inline_edit']=true;
$dictionary['Opportunity']['fields']['description']['comments']='Full text of the note';
$dictionary['Opportunity']['fields']['description']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['description']['rows']='4';

 

 // created: 2020-10-20 11:54:37
$dictionary['Opportunity']['fields']['project_implementation_start_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['project_implementation_start_c']['labelValue']='Project Implementation Start Date';

 

 // created: 2020-11-11 06:55:55
$dictionary['Opportunity']['fields']['influencersl2_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['influencersl2_c']['labelValue']='Influencers(L2)';

 

 // created: 2020-11-11 07:53:46
$dictionary['Opportunity']['fields']['scope_budget_achieved_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['scope_budget_achieved_c']['labelValue']='DPR/Scope & Budget Accepted (Achieved)';

 

 // created: 2021-01-06 09:42:13
$dictionary['Opportunity']['fields']['untagged_users_comments_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['untagged_users_comments_c']['labelValue']='Untagged Users Comments';

 

 // created: 2020-10-20 12:32:48
$dictionary['Opportunity']['fields']['sales_stage']['len']=100;
$dictionary['Opportunity']['fields']['sales_stage']['required']=false;
$dictionary['Opportunity']['fields']['sales_stage']['inline_edit']=true;
$dictionary['Opportunity']['fields']['sales_stage']['comments']='Indication of progression towards closure';
$dictionary['Opportunity']['fields']['sales_stage']['merge_filter']='disabled';

 

 // created: 2020-10-20 12:02:42
$dictionary['Opportunity']['fields']['source_details_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['source_details_c']['labelValue']='Source Details';

 

 // created: 2020-10-20 12:27:50
$dictionary['Opportunity']['fields']['date_closed']['required']=false;
$dictionary['Opportunity']['fields']['date_closed']['inline_edit']=true;
$dictionary['Opportunity']['fields']['date_closed']['comments']='Expected or actual date the oppportunity will close';
$dictionary['Opportunity']['fields']['date_closed']['merge_filter']='disabled';

 

 // created: 2021-01-04 13:06:00
$dictionary['Opportunity']['fields']['budget_allocated_oppertunity_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['budget_allocated_oppertunity_c']['labelValue']='Budget Allocated for Opportunity (in Cr)';

 

 // created: 2021-01-06 09:48:48
$dictionary['Opportunity']['fields']['untagged_hidden_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['untagged_hidden_c']['labelValue']='untagged hidden';

 

 // created: 2020-12-28 06:42:15
$dictionary['Opportunity']['fields']['checking_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['checking_c']['labelValue']='checking';

 

 // created: 2021-01-06 09:57:55
$dictionary['Opportunity']['fields']['tagged_users_comments_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['tagged_users_comments_c']['labelValue']='Tagged Users Comments';

 

 // created: 2020-10-20 07:46:31
$dictionary['Opportunity']['fields']['jjwg_maps_geocode_status_c']['inline_edit']=1;

 

 // created: 2020-11-13 07:47:42
$dictionary['Opportunity']['fields']['applyfor_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['applyfor_c']['labelValue']='Apply For';

 

 // created: 2020-10-30 09:54:59
$dictionary['Opportunity']['fields']['sub_sector1_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['sub_sector1_c']['labelValue']='sub sector1';

 

 // created: 2020-11-11 09:15:49
$dictionary['Opportunity']['fields']['non_financial_consideration1_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['non_financial_consideration1_c']['labelValue']='non financial consideration1';

 

 // created: 2020-11-13 08:38:55
$dictionary['Opportunity']['fields']['risk_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['risk_c']['labelValue']='Risk';

 

 // created: 2020-11-13 06:59:24
$dictionary['Opportunity']['fields']['state_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['state_c']['labelValue']='State';

 

 // created: 2020-11-13 07:34:21
$dictionary['Opportunity']['fields']['status_c']['inline_edit']='1';
$dictionary['Opportunity']['fields']['status_c']['labelValue']='Status';

 

 // created: 2020-11-02 07:10:15
$dictionary['Opportunity']['fields']['file_new_c']['inline_edit']='';
$dictionary['Opportunity']['fields']['file_new_c']['labelValue']='File new';

 
?>