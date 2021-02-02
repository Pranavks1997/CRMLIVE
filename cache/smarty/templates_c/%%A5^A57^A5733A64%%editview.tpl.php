<?php /* Smarty version 2.6.31, created on 2021-01-22 14:00:09
         compiled from custom/include/tpls/editview.tpl */ ?>
<div><input type="file"  name="attachments[0]" id="attachments[0]" class="multiple_file" onclick="file_size(this.id)"/></div>
<div class="input_fields_wrap"><div></div></div><button class="add_field_button btn" id="add_button">Add File</button>
<?php if ($this->_tpl_vars['fields']['id']['value'] != ''): ?>
<?php $_from = $this->_tpl_vars['filename']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
	<br/>
	<a href='#' name=<?php echo $this->_tpl_vars['v']['id']; ?>
 id="download_attachment<?php echo $this->_tpl_vars['k']; ?>
" class='tabDetailViewDFLink downloadAttachment'><?php echo $this->_tpl_vars['v']['filename']; ?>
 &nbsp<i class="glyphicon glyphicon-eye-open"></i></a>
	<a href='#' name=<?php echo $this->_tpl_vars['v']['id']; ?>
 id="remove_attachment<?php echo $this->_tpl_vars['k']; ?>
" class='tabDetailViewDFLink remove_attachment'> &nbsp<i class="glyphicon glyphicon-remove"></i></a>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>