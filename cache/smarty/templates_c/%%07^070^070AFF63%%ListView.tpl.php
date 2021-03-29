<?php /* Smarty version 2.6.31, created on 2021-03-25 14:51:30
         compiled from include/SugarFields/Fields/Multienum/ListView.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'multienum_to_array', 'include/SugarFields/Fields/Multienum/ListView.tpl', 43, false),)), $this); ?>
<?php if (! empty ( $this->_tpl_vars['parentFieldArray'][$this->_tpl_vars['col']] )): ?>
<?php echo smarty_function_multienum_to_array(array('string' => $this->_tpl_vars['parentFieldArray'][$this->_tpl_vars['col']],'assign' => 'vals'), $this);?>

<?php $_from = $this->_tpl_vars['vals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['multiEnum'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['multiEnum']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['multiEnum']['iteration']++;
?>
<?php echo $this->_tpl_vars['vardef']['options_list'][$this->_tpl_vars['item']]; ?>
<?php if (! ($this->_foreach['multiEnum']['iteration'] == $this->_foreach['multiEnum']['total'])): ?>,
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
&nbsp;