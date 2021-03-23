<?php /* Smarty version 2.6.31, created on 2021-03-20 10:47:26
         compiled from custom/include/SugarFields/Fields/CheckboxMultienum/EditView.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'custom/include/SugarFields/Fields/CheckboxMultienum/EditView.tpl', 1, false),array('function', 'sugarvar', 'custom/include/SugarFields/Fields/CheckboxMultienum/EditView.tpl', 3, false),)), $this); ?>
<div style="height: <?php echo ((is_array($_tmp=@$this->_tpl_vars['displayParams']['size'])) ? $this->_run_mod_handler('default', true, $_tmp, 400) : smarty_modifier_default($_tmp, 400)); ?>
px; overflow: <?php echo ((is_array($_tmp=@$this->_tpl_vars['displayParams']['overflow'])) ? $this->_run_mod_handler('default', true, $_tmp, 'scroll') : smarty_modifier_default($_tmp, 'scroll')); ?>
; width:<?php echo ((is_array($_tmp=@$this->_tpl_vars['displayParams']['width'])) ? $this->_run_mod_handler('default', true, $_tmp, 80) : smarty_modifier_default($_tmp, 80)); ?>
%" class="select"
  <?php if (isset ( $this->_tpl_vars['displayParams']['javascript'] )): ?><?php echo $this->_tpl_vars['displayParams']['javascript']; ?>
<?php endif; ?>>
  <input type="hidden" id="<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
_multiselect" name="<?php echo smarty_function_sugarvar(array('key' => 'name'), $this);?>
_multiselect" value="true">
  
    {multienum_to_array string=<?php echo smarty_function_sugarvar(array('key' => 'value','string' => true), $this);?>
 default=<?php echo smarty_function_sugarvar(array('key' => 'default','string' => true), $this);?>
 assign="values"}

  {if isset(<?php echo smarty_function_sugarvar(array('key' => 'value','string' => true), $this);?>
) && <?php echo smarty_function_sugarvar(array('key' => 'value','string' => true), $this);?>
 != ''}
  
    {html_checkboxes id="<?php echo $this->_tpl_vars['vardef']['name']; ?>
" name="<?php echo $this->_tpl_vars['vardef']['name']; ?>
" title="<?php echo $this->_tpl_vars['vardef']['help']; ?>
" options=<?php echo smarty_function_sugarvar(array('key' => 'options','string' => true), $this);?>
 separator="<?php echo $this->_tpl_vars['vardef']['separator']; ?>
" selected=$values class="check_box" } &nbsp
  {else}
    {html_checkboxes id="<?php echo $this->_tpl_vars['vardef']['name']; ?>
" name="<?php echo $this->_tpl_vars['vardef']['name']; ?>
" title="<?php echo $this->_tpl_vars['vardef']['help']; ?>
" options=<?php echo smarty_function_sugarvar(array('key' => 'options','string' => true), $this);?>
 separator="<?php echo $this->_tpl_vars['vardef']['separator']; ?>
" selected=<?php echo smarty_function_sugarvar(array('key' => 'default','string' => true), $this);?>
 class="check_box" } &nbsp
{/if}

</div>