<?php /* Smarty version 2.6.31, created on 2021-03-20 17:13:20
         compiled from modules/DynamicFields/templates/Fields/Forms/enum.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_translate', 'modules/DynamicFields/templates/Fields/Forms/enum.tpl', 50, false),array('function', 'html_options', 'modules/DynamicFields/templates/Fields/Forms/enum.tpl', 53, false),)), $this); ?>

 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/DynamicFields/templates/Fields/Forms/coreTop.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<tr>
	<td class='mbLBL'><?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'LBL_DROP_DOWN_LIST'), $this);?>
:</td>
	<td>
	<?php if ($this->_tpl_vars['hideLevel'] < 5 && empty ( $this->_tpl_vars['vardef']['function'] )): ?>
		<?php echo smarty_function_html_options(array('name' => 'options','id' => 'options','selected' => $this->_tpl_vars['selected_dropdown'],'values' => $this->_tpl_vars['dropdowns'],'output' => $this->_tpl_vars['dropdowns'],'onChange' => "ModuleBuilder.dropdownChanged(this.value);"), $this);?>
<?php if (! $this->_tpl_vars['uneditable']): ?><br><input type='button' value='<?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'LBL_BTN_EDIT'), $this);?>
' class='button' onclick="<?php echo 'if(check_form(\'popup_form\')) { ModuleBuilder.moduleDropDown(this.form.options.value, this.form.options.value); }'; ?>
">&nbsp;<input type='button' value='<?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'LBL_BTN_ADD'), $this);?>
' class='button' onclick="<?php echo 'if(check_form(\'popup_form\')) { ModuleBuilder.moduleDropDown(\'\', this.form.name.value); }'; ?>
"><?php endif; ?>
	<?php else: ?>
		<input type='hidden' name='options' value='<?php echo $this->_tpl_vars['selected_dropdown']; ?>
'><?php echo $this->_tpl_vars['selected_dropdown']; ?>

	<?php endif; ?>
	</td>
</tr>
<tr>
	<td class='mbLBL'><?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'COLUMN_TITLE_DEFAULT_VALUE'), $this);?>
:</td>
	<td>
	<?php if ($this->_tpl_vars['hideLevel'] < 5 && empty ( $this->_tpl_vars['vardef']['function'] )): ?>
		<?php echo smarty_function_html_options(array('name' => "default[]",'id' => "default[]",'selected' => $this->_tpl_vars['selected_options'],'options' => $this->_tpl_vars['default_dropdowns'],'multiple' => $this->_tpl_vars['multi']), $this);?>

	<?php else: ?>
		<input type='hidden' name='default[]' id='default[]' value='$vardef.default'><?php echo $this->_tpl_vars['vardef']['default']; ?>

	<?php endif; ?>
	</td>
</tr>
<tr>
	<td class='mbLBL' ><?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'COLUMN_TITLE_MASS_UPDATE'), $this);?>
:</td>
	<td>
	<?php if ($this->_tpl_vars['hideLevel'] < 5): ?>
		<input type="checkbox" id="massupdate"  name="massupdate" value="1" <?php if (! empty ( $this->_tpl_vars['vardef']['massupdate'] )): ?>checked<?php endif; ?>/>
	<?php else: ?>
		<input type="checkbox" id="massupdate"  name="massupdate" value="1" disabled <?php if (! empty ( $this->_tpl_vars['vardef']['massupdate'] )): ?>checked<?php endif; ?>/>
	<?php endif; ?>
	</td>
</tr>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/DynamicFields/templates/Fields/Forms/coreBottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>