<?php
// created: 2021-01-18 12:44:07
$sugar_config = array (
  'addAjaxBannedModules' => 
  array (
    0 => 'SecurityGroups',
  ),
  'admin_access_control' => false,
  'admin_export_only' => false,
  'aod' => 
  array (
    'enable_aod' => false,
  ),
  'aop' => 
  array (
    'distribution_method' => 'roundRobin',
    'case_closure_email_template_id' => '3b4fba94-6e60-f6cd-d1ce-5f8e954d1ae6',
    'joomla_account_creation_email_template_id' => '3c8578bc-bc06-6f89-3887-5f8e95171c0d',
    'case_creation_email_template_id' => '3d9aedce-cab5-e56e-4475-5f8e95ba5ec0',
    'contact_email_template_id' => '40bb83e8-ff43-7bcf-f675-5f8e956d070a',
    'user_email_template_id' => '42049921-2509-b1bd-4e42-5f8e9584e5f6',
  ),
  'aos' => 
  array (
    'version' => '5.3.3',
    'contracts' => 
    array (
      'renewalReminderPeriod' => '14',
    ),
    'lineItems' => 
    array (
      'totalTax' => false,
      'enableGroups' => true,
    ),
    'invoices' => 
    array (
      'initialNumber' => '1',
    ),
    'quotes' => 
    array (
      'initialNumber' => '1',
    ),
  ),
  'cache_dir' => 'cache/',
  'calculate_response_time' => true,
  'calendar' => 
  array (
    'default_view' => 'week',
    'show_calls_by_default' => true,
    'show_tasks_by_default' => true,
    'show_completed_by_default' => true,
    'editview_width' => 990,
    'editview_height' => 485,
    'day_timestep' => 15,
    'week_timestep' => 30,
    'items_draggable' => true,
    'items_resizable' => true,
    'enable_repeat' => true,
    'max_repeat_count' => 1000,
  ),
  'chartEngine' => 'Jit',
  'common_ml_dir' => '',
  'create_default_user' => false,
  'cron' => 
  array (
    'max_cron_jobs' => 10,
    'max_cron_runtime' => 30,
    'min_cron_interval' => 30,
    'allowed_cron_users' => 
    array (
      0 => 'ubuntu',
    ),
  ),
  'currency' => '',
  'dashlet_auto_refresh_min' => '30',
  'dashlet_display_row_options' => 
  array (
    0 => '1',
    1 => '3',
    2 => '5',
    3 => '10',
  ),
  'date_formats' => 
  array (
    // 'Y-m-d' => '2010-12-23',
    // 'm-d-Y' => '12-23-2010',
    // 'd-m-Y' => '23-12-2010',
    // 'Y/m/d' => '2010/12/23',
    // 'm/d/Y' => '12/23/2010',
    'd/m/Y' => '23/12/2010',
    // 'Y.m.d' => '2010.12.23',
    // 'd.m.Y' => '23.12.2010',
    // 'm.d.Y' => '12.23.2010',
  ),
  'datef' => 'm/d/Y',
  'dbconfig' => 
  array (
    'db_host_name' => 'localhost',
    'db_host_instance' => 'SQLEXPRESS',
    'db_user_name' => 'admin',
    'db_password' => '',
    'db_name' => 'suitecrm',
    'db_type' => 'mysql',
    'db_port' => '',
    'db_manager' => 'MysqliManager',
    'collation' => 'utf8_general_ci',
    'charset' => 'utf8',
  ),
  'dbconfigoption' => 
  array (
    'persistent' => true,
    'autofree' => false,
    'debug' => 0,
    'ssl' => false,
    'collation' => 'utf8_general_ci',
    'charset' => 'utf8',
  ),
  'default_action' => 'index',
  'default_charset' => 'UTF-8',
  'default_currencies' => 
  array (
    'AUD' => 
    array (
      'name' => 'Australian Dollars',
      'iso4217' => 'AUD',
      'symbol' => '$',
    ),
    'BRL' => 
    array (
      'name' => 'Brazilian Reais',
      'iso4217' => 'BRL',
      'symbol' => 'R$',
    ),
    'GBP' => 
    array (
      'name' => 'British Pounds',
      'iso4217' => 'GBP',
      'symbol' => '£',
    ),
    'CAD' => 
    array (
      'name' => 'Canadian Dollars',
      'iso4217' => 'CAD',
      'symbol' => '$',
    ),
    'CNY' => 
    array (
      'name' => 'Chinese Yuan',
      'iso4217' => 'CNY',
      'symbol' => '￥',
    ),
    'EUR' => 
    array (
      'name' => 'Euro',
      'iso4217' => 'EUR',
      'symbol' => '€',
    ),
    'HKD' => 
    array (
      'name' => 'Hong Kong Dollars',
      'iso4217' => 'HKD',
      'symbol' => '$',
    ),
    'INR' => 
    array (
      'name' => 'Indian Rupees',
      'iso4217' => 'INR',
      'symbol' => '₨',
    ),
    'KRW' => 
    array (
      'name' => 'Korean Won',
      'iso4217' => 'KRW',
      'symbol' => '₩',
    ),
    'YEN' => 
    array (
      'name' => 'Japanese Yen',
      'iso4217' => 'JPY',
      'symbol' => '¥',
    ),
    'MXN' => 
    array (
      'name' => 'Mexican Pesos',
      'iso4217' => 'MXN',
      'symbol' => '$',
    ),
    'SGD' => 
    array (
      'name' => 'Singaporean Dollars',
      'iso4217' => 'SGD',
      'symbol' => '$',
    ),
    'CHF' => 
    array (
      'name' => 'Swiss Franc',
      'iso4217' => 'CHF',
      'symbol' => 'SFr.',
    ),
    'THB' => 
    array (
      'name' => 'Thai Baht',
      'iso4217' => 'THB',
      'symbol' => '฿',
    ),
    'USD' => 
    array (
      'name' => 'US Dollars',
      'iso4217' => 'USD',
      'symbol' => '$',
    ),
  ),
  'default_currency_iso4217' => 'USD',
  'default_currency_name' => 'US Dollars',
  'default_currency_significant_digits' => 2,
  'default_currency_symbol' => '$',
  'default_date_format' => 'd/m/Y',
  'default_decimal_seperator' => '.',
  'default_email_charset' => 'UTF-8',
  'default_email_client' => 'sugar',
  'default_email_editor' => 'html',
  'default_export_charset' => 'UTF-8',
  'default_language' => 'en_us',
  'default_locale_name_format' => 's f l',
  'default_max_tabs' => 10,
  'default_module' => 'Home',
  'default_module_favicon' => false,
  'default_navigation_paradigm' => 'gm',
  'default_number_grouping_seperator' => ',',
  'default_password' => '',
  'default_permissions' => 
  array (
    'dir_mode' => 1528,
    'file_mode' => 493,
    'user' => '',
    'group' => '',
  ),
  'default_subpanel_links' => false,
  'default_subpanel_tabs' => true,
  'default_swap_last_viewed' => false,
  'default_swap_shortcuts' => false,
  'default_theme' => 'SuiteP',
  'default_time_format' => 'h:ia',
  'default_user_is_admin' => false,
  'default_user_name' => '',
  'demoData' => 'no',
  'developerMode' => true,
  'disable_convert_lead' => false,
  'disable_export' => false,
  'disable_persistent_connections' => false,
  'display_email_template_variable_chooser' => false,
  'display_inbound_email_buttons' => false,
  'dump_slow_queries' => false,
  'email_address_separator' => ',',
  'email_allow_send_as_user' => false,
  'email_confirm_opt_in_email_template_id' => '6914917a-1533-910d-fa9b-5f8e9541eb23',
  'email_default_client' => 'sugar',
  'email_default_delete_attachments' => false,
  'email_default_editor' => 'html',
  'email_enable_auto_send_opt_in' => false,
  'email_enable_confirm_opt_in' => 'not-opt-in',
  'email_warning_notifications' => false,
  'email_xss' => 'YToxMzp7czo2OiJhcHBsZXQiO3M6NjoiYXBwbGV0IjtzOjQ6ImJhc2UiO3M6NDoiYmFzZSI7czo1OiJlbWJlZCI7czo1OiJlbWJlZCI7czo0OiJmb3JtIjtzOjQ6ImZvcm0iO3M6NToiZnJhbWUiO3M6NToiZnJhbWUiO3M6ODoiZnJhbWVzZXQiO3M6ODoiZnJhbWVzZXQiO3M6NjoiaWZyYW1lIjtzOjY6ImlmcmFtZSI7czo2OiJpbXBvcnQiO3M6ODoiXD9pbXBvcnQiO3M6NToibGF5ZXIiO3M6NToibGF5ZXIiO3M6NDoibGluayI7czo0OiJsaW5rIjtzOjY6Im9iamVjdCI7czo2OiJvYmplY3QiO3M6MzoieG1wIjtzOjM6InhtcCI7czo2OiJzY3JpcHQiO3M6Njoic2NyaXB0Ijt9',
  'enable_action_menu' => true,
  'enable_line_editing_detail' => false,
  'enable_line_editing_list' => false,
  'export_delimiter' => ',',
  'export_excel_compatible' => false,
  'filter_module_fields' => 
  array (
    'Users' => 
    array (
      0 => 'show_on_employees',
      1 => 'portal_only',
      2 => 'is_group',
      3 => 'system_generated_password',
      4 => 'external_auth_only',
      5 => 'sugar_login',
      6 => 'authenticate_id',
      7 => 'pwd_last_changed',
      8 => 'is_admin',
      9 => 'user_name',
      10 => 'user_hash',
      11 => 'password',
      12 => 'last_login',
      13 => 'oauth_tokens',
    ),
    'Employees' => 
    array (
      0 => 'show_on_employees',
      1 => 'portal_only',
      2 => 'is_group',
      3 => 'system_generated_password',
      4 => 'external_auth_only',
      5 => 'sugar_login',
      6 => 'authenticate_id',
      7 => 'pwd_last_changed',
      8 => 'is_admin',
      9 => 'user_name',
      10 => 'user_hash',
      11 => 'password',
      12 => 'last_login',
      13 => 'oauth_tokens',
    ),
  ),
  'google_auth_json' => '',
  'hide_history_contacts_emails' => 
  array (
    'Cases' => false,
    'Accounts' => false,
    'Opportunities' => false,
  ),
  'hide_subpanels' => true,
  'history_max_viewed' => 50,
  'host_name' => '13.235.114.35',
  'imap_test' => false,
  'import_max_execution_time' => 3600,
  'import_max_records_per_file' => 100,
  'import_max_records_total_limit' => '',
  'installer_locked' => true,
  'jobs' => 
  array (
    'min_retry_interval' => 30,
    'max_retries' => 5,
    'timeout' => 86400,
  ),
  'js_custom_version' => 1,
  'js_lang_version' => 38,
  'languages' => 
  array (
    'en_us' => 'English (US)',
  ),
  'large_scale_test' => false,
  'lead_conv_activity_opt' => 'donothing',
  'list_max_entries_per_page' => 20,
  'list_max_entries_per_subpanel' => 10,
  'lock_default_user_name' => false,
  'lock_homepage' => false,
  'lock_subpanels' => true,
  'log_dir' => '.',
  'log_file' => 'suitecrm.log',
  'log_memory_usage' => false,
  'logger' => 
  array (
    'level' => 'fatal',
    'file' => 
    array (
      'ext' => '.log',
      'name' => 'CRM',
      'dateFormat' => '%c',
      'maxSize' => '10MB',
      'maxLogs' => 10,
      'suffix' => '',
    ),
  ),
  'max_dashlets_homepage' => '15',
  'name_formats' => 
  array (
    's f l' => 's f l',
    'f l' => 'f l',
    's l' => 's l',
    'l, s f' => 'l, s f',
    'l, f' => 'l, f',
    's l, f' => 's l, f',
    'l s f' => 'l s f',
    'l f s' => 'l f s',
  ),
  'oauth2_encryption_key' => 'ygKqRVRI5YL0t9Ep8NPvR93FZhj8U8iVzk+snwObv/Q=',
  'passwordsetting' => 
  array (
    'SystemGeneratedPasswordON' => '',
    'generatepasswordtmpl' => 'c2f2bf75-bccf-9f8d-11de-5f8e953d1013',
    'lostpasswordtmpl' => 'c44f0ca2-5ebb-e530-0e76-5f8e95492298',
    'factoremailtmpl' => 'c566888b-b1c2-c228-6c00-5f8e95c05d16',
    'forgotpasswordON' => false,
    'linkexpiration' => '1',
    'linkexpirationtime' => '30',
    'linkexpirationtype' => '1',
    'systexpiration' => '1',
    'systexpirationtime' => '7',
    'systexpirationtype' => '1',
    'systexpirationlogin' => '',
  ),
  'portal_view' => 'single_user',
  'require_accounts' => true,
  'resource_management' => 
  array (
    'special_query_limit' => 50000,
    'special_query_modules' => 
    array (
      0 => 'AOR_Reports',
      1 => 'Export',
      2 => 'Import',
      3 => 'Administration',
      4 => 'Sync',
    ),
    'default_limit' => 20000,
  ),
  'rss_cache_time' => '10800',
  'save_query' => 'all',
  'search' => 
  array (
    'controller' => 'UnifiedSearch',
    'defaultEngine' => 'BasicSearchEngine',
    'pagination' => 
    array (
      'min' => 10,
      'max' => 50,
      'step' => 10,
    ),
    'ElasticSearch' => 
    array (
      'enabled' => false,
      'host' => 'localhost',
      'user' => '',
      'pass' => '',
    ),
  ),
  'search_wildcard_char' => '%',
  'search_wildcard_infront' => false,
  'securitysuite_additive' => true,
  'securitysuite_filter_user_list' => false,
  'securitysuite_inbound_email' => false,
  'securitysuite_inherit_assigned' => true,
  'securitysuite_inherit_creator' => true,
  'securitysuite_inherit_parent' => true,
  'securitysuite_popup_select' => false,
  'securitysuite_strict_rights' => false,
  'securitysuite_user_popup' => true,
  'securitysuite_user_role_precedence' => true,
  'securitysuite_version' => '6.5.17',
  'session_dir' => '',
  'showDetailData' => true,
  'showThemePicker' => true,
  'site_url' => 'http://15.206.54.38:8080/v2',
  'slow_query_time_msec' => '100',
  'stack_trace_errors' => false,
  'strict_id_validation' => false,
  'sugar_version' => '6.5.25',
  'sugarbeet' => false,
  'suitecrm_version' => '7.11.15',
  'system_email_templates' => 
  array (
    'confirm_opt_in_template_id' => '6914917a-1533-910d-fa9b-5f8e9541eb23',
  ),
  'theme_settings' => 
  array (
    'SuiteP' => 
    array (
      'display_sidebar' => false,
    ),
  ),
  'time_formats' => 
  array (
    'H:i' => '23:00',
    'h:ia' => '11:00pm',
    'h:iA' => '11:00PM',
    'h:i a' => '11:00 pm',
    'h:i A' => '11:00 PM',
    'H.i' => '23.00',
    'h.ia' => '11.00pm',
    'h.iA' => '11.00PM',
    'h.i a' => '11.00 pm',
    'h.i A' => '11.00 PM',
  ),
  'timef' => 'H:i',
  'tmp_dir' => 'cache/xml/',
  'tracker_max_display_length' => 15,
  'translation_string_prefix' => false,
  'unique_key' => 'ec85d1f295a620d352e8b9d4228a14aa',
  'upload_badext' => 
  array (
    0 => 'php',
    1 => 'php3',
    2 => 'php4',
    3 => 'php5',
    4 => 'pl',
    5 => 'cgi',
    6 => 'py',
    7 => 'asp',
    8 => 'cfm',
    9 => 'js',
    10 => 'vbs',
    11 => 'html',
    12 => 'htm',
    13 => 'phtml',
  ),
  'upload_dir' => 'upload/',
  'upload_maxsize' => 30000000,
  'use_common_ml_dir' => false,
  'use_real_names' => true,
  'vcal_time' => '2',
  'verify_client_ip' => true,
);