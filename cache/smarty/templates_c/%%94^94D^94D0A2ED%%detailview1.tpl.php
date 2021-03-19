<?php /* Smarty version 2.6.31, created on 2021-03-19 13:23:15
         compiled from custom/include/tpls/detailview1.tpl */ ?>
<?php if ($this->_tpl_vars['fields']['id']['value'] != ''): ?>
<br>
<?php $_from = $this->_tpl_vars['filename']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
   <a href='#' name=<?php echo $this->_tpl_vars['v']['id']; ?>
 class='tabDetailViewDFLink downloadAttachment'><?php echo $this->_tpl_vars['v']['filename']; ?>
 &nbsp<i class="glyphicon glyphicon-eye-open"></i></a><br />
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>