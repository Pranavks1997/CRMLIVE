
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
{if $fields.id.value != ''}
{foreach from=$filename key=k item=v}
	<br/>
	
	<label name={$v.id}  >{$v.value} : </label>
	<a href='#' name={$v.id} id="download_attachment{$k}" class='tabDetailViewDFLink downloadAttachment'>{$v.filename} &nbsp<i class="glyphicon glyphicon-eye-open"></i></a>
	<a href='#' name={$v.id} id="remove_attachment{$k}" class='tabDetailViewDFLink remove_attachment'> &nbsp<i class="glyphicon glyphicon-remove"></i></a>
{/foreach}
{/if}