<?php /* Smarty version 2.6.31, created on 2021-03-18 10:33:52
         compiled from cache/themes/SuiteP/modules/Project/SearchForm_popup_query_form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'counter', 'cache/themes/SuiteP/modules/Project/SearchForm_popup_query_form.tpl', 27, false),array('function', 'math', 'cache/themes/SuiteP/modules/Project/SearchForm_popup_query_form.tpl', 28, false),array('function', 'sugar_translate', 'cache/themes/SuiteP/modules/Project/SearchForm_popup_query_form.tpl', 34, false),array('function', 'html_options', 'cache/themes/SuiteP/modules/Project/SearchForm_popup_query_form.tpl', 146, false),array('function', 'sugar_getimage', 'cache/themes/SuiteP/modules/Project/SearchForm_popup_query_form.tpl', 183, false),array('function', 'sugar_getimagepath', 'cache/themes/SuiteP/modules/Project/SearchForm_popup_query_form.tpl', 264, false),array('modifier', 'default', 'cache/themes/SuiteP/modules/Project/SearchForm_popup_query_form.tpl', 80, false),)), $this); ?>

<script>
    <?php echo '
    $(function () {
        var $dialog = $(\'<div></div>\')
                .html(SUGAR.language.get(\'app_strings\', \'LBL_SEARCH_HELP_TEXT\'))
                .dialog({
                    autoOpen: false,
                    title: SUGAR.language.get(\'app_strings\', \'LBL_SEARCH_HELP_TITLE\'),
                    width: 700
                });

        $(\'.help-search\').click(function () {
            $dialog.dialog(\'open\');
            // prevent the default action, e.g., following a link
        });

    });
    '; ?>

</script>
<div class="row">
              <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-advanced-search">
        <div class="">
            
              

            <?php echo smarty_function_counter(array('assign' => 'index'), $this);?>

            <?php echo smarty_function_math(array('equation' => "left % right",'left' => $this->_tpl_vars['index'],'right' => $this->_tpl_vars['templateMeta']['maxColumns'],'assign' => 'modVal'), $this);?>


            <div class="col-xs-12">
                                <label for='name_advanced'><?php echo smarty_function_sugar_translate(array('label' => 'LBL_NAME','module' => 'Project'), $this);?>
</label>
                            </div>
            <div class="form-item">
                                
<?php if (strlen ( $this->_tpl_vars['fields']['name_advanced']['value'] ) <= 0): ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['name_advanced']['default_value']); ?>
<?php else: ?>
<?php $this->assign('value', $this->_tpl_vars['fields']['name_advanced']['value']); ?>
<?php endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['name_advanced']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['name_advanced']['name']; ?>
' size='30' 
    maxlength='50' 
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''      accesskey='9'  >
                            </div>
        </div>
    </div>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-advanced-search">
        <div class="">
            
              

            <?php echo smarty_function_counter(array('assign' => 'index'), $this);?>

            <?php echo smarty_function_math(array('equation' => "left % right",'left' => $this->_tpl_vars['index'],'right' => $this->_tpl_vars['templateMeta']['maxColumns'],'assign' => 'modVal'), $this);?>


            <div class="col-xs-12">
                                <label for='estimated_start_date_advanced'><?php echo smarty_function_sugar_translate(array('label' => 'LBL_DATE_START','module' => 'Project'), $this);?>
</label>
                            </div>
            <div class="form-item">
                                
<span class="dateTime">
<?php $this->assign('date_value', $this->_tpl_vars['fields']['estimated_start_date_advanced']['value']); ?>
<input class="date_input" autocomplete="off" type="text" name="<?php echo $this->_tpl_vars['fields']['estimated_start_date_advanced']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['estimated_start_date_advanced']['name']; ?>
" value="<?php echo $this->_tpl_vars['date_value']; ?>
" title=''  tabindex='0'    size="11" maxlength="10" >
    <button type="button" id="<?php echo $this->_tpl_vars['fields']['estimated_start_date_advanced']['name']; ?>
_trigger" class="btn btn-danger" onclick="return false;"><span class="suitepicon suitepicon-module-calendar" alt="<?php echo $this->_tpl_vars['APP']['LBL_ENTER_DATE']; ?>
"></span></button>
</span>
<script type="text/javascript">
Calendar.setup ({
inputField : "<?php echo $this->_tpl_vars['fields']['estimated_start_date_advanced']['name']; ?>
",
form : "popup_query_form",
ifFormat : "<?php echo $this->_tpl_vars['CALENDAR_FORMAT']; ?>
",
daFormat : "<?php echo $this->_tpl_vars['CALENDAR_FORMAT']; ?>
",
button : "<?php echo $this->_tpl_vars['fields']['estimated_start_date_advanced']['name']; ?>
_trigger",
singleClick : true,
dateStr : "<?php echo $this->_tpl_vars['date_value']; ?>
",
startWeekday: <?php echo ((is_array($_tmp=@$this->_tpl_vars['CALENDAR_FDOW'])) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
,
step : 1,
weekNumbers:false
}
);
</script>

                            </div>
        </div>
    </div>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-advanced-search">
        <div class="">
            
              

            <?php echo smarty_function_counter(array('assign' => 'index'), $this);?>

            <?php echo smarty_function_math(array('equation' => "left % right",'left' => $this->_tpl_vars['index'],'right' => $this->_tpl_vars['templateMeta']['maxColumns'],'assign' => 'modVal'), $this);?>


            <div class="col-xs-12">
                                <label for='estimated_end_date_advanced'><?php echo smarty_function_sugar_translate(array('label' => 'LBL_DATE_END','module' => 'Project'), $this);?>
</label>
                            </div>
            <div class="form-item">
                                
<span class="dateTime">
<?php $this->assign('date_value', $this->_tpl_vars['fields']['estimated_end_date_advanced']['value']); ?>
<input class="date_input" autocomplete="off" type="text" name="<?php echo $this->_tpl_vars['fields']['estimated_end_date_advanced']['name']; ?>
" id="<?php echo $this->_tpl_vars['fields']['estimated_end_date_advanced']['name']; ?>
" value="<?php echo $this->_tpl_vars['date_value']; ?>
" title=''  tabindex='0'    size="11" maxlength="10" >
    <button type="button" id="<?php echo $this->_tpl_vars['fields']['estimated_end_date_advanced']['name']; ?>
_trigger" class="btn btn-danger" onclick="return false;"><span class="suitepicon suitepicon-module-calendar" alt="<?php echo $this->_tpl_vars['APP']['LBL_ENTER_DATE']; ?>
"></span></button>
</span>
<script type="text/javascript">
Calendar.setup ({
inputField : "<?php echo $this->_tpl_vars['fields']['estimated_end_date_advanced']['name']; ?>
",
form : "popup_query_form",
ifFormat : "<?php echo $this->_tpl_vars['CALENDAR_FORMAT']; ?>
",
daFormat : "<?php echo $this->_tpl_vars['CALENDAR_FORMAT']; ?>
",
button : "<?php echo $this->_tpl_vars['fields']['estimated_end_date_advanced']['name']; ?>
_trigger",
singleClick : true,
dateStr : "<?php echo $this->_tpl_vars['date_value']; ?>
",
startWeekday: <?php echo ((is_array($_tmp=@$this->_tpl_vars['CALENDAR_FDOW'])) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
,
step : 1,
weekNumbers:false
}
);
</script>

                            </div>
        </div>
    </div>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-advanced-search">
        <div class="">
            
              

            <?php echo smarty_function_counter(array('assign' => 'index'), $this);?>

            <?php echo smarty_function_math(array('equation' => "left % right",'left' => $this->_tpl_vars['index'],'right' => $this->_tpl_vars['templateMeta']['maxColumns'],'assign' => 'modVal'), $this);?>


            <div class="col-xs-12">
                                <label for='status_advanced'><?php echo smarty_function_sugar_translate(array('label' => 'LBL_STATUS','module' => 'Project'), $this);?>
</label>
                            </div>
            <div class="form-item">
                                
<?php echo smarty_function_html_options(array('id' => 'status_advanced','name' => 'status_advanced[]','options' => $this->_tpl_vars['fields']['status_advanced']['options'],'size' => '6','class' => 'templateGroupChooser','multiple' => '1','selected' => $this->_tpl_vars['fields']['status_advanced']['value']), $this);?>

                            </div>
        </div>
    </div>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-advanced-search">
        <div class="">
            
              

            <?php echo smarty_function_counter(array('assign' => 'index'), $this);?>

            <?php echo smarty_function_math(array('equation' => "left % right",'left' => $this->_tpl_vars['index'],'right' => $this->_tpl_vars['templateMeta']['maxColumns'],'assign' => 'modVal'), $this);?>


            <div class="col-xs-12">
                                <label for='priority_advanced'><?php echo smarty_function_sugar_translate(array('label' => 'LBL_PRIORITY','module' => 'Project'), $this);?>
</label>
                            </div>
            <div class="form-item">
                                
<?php echo smarty_function_html_options(array('id' => 'priority_advanced','name' => 'priority_advanced[]','options' => $this->_tpl_vars['fields']['priority_advanced']['options'],'size' => '6','class' => 'templateGroupChooser','multiple' => '1','selected' => $this->_tpl_vars['fields']['priority_advanced']['value']), $this);?>

                            </div>
        </div>
    </div>
    
    <div>
        <div>
            &nbsp;
        </div>
    </div>

    <?php if ($this->_tpl_vars['DISPLAY_SAVED_SEARCH']): ?>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-advanced-search">
            <?php if (! $this->_tpl_vars['searchFormInPopup']): ?>
                <div>
                    <a class='tabFormAdvLink' onhover href='javascript:toggleInlineSearch()'>
                        <?php ob_start(); ?><?php echo smarty_function_sugar_translate(array('label' => 'LBL_ALT_SHOW_OPTIONS'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('alt_show_hide', ob_get_contents());ob_end_clean(); ?>
                        <?php echo smarty_function_sugar_getimage(array('alt' => $this->_tpl_vars['alt_show_hide'],'name' => 'advanced_search','ext' => ".gif",'other_attributes' => 'border="0" id="up_down_img" '), $this);?>

                        &nbsp;<?php echo $this->_tpl_vars['APP']['LNK_SAVED_VIEWS']; ?>

                    </a><br>
                    <input type='hidden' id='showSSDIV' name='showSSDIV' value='<?php echo $this->_tpl_vars['SHOWSSDIV']; ?>
'>
                    <p>
                </div>
            <?php endif; ?>
            <div class="" scope='row' width='10%' nowrap="nowrap">
                <div class="col-xs-12">
                    <label><?php echo smarty_function_sugar_translate(array('label' => 'LBL_SAVE_SEARCH_AS','module' => 'SavedSearch'), $this);?>
:</label>
                </div>
                <div class="form-item" width='30%' nowrap>
                    <input type='text' name='saved_search_name'>
                    <input type='hidden' name='search_module' value=''>
                    <input type='hidden' name='saved_search_action' value=''>
                    <input title='<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_LABEL']; ?>
' value='<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_LABEL']; ?>
' class='button'
                           type='button' name='saved_search_submit'
                           onclick='SUGAR.savedViews.setChooser(); return SUGAR.savedViews.saved_search_action("save");'>
                </div>
            </div>
            <div class="hideUnusedSavedSearchElements" scope='row' width='10%'
                 nowrap="nowrap"<?php if (! $this->_tpl_vars['savedSearchData']['selected']): ?> style="display: none;"<?php endif; ?>>
                <label><?php echo smarty_function_sugar_translate(array('label' => 'LBL_MODIFY_CURRENT_FILTER','module' => 'SavedSearch'), $this);?>
: <span
                            id='curr_search_name'>"<?php echo $this->_tpl_vars['savedSearchData']['options'][$this->_tpl_vars['savedSearchData']['selected']]; ?>
"</span></label>
            </div>
            <div class="hideUnusedSavedSearchElements" width='30%'
                 nowrap<?php if (! $this->_tpl_vars['savedSearchData']['selected']): ?> style="display: none;"<?php endif; ?>>
                <input class='button'
                       onclick='SUGAR.savedViews.setChooser(); return SUGAR.savedViews.saved_search_action("update")'
                       value='<?php echo $this->_tpl_vars['APP']['LBL_UPDATE']; ?>
' title='<?php echo $this->_tpl_vars['APP']['LBL_UPDATE']; ?>
' name='ss_update' id='ss_update'
                       type='button'>
                <input class='button'
                       onclick='return SUGAR.savedViews.saved_search_action("delete", "<?php echo smarty_function_sugar_translate(array('label' => 'LBL_DELETE_CONFIRM','module' => 'SavedSearch'), $this);?>
")'
                       value='<?php echo $this->_tpl_vars['APP']['LBL_DELETE']; ?>
' title='<?php echo $this->_tpl_vars['APP']['LBL_DELETE']; ?>
' name='ss_delete' id='ss_delete'
                       type='button'>
            </div>
        </div>
        <div>
            <div colspan='6'>
                <div<?php if (! $this->_tpl_vars['searchFormInPopup']): ?> style='<?php echo $this->_tpl_vars['DISPLAYSS']; ?>
'<?php endif; ?> id='inlineSavedSearch'>
                    <?php echo $this->_tpl_vars['SAVED_SEARCH']; ?>

                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['displayType'] != 'popupView'): ?>
        <div>
            <div class="submitButtonsAdvanced">
                <input tabindex='2' title='<?php echo $this->_tpl_vars['APP']['LBL_SEARCH_BUTTON_TITLE']; ?>
' onclick='SUGAR.savedViews.setChooser()'
                       class='button' type='submit' name='button' value='<?php echo $this->_tpl_vars['APP']['LBL_SEARCH_BUTTON_LABEL']; ?>
'
                       id='search_form_submit_advanced'/>&nbsp;
                <input tabindex='2' title='<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_TITLE']; ?>
'
                       onclick='SUGAR.searchForm.clear_form(this.form); if(document.getElementById("saved_search_select")){document.getElementById("saved_search_select").options[0].selected=true;} return false;'
                       class='button' type='button' name='clear' id='search_form_clear_advanced'
                       value='<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_BUTTON_LABEL']; ?>
'/>
                <?php if ($this->_tpl_vars['DOCUMENTS_MODULE']): ?>
                    &nbsp;
                    <input title="<?php echo $this->_tpl_vars['APP']['LBL_BROWSE_DOCUMENTS_BUTTON_TITLE']; ?>
" type="button" class="button"
                           value="<?php echo $this->_tpl_vars['APP']['LBL_BROWSE_DOCUMENTS_BUTTON_LABEL']; ?>
"
                           onclick='open_popup("Documents", 600, 400, "&caller=Documents", true, false, "");'/>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['searchFormInPopup']): ?>
                <div>
                    <?php endif; ?>
                    <a id="basic_search_link" href="javascript:void(0)"
                       accesskey="<?php echo $this->_tpl_vars['APP']['LBL_ADV_SEARCH_LNK_KEY']; ?>
"><?php echo $this->_tpl_vars['APP']['LNK_BASIC_FILTER']; ?>
</a>
        <span class='white-space'>
            &nbsp;&nbsp;&nbsp;<?php if ($this->_tpl_vars['SAVED_SEARCHES_OPTIONS']): ?>|&nbsp;&nbsp;&nbsp;<b><?php echo $this->_tpl_vars['APP']['LBL_SAVED_FILTER_SHORTCUT']; ?>
</b>&nbsp;
            <?php echo $this->_tpl_vars['SAVED_SEARCHES_OPTIONS']; ?>
 <?php endif; ?>
            <span id='go_btn_span' style='display:none'><input tabindex='2' title='go_select' id='go_select'
                                                               onclick='SUGAR.searchForm.clear_form(this.form);'
                                                               class='button' type='button' name='go_select'
                                                               value=' <?php echo $this->_tpl_vars['APP']['LBL_GO_BUTTON_LABEL']; ?>
 '/></span>
        </span>
                    <?php if ($this->_tpl_vars['searchFormInPopup']): ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="help">
                <?php if ($this->_tpl_vars['DISPLAY_SEARCH_HELP']): ?>
                    <img border='0' src='<?php echo smarty_function_sugar_getimagepath(array('file' => "help-dashlet.gif"), $this);?>
' class="help-search">
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
    <?php echo '
    if (typeof(loadSSL_Scripts) == \'function\') {
        loadSSL_Scripts();
    }
    '; ?>

</script>
<script>
    <?php echo '
    $(document).ready(function () {
        $(\'#basic_search_link\').one("click", function () {
            //alert( "This will be displayed only once." );
            SUGAR.searchForm.searchFormSelect(\''; ?>
<?php echo $this->_tpl_vars['module']; ?>
<?php echo '|basic_search\', \''; ?>
<?php echo $this->_tpl_vars['module']; ?>
<?php echo '|advanced_search\');
        });
    });
    '; ?>

</script><?php echo '<script language="javascript">if(typeof sqs_objects == \'undefined\'){var sqs_objects = new Array;}sqs_objects[\'popup_query_form_modified_by_name_advanced\']={"form":"popup_query_form","method":"get_user_array","field_list":["user_name","id"],"populate_list":["modified_by_name_advanced","modified_user_id_advanced"],"required_list":["modified_user_id"],"conditions":[{"name":"user_name","op":"like_custom","end":"%","value":""}],"limit":"30","no_match_text":"No Match"};sqs_objects[\'popup_query_form_created_by_name_advanced\']={"form":"popup_query_form","method":"get_user_array","field_list":["user_name","id"],"populate_list":["created_by_name_advanced","created_by_advanced"],"required_list":["created_by"],"conditions":[{"name":"user_name","op":"like_custom","end":"%","value":""}],"limit":"30","no_match_text":"No Match"};sqs_objects[\'popup_query_form_assigned_user_name_advanced\']={"form":"popup_query_form","method":"get_user_array","field_list":["user_name","id"],"populate_list":["assigned_user_name_advanced","assigned_user_id_advanced"],"required_list":["assigned_user_id"],"conditions":[{"name":"user_name","op":"like_custom","end":"%","value":""}],"limit":"30","no_match_text":"No Match"};sqs_objects[\'popup_query_form_am_projecttemplates_project_1_name_advanced\']={"form":"popup_query_form","method":"query","modules":["AM_ProjectTemplates"],"group":"or","field_list":["name","id"],"populate_list":["am_projecttemplates_project_1_name_advanced","am_projecttemplates_project_1am_projecttemplates_ida_advanced"],"required_list":["parent_id"],"conditions":[{"name":"name","op":"like_custom","end":"%","value":""}],"order":"name","limit":"30","no_match_text":"No Match"};</script>'; ?>