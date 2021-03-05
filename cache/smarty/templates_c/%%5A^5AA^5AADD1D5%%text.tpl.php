<?php /* Smarty version 2.6.31, created on 2021-03-02 09:42:59
         compiled from modules/DynamicFields/templates/Fields/Forms/text.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_translate', 'modules/DynamicFields/templates/Fields/Forms/text.tpl', 50, false),array('modifier', 'default', 'modules/DynamicFields/templates/Fields/Forms/text.tpl', 53, false),)), $this); ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/DynamicFields/templates/Fields/Forms/coreTop.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<tr>
	<td class='mbLBL'><?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'COLUMN_TITLE_LABEL_ROWS'), $this);?>
:</td>
	<td>
	<?php if ($this->_tpl_vars['hideLevel'] < 4): ?>
		<input id ="rows" type="text" name="rows" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['vardef']['rows'])) ? $this->_run_mod_handler('default', true, $_tmp, 4) : smarty_modifier_default($_tmp, 4)); ?>
">
	<?php else: ?>
		<input id ="rows" type="hidden" name="rows" value="<?php echo $this->_tpl_vars['vardef']['rows']; ?>
"><?php echo $this->_tpl_vars['vardef']['rows']; ?>

	<?php endif; ?>
	</td>
</tr>
<tr>
	<td class='mbLBL'><?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'COLUMN_TITLE_LABEL_COLS'), $this);?>
:</td>
	<td>
	<?php if ($this->_tpl_vars['hideLevel'] < 4): ?>
		<input id ="cols" type="text" name="cols" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['vardef']['cols'])) ? $this->_run_mod_handler('default', true, $_tmp, 20) : smarty_modifier_default($_tmp, 20)); ?>
">
	<?php else: ?>
		<input id ="cols" type="hidden" name="cols" value="<?php echo $this->_tpl_vars['vardef']['displayParams']['cols']; ?>
"><?php echo $this->_tpl_vars['vardef']['cols']; ?>

	<?php endif; ?>
	</td>
</tr>
<tr>
	<td class='mbLBL'><?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'COLUMN_TITLE_DEFAULT_VALUE'), $this);?>
:</td>
	<td>
	<?php if ($this->_tpl_vars['hideLevel'] < 5): ?>
		<textarea name='default' id='default' ><?php echo $this->_tpl_vars['vardef']['default']; ?>
</textarea>
	<?php else: ?>
		<textarea name='default' id='default' disabled ><?php echo $this->_tpl_vars['vardef']['default']; ?>
</textarea>
		<input type='hidden' name='default' value='<?php echo $this->_tpl_vars['vardef']['default']; ?>
'/>
	<?php endif; ?>
	</td>
</tr>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/DynamicFields/templates/Fields/Forms/coreBottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>