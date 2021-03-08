<?php
// created: 2021-02-03 05:59:57
$sugar_config = array (
  'addAjaxBannedModules' => 
  array (
    0 => 'SecurityGroups',
  ),
  'admin_access_control' => false,
  'admin_export_only' => false,
  'aod' => 
  array (
    'enable_aod' => true,
  ),
  'aop' => 
  array (
    'distribution_method' => 'roundRobin',
    'case_closure_email_template_id' => '9742b58b-8a69-54d8-0416-601a3b3963bd',
    'joomla_account_creation_email_template_id' => '986b44ad-983d-4b08-a2eb-601a3b488b51',
    'case_creation_email_template_id' => '9986cae5-36f3-0e38-6d95-601a3b6e93f9',
    'contact_email_template_id' => '9c9f305d-c531-b3db-a06f-601a3bf47635',
    'user_email_template_id' => '9de9ce80-cc75-6609-b48b-601a3b2006b5',
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
      0 => 'www-data',
    ),
  ),
  'currency' => '',
  'dashlet_display_row_options' => 
  array (
    0 => '1',
    1 => '3',
    2 => '5',
    3 => '10',
  ),
  'date_formats' => 
  array (
    'Y-m-d' => '2010-12-23',
    'm-d-Y' => '12-23-2010',
    'd-m-Y' => '23-12-2010',
    'Y/m/d' => '2010/12/23',
    'm/d/Y' => '12/23/2010',
    'd/m/Y' => '23/12/2010',
    'Y.m.d' => '2010.12.23',
    'd.m.Y' => '23.12.2010',
    'm.d.Y' => '12.23.2010',
  ),
  'datef' => 'm/d/Y',
  'dbconfig' => 
  array (
    'db_host_name' => 'localhost',
    'db_host_instance' => 'SQLEXPRESS',
    'db_user_name' => 'xelp',
    'db_password' => 'xelp@123',
    'db_name' => 'project',
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
  'default_date_format' => 'm/d/Y',
  'default_decimal_seperator' => '.',
  'default_email_charset' => 'UTF-8',
  'default_email_client' => 'sugar',
  'default_email_editor' => 'html',
  'default_export_charset' => 'UTF-8',
  'default_language' => 'en_us',
  'default_locale_name_format' => 's f l',
  'default_max_tabs' => 10,
  'default_module' => 'Home',
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
  'developerMode' => false,
  'disable_convert_lead' => false,
  'disable_export' => false,
  'disable_persistent_connections' => false,
  'display_email_template_variable_chooser' => false,
  'display_inbound_email_buttons' => false,
  'dump_slow_queries' => false,
  'email_address_separator' => ',',
  'email_confirm_opt_in_email_template_id' => 'd4f0f0e6-3474-e8e1-16a2-601a3b1a5ca2',
  'email_default_client' => 'sugar',
  'email_default_delete_attachments' => true,
  'email_default_editor' => 'html',
  'email_enable_auto_send_opt_in' => false,
  'email_enable_confirm_opt_in' => 'not-opt-in',
  'email_warning_notifications' => true,
  'enable_action_menu' => true,
  'enable_line_editing_detail' => true,
  'enable_line_editing_list' => true,
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
  'hide_subpanels' => true,
  'history_max_viewed' => 50,
  'host_name' => '13.233.236.171',
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
  'js_lang_version' => 3,
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
  'lock_subpanels' => false,
  'log_dir' => '.',
  'log_file' => 'suitecrm.log',
  'log_memory_usage' => false,
  'logger' => 
  array (
    'level' => 'fatal',
    'file' => 
    array (
      'ext' => '.log',
      'name' => 'suitecrm',
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
  'oauth2_encryption_key' => 'TPr34UafERDm8N5J4vUx+bCi6DOuLH9PJwnOQFAI/iY=',
  'passwordsetting' => 
  array (
    'SystemGeneratedPasswordON' => '',
    'generatepasswordtmpl' => '3289de82-e47a-a591-76de-601a3bcdfc10',
    'lostpasswordtmpl' => '33cdea79-3bba-2f51-3839-601a3b08ba74',
    'factoremailtmpl' => '34f9870e-ac2f-2a7b-e9c5-601a3b0c0cb1',
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
  'site_url' => 'http://13.233.236.171/Project',
  'slow_query_time_msec' => '100',
  'strict_id_validation' => false,
  'sugar_version' => '6.5.25',
  'sugarbeet' => false,
  'suitecrm_version' => '7.11.18',
  'system_email_templates' => 
  array (
    'confirm_opt_in_template_id' => 'd4f0f0e6-3474-e8e1-16a2-601a3b1a5ca2',
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
  'unique_key' => '61969abe51505c725d3139c141fced3d',
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