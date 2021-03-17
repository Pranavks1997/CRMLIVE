<?php /* Smarty version 2.6.31, created on 2021-03-17 14:30:50
         compiled from modules/DynamicFields/templates/Fields/Forms/parent.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_translate', 'modules/DynamicFields/templates/Fields/Forms/parent.tpl', 48, false),)), $this); ?>


<table width="100%"><tr><td class='mbLBL' width='30%' ><?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'COLUMN_TITLE_NAME'), $this);?>
:</td><td >
<?php if ($this->_tpl_vars['hideLevel'] == 0): ?>
	<input id="field_name_id" type="hidden" name="name" value="parent_name"/>parent_name
<?php else: ?>
	<input id= "field_name_id" type="hidden" name="name" value="<?php echo $this->_tpl_vars['vardef']['name']; ?>
"/><?php echo $this->_tpl_vars['vardef']['name']; ?>
<?php endif; ?>
<script>

	addToValidate('popup_form', 'name', 'DBName', true,'<?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'COLUMN_TITLE_NAME'), $this);?>
 [a-zA-Z_]' );
	addToValidateIsInArray('popup_form', 'name', 'in_array', true,'<?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'ERR_RESERVED_FIELD_NAME'), $this);?>
', '<?php echo $this->_tpl_vars['field_name_exceptions']; ?>
', '==');

</script>
</td></tr>
<tr>
	<td class='mbLBL' ><?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'COLUMN_TITLE_LABEL'), $this);?>
:</td>
	<td>
	<?php if ($this->_tpl_vars['hideLevel'] < 5): ?>
		<input id ="label_key_id" type="text" name="label" value="<?php echo $this->_tpl_vars['vardef']['vname']; ?>
">
	<?php else: ?>
		<input id ="label_key_id" type="hidden" name="label" value="<?php echo $this->_tpl_vars['vardef']['vname']; ?>
"><?php echo $this->_tpl_vars['vardef']['vname']; ?>

	<?php endif; ?>
	</td>
</tr>
<tr>
	<td class='mbLBL' ><?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'COLUMN_TITLE_LABEL_VALUE'), $this);?>
:</td>
	<td>
		<input id="label_value_id" type="text" name="labelValue" value="<?php echo $this->_tpl_vars['lbl_value']; ?>
">
	</td>
</tr>
<tr>
	<td class='mbLBL' ><?php echo smarty_function_sugar_translate(array('module' => 'DynamicFields','label' => 'COLUMN_TITLE_HELP_TEXT'), $this);?>
:</td>
	<td>
	<?php if ($this->_tpl_vars['hideLevel'] < 5): ?>
		<input type="text" name="help" value="<?php echo $this->_tpl_vars['vardef']['help']; ?>
">
	<?php else: ?>
		<input type="hidden" name="help" value="<?php echo $this->_tpl_vars['vardef']['help']; ?>
"><?php echo $this->_tpl_vars['vardef']['help']; ?>

	<?php endif; ?>
	</td>
</tr>
<script>
	if(document.getElementById('label_key_id').value == '')
		document.getElementById('label_key_id').value = 'LBL_FLEX_RELATE';
	if(document.getElementById('label_value_id').value == '')
		document.getElementById('label_value_id').value = 'Flex Relate';
</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/DynamicFields/templates/Fields/Forms/coreBottom.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>