<?php /* Smarty version 2.6.31, created on 2021-04-08 12:22:02
         compiled from custom/include/tpls/detailview.tpl */ ?>
<?php if ($this->_tpl_vars['fields']['id']['value'] != ''): ?>
<br>
<?php $_from = $this->_tpl_vars['filename']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
<label name=<?php echo $this->_tpl_vars['v']['id']; ?>
><?php echo $this->_tpl_vars['v']['value']; ?>
 : </label>
   <a href='#' name=<?php echo $this->_tpl_vars['v']['id']; ?>
 class='tabDetailViewDFLink downloadAttachment'><?php echo $this->_tpl_vars['v']['filename']; ?>
 &nbsp<i class="glyphicon glyphicon-eye-open"></i></a><br />
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>