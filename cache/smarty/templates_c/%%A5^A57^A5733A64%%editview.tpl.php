<?php /* Smarty version 2.6.31, created on 2021-03-19 12:35:52
         compiled from custom/include/tpls/editview.tpl */ ?>

	<form method="post" action="/custom/modules/Opportunities/uploadAttchments.php">
		<div>
	<select name="file_for[0]" class='multiple_file'>
<option label="" value=""></option>
<option label="RFP/EOI" value="RFP/EOI">RFP/EOI</option>
<option label="Technical Bid" value="Technical Bid" >Technical Bid</option>
<option label="Financial Bid" value="Financial Bid">Financial Bid</option>
<option label="Others" value="Others">Others</option>
</select>
<input type="file"  name="attachments[0]" id="attachments[0]" class="multiple_file" onclick="file_size(this.id)"/>
<div class="input_fields_wrap"><div></div></div>
<input type="submit" value="Submit" class="value_for" style="display:none;">
</div>
</form>
<button class="add_field_button btn" id="add_button">Add File</button>
<?php if ($this->_tpl_vars['fields']['id']['value'] != ''): ?>
<?php $_from = $this->_tpl_vars['filename']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
	<br/>
	
	<label name=<?php echo $this->_tpl_vars['v']['id']; ?>
  ><?php echo $this->_tpl_vars['v']['value']; ?>
 : </label>
	<a href='#' name=<?php echo $this->_tpl_vars['v']['id']; ?>
 id="download_attachment<?php echo $this->_tpl_vars['k']; ?>
" class='tabDetailViewDFLink downloadAttachment'><?php echo $this->_tpl_vars['v']['filename']; ?>
 &nbsp<i class="glyphicon glyphicon-eye-open"></i></a>
	<a href='#' name=<?php echo $this->_tpl_vars['v']['id']; ?>
 id="remove_attachment<?php echo $this->_tpl_vars['k']; ?>
" class='tabDetailViewDFLink remove_attachment'> &nbsp<i class="glyphicon glyphicon-remove"></i></a>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>