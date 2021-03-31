<?php /* Smarty version 2.6.31, created on 2021-03-30 12:53:25
         compiled from modules/Administration/templates/ConfigureAjaxUI.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_getjspath', 'modules/Administration/templates/ConfigureAjaxUI.tpl', 42, false),array('function', 'sugar_translate', 'modules/Administration/templates/ConfigureAjaxUI.tpl', 52, false),)), $this); ?>
<script type="text/javascript" src="<?php echo smarty_function_sugar_getjspath(array('file' => 'cache/include/javascript/sugar_grp_yui_widgets.js'), $this);?>
"></script>
<form name="ConfigureAjaxUI" method="POST"  method="POST" action="index.php">
	<input type="hidden" name="module" value="Administration">
	<input type="hidden" name="action" value="UpdateAjaxUI">
	<input type="hidden" id="enabled_modules" name="enabled_modules" value="">
	<input type="hidden" id="disabled_modules" name="disabled_modules" value="">
	<input type="hidden" name="return_module" value="<?php echo $this->_tpl_vars['RETURN_MODULE']; ?>
">
	<input type="hidden" name="return_action" value="<?php echo $this->_tpl_vars['RETURN_ACTION']; ?>
">

	<?php echo $this->_tpl_vars['title']; ?>
<br/>
        <p><?php echo smarty_function_sugar_translate(array('label' => 'LBL_CONFIG_AJAX_DESC'), $this);?>
</p><br/>
	<p><?php echo smarty_function_sugar_translate(array('label' => 'LBL_CONFIG_AJAX_HELP'), $this);?>
</p><br/>
	<input title="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_KEY']; ?>
" class="button primary"
		   onclick="SUGAR.saveConfigureTabs();" type="submit" name="saveButton"
		   value="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_LABEL']; ?>
" />
	<input title="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_KEY']; ?>
" class="button"
		   onclick="this.form.action.value='index'; this.form.module.value='Administration';" type="submit" name="CancelButton"
		   value="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
"/>
	<div class='add_table' style='margin-bottom:5px'>
		<table id="ConfigureTabs" class="themeSettings edit view" style='margin-bottom:0px;' border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width='1%'>
					<div id="enabled_div" class="enabled_tab_workarea">
					</div>
				</td>
				<td>
					<div id="disabled_div" class="disabled_tab_workarea">
					</div>
				</td>
			</tr>
		</table>
	</div>
</form>

<script type="text/javascript">
	var enabled_modules = <?php echo $this->_tpl_vars['enabled_mods']; ?>
;
	var disabled_modules = <?php echo $this->_tpl_vars['disabled_mods']; ?>
;
	var lblEnabled = '<?php echo smarty_function_sugar_translate(array('label' => 'LBL_ACTIVE_MODULES'), $this);?>
';
	var lblDisabled = '<?php echo smarty_function_sugar_translate(array('label' => 'LBL_DISABLED_MODULES'), $this);?>
';
	<?php echo '
	
	SUGAR.enabledModsTable = new YAHOO.SUGAR.DragDropTable(
		"enabled_div",
		[{key:"label",  label: lblEnabled, width: 200, sortable: false},
		 {key:"module", label: lblEnabled, hidden:true}],
		new YAHOO.util.LocalDataSource(enabled_modules, {
			responseSchema: {
			   resultsList : "modules",
			   fields : [{key : "module"}, {key : "label"}]
			}
		}), 
		{
			height: "300px",
			group: ["enabled_div", "disabled_div"]
		}
	);
	SUGAR.disabledModsTable = new YAHOO.SUGAR.DragDropTable(
		"disabled_div",
		[{key:"label",  label: lblDisabled, width: 200, sortable: false},
		 {key:"module", label: lblDisabled, hidden:true}],
		new YAHOO.util.LocalDataSource(disabled_modules, {
			responseSchema: {
			   resultsList : "modules",
			   fields : [{key : "module"}, {key : "label"}]
			}
		}),
		{
			height: "300px",
		 	group: ["enabled_div", "disabled_div"]
		 }
	);
	SUGAR.enabledModsTable.disableEmptyRows = true;
    SUGAR.disabledModsTable.disableEmptyRows = true;
    SUGAR.enabledModsTable.addRow({module: "", label: ""});
    SUGAR.disabledModsTable.addRow({module: "", label: ""});
	SUGAR.enabledModsTable.render();
	SUGAR.disabledModsTable.render();

	SUGAR.saveConfigureTabs = function()
	{
		var disabledTable = SUGAR.disabledModsTable;
		var modules = [];
		for(var i=0; i < disabledTable.getRecordSet().getLength(); i++){
			var data = disabledTable.getRecord(i).getData();
			if (data.module && data.module != \'\')
			    modules[i] = data.module;
		}
		YAHOO.util.Dom.get(\'disabled_modules\').value = YAHOO.lang.JSON.stringify(modules);
	}
'; ?>

</script>