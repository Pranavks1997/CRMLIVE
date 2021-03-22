
	<form method="post" action="/custom/modules/Opportunities/uploadAttchments.php">
		<div>
<input type="file"  name="attachments[0]" id="attachments[0]" class="multiple_file" onclick="file_size(this.id)"/>
<div class="input_fields_wrap"><div></div></div>
<input type="submit" value="Submit" class="value_for" style="display:none;">
</div>
</form>
{if $fields.id.value != ''}
{foreach from=$filename key=k item=v}
	<br/>
	<a href='#' name={$v.id} id="download_attachment{$k}" class='tabDetailViewDFLink downloadAttachment'>{$v.filename} &nbsp<i class="glyphicon glyphicon-eye-open"></i></a>
	<a href='#' name={$v.id} id="remove_attachment{$k}" class='tabDetailViewDFLink remove_attachment'> &nbsp<i class="glyphicon glyphicon-remove"></i></a>
{/foreach}
{/if}